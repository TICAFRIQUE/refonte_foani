{{-- Nos valeurs --}}
<section id="values" class="vt-section vt-section--soft">
    <div class="container">
        <div class="vt-head reveal">
            <span class="vt-eyebrow">Ce qui nous guide</span>
            <h2 class="vt-title">Nos valeurs</h2>
            <p>Des principes qui guident notre travail au quotidien et notre engagement envers nos clients.</p>
        </div>

        <div class="row g-3 g-lg-4">
            @foreach ([
                ['bi-fire', 'Persévérance & passion', "Notre détermination et notre passion pour l'excellence nous poussent à surmonter tous les défis pour offrir des produits d'exception.", 'red'],
                ['bi-gear-fill', 'Professionnalisme & rigueur', "Une approche méthodique et des processus rigoureux à chaque étape de la production garantissent une qualité irréprochable.", 'blue'],
                ['bi-shield-fill-check', 'Intégrité', "L'honnêteté et la transparence sont les piliers de nos relations avec nos clients et partenaires.", 'yellow'],
                ['bi-heart-fill', 'Satisfaction des clients', "Votre satisfaction est notre priorité : un service personnalisé et des produits de qualité supérieure.", 'green'],
            ] as [$icone, $titre, $texte, $couleur])
                <div class="col-sm-6 col-lg-3">
                    <div class="vt-value vt-value--{{ $couleur }} reveal" style="--d: {{ $loop->index * 0.08 }}s">
                        <span class="vt-value__icon"><i class="bi {{ $icone }}"></i></span>
                        <h3>{{ $titre }}</h3>
                        <p>{{ $texte }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
