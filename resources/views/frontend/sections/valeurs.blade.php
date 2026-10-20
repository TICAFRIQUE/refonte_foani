{{-- Accueil boutique : « Le vrai goût du poulet ! » (styles : public/front/css/shop.css, section « Vrai goût ») --}}
<section class="taste-section">
    <div class="container">
        <div class="taste-card reveal">
            {{-- Visuel + accroche --}}
            <div class="taste-hero">
                <span class="eyebrow">Depuis nos fermes ivoiriennes</span>
                <h2>Le vrai goût du poulet&nbsp;!</h2>
                <p>Des volailles élevées avec soin, des œufs frais chaque jour et des produits pour tous : éleveurs comme familles.</p>
                <div class="taste-plate">
                    <img src="{{ asset('front/images/produits/poulet.png') }}" alt="Poulet FOANI de qualité premium"
                        loading="lazy" decoding="async" width="260" height="260">
                </div>
                <a href="/catalogue.pdf" class="taste-btn" target="_blank" rel="noopener">
                    <i class="bi bi-download"></i> Télécharger notre catalogue
                </a>
            </div>

            {{-- Chiffres clés --}}
            <div class="taste-stats">
                <div class="taste-stat reveal" style="--d:.05s">
                    <i class="bi bi-people-fill"></i>
                    <strong>250+</strong>
                    <span class="lbl">Employés</span>
                    <p>FOANI participe activement à l'emploi des jeunes, en postes permanents et temporaires.</p>
                </div>
                <div class="taste-stat reveal" style="--d:.12s">
                    <i class="bi bi-shop"></i>
                    <strong>60+</strong>
                    <span class="lbl">Points de vente</span>
                    <p>Des boutiques de proximité à Abidjan et à l'intérieur du pays.</p>
                </div>
                <div class="taste-stat reveal" style="--d:.19s">
                    <i class="bi bi-heart-fill"></i>
                    <strong>100 000+</strong>
                    <span class="lbl">Clients</span>
                    <p>Rejoignez la grande famille FOANI
                        <a href="https://web.facebook.com/foaniservices/" target="_blank" rel="noopener">sur Facebook</a>.</p>
                </div>
                <div class="taste-stat reveal" style="--d:.26s">
                    <i class="bi bi-basket-fill"></i>
                    <strong>Pour tous</strong>
                    <span class="lbl">Nos produits</span>
                    <p>Pour la production comme pour la consommation de la volaille.</p>
                </div>
            </div>
        </div>
    </div>
</section>
