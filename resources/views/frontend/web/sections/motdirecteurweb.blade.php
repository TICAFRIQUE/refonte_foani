{{-- filepath: c:\laragon\www\foani\resources\views\frontend\web\sections\motdirecteurweb.blade.php --}}
@push('styles')
    <style>
        /* MOT DU DIRECTEUR SECTION */
        .director-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 50%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .director-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(40, 64, 147, 0.03) 0%, transparent 70%);
            border-radius: 50%;
        }

        .director-section::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(108, 122, 224, 0.03) 0%, transparent 70%);
            border-radius: 50%;
        }

        .director-container {
            position: relative;
            z-index: 1;
        }

        .director-content {
            display: grid;
            grid-template-columns: 400px 1fr;
            gap: 60px;
            align-items: center;
            background: white;
            border-radius: 30px;
            padding: 60px;
            box-shadow: 0 20px 60px rgba(40, 64, 147, 0.08);
            border: 1px solid rgba(40, 64, 147, 0.05);
            position: relative;
            overflow: hidden;
        }

        .director-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(180deg, var(--color-primary), var(--color-secondary));
        }

        /* PHOTO DU DIRECTEUR */
        .director-photo {
            position: relative;
        }

        .director-image-wrapper {
            position: relative;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(40, 64, 147, 0.2);
        }

        .director-image-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
                    rgba(40, 64, 147, 0.1) 0%,
                    rgba(108, 122, 224, 0.05) 100%);
            z-index: 1;
            transition: opacity 0.3s ease;
        }

        .director-image-wrapper:hover::before {
            opacity: 0;
        }

        .director-image-wrapper img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .director-image-wrapper:hover img {
            transform: scale(1.05);
        }

        /* Badge citation */
        .quote-badge {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(40, 64, 147, 0.3);
            z-index: 2;
        }

        .quote-badge i {
            font-size: 2rem;
            color: white;
        }

        /* INFO DIRECTEUR */
        .director-info {
            position: absolute;
            bottom: 30px;
            left: 30px;
            right: 30px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 20px 25px;
            z-index: 2;
            box-shadow: 0 8px 32px rgba(40, 64, 147, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .director-info h4 {
            color: var(--color-primary);
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }

        .director-info p {
            color: var(--color-secondary);
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* MESSAGE DU DIRECTEUR */
        .director-message {
            display: flex;
            flex-direction: column;
        }

        .director-header {
            margin-bottom: 30px;
        }

        .director-label {
            display: inline-block;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(40, 64, 147, 0.3);
        }

        .director-header h3 {
            color: var(--color-primary);
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 15px;
            line-height: 1.2;
            position: relative;
            padding-bottom: 20px;
        }

        .director-header h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--color-secondary), transparent);
            border-radius: 2px;
        }

        .director-intro {
            font-size: 1.2rem;
            color: #666;
            line-height: 1.8;
            font-style: italic;
            margin-bottom: 30px;
            padding-left: 25px;
            border-left: 4px solid var(--color-secondary);
        }

        .director-text {
            font-size: 1.05rem;
            line-height: 1.9;
            color: #555;
            margin-bottom: 25px;
            text-align: justify;
        }

        .director-signature {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid rgba(40, 64, 147, 0.1);
        }

        .signature-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--color-primary);
            margin-bottom: 5px;
            font-family: 'Brush Script MT', cursive;
        }

        .signature-title {
            font-size: 1rem;
            color: var(--color-secondary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .director-cta {
            margin-top: 35px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-director {
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            color: white;
            border: none;
            padding: 15px 35px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(40, 64, 147, 0.3);
        }

        .btn-director:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(40, 64, 147, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-director i {
            transition: transform 0.3s ease;
        }

        .btn-director:hover i {
            transform: translateX(3px);
        }

        .btn-director-outline {
            background: transparent;
            color: var(--color-primary);
            border: 2px solid var(--color-primary);
            padding: 13px 33px;
        }

        .btn-director-outline:hover {
            background: var(--color-primary);
            color: white;
            border-color: var(--color-primary);
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .director-content {
                grid-template-columns: 350px 1fr;
                gap: 40px;
                padding: 50px 40px;
            }

            .director-image-wrapper img {
                height: 450px;
            }
        }

        @media (max-width: 768px) {
            .director-section {
                padding: 80px 0;
            }

            .director-content {
                grid-template-columns: 1fr;
                gap: 40px;
                padding: 40px 30px;
            }

            /* MOBILE: Photo en premier */
            .director-photo {
                order: 1;
            }

            /* MOBILE: Message en second */
            .director-message {
                order: 2;
            }

            .director-image-wrapper img {
                height: 400px;
            }

            .director-header h3 {
                font-size: 2rem;
            }

            .director-intro {
                font-size: 1.1rem;
            }

            .director-text {
                font-size: 1rem;
            }

            .director-cta {
                flex-direction: column;
            }

            .btn-director {
                width: 100%;
                justify-content: center;
            }

            .quote-badge {
                width: 60px;
                height: 60px;
                top: 20px;
                right: 20px;
            }

            .quote-badge i {
                font-size: 1.5rem;
            }

            .director-info {
                bottom: 20px;
                left: 20px;
                right: 20px;
                padding: 15px 20px;
            }

            .director-info h4 {
                font-size: 1.3rem;
            }

            .director-info p {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .director-section {
                padding: 60px 0;
            }

            .director-content {
                padding: 30px 20px;
            }

            .director-image-wrapper img {
                height: 350px;
            }

            .director-header h3 {
                font-size: 1.7rem;
            }

            .signature-name {
                font-size: 1.5rem;
            }

            .btn-director {
                padding: 12px 25px;
                font-size: 0.9rem;
            }
        }

        /* Variables CSS */
        :root {
            --color-primary: #284093;
            --color-secondary: #6c7ae0;
        }
    </style>
@endpush

<!-- MOT DU DIRECTEUR SECTION -->
<section id="mot-directeur" class="director-section">
    <div class="container director-container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="section-title" data-aos="fade-up">Mot du Directeur</h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                    Une vision, une passion, un engagement
                </p>
            </div>
        </div>

        <div class="director-content" data-aos="fade-up" data-aos-delay="200">
            <!-- PHOTO DU DIRECTEUR -->
            <div class="director-photo">
                <div class="director-image-wrapper">
                    <img src="{{ $directeur?->getFirstMediaUrl('image') }}" alt="Directeur FOANI">
                    
                    <!-- Badge citation -->
                    <div class="quote-badge">
                        <i class="bi bi-quote"></i>
                    </div>

                    <!-- Info directeur -->
                    <div class="director-info">
                        <h4>M. ALI OUATTARA</h4>
                        <p>Directeur Géneral de FOANI </p>
                    </div>
                </div>
            </div>

            <!-- MESSAGE DU DIRECTEUR -->
            <div class="director-message">
                <div class="director-header">
                    {{-- <span class="director-label">Leadership</span> --}}
                    <h3>Un Engagement pour l'Excellence</h3>
                    <p class="director-intro">
                        "Notre succès repose sur la qualité de nos produits et la confiance de nos clients"
                    </p>
                </div>

                <div class="director-body">
                    <p class="director-text">
                        {!! Str::limit($directeur?->description, 800, '...') !!}
                    </p>

                    
                </div>

                {{-- <div class="director-signature">
                    <div class="signature-name">M. ALI OUATTARA</div>
                    <div class="signature-title">Fondateur - FOANI</div>
                </div> --}}

                <div class="director-cta">
                    <a href="{{ route('page.show', 'mot-du-directeur') }}" class="btn btn-director">
                        Lire l'intégralité
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    {{-- <a href="#" class="btn btn-director btn-director-outline">
                        Notre Histoire
                        <i class="bi bi-book"></i>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</section>