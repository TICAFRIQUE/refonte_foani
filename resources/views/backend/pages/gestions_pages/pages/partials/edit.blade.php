@extends('backend.layouts.master')

@section('title', 'Modifier une page')

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Pages
        @endslot
        @slot('title')
            Modifier une page
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Modifier la page</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            {{-- Colonne gauche : texte --}}
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label for="titre" class="form-label">Titre</label>
                                    <input type="text" name="titre" id="titre" class="form-control"
                                        value="{{ old('titre', $page->titre) }}" required>
                                    @error('titre')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="mot_cle" class="form-label">Mot clé</label>
                                    <input type="text" name="mot_cle" id="mot_cle" class="form-control"
                                        value="{{ old('mot_cle', $page->mot_cle) }}">
                                    @error('mot_cle')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="id_categorie_page" class="form-label">Catégorie</label>
                                    <select name="id_categorie_page" id="id_categorie_page" class="form-select" required>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}"
                                                {{ old('id_categorie_page', $page->id_categorie_page) == $categorie->id ? 'selected' : '' }}>
                                                {{ $categorie->titre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_categorie_page')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="contenu" class="form-label">Contenu</label>
                                    <textarea name="contenu" id="contenu" class="form-control" rows="6">{{ old('contenu', $page->contenu) }}</textarea>
                                    @error('contenu')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="visibilite" class="form-check-input" id="visibilite"
                                        {{ old('visibilite', $page->visibilite) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="visibilite">Visible</label>
                                </div>
                            </div>

                            {{-- Colonne droite : image --}}
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    @if ($page->image && file_exists(public_path('storage/' . $page->image)))
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $page->image) }}" alt="Image page"
                                                class="img-fluid img-thumbnail"
                                                style="max-width: 200px; object-fit: cover;">
                                        </div>
                                    @endif
                                    @error('image')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start gap-2 mt-3">
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                            <a href="{{ route('pages.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
