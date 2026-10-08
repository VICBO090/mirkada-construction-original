@extends('layouts.app')

@section('title', $projet->titre)

@section('content')

    <section class="hero hero-small">
        <div class="container">
            <p class="eyebrow">{{ $projet->service->titre ?? 'Réalisation' }}</p>
            <h1>{{ $projet->titre }}</h1>
        </div>
        <div class="dim-line"><span>RÉALISATION</span></div>
    </section>

    <section class="section-alt">
        <div class="container news-detail">
            @if($projet->image_principale)
                <img src="{{ asset('storage/'.$projet->image_principale) }}" alt="{{ $projet->titre }}" class="news-detail-image">
            @endif

            <p>{{ $projet->description }}</p>

            <ul style="margin-bottom:24px; color:var(--steel); font-size:0.9rem;">
                @if($projet->lieu)<li><strong>Lieu :</strong> {{ $projet->lieu }}</li>@endif
                @if($projet->type_projet)<li><strong>Type :</strong> {{ $projet->type_projet }}</li>@endif
                <li><strong>État :</strong> {{ ucfirst(str_replace('_', ' ', $projet->etat_avancement)) }}</li>
            </ul>

            @if($projet->photos && count($projet->photos))
                <div class="team-grid">
                    @foreach ($projet->photos as $photo)
                        <img src="{{ asset('storage/'.$photo) }}" alt="" style="width:100%; border-radius:2px;">
                    @endforeach
                </div>
            @endif

            <p style="margin-top:24px;"><a href="{{ route('projets.index') }}">← Toutes les réalisations</a></p>
        </div>
    </section>

@endsection