<!-- resources\views\web\about-us.blade.php -->
@extends('web.layout.master')
@section('content')
	@include('web.component.bread-crumb', [
		'title' => 'About Us',
	])
	
	<!-- Modern About Us Section -->
	<section class="about-us-modern ptb-80 bg-light">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6" data-aos="fade-right">
					<div class="about-image-wrapper">
						<div class="about-image-container">
							<img src="{{ asset('assets/img/about-p.jpg') }}" alt="About Filipina Fiancee Visa" class="img-fluid">
							<div class="image-overlay"></div>
							<!-- Trust Elements - Positioned inside the image container -->
							<div class="trust-elements">
								<div class="trust-badge">
									<i class="fas fa-award"></i>
									<div>
										<strong>20+ Years</strong>
										<span>Experience</span>
									</div>
								</div>
								<div class="trust-badge">
									<i class="fas fa-users"></i>
									<div>
										<strong>5,000+</strong>
										<span>Happy Couples</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6" data-aos="fade-left">
					<div class="about-content-modern">
						<div class="section-header">
							<span class="section-badge">About Us</span>
							<h2 class="section-title-modern">About Filipina Fiancee Visa</h2>
							<div class="title-decoration"></div>
						</div>
						
						<div class="about-text">
							<p class="lead-text">
								We are Filipina Fiancée Visa, and we are located in Las Vegas, Nevada, USA. We are a Christian company, and our business is guided by Christian principles.
							</p>
							
							<p>
								Filipina Fiancée Visa was started back in 2002 and specializes in assisting U.S. Citizens with bringing their Filipina fiancées and spouses to the United States. Filipina Fiancée Visa has helped thousands of couples through their immigration journeys.
							</p>
						</div>
						
						<!-- Key Features -->
						<div class="key-features">
							<div class="feature-item">
								<i class="fas fa-check-circle"></i>
								<span>Christian-based company with strong values</span>
							</div>
							<div class="feature-item">
								<i class="fas fa-check-circle"></i>
								<span>Over 20 years of immigration expertise</span>
							</div>
							<div class="feature-item">
								<i class="fas fa-check-circle"></i>
								<span>Thousands of successful cases</span>
							</div>
							<div class="feature-item">
								<i class="fas fa-check-circle"></i>
								<span>Based in Las Vegas, Nevada</span>
							</div>
						</div>
						
						<div class="about-cta">
							<a href="{{ route('contactUs') }}" class="btn btn-primary-gradient">
								Contact Us Today
								<i class="fas fa-arrow-right ms-2"></i>
							</a>
							<a href="tel:702-426-4503" class="btn btn-outline-primary ms-3">
								<i class="fas fa-phone me-2"></i>
								702-426-4503
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Values Section -->
	<section class="values-section ptb-60">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center mb-5">
					<h3 class="section-title-modern" data-aos="fade-up">Our Values & Commitment</h3>
					<p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
						What sets us apart in the immigration services industry
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
					<div class="value-card">
						<div class="value-icon">
							<i class="fas fa-heart"></i>
						</div>
						<h4>Christian Values</h4>
						<p>Our business is guided by Christian principles, ensuring ethical and compassionate service to every couple we serve.</p>
					</div>
				</div>
				<div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
					<div class="value-card">
						<div class="value-icon">
							<i class="fas fa-star"></i>
						</div>
						<h4>Expert Experience</h4>
						<p>With over 20 years in the immigration field, we have the knowledge and expertise to navigate complex visa processes.</p>
					</div>
				</div>
				<div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="400">
					<div class="value-card">
						<div class="value-icon">
							<i class="fas fa-shield-alt"></i>
						</div>
						<h4>Guaranteed Results</h4>
						<p>We're so confident in our services that we offer a money-back guarantee if your petition is denied by USCIS.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

<style>
/* Modern About Us Styles */
.about-us-modern {
    position: relative;
}

.about-image-wrapper {
    position: relative;
}

.about-image-container {
    position: relative;
    border-radius: 20px;
    overflow: visible; /* Changed from hidden to visible to show badges that extend outside */
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}

.about-image-container img {
    width: 100%;
    height: auto;
    min-height: 400px;
    object-fit: cover;
    transition: transform 0.3s ease;
    border-radius: 20px; /* Add border radius to image itself */
}

.about-image-container:hover img {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.2), rgba(118, 75, 162, 0.2));
    opacity: 0.5;
    transition: opacity 0.3s ease;
    border-radius: 20px;
    pointer-events: none; /* Ensure overlay doesn't interfere with badges */
}

.about-image-container:hover .image-overlay {
    opacity: 0.8;
}

/* Trust Elements - Key fixes for visibility */
.trust-elements {
    position: absolute;
    bottom: 30px; /* Position badges inside the image area */
    left: 20px;
    right: 20px;
    display: flex;
    gap: 1rem;
    z-index: 20; /* High z-index to ensure visibility */
}

.trust-badge {
    background: rgba(255, 255, 255, 0.98); /* Almost opaque white background */
    padding: 1rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25); /* Stronger shadow for depth */
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
    backdrop-filter: blur(10px); /* Blur effect for better readability */
    border: 2px solid rgba(255, 255, 255, 1); /* White border for definition */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.trust-badge:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

.trust-badge i {
    font-size: 1.8rem;
    color: #667eea; /* Primary color */
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.trust-badge strong {
    display: block;
    color: #1a202c; /* Very dark color for maximum contrast */
    font-size: 1.2rem;
    font-weight: 700;
    line-height: 1.2;
}

.trust-badge span {
    font-size: 0.9rem;
    color: #4a5568; /* Dark gray for good readability */
    font-weight: 500;
    display: block;
}

.about-content-modern {
    padding-left: 2rem;
}

.section-header {
    margin-bottom: 2rem;
}

.section-badge {
    display: inline-block;
    background: linear-gradient(135deg, #667eea15, #764ba215);
    color: var(--primary-color);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.title-decoration {
    width: 60px;
    height: 4px;
    background: var(--primary-gradient);
    border-radius: 2px;
    margin: 1rem 0 0 0;
}

.lead-text {
    font-size: 1.2rem;
    font-weight: 500;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.about-text p {
    font-size: 1rem;
    line-height: 1.8;
    color: var(--text-light);
    margin-bottom: 1rem;
}

.key-features {
    margin: 2rem 0;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
}

.feature-item i {
    color: var(--success-color, #10b981);
    font-size: 1.1rem;
}

.feature-item span {
    color: var(--text-dark);
    font-weight: 500;
}

.about-cta {
    margin-top: 2.5rem;
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

/* Values Section */
.values-section {
    background: #f8f9fa;
}

.value-card {
    background: white;
    padding: 2.5rem 2rem;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
    border-top: 4px solid var(--primary-color, #667eea);
}

.value-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.value-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 2rem;
}

.value-card h4 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark, #2c3e50);
    margin-bottom: 1rem;
}

.value-card p {
    color: var(--text-light, #5a6c7d);
    line-height: 1.6;
    margin: 0;
}

/* Mobile Responsive */
@media (max-width: 991px) {
    .about-content-modern {
        padding-left: 0;
        margin-top: 3rem;
    }
    
    .trust-elements {
        bottom: 20px; /* Keep badges visible on mobile */
        flex-direction: row; /* Keep side by side on tablets */
    }
    
    .trust-badge {
        padding: 0.75rem;
    }
    
    .trust-badge strong {
        font-size: 1rem;
    }
    
    .trust-badge span {
        font-size: 0.8rem;
    }
    
    .about-cta {
        justify-content: center;
    }
}

@media (max-width: 767px) {
    .trust-elements {
        flex-direction: column; /* Stack vertically on small screens */
        gap: 0.75rem;
        bottom: 15px;
        left: 15px;
        right: 15px;
    }
    
    .trust-badge {
        width: 100%;
    }
    
    .about-cta .btn {
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .about-image-container img {
        min-height: 300px;
    }
}

@media (max-width: 576px) {
    .trust-badge i {
        font-size: 1.5rem;
    }
    
    .trust-badge strong {
        font-size: 0.95rem;
    }
    
    .trust-badge span {
        font-size: 0.75rem;
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

// Add hover effect to trust badges
document.querySelectorAll('.trust-badge').forEach(badge => {
    badge.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px) scale(1.05)';
    });
    
    badge.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});
</script>
@endsection