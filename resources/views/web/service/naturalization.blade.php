@extends('web.layout.master')
@section('content')
    @include('web.component.bread-crumb', [
        'title' => 'Naturalization',
        'previousPageLink' => route('service'),
        'previousPageTitle' => 'Services',
    ])
    
    <section class="about-us ptb-115">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="about-img-block aos-init" data-aos="fade-left">
                        <img src="{{ asset('assets/img/aboutimg1.jpg') }}" alt="U.S. Naturalization">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-content aos-init" data-aos="fade-right">
                        <div class="section-title">
                            <h3>What Is Naturalization?</h3>
                        </div>
                        <p>Naturalization is the process by which lawful permanent residents (green card holders) become United States citizens. This process grants you all the rights and privileges of U.S. citizenship, including the right to vote, serve on juries, and obtain a U.S. passport.</p>
                        <p>As a naturalized citizen, you can also petition for family members to immigrate to the United States and are protected from deportation (except in very rare circumstances involving fraud in the naturalization process).</p>
                        
                        <h5>Benefits of U.S. Citizenship</h5>
                        <ul>
                            <li>Right to vote in federal, state, and local elections</li>
                            <li>Ability to run for elected office (except President/Vice President)</li>
                            <li>Protection from deportation</li>
                            <li>Priority in petitioning family members</li>
                            <li>Eligibility for federal jobs requiring citizenship</li>
                            <li>U.S. passport for international travel</li>
                        </ul>
                        
                        <h5>Processing Time</h5>
                        <p>Current naturalization processing times range from 12-18 months from application to oath ceremony, depending on your location and case complexity.</p>
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
                            <h3>Naturalization Requirements</h3>
                        </div>
                        
                        <h5>Basic Eligibility Requirements:</h5>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Must be at least 18 years old</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Lawful permanent resident for at least 5 years (3 years if married to U.S. citizen)</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Physical presence in the U.S. for at least 30 months out of 5 years (18 months out of 3 years)</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Continuous residence in the U.S. (no trips outside U.S. longer than 6 months)</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Residence in the state where applying for at least 3 months</p>
                        </div>
                        
                        <h5>Additional Requirements:</h5>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Good moral character</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Basic knowledge of U.S. history and civics</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Basic English language skills (speaking, reading, writing)</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Attachment to the principles of the U.S. Constitution</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-img-block aos-init" data-aos="fade-left">
                        <img src="{{ asset('assets/img/aboutimg22.jpg') }}" alt="Citizenship Requirements">
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
                        <img src="{{ asset('assets/img/service11.jpg') }}" alt="Why Choose Us">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-content aos-init" data-aos="fade-right">
                        <div class="section-title">
                            <h3>Why Choose Us for Naturalization?</h3>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Comprehensive eligibility assessment</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Complete Form N-400 preparation</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Document collection and organization</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Civics and history test preparation</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>English test preparation and practice</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Interview preparation and mock interviews</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Case tracking from filing to oath ceremony</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Support for complex cases (criminal history, tax issues)</p>
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
                            <h5>How difficult is the naturalization test?</h5>
                            <p>The test consists of English and civics components. The English test includes speaking (during your interview), reading, and writing. The civics test covers U.S. history and government. With proper preparation, most applicants pass. We provide comprehensive test preparation materials and practice sessions.</p>
                        </div>
                        <div class="question">
                            <h5>What if I have a criminal record?</h5>
                            <p>Not all criminal records prevent naturalization, but they require careful analysis. Factors include the type of offense, when it occurred, and rehabilitation efforts. We evaluate each case individually and can advise on the best approach.</p>
                        </div>
                        <div class="question">
                            <h5>Can I keep my original citizenship?</h5>
                            <p>The U.S. requires you to renounce other citizenships during naturalization, but some countries allow dual citizenship. Check with your home country's embassy about their policies on dual citizenship.</p>
                        </div>
                        <div class="question">
                            <h5>What if I fail the naturalization test?</h5>
                            <p>If you fail, you get a second chance to take the portion you failed. We provide additional preparation and support for the retake. Most applicants pass on their second attempt with proper preparation.</p>
                        </div>
                        <div class="question">
                            <h5>How soon can I apply for naturalization?</h5>
                            <p>You can apply 90 days before meeting the residency requirement (5 years as LPR, or 3 years if married to U.S. citizen). This allows for processing time so you can naturalize as soon as eligible.</p>
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
                    <h3>Our Naturalization Package</h3>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Complete eligibility review and timeline analysis</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Form N-400 preparation and filing</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Document collection and organization</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Civics test preparation materials and practice</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>English test preparation and tutoring</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Mock interviews and preparation sessions</p>
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
                            <h5 class="primary-color">NATURALIZATION</h5>
                            <sup>$</sup>
                            <span class="price">850</span>
                            <a href="javascript:void(0)" class="p-md" data-bs-toggle="modal"
                                data-bs-target="#naturalizationModal">+ Gov. Fees</a>
                        </div>
                        <ul class="features">
                            <li><i class="fas fa-stop-circle"></i> Eligibility Assessment</li>
                            <li><i class="fas fa-stop-circle"></i> Form N-400 Preparation</li>
                            <li><i class="fas fa-stop-circle"></i> Document Package Assembly</li>
                            <li><i class="fas fa-stop-circle"></i> Civics Test Prep Materials</li>
                            <li><i class="fas fa-stop-circle"></i> English Test Preparation</li>
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

    <!-- Naturalization Pricing Modal -->
    <div class="modal fade" id="naturalizationModal" tabindex="-1" aria-labelledby="naturalizationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="naturalizationModalLabel">Naturalization Package Pricing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="cbox-3-txt mb-2">
                        <h5>Our Service Fee</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> $850 Service Fee to Filipina Fiancée Visa</li>
                        </ul>
                    </div>
                    <div class="cbox-3-txt mb-2">
                        <h5>Government Fees:</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> $760 USCIS Filing Fee (Form N-400)</li>
                            <li><i class="fas fa-stop-circle"></i> $85 Biometrics Fee</li>
                            <li><i class="fas fa-stop-circle"></i> $1,695 Total Fees</li>
                        </ul>
                    </div>
                    <div class="cbox-3-txt mb-2">
                        <h5>What's Included:</h5>
                        <ul>
                            <li><i class="fas fa-check"></i> Complete eligibility assessment</li>
                            <li><i class="fas fa-check"></i> Form N-400 preparation and review</li>
                            <li><i class="fas fa-check"></i> Document collection checklist</li>
                            <li><i class="fas fa-check"></i> Civics test study materials (100 questions)</li>
                            <li><i class="fas fa-check"></i> English test preparation resources</li>
                            <li><i class="fas fa-check"></i> Mock interview sessions</li>
                            <li><i class="fas fa-check"></i> Case tracking through oath ceremony</li>
                            <li><i class="fas fa-check"></i> Support for complex issues</li>
                        </ul>
                    </div>
                    <div class="cbox-3-txt">
                        <h5>Fee Reductions Available:</h5>
                        <p><small>Some applicants may qualify for reduced fees based on household income or active military status. We'll evaluate your eligibility during consultation.</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection