@extends('web.layout.master')
@section('content')
	@include('web.component.bread-crumb', [
		'title' => 'About Us',
	])
	<section class="about-us ptb-115 bg-lightgrey">
		<div class="container">
			<div class="row d-flex align-items-center">
				<div class="col-md-6">
					<div class="about-img-block aos-init aos-animate" data-aos="fade-left">
						<img src="{{ asset('assets/img/about-p.jpg') }}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="about-content aos-init aos-animate" data-aos="fade-right">
						<div class="section-title">
							<!-- <span class="subheading primary-color">About Us</span> -->
							<h3>About Filipina Fiancee Visa</h3>
						</div>
						<p>We are Filipina Fiancée Visa, and we are located in Las Vegas, Nevada, USA. We are a Christian company,
and our business is guided by Christian principles. Filipina Fiancée Visa was started back in 2007 and
specializes in assisting U.S. Citizens with bringing their Filipina fiancées and spouses to the United States.
Filipina Fiancée Visa has helped thousands of couples through their immigration journeys. 
</p>
						
				
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection