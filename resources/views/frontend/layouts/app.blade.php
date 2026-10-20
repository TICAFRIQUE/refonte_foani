{{-- Layout boutique --}}
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
    <meta property="og:image" content="@yield('og_image', asset('front/images/logoweb.png'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:site_name" content="Foani">
    <meta property="og:locale" content="fr_CI">

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Foani - Spécialiste Volaille & Œufs Frais Côte d\'Ivoire')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Découvrez Foani, votre spécialiste de la volaille et des œufs frais en Côte d\'Ivoire. Produits de qualité premium, livraison rapide et fraîcheur garantie.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('front/images/logoweb.png'))">
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

    {{-- Connexions anticipées vers les CDN --}}
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Polices : Poppins (titres, menu, boutons) + Inter (texte) --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&family=Caveat:wght@600;700&display=swap">

    {{-- Mêmes versions que le site vitrine : le navigateur réutilise son cache entre les deux --}}
    <link href="{{ asset('front/vendor/bootstrap-5.3.3/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/bootstrap-icons-1.11.3/bootstrap-icons.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('front/css/custom.css') }}?v={{ filemtime(public_path('front/css/custom.css')) }}">
    <link rel="stylesheet" href="{{ asset('front/css/shop.css') }}?v={{ filemtime(public_path('front/css/shop.css')) }}">
    <script>document.documentElement.classList.add('js');</script>
    <script src="{{ asset('front/js/shop.js') }}?v={{ filemtime(public_path('front/js/shop.js')) }}" defer></script>

    @stack('styles')

    {{-- Pré-chargement des pages au survol des liens (navigation quasi instantanée, Chrome/Edge) --}}
    <script type="speculationrules">
    {
        "prefetch": [{
            "source": "document",
            "where": { "and": [
                { "href_matches": "/*" },
                { "not": { "href_matches": "/admin*" } },
                { "not": { "href_matches": "/logout*" } },
                { "not": { "href_matches": "/panier/*" } }
            ]},
            "eagerness": "moderate"
        }]
    }
    </script>

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
        // Seul PageView est envoyé ici. Les autres événements (AddToCart, Search...)
        // étaient déclenchés sur toutes les pages, ce qui faussait les statistiques.
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" alt=""
            src="https://www.facebook.com/tr?id=5121195344601135&ev=PageView&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->
</head>

<body>
    @php
        $logoUrl = $data_parametre?->getFirstMediaUrl('logo_header') ?: asset('front/images/logo.png');
        $boutiqueActive = Route::is('boutique.*') || Route::is('categories');
    @endphp

    <!-- Barre d'infos -->
    <div class="topbar d-none d-md-block">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                @if ($data_parametre?->contact1)
                    <a href="tel:{{ preg_replace('/\s+/', '', $data_parametre->contact1) }}">
                        <i class="bi bi-telephone me-1"></i>{{ $data_parametre->contact1 }}
                    </a>
                    <span class="sep">|</span>
                @endif
                <span><i class="bi bi-truck me-1"></i>Livraison rapide · Produits frais garantis</span>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('web.index') }}"><i class="bi bi-arrow-left-short"></i>Site Foani &amp; Services</a>
                @if ($data_parametre?->contact2)
                    <span class="sep">|</span>
                    <a href="https://wa.me/225{{ $data_parametre->contact2 }}" target="_blank" rel="noopener">
                        <i class="bi bi-whatsapp me-1"></i>Commander sur WhatsApp
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="site-header">
        <nav class="navbar navbar-expand-lg" aria-label="Navigation principale">
            <div class="container flex-wrap">
                <!-- Logo -->
                <a class="navbar-brand me-3 me-xl-4 py-2" href="{{ route('boutique.accueil') }}" aria-label="Foani - Boutique">
                    <span class="brand-logo">
                        <img src="{{ $logoUrl }}" alt="Foani" width="56" height="56" fetchpriority="high">
                    </span>
                </a>

                <!-- Actions mobiles : panier + menu -->
                <div class="d-flex d-lg-none align-items-center gap-2 ms-auto">
                    <a href="{{ route('web.index') }}" class="btn-vitrine" title="Découvrir le site Foani &amp; Services">
                        <i class="bi bi-house-heart-fill"></i><span>Le site</span>
                    </a>
                    <a href="{{ route('panier.index') }}" class="header-action icon-only" aria-label="Panier">
                        <i class="bi bi-basket2-fill"></i>
                        <span class="cart-count" data-cart-count>{{ $count ?? 0 }}</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"
                        aria-label="Ouvrir le menu">
                        <i class="bi bi-list"></i>
                    </button>
                </div>

                <!-- Recherche mobile : toujours visible, pleine largeur -->
                <div class="w-100 d-lg-none mobile-search-row">
                    <form method="GET" action="{{ route('boutique.index') }}" class="header-search" role="search">
                        <input type="search" name="recherche" placeholder="Rechercher un produit…"
                            value="{{ request('recherche') }}" aria-label="Rechercher un produit">
                        <button type="submit" aria-label="Rechercher"><i class="bi bi-search"></i></button>
                    </form>
                </div>

                <div class="collapse navbar-collapse" id="mainNavbar">
                    <!-- Menu -->
                    <ul class="navbar-nav main-nav me-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('boutique.accueil') ? 'active' : '' }}"
                                href="{{ route('boutique.accueil') }}">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $boutiqueActive && !Route::is('boutique.accueil') ? 'active' : '' }}"
                                href="{{ route('boutique.index') }}">Nos produits</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ Route::is('points_de_vente') ? 'active' : '' }}"
                                href="#" id="menuPointsVente" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">Points de vente</a>
                            <ul class="dropdown-menu" aria-labelledby="menuPointsVente">
                                @foreach ($menu_points_vente ?? [] as $item)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('points_de_vente', ['slug' => $item->slug]) }}">
                                            <i class="bi bi-geo-alt me-2"></i>{{ $item->libelle }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('contact') ? 'active' : '' }}"
                                href="{{ route('contact') }}">Contact</a>
                        </li>
                        <li class="nav-item d-md-none">
                            <a class="nav-link" href="{{ route('web.index') }}">
                                <i class="bi bi-arrow-left-short"></i> Site Foani &amp; Services
                            </a>
                        </li>
                    </ul>

                    <!-- Recherche desktop -->
                    <form method="GET" action="{{ route('boutique.index') }}"
                        class="header-search d-none d-lg-block mx-lg-3" role="search">
                        <input type="search" name="recherche" placeholder="Rechercher…"
                            value="{{ request('recherche') }}" aria-label="Rechercher un produit">
                        <button type="submit" aria-label="Rechercher"><i class="bi bi-search"></i></button>
                    </form>

                    <!-- Compte + panier -->
                    <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0">
                        <a href="{{ route('web.index') }}" class="btn-vitrine d-none d-lg-inline-flex" title="Découvrir le site Foani &amp; Services">
                            <i class="bi bi-house-heart-fill"></i><span class="d-none d-xl-inline">Site Foani &amp; Services</span><span class="d-xl-none">Le site</span>
                        </a>
                        <div class="dropdown">
                            <button class="header-action header-action--account" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" title="{{ Auth::check() ? Auth::user()->username : 'Mon compte' }}">
                                <i class="bi {{ Auth::check() ? 'bi-person-check-fill' : 'bi-person-circle' }}"></i>
                                {{-- libellé visible seulement dans le menu mobile --}}
                                <span class="d-lg-none">{{ Auth::check() ? Str::limit(Auth::user()->username, 14) : 'Mon compte' }}</span>
                                <span class="visually-hidden">Mon compte</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                @guest
                                    <li><a class="dropdown-item" href="{{ route('user.loginForm') }}">
                                            <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.registerForm') }}">
                                            <i class="bi bi-person-plus me-2"></i>Créer un compte</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('user.profil') }}">
                                            <i class="bi bi-person me-2"></i>Mon profil</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.commandes') }}">
                                            <i class="bi bi-bag-check me-2"></i>Mes commandes</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.reservations') }}">
                                            <i class="bi bi-calendar-check me-2"></i>Mes réservations</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    @role('developpeur')
                                        <li><a class="dropdown-item" href="{{ route('dashboard.index') }}">
                                                <i class="bi bi-speedometer2 me-2"></i>Admin Panel</a></li>
                                    @endrole
                                    <li><a class="dropdown-item text-danger" href="{{ route('user.logout') }}">
                                            <i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a></li>
                                @endguest
                            </ul>
                        </div>

                        <a href="{{ route('panier.index') }}" class="header-action icon-only d-none d-lg-inline-flex" aria-label="Panier" title="Mon panier">
                            <i class="bi bi-basket2-fill"></i>
                            <span class="cart-count" data-cart-count>{{ $count ?? 0 }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    {{-- Bandeau + fil d'Ariane (sauf accueil et liste des produits, qui ont le leur) --}}
    @if (!Request::routeIs('boutique.accueil') && !Request::routeIs('boutique.index') && !Request::routeIs('boutique.categorie'))
        @include('frontend.components.page-hero')
    @endif

    @yield('content')

    <!-- sweetalert-->
    @include('sweetalert::alert')

    <!-- Boutons flottants (empilés) : retour en haut, Facebook, WhatsApp -->
    <div class="fab-stack">
        <a href="#" id="btnScrollTop" class="fab fab--top" style="display: none;" aria-label="Remonter en haut">
            <i class="bi bi-arrow-up"></i>
        </a>
        <a href="https://www.facebook.com/foaniservices" target="_blank" rel="noopener" class="fab fab--fb"
            aria-label="Suivez-nous sur Facebook" title="Suivez-nous sur Facebook">
            <i class="bi bi-facebook"></i>
        </a>
        <a href="https://wa.me/225{{ $data_parametre?->contact2 }}?text=Bonjour%20je%20veux%20commander%20un%20de%20vos%20produits"
            target="_blank" rel="noopener" id="btnWhatsapp" class="fab fab--wa" aria-label="Commander sur WhatsApp" title="Commander sur WhatsApp">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>

    {{-- ...MOBILE BAR --}}
    @include('frontend.components.mobile_navBarV1')

    <!-- Footer -->
    @include('frontend.layouts.footer')

    <script src="{{ asset('front/vendor/bootstrap-5.3.3/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/vendor/jquery-3.7.1/jquery.min.js') }}"></script>
    <script src="{{ asset('front/vendor/sweetalert2-11.14.5/sweetalert2.all.min.js') }}" defer></script>

    <script>
        // Token CSRF pour toutes les requêtes AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script src="{{ asset('myJs/js/cart_add.js') }}?v={{ filemtime(public_path('myJs/js/cart_add.js')) }}"></script>
    @stack('scripts')

    <script>
        // Validation des formulaires Bootstrap
        document.querySelectorAll('.needs-validation').forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });

        // Bouton remonter en haut (écoute passive : ne ralentit pas le défilement)
        (function() {
            const btn = document.getElementById('btnScrollTop');
            let visible = false;
            window.addEventListener('scroll', function() {
                const show = window.scrollY > 300;
                if (show !== visible) {
                    visible = show;
                    btn.style.display = show ? 'flex' : 'none';
                }
            }, { passive: true });
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        })();
    </script>

    {{-- Messages de session affichés en notifications (voir front/js/shop.js) --}}
    @php
        $flashTitres = ['success' => 'Succès', 'error' => 'Oups…', 'warning' => 'Attention', 'info' => 'Information'];
        $flash = [];
        foreach ($flashTitres as $type => $titre) {
            if (session()->has($type) && is_string(session($type))) {
                $flash[] = ['type' => $type, 'title' => $titre, 'text' => session($type)];
            }
        }
    @endphp
    @if ($flash)
        <script type="application/json" id="flash-messages">@json($flash)</script>
    @endif
</body>

</html>
