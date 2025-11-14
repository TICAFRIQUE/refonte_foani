{{-- filepath: c:\laragon\www\foani\resources\views\frontend\pages\boutique.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Boutique Foani | ' . ($categorie->libelle ?? 'Tous les produits'))
@section('meta_description',
    'Achetez en ligne vos volailles et œufs frais chez Foani. Large choix de produits de
    qualité premium, livraison rapide en Côte d\'Ivoire. Commandez maintenant!')

@section('content')
    <style>
        /* Styles existants conservés */
        .hero-banner {
            height: 280px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #2a6b2a, #559e33);
            margin-bottom: 0;
        }

        .hero-banner-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.5;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
        }

        .hero-content p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
        }

        .controls-section {
            background: #f8f9fa;
            padding: 25px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .search-container {
            max-width: 500px;
            margin: 0 auto 20px;
        }

        .search-form .form-control {
            border: 2px solid #e9ecef;
            border-radius: 25px 0 0 25px;
            padding: 12px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .search-form .form-control:focus {
            border-color: #2a6b2a;
            box-shadow: 0 0 0 0.2rem rgba(42, 107, 42, 0.15);
            outline: none;
        }

        .search-btn {
            border-radius: 0 25px 25px 0;
            padding: 12px 20px;
            border: 2px solid #2a6b2a;
            background: #2a6b2a;
            color: white;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background-color: #1e5a1e;
            border-color: #1e5a1e;
        }

        /* NOUVEAU: Carrousel des catégories avec images */
        .filters-container {
            background: white;
            border-radius: 20px;
            padding: 25px 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
        }

        .categories-carousel-wrapper {
            position: relative;
            margin: 0 -10px;
        }

        .categories-carousel {
            padding: 0 10px;
        }

        /* Navigation carrousel */
        .categories-carousel .owl-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            padding: 0 5px;
            pointer-events: none;
            z-index: 10;
        }

        .categories-carousel .owl-nav button {
            background: rgba(42, 107, 42, 0.9) !important;
            color: white !important;
            border-radius: 50% !important;
            width: 40px !important;
            height: 40px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border: none !important;
            font-size: 18px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
            transition: all 0.3s ease !important;
            pointer-events: all;
            opacity: 0;
            visibility: hidden;
        }

        .categories-carousel-wrapper:hover .owl-nav button {
            opacity: 1;
            visibility: visible;
        }

        .categories-carousel .owl-nav .owl-prev {
            position: absolute;
            left: -10px;
        }

        .categories-carousel .owl-nav .owl-next {
            position: absolute;
            right: 10px;
        }

        .categories-carousel .owl-nav button:hover {
            background: rgba(42, 107, 42, 1) !important;
            transform: scale(1.1) !important;
        }

        .categories-carousel .owl-dots {
            text-align: center;
            margin-top: 20px;
        }

        .categories-carousel .owl-dots .owl-dot {
            display: inline-block;
            margin: 0 5px;
        }

        .categories-carousel .owl-dots .owl-dot span {
            width: 10px;
            height: 10px;
            background: #ddd;
            border-radius: 50%;
            display: block;
            transition: all 0.3s ease;
        }

        .categories-carousel .owl-dots .owl-dot.active span {
            background: #2a6b2a;
            transform: scale(1.3);
        }

        /* Cards catégories avec images */
        .category-card-carousel {
            background: white;
            border: 2px solid #f1f3f4;
            border-radius: 20px;
            padding: 20px 15px;
            text-decoration: none;
            color: #333;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: block;
            text-align: center;
            margin: 0 8px;
            position: relative;
            overflow: hidden;
            min-height: 140px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .category-card-carousel::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s ease;
        }

        .category-card-carousel:hover::before {
            left: 100%;
        }

        .category-card-carousel:hover {
            border-color: #2a6b2a;
            color: #2a6b2a;
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 35px rgba(42, 107, 42, 0.15);
        }

        .category-card-carousel.active {
            background: linear-gradient(135deg, #2a6b2a, #559e33);
            border-color: #2a6b2a;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(42, 107, 42, 0.25);
        }

        .category-card-carousel.active::before {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        }

        /* Image catégorie - forme carrée arrondie */
        .category-image-carousel {
            /* width: auto; */
            height: 100px;
            border-radius: 12px;
            /* Changé de 50% à 12px */
            object-fit: cover;
            margin: 0 auto 12px;
            border: 3px solid #f1f3f4;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .category-card-carousel:hover .category-image-carousel {
            transform: scale(1.1) rotate(5deg);
            border-color: #2a6b2a;
            border-radius: 15px;
            /* Légèrement plus arrondi au hover */
        }

        .category-card-carousel.active .category-image-carousel {
            border-color: rgba(255, 255, 255, 0.8);
            transform: scale(1.05);
            border-radius: 15px;
        }

        /* Placeholder image - forme carrée arrondie */
        .category-placeholder-carousel {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            /* Changé de 50% à 12px */
            background: linear-gradient(135deg, #e9ecef, #f8f9fa);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            color: #6c757d;
            font-size: 24px;
            border: 3px solid #f1f3f4;
            transition: all 0.3s ease;
        }

        .category-card-carousel:hover .category-placeholder-carousel {
            transform: scale(1.1) rotate(-5deg);
            border-color: #2a6b2a;
            color: #2a6b2a;
            border-radius: 15px;
            /* Plus arrondi au hover */
        }

        .category-card-carousel.active .category-placeholder-carousel {
            border-color: rgba(255, 255, 255, 0.8);
            color: rgba(255, 255, 255, 0.9);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
            border-radius: 15px;
        }

        /* Icône spéciale pour "Toutes" - forme carrée arrondie */
        .category-icon-all {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            /* Changé de 50% à 12px */
            /* background: linear-gradient(135deg, #559e33, #4CAF50); */
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            color: var(--color-jaune);
            font-size: 28px;
            /* border: 3px solid #f1f3f4; */
            transition: all 0.3s ease;
        }

        .category-card-carousel:hover .category-icon-all {
            transform: scale(1.1) rotate(-10deg);
            border-color: #2a6b2a;
            border-radius: 15px;
            /* Plus arrondi au hover */
        }

        .category-card-carousel.active .category-icon-all {
            /* background: linear-gradient(135deg, #ffffff, #f8f9fa); */
            color: #f1f1f1;
            border-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
        }

        /* Contenu textuel */
        .category-content-carousel {
            flex: 1;
        }

        .category-name-carousel {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 6px;
            line-height: 1.2;
        }

        .category-count-carousel {
            font-size: 0.8rem;
            opacity: 0.8;
            font-weight: 500;
        }

        .category-card-carousel.active .category-count-carousel {
            color: rgba(255, 255, 255, 0.9);
        }

        /* Badge avec nombre de produits - toujours rond */
        .category-badge-carousel {
            position: absolute;
            top: 8px;
            right: 8px;
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: white;
            border-radius: 50%;
            /* Reste rond pour le badge */
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .category-card-carousel.active .category-badge-carousel {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: #333;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-banner {
                height: 200px;
            }

            .hero-content h1 {
                font-size: 1.8rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .controls-section {
                padding: 20px 0;
            }

            .search-container {
                margin-bottom: 15px;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .product-image-container {
                height: 140px;
            }

            .product-info {
                padding: 12px;
            }

            .product-price {
                font-size: 1rem;
            }

            .btn-product {
                padding: 8px;
                font-size: 0.9rem;
            }

            .results-title {
                font-size: 1.5rem;
            }

            .product-badge {
                padding: 4px 8px;
                font-size: 0.7rem;
            }
        }

        @media (max-width: 576px) {
            .products-grid {
                grid-template-columns: 1fr;
                max-width: 350px;
                margin: 0 auto;
            }
        }

        /* Styles complets pour la grille de produits */
        .results-section {
            padding: 30px 0;
        }

        .results-header {
            margin-bottom: 25px;
            text-align: center;
        }

        .results-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .results-subtitle {
            color: #6c757d;
            font-size: 1rem;
        }

        .search-indicator {
            background: #e8f5e8;
            border: 1px solid #c3e6c3;
            border-radius: 25px;
            padding: 8px 16px;
            margin: 15px auto;
            display: inline-block;
        }

        .search-indicator .clear-search {
            color: #dc3545;
            text-decoration: none;
            margin-left: 8px;
            font-weight: 500;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(42, 107, 42, 0.15);
        }

        .product-image-container {
            height: 180px;
            position: relative;
            overflow: hidden;
            background: #f8f9fa;
        }

        .product-card .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .product-card:hover .card-img-top {
            transform: scale(1.05);
        }

        .product-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 2;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            opacity: 1 !important;
            display: block !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .product-badge.bg-success {
            background: linear-gradient(135deg, #28a745, #20c997) !important;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .product-badge.bg-danger {
            background: linear-gradient(135deg, #dc3545, #e74c3c) !important;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .product-info {
            padding: 15px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 1rem;
            text-align: center;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-price {
            font-size: 1.1rem;
            text-align: center;
            font-weight: 700;
            color: var(--color-vert);
            margin-bottom: 12px;
        }

        .product-action {
            margin-top: auto;
        }

        .btn-product {
            width: 100%;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px;
            transition: all 0.3s ease;
        }

        .btn-add {
            background: linear-gradient(135deg, var(--color-vert), #4CAF50);
            border: none;
            color: white;
        }

        .btn-add:hover {
            background: linear-gradient(135deg, #4CAF50, var(--color-vert));
            transform: translateY(-1px);
            color: white;
        }

        .btn-reserve {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            border: none;
            color: #333;
        }

        .btn-reserve:hover {
            background: linear-gradient(135deg, #ffb300, #ffa000);
            transform: translateY(-1px);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .pagination-container {
            margin-top: 40px;
            text-align: center;
        }

        .pagination .page-link {
            color: #2a6b2a;
            border-radius: 8px;
            margin: 0 3px;
            border: 1px solid #e9ecef;
            font-weight: 500;
        }

        .pagination .page-item.active .page-link {
            background: #2a6b2a;
            border-color: #2a6b2a;
        }

        /* Responsive pour les produits */
        @media (max-width: 768px) {
            .filters-container {
                padding: 20px 15px;
                margin: 0 -15px;
                border-radius: 0;
            }

            .categories-carousel-wrapper {
                margin: 0 -5px;
            }

            .category-card-carousel {
                padding: 15px 10px;
                margin: 0 5px;
                min-height: 120px;
            }

            .category-image-carousel,
            .category-placeholder-carousel,
            .category-icon-all {
                width: 50px;
                height: 100px;
                margin-bottom: 10px;
                border-radius: 10px;
            }

            .category-card-carousel:hover .category-image-carousel,
            .category-card-carousel:hover .category-placeholder-carousel,
            .category-card-carousel:hover .category-icon-all {
                border-radius: 12px;
            }

            .category-card-carousel.active .category-image-carousel,
            .category-card-carousel.active .category-placeholder-carousel,
            .category-card-carousel.active .category-icon-all {
                border-radius: 12px;
            }

            .category-name-carousel {
                font-size: 0.9rem;
            }

            .category-count-carousel {
                font-size: 0.75rem;
            }

            .category-badge-carousel {
                width: 20px;
                height: 20px;
                font-size: 0.6rem;
            }

            .categories-carousel .owl-nav button {
                width: 35px !important;
                height: 35px !important;
                font-size: 16px !important;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .product-image-container {
                height: 140px;
            }

            .product-info {
                padding: 12px;
            }

            .product-price {
                font-size: 1rem;
            }

            .btn-product {
                padding: 8px;
                font-size: 0.9rem;
            }

            .results-title {
                font-size: 1.5rem;
            }

            .product-badge {
                padding: 4px 8px;
                font-size: 0.7rem;
            }
        }

        @media (max-width: 576px) {
            .category-card-carousel {
                padding: 12px 8px;
                min-height: 110px;
            }

            .category-image-carousel,
            .category-placeholder-carousel,
            .category-icon-all {
                width: 100;
                height: 100px;
                border-radius: 8px;
            }

            .category-card-carousel:hover .category-image-carousel,
            .category-card-carousel:hover .category-placeholder-carousel,
            .category-card-carousel:hover .category-icon-all {
                border-radius: 10px;
            }

            .category-card-carousel.active .category-image-carousel,
            .category-card-carousel.active .category-placeholder-carousel,
            .category-card-carousel.active .category-icon-all {
                border-radius: 10px;
            }

            .category-name-carousel {
                font-size: 0.85rem;
            }

            .category-count-carousel {
                font-size: 0.7rem;
            }

            .products-grid {
                grid-template-columns: 1fr;
                max-width: 350px;
                margin: 0 auto;
            }
        }

        /* Animation de chargement pour les catégories */
        .category-card-carousel {
            animation: fadeInScale 0.6s ease-out;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
    </style>

    {{-- Hero Banner --}}
    @if (isset($categorie))
        <div class="hero-banner">
            <img src="{{ $categorie->getFirstMediaUrl('image_banniere') ?: asset('front/images/logo.png') }}"
                alt="{{ $categorie->libelle }}" class="hero-banner-img">
            <div class="hero-overlay">
                <div class="hero-content">
                    {{-- <h1>{{ $categorie->libelle }}</h1> --}}
                    {{-- <p>{{ $categorie->produits()->count() }} produit(s) disponible(s)</p> --}}
                </div>
            </div>
        </div>
    @else
        <div class="hero-banner">
            <img src="{{ asset('front/images/logo.png') }}" alt="Tous les produits" class="hero-banner-img">
            <div class="hero-overlay">
                <div class="hero-content">
                    <h1>Tous nos produits</h1>
                    <p>Découvrez notre gamme complète de volailles et œufs frais</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Section de contrôles --}}
    <div class="controls-section">
        <div class="container">
            {{-- Barre de recherche --}}
            {{-- <div class="search-container">
                <form method="GET" action="{{ route('boutique.index') }}" class="search-form" id="search-form">
                    <div class="input-group">
                        <input type="text" name="recherche" class="form-control" placeholder="Rechercher un produit..."
                            value="{{ $recherche ?? '' }}">
                        @if (isset($categorie))
                            <input type="hidden" name="categorie" value="{{ $categorie->slug }}">
                        @endif
                        <button class="btn search-btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div> --}}

            {{-- Indicateur de recherche --}}
            @if ($recherche)
                <div class="text-center">
                    <div class="search-indicator">
                        <strong>{{ $produits->total() }}</strong> résultat(s) pour "<strong>{{ $recherche }}</strong>"
                        <a href="{{ isset($categorie) ? route('boutique.categorie', $categorie->slug) : route('boutique.index') }}"
                            class="clear-search">
                            <i class="bi bi-x"></i> Effacer
                        </a>
                    </div>
                </div>
            @endif

            {{-- NOUVEAU: Carrousel des catégories avec images --}}
            <div class="filters-container">
                <div class="categories-carousel-wrapper">
                    <div class="owl-carousel owl-theme categories-carousel">
                        {{-- Toutes les catégories --}}
                        <div class="item">
                            <a href="{{ route('boutique.index') }}"
                                class="category-card-carousel {{ !isset($categorie) ? 'active' : '' }}">
                                <div class="category-icon-all">
                                    <i class="bi bi-grid-fill"></i>
                                </div>
                                <div class="category-content-carousel">
                                    <div class="category-name-carousel">Tous</div>
                                    <div class="category-count-carousel">{{ \App\Models\Produit::count() }} produits</div>
                                </div>
                                <span class="category-badge-carousel">{{ \App\Models\Produit::count() }}</span>
                            </a>
                        </div>

                        {{-- Catégories avec images --}}
                        @foreach (\App\Models\Categorie::position()->get() as $cat)
                            <div class="item">
                                <a href="{{ route('boutique.categorie', ['slug' => $cat->slug]) }}"
                                    class="category-card-carousel {{ isset($categorie) && $categorie->slug == $cat->slug ? 'active' : '' }}">

                                    @if ($cat->getFirstMediaUrl('image'))
                                        <img src="{{ $cat->getFirstMediaUrl('image') }}" alt="{{ $cat->libelle }}"
                                            class="category-image-carousel" loading="lazy">
                                    @else
                                        <div class="category-placeholder-carousel">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif

                                    <div class="category-content-carousel">
                                        <div class="category-name-carousel">{{ $cat->libelle }}</div>
                                        <div class="category-count-carousel">{{ $cat->produits()->count() }}
                                            produit{{ $cat->produits()->count() > 1 ? 's' : '' }}</div>
                                    </div>
                                    <span class="category-badge-carousel">{{ $cat->produits()->count() }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Section des résultats --}}
    <div class="results-section">
        <div class="container">
            <div class="results-header">
                <h2 class="results-title">
                    @if (isset($categorie))
                        {{ $categorie->libelle }}
                    @elseif ($recherche)
                        Résultats de recherche
                    @else
                        Nos produits
                    @endif
                </h2>
                <p class="results-subtitle">{{ $produits->total() }} produit(s) trouvé(s)</p>
            </div>

            {{-- Point d'ancrage pour le scroll --}}
            <div id="produits-section">
                @forelse($produits as $produit)
                    @if ($loop->first)
                        <div class="products-grid">
                    @endif

                    <div class="product-card">
                        {{-- Badge de stock toujours visible --}}
                        @if ($produit->stock > 0)
                            <span class="product-badge bg-success">
                                <i class="bi bi-check-circle-fill me-1"></i>En stock
                            </span>
                        @else
                            <span class="product-badge bg-danger">
                                <i class="bi bi-x-circle-fill me-1"></i>Rupture
                            </span>
                        @endif

                        <div class="product-image-container">
                            <img src="{{ $produit->getFirstMediaUrl('image_principale') ?: asset('front/images/produits/poulet.png') }}"
                                class="card-img-top" alt="{{ $produit->libelle }}">
                        </div>

                        <div class="product-info">
                            <h5 class="product-title">{{ $produit->libelle }}</h5>
                            <p class="product-price" style="color:var(--color-vert);">
                                {{ $produit->prix_de_vente > 0 ? number_format($produit->prix_de_vente, 0, ',', ' ') . ' FCFA' : 'Commande en avance' }}
                            </p>
                            @if ($produit->prix_de_vente > 0)
                                <div class="product-action">
                                    @if ($produit->stock > 0)
                                        <button class="btn btn-add btn-product btn-ajouter-panier"
                                            data-id="{{ $produit->id }}">
                                            <i class="bi bi-cart-plus me-1"></i>Ajouter au panier
                                        </button>
                                    @else
                                        <a href="{{ route('reservation.create', ['slug' => $produit->slug]) }}"
                                            class="btn btn-reserve btn-product">
                                            <i class="bi bi-clock me-1"></i>Réserver
                                        </a>
                                    @endif
                                </div>
                            @else
                                <a href="https://wa.me/225{{ $parametre?->contact2 }}/?text=Bonjour%2C%20Je%20veux%20commander%20le%20produit%20{{ $produit->libelle }}"
                                    target="_blank" class="btn btn-success btn-product">
                                    <i class="bi bi-whatsapp fs-6 me-2"></i>Commander via WhatsApp
                                </a>
                            @endif
                        </div>
                    </div>

                    @if ($loop->last)
            </div>
            @endif
        @empty
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h4>Aucun produit trouvé</h4>
                <p>
                    @if ($recherche)
                        Essayez avec d'autres mots-clés ou parcourez nos catégories.
                    @else
                        Aucun produit disponible dans cette catégorie pour le moment.
                    @endif
                </p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($produits->hasPages())
            <div class="pagination-container">
                {{ $produits->withQueryString()->links() }}
            </div>
        @endif
    </div>
    </div>

@endsection

@push('styles')
    <!-- OwlCarousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <style>
        /* Styles complets pour la grille de produits */
        .results-section {
            padding: 30px 0;
        }

        .results-header {
            margin-bottom: 25px;
            text-align: center;
        }

        .results-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .results-subtitle {
            color: #6c757d;
            font-size: 1rem;
        }

        .search-indicator {
            background: #e8f5e8;
            border: 1px solid #c3e6c3;
            border-radius: 25px;
            padding: 8px 16px;
            margin: 15px auto;
            display: inline-block;
        }

        .search-indicator .clear-search {
            color: #dc3545;
            text-decoration: none;
            margin-left: 8px;
            font-weight: 500;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(42, 107, 42, 0.15);
        }

        .product-image-container {
            height: 180px;
            position: relative;
            overflow: hidden;
            background: #f8f9fa;
        }

        .product-card .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .product-card:hover .card-img-top {
            transform: scale(1.05);
        }

        .product-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 2;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            opacity: 1 !important;
            display: block !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .product-badge.bg-success {
            background: linear-gradient(135deg, #28a745, #20c997) !important;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .product-badge.bg-danger {
            background: linear-gradient(135deg, #dc3545, #e74c3c) !important;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .product-info {
            padding: 15px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 1rem;
            text-align: center;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-price {
            font-size: 1.1rem;
            text-align: center;
            font-weight: 700;
            color: var(--color-vert);
            margin-bottom: 12px;
        }

        .product-action {
            margin-top: auto;
        }

        .btn-product {
            width: 100%;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px;
            transition: all 0.3s ease;
        }

        .btn-add {
            background: linear-gradient(135deg, var(--color-vert), #4CAF50);
            border: none;
            color: white;
        }

        .btn-add:hover {
            background: linear-gradient(135deg, #4CAF50, var(--color-vert));
            transform: translateY(-1px);
            color: white;
        }

        .btn-reserve {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            border: none;
            color: #333;
        }

        .btn-reserve:hover {
            background: linear-gradient(135deg, #ffb300, #ffa000);
            transform: translateY(-1px);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .pagination-container {
            margin-top: 40px;
            text-align: center;
        }

        .pagination .page-link {
            color: #2a6b2a;
            border-radius: 8px;
            margin: 0 3px;
            border: 1px solid #e9ecef;
            font-weight: 500;
        }

        .pagination .page-item.active .page-link {
            background: #2a6b2a;
            border-color: #2a6b2a;
        }

        /* Responsive pour les produits */
        @media (max-width: 768px) {
            .filters-container {
                padding: 20px 15px;
                margin: 0 -15px;
                border-radius: 0;
            }

            .categories-carousel-wrapper {
                margin: 0 -5px;
            }

            .category-card-carousel {
                padding: 15px 10px;
                margin: 0 5px;
                min-height: 120px;
            }

            .category-image-carousel,
            .category-placeholder-carousel,
            .category-icon-all {
                width: 50px;
                height: 50px;
                margin-bottom: 10px;
                border-radius: 10px;
            }

            .category-card-carousel:hover .category-image-carousel,
            .category-card-carousel:hover .category-placeholder-carousel,
            .category-card-carousel:hover .category-icon-all {
                border-radius: 12px;
            }

            .category-card-carousel.active .category-image-carousel,
            .category-card-carousel.active .category-placeholder-carousel,
            .category-card-carousel.active .category-icon-all {
                border-radius: 12px;
            }

            .category-name-carousel {
                font-size: 0.9rem;
            }

            .category-count-carousel {
                font-size: 0.75rem;
            }

            .category-badge-carousel {
                width: 20px;
                height: 20px;
                font-size: 0.6rem;
            }

            .categories-carousel .owl-nav button {
                width: 35px !important;
                height: 35px !important;
                font-size: 16px !important;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .product-image-container {
                height: 140px;
            }

            .product-info {
                padding: 12px;
            }

            .product-price {
                font-size: 1rem;
            }

            .btn-product {
                padding: 8px;
                font-size: 0.9rem;
            }

            .results-title {
                font-size: 1.5rem;
            }

            .product-badge {
                padding: 4px 8px;
                font-size: 0.7rem;
            }
        }


        /* Force masquage overflow sur body si nécessaire */
        body {
            overflow-x: hidden;
        }

        /* Container principal page */
        .container {
            max-width: 100%;
            overflow-x: hidden;
        }

        /* Section contrôles - correction overflow */
        .controls-section {
            background: #f8f9fa;
            padding: 25px 0;
            border-bottom: 1px solid #e9ecef;
            overflow-x: hidden;
            /* AJOUTÉ: Empêche overflow horizontal */
        }

        @media (max-width: 576px) {
            .category-card-carousel {
                padding: 12px 8px;
                min-height: 110px;
            }

            .category-image-carousel,
            .category-placeholder-carousel,
            .category-icon-all {
                width: 45px;
                height: 45px;
                border-radius: 8px;
            }

            .category-card-carousel:hover .category-image-carousel,
            .category-card-carousel:hover .category-placeholder-carousel,
            .category-card-carousel:hover .category-icon-all {
                border-radius: 10px;
            }

            .category-card-carousel.active .category-image-carousel,
            .category-card-carousel.active .category-placeholder-carousel,
            .category-card-carousel.active .category-icon-all {
                border-radius: 10px;
            }

            .category-name-carousel {
                font-size: 0.85rem;
            }

            .category-count-carousel {
                font-size: 0.7rem;
            }

            .products-grid {
                grid-template-columns: 1fr;
                max-width: 350px;
                margin: 0 auto;
            }
        }

        /* Animation de chargement pour les catégories */
        .category-card-carousel {
            animation: fadeInScale 0.6s ease-out;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
    </style>
@endpush


@push('scripts')
    <!-- OwlCarousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialisation du carrousel des catégories
            $('.categories-carousel').owlCarousel({
                loop: true,
                margin: 15,
                nav: false,
                dots: true,
                autoplay: false,
                smartSpeed: 500,
                mouseDrag: true,
                touchDrag: true,
                pullDrag: true,
                freeDrag: false,
                stagePadding: 0,
                responsive: {
                    0: {
                        items: 1.2,
                        margin: 8,
                        stagePadding: 20,
                        dots: false
                    },
                    480: {
                        items: 2.2,
                        margin: 10,
                        stagePadding: 15
                    },
                    576: {
                        items: 2.5,
                        margin: 12
                    },
                    768: {
                        items: 3.5,
                        margin: 15
                    },
                    992: {
                        items: 4.5,
                        margin: 15
                    },
                    1200: {
                        items: 5.5,
                        margin: 15
                    },
                    1400: {
                        items: 6,
                        margin: 15
                    }
                },
                // navText: [
                //     '<i class="bi bi-chevron-left"></i>',
                //     '<i class="bi bi-chevron-right"></i>'
                // ]
            });

            // Gestion des clics sur les catégories - NAVIGATION DIRECTE
            $('.category-card-carousel').on('click', function(e) {
                if (!$(this).hasClass('active')) {
                    e.preventDefault();
                    const href = $(this).attr('href');
                    window.location.href = href;
                }
            });

            // Gestion de la recherche - NAVIGATION DIRECTE
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                const formData = $(this).serialize();
                const action = $(this).attr('action');
                window.location.href = action + '?' + formData;
            });

            // Gestion du redimensionnement
            let resizeTimer;
            $(window).on('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    $('.categories-carousel').trigger('refresh.owl.carousel');
                }, 250);
            });
        });
    </script>
@endpush
