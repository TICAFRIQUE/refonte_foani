@extends('backend.layouts.master')

@section('title', 'Liste des Produits')

@section('content')
   
    <div class="container-fluid py-4">

        {{-- Messages de succès ou erreur --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">Liste des Produits</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProduitModal">
                <i class="bi bi-plus-circle"></i> Ajouter un produit
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Libellé</th>
                            <th>Catégorie</th>
                            <th>Prix de vente</th>
                            <th>Stock</th>
                            <th>Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produits as $produit)
                            <tr>
                                {{-- image sera generer --}}
                                {{-- Image --}}
                                <td>
                                    @if ($produit->image)
                                        <img src="{{ asset('storage/' . $produit->image) }}" alt="Image produit"
                                            class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">vide</span>
                                    @endif
                                </td>

                                {{-- Infos produit --}}
                                <td>{{ $produit->libelle }}</td>
                                <td>{{ $produit->categories?->libelle ?? '—' }}</td>
                                <td>{{ number_format($produit->prix_de_vente) }} F</td>
                                <td>{{ $produit->stock }}</td>
                                <td>{{ $produit->created_at->format('d/m/Y') }}</td>

                                {{-- Actions --}}
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-soft-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item btn-edit" data-id="{{ $produit->id }}">
                                                    <i class="ri-pencil-fill me-2"></i> Modifier
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('produit.delete', $produit->id) }}" method="POST"
                                                    onsubmit="return confirm('Supprimer ce produit ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="ri-delete-bin-fill me-2"></i> Supprimer
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Aucun produit trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-3">
                    {!! $produits->links() !!}
                </div>
            </div>
        </div>


    </div>

    {{-- Modal Create Produit --}}
    <div class="modal fade" id="createProduitModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Ajouter un Produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('produit.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="code" class="form-label">Code Produit (SKU)</label>
                                <input type="text" name="code" id="code" class="form-control"
                                    value="{{ old('code') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="libelle" class="form-label">Libellé</label>
                                <input type="text" name="libelle" id="libelle" class="form-control"
                                    value="{{ old('libelle') }}">
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
                                <input type="number" step="0.01" name="prix_achat" id="prix_achat"
                                    class="form-control" value="{{ old('prix_achat') }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="prix_de_vente" class="form-label">Prix de vente</label>
                                <input type="number" step="0.01" name="prix_de_vente" id="prix_de_vente"
                                    class="form-control" value="{{ old('prix_de_vente') }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="frais_de_port" class="form-label">Frais de port</label>
                                <input type="number" step="0.01" name="frais_de_port" id="frais_de_port"
                                    class="form-control" value="{{ old('frais_de_port', 0) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" name="stock" id="stock" class="form-control"
                                    value="{{ old('stock', 0) }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="type_reduction" class="form-label">Type de réduction</label>
                                <select name="type_reduction" id="type_reduction" class="form-select">
                                    <option value="">-- Aucun --</option>
                                    <option value="montant" {{ old('type_reduction') == 'montant' ? 'selected' : '' }}>
                                        Montant fixe</option>
                                    <option value="pourcentage"
                                        {{ old('type_reduction') == 'pourcentage' ? 'selected' : '' }}>Pourcentage</option>
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
                                <input type="date" name="date_fin_reduction" id="date_fin_reduction"
                                    class="form-control" value="{{ old('date_fin_reduction') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="visibilite" class="form-label">Visibilité</label>
                                <select name="visibilite" id="visibilite" class="form-select">
                                    <option value="1" {{ old('visibilite', 1) == 1 ? 'selected' : '' }}>Visible
                                    </option>
                                    <option value="0" {{ old('visibilite', 1) == 0 ? 'selected' : '' }}>Caché
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
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
                            <button type="button" class="btn btn-secondary ms-2"
                                data-bs-dismiss="modal">Annuler</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
