{{-- Accueil boutique : « Nos points de vente » (styles : public/front/css/shop.css, section « Points de vente ») --}}
@php
    $points_de_vente = \App\Support\SiteCache::pointsVente();
@endphp

@if ($points_de_vente->isNotEmpty())
    <section class="container pv-section" id="sectionPointDeVente">
        <div class="section-head section-head--center reveal">
            <span class="eyebrow">Près de chez vous</span>
            <h2>Nos points de vente</h2>
            <p>Retrouvez nos produits frais dans nos boutiques à Abidjan et à l'intérieur du pays.</p>
        </div>

        <div class="pv-grid">
            @foreach ($points_de_vente as $zone)
                <a href="{{ route('points_de_vente', ['slug' => $zone->slug]) }}" class="pv-card reveal"
                    style="--d: {{ $loop->index * 0.08 }}s">
                    <span class="pv-card__icon"><i class="bi bi-geo-alt-fill"></i></span>
                    <span class="pv-card__body">
                        <span class="pv-card__name">{{ $zone->libelle }}</span>
                        <span class="pv-card__text">
                            {{ $zone->description ? Str::limit($zone->description, 70) : 'Voir les adresses et horaires' }}
                        </span>
                    </span>
                    <span class="pv-card__go" aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                </a>
            @endforeach
        </div>
    </section>
@endif
