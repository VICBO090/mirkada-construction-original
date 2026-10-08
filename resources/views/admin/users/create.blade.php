@extends('layouts.admin')

@section('title', 'Ajouter un administrateur')

@section('content')
    <h1>Ajouter un administrateur</h1>
    <form method="POST" action="{{ route('admin.users.store') }}" class="admin-form">
        @csrf
        <label>Nom complet
            <input type="text" name="name" value="{{ old('name') }}" required>
        </label>
        <label>E-mail
            <input type="email" name="email" value="{{ old('email') }}" required>
        </label>
        <label>Mot de passe
            <input type="password" name="password" required>
        </label>
        <label>Confirmer le mot de passe
            <input type="password" name="password_confirmation" required>
        </label>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection