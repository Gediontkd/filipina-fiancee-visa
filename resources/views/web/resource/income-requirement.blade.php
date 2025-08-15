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
								<li class="breadcrumb-item active" aria-current="page">Income Requirements</li>
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
			  	<div class="col-md-6 mb-5 about-us align-self-center">
					<div class="about-img-block ">
						<img src="{{ asset('assets/img/income-requirement.jpg') }}">
					</div>
				</div>						
				<div class="col-md-6 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>Minimum Income Requirements</h2>
					</div>
					<p class="lh-175">Only the U.S. Sponsor's income is considered when determining if you meet the income requirement.</p>
					<p class="lh-175">The Fiancee Visa and the Spouse Visa do not have the same income requirements. Applicants for a a Fiancee Visa will need to show that their U.S. Sponsor's income is 100 percent of the federal poverty guidelines. Applicants for a a Spouse Visa will need to show that their U.S. Sponsor's income is 125 percent of the federal poverty guidelines.</p>
				</div>					
				<div class="col-md-12 mb-3">
					<h5 class="mb-3">Required Annual Income (For Fiancee Visa)</h5>
					<p class="lh-175">$18,310, if 2 Persons in Family or Household</p>
					<p class="lh-175">$23,030, if 3 Persons in Family or Household</p>
					<p class="lh-175">$27,750, if 4 Persons in Family or Household</p>
					<p class="lh-175">For each additional person add $4,720</p>
					<h5 class="mb-3">Required Annual Income (For Spouse Visa or Green Card)</h5>
					<p class="lh-175">$22,887, if 2 Persons in Family or Household</p>
					<p class="lh-175">$28,787, if 3 Persons in Family or Household</p>
					<p class="lh-175">$34,687, if 4 Persons in Family or Household</p>
					<p class="lh-175">For each additional person add $5,900</p>
					<p class="lh-175">The Financial eligibility thresholds are lower for active military, and higher for residents of Alaska or  Hawaii.</p>
				</div>
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>How to prove your Income.</h2>
					</div>
					<p class="lh-175">To demonstrate income, the US sponsor normally provides his or her most recent Federal Tax Return, 3 to 6 pay stubs showing 'Year to date' earnings, or a letter from the employer confirming employment, job title and what the expected annual pay is.</p>
				</div>
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Cash Assets can count as an alternate to income.</h2>
					</div>
					<p class="lh-175">In some cases a sponsor's income may be too low, but instead he or she has 'money in the bank'. In that case, Cash assets, can be used as a substitute for annual income. 'Cash' assets are assets which can be easily converted (sold) to cash. For example: stocks, bonds, certificates of deposit, monies in a checking account can be used.</p>
					<p class="lh-175">Other assets that can NOT be easily turned into cash such as investment properties, automobiles, land, with the EXCEPTION of equity in the HOME RESIDENCE, are not acceptable to prove eligibility.</p>
				</div>
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Cash Asset Equivalents</h2>
					</div>
					<p class="lh-175">$5 in cash assets = $1 annual income</p>
					<p class="lh-175">For example, a Fiancee Visa sponsor, with NO income, and no dependents (so has a household of 2 persons) would need to have $91,550 in cash assets to quality for a Fiancee Visa.</p>
					<p class="lh-175">5 x $18,310 = $91,550</p>
					<p class="lh-175">Alternatively, a combination of income and assets will work. For example, if the sponsor's retirement income is $10,000 per year, then he should have at least $41,550 cash assets to qualify.</p>
					<p class="lh-175">$18,310 - $10,000 = $8,310 x 5 = $ 41,550 cash assets needed.</p>
				</div>
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Using a Financial Joint-sponsor</h2>
					</div>
					<p class="lh-175">If the sponsor's income or assets are not enough to achieve the eligibility threshold, the sponsor can ask a relative or friend to act as a joint-sponsor. Just like buying a car, the second person is virtually 'co-signing' your visa application.</p>
					<p class="lh-175">When a joint-sponsor is used, the size of the household increases. The combined household (for financial calculations) would include the household size of the sponsor combined with the household size of the joint-sponsor.</p>
					<p class="lh-175">For example, a college student petitioning for his fiancee, asks his father to be a joint-sponsor. Both the student and father must each complete an affidavit of support. The student's household is just 2 persons, himself and his fiancee. The father's household would be father, mother, and the two siblings still living at home. Thus the combined household would be 6 persons, (2 from the student and 4 from the father) meaning an acceptable combined income to support the 6 person household would have to be at least $37,190 or more.</p>
					<h5 class="mt-3">If you have questions, just give us  a call at 702-426-4503.</h5>
				</div>
			</div>
		</div>
	</section>		
@endsection