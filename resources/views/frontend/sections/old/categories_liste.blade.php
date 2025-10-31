{{-- filepath: c:\laragon\www\foani\resources\views\frontend\sections\categories_liste.blade.php --}}
@push('styles')
    <style>
        /* Isolation des styles pour les catégories */
        .categories-section {
            position: relative;
            z-index: 1;
        }

        .categories-title {
            color: var(--color-vert) !important;
            font-size: 2.2rem !important;
            margin-bottom: 2rem !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
        }

        .categories-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--color-vert), var(--color-jaune));
            border-radius: 2px;
        }

        .categories-card {
            padding: 25px;
            background: linear-gradient(145deg, #ffffff, #f8fafa);
            border-radius: 20px;
            border: 1px solid rgba(42, 107, 42, 0.1);
            position: relative;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow:
                0 8px 25px rgba(0, 0, 0, 0.08),
                0 4px 12px rgba(42, 107, 42, 0.05);
            transform: translateY(0);
            overflow: hidden;
        }

        .categories-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
                    rgba(42, 107, 42, 0.02),
                    rgba(247, 201, 72, 0.02),
                    rgba(255, 255, 255, 0.05));
            border-radius: 20px;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        .categories-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            transition: transform 0.6s ease;
            z-index: 2;
        }

        .categories-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.12),
                0 10px 20px rgba(42, 107, 42, 0.1),
                0 5px 15px rgba(247, 201, 72, 0.08);
            background: linear-gradient(145deg, #ffffff, #f0f8f0);
            border-color: rgba(42, 107, 42, 0.2);
        }

        .categories-card:hover::before {
            opacity: 1;
        }

        .categories-card:hover::after {
            transform: rotate(45deg) translateX(100%);
        }

        .categories-image-container {
            width: 120px;
            height: 120px;
            margin: 0 auto;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            box-shadow:
                0 8px 20px rgba(0, 0, 0, 0.1),
                0 4px 10px rgba(42, 107, 42, 0.08);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            background: linear-gradient(145deg, #f8f9fa, #ffffff);
            border: 3px solid rgba(42, 107, 42, 0.1);
            z-index: 3;
        }

        .categories-card:hover .categories-image-container {
            transform: scale(1.1) rotateY(5deg);
            box-shadow:
                0 15px 30px rgba(0, 0, 0, 0.15),
                0 8px 16px rgba(42, 107, 42, 0.12),
                0 4px 8px rgba(247, 201, 72, 0.1);
            border-color: var(--color-jaune);
        }

        .categories-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            transition: all 0.4s ease;
            filter: brightness(0.98) contrast(1.02);
        }

        .categories-card:hover .categories-image {
            transform: scale(1.1) rotate(3deg);
            filter: brightness(1.05) contrast(1.08) saturate(1.1);
        }

        .categories-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    rgba(42, 107, 42, 0.1),
                    rgba(247, 201, 72, 0.1),
                    rgba(255, 255, 255, 0.05));
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        .categories-card:hover .categories-overlay {
            opacity: 1;
        }

        .categories-name {
            color: var(--color-vert) !important;
            transition: all 0.3s ease;
            font-size: 1.1rem;
            margin-top: 15px !important;
            font-weight: 700 !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 3;
        }

        .categories-card:hover .categories-name {
            color: var(--color-jaune) !important;
            transform: translateY(-3px);
            text-shadow: 0 2px 4px rgba(247, 201, 72, 0.2);
        }

        /* Navigation carousel */
        .categories-prev,
        .categories-next {
            background: rgba(42, 107, 42, 0.8) !important;
            border-radius: 50% !important;
            width: 45px !important;
            height: 45px !important;
            border: 2px solid rgba(255, 255, 255, 0.3) !important;
            transition: all 0.3s ease !important;
        }

        .categories-prev:hover,
        .categories-next:hover {
            background: var(--color-vert) !important;
            border-color: white !important;
            transform: scale(1.1) !important;
        }

        /* Animation d'apparition */
        @keyframes categoriesAppear {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .categories-card {
            animation: categoriesAppear 0.6s ease forwards;
        }

        /* Délai d'apparition pour chaque carte */
        .categories-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .categories-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .categories-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .categories-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .categories-title {
                font-size: 2rem !important;
            }

            .categories-image-container {
                width: 110px;
                height: 110px;
            }

            .categories-card {
                padding: 22px;
            }
        }

        @media (max-width: 768px) {
            .categories-title {
                font-size: 1.7rem !important;
                margin-bottom: 1.5rem !important;
            }

            .categories-image-container {
                width: 100px;
                height: 100px;
            }

            .categories-name {
                font-size: 1rem !important;
                margin-top: 12px !important;
            }

            .categories-card {
                padding: 20px;
            }

            .categories-card:hover {
                transform: translateY(-8px) scale(1.01);
            }

            .categories-prev,
            .categories-next {
                width: 40px !important;
                height: 40px !important;
            }
        }

        @media (max-width: 576px) {
            .categories-title {
                font-size: 1.5rem !important;
            }

            .categories-image-container {
                width: 90px;
                height: 90px;
            }

            .categories-card {
                padding: 18px;
            }

            .categories-name {
                font-size: 0.9rem !important;
            }
        }

        /* États de focus pour l'accessibilité */
        .categories-card a:focus {
            outline: 2px solid var(--color-vert);
            outline-offset: 3px;
        }

        /* Micro-interactions */
        .categories-card:active {
            transform: translateY(-8px) scale(0.98);
        }
    </style>
@endpush
<section class="categories-section container mb-5">
    <h2 class="text-center mb-4 fw-bold title categories-title">Nos Catégories</h2>
    <div id="categoriesCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($categories->chunk(4) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                    <div class="row justify-content-center g-4">
                        @foreach ($chunk as $categorie)
                            <div class="col-6 col-md-3">
                                <div class="categories-card text-center">
                                    <a href="{{ route('boutique.categorie', ['slug' => $categorie->slug]) }}"
                                        class="text-decoration-none text-dark d-block">
                                        <div class="categories-image-container position-relative mb-3">
                                            <img src="{{ $categorie->getFirstMediaUrl('image') ?: asset('front/images/logo.png') }}"
                                                class="categories-image" alt="{{ $categorie->libelle }}">
                                            <div class="categories-overlay"></div>
                                        </div>
                                        <h5 class="categories-name fw-bold mb-0">{{ $categorie->libelle }}</h5>
                                        {{-- <small class="text-muted">{{ $categorie->produits()->count() }} produit(s)</small> --}}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev categories-prev" type="button" data-bs-target="#categoriesCarousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" style="filter:invert(1);"></span>
        </button>
        <button class="carousel-control-next categories-next" type="button" data-bs-target="#categoriesCarousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" style="filter:invert(1);"></span>
        </button>
    </div>
</section>
