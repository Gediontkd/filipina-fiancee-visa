@extends('web.layout.master')
@section('content')
	<section class="breadcrumb-main">
		<div class="container">
			<div class="row">
				<div id="breadcrumb">
					<div class="breadcrumb-txt">
						<h3>Guarantee</h3>
					</div>
					<div class="row">
						<div class="col">
							<div class="breadcrumb-nav">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
										<li class="breadcrumb-item active" aria-current="page">Guarantee</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Modern Guarantee Hero -->
	<section class="guarantee-hero ptb-80">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6" data-aos="fade-right">
					<div class="guarantee-content">
						<div class="guarantee-badge">
							<i class="fas fa-shield-check"></i>
							<span>100% Money-Back Guarantee</span>
						</div>
						<h1 class="guarantee-title">Your Peace of Mind is Our Promise</h1>
						<p class="guarantee-subtitle">
							We're so confident in our expertise and success rate that we offer a complete money-back guarantee if your petition is denied by USCIS.
						</p>
						<div class="confidence-stats">
							<div class="stat-item">
								<div class="stat-number">9.9%</div>
								<div class="stat-label">Success Rate</div>
							</div>
							<div class="stat-item">
								<div class="stat-number">5,000+</div>
								<div class="stat-label">Happy Couples</div>
							</div>
							<div class="stat-item">
								<div class="stat-number">20+</div>
								<div class="stat-label">Years Experience</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6" data-aos="fade-left">
					<div class="guarantee-visual">
						<div class="guarantee-shield">
							<img src="{{ asset('assets/img/guarantee2.png') }}" alt="Money Back Guarantee" class="img-fluid">
							<div class="guarantee-overlay">
								<div class="guarantee-checkmark">
									<i class="fas fa-check"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Guarantee Details -->
	<section class="guarantee-details bg-light ptb-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="guarantee-card" data-aos="fade-up">
						<div class="guarantee-header">
							<h2>Guaranteed Approval Or Your Money Back</h2>
							<p class="lead-text">
								If your petition is denied by the U.S. Citizenship and Immigration Services (USCIS), 
								Filipina Fiancee Visa will refund 100% of the fees paid to us for the petition that was denied.
							</p>
						</div>

						<div class="guarantee-conditions">
							<h4>Guarantee Conditions:</h4>
							<div class="conditions-grid">
								<div class="condition-item" data-aos="fade-up" data-aos-delay="200">
									<div class="condition-icon">
										<i class="fas fa-calendar-alt"></i>
									</div>
									<div class="condition-content">
										<h5>30-Day Window</h5>
										<p>Refund requests must be submitted within <strong>30 days of the denial</strong> and must include a copy of the denial letter from USCIS that indicates the reason for denial.</p>
									</div>
								</div>

								<div class="condition-item" data-aos="fade-up" data-aos-delay="300">
									<div class="condition-icon">
										<i class="fas fa-file-alt"></i>
									</div>
									<div class="condition-content">
										<h5>Response Requirements</h5>
										<p>Denial must not be because you failed to respond to an RFE or inquiry from USCIS by the deadline they gave you, or you did not send them what they asked for.</p>
									</div>
								</div>

								<div class="condition-item" data-aos="fade-up" data-aos-delay="400">
									<div class="condition-icon">
										<i class="fas fa-credit-card"></i>
									</div>
									<div class="condition-content">
										<h5>Refund Process</h5>
										<p>All refunds are issued by credit card only to the original purchaser. Refunds will be processed within 14 days and may take an additional 7 days to credit to your card.</p>
									</div>
								</div>

								<div class="condition-item" data-aos="fade-up" data-aos-delay="500">
									<div class="condition-icon">
										<i class="fas fa-university"></i>
									</div>
									<div class="condition-content">
										<h5>Government Fees</h5>
										<p>Fees paid to the government or any third party are not refundable through our guarantee program.</p>
									</div>
								</div>

								<div class="condition-item" data-aos="fade-up" data-aos-delay="600">
									<div class="condition-icon">
										<i class="fas fa-heart-broken"></i>
									</div>
									<div class="condition-content">
										<h5>Relationship Changes</h5>
										<p>Our Money Back Guarantee does NOT apply to circumstances where the couple breaks up, has a change of heart, or decides not to proceed with an elective termination of services.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Why We Can Offer This Guarantee -->
	<section class="why-guarantee ptb-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center mb-5">
					<h3 class="section-title-modern" data-aos="fade-up">Why We Can Offer This Guarantee</h3>
					<p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
						Our confidence comes from over 20 years of expertise and an exceptional success rate
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
					<div class="expertise-card">
						<div class="expertise-icon">
							<i class="fas fa-graduation-cap"></i>
						</div>
						<h4>Expert Knowledge</h4>
						<p>Our team has deep understanding of USCIS requirements, common pitfalls, and best practices accumulated over two decades.</p>
					</div>
				</div>
				<div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
					<div class="expertise-card">
						<div class="expertise-icon">
							<i class="fas fa-chart-line"></i>
						</div>
						<h4>Proven Process</h4>
						<p>We've refined our application process through thousands of successful cases, ensuring accuracy and completeness every time.</p>
					</div>
				</div>
				<div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="400">
					<div class="expertise-card">
						<div class="expertise-icon">
							<i class="fas fa-microscope"></i>
						</div>
						<h4>Thorough Review</h4>
						<p>Every application undergoes multiple quality checks and reviews before submission to minimize any chance of errors or omissions.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Success Stories Related to Guarantee -->
	<section class="guarantee-testimonials bg-light ptb-60">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center mb-5">
					<h3 class="section-title-modern" data-aos="fade-up">Success Stories</h3>
					<p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
						Hear from couples who trusted our guarantee and achieved their dreams
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="200">
					<div class="guarantee-testimonial">
						<div class="testimonial-content">
							<p>"We were nervous about the process, but the money-back guarantee gave us confidence to proceed. Our K-1 visa was approved without any issues!"</p>
						</div>
						<div class="testimonial-author">
							<img src="{{ asset('assets/img/testimonial-1.jpg') }}" alt="Success Story">
							<div>
								<strong>Alex & Camelia</strong>
								<span>K-1 Visa Approved</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="300">
					<div class="guarantee-testimonial">
						<div class="testimonial-content">
							<p>"The guarantee shows they really stand behind their work. That level of confidence convinced us they were the right choice. We're now happily married!"</p>
						</div>
						<div class="testimonial-author">
							<img src="{{ asset('assets/img/testimonial-2.jpg') }}" alt="Success Story">
							<div>
								<strong>Jonathan & Sarah</strong>
								<span>Now Married</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- FAQ Section -->
	<section class="guarantee-faq ptb-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<h3 class="section-title-modern text-center mb-5" data-aos="fade-up">Frequently Asked Questions</h3>
					<div class="faq-accordion" data-aos="fade-up" data-aos-delay="100">
						<div class="accordion" id="guaranteeFAQ">
							<div class="accordion-item">
								<h3 class="accordion-header">
									<button class="accordion-button" type="button" data-bs-toggle="collapse" 
											data-bs-target="#faq1" aria-expanded="true">
										How quickly do I get my refund if denied?
									</button>
								</h3>
								<div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#guaranteeFAQ">
									<div class="accordion-body">
										Refunds are processed within 14 days of submitting your refund request with the denial letter. It may take an additional 7 days for the credit to appear on your card.
									</div>
								</div>
							</div>
							
							<div class="accordion-item">
								<h3 class="accordion-header">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
											data-bs-target="#faq2" aria-expanded="false">
										What if I don't respond to an RFE on time?
									</button>
								</h3>
								<div id="faq2" class="accordion-collapse collapse" data-bs-parent="#guaranteeFAQ">
									<div class="accordion-body">
										If your petition is denied because you failed to respond to an RFE (Request for Evidence) by the deadline, our guarantee would not apply. We always notify clients immediately about RFEs and help prepare responses.
									</div>
								</div>
							</div>
							
							<div class="accordion-item">
								<h3 class="accordion-header">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
											data-bs-target="#faq3" aria-expanded="false">
										Are government fees included in the refund?
									</button>
								</h3>
								<div id="faq3" class="accordion-collapse collapse" data-bs-parent="#guaranteeFAQ">
									<div class="accordion-body">
										No, government fees paid to USCIS and other third-party fees are not refundable under our guarantee. We only refund our service fees.
									</div>
								</div>
							</div>
							
							<div class="accordion-item">
								<h3 class="accordion-header">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
											data-bs-target="#faq4" aria-expanded="false">
										What documentation do I need for a refund?
									</button>
								</h3>
								<div id="faq4" class="accordion-collapse collapse" data-bs-parent="#guaranteeFAQ">
									<div class="accordion-body">
										You need to provide a copy of the official denial letter from USCIS that clearly states the reason for denial. The refund request must be submitted within 30 days of receiving the denial.
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- CTA Section -->
	<section class="guarantee-cta ptb-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<h3 class="cta-title" data-aos="zoom-in">Ready to Start With Complete Confidence?</h3>
					<p class="cta-subtitle" data-aos="zoom-in" data-aos-delay="100">
						With our money-back guarantee, you have nothing to lose and everything to gain. Let us help bring your loved one home.
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
					<div class="guarantee-footer-note" data-aos="fade-up" data-aos-delay="300">
						<i class="fas fa-shield-check me-2"></i>
						100% Money-Back Guarantee • No Questions Asked • 20+ Years Trusted
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

<style>
/* Modern Guarantee Page Styles */
.guarantee-hero {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

.guarantee-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: var(--success-gradient);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    margin-bottom: 2rem;
}

.guarantee-badge i {
    font-size: 1.5rem;
}

.guarantee-title {
    font-size: 3rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.guarantee-subtitle {
    font-size: 1.25rem;
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 3rem;
}

.confidence-stats {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
    padding: 1.5rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    border-top: 4px solid var(--primary-color);
    min-width: 120px;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.stat-label {
    color: var(--text-light);
    font-weight: 600;
    font-size: 0.9rem;
}

.guarantee-visual {
    text-align: center;
    position: relative;
}

.guarantee-shield {
    position: relative;
    display: inline-block;
}

.guarantee-shield img {
    max-width: 400px;
    filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.15));
}

.guarantee-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.guarantee-shield:hover .guarantee-overlay {
    opacity: 1;
}

.guarantee-checkmark {
    width: 80px;
    height: 80px;
    background: var(--success-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Guarantee Details */
.guarantee-card {
    background: white;
    padding: 3rem;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.guarantee-header {
    text-align: center;
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 2px solid #f8f9fa;
}

.guarantee-header h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.lead-text {
    font-size: 1.2rem;
    color: var(--text-light);
    line-height: 1.7;
}

.guarantee-conditions h4 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 2rem;
    text-align: center;
}

.conditions-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}

.condition-item {
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    padding: 2rem;
    background: #f8f9fa;
    border-radius: 15px;
    border-left: 4px solid var(--primary-color);
}

.condition-icon {
    width: 60px;
    height: 60px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.condition-content h5 {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.75rem;
}

.condition-content p {
    color: var(--text-light);
    line-height: 1.6;
    margin: 0;
}

.condition-content strong {
    color: var(--text-dark);
    font-weight: 700;
}

/* Expertise Cards */
.expertise-card {
    background: white;
    padding: 2.5rem 2rem;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
    border-top: 4px solid var(--primary-color);
}

.expertise-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.expertise-icon {
    width: 80px;
    height: 80px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 2rem;
}

.expertise-card h4 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.expertise-card p {
    color: var(--text-light);
    line-height: 1.6;
    margin: 0;
}

/* Guarantee Testimonials */
.guarantee-testimonial {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    height: 100%;
    border-left: 4px solid var(--success-color);
}

.testimonial-content p {
    font-size: 1.1rem;
    color: var(--text-dark);
    line-height: 1.7;
    font-style: italic;
    margin-bottom: 1.5rem;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding-top: 1.5rem;
    border-top: 2px solid #f8f9fa;
}

.testimonial-author img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--success-color);
}

.testimonial-author strong {
    display: block;
    font-weight: 700;
    color: var(--text-dark);
}

.testimonial-author span {
    color: var(--text-light);
    font-size: 0.9rem;
}

/* FAQ Styles */
.accordion-item {
    border: none;
    margin-bottom: 1rem;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.accordion-button {
    background: white;
    color: var(--text-dark);
    font-weight: 600;
    padding: 1.25rem;
    border: none;
    box-shadow: none;
}

.accordion-button:not(.collapsed) {
    background: linear-gradient(to right, #f0f4ff, #f8f9ff);
    color: var(--primary-color);
}

.accordion-button:focus {
    box-shadow: none;
    border-color: transparent;
}

.accordion-body {
    padding: 1.25rem;
    color: var(--text-dark);
    line-height: 1.8;
}

/* CTA Section */
.guarantee-cta {
    background: var(--primary-gradient);
    position: relative;
    overflow: hidden;
}

.guarantee-cta::before {
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
    margin-bottom: 2rem;
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

.guarantee-footer-note {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    font-weight: 500;
}

/* Mobile Responsive */
@media (max-width: 991px) {
    .guarantee-title {
        font-size: 2.5rem;
    }
    
    .confidence-stats {
        justify-content: center;
    }
    
    .cta-title {
        font-size: 2rem;
    }
}

@media (max-width: 767px) {
    .guarantee-card {
        padding: 2rem;
    }
    
    .condition-item {
        flex-direction: column;
        text-align: center;
    }
    
    .guarantee-title {
        font-size: 2rem;
    }
    
    .confidence-stats {
        flex-direction: column;
        align-items: center;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .cta-buttons .btn {
        width: 100%;
        max-width: 300px;
    }
    
    .testimonial-author {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 576px) {
    .guarantee-shield img {
        max-width: 250px;
    }
    
    .stat-item {
        padding: 1rem;
    }
    
    .condition-content h5 {
        font-size: 1.1rem;
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

// Add smooth interactions
document.addEventListener('DOMContentLoaded', function() {
    // Animate stats on scroll
    const observeStats = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const number = entry.target.querySelector('.stat-number');
                const finalNumber = number.textContent;
                const isPercentage = finalNumber.includes('%');
                const numericValue = parseInt(finalNumber.replace(/[^\d]/g, ''));
                
                let current = 0;
                const increment = numericValue / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= numericValue) {
                        current = numericValue;
                        clearInterval(timer);
                    }
                    
                    if (isPercentage) {
                        number.textContent = Math.floor(current) + '%';
                    } else if (finalNumber.includes('+')) {
                        number.textContent = Math.floor(current).toLocaleString() + '+';
                    } else {
                        number.textContent = Math.floor(current).toLocaleString();
                    }
                }, 20);
            }
        });
    });
    
    document.querySelectorAll('.stat-item').forEach(stat => {
        observeStats.observe(stat);
    });
    
    // Add hover effects to condition items
    document.querySelectorAll('.condition-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(10px)';
            this.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.15)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            this.style.boxShadow = 'none';
        });
    });
});
</script>
@endsection