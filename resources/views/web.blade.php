@extends('frontend.web.layouts.appweb')

@section('title', 'Accueil')

@section('content')
    @include('frontend.web.home.hero')
    @include('frontend.web.home.video')
    @include('frontend.web.home.about')
    @include('frontend.web.home.process')
    @include('frontend.web.home.activities')
    @include('frontend.web.home.products')
    @include('frontend.web.home.stats')
    @include('frontend.web.home.values')
    @include('frontend.web.home.points')
    @include('frontend.web.home.shop')
    @include('frontend.web.home.contact')
@endsection
