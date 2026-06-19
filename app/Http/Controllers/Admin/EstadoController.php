<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function index()
    {
        $estados = Estado::withCount('tickets')->get();
        
        return view('admin.estados.index', compact('estados'));
    }
    
    public function create()
    {
        return view('admin.estados.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:estados|max:50',
            'cor' => 'nullable|max:20',
        ]);
        
        $estado = Estado::create($request->all());
        
        return redirect()->route('admin.estados.index')
            ->with('success', "Estado {$estado->nome} criado com sucesso!");
    }
    
    public function edit(Estado $estado)
    {
        return view('admin.estados.edit', compact('estado'));
    }
    
    public function update(Request $request, Estado $estado)
    {
        $request->validate([
            'nome' => 'required|max:50|unique:estados,nome,' . $estado->id,
            'cor' => 'nullable|max:20',
        ]);
        
        $estado->update($request->all());
        
        return redirect()->route('admin.estados.index')
            ->with('success', "Estado {$estado->nome} atualizado com sucesso!");
    }
    
    public function destroy(Estado $estado)
    {
        if ($estado->tickets()->count() > 0) {
            return back()->with('error', "Não é possível remover o estado {$estado->nome} pois existem tickets associados!");
        }
        
        $nome = $estado->nome;
        $estado->delete();
        
        return redirect()->route('admin.estados.index')
            ->with('success', "Estado {$nome} removido!");
    }
}