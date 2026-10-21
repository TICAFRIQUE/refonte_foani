@extends('backend.layouts.master')

@section('title')
    Tableau de bord
@endsection

@section('content')
    @php
        $heure = now()->hour;
        $salut = $heure < 12 ? 'Bonjour' : ($heure < 18 ? 'Bon après-midi' : 'Bonsoir');
        $fcfa = fn ($v) => number_format((float) $v, 0, ',', ' ');
        // Paramètres de période à transmettre aux listes (commandes, rapport)
        $lienPeriode = $periode->preset === 'perso'
            ? ['date_debut' => $periode->debut->toDateString(), 'date_fin' => $periode->fin->toDateString()]
            : ['periode' => $periode->preset];
    @endphp

    {{-- En-tête --}}
    <div class="page-head">
        <div>
            <h1>{{ $salut }}, {{ Auth::user()->username }} 👋</h1>
            <p>Voici l'activité de la boutique FOANI <strong>{{ $periode->libelle() }}</strong>.</p>
        </div>
        <span class="text-muted small"><i class="ri-calendar-line me-1"></i>{{ Str::ucfirst(now()->locale('fr')->translatedFormat('l d F Y')) }}</span>
    </div>

    <div class="card mb-4">
        <div class="card-body py-3">
            @include('backend.components.periode-filtre', ['periode' => $periode, 'route' => 'dashboard.index'])
        </div>
    </div>

    {{-- Indicateurs de la période --}}
    <div class="row g-3 mb-3">
        <div class="col-6 col-xl-3">
            @include('backend.components.kpi', [
                'icone' => 'ri-money-dollar-circle-line', 'couleur' => 'success', 'label' => 'Chiffre d\'affaires',
                'valeur' => $fcfa($kpis['ca']), 'unite' => 'FCFA', 'evolution' => $kpis['ca_evol'], 'aide' => 'commandes livrées',
            ])
        </div>
        <div class="col-6 col-xl-3">
            @include('backend.components.kpi', [
                'icone' => 'ri-shopping-cart-2-line', 'couleur' => 'primary', 'label' => 'Montant commandé',
                'valeur' => $fcfa($kpis['montant']), 'unite' => 'FCFA', 'evolution' => $kpis['montant_evol'], 'aide' => 'hors annulations',
            ])
        </div>
        <div class="col-6 col-xl-3">
            @include('backend.components.kpi', [
                'icone' => 'ri-file-list-3-line', 'couleur' => 'info', 'label' => 'Commandes',
                'valeur' => $kpis['commandes'], 'evolution' => $kpis['commandes_evol'],
                'aide' => 'panier moyen ' . $fcfa($kpis['panier']) . ' F',
                'lien' => route('commandes.index', $lienPeriode),
            ])
        </div>
        <div class="col-6 col-xl-3">
            @include('backend.components.kpi', [
                'icone' => 'ri-user-add-line', 'couleur' => 'secondary', 'label' => 'Nouveaux clients',
                'valeur' => $kpis['clients'], 'evolution' => $kpis['clients_evol'], 'aide' => $fcfa($kpis['total_clients']) . ' au total',
                'lien' => route('client.index_client'),
            ])
        </div>
    </div>

    {{-- À traiter --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            @include('backend.components.kpi', [
                'icone' => 'ri-time-line', 'couleur' => 'warning', 'label' => 'Commandes en attente',
                'valeur' => $kpis['en_attente'], 'aide' => 'à confirmer', 'lien' => route('commandes.index', ['statut' => 'en_attente']),
            ])
        </div>
        <div class="col-6 col-xl-3">
            @include('backend.components.kpi', [
                'icone' => 'ri-truck-line', 'couleur' => 'info', 'label' => 'En cours de livraison',
                'valeur' => $kpis['en_cours'], 'aide' => 'à livrer', 'lien' => route('commandes.index', ['statut' => 'en_cours']),
            ])
        </div>
        <div class="col-6 col-xl-3">
            @include('backend.components.kpi', [
                'icone' => 'ri-calendar-check-line', 'couleur' => 'primary', 'label' => 'Réservations',
                'valeur' => $kpis['reservations'], 'aide' => 'en attente', 'lien' => route('reservations.index', ['statut' => 'en_attente']),
            ])
        </div>
        <div class="col-6 col-xl-3">
            @include('backend.components.kpi', [
                'icone' => 'ri-mail-unread-line', 'couleur' => 'danger', 'label' => 'Messages',
                'valeur' => $kpis['messages'], 'aide' => 'non lus', 'lien' => route('contact.index'),
            ])
        </div>
    </div>

    {{-- Graphiques --}}
    <div class="row g-3 mb-4">
        <div class="col-xl-8">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0"><i class="ri-line-chart-line me-1 text-success"></i> Ventes des 12 derniers mois</h5>
                    <small class="text-muted">FCFA</small>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 320px;">
                        <canvas id="ventesChart" aria-label="Graphique des ventes sur 12 mois" role="img"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-pie-chart-2-line me-1 text-success"></i> Statut des commandes</h5>
                </div>
                <div class="card-body">
                    @if ($repartition->isEmpty())
                        <div class="empty-box"><i class="ri-inbox-line"></i>Aucune commande sur la période.</div>
                    @else
                        <div style="position: relative; height: 200px;">
                            <canvas id="statutsChart" aria-label="Répartition des commandes par statut" role="img"></canvas>
                        </div>
                        <ul class="rank-list mt-3">
                            @foreach (\App\Support\Statut::LISTE as $cle => $info)
                                @php $ligne = $repartition->get($cle); @endphp
                                <li class="d-flex justify-content-between align-items-center">
                                    @include('backend.components.statut-badge', ['statut' => $cle])
                                    <span class="text-end">
                                        <strong>{{ $ligne->nombre ?? 0 }}</strong>
                                        <small class="text-muted d-block">{{ $fcfa($ligne->montant ?? 0) }} F</small>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- À traiter + classements --}}
    <div class="row g-3">
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0"><i class="ri-alarm-warning-line me-1 text-warning"></i> Commandes à traiter</h5>
                    <a href="{{ route('commandes.index', ['statut' => 'en_attente']) }}" class="btn btn-sm btn-soft-primary">Tout voir</a>
                </div>
                <div class="card-body p-0">
                    @forelse ($aTraiter as $c)
                        <a href="{{ route('commandes.show', $c->id) }}" class="d-flex align-items-center gap-3 px-3 py-2 border-bottom text-reset text-decoration-none">
                            <div class="flex-grow-1 min-w-0">
                                <div class="fw-semibold text-truncate">{{ $c->code }} · {{ $c->nom ?: 'Client' }}</div>
                                <small class="text-muted">{{ $c->commune ?: '—' }} · {{ $c->created_at?->diffForHumans() }}</small>
                            </div>
                            <div class="text-end flex-shrink-0">
                                <div class="fw-bold text-nowrap">{{ $fcfa($c->total) }} F</div>
                                @include('backend.components.statut-badge', ['statut' => $c->statut])
                            </div>
                        </a>
                    @empty
                        <div class="empty-box"><i class="ri-checkbox-circle-line"></i>Tout est traité, bravo !</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card h-100">
                <div class="card-header"><h5 class="card-title mb-0"><i class="ri-medal-line me-1 text-success"></i> Top produits</h5></div>
                <div class="card-body pt-1">
                    @php $maxQ = max(1, (float) $topProduits->max('quantite')); @endphp
                    <ul class="rank-list">
                        @forelse ($topProduits as $p)
                            <li>
                                <div class="rank-list__top">
                                    <strong class="text-truncate"><span class="rank-pos">{{ $loop->iteration }}</span>{{ $p->libelle }}</strong>
                                    <span class="text-nowrap">{{ (int) $p->quantite }} u.</span>
                                </div>
                                <div class="rank-list__bar"><span style="width: {{ round($p->quantite / $maxQ * 100) }}%"></span></div>
                            </li>
                        @empty
                            <li class="empty-box border-0">Aucune vente sur la période.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card h-100">
                <div class="card-header"><h5 class="card-title mb-0"><i class="ri-vip-crown-line me-1 text-warning"></i> Meilleurs clients</h5></div>
                <div class="card-body pt-1">
                    <ul class="rank-list">
                        @forelse ($topClients as $cl)
                            <li class="d-flex justify-content-between align-items-center">
                                <span class="text-truncate"><span class="rank-pos">{{ $loop->iteration }}</span>{{ $cl->nom ?: 'Client' }}</span>
                                <span class="text-end text-nowrap"><strong>{{ $fcfa($cl->montant) }} F</strong><small class="text-muted d-block">{{ $cl->nombre }} cde(s)</small></span>
                            </li>
                        @empty
                            <li class="empty-box border-0">Aucun client sur la période.</li>
                        @endforelse
                    </ul>
                    @if ($topCommunes->isNotEmpty())
                        <h6 class="mt-3 mb-1 text-muted text-uppercase fs-12">Communes les plus actives</h6>
                        <ul class="rank-list">
                            @foreach ($topCommunes as $co)
                                <li class="d-flex justify-content-between py-2"><span><i class="ri-map-pin-line text-success me-1"></i>{{ $co->commune }}</span><strong>{{ $co->nombre }}</strong></li>
                            @endforeach
                        </ul>
                    @endif
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
            var fcfa = function(v) { return new Intl.NumberFormat('fr-FR').format(v) + ' F'; };
            Chart.defaults.font.family = getComputedStyle(document.body).fontFamily;
            Chart.defaults.color = '#6b7280';

            new Chart(document.getElementById('ventesChart'), {
                data: {
                    labels: g.labels,
                    datasets: [
                        { type: 'bar', label: 'Montant commandé', data: g.montant, backgroundColor: 'rgba(61, 139, 47, .25)', hoverBackgroundColor: 'rgba(61, 139, 47, .45)', borderRadius: 6, order: 2 },
                        { type: 'line', label: 'Encaissé (livrées)', data: g.encaisse, borderColor: '#f1c40f', backgroundColor: '#f1c40f', borderWidth: 3, cubicInterpolationMode: 'monotone', pointRadius: 3, order: 1 }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { position: 'bottom', labels: { usePointStyle: true } },
                        tooltip: { callbacks: { label: function(c) { return ' ' + c.dataset.label + ' : ' + fcfa(c.parsed.y); },
                            afterBody: function(items) { return 'Commandes : ' + g.nombre[items[0].dataIndex]; } } }
                    },
                    scales: {
                        y: { beginAtZero: true, ticks: { callback: function(v) { return v >= 1e6 ? (v / 1e6).toLocaleString('fr-FR') + ' M' : v >= 1e3 ? (v / 1e3).toLocaleString('fr-FR') + ' k' : v; } }, grid: { color: 'rgba(0,0,0,.05)' } },
                        x: { grid: { display: false }, ticks: { maxRotation: 0, autoSkip: true, maxTicksLimit: 12 } }
                    }
                }
            });

            var st = document.getElementById('statutsChart');
            if (st) {
                var rep = @json($repartition->map(fn ($r) => (int) $r->nombre));
                var labels = @json(collect(\App\Support\Statut::LISTE)->map(fn ($i) => $i['label']));
                var couleurs = { en_attente: '#f1b40f', en_cours: '#1e88c7', 'livrée': '#3d8b2f', 'annulée': '#d64545' };
                var cles = Object.keys(labels).filter(function(k) { return rep[k]; });
                new Chart(st, {
                    type: 'doughnut',
                    data: { labels: cles.map(function(k) { return labels[k]; }), datasets: [{ data: cles.map(function(k) { return rep[k]; }), backgroundColor: cles.map(function(k) { return couleurs[k]; }), borderWidth: 2 }] },
                    options: { maintainAspectRatio: false, cutout: '68%', plugins: { legend: { display: false } } }
                });
            }
        })();
    </script>
@endsection
