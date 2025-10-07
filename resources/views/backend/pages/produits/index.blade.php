@extends('backend.layouts.master')

@section('title')
    Produits
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
            Produits
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Liste des produits</h5>
                    <a href="{{ route('produit.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Créer un produit
                    </a>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="display table table-bordered table-hover" style="width:100%">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Libellé</th>
                                    <th>Catégorie</th>
                                    <th>Prix de vente</th>
                                    <th>Stock</th>
                                    <th>Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produits as $produit)
                                    <tr id="row_{{ $produit->id }}">
                                        <td>{{ $loop->iteration }}</td>

                                        {{-- Image --}}
                                        <td>
                                            @if ($produit->image)
                                                <img src="{{ asset('storage/' . $produit->image) }}" alt="Image produit"
                                                    class="img-thumbnail"
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">Aucune</span>
                                            @endif
                                        </td>

                                        {{-- Informations produit --}}
                                        <td>{{ $produit->libelle }}</td>
                                        <td>{{ $produit->categorie->libelle ?? '—' }}</td>
                                        <td>{{ number_format($produit->prix_de_vente, 0, ',', ' ') }} F</td>
                                        <td>{{ $produit->stock }}</td>
                                        <td>{{ $produit->created_at?->format('d/m/Y') ?? '—' }}</td>

                                        {{-- Actions --}}
                                        <td class="text-center">
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ri-more-fill"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a href="{{ route('produit.edit',$produit->id) }}"
                                                            class="dropdown-item">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Modifier
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="dropdown-item delete"
                                                            data-id="{{ $produit->id }}">
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
            const route = "produit";
            delete_row(route);
        });
    </script>
@endsection
