<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        @if ($data_parametre != null)
            <a href="#" class="logo logo-light">
                <span class="logo-lg">
                    <img src="{{ $data_parametre ? URL::asset($data_parametre->getFirstMediaUrl('logo_header')) : URL::asset('images/camera-icon.png') }}"
                        alt="logo" width="auto" class="rounded-circle" height="60">
                </span>
            </a>
        @endif
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>

            <ul class="navbar-nav" id="navbar-nav">

                {{-- 1. Tableau de bord --}}
                @can('voir-tableau de bord')
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Route::is('dashboard.*') ? 'active' : '' }}"
                            href="{{ route('dashboard.index') }}">
                            <i class="ri-dashboard-2-line me-2"></i> <span>TABLEAU DE BORD</span>
                        </a>
                    </li>
                @endcan

                {{-- 2. Commandes --}}
                <li class="nav-item">
                    <a href="{{ route('commandes.index') }}"
                        class="nav-link menu-link {{ Route::is('commandes.*') ? 'active' : '' }}">
                        <i class="bi bi-bag-check me-1"></i> COMMANDES
                    </a>
                </li>

                {{-- 3. Réservations --}}
                <li class="nav-item">
                    <a href="{{ route('reservation.index') }}"
                        class="nav-link menu-link {{ Route::is('reservation.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check me-1"></i> RESERVATIONS
                    </a>
                </li>

                {{-- 4. Clients --}}
                <li class="nav-item">
                    <a href="{{ route('client.index_client') ?? '#' }}"
                        class="nav-link menu-link {{ Route::is('client.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i> <span>Clients</span>
                    </a>
                </li>

                {{-- 5. Produits --}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('produit.*') ? 'active' : '' }}"
                        href="{{ route('produit.index') }}">
                        <i class="ri-shopping-bag-3-line me-2"></i> <span>Produits</span>
                    </a>
                </li>

                {{-- 6. Catégories --}}
                <li class="nav-item">
                    <a href="{{ route('categorie.index') }}"
                        class="nav-link {{ Route::is('categorie.*') ? 'active' : '' }}">
                        <i class="ri-price-tag-3-line me-2"></i> <span>Catégories</span>
                    </a>
                </li>

                {{-- 7. Offres / Promotions --}}
                <li class="nav-item">
                    <a href="{{ route('offre.index') }}" class="nav-link {{ Route::is('offre.*') ? 'active' : '' }}">
                        <i class="ri-gift-line me-2"></i> <span>Offres</span>
                    </a>
                </li>

                {{-- 8. Points de vente --}}
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between" href="#menuPointsVente"
                        data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="menuPointsVente">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-shop me-2"></i> <span>Points de vente</span>
                        </div>
                    </a>
                    <div class="collapse menu-dropdown" id="menuPointsVente">
                        <ul class="nav nav-sm flex-column ms-4">
                            <li class="nav-item">
                                <a href="{{ route('ville_point_vente.index') }}"
                                    class="nav-link d-flex align-items-center">
                                    <i class="bi bi-list-check me-2"></i> Gestion des points de vente
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('categorie_point_de_vente.index') }}"
                                    class="nav-link d-flex align-items-center">
                                    <i class="bi bi-tags-fill me-2"></i> Catégories des points de vente
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('ville.index') }}" class="nav-link d-flex align-items-center">
                                    <i class="bi bi-geo-alt-fill me-2"></i> Villes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('commune.index') }}" class="nav-link d-flex align-items-center">
                                    <i class="bi bi-building-fill me-2"></i> Communes
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- 9. Points de livraison --}}
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between" href="#menuLivraison"
                        data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="menuLivraison">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-truck me-2"></i> <span>Points de livraison</span>
                        </div>
                    </a>
                    <div class="collapse menu-dropdown" id="menuLivraison">
                        <ul class="nav nav-sm flex-column ms-4">
                            <li class="nav-item">
                                <a href="{{ route('ville.index') }}" class="nav-link d-flex align-items-center">
                                    <i class="bi bi-geo-alt-fill me-2"></i> Villes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('commune.index') }}" class="nav-link d-flex align-items-center">
                                    <i class="bi bi-building-fill me-2"></i> Communes
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- 10. Candidats --}}
                <li class="nav-item">
                    <a href="{{ route('candidats.index') }}"
                        class="nav-link {{ request()->routeIs('candidats.*') ? 'active' : '' }}">
                        <i class="ri-user-follow-line me-2"></i> Candidats
                    </a>
                </li>

                {{-- 11. Pages & Sliders --}}
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="#menuPages" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="menuPages">
                        <i class="bi bi-file-earmark-fill me-2"></i> GESTION DE PAGE
                    </a>
                    <div class="collapse menu-dropdown {{ Route::is('pages.*') || Route::is('categorie_page.*') ? 'show' : '' }}" id="menuPages">
                        <ul class="nav nav-sm flex-column ms-3">
                            <li class="nav-item">
                                <a href="{{ route('categorie_page.index') }}"
                                    class="nav-link {{ Route::is('categorie_page.*') ? 'active' : '' }} d-flex align-items-center">
                                    <i class="bi bi-bookmark-fill me-2"></i> Catégories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pages.index') }}" class="nav-link {{ Route::is('pages.*') ? 'active' : '' }} d-flex align-items-center">
                                    <i class="bi bi-bookmark-fill me-2"></i> Pages
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('sliders*') ? 'active' : '' }}"
                        href="{{ route('sliders.index') }}">
                        <i class="bi bi-images me-2"></i> <span>Sliders</span>
                    </a>
                </li>

                {{-- 12. Paramètres --}}
                @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'developpeur' || Auth::user()->can('voir-parametre'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAuth">
                            <i class="ri-settings-2-fill me-2"></i> <span>Paramètres</span>
                        </a>
                        <div class="collapse menu-dropdown {{ Route::is('role.*') || Route::is('parametre.*') || Route::is('module.*') || Route::is('permission.*') || Route::is('admin-register.*') ? 'show' : '' }}"
                            id="sidebarAuth">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('parametre.index') }}"
                                        class="nav-link {{ Route::is('parametre.*') ? 'active' : '' }}">
                                        <i class="ri-information-line me-2"></i> Informations
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin-register.index') }}"
                                        class="nav-link {{ Route::is('admin-register.*') ? 'active' : '' }}">
                                        <i class="ri-user-settings-line me-2"></i> Utilisateurs
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('module.index') }}"
                                        class="nav-link {{ Route::is('module.*') ? 'active' : '' }}">
                                        <i class="ri-apps-2-line me-2"></i> Modules
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('role.index') }}"
                                        class="nav-link {{ Route::is('role.*') ? 'active' : '' }}">
                                        <i class="ri-user-star-line me-2"></i> Rôles
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('permission.index') }}"
                                        class="nav-link {{ Route::is('permission.*') ? 'active' : '' }}">
                                        <i class="ri-key-2-line me-2"></i> Permissions / Rôles
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>
