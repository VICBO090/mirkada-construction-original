@extends('layouts.admin')

@section('title', 'Réalisations')

@section('content')
    <div class="admin-header-row">
        <h1>Réalisations</h1>
        <a href="{{ route('admin.projets.create') }}" class="btn btn-primary">Ajouter une réalisation</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr><th>Titre</th><th>Lieu</th><th>État</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($projets as $projet)
                <tr>
                    <td>{{ $projet->titre }}</td>
                    <td>{{ $projet->lieu ?? '—' }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $projet->etat_avancement)) }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.projets.edit', $projet) }}">Modifier</a>
                        <form method="POST" action="{{ route('admin.projets.destroy', $projet) }}" onsubmit="return confirm('Supprimer cette réalisation ?');">
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