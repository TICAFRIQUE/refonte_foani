// Ajout au panier (boutons .btn-ajouter-panier data-id="...")
$(function() {
    $(document).on('click', '.btn-ajouter-panier', function(e) {
        e.preventDefault();
        var btn = $(this);
        if (btn.prop('disabled')) return;

        var produitId = btn.data('id');
        var card = btn.closest('.pcard, .offer-card, .card');
        var nom = $.trim(card.find('.pcard__title, .offer-card__title, .card-title, h3, h2').first().text()) || 'Produit';
        var image = card.find('img').first().attr('src');
        var original = btn.html();

        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Ajout…');

        $.ajax({
            url: "/panier/add/" + produitId,
            type: "POST",
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                // Retour visuel sur le bouton
                btn.addClass('is-added').html('<i class="bi bi-check2-circle"></i> Ajouté');
                setTimeout(function() {
                    btn.removeClass('is-added').html(original).prop('disabled', false);
                }, 1600);

                // Compteurs du panier
                if (typeof updateCartBadges === 'function') {
                    updateCartBadges(response.count);
                } else {
                    $('[data-cart-count], #cart-badge-bottom, #cart-badge-mobile').text(response.count);
                }

                var texte = nom + (response.quantite > 1 ? ' (× ' + response.quantite + ' dans votre panier)' : '');
                if (window.FoaniToast) {
                    FoaniToast.success('Ajouté au panier', texte, {
                        image: image,
                        actions: [
                            { label: 'Voir mon panier', href: '/panier' },
                            { label: 'Continuer', href: '#', ghost: true }
                        ]
                    });
                }
            },
            error: function(xhr) {
                btn.html(original).prop('disabled', false);
                var message = (xhr.responseJSON && xhr.responseJSON.message) ||
                    "Impossible d'ajouter ce produit pour le moment. Vérifiez votre connexion et réessayez.";
                if (xhr.status === 419) {
                    message = 'Votre session a expiré. Rechargez la page puis réessayez.';
                }
                if (window.FoaniToast) {
                    FoaniToast.error('Ajout impossible', message);
                } else if (window.Swal) {
                    Swal.fire({ icon: 'error', title: 'Erreur', text: message });
                }
            }
        });
    });

    // Le bouton « Continuer » d'une notification la ferme simplement
    $(document).on('click', '.ftoast__actions a[href="#"]', function(e) {
        e.preventDefault();
        $(this).closest('.ftoast').find('.ftoast__close').trigger('click');
    });
});
