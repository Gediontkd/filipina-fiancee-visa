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
                        <h2 class="card-title">{{ __('profile.basicInformation') }}</h2>
                    </div>
                    <div class="card-body p-3">
                        {{ Form::open(['url' => route('basicInformation'), 'id' => 'basicInformation']) }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    	{{ Form::label('name', __('profile.name')) }}
                                        <div class="input-group">
                                            <i class="fa fa-user"></i>
                                            {{ Form::text('name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => __('profile.enterName')]) }}
                                        </div>
                                        <div class="first_name"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('email', __('profile.emailAddress')) }}
                                        <div class="input-group">
                                            <i class="fa fa-envelope"></i>
               								{{ Form::email('email', Auth::user()->email, ['class' => 'form-control', 'disabled' => true]) }}
                                        </div>
                                        <div class="email"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            	{{ Form::submit(__('profile.button'), ['class' => 'btn btn-tra-primary', 'id' => 'basicInformationBtn']) }}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header p-3">
                        <h2 class="card-title">{{ __('profile.changePassword') }}</h2>
                    </div>
                    <div class="card-body p-3">
                    	{{ Form::open(['url' => route('changePassword'), 'id' => 'changePassword']) }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    	{{ Form::label('old_password', __('profile.oldPassword')) }}
                                        <div class="input-group">
                                            <i class="fa fa-user"></i>
                                            {{ Form::password('old_password', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => __('profile.enterOldPassword')]) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('new_password', __('profile.newPassword')) }}
                                        <div class="input-group">
                                            <i class="fa fa-lock"></i>
                                            {{ Form::password('new_password', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => __('profile.enterNewPassword')]) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('confirm_password', __('profile.confirmNewPassword')) }}
                                        <div class="input-group">
                                            <i class="fa fa-lock"></i>
                                            {{ Form::password('confirm_password', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => __('profile.enterConfirmNewPassword')]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            	{{ Form::submit(__('profile.button'), ['class' => 'btn btn-tra-primary', 'id' => 'changePasswordBtn']) }}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('customScript')
<script type="text/javascript">
	$("#basicInformation").validate({    
      	rules: {
         	name: {
            	required: true,
         	},         	
         	email: {
            	required: true,
         	}, 
      	},
      	messages: {
         	name: "Please enter name!",
         	email: "Please enter email!",      
      	},     
   	});

   	$("#changePassword").validate({    
      	rules: {
         	old_password: {
            	required: true,
         	},
         	new_password: {
            	required: true,
         	},
         	confirm_password: {
            	required: true,
            	equalTo : '[name="new_password"]'
         	}, 
      	},
      	messages: {
         	old_password: "Please enter first old password!",
         	new_password: "Please enter new password!",      
         	confirm_password:{
         		required : "Please enter confirm password!",
         		equalTo : "Password and confirm password must be matched!",
         	},      
      	},     
   	});
</script>
@endsection