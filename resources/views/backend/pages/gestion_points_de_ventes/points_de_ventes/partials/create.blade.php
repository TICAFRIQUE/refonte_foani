{{-- Modal d’ajout --}}
<div class="modal fade" id="modalAddPointVente" tabindex="-1" aria-labelledby="modalAddPointVenteLabel" aria-hidden="true">
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

            <form action="{{ route('point_vente.store') }}" method="POST" class=" needs-validation" novalidate>
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un point de vente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Catégorie</label>
                            <select name="categorie_point_vente_id" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-6">
                            <label class="form-label">Commune / Ville</label>
                            <select name="commune_id" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach ($villes as $ville)
                                    <option style="font-weight:800" value="{{ $ville->id }}">{{ $ville->libelle }}
                                    </option>
                                    @foreach ($ville->communes as $commune)
                                        <option value="{{ $commune->id }}">-- {{ $commune->libelle }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>



                        {{-- Ligne 2 : Quartier + Responsable --}}
                        <div class="col-md-6">
                            <label class="form-label">Quartier</label>
                            <input type="text" name="quartier" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Responsable</label>
                            <input type="text" name="responsable" class="form-control">
                        </div>

                        {{-- Ligne 3 : Contact + Autre contact --}}
                        <div class="col-md-6">
                            <label class="form-label">Contact</label>
                            <input type="text" name="contact" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Autre contact <span class="text-muted">(facultatif)</span></label>
                            <input type="text" name="autre_contact" placeholder="Ex: 0102030405"
                                class="form-control">
                        </div>

                        {{-- Ligne 4 : Email + Lien Google Map --}}
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="exemple@mail.com">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Lien Google Map</label>
                            <input type="url" name="google_map" class="form-control"
                                placeholder="https://maps.google.com/...">
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-75">Ajouter</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
