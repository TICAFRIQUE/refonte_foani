@extends('backend.layouts.master')

@section('title', 'Liste des catégories')

@section('content')
    <div class="container-fluid py-4">

        {{-- Messages --}}
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
            <h2 class="fw-bold">Liste des Catégories</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategorieModal">
                <i class="bi bi-plus-circle"></i> Ajouter une catégorie
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
                                <th>Description</th>
                                <th>Slug</th>
                                <th>Statut</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $categorie)
                                <tr>
                                    <td>{{ $categorie->id }}</td>
                                    <td>{{ $categorie->libelle }}</td>
                                    <td>{{ Str::limit($categorie->description, 50) }}</td>
                                    <td>{{ $categorie->slug }}</td>
                                    <td>
                                        @if ($categorie->statut)
                                            <span class="badge bg-success">Actif</span>
                                        @else
                                            <span class="badge bg-secondary">Inactif</span>
                                        @endif
                                    </td>
                                    {{-- <td class="text-center">
                                        <!-- Edit Modal Trigger -->
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $categorie->id }}">
                                            <i class="bi bi-pencil"></i> Modifier
                                        </button>

                                        <!-- Delete Form -->
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <!-- Edit button -->
                                                <li>
                                                    <a type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $categorie->id }}">
                                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier
                                                    </a>
                                                </li>

                                                <!-- Delete form as dropdown item -->
                                                <li>
                                                    <form action="{{ route('categorie.delete', $categorie->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Voulez-vous vraiment supprimer cette catégorie ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="ri-delete-bin-fill align-bottom me-2"></i> Supprimer
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>



                                    </td> --}}
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
                                                        data-bs-target="#editCategorieModal{{ $categorie->id }}">
                                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier
                                                    </a>
                                                </li>

                                                <!-- Supprimer -->
                                                <li>
                                                    <form action="{{ route('categorie.delete', $categorie->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Voulez-vous vraiment supprimer cette catégorie ?');">
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

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $categorie->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $categorie->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold" id="editModalLabel{{ $categorie->id }}">
                                                    Modifier la catégorie
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('categorie.update', $categorie->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label for="libelle{{ $categorie->id }}"
                                                            class="form-label">Libellé</label>
                                                        <input type="text" name="libelle"
                                                            id="libelle{{ $categorie->id }}" class="form-control"
                                                            value="{{ $categorie->libelle }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="description{{ $categorie->id }}"
                                                            class="form-label">Description</label>
                                                        <textarea name="description" id="description{{ $categorie->id }}" rows="3" class="form-control">{{ $categorie->description }}</textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="statut{{ $categorie->id }}"
                                                            class="form-label">Statut</label>
                                                        <select name="statut" id="statut{{ $categorie->id }}"
                                                            class="form-select">
                                                            <option value="1"
                                                                {{ $categorie->statut == 1 ? 'selected' : '' }}>Actif
                                                            </option>
                                                            <option value="0"
                                                                {{ $categorie->statut == 0 ? 'selected' : '' }}>Inactif
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
                                    <td colspan="6" class="text-center text-muted">Aucune catégorie trouvée</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createCategorieModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Ajouter une catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categorie.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="libelle" class="form-label">Libellé</label>
                            <input type="text" name="libelle" id="libelle" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select name="statut" id="statut" class="form-select">
                                <option value="1">Actif</option>
                                <option value="0">Inactif</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2"
                                data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
