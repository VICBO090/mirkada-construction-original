<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partenaire;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    public function index()
    {
        $partenaires = Partenaire::orderBy("ordre")->get();

        return view("admin.partenaires.index", compact("partenaires"));
    }

    public function create()
    {
        return view("admin.partenaires.create");
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile("logo")) {
            $data["logo"] = $request->file("logo")->store("partenaires", "public");
        }

        Partenaire::create($data);

        return redirect()->route("admin.partenaires.index")->with("success", "Partenaire ajouté.");
    }

    public function edit(Partenaire $partenaire)
    {
        return view("admin.partenaires.edit", compact("partenaire"));
    }

    public function update(Request $request, Partenaire $partenaire)
    {
        $data = $this->validateData($request);

        if ($request->hasFile("logo")) {
            $data["logo"] = $request->file("logo")->store("partenaires", "public");
        }

        $partenaire->update($data);

        return redirect()->route("admin.partenaires.index")->with("success", "Partenaire mis à jour.");
    }

    public function destroy(Partenaire $partenaire)
    {
        $partenaire->delete();

        return back()->with("success", "Partenaire supprimé.");
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            "nom" => ["required", "string", "max:255"],
            "description" => ["nullable", "string"],
            "lien_site" => ["nullable", "url", "max:255"],
            "ordre" => ["nullable", "integer"],
            "logo" => ["nullable", "image", "max:2048"],
        ]);
    }
}
