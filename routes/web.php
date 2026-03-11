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

Route::get('/cidade/create', [CidadeController::class,'create'])->name('cidade.create');

Route::get('/cidade/{cidade}', [CidadeController::class,'show'])->name('cidade.show');

Route::get('/cidade', [CidadeController::class,'index'])->name('cidade.index');

Route::post('/cidade', [CidadeController::class,'store'])->name('cidade.store');

Route::get('/cidade/{id}/edit', [CidadeController::class,'edit'])->name('cidade.edit');

Route::put('/cidade/{id}', [CidadeController::class,'update'])->name('cidade.update');

Route::delete('/cidade/{id}', [CidadeController::class,'destroy'])->name('cidade.destroy');

Route::get('/cidade/{cidade}/usuarios', [CidadeUsuarioController::class, 'index'])->name('cidade.usuarios');

Route::get('/cidade/{cidade}/usuarios/create', [CidadeUsuarioController::class, 'create'])->name('cidade.usuarios.create');

Route::post('/cidade/{cidade}/usuarios', [CidadeUsuarioController::class, 'store'])->name('cidade.usuarios.store');

Route::delete('/cidade/{cidade}/usuarios/{user}', [CidadeUsuarioController::class, 'destroy'])->name('cidade.usuarios.destroy');


/*
|--------------------------------------------------------------------------
| ROTAS CATEGORIAS (somente ações usadas dentro da cidade)
|--------------------------------------------------------------------------
*/

Route::post('/categorias', [CategoriaController::class,'store'])->name('categorias.store');

Route::get('/categorias/{id}/edit', [CategoriaController::class,'edit'])->name('categorias.edit');

Route::put('/categorias/{id}', [CategoriaController::class,'update'])->name('categorias.update');

Route::delete('/categorias/{id}', [CategoriaController::class,'destroy'])->name('categorias.destroy');


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
