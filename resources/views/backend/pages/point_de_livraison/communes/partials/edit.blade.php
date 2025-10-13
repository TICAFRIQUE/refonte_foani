<div class="modal fade" id="editModal{{ $commune->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $commune->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('commune.update', $commune->id) }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white" id="editModalLabel{{ $commune->id }}">
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
                        <label for="ville_id{{ $commune->id }}" class="form-label fw-semibold">Ville</label>
                        <select name="ville_id" id="ville_id{{ $commune->id }}"
                            class="form-select" required>
                            @foreach ($villes as $ville)
                                <option value="{{ $ville->id }}"
                                    {{ $commune->ville_id == $ville->id ? 'selected' : '' }}>
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

                    {{-- Statut --}}
                    <div class="mb-3">
                        <label for="statut_{{ $commune->id }}" class="form-label fw-semibold">Statut</label>
                        <select name="statut" id="statut_{{ $commune->id }}" class="form-select" required>
                            <option value="1" {{ $commune->statut == 1 ? 'selected' : '' }}>Actif</option>
                            <option value="0" {{ $commune->statut == 0 ? 'selected' : '' }}>Inactif</option>
                        </select>
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
