 @push('styles')
     <style>
         .activity-card {
             background: white;
             border-radius: 20px;
             overflow: hidden;
             box-shadow: 0 10px 40px rgba(40, 64, 147, 0.1);
             transition: all 0.4s ease;
             height: 100%;
         }

         .activity-card:hover {
             transform: translateY(-10px);
             box-shadow: 0 20px 60px rgba(40, 64, 147, 0.2);
         }

         .activity-image {
             height: 250px;
             background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
             position: relative;
             overflow: hidden;
         }

         .activity-image img {
             width: 100%;
             height: 100%;
             object-fit: cover;
             transition: transform 0.4s ease;
         }

         .activity-card:hover .activity-image img {
             transform: scale(1.1);
         }

         .activity-content {
             padding: 20px;
         }

         .activity-title {
             font-size: 1.5rem;
             font-weight: 700;
             color: var(--color-primary);
             margin-bottom: 15px;
         }

         .btn-plus {
             display: inline-block;
             padding: 10px 20px;
             background-color: var(--color-primary);
             color: #fff;
             border-radius: 50px;
             text-decoration: none;
             font-weight: 600;
             transition: background-color 0.3s ease;

         }

         .btn-plus:hover {
             background-color: var(--color-secondary);
         }
     </style>
 @endpush



 <section id="activities" class="section">
     <div class="container">
         <h2 class="section-title" data-aos="fade-up">Nos Activités</h2>
         <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
             Découvrez l'étendue de notre expertise dans différents domaines
         </p>

         <div class="row g-4">

             @foreach ($activites as $item)
                 <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                     <div class="activity-card">
                         <div class="activity-image">
                             @if ($item->getFirstMediaUrl('image'))
                                 <img src="{{ $item->getFirstMediaUrl('image') }}" alt="{{ $item->libelle }}"
                                     class="activite-image" loading="lazy">
                             @else
                                 <img src="{{ asset('front/images/default.jpg') }}" alt="Activité par défaut"
                                     class="activite-image" loading="lazy">
                             @endif

                         </div>
                         <div class="activity-content">
                             <h4 class="activity-title">{{ $item->libelle }}</h4>
                             <p>{!! Str::limit(strip_tags($item->description), 150, '...') !!}</p>

                         </div>
                         <div class="my-3 text-center">
                             <a href="{{ route('page.show', $item->slug) }}" class="btn-plus">En savoir plus</a>
                         </div>
                     </div>
                 </div>
             @endforeach

         </div>
     </div>
 </section>
