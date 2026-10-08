<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color:#17212C;">
    <h2>Bonjour {{ $rendezVous->nom }},</h2>

    @if($rendezVous->statut === 'confirme')
        <p>Votre rendez-vous avec <strong>Mirkada Construction</strong> est confirmé :</p>
    @else
        <p>Nous avons bien reçu votre demande de rendez-vous avec <strong>Mirkada Construction</strong>. Nous la confirmerons rapidement :</p>
    @endif

    <ul>
        <li><strong>Date souhaitée :</strong> {{ \Carbon\Carbon::parse($rendezVous->date_souhaitee)->format('d/m/Y') }}</li>
        <li><strong>Heure :</strong> {{ \Carbon\Carbon::parse($rendezVous->heure_souhaitee)->format('H:i') }}</li>
        @if($rendezVous->sujet)
            <li><strong>Sujet :</strong> {{ $rendezVous->sujet }}</li>
        @endif
    </ul>

    <p>Pour toute question, contactez-nous directement.</p>
    <p>— L'équipe Mirkada Construction</p>
</body>
</html>