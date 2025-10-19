@extends('web.layout.master')
@section('content')
<section class="breadcrumb-main">
    <div class="container">
        <div class="row">
            <div id="breadcrumb">
                <div class="breadcrumb-txt">
                    <h3>Privacy & Data Sharing Policy</h3>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="privacy-policy bg-lightgrey ptb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="policy-card">
                    <div class="policy-header text-center mb-5">
                        <div class="policy-icon mb-3">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h1 class="mb-3">Privacy & Data Sharing Policy</h1>
                        <p class="text-muted">Last Updated: {{ date('F Y') }}</p>
                    </div>

                    <div class="policy-content">
                        <div class="policy-statement mb-5">
                            <h2 class="h4 mb-4">Your Privacy is Our Priority</h2>
                            <p class="lead-text">We take your privacy seriously. Filipina Fiancée Visa Service <strong>does not share, sell, rent, or exchange</strong> any client information with any third parties.</p>
                        </div>

                        <div class="policy-section mb-5">
                            <div class="section-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="section-content">
                                <h3 class="h5 mb-3">How We Use Your Information</h3>
                                <p>All personal data you provide — including contact details, immigration information, or uploaded documents — is used <strong>solely for preparing and processing your visa case</strong>.</p>
                            </div>
                        </div>

                        <div class="policy-section mb-5">
                            <div class="section-icon">
                                <i class="fas fa-server"></i>
                            </div>
                            <div class="section-content">
                                <h3 class="h5 mb-3">Secure & Protected</h3>
                                <p>Our systems are secure and encrypted, and only our internal staff directly involved in your case have access to your information.</p>
                            </div>
                        </div>

                        <div class="policy-section mb-5">
                            <div class="section-icon">
                                <i class="fas fa-ban"></i>
                            </div>
                            <div class="section-content">
                                <h3 class="h5 mb-3">What We Never Do</h3>
                                <p>We will <strong>never share your details</strong> with advertisers, data brokers, or marketing lists.</p>
                            </div>
                        </div>

                        <div class="contact-section text-center mt-5 pt-5">
                            <h3 class="h5 mb-3">Questions About Your Privacy?</h3>
                            <p class="mb-4">If you have any concerns about how we handle your information, we're here to help.</p>
                            <a href="{{ route('contactUs') }}" class="btn btn-primary">Contact Us</a>
                        </div>
                    </div>

                    <div class="policy-footer mt-5 pt-4">
                        <div class="alert alert-info" role="alert">
                            <p class="mb-0"><strong>Important Notice:</strong> Filipina Fiancee Visa Service is a private company and is not affiliated with any government agency. We provide comprehensive support to help you obtain your visa and/or green card; however, our services do not include legal advice, legal representation, or any legal services. We are not a law firm and are not licensed to practice law.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.policy-card {
    background: white;
    padding: 3rem;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
}

.policy-header .policy-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: white;
    font-size: 2rem;
}

.policy-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
}

.policy-statement {
    padding: 2rem;
    background: linear-gradient(135deg, #f0f4ff 0%, #f8f9ff 100%);
    border-radius: 15px;
    border-left: 4px solid #667eea;
}

.policy-statement h2 {
    color: #2d3748;
    font-weight: 700;
}

.lead-text {
    font-size: 1.2rem;
    color: #4a5568;
    line-height: 1.8;
    margin: 0;
}

.policy-section {
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
    padding: 1.5rem;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.policy-section:hover {
    background: #f8f9fa;
}

.section-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.3rem;
    flex-shrink: 0;
}

.section-content h3 {
    color: #2d3748;
    font-weight: 700;
    margin-bottom: 0.75rem;
}

.section-content p {
    color: #4a5568;
    line-height: 1.7;
    margin: 0;
    font-size: 1.05rem;
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

@media (max-width: 768px) {
    .policy-card {
        padding: 2rem 1.5rem;
    }
    
    .policy-header h1 {
        font-size: 2rem;
    }
    
    .policy-section {
        flex-direction: column;
        text-align: center;
    }
    
    .section-icon {
        margin: 0 auto;
    }
    
    .lead-text {
        font-size: 1.1rem;
    }
}

@media (max-width: 576px) {
    .policy-card {
        padding: 1.5rem 1rem;
    }
    
    .policy-header h1 {
        font-size: 1.75rem;
    }
    
    .policy-statement {
        padding: 1.5rem;
    }
}
</style>
@endsection