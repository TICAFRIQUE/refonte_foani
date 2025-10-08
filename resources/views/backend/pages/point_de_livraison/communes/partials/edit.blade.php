<div class="modal fade" id="editModal{{ $commune->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $commune->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('commune.update', $commune->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editModalLabel{{ $commune->id }}">
                        Modifier la commune
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Fermer"></button>
                </div>

                <div class="modal-body">
                    {{-- Nom de la commune --}}
                    <div class="mb-3">
                        <label for="libelle_{{ $commune->id }}" class="form-label fw-semibold">Nom</label>
                        <input type="text" name="libelle" id="libelle_{{ $commune->id }}" class="form-control"
                            value="{{ old('libelle', $commune->libelle) }}" required>
                    </div>

                    {{-- Ville --}}
                    <div class="mb-3">
                        <label for="id_ville_livraison_{{ $commune->id }}" class="form-label fw-semibold">Ville</label>
                        <select name="id_ville_livraison" id="id_ville_livraison_{{ $commune->id }}"
                            class="form-select" required>
                            @foreach ($villes as $ville)
                                <option value="{{ $ville->id }}"
                                    {{ $commune->id_ville_livraison == $ville->id ? 'selected' : '' }}>
                                    {{ $ville->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Frais de port --}}
                    <div class="mb-3">
                        <label for="frais_de_port_{{ $commune->id }}" class="form-label fw-semibold">Frais de port
                            (FCFA)</label>
                        <input type="number" name="frais_de_port" id="frais_de_port_{{ $commune->id }}"
                            class="form-control" step="0.01"
                            value="{{ old('frais_de_port', $commune->frais_de_port) }}">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i> Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
