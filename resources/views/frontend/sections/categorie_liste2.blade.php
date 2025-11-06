{{-- filepath: c:\laragon\www\foani\resources\views\frontend\pages\categorie.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Catégories - Foani')
@section('meta_description', 'Découvrez toutes nos catégories de produits : volaille, œufs, alimentation et accessoires
    d\'élevage.')

@section('content')
    <div class="container py-4">
        <!-- Header de la page -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="display-6 fw-bold text-success mb-3">
                    <i class="bi bi-grid-3x3-gap me-2"></i>
                    Nos Catégories
                </h1>
                <p class="lead text-muted">Explorez notre gamme complète de produits avicoles</p>
            </div>
        </div>

        <!-- Carrousel des catégories -->
        <div class="categories-carousel-container">
            <div class="owl-carousel owl-theme categories-carousel">
                @forelse($categories as $categorie)
                    <div class="category-carousel-item">
                        <div class="category-minicard h-100">
                            <!-- Image miniature -->
                            <div class="category-mini-image">
                                @if ($categorie->getFirstMediaUrl('image'))
                                    <img src="{{ $categorie->getFirstMediaUrl('image') }}" alt="{{ $categorie->libelle }}"
                                        loading="lazy">
                                @else
                                    <div class="category-mini-placeholder">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif

                                <!-- Badge produits -->
                                <div class="mini-badge">
                                    {{ $categorie->produits_count ?? 0 }}
                                </div>
                            </div>

                            <!-- Contenu compact -->
                            <div class="category-mini-content">
                                <h6 class="mini-title">{{ $categorie->libelle }}</h6>
                                <a href="{{ route('boutique.index', ['categorie' => $categorie->slug]) }}"
                                    class="btn btn-mini-view">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                        <h5 class="text-muted">Aucune catégorie disponible</h5>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="quick-actions-grid">
                    <a href="{{ route('boutique.index') }}" class="quick-action-btn">
                        <i class="bi bi-shop"></i>
                        <span>Tous les produits</span>
                    </a>
                    <a href="{{ route('boutique.index', ['promotion' => '1']) }}" class="quick-action-btn promotion">
                        <i class="bi bi-percent"></i>
                        <span>Promotions</span>
                    </a>
                    <a href="{{ route('boutique.index', ['nouveaute' => '1']) }}" class="quick-action-btn nouveaute">
                        <i class="bi bi-star"></i>
                        <span>Nouveautés</span>
                    </a>
                    <a href="{{ route('contact') }}" class="quick-action-btn contact">
                        <i class="bi bi-headset"></i>
                        <span>Contact</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Container du carrousel */
        .categories-carousel-container {
            padding: 20px 0;
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            border-radius: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        /* Carrousel Owl */
        .categories-carousel {
            padding: 0 10px;
        }

        .categories-carousel .owl-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            padding: 0 15px;
            pointer-events: none;
        }

        .categories-carousel .owl-nav button {
            background: rgba(85, 158, 51, 0.9) !important;
            color: white !important;
            border-radius: 50% !important;
            width: 40px !important;
            height: 40px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border: none !important;
            font-size: 18px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15) !important;
            transition: all 0.3s ease !important;
            pointer-events: all;
        }

        .categories-carousel .owl-nav .owl-prev {
            position: absolute;
            left: -15px;
        }

        .categories-carousel .owl-nav .owl-next {
            position: absolute;
            right: -15px;
        }

        .categories-carousel .owl-nav button:hover {
            background: rgba(85, 158, 51, 1) !important;
            transform: scale(1.1) !important;
        }

        .categories-carousel .owl-dots {
            text-align: center;
            margin-top: 20px;
        }

        .categories-carousel .owl-dots .owl-dot {
            display: inline-block;
            margin: 0 4px;
        }

        .categories-carousel .owl-dots .owl-dot span {
            width: 8px;
            height: 8px;
            background: #ccc;
            border-radius: 50%;
            display: block;
            transition: all 0.3s ease;
        }

        .categories-carousel .owl-dots .owl-dot.active span {
            background: #559e33;
            transform: scale(1.2);
        }

        /* Cartes miniatures des catégories */
        .category-minicard {
            background: white;
            border-radius: 16px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            margin: 10px 5px;
            min-height: 140px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .category-minicard:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 30px rgba(85, 158, 51, 0.15);
        }

        /* Image miniature */
        .category-mini-image {
            width: 60px;
            height: 60px;
            margin: 0 auto 12px;
            position: relative;
            border-radius: 50%;
            overflow: hidden;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .category-mini-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .category-minicard:hover .category-mini-image img {
            transform: scale(1.1);
        }

        .category-mini-placeholder {
            color: #ccc;
            font-size: 24px;
        }

        /* Badge mini */
        .mini-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 600;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        /* Contenu mini */
        .category-mini-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .mini-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            line-height: 1.2;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .btn-mini-view {
            background: linear-gradient(135deg, #559e33, #4CAF50);
            border: none;
            color: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .btn-mini-view:hover {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            transform: scale(1.1);
            color: white;
        }

        /* Actions rapides en grille */
        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .quick-action-btn {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 16px;
            padding: 20px 15px;
            text-decoration: none;
            color: #495057;
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            min-height: 100px;
            justify-content: center;
        }

        .quick-action-btn i {
            font-size: 24px;
            margin-bottom: 4px;
        }

        .quick-action-btn span {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .quick-action-btn:hover {
            transform: translateY(-3px);
            color: white;
            border-color: transparent;
        }

        .quick-action-btn:hover {
            background: linear-gradient(135deg, #559e33, #4CAF50);
        }

        .quick-action-btn.promotion:hover {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: #333;
        }

        .quick-action-btn.nouveaute:hover {
            background: linear-gradient(135deg, #17a2b8, #20c997);
        }

        .quick-action-btn.contact:hover {
            background: linear-gradient(135deg, #6f42c1, #8e44ad);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .categories-carousel-container {
                padding: 15px 0;
                margin: 0 -15px 20px;
                border-radius: 0;
            }

            .category-minicard {
                margin: 10px 3px;
                padding: 12px;
                min-height: 120px;
            }

            .category-mini-image {
                width: 50px;
                height: 50px;
                margin-bottom: 8px;
            }

            .mini-title {
                font-size: 0.8rem;
            }

            .btn-mini-view {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }

            .mini-badge {
                width: 18px;
                height: 18px;
                font-size: 9px;
            }

            .quick-actions-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .quick-action-btn {
                padding: 15px 10px;
                min-height: 80px;
            }

            .quick-action-btn i {
                font-size: 20px;
            }

            .quick-action-btn span {
                font-size: 0.8rem;
            }

            .categories-carousel .owl-nav button {
                width: 35px !important;
                height: 35px !important;
                font-size: 16px !important;
            }
        }

        @media (max-width: 576px) {
            .quick-actions-grid {
                grid-template-columns: 1fr;
                max-width: 250px;
                margin: 20px auto 0;
            }
        }

        /* Animation de chargement */
        .category-carousel-item {
            animation: fadeInScale 0.6s ease-out;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
@endpush

@push('scripts')
    <!-- OwlCarousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialisation du carrousel
            $('.categories-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                smartSpeed: 600,
                responsive: {
                    0: {
                        items: 2,
                        margin: 5
                    },
                    480: {
                        items: 3,
                        margin: 8
                    },
                    768: {
                        items: 4,
                        margin: 10
                    },
                    992: {
                        items: 5,
                        margin: 15
                    },
                    1200: {
                        items: 6,
                        margin: 15
                    }
                },
                navText: [
                    '<i class="bi bi-chevron-left"></i>',
                    '<i class="bi bi-chevron-right"></i>'
                ],
                onInitialized: function() {
                    // Animation des éléments après initialisation
                    $('.category-minicard').each(function(index) {
                        $(this).css('animation-delay', (index * 0.1) + 's');
                    });
                }
            });

            // Gestion du touch/swipe pour mobile
            let startX = 0;
            let currentX = 0;
            let carousel = $('.categories-carousel');

            $('.categories-carousel').on('touchstart', function(e) {
                startX = e.touches[0].clientX;
            });

            $('.categories-carousel').on('touchmove', function(e) {
                e.preventDefault();
                currentX = e.touches[0].clientX;
            });

            $('.categories-carousel').on('touchend', function(e) {
                let diffX = startX - currentX;
                if (Math.abs(diffX) > 50) {
                    if (diffX > 0) {
                        carousel.trigger('next.owl.carousel');
                    } else {
                        carousel.trigger('prev.owl.carousel');
                    }
                }
            });

            // Effet parallax léger sur scroll
            let ticking = false;

            function updateParallax() {
                let scrolled = window.pageYOffset;
                let parallax = $('.categories-carousel-container');
                let speed = scrolled * 0.1;
                parallax.css('transform', 'translateY(' + speed + 'px)');
                ticking = false;
            }

            window.addEventListener('scroll', function() {
                if (!ticking) {
                    requestAnimationFrame(updateParallax);
                    ticking = true;
                }
            });

            // Animation au survol des cartes
            $('.category-minicard').hover(
                function() {
                    $(this).find('.category-mini-image img').css('transform', 'scale(1.2) rotate(5deg)');
                    $(this).find('.mini-badge').css('transform', 'scale(1.2) rotate(-10deg)');
                },
                function() {
                    $(this).find('.category-mini-image img').css('transform', 'scale(1) rotate(0deg)');
                    $(this).find('.mini-badge').css('transform', 'scale(1) rotate(0deg)');
                }
            );

            // Haptic feedback pour mobile
            if ('vibrate' in navigator) {
                $('.category-minicard, .quick-action-btn').on('touchstart', function() {
                    navigator.vibrate(10);
                });
            }

            // Lazy loading amélioré
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver(function(entries) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.style.opacity = '1';
                            img.style.transform = 'scale(1)';
                            imageObserver.unobserve(img);
                        }
                    });
                });

                document.querySelectorAll('.category-mini-image img').forEach(img => {
                    img.style.opacity = '0';
                    img.style.transform = 'scale(0.8)';
                    img.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    imageObserver.observe(img);
                });
            }
        });
    </script>
@endpush
