@extends('layouts.app')

@section('title', 'Departamentos - Tickets Inovcorp')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>📁 Departamentos (Inboxes)</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.inboxes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Novo Departamento
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                @forelse($inboxes as $inbox)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $inbox->nome }}</h5>
                                <p class="card-text text-muted">{{ $inbox->email ?? 'Sem email definido' }}</p>
                                <p>
                                    <span class="badge bg-primary">{{ $inbox->tickets_count }} Tickets</span>
                                </p>
                                <div class="btn-group w-100">
                                    <a href="{{ route('admin.inboxes.show', $inbox) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('admin.inboxes.edit', $inbox) }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.inboxes.destroy', $inbox) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Tem certeza?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center text-muted">
                            <p>Nenhum departamento cadastrado</p>
                            <a href="{{ route('admin.inboxes.create') }}" class="btn btn-primary">
                                Criar Primeiro Departamento
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
            
            {{ $inboxes->links() }}
        </div>
    </div>
</div>
@endsection