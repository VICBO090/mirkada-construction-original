<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Support\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActualiteController extends Controller
{
    public function index()
    {
        $actualites = Actualite::orderByDesc('created_at')->get();

        return view('admin.actualites.index', compact('actualites'));
    }

    public function create()
    {
        return view('admin.actualites.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->uniqueSlug($request->titre);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('actualites', 'public');
            ImageOptimizer::optimize($data['image']);
        }

        Actualite::create($data);

        return redirect()->route('admin.actualites.index')->with('success', 'Actualité publiée.');
    }

    public function edit(Actualite $actualite)
    {
        return view('admin.actualites.edit', compact('actualite'));
    }

    public function update(Request $request, Actualite $actualite)
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->uniqueSlug($request->titre, $actualite->id);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('actualites', 'public');
            ImageOptimizer::optimize($data['image']);
        }

        $actualite->update($data);

        return redirect()->route('admin.actualites.index')->with('success', 'Actualité mise à jour.');
    }

    public function destroy(Actualite $actualite)
    {
        $actualite->delete();

        return back()->with('success', 'Actualité supprimée.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'extrait' => ['nullable', 'string'],
            'contenu' => ['required', 'string'],
            'type' => ['required', 'in:chantier,annonce,evenement,recrutement,promotion,communique'],
            'publie_le' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);
    }

    private function uniqueSlug(string $titre, ?int $ignoreId = null): string
    {
        $base = Str::slug($titre);
        $slug = $base;
        $i = 2;

        while (
            Actualite::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}
