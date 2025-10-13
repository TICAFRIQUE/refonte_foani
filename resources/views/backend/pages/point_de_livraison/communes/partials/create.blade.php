<div class="modal fade" id="modalAddCommune" tabindex="-1" aria-labelledby="modalAddCommuneLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('commune.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddCommuneLabel">Ajouter une Commune</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="libelle" class="form-label">Nom</label>
                        <input type="text" name="libelle" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_ville_livraison" class="form-label">Ville</label>
                        <select name="ville_id" class="form-select" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach ($villes as $ville)
                                <option value="{{ $ville->id }}">{{ $ville->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="frais_de_port" class="form-label">Frais de port</label>
                        <input type="number" name="frais_de_port" class="form-control" required>
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
