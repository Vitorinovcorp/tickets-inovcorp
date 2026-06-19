<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Ticket</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2c3e50; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f8f9fa; border-radius: 5px; }
        .ticket-info { background: white; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #999; }
        .badge { background: #3498db; color: white; padding: 3px 10px; border-radius: 3px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Tickets Inovcorp</h1>
            <h2>Novo Ticket Criado</h2>
        </div>
        
        <div class="content">
            <h3>Olá,</h3>
            <p>Um novo ticket foi criado no sistema:</p>
            
            <div class="ticket-info">
                <p><strong>Nº Ticket:</strong> {{ $ticket->numero_ticket }}</p>
                <p><strong>Assunto:</strong> {{ $ticket->assunto }}</p>
                <p><strong>Departamento:</strong> {{ $ticket->inbox->nome }}</p>
                <p><strong>Tipo:</strong> {{ $ticket->tipo->nome }}</p>
                <p><strong>Estado:</strong> <span class="badge">{{ $ticket->estado->nome }}</span></p>
                <p><strong>Entidade:</strong> {{ $ticket->entidade->nome }}</p>
                <p><strong>Criado por:</strong> {{ $ticket->contacto->nome }}</p>
                <p><strong>Email:</strong> {{ $ticket->contacto->email }}</p>
            </div>
            
            <div style="background: white; padding: 15px; border-radius: 5px; margin: 10px 0;">
                <h4>Mensagem:</h4>
                <p>{!! nl2br(e($ticket->mensagem)) !!}</p>
            </div>
            
            <p>
                <a href="{{ route('admin.tickets.show', $ticket) }}" 
                   style="background: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                    Ver Ticket
                </a>
            </p>
        </div>
        
        <div class="footer">
            <p>Este email foi enviado automaticamente pelo sistema Tickets Inovcorp.</p>
            <p>&copy; {{ date('Y') }} Tickets Inovcorp. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>