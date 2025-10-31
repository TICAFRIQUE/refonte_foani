{{-- filepath: c:\laragon\www\foani\resources\views\frontend\sections\categories_produits.blade.php --}}
@foreach ($categories as $categorie)
    <section class="container mb-5">
        <div class="row g-4 align-items-stretch">
            {{-- Bloc 1 : Bannière verticale de la catégorie --}}
            <div class="col-lg-3 col-md-4">
                <div class="category-banner h-100 position-relative overflow-hidden">
                    <img src="{{ $categorie->getFirstMediaUrl('image') ?: asset('front/images/logo.png') }}"
                        alt="{{ $categorie->libelle }}" class="category-banner-img">
                    <div class="category-banner-overlay">
                        <div class="category-banner-content text-center text-white">
                            <h3 class="fw-bold mb-3">{{ $categorie->libelle }}</h3>
                            {{-- <p class="mb-3">{{ $categorie->produits()->count() }} produit(s) disponible(s)</p> --}}
                            <a href="{{ route('boutique.categorie', ['slug' => $categorie->slug]) }}"
                                class="btn btn-light btn-lg fw-bold">
                                <i class="bi bi-arrow-right me-2"></i>Découvrir
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bloc 2 : Produits de la catégorie --}}
            <div class="col-lg-9 col-md-8">
                <div class="products-section bg-white rounded-3 p-4 shadow-sm h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold mb-0" style="color: var(--color-vert);">
                            {{ $categorie->libelle }}
                        </h4>
                        <a href="{{ route('boutique.categorie', ['slug' => $categorie->slug]) }}"
                            class="btn btn-outline-success fw-bold">
                            <i class="bi bi-grid me-2"></i>Tout voir
                        </a>
                    </div>

                    <div class="row g-3">
                        @forelse($categorie->produits->take(4) as $produit)
                            <div
                                class=" {{ $categorie->produits->count() == 1 ? 'col-12 col-lg-12' : 'col-6  col-lg-3' }}">
                                <div class="card product-card shadow-sm position-relative h-100">
                                    {{-- Badge en haut à droite --}}
                                    @if ($produit->stock > 0)
                                        <span class="badge bg-success position-absolute top-0 end-0 m-2 z-2">En
                                            stock</span>
                                    @else
                                        <span
                                            class="badge bg-danger position-absolute top-0 end-0 m-2 z-2">Rupture</span>
                                    @endif

                                    <div class="product-image-wrapper position-relative overflow-hidden">
                                        <img src="{{ $produit->getFirstMediaUrl('image_principale') ?: asset('front/images/produits/poulet.png') }}"
                                            class="card-img-top product-image" alt="{{ $produit->libelle }}">
                                        {{-- <div class="product-overlay">
                                            <a href="{{ route('produit.show', ['slug' => $produit->slug]) }}" 
                                               class="btn btn-light btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div> --}}
                                    </div>

                                    <div class="card-body text-center p-3">
                                        <h6 class=" mb-2" style="font-size:0.9rem ;text-transform:capitalize">{{ Str::limit($produit->libelle,40) }}</h6>
                                        <p class="card-text fw-bold mb-3" style="color:var(--color-vert);">
                                            {{ number_format($produit->prix_de_vente, 0, ',', ' ') }} FCFA
                                        </p>
                                        @if ($produit->stock > 0)
                                            <button class="btn btn-add btn-sm w-100 btn-ajouter-panier"
                                                data-id="{{ $produit->id }}">
                                                <i class="bi bi-cart-plus me-1"></i>Ajouter
                                            </button>
                                        @else
                                            <a href="{{ route('reservation.create', ['slug' => $produit->slug]) }}"
                                                class="btn btn-warning btn-sm w-100">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ Auth::check() ? 'Réserver' : 'Réserver (connexion requise)' }}
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
            </div>
        </div>
    </section>
@endforeach

@push('styles')
    <style>
        /* Bannière verticale de catégorie */
        .category-banner {
            min-height: 400px;
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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
                    rgba(247, 201, 72, 0.6));
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        .category-banner:hover .category-banner-overlay {
            opacity: 1;
        }

        .category-banner-content h3 {
            font-size: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Section produits */
        .products-section {
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Cards produits */
        .product-card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .product-image-wrapper {
            height: 150px;
            position: relative;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.1);
        }

        .product-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-card:hover .product-overlay {
            opacity: 1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .category-banner {
                min-height: 250px;
                margin-bottom: 1rem;
            }

            .category-banner-content h3 {
                font-size: 1.2rem;
            }

            .product-image-wrapper {
                height: 120px;
            }
        }
    </style>
@endpush
