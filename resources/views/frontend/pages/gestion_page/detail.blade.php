{{-- filepath: resources/views/frontend/pages/gestion_page/detail.blade.php --}}
@extends('frontend.layouts.app')

@section('title', $page->libelle)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="mb-4 text-center">
                <h2 class="fw-bold" style="color:#2a6b2a;">{{ $page->libelle }}</h2>
                @if($page->mot_cle)
                    <span class="badge bg-success">{{ $page->mot_cle }}</span>
                @endif
                @if($page->categorie)
                    <div class="mt-2 text-muted small">
                        <i class="bi bi-folder"></i> {{ $page->categorie->libelle }}
                    </div>
                @endif
            </div>
            <div class="mb-4">
                @if($page->getFirstMediaUrl('image'))
                    <img src="{{ $page->getFirstMediaUrl('image') }}" alt="{{ $page->libelle }}"
                        class="img-fluid rounded shadow-sm mb-3 mx-auto d-block" style="max-height:320px;object-fit:cover;">
                @endif
            </div>
            <div class="bg-white p-4 rounded shadow-sm">
                {!! $page->description !!}
            </div>
        </div>
    </div>
</div>
@endsection