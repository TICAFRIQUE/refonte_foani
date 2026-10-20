{{-- Bannières (images administrables) + carte d'accroche --}}
<section id="home" class="vt-hero">
    @if ($sliders->isNotEmpty())
        <div id="vtSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
            @if ($sliders->count() > 1)
                <div class="carousel-indicators">
                    @foreach ($sliders as $slider)
                        <button type="button" data-bs-target="#vtSlider" data-bs-slide-to="{{ $loop->index }}"
                            class="{{ $loop->first ? 'active' : '' }}" aria-label="Bannière {{ $loop->iteration }}"
                            @if ($loop->first) aria-current="true" @endif></button>
                    @endforeach
                </div>
            @endif
            <div class="carousel-inner">
                @foreach ($sliders as $slider)
                    @php $img = $slider->getFirstMediaUrl('image', 'large') ?: asset('front/images/sliders/default.jpg'); @endphp
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        @if ($slider->url)
                            <a href="{{ $slider->url }}" aria-label="{{ $slider->libelle }}">
                        @endif
                        <img src="{{ $img }}" alt="{{ $slider->libelle }}" class="vt-hero__img" decoding="async"
                            @if ($loop->first) fetchpriority="high" @else loading="lazy" @endif>
                        @if ($slider->url)
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
            @if ($sliders->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#vtSlider" data-bs-slide="prev" aria-label="Précédent">
                    <span class="vt-hero__arrow"><i class="bi bi-chevron-left"></i></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#vtSlider" data-bs-slide="next" aria-label="Suivant">
                    <span class="vt-hero__arrow"><i class="bi bi-chevron-right"></i></span>
                </button>
            @endif
        </div>
    @endif

    {{-- Carte d'accroche --}}
    <div class="container">
        <div class="vt-intro reveal">
            <div class="vt-intro__text">
                <span class="vt-eyebrow">Bienvenue chez FOANI</span>
                <h1>Le vrai goût du poulet,<br class="d-none d-md-inline"> de nos fermes à votre table</h1>
                <p>Entreprise familiale ivoirienne, FOANI &amp; SERVICES produit et distribue volailles, œufs et poussins
                    de qualité, avec un savoir-faire transmis de génération en génération.</p>
                <div class="vt-intro__cta">
                    <a href="{{ route('boutique.accueil') }}" class="vt-btn vt-btn--shop"><i class="bi bi-basket2-fill"></i> Commander en ligne</a>
                    <a href="#about" class="vt-btn vt-btn--ghost">Découvrir l'entreprise <i class="bi bi-arrow-down"></i></a>
                </div>
            </div>
            <ul class="vt-intro__facts">
                <li><strong>1975</strong><span>année de création</span></li>
                <li><strong>250+</strong><span>collaborateurs</span></li>
                <li><strong>60+</strong><span>points de vente</span></li>
            </ul>
        </div>
    </div>
</section>
