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
								<li class="breadcrumb-item active" aria-current="page">The Importance of Family Values for Filipinos</li>
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
						<img src="{{ asset('assets/img/service11.jpg') }}">
					</div>						
				</div>	
				<div class="col-md-6 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>The Importance of Family Values for Filipinos</h2>
					</div>
					<p class="lh-175">Many men are attracted to Filipinas because of their grace, beauty and winning smiles. However, many more are attracted by their traditional views on marriage, families and other approaches to life. For men craving loving and attentive wives in America, Filipinos are often the first choice ladies to look at from abroad.</p>
					<p class="lh-175">Filipino family values are built on traditional values passed on from generation to generation, which were then added to by Catholic teaching after the arrival of the Spanish. These values are constantly reinforced and is one of many reasons why many American men are turning to Filipino brides instead of finding partners from their own country.</p>
				</div>						
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Loyalty and Fidelity</h2>
					</div>						
					<p class="lh-175">A Filipino lady will only leave home if she is in love. By wanting to marry an American man, she is saying she wishes to pledge her future and life to him. Divorce is something that is not seen in the Philippines, so the enormity of the pledge should not be underestimated. Filipino family values indicate that the first reaction to problems within a family is to try and sort the problem out for the sake of the children.</p>
					<p class="lh-175">Opinions on fidelity are equally high. They have a very low view of the act and believe it is a betrayal of the family. Due to strong laws and traditions back home, Filipinas are very unlikely to stray from their man if they are being treated well and if they love the person they are married to.</p>
				</div>						
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Her New Family</h2>
					</div>						
					<p class="lh-175">In many parts of Asia, when a woman marries, she marries into her husband’s family and takes that thought very seriously. In America and many other western countries, the traditional extended family system is breaking down as couples live by themselves, children leave when they are old enough and elderly relatives are sent to live in homes. Family values dictate that the family is treated as a whole, daughters look after their parents as well as their children. In fact, their children become their first priority and are seen as more important than jobs and lifestyles. In a modern America where children can often be relegated to less essential than these things, Filipino devotion is widely respected by men looking for loving wives.</p>
				</div>					
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>The Family Back Home</h2>
					</div>						
					<p class="lh-175">Just because a lady leaves the Philippines, it does not mean she has cut off contact with her immediate family back home. As part of this devotion, it is expected for someone marrying a Filipina to take her family as part of his own. This means financial and emotional support if possible. It does not mean necessarily bringing them over to America, but it may mean regular visits and wiring money to help improve their standard of living. In many cases, even a small amount of money can make a huge difference in their lives.</p>
				</div>				
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Materialism</h2>
					</div>						
					<p class="lh-175">As noted already, Filipinas place a higher value on the family and also on spirituality than on materialism. This means material gains such as owning objects, nice houses, fast cars and the most fashionable clothes are nice, but not top of the priority list. Of course, Filipinas, like anyone else, like an impressive and comfortable house with a plasma TV,  and a four-poster bed, but they are optional luxuries that can be bought as a bargain or through careful saving.</p>
				</div>				
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Male Values</h2>
					</div>						
					<p class="lh-175">There are family values to be placed on men as well as women. It is not a one way deal, you know. Filipino men are expected to be providers and the head of the family. This is transferred onto you as an American man too. A Filipino bride is looking to you as a source of provision and income for the family and as the main pillar of support. You should know your culture well and have circles of friends to help her establish a life in the country.</p>
				</div>				
				<div class="col-md-12 mb-3">
					<div class="heading mb-3">
						<h2>Be a Good Husband</h2>
					</div>						
					<p class="lh-175">Naturally, every woman is different. Filipinas are individuals like all other women, and you need to respect this. A Filipina will become a loyal and loving wife if she is treated well, romanced, loved and given affection. Like all marriages, a marriage between an American man and a Filipina bride has to be worked on.</p>
					<p class="lh-175">They do not come in pre-packaged boxes ready to be unpacked and switched on. Being rooted in a family system means many of them have traditional views on how men and women should act to one another. She is looking for protection and support. Give her these things and she will blossom into a wonderful wife.</p>
				</div>
			</div>
		</div>
	</section>		
@endsection