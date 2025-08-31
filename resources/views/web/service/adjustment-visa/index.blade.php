@extends('web.layout.master')
@section('content')
@include('web.component.bread-crumb', [
'title' => 'Adjustment Of Status',
'previousPageLink' => route('service'),
'previousPageTitle' => 'Services',
])	
<section class="about-us ptb-115">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <div class="about-img-block aos-init" data-aos="fade-left">
                    <img src="{{ asset('assets/img/aboutimg4.jpg') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-content aos-init" data-aos="fade-right">
                    <div class="section-title">
                        <h3>The Green Card</h3>
                    </div>
                    <p>After your fiancée enters the United States, you have 90 days to file their Adjustment of Status or their status will change to unlawful. They will not be able to work, get a social security number, get a state ID card, or driver's license, or leave the country until we Adjust their Status. We do provide complete assistance with filing the Adjustment of Status. We fill-out absolutely all the paperwork and all you have to do is sign your name. You can be sure that ALL complex paperwork will be done 100% correct. There is about 3 times more paperwork for the Adjustment of Status than the Fiancée Visa. If the Adjustment of Status is done incorrectly, they will deny it and issue a deportation notice. Don't risk everything by trying to do this yourself.
                    </p>
                    <h5>Getting Your Green Card</h5>
                    <p>Our experienced immigration consultants will expertly prepare all the required paperwork for foreign nationals already in the U.S. with an approved immigration petition. An Adjustment of Status is the process of obtaining legal permanent residence in the U.S. The adjustment application is filed with the Department of Homeland Security to get what is known as a green card.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about-us ptb-1151 bg-lightgrey">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <div class="about-content mb-mob-50 aos-init" data-aos="fade-right">
                    <div class="section-title">
                        <!-- <span class="subheading primary-color">About Us</span> -->
                        <h3>Why Use Our AOS Service?</h3>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>We prepare all the forms, all you do is sign them and add your supporting documents. When we prepare your paperwork, we will give you a list of all required supporting documents.</p>
                    </div>
                    <div class="box-list ">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>We prepare your Employment Authorization at no extra charge.</p>
                    </div>
                    <div class="box-list ">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>We prepare an Advance Parole (Travel Permit) at no extra charge</p>
                    </div>
                    <div class="box-list ">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>We get you a Social Security Card at no extra charge.</p>
                    </div>
                    <div class="box-list ">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Avoid costly mistakes and subsequent delays, denials, and deportations.</p>
                    </div>
                    <div class="box-list ">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>We will carefully prepare your entire Adjustment of Status Application Package, and we will guide you through the entire process.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-img-block aos-init" data-aos="fade-left">
                    <img src="{{ asset('assets/img/aboutimg5.jpg') }}">
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Get Started Section --}}
@if (!Auth::check())
@include('web.component.get-started')
@endif
<section class="ptb-60-100 faq">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 section-title text-center">
                <h3>Question &amp; Answer</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="questions-holder pc-30">
                    <div class="question">
                        <h5>How long is the Green Card valid?</h5>
                        <p>If you have been married less than 2 years your initial green card is conditional and is good for 2 years, then you must apply for a 10-year green card. If you have been married over 2 years your initial green card is good for 10 years</p>
                    </div>
                    <div class="question">
                        <h5>How long does it take to get an Green Card?</h5>
                        <p>6-12 months is the nationwide average.</p>
                    </div>
                    <div class="question">
                        <h5>How long does it take to get an Employment Authorization card?</h5>
                        <p>2-6 months is the average.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="questions-holder pc-30">
                    <div class="question">
                        <h5>How long does it take to get an Advance Parole (Travel Permit)?</h5>
                        <p>2-6 months is the average.</p>
                    </div>
                    <div class="question">
                        <h5>How long do you use the Employment Authorization card and Advance Parole (Travel Permit)?</h5>
                        <p>Only until you get your green card then you no longer need them.</p>
                    </div>
                    <div class="question">
                        <h5>If I entered the U.S. illegally, can I get a green card?</h5>
                        <p>If you entered the U.S. illegally, we cannot help you.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ptb-100-60 pricing-packages">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-5 section-title">
                <h3>Our Adjustment of Status Package</h3>
            </div>
            <div class="col-md-4">
                <div class="pricing-table highlight">
                    <div class="pricing-plan">
                        <h5 class="primary-color">ADJUSTMENT OF STATUS</h5>
                        <sup>$</sup>
                        <span class="price">800</span>
                        <a href="javascript:void(0)" class="p-md" data-bs-toggle="modal" data-bs-target="#secModal">+ Gov. Fees</a>
                    </div>
                    <ul class="features">
                        <li><i class="fas fa-stop-circle"></i> Full Support Start to Finish</li>
                        <li><i class="fas fa-stop-circle"></i> Unlimited Phone Support</li>
                        <li><i class="fas fa-stop-circle"></i> Unlimited Email Support</li>
                        <li><i class="fas fa-stop-circle"></i> Prepare All Government Forms</li>
                        <li><i class="fas fa-stop-circle"></i> Green Card Interview Support</li>
                    </ul>
                    {{ Form::open(['url' => route('payment'), 'method' => 'GET']) }}
                    {!! Form::hidden('user_id', Auth::id()) !!}
                    {!! Form::hidden('application_id', 2) !!}
                    {!! Form::hidden('route', 'adjustment.show') !!}
                    {!! Form::hidden('price', 700) !!}
                    {{ Form::submit('Get Started', ['class' => 'btn btn-tra-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="secModal" tabindex="-1" aria-labelledby="secModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adjustment of Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cbox-3-txt mb-2">
								<h5>Fees for an Adjustment of Status</h5>
								<ul><li><i class="fas fa-stop-circle"></i> $800 – Filipina Fiancée Visa Service Fee (Paid upfront)</li></ul>
							</div>
							 <div class="cbox-3-txt mb-2">
								<h5>Government Fees:</h5>
								<ul>
                                 <li><i class="fas fa-stop-circle"></i>USCIS I-485: $1,440</li>
                                 <li><i class="fas fa-stop-circle"></i>USCIS I-765 (work permit): $260</li>
                                 <li><i class="fas fa-stop-circle"></i>USCIS I-131 (travel) optional: $630</li>
								 <li><i class="fas fa-stop-circle"></i> Total Cost: $2,500</li>
								
								</ul>
							</div>
							<div class="cbox-3-txt mb-2">
								<h5>Fees for Children Filing with Parent</h5>
								
								<ul><li><i class="fas fa-stop-circle"></i> $300 – Filipina Fiancée Visa Service Fee (Paid upfront)</li>
								<li><i class="fas fa-stop-circle"></i> Government fees vary based on age and circumstances (Paid at the time of filing)</li>
							
								</ul>
							</div>
							<!-- <div class="cbox-3-txt mb-2">	<h5>Government Fees:</h5>
								<ul><li><i class="fas fa-stop-circle"></i>$1,225 Filing fee for Children 14 or over (Due at time of filing)</li>
								<li><i class="fas fa-stop-circle"></i>$1,425 Total of All Fees</li>
								<li><i class="fas fa-stop-circle"></i>$750 Filing fee for Children under 14 years of age filing with the application of at least one parent</li>
								
								</ul>
							</div> -->
	                   <!-- <div class="cbox-3-txt mb-2">
								<h5>Fees for Children NOT Filing with Parent</h5>
								
								<ul><li><i class="fas fa-stop-circle"></i>$700 Fee to Filipina Fiancée Visa</li>
							
								</ul>
							</div> -->
							<!-- <div class="cbox-3-txt mb-2">
								<h5>Government Fees:</h5>
								<ul><li><i class="fas fa-stop-circle"></i>$1,140 Filing fee for Children under 14 years of age not filing with at least one parent</li>
								<li><i class="fas fa-stop-circle"></i>$1,840 Total of All Fees</li>
								
								</ul>	</div> -->
            </div>
        </div>
    </div>
</div>
@endsection