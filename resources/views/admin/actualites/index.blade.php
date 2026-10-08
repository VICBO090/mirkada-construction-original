@extends('layouts.admin')

@section('title', 'Actualités')

@section('content')
    <div class="admin-header-row">
        <h1>Actualités</h1>
        <a href="{{ route('admin.actualites.create') }}" class="btn btn-primary">Publier une actualité</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr><th>Titre</th><th>Type</th><th>Publiée le</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($actualites as $actualite)
                <tr>
                    <td>{{ $actualite->titre }}</td>
                    <td>{{ $actualite->type }}</td>
                    <td>{{ $actualite->publie_le?->format('d/m/Y') ?? '—' }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.actualites.edit', $actualite) }}">Modifier</a>
                        <form method="POST" action="{{ route('admin.actualites.destroy', $actualite) }}" onsubmit="return confirm('Supprimer cette actualité ?');">
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