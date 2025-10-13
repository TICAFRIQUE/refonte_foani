@extends('backend.layouts.master')

@section('title', 'Villes')

@section('css')
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Liste
        @endslot
        @slot('title')
            Villes
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Liste des villes</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddVille">
                        <i class="bi bi-plus-circle"></i> Ajouter une ville
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="display table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Date de création</th>
                                    <th>Statut</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($villes as $key => $ville)
                                    <tr id="row_{{ $ville->id }}">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $ville->libelle }}</td>
                                        <td>{{ $ville->created_at?->format('d/m/Y') ?? '—' }}</td>
                                        <td>
                                            @if ($ville->statut==1)
                                                <span class="badge bg-success">Actif</span>
                                            @else
                                                <span class="badge bg-danger">Inactif</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a type="button" class="dropdown-item edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $ville->id }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Modifier
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="dropdown-item remove-item-btn delete"
                                                            data-id="{{ $ville->id }}">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Supprimer
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Inclure le modal Edit pour chaque ville --}}
                                    @include('backend.pages.point_de_livraison.ville.partials.edit', [
                                        'ville' => $ville,
                                    ])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Inclure le modal Add Ville --}}
    @include('backend.pages.point_de_livraison.ville.partials.create')
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            var route = "ville";
            delete_row(route);
        });
    </script>
@endsection
