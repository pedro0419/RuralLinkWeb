<?php

namespace App\Http\Controllers;

use App\Models\Postagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    // Salva ou remove dos favoritos
    public function toggle($postagem_id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $postagem = Postagem::findOrFail($postagem_id);

        if ($user->favoritos()->where('postagem_id', $postagem_id)->exists()) {
            $user->favoritos()->detach($postagem_id);
        } else {
            $user->favoritos()->attach($postagem_id);
        }

        return back();
    }

    // Página de salvos
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = $user->favoritos()->latest('favoritos.created_at');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->search . '%')
                ->orWhere('descricao', 'like', '%' . $request->search . '%')
                ->orWhere('selo', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('selo')) {
            $query->where('selo', $request->selo);
        }

        $favoritos = $query->get();

        return view('Favoritos.index', compact('favoritos'));
    }
}

