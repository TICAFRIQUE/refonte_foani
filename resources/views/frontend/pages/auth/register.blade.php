@extends('frontend.layouts.app')

@section('title', 'Créer un compte client')

@section('content')
    <section class="page-body">
        <div class="container">
            <div class="auth-card reveal" style="max-width: 620px">
                <div class="auth-card__icon"><i class="bi bi-person-plus-fill"></i></div>
                <h2>Rejoignez la famille Foani</h2>
                <p class="lead-text">Créez votre compte pour commander plus vite et suivre vos livraisons.</p>

                @if ($errors->any())
                    <div class="alert alert-danger small">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.register') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label" for="reg-name">Nom &amp; prénoms <span class="text-danger">*</span></label>
                            <input type="text" id="reg-name" name="username" value="{{ old('username') }}" autocomplete="name"
                                class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="reg-phone">Téléphone <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">+225</span>
                                <input type="tel" inputmode="numeric" autocomplete="tel" id="reg-phone" name="phone"
                                    value="{{ old('phone') }}" class="form-control" placeholder="0700000000" maxlength="10"
                                oninput="this.value = this.value.replace(/\D/g, '').slice(0, 10)" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="reg-email">Email <small class="text-muted">(facultatif)</small></label>
                            <input type="email" id="reg-email" name="email" value="{{ old('email') }}" autocomplete="email"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="reg-pass">Mot de passe <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" id="reg-pass" name="password" autocomplete="new-password"
                                    class="form-control password-input" style="border-left:1.5px solid var(--line); border-right:0" required>
                                <button type="button" class="input-group-text eye-toggle" aria-label="Afficher le mot de passe">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="reg-pass2">Confirmation <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" id="reg-pass2" name="password_confirmation" autocomplete="new-password"
                                    class="form-control password-input" style="border-left:1.5px solid var(--line); border-right:0" required>
                                <button type="button" class="input-group-text eye-toggle" aria-label="Afficher le mot de passe">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 btn-lg mt-4">
                        <i class="bi bi-person-plus me-1"></i> Créer mon compte
                    </button>
                </form>

                <p class="switch mb-0">Déjà un compte ? <a href="{{ route('user.loginForm') }}">Se connecter</a></p>
            </div>
        </div>
    </section>
@endsection

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
