{{-- Vidéo de présentation, mise en avant juste après la bannière.
     Rien n'est téléchargé avant le clic sur « Lecture » (fichier lourd). --}}
@php
    // Affiche : une autre bannière que celle affichée juste au-dessus
    $posterSlider = $sliders->get(1) ?? $sliders->first();
    $poster = $posterSlider?->getFirstMediaUrl('image', 'large') ?: asset('front/images/logoweb.png');
@endphp
<section class="vt-showcase" id="video">
    <div class="container">
        <div class="vt-head vt-head--light reveal">
            <span class="vt-eyebrow vt-eyebrow--yellow">En images</span>
            <h2 class="vt-title">Découvrez l'univers FOANI</h2>
            <p>Plongez au cœur de nos installations et de notre engagement pour une volaille de qualité,
                élevée avec passion en Côte d'Ivoire.</p>
        </div>

        <div class="vt-video vt-video--hero reveal" id="vtVideo" style="--d:.1s">
            {{-- Lecture automatique sans le son quand la vidéo devient visible (règle des navigateurs) --}}
            <video preload="none" muted loop playsinline poster="{{ $poster }}" aria-label="Vidéo de présentation FOANI">
                <source src="{{ asset('video/spot_foani.mp4') }}" type="video/mp4">
                Votre navigateur ne lit pas les vidéos.
            </video>
            <button type="button" class="vt-video__play" aria-label="Lire la vidéo de présentation">
                <span><i class="bi bi-play-fill"></i></span>
                <em>Regarder notre film</em>
            </button>
            <button type="button" class="vt-video__sound" aria-label="Activer le son de la vidéo">
                <i class="bi bi-volume-mute-fill"></i><span>Activer le son</span>
            </button>
        </div>

        <ul class="vt-showcase__points reveal" style="--d:.2s">
            <li><i class="bi bi-buildings-fill"></i> Des installations modernes</li>
            <li><i class="bi bi-people-fill"></i> Des équipes passionnées</li>
            <li><i class="bi bi-egg-fill"></i> Des produits frais tous les jours</li>
        </ul>
    </div>
</section>
