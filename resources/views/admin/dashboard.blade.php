@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
    <h1>Tableau de bord</h1>

    <div class="stat-grid">
        <div class="stat-card">
            <span class="stat-num">{{ $stats['services'] }}</span>
            <span class="stat-label">Services publiés</span>
        </div>
        <div class="stat-card">
            <span class="stat-num">{{ $stats['devis_nouveaux'] }}</span>
            <span class="stat-label">Nouveaux devis</span>
        </div>
        <div class="stat-card">
            <span class="stat-num">{{ $stats['messages_non_lus'] }}</span>
            <span class="stat-label">Messages non lus</span>
        </div>
        <div class="stat-card">
            <span class="stat-num">{{ $stats['actualites'] }}</span>
            <span class="stat-label">Actualités publiées</span>
        </div>
    </div>

    <div class="chart-grid">
        <div class="chart-card">
            <p class="eyebrow eyebrow-dark">Devis par statut</p>
            <canvas id="chart-devis-statut"></canvas>
        </div>
        <div class="chart-card">
            <p class="eyebrow eyebrow-dark">Devis reçus (6 derniers mois)</p>
            <canvas id="chart-devis-mois"></canvas>
        </div>
        <div class="chart-card" style="grid-column: 1 / -1;">
            <p class="eyebrow eyebrow-dark">Visites du site (14 derniers jours)</p>
            <canvas id="chart-visites"></canvas>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <script>
        const devisParStatut = @json($devisParStatut);
        const labelsMois = @json($labelsMois);
        const devisParMois = @json($devisParMois);
        const labelsVisites = @json($labelsVisites);
        const visitesParJour = @json($visitesParJour);

        new Chart(document.getElementById('chart-devis-statut'), {
            type: 'doughnut',
            data: {
                labels: ['Nouveau', 'En cours', 'Traité'],
                datasets: [{
                    data: [devisParStatut.nouveau, devisParStatut.en_cours, devisParStatut.traite],
                    backgroundColor: ['#E2711D', '#4A7FA5', '#6B7685'],
                }]
            },
            options: { plugins: { legend: { position: 'bottom' } } }
        });

        new Chart(document.getElementById('chart-devis-mois'), {
            type: 'bar',
            data: {
                labels: labelsMois,
                datasets: [{ label: 'Devis reçus', data: devisParMois, backgroundColor: '#E2711D' }]
            },
            options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
        });

        new Chart(document.getElementById('chart-visites'), {
            type: 'line',
            data: {
                labels: labelsVisites,
                datasets: [{ label: 'Visites', data: visitesParJour, borderColor: '#0F2438', backgroundColor: 'rgba(15,36,56,0.08)', fill: true, tension: 0.3 }]
            },
            options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
        });
    </script>
@endsection
