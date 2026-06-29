<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tickets Inovcorp - Cliente')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background: #f4f6f9; }
        
        .navbar-cliente {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            padding: 10px 0;
        }
        .navbar-cliente .navbar-brand {
            font-weight: 700;
            color: #fff;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }
        .navbar-cliente .navbar-brand img {
            height: 35px;
            width: auto;
            margin-right: 10px;
        }
        .navbar-cliente .navbar-brand i {
            color: #667eea;
            margin-right: 8px;
        }
        .navbar-cliente .nav-link {
            color: rgba(255,255,255,0.7) !important;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .navbar-cliente .nav-link:hover {
            color: #fff !important;
            background: rgba(255,255,255,0.1);
        }
        .navbar-cliente .nav-link.active {
            color: #fff !important;
            background: rgba(102, 126, 234, 0.3);
        }
        .navbar-cliente .nav-link i {
            margin-right: 8px;
        }
        .navbar-cliente .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            margin-right: 10px;
        }
        .navbar-cliente .dropdown-menu {
            background: #1a1a2e;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 8px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }
        .navbar-cliente .dropdown-item {
            color: rgba(255,255,255,0.7);
            border-radius: 8px;
            padding: 8px 16px;
            transition: all 0.2s;
        }
        .navbar-cliente .dropdown-item:hover {
            background: rgba(102, 126, 234, 0.2);
            color: #fff;
        }
        .navbar-cliente .dropdown-item i {
            margin-right: 10px;
            width: 18px;
        }
        
        .main-content {
            padding: 30px 20px;
            min-height: calc(100vh - 70px);
        }

        .alert-flash {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            padding: 15px 20px;
        }

        @media (max-width: 991px) {
            .navbar-cliente .navbar-collapse {
                background: rgba(0,0,0,0.3);
                border-radius: 12px;
                padding: 15px;
                margin-top: 10px;
            }
        }
        @media (max-width: 768px) {
            .navbar-cliente .navbar-brand img {
                height: 28px;
            }
            .navbar-cliente .navbar-brand {
                font-size: 1rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    
    <!-- Navbar Cliente -->
    <nav class="navbar navbar-expand-lg navbar-cliente">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('cliente.dashboard') }}">
                <img src="{{ asset('images/inovcorp-logo.png') }}" alt="Inovcorp">
                Tickets Inovcorp
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cliente.dashboard') ? 'active' : '' }}" 
                           href="{{ route('cliente.dashboard') }}">
                            <i class="fas fa-chart-pie"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cliente.tickets.*') ? 'active' : '' }}" 
                           href="{{ route('cliente.tickets.index') }}">
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
                            <span class="user-avatar">{{ substr(Auth::guard('contacto')->user()->nome ?? 'U', 0, 1) }}</span>
                            <span class="d-none d-md-inline">{{ Auth::guard('contacto')->user()->nome ?? 'Usuário' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Meu Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
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

    <!-- Conteúdo Principal -->
    <div class="main-content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-flash alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-flash alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    @include('partials.footer')
</body>
</html>