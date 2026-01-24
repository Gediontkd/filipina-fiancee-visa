<!-- resources\views\web\testimonial.blade.php -->
@extends('web.layout.master')
@section('content')
	@include('web.component.bread-crumb', [
		'title' => 'Testimonials',
	])

	<!-- Modern Testimonials Hero -->
	<section class="testimonials-hero ptb-60 bg-light">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<h2 class="section-title-modern" data-aos="fade-up">Success Stories</h2>
					<p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
						Over 5,000 couples have trusted us to help them navigate the complex immigration process. Here are some of their stories.
					</p>
					<!-- Trust Stats -->
					<div class="trust-stats" data-aos="fade-up" data-aos-delay="200">
						<div class="stat-badge">
							<strong>5,000+</strong>
							<span>Happy Couples</span>
						</div>
						<div class="stat-badge">
							<strong>99%</strong>
							<span>Success Rate</span>
						</div>
						<div class="stat-badge">
							<strong>20+</strong>
							<span>Years Experience</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Featured Testimonials -->
	<section class="featured-testimonials ptb-80">
		<div class="container">
			<div class="row">
				<div class="col-12 mb-5">
					<h3 class="text-center section-title-modern" data-aos="fade-up">Featured Success Stories</h3>
				</div>
			</div>
			<div class="row">
				<!-- Featured Testimonial 1 -->
				<div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="200">
					<div class="testimonial-featured">
						<div class="testimonial-content">
							<div class="quote-icon">
								<i class="fas fa-quote-left"></i>
							</div>
							<p class="testimonial-text">
								"We highly recommend Filipina Fiancee Visa! It's a no-brainer, you need their help. They were very reasonably priced and did an excellent job. I asked them a ton of questions and they always had the answer. They certainly made it easy."
							</p>
							<div class="rating">
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
							</div>
						</div>
						<div class="testimonial-author-featured">
							<img src="{{ asset('assets/img/testimonial-1.jpg') }}" alt="Alex & Camelia">
							<div class="author-info">
								<h5>Alex & Camelia</h5>
								<span>Dallas, Texas</span>
								<div class="success-badge">K-1 Visa Success</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Featured Testimonial 2 -->
				<div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="300">
					<div class="testimonial-featured">
						<div class="testimonial-content">
							<div class="quote-icon">
								<i class="fas fa-quote-left"></i>
							</div>
							<p class="testimonial-text">
								"Thank you to Filipina Fiancee Visa for doing a great job with helping me to get my fiancee here. This was the best money I have ever spent! They answered all our questions, and we had a lot of questions, and they were very professional and courteous always."
							</p>
							<div class="rating">
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
							</div>
						</div>
						<div class="testimonial-author-featured">
							<img src="{{ asset('assets/img/testimonials-5.jpg') }}" alt="Ken & May">
							<div class="author-info">
								<h5>Ken & May</h5>
								<span>Hawaii</span>
								<div class="success-badge">Now Married</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- All Testimonials Grid -->
	<section class="testimonials-grid bg-light ptb-80">
		<div class="container">
			<div class="row">
				<div class="col-12 mb-5">
					<h3 class="text-center section-title-modern" data-aos="fade-up">What Our Clients Say</h3>
					<p class="text-center section-subtitle" data-aos="fade-up" data-aos-delay="100">
						Real stories from real couples who achieved their immigration dreams
					</p>
				</div>
			</div>

			<div class="testimonials-masonry">
				<!-- Testimonial 1 -->
				<div class="testimonial-card-modern" data-aos="fade-up" data-aos-delay="200">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonial-2.jpg') }}" alt="Jonathan & Sarah Mae">
						<div class="author-details">
							<h6>Jonathan & Sarah Mae</h6>
							<span>Ohio</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"You guys were so great with helping me to get my fiancee and her son here with a fiancee visa. Sarah and Gabriel were APPROVED for their Green Cards! We just wanted to let you guys know! Thanks again for your excellent service."</p>
					<div class="testimonial-footer">
						<span class="visa-type">K-1 + AOS Success</span>
					</div>
				</div>

				<!-- Testimonial 2 -->
				<div class="testimonial-card-modern" data-aos="fade-up" data-aos-delay="300">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonials-6.jpg') }}" alt="Christian & Janine">
						<div class="author-details">
							<h6>Christian & Janine</h6>
							<span>Florida</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"I can't thank you guys enough, our visa was approved because of you. I have stressed and stressed about this process but u guys made it so easy. To anyone looking for assistance on getting their K1 fiance visa, I 110% recommend Filipina Fiancee Visa!!"</p>
					<div class="testimonial-footer">
						<span class="visa-type">K-1 Visa Approved</span>
					</div>
				</div>

				<!-- Testimonial 3 -->
				<div class="testimonial-card-modern" data-aos="fade-up" data-aos-delay="400">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonial-3.png') }}" alt="M&M">
						<div class="author-details">
							<h6>M&M</h6>
							<span>Oklahoma</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"We used your service and my Asawa passed her interview at the embassy and got her visa with no problems. Thank you for your help!!! You have handled everything very professionally."</p>
					<div class="testimonial-footer">
						<span class="visa-type">Embassy Success</span>
					</div>
				</div>

				<!-- Testimonial 4 -->
				<div class="testimonial-card-modern" data-aos="fade-up" data-aos-delay="500">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonial-7.png') }}" alt="Chris & Isabelita">
						<div class="author-details">
							<h6>Chris & Isabelita</h6>
							<span>Texas</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"I am writing this letter as a testimonial to the good service, skill, insight, and patience exhibited by the professionals at Filipina Fiancée Visa. We just celebrated our first happy wedding anniversary."</p>
					<div class="testimonial-footer">
						<span class="visa-type">Happily Married</span>
					</div>
				</div>

				<!-- Testimonial 5 -->
				<div class="testimonial-card-modern" data-aos="fade-up" data-aos-delay="600">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonials-4.jpg') }}" alt="Mike & Aljay">
						<div class="author-details">
							<h6>Mike & Aljay</h6>
							<span>United States</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"We were very confused with all the requirements and paperwork and that's when we discovered Filipina Fiancee Visa. They made the whole thing so easy for us, they took care of everything."</p>
					<div class="testimonial-footer">
						<span class="visa-type">Paperwork Simplified</span>
					</div>
				</div>

				<!-- Testimonial 6 -->
				<div class="testimonial-card-modern" data-aos="fade-up" data-aos-delay="700">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonial-8.jpg') }}" alt="Luis & Vanessa">
						<div class="author-details">
							<h6>Luis & Vanessa</h6>
							<span>New York</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"Vanessa passed her interview, and she is now here with me. Thank you so much for all your help. Without your help this process would have been much longer and harder. I would recommend this service to anyone."</p>
					<div class="testimonial-footer">
						<span class="visa-type">Now Together</span>
					</div>
				</div>

				<!-- Testimonial 7 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonial-new1.jpg') }}" alt="Allon & Cathy">
						<div class="author-details">
							<h6>Allon & Cathy</h6>
							<span>Pennsylvania</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"We want to thank you for helping us get through our process. I am now here in America and got married with my loving husband. We are so thankful, and everything was possible because of all your help."</p>
					<div class="testimonial-footer">
						<span class="visa-type">Happily Married</span>
					</div>
				</div>

				<!-- Testimonial 8 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonial-new2.jpg') }}" alt="Steven & Irene">
						<div class="author-details">
							<h6>Steven & Irene</h6>
							<span>Iowa</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"I just wanted to say thanks very much for all the help, work, and support with getting her fiance visa. Everything went as planned and we are very happy together. The fee I paid was one of my best life investments."</p>
					<div class="testimonial-footer">
						<span class="visa-type">K-1 Visa Success</span>
					</div>
				</div>

				<!-- Testimonial 9 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonial-new3.jpg') }}" alt="Jenny & Richard">
						<div class="author-details">
							<h6>Jenny & Richard</h6>
							<span>Mississippi</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"Thank you so much Filipina Fiancee Visa for helping us all throughout the process. You answered all our questions and guide us all the way. We found them to be very friendly which made the whole process much easier."</p>
					<div class="testimonial-footer">
						<span class="visa-type">Green Card Process</span>
					</div>
				</div>

				<!-- Testimonial 10 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonial-new4.jpg') }}" alt="Sarah & Bill">
						<div class="author-details">
							<h6>Sarah & Bill</h6>
							<span>Louisiana</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"We are extremely grateful to Filipina Fiancée Visa for helping us obtain our K-1 Visa. With your full support, we always felt confident you were preparing our petition right the first time. Your service is worth every cent!"</p>
					<div class="testimonial-footer">
						<span class="visa-type">K-1 Visa Approved</span>
					</div>
				</div>

				<!-- Testimonial 11 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonial-new5.jpg') }}" alt="Jim & Gracey">
						<div class="author-details">
							<h6>Jim & Gracey</h6>
							<span>Florida</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"She got her visa! You have been such a great help, we couldn't have done it without you. You have given us such great service and we will definitely use you for her adjustment of status."</p>
					<div class="testimonial-footer">
						<span class="visa-type">Visa Approved</span>
					</div>
				</div>

				<!-- Testimonial 12 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonial-new6.jpg') }}" alt="David & Christine">
						<div class="author-details">
							<h6>David & Christine</h6>
							<span>Texas</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"We wish to express our deepest gratitude for all of the expert guidance you provided. You answered all of my many calls promptly and were always professional and patient. We are happily married now!"</p>
					<div class="testimonial-footer">
						<span class="visa-type">Happily Married</span>
					</div>
				</div>

				<!-- Testimonial 13 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonial-new7.jpg') }}" alt="Andrew & Kathlen">
						<div class="author-details">
							<h6>Andrew & Kathlen</h6>
							<span>Nevada</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"Thank you so much for your help with everything. Your staff is very friendly & answered every silly little question I had quickly & effectively. We had our approval way sooner than I anticipated."</p>
					<div class="testimonial-footer">
						<span class="visa-type">Green Card Service</span>
					</div>
				</div>

				<!-- Testimonial 14 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonials-new8.jpg') }}" alt="Kevin & Vi">
						<div class="author-details">
							<h6>Kevin & Vi</h6>
							<span>California</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"After investigating several services, I discovered Filipina Fiancee Visa and after talking on the phone, I felt good about the service choice. This choice proved to be exceptional. We are now happily married."</p>
					<div class="testimonial-footer">
						<span class="visa-type">Married Success</span>
					</div>
				</div>

				<!-- Testimonial 15 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonials-new9.jpg') }}" alt="Albert & Deborah Ann">
						<div class="author-details">
							<h6>Albert & Deborah Ann</h6>
							<span>Utah</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"We would like to thank Filipina Fiancee Visa for their outstanding support. You provided us with accurate and timely information, and always answered our emails. We are a very happy married couple!"</p>
					<div class="testimonial-footer">
						<span class="visa-type">K-1 Visa Success</span>
					</div>
				</div>

				<!-- Testimonial 16 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testmn.jpg') }}" alt="Derek & Iris Ann">
						<div class="author-details">
							<h6>Derek & Iris Ann</h6>
							<span>Texas</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"Thank you for your outstanding support in helping us work through the long process of getting a K1 Fiancee Visa. You always answered the phone and took time to advise me personally on all my questions."</p>
					<div class="testimonial-footer">
						<span class="visa-type">K-1 Visa Approved</span>
					</div>
				</div>

				<!-- Testimonial 17 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonials-new12.jpg') }}" alt="Timothy & Mica">
						<div class="author-details">
							<h6>Timothy & Mica</h6>
							<span>Kansas</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"Filipina Fiancee Visa was always very helpful and professional. Thanks for all the help preparing Mica for her embassy interview, she breezed right through it. Thank you very much! You guys rock!!!"</p>
					<div class="testimonial-footer">
						<span class="visa-type">Embassy Interview Success</span>
					</div>
				</div>

				<!-- Testimonial 18 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonials-new13.jpg') }}" alt="Andrew & Marjorie">
						<div class="author-details">
							<h6>Andrew & Marjorie</h6>
							<span>Wisconsin</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"Marjorie and I received her visa two weeks ago. Your service was greatly appreciated. It was very simple to do everything. You helped ease all of our worries about the visa process."</p>
					<div class="testimonial-footer">
						<span class="visa-type">Visa Received</span>
					</div>
				</div>

				<!-- Testimonial 19 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonialnew-3.jpg') }}" alt="Bill & Leah">
						<div class="author-details">
							<h6>Bill & Leah</h6>
							<span>Hawaii</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"Thanks for all the excellent service you have provided to me. No words can express my gratitude for your quick and timely responses to all of our many questions. I would highly recommend your services."</p>
					<div class="testimonial-footer">
						<span class="visa-type">Excellent Service</span>
					</div>
				</div>

				<!-- Testimonial 20 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testi-9.jpg') }}" alt="Paul & Angie">
						<div class="author-details">
							<h6>Paul & Angie</h6>
							<span>Illinois</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"My Fiancee had her interview this past Monday. Thanks to all your help it lasted all of 5 minutes because you prepared her so well. We 100% recommend Filipina Fiancee Visa! God Bless!"</p>
					<div class="testimonial-footer">
						<span class="visa-type">Interview Success</span>
					</div>
				</div>

				<!-- Testimonial 21 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonial0.jpg') }}" alt="Alexander & Merlin">
						<div class="author-details">
							<h6>Alexander & Merlin</h6>
							<span>Washington</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"Thank you for your help!!! We considered hiring a lawyer, but Filipina Fiancee Visa handled everything for us and did it perfectly. There was not a question that they could not answer."</p>
					<div class="testimonial-footer">
						<span class="visa-type">Professional Service</span>
					</div>
				</div>

				<!-- Testimonial 22 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testi3.jpg') }}" alt="Kevin & Kim">
						<div class="author-details">
							<h6>Kevin & Kim</h6>
							<span>Oregon</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"If it was not for Filipina Fiancee Visa, I doubt that there would be many happy moments. We got our approval in record time. They answered any and all questions with the right information."</p>
					<div class="testimonial-footer">
						<span class="visa-type">Record Time Approval</span>
					</div>
				</div>

				<!-- Testimonial 23 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonial-22.jpg') }}" alt="Alberto & Emelie">
						<div class="author-details">
							<h6>Alberto & Emelie</h6>
							<span>New Mexico</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"Thank you very much for all your help! You made it all very easy!!! My fiancee is now here and we are happily married. We are now doing her adjustment of status through them."</p>
					<div class="testimonial-footer">
						<span class="visa-type">AOS in Progress</span>
					</div>
				</div>

				<!-- Testimonial 24 -->
				<div class="testimonial-card-modern hidden">
					<div class="testimonial-header">
						<img src="{{ asset('assets/img/testimonial-m.jpg') }}" alt="Steven & Melanie">
						<div class="author-details">
							<h6>Steven & Melanie</h6>
							<span>Arizona</span>
						</div>
						<div class="rating-sm">
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
							<i class="fas fa-star"></i>
						</div>
					</div>
					<p>"Just wanted to say Thank You so much for your service. The K-1 process is overly complicated and no room for mistakes! Thanks so much we are approved just waiting for visa now. God Bless Always!"</p>
					<div class="testimonial-footer">
						<span class="visa-type">Approved & Waiting</span>
					</div>
				</div>
			</div>

			<!-- Load More Button -->
			<div class="text-center mt-5">
				<button class="btn btn-outline-primary btn-lg" id="loadMoreBtn">
					Load More Stories
					<i class="fas fa-chevron-down ms-2"></i>
				</button>
			</div>
		</div>
	</section>

	<!-- CTA Section -->
	<section class="testimonials-cta ptb-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<h3 class="cta-title" data-aos="zoom-in">Ready to Write Your Success Story?</h3>
					<p class="cta-subtitle" data-aos="zoom-in" data-aos-delay="100">
						Join thousands of couples who have successfully navigated the immigration process with our expert help.
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
/* Modern Testimonials Styles */
.testimonials-hero {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.trust-stats {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
    margin-top: 2rem;
}

.stat-badge {
    background: white;
    padding: 1.5rem 2rem;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
    border-top: 3px solid var(--primary-color);
}

.stat-badge strong {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
}

.stat-badge span {
    color: var(--text-light);
    font-weight: 600;
    font-size: 0.9rem;
}

/* Featured Testimonials */
.testimonial-featured {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.quote-icon {
    position: absolute;
    top: -15px;
    left: 30px;
    width: 60px;
    height: 60px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.testimonial-content {
    flex-grow: 1;
    margin-bottom: 2rem;
}

.testimonial-content .testimonial-text {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--text-dark);
    margin: 1.5rem 0;
    font-style: italic;
}

.rating {
    display: flex;
    gap: 0.25rem;
    margin-bottom: 1rem;
}

.rating i {
    color: #ffd700;
    font-size: 1.2rem;
}

.testimonial-author-featured {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding-top: 1.5rem;
    border-top: 2px solid #f8f9fa;
}

.testimonial-author-featured img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid var(--primary-color);
}

.author-info h5 {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.25rem;
}

.author-info span {
    color: var(--text-light);
    font-size: 0.95rem;
    display: block;
    margin-bottom: 0.75rem;
}

.success-badge {
    background: var(--success-gradient);
    color: white;
    padding: 0.4rem 1rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
}

/* Testimonials Grid */
.testimonials-masonry {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.testimonial-card-modern {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border-left: 4px solid var(--primary-color);
}

.testimonial-card-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.testimonial-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.testimonial-header img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #f8f9fa;
}

.author-details h6 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.25rem;
}

.author-details span {
    color: var(--text-light);
    font-size: 0.9rem;
}

.rating-sm {
    margin-left: auto;
    display: flex;
    gap: 0.2rem;
}

.rating-sm i {
    color: #ffd700;
    font-size: 0.9rem;
}

.testimonial-card-modern p {
    color: var(--text-dark);
    line-height: 1.7;
    font-size: 0.95rem;
    font-style: italic;
    margin-bottom: 1.5rem;
}

.testimonial-footer {
    text-align: right;
}

.visa-type {
    background: #f8f9fa;
    color: var(--primary-color);
    padding: 0.4rem 1rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
    border: 1px solid var(--primary-color);
}

/* CTA Section */
.testimonials-cta {
    background: var(--primary-gradient);
    position: relative;
    overflow: hidden;
}

.testimonials-cta::before {
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

/* Load More Functionality */
.testimonial-card-modern.hidden {
    display: none;
}

/* Mobile Responsive */
@media (max-width: 991px) {
    .trust-stats {
        gap: 1rem;
    }
    
    .testimonials-masonry {
        grid-template-columns: 1fr;
    }
    
    .cta-title {
        font-size: 2rem;
    }
}

@media (max-width: 767px) {
    .testimonial-featured {
        padding: 2rem;
    }
    
    .testimonial-author-featured {
        flex-direction: column;
        text-align: center;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .cta-buttons .btn {
        width: 100%;
        max-width: 300px;
    }
    
    .stat-badge {
        padding: 1rem 1.5rem;
    }
    
    .trust-stats {
        flex-direction: column;
        align-items: center;
    }
}

@media (max-width: 576px) {
    .testimonial-card-modern {
        padding: 1.5rem;
    }
    
    .testimonial-header {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
    
    .rating-sm {
        margin-left: 0;
        justify-content: center;
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

// Load More Functionality
document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const testimonialCards = document.querySelectorAll('.testimonial-card-modern');
    let visibleCount = 6; // Initially show 6 testimonials
    let showingAll = false;
    
    // Hide testimonials beyond the initial count
    testimonialCards.forEach((card, index) => {
        if (index >= visibleCount) {
            card.classList.add('hidden');
        }
    });
    
    // Check if there are hidden testimonials
    const hiddenCards = document.querySelectorAll('.testimonial-card-modern.hidden');
    if (hiddenCards.length === 0) {
        loadMoreBtn.style.display = 'none';
    }
    
    loadMoreBtn.addEventListener('click', function() {
        const hiddenCards = document.querySelectorAll('.testimonial-card-modern.hidden');
        
        if (!showingAll) {
            // Show 6 more testimonials at a time
            const showCount = Math.min(6, hiddenCards.length);
            
            for (let i = 0; i < showCount; i++) {
                hiddenCards[i].classList.remove('hidden');
                // Add animation
                hiddenCards[i].style.opacity = '0';
                hiddenCards[i].style.transform = 'translateY(20px)';
                setTimeout(() => {
                    hiddenCards[i].style.transition = 'all 0.5s ease';
                    hiddenCards[i].style.opacity = '1';
                    hiddenCards[i].style.transform = 'translateY(0)';
                }, i * 100);
            }
            
            // Check if there are more hidden cards
            const remainingHidden = document.querySelectorAll('.testimonial-card-modern.hidden');
            if (remainingHidden.length === 0) {
                showingAll = true;
                loadMoreBtn.innerHTML = 'Show Less <i class="fas fa-chevron-up ms-2"></i>';
            }
        } else {
            // Hide all testimonials except the first 6
            testimonialCards.forEach((card, index) => {
                if (index >= 6) {
                    card.classList.add('hidden');
                }
            });
            showingAll = false;
            loadMoreBtn.innerHTML = 'Load More Stories <i class="fas fa-chevron-down ms-2"></i>';
            
            // Smooth scroll to testimonials section
            document.querySelector('.testimonials-grid').scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Testimonial hover effects
document.querySelectorAll('.testimonial-card-modern').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-10px) scale(1.02)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});
</script>
@endsection