@extends('layouts.app')

@section('title', 'Perfil - Tickets Inovcorp')

@section('content')
<div class="container">
    <h2>Meu Perfil</h2>
    <p>Bem-vindo ao seu perfil, {{ Auth::user()->name }}!</p>
</div>
@endsection