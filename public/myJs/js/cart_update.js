
$(function() {

    // Modifier la quantité
    $('.form-update-panier').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var produitId = form.data('id');
        var quantite = form.find('input[name="quantite"]').val();

        $.ajax({
            url: "{{ route('panier.update', ':id') }}".replace(':id', produitId),
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                quantite: quantite
            },
            success: function(response) {
                alert('Quantité mise à jour !');
                // Recharger le contenu du panier si affiché
                // loadPanierContent();
            },
            error: function() {
                alert('Erreur lors de la modification.');
            }
        });
    });


});
