@extends('layouts.app')

@section('title', 'Novo Ticket - Tickets Inovcorp')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2> Criar Novo Ticket</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">
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
            <form action="{{ route('admin.tickets.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="assunto" class="form-label">Assunto *</label>
                        <input type="text" name="assunto" id="assunto" 
                               class="form-control @error('assunto') is-invalid @enderror" 
                               value="{{ old('assunto') }}" required>
                        @error('assunto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="tipo_id" class="form-label">Tipo *</label>
                        <select name="tipo_id" id="tipo_id" 
                                class="form-control @error('tipo_id') is-invalid @enderror" required>
                            <option value="">Selecione...</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}" {{ old('tipo_id') == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inbox_id" class="form-label">Departamento *</label>
                        <select name="inbox_id" id="inbox_id" 
                                class="form-control @error('inbox_id') is-invalid @enderror" required>
                            <option value="">Selecione...</option>
                            @foreach($inboxes as $inbox)
                                <option value="{{ $inbox->id }}" {{ old('inbox_id') == $inbox->id ? 'selected' : '' }}>
                                    {{ $inbox->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('inbox_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="estado_id" class="form-label">Estado *</label>
                        <select name="estado_id" id="estado_id" 
                                class="form-control @error('estado_id') is-invalid @enderror" required>
                            <option value="">Selecione...</option>
                            @foreach($estados as $estado)
                                <option value="{{ $estado->id }}" {{ old('estado_id') == $estado->id ? 'selected' : '' }}>
                                    {{ $estado->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('estado_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="entidade_id" class="form-label">Entidade *</label>
                        <select name="entidade_id" id="entidade_id" 
                                class="form-control @error('entidade_id') is-invalid @enderror" required>
                            <option value="">Selecione...</option>
                            @foreach($entidades as $entidade)
                                <option value="{{ $entidade->id }}" {{ old('entidade_id') == $entidade->id ? 'selected' : '' }}>
                                    {{ $entidade->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('entidade_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="contacto_criador_id" class="form-label">Contacto Criador *</label>
                        <select name="contacto_criador_id" id="contacto_criador_id" 
                                class="form-control @error('contacto_criador_id') is-invalid @enderror" required>
                            <option value="">Selecione...</option>
                            @foreach($contactos as $contacto)
                                <option value="{{ $contacto->id }}" {{ old('contacto_criador_id') == $contacto->id ? 'selected' : '' }}>
                                    {{ $contacto->nome }} ({{ $contacto->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('contacto_criador_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="operador_associado_id" class="form-label">Operador Responsável</label>
                    <select name="operador_associado_id" id="operador_associado_id" 
                            class="form-control @error('operador_associado_id') is-invalid @enderror">
                        <option value="">Não atribuído</option>
                        @foreach($operadores ?? [] as $operador)
                            <option value="{{ $operador->id }}" {{ old('operador_associado_id') == $operador->id ? 'selected' : '' }}>
                                {{ $operador->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('operador_associado_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="conhecimento" class="form-label">Conhecimento (CC)</label>
                    <div id="conhecimento-container">
                        <div class="input-group mb-2">
                            <input type="email" name="conhecimento[]" class="form-control" 
                                   placeholder="email@exemplo.com">
                            <button type="button" class="btn btn-success" onclick="adicionarEmail()">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <small class="text-muted">Adicione emails que devem receber cópia</small>
                </div>

                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem *</label>
                    <textarea name="mensagem" id="mensagem" 
                              class="form-control @error('mensagem') is-invalid @enderror" 
                              rows="8" required>{{ old('mensagem') }}</textarea>
                    @error('mensagem')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="reset" class="btn btn-secondary">Limpar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Criar Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function adicionarEmail() {
    const container = document.getElementById('conhecimento-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="email" name="conhecimento[]" class="form-control" placeholder="email@exemplo.com">
        <button type="button" class="btn btn-danger" onclick="removerEmail(this)">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(div);
}

function removerEmail(button) {
    button.closest('.input-group').remove();
}
</script>
@endpush
@endsection