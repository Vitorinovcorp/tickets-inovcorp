<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Resposta;
use App\Models\Inbox;
use App\Models\Estado;
use App\Models\TipoTicket;
use App\Models\TicketConhecimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $contacto = Auth::guard('contacto')->user();
        $entidades = $contacto->entidades()->pluck('id');

        $query = Ticket::with(['estado', 'inbox', 'tipo', 'entidade'])
            ->whereIn('entidade_id', $entidades);

        // Filtros
        if ($request->estado_id) {
            $query->where('estado_id', $request->estado_id);
        }
        if ($request->inbox_id) {
            $query->where('inbox_id', $request->inbox_id);
        }
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('numero_ticket', 'LIKE', "%{$search}%")
                  ->orWhere('assunto', 'LIKE', "%{$search}%");
            });
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(20);

        $filtros = [
            'inboxes' => Inbox::all(),
            'estados' => Estado::all(),
        ];

        return view('cliente.tickets.index', compact('tickets', 'filtros'));
    }

    public function create()
    {
        $contacto = Auth::guard('contacto')->user();
        $entidades = $contacto->entidades()->get();
        $inboxes = Inbox::all();
        $tipos = TipoTicket::all();
        $estados = Estado::all();

        return view('cliente.tickets.create', compact(
            'entidades', 'inboxes', 'tipos', 'estados'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'assunto' => 'required|max:255',
            'tipo_id' => 'required|exists:tipos_ticket,id',
            'mensagem' => 'required',
            'entidade_id' => 'required|exists:entidades,id',
            'inbox_id' => 'required|exists:inboxes,id',
            'conhecimento' => 'nullable|array',
            'conhecimento.*' => 'email',
        ]);

        DB::beginTransaction();
        try {
            $contacto = Auth::guard('contacto')->user();

            // Criar ticket
            $ticket = Ticket::create([
                'assunto' => $request->assunto,
                'tipo_id' => $request->tipo_id,
                'mensagem' => $request->mensagem,
                'estado_id' => 1, // Aberto
                'entidade_id' => $request->entidade_id,
                'contacto_criador_id' => $contacto->id,
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

            DB::commit();

            return redirect()->route('cliente.tickets.show', $ticket)
                ->with('success', "Ticket {$ticket->numero_ticket} criado com sucesso!");

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro ao criar ticket: ' . $e->getMessage());
        }
    }

    public function show(Ticket $ticket)
    {
        $contacto = Auth::guard('contacto')->user();
        $entidades = $contacto->entidades()->pluck('id');

        // Verificar se o ticket pertence ao cliente
        if (!$entidades->contains($ticket->entidade_id)) {
            abort(403, 'Você não tem permissão para visualizar este ticket.');
        }

        $ticket->load(['respostas.user', 'respostas.contacto', 'conhecimentos', 'estado', 'inbox', 'tipo']);

        return view('cliente.tickets.show', compact('ticket'));
    }

    public function responder(Request $request, Ticket $ticket)
    {
        $request->validate([
            'mensagem' => 'required',
        ]);

        $contacto = Auth::guard('contacto')->user();

        DB::beginTransaction();
        try {
            $resposta = Resposta::create([
                'ticket_id' => $ticket->id,
                'contacto_id' => $contacto->id,
                'mensagem' => $request->mensagem,
            ]);

            DB::commit();

            return back()->with('success', 'Resposta enviada com sucesso!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro ao enviar resposta: ' . $e->getMessage());
        }
    }
}