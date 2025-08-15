<div id="loader-wrapper">
    <div id="loader">
        <span class="cssload-loader">
            <span class="cssload-loader-inner"></span>
        </span>
    </div>
</div>
<!-- Header Start -->
<header id="myHeader">
    <nav class="navbar navbar-expand-md navbar-dark py-0 header_px20">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/img/logo-new.jpg') }}" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-bar-icon"><i class="fas fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item phone_nav">
                        <a class="nav-link" href="tel:702-426-4503">702-426-4503</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about-us') }}">
                            {{ __('message.aboutUs') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('service') }}">
                            {{ __('message.ourServices') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('resource') }}">
                            {{ __('message.resource') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('testimonial') }}">
                            {{ __('message.testimonials') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contactUs') }}">
                            {{ __('message.contactUs') }}
                        </a>
                    </li>
                    {{-- <li class="nav-item">
						<select class="selectpicker changeLang" name="lang">							
							<option
								value="en"
								{{ Session::get('locale') == 'en' ? 'selected' : '' }}
							>
								Eng
							</option>
							<option
								value="es"
								{{ Session::get('locale') == 'es' ? 'selected' : '' }}
							>
								Spanish
							</option>
						</select>
					</li> --}}
                    @if (Auth::user())
                        <div class="dropdown">
                            <button class="dropbtn">
                                <div class="img-edt">
                                    <img src="http://54.146.239.99/assets/img/logo-new.jpg">
                                </div>{{ Auth::user()->name }}
                            </button>
                            <div class="dropdown-content">
                                <a href="{{ route('user.page', 'progress') }}">Profile</a>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="logout-btn">
                                        {{ __('message.logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-tra-grey">
                                {{ __('message.login') }}
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="{{ route('register') }}" class="btn btn-tra-primary">
                                {{ __('message.register') }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
