@extends('backend.layouts.master')
@section('title', 'Rapport de ventes')

@section('content')
    @php
        $fcfa = fn ($v) => number_format((float) $v, 0, ',', ' ');
        $params = array_filter(request()->only(['periode', 'date_debut', 'date_fin', 'base']));
        $maxCat = max(1, (float) $categories->max('montant'));
        $maxCommune = max(1, (float) $communes->max('montant'));
    @endphp

    <div class="page-head">
        <div>
            <h1>Rapport de ventes</h1>
            <p>{{ Str::ucfirst($periode->libelle()) }} ·
                {{ $base === 'toutes' ? 'toutes les commandes (hors annulations)' : 'commandes livrées uniquement (chiffre encaissé)' }}</p>
        </div>
        <div class="d-flex flex-wrap gap-2 d-print-none">
            <a href="{{ route('rapports.vente.export', $params) }}" class="btn btn-soft-success"><i class="ri-file-excel-2-line me-1"></i> Exporter (CSV)</a>
            <button type="button" class="btn btn-soft-secondary" onclick="window.print()"><i class="ri-printer-line me-1"></i> Imprimer</button>
        </div>
    </div>

    <div class="card d-print-none">
        <div class="card-body py-3 d-flex flex-column gap-3">
            @include('backend.components.periode-filtre', ['periode' => $periode, 'route' => 'rapports.vente', 'garder' => ['base']])
            <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="text-muted small fw-semibold">Commandes prises en compte :</span>
                @foreach (['livrees' => 'Livrées (encaissé)', 'toutes' => 'Toutes hors annulations'] as $cle => $libelle)
                    <a href="{{ route('rapports.vente', array_merge($params, ['base' => $cle])) }}"
                        class="periode-filtre__pill {{ $base === $cle ? 'is-active' : '' }}">{{ $libelle }}</a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Indicateurs --}}
    <div class="kpi-grid mb-4">
        <div>
            @include('backend.components.kpi', ['icone' => 'ri-money-dollar-circle-line', 'couleur' => 'success', 'label' => 'Chiffre d\'affaires',
                'valeur' => $fcfa($kpis['ca']), 'unite' => 'FCFA', 'evolution' => $kpis['ca_evol'], 'aide' => 'vs période précédente'])
        </div>
        <div>
            @include('backend.components.kpi', ['icone' => 'ri-file-list-3-line', 'couleur' => 'info', 'label' => 'Commandes',
                'valeur' => $kpis['commandes'], 'evolution' => $kpis['commandes_evol']])
        </div>
        <div>
            @include('backend.components.kpi', ['icone' => 'ri-shopping-basket-line', 'couleur' => 'primary', 'label' => 'Panier moyen',
                'valeur' => $fcfa($kpis['panier']), 'unite' => 'FCFA'])
        </div>
        <div>
            @include('backend.components.kpi', ['icone' => 'ri-stack-line', 'couleur' => 'warning', 'label' => 'Articles vendus',
                'valeur' => $fcfa($kpis['articles'])])
        </div>
        <div>
            @include('backend.components.kpi', ['icone' => 'ri-truck-line', 'couleur' => 'secondary', 'label' => 'Frais de livraison',
                'valeur' => $fcfa($kpis['livraison']), 'unite' => 'FCFA', 'aide' => 'inclus dans le CA'])
        </div>
    </div>

    {{-- Évolution --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><i class="ri-line-chart-line me-1 text-success"></i> Évolution des ventes {{ $parJour ? 'par jour' : 'par mois' }}</h5>
            <small class="text-muted">FCFA</small>
        </div>
        <div class="card-body">
            <div style="position: relative; height: 280px;"><canvas id="rapportChart" role="img" aria-label="Évolution des ventes"></canvas></div>
        </div>
    </div>

    <div class="row g-3">
        {{-- Par produit --}}
        <div class="col-xl-8">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0"><i class="ri-shopping-basket-2-line me-1 text-success"></i> Ventes par produit</h5>
                    <span class="badge bg-success-subtle text-success">{{ $produits->count() }} produit(s)</span>
                </div>
                <div class="card-body p-0">
                    @if ($produits->isEmpty())
                        <div class="empty-box"><i class="ri-bar-chart-box-line"></i>Aucune vente sur cette période.
                            @if ($base !== 'toutes')
                                <div class="mt-2"><a href="{{ route('rapports.vente', array_merge($params, ['base' => 'toutes'])) }}">Voir toutes les commandes (hors annulations)</a></div>
                            @endif
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-modern align-middle mb-0">
                                <thead>
                                    <tr><th>#</th><th>Produit</th><th class="text-center">Quantité</th><th class="text-end">Montant</th><th style="width: 22%">Part</th></tr>
                                </thead>
                                <tbody>
                                    @foreach ($produits as $p)
                                        @php $part = $p->montant / $totalProduits * 100; @endphp
                                        <tr>
                                            <td><span class="rank-pos">{{ $loop->iteration }}</span></td>
                                            <td><span class="cell-main">{{ $p->libelle }}</span><span class="cell-sub">{{ $p->categorie ?: 'Sans catégorie' }} · {{ $p->commandes }} commande(s)</span></td>
                                            <td class="text-center">{{ $fcfa($p->quantite) }}</td>
                                            <td class="text-end fw-semibold text-nowrap">{{ $fcfa($p->montant) }} F</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="rank-list__bar flex-grow-1"><span style="width: {{ round($part, 1) }}%"></span></div>
                                                    <small class="text-muted text-nowrap">{{ number_format($part, 1, ',', ' ') }} %</small>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="fw-bold">
                                        <td colspan="2" class="text-end">Total</td>
                                        <td class="text-center">{{ $fcfa($produits->sum('quantite')) }}</td>
                                        <td class="text-end text-nowrap">{{ $fcfa($produits->sum('montant')) }} F</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Par catégorie et par commune --}}
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0"><i class="ri-price-tag-3-line me-1 text-success"></i> Par catégorie</h5></div>
                <div class="card-body pt-1">
                    <ul class="rank-list">
                        @forelse ($categories as $c)
                            <li>
                                <div class="rank-list__top"><strong>{{ $c->nom }}</strong><span class="text-nowrap">{{ $fcfa($c->montant) }} F</span></div>
                                <div class="rank-list__bar"><span style="width: {{ round($c->montant / $maxCat * 100) }}%"></span></div>
                            </li>
                        @empty
                            <li class="empty-box border-0">—</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0"><i class="ri-map-pin-line me-1 text-success"></i> Par commune de livraison</h5></div>
                <div class="card-body pt-1">
                    <ul class="rank-list">
                        @forelse ($communes as $co)
                            <li>
                                <div class="rank-list__top"><strong>{{ $co->commune }}</strong><span class="text-nowrap">{{ $co->nombre }} cde · {{ $fcfa($co->montant) }} F</span></div>
                                <div class="rank-list__bar"><span style="width: {{ round($co->montant / $maxCommune * 100) }}%"></span></div>
                            </li>
                        @empty
                            <li class="empty-box border-0">—</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('front/vendor/chartjs-4.4.1/chart.umd.js') }}"></script>
    <script>
        (function() {
            var g = @json($graphique);
            Chart.defaults.font.family = getComputedStyle(document.body).fontFamily;
            Chart.defaults.color = '#6b7280';
            var ctx = document.getElementById('rapportChart');
            var degrade = ctx.getContext('2d').createLinearGradient(0, 0, 0, 280);
            degrade.addColorStop(0, 'rgba(61, 139, 47, .35)');
            degrade.addColorStop(1, 'rgba(61, 139, 47, 0)');
            new Chart(ctx, {
                type: 'line',
                data: { labels: g.labels, datasets: [{ label: 'Ventes', data: g.montant, borderColor: '#3d8b2f', backgroundColor: degrade, fill: true, cubicInterpolationMode: 'monotone', borderWidth: 3, pointRadius: g.labels.length > 40 ? 0 : 3 }] },
                options: {
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: { legend: { display: false }, tooltip: { callbacks: { label: function(c) { return ' ' + new Intl.NumberFormat('fr-FR').format(c.parsed.y) + ' FCFA'; } } } },
                    scales: { y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,.05)' } }, x: { grid: { display: false }, ticks: { maxTicksLimit: 12 } } }
                }
            });
        })();
    </script>
@endsection
