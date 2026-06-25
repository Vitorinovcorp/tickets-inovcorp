@extends('layouts.app')

@section('title', 'Detalhes da Entidade - Tickets Inovcorp')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>🏢 Detalhes da Entidade</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.entidades.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
            <a href="{{ route('admin.entidades.edit', $entidade) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Informações da Entidade</h5>
                </div>
                <div class="card-body">
                    <p><strong>NIF:</strong> {{ $entidade->nif }}</p>
                    <p><strong>Nome:</strong> {{ $entidade->nome }}</p>
                    <p><strong>Email:</strong> {{ $entidade->email ?? 'N/A' }}</p>
                    <p><strong>Telefone:</strong> {{ $entidade->telefone ?? 'N/A' }}</p>
                    <p><strong>Telemóvel:</strong> {{ $entidade->telemovel ?? 'N/A' }}</p>
                    <p><strong>Website:</strong> {{ $entidade->website ?? 'N/A' }}</p>
                    <p><strong>Criado em:</strong> {{ $entidade->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Contactos Associados</h5>
                </div>
                <div class="card-body">
                    @if($entidade->contactos->count() > 0)
                        <ul>
                            @foreach($entidade->contactos as $contacto)
                                <li>{{ $contacto->nome }} ({{ $contacto->email }})</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Nenhum contacto associado</p>
                    @endif
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header">
                    <h5>Notas Internas</h5>
                </div>
                <div class="card-body">
                    {{ $entidade->notas_internas ?? 'Nenhuma nota cadastrada' }}
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tickets desta Entidade</h5>
                </div>
                <div class="card-body">
                    @if($entidade->tickets->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nº Ticket</th>
                                        <th>Assunto</th>
                                        <th>Estado</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($entidade->tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->numero_ticket }}</td>
                                            <td>{{ $ticket->assunto }}</td>
                                            <td>
                                                <span class="badge" style="background-color: {{ $ticket->estado->cor ?? '#gray' }}; color: white;">
                                                    {{ $ticket->estado->nome ?? 'Sem estado' }}
                                                </span>
                                            </td>
                                            <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">Nenhum ticket encontrado para esta entidade</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection