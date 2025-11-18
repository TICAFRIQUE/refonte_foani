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
             padding: 30px;
         }

         .activity-title {
             font-size: 1.5rem;
             font-weight: 700;
             color: var(--color-primary);
             margin-bottom: 15px;
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
             <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                 <div class="activity-card">
                     <div class="activity-image">
                         <img src="https://images.unsplash.com/photo-1548550023-2bdb3c5beed7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                             alt="Aviculture">
                     </div>
                     <div class="activity-content">
                         <h4 class="activity-title">Aviculture</h4>
                         <p>Élevage moderne de volailles dans des conditions optimales respectant le bien-être animal et
                             les normes sanitaires.</p>
                     </div>
                 </div>
             </div>
             <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                 <div class="activity-card">
                     <div class="activity-image">
                         <img src="https://images.unsplash.com/photo-1506976785307-8732e854ad03?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                             alt="Production d'Œufs">
                     </div>
                     <div class="activity-content">
                         <h4 class="activity-title">Production d'Œufs</h4>
                         <p>Production d'œufs frais de qualité premium avec un contrôle qualité rigoureux à chaque
                             étape.</p>
                     </div>
                 </div>
             </div>
             <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                 <div class="activity-card">
                     <div class="activity-image">
                         <img src="https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                             alt="Distribution">
                     </div>
                     <div class="activity-content">
                         <h4 class="activity-title">Distribution</h4>
                         <p>Réseau de distribution efficace garantissant la fraîcheur de nos produits jusqu'au
                             consommateur final.</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
