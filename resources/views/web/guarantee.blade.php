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
	<section class="resource-detail  guarantee_div bg-lightgrey ptb-100 heading_hidden">
		<div class="container">
			<div class="row">
			  	<div class="col-md-4 my-3 align-self-center">
					<div class="guarantee_img">
						<img src="{{ asset('assets/img/guarantee2.png') }}">
					</div>						
				</div>	
				<div class="col-md-8 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>Guaranteed Approval Or Your Money Back</h2>
					</div>
					<p class="lh-175">If your petition is denied by the U.S. Citizenship and Immigration Services (USCIS) Filipina Fiancee Visa will refund 100% of the fees paid to Filipina Fiancee Visa for the petition that was denied. The following conditions apply:</p>
					<ul class="list-resourses">									 
						<li>Refund requests must be submitted within <b class="fw-bold">30 days of the denial</b> and must include a copy of the denial letter from the USCIS that indicates the reason for denial.</li>
						<li>Denial must not be because you failed to respond to an RFE or inquiry from the USCIS by the deadline they gave you or you did not send them what they asked you for.</li>
						<li>All refunds are issued by credit card only and to the original purchaser. Refunds will be processed within 14 days and may take an additional 7 days to credit to your card.</li>
						<li>Fees paid to the government or any third party are not refundable.</li>
						<li>Our Money Back Guarantee does NOT apply to any circumstances where the U.S. Citizen
(Sponsor/Petitioner) and Alien (Beneficiary) BREAK UP, have a CHANGE OF HEART, or DECIDE NOT TO
PROCEED, or anything relating to an elective termination of our services after purchasing our services.</li>
					</ul>
				</div>			
			</div>
		</div>
	</section>		
@endsection