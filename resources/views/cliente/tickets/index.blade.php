<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Tickets - Tickets Inovcorp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #f0f2f5; min-height: 100vh; }
        
        .navbar-custom {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            padding: 15px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }
        .navbar-custom .navbar-brand {
            font-weight: 700;
            color: #fff;
            font-size: 1.3rem;
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
        
        .main-content { padding: 30px; }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .page-header h2 {
            font-weight: 700;
            color: #1a1a2e;
        }
        .page-header h2 i {
            color: #667eea;
            margin-right: 10px;
        }
        
        .card-custom {
            border-radius: 16px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .card-custom .card-header {
            background: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 18px 25px;
            font-weight: 600;
        }
        .card-custom .card-body {
            padding: 20px 25px;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            color: #fff;
            transition: all 0.3s;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            color: #fff;
        }
        .btn-secondary-custom {
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .badge-status {
            padding: 5px 14px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.75rem;
        }
        
        .filtro-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .table-custom th {
            font-weight: 600;
            color: #555;
            border-bottom: 2px solid #e9ecef;
            padding: 12px 15px;
        }
        .table-custom td {
            padding: 12px 15px;
            vertical-align: middle;
        }
        .table-custom tr:hover {
            background: #f8f9fa;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        .empty-state i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }
        .empty-state h4 {
            color: #555;
            font-weight: 600;
        }
        .empty-state p {
            color: #999;
        }
        
        @media (max-width: 768px) {
            .main-content { padding: 15px; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 15px; }
            .page-header .btn { width: 100%; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
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
                        <a class="nav-link" href="{{ route('cliente.dashboard') }}">
                            <i class="fas fa-chart-pie"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('cliente.tickets.index') }}">
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
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Meu Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Sair
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTEÚDO -->
    <div class="main-content">
        <div class="container-fluid">
            
            <div class="page-header">
                <h2><i class="fas fa-ticket-alt"></i> Meus Tickets</h2>
                <a href="{{ route('cliente.tickets.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-plus me-2"></i> Novo Ticket
                </a>
            </div>

            <!-- Filtros -->
            <div class="filtro-card">
                <form method="GET" class="row g-3">
                    <div class="col-md-3">
                        <select name="estado_id" class="form-select">
                            <option value="">Todos Estados</option>
                            @foreach($filtros['estados'] as $estado)
                                <option value="{{ $estado->id }}" {{ request('estado_id') == $estado->id ? 'selected' : '' }}>
                                    {{ $estado->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="inbox_id" class="form-select">
                            <option value="">Todos Departamentos</option>
                            @foreach($filtros['inboxes'] as $inbox)
                                <option value="{{ $inbox->id }}" {{ request('inbox_id') == $inbox->id ? 'selected' : '' }}>
                                    {{ $inbox->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" 
                               placeholder="🔍 Pesquisar por Nº ou Assunto..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary-custom w-100">Filtrar</button>
                    </div>
                </form>
            </div>

            <!-- Lista de Tickets -->
            <div class="card-custom">
                <div class="card-body">
                    @if($tickets->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th>Nº Ticket</th>
                                        <th>Assunto</th>
                                        <th>Departamento</th>
                                        <th>Estado</th>
                                        <th>Data</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td><strong class="text-primary">{{ $ticket->numero_ticket }}</strong></td>
                                            <td>{{ $ticket->assunto }}</td>
                                            <td><span class="badge bg-info">{{ $ticket->inbox->nome ?? 'N/A' }}</span></td>
                                            <td>
                                                <span class="badge-status" style="background-color: {{ $ticket->estado->cor ?? '#gray' }}20; color: {{ $ticket->estado->cor ?? '#gray' }}; border: 1px solid {{ $ticket->estado->cor ?? '#gray' }};">
                                                    {{ $ticket->estado->nome ?? 'Sem estado' }}
                                                </span>
                                            </td>
                                            <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('cliente.tickets.show', $ticket) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $tickets->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <h4>Nenhum ticket encontrado</h4>
                            <p>Você ainda não possui tickets. Clique no botão abaixo para criar seu primeiro ticket.</p>
                            <a href="{{ route('cliente.tickets.create') }}" class="btn btn-primary-custom mt-2">
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