<?php

namespace App\Http\Controllers;

use App\Models\Postagem;
use Illuminate\Http\Request;

class PostagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Postagem::with('user');
    
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->search . '%')
                  ->orWhere('descricao', 'like', '%' . $request->search . '%')
                  ->orWhere('selo', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function ($u) use ($request) {
                      $u->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }
    
        if ($request->filled('selo')) {
            $query->where('selo', $request->selo);
        }
    
        $posts = $query->latest()->get();
    
        return view('homePage', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        return view('post.postCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto'        => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'nome'        => 'required|string|max:255',
            'selo'        => 'required|string|in:organico,empresa,autonomo,cooperativa',
            'preco_kg'    => 'required|numeric|min:0.01',
            'quantidade'  => 'required|numeric|min:0.1',
            'descricao'   => 'nullable|string|max:1000',
        ],[
            'foto.required'       => 'A foto do produto é obrigatória.',
            'foto.image'          => 'O arquivo deve ser uma imagem.',
            'foto.mimes'          => 'Formatos aceitos: jpeg, png, jpg, webp.',
            'foto.max'            => 'A imagem não pode ultrapassar 2MB.',
            'nome.required'       => 'O nome do produto é obrigatório.',
            'nome.max'            => 'O nome não pode ter mais de 255 caracteres.',
            'selo.required'       => 'Selecione o selo do produto.',
            'selo.in'             => 'Selo inválido.',
            'preco_kg.required'   => 'O preço por kg é obrigatório.',
            'preco_kg.numeric'    => 'O preço deve ser um número.',
            'preco_kg.min'        => 'O preço deve ser maior que zero.',
            'quantidade.required' => 'A quantidade disponível é obrigatória.',
            'quantidade.numeric'  => 'A quantidade deve ser um número.',
            'quantidade.min'      => 'A quantidade deve ser maior que zero.',
        ]);

        $fotoPath = $request->file('foto')->store('produtos', 's3');

        Postagem::create([
            'user_id'    => auth()->id(),
            'foto'       => $fotoPath,
            'nome'       => $request->nome,
            'selo'       => $request->selo,
            'preco_kg'   => $request->preco_kg,
            'quantidade' => $request->quantidade,
            'descricao'  => $request->descricao,
        ]);

        
       return redirect()->route('perfil.show')
        ->with('success', 'Produto publicado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Postagem $postagem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Postagem $postagem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Postagem $postagem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $postagem = Postagem::findOrFail($id);

        if ($postagem->user_id !== auth()->id()) {
            return redirect()->back()
                ->with('error', 'Você não tem permissão para deletar esta postagem.');
        }

        $postagem->delete();

        return redirect()->route('perfil.show')
            ->with('success', 'Postagem deletada com sucesso!');
    }
}