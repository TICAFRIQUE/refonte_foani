<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />



<div class="dropdown ms-2 header-item">
    <button type="button" class="btn btn-icon btn-topbar position-relative" id="notifDropdown" data-bs-toggle="dropdown">
        <i class="bx bx-cart fs-20"></i>
        <span id="notif-count-commandes"
            class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle p-1">...</span>
    </button>

    <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0" aria-labelledby="notifDropdown">
        <div class="p-3 border-bottom">
            <h6 class="m-0">Notifications</h6>
        </div>
        <div id="notif-list-commandes" style="max-height:300px; overflow:auto;">
            <div class="p-3 text-center text-muted">Chargement...</div>
        </div>
        <div class="dropdown-divider"></div>
        <div class="p-2 text-center">
            <a href="{{ route('commandes.index') }}" class="btn btn-sm btn-link">Voir toutes</a>
        </div>
    </div>
</div>



<script>
    function checkNewOrders() {
        $.ajax({
            url: "{{ url('/admin/commandes/newOrders') }}",
            method: "GET",
            success: function(data) {
                if (data.count > 0) {
                    // Mettre à jour le badge
                    $("#notif-count-commandes").text(data.count || 0);
                    // Vider et reconstruire la liste
                    const listContainer = $("#notif-list-commandes");
                    listContainer.empty();

                    data.orders.forEach(function(commande) {
                        const commandeHtml = `
                        <a class="dropdown-item d-flex align-items-start" href="${commande.url || '#'}">
                            <div class="me-2"><i class="bi bi-clock-history text-success"></i></div>
                            <div>
                                <div class="small fw-semibold">${commande.code}''}</div>
                                <div class="small text-muted">${commande.created_at}</div>
                                <div class="small text-success fw-bold">${(commande.total || 0).toLocaleString('fr-FR')} FCFA</div>
                            </div>
                        </a>
                    `;
                        listContainer.append(commandeHtml);
                    });

                    // Jouer le son directement
                    const alertSound = new Audio("{{ asset('audio/notify_bell.wav') }}");
                    alertSound.play();
                } else {
                    // Si aucune nouvelle réservation, masquer le badge
                    $("#notif-count-commandes").text('0');
                    $("#notif-list-commandes").html(
                        '<div class="p-3 text-center text-muted">Aucune nouvelle commande</div>');
                }
            },
            error: function(xhr) {
                console.error("Erreur lors de la récupération des réservations.");
            },
        });
    }

    // Vérifier les nouvelles commandes toutes les 10 secondes
    setInterval(checkNewOrders, 10000);
</script>
















{{-- <script>
(function(){
    const endpoint = "{{ route('commandes.newOrderCount') }}";
    const intervalMs = 10000; // 10s

    function updateNotifications(data) {
        const badge = document.getElementById('notif-count-commandes');
        const list = document.getElementById('notif-list-commandes');

        if (badge) {
            const prevCount = parseInt(badge.textContent || '0', 10);
            badge.textContent = data.count || 0;
            badge.style.display = (data.count && data.count > 0) ? 'inline-block' : 'none';

            if (data.count > prevCount) {
                badge.classList.add('animate__animated', 'animate__bounceIn');
                setTimeout(() => badge.classList.remove('animate__animated', 'animate__bounceIn'), 1000);
            }
        }

        if (list) {
            list.innerHTML = '';
            (data.orders || []).forEach(o => {
                const a = document.createElement('a');
                a.className = 'dropdown-item d-flex align-items-start';
                a.href = o.url || '#';
                a.innerHTML = `
                    <div class="me-2"><i class="bi bi-bag-check text-success"></i></div>
                    <div>
                        <div class="small fw-semibold">Commande ${o.code}</div>
                        <div class="small text-muted">${o.created_at}</div>
                    </div>
                `;
                list.appendChild(a);
            });

            if ((data.orders || []).length === 0) {
                const empty = document.createElement('div');
                empty.className = 'p-3 text-center text-muted';
                empty.textContent = 'Aucune notification';
                list.appendChild(empty);
            }
        }
        
    }

    async function poll() {
        try {
            const res = await fetch(endpoint, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin'
            });
            if (!res.ok) return;
            const data = await res.json();
            updateNotifications(data);
        } catch (err) {
            console.error('Polling error', err);
        }
    }

    poll();
    setInterval(poll, intervalMs);
})();
</script> --}}
