<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Commande;
use App\Models\Reservation;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Période pour les stats (mois en cours par défaut)
        $date_debut = $request->input('date_debut') ?? Carbon::now()->startOfMonth()->toDateString();
        $date_fin = $request->input('date_fin') ?? Carbon::now()->endOfMonth()->toDateString();

        // Nombre de clients
        $nbClients = User::count();

        // Commandes en attente
        $nbCommandesEnAttente = Commande::where('statut', 'en_attente')->count();

        // Nombre de réservations
        $nbReservations = Reservation::count();

        // Nombre de ventes réalisées (commandes livrées)
        $nbVentes = Commande::where('statut', 'livrée')->count();

        // Chiffre d'affaires sur la période
        $chiffreAffaire = Commande::where('statut', 'livrée')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->sum('total');

        // Produits les plus vendus (top 5)
        $produitsLesPlusVendus = Produit::select('produits.id', 'produits.libelle')
            ->join('commande_produit', 'produits.id', '=', 'commande_produit.produit_id')
            ->join('commandes', 'commande_produit.commande_id', '=', 'commandes.id')
            ->where('commandes.statut', 'livrée')
            ->whereBetween('commandes.created_at', [$date_debut, $date_fin])
            ->selectRaw('SUM(commande_produit.quantite) as quantite_vendue')
            ->groupBy('produits.id', 'produits.libelle')
            ->orderByDesc('quantite_vendue')
            ->take(5)
            ->get();

        // Clients ayant le plus de commandes (top 5)
        $clientsTopCommandes = User::select('users.id', 'users.username')
            ->join('commandes', 'users.id', '=', 'commandes.user_id')
            ->selectRaw('COUNT(commandes.id) as nb_commandes')
            ->groupBy('users.id', 'users.username')
            ->orderByDesc('nb_commandes')
            ->take(5)
            ->get();

        // Chiffre d'affaires par mois (12 derniers mois)
        $revenus = Commande::where('statut', 'livrée')
            ->where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as mois, SUM(total) as total_revenu")
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        $labels = $revenus->map(function ($revenu) {
            return Carbon::createFromFormat('Y-m', $revenu->mois)->locale('fr')->translatedFormat('F Y');
        });
        $data = $revenus->pluck('total_revenu');

        return view('backend.pages.index', compact(
            'nbClients',
            'nbCommandesEnAttente',
            'nbReservations',
            'nbVentes',
            'chiffreAffaire',
            'produitsLesPlusVendus',
            'clientsTopCommandes',
            'labels',
            'data',
            'date_debut',
            'date_fin'
        ));
    }
}
