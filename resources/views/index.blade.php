@extends('frontend.layouts.app')

@section('title', 'Foani - Accueil | Spécialiste Volaille & Œufs Frais Côte d\'Ivoire')
@section('meta_description', 'Bienvenue chez Foani, leader de l\'aviculture en Côte d\'Ivoire. Découvrez nos volailles de qualité premium, œufs frais et services d\'élevage. Fraîcheur et qualité garanties.')
@section('meta_keywords', 'Foani accueil, aviculture Côte d\'Ivoire, volaille premium, œufs frais, élevage professionnel, ferme moderne, livraison volaille Abidjan')

@section('og_title', 'Foani - Leader de l\'Aviculture en Côte d\'Ivoire')
@section('og_description', 'Découvrez Foani, votre partenaire de confiance pour la volaille et les œufs frais en Côte d\'Ivoire. Qualité premium et fraîcheur garantie.')

@section('content')
    <!-- Slider animé -->
    @include('frontend.sections.slider')
    <!-- Section Catégories -->
    @include('frontend.sections.categories_liste')

    <!-- Section Catégories & Produits -->
    @include('frontend.sections.categories_produits')

    <!-- Section Points de vente -->
    @include('frontend.sections.points_vente')

    <!-- Section Blog/Actualités -->
    {{-- @include('frontend.sections.actualite') --}}


    <!-- Section Valeurs Foani adaptée -->
    @include('frontend.sections.valeurs')

@endsection
