@extends('layouts.app')

@section('title', 'Detalhes do Contacto - Tickets Inovcorp')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>👤 Detalhes do Contacto</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.contactos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
            <a href="{{ route('admin.contactos.edit', $contacto) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Informações Pessoais</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nome:</strong> {{ $contacto->nome }}</p>
                    <p><strong>Email:</strong> {{ $contacto->email }}</p>
                    <p><strong>Função:</strong> {{ $contacto->funcao->nome ?? 'N/A' }}</p>
                    <p><strong>Telefone:</strong> {{ $contacto->telefone ?? 'N/A' }}</p>
                    <p><strong>Telemóvel:</strong> {{ $contacto->telemovel ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Entidades Associadas</h5>
                </div>
                <div class="card-body">
                    @if($contacto->entidades->count() > 0)
                        <ul>
                            @foreach($contacto->entidades as $entidade)
                                <li>{{ $entidade->nome }} ({{ $entidade->nif }})</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Nenhuma entidade associada</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Notas Internas</h5>
                </div>
                <div class="card-body">
                    {{ $contacto->notas_internas ?? 'Nenhuma nota cadastrada' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection