<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banniere;
use Illuminate\Http\Request;

class BanniereController extends Controller
{
    public function index()
    {
        $bannieres = Banniere::orderBy("ordre")->get();

        return view("admin.bannieres.index", compact("bannieres"));
    }

    public function create()
    {
        return view("admin.bannieres.create");
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request, true);

        if ($request->hasFile("image")) {
            $data["image"] = $request->file("image")->store("bannieres", "public");
        }

        $data["actif"] = $request->boolean("actif");

        Banniere::create($data);

        return redirect()->route("admin.bannieres.index")->with("success", "Bannière ajoutée.");
    }

    public function edit(Banniere $banniere)
    {
        return view("admin.bannieres.edit", compact("banniere"));
    }

    public function update(Request $request, Banniere $banniere)
    {
        $data = $this->validateData($request, false);

        if ($request->hasFile("image")) {
            $data["image"] = $request->file("image")->store("bannieres", "public");
        }

        $data["actif"] = $request->boolean("actif");

        $banniere->update($data);

        return redirect()->route("admin.bannieres.index")->with("success", "Bannière mise à jour.");
    }

    public function destroy(Banniere $banniere)
    {
        $banniere->delete();

        return back()->with("success", "Bannière supprimée.");
    }

    private function validateData(Request $request, bool $imageRequired): array
    {
        return $request->validate([
            "titre" => ["required", "string", "max:255"],
            "sous_titre" => ["nullable", "string", "max:255"],
            "lien" => ["nullable", "string", "max:255"],
            "ordre" => ["nullable", "integer"],
            "image" => [$imageRequired ? "required" : "nullable", "image", "max:2048"],
        ]);
    }
}
