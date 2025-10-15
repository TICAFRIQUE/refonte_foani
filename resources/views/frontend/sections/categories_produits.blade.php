{{-- filepath: resources/views/frontend/sections/categories_produits.blade.php --}}
@foreach($categories as $categorie)
    <section class="container mb-5 bg-white p-3">
        <a href="{{ route('boutique.categorie', ['slug' => $categorie->slug]) }}" class="text-decoration-none">
            <div class="text-center">
                <h3 class="fw-bold" style="color: var(--color-vert);">{{ $categorie->libelle }}</h3>
                <img src="{{ $categorie->getFirstMediaUrl('image') ?: asset('front/images/logo.png') }}"
                    alt="{{ $categorie->libelle }}" width="10%" class="mb-3">
            </div>
        </a>
        <div class="row g-4">
            @forelse($categorie->produits as $produit)
                <div class="col-6 col-md-3">
                    <div class="card product-card shadow-sm position-relative">
                        {{-- Badge en haut à droite --}}
                        @if($produit->stock > 0)
                            <span class="badge bg-success position-absolute top-0 end-0 m-2">En stock</span>
                        @else
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">Rupture</span>
                        @endif
                        <img src="{{ $produit->getFirstMediaUrl('image_principale') ?: asset('front/images/produits/poulet.png') }}"
                            class="card-img-top" alt="{{ $produit->libelle }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $produit->libelle }}</h5>
                            <p class="card-text fw-bold" style="color:var(--color-vert);">
                                {{ number_format($produit->prix_de_vente, 0, ',', ' ') }} FCFA
                            </p>
                            @if($produit->stock > 0)
                                <button class="btn btn-add w-100 btn-ajouter-panier" data-id="{{ $produit->id }}">
                                    <i class="bi bi-cart-plus me-2"></i>Ajouter
                                </button>
                            @else
                                <a href="{{ route('reservation.create', ['slug' => $produit->slug]) }}" class="btn btn-warning w-100">
                                    <i class="bi bi-clock me-2"></i>Réserver
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    Aucun produit disponible dans cette catégorie.
                </div>
            @endforelse
        </div>
        <div class="text-center mt-3">
            <a href="{{route('boutique.index', ['categorie' => $categorie->slug])}}" class="btn btn-cta">Tout voir {{ $categorie->libelle }}</a>
        </div>
    </section>
@endforeach