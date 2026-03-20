<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\CidadeUsuarioController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
})->name('home');

/*
|--------------------------------------------------------------------------
| AUTOCOMPLETE (PÚBLICO) 🔥
|--------------------------------------------------------------------------
*/
Route::get('/cidades/autocomplete', [CidadeController::class, 'autocomplete']);

/*
|--------------------------------------------------------------------------
| ROTAS PROTEGIDAS (LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | CIDADES
    |--------------------------------------------------------------------------
    */
    Route::resource('cidades', CidadeController::class);

    /*
    |--------------------------------------------------------------------------
    | USUÁRIOS DA CIDADE
    |--------------------------------------------------------------------------
    */
    Route::get('/cidades/usuarios', [CidadeUsuarioController::class, 'index'])->name('cidades.usuarios.index');
    Route::get('/cidades/usuarios/create', [CidadeUsuarioController::class, 'create'])->name('cidades.usuarios.create');
    Route::post('/cidades/usuarios', [CidadeUsuarioController::class, 'store'])->name('cidades.usuarios.store');
    Route::delete('/cidades/usuarios/{user}', [CidadeUsuarioController::class, 'destroy'])->name('cidades.usuarios.destroy');

    /*
    |--------------------------------------------------------------------------
    | CATEGORIAS
    |--------------------------------------------------------------------------
    */
    Route::resource('categorias', CategoriaController::class);

    /*
    |--------------------------------------------------------------------------
    | EVENTOS
    |--------------------------------------------------------------------------
    */
    Route::resource('eventos', EventoController::class);

    /*
    |--------------------------------------------------------------------------
    | PERFIL
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| PAINEL ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/admin/cidades', [CidadeController::class, 'index'])
    ->name('cidades.painel')
    ->middleware('auth');

require __DIR__.'/auth.php';
