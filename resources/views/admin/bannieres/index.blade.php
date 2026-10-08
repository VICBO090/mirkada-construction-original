@extends('layouts.admin')

@section('title', 'Bannières')

@section('content')
    <div class="admin-header-row">
        <h1>Bannières d'accueil</h1>
        <a href="{{ route('admin.bannieres.create') }}" class="btn btn-primary">Ajouter une bannière</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr><th>Ordre</th><th>Titre</th><th>Statut</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($bannieres as $banniere)
                <tr>
                    <td>{{ $banniere->ordre }}</td>
                    <td>{{ $banniere->titre }}</td>
                    <td><span class="badge {{ $banniere->actif ? 'badge-traite' : 'badge-annule' }}">{{ $banniere->actif ? 'Active' : 'Inactive' }}</span></td>
                    <td class="actions">
                        <a href="{{ route('admin.bannieres.edit', $banniere) }}">Modifier</a>
                        <form method="POST" action="{{ route('admin.bannieres.destroy', $banniere) }}" onsubmit="return confirm('Supprimer cette bannière ?');">
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
