@extends('layouts.admin')

@section('title', 'Modifier la bannière')

@section('content')
    <h1>Modifier « {{ $banniere->titre }} »</h1>
    <form method="POST" action="{{ route('admin.bannieres.update', $banniere) }}" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')
        <label>Titre
            <input type="text" name="titre" value="{{ old('titre', $banniere->titre) }}" required>
        </label>
        <label>Sous-titre
            <input type="text" name="sous_titre" value="{{ old('sous_titre', $banniere->sous_titre) }}">
        </label>
        <label>Image (laisser vide pour garder l'actuelle)
            <input type="file" name="image" accept="image/*">
        </label>
        @if($banniere->image)
            <img src="{{ asset('storage/'.$banniere->image) }}" alt="" class="current-logo">
        @endif
        <label>Lien (optionnel)
            <input type="text" name="lien" value="{{ old('lien', $banniere->lien) }}">
        </label>
        <label>Ordre d'affichage
            <input type="number" name="ordre" value="{{ old('ordre', $banniere->ordre) }}">
        </label>
        <label style="flex-direction:row; align-items:center; gap:10px;">
            <input type="checkbox" name="actif" value="1" {{ old('actif', $banniere->actif) ? 'checked' : '' }} style="width:auto;">
            Bannière active (visible sur le site)
        </label>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
