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
	<section class="services ptb-60 bg-lightgrey">
	  	<div class="container">
	        <div class="row">
				<div class="col-lg-10 offset-lg-1 section-title text-center">
					<h3>Our Services</h3>
					<!-- <p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis -->
						<!-- libero at tempus, blandit posuere ligula varius congue cursus porta feugiat -->
					<!-- </p> -->
				</div>
			</div>
		    <div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12 service-main">
					<div class="service-block">
						<div class="inner-box">
							<figure class="image-box"><a href="fiancee-visa.html"><img src="{{ asset('assets/img/service1.jpg') }}" alt=""></a></figure>
							<div class="lower-content">
								<div class="box">
									<div class="icon-box"><img src="{{ asset('assets/img/icons/service-icon-1.png') }}"></div>
									<h3><a href="fiancee-visa.html">FIANCEE VISA (K1)</a></h3>
									<p>A fiancé visa / fiancée visa, called a K-1 visa, is a nonimmigrant visa which allows foreigners who are engaged to United States citizens to travel to America to get married.</p>
								</div>
								<div class="link"><a href="fiancee-visa.html">Read More<i class="fa fa-long-arrow-alt-right ms-2"></i></a></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 service-main">
					<div class="service-block">
						<div class="inner-box">
							<figure class="image-box"><a href="aos.html"><img src="{{ asset('assets/img/service2.jpg') }}" alt=""></a></figure>
							<div class="lower-content">
								<div class="box">
									<div class="icon-box"><img src="{{ asset('assets/img/icons/service-icon-2.png') }}"></div>
									<h3><a href="aos.html">ADJUSTMENT OF STATUS</a></h3>
									<p>After your fiancée enters the United States, and you get married, you have 90 days to file their Adjustment of Status or their immigration status will change to unlawful.</p>
								</div>
								<div class="link"><a href="aos.html">Read More<i class="fa fa-long-arrow-alt-right ms-2"></i></a></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 service-main">
					<div class="service-block">
						<div class="inner-box">
							<figure class="image-box"><a href="spouse-visa.html"><img src="{{ asset('assets/img/service3.jpg') }}" alt=""></a></figure>
							<div class="lower-content">
								<div class="box">
									<div class="icon-box"><img src="{{ asset('assets/img/icons/service-icon-3.png') }}"></div>
									<h3><a href="spouse-visa.html">SPOUSE VISA (CR1)</a></h3>
									<p>A CR1 visa, also called IR1 spousal visa, is an immigrant visa issued to an alien who is married to a U.S. citizen or permanent resident and wishes to live in the U.S. with their spouse.</p>
								</div>
								<div class="link"><a href="spouse-visa.html">Read More<i class="fa fa-long-arrow-alt-right ms-2"></i></a></div>
							</div>
						</div>
					</div>
				</div>		
			</div>  
		</div>
	</section>
@endsection