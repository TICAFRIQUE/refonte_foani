{{-- Modal create de ville --}}
<div class="modal fade" id="modalAddVille" tabindex="-1" aria-labelledby="modalAddVilleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('ville.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddVilleLabel">Ajouter une ville</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="libelle" class="form-label">Nom de la ville</label>
                        <input type="text" name="libelle" id="libelle" class="form-control"
                            value="{{ old('libelle') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
