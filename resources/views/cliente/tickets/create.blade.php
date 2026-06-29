@extends('cliente.layouts.app')

@section('title', 'Novo Ticket - Tickets Inovcorp')

@section('content')
<div class="container-fluid">
    
    <div class="page-header">
        <h2><i class="fas fa-plus-circle"></i> Novo Ticket</h2>
        <a href="{{ route('cliente.tickets.index') }}" class="btn btn-secondary-custom">
            <i class="fas fa-arrow-left me-2"></i> Voltar
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-danger-custom">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-custom">
        <div class="card-header">
            <i class="fas fa-pen me-2 text-primary"></i> Preencha os dados do ticket
        </div>
        <div class="card-body">
            <form action="{{ route('cliente.tickets.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="assunto" class="form-label">Assunto *</label>
                        <input type="text" name="assunto" id="assunto" 
                               class="form-control @error('assunto') is-invalid @enderror" 
                               value="{{ old('assunto') }}" required placeholder="Digite o assunto do ticket">
                        @error('assunto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="tipo_id" class="form-label">Tipo *</label>
                        <select name="tipo_id" id="tipo_id" 
                                class="form-select @error('tipo_id') is-invalid @enderror" required>
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
                                class="form-select @error('inbox_id') is-invalid @enderror" required>
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
                        <label for="entidade_id" class="form-label">Entidade *</label>
                        <select name="entidade_id" id="entidade_id" 
                                class="form-select @error('entidade_id') is-invalid @enderror" required>
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
                              rows="8" required placeholder="Descreva detalhadamente o seu problema ou solicitação...">{{ old('mensagem') }}</textarea>
                    @error('mensagem')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="reset" class="btn btn-secondary-custom me-2">Limpar</button>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-paper-plane me-2"></i> Enviar Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

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