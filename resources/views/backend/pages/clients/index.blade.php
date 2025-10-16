@extends('backend.layouts.master')

@section('title')
    Clients
@endsection

@section('css')
    <!-- Datatables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" />
@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Liste
        @endslot
        @slot('title')
            Clients
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">


                <div class="card-body">
                    <div class="table-responsive">
                        <table id="clients-table" class="display table table-bordered table-hover" style="width:100%">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>

                                    <th>Date création</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr id="row_{{ $client->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $client->name ?? ($client->username ?? '—') }}</td>
                                        <td>{{ $client->email ?? '—' }}</td>
                                        <td>{{ $client->phone ?? '—' }}</td>

                                        <td>{{ $client->created_at?->format('d/m/Y') ?? '—' }}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-danger delete"
                                                data-id="{{ $client->id }}" title="Supprimer">
                                                <i class="ri-delete-bin-fill"></i>
                                            </a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <!-- Boutons d’export -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!-- Initialisation DataTables -->
    <script>
        $(document).ready(function() {
            const table = $('#clients-table').DataTable({
                responsive: true,
                dom: 'Bfrtip', // Boutons + recherche + pagination
                buttons: [{
                        extend: 'copy',
                        text: ' copy',
                        className: 'btn btn-secondary btn-sm'
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        className: 'btn btn-success btn-sm'
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        className: 'btn btn-danger btn-sm'
                    },
                    {
                        extend: 'print',
                        text: ' print',
                        className: 'btn btn-info btn-sm'
                    }
                ],
                order: [
                    [0, 'asc']
                ],
                pageLength: 25,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr_fr.json'
                }
            });

            // Replacer les boutons dans le header
            table.buttons().container().appendTo('#clients-table_wrapper .col-md-6:eq(0)');


        });
    </script>

    <script>
        // suppression centralisée
        const route = "clients";
        delete_row(route);
    </script>
@endsection
