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
								<li class="breadcrumb-item active" aria-current="page">Prenuptial Agreement</li>
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
						<img src="{{ asset('assets/img/prenuptial_agreement.jpg') }}">
					</div>						
				</div>	
				<div class="col-md-6 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>Prenuptial Agreement</h2>
					</div>
					<p class="lh-175">More and more couples are signing prenuptial marriage agreements before they marry. These are not just couples dealing with financial inequality, or couples who have a lot of wealth. These are couples who want to put all their financial cards on the table before they walk down the aisle.</p>
					<p class="lh-175">A prenuptial marriage agreement is a signed and notarized contract that spells out how a couple will handle the financial aspects of their marriage. Although not very romantic, having this honest financial discussion prior to a wedding ceremony can be a very positive experience.</p>
				</div>						
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Pros of Prenuptial Agreements:</h2>
					</div>						
					<ul class="list-resourses">									 
						<li>Having a prenuptial marriage agreement does not mean that a couple is anticipating divorce.</li>
						<li>Financial matters need to be faced.</li>
						<li>Prenuptial agreements can preserve family ties and inheritance.</li>
						<li>If your future spouse won't sign a prenuptial marriage agreement, it may be best to discover this before the wedding.</li>
						<li>The financial well-being of children from a previous marriage can be protected.</li>
						<li>Personal and business assets accumulated before your marriage are protected.</li>
						<li>A prenuptial agreement puts financial expectations out on the table before your wedding.</li>
						<li>In the event of a divorce, a prenuptial agreement eliminates battles over assets and finances.</li>
						<li>Protects you if the person wants to marry you to get a green card.</li>
						<li>Protects you if, after your marriage, it turns out they hate your children.</li>
						<li>Protects you if they later decide they hate you.</li>
						<li>Can protect you from a financial disaster.</li>
						<li>This prenuptial marriage agreement can easily be revoked at a later date by the agreement of both parties (say 5 years down the road). Can be thought of as a probation period.</li>
					</ul>
				</div>					
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Things to Remember About Prenuptial Agreements:</h2>
					</div>						
					<ul class="list-resourses">									 
						<li>Discuss the agreement early in your relationship. Don't wait til you're ready to walk down the aisle.</li>
						<li>Be honest. Don't try to hide your thoughts, feelings or assets.</li>
					</ul>
				</div>
			</div>
		</div>
	</section>		
@endsection