{{-- Sidebar du back-office (styles : public/back/css/admin.css) --}}
@php
    $logoAdmin = $data_parametre?->getFirstMediaUrl('logo_header') ?: asset('front/images/logo.png');
    $estAdminComplet = Auth::user()->role == 'superadmin' || Auth::user()->role == 'developpeur' || Auth::user()->can('voir-parametre');

    // Sous-menus ouverts selon la page courante
    $ouvert = [
        'pointsVente' => Route::is('categorie_point_de_vente.*') || Route::is('point_vente.*'),
        'livraison' => Route::is('ville.*') || Route::is('commune.*'),
        'pages' => Route::is('pages.*') || Route::is('categorie_page.*'),
        'admin' => Route::is('role.*') || Route::is('parametre.*') || Route::is('module.*') || Route::is('permission.*') || Route::is('admin-register.*'),
    ];
@endphp

<div class="app-menu navbar-menu">
    {{-- Logo --}}
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard.index') }}" class="foani-brand" aria-label="Tableau de bord">
            <img src="{{ $logoAdmin }}" alt="FOANI" width="42" height="42">
            <span class="foani-brand__txt">
                <strong>FOANI</strong>
                <small>Espace administration</small>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover"
            aria-label="Garder la barre latérale ouverte">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>

            <ul class="navbar-nav" id="navbar-nav">
                @can('voir-tableau de bord')
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Route::is('dashboard.*') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Tableau de bord</span>
                        </a>
                    </li>
                @endcan

                {{-- ===== Ventes ===== --}}
                <li class="menu-title"><span>Ventes</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('commandes.*') ? 'active' : '' }}" href="{{ route('commandes.index') }}">
                        <i class="ri-shopping-bag-3-line"></i> <span>Commandes</span>
                        <span class="foani-badge foani-badge--alert {{ ($pendingCommandesCount ?? 0) ? '' : 'is-empty' }}"
                            data-notif-count="commandes" title="Commandes en attente">{{ $pendingCommandesCount ?? 0 }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('reservations.*') ? 'active' : '' }}" href="{{ route('reservations.index') }}">
                        <i class="ri-calendar-check-line"></i> <span>Réservations</span>
                        <span class="foani-badge {{ ($pendingReservationsCount ?? 0) ? '' : 'is-empty' }}"
                            data-notif-count="reservations" title="Réservations en attente">{{ $pendingReservationsCount ?? 0 }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('client.*') ? 'active' : '' }}" href="{{ route('client.index_client') }}">
                        <i class="ri-group-line"></i> <span>Clients</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('rapports.*') ? 'active' : '' }}" href="{{ route('rapports.vente') }}">
                        <i class="ri-file-chart-line"></i> <span>Rapports de ventes</span>
                    </a>
                </li>

                {{-- ===== Catalogue ===== --}}
                <li class="menu-title"><span>Catalogue</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('produit.*') ? 'active' : '' }}" href="{{ route('produit.index') }}">
                        <i class="ri-shopping-basket-2-line"></i> <span>Produits</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('categorie.*') ? 'active' : '' }}" href="{{ route('categorie.index') }}">
                        <i class="ri-price-tag-3-line"></i> <span>Catégories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('offre.*') ? 'active' : '' }}" href="{{ route('offre.index') }}">
                        <i class="ri-gift-line"></i> <span>Types d'offres</span>
                    </a>
                </li>

                {{-- ===== Réseau & livraison ===== --}}
                <li class="menu-title"><span>Réseau &amp; livraison</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ $ouvert['pointsVente'] ? 'active' : 'collapsed' }}" href="#menuPointsVente" data-bs-toggle="collapse"
                        role="button" aria-expanded="{{ $ouvert['pointsVente'] ? 'true' : 'false' }}" aria-controls="menuPointsVente">
                        <i class="ri-store-2-line"></i> <span>Points de vente</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $ouvert['pointsVente'] ? 'show' : '' }}" id="menuPointsVente">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="{{ route('categorie_point_de_vente.index') }}" class="nav-link {{ Route::is('categorie_point_de_vente.*') ? 'active' : '' }}">Zones</a></li>
                            <li class="nav-item"><a href="{{ route('point_vente.index') }}" class="nav-link {{ Route::is('point_vente.*') ? 'active' : '' }}">Points de vente</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ $ouvert['livraison'] ? 'active' : 'collapsed' }}" href="#menuLivraison" data-bs-toggle="collapse"
                        role="button" aria-expanded="{{ $ouvert['livraison'] ? 'true' : 'false' }}" aria-controls="menuLivraison">
                        <i class="ri-truck-line"></i> <span>Livraison</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $ouvert['livraison'] ? 'show' : '' }}" id="menuLivraison">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="{{ route('ville.index') }}" class="nav-link {{ Route::is('ville.*') ? 'active' : '' }}">Villes</a></li>
                            <li class="nav-item"><a href="{{ route('commune.index') }}" class="nav-link {{ Route::is('commune.*') ? 'active' : '' }}">Communes &amp; frais</a></li>
                        </ul>
                    </div>
                </li>

                {{-- ===== Site & contenu ===== --}}
                <li class="menu-title"><span>Site &amp; contenu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ $ouvert['pages'] ? 'active' : 'collapsed' }}" href="#menuPages" data-bs-toggle="collapse"
                        role="button" aria-expanded="{{ $ouvert['pages'] ? 'true' : 'false' }}" aria-controls="menuPages">
                        <i class="ri-pages-line"></i> <span>Pages du site</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $ouvert['pages'] ? 'show' : '' }}" id="menuPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="{{ route('categorie_page.index') }}" class="nav-link {{ Route::is('categorie_page.*') ? 'active' : '' }}">Rubriques</a></li>
                            <li class="nav-item"><a href="{{ route('pages.index') }}" class="nav-link {{ Route::is('pages.*') ? 'active' : '' }}">Pages</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('sliders.*') ? 'active' : '' }}" href="{{ route('sliders.index') }}">
                        <i class="ri-image-2-line"></i> <span>Bannières (sliders)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('contact.*') ? 'active' : '' }}" href="{{ route('contact.index') }}">
                        <i class="ri-mail-line"></i> <span>Messages</span>
                        <span class="foani-badge foani-badge--alert {{ ($newMessagesCount ?? 0) ? '' : 'is-empty' }}"
                            data-notif-count="messages" title="Messages non lus">{{ $newMessagesCount ?? 0 }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('candidats.*') ? 'active' : '' }}" href="{{ route('candidats.index') }}">
                        <i class="ri-user-follow-line"></i> <span>Candidatures</span>
                    </a>
                </li>

                {{-- ===== Administration ===== --}}
                @if ($estAdminComplet)
                    <li class="menu-title"><span>Administration</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ $ouvert['admin'] ? 'active' : 'collapsed' }}" href="#menuAdmin" data-bs-toggle="collapse"
                            role="button" aria-expanded="{{ $ouvert['admin'] ? 'true' : 'false' }}" aria-controls="menuAdmin">
                            <i class="ri-settings-3-line"></i> <span>Paramètres</span>
                        </a>
                        <div class="collapse menu-dropdown {{ $ouvert['admin'] ? 'show' : '' }}" id="menuAdmin">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item"><a href="{{ route('parametre.index') }}" class="nav-link {{ Route::is('parametre.*') ? 'active' : '' }}">Informations du site</a></li>
                                <li class="nav-item"><a href="{{ route('admin-register.index') }}" class="nav-link {{ Route::is('admin-register.*') ? 'active' : '' }}">Utilisateurs</a></li>
                                <li class="nav-item"><a href="{{ route('module.index') }}" class="nav-link {{ Route::is('module.*') ? 'active' : '' }}">Modules</a></li>
                                <li class="nav-item"><a href="{{ route('role.index') }}" class="nav-link {{ Route::is('role.*') ? 'active' : '' }}">Rôles</a></li>
                                <li class="nav-item"><a href="{{ route('permission.index') }}" class="nav-link {{ Route::is('permission.*') ? 'active' : '' }}">Permissions</a></li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>

            {{-- Raccourcis --}}
            <div class="foani-sidebar-links">
                <a href="{{ route('web.index') }}" target="_blank" rel="noopener"><i class="ri-global-line"></i> Voir le site vitrine</a>
                <a href="{{ route('boutique.accueil') }}" target="_blank" rel="noopener"><i class="ri-store-3-line"></i> Voir la boutique</a>
            </div>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>
