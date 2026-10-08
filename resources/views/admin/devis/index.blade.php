@extends('layouts.admin')

@section('title', 'Demandes de devis')

@section('content')
    <h1>Demandes de devis</h1>
    <table class="admin-table">
        <thead>
            <tr><th>Nom</th><th>Type de projet</th><th>Statut</th><th>Reçu le</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($devis as $item)
                <tr>
                    <td>{{ $item->nom }}</td>
                    <td>{{ $item->type_projet }}</td>
                    <td><span class="badge badge-{{ $item->statut }}">{{ ucfirst(str_replace('_', ' ', $item->statut)) }}</span></td>
                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.devis.show', $item) }}">Voir</a>
                        <form method="POST" action="{{ route('admin.devis.destroy', $item) }}" onsubmit="return confirm('Supprimer cette demande ?');">
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