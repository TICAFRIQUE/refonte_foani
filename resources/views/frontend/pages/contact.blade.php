{{-- filepath: c:\laragon\www\foani\resources\views\frontend\pages\contact.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Contact')

@section('content')
    <style>
        /* Hero section pour contact */
        .contact-hero {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            color: white;
            padding: 80px 0;
            margin-bottom: 0;
            position: relative;
            overflow: hidden;
        }

        .contact-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="contact-pattern" width="25" height="25" patternUnits="userSpaceOnUse"><circle cx="12.5" cy="12.5" r="1.2" fill="rgba(255,255,255,0.1)"/><rect x="0" y="0" width="25" height="25" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23contact-pattern)"/></svg>');
            opacity: 0.4;
        }

        .contact-hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .contact-hero h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            letter-spacing: -1px;
        }

        .contact-hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin: 0;
            font-weight: 300;
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-hero::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 50px;
            background: linear-gradient(180deg, transparent, #f8f9fa);
        }

        /* Container principal */
        .contact-container {
            background: #f8f9fa;
            padding: 60px 0;
            min-height: 70vh;
        }

        /* Card informations */
        .contact-info-card {
            background: white;
            border: none;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            position: relative;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .contact-info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--color-vert), var(--color-jaune), var(--color-vert));
        }

        .contact-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 45px rgba(42, 107, 42, 0.15);
        }

        .contact-info-header {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 25px 30px;
            border-bottom: 1px solid #e9ecef;
        }

        .contact-info-title {
            color: var(--color-vert);
            font-weight: 800;
            font-size: 1.3rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .contact-info-body {
            padding: 30px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: rgba(42, 107, 42, 0.02);
        }

        .contact-item:hover {
            background: rgba(42, 107, 42, 0.05);
            transform: translateX(5px);
        }

        .contact-item:last-child {
            margin-bottom: 0;
        }

        .contact-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(42, 107, 42, 0.2);
            flex-shrink: 0;
        }

        .contact-details h6 {
            color: var(--color-vert);
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 1rem;
        }

        .contact-details p {
            color: #666;
            margin: 0;
            line-height: 1.5;
        }

        .contact-details a {
            color: var(--color-vert);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .contact-details a:hover {
            color: var(--color-vert2);
            text-decoration: underline;
        }

        /* Section direction */
        .direction-section {
            background: rgba(247, 201, 72, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin: 25px 0;
        }

        .direction-title {
            color: var(--color-vert);
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .direction-contact {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            color: #555;
        }

        .direction-contact:last-child {
            margin-bottom: 0;
        }

        .direction-contact i {
            color: var(--color-vert);
            font-size: 0.9rem;
            width: 16px;
        }

        /* Map container */
        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            margin-top: 25px;
            position: relative;
        }

        .map-container::before {
            content: '';
            position: absolute;
            inset: 0;
            border: 3px solid rgba(42, 107, 42, 0.1);
            border-radius: 15px;
            pointer-events: none;
            z-index: 1;
        }

        /* Card formulaire */
        .contact-form-card {
            background: white;
            border: none;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .contact-form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--color-jaune), var(--color-vert), var(--color-jaune));
        }

        .contact-form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 45px rgba(247, 201, 72, 0.15);
        }

        .contact-form-header {
            background: linear-gradient(135deg, #fff9e6, #fff3cd);
            padding: 25px 30px;
            border-bottom: 1px solid #ffeaa7;
        }

        .contact-form-title {
            color: var(--color-vert);
            font-weight: 800;
            font-size: 1.3rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .contact-form-body {
            padding: 30px;
        }

        /* Styles de formulaire améliorés */
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            color: var(--color-vert);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #fafbfc;
        }

        .form-control:focus {
            border-color: var(--color-vert);
            box-shadow: 0 0 0 0.2rem rgba(42, 107, 42, 0.1);
            background: white;
            transform: translateY(-1px);
        }

        .form-control:hover {
            border-color: rgba(42, 107, 42, 0.3);
            background: white;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .required-asterisk {
            color: var(--color-rouge);
            font-weight: 700;
        }

        /* Bouton d'envoi */
        .btn-submit {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            border: none;
            color: white;
            padding: 15px 35px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 6px 20px rgba(42, 107, 42, 0.3);
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, var(--color-vert2), #4CAF50);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(42, 107, 42, 0.4);
        }

        .btn-submit i {
            margin-right: 8px;
            transition: transform 0.3s ease;
        }

        .btn-submit:hover i {
            transform: translateX(3px);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .contact-hero {
                padding: 60px 0;
            }

            .contact-hero h1 {
                font-size: 2.5rem;
            }

            .contact-container {
                padding: 40px 0;
            }

            .contact-info-header,
            .contact-form-header {
                padding: 20px 25px;
            }

            .contact-info-body,
            .contact-form-body {
                padding: 25px;
            }
        }

        @media (max-width: 768px) {
            .contact-hero {
                padding: 50px 0;
            }

            .contact-hero h1 {
                font-size: 2rem;
            }

            .contact-hero p {
                font-size: 1.1rem;
            }

            .contact-container {
                padding: 30px 0;
            }

            .contact-info-card,
            .contact-form-card {
                margin-bottom: 25px;
                border-radius: 20px;
            }

            .contact-info-header,
            .contact-form-header {
                padding: 18px 20px;
            }

            .contact-info-body,
            .contact-form-body {
                padding: 20px;
            }

            .contact-item {
                padding: 12px;
                margin-bottom: 15px;
            }

            .contact-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .direction-section {
                padding: 15px;
                margin: 20px 0;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .btn-submit {
                padding: 12px 30px;
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .contact-hero {
                padding: 40px 0;
            }

            .contact-hero h1 {
                font-size: 1.7rem;
            }

            .contact-container {
                padding: 25px 0;
            }

            .contact-info-header,
            .contact-form-header {
                padding: 15px 18px;
            }

            .contact-info-body,
            .contact-form-body {
                padding: 18px;
            }

            .contact-info-title,
            .contact-form-title {
                font-size: 1.1rem;
            }

            .contact-item {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .contact-icon {
                align-self: center;
            }
        }

        /* Animations */
        .contact-info-card,
        .contact-form-card {
            animation: slideInUp 0.8s ease-out;
        }

        .contact-form-card {
            animation-delay: 0.2s;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    {{-- Hero Section --}}
    <section class="contact-hero">
        <div class="container">
            <div class="contact-hero-content">
                <h1>
                    <i class="bi bi-envelope-heart me-3"></i>Contactez-nous
                </h1>
                <p>Nous sommes à votre écoute pour répondre à toutes vos questions et vous accompagner dans vos projets</p>
            </div>
        </div>
    </section>

    {{-- Container principal --}}
    <section class="contact-container">
        <div class="container">
            <div class="row g-4 justify-content-center">
                {{-- Bloc gauche : Nos informations --}}
                <div class="col-lg-6">
                    <div class="contact-info-card">
                        <div class="contact-info-header">
                            <h4 class="contact-info-title">
                                <i class="bi bi-info-circle-fill"></i>
                                Nos informations
                            </h4>
                        </div>
                        <div class="contact-info-body">
                            {{-- Informations principales --}}
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div class="contact-details">
                                    <h6>Adresse</h6>
                                    <p>Zone industrielle de Yopougon, cité Bel Air, Abidjan, Côte d'Ivoire</p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                                <div class="contact-details">
                                    <h6>Email</h6>
                                    <p><a href="mailto:info@foani.ci">info@foani.ci</a></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                                <div class="contact-details">
                                    <h6>Téléphone siège</h6>
                                    <p><a href="tel:+2250505969625">+225 05 05 96 96 25</a></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="bi bi-clock-fill"></i>
                                </div>
                                <div class="contact-details">
                                    <h6>Horaires</h6>
                                    <p>Lundi - Samedi, 8h à 18h</p>
                                </div>
                            </div>

                            {{-- Directions --}}
                            <div class="direction-section">
                                <div class="direction-title">
                                    <i class="bi bi-building"></i>
                                    Direction Commerciale (Abidjan)
                                </div>
                                <div class="direction-contact">
                                    <i class="bi bi-telephone"></i>
                                    <span>Cel: <a href="tel:+2250505969625">05 05 96 96 25</a></span>
                                </div>
                            </div>

                            <div class="direction-section">
                                <div class="direction-title">
                                    <i class="bi bi-gear"></i>
                                    Direction Générale (Agnibilékro)
                                </div>
                                <div class="direction-contact">
                                    <i class="bi bi-telephone"></i>
                                    <span>Cel: <a href="tel:+2250505075727">05 05 07 57 27</a></span>
                                </div>
                                <div class="direction-contact">
                                    <i class="bi bi-telephone"></i>
                                    <span>Cel: <a href="tel:+2250102038662">01 02 03 86 62</a></span>
                                </div>
                            </div>

                            {{-- Map --}}
                            <div class="map-container">
                                <div class="ratio ratio-16x9">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m24!1m8!1m3!1d7944.072134403755!2d-4.08265!3d5.411478!3m2!1i1024!2i768!4f13.1!4m13!3e2!4m5!1s0xfc1ed254fef80ad%3A0x85d06d09dc2a3996!2sFOANI%20Abidjan%20zone%20industrielle%20Yopougon%2C%20Yopougon%20Zone%20industrielle%2Ccit%C3%A9%20bel%20air%2C%20Abidjan!3m2!1d5.4117358!2d-4.0826283!4m5!1s0xfc194554cb2cd55%3A0x8e22d541a71f973!2sAbobo%2C%20Abidjan!3m2!1d5.432887099999999!2d-4.0388918!5e0!3m2!1sfr!2sci!4v1760580862579!5m2!1sfr!2sci"
                                        style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bloc droit : Formulaire de contact --}}
                <div class="col-lg-6">
                    <div class="contact-form-card">
                        <div class="contact-form-header">
                            <h4 class="contact-form-title">
                                <i class="bi bi-chat-dots-fill"></i>
                                Formulaire de contact
                            </h4>
                        </div>
                        <div class="contact-form-body">
                            {{-- Messages de session --}}
                            @include('frontend.components.message_session')

                            <form action="{{ route('contact.store') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="bi bi-person"></i>
                                        Nom & Prénoms
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <input type="text" name="nom_prenoms" class="form-control"
                                        placeholder="Votre nom complet" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="bi bi-tag"></i>
                                        Objet
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <input type="text" name="objet" class="form-control"
                                        placeholder="Sujet de votre message" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="bi bi-envelope"></i>
                                        Email
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="votre@email.com" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="bi bi-telephone"></i>
                                        Téléphone
                                    </label>
                                    <input type="tel" name="telephone" class="form-control"
                                        placeholder="+225 XX XX XX XX XX">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="bi bi-chat-text"></i>
                                        Message
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <textarea name="message" class="form-control" rows="5" placeholder="Écrivez votre message ici..." required></textarea>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn-submit">
                                        <i class="bi bi-send"></i>
                                        Envoyer le message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
