{{-- filepath: c:\laragon\www\foani\resources\views\frontend\pages\points_de_vente.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Points de vente - ' . $categorie->libelle)


@push('styles')
    <style>
        /* === LISTE DE POINTS DE VENTE === */
.card.shadow-sm.border-0 {
    border-radius: 0.75rem;
}

/* Cartes mobiles */
@media (max-width: 767.98px) {
    .card-body h6 {
        font-size: 1rem;
    }
    .card-body p {
        font-size: 0.9rem;
        line-height: 1.4;
    }
    .card.mb-3 {
        border-left: 4px solid #2a6b2a;
    }
}

    </style>
@endpush
@section('content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold mb-2" style="color:#2a6b2a;">
                    Points de vente : {{ $categorie->libelle }}
                </h2>
                <p class="text-muted mb-0">
                    Retrouvez nos produits dans nos points de vente
                    <strong>{{ $categorie->libelle }}</strong>
                </p>
            </div>
        </div>
        @if ($points_de_vente->count() > 0)
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-0">

                            <!-- Table affichée sur écran moyen et grand -->
                            <div class="table-responsive d-none d-md-block">
                                <table class="table table-hover mb-0 align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0">
                                                <i class="bi bi-shop me-1"></i> Ville/Commune
                                            </th>
                                            <th scope="col" class="border-0">
                                                <i class="bi bi-geo-alt me-1"></i> Adresse
                                            </th>
                                            <th scope="col" class="border-0">
                                                <i class="bi bi-telephone me-1"></i> Contact
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($points_de_vente as $point)
                                            <tr>
                                                <td class="fw-bold">{{ $point->commune->libelle ?? $point->ville->libelle }}</td>
                                                <td>{{ $point->quartier ?? '-' }}</td>
                                                <td>{{ $point->contact ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Cartes affichées uniquement sur mobile -->
                            <div class="d-block d-md-none p-3">
                                @foreach ($points_de_vente as $point)
                                    <div class="card mb-3 border-0 shadow-sm">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-2 text-success">
                                                <i class="bi bi-shop me-1"></i> {{ $point->commune->libelle ?? '-' }}
                                            </h6>
                                            <p class="mb-1 text-muted">
                                                <i class="bi bi-geo-alt me-1 text-danger"></i>
                                                {{ $point->quartier ?? '-' }}
                                            </p>
                                            <p class="mb-0">
                                                <i class="bi bi-telephone me-1 text-primary"></i>
                                                {{ $point->contact ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="bi bi-info-circle fs-2 mb-3"></i>
                        <h5>Aucun point de vente trouvé dans cette catégorie</h5>
                        <p class="mb-0">Nous ajoutons régulièrement de nouveaux points de vente, revenez bientôt !</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="row mt-5">
            <div class="col-12">
                <div class="card bg-light border-0">
                    <div class="card-body text-center">
                        <h5 class="fw-bold" style="color:#2a6b2a;">Vous ne trouvez pas de point de vente près de chez vous ?
                        </h5>
                        <p class="text-muted">Contactez-nous pour connaître les prochaines ouvertures dans votre région.</p>
                        <a href="{{ route('contact') }}" class="btn btn-success">
                            <i class="bi bi-envelope me-2"></i>Nous contacter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
            transition: all 0.3s ease;
        }

        .btn-group .btn {
            transition: all 0.3s ease;
        }

        .btn-group .btn:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 767px) {
            .table-responsive {
                font-size: 0.9rem;
            }
        }
    </style>
@endpush
