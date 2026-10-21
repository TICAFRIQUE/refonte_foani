@extends('backend.layouts.master')
@section('title', 'Réservations')

@section('content')
    @php
        $fcfa = fn ($v) => number_format((float) $v, 0, ',', ' ');
        $garder = array_filter(request()->only(['periode', 'date_debut', 'date_fin', 'q']));
        $periodeAffichee = $periode ?? \App\Support\Periode::depuisRequete(request(), 'mois');
    @endphp

    <div class="page-head">
        <div>
            <h1>Réservations</h1>
            <p>Produits réservés par les clients quand ils étaient en rupture de stock ·
                {{ $periode ? $periode->libelle() : 'toutes les dates' }}</p>
        </div>
        <a href="{{ route('reservations.export', array_merge($garder, ['statut' => $statut])) }}" class="btn btn-soft-success">
            <i class="ri-file-excel-2-line me-1"></i> Exporter (CSV)
        </a>
    </div>

    <div class="statut-tabs mb-3">
        <a href="{{ route('reservations.index', array_merge($garder, ['statut' => ''])) }}"
            class="statut-tab statut-tab--all {{ $statut === '' || $statut === null ? 'is-active' : '' }}">
            <span class="statut-tab__icon"><i class="ri-stack-line"></i></span>
            <span><span class="statut-tab__count">{{ $parStatut->sum('nombre') }}</span><span class="statut-tab__label">Toutes</span>
                <span class="statut-tab__amount">{{ $fcfa($parStatut->sum('montant')) }} F</span></span>
        </a>
        @foreach (\App\Support\Statut::LISTE as $cle => $info)
            @php $ligne = $parStatut->get($cle); @endphp
            <a href="{{ route('reservations.index', array_merge($garder, ['statut' => $cle])) }}"
                class="statut-tab statut-tab--{{ $info['couleur'] }} {{ $statut === $cle ? 'is-active' : '' }}">
                <span class="statut-tab__icon"><i class="{{ $info['icone'] }}"></i></span>
                <span><span class="statut-tab__count">{{ $ligne->nombre ?? 0 }}</span><span class="statut-tab__label">{{ $info['label'] }}</span>
                    <span class="statut-tab__amount">{{ $fcfa($ligne->montant ?? 0) }} F</span></span>
            </a>
        @endforeach
    </div>

    <div class="card">
        <div class="card-header">
            <form method="GET" action="{{ route('reservations.index') }}" class="row g-2 align-items-center mb-3" data-no-lock>
                <input type="hidden" name="statut" value="{{ $statut }}">
                @foreach (array_filter(request()->only(['periode', 'date_debut', 'date_fin'])) as $k => $v)
                    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                @endforeach
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text"><i class="ri-search-line"></i></span>
                        <input type="search" name="q" value="{{ request('q') }}" class="form-control"
                            placeholder="Rechercher : code, client, téléphone, produit, commune…">
                    </div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                    @if (request()->hasAny(['q', 'periode', 'date_debut', 'date_fin']))
                        <a href="{{ route('reservations.index', ['statut' => $statut]) }}" class="btn btn-light">Réinitialiser</a>
                    @endif
                </div>
            </form>
            @include('backend.components.periode-filtre', ['periode' => $periodeAffichee, 'route' => 'reservations.index', 'garder' => ['statut', 'q']])
        </div>

        <div class="card-body p-0">
            @if ($reservations->isEmpty())
                <div class="empty-box">
                    <i class="ri-calendar-check-line"></i>
                    Aucune réservation {{ $statut ? '« ' . \App\Support\Statut::label($statut) . ' »' : '' }} pour ces critères.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-modern align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Réservation</th>
                                <th>Client</th>
                                <th>Produit</th>
                                <th class="text-end">Montant</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $r)
                                <tr id="row_{{ $r->id }}">
                                    <td>
                                        <a href="{{ route('reservations.show', $r->id) }}" class="cell-main">{{ $r->code }}</a>
                                        <span class="cell-sub">{{ $r->created_at?->format('d/m/Y H:i') }} · {{ $r->created_at?->diffForHumans() }}</span>
                                    </td>
                                    <td>
                                        <span class="cell-main">{{ $r->nom ?: 'Client' }}</span>
                                        @if ($r->telephone)<a href="tel:{{ $r->telephone }}" class="cell-sub">{{ $r->telephone }}</a>@endif
                                    </td>
                                    <td>
                                        <span>{{ $r->produit->libelle ?? 'Produit supprimé' }}</span>
                                        <span class="cell-sub">× {{ $r->quantite ?? 1 }} · {{ $r->commune ?: '—' }}</span>
                                    </td>
                                    <td class="text-end fw-bold text-nowrap">{{ $fcfa($r->total) }} F</td>
                                    <td>@include('backend.components.statut-badge', ['statut' => $r->statut])</td>
                                    <td class="text-end text-nowrap">
                                        <a href="{{ route('reservations.show', $r->id) }}" class="btn btn-sm btn-soft-primary" title="Voir et traiter">
                                            <i class="ri-eye-line"></i><span class="d-none d-lg-inline ms-1">Voir</span>
                                        </a>
                                        @if ($r->telephone)
                                            <a href="https://wa.me/225{{ preg_replace('/\D/', '', $r->telephone) }}" target="_blank" rel="noopener"
                                                class="btn btn-sm btn-soft-success" title="Écrire sur WhatsApp"><i class="ri-whatsapp-line"></i></a>
                                        @endif
                                        <a href="#" class="btn btn-sm btn-soft-danger delete" data-id="{{ $r->id }}" title="Supprimer"><i class="ri-delete-bin-line"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 p-3">
                    <small class="text-muted">{{ $reservations->firstItem() }}–{{ $reservations->lastItem() }} sur {{ $reservations->total() }} réservation(s)</small>
                    {{ $reservations->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script>delete_row('reservations');</script>
@endsection
