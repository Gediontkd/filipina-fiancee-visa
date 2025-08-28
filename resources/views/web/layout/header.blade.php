<!-- Complete Navigation Header -->
<div id="loader-wrapper">
    <div id="loader">
        <span class="cssload-loader">
            <span class="cssload-loader-inner"></span>
        </span>
    </div>
</div>

<!-- Updated Navigation with Two-Column Services Dropdown -->
<header id="myHeader">
    <nav class="navbar navbar-expand-md navbar-dark py-0 header_px20">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/img/logo-new.jpg') }}" alt="Filipina Fiancee Visa Logo" />
            </a>
           
            <!-- Mobile Click-to-Call Button -->
            <a href="tel:702-426-4503" class="btn btn-call-mobile d-md-none">
                <i class="fas fa-phone"></i> Call Now
            </a>
           
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
           
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- Click-to-Call Desktop -->
                    <li class="nav-item phone_nav d-none d-md-block">
                        <a class="nav-link btn-call-desktop" href="tel:702-426-4503">
                            <i class="fas fa-phone-alt"></i> 702-426-4503
                        </a>
                    </li>
                   
                    <!-- Our Services Dropdown - TWO COLUMN LAYOUT -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('message.ourServices') }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-modern dropdown-menu-two-column" aria-labelledby="servicesDropdown">
                            <div class="dropdown-grid">
                                <!-- Left Column - Primary Services -->
                                <div class="dropdown-column">
                                    <div class="column-header">
                                        <h6>Primary Services</h6>
                                    </div>
                                    <a class="dropdown-item" href="{{ route('fiancee.visa') }}">
                                        <i class="fas fa-heart"></i>
                                        <div>
                                            <strong>K-1 Fiancé(e) Visa</strong>
                                            <small>Bring your fiancé(e) to the US</small>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('spouse.visa') }}">
                                        <i class="fas fa-ring"></i>
                                        <div>
                                            <strong>CR-1/IR-1 Spouse Visa</strong>
                                            <small>For married couples</small>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('adjustment.visa') }}">
                                        <i class="fas fa-id-card"></i>
                                        <div>
                                            <strong>Adjustment of Status</strong>
                                            <small>Get your Green Card</small>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('removal.conditions') }}">
                                        <i class="fas fa-file-contract"></i>
                                        <div>
                                            <strong>Removal of Conditions</strong>
                                            <small>Remove Green Card conditions</small>
                                        </div>
                                    </a>
                                </div>
                                
                                <!-- Right Column - Additional Services -->
                                <div class="dropdown-column">
                                    <div class="column-header">
                                        <h6>Additional Services</h6>
                                    </div>
                                    <a class="dropdown-item" href="{{ route('ir5.parent.visa') }}">
                                        <i class="fas fa-users"></i>
                                        <div>
                                            <strong>IR5 Parent Visa</strong>
                                            <small>Petition for parents</small>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('petition.child') }}">
                                        <i class="fas fa-baby"></i>
                                        <div>
                                            <strong>Petition a Child</strong>
                                            <small>Bring your child to the US</small>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('naturalization') }}">
                                        <i class="fas fa-flag-usa"></i>
                                        <div>
                                            <strong>Naturalization</strong>
                                            <small>Become a US citizen</small>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('combined.cr1.aos') }}">
                                        <i class="fas fa-handshake"></i>
                                        <div>
                                            <strong>Special Combined</strong>
                                            <small>"Marry-on-tourist-visa"</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Full Width Bottom Section -->
                            <div class="dropdown-footer">
                                <hr class="dropdown-divider">
                                <a class="dropdown-item dropdown-item-full" href="{{ route('service') }}">
                                    <i class="fas fa-th-list"></i>
                                    <strong>View All Services & Pricing</strong>
                                </a>
                            </div>
                        </div>
                    </li>
                   
                    <!-- Resources Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="resourcesDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('message.resource') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-modern" aria-labelledby="resourcesDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('resource') }}#faqs">
                                    <i class="fas fa-question-circle"></i> FAQs
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('resource') }}#guides">
                                    <i class="fas fa-book"></i> Visa Guides
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('home') }}#k1-vs-cr1">
                                    <i class="fas fa-balance-scale"></i> K-1 vs CR-1 Comparison
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('resource') }}#requirements">
                                    <i class="fas fa-clipboard-list"></i> Requirements
                                </a>
                            </li>
                        </ul>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about-us') }}">
                            {{ __('message.aboutUs') }}
                        </a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('testimonial') }}">
                            {{ __('message.testimonials') }}
                        </a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contactUs') }}">
                            {{ __('message.contactUs') }}
                        </a>
                    </li>
                   
                    <!-- Auth Section -->
                    @if (Auth::user())
                        <li class="nav-item dropdown user-dropdown">
                            <a class="nav-link dropdown-toggle user-menu" href="#" id="userDropdown"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.page', 'progress') }}">
                                        <i class="fas fa-user"></i> My Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.page', 'my-petition') }}">
                                        <i class="fas fa-file-alt"></i> My Applications
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="post" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item logout-btn">
                                            <i class="fas fa-sign-out-alt"></i> {{ __('message.logout') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ms-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                                {{ __('message.login') }}
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm btn-get-started">
                                Start Application
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

<style>
/* Enhanced Header Styles with Hover Dropdowns - Glass Effect */
header#myHeader {
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(20px) !important;
    -webkit-backdrop-filter: blur(20px) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12) !important;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
    padding: 15px 0 !important;
    position: relative;
    z-index: 1000;
}

header#myHeader.scrolled {
    background: rgba(255, 255, 255, 0.98) !important;
    backdrop-filter: blur(25px) !important;
    -webkit-backdrop-filter: blur(25px) !important;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.18) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.3) !important;
    padding: 10px 0 !important;
}

header#myHeader.sticky {
    background: rgba(255, 255, 255, 0.98) !important;
    backdrop-filter: blur(25px) !important;
    -webkit-backdrop-filter: blur(25px) !important;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.18) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.3) !important;
    padding: 8px 0 !important;
}

.navbar-brand img {
    height: 40px;
    transition: transform 0.3s ease;
}

.navbar-brand:hover img {
    transform: scale(1.05);
}

/* Header Spacing Enhancement */
header .navbar.header_px20 {
    padding-left: 25px;
    padding-right: 25px;
}

/* Desktop Hover Dropdown Functionality */
@media (min-width: 992px) {
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        animation: slideDownSmooth 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .nav-item.dropdown .dropdown-menu {
        margin-top: 0;
        border-top: 3px solid transparent;
        transition: all 0.3s ease;
    }
    
    /* Prevent dropdown from hiding when hovering over the gap */
    .nav-item.dropdown:hover .dropdown-menu {
        margin-top: -3px;
        border-top: 3px solid transparent;
    }
}

/* Enhanced Dropdown Styles */
.dropdown-menu-modern {
    border: none;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    padding: 0;
    z-index: 1050;
    overflow: hidden;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.98);
}

/* Two-Column Services Dropdown Enhanced */
.dropdown-menu-two-column {
    min-width: 600px;
    max-width: 600px;
}

.dropdown-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
}

.dropdown-column {
    padding: 1.5rem;
    min-height: 300px;
}

.dropdown-column:first-child {
    border-right: 1px solid rgba(102, 126, 234, 0.1);
}

.column-header {
    margin-bottom: 1.25rem;
    padding-bottom: 0.75rem;
    border-bottom: 3px solid #667eea;
    position: relative;
}

.column-header::after {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.column-header h6 {
    color: #667eea;
    font-weight: 700;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 0;
}

.dropdown-footer {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 1rem 1.5rem;
    border-top: 1px solid rgba(102, 126, 234, 0.1);
}

.dropdown-item-full {
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white !important;
    border-radius: 10px;
    margin: 0;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    padding: 1rem;
}

.dropdown-item-full:hover {
    color: white !important;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

.dropdown-item-full i {
    color: white !important;
}

/* Smooth Animation Enhanced */
@keyframes slideDownSmooth {
    from {
        opacity: 0;
        transform: translateY(-25px) scale(0.95);
        filter: blur(5px);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
        filter: blur(0px);
    }
}

.dropdown-item {
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 12px;
    margin: 6px 0;
    text-decoration: none;
    position: relative;
    overflow: hidden;
}

.dropdown-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
    transition: all 0.3s ease;
}

.dropdown-item:hover::before {
    left: 0;
}

.dropdown-item i {
    font-size: 1.3rem;
    color: #667eea;
    width: 28px;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.dropdown-item:hover {
    transform: translateX(10px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.15);
}

.dropdown-item:hover i {
    color: #667eea;
    transform: scale(1.15) rotate(5deg);
}

.dropdown-item div {
    display: flex;
    flex-direction: column;
    position: relative;
    z-index: 1;
}

.dropdown-item strong {
    color: #333;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 2px;
}

.dropdown-item small {
    color: #666;
    font-size: 0.85rem;
    line-height: 1.3;
}

/* Navigation Link Styles Enhanced */
.navbar-nav .nav-link {
    color: #333 !important;
    font-weight: 500;
    padding: 0.875rem 1.25rem;
    border-radius: 30px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.navbar-nav .nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(102, 126, 234, 0.1);
    transition: all 0.3s ease;
    border-radius: 30px;
}

.navbar-nav .nav-link:hover::before {
    left: 0;
}

.navbar-nav .nav-link:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.btn-call-desktop {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white !important;
    border-radius: 30px;
    padding: 0.75rem 1.5rem !important;
    margin-right: 1rem;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
    transition: all 0.3s ease;
}

.btn-call-desktop:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
    color: white !important;
}

.btn-call-mobile {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border-radius: 30px;
    padding: 0.6rem 1rem;
    font-size: 0.9rem;
    margin-right: 10px;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
    transition: all 0.3s ease;
}

.btn-call-mobile:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
}

.btn-outline-light {
    border-radius: 30px;
    padding: 0.75rem 1.5rem;
    border: 2px solid #667eea;
    color: #667eea !important;
    font-weight: 600;
    background: transparent;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.btn-outline-light::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: #667eea;
    transition: all 0.3s ease;
}

.btn-outline-light span {
    position: relative;
    z-index: 1;
}

/* Fix invisible mobile toggle button */
.navbar-toggler {
    border: 1px solid #333 !important;
    background: rgba(51, 51, 51, 0.1) !important;
    border-radius: 8px !important;
    padding: 6px 8px !important;
}


.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2833, 37, 41, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
    width: 20px !important;
    height: 20px !important;
}

.navbar-toggler:focus {
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.5) !important;
}

.btn-outline-light:hover::before {
    left: 0;
}

.btn-outline-light:hover {
    color: white !important;
    border-color: #667eea;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
}

.btn-get-started {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 30px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    color: white !important;
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.btn-get-started::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    transition: all 0.3s ease;
}

.btn-get-started span {
    position: relative;
    z-index: 1;
}

.btn-get-started:hover::before {
    left: 0;
}

.btn-get-started:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
    color: white !important;
}

.user-avatar {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    margin-right: 10px;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
}

.user-menu {
    display: flex;
    align-items: center;
    background: rgba(102, 126, 234, 0.1);
    border-radius: 30px;
    padding: 0.5rem 1.25rem !important;
    transition: all 0.3s ease;
}

.user-menu:hover {
    background: rgba(102, 126, 234, 0.15);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
}

/* Mobile Responsive Enhanced */
@media (max-width: 991px) {
    .dropdown-menu-two-column {
        min-width: 100%;
        max-width: none;
        border-radius: 12px;
        margin-top: 8px;
    }
    
    .dropdown-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .dropdown-column:first-child {
        border-right: none;
        border-bottom: 1px solid rgba(102, 126, 234, 0.1);
        padding-bottom: 1.5rem;
    }
    
    .dropdown-column {
        min-height: auto;
        padding: 1.25rem;
    }
    
    header .navbar.header_px20 {
        padding-left: 15px;
        padding-right: 15px;
    }
}

@media (max-width: 767px) {
    .dropdown-menu-modern {
        min-width: 100%;
        margin-top: 12px;
        border-radius: 12px;
    }
    
    .navbar-nav {
        padding: 1.25rem 0;
    }
    
    .navbar-nav .nav-item {
        margin: 0.5rem 0;
    }
    
    .btn-get-started {
        width: 100%;
        margin-top: 1.25rem;
    }
    
    .dropdown-item {
        padding: 1.25rem;
    }
    
    .dropdown-item:hover {
        transform: none;
    }
    
    header .navbar.header_px20 {
        padding-left: 10px;
        padding-right: 10px;
    }
}

/* Focus and Accessibility Enhanced */
.nav-link:focus,
.dropdown-item:focus,
.btn:focus {
    outline: 3px solid #667eea;
    outline-offset: 3px;
    box-shadow: 0 0 0 6px rgba(102, 126, 234, 0.2);
}

/* High Performance Animation */
.dropdown-menu-modern * {
    backface-visibility: hidden;
    transform-style: preserve-3d;
}

/* Prevent dropdown flicker on hover */
@media (min-width: 992px) {
    .nav-item.dropdown {
        position: static;
    }
    
    .nav-item.dropdown .dropdown-menu {
        position: absolute;
        will-change: transform, opacity;
    }
}
</style>

<script>
window.addEventListener('scroll', function() {
    const header = document.getElementById('myHeader');
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Optional: Add hover effects for desktop only via CSS (no JS interference)
document.addEventListener('DOMContentLoaded', function() {
    // Let Bootstrap handle all dropdown functionality
    // This ensures mobile click-to-open works properly
});
</script>