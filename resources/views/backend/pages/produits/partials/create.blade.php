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

    <div class="row">
        <!-- Formulaire principal à gauche -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Créer un produit</h5>
                </div>
                <!--Afficher les erreurs de validation-->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('produit.store') }}" method="POST" class="needs-validation"
                        enctype="multipart/form-data" id="productForm" novalidate>
                        @csrf

                        <div class="row">
                            <div class="col-lg-8">

                                <!-- Informations de base -->
                                <div class="row g-3 mb-4">

                                    <div class="col-md-6">
                                        <label for="libelle" class="form-label">Libellé <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="libelle" id="libelle" class="form-control"
                                            value="{{ old('libelle') }}" required>
                                        @error('libelle')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <label for="categorie_id" class="form-label">Catégorie <span
                                                class="text-danger">*</span></label>
                                        <select name="categorie_id" id="categorie_id" class="form-select" required>
                                            <option value="">-- Sélectionner une catégorie --</option>
                                            @foreach ($categories as $categorie)
                                                <option value="{{ $categorie->id }}"
                                                    {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                                    {{ $categorie->libelle }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('categorie_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                </div>


                                <!-- Prix et Stock -->
                                <div class="row g-3 mb-4">

                                    <div class="col-md-4">
                                        <label for="prix_de_vente" class="form-label">Prix de vente <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" step="0.01" name="prix_de_vente" id="prix_de_vente"
                                                class="form-control" value="{{ old('prix_de_vente') }}" required>
                                            <span class="input-group-text">FCFA</span>
                                        </div>
                                        @error('prix_de_vente')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" name="stock" id="stock" class="form-control"
                                            value="{{ old('stock', 0) }}" min="0">
                                        @error('stock')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="type_offre_id" class="form-label">Type d'offre <span
                                                class="text-danger">*</span></label>
                                        <select name="type_offre_id" id="type_offre_id" class="form-select">
                                            <option value="">-- Sélectionner un type d'offre --</option>
                                            @foreach ($typeoffres as $offre)
                                                <option value="{{ $offre->id }}"
                                                    {{ old('type_offre_id') == $offre->id ? 'selected' : '' }}>
                                                    {{ $offre->libelle }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type_offre_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Réduction -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Gestion des réductions</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3 mb-3">
                                            <div class="col-md-6">
                                                <label for="type_reduction" class="form-label">Type de réduction</label>
                                                <select name="type_reduction" id="type_reduction" class="form-select">
                                                    <option value="">-- Aucune réduction --</option>
                                                    <option value="montant"
                                                        {{ old('type_reduction') == 'montant' ? 'selected' : '' }}>
                                                        Montant fixe
                                                    </option>
                                                    <option value="pourcentage"
                                                        {{ old('type_reduction') == 'pourcentage' ? 'selected' : '' }}>
                                                        Pourcentage
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="valeur_reduction" class="form-label">Valeur réduction</label>
                                                <input type="number" step="0.01" name="valeur_reduction"
                                                    id="valeur_reduction" class="form-control"
                                                    value="{{ old('valeur_reduction') }}">
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="date_debut_reduction" class="form-label">Date début
                                                    réduction</label>
                                                <input type="date" name="date_debut_reduction" id="date_debut_reduction"
                                                    class="form-control" value="{{ old('date_debut_reduction') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="date_fin_reduction" class="form-label">Date fin
                                                    réduction</label>
                                                <input type="date" name="date_fin_reduction" id="date_fin_reduction"
                                                    class="form-control" value="{{ old('date_fin_reduction') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Paramètres -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="visibilite" class="form-label">Visibilité</label>
                                        <select name="visibilite" id="visibilite" class="form-select">
                                            <option value="1" {{ old('visibilite', 1) == 1 ? 'selected' : '' }}>
                                                Visible
                                            </option>
                                            <option value="0" {{ old('visibilite', 1) == 0 ? 'selected' : '' }}>Caché
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="statut" class="form-label">Statut</label>
                                        <select name="statut" id="statut" class="form-select">
                                            <option value="1" {{ old('statut', 1) == 1 ? 'selected' : '' }}>Actif
                                            </option>
                                            <option value="0" {{ old('statut', 1) == 0 ? 'selected' : '' }}>Inactif
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" rows="5" class="form-control"
                                        placeholder="Décrivez votre produit...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>




                            <!-- Gestion des images à droite -->
                            <div class="col-lg-4">
                                <!-- Image principale -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">
                                            <i class="bi bi-image"></i> Image principale
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="image_principale" class="form-label">Choisir l'image
                                                principale</label>
                                            <input type="file" name="image_principale" id="image_principale"
                                                class="form-control" accept="image/*" required>
                                            <div class="form-text">
                                                Formats acceptés: JPG, PNG, GIF. Taille max: 1MB
                                            </div>
                                        </div>

                                        <!-- Aperçu de l'image principale -->
                                        <div id="preview-principale" class="text-center">
                                            <img id="img-preview-principale" src="" alt="Aperçu"
                                                class="img-fluid rounded border"
                                                style="max-height: 200px; display: none;">
                                            <div id="default-icon-principale" class="text-muted"
                                                style="font-size: 80px;">
                                                <i class="bi bi-image"></i>
                                            </div>
                                            <div class="mt-2" id="btn-remove-principale" style="display: none;">
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    onclick="removeImagePreview('principale')">
                                                    <i class="bi bi-trash"></i> Supprimer
                                                </button>
                                            </div>
                                        </div>
                                        <div id="images-error-principale" class="text-danger mt-1" style="display:none;">
                                        </div>


                                    </div>
                                </div>

                                <!-- Images multiples -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">
                                            <i class="bi bi-images"></i> Images multiples
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="images" class="form-label">Choisir des images</label>
                                            <input type="file" name="autre_images[]" id="images"
                                                class="form-control" accept="image/*" multiple>
                                            <div class="form-text">
                                                Formats acceptés: JPG, PNG, GIF. Taille max par image: 1MB
                                            </div>
                                        </div>

                                        <!-- Aperçu des images sélectionnées -->
                                        <div id="images-preview" class="row g-2 mt-2"></div>
                                        <div id="images-error" class="text-danger mt-1" style="display:none;"></div>


                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('produit.index') }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            // Image principale
            $('#image_principale').on('change', function() {
                const file = this.files[0];
                const img = $('#img-preview-principale');
                const icon = $('#default-icon-principale');
                const btnRemove = $('#btn-remove-principale');
                if (file) {
                    if (file.size > 1024 * 1024) {
                        $('#images-error-principale').text("La taille de l'image ne doit pas dépasser 1MB.")
                            .show();
                        $(this).val('');
                        img.hide();
                        icon.show();
                        btnRemove.hide();
                        return;
                    } else {
                        $('#images-error-principale').hide();
                    }
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.attr('src', e.target.result).show();
                        icon.hide();
                        btnRemove.show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    img.hide();
                    icon.show();
                    btnRemove.hide();
                }
            });

            // Affiche l'icône par défaut au chargement
            $('#img-preview-principale').hide();
            $('#default-icon-principale').show();
            $('#btn-remove-principale').hide();

            window.removeImagePreview = function(type) {
                if (type === 'principale') {
                    $('#image_principale').val('');
                    $('#img-preview-principale').attr('src', '').hide();
                    $('#default-icon-principale').show();
                    $('#btn-remove-principale').hide();
                    $('#images-error-principale').hide();
                }
            };






            // Images multiples
            let multiImages = [];

            $('#images').on('change', function(e) {
                const newFiles = Array.from(e.target.files);
                const previewZone = $('#images-preview');
                const errorDiv = $('#images-error');
                errorDiv.hide();

                multiImages = multiImages.concat(newFiles);
                multiImages = multiImages.filter((file, idx, arr) =>
                    arr.findIndex(f => f.name === file.name && f.size === file.size) === idx
                );

                if (multiImages.length > 5) {
                    errorDiv.text("Vous ne pouvez sélectionner que 5 images maximum.").show();
                    multiImages = multiImages.slice(0, 5);
                }

                for (let file of multiImages) {
                    if (file.size > 1024 * 1024) {
                        errorDiv.text("La taille de chaque image ne doit pas dépasser 1MB.").show();
                        multiImages = multiImages.filter(f => f.size <= 1024 * 1024);
                        break;
                    }
                }

                let dt = new DataTransfer();
                multiImages.forEach(f => dt.items.add(f));
                $('#images')[0].files = dt.files;

                previewZone.empty();
                if (multiImages.length === 0) {
                    // Affiche 5 icônes par défaut si aucune image
                    for (let i = 0; i < 5; i++) {
                        previewZone.append(`
                    <div class="col-6 mb-2 text-center text-muted" style="font-size:60px;">
                        <i class="bi bi-image"></i>
                    </div>
                `);
                    }
                } else {
                    multiImages.forEach(function(file, idx) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const col = $(`
                        <div class="col-6 mb-2" data-idx="${idx}">
                            <div class="text-center">
                                <img src="${e.target.result}" class="img-fluid rounded border" style="max-height:120px;">
                                <div class="mt-1">
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-multi-img">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                    `);
                            previewZone.append(col);
                        };
                        reader.readAsDataURL(file);
                    });
                }
            });

            $('#images-preview').on('click', '.remove-multi-img', function() {
                const idx = $(this).closest('[data-idx]').data('idx');
                multiImages.splice(idx, 1);
                let dt = new DataTransfer();
                multiImages.forEach(f => dt.items.add(f));
                $('#images')[0].files = dt.files;
                $('#images').trigger('change');
            });

            // Affiche les icônes par défaut au chargement
            $('#images').trigger('change');
        });
    </script>
@endsection
