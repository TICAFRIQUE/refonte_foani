{{-- filepath: c:\laragon\www\foani\resources\views\frontend\pages\points_de_vente.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Points de vente - ' . $categorie->libelle)

@section('content')
    <style>
        /* Hero section pour points de vente */
        .points-vente-hero {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            color: white;
            padding: 70px 0;
            margin-bottom: 0;
            position: relative;
            overflow: hidden;
        }

        .points-vente-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="points-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="1.5" fill="rgba(255,255,255,0.1)"/><path d="M15 0 L30 15 L15 30 L0 15 Z" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23points-pattern)"/></svg>');
            opacity: 0.4;
        }

        .points-vente-hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .points-vente-hero h1 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 15px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            letter-spacing: -0.5px;
        }

        .points-vente-hero .badge-categorie {
            background: linear-gradient(135deg, var(--color-jaune), #f39c12);
            color: #333;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(241, 196, 15, 0.4);
        }

        .points-vente-hero p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0;
            font-weight: 300;
        }

        /* Container principal */
        .points-vente-container {
            background: #f8f9fa;
            padding: 60px 0;
            min-height: 60vh;
        }

        /* Statistics section */
        .stats-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--color-vert);
            text-shadow: 0 2px 4px rgba(42, 107, 42, 0.1);
        }

        .stat-label {
            color: #666;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }

        /* Table desktop */
        .points-table-card {
            background: white;
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .table-header {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            color: white;
            padding: 20px 25px;
            margin: 0;
            font-weight: 700;
            font-size: 1.1rem;
            text-align: center;
        }

        .points-table {
            margin: 0;
            font-size: 0.95rem;
        }

        .points-table thead {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        }

        .points-table thead th {
            border: none;
            padding: 18px 20px;
            font-weight: 700;
            color: var(--color-vert);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
        }

        .points-table thead th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 20px;
            right: 20px;
            height: 2px;
            background: linear-gradient(90deg, var(--color-vert), var(--color-jaune));
            border-radius: 1px;
        }

        .points-table tbody td {
            border: none;
            padding: 18px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #f5f5f5;
            transition: all 0.3s ease;
        }

        .points-table tbody tr {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .points-table tbody tr:hover {
            background: linear-gradient(135deg, #f8fdf8, #f0f8f0);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(42, 107, 42, 0.1);
        }

        .points-table tbody tr:last-child td {
            border-bottom: none;
        }

        .ville-cell {
            font-weight: 700;
            color: var(--color-vert);
            font-size: 1rem;
        }

        .adresse-cell {
            color: #555;
            position: relative;
            padding-left: 30px;
        }

        .adresse-cell::before {
            content: '\F124';
            font-family: 'bootstrap-icons';
            position: absolute;
            left: 8px;
            color: var(--color-rouge);
            font-size: 0.9rem;
        }

        .contact-cell {
            color: #666;
            font-weight: 600;
            position: relative;
            padding-left: 30px;
        }

        .contact-cell::before {
            /* content: '\F4A5'; */
            font-family: 'bootstrap-icons';
            position: absolute;
            left: 8px;
            color: var(--color-vert);
            font-size: 0.9rem;
        }

        /* Cards mobile */
        .point-vente-card {
            background: white;
            border: none;
            border-radius: 18px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
        }

        .point-vente-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--color-vert), var(--color-jaune));
            transition: width 0.3s ease;
        }

        .point-vente-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(42, 107, 42, 0.15);
        }

        .point-vente-card:hover::before {
            width: 6px;
        }

        .point-vente-card-body {
            padding: 25px;
        }

        .point-ville {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--color-vert);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .point-info {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
            color: #666;
            font-size: 0.95rem;
        }

        .point-info:last-child {
            margin-bottom: 0;
        }

        .point-info i {
            margin-top: 2px;
            width: 16px;
            text-align: center;
        }

        .point-info .bi-geo-alt {
            color: var(--color-rouge);
        }

        .point-info .bi-telephone {
            color: var(--color-vert);
        }

        /* État vide */
        .empty-state {
            background: white;
            border-radius: 20px;
            padding: 60px 30px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--color-vert);
            opacity: 0.3;
            margin-bottom: 25px;
        }

        .empty-state h4 {
            color: #495057;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .empty-state p {
            color: #6c757d;
            margin-bottom: 0;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--color-vert), var(--color-vert2));
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="cta-grid" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="7.5" cy="7.5" r="0.8" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23cta-grid)"/></svg>');
            opacity: 0.3;
        }

        .cta-content {
            position: relative;
            z-index: 2;
        }

        .cta-section h4 {
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .cta-section p {
            opacity: 0.9;
            margin-bottom: 25px;
        }

        .btn-cta {
            background: linear-gradient(135deg, var(--color-jaune), #f39c12);
            border: none;
            color: #333;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 15px rgba(241, 196, 15, 0.4);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-cta:hover {
            background: linear-gradient(135deg, #f1c40f, #e67e22);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(241, 196, 15, 0.6);
            color: #333;
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .points-vente-hero {
                padding: 50px 0;
            }

            .points-vente-hero h1 {
                font-size: 2.3rem;
            }

            .points-vente-container {
                padding: 40px 0;
            }

            .stats-section {
                padding: 25px;
            }

            .stat-number {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .points-vente-hero {
                padding: 40px 0;
            }

            .points-vente-hero h1 {
                font-size: 1.8rem;
            }

            .badge-categorie {
                padding: 8px 20px !important;
                font-size: 0.9rem !important;
            }

            .points-vente-container {
                padding: 30px 0;
            }

            .stats-section {
                padding: 20px;
                margin-bottom: 25px;
            }

            .stat-number {
                font-size: 1.8rem;
            }

            .stat-label {
                font-size: 0.8rem;
            }

            .point-vente-card-body {
                padding: 20px;
            }

            .point-ville {
                font-size: 1rem;
                margin-bottom: 12px;
            }

            .point-info {
                font-size: 0.9rem;
                margin-bottom: 10px;
            }

            .cta-section {
                padding: 30px 20px;
            }

            .btn-cta {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .points-vente-hero {
                padding: 30px 0;
            }

            .points-vente-hero h1 {
                font-size: 1.5rem;
            }

            .empty-state {
                padding: 40px 20px;
            }

            .empty-state i {
                font-size: 3rem;
            }

            .point-vente-card-body {
                padding: 18px;
            }
        }

        /* Animations */
        .point-vente-card {
            animation: slideInUp 0.6s ease-out;
        }

        .point-vente-card:nth-child(odd) {
            animation-delay: 0.1s;
        }

        .point-vente-card:nth-child(even) {
            animation-delay: 0.2s;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    {{-- Hero Section --}}
    <section class="points-vente-hero">
        <div class="container">
            <div class="points-vente-hero-content">
                <div class="badge-categorie">{{ $categorie->libelle }}</div>
                <h1>
                    <i class="bi bi-geo-alt-fill me-3"></i>Points de vente
                </h1>
                <p>Retrouvez nos produits dans nos points de vente {{ $categorie->libelle }}</p>
            </div>
        </div>
    </section>

    {{-- Container principal --}}
    <section class="points-vente-container">
        <div class="container">
            {{-- Statistiques --}}
            {{-- <div class="stats-section">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stat-item">
                            <div class="stat-number">{{ $points_de_vente->count() }}</div>
                            <div class="stat-label">Points de vente</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-item">
                            <div class="stat-number">{{ $points_de_vente->pluck('commune.libelle')->unique()->count() }}</div>
                            <div class="stat-label">Communes</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-item">
                            <div class="stat-number">{{ $categorie->libelle }}</div>
                            <div class="stat-label">Catégorie</div>
                        </div>
                    </div>
                </div>
            </div> --}}

            @if ($points_de_vente->count() > 0)
                {{-- Table desktop --}}
                <div class="points-table-card d-none d-md-block">
                    <h3 class="table-header">
                        <i class="bi bi-shop me-2"></i>
                        Liste des points de vente
                    </h3>
                    <div class="table-responsive">
                        <table class="table points-table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <i class="bi bi-building me-1"></i> Ville/Commune
                                    </th>
                                    <th scope="col">
                                        <i class="bi bi-geo-alt me-1"></i> Adresse complète
                                    </th>
                                    <th scope="col">
                                        <i class="bi bi-telephone me-1"></i> Contact
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($points_de_vente as $point)
                                    <tr>
                                        <td class="ville-cell">
                                            {{ $point->commune->libelle ?? $point->ville->libelle ?? 'Non spécifié' }}
                                        </td>
                                        <td class="adresse-cell">
                                            {{ $point->quartier ?? 'Adresse non précisée' }}
                                        </td>
                                        <td class="contact-cell">
                                            {{ $point->contact ?? 'Contact non disponible' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Cards mobile --}}
                <div class="d-block d-md-none">
                    @foreach ($points_de_vente as $point)
                        <div class="point-vente-card">
                            <div class="point-vente-card-body">
                                <h5 class="point-ville">
                                    <i class="bi bi-shop"></i>
                                    {{ $point->commune->libelle ?? $point->ville->libelle ?? 'Non spécifié' }}
                                </h5>
                                
                                <div class="point-info">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>{{ $point->quartier ?? 'Adresse non précisée' }}</span>
                                </div>
                                
                                <div class="point-info">
                                    <i class="bi bi-telephone"></i>
                                    <span>{{ $point->contact ?? 'Contact non disponible' }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- État vide --}}
                <div class="empty-state">
                    <i class="bi bi-shop"></i>
                    <h4>Aucun point de vente trouvé</h4>
                    <p>Aucun point de vente n'est disponible dans cette catégorie pour le moment.<br>
                       Nous ajoutons régulièrement de nouveaux points de vente, revenez bientôt !</p>
                </div>
            @endif

            {{-- Section CTA --}}
            <div class="cta-section">
                <div class="cta-content">
                    <h4>Vous ne trouvez pas de point de vente près de chez vous ?</h4>
                    <p>Contactez-nous pour connaître les prochaines ouvertures dans votre région ou pour toute information complémentaire.</p>
                    <a href="{{ route('contact') }}" class="btn-cta">
                        <i class="bi bi-envelope-heart"></i>
                        Nous contacter
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection