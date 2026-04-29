@extends('custom.master')

@section('title', 'Manufacturing & R&D')

@section('content')

@php 
 $siteSetting = App\Models\SiteSetting::first();
@endphp
<!-- BREADCRUMB -->
<section class="mrd-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Manufacturing & R&D
                </li>
            </ol>
        </nav>
    </div>
</section>

<!-- HERO -->
<section class="mrd-hero section-pad">
    <div class="mrd-hero-bg"></div>

    <div class="container position-relative">
        <div class="row align-items-center g-5">

            <div class="col-lg-7">
                <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
                    <i class="bi bi-gear-wide-connected me-1"></i>
                    Manufacturing Excellence • Research Driven
                </span>

                <h1 class="fw-bold display-6 mb-3">
                    Manufacturing & R&D built for 
                    <span class="text-brand">Consistency</span>, 
                    <span class="text-brand">Quality</span> & Scale
                </h1>

                <p class="text-muted mb-4">
                    Our process is designed for repeatable performance — from incoming checks to final quality assurance —
                    supported by continuous research and formulation upgrades.
                </p>

                <div class="d-flex gap-2 flex-wrap">
                    <a href="#process" class="btn btn-brand btn-lg">
                        <i class="bi bi-diagram-3"></i> View Process
                    </a>

                    <a href="#quality" class="btn btn-outline-dark btn-lg">
                        <i class="bi bi-shield-check"></i> Quality Promise
                    </a>
                </div>

                <div class="mrd-hero-chips mt-4">
                    <div class="mrd-chip">
                        <i class="bi bi-patch-check"></i> GMP Certified
                    </div>

                    <div class="mrd-chip">
                        <i class="bi bi-award"></i> ISO Systems
                    </div>

                    <div class="mrd-chip">
                        <i class="bi bi-clipboard-check"></i> QC Monitoring
                    </div>

                    <div class="mrd-chip">
                        <i class="bi bi-lightbulb"></i> R&D Support
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="mrd-hero-media">
                    @if($heroManufactureSection && $heroManufactureSection->image)
                        <img
                            src="{{ $heroManufactureSection->image->getUrl() }}"
                            class="mrd-hero-img"
                            alt="{{ $heroManufactureSection->title }}"
                        >
                    @else
                        <img
                            src="https://dummyimage.com/1200x900/0a2c5a/ffffff&text=Facility+Hero+1200x900"
                            class="mrd-hero-img"
                            alt="Manufacturing Facility"
                        >
                    @endif

                    <div class="mrd-hero-float">
                        <div class="mrd-float-item">
                            <i class="bi bi-speedometer2"></i>
                            <div>
                                <div class="fw-bold">Batch Consistency</div>
                                <div class="small text-white-50">Monitored production</div>
                            </div>
                        </div>

                        <div class="mrd-float-divider"></div>

                        <div class="mrd-float-item">
                            <i class="bi bi-check2-circle"></i>
                            <div>
                                <div class="fw-bold">Quality Checks</div>
                                <div class="small text-white-50">Every stage QC</div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($heroManufactureSection)
                    <div class="text-center mt-3">
                        <div class="small text-muted">
                            {{ $heroManufactureSection->title }}
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

<!-- KPI STRIP -->
<section class="mrd-kpis">
  <div class="container">
    <div class="row g-3">
      <div class="col-md-6 col-lg-3">
        <div class="mrd-kpi">
          <div class="mrd-kpi-ico"><i class="bi bi-building-check"></i></div>
          <div>
            <div class="mrd-kpi-num">GMP</div>
            <div class="mrd-kpi-text">Certified Unit</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="mrd-kpi">
          <div class="mrd-kpi-ico"><i class="bi bi-award"></i></div>
          <div>
            <div class="mrd-kpi-num">ISO</div>
            <div class="mrd-kpi-text">Quality Systems</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="mrd-kpi">
          <div class="mrd-kpi-ico"><i class="bi bi-clipboard-check"></i></div>
          <div>
            <div class="mrd-kpi-num">3-Step</div>
            <div class="mrd-kpi-text">QC Framework</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="mrd-kpi">
          <div class="mrd-kpi-ico"><i class="bi bi-truck"></i></div>
          <div>
            <div class="mrd-kpi-num">Planned</div>
            <div class="mrd-kpi-text">Dispatch & Supply</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PROCESS -->
<section id="process" class="section-pad bg-white">
  <div class="container">

    <div class="row align-items-end g-3 mb-4">
      <div class="col-lg-7">
        <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
          <i class="bi bi-diagram-3 me-1"></i> Our Process
        </span>
        <h2 class="fw-bold mb-1">Structured Production Flow</h2>
        <p class="text-muted mb-0">Built for safety, uniformity and repeatable performance.</p>
      </div>
      <div class="col-lg-5 text-lg-end">
        <a href="{{ route('custom.enquiry') }}" class="btn btn-outline-dark">
          <i class="bi bi-people"></i> Distributor Enquiry
        </a>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-6">
        <div class="mrd-timeline">

          <div class="mrd-step">
            <div class="mrd-step-ico"><i class="bi bi-inboxes"></i></div>
            <div>
              <div class="mrd-step-title">Incoming Material Checks</div>
              <div class="small text-muted">Verification of raw materials for safe, consistent formulation.</div>
            </div>
          </div>

          <div class="mrd-step">
            <div class="mrd-step-ico"><i class="bi bi-activity"></i></div>
            <div>
              <div class="mrd-step-title">In-Process Monitoring</div>
              <div class="small text-muted">Batch-wise monitoring to maintain performance and uniformity.</div>
            </div>
          </div>

          <div class="mrd-step">
            <div class="mrd-step-ico"><i class="bi bi-patch-check"></i></div>
            <div>
              <div class="mrd-step-title">Final Quality Assurance</div>
              <div class="small text-muted">Final inspection and compliance checks before dispatch.</div>
            </div>
          </div>

          <div class="mrd-step">
            <div class="mrd-step-ico"><i class="bi bi-box-seam"></i></div>
            <div>
              <div class="mrd-step-title">Packaging & Dispatch</div>
              <div class="small text-muted">Packaging integrity checks and planned distribution support.</div>
            </div>
          </div>

        </div>
      </div>

     <div class="col-lg-6">
    <div class="mrd-process-media">
        @if($processManufactureSection && $processManufactureSection->image)
            <img
                src="{{ $processManufactureSection->image->getUrl() }}"
                class="mrd-process-img"
                alt="{{ $processManufactureSection->title ?? 'Process Image' }}"
            >
        @else
            <img
                src="https://dummyimage.com/1200x900/f2f2f2/111111&text=Process+Image+1200x900"
                class="mrd-process-img"
                alt="Process Image"
            >
        @endif

        <div class="mrd-process-overlay"></div>

        <div class="mrd-process-caption">
            <div class="mrd-process-cap-title">
                {{ $processManufactureSection->title ?? 'Quality at Every Stage' }}
            </div>

            <div class="small text-white-50">
                Incoming • In-process • Final QC
            </div>
        </div>
    </div>
</div>
    </div>

  </div>
</section>

<!-- R&D -->
<section class="section-pad bg-soft">
  <div class="container">

    <div class="text-center mb-5">
      <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
        <i class="bi bi-flask me-1"></i> Research & Development
      </span>
      <h2 class="fw-bold mb-2">Continuous Improvements</h2>
      <p class="text-muted mb-0">Better usability, better performance, responsible choices.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="mrd-rd-card h-100">
          <div class="mrd-rd-ico"><i class="bi bi-bezier2"></i></div>
          <h6 class="fw-bold mb-2">Formulation Upgrades</h6>
          <p class="text-muted small mb-0">Optimization for performance, stability and user experience.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="mrd-rd-card h-100">
          <div class="mrd-rd-ico"><i class="bi bi-droplet-half"></i></div>
          <h6 class="fw-bold mb-2">Efficiency Focus</h6>
          <p class="text-muted small mb-0">Designed for practical usage and effective rinsing behavior.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="mrd-rd-card h-100">
          <div class="mrd-rd-ico"><i class="bi bi-recycle"></i></div>
          <h6 class="fw-bold mb-2">Responsible Choices</h6>
          <p class="text-muted small mb-0">Aligned with Go Green mindset and safer daily essentials.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="mrd-rd-card h-100">
          <div class="mrd-rd-ico"><i class="bi bi-clipboard-data"></i></div>
          <h6 class="fw-bold mb-2">Testing & Validation</h6>
          <p class="text-muted small mb-0">Checks for stability, consistency and repeatable outcomes.</p>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- QUALITY & COMPLIANCE -->
<section id="quality" class="section-pad bg-white">
  <div class="container">
    <div class="row align-items-center g-5">

    <div class="col-lg-6">
    <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
        <i class="bi bi-shield-check me-1"></i> Quality & Compliance
    </span>

    <h2 class="fw-bold mb-3">
        Quality Promise, Documented Systems
    </h2>

    <p class="text-muted mb-4">
        Our approach supports safe manufacturing, consistent batches, and predictable performance.
        We focus on monitoring, documentation and disciplined operations.
    </p>

    <div class="accordion accordion-premium" id="mrdAcc">

        @forelse($faqs as $key => $faq)
            <div class="accordion-item">
                <h2 class="accordion-header" id="mrdFaqHeading{{ $key }}">
                    <button 
                        class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#mrdFaqCollapse{{ $key }}" 
                        aria-expanded="{{ $key == 0 ? 'true' : 'false' }}"
                    >
                        {{ $faq->question }}
                    </button>
                </h2>

                <div 
                    id="mrdFaqCollapse{{ $key }}" 
                    class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" 
                    data-bs-parent="#mrdAcc"
                >
                    <div class="accordion-body text-muted">
                        {!! nl2br(e($faq->answer)) !!}
                    </div>
                </div>
            </div>
        @empty
            <div class="accordion-item">
                <h2 class="accordion-header" id="a1">
                    <button 
                        class="accordion-button" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#c1" 
                        aria-expanded="true"
                    >
                        What checks are done in Quality Control?
                    </button>
                </h2>

                <div id="c1" class="accordion-collapse collapse show" data-bs-parent="#mrdAcc">
                    <div class="accordion-body text-muted">
                        Incoming checks, in-process monitoring and final inspection before dispatch — to maintain consistency and safety.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="a2">
                    <button 
                        class="accordion-button collapsed" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#c2"
                    >
                        How does R&D improve performance?
                    </button>
                </h2>

                <div id="c2" class="accordion-collapse collapse" data-bs-parent="#mrdAcc">
                    <div class="accordion-body text-muted">
                        R&D focuses on improving usability, effectiveness and stability while aligning with eco-conscious product goals.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="a3">
                    <button 
                        class="accordion-button collapsed" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#c3"
                    >
                        What about responsible sourcing & sustainability?
                    </button>
                </h2>

                <div id="c3" class="accordion-collapse collapse" data-bs-parent="#mrdAcc">
                    <div class="accordion-body text-muted">
                        We emphasize responsible decisions and structured processes to support sustainability objectives over time.
                    </div>
                </div>
            </div>
        @endforelse

    </div>

    <div class="d-flex gap-2 flex-wrap mt-4">
        <a href="{{ route('certificates.index') }}" class="btn btn-brand">
            <i class="bi bi-patch-check"></i> View Certifications
        </a>

        <a href="{{ route('custom.enquiry') }}" class="btn btn-outline-dark">
            <i class="bi bi-chat-dots"></i> Request Details
        </a>
    </div>
</div>
     <div class="col-lg-6">
    <div class="mrd-quality-media">
        @if($qualityManufactureSection && $qualityManufactureSection->image)
            <img
                src="{{ $qualityManufactureSection->image->getUrl() }}"
                class="mrd-quality-img"
                alt="{{ $qualityManufactureSection->title ?? 'Quality Image' }}"
            >
        @else
            <img
                src="https://dummyimage.com/1200x900/e9f1ff/0a2c5a&text=Quality+Image+1200x900"
                class="mrd-quality-img"
                alt="Quality Image"
            >
        @endif

        <div class="mrd-quality-float mrd-qf-1">
            <i class="bi bi-patch-check"></i>
            <div>
                <div class="fw-bold">GMP</div>
                <div class="small text-muted">Certified Unit</div>
            </div>
        </div>

        <div class="mrd-quality-float mrd-qf-2">
            <i class="bi bi-award"></i>
            <div>
                <div class="fw-bold">ISO</div>
                <div class="small text-muted">Quality Systems</div>
            </div>
        </div>

        <div class="mrd-quality-float mrd-qf-3">
            <i class="bi bi-clipboard-check"></i>
            <div>
                <div class="fw-bold">QC</div>
                <div class="small text-muted">Monitoring</div>
            </div>
        </div>
    </div>

    @if($qualityManufactureSection)
        <div class="text-center mt-3">
            <div class="small text-muted">
                {{ $qualityManufactureSection->title }}
            </div>
        </div>
    @endif
</div>

    </div>
  </div>
</section>

@php
    $manufactureImages = isset($manufactureSections)
        ? $manufactureSections->filter(function ($section) {
            return $section->image;
        })->values()
        : collect();
@endphp

@if($manufactureImages->count())
    <!-- GALLERY -->
    <section class="section-pad bg-soft">
        <div class="container">
            <div class="row align-items-end g-3 mb-4">
                <div class="col-lg-7">
                    <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
                        <i class="bi bi-images me-1"></i> Facility Preview
                    </span>

                    <h2 class="fw-bold mb-1">
                        Manufacturing Snapshot
                    </h2>

                    <p class="text-muted mb-0">
                        A visual look at our manufacturing process, facility and quality-focused production areas.
                    </p>
                </div>
            </div>

            <div class="row g-4">

                <!-- Big Image -->
                <div class="col-lg-6">
                    <div class="mrd-gallery-big">
                        <img 
                            src="{{ $manufactureImages[0]->image->getUrl() }}" 
                            alt="{{ $manufactureImages[0]->title }}"
                        >
                    </div>

                    <h6 class="fw-bold mt-3 mb-0">
                        {{ $manufactureImages[0]->title }}
                    </h6>
                </div>

                <!-- Right Images -->
                <div class="col-lg-6">
                    <div class="row g-4">

                        <div class="col-6">
                            <div class="mrd-gallery-small">
                                <img 
                                    src="{{ isset($manufactureImages[1]) ? $manufactureImages[1]->image->getUrl() : $manufactureImages[0]->image->getUrl() }}" 
                                    alt="{{ isset($manufactureImages[1]) ? $manufactureImages[1]->title : $manufactureImages[0]->title }}"
                                >
                            </div>

                            <h6 class="fw-bold mt-3 mb-0">
                                {{ isset($manufactureImages[1]) ? $manufactureImages[1]->title : $manufactureImages[0]->title }}
                            </h6>
                        </div>

                        <div class="col-6">
                            <div class="mrd-gallery-small">
                                <img 
                                    src="{{ isset($manufactureImages[2]) ? $manufactureImages[2]->image->getUrl() : $manufactureImages[0]->image->getUrl() }}" 
                                    alt="{{ isset($manufactureImages[2]) ? $manufactureImages[2]->title : $manufactureImages[0]->title }}"
                                >
                            </div>

                            <h6 class="fw-bold mt-3 mb-0">
                                {{ isset($manufactureImages[2]) ? $manufactureImages[2]->title : $manufactureImages[0]->title }}
                            </h6>
                        </div>

                        <div class="col-12">
                            <div class="mrd-gallery-wide">
                                <img 
                                    src="{{ isset($manufactureImages[3]) ? $manufactureImages[3]->image->getUrl() : $manufactureImages[0]->image->getUrl() }}" 
                                    alt="{{ isset($manufactureImages[3]) ? $manufactureImages[3]->title : $manufactureImages[0]->title }}"
                                >
                            </div>

                            <h6 class="fw-bold mt-3 mb-0">
                                {{ isset($manufactureImages[3]) ? $manufactureImages[3]->title : $manufactureImages[0]->title }}
                            </h6>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@else
    <!-- GALLERY FALLBACK -->
    <section class="section-pad bg-soft">
        <div class="container">
            <div class="row align-items-end g-3 mb-4">
                <div class="col-lg-7">
                    <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
                        <i class="bi bi-images me-1"></i> Facility Preview
                    </span>

                    <h2 class="fw-bold mb-1">
                        Manufacturing Snapshot
                    </h2>

                    <p class="text-muted mb-0">
                        Facility images will appear here once uploaded from admin.
                    </p>
                </div>
            </div>

            <div class="text-center bg-white rounded-4 p-5">
                <i class="bi bi-images display-5 text-muted"></i>
                <h5 class="fw-bold mt-3 mb-1">No gallery images found</h5>
                <p class="text-muted mb-0">Please upload manufacture section images from admin.</p>
            </div>
        </div>
    </section>
@endif


<!-- CTA STRIP -->
<section class="mrd-cta section-pad">
  <div class="mrd-cta-bg"></div>
  <div class="container position-relative">
    <div class="row align-items-center g-4">
      <div class="col-lg-8 text-white">
        <h2 class="fw-bold mb-2">Need Manufacturing Details or Distributor Pricing?</h2>
        <p class="mb-0 text-white-50">Contact us to receive product catalog, certifications and partnership information.</p>
      </div>

      <div class="col-lg-4">
        <div class="d-flex gap-2 flex-wrap justify-content-lg-end">
          <a href="https://wa.me/{{ $siteSetting->whatsapp_number ?? '91XXXXXXXXXX' }}" target="_blank" class="btn btn-light btn-lg">
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