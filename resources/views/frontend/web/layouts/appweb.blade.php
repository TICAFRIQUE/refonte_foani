{{-- filepath: c:\laragon\www\foani\resources\views\frontend\web\layouts\appweb.blade.php --}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOANI & SERVICES</title>
    <meta name="description" content="FOANI - Leader dans l'industrie alimentaire, volailles et œufs de qualité premium">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    <meta name="description" content="@yield('meta_description', 'Foani - Spécialiste de la volaille et des œufs frais en Côte d\'Ivoire. Découvrez nos produits de qualité premium : poulets, œufs, et volailles diverses. Livraison rapide et fraîcheur garantie.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Foani, volaille Côte d\'Ivoire, œufs frais, poulets, aviculture, ferme, livraison volaille, boutique en ligne, produits frais, élevage, volaille premium, œufs bio, poussins, alimentation volaille')">
    <meta name="author" content="Foani - Aviculture Côte d'Ivoire">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', 'Foani - Services Côte d\'Ivoire')">
    <meta property="og:description" content="@yield('og_description', 'Découvrez Foani, votre spécialiste de la volaille et des œufs frais en Côte d\'Ivoire. Produits de qualité premium, livraison rapide et fraîcheur garantie.')">
    <meta property="og:image" content="@yield('og_image', asset('front/images/logoweb.png'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:site_name" content="Foani&Services">
    <meta property="og:locale" content="fr_CI">

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Foani - Spécialiste Volaille & Œufs Frais Côte d\'Ivoire')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Découvrez Foani, votre spécialiste de la volaille et des œufs frais en Côte d\'Ivoire. Produits de qualité premium, livraison rapide et fraîcheur garantie.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/foani-twitter-image.jpg'))">
    <meta name="twitter:site" content="@FoaniCI">
    <meta name="twitter:creator" content="@FoaniCI">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- OwlCarousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('front/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('front/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('front/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('front/favicon/site.webmanifest') }}">




    @stack('styles')

    <style>
        :root {
            --color-primary: #284093;
            --color-primary-light: #3f5eb8;
            --color-primary-dark: #1e2d6f;
            --color-secondary: #6c7ae0;
            --color-accent: #8b9dc3;
            --color-text-light: #a8b2d1;
            --color-jaune: #f1c40f;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        /* NAVIGATION */
        .navbar {
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            backdrop-filter: blur(20px);
            box-shadow: 0 8px 32px rgba(40, 64, 147, 0.3);
            transition: all 0.3s ease;
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }

        .navbar.scrolled {
            background: rgba(40, 64, 147, 0.95);
            backdrop-filter: blur(20px);
            padding: 0.5rem 0;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: 800;
            font-size: 1.8rem;
            color: white !important;
            text-decoration: none;
        }

        .logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 12px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover .logo {
            transform: rotate(360deg) scale(1.1);
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 600;
            margin: 0 15px;
            position: relative;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #fff, var(--color-accent));
            transition: all 0.4s ease;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .navbar-nav .nav-link:hover::before,
        .navbar-nav .nav-link.active::before {
            width: 100%;
        }

        .navbar-nav .nav-link:hover {
            transform: translateY(-2px);
        }

        /* MENU DÉROULANT STYLING */
        .dropdown-menu {
            background: linear-gradient(135deg, rgba(40, 64, 147, 0.98), rgba(63, 94, 184, 0.95));
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 50px rgba(40, 64, 147, 0.4);
            backdrop-filter: blur(20px);
            padding: 15px 0;
            margin-top: 10px;
            min-width: 280px;
            transform: translateY(-10px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .dropdown:hover .dropdown-menu,
        .dropdown.show .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            color: white !important;
            padding: 12px 25px;
            font-size: 0.95rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            border-radius: 10px;
            margin: 0 10px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .dropdown-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .dropdown-item:hover::before {
            left: 100%;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background: rgba(255, 255, 255, 0.15);
            color: white !important;
            transform: translateX(8px) scale(1.02);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.1);
        }

        .dropdown-item i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .dropdown-item:hover i {
            transform: rotateY(360deg);
        }

        /* Flèche du menu déroulant */
        .nav-link.dropdown-toggle::after {
            margin-left: 8px;
            transition: transform 0.3s ease;
            font-size: 0.8rem;
        }

        .dropdown:hover .nav-link.dropdown-toggle::after,
        .dropdown.show .nav-link.dropdown-toggle::after {
            transform: rotate(180deg);
        }

        /* Séparateur dans le menu */
        .dropdown-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin: 10px 15px;
            opacity: 0.5;
        }

        /* Badge pour les éléments du menu */
        .dropdown-item .badge {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 12px;
            margin-left: auto;
            font-weight: 700;
        }

        /* MENU MOBILE AMÉLIORÉ */
        .navbar-toggler {
            border: none;
            padding: 4px 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-collapse {
            border-radius: 16px;
            margin-top: 15px;
            padding: 20px;
            box-shadow: 0 12px 48px rgba(40, 64, 147, 0.3);
        }

        @media (max-width: 991px) {
            .navbar-nav {
                gap: 0;
            }

            .navbar-nav .nav-link {
                padding: 12px 20px;
                margin: 4px 0;
                border-radius: 10px;
                background: rgba(255, 255, 255, 0.05);
                transition: all 0.3s ease;
            }

            .navbar-nav .nav-link:hover {
                background: rgba(255, 255, 255, 0.15);
                transform: translateX(8px);
                color: white !important;
            }

            .navbar-nav .nav-link::before {
                display: none;
            }

            /* Menu déroulant mobile */
            .dropdown-menu {
                background: rgba(255, 255, 255, 0.1);
                border-radius: 10px;
                margin-top: 5px;
                margin-left: 20px;
                min-width: auto;
                width: calc(100% - 40px);
                position: static !important;
                transform: none !important;
                opacity: 1 !important;
                visibility: visible !important;
                box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .dropdown-item {
                margin: 0 5px;
                padding: 10px 15px;
                font-size: 0.9rem;
            }

            .dropdown-item:hover {
                transform: translateX(5px);
            }
        }

        /* MENU MOBILE FLOTTANT */
        .mobile-menu {
            position: fixed;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            border-radius: 25px;
            padding: 12px 25px;
            box-shadow: 0 12px 48px rgba(40, 64, 147, 0.4);
            z-index: 1050;
            display: none;
            backdrop-filter: blur(20px);
        }

        .mobile-menu-items {
            display: flex;
            gap: 35px;
            align-items: center;
        }

        .mobile-menu-item {
            color: white;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.75rem;
            font-weight: 700;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: center;
        }

        .mobile-menu-item i {
            font-size: 1.4rem;
            margin-bottom: 4px;
        }

        .mobile-menu-item:hover {
            color: #fff;
            transform: translateY(-3px) scale(1.05);
        }

        @media (max-width: 991px) {
            .mobile-menu {
                display: block;
            }
        }

        /* SECTIONS COMMUNES */
        .section {
            padding: 100px 0;
            position: relative;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--color-primary);
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
            border-radius: 2px;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: var(--color-text-light);
            margin-bottom: 4rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* FOOTER */
        .footer {
            background: linear-gradient(135deg, var(--color-primary-dark), var(--color-primary));
            color: white;
            padding: 60px 0 30px;
        }

        .footer h5 {
            color: white;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: white;
        }

        /* BUTTON CONTACTEZ-NOUS */
        .btn-contact-nav {
            background: linear-gradient(135deg, #e4405f, #f56040, #ffad00);
            border: none;
            color: #333;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 4px 15px rgba(241, 196, 15, 0.3);
        }

        .btn-contact-nav:hover {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(241, 196, 15, 0.4);
            color: #333;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .carousel-content h1 {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }

            .section {
                padding: 60px 0;
            }

            .mobile-menu {
                padding: 10px 20px;
                bottom: 20px;
            }

            .mobile-menu-items {
                gap: 25px;
            }

            .btn-contact-nav {
                padding: 8px 15px;
                font-size: 0.85rem;
                margin-top: 10px;
            }

            /* Footer Mobile Optimization */
            .footer {
                text-align: center;
                padding: 30px 15px;
            }

            .footer-content {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            .footer-logo {
                order: -1;
                margin-bottom: 20px;
            }

            .footer-logo img {
                max-width: 120px;
                height: auto;
            }

            .footer-links {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .footer-social {
                justify-content: center;
                gap: 15px;
            }

            .footer-text {
                font-size: 0.9rem;
                line-height: 1.5;
                margin: 10px 0;
            }
        }

        /* ANIMATIONS */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
        }

        .fade-in.aos-animate {
            opacity: 1;
            transform: translateY(0);
        }

        /* SCROLL INDICATOR */
        .scroll-indicator {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
            z-index: 9999;
            transition: width 0.3s ease;
        }
    </style>
</head>

<body>
    <!-- SCROLL INDICATOR -->
    <div class="scroll-indicator"></div>

    <!-- NAVIGATION PROFESSIONNELLE -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/#home">
                <img src="{{ asset('front/images/logoweb.png') }}" alt="FOANI Logo" class="logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/#home">Accueil</a>
                    </li>

                    @foreach ($categories_pages->where('slug', '==', 'entreprise') as $categorie_page)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#about"
                                id="aboutDropdown{{ $categorie_page->id }}" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ $categorie_page->libelle }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="aboutDropdown{{ $categorie_page->id }}">


                                @foreach ($categorie_page->pages as $page)
                                    <li><a class="dropdown-item"
                                            href="{{ route('page.show', ['slug' => $page->slug]) }}">{{ $page->libelle }}</a>
                                    </li>
                                @endforeach


                            </ul>
                        </li>
                    @endforeach

                    <li class="nav-item">
                        <a class="nav-link" href="/#activities">Activités</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('boutique.accueil') }}">
                            <i class="bi bi-bag-fill me-2"></i> Boutique</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="/#news">Actualités</a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="/#team">Équipe</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="/#contact">Contact</a>
                    </li>
                </ul>

                <!-- Bouton Contactez-nous -->
                {{-- <div class="navbar-nav">
                    <a href="#contact" class="btn btn-contact-nav">
                        <i class="bi bi-telephone me-2"></i>
                        Contactez-nous
                    </a>
                </div> --}}
            </div>
        </div>
    </nav>

    <!-- MENU MOBILE FLOTTANT -->
    <div class="mobile-menu">
        <div class="mobile-menu-items">
            <a href="{{ url('/#home') }}" class="mobile-menu-item">
                <i class="bi bi-house-fill"></i>
                <span>Accueil</span>
            </a>
            <a href="/#contact" class="mobile-menu-item">
                <i class="bi bi-envelope-fill"></i>
                <span>Contact</span>
            </a>
            <a href="{{ route('boutique.accueil') }}" class="mobile-menu-item">
                <i class="bi bi-bag-fill"></i>
                <span>Boutique</span>
            </a>
        </div>
    </div>

    @yield('content')

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">

                    <p>
                        <img src="{{ asset('front/images/logoweb.png') }}" alt="logo FOANI"
                            style="width: 100px; height: auto; margin-bottom: 15px;">
                        {{ $data_parametre?->description_courte }}

                        <a href="{{ route('boutique.accueil') }}" target="_blank" class="btn btn-contact-nav">
                            <i class="bi bi-bag-fill me-2"></i> Visitez notre Boutique
                        </a>
                    </p>

                    <div class="social-links mt-4">
                        <a href="{{ $data_parametre?->lien_facebook }}" target="_blank"><i
                                class="bi bi-facebook"></i></a>
                        <a href="{{ $data_parametre?->lien_twitter }}" target="_blank"><i
                                class="bi bi-twitter"></i></a>
                        <a href="{{ $data_parametre?->lien_linkedin }}" target="_blank"><i
                                class="bi bi-linkedin"></i></a>
                        <a href="{{ $data_parametre?->lien_instagram }}" target="_blank"><i
                                class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <h5>Navigation</h5>
                    <ul class="list-unstyled">
                        <li><a href="#home">Accueil</a></li>
                        <li><a href="#about">À propos</a></li>
                        <li><a href="#values">Valeurs</a></li>
                        <li><a href="#activities">Activités</a></li>
                        {{-- <li><a href="#services">Services</a></li>
                        <li><a href="#team">Équipe</a></li> --}}
                    </ul>
                </div>
                {{-- <div class="col-lg-3">
                    <h5>Activités</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Aviculture</a></li>
                        <li><a href="#">Production d'œufs</a></li>
                        <li><a href="#">Distribution</a></li>
                        <li><a href="#">Livraison</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div> --}}
                <div class="col-lg-4 ">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt"></i> {{ $data_parametre?->localisation }}</li>
                        <li><i class="bi bi-telephone"></i> {{ $data_parametre?->contact1 }}</li>
                        <li><i class="bi bi-envelope"></i> {{ $data_parametre?->email1 }}</li>

                    </ul>
                </div>
            </div>


            <hr class="my-4">

            <div class="text-center">
                <p>&copy; {{ date('Y') }} FOANI. Tous droits réservés. Developped by <a
                        href="https://www.ticafrique.ci" target="_blank">TICAFRIQUE</a></p>
            </div>
        </div>
    </footer>


    @include('frontend.components.bouttons_flottant')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    @stack('scripts')

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Scroll indicator
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset;
            const docHeight = document.body.offsetHeight - window.innerHeight;
            const scrollPercent = scrollTop / docHeight * 100;
            document.querySelector('.scroll-indicator').style.width = scrollPercent + '%';
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Menu déroulant au hover (desktop uniquement)
        if (window.innerWidth > 991) {
            const dropdowns = document.querySelectorAll('.dropdown');

            dropdowns.forEach(dropdown => {
                let timeout;

                dropdown.addEventListener('mouseenter', function() {
                    clearTimeout(timeout);
                    this.classList.add('show');
                    this.querySelector('.dropdown-menu').classList.add('show');
                });

                dropdown.addEventListener('mouseleave', function() {
                    timeout = setTimeout(() => {
                        this.classList.remove('show');
                        this.querySelector('.dropdown-menu').classList.remove('show');
                    }, 100);
                });
            });
        }

        // Counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');
            const speed = 200;

            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(animateCounters, 1);
                } else {
                    counter.innerText = target;
                }
            });
        }

        // Trigger counter animation when stats section is visible
        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        observer.unobserve(entry.target);
                    }
                });
            });
            observer.observe(statsSection);
        }

        // Active navigation link
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>
