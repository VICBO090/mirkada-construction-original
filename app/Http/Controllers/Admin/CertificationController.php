<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::orderByDesc("date_obtention")->get();

        return view("admin.certifications.index", compact("certifications"));
    }

    public function create()
    {
        return view("admin.certifications.create");
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile("image")) {
            $data["image"] = $request->file("image")->store("certifications", "public");
        }

        Certification::create($data);

        return redirect()->route("admin.certifications.index")->with("success", "Certification ajoutée.");
    }

    public function edit(Certification $certification)
    {
        return view("admin.certifications.edit", compact("certification"));
    }

    public function update(Request $request, Certification $certification)
    {
        $data = $this->validateData($request);

        if ($request->hasFile("image")) {
            $data["image"] = $request->file("image")->store("certifications", "public");
        }

        $certification->update($data);

        return redirect()->route("admin.certifications.index")->with("success", "Certification mise à jour.");
    }

    public function destroy(Certification $certification)
    {
        $certification->delete();

        return back()->with("success", "Certification supprimée.");
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            "nom" => ["required", "string", "max:255"],
            "description" => ["nullable", "string"],
            "date_obtention" => ["nullable", "date"],
            "image" => ["nullable", "image", "max:2048"],
        ]);
    }
}
