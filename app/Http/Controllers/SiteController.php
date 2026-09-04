<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    //
    public function index()
    {
        $nome = auth()->user()?->name ?? 'Marcos';
        $habits = ['Programar', 'Estudar', 'Jogar'];

        //return view('dashboard', [
        //    'nome' => $nome,
        //    'habits' => $habits,
        //]);

        return view('dashboard', compact('nome', 'habits'));
    }

    public function dashboard()
    {
        return $this->index();
    }
}
