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
								<li class="breadcrumb-item active" aria-current="page">How to get a US Tourist Visa from the Philippines</li>
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
						<img src="{{ asset('assets/img/tourist_visa.jpg') }}">
					</div>						
				</div>	
				<div class="col-md-6 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>How to get a US Tourist Visa from the Philippines</h2>
					</div>
					<p class="lh-175">To enter the United States solely for recreation purposes, a visitor initially needs to secure a US tourist visa. Coming to the US on a tourist visa with the sole intention of getting married in the US and then filing for adjustment of status could be deemed to be visa fraud. Proving that you entered the US with no preconceived intent to marry and file for adjustment of status can be difficult, but it's definitely not impossible.</p>
				</div>						
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Visa validity</h2>
					</div>						
					<p class="lh-175">This visa is valid for six (6) months. Yet, it is consular officers that determine its validity period. Depending on the applicant’s personal circumstances, authorities may grant a visa that is valid for as short as one (1) month.</p>
				</div>							
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>US tourist visa requirements</h2>
					</div>						
					<p class="lh-175">There are only two (2) important major requirements that a potential visitor needs to satisfy and understand. These are:</p>
					<ul class="list-resourses">									 
						<li>Evidence of strong ties and</li>
						<li>Evidence of sufficient income</li>
					</ul>
					<p class="lh-175">Under the US immigration laws, every foreign visitor is presumed to be an intending immigrant. This means that every applicant, despite their genuine intentions, is perceived to be a potential illegal immigrant. Thus, in order to overcome the burden of proof, the applicant must present his strong ties in the Philippines. Strong ties are powerful and irrefutable reasons that would force an applicant to return to his home country. Strong ties can be the applicants:</p>
					<ul class="list-resourses">									 
						<li>Employment</li>
						<li>Dependent family members</li>
						<li>Properties</li>
						<li>Income-generating businesses</li>
						<li>Membership in organizations etc.</li>
					</ul>
					<p class="lh-175">Another major requirement that consular officers examine is the applicant's personal financial capabilities. Authorities will consider the individual's resources to support his stay in the United States. An individual cannot depend on the USA public funds or the people they will visit in the USA to sustain their daily expenses. The applicant must have substantial income to show they can afford to really be a tourist to the US. A typical poor or even a well above average Filipino citizen has no chance of meeting this requirement. Due to this, when assessing one financial capacity, consider the following aspects:</p>
					<ul class="list-resourses">									 
						<li>Travel expenses</li>
						<li>Accommodation expenses</li>
						<li>Emergency-related expenses</li>
					</ul>
				</div>							
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>The interview</h2>
					</div>						
					<p class="lh-175">Preparing for an interview is a must for every applicant. This provides them the chance to state their travel intention. However, the applicant must ensure that his answers are supported by documentary evidence. For example, if he states that he owns 3 hectares of farmland, the land title must be present. An answer that cannot be supported by the necessary documents invites a denial.</p>
					<p class="lh-175">Indeed, a US tourist visa application is not as easy as many often think. As a matter of fact, it is the hardest US visa to attain. Even if you meet all the requirements, it doesn't mean that your visa will be granted. </p>
				</div>	
			</div>
		</div>
	</section>		
@endsection