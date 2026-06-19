<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoTicket;
use Illuminate\Http\Request;

class TipoTicketController extends Controller
{
    public function index()
    {
        $tipos = TipoTicket::withCount('tickets')->get();
        
        return view('admin.tipos.index', compact('tipos'));
    }
    
    public function create()
    {
        return view('admin.tipos.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:tipos_ticket|max:100',
        ]);
        
        $tipo = TipoTicket::create($request->all());
        
        return redirect()->route('admin.tipos.index')
            ->with('success', "Tipo {$tipo->nome} criado com sucesso!");
    }
    
    public function edit(TipoTicket $tipo)
    {
        return view('admin.tipos.edit', compact('tipo'));
    }
    
    public function update(Request $request, TipoTicket $tipo)
    {
        $request->validate([
            'nome' => 'required|max:100|unique:tipos_ticket,nome,' . $tipo->id,
        ]);
        
        $tipo->update($request->all());
        
        return redirect()->route('admin.tipos.index')
            ->with('success', "Tipo {$tipo->nome} atualizado com sucesso!");
    }
    
    public function destroy(TipoTicket $tipo)
    {
        if ($tipo->tickets()->count() > 0) {
            return back()->with('error', "Não é possível remover o tipo {$tipo->nome} pois existem tickets associados!");
        }
        
        $nome = $tipo->nome;
        $tipo->delete();
        
        return redirect()->route('admin.tipos.index')
            ->with('success', "Tipo {$nome} removido!");
    }
}