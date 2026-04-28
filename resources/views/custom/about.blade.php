@extends('custom.master')

@section('content')



  <!-- ABOUT PAGE HERO -->
<section class="about-page-hero section-pad">
    <div class="about-page-hero-bg"></div>

    <div class="container position-relative">
        <div class="row align-items-center g-5">

            <div class="col-lg-7">
                <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
                    <i class="bi bi-info-circle me-1"></i>
                    About Raj Yog Go Green
                </span>

                <h1 class="fw-bold display-6 mb-3">
                    {!! $aboutSection->title ?? 'Built on <span class="text-brand">Quality</span>, <span class="text-brand">Safety</span> & Responsibility' !!}
                </h1>

                <p class="text-muted mb-4">
                    {{ $aboutSection->short_description ?? 'Raj Yog delivers eco-conscious home & personal care products with structured manufacturing, quality checks, and a Go Green mindset — made for modern Indian homes.' }}
                </p>

                @if($aboutSection && $aboutSection->description)
                    <p class="text-muted mb-4">
                        {!! nl2br(e($aboutSection->description)) !!}
                    </p>
                @endif

                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ url('/products') }}" class="btn btn-brand btn-lg">
                        <i class="bi bi-box-seam"></i> Explore Products
                    </a>

                    <a href="{{ url('/#contact') }}" class="btn btn-outline-dark btn-lg">
                        <i class="bi bi-people"></i> Partner With Us
                    </a>
                </div>

                <div class="about-hero-trust mt-4">
                    <div class="about-hero-trust-item">
                        <i class="bi bi-patch-check"></i>
                        <div>
                            <div class="fw-bold">GMP</div>
                            <div class="small text-muted">Certified manufacturing</div>
                        </div>
                    </div>

                    <div class="about-hero-trust-item">
                        <i class="bi bi-award"></i>
                        <div>
                            <div class="fw-bold">ISO</div>
                            <div class="small text-muted">Quality systems</div>
                        </div>
                    </div>

                    <div class="about-hero-trust-item">
                        <i class="bi bi-recycle"></i>
                        <div>
                            <div class="fw-bold">Go Green</div>
                            <div class="small text-muted">Eco-first thinking</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="about-hero-media">
                    @if($aboutSection && $aboutSection->image)
                        <img
                            src="{{ $aboutSection->image->getUrl() }}"
                            class="about-hero-img"
                            alt="{{ strip_tags($aboutSection->title ?? 'About Rajyog Green') }}"
                        >
                    @else
                        <img
                            src="{{ asset('assets/img/about-hero.jpg') }}"
                            class="about-hero-img"
                            alt="About Rajyog Green"
                        >
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

  <!-- OUR STORY -->
  <section class="section-pad bg-white">
    <div class="container">
      <div class="row align-items-center g-5">

        <div class="col-lg-6">
          <div class="about-story-media">
            <img
              src="https://dummyimage.com/1200x900/f00203/ffffff&text=Story+Image+1200x900"
              class="about-story-img"
              alt="Story Image 1200x900"
            />

            <div class="about-story-badge">
              <i class="bi bi-shield-check"></i>
              <div>
                <div class="fw-bold">Quality First</div>
                <div class="small text-muted">Checks at every stage</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
            <i class="bi bi-stars me-1"></i> Our Story
          </span>

          <h2 class="fw-bold mb-3">Designed for Everyday Use</h2>
          <p class="text-muted mb-4">
            We build products that people use daily — detergents, soaps, cleaning solutions and more.
            Our focus is performance-first, backed by structured processes and a responsible approach.
          </p>

          <div class="row g-3">
            <div class="col-sm-6">
              <div class="about-box">
                <div class="about-box-icon"><i class="bi bi-building-check"></i></div>
                <div>
                  <div class="fw-bold mb-1">Manufacturing</div>
                  <div class="small text-muted">Consistency and batch control.</div>
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="about-box">
                <div class="about-box-icon"><i class="bi bi-flask"></i></div>
                <div>
                  <div class="fw-bold mb-1">R&amp;D Focus</div>
                  <div class="small text-muted">Improving performance continuously.</div>
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="about-box">
                <div class="about-box-icon"><i class="bi bi-heart-pulse"></i></div>
                <div>
                  <div class="fw-bold mb-1">Non-Toxic Focus</div>
                  <div class="small text-muted">Gentle choices where possible.</div>
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="about-box">
                <div class="about-box-icon"><i class="bi bi-recycle"></i></div>
                <div>
                  <div class="fw-bold mb-1">Go Green</div>
                  <div class="small text-muted">Eco-conscious mindset.</div>
                </div>
              </div>
            </div>
          </div>

          <div class="row g-3 mt-4">
            <div class="col-6">
              <div class="about-stat">
                <div class="about-stat-num">100+</div>
                <div class="about-stat-text">Distribution Points</div>
              </div>
            </div>
            <div class="col-6">
              <div class="about-stat">
                <div class="about-stat-num">50+</div>
                <div class="about-stat-text">Products &amp; Variants</div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </section>

  <!-- VALUES -->
  <section class="section-pad bg-soft">
    <div class="container">
      <div class="text-center mb-5">
        <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
          <i class="bi bi-gem me-1"></i> Our Values
        </span>
        <h2 class="fw-bold mb-1">What We Stand For</h2>
        <p class="text-muted mb-0">Principles that guide our products and partnerships.</p>
      </div>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="value-card h-100">
            <div class="value-icon"><i class="bi bi-shield-check"></i></div>
            <h5 class="fw-bold mb-2">Quality</h5>
            <p class="text-muted small mb-0">Structured checks and consistency in every batch.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="value-card h-100">
            <div class="value-icon"><i class="bi bi-flask"></i></div>
            <h5 class="fw-bold mb-2">Innovation</h5>
            <p class="text-muted small mb-0">Continuous improvements in formulations & usability.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="value-card h-100">
            <div class="value-icon"><i class="bi bi-leaf"></i></div>
            <h5 class="fw-bold mb-2">Responsibility</h5>
            <p class="text-muted small mb-0">Eco-conscious thinking aligned with Go Green.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PROCESS -->
  <section class="section-pad bg-white">
    <div class="container">
      <div class="row align-items-center g-5">

        <div class="col-lg-6">
          <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
            <i class="bi bi-gear me-1"></i> Our Process
          </span>
          <h2 class="fw-bold mb-3">Quality Checks at Every Stage</h2>
          <p class="text-muted mb-4">
            Our manufacturing framework supports consistency, safety and reliable product performance.
          </p>

          <div class="about-process-steps">
            <div class="process-step">
              <div class="process-icon"><i class="bi bi-inboxes"></i></div>
              <div>
                <div class="fw-bold">Incoming Material Checks</div>
                <div class="small text-muted">Verification before production begins.</div>
              </div>
            </div>

            <div class="process-step">
              <div class="process-icon"><i class="bi bi-activity"></i></div>
              <div>
                <div class="fw-bold">In-Process Monitoring</div>
                <div class="small text-muted">Batch-wise monitoring & uniformity.</div>
              </div>
            </div>

            <div class="process-step">
              <div class="process-icon"><i class="bi bi-patch-check"></i></div>
              <div>
                <div class="fw-bold">Final Quality Assurance</div>
                <div class="small text-muted">Inspection and compliance checks.</div>
              </div>
            </div>
          </div>

          <div class="mt-4 d-flex gap-2 flex-wrap">
            <a href="index.html#mfg" class="btn btn-brand btn-lg">
              <i class="bi bi-building"></i> Explore Manufacturing
            </a>
            <a href="index.html#certs" class="btn btn-outline-dark btn-lg">
              <i class="bi bi-patch-check"></i> View Certifications
            </a>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="about-process-media">
            <img
              src="https://dummyimage.com/1200x900/7d5de1/ffffff&text=Process+Image+1200x900"
              class="about-process-img"
              alt="Process Image 1200x900"
            />
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section-pad bg-soft">
    <div class="container">
      <div class="about-cta-box">
        <div>
          <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
            <i class="bi bi-people me-1"></i> Partner With Us
          </span>
          <h3 class="fw-bold mb-2">Want to Become a Distributor?</h3>
          <p class="text-muted mb-0">Join our network and grow with a quality-driven Go Green brand.</p>
        </div>

        <div class="d-flex gap-2 flex-wrap">
          <a href="index.html#partner" class="btn btn-brand btn-lg">
            <i class="bi bi-send"></i> Submit Enquiry
          </a>
          <a href="index.html#contact" class="btn btn-outline-dark btn-lg">
            <i class="bi bi-chat-dots"></i> Contact Us
          </a>
        </div>
      </div>
    </div>
  </section>


  @endsection