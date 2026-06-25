@extends('layouts.app')

@section('title', 'Editar Entidade - Tickets Inovcorp')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>✏️ Editar Entidade</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.entidades.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.entidades.update', $entidade) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nif" class="form-label">NIF *</label>
                        <input type="text" name="nif" id="nif" 
                               class="form-control @error('nif') is-invalid @enderror" 
                               value="{{ old('nif', $entidade->nif) }}" required>
                        @error('nif')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="nome" class="form-label">Nome *</label>
                        <input type="text" name="nome" id="nome" 
                               class="form-control @error('nome') is-invalid @enderror" 
                               value="{{ old('nome', $entidade->nome) }}" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email', $entidade->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" 
                               class="form-control @error('telefone') is-invalid @enderror" 
                               value="{{ old('telefone', $entidade->telefone) }}">
                        @error('telefone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="telemovel" class="form-label">Telemóvel</label>
                        <input type="text" name="telemovel" id="telemovel" 
                               class="form-control @error('telemovel') is-invalid @enderror" 
                               value="{{ old('telemovel', $entidade->telemovel) }}">
                        @error('telemovel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="website" class="form-label">Website</label>
                        <input type="url" name="website" id="website" 
                               class="form-control @error('website') is-invalid @enderror" 
                               value="{{ old('website', $entidade->website) }}">
                        @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="notas_internas" class="form-label">Notas Internas</label>
                    <textarea name="notas_internas" id="notas_internas" 
                              class="form-control @error('notas_internas') is-invalid @enderror" 
                              rows="4">{{ old('notas_internas', $entidade->notas_internas) }}</textarea>
                    @error('notas_internas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="reset" class="btn btn-secondary">Limpar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Atualizar Entidade
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection