@extends('layouts.app')

@section('title', 'Entidades - Tickets Inovcorp')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>🏢 Entidades</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.entidades.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nova Entidade
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" 
                           placeholder="🔍 Pesquisar por Nome, NIF ou Email..." 
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                    <a href="{{ route('admin.entidades.index') }}" class="btn btn-secondary">Limpar</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>NIF</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Total Tickets</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($entidades as $entidade)
                            <tr>
                                <td>{{ $entidade->nif }}</td>
                                <td>{{ $entidade->nome }}</td>
                                <td>{{ $entidade->email }}</td>
                                <td>{{ $entidade->telefone }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $entidade->tickets_count }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.entidades.show', $entidade) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.entidades.edit', $entidade) }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.entidades.destroy', $entidade) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Tem certeza?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Nenhuma entidade encontrada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{ $entidades->links() }}
        </div>
    </div>
</div>
@endsection