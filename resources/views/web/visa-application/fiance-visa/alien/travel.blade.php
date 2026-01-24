<!-- resources\views\web\visa-application\fiance-visa\alien\travel.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienTravel'), 'id' => 'fianceAlienTravel']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>All questions are about the Alien (foreign citizen).</h2>
                    </div>
                </div>
                {{-- <div class="col-md-12">
                    <div class="form-group">
                        <label>Has the alien entered any country other than  Afghanistan  in the past 5 years? <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('afghanistan', 'no', @$step->detail['afghanistan'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input anotherCountry'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('afghanistan', 'yes', @$step->detail['afghanistan'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input anotherCountry'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="afghanistan"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 pb-4 addAnotherCountrySec" style="display: {{ @$step->detail['afghanistan'] == 'yes' ? 'block' : 'none'  }};">
                    <div class="appendCountry">
                        @if (empty($step->detail["country1"]))
                            @include('web.component.country', [
                                'index' => 1,
                                'sec' => '',
                                'data' => @$step->detail,
                            ])
                        @endif                   
                        @php
                            $i = '';
                        @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            @if (isset($step->detail["country$i"]))
                                @include('web.component.country', [
                                    'index' => $i,
                                    'sec' => '',
                                    'data' => @$step->detail,
                                ])                            
                            @endif
                        @endfor
                    </div>
                    <div class="">
                        <a class="btn btn-tra-grey addCountryBtn">+ Add Another Country Visited</a>
                    </div>
                </div>                                        --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you resided in any country/region for six months or longer since you attained 16 years of age? <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('resided_country_region', 'no', @$step->detail['resided_country_region'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input residedCountryRegion'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('resided_country_region', 'yes', @$step->detail['resided_country_region'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input residedCountryRegion'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="resided_country_region"></div>
                        </div>
                    </div>
                </div>
                <div class="row residedCountryRegionSec" style="display: {{ @$step->detail['resided_country_region'] == 'yes' ? 'block' : 'none' }};">
                    <div class="appendResidedCounReg">
                        @if (empty($step->detail["resided_country1"]))
                            <div class="residedCounReg">
                                <div class="form-group">
                                    {{ Form::select('resided_country1', getAllCountry(), @$step->detail['resided_country1'], [
                                        'class' => 'form-control'
                                    ]) }}
                                </div>
                            </div>
                        @endif                   
                        @php
                            $i = '';
                        @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            @if (isset($step->detail["resided_country$i"]))
                                <div class="residedCounReg">
                                    @if ($i != 1)
                                        <div class="col-md-6 mb-4">
                                            <a class="btn btn-tra-grey removeResidedCounReg">- Remove</a>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        {{ Form::select("resided_country$i", getAllCountry(), @$step->detail["resided_country$i"], [
                                            'class' => 'form-control'
                                        ]) }}
                                    </div>
                                </div>                          
                            @endif
                        @endfor                                              
                    </div>
                    <div class="pb-4">
                        <a class="btn btn-tra-grey addResidedCounBtn">+ Add Another Country Visited</a>
                    </div>            
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'travel') !!}
        {!! Form::hidden('next', 'military') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'employment'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'military'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienTravelBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var countryCount = $('.appendCountry > .countryForm').length;
            var residedCounCount = $('.appendResidedCounReg > .residedCounReg').length;
            if (countryCount == 5) {
                $('.addCountryBtn').addClass('d-none');
            }
            if (residedCounCount == 5) {
                $('.addResidedCounBtn').addClass('d-none');
            }
        });

        $(document).on('click', '.anotherCountry', function(){
            if ($(this).val() == 'yes') {
                $('.addAnotherCountrySec').show();
            } else {
                $('.addAnotherCountrySec').hide();
            }
        }); 

        $(document).on('click', '.residedCountryRegion', function(){
            if ($(this).val() == 'yes') {
                $('.residedCountryRegionSec').show();
            } else {
                $('.residedCountryRegionSec').hide();
            }
        });          

        $(document).ready(function(){
            getState($('.countryId').val());
        });

        $(document).on('change', '.countryId', function(){
            var countryId = $(this).val();
            getState(countryId);
        });

        function getState(countryId)
        {
            $.ajax({                
                type: 'get',
                url: "{{ route('getState') }}",
                data: {
                    countryId: countryId
                },
                success: function(data) {
                    $('.states').html(data);                    
                }
            });
        }

        $("#fianceAlienTravel").validate({
            rules: {
                afghanistan: {
                    required: true,
                },  
                resided_country_region: {
                    required: true,
                },
                country1: {
                    required: true,
                },
                country2: {
                    required: true,
                },
                country3: {
                    required: true,
                },
                country4: {
                    required: true,
                },
                country5: {
                    required: true,
                },  
                resided_country1: {
                    required: true,
                },
                resided_country2: {
                    required: true,
                },
                resided_country3: {
                    required: true,
                },
                resided_country4: {
                    required: true,
                },
                resided_country5: {
                    required: true,
                },              
            },
            messages: {
               afghanistan: "Please choose option!",               
               resided_country_region: "Please choose option!",               
               country1: "Please choose country!",               
               country2: "Please choose country!",               
               country3: "Please choose country!",               
               country4: "Please choose country!",               
               country5: "Please choose country!", 
               resided_country1: "Please choose country!",               
               resided_country2: "Please choose country!",               
               resided_country3: "Please choose country!",               
               resided_country4: "Please choose country!",               
               resided_country5: "Please choose country!",               
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "afghanistan" || element.attr("name") == "resided_country_region") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                $('#fianceAlienTravelBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienTravel') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activetravel').removeClass('active');
                            $('.activemilitary').addClass('active');
                            $('.fianceVisaForm').html(data.data);                    
                        }
                        if (data.status == false) {
                            toastr.options.timeOut = 10000;
                            toastr.error(data.message);                        
                        }
                    }
                });
               return false;
            }
        });               

        function addAnotherCountry(index) {
            return '<div class="countryForm"><div class="pb-4"><a class="btn btn-tra-grey removeCountry">- Remove</a></div><div class="form-group"><select class="form-control countryId" name="country'+index+'"><option value="">-Select Country-</option>@foreach(getCountry() as $country)</option><option value="{{ $country->id }}">{{ $country->name }}</option>@endforeach</select></div></div>';
        }        

        function addResidedCountry(index) {
            return '<div class="residedCounReg"><div class="pb-4"><a class="btn btn-tra-grey removeResidedCounReg">- Remove</a></div><div class="form-group"><select class="form-control countryId" name="resided_country'+index+'"><option value="">-Select Country-</option>@foreach(getCountry() as $country)<option value="{{ $country->id }}">{{ $country->name }}</option>@endforeach</select></div></div>';
        }        
    </script>
</div>