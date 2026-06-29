@extends('cliente.layouts.app')

@section('title', 'Meus Tickets - Tickets Inovcorp')

@section('content')
<div class="container-fluid">
    
    <div class="page-header">
        <h2> Meus Tickets</h2>
        <a href="{{ route('cliente.tickets.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus me-2"></i> Novo Ticket
        </a>
    </div>

    <!-- Filtros -->
    <div class="filtro-card">
        <form method="GET" class="row g-3">
            <div class="col-md-3">
                <select name="estado_id" class="form-select">
                    <option value="">Todos Estados</option>
                    @foreach($filtros['estados'] as $estado)
                        <option value="{{ $estado->id }}" {{ request('estado_id') == $estado->id ? 'selected' : '' }}>
                            {{ $estado->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="inbox_id" class="form-select">
                    <option value="">Todos Departamentos</option>
                    @foreach($filtros['inboxes'] as $inbox)
                        <option value="{{ $inbox->id }}" {{ request('inbox_id') == $inbox->id ? 'selected' : '' }}>
                            {{ $inbox->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" 
                       placeholder="🔍 Pesquisar por Nº ou Assunto..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary-custom w-100">Filtrar</button>
            </div>
        </form>
    </div>

    <!-- Lista de Tickets -->
    <div class="card-custom">
        <div class="card-body">
            @if($tickets->count() > 0)
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Nº Ticket</th>
                                <th>Assunto</th>
                                <th>Departamento</th>
                                <th>Estado</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td><strong class="text-primary">{{ $ticket->numero_ticket }}</strong></td>
                                    <td>{{ $ticket->assunto }}</td>
                                    <td><span class="badge bg-info">{{ $ticket->inbox->nome ?? 'N/A' }}</span></td>
                                    <td>
                                        <span class="badge-status" style="background-color: {{ $ticket->estado->cor ?? '#gray' }}20; color: {{ $ticket->estado->cor ?? '#gray' }}; border: 1px solid {{ $ticket->estado->cor ?? '#gray' }};">
                                            {{ $ticket->estado->nome ?? 'Sem estado' }}
                                        </span>
                                    </td>
                                    <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('cliente.tickets.show', $ticket) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $tickets->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h4>Nenhum ticket encontrado</h4>
                    <p>Você ainda não possui tickets. Clique no botão abaixo para criar seu primeiro ticket.</p>
                    <a href="{{ route('cliente.tickets.create') }}" class="btn btn-primary-custom mt-2">
                        <i class="fas fa-plus me-2"></i> Criar primeiro ticket
                    </a>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection