{{-- filepath: resources/views/frontend/pages/dashboard_client/commandes.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Mes commandes')

<style>
    /* === Bloc commandes === */
.commandes-section {
    font-size: 0.95rem;
}

/* Rendre le tableau plus aéré sur desktop */
.commandes-section table th,
.commandes-section table td {
    padding: 0.9rem 0.75rem;
}

/* Éviter les débordements et casser les longues chaînes */
.commandes-section td.text-break {
    word-break: break-word;
}

/* Style doux des bordures */
.commandes-section table {
    border-color: #dee2e6;
}

/* Ombre légère et coins arrondis */
.commandes-section .table-responsive {
    border-radius: 0.5rem;
    background-color: #fff;
}

/* Sur mobile : tableau plus compact et texte plus petit */
@media (max-width: 768px) {
    .commandes-section {
        font-size: 0.85rem;
        padding: 1rem 0;
    }

    .commandes-section table th,
    .commandes-section table td {
        padding: 0.6rem 0.4rem;
    }

    .commandes-section .btn {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }

    /* Badge plus petit */
    .commandes-section .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.6em;
    }

    /* Supprimer la marge entre lignes pour plus de compacité */
    .commandes-section tbody tr {
        border-bottom: 1px solid #f0f0f0;
    }
}

/* Très petits écrans */
@media (max-width: 400px) {
    .commandes-section table {
        font-size: 0.8rem;
    }

    .commandes-section h2 {
        font-size: 1.2rem;
    }
}

</style>

@section('content')
<div class="container py-5 commandes-section">
    <h2 class="fw-bold mb-4 text-center" style="color:#559e33;">Mes commandes</h2>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if($commandes->isEmpty())
                <div class="alert alert-info text-center py-4 rounded shadow-sm">
                    Vous n'avez pas encore passé de commande.
                </div>
            @else
                <div class="table-responsive shadow-sm rounded overflow-hidden">
                    <table class="table align-middle table-bordered mb-0">
                        <thead class="table-light text-center">
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
                                    <td class="text-break fw-semibold">{{ $commande->code }}</td>
                                    <td>{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($commande->statut == 'en_attente') bg-warning text-dark
                                            @elseif($commande->statut == 'validee') bg-success
                                            @elseif($commande->statut == 'annulee') bg-danger
                                            @else bg-secondary @endif">
                                            {{ ucfirst($commande->statut) }}
                                        </span>
                                    </td>
                                    <td class="fw-bold text-nowrap">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                                    <td class="text-center">
                                        <a href="{{ route('user.commandes.show', $commande->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> <span class="d-none d-sm-inline">Détails</span>
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