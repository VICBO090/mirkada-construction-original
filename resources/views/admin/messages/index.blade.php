@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
    <h1>Messages reçus</h1>
    <table class="admin-table">
        <thead>
            <tr><th></th><th>Nom</th><th>Sujet</th><th>Reçu le</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->lu ? '' : '●' }}</td>
                    <td>{{ $message->nom }}</td>
                    <td>{{ $message->sujet ?: '—' }}</td>
                    <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.messages.show', $message) }}">Lire</a>
                        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Supprimer ce message ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection