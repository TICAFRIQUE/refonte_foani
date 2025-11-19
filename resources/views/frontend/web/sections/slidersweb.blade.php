{{-- filepath: c:\laragon\www\foani\resources\views\frontend\web\sections\slidersweb.blade.php --}}
@push('styles')
    <style>
       .owl-carousel .owl-item img {
            width: 100%;
            /* height: 500px; */
            object-fit: cover;
       }

       .owl-theme .owl-nav {
            display: none;
       }


        /* Responsive Design - Mobile First */
        @media (max-width: 576px) {
            .owl-carousel .owl-item img {
                padding-top: 100px;
            }
        }
        @media (min-width: 577px) and (max-width: 767px) {
            .owl-carousel .owl-item img {
               
                padding-top: 100px
            }
        }


        @media (max-width: 767px) {
            .owl-carousel .owl-item img {
               
                padding-top: 100px
            }
        }
        

    </style>
@endpush

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

                @if (isset($slider->btn_nom))
                    <div class="main-slider-caption-center">
                        <h1 class="slide-title">{{ $slider->libelle }}</h1>
                        <p class="slide-description">{{ $slider->description ?? 'Découvrez nos produits de qualité' }}
                        </p>
                        <a href="{{ $slider->url ?? route('boutique.index') }}" class="btn btn-cta-slider slide-button">
                            <i class="bi bi-cart-plus"></i>
                            {{ $slider->btn_nom ?? 'Commander maintenant' }}
                        </a>
                    </div>
                @endif

                {{-- Barre de progression --}}
                <div class="slide-progress"></div>
            </div>
        @empty
            {{-- Slide par défaut si aucun slider --}}
            <div class="item">
                <img src="{{ asset('front/images/sliders/default.jpg') }}" alt="Foani - Volailles Fraîches">
                <div class="main-slider-caption-center">
                    <h1 class="slide-title">Volailles Fraîches FOANI</h1>
                    <p class="slide-description">Découvrez notre sélection de volailles de qualité premium depuis plus
                        de 15 ans</p>
                    <a href="{{ route('boutique.index') }}" class="btn btn-cta-slider slide-button">
                        <i class="bi bi-shop"></i>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function() {
            const slider = $("#mainSliderOwl");
            const loadingElement = $("#slider-loading");

            // Fonction pour appliquer les animations
            function applyAnimations(slide) {
                const caption = slide.find('.main-slider-caption-center');
                const progress = slide.find('.slide-progress');

                // Reset animations
                caption.removeClass('animate-bounce-in');

                // Apply new animation
                setTimeout(() => {
                    caption.addClass('animate-bounce-in');
                }, 200);

                // Animation de la barre de progression
                progress.css('width', '0%');
                setTimeout(() => {
                    progress.css('width', '100%');
                }, 300);
            }

            // Optimisation du ratio d'image selon l'orientation
            function optimizeImageDisplay() {
                $('.owl-carousel .item img').each(function() {
                    const img = this;
                    if (img.complete) {
                        const ratio = img.naturalWidth / img.naturalHeight;
                        const containerRatio = $(img).parent().width() / $(img).parent().height();

                        if (Math.abs(ratio - containerRatio) < 0.1) {
                            // Si les ratios sont similaires, on peut utiliser cover
                            $(img).css('object-fit', 'cover');
                        } else {
                            // Sinon on garde contain pour préserver les proportions
                            $(img).css('object-fit', 'contain');
                        }
                    }
                });
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
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                smartSpeed: 1000,
                touchDrag: true,
                mouseDrag: true,
                responsive: {
                    0: {
                        nav: true,
                        autoplayTimeout: 5000,
                        smartSpeed: 800
                    },
                    768: {
                        nav: true,
                        autoplayTimeout: 6000,
                        smartSpeed: 1000
                    },
                    992: {
                        nav: true,
                        autoplayTimeout: 6000,
                        smartSpeed: 1000
                    }
                }
            };

            // Initialisation du carousel
            slider.owlCarousel(owlConfig);

            // Animation du premier slide
            setTimeout(() => {
                applyAnimations(slider.find(".owl-item.active"));
                optimizeImageDisplay();
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
                optimizeImageDisplay();
            });

            // Touch swipe amélioré pour mobile
            let startX = 0;
            let endX = 0;

            slider.on('touchstart', function(e) {
                startX = e.originalEvent.touches[0].clientX;
            });

            slider.on('touchend', function(e) {
                endX = e.originalEvent.changedTouches[0].clientX;
                const diff = startX - endX;

                if (Math.abs(diff) > 50) {
                    if (diff > 0) {
                        slider.trigger('next.owl.carousel');
                    } else {
                        slider.trigger('prev.owl.carousel');
                    }
                }
            });

            // Accessibility enhancements
            slider.find('.owl-nav button').attr('aria-label', function(index) {
                return index === 0 ? 'Slide précédent' : 'Slide suivant';
            });

            // Gestion des erreurs d'images
            slider.find('img').on('error', function() {
                $(this).attr('src', '{{ asset('front/images/sliders/default.jpg') }}');
                $(this).css('object-fit', 'cover'); // Fallback en cover pour l'image par défaut
            });

            // Optimisation lors du chargement des images
            slider.find('img').on('load', function() {
                optimizeImageDisplay();
            });

            // Redimensionnement intelligent
            let resizeTimer;
            $(window).on('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    slider.trigger('refresh.owl.carousel');
                    optimizeImageDisplay();
                }, 150);
            });

            // Pause au focus pour l'accessibilité
            slider.on('focusin', function() {
                slider.trigger('stop.owl.autoplay');
            });

            slider.on('focusout', function() {
                slider.trigger('play.owl.autoplay', [6000]);
            });

            // Optimisation performance - observer pour pause hors vue
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            slider.trigger('play.owl.autoplay', [6000]);
                        } else {
                            slider.trigger('stop.owl.autoplay');
                        }
                    });
                }, {
                    threshold: 0.5
                });

                observer.observe(slider[0]);
            }
        });
    </script>
@endpush
