@push('styles')
    <style>
        /* Style du bouton flottant */
       
    </style>
@endpush

<!-- Bouton remonter en haut, WhatsApp & Panier flottant -->
<a href="#" id="btnScrollTop" class="btn btn-primary rounded-circle shadow position-fixed"
    style="bottom: 140px; right: 25px; z-index: 999; width: 48px; height: 48px; display: none; background-color: #2c4099;">
    <i class="bi bi-arrow-up fs-4"></i>
</a>
{{-- <a href="https://wa.me/225{{ $data_parametre?->contact2 }}?text=Bonjour%20je%20veux%20commander%20un%20de%20vos%20produits"
    target="_blank" id="btnWhatsapp" class="btn btn-success rounded-circle shadow position-fixed"
    style="bottom: 80px; right: 25px; z-index: 999; width: 48px; height: 48px;">
    <i class="bi bi-whatsapp fs-3"></i>
</a> --}}


<script>
    // Bouton remonter en haut
    const btnScrollTop = document.getElementById('btnScrollTop');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 200) {
            btnScrollTop.style.display = 'flex';
        } else {
            btnScrollTop.style.display = 'none';
        }
    });
    btnScrollTop.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
