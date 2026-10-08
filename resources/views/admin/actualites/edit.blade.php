@extends('layouts.admin')

@section('title', "Modifier l'actualité")

@section('content')
    <h1>Modifier « {{ $actualite->titre }} »</h1>
    <form method="POST" action="{{ route('admin.actualites.update', $actualite) }}" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')
        <label>Titre
            <input type="text" name="titre" value="{{ old('titre', $actualite->titre) }}" required>
        </label>
        <label>Type
            <select name="type" required>
                @foreach (['chantier' => 'Nouveau chantier', 'annonce' => 'Annonce', 'evenement' => 'Événement', 'recrutement' => 'Recrutement', 'promotion' => 'Promotion', 'communique' => 'Communiqué'] as $value => $label)
                    <option value="{{ $value }}" {{ old('type', $actualite->type) == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </label>
        <label>Extrait (résumé court)
            <textarea name="extrait" rows="2">{{ old('extrait', $actualite->extrait) }}</textarea>
        </label>
        <label>Contenu complet
            <textarea name="contenu" rows="6" required>{{ old('contenu', $actualite->contenu) }}</textarea>
        </label>
        <label>Image
            <input type="file" name="image" accept="image/*">
        </label>
        @if($actualite->image)
            <img src="{{ asset('storage/'.$actualite->image) }}" alt="" class="current-logo">
        @endif
        <label>Date de publication
            <input type="date" name="publie_le" value="{{ old('publie_le', $actualite->publie_le?->toDateString()) }}">
        </label>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection