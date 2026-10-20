{{-- Carte « Offre spéciale » (styles : public/front/css/shop.css, section « Offre spéciale ») --}}
@if ($offreSpeciale)
    @php
        $offreImg = $offreSpeciale->getFirstMediaUrl('image_principale', 'large') ?: asset('front/images/produits/poulet.png');
        $offrePrix = (float) $offreSpeciale->prix_de_vente;
        $offreFin = $offreSpeciale->date_fin_reduction ? \Illuminate\Support\Carbon::parse($offreSpeciale->date_fin_reduction)->endOfDay() : null;
        $offreFin = $offreFin && $offreFin->isFuture() ? $offreFin : null;
        $offreWa = rawurlencode('Bonjour, je veux profiter de l\'offre : ' . $offreSpeciale->libelle);
    @endphp

    <section class="offer-section">
        <div class="container">
            <div class="offer-card reveal">
                {{-- Photo --}}
                <div class="offer-card__media">
                    <div class="offer-photo">
                        <img src="{{ $offreImg }}" alt="{{ $offreSpeciale->libelle }}" loading="lazy" decoding="async">
                    </div>
                    <span class="offer-sticker"><span>Offre<br>du<br>weekend</span></span>
                </div>

                {{-- Contenu --}}
                <div class="offer-card__body">
                    <span class="eyebrow"><i class="bi bi-fire"></i> Bon plan de la ferme</span>
                    <h2 class="offer-card__title">{{ $offreSpeciale->libelle }}</h2>

                    <div class="offer-card__meta">
                        @if ($offrePrix > 0)
                            <span class="offer-price">{{ number_format($offrePrix, 0, ',', ' ') }} <small>FCFA</small></span>
                        @endif
                        <span class="offer-chip offer-chip--hot"><i class="bi bi-lightning-charge-fill"></i> Stock limité</span>
                        @if ($offreSpeciale->stock > 0)
                            <span class="offer-chip"><i class="bi bi-check-circle-fill"></i> Disponible</span>
                        @endif
                    </div>

                    @if ($offreFin)
                        <div class="offer-countdown" data-countdown="{{ $offreFin->toIso8601String() }}" aria-label="Temps restant">
                            <span class="lbl">Se termine dans</span>
                            <span class="box"><b data-u="j">0</b><small>jours</small></span>
                            <span class="box"><b data-u="h">00</b><small>h</small></span>
                            <span class="box"><b data-u="m">00</b><small>min</small></span>
                            <span class="box"><b data-u="s">00</b><small>s</small></span>
                        </div>
                    @endif

                    @if ($offreSpeciale->description)
                        <div class="offer-desc" id="offer-desc">
                            {!! nl2br(e($offreSpeciale->description)) !!}
                        </div>
                        <button type="button" class="offer-more" data-target="#offer-desc">
                            Lire la suite <i class="bi bi-chevron-down"></i>
                        </button>
                    @endif

                    <div class="offer-actions">
                        @if ($offrePrix > 0 && $offreSpeciale->stock > 0)
                            <button type="button" class="offer-btn offer-btn--main btn-ajouter-panier" data-id="{{ $offreSpeciale->id }}">
                                <i class="bi bi-basket2-fill"></i> Ajouter au panier
                            </button>
                        @elseif ($offrePrix > 0)
                            <a href="{{ route('reservation.create', ['slug' => $offreSpeciale->slug]) }}" class="offer-btn offer-btn--main">
                                <i class="bi bi-calendar-check"></i> Réserver
                            </a>
                        @endif
                        @if ($data_parametre?->contact2)
                            <a href="https://wa.me/225{{ $data_parametre->contact2 }}?text={{ $offreWa }}" target="_blank" rel="noopener"
                                class="offer-btn offer-btn--wa">
                                <i class="bi bi-whatsapp"></i> Commander sur WhatsApp
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            (function() {
                // « Lire la suite » : n'affiche le bouton que si le texte dépasse
                document.querySelectorAll('.offer-more').forEach(function(btn) {
                    var desc = document.querySelector(btn.dataset.target);
                    if (!desc) return;
                    if (desc.scrollHeight <= desc.clientHeight + 4) { btn.remove(); return; }
                    btn.addEventListener('click', function() {
                        var open = desc.classList.toggle('is-open');
                        btn.innerHTML = open ? 'Réduire <i class="bi bi-chevron-up"></i>' : 'Lire la suite <i class="bi bi-chevron-down"></i>';
                    });
                });

                // Compte à rebours jusqu'à la fin de l'offre
                document.querySelectorAll('[data-countdown]').forEach(function(el) {
                    var end = new Date(el.dataset.countdown).getTime();
                    var pad = function(n) { return String(n).padStart(2, '0'); };
                    function tick() {
                        var d = Math.max(0, end - Date.now());
                        el.querySelector('[data-u="j"]').textContent = Math.floor(d / 864e5);
                        el.querySelector('[data-u="h"]').textContent = pad(Math.floor(d / 36e5) % 24);
                        el.querySelector('[data-u="m"]').textContent = pad(Math.floor(d / 6e4) % 60);
                        el.querySelector('[data-u="s"]').textContent = pad(Math.floor(d / 1e3) % 60);
                        if (d === 0) clearInterval(timer);
                    }
                    var timer = setInterval(tick, 1000);
                    tick();
                });
            })();
        </script>
    @endpush
@endif
