@push('styles')
    
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
            height: 100vh;
            overflow: hidden;
            border-radius: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .owl-carousel .item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
                    rgba(40, 64, 147, 0.85) 0%,
                    rgba(63, 94, 184, 0.75) 50%,
                    rgba(108, 122, 224, 0.65) 100%);
            z-index: 1;
        }

        /* Image du slide */
        .slide-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 0;
            transition: transform 8s ease-in-out;
        }

        .owl-carousel .item:hover .slide-image {
            transform: scale(1.05);
        }

        /* Caption centrée sur toutes les tailles d'écran */
        .main-slider-caption-center {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 900px;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            z-index: 2;
        }

        .main-slider-caption-center h1 {
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            line-height: 1.1;
            letter-spacing: -0.5px;
            opacity: 0;
            transform: translateY(50px);
            animation: slideInUp 1s ease-out 0.3s forwards;
        }

        .main-slider-caption-center p {
            font-size: clamp(1rem, 2.5vw, 1.3rem);
            color: white;
            margin-bottom: 2.5rem;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
            opacity: 0;
            font-weight: 400;
            line-height: 1.6;
            transform: translateY(50px);
            animation: slideInUp 1s ease-out 0.6s forwards;
        }

        /* Boutons CTA modernes */
        .carousel-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 10px;
            opacity: 0;
            transform: translateY(50px);
            animation: slideInUp 1s ease-out 0.9s forwards;
        }

        .btn-cta-slider {
            background: linear-gradient(135deg, #ffffff, #f8f9ff);
            border: none;
            color: #284093;
            padding: 14px 35px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.4s ease;
            box-shadow: 0 8px 30px rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            min-width: 220px;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-cta-slider::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-cta-slider:hover::before {
            left: 100%;
        }

        .btn-cta-slider:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 40px rgba(255, 255, 255, 0.3);
            color: #1e2d6f;
        }

        .btn-cta-slider-outline {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.8);
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.4s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 200px;
        }

        .btn-cta-slider-outline:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: white;
            color: white;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 30px rgba(255, 255, 255, 0.2);
        }

        .btn-cta-slider i,
        .btn-cta-slider-outline i {
            transition: transform 0.3s ease;
            margin-right: 8px;
        }

        .btn-cta-slider:hover i,
        .btn-cta-slider-outline:hover i {
            transform: translateX(3px);
        }

        /* Contrôles Owl Carousel stylés */
        .owl-dots {
            text-align: center;
            padding: 25px 0 15px;
            margin: 0;
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
        }

        .owl-dot {
            display: inline-block;
            margin: 0 8px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.6);
            background: transparent;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .owl-dot.active {
            background: white;
            transform: scale(1.2);
            border-color: white;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.4);
        }

        .owl-theme .owl-dots .owl-dot span {
            display: none;
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
            font-size: 1.3rem;
            transition: all 0.3s ease;
            pointer-events: all;
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            outline: none;
        }

        .owl-nav button:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: white;
            transform: scale(1.1);
            opacity: 1;
        }

        .owl-prev {
            left: 30px;
        }

        .owl-next {
            right: 30px;
        }

        .owl-nav button span {
            font-size: 20px;
        }

        /* Indicateur de progression */
        .slide-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, #284093, #6c7ae0);
            z-index: 2;
            transition: width 6s linear;
            width: 0%;
        }

        .slide-progress.active {
            width: 100%;
        }

        /* Animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        /* Reset animations */
        .owl-carousel .owl-item:not(.active) .main-slider-caption-center h1,
        .owl-carousel .owl-item:not(.active) .main-slider-caption-center p,
        .owl-carousel .owl-item:not(.active) .carousel-buttons {
            animation: none;
            opacity: 0;
            transform: translateY(50px);
        }

        /* Active slide animations */
        .owl-carousel .owl-item.active .main-slider-caption-center h1 {
            animation: slideInUp 1s ease-out 0.3s forwards;
        }

        .owl-carousel .owl-item.active .main-slider-caption-center p {
            animation: slideInUp 1s ease-out 0.6s forwards;
        }

        .owl-carousel .owl-item.active .carousel-buttons {
            animation: slideInUp 1s ease-out 0.9s forwards;
        }

        /* Responsive Design - Mobile First */
        @media (max-width: 576px) {
            .slider-section {
                border-radius: 0 0 15px 15px;
                margin-bottom: 20px;
            }

            .owl-carousel .item {
                height: 70vh;
                min-height: 400px;
            }

            .main-slider-caption-center {
                width: 95%;
                max-width: none;
                padding: 0 15px;
            }

            .main-slider-caption-center h1 {
                font-size: 2rem;
                margin-bottom: 1rem;
            }

            .main-slider-caption-center p {
                font-size: 1rem;
                margin-bottom: 1.5rem;
            }

            .carousel-buttons {
                flex-direction: column;
                align-items: center;
                gap: 12px;
            }

            .btn-cta-slider,
            .btn-cta-slider-outline {
                padding: 12px 25px;
                font-size: 0.9rem;
                min-width: 200px;
            }

            .owl-dots {
                padding: 20px 0 10px;
                bottom: 15px;
            }

            .owl-dot {
                width: 10px;
                height: 10px;
                margin: 0 6px;
            }

            .owl-nav button {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
            }

            .owl-prev {
                left: 15px;
            }

            .owl-next {
                right: 15px;
            }
        }

        @media (min-width: 577px) and (max-width: 768px) {
            .slider-section {
                border-radius: 0 0 20px 20px;
                margin-bottom: 30px;
            }

            .owl-carousel .item {
                height: 80vh;
                min-height: 500px;
            }

            .main-slider-caption-center {
                width: 90%;
                max-width: 600px;
            }

            .main-slider-caption-center h1 {
                font-size: 2.8rem;
                margin-bottom: 1.2rem;
            }

            .main-slider-caption-center p {
                font-size: 1.1rem;
                margin-bottom: 2rem;
            }

            .carousel-buttons {
                gap: 15px;
            }

            .btn-cta-slider,
            .btn-cta-slider-outline {
                padding: 13px 30px;
                font-size: 0.95rem;
                min-width: 210px;
            }
        }

        @media (min-width: 769px) and (max-width: 992px) {
            .owl-carousel .item {
                height: 90vh;
            }

            .main-slider-caption-center h1 {
                font-size: 3.5rem;
            }

            .main-slider-caption-center p {
                font-size: 1.2rem;
            }

            .btn-cta-slider,
            .btn-cta-slider-outline {
                padding: 14px 32px;
                font-size: 0.98rem;
            }
        }

        @media (min-width: 993px) {
            .owl-carousel .item {
                height: 100vh;
            }

            .main-slider-caption-center {
                max-width: 900px;
            }
        }

        /* Loading state */
        .slider-loading {
            height: 50vh;
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
            border-top: 4px solid #284093;
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
@endpush

<section class="slider-section">
    {{-- Loading state --}}
    <div class="slider-loading d-none" id="slider-loading">
        <div class="spinner-slider"></div>
    </div>

    <div class="owl-carousel owl-theme" id="mainSliderOwl">
        <!-- SLIDE 1 - Excellence & Innovation -->
        <div class="item">
            <img src="https://images.unsplash.com/photo-1516717435820-d82a54ad2b87?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80" 
                 alt="Ferme moderne - FOANI" 
                 class="slide-image">
            <div class="main-slider-caption-center">
                <h1>Excellence & Innovation</h1>
                <p>FOANI, votre partenaire de confiance dans l'industrie alimentaire. Nous nous engageons à fournir des
                    produits de qualité supérieure avec une approche durable et innovante.</p>
                <div class="carousel-buttons">
                    <a href="#activities" class="btn btn-cta-slider">
                        <i class="bi bi-eye"></i>
                        Découvrir nos activités
                    </a>
                    <a href="#contact" class="btn btn-cta-slider-outline">
                        <i class="bi bi-envelope"></i>
                        Nous contacter
                    </a>
                </div>
            </div>
            <div class="slide-progress"></div>
        </div>

        <!-- SLIDE 2 - Qualité Premium -->
        <div class="item">
            <img src="https://images.unsplash.com/photo-1524503518976-f4b3c7c90f1f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80" 
                 alt="Œufs frais - FOANI" 
                 class="slide-image" 
                 loading="lazy">
            <div class="main-slider-caption-center">
                <h1>Qualité Premium</h1>
                <p>Depuis plus de 15 ans, nous garantissons la fraîcheur et la qualité de nos produits grâce à nos
                    processus rigoureux et notre expertise reconnue dans l'aviculture.</p>
                <div class="carousel-buttons">
                    <a href="#values" class="btn btn-cta-slider">
                        <i class="bi bi-heart"></i>
                        Nos valeurs
                    </a>
                    <a href="{{ route('boutique.index') }}" class="btn btn-cta-slider-outline">
                        <i class="bi bi-shop"></i>
                        Boutique en ligne
                    </a>
                </div>
            </div>
            <div class="slide-progress"></div>
        </div>

        <!-- SLIDE 3 - Engagement Durable -->
        <div class="item">
            <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80" 
                 alt="Poules en liberté - FOANI" 
                 class="slide-image" 
                 loading="lazy">
            <div class="main-slider-caption-center">
                <h1>Engagement Durable</h1>
                <p>Notre mission : créer un avenir alimentaire durable en respectant l'environnement et en soutenant les
                    communautés locales à travers nos pratiques responsables.</p>
                <div class="carousel-buttons">
                    <a href="#team" class="btn btn-cta-slider">
                        <i class="bi bi-people"></i>
                        Notre équipe
                    </a>
                    <a href="#news" class="btn btn-cta-slider-outline">
                        <i class="bi bi-newspaper"></i>
                        Actualités
                    </a>
                </div>
            </div>
            <div class="slide-progress"></div>
        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function() {
            // Configuration Owl Carousel
            const owlSlider = $("#mainSliderOwl").owlCarousel({
                items: 1,
                loop: true,
                margin: 0,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                smartSpeed: 1000,
                navText: [
                    '<span>‹</span>',
                    '<span>›</span>'
                ],
                responsive: {
                    0: {
                        nav: false,
                        autoplayTimeout: 4000,
                        items: 1
                    },
                    768: {
                        nav: true,
                        autoplayTimeout: 6000,
                        items: 1
                    },
                    992: {
                        nav: true,
                        autoplayTimeout: 6000,
                        items: 1
                    }
                },
               
            });
        });
    </script>
@endpush
