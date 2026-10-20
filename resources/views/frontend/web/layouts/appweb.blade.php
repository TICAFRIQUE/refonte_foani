<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOANI &amp; SERVICES - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <meta name="description" content="@yield('meta_description', 'Foani - Spécialiste de la volaille et des œufs frais en Côte d\'Ivoire. Découvrez nos produits de qualité premium : poulets, œufs, et volailles diverses. Livraison rapide et fraîcheur garantie.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Foani, volaille Côte d\'Ivoire, œufs frais, poulets, aviculture, ferme, livraison volaille, boutique en ligne, produits frais, élevage, volaille premium, poussins, alimentation volaille')">
    <meta name="author" content="Foani - Aviculture Côte d'Ivoire">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    <meta name="theme-color" content="#284093">

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', 'Foani - Services Côte d\'Ivoire')">
    <meta property="og:description" content="@yield('og_description', 'Découvrez Foani, votre spécialiste de la volaille et des œufs frais en Côte d\'Ivoire. Produits de qualité premium, livraison rapide et fraîcheur garantie.')">
    <meta property="og:image" content="@yield('og_image', asset('front/images/logoweb.png'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:site_name" content="Foani&Services">
    <meta property="og:locale" content="fr_CI">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Foani - Spécialiste Volaille & Œufs Frais Côte d\'Ivoire')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Découvrez Foani, votre spécialiste de la volaille et des œufs frais en Côte d\'Ivoire. Produits de qualité premium, livraison rapide et fraîcheur garantie.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('front/images/logoweb.png'))">
    <meta name="twitter:site" content="@FoaniCI">
    <meta name="twitter:creator" content="@FoaniCI">

    {{-- Polices : Poppins (titres), Inter (texte), Caveat (accents manuscrits) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700;800&family=Caveat:wght@600;700&display=swap">

    {{-- Bibliothèques servies par le site (mêmes fichiers que la boutique : déjà en cache) --}}
    <link href="{{ asset('front/vendor/bootstrap-5.3.3/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/bootstrap-icons-1.11.3/bootstrap-icons.min.css') }}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('front/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('front/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('front/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('front/favicon/site.webmanifest') }}">

    @stack('styles')

    <link rel="stylesheet" href="{{ asset('front/css/vitrine.css') }}?v={{ filemtime(public_path('front/css/vitrine.css')) }}">
    <script>document.documentElement.classList.add('js');</script>
    <script src="{{ asset('front/js/vitrine.js') }}?v={{ filemtime(public_path('front/js/vitrine.js')) }}" defer></script>

    {{-- Pré-charge la boutique au survol du lien (Chrome/Edge) --}}
    <script type="speculationrules">
    {
        "prefetch": [{
            "source": "document",
            "where": { "and": [
                { "href_matches": "/*" },
                { "not": { "href_matches": "/admin*" } },
                { "not": { "href_matches": "/logout*" } }
            ]},
            "eagerness": "moderate"
        }]
    }
    </script>
</head>

<body class="vt">
    @php
        $vtPhone = $data_parametre?->contact1;
        $vtWhatsapp = $data_parametre?->contact2;
        $menuEntreprise = collect($categories_pages ?? [])->firstWhere('slug', 'entreprise');
        $estAccueil = request()->routeIs('web.index');
        $ancre = fn ($id) => $estAccueil ? '#' . $id : url('/#' . $id);
    @endphp

    {{-- ===== HEADER ===== --}}
    <header class="vt-header" id="vt-header">
        <div class="container">
            <a class="vt-brand" href="{{ route('web.index') }}" aria-label="FOANI & SERVICES - Accueil">
                <img src="{{ asset('front/images/logoweb.png') }}" alt="" width="46" height="46">
                <span class="vt-brand__txt">
                    <strong>FOANI &amp; SERVICES</strong>
                    <small>Aviculture depuis 50 ans</small>
                </span>
            </a>

            <nav class="vt-nav d-none d-lg-flex" aria-label="Navigation principale">
                <a href="{{ $ancre('home') }}" class="vt-nav__link" data-spy="home">Accueil</a>
                @if ($menuEntreprise && $menuEntreprise->pages->isNotEmpty())
                    <div class="dropdown">
                        <a href="#" class="vt-nav__link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Str::ucfirst(Str::lower($menuEntreprise->libelle)) }}
                        </a>
                        <ul class="dropdown-menu vt-dropdown">
                            @foreach ($menuEntreprise->pages as $page)
                                <li><a class="dropdown-item" href="{{ route('page.show', ['slug' => $page->slug]) }}">{{ Str::ucfirst(Str::lower($page->libelle)) }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="{{ $ancre('activities') }}" class="vt-nav__link" data-spy="activities">Activités</a>
                <a href="{{ $ancre('produits') }}" class="vt-nav__link" data-spy="produits">Produits</a>
                <a href="{{ $ancre('contact') }}" class="vt-nav__link" data-spy="contact">Contact</a>
            </nav>

            <div class="vt-actions">
                @if ($vtPhone)
                    <a href="tel:{{ preg_replace('/\s+/', '', $vtPhone) }}" class="vt-phone d-none d-xl-inline-flex">
                        <i class="bi bi-telephone-fill"></i>
                        <span><small>Appelez-nous</small>{{ $vtPhone }}</span>
                    </a>
                @endif
                <a href="{{ route('boutique.accueil') }}" class="vt-btn vt-btn--shop">
                    <i class="bi bi-basket2-fill"></i><span class="d-none d-sm-inline">Boutique en ligne</span><span class="d-sm-none">Boutique</span>
                </a>
                <button class="vt-burger d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#vtMenu"
                    aria-controls="vtMenu" aria-label="Ouvrir le menu">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
    </header>

    {{-- Menu mobile (panneau latéral) --}}
    <div class="offcanvas offcanvas-end vt-offcanvas" tabindex="-1" id="vtMenu" aria-labelledby="vtMenuLabel">
        <div class="offcanvas-header">
            <span class="vt-brand" id="vtMenuLabel">
                <img src="{{ asset('front/images/logoweb.png') }}" alt="" width="40" height="40">
                <span class="vt-brand__txt"><strong>FOANI &amp; SERVICES</strong></span>
            </span>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="vt-mnav">
                <a href="{{ $ancre('home') }}" data-bs-dismiss="offcanvas"><i class="bi bi-house"></i>Accueil</a>
                <a href="{{ $ancre('about') }}" data-bs-dismiss="offcanvas"><i class="bi bi-building"></i>L'entreprise</a>
                @if ($menuEntreprise)
                    @foreach ($menuEntreprise->pages as $page)
                        <a href="{{ route('page.show', ['slug' => $page->slug]) }}" class="sub"><i class="bi bi-dot"></i>{{ Str::ucfirst(Str::lower($page->libelle)) }}</a>
                    @endforeach
                @endif
                <a href="{{ $ancre('activities') }}" data-bs-dismiss="offcanvas"><i class="bi bi-gear"></i>Activités</a>
                <a href="{{ $ancre('produits') }}" data-bs-dismiss="offcanvas"><i class="bi bi-egg"></i>Nos produits</a>
                <a href="{{ $ancre('points-vente') }}" data-bs-dismiss="offcanvas"><i class="bi bi-geo-alt"></i>Points de vente</a>
                <a href="{{ $ancre('contact') }}" data-bs-dismiss="offcanvas"><i class="bi bi-envelope"></i>Contact</a>
            </nav>
            <a href="{{ route('boutique.accueil') }}" class="vt-btn vt-btn--shop w-100 justify-content-center mt-3">
                <i class="bi bi-basket2-fill"></i> Boutique en ligne
            </a>
            @if ($vtPhone)
                <a href="tel:{{ preg_replace('/\s+/', '', $vtPhone) }}" class="vt-btn vt-btn--ghost w-100 justify-content-center mt-2">
                    <i class="bi bi-telephone-fill"></i> {{ $vtPhone }}
                </a>
            @endif
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="vt-footer">
        <svg class="vt-wave" viewBox="0 0 1440 40" preserveAspectRatio="none" aria-hidden="true">
            <path fill="currentColor" d="M0 40V20c120 14 240 20 360 13s240-25 360-27 240 13 360 18 240-3 360-11v27z" />
        </svg>
        <div class="container">
            <div class="row g-4 g-lg-5">
                <div class="col-lg-4">
                    <div class="vt-brand vt-brand--light mb-3">
                        <img src="{{ asset('front/images/logoweb.png') }}" alt="" width="56" height="56" loading="lazy">
                        <span class="vt-brand__txt"><strong>FOANI &amp; SERVICES</strong><small>Aviculture · Production · Distribution</small></span>
                    </div>
                    <p>{{ $data_parametre?->description_courte ?: "Entreprise familiale devenue un acteur majeur de l'aviculture en Côte d'Ivoire : volailles, œufs et produits d'élevage de qualité." }}</p>
                    <div class="vt-social">
                        @foreach (['lien_facebook' => 'facebook', 'lien_instagram' => 'instagram', 'lien_linkedin' => 'linkedin', 'lien_tiktok' => 'tiktok', 'lien_twitter' => 'twitter-x'] as $champ => $icone)
                            @if ($data_parametre?->$champ)
                                <a href="{{ $data_parametre->$champ }}" target="_blank" rel="noopener" aria-label="{{ ucfirst($icone) }}"><i class="bi bi-{{ $icone }}"></i></a>
                            @endif
                        @endforeach
                        @if ($vtWhatsapp)
                            <a href="https://wa.me/225{{ $vtWhatsapp }}" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        @endif
                    </div>
                </div>

                <div class="col-6 col-lg-2">
                    <h5>Entreprise</h5>
                    <ul class="vt-flinks">
                        <li><a href="{{ $ancre('about') }}">Qui sommes-nous</a></li>
                        @if ($menuEntreprise)
                            @foreach ($menuEntreprise->pages as $page)
                                <li><a href="{{ route('page.show', ['slug' => $page->slug]) }}">{{ Str::ucfirst(Str::lower($page->libelle)) }}</a></li>
                            @endforeach
                        @endif
                        <li><a href="{{ $ancre('activities') }}">Nos activités</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-2">
                    <h5>Boutique</h5>
                    <ul class="vt-flinks">
                        <li><a href="{{ route('boutique.accueil') }}">Accueil boutique</a></li>
                        <li><a href="{{ route('boutique.index') }}">Tous les produits</a></li>
                        <li><a href="{{ route('panier.index') }}">Mon panier</a></li>
                        <li><a href="{{ route('user.loginForm') }}">Mon compte</a></li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h5>Contact</h5>
                    <ul class="vt-fcontact">
                        @if ($data_parametre?->localisation)
                            <li><i class="bi bi-geo-alt-fill"></i><span>{{ $data_parametre->localisation }}</span></li>
                        @endif
                        @if ($vtPhone)
                            <li><i class="bi bi-telephone-fill"></i><a href="tel:{{ preg_replace('/\s+/', '', $vtPhone) }}">{{ $vtPhone }}</a></li>
                        @endif
                        @if ($data_parametre?->email1)
                            <li><i class="bi bi-envelope-fill"></i><a href="mailto:{{ $data_parametre->email1 }}">{{ $data_parametre->email1 }}</a></li>
                        @endif
                    </ul>
                    <a href="{{ route('boutique.accueil') }}" class="vt-btn vt-btn--shop mt-2">
                        <i class="bi bi-basket2-fill"></i> Commander en ligne
                    </a>
                </div>
            </div>

            <div class="vt-fbottom">
                <span>&copy; {{ date('Y') }} FOANI &amp; SERVICES. Tous droits réservés.</span>
                <span>Développé par <a href="https://www.ticafrique.ci" target="_blank" rel="noopener">TICAFRIQUE</a></span>
            </div>
        </div>
    </footer>

    {{-- Barre mobile du bas --}}
    <nav class="vt-mbar d-lg-none" aria-label="Navigation mobile">
        <a href="{{ $ancre('home') }}"><i class="bi bi-house"></i><span>Accueil</span></a>
        <a href="{{ $ancre('activities') }}"><i class="bi bi-gear"></i><span>Activités</span></a>
        <a href="{{ route('boutique.accueil') }}" class="is-shop"><i class="bi bi-basket2-fill"></i><span>Boutique</span></a>
        <a href="{{ $ancre('points-vente') }}"><i class="bi bi-geo-alt"></i><span>Points</span></a>
        <a href="{{ $ancre('contact') }}"><i class="bi bi-envelope"></i><span>Contact</span></a>
    </nav>

    {{-- Boutons flottants (empilés) : retour en haut, Facebook, WhatsApp --}}
    <div class="vt-fabs">
        <button type="button" class="vt-fab vt-fab--top" id="vt-top" aria-label="Remonter en haut"><i class="bi bi-arrow-up"></i></button>
        <a href="https://www.facebook.com/foaniservices" target="_blank" rel="noopener" class="vt-fab vt-fab--fb"
            aria-label="Suivez-nous sur Facebook" title="Suivez-nous sur Facebook">
            <i class="bi bi-facebook"></i>
        </a>
        @if ($vtWhatsapp)
            <a href="https://wa.me/225{{ $vtWhatsapp }}" target="_blank" rel="noopener" class="vt-fab vt-fab--wa"
                aria-label="Nous écrire sur WhatsApp" title="Nous écrire sur WhatsApp">
                <i class="bi bi-whatsapp"></i>
            </a>
        @endif
    </div>

    {{-- Messages (ex. formulaire de contact envoyé) --}}
    @foreach (['success' => 'bi-check-circle-fill', 'error' => 'bi-exclamation-octagon-fill'] as $type => $icone)
        @if (session($type))
            <div class="vt-toast vt-toast--{{ $type }}" role="status">
                <i class="bi {{ $icone }}"></i><span>{{ session($type) }}</span>
                <button type="button" aria-label="Fermer" onclick="this.parentElement.remove()"><i class="bi bi-x-lg"></i></button>
            </div>
        @endif
    @endforeach

    <script src="{{ asset('front/vendor/bootstrap-5.3.3/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
