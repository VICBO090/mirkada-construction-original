@extends('layouts.admin')

@section('title', 'Administrateurs')

@section('content')
    <div class="admin-header-row">
        <h1>Administrateurs</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Ajouter un administrateur</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr><th>Nom</th><th>E-mail</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }} @if($user->id === auth()->id()) <em>(vous)</em> @endif</td>
                    <td>{{ $user->email }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.users.edit', $user) }}">Modifier</a>
                        @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Supprimer cet administrateur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Supprimer</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection