{{-- filepath: resources/views/frontend/pages/commande/reservation.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Réservation de produit')

@section('content')
    <div class="container py-5">
        <h2 class="fw-bold mb-4 text-center" style="color:#2a6b2a;">Réserver un produit</h2>
        <div class="row justify-content-center">
            @include('frontend.components.message_session')
            
            <div class="col-lg-10">
                <div class="bg-white p-4 rounded shadow-sm">
                    <form action="{{ route('reservation.store' , $produit->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <h5 class="mb-3 fw-bold">Informations client</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Nom & Prénoms <span class="text-danger">*</span></label>
                                <input type="text" name="nom" value="{{ Auth::user()->username }}"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Téléphone <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">+225</span>
                                    <input type="text" name="telephone" value="{{ Auth::user()->phone }}"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email</label>
                                <input type="email" value="{{ Auth::user()->email ?? old('email') }}" name="email"
                                    class="form-control">
                            </div>
                        </div>

                        <h5 class="mb-3 fw-bold">Produit à réserver</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Produit <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $produit->libelle }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Prix (FCFA) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $produit->prix_de_vente }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Quantité <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-secondary btn-decrease">-</button>
                                    <input type="number" name="quantite" class="form-control text-center" min="1"
                                        value="1" required>
                                    <button type="button" class="btn btn-outline-secondary btn-increase">+</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Total (FCFA) <span class="text-danger">*</span></label>
                                    <input type="text" id="total" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Commune <span class="text-danger">*</span></label>
                                <select name="commune_id" class="form-select" required>
                                    <option value="">Sélectionner une commune</option>
                                    @foreach ($communes as $commune)
                                        <option data-frais="{{ $commune->frais_de_port }}" value="{{ $commune->id }}">{{ $commune->libelle }} {{ $commune->frais_de_port > 0 ? ' (' . $commune->frais_de_port . ' FCFA)' : '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Quartier <span class="text-danger">*</span></label>
                                <input type="text" name="quartier" class="form-control" required>
                            </div>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Commentaire</label>
                            <textarea name="commentaire" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-3">
                                <div class="border rounded p-3 text-center bg-light">
                                    <span class="fw-bold">Total produit :</span>
                                    <span id="total-produit">{{ $produit->prix_de_vente }} FCFA</span><br>
                                    <span class="fw-bold">Frais de livraison :</span>
                                    <span id="frais-livraison">0 FCFA</span><br>
                                    <span class="fw-bold">Total à payer :</span>
                                    <span id="total-general">{{ $produit->prix_de_vente }} FCFA</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-5 fw-bold">
                                <i class="bi bi-clock"></i> Réserver
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
    let prix = {{ $produit->prix_de_vente }};
    function updateTotal() {
        let qte = parseInt($('input[name="quantite"]').val()) || 1;
        if (qte < 1) qte = 1;
        $('input[name="quantite"]').val(qte);
        let totalProduit = prix * qte;
        $('#total').val(totalProduit > 0 ? totalProduit.toLocaleString('fr-FR') + ' FCFA' : '');
        $('#total-produit').text(totalProduit.toLocaleString('fr-FR') + ' FCFA');

        let frais = parseInt($('select[name="commune_id"] option:selected').data('frais')) || 0;
        $('#frais-livraison').text(frais.toLocaleString('fr-FR') + ' FCFA');

        let totalGeneral = totalProduit + frais;
        $('#total-general').text(totalGeneral.toLocaleString('fr-FR') + ' FCFA');
    }
    $('input[name="quantite"]').on('input', updateTotal);
    $('select[name="commune_id"]').on('change', updateTotal);

    $('.btn-increase').on('click', function() {
        let input = $(this).siblings('input[name="quantite"]');
        let val = parseInt(input.val()) || 1;
        input.val(val + 1).trigger('input');
    });
    $('.btn-decrease').on('click', function() {
        let input = $(this).siblings('input[name="quantite"]');
        let val = parseInt(input.val()) || 1;
        if (val > 1) input.val(val - 1).trigger('input');
    });

    $('form').on('submit', function(e) {
        let totalGeneral = $('#total-general').text().replace(/[^\d]/g, '');
        totalGeneral = parseInt(totalGeneral) || 0;
        if (totalGeneral < 5000) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Montant insuffisant',
                text: 'Le montant total à payer doit être au moins 5 000 FCFA pour valider la réservation.'
            });
            return false;
        }
    });

    updateTotal(); // Calcul au chargement
});
</script>
    
@endpush
@endsection


