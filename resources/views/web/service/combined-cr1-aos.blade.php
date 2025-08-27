@extends('web.layout.master')
@section('content')
    @include('web.component.bread-crumb', [
        'title' => 'Special Combined CR-1 + AOS',
        'previousPageLink' => route('service'),
        'previousPageTitle' => 'Services',
    ])
    
    <section class="about-us ptb-115">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="about-img-block aos-init" data-aos="fade-left">
                        <img src="{{ asset('assets/img/marry-usa-onboard.png') }}" alt="Marry on Tourist Visa">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-content aos-init" data-aos="fade-right">
                        <div class="section-title">
                            <h3>What Is the "Marry-on-Tourist-Visa" Package?</h3>
                        </div>
                        <p>This special combined package is designed for couples where the foreign partner is already in the United States on a tourist visa (B-1/B-2) and you want to get married and apply for permanent residence without the foreign partner having to return to their home country.</p>
                        <p>This process combines elements of both spouse visa processing and adjustment of status, allowing your spouse to remain in the U.S. throughout the entire process once properly married and the adjustment application is filed.</p>
                        
                        <div class="alert alert-warning">
                            <h6><i class="fas fa-exclamation-triangle"></i> Important Legal Considerations</h6>
                            <p><strong>Intent Matters:</strong> The foreign partner must not have entered the U.S. with the preconceived intent to marry and stay permanently, as this would constitute visa fraud. The decision to marry should have developed after legal entry to the U.S.</p>
                        </div>
                        
                        <h5>How This Package Works</h5>
                        <p>We guide you through the proper legal process of marrying in the U.S. and then filing for adjustment of status, ensuring compliance with all immigration laws while maximizing your chances of success.</p>
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
                            <h3>Process Overview & Requirements</h3>
                        </div>
                        
                        <h5>Step-by-Step Process:</h5>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-heart"></i></div>
                            <p><strong>Step 1:</strong> Legal marriage in the United States</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-file-alt"></i></div>
                            <p><strong>Step 2:</strong> File Form I-130 (Immigrant Petition for Alien Relative)</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-id-card"></i></div>
                            <p><strong>Step 3:</strong> Simultaneously file Form I-485 (Adjustment of Status)</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-briefcase"></i></div>
                            <p><strong>Step 4:</strong> File Form I-765 (Work Authorization - Optional)</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-plane"></i></div>
                            <p><strong>Step 5:</strong> File Form I-131 (Travel Document - Optional)</p>
                        </div>
                        
                        <h5>Key Requirements:</h5>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Foreign partner must be in valid legal status when married</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Evidence that intent to marry developed after U.S. entry</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Bona fide marriage documentation</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Financial support documentation (I-864)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-img-block aos-init" data-aos="fade-left">
                        <img src="{{ asset('assets/img/wedding2.jpg') }}" alt="Legal Marriage Process">
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
                        <img src="{{ asset('assets/img/aboutimg1.jpg') }}" alt="Why Choose Us">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-content aos-init" data-aos="fade-right">
                        <div class="section-title">
                            <h3>Why Choose Our Combined Package?</h3>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Expert navigation of complex legal requirements</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Comprehensive intent documentation strategy</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Complete preparation of all required forms</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Marriage relationship evidence compilation</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Work authorization application (EAD)</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Travel document application (Advance Parole)</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Interview preparation and support</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Case tracking through green card approval</p>
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
                            <h5>Is it legal to marry on a tourist visa?</h5>
                            <p>Yes, it's legal to get married while on a tourist visa. However, the key legal issue is intent. The foreign partner must not have entered the U.S. with the preconceived intent to marry and immigrate, as this would constitute visa fraud. The decision to marry should have developed after legal entry.</p>
                        </div>
                        <div class="question">
                            <h5>What's the difference between this and a K-1 fiancé visa?</h5>
                            <p>With a K-1 visa, you petition before marriage, your fiancé comes specifically to marry, and you must wed within 90 days. With this package, the foreign partner is already in the U.S. legally, you marry here, and then adjust status. This can be faster if they're already in the U.S. legally.</p>
                        </div>
                        <div class="question">
                            <h5>How do we prove our intent wasn't fraudulent?</h5>
                            <p>We help document the evolution of your relationship, showing that the decision to marry developed after the U.S. entry. This includes correspondence, photos, timeline documentation, and witness statements that demonstrate the genuine progression of your relationship.</p>
                        </div>
                        <div class="question">
                            <h5>Can my spouse work while the case is pending?</h5>
                            <p>Yes, we include the I-765 work authorization application in our package. This typically allows your spouse to work within 3-5 months of filing the adjustment application.</p>
                        </div>
                        <div class="question">
                            <h5>Can my spouse travel while the case is pending?</h5>
                            <p>With advance parole (I-131), which we include in the package, your spouse can travel internationally and return to the U.S. However, travel should be carefully planned and we provide guidance on the risks and requirements.</p>
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
                    <h3>Our Combined CR-1 + AOS Package</h3>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Legal analysis and strategy consultation</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Intent documentation and evidence compilation</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Form I-130 and I-485 preparation and filing</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Work authorization (I-765) application</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Travel document (I-131) application</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Affidavit of Support (I-864) preparation</p>
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
                            <h5 class="primary-color">COMBINED CR-1 + AOS</h5>
                            <sup>$</sup>
                            <span class="price">1200</span>
                            <a href="javascript:void(0)" class="p-md" data-bs-toggle="modal"
                                data-bs-target="#combinedModal">+ Gov. Fees</a>
                        </div>
                        <ul class="features">
                            <li><i class="fas fa-stop-circle"></i> Legal Strategy & Analysis</li>
                            <li><i class="fas fa-stop-circle"></i> I-130 & I-485 Preparation</li>
                            <li><i class="fas fa-stop-circle"></i> Work Authorization (I-765)</li>
                            <li><i class="fas fa-stop-circle"></i> Travel Document (I-131)</li>
                            <li><i class="fas fa-stop-circle"></i> Affidavit of Support (I-864)</li>
                            <li><i class="fas fa-stop-circle"></i> Interview Preparation</li>
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

    <!-- Combined Package Pricing Modal -->
    <div class="modal fade" id="combinedModal" tabindex="-1" aria-labelledby="combinedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="combinedModalLabel">Combined CR-1 + AOS Package Pricing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="cbox-3-txt mb-2">
                        <h5>Our Service Fee</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> $1,200 Service Fee to Filipina Fiancée Visa</li>
                            <li><i class="fas fa-info-circle"></i> <small>Includes all forms and comprehensive support</small></li>
                        </ul>
                    </div>
                    <div class="cbox-3-txt mb-2">
                        <h5>Government Fees:</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> $675 I-130 Filing Fee (Immigrant Petition)</li>
                            <li><i class="fas fa-stop-circle"></i> $1,440 I-485 Filing Fee (Adjustment of Status)</li>
                            <li><i class="fas fa-stop-circle"></i> $410 I-765 Filing Fee (Work Authorization)</li>
                            <li><i class="fas fa-stop-circle"></i> $630 I-131 Filing Fee (Travel Document)</li>
                            <li><i class="fas fa-stop-circle"></i> $85 Biometrics Fee</li>
                            <li><i class="fas fa-stop-circle"></i> $220 USCIS Immigrant Fee (after approval)</li>
                            <li><i class="fas fa-stop-circle"></i> $4,660 Total Government Fees</li>
                            <li><i class="fas fa-calculator"></i> <strong>$5,860 Grand Total</strong></li>
                        </ul>
                    </div>
                    <div class="cbox-3-txt mb-2">
                        <h5>Package Includes:</h5>
                        <ul>
                            <li><i class="fas fa-check"></i> Initial legal consultation and case analysis</li>
                            <li><i class="fas fa-check"></i> Intent documentation strategy</li>
                            <li><i class="fas fa-check"></i> All required form preparation and filing</li>
                            <li><i class="fas fa-check"></i> Marriage evidence compilation</li>
                            <li><i class="fas fa-check"></i> Financial support documentation</li>
                            <li><i class="fas fa-check"></i> Interview preparation and support</li>
                            <li><i class="fas fa-check"></i> Case tracking through approval</li>
                        </ul>
                    </div>
                    <div class="alert alert-info">
                        <small><strong>Note:</strong> This package is only appropriate for couples where the foreign partner is currently in the U.S. in valid legal status. A consultation is required to determine eligibility.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection