{{--
    Bandeau de page + fil d'Ariane, commun à toutes les pages de la boutique
    (sauf l'accueil et la liste des produits qui ont le leur).

    Titre / sous-titre / petit texte manuscrit déduits de la route.
    Une page peut les remplacer :
        @section('hero_title', 'Mon titre')
        @section('hero_subtitle', 'Ma phrase')
        @section('hero_eyebrow', 'Petit texte')
--}}
@php
    $route = request()->route()?->getName();
    $panier = ['label' => 'Panier', 'url' => route('panier.index')];
    $compte = ['label' => 'Mon compte', 'url' => route('user.profil')];

    // [titre, sous-titre, petit texte, icône, chemin intermédiaire]
    $pages = [
        'panier.index' => ['Mon panier', 'Vérifiez vos articles puis validez votre commande.', 'Presque prêt !', 'bi-basket2-fill', []],
        'panier.caisse' => ['Finaliser ma commande', 'Vérifiez vos informations et confirmez la livraison.', 'Dernière étape', 'bi-bag-check-fill', [$panier]],
        'reservation.create' => ['Réserver un produit', 'Ce produit est en rupture : réservez-le, nous vous recontactons dès son retour.', 'Bientôt de retour', 'bi-calendar-check', []],
        'contact' => ['Contactez-nous', 'Une question, une commande spéciale ? Notre équipe vous répond rapidement.', 'On vous écoute', 'bi-chat-heart-fill', []],
        'points_de_vente' => ['Points de vente' . (isset($categorie) && $categorie ? ' · ' . $categorie->libelle : ''), 'Retrouvez nos produits frais près de chez vous.', 'Près de chez vous', 'bi-geo-alt-fill', []],
        'categories' => ['Nos catégories', 'Poulets, œufs, poussins, découpes… choisissez votre rayon.', 'Frais de la ferme', 'bi-grid-fill', []],
        'page.activites' => ['Nos activités', "Découvrez l'ensemble de nos services et réalisations.", 'Ce que nous faisons', 'bi-tree-fill', []],
        'user.loginForm' => ['Connexion', 'Connectez-vous pour suivre vos commandes et réservations.', 'Bon retour !', 'bi-person-circle', []],
        'user.registerForm' => ['Créer un compte', 'Rejoignez la famille Foani en quelques secondes.', 'Bienvenue', 'bi-person-plus-fill', []],
        'user.profil' => ['Mon profil', 'Gérez vos informations personnelles.', 'Mon espace', 'bi-person-badge', []],
        'user.commandes' => ['Mes commandes', "Suivez l'état de vos commandes.", 'Mon espace', 'bi-bag-check-fill', [$compte]],
        'user.commandes.show' => ['Détail de la commande', 'Récapitulatif et suivi de votre commande.', 'Mon espace', 'bi-receipt', [$compte, ['label' => 'Mes commandes', 'url' => route('user.commandes')]]],
        'user.reservations' => ['Mes réservations', 'Retrouvez vos produits réservés.', 'Mon espace', 'bi-calendar-check', [$compte]],
        'user.reservations.show' => ['Détail de la réservation', 'Récapitulatif de votre réservation.', 'Mon espace', 'bi-calendar2-week', [$compte, ['label' => 'Mes réservations', 'url' => route('user.reservations')]]],
    ];

    [$defTitre, $defSous, $defEyebrow, $icone, $chemin] = $pages[$route] ?? [
        trim(Str::before(trim($__env->yieldContent('title')), '|')) ?: Str::title(str_replace('-', ' ', request()->segment(1) ?? '')),
        null, 'Foani', 'bi-egg-fill', [],
    ];

    $titre = trim($__env->yieldContent('hero_title')) ?: $defTitre;
    $sousTitre = trim($__env->yieldContent('hero_subtitle')) ?: $defSous;
    $eyebrow = trim($__env->yieldContent('hero_eyebrow')) ?: $defEyebrow;
@endphp

<section class="shop-hero page-hero">
    <div class="container">
        <div class="page-hero__inner">
            <div>
                <nav aria-label="Fil d'Ariane" class="crumbs">
                    <a href="{{ route('boutique.accueil') }}"><i class="bi bi-house-door-fill"></i> Accueil</a>
                    @foreach ($chemin as $etape)
                        <i class="bi bi-chevron-right sep"></i>
                        <a href="{{ $etape['url'] }}">{{ $etape['label'] }}</a>
                    @endforeach
                    <i class="bi bi-chevron-right sep"></i>
                    <span aria-current="page">{{ Str::limit($titre, 40) }}</span>
                </nav>
                <span class="eyebrow">{{ $eyebrow }}</span>
                <h1>{{ $titre }}</h1>
                @if ($sousTitre)
                    <p>{{ $sousTitre }}</p>
                @endif
            </div>
            <span class="page-hero__icon" aria-hidden="true"><i class="bi {{ $icone }}"></i></span>
        </div>
    </div>
    <svg class="wave-bottom" viewBox="0 0 1440 34" preserveAspectRatio="none" aria-hidden="true">
        <path fill="currentColor" d="M0 34V18c120-14 240-18 360-10s240 22 360 20 240-18 360-22 240 4 360 12v16z" />
    </svg>
</section>
