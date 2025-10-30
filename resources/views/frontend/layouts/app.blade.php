<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- SEO Meta Tags --}}
    <meta name="description" content="@yield('meta_description', 'Foani - Spécialiste de la volaille et des œufs frais en Côte d\'Ivoire. Découvrez nos produits de qualité premium : poulets, œufs, et volailles diverses. Livraison rapide et fraîcheur garantie.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Foani, volaille Côte d\'Ivoire, œufs frais, poulets, aviculture, ferme, livraison volaille, boutique en ligne, produits frais, élevage, volaille premium, œufs bio, poussins, alimentation volaille')">
    <meta name="author" content="Foani - Aviculture Côte d'Ivoire">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    
    {{-- Open Graph Meta Tags --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', 'Foani - Spécialiste Volaille & Œufs Frais Côte d\'Ivoire')">
    <meta property="og:description" content="@yield('og_description', 'Découvrez Foani, votre spécialiste de la volaille et des œufs frais en Côte d\'Ivoire. Produits de qualité premium, livraison rapide et fraîcheur garantie.')">
    <meta property="og:image" content="@yield('og_image', asset('images/foani-og-image.jpg'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:site_name" content="Foani">
    <meta property="og:locale" content="fr_CI">
    
    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Foani - Spécialiste Volaille & Œufs Frais Côte d\'Ivoire')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Découvrez Foani, votre spécialiste de la volaille et des œufs frais en Côte d\'Ivoire. Produits de qualité premium, livraison rapide et fraîcheur garantie.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/foani-twitter-image.jpg'))">
    <meta name="twitter:site" content="@FoaniCI">
    <meta name="twitter:creator" content="@FoaniCI">
    
    {{-- Additional SEO Meta Tags --}}
    <meta name="geo.region" content="CI">
    <meta name="geo.placename" content="Côte d'Ivoire">
    <meta name="geo.position" content="7.539989;-5.54708">
    <meta name="ICBM" content="7.539989, -5.54708">
    
    {{-- Business/Local SEO --}}
    <meta name="business:contact_data:locality" content="Abidjan">
    <meta name="business:contact_data:region" content="Côte d'Ivoire">
    <meta name="business:contact_data:country_name" content="Côte d'Ivoire">
    <meta name="business:contact_data:phone_number" content="+225 05 05 96 96 25">
    <meta name="business:contact_data:email" content="info@foani.ci">
    
    {{-- Mobile Specific --}}
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Foani">
    <meta name="msapplication-TileColor" content="#559e33">
    <meta name="theme-color" content="#559e33">
    
    {{-- Canonical URL --}}
    <link rel="canonical" href="@yield('canonical', url()->current())">
    
    {{-- Dynamic Title --}}
    <title>@yield('title', 'Foani - Spécialiste Volaille & Œufs Frais Côte d\'Ivoire | Boutique en ligne')</title>

    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/favicon/site.webmanifest')}}">
    
    {{-- Preconnect for performance --}}
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    {{-- DNS Prefetch --}}
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front/css/categorie.css') }}">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- OwlCarousel CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/carousel-animate.css') }}">

    @stack('styles')

    {{-- Structured Data JSON-LD --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Foani",
        "description": "Spécialiste de la volaille et des œufs frais en Côte d'Ivoire",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('front/images/logo.png') }}",
        "telephone": "+225 05 05 96 96 25",
        "email": "info@foani.ci",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "CI",
            "addressLocality": "Abidjan",
            "addressRegion": "Côte d'Ivoire"
        },
        "sameAs": [
            "https://www.facebook.com/foaniservices",
            "https://wa.me/2250505969625"
        ],
        "potentialAction": {
            "@type": "SearchAction",
            "target": {
                "@type": "EntryPoint",
                "urlTemplate": "{{ route('boutique.index') }}?recherche={search_term_string}"
            },
            "query-input": "required name=search_term_string"
        }
    }
    </script>

    @yield('structured_data')

    <style>
        :root {
            --color-vert: #559e33;
            --color-vert2: #345e24;
            --color-rouge: #a61c1c;
            --color-jaune: #f1c40f;
        }

        /* Barre de navigation */


        /* Effets pour les liens de navigation */
        .navbar-nav .nav-link {
            transition: all 0.3s ease;
            position: relative;
            /* font-size: 14px */
        }

        /* Effet au survol */
        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            transform: translateY(-2px);
        }

        /* Effet au clic */
        .navbar-nav .nav-link:active {
            transform: scale(0.95);
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Lien actif */
        .navbar-nav .nav-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 5px;
            font-weight: bold;
        }

        /* Effets pour les éléments dropdown */
        .dropdown-item {
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #559e33;
            color: white;
            transform: translateX(5px);
        }

        /* Effets pour les boutons */
        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: scale(0.95);
        }

        /* Effet pour le badge du panier */
        .badge {
            transition: all 0.3s ease;
        }

        .btn:hover .badge {
            transform: scale(1.2);
        }

        /**LOGO***/

        /* --- Conteneur du logo --- */
        .logo-wrapper {
            width: 90px;
            /* cercle plus grand pour donner de la présence */
            height: 90px;
            overflow: hidden;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* --- Animation au survol --- */
        .logo-wrapper:hover {
            transform: scale(1.07);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
        }

        /* --- Logo image --- */
        .logo-image {
            width: 90%;
            /* l’image occupe presque tout le cercle */
            height: 90%;
            object-fit: contain;
            /* garde les proportions correctes */
            border-radius: 50%;
        }

        /* --- Responsive --- */
        @media (max-width: 768px) {
            .logo-wrapper {
                width: 75px;
                height: 75px;
            }

            .logo-image {
                width: 88%;
                height: 88%;
            }
        }

        @media (max-width: 480px) {
            .logo-wrapper {
                width: 65px;
                height: 65px;
            }

            .logo-image {
                width: 85%;
                height: 85%;
            }
        }

        #mobile-bottom-bar {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1050;
            background: #fff;
            box-shadow: 0 -2px 12px rgba(44, 62, 80, 0.10);
            padding: 0.5rem 0;
            border-top: 2px solid #559e33;
        }

        .mobile-bar-content {
            max-width: 480px;
            margin: 0 auto;
            gap: 0.5rem;
        }

        #mobile-bottom-bar .btn {
            font-size: 1rem;
        }

        @media (min-width: 768px) {
            #mobile-bottom-bar {
                display: none !important;
            }
        }


        .card {
            transition: transform 0.3s cubic-bezier(.4, 2, .3, 1), box-shadow 0.3s cubic-bezier(.4, 2, .3, 1);
            border-radius: 18px;
            /* border: none; */
        }

        .card:hover {
            transform: scale(1.04) translateY(-4px);
            box-shadow: 0 8px 32px rgba(44, 62, 80, 0.18);
            border-color: #559e33;
        }

        .card-title {
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #559e33 60%, #f7c948 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.5rem;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
        }

        .card-text {
            color: #555;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .btn-success {
            background: linear-gradient(90deg, #559e33 80%, #f7c948 100%);
            border: none;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: background 0.2s, transform 0.2s;
        }

        .btn-success:hover {
            background: linear-gradient(90deg, #f7c948 60%, #559e33 100%);
            transform: scale(1.07);
            color: #fff;
        }

        .card-footer {
            background: none;
            border-top: none;
            padding-top: 0;
        }

        @media (max-width: 767px) {
            .card-title {
                font-size: 1.1rem;
            }

            .card-icon {
                width: 32px;
                height: 32px;
                font-size: 1.2rem;
            }
        }

        /* Barre de recherche navbar */
        .navbar-search-container {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            z-index: 1000;
            background: white;
            border-radius: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            animation: slideInRight 0.3s ease;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateY(-50%) translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateY(-50%) translateX(0);
            }
        }

        .navbar-search-form .form-control {
            border: none;
            border-radius: 25px 0 0 25px;
            width: 250px;
            padding: 10px 15px;
            background: #f8f9fa;
        }

        .navbar-search-form .form-control:focus {
            box-shadow: none;
            background: white;
            border: 2px solid #2a6b2a;
        }

        .navbar-search-btn {
            border-radius: 0;
            border: none;
            padding: 10px 15px;
        }

        .navbar-search-container .btn-outline-secondary {
            border-radius: 0 25px 25px 0;
            border: none;
            padding: 10px 15px;
        }

        /* Mobile search */
        .mobile-search-container {
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            animation: slideInUp 0.3s ease;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 991px) {
            .navbar-search-container {
                display: none !important;
            }
        }

        /* Icône de recherche améliorée */
        .btn-search-toggle {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.25));
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease, visibility 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1001;
            opacity: 1;
            visibility: visible;
        }

        .btn-search-toggle::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-search-toggle:hover {
            transform: translateY(-2px) scale(1.05);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.25), rgba(255, 255, 255, 0.35));
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow:
                0 8px 25px rgba(0, 0, 0, 0.15),
                0 0 20px rgba(255, 255, 255, 0.2);
            color: white;
        }

        .btn-search-toggle:hover::before {
            opacity: 1;
        }

        .btn-search-toggle:active {
            transform: translateY(0) scale(0.98);
        }

        .btn-search-toggle i {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .btn-search-toggle:hover i {
            transform: scale(1.1);
        }

        /* Conteneur de recherche amélioré */
        .navbar-search-container {
            position: absolute;
            top: 50%;
            right: 54px;
            /* Décalé pour laisser place à l'icône */
            transform: translateY(-50%);
            z-index: 1000;
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-radius: 30px;
            box-shadow:
                0 12px 40px rgba(0, 0, 0, 0.15),
                0 4px 20px rgba(0, 0, 0, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            animation: slideInRight 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(20px);
            overflow: hidden;
        }

        /* Formulaire en ligne */
        .navbar-search-form {
            display: flex !important;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        /* Input de recherche */
        .navbar-search-form .form-control {
            border: none;
            border-radius: 30px 0 0 30px;
            width: 280px;
            padding: 14px 20px;
            background: transparent;
            font-size: 0.95rem;
            color: #333;
            transition: all 0.3s ease;
            margin: 0;
            flex: 1;
        }

        .navbar-search-form .form-control:focus {
            box-shadow: none;
            background: rgba(255, 255, 255, 0.9);
            outline: none;
            width: 320px;
        }

        .navbar-search-form .form-control::placeholder {
            color: #6c757d;
            font-weight: 400;
        }

        /* Bouton de soumission */
        .btn-search-submit {
            background: linear-gradient(135deg, #2a6b2a, #1e5a1e);
            border: none;
            padding: 14px 18px;
            color: white;
            transition: all 0.3s ease;
            border-radius: 0 30px 30px 0;
            margin: 0;
            flex-shrink: 0;
        }

        .btn-search-submit:hover {
            background: linear-gradient(135deg, #1e5a1e, #164a16);
            transform: scale(1.05);
            color: white;
        }

        .btn-search-submit i {
            font-size: 1rem;
        }

        /* Supprimer les marges des input-group */
        .navbar-search-form .input-group {
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .navbar-search-form .form-control {
                width: 240px;
            }

            .navbar-search-form .form-control:focus {
                width: 270px;
            }
        }

        @media (max-width: 991px) {
            .navbar-search-container {
                display: none !important;
            }
        }

        /* Animation au focus */
        .navbar-search-form .form-control:focus+.btn-search-submit {
            background: linear-gradient(135deg, #559e33, #2a6b2a);
            box-shadow: 0 0 15px rgba(42, 107, 42, 0.3);
        }

        /* States actifs */
        .btn-search-toggle.active {
            background: linear-gradient(135deg, #2a6b2a, #1e5a1e);
            border-color: #2a6b2a;
            color: white;
        }

        .btn-search-toggle.active:hover {
            background: linear-gradient(135deg, #1e5a1e, #164a16);
        }

        /* Animation de fermeture */
        .navbar-search-container.closing {
            animation: slideOutRight 0.3s cubic-bezier(0.25, 0.8, 0.25, 1) forwards;
        }

        @keyframes slideOutRight {
            0% {
                opacity: 1;
                transform: translateY(-50%) translateX(0) scale(1);
            }

            100% {
                opacity: 0;
                transform: translateY(-50%) translateX(30px) scale(0.9);
            }
        }
    </style>
</head>

<body>
    <!-- Header & Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('accueil') }}">
                <div id="logo" class="logo-wrapper rounded-circle">
                    <img src="{{ $data_parametre ? URL::asset($data_parametre->getFirstMediaUrl('logo_header')) : URL::asset('images/camera-icon.png') }}"
                        alt="Foani" class="logo-image">
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-bold">
                    <li class="nav-item"><a class="nav-link text-white {{ Route::is('accueil') ? 'active' : '' }}"
                            href="{{ route('accueil') }}"> ACCUEIL</a></li>

                    @foreach ($categories_pages->where('slug', '!=', 'activites') as $categorie_page)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white px-1 {{ Route::is('page.show') ? 'active' : '' }}"
                                href="#" id="navbar{{ $categorie_page->id }}" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $categorie_page->libelle }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbar{{ $categorie_page->id }}">
                                @foreach ($categorie_page->pages as $page)
                                    <li><a class="dropdown-item"
                                            href="{{ route('page.show', ['slug' => $page->slug]) }}">{{ $page->libelle }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach

                    <li class="nav-item"><a
                            class="nav-link text-white {{ Route::is('page.activites') ? 'active' : '' }}"
                            href="{{ route('page.activites') }}">
                            ACTIVITES</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white px-1 {{ Route::is('points_de_vente') ? 'active' : '' }}"
                            href="#" id="navbar" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            POINTS DE VENTE
                        </a>
                        @php
                            $points_de_vente = \App\Models\CategoriePointVente::active()->alphabetique()->get();
                        @endphp
                        <ul class="dropdown-menu" aria-labelledby="navbar">
                            @foreach ($points_de_vente as $item)
                                <li><a class="dropdown-item"
                                        href="{{ route('points_de_vente', ['slug' => $item->slug]) }}">{{ $item->libelle }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item"><a
                            class="nav-link text-white {{ Route::is('boutique.index') ? 'active' : '' }}"
                            href="{{ route('boutique.index') }}">BOUTIQUE</a></li>
                    <li class="nav-item"><a class="nav-link text-white {{ Route::is('contact') ? 'active' : '' }}"
                            href="{{ route('contact') }}">CONTACT</a></li>
                </ul>

                {{-- Barre de recherche dans la navbar avec toggle --}}
                <div class="d-none d-lg-flex me-3 position-relative">
                    {{-- Icône de recherche --}}
                    <button class="btn btn-search-toggle rounded-circle" id="searchToggleBtn" type="button">
                        <i class="bi bi-search"></i>
                    </button>

                    {{-- Barre de recherche (cachée par défaut) --}}
                    <div class="navbar-search-container" id="navbarSearchContainer" style="display: none;">
                        <form method="GET" action="{{ route('boutique.index') }}"
                            class="navbar-search-form d-flex">
                            <input type="text" name="recherche" class="form-control navbar-search-input"
                                placeholder="Rechercher un produit..." value="{{ request('recherche') }}"
                                id="navbarSearchInput">
                            <button class="btn btn-search-submit" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('panier.index') }}"
                        class="btn btn-outline-light rounded-circle position-relative">
                        <i class="bi bi-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $count ?? 0 }}
                        </span>
                    </a>

                    @guest
                        <div class="dropdown">
                            <a class="btn btn-outline-light dropdown-toggle fw-bold" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> Mon Compte
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('user.loginForm') }}">
                                        <i class="bi bi-box-arrow-in-right me-2"></i> Se connecter
                                    </a></li>
                                <li><a class="dropdown-item" href="{{ route('user.registerForm') }}">
                                        <i class="bi bi-person-plus me-2"></i> Créer un compte
                                    </a></li>
                            </ul>
                        </div>
                    @else
                        <div class="dropdown">
                            <a class="btn btn-outline-light dropdown-toggle fw-bold" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->username }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('user.profil') }}">Mon profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.commandes') }}">Mes commandes</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.reservations') }}">Mes reservations</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                @role('developpeur')
                                    <li><a class="dropdown-item" href="{{ route('dashboard.index') }}">Admin
                                            Panel</a></li>
                                @endrole
                                <li><a class="dropdown-item" href="{{ route('user.logout') }}">Déconnexion</a></li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!--placer le breadcrumb ici si la route est different de accueil-->
    @if (Request::routeIs('accueil') == false)
        @include('frontend.components.breadcrumb')
    @endif


    <!-- Yield content -->

    @yield('content')

    <!-- sweetalert-->
    @include('sweetalert::alert')


    <!-- Bouton remonter en haut, WhatsApp & Panier flottant -->
    <a href="#" id="btnScrollTop" class="btn btn-success rounded-circle shadow position-fixed"
        style="bottom: 140px; right: 25px; z-index: 999; width: 48px; height: 48px; display: none;">
        <i class="bi bi-arrow-up fs-4"></i>
    </a>
    <a href="https://wa.me/2250505969625" target="_blank" id="btnWhatsapp"
        class="btn btn-success rounded-circle shadow position-fixed"
        style="bottom: 80px; right: 25px; z-index: 999; width: 48px; height: 48px;">
        <i class="bi bi-whatsapp fs-3"></i>
    </a>
    {{-- <a href="{{ route('panier.index') }}" id="btnPanier"
        class="btn btn-warning rounded-circle shadow position-fixed d-flex align-items-center justify-content-center mt-4"
        style="bottom: 25px; right: 25px; z-index: 999; width: 56px; height: 56px;">
        <span class="position-relative">
            <i class="bi bi-cart fs-3 text-white"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                style="font-size:0.8rem;">
                {{ $count ?? 0 }}
            </span>
        </span>
    </a> --}}

    {{-- ...MOBILE BAR --}}
    <div id="mobile-bottom-bar" class="d-lg-none d-md-none d-block">
        {{-- Barre de recherche mobile (toggle) --}}
        <div id="mobile-search-bar" class="mobile-search-container" style="display: none;">
            <div class="p-3 bg-white border-top">
                <form method="GET" action="{{ route('boutique.index') }}">
                    <div class="input-group">
                        <input type="text" name="recherche" class="form-control"
                            placeholder="Rechercher un produit..." value="{{ request('recherche') }}">
                        <button class="btn btn-success" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                        <button class="btn btn-outline-secondary" type="button" onclick="toggleMobileSearch()">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mobile-bar-content d-flex justify-content-around align-items-center">

             {{-- Accueil --}}
            <a href="{{ route('accueil') }}" class="btn btn-outline-success rounded-circle flex-shrink-0"
                title="Accueil">
                <i class="bi bi-house fs-3"></i>
            </a>
            {{-- Bouton de recherche --}}
            <button class="btn btn-outline-success rounded-circle flex-shrink-0" onclick="toggleMobileSearch()"
                title="Rechercher">
                <i class="bi bi-search fs-3"></i>
            </button>

            {{-- Panier --}}
            <a href="{{ route('panier.index') }}"
                class="btn btn-warning rounded-circle position-relative flex-shrink-0" title="Panier">
                <i class="bi bi-cart fs-3 text-white"></i>
                <span id="cart-badge-mobile"
                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    style="font-size:0.8rem;">
                    {{ $count ?? 0 }}
                </span>
            </a>

            {{-- Boutique --}}
            <a href="{{ route('boutique.index') }}" class="btn btn-outline-success rounded-circle flex-shrink-0"
                title="Boutique">
                <i class="bi bi-shop fs-3"></i>
            </a>

            {{-- Connexion ou Profil (menu déroulant si connecté) --}}
            @guest
                <a href="{{ route('user.loginForm') }}" class="btn btn-outline-success rounded-circle flex-shrink-0"
                    title="Se connecter">
                    <i class="bi bi-person fs-3"></i>
                </a>
            @else
                <div class="dropup">
                    <a href="#" class="btn btn-success rounded-circle flex-shrink-0 dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false" title="Mon compte">
                        <i class="bi bi-person-check fs-3"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mb-2">
                        <li>
                            <a class="dropdown-item" href="{{ route('user.profil') }}">
                                <i class="bi bi-person-circle me-2"></i> Mon profil
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('user.commandes') }}">
                                <i class="bi bi-bag-check me-2"></i> Mes commandes
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('user.reservations') }}">
                                <i class="bi bi-calendar-check me-2"></i> Mes réservations
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('user.logout') }}">
                                <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                            </a>
                        </li>
                    </ul>
                </div>
            @endguest
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer py-4 mt-5" style="background: #f8f9fa;">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3" style="color:#559e33;">ACTUALITÉS</h5>
                    <div class="ratio ratio-16x9 rounded shadow-sm mb-2">
                        <iframe src="https://www.youtube.com/embed/0Z2W1GitgBE?start=3" title="Spot Foani"
                            allowfullscreen></iframe>
                    </div>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark text-decoration-none">Spot Foani</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3" style="color:#559e33;">INFORMATION</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('page.activites') }}" class="text-dark text-decoration-none">Nos
                                Activités</a></li>
                        <li><a href="{{ route('boutique.index') }}"
                                class="text-dark text-decoration-none">Boutique</a></li>
                        <li><a href="#" class="text-dark text-decoration-none">Entreprise</a></li>
                        <li><a href="{{ route('contact') }}" class="text-dark text-decoration-none">Contact</a></li>
                        {{-- <li><a href="https://webmail.foani.ci" target="_blank" class="text-dark text-decoration-none">Webmail</a></li> --}}
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3" style="color:#559e33;">CONTACT</h5>
                    <ul class="list-unstyled">
                        <li class="text-dark"><i class="bi bi-telephone me-2"></i>Standard : <a
                                href="tel:+2250505969625" class="text-dark text-decoration-none">(+225) 05 05 96 96
                                25</a></li>
                        <li class="text-dark"><i class="bi bi-envelope me-2"></i>E-mail : <a
                                href="mailto:info@foani.ci" class="text-dark text-decoration-none">info@foani.ci</a>
                        </li>
                        <li><a href="{{ route('boutique.index') }}" class="text-dark text-decoration-none"><i
                                    class="bi bi-shop me-2"></i>Notre boutique</a></li>
                        <li><a href="#sectionPointDeVente" class="text-dark text-decoration-none"><i
                                    class="bi bi-geo-alt me-2"></i>Nos points de vente</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3" style="color:#559e33;">SUIVEZ-NOUS</h5>
                    <div class="d-flex align-items-center gap-3 fs-4">
                        <a target="_blank" href="https://www.facebook.com/foaniservices/?_rdc=1&_rdr#"
                            class="text-dark"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center text-muted small">
                &copy; {{ date('Y') }} Foani. Tous droits réservés. Développé par <a
                    href="https://www.ticafrique.ci" target="_blank"
                    class="text-decoration-none text-muted">TICAFRIQUE</a>.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- jQuery (pour les requêtes AJAX) -->
    <script>
        // Configuration globale pour AJAX avec le token CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- Custom JS -->

    <script src="{{ asset('myJs/js/cart_add.js') }}"></script>
    {{-- <script src="{{ asset('myJs/js/cart_update.js') }}"></script>
    <script src="{{ asset('myJs/js/cart_remove.js') }}"></script> --}}
    @stack('scripts')

    <!-- bootstrap form validation -->
    <script>
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })();
    </script>
    <script>
        // Bouton remonter en haut
        const btnScrollTop = document.getElementById('btnScrollTop');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 200) {
                btnScrollTop.style.display = 'flex';
            } else {
                btnScrollTop.style.display = 'none';
            }
        });
        btnScrollTop.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
    <script>
        function updateCartBadges(newCount) {
            // Header
            let badgeHeader = document.getElementById('cart-badge-header');
            if (badgeHeader) badgeHeader.textContent = newCount;

            // Flottant bas
            let badgeBottom = document.getElementById('cart-badge-bottom');
            if (badgeBottom) badgeBottom.textContent = newCount;

            // Mobile bar
            let badgeMobile = document.getElementById('cart-badge-mobile');
            if (badgeMobile) badgeMobile.textContent = newCount;
        }
    </script>
    <script>
        // Toggle barre de recherche desktop amélioré
        document.getElementById('searchToggleBtn').addEventListener('click', function(e) {
            e.stopPropagation(); // Empêche la propagation du clic
            const container = document.getElementById('navbarSearchContainer');
            const input = document.getElementById('navbarSearchInput');
            const toggleBtn = this;

            if (container.style.display === 'none' || container.style.display === '') {
                // Afficher la barre et cacher l'icône
                container.style.display = 'block';
                container.classList.remove('closing');
                toggleBtn.style.opacity = '0';
                toggleBtn.style.visibility = 'hidden';
                toggleBtn.classList.add('active');

                setTimeout(() => {
                    input.focus();
                    input.select(); // Sélectionne le texte existant
                }, 150);
            } else {
                closeSearchBar();
            }
        });

        // Fonction pour fermer la barre de recherche avec animation
        function closeSearchBar() {
            const container = document.getElementById('navbarSearchContainer');
            const toggleBtn = document.getElementById('searchToggleBtn');

            container.classList.add('closing');

            setTimeout(() => {
                container.style.display = 'none';
                container.classList.remove('closing');
                toggleBtn.classList.remove('active');

                // Réafficher l'icône avec animation
                toggleBtn.style.opacity = '1';
                toggleBtn.style.visibility = 'visible';
            }, 300);
        }

        // Empêcher TOUS les clics dans le container de recherche de se propager
        document.getElementById('navbarSearchContainer').addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Gestion spécifique du formulaire de recherche DESKTOP
        const searchForm = document.querySelector('.navbar-search-form');
        const searchSubmitBtn = document.querySelector('.btn-search-submit');

        // Empêcher la propagation sur le formulaire et ajouter scroll=true
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();

            // Récupérer la valeur de recherche
            const searchValue = document.getElementById('navbarSearchInput').value;

            // Construire l'URL avec le paramètre scroll=true
            let url = '{{ route('boutique.index') }}';
            if (searchValue.trim()) {
                url += '?recherche=' + encodeURIComponent(searchValue) + '&scroll=true';
            } else {
                url += '?scroll=true';
            }

            // Rediriger vers la boutique
            window.location.href = url;
        });

        // Empêcher la propagation sur le bouton de soumission
        searchSubmitBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            // Le formulaire va gérer la soumission
        });

        // Empêcher la propagation sur l'input
        document.getElementById('navbarSearchInput').addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Gestion du formulaire de recherche MOBILE
        const mobileSearchForm = document.querySelector('#mobile-search-bar form');
        if (mobileSearchForm) {
            mobileSearchForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Récupérer la valeur de recherche mobile
                const mobileSearchValue = this.querySelector('input[name="recherche"]').value;

                // Construire l'URL avec le paramètre scroll=true
                let url = '{{ route('boutique.index') }}';
                if (mobileSearchValue.trim()) {
                    url += '?recherche=' + encodeURIComponent(mobileSearchValue) + '&scroll=true';
                } else {
                    url += '?scroll=true';
                }

                // Rediriger vers la boutique
                window.location.href = url;
            });
        }

        // Fermer la barre de recherche en cliquant ailleurs
        document.addEventListener('click', function(e) {
            const container = document.getElementById('navbarSearchContainer');
            const toggleBtn = document.getElementById('searchToggleBtn');

            // Vérifier si le clic est en dehors du container ET du bouton toggle
            if (!container.contains(e.target) && !toggleBtn.contains(e.target)) {
                if (container.style.display === 'block') {
                    closeSearchBar();
                }
            }
        });

        // Fermer avec la touche Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const container = document.getElementById('navbarSearchContainer');

                if (container.style.display === 'block') {
                    closeSearchBar();
                }
            }
        });

        // Toggle barre de recherche mobile
        function toggleMobileSearch() {
            const searchBar = document.getElementById('mobile-search-bar');
            if (searchBar.style.display === 'none' || searchBar.style.display === '') {
                searchBar.style.display = 'block';
                setTimeout(() => searchBar.querySelector('input').focus(), 100);
            } else {
                searchBar.style.display = 'none';
            }
        }
    </script>
</body>

</html>
