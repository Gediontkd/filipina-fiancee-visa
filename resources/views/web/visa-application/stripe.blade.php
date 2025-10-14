<!-- resources\views\web\visa-application\stripe.blade.php -->
@extends('web.layout.master')
@section('content')
<style type="text/css">
	.hide-error {
		display: none;
	}
</style>
	@include('web.component.bread-crumb', [
		'title' => 'Payment',
	])
	<section class="pt-5 pb-5 order-details-section section-full-height">
    <div class="container">
        <div class="d-flex mb-4">
            <h3 class="section-title">{{--{!! bussIcon($influencer->id) !!}--}} Payment Details</h3>            
        </div>
        
        <form 
            role="form" 
            action="{{ route('payment') }}" 
            method="post" 
            class="require-validation"
            data-cc-on-file="false"
            data-stripe-publishable-key="{{ env('STRIPE_LIVE_KEY') }}"
            id="payment-form"
        >
            @csrf            
            <div class="formSec">
                <div class='form-row row'>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="card_holder">Name on Card</label>
                            <input class="form-control" placeholder="Enter Name" name="card_holder" ze='4' type='text'> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="card_number">Card Number</label>
                            <input placeholder="Enter Card Number" autocomplete='off' name="card_number" class='form-control card-number' size='20'
                            type='text'> 
                        </div>
                    </div>                       
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exp_month">Expiration Month</label>
                            <input class='form-control card-expiry-month' name="exp_month" placeholder='MM' size='2'
                            type='text'> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exp_year">Expiration Year</label>
                            <input class='form-control card-expiry-year' name="exp_year" placeholder='YYYY' size='4'
                            type='text'> 
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exp_year">CVC</label>
                            <input autocomplete='off' class='form-control card-cvc' name="cvc" placeholder='ex. 311' size='4' type='text'> 
                        </div>
                    </div>                                
                </div>                
                <div class="row">
                    <div class='col-md-8 mt-sm-5 '>
                        <div class="error form-group hide-error">
                            <div class='alert-danger alert card-errors'>
                                Please correct the errors and try
                                again.
                            </div>                            
                        </div>
                    </div>
					{!! Form::hidden('user_id', Auth::id()) !!}
                    {!! Form::hidden('application_id', request()->application_id) !!}
                    {!! Form::hidden('route', request()->route) !!}
                    {!! Form::hidden('price', request()->price) !!}
                    <div class="col-4 text-end mt-sm-5 mt-4">
                        <button class="btn btn-primary confirmPayment" type="submit">Make Payment</button>
                    </div>
                </div>
            </div>
        </form>        
    </div>
</section>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $("#payment-form").validate({    
      	rules: {
         	card_holder: {
            	required: true,
         	},
            card_number: {
            	required: true,
         	},  
            exp_month: {
            	required: true,
         	},
            exp_year: {
            	required: true,
         	},
            cvc: {
            	required: true,
         	},  
      	},
      	messages: {
         	card_holder: "Please enter card holder name!",         	             
         	card_number: "Please enter card number!",         	             
         	exp_month: "Please enter expiration month!",         	             
         	exp_year: "Please enter expiration year!",         	             
         	cvc: "Please enter cvc number!",         	             
      	},      	
   	});

	$(function() {
       
        var $form = $(".require-validation");
       
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
            inputSelector = [
                'input[type=email]', 'input[type=password]',
                'input[type=text]', 'input[type=file]',
                'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
            $errorMessage.addClass('hide-error');
      
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
              var $input = $(el);
              if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide-error');
                e.preventDefault();
              }
            });
       
            if (!$form.data('cc-on-file')) {
              e.preventDefault();
              Stripe.setPublishableKey($form.data('stripe-publishable-key'));
              Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
              }, stripeResponseHandler);
            }
      
      });
      
      function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide-error')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                   
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    }); 
</script>
@endsection