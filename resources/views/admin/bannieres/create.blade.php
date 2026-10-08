@extends('layouts.admin')

@section('title', 'Ajouter une bannière')

@section('content')
    <h1>Ajouter une bannière</h1>
    <form method="POST" action="{{ route('admin.bannieres.store') }}" enctype="multipart/form-data" class="admin-form">
        @csrf
        <label>Titre
            <input type="text" name="titre" value="{{ old('titre') }}" required>
        </label>
        <label>Sous-titre
            <input type="text" name="sous_titre" value="{{ old('sous_titre') }}">
        </label>
        <label>Image (recommandé : format large, 1600×600px environ)
            <input type="file" name="image" accept="image/*" required>
        </label>
        <label>Lien (optionnel, au clic sur le bouton)
            <input type="text" name="lien" value="{{ old('lien') }}" placeholder="/devis ou https://...">
        </label>
        <label>Ordre d'affichage
            <input type="number" name="ordre" value="{{ old('ordre', 0) }}">
        </label>
        <label style="flex-direction:row; align-items:center; gap:10px;">
            <input type="checkbox" name="actif" value="1" {{ old('actif', true) ? 'checked' : '' }} style="width:auto;">
            Bannière active (visible sur le site)
        </label>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection
