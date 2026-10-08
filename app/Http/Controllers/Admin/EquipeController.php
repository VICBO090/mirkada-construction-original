<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipe;
use App\Support\ImageOptimizer;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    public function index()
    {
        $membres = Equipe::orderBy('ordre')->get();

        return view('admin.equipe.index', compact('membres'));
    }

    public function create()
    {
        return view('admin.equipe.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('equipe', 'public');
            ImageOptimizer::optimize($data['photo'], 800);
        }

        Equipe::create($data);

        return redirect()->route('admin.equipe.index')->with('success', 'Membre ajouté.');
    }

    public function edit(Equipe $equipe)
    {
        return view('admin.equipe.edit', compact('equipe'));
    }

    public function update(Request $request, Equipe $equipe)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('equipe', 'public');
            ImageOptimizer::optimize($data['photo'], 800);
        }

        $equipe->update($data);

        return redirect()->route('admin.equipe.index')->with('success', 'Membre mis à jour.');
    }

    public function destroy(Equipe $equipe)
    {
        $equipe->delete();

        return back()->with('success', 'Membre supprimé.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'poste' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'ordre' => ['nullable', 'integer'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);
    }
}
