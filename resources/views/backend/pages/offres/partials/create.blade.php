 <!-- MODAL AJOUT -->
 <div class="modal fade" id="offreModal" tabindex="-1" aria-labelledby="offreModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">

             <div class="modal-header">
                 <h5 class="modal-title fw-bold" id="offreModalLabel">Ajouter un Type d’Offre</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>

             <div class="modal-body">
                 <form action="{{ route('offre.store') }}" method="POST">
                     @csrf

                     <div class="mb-3">
                         <label for="libelle" class="form-label">Libellé</label>
                         <input type="text" name="libelle" id="libelle"
                             class="form-control @error('libelle') is-invalid @enderror" value="{{ old('libelle') }}"
                             required>
                         @error('libelle')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>

                     <input type="hidden" name="slug" value="{{ old('slug') }}">

                     <div class="mb-3">
                         <label for="description" class="form-label">Description</label>
                         <textarea name="description" id="description" rows="4"
                             class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                         @error('description')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label for="statut" class="form-label">Statut</label>
                         <select name="statut" id="statut" class="form-select @error('statut') is-invalid @enderror"
                             required>
                             <option value="1" {{ old('statut') == 1 ? 'selected' : '' }}>Actif</option>
                             <option value="0" {{ old('statut') == 0 ? 'selected' : '' }}>Inactif</option>
                         </select>
                         @error('statut')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>

                     <div class="d-flex justify-content-end">
                         <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Annuler</button>
                         <button type="submit" class="btn btn-success">
                             <i class="bi bi-save"></i> Enregistrer
                         </button>
                     </div>
                 </form>
             </div>

         </div>
     </div>
 </div>
