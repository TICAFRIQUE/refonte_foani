    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
    </style>



    <section class="container mb-5">
        <h2 class="text-center mb-4 fw-bold" style="color: var(--color-jaune);">Nos Points de Vente</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: var(--color-vert);"></i>
                        <h5 class="card-title">Marché Central, Paris</h5>
                        <p class="card-text">Votre destination pour des produits frais et locaux.</p>
                        <a href="#" class="btn btn-cta">Découvrir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: var(--color-rouge);"></i>
                        <h5 class="card-title">Boutique Foani, Lyon</h5>
                        <p class="card-text">Découvrez notre gamme de produits de qualité.</p>
                        <a href="#" class="btn btn-cta">Découvrir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: var(--color-jaune);"></i>
                        <h5 class="card-title">Ferme du Sud, Marseille</h5>
                        <p class="card-text">Des produits fermiers directement de notre ferme.</p>
                        <a href="#" class="btn btn-cta">Découvrir</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
