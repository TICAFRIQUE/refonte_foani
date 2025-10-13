{{-- filepath: resources/views/frontend/pages/commande/caisse.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Validation de commande')

@section('content')
    <div class="container py-5">
        <h2 class="fw-bold mb-4 text-center" style="color: #2a6b2a;">Valider ma commande</h2>
        <div class="row justify-content-center g-4">
            <!-- Bloc infos utilisateur -->
            <div class="col-lg-6">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <form action="#" method="POST">
                        @csrf
                        <h5 class="mb-3 fw-bold">Informations client</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom & Prénoms <span class="text-danger">*</span></label>
                                <input type="text" name="username" value="{{ Auth::user()->username ?? '' }}"
                                    class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Contact <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">+225</span>
                                    <input type="text" name="phone" value="{{ Auth::user()->phone ?? '' }}"
                                        class="form-control" required>

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
                                    <option value="0">-- Commune --</option>
                                    @foreach ($communes as $commune)
                                        <option value="{{ $commune->id }}">{{ $commune->libelle }} - {{ $commune->frais_de_port }} FCFA</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Quartier de livraison <span class="text-danger">*</span></label>
                                <input type="text" name="quartier" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Code promo</label>
                                <input type="text" name="code_promo" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 text-center">
                            <a href="}" class="btn btn-outline-primary me-2">
                                <i class="bi bi-person"></i> Se connecter
                            </a>
                            <a href="" class="btn btn-outline-success">
                                <i class="bi bi-person-plus"></i> S'inscrire
                            </a>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-5 fw-bold">
                                <i class="bi bi-check-circle"></i> Confirmer ma commande
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
                                    <td colspan="3" class="text-end fw-bold">Total :</td>
                                    <td class="text-center fw-bold" style="font-size:1.2em;">
                                        {{ number_format(array_sum(array_map(fn($item) => $item->prix_de_vente * $item->quantite, $panier)), 0, ',', ' ') }}
                                        FCFA
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
