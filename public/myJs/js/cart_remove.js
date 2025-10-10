
$(function() {

    // Supprimer du panier
    $('.btn-remove-panier').on('click', function(e) {
        e.preventDefault();
        var produitId = $(this).data('id');
        var btn = $(this);

        if(confirm('Retirer ce produit du panier ?')) {
            $.ajax({
                url: "{{ route('panier.remove', ':id') }}".replace(':id', produitId),
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert('Produit retiré du panier !');
                    // Recharger le contenu du panier si affiché
                    // loadPanierContent();
                },
                error: function() {
                    alert('Erreur lors de la suppression.');
                }
            });
        }
    });

    // Fonction pour recharger le contenu du panier (optionnel)
    // function loadPanierContent() {
    //     $.get("{{ route('panier.content') }}", function(html) {
    //         $('#panier-content').html(html);
    //     });
    // }
});
