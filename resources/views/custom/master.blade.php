@php
    // Fetch site settings (assuming only one record)
    $siteSetting = App\Models\SiteSetting::first();
    $products = App\Models\Product::pluck('name', 'slug')->toArray();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Raj Yog – Go Green</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
</head>
<body>

<!-- TOP BAR (Premium) -->
<div class="topbar topbar-premium">
  <div class="container">
    <div class="topbar-inner">

      <!-- Left -->
      <div class="topbar-left">
        <span class="topbar-item">
          <i class="bi bi-geo-alt"></i>
          <span>{{ $siteSetting->city ?? 'Kota, Rajasthan' }}</span>
        </span>

        <span class="topbar-dot"></span>

        <span class="topbar-item">
          <i class="bi bi-shield-check"></i>
          <span>{{ $siteSetting->certification ?? 'GMP & ISO Certified Manufacturing' }}</span>
        </span>
      </div>

      <!-- Right -->
      <div class="topbar-right">
        <a class="topbar-link" href="mailto:info@rajyog.com">
          <i class="bi bi-envelope"></i>
          <span>info@rajyog.com</span>
        </a>

        <span class="topbar-divider"></span>

        <a class="topbar-link" href="tel:{{ $siteSetting->phone ?? '+91 77426 56449' }}">
          <i class="bi bi-telephone"></i>
          <span>{{ $siteSetting->phone ?? '+91 77426 56449' }}</span>
        </a>

        <a class="topbar-cta" href="https://wa.me/{{ $siteSetting->whatsapp_number ?? '91XXXXXXXXXX' }}" target="_blank">
          <i class="bi bi-whatsapp"></i>
          <span class="d-none d-md-inline">WhatsApp</span>
        </a>
      </div>

    </div>
  </div>
</div>

<!-- NAVBAR (Premium | Logo Only) -->
<nav class="navbar navbar-expand-lg navbar-premium sticky-top" id="siteNavbar">
  <div class="container">

    <!-- Brand (Logo only) -->
    <a class="navbar-brand brand-premium" href="{{ route('home') }}">
      <img src="{{ $siteSetting->logo->getUrl() ?? 'assets/img/logo.png' }}" alt="Raj Yog" class="brand-logo" />
    </a>

    <button class="navbar-toggler premium-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto align-items-lg-center nav-premium">

        <li class="nav-item">
    <a class="nav-link navlink-premium {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
        Home
    </a>
</li>

<li class="nav-item">
    <a class="nav-link navlink-premium {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
        About
    </a>
</li>

<li class="nav-item dropdown">
    <a 
        class="nav-link navlink-premium dropdown-toggle {{ request()->routeIs('products.*') ? 'active' : '' }}" 
        href="#" 
        data-bs-toggle="dropdown"
    >
        Products
    </a>

    <ul class="dropdown-menu dropdown-premium">
        @foreach($products as $slug => $name)
            <li>
                <a 
                    class="dropdown-item {{ request()->routeIs('products.show') && request()->route('slug') == $slug ? 'active' : '' }}" 
                    href="{{ route('products.show', $slug) }}"
                >
                    {{ $name }}
                </a>
            </li>
        @endforeach

        <li>
            <a 
                class="dropdown-item {{ request()->routeIs('products.index') ? 'active' : '' }}" 
                href="{{ route('products.index') }}"
            >
                <i class="bi bi-grid-3x3-gap me-2"></i> All Products
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a 
        class="nav-link navlink-premium {{ request()->routeIs('custom.manufacturing') ? 'active' : '' }}" 
        href="{{ route('custom.manufacturing') }}"
    >
        Manufacturing & R&D
    </a>
</li>

<li class="nav-item">
    <a 
        class="nav-link navlink-premium {{ request()->routeIs('sustainability') ? 'active' : '' }}" 
        href="{{ route('custom.sustainability') }}"
    >
        Sustainability
    </a>
</li>

<li class="nav-item">
    <a 
        class="nav-link navlink-premium {{ request()->routeIs('certificates.index') ? 'active' : '' }}" 
        href="{{ route('certificates.index') }}"
    >
        Certifications
    </a>
</li>

<li class="nav-item">
    <a 
        class="nav-link navlink-premium {{ request()->routeIs('custom.investor') ? 'active' : '' }}" 
        href="{{ route('custom.investor') }}"
    >
        Investor / Distributor
    </a>
</li>

<li class="nav-item ms-lg-3 mt-2 mt-lg-0">
    <a 
        class="btn btn-brand btn-brand-nav {{ request()->routeIs('custom.enquiry') ? 'active' : '' }}" 
        href="{{ route('custom.enquiry') }}"
    >
        <i class="bi bi-chat-dots me-1"></i> Contact
    </a>
</li>

      </ul>
    </div>
  </div>
</nav>


@yield('content')





<!-- FOOTER (Premium) -->
<footer class="footer-premium">
  <div class="footer-bg"></div>

  <div class="container position-relative">
    <!-- Top -->
    <div class="row g-4 footer-top">

      <!-- Brand -->
      <div class="col-lg-4">
        <a href="{{ route('home') }}" class="footer-brand">
          <img src="{{ $siteSetting->logo->getUrl() ?? 'assets/img/logo.png' }}" alt="Raj Yog" class="footer-logo">
        </a>

        <p class="footer-desc">
          Eco-friendly home & personal care products focused on quality, performance, and responsibility —
          built for modern Indian homes.
        </p>

        <div class="footer-chips">
          <span class="footer-chip"><i class="bi bi-patch-check"></i> GMP</span>
          <span class="footer-chip"><i class="bi bi-award"></i> ISO</span>
          <span class="footer-chip"><i class="bi bi-recycle"></i> Go Green</span>
        </div>

        <div class="footer-social mt-3">
          <a href="{{ $siteSetting->facebook_url ?? '#' }}" class="footer-social-btn" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
          <a href="{{ $siteSetting->instagram_url ?? '#' }}" class="footer-social-btn" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <a href="{{ $siteSetting->youtube_url ?? '#' }}" class="footer-social-btn" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
          <a href="{{ $siteSetting->linkedin_url ?? '#' }}" class="footer-social-btn" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
          <a href="{{ $siteSetting->twitter_url ?? '#' }}" class="footer-social-btn" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
        </div>
      </div>

      <!-- Links -->
      <div class="col-6 col-lg-2">
        <h6 class="footer-title">Company</h6>
        <ul class="footer-links">
          <li><a href="{{ route('about') }}">About</a></li>
          <li><a href="{{ route('custom.manufacturing') }}">Manufacturing & R&D</a></li>
          <li><a href="{{ route('custom.sustainability') }}">Sustainability</a></li>
          <li><a href="{{ route('certificates.index') }}">Certifications</a></li>
          <li><a href="{{ route('custom.investor') }}">Investor / Distributor</a></li>
          <li><a href="{{ route('custom.enquiry') }}">Contact</a></li>
        </ul>
      </div>

      <div class="col-6 col-lg-2">
        <h6 class="footer-title">Products</h6>
        <ul class="footer-links">
          @foreach($products as $slug => $name)
            <li><a href="{{ route('products.show', $slug) }}">{{ $name }}</a></li>
          @endforeach
        </ul>
      </div>

      <!-- Contact -->
      <div class="col-lg-4">
        <h6 class="footer-title">Contact</h6>

        <div class="footer-contact">
          <div class="footer-contact-item">
            <span class="footer-contact-icon"><i class="bi bi-geo-alt"></i></span>
            <div>
              <div class="fw-bold">{{ $siteSetting->city ?? 'Kota, Rajasthan' }}</div>
              <div class="small text-white-50">India</div>
            </div>
          </div>

          <div class="footer-contact-item">
            <span class="footer-contact-icon"><i class="bi bi-envelope"></i></span>
            <div>
              <div class="fw-bold">{{ $siteSetting->email ?? 'info@rajyog.com' }}</div>
              <div class="small text-white-50">Email us anytime</div>
            </div>
          </div>

          <div class="footer-contact-item">
            <span class="footer-contact-icon"><i class="bi bi-telephone"></i></span>
            <div>
              <div class="fw-bold">{{ $siteSetting->phone ?? '+91 77426 56449' }}</div>
              <div class="small text-white-50">Mon–Sat • 10AM–6PM</div>
            </div>
          </div>
        </div>

        <!-- Newsletter (premium card) -->
        <div class="footer-newsletter mt-4">
          <div class="fw-bold mb-1">Newsletter</div>
          <div class="small text-white-50 mb-3">Get updates on products, launches & distributor opportunities.</div>

          <form class="footer-newsletter-form">
            <input type="email" class="form-control" placeholder="Enter your email">
            <button type="button" class="btn btn-brand">
              <i class="bi bi-send"></i>
            </button>
          </form>

          <div class="footer-newsletter-note">
            We respect your privacy. No spam.
          </div>
        </div>

      </div>
    </div>

    <!-- Divider -->
    <div class="footer-divider"></div>

    <!-- Bottom bar -->
    <div class="footer-bottom">
      <div class="small text-white-50">
        &copy; {{ date('Y') }} {{ $siteSetting->company_name ?? 'Raj Yog' }}. All rights reserved.
      </div>

      <div class="footer-bottom-links small">
        <a href="#">Privacy Policy</a>
        <span class="footer-dot"></span>
        <a href="#">Terms</a>
        <span class="footer-dot"></span>
        <a href="#contact">Support</a>
      </div>
    </div>
  </div>
</footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Custom JS -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
