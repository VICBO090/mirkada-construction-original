@extends('layouts.admin')

@section('title', 'Modifier la question')

@section('content')
    <h1>Modifier la question</h1>
    <form method="POST" action="{{ route('admin.faqs.update', $faq) }}" class="admin-form">
        @csrf
        @method('PUT')
        <label>Question
            <input type="text" name="question" value="{{ old('question', $faq->question) }}" required>
        </label>
        <label>Réponse
            <textarea name="reponse" rows="4" required>{{ old('reponse', $faq->reponse) }}</textarea>
        </label>
        <label>Ordre d'affichage
            <input type="number" name="ordre" value="{{ old('ordre', $faq->ordre) }}">
        </label>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
