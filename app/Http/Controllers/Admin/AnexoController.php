<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anexo;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AnexoController extends Controller
{
    public function upload(Request $request, Ticket $ticket)
    {
        // Verificar se o ticket existe
        if (!$ticket) {
            return back()->with('error', 'Ticket não encontrado.');
        }

        $request->validate([
            'anexo' => 'required|file|max:10240|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx,txt,zip,rar,json,csv',
        ]);

        try {
            $file = $request->file('anexo');
            
            // Verificar se o arquivo é válido
            if (!$file->isValid()) {
                return back()->with('error', 'O arquivo não é válido. Erro: ' . $file->getError());
            }

            $extensao = $file->getClientOriginalExtension();
            $nomeOriginal = $file->getClientOriginalName();
            $mimeType = $file->getMimeType();
            $tamanho = $file->getSize();

            // Validar tipo de arquivo (segurança extra)
            $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'zip', 'rar', 'json', 'csv'];
            if (!in_array(strtolower($extensao), $extensoesPermitidas)) {
                return back()->with('error', 'Tipo de arquivo não permitido. Formatos aceitos: ' . implode(', ', $extensoesPermitidas));
            }

            // Validar tamanho (10MB)
            if ($tamanho > 10240 * 1024) {
                return back()->with('error', 'O arquivo não pode exceder 10MB.');
            }

            // Gerar nome único
            $nomeArquivo = Str::uuid() . '.' . $extensao;
            $caminho = 'anexos/tickets/' . $ticket->id . '/' . $nomeArquivo;

            // Salvar arquivo
            $path = $file->storeAs('public/' . dirname($caminho), $nomeArquivo);
            
            if (!$path) {
                return back()->with('error', 'Erro ao salvar o arquivo.');
            }

            // Criar registro no banco
            $anexo = Anexo::create([
                'ticket_id' => $ticket->id,
                'resposta_id' => $request->resposta_id ?? null,
                'nome_original' => $nomeOriginal,
                'nome_arquivo' => $nomeArquivo,
                'caminho' => $caminho,
                'mime_type' => $mimeType,
                'tamanho' => $tamanho,
                'extensao' => $extensao,
                'uploaded_by' => Auth::id(),
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Arquivo anexado com sucesso!',
                    'data' => $anexo
                ]);
            }

            return back()->with('success', 'Arquivo anexado com sucesso!');

        } catch (\Exception $e) {
            \Log::error('Erro no upload de anexo: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao fazer upload: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Erro ao fazer upload: ' . $e->getMessage());
        }
    }

    public function download(Anexo $anexo)
    {
        if (!Storage::exists('public/' . $anexo->caminho)) {
            abort(404, 'Arquivo não encontrado.');
        }

        return Storage::download('public/' . $anexo->caminho, $anexo->nome_original);
    }

    public function destroy(Anexo $anexo)
    {
        // Verificar permissão
        if (Auth::id() !== $anexo->uploaded_by && !Auth::user()->isAdmin()) {
            abort(403, 'Você não tem permissão para excluir este arquivo.');
        }

        // Remover arquivo físico
        if (Storage::exists('public/' . $anexo->caminho)) {
            Storage::delete('public/' . $anexo->caminho);
        }

        // Remover registro
        $anexo->delete();

        return back()->with('success', 'Arquivo removido com sucesso!');
    }
}