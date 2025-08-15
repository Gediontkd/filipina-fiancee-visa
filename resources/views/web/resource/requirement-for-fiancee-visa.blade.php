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
								<li class="breadcrumb-item active" aria-current="page">Requirements for a K-1 Fiancee Visa</li>
							</ol>
						</nav>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</section>
	<section class="resource-detail bg-lightgrey ptb-80 heading_hidden">
		<div class="container">
			<div class="row">
			  	<div class="col-md-6 mb-5 about-us">
					<div class="about-img-block ">
						<img src="{{ asset('assets/img/wedding2.jpg') }}">
					</div>
				</div>	
				<div class="col-md-6 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>Requirements for a Fiancee Visa (K-1) | K1 Fiance Visa</h2>
					</div>
					{{-- <h5 class="lh-175 mb-2">Welcome to Filipina Fiancee Visa! Are you looking to bring your fiancée to the United States?</h5> --}}
					{{-- <h5 class="lh-175 mb-2">Let us help you obtain a K1 fiancée visa.</h5> --}}
				</div>
			  	<div class="col-md-12 mb-3">
					<p class="lh-175">The fiancé(e) K-1 visa is for the foreign fiancé(e) of a United States citizen. <b class="fw-bold">The K-1 visa permits the foreign fiancé(e) to travel to the United States and marry his or her U.S. citizen sponsor within 90 days of arrival</b>.</p>
				</div>						
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>K-1 Visa Requirements.</h2>
					</div>
					<ul class="list-resourses">									 
						<li>You must be a USA citizen. Lawful permanent resident "green card" holders of the United States are not allowed to obtain <b class="fw-bold">K1 fiancee visas</b>.</li>
						<li>You must be able to prove that you are ready, willing and legally able to marry. This means that if either of you has been married previously, you are either divorced, widowed or the marriage was annulled. You must provide a copy of ALL divorces, ALL annulments, or death certificates of former spouses, that either on you has EVER had.</li>
						<li>The couple must prove that they have physically met in person at least once within the last 2 years and you must demonstrate the existence of a serious relationship between you. This doesn’t mean they need to know each other for 2 years, just that within the last 2 years, they have met. Skype doesn’t count. The proof of the meeting should consist of photos together, and passport stamps.</li>
						<li>The petitioner and foreign fiancee must have the intent to marry within 90 days of the foreign fiancee’s arrival in the U.S.</li>
						<li>The petitioner must also meet certain income requirements, which are normally 100 percent of the current poverty level.</li>
						<li>The Foreign Fiancee must also meet certain standards, such as no previous immigration law violations, and lack of a criminal record. Many arrests and/or convictions are exempt from this requirement.</li>
						<li>The American Citizen must also meet certain standards, such as no previous immigration law violations, and lack of a criminal record. Many arrests and/or convictions are exempt from this requirement.</li>
						<li>The Foreign Fiancee must pass a medical exam at a clinic approved by the U.S. Consulate that is processing the fiancee visa application. The fiancee must not have any type of communicable disease or serious mental illness.</li>
						<li>If your Filipino Citizen fiancee is between 18-21 the embassy requires they get notarized written parental consent from at least 1 parent and if your fiancee is between 22-25 the embassy requires they get notarized written evidence of parental advice from at least 1 parent. </li>
						<li>Your Foreign Fiancee must possess an international passport at the time of her interview at the U.S. Consulate. However, this is not needed to file the petition.</li>
					</ul>
					<p class="lh-175">Once your fiancee receives the K1 fiancee visa, he or she has a maximum of five (5) months, sometimes less, to use it to enter the U.S. When your fiancee enters the U.S. on the K1 fiancee visa he or she has 90 days to either marry you or depart the U.S. There are no extensions of the 90 day requirement. If your fiancee does not marry you and does not depart the U.S. within 90 days of arrival, he or she will be subject to deportation.</p>
					{{-- <p class="lh-175">Should you hire a lawyer to file your fiancee visa? There is absolutely <b class="fw-bold">NO REASON</b> to ever hire a lawyer to file your fiancee visa petition. Lawyers like to pretend that they are the only ones that should file a petition for you, they try to scare you into using them, and they overcharge you greatly.</p> --}}
				</div>
			</div>
		</div>
	</section>		
@endsection