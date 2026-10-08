<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::with('service')->orderBy('service_id')->get();

        return view('admin.tarifs.index', compact('tarifs'));
    }

    public function create()
    {
        $services = Service::orderBy('titre')->get();

        return view('admin.tarifs.create', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        Tarif::create($data);

        return redirect()->route('admin.tarifs.index')->with('success', 'Tarif ajouté.');
    }

    public function edit(Tarif $tarif)
    {
        $services = Service::orderBy('titre')->get();

        return view('admin.tarifs.edit', compact('tarif', 'services'));
    }

    public function update(Request $request, Tarif $tarif)
    {
        $data = $this->validateData($request);

        $tarif->update($data);

        return redirect()->route('admin.tarifs.index')->with('success', 'Tarif mis à jour.');
    }

    public function destroy(Tarif $tarif)
    {
        $tarif->delete();

        return back()->with('success', 'Tarif supprimé.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'libelle' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'categorie' => ['required', 'string', 'max:100'],
            'prix' => ['required', 'numeric', 'min:0'],
            'unite' => ['nullable', 'string', 'max:50'],
        ]);
    }
}