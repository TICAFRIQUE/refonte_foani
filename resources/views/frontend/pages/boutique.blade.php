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
        /* Bannière Hero optimisée */
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
            /* background: linear-gradient(135deg, rgba(42, 107, 42, 0.8), rgba(85, 158, 51, 0.6)); */
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

        .breadcrumb-nav {
            background: white;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
            font-size: 0.9rem;
        }

        .breadcrumb-nav a {
            color: #2a6b2a;
            text-decoration: none;
        }

        .breadcrumb-nav .separator {
            color: #6c757d;
            margin: 0 8px;
        }

        /* Section de contrôles (recherche + filtres) */
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

        /* Filtres horizontaux compacts */
        .filters-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .category-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .category-chip {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 25px;
            padding: 8px 16px;
            text-decoration: none;
            color: #495057;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .category-chip:hover {
            border-color: #2a6b2a;
            color: #2a6b2a;
            background: #f0f8f0;
        }

        .category-chip.active {
            background: #2a6b2a;
            border-color: #2a6b2a;
            color: white;
        }

        .category-chip .count {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 2px 6px;
            margin-left: 5px;
            font-size: 0.8rem;
        }

        .category-chip.active .count {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Section résultats */
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

        /* Cards produits optimisées */
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
            right: 10px;
            z-index: 2;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
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

        /* États vides */
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

        /* Pagination */
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

        /* Responsive Design */
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

            .filters-container {
                padding: 15px;
            }

            .category-chips {
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 5px;
                flex-wrap: nowrap;
            }

            .category-chip {
                flex-shrink: 0;
                padding: 6px 12px;
                font-size: 0.85rem;
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

            /* .product-title {
                font-size: 0.9rem;
            } */

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
        }

        @media (max-width: 576px) {
            .products-grid {
                grid-template-columns: 1fr;
                max-width: 350px;
                margin: 0 auto;
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

    {{-- Breadcrumb --}}
    {{-- <div class="breadcrumb-nav">
        <div class="container">
            <a href="{{ route('accueil') }}">Accueil</a>
            <span class="separator">></span>
            @if (isset($categorie))
                <a href="{{ route('boutique.index') }}">Boutique</a>
                <span class="separator">></span>
                <span class="current">{{ $categorie->libelle }}</span>
            @else
                <span class="current">Boutique</span>
            @endif
        </div>
    </div> --}}

    {{-- Section de contrôles --}}
    <div class="controls-section">
        <div class="container">
            {{-- Barre de recherche --}}
            <div class="search-container">
                <form method="GET" action="{{ route('boutique.index') }}" class="search-form" id="search-form">
                    <div class="input-group">
                        <input type="text" name="recherche" class="form-control"
                            placeholder="Rechercher un produit..." value="{{ $recherche ?? '' }}">
                        @if (isset($categorie))
                            <input type="hidden" name="categorie" value="{{ $categorie->slug }}">
                        @endif
                        <button class="btn search-btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>

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

            {{-- Filtres par catégorie --}}
            <div class="filters-container">
                <div class="category-chips">
                    <a href="{{ route('boutique.index') }}"
                        class="category-chip {{ !isset($categorie) ? 'active' : '' }}">
                        <i class="bi bi-grid-fill me-1"></i>
                        Toutes
                        <span class="count">{{ \App\Models\Produit::count() }}</span>
                    </a>
                    @foreach (\App\Models\Categorie::position()->get() as $cat)
                        <a href="{{ route('boutique.categorie', ['slug' => $cat->slug]) }}"
                            class="category-chip {{ isset($categorie) && $categorie->slug == $cat->slug ? 'active' : '' }}">
                            {{ $cat->libelle }}
                            <span class="count">{{ $cat->produits()->count() }}</span>
                        </a>
                    @endforeach
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
                        @if ($produit->stock > 0)
                            <span class="product-badge badge bg-success">En stock</span>
                        @else
                            <span class="product-badge badge bg-danger">Rupture</span>
                        @endif
                        
                        <div class="product-image-container">
                            <img src="{{ $produit->getFirstMediaUrl('image_principale') ?: asset('front/images/produits/poulet.png') }}"
                                class="card-img-top" alt="{{ $produit->libelle }}">
                        </div>
                        
                        <div class="product-info">
                            <h5 class="product-title">{{ $produit->libelle }}</h5>
                            <p class="product-price">
                                {{ number_format($produit->prix_de_vente, 0, ',', ' ') }} FCFA
                            </p>
                            <div class="product-action">
                                @if ($produit->stock > 0)
                                    <button class="btn btn-add btn-product btn-ajouter-panier" data-id="{{ $produit->id }}">
                                        <i class="bi bi-cart-plus me-1"></i>Ajouter au panier
                                    </button>
                                @else
                                    <a href="{{ route('reservation.create', ['slug' => $produit->slug]) }}"
                                        class="btn btn-reserve btn-product">
                                        <i class="bi bi-clock me-1"></i>Réserver
                                    </a>
                                @endif
                            </div>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            // Scroll vers les produits
            function scrollToProduits() {
                setTimeout(function() {
                    $('html, body').animate({
                        scrollTop: $('#produits-section').offset().top - 600
                    }, 40, 'easeInOutCubic');
                }, 50);
            }

            // Gestion des liens de catégories
            $('.category-chip').on('click', function(e) {
                if (!$(this).hasClass('active')) {
                    e.preventDefault();
                    const href = $(this).attr('href');
                    const url = href + (href.includes('?') ? '&' : '?') + 'scroll=true';
                    window.location.href = url;
                }
            });

            // Gestion de la recherche
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                const formData = $(this).serialize();
                const action = $(this).attr('action');
                const url = action + '?' + formData + '&scroll=true';
                window.location.href = url;
            });

            // Auto-scroll si paramètre présent
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('scroll') === 'true') {
                scrollToProduits();
                
                // Nettoyer l'URL
                const url = new URL(window.location);
                url.searchParams.delete('scroll');
                window.history.replaceState({}, document.title, url.toString());
            }

            // Easing personnalisé
            $.easing.easeInOutCubic = function(x, t, b, c, d) {
                if ((t /= d / 2) < 1) return c / 2 * t * t * t + b;
                return c / 2 * ((t -= 2) * t * t + 2) + b;
            };
        });
    </script>
@endpush