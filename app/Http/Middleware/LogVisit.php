<?php

namespace App\Http\Middleware;

use App\Models\Visite;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogVisit
{
    /**
     * Journalise les visites de pages publiques, sans identifier les visiteurs
     * (aucune adresse IP ni cookie de suivi n'est enregistré — juste un compteur
     * par page et par jour).
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('get') && !$request->is('admin*') && !$request->ajax()) {
            try {
                $visite = Visite::firstOrNew([
                    'chemin' => $request->path(),
                    'jour' => now()->toDateString(),
                ]);
                $visite->total = ($visite->total ?? 0) + 1;
                $visite->save();
            } catch (\Throwable $e) {
                // La journalisation ne doit jamais casser une page publique.
            }
        }

        return $next($request);
    }
}
