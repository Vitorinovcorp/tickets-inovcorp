<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoTicket extends Model
{
    protected $table = 'tipos_ticket';
    protected $fillable = ['nome'];
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'tipo_id');
    }
}