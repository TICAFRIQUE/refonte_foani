<style>
    .card {
        transition: transform 0.3s cubic-bezier(.4,2,.3,1), box-shadow 0.3s cubic-bezier(.4,2,.3,1);
        border-radius: 18px;
        /* border: none; */
    }
    .card:hover {
        transform: scale(1.04) translateY(-4px);
        box-shadow: 0 8px 32px rgba(44, 62, 80, 0.18);
        border-color: #559e33;
    }
    .card-title {
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .card-icon {
        width: 38px;
        height: 38px;
        background: linear-gradient(135deg, #559e33 60%, #f7c948 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.5rem;
        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
    }
    .card-text {
        color: #555;
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }
    .btn-success {
        background: linear-gradient(90deg, #559e33 80%, #f7c948 100%);
        border: none;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: background 0.2s, transform 0.2s;
    }
    .btn-success:hover {
        background: linear-gradient(90deg, #f7c948 60%, #559e33 100%);
        transform: scale(1.07);
        color: #fff;
    }
    .card-footer {
        background: none;
        border-top: none;
        padding-top: 0;
    }
    @media (max-width: 767px) {
        .card-title { font-size: 1.1rem; }
        .card-icon { width: 32px; height: 32px; font-size: 1.2rem; }
    }
</style>

@php
    $points_de_vente = \App\Models\CategoriePointVente::active()->alphabetique()->get();
    $icons = [
        'supermarché' => 'bi-shop',
        'épicerie' => 'bi-basket',
        'boucherie' => 'bi-egg-fried',
        'marché' => 'bi-geo-alt',
        'pharmacie' => 'bi-capsule',
        'autre' => 'bi-geo',
    ];
@endphp

<section class="container mb-5" id="sectionPointDeVente">
    <h2 class="text-center mb-4 fw-bold" style="color: var(--color-jaune);">
        <i class="bi bi-geo-alt-fill me-2" style="color: #559e33;"></i>
        Nos Points de Vente
    </h2>
    <div class="row g-4">
        @foreach ($points_de_vente as $categorie)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <span class="card-icon">
                                <i class="bi {{ $icons[strtolower($categorie->libelle)] ?? 'bi-shop' }}"></i>
                            </span>
                            {{ $categorie->libelle }}
                        </h5>
                        <p class="card-text flex-grow-1">
                            {{ $categorie->description ?? 'Retrouvez nos produits dans notre points de vente.' }}
                        </p>
                        <a href="{{ route('points_de_vente', ['slug' => $categorie->slug]) }}"
                            class="btn btn-success mt-3 align-self-start">
                            <i class="bi bi-arrow-right-circle me-1"></i>
                            Voir les points de vente
                        </a>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between pt-0">
                        {{-- <span class="text-muted small">
                            <i class="bi bi-geo-alt"></i>
                            {{ $categorie->pointVentes()->count() }} point{{ $categorie->pointVentes()->count() > 1 ? 's' : '' }}
                        </span> --}}
                        <span>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
