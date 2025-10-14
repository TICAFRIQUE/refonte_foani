   {{-- Modal édition --}}
   <div class="modal fade" id="modalEditCategorie{{ $categorie->id }}" tabindex="-1"
       aria-labelledby="editCategorieLabel{{ $categorie->id }}" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
               <form action="{{ route('categorie_point_de_vente.update', $categorie->id) }}" method="POST"
                   enctype="multipart/form-data">
                   @csrf
                   <div class="modal-header">
                       <h5 class="modal-title">Modifier la catégorie</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <div class="mb-3">
                           <label class="form-label">Titre</label>
                           <input type="text" name="titre_categorie" class="form-control"
                               value="{{ $categorie->titre_categorie }}" required>
                       </div>
                       <div class="mb-3">
                           <label class="form-label">Image</label>
                           <input type="file" name="image" class="form-control">
                           @if ($categorie->image)
                               <img src="{{ asset('storage/' . $categorie->image) }}" class="img-thumbnail mt-2"
                                   width="100">
                           @endif
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                       <button type="submit" class="btn btn-success">Mettre à jour</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
