@extends('frontend.layouts.app')

@section('title', 'Mon Panier')

@section('content')
    <div class="container py-5">
        <h2 class="fw-bold mb-4 text-center title">Mon Panier</h2>
        <!-- Afficher un message de session -->
        @include('frontend.components.message_session')
        <div class="col-lg-10 mx-auto alert alert-info alert-dismissible fade show d-none" role="alert" id="alertPanier">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Votre commande doit être egale ou superieur à <strong>10 000 FCFA</strong> avant de pouvoir la valider.
        </div>



        <div class="row justify-content-center">
            <div class="col-lg-8">
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
                        <div class="row gy-3" id="panier-content">
                            @foreach ($panier as $item)
                                <div class="col-12">
                                    <div class="card shadow-sm border-0 rounded-4 position-relative"
                                        data-id="{{ $item->id }}">
                                        <div class="card-body d-flex flex-column flex-md-row align-items-center gap-3">
                                            <!-- Image produit -->
                                            <img src="{{ $item->getFirstMediaUrl('image_principale') ?: asset('front/images/produits/poulet.png') }}"
                                                alt="{{ $item->libelle }}" class="rounded"
                                                style="width:90px; height:90px; object-fit:cover; flex-shrink:0;">

                                            <!-- Infos produit -->
                                            <div class="flex-grow-1 text-center text-md-start">
                                                <h6 class="fw-bold mb-1">{{ $item->libelle }}</h6>
                                                <p class="text-muted small mb-1">{{ $item->categorie->libelle ?? '' }}</p>
                                                <p class="mb-1 text-dark fw-bold prix-unitaire" style="font-size:15px;">
                                                    {{ number_format($item->prix_de_vente, 0, ',', ' ') }} FCFA
                                                </p>
                                            </div>

                                            <!-- Quantité -->
                                            <div class="d-flex align-items-center justify-content-center">
                                                <button class="btn btn-sm btn-outline-secondary btn-decrement">−</button>
                                                <input type="number"
                                                    class="form-control form-control-sm text-center mx-2 quantite"
                                                    value="{{ $item->quantite }}" min="1" max="{{ $item->stock }}"
                                                    style="width:70px;">
                                                <button class="btn btn-sm btn-outline-secondary btn-increment">+</button>
                                            </div>

                                            <!-- Total -->
                                            <div class="text-center fw-bold total-ligne" style="min-width:100px;">
                                                {{ number_format($item->prix_de_vente * $item->quantite, 0, ',', ' ') }}
                                                FCFA
                                            </div>

                                            <!-- Supprimer -->
                                            <button
                                                class="btn btn-sm btn-outline-danger btn-remove-panier position-absolute top-0 end-0 m-2"
                                                data-id="{{ $item->id }}" title="Retirer">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Total général -->
                        <div class="card shadow-sm border-0 mt-4">
                            <div
                                class="card-body d-flex flex-column flex-md-row justify-content-between align-items-center">
                                <h5 class="fw-bold mb-3 mb-md-0">
                                    Total : <span id="total-general">
                                        {{ number_format(array_sum(array_map(fn($item) => $item->prix_de_vente * $item->quantite, $panier)), 0, ',', ' ') }}
                                        FCFA
                                    </span>
                                </h5>

                                <div class="d-flex flex-column flex-md-row gap-2">
                                    <a href="{{ route('boutique.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left"></i> Continuer mes achats
                                    </a>
                                    <a href="{{ route('panier.caisse') }}" class="btn btn-success px-4 btn-valide-cmd">
                                        <i class="bi bi-check-circle"></i>
                                        {{ Auth::check() ? 'Valider ma commande' : 'Se connecter pour valider ma commande' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @push('scripts')
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
@endpush --}}

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {

            // === Fonction pour mettre à jour le badge du panier ===
            function updateCartBadge() {
                $.ajax({
                    url: '/panier/count',
                    method: 'GET',
                    success: function(response) {
                        // Mettre à jour tous les badges du panier (desktop et mobile)
                        $('#cart-badge').text(response.count);
                        $('#cart-badge-mobile').text(response.count);
                        $('.bi-cart').next('span.badge').text(response.count);
                        $('i.bi-cart').siblings('.badge').text(response.count);

                        // Alternative: sélecteur plus général
                        $('[id*="cart-badge"], .cart-count, .panier-count').text(response.count);
                    },
                    error: function() {
                        console.log('Erreur lors de la mise à jour du badge panier');
                    }
                });
            }

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
            function updateLigne(card, quantite) {
                const prix = parseFloat(card.find('.prix-unitaire').text().replace(/[^\d]/g, '')) || 0;
                const totalLigne = prix * quantite;

                // Mise à jour affichage
                card.find('.quantite').val(quantite);
                card.find('.total-ligne').text(new Intl.NumberFormat('fr-FR').format(totalLigne) + ' FCFA');
                updateTotalGeneral();

                // AJAX vers le serveur
                const id = card.data('id');
                $.ajax({
                    url: `/panier/update/${id}`,
                    method: 'POST',
                    data: {
                        quantite: quantite,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        card.css('opacity', 0.5);
                    },
                    success: function() {
                        card.css('opacity', 1);
                        // Mettre à jour le badge après modification
                        updateCartBadge();
                    },
                    error: function() {
                        alert("Erreur lors de la mise à jour du panier.");
                        card.css('opacity', 1);
                    }
                });
            }

            // === Incrémenter ===
            $(document).on('click', '.btn-increment', function() {
                const card = $(this).closest('.card');
                const input = card.find('.quantite');
                let qte = parseInt(input.val());
                const max = parseInt(input.attr('max'));

                if (qte < max) {
                    qte++;
                    updateLigne(card, qte);
                }
            });

            // === Décrémenter ===
            $(document).on('click', '.btn-decrement', function() {
                const card = $(this).closest('.card');
                const input = card.find('.quantite');
                let qte = parseInt(input.val());

                if (qte > 1) {
                    qte--;
                    updateLigne(card, qte);
                }
            });

            // === Saisie directe ===
            $(document).on('change', '.quantite', function() {
                const card = $(this).closest('.card');
                let qte = parseInt($(this).val());
                const max = parseInt($(this).attr('max'));
                if (qte < 1) qte = 1;
                if (qte > max) qte = max;
                updateLigne(card, qte);
            });

            // === Supprimer un produit ===
            $(document).on('click', '.btn-remove-panier', function() {
                const card = $(this).closest('.card');
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
                                card.css('opacity', 0.5);
                            },
                            success: function() {
                                card.fadeOut(400, function() {
                                    $(this).remove();
                                    updateTotalGeneral();

                                    // Mettre à jour le badge après suppression
                                    updateCartBadge();

                                    // Si le panier est vide → recharge
                                    if ($('#panier-content .card').length ===
                                        0) {
                                        setTimeout(() => location.reload(),
                                        500);
                                    }
                                });
                                Swal.fire('Supprimé !',
                                    'Le produit a été retiré du panier.', 'success');
                            },
                            error: function() {
                                alert("Erreur lors de la suppression du produit.");
                                card.css('opacity', 1);
                            }
                        });
                    }
                });
            });

            // === Validation du montant minimum ===
            $(document).on('click', '.btn-valide-cmd', function(e) {
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
@endpush
