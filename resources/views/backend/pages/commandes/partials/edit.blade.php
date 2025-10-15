<!-- Modal : Modifier commande -->
<div class="modal fade" id="modalEditCommande{{ $commande->id }}" tabindex="-1"
    aria-labelledby="modalEditCommandeLabel{{ $commande->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form action="{{ route('commandes.update', $commande->id) }}" method="POST" class="modal-content needs-validation"
            novalidate>
            @csrf
            @method('PUT')

            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title fw-bold" id="modalEditCommandeLabel{{ $commande->id }}">
                    Modifier la commande #{{ $commande->code }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Client</label>
                        <input type="text" class="form-control" value="{{ $commande->user->username ?? 'Inconnu' }}"
                            disabled>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Téléphone</label>
                        <input type="text" name="telephone" class="form-control"
                            value="{{ old('telephone', $commande->telephone) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Sous-total (Fcfa)</label>
                        <input type="number" name="sous_total" class="form-control"
                            value="{{ old('sous_total', $commande->sous_total) }}" min="0">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Frais de livraison (Fcfa)</label>
                        <input type="number" name="frais_livraison" class="form-control"
                            value="{{ old('frais_livraison', $commande->frais_livraison) }}" min="0">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Statut</label>
                        <select name="statut" class="form-select">
                            <option value="en_attente" @selected($commande->statut == 'en_attente')>En attente</option>
                            <option value="en_cours" @selected($commande->statut == 'en_cours')>En cours</option>
                            <option value="livrée" @selected($commande->statut == 'livrée')>Livrée</option>
                            <option value="annulée" @selected($commande->statut == 'annulée')>Annulée</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Total (Fcfa)</label>
                        <input type="number" name="total" class="form-control"
                            value="{{ old('total', $commande->total) }}" min="0">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Annuler
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
