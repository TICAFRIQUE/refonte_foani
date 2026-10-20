/* =========================================================
   FOANI & SERVICES — site vitrine : interactions (sans jQuery)
   ========================================================= */
(function () {
    'use strict';

    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* Apparition des blocs au défilement */
    function initReveal() {
        var items = document.querySelectorAll('.reveal');
        if (!('IntersectionObserver' in window) || reduceMotion) {
            items.forEach(function (el) { el.classList.add('is-visible'); });
            return;
        }
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); }
            });
        }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
        items.forEach(function (el) { io.observe(el); });
    }

    /* Compteurs animés (une seule boucle requestAnimationFrame) */
    function initCounters() {
        var counters = document.querySelectorAll('[data-count]');
        if (!counters.length || !('IntersectionObserver' in window) || reduceMotion) return;
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (!e.isIntersecting) return;
                io.unobserve(e.target);
                var el = e.target, target = +el.dataset.count, suffix = el.dataset.suffix || '', start = null;
                function step(ts) {
                    if (!start) start = ts;
                    var p = Math.min((ts - start) / 1400, 1);
                    el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3))).toLocaleString('fr-FR') + suffix;
                    if (p < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            });
        }, { threshold: 0.4 });
        counters.forEach(function (el) { io.observe(el); });
    }

    /* Header : ombre au défilement + lien actif selon la section visible */
    function initHeader() {
        var header = document.getElementById('vt-header');
        var top = document.getElementById('vt-top');
        var links = document.querySelectorAll('.vt-nav__link[data-spy]');
        var sections = Array.prototype.map.call(links, function (l) { return document.getElementById(l.dataset.spy); });
        var ticking = false;

        function update() {
            var y = window.scrollY;
            if (header) header.classList.toggle('is-scrolled', y > 8);
            if (top) top.classList.toggle('is-visible', y > 600);

            var current = null;
            sections.forEach(function (s, i) {
                if (s && s.getBoundingClientRect().top < 140) current = i;
            });
            links.forEach(function (l, i) { l.classList.toggle('active', i === current); });
            ticking = false;
        }

        window.addEventListener('scroll', function () {
            if (!ticking) { ticking = true; requestAnimationFrame(update); }
        }, { passive: true });
        update();

        if (top) top.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });
    }

    /* Vidéo : lecture automatique SANS le son quand elle devient visible
       (les navigateurs refusent l'autoplay avec son), bouton « Activer le son ».
       Pas d'autoplay en mode économie de données, réseau 2G ou animations réduites. */
    function initVideo() {
        var box = document.getElementById('vtVideo');
        if (!box) return;
        var video = box.querySelector('video');
        var playBtn = box.querySelector('.vt-video__play');
        var soundBtn = box.querySelector('.vt-video__sound');
        var userPaused = false; // le visiteur a mis en pause : on ne relance plus automatiquement

        var conn = navigator.connection || {};
        var autoplayAllowed = !reduceMotion && !conn.saveData && !/(^|-)2g$/.test(conn.effectiveType || '');

        function play(withSound) {
            if (withSound) {
                video.muted = false;
                video.controls = true;
                box.classList.add('has-sound');
            }
            box.classList.add('is-playing');
            var p = video.play();
            if (p && p.catch) {
                p.catch(function () {
                    // Lecture refusée par le navigateur : on revient au gros bouton « Lecture »
                    box.classList.remove('is-playing');
                });
            }
        }

        // Gros bouton (si pas d'autoplay) : lecture avec le son, l'utilisateur l'a demandé
        playBtn.addEventListener('click', function () { userPaused = false; play(true); });

        // Activer le son pendant la lecture automatique
        soundBtn.addEventListener('click', function () {
            video.currentTime = 0; // on repart du début pour entendre le film en entier
            play(true);
        });

        video.addEventListener('play', function () { box.classList.add('is-playing'); });
        video.addEventListener('pause', function () {
            // Pause demandée par le visiteur (commandes visibles) : ne pas relancer à la volée
            if (video.controls && document.visibilityState === 'visible' && box.dataset.inView === '1') userPaused = true;
        });

        if (!('IntersectionObserver' in window)) return;
        new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                box.dataset.inView = e.isIntersecting ? '1' : '0';
                if (e.isIntersecting) {
                    if (autoplayAllowed && !userPaused && video.paused) play(!video.muted);
                } else if (!video.paused) {
                    video.pause(); // hors écran : pause (et économie de données)
                }
            });
        }, { threshold: 0.5 }).observe(box);
    }

    /* Formulaire de contact : validation + spinner + un seul envoi */
    function initContactForm() {
        var form = document.getElementById('vtContactForm');
        if (!form) return;
        var btn = document.getElementById('vtContactBtn');
        var sent = false;
        form.addEventListener('submit', function (e) {
            if (sent) { e.preventDefault(); return; }
            if (!form.checkValidity()) {
                e.preventDefault();
                form.classList.add('was-validated');
                var first = form.querySelector(':invalid');
                if (first) first.focus();
                return;
            }
            sent = true;
            btn.disabled = true;
            btn.classList.add('is-busy');
        });
        window.addEventListener('pageshow', function (e) {
            if (e.persisted) { sent = false; btn.disabled = false; btn.classList.remove('is-busy'); }
        });
    }

    /* Messages (toasts) : disparaissent seuls */
    function initToasts() {
        document.querySelectorAll('.vt-toast').forEach(function (t, i) {
            setTimeout(function () { t.classList.add('is-leaving'); setTimeout(function () { t.remove(); }, 300); }, 6000 + i * 500);
        });
        // Retour sur la section contact après l'envoi du formulaire
        if (document.querySelector('.vt-toast, .vt-form__errors') && document.getElementById('contact')) {
            document.getElementById('contact').scrollIntoView({ block: 'start' });
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        initReveal();
        initCounters();
        initHeader();
        initVideo();
        initContactForm();
        initToasts();
    });
})();
