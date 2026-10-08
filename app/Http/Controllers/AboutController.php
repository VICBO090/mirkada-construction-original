<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\Partenaire;

class AboutController extends Controller
{
    public function index()
    {
        $partenaires = Partenaire::orderBy("ordre")->get();
        $certifications = Certification::orderByDesc("date_obtention")->get();

        return view("about", compact("partenaires", "certifications"));
    }
}
