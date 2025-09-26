<style>
    .section-valeurs {
        /* background: url("{{ asset('front/images/backgrounds/55221.webp') }}") ;
        background-size: cover; */
        background: linear-gradient(135deg, var(--color-vert), var(--color-jaune), var(--color-rouge));
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .carte .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 50px;
    }

    .carte .card:hover {
        transform: translateY(-5px);
    }

    .valeur {
        background: linear-gradient(135deg, var(--color-vert-clair), var(--color-jaune-clair));
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-image img {
        overflow: hidden;
        border: 4px dashed var(--color-vert);
        border-radius: 1200px;
    }
</style>



<section class="container my-5 section-valeurs">
    <h2 class="text-center fw-bold text-white text-uppercase mb-4" >Le vrai goût du poulet !</h2>
    <div class="row align-items-center">
        <div class="col-lg-4 col-md-6 mb-4 carte">
            <div class=" card p-4 h-100 valeur1">
                <strong class="d-block mb-2">Plus de 500 Employés</strong>
                <p class="mb-0">FOANI participe activement à l’emploi des jeunes à travers des emplois permanents et
                    temporaires.</p>
            </div>
            <div class="card p-4  shadow-sm mt-4 h-100 valeur2">
                <strong class="d-block mb-2">Plus de 60 Points de vente</strong>
                <p class="mb-0">FOANI se rapproche des consommateurs à travers des boutiques de proximité à Abidjan et
                    à l’intérieur du pays.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 mb-4 text-center">
            <div class="card-image mb-4">
                <img src="{{ asset('front/images/produits/poulet.png') }}" alt="Notre Boutique" class="img-fluid"
                    style="max-height: 320px; object-fit: cover;">
            </div>
            <a href="/catalogue.pdf" class="btn btn-cta btn-lg rounded-pill mt-2" target="_blank">
                <i class="bi bi-download me-2"></i>Télécharger notre catalogue
            </a>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 carte">
            <div class="card p-4  shadow-sm h-100 valeur3">
                <strong class="d-block mb-2">Plus d'une centaine de milliers de
                    clients</strong>
                <p class="mb-0">Ils sont des milliers à nous suivre.<br>
                    Rejoignez la grande famille FOANI en <a href="https://web.facebook.com/foaniservices/"
                        target="_blank" style="color: var(--color-rouge); text-decoration: underline;">cliquant ici</a>.
                </p>
            </div>
            <div class="card p-4  shadow-sm mt-4 h-100 valeur4 ">
                <strong class="d-block mb-2">Produits pour tous</strong>
                <p class="mb-0">FOANI met à votre disposition divers produits autant pour la production que pour la
                    consommation de la volaille.</p>
            </div>
        </div>
    </div>
</section>
