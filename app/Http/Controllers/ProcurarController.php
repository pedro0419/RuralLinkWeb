<?php

namespace App\Http\Controllers;

use App\Models\Postagem; // <- era Post, agora Postagem
use Illuminate\Http\Request;

class ProcurarController extends Controller
{
    public function index(Request $request)
    {
        $query = Postagem::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->search . '%')
                  ->orWhere('descricao', 'like', '%' . $request->search . '%')
                  ->orWhere('preco_kg', 'like', '%' . $request->search . '%')
                  ->orWhere('quantidade', 'like', '%' . $request->search . '%')
                  ->orWhere('selo', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('selo')) {
            $query->where('selo', $request->selo);
        }

        $resultados = $query->with('user')->get()->map(function ($post) {
            return [
                'id'         => $post->id,
                'user_id'    => $post->user_id,
                'user_name'  => $post->user->name ?? null,
                'user_phone' => $post->user->phone ?? null,
                'foto'       => $post->foto,
                'nome'       => $post->nome,
                'selo'       => $post->selo,
                'preco_kg'   => $post->preco_kg,
                'quantidade' => $post->quantidade,
                'descricao'  => $post->descricao,
                'created_at' => $post->created_at?->timezone('America/Sao_Paulo')->format('d/m/Y H:i'),
            ];
        });

        return view('procurar.index', [
            'resultados' => $resultados,
            'search'     => $request->search,
            'selo'       => $request->selo,
        ]);
    }
}