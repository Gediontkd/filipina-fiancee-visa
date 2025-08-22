<!-- Fixed Modern Footer -->
<footer class="footer-modern">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-widget">
                        <img src="{{ asset('assets/img/logo-new.jpg') }}" alt="Filipina Fiancee Visa" class="footer-logo mb-3">
                        <p class="footer-desc">
                            Your trusted partner in bringing Filipino couples together in the USA. 
                            15+ years of experience with 99.2% approval rate.
                        </p>
                        <div class="footer-contact">
                            <div class="contact-item">
                                <i class="fas fa-phone-alt"></i>
                                <a href="tel:702-426-4503">702-426-4503</a>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-clock"></i>
                                <span>Mon-Fri: 8AM-5PM PST</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Las Vegas, NV 89149</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h4 class="widget-title">Services</h4>
                        <ul class="footer-links">
                            <li>
                                <a href="{{ route('fiancee.visa') }}">
                                    <i class="fas fa-chevron-right"></i> K-1 Fiancé(e) Visa
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('spouse.visa') }}">
                                    <i class="fas fa-chevron-right"></i> CR-1 Spouse Visa
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('adjustment.visa') }}">
                                    <i class="fas fa-chevron-right"></i> Adjustment of Status
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('service') }}">
                                    <i class="fas fa-chevron-right"></i> All Services
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Resources -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h4 class="widget-title">Resources</h4>
                        <ul class="footer-links">
                            <li>
                                <a href="{{ route('resource') }}">
                                    <i class="fas fa-chevron-right"></i> Resource Center
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('resource') }}">
                                    <i class="fas fa-chevron-right"></i> K-1 vs CR-1
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('resource') }}">
                                    <i class="fas fa-chevron-right"></i> Requirements
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('testimonial') }}">
                                    <i class="fas fa-chevron-right"></i> Success Stories
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Company -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h4 class="widget-title">Company</h4>
                        <ul class="footer-links">
                            <li>
                                <a href="{{ route('about-us') }}">
                                    <i class="fas fa-chevron-right"></i> About Us
                                </a>
                            </li>
                            @if(Route::has('guarantee'))
                            <li>
                                <a href="{{ route('guarantee') }}">
                                    <i class="fas fa-chevron-right"></i> Our Guarantee
                                </a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ route('contactUs') }}">
                                    <i class="fas fa-chevron-right"></i> Contact
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fas fa-chevron-right"></i> Privacy Policy
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Newsletter -->
                <div class="col-lg-2 col-md-12 mb-4">
                    <div class="footer-widget">
                        <h4 class="widget-title">Stay Updated</h4>
                        <p class="newsletter-text">
                            Get visa tips and updates delivered to your inbox
                        </p>
                        {{ Form::open(['url' => route('newsletter'), 'class' => 'newsletter-form-modern', 'id' => 'footerNewsletter']) }}
                            <div class="input-wrapper">
                                {{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Your email', 'required' => true]) }}
                                {{ Form::button('<i class="fas fa-paper-plane"></i>', ['class' => 'btn-submit', 'type' => 'submit', 'aria-label' => 'Subscribe']) }}
                            </div>
                        {{ Form::close() }}
                        
                        <!-- Social Links -->
                        <div class="social-links mt-4">
                            <a href="https://www.facebook.com/FilipinaFianceeVisa/" target="_blank" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" target="_blank" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" target="_blank" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" target="_blank" aria-label="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bottom Bar -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright">
                        © 2025 {{ __('message.filipinaFianceeVisa') }}. {{ __('message.allRightsReserved') }}
                    </p>
                    <p class="copyright-detail">
                        {{ __('message.copyRightDetail') }}
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="footer-badges">
                        <img src="{{ asset('assets/img/BBB_A_Rating.png') }}" alt="BBB A+ Rating" height="40">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back to Top Button -->
    <a id="back-top" class="back-to-top-modern" href="javascript:void(0)" aria-label="Back to top">
        <i class="fas fa-chevron-up"></i>
    </a>
</footer>

<style>
/* Modern Footer Styles */
.footer-modern {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: #ecf0f1;
    position: relative;
    overflow: hidden;
    margin-top: 60px;
}

.footer-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, #667eea, transparent);
}

.footer-top {
    padding: 60px 0 40px;
}

.footer-widget {
    margin-bottom: 30px;
}

.footer-logo {
    height: 40px;
    filter: brightness(0) invert(1);
}

.footer-desc {
    color: #bdc3c7;
    line-height: 1.8;
    margin-bottom: 20px;
}

.footer-contact .contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    color: #bdc3c7;
}

.footer-contact .contact-item i {
    color: #667eea;
    width: 20px;
}

.footer-contact .contact-item a {
    color: #ecf0f1;
    text-decoration: none;
    transition: color 0.3s;
}

.footer-contact .contact-item a:hover {
    color: #667eea;
}

.widget-title {
    color: #fff;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
}

.widget-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 2px;
    background: #667eea;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: #bdc3c7;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
}

.footer-links a:hover {
    color: #667eea;
    transform: translateX(5px);
}

.footer-links i {
    font-size: 0.75rem;
    opacity: 0.5;
}

/* Newsletter Form */
.newsletter-text {
    color: #bdc3c7;
    margin-bottom: 15px;
    font-size: 0.95rem;
}

.newsletter-form-modern .input-wrapper {
    position: relative;
    display: flex;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50px;
    overflow: hidden;
}

.newsletter-form-modern .form-control {
    background: transparent;
    border: none;
    color: white;
    padding: 12px 20px;
    flex: 1;
}

.newsletter-form-modern .form-control::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.newsletter-form-modern .form-control:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.05);
}

.newsletter-form-modern .btn-submit {
    background: #667eea;
    border: none;
    color: white;
    padding: 12px 20px;
    cursor: pointer;
    transition: background 0.3s;
}

.newsletter-form-modern .btn-submit:hover {
    background: #764ba2;
}

/* Social Links */
.social-links {
    display: flex;
    gap: 10px;
}

.social-links a {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    transition: all 0.3s;
}

.social-links a:hover {
    background: #667eea;
    transform: translateY(-3px);
}

/* Footer Bottom */
.footer-bottom {
    background: rgba(0, 0, 0, 0.2);
    padding: 20px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.copyright {
    margin: 0;
    color: #bdc3c7;
    font-size: 0.95rem;
}

.copyright-detail {
    margin-top: 5px;
    color: #95a5a6;
    font-size: 0.85rem;
}

.footer-badges {
    display: flex;
    gap: 20px;
    justify-content: flex-end;
    align-items: center;
}

.footer-badges img {
    opacity: 0.8;
    transition: opacity 0.3s;
}

.footer-badges img:hover {
    opacity: 1;
}

/* Back to Top Button */
.back-to-top-modern {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    color: white;
    font-size: 1.2rem;
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s;
    z-index: 1000;
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.back-to-top-modern.show {
    opacity: 1;
    visibility: visible;
}

.back-to-top-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.6);
    color: white;
}

/* Mobile Responsive */
@media (max-width: 991px) {
    .footer-badges {
        justify-content: center;
        margin-top: 20px;
    }
    
    .copyright {
        text-align: center;
    }
}

@media (max-width: 767px) {
    .footer-top {
        padding: 40px 0 20px;
    }
    
    .widget-title {
        font-size: 1.1rem;
    }
    
    .social-links {
        justify-content: center;
        margin-top: 20px;
    }
    
    .back-to-top-modern {
        bottom: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
}
</style>

<script>
// Back to Top Button Functionality
document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.querySelector('.back-to-top-modern');
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });
    
    // Smooth scroll to top
    if (backToTopButton) {
        backToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Newsletter form submission
    const newsletterForm = document.getElementById('footerNewsletter');
    if (newsletterForm) {
        // Your existing newsletter validation should work
        $("#footerNewsletter").validate({    
            rules: {
                email: {
                    required: true,
                    email: true
                },		         	          
            },
            messages: {
                email: "Please enter a valid email address",		         	              
            },      	
        });
    }
});
</script>