<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    //
    public function index()
    {
        return view('rotashome');
    }

    public function dashboard()
    {
        $habits = auth()->user()->habits->pluck('name')->toArray();
        return view('dashboard', compact('habits'));
    }
}
