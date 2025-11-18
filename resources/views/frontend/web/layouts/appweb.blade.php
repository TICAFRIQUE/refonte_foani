{{-- filepath: c:\laragon\www\foani\resources\views\web.blade.php --}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOANI - Entreprise d'Excellence</title>
    <meta name="description" content="FOANI - Leader dans l'industrie alimentaire, volailles et œufs de qualité premium">

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



    @stack('styles')

    <style>
        :root {
            --color-primary: #284093;
            --color-primary-light: #3f5eb8;
            --color-primary-dark: #1e2d6f;
            --color-secondary: #6c7ae0;
            --color-accent: #8b9dc3;
            --color-text-light: #a8b2d1;
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
            width: 100px;
            height: 100px;
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
            /* background: linear-gradient(135deg, rgba(40, 64, 147, 0.98), rgba(63, 94, 184, 0.98)); */
            border-radius: 16px;
            margin-top: 15px;
            padding: 20px;
            box-shadow: 0 12px 48px rgba(40, 64, 147, 0.3);
            /* border: 1px solid rgba(255, 255, 255, 0.1); */
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

        /* HERO CAROUSEL PROFESSIONNEL */

        /* À PROPOS SECTION SIMPLIFIÉE */


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

        /* VALEURS */

        /* ACTIVITÉS */


        /* ACTUALITÉS */


        /* ÉQUIPE */


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

        /* .social-links a {
            display: inline-block;
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 45px;
            margin: 0 10px;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        } */

        /* RESPONSIVE */
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
            <a class="navbar-brand" href="#home">
                <img src="{{ asset('front/images/logoweb.png') }}" alt="FOANI Logo" class="logo">

            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">À propos</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#values">Valeurs</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#activities">Activités</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li> --}}

                    <li class="nav-item">
                        <a class="nav-link" href="#news">Actualités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">Équipe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- MENU MOBILE FLOTTANT -->
    <div class="mobile-menu">
        <div class="mobile-menu-items">
            <a href="#home" class="mobile-menu-item">
                <i class="bi bi-house-fill"></i>
                <span>Accueil</span>
            </a>
            <a href="#contact" class="mobile-menu-item">
                <i class="bi bi-envelope-fill"></i>
                <span>Contact</span>
            </a>
            <a href="{{ route('boutique.index') }}" class="mobile-menu-item">
                <i class="bi bi-bag-fill"></i>
                <span>Boutique</span>
            </a>
        </div>
    </div>

    @yield('content')

    <!-- FOOTER -->
    <footer id="contact" class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5>FOANI</h5>
                    <p>Votre partenaire de confiance dans l'industrie alimentaire. Excellence, innovation et qualité
                        depuis plus de 15 ans.</p>
                    <div class="social-links mt-4">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h5>Navigation</h5>
                    <ul class="list-unstyled">
                        <li><a href="#home">Accueil</a></li>
                        <li><a href="#about">À propos</a></li>
                        <li><a href="#values">Valeurs</a></li>
                        <li><a href="#activities">Activités</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#team">Équipe</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5>Services</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Aviculture</a></li>
                        <li><a href="#">Production d'œufs</a></li>
                        <li><a href="#">Distribution</a></li>
                        <li><a href="#">Livraison</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt"></i> Abidjan, Côte d'Ivoire</li>
                        <li><i class="bi bi-telephone"></i> +225 07 XX XX XX XX</li>
                        <li><i class="bi bi-envelope"></i> contact@foani.ci</li>
                        <li><a href="{{ route('boutique.index') }}" class="btn btn-outline-light btn-sm mt-3">Boutique
                                en ligne</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p>&copy; 2024 FOANI. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

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
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        });

        observer.observe(document.querySelector('.stats-section'));

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
