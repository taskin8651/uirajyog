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
          <span>Kota, Rajasthan</span>
        </span>

        <span class="topbar-dot"></span>

        <span class="topbar-item">
          <i class="bi bi-shield-check"></i>
          <span>GMP & ISO Certified Manufacturing</span>
        </span>
      </div>

      <!-- Right -->
      <div class="topbar-right">
        <a class="topbar-link" href="mailto:info@rajyog.com">
          <i class="bi bi-envelope"></i>
          <span>info@rajyog.com</span>
        </a>

        <span class="topbar-divider"></span>

        <a class="topbar-link" href="tel:+91XXXXXXXXXX">
          <i class="bi bi-telephone"></i>
          <span>+91 77426 56449</span>
        </a>

        <a class="topbar-cta" href="https://wa.me/91XXXXXXXXXX" target="_blank">
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
    <a class="navbar-brand brand-premium" href="index.html">
      <img src="assets/img/logo.png" alt="Raj Yog" class="brand-logo" />
    </a>

    <button class="navbar-toggler premium-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto align-items-lg-center nav-premium">

        <li class="nav-item">
          <a class="nav-link navlink-premium active" href="index.html">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link navlink-premium" href="about.html">About</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link navlink-premium dropdown-toggle" href="#" data-bs-toggle="dropdown">
            Products
          </a>
          <ul class="dropdown-menu dropdown-premium">
            <li>
              <a class="dropdown-item" href="#products">
                <i class="bi bi-droplet-half me-2"></i> Home Care
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#products">
                <i class="bi bi-heart-pulse me-2"></i> Personal Care
              </a>
            </li>
            <li><hr class="dropdown-divider" /></li>
            <li>
              <a class="dropdown-item" href="#products">
                <i class="bi bi-grid-3x3-gap me-2"></i> All Products
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link navlink-premium" href="#mfg">Manufacturing & R&D</a>
        </li>

        <li class="nav-item">
          <a class="nav-link navlink-premium" href="#green">Sustainability</a>
        </li>

        <li class="nav-item">
          <a class="nav-link navlink-premium" href="#certs">Certifications</a>
        </li>

        <li class="nav-item">
          <a class="nav-link navlink-premium" href="#partner">Investor / Distributor</a>
        </li>

        <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
          <a class="btn btn-brand btn-brand-nav" href="#contact">
            <i class="bi bi-chat-dots"></i> Contact
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
        <a href="#home" class="footer-brand">
          <img src="assets/img/logo.png" alt="Raj Yog" class="footer-logo">
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
          <a href="#" class="footer-social-btn" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="footer-social-btn" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="footer-social-btn" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
          <a href="#" class="footer-social-btn" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>

      <!-- Links -->
      <div class="col-6 col-lg-2">
        <h6 class="footer-title">Company</h6>
        <ul class="footer-links">
          <li><a href="#about">About</a></li>
          <li><a href="#mfg">Manufacturing & R&D</a></li>
          <li><a href="#green">Sustainability</a></li>
          <li><a href="#certs">Certifications</a></li>
        </ul>
      </div>

      <div class="col-6 col-lg-2">
        <h6 class="footer-title">Products</h6>
        <ul class="footer-links">
          <li><a href="#products">Home Care</a></li>
          <li><a href="#products">Personal Care</a></li>
          <li><a href="#products">Best Sellers</a></li>
          <li><a href="#products">New Launches</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="col-lg-4">
        <h6 class="footer-title">Contact</h6>

        <div class="footer-contact">
          <div class="footer-contact-item">
            <span class="footer-contact-icon"><i class="bi bi-geo-alt"></i></span>
            <div>
              <div class="fw-bold">Kota, Rajasthan</div>
              <div class="small text-white-50">India</div>
            </div>
          </div>

          <div class="footer-contact-item">
            <span class="footer-contact-icon"><i class="bi bi-envelope"></i></span>
            <div>
              <div class="fw-bold">info@rajyog.com</div>
              <div class="small text-white-50">Email us anytime</div>
            </div>
          </div>

          <div class="footer-contact-item">
            <span class="footer-contact-icon"><i class="bi bi-telephone"></i></span>
            <div>
              <div class="fw-bold">+91 77426 56449</div>
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
        © <span id="year"></span> Raj Yog. All Rights Reserved.
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
