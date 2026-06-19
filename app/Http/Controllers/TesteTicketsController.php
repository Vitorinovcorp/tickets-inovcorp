<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Inbox;
use App\Models\Estado;
use App\Models\TipoTicket;
use App\Models\Entidade;
use Illuminate\Http\Request;

class TesteTicketsController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['estado', 'inbox', 'entidade', 'tipo'])->get();
        
        $filtros = [
            'inboxes' => Inbox::all(),
            'estados' => Estado::all(),
            'tipos' => TipoTicket::all(),
            'entidades' => Entidade::all(),
        ];
        
        return view('admin.tickets.index', compact('tickets', 'filtros'));
    }
}