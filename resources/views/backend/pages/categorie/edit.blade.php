@extends('backend.layouts.master')

@section('title', 'Modifier une catégorie')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Modifier une catégorie</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('categorie.index') }}">Catégories</a></li>
                            <li class="breadcrumb-item active">Modifier</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire sur toute la largeur -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Modifier la catégorie</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('categorie.update', $categorie->id) }}">
                            @csrf
                            @method('POST')

                            <!-- Libellé -->
                            <div class="mb-3">
                                <label for="libelle" class="form-label">Libellé <span class="text-danger">*</span></label>
                                <input type="text" name="libelle" id="libelle"
                                    class="form-control @error('libelle') is-invalid @enderror"
                                    value="{{ old('libelle', $categorie->libelle) }}" required>
                                @error('libelle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" rows="4"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $categorie->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Statut -->
                            <div class="mb-3">
                                <label class="form-label">Statut</label>
                                <select name="statut" class="form-select @error('statut') is-invalid @enderror">
                                    <option value="1" {{ old('statut', $categorie->statut) == 1 ? 'selected' : '' }}>
                                        Actif</option>
                                    <option value="0" {{ old('statut', $categorie->statut) == 0 ? 'selected' : '' }}>
                                        Inactif</option>
                                </select>
                                @error('statut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Boutons -->
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('categorie.index') }}" class="btn btn-light me-2">Annuler</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-save-line"></i> Mettre à jour
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
