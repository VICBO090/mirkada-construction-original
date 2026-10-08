@extends('layouts.admin')

@section('title', 'Partenaires')

@section('content')
    <div class="admin-header-row">
        <h1>Partenaires</h1>
        <a href="{{ route('admin.partenaires.create') }}" class="btn btn-primary">Ajouter un partenaire</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr><th>Ordre</th><th>Nom</th><th>Site</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($partenaires as $partenaire)
                <tr>
                    <td>{{ $partenaire->ordre }}</td>
                    <td>{{ $partenaire->nom }}</td>
                    <td>{{ $partenaire->lien_site ?? '—' }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.partenaires.edit', $partenaire) }}">Modifier</a>
                        <form method="POST" action="{{ route('admin.partenaires.destroy', $partenaire) }}" onsubmit="return confirm('Supprimer ce partenaire ?');">
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
