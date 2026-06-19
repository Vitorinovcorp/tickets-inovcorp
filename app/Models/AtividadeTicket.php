<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtividadeTicket extends Model
{
    protected $table = 'atividade_tickets';
    protected $fillable = ['ticket_id', 'acao', 'dados_antigos', 'dados_novos', 'user_id'];
    
    protected $casts = [
        'dados_antigos' => 'array',
        'dados_novos' => 'array',
    ];
    
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}