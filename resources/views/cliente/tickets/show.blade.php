@extends('cliente.layouts.app')

@section('title', "Ticket {$ticket->numero_ticket} - Tickets Inovcorp")

@section('content')
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
@endsection