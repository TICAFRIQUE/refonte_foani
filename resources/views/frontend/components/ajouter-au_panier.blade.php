<script>
$(function() {
    // Ajouter au panier
    $('.btn-ajouter-panier').on('click', function(e) {
        e.preventDefault();
        var produitId = $(this).data('id');
        var btn = $(this);

        btn.prop('disabled', true);

        $.ajax({
            url: "{{ route('panier.add', ':id') }}".replace(':id', produitId),
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                btn.prop('disabled', false);
                alert('Produit ajouté au panier !');
                // Mettre à jour le compteur panier si besoin
                // $('#panier-count').text(response.count);
                // Recharger le contenu du panier si affiché
                // loadPanierContent();
            },
            error: function() {
                btn.prop('disabled', false);
                alert('Erreur lors de l’ajout au panier.');
            }
        });
    });

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
</script>