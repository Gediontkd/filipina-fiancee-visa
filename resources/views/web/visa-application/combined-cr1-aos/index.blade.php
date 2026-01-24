<!-- resources/views/web/visa-application/combined-cr1-aos/index.blade.php -->
@extends('web.layout.master')
@section('content')
<section class="mypetition myaccount ptb-80 bg-lightgrey">
    <div class="container">
        <div class="row">
            <div class="col-md-6 section-title mb-0">
                <h3 class="fs-3 mb-0">Combined CR-1 + AOS Application</h3>
            </div>
            <div class="col-md-6 text-start text-md-end">
                <a href="{{ route('user.page', 'progress') }}" class="btn btn-tra-primary">Back To Profile</a>
            </div>
            <div class="col-md-12">
                <p class="jumbotron">Combined package for Spouse Visa (CR-1) and Adjustment of Status processing. <br /> DO NOT type in all UPPER CASE or all LOWER CASE. Please use proper capitalization.</p>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="card p-0">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-4 col-lg-3 br-r-1 pe-0">
                                <ul id="progressbar" class="progessbar2 mb-0">
                                    @foreach ($combinedSteps as $combinedStep)
                                        <li class="combinedPreviousOrContinue 
                                                active{{ $combinedStep->slug }} 
                                                {{ $combinedStep->slug == @$step ? 'active' : '' }}
                                                @if (empty($step) && $combinedStep->slug == 'petitioner-name') active @endif"
                                            data-form="{{ $combinedStep->slug }}"
                                            data-name="{{ $combinedStep->name }}">
                                            <span>
                                                <img src='{{ asset("assets/img/$combinedStep->icon") }}'/>
                                            </span>
                                            <strong class="{{ $combinedStep->slug }}">
                                                {{ $combinedStep->name }}
                                            </strong>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-8 col-lg-9 combinedCr1AosForm">
                                @if (isset($step))
                                    @include('web.visa-application.combined-cr1-aos.'.$step, compact('step'))
                                @else
                                    @include('web.visa-application.combined-cr1-aos.petitioner-name')
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
<script type="text/javascript">
    $(document).on('click', '.combinedPreviousOrContinue', function(){
        var name = $(this).data('name');
        var form = $(this).data('form');
        
        if (form == 'petitioner-name') {
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
            url: "{{ route('combinedPreviousOrContinue') }}",
            data: { form: form },
            success: function(data) {
                if (data.status == true) {
                    $('.'+form).html(name);
                    $('#progressbar li').removeClass('active');
                    $('.'+form).addClass('active');
                    $('.active'+form).addClass('active');
                    $('.combinedCr1AosForm').html(data.step);
                }
            }
        });
    });
</script>
@endsection