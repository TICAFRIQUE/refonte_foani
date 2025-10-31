{{-- filepath: c:\laragon\www\foani\resources\views\frontend\pages\gestion_page\detail.blade.php --}}
@extends('frontend.layouts.app')

@section('title', $page->libelle)

@section('content')
    <style>
        /* Hero section pour le détail de page */
        .detail-hero {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            color: white;
            padding: 60px 0;
            margin-bottom: 0;
            position: relative;
            overflow: hidden;
        }

        .detail-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="detail-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23detail-pattern)"/></svg>');
            opacity: 0.3;
        }

        .detail-hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .detail-breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 8px 20px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .detail-breadcrumb a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .detail-breadcrumb a:hover {
            color: white;
        }

        .detail-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 15px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .detail-badge {
            background: linear-gradient(135deg, var(--color-jaune), #f39c12);
            color: #333;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(241, 196, 15, 0.3);
        }

        .detail-meta {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            margin: 0;
        }

        .detail-meta i {
            margin-right: 8px;
            color: var(--color-jaune);
        }

        /* Container principal */
        .detail-container {
            background: #f8f9fa;
            padding: 60px 0;
            min-height: 60vh;
            position: relative;
        }

        .detail-container::before {
            content: '';
            position: absolute;
            top: -50px;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(180deg, var(--color-vert2), transparent);
            opacity: 0.1;
        }

        /* Card principale */
        .detail-card {
            background: white;
            border: none;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            position: relative;
            animation: slideInUp 0.8s ease-out;
        }

        .detail-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--color-vert), var(--color-jaune), var(--color-vert));
            border-radius: 25px 25px 0 0;
        }

        /* Section image */
        .detail-image-section {
            position: relative;
            padding: 40px 40px 20px;
            text-align: center;
        }

        .detail-image-container {
            position: relative;
            display: inline-block;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .detail-image-container:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px rgba(42, 107, 42, 0.2);
        }

        .detail-image {
            max-height: 400px;
            width: 100%;
            object-fit: cover;
            border-radius: 20px;
            transition: all 0.4s ease;
        }

        .detail-image-container:hover .detail-image {
            transform: scale(1.05);
        }

        .detail-image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, 
                rgba(42, 107, 42, 0.1), 
                transparent 50%, 
                rgba(247, 201, 72, 0.1));
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .detail-image-container:hover .detail-image-overlay {
            opacity: 1;
        }

        /* Section contenu */
        .detail-content-section {
            padding: 20px 40px 40px;
        }

        .detail-content {
            color: #444;
            line-height: 1.8;
            font-size: 1.05rem;
            font-family: 'Georgia', serif;
        }

        .detail-content h1,
        .detail-content h2,
        .detail-content h3,
        .detail-content h4,
        .detail-content h5,
        .detail-content h6 {
            color: var(--color-vert);
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-family: inherit;
        }

        .detail-content h2 {
            font-size: 1.8rem;
            border-left: 4px solid var(--color-jaune);
            padding-left: 15px;
        }

        .detail-content h3 {
            font-size: 1.5rem;
        }

        .detail-content p {
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .detail-content ul,
        .detail-content ol {
            padding-left: 25px;
            margin-bottom: 1.5rem;
        }

        .detail-content li {
            margin-bottom: 0.5rem;
        }

        .detail-content blockquote {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-left: 4px solid var(--color-vert);
            padding: 20px;
            margin: 2rem 0;
            border-radius: 0 15px 15px 0;
            font-style: italic;
            color: #555;
        }

        .detail-content img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            margin: 1.5rem 0;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .detail-content a {
            color: var(--color-vert);
            text-decoration: none;
            font-weight: 600;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .detail-content a:hover {
            color: var(--color-vert2);
            border-bottom-color: var(--color-jaune);
        }

        /* Bouton retour */
        .btn-retour {
            background: linear-gradient(135deg, #6c757d, #495057);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        .btn-retour:hover {
            background: linear-gradient(135deg, #495057, #343a40);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-retour i {
            transition: transform 0.3s ease;
        }

        .btn-retour:hover i {
            transform: translateX(-3px);
        }

        /* Section de partage social */
        .detail-share {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 25px;
            border-radius: 20px;
            margin-top: 30px;
            text-align: center;
        }

        .detail-share h5 {
            color: var(--color-vert);
            margin-bottom: 15px;
            font-weight: 700;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-social {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-social.facebook { background: #3b5998; }
        .btn-social.twitter { background: #1da1f2; }
        .btn-social.linkedin { background: #0077b5; }
        .btn-social.whatsapp { background: #25d366; }

        .btn-social:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .detail-hero {
                padding: 50px 0;
            }

            .detail-title {
                font-size: 2.2rem;
            }

            .detail-container {
                padding: 40px 0;
            }

            .detail-image-section,
            .detail-content-section {
                padding: 30px;
            }

            .detail-content {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {
            .detail-hero {
                padding: 40px 0;
            }

            .detail-title {
                font-size: 1.8rem;
            }

            .detail-container {
                padding: 30px 0;
            }

            .detail-image-section,
            .detail-content-section {
                padding: 25px 20px;
            }

            .detail-image {
                max-height: 300px;
            }

            .detail-content {
                font-size: 0.95rem;
                line-height: 1.7;
            }

            .detail-content h2 {
                font-size: 1.5rem;
            }

            .detail-content h3 {
                font-size: 1.3rem;
            }

            .btn-retour {
                width: 100%;
                justify-content: center;
                margin-bottom: 20px;
            }

            .social-buttons {
                gap: 8px;
            }

            .btn-social {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .detail-hero {
                padding: 30px 0;
            }

            .detail-title {
                font-size: 1.5rem;
            }

            .detail-badge {
                padding: 6px 15px;
                font-size: 0.8rem;
            }

            .detail-image-section,
            .detail-content-section {
                padding: 20px 15px;
            }

            .detail-image {
                max-height: 250px;
            }

            .detail-content {
                font-size: 0.9rem;
                text-align: left;
            }

            .detail-content h2 {
                font-size: 1.3rem;
            }

            .detail-breadcrumb {
                padding: 6px 15px;
                font-size: 0.8rem;
            }
        }

        /* Animations */
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

        .detail-content > * {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    {{-- Hero Section --}}
    <section class="detail-hero">
        <div class="container">
            <div class="detail-hero-content">
                {{-- Breadcrumb --}}
                {{-- <div class="detail-breadcrumb">
                    <a href="{{ route('accueil') }}">
                        <i class="bi bi-house-door"></i> Accueil
                    </a>
                    <i class="bi bi-chevron-right"></i>
                    <a href="{{ route('page.activites') }}">Activités</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>{{ Str::limit($page->libelle, 30) }}</span>
                </div> --}}

                {{-- Titre principal --}}
                <h1 class="detail-title">{{ $page->libelle }}</h1>

                {{-- Badge mot-clé --}}
                @if($page->mot_cle)
                    <div class="detail-badge">{{ $page->mot_cle }}</div>
                @endif

                {{-- Méta informations --}}
                @if($page->categorie)
                    <p class="detail-meta">
                        <i class="bi bi-folder2-open"></i>
                        {{ $page->categorie->libelle }}
                    </p>
                @endif
            </div>
        </div>
    </section>

    {{-- Container principal --}}
    <section class="detail-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    {{-- Bouton retour --}}
                    {{-- <a href="{{ route('page.activites') }}" class="btn-retour">
                        <i class="bi bi-arrow-left"></i>
                        Retour aux activités
                    </a> --}}

                    {{-- Card principale --}}
                    <div class="detail-card">
                        {{-- Section image --}}
                        <div class="detail-image-section">
                            <div class="detail-image-container">
                                @if($page->hasMedia('image'))
                                    <img src="{{ $page->getFirstMediaUrl('image') }}" 
                                         alt="{{ $page->libelle }}"
                                         class="detail-image">
                                @else
                                    <img src="{{ asset('front/images/default.jpg') }}" 
                                         alt="Image par défaut"
                                         class="detail-image">
                                @endif
                                <div class="detail-image-overlay"></div>
                            </div>
                        </div>

                        {{-- Section contenu --}}
                        <div class="detail-content-section">
                            <div class="detail-content">
                                {!! $page->description !!}
                            </div>

                            {{-- Section partage social --}}
                            <div class="detail-share">
                                <h5>Partager cette page</h5>
                                <div class="social-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                                       target="_blank" class="btn-social facebook">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($page->libelle) }}" 
                                       target="_blank" class="btn-social twitter">
                                        <i class="bi bi-twitter"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                                       target="_blank" class="btn-social linkedin">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($page->libelle . ' - ' . request()->fullUrl()) }}" 
                                       target="_blank" class="btn-social whatsapp">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection