{{-- filepath: c:\laragon\www\foani\resources\views\frontend\pages\categorie.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Catégories - Foani')
@section('meta_description', 'Découvrez toutes nos catégories de produits : volaille, œufs, alimentation et accessoires d\'élevage.')

@section('content')
<div class="container py-4">
    <!-- Header de la page -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-6 fw-bold text-success mb-3">
                <i class="bi bi-grid-3x3-gap me-2"></i>
                Nos Catégories
            </h1>
            <p class="lead text-muted">Explorez notre gamme complète de produits avicoles</p>
        </div>
    </div>

    <!-- Grille des catégories -->
    <div class="row g-4">
        @forelse($categories as $categorie)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card category-card h-100 border-0 shadow-sm">
                    <!-- Image de la catégorie -->
                    <div class="category-image-wrapper position-relative overflow-hidden">
                        @if($categorie->getFirstMediaUrl('image'))
                            <img src="{{ $categorie->getFirstMediaUrl('image') }}" 
                                 class="card-img-top category-image" 
                                 alt="{{ $categorie->libelle }}"
                                 loading="lazy">
                        @else
                            <div class="category-placeholder d-flex align-items-center justify-content-center">
                                <i class="bi bi-image display-4 text-muted"></i>
                            </div>
                        @endif
                        
                        <!-- Overlay avec compteur de produits -->
                        <div class="category-overlay">
                            <span class="badge bg-success rounded-pill">
                                {{ $categorie->produits_count ?? 0 }} produit{{ ($categorie->produits_count ?? 0) > 1 ? 's' : '' }}
                            </span>
                        </div>
                    </div>

                    <!-- Contenu de la carte -->
                    <div class="card-body text-center p-3">
                        <h5 class="card-title fw-bold text-dark mb-2">
                            {{ $categorie->libelle }}
                        </h5>
                        
                        {{-- @if($categorie->description)
                            <p class="card-text text-muted small mb-3">
                                {{ Str::limit($categorie->description, 80) }}
                            </p>
                        @endif --}}

                        <!-- Bouton d'action -->
                        <a href="{{ route('boutique.index', ['categorie' => $categorie->slug]) }}" 
                           class="btn btn-outline-success btn-sm w-100 fw-semibold">
                            <i class="bi bi-eye me-1"></i>
                            Voir les produits
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <!-- État vide -->
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                    <h3 class="text-muted">Aucune catégorie disponible</h3>
                    <p class="text-muted">Les catégories seront bientôt ajoutées.</p>
                    <a href="{{ route('boutique.index') }}" class="btn btn-success">
                        <i class="bi bi-shop me-2"></i>
                        Voir tous les produits
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Section actions rapides -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card bg-light border-0">
                <div class="card-body text-center py-4">
                    <h4 class="card-title text-success mb-3">
                        <i class="bi bi-lightning me-2"></i>
                        Actions rapides
                    </h4>
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <a href="{{ route('boutique.index') }}" class="btn btn-success w-100">
                                <i class="bi bi-shop d-block mb-1"></i>
                                <small>Tous les produits</small>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('boutique.index', ['promotion' => '1']) }}" class="btn btn-warning w-100">
                                <i class="bi bi-percent d-block mb-1"></i>
                                <small>Promotions</small>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('boutique.index', ['nouveaute' => '1']) }}" class="btn btn-info w-100">
                                <i class="bi bi-star d-block mb-1"></i>
                                <small>Nouveautés</small>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('contact') }}" class="btn btn-outline-success w-100">
                                <i class="bi bi-headset d-block mb-1"></i>
                                <small>Contact</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Styles pour les cartes de catégories */
.category-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 16px;
    overflow: hidden;
}

.category-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 12px 35px rgba(85, 158, 51, 0.15) !important;
}

/* Image de catégorie */
.category-image-wrapper {
    height: 140px;
    position: relative;
}

.category-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.category-card:hover .category-image {
    transform: scale(1.1);
}

.category-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

/* Overlay avec badge */
.category-overlay {
    position: absolute;
    top: 8px;
    right: 8px;
    z-index: 2;
}

.category-overlay .badge {
    background: rgba(85, 158, 51, 0.9) !important;
    backdrop-filter: blur(4px);
    font-size: 0.7rem;
    padding: 4px 8px;
}

/* Responsive mobile */
@media (max-width: 576px) {
    .category-image-wrapper {
        height: 120px;
    }
    
    .card-body {
        padding: 1rem 0.75rem !important;
    }
    
    .card-title {
        font-size: 0.9rem;
    }
    
    .card-text {
        font-size: 0.8rem;
    }
    
    .btn-sm {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
    }
}

/* Actions rapides */
.btn i {
    font-size: 1.2rem;
}

@media (max-width: 576px) {
    .btn i {
        font-size: 1rem;
    }
    
    .btn small {
        font-size: 0.7rem;
    }
}

/* Animation de chargement */
.category-card {
    animation: fadeInUp 0.6s ease-out;
}

.category-card:nth-child(1) { animation-delay: 0.1s; }
.category-card:nth-child(2) { animation-delay: 0.2s; }
.category-card:nth-child(3) { animation-delay: 0.3s; }
.category-card:nth-child(4) { animation-delay: 0.4s; }

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* États de chargement et focus */
.category-card:focus-within {
    outline: 2px solid #559e33;
    outline-offset: 2px;
}

.btn:focus {
    box-shadow: 0 0 0 0.2rem rgba(85, 158, 51, 0.25);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation au scroll pour les cartes
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);

    // Observer toutes les cartes de catégories
    document.querySelectorAll('.category-card').forEach(card => {
        card.style.animationPlayState = 'paused';
        observer.observe(card);
    });

    // Lazy loading pour les images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('.category-image').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Haptic feedback pour mobile (si supporté)
    if ('vibrate' in navigator) {
        document.querySelectorAll('.category-card').forEach(card => {
            card.addEventListener('touchstart', function() {
                navigator.vibrate(10);
            });
        });
    }

    // Préchargement des pages de catégories au hover
    const preloadedLinks = new Set();
    document.querySelectorAll('.category-card a').forEach(link => {
        link.addEventListener('mouseenter', function() {
            const href = this.getAttribute('href');
            if (href && !preloadedLinks.has(href)) {
                const preloadLink = document.createElement('link');
                preloadLink.rel = 'prefetch';
                preloadLink.href = href;
                document.head.appendChild(preloadLink);
                preloadedLinks.add(href);
            }
        });
    });
});
</script>
@endpush