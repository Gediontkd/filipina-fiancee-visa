window.onscroll = function () { myFunction() };

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}
/*-----------------------------------
----------- Brands Carousel -----------
------------------------------------*/
$('.logocarousel').owlCarousel({
    loop: true,
    margin: 30,
    nav: false,
    dots: false,
    autoplay: true,
    responsive: {
        0: {
            items: 1
        },
        320: {
            items: 3
        },
        767: {
            items: 3
        },
        1000: {
            items: 6
        }, 1400: {
            items: 6
        }
    }
});


AOS.init({
    easing: 'ease-out-back',
    duration: 1000
});


$(window).on('load', function () {

    "use strict";

    /*----------------------------------------------------*/
    /*	Preloader
    /*----------------------------------------------------*/

    $("#loader").delay(100).fadeOut();
    $("#loader-wrapper").delay(100).fadeOut("fast");

});
/*----------------------------------------------------*/
/*	Reviews Grid
/*----------------------------------------------------*/

$('.grid-loaded').imagesLoaded(function () {
    var $grid = $('.masonry-wrap').isotope({
        itemSelector: '.review-2',
        percentPosition: true,
        transitionDuration: '0.7s',
        masonry: {
            columnWidth: '.review-2',
        }
    });
});


/* ========================================
JAVASCRIPT ENHANCEMENTS - Add to main.js
Add these functions to your existing main.js file
======================================== */

// Enhanced header scroll effects - Add this to your existing scroll function
function enhancedHeaderScroll() {
    const header = document.getElementById("myHeader");
    if (!header) return;

    let lastScrollTop = 0;
    const scrollThreshold = 50;

    window.addEventListener('scroll', function () {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Add/remove scrolled class based on scroll position
        if (scrollTop > scrollThreshold) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }

        lastScrollTop = scrollTop;
    });
}

// Mobile dropdown handling - ensures proper behavior on touch devices
function initMobileDropdowns() {
    function isMobile() {
        return window.innerWidth < 992;
    }

    // Prevent hover effects on mobile/tablet
    document.addEventListener('DOMContentLoaded', function () {
        const dropdowns = document.querySelectorAll('.nav-item.dropdown');

        dropdowns.forEach(dropdown => {
            const dropdownMenu = dropdown.querySelector('.dropdown-menu-modern');
            const dropdownToggle = dropdown.querySelector('.dropdown-toggle');

            if (isMobile()) {
                // On mobile, ensure Bootstrap handles the clicks
                dropdownToggle.addEventListener('click', function (e) {
                    // Let Bootstrap handle the dropdown behavior
                    if (!dropdownMenu.classList.contains('show')) {
                        // Close other open dropdowns
                        document.querySelectorAll('.dropdown-menu-modern.show').forEach(otherMenu => {
                            if (otherMenu !== dropdownMenu) {
                                otherMenu.classList.remove('show');
                            }
                        });
                    }
                });
            }
        });
    });

    // Handle window resize - close dropdowns when switching to desktop
    window.addEventListener('resize', function () {
        if (!isMobile()) {
            const openDropdowns = document.querySelectorAll('.dropdown-menu-modern.show');
            openDropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }
    });
}

// Close dropdowns when clicking outside (mobile enhancement)
function initDropdownClickOutside() {
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.dropdown')) {
            const openDropdowns = document.querySelectorAll('.dropdown-menu-modern.show');
            openDropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }
    });
}

// Keyboard accessibility enhancements
function initKeyboardNavigation() {
    document.addEventListener('keydown', function (e) {
        // Close dropdowns on Escape key
        if (e.key === 'Escape') {
            const openDropdowns = document.querySelectorAll('.dropdown-menu-modern.show');
            openDropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
            });

            // Return focus to the toggle button
            const activeDropdown = document.querySelector('.nav-item.dropdown .dropdown-toggle:focus');
            if (activeDropdown) {
                activeDropdown.focus();
            }
        }

        // Arrow key navigation within dropdowns
        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
            const activeElement = document.activeElement;
            if (activeElement.classList.contains('dropdown-toggle') ||
                activeElement.classList.contains('dropdown-item')) {

                e.preventDefault();
                const dropdown = activeElement.closest('.dropdown');
                const dropdownItems = dropdown.querySelectorAll('.dropdown-item');
                const currentIndex = Array.from(dropdownItems).indexOf(activeElement);

                let nextIndex;
                if (e.key === 'ArrowDown') {
                    nextIndex = currentIndex < dropdownItems.length - 1 ? currentIndex + 1 : 0;
                } else {
                    nextIndex = currentIndex > 0 ? currentIndex - 1 : dropdownItems.length - 1;
                }

                if (dropdownItems[nextIndex]) {
                    dropdownItems[nextIndex].focus();
                }
            }
        }
    });
}

// Smooth scroll enhancement for anchor links
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Loading state handler for dropdowns (optional enhancement)
function initDropdownLoadingStates() {
    const dropdowns = document.querySelectorAll('.dropdown-menu-modern');

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.parentElement.querySelector('.dropdown-toggle');

        toggle.addEventListener('click', function () {
            // Add loading state briefly (useful for dynamic content)
            dropdown.setAttribute('data-loading', 'true');

            setTimeout(() => {
                dropdown.removeAttribute('data-loading');
            }, 200);
        });
    });
}

// Performance optimization - debounced scroll handler
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Enhanced scroll performance
const optimizedScrollHandler = debounce(function () {
    enhancedHeaderScroll();
}, 10);

// Initialize all enhancements
function initModernNavigation() {
    // Initialize all modern navigation features
    enhancedHeaderScroll();
    initMobileDropdowns();
    initDropdownClickOutside();
    initKeyboardNavigation();
    initSmoothScroll();
    initDropdownLoadingStates();

    // Replace default scroll handler with optimized version
    window.removeEventListener('scroll', window.myFunction);
    window.addEventListener('scroll', optimizedScrollHandler);

    console.log('Modern navigation initialized');
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', initModernNavigation);

// Also initialize on window load for safety
window.addEventListener('load', function () {
    // Ensure everything is initialized after all resources load
    setTimeout(initModernNavigation, 100);
});

// Export functions for potential external use
window.modernNav = {
    init: initModernNavigation,
    isMobile: function () { return window.innerWidth < 992; },
    closeAllDropdowns: function () {
        document.querySelectorAll('.dropdown-menu-modern.show').forEach(dropdown => {
            dropdown.classList.remove('show');
        });
    }
};