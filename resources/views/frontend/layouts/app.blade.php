<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Foani - Boutique en ligne de volaille et œufs frais. Découvrez nos produits de qualité, directement de la ferme à votre table. Commandez maintenant!">
    <meta name="keywords" content="Foani, volaille, œufs, boutique en ligne, produits frais, ferme, livraison">
    <meta name="author" content="Foani">
    <title>Foani - Boutique Volaille & Œufs</title>
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

    <style>
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
    </style>
</head>

<body>
    <!-- Header & Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm" style="background-color:#559e33;">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('accueil') }}    ">
                {{-- <div id="logo" class="rounded-circle">
                    <img  src="{{ $data_parametre ? URL::asset($data_parametre->getFirstMediaUrl('logo_header')) : URL::asset('images/camera-icon.png') }}"
                    alt="Foani" height="60" class="me-2 ">
                </div> --}}
                <div id="logo" class="logo-wrapper rounded-circle">
                    <img src="{{ $data_parametre ? URL::asset($data_parametre->getFirstMediaUrl('logo_header')) : URL::asset('images/camera-icon.png') }}"
                        alt="Foani" class="logo-image">
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0 fw-bold">
                    <li class="nav-item"><a class="nav-link text-white {{ Route::is('accueil') ? 'active' : '' }}"
                            href="{{ route('accueil') }}"> <i class="bi bi-house-door-fill"></i> ACCUEIL</a></li>


                    @foreach ($categories_pages->where('slug', '!=', 'activites') as $categorie_page)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white px-1 {{ Route::is('page.*') ? 'active' : '' }}"
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
                            href="{{ route('page.activites') }}">NOS
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
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('panier.index') }}"
                        class="btn btn-outline-light rounded-circle position-relative">
                        <i class="bi bi-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $count ?? 0 }}
                        </span>
                    </a>


                    @guest
                        <a href="{{ route('user.loginForm') }}" class="btn btn-outline-light rounded-pill px-3"> <i
                                class="bi bi-person"></i>
                            Se connecter</a>
                        <a href="{{ route('user.registerForm') }}" class="btn btn-outline-light rounded-pill px-3"> <i
                                class="bi bi-person-plus"></i>
                            S'inscrire</a>
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
                                <li><a class="dropdown-item" href="{{ route('user.logout') }}">Déconnexion</a></li>
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


    <!-- Bouton remonter en haut & WhatsApp -->
    <a href="#" id="btnScrollTop" class="btn btn-success rounded-circle shadow position-fixed"
        style="bottom: 90px; right: 25px; z-index: 999; width: 48px; height: 48px; display: none;">
        <i class="bi bi-arrow-up fs-4"></i>
    </a>
    <a href="https://wa.me/2250505969625" target="_blank" id="btnWhatsapp"
        class="btn btn-success rounded-circle shadow position-fixed"
        style="bottom: 25px; right: 25px; z-index: 999; width: 48px; height: 48px;">
        <i class="bi bi-whatsapp fs-3"></i>
    </a>

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
                &copy; {{ date('Y') }} Foani. Tous droits réservés.
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
</body>

</html>
