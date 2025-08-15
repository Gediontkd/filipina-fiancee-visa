@extends('web.layout.master')
@section('content')
	{{ getLanguage() }}
	@include('web.component.bread-crumb', [
		'title' => __('contact-us.contactUs'),
	])
	<section class="contact-us ptb-100">
	  	<div class="container">
	    	<div class="row">
		       	<div class="col-md-4">
					<div class="contact-box mb-40">
						<h5>{{ __('contact-us.ourAddress') }}</h5>
						<p>6955 N Durango Dr. Ste 1115-318 <br> Las Vegas, NV 89149-4411 USA</p>
						{{-- <p>
							{{ __('contact-us.contactAddress1') }} 
							<br>
							{{ __('contact-us.contactAddress2') }}
							<br> 
							{{ __('contact-us.contactAddress3') }}
						</p> --}}
						</div>
						<div class="contact-box mb-40">
						<h5 class="h5-sm">{{ __('contact-us.contactPhones') }}</h5>
						<p>{{ __('contact-us.phone') }} : 702-426-4503</p>
						<p>{{ __('contact-us.fax') }} : 888-371-6310</p>
					</div>
				</div>
				<div class="col-md-8">
				    <div class="contact-form">
				    	{{ Form::open(['url' => route('contactUs'), 'id' => 'contactUs']) }}
					     <div class="row">
							 <div class="col-md-6">
							    <div class="form-group">
					               {{ Form::text('name', old('name'), ['type'=>'text', 'class' => 'form-control', 'placeholder' => __('contact-us.enterName')]) }}
					            </div>
							 </div>
							  <div class="col-md-6">
							    <div class="form-group">
					               {{ Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => __('contact-us.enterEmail')]) }}
					            </div>
							 </div>
							  <div class="col-md-12">
							    <div class="form-group">
					               {{ Form::text('subject', old('subject'), ['class' => 'form-control', 'placeholder' => __('contact-us.subject')]) }}
					            </div>
							 </div>
							  <div class="col-md-12">
							    <div class="form-group">
							    	{{ Form::textarea('message', old('message'),['class'=>'form-control', 'rows' => 4, 'cols' => 40, 'placeholder' => __('contact-us.message')]) }}
							     </div>
							 </div>
							<div class="form-group mt-4 mb-4 row">
								<div class="col-md-5">
									<div class="captcha">
										<span>{!! captcha_img() !!}</span>
										<button type="button" class="btn btn-danger" class="reload" id="reload">
											↻
										</button>
									</div>									
								</div>
								<div class="col-md-7">
									<input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">									
								</div>
							</div>												  
						 </div>
						{{ Form::submit(__('contact-us.sendMessage'), ['class' => 'btn btn-tra-primary lh-25', 'id' => 'contactUsBtn']) }}
					   	{{ Form::close() }} 
					</div>
				</div>
			</div>			  
	  	</div>
	</section>	
@endsection
@section('customScript')
<script type="text/javascript">
	$('#reload').click(function () {
		$.ajax({
			type: 'GET',
			url: 'reload-captcha',
			success: function (data) {
				$(".captcha span").html(data.captcha);
			}
		});
	});

	$("#contactUs").validate({    
      	rules: {
         	name: {
            	required: true,
         	},
         	email: {
            	required: true,
         	},
         	subject: {
            	required: true,
         	},
         	message: {
            	required: true,
         	},
         	captcha: {
            	required: true,
         	},           
      	},
      	messages: {
         	name: "Please enter name!",
         	email: "Please enter email!",
         	subject: "Please enter subject!",
         	message: "Please enter message!",                
         	captcha: "Please enter captcha!",                
      	},      	
   	});
</script>
@endsection