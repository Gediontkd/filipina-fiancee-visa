<!-- Updated Header with Modern Navigation -->
<div id="loader-wrapper">
    <div id="loader">
        <span class="cssload-loader">
            <span class="cssload-loader-inner"></span>
        </span>
    </div>
</div>

<!-- Header Start -->
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
                <span class="navbar-bar-icon"><i class="fas fa-bars"></i></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- Click-to-Call Desktop -->
                    <li class="nav-item phone_nav d-none d-md-block">
                        <a class="nav-link btn-call-desktop" href="tel:702-426-4503">
                            <i class="fas fa-phone-alt"></i> 702-426-4503
                        </a>
                    </li>
                    
                    <!-- Our Services Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('message.ourServices') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-modern" aria-labelledby="servicesDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('fiancee.visa') }}">
                                    <i class="fas fa-heart"></i>
                                    <div>
                                        <strong>Fiancé(e) Visa (K-1)</strong>
                                        <small>Bring your fiancé(e) to the US</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('spouse.visa') }}">
                                    <i class="fas fa-ring"></i>
                                    <div>
                                        <strong>Spouse Visa (CR-1/IR-1)</strong>
                                        <small>For married couples</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('adjustment.visa') }}">
                                    <i class="fas fa-id-card"></i>
                                    <div>
                                        <strong>Adjustment of Status</strong>
                                        <small>Get your Green Card</small>
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('service') }}">
                                    <i class="fas fa-th-list"></i>
                                    <strong>View All Services</strong>
                                </a>
                            </li>
                        </ul>
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
                                <a class="dropdown-item" href="{{ route('resource') }}#k1-vs-cr1">
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
/* Modern Navigation Styles */
/* #myHeader {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
} */

#myHeader.scrolled {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

/* Logo adjustments */
.navbar-brand img {
    height: 35px;
    transition: transform 0.3s ease;
}

.navbar-brand:hover img {
    transform: scale(1.05);
}

/* Modern Dropdown Styling */
.dropdown-menu-modern {
    border: none;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    padding: 0.5rem 0;
    min-width: 280px;
    animation: slideDown 0.3s ease;
    z-index: 1050;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-item {
    padding: 0.75rem 1.25rem;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
    border-radius: 8px;
    margin: 4px 8px;
}

.dropdown-item i {
    font-size: 1.2rem;
    color: #667eea;
    width: 24px;
    text-align: center;
}

.dropdown-item:hover {
    background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
    transform: translateX(5px);
}

.dropdown-item div {
    display: flex;
    flex-direction: column;
}

.dropdown-item strong {
    color: #333;
    font-size: 0.95rem;
}

.dropdown-item small {
    color: #666;
    font-size: 0.8rem;
    margin-top: 2px;
}

/* Nav Links */
.navbar-nav .nav-link {
    color: #333 !important; /* Changed from white to dark */
    font-weight: 500;
    padding: 0.75rem 1rem;
    border-radius: 25px;
    transition: all 0.3s ease;
    position: relative;
}

.navbar-nav .nav-link:hover {
    background: rgba(0, 0, 0, 0.05); /* Changed to dark overlay */
    transform: translateY(-2px);
}

/* Phone Button Styling */
.btn-call-desktop {
    background: rgba(0, 0, 0, 0.05); /* Changed for white header */
    border-radius: 25px;
    padding: 0.5rem 1rem !important;
    margin-right: 1rem;
    color: #333; /* Add dark text color */
}

.btn-call-desktop:hover {
    background: rgba(255, 255, 255, 0.3);
}

.btn-call-mobile {
    background: #28a745;
    color: white;
    border-radius: 25px;
    padding: 0.4rem 0.8rem;
    font-size: 0.9rem;
    margin-right: 10px;
}

/* Auth Buttons */
.btn-outline-light {
    border-radius: 25px;
    padding: 0.5rem 1.25rem;
    border: 2px solid #667eea; /* Changed to purple border */
    color: #667eea !important; /* Changed to purple text */
    font-weight: 500;
    background: transparent;
}

.btn-outline-light:hover {
    background: #667eea;
    color: white !important;
    border-color: #667eea;
}

.btn-get-started {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    border-radius: 25px;
    padding: 0.5rem 1.5rem;
    font-weight: 600;
    color: white !important; /* Ensure white text */
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    transition: all 0.3s ease;
}

.btn-get-started:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
}

/* User Avatar */
.user-avatar {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    margin-right: 8px;
}

.user-menu {
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 25px;
    padding: 0.3rem 1rem !important;
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .dropdown-menu-modern {
        min-width: 100%;
        margin-top: 10px;
    }
    
    .navbar-nav {
        padding: 1rem 0;
    }
    
    .navbar-nav .nav-item {
        margin: 0.25rem 0;
    }
    
    .btn-get-started {
        width: 100%;
        margin-top: 1rem;
    }
}

/* Smooth Scrolling */
html {
    scroll-behavior: smooth;
}

/* Accessibility Focus States */
.nav-link:focus,
.dropdown-item:focus,
.btn:focus {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}
</style>

<script>
// Add scroll effect to header
window.addEventListener('scroll', function() {
    const header = document.getElementById('myHeader');
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});
</script>