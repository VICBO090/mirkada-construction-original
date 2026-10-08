@extends('layouts.admin')

@section('title', 'Témoignage de '.$temoignage->nom_client)

@section('content')
    <h1>Témoignage de {{ $temoignage->nom_client }}</h1>
    <form method="POST" action="{{ route('admin.temoignages.update', $temoignage) }}" class="admin-form">
        @csrf
        @method('PUT')
        <label>Nom du client
            <input type="text" name="nom_client" value="{{ old('nom_client', $temoignage->nom_client) }}" required>
        </label>
        <label>Poste / entreprise du client
            <input type="text" name="poste_client" value="{{ old('poste_client', $temoignage->poste_client) }}">
        </label>
        <label>Contenu de l'avis
            <textarea name="contenu" rows="4" required>{{ old('contenu', $temoignage->contenu) }}</textarea>
        </label>
        <label>Note (1 à 5)
            <input type="number" name="note" min="1" max="5" value="{{ old('note', $temoignage->note) }}">
        </label>
        <label style="flex-direction:row; align-items:center; gap:10px;">
            <input type="checkbox" name="approuve" value="1" {{ old('approuve', $temoignage->approuve) ? 'checked' : '' }} style="width:auto;">
            Publier ce témoignage sur le site
        </label>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
