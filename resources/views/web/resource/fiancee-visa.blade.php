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
								<li class="breadcrumb-item active" aria-current="page">Fiancee Visa (K-1) vs. Spousal Visa (CR-1)</li>
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
	<section class="resource-detail bg-lightgrey ptb-80 heading_hidden">
		<div class="container">
			<div class="row">
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Fiancee Visa (K-1) vs. Spousal Visa (CR-1)</h2>
					</div>
					<p class="lh-175">Should I use a K-1 Fiancee Visa and marry my lady in the United States OR use a CR-1 Visa (Spousal Visa/Marriage Visa) and marry my lady in the Philippines?</p>
					<p class="lh-175">We have tried to summarize the advantages and disadvantages of both the K-1 and the CR-1 visa. It is entirely up to you to choose which process to follow. We will be happy to assist you in obtaining either one!</p>
				</div>
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Advantages Of The Fiancee Visa</h2>
					</div>
					<ul class="list-resourses">									 
						<li>The Fiancee Visa is the FASTEST and EASIEST visa to get. It is currently taking 9-12 months to get a  fiancee visa.</li>
						<li>You don't need to marry immediately in your Fiancée's country or the U.S.</li>
						<li>You bring your love to the U.S. as your Fiancee, and both of you have 90 days to get married. This allows you both to get to know each other better and make a better decision about marriage, which for most people is a very important life decision.</li>
						<li>You deal nearly exclusively with the U.S. immigration system and U.S. immigration officials here, in the United States. You largely avoid dealing with the sometimes arcane and cumbersome legal rules for marriage and immigration in the Philippines.</li>
						<li>Your fiancee has a chance to see the country and get familiar with U.S. customs before the marriage.</li>
						<li>In general, much less supporting documentation is needed for a Fiancee Visa.</li>
						<li>Allows both of you to return to the bride's home country at a later date for a "show" or fictitious wedding for the benefit of her family and friends.</li>
					</ul>
				</div>
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Advantages Of The Spouse Visa</h2>
					</div>
					<ul class="list-resourses">									 
						<li>You get married immediately. Your spouse's family and friends will be able to attend your wedding.</li>
					</ul>
				</div>
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Disadvantages Of The Spouse Visa</h2>
					</div>
					<ul class="list-resourses">									 
						<li>Takes longer to get. It is currently taking 12-18 months to get a spouse visa.</li>
						<li>It is more expensive to get than a Fiancee Visa.</li>
						<li>There can be a lot of "red tape" involved with getting married in the Philippines.</li>
						<li>A Certificate of Legal Capacity to Marry must be obtained from the US Embassy prior to marriage.</li>
						<li>Philippine law prescribes a ten business day waiting period from the filing of the Application to the issuance of the marriage license before a couple can marry.</li>
						<li>Because of special laws concerning foreigners getting married there, marriage in the Philippines can take up to 21 days to accomplish. It cannot be accomplished in 14 days.</li>
						<li>If the contracting parties are between the ages of 18 and 21, they must present written consent to the marriage from their father, mother or legal guardian. While any contracting party between the age of 22 and 25 must present written parental advice, i.e., a written indication that the parents are aware of the couple's intent to marry.</li>
						<li>Philippine law requires a Certificate of Attendance in a pre-marital counseling and family planning seminar conducted by the Division of Maternal and Child Health at the Municipal/City Hall in the same municipality or city where the contracting parties applied for the marriage license.</li>
					</ul>
				</div>
			</div>
		</div>
	</section>		
@endsection