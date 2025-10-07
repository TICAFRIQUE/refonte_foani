@extends('backend.layouts.master')

@section('title', 'Editer Produit')

@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" />
@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Produits
        @endslot
        @slot('title')
            Modifier un produit
        @endslot
    @endcomponent

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Modifier le produit : {{ $produit->libelle }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('produit.update', $produit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="libelle" class="form-label">Libellé</label>
                        <input type="text" name="libelle" id="libelle" class="form-control"
                            value="{{ old('libelle', $produit->libelle) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="categorie_id" class="form-label">Catégorie</label>
                        <select name="categorie_id" id="categorie_id" class="form-select" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}"
                                    {{ old('categorie_id', $produit->categorie_id) == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="type_offre_id" class="form-label">Type d’offre</label>
                        <select name="type_offre_id" id="type_offre_id" class="form-select" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach ($typeoffres as $offre)
                                <option value="{{ $offre->id }}"
                                    {{ old('type_offre_id', $produit->type_offre_id) == $offre->id ? 'selected' : '' }}>
                                    {{ $offre->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        <label for="prix_achat" class="form-label">Prix d’achat</label>
                        <input type="number" step="0.01" name="prix_achat" id="prix_achat" class="form-control"
                            value="{{ old('prix_achat', $produit->prix_achat) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="prix_de_vente" class="form-label">Prix de vente</label>
                        <input type="number" step="0.01" name="prix_de_vente" id="prix_de_vente" class="form-control"
                            value="{{ old('prix_de_vente', $produit->prix_de_vente) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="frais_de_port" class="form-label">Frais de port</label>
                        <input type="number" step="0.01" name="frais_de_port" id="frais_de_port" class="form-control"
                            value="{{ old('frais_de_port', $produit->frais_de_port) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control"
                            value="{{ old('stock', $produit->stock) }}">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        <label for="type_reduction" class="form-label">Type de réduction</label>
                        <select name="type_reduction" id="type_reduction" class="form-select">
                            <option value="">-- Aucun --</option>
                            <option value="montant"
                                {{ old('type_reduction', $produit->type_reduction) == 'montant' ? 'selected' : '' }}>
                                Montant fixe</option>
                            <option value="pourcentage"
                                {{ old('type_reduction', $produit->type_reduction) == 'pourcentage' ? 'selected' : '' }}>
                                Pourcentage</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="valeur_reduction" class="form-label">Valeur réduction</label>
                        <input type="number" step="0.01" name="valeur_reduction" id="valeur_reduction"
                            class="form-control" value="{{ old('valeur_reduction', $produit->valeur_reduction) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="date_debut_reduction" class="form-label">Début réduction</label>
                        <input type="date" name="date_debut_reduction" id="date_debut_reduction" class="form-control"
                            value="{{ old('date_debut_reduction', $produit->date_debut_reduction) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="date_fin_reduction" class="form-label">Fin réduction</label>
                        <input type="date" name="date_fin_reduction" id="date_fin_reduction" class="form-control"
                            value="{{ old('date_fin_reduction', $produit->date_fin_reduction) }}">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="visibilite" class="form-label">Visibilité</label>
                        <select name="visibilite" id="visibilite" class="form-select">
                            <option value="1" {{ old('visibilite', $produit->visibilite) == 1 ? 'selected' : '' }}>
                                Visible</option>
                            <option value="0" {{ old('visibilite', $produit->visibilite) == 0 ? 'selected' : '' }}>
                                Caché</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="statut" class="form-label">Statut</label>
                        <select name="statut" id="statut" class="form-select">
                            <option value="1" {{ old('statut', $produit->statut) == 1 ? 'selected' : '' }}>Actif
                            </option>
                            <option value="0" {{ old('statut', $produit->statut) == 0 ? 'selected' : '' }}>Inactif
                            </option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $produit->description) }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('produit.index') }}" class="btn btn-secondary ms-2">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection
