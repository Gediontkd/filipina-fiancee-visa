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
								<li class="breadcrumb-item active" aria-current="page">Cross-cultural Personal Relationships</li>
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
						<img src="{{ asset('assets/img/aboutimg2.jpg') }}">
					</div>						
				</div>	
				<div class="col-md-6 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>Cross-cultural Personal Relationships</h2>
					</div>
					<p class="lh-175">Marrying even within your own culture can be  a challenging experience. Once you get past the wedding day and the romance you are left with the everyday task of loving somebody who is not like you. Differences can be a source of inspiration or conflict.</p>
					<p class="lh-175">But what are the challenges of marry into another culture?</p>
					<p class="lh-175">A desire to understand another’s culture will not prevent conflict.  You have your own cultural beliefs that you bring to a relationship and you will in the first instance use that framework to judge a person or situation. However it is important to gather as much information about your partner’s culture as you can.  For example their rituals, their religious beliefs, the role of extended family in your partner’s life and how much autonomy does your partner have in making decisions for their life. People in the West have a great deal of independence from their extended families.  Those in the East value close family relationships.  This will impact on your relationship.</p>
				</div>						
				<div class="col-md-12 mb-3">
					<p class="lh-175">Do not assume your partner is going to change with gentle persuasion from you.  This is probably a mistake people make generally in relationships.  People need to be accepted for themselves and if you need to change somebody to ensure you can have a relationship with them, it begs the question why choose the person in the first place. That’s not to say that change will not occur as you spend more time getting to know someone and what they want in the relationship. Trying to change someone’s cultural tendencies will create more unnecessary conflict.</p>
					<p class="lh-175">There are many situations that arise in life that call for us to draw on `common-sense` ways to deal with them. That common-sense is made up of our past experience, our habits, our value systems and our taken for granted ways of how to react to things that happen in our life even small things.  Remember you and your partner do not possess the same common-sense view of the world.  In some situations like how to eat food correctly or what to do in a temple, choosing the ‘when in Rome’ approach can save a lot of unnecessary conflict.  But there are some things that are not so easy to solve by using this approach especially if they call into question fundamental values and beliefs.  Again just because you choose to live in your partner’s country does not mean you have to compromise who you are.</p>
					<p class="lh-175">The answer to all of the above conundrums and potential areas of conflict is to communicate. Be prepared to talk about issues in your relationship particularly in the `getting to know you stage`. Then make a commitment to communicate throughout your relationship. Never make assumptions, particularly in a cross-cultural relationship.</p>
					<p class="lh-175">Discuss issues like how much free time is normal in a relationship.  Discuss your finances and whether both of you are going to work.  How will you raise children?  Where are you going to live and will there be the enough job opportunities for whoever is going to work.</p>
					<p class="lh-175">Communication is the secret to avoiding unnecessary conflict and to resolving conflict should it arise.  Some cultures are more adept at direct communication than others.  Nevertheless without some degree of commitment to discussing issues being made, your chances of a successful relationship become less and less.</p>
					<p class="lh-175">Are you thinking of marrying a Filipino lady? Filipina girls are renowned for their exquisiteness. Filipinas stand out amid Asian women in terms of charm as well as femininity. Filipino women are naturally romantic, loving along with caring. They are not just striking women but a pleasure to be with. They have many charming qualities you cleanly find in ladies of the western world.</p>
					{{-- <p class="lh-175">One practical way a couple can find out if they want to enter into a cross-cultural marriage is for either partner to seek a K1 fiancee visa.  You will need to obtain a K-1 Visa by filling out all the immigration forms.</p> --}}
					<p class="lh-175">Keep an open mind, accept there will be cultural differences and learn about them. A period of time in your partner’s country will allow you the space to really get to know your partner and their culture and will provide sufficient information for you to choose whether you want to marry your partner.</p>
				</div>
			</div>
		</div>
	</section>		
@endsection