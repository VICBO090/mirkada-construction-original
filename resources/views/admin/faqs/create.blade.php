@extends('layouts.admin')

@section('title', 'Ajouter une question')

@section('content')
    <h1>Ajouter une question</h1>
    <form method="POST" action="{{ route('admin.faqs.store') }}" class="admin-form">
        @csrf
        <label>Question
            <input type="text" name="question" value="{{ old('question') }}" required>
        </label>
        <label>Réponse
            <textarea name="reponse" rows="4" required>{{ old('reponse') }}</textarea>
        </label>
        <label>Ordre d'affichage
            <input type="number" name="ordre" value="{{ old('ordre', 0) }}">
        </label>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection
