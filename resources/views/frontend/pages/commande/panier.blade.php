{{-- filepath: c:\laragon\www\foani\resources\views\frontend\pages\commande\panier.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Mon Panier')

@section('content')
    <style>
        /* Design moderne et fluide pour le panier */
        .panier-hero {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            color: white;
            padding: 60px 0;
            margin-bottom: 0;
            position: relative;
            overflow: hidden;
        }

        .panier-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .panier-hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .panier-hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .panier-hero p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0;
        }

        .panier-container {
            background: #f8f9fa;
            min-height: 60vh;
            padding: 40px 0;
        }

        .panier-content {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .panier-header {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            padding: 25px 30px;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .panier-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-vert);
            margin: 0;
        }

        .panier-count {
            background: var(--color-vert);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Cards des produits */
        .product-item {
            padding: 25px 30px;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-item:hover {
            background: #fafbfc;
        }

        .product-card {
            border: none;
            background: transparent;
            box-shadow: none;
        }

        .product-image {
            width: 90px;
            height: 90px;
            border-radius: 15px;
            object-fit: cover;
            border: 3px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        .product-item:hover .product-image {
            border-color: var(--color-vert);
            transform: scale(1.05);
        }

        .product-info h6 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .product-category {
            background: #e8f5e8;
            color: var(--color-vert);
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 8px;
        }

        .product-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--color-vert);
        }

        /* Contrôles de quantité */
        .quantity-controls {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .quantity-controls:focus-within {
            border-color: var(--color-vert);
            box-shadow: 0 0 0 3px rgba(85, 158, 51, 0.1);
        }

        .quantity-btn {
            width: 32px;
            height: 32px;
            border: none;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--color-vert);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .quantity-btn:hover {
            background: var(--color-vert);
            color: white;
            transform: scale(1.1);
        }

        .quantity-input {
            border: none;
            background: transparent;
            text-align: center;
            font-weight: 700;
            color: #333;
            width: 50px;
        }

        .quantity-input:focus {
            outline: none;
            background: white;
            border-radius: 6px;
        }

        /* Total et prix */
        .item-total {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--color-vert2);
            text-align: center;
            min-width: 120px;
        }

        /* Bouton supprimer */
        .remove-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 36px;
            height: 36px;
            border: 2px solid #dc3545;
            background: white;
            color: #dc3545;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
            z-index: 10;
        }

        .remove-btn:hover {
            background: #dc3545;
            color: white;
            transform: scale(1.1);
        }

        /* Résumé total */
        .total-summary {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            color: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(42, 107, 42, 0.3);
            margin-top: 30px;
        }

        .total-amount {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn-continue {
            background: white;
            color: var(--color-vert);
            border: 2px solid white;
            padding: 12px 24px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-continue:hover {
            background: transparent;
            color: white;
            border-color: white;
        }

        .btn-validate {
            background: var(--color-jaune);
            color: #333;
            border: 2px solid var(--color-jaune);
            padding: 12px 32px;
            border-radius: 25px;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-validate:hover {
            background: #f1c40f;
            border-color: #f1c40f;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(241, 196, 15, 0.4);
        }

        /* État panier vide */
        .empty-cart {
            text-align: center;
            padding: 80px 20px;
            color: #6c757d;
        }

        .empty-cart i {
            font-size: 5rem;
            margin-bottom: 30px;
            opacity: 0.3;
            color: var(--color-vert);
        }

        .empty-cart h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: #495057;
        }

        .empty-cart p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .btn-shop {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-shop:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(42, 107, 42, 0.3);
        }

        /* Alert personnalisée */
        .min-order-alert {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 2px solid #f39c12;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
        }

        .min-order-alert .alert-icon {
            font-size: 2rem;
            color: #f39c12;
            margin-bottom: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .panier-hero {
                padding: 40px 0;
            }

            .panier-hero h1 {
                font-size: 2rem;
            }

            .panier-container {
                padding: 20px 0;
            }

            .panier-header {
                padding: 20px;
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .product-item {
                padding: 20px;
            }

            .product-card .card-body {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .product-image {
                width: 80px;
                height: 80px;
            }

            .quantity-controls {
                justify-content: center;
                margin: 15px 0;
            }

            .item-total {
                text-align: center;
                font-size: 1.1rem;
            }

            .remove-btn {
                position: static;
                margin-top: 15px;
                align-self: center;
            }

            .total-summary {
                padding: 25px 20px;
            }

            .total-amount {
                font-size: 1.6rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-continue,
            .btn-validate {
                width: 100%;
                justify-content: center;
            }
        }

        /* Animations */
        .panier-content {
            animation: slideInUp 0.6s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-item {
            animation: fadeInLeft 0.5s ease-out;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>

    {{-- Hero Section --}}
    <div class="panier-hero">
        <div class="container">
            <div class="panier-hero-content">
                <h1><i class="bi bi-cart3 me-3"></i>Mon Panier</h1>
                <p>Vérifiez vos articles et validez votre commande</p>
            </div>
        </div>
    </div>

    <div class="panier-container">
        <div class="container">
            {{-- Messages de session --}}
            @include('frontend.components.message_session')

            {{-- Alerte commande minimum --}}
            <div class="col-lg-10 mx-auto alert alert-info alert-dismissible fade show d-none" role="alert" id="alertPanier">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="alert-icon">
                    <i class="bi bi-info-circle"></i>
                </div>
                <strong>Votre commande doit être égale ou supérieure à <strong>10 000 FCFA</strong> avant de pouvoir la valider.</strong>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div id="panier-content">
                        @if (empty($panier))
                            {{-- Panier vide --}}
                            <div class="panier-content">
                                <div class="empty-cart">
                                    <i class="bi bi-cart-x"></i>
                                    <h3>Votre panier est vide</h3>
                                    <p>Découvrez nos délicieux produits et commencez vos achats !</p>
                                    <a href="{{ route('boutique.index') }}" class="btn btn-shop">
                                        <i class="bi bi-shop me-2"></i>Découvrir nos produits
                                    </a>
                                </div>
                            </div>
                        @else
                            {{-- Panier avec produits --}}
                            <div class="panier-content">
                                {{-- En-tête du panier --}}
                                <div class="panier-header">
                                    <h2 class="panier-title">
                                        <i class="bi bi-bag-check me-2"></i>Vos articles
                                    </h2>
                                    <div class="panier-count">
                                        {{session('panier') ? array_sum(array_column(session('panier'), 'quantite')) : 0;}}
                                        {{-- {{ count($panier) }} article{{ count($panier) > 1 ? 's' : '' }} --}}
                                    </div>
                                </div>

                                {{-- Liste des produits --}}
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
                            </div>

                            {{-- Résumé total --}}
                            <div class="total-summary">
                                <div class="total-amount">
                                    <i class="bi bi-calculator me-2"></i>
                                    Total : <span id="total-general">
                                        {{ number_format(array_sum(array_map(fn($item) => $item->prix_de_vente * $item->quantite, $panier)), 0, ',', ' ') }} FCFA
                                    </span>
                                </div>

                                <div class="action-buttons">
                                    <a href="{{ route('boutique.index') }}" class="btn btn-continue">
                                        <i class="bi bi-arrow-left me-2"></i>Continuer mes achats
                                    </a>
                                    <a href="{{ route('panier.caisse') }}" class="btn btn-validate btn-valide-cmd">
                                        <i class="bi bi-check-circle me-2"></i>
                                        {{ Auth::check() ? 'Valider ma commande' : 'Se connecter pour commander' }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

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