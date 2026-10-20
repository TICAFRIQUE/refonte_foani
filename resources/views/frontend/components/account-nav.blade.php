{{-- Menu de l'espace client (profil, commandes, réservations) --}}
<nav class="account-nav" aria-label="Mon compte">
    <a href="{{ route('user.profil') }}" class="{{ request()->routeIs('user.profil') ? 'active' : '' }}">
        <i class="bi bi-person"></i><span>Mon profil</span>
    </a>
    <a href="{{ route('user.commandes') }}" class="{{ request()->routeIs('user.commandes*') ? 'active' : '' }}">
        <i class="bi bi-bag-check"></i><span>Mes commandes</span>
    </a>
    <a href="{{ route('user.reservations') }}" class="{{ request()->routeIs('user.reservations*') ? 'active' : '' }}">
        <i class="bi bi-calendar-check"></i><span>Mes réservations</span>
    </a>
    <a href="{{ route('user.logout') }}" class="logout">
        <i class="bi bi-box-arrow-right"></i><span>Déconnexion</span>
    </a>
</nav>
