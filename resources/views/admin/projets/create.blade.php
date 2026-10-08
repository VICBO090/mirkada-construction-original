@extends('layouts.admin')

@section('title', 'Ajouter une réalisation')

@section('content')
    <h1>Ajouter une réalisation</h1>
    <form method="POST" action="{{ route('admin.projets.store') }}" enctype="multipart/form-data" class="admin-form">
        @csrf
        <label>Titre
            <input type="text" name="titre" value="{{ old('titre') }}" required>
        </label>
        <label>Service concerné
            <select name="service_id">
                <option value="">— Aucun —</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{ $service->titre }}</option>
                @endforeach
            </select>
        </label>
        <label>Description
            <textarea name="description" rows="5" required>{{ old('description') }}</textarea>
        </label>
        <label>Lieu
            <input type="text" name="lieu" value="{{ old('lieu') }}">
        </label>
        <label>Client (si autorisé)
            <input type="text" name="client" value="{{ old('client') }}">
        </label>
        <label>Type de projet
            <input type="text" name="type_projet" value="{{ old('type_projet') }}">
        </label>
        <label>Date de début
            <input type="date" name="date_debut" value="{{ old('date_debut') }}">
        </label>
        <label>Date de fin
            <input type="date" name="date_fin" value="{{ old('date_fin') }}">
        </label>
        <label>État d'avancement
            <select name="etat_avancement" required>
                <option value="planifie">Planifié</option>
                <option value="en_cours">En cours</option>
                <option value="termine">Terminé</option>
            </select>
        </label>
        <label>Photo principale
            <input type="file" name="image_principale" accept="image/*">
        </label>
        <label>Photos supplémentaires (galerie)
            <input type="file" name="photos[]" accept="image/*" multiple>
        </label>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection