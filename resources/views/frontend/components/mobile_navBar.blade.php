{{-- filepath: c:\laragon\www\foani\resources\views\frontend\components\mobile_navBar.blade.php --}}
<style>
    #mobile-bottom-bar {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1050;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        box-shadow: 0 -8px 32px rgba(42, 107, 42, 0.15);
        padding: 0.8rem 0;
        border-top: 3px solid var(--color-vert);
    }

    .mobile-bar-content {
        max-width: 480px;
        margin: 0 auto;
        gap: 0.8rem;
    }

    /* Barre de recherche mobile */
    /* .mobile-search-container {
        position: absolute;
        bottom: 100%;
        left: 0;
        right: 0;
        background: white;
        border-top: 2px solid var(--color-vert);
        box-shadow: 0 -4px 20px rgba(42, 107, 42, 0.1);
        transform: translateY(10px);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .mobile-search-container.show {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
    } */

    /* Styles des boutons améliorés */
    #mobile-bottom-bar .btn {
        font-size: 1rem;
        width: 56px;
        height: 56px;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
        border-width: 2px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    #mobile-bottom-bar .btn:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(42, 107, 42, 0.2);
    }

    /* États actifs pour chaque bouton */
    #mobile-bottom-bar .btn.btn-outline-success.active {
        background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
        border-color: var(--color-vert);
        color: white;
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(42, 107, 42, 0.3);
    }

    #mobile-bottom-bar .btn.btn-warning.active {
        background: linear-gradient(135deg, #f1c40f, #e67e22);
        border-color: var(--color-jaune);
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 8px 20px rgba(241, 196, 15, 0.4);
    }

    #mobile-bottom-bar .btn.btn-success.active {
        background: linear-gradient(135deg, var(--color-vert), #4CAF50);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(42, 107, 42, 0.3);
    }

    /* Effets spéciaux pour les icônes */
    #mobile-bottom-bar .btn i {
        transition: all 0.3s ease;
    }

    #mobile-bottom-bar .btn:hover i,
    #mobile-bottom-bar .btn.active i {
        transform: scale(1.1);
    }

    /* Badge panier amélioré */
    #cart-badge-mobile {
        font-size: 0.7rem !important;
        min-width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        animation: pulse 2s infinite;
        box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
    }

    @keyframes pulse {

        0%,
        100% {
            transform: translate(-50%, -50%) scale(1);
        }

        50% {
            transform: translate(-50%, -50%) scale(1.1);
        }
    }

    /* Badge visible seulement si count > 0 */
    #cart-badge-mobile:empty,
    #cart-badge-mobile[data-count="0"] {
        display: none !important;
    }

    /* Dropdown menu amélioré */
    .dropup .dropdown-menu {
        bottom: 70px !important;
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        padding: 8px 0;
        min-width: 200px;
    }

    .dropup .dropdown-item {
        padding: 10px 18px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        border-radius: 10px;
        margin: 2px 8px;
    }

    .dropup .dropdown-item:hover {
        background: linear-gradient(135deg, rgba(42, 107, 42, 0.1), rgba(42, 107, 42, 0.05));
        color: var(--color-vert);
        transform: translateX(5px);
    }

    .dropup .dropdown-item.text-danger:hover {
        background: linear-gradient(135deg, rgba(231, 76, 60, 0.1), rgba(231, 76, 60, 0.05));
        color: var(--color-rouge);
    }

    /* Animation d'entrée */
    #mobile-bottom-bar .btn {
        animation: slideUp 0.6s ease-out;
    }

    #mobile-bottom-bar .btn:nth-child(1) {
        animation-delay: 0.1s;
    }

    #mobile-bottom-bar .btn:nth-child(2) {
        animation-delay: 0.2s;
    }

    #mobile-bottom-bar .btn:nth-child(3) {
        animation-delay: 0.3s;
    }

    #mobile-bottom-bar .btn:nth-child(4) {
        animation-delay: 0.4s;
    }

    #mobile-bottom-bar .btn:nth-child(5) {
        animation-delay: 0.5s;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (min-width: 768px) {
        #mobile-bottom-bar {
            display: none !important;
        }
    }

    @media (max-width: 576px) {
        #mobile-bottom-bar .btn {
            width: 52px;
            height: 52px;
            font-size: 0.9rem;
        }

        .mobile-bar-content {
            gap: 0.6rem;
        }
    }
</style>
<div id="mobile-bottom-bar" class="d-lg-none d-md-none d-block">
    {{-- Barre de recherche mobile (toggle) --}}
    <div id="mobile-search-bar" class="mobile-search-container" style="display: none;">
        <div class="p-3 bg-white border-top">
            <form method="GET" action="{{ route('boutique.index') }}">
                <div class="input-group">
                    <input type="text" name="recherche" class="form-control" placeholder="Rechercher un produit..."
                        value="{{ request('recherche') }}">
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
        <a href="{{ route('accueil') }}"
            class="btn btn-outline-success rounded-circle flex-shrink-0 {{ request()->routeIs('accueil') || request()->routeIs('home') ? 'active' : '' }}"
            title="Accueil">
            <i class="bi bi-house fs-3"></i>
        </a>

        {{-- Bouton de recherche --}}
        <button class="btn btn-outline-success rounded-circle flex-shrink-0" id="search-toggle-btn"
            onclick="toggleMobileSearch()" title="Rechercher">
            <i class="bi bi-search fs-3"></i>
        </button>

        {{-- Panier --}}
        <a href="{{ route('panier.index') }}"
            class="btn btn-warning rounded-circle position-relative flex-shrink-0 {{ request()->routeIs('panier.*') ? 'active' : '' }}"
            title="Panier">
            <i class="bi bi-cart fs-3 text-white"></i>

            <span id="cart-badge-mobile"
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                style="font-size:0.8rem;">
                {{ $count ?? 0 }}
            </span>

        </a>

        {{-- Panier --}}
        <a href="{{ route('panier.index') }}" class="btn btn-warning rounded-circle position-relative flex-shrink-0"
            title="Panier">
            <i class="bi bi-cart fs-3 text-white"></i>
            <span id="cart-badge-mobile"
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                style="font-size:0.8rem;">
                {{ $count ?? 0 }}
            </span>
        </a>

        {{-- Boutique --}}
        <a href="{{ route('boutique.index') }}"
            class="btn btn-outline-success rounded-circle flex-shrink-0 {{ request()->routeIs('boutique.*') && !request()->routeIs('panier.*') ? 'active' : '' }}"
            title="Boutique">
            <i class="bi bi-shop fs-3"></i>
        </a>

        {{-- Connexion ou Profil (menu déroulant si connecté) --}}
        @guest
            <a href="{{ route('user.loginForm') }}"
                class="btn btn-outline-success rounded-circle flex-shrink-0 {{ request()->routeIs('user.loginForm') || request()->routeIs('user.registerForm') ? 'active' : '' }}"
                title="Se connecter">
                <i class="bi bi-person fs-3"></i>
            </a>
        @else
            <div class="dropup">
                <a href="#"
                    class="btn btn-success rounded-circle flex-shrink-0 dropdown-toggle {{ request()->routeIs('user.*') && !request()->routeIs('user.loginForm') && !request()->routeIs('user.registerForm') ? 'active' : '' }}"
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
