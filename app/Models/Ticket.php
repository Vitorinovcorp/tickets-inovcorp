<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = [
        'numero_ticket', 'assunto', 'tipo_id', 'mensagem', 
        'estado_id', 'operador_associado_id', 'entidade_id', 
        'contacto_criador_id', 'inbox_id'
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($ticket) {
            $lastTicket = Ticket::latest('id')->first();
            $nextNumber = $lastTicket ? intval(substr($lastTicket->numero_ticket, 3)) + 1 : 1;
            $ticket->numero_ticket = 'TC-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        });
    }
    
    public function tipo()
    {
        return $this->belongsTo(TipoTicket::class, 'tipo_id');
    }
    
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
    
    public function operador()
    {
        return $this->belongsTo(User::class, 'operador_associado_id');
    }
    
    public function entidade()
    {
        return $this->belongsTo(Entidade::class);
    }
    
    public function contacto()
    {
        return $this->belongsTo(Contacto::class, 'contacto_criador_id');
    }
    
    public function inbox()
    {
        return $this->belongsTo(Inbox::class);
    }
    
    public function conhecimentos()
    {
        return $this->hasMany(TicketConhecimento::class);
    }
    
    public function respostas()
    {
        return $this->hasMany(Resposta::class)->orderBy('created_at', 'asc');
    }
    
    public function atividades()
    {
        return $this->hasMany(AtividadeTicket::class)->orderBy('created_at', 'desc');
    }
}