@extends('backend.layouts.master')
@section('title', 'Commandes')

@section('content')
    @php
        $fcfa = fn ($v) => number_format((float) $v, 0, ',', ' ');
        $totalNombre = $parStatut->sum('nombre');
        $totalMontant = $parStatut->sum('montant');
        // Paramètres à conserver d'un onglet à l'autre
        $garder = array_filter(request()->only(['periode', 'date_debut', 'date_fin', 'q']));
        $periodeAffichee = $periode ?? \App\Support\Periode::depuisRequete(request(), 'mois');
    @endphp

    <div class="page-head">
        <div>
            <h1>Commandes</h1>
            <p>
                {{ $periode ? 'Période : ' . $periode->libelle() : 'Toutes les dates' }}
                @if (request('q')) · recherche « {{ request('q') }} » @endif
            </p>
        </div>
        <a href="{{ route('commandes.export', array_merge($garder, ['statut' => $statut])) }}" class="btn btn-soft-success">
            <i class="ri-file-excel-2-line me-1"></i> Exporter (CSV)
        </a>
    </div>

    {{-- Bandeau : nouvelles commandes arrivées pendant la consultation (public/back/js/admin.js) --}}
    <div class="new-items-banner" id="nouvellesCommandes">
        <span><i class="ri-notification-3-line me-1"></i> De nouvelles commandes sont arrivées.</span>
        <a href="{{ route('commandes.index', ['statut' => 'en_attente']) }}" class="btn btn-sm btn-warning">Actualiser la liste</a>
    </div>

    {{-- Onglets de statut --}}
    <div class="statut-tabs mb-3">
        <a href="{{ route('commandes.index', array_merge($garder, ['statut' => ''])) }}"
            class="statut-tab statut-tab--all {{ $statut === '' || $statut === null ? 'is-active' : '' }}">
            <span class="statut-tab__icon"><i class="ri-stack-line"></i></span>
            <span><span class="statut-tab__count">{{ $totalNombre }}</span><span class="statut-tab__label">Toutes</span>
                <span class="statut-tab__amount">{{ $fcfa($totalMontant) }} F</span></span>
        </a>
        @foreach (\App\Support\Statut::LISTE as $cle => $info)
            @php $ligne = $parStatut->get($cle); @endphp
            <a href="{{ route('commandes.index', array_merge($garder, ['statut' => $cle])) }}"
                class="statut-tab statut-tab--{{ $info['couleur'] }} {{ $statut === $cle ? 'is-active' : '' }}">
                <span class="statut-tab__icon"><i class="{{ $info['icone'] }}"></i></span>
                <span><span class="statut-tab__count">{{ $ligne->nombre ?? 0 }}</span><span class="statut-tab__label">{{ $info['label'] }}</span>
                    <span class="statut-tab__amount">{{ $fcfa($ligne->montant ?? 0) }} F</span></span>
            </a>
        @endforeach
    </div>

    <div class="card">
        <div class="card-header">
            {{-- Recherche + période --}}
            <form method="GET" action="{{ route('commandes.index') }}" class="row g-2 align-items-center mb-3" data-no-lock>
                <input type="hidden" name="statut" value="{{ $statut }}">
                @foreach (array_filter(request()->only(['periode', 'date_debut', 'date_fin'])) as $k => $v)
                    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                @endforeach
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text"><i class="ri-search-line"></i></span>
                        <input type="search" name="q" value="{{ request('q') }}" class="form-control"
                            placeholder="Rechercher : code, client, téléphone, commune…">
                    </div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                    @if (request()->hasAny(['q', 'periode', 'date_debut', 'date_fin']))
                        <a href="{{ route('commandes.index', ['statut' => $statut]) }}" class="btn btn-light">Réinitialiser</a>
                    @endif
                </div>
            </form>
            @include('backend.components.periode-filtre', ['periode' => $periodeAffichee, 'route' => 'commandes.index', 'garder' => ['statut', 'q']])
            @unless ($periode)
                <small class="text-muted d-block mt-2"><i class="ri-information-line"></i> Aucune période sélectionnée : toutes les dates sont affichées.</small>
            @endunless
        </div>

        <div class="card-body p-0">
            @if ($commandes->isEmpty())
                <div class="empty-box">
                    <i class="ri-inbox-2-line"></i>
                    Aucune commande {{ $statut ? '« ' . \App\Support\Statut::label($statut) . ' »' : '' }} pour ces critères.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-modern align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Commande</th>
                                <th>Client</th>
                                <th>Livraison</th>
                                <th class="text-end">Montant</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commandes as $commande)
                                <tr id="row_{{ $commande->id }}">
                                    <td>
                                        <a href="{{ route('commandes.show', $commande->id) }}" class="cell-main">{{ $commande->code }}</a>
                                        <span class="cell-sub" title="{{ $commande->created_at?->format('d/m/Y H:i') }}">
                                            {{ $commande->created_at?->format('d/m/Y H:i') }} · {{ $commande->created_at?->diffForHumans() }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="cell-main">{{ $commande->nom ?: 'Client' }}</span>
                                        @if ($commande->telephone)
                                            <a href="tel:{{ $commande->telephone }}" class="cell-sub">{{ $commande->telephone }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        <span>{{ $commande->commune ?: '—' }}</span>
                                        <span class="cell-sub">{{ $commande->ville }}</span>
                                    </td>
                                    <td class="text-end fw-bold text-nowrap">{{ $fcfa($commande->total) }} F</td>
                                    <td>@include('backend.components.statut-badge', ['statut' => $commande->statut])</td>
                                    <td class="text-end text-nowrap">
                                        <a href="{{ route('commandes.show', $commande->id) }}" class="btn btn-sm btn-soft-primary" title="Voir et traiter">
                                            <i class="ri-eye-line"></i><span class="d-none d-lg-inline ms-1">Voir</span>
                                        </a>
                                        @if ($commande->telephone)
                                            <a href="https://wa.me/225{{ preg_replace('/\D/', '', $commande->telephone) }}" target="_blank" rel="noopener"
                                                class="btn btn-sm btn-soft-success" title="Écrire sur WhatsApp"><i class="ri-whatsapp-line"></i></a>
                                        @endif
                                        <a href="#" class="btn btn-sm btn-soft-danger delete" data-id="{{ $commande->id }}" title="Supprimer"><i class="ri-delete-bin-line"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 p-3">
                    <small class="text-muted">{{ $commandes->firstItem() }}–{{ $commandes->lastItem() }} sur {{ $commandes->total() }} commande(s)</small>
                    {{ $commandes->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script>
        delete_row('commandes');

        // Nouvelles commandes : le bandeau apparaît si le nombre « en attente » augmente
        // par rapport au premier relevé fait à l'ouverture de la page
        (function() {
            var reference = null;
            document.addEventListener('foani:notifications', function(e) {
                var n = e.detail.counts.commandes || 0;
                if (reference === null) { reference = n; return; }
                if (n > reference) document.getElementById('nouvellesCommandes').classList.add('is-visible');
            });
        })();
    </script>
@endsection
