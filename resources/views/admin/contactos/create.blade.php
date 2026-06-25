@extends('layouts.app')

@section('title', 'Novo Contacto - Tickets Inovcorp')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>👤 Novo Contacto</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.contactos.index') }}" class="btn btn-secondary">
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
            <form action="{{ route('admin.contactos.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nome" class="form-label">Nome *</label>
                        <input type="text" name="nome" id="nome" 
                               class="form-control @error('nome') is-invalid @enderror" 
                               value="{{ old('nome') }}" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" name="email" id="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="funcao_id" class="form-label">Função *</label>
                        <select name="funcao_id" id="funcao_id" 
                                class="form-control @error('funcao_id') is-invalid @enderror" required>
                            <option value="">Selecione...</option>
                            @foreach($funcoes as $funcao)
                                <option value="{{ $funcao->id }}" {{ old('funcao_id') == $funcao->id ? 'selected' : '' }}>
                                    {{ $funcao->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('funcao_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" 
                               class="form-control @error('telefone') is-invalid @enderror" 
                               value="{{ old('telefone') }}">
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
                               value="{{ old('telemovel') }}">
                        @error('telemovel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="entidades" class="form-label">Entidades Associadas</label>
                        <select name="entidades[]" id="entidades" 
                                class="form-control @error('entidades') is-invalid @enderror" multiple>
                            @foreach($entidades as $entidade)
                                <option value="{{ $entidade->id }}" 
                                    {{ in_array($entidade->id, old('entidades', [])) ? 'selected' : '' }}>
                                    {{ $entidade->nome }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Segure Ctrl para selecionar múltiplas entidades</small>
                        @error('entidades')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="notas_internas" class="form-label">Notas Internas</label>
                    <textarea name="notas_internas" id="notas_internas" 
                              class="form-control @error('notas_internas') is-invalid @enderror" 
                              rows="4">{{ old('notas_internas') }}</textarea>
                    @error('notas_internas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="reset" class="btn btn-secondary">Limpar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Contacto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection