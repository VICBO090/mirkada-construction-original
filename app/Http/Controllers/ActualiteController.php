<?php

namespace App\Http\Controllers;

use App\Models\Actualite;

class ActualiteController extends Controller
{
    public function index()
    {
        $actualites = Actualite::orderByDesc('publie_le')->orderByDesc('created_at')->get();

        return view('actualites.index', compact('actualites'));
    }

    public function show(Actualite $actualite)
    {
        return view('actualites.show', compact('actualite'));
    }
}