{{-- filepath: resources/views/frontend/pages/boutique.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Boutique')

@section('content')


    <style>
        .pagination {
            justify-content: center;
            margin-top: 2rem;
        }

        .pagination .page-item .page-link {
            color: #2a6b2a;
            border-radius: 50px !important;
            margin: 0 3px;
            border: 1px solid #2a6b2a22;
            font-weight: 500;
            transition: background 0.2s, color 0.2s;
        }

        .pagination .page-item.active .page-link {
            background: #2a6b2a;
            color: #fff;
            border-color: #2a6b2a;
        }

        .pagination .page-item.disabled .page-link {
            color: #ccc;
            background: #f8f9fa;
        }

        .card-img-top {
            transition: transform 0.4s cubic-bezier(.25,.8,.25,1), box-shadow 0.3s;
        }

        .card:hover .card-img-top {
            transform: scale(1.08);
            box-shadow: 0 8px 24px rgba(42,107,42,0.15);
            z-index: 2;
        }
    </style>
    <div class="container py-5">
        <h2 class="fw-bold mb-4 text-center" style="color:#2a6b2a;">Nos produits</h2>

        {{-- Catégories scrollables --}}
        <div class="mb-4">
            <div class="d-flex flex-row overflow-auto gap-2 pb-2" style="white-space:nowrap;">
                <a href="{{ route('boutique.index') }}"
                    class="btn btn-outline-success px-4 {{ !isset($categorie) ? 'active' : '' }}">
                    Toutes les catégories
                </a>
                @foreach (\App\Models\Categorie::all() as $cat)
                    <a href="{{ route('boutique.categorie', ['slug' => $cat->slug]) }}"
                       class="btn btn-outline-success px-4 {{ (isset($categorie) && $categorie->slug == $cat->slug) ? 'active' : '' }}">
                        {{ $cat->libelle }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Liste des produits --}}
        <div class="row g-4">
            @forelse($produits as $produit)
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm position-relative">
                        {{-- Badge en haut à droite --}}
                        @if ($produit->stock > 0)
                            <span class="badge bg-success position-absolute top-0 end-0 m-2">En stock</span>
                        @else
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">Rupture</span>
                        @endif
                        <img src="{{ $produit->getFirstMediaUrl('image_principale') ?: asset('front/images/produits/poulet.png') }}"
                            class="card-img-top" alt="{{ $produit->libelle }}" style="height:180px;object-fit:cover;">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $produit->libelle }}</h5>
                            <div class="mb-2 text-muted small">{{ $produit->categorie->libelle ?? '' }}</div>
                            <p class="card-text fw-bold" style="color:#2a6b2a;">
                                {{ number_format($produit->prix_de_vente, 0, ',', ' ') }} FCFA
                            </p>
                            @if ($produit->stock > 0)
                                <button class="btn btn-add w-100 btn-ajouter-panier mt-auto" data-id="{{ $produit->id }}">
                                    <i class="bi bi-cart-plus me-2"></i>Ajouter
                                </button>
                            @else
                                <a href="{{route('reservation.create' , ['slug'=>$produit->slug])}}" class="btn btn-warning w-100 mt-auto">
                                    <i class="bi bi-clock me-2"></i>Réserver
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">Aucun produit trouvé.</div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $produits->withQueryString()->links() }}
        </div>
    </div>

@endsection
