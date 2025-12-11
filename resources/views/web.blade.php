@extends('frontend.web.layouts.appweb')

@section('title', 'Accueil Web')

@section('content')
    <!-- HERO CAROUSEL AVEC IMAGES UNSPLASH -->
    @include('frontend.web.sections.slidersweb')
    <!-- À PROPOS SIMPLIFIÉ -->
    @include('frontend.web.sections.presentationweb')

    <!-- MOT DU DIRECTEUR - NOUVELLE SECTION -->
    @include('frontend.web.sections.motdirecteurweb')
    <!-- ACTIVITÉS -->
    @include('frontend.web.sections.activitesweb')
    <!-- VALEURS -->
    @include('frontend.web.sections.valeursweb')
    <!-- STATISTIQUES -->
    @include('frontend.web.sections.statistiquesweb')
    <!-- ACTUALITÉS -->
    {{-- @include('frontend.web.sections.actualitesweb') --}}
    <!-- ÉQUIPE -->
    {{-- @include('frontend.web.sections.equipesweb') --}}
    <!-- CONTACT -->
    @include('frontend.web.sections.contactweb')
