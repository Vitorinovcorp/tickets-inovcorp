<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tickets Inovcorp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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

        body {
            background: #f0f2f5;
            min-height: 100vh;
        }

        /* ==========================================
           NAVBAR CLIENTE
        ========================================== */
        .navbar-custom {
            background: linear-gradient(135deg, #1a2332 0%, #2c3e6b 50%, #3d5a80 100%);
            padding: 12px 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .navbar-custom .navbar-brand {
            font-weight: 700;
            color: #fff;
            font-size: 1.3rem;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
        }

        .navbar-custom .navbar-brand img {
            height: 35px;
            width: auto;
            margin-right: 10px;
        }

        .navbar-custom .navbar-brand i {
            color: #6b9fc7;
            margin-right: 10px;
        }

        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.7) !important;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 8px 18px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .navbar-custom .nav-link:hover {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.1);
        }

        .navbar-custom .nav-link.active {
            color: #fff !important;
            background: rgba(102, 126, 234, 0.3);
        }

        .navbar-custom .nav-link i {
            margin-right: 8px;
        }

        .navbar-custom .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6b9fc7, #2c3e6b);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            margin-right: 10px;
        }

        .navbar-custom .dropdown-menu {
            background: #1a2332;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .navbar-custom .dropdown-item {
            color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            padding: 10px 18px;
            transition: all 0.2s;
        }

        .navbar-custom .dropdown-item:hover {
            background: rgba(102, 126, 234, 0.2);
            color: #fff;
        }

        .navbar-custom .dropdown-item i {
            margin-right: 10px;
            width: 18px;
        }

        .navbar-custom .dropdown-divider {
            border-color: rgba(255, 255, 255, 0.1);
        }

        .main-content {
            padding: 30px;
        }

        .welcome-banner {
            background: linear-gradient(135deg, #1a2332 0%, #2c3e6b 50%, #3d5a80 100%);
            border-radius: 16px;
            padding: 28px 35px;
            color: #fff;
            margin-bottom: 30px;
            box-shadow: var(--card-shadow);
        }

        .welcome-banner h2 {
            font-weight: 700;
            font-size: 1.6rem;
            margin-bottom: 5px;
        }

        .welcome-banner p {
            opacity: 0.85;
            margin-bottom: 0;
            font-size: 0.95rem;
        }

        .welcome-banner .btn-light {
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            color: #2c3e6b;
            transition: all 0.3s;
            background: #fff;
            border: none;
        }

        .welcome-banner .btn-light:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
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

        .stat-card .stat-footer {
            font-size: 0.7rem;
            opacity: 0.75;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Cores suaves e profissionais - CARDS CLIENTE */
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

        .card-custom {
            border-radius: 16px;
            border: none;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: all 0.3s ease;
            background: #ffffff;
        }

        .card-custom:hover {
            box-shadow: var(--card-hover-shadow);
        }

        .card-custom .card-header {
            background: #fff;
            border-bottom: 1px solid var(--border-light);
            padding: 16px 22px;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-custom .card-header i {
            color: var(--primary-blue);
            margin-right: 10px;
        }

        .card-custom .card-body {
            padding: 18px 22px;
        }

        .ticket-item {
            padding: 12px 0;
            border-bottom: 1px solid var(--border-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.2s ease;
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

        .btn-outline-primary-custom {
            border-radius: 8px;
            padding: 6px 16px;
            font-weight: 500;
            font-size: 0.8rem;
            color: var(--primary-blue);
            border: 1px solid var(--primary-blue);
            background: transparent;
            transition: all 0.3s;
        }

        .btn-outline-primary-custom:hover {
            background: var(--primary-blue);
            color: #fff;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #2c3e6b, #3d5a80);
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            color: #fff;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(44, 62, 107, 0.3);
            color: #fff;
        }

        @media (max-width: 1200px) {
            .stat-card .stat-number {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 992px) {
            .stat-card .stat-number {
                font-size: 1.6rem;
            }

            .stat-card .stat-icon {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .welcome-banner {
                padding: 20px;
            }

            .welcome-banner h2 {
                font-size: 1.3rem;
            }

            .stat-card {
                min-height: 110px;
                padding: 16px 18px;
            }

            .stat-card .stat-number {
                font-size: 1.4rem;
            }

            .stat-card .stat-icon {
                font-size: 1.8rem;
                right: 15px;
                top: 15px;
            }

            .card-custom .card-header {
                padding: 14px 16px;
                font-size: 0.95rem;
                flex-wrap: wrap;
                gap: 10px;
            }

            .card-custom .card-body {
                padding: 14px 16px;
            }

            .ticket-item {
                flex-wrap: wrap;
                gap: 8px;
            }
        }

        @media (max-width: 576px) {
            .stat-card {
                min-height: 100px;
                padding: 14px 16px;
            }

            .stat-card .stat-number {
                font-size: 1.2rem;
            }

            .stat-card .stat-label {
                font-size: 0.65rem;
            }

            .stat-card .stat-icon {
                font-size: 1.5rem;
                right: 12px;
                top: 12px;
            }

            .welcome-banner .btn-light {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('cliente.dashboard') }}">
                <img src="{{ asset('images/inovcorp-logo.png') }}" alt="Inovcorp" style="height: 35px; width: auto; margin-right: 10px;">
                Tickets Inovcorp
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('cliente.dashboard') }}">
                            <i class="fas fa-chart-pie"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cliente.tickets.index') }}">
                            <i class="fas fa-ticket"></i> Meus Tickets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cliente.tickets.create') }}">
                            <i class="fas fa-plus"></i> Novo Ticket
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <span class="user-avatar">{{ substr($contacto->nome ?? 'U', 0, 1) }}</span>
                            <span class="d-none d-md-inline">{{ $contacto->nome ?? 'Usuário' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user"></i> Meu Perfil
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Sair
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ==========================================
    CONTEÚDO PRINCIPAL
    ========================================== -->
    <div class="main-content">
        <div class="container-fluid">

            <!-- ==========================================
            BANNER DE BOAS-VINDAS
            ========================================== -->
            <div class="welcome-banner">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>Olá, {{ $contacto->nome ?? 'Cliente' }}!</h2>
                        <p>Bem-vindo à sua área de cliente. Acompanhe abaixo o resumo dos seus tickets.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="{{ route('cliente.tickets.create') }}" class="btn btn-light">
                            <i class="fas fa-plus me-2"></i> Novo Ticket
                        </a>
                    </div>
                </div>
            </div>

            <!-- ==========================================
            CARDS ESTATÍSTICOS
            ========================================== -->
            <div class="row g-4 mb-4">
                <!-- Total Tickets -->
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="stat-card stat-card-primary">
                        <div class="stat-icon"><i class="fas fa-ticket-alt"></i></div>
                        <div class="stat-label">Total Tickets</div>
                        <div class="stat-number">{{ $totalTickets ?? 0 }}</div>
                        <div class="stat-footer">
                            <i class="fas fa-chart-line me-1"></i> Atualizado agora
                        </div>
                    </div>
                </div>

                <!-- Em Aberto -->
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="stat-card stat-card-warning">
                        <div class="stat-icon"><i class="fas fa-clock"></i></div>
                        <div class="stat-label">Em Aberto</div>
                        <div class="stat-number">{{ $ticketsAbertos ?? 0 }}</div>
                        <div class="stat-footer">
                            <i class="fas fa-hourglass-half me-1"></i> Aguardando atendimento
                        </div>
                    </div>
                </div>

                <!-- Em Tratamento -->
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="stat-card stat-card-info">
                        <div class="stat-icon"><i class="fas fa-spinner"></i></div>
                        <div class="stat-label">Em Tratamento</div>
                        <div class="stat-number">{{ $ticketsEmTratamento ?? 0 }}</div>
                        <div class="stat-footer">
                            <i class="fas fa-user-cog me-1"></i> Em andamento
                        </div>
                    </div>
                </div>

                <!-- Fechados -->
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="stat-card stat-card-success">
                        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-label">Fechados</div>
                        <div class="stat-number">{{ $ticketsFechados ?? 0 }}</div>
                        <div class="stat-footer">
                            <i class="fas fa-check me-1"></i> Concluídos
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==========================================
            ÚLTIMOS TICKETS
            ========================================== -->
            <div class="card-custom">
                <div class="card-header">
                    <span>
                        <i class="fas fa-list"></i> Últimos Tickets
                    </span>
                    <a href="{{ route('cliente.tickets.index') }}" class="btn-outline-primary-custom">
                        Ver todos <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body">
                    @if(isset($ultimosTickets) && $ultimosTickets->count() > 0)
                    @foreach($ultimosTickets as $ticket)
                    <div class="ticket-item">
                        <div>
                            <div class="ticket-number">{{ $ticket->numero_ticket }}</div>
                            <div class="ticket-subject">{{ $ticket->assunto }}</div>
                            <div class="ticket-meta">
                                <i class="far fa-calendar-alt me-1"></i> {{ $ticket->created_at->format('d/m/Y H:i') }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-inbox me-1"></i> {{ $ticket->inbox->nome ?? 'N/A' }}
                            </div>
                        </div>
                        <div class="text-end">
                            @php
                            $estadoNome = $ticket->estado->nome ?? 'Sem estado';
                            $estadoClass = 'badge-status';
                            if ($estadoNome == 'Aberto') $estadoClass .= ' badge-status-aberto';
                            elseif ($estadoNome == 'Em Tratamento') $estadoClass .= ' badge-status-tratamento';
                            elseif ($estadoNome == 'Fechado') $estadoClass .= ' badge-status-fechado';
                            @endphp
                            <span class="{{ $estadoClass }}">{{ $estadoNome }}</span>
                            <a href="{{ route('cliente.tickets.show', $ticket) }}" class="btn-outline-primary-custom ms-2">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3 d-block" style="color: #6b7a8f !important;"></i>
                        <h5 class="text-muted" style="color: #6b7a8f !important;">Nenhum ticket encontrado</h5>
                        <p class="text-muted" style="color: #6b7a8f !important;">Comece criando seu primeiro ticket.</p>
                        <a href="{{ route('cliente.tickets.create') }}" class="btn-primary-custom mt-2">
                            <i class="fas fa-plus me-2"></i> Criar primeiro ticket
                        </a>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>