@extends('layouts.app')

@section('title', 'Dashboard - Tickets Inovcorp')

@section('styles')
<style>
    .stat-card {
        border-radius: 12px;
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .stat-card .stat-icon {
        font-size: 2.5rem;
        opacity: 0.7;
    }
    .stat-card .stat-number {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
    }
    .stat-card .stat-label {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        opacity: 0.8;
    }
    .stat-card .stat-progress {
        height: 4px;
        margin-top: 10px;
    }
    .card-dashboard {
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: box-shadow 0.2s;
    }
    .card-dashboard:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    .card-dashboard .card-header {
        background: transparent;
        border-bottom: 1px solid rgba(0,0,0,0.06);
        padding: 15px 20px;
        font-weight: 600;
    }
    .card-dashboard .card-body {
        padding: 20px;
    }
    .progress-bar-custom {
        border-radius: 10px;
        height: 8px;
    }
    .ticket-item {
        padding: 12px 15px;
        border-bottom: 1px solid #f0f0f0;
        transition: background 0.2s;
    }
    .ticket-item:hover {
        background: #f8f9fa;
    }
    .ticket-item:last-child {
        border-bottom: none;
    }
    .badge-status {
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.75rem;
    }
    .chart-container {
        height: 250px;
        position: relative;
    }
    .bar-chart {
        display: flex;
        align-items: flex-end;
        height: 180px;
        gap: 8px;
        padding-top: 10px;
    }
    .bar-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }
    .bar {
        width: 100%;
        max-width: 40px;
        border-radius: 4px 4px 0 0;
        transition: height 0.5s ease;
        min-height: 4px;
    }
    .bar-label {
        font-size: 0.7rem;
        color: #6c757d;
        text-align: center;
    }
    .bar-value {
        font-size: 0.75rem;
        font-weight: 600;
        color: #495057;
    }
    .inbox-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .inbox-item:last-child {
        border-bottom: none;
    }
    .inbox-name {
        font-weight: 500;
    }
    .inbox-count {
        background: #e9ecef;
        padding: 2px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .greeting-text {
        font-size: 1.1rem;
        color: #6c757d;
    }
    .greeting-name {
        color: #2c3e50;
        font-weight: 600;
    }
    .welcome-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        padding: 25px 30px;
        color: white;
        margin-bottom: 25px;
    }
    .welcome-banner h4 {
        margin: 0;
        font-weight: 600;
    }
    .welcome-banner p {
        margin: 5px 0 0 0;
        opacity: 0.9;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    
    <!-- ==========================================
    BANNER DE BOAS-VINDAS
    ========================================== -->
    <div class="welcome-banner">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4>👋 Olá, {{ Auth::user()->name }}!</h4>
                <p>Bem-vindo ao painel de controle do Tickets Inovcorp. Acompanhe abaixo o resumo do seu sistema.</p>
            </div>
            <div class="col-md-4 text-end">
                <span class="badge bg-light text-dark px-4 py-2">
                    <i class="fas fa-calendar-alt me-2"></i> {{ now()->format('d/m/Y H:i') }}
                </span>
            </div>
        </div>
    </div>

    <!-- ==========================================
    CARDS ESTATÍSTICOS
    ========================================== -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card bg-primary text-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label mb-0">Total Tickets</p>
                        <p class="stat-number">{{ $totalTickets }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                </div>
                <div class="stat-progress bg-white bg-opacity-25 rounded">
                    <div class="progress-bar bg-white rounded" style="width: 100%; height: 4px;"></div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card bg-warning text-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label mb-0">Em Aberto</p>
                        <p class="stat-number">{{ $ticketsAbertos }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div class="stat-progress bg-white bg-opacity-25 rounded">
                    <div class="progress-bar bg-white rounded" style="width: {{ $totalTickets > 0 ? ($ticketsAbertos / $totalTickets) * 100 : 0 }}%; height: 4px;"></div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card bg-info text-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label mb-0">Em Tratamento</p>
                        <p class="stat-number">{{ $ticketsEmTratamento }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
                <div class="stat-progress bg-white bg-opacity-25 rounded">
                    <div class="progress-bar bg-white rounded" style="width: {{ $totalTickets > 0 ? ($ticketsEmTratamento / $totalTickets) * 100 : 0 }}%; height: 4px;"></div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card bg-success text-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label mb-0">Fechados</p>
                        <p class="stat-number">{{ $ticketsFechados }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="stat-progress bg-white bg-opacity-25 rounded">
                    <div class="progress-bar bg-white rounded" style="width: {{ $percentualConclusao }}%; height: 4px;"></div>
                </div>
                <small class="d-block mt-1 text-white-50">Taxa de conclusão: {{ $percentualConclusao }}%</small>
            </div>
        </div>
    </div>

    <!-- ==========================================
    CARDS SECUNDÁRIOS
    ========================================== -->
    <div class="row g-4 mb-4">
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="stat-card bg-secondary bg-opacity-10 text-dark p-3 border">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label text-muted mb-0">Entidades</p>
                        <p class="stat-number">{{ $totalEntidades }}</p>
                    </div>
                    <div class="stat-icon text-secondary">
                        <i class="fas fa-building"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="stat-card bg-secondary bg-opacity-10 text-dark p-3 border">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label text-muted mb-0">Contactos</p>
                        <p class="stat-number">{{ $totalContactos }}</p>
                    </div>
                    <div class="stat-icon text-secondary">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="stat-card bg-secondary bg-opacity-10 text-dark p-3 border">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label text-muted mb-0">Departamentos</p>
                        <p class="stat-number">{{ $totalInboxes }}</p>
                    </div>
                    <div class="stat-icon text-secondary">
                        <i class="fas fa-inbox"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==========================================
    GRÁFICOS E ANÁLISES
    ========================================== -->
    <div class="row g-4 mb-4">
        <!-- Gráfico de Tickets por Mês -->
        <div class="col-lg-8">
            <div class="card card-dashboard">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-2 text-primary"></i>
                    Tickets por Mês (Últimos 6 meses)
                </div>
                <div class="card-body">
                    @if($ticketsPorMes->count() > 0)
                        <div class="bar-chart">
                            @php
                                $max = $ticketsPorMes->max('total') ?: 1;
                            @endphp
                            @foreach($ticketsPorMes as $item)
                                <div class="bar-item">
                                    <div class="bar-value">{{ $item['total'] }}</div>
                                    <div class="bar" style="height: {{ ($item['total'] / $max) * 150 }}px; background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);"></div>
                                    <div class="bar-label">{{ $item['mes'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-chart-bar fa-2x mb-2 d-block"></i>
                            <p>Nenhum dado disponível para gráfico.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tickets por Tipo -->
        <div class="col-lg-4">
            <div class="card card-dashboard">
                <div class="card-header">
                    <i class="fas fa-tags me-2 text-info"></i>
                    Tickets por Tipo
                </div>
                <div class="card-body">
                    @if($ticketsPorTipo->count() > 0)
                        @foreach($ticketsPorTipo as $tipo)
                            <div class="inbox-item">
                                <span class="inbox-name">{{ $tipo->nome }}</span>
                                <span class="inbox-count">{{ $tipo->tickets_count }}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-3 text-muted">
                            <p>Nenhum ticket cadastrado.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ==========================================
    TICKETS POR DEPARTAMENTO E ÚLTIMOS TICKETS
    ========================================== -->
    <div class="row g-4 mb-4">
        <!-- Tickets por Departamento -->
        <div class="col-lg-4">
            <div class="card card-dashboard">
                <div class="card-header">
                    <i class="fas fa-inbox me-2 text-warning"></i>
                    Tickets por Departamento
                </div>
                <div class="card-body">
                    @if($ticketsPorInbox->count() > 0)
                        @foreach($ticketsPorInbox as $inbox)
                            <div class="inbox-item">
                                <span class="inbox-name">{{ $inbox->nome }}</span>
                                <span class="inbox-count">{{ $inbox->tickets_count }}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-3 text-muted">
                            <p>Nenhum ticket por departamento.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Últimos Tickets -->
        <div class="col-lg-8">
            <div class="card card-dashboard">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-list me-2 text-success"></i>
                        Últimos Tickets
                    </span>
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-sm btn-outline-primary">
                        Ver todos <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    @if($ultimosTickets->count() > 0)
                        @foreach($ultimosTickets as $ticket)
                            <div class="ticket-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="text-primary">{{ $ticket->numero_ticket }}</strong>
                                    <span class="ms-2">{{ Str::limit($ticket->assunto, 40) }}</span>
                                </div>
                                <div>
                                    <span class="badge-status" style="background-color: {{ $ticket->estado->cor ?? '#gray' }}20; color: {{ $ticket->estado->cor ?? '#gray' }}; border: 1px solid {{ $ticket->estado->cor ?? '#gray' }};">
                                        {{ $ticket->estado->nome ?? 'Sem estado' }}
                                    </span>
                                    <span class="badge bg-light text-dark ms-1">
                                        {{ $ticket->inbox->nome ?? 'N/A' }}
                                    </span>
                                    <small class="text-muted ms-2">
                                        {{ $ticket->created_at->format('d/m/Y H:i') }}
                                    </small>
                                    <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-sm btn-outline-primary ms-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            <p>Nenhum ticket encontrado.</p>
                            <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i> Criar primeiro ticket
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ==========================================
    TICKETS POR DIA (ÚLTIMOS 7 DIAS)
    ========================================== -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card card-dashboard">
                <div class="card-header">
                    <i class="fas fa-calendar-day me-2 text-danger"></i>
                    Tickets por Dia (Últimos 7 dias)
                </div>
                <div class="card-body">
                    @if($ticketsPorDia->count() > 0)
                        <div class="row">
                            @php
                                $max = $ticketsPorDia->max('total') ?: 1;
                            @endphp
                            @foreach($ticketsPorDia as $item)
                                <div class="col text-center">
                                    <div class="bar-item">
                                        <div class="bar-value">{{ $item['total'] }}</div>
                                        <div class="bar" style="height: {{ ($item['total'] / $max) * 80 }}px; background: linear-gradient(180deg, #28a745 0%, #20c997 100%);"></div>
                                        <div class="bar-label">{{ $item['data'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3 text-muted">
                            <p>Nenhum ticket nos últimos 7 dias.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection