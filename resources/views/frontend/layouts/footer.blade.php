{{-- Footer boutique (styles : public/front/css/shop.css, section « Footer ») --}}
@php
    $tel1 = $data_parametre?->contact1 ?: '05 05 96 96 25';
    $whatsapp = $data_parametre?->contact2;
    $email = $data_parametre?->email1 ?: 'info@foani.ci';
    $adresse = $data_parametre?->localisation ?: 'Zone industrielle Yopougon, Cité Bel Air, Abidjan';
    $logoFooter = $data_parametre?->getFirstMediaUrl('logo_header') ?: asset('front/images/logo.png');
@endphp

<footer class="farm-footer">
    <svg class="wave-top" viewBox="0 0 1440 34" preserveAspectRatio="none" aria-hidden="true">
        <path fill="currentColor" d="M0 34V16c120 12 240 18 360 12s240-22 360-24 240 12 360 16 240-2 360-10v24z" />
    </svg>

    <div class="container">
        {{-- Appel à l'action --}}
        <div class="footer-cta d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 reveal">
            <div>
                <h3>Une commande, une question ? <span class="wobble">🐓</span></h3>
                <p>Notre équipe vous répond rapidement, du lundi au samedi.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                @if ($whatsapp)
                    <a href="https://wa.me/225{{ $whatsapp }}" target="_blank" rel="noopener" class="btn-cta btn-cta--wa">
                        <i class="bi bi-whatsapp"></i> Commander sur WhatsApp
                    </a>
                @endif
                <a href="{{ route('web.index') }}" class="btn-cta btn-cta--site">
                    <i class="bi bi-house-heart-fill"></i> Découvrir Foani &amp; Services
                </a>
            </div>
        </div>

        <div class="row g-4 g-lg-5 pt-2 pb-4">
            {{-- Marque --}}
            <div class="col-lg-4">
                <div class="footer-brand d-flex align-items-center gap-3 mb-3">
                    <img src="{{ $logoFooter }}" alt="Foani" width="64" height="64" loading="lazy">
                    <div>
                        <div class="fw-bold text-white fs-5" style="font-family: var(--font-title)">FOANI</div>
                        <div class="small" style="color: var(--straw)">Le vrai goût du poulet</div>
                    </div>
                </div>
                <p class="mb-3">
                    Volailles, œufs frais et produits d'élevage de qualité, de nos fermes à votre table partout en Côte d'Ivoire.
                </p>
                <div class="footer-social">
                    @if ($data_parametre?->lien_facebook)
                        <a href="{{ $data_parametre->lien_facebook }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if ($data_parametre?->lien_instagram)
                        <a href="{{ $data_parametre->lien_instagram }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if ($data_parametre?->lien_tiktok)
                        <a href="{{ $data_parametre->lien_tiktok }}" target="_blank" rel="noopener" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                    @endif
                    @if ($data_parametre?->lien_linkedin)
                        <a href="{{ $data_parametre->lien_linkedin }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    @endif
                    @if ($whatsapp)
                        <a href="https://wa.me/225{{ $whatsapp }}" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    @endif
                </div>
            </div>

            {{-- Liens --}}
            <div class="col-6 col-lg-2">
                <h5 class="footer-title">Boutique</h5>
                <ul class="list-unstyled footer-links mb-0">
                    <li><a href="{{ route('boutique.accueil') }}"><i class="bi bi-chevron-right"></i>Accueil</a></li>
                    <li><a href="{{ route('boutique.index') }}"><i class="bi bi-chevron-right"></i>Nos produits</a></li>
                    <li><a href="{{ route('panier.index') }}"><i class="bi bi-chevron-right"></i>Mon panier</a></li>
                    <li><a href="{{ route('contact') }}"><i class="bi bi-chevron-right"></i>Contact</a></li>
                    <li><a href="{{ route('web.index') }}"><i class="bi bi-chevron-right"></i>Site Foani &amp; Services</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-6 col-lg-3">
                <h5 class="footer-title">Contact</h5>
                <ul class="list-unstyled footer-contact mb-0">
                    <li><i class="bi bi-telephone-fill"></i>
                        <div><small>Standard</small><a href="tel:{{ preg_replace('/\s+/', '', $tel1) }}">{{ $tel1 }}</a></div>
                    </li>
                    <li><i class="bi bi-envelope-fill"></i>
                        <div><small>Email</small><a href="mailto:{{ $email }}">{{ $email }}</a></div>
                    </li>
                    <li><i class="bi bi-geo-alt-fill"></i>
                        <div><small>Adresse</small>{{ $adresse }}</div>
                    </li>
                    <li><i class="bi bi-clock-fill"></i>
                        <div><small>Horaires</small>Lun - Sam : 8h à 18h<br>Dimanche : fermé</div>
                    </li>
                </ul>
            </div>

            {{-- Vidéo --}}
            <div class="col-lg-3">
                <h5 class="footer-title">Notre spot</h5>
                <button type="button" class="yt-facade" data-yt="0Z2W1GitgBE" aria-label="Lire la vidéo Foani">
                    <img src="https://i.ytimg.com/vi/0Z2W1GitgBE/hqdefault.jpg" alt="" loading="lazy" width="480" height="360">
                    <span class="play"><i class="bi bi-play-fill"></i></span>
                </button>
            </div>
        </div>

        {{-- Points de vente --}}
        @if (collect($menu_points_vente ?? [])->isNotEmpty())
            <div class="footer-pv pb-3 text-center">
                <h5 class="footer-title justify-content-center">Nos points de vente</h5>
                @foreach (collect($menu_points_vente)->take(8) as $point)
                    <a href="{{ route('points_de_vente', ['slug' => $point->slug]) }}"><i class="bi bi-shop"></i>{{ $point->libelle }}</a>
                @endforeach
            </div>
        @endif

        <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 py-3">
            <span>&copy; {{ date('Y') }} Foani. Tous droits réservés.</span>
            <span>Développé par <a href="https://www.ticafrique.ci" target="_blank" rel="noopener">TICAFRIQUE</a></span>
        </div>
    </div>
    {{-- espace pour la barre de navigation mobile --}}
    <div class="d-lg-none" style="height: 76px"></div>
</footer>
