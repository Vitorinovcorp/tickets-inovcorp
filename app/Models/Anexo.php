<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Anexo extends Model
{
    protected $table = 'anexos';
    protected $fillable = [
        'ticket_id',
        'resposta_id',
        'nome_original',
        'nome_arquivo',
        'caminho',
        'mime_type',
        'tamanho',
        'extensao',
        'uploaded_by'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function resposta()
    {
        return $this->belongsTo(Resposta::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getUrlAttribute()
    {
        return Storage::url($this->caminho);
    }

    public function getTamanhoFormatadoAttribute()
    {
        $bytes = $this->tamanho;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getIconeAttribute()
    {
        $extensao = strtolower($this->extensao);
        $icones = [
            'pdf' => 'fa-file-pdf',
            'doc' => 'fa-file-word',
            'docx' => 'fa-file-word',
            'xls' => 'fa-file-excel',
            'xlsx' => 'fa-file-excel',
            'csv' => 'fa-file-csv',
            'jpg' => 'fa-file-image',
            'jpeg' => 'fa-file-image',
            'png' => 'fa-file-image',
            'gif' => 'fa-file-image',
            'webp' => 'fa-file-image',
            'zip' => 'fa-file-archive',
            'rar' => 'fa-file-archive',
            'txt' => 'fa-file-alt',
            'php' => 'fa-file-code',
            'html' => 'fa-file-code',
            'css' => 'fa-file-code',
            'js' => 'fa-file-code',
            'json' => 'fa-file-code',
            'mp4' => 'fa-file-video',
            'avi' => 'fa-file-video',
            'mp3' => 'fa-file-audio',
            'wav' => 'fa-file-audio',
        ];
        return $icones[$extensao] ?? 'fa-file';
    }

    public function getCorAttribute()
    {
        $cores = [
            'jpg' => 'success',
            'jpeg' => 'success',
            'png' => 'success',
            'gif' => 'success',
            'webp' => 'success',
            'pdf' => 'danger',
            'doc' => 'primary',
            'docx' => 'primary',
            'xls' => 'success',
            'xlsx' => 'success',
            'txt' => 'secondary',
            'zip' => 'warning',
            'rar' => 'warning',
            'json' => 'dark',
            'csv' => 'info',
        ];
        return $cores[strtolower($this->extensao)] ?? 'secondary';
    }
}