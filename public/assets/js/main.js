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

// Desktop product menu hover support
$(document).ready(function () {
    function isDesktopNav() {
        return window.matchMedia('(min-width: 1200px) and (hover: hover) and (pointer: fine)').matches;
    }

    function isCompactNav() {
        return !isDesktopNav();
    }

    $('.nav-item.dropdown').on('mouseenter', function () {
        if (!isDesktopNav()) return;

        $(this).children('.dropdown-menu').addClass('show');
    });

    $('.nav-item.dropdown').on('mouseleave', function () {
        if (!isDesktopNav()) return;

        $(this).children('.dropdown-menu').removeClass('show');
        $(this).find('.product-submenu').removeClass('show');
    });

    $('.dropdown-submenu').on('mouseenter', function () {
        if (!isDesktopNav()) return;

        $(this).siblings('.dropdown-submenu').find('.product-submenu').removeClass('show');
        $(this).children('.product-submenu').addClass('show');
    });

    $('.product-menu-link').on('click', function (event) {
        if (!isCompactNav()) return;

        const submenu = $(this).siblings('.product-submenu');

        if (!submenu.length) return;

        event.preventDefault();
        event.stopPropagation();

        const parentItem = $(this).parent('.dropdown-submenu');
        const willOpen = !submenu.hasClass('show');

        parentItem
            .siblings('.dropdown-submenu')
            .removeClass('is-open')
            .find('.product-submenu')
            .removeClass('show');

        parentItem.toggleClass('is-open', willOpen);
        submenu.toggleClass('show', willOpen);
    });

    $('.product-menu').on('click', function (event) {
        if (isCompactNav()) {
            event.stopPropagation();
        }
    });

    $('.nav-item.dropdown').on('hidden.bs.dropdown', function () {
        $(this).find('.product-submenu').removeClass('show');
        $(this).find('.dropdown-submenu').removeClass('is-open');
    });

    $(window).on('resize', function () {
        $('.product-submenu').removeClass('show');
        $('.dropdown-submenu').removeClass('is-open');
    });
});

// Product filtering and sorting functionality using jQuery

$(document).ready(function () {
    let activeCategory = 'all';
    let activeSubcategory = '';

    const params = new URLSearchParams(window.location.search);
    const urlCategory = params.get('category');
    const urlSubcategory = params.get('subcategory');

    if (urlCategory) {
        activeCategory = urlCategory;
    }

    if (urlSubcategory) {
        activeSubcategory = urlSubcategory;
    }

    function filterProducts() {
        let searchValue = $('#productSearch').val().toLowerCase().trim();
        let visibleCount = 0;

        $('.product-item').each(function () {
            let item = $(this);

            let name = item.data('name') ? item.data('name').toString() : '';
            let category = item.data('category') ? item.data('category').toString() : '';
            let categoryName = item.data('category-name') ? item.data('category-name').toString() : '';
            let subcategory = item.data('subcategory') ? item.data('subcategory').toString() : '';
            let subcategorySlug = item.data('subcategory-slug') ? item.data('subcategory-slug').toString() : '';
            let featured = item.data('featured') == 1;
            let isNew = item.data('new') == 1;

            let matchesSearch = 
                name.includes(searchValue) || 
                category.includes(searchValue) || 
                categoryName.includes(searchValue) ||
                subcategory.includes(searchValue);

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

            let matchesSubcategory = !activeSubcategory || subcategorySlug === activeSubcategory;

            if (matchesSearch && matchesCategory && matchesSubcategory) {
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
        activeSubcategory = '';

        filterProducts();
    });

    $('#productSearch').on('keyup', function () {
        filterProducts();
    });

    $('#productSort').on('change', function () {
        sortProducts($(this).val());
    });

    if (urlCategory) {
        $('.products-pill').removeClass('active');
        $('.products-pill[data-category="' + urlCategory + '"]').addClass('active');
    }

    filterProducts();
});



// Enquiry form demo handling
document.addEventListener("DOMContentLoaded", function () {
  const enquiryForm = document.getElementById("rajYogEnquiryForm");
  const successBox = document.getElementById("enquirySuccess");

  if (!enquiryForm) return;

  enquiryForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(enquiryForm);

    const name = formData.get("name") || "";
    const phone = formData.get("phone") || "";
    const email = formData.get("email") || "";
    const city = formData.get("city") || "";
    const type = formData.get("type") || "";
    const product = formData.get("product") || "";
    const message = formData.get("message") || "";

    const whatsappNumber = "919876543210";

    const whatsappMessage =
      "New Enquiry from Raj Yog Website%0A%0A" +
      "Name: " + encodeURIComponent(name) + "%0A" +
      "Phone: " + encodeURIComponent(phone) + "%0A" +
      "Email: " + encodeURIComponent(email) + "%0A" +
      "City: " + encodeURIComponent(city) + "%0A" +
      "Enquiry Type: " + encodeURIComponent(type) + "%0A" +
      "Product: " + encodeURIComponent(product) + "%0A" +
      "Message: " + encodeURIComponent(message);

    if (successBox) {
      successBox.classList.remove("d-none");
    }

    window.open("https://wa.me/" + whatsappNumber + "?text=" + whatsappMessage, "_blank");

    enquiryForm.reset();

    setTimeout(function () {
      if (successBox) {
        successBox.classList.add("d-none");
      }
    }, 5000);
  });
});
// Password visibility toggle functionality

document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener("click", function () {
            const icon = this.querySelector("i");
            const isPassword = passwordInput.getAttribute("type") === "password";

            passwordInput.setAttribute("type", isPassword ? "text" : "password");

            if (icon) {
                icon.classList.toggle("bi-eye", !isPassword);
                icon.classList.toggle("bi-eye-slash", isPassword);
            }
        });
    }
});

// Password visibility toggle functionality

document.addEventListener("DOMContentLoaded", function () {
    function setupPasswordToggle(buttonId, inputId) {
        const toggleButton = document.getElementById(buttonId);
        const passwordInput = document.getElementById(inputId);

        if (!toggleButton || !passwordInput) return;

        toggleButton.addEventListener("click", function () {
            const icon = this.querySelector("i");
            const isPassword = passwordInput.getAttribute("type") === "password";

            passwordInput.setAttribute("type", isPassword ? "text" : "password");

            if (icon) {
                icon.classList.toggle("bi-eye", !isPassword);
                icon.classList.toggle("bi-eye-slash", isPassword);
            }
        });
    }

    setupPasswordToggle("togglePassword", "password");
    setupPasswordToggle("togglePasswordConfirm", "password_confirmation");
});
