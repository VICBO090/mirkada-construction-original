<?php

namespace App\Http\Controllers;

use App\Models\PageLegale;

class PageLegaleController extends Controller
{
    public function show(string $type)
    {
        abort_unless(in_array($type, ["mentions_legales", "cgu", "confidentialite"]), 404);

        $page = PageLegale::where("type", $type)->first();

        abort_unless($page, 404);

        return view("legal.show", compact("page"));
    }
}
