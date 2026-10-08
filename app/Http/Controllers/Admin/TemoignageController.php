<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Temoignage;
use Illuminate\Http\Request;

class TemoignageController extends Controller
{
    public function index()
    {
        $temoignages = Temoignage::orderByDesc("created_at")->get();

        return view("admin.temoignages.index", compact("temoignages"));
    }

    public function edit(Temoignage $temoignage)
    {
        return view("admin.temoignages.edit", compact("temoignage"));
    }

    public function update(Request $request, Temoignage $temoignage)
    {
        $data = $request->validate([
            "nom_client" => ["required", "string", "max:255"],
            "poste_client" => ["nullable", "string", "max:255"],
            "contenu" => ["required", "string"],
            "note" => ["nullable", "integer", "min:1", "max:5"],
            "approuve" => ["nullable", "boolean"],
        ]);

        $data["approuve"] = $request->boolean("approuve");

        $temoignage->update($data);

        return redirect()->route("admin.temoignages.index")->with("success", "Témoignage mis à jour.");
    }

    public function destroy(Temoignage $temoignage)
    {
        $temoignage->delete();

        return back()->with("success", "Témoignage supprimé.");
    }
}
