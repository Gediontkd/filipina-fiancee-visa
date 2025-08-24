@extends('web.layout.master')
@section('content')
    @include('web.component.bread-crumb', [
        'title' => 'Fiancee Visa',
        'previousPageLink' => route('service'),
        'previousPageTitle' => 'Services',
    ])
    <section class="about-us ptb-115">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="about-img-block aos-init" data-aos="fade-left">
                        <img src="{{ asset('assets/img/aboutimg2.jpg') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-content aos-init" data-aos="fade-right">
                        <div class="section-title">
                            <h3>What Is a Fiancee Visa?</h3>
                        </div>
                        <p>A fiancé visa / fiancée visa, called K-1 visa, is a nonimmigrant visa which allows foreigners who
                            are engaged to United States citizens to travel to America to get married. The word fiancé
                            refers to a male, and the word fiancée refers to a female. The wedding must occur within 90 days
                            of arrival in the United States. A fiancé visa is the fastest and easiest visa that you can get
                            to bring your fiancée to the United States. To do a fiance visa you must be a US Citizen, they
                            are not available to Permanent Residents. You must both be legally single, with no divorces or
                            annulments pending at the time of filing. Being legally separated does not qualify.
                        </p>
                        <h5>How Long will it Take to get a Fiancee Visa?</h5>
                        <p>Currently, it is taking about 9-12 months to get a fiancee visa from the date of filing.
                        </p>
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
                            <h3>When Should You Get Started?</h3>
                        </div>
                        <p>We HIGHLY recommend signing up for our service 1-2 months prior to your trip to meet your foreign
                            fiancée, so we can get a head start on all the fiancée visa paperwork and this will result in
                            your fiancée being here sooner! This way you will get started right and avoid costly mistakes
                            from the very beginning.</p>
                        <p>Note: It is NOT necessary that your foreign fiancée have his or her passport for your petition to
                            be filed. They won't need their passport for several months after filing.</p>
                        <h5>How long must we be in a relationship to file for a fiancee visa?</h5>
                        <p>Many people are confused about this. The law does NOT say that you must have had a 2- year
                            relationship, it says that you must have met in person in the 2 years (24 months) prior to the
                            filing of the fiancée visa petition. Even if you have only known each other for 1 month we can
                            still get you a fiancee visa.</p>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-img-block aos-init" data-aos="fade-left">
                        <img src="{{ asset('assets/img/aboutimg7.jpg') }}">
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
                        <img src="{{ asset('assets/img/aboutimg1.jpg') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-content aos-init" data-aos="fade-right">
                        <div class="section-title">
                            <h3>Why Choose Us ?</h3>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p> We are experts with the Philippines</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p> We prepare all the forms…all you do is sign them</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p> We stay with you from beginning to end</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p> A long history of success: 20+ years</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p> We have helped thousands of couples</p>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p> We have a 100% Success Rate</p>
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
                            <h5>Do you have to meet your fiancee in person before you can get a Fiancee Visa?</h5>
                            <p>Yes, this is a requirement. They may grant you an exception if you have a serious medical
                                condition that prevents you from flying.</p>
                        </div>
                        <div class="question">
                            <h5>Can children of your fiancee be included?</h5>
                            <p>Children of your fiancee can be included on their petition. The children have the option to
                                either accompany their parent or join their parent within one year from the visa’s date of
                                issuance. To qualify the children are required to be unmarried and under 21 years of age.
                            </p>
                        </div>
                        <div class="question">
                            <h5>Can Same-Sex couples get a Fiancee Visa?</h5>
                            <p>Yes. U.S. Citizens can now sponsor their same-sex spouse or same-sex fiancée. This has now
                                been expanded to include sponsoring children of same-sex marriages. Filipina Fiancée Visa is
                                ready to prepare your same-sex fiancé visa petition or same-sex spouse visa petition.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="resources_topics">
                        <ul class="list-unstyled tag_list">
                            <li>
                                <a href="{{ route('resource.page', 'income-requirement') }}">
                                    <img src="{{ asset('assets/img/document2.png') }}">
                                    What are the income requirements for a Fiancee Visa?
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('resource.page', 'requirement-for-fiancee-visa') }}">
                                    <img src="{{ asset('assets/img/document2.png') }}">
                                    What are the requirements to get a K1 Fiancee Visa?
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('resource.page', 'required-documents-for-fiancee-visa') }}">
                                    <img src="{{ asset('assets/img/document2.png') }}">
                                    What documents are required to get a Fiancee Visa?
                                </a>
                            </li>
                        </ul>
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
                    <h3>Our Fiancee Visa Package</h3>
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
                            <h5 class="primary-color">FIANCEE VISA (K1)</h5>
                            <sup>$</sup>
                            <span class="price">850</span>
                            <a href="javascript:void(0)" class="p-md" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">+ Gov. Fees</a>
                        </div>
                        <ul class="features">
                            <li><i class="fas fa-stop-circle"></i> Full Support Start To Finish</li>
                            <li><i class="fas fa-stop-circle"></i> Unlimited Phone Support</li>
                            <li><i class="fas fa-stop-circle"></i> Unlimited Email Support</li>
                            <li><i class="fas fa-stop-circle"></i> Prepare All Government Forms</li>
                            <li><i class="fas fa-stop-circle"></i> Online Petition Tracking</li>
                            <li><i class="fas fa-stop-circle"></i> Children Are Free</li>
                        </ul>
                        {{ Form::open(['url' => route('payment'), 'method' => 'GET']) }}
                        {!! Form::hidden('user_id', Auth::id()) !!}
                        {!! Form::hidden('application_id', 1) !!}
                        {!! Form::hidden('route', 'fianceSponsorApplication') !!}
                        {!! Form::hidden('price', 800) !!}
                        {{ Form::submit('Get Started', ['class' => 'btn btn-tra-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">FIANCEE VISA (K1)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="cbox-3-txt mb-2">
                        <h5>Fees for a Fiancee Visa</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> $850 Service Fee to Filipina Fiancée Visa (Paid upfront to start your petition)</li>
                        </ul>
                    </div>
                    <div class="cbox-3-txt mb-2">
                        <h5>Government Fees:</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> $675 USCIS Filing Fee (Paid when petition is filed)</li>
                            <li><i class="fas fa-stop-circle"></i> $495 Medical Examination Fee (Due later in the process)
                            </li>
                            <li><i class="fas fa-stop-circle"></i> $265 U.S. Embassy Visa Fee (Due before the interview)</li>
                            <li><i class="fas fa-stop-circle"></i> $2,285 Total Fees</li>
                        </ul>
                    </div>
                    <div class="cbox-3-txt mb-2">
                        <h5>Extra Fees Per Child to be Included</h5>
                        <h5>Government Fees:</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> $200 Service Fee to Filipina Fiancée Visa</li>
                            <li><i class="fas fa-stop-circle"></i> $240 Child Medical Exam</li>
                            <li><i class="fas fa-stop-circle"></i> $265 Embassy Visa Fee</li>
                            <li><i class="fas fa-stop-circle"></i> $705 Total Fees Per Child</li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
