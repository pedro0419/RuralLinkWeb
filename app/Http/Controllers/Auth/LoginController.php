<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    // Mostra a página de login
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('post.index');
        }
        return view('auth.login');
    }

    // Processa o login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'O e-mail é obrigatório.',
            'email.email'       => 'Digite um e-mail válido.',
            'password.required' => 'A senha é obrigatória.',
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('lembrar'))) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'E-mail ou senha incorretos.']);
        }

        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
        }

        return redirect()->intended(route('post.index'));
    }

    // Mostra a página de registro
    public function showRegistro()
    {
        if (Auth::check()) {
            return redirect()->route('post.index');
        }
        return view('auth.registro');
    }

    // Processa o registro
    public function registro(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users',
            'phone'         => 'required|string',
            'location'      => 'required|string|max:255',
            'password'      => 'required|min:6|confirmed',
            'profile_image' => 'nullable|image|max:2048',
            'description'   => 'nullable|string',
        ], [
            'name.required'      => 'O nome é obrigatório.',
            'email.required'     => 'O e-mail é obrigatório.',
            'email.email'        => 'Digite um e-mail válido.',
            'email.unique'       => 'Este e-mail já está cadastrado.',
            'phone.required'     => 'O telefone é obrigatório.',
            'location.required'  => 'A localização é obrigatória.',
            'password.required'  => 'A senha é obrigatória.',
            'password.min'       => 'A senha deve ter no mínimo 6 caracteres.',
            'password.confirmed' => 'As senhas não conferem.',
            'profile_image.image'=> 'O arquivo deve ser uma imagem.',
            'profile_image.max'  => 'A imagem não pode ultrapassar 2MB.',
        ]);

        $imagePath = null;
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profiles', 'public');
        }

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'location'      => $request->location,
            'password'      => Hash::make($request->password),
            'profile_image' => $imagePath,
            'description'   => $request->description,
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('post.index');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // ============================================================
    // Adicione estes dois métodos ao seu LoginController existente
    // (dentro da classe LoginController)
    // ============================================================
 
    // Mostra a página de edição de perfil
    public function showEditPerfil()
    {
        return view('auth.editPerfil', ['user' => Auth::user()]);
    }
 
    // Processa a atualização do perfil
    public function updatePerfil(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name'          => 'required|string|max:255',
        'description'   => 'nullable|string|max:1000',
        'location'      => 'required|string|max:255',
        'phone'         => 'required|string|max:20',
        'profile_image' => 'nullable|image|max:2048',
    ], [
        'name.required'     => 'O nome é obrigatório.',
        'name.max'          => 'O nome pode ter no máximo 255 caracteres.',
        'location.required' => 'A localização é obrigatória.',
        'location.max'      => 'A localização pode ter no máximo 255 caracteres.',
        'phone.required'    => 'O telefone é obrigatório.',
        'phone.max'         => 'O telefone pode ter no máximo 20 caracteres.',
        'description.max'   => 'A descrição pode ter no máximo 1000 caracteres.',
    ]);

    $data = [
        'name'        => $request->name,
        'description' => $request->description,
        'location'    => $request->location,
        'phone'       => $request->phone,
    ];

    // Só processa a imagem se um arquivo foi enviado
    if ($request->hasFile('profile_image')) {
        // Deleta a imagem antiga se existir
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        // Faz o upload e salva o caminho
        $data['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
    }

    $user->update($data);

    return redirect()->route('perfil.edit')
        ->with('success', 'Perfil atualizado com sucesso!');
    }
    public function showPerfil()
{
        $user = Auth::user()->load('postagens');
        return view('auth.perfil', compact('user'));
    }
}
