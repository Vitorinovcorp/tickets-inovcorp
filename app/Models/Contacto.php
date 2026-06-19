<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contacto extends Authenticatable
{
    protected $table = 'contactos';
    protected $fillable = [
        'nome', 'funcao_id', 'email', 'telefone', 
        'telemovel', 'notas_internas'
    ];
    
    protected $guard = 'contacto';
    
    public function funcao()
    {
        return $this->belongsTo(Funcao::class);
    }
    
    public function entidades()
    {
        return $this->belongsToMany(Entidade::class, 'entidade_contacto');
    }
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'contacto_criador_id');
    }
    
    public function respostas()
    {
        return $this->hasMany(Resposta::class);
    }
}