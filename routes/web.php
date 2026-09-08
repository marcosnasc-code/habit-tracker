<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function () {
    return 'Teste Rotas Laravel';
});

Route::get('/rotashome', [SiteController::class, 'index'])->name('home');

// Rota de Login
Route::get('/login', [LoginController::class, 'login'])->name('login');

// Rota de Autenticação
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('dashboard');
});
