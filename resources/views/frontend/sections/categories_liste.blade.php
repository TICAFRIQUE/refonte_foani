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
            padding: 10px;
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
            min-width: 0; /* Pour flexbox */
            flex-shrink: 0; /* Empêche la compression */
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

        /* Format carré/rectangulaire pour les images */
        .categories-image-container {
            width: 100%;
            height: auto;
            margin: 0 auto;
            border-radius: 15px; /* Coins arrondis au lieu de rond */
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
            object-fit: contain; /* Garde le cover pour bien remplir */
            border-radius: 12px; /* Coins arrondis assortis */
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
            border-radius: 12px; /* Même arrondi que l'image */
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

        /* Scroll horizontal infini */
        .categories-scroll-container {
            position: relative;
            overflow: hidden;
            margin: 0 50px; /* Espace pour les boutons */
        }

        .categories-scroll-wrapper {
            display: flex;
            gap: 20px;
            transition: transform 0.5s ease;
            will-change: transform;
        }

        .categories-item {
            flex: 0 0 auto;
            width: calc(25% - 15px); /* 4 colonnes sur desktop */
        }

        /* Navigation */
        .categories-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(42, 107, 42, 0.8) !important;
            border-radius: 50% !important;
            width: 45px !important;
            height: 45px !important;
            border: 2px solid rgba(255, 255, 255, 0.3) !important;
            transition: all 0.3s ease !important;
            z-index: 10 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer;
            opacity: 1 !important; /* Toujours visibles pour le scroll infini */
        }

        .categories-nav-prev {
            left: -20px;
        }

        .categories-nav-next {
            right: -20px;
        }

        .categories-nav-btn:hover {
            background: var(--color-vert) !important;
            border-color: white !important;
            transform: translateY(-50%) scale(1.1) !important;
        }

        .categories-nav-btn i {
            font-size: 18px;
            color: white;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .categories-title {
                font-size: 2rem !important;
            }

            .categories-item {
                width: calc(33.333% - 13px); /* 3 colonnes sur tablette */
            }

            .categories-scroll-container {
                margin: 0 40px;
            }

            .categories-nav-btn {
                width: 40px !important;
                height: 40px !important;
            }

            .categories-nav-prev {
                left: -15px;
            }

            .categories-nav-next {
                right: -15px;
            }
        }

        @media (max-width: 768px) {
            .categories-title {
                font-size: 1.7rem !important;
                margin-bottom: 1.5rem !important;
            }

            .categories-item {
                width: calc(50% - 10px); /* 2 colonnes sur mobile */
            }

            .categories-scroll-container {
                margin: 0 35px;
            }

            .categories-nav-btn {
                width: 35px !important;
                height: 35px !important;
            }

            .categories-nav-btn i {
                font-size: 16px;
            }

            .categories-nav-prev {
                left: -10px;
            }

            .categories-nav-next {
                right: -10px;
            }

            .categories-card {
                padding: 10px;
            }

            .categories-card:hover {
                transform: translateY(-8px) scale(1.01);
            }
        }

        @media (max-width: 576px) {
            .categories-title {
                font-size: 1.5rem !important;
            }

            .categories-scroll-container {
                margin: 0 30px;
            }

            .categories-nav-btn {
                width: 30px !important;
                height: 30px !important;
            }

            .categories-nav-btn i {
                font-size: 14px;
            }

            .categories-nav-prev {
                left: -5px;
            }

            .categories-nav-next {
                right: -5px;
            }
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
    
    <div class="categories-scroll-container">
        <div class="categories-scroll-wrapper" id="categoriesWrapper">
            {{-- Première série des catégories --}}
            @foreach ($categories as $categorie)
                <div class="categories-item">
                    <div class="categories-card text-center">
                        <a href="{{ route('boutique.categorie', ['slug' => $categorie->slug]) }}"
                            class="text-decoration-none text-dark d-block">
                            <div class="categories-image-container position-relative mb-3">
                                <img src="{{ $categorie->getFirstMediaUrl('image') ?: asset('front/images/logo.png') }}"
                                    class="categories-image" alt="{{ $categorie->libelle }}">
                                <div class="categories-overlay"></div>
                            </div>
                            <h5 class="categories-name fw-bold mb-0">{{ $categorie->libelle }}</h5>
                        </a>
                    </div>
                </div>
            @endforeach
            
            {{-- Duplication pour le scroll infini --}}
            @foreach ($categories as $categorie)
                <div class="categories-item">
                    <div class="categories-card text-center">
                        <a href="{{ route('boutique.categorie', ['slug' => $categorie->slug]) }}"
                            class="text-decoration-none text-dark d-block">
                            <div class="categories-image-container position-relative mb-3">
                                <img src="{{ $categorie->getFirstMediaUrl('image') ?: asset('front/images/logo.png') }}"
                                    class="categories-image" alt="{{ $categorie->libelle }}">
                                <div class="categories-overlay"></div>
                            </div>
                            <h5 class="categories-name fw-bold mb-0">{{ $categorie->libelle }}</h5>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="categories-nav-btn categories-nav-prev" id="prevBtn">
            <i class="bi bi-chevron-left"></i>
        </div>
        <div class="categories-nav-btn categories-nav-next" id="nextBtn">
            <i class="bi bi-chevron-right"></i>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('categoriesWrapper');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            
            if (!wrapper || !prevBtn || !nextBtn) return;

            const originalItemsCount = {{ count($categories) }};
            const totalItems = originalItemsCount * 2; // Puisqu'on a dupliqué
            let currentIndex = 0;
            let isTransitioning = false;

            // Calculer le nombre d'éléments visibles selon la largeur d'écran
            function getVisibleItems() {
                if (window.innerWidth >= 992) return 4; // Desktop
                if (window.innerWidth >= 768) return 3; // Tablette
                return 2; // Mobile
            }

            function getItemWidth() {
                return wrapper.children[0].offsetWidth + 20; // largeur + gap
            }

            function updatePosition(withTransition = true) {
                if (withTransition) {
                    wrapper.style.transition = 'transform 0.5s ease';
                } else {
                    wrapper.style.transition = 'none';
                }
                
                const moveDistance = getItemWidth() * currentIndex;
                wrapper.style.transform = `translateX(-${moveDistance}px)`;
            }

            function scrollNext() {
                if (isTransitioning) return;
                isTransitioning = true;

                currentIndex++;
                updatePosition();

                // Si on atteint la fin de la première série, on revient au début
                if (currentIndex >= originalItemsCount) {
                    setTimeout(() => {
                        currentIndex = 0;
                        updatePosition(false); // Sans transition pour un retour instantané
                        setTimeout(() => {
                            isTransitioning = false;
                        }, 50);
                    }, 500); // Après la transition
                } else {
                    setTimeout(() => {
                        isTransitioning = false;
                    }, 500);
                }
            }

            function scrollPrev() {
                if (isTransitioning) return;
                isTransitioning = true;

                if (currentIndex <= 0) {
                    // Si on est au début, on va à la fin de la première série
                    currentIndex = originalItemsCount;
                    updatePosition(false); // Sans transition
                    setTimeout(() => {
                        currentIndex = originalItemsCount - 1;
                        updatePosition();
                        setTimeout(() => {
                            isTransitioning = false;
                        }, 500);
                    }, 50);
                } else {
                    currentIndex--;
                    updatePosition();
                    setTimeout(() => {
                        isTransitioning = false;
                    }, 500);
                }
            }

            // Event listeners
            nextBtn.addEventListener('click', scrollNext);
            prevBtn.addEventListener('click', scrollPrev);

            // Auto-scroll infini
            let autoScrollInterval = setInterval(scrollNext, 3000);

            // Arrêter l'auto-scroll au hover et le reprendre
            wrapper.addEventListener('mouseenter', () => {
                clearInterval(autoScrollInterval);
            });

            wrapper.addEventListener('mouseleave', () => {
                autoScrollInterval = setInterval(scrollNext, 3000);
            });

            // Responsive - recalculer lors du redimensionnement
            window.addEventListener('resize', function() {
                updatePosition(false);
            });

            // Initialisation
            updatePosition(false);

            // Support du touch sur mobile
            let startX = 0;
            let isDragging = false;

            wrapper.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                isDragging = true;
                clearInterval(autoScrollInterval);
            });

            wrapper.addEventListener('touchmove', (e) => {
                if (!isDragging) return;
                e.preventDefault();
            });

            wrapper.addEventListener('touchend', (e) => {
                if (!isDragging) return;
                
                const endX = e.changedTouches[0].clientX;
                const diffX = startX - endX;

                if (Math.abs(diffX) > 50) { // Seuil de swipe
                    if (diffX > 0) {
                        scrollNext();
                    } else {
                        scrollPrev();
                    }
                }

                isDragging = false;
                autoScrollInterval = setInterval(scrollNext, 3000);
            });
        });
    </script>
@endpush