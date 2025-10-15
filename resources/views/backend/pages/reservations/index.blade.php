@extends('backend.layouts.master')

@section('title', 'Réservations')

@section('css')
    <!-- Datatables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" />
@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Réservations
        @endslot
        @slot('title')
            Liste des réservations
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Liste des réservations</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="reservations-table" class="table table-bordered table-striped dt-responsive nowrap"
                            style="width:100%">
                            <thead class="table-primary">
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>Code</th>
                                    <th>Client</th>
                                    <th>Contact</th>
                                    <th>Produit</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $colors = [
                                        'en_attente' => 'secondary',
                                        'en_cours' => 'warning',
                                        'livrée' => 'success',
                                        'annulée' => 'danger',
                                    ];
                                @endphp

                                @foreach ($reservations as $reservation)
                                    <tr>
                                        {{-- <td>{{ $loop->iteration }}</td> --}}
                                        <td><strong>{{ $reservation->code }}</strong></td>
                                        <td>{{ $reservation->user->username ?? ($reservation->nom ?? 'Inconnu') }}</td>
                                        <td>{{ $reservation->telephone ?? '—' }}</td>
                                        <td>{{ $reservation->produit->libelle ?? '—' }}</td>
                                    
                                        <td>
                                            <span class="badge bg-success">
                                                {{ number_format($reservation->total, 0, ',', ' ') }} F
                                            </span>
                                        </td>
                                        <td>
                                            {{ $reservation->date_reservation ? \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y H:i') : '—' }}
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $colors[$reservation->statut] ?? 'secondary' }}">
                                                {{ ucfirst(str_replace('_', ' ', $reservation->statut)) }}
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
                                                        <a href="{{ route('reservation.show', $reservation->id) }}"
                                                            class="dropdown-item">
                                                            <i class="ri-eye-fill align-bottom me-2 text-muted"></i> Voir

                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('reservation.delete', $reservation->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger"
                                                                onclick="return confirm('Supprimer cette reservation ?')">
                                                                <i class="ri-delete-bin-fill align-bottom me-2"></i>
                                                                Supprimer
                                                            </button>
                                                        </form>
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

    <script>
        $(document).ready(function() {
            $('#reservations-table').DataTable({
                responsive: true,
                order: [
                    [0, 'asc']
                ],
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'pdf', 'print']
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            const route = "reservation";
            delete_row(route);
        });
    </script>
@endsection
