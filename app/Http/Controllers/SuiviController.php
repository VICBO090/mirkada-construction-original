<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class SuiviController extends Controller
{
    public function index()
    {
        return view('suivi.index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'telephone' => ['required', 'string', 'max:50'],
        ]);

        $telephone = $request->telephone;

        $devis = Devis::where('telephone', $telephone)->orderByDesc('created_at')->get();
        $rendezVous = RendezVous::where('telephone', $telephone)->orderByDesc('created_at')->get();

        return view('suivi.resultats', compact('devis', 'rendezVous', 'telephone'));
    }
}
