{{-- Points de vente : zones (liens vers les adresses dans la boutique) --}}
@if ($zonesPointsVente->isNotEmpty())
    <section id="points-vente" class="vt-section">
        <div class="container">
            <div class="vt-points reveal">
                <div class="vt-points__intro">
                    <span class="vt-eyebrow vt-eyebrow--yellow">Près de chez vous</span>
                    <h2>Plus de 60 points de vente</h2>
                    <p>Retrouvez nos produits frais dans nos boutiques de proximité à Abidjan et à l'intérieur du pays.</p>
                </div>
                <div class="vt-points__list">
                    @foreach ($zonesPointsVente as $zone)
                        <a href="{{ route('points_de_vente', ['slug' => $zone->slug]) }}" class="vt-zone">
                            <span class="vt-zone__icon"><i class="bi bi-geo-alt-fill"></i></span>
                            <span class="vt-zone__name">{{ Str::ucfirst(Str::lower($zone->libelle)) }}</span>
                            <i class="bi bi-arrow-right vt-zone__go"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
