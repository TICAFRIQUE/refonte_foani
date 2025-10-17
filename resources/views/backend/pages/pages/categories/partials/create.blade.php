 <!-- Modal Create -->
 <div class="modal fade" id="modalAddCategorie" tabindex="-1" aria-labelledby="modalAddCategorieLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <form action="{{ route('categorie_page.store') }}" method="POST" class="needs-validation" novalidate>
                 @csrf
                 <div class="modal-header">
                     <h5 class="modal-title" id="modalAddCategorieLabel">Créer une catégorie</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                 </div>

                 <div class="modal-body">
                     <div class="mb-3">
                         <label for="titre" class="form-label">Libellé</label>
                         <input type="text" name="libelle" id="titre" class="form-control"
                             value="{{ old('libelle') }}" required>
                     </div>
                     <div class="mb-3">
                         <label for="statut" class="form-label">Statut</label>
                         <select name="statut" id="statut" class="form-select">
                             <option value="1">Actif</option>
                             <option value="0">Inactif</option>
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
