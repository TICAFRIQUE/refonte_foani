{{-- filepath: resources/views/frontend/pages/auth_client/login.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Connexion client')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="bg-white p-4 rounded shadow-sm">
                <h2 class="fw-bold mb-4 text-center" style="color:#2a6b2a;">Connexion client</h2>
                <form action="{{ route('user.login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email ou Téléphone <span class="text-danger">*</span></label>
                        <input type="text" name="login" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember" class="form-label">Se souvenir de moi</label>
                        </div>
                        <a href="#" class="fw-bold" style="color:#2a6b2a;">Mot de passe oublié ?</a>
                    </div>
                    <div class="mt-4 text-center">
                        <button type="submit" class="btn px-5 fw-bold" style="background:#2a6b2a;color:#fff;">
                            <i class="bi bi-box-arrow-in-right"></i> Se connecter
                        </button>
                    </div>
                    <div class="mt-3 text-center">
                        <span>Pas encore de compte ?</span>
                        <a href="{{ route('user.registerForm') }}" class="fw-bold" style="color:#2a6b2a;">S'inscrire</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection