{{-- filepath: resources/views/frontend/pages/dashboard_client/reservation_detail.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Détail réservation')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center" style="color:#2a6b2a;">Détail de la réservation</h2>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @include('frontend.components.message_session')
            <div class="bg-white p-4 rounded shadow-sm mb-4">
                <h5 class="fw-bold mb-3">Informations réservation</h5>
                <ul class="list-unstyled mb-3">
                    <li><strong>Code :</strong> {{ $reservation->code }}</li>
                    <li><strong>Date :</strong> {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y H:i') }}</li>
                    <li><strong>Statut :</strong>
                        <span class="badge 
                            @if($reservation->statut == 'en_attente') bg-warning
                            @elseif($reservation->statut == 'validee') bg-success
                            @elseif($reservation->statut == 'annulee') bg-danger
                            @else bg-secondary @endif">
                            {{ ucfirst($reservation->statut) }}
                        </span>
                    </li>
                    <li><strong>Nom :</strong> {{ $reservation->nom }}</li>
                    <li><strong>Téléphone :</strong> {{ $reservation->telephone }}</li>
                    <li><strong>Adresse :</strong> {{ $reservation->adresse }}</li>
                    <li><strong>Commune :</strong> {{ $reservation->commune }}</li>
                    <li><strong>Ville :</strong> {{ $reservation->ville }}</li>
                    <li><strong>Commentaire :</strong> {{ $reservation->commentaire }}</li>
                </ul>
            </div>
            <div class="bg-white p-4 rounded shadow-sm">
                <h5 class="fw-bold mb-3">Produit réservé</h5>
                <div class="table-responsive">
                    <table class="table align-middle table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Produit</th>
                                <th class="text-center">Quantité</th>
                                <th class="text-center">Prix Unitaire</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span class="fw-bold">{{ $reservation->produit->libelle ?? '-' }}</span>
                                </td>
                                <td class="text-center">{{ $reservation->quantite }}</td>
                                <td class="text-center">{{ number_format($reservation->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                                <td class="text-center fw-bold">
                                    {{ number_format($reservation->sous_total, 0, ',', ' ') }} FCFA
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Frais de livraison :</td>
                                <td class="text-center fw-bold">{{ number_format($reservation->frais_livraison, 0, ',', ' ') }} FCFA</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total à payer :</td>
                                <td class="text-center fw-bold" style="font-size:1.2em;">
                                    {{ number_format($reservation->total, 0, ',', ' ') }} FCFA
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection