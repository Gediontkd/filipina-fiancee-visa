<!-- resources\views\web\visa-application\fiance-visa\sponsor\index.blade.php -->
@extends('web.layout.master')
@section('content')
<section class="mypetition myaccount ptb-80 bg-lightgrey">
    <div class="container">
        <div class="row ">
            <div class="col-md-6 section-title mb-0">
                <h3 class="fs-3 mb-0">Fiancee Visa Application</h3>
                
            </div>
            <div class="col-md-6 text-start text-md-end">
                <a href="{{ route('user.page', 'progress') }}" class="btn btn-tra-primary ">Back To Profile</a>
            </div>
            <div class="col-md-12">
                <p class="jumbotron">You are the <strong>Petitioner</strong>. Your Foreign Fiancée is the Alien <strong>Beneficiary</strong>. <br /> DO NOT type in all UPPER CASE or all LOWER CASE. Please use proper capitalization.</p>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="card p-0">
                    <div class="card-body p-0">                    	
                        <div class="row">
                            <div class="col-md-4 col-lg-3 br-r-1 pe-0">
                                <ul id="progressbar" class="progessbar2 mb-0">
                                    @foreach ($fianceSteps as $fianceStep)
                                        <li
                                            class="sponsorPreviousOrContinue
                                                active{{ $fianceStep->slug }}
                                                {{ $fianceStep->slug == @$step['next'] ? 'active' : '' }}
                                                @if (empty($step['next']) && $fianceStep->slug == 'name')
                                                    {{'active'}}
                                                @endif"
                                            id="step"
                                            data-form="{{ $fianceStep->slug }}"
                                            data-name="{{ $fianceStep->name }}"
                                        >
                                        	<span>
                                        		<i class="fa {{ $fianceStep->icon }}"></i>
                                        	</span>
                                        	<strong class="{{ $fianceStep->slug }}">
                                                {{ $fianceStep->name }}
                                            </strong>
                                        </li>
                                    @endforeach                                   
                                </ul>
                            </div>
                            <div class="col-md-8 col-lg-9 fianceSponsorForm">
                                @if (isset($step))                             
                                    @include('web.visa-application.fiance-visa.sponsor.'.$step['next'].'', compact('step'))
                                @else
                                    @include('web.visa-application.fiance-visa.sponsor.name')
                                @endif
                            </div>                               
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('customScript')
<script src="{{ asset('assets/js/spouse-steps.js') }}"></script>
<script src="{{ asset('assets/application/fiance-visa/name.js') }}"></script>
<script type="text/javascript">
    $(document).on('click', '.sponsorPreviousOrContinue', function(){
        var name = $(this).data('name');
        var form = $(this).data('form');
        if (form == '') {
            window.location.href = "{{ route('user.page', 'progress') }}";
            return false;
        }
        if (name) {
            $('.'+form).html('Processing <i class="fa fa-spinner fa-spin"></i>');
        } else {
            $(this).html('Processing <i class="fa fa-spinner fa-spin"></i>');            
        }        
        $.ajax({
            headers: {
               'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'post',
            url: "{{ route('sponsorPreviousOrContinue') }}",
            data: {
                form: form,
            },
            success: function(data) {
                if (data.status == true) {
                    $('.'+form).html(name);
                    $('#progressbar li').removeClass('active');              
                    $('.'+form).addClass('active');
                    $('.active'+form).addClass('active');
                    $('.fianceSponsorForm').html('');                               
                    $('.fianceSponsorForm').html(data.step);                               
                }                             
            }
        });
    });    

    // Global scroll fix for AJAX form updates
    $(document).ajaxSuccess(function(event, xhr, settings, data) {
        // Check if the request was to a fiance-sponsor route and was successful
        if (settings.url.indexOf('fiance-sponsor') !== -1 && (data.status === true || data.status === "true")) {
            console.log('Fiance Sponsor AJAX success detected, scrolling to top...');
            $('html, body').animate({
                scrollTop: $(".fianceSponsorForm").offset().top - 100
            }, 300);
        }
    });
</script>	
@endsection