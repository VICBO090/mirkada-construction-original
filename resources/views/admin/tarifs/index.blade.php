@extends('layouts.admin')

@section('title', 'Tarifs')

@section('content')
    <div class="admin-header-row">
        <h1>Tarifs</h1>
        <a href="{{ route('admin.tarifs.create') }}" class="btn btn-primary">Ajouter un tarif</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr><th>Service</th><th>Niveau</th><th>Libellé</th><th>Prix</th><th>Unité</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($tarifs as $tarif)
                <tr>
                    <td>{{ $tarif->service->titre ?? '—' }}</td>
                    <td>{{ $tarif->categorie }}</td>
                    <td>{{ $tarif->libelle }}</td>
                    <td>{{ number_format($tarif->prix, 2) }} $</td>
                    <td>{{ $tarif->unite }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.tarifs.edit', $tarif) }}">Modifier</a>
                        <form method="POST" action="{{ route('admin.tarifs.destroy', $tarif) }}" onsubmit="return confirm('Supprimer ce tarif ?');">
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