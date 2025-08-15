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
								<li class="breadcrumb-item active" aria-current="page">Getting Married on a Travel Visa</li>
							</ol>
						</nav>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</section>
		<section class="resource-detail bg-lightgrey ptb-80 heading_hidden">
		<div class="container">
			<div class="row">
			  	
				<div class="col-md-12 mb-5">
					<div class="heading mb-3">
						<h2>Can you get married on a Visitor or Tourist visa?</h2>
					</div> 
					<p class="lh-175">Yes. You may enter the U.S. on a visitor visa, marry a U.S. citizen then return home before your visa expires. Where you run into trouble is if you enter on a visitor visa with the intention of marrying and staying in the U.S.</p>
					<p class="lh-175">You might have heard about someone who got married in the United States while on a visitor visa, didn't return home, and successfully adjusted their status to permanent resident. Why were these people allowed to stay? Well, it is possible to adjust status from a visitor visa, but people in this scenario were able to prove that they came to the U.S. with honest travel intentions and happened to make a spur-of-the-moment decision to get married.</p>
					
					<p class="lh-175">To successfully adjust status after marrying on a visitor visa, the foreign spouse must show that they had originally intended to return home, and the marriage and desire to stay in the United States was not premeditated. Some couples find it difficult to satisfactorily prove intent but others are successful.</p>
				</div>
			  							
				
				
					<div class="col-md-6 mb-3 align-self-center pe-5">
					<div class="heading mb-3">
						<h2>Things you should know before getting married in the U.S. on a tourist visa:</h2>
					</div>
					<ul class="list-resourses mb-4">									 
						<li>Border protection officials are paying attention. When the foreigner arrives at the port-of-entry, they will be asked for the purpose of their travel. You should always be upfront and honest with border protection officials. If you state your intent as, "To see the Grand Canyon," and a search of your luggage reveals a wedding dress, be prepared for the inevitable grilling. If the border official believes that you're not coming to the U.S. for just a visit and you cannot prove your intent to leave before your visa expires, you'll be on the next plane home.</li>
					</ul>
				</div>
				
				<div class="col-md-6 mb-3 about-us aboutus2 align-self-center about_img_nobg">
					<div class="about-img-block ">
						<img src="{{ asset('assets/img/marriage-women.png') }}">
					</div>						
				</div>	
			
				<div class="col-md-12 mb-5 mt-4">
					<ul class="list-resourses mb-4">									 
						<li class="mb-3"> It is ok to enter the U.S. on a travel visa and marry a U.S. citizen if the foreigner intends to return to his/her home country. This can be tricky, though. Nothing says that you can't get married while on a travel visa. The problem is when your intent is to STAY in the country. You can get married and go back home before your visa expires, but you'll need hard evidence to prove to the border officials that you intend to return home. Come armed with lease agreements, letters from employers, and above all, a return ticket. The more evidence that you can show that proves your intention to return home, the better your chances will be of getting through the border.</li>
						<li class="mb-3">Avoid visa fraud. If you have secretly secured a tourist visa to marry your American sweetie to bypass the normal process of obtaining a fiancé or spouse visa in order to enter and remain in the U.S., you should rethink your decision. You could be accused of committing visa fraud. If fraud is found, you could face serious consequences. At the very least, you will have to return to your home country. Even worse, you may incur a ban and be prevented from re-entering the U.S. indefinitely.</li>
						<li class="mb-3">Securing a US tourist visa is not a simple task. There are a lot of strict conditions and requirements that need to be complied with before the highly coveted B-1/B-2 visa may be issued. A Tourist Visa is "possible", although highly improbable. The U.S. Embassy in Manila denies about 200 or more each day and to think each application for a tourist visa comes with a non-refundable $140 fee. In more than a few occasions, applicants who are confident of being granted a us tourist visa get shocked by its denial due to unexpected turn of events.</li>
						<li  class="mb-3">Although not an official requirement, those having success in achieving a tourist visa have held the test of being able to demonstrate proof of their return to Philippines at/prior to the end of any would be tourist visa, which tends to need lots of Peso in the bank under a long standing high balance bank account, deed/title to house/lot and car, business, spouse/children, etc. any/all of which show ties to Philippines and a commanding reason to return and not disappear.</li>
						<li class="mb-3">The issuance of a tourist visa is not a sure-fire guarantee that the applicant will be allowed entry in the US since said holders are still subject to the scrutiny of the Department of Homeland Security (DHS) officials who are likewise empowered to deny entry even to valid tourist visa holders.</li> 
						<li> If they suspect that the fiancee is trying to get a tourist visa for the purpose of getting married here it will be seen as an attempt to short-circuit the immigration process, and reason for instant denial.</li>   
					</ul> 
					
				</div>
				
				
				
			</div>
		</div>
	</section>	
		
@endsection