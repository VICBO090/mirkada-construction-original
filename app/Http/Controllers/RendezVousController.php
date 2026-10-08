<?php

namespace App\Http\Controllers;

use App\Mail\RendezVousMail;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RendezVousController extends Controller
{
    public function create()
    {
        return view('rendez-vous.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'date_souhaitee' => ['required', 'date', 'after_or_equal:today'],
            'heure_souhaitee' => ['required'],
            'sujet' => ['nullable', 'string', 'max:255'],
        ]);

        $data['statut'] = 'en_attente';

        $rendezVous = RendezVous::create($data);

        if ($rendezVous->email) {
            try {
                Mail::to($rendezVous->email)->send(new RendezVousMail($rendezVous));
            } catch (\Throwable $e) {
                // L'envoi a échoué (souvent : pas de configuration SMTP) — la demande reste enregistrée.
            }
        }

        return redirect()->route('rendez-vous.create')->with('success', 'Votre demande de rendez-vous a bien été envoyée. Nous vous contacterons pour la confirmer.');
    }
}