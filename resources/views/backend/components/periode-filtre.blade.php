{{--
    Filtre de période : préréglages + dates personnalisées.
    @include('backend.components.periode-filtre', ['periode' => $periode, 'route' => 'dashboard.index', 'garder' => ['statut']])
--}}
@php
    $garder = collect($garder ?? [])->mapWithKeys(fn ($k) => [$k => request($k)])->filter()->all();
@endphp
<div class="periode-filtre">
    <div class="periode-filtre__presets" role="group" aria-label="Période">
        @foreach (\App\Support\Periode::PRESETS as $cle => $libelle)
            <a href="{{ route($route, array_merge($garder, ['periode' => $cle])) }}"
                class="periode-filtre__pill {{ $periode->preset === $cle ? 'is-active' : '' }}">{{ $libelle }}</a>
        @endforeach
    </div>
    <form method="GET" action="{{ route($route) }}" class="periode-filtre__perso" data-no-lock>
        @foreach ($garder as $cle => $valeur)
            <input type="hidden" name="{{ $cle }}" value="{{ $valeur }}">
        @endforeach
        <input type="date" name="date_debut" class="form-control form-control-sm" value="{{ $periode->debut->toDateString() }}"
            aria-label="Date de début">
        <span class="text-muted small">au</span>
        <input type="date" name="date_fin" class="form-control form-control-sm" value="{{ $periode->fin->toDateString() }}"
            aria-label="Date de fin">
        <button type="submit" class="btn btn-sm {{ $periode->preset === 'perso' ? 'btn-primary' : 'btn-soft-primary' }}">
            <i class="ri-filter-3-line"></i><span class="d-none d-sm-inline ms-1">Appliquer</span>
        </button>
    </form>
</div>
