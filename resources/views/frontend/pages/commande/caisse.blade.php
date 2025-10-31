{{-- filepath: c:\laragon\www\foani\resources\views\frontend\pages\commande\caisse.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Validation de commande')

@section('content')
    <style>
        /* Design moderne et fluide pour la caisse */
        .caisse-hero {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            color: white;
            padding: 50px 0;
            margin-bottom: 0;
            position: relative;
            overflow: hidden;
        }

        .caisse-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="checkout-grid" width="15" height="15" patternUnits="userSpaceOnUse"><path d="M 15 0 L 0 0 0 15" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23checkout-grid)"/></svg>');
            opacity: 0.3;
        }

        .caisse-hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .caisse-hero h2 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 12px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .caisse-hero p {
            font-size: 1rem;
            opacity: 0.9;
            margin: 0;
        }

        .caisse-container {
            background: #f8f9fa;
            padding: 40px 0;
            min-height: 70vh;
        }

        /* Cards modernes */
        .caisse-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
            height: 100%;
            transition: all 0.3s ease;
        }

        .caisse-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(42, 107, 42, 0.12);
        }

        .card-header-custom {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            color: white;
            padding: 20px 25px;
            border: none;
            text-align: center;
        }

        .card-header-custom h5 {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .card-body-custom {
            padding: 25px;
        }

        /* Table résumé commande */
        .table-commande {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
            font-size: 0.9rem;
        }

        .table-commande thead {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        }

        .table-commande thead th {
            border: none;
            padding: 12px 8px;
            font-weight: 600;
            color: var(--color-vert);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-commande tbody td {
            border: none;
            padding: 10px 8px;
            vertical-align: middle;
            border-bottom: 1px solid #f5f5f5;
        }

        .table-commande tbody tr:hover {
            background: #fafbfc;
        }

        .table-commande tbody tr:last-child td {
            border-bottom: none;
        }

        .table-commande tfoot td {
            border: none;
            padding: 12px 8px;
            font-weight: 700;
            background: #f8f9fa;
        }

        .table-commande .produit-name {
            font-weight: 600;
            color: #333;
            font-size: 0.85rem;
        }

        .table-commande .price-cell {
            color: var(--color-vert);
            font-weight: 600;
        }

        /* Formulaire moderne */
        .form-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--color-vert);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 6px;
            font-size: 0.9rem;
        }

        .form-control,
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 10px 15px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--color-vert);
            box-shadow: 0 0 0 3px rgba(85, 158, 51, 0.1);
            outline: none;
        }

        .input-group-text {
            background: var(--color-vert);
            color: white;
            border: 2px solid var(--color-vert);
            font-weight: 600;
        }

        .required-asterisk {
            color: #dc3545;
            font-weight: 700;
        }

        /* Séparateur stylé */
        .divider {
            height: 3px;
            background: linear-gradient(90deg, var(--color-vert), var(--color-jaune), var(--color-vert));
            border: none;
            border-radius: 2px;
            margin: 25px 0;
        }

        /* Boutons */
        .btn-promo {
            background: linear-gradient(135deg, #6c757d, #495057);
            border: none;
            color: white;
            border-radius: 0 10px 10px 0;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-promo:hover {
            background: linear-gradient(135deg, #495057, #343a40);
            transform: translateY(-1px);
            color: white;
        }

        .btn-confirmer {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(42, 107, 42, 0.3);
        }

        .btn-confirmer:hover {
            background: linear-gradient(135deg, var(--color-vert2), #4CAF50);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(42, 107, 42, 0.4);
            color: white;
        }

        /* Alertes personnalisées */
        .alert-custom {
            border-radius: 15px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fff5f5, #fed7d7);
            color: #c53030;
            border-left: 4px solid #e53e3e;
        }

        /* Total général highlight */
        #total-general-row {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2)) !important;
            color: white !important;
        }

        #total-general-row td {
            background: transparent !important;
            color: white !important;
            font-size: 1.1rem !important;
            font-weight: 700 !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .caisse-hero {
                padding: 30px 0;
            }

            .caisse-hero h2 {
                font-size: 1.8rem;
            }

            .caisse-container {
                padding: 20px 0;
            }

            .caisse-card {
                margin-bottom: 20px;
            }

            .card-header-custom {
                padding: 15px 20px;
            }

            .card-body-custom {
                padding: 20px 15px;
            }

            .table-commande {
                font-size: 0.8rem;
            }

            .table-commande thead th,
            .table-commande tbody td,
            .table-commande tfoot td {
                padding: 8px 5px;
            }

            .produit-name {
                font-size: 0.75rem !important;
            }

            .section-title {
                font-size: 1rem;
            }

            .form-control,
            .form-select {
                font-size: 0.85rem;
                padding: 8px 12px;
            }

            .btn-confirmer {
                padding: 12px 30px;
                font-size: 0.9rem;
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .caisse-hero h2 {
                font-size: 1.6rem;
            }

            .card-body-custom {
                padding: 15px;
            }

            .table-commande {
                font-size: 0.75rem;
            }

            .table-commande thead th {
                font-size: 0.7rem;
                padding: 6px 3px;
            }

            .table-commande tbody td,
            .table-commande tfoot td {
                padding: 6px 3px;
            }
        }

        /* Animations */
        .caisse-card {
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

        /* États de validation */
        .was-validated .form-control:invalid,
        .was-validated .form-select:invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
        }

        .was-validated .form-control:valid,
        .was-validated .form-select:valid {
            border-color: var(--color-vert);
            box-shadow: 0 0 0 3px rgba(85, 158, 51, 0.1);
        }

        .invalid-feedback {
            /* display: block; */
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 5px;
        }
    </style>

    {{-- Hero Section --}}
    <div class="caisse-hero">
        <div class="container">
            <div class="caisse-hero-content">
                <h2 class="title">
                    <i class="bi bi-credit-card me-3"></i>Finaliser ma commande
                </h2>
                <p>Vérifiez les détails et confirmez votre commande</p>
            </div>
        </div>
    </div>

    <div class="caisse-container">
        <div class="container">
            {{-- Messages de session --}}
            @include('frontend.components.message_session')

            <div class="row justify-content-center g-4">
                {{-- Bloc résumé commande --}}
                <div class="col-lg-6">
                    <div class="caisse-card">
                        <div class="card-header-custom">
                            <h5>
                                <i class="bi bi-list-check me-2"></i>Résumé de la commande
                            </h5>
                        </div>
                        <div class="card-body-custom">
                            <div class="table-responsive">
                                <table class="table table-commande align-middle">
                                    <thead>
                                        <tr>
                                            <th>Produit</th>
                                            <th class="text-center">Qté</th>
                                            <th class="text-center">PU</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($panier as $item)
                                            @php
                                                $totalPanier = array_sum(
                                                    array_map(fn($item) => $item->prix_de_vente * $item->quantite, $panier),
                                                );
                                            @endphp
                                            <tr>
                                                <td class="produit-name">{{ $item->libelle }}</td>
                                                <td class="text-center">{{ $item->quantite }}</td>
                                                <td class="text-center price-cell">
                                                    {{ number_format($item->prix_de_vente, 0, ',', ' ') }} FCFA
                                                </td>
                                                <td class="text-center price-cell">
                                                    {{ number_format($item->prix_de_vente * $item->quantite, 0, ',', ' ') }} FCFA
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-end">
                                                <i class="bi bi-calculator me-1"></i>Sous-Total :
                                            </td>
                                            <td data-totalPanier="{{ $totalPanier }}" class="text-center price-cell">
                                                {{ number_format($totalPanier, 0, ',', ' ') }} FCFA
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end">
                                                <i class="bi bi-truck me-1"></i>Livraison :
                                            </td>
                                            <td class="text-center price-cell">
                                                <span id="frais-livraison">0</span> FCFA
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bloc formulaire --}}
                <div class="col-lg-6">
                    <div class="caisse-card">
                        <div class="card-header-custom">
                            <h5>
                                <i class="bi bi-person-check me-2"></i>Informations de livraison
                            </h5>
                        </div>
                        <div class="card-body-custom">
                            <form action="{{ route('panier.commande.store') }}" method="POST" class="needs-validation" novalidate>
                                @csrf

                                {{-- Alertes d'erreur --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-custom">
                                        <strong><i class="bi bi-exclamation-triangle me-2"></i>Erreurs détectées :</strong>
                                        <ul class="mb-0 mt-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                {{-- Section informations client --}}
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="bi bi-person-circle"></i>
                                        Informations personnelles
                                    </div>
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                Nom & Prénoms <span class="required-asterisk">*</span>
                                            </label>
                                            <input type="text" name="username" value="{{ Auth::user()->username ?? '' }}"
                                                class="form-control" required>
                                            <div class="invalid-feedback">
                                                Veuillez indiquer votre nom et prénoms.
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">
                                                Contact <span class="required-asterisk">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">+225</span>
                                                <input type="text" name="phone" value="{{ Auth::user()->phone ?? '' }}"
                                                    class="form-control" required>
                                            </div>
                                            <div class="invalid-feedback">
                                                Veuillez indiquer votre numéro de téléphone (10 chiffres).
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">
                                                Email <span class="required-asterisk">*</span>
                                            </label>
                                            <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}"
                                                class="form-control">
                                           
                                        </div>
                                    </div>
                                </div>

                                <hr class="divider">

                                {{-- Section livraison --}}
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="bi bi-geo-alt"></i>
                                        Adresse de livraison
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                Commune de livraison <span class="required-asterisk">*</span>
                                            </label>
                                            <select name="commune" id="commune" class="form-select" required>
                                                <option value="">-- Choisir une commune --</option>
                                                @foreach ($communes as $commune)
                                                    <option data-frais="{{ $commune->frais_de_port }}" value="{{ $commune->id }}">
                                                        {{ $commune->libelle }} - {{ number_format($commune->frais_de_port, 0, ',', ' ') }} FCFA
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Veuillez choisir une commune de livraison.
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">
                                                Quartier (lieu exact) <span class="required-asterisk">*</span>
                                            </label>
                                            <input type="text" name="quartier" class="form-control" 
                                                placeholder="Ex: Cocody Riviera 2, près du restaurant..." required>
                                            <div class="invalid-feedback">
                                                Veuillez indiquer le quartier de livraison.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Section code promo --}}
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="bi bi-percent"></i>
                                        Code promotionnel
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Code promo (optionnel)</label>
                                        <div class="input-group">
                                            <input type="text" name="code_promo" class="form-control" 
                                                placeholder="Entrez votre code promo">
                                            <button type="button" class="btn btn-promo">
                                                <i class="bi bi-check-circle me-1"></i>Appliquer
                                            </button>
                                        </div>
                                        <small class="form-text text-muted mt-1">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Si vous avez un code promo, veuillez l'indiquer ici.
                                        </small>
                                    </div>
                                </div>

                                {{-- Champs cachés --}}
                                <input type="hidden" name="frais_livraison" id="frais_livraison_input" value="0">
                                <input type="hidden" name="sous_total" id="sous_total_input" value="{{ $totalPanier }}">
                                <input type="hidden" name="total_general" id="total_general_input" value="{{ $totalPanier }}">

                                {{-- Bouton de validation --}}
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-confirmer">
                                        <i class="bi bi-shield-check me-2"></i>
                                        Confirmer ma commande
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        $(function() {
            // Au changement de commune, récupère le frais et met à jour le total
            $('#commune').on('change', function() {
                let frais = parseInt($(this).find(':selected').data('frais')) || 0;
                $('#frais-livraison').text(frais.toLocaleString('fr-FR'));

                // Met à jour le prix de livraison
                $('#frais_livraison_input').val(frais);

                // Récupère le sous-total
                let sousTotal = parseInt($('td[data-totalPanier]').data('totalpanier')) || 0;

                // Calcule le total général
                let totalGeneral = sousTotal + frais;

                // Met à jour le champ caché du total général
                $('#total_general_input').val(totalGeneral);

                // Ajoute ou met à jour la ligne du total général
                if ($('#total-general-row').length === 0) {
                    $('.table-commande tfoot').append(
                        `<tr id="total-general-row">
                            <td colspan="3" class="text-end">
                                <i class="bi bi-receipt me-1"></i>Total général :
                            </td>
                            <td class="text-center">
                                <span id="total-general">${totalGeneral.toLocaleString('fr-FR')}</span> FCFA
                            </td>
                        </tr>`
                    );
                } else {
                    $('#total-general').text(totalGeneral.toLocaleString('fr-FR'));
                }
            });

            // Déclenche le calcul au chargement si une commune est déjà sélectionnée
            $('#commune').trigger('change');

            // Confirmation avant validation de la commande
            $('form').on('submit', function(e) {
                // Vérification HTML5 des champs requis
                if (!this.checkValidity()) {
                    this.classList.add('was-validated');
                    return; // Ne lance pas la confirmation si le formulaire est invalide
                }

                e.preventDefault();
                Swal.fire({
                    title: 'Confirmer la commande ?',
                    text: "Voulez-vous vraiment valider cette commande ?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#2a6b2a',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, valider',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    </script>
@endpush
@endsection