@extends('frontend.layouts.app')

@section('title', 'Boutique Foani | ' . ($categorie->libelle ?? 'Tous les produits'))
@section('meta_description',
    'Achetez en ligne vos volailles et œufs frais chez Foani. Large choix de produits de qualité premium, livraison rapide en Côte d\'Ivoire. Commandez maintenant!')

@section('content')
    @php
        $banniere = $categorie?->getFirstMediaUrl('image_banniere', 'large');
    @endphp

    {{-- En-tête de page --}}
    <section class="shop-hero">
        @if ($banniere)
            <img src="{{ $banniere }}" alt="" class="shop-hero__img" fetchpriority="high">
        @endif
        <div class="container">
            <nav aria-label="Fil d'Ariane" class="crumbs">
                <a href="{{ route('boutique.accueil') }}">Accueil</a>
                <span class="mx-1">/</span>
                @if ($categorie)
                    <a href="{{ route('boutique.index') }}">Nos produits</a>
                    <span class="mx-1">/</span>
                    <span>{{ $categorie->libelle }}</span>
                @else
                    <span>Nos produits</span>
                @endif
            </nav>
            <span class="eyebrow">Frais de la ferme <span class="wobble">🥚</span></span>
            <h1>
                @if ($categorie)
                    {{ $categorie->libelle }}
                @elseif ($recherche)
                    Résultats de recherche
                @else
                    Tous nos produits
                @endif
            </h1>
            <p>
                {{ $produits->total() }} produit{{ $produits->total() > 1 ? 's' : '' }}
                {{ $categorie ? 'dans cette catégorie' : 'disponibles' }}
                · Volailles et œufs frais, livrés rapidement
            </p>
        </div>
        <svg class="wave-bottom" viewBox="0 0 1440 34" preserveAspectRatio="none" aria-hidden="true">
            <path fill="currentColor" d="M0 34V18c120-14 240-18 360-10s240 22 360 20 240-18 360-22 240 4 360 12v16z" />
        </svg>
    </section>

    {{-- Catégories (barre collante sous le header) --}}
    <div class="shop-toolbar">
        <div class="container">
            <div class="chips-scroller">
                <button type="button" class="chips-arrow chips-arrow--prev" aria-label="Catégories précédentes">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <nav class="cat-chips" aria-label="Catégories">
                    <a href="{{ route('boutique.index') }}" class="cat-chip {{ !$categorie ? 'active' : '' }}"
                        @if (!$categorie) aria-current="page" @endif>
                        <span class="cat-chip__icon"><i class="bi bi-grid-fill"></i></span>
                        Tout
                        <span class="count">{{ $totalProduits }}</span>
                    </a>
                    @foreach ($categories as $cat)
                        @php $actif = $categorie && $categorie->id === $cat->id; @endphp
                        <a href="{{ route('boutique.categorie', ['slug' => $cat->slug]) }}"
                            class="cat-chip {{ $actif ? 'active' : '' }}" @if ($actif) aria-current="page" @endif>
                            @if ($img = $cat->getFirstMediaUrl('image', 'thumb'))
                                <img src="{{ $img }}" alt="" width="38" height="38" loading="lazy" decoding="async">
                            @else
                                <span class="cat-chip__icon"><i class="bi bi-egg-fried"></i></span>
                            @endif
                            {{ $cat->libelle }}
                            <span class="count">{{ $cat->produits_count }}</span>
                        </a>
                    @endforeach
                </nav>

                <button type="button" class="chips-arrow chips-arrow--next" aria-label="Catégories suivantes">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Résultats --}}
    <section class="container py-4 py-lg-5" id="produits-section">
        @if ($recherche)
            <div class="mb-4">
                <span class="search-pill">
                    <i class="bi bi-search"></i>
                    <span><strong>{{ $produits->total() }}</strong> résultat(s) pour « <strong>{{ $recherche }}</strong> »</span>
                    <a href="{{ $categorie ? route('boutique.categorie', $categorie->slug) : route('boutique.index') }}"
                        aria-label="Effacer la recherche"><i class="bi bi-x-lg"></i></a>
                </span>
            </div>
        @endif

        @if ($produits->isEmpty())
            <div class="empty-state">
                <div class="fs-1 mb-2"><span class="wobble">🐔</span></div>
                <h2 class="h5">Aucun produit trouvé</h2>
                <p class="mb-3">
                    {{ $recherche ? 'Essayez avec d\'autres mots-clés ou parcourez nos catégories.' : 'Aucun produit disponible dans cette catégorie pour le moment.' }}
                </p>
                <a href="{{ route('boutique.index') }}" class="btn btn-success rounded-pill px-4">Voir tous les produits</a>
            </div>
        @else
            <div class="pgrid">
                @foreach ($produits as $produit)
                    @include('frontend.components.product-card', [
                        'produit' => $produit,
                        'showCategorie' => !$categorie,
                        'eager' => $loop->index < 4,
                        'delay' => ($loop->index % 4) * 0.07,
                    ])
                @endforeach
            </div>

            @if ($produits->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $produits->withQueryString()->onEachSide(1)->links() }}
                </div>
            @endif
        @endif
    </section>
@endsection
