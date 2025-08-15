@extends('web.layout.master')
@section('content')
	<section class="breadcrumb-main">
        <div class="container">
			<div class="row">
				<div id="breadcrumb">
				<div class="breadcrumb-txt">
				<h3>Resource Detail</h3>
				</div>
				<div class="row">
					<div class="col">
						<div class="breadcrumb-nav">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
								<li class="breadcrumb-item"><a href="{{ route('resource') }}">Resources</a></li>
								<li class="breadcrumb-item active" aria-current="page">Choosing your Wedding Gown</li>
							</ol>
						</nav>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</section>
	<section class="resource-detail bg-lightgrey ptb-100 heading_hidden">
		<div class="container">
			<div class="row">
			  	<div class="col-md-6 mb-5 about-us align-self-center">
					<div class="about-img-block ">
						<img src="{{ asset('assets/img/wedding.jpg') }}">
					</div>						
				</div>	
				<div class="col-md-6 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>Choosing your Wedding Gown</h2>
					</div>
					<p class="lh-175">The wedding gown is something all brides dream about and since this will probably be the most expensive dress you will ever buy, it’s important that you make the right choice. Remember that it’s a dress that you will probably wear only once, so keep this in mind!</p>
					<p class="lh-175">To help you make your decision, take a family member with you or some of your friends who you know will be honest. There’s a lot of money at stake, so its important you stay in charge. Don’t be afraid to shop around – there are many businesses out there all wanting a piece of the wedding industry. Take your time and go with the vendor or store you feel most comfortable with and who provides the best customer service.</p>
				</div>						
				<div class="col-md-12 mb-3">					
					<p class="lh-175">If you are on a tight budget, one way to save money is to pick out a pattern from a top designer and hire a seamstress. Choose less expensive, yet quality fabric and you can save about half the costs if you were to buy from a store. Another option is to go to a place where you could find very affordable wedding gowns. Just know how to haggle to get the best deal.</p>
					<p class="lh-175">Unless you choose a designer dress, it’s the alterations that can really affect the cost of the dress. Don’t buy a gown more than one size too big and make sure you are happy with the neckline and the back because those are the most expensive changes to make.</p>
					<p class="lh-175">Make sure you really examine the dress so you know the quality is worth the price tag. Don’t be afraid to ask if the dress is made of silk or polyester – after all, it’s your money and you want to be sure you are getting what you are paying for. A great method to tell if the dress is made well or not is to look inside. Examine the stitching and seams. Look for loose threads and if the sewing looks professional and solid.</p>
					<p class="lh-175">Your wedding day is a day you will remember for the rest of your life. Although you may spend a lot on your dress, remember that it’s also your day to have fun. Don’t be afraid of getting your dress dirty. Just be yourself and have fun.</p>
					<p class="lh-175">Oh – and don’t forget about the shoes! Don’t make a sacrifice for looks over comfort. After all, if you can’t walk you won’t be able to show off your dress!</p>
				</div>	
			</div>
		</div>
	</section>		
@endsection