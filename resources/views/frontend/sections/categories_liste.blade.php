{{-- Accueil boutique : réassurance + catégories --}}
<section class="home-cats">
    <div class="container">
        {{-- Bandeau de réassurance --}}
        <div class="trust-strip">
            <div class="trust-item reveal" style="--d:0s">
                <i class="bi bi-egg-fill"></i>
                <div><strong>Frais chaque jour</strong><span>Direct de nos fermes</span></div>
            </div>
            <div class="trust-item reveal" style="--d:.08s">
                <i class="bi bi-truck"></i>
                <div><strong>Livraison rapide</strong><span>Abidjan et environs</span></div>
            </div>
            <div class="trust-item reveal" style="--d:.16s">
                <i class="bi bi-patch-check-fill"></i>
                <div><strong>Qualité contrôlée</strong><span>Élevage suivi, halal</span></div>
            </div>
            <div class="trust-item reveal" style="--d:.24s">
                <i class="bi bi-whatsapp"></i>
                <div><strong>Commande facile</strong><span>En ligne ou WhatsApp</span></div>
            </div>
        </div>

        <div class="section-head section-head--center reveal">
            <span class="eyebrow">Que cherchez-vous aujourd'hui ?</span>
            <h2>Nos catégories</h2>
            <p>Poulets, œufs, poussins, découpes… tout ce qu'il faut, frais de la ferme.</p>
        </div>

        <div class="cat-rail">
            @foreach ($categories as $categorie)
                <a href="{{ route('boutique.categorie', ['slug' => $categorie->slug]) }}" class="cat-card reveal"
                    style="--d: {{ min($loop->index, 6) * 0.06 }}s">
                    <img src="{{ $categorie->getFirstMediaUrl('image', 'thumb') ?: asset('front/images/logo.png') }}"
                        alt="" class="cat-card__img" width="108" height="108" loading="lazy" decoding="async">
                    <span class="cat-card__name">{{ $categorie->libelle }}</span>
                    @isset($categorie->produits_count)
                        <span class="cat-card__count">{{ $categorie->produits_count }} produit{{ $categorie->produits_count > 1 ? 's' : '' }}</span>
                    @endisset
                </a>
            @endforeach
        </div>
    </div>
</section>
