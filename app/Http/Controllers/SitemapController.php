<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Projet;
use App\Models\Service;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = collect([
            ['loc' => route('home'), 'priority' => '1.0'],
            ['loc' => route('about'), 'priority' => '0.8'],
            ['loc' => route('equipe'), 'priority' => '0.6'],
            ['loc' => route('projets.index'), 'priority' => '0.8'],
            ['loc' => route('actualites.index'), 'priority' => '0.7'],
            ['loc' => route('devis.create'), 'priority' => '0.9'],
            ['loc' => route('rendez-vous.create'), 'priority' => '0.7'],
            ['loc' => route('faq'), 'priority' => '0.5'],
        ]);

        foreach (Projet::all() as $projet) {
            $urls->push(['loc' => route('projets.show', $projet), 'priority' => '0.6']);
        }

        foreach (Actualite::all() as $actualite) {
            $urls->push(['loc' => route('actualites.show', $actualite), 'priority' => '0.5']);
        }

        $xml = view('sitemap', compact('urls'))->render();

        return Response::make($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
