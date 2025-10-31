{{-- filepath: c:\laragon\www\foani\resources\views\frontend\layouts\footer.blade.php --}}
<!-- Footer -->
<footer class="footer py-5 mt-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        {{-- Section principale --}}
        <div class="row g-5">
            {{-- Colonne Actualités --}}
            <div class="col-lg-3 col-md-6">
                <div class="footer-section">
                    <h5 class="footer-title fw-bold mb-4 position-relative">
                        <i class="bi bi-newspaper me-2"></i>ACTUALITÉS
                    </h5>
                    <div class="video-container position-relative mb-3">
                        <div class="ratio ratio-16x9 rounded-3 shadow-sm overflow-hidden">
                            <iframe src="https://www.youtube.com/embed/0Z2W1GitgBE?start=3" title="Spot Foani"
                                allowfullscreen loading="lazy" class="rounded-3"></iframe>
                        </div>
                        <div
                            class="video-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                            <div class="play-button bg-white rounded-circle p-3 shadow">
                                <i class="bi bi-play-fill text-success fs-4"></i>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="news-links">
                        <a href="#" class="footer-link d-flex align-items-center mb-2">
                            <i class="bi bi-play-circle me-2 text-success"></i>
                            <span>Découvrez notre spot publicitaire</span>
                        </a>
                        <a href="{{ route('page.activites') }}" class="footer-link d-flex align-items-center">
                            <i class="bi bi-newspaper me-2 text-success"></i>
                            <span>Nos dernières actualités</span>
                        </a>
                    </div> --}}
                </div>
            </div>

            {{-- Colonne Information --}}
            <div class="col-lg-3 col-md-6">
                <div class="footer-section">
                    <h5 class="footer-title fw-bold mb-4 position-relative">
                        <i class="bi bi-info-circle me-2"></i>INFORMATION
                    </h5>
                    <ul class="footer-nav list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('page.activites') }}" class="footer-link">
                                <i class="bi bi-chevron-right me-2"></i>Nos Activités
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('boutique.index') }}" class="footer-link">
                                <i class="bi bi-chevron-right me-2"></i>Boutique
                            </a>
                        </li>
                        @foreach ($categories_pages->where('slug', '!=', 'activites')->take(3) as $categorie_page)
                            @foreach ($categorie_page->pages as $page)
                                <li class="mb-2">
                                    <a href="{{ route('page.show', ['slug' => $page->slug]) }}" class="footer-link">
                                        <i class="bi bi-chevron-right me-2"></i>{{ $page->libelle }}
                                    </a>
                                </li>
                            @endforeach
                        @endforeach
                        <li class="mb-2">
                            <a href="{{ route('contact') }}" class="footer-link">
                                <i class="bi bi-chevron-right me-2"></i>Contact & Support
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Colonne Contact --}}
            <div class="col-lg-3 col-md-6">
                <div class="footer-section">
                    <h5 class="footer-title fw-bold mb-4 position-relative">
                        <i class="bi bi-telephone me-2"></i>CONTACT
                    </h5>
                    <div class="contact-info">
                        {{-- Téléphone --}}
                        <div class="contact-item d-flex align-items-start mb-3">
                            <div class="contact-icon bg-success rounded-circle p-2 me-3 flex-shrink-0">
                                <i class="bi bi-telephone-fill text-white"></i>
                            </div>
                            <div class="contact-details">
                                <h6 class="mb-1 fw-semibold text-dark">Standard</h6>
                                <a href="tel:+2250505969625" class="footer-link">
                                    (+225) 05 05 96 96 25
                                </a>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="contact-item d-flex align-items-start mb-3">
                            <div class="contact-icon bg-success rounded-circle p-2 me-3 flex-shrink-0">
                                <i class="bi bi-envelope-fill text-white"></i>
                            </div>
                            <div class="contact-details">
                                <h6 class="mb-1 fw-semibold text-dark">Email</h6>
                                <a href="mailto:info@foani.ci" class="footer-link">
                                    info@foani.ci
                                </a>
                            </div>
                        </div>

                        {{-- Adresse --}}
                        <div class="contact-item d-flex align-items-start mb-3">
                            <div class="contact-icon bg-success rounded-circle p-2 me-3 flex-shrink-0">
                                <i class="bi bi-geo-alt-fill text-white"></i>
                            </div>
                            <div class="contact-details">
                                <h6 class="mb-1 fw-semibold text-dark">Adresse</h6>
                                <p class="mb-0 text-dark small">
                                    Zone industrielle Yopougon,<br>
                                    Cité Bel Air, Abidjan
                                </p>
                            </div>
                        </div>

                        {{-- Horaires --}}
                        <div class="contact-item d-flex align-items-start">
                            <div class="contact-icon bg-success rounded-circle p-2 me-3 flex-shrink-0">
                                <i class="bi bi-clock-fill text-white"></i>
                            </div>
                            <div class="contact-details">
                                <h6 class="mb-1 fw-semibold text-dark">Horaires</h6>
                                <p class="mb-0 text-dark small">
                                    Lun - Sam : 8h à 18h<br>
                                    Dimanche : Fermé
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Colonne Suivez-nous --}}
            <div class="col-lg-3 col-md-6">
                <div class="footer-section">
                    <h5 class="footer-title fw-bold mb-4 position-relative">
                        <i class="bi bi-share me-2"></i>SUIVEZ-NOUS
                    </h5>

                    {{-- Réseaux sociaux --}}
                    <div class="social-media mb-4">
                        <div class="row g-2">
                            <div class="col-6">
                                <a href="https://www.facebook.com/foaniservices" target="_blank"
                                    class="social-link facebook d-flex align-items-center p-3 rounded-3 text-decoration-none">
                                    <i class="bi bi-facebook fs-4 me-2"></i>
                                    <span class="small fw-semibold">Facebook</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="https://wa.me/2250505969625" target="_blank"
                                    class="social-link whatsapp d-flex align-items-center p-3 rounded-3 text-decoration-none">
                                    <i class="bi bi-whatsapp fs-4 me-2"></i>
                                    <span class="small fw-semibold">WhatsApp</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#"
                                    class="social-link instagram d-flex align-items-center p-3 rounded-3 text-decoration-none">
                                    <i class="bi bi-instagram fs-4 me-2"></i>
                                    <span class="small fw-semibold">Instagram</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#"
                                    class="social-link youtube d-flex align-items-center p-3 rounded-3 text-decoration-none">
                                    <i class="bi bi-youtube fs-4 me-2"></i>
                                    <span class="small fw-semibold">YouTube</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Newsletter --}}
                    {{-- <div class="newsletter-section bg-white p-3 rounded-3 shadow-sm">
                        <h6 class="fw-semibold mb-2 text-dark">
                            <i class="bi bi-envelope-heart me-2 text-success"></i>Newsletter
                        </h6>
                        <p class="small text-secondary mb-3">Recevez nos dernières offres</p>
                        <form class="newsletter-form">
                            <div class="input-group">
                                <input type="email" class="form-control form-control-sm" 
                                       placeholder="Votre email..." required>
                                <button class="btn btn-success btn-sm" type="submit">
                                    <i class="bi bi-send"></i>
                                </button>
                            </div>
                        </form>
                    </div> --}}
                </div>
            </div>
            
        </div>

        {{-- Section Points de vente rapides --}}
        <div class="row mt-5 pt-4 border-top">
            <div class="col-12">
                <h6 class="fw-semibold mb-3 text-center text-dark">
                    <i class="bi bi-geo-alt me-2 text-success"></i>Nos Points de Vente
                </h6>
                <div class="points-vente-quick d-flex flex-wrap justify-content-center gap-2">
                    @php
                        $points_de_vente_footer = \App\Models\CategoriePointVente::active()->take(6)->get();
                    @endphp
                    @foreach ($points_de_vente_footer as $point)
                        <a href="{{ route('points_de_vente', ['slug' => $point->slug]) }}"
                            
                            class="badge bg-light text-dark text-decoration-none px-3 py-2 rounded-pill border">
                            <i class="bi bi-shop me-1"></i>{{ $point->libelle }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Section Copyright --}}
        <div class="row mt-4 pt-4 border-top">
            <div class="col-lg-6 text-center text-lg-start">
                <div class="d-flex align-items-center justify-content-center justify-content-lg-start mb-2 mb-lg-0">
                    <img src="{{ $data_parametre ? URL::asset($data_parametre->getFirstMediaUrl('logo_header')) : URL::asset('images/camera-icon.png') }}"
                        alt="Foani" class="footer-logo me-3 rounded-circle"
                        style="width: 40px; height: 40px; object-fit: contain;">
                    <div>
                        <div class="fw-bold text-success">FOANI</div>
                        <div class="small text-secondary">Spécialiste Volaille & Œufs</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-end">
                <div class="copyright-text">
                    <p class="mb-1 small text-secondary">
                        &copy; {{ date('Y') }} <strong class="text-dark">Foani</strong>. Tous droits réservés.
                    </p>
                    <p class="mb-0 small text-secondary">
                        Développé avec ❤️ par
                        <a href="https://www.ticafrique.ci" target="_blank"
                            class="text-decoration-none fw-semibold text-success">TICAFRIQUE</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Styles Footer améliorés - Texte plus lisible */
    .footer {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #e9ecef 100%) !important;
    }

    .footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="footer-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="0.8" fill="rgba(85,158,51,0.03)"/></pattern></defs><rect width="100" height="100" fill="url(%23footer-pattern)"/></svg>');
        opacity: 0.4;
    }

    .footer-section {
        position: relative;
        z-index: 2;
    }

    /* Titres de section - Contraste amélioré */
    .footer-title {
        color: var(--color-vert) !important;
        font-size: 1.1rem;
        position: relative;
        padding-bottom: 10px;
        font-weight: 800 !important;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .footer-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background: linear-gradient(90deg, var(--color-vert), var(--color-jaune));
        border-radius: 2px;
    }

    /* Liens footer - Contraste très amélioré */
    .footer-link {
        color: #2c3e50 !important;
        text-decoration: none;
        text-transform: uppercase;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        font-weight: 500;
        text-shadow: 0 1px 1px rgba(255, 255, 255, 0.8);
    }

    .footer-link:hover {
        color: var(--color-vert) !important;
        transform: translateX(5px);
        text-decoration: none;
        font-weight: 600;
    }

    /* Navigation footer */
    .footer-nav li {
        transition: all 0.3s ease;
    }

    .footer-nav li:hover {
        transform: translateX(5px);
    }

    /* Items de contact - Texte plus foncé */
    .contact-item {
        transition: all 0.3s ease;
        padding: 8px;
        border-radius: 10px;
    }

    .contact-item:hover {
        background: rgba(85, 158, 51, 0.08);
        transform: translateX(5px);
    }

    .contact-details h6 {
        color: #1a1a1a !important;
        font-weight: 700 !important;
        font-size: 0.95rem;
        text-shadow: 0 1px 1px rgba(255, 255, 255, 0.8);
    }

    .contact-details p {
        color: #2c3e50 !important;
        font-weight: 500;
        line-height: 1.4;
        text-shadow: 0 1px 1px rgba(255, 255, 255, 0.8);
    }

    .contact-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(85, 158, 51, 0.3);
    }

    .contact-item:hover .contact-icon {
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(85, 158, 51, 0.4);
    }

    /* Réseaux sociaux - Texte plus contrasté */
    .social-link {
        background: #ffffff !important;
        border: 2px solid #e9ecef;
        color: #2c3e50 !important;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        min-height: 60px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        font-weight: 600;
    }

    .social-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        color: white !important;
        text-decoration: none;
    }

    .social-link.facebook:hover {
        background: linear-gradient(135deg, #1877f2, #42a5f5) !important;
        border-color: #1877f2;
    }

    .social-link.whatsapp:hover {
        background: linear-gradient(135deg, #25d366, #128c7e) !important;
        border-color: #25d366;
    }

    .social-link.instagram:hover {
        background: linear-gradient(135deg, #e4405f, #f56040, #ffdc80) !important;
        border-color: #e4405f;
    }

    .social-link.youtube:hover {
        background: linear-gradient(135deg, #ff0000, #cc0000) !important;
        border-color: #ff0000;
    }

    /* Container vidéo */
    .video-container {
        transition: all 0.3s ease;
    }

    .video-container:hover {
        transform: scale(1.02);
    }

    .video-overlay {
        background: rgba(0, 0, 0, 0.4);
        opacity: 0;
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .video-container:hover .video-overlay {
        opacity: 1;
    }

    .play-button {
        transition: all 0.3s ease;
        transform: scale(0.8);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .video-container:hover .play-button {
        transform: scale(1);
    }

    /* Newsletter - Meilleur contraste */
    .newsletter-section {
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
        background: #ffffff !important;
    }

    .newsletter-section:hover {
        border-color: var(--color-vert);
        box-shadow: 0 4px 15px rgba(85, 158, 51, 0.15);
    }

    .newsletter-section h6 {
        color: #1a1a1a !important;
        font-weight: 700 !important;
    }

    .newsletter-section p {
        color: #495057 !important;
        font-weight: 500;
    }

    .newsletter-form .form-control:focus {
        border-color: var(--color-vert);
        box-shadow: 0 0 0 0.2rem rgba(85, 158, 51, 0.25);
    }

    /* Points de vente rapides */
    .points-vente-quick .badge {
        transition: all 0.3s ease;
        font-weight: 600 !important;
        color: #2c3e50 !important;
        background: #ffffff !important;
        border: 2px solid #ff00bb !important;
    }

    .points-vente-quick .badge:hover {
        background: var(--color-vert) !important;
        color: white !important;
        border-color: var(--color-vert) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(85, 158, 51, 0.3);
    }

    /* Copyright - Meilleur contraste */
    .copyright-text {
        opacity: 1;
    }

    .copyright-text p {
        color: #495057 !important;
        font-weight: 500;
    }

    .copyright-text strong {
        color: #1a1a1a !important;
    }

    /* Textes généraux plus contrastés */
    .text-secondary {
        color: #495057 !important;
        font-weight: 500;
    }

    .text-dark {
        color: #1a1a1a !important;
        font-weight: 600;
    }

    /* Responsive - Optimisé pour mobile */
    @media (max-width: 768px) {
        .footer {
            padding: 2rem 0 !important;
            /* Réduction du padding */
            margin-top: 2rem !important;
            /* Réduction de la marge */
        }

        .footer-section {
            margin-bottom: 1.5rem !important;
            /* Moins d'espace entre sections */
        }

        .footer-title {
            font-size: 1rem;
            text-align: center;
            margin-bottom: 1rem !important;
            /* Réduction des marges */
        }

        .footer-title::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .social-link {
            min-height: 45px !important;
            /* Réduction hauteur */
            font-size: 0.8rem;
            padding: 0.5rem !important;
            /* Padding réduit */
        }

        .contact-item {
            flex-direction: row !important;
            /* Garder horizontal */
            text-align: left !important;
            /* Alignement gauche */
            padding: 8px !important;
            /* Padding réduit */
            margin-bottom: 0.8rem !important;
            /* Espacement réduit */
        }

        .contact-icon {
            margin-bottom: 0 !important;
            width: 30px !important;
            /* Icônes plus petites */
            height: 30px !important;
        }

        .points-vente-quick {
            justify-content: center !important;
        }

        .newsletter-section {
            padding: 1rem !important;
            /* Padding réduit */
            margin-bottom: 1rem !important;
        }

        .video-container {
            margin-bottom: 1rem !important;
            /* Réduction marge vidéo */
        }

        .news-links a {
            margin-bottom: 0.5rem !important;
            /* Espacement réduit */
        }

        /* Réduction des gaps et marges générales */
        .row.g-5 {
            gap: 1rem !important;
            /* Gap réduit */
        }

        .row.mt-5 {
            margin-top: 2rem !important;
            /* Marges réduites */
        }

        .row.mt-4 {
            margin-top: 1.5rem !important;
        }

        .pt-4 {
            padding-top: 1rem !important;
        }

        .mb-4 {
            margin-bottom: 1rem !important;
        }

        .mb-3 {
            margin-bottom: 0.8rem !important;
        }
    }

    @media (max-width: 576px) {
        .footer {
            padding: 1.5rem 0 !important;
            /* Encore moins de padding */
        }

        .footer-section {
            margin-bottom: 1rem !important;
        }

        .row.g-5 {
            gap: 0.8rem !important;
            /* Gap encore plus réduit */
        }

        .contact-item {
            margin-bottom: 0.6rem !important;
        }

        .social-link {
            min-height: 40px !important;
            font-size: 0.75rem;
        }

        .newsletter-section {
            padding: 0.8rem !important;
        }
    }
</style>
