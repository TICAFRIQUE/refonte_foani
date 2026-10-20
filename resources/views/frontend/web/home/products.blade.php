{{-- Nos produits : catégories de la boutique (liens directs) --}}
@if ($categories->isNotEmpty())
    <section id="produits" class="vt-section vt-section--cream">
        <div class="container">
            <div class="vt-head reveal">
                <span class="vt-eyebrow vt-eyebrow--green">Frais de nos fermes</span>
                <h2 class="vt-title">Nos produits</h2>
                <p>Volailles, œufs, poussins et découpes : retrouvez toute notre gamme sur la boutique en ligne.</p>
            </div>

            <div class="vt-products">
                @foreach ($categories as $cat)
                    <a href="{{ route('boutique.categorie', ['slug' => $cat->slug]) }}" class="vt-product reveal"
                        style="--d: {{ min($loop->index, 6) * 0.06 }}s">
                        <span class="vt-product__img">
                            <img src="{{ $cat->getFirstMediaUrl('image', 'thumb') ?: asset('front/images/logo.png') }}" alt=""
                                loading="lazy" decoding="async" width="160" height="160">
                        </span>
                        <span class="vt-product__name">{{ Str::ucfirst(Str::lower($cat->libelle)) }}</span>
                        <span class="vt-product__count">{{ $cat->produits_count }} produit{{ $cat->produits_count > 1 ? 's' : '' }}</span>
                        <span class="vt-product__go"><i class="bi bi-arrow-right"></i></span>
                    </a>
                @endforeach
            </div>

            <div class="text-center mt-4 reveal">
                <a href="{{ route('boutique.index') }}" class="vt-btn vt-btn--shop"><i class="bi bi-basket2-fill"></i> Voir tous les produits</a>
            </div>
        </div>
    </section>
@endif
