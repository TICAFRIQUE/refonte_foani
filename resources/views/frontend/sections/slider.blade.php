{{-- filepath: c:\laragon\www\foani\resources\views\frontend\sections\slider.blade.php --}}
<style>
    /* Container principal du slider */
    .slider-section {
        position: relative;
        overflow: hidden;
        border-radius: 0 0 25px 25px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        margin-bottom: 40px;
    }

    /* Items du carousel */
    .owl-carousel .item {
        position: relative;
        height: auto;
        overflow: hidden;
        border-radius: 0;
    }

    .owl-carousel .item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /* background: linear-gradient(135deg,
            rgba(42, 107, 42, 0.4) 0%,
            rgba(42, 107, 42, 0.2) 50%,
            rgba(0, 0, 0, 0.3) 100%); */
        z-index: 1;
    }

    .owl-carousel .item img {
        width: 100%;
        height: auto;
        /* max-height: 400px; */
        object-fit: cover;
        object-position: center;
        display: block;
        transition: transform 0.8s ease;
        padding: 0;
        margin: 0;
    }

    .owl-carousel .item:hover img {
        transform: scale(1.02);
    }

    /* Caption centrée sur toutes les tailles d'écran */
    .main-slider-caption-center {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-width: 500px;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        z-index: 2;
    }

    .main-slider-caption-center h1 {
        font-size: 2.8rem;
        font-weight: 800;
        color: white;
        margin-bottom: 15px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        line-height: 1.1;
        letter-spacing: -0.5px;
    }

    .main-slider-caption-center p {
        font-size: 1.2rem;
        color: white;
        margin-bottom: 25px;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
        opacity: 0.95;
        font-weight: 500;
    }

    /* Bouton CTA moderne - TOUJOURS CENTRÉ */
    .btn-cta-slider {
        background: linear-gradient(135deg, var(--color-jaune), #f39c12);
        border: none;
        color: #333;
        padding: 15px 35px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 6px 20px rgba(241, 196, 15, 0.4);
        position: relative;
        overflow: hidden;
        min-width: 250px;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-cta-slider::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .btn-cta-slider:hover::before {
        left: 100%;
    }

    .btn-cta-slider:hover {
        background: linear-gradient(135deg, #f1c40f, #e67e22);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(241, 196, 15, 0.6);
        color: #333;
    }

    .btn-cta-slider i {
        transition: transform 0.3s ease;
    }

    .btn-cta-slider:hover i {
        transform: translateX(3px);
    }

    /* Contrôles Owl Carousel stylés */
    .owl-dots {
        text-align: center;
        padding: 20px 0 10px;
        margin: 0;
    }

    .owl-dot {
        display: inline-block;
        margin: 0 8px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(42, 107, 42, 0.3);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .owl-dot.active {
        background: var(--color-vert);
        transform: scale(1.3);
        box-shadow: 0 0 10px rgba(42, 107, 42, 0.5);
    }

    .owl-dot::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .owl-dot.active::after {
        border-color: var(--color-vert);
    }

    /* Navigation arrows */
    .owl-nav {
        position: absolute;
        top: 50%;
        width: 100%;
        transform: translateY(-50%);
        z-index: 3;
        pointer-events: none;
    }

    .owl-nav button {
        position: absolute;
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        pointer-events: all;
        backdrop-filter: blur(5px);
    }

    .owl-nav button:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: white;
        transform: scale(1.1);
    }

    .owl-prev {
        left: 20px;
    }

    .owl-next {
        right: 20px;
    }

    /* Indicateur de progression */
    .slide-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        background: var(--color-vert);
        z-index: 2;
        transition: width 5s linear;
    }

    /* Responsive Design - Mobile First */
    @media (max-width: 576px) {
        .slider-section {
            border-radius: 0 0 15px 15px;
            margin-bottom: 20px;
        }

        .owl-carousel .item img {
            max-height: none;
            height: auto;
            object-fit: contain;
            padding: 0 !important;
            margin: 0 !important;
        }

        .main-slider-caption-center {
            width: 35%;
            max-width: none;
            padding: 0 !important;
        }

        .main-slider-caption-center h1 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .main-slider-caption-center p {
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .btn-cta-slider {
            padding: 10px 15px;
            font-size: 0.7rem;
            min-width: 100px;
        }

        .owl-dots {
            padding: 15px 0 5px;
        }

        .owl-dot {
            width: 10px;
            height: 10px;
            margin: 0 6px;
        }

        .owl-nav button {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .owl-prev {
            left: 10px;
        }

        .owl-next {
            right: 10px;
        }
    }

    @media (min-width: 577px) and (max-width: 768px) {
        .slider-section {
            border-radius: 0 0 20px 20px;
            margin-bottom: 25px;
        }

        .owl-carousel .item img {
            max-height: 350px;
            padding: 0 !important;
        }

        .main-slider-caption-center {
            width: 90%;
            max-width: 400px;
        }

        .main-slider-caption-center h1 {
            font-size: 2rem;
            margin-bottom: 12px;
        }

        .main-slider-caption-center p {
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .btn-cta-slider {
            padding: 13px 30px;
            font-size: 1rem;
            min-width: 220px;
        }
    }

    @media (min-width: 769px) and (max-width: 992px) {
        .owl-carousel .item img {
            max-height: 380px;
        }

        .main-slider-caption-center h1 {
            font-size: 2.4rem;
        }

        .main-slider-caption-center p {
            font-size: 1.1rem;
        }

        .btn-cta-slider {
            padding: 14px 32px;
            font-size: 1.05rem;
            min-width: 240px;
        }
    }

    @media (min-width: 993px) {
        .owl-carousel .item img {
            max-height: 400px;
        }

        .main-slider-caption-center {
            max-width: 500px;
        }
    }

    /* Animations personnalisées */
    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.8);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translate(-50%, -30%) translateY(30px);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%) translateY(0);
        }
    }

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.3);
        }
        50% {
            transform: translate(-50%, -50%) scale(1.05);
        }
        70% {
            transform: translate(-50%, -50%) scale(0.9);
        }
        100% {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    }

    /* Classes d'animation personnalisées */
    .animate-fade-scale {
        animation: fadeInScale 0.8s ease-out;
    }

    .animate-slide-up {
        animation: slideInUp 0.8s ease-out;
    }

    .animate-bounce-in {
        animation: bounceIn 1s ease-out;
    }

    /* Loading state */
    .slider-loading {
        height: 300px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0 0 25px 25px;
    }

    .spinner-slider {
        width: 40px;
        height: 40px;
        border: 4px solid #e9ecef;
        border-top: 4px solid var(--color-vert);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>

<section class="slider-section">
    {{-- Loading state --}}
    <div class="slider-loading d-none" id="slider-loading">
        <div class="spinner-slider"></div>
    </div>

    <div class="owl-carousel owl-theme" id="mainSliderOwl">
        @forelse ($sliders as $index => $slider)
            <div class="item" data-slide="{{ $index }}">
                <img src="{{ $slider->getFirstMediaUrl('image') ?: asset('front/images/sliders/default.jpg') }}"
                    alt="{{ $slider->libelle }}" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">

                <div class="main-slider-caption-center">
                    {{-- <h1 class="slide-title">{{ $slider->libelle }}</h1>
                    <p class="slide-description">{{ $slider->description ?? 'Découvrez nos produits de qualité' }}</p> --}}
                    <a href="{{ $slider->url ?? route('boutique.index') }}" class="btn btn-cta-slider slide-button">
                        <i class="bi bi-cart-plus me-2"></i>
                        {{ $slider->btn_nom ?? 'Commander maintenant' }}
                    </a>
                </div>

                {{-- Barre de progression --}}
                <div class="slide-progress"></div>
            </div>
        @empty
            {{-- Slide par défaut si aucun slider --}}
            <div class="item">
                <img src="{{ asset('front/images/sliders/default.jpg') }}" alt="Foani - Volailles Fraîches">
                <div class="main-slider-caption-center">
                    <h1 class="slide-title">Volailles Fraîches</h1>
                    <p class="slide-description">Découvrez notre sélection de volailles de qualité premium</p>
                    <a href="{{ route('boutique.index') }}" class="btn btn-cta-slider slide-button">
                        <i class="bi bi-shop me-2"></i>
                        Découvrir nos produits
                    </a>
                </div>
                <div class="slide-progress"></div>
            </div>
        @endforelse
    </div>
</section>

@push('scripts')
    <!-- OwlCarousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function() {
            const slider = $("#mainSliderOwl");
            const loadingElement = $("#slider-loading");

            // Animations centrées
            const animations = ['animate-fade-scale', 'animate-slide-up', 'animate-bounce-in'];

            // Fonction pour appliquer les animations
            function applyAnimations(slide) {
                const caption = slide.find('.main-slider-caption-center');
                const button = slide.find('.slide-button');
                const progress = slide.find('.slide-progress');

                // Reset animations
                caption.removeClass(animations.join(' '));

                // Apply new animation
                setTimeout(() => {
                    const randomAnim = animations[Math.floor(Math.random() * animations.length)];
                    caption.addClass(randomAnim);
                }, 200);

                // Animation de la barre de progression
                progress.css('width', '0%');
                setTimeout(() => {
                    progress.css('width', '100%');
                }, 300);
            }

            // Configuration du carousel optimisée
            const owlConfig = {
                items: 1,
                loop: true,
                nav: true,
                navText: [
                    '<i class="bi bi-chevron-left"></i>',
                    '<i class="bi bi-chevron-right"></i>'
                ],
                dots: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                smartSpeed: 800,
                responsive: {
                    0: {
                        nav: false,
                        autoplayTimeout: 4000
                    },
                    768: {
                        nav: true,
                        autoplayTimeout: 5000
                    }
                }
            };

            // Initialisation du carousel
            slider.owlCarousel(owlConfig);

            // Animation du premier slide
            setTimeout(() => {
                applyAnimations(slider.find(".owl-item.active"));
            }, 500);

            // Animation lors du changement de slide
            slider.on("changed.owl.carousel", function(event) {
                const currentItem = $(event.target).find(".owl-item").eq(event.item.index);
                applyAnimations(currentItem);
            });

            // Gestion du loading
            slider.on('initialized.owl.carousel', function() {
                loadingElement.addClass('d-none');
                slider.removeClass('d-none');
            });

            // Pause auto-play au hover sur mobile
            if (window.innerWidth <= 768) {
                slider.on('mouseenter', function() {
                    slider.trigger('stop.owl.autoplay');
                });

                slider.on('mouseleave', function() {
                    slider.trigger('play.owl.autoplay');
                });
            }

            // Accessibility enhancements
            slider.find('.owl-nav button').attr('aria-label', function(index) {
                return index === 0 ? 'Slide précédent' : 'Slide suivant';
            });

            // Gestion des erreurs d'images
            slider.find('img').on('error', function() {
                $(this).attr('src', '{{ asset("front/images/sliders/default.jpg") }}');
            });

            // Redimensionnement intelligent
            $(window).on('resize', function() {
                clearTimeout(window.resizeTimer);
                window.resizeTimer = setTimeout(() => {
                    slider.trigger('refresh.owl.carousel');
                }, 100);
            });
        });
    </script>
@endpush