@extends('layouts.admin')

@section('title', 'Modifier la réalisation')

@section('content')
    <h1>Modifier « {{ $projet->titre }} »</h1>
    <form method="POST" action="{{ route('admin.projets.update', $projet) }}" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')
        <label>Titre
            <input type="text" name="titre" value="{{ old('titre', $projet->titre) }}" required>
        </label>
        <label>Service concerné
            <select name="service_id">
                <option value="">— Aucun —</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id', $projet->service_id) == $service->id ? 'selected' : '' }}>{{ $service->titre }}</option>
                @endforeach
            </select>
        </label>
        <label>Description
            <textarea name="description" rows="5" required>{{ old('description', $projet->description) }}</textarea>
        </label>
        <label>Lieu
            <input type="text" name="lieu" value="{{ old('lieu', $projet->lieu) }}">
        </label>
        <label>Client (si autorisé)
            <input type="text" name="client" value="{{ old('client', $projet->client) }}">
        </label>
        <label>Type de projet
            <input type="text" name="type_projet" value="{{ old('type_projet', $projet->type_projet) }}">
        </label>
        <label>Date de début
            <input type="date" name="date_debut" value="{{ old('date_debut', $projet->date_debut?->toDateString()) }}">
        </label>
        <label>Date de fin
            <input type="date" name="date_fin" value="{{ old('date_fin', $projet->date_fin?->toDateString()) }}">
        </label>
        <label>État d'avancement
            <select name="etat_avancement" required>
                @foreach (['planifie' => 'Planifié', 'en_cours' => 'En cours', 'termine' => 'Terminé'] as $value => $label)
                    <option value="{{ $value }}" {{ old('etat_avancement', $projet->etat_avancement) == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </label>
        <label>Photo principale (remplace l'actuelle si choisie)
            <input type="file" name="image_principale" accept="image/*">
        </label>
        @if($projet->image_principale)
            <img src="{{ asset('storage/'.$projet->image_principale) }}" alt="" class="current-logo">
        @endif
        <label>Ajouter des photos à la galerie
            <input type="file" name="photos[]" accept="image/*" multiple>
        </label>
        @if($projet->photos && count($projet->photos))
            <p style="font-size:0.8rem;color:var(--steel);">{{ count($projet->photos) }} photo(s) déjà dans la galerie.</p>
        @endif
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection