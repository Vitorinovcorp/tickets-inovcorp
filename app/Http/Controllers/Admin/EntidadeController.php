<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entidade;
use App\Models\Contacto;
use Illuminate\Http\Request;

class EntidadeController extends Controller
{
    public function index(Request $request)
    {
        $query = Entidade::withCount('tickets');
        
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nome', 'LIKE', "%{$search}%")
                  ->orWhere('nif', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        
        $entidades = $query->paginate(20);
        
        return view('admin.entidades.index', compact('entidades'));
    }
    
    public function create()
    {
        return view('admin.entidades.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nif' => 'required|unique:entidades|max:20',
            'nome' => 'required|max:255',
            'telefone' => 'nullable|max:20',
            'telemovel' => 'nullable|max:20',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'notas_internas' => 'nullable',
        ]);
        
        $entidade = Entidade::create($request->all());
        
        return redirect()->route('admin.entidades.index')
            ->with('success', "Entidade {$entidade->nome} criada com sucesso!");
    }
    
    public function show(Entidade $entidade)
    {
        $entidade->load(['contactos', 'tickets' => function($query) {
            $query->latest()->limit(10);
        }]);
        
        return view('admin.entidades.show', compact('entidade'));
    }
    
    public function edit(Entidade $entidade)
    {
        return view('admin.entidades.edit', compact('entidade'));
    }
    
    public function update(Request $request, Entidade $entidade)
    {
        $request->validate([
            'nif' => 'required|max:20|unique:entidades,nif,' . $entidade->id,
            'nome' => 'required|max:255',
            'telefone' => 'nullable|max:20',
            'telemovel' => 'nullable|max:20',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'notas_internas' => 'nullable',
        ]);
        
        $entidade->update($request->all());
        
        return redirect()->route('admin.entidades.index')
            ->with('success', "Entidade {$entidade->nome} atualizada com sucesso!");
    }
    
    public function destroy(Entidade $entidade)
    {
        $nome = $entidade->nome;
        $entidade->delete();
        
        return redirect()->route('admin.entidades.index')
            ->with('success', "Entidade {$nome} removida!");
    }
    
    public function addContacto(Request $request, Entidade $entidade)
    {
        $request->validate([
            'contacto_id' => 'required|exists:contactos,id',
        ]);
        
        $contacto = Contacto::find($request->contacto_id);
        $entidade->contactos()->attach($request->contacto_id);
        
        return back()->with('success', "Contacto {$contacto->nome} associado à entidade!");
    }
    
    public function removeContacto(Entidade $entidade, Contacto $contacto)
    {
        $entidade->contactos()->detach($contacto->id);
        
        return back()->with('success', "Contacto {$contacto->nome} removido da entidade!");
    }
}