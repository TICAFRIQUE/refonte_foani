@extends('backend.layouts.master') @section('title')
    Catégories
    des Points de Vente
    @endsection @section('css')
    <!-- Datatables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" />
    @endsection @section('content') @component('backend.components.breadcrumb')
    @slot('li_1')
        Points de Vente
        @endslot @slot('title')
        Catégories
    @endslot
@endcomponent <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Liste des Catégories</h5> <button type="button" class="btn btn-primary"
                    data-bs-toggle="modal" data-bs-target="#modalAddCategorie"> <i class="bi bi-plus-circle me-1"></i>
                    Ajouter une Catégorie </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="buttons-datatables" class="display table table-bordered table-hover" style="width:100%">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Date de création</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $categorie)
                                <tr id="row_{{ $categorie->id }}">
                                    <td>{{ $loop->iteration }}</td> {{-- Image --}} <td>
                                        @if ($categorie->image && file_exists(public_path($categorie->image)))
                                            <img src="{{ asset($categorie->image) }}" alt="Image"
                                                class="rounded-circle border"
                                                style="width: 45px; height: 45px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">Aucune</span>
                                        @endif
                                    </td> {{-- Informations --}} <td>{{ $categorie->titre_categorie }}</td>
                                    <td>{{ $categorie->created_at?->format('d/m/Y') ?? '—' }}</td> {{-- Actions --}}
                                    <td class="text-center">
                                        <div class="dropdown d-inline-block"> <button
                                                class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown"> <i class="ri-more-fill"></i> </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li> <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditCategorie{{ $categorie->id }}"> <i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Modifier </a> </li>
                                                <li> <a href="#" class="dropdown-item text-danger delete"
                                                        data-id="{{ $categorie->id }}"> <i
                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        Supprimer </a> </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr> {{-- Modal d’édition --}} @include('backend.pages.points_de_ventes.categorie.partials.edit', [
                                    'categorie' => $categorie,
                                ])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> {{-- Modal de création --}} @include('backend.pages.points_de_ventes.categorie.partials.create') @endsection @section('script')
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> <!-- Initialisation DataTables -->
<script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
    $(document).ready(function() {
       
        delete_row("categorie_point_vente");
    });
</script>
@endsection
