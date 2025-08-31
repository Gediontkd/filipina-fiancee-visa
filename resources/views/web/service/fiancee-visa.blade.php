@extends('web.layout.master')
@section('content')
    @include('web.component.bread-crumb', [
        'title' => 'K-1 Fiancé(e) Visa',
        'previousPageLink' => route('service'),
        'previousPageTitle' => 'Services',
    ])
    
    <!-- Modern Hero Section -->
    <section class="about-us ptb-115">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6" data-aos="fade-right">
                    <div class="about-content">
                        <div class="section-title">
                            <span class="subheading primary-color">K-1 FIANCÉ(E) VISA</span>
                            <h3 class="section-title-modern">What Is a Fiancé(e) Visa?</h3>
                        </div>
                        <p>A fiancé visa / fiancée visa, called K-1 visa, is a nonimmigrant visa which allows foreigners who
                            are engaged to United States citizens to travel to America to get married. The word fiancé
                            refers to a male, and the word fiancée refers to a female. The wedding must occur within 90 days
                            of arrival in the United States.</p>
                        <p>A fiancé visa is the fastest and easiest visa that you can get
                            to bring your fiancée to the United States. To do a fiance visa you must be a US Citizen, they
                            are not available to Permanent Residents. You must both be legally single, with no divorces or
                            annulments pending at the time of filing. Being legally separated does not qualify.</p>
                        
                        <div class="modern-highlight-box mt-4">
                            <div class="highlight-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="highlight-content">
                                <h6>Processing Time</h6>
                                <p class="mb-0">Currently, it is taking about <strong>9-12 months</strong> to get a fiancee visa from the date of filing.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <div class="about-img-block">
                        <img src="{{ asset('assets/img/aboutimg2.jpg') }}" alt="K-1 Fiancé Visa">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modern Timeline Section -->
    <section class="about-us ptb-115 bg-lightgrey">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6" data-aos="fade-left">
                    <div class="about-img-block">
                        <img src="{{ asset('assets/img/aboutimg7.jpg') }}" alt="When to Get Started">
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-right">
                    <div class="about-content mb-mob-50">
                        <div class="section-title">
                            <span class="subheading primary-color">GETTING STARTED</span>
                            <h3 class="section-title-modern">When Should You Get Started?</h3>
                        </div>
                        <p>We HIGHLY recommend signing up for our service 1-2 months prior to your trip to meet your foreign
                            fiancée, so we can get a head start on all the fiancée visa paperwork and this will result in
                            your fiancée being here sooner! This way you will get started right and avoid costly mistakes
                            from the very beginning.</p>
                        
                        <div class="modern-info-card">
                            <div class="info-header">
                                <i class="fas fa-info-circle"></i>
                                <h6>Important Note</h6>
                            </div>
                            <p class="mb-0">It is NOT necessary that your foreign fiancée have his or her passport for your petition to
                                be filed. They won't need their passport for several months after filing.</p>
                        </div>

                        <div class="modern-faq-item mt-4">
                            <h5 class="faq-question">How long must we be in a relationship to file for a fiancee visa?</h5>
                            <div class="faq-answer">
                                <p>Many people are confused about this. The law does NOT say that you must have had a 2-year
                                    relationship, it says that you must have met in person in the 2 years (24 months) prior to the
                                    filing of the fiancée visa petition. Even if you have only known each other for 1 month we can
                                    still get you a fiancee visa.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Get Started Section --}}
    @if (!Auth::check())
        @include('web.component.get-started')
    @endif

    <!-- Modern Why Choose Us Section -->
    <section class="about-us ptb-115">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6" data-aos="fade-right">
                    <div class="about-img-block">
                        <img src="{{ asset('assets/img/aboutimg1.jpg') }}" alt="Why Choose Us">
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <div class="about-content">
                        <div class="section-title">
                            <span class="subheading primary-color">OUR EXPERTISE</span>
                            <h3 class="section-title-modern">Why Choose Us?</h3>
                        </div>
                        
                        <div class="modern-features-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-globe-asia"></i>
                                </div>
                                <div class="feature-content">
                                    <h6>Philippines Experts</h6>
                                    <p>Specialized expertise with Philippine visa cases</p>
                                </div>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-file-signature"></i>
                                </div>
                                <div class="feature-content">
                                    <h6>Complete Form Preparation</h6>
                                    <p>We prepare all forms - you just sign them</p>
                                </div>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <div class="feature-content">
                                    <h6>End-to-End Support</h6>
                                    <p>We stay with you from beginning to end</p>
                                </div>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div class="feature-content">
                                    <h6>20+ Years Experience</h6>
                                    <p>A long history of success</p>
                                </div>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="feature-content">
                                    <h6>Thousands Helped</h6>
                                    <p>We have helped thousands of couples</p>
                                </div>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="feature-content">
                                    <h6>99% Success Rate</h6>
                                    <p>Proven track record of approvals</p>
                                </div>
                            </div>
                        </div>

                        <div class="additional-services mt-4">
                            <div class="service-highlight">
                                <i class="fas fa-calculator"></i>
                                <span>Financial Analysis & Affidavit of Support Preparation</span>
                            </div>
                            <div class="service-highlight">
                                <i class="fas fa-user-md"></i>
                                <span>Complete Medical Examination Guidance</span>
                            </div>
                            <div class="service-highlight">
                                <i class="fas fa-comments"></i>
                                <span>Full Embassy Interview Preparation & Support</span>
                            </div>
                            <div class="service-highlight">
                                <i class="fas fa-lock"></i>
                                <span>Secure Account, Accessible Worldwide 24/7</span>
                            </div>
                            <div class="service-highlight guarantee-highlight">
                                <i class="fas fa-shield-alt"></i>
                                <span><a class="guarantee-btn-modern" href="{{ route('guarantee') }}">Money-back guarantee if denied</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modern FAQ Section -->
    <section class="faq-modern ptb-100 bg-lightgrey">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center mb-5">
                    <span class="subheading primary-color">FAQ</span>
                    <h3 class="section-title-modern">Frequently Asked Questions</h3>
                    <p class="section-subtitle">Get answers to the most common questions about K-1 fiancé visas</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="modern-faq-accordion">
                        <div class="accordion" id="k1FaqAccordion">
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="faq1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                            data-bs-target="#collapse1" aria-expanded="true">
                                        Do you have to meet your fiancee in person before you can get a Fiancee Visa?
                                    </button>
                                </h3>
                                <div id="collapse1" class="accordion-collapse collapse show" 
                                     data-bs-parent="#k1FaqAccordion">
                                    <div class="accordion-body">
                                        Yes, this is a requirement. They may grant you an exception if you have a serious medical
                                        condition that prevents you from flying.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="faq2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                            data-bs-target="#collapse2" aria-expanded="false">
                                        Can children of your fiancee be included?
                                    </button>
                                </h3>
                                <div id="collapse2" class="accordion-collapse collapse" 
                                     data-bs-parent="#k1FaqAccordion">
                                    <div class="accordion-body">
                                        Children of your fiancee can be included on their petition. The children have the option to
                                        either accompany their parent or join their parent within one year from the visa's date of
                                        issuance. To qualify the children are required to be unmarried and under 21 years of age.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="faq3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                            data-bs-target="#collapse3" aria-expanded="false">
                                        Can Same-Sex couples get a Fiancee Visa?
                                    </button>
                                </h3>
                                <div id="collapse3" class="accordion-collapse collapse" 
                                     data-bs-parent="#k1FaqAccordion">
                                    <div class="accordion-body">
                                        Yes. U.S. Citizens can now sponsor their same-sex spouse or same-sex fiancée. This has now
                                        been expanded to include sponsoring children of same-sex marriages. Filipina Fiancée Visa is
                                        ready to prepare your same-sex fiancé visa petition or same-sex spouse visa petition.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resources Links -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="resource-cards">
                        <h5 class="text-center mb-4">Related Resources</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="resource-card">
                                    <div class="resource-icon">
                                        <img src="{{ asset('assets/img/document2.png') }}" alt="Income Requirements">
                                    </div>
                                    <div class="resource-content">
                                        <h6><a href="{{ route('resource.page', 'income-requirement') }}">What are the income requirements for a Fiancee Visa?</a></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="resource-card">
                                    <div class="resource-icon">
                                        <img src="{{ asset('assets/img/document2.png') }}" alt="Requirements">
                                    </div>
                                    <div class="resource-content">
                                        <h6><a href="{{ route('resource.page', 'requirement-for-fiancee-visa') }}">What are the requirements to get a K1 Fiancee Visa?</a></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="resource-card">
                                    <div class="resource-icon">
                                        <img src="{{ asset('assets/img/document2.png') }}" alt="Documents">
                                    </div>
                                    <div class="resource-content">
                                        <h6><a href="{{ route('resource.page', 'required-documents-for-fiancee-visa') }}">What documents are required to get a Fiancee Visa?</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <div class="more-questions-modern">
                    <h5>Still have a question?</h5>
                    <a href="{{ route('contactUs') }}" class="btn btn-outline-primary">
                        Ask Your Question Here <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Modern Pricing Section -->
    <section class="pricing-modern ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center mb-5">
                    <span class="subheading primary-color">PRICING</span>
                    <h3 class="section-title-modern">Our K-1 Fiancé(e) Visa Package</h3>
                    <p class="section-subtitle">Complete service with transparent pricing and no hidden fees</p>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-5 mb-4" data-aos="fade-right">
                    <div class="package-features-modern">
                        <h4 class="features-title">What's Included</h4>
                        <div class="feature-grid">
                            <div class="feature-modern">
                                <div class="feature-icon-modern">
                                    <i class="fas fa-file-signature"></i>
                                </div>
                                <span>We prepare all forms - you just sign them</span>
                            </div>
                            <div class="feature-modern">
                                <div class="feature-icon-modern">
                                    <i class="fas fa-calculator"></i>
                                </div>
                                <span>Analysis of all your financial information</span>
                            </div>
                            <div class="feature-modern">
                                <div class="feature-icon-modern">
                                    <i class="fas fa-file-contract"></i>
                                </div>
                                <span>Affidavit of Support Preparation</span>
                            </div>
                            <div class="feature-modern">
                                <div class="feature-icon-modern">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <span>Complete Medical Examination Guidance</span>
                            </div>
                            <div class="feature-modern">
                                <div class="feature-icon-modern">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <span>Full Embassy Interview Preparation & Support</span>
                            </div>
                            <div class="feature-modern">
                                <div class="feature-icon-modern">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <span>Secure account, accessible worldwide, 24/7</span>
                            </div>
                            <div class="feature-modern guarantee-feature">
                                <div class="feature-icon-modern">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <span><a class="guarantee-btn-modern" href="{{ route('guarantee') }}">Money-back guarantee if denied</a></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4" data-aos="fade-left">
                    <div class="pricing-card-modern featured">
                        <div class="badge-popular">Most Popular</div>
                        <div class="pricing-header-modern">
                            <h4>K-1 FIANCÉ(E) VISA</h4>
                            <div class="price-modern">
                                <sup>$</sup>850
                                <span class="price-period">/service fee</span>
                            </div>
                            <a href="javascript:void(0)" class="price-note-modern" data-bs-toggle="modal"
                                data-bs-target="#k1PricingModal">+ Government Fees</a>
                        </div>
                        
                        <div class="pricing-features-modern">
                            <h6>Package Includes:</h6>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Full Support Start To Finish</li>
                                <li><i class="fas fa-check-circle"></i> Unlimited Phone Support</li>
                                <li><i class="fas fa-check-circle"></i> Unlimited Email Support</li>
                                <li><i class="fas fa-check-circle"></i> Prepare All Government Forms</li>
                                <li><i class="fas fa-check-circle"></i> Online Petition Tracking</li>
                                <li><i class="fas fa-check-circle"></i> Children Are Free</li>
                            </ul>
                        </div>
                        
                        <div class="pricing-action-modern">
                            {{ Form::open(['url' => route('payment'), 'method' => 'GET']) }}
                                {!! Form::hidden('user_id', Auth::id()) !!}
                                {!! Form::hidden('application_id', 1) !!}
                                {!! Form::hidden('route', 'fianceSponsorApplication') !!}
                                {!! Form::hidden('price', 850) !!}
                                {{ Form::submit('Get Started Today', ['class' => 'btn btn-primary-gradient btn-block']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <div class="pricing-guarantee-modern">
                        <img src="{{ asset('assets/img/Guarantee.png') }}" alt="Money Back Guarantee" height="60">
                        <p class="guarantee-text-modern">100% Money-Back Guarantee if Denied by USCIS</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced K-1 Pricing Modal -->
    <div class="modal fade pricing-modal-modern" id="k1PricingModal" tabindex="-1" aria-labelledby="k1PricingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header-modern">
                    <h5 class="modal-title" id="k1PricingModalLabel">K-1 Fiancé(e) Visa Complete Pricing</h5>
                    <button type="button" class="btn-close-modern" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body-modern">
                    <div class="pricing-breakdown">
                        <div class="cost-section">
                            <div class="section-header">
                                <h6><i class="fas fa-handshake"></i> Our Service Fee</h6>
                            </div>
                            <ul class="cost-list">
                                <li>
                                    <span class="cost-item">Service Fee to Filipina Fiancée Visa</span>
                                    <span class="cost-amount">$850</span>
                                </li>
                                <li class="cost-note">
                                    <small><i class="fas fa-info-circle"></i> Paid upfront to start your petition</small>
                                </li>
                            </ul>
                        </div>

                        <div class="cost-section">
                            <div class="section-header">
                                <h6><i class="fas fa-university"></i> Government Fees</h6>
                            </div>
                            <ul class="cost-list">
                                <li>
                                    <span class="cost-item">USCIS Filing Fee</span>
                                    <span class="cost-amount">$675</span>
                                </li>
                                <li class="cost-note">
                                    <small>Paid when petition is filed</small>
                                </li>
                                <li>
                                    <span class="cost-item">Medical Examination Fee</span>
                                    <span class="cost-amount">$495</span>
                                </li>
                                <li class="cost-note">
                                    <small>Due later in the process</small>
                                </li>
                                <li>
                                    <span class="cost-item">U.S. Embassy Visa Fee</span>
                                    <span class="cost-amount">$265</span>
                                </li>
                                <li class="cost-note">
                                    <small>Due before the interview</small>
                                </li>
                            </ul>
                        </div>

                        <div class="total-section">
                            <div class="total-row">
                                <span class="total-label">Total All Fees</span>
                                <span class="total-amount">$2,285</span>
                            </div>
                        </div>

                        <div class="cost-section children-section">
                            <div class="section-header">
                                <h6><i class="fas fa-child"></i> Extra Fees Per Child to be Included</h6>
                            </div>
                            <ul class="cost-list">
                                <li>
                                    <span class="cost-item">Service Fee (per child)</span>
                                    <span class="cost-amount">$200</span>
                                </li>
                                <li>
                                    <span class="cost-item">Child Medical Exam</span>
                                    <span class="cost-amount">$240</span>
                                </li>
                                <li>
                                    <span class="cost-item">Embassy Visa Fee</span>
                                    <span class="cost-amount">$265</span>
                                </li>
                            </ul>
                            <div class="child-total">
                                <span class="total-label">Total Fees Per Child</span>
                                <span class="total-amount">$705</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer-modern">
                    <div class="footer-guarantee">
                        <i class="fas fa-shield-alt"></i>
                        <span>Protected by our Money-Back Guarantee</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customScript')
<script>
// Initialize AOS animations
AOS.init({
    duration: 800,
    once: true,
    offset: 100
});

// Enhanced FAQ accordion functionality
document.addEventListener('DOMContentLoaded', function() {
    const accordionButtons = document.querySelectorAll('.accordion-button');
    
    accordionButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Add smooth transition effect
            setTimeout(() => {
                button.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 300);
        });
    });
});

// Modal enhancements
document.addEventListener('DOMContentLoaded', function() {
    const pricingModal = document.getElementById('k1PricingModal');
    if (pricingModal) {
        pricingModal.addEventListener('show.bs.modal', function () {
            document.body.classList.add('modal-open-modern');
        });
        
        pricingModal.addEventListener('hide.bs.modal', function () {
            document.body.classList.remove('modal-open-modern');
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
</script>

<style>
/* Modern enhancements specific to service pages */
.modern-highlight-box {
    background: linear-gradient(135deg, #f0f4ff 0%, #e8f2ff 100%);
    border-left: 4px solid var(--primary-color);
    border-radius: 12px;
    padding: 1.5rem;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.highlight-icon {
    flex-shrink: 0;
    width: 50px;
    height: 50px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.highlight-content h6 {
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.modern-info-card {
    background: white;
    border: 1px solid #e3f2fd;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-top: 1.5rem;
}

.info-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
    color: var(--primary-color);
}

.info-header i {
    font-size: 1.2rem;
}

.info-header h6 {
    margin: 0;
    font-weight: 600;
}

.modern-faq-item {
    background: white;
    border-radius: 12px;
    border: 1px solid #f0f0f0;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.faq-question {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    color: var(--text-dark);
    font-weight: 600;
    padding: 1rem 1.5rem;
    margin: 0;
    font-size: 1.1rem;
    border-bottom: 1px solid #dee2e6;
}

.faq-answer {
    padding: 1.5rem;
}

.modern-features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

.feature-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    transition: var(--transition);
}

.feature-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    flex-shrink: 0;
    width: 50px;
    height: 50px;
    background: var(--primary-gradient);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.3rem;
}

.feature-content h6 {
    color: var(--text-dark);
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 1rem;
}

.feature-content p {
    color: var(--text-light);
    margin: 0;
    font-size: 0.9rem;
    line-height: 1.5;
}

.additional-services {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 2rem;
}

.service-highlight {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
    padding: 0.75rem;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.service-highlight i {
    color: var(--primary-color);
    font-size: 1.2rem;
    width: 20px;
}

.service-highlight.guarantee-highlight {
    border: 2px solid #28a745;
    background: linear-gradient(135deg, #f0fff4 0%, #e8f5e8 100%);
}

.guarantee-btn-modern {
    color: #28a745 !important;
    font-weight: 600;
    text-decoration: underline;
}

.guarantee-btn-modern:hover {
    color: #1e7e34 !important;
}

/* Modern FAQ Styles */
.faq-modern {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

.modern-faq-accordion .accordion-item {
    border: none;
    margin-bottom: 1rem;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
}

.modern-faq-accordion .accordion-button {
    background: white;
    color: var(--text-dark);
    font-weight: 600;
    padding: 1.5rem;
    border: none;
    box-shadow: none;
    font-size: 1.05rem;
}

.modern-faq-accordion .accordion-button:not(.collapsed) {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.modern-faq-accordion .accordion-button:focus {
    box-shadow: none;
    border-color: transparent;
}

.modern-faq-accordion .accordion-body {
    padding: 1.5rem;
    background: #f8f9fa;
    color: var(--text-dark);
    line-height: 1.8;
}

/* Resource Cards */
.resource-cards {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
}

.resource-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 12px;
    transition: var(--transition);
    height: 100%;
}

.resource-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.resource-icon img {
    width: 40px;
    height: 40px;
}

.resource-content h6 a {
    color: var(--primary-color);
    text-decoration: none;
    font-size: 0.95rem;
    line-height: 1.4;
}

.resource-content h6 a:hover {
    color: var(--secondary-color);
}

.more-questions-modern {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
}

.more-questions-modern h5 {
    color: var(--text-dark);
    margin-bottom: 1rem;
    font-weight: 600;
}

/* Modern Pricing Styles */
.pricing-modern {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

.package-features-modern {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    height: 100%;
}

.features-title {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 2rem;
    text-align: center;
    font-size: 1.5rem;
}

.feature-grid {
    display: grid;
    gap: 1rem;
}

.feature-modern {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 12px;
    transition: var(--transition);
}

.feature-modern:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.feature-icon-modern {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    background: var(--primary-gradient);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.feature-modern span {
    color: var(--text-dark);
    font-weight: 500;
    font-size: 0.95rem;
}

.feature-modern.guarantee-feature {
    border: 2px solid #28a745;
    background: linear-gradient(135deg, #f0fff4 0%, #e8f5e8 100%);
}

.pricing-card-modern {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: var(--transition);
}

.pricing-card-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
}

.pricing-card-modern.featured {
    border: 2px solid var(--primary-color);
    transform: scale(1.02);
}

.pricing-header-modern {
    text-align: center;
    padding-bottom: 2rem;
    border-bottom: 1px solid #eee;
    margin-bottom: 2rem;
}

.pricing-header-modern h4 {
    color: var(--primary-color);
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.25rem;
}

.price-modern {
    color: var(--text-dark);
    font-weight: 700;
    font-size: 3rem;
    line-height: 1;
}

.price-modern sup {
    font-size: 1.5rem;
    top: -1rem;
}

.price-period {
    display: block;
    font-size: 1rem;
    color: var(--text-light);
    font-weight: 400;
    margin-top: 0.5rem;
}

.price-note-modern {
    color: var(--primary-color) !important;
    text-decoration: underline;
    font-weight: 500;
    margin-top: 1rem;
    display: inline-block;
}

.pricing-features-modern {
    flex-grow: 1;
    margin-bottom: 2rem;
}

.pricing-features-modern h6 {
    color: var(--text-dark);
    font-weight: 600;
    margin-bottom: 1rem;
    text-align: center;
}

.pricing-features-modern ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.pricing-features-modern li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 0;
    color: var(--text-dark);
}

.pricing-features-modern i {
    color: #28a745;
    font-size: 1rem;
}

.pricing-action-modern {
    margin-top: auto;
}

.btn-block {
    width: 100%;
    padding: 1rem;
    font-weight: 600;
    font-size: 1rem;
}

.pricing-guarantee-modern {
    text-align: center;
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.guarantee-text-modern {
    color: var(--text-dark);
    font-weight: 500;
    margin-top: 1rem;
    margin-bottom: 0;
}

/* Enhanced Modal Styles */
.pricing-modal-modern .modal-content {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
}

.modal-header-modern {
    background: var(--primary-gradient);
    color: white;
    padding: 2rem;
    border-bottom: none;
    position: relative;
}

.modal-header-modern .modal-title {
    font-weight: 700;
    font-size: 1.5rem;
    margin: 0;
}

.btn-close-modern {
    position: absolute;
    right: 1rem;
    top: 1rem;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.modal-body-modern {
    padding: 2rem;
}

.pricing-breakdown {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.cost-section {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.5rem;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-color);
}

.section-header h6 {
    color: var(--primary-color);
    font-weight: 700;
    margin: 0;
    font-size: 1.1rem;
}

.section-header i {
    color: var(--primary-color);
    font-size: 1.2rem;
}

.cost-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.cost-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #dee2e6;
}

.cost-list li:last-child {
    border-bottom: none;
}

.cost-list li.cost-note {
    justify-content: flex-start;
    border-bottom: none;
    padding-top: 0.25rem;
    padding-bottom: 0.75rem;
}

.cost-item {
    color: var(--text-dark);
    font-weight: 500;
}

.cost-amount {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1.1rem;
}

.total-section {
    background: var(--primary-gradient);
    color: white;
    border-radius: 12px;
    padding: 1.5rem;
}

.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.total-label {
    font-weight: 700;
    font-size: 1.2rem;
}

.total-amount {
    font-weight: 700;
    font-size: 1.5rem;
}

.children-section {
    background: #fff3cd;
    border: 2px solid #ffeaa7;
}

.child-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(255, 193, 7, 0.1);
    padding: 1rem;
    border-radius: 8px;
    margin-top: 1rem;
    font-weight: 600;
}

.modal-footer-modern {
    background: #f8f9fa;
    padding: 1.5rem 2rem;
    border-top: 1px solid #dee2e6;
}

.footer-guarantee {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    color: #28a745;
    font-weight: 600;
}

.footer-guarantee i {
    font-size: 1.2rem;
}

/* Mobile Responsive */
@media (max-width: 991px) {
    .modern-features-grid {
        grid-template-columns: 1fr;
    }
    
    .pricing-card-modern.featured {
        transform: none;
    }
    
    .feature-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 767px) {
    .modern-highlight-box,
    .modern-info-card,
    .package-features-modern,
    .pricing-card-modern {
        margin-bottom: 1.5rem;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .section-title-modern {
        font-size: 2rem;
    }
    
    .price-modern {
        font-size: 2.5rem;
    }
    
    .modal-header-modern,
    .modal-body-modern {
        padding: 1.5rem;
    }
    
    .cost-list li {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}
</style>
@endsection