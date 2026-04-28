// Raj Yog - Main JS

document.addEventListener("DOMContentLoaded", function () {
  // Auto year in footer
  const yearEl = document.getElementById("year");
  if (yearEl) yearEl.textContent = new Date().getFullYear();

  // Smooth scroll for on-page links (#...)
  document.querySelectorAll('a[href^="#"]').forEach((link) => {
    link.addEventListener("click", function (e) {
      const targetId = this.getAttribute("href");
      if (!targetId || targetId === "#") return;

      const target = document.querySelector(targetId);
      if (!target) return;

      e.preventDefault();
      target.scrollIntoView({ behavior: "smooth", block: "start" });
    });
  });
});


// Premium navbar scroll effect
document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.getElementById("siteNavbar");

  const handleScroll = () => {
    if (!navbar) return;
    if (window.scrollY > 10) {
      navbar.classList.add("is-scrolled");
    } else {
      navbar.classList.remove("is-scrolled");
    }
  };

  handleScroll();
  window.addEventListener("scroll", handleScroll);
});


// Hero slider functionality using jQuery

$(document).ready(function () {
    let currentSlide = 0;
    let slides = $('.hero-slide-item');
    let dots = $('.hero-dot');
    let totalSlides = slides.length;
    let autoSlide;

    function showSlide(index) {
        if (totalSlides <= 0) {
            return;
        }

        if (index >= totalSlides) {
            index = 0;
        }

        if (index < 0) {
            index = totalSlides - 1;
        }

        slides.removeClass('active');
        dots.removeClass('active');

        slides.eq(index).addClass('active');
        dots.eq(index).addClass('active');

        currentSlide = index;
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    function startAutoSlide() {
        autoSlide = setInterval(function () {
            nextSlide();
        }, 100000);
    }

    function stopAutoSlide() {
        clearInterval(autoSlide);
    }

    $('.hero-next').on('click', function () {
        nextSlide();
        stopAutoSlide();
        startAutoSlide();
    });

    $('.hero-prev').on('click', function () {
        prevSlide();
        stopAutoSlide();
        startAutoSlide();
    });

    $('.hero-dot').on('click', function () {
        let index = $(this).data('slide');

        showSlide(index);
        stopAutoSlide();
        startAutoSlide();
    });

    $('.hero-jquery-slider').on('mouseenter', function () {
        stopAutoSlide();
    });

    $('.hero-jquery-slider').on('mouseleave', function () {
        startAutoSlide();
    });

    if (totalSlides > 1) {
        startAutoSlide();
    }
});

// Product filtering and sorting functionality using jQuery

$(document).ready(function () {
    let activeCategory = 'all';

    function filterProducts() {
        let searchValue = $('#productSearch').val().toLowerCase().trim();
        let visibleCount = 0;

        $('.product-item').each(function () {
            let item = $(this);

            let name = item.data('name') ? item.data('name').toString() : '';
            let category = item.data('category') ? item.data('category').toString() : '';
            let categoryName = item.data('category-name') ? item.data('category-name').toString() : '';
            let featured = item.data('featured') == 1;
            let isNew = item.data('new') == 1;

            let matchesSearch = 
                name.includes(searchValue) || 
                category.includes(searchValue) || 
                categoryName.includes(searchValue);

            let matchesCategory = false;

            if (activeCategory === 'all') {
                matchesCategory = true;
            } else if (activeCategory === 'featured') {
                matchesCategory = featured;
            } else if (activeCategory === 'new') {
                matchesCategory = isNew;
            } else {
                matchesCategory = category === activeCategory;
            }

            if (matchesSearch && matchesCategory) {
                item.removeClass('d-none');
                visibleCount++;
            } else {
                item.addClass('d-none');
            }
        });

        if (visibleCount === 0) {
            $('#noProductsFound').removeClass('d-none');
        } else {
            $('#noProductsFound').addClass('d-none');
        }
    }

    function sortProducts(type) {
        let grid = $('#productsGrid');
        let items = grid.children('.product-item').get();

        items.sort(function (a, b) {
            let itemA = $(a);
            let itemB = $(b);

            let nameA = itemA.data('name') ? itemA.data('name').toString() : '';
            let nameB = itemB.data('name') ? itemB.data('name').toString() : '';

            let featuredA = parseInt(itemA.data('featured')) || 0;
            let featuredB = parseInt(itemB.data('featured')) || 0;

            let newA = parseInt(itemA.data('new')) || 0;
            let newB = parseInt(itemB.data('new')) || 0;

            if (type === 'featured') {
                return featuredB - featuredA;
            }

            if (type === 'new') {
                return newB - newA;
            }

            if (type === 'az') {
                return nameA.localeCompare(nameB);
            }

            if (type === 'za') {
                return nameB.localeCompare(nameA);
            }

            return 0;
        });

        $.each(items, function (index, item) {
            grid.append(item);
        });

        filterProducts();
    }

    $('.products-pill').on('click', function () {
        $('.products-pill').removeClass('active');
        $(this).addClass('active');

        activeCategory = $(this).data('category').toString();

        filterProducts();
    });

    $('#productSearch').on('keyup', function () {
        filterProducts();
    });

    $('#productSort').on('change', function () {
        sortProducts($(this).val());
    });

    filterProducts();
});