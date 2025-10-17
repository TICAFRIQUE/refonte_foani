{{-- filepath: resources/views/frontend/pages/contact.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Contact')

@section('content')

    <div class="container py-5">
        <h2 class="fw-bold mb-4 text-center" style="color:#2a6b2a;">Contactez-nous</h2>
        <div class="row g-4 justify-content-center">
            {{-- Bloc gauche : Formulaire de contact --}}
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h4 class="fw-bold mb-3" style="color:#2a6b2a;">Nos informations</h4>
                        <ul class="list-unstyled mb-3">
                            <li class="mb-2">
                                <i class="bi bi-geo-alt-fill text-success"></i>
                                Adresse : Cocody, Abidjan, Côte d’Ivoire
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-envelope-fill text-success"></i>
                                Email : contact@foani.ci
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-telephone-fill text-success"></i>
                                Téléphone : +225 07 07 07 07 07
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-clock-fill text-success"></i>
                                Horaires : Lun - Sam, 8h à 18h
                            </li>
                        </ul>
                        <div class="ratio ratio-16x9 rounded shadow-sm">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m24!1m8!1m3!1d7944.072134403755!2d-4.08265!3d5.411478!3m2!1i1024!2i768!4f13.1!4m13!3e2!4m5!1s0xfc1ed254fef80ad%3A0x85d06d09dc2a3996!2sFOANI%20Abidjan%20zone%20industrielle%20Yopougon%2C%20Yopougon%20Zone%20industrielle%2Ccit%C3%A9%20bel%20air%2C%20Abidjan!3m2!1d5.4117358!2d-4.0826283!4m5!1s0xfc194554cb2cd55%3A0x8e22d541a71f973!2sAbobo%2C%20Abidjan!3m2!1d5.432887099999999!2d-4.0388918!5e0!3m2!1sfr!2sci!4v1760580862579!5m2!1sfr!2sci"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Bloc droit : Informations et carte --}}
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="fw-bold mb-3" style="color:#2a6b2a;">Formulaire de contact</h4>
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nom & Prénoms <span class="text-danger">*</span></label>
                                <input type="text" name="nom_prenoms" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Objet <span class="text-danger">*</span></label>
                                <input type="text" name="objet" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Téléphone</label>
                                <input type="text" name="telephone" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Message <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control" rows="5" required></textarea>
                            </div>
                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-success px-4 fw-bold">
                                    <i class="bi bi-send"></i> Envoyer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
