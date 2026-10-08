@extends('layouts.admin')

@section('title', 'Demande de devis')

@section('content')
    <h1>Demande de {{ $devis->nom }}</h1>
    <div class="admin-form">
        <p><strong>Téléphone :</strong> {{ $devis->telephone }}</p>
        @if($devis->email)
            <p><strong>E-mail :</strong> {{ $devis->email }}</p>
        @endif
        <p><strong>Type de projet :</strong> {{ $devis->type_projet }}</p>
        @if($devis->budget_estimatif)
            <p><strong>Estimation :</strong> {{ $devis->budget_estimatif }}</p>
        @endif
        <p><strong>Reçu le :</strong> {{ $devis->created_at->format('d/m/Y H:i') }}</p>
        <hr>
        <p>{{ $devis->description }}</p>

        <form method="POST" action="{{ route('admin.devis.update', $devis) }}" style="margin-top:20px; display:flex; gap:12px; align-items:center;">
            @csrf
            @method('PUT')
            <select name="statut">
                <option value="nouveau" {{ $devis->statut == 'nouveau' ? 'selected' : '' }}>Nouveau</option>
                <option value="en_cours" {{ $devis->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="traite" {{ $devis->statut == 'traite' ? 'selected' : '' }}>Traité</option>
            </select>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>

        <div class="hero-actions" style="margin-top:20px; display:flex; gap:10px; flex-wrap:wrap;">
            <a href="tel:{{ $devis->telephone }}" class="btn btn-primary">Appeler</a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $devis->telephone) }}" target="_blank" class="btn btn-primary">WhatsApp</a>
            @if($devis->email)
                <a href="mailto:{{ $devis->email }}" class="btn btn-primary">E-mail</a>
            @endif
            <a href="{{ route('admin.devis.pdf', $devis) }}" class="btn btn-primary">Télécharger en PDF</a>
        </div>
    </div>
    <p style="margin-top:20px;"><a href="{{ route('admin.devis.index') }}">← Retour aux devis</a></p>
@endsection
