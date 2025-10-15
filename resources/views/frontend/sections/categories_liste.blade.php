{{-- filepath: resources/views/frontend/sections/categories_produits.blade.php --}}


<section class="container mb-5">
    <h2 class="text-center mb-4 fw-bold" style="color:#2a6b2a;">Nos Catégories</h2>
    <div id="categoriesCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($categories->chunk(4) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                    <div class="row justify-content-center g-4">
                        @foreach($chunk as $categorie)
                            <div class="col-6 col-md-3">
                                <div class="card text-center p-3 shadow-sm border-0 category-card">
                                    <a href="{{ route('boutique.categorie', ['slug' => $categorie->slug]) }}" class="text-decoration-none text-dark">
                                        <img src="{{ $categorie->getFirstMediaUrl('image') ?: asset('front/images/logo.png') }}"
                                            class="rounded-circle mb-2"
                                            style="width:120px;height:120px;object-fit:cover;margin:0 auto;"
                                            alt="{{ $categorie->libelle }}">
                                        <h5 class="fw-bold">{{ $categorie->libelle }}</h5>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
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
