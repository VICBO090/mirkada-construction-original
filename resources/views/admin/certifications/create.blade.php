@extends('layouts.admin')

@section('title', 'Ajouter une certification')

@section('content')
    <h1>Ajouter une certification</h1>
    <form method="POST" action="{{ route('admin.certifications.store') }}" enctype="multipart/form-data" class="admin-form">
        @csrf
        <label>Nom
            <input type="text" name="nom" value="{{ old('nom') }}" required>
        </label>
        <label>Image / logo
            <input type="file" name="image" accept="image/*">
        </label>
        <label>Description
            <textarea name="description" rows="3">{{ old('description') }}</textarea>
        </label>
        <label>Date d'obtention
            <input type="date" name="date_obtention" value="{{ old('date_obtention') }}">
        </label>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection
