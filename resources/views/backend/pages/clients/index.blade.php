@extends('backend.layouts.master')

@section('title')
    Clients
@endsection

@section('css')
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
            <div class="card">
                <div class="card-header d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Liste des clients</h5>
                        <small class="text-muted">{{ number_format($clients->count(), 0, ',', ' ') }} clients inscrits</small>
                    </div>
                    <a href="{{ route('client.importer') }}" class="btn btn-success">
                        <i class="ri-upload-2-line me-1"></i> Importer des clients
                    </a>
                </div>
                <div class="card-body">
                    {{-- Le tableau est rempli par DataTables à partir des données JSON ci-dessous :
                         seules les lignes affichées sont dessinées (page bien plus légère et rapide). --}}
                    <table id="clients-table" class="table table-bordered table-hover align-middle w-100">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Inscrit le</th>
                                <th class="text-center no-export">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @php
        // [id, nom, email, téléphone, date affichée, horodatage pour le tri]
        $lignesClients = $clients->map(fn ($c) => [
            $c->id,
            $c->username ?: '—',
            $c->email ?: '—',
            $c->phone ?: '—',
            $c->created_at?->format('d/m/Y') ?? '—',
            $c->created_at?->timestamp ?? 0,
        ])->values();
    @endphp
    <script type="application/json" id="clients-data">{!! json_encode($lignesClients, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        (function() {
            var rows = JSON.parse(document.getElementById('clients-data').textContent);
            var exportCols = ':not(.no-export)';

            $('#clients-table').DataTable({
                data: rows,
                deferRender: true, // ne crée les lignes HTML qu'au moment de les afficher
                responsive: true,
                pageLength: 50,
                order: [[4, 'desc']],
                dom: 'Bfrtip',
                language: { url: '/front/vendor/datatables-i18n/fr-FR.json' },
                buttons: [
                    { extend: 'copy', text: '<i class="bi bi-clipboard"></i> Copier', exportOptions: { columns: exportCols } },
                    { extend: 'csv', text: '<i class="bi bi-filetype-csv"></i> CSV', exportOptions: { columns: exportCols } },
                    { extend: 'excel', text: '<i class="bi bi-file-earmark-excel"></i> Excel', exportOptions: { columns: exportCols } },
                    { extend: 'print', text: '<i class="bi bi-printer"></i> Imprimer', exportOptions: { columns: exportCols } }
                ],
                columns: [
                    { data: null, orderable: false, render: function(d, t, r, meta) { return meta.row + 1; } },
                    { data: 1 },
                    { data: 2 },
                    { data: 3 },
                    // tri sur la date réelle (horodatage), affichage au format jj/mm/aaaa
                    { data: 4, render: function(d, type, r) { return type === 'sort' ? r[5] : d; } },
                    {
                        data: 0, orderable: false, searchable: false, className: 'text-center',
                        render: function(id) {
                            return '<a href="#" class="btn btn-sm btn-soft-danger delete" data-id="' + id + '" title="Supprimer">' +
                                '<i class="ri-delete-bin-line"></i></a>';
                        }
                    }
                ],
                createdRow: function(row, data) { row.id = 'row_' + data[0]; }
            });

            // Suppression (public/myJs/js/delete_row.js) : utilisateurs → /admin/register/delete/{id}
            delete_row('register');
        })();
    </script>
@endsection
