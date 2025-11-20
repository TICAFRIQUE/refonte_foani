{{-- filepath: c:\laragon\www\foani\resources\views\frontend\web\pages\page-detail.blade.php --}}
@extends('frontend.web.layouts.appweb')

@section('content')
@push('styles')
<style>
    /* Hero section pour le détail de page */
    .detail-hero {
        background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
        color: white;
        padding: 140px 0 60px;
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

    /* BREADCRUMB RESPONSIVE */
    .detail-breadcrumb {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 25px;
        padding: 12px 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 25px;
        font-size: 0.9rem;
        font-weight: 500;
        max-width: 100%;
        width: auto;
        flex-wrap: wrap;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .detail-breadcrumb a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
    }

    .detail-breadcrumb a:hover {
        color: white;
        transform: scale(1.05);
    }

    .breadcrumb-separator {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.8rem;
        margin: 0 2px;
    }

    .breadcrumb-current {
        color: white;
        font-weight: 600;
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .detail-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        margin-bottom: 15px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .detail-badge {
        background: linear-gradient(135deg, var(--color-secondary), var(--color-accent));
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(108, 122, 224, 0.3);
    }

    .detail-meta {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        padding: 8px 16px;
        border-radius: 20px;
        backdrop-filter: blur(10px);
    }

    .meta-item i {
        color: var(--color-accent);
        font-size: 1.1rem;
    }

    /* Container principal */
    .detail-container {
        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 50%, #f0f2ff 100%);
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
        background: linear-gradient(180deg, var(--color-primary-light), transparent);
        opacity: 0.1;
    }

    /* Card principale */
    .detail-card {
        background: white;
        border: none;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(40, 64, 147, 0.08);
        border: 1px solid rgba(40, 64, 147, 0.05);
        position: relative;
        animation: slideInUp 0.8s ease-out;
    }

    .detail-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
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
        box-shadow: 0 12px 30px rgba(40, 64, 147, 0.15);
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .detail-image-container:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 20px 50px rgba(40, 64, 147, 0.25);
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
            rgba(40, 64, 147, 0.1), 
            transparent 50%, 
            rgba(108, 122, 224, 0.1));
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
        font-size: 1.1rem;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .detail-content h1,
    .detail-content h2,
    .detail-content h3,
    .detail-content h4,
    .detail-content h5,
    .detail-content h6 {
        color: var(--color-primary);
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
        position: relative;
    }

    .detail-content h2 {
        font-size: 1.8rem;
        border-left: 4px solid var(--color-secondary);
        padding-left: 15px;
        background: linear-gradient(135deg, rgba(40, 64, 147, 0.03), rgba(248, 249, 255, 0.5));
        padding: 15px 15px 15px 25px;
        border-radius: 10px;
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
        position: relative;
    }

    .detail-content ul li::before {
        content: '▶';
        color: var(--color-primary);
        font-weight: 700;
        position: absolute;
        left: -20px;
        top: 0;
    }

    .detail-content blockquote {
        background: linear-gradient(135deg, rgba(40, 64, 147, 0.05), rgba(248, 249, 255, 0.8));
        border-left: 4px solid var(--color-primary);
        padding: 25px;
        margin: 2rem 0;
        border-radius: 0 15px 15px 0;
        font-style: italic;
        color: #555;
        position: relative;
    }

    .detail-content blockquote::before {
        content: '"';
        font-size: 60px;
        color: var(--color-primary);
        position: absolute;
        top: -10px;
        left: 15px;
        opacity: 0.3;
        font-family: serif;
    }

    .detail-content img {
        max-width: 100%;
        height: auto;
        border-radius: 15px;
        margin: 1.5rem 0;
        box-shadow: 0 8px 25px rgba(40, 64, 147, 0.1);
    }

    .detail-content a {
        color: var(--color-primary);
        text-decoration: none;
        font-weight: 600;
        border-bottom: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .detail-content a:hover {
        color: var(--color-secondary);
        border-bottom-color: var(--color-accent);
    }

    /* Bouton retour */
    .btn-retour {
        background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
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
        box-shadow: 0 4px 15px rgba(40, 64, 147, 0.3);
    }

    .btn-retour:hover {
        background: linear-gradient(135deg, var(--color-primary-dark), var(--color-primary));
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40, 64, 147, 0.4);
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
        background: linear-gradient(135deg, rgba(40, 64, 147, 0.03), rgba(248, 249, 255, 0.8));
        padding: 30px;
        border-radius: 20px;
        margin-top: 40px;
        text-align: center;
        border: 2px solid rgba(40, 64, 147, 0.08);
    }

    .detail-share h5 {
        color: var(--color-primary);
        margin-bottom: 20px;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .social-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-social {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: none;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    .btn-social::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-social:hover::before {
        left: 100%;
    }

    .btn-social.facebook { 
        background: linear-gradient(135deg, #3b5998, #2d4373); 
    }

    .btn-social.twitter { 
        background: linear-gradient(135deg, #1da1f2, #0d8bd9); 
    }

    .btn-social.linkedin { 
        background: linear-gradient(135deg, #0077b5, #005885); 
    }

    .btn-social.whatsapp { 
        background: linear-gradient(135deg, #25d366, #20b358); 
    }

    .btn-social:hover {
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .detail-hero {
            padding: 120px 0 50px;
        }

        .detail-title {
            font-size: 2.5rem;
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
            padding: 110px 0 40px;
        }

        .detail-title {
            font-size: 2rem;
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
            text-align: left;
        }

        .detail-content h2 {
            font-size: 1.5rem;
            padding: 12px 12px 12px 20px;
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
            gap: 12px;
        }

        .btn-social {
            width: 45px;
            height: 45px;
            font-size: 1.1rem;
        }

        .detail-meta {
            flex-direction: column;
            gap: 10px;
        }

        .meta-item {
            padding: 6px 12px;
            font-size: 0.9rem;
        }

        .detail-share {
            padding: 25px 20px;
        }

        /* BREADCRUMB MOBILE */
        .detail-breadcrumb {
            padding: 8px 16px;
            font-size: 0.8rem;
            gap: 8px;
            margin-bottom: 20px;
            max-width: 90%;
            overflow: hidden;
        }

        .breadcrumb-current {
            max-width: 150px;
            font-size: 0.75rem;
        }

        .detail-breadcrumb a i {
            font-size: 0.9rem;
        }

        .breadcrumb-separator {
            font-size: 0.7rem;
            margin: 0 1px;
        }
    }

    @media (max-width: 576px) {
        .detail-hero {
            padding: 100px 0 30px;
        }

        .detail-title {
            font-size: 1.8rem;
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
        }

        .detail-content h2 {
            font-size: 1.3rem;
        }

        .detail-share h5 {
            font-size: 1.1rem;
        }

        /* BREADCRUMB TRÈS PETIT ÉCRAN */
        .detail-breadcrumb {
            padding: 6px 12px;
            font-size: 0.75rem;
            gap: 6px;
            margin-bottom: 15px;
            max-width: 95%;
            flex-direction: column;
            text-align: center;
            min-height: auto;
        }

        .detail-breadcrumb a {
            font-size: 0.7rem;
        }

        .detail-breadcrumb a i {
            font-size: 0.8rem;
        }

        .breadcrumb-separator {
            display: none;
        }

        .breadcrumb-current {
            max-width: 180px;
            font-size: 0.7rem;
            margin-top: 4px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 4px;
        }
    }

    @media (max-width: 380px) {
        .detail-breadcrumb {
            padding: 5px 10px;
            font-size: 0.7rem;
            gap: 4px;
        }

        .detail-breadcrumb a {
            font-size: 0.65rem;
        }

        .breadcrumb-current {
            font-size: 0.65rem;
            max-width: 160px;
        }

        .detail-title {
            font-size: 1.6rem;
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

    /* Scroll indicator */
    .page-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
        z-index: 9999;
        transition: width 0.3s ease;
    }
</style>
@endpush

<!-- PROGRESS BAR -->
<div class="page-progress"></div>

<!-- Hero Section -->
<section class="detail-hero">
    <div class="container">
        <div class="detail-hero-content" data-aos="fade-up">
            <!-- Breadcrumb -->
            <div class="detail-breadcrumb">
                <a href="{{ route('web.index') }}">
                    <i class="bi bi-house-door"></i> 
                    <span>Accueil</span>
                </a>
                <i class="bi bi-chevron-right breadcrumb-separator"></i>
                <span class="breadcrumb-current">{{ Str::limit($page->libelle, 30) }}</span>
            </div>

            <!-- Titre principal -->
            <h1 class="detail-title">{{ $page->libelle }}</h1>

            <!-- Badge mot-clé -->
            @if($page->mot_cle)
                <div class="detail-badge">{{ $page->mot_cle }}</div>
            @endif

            <!-- Méta informations -->
            <div class="detail-meta">
                {{-- @if($page->created_at)
                    <div class="meta-item">
                        <i class="bi bi-calendar3"></i>
                        <span>{{ $page->created_at->format('d M Y') }}</span>
                    </div>
                @endif --}}
                @if($page->categorie)
                    <div class="meta-item">
                        <i class="bi bi-folder2-open"></i>
                        <span>{{ $page->categorie->libelle }}</span>
                    </div>
                @endif
                {{-- <div class="meta-item">
                    <i class="bi bi-person"></i>
                    <span>Équipe FOANI</span>
                </div> --}}
            </div>
        </div>
    </div>
</section>

<!-- Container principal -->
<section class="detail-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <!-- Bouton retour -->
                <a href="{{ url()->previous() }}" class="btn-retour" data-aos="fade-right">
                    <i class="bi bi-arrow-left"></i>
                    Retour
                </a>

                <!-- Card principale -->
                <div class="detail-card" data-aos="fade-up" data-aos-delay="200">
                    <!-- Section image -->
                    @if($page->hasMedia('image') || isset($page->image))
                        <div class="detail-image-section">
                            <div class="detail-image-container">
                                @if($page->hasMedia('image'))
                                    <img src="{{ $page->getFirstMediaUrl('image') }}" 
                                         alt="{{ $page->libelle }}"
                                         class="detail-image">
                                @elseif(isset($page->image))
                                    <img src="{{ asset('storage/' . $page->image) }}" 
                                         alt="{{ $page->libelle }}"
                                         class="detail-image">
                                @else
                                    <img src="https://via.placeholder.com/800x400/284093/ffffff?text=FOANI" 
                                         alt="Image par défaut FOANI"
                                         class="detail-image">
                                @endif
                                <div class="detail-image-overlay"></div>
                            </div>
                        </div>
                    @endif

                    <!-- Section contenu -->
                    <div class="detail-content-section">
                        <div class="detail-content">
                            @if($page->description)
                                {!! $page->description !!}
                            @else
                                <p>
                                    <strong>{{ $page->libelle }}</strong> fait partie intégrante de l'excellence FOANI. 
                                    Nous nous engageons à fournir des informations de qualité et des services 
                                    exceptionnels à nos clients et partenaires.
                                </p>
                                
                                <h2>Notre Engagement</h2>
                                <p>
                                    Chez FOANI, chaque détail compte. Notre approche professionnelle et notre 
                                    expertise nous permettent de maintenir les plus hauts standards de qualité 
                                    dans tout ce que nous entreprenons.
                                </p>

                                <h3>Points Clés</h3>
                                <ul>
                                    <li>Excellence dans l'industrie alimentaire</li>
                                    <li>Innovation continue et amélioration des processus</li>
                                    <li>Satisfaction client comme priorité absolue</li>
                                    <li>Développement durable et responsable</li>
                                </ul>

                                <blockquote>
                                    "Notre mission est de créer de la valeur durable pour nos clients tout en 
                                    respectant l'environnement et en soutenant les communautés locales."
                                </blockquote>
                            @endif
                        </div>

                        <!-- Section partage social -->
                        <div class="detail-share" data-aos="fade-up">
                            <h5>
                                <i class="bi bi-share"></i>
                                Partager cette page
                            </h5>
                            <div class="social-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                                   target="_blank" class="btn-social facebook" title="Partager sur Facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($page->libelle) }}" 
                                   target="_blank" class="btn-social twitter" title="Partager sur Twitter">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                                   target="_blank" class="btn-social linkedin" title="Partager sur LinkedIn">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($page->libelle . ' - ' . request()->fullUrl()) }}" 
                                   target="_blank" class="btn-social whatsapp" title="Partager sur WhatsApp">
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Progress bar de lecture
    function updateProgressBar() {
        const scrollTop = window.pageYOffset;
        const docHeight = document.body.offsetHeight - window.innerHeight;
        const scrollPercent = scrollTop / docHeight * 100;
        document.querySelector('.page-progress').style.width = scrollPercent + '%';
    }

    window.addEventListener('scroll', updateProgressBar);

    // Smooth scrolling pour les liens internes
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Animation au scroll pour le contenu
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });

    // Observer les éléments de contenu
    document.querySelectorAll('.detail-content > *').forEach((el) => {
        observer.observe(el);
    });
});
</script>
@endpush

@endsection