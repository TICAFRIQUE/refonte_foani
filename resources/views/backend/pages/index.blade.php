@extends('backend.layouts.master')
@section('title')
    Tableau de bord
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/chart.js" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                               @auth
                               <h4 class="fs-16 mb-1">Bonjour, {{ Auth::user()->username }} !</h4>
                               @endauth
                                <p class="text-muted mb-0">Voici ce qui se passe avec votre restaurant aujourd'hui.</p>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                <form action="javascript:void(0);">
                                    <div class="row g-3 mb-0 align-items-center">
                                        <div class="col-sm-auto">
                                            <div class="input-group input-group-lg">
                                                <input type="text"
                                                    class="form-control border-0 minimal-border shadow fs-5" id="horloge"
                                                    readonly>
                                                <input type="text"
                                                    class="form-control border-0 minimal-border shadow fs-5" id="date"
                                                    readonly>
                                                <div class="input-group-text bg-primary border-primary text-white">
                                                    <i class="ri-time-line me-2"></i>
                                                    <i class="ri-calendar-line"></i>
                                                </div>
                                            </div>
                                            <script>
                                                function mettreAJourHorloge() {
                                                    var maintenant = new Date();
                                                    var heures = maintenant.getHours().toString().padStart(2, '0');
                                                    var minutes = maintenant.getMinutes().toString().padStart(2, '0');
                                                    var secondes = maintenant.getSeconds().toString().padStart(2, '0');
                                                    document.getElementById('horloge').value = heures + ':' + minutes + ':' + secondes;

                                                    var options = {
                                                        weekday: 'long',
                                                        year: 'numeric',
                                                        month: 'long',
                                                        day: 'numeric'
                                                    };
                                                    var dateEnFrancais = maintenant.toLocaleDateString('fr-FR', options);
                                                    document.getElementById('date').value = dateEnFrancais;
                                                }

                                                setInterval(mettreAJourHorloge, 1000);
                                                mettreAJourHorloge();
                                            </script>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Statistiques --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-2 col-6">
                        <div class="card shadow-sm border-0 text-center">
                            <div class="card-body">
                                <div class="fs-2 text-success"><i class="bi bi-people"></i></div>
                                <div class="fw-bold fs-4">{{ $nbClients }}</div>
                                <div class="text-muted">Clients</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="card shadow-sm border-0 text-center">
                            <div class="card-body">
                                <div class="fs-2 text-warning"><i class="bi bi-clock-history"></i></div>
                                <div class="fw-bold fs-4">{{ $nbCommandesEnAttente }}</div>
                                <div class="text-muted">Commandes en attente</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="card shadow-sm border-0 text-center">
                            <div class="card-body">
                                <div class="fs-2 text-info"><i class="bi bi-calendar-check"></i></div>
                                <div class="fw-bold fs-4">{{ $nbReservations }}</div>
                                <div class="text-muted">Réservations en attente</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="card shadow-sm border-0 text-center">
                            <div class="card-body">
                                <div class="fs-2 text-primary"><i class="bi bi-bag-check"></i></div>
                                <div class="fw-bold fs-4">{{ $nbVentes }}</div>
                                <div class="text-muted">Ventes réalisées</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="card shadow-sm border-0 text-center">
                            <div class="card-body">
                                <div class="fs-2 text-success"><i class="bi bi-cash-stack"></i></div>
                                <div class="fw-bold fs-4">{{ number_format($chiffreAffaire, 0, ',', ' ') }} FCFA</div>
                                <div class="text-muted">Chiffre d'affaires ({{ \Carbon\Carbon::parse($date_debut)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($date_fin)->format('d/m/Y') }})</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Graphique chiffre d'affaires --}}
                <div class="row mb-4">
                    <div class="col-lg-8 mx-auto">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-success text-white fw-bold">Chiffre d'affaires par mois</div>
                            <div class="card-body">
                                <canvas id="revenuChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Top produits vendus --}}
                <div class="row mb-4">
                    <div class="col-lg-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-primary text-white fw-bold">Top produits vendus</div>
                            <div class="card-body p-0">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Produit</th>
                                            <th>Quantité</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($produitsLesPlusVendus as $prod)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $prod->libelle }}</td>
                                                <td>{{ $prod->quantite_vendue }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Top clients --}}
                    <div class="col-lg-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-info text-white fw-bold">Clients les plus actifs</div>
                            <div class="card-body p-0">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Client</th>
                                            <th>Commandes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clientsTopCommandes as $client)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $client->username }}</td>
                                                <td>{{ $client->nb_commandes }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- end .h-100-->
        </div> <!-- end col -->
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenuChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: "Chiffre d'affaires",
                    data: {!! json_encode($data) !!},
                    borderColor: '#2a6b2a',
                    backgroundColor: 'rgba(42,107,42,0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
