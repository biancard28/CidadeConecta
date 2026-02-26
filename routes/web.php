<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\CategoriaController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| ROTAS CIDADE
|--------------------------------------------------------------------------
*/

Route::get('/cidade', [CidadeController::class,'index'])->name('cidade.index');
Route::get('/cidade/create', [CidadeController::class,'create'])->name('cidade.create');
Route::post('/cidade', [CidadeController::class,'store'])->name('cidade.store');
Route::get('/cidade/{id}/edit', [CidadeController::class,'edit'])->name('cidade.edit');
Route::put('/cidade/{id}', [CidadeController::class,'update'])->name('cidade.update');
Route::delete('/cidade/{id}', [CidadeController::class,'destroy'])->name('cidade.destroy');

/*
|--------------------------------------------------------------------------
| ROTAS CATEGORIAS
|--------------------------------------------------------------------------
*/

Route::resource('categorias', CategoriaController::class);

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

});

require __DIR__.'/auth.php';
