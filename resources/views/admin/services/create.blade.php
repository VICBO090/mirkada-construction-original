@extends('layouts.admin')

@section('title', 'Ajouter un service')

@section('content')
    <h1>Ajouter un service</h1>
    <form method="POST" action="{{ route('admin.services.store') }}" class="admin-form">
        @csrf
        <label>Titre
            <input type="text" name="titre" value="{{ old('titre') }}" required>
        </label>
        <label>Description courte
            <textarea name="description_courte" rows="2" required>{{ old('description_courte') }}</textarea>
        </label>
        <label>Description longue
            <textarea name="description_longue" rows="5">{{ old('description_longue') }}</textarea>
        </label>
        <label>Ordre d'affichage
            <input type="number" name="ordre" value="{{ old('ordre', 0) }}">
        </label>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection