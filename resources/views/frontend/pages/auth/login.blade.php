{{-- filepath: resources/views/frontend/pages/auth_client/login.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Connexion client')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="bg-white p-4 rounded shadow-sm">
                    <h2 class="fw-bold mb-4 text-center" style="color:#559e33;">Connexion client</h2>
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
                    <form action="{{ route('user.login') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Numero de Téléphone <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">+225</span>
                                <input type="number" name="phone" value="{{ old('phone') }}" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mot de passe <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control " required>
                                <span class="input-group-text eye-toggle" style="cursor:pointer;">
                                    <i class="bi bi-eye"></i>
                                </span>
                            </div>
                        </div>
                        {{-- <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div>
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember" class="form-label">Se souvenir de moi</label>
                            </div>
                            <a href="#" class="fw-bold" style="color:#559e33;">Mot de passe oublié ?</a>
                        </div> --}}
                        <div class="mt-4 text-center">
                            <button type="submit" class="btn px-5 fw-bold" style="background:#559e33;color:#fff;">
                                <i class="bi bi-box-arrow-in-right"></i> Se connecter
                            </button>
                        </div>
                        <div class="mt-3 text-center">
                            <span>Pas encore de compte ?</span>
                            <a href="{{ route('user.registerForm') }}" class="fw-bold" style="color:#559e33;">S'inscrire</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
@endsection
