@extends('layouts.app')

@section('title', 'Prendre rendez-vous')

@section('content')

    <section class="hero hero-small">
        <div class="container">
            <p class="eyebrow">Planifions ensemble</p>
            <h1>Prendre rendez-vous</h1>
            <p class="hero-sub">Choisissez une date, nous confirmons rapidement par e-mail et par WhatsApp.</p>
        </div>
        <div class="dim-line"><span>RENDEZ-VOUS</span></div>
    </section>

    <section class="section-alt">
        <div class="container" style="max-width:560px;">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('rendez-vous.store') }}" class="contact-form">
                @csrf
                <label>Nom complet
                    <input type="text" name="nom" value="{{ old('nom') }}" required>
                </label>
                <label>Téléphone
                    <input type="text" name="telephone" value="{{ old('telephone') }}" required>
                </label>
                <label>E-mail (pour recevoir la confirmation)
                    <input type="email" name="email" value="{{ old('email') }}">
                </label>
                <label>Date souhaitée
                    <input type="date" name="date_souhaitee" value="{{ old('date_souhaitee') }}" required>
                </label>
                <label>Heure souhaitée
                    <input type="time" name="heure_souhaitee" value="{{ old('heure_souhaitee') }}" required>
                </label>
                <label>Sujet du rendez-vous
                    <input type="text" name="sujet" value="{{ old('sujet') }}">
                </label>
                <button type="submit" class="btn btn-primary">Envoyer ma demande</button>
            </form>
        </div>
    </section>

@endsection