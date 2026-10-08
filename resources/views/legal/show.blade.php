@extends("layouts.app")

@section("title", $page->titre)

@section("content")

    <section class="hero hero-small">
        <div class="container">
            <p class="eyebrow">{{ __("site.legal_eyebrow") }}</p>
            <h1>{{ $page->titre }}</h1>
        </div>
        <div class="dim-line"><span>{{ strtoupper($page->titre) }}</span></div>
    </section>

    <section class="section-alt">
        <div class="container news-detail">
            <p style="white-space:pre-line;">{{ $page->contenu }}</p>
        </div>
    </section>

@endsection
