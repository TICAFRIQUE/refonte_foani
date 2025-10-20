$(function() {
    // Ajouter au panier
    $('.btn-ajouter-panier').on('click', function(e) {
        e.preventDefault();
        var produitId = $(this).data('id');
        var btn = $(this);
        btn.prop('disabled', true);

        $.ajax({
            url: "/panier/add/" + produitId,
            type: "POST",
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                btn.prop('disabled', false);

                // Affiche une alerte verte en haut de la page
                let alert = $(`
                    <div class="alert alert-success alert-dismissible fade show position-fixed w-100 text-center" 
                         style="top: 0; left: 0; z-index: 2000;">
                        <strong>Ajouté au panier !</strong> Le produit a bien été ajouté à votre panier.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                `);
                $('body').append(alert);
                setTimeout(function() {
                    alert.fadeOut(500, function() { $(this).remove(); });
                }, 2000);

                // Met à jour le badge panier
                $('.bi-cart').next('span.badge').text(response.count);
                $('#cart-badge-bottom').text(response.count);
                $('#cart-badge-mobile').text(response.count);
            },
            error: function() {
                btn.prop('disabled', false);
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Une erreur est survenue lors de l’ajout au panier.'
                });
            }
        });
    });

    // Fonction pour recharger le contenu du panier (optionnel)
    // function loadPanierContent() {
    //     $.get("/panier/content", function(html) {
    //         $('#panier-content').html(html);
    //     });
    // }
});
