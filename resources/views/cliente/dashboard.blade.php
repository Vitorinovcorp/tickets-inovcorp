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
        
        body {
            background: #f0f2f5;
            min-height: 100vh;
        }
        
        /* ==========================================
           NAVBAR
        ========================================== */
        .navbar-custom {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            padding: 15px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }
        .navbar-custom .navbar-brand {
            font-weight: 700;
            color: #fff;
            font-size: 1.3rem;
            letter-spacing: -0.5px;
        }
        .navbar-custom .navbar-brand i {
            color: #667eea;
            margin-right: 10px;
        }
        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.7) !important;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 8px 18px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .navbar-custom .nav-link:hover {
            color: #fff !important;
            background: rgba(255,255,255,0.1);
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
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            margin-right: 10px;
        }
        .navbar-custom .dropdown-menu {
            background: #1a1a2e;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 8px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }
        .navbar-custom .dropdown-item {
            color: rgba(255,255,255,0.7);
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
            border-color: rgba(255,255,255,0.1);
        }
        
        /* ==========================================
           CONTEÚDO PRINCIPAL
        ========================================== */
        .main-content {
            padding: 30px;
        }
        
        /* ==========================================
           BANNER DE BOAS-VINDAS
        ========================================== */
        .welcome-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 30px 35px;
            color: #fff;
            margin-bottom: 30px;
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
        }
        .welcome-banner h2 {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 5px;
        }
        .welcome-banner p {
            opacity: 0.9;
            margin-bottom: 0;
            font-size: 1rem;
        }
        .welcome-banner .btn-light {
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            color: #667eea;
            transition: all 0.3s;
        }
        .welcome-banner .btn-light:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        
        /* ==========================================
           CARDS ESTATÍSTICOS
        ========================================== */
        .stat-card {
            border-radius: 16px;
            border: none;
            padding: 20px 25px;
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: relative;
            overflow: hidden;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        .stat-card .stat-icon {
            font-size: 2.5rem;
            opacity: 0.3;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }
        .stat-card .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0;
        }
        .stat-card .stat-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.8;
            margin-bottom: 5px;
        }
        .stat-card .stat-change {
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 8px;
        }
        
        .stat-card-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
        }
        .stat-card-warning {
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: #fff;
        }
        .stat-card-info {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            color: #fff;
        }
        .stat-card-success {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            color: #fff;
        }
        
        /* ==========================================
           CARD DE TICKETS
        ========================================== */
        .card-custom {
            border-radius: 16px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
            transition: all 0.3s;
        }
        .card-custom:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        }
        .card-custom .card-header {
            background: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 18px 25px;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .card-custom .card-body {
            padding: 20px 25px;
        }
        
        .ticket-item {
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .ticket-item:last-child {
            border-bottom: none;
        }
        .ticket-item .ticket-info {
            flex: 1;
        }
        .ticket-item .ticket-number {
            font-weight: 600;
            color: #667eea;
            font-size: 0.9rem;
        }
        .ticket-item .ticket-subject {
            font-size: 0.95rem;
            color: #333;
        }
        .ticket-item .ticket-meta {
            font-size: 0.8rem;
            color: #999;
            margin-top: 3px;
        }
        
        .badge-status {
            padding: 5px 14px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.75rem;
        }
        
        /* ==========================================
           RESPONSIVIDADE
        ========================================== */
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
            .stat-card .stat-number {
                font-size: 1.8rem;
            }
            .stat-card .stat-icon {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    <!-- ==========================================
    NAVBAR
    ========================================== -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('cliente.dashboard') }}">
                <i class="fas fa-ticket-alt"></i> Tickets Inovcorp
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
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
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
                        <h2>👋 Olá, {{ $contacto->nome ?? 'Cliente' }}!</h2>
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
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="stat-card stat-card-primary">
                        <div class="stat-icon"><i class="fas fa-ticket-alt"></i></div>
                        <div class="stat-label">Total Tickets</div>
                        <div class="stat-number">{{ $totalTickets ?? 0 }}</div>
                        <div class="stat-change">
                            <i class="fas fa-clock me-1"></i> Atualizado agora
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="stat-card stat-card-warning">
                        <div class="stat-icon"><i class="fas fa-clock"></i></div>
                        <div class="stat-label">Em Aberto</div>
                        <div class="stat-number">{{ $ticketsAbertos ?? 0 }}</div>
                        <div class="stat-change">
                            <i class="fas fa-hourglass-half me-1"></i> Aguardando resposta
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="stat-card stat-card-info">
                        <div class="stat-icon"><i class="fas fa-spinner"></i></div>
                        <div class="stat-label">Em Tratamento</div>
                        <div class="stat-number">{{ $ticketsEmTratamento ?? 0 }}</div>
                        <div class="stat-change">
                            <i class="fas fa-user-cog me-1"></i> Em andamento
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="stat-card stat-card-success">
                        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-label">Fechados</div>
                        <div class="stat-number">{{ $ticketsFechados ?? 0 }}</div>
                        <div class="stat-change">
                            <i class="fas fa-check me-1"></i> Concluídos
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==========================================
            ÚLTIMOS TICKETS
            ========================================== -->
            <div class="card-custom">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-list me-2 text-primary"></i> Últimos Tickets</span>
                    <a href="{{ route('cliente.tickets.index') }}" class="btn btn-sm btn-outline-primary">
                        Ver todos <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body">
                    @if(isset($ultimosTickets) && $ultimosTickets->count() > 0)
                        @foreach($ultimosTickets as $ticket)
                            <div class="ticket-item">
                                <div class="ticket-info">
                                    <div class="ticket-number">{{ $ticket->numero_ticket }}</div>
                                    <div class="ticket-subject">{{ $ticket->assunto }}</div>
                                    <div class="ticket-meta">
                                        <i class="far fa-calendar-alt me-1"></i> {{ $ticket->created_at->format('d/m/Y H:i') }}
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-inbox me-1"></i> {{ $ticket->inbox->nome ?? 'N/A' }}
                                    </div>
                                </div>
                                <div>
                                    <span class="badge-status" style="background-color: {{ $ticket->estado->cor ?? '#gray' }}20; color: {{ $ticket->estado->cor ?? '#gray' }}; border: 1px solid {{ $ticket->estado->cor ?? '#gray' }};">
                                        {{ $ticket->estado->nome ?? 'Sem estado' }}
                                    </span>
                                    <a href="{{ route('cliente.tickets.show', $ticket) }}" class="btn btn-sm btn-outline-primary ms-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                            <h5 class="text-muted">Nenhum ticket encontrado</h5>
                            <p class="text-muted">Comece criando seu primeiro ticket.</p>
                            <a href="{{ route('cliente.tickets.create') }}" class="btn btn-primary mt-2">
                                <i class="fas fa-plus me-1"></i> Criar primeiro ticket
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