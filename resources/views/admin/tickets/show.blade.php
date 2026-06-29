@extends('layouts.app')

@section('title', "Ticket {$ticket->numero_ticket} - Tickets Inovcorp")

@section('styles')
<style>
    .anexo-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border-radius: 12px;
        border: 1px solid #eef2f7;
        background: #fff;
        padding: 15px;
        text-align: center;
        height: 100%;
    }

    .anexo-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .anexo-card .icon {
        font-size: 2.5rem;
        margin-bottom: 8px;
    }

    .anexo-card .nome-arquivo {
        font-size: 0.85rem;
        font-weight: 500;
        color: #1a2332;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
        margin: 0 auto;
    }

    .anexo-card .tamanho {
        font-size: 0.75rem;
        color: #6b7a8f;
    }

    .anexo-card .btn-group {
        margin-top: 8px;
    }

    .anexo-card .btn-group .btn {
        padding: 4px 10px;
        font-size: 0.75rem;
        border-radius: 6px;
    }

    .msg-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 18px;
        margin-bottom: 20px;
        border-left: 4px solid #2c3e6b;
    }

    .msg-box .msg-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .msg-box .msg-author {
        font-weight: 600;
        color: #1a2332;
    }

    .msg-box .msg-date {
        font-size: 0.8rem;
        color: #6b7a8f;
    }

    .msg-box .msg-content {
        color: #333;
        line-height: 1.6;
    }

    .reply-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 18px;
        border: 1px solid #eef2f7;
    }

    .badge-status {
        padding: 5px 14px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.75rem;
    }

    .badge-status-aberto {
        background: #fde8e8;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .badge-status-tratamento {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }

    .badge-status-fechado {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #2c3e6b, #3d5a80);
        border: none;
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 600;
        color: #fff;
        transition: all 0.3s;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(44, 62, 107, 0.3);
        color: #fff;
    }

    .btn-secondary-custom {
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s;
        border: 1px solid #eef2f7;
        background: #fff;
        color: #1a2332;
    }

    .btn-secondary-custom:hover {
        background: #f8fafc;
        border-color: #2c3e6b;
    }

    @media (max-width: 768px) {
        .anexo-card .nome-arquivo {
            max-width: 100px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Ticket {{ $ticket->numero_ticket }}</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.tickets.export', $ticket) }}" class="btn btn-success me-2">
                <i class="fas fa-file-pdf"></i> Baixar PDF
            </a>
            <a href="{{ route('admin.tickets.edit', $ticket) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Detalhes do Ticket -->
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $ticket->assunto }}</h5>
                        @php
                        $estadoNome = $ticket->estado->nome ?? 'Sem estado';
                        $estadoClass = 'badge-status';
                        if ($estadoNome == 'Aberto') $estadoClass .= ' badge-status-aberto';
                        elseif ($estadoNome == 'Em Tratamento') $estadoClass .= ' badge-status-tratamento';
                        elseif ($estadoNome == 'Fechado') $estadoClass .= ' badge-status-fechado';
                        @endphp
                        <span class="{{ $estadoClass }}">{{ $estadoNome }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted">Departamento:</small>
                            <br><strong>{{ $ticket->inbox->nome ?? 'N/A' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Tipo:</small>
                            <br><strong>{{ $ticket->tipo->nome ?? 'N/A' }}</strong>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted">Entidade:</small>
                            <br><strong>{{ $ticket->entidade->nome ?? 'N/A' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Criado por:</small>
                            <br><strong>{{ $ticket->contacto->nome ?? 'N/A' }}</strong>
                            <br><small>{{ $ticket->contacto->email ?? '' }}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted">Operador Responsável:</small>
                            <br><strong>{{ $ticket->operador ? $ticket->operador->name : 'Não atribuído' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Criado em:</small>
                            <br><strong>{{ $ticket->created_at->format('d/m/Y H:i') }}</strong>
                        </div>
                    </div>

                    @if($ticket->conhecimentos->count() > 0)
                    <div class="mb-3">
                        <small class="text-muted">Conhecimento (CC):</small>
                        <br>
                        @foreach($ticket->conhecimentos as $conhecimento)
                        <span class="badge bg-info">{{ $conhecimento->email }}</span>
                        @endforeach
                    </div>
                    @endif

                    <hr>

                    <div class="mt-3">
                        <h6>Mensagem Inicial</h6>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($ticket->mensagem)) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-paperclip me-2"></i>Anexos ({{ $ticket->anexos->count() }})</h5>
                </div>
                <div class="card-body">
                    @if($ticket->anexos->count() > 0)
                    <div class="row">
                        @foreach($ticket->anexos as $anexo)
                        <div class="col-md-4 col-sm-6 mb-3">
                            <div class="anexo-card">
                                <div class="icon text-{{ $anexo->cor }}">
                                    <i class="fas {{ $anexo->icone }}"></i>
                                </div>
                                <div class="nome-arquivo" title="{{ $anexo->nome_original }}">
                                    {{ $anexo->nome_original }}
                                </div>
                                <div class="tamanho">{{ $anexo->tamanho_formatado }}</div>
                                <div class="btn-group">
                                    <a href="{{ route('admin.anexos.download', $anexo) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-download"></i> Baixar
                                    </a>
                                    <form action="{{ route('admin.anexos.destroy', $anexo) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este anexo?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted text-center mb-0">Nenhum anexo encontrado.</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">💬 Respostas ({{ $ticket->respostas->count() }})</h5>
                </div>
                <div class="card-body">
                    @forelse($ticket->respostas as $resposta)
                    <div class="msg-box">
                        <div class="msg-header">
                            <span class="msg-author">
                                <i class="fas fa-user-circle me-1"></i>
                                {{ $resposta->user->name ?? $resposta->contacto->nome ?? 'Sistema' }}
                            </span>
                            <span class="msg-date">{{ $resposta->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="msg-content">
                            {!! nl2br(e($resposta->mensagem)) !!}
                        </div>
                        @if($resposta->anexos->count() > 0)
                        <div class="mt-2">
                            <small class="text-muted">Anexos:</small>
                            @foreach($resposta->anexos as $anexo)
                            <a href="{{ route('admin.anexos.download', $anexo) }}" class="btn btn-sm btn-outline-primary ms-1">
                                <i class="fas {{ $anexo->icone }}"></i> {{ $anexo->nome_original }}
                            </a>
                            @endforeach
                        </div>
                        @endif
                        @if($resposta->user_id)
                        <small class="text-primary mt-1 d-block">👤 Operador</small>
                        @elseif($resposta->contacto_id)
                        <small class="text-success mt-1 d-block">👤 Cliente</small>
                        @endif
                    </div>
                    @empty
                    <div class="text-center text-muted">
                        <p>Nenhuma resposta ainda.</p>
                    </div>
                    @endforelse

                    <!-- Formulário de Resposta -->
                    <hr>
                    <h6 class="fw-bold"><i class="fas fa-reply me-2"></i> Adicionar Resposta</h6>
                    <form action="{{ route('admin.tickets.responder', $ticket) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="mensagem" class="form-label">Mensagem *</label>
                            <textarea name="mensagem" id="mensagem"
                                class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="anexo_resposta" class="form-label">Anexar arquivo</label>
                            <input type="file" name="anexo_resposta" id="anexo_resposta"
                                class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.doc,.docx,.xls,.xlsx,.txt,.zip,.rar,.json,.csv">
                            <small class="text-muted">Formatos permitidos: JPG, PNG, GIF, PDF, DOC, DOCX, XLS, XLSX, TXT, ZIP, RAR (Máx: 10MB)</small>
                        </div>
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="fas fa-paper-plane me-2"></i> Responder
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar - Atividades -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">📝 Histórico de Atividades</h5>
                </div>
                <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                    @forelse($ticket->atividades as $atividade)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">{{ $atividade->created_at->format('d/m/Y H:i') }}</small>
                            <small class="text-primary">{{ $atividade->user ? $atividade->user->name : 'Sistema' }}</small>
                        </div>
                        <div>
                            <strong>{{ ucfirst($atividade->acao) }}</strong>
                        </div>
                        <hr>
                    </div>
                    @empty
                    <div class="text-center text-muted">
                        <p>Nenhuma atividade registrada.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection