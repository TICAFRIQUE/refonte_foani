  {{-- À placer où tu veux dans tes vues, par exemple juste avant @yield('content') --}}
  {{-- <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-white rounded shadow-sm px-3 py-2 align-items-center">
          <li class="breadcrumb-item">
              <a href="{{ url()->previous() }}" class="text-dark text-decoration-none"><i class="bi bi-arrow-left"></i>
                  Retour</a>
          </li>
          <li class="breadcrumb-item active fw-bold text-lowercase" aria-current="page">
              {{ Str::lower(trim($__env->yieldContent('title'))) }}
          </li>
      </ol>
  </nav> --}}


  {{-- filepath: c:\laragon\www\foani\resources\views\frontend\components\breadcrumb.blade.php --}}
<style>
    /* Breadcrumb moderne et fluide */
    .breadcrumb-nav {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-bottom: 1px solid rgba(42, 107, 42, 0.1);
        padding: 15px 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .breadcrumb-nav::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--color-vert), var(--color-jaune), var(--color-vert));
    }

    .breadcrumb-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
    }

    .breadcrumb-left {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .breadcrumb-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 25px;
        color: #495057;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .breadcrumb-back:hover {
        border-color: var(--color-vert);
        color: var(--color-vert);
        background: #f0f8f0;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(42, 107, 42, 0.15);
    }

    .breadcrumb-back i {
        transition: transform 0.3s ease;
    }

    .breadcrumb-back:hover i {
        transform: translateX(-2px);
    }

    .breadcrumb-path {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        font-size: 0.95rem;
    }

    .breadcrumb-path a {
        color: var(--color-vert);
        text-decoration: none;
        font-weight: 500;
        padding: 4px 8px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .breadcrumb-path a:hover {
        background: rgba(42, 107, 42, 0.1);
        color: var(--color-vert2);
    }

    .breadcrumb-separator {
        color: #6c757d;
        font-weight: 600;
        user-select: none;
    }

    .breadcrumb-current {
        color: #333;
        font-weight: 600;
        background: linear-gradient(135deg, #e8f5e8, #f0f8f0);
        padding: 6px 12px;
        border-radius: 15px;
        border: 1px solid rgba(42, 107, 42, 0.2);
    }

    .breadcrumb-info {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.85rem;
        color: #6c757d;
    }

    .page-indicator {
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 20px;
        padding: 4px 10px;
        font-weight: 500;
    }

    .time-indicator {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .breadcrumb-nav {
            padding: 12px 0;
        }

        .breadcrumb-container {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .breadcrumb-left {
            width: 100%;
            justify-content: space-between;
        }

        .breadcrumb-back {
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        .breadcrumb-path {
            font-size: 0.9rem;
            gap: 6px;
        }

        .breadcrumb-current {
            padding: 4px 10px;
            font-size: 0.9rem;
        }

        .breadcrumb-info {
            width: 100%;
            justify-content: space-between;
            padding-top: 8px;
            border-top: 1px solid #e9ecef;
        }
    }

    @media (max-width: 576px) {
        .breadcrumb-path {
            display: none;
        }

        .breadcrumb-left {
            justify-content: space-between;
            width: 100%;
        }

        .breadcrumb-current {
            font-size: 0.85rem;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    }

    /* Animation d'entrée */
    .breadcrumb-nav {
        animation: slideInFromTop 0.5s ease-out;
    }

    @keyframes slideInFromTop {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* États hover pour mobile */
    @media (hover: none) {
        .breadcrumb-back:hover {
            transform: none;
        }
    }
</style>

<nav class="breadcrumb-nav" aria-label="Fil d'Ariane">
    <div class="container">
        <div class="breadcrumb-container">
            <div class="breadcrumb-left">
                {{-- Bouton retour intelligent --}}
                <a href="{{ url()->previous() }}" class="breadcrumb-back">
                    <i class="bi bi-arrow-left"></i>
                    <span class="d-none d-sm-inline">Retour</span>
                </a>

                {{-- Chemin de navigation --}}
                <div class="breadcrumb-path d-none d-md-flex">
                    {{-- <a href="{{ route('boutique.accueil') }}">
                        <i class="bi bi-house-fill me-1"></i>Accueil
                    </a> --}}
                    
                    @if(request()->routeIs('boutique.*'))
                        <span class="breadcrumb-separator">></span>
                        @if(request()->routeIs('boutique.index'))
                            <span class="breadcrumb-current">Boutique</span>
                        @else
                            <a href="{{ route('boutique.accueil') }}">Boutique</a>
                            <span class="breadcrumb-separator">></span>
                            <span class="breadcrumb-current">
                                {{ $categorie->libelle ?? 'Catégorie' }}    
                            </span>
                        @endif
                    
                    @elseif(request()->routeIs('panier.*'))
                        <span class="breadcrumb-separator">></span>
                        @if(request()->routeIs('panier.index'))
                            <span class="breadcrumb-current">Panier</span>
                        @else
                            <a href="{{ route('panier.index') }}">Panier</a>
                            <span class="breadcrumb-separator">></span>
                            <span class="breadcrumb-current">Commande</span>
                        @endif
                    
                    @elseif(request()->routeIs('reservation.*'))
                        <span class="breadcrumb-separator">></span>
                        <span class="breadcrumb-current">Réservation</span>
                    
                    @elseif(request()->routeIs('login') || request()->routeIs('register'))
                        <span class="breadcrumb-separator">></span>
                        <span class="breadcrumb-current">
                            {{ request()->routeIs('login') ? 'Connexion' : 'Inscription' }}
                        </span>
                    
                    @else
                        <span class="breadcrumb-separator">></span>
                        <span class="breadcrumb-current">
                            {{ $pageTitle ?? Str::title(request()->segment(1)) }}
                        </span>
                    @endif
                </div>

                {{-- Titre de page sur mobile --}}
                <div class="breadcrumb-current d-md-none">
                    @if(request()->routeIs('boutique.index'))
                        Boutique
                    @elseif(request()->routeIs('boutique.categorie'))
                        {{ $categorie->libelle ?? 'Catégorie' }}
                    @elseif(request()->routeIs('panier.index'))
                        Panier
                    @elseif(request()->routeIs('login'))
                        Connexion
                    @elseif(request()->routeIs('register'))
                        Inscription
                    @else
                        {{ $pageTitle ?? Str::title(request()->segment(1)) }}
                    @endif
                </div>
            </div>

            {{-- Informations contextuelles --}}
            <div class="breadcrumb-info d-none d-lg-flex">
                @if(request()->routeIs('boutique.*'))
                    <div class="page-indicator">
                        <i class="bi bi-grid-3x3-gap me-1"></i>
                        {{ isset($produits) ? $produits->total() : '0' }} produit(s)
                    </div>
                {{-- @elseif(request()->routeIs('panier.*'))
                    <div class="page-indicator">
                        <i class="bi bi-cart me-1"></i>
                        {{ session('panier') ? count(session('panier')) : '0' }} article(s)
                       {{ session('panier') ? array_sum(array_column(session('panier'), 'quantite')) : 0; }} article(s)
                    </div> --}}
                @endif

                <div class="time-indicator">
                    <i class="bi bi-clock"></i>
                    <span id="current-time"></span>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    // Mise à jour de l'heure en temps réel
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('fr-FR', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = timeString;
        }
    }

    // Initialiser et mettre à jour chaque minute
    updateTime();
    setInterval(updateTime, 60000);

    // Gestion intelligente du bouton retour
    document.addEventListener('DOMContentLoaded', function() {
        const backButton = document.querySelector('.breadcrumb-back');
        const currentUrl = window.location.href;
        const previousUrl = document.referrer;
        
        // Si pas de référent ou référent externe, rediriger vers l'accueil
        if (!previousUrl || !previousUrl.includes(window.location.hostname)) {
            backButton.href = "{{ route('boutique.accueil') }}";
        }
        
        // Si on vient de la même page, rediriger vers l'accueil
        if (previousUrl === currentUrl) {
            backButton.href = "{{ route('boutique.accueil') }}";
        }
    });
</script>
