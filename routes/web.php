<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function (){
    return 'Teste Rotas Laravel';
});

Route::get('/rotaController', [\App\Http\Controllers\SiteController::class, 'index']);
