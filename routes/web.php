<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CidadeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cidade/{id}/edit', [CidadeController::class,'edit'])->name('cidade.edit');
Route::put('/cidade/{id}', [CidadeController::class,'update'])->name('cidade.update');
Route::delete('/cidade/{id}', [CidadeController::class,'destroy'])->name('cidade.destroy');

Route::get('/cidade', [CidadeController::class,'index'])->name('cidade.index');
Route::get('/cidade/create', [CidadeController::class,'create'])->name('cidade.create');
Route::post('/cidade', [CidadeController::class,'store'])->name('cidade.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
