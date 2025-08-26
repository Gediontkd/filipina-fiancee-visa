@extends('web.layout.master')
@section('content')
	@include('web.component.bread-crumb', [
		'title' => 'Services',
	])
	<section class="services ptb-60 bg-lightgrey">
	  	<div class="container">
	        <div class="row">
				<div class="col-lg-10 offset-lg-1 section-title text-center">
					<h3>Our Services</h3>
				</div>
			</div>
		    <div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12 service-main">
					<div class="service-block">
						<div class="inner-box">
							<figure class="image-box"><a href="{{ route('fiancee.visa') }}"><img src="{{ asset('assets/img/service1.jpg') }}" alt=""></a></figure>
							<div class="lower-content">
								<div class="box">
									<div class="icon-box">
										<img src="{{ asset('assets/img/icons/service-icon-1.png') }}">
									</div>
									<h3>
										<a href="{{ route('fiancee.visa') }}">FIANCEE VISA (K1)</a>
									</h3>
									<p>A fiancé visa / fiancée visa, called a K-1 visa, is a nonimmigrant visa which allows foreigners who are engaged to United States citizens to travel to America to get married.</p>
								</div>
								<div class="link"><a href="{{ route('fiancee.visa') }}">Read More<i class="fa fa-long-arrow-alt-right ms-2"></i></a></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 service-main">
					<div class="service-block">
						<div class="inner-box">
							<figure class="image-box"><a href="{{ route('adjustment.visa') }}"><img src="{{ asset('assets/img/service2.jpg') }}" alt=""></a></figure>
							<div class="lower-content">
								<div class="box">
									<div class="icon-box">
										<img src="{{ asset('assets/img/icons/service-icon-2.png') }}">
									</div>
									<h3>
										<a href="{{ route('adjustment.visa') }}">ADJUSTMENT OF STATUS</a>
									</h3>
									<p>After your fiancée enters the United States, and you get married, you have 90 days to file their Adjustment of Status or their immigration status will change to unlawful.</p>
								</div>
								<div class="link"><a href="{{ route('adjustment.visa') }}">Read More<i class="fa fa-long-arrow-alt-right ms-2"></i></a></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 service-main">
					<div class="service-block">
						<div class="inner-box">
							<figure class="image-box"><a href="{{ route('adjustment.visa') }}"><img src="{{ asset('assets/img/service2.jpg') }}" alt=""></a></figure>
							<div class="lower-content">
								<div class="box">
									<div class="icon-box">
										<img src="{{ asset('assets/img/icons/service-icon-2.png') }}">
									</div>
									<h3>
										<a href="{{ route('adjustment.visa') }}">Special Combined CR1 + AOS Package</a>
									</h3>
									<p>After your fiancée enters the United States, and you get married, you have 90 days to file their Adjustment of Status or their immigration status will change to unlawful.</p>
								</div>
								<div class="link"><a href="{{ route('adjustment.visa') }}">Read More<i class="fa fa-long-arrow-alt-right ms-2"></i></a></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 service-main">
					<div class="service-block">
						<div class="inner-box">
							<figure class="image-box"><a href="{{ route('adjustment.visa') }}"><img src="{{ asset('assets/img/service2.jpg') }}" alt=""></a></figure>
							<div class="lower-content">
								<div class="box">
									<div class="icon-box">
										<img src="{{ asset('assets/img/icons/marry-usa-onboard.png') }}">
									</div>
									<h3>
										<a href="{{ route('adjustment.visa') }}">Marry-on-tourist-visa</a>
									</h3>
									<p>After your fiancée enters the United States, and you get married, you have 90 days to file their Adjustment of Status or their immigration status will change to unlawful.</p>
								</div>
								<div class="link"><a href="{{ route('adjustment.visa') }}">Read More<i class="fa fa-long-arrow-alt-right ms-2"></i></a></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 service-main">
					<div class="service-block">
						<div class="inner-box">
							<figure class="image-box"><a href="{{ route('spouse.visa') }}"><img src="{{ asset('assets/img/service3.jpg') }}" alt=""></a></figure>
							<div class="lower-content">
								<div class="box">
									<div class="icon-box">
										<img src="{{ asset('assets/img/icons/service-icon-3.png') }}">
									</div>
									<h3><a href="{{ route('spouse.visa') }}">SPOUSE VISA (CR1)</a></h3>
									<p>A CR1 visa, also called IR1 spousal visa, is an immigrant visa issued to an alien who is married to a U.S. citizen or permanent resident and wishes to live in the U.S. with their spouse.</p>
								</div>
								<div class="link"><a href="{{ route('spouse.visa') }}">Read More<i class="fa fa-long-arrow-alt-right ms-2"></i></a></div>
							</div>
						</div>
					</div>
				</div>		
			</div>  
		</div>
	</section>
@endsection