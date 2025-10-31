{{-- filepath: c:\laragon\www\foani\resources\views\frontend\pages\commande\old\panier.blade copy.php --}}
@extends('frontend.layouts.app')

@section('title', 'Mon Panier')

@section('content')
    <style>
        /* Design moderne et fluide pour le panier */
        .panier-hero {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            color: white;
            padding: 50px 0;
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

        .panier-hero h2 {
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
            padding: 30px;
        }

        /* Alert personnalisée */
        .alert-custom {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 2px solid #f39c12;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
        }

        .alert-custom .alert-icon {
            font-size: 2rem;
            color: #f39c12;
            margin-bottom: 10px;
        }

        /* Table moderne */
        .table-modern {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: none;
        }

        .table-modern thead {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            color: white;
        }

        .table-modern thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .table-modern tbody td {
            border: none;
            padding: 20px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }

        .table-modern tbody tr:hover {
            background: #fafbfc;
            transform: scale(1.01);
            transition: all 0.3s ease;
        }

        .table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        /* Image produit */
        .product-image {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            object-fit: cover;
            border: 3px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        .product-image:hover {
            border-color: var(--color-vert);
            transform: scale(1.1);
        }

        /* Info produit */
        .product-name {
            font-weight: 700;
            color: #333;
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .product-category {
            background: #e8f5e8;
            color: var(--color-vert);
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            display: inline-block;
        }

        /* Prix */
        .price-display {
            font-weight: 700;
            color: var(--color-vert);
            font-size: 1.1rem;
        }

        /* Contrôles de quantité */
        .quantity-controls {
            background: #f8f9fa;
            border-radius: 25px;
            padding: 5px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
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
            border-radius: 50%;
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
            border-radius: 8px;
        }

        /* Total ligne */
        .total-cell {
            font-weight: 700;
            color: var(--color-vert2);
            font-size: 1.1rem;
        }

        /* Bouton supprimer */
        .btn-remove {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            border: none;
            color: white;
            border-radius: 8px;
            padding: 8px 12px;
            transition: all 0.3s ease;
        }

        .btn-remove:hover {
            background: linear-gradient(135deg, #ee5a52, #e74c3c);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(238, 90, 82, 0.4);
            color: white;
        }

        /* Footer de table */
        .table-footer {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            border-top: 3px solid var(--color-vert);
        }

        .total-amount {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--color-vert2);
        }

        /* Boutons d'action */
        .action-buttons {
            margin-top: 30px;
            padding: 25px;
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            border-radius: 15px;
            border: 2px solid #e9ecef;
        }

        .btn-continue {
            background: white;
            color: var(--color-vert);
            border: 2px solid var(--color-vert);
            padding: 12px 24px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-continue:hover {
            background: var(--color-vert);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(42, 107, 42, 0.3);
        }

        .btn-validate {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            color: white;
            border: none;
            padding: 12px 32px;
            border-radius: 25px;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-validate:hover {
            background: linear-gradient(135deg, var(--color-vert2), var(--color-vert));
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(42, 107, 42, 0.3);
            color: white;
        }

        /* État panier vide */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #6c757d;
        }

        .empty-state .empty-icon {
            font-size: 5rem;
            margin-bottom: 30px;
            opacity: 0.3;
            color: var(--color-vert);
        }

        .empty-state h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: #495057;
        }

        .empty-state p {
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
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .panier-hero {
                padding: 30px 0;
            }

            .panier-hero h2 {
                font-size: 2rem;
            }

            .panier-container {
                padding: 20px 0;
            }

            .panier-content {
                padding: 20px;
                margin: 0 10px;
            }

            .table-modern thead {
                display: none;
            }

            .table-modern tbody tr {
                display: block;
                background: white;
                border-radius: 15px;
                margin-bottom: 15px;
                padding: 20px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            }

            .table-modern tbody td {
                display: block;
                border: none;
                padding: 8px 0;
                text-align: left !important;
            }

            .table-modern tbody td:before {
                content: attr(data-label) ": ";
                font-weight: 700;
                color: var(--color-vert);
                display: inline-block;
                width: 80px;
            }

            .product-image {
                width: 60px;
                height: 60px;
                margin-right: 15px;
                float: left;
            }

            .quantity-controls {
                margin: 10px 0;
            }

            .action-buttons {
                padding: 20px;
            }

            .action-buttons .d-flex {
                flex-direction: column;
                gap: 15px;
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
    </style>

    {{-- Hero Section --}}
    <div class="panier-hero">
        <div class="container">
            <div class="panier-hero-content">
                <h2 class="fw-bold title"><i class="bi bi-cart3 me-3"></i>Mon Panier</h2>
                <p>Vérifiez vos articles et validez votre commande</p>
            </div>
        </div>
    </div>

    <div class="panier-container">
        <div class="container py-5">
            {{-- Messages de session --}}
            @include('frontend.components.message_session')
            
            {{-- Alerte commande minimum --}}
            <div class="col-lg-10 mx-auto alert alert-info alert-dismissible fade show d-none alert-custom" role="alert" id="alertPanier">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="alert-icon">
                    <i class="bi bi-info-circle"></i>
                </div>
                <strong>Votre commande doit être égale ou supérieure à <strong>10 000 FCFA</strong> avant de pouvoir la valider.</strong>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="panier-content">
                        <div id="panier-content">
                            @if (empty($panier))
                                {{-- État panier vide --}}
                                <div class="empty-state">
                                    <i class="bi bi-cart-x empty-icon"></i>
                                    <h3>Votre panier est vide</h3>
                                    <p>Découvrez nos délicieux produits et commencez vos achats !</p>
                                    <a href="{{ route('boutique.index') }}" class="btn btn-shop">
                                        <i class="bi bi-shop me-2"></i>Découvrir nos produits
                                    </a>
                                </div>
                            @else
                                {{-- Table des produits --}}
                                <div class="table-responsive mb-4">
                                    <table class="table table-modern align-middle">
                                        <thead>
                                            <tr>
                                                <th><i class="bi bi-image me-2"></i>Image</th>
                                                <th><i class="bi bi-box me-2"></i>Produit</th>
                                                <th class="text-center"><i class="bi bi-currency-euro me-2"></i>Prix unitaire</th>
                                                <th class="text-center"><i class="bi bi-123 me-2"></i>Quantité</th>
                                                <th class="text-center"><i class="bi bi-calculator me-2"></i>Total</th>
                                                <th class="text-center"><i class="bi bi-gear me-2"></i>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body">
                                            @foreach ($panier as $item)
                                                <tr data-id="{{ $item->id }}">
                                                    <td data-label="Image">
                                                        <img src="{{ $item->getFirstMediaUrl('image_principale') ?: asset('front/images/produits/poulet.png') }}"
                                                            alt="{{ $item->libelle }}" class="product-image">
                                                    </td>
                                                    <td data-label="Produit">
                                                        <div class="product-name">{{ $item->libelle }}</div>
                                                        @if($item->categorie)
                                                            <span class="product-category">{{ $item->categorie->libelle }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center prix-unitaire price-display" data-label="Prix unitaire">
                                                        {{ number_format($item->prix_de_vente, 0, ',', ' ') }} FCFA
                                                    </td>
                                                    <td class="text-center" data-label="Quantité">
                                                        <div class="quantity-controls">
                                                            <button class="quantity-btn btn-decrement">−</button>
                                                            <input type="number"
                                                                class="quantity-input quantite text-center"
                                                                value="{{ $item->quantite }}" min="1"
                                                                max="{{ $item->stock }}">
                                                            <button class="quantity-btn btn-increment">+</button>
                                                        </div>
                                                    </td>
                                                    <td class="text-center total-cell total-ligne" data-label="Total">
                                                        {{ number_format($item->prix_de_vente * $item->quantite, 0, ',', ' ') }} FCFA
                                                    </td>
                                                    <td class="text-center" data-label="Actions">
                                                        <button class="btn btn-remove btn-remove-panier"
                                                            data-id="{{ $item->id }}" title="Retirer du panier">
                                                            <i class="bi bi-trash me-1"></i>Retirer
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="table-footer">
                                            <tr>
                                                <td colspan="4" class="text-end fw-bold" style="padding: 20px;">
                                                    <i class="bi bi-calculator me-2"></i>Total général :
                                                </td>
                                                <td class="text-center total-amount" id="total-general" style="padding: 20px;">
                                                    {{ number_format(array_sum(array_map(fn($item) => $item->prix_de_vente * $item->quantite, $panier)), 0, ',', ' ') }} FCFA
                                                </td>
                                                <td style="padding: 20px;"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                {{-- Boutons d'action --}}
                                <div class="action-buttons">
                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                                        <a href="{{route('boutique.index')}}" class="btn btn-continue">
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

@endpush