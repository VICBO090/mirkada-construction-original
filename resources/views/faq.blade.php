@extends("layouts.app")

@section("title", __("site.nav_faq"))

@section("content")

    <section class="hero hero-small">
        <div class="container">
            <p class="eyebrow">{{ __("site.faq_eyebrow") }}</p>
            <h1>{{ __("site.faq_title") }}</h1>
        </div>
        <div class="dim-line"><span>FAQ</span></div>
    </section>

    <section class="section-alt">
        <div class="container" style="max-width:760px;">
            @forelse ($faqs as $faq)
                <details class="faq-item">
                    <summary>{{ $faq->question }}</summary>
                    <p>{{ $faq->reponse }}</p>
                </details>
            @empty
                <p class="empty-note">{{ __("site.faq_empty") }}</p>
            @endforelse
        </div>
    </section>

@endsection
