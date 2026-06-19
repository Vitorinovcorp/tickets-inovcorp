@extends('layouts.app')

@section('title', 'Contactos - Tickets Inovcorp')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>👤 Contactos</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.contactos.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Novo Contacto
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="row g-3 mb-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" 
                           placeholder="🔍 Pesquisar por Nome, Email ou Telefone..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="funcao_id" class="form-select">
                        <option value="">Todas Funções</option>
                        @foreach($funcoes as $funcao)
                            <option value="{{ $funcao->id }}" {{ request('funcao_id') == $funcao->id ? 'selected' : '' }}>
                                {{ $funcao->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <a href="{{ route('admin.contactos.index') }}" class="btn btn-secondary">Limpar</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Função</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Entidades</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contactos as $contacto)
                            <tr>
                                <td>{{ $contacto->nome }}</td>
                                <td>{{ $contacto->funcao->nome }}</td>
                                <td>{{ $contacto->email }}</td>
                                <td>{{ $contacto->telefone }}</td>
                                <td>
                                    @foreach($contacto->entidades as $entidade)
                                        <span class="badge bg-info">{{ $entidade->nome }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('admin.contactos.show', $contacto) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.contactos.edit', $contacto) }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.contactos.destroy', $contacto) }}" 
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
                                <td colspan="6" class="text-center">Nenhum contacto encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{ $contactos->links() }}
        </div>
    </div>
</div>
@endsection