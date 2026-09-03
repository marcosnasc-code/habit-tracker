<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function index(){
        $nome = 'Marcos';
        $habits = ['Programar', 'Estudar', 'Jogar'];

        return view('rotashome', [
            'nome' => $nome,
            'habits' => $habits
        ]);
    }
}
