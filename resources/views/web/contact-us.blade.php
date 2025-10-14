<!-- resources\views\web\contact-us.blade.php -->
@extends('web.layout.master')
@section('content')
	{{ getLanguage() }}
	@include('web.component.bread-crumb', [
		'title' => __('contact-us.contactUs'),
	])
	
	<!-- Modern Contact Section -->
	<section class="contact-modern ptb-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center mb-5">
					<h2 class="section-title-modern" data-aos="fade-up">Get in Touch</h2>
					<p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
						Ready to start your visa journey? Contact us today for expert guidance and personalized assistance.
					</p>
				</div>
			</div>
			
			<div class="row">
				<!-- Contact Information Cards -->
				<div class="col-lg-4 mb-4" data-aos="fade-right">
					<div class="contact-info-cards">
						<!-- Address Card -->
						<div class="contact-card">
							<div class="contact-icon">
								<i class="fas fa-map-marker-alt"></i>
							</div>
							<div class="contact-details">
								<h5>{{ __('contact-us.ourAddress') }}</h5>
								<p>6955 N Durango Dr. Ste 1115-318<br>Las Vegas, NV 89149-4411 USA</p>
							</div>
						</div>
						
						<!-- Phone Card -->
						<div class="contact-card">
							<div class="contact-icon">
								<i class="fas fa-phone-alt"></i>
							</div>
							<div class="contact-details">
								<h5>{{ __('contact-us.contactPhones') }}</h5>
								<p>
									<a href="tel:702-426-4503" class="contact-link">
										{{ __('contact-us.phone') }}: 702-426-4503
									</a>
								</p>
								<p>{{ __('contact-us.fax') }}: 888-371-6310</p>
							</div>
						</div>
						
						<!-- Hours Card -->
						<div class="contact-card">
							<div class="contact-icon">
								<i class="fas fa-clock"></i>
							</div>
							<div class="contact-details">
								<h5>Business Hours</h5>
								<p>Mon–Fri: 9:00 AM – 5:00 PM PT<br>
								Sat–Sun: Closed<br>
							</div>
						</div>
						
						<!-- CTA Card -->
						<div class="quick-contact-cta">
							<h6>Need Immediate Help?</h6>
							<a href="tel:702-426-4503" class="btn btn-primary-gradient w-100">
								<i class="fas fa-phone me-2"></i>
								Call Now: 702-426-4503
							</a>
						</div>
					</div>
				</div>
				
				<!-- Contact Form -->
				<div class="col-lg-8 mb-4" data-aos="fade-left">
					<div class="contact-form-modern">
						<div class="form-header">
							<h4>Send Us a Message</h4>
							<p>Fill out the form below and we'll get back to you within 24 hours.</p>
						</div>
						
						{{ Form::open(['url' => route('contactUs'), 'id' => 'contactUs', 'class' => 'modern-form']) }}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group-modern">
										<label for="name">{{ __('contact-us.enterName') }}</label>
										{{ Form::text('name', old('name'), ['id' => 'name', 'class' => 'form-control-modern', 'placeholder' => 'Your Full Name']) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group-modern">
										<label for="email">{{ __('contact-us.enterEmail') }}</label>
										{{ Form::email('email', old('email'), ['id' => 'email', 'class' => 'form-control-modern', 'placeholder' => 'your@email.com']) }}
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group-modern">
										<label for="subject">{{ __('contact-us.subject') }}</label>
										{{ Form::text('subject', old('subject'), ['id' => 'subject', 'class' => 'form-control-modern', 'placeholder' => 'What can we help you with?']) }}
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group-modern">
										<label for="message">{{ __('contact-us.message') }}</label>
										{{ Form::textarea('message', old('message'), ['id' => 'message', 'class' => 'form-control-modern', 'rows' => 5, 'placeholder' => 'Tell us more about your situation and how we can help...']) }}
									</div>
								</div>
							</div>
							
							<!-- Captcha Section -->
							<div class="captcha-section">
								<div class="row align-items-end">
									<div class="col-md-5">
										<label for="captcha">Security Verification</label>
										<div class="captcha-container">
											<span class="captcha-image">{!! captcha_img() !!}</span>
											<button type="button" class="captcha-refresh" id="reload">
												<i class="fas fa-redo-alt"></i>
											</button>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group-modern">
											<label for="captcha">Enter the characters you see</label>
											<input id="captcha" type="text" class="form-control-modern" placeholder="Enter Captcha" name="captcha">
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-submit">
								{{ Form::submit(__('contact-us.sendMessage'), ['class' => 'btn btn-primary-gradient btn-lg', 'id' => 'contactUsBtn']) }}
								<p class="form-note">
									<i class="fas fa-shield-alt me-1"></i>
									Your information is secure and will never be shared with third parties.
								</p>
							</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<!-- Trust & Guarantee Section -->
	<section class="contact-guarantee bg-light ptb-60">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6" data-aos="fade-right">
					<div class="guarantee-content">
						<h3>Why Choose Filipina Fiancee Visa?</h3>
						<div class="guarantee-features">
							<div class="guarantee-item">
								<i class="fas fa-award"></i>
								<div>
									<strong>20+ Years Experience</strong>
									<span>Trusted by thousands of couples since 2002</span>
								</div>
							</div>
							<div class="guarantee-item">
								<i class="fas fa-shield-check"></i>
								<div>
									<strong>Money-Back Guarantee</strong>
									<span>100% refund if your petition is denied</span>
								</div>
							</div>
							<div class="guarantee-item">
								<i class="fas fa-headset"></i>
								<div>
									<strong>Expert Support</strong>
									<span>Unlimited phone and email support</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6" data-aos="fade-left">
					<div class="contact-stats">
						<div class="stat-item">
							<div class="stat-number">5,000+</div>
							<div class="stat-label">Happy Couples</div>
						</div>
						<div class="stat-item">
							<div class="stat-number">99%</div>
							<div class="stat-label">Approval Rate</div>
						</div>
						<div class="stat-item">
							<div class="stat-number">24/7</div>
							<div class="stat-label">Support Available</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

<style>
/* Modern Contact Page Styles */
.contact-modern {
    background: #ffffff;
}

.contact-info-cards {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.contact-card {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    transition: all 0.3s ease;
    border-left: 4px solid var(--primary-color);
}

.contact-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.contact-icon {
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

.contact-details h5 {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.contact-details p {
    color: var(--text-light);
    margin: 0;
    line-height: 1.6;
}

.contact-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.contact-link:hover {
    color: var(--secondary-color);
}

.quick-contact-cta {
    background: var(--primary-gradient);
    padding: 2rem;
    border-radius: 20px;
    text-align: center;
    color: white;
    margin-top: 1rem;
}

.quick-contact-cta h6 {
    color: white;
    font-weight: 600;
    margin-bottom: 1rem;
}

.quick-contact-cta .btn {
    background: white;
    color: var(--primary-color);
    border: none;
}

.quick-contact-cta .btn:hover {
    background: rgba(255, 255, 255, 0.9);
    color: var(--primary-color);
}

/* Modern Form Styles */
.contact-form-modern {
    background: white;
    padding: 3rem;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.form-header {
    margin-bottom: 2.5rem;
    text-align: center;
}

.form-header h4 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.form-header p {
    color: var(--text-light);
    font-size: 1rem;
}

.form-group-modern {
    margin-bottom: 1.5rem;
    position: relative;
}

.form-group-modern label {
    display: block;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-control-modern {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.form-control-modern:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background: white;
}

.form-control-modern::placeholder {
    color: #adb5bd;
}

/* Captcha Styles */
.captcha-section {
    margin: 2rem 0;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 12px;
    border: 2px dashed #dee2e6;
}

.captcha-container {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-top: 0.5rem;
}

.captcha-image {
    flex: 1;
}

.captcha-image img {
    width: 100%;
    max-width: 150px;
    border-radius: 8px;
    border: 2px solid #e9ecef;
}

.captcha-refresh {
    width: 40px;
    height: 40px;
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.captcha-refresh:hover {
    background: var(--secondary-color);
    transform: rotate(90deg);
}

.form-submit {
    text-align: center;
    margin-top: 2rem;
}

.form-note {
    margin-top: 1rem;
    color: var(--text-light);
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

/* Guarantee Section */
.contact-guarantee {
    background: #f8f9fa;
}

.guarantee-features {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-top: 2rem;
}

.guarantee-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.guarantee-item i {
    width: 50px;
    height: 50px;
    background: var(--primary-gradient);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.guarantee-item strong {
    display: block;
    font-weight: 700;
    color: var(--text-dark);
    font-size: 1.1rem;
}

.guarantee-item span {
    color: var(--text-light);
    font-size: 0.9rem;
}

.contact-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 2rem;
}

.stat-item {
    text-align: center;
    padding: 2rem 1rem;
    background: white;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    border-top: 4px solid var(--primary-color);
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
}

/* Mobile Responsive */
@media (max-width: 991px) {
    .contact-form-modern {
        padding: 2rem;
    }
    
    .contact-stats {
        margin-top: 3rem;
    }
}

@media (max-width: 767px) {
    .contact-card {
        padding: 1.5rem;
    }
    
    .contact-form-modern {
        padding: 1.5rem;
    }
    
    .captcha-section {
        text-align: center;
    }
    
    .captcha-container {
        justify-content: center;
    }
    
    .contact-stats {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .guarantee-features {
        gap: 1rem;
    }
}

/* Form Validation Error Styles */
.error {
    color: #dc3545;
    font-size: 0.9rem;
    margin-top: 0.25rem;
}

.form-control-modern.error {
    border-color: #dc3545;
    background: #fff5f5;
}
</style>

@section('customScript')
<script type="text/javascript">
	// Initialize AOS animations
	AOS.init({
		duration: 800,
		once: true,
		offset: 100
	});

	// Captcha refresh functionality
	$('#reload').click(function () {
		$.ajax({
			type: 'GET',
			url: 'reload-captcha',
			success: function (data) {
				$(".captcha-image span").html(data.captcha);
			}
		});
	});

	// Form validation with modern styling
	$("#contactUs").validate({    
		rules: {
			name: {
				required: true,
			},
			email: {
				required: true,
			},
			subject: {
				required: true,
			},
			message: {
				required: true,
			},
			captcha: {
				required: true,
			},           
		},
		messages: {
			name: "Please enter your name",
			email: "Please enter a valid email address",
			subject: "Please enter a subject",
			message: "Please enter your message",                
			captcha: "Please enter the captcha characters",                
		},
		errorElement: 'div',
		errorClass: 'error',
		highlight: function(element, errorClass, validClass) {
			$(element).addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).removeClass('error');
		}
	});

	// Smooth form interactions
	$('.form-control-modern').on('focus', function() {
		$(this).parent().addClass('focused');
	});

	$('.form-control-modern').on('blur', function() {
		if ($(this).val() === '') {
			$(this).parent().removeClass('focused');
		}
	});
</script>
@endsection