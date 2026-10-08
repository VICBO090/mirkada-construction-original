@extends('layouts.admin')

@section('title', 'Modifier le partenaire')

@section('content')
    <h1>Modifier « {{ $partenaire->nom }} »</h1>
    <form method="POST" action="{{ route('admin.partenaires.update', $partenaire) }}" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')
        <label>Nom
            <input type="text" name="nom" value="{{ old('nom', $partenaire->nom) }}" required>
        </label>
        <label>Logo
            <input type="file" name="logo" accept="image/*">
        </label>
        @if($partenaire->logo)
            <img src="{{ asset('storage/'.$partenaire->logo) }}" alt="" class="current-logo">
        @endif
        <label>Description
            <textarea name="description" rows="3">{{ old('description', $partenaire->description) }}</textarea>
        </label>
        <label>Lien vers le site (optionnel)
            <input type="url" name="lien_site" value="{{ old('lien_site', $partenaire->lien_site) }}" placeholder="https://...">
        </label>
        <label>Ordre d'affichage
            <input type="number" name="ordre" value="{{ old('ordre', $partenaire->ordre) }}">
        </label>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
