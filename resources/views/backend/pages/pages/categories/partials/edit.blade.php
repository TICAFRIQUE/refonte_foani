  <!-- Modal Edit (par catégorie) -->
  <div class="modal fade" id="modalEditCategorie{{ $categorie->id }}" tabindex="-1"
      aria-labelledby="modalEditCategorieLabel{{ $categorie->id }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <form action="{{ route('categorie_page.update', $categorie->id) }}" method="POST">
                  @csrf


                  <div class="modal-header">
                      <h5 class="modal-title" id="modalEditCategorieLabel{{ $categorie->id }}">Modifier la
                          catégorie</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                  </div>

                  <div class="modal-body">
                      <div class="mb-3">
                          <label for="titre_{{ $categorie->id }}" class="form-label">Titre</label>
                          <input type="text" name="libelle" id="titre_{{ $categorie->id }}" class="form-control"
                              value="{{ old('libelle', $categorie->libelle) }}" required>
                      </div>

                      <div class="mb-3">
                          <label for="statut{{ $categorie->id }}" class="form-label">Statut</label>
                          <select name="statut" id="statut{{ $categorie->id }}" class="form-select">
                              <option value="1" {{ $categorie->statut == 1 ? 'selected' : '' }}>Actif
                              </option>
                              <option value="0" {{ $categorie->statut == 0 ? 'selected' : '' }}>Inactif
                              </option>
                          </select>
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
