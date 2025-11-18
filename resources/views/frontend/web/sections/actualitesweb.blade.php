 @push('styles')
     <style>
         .news-section {
             background: linear-gradient(135deg, #f8f9ff, #ffffff);
         }

         .news-card {
             background: white;
             border-radius: 20px;
             overflow: hidden;
             box-shadow: 0 10px 40px rgba(40, 64, 147, 0.1);
             transition: all 0.4s ease;
             height: 100%;
         }

         .news-card:hover {
             transform: translateY(-10px);
             box-shadow: 0 20px 60px rgba(40, 64, 147, 0.2);
         }

         .news-image {
             height: 200px;
             background: linear-gradient(135deg, var(--color-accent), var(--color-secondary));
             position: relative;
         }

         .news-date {
             position: absolute;
             top: 15px;
             right: 15px;
             background: rgba(255, 255, 255, 0.9);
             padding: 8px 15px;
             border-radius: 25px;
             font-size: 0.9rem;
             font-weight: 600;
             color: var(--color-primary);
         }

         .news-content {
             padding: 25px;
         }

         .news-title {
             font-size: 1.3rem;
             font-weight: 700;
             color: var(--color-primary);
             margin-bottom: 15px;
         }
     </style>
 @endpush





 <section id="news" class="section news-section">
     <div class="container">
         <h2 class="section-title" data-aos="fade-up">Actualités</h2>
         <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
             Restez informé de nos dernières nouvelles et développements
         </p>

         <div class="row g-4">
             <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                 <div class="news-card">
                     <div class="news-image">
                         <div class="news-date">15 Nov 2024</div>
                     </div>
                     <div class="news-content">
                         <h5 class="news-title">Expansion de nos installations</h5>
                         <p>FOANI annonce l'extension de ses capacités de production avec l'ouverture d'un nouveau site
                             moderne.</p>
                         <a href="#" class="btn btn-outline-primary btn-sm">Lire la suite</a>
                     </div>
                 </div>
             </div>
             <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                 <div class="news-card">
                     <div class="news-image">
                         <div class="news-date">10 Nov 2024</div>
                     </div>
                     <div class="news-content">
                         <h5 class="news-title">Certification ISO obtenue</h5>
                         <p>Nous sommes fiers d'annoncer l'obtention de notre certification ISO pour la qualité de nos
                             processus.</p>
                         <a href="#" class="btn btn-outline-primary btn-sm">Lire la suite</a>
                     </div>
                 </div>
             </div>
             <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                 <div class="news-card">
                     <div class="news-image">
                         <div class="news-date">5 Nov 2024</div>
                     </div>
                     <div class="news-content">
                         <h5 class="news-title">Nouveau partenariat stratégique</h5>
                         <p>FOANI signe un partenariat important pour renforcer sa présence sur le marché régional.</p>
                         <a href="#" class="btn btn-outline-primary btn-sm">Lire la suite</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
