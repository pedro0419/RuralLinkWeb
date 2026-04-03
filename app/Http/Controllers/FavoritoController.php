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
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $favoritos = $user->favoritos()->latest('favoritos.created_at')->get();

        return view('favoritos.index', compact('favoritos'));
    }
}
