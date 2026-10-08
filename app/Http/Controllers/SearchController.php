<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Projet;
use App\Models\Service;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $services = $projets = $actualites = collect();

        if (strlen($q) >= 2) {
            $services = Service::where('titre', 'like', "%{$q}%")
                ->orWhere('description_courte', 'like', "%{$q}%")
                ->get();

            $projets = Projet::where('titre', 'like', "%{$q}%")
                ->orWhere('description', 'like', "%{$q}%")
                ->get();

            $actualites = Actualite::where('titre', 'like', "%{$q}%")
                ->orWhere('contenu', 'like', "%{$q}%")
                ->get();
        }

        return view('recherche.index', compact('q', 'services', 'projets', 'actualites'));
    }
}
