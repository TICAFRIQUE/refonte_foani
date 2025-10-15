{{-- filepath: resources/views/frontend/pages/dashboard_client/commande_detail.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Détail commande')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center" style="color:#2a6b2a;">Détail de la commande</h2>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="bg-white p-4 rounded shadow-sm mb-4">
                <h5 class="fw-bold mb-3">Informations commande</h5>
                <ul class="list-unstyled mb-3">
                    <li><strong>Code :</strong> {{ $commande->code }}</li>
                    <li><strong>Date :</strong> {{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y H:i') }}</li>
                    <li><strong>Statut :</strong>
                        <span class="badge 
                            @if($commande->statut == 'en_attente') bg-warning
                            @elseif($commande->statut == 'validee') bg-success
                            @elseif($commande->statut == 'annulee') bg-danger
                            @else bg-secondary @endif">
                            {{ ucfirst($commande->statut) }}
                        </span>
                    </li>
                    <li><strong>Nom :</strong> {{ $commande->nom }}</li>
                    <li><strong>Téléphone :</strong> {{ $commande->telephone }}</li>
                    <li><strong>Adresse :</strong> {{ $commande->adresse }}</li>
                    <li><strong>Commune :</strong> {{ $commande->commune }}</li>
                    <li><strong>Ville :</strong> {{ $commande->ville }}</li>
                </ul>
            </div>
            <div class="bg-white p-4 rounded shadow-sm">
                <h5 class="fw-bold mb-3">Produits commandés</h5>
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
                            @foreach($commande->produits as $produit)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $produit->libelle }}</span>
                                    </td>
                                    <td class="text-center">{{ $produit->pivot->quantite }}</td>
                                    <td class="text-center">{{ number_format($produit->pivot->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                                    <td class="text-center fw-bold">
                                        {{ number_format($produit->pivot->prix_unitaire * $produit->pivot->quantite, 0, ',', ' ') }} FCFA
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Sous-total :</td>
                                <td class="text-center fw-bold">{{ number_format($commande->sous_total, 0, ',', ' ') }} FCFA</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Frais de livraison :</td>
                                <td class="text-center fw-bold">{{ number_format($commande->frais_livraison, 0, ',', ' ') }} FCFA</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total :</td>
                                <td class="text-center fw-bold" style="font-size:1.2em;">
                                    {{ number_format($commande->total, 0, ',', ' ') }} FCFA
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