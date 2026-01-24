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
								<li class="breadcrumb-item active" aria-current="page">Filipino Wedding Traditions</li>
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
						<img src="{{ asset('assets/img/filipino-wedding-traditions.png') }}" width="100%">
					</div>						
				</div>	
				<div class="col-md-6 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>Filipino Wedding Traditions</h2>
					</div>
					<p class="lh-175">Filipino wedding customs make for a beautiful and exciting event. Filipino weddings, also known as kasalan, are among the most beautiful and intricate celebrations in the world because of the Filipino culture’s high regard for the sanctity of marriage making the event a lengthy and ceremonious occasion to remind everyone attending—especially the bride and groom—that the bond connecting the couple is expected to become permanent.</p>
					<p class="lh-175">The bride wears the traditional all-white wedding gown and the groom is handsomely clad in the traditional barong. Wedding Ceremony While some of the sponsors have a "silent" participation during the wedding ceremony, two sets of sponsors play active roles. Sponsors, in many Filipino weddings are similar to the idea of godparents. At a traditional Filipino wedding, many sponsors are present to witness the union of the couple.</p>
					<p class="lh-175">The groom wears a barong, a traditional hand embroidered formal shirt made from specially hand-loomed jusi or pina (pineapple fiber) cloth. You will be able to see some men wearing the Barong Tagalog at the wedding, a thin and transparent dress, most of the time white of color with a shirt under it.</p>
				</div>						
				<div class="col-md-12 mb-3">
					<p class="lh-175">During a specific point in the ceremony know as the Sanctus, the veil sponsors carefully pin a large veil on top of the bride's head and onto the shoulder of the groom. These secondary sponsors play a part in the wedding ceremony, and each couple has specific functions: lighting of the unity candle, putting on the veil and the cord for their respective ceremonies. A cord ceremony—where a set of "sponsors" selected by the bride to tie the knot with a ceremonial wedding cord around the bride and groom—is one of several centuries-old Philippine wedding traditions.</p>
					<p class="lh-175">The Bride is on the right side of her Father (or whoever gives her away), so that when they get to the altar, he will not be in the way of the Groom who will be on her right side throughout the ceremony. Ring Ceremony: The Priest/Minister may, at this point bless the Bride, Groom and rings with holy water. Coin Ceremony: The Priest/Minister then drops 13 pieces of coins (silver or gold) called arras into the Groom's waiting hands, who in turn drops it into the Bride's hands. Veil Ceremony: In the Catholic ceremony, the Priest continues with the nuptial mass until the "Sanctus". Towards the end of the ceremony, at a signal from the Priest/Minister, the Bride and Groom come up and approach the candles.</p>
					<p class="lh-175">During the reception couples practice the Filipino wedding custom of releasing a pair of white doves to symbolize a loving and harmonious marriage.</p>
					<p class="lh-175">The Wedding Reception:</p>
					<p class="lh-175">Filipinos love to party and celebrate, and a wedding is one grand occasion.</p>
					<p class="lh-175">It is during the reception that the wedding cake is cut.</p>
					<p class="lh-175">Filipino Weddings reflect the strong traditions of family and extended family and so incorporates considerable symbolism in this area. Filipino Wedding Ceremonies have some very wonderful traditions different from the typical Wedding Ceremonies here in the United States.</p>
				</div>
			</div>
		</div>
	</section>	
@endsection