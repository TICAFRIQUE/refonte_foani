@extends('backend.layouts.master')

@section('title', 'Offres')

@section('css')
    <!-- Datatable CSS -->
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
            Offres
        @endslot
    @endcomponent

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold mb-0">Liste des Offres</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#offreModal">
                <i class="bi bi-plus-circle"></i> Créer une offre
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table id="buttons-datatables" class="table table-bordered table-hover align-middle" style="width:100%">
                    <thead class="table-primary">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Libellé</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Statut</th>
                            <th>Produits liés</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types_offres as $keys => $offre)
                            <tr id="row_{{ $offre->id }}">
                                <td>{{ ++$keys }}</td>
                                <td>{{ $offre->libelle }}</td>
                                <td>{{ $offre->slug }}</td>
                                <td>{{ Str::limit($offre->description, 50) }}</td>
                                <td>
                                    @if ($offre->statut == 'actif' || $offre->statut == 1)
                                        <span class="badge bg-success">Actif</span>
                                    @else
                                        <span class="badge bg-secondary">Inactif</span>
                                    @endif
                                </td>
                                <td>{{ $offre->produits->count() }}</td>
                                <td class="text-center">
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <!-- Modifier -->
                                            <li>
                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $offre->id }}">
                                                    <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier
                                                </a>
                                            </li>
                                            <!-- Supprimer -->
                                            <li>
                                                <a href="#" class="dropdown-item delete"
                                                    data-id="{{ $offre->id }}">
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Supprimer
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @include('backend.pages.offres.partials.edit')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('backend.pages.offres.partials.create')
@endsection

@section('script')
    <!-- jQuery et DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!-- Initialisation DataTables -->
    <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            const route = "offre";
            delete_row(route);
        });
    </script>
@endsection
