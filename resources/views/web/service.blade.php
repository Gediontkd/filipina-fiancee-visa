<!-- resources\views\web\service.blade.php -->
@extends('web.layout.master')
@section('content')
    @include('web.component.bread-crumb', [
        'title' => 'Services',
    ])
    <section class="services ptb-60 bg-lightgrey">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 section-title text-center">
                    <h3>Our Immigration Services</h3>
                    <p>Comprehensive immigration solutions with 20+ years of experience and a 99% approval rate</p>
                </div>
            </div>
            <div class="row">
                <!-- Primary Services -->
                <div class="col-lg-4 col-md-6 col-sm-12 service-main">
                    <div class="service-block">
                        <div class="inner-box">
                            <figure class="image-box">
                                <a href="{{ route('fiancee.visa') }}">
                                    <img src="{{ asset('assets/img/service1.jpg') }}" alt="K-1 Fiancé Visa">
                                </a>
                            </figure>
                            <div class="lower-content">
                                <div class="box">
                                    <div class="icon-box">
                                        <img src="{{ asset('assets/img/icons/service-icon-1.png') }}">
                                    </div>
                                    <h3>
                                        <a href="{{ route('fiancee.visa') }}">K-1 FIANCÉ(E) VISA</a>
                                    </h3>
                                    <p>A K-1 fiancé(e) visa allows foreign nationals engaged to U.S. citizens to travel to America to get married. The fastest way to bring your fiancé(e) to the United States.</p>
                                </div>
                                <div class="link">
                                    <a href="{{ route('fiancee.visa') }}">Learn More<i class="fa fa-long-arrow-alt-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 service-main">
                    <div class="service-block">
                        <div class="inner-box">
                            <figure class="image-box">
                                <a href="{{ route('spouse.visa') }}">
                                    <img src="{{ asset('assets/img/service3.jpg') }}" alt="CR-1 Spouse Visa">
                                </a>
                            </figure>
                            <div class="lower-content">
                                <div class="box">
                                    <div class="icon-box">
                                        <img src="{{ asset('assets/img/icons/service-icon-3.png') }}">
                                    </div>
                                    <h3>
                                        <a href="{{ route('spouse.visa') }}">CR-1/IR-1 SPOUSE VISA</a>
                                    </h3>
                                    <p>A CR-1 visa is an immigrant visa for spouses of U.S. citizens or permanent residents. Your spouse gets a green card immediately upon entry to the United States.</p>
                                </div>
                                <div class="link">
                                    <a href="{{ route('spouse.visa') }}">Learn More<i class="fa fa-long-arrow-alt-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 service-main">
                    <div class="service-block">
                        <div class="inner-box">
                            <figure class="image-box">
                                <a href="{{ route('adjustment.visa') }}">
                                    <img src="{{ asset('assets/img/service2.jpg') }}" alt="Adjustment of Status">
                                </a>
                            </figure>
                            <div class="lower-content">
                                <div class="box">
                                    <div class="icon-box">
                                        <img src="{{ asset('assets/img/icons/service-icon-2.png') }}">
                                    </div>
                                    <h3>
                                        <a href="{{ route('adjustment.visa') }}">ADJUSTMENT OF STATUS</a>
                                    </h3>
                                    <p>After marriage in the U.S., file for adjustment of status to obtain your green card without leaving the United States. Required within 90 days of K-1 entry.</p>
                                </div>
                                <div class="link">
                                    <a href="{{ route('adjustment.visa') }}">Learn More<i class="fa fa-long-arrow-alt-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Services -->
                <div class="col-lg-4 col-md-6 col-sm-12 service-main">
                    <div class="service-block">
                        <div class="inner-box">
                            <figure class="image-box">
                                <a href="{{ route('removal.conditions') }}">
                                    <img src="{{ asset('assets/img/aboutimg2.jpg') }}" alt="Removal of Conditions">
                                </a>
                            </figure>
                            <div class="lower-content">
                                <div class="box">
                                    <div class="icon-box">
                                        <i class="fas fa-file-contract" style="font-size: 2rem; color: #667eea;"></i>
                                    </div>
                                    <h3>
                                        <a href="{{ route('removal.conditions') }}">REMOVAL OF CONDITIONS (ROC)</a>
                                    </h3>
                                    <p>Remove the conditions on your permanent resident status obtained through marriage. File Form within 90 days before your conditional green card expires.</p>
                                </div>
                                <div class="link">
                                    <a href="{{ route('removal.conditions') }}">Learn More<i class="fa fa-long-arrow-alt-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 service-main">
                    <div class="service-block">
                        <div class="inner-box">
                            <figure class="image-box">
                                <a href="{{ route('ir5.parent.visa') }}">
                                    <img src="{{ asset('assets/img/aboutimg3.jpg') }}" alt="IR5 Parent Visa">
                                </a>
                            </figure>
                            <div class="lower-content">
                                <div class="box">
                                    <div class="icon-box">
                                        <i class="fas fa-users" style="font-size: 2rem; color: #667eea;"></i>
                                    </div>
                                    <h3>
                                        <a href="{{ route('ir5.parent.visa') }}">IR5 PARENT VISA</a>
                                    </h3>
                                    <p>U.S. citizens over 21 can petition for their parents to become permanent residents. No waiting period or annual quotas for immediate relatives.</p>
                                </div>
                                <div class="link">
                                    <a href="{{ route('ir5.parent.visa') }}">Learn More<i class="fa fa-long-arrow-alt-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 service-main">
                    <div class="service-block">
                        <div class="inner-box">
                            <figure class="image-box">
                                <a href="{{ route('petition.child') }}">
                                    <img src="{{ asset('assets/img/aboutimg5.jpg') }}" alt="Child Petition">
                                </a>
                            </figure>
                            <div class="lower-content">
                                <div class="box">
                                    <div class="icon-box">
                                        <i class="fas fa-baby" style="font-size: 2rem; color: #667eea;"></i>
                                    </div>
                                    <h3>
                                        <a href="{{ route('petition.child') }}">PETITION A CHILD</a>
                                    </h3>
                                    <p>Petition for your biological, step, or adopted children to immigrate to the United States. Various categories available based on age and marital status.</p>
                                </div>
                                <div class="link">
                                    <a href="{{ route('petition.child') }}">Learn More<i class="fa fa-long-arrow-alt-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 service-main">
                    <div class="service-block">
                        <div class="inner-box">
                            <figure class="image-box">
                                <a href="{{ route('naturalization') }}">
                                    <img src="{{ asset('assets/img/aboutimg1.jpg') }}" alt="Naturalization">
                                </a>
                            </figure>
                            <div class="lower-content">
                                <div class="box">
                                    <div class="icon-box">
                                        <i class="fas fa-flag-usa" style="font-size: 2rem; color: #667eea;"></i>
                                    </div>
                                    <h3>
                                        <a href="{{ route('naturalization') }}">NATURALIZATION</a>
                                    </h3>
                                    <p>Become a U.S. citizen through naturalization. Includes test preparation, application filing, and interview support for permanent residents.</p>
                                </div>
                                <div class="link">
                                    <a href="{{ route('naturalization') }}">Learn More<i class="fa fa-long-arrow-alt-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 service-main">
                    <div class="service-block">
                        <div class="inner-box">
                            <figure class="image-box">
                                <a href="{{ route('combined.cr1.aos') }}">
                                    <img src="{{ asset('assets/img/marry-usa-onboard.png') }}" alt="Combined CR-1 + AOS">
                                </a>
                            </figure>
                            <div class="lower-content">
                                <div class="box">
                                    <div class="icon-box">
                                        <i class="fas fa-handshake" style="font-size: 2rem; color: #667eea;"></i>
                                    </div>
                                    <h3>
                                        <a href="{{ route('combined.cr1.aos') }}">SPECIAL COMBINED CR-1 + AOS</a>
                                    </h3>
                                    <p>Marry-on-tourist-visa package for couples where the foreign partner is already in the U.S. legally and wants to adjust status after marriage.</p>
                                </div>
                                <div class="link">
                                    <a href="{{ route('combined.cr1.aos') }}">Learn More<i class="fa fa-long-arrow-alt-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

            <!-- Call to Action Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="cta-section text-center p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px; color: white;">
                        <h4>Not Sure Which Service You Need?</h4>
                        <p class="mb-3">Our immigration experts are here to help you determine the best path forward for your unique situation.</p>
                        <a href="{{ route('contactUs') }}" class="btn btn-light btn-lg">Get Free Consultation</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection