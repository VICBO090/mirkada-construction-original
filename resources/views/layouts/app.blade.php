<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $entreprise->nom ?? 'Mirkada Construction') — Lubumbashi</title>
    <meta name="description" content="@yield('meta_description', "Bureau d'étude et entreprise de construction à Lubumbashi. Conception, devis et exécution de vos projets.")">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=IBM+Plex+Mono:wght@500&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <header class="site-header">
        <div class="container header-utility">
            <div class="lang-switch">
                <a href="{{ route('lang.switch', 'fr') }}" class="{{ app()->getLocale() == 'fr' ? 'active' : '' }}">FR</a>
                <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
            </div>
            <a href="tel:{{ $entreprise->telephone ?? '' }}" class="header-phone">{{ $entreprise->telephone ?? '' }}</a>
        </div>
        <div class="container header-inner">
            <a href="{{ route('home') }}" class="logo">
                @if($entreprise?->logo)
                    <img src="{{ asset('storage/'.$entreprise->logo) }}" alt="{{ $entreprise->nom }}" class="logo-img">
                @endif
                <span>{{ $entreprise->nom ?? 'Mirkada Construction' }}</span>
            </a>

            <button class="nav-toggle" id="navToggle" aria-label="Ouvrir le menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>

            <nav class="main-nav" id="mainNav">
                <a href="{{ route('home') }}">{{ __('site.nav_home') }}</a>
                <a href="{{ route('about') }}">{{ __('site.nav_about') }}</a>
                <a href="{{ route('home') }}#services">{{ __('site.nav_services') }}</a>
                <a href="{{ route('projets.index') }}">{{ __('site.nav_projects') }}</a>
                <a href="{{ route('equipe') }}">{{ __('site.nav_team') }}</a>
                <a href="{{ route('actualites.index') }}">{{ __('site.nav_news') }}</a>
                <a href="{{ route('faq') }}">{{ __('site.nav_faq') }}</a>
                <a href="{{ route('home') }}#contact">{{ __('site.nav_contact') }}</a>
                <a href="{{ route('devis.create') }}" class="mobile-only-link">{{ __('site.nav_devis') }}</a>
                <a href="{{ route('rendez-vous.create') }}" class="mobile-only-link">{{ __('site.nav_appointment') }}</a>
            </nav>

            <div class="header-cta">
                <a href="{{ route('rendez-vous.create') }}" class="btn btn-outline">{{ __('site.nav_appointment') }}</a>
                <a href="{{ route('devis.create') }}" class="btn btn-primary">{{ __('site.nav_devis') }}</a>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <div>
                <p class="logo footer-logo">{{ $entreprise->nom ?? 'Mirkada Construction' }}</p>
                <p class="footer-tagline">Bureau d'étude &amp; exécution — Lubumbashi, RDC</p>
            </div>
            <div class="footer-contact">
                <p>{{ $entreprise->adresse ?? '' }}</p>
                <p><a href="tel:{{ $entreprise->telephone ?? '' }}">{{ $entreprise->telephone ?? '' }}</a></p>
                <p><a href="mailto:{{ $entreprise->email ?? '' }}">{{ $entreprise->email ?? '' }}</a></p>
            </div>
            <div class="footer-legal">
                <a href="{{ route('legal.show', 'mentions_legales') }}">{{ __('site.legal_notice') }}</a>
                <a href="{{ route('legal.show', 'cgu') }}">{{ __('site.legal_terms') }}</a>
                <a href="{{ route('legal.show', 'confidentialite') }}">{{ __('site.legal_privacy') }}</a>
            </div>
        </div>
        <p class="footer-copy">© {{ date('Y') }} {{ $entreprise->nom ?? 'Mirkada Construction' }}. Tous droits réservés.</p>
    </footer>

    <div class="floating-actions">
        @if($entreprise?->telephone)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $entreprise->telephone) }}" target="_blank" rel="noopener" class="fab fab-whatsapp" aria-label="Discuter sur WhatsApp">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.29-1.39a9.9 9.9 0 0 0 4.75 1.21h.01c5.46 0 9.9-4.45 9.9-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2m0 1.67c2.24 0 4.35.87 5.93 2.46a8.3 8.3 0 0 1 2.45 5.78c0 4.55-3.7 8.24-8.25 8.24a8.2 8.2 0 0 1-4.2-1.15l-.3-.18-3.14.82.84-3.06-.2-.32a8.18 8.18 0 0 1-1.26-4.37c0-4.55 3.7-8.24 8.24-8.24z"/></svg>
            </a>
        @endif
        @if($entreprise?->email)
            <a href="mailto:{{ $entreprise->email }}" class="fab fab-mail" aria-label="Envoyer un e-mail">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m0 4-8 5-8-5V6l8 5 8-5z"/></svg>
            </a>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('navToggle');
            const nav = document.getElementById('mainNav');
            toggle.addEventListener('click', function () {
                const isOpen = nav.classList.toggle('is-open');
                toggle.classList.toggle('is-active', isOpen);
                toggle.setAttribute('aria-expanded', isOpen);
            });
        });
    </script>

    @yield('scripts')

</body>
</html>
