{{-- Modal edit de la ville --}}
<div class="modal fade" id="editModal{{ $ville->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $ville->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('ville.update', $ville->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $ville->id }}">Modifier la ville</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="libelle_{{ $ville->id }}" class="form-label">Nom de la ville</label>
                        <input type="text" name="libelle" id="libelle_{{ $ville->id }}" class="form-control" value="{{ old('libelle', $ville->libelle) }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
