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
                                    <li class="breadcrumb-item active" aria-current="page">Required Documents for Fiancee Visa</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="resource-detail bg-lightgrey ptb-80 heading_hidden">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-5 about-us">
                <div class="about-img-block ">
                    <img src="{{ asset('assets/img/douments-img.jpg') }}">
                </div>
            </div>
            <div class="col-md-6 mb-3 align-self-center">
                <div class="heading mb-3">
                    <h2>Required Documents for Fiancee Visa, K1 Visa</h2>
                </div>
                {{-- 
                <p class="lh-175">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                --}}
            </div>
            <div class="col-md-12 mb-5 mt-4">
                <div class="heading mb-3">
                    <h2>To get your petition filed we will need the following items:</h2>
                </div>
                <ul class="list-resourses mb-4">
                    <li>Photocopy of the first page and entry and exit stamp page(s) of U.S. citizen's passport.</li>
                    <li>Copy of U.S. citizen's birth certificate.</li>
                    <li>Copies of Termination of EVERY Prior Marriage (if either petitioner or fiancee has been previously married).</li>
                    <li>Legal Infractions: CERTIFIED copies of the Court Record(s) showing the Disposition of each case, even if it  was a misdemeanor.</li>
                    <li>Pictures of you together.</li>
                </ul>
                <div class="heading mb-3">
                    <h2>Later (Months from now) you need the following items:</h2>
                </div>
                <ul class="list-resourses mb-4">
                    <li>Evidence of Financial Support, which shall include the Affidavit of Support by the petitioner, and a copy of the petitioner’s most recent Federal income tax returns as well as the previous W-2 of the petitioner.</li>
                    <li>Evidence of your ongoing relationship which can be cards, letters, emails, chats, or phone bills.</li>
                </ul>
            </div>
            <div class="col-md-6 mb-3 align-self-center pe-5">
                <div class="heading mb-3">
                    <h2>We Provide Fiancee Visa Preparation Services for U.S. clients</h2>
                </div>
                <p class="lh-175">Get your bride by your side quickly by using the professional services of Filipina Fiancee Visa Service. We are experts with the K1 fiance visa process for the Philippines. We work  with U.S. clients who have fiancees from the Philippines and we have an <b class="fw-bold">outstanding success rate!</b>.</p>
            </div>
            <div class="col-md-6 mb-5 about-us aboutus_right_img">
                <div class="about-img-block ">
                    <img src="{{ asset('assets/img/douments-img-2.jpg') }}">
                </div>
            </div>
            <div class="col-md-12 mt-5">
                @include('web.component.disclaimer') 
            </div>
        </div>
    </div>
</section>
@endsection