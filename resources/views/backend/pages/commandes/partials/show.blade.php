@extends('backend.layouts.master')
@section('title', 'Commande ' . $commande->code)

@section('content')
    @php
        $fcfa = fn ($v) => number_format((float) $v, 0, ',', ' ');
        $statut = $commande->statut;
        $annulee = $statut === \App\Support\Statut::ANNULEE;
        $rang = array_search($statut, \App\Support\Statut::ETAPES, true);
        $tel = preg_replace('/\D/', '', (string) $commande->telephone);
        $nbArticles = $commande->produits->sum(fn ($p) => $p->pivot->quantite);
        // Prochaine étape logique proposée en bouton principal
        $suivante = [\App\Support\Statut::EN_ATTENTE => \App\Support\Statut::EN_COURS, \App\Support\Statut::EN_COURS => \App\Support\Statut::LIVREE][$statut] ?? null;
    @endphp

    <div class="page-head">
        <div>
            <a href="{{ route('commandes.index') }}" class="text-muted small"><i class="ri-arrow-left-line"></i> Retour aux commandes</a>
            <h1 class="d-flex flex-wrap align-items-center gap-2 mt-1">
                Commande {{ $commande->code }} @include('backend.components.statut-badge', ['statut' => $statut])
            </h1>
            <p>Passée le {{ $commande->created_at?->format('d/m/Y à H:i') }} ({{ $commande->created_at?->diffForHumans() }})
                @if ($commande->date_livraison) · livrée le {{ $commande->date_livraison->format('d/m/Y à H:i') }} @endif
            </p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-soft-secondary" onclick="imprimerFacture()"><i class="ri-printer-line me-1"></i> Imprimer la facture</button>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-xl-8">
            {{-- Suivi --}}
            <div class="card">
                <div class="card-body">
                    <div class="stepper {{ $annulee ? 'is-cancelled' : '' }}">
                        @foreach (\App\Support\Statut::ETAPES as $i => $etape)
                            @php $info = \App\Support\Statut::info($etape); @endphp
                            <div class="stepper__step {{ !$annulee && $rang !== false && $i <= $rang ? 'is-done' : '' }} {{ !$annulee && $rang === $i ? 'is-current' : '' }}">
                                <span class="stepper__dot"><i class="{{ $info['icone'] }}"></i></span>
                                {{ $info['label'] }}
                            </div>
                        @endforeach
                    </div>
                    @if ($annulee)
                        <div class="alert alert-danger mb-0 mt-3"><i class="ri-close-circle-line me-1"></i> Cette commande a été annulée.</div>
                    @endif

                    <hr>
                    <form action="{{ route('commandes.update', $commande->id) }}" method="POST" id="formStatut">
                        @csrf
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                            <span class="fw-semibold">Changer le statut :</span>
                            <div class="statut-actions">
                                @if ($suivante)
                                    @php $infoS = \App\Support\Statut::info($suivante); @endphp
                                    <button type="submit" name="statut" value="{{ $suivante }}" class="btn btn-primary">
                                        <i class="{{ $infoS['icone'] }}"></i> Passer à « {{ $infoS['label'] }} »
                                    </button>
                                @endif
                                @foreach (\App\Support\Statut::LISTE as $cle => $info)
                                    @continue($cle === $statut || $cle === $suivante)
                                    <button type="submit" name="statut" value="{{ $cle }}"
                                        class="btn btn-sm btn-soft-{{ $info['couleur'] }}"
                                        @if ($cle === \App\Support\Statut::ANNULEE) data-confirm="Annuler la commande {{ $commande->code }} ?" @endif>
                                        <i class="{{ $info['icone'] }}"></i> {{ $info['label'] }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Produits --}}
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0"><i class="ri-shopping-basket-2-line me-1 text-success"></i> Produits commandés</h5>
                    <span class="badge bg-success-subtle text-success">{{ $nbArticles }} article(s)</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-modern align-middle mb-0">
                            <thead>
                                <tr><th>Produit</th><th class="text-center">Qté</th><th class="text-end">Prix unitaire</th><th class="text-end">Total</th></tr>
                            </thead>
                            <tbody>
                                @forelse ($commande->produits as $produit)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ $produit->getFirstMediaUrl('image_principale', 'thumb') ?: asset('front/images/produits/poulet.png') }}"
                                                    alt="" width="44" height="44" class="rounded" style="object-fit: cover;" loading="lazy">
                                                <span class="cell-main">{{ $produit->libelle }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">× {{ $produit->pivot->quantite }}</td>
                                        <td class="text-end text-nowrap">{{ $fcfa($produit->pivot->prix_unitaire) }} F</td>
                                        <td class="text-end text-nowrap fw-semibold">{{ $fcfa($produit->pivot->total) }} F</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="empty-box">Aucun produit associé à cette commande.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            {{-- Client --}}
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0"><i class="ri-user-3-line me-1 text-success"></i> Client</h5></div>
                <div class="card-body">
                    <ul class="info-list">
                        <li><i class="ri-user-line"></i><div><small>Nom</small><strong>{{ $commande->nom ?: ($commande->user->username ?? 'Inconnu') }}</strong></div></li>
                        <li><i class="ri-phone-line"></i><div><small>Téléphone</small><strong>{{ $commande->telephone ?: '—' }}</strong></div></li>
                        <li><i class="ri-map-pin-line"></i><div><small>Adresse de livraison</small>
                            <strong>{{ $commande->commune ?: '—' }}{{ $commande->ville ? ', ' . $commande->ville : '' }}</strong>
                            @if ($commande->adresse)<span class="d-block text-muted small">{{ $commande->adresse }}</span>@endif
                        </div></li>
                        @if ($commande->commentaire)
                            <li><i class="ri-chat-3-line"></i><div><small>Commentaire</small>{{ $commande->commentaire }}</div></li>
                        @endif
                        <li><i class="ri-bank-card-line"></i><div><small>Paiement</small><strong>{{ $commande->mode_paiement === 'espece' ? 'Espèces à la livraison' : ($commande->mode_paiement ?: '—') }}</strong></div></li>
                    </ul>
                    @if ($tel)
                        <div class="d-flex gap-2 mt-3">
                            <a href="tel:{{ $tel }}" class="btn btn-soft-primary flex-fill"><i class="ri-phone-fill me-1"></i> Appeler</a>
                            <a href="https://wa.me/225{{ $tel }}?text={{ rawurlencode('Bonjour, FOANI concernant votre commande ' . $commande->code) }}" target="_blank" rel="noopener"
                                class="btn btn-soft-success flex-fill"><i class="ri-whatsapp-line me-1"></i> WhatsApp</a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Montants --}}
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0"><i class="ri-money-dollar-circle-line me-1 text-success"></i> Montants</h5></div>
                <div class="card-body">
                    <ul class="totaux">
                        <li><span>Sous-total</span><strong>{{ $fcfa($commande->sous_total) }} F</strong></li>
                        <li><span>Livraison</span><strong>{{ $fcfa($commande->frais_livraison) }} F</strong></li>
                        <li class="is-total"><span>Total</span><span>{{ $fcfa($commande->total) }} FCFA</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('backend.pages.commandes.scripts.impressionFacture')
    <script>
        // Confirmation avant une action sensible (annulation)
        document.getElementById('formStatut').addEventListener('click', function(e) {
            var btn = e.target.closest('button[data-confirm]');
            if (btn && !confirm(btn.dataset.confirm)) e.preventDefault();
        });
    </script>
@endsection
