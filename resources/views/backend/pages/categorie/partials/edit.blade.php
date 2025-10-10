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
                 <form action="{{ route('categorie.update', $categorie->id) }}" method="POST"
                     enctype="multipart/form-data" class="needs-validation" novalidate>
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



                     <div class="row">
                         <div class="col-lg-6">
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
                         <div class="col-lg-6">
                             <!-- order-->
                             <div class="mb-3">
                                 <label for="order{{ $categorie->id }}" class="form-label">Ordre</label>
                                 <select name="position" class="form-control">
                                     @php
                                         //compter le nombre de categorie pour la position
                                         $data_count = \App\Models\Categorie::count();

                                     @endphp
                                     @for ($i = 1; $i <= $data_count; $i++)
                                         <option value="{{ $i }}"
                                             {{ $categorie->position == $i ? 'selected' : '' }}>
                                             {{ $i }}
                                         </option>
                                     @endfor
                                 </select>
                             </div>

                         </div>

                         <div class="col-md-12">

                             <!--Image dejà existante-->
                             @php $image = $categorie->getFirstMedia('image'); @endphp
                             @if ($image)
                                 <div class="mb-3">
                                     <label class="form-label">Image actuelle</label>
                                     <div>
                                         <img src="{{ $categorie->getFirstMediaUrl('image') }}"
                                             alt="{{ $categorie->libelle }}" style="max-width: 200px;">
                                     </div>
                                 </div>
                             @endif
                             <div class="mb-3">
                                 <label for="formFile" class="form-label">Image</label>
                                 <input class="form-control" type="file" id="formFile" name="image"
                                     accept="image/*">
                                 <div class="mt-2 position-relative" style="display: inline-block;">
                                     <img id="previewImage" src="#" alt="Aperçu"
                                         style="max-width: 200px; display: none;" />
                                     <button type="button" id="removeImageBtn" class="btn btn-danger btn-sm"
                                         style="position: absolute; top: 5px; right: 5px; display: none;">
                                         <i class="ri-delete-bin-line"></i>
                                     </button>
                                 </div>
                             </div>
                         </div>

                         <div class="d-flex justify-content-end">
                             <button type="button" class="btn btn-secondary me-2"
                                 data-bs-dismiss="modal">Annuler</button>
                             <button type="submit" class="btn btn-warning">
                                 <i class="bi bi-pencil-square"></i> Mettre à jour
                             </button>
                         </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
