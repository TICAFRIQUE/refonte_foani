{{-- filepath: c:\laragon\www\foani\resources\views\frontend\pages\boutique.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Boutique Foani | ' . ($categorie->libelle ?? 'Tous les produits'))
@section('meta_description', 'Achetez en ligne vos volailles et œufs frais chez Foani. Large choix de produits de
    qualité premium, livraison rapide en Côte d\'Ivoire. Commandez maintenant!')
@section('meta_keywords', 'boutique en ligne volaille, acheter œufs frais, commande volaille Côte d\'Ivoire, livraison
    poulets, e-commerce aviculture')

@section('og_title', 'Boutique Foani - Commandez Volaille & Œufs Frais en Ligne')
@section('og_description', 'Commandez facilement vos volailles et œufs frais sur la boutique en ligne Foani. Produits de
    qualité, livraison rapide en Côte d\'Ivoire.')
@section('og_type', 'product.group')

@section('content')
    <style>
        /* Bannière de catégorie */
        .category-banner {
            height: 300px;
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .category-banner-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .category-banner:hover .category-banner-img {
            transform: scale(1.05);
        }

        .category-banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, 
                rgba(42, 107, 42, 0.8), 
                rgba(247, 201, 72, 0.6)
            );
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .category-banner-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            margin-bottom: 10px;
        }

        .category-banner-content p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            margin: 0;
        }

        .category-banner-breadcrumb {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.9);
            padding: 8px 15px;
            border-radius: 25px;
            backdrop-filter: blur(10px);
        }

        .category-banner-breadcrumb a {
            color: #2a6b2a;
            text-decoration: none;
            font-weight: 500;
        }

        .category-banner-breadcrumb .separator {
            color: #6c757d;
            margin: 0 8px;
        }

        .category-banner-breadcrumb .current {
            color: #333;
            font-weight: 600;
        }

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

        /* Cards des produits avec taille uniforme */
        .product-card {
            height: 100%;
            min-height: 380px;
            border: none;
            border-radius: 15px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(42, 107, 42, 0.15);
        }

        .product-image-container {
            height: 200px;
            position: relative;
            overflow: hidden;
            background: #f8f9fa;
        }

        .product-card .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s cubic-bezier(.25, .8, .25, 1);
        }

        .product-card:hover .card-img-top {
            transform: scale(1.1);
        }

        .product-card .card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 180px;
        }

        .product-card .card-title {
            font-size: 1rem;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 10px;
            min-height: 2.6rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            color: #333;
        }

        .product-card .card-text {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--color-vert) !important;
        }

        .product-card .btn {
            margin-top: auto;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .product-card .btn-add {
            background: linear-gradient(135deg, var(--color-vert), #4CAF50);
            border: none;
            color: white;
        }

        .product-card .btn-add:hover {
            background: linear-gradient(135deg, #4CAF50, var(--color-vert));
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(42, 107, 42, 0.3);
        }

        .product-card .btn-warning {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            border: none;
            color: #333;
        }

        .product-card .btn-warning:hover {
            background: linear-gradient(135deg, #ffb300, #ffa000);
            transform: translateY(-2px);
        }

        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 2;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
                    transparent);
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

        /* Responsive */
        @media (max-width: 768px) {
            .category-banner {
                height: 200px;
                margin-bottom: 20px;
            }

            .category-banner-content h1 {
                font-size: 1.8rem;
            }

            .category-banner-content p {
                font-size: 1rem;
            }

            .category-banner-breadcrumb {
                top: 15px;
                left: 15px;
                padding: 6px 12px;
                font-size: 0.9rem;
            }

            .categories-container {
                padding: 15px;
                margin-bottom: 20px;
            }

            .category-filter-card {
                padding: 12px 16px;
                font-size: 0.9rem;
            }

            .search-form .form-control,
            .search-btn {
                padding: 10px 15px;
                font-size: 0.9rem;
            }

            .product-card {
                min-height: 320px;
            }

            .product-image-container {
                height: 160px;
            }

            .product-card .card-body {
                padding: 15px;
                min-height: 160px;
            }

            .product-card .card-title {
                font-size: 0.9rem;
                min-height: 2.4rem;
            }

            .product-card .card-text {
                font-size: 1rem;
                margin-bottom: 10px;
            }

            .product-card .btn {
                padding: 8px 12px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .product-card {
                min-height: 300px;
            }

            .product-image-container {
                height: 140px;
            }

            .product-card .card-body {
                min-height: 160px;
            }
        }
    </style>

    <div class="container ">
        {{-- Bannière de catégorie --}}
        @if (isset($categorie))
            <div class="category-banner">
                <img src="{{ $categorie->getFirstMediaUrl('image_banniere') ?: asset('front/images/logo.png') }}"
                    alt="{{ $categorie->libelle }}" class="category-banner-img">
                <div class="category-banner-overlay">
                    <div class="category-banner-content">
                        <h1>{{ $categorie->libelle }}</h1>
                        <p>{{ $categorie->produits()->count() }} produit(s) disponible(s)</p>
                    </div>
                </div>
                <div class="category-banner-breadcrumb">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="separator">></span>
                    <a href="{{ route('boutique.index') }}">Boutique</a>
                    <span class="separator">></span>
                    <span class="current">{{ $categorie->libelle }}</span>
                </div>
            </div>
        @else
            <div class="category-banner">
                <img src="{{ asset('front/images/logo.png') }}" alt="Tous les produits" class="category-banner-img">
                <div class="category-banner-overlay">
                    <div class="category-banner-content">
                        <h1>Tous nos produits</h1>
                        <p>Découvrez notre gamme complète de volailles et œufs frais</p>
                    </div>
                </div>
                <div class="category-banner-breadcrumb">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="separator">></span>
                    <span class="current">Boutique</span>
                </div>
            </div>
        @endif

        {{-- Titre dynamique --}}
        <h2 class="fw-bold mb-4 text-center title">
            @if (isset($categorie))
                {{ $categorie->libelle }}
            @else
                Nos produits
            @endif
        </h2>

        {{-- Barre de recherche --}}
        <div class="mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <form method="GET" action="{{ route('boutique.index') }}" class="search-form" id="search-form">
                        <div class="input-group shadow-sm">
                            <input type="text" name="recherche" class="form-control search-input"
                                placeholder="Rechercher un produit..." value="{{ $recherche ?? '' }}">
                            @if (isset($categorie))
                                <input type="hidden" name="categorie" value="{{ $categorie->slug }}">
                            @endif
                            <button class="btn btn-success search-btn" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @if ($recherche)
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

        {{-- Section des produits (point d'ancrage pour le scroll) --}}
        <div id="produits-section">
            <div class="row g-4">
                @forelse($produits as $produit)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card product-card shadow-sm position-relative h-100">
                            {{-- Badge en haut à droite --}}
                            @if ($produit->stock > 0)
                                <span class="product-badge badge bg-success">En stock</span>
                            @else
                                <span class="product-badge badge bg-danger">Rupture</span>
                            @endif
                            
                            {{-- Image avec container à hauteur fixe --}}
                            <div class="product-image-container">
                                <img src="{{ $produit->getFirstMediaUrl('image_principale') ?: asset('front/images/produits/poulet.png') }}"
                                    class="card-img-top" alt="{{ $produit->libelle }}">
                            </div>
                            
                            {{-- Corps de la card avec hauteur flexible --}}
                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title">{{ $produit->libelle }}</h5>
                                <p class="card-text fw-bold" style="color:var(--color-vert);">
                                    {{ number_format($produit->prix_de_vente, 0, ',', ' ') }} FCFA
                                </p>
                                @if ($produit->stock > 0)
                                    <button class="btn btn-add w-100 btn-ajouter-panier mt-auto" data-id="{{ $produit->id }}">
                                        <i class="bi bi-cart-plus me-2"></i>Ajouter
                                    </button>
                                @else
                                    <a href="{{ route('reservation.create', ['slug' => $produit->slug]) }}"
                                        class="btn btn-warning w-100 mt-auto">
                                        <i class="bi bi-clock me-2"></i>Réserver <small>( connexion requise )</small>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        <i class="bi bi-inbox fs-1 mb-3 d-block"></i>
                        <p>Aucun produit disponible dans cette catégorie.</p>
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
            $.easing.easeInOutCubic = function(x, t, b, c, d) {
                if ((t /= d / 2) < 1) return c / 2 * t * t * t + b;
                return c / 2 * ((t -= 2) * t * t + 2) + b;
            };
        });
    </script>
@endpush