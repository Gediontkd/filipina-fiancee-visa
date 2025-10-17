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
								<li class="breadcrumb-item active" aria-current="page">How to get married in the Philippines</li>
							</ol>
						</nav>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Title Section -->
	<section class="ptb-80 bg-white">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="heading mb-4">
						<h1>How to get married in the Philippines</h1>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="resource-detail bg-lightgrey ptb-80 heading_hidden">
		<div class="container">
			<div class="row">
			  	<div class="col-md-6 mb-3 about-us aboutus2 align-self-center">
					<div class="about-img-block">
						<img src="{{ asset('assets/img/marriage.png') }}" alt="Marriage in Philippines">
					</div>						
				</div>	
				<div class="col-md-6 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>Application for a Philippine Marriage License</h2>
					</div>
					<p class="lh-175">Marriage License: a requirement for either a Civil or Church wedding to be held in the Philippines. The Application Form for a marriage license must be secured at the Local Civil Registrar from the city, town or municipality where either the bride or the groom habitually resides. The personal appearance of those getting married is required in applying for a marriage license.</p>
					<p class="lh-175">Each of the contracting parties shall file separately a sworn application for each license with the proper local civil registrar. Philippine law prescribes a <b class="fw-bold">ten business day waiting period</b> from the filing of the Application to the issuance of the marriage license. The license is valid for 120 days from date of issuance and may be used anywhere in the Philippines. Both of you must appear in person to get a Marriage Licence. Typical time to complete a marriage is 16-18 days from arriving in Philippines. Nobody completes it in 14 days, many have tried.</p>
					<p class="lh-175">At the time the contracting parties appear to file their application for a Marriage License to the local civil registrar, he or she must also submit the following supporting documents:</p>
				</div>						
				<div class="col-md-12 mb-3">
					<p class="lh-175">Parents' Consent (for 18-21 years old) or Parent's Advice (for 21-25 years old): Under Philippine law, the legal age for marriage is 18. If the contracting parties are between the ages of 18 and 21, they must present written consent to the marriage from their father, mother or legal guardian. While any contracting party between the age of 22 and 25 must present written parental advice, i.e., a written indication that the parents are aware of the couple's intent to marry.</p>
					<p class="lh-175">Certificate of Attendance in a pre-marital counseling and family planning seminar conducted by the Division of Maternal and Child Health at the Municipal/City Hall in the same municipality or city where the contracting parties applied for the marriage license.</p>
				</div>
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Certificate of Legal Capacity to Contract Marriage</h2>
					</div>
					<p class="lh-175">Any foreigner who wishes to marry in the Philippines is required by the Philippine Government to obtain from his/her Embassy a "Certificate of Legal Capacity to Contract Marriage" before filing an application for a marriage license. This certification affirms that there are no legal impediments to the foreigner marrying a Filipino (i.e, that the foreigner is already married to someone else). Unlike the Philippines, the U.S. Government does not keep a central statistical registry for births, marriages and deaths and cannot verify this information. Instead, the Philippine Government accepts an "Affidavit in Lieu of a Certificate of Legal Capacity to Contract Marriage." Americans may execute this affidavit at the American Embassy in Manila or the U.S. Consular Agency in Cebu. Personal appearances of the American citizen applicant cannot be waived, but the fiance(e) need not be present. Philippine authorities will not accept any substitute document initiated in the United States.</p>
					<p class="lh-175">Applicants may apply for the "<b class="fw-bold">Affidavit in Lieu of a Certificate of Legal Capacity to Contract Marriage</b>" at the Embassy's American Citizen Services Branch everyday from Monday through Friday from 8:00 - 10:00 am.(except Philippine and American holidays). The American must present his/her U.S. passport. There is a fee of $50.00 or its peso equivalent for the affidavit, payable in cash only and <b class="fw-bold">subject to change</b>.</p>
					<p class="lh-175">The Affidavit is notarized by a U.S. consular officer. The consular officer can refuse to perform this service if the document will be used for a purpose patently unlawful, improper, or inimical to the best interest of the United States. Entering into a marriage contract with an alien strictly for the purpose of enabling entry to the United States for that individual is considered an unlawful act. Section 4221 of Title 22 United States Code provides penalties for individuals who commit perjury in an affidavit taken by a consular officer.</p>
				</div>
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Additional Requirement for U.S. Military Personnel</h2>
					</div>
					<p class="lh-175">U.S. military personnel should contact their personnel office regarding Department of Defense joint service regulations.</p>
				</div>
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>The Marriage Application Process</h2>
					</div>
					<p class="lh-175">Once an American citizen has obtained from the Embassy an Affidavit in Lieu of a Certificate of Legal Capacity to Marry, he/she can file an application for a marriage license at the office of the Philippine Civil Registrar in the town or city where one of the parties is a resident. The license is a requirement for either a civil or church wedding in the Philippines. The U.S. citizen applicant will need to present:</p>
					<ul class="list-resourses">									 
						<li>The affidavit in lieu of a certificate of legal capacity to marry;</li>
						<li>Divorce decree(s) or death certificate(s) required to verify civil status and capacity to marry;</li>
						<li>U.S. passport;</li>
						<li>Documentation regarding paternal consent or advice, if applicable.</li>
					</ul>
					<p class="lh-175">A judge, a minister or any other person authorized by the Government of the Philippines can perform the marriage.  Marriage applicants aged 18 to 21 must have written parental consent. Applicants aged 22 to 24 must have received parental advice. Philippine law prohibits the marriage of individuals under the age of 18.</p>
					<p class="lh-175"><b class="fw-bold">Philippine law prescribes a ten-business day waiting period from the filing of the application to the  issuance of the marriage license.</b> The license is valid for 120 days and may be used anywhere in the Philippines.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- Services Section -->
	<section class="ptb-80 bg-white">
		<div class="container">
			<div class="row">
				<!-- Fiancee Visa -->
				<div class="col-md-4 col-sm-6 mb-3">
					<div class="text-center">
						<div class="heading mb-3">
							<h3>Fiancee Visa</h3>
						</div>
						<div class="about-img-block mb-3">
							<img src="{{ asset('assets/img/Fiancee-Visa.jpg') }}" alt="Fiancee Visa" class="img-fluid">
						</div>
						<a href="{{ route('fiancee.visa') }}" class="btn btn-primary">Start Now</a>
					</div>
				</div>

				<!-- Spouse & Marriage Visas -->
				<div class="col-md-4 col-sm-6 mb-3">
					<div class="text-center">
						<div class="heading mb-3">
							<h3>Spouse & Marriage Visas</h3>
						</div>
						<div class="about-img-block mb-3">
							<img src="{{ asset('assets/img/tourist_visa.jpg') }}" alt="Spouse & Marriage Visas" class="img-fluid">
						</div>
						<a href="{{ route('spouse.visa') }}" class="btn btn-primary">Start Now</a>
					</div>
				</div>

				<!-- Adjustment of Status -->
				<div class="col-md-4 col-sm-6 mb-3">
					<div class="text-center">
						<div class="heading mb-3">
							<h3>Adjustment of Status</h3>
						</div>
						<div class="about-img-block mb-3">
							<img src="{{ asset('assets/img/flag-2.jpg') }}" alt="Adjustment of Status" class="img-fluid">
						</div>
						<a href="{{ route('adjustment.visa') }}" class="btn btn-primary">Start Now</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Call to Action Section -->
	<section class="ptb-80 bg-lightgrey">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-5 col-12 mb-3">
					<p class="text-uppercase mb-3"><small>CALL US</small></p>
					<div class="heading mb-3">
						<h2>CALL FOR A FREE CONSULTATION</h2>
					</div>
					<a href="{{ route('contactUs') }}" class="btn btn-outline-dark">CONTACT US</a>
				</div>
				<div class="col-md-7 col-12 mb-3">
					<div class="about-img-block">
						<img src="{{ asset('assets/img/filipina-fiancee-visa-banner.jpg') }}" alt="Filipina Fiancee Visa" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</section>
	
@endsection