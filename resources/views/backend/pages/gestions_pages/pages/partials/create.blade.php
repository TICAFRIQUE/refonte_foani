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

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>Créer une nouvelle page</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{-- Colonne gauche : Titre et Mot clé --}}
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label for="titre" class="form-label">Titre</label>
                                    <input type="text" name="titre" id="titre" class="form-control"
                                        value="{{ old('titre') }}" required>
                                    @error('titre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="mot_cle" class="form-label">Mot clé</label>
                                    <input type="text" name="mot_cle" id="mot_cle" class="form-control"
                                        value="{{ old('mot_cle') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="id_categorie_page" class="form-label">Catégorie</label>
                                    <select name="id_categorie_page" id="id_categorie_page" class="form-select" required>
                                        <option>---selectionner</option>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->titre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Colonne droite : Image --}}
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                            </div>
                        </div>

                        {{-- Contenu --}}
                        <div class="mb-3">
                            <label for="contenu" class="form-label">Contenu</label>
                            <textarea name="contenu" id="contenu" class="form-control" rows="6">{{ old('contenu') }}</textarea>
                        </div>

                        {{-- Visibilité --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="visibilite" class="form-check-input" id="visibilite" checked>
                            <label class="form-check-label" for="visibilite">Visible</label>
                        </div>

                        {{-- Boutons --}}
                        <button type="submit" class="btn btn-success">Créer</button>
                        <a href="{{ route('pages.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
