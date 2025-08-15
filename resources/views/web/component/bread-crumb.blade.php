<section class="breadcrumb-main">
    <div class="container">
		<div class="row">
			<div id="breadcrumb">
			<div class="breadcrumb-txt">
			<h3>{{ $title }}</h3>
			</div>
			<div class="row">
				<div class="col">
					<div class="breadcrumb-nav">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="{{ route('home') }}">Home</a>
							</li>
							@if (isset($previousPageLink) && isset($previousPageTitle))
								<li class="breadcrumb-item">
									<a href="{{ $previousPageLink }}">{{ $previousPageTitle }}</a>
								</li>
							@endif
							<li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
						</ol>
					</nav>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</section>