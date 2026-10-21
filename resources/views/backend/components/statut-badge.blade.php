{{-- Badge de statut (commande / réservation) : @include('backend.components.statut-badge', ['statut' => $commande->statut]) --}}
@php $infoStatut = \App\Support\Statut::info($statut ?? null); @endphp
<span class="statut-badge statut-badge--{{ $infoStatut['couleur'] }}">
    <i class="{{ $infoStatut['icone'] }}"></i>{{ $infoStatut['label'] }}
</span>
