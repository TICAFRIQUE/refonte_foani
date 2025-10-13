{{-- filepath: resources/views/frontend/pages/auth_client/register.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Inscription client')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="bg-white p-4 rounded shadow-sm">

                    <!--afficher les messages de session-->
                    @if (session('error'))
                        <div class="alert alert-warning">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h2 class="fw-bold mb-4 text-center" style="color:#2a6b2a;">Créer un compte client</h2>

                    <!--afficher les erreurs de validation-->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('user.register') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Nom & Prénoms <span class="text-danger">*</span></label>
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Téléphone <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">+225</span>
                                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email </label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control password-input" required>
                                    <span class="input-group-text eye-toggle" style="cursor:pointer;">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Confirmation mot de passe <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" class="form-control password-input"
                                        required>
                                    <span class="input-group-text eye-toggle" style="cursor:pointer;">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <button type="submit" class="btn px-5 fw-bold" style="background:#2a6b2a;color:#fff;">
                                <i class="bi bi-person-plus"></i> S'inscrire
                            </button>
                        </div>
                        <div class="mt-3 text-center">
                            <span>Déjà un compte ?</span>
                            <a href="{{ route('user.loginForm') }}" class="fw-bold" style="color:#2a6b2a;">Se connecter</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.eye-toggle').on('click', function() {
                let input = $(this).siblings('input');
                let icon = $(this).find('i');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('bi-eye').addClass('bi-eye-slash');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('bi-eye-slash').addClass('bi-eye');
                }
            });
        });
    </script>
@endpush
