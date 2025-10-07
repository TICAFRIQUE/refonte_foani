@extends('backend.layouts.master')

@section('title', 'Créer un Produit')

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Produits
        @endslot
        @slot('title')
          Produit
        @endslot
    @endcomponent

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Ajouter un nouveau produit</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('produit.store') }}" method="POST">
                @csrf

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="date_debut_reduction" class="form-label">Début réduction</label>
                        <input type="date" name="date_debut_reduction" id="date_debut_reduction" class="form-control"
                            value="{{ old('date_debut_reduction') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="date_fin_reduction" class="form-label">Fin réduction</label>
                        <input type="date" name="date_fin_reduction" id="date_fin_reduction" class="form-control"
                            value="{{ old('date_fin_reduction') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="libelle" class="form-label">Libellé</label>
                        <input type="text" name="libelle" id="libelle" class="form-control"
                            value="{{ old('libelle') }}">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="categorie_id" class="form-label">Catégorie</label>
                        <select name="categorie_id" id="categorie_id" class="form-select" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}"
                                    {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="type_offre_id" class="form-label">Type d’offre</label>
                        <select name="type_offre_id" id="type_offre_id" class="form-select" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach ($typeoffres as $offre)
                                <option value="{{ $offre->id }}"
                                    {{ old('type_offre_id') == $offre->id ? 'selected' : '' }}>
                                    {{ $offre->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="prix_achat" class="form-label">Prix d’achat</label>
                        <input type="number" step="0.01" name="prix_achat" id="prix_achat" class="form-control"
                            value="{{ old('prix_achat') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="prix_de_vente" class="form-label">Prix de vente</label>
                        <input type="number" step="0.01" name="prix_de_vente" id="prix_de_vente" class="form-control"
                            value="{{ old('prix_de_vente') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="frais_de_port" class="form-label">Frais de port</label>
                        <input type="number" step="0.01" name="frais_de_port" id="frais_de_port" class="form-control"
                            value="{{ old('frais_de_port', 0) }}">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control"
                            value="{{ old('stock', 0) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="type_reduction" class="form-label">Type de réduction</label>
                        <select name="type_reduction" id="type_reduction" class="form-select">
                            <option value="">-- Aucun --</option>
                            <option value="montant" {{ old('type_reduction') == 'montant' ? 'selected' : '' }}>Montant fixe
                            </option>
                            <option value="pourcentage" {{ old('type_reduction') == 'pourcentage' ? 'selected' : '' }}>
                                Pourcentage</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="valeur_reduction" class="form-label">Valeur réduction</label>
                        <input type="number" step="0.01" name="valeur_reduction" id="valeur_reduction"
                            class="form-control" value="{{ old('valeur_reduction') }}">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="visibilite" class="form-label">Visibilité</label>
                        <select name="visibilite" id="visibilite" class="form-select">
                            <option value="1" {{ old('visibilite', 1) == 1 ? 'selected' : '' }}>Visible</option>
                            <option value="0" {{ old('visibilite', 1) == 0 ? 'selected' : '' }}>Caché</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="statut" class="form-label">Statut</label>
                        <select name="statut" id="statut" class="form-select">
                            <option value="1" {{ old('statut', 1) == 1 ? 'selected' : '' }}>Actif</option>
                            <option value="0" {{ old('statut', 1) == 0 ? 'selected' : '' }}>Inactif</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('produit.index') }}" class="btn btn-secondary ms-2">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection
