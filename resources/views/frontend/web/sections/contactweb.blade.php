@push('styles')
    <style>
        /* CONTACT SECTION */
        .contact-section {
            padding: 120px 0;
            background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
            position: relative;
        }

        .contact-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800"><circle cx="100" cy="100" r="50" fill="rgba(40,64,147,0.03)"/><circle cx="1100" cy="700" r="80" fill="rgba(108,122,224,0.02)"/><circle cx="900" cy="200" r="30" fill="rgba(63,94,184,0.04)"/></svg>') no-repeat;
            background-size: cover;
            pointer-events: none;
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: start;
            margin-top: 60px;
        }

        /* INFORMATIONS DE CONTACT */
        .contact-info {
            background: white;
            border-radius: 25px;
            padding: 50px 40px;
            box-shadow: 0 15px 50px rgba(40, 64, 147, 0.1);
            border: 1px solid rgba(40, 64, 147, 0.05);
            position: relative;
            overflow: hidden;
        }

        .contact-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
        }

        .contact-header {
            margin-bottom: 40px;
        }

        .contact-header h3 {
            color: var(--color-primary);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            position: relative;
        }

        .contact-header h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--color-secondary);
            border-radius: 2px;
        }

        .contact-header p {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* CONTACT ITEMS */
        .contact-items {
            margin-bottom: 40px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 35px;
            padding: 20px;
            border-radius: 15px;
            transition: all 0.3s ease;
            border: 1px solid rgba(40, 64, 147, 0.05);
        }

        .contact-item:hover {
            background: linear-gradient(135deg, rgba(40, 64, 147, 0.03), rgba(248, 249, 255, 0.8));
            border-color: rgba(40, 64, 147, 0.1);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(40, 64, 147, 0.1);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            flex-shrink: 0;
            box-shadow: 0 8px 25px rgba(40, 64, 147, 0.2);
        }

        .contact-icon i {
            font-size: 1.5rem;
            color: white;
        }

        .contact-details h4 {
            color: var(--color-primary);
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .contact-details p {
            color: #555;
            margin: 0;
            line-height: 1.6;
        }

        .contact-details a {
            color: var(--color-primary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-details a:hover {
            color: var(--color-secondary);
            text-decoration: underline;
        }

        /* RÉSEAUX SOCIAUX */
        .contact-social {
            padding-top: 30px;
            border-top: 2px solid rgba(40, 64, 147, 0.1);
        }

        .contact-social h4 {
            color: var(--color-primary);
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            text-decoration: none;
            color: white;
            font-size: 1.3rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .social-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            color: white;
        }

        .social-link.facebook {
            background: linear-gradient(135deg, #3b5998, #4c70ba);
        }

        .social-link.twitter {
            background: linear-gradient(135deg, #1da1f2, #4fb3f6);
        }

        .social-link.linkedin {
            background: linear-gradient(135deg, #0077b5, #00a0dc);
        }

        .social-link.instagram {
            background: linear-gradient(135deg, #e4405f, #f56040, #ffad00);
        }

        .social-link.whatsapp {
            background: linear-gradient(135deg, #25d366, #128c7e);
        }

        /* CARTE */
        .contact-map {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(40, 64, 147, 0.1);
            border: 1px solid rgba(40, 64, 147, 0.05);
            position: sticky;
            top: 100px;
        }

        .map-header {
            padding: 40px 40px 20px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            color: white;
        }

        .map-header h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .map-header p {
            margin: 0;
            opacity: 0.9;
            font-size: 1rem;
        }

        .map-wrapper {
            position: relative;
            height: 450px;
            overflow: hidden;
        }

        .map-wrapper iframe {
            width: 100%;
            height: 100%;
            border: none;
            filter: grayscale(20%);
            transition: filter 0.3s ease;
        }

        .map-wrapper:hover iframe {
            filter: grayscale(0%);
        }

        .map-overlay {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 32px rgba(40, 64, 147, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            max-width: 280px;
        }

        .map-info h5 {
            color: var(--color-primary);
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .map-info p {
            color: #555;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .btn-map {
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-map:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(40, 64, 147, 0.3);
            color: white;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .contact-content {
                gap: 40px;
            }

            .contact-map {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .contact-section {
                padding: 80px 0;
            }

            .contact-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .contact-info {
                padding: 40px 30px;
            }

            .map-wrapper {
                height: 350px;
            }

            .map-overlay {
                position: static;
                margin-top: 20px;
                max-width: 100%;
            }

            .social-links {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .contact-info {
                padding: 30px 20px;
            }

            .contact-item {
                flex-direction: column;
                text-align: center;
                padding: 20px 15px;
            }

            .contact-icon {
                margin: 0 auto 15px;
            }

            .map-header {
                padding: 30px 20px 15px;
            }

            .map-wrapper {
                height: 300px;
            }
        }

        /* VARIABLES CSS (à ajouter dans le head si pas déjà présentes) */
        :root {
            --color-primary: #284093;
            --color-primary-light: #3f5eb8;
            --color-primary-dark: #1e2d6f;
            --color-secondary: #6c7ae0;
            --color-accent: #8b9dc3;
            --color-text-light: #a8b2d1;
        }
    </style>
@endpush






<!-- CONTACT SECTION -->
<section id="contact" class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title" data-aos="fade-up">Nous Contacter</h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                    Prenez contact avec nous pour toutes vos questions ou demandes
                </p>
            </div>
        </div>

        <div class="contact-content">
            <!-- INFORMATIONS DE CONTACT -->
            <div class="contact-info" data-aos="fade-right" data-aos-delay="200">
                <div class="contact-header">
                    <h3>Informations de Contact</h3>
                    <p>N'hésitez pas à nous contacter par l'un des moyens ci-dessous. Notre équipe est à votre
                        disposition pour répondre à toutes vos questions.</p>
                </div>

                <div class="contact-items">
                    <!-- ADRESSE -->
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Adresse</h4>
                            <p>{{ $data_parametre->localisation }} </p>
                        </div>
                    </div>

                    <!-- TÉLÉPHONE -->
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Téléphone</h4>
                            <p><a href="tel:+22507123456">+225 07 12 34 56 78</a><br>
                                <a href="tel:+22505987654">+225 05 98 76 54 32</a>
                            </p>
                        </div>
                    </div>

                    <!-- EMAIL -->
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Email</h4>
                            <p><a href="mailto:contact@foani.ci">contact@foani.ci</a><br>
                                <a href="mailto:info@foani.ci">info@foani.ci</a>
                            </p>
                        </div>
                    </div>

                    <!-- HEURES D'OUVERTURE -->
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Heures d'ouverture</h4>
                            <p>Lundi - Vendredi : 8h00 - 17h30<br>
                                Samedi : 8h00 - 12h00<br>
                                Dimanche : Fermé</p>
                        </div>
                    </div>
                </div>

                <!-- RÉSEAUX SOCIAUX -->
                <div class="contact-social">
                    <h4>Suivez-nous</h4>
                    <div class="social-links">
                        <a href="{{ $data_parametre?->lien_facebook }}" class="social-link facebook" target="_blank">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="{{ $data_parametre?->lien_twitter }}" class="social-link twitter" target="_blank">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="{{ $data_parametre?->lien_linkedin }}" class="social-link linkedin" target="_blank">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="{{ $data_parametre?->lien_instagram }}" class="social-link instagram" target="_blank">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="" class="social-link whatsapp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- CARTE GOOGLE MAPS -->
            <div class="contact-map" data-aos="fade-left" data-aos-delay="300">
                <div class="map-container">
                    <div class="map-header">
                        <h3>Notre Localisation</h3>
                        <p>Trouvez-nous facilement grâce à cette carte interactive</p>
                    </div>

                    <div class="map-wrapper">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m24!1m8!1m3!1d7944.072134403755!2d-4.08265!3d5.411478!3m2!1i1024!2i768!4f13.1!4m13!3e2!4m5!1s0xfc1ed254fef80ad%3A0x85d06d09dc2a3996!2sFOANI%20Abidjan%20zone%20industrielle%20Yopougon%2C%20Yopougon%20Zone%20industrielle%2Ccit%C3%A9%20bel%20air%2C%20Abidjan!3m2!1d5.4117358!2d-4.0826283!4m5!1s0xfc194554cb2cd55%3A0x8e22d541a71f973!2sAbobo%2C%20Abidjan!3m2!1d5.432887099999999!2d-4.0388918!5e0!3m2!1sfr!2sci!4v1760580862579!5m2!1sfr!2sci"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        <!-- OVERLAY INFO -->
                        <div class="map-overlay">
                            <div class="map-info">
                                <h5><i class="bi bi-geo-alt-fill"></i> FOANI</h5>
                                <p>{{ $data_parametre->localisation }}</p>
                                <a href="https://maps.google.com/?q={{ $data_parametre->localisation }}" target="_blank"
                                    class="btn btn-map">
                                    <i class="bi bi-map"></i> Voir sur Google Maps
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
