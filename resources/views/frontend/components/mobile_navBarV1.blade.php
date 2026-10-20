{{-- Barre de navigation mobile (fixée en bas, masquée sur grand écran) --}}
<style>
    .mbar {
        position: fixed;
        left: 10px;
        right: 10px;
        bottom: 10px;
        z-index: 1040;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        align-items: end;
        padding: 6px 4px;
        background: rgba(255, 255, 255, .97);
        border: 1px solid var(--line, #e7dcc2);
        border-radius: 22px;
        box-shadow: 0 10px 30px rgba(28, 67, 25, .18);
        backdrop-filter: blur(10px);
    }

    .mbar > a,
    .mbar > .dropup > button {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
        padding: 4px 0;
        border: 0;
        background: none;
        color: var(--ink-soft, #5e6a57);
        font: 600 11px/1.2 var(--font-title, sans-serif);
        text-decoration: none;
    }

    .mbar > a > i, .mbar > .dropup > button > i { font-size: 1.3rem; line-height: 1; }
    .mbar .active { color: var(--leaf-dark, #2a6b2a); }
    .mbar .active i { transform: translateY(-1px); }

    /* Bouton central « Le site » mis en avant */
    .mbar .mbar-site i {
        width: 52px;
        height: 52px;
        margin-top: -26px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        background: var(--straw, #f1c40f);
        color: var(--forest, #1c4319);
        font-size: 1.45rem;
        box-shadow: 0 0 0 5px #fff, 0 6px 16px rgba(0, 0, 0, .2);
    }

    .mbar .mbar-site span { color: var(--forest, #1c4319); }

    .mbar .cart-badge {
        position: absolute;
        top: -2px;
        left: 50%;
        margin-left: 4px;
        min-width: 18px;
        height: 18px;
        padding: 0 4px;
        border-radius: 999px;
        background: var(--barn, #a61c1c);
        color: #fff;
        font: 700 10px/18px var(--font-body, sans-serif);
        text-align: center;
    }

    .mbar .dropdown-menu { border-radius: 14px; }

    @media (min-width: 992px) {
        .mbar { display: none; }
    }

</style>

<nav class="mbar" aria-label="Navigation mobile">
    <a href="{{ route('boutique.accueil') }}" class="{{ request()->routeIs('boutique.accueil') ? 'active' : '' }}">
        <i class="bi bi-shop"></i><span>Boutique</span>
    </a>

    <a href="{{ route('boutique.index') }}"
        class="{{ request()->routeIs('boutique.index') || request()->routeIs('boutique.categorie') || request()->routeIs('categories') ? 'active' : '' }}">
        <i class="bi bi-grid"></i><span>Produits</span>
    </a>

    <a href="{{ route('web.index') }}" class="mbar-site" title="Découvrir le site Foani & Services">
        <i class="bi bi-house-heart-fill"></i><span>Le site</span>
    </a>

    <a href="{{ route('panier.index') }}" class="{{ request()->routeIs('panier.*') ? 'active' : '' }}" id="mobile-cart-btn">
        <i class="bi bi-basket2"></i><span>Panier</span>
        <span id="cart-badge-mobile" class="cart-badge" data-cart-count>{{ $count ?? 0 }}</span>
    </a>

    @guest
        <a href="{{ route('user.loginForm') }}"
            class="{{ request()->routeIs('user.loginForm') || request()->routeIs('user.registerForm') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i><span>Compte</span>
        </a>
    @else
        <div class="dropup">
            <button type="button" class="w-100 {{ request()->routeIs('user.*') ? 'active' : '' }}" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-person-check-fill"></i><span>Compte</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('user.profil') }}"><i class="bi bi-person me-2"></i>Mon profil</a></li>
                <li><a class="dropdown-item" href="{{ route('user.commandes') }}"><i class="bi bi-bag-check me-2"></i>Mes commandes</a></li>
                <li><a class="dropdown-item" href="{{ route('user.reservations') }}"><i class="bi bi-calendar-check me-2"></i>Mes réservations</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="{{ route('user.logout') }}"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a></li>
            </ul>
        </div>
    @endguest
</nav>
