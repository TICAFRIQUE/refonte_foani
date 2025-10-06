 <div class="modal fade" id="editModal{{ $categorie->id }}" tabindex="-1"
     aria-labelledby="editModalLabel{{ $categorie->id }}" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title fw-bold" id="editModalLabel{{ $categorie->id }}">
                     Modifier la catégorie
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('categorie.update', $categorie->id) }}" method="POST">
                     @csrf

                     <div class="mb-3">
                         <label for="libelle{{ $categorie->id }}" class="form-label">Libellé</label>
                         <input type="text" name="libelle" id="libelle{{ $categorie->id }}" class="form-control"
                             value="{{ $categorie->libelle }}" required>
                     </div>

                     <div class="mb-3">
                         <label for="description{{ $categorie->id }}" class="form-label">Description</label>
                         <textarea name="description" id="description{{ $categorie->id }}" rows="3" class="form-control">{{ $categorie->description }}</textarea>
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

                     <div class="d-flex justify-content-end">
                         <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Annuler</button>
                         <button type="submit" class="btn btn-warning">
                             <i class="bi bi-pencil-square"></i> Mettre à jour
                         </button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
