<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use App\Models\User;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index(Request $request)
    {
        $query = Inbox::withCount('tickets');
        
        if ($request->search) {
            $search = $request->search;
            $query->where('nome', 'LIKE', "%{$search}%");
        }
        
        $inboxes = $query->paginate(20);
        
        return view('admin.inboxes.index', compact('inboxes'));
    }
    
    public function create()
    {
        $operadores = User::all();
        
        return view('admin.inboxes.create', compact('operadores'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:inboxes|max:100',
            'email' => 'nullable|email|max:255',
            'descricao' => 'nullable',
            'operadores' => 'nullable|array',
            'operadores.*' => 'exists:users,id',
        ]);
        
        $inbox = Inbox::create($request->except('operadores'));
        
        if ($request->operadores) {
            $inbox->users()->sync($request->operadores);
        }
        
        return redirect()->route('admin.inboxes.index')
            ->with('success', "Departamento {$inbox->nome} criado com sucesso!");
    }
    
    public function show(Inbox $inbox)
    {
        $inbox->load(['users', 'tickets' => function($query) {
            $query->latest()->limit(20);
        }]);
        
        return view('admin.inboxes.show', compact('inbox'));
    }
    
    public function edit(Inbox $inbox)
    {
        $operadores = User::all();
        $inbox->load('users');
        
        return view('admin.inboxes.edit', compact('inbox', 'operadores'));
    }
    
    public function update(Request $request, Inbox $inbox)
    {
        $request->validate([
            'nome' => 'required|max:100|unique:inboxes,nome,' . $inbox->id,
            'email' => 'nullable|email|max:255',
            'descricao' => 'nullable',
            'operadores' => 'nullable|array',
            'operadores.*' => 'exists:users,id',
        ]);
        
        $inbox->update($request->except('operadores'));
        $inbox->users()->sync($request->operadores ?? []);
        
        return redirect()->route('admin.inboxes.index')
            ->with('success', "Departamento {$inbox->nome} atualizado com sucesso!");
    }
    
    public function destroy(Inbox $inbox)
    {
        $nome = $inbox->nome;
        $inbox->delete();
        
        return redirect()->route('admin.inboxes.index')
            ->with('success', "Departamento {$nome} removido!");
    }
}