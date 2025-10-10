@extends('frontend.layouts.app')

@section('title', 'Accueil')

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
    @include('frontend.sections.actualite')


    <!-- Section Valeurs Foani adaptée -->
    @include('frontend.sections.valeurs')

@endsection
