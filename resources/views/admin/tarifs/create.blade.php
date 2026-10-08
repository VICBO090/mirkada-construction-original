@extends('layouts.admin')

@section('title', 'Ajouter un tarif')

@section('content')
    <h1>Ajouter un tarif</h1>
    <form method="POST" action="{{ route('admin.tarifs.store') }}" class="admin-form">
        @csrf
        <label>Service concerné
            <select name="service_id" required>
                <option value="">— Choisir —</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{ $service->titre }}</option>
                @endforeach
            </select>
        </label>
        <label>Niveau / catégorie (ex: Économique, Standard, Haut de gamme)
            <input type="text" name="categorie" value="{{ old('categorie') }}" required>
        </label>
        <label>Libellé
            <input type="text" name="libelle" value="{{ old('libelle') }}" required>
        </label>
        <label>Description
            <textarea name="description" rows="3">{{ old('description') }}</textarea>
        </label>
        <label>Prix
            <input type="number" step="0.01" name="prix" value="{{ old('prix') }}" required>
        </label>
        <label>Unité (ex: m²)
            <input type="text" name="unite" value="{{ old('unite', 'm²') }}">
        </label>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection
