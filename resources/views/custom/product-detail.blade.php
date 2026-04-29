@extends('custom.master')

@section('content')

@php
    $mainImage = $product->image
        ? $product->image->getUrl()
        : asset('assets/img/default-product.png');

    $galleryImages = collect();

    if ($product->image) {
        $galleryImages->push($product->image);
    }

    if ($product->images && $product->images->count()) {
        foreach ($product->images as $image) {
            $galleryImages->push($image);
        }
    }

    $features = $product->features
        ? preg_split('/\r\n|\r|\n/', $product->features)
        : [];

    $ingredients = $product->ingredients
        ? preg_split('/\r\n|\r|\n/', $product->ingredients)
        : [];
@endphp

<!-- BREADCRUMB -->
<section class="pd-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('products.index') }}">Products</a>
                </li>

                @if($product->category)
                    <li class="breadcrumb-item">
                        {{ $product->category->name }}
                    </li>
                @endif

                <li class="breadcrumb-item active" aria-current="page">
                    {{ $product->name }}
                </li>
            </ol>
        </nav>
    </div>
</section>

<!-- PRODUCT DETAIL -->
<section class="pd-wrap section-pad bg-white">
    <div class="container">
        <div class="row g-4 align-items-start">

            <!-- LEFT MAIN CONTENT -->
            <div class="col-lg-8">
                <div class="row g-4">

                    <!-- Gallery -->
                    <div class="col-lg-6">
                        <div class="pd-gallery">

                            <div id="pdGallery" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4500">
                                <div class="carousel-inner">

                                    @forelse($galleryImages as $key => $media)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img
                                                src="{{ $media->getUrl() }}"
                                                class="pd-main-img"
                                                alt="{{ $product->name }}"
                                            >
                                        </div>
                                    @empty
                                        <div class="carousel-item active">
                                            <img
                                                src="{{ asset('assets/img/default-product.png') }}"
                                                class="pd-main-img"
                                                alt="{{ $product->name }}"
                                            >
                                        </div>
                                    @endforelse

                                </div>

                                @if($galleryImages->count() > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#pdGallery" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>

                                    <button class="carousel-control-next" type="button" data-bs-target="#pdGallery" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>

                                    <div class="carousel-indicators pd-dots">
                                        @foreach($galleryImages as $key => $media)
                                            <button
                                                type="button"
                                                data-bs-target="#pdGallery"
                                                data-bs-slide-to="{{ $key }}"
                                                class="{{ $key == 0 ? 'active' : '' }}"
                                                aria-label="Slide {{ $key + 1 }}">
                                            </button>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            @if($galleryImages->count() > 1)
                                <div class="pd-thumbs">
                                    @foreach($galleryImages as $key => $media)
                                        <button
                                            class="pd-thumb {{ $key == 0 ? 'active' : '' }}"
                                            type="button"
                                            data-bs-target="#pdGallery"
                                            data-bs-slide-to="{{ $key }}"
                                            aria-label="Thumb {{ $key + 1 }}"
                                        >
                                            <img src="{{ $media->getUrl() }}" alt="{{ $product->name }}">
                                        </button>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>

                    <!-- Product content -->
                    <div class="col-lg-6">
                        <div class="pd-head">

                            <div class="pd-kicker">
                                @if($product->category)
                                    <span class="pd-chip">
                                        <i class="bi bi-droplet-half"></i> {{ $product->category->name }}
                                    </span>
                                @endif

                                <span class="pd-chip pd-chip-green">
                                    <i class="bi bi-recycle"></i> Go Green
                                </span>

                                @if($product->is_featured)
                                    <span class="pd-chip pd-chip-best">
                                        <i class="bi bi-stars"></i> Featured
                                    </span>
                                @endif
                            </div>

                            <h1 class="pd-title fw-bold mb-2">
                                {{ $product->name }}
                            </h1>

                            @if($product->short_description)
                                <p class="text-muted mb-3">
                                    {{ $product->short_description }}
                                </p>
                            @endif

                           @if($product->description)
    <div class="pd-highlights">
        <p class="text-muted mb-0">
            {!! $product->description !!}
        </p>
    </div>
@elseif($product->short_description)
    <div class="pd-highlights">
        <p class="text-muted mb-0">
            {{ $product->short_description }}
        </p>
    </div>
@endif

                            @if($product->pack_size)
                                <div class="pd-variants mt-4">
                                    <div class="fw-bold mb-2">Available Pack Size</div>

                                    <div class="pd-variant-chips">
                                        <span class="pd-variant active">
                                            {{ $product->pack_size }}
                                        </span>
                                    </div>

                                    <div class="small text-muted mt-2">
                                        Pack sizes may vary by region and availability.
                                    </div>
                                </div>
                            @endif

                            @if($product->price)
                                <div class="pd-price mt-4">
                                    <div class="small text-muted">Price</div>
                                    <div class="h4 fw-bold mb-0">
                                        ₹{{ number_format($product->price, 2) }}
                                    </div>
                                </div>
                            @endif

                            <div class="d-flex flex-wrap gap-2 mt-4">
                                <a href="{{ url('/#contact') }}?product={{ urlencode($product->name) }}" class="btn btn-brand">
                                    <i class="bi bi-chat-dots"></i> Enquire Now
                                </a>

                                <a href="{{ route('products.index') }}" class="btn btn-outline-dark">
                                    <i class="bi bi-arrow-left"></i> Back to Products
                                </a>
                            </div>

                        </div>
                    </div>

                    <!-- Tabs -->
                    <div class="col-12">
                        <div class="pd-tabs">

                            <ul class="nav nav-pills pd-tabs-nav" id="pdTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="t-desc" data-bs-toggle="pill" data-bs-target="#p-desc" type="button" role="tab">
                                        <i class="bi bi-card-text me-1"></i> Description
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="t-spec" data-bs-toggle="pill" data-bs-target="#p-spec" type="button" role="tab">
                                        <i class="bi bi-list-check me-1"></i> Specifications
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="t-usage" data-bs-toggle="pill" data-bs-target="#p-usage" type="button" role="tab">
                                        <i class="bi bi-lightbulb me-1"></i> Usage
                                    </button>
                                </li>

                                @if($ingredients && count($ingredients))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="t-ing" data-bs-toggle="pill" data-bs-target="#p-ing" type="button" role="tab">
                                            <i class="bi bi-flask me-1"></i> Ingredients
                                        </button>
                                    </li>
                                @endif
                            </ul>

                            <div class="tab-content pd-tabs-content">

                                <!-- Description -->
                                <div class="tab-pane fade show active" id="p-desc" role="tabpanel" aria-labelledby="t-desc">
                                    <div class="pd-panel">
                                        <h5 class="fw-bold mb-2">Product Overview</h5>

                                        <p class="text-muted mb-0">
                                            {!! $product->description ?? $product->short_description ?? 'Product information will be updated soon.' !!}
                                        </p>

                                        <div class="pd-divider"></div>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="pd-mini">
                                                    <i class="bi bi-shield-check"></i>
                                                    <div>
                                                        <div class="fw-bold">Quality Checks</div>
                                                        <div class="small text-muted">Batch monitoring & QC</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="pd-mini">
                                                    <i class="bi bi-recycle"></i>
                                                    <div>
                                                        <div class="fw-bold">Go Green Mindset</div>
                                                        <div class="small text-muted">Responsible approach</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Specifications -->
                                <div class="tab-pane fade" id="p-spec" role="tabpanel" aria-labelledby="t-spec">
                                    <div class="pd-panel">
                                        <h5 class="fw-bold mb-3">Specifications</h5>

                                        <div class="table-responsive">
                                            <table class="table pd-spec-table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Category</th>
                                                        <td>{{ $product->category->name ?? 'General' }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Product Name</th>
                                                        <td>{{ $product->name }}</td>
                                                    </tr>

                                                    @if($product->pack_size)
                                                        <tr>
                                                            <th scope="row">Pack Size</th>
                                                            <td>{{ $product->pack_size }}</td>
                                                        </tr>
                                                    @endif

                                                    @if($product->price)
                                                        <tr>
                                                            <th scope="row">Price</th>
                                                            <td>₹{{ number_format($product->price, 2) }}</td>
                                                        </tr>
                                                    @endif

                                                    @if($product->features)
                                                        <tr>
                                                            <th scope="row">Features</th>
                                                            <td>{!! $product->features !!}</td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        <th scope="row">Recommended Use</th>
                                                        <td>{{ $product->usage_instruction ? 'As mentioned in usage instructions' : 'Daily use as required' }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Quality</th>
                                                        <td>GMP & ISO aligned practices</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                                <!-- Usage -->
                                <div class="tab-pane fade" id="p-usage" role="tabpanel" aria-labelledby="t-usage">
                                    <div class="pd-panel">
                                        <h5 class="fw-bold mb-2">How to Use</h5>

                                        <p class="text-muted mb-0">
                                            {!! $product->usage_instruction ?? 'Usage instructions will be updated soon.' !!}
                                        </p>
                                    </div>
                                </div>

                                <!-- Ingredients -->
                                @if($ingredients && count($ingredients))
                                    <div class="tab-pane fade" id="p-ing" role="tabpanel" aria-labelledby="t-ing">
                                        <div class="pd-panel">
                                            <h5 class="fw-bold mb-3">Ingredients</h5>

                                            <ul class="pd-list mb-0">
                                                @foreach($ingredients as $ingredient)
                                                    @if(trim($ingredient))
                                                        <li>{!! trim($ingredient) !!}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- RIGHT SIDEBAR -->
            <div class="col-lg-4">
                <div class="pd-side sticky-lg-top">

                    @php
    $phone = $siteSetting->phone ?? '+91XXXXXXXXXX';
    $whatsappNumber = $siteSetting->whatsapp_number ?? $phone;
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);

    if ($whatsappClean && strlen($whatsappClean) === 10) {
        $whatsappClean = '91' . $whatsappClean;
    }
@endphp

<div class="pd-enquiry-card">
    <div class="pd-enquiry-head">
        <div class="fw-bold">Quick Enquiry</div>
        <div class="small text-muted">We’ll respond within 24–48 hours.</div>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4 mb-3">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
        </div>
    @endif

    <form class="pd-enquiry-form" action="{{ route('custom.enquiry.submit') }}" method="POST">
        @csrf

        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="mb-3">
            <label class="form-label">Your Name *</label>
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

        <div class="mb-3">
            <label class="form-label">Phone *</label>
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

        <div class="mb-3">
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

        <div class="mb-3">
            <label class="form-label">Enquiry Type</label>
            <select name="subject" class="form-select @error('subject') is-invalid @enderror">
                <option value="">Choose enquiry type</option>
                <option value="Product Information" {{ old('subject', 'Product Information') == 'Product Information' ? 'selected' : '' }}>
                    Product Information
                </option>
                <option value="Distributor / Partnership" {{ old('subject') == 'Distributor / Partnership' ? 'selected' : '' }}>
                    Distributor / Partnership
                </option>
                <option value="Bulk Order" {{ old('subject') == 'Bulk Order' ? 'selected' : '' }}>
                    Bulk Order
                </option>
                <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>
                    Other
                </option>
            </select>

            @error('subject')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Message *</label>
            <textarea 
                name="message" 
                class="form-control @error('message') is-invalid @enderror" 
                rows="3" 
                placeholder="Write your message..."
                required
            >{{ old('message', 'I am interested in ' . $product->name . '. Please share more details.') }}</textarea>

            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-brand btn-lg w-100">
            <i class="bi bi-send"></i> Send Enquiry
        </button>

        <div class="pd-enquiry-divider"></div>

        <div class="pd-enquiry-quick">
            @if($phone)
                <a href="tel:{{ $phone }}" class="pd-qbtn">
                    <i class="bi bi-telephone"></i> Call
                </a>
            @endif

            @if($whatsappClean)
                <a href="https://wa.me/{{ $whatsappClean }}" target="_blank" class="pd-qbtn pd-qbtn-wa">
                    <i class="bi bi-whatsapp"></i> WhatsApp
                </a>
            @endif
        </div>

        <div class="pd-enquiry-note small text-muted">
            By submitting, you agree to be contacted by our team.
        </div>
    </form>
</div>

                    <div class="pd-side-card mt-3">
                        <h6 class="fw-bold mb-3">Why Rajyog Green?</h6>

                        <div class="pd-side-point">
                            <i class="bi bi-check-circle"></i>
                            <span>Quality focused products</span>
                        </div>

                        <div class="pd-side-point">
                            <i class="bi bi-check-circle"></i>
                            <span>Everyday cleaning solutions</span>
                        </div>

                        <div class="pd-side-point">
                            <i class="bi bi-check-circle"></i>
                            <span>Distributor friendly range</span>
                        </div>

                        <div class="pd-side-point">
                            <i class="bi bi-check-circle"></i>
                            <span>GMP & ISO aligned practices</span>
                        </div>
                    </div>

                   

                </div>
            </div>

        </div>
    </div>
</section>


@if($relatedProducts->count())
    <!-- RELATED PRODUCTS -->
    <section class="section-pad bg-soft">
        <div class="container">

            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
                <div>
                    <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
                        <i class="bi bi-grid-3x3-gap me-1"></i> You may also like
                    </span>

                    <h2 class="fw-bold mb-1">Related Products</h2>

                    <p class="text-muted mb-0">
                        Explore more essentials from Rajyog Green.
                    </p>
                </div>

                <a href="{{ route('products.index') }}" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-right"></i> View All
                </a>
            </div>

            <div class="row g-4">
                @foreach($relatedProducts as $relatedProduct)
                    @php
                        $relatedImage = $relatedProduct->image
                            ? $relatedProduct->image->getUrl()
                            : asset('assets/img/default-product.png');
                    @endphp

                    <div class="col-md-6 col-lg-3">
                        <div class="product-item h-100">
                            <div class="product-item-media">
                                <img 
                                    src="{{ $relatedImage }}" 
                                    alt="{{ $relatedProduct->name }}"
                                    loading="lazy"
                                >

                                <span class="product-tag">
                                    {{ $relatedProduct->category->name ?? 'Product' }}
                                </span>

                                @if($relatedProduct->is_featured)
                                    <span class="product-badge badge-best">
                                        Featured
                                    </span>
                                @endif
                            </div>

                            <div class="product-item-body">
                                <h6 class="fw-bold mb-1">
                                    {{ $relatedProduct->name }}
                                </h6>

                                <p class="text-muted small mb-3">
                                    {{ $relatedProduct->short_description ?? 'Quality product for everyday use.' }}
                                </p>

                                <div class="product-item-actions">
                                    <a 
                                        href="{{ route('products.show', $relatedProduct->slug) }}" 
                                        class="btn btn-sm btn-brand"
                                    >
                                        <i class="bi bi-eye"></i> View
                                    </a>

                                    <a 
                                        href="{{ url('/#contact') }}?product={{ urlencode($relatedProduct->name) }}" 
                                        class="btn btn-sm btn-outline-dark"
                                    >
                                        <i class="bi bi-chat-dots"></i> Enquire
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endif

@endsection