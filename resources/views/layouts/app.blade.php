<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tickets Inovcorp') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            padding: 12px 0;
        }

        .navbar-custom .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: -0.5px;
            color: #fff;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .navbar-custom .navbar-brand:hover {
            color: #667eea;
            transform: scale(1.02);
        }

        .navbar-custom .navbar-brand img {
            height: 35px;
            width: auto;
            margin-right: 10px;
        }

        .navbar-custom .navbar-brand i {
            margin-right: 8px;
        }

        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.7) !important;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
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
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .navbar-custom .dropdown-item {
            color: rgba(255, 255, 255, 0.7);
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
            border-color: rgba(255, 255, 255, 0.1);
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
            color: rgba(255, 255, 255, 0.9);
        }

        .navbar-custom .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.2);
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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 15px 20px;
        }

        .anexo-card {
            transition: transform 0.2s;
            cursor: default;
        }

        .anexo-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .anexo-card .card-body {
            padding: 15px;
        }

        .anexo-card .icon {
            font-size: 2.5rem;
        }

        .footer-custom {
            background: linear-gradient(135deg, #1a2332 0%, #2c3e6b 100%);
            color: rgba(255, 255, 255, 0.8);
            padding: 50px 0 0;
            margin-top: 40px;
            border-top: 3px solid #667eea;
        }

        .footer-custom .footer-brand {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .footer-custom .footer-logo {
            height: 40px;
            width: auto;
            margin-right: 12px;
        }

        .footer-custom .footer-brand-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.5px;
        }

        .footer-custom .footer-description {
            font-size: 0.9rem;
            line-height: 1.6;
            opacity: 0.8;
            margin-bottom: 20px;
            max-width: 350px;
        }

        .footer-custom .footer-title {
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 18px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-custom .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 30px;
            height: 2px;
            background: #667eea;
        }

        .footer-custom .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-custom .footer-links li {
            margin-bottom: 10px;
        }

        .footer-custom .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .footer-custom .footer-links a i {
            font-size: 0.6rem;
            margin-right: 8px;
            transition: transform 0.3s ease;
        }

        .footer-custom .footer-links a:hover {
            color: #667eea;
            transform: translateX(5px);
        }

        .footer-custom .footer-links a:hover i {
            transform: translateX(3px);
        }

        .footer-custom .footer-social {
            display: flex;
            gap: 10px;
        }

        .footer-custom .social-link {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .footer-custom .social-link:hover {
            background: #667eea;
            transform: translateY(-3px);
            color: #fff;
        }

        .footer-custom .footer-contact {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-custom .footer-contact li {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .footer-custom .footer-contact li i {
            width: 28px;
            font-size: 1rem;
            color: #667eea;
        }

        .footer-custom .footer-contact li span {
            color: rgba(255, 255, 255, 0.8);
        }

        .footer-custom .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: 18px 0;
            margin-top: 35px;
        }

        .footer-custom .footer-bottom p {
            font-size: 0.85rem;
            opacity: 0.7;
            margin: 0;
        }

        .footer-custom .footer-bottom a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-custom .footer-bottom a:hover {
            color: #667eea;
        }

        .footer-custom .footer-divider {
            margin: 0 10px;
            opacity: 0.3;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .footer-custom {
                padding: 35px 0 0;
            }

            .footer-custom .footer-description {
                max-width: 100%;
            }

            .footer-custom .footer-title::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .footer-custom .footer-title {
                text-align: center;
            }

            .footer-custom .footer-links {
                text-align: center;
            }

            .footer-custom .footer-links a {
                justify-content: center;
            }

            .footer-custom .footer-social {
                justify-content: center;
            }

            .footer-custom .footer-contact li {
                justify-content: center;
            }

            .footer-custom .footer-bottom .text-md-end {
                text-align: center !important;
                margin-top: 8px;
            }

            .footer-custom .footer-brand {
                justify-content: center;
            }
        }

        @media (max-width: 991px) {
            .navbar-custom .navbar-collapse {
                background: rgba(0, 0, 0, 0.3);
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

            .navbar-custom .navbar-brand img {
                height: 28px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/inovcorp-logo.png') }}" alt="Inovcorp">
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
                            <li>
                                <hr class="dropdown-divider">
                            </li>
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
    @include('partials.footer')
</body>

</html>