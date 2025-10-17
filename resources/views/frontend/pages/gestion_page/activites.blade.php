{{-- filepath: resources/views/frontend/pages/gestion_page/activites.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Nos Activités')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center" style="color:#2a6b2a;">Nos Activités</h2>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @forelse($activites as $activite)
                <div class="card mb-4 shadow-sm border-0">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center">
                            @if($activite->getFirstMediaUrl('image'))
                                <img src="{{ $activite->getFirstMediaUrl('image') }}" alt="{{ $activite->libelle }}"
                                    class="img-fluid rounded-start w-100" style="object-fit:cover; min-height:180px; max-height:220px;">
                            @else
                                <img src="{{ asset('front/images/default.jpg') }}" alt="Activité"
                                    class="img-fluid rounded-start w-100" style="object-fit:cover; min-height:180px; max-height:220px;">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title fw-bold" style="color:#2a6b2a;">
                                    <a href="{{ route('page.show', $activite->slug) }}" class="text-decoration-none text-dark">
                                        {{ $activite->libelle }}
                                    </a>
                                </h4>
                                @if($activite->mot_cle)
                                    <span class="badge bg-success mb-2">{{ $activite->mot_cle }}</span>
                                @endif
                                <p class="card-text">
                                    {{ Str::limit(strip_tags($activite->description), 180) }}
                                </p>
                                <a href="{{ route('page.show', $activite->slug) }}" class="btn btn-outline-success btn-sm">
                                    Lire la suite <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center">Aucune activité trouvée.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection