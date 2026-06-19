<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tickets - Teste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">📋 LISTA DE TICKETS</h1>
                <hr>
                
                <!-- Debug: Mostrar quantos tickets -->
                <div class="alert alert-info">
                    <strong>Debug:</strong> Total de tickets: {{ $tickets->count() }}
                </div>
                
                @if($tickets->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nº Ticket</th>
                                    <th>Assunto</th>
                                    <th>Departamento</th>
                                    <th>Estado</th>
                                    <th>Entidade</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td><strong>{{ $ticket->numero_ticket }}</strong></td>
                                        <td>{{ $ticket->assunto }}</td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $ticket->inbox->nome ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge" style="background-color: {{ $ticket->estado->cor ?? '#gray' }}; color: white;">
                                                {{ $ticket->estado->nome ?? 'Sem estado' }}
                                            </span>
                                        </td>
                                        <td>{{ $ticket->entidade->nome ?? 'N/A' }}</td>
                                        <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning text-center">
                        <h4>Nenhum ticket encontrado!</h4>
                        <p>Você precisa criar tickets primeiro.</p>
                    </div>
                @endif
                
                <div class="mt-3">
                    <a href="{{ url('/') }}" class="btn btn-secondary">Voltar</a>
                    <a href="{{ url('/login') }}" class="btn btn-primary">Login</a>
                    <a href="{{ url('/admin/dashboard') }}" class="btn btn-success">Dashboard</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>