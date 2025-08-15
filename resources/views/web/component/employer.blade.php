<div class="row emploperSec empSec{{ $index }}">
    <div class="col-md-6">
        <div class="heading mb-30">
            <h6>Employer {{ $index }}</h6>
        </div>
    </div>
    <div class="col-md-6 d-flex justify-content-end removeEmpBtn{{ $index }}">
        @if ($index != 1 && $index <= 5)
            {{-- <div class="col-md-2 mt-2 removeEmpBtn{{ $index }}"> --}}
            <button type="button" class="btn btn-primary btn-sm removeEmploperSection" data-sec="{{ $index }}">
                <i class="fa fa-trash"></i>
            </button>
            {{-- </div> --}}
        @endif
    </div>
    @if ($index != 1)
        <div class="col-md-12">
            <div class="heading mb-30">
                <h6 class="sectionHeading{{ $index }}"></h6>
            </div>
        </div>
    @endif
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("full_name_of_employer$index", 'Full Name of Employer') }}
            <span class="required">*</span>
            {{ Form::text("full_name_of_employer$index", @$data["full_name_of_employer$index"], [
                'class' => 'form-control',
                'placeholder' => 'Full Name of Employer',
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("street_number_and_name$index", 'Street Number and Name') }}
            <span class="required">*</span>
            {{ Form::text("street_number_and_name$index", @$data["street_number_and_name$index"], [
                'class' => 'form-control',
                'placeholder' => 'Street Number and Name',
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @php
                if (isset($step->detail["employerAptSteFlr$index"])) {
                    $aptsteflr = [
                        'N/A' => 'N/A',
                        'Apt' => 'Apt',
                        'Ste' => 'Ste',
                        'Flr' => 'Flr',
                    ];
                } else {
                    $aptsteflr = [
                        '' => 'Select',
                        'Apt' => 'Apt',
                        'Ste' => 'Ste',
                        'Flr' => 'Flr',
                    ];
                }                
            @endphp
            {{ Form::label("aptsteflr$index", 'Apt/Ste/Flr') }}
            {{ Form::select("aptsteflr$index",$aptsteflr,
                    @$step->detail["employerAptSteFlr$index"] ? @$step->detail["employerAptSteFlr$index"] : @$data["aptsteflr$index"],['class' => "form-control employerAptSteFlr$index",],
            ) }}
            <span class="aptsteflr{{$index}} error"></span>
            {{ Form::label("employerAptSteFlr$index", 'Does Not Apply') }}
            {{ Form::checkbox("employerAptSteFlr$index", @$step->detail["employerAptSteFlr$index"], @$step->detail["employerAptSteFlr$index"] == true ? true : '', [
                'class' => 'custom-control-input doesNotApplySelect',
                'data-field' => "employerAptSteFlr$index",
                'data-subfield' => "apt_ste_flr$index"
            ]) }}
        </div>       
    </div>
    <div class="col-md-6 mt-1">
        <div class="form-group mt-4">
            {{ Form::text("apt_ste_flr$index", @$data["apt_ste_flr$index"], [
                'class' => "form-control apt_ste_flr$index",
                'placeholder' => 'Apt/Ste/Flr',
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("city$index", 'Town or City') }}
            <span class="required">*</span>
            {{ Form::text("city$index", @$data["city$index"], [
                'class' => 'form-control',
                'placeholder' => 'Please Enter City',
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("state$index", 'State') }}
            <span class="required">*</span>
            {{ Form::select("state$index", getAllUsStates(), @$data["state$index"], [
                'class' => "form-control employerState$index",
            ]) }}
            @include('web.component.does-not-apply', [
                'field' => "employerState$index",
                'value' => @$step->detail["employerState$index"],
            ])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("zip_postal_code$index", 'ZIP/Postal Code') }}
            <span class="required">*</span>
            {{ Form::text("zip_postal_code$index", @$data["zip_postal_code$index"], [
                'class' => "form-control zIPPostalCode$index",
                'placeholder' => 'Please Enter ZIP/Postal Code',
            ]) }}
            @include('web.component.does-not-apply', [
                'field' => "zIPPostalCode$index",
                'value' => @$step->detail["zIPPostalCode$index"],
            ])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("province$index", 'Province') }}
            <span class="required">*</span>
            {{ Form::text("province$index", @$data["province$index"], [
                'class' => "form-control employerProvince$index",
                'placeholder' => 'Please Enter Province',
            ]) }}
            @include('web.component.does-not-apply', [
                'field' => "employerProvince$index",
                'value' => @$step->detail["employerProvince$index"],
            ])
        </div>
    </div>   
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("country$index", 'Country') }}
            <span class="required">*</span>
            {{ Form::select("country$index", getAllCountryForSponsor(), @$data["country$index"], [
                'class' => 'form-control countryId',
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        @php
            if (Request::segment(1) == 'fiance-alien') {
                $occupationtitle = "Beneficiary's Occupation (specify)";
            } else {
                $occupationtitle = 'Your Occupation (specify)';
            }
        @endphp
        <div class="form-group">
            {{ Form::label("occupation_specify$index", $occupationtitle) }}
            <span class="required">*</span>
            {{ Form::text("occupation_specify$index", @$data["occupation_specify$index"], [
                'class' => 'form-control postalCode',
                'placeholder' => 'Please Enter Your Occupation (specify)',
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        @php            
            @$disBeganDate = !empty($data["employement_start_date$index"]) ? 'disableDatePicker' : '';
        @endphp
        <div class="form-group">
            {{ Form::label("", 'Employement Start Date (mm/dd/yyyy)') }}
            <span class="required">*</span>
            {{ Form::text("employement_start_date$index", @$data["employement_start_date$index"], [
                'class' => "form-control dateOfBirth beganDate$index $disBeganDate",
                'data-sec' => $index,
                'placeholder' => 'Enter Date',
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        @php            
            $disEndDate = !empty($data["employement_end_date$index"]) ? 'disableDatePicker' : '';
        @endphp
        <div class="form-group">
            {{ Form::label("", 'Employement End Date (mm/dd/yyyy)') }}
            <span class="required">*</span>
            {{ Form::text("employement_end_date$index", @$data["employement_end_date$index"], [
                'class' => "form-control dateOfBirth endDate employementEndDate$index $disEndDate",
                'data-index' => "$index",
                'placeholder' => 'Enter Date',
            ]) }}
            @if ($index == 1)
                <div class="form-group">
                    {{ Form::label("present_date", 'Present?', ['class' => "employementEndDate $disEndDate"]) }}
                    {{ Form::checkbox("present_date", date('m/d/Y'), @$data["present_date"] == 'N/A' || @$data["present_date"] != '' ? true : '', [
                        'class' => "custom-control-input doesNotApply employementEndDate",
                        'data-field' => "employementEndDate1",
                        'data-index' => "1",
                    ]) }}
                </div>
            @endif
            {{@$lastIndex}}
        </div>
    </div>    
    {{ Form::hidden("employer$index", $index) }}
    {{ Form::hidden("remaingYears$index", 5, ['class' => "remaingYears$index"]) }}
</div>
