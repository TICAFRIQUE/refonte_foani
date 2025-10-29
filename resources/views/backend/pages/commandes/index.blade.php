@extends('backend.layouts.master')

@section('title', 'Commandes')

@section('css')
    <!-- Datatables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" />
@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Commandes
        @endslot
        @slot('title')
            Liste des commandes
        @endslot
    @endcomponent

    {{-- Statistiques par statut --}}
    @php
        $_commandes = App\Models\Commande::all();
        $stats = [
            'en_attente' => $_commandes->where('statut', 'en_attente')->count(),
            'en_cours' => $_commandes->where('statut', 'en_cours')->count(),
            'livrée' => $_commandes->where('statut', 'livrée')->count(),
            'annulée' => $_commandes->where('statut', 'annulée')->count(),
        ];
        $colors = [
            'en_attente' => 'secondary',
            'en_cours' => 'warning',
            'livrée' => 'success',
            'annulée' => 'danger',
        ];
    @endphp
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-3 justify-content-center">
                @foreach ($stats as $statut => $count)
                    <div class="card border-0 shadow-sm" style="min-width:160px;">
                        <a href="{{ route('commandes.index', ['statut' => $statut]) }}">
                            <div class="card-body text-center">
                                <span class="badge bg-{{ $colors[$statut] ?? 'secondary' }} mb-2" style="font-size:1.1em;">
                                    {{ ucfirst(str_replace('_', ' ', $statut)) }}
                                </span>
                                <div class="fw-bold fs-4">{{ $count }}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Filtre par statut et date --}}
    <div class="row mb-3">
        <div class="col-lg-8 mx-auto">
            <form method="GET" action="{{ route('commandes.index') }}"
                class="row g-2 align-items-end justify-content-center">
                <div class="col-md-3">
                    <label for="date_debut" class="form-label mb-0">Date début</label>
                    <input type="date" id="date_debut" name="date_debut" class="form-control"
                        value="{{ request('date_debut') }}">
                </div>
                <div class="col-md-4">
                    <label for="date_fin" class="form-label mb-0">Date fin</label>
                    <input type="date" id="date_fin" name="date_fin" class="form-control"
                        value="{{ request('date_fin') }}">
                </div>
                <div class="col-md-3 d-flex">
                    <select name="statut" class="form-select">
                        <option value="">-- Tous les statuts --</option>
                        <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente
                        </option>
                        <option value="en_cours" {{ request('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="livrée" {{ request('statut') == 'livrée' ? 'selected' : '' }}>Livrée</option>
                        <option value="annulée" {{ request('statut') == 'annulée' ? 'selected' : '' }}>Annulée</option>
                    </select>

                </div>
                <div class="col-md-2 d-flex">
                    <button class="btn btn-primary w-100" type="submit">
                        <i class="bi bi-filter"></i> Filtrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Liste des commandes</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered table-striped dt-responsive nowrap"
                            style="width:100%">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Client</th>
                                    <th>Contact</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commandes as $commande)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $commande->code }}</strong></td>
                                        <td>{{ $commande->user->username ?? 'Inconnu' }}</td>
                                        <td>{{ $commande->telephone ?? '—' }}</td>
                                        <td>{{ $commande->total ?? '-' }} F</td>
                                        <td>{{ $commande->created_at?->format('d/m/Y H:i') ?? '—' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $colors[$commande->statut] ?? 'secondary' }}">
                                                {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ri-more-fill"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a href="{{ route('commandes.show', $commande->id) }}"
                                                            class="dropdown-item">
                                                            <i class="ri-eye-fill align-bottom me-2 text-muted"></i> Voir

                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="dropdown-item remove-item-btn delete"
                                                            data-id={{ $commande->id }}>
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Supprimer
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- jQuery et DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <!-- Initialisation DataTables -->
    <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @include('backend.pages.commandes.scripts.new_orders_script')


    <script>
        window.routeName = "commandes";
    </script>
@endsection
