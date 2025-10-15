@extends('backend.layouts.master')

@section('title')
    Gestion des Sliders
@endsection

@section('css')
    <!-- Datatables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" />
    <style>
        .form-switch .form-check-input {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Interface
        @endslot
        @slot('title')
            Sliders
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Liste des Sliders</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddSlider">
                        <i class="bi bi-plus-circle me-1"></i> Ajouter un Slider
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="display table table-bordered table-hover" style="width:100%">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Libellé</th>
                                    <th>Bouton</th>
                                    <th class="d-none">URL</th>
                                    <th>Description</th>
                                    <th>Visibilité</th>
                                    <th>Date de création</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr id="row_{{ $slider->id }}">
                                        <td>{{ $loop->iteration }}</td>

                                        {{-- Image --}}
                                        <td>
                                            @if ($slider->image && file_exists(public_path('storage/' . $slider->image)))
                                                <img src="{{ asset('storage/' . $slider->image) }}" alt="Image Slider"
                                                    class="rounded-circle border"
                                                    style="width: 45px; height: 45px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">Aucune</span>
                                            @endif
                                        </td>

                                        {{-- Informations --}}
                                        <td>{{ $slider->libelle ?? '—' }}</td>
                                        <td>{{ $slider->btn_nom ?? '—' }}</td>

                                        <td class="d-none">
                                            @if ($slider->url)
                                                <a href="{{ $slider->url }}" target="_blank"
                                                    class="text-primary text-decoration-underline">
                                                    {{ Str::limit($slider->url, 30) }}
                                                </a>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>

                                        <td>{{ Str::limit($slider->description, 50) ?? '—' }}</td>
                                        {{-- visibility --}}
                                        <td class="text-center">
                                            @if ($slider->visible)
                                                <span class="badge bg-success">Visible</span>
                                            @else
                                                <span class="badge bg-secondary">Masqué</span>
                                            @endif
                                        </td>
                                        <td>{{ $slider->created_at?->format('d/m/Y') ?? '—' }}</td>

                                        {{-- Actions --}}
                                        <td class="text-center">
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ri-more-fill"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#modalEditSlider{{ $slider->id }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Modifier
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="dropdown-item text-danger delete"
                                                            data-id="{{ $slider->id }}">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Supprimer
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Modal d’édition --}}
                                    @include('backend.pages.slider.partials.edit', ['slider' => $slider])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de création --}}
    @include('backend.pages.slider.partials.create')
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
           var route = "sliders"
           delete_row(route);
        });


    </script>
@endsection
