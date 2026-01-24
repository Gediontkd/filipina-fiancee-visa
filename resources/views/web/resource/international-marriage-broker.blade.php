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
								<li class="breadcrumb-item active" aria-current="page">The International Marriage Broker Regulation Act (IMBRA)</li>
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
			  	<div class="col-md-6 mb-5 about-us resource_hidden_img align-self-center">
					<div class="about-img-block ">
						<img src="{{ asset('assets/img/Legal_Books.jpg') }}">
					</div>						
				</div>	
				<div class="col-md-6 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>The International Marriage Broker Regulation Act (IMBRA)</h2>
					</div>
					<p class="lh-175">In order to be compliant with this US law and to ensure there are no problems with ladies who meet US clients and wish to apply for fiancee or spouse visa. It's important that as a US citizen you comply with the IMBRA requirements. The US embassies are now asking for this information when the ladies are applying for a US visa. Failure to demonstrate the lady have been fully informed of any relevant criminal background may lead to refusal of a visa..</p>
					<p class="lh-175 font_20"><b class="fw-bold">IMBRA limits the number of K1 fiancee visa petitions a sponsor can file or have approved without seeking a waiver of the limits.</b></p>
					<p class="lh-175">If you met your fiancee or spouse through the services of an international marriage broker, you must notify USCIS of that fact by answering Question 19 on form I-129F  Petition for Alien Fiancee. The term “international marriage broker” means a corporation, partnership, business, individual, or other legal entity, whether or not organized under any law of the United States, that charges fees for providing dating, matrimonial, matchmaking services, or social referrals between United States citizens or nationals or aliens lawfully admitted to the United States as lawful permanent residents and foreign national clients by providing personal contact information or otherwise facilitating communication between individuals.</p>
				</div>						
				<div class="col-md-12 mb-3">
					<p class="lh-175">IMBRA requires that a man discloses all his past criminal history, visa petition history, past marital and divorce history, ages of children under age 18 to the lady BEFORE he can get her contact information or otherwise communicate with her. The international marriage broker must collect this information, then check the National Sex Offender public registry and state public registry for each man, provide all this information to the lady, and secure a signed and written consent from the lady to release her contact information to that particular man.</p>
					<p class="lh-175">IMBRA makes it a felony for an internet dating company, that primarily focuses on introducing Americans to foreigners, to allow any American to communicate with any person of foreign nationality without first subjecting that American to a criminal background check, a sex offender check and without first having the American certify any previous convictions or arrests, any previous marriages or divorces any children and all states of residence since 18.</p>
				</div>					
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>The term "international marriage broker" does not include:</h2>
					</div>						
					<p class="lh-175">Traditional matchmaking organizations of a cultural or religious nature that operate on a non-profit basis and in compliance with the laws of the countries in which it operates, including the laws of the United States; or</p>
					<p class="lh-175">Entities that provide dating services if their principal business is not to provide international dating services between United States citizens or United States residents and foreign nationals and charge comparable rates and offers comparable services to all individuals it serves regardless of the individual's gender or country of citizenship.</p>
					<p class="lh-175">The fact that you may have criminal convictions or if you have previously filed a K-1 fiancee petition for a fiancee will not necessarily prevent you from obtaining a K-1 fiancee visa for your fiancee. Although, it certainly will decrease your chances.</p>
				</div>				
				<div class="col-md-12 mb-3">
					<p class="resource_act_btn"><a href="http://www.govtrack.us/congress/billtext.xpd?bill=h109-3657">Full Text: International Marriage Broker Regulation Act of 2005</a></p>
					<p class="resource_act_btn"><a href="http://www.govtrack.us/congress/billtext.xpd?bill=h109-4472">Full Text: Adam Walsh Child Protection and Safety Act of 2006 -SEX OFFENDER REGISTRATION AND NOTIFICATION ACT</a></p>
				</div>
			</div>
		</div>
	</section>		
@endsection