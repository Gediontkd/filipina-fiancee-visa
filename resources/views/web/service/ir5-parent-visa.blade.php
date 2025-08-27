@extends('web.layout.master')
@section('content')
    @include('web.component.bread-crumb', [
        'title' => 'IR5 Parent Visa',
        'previousPageLink' => route('service'),
        'previousPageTitle' => 'Services',
    ])
    
    <section class="about-us ptb-115">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="about-img-block aos-init" data-aos="fade-left">
                        <img src="{{ asset('assets/img/aboutimg3.jpg') }}" alt="IR5 Parent Visa">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-content aos-init" data-aos="fade-right">
                        <div class="section-title">
                            <h3>What Is an IR5 Parent Visa?</h3>
                        </div>
                        <p>The IR5 visa is an immigrant visa category for parents of U.S. citizens who are at least 21 years old. IR5 stands for "Immediate Relative 5" and allows U.S. citizens to petition for their biological or adoptive parents to become lawful permanent residents of the United States.</p>
                        <p>This visa category has no annual numerical limitations, meaning there are no waiting periods or quotas. Once approved, your parents will receive their green cards and can live permanently in the United States.</p>
                        
                        <h5>Who Can Petition for Parents?</h5>
                        <p>Only U.S. citizens who are at least 21 years old can petition for their parents. Lawful permanent residents (green card holders) cannot petition for their parents under this category.</p>
                        
                        <h5>Processing Time</h5>
                        <p>Current processing times for IR5 parent visas range from 12-18 months from the initial filing to visa issuance, depending on the country of origin and case complexity.</p>
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
                            <h3>Eligibility Requirements</h3>
                        </div>
                        <p>To successfully petition for your parents, you must meet these requirements:</p>
                        
                        <h5>For the U.S. Citizen Petitioner:</h5>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Must be a U.S. citizen (not just a permanent resident)</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Must be at least 21 years old</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Must meet income requirements (usually 125% of federal poverty guidelines)</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Must be able to provide financial support (Affidavit of Support)</p>
                        </div>
                        
                        <h5>For the Parent(s):</h5>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Must be the biological or legally adoptive parent of the petitioner</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Must pass medical examination</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-check"></i></div>
                            <p>Must have no disqualifying criminal history</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-img-block aos-init" data-aos="fade-left">
                        <img src="{{ asset('assets/img/aboutimg4.jpg') }}" alt="Parent Visa Requirements">
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
                            <h3>Why Choose Us for Your Parent Visa?</h3>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Extensive experience with IR5 parent petitions</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Complete Form I-130 preparation and filing</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Affidavit of Support (Form I-864) preparation</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Document collection and organization guidance</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>National Visa Center (NVC) processing support</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Embassy interview preparation</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Medical examination guidance</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Case tracking from start to finish</p>
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
                            <h5>Can I petition for both parents at the same time?</h5>
                            <p>Yes, you can file separate Form I-130 petitions for each parent simultaneously. Each parent needs their own petition, but the process can be done concurrently.</p>
                        </div>
                        <div class="question">
                            <h5>What if my parents are divorced?</h5>
                            <p>You can still petition for both parents separately, even if they are divorced. Each parent qualifies independently based on their relationship to you.</p>
                        </div>
                        <div class="question">
                            <h5>Can my parents work in the U.S. with an IR5 visa?</h5>
                            <p>Yes, IR5 visa holders receive permanent resident status (green cards) and can work legally in the United States without needing a separate work authorization.</p>
                        </div>
                        <div class="question">
                            <h5>What happens if my parent has a criminal record?</h5>
                            <p>Criminal history doesn't automatically disqualify someone, but it requires careful evaluation. Some offenses may require waivers or could prevent approval. We evaluate each case individually.</p>
                        </div>
                        <div class="question">
                            <h5>Do my parents need to speak English?</h5>
                            <p>No, there is no English language requirement for IR5 parent visas. However, having basic English can help with daily life in the United States.</p>
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
                    <h3>Our IR5 Parent Visa Package</h3>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Complete Form I-130 preparation and filing</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Form I-864 Affidavit of Support preparation</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Document checklist and organization</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>NVC processing support and guidance</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Embassy interview preparation</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Medical examination coordination</p>
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
                            <h5 class="primary-color">IR5 PARENT VISA</h5>
                            <sup>$</sup>
                            <span class="price">800</span>
                            <a href="javascript:void(0)" class="p-md" data-bs-toggle="modal"
                                data-bs-target="#ir5Modal">+ Gov. Fees</a>
                        </div>
                        <ul class="features">
                            <li><i class="fas fa-stop-circle"></i> Form I-130 Preparation & Filing</li>
                            <li><i class="fas fa-stop-circle"></i> Affidavit of Support (I-864)</li>
                            <li><i class="fas fa-stop-circle"></i> Document Package Assembly</li>
                            <li><i class="fas fa-stop-circle"></i> NVC Processing Support</li>
                            <li><i class="fas fa-stop-circle"></i> Embassy Interview Prep</li>
                            <li><i class="fas fa-stop-circle"></i> Case Tracking & Updates</li>
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

    <!-- IR5 Pricing Modal -->
    <div class="modal fade" id="ir5Modal" tabindex="-1" aria-labelledby="ir5ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ir5ModalLabel">IR5 Parent Visa Package Pricing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="cbox-3-txt mb-2">
                        <h5>Our Service Fee (Per Parent)</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> $800 Service Fee to Filipina Fiancée Visa (per parent)</li>
                        </ul>
                    </div>
                    <div class="cbox-3-txt mb-2">
                        <h5>Government Fees (Per Parent):</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> $675 USCIS Filing Fee (Form I-130)</li>
                            <li><i class="fas fa-stop-circle"></i> $445 National Visa Center Processing Fee</li>
                            <li><i class="fas fa-stop-circle"></i> $495 Medical Examination Fee</li>
                            <li><i class="fas fa-stop-circle"></i> $220 USCIS Immigrant Fee (after approval)</li>
                            <li><i class="fas fa-stop-circle"></i> $2,635 Total Fees Per Parent</li>
                        </ul>
                    </div>
                    <div class="cbox-3-txt mb-2">
                        <h5>For Both Parents:</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> $1,600 Total Service Fee (both parents)</li>
                            <li><i class="fas fa-stop-circle"></i> $3,470 Total Government Fees (both parents)</li>
                            <li><i class="fas fa-stop-circle"></i> $5,070 Grand Total for Both Parents</li>
                        </ul>
                    </div>
                    <div class="cbox-3-txt">
                        <p><small>Note: You can petition for both parents simultaneously, but each requires separate forms and fees.</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection