<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<title>Filipina Fiancee Visa</title>
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/animation.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/responsive-custom.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
		<link rel="icon" href="{{ asset('assets/img/favicon.png') }}" sizes="16x16" type="image/png">
		<link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet" />
		<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
		<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
		<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
		<script type="text/javascript">
			var _baseURL = '{{ url('/') }}';		
		</script>
	</head>
	<body>		
		@include('web.layout.header')

		<div class="wrapper">

			@yield('content')

			@include('web.layout.footer')
			
			@include('web.component.modal')
			
		</div>
		
		<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('assets/js/owl.carousel.js') }}"></script>
		<script src="{{ asset('assets/js/animation.js') }}"></script>
		<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
		<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
		<script src="{{ asset('assets/js/main.js') }}"></script>
		<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
		<script src="{{ asset('assets/js/toastr.js') }}"></script>		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
		@yield('customScript')
		<script>
	        $(document).ready(function() {				
	            toastr.options.timeOut = 10000;
	            @if(Session::has('success'))
	                toastr.success('{{ Session::get('success') }}');
	            @endif

	            @if (Session::has('error'))
	                toastr.error('{{ Session::get('error') }}');
	            @endif
	        });

	        $("#newsletterForm").validate({    
		      	rules: {
		         	email: {
		            	required: true,
		         	},		         	          
		      	},
		      	errorPlacement: function (error, element) {
		            error.appendTo($(".newsletter"));
		        },
		      	messages: {
		         	email: "Please enter email!",		         	              
		      	},      	
		   	});
			
			$("#chooseApplicationForm").validate({    
		      	rules: {
		         	chosen_application: {
		            	required: true,
		         	},		         	          
		      	},
		      	errorPlacement: function (error, element) {
		            error.appendTo($(".chosen_application"));
		        },
		      	messages: {
		         	chosen_application: "Please choose option!",		         	              
		      	},      	
		   	});

		   	var url = "{{ route('change.lang') }}";
		    $(".changeLang").change(function(){
		        window.location.href = url + "?lang="+ $(this).val();
		    });	
			
			$(document).ready(function() {
				<?php if(Auth::check() && Auth::user()->chosen_application == '') { ?>
					$('#chooseApplicationModal').modal('show');
				<?php } ?>
			{{--	if ({{ Auth::check() && Auth::user()->chosen_application == '' }}) {
					$('#chooseApplicationModal').modal('show');
				}
				
				// if ({{ Auth::check() && Auth::user()->application_route == '' }}) {
				// 	var paymentModal = "{{ @Auth::user()->chosen_application }}";
				// 	$('#'+paymentModal+'Modal').modal('show');
				// }
				--}}
			});
	    </script>
		
	</body>
</html>