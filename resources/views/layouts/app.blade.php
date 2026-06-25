<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tickets Inovcorp') }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background: #f4f6f9;
            min-height: 100vh;
        }
        
        .navbar-custom {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            padding: 12px 0;
        }
        .navbar-custom .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: -0.5px;
            color: #fff;
            transition: all 0.3s ease;
        }
        .navbar-custom .navbar-brand:hover {
            color: #667eea;
            transform: scale(1.02);
        }
        .navbar-custom .navbar-brand i {
            margin-right: 8px;
        }
        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.7) !important;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
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
            font-size: 1rem;
        }
        .navbar-custom .nav-link .badge-nav {
            position: absolute;
            top: 2px;
            right: 4px;
            background: #e74c3c;
            color: white;
            font-size: 0.6rem;
            padding: 2px 6px;
            border-radius: 50%;
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
            padding: 8px 16px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }
        .navbar-custom .dropdown-item:hover {
            background: rgba(102, 126, 234, 0.2);
            color: #fff;
        }
        .navbar-custom .dropdown-item i {
            margin-right: 10px;
            width: 18px;
            text-align: center;
        }
        .navbar-custom .dropdown-divider {
            border-color: rgba(255,255,255,0.1);
        }
        .navbar-custom .user-avatar {
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
        .navbar-custom .user-name {
            font-weight: 500;
            color: rgba(255,255,255,0.9);
        }
        .navbar-custom .navbar-toggler {
            border-color: rgba(255,255,255,0.2);
        }
        .navbar-custom .navbar-toggler-icon {
            filter: invert(1);
        }

        .main-content {
            padding: 30px 20px;
        }

        .alert-flash {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            padding: 15px 20px;
        }

        @media (max-width: 991px) {
            .navbar-custom .navbar-collapse {
                background: rgba(0,0,0,0.3);
                border-radius: 12px;
                padding: 15px;
                margin-top: 10px;
            }
            .navbar-custom .nav-link {
                padding: 10px 16px;
            }
        }
        @media (max-width: 768px) {
            .main-content {
                padding: 20px 10px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    
    <!-- ==========================================
    NAVBAR ADMIN
    ========================================== -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-ticket-alt"></i>
                Tickets Inovcorp
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Menu Admin -->
                @auth
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                           href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-chart-pie"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}" 
                           href="{{ route('admin.tickets.index') }}">
                            <i class="fas fa-ticket"></i> Tickets
                            @if($totalTickets ?? 0 > 0)
                                <span class="badge-nav">{{ $totalTickets ?? 0 }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.entidades.*') ? 'active' : '' }}" 
                           href="{{ route('admin.entidades.index') }}">
                            <i class="fas fa-building"></i> Entidades
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.contactos.*') ? 'active' : '' }}" 
                           href="{{ route('admin.contactos.index') }}">
                            <i class="fas fa-users"></i> Contactos
                        </a>
                    </li>
                </ul>
                @endauth
                
                <!-- Menu do Usuário Admin -->
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <span class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            <span class="user-name d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user-cog"></i> Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-bell"></i> Notificações
                                    <span class="badge bg-danger ms-2">0</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="#" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Sair
                                </a>
                                <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- ==========================================
    CONTEÚDO PRINCIPAL
    ========================================== -->
    <div class="container-fluid main-content">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>