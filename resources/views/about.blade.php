@extends("layouts.app")

@section("title", __("site.nav_about"))

@section("content")

    <section class="hero hero-small">
        <div class="container">
            <p class="eyebrow">{{ __("site.about_eyebrow") }}</p>
            <h1>{{ $entreprise->nom ?? "Mirkada Construction" }}</h1>
        </div>
        <div class="dim-line"><span>{{ strtoupper(__("site.nav_about")) }}</span></div>
    </section>

    <section class="section-alt">
        <div class="container about-grid">
            @if($entreprise?->histoire)
                <article class="about-block">
                    <p class="eyebrow eyebrow-dark">{{ __("site.about_history") }}</p>
                    <p>{{ $entreprise->histoire }}</p>
                </article>
            @endif
            @if($entreprise?->vision)
                <article class="about-block">
                    <p class="eyebrow eyebrow-dark">{{ __("site.about_vision") }}</p>
                    <p>{{ $entreprise->vision }}</p>
                </article>
            @endif
            @if($entreprise?->mission)
                <article class="about-block">
                    <p class="eyebrow eyebrow-dark">{{ __("site.about_mission") }}</p>
                    <p>{{ $entreprise->mission }}</p>
                </article>
            @endif
            @if($entreprise?->valeurs)
                <article class="about-block">
                    <p class="eyebrow eyebrow-dark">{{ __("site.about_values") }}</p>
                    <p>{{ $entreprise->valeurs }}</p>
                </article>
            @endif
            @if(!$entreprise?->histoire && !$entreprise?->vision && !$entreprise?->mission && !$entreprise?->valeurs)
                <p class="empty-note">{{ __("site.about_empty") }}</p>
            @endif
        </div>
    </section>

    @if($certifications->count())
    <section class="section-alt" style="padding-top:0;">
        <div class="container">
            <p class="eyebrow eyebrow-dark">{{ __("site.certifications_title") }}</p>
            <div class="cert-grid">
                @foreach ($certifications as $cert)
                    <article class="cert-card">
                        @if($cert->image)
                            <img src="{{ asset("storage/".$cert->image) }}" alt="{{ $cert->nom }}">
                        @endif
                        <h3>{{ $cert->nom }}</h3>
                        @if($cert->date_obtention)
                            <span class="news-date">{{ $cert->date_obtention->format("Y") }}</span>
                        @endif
                        @if($cert->description)
                            <p>{{ $cert->description }}</p>
                        @endif
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($partenaires->count())
    <section class="section-alt" style="padding-top:0;">
        <div class="container">
            <p class="eyebrow eyebrow-dark">{{ __("site.partners_title") }}</p>
            <div class="partner-grid">
                @foreach ($partenaires as $partenaire)
                    @if($partenaire->lien_site)
                        <a href="{{ $partenaire->lien_site }}" target="_blank" rel="noopener" class="partner-logo">
                    @else
                        <span class="partner-logo">
                    @endif
                        @if($partenaire->logo)
                            <img src="{{ asset("storage/".$partenaire->logo) }}" alt="{{ $partenaire->nom }}">
                        @else
                            {{ $partenaire->nom }}
                        @endif
                    @if($partenaire->lien_site)
                        </a>
                    @else
                        </span>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection
