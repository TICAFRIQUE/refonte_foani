{{-- Accueil boutique : un panneau par catégorie (bannière + 4 produits) --}}
<section class="container pt-3">
    <div class="section-head section-head--center reveal">
        <span class="eyebrow">Sélection du moment</span>
        <h2>Nos produits par catégorie</h2>
    </div>

    @foreach ($categories as $categorie)
        @continue($categorie->produits->isEmpty())
        @php
            $vignette = $categorie->getFirstMediaUrl('image', 'thumb');
            $nb = $categorie->produits_count ?? $categorie->produits->count();
        @endphp

        <article class="cat-panel {{ $loop->even ? 'cat-panel--alt' : '' }} reveal" aria-labelledby="cat-{{ $categorie->id }}">
            <header class="cat-panel__head">
                <div class="cat-panel__title">
                    @if ($vignette)
                        <img src="{{ $vignette }}" alt="" class="cat-panel__icon" width="46" height="46" loading="lazy">
                    @endif
                    <div>
                        <h2 id="cat-{{ $categorie->id }}">{{ $categorie->libelle }}</h2>
                        <p>{{ $nb }} produit{{ $nb > 1 ? 's' : '' }} disponible{{ $nb > 1 ? 's' : '' }}</p>
                    </div>
                </div>
                <a href="{{ route('boutique.categorie', ['slug' => $categorie->slug]) }}" class="link-more">
                    <span>Tout voir</span> <i class="bi bi-arrow-right"></i>
                </a>
            </header>

            <div class="row g-3">
                {{-- Bannière (desktop) --}}
                <div class="d-none d-lg-block col-lg-3">
                    <a href="{{ route('boutique.categorie', ['slug' => $categorie->slug]) }}" class="cat-banner">
                        <img src="{{ $categorie->getFirstMediaUrl('image', 'large') ?: asset('front/images/logo.png') }}"
                            alt="{{ $categorie->libelle }}" loading="lazy" decoding="async">
                        <div class="cat-banner__content">
                            <span class="eyebrow">Frais de la ferme</span>
                            <h3>{{ $categorie->libelle }}</h3>
                            <p>Découvrez toute la gamme</p>
                            <span class="cat-banner__cta">Découvrir <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </a>
                </div>

                {{-- Produits --}}
                <div class="col-12 col-lg-9">
                    <div class="pgrid pgrid--row4">
                        @foreach ($categorie->produits->take(4) as $produit)
                            @include('frontend.components.product-card', [
                                'produit' => $produit,
                                'showCategorie' => false,
                                'delay' => $loop->index * 0.07,
                            ])
                        @endforeach
                    </div>
                </div>
            </div>
        </article>
    @endforeach
</section>
