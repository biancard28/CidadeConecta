<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CidadeController;

Route::get('/cidade', [CidadeController::class,'index'])->name('cidade.index');
Route::get('/cidade/create', [CidadeController::class,'create'])->name('cidade.create');
Route::post('/cidade', [CidadeController::class,'store'])->name('cidade.store');
Route::resource('users', UserController::class);


