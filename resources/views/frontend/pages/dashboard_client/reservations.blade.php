{{-- filepath: resources/views/frontend/pages/dashboard_client/reservations.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Mes réservations')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center" style="color:#2a6b2a;">Mes réservations</h2>
                @include('frontend.components.message_session')

    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if($reservations->isEmpty())
                <div class="alert alert-info text-center">
                    Vous n'avez pas encore effectué de réservation.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Code</th>
                                <th>Date</th>
                                <th>Produit</th>
                                <th>Statut</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->code }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y H:i') }}</td>
                                    <td>{{ $reservation->produit->libelle ?? '-' }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($reservation->statut == 'en_attente') bg-warning
                                            @elseif($reservation->statut == 'validee') bg-success
                                            @elseif($reservation->statut == 'annulee') bg-danger
                                            @else bg-secondary @endif">
                                            {{ ucfirst($reservation->statut) }}
                                        </span>
                                    </td>
                                    <td class="fw-bold">{{ number_format($reservation->total, 0, ',', ' ') }} FCFA</td>
                                    <td>
                                        <a href="{{ route('user.reservations.show', $reservation->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Détails
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection