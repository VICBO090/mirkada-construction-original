@extends('layouts.app')

@section('title', 'Notre équipe')

@section('content')

    <section class="hero hero-small">
        <div class="container">
            <p class="eyebrow">Les personnes derrière vos projets</p>
            <h1>Notre équipe</h1>
        </div>
        <div class="dim-line"><span>ÉQUIPE</span></div>
    </section>

    <section class="section-alt">
        <div class="container">
            <div class="team-grid">
                @forelse ($membres as $membre)
                    <article class="team-card">
                        @if($membre->photo)
                            <img src="{{ asset('storage/'.$membre->photo) }}" alt="{{ $membre->nom }}" class="team-photo">
                        @endif
                        <h3>{{ $membre->nom }}</h3>
                        <p class="team-poste">{{ $membre->poste }}</p>
                        @if($membre->bio)
                            <p>{{ $membre->bio }}</p>
                        @endif
                    </article>
                @empty
                    <p class="empty-note">L'équipe sera bientôt présentée ici.</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection