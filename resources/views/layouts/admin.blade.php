<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') — Mirkada Construction</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@500&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="admin-layout">
        <button class="admin-nav-toggle" id="adminNavToggle" aria-label="Ouvrir le menu">☰</button>
        <aside class="admin-sidebar" id="adminSidebar">
            <p class="admin-logo">MIRKADA <span>ADMIN</span></p>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Tableau de bord</a>
                <a href="{{ route('admin.entreprise.edit') }}" class="{{ request()->routeIs('admin.entreprise.*') ? 'active' : '' }}">Informations entreprise</a>
                <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">Services</a>
                <a href="{{ route('admin.tarifs.index') }}" class="{{ request()->routeIs('admin.tarifs.*') ? 'active' : '' }}">Tarifs</a>
                <a href="{{ route('admin.projets.index') }}" class="{{ request()->routeIs('admin.projets.*') ? 'active' : '' }}">Réalisations</a>
                <a href="{{ route('admin.equipe.index') }}" class="{{ request()->routeIs('admin.equipe.*') ? 'active' : '' }}">Équipe</a>
                <a href="{{ route('admin.partenaires.index') }}" class="{{ request()->routeIs('admin.partenaires.*') ? 'active' : '' }}">Partenaires</a>
                <a href="{{ route('admin.certifications.index') }}" class="{{ request()->routeIs('admin.certifications.*') ? 'active' : '' }}">Certifications</a>
                <a href="{{ route('admin.temoignages.index') }}" class="{{ request()->routeIs('admin.temoignages.*') ? 'active' : '' }}">Témoignages</a>
                <a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">FAQ</a>
                <a href="{{ route('admin.bannieres.index') }}" class="{{ request()->routeIs('admin.bannieres.*') ? 'active' : '' }}">Bannières</a>
                <a href="{{ route('admin.page-legales.index') }}" class="{{ request()->routeIs('admin.page-legales.*') ? 'active' : '' }}">Pages légales</a>
                <a href="{{ route('admin.devis.index') }}" class="{{ request()->routeIs('admin.devis.*') ? 'active' : '' }}">Devis</a>
                <a href="{{ route('admin.rendez-vous.index') }}" class="{{ request()->routeIs('admin.rendez-vous.*') ? 'active' : '' }}">Rendez-vous</a>
                <a href="{{ route('admin.actualites.index') }}" class="{{ request()->routeIs('admin.actualites.*') ? 'active' : '' }}">Actualités</a>
                <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">Messages</a>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Administrateurs</a>
            </nav>
            <form method="POST" action="{{ route('admin.logout') }}" class="admin-logout">
                @csrf
                <button type="submit">Déconnexion</button>
            </form>
        </aside>
        <main class="admin-content">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('adminNavToggle');
            const sidebar = document.getElementById('adminSidebar');
            if (toggle) {
                toggle.addEventListener('click', function () {
                    sidebar.classList.toggle('is-open');
                });
            }
        });
    </script>
</body>
</html>
