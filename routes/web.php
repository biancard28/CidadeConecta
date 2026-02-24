<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD

Route::get('/', function () {
    return view('welcome');
});
=======
use App\Http\Controllers\UserController;
use App\Http\Controllers\CidadeController;

Route::get('/cidade', [CidadeController::class,'index'])->name('cidade.index');
Route::get('/cidade/create', [CidadeController::class,'create'])->name('cidade.create');
Route::post('/cidade', [CidadeController::class,'store'])->name('cidade.store');
Route::resource('users', UserController::class);
>>>>>>> f7be7f73ad3c9b4ffe25118100199a942a0c093b

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
