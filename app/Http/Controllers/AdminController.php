<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use App\Models\Postagem;
use Illuminate\Http\Request;
 
class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsuarios  = User::count();
        $totalPostagens = Postagem::count();
        $recentPostagens = Postagem::with('user')
            ->latest()
            ->take(5)
            ->get();
 
        return view('admin.dashboard', compact('totalUsuarios', 'totalPostagens', 'recentPostagens'));
    }
 
    public function usuarios()
    {
        $usuarios = User::withCount('postagens')->latest()->paginate(15);
        return view('admin.usuarios', compact('usuarios'));
    }
 
    public function banirUsuario($id)
    {
        $user = User::find($id);

        if (!$user) {
            return back()->with('erro', 'Esse usuário já foi removido. Atualize a página.');
        }

        if ($user->role === 'admin') {
            return back()->with('erro', 'Não é possível banir um administrador.');
        }

        $user->delete();
        return back()->with('sucesso', "Usuário {$user->name} removido com sucesso.");
    }
 
    public function postagens(Request $request)
    {
        $query = Postagem::with('user')->latest();
 
        if ($request->filled('selo')) {
            $query->where('selo', $request->selo);
        }
 
        if ($request->filled('busca')) {
            $query->where('nome', 'like', '%' . $request->busca . '%');
        }
 
        $postagens = $query->get();
        return view('admin.postagens', compact('postagens'));
    }
 
    public function excluirPostagem($id)
    {
        $postagem = Postagem::find($id);

        if (!$postagem) {
            return back()->with('erro', 'Essa postagem já foi excluída. Atualize a página.');
        }

        $postagem->delete();
        return back()->with('sucesso', 'Postagem excluída com sucesso.');
    }
}