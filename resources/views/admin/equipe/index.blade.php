@extends('layouts.admin')

@section('title', 'Équipe')

@section('content')
    <div class="admin-header-row">
        <h1>Équipe</h1>
        <a href="{{ route('admin.equipe.create') }}" class="btn btn-primary">Ajouter un membre</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr><th>Ordre</th><th>Nom</th><th>Poste</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($membres as $membre)
                <tr>
                    <td>{{ $membre->ordre }}</td>
                    <td>{{ $membre->nom }}</td>
                    <td>{{ $membre->poste }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.equipe.edit', $membre) }}">Modifier</a>
                        <form method="POST" action="{{ route('admin.equipe.destroy', $membre) }}" onsubmit="return confirm('Supprimer ce membre ?');">
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