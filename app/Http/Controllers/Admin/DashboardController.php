<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Devis;
use App\Models\Message;
use App\Models\Actualite;
use App\Models\Visite;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services' => Service::count(),
            'devis_nouveaux' => Devis::where('statut', 'nouveau')->count(),
            'messages_non_lus' => Message::where('lu', false)->count(),
            'actualites' => Actualite::count(),
        ];

        $devisParStatut = [
            'nouveau' => Devis::where('statut', 'nouveau')->count(),
            'en_cours' => Devis::where('statut', 'en_cours')->count(),
            'traite' => Devis::where('statut', 'traite')->count(),
        ];

        $mois = collect(range(5, 0))->map(function ($i) {
            $date = Carbon::now()->subMonths($i);
            return [
                'label' => $date->format('m/Y'),
                'debut' => $date->copy()->startOfMonth(),
                'fin' => $date->copy()->endOfMonth(),
            ];
        });

        $labelsMois = $mois->pluck('label');

        $devisParMois = $mois->map(function ($m) {
            return Devis::whereBetween('created_at', [$m['debut'], $m['fin']])->count();
        });

        $jours = collect(range(13, 0))->map(fn ($i) => Carbon::now()->subDays($i));
        $labelsVisites = $jours->map(fn ($d) => $d->format('d/m'));
        $visitesParJour = $jours->map(function ($jour) {
            return Visite::whereDate('jour', $jour->toDateString())->sum('total');
        });

        return view('admin.dashboard', compact(
            'stats', 'devisParStatut', 'labelsMois', 'devisParMois', 'labelsVisites', 'visitesParJour'
        ));
    }
}
