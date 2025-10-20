{{-- filepath: c:\laragon\www\foani\resources\views\backend\pages\rapports\vente.blade.php --}}
@extends('backend.layouts.master')

@section('title', 'Rapport financier - Produits vendus')

@section('content')
    <div class="container-fluid py-4">
        <h2 class="mb-4 fw-bold">Rapport financier : Produits vendus</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form method="GET" action="{{ route('rapports.vente') }}" class="row g-3 align-items-end mb-4 justify-content-center">
                    <div class="col-md-4">
                        <label for="date_debut" class="form-label">Date début</label>
                        <input type="date" id="date_debut" name="date_debut" class="form-control" value="{{ $date_debut }}">
                    </div>
                    <div class="col-md-4">
                        <label for="date_fin" class="form-label">Date fin</label>
                        <input type="date" id="date_fin" name="date_fin" class="form-control" value="{{ $date_fin }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-search"></i> Filtrer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Affichage des filtres actifs --}}
        @if ($date_debut || $date_fin)
            <div class="alert alert-info mb-4 text-center">
                <strong>Filtres appliqués :</strong>
                @if ($date_debut)
                    <span class="me-3"><i class="bi bi-calendar"></i> Du
                        <strong>{{ \Carbon\Carbon::parse($date_debut)->format('d/m/Y') }}</strong></span>
                @endif
                @if ($date_fin)
                    <span><i class="bi bi-calendar"></i> Au
                        <strong>{{ \Carbon\Carbon::parse($date_fin)->format('d/m/Y') }}</strong></span>
                @endif
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">
                Détail des produits vendus
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Produit</th>
                                <th>Quantité vendue</th>
                                <th>Total vendu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produits as $id => $prod)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $prod['libelle'] }}</td>
                                    <td>{{ $prod['quantite'] }}</td>
                                    <td>{{ number_format($prod['total'], 0, ',', ' ') }} FCFA</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Aucun produit vendu sur cette période.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold bg-light">
                                <td colspan="3" class="text-end">Chiffre d'affaires total</td>
                                <td>
                                    {{ number_format(array_sum(array_column($produits, 'total')), 0, ',', ' ') }} FCFA
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
