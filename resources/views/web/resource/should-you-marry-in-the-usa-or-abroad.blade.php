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
                                    <li class="breadcrumb-item active" aria-current="page">Should You Marry in the USA or Abroad?</li>
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
            <div class="col-md-6 mb-5 about-us left_img_auto_height">
                <div class="about-img-block ">
                    <img src="{{ asset('assets/img/aboutimg1.jpg') }}">
                </div>
            </div>
            <div class="col-md-6 mb-3 align-self-center">
                <div class="heading mb-3">
                    <h2>Filipina Fiancée Visa Service</h2>
                </div>
                {{-- <p class="lh-175">Based here in the USA, has only one goal in mind – to make it easy for you to get together with your Filipina spouse or your bride to be. As a US citizen living here in the US, you have the right to be joined by your spouse or a person you intend to marry, subject to approval by the US government department that deals with immigration and citizenship. The focus is on you, as the partner already in the US, to file a petition with the government. The process of filing a petition is however not an easy one, considering all the paperwork and regulations involved and the time it takes for the petitions to pass through the system.</p> --}}
                <p class="lh-175">You basically have two choices. You can get married in the Philippines and then file a petition for your spouse to join you in the US, or you can file a petition for him/her to come over and then get married in the US. In the first instance, your spouse will require a <strong class="fw-bold">CR1 Spouse visa</strong> and in the latter instance he or she will need a <strong class="fw-bold">K1 Fiancée visa</strong>. Our role is simply to help you petition for whichever visa your partner will require, depending on whether you have decided to get married in the Philippines or here in the US.</p>
            </div>
            <div class="col-md-12 mb-3">
                <p class="lh-175">We don't prescribe to our clients what to do, but generally we find that the easier option is to file for a <strong class="fw-bold">K1 Fiancée visa</strong>, have your loved one join you in the US, and then get married while here. The process of applying for a <strong class="fw-bold">K1 Fiancée visa</strong> is less rigorous and faster compared to that for the <strong class="fw-bold">CR1 Spouse visa</strong>. You may also consider a few other factors. For example, if your loved one succeeds in joining you in the US, you are given 90 days within which to get married. That is sufficient time to know each other a little better and to plan a wedding. The downside is that your relatives may not manage to come for the wedding due to visa restrictions. If you like, you could travel back to the Philippines later on and have a ceremony, just so that your relatives can celebrate your union.</p>
                <p class="lh-175">When you petition for a <strong class="fw-bold">K1 Fiancée visa</strong>, you and your love must convince the authorities that you truly intend to marry each other. In fact, you must prove that you’ve met each other in person at least once and provide proof that you’ve been in touch with one another on a consistent basis. </p>
                <p class="lh-175">The final choice to whether to marry her in her home country or marry her in the USA is completely up to you. We however, promise to deliver exemplary service regardless of your choice. </p>
            </div>
            <div class="col-md-12 mt-5">
                @include('web.component.disclaimer')               
            </div>
        </div>
    </div>
</section>
@endsection