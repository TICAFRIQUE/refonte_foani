{{--
    Carte indicateur (KPI).
    @include('backend.components.kpi', [
        'icone' => 'ri-money-dollar-circle-line', 'couleur' => 'success',   // primary|success|warning|danger|info|secondary
        'label' => "Chiffre d'affaires", 'valeur' => '1 250 000', 'unite' => 'FCFA',
        'aide' => 'Commandes livrées', 'evolution' => 12.5 (ou null), 'lien' => route(...) (optionnel),
    ])
--}}
@php
    $couleur = $couleur ?? 'primary';
    $evolution = $evolution ?? null;
    $tag = !empty($lien) ? 'a' : 'div';
@endphp
<{{ $tag }} @if (!empty($lien)) href="{{ $lien }}" @endif class="kpi kpi--{{ $couleur }} {{ !empty($lien) ? 'kpi--link' : '' }}">
    <span class="kpi__icon"><i class="{{ $icone ?? 'ri-bar-chart-line' }}"></i></span>
    <span class="kpi__body">
        <span class="kpi__label">{{ $label }}</span>
        <span class="kpi__value"><span class="kpi__num">{{ $valeur }}</span>@if (!empty($unite)) <small>{{ $unite }}</small>@endif</span>
        @if ($evolution !== null || !empty($aide))
            <span class="kpi__meta">
                @if ($evolution !== null)
                    <span class="kpi__trend {{ $evolution > 0 ? 'is-up' : ($evolution < 0 ? 'is-down' : '') }}">
                        <i class="{{ $evolution > 0 ? 'ri-arrow-up-line' : ($evolution < 0 ? 'ri-arrow-down-line' : 'ri-subtract-line') }}"></i>
                        {{ ($evolution > 0 ? '+' : '') . number_format($evolution, 1, ',', ' ') }} %
                    </span>
                @endif
                @if (!empty($aide))
                    <span>{{ $aide }}</span>
                @endif
            </span>
        @endif
    </span>
</{{ $tag }}>
