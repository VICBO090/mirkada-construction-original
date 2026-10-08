@extends('layouts.admin')

@section('title', $label)

@section('content')
    <h1>{{ $label }}</h1>
    <form method="POST" action="{{ route('admin.page-legales.update', $type) }}" class="admin-form" style="max-width:720px;">
        @csrf
        @method('PUT')
        <label>Titre affiché sur le site
            <input type="text" name="titre" value="{{ old('titre', $page->titre) }}" required>
        </label>
        <label>Contenu
            <textarea name="contenu" rows="16">{{ old('contenu', $page->contenu) }}</textarea>
        </label>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
