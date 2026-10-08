@extends('layouts.app')

@section('title', $actualite->titre)

@section('content')

    <section class="hero hero-small">
        <div class="container">
            <p class="eyebrow">{{ ucfirst($actualite->type) }}</p>
            <h1>{{ $actualite->titre }}</h1>
        </div>
        <div class="dim-line"><span>ACTUALITÉ</span></div>
    </section>

    <section class="section-alt">
        <div class="container news-detail">
            @if($actualite->image)
                <img src="{{ asset('storage/'.$actualite->image) }}" alt="{{ $actualite->titre }}" class="news-detail-image">
            @endif
            <p>{{ $actualite->contenu }}</p>
            <p><a href="{{ route('actualites.index') }}">← Toutes les actualités</a></p>
        </div>
    </section>

@endsection