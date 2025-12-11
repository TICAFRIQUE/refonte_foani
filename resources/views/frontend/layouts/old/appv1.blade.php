{{-- filepath: c:\laragon\www\foani\resources\views\frontend\layouts\app.blade.php --}}
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
    <meta property="og:title" content="@yield('og_title', 'Foani - Services Côte d\'Ivoire')">
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
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">

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
        "name": "Foani & Services",
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

    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '5121195344601135');
        fbq('track', 'PageView');
        fbq('track', 'Search');
        fbq('track', 'AddToCart');
        fbq('track', 'ViewContent');
        fbq('track', 'SubmitApplication');
    </script>
    <noscript>
        <img height="1" width="1"
            src="https://www.facebook.com/tr?id=5121195344601135&ev=PageView
&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->


    <style>
        :root {
            --color-vert: #559e33;
            --color-vert2: #345e24;
            --color-rouge: #a61c1c;
            --color-jaune: #f1c40f;
        }

        /* Effets pour les liens de navigation */
        .navbar-nav .nav-link {
            transition: all 0.3s ease;
            position: relative;
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
        .logo-wrapper {
            width: 90px;
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

        .logo-wrapper:hover {
            transform: scale(1.07);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
        }

        .logo-image {
            width: 90%;
            height: 90%;
            object-fit: contain;
            border-radius: 50%;
        }

        /* Responsive pour le logo */
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

        /* Styles pour les cartes */
        .card {
            transition: transform 0.3s cubic-bezier(.4, 2, .3, 1), box-shadow 0.3s cubic-bezier(.4, 2, .3, 1);
            border-radius: 18px;
        }

        .card:hover {
            transform: scale(1.04) translateY(-4px);
            box-shadow: 0 8px 32px rgba(44, 62, 80, 0.18);
            border-color: #559e33;
        }

        .card-title {
            font-size: 1.1rem;
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

        /* MOBILE - Layout spécifique */
        @media (max-width: 991px) {
            /* Logo centré sur mobile */
            .navbar-brand {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                z-index: 10;
            }

            /* Menu burger à gauche */
            .navbar-toggler {
                order: -1;
                margin-right: auto;
                border: none;
                padding: 4px 8px;
            }

            /* Options auth à droite */
            .navbar-mobile-auth {
                margin-left: auto;
                order: 2;
            }

            /* Collapse menu responsive */
            .navbar-collapse {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--color-vert);
                border-radius: 0 0 15px 15px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                z-index: 1000;
            }

            /* Barre de recherche mobile */
            .mobile-search-section {
                background: rgba(255,255,255,0.1);
                border-radius: 10px;
                margin: 10px;
                padding: 10px;
            }

            .mobile-search-input {
                border: none;
                border-radius: 20px;
                background: white;
                padding: 8px 15px;
            }

            .mobile-search-btn {
                border-radius: 0 20px 20px 0;
                border: none;
                background: var(--color-vert2);
                color: white;
                padding: 8px 12px;
            }

            /* Masquer éléments desktop */
            .d-lg-flex {
                display: none !important;
            }
        }

        /* Desktop - barre de recherche */
        @media (min-width: 992px) {
            /* Barre de recherche navbar */
            .navbar-search-container {
                position: absolute;
                top: 50%;
                right: 54px;
                transform: translateY(-50%);
                z-index: 1000;
                background: linear-gradient(135deg, #ffffff, #f8f9fa);
                border-radius: 30px;
                box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15), 0 4px 20px rgba(0, 0, 0, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
                animation: slideInRight 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
                border: 1px solid rgba(0, 0, 0, 0.05);
                backdrop-filter: blur(20px);
                overflow: hidden;
            }

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
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
                z-index: 1001;
                opacity: 1;
                visibility: visible;
            }

            .btn-search-toggle:hover {
                transform: translateY(-2px) scale(1.05);
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.25), rgba(255, 255, 255, 0.35));
                border-color: rgba(255, 255, 255, 0.5);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15), 0 0 20px rgba(255, 255, 255, 0.2);
                color: white;
            }

            .navbar-search-form {
                display: flex !important;
                align-items: center;
                margin: 0;
                padding: 0;
            }

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

            /* Animations */
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
        }
    </style>
</head>

<body>
    <!-- Header & Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm">
        <div class="container">
            <!-- Menu burger à gauche (mobile) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Logo centré -->
            <a class="navbar-brand fw-bold" href="{{ route('accueil') }}">
                <div id="logo" class="logo-wrapper rounded-circle">
                    <img src="{{ $data_parametre ? URL::asset($data_parametre->getFirstMediaUrl('logo_header')) : URL::asset('images/camera-icon.png') }}"
                        alt="Foani" class="logo-image">
                </div>
            </a>

            <!-- Actions utilisateur à droite (mobile) -->
            <div class="d-flex d-lg-none navbar-mobile-auth">
                <a href="{{ route('panier.index') }}" class="btn btn-outline-light rounded-circle position-relative me-2">
                    <i class="bi bi-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $count ?? 0 }}
                    </span>
                </a>

                @guest
                    <div class="dropdown">
                        <a class="btn btn-outline-light" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
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
                        <a class="btn btn-outline-light" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('user.profil') }}">Mon profil</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.commandes') }}">Mes commandes</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.reservations') }}">Mes reservations</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @role('developpeur')
                                <li><a class="dropdown-item" href="{{ route('dashboard.index') }}">Admin Panel</a></li>
                            @endrole
                            <li><a class="dropdown-item" href="{{ route('user.logout') }}">Déconnexion</a></li>
                        </ul>
                    </div>
                @endguest
            </div>

            <!-- Menu collapse -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <!-- Barre de recherche mobile -->
                <div class="d-lg-none mobile-search-section">
                    <form method="GET" action="{{ route('boutique.index') }}" class="d-flex">
                        <input type="text" name="recherche" class="form-control mobile-search-input flex-grow-1"
                            placeholder="Rechercher un produit..." value="{{ request('recherche') }}">
                        <button class="btn mobile-search-btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Menu navigation -->
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

                <!-- Actions desktop -->
                <div class="d-none d-lg-flex align-items-center gap-3">
                    <!-- Barre de recherche desktop avec toggle -->
                    <div class="position-relative">
                        <button class="btn btn-search-toggle rounded-circle" id="searchToggleBtn" type="button">
                            <i class="bi bi-search"></i>
                        </button>

                        <div class="navbar-search-container" id="navbarSearchContainer" style="display: none;">
                            <form method="GET" action="{{ route('boutique.index') }}" class="navbar-search-form d-flex">
                                <input type="text" name="recherche" class="form-control navbar-search-input"
                                    placeholder="Rechercher un produit..." value="{{ request('recherche') }}"
                                    id="navbarSearchInput">
                                <button class="btn btn-search-submit" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Panier -->
                    <a href="{{ route('panier.index') }}" class="btn btn-outline-light rounded-circle position-relative">
                        <i class="bi bi-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $count ?? 0 }}
                        </span>
                    </a>

                    <!-- Compte utilisateur -->
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
                                <li><a class="dropdown-item" href="{{ route('user.reservations') }}">Mes reservations</a></li>
                                <li><hr class="dropdown-divider"></li>
                                @role('developpeur')
                                    <li><a class="dropdown-item" href="{{ route('dashboard.index') }}">Admin Panel</a></li>
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

    <!-- Boutons flottants -->
    <a href="#" id="btnScrollTop" class="btn btn-success rounded-circle shadow position-fixed"
        style="bottom: 140px; right: 25px; z-index: 999; width: 48px; height: 48px; display: none;">
        <i class="bi bi-arrow-up fs-4"></i>
    </a>
    <a href="https://wa.me/2250505969625?text=Bonjour%20je%20veux%20commander%20un%20de%20vos%20produits"
        target="_blank" id="btnWhatsapp" class="btn btn-success rounded-circle shadow position-fixed"
        style="bottom: 80px; right: 25px; z-index: 999; width: 48px; height: 48px;">
        <i class="bi bi-whatsapp fs-3"></i>
    </a>

    {{-- Mobile bar --}}
    @include('frontend.components.mobile_navBarV1')

    <!-- Footer -->
    @include('frontend.layouts.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Configuration globale pour AJAX avec le token CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script src="{{ asset('myJs/js/cart_add.js') }}"></script>
    @stack('scripts')

    <!-- Scripts de validation et navigation -->
    <script>
        // Validation des formulaires
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

        // Mise à jour des badges du panier
        function updateCartBadges(newCount) {
            let badgeHeader = document.getElementById('cart-badge-header');
            if (badgeHeader) badgeHeader.textContent = newCount;

            let badgeBottom = document.getElementById('cart-badge-bottom');
            if (badgeBottom) badgeBottom.textContent = newCount;

            let badgeMobile = document.getElementById('cart-badge-mobile');
            if (badgeMobile) badgeMobile.textContent = newCount;
        }

        // Gestion de la barre de recherche desktop
        document.addEventListener('DOMContentLoaded', function() {
            const searchToggleBtn = document.getElementById('searchToggleBtn');
            const searchContainer = document.getElementById('navbarSearchContainer');
            const searchInput = document.getElementById('navbarSearchInput');

            if (searchToggleBtn && searchContainer) {
                searchToggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    if (searchContainer.style.display === 'none' || searchContainer.style.display === '') {
                        searchContainer.style.display = 'block';
                        searchContainer.classList.remove('closing');
                        searchToggleBtn.style.opacity = '0';
                        searchToggleBtn.style.visibility = 'hidden';
                        searchToggleBtn.classList.add('active');

                        setTimeout(() => {
                            if (searchInput) {
                                searchInput.focus();
                                searchInput.select();
                            }
                        }, 150);
                    } else {
                        closeSearchBar();
                    }
                });

                // Fermer la barre de recherche
                function closeSearchBar() {
                    searchContainer.classList.add('closing');

                    setTimeout(() => {
                        searchContainer.style.display = 'none';
                        searchContainer.classList.remove('closing');
                        searchToggleBtn.classList.remove('active');
                        searchToggleBtn.style.opacity = '1';
                        searchToggleBtn.style.visibility = 'visible';
                    }, 300);
                }

                // Empêcher la fermeture lors du clic dans la barre
                searchContainer.addEventListener('click', function(e) {
                    e.stopPropagation();
                });

                // Fermer en cliquant ailleurs
                document.addEventListener('click', function(e) {
                    if (!searchContainer.contains(e.target) && !searchToggleBtn.contains(e.target)) {
                        if (searchContainer.style.display === 'block') {
                            closeSearchBar();
                        }
                    }
                });

                // Fermer avec Escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && searchContainer.style.display === 'block') {
                        closeSearchBar();
                    }
                });

                // Gestion du formulaire de recherche
                const searchForm = document.querySelector('.navbar-search-form');
                if (searchForm) {
                    searchForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        const searchValue = searchInput.value;
                        let url = '{{ route('boutique.index') }}';
                        
                        if (searchValue.trim()) {
                            url += '?recherche=' + encodeURIComponent(searchValue) + '&scroll=true';
                        } else {
                            url += '?scroll=true';
                        }

                        window.location.href = url;
                    });
                }
            }

            // Gestion du formulaire de recherche mobile
            const mobileSearchForm = document.querySelector('.mobile-search-section form');
            if (mobileSearchForm) {
                mobileSearchForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const mobileSearchValue = this.querySelector('input[name="recherche"]').value;
                    let url = '{{ route('boutique.index') }}';
                    
                    if (mobileSearchValue.trim()) {
                        url += '?recherche=' + encodeURIComponent(mobileSearchValue) + '&scroll=true';
                    } else {
                        url += '?scroll=true';
                    }

                    window.location.href = url;
                });
            }
        });
    </script>
</body>

</html>