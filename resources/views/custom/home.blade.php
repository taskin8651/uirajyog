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
        <div 
            id="heroProductSlider" 
            class="carousel slide carousel-fade" 
            data-bs-ride="carousel" 
            data-bs-interval="3500"
        >

            <div class="carousel-inner rounded-xxl">

                @forelse($heroSections as $key => $heroSection)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="hero-slide">

                            @if($heroSection->image)
                                <img 
                                    src="{{ $heroSection->image->getUrl() }}" 
                                    class="d-block w-100 hero-slide-img" 
                                    alt="{{ $heroSection->title ?? 'Hero Slide' }}"
                                >
                            @else
                                <img 
                                    src="{{ asset('assets/img/hero_one.png') }}" 
                                    class="d-block w-100 hero-slide-img" 
                                    alt="{{ $heroSection->title ?? 'Hero Slide' }}"
                                >
                            @endif

                            <div class="hero-slide-overlay"></div>

                            <div class="hero-slide-caption">
                                @if($heroSection->subtitle)
                                    <span class="hero-chip">
                                        {{ $heroSection->subtitle }}
                                    </span>
                                @endif

                                <h5 class="fw-bold mb-1">
                                    {{ $heroSection->title ?? 'Raj Yog Go Green' }}
                                </h5>

                                @if($heroSection->description)
                                    <p class="small mb-0 text-white-50">
                                        {{ $heroSection->description }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <div class="hero-slide">
                            <img 
                                src="{{ asset('assets/img/hero_one.png') }}" 
                                class="d-block w-100 hero-slide-img" 
                                alt="Hero Slide"
                            >

                            <div class="hero-slide-overlay"></div>

                            <div class="hero-slide-caption">
                                <span class="hero-chip">Home Care</span>

                                <h5 class="fw-bold mb-1">
                                    Ultra White Laundry Soap
                                </h5>

                                <p class="small mb-0 text-white-50">
                                    Brighter wash • Fabric friendly • Fresh finish
                                </p>
                            </div>
                        </div>
                    </div>
                @endforelse

            </div>

            @if($heroSections->count() > 1)
                <!-- Controls -->
                <button 
                    class="carousel-control-prev" 
                    type="button" 
                    data-bs-target="#heroProductSlider" 
                    data-bs-slide="prev"
                >
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button 
                    class="carousel-control-next" 
                    type="button" 
                    data-bs-target="#heroProductSlider" 
                    data-bs-slide="next"
                >
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <!-- Dots -->
                <div class="carousel-indicators hero-dots">
                    @foreach($heroSections as $key => $heroSection)
                        <button 
                            type="button" 
                            data-bs-target="#heroProductSlider" 
                            data-bs-slide-to="{{ $key }}" 
                            class="{{ $key == 0 ? 'active' : '' }}" 
                            aria-label="Slide {{ $key + 1 }}"
                        ></button>
                    @endforeach
                </div>
            @endif

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

<!-- ABOUT (Premium) -->
<section id="about" class="about-premium section-pad">
    <div class="container">
        <div class="row align-items-center g-5">

            <!-- LEFT: Image + Floating Highlights -->
            <div class="col-lg-6">
                <div class="about-media">

                    @if($aboutSection && $aboutSection->image)
                        <img
                            src="{{ $aboutSection->image->getUrl() }}"
                            class="img-fluid about-img"
                            alt="{{ $aboutSection->title ?? 'About Raj Yog' }}"
                        >
                    @else
                        <img
                            src="{{ asset('assets/img/home_about.png') }}"
                            class="img-fluid about-img"
                            alt="Manufacturing & Quality Process"
                        >
                    @endif

                    <!-- Floating badge -->
                    <div class="about-badge">
                        <i class="bi bi-award"></i>
                        <div>
                            <div class="fw-bold">Certified</div>
                            <div class="small">GMP • ISO Standards</div>
                        </div>
                    </div>

                    <!-- Floating cards -->
                    <div class="about-float about-float-1">
                        <i class="bi bi-shield-check"></i>
                        <div>
                            <div class="fw-bold">Quality First</div>
                            <div class="small text-muted">Checks at every stage</div>
                        </div>
                    </div>

                    <div class="about-float about-float-2">
                        <i class="bi bi-leaf"></i>
                        <div>
                            <div class="fw-bold">Go Green</div>
                            <div class="small text-muted">Eco-conscious approach</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Content -->
            <div class="col-lg-6">
                <div class="about-kicker mb-3">
                    <span class="badge badge-soft rounded-pill px-3 py-2">
                        <i class="bi bi-info-circle me-1"></i> About Raj Yog
                    </span>
                </div>

                <h2 class="about-title fw-bold mb-3">
                    {!! $aboutSection->title ?? 'A Brand Built on Quality & Responsibility' !!}
                </h2>

                @if($aboutSection && $aboutSection->short_description)
                    <p class="text-muted mb-3">
                        {!! $aboutSection->short_description !!}
                    </p>
                @endif

                <p class="text-muted mb-4">
                    {!! $aboutSection->description ?? 'Raj Yog focuses on safer, eco-friendly formulations for daily essentials. Our approach is research-backed, performance-first, and aligned with responsible manufacturing.' !!}
                </p>

                <!-- Icon feature grid -->
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="about-card">
                            <div class="about-card-icon">
                                <i class="bi bi-building-check"></i>
                            </div>
                            <div>
                                <div class="fw-bold mb-1">Manufacturing</div>
                                <div class="small text-muted">Structured processes & quality checks.</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="about-card">
                            <div class="about-card-icon">
                                <i class="bi bi-lightbulb"></i>
                            </div>
                            <div>
                                <div class="fw-bold mb-1">R&amp;D Focus</div>
                                <div class="small text-muted">Continuous improvement in formulations.</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="about-card">
                            <div class="about-card-icon">
                                <i class="bi bi-heart-pulse"></i>
                            </div>
                            <div>
                                <div class="fw-bold mb-1">Non-Toxic</div>
                                <div class="small text-muted">Skin &amp; fabric friendly choices.</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="about-card">
                            <div class="about-card-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <div>
                                <div class="fw-bold mb-1">Partnership</div>
                                <div class="small text-muted">Built for distributors &amp; growth.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mini stats -->
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

                <!-- CTA -->
                <div class="mt-4 d-flex gap-2 flex-wrap">
                    <a href="{{ route('about') }}" class="btn btn-outline-dark btn-lg about-btn">
                        Know More
                    </a>

                    <a href="{{ route('certificates.index') }}" class="btn btn-brand btn-lg about-btn">
                        <i class="bi bi-patch-check"></i> View Certifications
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- PRODUCTS (Premium) -->
<section id="products" class="products-premium section-pad bg-soft">
    <div class="container">

        <!-- Header -->
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
            <div>
                <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
                    <i class="bi bi-box-seam me-1"></i> Our Products
                </span>

                <h2 class="fw-bold mb-1">
                    Featured Products
                </h2>

                <p class="text-muted mb-0">
                    High-performance essentials with an eco-conscious approach.
                </p>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('custom.investor') }}" class="btn btn-outline-dark">
                    <i class="bi bi-people"></i> Distributor Enquiry
                </a>

                <a href="{{ route('products.index') }}" class="btn btn-brand">
                    <i class="bi bi-grid-3x3-gap"></i> View All Products
                </a>
            </div>
        </div>

        @if(isset($productCategories) && $productCategories->count())
            <!-- Tabs -->
            <ul class="nav nav-pills products-tabs mb-4" id="productTabs" role="tablist">
                @foreach($productCategories as $key => $category)
                    <li class="nav-item" role="presentation">
                        <button 
                            class="nav-link {{ $key == 0 ? 'active' : '' }}" 
                            id="tab-category-{{ $category->id }}" 
                            data-bs-toggle="pill" 
                            data-bs-target="#pane-category-{{ $category->id }}" 
                            type="button" 
                            role="tab"
                        >
                            <i class="bi bi-box-seam me-1"></i> {{ $category->name }}
                        </button>
                    </li>
                @endforeach

                <li class="nav-item ms-auto d-none d-lg-block">
                    <span class="products-note">
                        <i class="bi bi-stars"></i> Best sellers • New launches • Trending picks
                    </span>
                </li>
            </ul>

            <div class="tab-content">
                @foreach($productCategories as $key => $category)
                    @php
                        $categoryProducts = $featuredProducts
                            ->where('category_id', $category->id)
                            ->take(4);
                    @endphp

                    <div 
                        class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" 
                        id="pane-category-{{ $category->id }}" 
                        role="tabpanel" 
                        aria-labelledby="tab-category-{{ $category->id }}"
                    >
                        @if($categoryProducts->count())
                            <div class="row g-4">
                                @foreach($categoryProducts as $product)
                                    <div class="col-md-6 col-lg-3">
                                        <div class="product-card h-100">
                                            <div class="product-media">
                                                @if($product->image)
                                                    <img 
                                                        src="{{ $product->image->getUrl() }}" 
                                                        alt="{{ $product->name }}"
                                                    >
                                                @else
                                                    <img 
                                                        src="https://dummyimage.com/900x650/f2f2f2/111111&text=Product+Image" 
                                                        alt="{{ $product->name }}"
                                                    >
                                                @endif

                                                <span class="product-pill">
                                                    {{ $product->category->name ?? 'Product' }}
                                                </span>

                                                <div class="product-overlay"></div>
                                            </div>

                                            <div class="product-body">
                                                <h5 class="fw-bold mb-1">
                                                    {{ $product->name }}
                                                </h5>

                                                <p class="text-muted small mb-3">
                                                    {{ $product->short_description ?? 'Quality product for everyday use.' }}
                                                </p>

                                                <div class="product-actions">
                                                    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-brand">
                                                        View Details
                                                    </a>

                                                    <a href="{{ route('custom.enquiry') }}?product_id={{ $product->id }}" class="btn btn-sm btn-outline-dark">
                                                        Enquire
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center bg-white rounded-4 p-5">
                                <i class="bi bi-box-seam display-5 text-muted"></i>

                                <h5 class="fw-bold mt-3 mb-1">
                                    No featured products found
                                </h5>

                                <p class="text-muted mb-0">
                                    Add featured products in this category from admin.
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Category CTA banners -->
            <div class="row g-4 mt-5">
                @foreach($productCategories->take(2) as $key => $category)
                    <div class="col-lg-6">
                        <div class="product-banner {{ $key == 0 ? 'product-banner-blue' : 'product-banner-yellow' }}">
                            <div>
                                <div class="product-banner-title">
                                    {{ $category->name }} Range
                                </div>

                                <div class="product-banner-text">
                                    {{ $category->description ?? 'Explore quality products designed for everyday needs.' }}
                                </div>

                                <a href="{{ route('products.index') }}?category={{ $category->slug }}" class="btn {{ $key == 0 ? 'btn-light' : 'btn-dark' }} mt-3">
                                    Explore {{ $category->name }}
                                </a>
                            </div>

                            <i class="bi {{ $key == 0 ? 'bi-droplet-half' : 'bi-heart-pulse' }} product-banner-icon"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center bg-white rounded-4 p-5">
                <i class="bi bi-box-seam display-5 text-muted"></i>

                <h5 class="fw-bold mt-3 mb-1">
                    No products available
                </h5>

                <p class="text-muted mb-0">
                    Products will appear here once added from admin.
                </p>
            </div>
        @endif

    </div>
</section>


<!-- MANUFACTURING (Premium) -->
<section id="mfg" class="mfg-premium section-pad">
    <div class="container">

        <!-- Section Header -->
        <div class="row justify-content-between align-items-end g-3 mb-4">
            <div class="col-lg-7">
                <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
                    <i class="bi bi-gear-wide-connected me-1"></i> Manufacturing &amp; R&amp;D
                </span>

                <h2 class="fw-bold mb-1">
                    Manufacturing Excellence, Backed by Research
                </h2>

                <p class="text-muted mb-0">
                    Built on consistency, safety and performance — with structured quality checks across every stage.
                </p>
            </div>

            <div class="col-lg-5 text-lg-end">
                <a href="{{ route('custom.manufacturing') }}" class="btn btn-brand me-2">
                    <i class="bi bi-building"></i> Explore Manufacturing
                </a>

                <a href="{{ route('certificates.index') }}" class="btn btn-outline-dark">
                    <i class="bi bi-shield-check"></i> Our Quality Promise
                </a>
            </div>
        </div>

        <div class="row align-items-center g-5">
            <!-- LEFT: Process Cards + Accordion -->
            <div class="col-lg-6">

                <!-- Process cards -->
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="mfg-step">
                            <div class="mfg-step-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>

                            <div>
                                <div class="mfg-step-title">
                                    Incoming Material Checks
                                </div>

                                <div class="small text-muted">
                                    Verification of raw materials for safe, consistent formulation.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mfg-step">
                            <div class="mfg-step-icon">
                                <i class="bi bi-activity"></i>
                            </div>

                            <div>
                                <div class="mfg-step-title">
                                    In-Process Monitoring
                                </div>

                                <div class="small text-muted">
                                    Batch-wise monitoring to maintain performance and uniformity.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mfg-step">
                            <div class="mfg-step-icon">
                                <i class="bi bi-patch-check"></i>
                            </div>

                            <div>
                                <div class="mfg-step-title">
                                    Final Quality Assurance
                                </div>

                                <div class="small text-muted">
                                    Final inspection and compliance checks before dispatch.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accordion -->
                <div class="accordion accordion-premium" id="mfgAccordionPremium">

    @forelse($mfgFaqs as $key => $faq)
        <div class="accordion-item">
            <h2 class="accordion-header" id="mfgHeading{{ $key }}">
                <button 
                    class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#mfgCollapse{{ $key }}" 
                    aria-expanded="{{ $key == 0 ? 'true' : 'false' }}"
                >
                    {{ $faq->question }}
                </button>
            </h2>

            <div 
                id="mfgCollapse{{ $key }}" 
                class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" 
                data-bs-parent="#mfgAccordionPremium"
            >
                <div class="accordion-body text-muted">
                    {!! nl2br(e($faq->answer)) !!}
                </div>
            </div>
        </div>
    @empty
        <div class="accordion-item">
            <h2 class="accordion-header" id="mh1">
                <button 
                    class="accordion-button" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#mc1" 
                    aria-expanded="true"
                >
                    Quality Control Process
                </button>
            </h2>

            <div id="mc1" class="accordion-collapse collapse show" data-bs-parent="#mfgAccordionPremium">
                <div class="accordion-body text-muted">
                    Incoming checks, in-process monitoring, and final inspection before dispatch — designed to maintain consistency, safety, and performance.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="mh2">
                <button 
                    class="accordion-button collapsed" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#mc2"
                >
                    R&amp;D and Formulation Improvements
                </button>
            </h2>

            <div id="mc2" class="accordion-collapse collapse" data-bs-parent="#mfgAccordionPremium">
                <div class="accordion-body text-muted">
                    Continuous enhancements for better results with eco-friendly choices — improving usability and effectiveness across product lines.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="mh3">
                <button 
                    class="accordion-button collapsed" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#mc3"
                >
                    Responsible Sourcing &amp; Sustainability
                </button>
            </h2>

            <div id="mc3" class="accordion-collapse collapse" data-bs-parent="#mfgAccordionPremium">
                <div class="accordion-body text-muted">
                    We emphasize responsible sourcing and smarter formulation choices to align with sustainability goals.
                </div>
            </div>
        </div>
    @endforelse

</div>
            </div>

            <!-- RIGHT: Image + Floating Stats -->
            <div class="col-lg-6">
                <div class="mfg-media">
                    @if($homeManufactureSection && $homeManufactureSection->image)
                        <img
                            src="{{ $homeManufactureSection->image->getUrl() }}"
                            class="img-fluid mfg-img"
                            alt="{{ $homeManufactureSection->title ?? 'Manufacturing Facility' }}"
                        >
                    @else
                        <img
                            src="{{ asset('assets/img/home_Manufacturing.png') }}"
                            class="img-fluid mfg-img"
                            alt="Manufacturing Facility"
                        >
                    @endif

                    <div class="mfg-float mfg-float-1">
                        <i class="bi bi-shield-check"></i>
                        <div>
                            <div class="fw-bold">GMP</div>
                            <div class="small text-muted">Certified Unit</div>
                        </div>
                    </div>

                    <div class="mfg-float mfg-float-2">
                        <i class="bi bi-award"></i>
                        <div>
                            <div class="fw-bold">ISO</div>
                            <div class="small text-muted">Quality Systems</div>
                        </div>
                    </div>

                    <div class="mfg-float mfg-float-3">
                        <i class="bi bi-lightbulb"></i>
                        <div>
                            <div class="fw-bold">R&amp;D</div>
                            <div class="small text-muted">Research Driven</div>
                        </div>
                    </div>
                </div>

                @if($homeManufactureSection)
                    <div class="text-center mt-3">
                        <div class="small text-muted">
                            {{ $homeManufactureSection->title }}
                        </div>
                    </div>
                @endif

                <!-- Bottom mini strip -->
                <div class="row g-3 mt-3">
                    <div class="col-6">
                        <div class="mfg-mini">
                            <div class="mfg-mini-num">3-Step</div>
                            <div class="mfg-mini-text">QC Framework</div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mfg-mini">
                            <div class="mfg-mini-num">Batch</div>
                            <div class="mfg-mini-text">Monitoring</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>


<!-- SUSTAINABILITY (Premium) -->
<section id="green" class="green-premium section-pad bg-soft">
    <div class="container">

        <div class="row align-items-center g-5 mb-4">
            <!-- Left content -->
            <div class="col-lg-6">
                <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
                    <i class="bi bi-leaf me-1"></i> Sustainability • Go Green
                </span>

                <h2 class="fw-bold mb-3">
                    {{ $homeSustainabilitySection->title ?? 'Practical Steps for a Cleaner Home & a Cleaner Planet' }}
                </h2>

                <p class="text-muted mb-4">
                    {!! nl2br(e($homeSustainabilitySection->description ?? 'Our sustainability approach focuses on safer formulations, responsible choices, and better everyday habits — without compromising product performance.')) !!}
                </p>

                <!-- mini highlights -->
                <div class="row g-3">
                    <div class="col-6">
                        <div class="green-mini">
                            <div class="green-mini-icon">
                                <i class="bi bi-recycle"></i>
                            </div>

                            <div>
                                <div class="fw-bold">Eco Choices</div>
                                <div class="small text-muted">Smarter ingredients</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="green-mini">
                            <div class="green-mini-icon">
                                <i class="bi bi-droplet"></i>
                            </div>

                            <div>
                                <div class="fw-bold">Water Friendly</div>
                                <div class="small text-muted">Efficient rinsing</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="mt-4 d-flex gap-2 flex-wrap">
                    <a href="{{ route('products.index') }}" class="btn btn-brand btn-lg green-btn">
                        <i class="bi bi-box-seam"></i> Explore Products
                    </a>

                    <a href="{{ route('custom.enquiry') }}" class="btn btn-outline-dark btn-lg green-btn">
                        <i class="bi bi-chat-dots"></i> Ask About Go Green
                    </a>
                </div>
            </div>

            <!-- Right image -->
            <div class="col-lg-6">
                <div class="green-media">
                    @if($homeSustainabilitySection && $homeSustainabilitySection->image)
                        <img
                            src="{{ $homeSustainabilitySection->image->getUrl() }}"
                            class="img-fluid green-img"
                            alt="{{ $homeSustainabilitySection->title ?? 'Sustainability & Nature' }}"
                        >
                    @else
                        <img
                            src="{{ asset('assets/img/home_ Sustainability.png') }}"
                            class="img-fluid green-img"
                            alt="Sustainability & Nature"
                        >
                    @endif

                    <div class="green-badge">
                        <i class="bi bi-tree"></i>
                        <div>
                            <div class="fw-bold">Go Green Mission</div>
                            <div class="small text-muted">Responsible by design</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pillars -->
       <div class="row g-4 mt-2">
      <div class="col-md-4">
        <div class="green-card h-100">
          <div class="green-card-icon"><i class="bi bi-recycle"></i></div>
          <h5 class="fw-bold mb-2">Eco Formulations</h5>
          <p class="text-muted small mb-0">
            Better chemistry choices aligned with environmental responsibility while maintaining performance.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="green-card h-100">
          <div class="green-card-icon"><i class="bi bi-droplet-half"></i></div>
          <h5 class="fw-bold mb-2">Water Friendly</h5>
          <p class="text-muted small mb-0">
            Designed to work effectively with efficient rinsing & usage — practical for everyday households.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="green-card h-100">
          <div class="green-card-icon"><i class="bi bi-people"></i></div>
          <h5 class="fw-bold mb-2">Green Mindset</h5>
          <p class="text-muted small mb-0">
            Encouraging responsible daily choices across families, stores, and distribution partners.
          </p>
        </div>
      </div>
    </div>

        <!-- Bottom CTA strip -->
        <div class="green-strip mt-5">
            <div>
                <div class="fw-bold green-strip-title">
                    Want to partner with a Go Green brand?
                </div>

                <div class="text-muted small">
                    Join our distribution network and promote cleaner living across India.
                </div>
            </div>

            <a href="{{ route('custom.investor') }}" class="btn btn-brand">
                <i class="bi bi-people"></i> Become a Partner
            </a>
        </div>

    </div>
</section>


<!-- CERTIFICATIONS (Premium) -->
<section id="certs" class="certs-premium section-pad">
  <div class="container">

    <div class="row align-items-center g-5">
      <!-- Left -->
      <div class="col-lg-6">
        <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
          <i class="bi bi-patch-check me-1"></i> Certifications & Compliance
        </span>

        <h2 class="fw-bold mb-3">
          Certified & Trusted for <span class="text-brand">Quality</span> and <span class="text-brand">Consistency</span>
        </h2>

        <p class="text-muted mb-4">
          Our systems follow GMP & ISO aligned practices to support safe manufacturing, consistent batches,
          and reliable performance across product lines.
        </p>

        <!-- Trust metrics -->
        <div class="row g-3">
          <div class="col-6">
            <div class="cert-stat">
              <div class="cert-stat-icon"><i class="bi bi-shield-check"></i></div>
              <div>
                <div class="fw-bold">GMP</div>
                <div class="small text-muted">Certified Unit</div>
              </div>
            </div>
          </div>

          <div class="col-6">
            <div class="cert-stat">
              <div class="cert-stat-icon"><i class="bi bi-award"></i></div>
              <div>
                <div class="fw-bold">ISO</div>
                <div class="small text-muted">Quality Systems</div>
              </div>
            </div>
          </div>

          <div class="col-6">
            <div class="cert-stat">
              <div class="cert-stat-icon"><i class="bi bi-clipboard-check"></i></div>
              <div>
                <div class="fw-bold">QC</div>
                <div class="small text-muted">Batch Monitoring</div>
              </div>
            </div>
          </div>

          <div class="col-6">
            <div class="cert-stat">
              <div class="cert-stat-icon"><i class="bi bi-graph-up-arrow"></i></div>
              <div>
                <div class="fw-bold">Consistency</div>
                <div class="small text-muted">Standard Processes</div>
              </div>
            </div>
          </div>
        </div>

        <!-- CTA -->
        <div class="mt-4 d-flex gap-2 flex-wrap">
          <a href="{{ route('custom.enquiry') }}" class="btn btn-brand btn-lg cert-btn">
            <i class="bi bi-chat-dots"></i> Request Certificates
          </a>
          <a href="{{ route('certificates.index') }}" class="btn btn-outline-dark btn-lg cert-btn">
            <i class="bi bi-download"></i> Download Brochure
          </a>
        </div>
      </div>

      <!-- Right: Certificate slider -->
      <div class="col-lg-6">
    <div class="certs-media soft-card shadow-soft">
        <div 
            id="certsSlider" 
            class="carousel slide" 
            data-bs-ride="carousel" 
            data-bs-interval="4000"
        >
            <div class="carousel-inner rounded-xxl">

                @forelse($certificateImages as $key => $certificate)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="cert-slide">
                            <img
                                src="{{ $certificate->file_url }}"
                                class="cert-img"
                                alt="{{ $certificate->title ?? 'Certificate Image' }}"
                            >

                            <div class="cert-slide-overlay"></div>

                            <div class="cert-slide-caption">
                                <div class="cert-chip">
                                    <i class="bi bi-patch-check"></i>
                                    {{ $certificate->title ?? 'Certificate' }}
                                </div>

                                <div class="small text-white-50">
                                    {{ $certificate->short_description ?? 'Manufacturing & quality aligned processes' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <div class="cert-slide">
                            <img
                                src="{{ asset('assets/img/GMP Compliance.png') }}"
                                class="cert-img"
                                alt="GMP Compliance"
                            >

                            <div class="cert-slide-overlay"></div>

                            <div class="cert-slide-caption">
                                <div class="cert-chip">
                                    <i class="bi bi-patch-check"></i> GMP Compliance
                                </div>

                                <div class="small text-white-50">
                                    Manufacturing & quality aligned processes
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse

            </div>

            @if($certificateImages->count() > 1)
                <!-- Controls -->
                <button 
                    class="carousel-control-prev" 
                    type="button" 
                    data-bs-target="#certsSlider" 
                    data-bs-slide="prev"
                >
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button 
                    class="carousel-control-next" 
                    type="button" 
                    data-bs-target="#certsSlider" 
                    data-bs-slide="next"
                >
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <!-- Dots -->
                <div class="carousel-indicators cert-dots">
                    @foreach($certificateImages as $key => $certificate)
                        <button 
                            type="button" 
                            data-bs-target="#certsSlider" 
                            data-bs-slide-to="{{ $key }}" 
                            class="{{ $key == 0 ? 'active' : '' }}" 
                            aria-label="Slide {{ $key + 1 }}"
                        ></button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Certification logos strip -->
    <div class="cert-logos mt-3">
        <div class="cert-logo">GMP</div>
        <div class="cert-logo">ISO</div>
        <div class="cert-logo">QC</div>
        <div class="cert-logo">R&amp;D</div>
    </div>
</div>
    </div>

  </div>
</section>



@php
    $phone = $siteSetting->phone ?? '+91XXXXXXXXXX';
    $whatsappNumber = $siteSetting->whatsapp_number ?? $phone;
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);

    if ($whatsappClean && strlen($whatsappClean) === 10) {
        $whatsappClean = '91' . $whatsappClean;
    }
@endphp
<!-- PARTNER CTA (Premium) -->
<section id="partner" class="partner-premium section-pad">
    <div class="partner-bg"></div>

    <div class="container position-relative">
        <div class="row  g-5">

            <!-- LEFT: Content -->
            <div class="col-lg-7 text-white">
                <span class="partner-pill">
                    <i class="bi bi-people me-1"></i> Investor / Distributor Opportunity
                </span>

                <h2 class="partner-title fw-bold mt-3 mb-3">
                    Partner With Raj Yog & Scale a 
                    <span class="partner-highlight">Go Green</span> Brand
                </h2>

                <p class="partner-sub mb-4">
                    Join our distribution network and promote eco-friendly home & personal care products across India —
                    backed by quality systems and consistent supply.
                </p>

                <!-- Benefits -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="partner-benefit">
                            <i class="bi bi-box-seam"></i>

                            <div>
                                <div class="fw-bold">Strong Product Range</div>
                                <div class="small text-white-50">Home Care + Personal Care essentials</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="partner-benefit">
                            <i class="bi bi-truck"></i>

                            <div>
                                <div class="fw-bold">Consistent Supply</div>
                                <div class="small text-white-50">Reliable batches & dispatch planning</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="partner-benefit">
                            <i class="bi bi-shield-check"></i>

                            <div>
                                <div class="fw-bold">Quality & Compliance</div>
                                <div class="small text-white-50">GMP • ISO aligned processes</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="partner-benefit">
                            <i class="bi bi-megaphone"></i>

                            <div>
                                <div class="fw-bold">Brand Support</div>
                                <div class="small text-white-50">Marketing guidance & product collateral</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trust strip -->
                <div class="partner-trust mt-4">
                    <div class="partner-trust-item">
                        <i class="bi bi-patch-check"></i> GMP Certified
                    </div>

                    <div class="partner-trust-item">
                        <i class="bi bi-award"></i> ISO Standards
                    </div>

                    <div class="partner-trust-item">
                        <i class="bi bi-clipboard-check"></i> QC Monitoring
                    </div>
                </div>
            </div>

            <!-- RIGHT: Premium form -->
            <div class="col-lg-5">
                <div class="partner-card">
    <div class="partner-card-head">
        <div class="fw-bold">Become a Distributor</div>
        <div class="small text-muted">We’ll call you within 24–48 hours.</div>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4 mx-3 mt-3 mb-0">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger rounded-4 mx-3 mt-3 mb-0">
            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="partner-form" action="{{ route('custom.enquiry.submit') }}" method="POST">
        @csrf

        <input type="hidden" name="subject" value="Distributor / Partnership Enquiry">

        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Full Name *</label>

                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Enter your name"
                    required
                >

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Phone Number *</label>

                <input 
                    type="text" 
                    name="phone" 
                    value="{{ old('phone') }}" 
                    class="form-control @error('phone') is-invalid @enderror" 
                    placeholder="Enter phone number"
                    required
                >

                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Email</label>

                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="Enter email address"
                >

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Message *</label>

                <textarea 
                    name="message" 
                    rows="5" 
                    class="form-control @error('message') is-invalid @enderror" 
                    placeholder="Write your message..."
                    required
                >{{ old('message', 'I am interested in distributor / partnership opportunity. Please contact me with details.') }}</textarea>

                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-brand w-100 btn-lg partner-submit">
                    <i class="bi bi-send"></i> Submit Enquiry
                </button>
            </div>

            <div class="col-12">
                <div class="partner-note">
                    By submitting, you agree to be contacted by our team for partnership discussion.
                </div>
            </div>
        </div>
    </form>
</div>

                <!-- quick contact buttons -->
                <div class="d-flex gap-2 mt-3 flex-wrap">
                    @if($phone)
                        <a href="tel:{{ $phone }}" class="btn btn-light partner-quick">
                            <i class="bi bi-telephone"></i> Call Now
                        </a>
                    @endif

                    @if($whatsappClean)
                        <a href="https://wa.me/{{ $whatsappClean }}" target="_blank" class="btn btn-outline-light partner-quick">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>


@php
    $phone = $siteSetting->phone ?? '+91XXXXXXXXXX';
    $email = $siteSetting->email ?? 'info@rajyogreen.com';
    $address = $siteSetting->address ?? 'Gujarat, India';
    $mapUrl = $siteSetting->map_url ?? 'https://www.google.com/maps?q=Gujarat%20India&output=embed';

    $whatsappNumber = $siteSetting->whatsapp_number ?? $phone;
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);

    if ($whatsappClean && strlen($whatsappClean) === 10) {
        $whatsappClean = '91' . $whatsappClean;
    }
@endphp

<!-- CONTACT (Premium) -->
<section id="contact" class="contact-premium section-pad">
    <div class="container">

        <!-- Header -->
        <div class="row justify-content-between align-items-end g-3 mb-4">
            <div class="col-lg-7">
                <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
                    <i class="bi bi-chat-dots me-1"></i> Contact
                </span>

                <h2 class="fw-bold mb-1">
                    Let’s Talk
                </h2>

                <p class="text-muted mb-0">
                    We’ll respond within 24–48 hours for partnership & product inquiries.
                </p>
            </div>

            <div class="col-lg-5 text-lg-end">
                <div class="contact-quick">
                    @if($phone)
                        <a href="tel:{{ $phone }}" class="contact-quick-btn">
                            <i class="bi bi-telephone"></i> Call
                        </a>
                    @endif

                    @if($whatsappClean)
                        <a href="https://wa.me/{{ $whatsappClean }}" target="_blank" class="contact-quick-btn">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                    @endif

                    @if($email)
                        <a href="mailto:{{ $email }}" class="contact-quick-btn">
                            <i class="bi bi-envelope"></i> Email
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="row g-4 align-items-start">
            <!-- LEFT: Contact info cards -->
            <div class="col-lg-5">
                <div class="contact-info">

                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>

                        <div>
                            <div class="fw-bold">Office Address</div>
                            <div class="small text-muted">
                                {{ $address }}
                            </div>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <i class="bi bi-envelope"></i>
                        </div>

                        <div>
                            <div class="fw-bold">Email</div>
                            <div class="small text-muted">
                                {{ $email }}
                            </div>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <i class="bi bi-telephone"></i>
                        </div>

                        <div>
                            <div class="fw-bold">Phone</div>
                            <div class="small text-muted">
                                {{ $phone }}
                            </div>
                        </div>
                    </div>

                    @if($siteSetting?->alternate_phone)
                        <div class="contact-card">
                            <div class="contact-card-icon">
                                <i class="bi bi-phone"></i>
                            </div>

                            <div>
                                <div class="fw-bold">Alternate Phone</div>
                                <div class="small text-muted">
                                    {{ $siteSetting->alternate_phone }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <i class="bi bi-clock"></i>
                        </div>

                        <div>
                            <div class="fw-bold">Working Hours</div>
                            <div class="small text-muted">
                                Mon–Sat • 10:00 AM – 6:00 PM
                            </div>
                        </div>
                    </div>

                    <!-- trust note -->
                    <div class="contact-note mt-3">
                        <i class="bi bi-shield-check"></i>

                        <div>
                            <div class="fw-bold">Reliable Response</div>
                            <div class="small text-muted">
                                Dedicated support for distributors & business partners.
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- RIGHT: Premium form -->
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <div class="contact-form-head">
                        <div class="fw-bold">Send us a Message</div>
                        <div class="small text-muted">
                            Tell us what you’re looking for — we’ll get back soon.
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success rounded-4 mx-3 mt-3 mb-0">
                            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger rounded-4 mx-3 mt-3 mb-0">
                            <strong>Please fix the following errors:</strong>

                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="contact-form-body" action="{{ route('custom.enquiry.submit') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Name *</label>

                                <input 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    type="text" 
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Enter your name"
                                    required
                                >

                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone *</label>

                                <input 
                                    class="form-control @error('phone') is-invalid @enderror" 
                                    type="text" 
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    placeholder="Enter phone number"
                                    required
                                >

                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email</label>

                                <input 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    type="email" 
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Enter email"
                                >

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Enquiry Type</label>

                                <select 
                                    class="form-select @error('subject') is-invalid @enderror" 
                                    name="subject"
                                >
                                    <option value="">Select enquiry type</option>
                                    <option value="Distributor / Partnership" {{ old('subject') == 'Distributor / Partnership' ? 'selected' : '' }}>
                                        Distributor / Partnership
                                    </option>
                                    <option value="Product Information" {{ old('subject') == 'Product Information' ? 'selected' : '' }}>
                                        Product Information
                                    </option>
                                    <option value="Manufacturing / R&D" {{ old('subject') == 'Manufacturing / R&D' ? 'selected' : '' }}>
                                        Manufacturing / R&D
                                    </option>
                                    <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>
                                        Other
                                    </option>
                                </select>

                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Message *</label>

                                <textarea 
                                    class="form-control @error('message') is-invalid @enderror" 
                                    name="message"
                                    rows="4" 
                                    placeholder="Write your message..."
                                    required
                                >{{ old('message') }}</textarea>

                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 d-flex gap-2 flex-wrap">
                                <button type="submit" class="btn btn-brand btn-lg flex-grow-1 contact-submit">
                                    <i class="bi bi-send"></i> Send Message
                                </button>

                                @if($whatsappClean)
                                    <a href="https://wa.me/{{ $whatsappClean }}" target="_blank" class="btn btn-outline-dark btn-lg">
                                        <i class="bi bi-whatsapp"></i> WhatsApp
                                    </a>
                                @endif
                            </div>

                            <div class="col-12">
                                <div class="contact-privacy">
                                    By sending this message, you agree to be contacted by our team.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- Map -->
        @if(!empty($siteSetting->map_url))
    <div class="contact-map mt-5">
        <iframe
            src="{{ $siteSetting->map_url }}"
            width="100%"
            height="420"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
@endif

    </div>
</section>



@endsection