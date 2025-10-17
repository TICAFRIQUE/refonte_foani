{{-- filepath: resources/views/frontend/pages/dashboard_client/profile.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Mon profil')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center" style="color:#559e33;">Mon profil</h2>
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="bg-white p-4 rounded shadow-sm">
               @include('frontend.components.message_session')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('user.profil') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nom & Prénoms <span class="text-danger">*</span></label>
                        <input type="text" name="username" value="{{ old('username', $user->username ?? $user->name) }}" class="form-control @error('username') is-invalid @enderror" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Téléphone <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">+225</span>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control @error('phone') is-invalid @enderror" required>
                        </div>
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label">Nouveau mot de passe</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control password-input @error('password') is-invalid @enderror" autocomplete="new-password">
                            <span class="input-group-text eye-toggle" style="cursor:pointer;">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmer le mot de passe</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control password-input" autocomplete="new-password">
                            <span class="input-group-text eye-toggle" style="cursor:pointer;">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button type="submit" class="btn px-5 fw-bold" style="background:#559e33;color:#fff;">
                            <i class="bi bi-save"></i> Mettre à jour
                        </button>
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