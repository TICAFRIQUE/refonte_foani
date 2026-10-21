@yield('css')

{{-- Police du back-office (la même que le site) --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">

{{-- Bibliothèques servies par le site (plus de dépendance à jsdelivr) --}}
<link href="{{ asset('front/vendor/select2-4.1.0/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('front/vendor/bootstrap-icons-1.11.3/bootstrap-icons.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Layout config Js -->
<script src="{{ URL::asset('build/js/layout.js') }}"></script>
<!-- Bootstrap Css -->
<link href="{{ URL::asset('build/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('build/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

{{-- Thème Foani (couleurs du site) : chargé en dernier --}}
<link href="{{ asset('back/css/admin.css') }}?v={{ filemtime(public_path('back/css/admin.css')) }}" rel="stylesheet" type="text/css" />
