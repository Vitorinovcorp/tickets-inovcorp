<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket {{ $ticket->numero_ticket }} - Tickets Inovcorp</title>
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
            margin-bottom: 25px;
        }
        .card-custom .card-header {
            background: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 18px 25px;
            font-weight: 600;
        }
        .card-custom .card-body {
            padding: 25px;
        }
        
        .badge-status {
            padding: 5px 14px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.75rem;
        }
        
        .msg-box {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .msg-box .msg-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .msg-box .msg-author {
            font-weight: 600;
            color: #333;
        }
        .msg-box .msg-date {
            font-size: 0.8rem;
            color: #999;
        }
        .msg-box .msg-content {
            color: #555;
            line-height: 1.6;
        }
        
        .reply-box {
            background: #fff;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 20px;
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
        
        @media (max-width: 768px) {
            .main-content { padding: 15px; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 15px; }
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
                <h2><i class="fas fa-ticket-alt"></i> Ticket {{ $ticket->numero_ticket }}</h2>
                <div>
                    <a href="{{ route('cliente.tickets.index') }}" class="btn btn-secondary-custom me-2">
                        <i class="fas fa-arrow-left me-2"></i> Voltar
                    </a>
                    <span class="badge-status" style="background-color: {{ $ticket->estado->cor ?? '#gray' }}20; color: {{ $ticket->estado->cor ?? '#gray' }}; border: 1px solid {{ $ticket->estado->cor ?? '#gray' }}; padding: 8px 20px;">
                        <i class="fas fa-circle me-1" style="font-size: 0.6rem;"></i> {{ $ticket->estado->nome ?? 'Sem estado' }}
                    </span>
                </div>
            </div>

            <!-- Detalhes do Ticket -->
            <div class="card-custom">
                <div class="card-header">
                    <i class="fas fa-info-circle me-2 text-primary"></i> {{ $ticket->assunto }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <small class="text-muted">Departamento</small><br>
                            <strong>{{ $ticket->inbox->nome ?? 'N/A' }}</strong>
                        </div>
                        <div class="col-md-4 mb-2">
                            <small class="text-muted">Tipo</small><br>
                            <strong>{{ $ticket->tipo->nome ?? 'N/A' }}</strong>
                        </div>
                        <div class="col-md-4 mb-2">
                            <small class="text-muted">Criado em</small><br>
                            <strong>{{ $ticket->created_at->format('d/m/Y H:i') }}</strong>
                        </div>
                    </div>
                    
                    @if($ticket->conhecimentos->count() > 0)
                        <div class="mt-2">
                            <small class="text-muted">Conhecimento (CC):</small><br>
                            @foreach($ticket->conhecimentos as $conhecimento)
                                <span class="badge bg-info">{{ $conhecimento->email }}</span>
                            @endforeach
                        </div>
                    @endif
                    
                    <hr>
                    
                    <h6 class="fw-bold">Mensagem Inicial</h6>
                    <div class="msg-box">
                        <div class="msg-header">
                            <span class="msg-author">{{ $ticket->contacto->nome ?? 'Cliente' }}</span>
                            <span class="msg-date">{{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="msg-content">
                            {!! nl2br(e($ticket->mensagem)) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Respostas -->
            <div class="card-custom">
                <div class="card-header">
                    <i class="fas fa-comments me-2 text-primary"></i> Respostas ({{ $ticket->respostas->count() }})
                </div>
                <div class="card-body">
                    @forelse($ticket->respostas as $resposta)
                        <div class="msg-box">
                            <div class="msg-header">
                                <span class="msg-author">
                                    <i class="fas fa-user-circle me-1"></i>
                                    {{ $resposta->user->name ?? $resposta->contacto->nome ?? 'Cliente' }}
                                </span>
                                <span class="msg-date">{{ $resposta->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="msg-content">
                                {!! nl2br(e($resposta->mensagem)) !!}
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-comment-slash fa-2x text-muted mb-2 d-block"></i>
                            <p class="text-muted">Nenhuma resposta ainda.</p>
                        </div>
                    @endforelse

                    <!-- Formulário de Resposta -->
                    <hr>
                    <h6 class="fw-bold"><i class="fas fa-reply me-2"></i> Adicionar Resposta</h6>
                    <form action="{{ route('cliente.tickets.responder', $ticket) }}" method="POST">
                        @csrf
                        <div class="reply-box">
                            <div class="mb-3">
                                <textarea name="mensagem" id="mensagem" 
                                          class="form-control" rows="5" required 
                                          placeholder="Digite sua resposta..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-paper-plane me-2"></i> Responder
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>