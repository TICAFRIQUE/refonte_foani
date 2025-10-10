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

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/carousel-animate.css') }}">

    @stack('styles')

</head>

<body>
    <!-- Header & Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm" style="background-color:#2a6b2a;">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <img src="{{ asset('front/images/logo.png') }}" alt="Foani" height="60" class="me-2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0 fw-bold">
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('accueil') }}">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Entreprise</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Activités</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Conseils</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Points de vente</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Boutique</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Contacts</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('panier.index') }}"
                        class="btn btn-outline-light rounded-circle position-relative">
                        <i class="bi bi-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $count ?? 0 }}
                        </span>
                    </a>
                    <a href="#" class="btn btn-outline-light rounded-pill px-3">Login</a>
                    <a href="#" class="btn btn-outline-light rounded-pill px-3">Register</a>
                </div>
            </div>
        </div>
    </nav>



    <!-- Yield content -->

    @yield('content')


    <!-- Footer -->
    <footer class="footer py-4 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5>Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">Produits</a></li>
                        <li><a href="#">Catégories</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <p><i class="bi bi-envelope me-2"></i> contact@foani.fr</p>
                    <p><i class="bi bi-telephone me-2"></i> 01 23 45 67 89</p>
                </div>
                <div class="col-md-4">
                    <h5>Suivez-nous</h5>
                    <a href="#" class="me-2"><i class="bi bi-facebook fs-4"></i></a>
                    <a href="#" class="me-2"><i class="bi bi-instagram fs-4"></i></a>
                    <a href="#" class="me-2"><i class="bi bi-twitter fs-4"></i></a>
                </div>
            </div>
            <hr>
            <div class="text-center">
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
</body>

</html>
