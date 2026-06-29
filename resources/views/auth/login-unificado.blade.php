<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tickets Inovcorp</title>
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
        .login-card {
            max-width: 420px;
            width: 100%;
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .login-card .logo {
            text-align: center;
            font-size: 50px;
            margin-bottom: 10px;
        }
        .login-card h2 {
            text-align: center;
            font-weight: 700;
            color: #1a1a2e;
            font-size: 1.5rem;
        }
        .login-card .subtitle {
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 25px;
        }
        .login-card .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: border-color 0.3s;
        }
        .login-card .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }
        .login-card .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: transform 0.2s;
        }
        .login-card .btn-primary:hover {
            transform: translateY(-2px);
        }
        .login-card .btn-primary i {
            margin-right: 8px;
        }
        .login-card .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            color: #333;
        }
        .login-card .register-link {
            text-align: center;
            margin-top: 15px;
        }
        .login-card .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }
        .login-card .register-link a:hover {
            text-decoration: underline;
        }
        .alert-flash {
            border-radius: 10px;
            border: none;
            padding: 12px 15px;
        }
        .tipo-usuario {
            text-align: center;
            margin-top: 10px;
            font-size: 0.85rem;
            color: #6c757d;
        }
        .tipo-usuario span {
            display: inline-block;
            padding: 2px 12px;
            border-radius: 20px;
            font-weight: 500;
        }
        .tipo-usuario .admin-tag {
            background: #e9ecef;
            color: #495057;
        }
        .tipo-usuario .cliente-tag {
            background: #d1e7dd;
            color: #0f5132;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Tickets Inovcorp</h2>
        <p class="subtitle">Faça login para continuar</p>

        @if($errors->any())
            <div class="alert alert-danger alert-flash alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('success'))
            <div class="alert alert-success alert-flash alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('login.unificado.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       placeholder="seu@email.com" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" name="password" id="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       placeholder="••••••••" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i> Entrar
            </button>
            
            <div class="tipo-usuario">
                <span class="admin-tag"> Admin</span>
                <span class="cliente-tag">Cliente</span>
                <br>
               
            </div>
            
            <div class="register-link">
                <p class="mb-0">É cliente e não tem conta? <a href="{{ route('cliente.register') }}">Registar-se</a></p>
            </div>

            <hr>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>