@extends('custom.master')

@section('content')


@php 
 $siteSetting = App\Models\SiteSetting::first();
@endphp

<!-- HERO (Premium + Product Slider) -->
<!-- HERO SECTION -->
<section id="home" class="hero hero-premium section-pad">
    <div class="hero-bg"></div>

    <div class="container position-relative">
        <div class="hero-jquery-slider">

            @forelse($heroSections as $key => $heroSection)
                <div class="hero-slide-item {{ $key == 0 ? 'active' : '' }}">
                    <div class="row align-items-center g-5">

                        <!-- LEFT CONTENT -->
                        <div class="col-lg-6">
                            <div class="hero-kicker">
                                <span class="badge badge-soft rounded-pill px-3 py-2">
                                    <i class="bi bi-leaf me-1"></i>
                                    {{ $heroSection->subtitle ?? 'Green Today for a Better Tomorrow' }}
                                </span>
                            </div>

                            <h1 class="hero-title fw-bold mb-3">
                                {!! $heroSection->title ?? 'Eco-Friendly <span class="text-brand">Home</span> Care Products That Perform.' !!}
                            </h1>

                            <p class="hero-sub text-muted mb-4">
                                {{ $heroSection->description ?? 'Research-backed formulations, safer chemistry, and everyday performance — built for modern Indian homes.' }}
                            </p>

                            <div class="d-flex flex-wrap gap-2">
                                @if($heroSection->button_text)
                                    <a href="{{ $heroSection->button_link ?? '#products' }}" class="btn btn-brand btn-lg hero-btn">
                                        <i class="bi bi-bag"></i> {{ $heroSection->button_text }}
                                    </a>
                                @endif

                                @if($heroSection->secondary_button_text)
                                    <a href="{{ $heroSection->secondary_button_link ?? '#partner' }}" class="btn btn-outline-dark btn-lg hero-btn-outline">
                                        <i class="bi bi-people"></i> {{ $heroSection->secondary_button_text }}
                                    </a>
                                @endif
                            </div>

                            <!-- Static Trust Strip -->
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

                            <!-- Static Feature Cards -->
                            <div class="row mt-4 g-3">
                                <div class="col-sm-4">
                                    <div class="hero-mini-card">
                                        <div class="hero-mini-icon">
                                            <i class="bi bi-heart-pulse"></i>
                                        </div>
                                        <div class="fw-bold">Gentle</div>
                                        <div class="small text-muted">Daily safe usage</div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="hero-mini-card">
                                        <div class="hero-mini-icon">
                                            <i class="bi bi-stars"></i>
                                        </div>
                                        <div class="fw-bold">Powerful</div>
                                        <div class="small text-muted">High performance</div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="hero-mini-card">
                                        <div class="hero-mini-icon">
                                            <i class="bi bi-graph-up-arrow"></i>
                                        </div>
                                        <div class="fw-bold">Scalable</div>
                                        <div class="small text-muted">Distributor network</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT IMAGE -->
                        <div class="col-lg-6">
                            <div class="hero-slider-wrap soft-card shadow-soft">
                                <div class="hero-image-box">

                                    @if($heroSection->image)
                                        <img 
                                            src="{{ $heroSection->image->getUrl() }}" 
                                            class="hero-main-img" 
                                            alt="{{ strip_tags($heroSection->title) }}"
                                        >
                                    @else
                                        <img 
                                            src="{{ asset('assets/img/hero_one.png') }}" 
                                            class="hero-main-img" 
                                            alt="Rajyog Green"
                                        >
                                    @endif

                                    <div class="hero-image-overlay"></div>

                                    <div class="hero-image-caption">
                                        <span class="hero-chip">
                                            Rajyog Green
                                        </span>

                                        <h5 class="fw-bold mb-1">
                                            {!! $heroSection->title ?? 'Premium Home Care Products' !!}
                                        </h5>

                                        <p class="small mb-0 text-white-50">
                                            {{ $heroSection->subtitle ?? 'Green Today for a Better Tomorrow' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Static Small Quick Stats -->
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
            @empty
                <div class="hero-slide-item active">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6">
                            <span class="badge badge-soft rounded-pill px-3 py-2">
                                <i class="bi bi-leaf me-1"></i> Green Today for a Better Tomorrow
                            </span>

                            <h1 class="hero-title fw-bold mb-3 mt-3">
                                Eco-Friendly <span class="text-brand">Home</span> Care Products That Perform.
                            </h1>

                            <p class="hero-sub text-muted mb-4">
                                Research-backed formulations, safer chemistry, and everyday performance — built for modern Indian homes.
                            </p>

                            <a href="#products" class="btn btn-brand btn-lg hero-btn">
                                <i class="bi bi-bag"></i> Explore Products
                            </a>
                        </div>

                        <div class="col-lg-6">
                            <div class="hero-slider-wrap soft-card shadow-soft">
                                <div class="hero-image-box">
                                    <img src="{{ asset('assets/img/hero_one.png') }}" class="hero-main-img" alt="Rajyog Green">
                                    <div class="hero-image-overlay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse

            @if($heroSections->count() > 1)
                <!-- Slider Arrows -->
                <button type="button" class="hero-slider-btn hero-prev">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <button type="button" class="hero-slider-btn hero-next">
                    <i class="bi bi-chevron-right"></i>
                </button>

                <!-- Dots -->
                <div class="hero-slider-dots">
                    @foreach($heroSections as $key => $heroSection)
                        <button 
                            type="button" 
                            class="hero-dot {{ $key == 0 ? 'active' : '' }}" 
                            data-slide="{{ $key }}">
                        </button>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</section>





@endsection