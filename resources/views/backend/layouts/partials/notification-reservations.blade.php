<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<div class="dropdown ms-2 header-item">
    <button type="button" class="btn btn-icon btn-topbar position-relative" id="notifDropdown" data-bs-toggle="dropdown">
        <i class="bx bx-calendar fs-20"></i>
        <span id="notif-count-reservations"
            class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle p-1"
           >...</span>
    </button>

    <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0" aria-labelledby="notifDropdown">
        <div class="p-3 border-bottom">
            <h6 class="m-0">Réservations</h6>
        </div>
        <div id="notif-list-reservations" style="max-height:300px; overflow:auto;">
            <div class="p-3 text-center text-muted">Chargement...</div>
        </div>
        <div class="dropdown-divider"></div>
        <div class="p-2 text-center">
            <a href="{{ url('/admin/reservations') }}" class="btn btn-sm btn-link">Voir toutes</a>
        </div>
    </div>
</div>







<script>
    function checkNewReservations() {
        $.ajax({
            url: "{{ url('/admin/reservations/newReservationCount') }}",
            method: "GET",
            success: function(data) {
                if (data.count > 0) {
                    // Mettre à jour le badge
                    $("#notif-count-reservations").text(data.count || 0);
                    // Vider et reconstruire la liste
                    const listContainer = $("#notif-list-reservations");
                    listContainer.empty();

                    data.reservations.forEach(function(reservation) {
                        const reservationHtml = `
                        <a class="dropdown-item d-flex align-items-start" href="${reservation.url || '#'}">
                            <div class="me-2"><i class="bi bi-clock-history text-success"></i></div>
                            <div>
                                <div class="small fw-semibold">${reservation.code} — ${reservation.nom || ''}</div>
                                <div class="small text-muted">${reservation.produit ? (reservation.produit + ' • x' + (reservation.quantite || 1)) : ''} — ${reservation.created_at || ''}</div>
                                <div class="small text-success fw-bold">${(reservation.total || 0).toLocaleString('fr-FR')} FCFA</div>
                            </div>
                        </a>
                    `;
                        listContainer.append(reservationHtml);
                    });

                    // Jouer le son directement
                    const alertSound = new Audio("{{ asset('audio/notify_bell.wav') }}");
                    alertSound.play();
                } else {
                    // Si aucune nouvelle réservation, masquer le badge
                    $("#notif-count-reservations").text('0');
                    $("#notif-list-reservations").html('<div class="p-3 text-center text-muted">Aucune nouvelle réservation</div>');
                }
            },
            error: function(xhr) {
                console.error("Erreur lors de la récupération des réservations.");
            },
        });
    }

    // Vérifier les nouvelles réservations toutes les 10 secondes
    setInterval(checkNewReservations, 10000);
</script>















{{-- <script>
    (function() {
        // point directly vers l'endpoint backend (évite dépendance sur le nom de route)
        const endpoint = "{{ url('/admin/reservations/newReservationCount') }}";
        const intervalMs = 10000; // 10s

        function updateNotifications(data) {
            const badge = document.getElementById('notif-count-reservations');
            const list = document.getElementById('notif-list-reservations');

            const count = (data && data.count) ? data.count : 0;
            const items = (data && data.reservations) ? data.reservations : [];

            if (badge) {
                const prevCount = parseInt(badge.textContent || '0', 10);
                badge.textContent = count;
                badge.style.display = (count && count > 0) ? 'inline-block' : 'none';

                if (count > prevCount) {
                    badge.classList.add('animate__animated', 'animate__bounceIn');
                    setTimeout(() => badge.classList.remove('animate__animated', 'animate__bounceIn'), 900);
                }
            }

            if (list) {
                list.innerHTML = '';
                if (items.length) {
                    items.forEach(r => {
                        const a = document.createElement('a');
                        a.className = 'dropdown-item d-flex align-items-start';
                        a.href = r.url || '#';
                        a.innerHTML = `
                        <div class="me-2"><i class="bi bi-clock-history text-success"></i></div>
                        <div>
                            <div class="small fw-semibold">${r.code} — ${r.nom || ''}</div>
                            <div class="small text-muted">${r.produit ? (r.produit + ' • x' + (r.quantite || 1)) : ''} — ${r.created_at || ''}</div>
                            <div class="small text-success fw-bold">${(r.total || 0).toLocaleString('fr-FR')} FCFA</div>
                        </div>
                    `;
                        list.appendChild(a);
                    });
                } else {
                    const empty = document.createElement('div');
                    empty.className = 'p-3 text-center text-muted';
                    empty.textContent = 'Aucune nouvelle réservation';
                    list.appendChild(empty);
                }
            }
        }

        async function poll() {
            try {
                const res = await fetch(endpoint, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                });
                if (!res.ok) return;
                const data = await res.json();
                updateNotifications(data);
            } catch (err) {
                console.error('Polling reservations error', err);
            }
        }

        // démarrage immédiat et répétition
        poll();
        setInterval(poll, intervalMs);
    })();
</script> --}}
