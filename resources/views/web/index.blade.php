<!-- resources\views\web\index.blade.php -->
@extends('web.layout.master')
@section('content')
<!-- Hero Section with Strong CTA -->
<section id="banner" class="banner-home-modern">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="hero-content text-center">
                    <!-- Trust Badge -->
                    <div class="trust-badge" data-aos="fade-down">
                        <img src="{{ asset('assets/img/BBB_A_Rating.png') }}" alt="BBB A+ Rating" height="60">
                        <span class="badge-text">BBB A+ Rated • 20+ Years Experience</span>
                    </div>
                    
                    <!-- Main Headline -->
                    <h1 class="hero-title" data-aos="fade-up">
                        Bringing couples together for over 20 years.
                    </h1>
                    
                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
                        Expert visa assistance with 99% approval rate. 
                        We handle the paperwork, you focus on your future together.
                    </p>
                    
                    <!-- Quick Service Selection -->
                    <div class="service-selector" data-aos="fade-up" data-aos-delay="200">
                        <p class="selector-label">What do you need help with?</p>
                        <div class="service-buttons">
                            <a href="{{ route('fiancee.visa') }}" class="service-btn">
                                <i class="fas fa-heart"></i>
                                <span>K-1 Fiancé(e) Visa</span>
                                <small>Not married yet</small>
                            </a>
                            <a href="{{ route('spouse.visa') }}" class="service-btn">
                                <i class="fas fa-ring"></i>
                                <span>CR-1 Spouse Visa</span>
                                <small>Already married</small>
                            </a>
                            <a href="{{ route('adjustment.visa') }}" class="service-btn">
                                <i class="fas fa-id-card"></i>
                                <span>Green Card</span>
                                <small>Already in US</small>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Main CTA -->
                    <div class="hero-cta" data-aos="fade-up" data-aos-delay="300">
                        <a href="{{ route('register') }}" class="btn btn-primary-gradient btn-lg">
                            Start Your Application Now
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        <div class="or-divider">or</div>
                        <a href="tel:702-426-4503" class="btn btn-call btn-lg">
                            <i class="fas fa-phone-alt"></i> 
                            Call 702-426-4503
                        </a>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="hero-stats" data-aos="fade-up" data-aos-delay="400">
                        <div class="stat">
                            <strong>5,000+</strong>
                            <span>Happy Couples</span>
                        </div>
                        <div class="stat">
                            <strong>99%</strong>
                            <span>Approval Rate</span>
                        </div>
                        <div class="stat">
                            <strong>9-12</strong>
                            <span>Months Average</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

<!-- Quick Comparison Section -->
<section id="k1-vs-cr1" class="comparison-section ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="comparison-card" data-aos="fade-up">
                    <h2 class="section-title-modern text-center mb-4">
                        Not Sure Which Visa You Need?
                    </h2>
                    
                    <div class="comparison-grid">
                        <div class="comparison-item">
                            <div class="comparison-icon k1">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h3>K-1 Fiancé(e) Visa</h3>
                            <ul class="feature-list">
                                <li><i class="fas fa-check"></i> Fastest option (9-12 months)</li>
                                <li><i class="fas fa-check"></i> Get married in the US</li>
                                <li><i class="fas fa-check"></i> 90 days to marry after arrival</li>
                                <li><i class="fas fa-check"></i> Less documentation required</li>
                            </ul>
                            <a href="{{ route('fiancee.visa') }}" class="btn btn-outline-primary">
                                Learn More <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                        
                        <div class="vs-divider">
                            <span>VS</span>
                        </div>
                        
                        <div class="comparison-item">
                            <div class="comparison-icon cr1">
                                <i class="fas fa-ring"></i>
                            </div>
                            <h3>CR-1 Spouse Visa</h3>
                            <ul class="feature-list">
                                <li><i class="fas fa-check"></i> Already married</li>
                                <li><i class="fas fa-check"></i> Green card on arrival</li>
                                <li><i class="fas fa-check"></i> Can work immediately</li>
                                <li><i class="fas fa-check"></i> Takes 12-18 months</li>
                            </ul>
                            <a href="{{ route('spouse.visa') }}" class="btn btn-outline-primary">
                                Learn More <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <p class="help-text">
                            Still confused? 
                            <a href="tel:702-426-4503" class="text-primary fw-bold">
                                Call us for free consultation
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Overview -->
<section class="process-overview bg-light ptb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center mb-5">
                <h2 class="section-title-modern" data-aos="fade-up">
                    Simple 3-Phase Process
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                    We guide you through every step, from petition to arrival
                </p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="process-card">
                    <div class="process-number">1</div>
                    <div class="process-icon">
                        <img src="{{ asset('assets/img/icons/icon-1.png') }}" alt="USCIS Phase">
                    </div>
                    <h3>USCIS Phase</h3>
                    <p>We prepare and file your petition with perfect accuracy</p>
                    <div class="process-timeline">3-6 months</div>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="process-card">
                    <div class="process-number">2</div>
                    <div class="process-icon">
                        <img src="{{ asset('assets/img/icons/icon-2.png') }}" alt="NVC Phase">
                    </div>
                    <h3>NVC Phase</h3>
                    <p>Document processing and background checks</p>
                    <div class="process-timeline">2-4 months</div>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="process-card">
                    <div class="process-number">3</div>
                    <div class="process-icon">
                        <img src="{{ asset('assets/img/icons/icon-3.png') }}" alt="Embassy Phase">
                    </div>
                    <h3>Embassy Phase</h3>
                    <p>Interview preparation and visa issuance</p>
                    <div class="process-timeline">2-3 months</div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="500">
            <a href="{{ route('register') }}" class="btn btn-primary-gradient btn-lg">
                Start Your Journey Today
            </a>
        </div>
    </div>
</section>

<!-- Video Section -->
<section class="video-section ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="video-container" data-aos="zoom-in">
                    <h2 class="section-title-modern text-center mb-4">
                        See How We Make It Simple
                    </h2>
                    <div class="video-wrapper">
                        <video 
                            controls 
                            playsinline 
                            poster="{{ asset('assets/img/video-poster.jpg') }}"
                            preload="metadata">
                            <source src="/assets/img/ffv.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <button class="play-button" aria-label="Play video">
                            <i class="fas fa-play"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-modern ptb-80 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center mb-5">
                <h2 class="section-title-modern" data-aos="fade-up">
                    Thousands <br> of Couples United.
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                    Real stories from couples we've helped unite
                </p>
            </div>
        </div>
        
        <div class="testimonials-carousel" data-aos="fade-up" data-aos-delay="200">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="testimonial-card">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "They made the whole process painless. I'm so grateful for their help!"
                        </p>
                        <div class="testimonial-author">
                            <img src="{{ asset('assets/img/image-1.png') }}" alt="David">
                            <div>
                                <strong>David</strong>
                                <span>K-1 Visa Success</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="testimonial-card">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "I received my visa today! I couldn't have done this without you."
                        </p>
                        <div class="testimonial-author">
                            <img src="{{ asset('assets/img/image-2.png') }}" alt="Farah">
                            <div>
                                <strong>Farah</strong>
                                <span>Now in the USA</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="testimonial-card">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "Excellent service! Very knowledgeable and answered all our questions."
                        </p>
                        <div class="testimonial-author">
                            <img src="{{ asset('assets/img/image-3.png') }}" alt="Lovely">
                            <div>
                                <strong>Lovely</strong>
                                <span>CR-1 Approved</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="testimonial-card">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "My fiancee was approved quickly! You guys were always there to help."
                        </p>
                        <div class="testimonial-author">
                            <img src="{{ asset('assets/img/image-4.png') }}" alt="Lester">
                            <div>
                                <strong>Lester</strong>
                                <span>Happy Client</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('testimonial') }}" class="btn btn-outline-primary">
                Read More Success Stories <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h2 class="section-title-modern text-center mb-5" data-aos="fade-up">
                    Frequently Asked Questions
                </h2>
                
                <div class="faq-accordion" data-aos="fade-up" data-aos-delay="100">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faq1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse1" aria-expanded="true">
                                    How long does the K-1 visa process take?
                                </button>
                            </h3>
                            <div id="collapse1" class="accordion-collapse collapse show" 
                                 data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    The K-1 visa process typically takes 9-12 months from start to finish. 
                                    This includes USCIS processing (3-6 months), NVC processing (2-4 months), 
                                    and embassy interview scheduling (2-3 months).
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse2" aria-expanded="false">
                                    What's the difference between K-1 and CR-1 visa?
                                </button>
                            </h3>
                            <div id="collapse2" class="accordion-collapse collapse" 
                                 data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    K-1 is for engaged couples (marry in US within 90 days), while CR-1 is for 
                                    already married couples. K-1 is faster but requires adjustment of status after 
                                    marriage. CR-1 takes longer but arrives with green card.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse3" aria-expanded="false">
                                    What are the income requirements?
                                </button>
                            </h3>
                            <div id="collapse3" class="accordion-collapse collapse" 
                                 data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You must meet 125% of the Federal Poverty Guidelines for your household size. 
                                    For 2024, this is $24,650 for a household of 2. We help you understand and 
                                    meet these requirements.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faq4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse4" aria-expanded="false">
                                    Do you offer a money-back guarantee?
                                </button>
                            </h3>
                            <div id="collapse4" class="accordion-collapse collapse" 
                                 data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! If your petition is denied by USCIS, we offer a 100% refund of our 
                                    service fees. Government fees are non-refundable. Our 99% approval rate 
                                    speaks to our expertise.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="{{ route('resource') }}#faqs" class="btn btn-outline-primary">
                        View All FAQs <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section with Working Modals -->
<section class="pricing-modern ptb-80 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center mb-5">
                <h2 class="section-title-modern" data-aos="fade-up">
                    Transparent, Affordable Pricing
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                    No hidden fees. Payment plans available.
                </p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>K-1 Fiancé(e) Visa</h3>
                        <div class="price">
                            <sup>$</sup>850
                            <span>/service fee</span>
                        </div>
                        <a href="javascript:void(0)" class="price-note" data-bs-toggle="modal" data-bs-target="#k1Modal">+ Government fees</a>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check"></i> Full support start to finish</li>
                        <li><i class="fas fa-check"></i> Unlimited phone support</li>
                        <li><i class="fas fa-check"></i> All forms prepared</li>
                        <li><i class="fas fa-check"></i> Online tracking</li>
                        <li><i class="fas fa-check"></i> Children included free</li>
                    </ul>
                    <a href="{{ route('fiancee.visa') }}" class="btn btn-primary-gradient btn-block">
                        Get Started
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="pricing-card featured">
                    <div class="badge-popular">Most Popular</div>
                    <div class="pricing-header">
                        <h3>Adjustment of Status</h3>
                        <div class="price">
                            <sup>$</sup>800
                            <span>/service fee</span>
                        </div>
                        <a href="javascript:void(0)" class="price-note" data-bs-toggle="modal" data-bs-target="#aosModal">+ Government fees</a>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check"></i> Full Support Start to Finish</li>
                        <li><i class="fas fa-check"></i> Unlimited Phone Support</li>
                        <li><i class="fas fa-check"></i> Unlimited Email Support</li>
                        <li><i class="fas fa-check"></i> Prepare All Government Forms</li>
                        <li><i class="fas fa-check"></i> Green Card Interview Support</li>
                    </ul>
                    <a href="{{ route('adjustment.visa') }}" class="btn btn-primary-gradient btn-block">
                        Get Started
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>CR-1 Spouse Visa</h3>
                        <div class="price">
                            <sup>$</sup>750
                            <span>/service fee</span>
                        </div>
                        <a href="javascript:void(0)" class="price-note" data-bs-toggle="modal" data-bs-target="#cr1Modal">+ Government fees</a>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check"></i> For married couples</li>
                        <li><i class="fas fa-check"></i> Green card on arrival</li>
                        <li><i class="fas fa-check"></i> All forms prepared</li>
                        <li><i class="fas fa-check"></i> Document assistance</li>
                        <li><i class="fas fa-check"></i> Online tracking</li>
                    </ul>
                    <a href="{{ route('spouse.visa') }}" class="btn btn-primary-gradient btn-block">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Modals -->

<!-- K-1 Fiancee Visa Modal -->
<div class="modal fade" id="k1Modal" tabindex="-1" aria-labelledby="k1ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="k1ModalLabel">K-1 Fiancé(e) Visa Pricing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cbox-3-txt mb-2">
                    <h5>Our Service Fee</h5>
                    <ul>
                        <li><i class="fas fa-stop-circle"></i> $850 Service Fee to Filipina Fiancée Visa (Paid upfront to start your petition)</li>
                    </ul>
                </div>
                <div class="cbox-3-txt mb-2">
                    <h5>Government Fees:</h5>
                    <ul>
                        <li><i class="fas fa-stop-circle"></i> $675 USCIS Filing Fee (Paid when petition is filed)</li>
                        <li><i class="fas fa-stop-circle"></i> $495 Medical Examination Fee (Due later in the process)</li>
                        <li><i class="fas fa-stop-circle"></i> $265 U.S. Embassy Visa Fee (Due before the interview)</li>
                        <li><i class="fas fa-stop-circle"></i> $2,285 Total All Fees</li>
                    </ul>
                </div>
                <div class="cbox-3-txt mb-2">
                    <h5>Extra Fees Per Child to be Included</h5>
                    <ul>
                        <li><i class="fas fa-stop-circle"></i> $200 Service Fee to Filipina Fiancée Visa (per child)</li>
                        <li><i class="fas fa-stop-circle"></i> $240 Child Medical Exam</li>
                        <li><i class="fas fa-stop-circle"></i> $265 Embassy Visa Fee</li>
                        <li><i class="fas fa-stop-circle"></i> $705 Total Fees Per Child</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Adjustment of Status Modal -->
<div class="modal fade" id="aosModal" tabindex="-1" aria-labelledby="aosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aosModalLabel">Adjustment of Status Pricing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cbox-3-txt mb-2">
                    <h5>Our Service Fee</h5>
                    <ul>
                        <li><i class="fas fa-stop-circle"></i> $800 Service Fee to Filipina Fiancée Visa</li>
                    </ul>
                </div>
                <div class="cbox-3-txt mb-2">
                    <h5>Government Fees:</h5>
                    <ul>
                        <li><i class="fas fa-stop-circle"></i> Application for residency: $1,440</li>
                        <li><i class="fas fa-stop-circle"></i> work permit: $260</li>
                        <li><i class="fas fa-stop-circle"></i> Travel permit (optional): $630</li>
                        <li><i class="fas fa-stop-circle"></i> Total Cost: $2,500</li>
                    </ul>
                </div>
                <div class="cbox-3-txt mb-2">
                    <h5>Fees for Children Filing with Parent</h5>
                    <ul>
                        <li><i class="fas fa-check"></i> $300 – Filipina Fiancée Visa Service Fee (Paid upfront)</li>
                        <li><i class="fas fa-check"></i> Government fees vary based on age and circumstances (Paid at the time of filing)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CR-1 Spouse Visa Modal -->
<div class="modal fade" id="cr1Modal" tabindex="-1" aria-labelledby="cr1ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cr1ModalLabel">CR-1 Spouse Visa Pricing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cbox-3-txt mb-2">
                    <h5>Our Service Fee</h5>
                    <ul>
                        <li><i class="fas fa-stop-circle"></i> $750 Service Fee to Filipina Fiancée Visa (Paid to get Started)</li>
                    </ul>
                </div>
                <div class="cbox-3-txt mb-2">
                    <h5>Government Fees:</h5>
                    <ul>
                        <li><i class="fas fa-stop-circle"></i> $675 Filing Fee to United States Government (Due at Filing)</li>
                        <li><i class="fas fa-stop-circle"></i> $445 National Visa Center Fees (Due Much Later)</li>
                        <li><i class="fas fa-stop-circle"></i> $495 Adult Medical Exam Fee (Due Much Later)</li>
                        <li><i class="fas fa-stop-circle"></i> $220 Immigrant Fee to US Government for Green Card (Due After Embassy Interview)</li>
                        <li><i class="fas fa-stop-circle"></i> $2,585 Total All Fees</li>
                    </ul>
                </div>
                <div class="cbox-3-txt mb-2">
                    <h5>Fees for Children (Per Child)</h5>
                    <ul>
                        <li><i class="fas fa-stop-circle"></i> $300 Service Fee to Filipina Fiancée Visa (Per Child)</li>
                        <li><i class="fas fa-stop-circle"></i> $675 Filing Fee to United States Government</li>
                        <li><i class="fas fa-stop-circle"></i> $445 National Visa Center Fees</li>
                        <li><i class="fas fa-stop-circle"></i> $240 Child Medical Exam fee (14 years and younger)</li>
                        <li><i class="fas fa-stop-circle"></i> $220 Immigrant Fee to US Government for Green Card</li>
                        <li><i class="fas fa-stop-circle"></i> $1,880 Total Fees Per Child</li>
                    </ul>
                    <p><small>Children must have been under 18 years of age as of the date you were married to qualify.</small></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced Pricing Card Styles */
.price-note {
    color: #667eea !important;
    text-decoration: underline;
    cursor: pointer;
    font-weight: 500;
    transition: color 0.3s ease;
}

.price-note:hover {
    color: #764ba2 !important;
    text-decoration: underline;
}

/* Modal Enhancements */
.modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
}

.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px 15px 0 0;
    border-bottom: none;
}

.modal-header .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}

.modal-header .btn-close:hover {
    opacity: 1;
}

.modal-title {
    font-weight: 600;
    font-size: 1.3rem;
}

.modal-body {
    padding: 2rem;
}

.cbox-3-txt h5 {
    color: #333;
    font-weight: 600;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #f1f3f4;
}

.cbox-3-txt ul {
    list-style: none;
    padding: 0;
    margin-bottom: 1.5rem;
}

.cbox-3-txt li {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f8f9fa;
}

.cbox-3-txt li:last-child {
    border-bottom: none;
}

.cbox-3-txt i {
    color: #667eea;
    font-size: 0.9rem;
}

/* Pricing Card Featured Badge */
.badge-popular {
    position: absolute;
    top: -10px;
    right: 20px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.pricing-card.featured {
    border: 2px solid #667eea;
    transform: scale(1.05);
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.2);
}

@media (max-width: 767px) {
    .pricing-card.featured {
        transform: none;
    }
}
</style>

<!-- Final CTA Section -->
<section class="final-cta ptb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="cta-content" data-aos="zoom-in">
                    <h2 class="cta-title">
                        Ready to Start Your Journey?
                    </h2>
                    <p class="cta-subtitle">
                        Join 5,000+ couples who trusted us with their visa process
                    </p>
                    
                    <div class="cta-buttons">
                        <a href="{{ route('register') }}" class="btn btn-primary-gradient btn-lg">
                            Start Free Consultation
                        </a>
                        <a href="tel:702-426-4503" class="btn btn-call btn-lg">
                            <i class="fas fa-phone-alt"></i> 
                            702-426-4503
                        </a>
                    </div>
                    
                    <div class="guarantee-badge mt-4">
                        <img src="{{ asset('assets/img/Guarantee.png') }}" alt="Money Back Guarantee" height="80">
                        <p class="guarantee-text">
                            100% Money-Back Guarantee if denied
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customScript')
<script>
// Initialize AOS animations
AOS.init({
    duration: 800,
    once: true,
    offset: 100
});

// Video player functionality
document.addEventListener('DOMContentLoaded', function() {
    const video = document.querySelector('video');
    const playButton = document.querySelector('.play-button');
    
    if (video && playButton) {
        playButton.addEventListener('click', function() {
            if (video.paused) {
                video.play();
                playButton.style.display = 'none';
            }
        });
        
        video.addEventListener('play', function() {
            playButton.style.display = 'none';
        });
        
        video.addEventListener('pause', function() {
            playButton.style.display = 'flex';
        });
    }
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Scroll indicator animation
const scrollIndicator = document.querySelector('.scroll-indicator');
if (scrollIndicator) {
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            scrollIndicator.style.opacity = '0';
        } else {
            scrollIndicator.style.opacity = '1';
        }
    });
}
</script>
@endsection