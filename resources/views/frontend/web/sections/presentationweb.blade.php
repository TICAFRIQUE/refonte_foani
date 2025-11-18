   @push('styles')
       <style>
           .about-section {
               padding: 120px 0;
               background: linear-gradient(135deg, #f8f9ff, #ffffff);
           }

           .about-content {
               display: grid;
               grid-template-columns: 1fr 1fr;
               gap: 60px;
               align-items: center;
               margin-top: 60px;
           }

           .about-text h3 {
               color: var(--color-primary);
               font-size: 2rem;
               font-weight: 700;
               margin-bottom: 25px;
               position: relative;
           }

           .about-text h3::after {
               content: '';
               position: absolute;
               bottom: -8px;
               left: 0;
               width: 60px;
               height: 3px;
               background: var(--color-secondary);
               border-radius: 2px;
           }

           .about-text p {
               font-size: 1.1rem;
               line-height: 1.8;
               margin-bottom: 20px;
               color: #555;
               text-align: justify;
           }

           .about-image {
               position: relative;
               border-radius: 20px;
               overflow: hidden;
               box-shadow: 0 20px 60px rgba(40, 64, 147, 0.2);
           }

           .about-image img {
               width: 100%;
               height: 400px;
               object-fit: cover;
               transition: transform 0.4s ease;
           }

           .about-image:hover img {
               transform: scale(1.05);
           }

           .about-image::before {
               content: '';
               position: absolute;
               top: 0;
               left: 0;
               right: 0;
               bottom: 0;
               background: linear-gradient(135deg,
                       rgba(40, 64, 147, 0.1) 0%,
                       rgba(108, 122, 224, 0.05) 100%);
               z-index: 1;
           }

           @media (max-width: 768px) {
               .about-content {
                   grid-template-columns: 1fr;
                   gap: 40px;
               }

               .carousel-buttons {
                   flex-direction: column;
                   align-items: center;
               }

               .btn-hero,
               .btn-hero-outline {
                   width: 250px;
               }
           }
       </style>
   @endpush



   <section id="about" class="about-section">
       <div class="container">
           <h2 class="section-title" data-aos="fade-up">À Propos de FOANI</h2>
           <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
               Une entreprise familiale devenue leader dans l'industrie avicole
           </p>

           <div class="about-content">
               <div class="about-text" data-aos="fade-right" data-aos-delay="200">
                   <h3>Notre Histoire</h3>
                   <p>Fondée en 2008, FOANI a commencé comme une petite entreprise familiale avec une vision claire :
                       révolutionner l'industrie avicole en Côte d'Ivoire. Grâce à notre engagement envers l'excellence
                       et l'innovation, nous sommes devenus l'un des leaders du marché.</p>

                   <p>Aujourd'hui, nous sommes fiers de servir plus de 5000 clients à travers le pays, en maintenant les
                       plus hauts standards de qualité et en respectant notre engagement envers le développement
                       durable. Notre mission est de fournir des produits avicoles de qualité premium tout en respectant
                       l'environnement et en soutenant le développement économique local.</p>

                   <p>Nous nous engageons à être un partenaire de confiance pour nos clients et nos communautés, en
                       offrant des solutions innovantes et durables dans l'industrie alimentaire.</p>
               </div>

               <div class="about-image" data-aos="fade-left" data-aos-delay="300">
                   <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                       alt="FOANI - Notre entreprise">
               </div>
           </div>
       </div>
   </section>
