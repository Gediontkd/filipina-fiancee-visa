<!-- resources\views\web\visa-application\adjustment-of-status\affiliations.blade.php -->
<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentAffiliation'), 'id' => 'adjustmentAffiliation']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>All questions are about the Alien (foreign citizen).</h2>
            </div>
            <div class="row">              
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been a member of or had an affiliation with an organization, association, fund, foundation, party, club, society, or similar group in the United States or in other place since your 16th birthday, including any military service?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('affiliation', 'no', @$step->detail['affiliation'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input affiliation',
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('affiliation', 'yes', @$step->detail['affiliation'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input affiliation',
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="affiliation"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4 affiliationSec" style="display: {{ @$step->detail['affiliation'] == 'yes' ? 'block' : 'none' }};">                    
                    <div class="row appendAffiliation">
                        @for ($i = 1; $i <= 6; $i++)
                            @if (!empty($step->detail["org_name$i"]))                    
                                @include('web.component.affiliation', [
                                    'index' => $i,
                                    'data' => @$step->detail,
                                ])                            
                            @endif                        
                        @endfor
                    </div>
                    <div class="mb-3">
                        <a class="btn btn-tra-grey addAffiliation">+ Add Affiliation</a>
                    </div>                 
                </div>                                               
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'affiliations') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'alien-parents') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'children'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'alien-parents'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentAffiliationBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            getState(231);
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
        
        $("#adjustmentAffiliation").validate({
            rules: {
                affiliation: {
                    required: true,
                },
                org_name1: {
                    required: true,
                },
                city_town1: {
                    required: true,
                },
                state_province1: {
                    required: true,
                },
                country: {
                    required: true,
                },
                nature_of_group1: {
                    required: true,
                },
                membership_start_date1: {
                    required: true,
                },
                membership_end_date1: {
                    required: true,
                },
                org_name2: {
                    required: true,
                },
                city_town2: {
                    required: true,
                },
                state_province2: {
                    required: true,
                },
                country: {
                    required: true,
                },
                nature_of_group2: {
                    required: true,
                },
                membership_start_date2: {
                    required: true,
                },
                membership_end_date2: {
                    required: true,
                },
                org_name3: {
                    required: true,
                },
                city_town3: {
                    required: true,
                },
                state_province3: {
                    required: true,
                },
                country: {
                    required: true,
                },
                nature_of_group3: {
                    required: true,
                },
                membership_start_date3: {
                    required: true,
                },
                membership_end_date3: {
                    required: true,
                },
                org_name4: {
                    required: true,
                },
                city_town4: {
                    required: true,
                },
                state_province4: {
                    required: true,
                },
                country: {
                    required: true,
                },
                nature_of_group4: {
                    required: true,
                },
                membership_start_date4: {
                    required: true,
                },
                membership_end_date4: {
                    required: true,
                },
                org_name5: {
                    required: true,
                },
                city_town5: {
                    required: true,
                },
                state_province5: {
                    required: true,
                },
                country: {
                    required: true,
                },
                nature_of_group5: {
                    required: true,
                },
                membership_start_date5: {
                    required: true,
                },
                membership_end_date5: {
                    required: true,
                },
                org_name6: {
                    required: true,
                },
                city_town6: {
                    required: true,
                },
                state_province6: {
                    required: true,
                },
                country: {
                    required: true,
                },
                nature_of_group6: {
                    required: true,
                },
                membership_start_date6: {
                    required: true,
                },
                membership_end_date6: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                var name = element.attr("name");
                if (name == "affiliation") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
                affiliation: "Please choose option!",                
                org_name1: "Please enter name!",                
                city_town1: "Please enter city or town!",                
                state_province1: "Please enter state or province!",                
                country: "Please choose country!",                
                nature_of_group1: "Please enter nature of group!",                
                membership_start_date1: "Please enter start date!",                
                membership_end_date1: "Please enter end date!",
                org_name2: "Please enter name!",                
                city_town2: "Please enter city or town!",                
                state_province2: "Please enter state or province!",                
                country: "Please choose country!",                
                nature_of_group2: "Please enter nature of group!",                
                membership_start_date2: "Please enter start date!",                
                membership_end_date2: "Please enter end date!",
                org_name3: "Please enter name!",                
                city_town3: "Please enter city or town!",                
                state_province3: "Please enter state or province!",                
                country: "Please choose country!",                
                nature_of_group3: "Please enter nature of group!",                
                membership_start_date3: "Please enter start date!",                
                membership_end_date3: "Please enter end date!",
                org_name4: "Please enter name!",                
                city_town4: "Please enter city or town!",                
                state_province4: "Please enter state or province!",                
                country: "Please choose country!",                
                nature_of_group4: "Please enter nature of group!",                
                membership_start_date4: "Please enter start date!",                
                membership_end_date4: "Please enter end date!",
                org_name5: "Please enter name!",                
                city_town5: "Please enter city or town!",                
                state_province5: "Please enter state or province!",                
                country: "Please choose country!",                
                nature_of_group5: "Please enter nature of group!",                
                membership_start_date5: "Please enter start date!",                
                membership_end_date5: "Please enter end date!",
                org_name6: "Please enter name!",                
                city_town6: "Please enter city or town!",                
                state_province6: "Please enter state or province!",                
                country: "Please choose country!",                
                nature_of_group6: "Please enter nature of group!",                
                membership_start_date6: "Please enter start date!",                
                membership_end_date6: "Please enter end date!",                
            },
            submitHandler: function(form) {
                $('#adjustmentAffiliationBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentAffiliation') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.affiliations').removeClass('active');
                            $('.alien-parents').addClass('active');
                            $('.adjustmentStatusForm').html(data.data);                    
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

        function addChildernHtml(index) {
            datePicker();
            removeBtn = '';
            if (index != 1) {
                removeBtn = '<a class="btn btn-tra-grey removeAffiliation">- Remove Affiliation</a>';
            }
            return '<div class="row addAffiliationForm"> <div class="col-md-12 mb-4">'+removeBtn+'</div> <h5>Affiliation '+index+'</h5> <div class="col-md-6"> <div class="form-group"> <label for="org_name'+index+'">Name of Organization</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="org_name'+index+'" type="text" id="org_name'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="city_town'+index+'">City Or Town</label> <span class="required">*</span> <input class="form-control" placeholder="Enter City Or Town" name="city_town'+index+'" type="text" id="city_town'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="state_province'+index+'">State or Province</label> <span class="required">*</span> <input class="form-control" placeholder="Enter State or Province" name="state_province'+index+'" type="text" id="state_province'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="country">Country</label> <span class="required">*</span> <select class="form-control" id="country" name="country'+index+'"><option value="" selected="selected">-Select Country-</option>@foreach (getAllCountry() as $country) <option value="{{$country}}">{{$country}}</option> @endforeach</select> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="nature_of_group'+index+'">Nature of Group</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Nature of Group" name="nature_of_group'+index+'" type="text" id="nature_of_group'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="membership_start_date'+index+'">Membership Start Date (mm/dd/yyyy)</label> <span class="required">*</span> <input class="form-control disablePastDate" placeholder="Enter Date" name="membership_start_date'+index+'" type="text" id="membership_start_date'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="membership_end_date'+index+'">Membership End Date (mm/dd/yyyy)</label> <span class="required">*</span> <input class="form-control dateOfBirth" placeholder="Enter Date" name="membership_end_date'+index+'" type="text" id="membership_end_date'+index+'"> </div> </div> </div>';
        }
    </script>   
</div>