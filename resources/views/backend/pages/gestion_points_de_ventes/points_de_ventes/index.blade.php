@extends('backend.layouts.master')

@section('title')
    Villes des Points de Vente
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
            Points de Vente
        @endslot
        @slot('title')
            Points de vente
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Liste des points de vente</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalAddPointVente">
                        <i class="bi bi-plus-circle me-1"></i> Ajouter
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="display table table-bordered table-hover" style="width:100%">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>

                                    <th>Commune</th>
                                    <th>Quartier</th>
                                    <th>Responsable</th>
                                    <th>Categorie</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th class="d-none">Google Map</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($point_ventes as $pv)
                                    <tr id="row_{{ $pv->id }}">
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $pv->commune->libelle ?? '-' }}</td>
                                        <td>{{ $pv->quartier ?? '-' }}</td>
                                        <td>{{ $pv->responsable ?? '-' }}</td>
                                        <td>{{ $pv->categoriePointVente->libelle ?? '-' }}</td>
                                        <td>{{ $pv->contact ?? '-' }}
                                            @if ($pv->autre_contact)
                                                {{ '/' . $pv->autre_contact }}
                                            @endif
                                        </td>
                                        <td>{{ $pv->email ?? '-' }}</td>
                                        <td class="d-none">
                                            @if ($pv->google_map)
                                                <a href="{{ $pv->google_map }}" target="_blank" class="text-primary">
                                                    <i class="bi bi-geo-alt-fill"></i>
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ri-more-fill"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#modalEditPointVente{{ $pv->id }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Modifier
                                                        </a>
                                                    </li>

                                                    <li>

                                                        <a href="#" class="dropdown-item text-danger delete"
                                                            data-id="{{ $pv->id }}"> <i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Supprimer </a>
                                                    </li>
                                                </ul>

                                            </div>

                                            {{-- Modal d’édition --}}
                                            @include('backend.pages.gestion_points_de_ventes.points_de_ventes.partials.edit')
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

    {{-- Modal de création --}}
    @include('backend.pages.gestion_points_de_ventes.points_de_ventes.partials.create')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            const route = "point_vente";
            delete_row(route);
        });
    </script>
@endsection
