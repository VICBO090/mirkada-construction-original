@extends('layouts.admin')

@section('title', 'Services')

@section('content')
    <div class="admin-header-row">
        <h1>Services</h1>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Ajouter un service</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr><th>Ordre</th><th>Titre</th><th>Description courte</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->ordre }}</td>
                    <td>{{ $service->titre }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($service->description_courte, 60) }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.services.edit', $service) }}">Modifier</a>
                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Supprimer ce service ?');">
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