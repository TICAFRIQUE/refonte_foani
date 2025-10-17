   {{-- Modal édition --}}
   <div class="modal fade" id="modalEditCategorie{{ $categorie->id }}" tabindex="-1"
       aria-labelledby="editCategorieLabel{{ $categorie->id }}" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
               <form action="{{ route('categorie_point_de_vente.update', $categorie->id) }}" method="POST"
                   enctype="multipart/form-data" class="needs-validation" novalidate>
                   @csrf
                   <div class="modal-header">
                       <h5 class="modal-title">Modifier la catégorie {{ $categorie->libelle }}</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <div class="mb-3">
                           <label class="form-label">Libelle</label>
                           <input type="text" name="libelle" class="form-control" value="{{ $categorie->libelle }}"
                               required>
                       </div>
                       <div class="mb-3"></div>
                       <label for="statut" class="form-label">Statut</label>
                       <select name="statut" id="statut" class="form-select">
                           <option value="1" {{ $categorie->statut ? 'selected' : '' }}>Actif</option>
                           <option value="0" {{ !$categorie->statut ? 'selected' : '' }}>Inactif</option>
                       </select>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                       <button type="submit" class="btn btn-success">Mettre à jour</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
