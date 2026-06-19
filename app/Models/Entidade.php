<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entidade extends Model
{
    protected $table = 'entidades';
    protected $fillable = [
        'nif', 'nome', 'telefone', 'telemovel', 
        'website', 'email', 'notas_internas'
    ];
    
    public function contactos()
    {
        return $this->belongsToMany(Contacto::class, 'entidade_contacto');
    }
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}