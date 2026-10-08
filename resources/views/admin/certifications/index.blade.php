@extends('layouts.admin')

@section('title', 'Certifications')

@section('content')
    <div class="admin-header-row">
        <h1>Certifications</h1>
        <a href="{{ route('admin.certifications.create') }}" class="btn btn-primary">Ajouter une certification</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr><th>Nom</th><th>Obtenue le</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($certifications as $cert)
                <tr>
                    <td>{{ $cert->nom }}</td>
                    <td>{{ $cert->date_obtention?->format('d/m/Y') ?? '—' }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.certifications.edit', $cert) }}">Modifier</a>
                        <form method="POST" action="{{ route('admin.certifications.destroy', $cert) }}" onsubmit="return confirm('Supprimer cette certification ?');">
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
