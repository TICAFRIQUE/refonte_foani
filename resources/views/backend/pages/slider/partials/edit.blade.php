{{-- Modal d’édition --}}
<div class="modal fade" id="modalEditSlider{{ $slider->id }}" tabindex="-1"
    aria-labelledby="modalEditSliderLabel{{ $slider->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="modal-header">
                    <h5 class="modal-title">Modifier le slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3 align-items-end">
                        {{-- Libellé --}}
                        <div class="col-md-5">
                            <label class="form-label">Libellé</label>
                            <input type="text" name="libelle" class="form-control" value="{{ $slider->libelle }}"
                                required>
                        </div>

                        {{-- Nom du bouton --}}
                        <div class="col-md-5">
                            <label class="form-label">Nom du bouton</label>
                            <input type="text" name="btn_nom" class="form-control" value="{{ $slider->btn_nom }}">
                        </div>

                        {{-- Visibilité --}}
                        <div class="col-md-2">
                            <label class="form-label">Visibilité</label>
                            <div class="form-check form-switch mt-1">
                                <input class="form-check-input" type="checkbox" id="visible{{ $slider->id }}"
                                    name="visible" value="1" {{ $slider->visible ? 'checked' : '' }}>
                                <label class="form-check-label" for="visible{{ $slider->id }}">Visible</label>
                            </div>
                        </div>

                        {{-- URL --}}
                        <div class="col-md-12">
                            <label class="form-label">URL</label>
                            <input type="url" name="url" class="form-control" value="{{ $slider->url }}">
                        </div>

                        {{-- Description --}}
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $slider->description }}</textarea>
                        </div>

                        {{-- Image --}}
                        <div class="col-md-12">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">

                            <div>
                                @if ($slider->hasMedia('image'))
                                    <img src="{{ $slider->getFirstMediaUrl('image') }}" alt="Image Slider"
                                        class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <span class="text-muted">Aucune</span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
