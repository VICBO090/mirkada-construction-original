@extends('layouts.admin')

@section('title', 'Modifier le membre')

@section('content')
    <h1>Modifier {{ $equipe->nom }}</h1>
    <form method="POST" action="{{ route('admin.equipe.update', $equipe) }}" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')
        <label>Nom complet
            <input type="text" name="nom" value="{{ old('nom', $equipe->nom) }}" required>
        </label>
        <label>Poste
            <input type="text" name="poste" value="{{ old('poste', $equipe->poste) }}" required>
        </label>
        <label>Biographie courte
            <textarea name="bio" rows="4">{{ old('bio', $equipe->bio) }}</textarea>
        </label>
        <label>Photo
            <input type="file" name="photo" accept="image/*">
        </label>
        @if($equipe->photo)
            <img src="{{ asset('storage/'.$equipe->photo) }}" alt="" class="current-logo">
        @endif
        <label>Ordre d'affichage
            <input type="number" name="ordre" value="{{ old('ordre', $equipe->ordre) }}">
        </label>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection