{{-- Bannière Offre Spéciale --}}
@if ($offreSpeciale)

    <style>
        .offre-banner-section {
            background: linear-gradient(135deg, #2a6b2a 0%, #1e4d1e 100%);
            padding: 60px 20px;
            position: relative;
            overflow: hidden;
            margin: 40px 0;
        }

        .offre-banner-container {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
        }

        .offre-banner-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        /* IMAGE FIX (AUCUNE COUPE) */
        /* .offre-banner-image {
        position: relative;
        height: 400px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        background: white;

        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
    } */

        .offre-banner-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* IMPORTANT => pas de découpe */
        }

        .offre-special-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 800;
            z-index: 10;
            animation: pulse 2s infinite;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .offre-banner-text {
            color: white;
        }

        .offre-banner-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .offre-banner-price {
            font-size: 2.5rem;
            font-weight: 900;
            color: #ffc107;
            margin-bottom: 30px;
        }

        /* .offre-banner-description {
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 40px;
        max-height: 150px;
        overflow-y: auto;
        padding-right: 10px;
    } */

       .offre-banner-description {
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 40px;
    display: block;
    overflow: visible;
    max-height: none;
}

        .offre-banner-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-offre-commander {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: #333;
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 800;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-offre-commander:hover {
            transform: translateY(-3px);
        }

        .btn-offre-details {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 16px 30px;
            border-radius: 50px;
            border: 2px solid white;
            text-decoration: none;
        }

        .btn-offre-details:hover {
            background: white;
            color: #2a6b2a;
        }

        .floating-btn-commander {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #ffc107, #ffb300);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            z-index: 50;
        }

        @media (max-width: 768px) {
            .offre-banner-content {
                grid-template-columns: 1fr;
            }

            .offre-banner-image {
                height: 300px;
            }

            .offre-banner-title {
                font-size: 2rem;
            }
        }
    </style>

    <section class="offre-banner-section">
        <div class="container offre-banner-container">
            <div class="offre-banner-content">

                {{-- IMAGE --}}
                <div class="offre-banner-image">

                    <div class="offre-special-badge">
                        <i class="bi bi-star-fill"></i> Offre Spéciale
                    </div>

                    <img src="{{ $offreSpeciale->getFirstMediaUrl('image_principale') ?: asset('front/images/produits/poulet.png') }}"
                        alt="{{ $offreSpeciale->libelle }}">

                </div>

                {{-- TEXTE --}}
                <div class="offre-banner-text">

                    {{-- @if ($offreSpeciale->categorie)
                    <div>
                        <i class="bi bi-tag"></i>
                        {{ $offreSpeciale->categorie->libelle }}
                    </div>
                @endif --}}

                    <h2 class="offre-banner-title">
                        {{ $offreSpeciale->libelle }}
                    </h2>

                    @if ($offreSpeciale->prix_de_vente > 0)
                        <div class="offre-banner-price">
                            {{ number_format($offreSpeciale->prix_de_vente, 0, ',', ' ') }} FCFA
                        </div>
                    @endif

                    @if ($offreSpeciale->description)
                        <div class="offre-banner-description">
                            {!! nl2br(e($offreSpeciale->description)) !!}
                        </div>
                    @endif

                    @if ($offreSpeciale->stock > 0)
                        <div style="color:#ffc107;margin-bottom:20px;">
                            <i class="bi bi-check-circle-fill"></i>
                            {{ $offreSpeciale->stock }} unité(s) en stock
                        </div>
                    @endif

                    <div class="offre-banner-actions">

                        @if ($offreSpeciale->stock > 0)
                            <button class="btn-offre-commander btn-ajouter-panier" data-id="{{ $offreSpeciale->id }}">
                                <i class="bi bi-cart-plus"></i> Ajouter au panier
                            </button>
                        @else
                            <a href="{{ route('reservation.create', ['slug' => $offreSpeciale->slug]) }}"
                                class="btn-offre-commander">
                                <i class="bi bi-clock"></i> Réserver
                            </a>
                        @endif

                        {{-- <a href="#"
                       class="btn-offre-details">
                        <i class="bi bi-eye"></i> Voir détails
                    </a> --}}

                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- FLOATING BUTTON --}}
    @if ($offreSpeciale->stock > 0)
        <button class="floating-btn-commander btn-ajouter-panier" data-id="{{ $offreSpeciale->id }}">
            <i class="bi bi-cart-plus"></i>
        </button>
    @endif

@endif
