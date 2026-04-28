@extends('custom.master')

@section('content')


<!-- PRODUCTS HERO -->
<section class="products-page-hero section-pad">
  <div class="products-page-hero-bg"></div>

  <div class="container position-relative">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
          <i class="bi bi-box-seam me-1"></i> Products • Home & Personal Care
        </span>

        <h1 class="fw-bold display-6 mb-3">
          Performance First. <span class="text-brand">Go Green</span> Always.
        </h1>

        <p class="text-muted mb-4">
          Explore our Home Care and Personal Care ranges designed for everyday Indian households —
          quality-driven, research-backed, and built for consistent results.
        </p>

        <div class="d-flex gap-2 flex-wrap">
          <a href="#catalog" class="btn btn-brand btn-lg">
            <i class="bi bi-grid-3x3-gap"></i> Browse Catalog
          </a>
          <a href="index.html#partner" class="btn btn-outline-dark btn-lg">
            <i class="bi bi-people"></i> Distributor Enquiry
          </a>
        </div>

        <div class="products-hero-strip mt-4">
          <div class="products-hero-pill"><i class="bi bi-patch-check"></i> GMP Certified</div>
          <div class="products-hero-pill"><i class="bi bi-award"></i> ISO Systems</div>
          <div class="products-hero-pill"><i class="bi bi-recycle"></i> Eco Mindset</div>
          <div class="products-hero-pill"><i class="bi bi-clipboard-check"></i> QC Checks</div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="products-hero-media">
          <img
            src="https://dummyimage.com/1200x900/004b8f/ffffff&text=Products+Hero+1200x900"
            class="products-hero-img"
            alt="Products Hero 1200x900"
          />
        </div>
      </div>
    </div>
  </div>
</section>


<!-- PRODUCTS CATALOG -->
<section id="catalog" class="section-pad bg-white">
    <div class="container">

        <!-- Top controls -->
        <div class="row g-3 align-items-center justify-content-between mb-4">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-1">Products Catalog</h2>
                <p class="text-muted mb-0">Browse by category, search, and enquire instantly.</p>
            </div>

            <div class="col-lg-6">
                <div class="products-controls">
                    <div class="products-search">
                        <i class="bi bi-search"></i>
                        <input 
                            type="text" 
                            id="productSearch" 
                            class="form-control" 
                            placeholder="Search products e.g. detergent, soap, gel"
                        >
                    </div>

                    <select id="productSort" class="form-select products-sort">
                        <option value="featured" selected>Sort: Featured</option>
                        <option value="new">Sort: New Launches</option>
                        <option value="az">Sort: A-Z</option>
                        <option value="za">Sort: Z-A</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Category Pills -->
        <div class="products-pills mb-4">
            <button type="button" class="products-pill active" data-category="all">
                <i class="bi bi-grid-3x3-gap"></i> All
            </button>

            @foreach($categories as $category)
                <button 
                    type="button" 
                    class="products-pill" 
                    data-category="{{ $category->slug }}"
                >
                    <i class="bi bi-droplet-half"></i> {{ $category->name }}
                </button>
            @endforeach

            <button type="button" class="products-pill" data-category="featured">
                <i class="bi bi-stars"></i> Featured
            </button>

            <button type="button" class="products-pill" data-category="new">
                <i class="bi bi-lightning-charge"></i> New Launches
            </button>
        </div>

        <!-- PRODUCTS -->
        <div class="mb-5">
            <div class="products-grid" id="productsGrid">

                @forelse($products as $product)
                    @php
                        $categorySlug = $product->category->slug ?? 'uncategorized';
                        $categoryName = $product->category->name ?? 'General';

                        $imageUrl = $product->image
                            ? $product->image->getUrl()
                            : asset('assets/img/default-product.png');

                        $isNew = $product->created_at && $product->created_at->gt(now()->subDays(30));
                    @endphp

                    <div 
                        class="product-item"
                        data-name="{{ strtolower($product->name) }}"
                        data-category="{{ $categorySlug }}"
                        data-category-name="{{ strtolower($categoryName) }}"
                        data-featured="{{ $product->is_featured ? 1 : 0 }}"
                        data-new="{{ $isNew ? 1 : 0 }}"
                    >
                        <div class="product-item-media">
                            <img 
                                src="{{ $imageUrl }}" 
                                alt="{{ $product->name }}"
                                loading="lazy"
                            >

                            <span class="product-tag">
                                {{ $categoryName }}
                            </span>

                            @if($product->is_featured)
                                <span class="product-badge badge-best">
                                    Featured
                                </span>
                            @elseif($isNew)
                                <span class="product-badge badge-new">
                                    New
                                </span>
                            @endif
                        </div>

                        <div class="product-item-body">
                            <h5 class="fw-bold mb-1">
                                {{ $product->name }}
                            </h5>

                            <p class="text-muted small mb-3">
                                {{ $product->short_description ?? 'Premium quality product for everyday use.' }}
                            </p>

                            @if($product->pack_size || $product->price)
                                <div class="product-meta mb-3">
                                    @if($product->pack_size)
                                        <span>
                                            <i class="bi bi-box-seam"></i> {{ $product->pack_size }}
                                        </span>
                                    @endif

                                    @if($product->price)
                                        <span>
                                            <i class="bi bi-currency-rupee"></i> {{ number_format($product->price, 2) }}
                                        </span>
                                    @endif
                                </div>
                            @endif

                            <div class="product-item-actions">
                                <a 
                                    href="{{ url('products/' . $product->slug) }}" 
                                    class="btn btn-sm btn-brand"
                                >
                                    <i class="bi bi-eye"></i> View
                                </a>

                                <a 
                                    href="{{ url('/#contact') }}?product={{ urlencode($product->name) }}" 
                                    class="btn btn-sm btn-outline-dark"
                                >
                                    <i class="bi bi-chat-dots"></i> Enquire
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="products-empty text-center py-5">
                        <i class="bi bi-box-seam display-5 text-muted"></i>
                        <h5 class="mt-3">No products found</h5>
                        <p class="text-muted mb-0">Products will appear here once added from admin.</p>
                    </div>
                @endforelse

            </div>

            <div id="noProductsFound" class="text-center py-5 d-none">
                <i class="bi bi-search display-5 text-muted"></i>
                <h5 class="mt-3">No matching products found</h5>
                <p class="text-muted mb-0">Try another keyword or category.</p>
            </div>
        </div>

       

     <!-- CATEGORY SECTIONS (anchors) -->
    <div class="row g-4">
      <div class="col-lg-6" id="homecare">
        <div class="products-category-banner cat-home">
          <div>
            <div class="products-category-title">Home Care Range</div>
            <div class="products-category-text">Laundry • Dishwash • Cleaning essentials for modern homes.</div>
            <a href="index.html#partner" class="btn btn-light mt-3"><i class="bi bi-people"></i> Distributor Enquiry</a>
          </div>
          <i class="bi bi-droplet-half products-category-icon"></i>
        </div>
      </div>

      <div class="col-lg-6" id="personalcare">
        <div class="products-category-banner cat-personal">
          <div>
            <div class="products-category-title">Personal Care Range</div>
            <div class="products-category-text">Gentle hygiene products designed for everyday comfort.</div>
            <a href="index.html#contact" class="btn btn-dark mt-3"><i class="bi bi-chat-dots"></i> Ask for Catalog</a>
          </div>
          <i class="bi bi-heart-pulse products-category-icon"></i>
        </div>
      </div>
    </div>
</section>




<!-- PREMIUM ENQUIRY STRIP -->
<section class="products-enquiry section-pad">
  <div class="products-enquiry-bg"></div>

  <div class="container position-relative">
    <div class="row align-items-center g-4">
      <div class="col-lg-8 text-white">
        <h2 class="fw-bold mb-2">Want the Full Product Catalog?</h2>
        <p class="mb-0 text-white-50">
          Share your city and preferred category — we’ll send the latest product list and distributor pricing details.
        </p>
      </div>

      <div class="col-lg-4">
        <div class="d-flex gap-2 flex-wrap justify-content-lg-end">
          <a href="https://wa.me/91XXXXXXXXXX" target="_blank" class="btn btn-light btn-lg">
            <i class="bi bi-whatsapp"></i> WhatsApp Now
          </a>
          <a href="index.html#contact" class="btn btn-outline-light btn-lg">
            <i class="bi bi-chat-dots"></i> Contact
          </a>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection