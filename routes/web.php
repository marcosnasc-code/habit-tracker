<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function () {
    return 'Teste Rotas Laravel';
});

//Route::get('/rotaController', [SiteController::class, 'index'])->name('home');

// Rota de Login
Route::get('/login', [LoginController::class, 'login'])->name('login');

// Rota de Autenticação
Route::post('/login', [LoginController::class, 'authenticate']);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('dashboard');
});
