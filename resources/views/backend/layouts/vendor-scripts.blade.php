{{-- jQuery : UNE seule copie pour tout le back-office (les pages ne doivent plus la recharger) --}}
<script src="{{ asset('front/vendor/jquery-3.7.1/jquery.min.js') }}"></script>
<script>
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
</script>

<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ URL::asset('build/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('front/vendor/select2-4.1.0/select2.min.js') }}"></script>
<script src="{{ asset('front/vendor/select2-4.1.0/fr.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>
<script src="{{ URL::asset('myJs/js/delete_row.js') }}"></script>

@yield('script')
@yield('script-bottom')

@if (empty($sansNavigation))
    {{-- Script du thème (menu, sidebar…) : chargé une seule fois ici, plus dans chaque page --}}
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endif

<script>
    // Validation Bootstrap des formulaires .needs-validation
    document.querySelectorAll('.needs-validation').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Configuration du script commun du back-office (notifications, progression, anti double clic)
    window.FOANI_ADMIN = {
        notificationsUrl: @json(Auth::check() ? route('admin.notifications') : null),
        sound: @json(asset('audio/notify_bell.wav'))
    };
</script>
@if (empty($sansNavigation))
    <script src="{{ asset('back/js/admin.js') }}?v={{ filemtime(public_path('back/js/admin.js')) }}"></script>
@endif
