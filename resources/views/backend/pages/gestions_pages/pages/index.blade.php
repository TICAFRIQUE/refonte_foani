@extends('backend.layouts.master')

@section('title', 'Pages')

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
            Pages
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-bold">Liste des pages</h5>
                    <a href="{{ route('pages.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Ajouter une page
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-striped table-hover align-middle"
                            style="width:100%">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th class="d-none">#</th>
                                    <th>Image</th>
                                    <th>Titre</th>
                                    <th>Catégorie</th>
                                    <th>Mot clé</th>
                                    <th>Visibilité</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($pages as $page)
                                    <tr id="row_{{ $page->id }}">
                                        {{-- Numéro --}}
                                        <td class="text-center d-none">{{ $loop->iteration }}</td>

                                        {{-- Image --}}
                                        <td class="text-center">
                                            @if ($page->image && file_exists(public_path($page->image)))
                                                <img src="{{ asset($page->image) }}" alt="Image"
                                                    class="img-thumbnail rounded"
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <span class="text-muted fst-italic">Aucune</span>
                                            @endif
                                        </td>

                                        {{-- Titre --}}
                                        <td class="fw-semibold">{{ $page->titre }}</td>

                                        {{-- Catégorie --}}
                                        <td>{{ $page->categorie->titre ?? '—' }}</td>

                                        {{-- Mot clé --}}
                                        <td>{{ $page->mot_cle ?? '—' }}</td>

                                        {{-- Visibilité --}}
                                        <td class="text-center">
                                            @if ($page->visibilite)
                                                <span
                                                    class="badge bg-success-subtle text-success border border-success-subtle px-3">Visible</span>
                                            @else
                                                <span
                                                    class="badge bg-danger-subtle text-danger border border-danger-subtle px-3">Cachée</span>
                                            @endif
                                        </td>

                                        {{-- Date --}}
                                        <td class="text-center">{{ $page->created_at?->format('d/m/Y') ?? '—' }}</td>

                                        {{-- Actions --}}
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light border dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a href="{{ route('pages.edit', $page->id) }}"
                                                            class="dropdown-item">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Modifier
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item text-danger delete"
                                                            data-id="{{ $page->id }}">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Supprimer
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                            Aucune page enregistrée.
                                        </td>
                                    </tr>
                                @endforelse
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
            const route = "page";
            delete_row(route);
        });
    </script>
@endsection
