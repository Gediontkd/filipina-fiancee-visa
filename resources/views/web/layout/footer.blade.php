<footer class="footer ptb-100-40">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-4">
				<div class="footer-info mb-20">
					<img src="{{ asset('assets/img/logo-new.jp') }}g" width="175" height="35" style="" alt="footer-logo">
					<p class="mt-3">
						{{ __('message.contactNo') }}
					</p>
					<p>
						{{ __('message.workingHour') }}
					</p>
					<div class="footer-socials-links mt-20">
						<ul class="foo-socials text-center clearfix">
							<li>
								<a target="_blank" href="https://www.facebook.com/FilipinaFianceeVisa/" class="ico-facebook">
								<img src="{{ asset('assets/img/facebook.jp') }}g"  style="" alt="footer-main">
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		    <div class="col-md-6 col-lg-2 offset-lg-1">
				<div class="footer-links mb-40">
					<h5>{{ __('message.applyingFor') }}</h5>
					<ul class="clearfix">
						<li>
							<a href="{{ route('fiancee.visa') }}">
								{{ __('message.fianceeVisa') }}
							</a>
						</li>
						<li>
							<a href="{{ route('spouse.visa') }}">
								{{ __('message.spouseVisa') }}
							</a>
						</li>
						<li>
							<a href="{{ route('adjustment.visa') }}">
								{{ __('message.adjustmentOfStatus') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-6 col-lg-2">
				<div class="footer-links mb-40">
					<h5>{{ __('message.quickLinks') }}</h5>
					<ul class="clearfix">
						<li>
							<a href="{{ route('about-us') }}">
								{{ __('message.aboutUs') }}
							</a>
						</li>
						<li>
							<a href="{{ route('contactUs') }}">
								{{ __('message.contactUs') }}
							</a>
						</li>
						<li>
							<a href="{{ route('service') }}">
								{{ __('message.ourServices') }}
							</a>
						</li>
						<li>
							<a href="{{ route('resource') }}">
								{{ __('message.resource') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-6 col-lg-3">
				<div class="footer-form mb-20">
					<h5>{{ __('message.subscribeUs') }}:</h5>
					<p class="m-bottom-20">
						{{ __('message.newsletterContent') }}
					</p>
					{{ Form::open(['url' => route('newsletter'), 'class' => 'newsletter-form', 'id' => 'newsletterForm']) }}
						<div class="input-group">
							{{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => __('message.emailAddress'), 'required' => true]) }}
							<span class="input-group-btn">
								{{ Form::button('<i class="far fa-envelope"></i>', ['class' => 'btn', 'id' => 'newsletterBtn', 'type' => 'submit']) }}
							</span>
						</div>
						<div class="newsletter"></div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
		<div class="bottom-footer">
			<div class="row">
				<div class="col-md-12">
					<p class="footer-copyright" >© 2022 
						<span>{{ __('message.filipinaFianceeVisa') }}</span>
						. {{ __('message.allRightsReserved') }}
					</p>
					<p class="copyright_detail">
						{{ __('message.copyRightDetail') }}						
					</p>
				</div>
			</div>
		</div>
	</div>
	<a id="back-top" class="back-to-top js-scroll-trigger" href="javascript:void(0)"></a>
</footer>