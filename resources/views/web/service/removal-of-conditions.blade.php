@extends('web.layout.master')
@section('content')
    @include('web.component.bread-crumb', [
        'title' => 'Removal of Conditions (ROC)',
        'previousPageLink' => route('service'),
        'previousPageTitle' => 'Services',
    ])
    
    <section class="about-us ptb-115">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="about-img-block aos-init" data-aos="fade-left">
                        <img src="{{ asset('assets/img/Removal-of-Conditions.jpg') }}" alt="ROC Process">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-content aos-init" data-aos="fade-right">
                        <div class="section-title">
                            <h3>What Is Removal of Conditions (ROC)?</h3>
                        </div>
                        <p>If you received your green card based on a marriage that was less than 2 years old at the time you became a permanent resident, you received a conditional green card. To remove the conditions on your residence, you must file Form within the 90-day period before your conditional green card expires.</p>
                        <p>The ROC process is crucial for maintaining your permanent resident status. Failure to file on time can result in the termination of your conditional permanent resident status and removal proceedings.</p>
                        
                        <h5>When Should You File for ROC?</h5>
                        <p>You must file Form within the 90-day period immediately before your conditional green card expires. The expiration date is printed on your card. Filing too early or too late can cause complications.</p>
                        
                        <h5>How Long Does ROC Take?</h5>
                        <p>Currently, ROC processing times range from 12-24 months. During this period, your conditional green card is automatically extended, and you maintain your legal status.</p>
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
                            <h3>Who Needs to File ROC?</h3>
                        </div>
                        <p>You need to file ROC if:</p>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>You received your green card based on marriage to a U.S. citizen or permanent resident</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Your marriage was less than 2 years old when you got your green card</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Your green card has a 2-year expiration date (conditional)</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>You're still married to the same U.S. citizen/permanent resident</p>
                        </div>
                        
                        <h5>What If I'm Divorced or Widowed?</h5>
                        <p>You may still be eligible to remove conditions even if your marriage ended due to divorce, death, or abuse. Special provisions exist for these situations, and we can help determine your eligibility.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-img-block aos-init" data-aos="fade-left">
                        <img src="{{ asset('assets/img/Permanet-Resident-Card.jpg') }}" alt="ROC Requirements">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Get Started Section --}}
    @if (!Auth::check())
        @include('web.component.roc-button')
    @endif

    <section class="about-us ptb-115">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="about-img-block aos-init" data-aos="fade-left">
                        <img src="{{ asset('assets/img/Why_Choose_Us_02.jpg') }}" alt="Why Choose Us">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-content aos-init" data-aos="fade-right">
                        <div class="section-title">
                            <h3>Why Choose Us for Your ROC?</h3>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Expert knowledge of ROC requirements and procedures</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>We prepare all forms - you just review and sign</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Comprehensive evidence package preparation</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Support from filing through approval</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Interview preparation if required</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>20+ years of immigration experience</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>High success rate with ROC cases</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Secure online tracking system</p>
                        </div>
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
                            <h5>What happens if I don't file ROC on time?</h5>
                            <p>If you don't file within the 90-day window before your card expires, your conditional permanent resident status will terminate, and you may be placed in removal proceedings. It's crucial to file on time.</p>
                        </div>
                        <div class="question">
                            <h5>Can I travel while my ROC is pending?</h5>
                            <p>Yes, your expired conditional green card combined with the I-797 receipt notice serves as evidence of your continued permanent resident status for travel purposes.</p>
                        </div>
                        <div class="question">
                            <h5>What if my ROC is denied?</h5>
                            <p>If denied, you'll be placed in removal proceedings where you can present your case to an immigration judge. Having proper legal representation is crucial in these situations.</p>
                        </div>
                        <div class="question">
                            <h5>Do my children need to file separate ROC applications?</h5>
                            <p>Children who received conditional status based on your marriage can be included in your ROC application if they're still under 21 and unmarried.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="more-questions text-center">
                        <h5>
                            Still have a question?
                            <a href="{{ route('contactUs') }}">
                                Ask your question here
                            </a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ptb-100-60 pricing-packages spouse_package_div">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-md-5 section-title">
                    <h3>Our ROC Package includes</h3>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Complete ROC Package preparation</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Evidence guidance and review</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Supporting documentation review</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Case tracking and status updates</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Interview preparation (if required)</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Unlimited email and phone support</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon">
                            <i class="fas fa-genderless"></i>
                        </div>
                        <p>
                            <a class="guarantee_btn" href="{{ route('guarantee') }}">Money-back guarantee if denied</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pricing-table highlight">
                        <div class="pricing-plan">
                            <h5 class="primary-color">ROC PACKAGE</h5>
                            <sup>$</sup>
                            <span class="price">600</span>
                            <a href="javascript:void(0)" class="p-md" data-bs-toggle="modal"
                                data-bs-target="#rocModal">+ Gov. Fees</a>
                        </div>
                        <ul class="features">
                            <li><i class="fas fa-stop-circle"></i> Package Preparation</li>
                            <li><i class="fas fa-stop-circle"></i> Evidence Guidance & Review</li>
                            <li><i class="fas fa-stop-circle"></i> Document Review & Analysis</li>
                            <li><i class="fas fa-stop-circle"></i> Filing Strategy Consultation</li>
                            <li><i class="fas fa-stop-circle"></i> Case Monitoring & Updates</li>
                            <li><i class="fas fa-stop-circle"></i> Interview Prep (if needed)</li>
                        </ul>
                        {{ Form::open(['url' => route('payment'), 'method' => 'GET']) }}
							{!! Form::hidden('user_id', Auth::id()) !!}
							{!! Form::hidden('application_id', 3) !!}
							{!! Form::hidden('route', 'spouseVisaApplication') !!}
							{!! Form::hidden('price', 650) !!}
							{{ Form::submit('Get Started', ['class' => 'btn btn-tra-primary']) }}
					    {{ Form::close() }}
                        <div class="pricing-actions">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ROC Pricing Modal -->
    <div class="modal fade" id="rocModal" tabindex="-1" aria-labelledby="rocModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rocModalLabel">ROC Package Pricing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="cbox-3-txt mb-2">
                        <h5>Our Service Fee</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> $600 Total Fee to Filipina Fiancée Visa (Paid to get Started)</li>
                        </ul>
                    </div>
                    <div class="cbox-3-txt mb-2">
                        <h5>Government Fees:</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> USCIS Filing Fee: $750 (By Mail) / $700 (Online)</li>
                            <li><i class="fas fa-stop-circle"></i> Total Gov Fees: $750 (By Mail) / $700 (Online)</li>
                            <!-- <li><i class="fas fa-stop-circle"></i> $85 Biometrics Fee (if required)</li> -->
                            <li><i class="fas fa-stop-circle"></i> Grand Total: $1,350 (By Mail) / $1,300 (Online)</li>
                        </ul>
                    </div>
                    <div class="cbox-3-txt mb-2">
                        <h5>Children Included</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> Unmarried children under 21 can be included at no additional service fee</li>
                            <li><i class="fas fa-stop-circle"></i> Same government filing fee covers included children</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection