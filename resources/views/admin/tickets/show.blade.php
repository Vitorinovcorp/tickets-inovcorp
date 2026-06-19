@extends('layouts.app')

@section('title', "Ticket {$ticket->numero_ticket} - Tickets Inovcorp")

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>🎫 Ticket {{ $ticket->numero_ticket }}</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
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
                        <span class="badge" style="background-color: {{ $ticket->estado->cor }}">
                            {{ $ticket->estado->nome }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted">Departamento:</small>
                            <br><strong>{{ $ticket->inbox->nome }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Tipo:</small>
                            <br><strong>{{ $ticket->tipo->nome }}</strong>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted">Entidade:</small>
                            <br><strong>{{ $ticket->entidade->nome }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Criado por:</small>
                            <br><strong>{{ $ticket->contacto->nome }}</strong>
                            <br><small>{{ $ticket->contacto->email }}</small>
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

            <!-- Respostas -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">💬 Respostas ({{ $ticket->respostas->count() }})</h5>
                </div>
                <div class="card-body">
                    @forelse($ticket->respostas as $resposta)
                        <div class="mb-3 p-3 border rounded">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong>{{ $resposta->nome_responsavel }}</strong>
                                <small class="text-muted">{{ $resposta->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <div>
                                {!! nl2br(e($resposta->mensagem)) !!}
                            </div>
                            @if($resposta->user_id)
                                <small class="text-primary">👤 Operador</small>
                            @elseif($resposta->contacto_id)
                                <small class="text-success">👤 Cliente</small>
                            @endif
                        </div>
                    @empty
                        <div class="text-center text-muted">
                            <p>Nenhuma resposta ainda.</p>
                        </div>
                    @endforelse

                    <!-- Formulário de Resposta -->
                    <hr>
                    <form action="{{ route('admin.tickets.responder', $ticket) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="mensagem" class="form-label">Adicionar Resposta</label>
                            <textarea name="mensagem" id="mensagem" 
                                      class="form-control @error('mensagem') is-invalid @enderror" 
                                      rows="5" required></textarea>
                            @error('mensagem')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-reply"></i> Responder
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
                            @if($atividade->dados_novos && isset($atividade->dados_novos['estado_id']))
                                <small class="text-muted">Estado alterado</small>
                            @endif
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