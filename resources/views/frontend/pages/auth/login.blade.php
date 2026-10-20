@extends('frontend.layouts.app')

@section('title', 'Connexion client')

@section('content')
    <section class="page-body">
        <div class="container">
            <div class="auth-card reveal">
                <div class="auth-card__icon"><i class="bi bi-person-circle"></i></div>
                <h2>Heureux de vous revoir</h2>
                <p class="lead-text">Connectez-vous avec votre numéro de téléphone.</p>

                @if ($errors->any())
                    <div class="alert alert-danger small">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.login') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="login-phone">Numéro de téléphone <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">+225</span>
                            <input type="tel" inputmode="numeric" autocomplete="tel" id="login-phone" name="phone"
                                value="{{ old('phone') }}" class="form-control" placeholder="0700000000" maxlength="10"
                                oninput="this.value = this.value.replace(/\D/g, '').slice(0, 10)" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="login-password">Mot de passe <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" id="login-password" name="password" autocomplete="current-password"
                                class="form-control" style="border-left:1.5px solid var(--line); border-right:0" required>
                            <button type="button" class="input-group-text eye-toggle" aria-label="Afficher le mot de passe">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 btn-lg">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Se connecter
                    </button>
                </form>

                <p class="switch mb-0">Pas encore de compte ? <a href="{{ route('user.registerForm') }}">Créer un compte</a></p>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            $(function() {
                $('.eye-toggle').on('click', function() {
                    let input = $(this).siblings('input');
                    let icon = $(this).find('i');
                    let show = input.attr('type') === 'password';
                    input.attr('type', show ? 'text' : 'password');
                    icon.toggleClass('bi-eye', !show).toggleClass('bi-eye-slash', show);
                });
            });
        </script>
    @endpush
@endsection
