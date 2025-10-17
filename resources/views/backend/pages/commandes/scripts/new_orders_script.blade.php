{{-- <script>
    $(document).ready(function() {
        const endpoint = "{{ route('commandes.newOrders') }}";
        const pollMs = 10000;
        let pollingInterval = null;

        function statutBadge(statut) {
            const map = {
                'en_attente': 'secondary',
                'en_cours': 'warning',
                'livree': 'success',
                'livrée': 'success',
                'annulee': 'danger',
                'annulée': 'danger'
            };
            return `<span class="badge bg-${map[statut] || 'secondary'}">${(statut || '').replace(/_/g, ' ')}</span>`;
        }

        function formatMoney(v) {
            return new Intl.NumberFormat('fr-FR').format(v || 0) + ' F';
        }

        function addOrderIfNew(o) {
            if ($('#row_' + o.id).length > 0) return;

            const codeHtml = `<strong>${o.code}</strong>`;
            const client = o.client_name || (o.user && o.user.username) || 'Inconnu';
            const contact = o.telephone || '—';
            const total = formatMoney(o.total);
            const date = o.created_at_display || o.created_at || '';
            const statutHtml = statutBadge(o.statut);

            const actions = `
                <div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="ri-more-fill"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="${o.show_url || ('/admin/commandes/' + o.id)}" class="dropdown-item">
                                <i class="ri-eye-fill align-bottom me-2 text-muted"></i> Voir
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item remove-item-btn delete" data-id="${o.id}">
                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Supprimer
                            </a>
                        </li>
                    </ul>
                </div>
            `;

            const rowData = ['', codeHtml, client, contact, total, date, statutHtml, actions];
            const row = table.row.add(rowData).draw(false).node();
            $(row).attr('id', 'row_' + o.id);
            $('#commandes-table tbody').prepend($(row));

            $('#commandes-table tbody tr').each(function(i) {
                $(this).find('td').first().text(i + 1);
            });

            console.log('Nouvelle commande ajoutée: ' + o.code);
        }

        function pollNewOrders() {
            $.ajax({
                url: endpoint,
                method: 'GET',
                dataType: 'json',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(res) {
                    if (!res || !res.orders) return;
                    res.orders.forEach(addOrderIfNew);
                },
                error: function(xhr) {
                    console.error('Erreur récupération nouvelles commandes', xhr);
                }
            });
        }

        // Lancer le polling
        setTimeout(function() {
            pollNewOrders();
            pollingInterval = setInterval(pollNewOrders, pollMs);
        }, 1000);

        // 🧹 Nettoyage à la sortie de la page
        $(window).on('beforeunload', function() {
            if (pollingInterval) {
                clearInterval(pollingInterval);
            }
        });
    });
</script> --}}

{{-- 
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const table = $('#commandes-table').DataTable({
            responsive: true,
            order: [[0, 'asc']],
            dom: 'Bfrtip',
            buttons: ['copy', 'excel', 'pdf', 'print'],
            columnDefs: [{ orderable: false, targets: [7] }]
        });

        const endpoint = "{{ route('commandes.newOrders') }}";
        const pollMs = 10000; // 10 secondes
        const POLLING_KEY = 'poll_new_orders_interval'; // clé globale pour éviter doublons

        // 🧹 Si un intervalle existe déjà, on le supprime
        if (window[POLLING_KEY]) {
            clearInterval(window[POLLING_KEY]);
            console.log('⛔ Ancien polling nettoyé');
        }

        // mapping badge
        const statutBadge = (statut) => {
            const map = {
                en_attente: 'secondary',
                en_cours: 'warning',
                livree: 'success',
                livrée: 'success',
                annulee: 'danger',
                annulée: 'danger'
            };
            return `<span class="badge bg-${map[statut] || 'secondary'}">${(statut || '').replace(/_/g, ' ')}</span>`;
        };

        const formatMoney = (v) => new Intl.NumberFormat('fr-FR').format(v || 0) + ' F';

        const addOrderIfNew = (o) => {
            // vérifier si la commande existe déjà
            if ($('#row_' + o.id).length > 0) return;

            const client = o.client_name || 'Inconnu';
            const contact = o.telephone || '—';
            const total = formatMoney(o.total);
            const date = o.created_at_display || '';
            const statutHtml = statutBadge(o.statut);

            const actions = `
                <div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="ri-more-fill"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="${o.show_url}" class="dropdown-item">
                                <i class="ri-eye-fill align-bottom me-2 text-muted"></i> Voir
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item remove-item-btn delete" data-id="${o.id}">
                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Supprimer
                            </a>
                        </li>
                    </ul>
                </div>`;

            const rowData = [
                '', `<strong>${o.code}</strong>`, client, contact,
                total, date, statutHtml, actions
            ];

            const row = table.row.add(rowData).draw(false).node();
            $(row).attr('id', 'row_' + o.id);
            $('#commandes-table tbody').prepend($(row));

            // renuméroter
            $('#commandes-table tbody tr').each(function (i) {
                $(this).find('td').first().text(i + 1);
            });

            console.log('✅ Nouvelle commande ajoutée:', o.code);
        };

        function pollNewOrders() {
            $.ajax({
                url: endpoint,
                method: 'GET',
                dataType: 'json',
                success: function (res) {
                    if (!res || !res.orders) return;
                    res.orders.forEach(addOrderIfNew);
                },
                error: function (xhr) {
                    console.error('Erreur récupération nouvelles commandes', xhr);
                }
            });
        }

        // Premier lancement après 1s
        setTimeout(() => {
            pollNewOrders();
            window[POLLING_KEY] = setInterval(pollNewOrders, pollMs);
            console.log('🚀 Polling lancé');
        }, 1000);

        // Nettoyer proprement à la fermeture ou navigation
        window.addEventListener('beforeunload', () => {
            if (window[POLLING_KEY]) {
                clearInterval(window[POLLING_KEY]);
                console.log('🧹 Polling arrêté');
            }
        });
    });
</script> --}}

<script>
    $(function() {
        // ✅ Empêche plusieurs initialisations
        if (window.pollNewOrdersActive) {
            console.log("⛔ Polling déjà actif, on stoppe.");
            clearInterval(window.pollNewOrdersActive);
            window.pollNewOrdersActive = null;
        }

        // ✅ Si DataTable existe déjà, on le détruit
        if ($.fn.DataTable.isDataTable('#commandes-table')) {
            $('#commandes-table').DataTable().destroy();
        }

        // ✅ Réinitialise proprement le tableau
        const table = $('#commandes-table').DataTable({
            responsive: true,
            stateSave: false, // empêche DataTables de stocker les anciennes lignes
            destroy: true,
            order: [
                [0, 'asc']
            ],
            dom: 'Bfrtip',
            buttons: ['copy', 'excel', 'pdf', 'print'],
            columnDefs: [{
                orderable: false,
                targets: [7]
            }]
        });



        const endpoint = "{{ route('commandes.newOrders') }}";
        const pollMs = 10000;

        function formatMoney(v) {
            return new Intl.NumberFormat('fr-FR').format(v || 0) + ' F';
        }

        function statutBadge(statut) {
            const map = {
                en_attente: 'secondary',
                en_cours: 'warning',
                livree: 'success',
                livrée: 'success',
                annulee: 'danger',
                annulée: 'danger'
            };
            const cls = map[statut] || 'secondary';
            return `<span class="badge bg-${cls}">${(statut || '').replace(/_/g, ' ')}</span>`;
        }

        // ✅ Ajoute une commande si nouvelle
        function addOrderIfNew(o) {
            if ($('#row_' + o.id).length > 0) return;

            const rowData = [
                '', `<strong>${o.code}</strong>`,
                o.client_name || 'Inconnu',
                o.telephone || '—',
                formatMoney(o.total),
                o.created_at_display || '',
                statutBadge(o.statut),
                `
                <div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="ri-more-fill"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="${o.show_url}" class="dropdown-item">
                                <i class="ri-eye-fill align-bottom me-2 text-muted"></i> Voir
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item remove-item-btn delete" data-id="${o.id}">
                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Supprimer
                            </a>
                        </li>
                    </ul>
                </div>`
            ];

            const row = table.row.add(rowData).draw(false).node();
            $(row).attr('id', 'row_' + o.id);

            // Renumérote les lignes
            $('#commandes-table tbody tr').each(function(i) {
                $(this).find('td').first().text(i + 1);
            });

            console.log('🆕 Commande ajoutée:', o.code);
        }

        // ✅ Fonction pour récupérer les nouvelles commandes
        function pollNewOrders() {
            $.ajax({
                url: endpoint,
                method: 'GET',
                dataType: 'json',
                cache: false,
                success: function(res) {
                    if (!res || !res.orders) return;

                    // Nettoyer les anciennes lignes des 2 dernières minutes pour éviter doublons fantômes
                    const now = new Date();
                    $('#commandes-table tbody tr').each(function() {
                        const id = $(this).attr('id');
                        if (id && !res.orders.some(o => 'row_' + o.id === id)) {
                            table.row(this).remove();
                        }
                    });
                    table.draw(false);

                    // Ajouter les nouvelles
                    res.orders.forEach(addOrderIfNew);
                },
                error: function(xhr) {
                    console.error('❌ Erreur récupération commandes', xhr.status);
                }
            });
        }

        // ✅ Lancer le polling
        pollNewOrders();
        window.pollNewOrdersActive = setInterval(pollNewOrders, pollMs);

        // ✅ Nettoyer à la fermeture / navigation
        $(window).on('beforeunload', function() {
            if (window.pollNewOrdersActive) {
                clearInterval(window.pollNewOrdersActive);
                window.pollNewOrdersActive = null;
                console.log("🧹 Polling arrêté avant navigation");
            }
        });

        //supprimer une commande
        var route = "commandes";
        delete_row(route);

        //
    });
</script>
