{{-- filepath: c:\laragon\www\foani\resources\views\frontend\sections\categories_liste.blade.php --}}

<section class="container mb-5">
    <h2 class="text-center mb-4 fw-bold title">Nos Catégories</h2>
    <div id="categoriesCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($categories->chunk(4) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                    <div class="row justify-content-center g-4">
                        @foreach ($chunk as $categorie)
                            <div class="col-6 col-md-3">
                                <div class="category-card text-center">
                                    <a href="{{ route('boutique.categorie', ['slug' => $categorie->slug]) }}"
                                        class="text-decoration-none text-dark d-block">
                                        <div class="image-container position-relative mb-3">
                                            <img src="{{ $categorie->getFirstMediaUrl('image') ?: asset('front/images/logo.png') }}"
                                                class="category-image"
                                                alt="{{ $categorie->libelle }}">
                                            <div class="image-overlay"></div>
                                        </div>
                                        <h5 class="category-name fw-bold mb-0">{{ $categorie->libelle }}</h5>
                                        {{-- <small class="text-muted">{{ $categorie->produits()->count() }} produit(s)</small> --}}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#categoriesCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" style="filter:invert(1);"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#categoriesCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" style="filter:invert(1);"></span>
        </button>
    </div>
</section>

@push('styles')
<style>
    .category-card {
        padding: 25px;
        background: linear-gradient(145deg, #ffffff, #f0f2f5);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        position: relative;
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 
            0 8px 32px rgba(0, 0, 0, 0.1),
            0 4px 16px rgba(0, 0, 0, 0.05),
            inset 0 1px 0 rgba(255, 255, 255, 0.6),
            inset 0 -1px 0 rgba(0, 0, 0, 0.05);
        transform: perspective(1000px) rotateX(0deg) rotateY(0deg);
    }

    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(42, 107, 42, 0.02), rgba(247, 201, 72, 0.02));
        border-radius: 20px;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .category-card:hover {
        transform: perspective(1000px) rotateX(5deg) rotateY(5deg) translateY(-12px);
        box-shadow: 
            0 20px 50px rgba(0, 0, 0, 0.15),
            0 10px 25px rgba(42, 107, 42, 0.1),
            0 5px 15px rgba(247, 201, 72, 0.1),
            inset 0 2px 0 rgba(255, 255, 255, 0.8),
            inset 0 -2px 0 rgba(0, 0, 0, 0.1);
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
    }

    .category-card:hover::before {
        opacity: 1;
    }

    .image-container {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        border-radius: 50%;
        overflow: hidden;
        position: relative;
        box-shadow: 
            0 8px 20px rgba(0, 0, 0, 0.15),
            0 4px 10px rgba(42, 107, 42, 0.1),
            inset 0 2px 4px rgba(255, 255, 255, 0.3);
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        background: linear-gradient(145deg, #ffffff, #f0f2f5);
    }

    .category-card:hover .image-container {
        transform: scale(1.08) translateZ(20px);
        box-shadow: 
            0 15px 35px rgba(0, 0, 0, 0.2),
            0 8px 20px rgba(42, 107, 42, 0.15),
            0 4px 12px rgba(247, 201, 72, 0.1),
            inset 0 3px 6px rgba(255, 255, 255, 0.4);
    }

    .category-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        transition: all 0.4s ease;
        filter: brightness(0.95) contrast(1.05);
    }

    .category-card:hover .category-image {
        transform: scale(1.1);
        filter: brightness(1.1) contrast(1.1) saturate(1.2);
    }

    .image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, 
            rgba(42, 107, 42, 0.1), 
            rgba(247, 201, 72, 0.1),
            rgba(255, 255, 255, 0.1)
        );
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .category-card:hover .image-overlay {
        opacity: 1;
    }

    .category-name {
        color: #2a6b2a;
        transition: all 0.3s ease;
        font-size: 1.1rem;
        margin-top: 12px;
        font-weight: 600;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .category-card:hover .category-name {
        color: #f7c948;
        transform: translateY(-2px);
        text-shadow: 0 2px 4px rgba(247, 201, 72, 0.3);
    }

    .text-muted {
        transition: all 0.3s ease;
    }

    .category-card:hover .text-muted {
        color: #6c757d !important;
        transform: translateY(-1px);
    }

    /* Animation pour l'apparition */
    @keyframes categoryAppear {
        from {
            opacity: 0;
            transform: perspective(1000px) rotateX(-30deg) translateY(20px);
        }
        to {
            opacity: 1;
            transform: perspective(1000px) rotateX(0deg) translateY(0px);
        }
    }

    .category-card {
        animation: categoryAppear 0.6s ease forwards;
    }

    /* Délai d'apparition pour chaque carte */
    .category-card:nth-child(1) { animation-delay: 0.1s; }
    .category-card:nth-child(2) { animation-delay: 0.2s; }
    .category-card:nth-child(3) { animation-delay: 0.3s; }
    .category-card:nth-child(4) { animation-delay: 0.4s; }

    /* Responsive */
    @media (max-width: 768px) {
        .image-container {
            width: 100px;
            height: 100px;
        }
        
        .category-name {
            font-size: 1rem;
        }
        
        .category-card {
            padding: 20px;
        }

        .category-card:hover {
            transform: perspective(800px) rotateX(3deg) rotateY(3deg) translateY(-8px);
        }
    }

    /* Gloss effect */
    .category-card::after {
        content: '';
        position: absolute;
        top: 10px;
        left: 10px;
        right: 10px;
        height: 50%;
        background: linear-gradient(180deg, 
            rgba(255, 255, 255, 0.1) 0%, 
            rgba(255, 255, 255, 0.05) 50%, 
            transparent 100%
        );
        border-radius: 15px 15px 0 0;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .category-card:hover::after {
        opacity: 1;
    }
</style>
@endpush