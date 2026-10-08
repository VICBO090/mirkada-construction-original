@extends('layouts.app')

@section('title', 'Demander un devis')

@section('content')

    <section class="hero hero-small">
        <div class="container">
            <p class="eyebrow">Estimation rapide</p>
            <h1>Calculateur de devis</h1>
            <p class="hero-sub">Cette estimation est approximative. Pour un devis précis, notre bureau d'étude analysera votre projet en détail après votre demande.</p>
        </div>
        <div class="dim-line"><span>DEVIS</span></div>
    </section>

    <section class="section-alt">
        <div class="container">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="calc-grid">

                <div class="calc-form">
                    <p class="eyebrow eyebrow-dark">Étape 1 — Estimation</p>
                    <label>Type de service
                        <select id="calc-service">
                            <option value="">— Choisir un service —</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->titre }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label>Niveau de finition
                        <select id="calc-niveau" disabled>
                            <option value="">— Choisissez d'abord un service —</option>
                        </select>
                    </label>
                    <label>Superficie approximative (m²)
                        <input type="number" id="calc-superficie" min="1" placeholder="ex: 120">
                    </label>

                    <div class="calc-result" id="calc-result">
                        <span class="eyebrow">Estimation</span>
                        <p id="calc-result-text">Renseignez les champs ci-dessus pour voir une estimation.</p>
                    </div>
                </div>

                <div class="calc-form">
                    <p class="eyebrow eyebrow-dark">Étape 2 — Vos coordonnées</p>
                    <form method="POST" action="{{ route('devis.store') }}" class="admin-form" style="max-width:none;">
                        @csrf
                        <input type="hidden" name="type_projet" id="input-type-projet">
                        <input type="hidden" name="budget_estimatif" id="input-budget-estimatif">

                        <label>Nom complet
                            <input type="text" name="nom" value="{{ old('nom') }}" required>
                        </label>
                        <label>Téléphone
                            <input type="text" name="telephone" value="{{ old('telephone') }}" required>
                        </label>
                        <label>E-mail
                            <input type="email" name="email" value="{{ old('email') }}">
                        </label>
                        <label>Décrivez votre projet
                            <textarea name="description" rows="4" required>{{ old('description') }}</textarea>
                        </label>
                        <button type="submit" class="btn btn-primary">Envoyer ma demande de devis</button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <script>
        const tarifs = @json($tarifs);
        const services = @json($services->keyBy('id'));

        const serviceSelect = document.getElementById('calc-service');
        const niveauSelect = document.getElementById('calc-niveau');
        const superficieInput = document.getElementById('calc-superficie');
        const resultText = document.getElementById('calc-result-text');
        const inputTypeProjet = document.getElementById('input-type-projet');
        const inputBudget = document.getElementById('input-budget-estimatif');

        function tarifsForService(serviceId) {
            return tarifs.filter(t => String(t.service_id) === String(serviceId));
        }

        serviceSelect.addEventListener('change', () => {
            const options = tarifsForService(serviceSelect.value);
            niveauSelect.innerHTML = '';

            if (options.length === 0) {
                niveauSelect.disabled = true;
                niveauSelect.innerHTML = '<option value="">Aucun tarif disponible pour ce service</option>';
            } else {
                niveauSelect.disabled = false;
                niveauSelect.innerHTML = '<option value="">— Choisir un niveau —</option>' +
                    options.map(t => `<option value="${t.id}">${t.categorie} (${t.prix} $/${t.unite || 'unité'})</option>`).join('');
            }

            updateEstimate();
        });

        [niveauSelect, superficieInput].forEach(el => el.addEventListener('input', updateEstimate));

        function updateEstimate() {
            const tarif = tarifs.find(t => String(t.id) === String(niveauSelect.value));
            const superficie = parseFloat(superficieInput.value);

            if (!tarif || !superficie || superficie <= 0) {
                resultText.textContent = 'Renseignez les champs ci-dessus pour voir une estimation.';
                inputBudget.value = '';
                inputTypeProjet.value = '';
                return;
            }

            const total = tarif.prix * superficie;
            const min = Math.round(total * 0.9);
            const max = Math.round(total * 1.1);

            resultText.textContent = `Entre ${min.toLocaleString('fr-FR')} $ et ${max.toLocaleString('fr-FR')} $ (approximatif)`;

            const service = services[serviceSelect.value];
            inputTypeProjet.value = service ? service.titre : '';
            inputBudget.value = `Estimation calculateur : ${tarif.categorie}, ${superficie} m² à ${tarif.prix} $/${tarif.unite || 'unité'} ≈ entre ${min} $ et ${max} $`;
        }
    </script>

@endsection