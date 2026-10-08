@extends('layouts.admin')

@section('title', 'Publier une actualité')

@section('content')
    <h1>Publier une actualité</h1>
    <form method="POST" action="{{ route('admin.actualites.store') }}" enctype="multipart/form-data" class="admin-form">
        @csrf
        <label>Titre
            <input type="text" name="titre" value="{{ old('titre') }}" required>
        </label>
        <label>Type
            <select name="type" required>
                <option value="chantier">Nouveau chantier</option>
                <option value="annonce">Annonce</option>
                <option value="evenement">Événement</option>
                <option value="recrutement">Recrutement</option>
                <option value="promotion">Promotion</option>
                <option value="communique">Communiqué</option>
            </select>
        </label>
        <label>Extrait (résumé court)
            <textarea name="extrait" rows="2">{{ old('extrait') }}</textarea>
        </label>
        <label>Contenu complet
            <textarea name="contenu" rows="6" required>{{ old('contenu') }}</textarea>
        </label>
        <label>Image
            <input type="file" name="image" accept="image/*">
        </label>
        <label>Date de publication
            <input type="date" name="publie_le" value="{{ old('publie_le', now()->toDateString()) }}">
        </label>
        <button type="submit" class="btn btn-primary">Publier</button>
    </form>
@endsection