<!-- MODAL EDIT -->
<div class="modal fade" id="editModal{{ $offre->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $offre->id }}"
    aria-hidden="true">
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
                        <label for="libelle{{ $offre->id }}" class="form-label">Libellé</label>
                        <input type="text" name="libelle" id="libelle{{ $offre->id }}" class="form-control"
                            value="{{ $offre->libelle }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="slug{{ $offre->id }}" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug{{ $offre->id }}" class="form-control"
                            value="{{ $offre->slug }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description{{ $offre->id }}" class="form-label">Description</label>
                        <textarea name="description" id="description{{ $offre->id }}" rows="4" class="form-control">{{ $offre->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="statut{{ $offre->id }}" class="form-label">Statut</label>
                        <select name="statut" id="statut{{ $offre->id }}" class="form-select">
                            <option value="1" {{ $offre->statut == 1 ? 'selected' : '' }}>
                                Actif</option>
                            <option value="0" {{ $offre->statut == 0 ? 'selected' : '' }}>
                                Inactif
                            </option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Mettre à jour
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
