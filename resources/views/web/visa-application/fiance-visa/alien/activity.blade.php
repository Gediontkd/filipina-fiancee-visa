<!-- resources\views\web\visa-application\fiance-visa\alien\activity.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienActivity'), 'id' => 'fianceAlienActivity']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>All questions are about the Alien (foreign citizen).</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Has the alien belonged to, contributed to or worked for any professional, social or charitable organizations? <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('organization', 'no', @$step->detail['organization'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input organization'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('organization', 'yes', @$step->detail['organization'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input organization'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="organization"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 organizationSec" style="display: {{ @$step->detail['organization'] == 'yes' ? 'block' : 'none'  }};">
                    <div class="appendOrg">
                        @if (empty($step->detail["org_name1"]))
                            <div class="orgName">                                
                                <div class="form-group">
                                    {{ Form::label("org_name1", "Organization Name") }}
                                    <span class="required">*</span>
                                    {{ Form::text("org_name1", @$step->detail["org_name1"], [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter name'
                                    ]) }}                       
                                </div>                        
                            </div>
                        @endif
                        @php
                            $i = '';
                        @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            @if (isset($step->detail["org_name$i"]))
                                <div class="orgName">
                                    @if ($i != 1)
                                        <div class="col-md-6 mb-4">
                                            <a class="btn btn-tra-grey removeOrgName">- Remove</a>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        {{ Form::label("org_name1", "Organization Name") }}
                                        <span class="required">*</span>
                                        {{ Form::text("org_name$i", @$step->detail["org_name$i"], [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter name'
                                        ]) }}                       
                                    </div>                        
                                </div>                           
                            @endif
                        @endfor
                    </div>
                    <div class="col-md-6 mb-4">
                        <a class="btn btn-tra-grey addOrganizationBtn">+ Add another Organization</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Has the alien ever been arrested or convicted for any offense or crime? <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('arrested_convicted', 'no', @$step->detail['arrested_convicted'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input arrestedConvicted'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('arrested_convicted', 'yes', @$step->detail['arrested_convicted'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input arrestedConvicted'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="arrested_convicted"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 arrestedConvictedSec" style="display: {{ @$step->detail['arrested_convicted'] == 'yes' ? 'block' : 'none'  }};">
                   <div class="form-group">
                        {{ Form::label('explain_conviction', "Explain all arrests and/or convictions.") }}
                        <span class="required">*</span>
                        {{ Form::textarea('explain_conviction', @$step->detail['explain_conviction'], ['class' => 'form-control', 'rows' => 4]) }}
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you belong to a clan or tribe? <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('clan_tribe', 'no', @$step->detail['clan_tribe'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input clanTribe'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('clan_tribe', 'yes', @$step->detail['clan_tribe'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input clanTribe'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="clan_tribe"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 clanTribeSec" style="display: {{ @$step->detail['clan_tribe'] == 'yes' ? 'block' : 'none'  }};">
                   <div class="form-group">
                        {{ Form::label('clan_tribe_name', 'Clan or Tribe Name') }}
                        <span class="required">*</span>
                        {{ Form::text('clan_tribe_name', @$step->detail['clan_tribe_name'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Name'
                        ]) }}
                    </div>
                </div>                
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'activity') !!}
        {!! Form::hidden('next', 'immigration') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'military'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'immigration'
        ]) }}
         {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienActivityBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $(document).ready(function(){
            var militaryForm = $('.appendOrg > .orgName').length;
            if (militaryForm == 5) {
                $('.addOrganizationBtn').addClass('d-none');
            }            
        });

        $(document).on('click', '.organization', function(){
            if ($(this).val() == 'yes') {
                $('.organizationSec').show();
            } else {
                $('.organizationSec').hide();
            }
        });

        $(document).on('click', '.arrestedConvicted', function(){
            if ($(this).val() == 'yes') {
                $('.arrestedConvictedSec').show();
            } else {
                $('.arrestedConvictedSec').hide();
            }
        });

        $(document).on('click', '.clanTribe', function(){
            if ($(this).val() == 'yes') {
                $('.clanTribeSec').show();
            } else {
                $('.clanTribeSec').hide();
            }
        });        

        $("#fianceAlienActivity").validate({
            rules: {
                organization: {
                    required: true,
                },
                org_name1: {
                    required: true,
                },
                org_name2: {
                    required: true,
                },
                org_name3: {
                    required: true,
                },
                org_name4: {
                    required: true,
                },
                org_name5: {
                    required: true,
                },
                arrested_convicted: {
                    required: true,
                },
                explain_conviction: {
                    required: true,
                },
                clan_tribe: {
                    required: true,
                },
                clan_tribe_name: {
                    required: true,
                },     
            },
            messages: {
               organization: "Please choose option!",
               org_name1: "Please enter name!",              
               org_name2: "Please enter name!",              
               org_name3: "Please enter name!",              
               org_name4: "Please enter name!",              
               org_name5: "Please enter name!",              
               arrested_convicted: "Please choose option!",              
               explain_conviction: "Please explain!",              
               clan_tribe: "Please choose option!",              
               clan_tribe_name: "Please enter name!",              
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "organization" || element.attr("name") == "arrested_convicted" || element.attr("name") == "clan_tribe") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                $('#fianceAlienActivityBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienActivity') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activeactivity').removeClass('active');
                            $('.activeimmigration').addClass('active');
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

        function organizationDrop(index) {
            return '<div class="orgName"> <div class="col-md-6 mb-4"> <a class="btn btn-tra-grey removeOrgName">- Remove</a> </div> <div class="form-group"> <label for="org_name'+index+'">Organization Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter name" name="org_name'+index+'" type="text" id="org_name'+index+'"> </div> </div>';
        }
    </script>
</div>