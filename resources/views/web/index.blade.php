@extends('web.layout.master')
@section('content')
	<section id="banner" class="banner-home">
		{{getLanguage()}}
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-lg-10 offset-md-1 offset-lg-1">
					<div class="banner-txt text-center">
						<h2 data-aos="fade-up">
							{{ __('message.homeBannerHeading') }}
						</h2>
						<p data-aos="fade-up">
							{{ __('message.homeBannerPeragraph') }}
						</p>
						<a data-aos="fade-up" href="{{ route('register') }}" class="btn btn-tra-grey lh-25">
							{{ __('message.createMyAccount') }}
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--- Banner End--->
	<!--- About Us Start--->
	<section class="about-us test ptb-115">
		<div class="container">
			<div class="row d-flex align-items-center">
				<div class="col-md-6" >
					<div class="about-img-block mt-90" data-aos="fade-left">
						<img src="{{ asset('assets/img/aboutimg1.jpg') }}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="about-content"  data-aos="fade-right">
						<div class="section-title">
							<h4>
								Start Your New Life Together in the United States! Skip the Stress—Let Us Make the Process Easy for You
								<!-- <h4>with a Fiancée/Fiancé Visa!</h4> -->
							</h4>
						</div>
						
					</div>
				</div>
			</div>
			<div class="row">
			<div class="col-sm-12  mt-90">
				<p>Government bureaucracy can surely deny you and your fiancée the happiness you deserve. You
				must apply for a fiancee visa if you are a citizen of the United States and want to marry your
				foreign fiancee in the United States. Obtaining a fiancee visa is never easy because there is so
				much bureaucracy involved.</p>
				<p>The United States government is very eager to screen all the people seeking admission into the
				United States. This is for the purpose of weeding out people with ill motives like criminals,
				terrorists, and the like. However, in the process of weeding out unwanted people, genuine
				applicants, and couples that are in love and want to marry, often find themselves mired in
				bureaucratic procedures.</p>	
			</div>
			</div>
		</div>
	</section>
	<!--- About Us End--->
	<section class="about-us test ptb-115">
		<div class="container">
			<div class="row d-flex align-items-center">
			<div class="col-md-6">
					<div class="about-content"  data-aos="fade-right">
						<div class="section-title">
							<h3>
								Who Are We?
							</h3>
						</div>
						<p>
							We are <strong>Filipina Fiancée Visa,</strong> and we are
							located in Las Vegas, Nevada, USA. We are a
							<strong>Christian company,</strong> and our business is guided
							by Christian principles. Filipina Fiancee Visa was
							created with the goal of assisting United States
							citizens to marry their Filipina sweethearts.
						</p>
					
					</div>
				</div>
				<div class="col-md-4" >
					<div class="about-img-blocks" data-aos="fade-left">
						<img src="{{ asset('assets/img/waw.jpg') }}" style=" float: right;">
					</div>
				</div>
				
			</div>
				</div>
	</section>
<!-- How It Works Section - MOBILE RESPONSIVE -->
<section class="how-it-works bg-lightgrey ptb-100-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 section-title text-center">
                <h3 data-aos="fade-up">
                    {{ __('message.howItWorks') }}
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Responsive video wrapper -->
                <div class="video-wrapper" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%;">
                    <video 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                        preload="yes" 
                        controls 
                        playsinline 
                        autoplay 
                        muted 
                        loop>
                        <source src="/assets/img/ffv.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
</section>
	<!--- How It Works End--->
	<!--- Get Started End--->
	@if (!Auth::check())
		@include('web.component.get-started')
	@endif	
	<!--- Get Started End--->
	<!--- Content Section Start--->
	<section class="ptb-100-60 content-section">
		<div class="container">
			<div class="row d-flex align-items-center">
				<div class="col-md-6">
					<div class="img-block"  data-aos="fade-left">
						<img class="img-fluid" src="{{ asset('assets/img/aboutimg2.png') }}" alt="content-image">
					</div>
				</div>
				<div class="col-md-6">
					<div class="txt-block pc-30"  data-aos="fade-right">
						<div class="cbox-3 mb-10">
							<img class="img-65" src="{{ asset('assets/img/icons/icon-1.png') }}" alt="service-icon" />
							<div class="cbox-3-txt">
								<h5>{{ __('message.uscisPhase') }}</h5>
								<p>{{ __('message.uscisPeragraph') }}</p>
							</div>
						</div>
						<div class="cbox-3 mb-10">
							<img class="img-65" src="{{ asset('assets/img/icons/icon-2.png') }}" alt="service-icon" />
							<div class="cbox-3-txt">
								<h5>{{ __('message.nvcPhase') }}</h5>
								<p>{{ __('message.nvcPeragraph') }}</p>
							</div>
						</div>
						<div class="cbox-3">
							<img class="img-65" src="{{ asset('assets/img/icons/icon-3.png') }}" alt="service-icon" />
							<div class="cbox-3-txt">
								<h5>{{ __('message.embassyPhase') }}</h5>
								<p>{{ __('message.embassyPeragraph') }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--- Content Section End--->
	<!--- Testimonials Start--->
	<section class="ptb-50 testimonials test">
		<div class="testimonials-inner">
			<div class="container">
				<div class="row d-flex align-items-center">
					<div class="col-lg-5">
						<div class="txt-block pc-30" >
							<div class="section-title">
								<span class="subheading primary-color">{{ __('message.testimonials') }}</span>
								<h3>{{ __('message.clientFeedbackHeading') }}</h3>
							</div>
							<a href="{{ route('testimonial') }}" class="btn btn-tra-grey mt-20 lh-25">
								{{ __('message.clientFeedbackLink') }}
							</a>
						</div>
					</div>
					<div class="col-lg-7 reviews-grid">
						<div class="masonry-wrap grid-loaded reviews-3-holder"  data-aos="fade-up">
							<div class="review-2 mt-40" >
								<div class="review-txt">
									<div class="author-data clearfix">
										<div class="testimonial-avatar">
											<img src="{{ asset('assets/img/image-1.png') }}">
										</div>
										<div class="review-author">
											<h5>David</h5>
											<div class="rating">
												{{-- <i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star-half"></i> --}}
											</div>
										</div>
									</div>
									<p>I’m so glad I found your service. Filipina Fiancee Visa was extremely helpful, and I am very grateful to you. You made the whole process painless.</p>
								</div>
							</div>
							<div class="review-2 " >
								<div class="review-txt">
									<div class="author-data clearfix">
										<div class="testimonial-avatar">
											<img src="{{ asset('assets/img/image-2.png') }}">
										</div>
										<div class="review-author">
											<h5>Farah</h5>
											<div class="rating">
												{{-- <i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star-half"></i> --}}
											</div>
										</div>
									</div>
									<p>I received my visa today and I want to thank you for all your help and assistance. I could not have done this without you, and I recommend you to everyone.
									</p>
								</div>
							</div>
							<div class="review-2 ">
								<div class="review-txt">
									<div class="author-data clearfix">
										<div class="testimonial-avatar">
											<img src="{{ asset('assets/img/image-3.png') }}">
										</div>
										<div class="review-author">
											<h5>Lovely</h5>
											<div class="rating">
												{{-- <i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star-half"></i> --}}
											</div>
										</div>
									</div>
									<p>You did a great job for assisting us! Your representative was very knowledgeable and took the time to answer all our questions. We received excellent service!
									</p>
								</div>
							</div>
							<div class="review-2 ">
								<div class="review-txt">
									<div class="author-data clearfix">
										<div class="testimonial-avatar">
											<img src="{{ asset('assets/img/image-4.png') }}">
										</div>
										<div class="review-author">
											<h5>Lester</h5>
											<div class="rating">
												{{-- <i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star-half"></i> --}}
											</div>
										</div>
									</div>
									<p>Thank you so much!!! My fiancee had her interview and was quickly approved because she was very well prepared thanks to you. Any time I had a question, you guys were there with an answer.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--- Testimonials End--->
	<!--- FAQ Start--->
	<section class="ptb-60-100 contactnow_sec">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 section-title text-center">
					<h3>{{ __('message.freeConsultation') }}</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<img class="contactnow_img" src="{{ asset('assets/img/contactnow_img.png') }}" alt=""/>
					<div class="contactnow_no text-center">
						<h5><a href="tel:702-426-4503">702-426-4503</a></h5>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--- FAQ End--->
	<!--- Pricing Start--->
	<section class="ptb-100-60 pricing-packages" >
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 section-title text-center">
					<h3>{{ __('message.ourPackages') }}</h3>
				</div>
			</div>
			<div class="row d-flex align-items-center">
				<div class="col-md-4">
					<div class="pricing-table" >
						<div class="pricing-plan">
							<h5 class="primary-color">Fiancee Visa (K1)</h5>
							<sup>$</sup>
							<span class="price">800</span>
							<!--p class="p-md">+ Gov. Fees</p--><a href="javascript:void(0)" class="p-md" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Gov. Fees</a>
						</div>
						<ul class="features">
							<li><i class="fas fa-stop-circle"></i> Full Support Start To Finish</li>
							<li><i class="fas fa-stop-circle"></i> Unlimited Phone Support</li>
							<li><i class="fas fa-stop-circle"></i> Unlimited Email Support</li>
							<li><i class="fas fa-stop-circle"></i> Prepare All Government Forms</li>
							<li><i class="fas fa-stop-circle"></i> Online Petition Tracking</li>
							<li><i class="fas fa-stop-circle"></i> Children Are Free</li>
						</ul>
						<a href="{{ route('fiancee.visa') }}" class="btn btn-tra-grey">Learn More</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="pricing-table highlight">
						<div class="pricing-plan">
							<h5 class="primary-color">Adjustment of Status</h5>
							<sup>$</sup>
							<span class="price">800</span>
									<a href="javascript:void(0)" class="p-md" data-bs-toggle="modal" data-bs-target="#secModalsec">+ Gov. Fees</a>
						</div>
						<ul class="features">
							<li><i class="fas fa-stop-circle"></i> Full Support Start to Finish</li>
							<li><i class="fas fa-stop-circle"></i> Unlimited Phone Support</li>
							<li><i class="fas fa-stop-circle"></i> Unlimited Email Support</li>
							<li><i class="fas fa-stop-circle"></i> Prepare All Government Forms</li>
							<li><i class="fas fa-stop-circle"></i> Green Card Interview Support</li>
						</ul>
						<a href="{{ route('adjustment.visa') }}" class="btn btn-tra-primary">Learn More</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="pricing-table">
						<div class="pricing-plan">
							<h5 class="primary-color">Spouse Visa (CR1)</h5>
							<sup>$</sup>
							<span class="price">800</span>
						<a href="javascript:void(0)" class="p-md" data-bs-toggle="modal" data-bs-target="#secModal">+ Gov. Fees</a>
						</div>
						<ul class="features">
							<li><i class="fas fa-stop-circle"></i> Full Support Start to Finish</li>
							<li><i class="fas fa-stop-circle"></i> Unlimited Phone Support</li>
							<li><i class="fas fa-stop-circle"></i> Unlimited Email Support</li>
							<li><i class="fas fa-stop-circle"></i> Prepare All Government Forms</li>
							<li><i class="fas fa-stop-circle"></i> Online Petition Tracking</li>
						</ul>
						<a href="{{ route('spouse.visa') }}" class="btn btn-tra-grey">Learn More</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">FIANCEE VISA (K1)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="cbox-3-txt mb-2">
								<h5>Fees for a Fiancee Visa</h5>
								<ul><li><i class="fas fa-stop-circle"></i> $800 Service Fee to Filipina Fiancée Visa (Paid upfront to start your petition)</li></ul>
							</div>
							 <div class="cbox-3-txt mb-2">
								<h5>Government Fees:</h5>
								<ul><li><i class="fas fa-stop-circle"></i> $675 USCIS Filing Fee (Paid when petition is filed)</li>
								<li><i class="fas fa-stop-circle"></i> $495 Medical Examination Fee (Due later in the process)</li>
								<li><i class="fas fa-stop-circle"></i> $265 U.S. Embassy Visa Fee (Due before the interview)</li>
								<li><i class="fas fa-stop-circle"></i> $2,235 Total Fees</li>
								</ul>
							</div>
							<div class="cbox-3-txt mb-2">
								<h5>Extra Fees Per Child to be Included</h5>
								<h5>Government Fees:</h5>
								<ul><li><i class="fas fa-stop-circle"></i> $200 Service Fee to Filipina Fiancée Visa</li>
								<li><i class="fas fa-stop-circle"></i> $240 Child Medical Exam</li>
								<li><i class="fas fa-stop-circle"></i> $265 Embassy Visa Fee</li>
								<li><i class="fas fa-stop-circle"></i> $705 Total Fees Per Child</li>
								</ul>
							</div>
							
      </div>
     
    </div>
  </div>
</div>
<div class="modal fade" id="secModalsec" tabindex="-1" aria-labelledby="secModalLabelSec" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adjustment of Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="cbox-3-txt mb-2">
								<h5>Fees for an Adjustment of Status</h5>
								<ul><li><i class="fas fa-stop-circle"></i> $800 – Filipina Fiancée Visa Service Fee (Paid upfront)</li></ul>
							</div>
							 <div class="cbox-3-txt mb-2">
								<h5>Government Fees:</h5>
								<ul><li><i class="fas fa-stop-circle"></i>$1,440 – U.S. Government Filing Fee (Paid at the time of filing)</li>
								<li><i class="fas fa-stop-circle"></i>  Total Cost: $2,240</li>
								
								</ul>
							</div>
							<div class="cbox-3-txt mb-2">
								<h5>Fees for Children Filing with Parent</h5>
								
								<ul><li><i class="fas fa-stop-circle"></i> $300 – Filipina Fiancée Visa Service Fee (Paid upfront)</li>
								<li><i class="fas fa-stop-circle"></i> Government fees vary based on age and circumstances (Paid at the time of filing)</li>
							
								</ul>
							</div>
							<!-- <div class="cbox-3-txt mb-2">	<h5>Government Fees:</h5>
								<ul><li><i class="fas fa-stop-circle"></i>$1,225 Filing fee for Children 14 or over (Due at time of filing)</li>
								<li><i class="fas fa-stop-circle"></i>$1,425 Total of All Fees</li>
								<li><i class="fas fa-stop-circle"></i>$750 Filing fee for Children under 14 years of age filing with the application of at least one parent</li>
								
								</ul>
							</div> -->
	                   <!-- <div class="cbox-3-txt mb-2">
								<h5>Fees for Children NOT Filing with Parent</h5>
								
								<ul><li><i class="fas fa-stop-circle"></i>$700 Fee to Filipina Fiancée Visa</li>
							
								</ul>
							</div> -->
							<!-- <div class="cbox-3-txt mb-2">
								<h5>Government Fees:</h5>
								<ul><li><i class="fas fa-stop-circle"></i>$1,140 Filing fee for Children under 14 years of age not filing with at least one parent</li>
								<li><i class="fas fa-stop-circle"></i>$1,840 Total of All Fees</li>
								
								</ul>	</div> -->
							</div>
							
      </div>
     
    </div>
  </div>
<div class="modal fade" id="secModal" tabindex="-1" aria-labelledby="secModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Spouse Visa (CR1)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="cbox-3-txt mb-2">
								<h5>Fees for a Spouse Visa</h5>
								<ul><li><i class="fas fa-stop-circle"></i> $800 Total Fee to Filipina Fiancée Visa (Paid to get Started)</li></ul>
							</div>
							 <div class="cbox-3-txt mb-2">
								<h5>Government Fees:</h5>
								<ul><li><i class="fas fa-stop-circle"></i> $675 Filing Fee to United States Government (Due at Filing) (Can be paid by Credit Card)</li>
								<li><i class="fas fa-stop-circle"></i> $445 National Visa Center Fees (Due Much Later)</li>
								<li><i class="fas fa-stop-circle"></i> $495 Adult Medical Exam Fee (Due Much Later)</li>
								<li><i class="fas fa-stop-circle"></i> $220 Immigrant Fee to US Immigration Service for Green Card (Due After the Embassy Interview)</li>
								<li><i class="fas fa-stop-circle"></i> $2,635 Total All Fees</li>
								</ul>
							</div>
							<div class="cbox-3-txt mb-2">
								<h5>Fees for Children (Per Child)</h5>
								
								<ul><li><i class="fas fa-stop-circle"></i> $300 Fee to Filipina Fiancée Visa (Per Child) (Paid to get Started)</li>
							
								</ul>
							</div>
							<div class="cbox-3-txt mb-2">
								<h5>Government Fees:</h5>
								<ul><li><i class="fas fa-stop-circle"></i>$675 Filing Fee to United States Government (Due at Filing) (Can be paid by Credit Card)</li>
								<li><i class="fas fa-stop-circle"></i>$445 National Visa Center Fees (Due Much Later)</li>
								<li><i class="fas fa-stop-circle"></i>$240 Child Medical Exam fee (14 years and younger) (Due Much Later)</li>
								<li><i class="fas fa-stop-circle"></i>$220 Immigrant Fee to US Immigration Service for Green Card (Due After the Embassy Interview)</li>
								<li><i class="fas fa-stop-circle"></i> $1,880 Total All Fees</li>
								</ul>
								<p>Children must have been under 18 years of age as of the date you were married to qualify.</p>
							</div></div>
							
      </div>
     
    </div>
  </div>
</div>
@endsection