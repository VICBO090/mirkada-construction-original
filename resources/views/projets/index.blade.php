@extends('layouts.app')

@section('title', 'Nos réalisations')

@section('content')

    <section class="hero hero-small">
        <div class="container">
            <p class="eyebrow">Ce que nous avons construit</p>
            <h1>Nos réalisations</h1>
        </div>
        <div class="dim-line"><span>RÉALISATIONS</span></div>
    </section>

    <section class="section-alt">
        <div class="container">
            <div class="news-grid">
                @forelse ($projets as $projet)
                    <article class="news-card">
                        @if($projet->image_principale)
                            <img src="{{ asset('storage/'.$projet->image_principale) }}" alt="{{ $projet->titre }}" class="news-image">
                        @endif
                        <span class="eyebrow eyebrow-dark">{{ ucfirst(str_replace('_', ' ', $projet->etat_avancement)) }}</span>
                        <h3><a href="{{ route('projets.show', $projet) }}">{{ $projet->titre }}</a></h3>
                        <p>{{ \Illuminate\Support\Str::limit($projet->description, 100) }}</p>
                        @if($projet->lieu)
                            <span class="news-date">{{ $projet->lieu }}</span>
                        @endif
                    </article>
                @empty
                    <p class="empty-note">Nos réalisations seront bientôt présentées ici.</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection