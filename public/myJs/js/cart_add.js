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
                Swal.fire({
                    icon: 'success',
                    title: 'Ajouté au panier !',
                    text: 'Le produit a bien été ajouté à votre panier.',
                    timer: 1800,
                    showConfirmButton: false
                });
                // Met à jour le badge panier
                $('.bi-cart').next('span.badge').text(response.count);
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
