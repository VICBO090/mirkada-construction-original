@extends('layouts.admin')

@section('title', "Modifier l'administrateur")

@section('content')
    <h1>Modifier {{ $user->name }}</h1>
    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="admin-form">
        @csrf
        @method('PUT')
        <label>Nom complet
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </label>
        <label>E-mail
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </label>
        <label>Nouveau mot de passe (laisser vide pour ne pas changer)
            <input type="password" name="password">
        </label>
        <label>Confirmer le nouveau mot de passe
            <input type="password" name="password_confirmation">
        </label>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection