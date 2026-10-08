@extends('layouts.admin')

@section('title', 'Modifier le service')

@section('content')
    <h1>Modifier « {{ $service->titre }} »</h1>
    <form method="POST" action="{{ route('admin.services.update', $service) }}" class="admin-form">
        @csrf
        @method('PUT')
        <label>Titre
            <input type="text" name="titre" value="{{ old('titre', $service->titre) }}" required>
        </label>
        <label>Description courte
            <textarea name="description_courte" rows="2" required>{{ old('description_courte', $service->description_courte) }}</textarea>
        </label>
        <label>Description longue
            <textarea name="description_longue" rows="5">{{ old('description_longue', $service->description_longue) }}</textarea>
        </label>
        <label>Ordre d'affichage
            <input type="number" name="ordre" value="{{ old('ordre', $service->ordre) }}">
        </label>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection