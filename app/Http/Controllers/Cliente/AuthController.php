<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('cliente.auth.login');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $contacto = Contacto::where('email', $request->email)->first();
        
        if (!$contacto) {
            return back()->with('error', 'Email não encontrado!');
        }
        
        Auth::guard('contacto')->login($contacto);
        
        return redirect()->route('cliente.dashboard')
            ->with('success', 'Bem-vindo ao Tickets Inovcorp!');
    }
    
    public function logout()
    {
        Auth::guard('contacto')->logout();
        
        return redirect()->route('cliente.login')
            ->with('success', 'Logout realizado com sucesso!');
    }
}