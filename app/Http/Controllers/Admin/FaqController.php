<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy("ordre")->get();

        return view("admin.faqs.index", compact("faqs"));
    }

    public function create()
    {
        return view("admin.faqs.create");
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        Faq::create($data);

        return redirect()->route("admin.faqs.index")->with("success", "Question ajoutée.");
    }

    public function edit(Faq $faq)
    {
        return view("admin.faqs.edit", compact("faq"));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $this->validateData($request);

        $faq->update($data);

        return redirect()->route("admin.faqs.index")->with("success", "Question mise à jour.");
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return back()->with("success", "Question supprimée.");
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            "question" => ["required", "string", "max:255"],
            "reponse" => ["required", "string"],
            "ordre" => ["nullable", "integer"],
        ]);
    }
}
