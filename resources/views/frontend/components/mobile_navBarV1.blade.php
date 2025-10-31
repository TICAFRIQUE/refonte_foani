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