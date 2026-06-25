<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Contacto extends Authenticatable
{
    use Notifiable;

    protected $table = 'contactos';
    protected $guard = 'contacto';
    
    protected $fillable = [
        'nome', 
        'funcao_id', 
        'email', 
        'password',
        'telefone', 
        'telemovel', 
        'notas_internas'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function funcao()
    {
        return $this->belongsTo(Funcao::class);
    }
    
    public function entidades()
    {
        return $this->belongsToMany(Entidade::class, 'entidade_contacto', 'contacto_id', 'entidade_id');
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