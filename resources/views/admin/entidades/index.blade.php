@extends('layouts.app')

@section('title', 'Entidades - Tickets Inovcorp')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2> Entidades</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.entidades.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nova Entidade
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($entidades->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>NIF</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Contactos</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($entidades as $entidade)
                                <tr>
                                    <td>{{ $entidade->nif }}</td>
                                    <td>{{ $entidade->nome }}</td>
                                    <td>{{ $entidade->email ?? 'N/A' }}</td>
                                    <td>{{ $entidade->telefone ?? 'N/A' }}</td>
                                    <td>{{ $entidade->contactos->count() }}</td>
                                    <td>
                                        <a href="{{ route('admin.entidades.show', $entidade) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.entidades.edit', $entidade) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.entidades.destroy', $entidade) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $entidades->links() }}
            @else
                <div class="text-center py-4">
                    <i class="fas fa-building fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Nenhuma entidade cadastrada.</p>
                    <a href="{{ route('admin.entidades.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Criar primeira entidade
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection