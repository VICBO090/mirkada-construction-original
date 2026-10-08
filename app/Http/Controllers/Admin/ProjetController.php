<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use App\Models\Service;
use App\Support\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjetController extends Controller
{
    public function index()
    {
        $projets = Projet::orderByDesc('created_at')->get();

        return view('admin.projets.index', compact('projets'));
    }

    public function create()
    {
        $services = Service::orderBy('titre')->get();

        return view('admin.projets.create', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->uniqueSlug($request->titre);

        if ($request->hasFile('image_principale')) {
            $data['image_principale'] = $request->file('image_principale')->store('projets', 'public');
            ImageOptimizer::optimize($data['image_principale']);
        }

        if ($request->hasFile('photos')) {
            $data['photos'] = collect($request->file('photos'))
                ->map(function ($file) {
                    $path = $file->store('projets', 'public');
                    ImageOptimizer::optimize($path);
                    return $path;
                })
                ->values()
                ->all();
        }

        Projet::create($data);

        return redirect()->route('admin.projets.index')->with('success', 'Réalisation ajoutée.');
    }

    public function edit(Projet $projet)
    {
        $services = Service::orderBy('titre')->get();

        return view('admin.projets.edit', compact('projet', 'services'));
    }

    public function update(Request $request, Projet $projet)
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->uniqueSlug($request->titre, $projet->id);

        if ($request->hasFile('image_principale')) {
            $data['image_principale'] = $request->file('image_principale')->store('projets', 'public');
            ImageOptimizer::optimize($data['image_principale']);
        }

        if ($request->hasFile('photos')) {
            $nouvelles = collect($request->file('photos'))
                ->map(function ($file) {
                    $path = $file->store('projets', 'public');
                    ImageOptimizer::optimize($path);
                    return $path;
                })
                ->values()
                ->all();

            $data['photos'] = array_merge($projet->photos ?? [], $nouvelles);
        }

        $projet->update($data);

        return redirect()->route('admin.projets.index')->with('success', 'Réalisation mise à jour.');
    }

    public function destroy(Projet $projet)
    {
        $projet->delete();

        return back()->with('success', 'Réalisation supprimée.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'lieu' => ['nullable', 'string', 'max:255'],
            'client' => ['nullable', 'string', 'max:255'],
            'type_projet' => ['nullable', 'string', 'max:255'],
            'date_debut' => ['nullable', 'date'],
            'date_fin' => ['nullable', 'date'],
            'etat_avancement' => ['required', 'in:planifie,en_cours,termine'],
            'service_id' => ['nullable', 'exists:services,id'],
            'image_principale' => ['nullable', 'image', 'max:2048'],
            'photos.*' => ['nullable', 'image', 'max:2048'],
        ]);
    }

    private function uniqueSlug(string $titre, ?int $ignoreId = null): string
    {
        $base = Str::slug($titre);
        $slug = $base;
        $i = 2;

        while (
            Projet::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}
