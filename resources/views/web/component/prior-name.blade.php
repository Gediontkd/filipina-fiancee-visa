@if ($index == 1)
    <div class="form-group">
        <label>Were any of your name changes for reasons other than marriage or divorce, such as adoption or court
            order?</label>
        <span class="required">*</span>
        <div class="radiogroup">
            <label class="custom-control custom-radio mb-0 ">
                {{ Form::radio('adoption_or_court_order', 'no', @$step->detail['adoption_or_court_order'] == 'no' ? true : '', [
                    'class' => 'custom-control-input',
                ]) }}
                <span class="custom-control-label"></span> No
            </label>
            <label class="custom-control custom-radio mb-0 ms-3">
                {{ Form::radio(
                    'adoption_or_court_order',
                    'yes',
                    @$step->detail['adoption_or_court_order'] == 'yes' ? true : '',
                    [
                        'class' => 'custom-control-input',
                    ],
                ) }}
                <span class="custom-control-label"></span> Yes
            </label>
        </div>
        <div class="adoption_or_court_order"></div>
    </div>
@endif
<h5>Prior Name #{{ $index }}</h5>
<div class="col-md-4">
    <div class="form-group">
        {{ Form::label("prior_fname$index", 'First Name (given name)') }}
        <span class="required">*</span>
        {{ Form::text("prior_fname$index", @$step->detail["prior_fname$index"], [
            'class' => 'form-control',
            'placeholder' => 'Enter name',
        ]) }}
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        {{ Form::label("prior_mname$index", 'Middle Name') }}
        <span class="required">*</span>
        {{ Form::text("prior_mname$index", @$step->detail["mName$index"] ? 'N/A' : @$step->detail["prior_mname$index"], [
            'class' => "form-control mName$index",
            'placeholder' => 'Enter name',
        ]) }}
        @include('web.component.does-not-apply', [
            'field' => "mName$index",
            'value' => @$step->detail["mName$index"],
        ])
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        {{ Form::label("prior_lname$index", 'Last Name (family name)') }}
        <span class="required">*</span>
        {{ Form::text("prior_lname$index", @$step->detail["prior_lname$index"], [
            'class' => 'form-control',
            'placeholder' => 'Enter name',
        ]) }}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Is this your maiden name? </label>
        <span class="required">*</span>
        <div class="radiogroup">
            <label class="custom-control custom-radio mb-0 ">
                {{ Form::radio("prior_maiden_name$index", 'no', @$step->detail["prior_maiden_name$index"] == 'no' ? true : '', [
                    'class' => 'custom-control-input',
                ]) }}
                <span class="custom-control-label"></span> No
            </label>
            <label class="custom-control custom-radio mb-0 ms-3">
                {{ Form::radio(
                    "prior_maiden_name$index",
                    'yes',
                    @$step->detail["prior_maiden_name$index"] == 'yes' ? true : '',
                    [
                        'class' => 'custom-control-input',
                    ],
                ) }}
                <span class="custom-control-label"></span> Yes
            </label>
        </div>
        <div class="prior_maiden_name{{ $index }}"></div>
    </div>
</div>
