{{-- Contact : coordonnées + formulaire (enregistré dans l'admin > Messages) + carte --}}
@php
    $email = $data_parametre?->email1 ?: 'info@foani.ci';
    $tels = collect([$data_parametre?->contact1, $data_parametre?->contact2, $data_parametre?->contact3])->filter();
@endphp
<section id="contact" class="vt-section vt-section--soft">
    <div class="container">
        <div class="vt-head reveal">
            <span class="vt-eyebrow">Parlons-en</span>
            <h2 class="vt-title">Contactez-nous</h2>
            <p>Une question, un partenariat, une commande en gros ? Notre équipe vous répond rapidement.</p>
        </div>

        <div class="row g-4">
            {{-- Coordonnées --}}
            <div class="col-lg-5">
                <div class="vt-contact-info reveal">
                    @if ($data_parametre?->localisation)
                        <div class="vt-cinfo">
                            <span class="vt-cinfo__icon"><i class="bi bi-geo-alt-fill"></i></span>
                            <div><small>Adresse</small><p>{{ $data_parametre->localisation }}</p></div>
                        </div>
                    @endif
                    @if ($tels->isNotEmpty())
                        <div class="vt-cinfo">
                            <span class="vt-cinfo__icon"><i class="bi bi-telephone-fill"></i></span>
                            <div><small>Téléphone</small>
                                <p>@foreach ($tels as $tel)<a href="tel:{{ preg_replace('/\s+/', '', $tel) }}">{{ $tel }}</a>@if (!$loop->last) · @endif @endforeach</p>
                            </div>
                        </div>
                    @endif
                    <div class="vt-cinfo">
                        <span class="vt-cinfo__icon"><i class="bi bi-envelope-fill"></i></span>
                        <div><small>Email</small><p><a href="mailto:{{ $email }}">{{ $email }}</a></p></div>
                    </div>
                    <div class="vt-cinfo">
                        <span class="vt-cinfo__icon"><i class="bi bi-clock-fill"></i></span>
                        <div><small>Horaires</small><p>Lun - Ven : 9h00 - 16h00 · Sam : 9h00 - 12h00 · Dim : fermé</p></div>
                    </div>
                    @if ($data_parametre?->contact2)
                        <a href="https://wa.me/225{{ $data_parametre->contact2 }}" target="_blank" rel="noopener" class="vt-btn vt-btn--wa w-100 justify-content-center mt-2">
                            <i class="bi bi-whatsapp"></i> Écrire sur WhatsApp
                        </a>
                    @endif
                </div>
            </div>

            {{-- Formulaire --}}
            <div class="col-lg-7">
                <form action="{{ route('contact.store') }}" method="POST" class="vt-form reveal" style="--d:.1s" id="vtContactForm" novalidate>
                    @csrf
                    <h3><i class="bi bi-chat-dots-fill"></i> Envoyez-nous un message</h3>

                    @if ($errors->any())
                        <div class="vt-form__errors" role="alert">
                            @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                        </div>
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="c-nom">Nom &amp; prénoms *</label>
                            <input type="text" id="c-nom" name="nom_prenoms" value="{{ old('nom_prenoms') }}" autocomplete="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="c-tel">Téléphone *</label>
                            <input type="tel" id="c-tel" name="telephone" value="{{ old('telephone') }}" autocomplete="tel" inputmode="tel" maxlength="20" required>
                        </div>
                        <div class="col-md-6">
                            <label for="c-email">Email *</label>
                            <input type="email" id="c-email" name="email" value="{{ old('email') }}" autocomplete="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="c-objet">Objet *</label>
                            <input type="text" id="c-objet" name="objet" value="{{ old('objet') }}" placeholder="Ex. commande en gros, partenariat…" required>
                        </div>
                        <div class="col-12">
                            <label for="c-msg">Message *</label>
                            <textarea id="c-msg" name="message" rows="4" required>{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="vt-btn vt-btn--primary mt-3" id="vtContactBtn">
                        <span class="lbl-idle"><i class="bi bi-send-fill"></i> Envoyer le message</span>
                        <span class="lbl-busy"><span class="spinner-border spinner-border-sm"></span> Envoi en cours…</span>
                    </button>
                </form>
            </div>

            {{-- Carte : chargée seulement quand elle devient visible --}}
            <div class="col-12">
                <div class="vt-map reveal">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m24!1m8!1m3!1d7944.072134403755!2d-4.08265!3d5.411478!3m2!1i1024!2i768!4f13.1!4m13!3e2!4m5!1s0xfc1ed254fef80ad%3A0x85d06d09dc2a3996!2sFOANI%20Abidjan%20zone%20industrielle%20Yopougon%2C%20Yopougon%20Zone%20industrielle%2Ccit%C3%A9%20bel%20air%2C%20Abidjan!3m2!1d5.4117358!2d-4.0826283!4m5!1s0xfc194554cb2cd55%3A0x8e22d541a71f973!2sAbobo%2C%20Abidjan!3m2!1d5.432887099999999!2d-4.0388918!5e0!3m2!1sfr!2sci!4v1760580862579!5m2!1sfr!2sci" title="Localisation de FOANI" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                    @if ($data_parametre?->localisation)
                        <a href="https://maps.google.com/?q={{ urlencode($data_parametre->localisation) }}" target="_blank" rel="noopener" class="vt-map__btn">
                            <i class="bi bi-sign-turn-right-fill"></i> Itinéraire
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
