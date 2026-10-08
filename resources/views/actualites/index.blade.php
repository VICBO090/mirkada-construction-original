@extends('layouts.app')

@section('title', 'Actualités')

@section('content')

    <section class="hero hero-small">
        <div class="container">
            <p class="eyebrow">Suivez nos actualités</p>
            <h1>Actualités</h1>
        </div>
        <div class="dim-line"><span>ACTUALITÉS</span></div>
    </section>

    <section class="section-alt">
        <div class="container">
            <div class="news-grid">
                @forelse ($actualites as $actualite)
                    <article class="news-card">
                        @if($actualite->image)
                            <img src="{{ asset('storage/'.$actualite->image) }}" alt="{{ $actualite->titre }}" class="news-image">
                        @endif
                        <span class="eyebrow eyebrow-dark">{{ ucfirst($actualite->type) }}</span>
                        <h3><a href="{{ route('actualites.show', $actualite) }}">{{ $actualite->titre }}</a></h3>
                        <p>{{ $actualite->extrait ?? \Illuminate\Support\Str::limit($actualite->contenu, 100) }}</p>
                        @if($actualite->publie_le)
                            <span class="news-date">{{ $actualite->publie_le->format('d/m/Y') }}</span>
                        @endif
                    </article>
                @empty
                    <p class="empty-note">Aucune actualité pour l'instant.</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection