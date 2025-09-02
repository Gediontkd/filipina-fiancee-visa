@extends('web.layout.master')
@section('content')
    @include('web.component.bread-crumb', [
        'title' => 'Petition a Child',
        'previousPageLink' => route('service'),
        'previousPageTitle' => 'Services',
    ])
    
    <section class="about-us ptb-115">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="about-img-block aos-init" data-aos="fade-left">
                        <img src="{{ asset('assets/img/Mother-and-Child.jpg') }}" alt="Child Petition">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-content aos-init" data-aos="fade-right">
                        <div class="section-title">
                            <h3>What Is a Child Petition?</h3>
                        </div>
                        <p>A Child Petition is the process that allows U.S. citizens and lawful permanent residents 
(green card holders) to bring their children to live in the United States. The type of petition 
and waiting time depend on:</p>
<ul>
                            <li><strong></strong> Your immigration status (U.S. citizen or permanent resident)</li>
                            <li><strong></strong> Your child’s age</li>
                            <li><strong></strong> Whether your child is married or unmarried</li>
                        </ul>
                        <p>For U.S. citizens, certain categories are considered immediate relatives and have no 
waiting period beyond standard processing. For permanent residents, petitions fall under 
family preference categories, which often involve waiting periods. </p>
                        
                        <h5>Types of Child Petitions</h5>
                        <p><strong>For U.S. Citizens:</strong></p>
                        <ul>
                            <li><strong>IR2:</strong> Unmarried children under 21 (no waiting period)</li>
                            <li><strong>F1:</strong> Unmarried children over 21 (waiting period applies)</li>
                            <li><strong>F3:</strong> Married children of any age (waiting period applies)</li>
                        </ul>
                        
                        <p><strong>For Permanent Residents:</strong></p>
                        <ul>
                            <li><strong>F2A:</strong> Unmarried children under 21 (shorter waiting period)</li>
                            <li><strong>F2B:</strong> Unmarried children over 21 (longer waiting period)</li>
                        </ul>
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
                        
                        <h5>Who Qualifies as a "Child"?</h5>
                        <p>To qualify as a “child” under U.S. immigration law, your child must be:</p>
                        <ul>
                            <li><strong></strong> Your biological child, stepchild, or legally adopted child</li>
                            <li><strong></strong> Unmarried (for IR2, F2A categories)</li>
                            <li><strong></strong> Under 21 years old (for immediate relative categories)</li>

                        </ul>
                        <h5>Special Considerations</h5>
                         <ul>
                            <li><strong>Age Protection (CSPA):</strong> The Child Status Protection Act can sometimes “freeze” a 
child’s age to prevent them from aging out due to processing delays.</li>
                
                            <li><strong>Stepchildren:</strong> You must have married the child’s biological parent before the child’s 
18th birthday. </li>

                            <li><strong>Adopted Children:</strong>  Adoption must be finalized before the child’s 16th birthday (or 
18th if adopted with a sibling).</li>

                        </ul>
                        
                        <h5>Financial Requirements</h5>
                        <p>You must show that you can financially support your child at 125% of the federal poverty 
guidelines by filing Form I-864, Affidavit of Support.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-img-block aos-init" data-aos="fade-left">
                        <img src="{{ asset('assets/img/EligibilityRequirementsNewPic.jpg') }}" alt="Child Visa Requirements">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Get Started Section --}}
    @if (!Auth::check())
        @include('web.component.child-button')
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
                            <h3>Why Choose Us for Child Petitions?</h3>
                        </div>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Petitioning for your child can feel overwhelming, but you don’t have to do it alone. At 
Filipina Fiancée Visa Service, we: </p>
                        </div>
                        <ul>
                            <li><strong></strong> Guide you step-by-step through the petition process</li>
                            <li><strong></strong> Ensure all forms and supporting evidence are correctly prepared</li>
                            <li><strong></strong> Help you avoid costly mistakes and delays</li>
                            <li><strong></strong> Keep your case on track with regular updates</li>
                            <li><strong></strong> Provide support until your child is safely with you in the United States</li>
                            <li><strong></strong> Understand the complexities of immigration law</li>
                            <li><strong></strong> Understand the complexities of immigration law</li>
                            
                        </ul>
                        <div class="box-list">
                            <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                            <p>Your family’s future is our priority. We’ve helped thousands of families reunite, and we’ll do 
the same for you. </p>
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
                            <h5>What is the Child Status Protection Act (CSPA)?</h5>
                            <p>The CSPA helps protect children from losing eligibility if they turn 21 while waiting for their 
case to be processed. It allows certain children to subtract processing delays from their 
age for immigration purposes.</p>
                        </div>
                        <div class="question">
                            <h5>How long do child petitions take?</h5>
                            <p>Processing times vary:</p>
                            <ul>
                                <li><strong></strong> IR2 cases (unmarried children under 21 of U.S. citizens) have no waiting period 
beyond standard processing, usually 12–18 months.</li>
                                <li><strong></strong> Preference categories (F1, F2A, F2B, F3) can involve waiting periods that range from 
several years to over 20 years, depending on category and country.</li>
                            </ul>
                        </div>
                        <div class="question">
                            <h5>Can I petition for my stepchild?</h5>
                            <p> Yes, but you must have married the child’s parent before the child turned 18.</p>
                        </div>
                        <div class="question">
                            <h5>What if my child gets married after I file the petition?</h5>
                            <p>If your child marries before immigrating, their eligibility may change. For example, a petition 
f
 iled for an unmarried child may convert to a married child category, which often has longer 
waiting times. In some cases, the petition may no longer qualify</p>
                        </div>
                        <div class="question">
                            <h5>Can I petition for my adopted child?</h5>
                            <p>Yes, as long as the adoption was completed before the child’s 16th birthday (or 18th if with 
a sibling). You must also have had legal and physical custody for at least two years.</p>
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
                    <h3>Our Child Petition Package</h3>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Eligibility assessment and category determination</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>CSPA analysis and age protection strategy</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Form I-130 preparation and filing</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Priority date tracking and monitoring</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>Affidavit of Support (I-864) preparation</p>
                    </div>
                    <div class="box-list">
                        <div class="box-list-icon"><i class="fas fa-genderless"></i></div>
                        <p>NVC processing and document submission</p>
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
                            <h5 class="primary-color">CHILD PETITION</h5>
                            <sup>$</sup>
                            <span class="price">750</span>
                            <a href="javascript:void(0)" class="p-md" data-bs-toggle="modal"
                                data-bs-target="#childModal">+ Gov. Fees</a>
                        </div>
                        <ul class="features">
                            <li><i class="fas fa-stop-circle"></i> Eligibility & Category Analysis</li>
                            <li><i class="fas fa-stop-circle"></i> CSPA Age Protection Review</li>
                            <li><i class="fas fa-stop-circle"></i> Form I-130 Preparation</li>
                            <li><i class="fas fa-stop-circle"></i> Priority Date Monitoring</li>
                            <li><i class="fas fa-stop-circle"></i> NVC Processing Support</li>
                            <li><i class="fas fa-stop-circle"></i> Embassy Interview Prep</li>
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

    <!-- Child Petition Pricing Modal -->
    <div class="modal fade" id="childModal" tabindex="-1" aria-labelledby="childModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="childModalLabel">Child Petition Package Pricing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="cbox-3-txt mb-2">
                        <h5>Our Service Fee</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> $750 Total Fee to Filipina Fiancée Visa (Paid to get Started)</li>
                        </ul>
                    </div>
                    <div class="cbox-3-txt mb-2">
                        <h5>Government Fees:</h5>
                        <ul>
                            <li><i class="fas fa-stop-circle"></i> USCIS Filing Fee: $675 (By Mail) / $625 (Online)</li>
                            <li><i class="fas fa-stop-circle"></i> NVC Fees (AOS + IV): $445</li>
                            <li><i class="fas fa-stop-circle"></i> USCIS Immigrant Fee: $235 (Due After Visa is Issued)</li>
                            <li><i class="fas fa-stop-circle"></i> Medical Exam: $500</li>
                            <li><i class="fas fa-stop-circle"></i> Total Gov Fees: $1,855 (By Mail) / $1,805 (Online)</li>
                            <li><i class="fas fa-stop-circle"></i> Grand Total: $2,605 (By Mail) / $2,555 (Online)</li>
                        </ul>
                        <p><small>*These fees are only due when the visa becomes available (immediate relatives) or the priority date becomes current (preference categories).</small></p>
                    </div>
                    <div class="cbox-3-txt mb-2">
                        <h5>Processing Times by Category:</h5>
                        <ul>
                            <li><i class="fas fa-clock"></i> <strong>IR2 (USC, under 21):</strong> 12-18 months (no waiting period)</li>
                            <li><i class="fas fa-clock"></i> <strong>F2A (LPR, under 21):</strong> 2-3 years current wait</li>
                            <li><i class="fas fa-clock"></i> <strong>F1 (USC, over 21):</strong> 7-8 years current wait</li>
                            <li><i class="fas fa-clock"></i> <strong>F2B (LPR, over 21):</strong> 8-10 years current wait</li>
                            <li><i class="fas fa-clock"></i> <strong>F3 (USC, married):</strong> 12-15 years current wait</li>
                        </ul>
                        <p><small>Wait times vary by country and change monthly. We provide current updates throughout your case.</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection