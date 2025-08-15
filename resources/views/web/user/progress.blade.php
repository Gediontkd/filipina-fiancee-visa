@extends('web.layout.master')
@section('content')
<section class="myaccount ptb-80 bg-lightgrey">
    {{getLanguage()}}
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-3 col-xxl-3 col-md-4  mb-mob-15">
                @include('web.component.profile-sidebar')
            </div>
            <div class="col-lg-8 col-xl-9 col-xxl-9 col-md-9">
                <div class="card mb-3">
                    <div class="card-header p-3">
                        <h2 class="card-title text-center">Section Progress</h2>
                    </div>
                    <div class="card-body p-3">
                       <div class="row">
                           <div class="col-md-4">
                               <h6>Section</h6>
                               <a href="{{ route('fianceSponsorApplication') }}" class="btn btn-tra-grey my-2">U.S. Sponsor Questions</a>
                               <a href="{{ route('fianceAlienApplication') }}" class="btn btn-tra-grey my-2">Alien Questions</a>
                               <a href="{{ route('fianceAlienChildApplication') }}" class="btn btn-tra-grey my-2">Alien Children Questions</a>
                           </div>
                           <div class="col-md-8">
                               <h6>Progress</h6>
                               <div class="progress my-4">
                                  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ $sponsorTotal }}%" aria-valuenow="{{ $sponsorTotal }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="progress my-4" style="margin-top: 42px !important;">
                                  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ $alienTotal }}%" aria-valuenow="{{ $alienTotal }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="progress my-4" style="margin-top: 42px !important;">
                                  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ $alienChildrenTotal }}%" aria-valuenow="{{ $alienChildrenTotal }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                           </div>
                       </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header p-3">
                        <h2 class="card-title text-center">Overall Progress</h2>
                    </div>
                    <div class="card-body p-3">
                       <div class="progress">
                          <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ $overAll }}%" aria-valuenow="{{ $overAll }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</section>
@endsection
@section('customScript')
<script type="text/javascript">
	
</script>
@endsection