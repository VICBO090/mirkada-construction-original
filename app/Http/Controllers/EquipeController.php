<?php

namespace App\Http\Controllers;

use App\Models\Equipe;

class EquipeController extends Controller
{
    public function index()
    {
        $membres = Equipe::orderBy('ordre')->get();

        return view('equipe', compact('membres'));
    }
}