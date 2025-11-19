  @push('styles')
      <style>
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

  <section class="section stats-section">
      <div class="container">
          <div class="row">
              <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                  <div class="stat-item">
                      <div class="stat-number" data-target="50">0</div>
                      <div class="stat-label">Années d'expérience</div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                  <div class="stat-item">
                      <div class="stat-number" data-target="5000">0</div>
                      <div class="stat-label">Clients satisfaits</div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                  <div class="stat-item">
                      <div class="stat-number" data-target="250">0</div>
                      <div class="stat-label">Employés dévoués</div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                  <div class="stat-item">
                      <div class="stat-number" data-target="100">0</div>
                      <div class="stat-label">Produits de qualité</div>
                  </div>
              </div>
          </div>
      </div>
  </section>
