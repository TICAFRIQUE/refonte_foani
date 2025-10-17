@extends('backend.layouts.master')

@section('title', 'Détails du message')

@section('content')
    <div class="container-fluid">
        <h4>Détails du message de {{ $contact->nom_prenoms }}</h4>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Téléphone:</strong> {{ $contact->telephone }}</p>
        <p><strong>Objet:</strong> {{ $contact->objet ?? '-' }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $contact->message }}</p>
        <a href="{{ route('contact.index') }}" class="btn btn-primary">Retour à la liste</a>
    </div>
@endsection
