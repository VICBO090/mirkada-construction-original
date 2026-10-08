@extends('layouts.app')

@section('title', 'Recherche')

@section('content')

    <section class="hero hero-small">
        <div class="container">
            <p class="eyebrow">Résultats</p>
            <h1>Recherche{{ $q ? ' : "'.$q.'"' : '' }}</h1>
            <form method="GET" action="{{ route('recherche') }}" style="margin-top:20px; max-width:420px;">
                <input type="text" name="q" value="{{ $q }}" placeholder="Rechercher un service, un projet..." style="width:100%; padding:12px; border-radius:3px; border:none;">
            </form>
        </div>
        <div class="dim-line"><span>RECHERCHE</span></div>
    </section>

    <section class="section-alt">
        <div class="container">
            @if(strlen($q) < 2)
                <p class="empty-note">Tapez au moins 2 caractères pour lancer une recherche.</p>
            @else
                @if($services->isEmpty() && $projets->isEmpty() && $actualites->isEmpty())
                    <p class="empty-note">Aucun résultat pour « {{ $q }} ».</p>
                @endif

                @if($services->count())
                    <p class="eyebrow eyebrow-dark">Services</p>
                    <ul style="margin-bottom:30px;">
                        @foreach ($services as $s)
                            <li style="padding:8px 0; border-bottom:1px solid #DDD6C9;"><a href="{{ route('home') }}#services">{{ $s->titre }}</a></li>
                        @endforeach
                    </ul>
                @endif

                @if($projets->count())
                    <p class="eyebrow eyebrow-dark">Réalisations</p>
                    <ul style="margin-bottom:30px;">
                        @foreach ($projets as $p)
                            <li style="padding:8px 0; border-bottom:1px solid #DDD6C9;"><a href="{{ route('projets.show', $p) }}">{{ $p->titre }}</a></li>
                        @endforeach
                    </ul>
                @endif

                @if($actualites->count())
                    <p class="eyebrow eyebrow-dark">Actualités</p>
                    <ul style="margin-bottom:30px;">
                        @foreach ($actualites as $a)
                            <li style="padding:8px 0; border-bottom:1px solid #DDD6C9;"><a href="{{ route('actualites.show', $a) }}">{{ $a->titre }}</a></li>
                        @endforeach
                    </ul>
                @endif
            @endif
        </div>
    </section>

@endsection
