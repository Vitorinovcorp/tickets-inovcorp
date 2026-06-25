<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-unificado');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $email = $request->email;
        $password = $request->password;

        // 1. Tentar login como admin (users)
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // 2. Tentar login como cliente (contactos)
        if (Auth::guard('contacto')->attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->route('cliente.dashboard');
        }

        return back()->withErrors([
            'email' => 'As credenciais não correspondem aos nossos registos.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Fazer logout de ambos os guards
        Auth::logout();
        Auth::guard('contacto')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirecionar para a página de login
        return redirect()->route('login');
    }
}