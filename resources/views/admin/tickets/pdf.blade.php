<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ticket {{ $ticket->numero_ticket }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            padding: 30px;
            color: #333;
            font-size: 12px;
            line-height: 1.5;
        }

        .header {
            border-bottom: 3px solid #2c3e6b;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #2c3e6b;
            font-size: 22px;
            margin: 0;
        }

        .header .subtitle {
            color: #6b7a8f;
            font-size: 12px;
        }

        .ticket-info {
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #2c3e6b;
        }

        .ticket-info table {
            width: 100%;
            font-size: 12px;
        }

        .ticket-info td {
            padding: 4px 8px;
        }

        .ticket-info .label {
            font-weight: bold;
            color: #1a2332;
            width: 120px;
        }

        .mensagem {
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 4px solid #3d5a80;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .resposta {
            background: #f8fafc;
            padding: 12px 15px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 3px solid #6b9fc7;
        }

        .resposta .author {
            font-weight: bold;
            color: #1a2332;
        }

        .resposta .date {
            color: #6b7a8f;
            font-size: 11px;
        }

        .resposta .content {
            margin-top: 5px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #eef2f7;
            text-align: center;
            color: #6b7a8f;
            font-size: 11px;
        }

        .badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .badge-aberto {
            background: #fde8e8;
            color: #b91c1c;
        }

        .badge-tratamento {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-fechado {
            background: #d1fae5;
            color: #065f46;
        }

        .anexo-item {
            display: inline-block;
            background: #eef2f7;
            padding: 4px 12px;
            border-radius: 4px;
            margin: 2px 4px 2px 0;
            font-size: 11px;
        }

        .section-title {
            color: #2c3e6b;
            font-size: 15px;
            margin-top: 20px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .atividade-item {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
            border-bottom: 1px solid #eef2f7;
            font-size: 11px;
        }

        .atividade-item .data {
            color: #6b7a8f;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-aberto {
            background: #fde8e8;
            color: #b91c1c;
        }

        .status-tratamento {
            background: #fef3c7;
            color: #92400e;
        }

        .status-fechado {
            background: #d1fae5;
            color: #065f46;
        }

        .status-default {
            background: #eef2f7;
            color: #6b7a8f;
        }

        .logo-img {
            height: 50px;
            width: auto;
        }

        .logo-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-cell {
            width: 70px;
            vertical-align: middle;
        }

        .title-cell {
            vertical-align: middle;
            padding-left: 15px;
        }

        .status-cell {
            text-align: right;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <!-- HEADER COM LOGO - USANDO CAMINHO ABSOLUTO -->
    <div class="header">
        <table class="logo-table">
            <tr>
                <td class="title-cell">
                    <h1>Ticket {{ $ticket->numero_ticket }}</h1>
                    <div class="subtitle">Detalhes do ticket - {{ now()->format('d/m/Y H:i') }}</div>
                </td>
                <td class="status-cell">
                    @php
                    $estadoNome = $ticket->estado->nome ?? 'Sem estado';
                    $statusClass = 'status-default';
                    if ($estadoNome == 'Aberto') $statusClass = 'status-aberto';
                    elseif ($estadoNome == 'Em Tratamento') $statusClass = 'status-tratamento';
                    elseif ($estadoNome == 'Fechado') $statusClass = 'status-fechado';
                    @endphp
                    <span class="status-badge {{ $statusClass }}">
                        {{ $estadoNome }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Informacoes do Ticket -->
    <div class="ticket-info">
        <table>
            <tr>
                <td class="label">Assunto:</td>
                <td><strong>{{ $ticket->assunto }}</strong></td>
            </tr>
            <tr>
                <td class="label">Departamento:</td>
                <td>{{ $ticket->inbox->nome ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Tipo:</td>
                <td>{{ $ticket->tipo->nome ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Entidade:</td>
                <td>{{ $ticket->entidade->nome ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Criado por:</td>
                <td>{{ $ticket->contacto->nome ?? 'N/A' }} ({{ $ticket->contacto->email ?? '' }})</td>
            </tr>
            <tr>
                <td class="label">Operador:</td>
                <td>{{ $ticket->operador ? $ticket->operador->name : 'Nao atribuido' }}</td>
            </tr>
            <tr>
                <td class="label">Criado em:</td>
                <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @if($ticket->conhecimentos->count() > 0)
            <tr>
                <td class="label">CC:</td>
                <td>
                    @foreach($ticket->conhecimentos as $conhecimento)
                    <span style="display:inline-block;background:#eef2f7;padding:2px 10px;border-radius:4px;margin:2px;font-size:11px;">
                        {{ $conhecimento->email }}
                    </span>
                    @endforeach
                </td>
            </tr>
            @endif
        </table>
    </div>

    <!-- Mensagem Inicial -->
    <div class="section-title">Mensagem Inicial</div>
    <div class="mensagem">{{ $ticket->mensagem }}</div>

    <!-- Anexos do Ticket -->
    @if($ticket->anexos->count() > 0)
    <div class="section-title">Anexos ({{ $ticket->anexos->count() }})</div>
    <div style="margin-bottom: 15px;">
        @foreach($ticket->anexos as $anexo)
        <span class="anexo-item">{{ $anexo->nome_original }} ({{ $anexo->tamanho_formatado }})</span>
        @endforeach
    </div>
    @endif

    <!-- Respostas -->
    <div class="section-title">Respostas ({{ $ticket->respostas->count() }})</div>
    @forelse($ticket->respostas as $resposta)
    <div class="resposta">
        <div>
            <span class="author">{{ $resposta->user->name ?? $resposta->contacto->nome ?? 'Sistema' }}</span>
            <span class="date">- {{ $resposta->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="content">{{ $resposta->mensagem }}</div>
        @if($resposta->anexos->count() > 0)
        <div style="margin-top:5px;">
            @foreach($resposta->anexos as $anexo)
            <span class="anexo-item">{{ $anexo->nome_original }}</span>
            @endforeach
        </div>
        @endif
    </div>
    @empty
    <p style="color: #6b7a8f;">Nenhuma resposta ainda.</p>
    @endforelse

    <!-- Historico de Atividades -->
    @if($ticket->atividades->count() > 0)
    <div class="section-title">Historico de Atividades</div>
    <div style="background: #f8fafc; padding: 12px 15px; border-radius: 8px;">
        @foreach($ticket->atividades as $atividade)
        <div class="atividade-item">
            <span>{{ ucfirst($atividade->acao) }}</span>
            <span class="data">
                {{ $atividade->created_at->format('d/m/Y H:i') }}
                @if($atividade->user) - {{ $atividade->user->name }} @endif
            </span>
        </div>
        @endforeach
    </div>
    @endif

    <div class="footer">
        Este documento foi gerado automaticamente pelo sistema Tickets Inovcorp em {{ now()->format('d/m/Y H:i') }}.
    </div>
</body>

</html>