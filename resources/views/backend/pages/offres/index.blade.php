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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#offreModal">
                <i class="bi bi-plus-circle"></i> Nouveau Type d’Offre
            </button>
        </div>

        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
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
                                        @if ($offre->statut == 'actif' || $offre->statut == 1)
                                            <span class="badge bg-success">Actif</span>
                                        @else
                                            <span class="badge bg-secondary">Inactif</span>
                                        @endif
                                    </td>
                                    <td>{{ $offre->produits->count() }}</td>
                                    <td class="text-center">
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <!-- Modifier -->
                                                <li>
                                                    <a type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $offre->id }}">
                                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier
                                                    </a>
                                                </li>

                                                <!-- Supprimer -->
                                                <li>
                                                    <form action="{{ route('offre.delete', $offre->id) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Voulez-vous vraiment supprimer ce type d’offre ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="ri-delete-bin-fill align-bottom me-2"></i> Supprimer
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>

                                </tr>

                                <!-- MODAL EDIT -->
                                <div class="modal fade" id="editModal{{ $offre->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $offre->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold" id="editModalLabel{{ $offre->id }}">
                                                    Modifier le Type d’Offre
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('offre.update', $offre->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label for="libelle{{ $offre->id }}"
                                                            class="form-label">Libellé</label>
                                                        <input type="text" name="libelle"
                                                            id="libelle{{ $offre->id }}" class="form-control"
                                                            value="{{ $offre->libelle }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="slug{{ $offre->id }}"
                                                            class="form-label">Slug</label>
                                                        <input type="text" name="slug" id="slug{{ $offre->id }}"
                                                            class="form-control" value="{{ $offre->slug }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="description{{ $offre->id }}"
                                                            class="form-label">Description</label>
                                                        <textarea name="description" id="description{{ $offre->id }}" rows="4" class="form-control">{{ $offre->description }}</textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="statut{{ $offre->id }}"
                                                            class="form-label">Statut</label>
                                                        <select name="statut" id="statut{{ $offre->id }}"
                                                            class="form-select">
                                                            <option value="1"
                                                                {{ $offre->statut == 1 ? 'selected' : '' }}>Actif</option>
                                                            <option value="0"
                                                                {{ $offre->statut == 0 ? 'selected' : '' }}>Inactif
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="d-flex justify-content-end">
                                                        <button type="button" class="btn btn-secondary me-2"
                                                            data-bs-dismiss="modal">Annuler</button>
                                                        <button type="submit" class="btn btn-warning">
                                                            <i class="bi bi-pencil-square"></i> Mettre à jour
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
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

    <!-- MODAL AJOUT -->
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
                            <select name="statut" id="statut"
                                class="form-select @error('statut') is-invalid @enderror" required>
                                <option value="1" {{ old('statut') == 1 ? 'selected' : '' }}>Actif</option>
                                <option value="0" {{ old('statut') == 0 ? 'selected' : '' }}>Inactif</option>
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2"
                                data-bs-dismiss="modal">Annuler</button>
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
