@extends('layouts.admin')

@section('title', 'Message de '.$message->nom)

@section('content')
    <h1>Message de {{ $message->nom }}</h1>
    <div class="admin-form">
        <p><strong>E-mail :</strong> {{ $message->email }}</p>
        @if($message->telephone)
            <p><strong>Téléphone :</strong> {{ $message->telephone }}</p>
        @endif
        @if($message->sujet)
            <p><strong>Sujet :</strong> {{ $message->sujet }}</p>
        @endif
        <p><strong>Reçu le :</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>
        <hr>
        <p>{{ $message->message }}</p>
        <div class="hero-actions" style="margin-top:20px;">
            <a href="mailto:{{ $message->email }}" class="btn btn-primary">Répondre par e-mail</a>
            @if($message->telephone)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->telephone) }}" target="_blank" class="btn btn-primary">Répondre sur WhatsApp</a>
            @endif
        </div>
    </div>
    <p style="margin-top:20px;"><a href="{{ route('admin.messages.index') }}">← Retour aux messages</a></p>
@endsection