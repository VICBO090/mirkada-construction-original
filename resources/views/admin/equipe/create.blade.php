@extends('layouts.admin')

@section('title', 'Ajouter un membre')

@section('content')
    <h1>Ajouter un membre de l'équipe</h1>
    <form method="POST" action="{{ route('admin.equipe.store') }}" enctype="multipart/form-data" class="admin-form">
        @csrf
        <label>Nom complet
            <input type="text" name="nom" value="{{ old('nom') }}" required>
        </label>
        <label>Poste
            <input type="text" name="poste" value="{{ old('poste') }}" required>
        </label>
        <label>Biographie courte
            <textarea name="bio" rows="4">{{ old('bio') }}</textarea>
        </label>
        <label>Photo
            <input type="file" name="photo" accept="image/*">
        </label>
        <label>Ordre d'affichage
            <input type="number" name="ordre" value="{{ old('ordre', 0) }}">
        </label>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection
