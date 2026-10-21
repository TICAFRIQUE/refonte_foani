{{-- Header du back-office (styles : public/back/css/admin.css, notifications : public/back/js/admin.js) --}}
@php
    $logoTop = $data_parametre?->getFirstMediaUrl('logo_header') ?: asset('front/images/logo.png');
    $cloches = [
        'commandes' => ['ri-shopping-bag-3-line', 'Commandes en attente', route('commandes.index'), 'Voir toutes les commandes', $pendingCommandesCount ?? 0],
        'reservations' => ['ri-calendar-check-line', 'Réservations en attente', route('reservations.index'), 'Voir toutes les réservations', $pendingReservationsCount ?? 0],
        'messages' => ['ri-mail-line', 'Messages non lus', route('contact.index'), 'Voir tous les messages', $newMessagesCount ?? 0],
    ];
@endphp

<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex align-items-center">
                {{-- Logo (affiché seulement en disposition horizontale) --}}
                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{ route('dashboard.index') }}" class="logo logo-dark">
                        <span class="logo-sm"><img src="{{ $logoTop }}" alt="FOANI" height="32"></span>
                        <span class="logo-lg"><img src="{{ $logoTop }}" alt="FOANI" height="40"></span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none"
                    id="topnav-hamburger-icon" aria-label="Afficher / masquer le menu">
                    <span class="hamburger-icon"><span></span><span></span><span></span></span>
                </button>

                {{-- Raccourcis --}}
                <div class="d-none d-md-flex align-items-center gap-2 ms-2">
                    <a href="{{ route('web.index') }}" target="_blank" rel="noopener" class="foani-quick"><i class="ri-global-line"></i> Site</a>
                    <a href="{{ route('boutique.accueil') }}" target="_blank" rel="noopener" class="foani-quick foani-quick--shop"><i class="ri-store-3-line"></i> Boutique</a>
                </div>
            </div>

            <div class="d-flex align-items-center">
                {{-- Mode clair / sombre --}}
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle light-dark-mode"
                        aria-label="Basculer le mode sombre">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                {{-- Notifications : mises à jour par public/back/js/admin.js --}}
                @foreach ($cloches as $type => [$icone, $titre, $lien, $libelleLien, $nombre])
                    <div class="dropdown ms-1 header-item foani-notif">
                        <button type="button" class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" aria-label="{{ $titre }}" title="{{ $titre }}">
                            <i class="{{ $icone }} fs-22"></i>
                            <span class="topbar-badge {{ $nombre ? '' : 'is-empty' }}" data-notif-count="{{ $type }}">{{ $nombre }}</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="foani-notif__head">
                                <h6>{{ $titre }}</h6>
                                <span data-notif-total="{{ $type }}">{{ $nombre }} en attente</span>
                            </div>
                            <div class="foani-notif__list" data-notif-list="{{ $type }}">
                                <div class="foani-notif__empty">Chargement…</div>
                            </div>
                            <a href="{{ $lien }}" class="foani-notif__foot">{{ $libelleLien }} <i class="ri-arrow-right-line align-middle"></i></a>
                        </div>
                    </div>
                @endforeach

                {{-- Profil --}}
                @auth
                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <img class="rounded-circle header-profile-user"
                                    src="{{ Auth::user()->avatar ? URL::asset('images/' . Auth::user()->avatar) : URL::asset('images/user-icon.png') }}"
                                    alt="">
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::user()->username }}</span>
                                    <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{ Str::ucfirst(Auth::user()->roles[0]->name ?? '') }}</span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <h6 class="dropdown-header">Bonjour {{ Auth::user()->username }} !</h6>
                            <a class="dropdown-item" href="{{ route('admin-register.profil', Auth::user()->id) }}">
                                <i class="ri-account-circle-line text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Mon profil</span>
                            </a>
                            <a class="dropdown-item d-md-none" href="{{ route('web.index') }}" target="_blank" rel="noopener">
                                <i class="ri-global-line text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Voir le site</span>
                            </a>
                            <a class="dropdown-item d-md-none" href="{{ route('boutique.accueil') }}" target="_blank" rel="noopener">
                                <i class="ri-store-3-line text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Voir la boutique</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="ri-logout-box-r-line fs-16 align-middle me-1"></i> <span class="align-middle">Déconnexion</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>

{{-- Requis par le script du thème (build/js/app.js) : ne pas supprimer --}}
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body text-center">
                <h4 class="mt-2">Supprimer cette notification ?</h4>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</div>
