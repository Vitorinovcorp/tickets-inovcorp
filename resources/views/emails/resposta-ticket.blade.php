<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Resposta</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #27ae60; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f8f9fa; border-radius: 5px; }
        .resposta-box { background: white; padding: 15px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #27ae60; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Tickets Inovcorp</h1>
            <h2>Nova Resposta no Ticket</h2>
        </div>
        
        <div class="content">
            <h3>Olá,</h3>
            <p>Uma nova resposta foi adicionada ao ticket <strong>{{ $ticket->numero_ticket }}</strong>:</p>
            
            <div style="margin: 10px 0;">
                <p><strong>Assunto:</strong> {{ $ticket->assunto }}</p>
                <p><strong>Estado:</strong> {{ $ticket->estado->nome }}</p>
            </div>
            
            <div class="resposta-box">
                <h4>Resposta de {{ $resposta->nome_responsavel }}:</h4>
                <p>{!! nl2br(e($resposta->mensagem)) !!}</p>
            </div>
            
            <p>
                <a href="{{ route('admin.tickets.show', $ticket) }}" 
                   style="background: #27ae60; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                    Ver Resposta
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