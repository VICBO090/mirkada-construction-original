@extends('layouts.admin')

@section('title', 'Informations entreprise')

@section('content')
    <h1>Informations de l'entreprise</h1>
    <form method="POST" action="{{ route('admin.entreprise.update') }}" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')

        <label>Nom de l'entreprise
            <input type="text" name="nom" value="{{ old('nom', $entreprise->nom) }}" required>
        </label>

        <label>Titre d'accroche (page d'accueil)
            <input type="text" name="accroche_titre" value="{{ old('accroche_titre', $entreprise->accroche_titre) }}">
        </label>

        <label>Texte d'accroche (page d'accueil)
            <textarea name="accroche_texte" rows="3">{{ old('accroche_texte', $entreprise->accroche_texte) }}</textarea>
        </label>

        <label>Nombre de projets réalisés (affiché en chiffre clé sur l'accueil)
            <input type="number" name="nb_projets_realises" min="0" value="{{ old('nb_projets_realises', $entreprise->nb_projets_realises) }}">
        </label>

        <label>Années d'expérience (affiché en chiffre clé sur l'accueil)
            <input type="number" name="annees_experience" min="0" value="{{ old('annees_experience', $entreprise->annees_experience) }}">
        </label>

        <label>Téléphone
            <input type="text" name="telephone" value="{{ old('telephone', $entreprise->telephone) }}">
        </label>

        <label>E-mail
            <input type="email" name="email" value="{{ old('email', $entreprise->email) }}">
        </label>

        <label>Adresse
            <input type="text" name="adresse" value="{{ old('adresse', $entreprise->adresse) }}">
        </label>

        <label>Logo
            <input type="file" name="logo" accept="image/*">
        </label>
        @if($entreprise->logo)
            <img src="{{ asset('storage/'.$entreprise->logo) }}" alt="Logo actuel" class="current-logo">
        @endif

        <label>Histoire
            <textarea name="histoire" rows="4">{{ old('histoire', $entreprise->histoire) }}</textarea>
        </label>

        <label>Vision
            <textarea name="vision" rows="3">{{ old('vision', $entreprise->vision) }}</textarea>
        </label>

        <label>Mission
            <textarea name="mission" rows="3">{{ old('mission', $entreprise->mission) }}</textarea>
        </label>

        <label>Valeurs
            <textarea name="valeurs" rows="3">{{ old('valeurs', $entreprise->valeurs) }}</textarea>
        </label>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
