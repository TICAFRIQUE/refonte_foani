{{-- Bandeau boutique en ligne --}}
<section class="vt-section pt-0">
    <div class="container">
        <div class="vt-shopband reveal">
            <div class="vt-shopband__text">
                <span class="vt-eyebrow vt-eyebrow--yellow">Frais de la ferme, livrés chez vous</span>
                <h2>Commandez nos produits en ligne</h2>
                <p>Poulets, œufs, poussins, découpes… Parcourez la boutique FOANI et faites-vous livrer rapidement.</p>
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a href="{{ route('boutique.accueil') }}" class="vt-btn vt-btn--shop"><i class="bi bi-basket2-fill"></i> Accéder à la boutique</a>
                    @if ($data_parametre?->contact2)
                        <a href="https://wa.me/225{{ $data_parametre->contact2 }}" target="_blank" rel="noopener" class="vt-btn vt-btn--light">
                            <i class="bi bi-whatsapp"></i> Commander sur WhatsApp
                        </a>
                    @endif
                </div>
            </div>
            <div class="vt-shopband__art" aria-hidden="true">
                <span class="egg egg--1">🥚</span>
                <span class="chick">🐔</span>
                <span class="egg egg--2">🥚</span>
            </div>
        </div>
    </div>
</section>
