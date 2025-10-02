@extends('backend.layouts.master')

@section('content')
    <div class="container-fluid py-4">

        {{-- Message de succès ou erreur --}}
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
            <h2 class="fw-bold">Liste des Types d’Offres</h2>
            <!-- Bouton qui ouvre la modale -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#offreModal">
                <i class="bi bi-plus-circle"></i> Nouveau Type d’Offre
            </button>
        </div>

        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Libellé</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Statut</th>
                                <th>Produits liés</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($types_offres as $offre)
                                <tr>
                                    <td>{{ $offre->id }}</td>
                                    <td>{{ $offre->libelle }}</td>
                                    <td>{{ $offre->slug }}</td>
                                    <td>{{ Str::limit($offre->description, 50) }}</td>
                                    <td>
                                        @if ($offre->statut == 'actif')
                                            <span class="badge bg-success">Actif</span>
                                        @else
                                            <span class="badge bg-secondary">Inactif</span>
                                        @endif
                                    </td>
                                    <td>{{ $offre->produits->count() }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('offre.show', $offre->id) }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-eye"></i> voir
                                        </a>
                                        <a href="{{ route('offre.edit', $offre->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i> Modifier
                                        </a>
                                        <form action="{{ route('offre.delete', $offre->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce type d’offre ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash3"></i> supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Aucun type d’offre trouvé</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $types_offres->links() }}
                </div>
            </div>
        </div>
    </div>


    <!-- Fenêtre modale Bootstrap contenant ton formulaire -->
    <div class="modal fade" id="offreModal" tabindex="-1" aria-labelledby="offreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="offreModalLabel">Ajouter un Type d’Offre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('offre.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="libelle" class="form-label">Libellé</label>
                            <input type="text" name="libelle" id="libelle"
                                class="form-control @error('libelle') is-invalid @enderror" value="{{ old('libelle') }}"
                                required>
                            @error('libelle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="hidden" name="slug" value="{{ old('slug') }}">

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select name="statut" id="statut" class="form-select @error('statut') is-invalid @enderror"
                                required>
                                <option value="1" {{ old('statut') == 1 ? 'selected' : '' }}>Actif</option>
                                <option value="0" {{ old('statut') == 0 ? 'selected' : '' }}>Inactif</option>
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
