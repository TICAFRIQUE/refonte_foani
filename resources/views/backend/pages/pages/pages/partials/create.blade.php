@extends('backend.layouts.master')

@section('title', 'Créer une page')

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Pages
        @endslot
        @slot('title')
            Créer une page
        @endslot
    @endcomponent

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Créer une nouvelle page</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-4">
                            {{-- Colonne gauche : texte --}}
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <label for="libelle" class="form-label fw-bold">Libellé <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="libelle" id="libelle" class="form-control"
                                            value="{{ old('libelle') }}" required>
                                        @error('libelle')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="id_categorie_page" class="form-label fw-bold">Catégorie <span
                                                class="text-danger">*</span></label>
                                        <select name="categorie_page_id" class="form-select" required>
                                            <option value="">--- Sélectionner ---</option>
                                            @foreach ($categories as $categorie)
                                                <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="contenu" class="form-label fw-bold">Description</label>
                                    <textarea name="description" id="ckeditor-classic"></textarea>
                                </div>
                            </div>
                            {{-- Colonne droite : Image et options --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="formFile" name="image"
                                        accept="image/*" required>
                                    <div class="mt-2 position-relative" style="display: inline-block;">
                                        <img id="previewImage" src="#" alt="Aperçu"
                                            style="max-width: 200px; display: none;" />
                                        <button type="button" id="removeImageBtn" class="btn btn-danger btn-sm"
                                            style="position: absolute; top: 5px; right: 5px; display: none;">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="mot_cle" class="form-label fw-bold">Mot clé</label>
                                    <input type="text" name="mot_cle" id="mot_cle" class="form-control"
                                        value="{{ old('mot_cle') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="statut" class="form-label fw-bold">Statut</label>
                                    <select name="statut" id="statut" class="form-select">
                                        <option value="1">Actif</option>
                                        <option value="0">Inactif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-success px-4 w-75">Créer</button>
                            <a href="{{ route('pages.index') }}" class="btn btn-secondary px-4">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- CKEditor -->
    <script src="{{ URL::asset('build/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/ecommerce-product-create.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Aperçu et suppression de l'image principale
            $('#formFile').on('change', function(e) {
                const [file] = this.files;
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImage').attr('src', e.target.result).show();
                        $('#removeImageBtn').show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#previewImage').hide();
                    $('#removeImageBtn').hide();
                }
            });

            $('#removeImageBtn').on('click', function() {
                $('#formFile').val('');
                $('#previewImage').attr('src', '#').hide();
                $(this).hide();
            });
        });
    </script>
@endsection

@endsection
