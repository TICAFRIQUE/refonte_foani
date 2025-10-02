<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        @if ($data_parametre != null)
            <!-- Logo -->
            <a href="#" class="logo logo-light">
                <span class="logo-lg">
                    <img src="{{ $data_parametre ? URL::asset($data_parametre->getFirstMediaUrl('logo_header')) : URL::asset('images/camera-icon.png') }}"
                        alt="logo" width="auto" class="rounded-circle">
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

                {{-- Tableau de bord --}}
                @can('voir-tableau de bord')
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Route::is('dashboard.*') ? 'active' : '' }} "
                            href="{{ route('dashboard.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>TABLEAU DE BORD</span>
                        </a>
                    </li>
                @endcan

                {{-- Produits --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('produit.index') }}">
                        <i class="ri-shopping-bag-3-line"></i> <span>PRODUITS</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categorie.index') }}" class="nav-link">
                        <i class="ri-price-tag-3-line me-1"></i> Catégories
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('offre.index') }}" class="nav-link">
                        <i class="ri-gift-line me-1"></i> Voir offres
                    </a>
                </li>


                {{-- Paramètres --}}
                @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'developpeur' || Auth::user()->can('voir-parametre'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAuth">
                            <i class="ri-settings-2-fill"></i> <span>PARAMÈTRES</span>
                        </a>
                        <div class="collapse menu-dropdown {{ Route::is('role.*') || Route::is('parametre.*') || Route::is('module.*') || Route::is('permission.*') || Route::is('admin-register.*') ? 'show' : '' }}"
                            id="sidebarAuth">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('parametre.index') }}"
                                        class="nav-link {{ Route::is('parametre.*') ? 'active' : '' }}">
                                        <i class="ri-information-line me-1"></i> Informations
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin-register.index') }}"
                                        class="nav-link {{ Route::is('admin-register.*') ? 'active' : '' }}">
                                        <i class="ri-user-settings-line me-1"></i> Utilisateurs
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('module.index') }}"
                                        class="nav-link {{ Route::is('module.*') ? 'active' : '' }}">
                                        <i class="ri-apps-2-line me-1"></i> Modules
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('role.index') }}"
                                        class="nav-link {{ Route::is('role.*') ? 'active' : '' }}">
                                        <i class="ri-user-star-line me-1"></i> Rôles
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('permission.index') }}"
                                        class="nav-link {{ Route::is('permission.*') ? 'active' : '' }}">
                                        <i class="ri-key-2-line me-1"></i> Permissions / Rôles
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
<!-- Left Sidebar End -->
<div class="vertical-overlay"></div>
