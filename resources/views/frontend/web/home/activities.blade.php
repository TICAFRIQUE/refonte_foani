{{-- Activités (pages de la catégorie « activites ») --}}
@if ($activites->isNotEmpty())
    <section id="activities" class="vt-section">
        <div class="container">
            <div class="vt-head vt-head--split reveal">
                <div>
                    <span class="vt-eyebrow">Ce que nous faisons</span>
                    <h2 class="vt-title">Nos activités</h2>
                </div>
                <p>Des métiers complémentaires au service des éleveurs, des revendeurs et des familles.</p>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach ($activites as $item)
                    @php $img = $item->getFirstMediaUrl('image', 'large') ?: asset('front/images/default.jpg'); @endphp
                    <div class="col-md-6 col-lg-{{ $activites->count() >= 3 ? 4 : 6 }}">
                        <article class="vt-activity reveal" style="--d: {{ $loop->index * 0.08 }}s">
                            <a href="{{ route('page.show', $item->slug) }}" class="vt-activity__media" tabindex="-1" aria-hidden="true">
                                <img src="{{ $img }}" alt="" loading="lazy" decoding="async">
                                <span class="vt-activity__num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            </a>
                            <div class="vt-activity__body">
                                <h3>{{ Str::ucfirst(Str::lower($item->libelle)) }}</h3>
                                <p>{{ Str::limit(trim(html_entity_decode(strip_tags($item->description))), 170) }}</p>
                                <a href="{{ route('page.show', $item->slug) }}" class="vt-link">En savoir plus <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
