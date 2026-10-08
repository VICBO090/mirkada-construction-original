<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Devis;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DevisController extends Controller
{
    public function index()
    {
        $devis = Devis::orderByDesc('created_at')->get();

        return view('admin.devis.index', compact('devis'));
    }

    public function show(Devis $devis)
    {
        return view('admin.devis.show', compact('devis'));
    }

    public function update(Request $request, Devis $devis)
    {
        $request->validate([
            'statut' => ['required', 'in:nouveau,en_cours,traite'],
        ]);

        $devis->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut mis à jour.');
    }

    public function destroy(Devis $devis)
    {
        $devis->delete();

        return redirect()->route('admin.devis.index')->with('success', 'Devis supprimé.');
    }

    public function pdf(Devis $devis)
    {
        $pdf = Pdf::loadView('admin.devis.pdf', compact('devis'));

        return $pdf->download('devis-'.$devis->id.'.pdf');
    }
}
