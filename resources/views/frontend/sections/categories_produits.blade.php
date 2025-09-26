    <section class="container mb-5">
        <h2 class="text-center mb-4 fw-bold" style="color:#2a6b2a;">Nos Catégories</h2>
        <div id="categoriesCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <!-- Premier slide -->
                <div class="carousel-item active">
                    <div class="row justify-content-center g-4">
                        <div class="col-6 col-md-3">
                            <div class="card text-center p-3 shadow-sm border-0 category-card">
                                <img src="{{ asset('front/images/categories/pouletchair.png') }}"
                                    class="rounded-circle mb-2"
                                    style="width:120px;height:120px;object-fit:cover;margin:0 auto;"
                                    alt="Poulet de Chair">
                                <h5 class="fw-bold">Poulet de Chair</h5>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card text-center p-3 shadow-sm border-0 category-card">
                                <img src="{{ asset('front/images/categories/pondeuse.png') }}"
                                    class="rounded-circle mb-2"
                                    style="width:120px;height:120px;object-fit:cover;margin:0 auto;" alt="Pondeuses">
                                <h5 class="fw-bold">Pondeuses</h5>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card text-center p-3 shadow-sm border-0 category-card">
                                <img src="{{ asset('front/images/categories/decoupe.png') }}"
                                    class="rounded-circle mb-2"
                                    style="width:120px;height:120px;object-fit:cover;margin:0 auto;" alt="Découpes">
                                <h5 class="fw-bold">Découpes</h5>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card text-center p-3 shadow-sm border-0 category-card">
                                <img src="{{ asset('front/images/categories/oeuf.png') }}"
                                    class="rounded-circle mb-2"
                                    style="width:120px;height:120px;object-fit:cover;margin:0 auto;" alt="Oeufs">
                                <h5 class="fw-bold">Œufs</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deuxième slide -->
                <div class="carousel-item">
                    <div class="row justify-content-center g-4">
                        <div class="col-6 col-md-3">
                            <div class="card text-center p-3 shadow-sm border-0 category-card">
                                <img src="{{ asset('front/images/categories/abat.png') }}"
                                    class="rounded-circle mb-2"
                                    style="width:120px;height:120px;object-fit:cover;margin:0 auto;" alt="Abats">
                                <h5 class="fw-bold">Abats</h5>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card text-center p-3 shadow-sm border-0 category-card">
                                <img src="{{ asset('front/images/categories/crika.png') }}"
                                    class="rounded-circle mb-2"
                                    style="width:120px;height:120px;object-fit:cover;margin:0 auto;"
                                    alt="Poulet Crika">
                                <h5 class="fw-bold">Poulet Crika</h5>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card text-center p-3 shadow-sm border-0 category-card">
                                <img src="{{ asset('front/images/categories/epice.png') }}"
                                    class="rounded-circle mb-2"
                                    style="width:120px;height:120px;object-fit:cover;margin:0 auto;" alt="Épices">
                                <h5 class="fw-bold">Épices</h5>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card text-center p-3 shadow-sm border-0 category-card">
                                <img src="{{ asset('front/images/categories/poussins.png') }}"
                                    class="rounded-circle mb-2"
                                    style="width:120px;height:120px;object-fit:cover;margin:0 auto;" alt="Poussins">
                                <h5 class="fw-bold">Poussins</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contrôles -->
            <button class="carousel-control-prev" type="button" data-bs-target="#categoriesCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" style="filter:invert(1);"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#categoriesCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" style="filter:invert(1);"></span>
            </button>
        </div>
    </section>



    <!-- Section Volaille -->
    <section class="container mb-3 bg-white p-3" >
        <a href="categorie-2" class="text-decoration-none">
            <div class="text-center">
                <h3 class="fw-bold" style="color: var(--color-vert);">POULET DE CHAIR</h3>
                <img src="{{ asset('front/images/categories/pouletchair.png') }}" alt="PONDEUSES" width="10%"
                    class="mb-3">
            </div>
        </a>
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="card product-card shadow-sm">
                    <img src="{{ asset('front/images/produits/poulet.png') }}" class="card-img-top"
                        alt="Poulet fermier">
                    <div class="card-body text-center">
                        <h5 class="card-title">PONDEUSE 1KG/1.1KG </h5>
                        <p class="card-text fw-bold" style="color:var(--color-vert);">3000 FCFA</p>
                        <button class="btn btn-add w-100"><i class="bi bi-cart-plus me-2"></i>Ajouter </button>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card product-card shadow-sm">
                    <img src="{{ asset('front/images/produits/poulet2.png') }}" class="card-img-top"
                        alt="Poulet découpé">
                    <div class="card-body text-center">
                        <h5 class="card-title">Poulet découpé</h5>
                        <p class="card-text fw-bold" style="color:var(--color-rouge);">7,90 €</p>
                        <button class="btn btn-add w-100"><i class="bi bi-cart-plus me-2"></i>Ajouter </button>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card product-card shadow-sm">
                    <img src="{{ asset('front/images/produits/poulet3.png') }}" class="card-img-top"
                        alt="Cuisse de poulet">
                    <div class="card-body text-center">
                        <h5 class="card-title">Cuisse de poulet</h5>
                        <p class="card-text fw-bold" style="color:var(--color-jaune);">4,50 €</p>
                        <button class="btn btn-add w-100"><i class="bi bi-cart-plus me-2"></i>Ajouter au
                            panier</button>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card product-card shadow-sm">
                    <img src="{{ asset('front/images/produits/ail.png') }}" class="card-img-top"
                        alt="Ailes de poulet">
                    <div class="card-body text-center">
                        <h5 class="card-title">Ailes de poulet</h5>
                        <p class="card-text fw-bold" style="color:var(--color-vert);">3,90 €</p>
                        <button class="btn btn-add w-100"><i class="bi bi-cart-plus me-2"></i>Ajouter au
                            panier</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="#" class="btn btn-cta">Tout voir Volaille</a>
        </div>
    </section>

    
   <!-- Section Volaille -->
    <section class="container mb-5 bg-white p-3" >
        <a href="categorie-2" class="text-decoration-none">
            <div class="text-center">
                <h3 class="fw-bold" style="color: var(--color-vert);">CRIKA</h3>
                <img src="{{ asset('front/images/categories/crika.png') }}" alt="PONDEUSES" width="10%"
                    class="mb-3">
            </div>
        </a>
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="card product-card shadow-sm">
                    <img src="{{ asset('front/images/produits/poulet.png') }}" class="card-img-top"
                        alt="Poulet fermier">
                    <div class="card-body text-center">
                        <h5 class="card-title">PONDEUSE 1KG/1.1KG </h5>
                        <p class="card-text fw-bold" style="color:var(--color-vert);">3000 FCFA</p>
                        <button class="btn btn-add w-100"><i class="bi bi-cart-plus me-2"></i>Ajouter </button>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card product-card shadow-sm">
                    <img src="{{ asset('front/images/produits/poulet2.png') }}" class="card-img-top"
                        alt="Poulet découpé">
                    <div class="card-body text-center">
                        <h5 class="card-title">Poulet découpé</h5>
                        <p class="card-text fw-bold" style="color:var(--color-rouge);">7,90 €</p>
                        <button class="btn btn-add w-100"><i class="bi bi-cart-plus me-2"></i>Ajouter </button>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card product-card shadow-sm">
                    <img src="{{ asset('front/images/produits/poulet3.png') }}" class="card-img-top"
                        alt="Cuisse de poulet">
                    <div class="card-body text-center">
                        <h5 class="card-title">Cuisse de poulet</h5>
                        <p class="card-text fw-bold" style="color:var(--color-jaune);">4,50 €</p>
                        <button class="btn btn-add w-100"><i class="bi bi-cart-plus me-2"></i>Ajouter au
                            panier</button>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card product-card shadow-sm">
                    <img src="{{ asset('front/images/produits/ail.png') }}" class="card-img-top"
                        alt="Ailes de poulet">
                    <div class="card-body text-center">
                        <h5 class="card-title">Ailes de poulet</h5>
                        <p class="card-text fw-bold" style="color:var(--color-vert);">3,90 €</p>
                        <button class="btn btn-add w-100"><i class="bi bi-cart-plus me-2"></i>Ajouter au
                            panier</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="#" class="btn btn-cta">Tout voir Volaille</a>
        </div>
    </section>


     <!-- Section Volaille -->
    <section class="container mb-5 bg-white p-3" >
        <a href="categorie-2" class="text-decoration-none">
            <div class="text-center">
                <h3 class="fw-bold" style="color: var(--color-vert);">Epices</h3>
                <img src="{{ asset('front/images/categories/epice.png') }}" alt="PONDEUSES" width="10%"
                    class="mb-3">
            </div>
        </a>
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="card product-card shadow-sm">
                    <img src="{{ asset('front/images/produits/poulet.png') }}" class="card-img-top"
                        alt="Poulet fermier">
                    <div class="card-body text-center">
                        <h5 class="card-title">PONDEUSE 1KG/1.1KG </h5>
                        <p class="card-text fw-bold" style="color:var(--color-vert);">3000 FCFA</p>
                        <button class="btn btn-add w-100"><i class="bi bi-cart-plus me-2"></i>Ajouter </button>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card product-card shadow-sm">
                    <img src="{{ asset('front/images/produits/poulet2.png') }}" class="card-img-top"
                        alt="Poulet découpé">
                    <div class="card-body text-center">
                        <h5 class="card-title">Poulet découpé</h5>
                        <p class="card-text fw-bold" style="color:var(--color-rouge);">7,90 €</p>
                        <button class="btn btn-add w-100"><i class="bi bi-cart-plus me-2"></i>Ajouter </button>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card product-card shadow-sm">
                    <img src="{{ asset('front/images/produits/poulet3.png') }}" class="card-img-top"
                        alt="Cuisse de poulet">
                    <div class="card-body text-center">
                        <h5 class="card-title">Cuisse de poulet</h5>
                        <p class="card-text fw-bold" style="color:var(--color-jaune);">4,50 €</p>
                        <button class="btn btn-add w-100"><i class="bi bi-cart-plus me-2"></i>Ajouter au
                            panier</button>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card product-card shadow-sm">
                    <img src="{{ asset('front/images/produits/ail.png') }}" class="card-img-top"
                        alt="Ailes de poulet">
                    <div class="card-body text-center">
                        <h5 class="card-title">Ailes de poulet</h5>
                        <p class="card-text fw-bold" style="color:var(--color-vert);">3,90 €</p>
                        <button class="btn btn-add w-100"><i class="bi bi-cart-plus me-2"></i>Ajouter au
                            panier</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="#" class="btn btn-cta">Tout voir Volaille</a>
        </div>
    </section>