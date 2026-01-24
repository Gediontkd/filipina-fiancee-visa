@extends('web.layout.master')
@section('content')
	@include('web.component.bread-crumb', [
		'title' => 'What documents are required to get a Spouse Visa?',
		'previousPageLink' => route('service'),
		'previousPageTitle' => 'Services',
	])
	<section class="resource-detail bg-lightgrey ptb-80 heading_hidden">
		<div class="container">
			<div class="row">
			  	<div class="col-md-6 mb-3 about-us aboutus2 align-self-center">
					<div class="about-img-block ">
						<img src="http://dev.filipinafianceevisa.com/assets/img/document2.jpg" style="height: auto;">
					</div>						
				</div>	
				<div class="col-md-6 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>To get your petition filed, we will need the following items:</h2>
					</div>
					<ul class="list-resourses">									 
						<li>The affidavit in lieu of a certificate of legal capacity to marry;</li>
						<li>Divorce decree(s) or death certificate(s) required to verify civil status and capacity to marry;</li>
						<li>U.S. passport;</li>
						<li>Documentation regarding paternal consent or advice, if applicable.</li>
					</ul>
				</div>						
				
				
				
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Later (Months from now) you need the following items:</h2>
					</div>
					<ul class="list-resourses">									 
						<li> The last U.S. Federal Tax Return that you filed</li>
						<li> Beneficiary's Birth Certificate.</li>
						<li>Beneficiary's NBI clearance certificate</li>
					</ul>
					</div>
			</div>
		</div>
	</section>
@endsection