{{-- filepath: c:\laragon\www\foani\resources\views\frontend\pages\points_de_vente.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Points de vente - ' . $categorie->libelle)

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
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0">
                                                <i class="bi bi-shop me-1"></i> Ville/Commune
                                            </th>
                                            <th scope="col" class="border-0">
                                                <i class="bi bi-geo-alt me-1"></i> Adresse
                                            </th>
                                            <th scope="col" class="border-0 d-none d-md-table-cell">
                                                <i class="bi bi-telephone me-1"></i> Contact
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($points_de_vente as $key => $point)
                                            <tr>
                                                <td class="fw-bold">
                                                    <div class="d-flex align-items-center">
                                                        <span>{{ $point->commune->libelle ?? '-' }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $point->quartier ?? '-' }}
                                                </td>
                                                <td class="d-none d-md-table-cell">
                                                    {{ $point->contact ?? '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
