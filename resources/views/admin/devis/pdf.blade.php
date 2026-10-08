<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #17212C; font-size: 13px; }
        .header { background: #0F2438; color: #fff; padding: 20px 30px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header p { margin: 4px 0 0; color: #E2711D; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; }
        .body { padding: 24px 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        td { padding: 8px 0; border-bottom: 1px solid #E4DFD3; vertical-align: top; }
        td.label { width: 160px; color: #6B7685; font-weight: bold; }
        .desc { margin-top: 20px; padding: 14px; background: #F3EFE7; border-left: 3px solid #E2711D; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Récapitulatif de demande de devis</h1>
        <p>Mirkada Construction — N°{{ $devis->id }}</p>
    </div>
    <div class="body">
        <table>
            <tr><td class="label">Nom du client</td><td>{{ $devis->nom }}</td></tr>
            <tr><td class="label">Téléphone</td><td>{{ $devis->telephone }}</td></tr>
            <tr><td class="label">E-mail</td><td>{{ $devis->email ?? '—' }}</td></tr>
            <tr><td class="label">Type de projet</td><td>{{ $devis->type_projet }}</td></tr>
            <tr><td class="label">Estimation</td><td>{{ $devis->budget_estimatif ?? '—' }}</td></tr>
            <tr><td class="label">Date de la demande</td><td>{{ $devis->created_at->format('d/m/Y H:i') }}</td></tr>
            <tr><td class="label">Statut</td><td>{{ ucfirst(str_replace('_', ' ', $devis->statut)) }}</td></tr>
        </table>
        <div class="desc">
            <strong>Description du projet :</strong><br>
            {{ $devis->description }}
        </div>
    </div>
</body>
</html>
