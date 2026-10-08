@extends('layouts.admin')

@section('title', 'Pages légales')

@section('content')
    <h1>Pages légales</h1>
    <table class="admin-table">
        <thead>
            <tr><th>Page</th><th>Statut</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($types as $type => $label)
                <tr>
                    <td>{{ $label }}</td>
                    <td>
                        @if(isset($pages[$type]))
                            <span class="badge badge-traite">Rédigée</span>
                        @else
                            <span class="badge badge-nouveau">Vide</span>
                        @endif
                    </td>
                    <td class="actions">
                        <a href="{{ route('admin.page-legales.edit', $type) }}">Modifier</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
