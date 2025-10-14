{{-- filepath: resources/views/frontend/pages/commande/caisse.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Validation de commande')

@section('content')
    <div class="container py-5">
        <h2 class="fw-bold mb-4 text-center" style="color: #2a6b2a;">Valider ma commande</h2>
        <div class="row justify-content-center g-4">
            <!-- Afficher un message de session -->
            @include('frontend.components.message_session')
            <!-- Bloc panier -->
            <div class="col-lg-6">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <h5 class="mb-3 fw-bold">Résumé de la commande</h5>
                    <div class="table-responsive mb-3">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Produit</th>
                                    <th class="text-center">Quantité</th>
                                    <th class="text-center">Prix Unitaire</th>
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
                                        <td>
                                            <span class="fw-bold">{{ $item->libelle }}</span>
                                        </td>
                                        <td class="text-center">{{ $item->quantite }}</td>
                                        <td class="text-center">{{ number_format($item->prix_de_vente, 0, ',', ' ') }} FCFA
                                        </td>
                                        <td class="text-center fw-bold">
                                            {{ number_format($item->prix_de_vente * $item->quantite, 0, ',', ' ') }} FCFA
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Sous-Total :</td>
                                    <td data-totalPanier="{{ $totalPanier }}" class="text-center fw-bold"
                                        style="font-size:1.2em;">
                                        {{ number_format($totalPanier, 0, ',', ' ') }}
                                        FCFA
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Livraison :</td>
                                    <td class="text-center fw-bold" style="font-size:1.2em;">
                                        <span id="frais-livraison">0</span> FCFA
                                    </td>
                                </tr>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Bloc infos utilisateur -->
            <div class="col-lg-6">

                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <form action="{{ route('panier.commande.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <h5 class="mb-3 fw-bold">Informations client</h5>
                        <!-- Afficher les erreurs de validation -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom & Prénoms <span class="text-danger">*</span></label>
                                <input type="text" name="username" value="{{ Auth::user()->username ?? '' }}"
                                    class="form-control" required>
                                <div class="invalid-feedback">
                                    Veuillez indiquer votre nom et prénoms.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Contact <span class="text-danger">*</span></label>
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
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}"
                                    class="form-control">
                            </div>

                            <hr class="mb-4" style="height: 5px; background-color: #2a6b2a; border: none;">
                            <div class="col-md-6">
                                <label class="form-label">Commune de livraison <span class="text-danger">*</span></label>
                                <select name="commune" id="commune" class="form-select" required>
                                    <option value="">-- Choisir une commune --</option>
                                    @foreach ($communes as $commune)
                                        <option data-frais="{{ $commune->frais_de_port }}" value="{{ $commune->id }}">
                                            {{ $commune->libelle }} - {{ $commune->frais_de_port }} FCFA</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez choisir une commune de livraison.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Quartier (preciser le lieu exact) <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="quartier" class="form-control" required>
                                <div class="invalid-feedback">
                                    Veuillez indiquer le quartier de livraison.
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Code promo</label>
                                <div class="input-group">
                                    <input type="text" name="code_promo" class="form-control">
                                    <a href="#" class="btn btn-dark">Appliquer</a>
                                </div>
                                <small class="form-text text-muted">Si vous avez un code promo, veuillez l'indiquer
                                    ici.</small>

                            </div>


                            <!-- Informations formulaire caché pour prix de livraison et sous-total , et total general -->
                            <input type="hidden" name="frais_livraison" id="frais_livraison_input" value="0">
                            <input type="hidden" name="sous_total" id="sous_total_input" value="{{ $totalPanier }}">
                            <input type="hidden" name="total_general" id="total_general_input"
                                value="{{ $totalPanier }}">
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-5 fw-bold">
                                <i class="bi bi-check-circle"></i> Confirmer ma commande
                            </button>
                        </div>
                    </form>
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
                    $('#frais-livraison').text(frais);

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
                        $('.table tfoot').append(
                            `<tr id="total-general-row">
                    <td colspan="3" class="text-end fw-bold">Total général :</td>
                    <td class="text-center fw-bold" style="font-size:1.2em;">
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
