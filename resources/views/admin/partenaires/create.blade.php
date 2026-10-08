@extends('layouts.admin')

@section('title', 'Ajouter un partenaire')

@section('content')
    <h1>Ajouter un partenaire</h1>
    <form method="POST" action="{{ route('admin.partenaires.store') }}" enctype="multipart/form-data" class="admin-form">
        @csrf
        <label>Nom
            <input type="text" name="nom" value="{{ old('nom') }}" required>
        </label>
        <label>Logo
            <input type="file" name="logo" accept="image/*">
        </label>
        <label>Description
            <textarea name="description" rows="3">{{ old('description') }}</textarea>
        </label>
        <label>Lien vers le site (optionnel)
            <input type="url" name="lien_site" value="{{ old('lien_site') }}" placeholder="https://...">
        </label>
        <label>Ordre d'affichage
            <input type="number" name="ordre" value="{{ old('ordre', 0) }}">
        </label>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection
