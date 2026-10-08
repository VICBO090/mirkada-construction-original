<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\Service;
use App\Models\Tarif;
use Illuminate\Http\Request;

class DevisController extends Controller
{
    public function create()
    {
        $services = Service::orderBy('titre')->get();
        $tarifs = Tarif::select('id', 'service_id', 'categorie', 'prix', 'unite')->get();

        return view('devis.create', compact('services', 'tarifs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'type_projet' => ['required', 'string', 'max:255'],
            'budget_estimatif' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $data['statut'] = 'nouveau';

        Devis::create($data);

        return redirect()->route('devis.create')->with('success', "Votre demande a bien été envoyée. Notre bureau d'étude vous contactera pour un devis précis.");
    }
}