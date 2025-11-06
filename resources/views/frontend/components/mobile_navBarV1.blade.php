{{-- filepath: c:\laragon\www\foani\resources\views\frontend\components\mobile_navBar.blade.php --}}
<style>
    /* Mobile Bottom Bar Styles */
    #mobile-bottom-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 1050;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-top: 1px solid rgba(42, 107, 42, 0.1);
        box-shadow: 0 -8px 32px rgba(0, 0, 0, 0.1);
    }

    .mobile-bar-content {
        padding: 12px 8px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 249, 250, 0.9));
    }

    /* Mobile Search Bar */
    /* .mobile-search-container {
        position: absolute;
        bottom: 100%;
        left: 0;
        right: 0;
        background: white;
        border-top: 1px solid #e9ecef;
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
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

    /* .mobile-search-container .input-group {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(42, 107, 42, 0.1);
    }

    .mobile-search-container .form-control {
        border: 2px solid #e9ecef;
        border-right: none;
        padding: 12px 15px;
        font-size: 0.95rem;
    }

    .mobile-search-container .form-control:focus {
        border-color: var(--color-vert);
        box-shadow: none;
    }

    .mobile-search-container .btn {
        border: 2px solid #e9ecef;
        border-left: none;
        padding: 12px 15px;
    } */

    /* Mobile Navigation Buttons */
    .mobile-nav-btn {
        width: 55px;
        height: 55px;
        border: 2px solid transparent;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        color: var(--color-vert);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .mobile-nav-btn::before {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .mobile-nav-btn:hover,
    .mobile-nav-btn.active {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(42, 107, 42, 0.2);
        background: var(--color-vert);
        color: white;
        border-color: var(--color-vert);
    }

    .mobile-nav-btn:hover::before,
    .mobile-nav-btn.active::before {
        opacity: 1;
    }

    .mobile-nav-btn i {
        font-size: 1.4rem;
        transition: all 0.3s ease;
    }

    .mobile-nav-btn:hover i,
    .mobile-nav-btn.active i {
        transform: scale(1.1);
        color: white;
    }

    /* Bouton panier spécial */
    .mobile-nav-btn.cart-btn {
        background: linear-gradient(135deg, var(--color-jaune), #f39c12);
        color: #333;
        box-shadow: 0 4px 15px rgba(241, 196, 15, 0.3);
    }

    .mobile-nav-btn.cart-btn:hover,
    .mobile-nav-btn.cart-btn.active {
        background: linear-gradient(135deg, #f1c40f, #e67e22);
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 8px 25px rgba(241, 196, 15, 0.4);
    }

    .mobile-nav-btn.cart-btn i {
        color: white;
    }

    /* Badge panier */
    .cart-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: linear-gradient(135deg, var(--color-rouge), #c0392b);
        color: white;
        font-size: 0.7rem;
        font-weight: 700;
        min-width: 20px;
        height: 20px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
        box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
        animation: cartBadgeAppear 0.5s ease-out, pulse 2s infinite 0.5s;
        z-index: 10;
    }

    @keyframes cartBadgeAppear {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }

        50% {
            transform: scale(1.2);
        }

        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    /* Bouton recherche actif */
    .mobile-nav-btn.search-active {
        background: var(--color-jaune);
        color: #333;
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(241, 196, 15, 0.4);
    }

    .mobile-nav-btn.search-active i {
        color: #333;
    }

    /* Dropdown pour utilisateur connecté */
    .mobile-dropdown {
        position: relative;
    }

    .mobile-dropdown .dropdown-menu {
        bottom: 70px;
        top: auto;
        right: 10px;
        left: auto;
        min-width: 220px;
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        padding: 10px 0;
    }

    .mobile-dropdown .dropdown-item {
        padding: 12px 20px;
        font-size: 0.9rem;
        font-weight: 500;
        color: #495057;
        transition: all 0.3s ease;
        border-radius: 10px;
        margin: 2px 10px;
    }

    .mobile-dropdown .dropdown-item:hover {
        background: linear-gradient(135deg, rgba(42, 107, 42, 0.1), rgba(42, 107, 42, 0.05));
        color: var(--color-vert);
        transform: translateX(5px);
    }

    .mobile-dropdown .dropdown-item.text-danger:hover {
        background: linear-gradient(135deg, rgba(231, 76, 60, 0.1), rgba(231, 76, 60, 0.05));
        color: var(--color-rouge);
    }

    .mobile-dropdown .dropdown-divider {
        margin: 8px 20px;
        border-color: rgba(42, 107, 42, 0.1);
    }

    /* Animation d'apparition */
    .mobile-bar-content .mobile-nav-btn {
        animation: slideUp 0.6s ease-out;
    }

    .mobile-bar-content .mobile-nav-btn:nth-child(1) {
        animation-delay: 0.1s;
    }

    .mobile-bar-content .mobile-nav-btn:nth-child(2) {
        animation-delay: 0.2s;
    }

    .mobile-bar-content .mobile-nav-btn:nth-child(3) {
        animation-delay: 0.3s;
    }

    .mobile-bar-content .mobile-nav-btn:nth-child(4) {
        animation-delay: 0.4s;
    }

    .mobile-bar-content .mobile-nav-btn:nth-child(5) {
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

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .mobile-nav-btn {
            width: 50px;
            height: 50px;
        }

        .mobile-nav-btn i {
            font-size: 1.2rem;
        }

        .mobile-bar-content {
            padding: 10px 5px;
        }
    }
</style>

<div id="mobile-bottom-bar" class="d-lg-none d-md-none d-block">
    {{-- Barre de recherche mobile (toggle) --}}
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
            class="mobile-nav-btn {{ request()->routeIs('accueil') || request()->routeIs('home') ? 'active' : '' }}"
            title="Accueil">
            <i class="bi bi-house-fill"></i>
        </a>

        {{-- Bouton de recherche --}}
        {{-- <button class="mobile-nav-btn" id="search-toggle-btn" onclick="toggleMobileSearch()"
                title="Rechercher" type="button">
            <i class="bi bi-search"></i>
        </button> --}}

        {{-- Bouton de categories --}}
        <a href="{{ route('categories') }}"
            class="btn btn-outline-success rounded-circle flex-shrink-0 {{ request()->routeIs('categories') ? 'active' : '' }}"
            title="Catégories">
            <i class="bi bi-list fs-3"></i>
        </a>

        {{-- Panier --}}
        <a href="{{ route('panier.index') }}"
            class="mobile-nav-btn cart-btn {{ request()->routeIs('panier.*') ? 'active' : '' }}" title="Panier"
            id="mobile-cart-btn">
            <i class="bi bi-cart-fill"></i>

            <span id="cart-badge-mobile" class="cart-badge">
                {{ $count }}
            </span>

        </a>

        {{-- Boutique --}}
        <a href="{{ route('boutique.index') }}"
            class="mobile-nav-btn {{ request()->routeIs('boutique.*') && !request()->routeIs('boutique.categorie') ? 'active' : '' }}"
            title="Boutique">
            <i class="bi bi-shop-window"></i>
        </a>

        {{-- Connexion ou Profil --}}
        @guest
            <a href="{{ route('user.loginForm') }}"
                class="mobile-nav-btn {{ request()->routeIs('user.loginForm') || request()->routeIs('user.registerForm') ? 'active' : '' }}"
                title="Se connecter">
                <i class="bi bi-person-circle"></i>
            </a>
        @else
            <div class="mobile-dropdown dropup">
                <a href="#" class="mobile-nav-btn dropdown-toggle {{ request()->routeIs('user.*') ? 'active' : '' }}"
                    data-bs-toggle="dropdown" aria-expanded="false" title="Mon compte">
                    <i class="bi bi-person-check-fill"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
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

{{-- <script>
    // Variables globales
    let searchBarVisible = false;

    // Fonction pour toggle la barre de recherche
    function toggleMobileSearch() {
        const searchBar = document.getElementById('mobile-search-bar');
        const searchBtn = document.getElementById('search-toggle-btn');
        
        if (searchBarVisible) {
            // Fermer la barre de recherche
            searchBar.classList.remove('show');
            searchBtn.classList.remove('search-active');
            searchBarVisible = false;
            
            // Focus sur l'input après ouverture
            setTimeout(() => {
                const input = searchBar.querySelector('input[name="recherche"]');
                if (input) {
                    input.blur();
                }
            }, 100);
        } else {
            // Ouvrir la barre de recherche
            searchBar.classList.add('show');
            searchBtn.classList.add('search-active');
            searchBarVisible = true;
            
            // Focus sur l'input après ouverture
            setTimeout(() => {
                const input = searchBar.querySelector('input[name="recherche"]');
                if (input) {
                    input.focus();
                }
            }, 350);
        }
    }

    // Fermer la recherche si on clique ailleurs
    document.addEventListener('click', function(event) {
        const searchBar = document.getElementById('mobile-search-bar');
        const searchBtn = document.getElementById('search-toggle-btn');
        const mobileBar = document.getElementById('mobile-bottom-bar');
        
        // Vérifier si le clic est en dehors de la barre mobile
        if (!mobileBar.contains(event.target) && searchBarVisible) {
            searchBar.classList.remove('show');
            searchBtn.classList.remove('search-active');
            searchBarVisible = false;
        }
    });

    // Fermer avec la touche Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && searchBarVisible) {
            toggleMobileSearch();
        }
    });

    // Animation au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.mobile-nav-btn');
        buttons.forEach((btn, index) => {
            btn.style.animationDelay = (index * 0.1) + 's';
        });
        
        // Initialiser l'état de la barre de recherche
        const searchBar = document.getElementById('mobile-search-bar');
        if (searchBar) {
            searchBar.classList.remove('show');
            searchBarVisible = false;
        }
    });

    // Fonction améliorée pour mise à jour du badge panier
    function updateCartBadge(count) {
        const cartBtn = document.getElementById('mobile-cart-btn');
        let badge = document.getElementById('cart-badge-mobile');
        
        console.log('Updating cart badge:', count); // Debug
        
        if (count > 0) {
            if (!badge) {
                // Créer le badge s'il n'existe pas
                badge = document.createElement('span');
                badge.id = 'cart-badge-mobile';
                badge.className = 'cart-badge';
                badge.textContent = count;
                cartBtn.appendChild(badge);
                
                console.log('Badge created with count:', count); // Debug
            } else {
                // Mettre à jour le badge existant
                badge.textContent = count;
                
                // Animation de mise à jour
                badge.style.animation = 'none';
                setTimeout(() => {
                    badge.style.animation = 'cartBadgeAppear 0.3s ease-out';
                }, 10);
                
                console.log('Badge updated with count:', count); // Debug
            }
        } else {
            // Supprimer le badge si le panier est vide
            if (badge) {
                badge.style.animation = 'none';
                badge.style.transform = 'scale(0)';
                badge.style.opacity = '0';
                setTimeout(() => {
                    if (badge && badge.parentNode) {
                        badge.remove();
                    }
                }, 200);
                
                console.log('Badge removed'); // Debug
            }
        }
    }

    // Fonction globale pour mettre à jour depuis d'autres scripts
    window.updateMobileCartBadge = updateCartBadge;

    // Écouter les événements de mise à jour du panier
    document.addEventListener('cartUpdated', function(event) {
        if (event.detail && typeof event.detail.count !== 'undefined') {
            updateCartBadge(event.detail.count);
        }
    });

    // Écouter les changements dans le localStorage pour synchroniser
    window.addEventListener('storage', function(event) {
        if (event.key === 'cart_count') {
            const count = parseInt(event.newValue) || 0;
            updateCartBadge(count);
        }
    });
</script> --}}
