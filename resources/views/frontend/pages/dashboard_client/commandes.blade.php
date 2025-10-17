{{-- filepath: resources/views/frontend/pages/dashboard_client/commandes.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Mes commandes')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center" style="color:#559e33;">Mes commandes</h2>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if($commandes->isEmpty())
                <div class="alert alert-info text-center">
                    Vous n'avez pas encore passé de commande.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Code</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commandes as $commande)
                                <tr>
                                    <td>{{ $commande->code }}</td>
                                    <td>{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($commande->statut == 'en_attente') bg-warning
                                            @elseif($commande->statut == 'validee') bg-success
                                            @elseif($commande->statut == 'annulee') bg-danger
                                            @else bg-secondary @endif">
                                            {{ ucfirst($commande->statut) }}
                                        </span>
                                    </td>
                                    <td class="fw-bold">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                                    <td>
                                        <a href="{{ route('user.commandes.show', $commande->id) }}" class="btn btn-sm btn-outline-primary">
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