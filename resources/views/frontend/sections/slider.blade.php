{{-- filepath: resources/views/frontend/sections/slider.blade.php --}}
<style>
.main-slider-caption-right {
    right: 0;
    left: auto;
    top: 0;
    width: 45%; /* moins large */
    height: 100%;
    padding: 2rem 2.5rem 2rem 2rem; /* padding droit augmenté */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-end;
    text-align: right;
    background: rgba(42, 107, 42, 0.15);
}
.owl-carousel .item {
    position: relative;
    height: 350px;
}
.owl-carousel .item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
}
@media (max-width: 767px) {
    .main-slider-caption-right {
        left: 0 !important;
        right: 0 !important;
        width: 100% !important;
        padding: 1rem !important;
        text-align: center !important;
        align-items: center !important;
        justify-content: flex-end !important;
        background: rgba(42, 107, 42, 0.25);
        border-radius: 0 0 16px 16px;
    }
    .main-slider-caption-right h1 { font-size: 1.3rem; }
    .main-slider-caption-right p { font-size: 1rem; }
    .main-slider-caption-right .btn { font-size: 1rem; padding: 0.5rem 1.2rem; }
    .owl-carousel .item { height: 180px; }
}
</style>

<section class="mb-2">
    <div class="owl-carousel owl-theme" id="mainSliderOwl">
        <!-- Slide 1 -->
        <div class="item">
            <img src="{{ asset('front/images/sliders/13.jpg') }}" class="img-fluid" alt="Volaille Fraîche & Locale">
            <div class="main-slider-caption-right d-flex flex-column justify-content-center align-items-end text-end p-4 position-absolute top-0 end-0 h-100 w-100">
                <h1 class="display-5 fw-bold text-white">Poulet de Chair</h1>
                <p class="text-white">Le vrai goût du poulet</p>
                <a href="#" class="btn btn-cta btn-lg mt-3">Commander</a>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="item">
            <img src="{{ asset('front/images/sliders/10.jpg') }}" class="img-fluid" alt="Œufs Fermiers">
            <div class="main-slider-caption-right d-flex flex-column justify-content-center align-items-start text-start p-4 position-absolute top-0 start-0 h-100 w-100">
                <h1 class="display-5 fw-bold text-white">Œufs Fermiers</h1>
                <p class="text-white">Des œufs frais et savoureux issus de poules heureuses</p>
                <a href="#" class="btn btn-cta btn-lg mt-3">Commander</a>
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="item">
            <img src="{{ asset('front/images/sliders/11.jpg') }}" class="img-fluid" alt="Produits Transformés">
            <div class="main-slider-caption-right d-flex flex-column justify-content-center align-items-start text-start p-4 position-absolute top-0 start-0 h-100 w-100">
                <h1 class="display-5 fw-bold text-white">Produits Transformés</h1>
                <p class="text-white">Découvrez notre gamme de produits dérivés</p>
                <a href="#" class="btn btn-cta btn-lg mt-3">Commander</a>
            </div>
        </div>
    </div>
</section>

@push('scripts')

<!-- OwlCarousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- Animate.css CDN (si pas déjà inclus) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<script>
$(document).ready(function(){
    const animations = [
        "animate__fadeInDown",
        "animate__fadeInUp",
        "animate__fadeInLeft",
        "animate__fadeInRight",
        "animate__zoomIn",
        "animate__lightSpeedInRight",
        "animate__bounceIn",
        "animate__jackInTheBox",
        "animate__rollIn",
        "animate__flipInX"
    ];

    function applyAnimations(slide) {
        const elements = slide.find("h1, p, a");
        elements.each(function(index, el){
            $(el).removeClass("animate__animated " + animations.join(' '));
            void el.offsetWidth; // force reflow
            const randomAnim = animations[Math.floor(Math.random() * animations.length)];
            $(el).addClass("animate__animated " + randomAnim);
        });
    }

    const slider = $("#mainSliderOwl");

    slider.owlCarousel({
        items: 1,
        loop: true,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        animateOut: 'fadeOut'
    });

    // Appliquer animations sur le premier slide
    applyAnimations(slider.find(".owl-item.active"));

    slider.on("changed.owl.carousel", function(event){
        const currentItem = $(event.target).find(".owl-item").eq(event.item.index);
        applyAnimations(currentItem);
    });
});
</script>
@endpush
