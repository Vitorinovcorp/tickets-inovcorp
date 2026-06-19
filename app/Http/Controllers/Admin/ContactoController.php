<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contacto;
use App\Models\Funcao;
use App\Models\Entidade;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index(Request $request)
    {
        $query = Contacto::with('funcao', 'entidades');
        
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nome', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('telefone', 'LIKE', "%{$search}%");
            });
        }
        
        if ($request->funcao_id) {
            $query->where('funcao_id', $request->funcao_id);
        }
        
        $contactos = $query->paginate(20);
        $funcoes = Funcao::all();
        
        return view('admin.contactos.index', compact('contactos', 'funcoes'));
    }
    
    public function create()
    {
        $funcoes = Funcao::all();
        $entidades = Entidade::all();
        
        return view('admin.contactos.create', compact('funcoes', 'entidades'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'funcao_id' => 'required|exists:funcoes,id',
            'email' => 'required|email|unique:contactos|max:255',
            'telefone' => 'nullable|max:20',
            'telemovel' => 'nullable|max:20',
            'notas_internas' => 'nullable',
            'entidades' => 'nullable|array',
            'entidades.*' => 'exists:entidades,id',
        ]);
        
        $contacto = Contacto::create($request->except('entidades'));
        
        if ($request->entidades) {
            $contacto->entidades()->attach($request->entidades);
        }
        
        return redirect()->route('admin.contactos.index')
            ->with('success', "Contacto {$contacto->nome} criado com sucesso!");
    }
    
    public function show(Contacto $contacto)
    {
        $contacto->load(['funcao', 'entidades', 'tickets' => function($query) {
            $query->latest()->limit(10);
        }]);
        
        return view('admin.contactos.show', compact('contacto'));
    }
    
    public function edit(Contacto $contacto)
    {
        $funcoes = Funcao::all();
        $entidades = Entidade::all();
        $contacto->load('entidades');
        
        return view('admin.contactos.edit', compact('contacto', 'funcoes', 'entidades'));
    }
    
    public function update(Request $request, Contacto $contacto)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'funcao_id' => 'required|exists:funcoes,id',
            'email' => 'required|email|unique:contactos,email,' . $contacto->id,
            'telefone' => 'nullable|max:20',
            'telemovel' => 'nullable|max:20',
            'notas_internas' => 'nullable',
            'entidades' => 'nullable|array',
            'entidades.*' => 'exists:entidades,id',
        ]);
        
        $contacto->update($request->except('entidades'));
        $contacto->entidades()->sync($request->entidades ?? []);
        
        return redirect()->route('admin.contactos.index')
            ->with('success', "Contacto {$contacto->nome} atualizado com sucesso!");
    }
    
    public function destroy(Contacto $contacto)
    {
        $nome = $contacto->nome;
        $contacto->delete();
        
        return redirect()->route('admin.contactos.index')
            ->with('success', "Contacto {$nome} removido!");
    }
}