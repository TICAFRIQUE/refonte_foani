@extends('backend.layouts.master')

@section('content')
    <div class="container py-4">

        <h2 class="fw-bold mb-4">Modifier le Type d’Offre</h2>

        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <form action="{{ route('offre.update', $type_offre->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="libelle" class="form-label">Libellé</label>
                        <input type="text" name="libelle" id="libelle" class="form-control"
                            value="{{ old('libelle', $type_offre->libelle) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                            value="{{ old('slug', $type_offre->slug) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $type_offre->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="statut" class="form-label">Statut</label>
                        <select name="statut" id="statut" class="form-select">
                            <option value="actif" {{ old('statut', $type_offre->statut) == 'actif' ? 'selected' : '' }}>
                                Actif</option>
                            <option value="inactif" {{ old('statut', $type_offre->statut) == 'inactif' ? 'selected' : '' }}>
                                Inactif</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Mettre à jour
                    </button>
                    <a href="{{ route('offre.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
