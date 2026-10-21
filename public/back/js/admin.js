/* =========================================================
   FOANI — Back-office : comportements communs
   1. Notifications (commandes, réservations, messages) : un seul appel
      toutes les 30 s, en pause quand l'onglet est caché, son unique par nouveauté.
   2. Barre de progression pendant la navigation.
   3. Anti double clic sur les formulaires (bouton désactivé + spinner).
   ========================================================= */
(function () {
    'use strict';

    var cfg = window.FOANI_ADMIN || {};
    var POLL_MS = 30000;
    var MAX_BACKOFF_MS = 5 * 60000;
    var SEEN_KEY = 'foani.notifications.seen';
    var baseTitle = document.title;

    /* ---------------- 1. Notifications ---------------- */
    var timer = null;
    var delay = POLL_MS;
    var inFlight = false;

    function readSeen() {
        try { return JSON.parse(localStorage.getItem(SEEN_KEY)) || null; } catch (e) { return null; }
    }

    function writeSeen(v) {
        try { localStorage.setItem(SEEN_KEY, JSON.stringify(v)); } catch (e) { /* stockage indisponible */ }
    }

    function escapeHtml(s) {
        return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
        });
    }

    function setCount(type, n) {
        document.querySelectorAll('[data-notif-count="' + type + '"]').forEach(function (el) {
            var before = parseInt(el.textContent, 10) || 0;
            el.textContent = n > 99 ? '99+' : n;
            el.classList.toggle('is-empty', !n);
            if (n > before) {
                el.classList.remove('bump');
                void el.offsetWidth;
                el.classList.add('bump');
            }
        });
        document.querySelectorAll('[data-notif-total="' + type + '"]').forEach(function (el) {
            el.textContent = n + ' en attente';
        });
    }

    var ICONS = { commandes: 'ri-shopping-bag-3-line', reservations: 'ri-calendar-check-line', messages: 'ri-mail-unread-line' };
    var EMPTY = { commandes: 'Aucune commande en attente', reservations: 'Aucune réservation en attente', messages: 'Aucun nouveau message' };

    function renderList(type, items) {
        var box = document.querySelector('[data-notif-list="' + type + '"]');
        if (!box) return;
        if (!items || !items.length) {
            box.innerHTML = '<div class="foani-notif__empty"><i class="ri-checkbox-circle-line fs-3 d-block mb-1 text-success"></i>' + EMPTY[type] + '</div>';
            return;
        }
        box.innerHTML = items.map(function (it) {
            return '<a class="foani-notif__item" href="' + escapeHtml(it.url) + '">' +
                '<i class="' + ICONS[type] + '"></i>' +
                '<span><strong>' + escapeHtml(it.title) + '</strong>' +
                (it.text ? '<small>' + escapeHtml(it.text) + '</small>' : '') +
                '<small>' + escapeHtml(it.when) + '</small></span></a>';
        }).join('');
    }

    function playSound() {
        if (!cfg.sound) return;
        try {
            var a = new Audio(cfg.sound);
            a.volume = 0.6;
            var p = a.play();
            if (p && p.catch) p.catch(function () { /* son bloqué tant qu'il n'y a pas eu de clic : sans gravité */ });
        } catch (e) { /* ignoré */ }
    }

    function handle(data) {
        var counts = data.counts || {};
        var total = 0;
        ['commandes', 'reservations', 'messages'].forEach(function (t) {
            setCount(t, counts[t] || 0);
            renderList(t, (data.items || {})[t]);
            total += counts[t] || 0;
        });
        document.title = (total ? '(' + total + ') ' : '') + baseTitle;
        // Les pages peuvent réagir aux nouveautés (ex. bandeau « nouvelles commandes »)
        document.dispatchEvent(new CustomEvent('foani:notifications', { detail: data }));

        // Son uniquement si un élément plus récent que le dernier déjà signalé est arrivé.
        // La mémoire est partagée entre onglets (localStorage) : un seul onglet sonne.
        var latest = data.latest_at || {};
        var seen = readSeen();
        if (!seen) {
            writeSeen(latest); // première visite : on mémorise sans sonner
            return;
        }
        var nouveau = Object.keys(latest).some(function (t) {
            return latest[t] && (!seen[t] || latest[t] > seen[t]);
        });
        if (nouveau) {
            writeSeen(Object.assign({}, seen, latest));
            playSound();
        }
    }

    function schedule(ms) {
        clearTimeout(timer);
        timer = setTimeout(poll, ms);
    }

    function poll() {
        if (!cfg.notificationsUrl || inFlight || document.hidden) return;
        inFlight = true;
        fetch(cfg.notificationsUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }, credentials: 'same-origin' })
            .then(function (r) {
                if (r.status === 401 || r.status === 419 || r.redirected) throw new Error('session');
                if (!r.ok) throw new Error('http ' + r.status);
                return r.json();
            })
            .then(function (data) {
                handle(data);
                delay = POLL_MS;
                schedule(delay);
            })
            .catch(function (err) {
                if (err && err.message === 'session') return; // session expirée : on arrête d'interroger
                delay = Math.min(delay * 2, MAX_BACKOFF_MS);  // serveur indisponible : on espace les appels
                schedule(delay);
            })
            .finally(function () { inFlight = false; });
    }

    document.addEventListener('visibilitychange', function () {
        if (document.hidden) {
            clearTimeout(timer);
        } else {
            poll(); // retour sur l'onglet : mise à jour immédiate
        }
    });

    /* ---------------- 2. Barre de progression ---------------- */
    var bar = document.createElement('div');
    bar.id = 'foani-progress';

    function startProgress() {
        bar.classList.remove('is-loading');
        void bar.offsetWidth;
        bar.classList.add('is-loading');
    }

    function stopProgress() { bar.classList.remove('is-loading'); }

    document.addEventListener('click', function (e) {
        var a = e.target.closest && e.target.closest('a[href]');
        if (!a || e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
        var href = a.getAttribute('href');
        if (!href || href.charAt(0) === '#' || href.indexOf('javascript:') === 0 || a.target === '_blank' ||
            a.hasAttribute('download') || a.dataset.bsToggle || a.classList.contains('delete')) return;
        if (a.origin && a.origin !== location.origin) return;
        startProgress();
    });

    window.addEventListener('pageshow', stopProgress);

    /* ---------------- 3. Anti double clic sur les formulaires ---------------- */
    document.addEventListener('submit', function (e) {
        var form = e.target;
        // Laisse d'abord passer les autres gestionnaires (validation, envoi AJAX…)
        setTimeout(function () {
            if (e.defaultPrevented || form.hasAttribute('data-no-lock') || form.target === '_blank') return;
            startProgress();
            form.querySelectorAll('button[type="submit"], button:not([type]), input[type="submit"]').forEach(function (btn) {
                if (btn.classList.contains('is-busy')) return;
                btn.classList.add('is-busy');
                btn.setAttribute('aria-busy', 'true');
                if (btn.tagName === 'BUTTON') btn.insertAdjacentHTML('afterbegin', '<span class="foani-spin" aria-hidden="true"></span>');
                // désactivé après l'envoi pour que la valeur du bouton soit bien transmise
                setTimeout(function () { btn.disabled = true; }, 0);
            });
            // Si la page n'a pas changé (téléchargement d'un fichier, erreur réseau…), on débloque
            setTimeout(unlockAll, 8000);
        }, 0);
    });

    function unlockAll() {
        stopProgress();
        document.querySelectorAll('.is-busy').forEach(function (btn) {
            btn.classList.remove('is-busy');
            btn.disabled = false;
            btn.removeAttribute('aria-busy');
            var s = btn.querySelector('.foani-spin');
            if (s) s.remove();
        });
    }

    // Retour arrière : les boutons redeviennent utilisables
    window.addEventListener('pageshow', function (e) {
        if (e.persisted) unlockAll();
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.body.appendChild(bar);
        poll();
    });
})();
