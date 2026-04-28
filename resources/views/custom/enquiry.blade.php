@extends('custom.master')

@section('content')

@php
    $siteName = $siteSetting->site_name ?? 'Raj Yog Go Green';

    $logoUrl = $siteSetting && $siteSetting->logo
        ? $siteSetting->logo->getUrl()
        : asset('assets/img/logo.png');

    $footerLogoUrl = $siteSetting && $siteSetting->footer_logo
        ? $siteSetting->footer_logo->getUrl()
        : $logoUrl;

    $phone = $siteSetting->phone ?? '+91 98765 43210';
    $email = $siteSetting->email ?? 'info@rajyogreen.com';
    $whatsappNumber = $siteSetting->whatsapp_number ?? $phone;
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);

    if ($whatsappClean && strlen($whatsappClean) === 10) {
        $whatsappClean = '91' . $whatsappClean;
    }
@endphp

<!-- ENQUIRY HERO -->
<section class="enquiry-hero section-pad">
    <div class="enquiry-hero-bg"></div>

    <div class="container position-relative">
        <div class="row align-items-center g-5">

            <div class="col-lg-7">
                <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
                    <i class="bi bi-send me-1"></i> Product & Distributor Enquiry
                </span>

                <h1 class="fw-bold display-6 mb-3">
                    Let’s Connect for <span class="text-brand">Products</span>, 
                    <span class="text-brand">Bulk Orders</span> & Partnership
                </h1>

                <p class="text-muted mb-4">
                    Share your enquiry with {{ $siteName }}. Our team will help you with product details,
                    pricing, availability, bulk orders and distributor opportunities.
                </p>

                <div class="enquiry-hero-pills">
                    <span>
                        <i class="bi bi-box-seam"></i> Product Enquiry
                    </span>

                    <span>
                        <i class="bi bi-people"></i> Distributor Request
                    </span>

                    <span>
                        <i class="bi bi-truck"></i> Bulk Supply
                    </span>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="enquiry-hero-card">
                    <div class="enquiry-hero-icon">
                        <i class="bi bi-headset"></i>
                    </div>

                    <h5 class="fw-bold mb-2">
                        Need quick assistance?
                    </h5>

                    <p class="text-muted small mb-3">
                        Fill the enquiry form or connect directly with our team.
                    </p>

                    <div class="enquiry-contact-list">
                        @if($phone)
                            <a href="tel:{{ $phone }}">
                                <i class="bi bi-telephone"></i>
                                <span>{{ $phone }}</span>
                            </a>
                        @endif

                        @if($email)
                            <a href="mailto:{{ $email }}">
                                <i class="bi bi-envelope"></i>
                                <span>{{ $email }}</span>
                            </a>
                        @endif

                        @if($whatsappClean)
                            <a href="https://wa.me/{{ $whatsappClean }}" target="_blank">
                                <i class="bi bi-whatsapp"></i>
                                <span>Chat on WhatsApp</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ENQUIRY FORM SECTION -->
<section class="section-pad bg-white" id="enquiryForm">
    <div class="container">
        <div class="row g-5">

            <!-- LEFT INFO -->
            <div class="col-lg-5">
                <div class="enquiry-info-sticky">

                    <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
                        <i class="bi bi-info-circle me-1"></i> Enquiry Details
                    </span>

                    <h2 class="fw-bold mb-3">
                        How can we help you?
                    </h2>

                    <p class="text-muted mb-4">
                        Please provide your correct details so our team can respond with relevant information and support.
                    </p>

                    <div class="enquiry-info-list">
                        <div class="enquiry-info-item">
                            <div class="enquiry-info-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>

                            <div>
                                <div class="fw-bold">Product Information</div>
                                <div class="small text-muted">Get product details, usage and availability.</div>
                            </div>
                        </div>

                        <div class="enquiry-info-item">
                            <div class="enquiry-info-icon">
                                <i class="bi bi-currency-rupee"></i>
                            </div>

                            <div>
                                <div class="fw-bold">Pricing & Bulk Orders</div>
                                <div class="small text-muted">Ask for pricing, bulk supply and business rates.</div>
                            </div>
                        </div>

                        <div class="enquiry-info-item">
                            <div class="enquiry-info-icon">
                                <i class="bi bi-people"></i>
                            </div>

                            <div>
                                <div class="fw-bold">Distributor Partnership</div>
                                <div class="small text-muted">Connect for dealership and distribution opportunities.</div>
                            </div>
                        </div>
                    </div>

                    <div class="enquiry-direct-card mt-4">
                        <h6 class="fw-bold mb-2">
                            Direct Contact
                        </h6>

                        @if($phone)
                            <div class="small text-muted mb-1">
                                <i class="bi bi-telephone me-1"></i> {{ $phone }}
                            </div>
                        @endif

                        @if($email)
                            <div class="small text-muted mb-1">
                                <i class="bi bi-envelope me-1"></i> {{ $email }}
                            </div>
                        @endif

                        @if($siteSetting?->address)
                            <div class="small text-muted">
                                <i class="bi bi-geo-alt me-1"></i> {{ $siteSetting->address }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <!-- RIGHT FORM -->
            <div class="col-lg-7">
                <div class="enquiry-form-card">

                    <div class="enquiry-form-head">
                        <h4 class="fw-bold mb-1">
                            Send Your Enquiry
                        </h4>

                        <p class="text-muted mb-0">
                            Fill the form below and we will get back to you soon.
                        </p>
                    </div>

                    <form action="{{ route('custom.enquiry.submit') }}" method="POST" class="enquiry-form">
                        @csrf

                        @if(session('success'))
                            <div class="alert alert-success rounded-4">
                                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger rounded-4">
                                <strong>Please fix the following errors:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row g-3">

                            <div class="col-md-6">
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

                            <div class="col-md-6">
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

                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>

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

                            <div class="col-md-6">
                                <label class="form-label">Interested Product</label>

                                <select name="product_id" class="form-select @error('product_id') is-invalid @enderror">
                                    <option value="">Select product</option>

                                    @foreach($products as $product)
                                        <option 
                                            value="{{ $product->id }}" 
                                            {{ old('product_id', request('product_id')) == $product->id ? 'selected' : '' }}
                                        >
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Subject</label>

                                <input 
                                    type="text" 
                                    name="subject" 
                                    value="{{ old('subject') }}" 
                                    class="form-control @error('subject') is-invalid @enderror" 
                                    placeholder="Enter enquiry subject"
                                >

                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Message *</label>

                                <textarea 
                                    name="message" 
                                    rows="5" 
                                    class="form-control @error('message') is-invalid @enderror" 
                                    placeholder="Write your enquiry here..." 
                                    required
                                >{{ old('message') }}</textarea>

                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <div class="enquiry-note">
                                    <i class="bi bi-shield-check"></i>
                                    <span>Your details are safe with us. We use them only to respond to your enquiry.</span>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-brand btn-lg enquiry-submit">
                                    <i class="bi bi-send"></i> Submit Enquiry
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- QUICK CTA -->
<section class="enquiry-cta section-pad">
    <div class="enquiry-cta-bg"></div>

    <div class="container position-relative">
        <div class="row align-items-center g-4">

            <div class="col-lg-8">
                <span class="enquiry-cta-pill">
                    <i class="bi bi-whatsapp"></i> Quick Response
                </span>

                <h2 class="fw-bold mt-3 mb-2">
                    Want faster support?
                </h2>

                <p class="mb-0 enquiry-cta-text">
                    Send your enquiry directly on WhatsApp for product details, pricing and distributor information.
                </p>
            </div>

            <div class="col-lg-4 text-lg-end">
                @if($whatsappClean)
                    <a href="https://wa.me/{{ $whatsappClean }}" target="_blank" class="btn btn-light btn-lg">
                        <i class="bi bi-whatsapp"></i> Chat on WhatsApp
                    </a>
                @else
                    <a href="{{ url('/#contact') }}" class="btn btn-light btn-lg">
                        <i class="bi bi-chat-dots"></i> Contact Us
                    </a>
                @endif
            </div>

        </div>
    </div>
</section>

@endsection