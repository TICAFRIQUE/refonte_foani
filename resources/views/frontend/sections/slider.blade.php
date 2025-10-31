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
        height: 400px;
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
        background: linear-gradient(135deg, 
            rgba(42, 107, 42, 0.4) 0%, 
            rgba(42, 107, 42, 0.2) 50%, 
            rgba(0, 0, 0, 0.3) 100%);
        z-index: 1;
    }

    .owl-carousel .item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        transition: transform 0.8s ease;
    }

    .owl-carousel .item:hover img {
        transform: scale(1.05);
    }

    /* Caption moderne et responsive */
    .main-slider-caption-right {
        position: absolute;
        right: 0;
        top: 0;
        width: 50%;
        height: 100%;
        padding: 3rem 3rem 3rem 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;
        text-align: right;
        z-index: 2;
        background: linear-gradient(90deg, 
            transparent 0%, 
            rgba(42, 107, 42, 0.1) 30%, 
            rgba(42, 107, 42, 0.25) 100%);
        backdrop-filter: blur(2px);
    }

    .main-slider-caption-right h1 {
        font-size: 2.8rem;
        font-weight: 800;
        color: white;
        margin-bottom: 15px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        line-height: 1.1;
        letter-spacing: -0.5px;
    }

    .main-slider-caption-right p {
        font-size: 1.2rem;
        color: white;
        margin-bottom: 25px;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4);
        opacity: 0.95;
        font-weight: 500;
    }

    /* Bouton CTA moderne */
    .btn-cta-slider {
        background: linear-gradient(135deg, var(--color-jaune), #f39c12);
        border: none;
        color: #333;
        padding: 15px 35px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 4px 15px rgba(241, 196, 15, 0.4);
        position: relative;
        overflow: hidden;
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
        box-shadow: 0 8px 25px rgba(241, 196, 15, 0.6);
        color: #333;
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

    /* Navigation arrows (optionnel) */
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
        background: rgba(255, 255, 255, 0.1);
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
        background: rgba(255, 255, 255, 0.2);
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

    /* Responsive Design */
    @media (max-width: 992px) {
        .owl-carousel .item {
            height: 350px;
        }

        .main-slider-caption-right {
            width: 60%;
            padding: 2.5rem 2rem 2.5rem 1.5rem;
        }

        .main-slider-caption-right h1 {
            font-size: 2.2rem;
        }

        .main-slider-caption-right p {
            font-size: 1.1rem;
        }

        .btn-cta-slider {
            padding: 12px 28px;
            font-size: 1rem;
        }
    }

    @media (max-width: 768px) {
        .slider-section {
            border-radius: 0 0 20px 20px;
            margin-bottom: 30px;
        }

        .owl-carousel .item {
            height: 280px;
        }

        .main-slider-caption-right {
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            padding: 2rem 1.5rem !important;
            text-align: center !important;
            align-items: center !important;
            justify-content: center !important;
            background: linear-gradient(180deg, 
                transparent 0%, 
                rgba(42, 107, 42, 0.3) 40%, 
                rgba(0, 0, 0, 0.6) 100%);
        }

        .main-slider-caption-right h1 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .main-slider-caption-right p {
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .btn-cta-slider {
            padding: 10px 25px;
            font-size: 0.9rem;
        }

        .owl-nav button {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .owl-prev {
            left: 15px;
        }

        .owl-next {
            right: 15px;
        }
    }

    @media (max-width: 576px) {
        .owl-carousel .item {
            height: 250px;
        }

        .main-slider-caption-right {
            padding: 1.5rem 1rem !important;
        }

        .main-slider-caption-right h1 {
            font-size: 1.5rem;
        }

        .main-slider-caption-right p {
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .btn-cta-slider {
            padding: 8px 20px;
            font-size: 0.85rem;
        }

        .owl-dots {
            padding: 15px 0 5px;
        }

        .owl-dot {
            width: 10px;
            height: 10px;
            margin: 0 6px;
        }
    }

    /* Animations personnalisées */
    @keyframes slideInFromRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInFromLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Classes d'animation personnalisées */
    .animate-slide-right {
        animation: slideInFromRight 0.8s ease-out;
    }

    .animate-slide-left {
        animation: slideInFromLeft 0.8s ease-out;
    }

    .animate-fade-up {
        animation: fadeInUp 0.8s ease-out;
    }

    /* Loading state */
    .slider-loading {
        height: 400px;
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
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
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
                     alt="{{ $slider->libelle }}"
                     loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                
                <div class="main-slider-caption-right">
                    <h1 class="slide-title">{{ $slider->libelle }}</h1>
                    <p class="slide-description">{{ $slider->description ?? 'Découvrez nos produits de qualité' }}</p>
                    <a href="{{ $slider->url ?? route('boutique.index') }}" 
                       class="btn btn-cta-slider slide-button">
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
                <div class="main-slider-caption-right">
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
            
            // Animations personnalisées pour les éléments
            const animations = {
                title: ['animate-slide-right', 'animate-slide-left', 'animate__fadeInDown'],
                description: ['animate-fade-up', 'animate__fadeInUp', 'animate__fadeInLeft'],
                button: ['animate__bounceIn', 'animate__zoomIn', 'animate__lightSpeedInRight']
            };

            // Fonction pour appliquer les animations
            function applyAnimations(slide) {
                const title = slide.find('.slide-title');
                const description = slide.find('.slide-description');
                const button = slide.find('.slide-button');
                const progress = slide.find('.slide-progress');

                // Reset animations
                [title, description, button].forEach(el => {
                    el.removeClass(Object.values(animations).flat().join(' '));
                });

                // Apply new animations avec délais
                setTimeout(() => {
                    const titleAnim = animations.title[Math.floor(Math.random() * animations.title.length)];
                    title.addClass(titleAnim);
                }, 100);

                setTimeout(() => {
                    const descAnim = animations.description[Math.floor(Math.random() * animations.description.length)];
                    description.addClass(descAnim);
                }, 300);

                setTimeout(() => {
                    const btnAnim = animations.button[Math.floor(Math.random() * animations.button.length)];
                    button.addClass(btnAnim);
                }, 500);

                // Animation de la barre de progression
                progress.css('width', '0%');
                setTimeout(() => {
                    progress.css('width', '100%');
                }, 200);
            }

            // Configuration du carousel
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

            // Lazy loading pour les images
            slider.on('changed.owl.carousel', function(event) {
                const items = $(event.target).find('.owl-item');
                items.each(function() {
                    const img = $(this).find('img');
                    if (img.attr('data-src') && !img.attr('src')) {
                        img.attr('src', img.attr('data-src'));
                    }
                });
            });

            // Performance: Précharger la prochaine image
            slider.on('translate.owl.carousel', function(event) {
                const nextIndex = event.item.index + 1;
                const nextItem = $(event.target).find('.owl-item').eq(nextIndex);
                const nextImg = nextItem.find('img');
                
                if (nextImg.attr('data-src') && !nextImg.attr('src')) {
                    nextImg.attr('src', nextImg.attr('data-src'));
                }
            });
        });
    </script>
@endpush