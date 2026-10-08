@extends('layouts.admin')

@section('title', 'FAQ')

@section('content')
    <div class="admin-header-row">
        <h1>Foire aux questions</h1>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">Ajouter une question</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr><th>Ordre</th><th>Question</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($faqs as $faq)
                <tr>
                    <td>{{ $faq->ordre }}</td>
                    <td>{{ $faq->question }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.faqs.edit', $faq) }}">Modifier</a>
                        <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" onsubmit="return confirm('Supprimer cette question ?');">
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
