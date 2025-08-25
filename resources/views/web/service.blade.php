@extends('web.layout.master')
@section('content')
	<section class="breadcrumb-main">
		<div class="container">
			<div class="row">
				<div id="breadcrumb">
					<div class="breadcrumb-txt">
						<h3>Services</h3>
					</div>
					<div class="row">
						<div class="col">
							<div class="breadcrumb-nav">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
										<li class="breadcrumb-item active" aria-current="page">Services</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Modern Services Hero -->
	<section class="services-hero ptb-60 bg-light">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<h2 class="section-title-modern" data-aos="fade-up">Our Immigration Services</h2>
					<p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
						Comprehensive visa assistance with over 20 years of experience. We handle the paperwork, you focus on your future together.
					</p>
				</div>
			</div>
		</div>
	</section>

	<!-- Main Services Section -->
	<section class="services-modern ptb-80">
		<div class="container">
			<div class="row">
				<!-- K-1 Fiancé(e) Visa -->
				<div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="200">
					<div class="service-card-modern featured">
						<div class="service-badge">Most Popular</div>
						<div class="service-image">
							<img src="{{ asset('assets/img/service1.jpg') }}" alt="K-1 Fiancé(e) Visa">
							<div class="service-overlay">
								<div class="service-icon">
									<img src="{{ asset('assets/img/icons/service-icon-1.png') }}" alt="K-1 Visa Icon">
								</div>
							</div>
						</div>
						<div class="service-content">
							<h3>K-1 Fiancé(e) Visa</h3>
							<p class="service-description">
								Perfect for engaged couples who want to get married in the United States. The K-1 visa allows your foreign fiancé(e) to enter the US and gives you 90 days to marry.
							</p>
							<div class="service-features">
								<div class="feature-item">
									<i class="fas fa-clock"></i>
									<span>9-12 months processing</span>
								</div>
								<div class="feature-item">
									<i class="fas fa-heart"></i>
									<span>For engaged couples</span>
								</div>
								<div class="feature-item">
									<i class="fas fa-child"></i>
									<span>Children included free</span>
								</div>
							</div>
							<div class="service-pricing">
								<div class="price">
									<span class="currency">$</span>850
									<span class="period">+ Gov fees</span>
								</div>
							</div>
							<div class="service-actions">
								<a href="{{ route('fiancee.visa') }}" class="btn btn-primary-gradient">
									Learn More <i class="fas fa-arrow-right ms-2"></i>
								</a>
							</div>
						</div>
					</div>
				</div>

				<!-- Adjustment of Status -->
				<div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="300">
					<div class="service-card-modern">
						<div class="service-image">
							<img src="{{ asset('assets/img/service2.jpg') }}" alt="Adjustment of Status">
							<div class="service-overlay">
								<div class="service-icon">
									<img src="{{ asset('assets/img/icons/service-icon-2.png') }}" alt="AOS Icon">
								</div>
							</div>
						</div>
						<div class="service-content">
							<h3>Adjustment of Status</h3>
							<p class="service-description">
								After marriage on a K-1 visa, you must file for Adjustment of Status within 90 days to obtain your Green Card and work authorization.
							</p>
							<div class="service-features">
								<div class="feature-item">
									<i class="fas fa-id-card"></i>
									<span>Green Card application</span>
								</div>
								<div class="feature-item">
									<i class="fas fa-briefcase"></i>
									<span>Work permit included</span>
								</div>
								<div class="feature-item">
									<i class="fas fa-plane"></i>
									<span>Travel document</span>
								</div>
							</div>
							<div class="service-pricing">
								<div class="price">
									<span class="currency">$</span>800
									<span class="period">+ Gov fees</span>
								</div>
							</div>
							<div class="service-actions">
								<a href="{{ route('adjustment.visa') }}" class="btn btn-outline-primary">
									Learn More <i class="fas fa-arrow-right ms-2"></i>
								</a>
							</div>
						</div>
					</div>
				</div>

				<!-- CR-1 Spouse Visa -->
				<div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="400">
					<div class="service-card-modern">
						<div class="service-image">
							<img src="{{ asset('assets/img/service3.jpg') }}" alt="CR-1 Spouse Visa">
							<div class="service-overlay">
								<div class="service-icon">
									<img src="{{ asset('assets/img/icons/service-icon-3.png') }}" alt="CR-1 Icon">
								</div>
							</div>
						</div>
						<div class="service-content">
							<h3>CR-1 Spouse Visa</h3>
							<p class="service-description">
								Ideal for already married couples. Your spouse arrives with a Green Card and can work immediately. Takes longer but offers more benefits upon arrival.
							</p>
							<div class="service-features">
								<div class="feature-item">
									<i class="fas fa-ring"></i>
									<span>For married couples</span>
								</div>
								<div class="feature-item">
									<i class="fas fa-id-card"></i>
									<span>Green card on arrival</span>
								</div>
								<div class="feature-item">
									<i class="fas fa-clock"></i>
									<span>12-18 months processing</span>
								</div>
							</div>
							<div class="service-pricing">
								<div class="price">
									<span class="currency">$</span>750
									<span class="period">+ Gov fees</span>
								</div>
							</div>
							<div class="service-actions">
								<a href="{{ route('spouse.visa') }}" class="btn btn-outline-primary">
									Learn More <i class="fas fa-arrow-right ms-2"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Coming Soon Services -->
			<div class="row mt-5">
				<div class="col-12">
					<h3 class="text-center mb-5" data-aos="fade-up">Additional Services</h3>
				</div>
				
				<div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
					<div class="additional-service-card">
						<div class="service-icon-sm">
							<i class="fas fa-file-contract"></i>
						</div>
						<h5>Removal of Conditions</h5>
						<p>Remove conditions from your conditional Green Card after 2 years of marriage.</p>
						<a href="{{ route('contactUs') }}?service=roc" class="service-link">Contact for Details</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
					<div class="additional-service-card">
						<div class="service-icon-sm">
							<i class="fas fa-users"></i>
						</div>
						<h5>IR5 Parent Visa</h5>
						<p>Petition for your parents to immigrate to the United States permanently.</p>
						<a href="{{ route('contactUs') }}?service=ir5" class="service-link">Contact for Details</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
					<div class="additional-service-card">
						<div class="service-icon-sm">
							<i class="fas fa-baby"></i>
						</div>
						<h5>Child Petition</h5>
						<p>Bring your unmarried children under 21 to the United States.</p>
						<a href="{{ route('contactUs') }}?service=child" class="service-link">Contact for Details</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="500">
					<div class="additional-service-card">
						<div class="service-icon-sm">
							<i class="fas fa-flag-usa"></i>
						</div>
						<h5>Naturalization</h5>
						<p>Apply for U.S. citizenship after meeting residency requirements.</p>
						<a href="{{ route('contactUs') }}?service=naturalization" class="service-link">Contact for Details</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Why Choose Us Section -->
	<section class="why-choose-us bg-light ptb-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center mb-5">
					<h3 class="section-title-modern" data-aos="fade-up">Why Choose Our Services?</h3>
					<p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
						Over 20 years of experience helping couples navigate the complex immigration process
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
					<div class="benefit-card">
						<div class="benefit-icon">
							<i class="fas fa-shield-check"></i>
						</div>
						<h5>Money-Back Guarantee</h5>
						<p>100% refund if your petition is denied by USCIS</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
					<div class="benefit-card">
						<div class="benefit-icon">
							<i class="fas fa-headset"></i>
						</div>
						<h5>Unlimited Support</h5>
						<p>Phone and email support throughout the entire process</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
					<div class="benefit-card">
						<div class="benefit-icon">
							<i class="fas fa-clock"></i>
						</div>
						<h5>Fast Processing</h5>
						<p>We prepare all documents quickly and accurately</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="500">
					<div class="benefit-card">
						<div class="benefit-icon">
							<i class="fas fa-award"></i>
						</div>
						<h5>99.2% Success Rate</h5>
						<p>Proven track record with thousands of successful cases</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- CTA Section -->
	<section class="services-cta ptb-60">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<h3 class="cta-title" data-aos="zoom-in">Ready to Start Your Journey?</h3>
					<p class="cta-subtitle" data-aos="zoom-in" data-aos-delay="100">
						Contact us today for a free consultation and let us help you bring your loved one to the United States.
					</p>
					<div class="cta-buttons" data-aos="zoom-in" data-aos-delay="200">
						<a href="{{ route('register') }}" class="btn btn-primary-gradient btn-lg">
							Start Your Application
						</a>
						<a href="tel:702-426-4503" class="btn btn-outline-light btn-lg ms-3">
							<i class="fas fa-phone me-2"></i>
							Call 702-426-4503
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

<style>
/* Modern Services Styles */
.services-hero {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.services-modern {
    background: #ffffff;
}

/* Service Card Modern */
.service-card-modern {
    background: white;
    border-radius: 20px;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.service-card-modern:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}

.service-card-modern.featured {
    border: 2px solid var(--primary-color);
    transform: scale(1.02);
}

.service-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: var(--primary-gradient);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
    z-index: 3;
}

.service-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.service-card-modern:hover .service-image img {
    transform: scale(1.1);
}

.service-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8));
    opacity: 0;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.service-card-modern:hover .service-overlay {
    opacity: 1;
}

.service-icon {
    width: 80px;
    height: 80px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transform: translateY(20px);
    transition: transform 0.3s ease;
}

.service-card-modern:hover .service-icon {
    transform: translateY(0);
}

.service-icon img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

.service-content {
    padding: 2rem;
}

.service-content h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.service-description {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
}

.service-features {
    margin-bottom: 1.5rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
}

.feature-item i {
    color: var(--primary-color);
    font-size: 1rem;
    width: 20px;
    text-align: center;
}

.feature-item span {
    font-size: 0.9rem;
    color: var(--text-dark);
    font-weight: 500;
}

.service-pricing {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 12px;
    text-align: center;
    margin-bottom: 1.5rem;
}

.price {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
}

.price .currency {
    font-size: 1.5rem;
    vertical-align: top;
}

.price .period {
    display: block;
    font-size: 0.9rem;
    color: var(--text-light);
    font-weight: 400;
}

.service-actions .btn {
    width: 100%;
}

/* Additional Service Cards */
.additional-service-card {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
    border-top: 3px solid var(--primary-color);
}

.additional-service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.service-icon-sm {
    width: 60px;
    height: 60px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
    font-size: 1.5rem;
}

.additional-service-card h5 {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.additional-service-card p {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.service-link {
    color: var(--primary-color);
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s ease;
}

.service-link:hover {
    color: var(--secondary-color);
    text-decoration: underline;
}

/* Benefits Section */
.benefit-card {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.benefit-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.benefit-icon {
    width: 70px;
    height: 70px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 1.8rem;
}

.benefit-card h5 {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.benefit-card p {
    color: var(--text-light);
    line-height: 1.6;
    margin: 0;
}

/* CTA Section */
.services-cta {
    background: var(--primary-gradient);
    position: relative;
    overflow: hidden;
}

.services-cta::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.05" d="M0,96L48,112C96,128,192,160,288,165.3C384,171,480,149,576,138.7C672,128,768,128,864,144C960,160,1056,192,1152,197.3C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
    background-size: cover;
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
}

.cta-subtitle {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2rem;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-outline-light {
    background: transparent;
    color: white;
    border: 2px solid white;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-light:hover {
    background: white;
    color: var(--primary-color);
    border-color: white;
}

/* Mobile Responsive */
@media (max-width: 991px) {
    .service-card-modern.featured {
        transform: none;
    }
    
    .cta-title {
        font-size: 2rem;
    }
}

@media (max-width: 767px) {
    .service-content {
        padding: 1.5rem;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .cta-buttons .btn {
        width: 100%;
        max-width: 300px;
    }
    
    .service-pricing {
        padding: 1rem;
    }
    
    .price {
        font-size: 1.75rem;
    }
}
</style>

@section('customScript')
<script>
// Initialize AOS animations
AOS.init({
    duration: 800,
    once: true,
    offset: 100
});

// Add smooth scrolling for anchor links
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
@endsection