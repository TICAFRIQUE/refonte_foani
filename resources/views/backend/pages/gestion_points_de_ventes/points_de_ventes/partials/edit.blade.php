{{-- Modal d’édition --}}
<div class="modal fade" id="modalEditPointVente{{ $pv->id }}" tabindex="-1"
    aria-labelledby="modalEditPointVenteLabel{{ $pv->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- Affichage des erreurs --}}
            @if ($errors->any())
                <div class="alert alert-danger m-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('point_vente.update', $pv->id) }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Modifier le point de vente </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        {{-- Ligne 1 : Commune + Catégorie --}}
                        <div class="col-md-6">
                            <label class="form-label">Commune</label>
                            <select name="commune_id" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach ($communes as $commune)
                                    <option value="{{ $commune->id }}"
                                        {{ $pv->commune_id == $commune->id ? 'selected' : '' }}>
                                        {{ $commune->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Catégorie</label>
                            <select name="categorie_point_vente_id" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}"
                                        {{ $pv->categorie_point_vente_id == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Ligne 2 : Quartier + Responsable --}}
                        <div class="col-md-6">
                            <label class="form-label">Quartier</label>
                            <input type="text" name="quartier" value="{{ $pv->quartier }}" class="form-control"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Responsable</label>
                            <input type="text" name="responsable" value="{{ $pv->responsable }}"
                                class="form-control" required>
                        </div>

                        {{-- Ligne 3 : Contact + Autre contact --}}
                        <div class="col-md-6">
                            <label class="form-label">Contact</label>
                            <input type="text" name="contact" value="{{ $pv->contact }}" class="form-control"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Autre contact <span class="text-muted">(facultatif)</span></label>
                            <input type="text" name="autre_contact" value="{{ $pv->autre_contact }}"
                                class="form-control" placeholder="Ex: 0708091011">
                        </div>

                        {{-- Ligne 4 : Email + Lien Google Map --}}
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ $pv->email }}" class="form-control"
                                placeholder="exemple@mail.com">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Lien Google Map</label>
                            <input type="url" name="google_map" value="{{ $pv->google_map }}" class="form-control"
                                placeholder="https://maps.google.com/...">
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>

        </div>
    </div>
</div>
