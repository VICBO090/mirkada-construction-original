<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use App\Support\ImageOptimizer;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function edit()
    {
        $entreprise = Entreprise::first();

        return view('admin.entreprise.edit', compact('entreprise'));
    }

    public function update(Request $request)
    {
        $entreprise = Entreprise::first();

        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'accroche_titre' => ['nullable', 'string', 'max:255'],
            'accroche_texte' => ['nullable', 'string'],
            'telephone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'adresse' => ['nullable', 'string', 'max:255'],
            'histoire' => ['nullable', 'string'],
            'vision' => ['nullable', 'string'],
            'mission' => ['nullable', 'string'],
            'valeurs' => ['nullable', 'string'],
            'nb_projets_realises' => ['nullable', 'integer', 'min:0'],
            'annees_experience' => ['nullable', 'integer', 'min:0'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
            ImageOptimizer::optimize($data['logo']);
        }

        $entreprise->update($data);

        return back()->with('success', 'Informations mises à jour.');
    }
}
