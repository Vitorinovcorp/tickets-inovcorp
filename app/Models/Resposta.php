<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    protected $table = 'respostas';
    protected $fillable = ['ticket_id', 'user_id', 'contacto_id', 'mensagem'];
    
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function contacto()
    {
        return $this->belongsTo(Contacto::class);
    }
    
    public function getNomeResponsavelAttribute()
    {
        if ($this->user_id) {
            return $this->user->name;
        }
        if ($this->contacto_id) {
            return $this->contacto->nome;
        }
        return 'Sistema';
    }
}