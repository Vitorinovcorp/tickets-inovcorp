@extends('layouts.app')

@section('title', 'Tickets - Tickets Inovcorp')

@section('styles')
<style>
    .ticket-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.75rem;
        display: inline-block;
    }
    .ticket-status-aberto {
        background-color: #fee2e2;
        color: #dc2626;
    }
    .ticket-status-tratamento {
        background-color: #fef3c7;
        color: #d97706;
    }
    .ticket-status-fechado {
        background-color: #d1fae5;
        color: #059669;
    }
    .btn-voltar {
        transition: all 0.3s ease;
    }
    .btn-voltar:hover {
        transform: translateX(-3px);
    }
    .filtro-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
        border: 1px solid #e9ecef;
    }
    .table-tickets tr {
        transition: background 0.2s ease;
    }
    .table-tickets tr:hover {
        background: #f1f3f5;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    
    <!-- ==========================================
    HEADER COM BOTÃO DE VOLTAR
    ========================================== -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2>
                <i class="fas fa-ticket-alt text-primary me-2"></i>
                Gestão de Tickets
                <span class="badge bg-primary ms-2">{{ $tickets->total() }}</span>
            </h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-voltar me-2">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
            <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Novo Ticket
            </a>
        </div>
    </div>

    <!-- ==========================================
    FILTROS
    ========================================== -->
    <div class="filtro-card">
        <form method="GET" class="row g-3">
            <div class="col-md-2">
                <label class="form-label fw-bold small text-muted">Departamento</label>
                <select name="inbox_id" class="form-select">
                    <option value="">Todos</option>
                    @foreach($filtros['inboxes'] as $inbox)
                        <option value="{{ $inbox->id }}" {{ request('inbox_id') == $inbox->id ? 'selected' : '' }}>
                            {{ $inbox->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold small text-muted">Estado</label>
                <select name="estado_id" class="form-select">
                    <option value="">Todos</option>
                    @foreach($filtros['estados'] as $estado)
                        <option value="{{ $estado->id }}" {{ request('estado_id') == $estado->id ? 'selected' : '' }}>
                            {{ $estado->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold small text-muted">Tipo</label>
                <select name="tipo_id" class="form-select">
                    <option value="">Todos</option>
                    @foreach($filtros['tipos'] as $tipo)
                        <option value="{{ $tipo->id }}" {{ request('tipo_id') == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold small text-muted">Pesquisar</label>
                <input type="text" name="search" class="form-control" 
                       placeholder="🔍 Nº, Assunto, Email..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">
                    <i class="fas fa-undo"></i> Limpar
                </a>
            </div>
        </form>
    </div>

    <!-- ==========================================
    LISTA DE TICKETS
    ========================================== -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            @if($tickets->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-tickets mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Nº Ticket</th>
                                <th>Assunto</th>
                                <th>Departamento</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Entidade</th>
                                <th>Data</th>
                                <th class="text-end pe-3">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td class="ps-3">
                                        <strong class="text-primary">{{ $ticket->numero_ticket }}</strong>
                                    </td>
                                    <td>{{ Str::limit($ticket->assunto, 50) }}</td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $ticket->inbox->nome ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>{{ $ticket->tipo->nome ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $estadoNome = $ticket->estado->nome ?? 'Sem estado';
                                            $estadoCor = $ticket->estado->cor ?? '#gray';
                                            $estadoClass = '';
                                            if ($estadoNome == 'Aberto') $estadoClass = 'ticket-status-aberto';
                                            elseif ($estadoNome == 'Em Tratamento') $estadoClass = 'ticket-status-tratamento';
                                            elseif ($estadoNome == 'Fechado') $estadoClass = 'ticket-status-fechado';
                                        @endphp
                                        <span class="ticket-status {{ $estadoClass }}" 
                                              style="background-color: {{ $estadoCor }}20; color: {{ $estadoCor }}; border: 1px solid {{ $estadoCor }};">
                                            {{ $estadoNome }}
                                        </span>
                                    </td>
                                    <td>{{ $ticket->entidade->nome ?? 'N/A' }}</td>
                                    <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-end pe-3">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.tickets.show', $ticket) }}" 
                                               class="btn btn-outline-primary" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.tickets.edit', $ticket) }}" 
                                               class="btn btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.tickets.destroy', $ticket) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" 
                                                        title="Excluir"
                                                        onclick="return confirm('Tem certeza que deseja excluir este ticket?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginação -->
                <div class="d-flex justify-content-between align-items-center p-3 border-top">
                    <div>
                        <small class="text-muted">
                            Mostrando {{ $tickets->firstItem() ?? 0 }} a {{ $tickets->lastItem() ?? 0 }} de {{ $tickets->total() }} tickets
                        </small>
                    </div>
                    <div>
                        {{ $tickets->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                    <h4 class="text-muted">Nenhum ticket encontrado</h4>
                    <p class="text-muted">Comece criando seu primeiro ticket.</p>
                    <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary mt-2">
                        <i class="fas fa-plus"></i> Criar primeiro ticket
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- ==========================================
    BOTÃO VOLTAR AO DASHBOARD (RODAPÉ)
    ========================================== -->
    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-voltar">
                <i class="fas fa-arrow-left"></i> Voltar ao Dashboard
            </a>
        </div>
    </div>
</div>
@endsection