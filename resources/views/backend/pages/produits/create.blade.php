@extends('backend.layouts.master')

@section('title', 'Ajouter un Produit')

@section('content')
    <div class="container py-4">
        <h2 class="fw-bold mb-4">Ajouter un Produit</h2>

        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <form action="{{ route('produit.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label">Code Produit</label>
                            <input type="text" name="code" id="code"
                                class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}"
                                required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="libelle" class="form-label">Libellé</label>
                            <input type="text" name="libelle" id="libelle"
                                class="form-control @error('libelle') is-invalid @enderror" value="{{ old('libelle') }}"
                                required>
                            @error('libelle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
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

                        <div class="col-md-6 mb-3">
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

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="prix_achat" class="form-label">Prix d’achat</label>
                            <input type="number" step="0.01" name="prix_achat" id="prix_achat" class="form-control"
                                value="{{ old('prix_achat') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="prix_de_vente" class="form-label">Prix de vente</label>
                            <input type="number" step="0.01" name="prix_de_vente" id="prix_de_vente"
                                class="form-control" value="{{ old('prix_de_vente') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="frais_de_port" class="form-label">Frais de port</label>
                            <input type="number" step="0.01" name="frais_de_port" id="frais_de_port"
                                class="form-control" value="{{ old('frais_de_port') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" name="stock" id="stock" class="form-control"
                                value="{{ old('stock') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="type_reduction" class="form-label">Type de réduction</label>
                            <select name="type_reduction" id="type_reduction" class="form-select">
                                <option value="">-- Aucun --</option>
                                <option value="pourcentage" {{ old('type_reduction') == 'pourcentage' ? 'selected' : '' }}>
                                    Pourcentage</option>
                                <option value="montant" {{ old('type_reduction') == 'montant' ? 'selected' : '' }}>Montant
                                    fixe</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="valeur_reduction" class="form-label">Valeur réduction</label>
                            <input type="number" step="0.01" name="valeur_reduction" id="valeur_reduction"
                                class="form-control" value="{{ old('valeur_reduction') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date_debut_reduction" class="form-label">Début réduction</label>
                            <input type="date" name="date_debut_reduction" id="date_debut_reduction"
                                class="form-control" value="{{ old('date_debut_reduction') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date_fin_reduction" class="form-label">Fin réduction</label>
                            <input type="date" name="date_fin_reduction" id="date_fin_reduction" class="form-control"
                                value="{{ old('date_fin_reduction') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="visibilite" class="form-label">Visibilité</label>
                            <select name="visibilite" id="visibilite" class="form-select" required>
                                <option value="1" {{ old('visibilite') == 1 ? 'selected' : '' }}>Visible</option>
                                <option value="0" {{ old('visibilite') == 0 ? 'selected' : '' }}>Caché</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select name="statut" id="statut" class="form-select" required>
                                <option value="1" {{ old('statut') == 1 ? 'selected' : '' }}>Actif</option>
                                <option value="0" {{ old('statut') == 0 ? 'selected' : '' }}>Inactif</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('produit.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
