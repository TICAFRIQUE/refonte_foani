{{-- filepath: c:\laragon\www\foani\resources\views\web2.blade.php --}}
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
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 12px;
            border: 3px solid rgba(255, 255, 255, 0.3);
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

        /* MENU MOBILE */
        .mobile-menu {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            border-radius: 50px;
            padding: 15px 30px;
            box-shadow: 0 10px 40px rgba(40, 64, 147, 0.4);
            z-index: 1050;
            display: none;
        }

        .mobile-menu-items {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .mobile-menu-item {
            color: white;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        .mobile-menu-item i {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .mobile-menu-item:hover {
            color: #fff;
            transform: translateY(-3px);
        }

        @media (max-width: 991px) {
            .navbar-nav {
                display: none;
            }
            .mobile-menu {
                display: block;
            }
        }

        /* HERO SECTION */
        .hero {
            background: linear-gradient(135deg, 
                rgba(40, 64, 147, 0.9) 0%, 
                rgba(63, 94, 184, 0.8) 50%, 
                rgba(108, 122, 224, 0.7) 100%
            ),
            url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" style="stop-color:%23ffffff;stop-opacity:0.1"/><stop offset="100%" style="stop-color:%23ffffff;stop-opacity:0"/></radialGradient></defs><circle cx="50" cy="50" r="40" fill="url(%23a)"/><circle cx="150" cy="150" r="30" fill="url(%23a)"/><circle cx="250" cy="80" r="35" fill="url(%23a)"/></svg>');
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero .lead {
            font-size: 1.4rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
            font-weight: 300;
        }

        .btn-hero {
            background: linear-gradient(135deg, #fff, #f8f9ff);
            color: var(--color-primary);
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 8px 30px rgba(255, 255, 255, 0.3);
            transition: all 0.4s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-hero:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 50px rgba(255, 255, 255, 0.4);
            color: var(--color-primary-dark);
        }

        /* FLOATING PARTICLES */
        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) { width: 80px; height: 80px; top: 20%; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 60px; height: 60px; top: 60%; left: 80%; animation-delay: 2s; }
        .particle:nth-child(3) { width: 40px; height: 40px; top: 80%; left: 20%; animation-delay: 4s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
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

        /* VALEURS */
        .values-section {
            background: linear-gradient(135deg, #f8f9ff, #ffffff);
        }

        .value-card {
            background: white;
            border-radius: 25px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(40, 64, 147, 0.1);
            transition: all 0.4s ease;
            border: 1px solid rgba(40, 64, 147, 0.05);
            height: 100%;
        }

        .value-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 60px rgba(40, 64, 147, 0.2);
            border-color: var(--color-primary);
        }

        .value-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 2rem;
            box-shadow: 0 8px 25px rgba(40, 64, 147, 0.3);
            transition: all 0.3s ease;
        }

        .value-card:hover .value-icon {
            transform: scale(1.1) rotate(10deg);
        }

        /* STATISTIQUES */
        .stats-section {
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
            color: white;
        }

        .stat-item {
            text-align: center;
            padding: 30px 20px;
        }

        .stat-number {
            font-size: 4rem;
            font-weight: 900;
            margin-bottom: 10px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .stat-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ACTIVITÉS */
        .activity-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(40, 64, 147, 0.1);
            transition: all 0.4s ease;
            height: 100%;
        }

        .activity-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(40, 64, 147, 0.2);
        }

        .activity-image {
            height: 250px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            position: relative;
            overflow: hidden;
        }

        .activity-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .activity-card:hover .activity-image img {
            transform: scale(1.1);
        }

        .activity-content {
            padding: 30px;
        }

        .activity-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-primary);
            margin-bottom: 15px;
        }

        /* ACTUALITÉS */
        .news-section {
            background: linear-gradient(135deg, #f8f9ff, #ffffff);
        }

        .news-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(40, 64, 147, 0.1);
            transition: all 0.4s ease;
            height: 100%;
        }

        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(40, 64, 147, 0.2);
        }

        .news-image {
            height: 200px;
            background: linear-gradient(135deg, var(--color-accent), var(--color-secondary));
            position: relative;
        }

        .news-date {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.9);
            padding: 8px 15px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--color-primary);
        }

        .news-content {
            padding: 25px;
        }

        .news-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--color-primary);
            margin-bottom: 15px;
        }

        /* ÉQUIPE */
        .team-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(40, 64, 147, 0.1);
            transition: all 0.4s ease;
            height: 100%;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(40, 64, 147, 0.2);
        }

        .team-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            border: 5px solid rgba(40, 64, 147, 0.1);
            transition: all 0.3s ease;
        }

        .team-card:hover .team-photo {
            transform: scale(1.1);
            border-color: var(--color-primary);
        }

        .team-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--color-primary);
            margin-bottom: 10px;
        }

        .team-role {
            color: var(--color-text-light);
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* SERVICES */
        .services-section {
            background: linear-gradient(135deg, #f8f9ff, #ffffff);
        }

        .service-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(40, 64, 147, 0.1);
            transition: all 0.4s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
            transform: translateX(-100%);
            transition: transform 0.4s ease;
        }

        .service-card:hover::before {
            transform: translateX(0);
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(40, 64, 147, 0.2);
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 1.8rem;
            box-shadow: 0 8px 25px rgba(40, 64, 147, 0.3);
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

        .social-links a {
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
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hero h1 {
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
                padding: 12px 25px;
            }
            
            .mobile-menu-items {
                gap: 20px;
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

    <!-- NAVIGATION -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <img src="{{ asset('front/images/logo.png') }}" alt="FOANI Logo" class="logo">
                FOANI
            </a>
            
            <div class="navbar-nav ms-auto d-none d-lg-flex">
                <a class="nav-link active" href="#home">Accueil</a>
                <a class="nav-link" href="#values">Valeurs</a>
                <a class="nav-link" href="#activities">Activités</a>
                <a class="nav-link" href="#services">Services</a>
                <a class="nav-link" href="#team">Équipe</a>
                <a class="nav-link" href="#news">Actualités</a>
                <a class="nav-link" href="#contact">Contact</a>
            </div>
        </div>
    </nav>

    <!-- MENU MOBILE -->
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

    <!-- HERO SECTION -->
    <section id="home" class="hero">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content" data-aos="fade-right">
                        <h1>Excellence & Innovation</h1>
                        <p class="lead">FOANI, votre partenaire de confiance dans l'industrie alimentaire. Nous nous engageons à fournir des produits de qualité supérieure avec une approche durable et innovante.</p>
                        <a href="#activities" class="btn btn-hero">Découvrir nos activités</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- VALEURS -->
    <section id="values" class="section values-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Nos Valeurs</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Des principes fondamentaux qui guident notre action quotidienne
            </p>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4>Qualité</h4>
                        <p>Nous nous engageons à maintenir les plus hauts standards de qualité dans tous nos produits et services.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <h4>Innovation</h4>
                        <p>L'innovation est au cœur de notre démarche pour répondre aux besoins évolutifs de nos clients.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h4>Confiance</h4>
                        <p>Nous bâtissons des relations durables basées sur la transparence et la confiance mutuelle.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATISTIQUES -->
    <section class="section stats-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-item">
                        <div class="stat-number" data-target="15">0</div>
                        <div class="stat-label">Années d'expérience</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-item">
                        <div class="stat-number" data-target="5000">0</div>
                        <div class="stat-label">Clients satisfaits</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-item">
                        <div class="stat-number" data-target="50">0</div>
                        <div class="stat-label">Employés dévoués</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-item">
                        <div class="stat-number" data-target="100">0</div>
                        <div class="stat-label">Produits de qualité</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ACTIVITÉS -->
    <section id="activities" class="section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Nos Activités</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Découvrez l'étendue de notre expertise dans différents domaines
            </p>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="activity-card">
                        <div class="activity-image">
                            <img src="{{ asset('front/images/activities/poultry.jpg') }}" alt="Aviculture">
                        </div>
                        <div class="activity-content">
                            <h4 class="activity-title">Aviculture</h4>
                            <p>Élevage moderne de volailles dans des conditions optimales respectant le bien-être animal et les normes sanitaires.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="activity-card">
                        <div class="activity-image">
                            <img src="{{ asset('front/images/activities/eggs.jpg') }}" alt="Production d'œufs">
                        </div>
                        <div class="activity-content">
                            <h4 class="activity-title">Production d'Œufs</h4>
                            <p>Production d'œufs frais de qualité premium avec un contrôle qualité rigoureux à chaque étape.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="activity-card">
                        <div class="activity-image">
                            <img src="{{ asset('front/images/activities/distribution.jpg') }}" alt="Distribution">
                        </div>
                        <div class="activity-content">
                            <h4 class="activity-title">Distribution</h4>
                            <p>Réseau de distribution efficace garantissant la fraîcheur de nos produits jusqu'au consommateur final.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES -->
    <section id="services" class="section services-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Nos Services</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Des services complets pour répondre à tous vos besoins
            </p>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h5>Livraison</h5>
                        <p>Service de livraison rapide et fiable dans toute la région.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h5>Support Client</h5>
                        <p>Assistance client disponible 24/7 pour répondre à vos questions.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-gear"></i>
                        </div>
                        <h5>Maintenance</h5>
                        <p>Services de maintenance et d'entretien de nos équipements.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h5>Conseil</h5>
                        <p>Expertise et conseil pour optimiser votre activité.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ACTUALITÉS -->
    <section id="news" class="section news-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Actualités</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Restez informé de nos dernières nouvelles et développements
            </p>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="news-card">
                        <div class="news-image">
                            <div class="news-date">15 Nov 2024</div>
                        </div>
                        <div class="news-content">
                            <h5 class="news-title">Expansion de nos installations</h5>
                            <p>FOANI annonce l'extension de ses capacités de production avec l'ouverture d'un nouveau site moderne.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Lire la suite</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="news-card">
                        <div class="news-image">
                            <div class="news-date">10 Nov 2024</div>
                        </div>
                        <div class="news-content">
                            <h5 class="news-title">Certification ISO obtenue</h5>
                            <p>Nous sommes fiers d'annoncer l'obtention de notre certification ISO pour la qualité de nos processus.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Lire la suite</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="news-card">
                        <div class="news-image">
                            <div class="news-date">5 Nov 2024</div>
                        </div>
                        <div class="news-content">
                            <h5 class="news-title">Nouveau partenariat stratégique</h5>
                            <p>FOANI signe un partenariat important pour renforcer sa présence sur le marché régional.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Lire la suite</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ÉQUIPE -->
    <section id="team" class="section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Notre Équipe</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Des professionnels passionnés au service de l'excellence
            </p>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="team-card">
                        <div class="team-photo"></div>
                        <h5 class="team-name">Jean KOUADIO</h5>
                        <p class="team-role">Directeur Général</p>
                        <p>Leadership visionnaire avec plus de 20 ans d'expérience dans l'industrie alimentaire.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="team-card">
                        <div class="team-photo"></div>
                        <h5 class="team-name">Marie ASSI</h5>
                        <p class="team-role">Directrice Qualité</p>
                        <p>Experte en contrôle qualité et certification, garante de nos standards d'excellence.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="team-card">
                        <div class="team-photo"></div>
                        <h5 class="team-name">Paul N'GUESSAN</h5>
                        <p class="team-role">Responsable Production</p>
                        <p>Spécialiste en optimisation des processus de production et innovation technologique.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="team-card">
                        <div class="team-photo"></div>
                        <h5 class="team-name">Sophie KONE</h5>
                        <p class="team-role">Directrice Commerciale</p>
                        <p>Développement commercial et relations clients, architecte de notre croissance.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="contact" class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5>FOANI</h5>
                    <p>Votre partenaire de confiance dans l'industrie alimentaire. Excellence, innovation et qualité depuis plus de 15 ans.</p>
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
                        <li><a href="{{ route('boutique.index') }}" class="btn btn-outline-light btn-sm mt-3">Boutique en ligne</a></li>
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
            anchor.addEventListener('click', function (e) {
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