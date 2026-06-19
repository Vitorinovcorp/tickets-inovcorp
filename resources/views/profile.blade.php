@extends('layouts.app')

@section('title', 'Perfil - Tickets Inovcorp')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>👤 Meu Perfil</h2>
            <hr>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Informações Pessoais</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nome:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Cadastrado em:</strong> {{ Auth::user()->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Ações</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-chart-pie"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-info w-100 mb-2">
                        <i class="fas fa-ticket"></i> Meus Tickets
                    </a>
                    <a href="{{ route('logout') }}" class="btn btn-danger w-100"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection