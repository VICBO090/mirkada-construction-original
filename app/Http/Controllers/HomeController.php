<?php

namespace App\Http\Controllers;

use App\Models\Banniere;
use App\Models\Service;
use App\Models\Temoignage;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::orderBy("ordre")->get();
        $bannieres = Banniere::where("actif", true)->orderBy("ordre")->get();
        $temoignages = Temoignage::where("approuve", true)->orderByDesc("created_at")->take(6)->get();

        return view("home", compact("services", "bannieres", "temoignages"));
    }
}
