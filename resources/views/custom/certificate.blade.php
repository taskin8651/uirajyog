@extends('custom.master')

@section('content')

@php 
 $siteSetting = App\Models\SiteSetting::first();
@endphp

<!-- HERO -->
<section class="certp-hero section-pad">
  <div class="certp-hero-bg"></div>
  <div class="container position-relative">
    <div class="row align-items-center g-5">

      <div class="col-lg-6">
        <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
          <i class="bi bi-patch-check me-1"></i> Certifications & Compliance
        </span>

        <h1 class="fw-bold display-6 mb-3">
          Certified & Trusted for <span class="text-brand">Quality</span> and <span class="text-brand">Consistency</span>
        </h1>

        <p class="text-muted mb-4">
          Our systems follow GMP & ISO aligned practices to support safe manufacturing, consistent batches,
          and reliable performance across product lines.
        </p>

        <div class="d-flex gap-2 flex-wrap">
          <a href="#documents" class="btn btn-brand btn-lg">
            <i class="bi bi-download"></i> View Documents
          </a>
          <a href="{{ route('custom.enquiry') }}" class="btn btn-outline-dark btn-lg">
            <i class="bi bi-chat-dots"></i> Request Certificates
          </a>
        </div>

        <div class="certp-hero-chips mt-4">
          <div class="certp-chip"><i class="bi bi-shield-check"></i> GMP Certified</div>
          <div class="certp-chip"><i class="bi bi-award"></i> ISO Systems</div>
          <div class="certp-chip"><i class="bi bi-clipboard-check"></i> QC Monitoring</div>
          <div class="certp-chip"><i class="bi bi-graph-up-arrow"></i> Consistency</div>
        </div>
      </div>

     <div class="col-lg-6">
    <div class="certp-hero-media">
        <div id="certPageSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-inner">

                @forelse($certificateImages as $key => $certificate)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="certp-slide">
                            <img 
                                src="{{ $certificate->file_url }}" 
                                class="certp-slide-img" 
                                alt="{{ $certificate->title }}"
                            >

                            <div class="certp-slide-overlay"></div>

                            <div class="certp-slide-caption">
                                <div class="certp-chip2">
                                    <i class="bi bi-patch-check"></i> {{ $certificate->title }}
                                </div>

                                <div class="small text-white-50">
                                    {{ $certificate->short_description ?? 'Quality, manufacturing and compliance document.' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <div class="certp-slide">
                            <img 
                                src="https://dummyimage.com/1400x900/0a2c5a/ffffff&text=Certificate+Slide+1400x900" 
                                class="certp-slide-img" 
                                alt="Certificate Slide"
                            >

                            <div class="certp-slide-overlay"></div>

                            <div class="certp-slide-caption">
                                <div class="certp-chip2">
                                    <i class="bi bi-patch-check"></i> GMP Compliance
                                </div>

                                <div class="small text-white-50">
                                    Structured manufacturing & quality processes
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse

            </div>

            @if($certificateImages->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#certPageSlider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#certPageSlider" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <div class="carousel-indicators certp-dots">
                    @foreach($certificateImages as $key => $certificate)
                        <button 
                            type="button" 
                            data-bs-target="#certPageSlider" 
                            data-bs-slide-to="{{ $key }}" 
                            class="{{ $key == 0 ? 'active' : '' }}" 
                            aria-label="Slide {{ $key + 1 }}">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="row g-3 mt-3">
        <div class="col-6">
            <div class="certp-mini">
                <div class="certp-mini-num">GMP</div>
                <div class="certp-mini-text">Certified Unit</div>
            </div>
        </div>

        <div class="col-6">
            <div class="certp-mini">
                <div class="certp-mini-num">ISO</div>
                <div class="certp-mini-text">Quality Systems</div>
            </div>
        </div>
    </div>
</div>

    </div>
  </div>
</section>

<!-- TRUST STATS -->
<section class="section-pad bg-white">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="certp-stat">
          <div class="certp-stat-ico"><i class="bi bi-shield-check"></i></div>
          <div>
            <div class="fw-bold">GMP</div>
            <div class="small text-muted">Manufacturing compliance</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="certp-stat">
          <div class="certp-stat-ico"><i class="bi bi-award"></i></div>
          <div>
            <div class="fw-bold">ISO</div>
            <div class="small text-muted">Quality management systems</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="certp-stat">
          <div class="certp-stat-ico"><i class="bi bi-clipboard-check"></i></div>
          <div>
            <div class="fw-bold">QC</div>
            <div class="small text-muted">Stage-wise monitoring</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="certp-stat">
          <div class="certp-stat-ico"><i class="bi bi-file-earmark-text"></i></div>
          <div>
            <div class="fw-bold">Documentation</div>
            <div class="small text-muted">Process & audit records</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- DOCUMENTS -->
<section id="documents" class="section-pad bg-soft">
    <div class="container">

        <div class="row align-items-end g-3 mb-4">
            <div class="col-lg-7">
                <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
                    <i class="bi bi-folder2-open me-1"></i> Certificates & Documents
                </span>

                <h2 class="fw-bold mb-1">
                    Downloadable Resources
                </h2>

                <p class="text-muted mb-0">
                    Download official certificates, quality documents and compliance resources.
                </p>
            </div>

            <div class="col-lg-5 text-lg-end">
                <a href="{{ route('custom.enquiry') }}" class="btn btn-brand">
                    <i class="bi bi-chat-dots"></i> Request Official Copies
                </a>
            </div>
        </div>

        @if(isset($certificates) && $certificates->count())
            <div class="row g-4">
                @foreach($certificates as $certificate)
                    @php
                        $file = $certificate->pdf;
                        $fileUrl = $file ? $file->getUrl() : null;
                        $mimeType = $file->mime_type ?? null;

                        $isPdf = $mimeType === 'application/pdf';
                        $isImage = $mimeType && str_starts_with($mimeType, 'image/');

                        $fileLabel = $isPdf ? 'PDF' : ($isImage ? 'IMAGE' : 'FILE');
                        $icon = $isPdf ? 'bi-file-earmark-pdf' : ($isImage ? 'bi-image' : 'bi-file-earmark-text');
                    @endphp

                    <div class="col-md-6 col-lg-4">
                        <div class="certp-doc h-100">
                            <div class="certp-doc-top">
                                <div class="certp-doc-ico">
                                    <i class="bi {{ $icon }}"></i>
                                </div>

                                <div>
                                    <div class="fw-bold">
                                        {{ $certificate->title }}
                                    </div>

                                    <div class="small text-muted">
                                        {{ $certificate->short_description ?? 'Official document available for download.' }}
                                    </div>
                                </div>
                            </div>

                            <div class="certp-doc-bottom">
                                <span class="certp-doc-tag">
                                    {{ $fileLabel }}
                                </span>

                                @if($fileUrl)
                                    <a 
                                        href="{{ $fileUrl }}" 
                                        download 
                                        class="btn btn-sm btn-outline-dark"
                                    >
                                        <i class="bi bi-download"></i> Download
                                    </a>
                                @else
                                    <span class="badge bg-secondary">
                                        File not uploaded
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 bg-white rounded-4">
                <i class="bi bi-folder2-open display-5 text-muted"></i>

                <h5 class="fw-bold mt-3 mb-1">
                    No documents available
                </h5>

                <p class="text-muted mb-0">
                    Certificates and documents will appear here once uploaded from admin.
                </p>
            </div>
        @endif

    </div>
</section>


<!-- QUALITY FAQ -->
<section class="section-pad bg-white">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6">
                <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
                    <i class="bi bi-shield-check me-1"></i> Quality Assurance
                </span>

                <h2 class="fw-bold mb-3">
                    Audits, Monitoring & Controls
                </h2>

                <p class="text-muted mb-4">
                    We maintain structured checks and documentation for manufacturing consistency and product reliability.
                </p>

                <div class="accordion accordion-premium" id="certFaq">

                    @forelse($faqs as $key => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="cf{{ $key }}">
                                <button 
                                    class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#cfa{{ $key }}" 
                                    aria-expanded="{{ $key == 0 ? 'true' : 'false' }}"
                                >
                                    {{ $faq->question }}
                                </button>
                            </h2>

                            <div 
                                id="cfa{{ $key }}" 
                                class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" 
                                data-bs-parent="#certFaq"
                            >
                                <div class="accordion-body text-muted">
                                    {!! nl2br(e($faq->answer)) !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="cf1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#cfa1" aria-expanded="true">
                                    What checks are part of QC monitoring?
                                </button>
                            </h2>

                            <div id="cfa1" class="accordion-collapse collapse show" data-bs-parent="#certFaq">
                                <div class="accordion-body text-muted">
                                    Incoming checks, in-process monitoring and final inspection before dispatch — helping ensure consistent batches.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="cf2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cfa2">
                                    Why are GMP and ISO important?
                                </button>
                            </h2>

                            <div id="cfa2" class="accordion-collapse collapse" data-bs-parent="#certFaq">
                                <div class="accordion-body text-muted">
                                    They support structured documentation, process discipline and quality control for safer manufacturing and repeatable performance.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="cf3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cfa3">
                                    Can distributors request official copies?
                                </button>
                            </h2>

                            <div id="cfa3" class="accordion-collapse collapse" data-bs-parent="#certFaq">
                                <div class="accordion-body text-muted">
                                    Yes — contact us via form or WhatsApp for official certificate copies and distributor documentation.
                                </div>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>
@php
    $qualityImage = isset($certificateImages) && $certificateImages->count()
        ? $certificateImages->first()
        : null;
@endphp

<div class="col-lg-6">
    <div class="certp-quality-media">
        @if($qualityImage && $qualityImage->file_url)
            <img
                src="{{ $qualityImage->file_url }}"
                class="certp-quality-img"
                alt="{{ $qualityImage->title }}"
            >
        @else
            <img
                src="{{ asset('assets/img/quality-media.jpg') }}"
                class="certp-quality-img"
                alt="Quality Media"
            >
        @endif

        <div class="certp-quality-float">
            <i class="bi bi-clipboard-check"></i>

            <div>
                <div class="fw-bold">
                    {{ $qualityImage->title ?? 'Stage-wise QC' }}
                </div>

                <div class="small text-muted">
                    {{ $qualityImage->short_description ?? 'Incoming • In-process • Final' }}
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</section>
@php
    $certificateImages = isset($certificates)
        ? $certificates->filter(function ($certificate) {
            return $certificate->pdf 
                && $certificate->pdf->mime_type 
                && str_starts_with($certificate->pdf->mime_type, 'image/');
        })->values()
        : collect();
@endphp

@if($certificateImages->count())
    <!-- GALLERY -->
    <section class="section-pad bg-soft">
        <div class="container">
            <div class="row align-items-end g-3 mb-4">
                <div class="col-lg-8">
                    <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
                        <i class="bi bi-images me-1"></i> Visuals
                    </span>

                    <h2 class="fw-bold mb-1">
                        Certificates Preview
                    </h2>

                    <p class="text-muted mb-0">
                        View certificate images uploaded from admin.
                    </p>
                </div>
            </div>

            <div class="row g-4">
                @foreach($certificateImages as $key => $certificate)
                    @php
                        $imageUrl = $certificate->pdf->getUrl();
                    @endphp

                    @if($key == 0)
                        <div class="col-lg-6">
                            <div class="certp-gallery-big">
                                <img 
                                    src="{{ $imageUrl }}" 
                                    alt="{{ $certificate->title }}"
                                >
                            </div>
                        </div>
                    @elseif($key == 1)
                        <div class="col-lg-6">
                            <div class="row g-4">
                                <div class="col-6">
                                    <div class="certp-gallery-small">
                                        <img 
                                            src="{{ $imageUrl }}" 
                                            alt="{{ $certificate->title }}"
                                        >
                                    </div>
                                </div>
                    @elseif($key == 2)
                                <div class="col-6">
                                    <div class="certp-gallery-small">
                                        <img 
                                            src="{{ $imageUrl }}" 
                                            alt="{{ $certificate->title }}"
                                        >
                                    </div>
                                </div>
                    @elseif($key == 3)
                                <div class="col-12">
                                    <div class="certp-gallery-wide">
                                        <img 
                                            src="{{ $imageUrl }}" 
                                            alt="{{ $certificate->title }}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if($certificateImages->count() == 1)
                    <div class="col-lg-6">
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="certp-gallery-small">
                                    <img 
                                        src="{{ $certificateImages[0]->pdf->getUrl() }}" 
                                        alt="{{ $certificateImages[0]->title }}"
                                    >
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="certp-gallery-small">
                                    <img 
                                        src="{{ $certificateImages[0]->pdf->getUrl() }}" 
                                        alt="{{ $certificateImages[0]->title }}"
                                    >
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="certp-gallery-wide">
                                    <img 
                                        src="{{ $certificateImages[0]->pdf->getUrl() }}" 
                                        alt="{{ $certificateImages[0]->title }}"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($certificateImages->count() == 2)
                            <div class="col-6">
                                <div class="certp-gallery-small">
                                    <img 
                                        src="{{ $certificateImages[1]->pdf->getUrl() }}" 
                                        alt="{{ $certificateImages[1]->title }}"
                                    >
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="certp-gallery-wide">
                                    <img 
                                        src="{{ $certificateImages[1]->pdf->getUrl() }}" 
                                        alt="{{ $certificateImages[1]->title }}"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($certificateImages->count() == 3)
                                <div class="col-12">
                                    <div class="certp-gallery-wide">
                                        <img 
                                            src="{{ $certificateImages[2]->pdf->getUrl() }}" 
                                            alt="{{ $certificateImages[2]->title }}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
            </div>
        </div>
    </section>
@endif

<!-- REQUEST CTA -->
<section id="request" class="certp-cta section-pad">
  <div class="certp-cta-bg"></div>
  <div class="container position-relative">
    <div class="row align-items-center g-4">
      <div class="col-lg-8 text-white">
        <h2 class="fw-bold mb-2">Need official certificates or compliance documents?</h2>
        <p class="mb-0 text-white-50">Contact our team — we’ll share verified copies for distributors and partners.</p>
      </div>

      <div class="col-lg-4">
        <div class="d-flex gap-2 flex-wrap justify-content-lg-end">
          <a href="https://wa.me/{{ $siteSetting->whatsapp_number ?? '91XXXXXXXXXX' }}" target="_blank" class="btn btn-light btn-lg">
            <i class="bi bi-whatsapp"></i> WhatsApp
          </a>
          <a href="{{ route('custom.investor') }}" class="btn btn-outline-light btn-lg">
            <i class="bi bi-chat-dots"></i> Contact
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection