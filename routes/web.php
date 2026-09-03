<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function (){
    return 'Teste Rotas Laravel';
});

Route::get('/rotaController', [SiteController::class, 'index']);
