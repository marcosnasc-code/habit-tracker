<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function (){
    return 'Teste Rotas Laravel';
});

Route::get('/rotaController', [SiteController::class, 'index']);

//Rota de Login
Route::get('/login', [LoginController::class, 'login']);