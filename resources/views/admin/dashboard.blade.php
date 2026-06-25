@extends('layouts.app')

@section('title', 'Dashboard - Tickets Inovcorp')

@section('styles')
<style>
    :root {
        --primary-dark: #1a2332;
        --primary-blue: #2c3e6b;
        --primary-light: #3d5a80;
        --secondary-blue: #4a7c9e;
        --soft-blue: #6b9fc7;
        --light-bg: #e8edf3;
        --card-shadow: 0 4px 20px rgba(44, 62, 107, 0.08);
        --card-hover-shadow: 0 8px 35px rgba(44, 62, 107, 0.15);
        --border-light: #eef2f7;
        --text-dark: #1a2332;
        --text-muted: #6b7a8f;
    }

    .stat-card {
        border-radius: 16px;
        border: none;
        padding: 20px 22px;
        transition: all 0.3s ease;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
        min-height: 130px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--card-hover-shadow);
    }

    .stat-card .stat-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        opacity: 0.85;
        margin-bottom: 2px;
        font-weight: 500;
    }

    .stat-card .stat-number {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.2;
    }

    .stat-card .stat-icon {
        font-size: 2.5rem;
        opacity: 0.2;
        transition: all 0.3s ease;
        position: absolute;
        right: 20px;
        top: 20px;
    }

    .stat-card:hover .stat-icon {
        opacity: 0.35;
        transform: scale(1.05);
    }

    .stat-card .stat-progress {
        margin-top: 10px;
        width: 100%;
    }

    .stat-card .stat-progress .progress-bar {
        border-radius: 4px;
        height: 4px;
        transition: width 0.8s ease;
        background: rgba(255, 255, 255, 0.3);
    }

    .stat-card .stat-footer {
        font-size: 0.7rem;
        opacity: 0.75;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Cores suaves e profissionais - CARDS PRINCIPAIS */
    .stat-card-primary {
        background: linear-gradient(145deg, #1a2332 0%, #2c3e6b 100%);
        color: #ffffff;
    }

    .stat-card-primary .stat-icon {
        color: #6b9fc7;
    }

    .stat-card-warning {
        background: linear-gradient(145deg, #2c3e6b 0%, #3d5a80 100%);
        color: #ffffff;
    }

    .stat-card-warning .stat-icon {
        color: #8bb8d9;
    }

    .stat-card-info {
        background: linear-gradient(145deg, #3d5a80 0%, #4a7c9e 100%);
        color: #ffffff;
    }

    .stat-card-info .stat-icon {
        color: #a8d0e6;
    }

    .stat-card-success {
        background: linear-gradient(145deg, #1a3a3a 0%, #2d6b5e 100%);
        color: #ffffff;
    }

    .stat-card-success .stat-icon {
        color: #7ecfc0;
    }

    .stat-card-secondary {
        background: #ffffff;
        color: var(--text-dark);
        border: 1px solid var(--border-light);
    }

    .stat-card-secondary .stat-label {
        color: var(--text-muted);
    }

    .stat-card-secondary .stat-number {
        color: var(--text-dark);
    }

    .stat-card-secondary .stat-icon {
        color: var(--primary-blue);
    }

    .stat-card-secondary .stat-footer {
        color: var(--text-muted);
    }
    .card-dashboard {
        border-radius: 16px;
        border: none;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        transition: all 0.3s ease;
        background: #ffffff;
    }

    .card-dashboard:hover {
        box-shadow: var(--card-hover-shadow);
    }

    .card-dashboard .card-header {
        background: transparent;
        border-bottom: 1px solid var(--border-light);
        padding: 16px 22px;
        font-weight: 600;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-dashboard .card-header i {
        color: var(--primary-blue);
        font-size: 1.1rem;
    }

    .card-dashboard .card-body {
        padding: 18px 22px;
    }

    .ticket-item {
        padding: 12px 0;
        border-bottom: 1px solid var(--border-light);
        transition: all 0.2s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .ticket-item:hover {
        background: #f8fafc;
        padding-left: 8px;
        padding-right: 8px;
        border-radius: 8px;
    }

    .ticket-item:last-child {
        border-bottom: none;
    }

    .ticket-number {
        font-weight: 600;
        color: var(--primary-blue);
        font-size: 0.9rem;
    }

    .ticket-subject {
        font-size: 0.9rem;
        color: var(--text-dark);
    }

    .ticket-meta {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 2px;
    }

    .badge-status {
        padding: 4px 14px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.75rem;
        display: inline-block;
    }

    .badge-status-aberto {
        background: #fde8e8;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .badge-status-tratamento {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }

    .badge-status-fechado {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .inbox-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid var(--border-light);
        transition: background 0.2s ease;
    }

    .inbox-item:hover {
        background: #f8fafc;
        padding-left: 6px;
        padding-right: 6px;
        border-radius: 8px;
    }

    .inbox-item:last-child {
        border-bottom: none;
    }

    .inbox-name {
        font-weight: 500;
        color: var(--text-dark);
    }

    .inbox-count {
        background: var(--light-bg);
        padding: 2px 14px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--primary-blue);
    }

    .tipo-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid var(--border-light);
    }

    .tipo-item:last-child {
        border-bottom: none;
    }

    .tipo-name {
        font-weight: 500;
        color: var(--text-dark);
    }

    .tipo-count {
        background: var(--light-bg);
        padding: 2px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--primary-blue);
    }

    .bar-chart {
        display: flex;
        align-items: flex-end;
        gap: 12px;
        height: 180px;
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
        max-width: 45px;
        border-radius: 6px 6px 0 0;
        transition: height 0.6s ease;
        min-height: 4px;
        background: linear-gradient(180deg, var(--primary-blue), var(--soft-blue));
    }

    .bar-dia {
        background: linear-gradient(180deg, var(--primary-light), var(--secondary-blue));
    }

    .bar-label {
        font-size: 0.7rem;
        color: var(--text-muted);
        text-align: center;
        font-weight: 500;
    }

    .bar-value {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-dark);
    }
    .welcome-banner {
        background: linear-gradient(135deg, #1a2332 0%, #2c3e6b 50%, #3d5a80 100%);
        border-radius: 16px;
        padding: 25px 30px;
        color: white;
        margin-bottom: 25px;
        box-shadow: var(--card-shadow);
    }

    .welcome-banner h4 {
        margin: 0;
        font-weight: 600;
    }

    .welcome-banner p {
        margin: 5px 0 0 0;
        opacity: 0.85;
    }

    .welcome-banner .btn-light {
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 600;
        color: var(--primary-blue);
        transition: all 0.3s ease;
        background: #ffffff;
        border: none;
    }

    .welcome-banner .btn-light:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
    }

    /* ==========================================
       RESPONSIVIDADE
    ========================================== */
    @media (max-width: 1200px) {
        .bar-chart {
            gap: 8px;
        }

        .bar {
            max-width: 35px;
        }
    }

    @media (max-width: 992px) {
        .stat-card .stat-number {
            font-size: 1.8rem;
        }

        .stat-card .stat-icon {
            font-size: 2rem;
        }

        .bar-chart {
            height: 140px;
            gap: 6px;
        }

        .bar {
            max-width: 30px;
        }
    }

    @media (max-width: 768px) {
        .stat-card {
            min-height: 110px;
            padding: 16px 18px;
        }

        .stat-card .stat-number {
            font-size: 1.6rem;
        }

        .stat-card .stat-icon {
            font-size: 1.8rem;
            right: 15px;
            top: 15px;
        }

        .card-dashboard .card-header {
            padding: 14px 16px;
            font-size: 0.95rem;
        }

        .card-dashboard .card-body {
            padding: 14px 16px;
        }

        .bar-chart {
            height: 120px;
            gap: 4px;
        }

        .bar {
            max-width: 25px;
        }

        .welcome-banner {
            padding: 20px;
        }

        .welcome-banner h4 {
            font-size: 1.2rem;
        }
    }

    @media (max-width: 576px) {
        .stat-card {
            min-height: 100px;
            padding: 14px 16px;
        }

        .stat-card .stat-number {
            font-size: 1.4rem;
        }

        .stat-card .stat-label {
            font-size: 0.65rem;
        }

        .stat-card .stat-icon {
            font-size: 1.5rem;
            right: 12px;
            top: 12px;
        }

        .ticket-item {
            flex-wrap: wrap;
            gap: 8px;
        }

        .bar-chart {
            height: 100px;
        }

        .bar {
            max-width: 20px;
        }

        .bar-label {
            font-size: 0.6rem;
        }

        .bar-value {
            font-size: 0.65rem;
        }
    }
</style>

@section('content')
<div class="container-fluid">

    <div class="welcome-banner">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4>Olá, {{ Auth::user()->name }}!</h4>
                <p>Bem-vindo ao painel de controle do Tickets Inovcorp. Acompanhe abaixo o resumo do seu sistema.</p>
            </div>
            <div class="col-md-4 text-end">
                <span class="badge bg-light text-dark px-4 py-2">
                    <i class="fas fa-calendar-alt me-2"></i> {{ now()->format('d/m/Y H:i') }}
                </span>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Card 1: Total Tickets -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-primary p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label mb-0">Total Tickets</p>
                        <p class="stat-number">{{ $totalTickets }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                </div>
                <div class="stat-progress mt-2">
                    <div class="progress-bar" style="width: 100%; height: 4px; background: rgba(255,255,255,0.3); border-radius: 4px;"></div>
                </div>
            </div>
        </div>

        <!-- Card 2: Em Aberto -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-warning p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label mb-0">Em Aberto</p>
                        <p class="stat-number">{{ $ticketsAbertos }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div class="stat-progress mt-2">
                    <div class="progress-bar" style="width: {{ $totalTickets > 0 ? ($ticketsAbertos / $totalTickets) * 100 : 0 }}%; height: 4px; background: rgba(255,255,255,0.3); border-radius: 4px;"></div>
                </div>
            </div>
        </div>

        <!-- Card 3: Em Tratamento -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-info p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label mb-0">Em Tratamento</p>
                        <p class="stat-number">{{ $ticketsEmTratamento }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
                <div class="stat-progress mt-2">
                    <div class="progress-bar" style="width: {{ $totalTickets > 0 ? ($ticketsEmTratamento / $totalTickets) * 100 : 0 }}%; height: 4px; background: rgba(255,255,255,0.3); border-radius: 4px;"></div>
                </div>
            </div>
        </div>

        <!-- Card 4: Fechados (agora com a mesma estrutura dos outros) -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-success p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="stat-label mb-0">Fechados</p>
                        <p class="stat-number">{{ $ticketsFechados }}</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="stat-progress mt-2">
                    <div class="progress-bar" style="width: {{ $percentualConclusao }}%; height: 4px; background: rgba(255,255,255,0.3); border-radius: 4px;"></div>
                </div>
                <small class="d-block mt-1 text-white-50" style="font-size: 0.7rem; opacity: 0.8;">Taxa de conclusão: {{ $percentualConclusao }}%</small>
            </div>
        </div>
    </div>
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