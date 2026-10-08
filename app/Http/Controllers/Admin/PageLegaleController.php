<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageLegale;
use Illuminate\Http\Request;

class PageLegaleController extends Controller
{
    private array $types = [
        "mentions_legales" => "Mentions légales",
        "cgu" => "Conditions générales d'utilisation",
        "confidentialite" => "Politique de confidentialité",
    ];

    public function index()
    {
        $pages = PageLegale::all()->keyBy("type");
        $types = $this->types;

        return view("admin.page-legales.index", compact("pages", "types"));
    }

    public function edit(string $type)
    {
        abort_unless(array_key_exists($type, $this->types), 404);

        $page = PageLegale::firstOrNew(["type" => $type], ["titre" => $this->types[$type]]);
        $label = $this->types[$type];

        return view("admin.page-legales.edit", compact("page", "type", "label"));
    }

    public function update(Request $request, string $type)
    {
        abort_unless(array_key_exists($type, $this->types), 404);

        $data = $request->validate([
            "titre" => ["required", "string", "max:255"],
            "contenu" => ["required", "string"],
        ]);

        PageLegale::updateOrCreate(["type" => $type], $data);

        return redirect()->route("admin.page-legales.index")->with("success", "Page mise à jour.");
    }
}
