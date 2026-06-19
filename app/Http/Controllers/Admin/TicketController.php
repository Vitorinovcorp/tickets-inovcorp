<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Entidade;
use App\Models\Contacto;
use App\Models\Inbox;
use App\Models\Estado;
use App\Models\TipoTicket;
use App\Models\Resposta;
use App\Models\TicketConhecimento;
use App\Models\AtividadeTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\NovoTicketMail;
use App\Mail\RespostaTicketMail;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with(['inbox', 'estado', 'operador', 'entidade', 'contacto', 'tipo']);

        // Filtros
        if ($request->inbox_id) {
            $query->where('inbox_id', $request->inbox_id);
        }
        if ($request->estado_id) {
            $query->where('estado_id', $request->estado_id);
        }
        if ($request->operador_id) {
            $query->where('operador_associado_id', $request->operador_id);
        }
        if ($request->tipo_id) {
            $query->where('tipo_id', $request->tipo_id);
        }
        if ($request->entidade_id) {
            $query->where('entidade_id', $request->entidade_id);
        }
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('numero_ticket', 'LIKE', "%{$search}%")
                    ->orWhere('assunto', 'LIKE', "%{$search}%")
                    ->orWhereHas('entidade', function ($sq) use ($search) {
                        $sq->where('nome', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('contacto', function ($sq) use ($search) {
                        $sq->where('email', 'LIKE', "%{$search}%");
                    });
            });
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(20);

        $filtros = [
            'inboxes' => Inbox::all(),
            'estados' => Estado::all(),
            'tipos' => TipoTicket::all(),
            'entidades' => Entidade::all(),
        ];

        return view('admin.tickets.index', compact('tickets', 'filtros'));
    }

    public function create()
    {
        $entidades = Entidade::all();
        $contactos = Contacto::all();
        $inboxes = Inbox::all();
        $estados = Estado::all();
        $tipos = TipoTicket::all();

        return view('admin.tickets.create', compact('entidades', 'contactos', 'inboxes', 'estados', 'tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'assunto' => 'required|max:255',
            'tipo_id' => 'required|exists:tipos_ticket,id',
            'mensagem' => 'required',
            'estado_id' => 'required|exists:estados,id',
            'entidade_id' => 'required|exists:entidades,id',
            'contacto_criador_id' => 'required|exists:contactos,id',
            'inbox_id' => 'required|exists:inboxes,id',
            'conhecimento' => 'nullable|array',
            'conhecimento.*' => 'email',
        ]);

        DB::beginTransaction();
        try {
            // Criar ticket
            $ticket = Ticket::create([
                'assunto' => $request->assunto,
                'tipo_id' => $request->tipo_id,
                'mensagem' => $request->mensagem,
                'estado_id' => $request->estado_id,
                'operador_associado_id' => $request->operador_associado_id,
                'entidade_id' => $request->entidade_id,
                'contacto_criador_id' => $request->contacto_criador_id,
                'inbox_id' => $request->inbox_id,
            ]);

            // Salvar conhecimentos (CC)
            if ($request->conhecimento) {
                foreach ($request->conhecimento as $email) {
                    TicketConhecimento::create([
                        'ticket_id' => $ticket->id,
                        'email' => $email
                    ]);
                }
            }

            // Registrar atividade
            AtividadeTicket::create([
                'ticket_id' => $ticket->id,
                'acao' => 'criado',
                'dados_novos' => $ticket->toArray(),
                'user_id' => auth()->id(),
            ]);

            // Enviar notificações
            $this->enviarNotificacoesNovoTicket($ticket);

            DB::commit();

            return redirect()->route('admin.tickets.index')
                ->with('success', "Ticket {$ticket->numero_ticket} criado com sucesso!");
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro ao criar ticket: ' . $e->getMessage());
        }
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['respostas.user', 'respostas.contacto', 'atividades', 'conhecimentos']);
        return view('admin.tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $entidades = Entidade::all();
        $contactos = Contacto::all();
        $inboxes = Inbox::all();
        $estados = Estado::all();
        $tipos = TipoTicket::all();

        return view('admin.tickets.edit', compact('ticket', 'entidades', 'contactos', 'inboxes', 'estados', 'tipos'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'assunto' => 'required|max:255',
            'tipo_id' => 'required|exists:tipos_ticket,id',
            'estado_id' => 'required|exists:estados,id',
            'entidade_id' => 'required|exists:entidades,id',
            'contacto_criador_id' => 'required|exists:contactos,id',
            'inbox_id' => 'required|exists:inboxes,id',
        ]);

        $oldData = $ticket->toArray();

        $ticket->update([
            'assunto' => $request->assunto,
            'tipo_id' => $request->tipo_id,
            'estado_id' => $request->estado_id,
            'operador_associado_id' => $request->operador_associado_id,
            'entidade_id' => $request->entidade_id,
            'contacto_criador_id' => $request->contacto_criador_id,
            'inbox_id' => $request->inbox_id,
        ]);

        // Registrar atividade
        AtividadeTicket::create([
            'ticket_id' => $ticket->id,
            'acao' => 'atualizado',
            'dados_antigos' => $oldData,
            'dados_novos' => $ticket->toArray(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.tickets.index')
            ->with('success', "Ticket {$ticket->numero_ticket} atualizado!");
    }

    public function destroy(Ticket $ticket)
    {
        $numero = $ticket->numero_ticket;
        $ticket->delete();

        return redirect()->route('admin.tickets.index')
            ->with('success', "Ticket {$numero} removido!");
    }

    public function responder(Request $request, Ticket $ticket)
    {
        $request->validate([
            'mensagem' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // Criar resposta
            $resposta = Resposta::create([
                'ticket_id' => $ticket->id,
                'user_id' => auth()->id(),
                'mensagem' => $request->mensagem,
            ]);

            // Registrar atividade
            AtividadeTicket::create([
                'ticket_id' => $ticket->id,
                'acao' => 'respondido',
                'dados_novos' => ['resposta_id' => $resposta->id],
                'user_id' => auth()->id(),
            ]);

            // Enviar notificações da resposta
            $this->enviarNotificacoesResposta($ticket, $resposta);

            DB::commit();

            return back()->with('success', 'Resposta enviada com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro ao enviar resposta: ' . $e->getMessage());
        }
    }

    private function enviarNotificacoesNovoTicket(Ticket $ticket)
    {
        $emails = [];

        // Criador do ticket
        $emails[] = $ticket->contacto->email;

        // Operador associado
        if ($ticket->operador_associado_id) {
            $emails[] = $ticket->operador->email;
        }

        // Emails em conhecimento
        foreach ($ticket->conhecimentos as $conhecimento) {
            $emails[] = $conhecimento->email;
        }

        $emails = array_unique($emails);

        foreach ($emails as $email) {
            try {
                Mail::to($email)->send(new NovoTicketMail($ticket));
            } catch (\Exception $e) {
                // Log do erro
                \Log::error("Erro ao enviar email para {$email}: " . $e->getMessage());
            }
        }
    }

    private function enviarNotificacoesResposta(Ticket $ticket, Resposta $resposta)
    {
        $emails = [];

        // Criador do ticket
        $emails[] = $ticket->contacto->email;

        // Operador associado
        if ($ticket->operador_associado_id) {
            $emails[] = $ticket->operador->email;
        }

        // Emails em conhecimento
        foreach ($ticket->conhecimentos as $conhecimento) {
            $emails[] = $conhecimento->email;
        }

        // Remover quem respondeu
        $emails = array_diff($emails, [auth()->user()->email]);
        $emails = array_unique($emails);

        foreach ($emails as $email) {
            try {
                Mail::to($email)->send(new RespostaTicketMail($ticket, $resposta));
            } catch (\Exception $e) {
                \Log::error("Erro ao enviar email para {$email}: " . $e->getMessage());
            }
        }
    }
}
