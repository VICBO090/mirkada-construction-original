@extends('layouts.admin')

@section('title', 'Modifier la certification')

@section('content')
    <h1>Modifier « {{ $certification->nom }} »</h1>
    <form method="POST" action="{{ route('admin.certifications.update', $certification) }}" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')
        <label>Nom
            <input type="text" name="nom" value="{{ old('nom', $certification->nom) }}" required>
        </label>
        <label>Image / logo
            <input type="file" name="image" accept="image/*">
        </label>
        @if($certification->image)
            <img src="{{ asset('storage/'.$certification->image) }}" alt="" class="current-logo">
        @endif
        <label>Description
            <textarea name="description" rows="3">{{ old('description', $certification->description) }}</textarea>
        </label>
        <label>Date d'obtention
            <input type="date" name="date_obtention" value="{{ old('date_obtention', $certification->date_obtention?->toDateString()) }}">
        </label>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
