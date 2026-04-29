@extends('custom.master')
@section('page-title', 'Sustainability')
@section('content')

<!-- BREADCRUMB -->
<!-- BREADCRUMB -->
<section class="sus-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">
                    Sustainability
                </li>
            </ol>
        </nav>
    </div>
</section>

<!-- HERO -->
<section class="sus-hero section-pad">
  <div class="sus-hero-bg"></div>
  <div class="container position-relative">
    <div class="row align-items-center g-5">

      <div class="col-lg-7">
        <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
          <i class="bi bi-leaf me-1"></i> Sustainability • Go Green
        </span>

        <h1 class="fw-bold display-6 mb-3">
          Practical steps for a <span class="text-brand">cleaner home</span> & a <span class="text-brand">cleaner planet</span>
        </h1>

        <p class="text-muted mb-4">
          Our Go Green approach focuses on smarter formulation decisions, responsible packaging direction,
          and everyday product performance — designed for modern Indian households.
        </p>

        <div class="d-flex gap-2 flex-wrap">
          <a href="#pillars" class="btn btn-brand btn-lg">
            <i class="bi bi-diagram-3"></i> Sustainability Pillars
          </a>
          <a href="{{ route('home') }}#partner" class="btn btn-outline-dark btn-lg">
            <i class="bi bi-people"></i> Partner With Us
          </a>
        </div>

        <div class="sus-hero-chips mt-4">
          <div class="sus-chip"><i class="bi bi-recycle"></i> Eco Conscious</div>
          <div class="sus-chip"><i class="bi bi-droplet"></i> Water Friendly</div>
          <div class="sus-chip"><i class="bi bi-shield-check"></i> Quality First</div>
          <div class="sus-chip"><i class="bi bi-gear-wide-connected"></i> Responsible Process</div>
        </div>
      </div>

      <div class="col-lg-5">
    <div class="sus-hero-media">
        @if($firstSustainabilitySection && $firstSustainabilitySection->image)
            <img
                src="{{ $firstSustainabilitySection->image->getUrl() }}"
                class="sus-hero-img"
                alt="{{ $firstSustainabilitySection->title ?? 'Sustainability' }}"
            >
        @else
            <img
                src="https://dummyimage.com/1200x900/0f3b2e/ffffff&text=Go+Green+Hero+1200x900"
                class="sus-hero-img"
                alt="Go Green Hero"
            >
        @endif

        <div class="sus-hero-badge">
            <i class="bi bi-tree"></i>

            <div>
                <div class="fw-bold">
                    {{ $firstSustainabilitySection->title ?? 'Go Green Mission' }}
                </div>

                <div class="small text-white-50">
                    Responsible by design
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
  </div>
</section>

<!-- KPI STRIP -->
<section class="sus-kpis">
  <div class="container">
    <div class="row g-3">
      <div class="col-md-6 col-lg-3">
        <div class="sus-kpi">
          <div class="sus-kpi-ico"><i class="bi bi-recycle"></i></div>
          <div>
            <div class="sus-kpi-num">Go Green</div>
            <div class="sus-kpi-text">Eco Mindset</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="sus-kpi">
          <div class="sus-kpi-ico"><i class="bi bi-droplet-half"></i></div>
          <div>
            <div class="sus-kpi-num">Efficient</div>
            <div class="sus-kpi-text">Rinsing Focus</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="sus-kpi">
          <div class="sus-kpi-ico"><i class="bi bi-box-seam"></i></div>
          <div>
            <div class="sus-kpi-num">Packaging</div>
            <div class="sus-kpi-text">Improvement Direction</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="sus-kpi">
          <div class="sus-kpi-ico"><i class="bi bi-check2-circle"></i></div>
          <div>
            <div class="sus-kpi-num">Performance</div>
            <div class="sus-kpi-text">Everyday Reliable</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PILLARS -->
<section id="pillars" class="section-pad bg-white">
  <div class="container">

    <div class="text-center mb-5">
      <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
        <i class="bi bi-diagram-3 me-1"></i> Our Sustainability Pillars
      </span>
      <h2 class="fw-bold mb-2">Built on Practical Responsibility</h2>
      <p class="text-muted mb-0">Realistic, measurable direction — without compromising product performance.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="sus-card h-100">
          <div class="sus-card-ico"><i class="bi bi-recycle"></i></div>
          <h5 class="fw-bold mb-2">Eco Formulations</h5>
          <p class="text-muted small mb-0">
            Better chemistry decisions aligned with responsibility — designed for daily household use.
          </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="sus-card h-100">
          <div class="sus-card-ico"><i class="bi bi-droplet"></i></div>
          <h5 class="fw-bold mb-2">Water Friendly Use</h5>
          <p class="text-muted small mb-0">
            Products intended for effective use with efficient rinsing and practical consumption.
          </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="sus-card h-100">
          <div class="sus-card-ico"><i class="bi bi-box-seam"></i></div>
          <h5 class="fw-bold mb-2">Packaging Direction</h5>
          <p class="text-muted small mb-0">
            Continuous improvement mindset for packaging choices and reduction planning.
          </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="sus-card h-100">
          <div class="sus-card-ico"><i class="bi bi-shield-check"></i></div>
          <h5 class="fw-bold mb-2">Safe & Consistent</h5>
          <p class="text-muted small mb-0">
            Quality-first production approach supported by monitoring and disciplined processes.
          </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="sus-card h-100">
          <div class="sus-card-ico"><i class="bi bi-people"></i></div>
          <h5 class="fw-bold mb-2">Partner Ecosystem</h5>
          <p class="text-muted small mb-0">
            Distributor-friendly approach with structured supply planning and support communication.
          </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="sus-card h-100">
          <div class="sus-card-ico"><i class="bi bi-graph-up-arrow"></i></div>
          <h5 class="fw-bold mb-2">Continuous Improvement</h5>
          <p class="text-muted small mb-0">
            Iteration mindset for better usability, stability and long-term product evolution.
          </p>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- APPROACH -->
<section class="section-pad bg-soft">
  <div class="container">

    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
          <i class="bi bi-lightbulb me-1"></i> Our Approach
        </span>

        <h2 class="fw-bold mb-3">How we drive Go Green direction</h2>
        <p class="text-muted mb-4">
          Sustainability is built into choices and processes — we aim for realistic improvements that keep products reliable.
        </p>

        <div class="sus-timeline">
          <div class="sus-step">
            <div class="sus-step-ico"><i class="bi bi-check2-circle"></i></div>
            <div>
              <div class="sus-step-title">Performance First</div>
              <div class="small text-muted">Everyday effectiveness matters — sustainability should not reduce outcomes.</div>
            </div>
          </div>

          <div class="sus-step">
            <div class="sus-step-ico"><i class="bi bi-recycle"></i></div>
            <div>
              <div class="sus-step-title">Smarter Choices</div>
              <div class="small text-muted">Continuous improvements in formulation and production decisions.</div>
            </div>
          </div>

          <div class="sus-step">
            <div class="sus-step-ico"><i class="bi bi-droplet-half"></i></div>
            <div>
              <div class="sus-step-title">Efficient Use</div>
              <div class="small text-muted">Designed to be practical with efficient rinsing behavior.</div>
            </div>
          </div>

          <div class="sus-step">
            <div class="sus-step-ico"><i class="bi bi-clipboard-check"></i></div>
            <div>
              <div class="sus-step-title">Process Discipline</div>
              <div class="small text-muted">Documentation and monitoring help ensure consistent implementation.</div>
            </div>
          </div>
        </div>

        <div class="d-flex gap-2 flex-wrap mt-4">
          <a href="{{ route('products.index') }}" class="btn btn-brand btn-lg">
            <i class="bi bi-box-seam"></i> Explore Products
          </a>
          <a href="{{ route('custom.enquiry') }}" class="btn btn-outline-dark btn-lg">
            <i class="bi bi-chat-dots"></i> Talk to Us
          </a>
        </div>
      </div>

      <div class="col-lg-6">
    <div class="sus-approach-media">
        @if($approachSustainabilitySection && $approachSustainabilitySection->image)
            <img
                src="{{ $approachSustainabilitySection->image->getUrl() }}"
                class="sus-approach-img"
                alt="{{ $approachSustainabilitySection->title ?? 'Sustainability Approach' }}"
            >
        @else
            <img
                src="https://dummyimage.com/1200x900/f2f2f2/111111&text=Approach+Image+1200x900"
                class="sus-approach-img"
                alt="Approach Image"
            >
        @endif

        <div class="sus-approach-float">
            <i class="bi bi-leaf"></i>

            <div>
                <div class="fw-bold">
                    {{ $approachSustainabilitySection->title ?? 'Go Green' }}
                </div>

                <div class="small text-muted">
                    Practical responsibility
                </div>
            </div>
        </div>
    </div>
</div>

    </div>

  </div>
</section>

<!-- FOCUS AREAS -->
<section class="section-pad bg-white">
  <div class="container">

    <div class="row g-4">
      <div class="col-lg-4">
        <div class="sus-focus">
          <div class="sus-focus-ico"><i class="bi bi-box-seam"></i></div>
          <h5 class="fw-bold mb-2">Packaging Direction</h5>
          <p class="text-muted small mb-0">
            We keep improving packaging decisions and aligning with long-term reduction mindset where feasible.
          </p>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="sus-focus">
          <div class="sus-focus-ico"><i class="bi bi-droplet"></i></div>
          <h5 class="fw-bold mb-2">Water Conscious Use</h5>
          <p class="text-muted small mb-0">
            Efficient rinsing and practical usage are key — designed for everyday household routines.
          </p>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="sus-focus">
          <div class="sus-focus-ico"><i class="bi bi-shield-check"></i></div>
          <h5 class="fw-bold mb-2">Safe & Consistent</h5>
          <p class="text-muted small mb-0">
            Quality monitoring supports safe manufacturing and consistent product experience across batches.
          </p>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- GALLERY -->
@php
    $sustainabilityImages = isset($sustainabilitySections)
        ? $sustainabilitySections->filter(function ($section) {
            return $section->image;
        })->values()
        : collect();
@endphp

@if($sustainabilityImages->count())
    <section class="section-pad bg-soft">
        <div class="container">
            <div class="row align-items-end g-3 mb-4">
                <div class="col-lg-8">
                    <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
                        <i class="bi bi-images me-1"></i> Sustainability Preview
                    </span>

                    <h2 class="fw-bold mb-1">
                        Go Green Visuals
                    </h2>

                    <p class="text-muted mb-0">
                        A visual look at our Go Green approach, responsible choices and sustainability mindset.
                    </p>
                </div>
            </div>

            <div class="row g-4">

                <div class="col-lg-6">
                    <div class="sus-gallery-big">
                        <img 
                            src="{{ $sustainabilityImages[0]->image->getUrl() }}" 
                            alt="{{ $sustainabilityImages[0]->title ?? 'Sustainability Image' }}"
                        >
                    </div>

                    <h6 class="fw-bold mt-3 mb-0">
                        {{ $sustainabilityImages[0]->title ?? 'Go Green Visual' }}
                    </h6>
                </div>

                <div class="col-lg-6">
                    <div class="row g-4">

                        <div class="col-6">
                            <div class="sus-gallery-small">
                                <img 
                                    src="{{ isset($sustainabilityImages[1]) ? $sustainabilityImages[1]->image->getUrl() : $sustainabilityImages[0]->image->getUrl() }}" 
                                    alt="{{ isset($sustainabilityImages[1]) ? $sustainabilityImages[1]->title : $sustainabilityImages[0]->title }}"
                                >
                            </div>

                            <h6 class="fw-bold mt-3 mb-0">
                                {{ isset($sustainabilityImages[1]) ? $sustainabilityImages[1]->title : $sustainabilityImages[0]->title }}
                            </h6>
                        </div>

                        <div class="col-6">
                            <div class="sus-gallery-small">
                                <img 
                                    src="{{ isset($sustainabilityImages[2]) ? $sustainabilityImages[2]->image->getUrl() : $sustainabilityImages[0]->image->getUrl() }}" 
                                    alt="{{ isset($sustainabilityImages[2]) ? $sustainabilityImages[2]->title : $sustainabilityImages[0]->title }}"
                                >
                            </div>

                            <h6 class="fw-bold mt-3 mb-0">
                                {{ isset($sustainabilityImages[2]) ? $sustainabilityImages[2]->title : $sustainabilityImages[0]->title }}
                            </h6>
                        </div>

                        <div class="col-12">
                            <div class="sus-gallery-wide">
                                <img 
                                    src="{{ isset($sustainabilityImages[3]) ? $sustainabilityImages[3]->image->getUrl() : $sustainabilityImages[0]->image->getUrl() }}" 
                                    alt="{{ isset($sustainabilityImages[3]) ? $sustainabilityImages[3]->title : $sustainabilityImages[0]->title }}"
                                >
                            </div>

                            <h6 class="fw-bold mt-3 mb-0">
                                {{ isset($sustainabilityImages[3]) ? $sustainabilityImages[3]->title : $sustainabilityImages[0]->title }}
                            </h6>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@else
    <section class="section-pad bg-soft">
        <div class="container">
            <div class="row align-items-end g-3 mb-4">
                <div class="col-lg-8">
                    <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
                        <i class="bi bi-images me-1"></i> Sustainability Preview
                    </span>

                    <h2 class="fw-bold mb-1">
                        Go Green Visuals
                    </h2>

                    <p class="text-muted mb-0">
                        Sustainability visuals will appear here once uploaded from admin.
                    </p>
                </div>
            </div>

            <div class="text-center bg-white rounded-4 p-5">
                <i class="bi bi-images display-5 text-muted"></i>

                <h5 class="fw-bold mt-3 mb-1">
                    No sustainability images found
                </h5>

                <p class="text-muted mb-0">
                    Please upload sustainability section images from admin.
                </p>
            </div>
        </div>
    </section>
@endif

<!-- CTA STRIP -->
<section class="sus-cta section-pad">
  <div class="sus-cta-bg"></div>
  <div class="container position-relative">
    <div class="row align-items-center g-4">
      <div class="col-lg-8 text-white">
        <h2 class="fw-bold mb-2">Want to partner with a Go Green brand?</h2>
        <p class="mb-0 text-white-50">Join our distribution network and promote eco-friendly living across India.</p>
      </div>

      <div class="col-lg-4">
        <div class="d-flex gap-2 flex-wrap justify-content-lg-end">
          <a href="https://wa.me/{{ $siteSetting->whatsapp ?? '91XXXXXXXXXX' }}" target="_blank" class="btn btn-light btn-lg">
            <i class="bi bi-whatsapp"></i> WhatsApp
          </a>
           <a href="{{ route('custom.enquiry') }}" class="btn btn-outline-light btn-lg">
            <i class="bi bi-chat-dots"></i> Contact
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection