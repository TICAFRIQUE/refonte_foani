   <div class="modal fade" id="createCategorieModal" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title fw-bold">Ajouter une catégorie</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
               </div>
               <div class="modal-body">
                   <form action="{{ route('categorie.store') }}" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate> >
                       @csrf
                       <div class="mb-3">
                           <label for="libelle" class="form-label">Libellé</label>
                           <input type="text" name="libelle" id="libelle" class="form-control" required>
                       </div>
                       <div class="mb-3">
                           <label for="description" class="form-label">Description</label>
                           <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                       </div>
                       <div class="row">
                           <div class="col-lg-3">
                               <div class="mb-3">
                                   <label for="statut" class="form-label">Statut</label>
                                   <select name="statut" id="statut" class="form-select">
                                       <option value="1">Actif</option>
                                       <option value="0">Inactif</option>
                                   </select>
                               </div>
                           </div>
                           <div class="col-md-9">
                               <div class="mb-3">
                                   <label for="formFile" class="form-label">Image</label>
                                   <input class="form-control" type="file" id="formFile" name="image"
                                       accept="image/*" required>
                               </div>
                           </div>
                       </div>
                       <div class="d-flex justify-content-end">
                           <button type="button" class="btn btn-secondary me-2"
                               data-bs-dismiss="modal">Annuler</button>
                           <button type="submit" class="btn btn-success">Enregistrer</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>

