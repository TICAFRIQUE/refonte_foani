@extends('frontend.layouts.app')

@section('title', 'Mon Panier')

@section('content')
    <div class="container py-5">
        <h2 class="fw-bold mb-4 text-center" style="color: #559e33;">Mon Panier</h2>
        <!-- Afficher un message de session -->
        @include('frontend.components.message_session')
        <div class="col-lg-10 mx-auto alert alert-info alert-dismissible fade show d-none" role="alert" id="alertPanier">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Votre commande doit être egale ou superieur à <strong>10 000 FCFA</strong> avant de pouvoir la valider.
        </div>



        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div id="panier-content">
                    @if (empty($panier))
                        <div class="alert alert-info text-center">
                            Votre panier est vide.
                        </div>
                        <div class="text-center">
                            <a href="{{ route('boutique.index') }}" class="btn btn-success px-5 fw-bold">
                                <i class="bi bi-cart-plus"></i> Continuer mes achats
                            </a>
                        </div>
                    @else
                        <div class="table-responsive mb-4">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>Produit</th>
                                        <th class="text-center">Pu</th>
                                        <th class="text-center">Qté</th>
                                        <th class="text-center">Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @foreach ($panier as $item)
                                        <tr data-id="{{ $item->id }}">
                                            <td>
                                                <img src="{{ $item->getFirstMediaUrl('image_principale') ?: asset('front/images/produits/poulet.png') }}"
                                                    alt="{{ $item->libelle }}" class="rounded"
                                                    style="width:60px; height:60px; object-fit:cover;">
                                            </td>
                                            <td>
                                                <span class="fw-bold">{{ $item->libelle }}</span>
                                                <div class="text-muted small text-lowercase " style="font-size: 13px">
                                                    {{ $item->categorie->libelle ?? '' }}</div>
                                            </td>
                                            <td class="text-center prix-unitaire">
                                                {{ number_format($item->prix_de_vente, 0, ',', ' ') }}</td>
                                            <td class="text-center">
                                                <div class="d-inline-flex align-items-center">
                                                    <button
                                                        class="btn btn-sm btn-outline-secondary btn-decrement">−</button>
                                                    <input type="number"
                                                        class="form-control form-control-sm text-center mx-1 quantite"
                                                        value="{{ $item->quantite }}" min="1"
                                                        max="{{ $item->stock }}" style="width:70px;">
                                                    <button
                                                        class="btn btn-sm btn-outline-secondary btn-increment">+</button>
                                                </div>
                                            </td>
                                            <td class="text-center fw-bold total-ligne">
                                                {{ number_format($item->prix_de_vente * $item->quantite, 0, ',', ' ') }}
                                                FCFA
                                            </td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-outline-danger btn-remove-panier"
                                                    data-id="{{ $item->id }}" title="Retirer">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Total :</td>
                                        <td class="text-center fw-bold" style="font-size:1.2em;" id="total-general">
                                            {{ number_format(array_sum(array_map(fn($item) => $item->prix_de_vente * $item->quantite, $panier)), 0, ',', ' ') }}
                                            FCFA
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                            <a href="{{route('boutique.index')}}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Continuer mes achats
                            </a>
                            <a href="{{ route('panier.caisse') }}" class="btn btn-success px-4 btn-valide-cmd">
                                <i class="bi bi-check-circle"></i>
                                {{ Auth::check() ? 'Valider ma commande' : 'Se connecter pour valider ma commande' }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {

            // === Recalcul du total général ===
            function updateTotalGeneral() {
                let total = 0;
                $('.total-ligne').each(function() {
                    const ligneTotal = parseFloat($(this).text().replace(/[^\d]/g, '')) || 0;
                    total += ligneTotal;
                });
                $('#total-general').text(new Intl.NumberFormat('fr-FR').format(total) + ' FCFA');

            }

            // === Met à jour la ligne + total global + AJAX ===
            function updateLigne(row, quantite) {
                const prix = parseFloat(row.find('.prix-unitaire').text().replace(/[^\d]/g, '')) || 0;
                const totalLigne = prix * quantite;

                // Mise à jour affichage
                row.find('.quantite').val(quantite);
                row.find('.total-ligne').text(new Intl.NumberFormat('fr-FR').format(totalLigne) + ' FCFA');
                updateTotalGeneral();

                // AJAX vers le serveur
                const id = row.data('id');
                $.ajax({
                    url: `/panier/update/${id}`,
                    method: 'POST',
                    data: {
                        quantite: quantite,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        row.css('opacity', 0.5);
                    },
                    success: function() {
                        row.css('opacity', 1);
                    },
                    error: function() {
                        alert("Erreur lors de la mise à jour du panier.");
                        row.css('opacity', 1);
                    }
                });
            }

            // === Incrémenter ===
            $('.btn-increment').on('click', function() {
                const row = $(this).closest('tr');
                const input = row.find('.quantite');
                let qte = parseInt(input.val());
                const max = parseInt(input.attr('max'));

                if (qte < max) {
                    qte++;
                    updateLigne(row, qte);
                }
            });

            // === Décrémenter ===
            $('.btn-decrement').on('click', function() {
                const row = $(this).closest('tr');
                const input = row.find('.quantite');
                let qte = parseInt(input.val());

                if (qte > 1) {
                    qte--;
                    updateLigne(row, qte);
                }
            });

            // === Saisie directe ===
            $('.quantite').on('change', function() {
                const row = $(this).closest('tr');
                let qte = parseInt($(this).val());
                const max = parseInt($(this).attr('max'));
                if (qte < 1) qte = 1;
                if (qte > max) qte = max;
                updateLigne(row, qte);
            });

            // === Supprimer un produit ===
            $('.btn-remove-panier').on('click', function() {
                const row = $(this).closest('tr');
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Ce produit sera retiré du panier.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/panier/remove/${id}`,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            beforeSend: function() {
                                row.css('opacity', 0.5);
                            },
                            success: function() {
                                row.fadeOut(400, function() {
                                    $(this).remove();
                                    updateTotalGeneral();
                                    // Si le panier est vide, on recharge la page
                                    if ($('#table-body').children('tr')
                                        .length === 0) {
                                        location.reload();
                                    }
                                });
                                Swal.fire('Supprimé !',
                                    'Le produit a été retiré du panier.', 'success');
                            },
                            error: function() {
                                alert("Erreur lors de la suppression du produit.");
                                row.css('opacity', 1);
                            }
                        });
                    }
                });
            });

            // === Validation de la commande si la commande est superieur a 10 000 ===
            $('.btn-valide-cmd').on('click', function(e) {
                let total = 0;
                $('.total-ligne').each(function() {
                    const ligneTotal = parseFloat($(this).text().replace(/[^\d]/g, '')) || 0;
                    total += ligneTotal;
                });
                if (total < 10000) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Montant insuffisant',
                        text: 'Votre commande doit être égale ou supérieure à 10 000 FCFA pour être validée.'
                    });
                    return false;
                }
            });


        });
    </script>

    {{-- <script>
        $(function() {

            // === Recalcul du total général ===
            function updateTotalGeneral() {
                let total = 0;
                $('.total-ligne').each(function() {
                    const ligneTotal = parseFloat($(this).text().replace(/[^\d]/g, '')) || 0;
                    total += ligneTotal;
                });
                $('#total-general').text(new Intl.NumberFormat('fr-FR').format(total) + ' FCFA');
            }

            // === Met à jour la ligne + total global + AJAX ===
            function updateLigne(row, quantite) {
                const prix = parseFloat(row.find('.prix-unitaire').text().replace(/[^\d]/g, '')) || 0;
                const totalLigne = prix * quantite;

                // Mise à jour affichage
                row.find('.quantite').val(quantite);
                row.find('.total-ligne').text(new Intl.NumberFormat('fr-FR').format(totalLigne) + ' FCFA');
                updateTotalGeneral();

                // AJAX vers le serveur
                const id = row.data('id');
                $.ajax({
                    url: `/panier/update/${id}`,
                    method: 'POST',
                    data: {
                        quantite: quantite,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: () => row.css('opacity', 0.5),
                    success: () => row.css('opacity', 1),
                    error: () => {
                        alert("Erreur lors de la mise à jour du panier.");
                        row.css('opacity', 1);
                    }
                });
            }

            // === Incrémenter ===
            $('.btn-increment').on('click', function() {
                const row = $(this).closest('tr');
                const input = row.find('.quantite');
                let qte = parseInt(input.val());
                const max = parseInt(input.attr('max'));

                if (qte < max) {
                    updateLigne(row, ++qte);
                }
            });

            // === Décrémenter ===
            $('.btn-decrement').on('click', function() {
                const row = $(this).closest('tr');
                const input = row.find('.quantite');
                let qte = parseInt(input.val());

                if (qte > 1) {
                    updateLigne(row, --qte);
                }
            });

            // === Saisie directe ===
            $('.quantite').on('change', function() {
                const row = $(this).closest('tr');
                let qte = parseInt($(this).val());
                const max = parseInt($(this).attr('max'));

                qte = Math.min(Math.max(qte, 1), max);
                updateLigne(row, qte);
            });

            // === Supprimer un produit ===
            $('.btn-remove-panier').on('click', function() {
                const row = $(this).closest('tr');
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Ce produit sera retiré du panier.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/panier/remove/${id}`,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            beforeSend: () => row.css('opacity', 0.5),
                            success: () => {
                                row.fadeOut(400, function() {
                                    $(this).remove();
                                    updateTotalGeneral();
                                    if ($('#table-body tr').length === 0)
                                        location.reload();
                                });
                                Swal.fire('Supprimé !',
                                    'Le produit a été retiré du panier.', 'success');
                            },
                            error: () => {
                                alert("Erreur lors de la suppression du produit.");
                                row.css('opacity', 1);
                            }
                        });
                    }
                });
            });

            // === Validation de la commande ===
            $('.btn-valide-cmd').on('click', function(e) {
                let total = 0;
                $('.total-ligne').each(function() {
                    total += parseFloat($(this).text().replace(/[^\d]/g, '')) || 0;
                });

                if (total < 10000) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Montant insuffisant',
                        text: 'Votre commande doit être égale ou supérieure à 10 000 FCFA pour être validée.'
                    });
                }
            });

        });
    </script> --}}
@endpush
