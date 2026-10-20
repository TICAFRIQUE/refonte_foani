{{-- À propos (page « presentation ») + mot du directeur (page « mot-du-directeur ») --}}
@if ($presentation)
    @php
        $presTexte = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($presentation->description ?? ''))));
        $presImg = $presentation->getFirstMediaUrl('image', 'large');
    @endphp
    <section id="about" class="vt-section">
        <div class="container">
            <div class="row g-4 g-lg-5 align-items-center">
                <div class="col-lg-6 reveal">
                    <div class="vt-about__media">
                        @if ($presImg)
                            <img src="{{ $presImg }}" alt="FOANI & SERVICES" loading="lazy" decoding="async">
                        @endif
                        <div class="vt-about__badge">
                            <strong>50</strong>
                            <span>ans<br>d'expérience</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 reveal" style="--d:.1s">
                    <span class="vt-eyebrow">Qui sommes-nous ?</span>
                    <h2 class="vt-title">Une histoire de famille devenue une référence de l'aviculture</h2>
                    <p class="vt-lead">{{ Str::limit($presTexte, 420) }}</p>
                    <ul class="vt-checks">
                        <li><i class="bi bi-check-circle-fill"></i> Savoir-faire familial transmis de génération en génération</li>
                        <li><i class="bi bi-check-circle-fill"></i> Production maîtrisée, du couvoir à la distribution</li>
                        <li><i class="bi bi-check-circle-fill"></i> Présence à Abidjan et à l'intérieur du pays</li>
                    </ul>
                    <a href="{{ route('page.show', ['slug' => $presentation->slug]) }}" class="vt-btn vt-btn--primary">
                        Lire notre histoire <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            @php
                $dirTexte = $directeur ? trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($directeur->description ?? ''))), " \"«»") : '';
                $dirImg = $directeur?->getFirstMediaUrl('image', 'thumb');
                // Pas de citation si le texte du directeur reprend simplement celui de la présentation
                $citationDistincte = $dirTexte !== '' && Str::substr($dirTexte, 0, 80) !== Str::substr($presTexte, 0, 80);
            @endphp
            @if ($directeur && $citationDistincte)
                <figure class="vt-quote reveal">
                    @if ($dirImg)
                        <img src="{{ $dirImg }}" alt="Le directeur de FOANI" class="vt-quote__img" loading="lazy" width="120" height="120">
                    @endif
                    <div>
                        <i class="bi bi-quote vt-quote__mark" aria-hidden="true"></i>
                        <blockquote>{{ Str::limit($dirTexte, 260) }}</blockquote>
                        <figcaption>
                            <strong>{{ Str::ucfirst(Str::lower($directeur->libelle)) }}</strong>
                            <a href="{{ route('page.show', ['slug' => $directeur->slug]) }}">Lire le message complet <i class="bi bi-arrow-right"></i></a>
                        </figcaption>
                    </div>
                </figure>
            @endif
        </div>
    </section>
@endif
