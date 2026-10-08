<?php

namespace App\Http\Controllers;

use App\Models\Temoignage;
use Illuminate\Http\Request;

class TemoignageController extends Controller
{
    public function store(Request $request)
    {
        if ($request->filled("site_web")) {
            return back()->with("success", "Merci pour votre avis ! Il sera publié après vérification.");
        }

        $data = $request->validate([
            "nom_client" => ["required", "string", "max:255"],
            "poste_client" => ["nullable", "string", "max:255"],
            "contenu" => ["required", "string"],
            "note" => ["required", "integer", "min:1", "max:5"],
        ]);

        $data["approuve"] = false;

        Temoignage::create($data);

        return back()->with("success", "Merci pour votre avis ! Il sera publié après vérification.");
    }
}
