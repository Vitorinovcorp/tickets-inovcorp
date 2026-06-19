<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Resposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with(['inbox', 'estado', 'tipo', 'entidade', 'contacto']);
        
        if ($request->numero_ticket) {
            $query->where('numero_ticket', $request->numero_ticket);
        }
        
        if ($request->entidade_id) {
            $query->where('entidade_id', $request->entidade_id);
        }
        
        if ($request->estado_id) {
            $query->where('estado_id', $request->estado_id);
        }
        
        $tickets = $query->latest()->paginate(20);
        
        return response()->json([
            'success' => true,
            'data' => $tickets,
        ]);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'assunto' => 'required|max:255',
            'tipo_id' => 'required|exists:tipos_ticket,id',
            'mensagem' => 'required',
            'entidade_id' => 'required|exists:entidades,id',
            'contacto_criador_id' => 'required|exists:contactos,id',
            'inbox_id' => 'required|exists:inboxes,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $ticket = Ticket::create($request->all());
        
        return response()->json([
            'success' => true,
            'message' => 'Ticket criado com sucesso!',
            'data' => $ticket,
        ], 201);
    }
    
    public function show(Ticket $ticket)
    {
        return response()->json([
            'success' => true,
            'data' => $ticket->load(['respostas', 'conhecimentos', 'atividades']),
        ]);
    }
    
    public function update(Request $request, Ticket $ticket)
    {
        $validator = Validator::make($request->all(), [
            'estado_id' => 'required|exists:estados,id',
            'operador_associado_id' => 'nullable|exists:users,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $ticket->update($request->only(['estado_id', 'operador_associado_id']));
        
        return response()->json([
            'success' => true,
            'message' => 'Ticket atualizado com sucesso!',
            'data' => $ticket,
        ]);
    }
    
    public function responder(Request $request, Ticket $ticket)
    {
        $validator = Validator::make($request->all(), [
            'mensagem' => 'required',
            'user_id' => 'nullable|exists:users,id',
            'contacto_id' => 'nullable|exists:contactos,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $resposta = Resposta::create([
            'ticket_id' => $ticket->id,
            'user_id' => $request->user_id,
            'contacto_id' => $request->contacto_id,
            'mensagem' => $request->mensagem,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Resposta enviada com sucesso!',
            'data' => $resposta,
        ]);
    }
    
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Ticket removido com sucesso!',
        ]);
    }
}