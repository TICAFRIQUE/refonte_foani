/* =========================================================
   FOANI — Boutique : interactions partagées
   - notifications (FoaniToast)
   - thème des fenêtres SweetAlert
   - animations d'apparition au défilement
   - header au défilement, barre de catégories, vidéo YouTube légère
   ========================================================= */
(function () {
    'use strict';

    document.documentElement.classList.add('js');

    /* ---------- Notifications ---------- */
    var ICONS = {
        success: 'bi-check-circle-fill',
        error: 'bi-exclamation-octagon-fill',
        warning: 'bi-exclamation-triangle-fill',
        info: 'bi-info-circle-fill'
    };

    function escapeHtml(s) {
        return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
        });
    }

    function stack() {
        var el = document.querySelector('.toast-stack');
        if (!el) {
            el = document.createElement('div');
            el.className = 'toast-stack';
            el.setAttribute('aria-live', 'polite');
            document.body.appendChild(el);
        }
        return el;
    }

    /**
     * FoaniToast.show({ type, title, text, image, actions: [{label, href, ghost}], duration })
     */
    function show(opts) {
        opts = opts || {};
        var type = ICONS[opts.type] ? opts.type : 'success';
        var duration = opts.duration || (type === 'error' ? 7000 : 4000);

        var icon = opts.image
            ? '<img src="' + escapeHtml(opts.image) + '" alt="">'
            : '<i class="bi ' + ICONS[type] + '"></i>';

        var actions = (opts.actions || []).map(function (a) {
            return '<a href="' + escapeHtml(a.href) + '"' + (a.ghost ? ' class="ghost"' : '') + '>' + escapeHtml(a.label) + '</a>';
        }).join('');

        var el = document.createElement('div');
        el.className = 'ftoast ftoast--' + type;
        el.setAttribute('role', type === 'error' ? 'alert' : 'status');
        el.innerHTML =
            '<div class="ftoast__icon">' + icon + '</div>' +
            '<div class="ftoast__body">' +
            '<div class="ftoast__title">' + escapeHtml(opts.title || '') + '</div>' +
            (opts.text ? '<div class="ftoast__text">' + escapeHtml(opts.text) + '</div>' : '') +
            (actions ? '<div class="ftoast__actions">' + actions + '</div>' : '') +
            '</div>' +
            '<button type="button" class="ftoast__close" aria-label="Fermer"><i class="bi bi-x-lg"></i></button>' +
            '<span class="ftoast__bar" style="animation-duration:' + duration + 'ms"></span>';

        var container = stack();
        container.appendChild(el);
        while (container.children.length > 3) container.removeChild(container.firstChild);

        var timer;
        function close() {
            clearTimeout(timer);
            el.classList.add('is-leaving');
            setTimeout(function () { el.remove(); }, 250);
        }
        function start(ms) { timer = setTimeout(close, ms); }

        el.querySelector('.ftoast__close').addEventListener('click', close);
        // Pause au survol
        el.addEventListener('mouseenter', function () {
            clearTimeout(timer);
            el.querySelector('.ftoast__bar').style.animationPlayState = 'paused';
        });
        el.addEventListener('mouseleave', function () {
            el.querySelector('.ftoast__bar').style.animationPlayState = 'running';
            start(1500);
        });
        start(duration);
        return el;
    }

    window.FoaniToast = {
        show: show,
        success: function (title, text, extra) { return show(Object.assign({ type: 'success', title: title, text: text }, extra)); },
        error: function (title, text, extra) { return show(Object.assign({ type: 'error', title: title, text: text }, extra)); },
        warning: function (title, text, extra) { return show(Object.assign({ type: 'warning', title: title, text: text }, extra)); },
        info: function (title, text, extra) { return show(Object.assign({ type: 'info', title: title, text: text }, extra)); }
    };

    /* ---------- Thème SweetAlert : toutes les fenêtres prennent le style de la ferme ---------- */
    function themeSwal() {
        if (!window.Swal || window.Swal.__farm) return;
        var original = window.Swal.fire.bind(window.Swal);
        window.Swal.fire = function () {
            var args = Array.prototype.slice.call(arguments);
            var opts = typeof args[0] === 'object' && args[0] !== null
                ? Object.assign({}, args[0])
                : { title: args[0], html: args[1], icon: args[2] };
            opts.customClass = Object.assign({ popup: 'farm-swal' }, opts.customClass || {});
            // Les couleurs viennent du thème (on ignore les couleurs bleu/rouge par défaut)
            delete opts.confirmButtonColor;
            delete opts.cancelButtonColor;
            if (opts.reverseButtons === undefined) opts.reverseButtons = true;
            if (!opts.confirmButtonText) opts.confirmButtonText = 'OK';
            return original(opts);
        };
        window.Swal.__farm = true;
    }

    /* ---------- Compteurs du panier ---------- */
    window.updateCartBadges = function (count) {
        document.querySelectorAll('[data-cart-count], .mobile-cart-badge, #cart-badge-bottom, #cart-badge-mobile')
            .forEach(function (el) {
                el.textContent = count;
                el.classList.remove('bump');
                void el.offsetWidth; // relance l'animation
                el.classList.add('bump');
            });
    };

    /* ---------- Apparition au défilement ---------- */
    function initReveal() {
        var items = document.querySelectorAll('.reveal');
        if (!('IntersectionObserver' in window)) {
            items.forEach(function (el) { el.classList.add('is-visible'); });
            return;
        }
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
        items.forEach(function (el) { io.observe(el); });
    }

    /* ---------- Header : ombre au défilement ---------- */
    function initHeader() {
        var header = document.querySelector('.site-header');
        if (!header) return;
        var last = null;
        function update() {
            var scrolled = window.scrollY > 10;
            if (scrolled !== last) {
                header.classList.toggle('is-scrolled', scrolled);
                last = scrolled;
            }
        }
        window.addEventListener('scroll', update, { passive: true });
        update();
    }

    /* ---------- Barre de catégories : flèches + dégradés ---------- */
    function initChips() {
        document.querySelectorAll('.chips-scroller').forEach(function (wrap) {
            var track = wrap.querySelector('.cat-chips');
            if (!track) return;
            function update() {
                var max = track.scrollWidth - track.clientWidth;
                wrap.classList.toggle('can-left', track.scrollLeft > 4);
                wrap.classList.toggle('can-right', track.scrollLeft < max - 4);
            }
            wrap.querySelectorAll('.chips-arrow').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var dir = btn.classList.contains('chips-arrow--prev') ? -1 : 1;
                    track.scrollBy({ left: dir * track.clientWidth * 0.7, behavior: 'smooth' });
                });
            });
            track.addEventListener('scroll', update, { passive: true });
            window.addEventListener('resize', update);
            var active = track.querySelector('.active');
            if (active) track.scrollLeft = active.offsetLeft - (track.clientWidth - active.offsetWidth) / 2;
            update();
        });
    }

    /* ---------- Vidéo YouTube : l'iframe (lourde) n'est chargée qu'au clic ---------- */
    function initYoutube() {
        document.querySelectorAll('.yt-facade').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var id = btn.getAttribute('data-yt');
                btn.innerHTML = '<iframe src="https://www.youtube-nocookie.com/embed/' + encodeURIComponent(id) +
                    '?autoplay=1&rel=0" title="Vidéo Foani" allow="autoplay; encrypted-media; fullscreen" allowfullscreen></iframe>';
            }, { once: true });
        });
    }

    /* ---------- Messages de session envoyés par le serveur ---------- */
    function initFlash() {
        var node = document.getElementById('flash-messages');
        if (!node) return;
        try {
            JSON.parse(node.textContent).forEach(function (m, i) {
                setTimeout(function () { show(m); }, 300 + i * 250);
            });
        } catch (e) { /* données invalides : on ignore */ }
    }

    document.addEventListener('DOMContentLoaded', function () {
        themeSwal();
        initReveal();
        initHeader();
        initChips();
        initYoutube();
        initFlash();
    });

    // SweetAlert peut être chargé après ce script
    window.addEventListener('load', themeSwal);
})();
