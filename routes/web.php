<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\EntidadeController;
use App\Http\Controllers\Admin\ContactoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Ticket;
use App\Models\Inbox;
use App\Models\Estado;
use App\Models\TipoTicket;
use App\Models\Entidade;

Route::get('/', function () {
    return view('welcome');
});

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('profile.edit');

require __DIR__.'/auth.php';