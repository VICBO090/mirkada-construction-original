@extends('layouts.admin')

@section('title', 'Rendez-vous de '.$rendezVous->nom)

@section('content')
    <h1>Rendez-vous — {{ $rendezVous->nom }}</h1>
    <div class="admin-form">
        <p><strong>Téléphone :</strong> {{ $rendezVous->telephone }}</p>
        @if($rendezVous->email)
            <p><strong>E-mail :</strong> {{ $rendezVous->email }}</p>
        @endif
        <p><strong>Date souhaitée :</strong> {{ \Carbon\Carbon::parse($rendezVous->date_souhaitee)->format('d/m/Y') }}</p>
        <p><strong>Heure :</strong> {{ \Carbon\Carbon::parse($rendezVous->heure_souhaitee)->format('H:i') }}</p>
        @if($rendezVous->sujet)
            <p><strong>Sujet :</strong> {{ $rendezVous->sujet }}</p>
        @endif

        <form method="POST" action="{{ route('admin.rendez-vous.update', $rendezVous) }}" style="margin-top:20px; display:flex; gap:12px; align-items:center;">
            @csrf
            @method('PUT')
            <select name="statut">
                <option value="en_attente" {{ $rendezVous->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="confirme" {{ $rendezVous->statut == 'confirme' ? 'selected' : '' }}>Confirmé</option>
                <option value="modifie" {{ $rendezVous->statut == 'modifie' ? 'selected' : '' }}>Modifié</option>
                <option value="annule" {{ $rendezVous->statut == 'annule' ? 'selected' : '' }}>Annulé</option>
            </select>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
        <p style="font-size:0.8rem; color:var(--steel); margin-top:6px;">Passer le statut à "Confirmé" envoie automatiquement un e-mail si une adresse est renseignée.</p>

        <div class="hero-actions" style="margin-top:20px;">
            <a href="tel:{{ $rendezVous->telephone }}" class="btn btn-primary">Appeler</a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $rendezVous->telephone) }}?text={{ urlencode('Bonjour '.$rendezVous->nom.', votre rendez-vous du '.\Carbon\Carbon::parse($rendezVous->date_souhaitee)->format('d/m/Y').' à '.\Carbon\Carbon::parse($rendezVous->heure_souhaitee)->format('H:i').' est confirmé.') }}" target="_blank" class="btn btn-primary">Confirmer sur WhatsApp</a>
        </div>
    </div>
    <p style="margin-top:20px;"><a href="{{ route('admin.rendez-vous.index') }}">← Retour aux rendez-vous</a></p>
@endsection