<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\LeitorController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('livros', LivroController::class);
Route::resource('leitores', LeitorController::class);

Route::resource('emprestimos', EmprestimoController::class)
    ->only(['index', 'create', 'store', 'show']);
