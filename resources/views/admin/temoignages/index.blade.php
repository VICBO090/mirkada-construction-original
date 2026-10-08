@extends('layouts.admin')

@section('title', 'Témoignages')

@section('content')
    <h1>Témoignages</h1>
    <p style="color:var(--steel); font-size:0.85rem; margin-bottom:20px;">Les avis envoyés par les visiteurs apparaissent ici en attente. Seuls les témoignages approuvés sont publiés sur le site.</p>

    <table class="admin-table">
        <thead>
            <tr><th>Client</th><th>Note</th><th>Statut</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($temoignages as $t)
                <tr>
                    <td>{{ $t->nom_client }}</td>
                    <td>{{ $t->note ?? '—' }}/5</td>
                    <td><span class="badge {{ $t->approuve ? 'badge-traite' : 'badge-nouveau' }}">{{ $t->approuve ? 'Publié' : 'En attente' }}</span></td>
                    <td class="actions">
                        <a href="{{ route('admin.temoignages.edit', $t) }}">Voir / Modifier</a>
                        <form method="POST" action="{{ route('admin.temoignages.destroy', $t) }}" onsubmit="return confirm('Supprimer ce témoignage ?');">
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
