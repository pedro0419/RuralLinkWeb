<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostagemController;
use App\Http\Controllers\ProcurarController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return redirect()->route('login');
});

// Públicas
Route::get('/login',      [LoginController::class, 'showLogin'])->name('login');
Route::post('/login',     [LoginController::class, 'login'])->name('login.post');
Route::get('/registrar',  [LoginController::class, 'showRegistro'])->name('registro');
Route::post('/registrar', [LoginController::class, 'registro'])->name('registro.post');
Route::post('/logout',    [LoginController::class, 'logout'])->name('logout');

Route::get('/busca', [ProcurarController::class, 'index'])->name('procurar.index');

// Protegidas (precisa estar logado)
Route::middleware('auth')->group(function () {
    Route::get('/TelaInicial',           [PostagemController::class, 'index'])->name('post.index');
    Route::get('/postagem/create',    [PostagemController::class, 'create'])->name('post.create');
    Route::post('/postagem',          [PostagemController::class, 'store'])->name('post.store');
    Route::delete('/postagem/{id}',   [PostagemController::class, 'destroy'])->name('post.delete');

    Route::get('/perfil/editar', [LoginController::class, 'showEditPerfil'])->name('perfil.edit');
    Route::put('/perfil/editar', [LoginController::class, 'updatePerfil'])->name('perfil.update');
    Route::get('/perfil', [LoginController::class, 'showPerfil'])->name('perfil.show');
    
    Route::get('/salvos', [FavoritoController::class, 'index'])->name('favoritos.index');
    Route::post('/favoritos/{postagem_id}', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');
});

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
     Route::get('/dashboard',         [AdminController::class, 'dashboard'])       ->name('dashboard');
     Route::get('/usuarios',          [AdminController::class, 'usuarios'])        ->name('usuarios');
     Route::delete('/usuarios/{user}',[AdminController::class, 'banirUsuario'])    ->name('banir');
     Route::get('/postagens',         [AdminController::class, 'postagens'])       ->name('postagens');
     Route::delete('/postagens/{postagem}', [AdminController::class, 'excluirPostagem'])->name('excluir-postagem');
 });