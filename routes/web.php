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
| ROTAS CIDADE
|--------------------------------------------------------------------------
*/

Route::get('/cidade/{cidade}/usuarios', [CidadeUsuarioController::class, 'index'])->name('cidade.usuarios');

Route::get('/cidade/{cidade}/usuarios/create', [CidadeUsuarioController::class, 'create'])->name('cidade.usuarios.create');

Route::post('/cidade/{cidade}/usuarios', [CidadeUsuarioController::class, 'store'])->name('cidade.usuarios.store');

Route::delete('/cidade/{cidade}/usuarios/{user}', [CidadeUsuarioController::class, 'destroy'])->name('cidade.usuarios.destroy');

// Cidades
Route::resource('cidade', CidadeController::class);

/*
|--------------------------------------------------------------------------
| ROTAS CATEGORIAS (somente ações usadas dentro da cidade)
|--------------------------------------------------------------------------
*/

// Categorias
Route::resource('categorias', CategoriaController::class)->except(['index', 'create', 'show']);
/*
|--------------------------------------------------------------------------
| DASHBOARD / AUTH
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('eventos', EventoController::class);

});

require __DIR__.'/auth.php';
