<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\EntidadeController;
use App\Http\Controllers\Admin\ContactoController;
use App\Http\Controllers\Cliente\AuthController as ClienteAuthController;
use App\Http\Controllers\Cliente\DashboardController as ClienteDashboardController;
use App\Http\Controllers\Cliente\TicketController as ClienteTicketController;
use Illuminate\Support\Facades\Route;
use App\Models\Ticket;
use App\Models\Inbox;
use App\Models\Estado;
use App\Models\TipoTicket;
use App\Models\Entidade;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.unificado.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/teste-tickets', function() {
    $tickets = Ticket::with(['estado', 'inbox', 'entidade', 'tipo'])->get();
    
    return view('admin.tickets.index', [
        'tickets' => $tickets,
        'filtros' => [
            'inboxes' => Inbox::all(),
            'estados' => Estado::all(),
            'tipos' => TipoTicket::all(),
            'entidades' => Entidade::all(),
        ]
    ]);
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('tickets', TicketController::class);
    Route::resource('entidades', EntidadeController::class);
    Route::resource('contactos', ContactoController::class);
});

Route::prefix('cliente')->name('cliente.')->group(function () {
    // Registro (público)
    Route::get('register', [ClienteAuthController::class, 'showRegister'])->name('register');
    Route::post('register', [ClienteAuthController::class, 'register'])->name('register.post');
    
    // Área do Cliente (com autenticação)
    Route::middleware('auth:contacto')->group(function () {
        Route::get('dashboard', [ClienteDashboardController::class, 'index'])->name('dashboard');
        Route::resource('tickets', ClienteTicketController::class);
        Route::post('tickets/{ticket}/responder', [ClienteTicketController::class, 'responder'])->name('tickets.responder');
    });
});
