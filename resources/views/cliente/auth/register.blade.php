<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo Cliente - Tickets Inovcorp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .register-card {
            max-width: 500px;
            width: 100%;
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .register-card .logo {
            text-align: center;
            font-size: 50px;
            margin-bottom: 10px;
        }
        .register-card h2 {
            text-align: center;
            font-weight: 700;
            color: #1a1a2e;
            font-size: 1.5rem;
        }
        .register-card .subtitle {
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 25px;
        }
        .register-card .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: border-color 0.3s;
        }
        .register-card .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }
        .register-card .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: transform 0.2s;
        }
        .register-card .btn-primary:hover {
            transform: translateY(-2px);
        }
        .register-card .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            color: #333;
        }
        .register-card .login-link {
            text-align: center;
            margin-top: 15px;
        }
        .register-card .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }
        .alert-flash {
            border-radius: 10px;
            border: none;
            padding: 12px 15px;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="logo">🎫</div>
        <h2>Criar Conta</h2>
        <p class="subtitle">Registe-se para acessar a área do cliente</p>

        @if($errors->any())
            <div class="alert alert-danger alert-flash">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cliente.register.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label">Nome Completo</label>
                <input type="text" name="nome" id="nome" 
                       class="form-control" placeholder="Seu nome" value="{{ old('nome') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" 
                       class="form-control" placeholder="seu@email.com" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" name="telefone" id="telefone" 
                       class="form-control" placeholder="(+351) 912 345 678" value="{{ old('telefone') }}">
            </div>

            <div class="mb-3">
                <label for="entidade_id" class="form-label">Empresa / Entidade</label>
                <select name="entidade_id" id="entidade_id" class="form-control" required>
                    <option value="">Selecione sua empresa</option>
                    @foreach($entidades as $entidade)
                        <option value="{{ $entidade->id }}" {{ old('entidade_id') == $entidade->id ? 'selected' : '' }}>
                            {{ $entidade->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" name="password" id="password" 
                       class="form-control" placeholder="Mínimo 6 caracteres" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="form-control" placeholder="Confirme sua senha" required>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Criar Conta
            </button>
            
            <div class="login-link">
                <p class="mb-0">Já tem conta? <a href="{{ route('cliente.login') }}">Fazer login</a></p>
            </div>

            <hr>
            <div class="text-center">
                <a href="{{ url('/') }}" class="text-decoration-none text-muted small">
                    <i class="fas fa-arrow-left me-1"></i> Voltar para o site
                </a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>