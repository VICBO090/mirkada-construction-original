<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion administrateur</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@500&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="login-page">
    <form method="POST" action="{{ route('admin.login.submit') }}" class="login-box">
        @csrf
        <p class="admin-logo">MIRKADA <span>ADMIN</span></p>
        @if ($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif
        <label>E-mail
            <input type="email" name="email" value="{{ old('email') }}" required autofocus>
        </label>
        <label>Mot de passe
            <input type="password" name="password" required>
        </label>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</body>
</html>
