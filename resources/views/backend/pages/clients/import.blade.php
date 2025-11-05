{{-- filepath: c:\laragon\www\foani\resources\views\backend\pages\clients\import.blade.php --}}
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
@section('title', 'Importer des clients')

@section('content')
  @component('backend.components.breadcrumb')
        @slot('li_1')
            Liste
        @endslot
        @slot('title')
            Clients
        @endslot
    @endcomponent
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <a class="btn btn-primary mb-4" href="{{route('client.assign_role')}}">Assigner le role client </a>
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="bi bi-upload me-2"></i>Importer une liste de clients (CSV)</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="bi bi-x-circle me-1"></i>{{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li><i class="bi bi-exclamation-triangle me-1"></i>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('client.importer_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="csv_file" class="form-label">Fichier CSV <span class="text-danger">*</span></label>
                            <input type="file" name="csv_file" id="csv_file" class="form-control" accept=".csv,.xlsx,.xls" required>
                            <div class="form-text">
                                Le fichier doit être au format CSV. <br>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success  w-100">
                            <i class="bi bi-upload me-1"></i>Importer
                        </button>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection