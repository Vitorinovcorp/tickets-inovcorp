<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Entidade;
use App\Models\Contacto;
use App\Models\Estado;
use App\Models\Inbox;
use App\Models\TipoTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ==========================================
        // CARDS PRINCIPAIS
        // ==========================================
        
        $totalTickets = Ticket::count();
        $totalEntidades = Entidade::count();
        $totalContactos = Contacto::count();
        $totalInboxes = Inbox::count();
        
        // Tickets por estado
        $estadoAberto = Estado::where('nome', 'Aberto')->first();
        $estadoTratamento = Estado::where('nome', 'Em Tratamento')->first();
        $estadoFechado = Estado::where('nome', 'Fechado')->first();
        
        $ticketsAbertos = $estadoAberto ? Ticket::where('estado_id', $estadoAberto->id)->count() : 0;
        $ticketsEmTratamento = $estadoTratamento ? Ticket::where('estado_id', $estadoTratamento->id)->count() : 0;
        $ticketsFechados = $estadoFechado ? Ticket::where('estado_id', $estadoFechado->id)->count() : 0;
        
        $percentualConclusao = $totalTickets > 0 ? round(($ticketsFechados / $totalTickets) * 100) : 0;
        
        // ==========================================
        // GRÁFICO DE TICKETS POR MÊS
        // ==========================================
        
        $ticketsPorMes = Ticket::select(
                DB::raw('YEAR(created_at) as ano'),
                DB::raw('MONTH(created_at) as mes'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('ano', 'mes')
            ->orderBy('ano', 'asc')
            ->orderBy('mes', 'asc')
            ->get()
            ->map(function($item) {
                $data = \Carbon\Carbon::create($item->ano, $item->mes, 1);
                return [
                    'mes' => $data->format('M/Y'),
                    'total' => $item->total,
                ];
            });
        
        // ==========================================
        // TICKETS POR DEPARTAMENTO
        // ==========================================
        
        $ticketsPorInbox = Inbox::withCount('tickets')
            ->having('tickets_count', '>', 0)
            ->orderBy('tickets_count', 'desc')
            ->get();
        
        // ==========================================
        // TICKETS POR TIPO
        // ==========================================
        
        $ticketsPorTipo = DB::table('tipos_ticket')
            ->leftJoin('tickets', 'tipos_ticket.id', '=', 'tickets.tipo_id')
            ->select('tipos_ticket.id', 'tipos_ticket.nome', DB::raw('COUNT(tickets.id) as tickets_count'))
            ->groupBy('tipos_ticket.id', 'tipos_ticket.nome')
            ->having('tickets_count', '>', 0)
            ->orderBy('tickets_count', 'desc')
            ->get();
        
        // ==========================================
        // ÚLTIMOS TICKETS
        // ==========================================
        
        $ultimosTickets = Ticket::with(['entidade', 'estado', 'inbox', 'tipo', 'contacto'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // ==========================================
        // TICKETS POR DIA
        // ==========================================
        
        $ticketsPorDia = Ticket::select(
                DB::raw('DATE(created_at) as data'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('data')
            ->orderBy('data', 'asc')
            ->get()
            ->map(function($item) {
                return [
                    'data' => \Carbon\Carbon::parse($item->data)->format('d/m'),
                    'total' => $item->total
                ];
            });
        
        // Compartilhar totalTickets com a view
        view()->share('totalTickets', $totalTickets);
        
        return view('admin.dashboard', compact(
            'totalTickets',
            'totalEntidades',
            'totalContactos',
            'totalInboxes',
            'ticketsAbertos',
            'ticketsEmTratamento',
            'ticketsFechados',
            'percentualConclusao',
            'ticketsPorMes',
            'ticketsPorInbox',
            'ticketsPorTipo',
            'ultimosTickets',
            'ticketsPorDia'
        ));
    }
}