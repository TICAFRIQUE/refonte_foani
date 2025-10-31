{{-- filepath: c:\laragon\www\foani\resources\views\frontend\pages\gestion_page\activites.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Nos Activités')

@section('content')
    <style>
        /* Hero section pour les activités */
        .activites-hero {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            color: white;
            padding: 80px 0;
            margin-bottom: 0;
            position: relative;
            overflow: hidden;
        }

        .activites-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="activites-pattern" width="25" height="25" patternUnits="userSpaceOnUse"><circle cx="12.5" cy="12.5" r="1.5" fill="rgba(255,255,255,0.1)"/><rect x="0" y="0" width="25" height="25" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23activites-pattern)"/></svg>');
            opacity: 0.4;
        }

        .activites-hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .activites-hero h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            letter-spacing: -1px;
        }

        .activites-hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin: 0;
            font-weight: 300;
        }

        .activites-hero::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 50px;
            background: linear-gradient(180deg, transparent, #f8f9fa);
        }

        /* Container principal */
        .activites-container {
            background: #f8f9fa;
            padding: 60px 0;
            min-height: 70vh;
        }

        /* Cards des activités */
        .activite-card {
            background: white;
            border: none;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            margin-bottom: 30px;
            position: relative;
        }

        .activite-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(42, 107, 42, 0.02), rgba(247, 201, 72, 0.02));
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .activite-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(42, 107, 42, 0.15);
        }

        .activite-card:hover::before {
            opacity: 1;
        }

        /* Image container */
        .activite-image-container {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .activite-image-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                rgba(42, 107, 42, 0.1) 0%, 
                transparent 50%, 
                rgba(247, 201, 72, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .activite-card:hover .activite-image-container::after {
            opacity: 1;
        }

        .activite-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .activite-card:hover .activite-image {
            transform: scale(1.1);
        }

        /* Badge mot-clé */
        .activite-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, var(--color-jaune), #f39c12);
            color: #333;
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(241, 196, 15, 0.3);
            z-index: 10;
        }

        /* Contenu de la carte */
        .activite-body {
            padding: 30px;
            position: relative;
        }

        .activite-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--color-vert);
            margin-bottom: 15px;
            line-height: 1.3;
            transition: color 0.3s ease;
        }

        .activite-title a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        .activite-title a:hover {
            color: var(--color-vert2);
            text-shadow: 0 2px 4px rgba(42, 107, 42, 0.1);
        }

        .activite-description {
            color: #666;
            line-height: 1.7;
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        /* Bouton lecture */
        .btn-lire-suite {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-lire-suite::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-lire-suite:hover::before {
            left: 100%;
        }

        .btn-lire-suite:hover {
            background: linear-gradient(135deg, var(--color-vert2), #4CAF50);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(42, 107, 42, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-lire-suite i {
            transition: transform 0.3s ease;
        }

        .btn-lire-suite:hover i {
            transform: translateX(3px);
        }

        /* État vide */
        .activites-empty {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border-radius: 25px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .activites-empty i {
            font-size: 4rem;
            color: var(--color-vert);
            opacity: 0.3;
            margin-bottom: 25px;
        }

        .activites-empty h3 {
            font-size: 1.5rem;
            color: #495057;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .activites-empty p {
            color: #6c757d;
            font-size: 1rem;
        }

        /* Layout mobile-first */
        @media (max-width: 992px) {
            .activites-hero {
                padding: 60px 0;
            }

            .activites-hero h1 {
                font-size: 2.5rem;
            }

            .activites-container {
                padding: 40px 0;
            }

            .activite-body {
                padding: 25px;
            }

            .activite-title {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 768px) {
            .activites-hero {
                padding: 50px 0;
            }

            .activites-hero h1 {
                font-size: 2rem;
            }

            .activites-hero p {
                font-size: 1.1rem;
            }

            .activites-container {
                padding: 30px 0;
            }

            .activite-card {
                margin-bottom: 25px;
                border-radius: 20px;
            }

            .activite-image-container {
                height: 200px;
            }

            .activite-body {
                padding: 20px;
            }

            .activite-title {
                font-size: 1.2rem;
                margin-bottom: 12px;
            }

            .activite-description {
                font-size: 0.9rem;
                margin-bottom: 15px;
            }

            .btn-lire-suite {
                padding: 8px 16px;
                font-size: 0.85rem;
                width: 100%;
                justify-content: center;
            }

            .activite-badge {
                top: 12px;
                right: 12px;
                padding: 5px 12px;
                font-size: 0.75rem;
            }
        }

        @media (max-width: 576px) {
            .activites-hero {
                padding: 40px 0;
            }

            .activites-hero h1 {
                font-size: 1.7rem;
            }

            .activites-container {
                padding: 25px 0;
            }

            .activite-card {
                margin-bottom: 20px;
                border-radius: 15px;
            }

            .activite-image-container {
                height: 180px;
            }

            .activite-body {
                padding: 18px;
            }

            .activite-title {
                font-size: 1.1rem;
            }

            .activites-empty {
                padding: 60px 15px;
            }

            .activites-empty h3 {
                font-size: 1.3rem;
            }
        }

        /* Animations */
        .activite-card {
            animation: slideInUp 0.6s ease-out;
        }

        .activite-card:nth-child(odd) {
            animation-delay: 0.1s;
        }

        .activite-card:nth-child(even) {
            animation-delay: 0.2s;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Effets de loading */
        .activite-card.loading {
            animation: pulse 1.5s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>

    {{-- Hero Section --}}
    <section class="activites-hero">
        <div class="container">
            <div class="activites-hero-content">
                <h1>
                    <i class="bi bi-gear-fill me-3"></i>Nos Activités
                </h1>
                <p>Découvrez l'ensemble de nos services et réalisations</p>
            </div>
        </div>
    </section>

    {{-- Container principal --}}
    <section class="activites-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    @forelse($activites as $activite)
                        <article class="activite-card">
                            <div class="row g-0">
                                {{-- Image --}}
                                <div class="col-md-5">
                                    <div class="activite-image-container">
                                        @if($activite->getFirstMediaUrl('image'))
                                            <img src="{{ $activite->getFirstMediaUrl('image') }}" 
                                                 alt="{{ $activite->libelle }}"
                                                 class="activite-image"
                                                 loading="lazy">
                                        @else
                                            <img src="{{ asset('front/images/default.jpg') }}" 
                                                 alt="Activité par défaut"
                                                 class="activite-image"
                                                 loading="lazy">
                                        @endif
                                        
                                        {{-- Badge mot-clé --}}
                                        @if($activite->mot_cle)
                                            <div class="activite-badge">
                                                {{ $activite->mot_cle }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Contenu --}}
                                <div class="col-md-7">
                                    <div class="activite-body">
                                        <h3 class="activite-title">
                                            <a href="{{ route('page.show', $activite->slug) }}">
                                                {{ $activite->libelle }}
                                            </a>
                                        </h3>
                                        
                                        <p class="activite-description">
                                            {{ Str::limit(strip_tags($activite->description), 200, '...') }}
                                        </p>
                                        
                                        <a href="{{ route('page.show', $activite->slug) }}" 
                                           class="btn-lire-suite">
                                            <i class="bi bi-book-half"></i>
                                            Lire la suite
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="activites-empty">
                            <i class="bi bi-inbox"></i>
                            <h3>Aucune activité disponible</h3>
                            <p>Nos activités seront bientôt publiées. Revenez nous voir !</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

@endsection