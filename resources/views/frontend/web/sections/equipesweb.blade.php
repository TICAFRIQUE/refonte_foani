 @push('styles')
     <style>
         .team-card {
             background: white;
             border-radius: 20px;
             padding: 30px;
             text-align: center;
             box-shadow: 0 10px 40px rgba(40, 64, 147, 0.1);
             transition: all 0.4s ease;
             height: 100%;
         }

         .team-card:hover {
             transform: translateY(-10px);
             box-shadow: 0 20px 60px rgba(40, 64, 147, 0.2);
         }

         .team-photo {
             width: 120px;
             height: 120px;
             border-radius: 50%;
             margin: 0 auto 20px;
             background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
             border: 5px solid rgba(40, 64, 147, 0.1);
             transition: all 0.3s ease;
         }

         .team-card:hover .team-photo {
             transform: scale(1.1);
             border-color: var(--color-primary);
         }

         .team-name {
             font-size: 1.3rem;
             font-weight: 700;
             color: var(--color-primary);
             margin-bottom: 10px;
         }

         .team-role {
             color: var(--color-text-light);
             font-weight: 600;
             margin-bottom: 20px;
         }
     </style>
 @endpush



 <section id="team" class="section">
     <div class="container">
         <h2 class="section-title" data-aos="fade-up">Notre Équipe</h2>
         <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
             Des professionnels passionnés au service de l'excellence
         </p>

         <div class="row g-4">
             <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                 <div class="team-card">
                     <div class="team-photo"></div>
                     <h5 class="team-name">Jean KOUADIO</h5>
                     <p class="team-role">Directeur Général</p>
                     <p>Leadership visionnaire avec plus de 20 ans d'expérience dans l'industrie alimentaire.</p>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                 <div class="team-card">
                     <div class="team-photo"></div>
                     <h5 class="team-name">Marie ASSI</h5>
                     <p class="team-role">Directrice Qualité</p>
                     <p>Experte en contrôle qualité et certification, garante de nos standards d'excellence.</p>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                 <div class="team-card">
                     <div class="team-photo"></div>
                     <h5 class="team-name">Paul N'GUESSAN</h5>
                     <p class="team-role">Responsable Production</p>
                     <p>Spécialiste en optimisation des processus de production et innovation technologique.</p>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                 <div class="team-card">
                     <div class="team-photo"></div>
                     <h5 class="team-name">Sophie KONE</h5>
                     <p class="team-role">Directrice Commerciale</p>
                     <p>Développement commercial et relations clients, architecte de notre croissance.</p>
                 </div>
             </div>
         </div>
     </div>
 </section>
