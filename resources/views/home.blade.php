@extends('layouts.app')

@section('content')

    @if($bannieres->count())
    <section class="banner-carousel" id="bannerCarousel">
        @foreach ($bannieres as $i => $banniere)
            <div class="banner-slide {{ $i === 0 ? 'is-active' : '' }}">
                <img src="{{ asset('storage/'.$banniere->image) }}" alt="{{ $banniere->titre }}">
                <div class="banner-caption">
                    <h2>{{ $banniere->titre }}</h2>
                    @if($banniere->sous_titre)<p>{{ $banniere->sous_titre }}</p>@endif
                    @if($banniere->lien)<a href="{{ $banniere->lien }}" class="btn btn-primary">{{ __('site.banner_cta') }}</a>@endif
                </div>
            </div>
        @endforeach
    </section>
    @endif

    <section class="hero">
        <div class="container">
            <p class="eyebrow">{{ __('site.hero_eyebrow') }}</p>
            <h1>{!! __('site.hero_title') !!}</h1>
            <p class="hero-sub">{{ __('site.hero_sub') }}</p>
            <div class="hero-actions">
                <a href="tel:{{ $entreprise->telephone ?? '' }}" class="btn btn-primary">{{ __('site.hero_call') }}</a>
                <a href="{{ route('devis.create') }}" class="btn btn-ghost">{{ __('site.hero_quote') }}</a>
            </div>
        </div>
        <div class="dim-line"><span>01 — {{ strtoupper(__('site.process_step1_title')) }}</span></div>
    </section>

    <section class="section-alt about-teaser">
        <div class="container">
            <p class="eyebrow eyebrow-dark">{{ __('site.home_about_eyebrow') }}</p>
            <h2>{{ $entreprise->accroche_titre ?? "Trois ingénieurs de formation, une seule mission : construire juste." }}</h2>
            <p>{{ $entreprise->accroche_texte ?? "Nous disposons d'un bureau d'étude qui analyse vos projets et d'une équipe technique qualifiée pour le suivi des travaux — des plans jusqu'à la réception du chantier." }}</p>
        </div>
    </section>

    @if($entreprise?->nb_projets_realises || $entreprise?->annees_experience)
    <section class="stats-band">
        <div class="container stats-grid">
            @if($entreprise?->nb_projets_realises)
                <div class="stat-item"><span class="stat-figure" data-count="{{ $entreprise->nb_projets_realises }}">0</span><span class="stat-caption">{{ __('site.stat_projects') }}</span></div>
            @endif
            @if($entreprise?->annees_experience)
                <div class="stat-item"><span class="stat-figure" data-count="{{ $entreprise->annees_experience }}">0</span><span class="stat-caption">{{ __('site.stat_years') }}</span></div>
            @endif
        </div>
    </section>
    @endif

    <section class="services" id="services">
        <div class="container">
            <p class="eyebrow eyebrow-dark">{{ __('site.home_services_eyebrow') }}</p>
            <h2>{{ __('site.home_services_title') }}</h2>
            <div class="services-grid">
                @forelse ($services as $service)
                    <article class="service-card">
                        <span class="service-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3>{{ $service->titre }}</h3>
                        <p>{{ $service->description_courte }}</p>
                    </article>
                @empty
                    <p class="empty-note">{{ __('site.home_services_empty') }}</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="process" id="processus">
        <div class="container">
            <p class="eyebrow">{{ __('site.process_eyebrow') }}</p>
            <h2>{{ __('site.process_title') }}</h2>
            <ol class="process-steps">
                <li><span class="step-num">01</span><h3>{{ __('site.process_step1_title') }}</h3><p>{{ __('site.process_step1_text') }}</p></li>
                <li><span class="step-num">02</span><h3>{{ __('site.process_step2_title') }}</h3><p>{{ __('site.process_step2_text') }}</p></li>
                <li><span class="step-num">03</span><h3>{{ __('site.process_step3_title') }}</h3><p>{{ __('site.process_step3_text') }}</p></li>
                <li><span class="step-num">04</span><h3>{{ __('site.process_step4_title') }}</h3><p>{{ __('site.process_step4_text') }}</p></li>
            </ol>
        </div>
    </section>

    @if($temoignages->count())
    <section class="section-alt">
        <div class="container">
            <p class="eyebrow eyebrow-dark">{{ __('site.testimonials_title') }}</p>
            <h2>{{ __('site.testimonials_subtitle') }}</h2>
            <div class="testimonial-grid">
                @foreach ($temoignages as $t)
                    <article class="testimonial-card">
                        <div class="testimonial-stars">{{ str_repeat('★', $t->note ?? 5) }}{{ str_repeat('☆', 5 - ($t->note ?? 5)) }}</div>
                        <p>&laquo; {{ $t->contenu }} &raquo;</p>
                        <span class="testimonial-author">{{ $t->nom_client }}@if($t->poste_client) — {{ $t->poste_client }}@endif</span>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="cta-band">
        <div class="container cta-inner">
            <div>
                <h2>{{ __('site.cta_title') }}</h2>
                <p>{{ __('site.cta_text') }}</p>
            </div>
            <div class="cta-actions">
                <a href="tel:{{ $entreprise->telephone ?? '' }}" class="btn btn-primary">{{ $entreprise->telephone ?? '' }}</a>
                <a href="mailto:{{ $entreprise->email ?? '' }}" class="btn btn-outline-light">{{ __('site.cta_email') }}</a>
            </div>
        </div>
    </section>

    <section class="contact-section" id="contact">
        <div class="container contact-grid">
            <div>
                <p class="eyebrow eyebrow-dark">{{ __('site.contact_eyebrow') }}</p>
                <h2>{{ __('site.contact_title') }}</h2>
                <p>{{ __('site.contact_text') }}</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="contact-form">
                @csrf
                <input type="text" name="site_web" value="" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;top:-9999px;" aria-hidden="true">
                <label>{{ __('site.form_name') }}
                    <input type="text" name="nom" value="{{ old('nom') }}" required>
                </label>
                <label>{{ __('site.form_email') }}
                    <input type="email" name="email" value="{{ old('email') }}" required>
                </label>
                <label>{{ __('site.form_phone') }}
                    <input type="text" name="telephone" value="{{ old('telephone') }}">
                </label>
                <label>{{ __('site.form_subject') }}
                    <input type="text" name="sujet" value="{{ old('sujet') }}">
                </label>
                <label>{{ __('site.form_message') }}
                    <textarea name="message" rows="4" required>{{ old('message') }}</textarea>
                </label>
                <button type="submit" class="btn btn-primary">{{ __('site.form_send') }}</button>
            </form>
        </div>
    </section>

    <script>
        if (document.getElementById('bannerCarousel')) {
            const slides = document.querySelectorAll('#bannerCarousel .banner-slide');
            if (slides.length > 1) {
                let current = 0;
                setInterval(() => {
                    slides[current].classList.remove('is-active');
                    current = (current + 1) % slides.length;
                    slides[current].classList.add('is-active');
                }, 5000);
            }
        }

        document.querySelectorAll('.stat-figure').forEach(function (el) {
            const target = parseInt(el.dataset.count, 10) || 0;
            let current = 0;
            const step = Math.max(1, Math.ceil(target / 60));
            const timer = setInterval(function () {
                current += step;
                if (current >= target) { current = target; clearInterval(timer); }
                el.textContent = current;
            }, 25);
        });
    </script>

@endsection
