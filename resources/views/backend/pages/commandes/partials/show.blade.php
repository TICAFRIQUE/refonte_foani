@extends('backend.layouts.master')

@section('title', 'Détails de la commande')

@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Formulaire et select */
        .statut-select:focus {
            box-shadow: 0 0 0 0.2rem #0d6efd40;
            border-color: #0d6efd;
        }

        .statut-select:hover {
            box-shadow: 0 0 0 0.2rem #0d6efd40;
            border-color: #0d6efd;
            cursor: pointer;
        }

        /* Table des produits */
        #produits-table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        #produits-table tbody tr:hover {
            background-color: #e9f5ff;
        }

        /* Card */
        .card-shadow {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Commandes
        @endslot
        @slot('title')
            Détails de la commande #{{ $commande->code }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-shadow mb-4">
                <div class="card-body">
                    <div class="row g-4">
                        {{-- Infos client --}}
                        <div class="col-md-6">
                            <h5 class="fw-bold">Informations client</h5>
                            <p><strong>Client :</strong> {{ $commande->user->username ?? 'Inconnu' }}</p>
                            <p><strong>Téléphone :</strong> {{ $commande->telephone ?? '—' }}</p>
                            <p><strong>Date :</strong> {{ $commande->created_at?->format('d/m/Y H:i') ?? '—' }}</p>
                            <p><strong>Date de livraison :</strong> {{ $commande->date_livraison ?->format('d/m/Y à H:i') ?? '—' }}</p>
                        </div>

                        {{-- Statut et totaux --}}
                        <div class="col-md-6">
                        
                            <form action="{{ route('commandes.update', $commande->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Statut :</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-arrow-repeat text-primary"></i>
                                        </span>
                                        <select name="statut"
                                            class="form-select fw-bold border-primary shadow-sm statut-select"
                                            title="Cliquez pour changer le statut" onchange="this.form.submit()">
                                            <option value="en_attente" @selected($commande->statut == 'en_attente')>🕒 En attente</option>
                                            <option value="en_cours" @selected($commande->statut == 'en_cours')>🚚 En cours</option>
                                            <option value="livrée" @selected($commande->statut == 'livrée')>✅ Livrée</option>
                                            <option value="annulée" @selected($commande->statut == 'annulée')>❌ Annulée</option>
                                        </select>
                                    </div>
                                </div>

                                <p class="mt-3"><strong>Sous-total :</strong>
                                    <span class="badge bg-primary fs-6">
                                        {{ number_format($commande->sous_total, 0, ',', ' ') }} Fcfa
                                    </span>
                                </p>
                                <p><strong>Frais de livraison :</strong>
                                    <span class="badge bg-warning text-dark fs-6">
                                        {{ number_format($commande->frais_livraison, 0, ',', ' ') }} Fcfa
                                    </span>
                                </p>
                                <p><strong>Total :</strong>
                                    <span class="badge bg-success fs-6">
                                        {{ number_format($commande->total, 0, ',', ' ') }} Fcfa
                                    </span>
                                </p>
                            </form>
                        </div>
                    </div>

                    <hr>

                    {{-- Table des produits --}}
                    <h5 class="fw-bold mb-3">Produits commandés</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="produits-table">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix unitaire</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($commande->produits as $index => $produit)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $produit->libelle }}</td>
                                        <td>{{ $produit->pivot->quantite }}</td>
                                        <td>{{ number_format($produit->pivot->prix_unitaire, 0, ',', ' ') }} Fcfa</td>
                                        <td>{{ number_format($produit->pivot->total, 0, ',', ' ') }} Fcfa</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Aucun produit associé.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#produits-table').DataTable({
                responsive: true,
                paging: false,
                searching: false,
                info: false,
                ordering: false
            });
        });
    </script>
@endsection
