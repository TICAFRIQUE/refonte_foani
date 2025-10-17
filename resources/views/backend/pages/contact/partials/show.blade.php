@extends('backend.layouts.master')

@section('title', 'Détails du message')

@section('css')
    <style>
        /* Effet "feuille de papier" */
        .paper {
            background: #fffdfa;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            font-family: 'Georgia', serif;
            line-height: 1.8;
            max-width: 800px;
            margin: 50px auto;
        }

        /* Lignes horizontales comme un carnet */
        .paper::before {
            content: "";
            position: absolute;
            top: 0;
            left: 40px;
            right: 0;
            bottom: 0;
            background-image: repeating-linear-gradient(#f5f2e9 0px, #f5f2e9 23px, #e8e4d8 24px);
            z-index: 0;
        }

        /* Ligne rouge à gauche (effet cahier) */
        .paper::after {
            content: "";
            position: absolute;
            top: 0;
            left: 35px;
            bottom: 0;
            width: 2px;
            background-color: #e74c3c;
            z-index: 1;
        }

        /* Contenu du texte */
        .paper-content {
            position: relative;
            z-index: 2;
            background: transparent;
            text-align: center;

        }

        .paper-content h4 {
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .paper-content p {
            margin-bottom: 14px;
            color: #444;
            text-align: justify;
            text-justify: inter-word;
             font-size: 18px;
            margin-left: auto;
            margin-right: auto;
            max-width: 700px;
        }

        .paper-content strong {
            color: #2c3e50;
        }




    </style>
@endsection

@section('content')
@component('backend.components.breadcrumb')
        @slot('li_1')
            Liste
        @endslot
        @slot('title')
            Contacts
        @endslot
    @endcomponent
    <div class="container-fluid">
        <div class="paper">
            <div class="paper-content">
                <h4>Détails du message de {{ $contact->nom_prenoms }}</h4>
                <p><strong>Email :</strong> {{ $contact->email }}</p>
                <p><strong>Téléphone :</strong> {{ $contact->telephone }}</p>
                <p><strong>Objet :</strong> {{ $contact->objet ?? '-' }}</p>
                <p><strong>Message :</strong></p>
                <p>{{ $contact->message }}</p>

            </div>
        </div>
    </div>
@endsection
