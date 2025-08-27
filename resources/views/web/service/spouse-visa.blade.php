@extends('web.layout.master')
@section('content')
	@include('web.component.bread-crumb', [
		'title' => 'Spouse Visa',
		'previousPageLink' => route('service'),
		'previousPageTitle' => 'Services',
	])	
	<section class="about-us ptb-115">
		<div class="container">
			<div class="row d-flex align-items-center">
				<div class="col-md-6">
					<div class="about-img-block aos-init" data-aos="fade-left">
						<img src="{{ asset('assets/img/aboutimg6.jpg') }}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="about-content aos-init" data-aos="fade-right">
						<div class="section-title">
							<h3>What Is a CR1 Visa?</h3>
						</div>
						<p>A CR1 visa, also called IR1 spousal visa, is an immigrant visa issued to an alien who is married to a U.S. citizen or permanent resident and wishes to live in the U.S. with their spouse</p>
						<p>The CR in CR1 stands for “conditional resident.” That is because this visa is only provided to couples who have been married for less than 2 years. Similarly, the IR in IR1 stands for “immediate relative” and this visa is granted to couples who have been married for more than 2 years.</p>
						
						<h5>What Is the Difference Between a K3 Visa and CR1 Visa?</h5>
						<p>The K3 visa used to serve the same purpose as the CR1 does now, but this visa is obsolete and no longer serves a purpose. The K3 visa used to be the non-immigrant visa that allowed spouses of U.S. citizens to enter the U.S. and then give them the opportunity to change their status to obtain a conditional green card.</p>
						<p>All these objectives are now fulfilled by CR1 spouse visa, at a lower cost, and in fewer steps. The CR1 visa allows spouses to have a conditional green card immediately.</p>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="about-us ptb-115 bg-lightgrey">
		<div class="container">
			<div class="row d-flex align-items-center">
				<div class="col-md-6">
					<div class="about-content mb-mob-50 aos-init" data-aos="fade-right">
						<div class="section-title">
							<h3>Who Is Eligible for a CR1 Visa?</h3>
						</div>
						<p>It is important to mention that the CR1 visa can only be initiated by your U.S. petitioner. Thus, it is essential that the petitioner:</p>	
						<div class="box-list">
							<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
							<p> Is a U.S. citizen or in possession of a green card.</p>
						</div>
						<div class="box-list">
							<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
							<p>Must be legally married to the person this process is initiated for.</p>
						</div>
						<div class="box-list">
							<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
							<p>Must meet the visa income requirements.</p>
						</div>
						<h5>What about Children?</h5>
						<p>A child does not receive derivative status in an immediate relative petition. This is different from the K-1 fiancee visa where a child is included in his/her parent's petition. A child is not included as a derivative in his/her parent's CR-1 or IR-1 petition. A separate CR-2 petition must be filed for each child that will be receiving a visa.</p>	
						<p>Children born abroad after you became a U.S. citizen may qualify for U.S. citizenship. They should apply for U.S. passports. The consular officer will determine whether your child is a U.S. citizen and can have a passport. If the consular officer determines your child is not U.S. citizen, the child must apply for an immigrant visa if he/she wants to live in the U.S.</p>
						<p>Children can receive a CR-2 or IR-2 visa and must have been under 18 years of age as of the date you were married in order to qualify for a CR-2 or IR-2 visa.</p>
						<h5>Is Residence in the U.S. Required for the U.S. Sponsor?</h5>
						<p>Yes. As a U.S. sponsor/petitioner, you must maintain your principal residence (also called domicile) in the United States, which is where you plan to live for the foreseeable future.</p>								
					</div>
				</div>
				<div class="col-md-6">
					<div class="about-img-block aos-init" data-aos="fade-left">
						<img src="{{ asset('assets/img/aboutimg22.jpg') }}">
					</div>
				</div>
			</div>
		</div>
	</section>
	{{-- Get Started Section --}}
	@if (!Auth::check())
		@include('web.component.get-started')
	@endif
	<section class="about-us ptb-115">
		<div class="container">
			<div class="row d-flex align-items-center">
				<div class="col-md-6">
					<div class="about-img-block aos-init" data-aos="fade-left">
						<img src="{{ asset('assets/img/service11.jpg') }}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="about-content aos-init" data-aos="fade-right">
						<div class="section-title">
							<h3>How Long does it Take to get a Spouse visa?</h3>
						</div>
						<p>The average time is approximately 12-18 months to get a Spouse Visa approved from the date of filing. The U.S. citizen should not arrange to take their spouse back to the United States immediately following the marriage. No travel arrangements should be finalized until a visa has been issued.</p>				
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="ptb-100 faq bg-lightgrey">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 section-title text-center">
					<h3>Frequently Asked Questions</h3>
				</div>
			</div>
			<div class="row">					
				<div class="col-lg-12">
					<div class="questions-holder">
						<div class="question">
							<h5>Can a couple be Married Online?</h5>
							<p>Yes, an online wedding must be legal in the state in which you are married, which means you must obtain a wedding license and after you are married, you must register your online wedding with the state and they must recognize it. According to USCIS regulations, you <b class="fw-bold">MUST</b> have met your spouse in person at least 1 time <b class="fw-bold">since</b> the online marriage occurred. If you want to have an online wedding, please check with us first, as it must be done correctly.</p>
						</div>							
					</div>
				</div>
				<div class="col-md-12">
					<div class="resources_topics">
						 <ul class="list-unstyled tag_list">
							<li>
								<a href="{{ route('resource.page', 'income-requirement') }}">
								<img src="{{ asset('assets/img/document2.png') }}"> What are the income requirements for a Spouse Visa?</a>
							</li>
							<li>
								<a href="{{ route('resource.page', 'documents-required-for-spouse-visa') }}">
								<img src="{{ asset('assets/img/document2.png') }}"> What documents are required to get a Spouse Visa?</a>
							</li>
							<!--li>
								<a href="{{ route('resource.page', 'requirements-to-get-spouse-visa') }}">
								<img src="{{ asset('assets/img/document2.png') }}"> What are the requirements to get a Spouse Visa?</a>
							</li-->
						</ul>
					</div>
				<div class="modal fade finance_modal" id="spousemodal" tabindex="-1" aria-labelledby="spousemodalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&#x2715</button>
							<div class="modal-body">
								<h2 class="modal_head">What are the income requirements for a Spouse Visa?</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
							</div>
						</div>
					</div>
				</div>	
				</div>
			</div>
		</div>
	</section>			
	<section class="ptb-100-60 pricing-packages spouse_package_div">
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="col-md-5 section-title">
					<h3>Our Spouse Visa Package</h3>
					<div class="box-list">
						<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
						<p> We prepare all the forms...all you do is sign them</p>
					</div>	
					<div class="box-list">
						<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
						<p> Analysis of all your financial information</p>
					</div>	
					<div class="box-list">
						<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
						<p> Affidavit of Support Preparation</p>
					</div>	
					<div class="box-list">
						<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
						<p> Complete Guidance for the Medical Examination</p>
					</div>	
					<div class="box-list">
						<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
						<p> Full Embassy Interview Preparation &amp; Support</p>
					</div>	
					<div class="box-list">
						<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
						<p> Secure account, accessible worldwide, 24/7</p>
					</div>	
					<div class="box-list">
						<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
						<p><a class="guarantee_btn" href="{{ route('guarantee') }}">Money-back guarantee if denied</a></p>
					</div>							
				</div>					
				<div class="col-md-4">
					<div class="pricing-table highlight">
						<div class="pricing-plan">
							<h5 class="primary-color">SPOUSE VISA (CR1)</h5>
							<sup>$</sup>
							<span class="price">750</span>
								<a href="javascript:void(0)" class="p-md" data-bs-toggle="modal" data-bs-target="#secModal">+ Gov. Fees</a>
						</div>
						<ul class="features">
							<li><i class="fas fa-stop-circle"></i> Full Support Start to Finish</li>
							<li><i class="fas fa-stop-circle"></i> Unlimited Phone Support</li>
							<li><i class="fas fa-stop-circle"></i> Unlimited Email Support</li>
							<li><i class="fas fa-stop-circle"></i> Prepare All Government Forms</li>
							<li><i class="fas fa-stop-circle"></i> Online Petition Tracking</li>
						</ul>
						{{ Form::open(['url' => route('payment'), 'method' => 'GET']) }}
							{!! Form::hidden('user_id', Auth::id()) !!}
							{!! Form::hidden('application_id', 3) !!}
							{!! Form::hidden('route', 'spouseVisaApplication') !!}
							{!! Form::hidden('price', 650) !!}
							{{ Form::submit('Get Started', ['class' => 'btn btn-tra-primary']) }}
					    {{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</section><div class="modal fade" id="secModal" tabindex="-1" aria-labelledby="secModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Spouse Visa (CR1)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="cbox-3-txt mb-2">
								<h5>Fees for a Spouse Visa</h5>
								<ul><li><i class="fas fa-stop-circle"></i> $750 Total Fee to Filipina Fiancée Visa (Paid to get Started)</li></ul>
							</div>
							 <div class="cbox-3-txt mb-2">
								<h5>Government Fees:</h5>
								<ul><li><i class="fas fa-stop-circle"></i> USCIS I-130 (online): $625</li>
								<li><i class="fas fa-stop-circle"></i> NVC fees (AOS + IV): $445</li>
								<li><i class="fas fa-stop-circle"></i> USCIS Immigrant Fee: $235</li>
								<li><i class="fas fa-stop-circle"></i> Medical exam (PH): $500</li>
								<li><i class="fas fa-stop-circle"></i> Grand Total: $2,555</li>
								</ul>
							</div>
							<div class="cbox-3-txt mb-2">
								<h5>Fees for Children (Per Child)</h5>
								
								<ul><li><i class="fas fa-stop-circle"></i> $300 Fee to Filipina Fiancée Visa (Per Child) (Paid to get Started)</li>
							
								</ul>
							</div>
							<div class="cbox-3-txt mb-2">
								<h5>Government Fees:</h5>
								<ul><li><i class="fas fa-stop-circle"></i>$675 Filing Fee to United States Government (Due at Filing) (Can be paid by Credit Card)</li>
								<li><i class="fas fa-stop-circle"></i>$445 National Visa Center Fees (Due Much Later)</li>
								<li><i class="fas fa-stop-circle"></i>$240 Child Medical Exam fee (14 years and younger) (Due Much Later)</li>
								<li><i class="fas fa-stop-circle"></i> $220 Immigrant Fee to US Government for Green Card (Due After Embassy Interview)</li>
								<li><i class="fas fa-stop-circle"></i> $1,880 Total All Fees</li>
								</ul>
								<p>Children must have been under 18 years of age as of the date you were married to qualify.</p>
							</div></div>
							
      </div>
     
    </div>
  </div>
@endsection