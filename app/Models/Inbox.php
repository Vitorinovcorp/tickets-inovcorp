<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $table = 'inboxes';
    protected $fillable = ['nome', 'email', 'descricao'];
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'inbox_user');
    }
}