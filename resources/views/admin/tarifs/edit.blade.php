@extends('layouts.admin')

@section('title', 'Modifier le tarif')

@section('content')
    <h1>Modifier « {{ $tarif->libelle }} »</h1>
    <form method="POST" action="{{ route('admin.tarifs.update', $tarif) }}" class="admin-form">
        @csrf
        @method('PUT')
        <label>Service concerné
            <select name="service_id" required>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id', $tarif->service_id) == $service->id ? 'selected' : '' }}>{{ $service->titre }}</option>
                @endforeach
            </select>
        </label>
        <label>Niveau / catégorie
            <input type="text" name="categorie" value="{{ old('categorie', $tarif->categorie) }}" required>
        </label>
        <label>Libellé
            <input type="text" name="libelle" value="{{ old('libelle', $tarif->libelle) }}" required>
        </label>
        <label>Description
            <textarea name="description" rows="3">{{ old('description', $tarif->description) }}</textarea>
        </label>
        <label>Prix
            <input type="number" step="0.01" name="prix" value="{{ old('prix', $tarif->prix) }}" required>
        </label>
        <label>Unité
            <input type="text" name="unite" value="{{ old('unite', $tarif->unite) }}">
        </label>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection