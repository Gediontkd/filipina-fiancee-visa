@extends('web.layout.master')
@section('content')
<section class="breadcrumb-main">
    <div class="container">
        <div class="row">
            <div id="breadcrumb">
                <div class="breadcrumb-txt">
                    <h3>Money-Back Guarantee</h3>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Money-Back Guarantee</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="guarantee-page bg-lightgrey ptb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="guarantee-card">
                    <div class="guarantee-header text-center mb-5">
                        <div class="guarantee-badge mb-4">
                            <i class="fas fa-shield-check"></i>
                            <span>100% Money-Back Guarantee</span>
                        </div>
                        <h1 class="mb-3">Our Money-Back Guarantee</h1>
                        <p class="text-muted">Your trust means everything to us</p>
                    </div>

                    <div class="guarantee-content">
                        <div class="intro-section mb-5">
                            <p class="lead-text">At Filipina Fiancée Visa Service, your trust means everything to us. We stand behind the quality of our work and our <strong>20-plus years of experience</strong> preparing visa petitions for U.S.–Filipina/Filipino couples.</p>
                        </div>

                        <div class="guarantee-terms mb-5">
                            <div class="term-item">
                                <div class="term-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="term-content">
                                    <h3 class="h5 mb-3">Our Commitment to You</h3>
                                    <p>If your petition is <strong>denied as a direct result of a mistake that we made</strong> in preparing your paperwork, we will refund our full service fee. To qualify, you must provide us with a copy of the official denial letter so we can confirm the nature of the error.</p>
                                </div>
                            </div>

                            <div class="term-item">
                                <div class="term-icon exclusion">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <div class="term-content">
                                    <h3 class="h5 mb-3">What's Not Covered</h3>
                                    <p>Our guarantee <strong>does not apply</strong> if incorrect information was provided to us by the client, and it does not cover government filing fees. We also cannot offer refunds for situations outside of our control — such as couples deciding to end their relationship or voluntarily terminating our service.</p>
                                </div>
                            </div>

                            <div class="term-item">
                                <div class="term-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="term-content">
                                    <h3 class="h5 mb-3">Our Promise</h3>
                                    <p>This guarantee reflects our long-standing commitment to <strong>honesty, accuracy, and fairness</strong> in every case we handle.</p>
                                </div>
                            </div>
                        </div>

                        <div class="experience-highlight text-center mb-5">
                            <div class="experience-badge">
                                <div class="badge-number">20+</div>
                                <div class="badge-text">Years of Experience</div>
                            </div>
                            <p class="mt-4">Thousands of successful petitions and countless happy couples reunited</p>
                        </div>

                        <div class="contact-section text-center">
                            <h3 class="h5 mb-3">Questions About Our Guarantee?</h3>
                            <p class="mb-4">For any questions about this policy, please contact us:</p>
                            <div class="contact-info mb-4">
                                <p class="mb-2">
                                    <i class="fas fa-envelope me-2"></i>
                                    <a href="mailto:support@filipinafianceevisa.com">support@filipinafianceevisa.com</a>
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-phone me-2"></i>
                                    <a href="tel:702-426-4503">702-426-4503</a>
                                </p>
                            </div>
                            <a href="{{ route('contactUs') }}" class="btn btn-primary btn-lg">Contact Us</a>
                        </div>
                    </div>

                    <div class="guarantee-footer mt-5 pt-4">
                        <div class="alert alert-info" role="alert">
                            <p class="mb-0"><strong>Important Notice:</strong> Filipina Fiancee Visa Service is a private company and is not affiliated with any government agency. We provide comprehensive support to help you obtain your visa and/or green card; however, our services do not include legal advice, legal representation, or any legal services. We are not a law firm and are not licensed to practice law.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="ptb-80 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 col-12 mb-3">
                <p class="text-uppercase mb-3"><small>READY TO START?</small></p>
                <div class="heading mb-3">
                    <h2>Begin Your Journey With Confidence</h2>
                </div>
                <p class="mb-4">Our money-back guarantee gives you peace of mind. Let's reunite you with your loved one.</p>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Start Your Application</a>
            </div>
            <div class="col-md-7 col-12 mb-3">
                <div class="about-img-block">
                    <img src="{{ asset('assets/img/filipina-fiancee-visa-banner.jpg') }}" alt="Start Your Application" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.guarantee-card {
    background: white;
    padding: 3rem;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
}

.guarantee-badge {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1.1rem;
}

.guarantee-badge i {
    font-size: 1.8rem;
}

.guarantee-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
}

.lead-text {
    font-size: 1.2rem;
    color: #4a5568;
    line-height: 1.8;
    padding: 2rem;
    background: linear-gradient(135deg, #f0fdf4 0%, #f8f9ff 100%);
    border-radius: 15px;
    border-left: 4px solid #10b981;
}

.guarantee-terms {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.term-item {
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
    padding: 2rem;
    background: #f8f9fa;
    border-radius: 15px;
    transition: all 0.3s ease;
}

.term-item:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
}

.term-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.8rem;
    flex-shrink: 0;
}

.term-icon.exclusion {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
}

.term-content h3 {
    color: #2d3748;
    font-weight: 700;
}

.term-content p {
    color: #4a5568;
    line-height: 1.7;
    margin: 0;
    font-size: 1.05rem;
}

.experience-highlight {
    padding: 2.5rem;
    background: linear-gradient(135deg, #f0f4ff 0%, #f8f9ff 100%);
    border-radius: 15px;
}

.experience-badge {
    display: inline-block;
    padding: 2rem 3rem;
    background: white;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.badge-number {
    font-size: 3.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
    margin-bottom: 0.5rem;
}

.badge-text {
    font-size: 1.1rem;
    color: #4a5568;
    font-weight: 600;
}

.experience-highlight p {
    color: #4a5568;
    font-size: 1.1rem;
    margin: 0;
}

.contact-section {
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 15px;
}

.contact-section h3 {
    color: #2d3748;
    font-weight: 700;
}

.contact-section p {
    color: #4a5568;
    font-size: 1.05rem;
}

.contact-info a {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.contact-info a:hover {
    color: #764ba2;
}

@media (max-width: 768px) {
    .guarantee-card {
        padding: 2rem 1.5rem;
    }
    
    .guarantee-header h1 {
        font-size: 2rem;
    }
    
    .guarantee-badge {
        font-size: 1rem;
        padding: 0.75rem 1.5rem;
    }
    
    .term-item {
        flex-direction: column;
        text-align: center;
        padding: 1.5rem;
    }
    
    .term-icon {
        margin: 0 auto;
    }
    
    .lead-text {
        font-size: 1.1rem;
        padding: 1.5rem;
    }
    
    .experience-badge {
        padding: 1.5rem 2rem;
    }
    
    .badge-number {
        font-size: 2.5rem;
    }
}

@media (max-width: 576px) {
    .guarantee-card {
        padding: 1.5rem 1rem;
    }
    
    .guarantee-header h1 {
        font-size: 1.75rem;
    }
    
    .guarantee-badge {
        flex-direction: column;
        gap: 0.5rem;
        text-align: center;
    }
    
    .term-item {
        padding: 1.25rem;
    }
    
    .term-icon {
        width: 50px;
        height: 50px;
        font-size: 1.5rem;
    }
}
</style>
@endsection