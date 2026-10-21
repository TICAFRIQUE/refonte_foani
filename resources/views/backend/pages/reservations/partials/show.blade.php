@extends('backend.layouts.master')
@section('title', 'Réservation ' . $reservation->code)

@section('content')
    @php
        $S = \App\Support\Statut::class;
        $fcfa = fn ($v) => number_format((float) $v, 0, ',', ' ');
        $statut = $reservation->statut;
        $annulee = $statut === $S::ANNULEE;
        $rang = array_search($statut, $S::ETAPES, true);
        $tel = preg_replace('/\D/', '', (string) $reservation->telephone);
        $suivante = [$S::EN_ATTENTE => $S::EN_COURS, $S::EN_COURS => $S::LIVREE][$statut] ?? null;
        $produit = $reservation->produit;
    @endphp

    <div class="page-head">
        <div>
            <a href="{{ route('reservations.index') }}" class="text-muted small"><i class="ri-arrow-left-line"></i> Retour aux réservations</a>
            <h1 class="d-flex flex-wrap align-items-center gap-2 mt-1">
                Réservation {{ $reservation->code }} @include('backend.components.statut-badge', ['statut' => $statut])
            </h1>
            <p>Faite le {{ $reservation->created_at?->format('d/m/Y à H:i') }} ({{ $reservation->created_at?->diffForHumans() }})
                @if ($reservation->date_reservation) · souhaitée pour le {{ $reservation->date_reservation->format('d/m/Y') }} @endif
            </p>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="stepper {{ $annulee ? 'is-cancelled' : '' }}">
                        @foreach ($S::ETAPES as $i => $etape)
                            @php $info = $S::info($etape); @endphp
                            <div class="stepper__step {{ !$annulee && $rang !== false && $i <= $rang ? 'is-done' : '' }} {{ !$annulee && $rang === $i ? 'is-current' : '' }}">
                                <span class="stepper__dot"><i class="{{ $info['icone'] }}"></i></span>
                                {{ $info['label'] }}
                            </div>
                        @endforeach
                    </div>
                    @if ($annulee)
                        <div class="alert alert-danger mb-0 mt-3"><i class="ri-close-circle-line me-1"></i> Cette réservation a été annulée.</div>
                    @endif
                    <hr>
                    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" id="formStatut">
                        @csrf
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                            <span class="fw-semibold">Changer le statut :</span>
                            <div class="statut-actions">
                                @if ($suivante)
                                    @php $infoS = $S::info($suivante); @endphp
                                    <button type="submit" name="statut" value="{{ $suivante }}" class="btn btn-primary">
                                        <i class="{{ $infoS['icone'] }}"></i> Passer à « {{ $infoS['label'] }} »
                                    </button>
                                @endif
                                @foreach ($S::LISTE as $cle => $info)
                                    @continue($cle === $statut || $cle === $suivante)
                                    <button type="submit" name="statut" value="{{ $cle }}" class="btn btn-sm btn-soft-{{ $info['couleur'] }}"
                                        @if ($cle === $S::ANNULEE) data-confirm="Annuler la réservation {{ $reservation->code }} ?" @endif>
                                        <i class="{{ $info['icone'] }}"></i> {{ $info['label'] }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0"><i class="ri-shopping-basket-2-line me-1 text-success"></i> Produit réservé</h5></div>
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <img src="{{ $produit?->getFirstMediaUrl('image_principale', 'thumb') ?: asset('front/images/produits/poulet.png') }}" alt=""
                            width="84" height="84" class="rounded" style="object-fit: cover;" loading="lazy">
                        <div class="flex-grow-1">
                            <h5 class="mb-1">{{ $produit->libelle ?? 'Produit supprimé' }}</h5>
                            <span class="text-muted">{{ $fcfa($reservation->prix_unitaire) }} F × {{ $reservation->quantite ?? 1 }}</span>
                            @if ($produit)
                                <span class="ms-2 badge {{ $produit->stock > 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                    Stock actuel : {{ $produit->stock }}
                                </span>
                            @endif
                        </div>
                        <strong class="fs-5">{{ $fcfa($reservation->sous_total ?: $reservation->prix_unitaire * ($reservation->quantite ?? 1)) }} F</strong>
                    </div>
                    @if ($produit && $produit->stock > 0 && $statut === $S::EN_ATTENTE)
                        <div class="alert alert-success mt-3 mb-0"><i class="ri-information-line me-1"></i>
                            Le produit est de nouveau en stock : vous pouvez contacter le client pour confirmer.</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0"><i class="ri-user-3-line me-1 text-success"></i> Client</h5></div>
                <div class="card-body">
                    <ul class="info-list">
                        <li><i class="ri-user-line"></i><div><small>Nom</small><strong>{{ $reservation->nom ?: ($reservation->user->username ?? 'Inconnu') }}</strong></div></li>
                        <li><i class="ri-phone-line"></i><div><small>Téléphone</small><strong>{{ $reservation->telephone ?: '—' }}</strong></div></li>
                        <li><i class="ri-map-pin-line"></i><div><small>Adresse</small>
                            <strong>{{ $reservation->commune ?: '—' }}{{ $reservation->ville ? ', ' . $reservation->ville : '' }}</strong>
                            @if ($reservation->adresse)<span class="d-block text-muted small">{{ $reservation->adresse }}</span>@endif
                        </div></li>
                        @if ($reservation->commentaire)
                            <li><i class="ri-chat-3-line"></i><div><small>Commentaire</small>{{ $reservation->commentaire }}</div></li>
                        @endif
                    </ul>
                    @if ($tel)
                        <div class="d-flex gap-2 mt-3">
                            <a href="tel:{{ $tel }}" class="btn btn-soft-primary flex-fill"><i class="ri-phone-fill me-1"></i> Appeler</a>
                            <a href="https://wa.me/225{{ $tel }}?text={{ rawurlencode('Bonjour, FOANI concernant votre réservation ' . $reservation->code) }}" target="_blank" rel="noopener"
                                class="btn btn-soft-success flex-fill"><i class="ri-whatsapp-line me-1"></i> WhatsApp</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0"><i class="ri-money-dollar-circle-line me-1 text-success"></i> Montants</h5></div>
                <div class="card-body">
                    <ul class="totaux">
                        <li><span>Sous-total</span><strong>{{ $fcfa($reservation->sous_total) }} F</strong></li>
                        <li><span>Livraison</span><strong>{{ $fcfa($reservation->frais_livraison) }} F</strong></li>
                        <li class="is-total"><span>Total</span><span>{{ $fcfa($reservation->total) }} FCFA</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('formStatut').addEventListener('click', function(e) {
            var btn = e.target.closest('button[data-confirm]');
            if (btn && !confirm(btn.dataset.confirm)) e.preventDefault();
        });
    </script>
@endsection
