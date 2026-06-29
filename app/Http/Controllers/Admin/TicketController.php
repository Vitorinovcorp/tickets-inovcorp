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
use App\Models\Anexo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\NovoTicketMail;
use App\Mail\RespostaTicketMail;
use Barryvdh\DomPDF\Facade\Pdf;


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
            //'anexos' => 'nullable|array',
            //'anexos.*' => 'file|max:10240|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx,txt,zip,rar,json,csv',
        ]);

        DB::beginTransaction();
        try {
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

            if ($request->conhecimento) {
                foreach ($request->conhecimento as $email) {
                    TicketConhecimento::create([
                        'ticket_id' => $ticket->id,
                        'email' => $email
                    ]);
                }
            }

            // Salvar anexos
            if ($request->hasFile('anexos')) {
                foreach ($request->file('anexos') as $file) {
                    if ($file->isValid()) {
                        $this->salvarAnexo($file, $ticket->id);
                    }
                }
            }

            AtividadeTicket::create([
                'ticket_id' => $ticket->id,
                'acao' => 'criado',
                'dados_novos' => $ticket->toArray(),
                'user_id' => auth()->id(),
            ]);

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
        $ticket->load([
            'respostas.user',
            'respostas.contacto',
            'respostas.anexos',
            'atividades',
            'conhecimentos',
            'anexos',
            'entidade',
            'inbox',
            'tipo',
            'contacto',
            'operador'
        ]);

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
            $resposta = Resposta::create([
                'ticket_id' => $ticket->id,
                'user_id' => auth()->id(),
                'mensagem' => $request->mensagem,
            ]);

            // Salvar anexo da resposta se houver
            if ($request->hasFile('anexo_resposta')) {
                $file = $request->file('anexo_resposta');
                if ($file->isValid()) {
                    $this->salvarAnexo($file, $ticket->id, $resposta->id);
                }
            }

            AtividadeTicket::create([
                'ticket_id' => $ticket->id,
                'acao' => 'respondido',
                'dados_novos' => ['resposta_id' => $resposta->id],
                'user_id' => auth()->id(),
            ]);

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

        $emails[] = $ticket->contacto->email;

        if ($ticket->operador_associado_id) {
            $emails[] = $ticket->operador->email;
        }

        foreach ($ticket->conhecimentos as $conhecimento) {
            $emails[] = $conhecimento->email;
        }

        $emails = array_unique($emails);

        foreach ($emails as $email) {
            try {
                Mail::to($email)->send(new NovoTicketMail($ticket));
            } catch (\Exception $e) {
                \Log::error("Erro ao enviar email para {$email}: " . $e->getMessage());
            }
        }
    }

    private function enviarNotificacoesResposta(Ticket $ticket, Resposta $resposta)
    {
        $emails = [];

        $emails[] = $ticket->contacto->email;

        if ($ticket->operador_associado_id) {
            $emails[] = $ticket->operador->email;
        }

        foreach ($ticket->conhecimentos as $conhecimento) {
            $emails[] = $conhecimento->email;
        }

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

    private function salvarAnexo($file, $ticketId, $respostaId = null)
    {
        $extensao = $file->getClientOriginalExtension();
        $nomeOriginal = $file->getClientOriginalName();
        $mimeType = $file->getMimeType();
        $tamanho = $file->getSize();

        $nomeArquivo = Str::uuid() . '.' . $extensao;
        $caminho = 'anexos/tickets/' . $ticketId . '/' . $nomeArquivo;

        $file->storeAs('public/' . dirname($caminho), $nomeArquivo);

        return Anexo::create([
            'ticket_id' => $ticketId,
            'resposta_id' => $respostaId,
            'nome_original' => $nomeOriginal,
            'nome_arquivo' => $nomeArquivo,
            'caminho' => $caminho,
            'mime_type' => $mimeType,
            'tamanho' => $tamanho,
            'extensao' => $extensao,
            'uploaded_by' => auth()->id(),
        ]);
    }

    public function export(Ticket $ticket)
    {
        $ticket->load([
            'respostas.user',
            'respostas.contacto',
            'respostas.anexos',
            'atividades',
            'conhecimentos',
            'anexos',
            'entidade',
            'inbox',
            'tipo',
            'contacto',
            'operador'
        ]);

        // Caminho absoluto da imagem para o DomPDF
        $logoPath = public_path('images/inovcorp-logo.png');

        $pdf = Pdf::loadView('admin.tickets.pdf', compact('ticket', 'logoPath'));

        $pdf->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'isPhpEnabled' => true,
        ]);

        return $pdf->download("Ticket_{$ticket->numero_ticket}.pdf");
    }
}
