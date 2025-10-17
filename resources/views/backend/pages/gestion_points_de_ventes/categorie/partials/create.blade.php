{{-- Modal création --}}
<div class="modal fade" id="modalAddCategorie" tabindex="-1" aria-labelledby="modalAddCategorieLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('categorie_point_de_vente.store') }}" class="needs-validation" method="POST"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une catégorie de point de vente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Libellé de la catégorie</label>
                        <input type="text" name="libelle" class="form-control" value="{{ old('libelle') }}" required>
                    </div>


                    <div class="mb-3">
                        <label for="statut" class="form-label">Statut</label>
                        <select name="statut" id="statut" class="form-select">
                            <option value="1">Actif</option>
                            <option value="0">Inactif</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
