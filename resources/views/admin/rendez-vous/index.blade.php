@extends('layouts.admin')

@section('title', 'Rendez-vous')

@section('content')
    <h1>Rendez-vous</h1>
    <table class="admin-table">
        <thead>
            <tr><th>Nom</th><th>Date souhaitée</th><th>Heure</th><th>Statut</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($rendezVous as $rdv)
                <tr>
                    <td>{{ $rdv->nom }}</td>
                    <td>{{ \Carbon\Carbon::parse($rdv->date_souhaitee)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($rdv->heure_souhaitee)->format('H:i') }}</td>
                    <td><span class="badge badge-{{ $rdv->statut }}">{{ ucfirst(str_replace('_', ' ', $rdv->statut)) }}</span></td>
                    <td class="actions">
                        <a href="{{ route('admin.rendez-vous.show', $rdv) }}">Voir</a>
                        <form method="POST" action="{{ route('admin.rendez-vous.destroy', $rdv) }}" onsubmit="return confirm('Supprimer ce rendez-vous ?');">
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