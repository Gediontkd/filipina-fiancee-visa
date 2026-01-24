@extends('web.layout.master')
@section('content')
	@include('web.component.bread-crumb', [
		'title' => 'Resources',
	])
	<section class="resource_main_div bg-lightgrey ptb-100">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 section-title text-center">
					<h3>Resources</h3>
					<form action="javascript:void(0)" class="search_form">
						<input
						  	type="text"
						  	name="search"
						  	class="search_query float-left"
						  	id="search"
						  	placeholder="Type your search…"
						>
						<button
						  	type="button"
						  	class="search_submit float-right"
						  	id="searchBtn"
						>
							<i class="fa fa-search" aria-hidden="true"></i>Search
						</button>
                    </form>
				</div>
			</div>
			<div class="row">
			  	<div class="col-md-12">
			    	<div class="resources_topics">
			         	<ul class="row list-unstyled tag_list resourcePages">
							@foreach ($pages as $page)
								<li class="col-md-6">
									<a href="{{ $page->slug }}">
										<img src="{{ asset('assets/img/document2.png') }}">
										{{ $page->name }}
									</a>
								</li>							
	  						@endforeach
						</ul>
					</div>
		  		</div>		  	
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="questions-holder">
						<div class="question">
							<h5>Does a K1 visa entitle the foreign fiancee to a green card?</h5>
							<p>No, it does not. The K1 visa is a non-immigrant visa, which allows the holder to stay in the United States on a temporary basis. After the marriage takes place, the alien spouse must contact the USCIS to obtain conditional permanent residence status. The Filipino spouse may apply for removal of the conditional status and become a lawful permanent resident after two years.</p>
						</div>
						<div class="question">
							<h5>Can family members of the foreign fiancee be included in the petition?</h5>
							<p>Only the unmarried, minor children (below 21 years old) of the foreign fiancee can be included in the K1 petition and are eligible to apply for a K2 visa. If they are unable to depart with their parent, children who are named in the petition have one year (from the time the parent’s K1 visa is issued) to be issued K2 visas. They must apply for visas in a timely manner to allow visa issuance within the required time, otherwise the children will no longer be able to derive any immigration benefit from their parent’s K1 visa and new immigrant visa petitions need to be filed on their behalf.</p>
						</div>
						<div class="question">
							<h5>Can my foreign fiancee work in the U.S. with a K1 visa?</h5>
							<p>Yes. When the fiancee enters the United States he/she will be eligible to apply for a work permit after we file an Adjustment of Status for them. This will get them an Employment Authorization card.</p>
						</div>
						<div class="question">
							<h5>Can a Permanent Resident use the K1 Visa Procedure?</h5>
							<p>No. Unfortunately, this benefit is only available to U.S. Citizens, you must be a U.S. Citizen to be eligible to file a K1 Visa petition.</p>
						</div>
						<div class="question">
							<h5>Can my fiancee get a tourist visa or visitor visa?</h5>
							<p>Securing a US tourist visa is not a simple task. There are a lot of strict conditions and requirements that need to be complied with before the highly coveted B-1/B-2 visa may be issued. A Tourist Visa is "possible", although highly improbable. The U.S. Embassy in Manila denies the majority of tourist visa applicants. In more than a few occasions, applicants who are confident of being granted a US tourist visa are shocked by its denial.</p>
							<p>Although not an official requirement, those having success in achieving a tourist visa have held the test of being able to demonstrate proof of their return to Philippines at/prior to the end of  any would be tourist visa, which tends to need lots of Peso in the bank under a long standing high balance bank account, deed/title to house/lot and car, business, spouse/children, etc. any/all of which show ties to Philippines and a commanding reason to return and not disappear.</p>
							<p>The issuance of a tourist visa is not a sure-fire guarantee that the applicant will be allowed entry in the US since said holders are still subject to the scrutiny of the Department of Homeland Security (DHS) officials who are likewise empowered to deny entry even to valid tourist visa holders.</p>
							<p>If they suspect that the fiancee is trying to get a tourist visa for the purpose of getting married here it will be seen as an attempt to short-circuit the immigration process, and reason for instant denial.</p>
							<p>Don’t attempt to 'game' the system by applying for a tourist, student or employment visa for your fiancee. Not only does this waste time waiting for months only to hear that your fiancee’s application has been rejected, but it could serve to flag your fiancee as someone who is possibly attempting to enter the U.S. under false pretenses.</p>
							<p>Our advice is to go see your foreign fiancee in person.</p>
						</div>
						<div class="question">
							<h5>Can the K1 visa be used to travel in and out of the United States?</h5>
							<p>No. The K1 visa is a single-entry visa, which means that the K1 bearer who leaves the United States without changing marital and immigration status will not be able to re-enter the country on the same visa. A new petition and visa would be required.</p>
						</div>
						<div class="question">
							<h5>What should the foreign fiancee do upon entry into the United States?</h5>
							<p>The foreign fiancee has 90 days from admission into the United States to marry his/her petitioner. The K1 visa does not allow the bearer to marry anyone other than the petitioner. After the marriage, the couple must file an Adjustment of Status or legal status in the United States will be lost.</p>
						</div>
						<div class="question">
							<h5>Is the K1 Visa issued immediately following the embassy interview?</h5>
							<p>It is usually available for pick-up within 5-7 days after the embassy interview but if delivered by courier it could take 2-4 weeks.</p>
						</div>
						<div class="question">
							<h5>Do I need to be at my fiancee's consulate interview?</h5>
							<p>No. It really doesn't matter whether you are there or not. It is 100% the consular officer's prerogative to allow or disallow you in the interview room. In all cases your participation is not required or desired unless the officer asks you something in particular. The purpose of these interviews is to judge the fitness of the foreigner for entry/residence in the US and to satisfy the examining officer that the foreigner is entering into the arrangement with full knowledge and  free will. If you come on too strong and 'eager" it could look 'fishy" to the officer. You should sit down in person or over the phone or computer with your fiancee' just prior to the interview and go over names, dates facts on the petition itself and your background papers, so everything is fresh in your minds, whether you are attending the interview or not.</p>
						</div>
					</div>
				</div>					
			</div>
		</div>
	</section>
@endsection
@section('customScript')
<script type="text/javascript">
		$(document).on('click', '.search_form', function(e){
			e.preventDefault();
		})
		$(document).on('click', '#searchBtn', function(){
			var search = $('#search').val();
			$.ajax({
	            headers: {
	               'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
	            },
	            type: 'post',
	            url: "{{ route('resource.search') }}",
	            data: {
	                search: search
	            },
	            success: function(data) {
	               if (data.status == true) {
	                   $('.resourcePages').html(data.pages);          
	               }
	               if (data.status == false) {
	                    toastr.options.timeOut = 10000;
	                    toastr.error(data.message);
	                    setTimeout(function() {
	                        location.reload();
	                    }, 3000);
	               }
	            }
	        });
		});
	</script>
@endsection