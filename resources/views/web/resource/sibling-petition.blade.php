@extends('web.layout.master')
@section('content')
	<section class="breadcrumb-main">
        <div class="container">
			<div class="row">
				<div id="breadcrumb">
				<div class="breadcrumb-txt">
				<h3>Resource Detail</h3>
				</div>
				<div class="row">
					<div class="col">
						<div class="breadcrumb-nav">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
								<li class="breadcrumb-item"><a href="{{ route('resource') }}">Resources</a></li>
								<li class="breadcrumb-item active" aria-current="page">Sibling Petitions</li>
							</ol>
						</nav>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</section>
	<section class="resource-detail bg-lightgrey ptb-100 heading_hidden">
		<div class="container">
			<div class="row">
			  	<div class="col-md-6 mb-5 about-us align-self-center">
					<div class="about-img-block ">
						<img src="{{ asset('assets/img/sibling-petitions.png') }}" width="100%">
					</div>						
				</div>	
				<div class="col-md-6 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>Sibling Petitions</h2>
					</div>
					<p class="lh-175"><b class="fw-bold">U.S. citizens with foreign-born brothers or sisters may obtain green cards for them and their spouses and children, but only after a long wait.</b></p>
					<p class="lh-175">If you are a U.S. citizen with siblings who are natives of a foreign country, you have the right to obtain a green card (U.S. lawful permanent residence) for them, along with their spouses and unmarried children under the age of 21. You must be 21 years of age or older yourself. You must also be willing to help guarantee that your sibling and their family will be financially supported in the U.S. and will not require any need-based government assistance.</p>
					<p class="lh-175">But there's a major catch: Because of limits on the number of visas given out in this category every year, there's an extremely long waiting list, as described below.</p>
					<p class="lh-175">If you are not a U.S. citizen, but a permanent resident of the United States (with a green card), you cannot bring a sibling here legally. If you're interested in petitioning your sibling this way, you should apply for U.S. citizenship as soon as you're eligible.</p>
				</div>						
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>How Long Will This Process Take?</h2>
					</div>						
					<p class="lh-175">The sibling of a U.S. citizen is at the bottom of the family preference list.  As soon as we start the immigration process, your sibling will be placed on the waiting list for a visa.</p>					
					<p class="lh-175">Because so many people have already applied under this category in past years, the wait is very, very long, typically at least ten years for siblings from most countries. Also, because per-country limits apply as well, applicants from certain countries, namely Mexico, India, and the <b class="fw-bold">Philippines</b>, typically wait even longer, <b class="fw-bold">sometimes up to 25 years</b>.</p>
				</div>					
				<div class="col-md-12">
					<div class="heading mb-3">
						<h2>General Rules Regarding Financial Support of Your Sibling</h2>
					</div>						
					<p class="lh-175">If you meet the requirements and wish to bring your sibling to the United States, you will (near the end of the application process) need to show that your household income exceeds 125% of the poverty level in the U.S., meaning that you can financially support your own family as well as your sibling's family. Application Process for Getting a Green Card as the Sibling of a U.S. Citizen</p>
					<p class="lh-175">To start the process, we'll need to file a visa petition, together with a fee, proof of your U.S. citizenship, and proof that the two of you are siblings. That last requirement generally involves making copies of both your birth certificate and that of your sibling, showing at least one parent in common. If you or your sibling has made a name change, you will also need a document that proves it, such as a marriage certificate.</p>
					<p class="lh-175">After US immigration has approved the visa petition, your sibling will receive a "priority date," based on the day US immigration first received your petition. Then the long wait begins. Advise your brother or sister to warn their children that, if they want to come along on this visa, they must not get married before entering the United States. (Turning 21 can also make them ineligible, but they have no control over that.)</p>
					<p class="lh-175">If all goes well, he or she and family will be issued immigrant visas to the United States. Upon entering the U.S., they will become permanent residents, and receive their actual green cards a few weeks later.</p>
					<p class="lh-175"><b class="fw-bold">If after reading this, you are still interested in petitioning your sibling or siblings, call or email us to discuss this further. We can assist you with this entire process to make sure your waiting time is kept to the very minimum.</b></p>
				</div>
			</div>
		</div>
	</section>	
@endsection