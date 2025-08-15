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
								<li class="breadcrumb-item active" aria-current="page">Tagalog Phrases</li>
							</ol>
						</nav>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</section>
	<section class="resource-detail bg-lightgrey ptb-80">
		<div class="container">
			<div class="row">
			  	<div class="col-md-12">
					<div class="tagalog_english_div">
						<div class="row m-0 language_div">
							<div class="col-6 p-0">
								<div class="tagalog_head">
									<h2>Tagalog</h2>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_head">
									<h2>English</h2>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Mahal kita.</p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I love you.</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Minamahal kita. </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Iniibig kita. </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Sinisinta kita.</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Lab kita. (slang) </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Mahal ka sa akin.</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>You are dear to me.</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Mahal mo ba ako?</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Do you love me? </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>May iba ka na bang mahal?</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Do you love someone else?</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>May gusto ako sa iyo.</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I like you / I have a crush on you.</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Wala akong gusto sa iyo.</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I don't like you. </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Hindi kita mahal.</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I don't love you. </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Puwede ba kitang maging kasintahan?</p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Can you be my beloved? </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Puwede ba kitang ligawan?</p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>May I court you?</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>May nanliligaw ba sa iyo? </p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Is someone courting you?</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Gusto kita, pero kaibigan lang.</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I like you but just as a friend. </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Kaibigan lang ba ang turing mo sa akin? </p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>So you just like me for a friend? </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Gusto kitang makasama habang buhay.</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I want to spend the rest of my life with you. </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Gusto na kitang pakasalan.</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I want to marry you.</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Pakakasalan ba kita kung hindi kita mahal? </p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Would I marry you if I don't love you? </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Kailan tayo magpapakasal?</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>When are we getting married? </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Tatanggapin mo ba ang alay kong pakasalan kita? </p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Will you marry me? </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Mahal mo pa ba ako?</p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Do you still love me?</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>May gusto ka ba sa akin?</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Do you have a crush on me?</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Ikaw lamang   ang aking iibigin magpakailanman. </p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>You are the only one I will love forever. </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Ang pag-ibig ko sa iyo ay tunay.</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I love you truly. </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Mahal na Mahal na Mahal na Mahal na Mahal Kita!</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I love you, love you, love you, so much! </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>mag-liggat ka lagi!</p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>take care always!</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Mahal KITA, ngayonbukas at magpasawalang hanggan! </p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I love you, today, tomorrow, and always! </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Lagi kang nasa isip ko!</p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>You're always on my mind! </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Kailan kaya kita makakapiling muli?</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>When will I be with you again?</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Gusto ko, sa araw-araw ng buhay ko ay nasa tabi kita </p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I want that everyday of my life you are here, near me </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Giliw na giliw na ako sayo</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I miss you so much</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Ikaw lang ang lalaki na iibigin ko sa buong buhay ko</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>You are the only man that I will love in my whole life </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Gusto kong makapiling ka habang buhay </p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I want to spend the rest of my life with you </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>GUAPO ANG ASAWA KO! </p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>You’re handsome my husband! </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Ang ganda mo!</p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>You look lovely!</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Maganda Ka!</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>You are pretty</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Umiibig sa'yo ng tapat, </p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Loving you sincerely, faithfully? </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Laging nagmamahal sa'yo ng buong puso,</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Always loving you with all my heart, </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Nagmamahal sayo ng buong puso, </p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Loving you with all my heart,</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Halikan mo nga ako!</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Kiss me, please! </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Gusto kong makasiping ka</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I want to make love to you </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Gusto kong makita ang kagandahan ng buo mong katawan </p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Let me see you, all of your beautiful body</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Gusto kong mahawakan ka</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I want to hold you</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Hawakan mo ako at lambingin mo </p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Just hold me and caress me </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Sana isang araw, paggising ko ay nasa tabi na Kita! </p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I wish, that one day when I wake up, you are already beside me </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Halika na sa kama, mahal </p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>come to bed, love </p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Matulog na tayo, irog </p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>let's go to sleep, sweetheart</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Maraming salamat po</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>thank you very much</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Magandang binibini</p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>beautiful lady</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Gusto kita, magandang binibini</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I like you, beautiful lady</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Gusto kitang makita</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I want to see you</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Gusto kitang halikan</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I want to kiss you</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Gusto kitang yakapin</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I want to hug you</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Baliw na baliw ako sa iyo</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>I am so crazy about you</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Puwede ba?</p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>May I?</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Puwede ba kitang halikan</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>May I kiss you?</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Puwede ba kitang yakapin</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>May I hug you?</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Ikaw ang mundo ko</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>you are my world</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Ikaw lang ang babae sa buhay ko</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>you are the only woman in my life/for me</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Ano ang ibig mong sabihin?</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>what do you mean?</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Ang bango mo</p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>you smell good</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Ang sarap mo</p>
								</div>
							</div>	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>you are delicious</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Ang lambot mo</p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>you are soft</p>
								</div>
							</div>
						</div>
						<div class="row m-0 language_div">	
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>Malambot ang mga labi mo</p>
								</div>
							</div>
							<div class="col-6 p-0">
								<div class="tagalog_english_list">
									<p>your lips are so soft</p>
								</div>
							</div>
						</div>
					</div>						
				</div>	
			</div>
		</div>
	</section>		
@endsection