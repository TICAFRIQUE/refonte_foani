  @push('styles')
      <style>
          .values-section {
              background: linear-gradient(135deg, #f8f9ff, #ffffff);
          }

          .value-card {
              background: white;
              border-radius: 25px;
              padding: 40px 30px;
              text-align: center;
              box-shadow: 0 10px 40px rgba(40, 64, 147, 0.1);
              transition: all 0.4s ease;
              border: 1px solid rgba(40, 64, 147, 0.05);
              height: 100%;
          }

          .value-card:hover {
              transform: translateY(-15px);
              box-shadow: 0 25px 60px rgba(40, 64, 147, 0.2);
              border-color: var(--color-primary);
          }

          .value-icon {
              width: 80px;
              height: 80px;
              background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
              border-radius: 50%;
              display: flex;
              align-items: center;
              justify-content: center;
              margin: 0 auto 25px;
              color: white;
              font-size: 2rem;
              box-shadow: 0 8px 25px rgba(40, 64, 147, 0.3);
              transition: all 0.3s ease;
          }

          .value-card:hover .value-icon {
              transform: scale(1.1) rotate(10deg);
          }

          /* STATISTIQUES */
          .stats-section {
              background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
              color: white;
          }

          .stat-item {
              text-align: center;
              padding: 30px 20px;
          }

          .stat-number {
              font-size: 4rem;
              font-weight: 900;
              margin-bottom: 10px;
              color: white;
              text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
          }

          .stat-label {
              font-size: 1.1rem;
              font-weight: 600;
              color: rgba(255, 255, 255, 0.9);
              text-transform: uppercase;
              letter-spacing: 1px;
          }
      </style>
  @endpush



  <section id="values" class="section values-section">
      <div class="container">
          <h2 class="section-title" data-aos="fade-up">Nos Valeurs</h2>
          <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
              Des principes fondamentaux qui guident notre action quotidienne
          </p>

          <div class="row g-4">
              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                  <div class="value-card">
                      <div class="value-icon">
                          <i class="bi bi-shield-check"></i>
                      </div>
                      <h4>Qualité</h4>
                      <p>Nous nous engageons à maintenir les plus hauts standards de qualité dans tous nos produits et
                          services.</p>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                  <div class="value-card">
                      <div class="value-icon">
                          <i class="bi bi-lightbulb"></i>
                      </div>
                      <h4>Innovation</h4>
                      <p>L'innovation est au cœur de notre démarche pour répondre aux besoins évolutifs de nos clients.
                      </p>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                  <div class="value-card">
                      <div class="value-icon">
                          <i class="bi bi-people"></i>
                      </div>
                      <h4>Confiance</h4>
                      <p>Nous bâtissons des relations durables basées sur la transparence et la confiance mutuelle.</p>
                  </div>
              </div>
          </div>
      </div>
  </section>
