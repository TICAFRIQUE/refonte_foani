<div id="mainSlider" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <img src="{{ asset('front/images/sliders/13.jpg') }}" class="d-block w-100" alt="Volaille Fraîche & Locale">
            <div
                class="main-slider-caption-right carousel-caption-right d-flex flex-column justify-content-center align-items-start text-start p-4">
                <h1 class="display-5 fw-bold text-white">Poulet de Chair</h1>
                <p class="text-white">Le vrai goût du poulet</p>
                <a href="#" class="btn btn-cta btn-lg mt-3">Commander</a>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="{{ asset('front/images/sliders/10.jpg') }}" class="d-block w-100" alt="Œufs Fermiers">
            <div
                class="main-slider-caption-right carousel-caption-right d-flex flex-column justify-content-center align-items-start text-start p-4">
                <h1 class="display-5 fw-bold text-white">Œufs Fermiers</h1>
                <p class="text-white">Des œufs frais et savoureux issus de poules heureuses</p>
                <a href="#" class="btn btn-cta btn-lg mt-3">Commander</a>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <img src="{{ asset('front/images/sliders/11.jpg') }}" class="d-block w-100" alt="Produits Transformés">
            <div
                class="main-slider-caption-right carousel-caption-right d-flex flex-column justify-content-center align-items-start text-start p-4">
                <h1 class="display-5 fw-bold text-white">Produits Transformés</h1>
                <p class="text-white">Découvrez notre gamme de produits dérivés</p>
                <a href="#" class="btn btn-cta btn-lg mt-3">Commander</a>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('mainSlider');

        // Liste d'animations Animate.css
        const animations = [
            "animate__fadeInDown",
            "animate__fadeInUp",
            "animate__fadeInLeft",
            "animate__fadeInRight",
            "animate__zoomIn",
            "animate__lightSpeedInRight",
            "animate__bounceIn",
            "animate__jackInTheBox",
            "animate__rollIn",
            "animate__flipInX"
        ];

        function applyRandomAnimations(slide) {
            const elements = slide.querySelectorAll("h1, p, a");
            elements.forEach((el, index) => {
                // Retirer anciennes classes d'animation
                el.classList.remove("animate__animated", ...animations);

                // Forcer le reflow pour relancer l'animation
                void el.offsetWidth;

                // Choisir une animation aléatoire
                const randomAnim = animations[Math.floor(Math.random() * animations.length)];

                // Ajouter Animate.css avec un délai progressif
                el.classList.add("animate__animated", randomAnim, `animate__delay-${index}s`);
            });
        }

        // Appliquer sur le premier slide
        applyRandomAnimations(document.querySelector(".carousel-item.active"));

        // Appliquer sur chaque changement de slide
        carousel.addEventListener("slid.bs.carousel", function(event) {
            applyRandomAnimations(event.relatedTarget);
        });


        const transitions = [
            'carousel-fade',
            'carousel-zoom',
            'carousel-rotate-y',
            'carousel-rotate-x',
            'carousel-slide-left',
            'carousel-slide-up',
            'carousel-flip'
        ];

        const applyRandomTransition = () => {
            // Enlever les anciennes transitions
            transitions.forEach(cls => carousel.classList.remove(cls));

            // Ajouter une transition aléatoire
            const randomTransition = transitions[Math.floor(Math.random() * transitions.length)];
            carousel.classList.add(randomTransition);
        };

        // Bootstrap carousel instance
        const carouselInstance = bootstrap.Carousel.getOrCreateInstance(carousel);

        // Appliquer une transition au chargement
        applyRandomTransition();

        // Changer de transition à chaque slide
        carousel.addEventListener('slide.bs.carousel', () => {
            applyRandomTransition();
        });
    });
</script>

<style>
    @media (max-width: 767px) {
        .main-slider-caption-right {
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            top: auto !important;
            width: 100% !important;
            padding: 1rem !important;
            text-align: center !important;
            align-items: center !important;
            justify-content: flex-end !important;
            background: rgba(42, 107, 42, 0.25);
            border-radius: 0 0 16px 16px;
        }

        .main-slider-caption-right h1 {
            font-size: 1.3rem !important;
            margin-bottom: 0.5rem !important;
        }

        .main-slider-caption-right p {
            font-size: 1rem !important;
            margin-bottom: 0.5rem !important;
        }

        .main-slider-caption-right .btn {
            font-size: 1rem !important;
            padding: 0.5rem 1.2rem !important;
        }

        .carousel-item img {
            min-height: 220px;
            object-fit: cover;
        }
    }
</style>
