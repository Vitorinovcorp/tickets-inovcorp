<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Entidade;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $contacto = Auth::guard('contacto')->user();
        $entidades = $contacto->entidades()->pluck('id');
        

        // Totais
        $totalTickets = Ticket::whereIn('entidade_id', $entidades)->count();
        $ticketsAbertos = Ticket::whereIn('entidade_id', $entidades)
            ->whereHas('estado', function ($q) {
                $q->where('nome', 'Aberto');
            })->count();
        $ticketsEmTratamento = Ticket::whereIn('entidade_id', $entidades)
            ->whereHas('estado', function ($q) {
                $q->where('nome', 'Em Tratamento');
            })->count();
        $ticketsFechados = Ticket::whereIn('entidade_id', $entidades)
            ->whereHas('estado', function ($q) {
                $q->where('nome', 'Fechado');
            })->count();

        // Últimos tickets
        $ultimosTickets = Ticket::with(['estado', 'inbox', 'tipo'])
            ->whereIn('entidade_id', $entidades)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('cliente.dashboard', compact(
            'totalTickets',
            'ticketsAbertos',
            'ticketsEmTratamento',
            'ticketsFechados',
            'ultimosTickets',
            'contacto'
        ));
    }
}
