<?php

namespace App\Traits;

use App\Models\Anexo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadAnexos
{
    public function salvarAnexo($file, $ticketId, $respostaId = null)
    {
        $extensao = $file->getClientOriginalExtension();
        $nomeOriginal = $file->getClientOriginalName();
        $mimeType = $file->getMimeType();
        $tamanho = $file->getSize();
        
        $nomeArquivo = Str::uuid() . '.' . $extensao;
        $caminho = 'anexos/tickets/' . $ticketId . '/' . $nomeArquivo;
        
        $file->storeAs('public/' . dirname($caminho), $nomeArquivo);
        
        return Anexo::create([
            'ticket_id' => $ticketId,
            'resposta_id' => $respostaId,
            'nome_original' => $nomeOriginal,
            'nome_arquivo' => $nomeArquivo,
            'caminho' => $caminho,
            'mime_type' => $mimeType,
            'tamanho' => $tamanho,
            'extensao' => $extensao,
            'uploaded_by' => auth()->id(),
        ]);
    }
    
    public function validarAnexo($file)
    {
        $tiposPermitidos = [
            'image/jpeg', 'image/png', 'image/gif', 'image/webp',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/plain',
            'application/zip',
            'application/x-rar-compressed',
        ];
        
        $extensoesPermitidas = [
            'jpg', 'jpeg', 'png', 'gif', 'webp',
            'pdf', 'doc', 'docx', 'xls', 'xlsx',
            'txt', 'zip', 'rar'
        ];
        
        $mimeType = $file->getMimeType();
        $extensao = $file->getClientOriginalExtension();
        $tamanho = $file->getSize();
        
        if (!in_array($mimeType, $tiposPermitidos) && !in_array(strtolower($extensao), $extensoesPermitidas)) {
            return ['valid' => false, 'message' => 'Tipo de arquivo não permitido.'];
        }
        
        if ($tamanho > 10240 * 1024) {
            return ['valid' => false, 'message' => 'O arquivo não pode exceder 10MB.'];
        }
        
        return ['valid' => true];
    }
}