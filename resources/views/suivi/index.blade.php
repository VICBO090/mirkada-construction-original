@extends('layouts.app')

@section('title', 'Suivi de votre dossier')

@section('content')

    <section class="hero hero-small">
        <div class="container">
            <p class="eyebrow">Transparence</p>
            <h1>Suivre ma demande</h1>
            <p class="hero-sub">Entrez le numéro de téléphone utilisé lors de votre demande pour voir son statut.</p>
        </div>
        <div class="dim-line"><span>SUIVI</span></div>
    </section>

    <section class="section-alt">
        <div class="container" style="max-width:480px;">
            <form method="GET" action="{{ route('suivi.search') }}" class="contact-form">
                <label>Numéro de téléphone
                    <input type="text" name="telephone" required placeholder="ex: +243 976 501 066">
                </label>
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
        </div>
    </section>

@endsection
