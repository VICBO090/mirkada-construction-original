<?php

namespace App\Http\Controllers;

use App\Models\Projet;

class ProjetController extends Controller
{
    public function index()
    {
        $projets = Projet::with('service')->orderByDesc('created_at')->get();

        return view('projets.index', compact('projets'));
    }

    public function show(Projet $projet)
    {
        return view('projets.show', compact('projet'));
    }
}