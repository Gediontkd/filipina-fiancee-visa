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
								<li class="breadcrumb-item active" aria-current="page">The U.S. Domicile Requirement for Petitioners Living Outside the U.S.</li>
							</ol>
						</nav>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</section>
	<!--- Breadcrumb End--->
	<!--- Resources Start--->
	<section class="resource-detail bg-lightgrey ptb-100 heading_hidden">
		<div class="container">
			<div class="row">
			  	<div class="col-md-6 mb-5 about-us resource_hidden_img align-self-center">
					<div class="about-img-block ">
						<img src="{{ asset('assets/img/visa-filipinas.jpg') }}">
					</div>						
				</div>	
				<div class="col-md-6 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>The U.S. Domicile Requirement for Petitioners Living Outside the U.S.</h2>
					</div>
					<p class="lh-175">A petitioner living outside the United States and who has not maintained any ties with the United States, and who wishes to qualify as a sponsor, must demonstrate that:</p>
					<ul class="list-resourses">
						<li>He or she has taken steps to establish a domicile in the United States;</li>
						<li>He or she has either already taken up physical residence in the United States or will do so currently with the applicant;</li>
						<li>The sponsor does not have to precede the applicant to the United States but, if he or she does not do so, he or she must at least arrive in the United States concurrently with the applicant;</li>
						<li>The sponsor must establish an address (a house, an apartment, or arrangements for accommodations with family or friend) and either must have already taken up physical residence in the United States; or</li>
						<li>Must at a minimum state that he or she intends to take up residence in the United States no later than the time of the applicant’s immigration to the United States.</li>
					</ul>
				</div>						
				<div class="col-md-12 mb-3">
					<p class="lh-175">Although there is no time frame for the petitioner to establish residence, the sponsor/petitioner must, in fact, have taken up principal residence in the United States.  Evidence that the sponsor has established a domicile in the United States and is either physically residing there or intends to do so before or concurrently with the applicant may include the following:</p>
					<ul class="list-resourses">
						<li>Opening a bank account;</li>
						<li>Transferring funds to the United States;</li>
						<li>Making investments in the United States;</li>
						<li>Seeking employment in the United States;</li>
						<li>Registering children in U.S. schools;</li>
						<li>Applying for a Social Security number; and</li>
						<li>Voting in local, State, or Federal elections.</li>
					</ul>
				</div>	
			</div>
		</div>
	</section>		
@endsection