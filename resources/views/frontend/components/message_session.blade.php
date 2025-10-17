{{-- filepath: c:\laragon\www\foani\resources\views\frontend\components\message_session.blade.php --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Faire disparaître les alertes après 30 secondes avec fadeout
    const alerts = document.querySelectorAll('.alert');
    
    alerts.forEach(function(alert) {
        setTimeout(function() {
            // Ajouter une transition CSS pour le fadeout
            alert.style.transition = 'opacity 1s ease-out';
            alert.style.opacity = '0';
            
            // Supprimer complètement l'élément après l'animation
            setTimeout(function() {
                if (alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 1000); // 1 seconde pour l'animation fadeout
        }, 30000); // 30 secondes avant de commencer le fadeout
    });
});
</script>

<style>
.alert {
    transition: opacity 0.3s ease-in-out;
}
</style>
