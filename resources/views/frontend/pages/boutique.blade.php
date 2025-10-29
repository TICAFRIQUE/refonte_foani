{{-- filepath: c:\laragon\www\foani\resources\views\frontend\pages\boutique.blade.php --}}
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
            transition: transform 0.4s cubic-bezier(.25, .8, .25, 1), box-shadow 0.3s;
        }

        .card:hover .card-img-top {
            transform: scale(1.08);
            box-shadow: 0 8px 24px rgba(42, 107, 42, 0.15);
            z-index: 2;
        }

        /* Cards des catégories */
        .category-filter-card {
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            border: 1px solid rgba(42, 107, 42, 0.1);
            border-radius: 15px;
            padding: 15px 20px;
            text-decoration: none;
            color: #2a6b2a;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 
                0 4px 15px rgba(0, 0, 0, 0.08),
                0 2px 8px rgba(42, 107, 42, 0.05);
            position: relative;
            overflow: hidden;
            display: block;
            text-align: center;
        }

        .category-filter-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.4), 
                transparent
            );
            transition: left 0.5s ease;
        }

        .category-filter-card:hover::before {
            left: 100%;
        }

        .category-filter-card:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 8px 25px rgba(0, 0, 0, 0.12),
                0 4px 15px rgba(42, 107, 42, 0.1);
            border-color: rgba(42, 107, 42, 0.2);
            color: #2a6b2a;
        }

        .category-filter-card.active {
            background: linear-gradient(145deg, #2a6b2a, #236b23);
            color: white;
            border-color: #2a6b2a;
            box-shadow: 
                0 6px 20px rgba(42, 107, 42, 0.3),
                0 3px 12px rgba(42, 107, 42, 0.2);
        }

        .category-filter-card.active:hover {
            background: linear-gradient(145deg, #236b23, #1e5a1e);
            color: white;
        }

        .categories-container {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }

        .categories-scroll {
            max-height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 10px;
        }

        .categories-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .categories-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .categories-scroll::-webkit-scrollbar-thumb {
            background: #2a6b2a;
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .categories-container {
                padding: 15px;
                margin-bottom: 20px;
            }

            .category-filter-card {
                padding: 12px 16px;
                font-size: 0.9rem;
            }
        }

        /* Barre de recherche */
        .search-form .form-control {
            border: 2px solid #e9ecef;
            border-radius: 25px 0 0 25px;
            padding: 12px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-form .form-control:focus {
            border-color: #2a6b2a;
            box-shadow: 0 0 0 0.2rem rgba(42, 107, 42, 0.25);
            outline: none;
        }

        .search-btn {
            border-radius: 0 25px 25px 0;
            padding: 12px 20px;
            border: 2px solid #2a6b2a;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background-color: #1e5a1e;
            border-color: #1e5a1e;
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .search-form .form-control,
            .search-btn {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
        }
    </style>

    <div class="container py-5">
        <h2 class="fw-bold mb-4 text-center title">Nos produits</h2>
        
        {{-- Barre de recherche --}}
        <div class="mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <form method="GET" action="{{ route('boutique.index') }}" class="search-form" id="search-form">
                        <div class="input-group shadow-sm">
                            <input type="text" name="recherche" class="form-control search-input" 
                                   placeholder="Rechercher un produit..." 
                                   value="{{ $recherche ?? '' }}">
                            @if(isset($categorie))
                                <input type="hidden" name="categorie" value="{{ $categorie->slug }}">
                            @endif
                            <button class="btn btn-success search-btn" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @if($recherche)
                <div class="text-center mt-3">
                    <span class="badge bg-light text-dark fs-6">
                        Résultats pour : <strong>"{{ $recherche }}"</strong>
                        <a href="{{ isset($categorie) ? route('boutique.categorie', $categorie->slug) : route('boutique.index') }}" 
                           class="text-danger ms-2">
                            <i class="bi bi-x"></i>
                        </a>
                    </span>
                </div>
            @endif
        </div>

        {{-- Catégories en cards avec box-shadow --}}
        <div class="mb-5">
            <div class="categories-container">
                <h5 class="fw-bold text-center mb-3" style="color: #2a6b2a;">
                    <i class="bi bi-grid-3x3-gap me-2"></i>Filtrer par catégorie
                </h5>
                <div class="categories-scroll">
                    <div class="row g-3">
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{ route('boutique.index') }}"
                                class="category-filter-card category-link {{ !isset($categorie) ? 'active' : '' }}">
                                <i class="bi bi-grid-fill d-block mb-2 fs-5"></i>
                                Toutes les catégories
                            </a>
                        </div>
                        @foreach (\App\Models\Categorie::all() as $cat)
                            <div class="col-6 col-md-4 col-lg-3">
                                <a href="{{ route('boutique.categorie', ['slug' => $cat->slug]) }}"
                                    class="category-filter-card category-link {{ isset($categorie) && $categorie->slug == $cat->slug ? 'active' : '' }}">
                                    <i class="bi bi-tag-fill d-block mb-2 fs-5"></i>
                                    {{ $cat->libelle }}
                                    <small class="d-block mt-1 opacity-75">
                                        {{ $cat->produits()->count() }} produit(s)
                                    </small>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Afficher la categorie choisie --}}
        @if (isset($categorie))
            <div class="mb-4 text-center">
                <h4 class="fw-semibold">Catégorie : {{ $categorie->libelle }}</h4>
            </div>
        @endif

        {{-- Section des produits (point d'ancrage pour le scroll) --}}
        <div id="produits-section">
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
                                    <a href="{{ route('reservation.create', ['slug' => $produit->slug]) }}"
                                        class="btn btn-warning w-100 mt-auto">
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
        </div>

        {{-- Pagination --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $produits->withQueryString()->links() }}
        </div>
    </div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Fonction pour scroller vers les produits
    function scrollToProduits() {
        setTimeout(function() {
            $('html, body').animate({
                scrollTop: $('#produits-section').offset().top - 150
            }, 100, 'easeInOutCubic');
        }, 100);
    }

    // Auto-scroll vers les produits après sélection d'une catégorie
    $('.category-link').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        
        // Ajouter un paramètre pour indiquer qu'on doit scroller
        if (href.indexOf('?') > -1) {
            window.location.href = href + '&scroll=true';
        } else {
            window.location.href = href + '?scroll=true';
        }
    });

    // Auto-scroll vers les produits après recherche
    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        const action = $(this).attr('action');
        
        // Ajouter le paramètre scroll à la requête
        const url = action + '?' + formData + '&scroll=true';
        window.location.href = url;
    });

    // Vérifier si on doit scroller au chargement de la page
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('scroll') === 'true') {
        scrollToProduits();
        
        // Nettoyer l'URL après le scroll
        const url = new URL(window.location);
        url.searchParams.delete('scroll');
        window.history.replaceState({}, document.title, url.toString());
    }

    // Ajouter l'easing personnalisé
    $.easing.easeInOutCubic = function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t*t + b;
        return c/2*((t-=2)*t*t + 2) + b;
    };
});
</script>
@endpush