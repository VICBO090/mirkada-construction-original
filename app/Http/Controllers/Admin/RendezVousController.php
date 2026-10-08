<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RendezVousMail;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RendezVousController extends Controller
{
    public function index()
    {
        $rendezVous = RendezVous::orderBy('date_souhaitee')->get();

        return view('admin.rendez-vous.index', compact('rendezVous'));
    }

    public function show(RendezVous $rendezvous)
    {
        return view('admin.rendez-vous.show', ['rendezVous' => $rendezvous]);
    }

    public function update(Request $request, RendezVous $rendezvous)
    {
        $request->validate([
            'statut' => ['required', 'in:en_attente,confirme,modifie,annule'],
        ]);

        $rendezvous->update(['statut' => $request->statut]);

        if ($request->statut === 'confirme' && $rendezvous->email) {
            try {
                Mail::to($rendezvous->email)->send(new RendezVousMail($rendezvous));
            } catch (\Throwable $e) {
                //
            }
        }

        return back()->with('success', 'Statut mis à jour.');
    }

    public function destroy(RendezVous $rendezvous)
    {
        $rendezvous->delete();

        return redirect()->route('admin.rendez-vous.index')->with('success', 'Rendez-vous supprimé.');
    }
}