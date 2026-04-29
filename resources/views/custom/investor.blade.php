@extends('custom.master')

@section('content')

@php
    $phone = $siteSetting->phone ?? '+91XXXXXXXXXX';
    $whatsappNumber = $siteSetting->whatsapp_number ?? $phone;
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);

    if ($whatsappClean && strlen($whatsappClean) === 10) {
        $whatsappClean = '91' . $whatsappClean;
    }
@endphp

<!-- BREADCRUMB -->
<section class="pd-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">
                    Investor / Distributor
                </li>
            </ol>
        </nav>
    </div>
</section>

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

@endsection