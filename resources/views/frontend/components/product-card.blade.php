{{--
    Carte produit partagée (accueil boutique, liste des produits).
    Paramètres : $produit (media + categorie chargés), $showCategorie (bool, défaut true),
                 $eager (bool : image prioritaire), $delay (float : délai d'animation en s)
--}}
@php
    $image = $produit->getFirstMediaUrl('image_principale', 'thumb') ?: asset('front/images/produits/poulet.png');
    $enStock = $produit->stock > 0;
    $aUnPrix = $produit->prix_de_vente > 0;
    $waText = rawurlencode('Bonjour, je veux commander le produit ' . $produit->libelle);
@endphp

<article class="pcard reveal" style="--d: {{ $delay ?? 0 }}s">
    <div class="pcard__media">
        <img src="{{ $image }}" alt="{{ $produit->libelle }}" width="600" height="600"
            @if (!empty($eager)) fetchpriority="high" @else loading="lazy" @endif decoding="async">

        @if (!$aUnPrix)
            <span class="pcard__badge pcard__badge--order">Sur commande</span>
        @elseif ($enStock)
            <span class="pcard__badge pcard__badge--ok">En stock</span>
        @else
            <span class="pcard__badge pcard__badge--out">Rupture</span>
        @endif

        @if ($aUnPrix)
            <span class="pcard__tag">{{ number_format($produit->prix_de_vente, 0, ',', ' ') }}<small>FCFA</small></span>
        @else
            <span class="pcard__tag pcard__tag--ask">Prix<small>sur demande</small></span>
        @endif
    </div>

    <div class="pcard__body">
        @if (($showCategorie ?? true) && $produit->categorie)
            <span class="pcard__cat">{{ $produit->categorie->libelle }}</span>
        @endif

        <h3 class="pcard__title" title="{{ $produit->libelle }}">{{ $produit->libelle }}</h3>

        <div class="pcard__action">
            @if (!$aUnPrix)
                <a href="https://wa.me/225{{ $data_parametre?->contact2 }}?text={{ $waText }}" target="_blank"
                    rel="noopener" class="pcard__btn pcard__btn--wa">
                    <i class="bi bi-whatsapp"></i>
                    <span class="lbl-long">Commander via WhatsApp</span><span class="lbl-short">WhatsApp</span>
                </a>
            @elseif ($enStock)
                <button type="button" class="pcard__btn pcard__btn--add btn-ajouter-panier" data-id="{{ $produit->id }}">
                    <i class="bi bi-basket2-fill"></i>
                    <span class="lbl-long">Ajouter au panier</span><span class="lbl-short">Ajouter</span>
                </button>
            @else
                <a href="{{ route('reservation.create', ['slug' => $produit->slug]) }}" class="pcard__btn pcard__btn--reserve">
                    <i class="bi bi-calendar-check"></i>
                    <span class="lbl-long">Réserver</span><span class="lbl-short">Réserver</span>
                </a>
            @endif
        </div>
    </div>
</article>
