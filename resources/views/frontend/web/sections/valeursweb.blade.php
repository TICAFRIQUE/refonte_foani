{{-- filepath: c:\laragon\www\foani\resources\views\frontend\web\sections\valeursweb.blade.php --}}
@push('styles')
<style>
    .values-section {
        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 50%, #f0f2ff 100%);
        position: relative;
        overflow: hidden;
    }

    .values-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800"><circle cx="200" cy="150" r="80" fill="rgba(40,64,147,0.03)"/><circle cx="1000" cy="600" r="120" fill="rgba(108,122,224,0.02)"/><circle cx="800" cy="100" r="60" fill="rgba(63,94,184,0.04)"/><circle cx="300" cy="700" r="90" fill="rgba(40,64,147,0.02)"/></svg>') no-repeat;
        background-size: cover;
        pointer-events: none;
    }

    .value-card {
        background: white;
        border-radius: 25px;
        padding: 45px 35px;
        text-align: center;
        box-shadow: 0 15px 50px rgba(40, 64, 147, 0.08);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(40, 64, 147, 0.05);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .value-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .value-card:hover {
        transform: translateY(-20px) scale(1.02);
        box-shadow: 0 30px 80px rgba(40, 64, 147, 0.15);
        border-color: rgba(40, 64, 147, 0.1);
    }

    .value-card:hover::before {
        transform: scaleX(1);
    }

    .value-icon {
        width: 90px;
        height: 90px;
        background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        color: white;
        font-size: 2.2rem;
        box-shadow: 0 12px 35px rgba(40, 64, 147, 0.25);
        transition: all 0.4s ease;
        position: relative;
    }

    .value-icon::after {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        border-radius: 50%;
        border: 2px solid rgba(40, 64, 147, 0.2);
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.4s ease;
    }

    .value-card:hover .value-icon {
        transform: scale(1.15) rotate(15deg);
        box-shadow: 0 20px 50px rgba(40, 64, 147, 0.4);
    }

    .value-card:hover .value-icon::after {
        opacity: 1;
        transform: scale(1);
    }

    .value-card h4 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-primary);
        margin-bottom: 20px;
        position: relative;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .value-card h4::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
        transition: width 0.4s ease;
    }

    .value-card:hover h4::after {
        width: 60px;
    }

    .value-card p {
        color: #666;
        font-size: 1rem;
        line-height: 1.6;
        margin: 0;
        font-weight: 400;
    }

    /* Styles spécifiques pour chaque valeur */
    .value-card.perseverance {
        background: linear-gradient(135deg, #fff 0%, #f8f9ff 100%);
    }

    .value-card.perseverance .value-icon {
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
    }

    .value-card.professionnalisme {
        background: linear-gradient(135deg, #fff 0%, #f0f8ff 100%);
    }

    .value-card.professionnalisme .value-icon {
        background: linear-gradient(135deg, #4ecdc4, #44a08d);
    }

    .value-card.integrite {
        background: linear-gradient(135deg, #fff 0%, #fff8f0 100%);
    }

    .value-card.integrite .value-icon {
        background: linear-gradient(135deg, #ffa726, #ff9800);
    }

    .value-card.satisfaction {
        background: linear-gradient(135deg, #fff 0%, #f0fff8 100%);
    }

    .value-card.satisfaction .value-icon {
        background: linear-gradient(135deg, #66bb6a, #4caf50);
    }

    /* Animation pour les icônes */
    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-10px) rotate(5deg);
        }
    }

    .value-card:hover .value-icon {
        animation: float 3s ease-in-out infinite;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .value-card {
            padding: 35px 25px;
            margin-bottom: 25px;
        }

        .value-icon {
            width: 75px;
            height: 75px;
            font-size: 1.8rem;
            margin-bottom: 25px;
        }

        .value-card h4 {
            font-size: 1.3rem;
            margin-bottom: 15px;
        }

        .value-card p {
            font-size: 0.95rem;
        }
    }

    @media (max-width: 576px) {
        .value-card {
            padding: 30px 20px;
        }

        .value-icon {
            width: 65px;
            height: 65px;
            font-size: 1.6rem;
        }

        .value-card h4 {
            font-size: 1.2rem;
        }
    }

    /* STATISTIQUES */
    .stats-section {
        background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
        color: white;
        position: relative;
        overflow: hidden;
    }

    .stats-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 400"><path d="M0,200 Q300,50 600,200 T1200,200 V400 H0 Z" fill="rgba(255,255,255,0.05)"/></svg>') no-repeat bottom;
        background-size: cover;
        pointer-events: none;
    }

    .stat-item {
        text-align: center;
        padding: 40px 20px;
        position: relative;
    }

    .stat-number {
        font-size: 4rem;
        font-weight: 900;
        margin-bottom: 15px;
        color: white;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        line-height: 1;
    }

    .stat-label {
        font-size: 1.1rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .stat-item::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 2px;
    }

    @media (max-width: 768px) {
        .stat-number {
            font-size: 3rem;
        }

        .stat-item {
            padding: 30px 15px;
        }
    }
</style>
@endpush

<section id="values" class="section values-section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Nos Valeurs</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            Des principes fondamentaux qui guident notre excellence quotidienne et notre engagement envers nos clients
        </p>

        <div class="row g-4">
            <!-- PERSÉVÉRANCE ET PASSION -->
            <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="value-card perseverance">
                    <div class="value-icon">
                        <i class="bi bi-fire"></i>
                    </div>
                    <h4>Persévérance & Passion</h4>
                    <p>Notre détermination inébranlable et notre passion pour l'excellence nous poussent à surmonter 
                       tous les défis. Chaque jour, nous mettons notre cœur dans tout ce que nous entreprenons pour 
                       offrir des produits d'exception.</p>
                </div>
            </div>

            <!-- PROFESSIONNALISME ET RIGUEUR -->
            <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card professionnalisme">
                    <div class="value-icon">
                        <i class="bi bi-gear-fill"></i>
                    </div>
                    <h4>Professionnalisme & Rigueur</h4>
                    <p>Notre approche méthodique et notre expertise reconnue garantissent des standards de qualité 
                       irréprochables. Nous appliquons des processus rigoureux à chaque étape de notre production 
                       pour assurer l'excellence.</p>
                </div>
            </div>

            <!-- INTÉGRITÉ -->
            <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="value-card integrite">
                    <div class="value-icon">
                        <i class="bi bi-shield-fill-check"></i>
                    </div>
                    <h4>Intégrité</h4>
                    <p>L'honnêteté et la transparence sont les piliers de notre relation avec nos clients et partenaires. 
                       Nous agissons avec éthique et respectons nos engagements en toutes circonstances, bâtissant 
                       ainsi une confiance durable.</p>
                </div>
            </div>

            <!-- SATISFACTION TOTALE DES CLIENTS -->
            <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="value-card satisfaction">
                    <div class="value-icon">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <h4>Satisfaction Totale des Clients</h4>
                    <p>Le bonheur de nos clients est notre priorité absolue. Nous nous efforçons de dépasser leurs 
                       attentes à travers un service personnalisé, des produits de qualité supérieure et un 
                       accompagnement sur mesure.</p>
                </div>
            </div>
        </div>
    </div>
</section>

