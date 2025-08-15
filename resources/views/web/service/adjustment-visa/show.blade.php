	@extends('web.layout.master')
@section('content')
	@include('web.component.bread-crumb', [
		'title' => 'Adjustment Of Status',
		'previousPageLink' => route('service'),
		'previousPageTitle' => 'Services',
	])	
	<section class="about-us ptb-115">
		<div class="row">
			<div class="col-md-12 text-center">
				<a
					href="{{ route('adjustmentVisaApplication', 'spouse') }}"
					class="btn btn-tra-grey w-25"
				>
					Spouse
				</a>							
			</div>
			<div class="col-md-12 text-center my-4">
				<a
					href="{{ route('adjustmentVisaApplication', 'child') }}"
					class="btn btn-tra-grey w-25"
				>
					Child
				</a>				
			</div>
			<div class="col-md-12 text-center">
				<a
					href="{{ route('adjustmentVisaApplication', 'parent') }}"
					class="btn btn-tra-grey w-25"
				>
					Parent
				</a>						
			</div>
		</div>	
	</section>
@endsection