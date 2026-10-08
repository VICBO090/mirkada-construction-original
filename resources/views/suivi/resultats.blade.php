@extends('layouts.app')

@section('title', 'Résultats du suivi')

@section('content')

    <section class="hero hero-small">
        <div class="container">
            <p class="eyebrow">Résultats pour {{ $telephone }}</p>
            <h1>Suivi de votre dossier</h1>
        </div>
        <div class="dim-line"><span>SUIVI</span></div>
    </section>

    <section class="section-alt">
        <div class="container">

            <p class="eyebrow eyebrow-dark">Demandes de devis</p>
            @forelse ($devis as $item)
                <article class="news-card" style="padding:20px; margin-bottom:16px;">
                    <p><strong>{{ $item->type_projet }}</strong> — demandé le {{ $item->created_at->format('d/m/Y') }}</p>
                    <p>Statut : <span class="eyebrow eyebrow-dark" style="margin:0;">{{ ucfirst(str_replace('_', ' ', $item->statut)) }}</span></p>
                </article>
            @empty
                <p class="empty-note">Aucune demande de devis trouvée pour ce numéro.</p>
            @endforelse

            <p class="eyebrow eyebrow-dark" style="margin-top:30px;">Rendez-vous</p>
            @forelse ($rendezVous as $rdv)
                <article class="news-card" style="padding:20px; margin-bottom:16px;">
                    <p><strong>{{ \Carbon\Carbon::parse($rdv->date_souhaitee)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($rdv->heure_souhaitee)->format('H:i') }}</strong></p>
                    <p>Statut : <span class="eyebrow eyebrow-dark" style="margin:0;">{{ ucfirst(str_replace('_', ' ', $rdv->statut)) }}</span></p>
                </article>
            @empty
                <p class="empty-note">Aucun rendez-vous trouvé pour ce numéro.</p>
            @endforelse

            <p style="margin-top:24px;"><a href="{{ route('suivi.index') }}">← Nouvelle recherche</a></p>
        </div>
    </section>

@endsection
