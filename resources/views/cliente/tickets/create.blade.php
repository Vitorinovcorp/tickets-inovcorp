<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Ticket - Tickets Inovcorp</title>
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
            padding: 25px;
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
        
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: border-color 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }
        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #333;
        }
        
        .input-group-btn {
            border-radius: 10px;
        }
        
        .alert-danger-custom {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
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
                        <a class="nav-link" href="{{ route('cliente.tickets.index') }}">
                            <i class="fas fa-ticket"></i> Meus Tickets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('cliente.tickets.create') }}">
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
                <h2><i class="fas fa-plus-circle"></i> Novo Ticket</h2>
                <a href="{{ route('cliente.tickets.index') }}" class="btn btn-secondary-custom">
                    <i class="fas fa-arrow-left me-2"></i> Voltar
                </a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-danger-custom">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-custom">
                <div class="card-header">
                    <i class="fas fa-pen me-2 text-primary"></i> Preencha os dados do ticket
                </div>
                <div class="card-body">
                    <form action="{{ route('cliente.tickets.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="assunto" class="form-label">Assunto *</label>
                                <input type="text" name="assunto" id="assunto" 
                                       class="form-control @error('assunto') is-invalid @enderror" 
                                       value="{{ old('assunto') }}" required placeholder="Digite o assunto do ticket">
                                @error('assunto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="tipo_id" class="form-label">Tipo *</label>
                                <select name="tipo_id" id="tipo_id" 
                                        class="form-select @error('tipo_id') is-invalid @enderror" required>
                                    <option value="">Selecione...</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ old('tipo_id') == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipo_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="inbox_id" class="form-label">Departamento *</label>
                                <select name="inbox_id" id="inbox_id" 
                                        class="form-select @error('inbox_id') is-invalid @enderror" required>
                                    <option value="">Selecione...</option>
                                    @foreach($inboxes as $inbox)
                                        <option value="{{ $inbox->id }}" {{ old('inbox_id') == $inbox->id ? 'selected' : '' }}>
                                            {{ $inbox->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('inbox_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="entidade_id" class="form-label">Entidade *</label>
                                <select name="entidade_id" id="entidade_id" 
                                        class="form-select @error('entidade_id') is-invalid @enderror" required>
                                    <option value="">Selecione...</option>
                                    @foreach($entidades as $entidade)
                                        <option value="{{ $entidade->id }}" {{ old('entidade_id') == $entidade->id ? 'selected' : '' }}>
                                            {{ $entidade->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('entidade_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="conhecimento" class="form-label">Conhecimento (CC)</label>
                            <div id="conhecimento-container">
                                <div class="input-group mb-2">
                                    <input type="email" name="conhecimento[]" class="form-control" 
                                           placeholder="email@exemplo.com">
                                    <button type="button" class="btn btn-success" onclick="adicionarEmail()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <small class="text-muted">Adicione emails que devem receber cópia</small>
                        </div>

                        <div class="mb-3">
                            <label for="mensagem" class="form-label">Mensagem *</label>
                            <textarea name="mensagem" id="mensagem" 
                                      class="form-control @error('mensagem') is-invalid @enderror" 
                                      rows="8" required placeholder="Descreva detalhadamente o seu problema ou solicitação...">{{ old('mensagem') }}</textarea>
                            @error('mensagem')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="reset" class="btn btn-secondary-custom me-2">Limpar</button>
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-paper-plane me-2"></i> Enviar Ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function adicionarEmail() {
            const container = document.getElementById('conhecimento-container');
            const div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `
                <input type="email" name="conhecimento[]" class="form-control" placeholder="email@exemplo.com">
                <button type="button" class="btn btn-danger" onclick="removerEmail(this)">
                    <i class="fas fa-times"></i>
                </button>
            `;
            container.appendChild(div);
        }

        function removerEmail(button) {
            button.closest('.input-group').remove();
        }
    </script>
</body>
</html>