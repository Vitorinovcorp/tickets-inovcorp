<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('contacto')->attempt($credentials)) {
            return redirect()->route('cliente.dashboard')
                ->with('success', 'Bem-vindo ao Tickets Inovcorp!');
        }

        return back()->with('error', 'Credenciais inválidas. Verifique seu email e senha.');
    }

    public function logout()
    {
        Auth::guard('contacto')->logout();
        return redirect()->route('cliente.login')
            ->with('success', 'Logout realizado com sucesso!');
    }

    public function showRegister()
    {
        $entidades = \App\Models\Entidade::all();
        return view('cliente.auth.register', compact('entidades'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'email' => 'required|email|unique:contactos',
            'password' => 'required|min:6|confirmed',
            'entidade_id' => 'required|exists:entidades,id',
            'telefone' => 'nullable|max:20',
        ]);

        $contacto = Contacto::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefone' => $request->telefone,
            'funcao_id' => 1, // Cliente
        ]);

        // Associar à entidade
        $contacto->entidades()->attach($request->entidade_id);

        Auth::guard('contacto')->login($contacto);

        return redirect()->route('cliente.dashboard')
            ->with('success', 'Conta criada com sucesso!');
    }
}