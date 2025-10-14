{{-- Modal d’ajout --}}
<div class="modal fade" id="modalAddSlider" tabindex="-1" aria-labelledby="modalAddSliderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un nouveau slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 align-items-end">
                        {{-- Libellé --}}
                        <div class="col-md-5">
                            <label class="form-label">Libellé</label>
                            <input type="text" name="libelle" class="form-control" required>
                        </div>

                        {{-- Nom du bouton --}}
                        <div class="col-md-5">
                            <label class="form-label">Nom du bouton</label>
                            <input type="text" name="btn_nom" class="form-control">
                        </div>

                        {{-- Visibilité --}}
                        <div class="col-md-2">
                            <label class="form-label">Visibilité</label>
                            <div class="form-check form-switch mt-1">
                                <input class="form-check-input" type="checkbox" id="visible" name="visible"
                                    value="1" checked>
                                <label class="form-check-label" for="visible">Visible</label>
                            </div>
                        </div>

                        {{-- URL --}}
                        <div class="col-md-12">
                            <label class="form-label">URL</label>
                            <input type="url" name="url" class="form-control">
                        </div>

                        {{-- Description --}}
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        {{-- Image --}}
                        <div class="col-md-12">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
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
