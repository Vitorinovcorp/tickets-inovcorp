<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketConhecimento extends Model
{
    protected $table = 'ticket_conhecimento';
    protected $fillable = ['ticket_id', 'email'];
    
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}