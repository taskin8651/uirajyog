@extends('custom.master')

@section('content')


@php 
 $siteSetting = App\Models\SiteSetting::first();
@endphp

<!-- HERO (Premium + Product Slider) -->
<!-- HERO SECTION -->

<!-- HERO (Premium + Product Slider) -->
<section id="home" class="hero hero-premium section-pad">
  <div class="hero-bg"></div>

  <div class="container position-relative">
    <div class="row align-items-center g-5">

      <!-- LEFT CONTENT -->
      <div class="col-lg-6">
        <div class="hero-kicker">
          <span class="badge badge-soft rounded-pill px-3 py-2">
            <i class="bi bi-leaf me-1"></i> Green Today for a Better Tomorrow
          </span>
        </div>

        <h1 class="hero-title fw-bold mb-3">
          Eco-Friendly <span class="text-brand">Home</span> & <span class="text-brand">Personal</span> Care
          <span class="d-block">Products That Perform.</span>
        </h1>

        <p class="hero-sub text-muted mb-4">
          Research-backed formulations, safer chemistry, and everyday performance — built for modern Indian homes.
        </p>

        <div class="d-flex flex-wrap gap-2">
          <a href="#products" class="btn btn-brand btn-lg hero-btn">
            <i class="bi bi-bag"></i> Explore Products
          </a>
          <a href="#partner" class="btn btn-outline-dark btn-lg hero-btn-outline">
            <i class="bi bi-people"></i> Become a Distributor
          </a>
        </div>

        <!-- Trust strip -->
        <div class="hero-trust mt-4">
          <div class="hero-trust-item">
            <i class="bi bi-shield-check"></i>
            <div>
              <div class="fw-bold">Certified Quality</div>
              <div class="small text-muted">GMP & ISO standards</div>
            </div>
          </div>

          <div class="hero-trust-divider"></div>

          <div class="hero-trust-item">
            <i class="bi bi-droplet-half"></i>
            <div>
              <div class="fw-bold">Non-Toxic Focus</div>
              <div class="small text-muted">Skin & fabric friendly</div>
            </div>
          </div>

          <div class="hero-trust-divider d-none d-md-block"></div>

          <div class="hero-trust-item d-none d-md-flex">
            <i class="bi bi-recycle"></i>
            <div>
              <div class="fw-bold">Go Green</div>
              <div class="small text-muted">Eco-minded formulations</div>
            </div>
          </div>
        </div>

        <!-- Feature cards -->
        <div class="row mt-4 g-3">
          <div class="col-sm-4">
            <div class="hero-mini-card">
              <div class="hero-mini-icon"><i class="bi bi-heart-pulse"></i></div>
              <div class="fw-bold">Gentle</div>
              <div class="small text-muted">Daily safe usage</div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="hero-mini-card">
              <div class="hero-mini-icon"><i class="bi bi-stars"></i></div>
              <div class="fw-bold">Powerful</div>
              <div class="small text-muted">High performance</div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="hero-mini-card">
              <div class="hero-mini-icon"><i class="bi bi-graph-up-arrow"></i></div>
              <div class="fw-bold">Scalable</div>
              <div class="small text-muted">Distributor network</div>
            </div>
          </div>
        </div>
      </div>

      <!-- RIGHT: PRODUCT SLIDER -->
      <div class="col-lg-6">
        <div class="hero-slider-wrap soft-card shadow-soft">
          <div id="heroProductSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3500">

            <div class="carousel-inner rounded-xxl">

              <!-- Slide 1 -->
              <div class="carousel-item active">
                <div class="hero-slide">
                  <img src="assets/img/hero_one.png" class="d-block w-100 hero-slide-img" alt="Best Product 1">
                  <div class="hero-slide-overlay"></div>

                  <div class="hero-slide-caption">
                    <span class="hero-chip">Home Care</span>
                    <h5 class="fw-bold mb-1">Ultra White Laundry Soap</h5>
                    <p class="small mb-0 text-white-50">Brighter wash • Fabric friendly • Fresh finish</p>
                  </div>
                </div>
              </div>

              <!-- Slide 2 -->
              <div class="carousel-item">
                <div class="hero-slide">
                  <img src="assets/img/hero_two.png" class="d-block w-100 hero-slide-img" alt="Best Product 2">
                  <div class="hero-slide-overlay"></div>

                  <div class="hero-slide-caption">
                    <span class="hero-chip">Home Care</span>
                    <h5 class="fw-bold mb-1">Liquid Detergent (5X)</h5>
                    <p class="small mb-0 text-white-50">Deep clean • Low residue • Daily essential</p>
                  </div>
                </div>
              </div>

              <!-- Slide 3 -->
              <div class="carousel-item">
                <div class="hero-slide">
                  <img src="assets/img/hero_three.png" class="d-block w-100 hero-slide-img" alt="Best Product 3">
                  <div class="hero-slide-overlay"></div>

                  <div class="hero-slide-caption">
                    <span class="hero-chip">Personal Care</span>
                    <h5 class="fw-bold mb-1">Snaan Bathing Bar</h5>
                    <p class="small mb-0 text-white-50">Mild • Skin friendly • Family care</p>
                  </div>
                </div>
              </div>

            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroProductSlider" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#heroProductSlider" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>

            <!-- Dots -->
            <div class="carousel-indicators hero-dots">
              <button type="button" data-bs-target="#heroProductSlider" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#heroProductSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#heroProductSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

          </div>
        </div>

        <!-- Small quick stats -->
        <div class="row g-3 mt-3">
          <div class="col-6">
            <div class="hero-stat">
              <div class="hero-stat-num">GMP</div>
              <div class="hero-stat-text">Certified Unit</div>
            </div>
          </div>
          <div class="col-6">
            <div class="hero-stat">
              <div class="hero-stat-num">ISO</div>
              <div class="hero-stat-text">Quality Systems</div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>



@endsection