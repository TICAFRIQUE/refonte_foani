{{-- filepath: c:\laragon\www\foani\resources\views\frontend\sections\valeurs.blade.php --}}
<style>
    /* Section principale des valeurs */
    .section-valeurs {
        background: linear-gradient(135deg, var(--color-vert), var(--color-vert2), var(--color-jaune));
        border-radius: 25px;
        padding: 60px 0;
        margin: 60px 0;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(42, 107, 42, 0.2);
    }

    .section-valeurs::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="valeurs-grid" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23valeurs-grid)"/></svg>');
        opacity: 0.3;
    }

    .section-valeurs .container {
        position: relative;
        z-index: 2;
    }

    /* Titre principal */
    .valeurs-section-title {
        font-size: 2.8rem;
        font-weight: 800;
        color: white;
        text-align: center;
        margin-bottom: 50px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        letter-spacing: -0.5px;
        text-transform: uppercase;
        position: relative;
    }

    .valeurs-section-title::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, var(--color-jaune), #f39c12);
        border-radius: 2px;
    }

    /* Cards des valeurs */
    .valeur-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 20px;
        padding: 25px;
        height: 100%;
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .valeur-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .valeur-card:hover::before {
        left: 100%;
    }

    .valeur-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 15px 35px rgba(42, 107, 42, 0.2);
    }

    .valeur-card .card-number {
        position: absolute;
        top: -10px;
        right: 15px;
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
        box-shadow: 0 4px 12px rgba(42, 107, 42, 0.3);
    }

    .valeur-card .card-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--color-jaune), #f39c12);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(241, 196, 15, 0.3);
    }

    .valeur-card .card-icon i {
        font-size: 1.8rem;
        color: #333;
    }

    .valeur-card h5 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--color-vert);
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .valeur-card p {
        color: #666;
        line-height: 1.6;
        margin: 0;
        font-size: 0.95rem;
    }

    .valeur-card a {
        color: var(--color-rouge);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .valeur-card a:hover {
        color: #c0392b;
        text-decoration: underline;
    }

    /* Section centrale avec image */
    .valeurs-center-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 30px 20px;
        text-align: center;
    }

    .valeurs-image-container {
        position: relative;
        margin-bottom: 30px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        backdrop-filter: blur(10px);
        border: 3px dashed rgba(255, 255, 255, 0.3);
        transition: all 0.4s ease;
    }

    .valeurs-image-container:hover {
        transform: rotate(5deg) scale(1.05);
        border-color: var(--color-jaune);
        background: rgba(255, 255, 255, 0.2);
    }

    .valeurs-image-container img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        transition: all 0.4s ease;
    }

    .valeurs-image-container:hover img {
        transform: scale(1.1);
    }

    /* Bouton de téléchargement */
    .btn-catalogue {
        background: linear-gradient(135deg, var(--color-jaune), #f39c12);
        border: none;
        color: #333;
        padding: 15px 30px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 6px 20px rgba(241, 196, 15, 0.4);
        position: relative;
        overflow: hidden;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-catalogue::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .btn-catalogue:hover::before {
        left: 100%;
    }

    .btn-catalogue:hover {
        background: linear-gradient(135deg, #f1c40f, #e67e22);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(241, 196, 15, 0.6);
        color: #333;
        text-decoration: none;
    }

    .btn-catalogue i {
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }

    .btn-catalogue:hover i {
        transform: scale(1.2) rotate(10deg);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .section-valeurs {
            padding: 40px 0;
            margin: 40px 0;
            border-radius: 20px;
        }

        .valeurs-section-title {
            font-size: 2.2rem;
            margin-bottom: 40px;
        }

        .valeur-card {
            margin-bottom: 20px;
            padding: 20px;
        }

        .valeurs-image-container img {
            width: 160px;
            height: 160px;
        }

        .btn-catalogue {
            padding: 12px 25px;
            font-size: 1rem;
        }
    }

    @media (max-width: 768px) {
        .section-valeurs {
            padding: 30px 0;
            margin: 30px 15px;
            border-radius: 15px;
        }

        .valeurs-section-title {
            font-size: 1.8rem;
            margin-bottom: 30px;
        }

        .valeur-card {
            padding: 18px;
            margin-bottom: 15px;
        }

        .valeur-card .card-icon {
            width: 50px;
            height: 50px;
            margin-bottom: 15px;
        }

        .valeur-card .card-icon i {
            font-size: 1.5rem;
        }

        .valeur-card h5 {
            font-size: 1.1rem;
        }

        .valeur-card p {
            font-size: 0.9rem;
        }

        .valeurs-center-section {
            padding: 20px 15px;
        }

        .valeurs-image-container {
            margin-bottom: 20px;
            padding: 15px;
        }

        .valeurs-image-container img {
            width: 140px;
            height: 140px;
        }

        .btn-catalogue {
            padding: 10px 20px;
            font-size: 0.9rem;
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .section-valeurs {
            margin: 20px 10px;
            padding: 25px 0;
        }

        .valeurs-section-title {
            font-size: 1.5rem;
            margin-bottom: 25px;
        }

        .valeur-card {
            padding: 15px;
        }

        .valeur-card .card-number {
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }

        .valeur-card h5 {
            font-size: 1rem;
        }

        .valeurs-image-container img {
            width: 120px;
            height: 120px;
        }
    }

    /* Animations */
    .section-valeurs {
        animation: fadeInUp 0.8s ease-out;
    }

    .valeur-card {
        animation: slideInUp 0.6s ease-out;
    }

    .valeur-card:nth-child(1) { animation-delay: 0.1s; }
    .valeur-card:nth-child(2) { animation-delay: 0.2s; }
    .valeur-card:nth-child(3) { animation-delay: 0.3s; }
    .valeur-card:nth-child(4) { animation-delay: 0.4s; }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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
</style>

<section class="section-valeurs">
    <div class="container">
        <h2 class="valeurs-section-title">Le vrai goût du poulet !</h2>
        
        <div class="row align-items-stretch g-4">
            {{-- Colonne gauche --}}
            <div class="col-lg-4 col-md-6">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card valeur-card">
                            <div class="card-number">1</div>
                            <div class="card-icon">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <h5>Plus de 250 Employés</h5>
                            <p>FOANI participe activement à l'emploi des jeunes à travers des emplois permanents et temporaires.</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card valeur-card">
                            <div class="card-number">2</div>
                            <div class="card-icon">
                                <i class="bi bi-shop"></i>
                            </div>
                            <h5>Plus de 60 Points de vente</h5>
                            <p>FOANI se rapproche des consommateurs à travers des boutiques de proximité à Abidjan et à l'intérieur du pays.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Colonne centrale --}}
            <div class="col-lg-4 col-md-12">
                <div class="valeurs-center-section">
                    <div class="valeurs-image-container">
                        <img src="{{ asset('front/images/produits/poulet.png') }}" 
                             alt="Poulet FOANI de qualité premium" 
                             class="img-fluid">
                    </div>
                    <a href="/catalogue.pdf" class="btn btn-catalogue" target="_blank">
                        <i class="bi bi-download"></i>
                        Télécharger notre catalogue
                    </a>
                </div>
            </div>

            {{-- Colonne droite --}}
            <div class="col-lg-4 col-md-6">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card valeur-card">
                            <div class="card-number">3</div>
                            <div class="card-icon">
                                <i class="bi bi-heart-fill"></i>
                            </div>
                            <h5>Plus d'une centaine de milliers de clients</h5>
                            <p>Ils sont des milliers à nous suivre.<br>
                                Rejoignez la grande famille FOANI en 
                                <a href="https://web.facebook.com/foaniservices/" target="_blank">cliquant ici</a>.
                            </p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card valeur-card">
                            <div class="card-number">4</div>
                            <div class="card-icon">
                                <i class="bi bi-basket-fill"></i>
                            </div>
                            <h5>Produits pour tous</h5>
                            <p>FOANI met à votre disposition divers produits autant pour la production que pour la consommation de la volaille.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>