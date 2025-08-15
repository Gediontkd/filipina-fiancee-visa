@extends('web.layout.master')
@section('content')
<section class="mypetition myaccount ptb-80 bg-lightgrey">
    <div class="container">
        <div class="row ">
            <div class="col-md-6 section-title mb-0">
                <h3 class="fs-3 mb-0">Spousal Visa</h3>
            </div>
            <div class="col-md-6 text-start text-md-end">
                <a href="{{ route('user.page', 'profile') }}" class="btn btn-tra-primary ">Back To Profile</a>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="card p-0">
                    <div class="card-body p-0">                    	
                        <div class="row">
                            <div class="col-md-4 col-lg-3 br-r-1 pe-0">
                                <ul id="progressbar" class="progessbar2 mb-0">
                                    @foreach ($spouseSteps as $spouseStep)
                                        <li
                                            class="spousePreviousOrContinue 
                                                {{ $spouseStep->slug }} 
                                                {{ $spouseStep->slug == @$step['next'] ? 'active' : '' }}
                                                @if (empty($step['next']) && $spouseStep->slug == 'name') 
                                                    {{'active'}} 
                                                @endif"
                                            id="step"
                                            data-form="{{ $spouseStep->slug }}"
                                            data-name="{{ str_replace(' ', '-', $spouseStep->name) }}"
                                        >
                                        	<span>
                                        		<img src='{{ asset("assets/img/$spouseStep->icon") }}'/>
                                        	</span>
                                        	<strong class="{{ str_replace(' ', '-', $spouseStep->name) }}">
                                                {{ $spouseStep->name }}
                                            </strong>
                                        </li>
                                    @endforeach                                   
                                </ul>
                            </div>
                            <div class="col-md-8 col-lg-9 spouseVisaForm">
                                @if (isset($step))                             
                                    @include('web.visa-application.spouse-visa.'.$step['next'].'', compact('step'))
                                @else
                                    @include('web.visa-application.spouse-visa.name')
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
    $(document).on('click', '.spousePreviousOrContinue', function(){
        var name = $(this).data('name');
        if (name) {
            $('.'+name).html('Processing <i class="fa fa-spinner fa-spin"></i>');
        } else {
            $(this).html('Processing <i class="fa fa-spinner fa-spin"></i>');            
        }        
        var form = $(this).data('form');
        $.ajax({
            headers: {
               'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'post',
            url: "{{ route('spousePreviousOrContinue') }}",
            data: {
                form: form,
            },
            success: function(data) {
                if (data.status == true) {
                    $('.'+name).html(name);
                    $('#progressbar li').removeClass('active');              
                    $('.'+form).addClass('active');
                    $('.spouseVisaForm').html('');                               
                    $('.spouseVisaForm').html(data.step);                               
                }                             
            }
        });
    });    
</script>	
@endsection