{{-- filepath: resources/views/frontend/pages/dashboard_client/reservations.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Mes réservations')

@push('styles')
    <style>
        /* === Section réservations === */
        .reservations-section {
            font-size: 0.95rem;
        }

        /* Table plus lisible sur desktop */
        .reservations-section table th,
        .reservations-section table td {
            padding: 0.9rem 0.75rem;
        }

        /* Casser les longs textes */
        .reservations-section td.text-break {
            word-break: break-word;
        }

        /* Légère ombre et fond blanc pour le tableau */
        .reservations-section .table-responsive {
            border-radius: 0.5rem;
            background-color: #fff;
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
        }

        /* Bordures plus douces */
        .reservations-section table {
            border-color: #dee2e6;
        }

        /* === Responsive (mobile) === */
        @media (max-width: 768px) {
            .reservations-section {
                font-size: 0.85rem;
                padding: 1rem 0;
            }

            .reservations-section table th,
            .reservations-section table td {
                padding: 0.6rem 0.4rem;
            }

            /* Compacte le bouton */
            .reservations-section .btn {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }

            /* Badge plus petit */
            .reservations-section .badge {
                font-size: 0.75rem;
                padding: 0.35em 0.6em;
            }

            /* Réduit la hauteur entre les lignes */
            .reservations-section tbody tr {
                border-bottom: 1px solid #f0f0f0;
            }
        }

        /* Très petits écrans */
        @media (max-width: 400px) {
            .reservations-section table {
                font-size: 0.8rem;
            }

            .reservations-section h2 {
                font-size: 1.2rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container py-5 reservations-section">
        <h2 class="fw-bold mb-4 text-center title">Mes réservations</h2>
        @include('frontend.components.message_session')

        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if ($reservations->isEmpty())
                    <div class="alert alert-info text-center py-4 rounded shadow-sm">
                        Vous n'avez pas encore effectué de réservation.
                    </div>
                @else
                    <div class="table-responsive shadow-sm rounded overflow-hidden">
                        <table class="table align-middle table-bordered mb-0">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>Code</th>
                                    <th>Date</th>
                                    {{-- <th>Produit</th> --}}
                                    <th>Statut</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td class="fw-semibold text-break">{{ $reservation->code }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y H:i') }}
                                        </td>
                                        {{-- <td class="text-break">{{ $reservation->produit->libelle ?? '-' }}</td> --}}
                                        <td>
                                            <span
                                                class="badge 
                                            @if ($reservation->statut == 'en_attente') bg-warning text-dark
                                            @elseif($reservation->statut == 'validee') bg-success
                                            @elseif($reservation->statut == 'annulee') bg-danger
                                            @else bg-secondary @endif">
                                                {{ ucfirst($reservation->statut) }}
                                            </span>
                                        </td>
                                        <td class="fw-bold text-nowrap">
                                            {{ number_format($reservation->total, 0, ',', ' ') }} FCFA</td>
                                        <td class="text-center">
                                            <a href="{{ route('user.reservations.show', $reservation->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                                <span class="d-none d-sm-inline">Détails</span>
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
