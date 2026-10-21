@extends('frontend.layouts.app')

@section('title', 'Mon Panier')

@section('content')
    @php
        $minimum = 10000; // montant minimum de commande (aussi vérifié en JS plus bas)
        $total = array_sum(array_map(fn($item) => $item->prix_de_vente * $item->quantite, $panier));
        $nbArticles = array_sum(array_map(fn($item) => $item->quantite, $panier));
    @endphp

    <section class="page-body">
        <div class="container">
            @if (empty($panier))
                {{-- Panier vide --}}
                <div class="cart-empty reveal">
                    <div class="cart-empty__icon"><span class="wobble">🧺</span></div>
                    <h2>Votre panier est vide</h2>
                    <p>Nos poulets, œufs et produits frais n'attendent que vous.</p>
                    <a href="{{ route('boutique.index') }}" class="btn btn-success btn-lg">
                        <i class="bi bi-basket2-fill me-1"></i> Découvrir nos produits
                    </a>
                </div>
            @else
                <div class="row g-4">
                    {{-- Articles --}}
                    <div class="col-lg-8">
                        <div class="cart-box">
                            <div class="cart-box__head">
                                <h2><i class="bi bi-basket2-fill"></i> Vos articles</h2>
                                <span class="cart-box__count"><span class="panier-count">{{ $nbArticles }}</span> article(s)</span>
                            </div>

                            <div id="panier-content">
                                @foreach ($panier as $item)
                                    <div class="card cart-line" data-id="{{ $item->id }}">
                                        <img src="{{ $item->getFirstMediaUrl('image_principale', 'thumb') ?: asset('front/images/produits/poulet.png') }}"
                                            alt="{{ $item->libelle }}" class="cart-line__img" width="88" height="88" loading="lazy">

                                        <div class="cart-line__info">
                                            @if ($item->categorie)
                                                <span class="cart-line__cat">{{ $item->categorie->libelle }}</span>
                                            @endif
                                            <h3 class="cart-line__name">{{ $item->libelle }}</h3>
                                            <span class="cart-line__unit"><span class="prix-unitaire">{{ number_format($item->prix_de_vente, 0, ',', ' ') }} FCFA</span> / unité</span>
                                        </div>

                                        <div class="cart-line__qty" role="group" aria-label="Quantité">
                                            <button type="button" class="btn-decrement" aria-label="Retirer un">−</button>
                                            <input type="number" class="quantite" value="{{ $item->quantite }}" min="1"
                                                max="{{ $item->stock }}" inputmode="numeric" aria-label="Quantité">
                                            <button type="button" class="btn-increment" aria-label="Ajouter un">+</button>
                                        </div>

                                        <div class="cart-line__total total-ligne">
                                            {{ number_format($item->prix_de_vente * $item->quantite, 0, ',', ' ') }} FCFA
                                        </div>

                                        <button type="button" class="cart-line__remove btn-remove-panier" data-id="{{ $item->id }}"
                                            title="Retirer du panier" aria-label="Retirer {{ $item->libelle }} du panier">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <a href="{{ route('boutique.index') }}" class="link-more mt-3">
                                <i class="bi bi-arrow-left"></i> Continuer mes achats
                            </a>
                        </div>
                    </div>

                    {{-- Récapitulatif --}}
                    <div class="col-lg-4">
                        <aside class="cart-summary">
                            <h2>Récapitulatif</h2>

                            <div class="cart-summary__row">
                                <span>Sous-total</span>
                                <strong id="total-general">{{ number_format($total, 0, ',', ' ') }} FCFA</strong>
                            </div>
                            <div class="cart-summary__row small">
                                <span>Livraison</span>
                                <span>Calculée à l'étape suivante</span>
                            </div>

                            {{-- Progression vers le minimum de commande --}}
                            <div class="cart-min" id="cart-min" data-min="{{ $minimum }}">
                                <div class="cart-min__bar"><span style="width: {{ min(100, $total / $minimum * 100) }}%"></span></div>
                                <p class="cart-min__text">
                                    @if ($total >= $minimum)
                                        <i class="bi bi-check-circle-fill"></i> Minimum de commande atteint
                                    @else
                                        Encore <strong>{{ number_format($minimum - $total, 0, ',', ' ') }} FCFA</strong> pour atteindre le minimum de {{ number_format($minimum, 0, ',', ' ') }} FCFA
                                    @endif
                                </p>
                            </div>

                            <a href="{{ route('panier.caisse') }}" class="btn btn-warning btn-lg w-100 btn-valide-cmd">
                                <i class="bi bi-bag-check-fill me-1"></i>
                                {{ Auth::check() ? 'Valider ma commande' : 'Se connecter pour commander' }}
                            </a>

                            <ul class="cart-summary__trust">
                                <li><i class="bi bi-patch-check"></i> Fraîcheur garantie</li>
                                <li><i class="bi bi-truck"></i> Livraison rapide</li>
                                <li><i class="bi bi-whatsapp"></i> Assistance WhatsApp</li>
                            </ul>
                        </aside>
                    </div>
                </div>

                {{-- Barre fixe en bas sur mobile : total + validation toujours visibles --}}
                <div class="cart-mobile-bar d-lg-none">
                    <div>
                        <small>Total</small>
                        <strong class="cart-mobile-total">{{ number_format($total, 0, ',', ' ') }} FCFA</strong>
                    </div>
                    <a href="{{ route('panier.caisse') }}" class="btn btn-warning btn-valide-cmd">
                        {{ Auth::check() ? 'Commander' : 'Se connecter' }} <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
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

            // === Barre de progression vers le minimum de commande ===
            function majProgressionMinimum(total) {
                const bloc = document.getElementById('cart-min');
                if (!bloc) return;
                const min = parseInt(bloc.dataset.min, 10);
                bloc.querySelector('.cart-min__bar span').style.width = Math.min(100, total / min * 100) + '%';
                bloc.querySelector('.cart-min__text').innerHTML = total >= min
                    ? '<i class="bi bi-check-circle-fill"></i> Minimum de commande atteint'
                    : 'Encore <strong>' + new Intl.NumberFormat('fr-FR').format(min - total) + ' FCFA</strong> pour atteindre le minimum de ' + new Intl.NumberFormat('fr-FR').format(min) + ' FCFA';
                bloc.classList.toggle('is-ok', total >= min);
            }

            // === Recalcul du total général ===
            function updateTotalGeneral() {
                let total = 0;
                $('.total-ligne').each(function() {
                    const ligneTotal = parseFloat($(this).text().replace(/[^\d]/g, '')) || 0;
                    total += ligneTotal;
                });
                $('#total-general').text(new Intl.NumberFormat('fr-FR').format(total) + ' FCFA');
                $('.cart-mobile-total').text(new Intl.NumberFormat('fr-FR').format(total) + ' FCFA');
                majProgressionMinimum(total);
                // Si le total est égal à 0, rafraîchir la page
                if (total === 0) {
                    setTimeout(() => location.reload(), 500);
                }
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
                        FoaniToast.error('Mise à jour impossible', 'La quantité n\x27a pas pu être modifiée. Réessayez.');
                        card.css('opacity', 1);
                    }
                });
            }

            // Quantité valide d'une ligne : vide ou < 1 → 1, plafonnée au stock s'il est connu
            function qteValide(input, valeur) {
                let qte = parseInt(valeur, 10);
                const max = parseInt(input.attr('max'), 10);
                if (!(qte >= 1)) qte = 1;
                if (max >= 1 && qte > max) qte = max;
                return qte;
            }

            // === Incrémenter ===
            $(document).on('click', '.btn-increment', function() {
                const card = $(this).closest('.card');
                const input = card.find('.quantite');
                const actuelle = qteValide(input, input.val());
                const qte = qteValide(input, actuelle + 1);

                if (qte !== actuelle) {
                    updateLigne(card, qte);
                } else if (parseInt(input.val(), 10) !== actuelle) {
                    input.val(actuelle);
                }
            });

            // === Décrémenter ===
            $(document).on('click', '.btn-decrement', function() {
                const card = $(this).closest('.card');
                const input = card.find('.quantite');
                const actuelle = qteValide(input, input.val());

                if (actuelle > 1) {
                    updateLigne(card, actuelle - 1);
                } else {
                    input.val(1);
                }
            });

            // === Saisie directe ===
            $(document).on('change', '.quantite', function() {
                const card = $(this).closest('.card');
                updateLigne(card, qteValide($(this), $(this).val()));
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
                    confirmButtonText: '<i class="bi bi-trash3 me-1"></i> Oui, retirer',
                    customClass: { confirmButton: 'is-danger' },
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
                                FoaniToast.success('Produit retiré', 'Le produit a été retiré de votre panier.');
                            },
                            error: function() {
                                FoaniToast.error('Suppression impossible', 'Le produit n\x27a pas pu être retiré. Réessayez.');
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
