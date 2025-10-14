  {{-- Modal d’ajout --}}
  <div class="modal fade" id="modalAddVillePointVente" tabindex="-1" aria-labelledby="modalAddVillePointVenteLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <form action="{{ route('ville_point_vente.store') }}" method="POST">
                  @csrf
                  <div class="modal-header">
                      <h5 class="modal-title">Ajouter une ville du point de vente</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row g-3">
                          <div class="col-md-6">
                              <label class="form-label">Ville</label>
                              <select name="id_ville" class="form-select" required>
                                  <option value="">-- Sélectionner --</option>
                                  @foreach ($villes as $ville)
                                      <option value="{{ $ville->id }}">{{ $ville->libelle }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-md-6">
                              <label class="form-label">Commune</label>
                              <select name="id_commune" class="form-select" required>
                                  <option value="">-- Sélectionner --</option>
                                  @foreach ($communes as $commune)
                                      <option value="{{ $commune->id }}">{{ $commune->libelle }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-md-6">
                              <label class="form-label">Quartier</label>
                              <input type="text" name="quartier" class="form-control">
                          </div>
                          <div class="col-md-6">
                              <label class="form-label">Responsable</label>
                              <input type="text" name="responsable" class="form-control">
                          </div>
                          <div class="col-md-6">
                              <label class="form-label">Contact</label>
                              <input type="text" name="contact" class="form-control">
                          </div>
                          <div class="col-md-6">
                              <label class="form-label">Email</label>
                              <input type="email" name="email" class="form-control">
                          </div>
                          <div class="col-12">
                              <label class="form-label">Lien Google Map</label>
                              <input type="url" name="google_map" class="form-control">
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
