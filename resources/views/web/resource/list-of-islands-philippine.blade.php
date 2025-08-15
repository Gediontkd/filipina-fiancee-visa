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
								<li class="breadcrumb-item active" aria-current="page">List of islands of the Philippines</li>
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
			  	<div class="col-md-6 mb-5 about-us resource_hidden_img align-self-center">
					<div class="about-img-block ">
						<img src="{{ asset('assets/img/map.jpg') }}">
					</div>						
				</div>	
				<div class="col-md-6 mb-3 align-self-center">
					<div class="heading mb-3">
						<h2>List Of Islands Of The Philippines</h2>
					</div>
					<p class="lh-175">This is a <b class="fw-bold">list of islands of the Philippines</b>. The Philippine archipelago comprises 7,107 islands, of which only about 2,000 are inhabited. They are clustered into the three major island groups of Luzon, Visayas, and Mindanao.</p>
					<p class="lh-175">The following list breaks the islands down further by region and smaller island group for easier reference.</p>
				</div>
				<div class="col-md-12 mb-3 islands_columns">
					<div class="heading islands_head mb-3">
						<h2>Luzon</h2>
					</div>
					<div class="islands_lists">
						<h5>Babuyanes Islands</h5>
						<ul class="list-resourses">									 
							<li>Babuyan Island</li>
							<li>Balintang Island</li>
							<li>Barit Island</li>
							<li>Calayan Island</li>
							<li>Camiguin Island</li>
							<li>Dalupiri Island</li>
							<li>Didicas Island</li>
							<li>Fuga Island</li>
							<li>Irao Island</li>
							<li>Mabag Island</li>
							<li>Pamoctan Island</li>
							<li>Pan de Azucar Island</li>
							<li>Panuitan Island</li>
							<li>Pinon Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Bacuit Archipelago</h5>
						<ul class="list-resourses">									 
							<li>Bury Island</li>
							<li>Cadlao Island</li>
							<li>Calitang Island</li>
							<li>Camago Island</li>
							<li>Cavayan Island</li>
							<li>Caverna Island</li>
							<li>Commando Island</li>
							<li>Depeldet Island</li>
							<li>Diapila Island</li>
							<li>Dibuluan Island</li>
							<li>Dilumacad Island</li>
							<li>Dolarog Island</li>
							<li>Emmit Island</li>
							<li>Entalula Island</li>
							<li>Guintungauan Island</li>
							<li>Inambuyod Island</li>
							<li>Lagen Island</li>
							<li>Lalutaya Island</li>
							<li>Malapacao Island</li>
							<li>Matinloc Island</li>
							<li>Miniloc Island</li>
							<li>Mitre Island</li>
							<li>Nacpan Island</li>
							<li>North Guntao Island</li>
							<li>Paglugaban Island</li>
							<li>Pangalusian Island</li>
							<li>Peaked Island</li>
							<li>Pinagbuyatan Island</li>
							<li>Pinasil Island</li>
							<li>Saddle Island</li>
							<li>Shimizu Island</li>
							<li>South Guntao Island</li>
							<li>Tapiutan Island</li>
							<li>Tent Islands</li>
							<li>Vigan Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Batanes</h5>
						<ul class="list-resourses">									 
							<li>Batan Island</li>
							<li>Dequey Island</li>
							<li>Diogo Island</li>
							<li>Itbayat Island</li>
							<li>Ivuhos Island</li>
							<li>Mavudis Island</li>
							<li>Sabtang Island</li>
							<li>Siayan Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Bicol Region</h5>
						<ul class="list-resourses">									 
							<li>Anahau Island</li>
							<li>Anchor Island</li>
							<li>Animasola Island</li>
							<li>Apuao Grande Island</li>
							<li>Apuao Island</li>
							<li>Atulayan Island</li>
							<li>Bagacay Island</li>
							<li>Bagatao Island</li>
							<li>Bagieng Island</li>
							<li>Balagbag Islands</li>
							<li>Bani Island</li>
							<li>Basot Island</li>
							<li>Batan Island (Albay)</li>
							<li>Batan Island (Sorsogon)</li>
							<li>Buguias Island</li>
							<li>Butauanan Island</li>
							<li>Cagbalisay Island</li>
							<li>Cabgan Island</li>
							<li>Cagbinunga Island</li>
							<li>Cagbulauan Island</li>
							<li>Cagraray Island</li>
							<li>Calaguas Islands</li>
							<li>Calalanag Island</li>
							<li>Calambayanga Island</li>
							<li>Calintaan Island</li>
							<li>Canimo Island</li>
							<li>Canton Island</li>
							<li>Capugdan Island</li>
							<li>Caringo Island</li>
							<li>Cauit Island</li>
							<li>Cimarron Islets</li>
							<li>Cotivas Island</li>
							<li>Daruanac Island</li>
							<li>Dehanlo Island</li>
							<li>Entrance Island</li>
							<li>Etinas Island</li>
							<li>Gota Island</li>
							<li>Guihinyan Island</li>
							<li>Guinabugan Island</li>
							<li>Guinanayan Island</li>
							<li>Guintinua Island</li>
							<li>Haponan Island</li>
							<li>Huag Island</li>
							<li>Hunongan Island</li>
							<li>Ingalan Island</li>
							<li>Juag Island</li>
							<li>Laja Island</li>
							<li>Lahos Island</li>
							<li>Lahuy Island</li>
							<li>Lamit Islands</li>
							<li>Lato Islet</li>
							<li>Maculabo Island</li>
							<li>Mahadi Island</li>
							<li>Malarad Islands</li>
							<li>Malasugue Island</li>
							<li>Malaumaun Island</li>
							<li>Manito Island</li>
							<li>Masnou Island</li>
							<li>Matanga Island</li>
							<li>Matukad Island</li>
							<li>Minalahos Island</li>
							<li>Monteverde Island</li>
							<li>Ocata Island</li>
							<li>Pagbocayan Island</li>
							<li>Paguriran Island</li>
							<li>Palompon Islands</li>
							<li>Palita Island</li>
							<li>Palumbato Island</li>
							<li>Parayan Island</li>
							<li>Pimacuapan Islands</li>
							<li>Pinaglukaban Island</li>
							<li>Pitogo Island</li>
							<li>Puling Island</li>
							<li>Quinalasag Islands</li>
							<li>Quinamanuca Island</li>
							<li>Quinapagyan Island</li>
							<li>Rapu-rapu Island</li>
							<li>Refugio Island</li>
							<li>Rosa Islet</li>
							<li>Sabitang Laya Island</li>
							<li>Saboon Island</li>
							<li>Samur Island</li>
							<li>San Miguel Island (Albay)</li>
							<li>San Miguel Island (Camarines Sur)</li>
							<li>Siapa Island</li>
							<li>Sibauan Island</li>
							<li>Siruma Island</li>
							<li>Sombrero Island</li>
							<li>Subic Island</li>
							<li>Sula Island</li>
							<li>Tabusao Island</li>
							<li>Tag Island</li>
							<li>Tailon Island</li>
							<li>Tanao Islands</li>
							<li>Tanglar Island</li>
							<li>Ticlin Island</li>
							<li>Tinaga Island</li>
							<li>Tinago Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Cagayan Valley</h5>
						<ul class="list-resourses">									 
							<li>Apulagan Island</li>
							<li>Ati Island</li>
							<li>Catali Island</li>
							<li>Cent Island</li>
							<li>Dipodo Island</li>
							<li>Disumangit Island</li>
							<li>Escucha Island</li>
							<li>Estagno Island</li>
							<li>Dos Hermanos Islands (Cagayan)</li>
							<li>Gay Island</li>
							<li>Gran Laja Island</li>
							<li>Lafu Island</li>
							<li>Maloncon Island</li>
							<li>Manidad Island</li>
							<li>Masalansan Island</li>
							<li>Palaui Island</li>
							<li>Rona Island</li>
							<li>San Vicente Island</li>
							<li>Sibato Island</li>
							<li>Sinago Island</li>
							<li>Spires Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Calamianes Islands</h5>
						<ul class="list-resourses">									 
							<li>Alava Island</li>
							<li>Apo Island</li>
							<li>Ariara Island</li>
							<li>Bacbac Island</li>
							<li>Bakbak Island</li>
							<li>Bantac Island</li>
							<li>Barselisa Island</li>
							<li>Bayaca Island</li>
							<li>Binalabag Island</li>
							<li>Black Island</li>
							<li>Bolina Island</li>
							<li>Bugur Island</li>
							<li>Bulalacao Island</li>
							<li>Bunaun Island</li>
							<li>Busuanga Island</li>
							<li>Cabilauan Island</li>
							<li>Cabulauan Island</li>
							<li>Cacayatan Island</li>
							<li>Cagbatan Island</li>
							<li>Cagdanao Island</li>
							<li>Calanhayaun Island</li>
							<li>Calauit Island</li>
							<li>Calibang Island</li>
							<li>Calipipit Island</li>
							<li>Calumbagan Island</li>
							<li>Camanga Island</li>
							<li>Canaron Island</li>
							<li>Canipo Island</li>
							<li>Cheron Island</li>
							<li>Chindonan Island</li>
							<li>Compare Island</li>
							<li>Condut Island</li>
							<li>Coron Island</li>
							<li>Culion Island</li>
							<li>Debogso Island</li>
							<li>Delian Island</li>
							<li>Demelias Island</li>
							<li>Depagal Island</li>
							<li>Dibanca Islands</li>
							<li>Dibatoc Island</li>
							<li>Diboyoyan Island</li>
							<li>Dibutonay Island</li>
							<li>Dicabaito Island</li>
							<li>Dicalubuan Island</li>
							<li>Dicapadiac Island</li>
							<li>Dicapululan Island</li>
							<li>Dicoyan Island</li>
							<li>Dimakya Island</li>
							<li>Dimancal Island</li>
							<li>Dimanglet Island</li>
							<li>Dimansig Island</li>
							<li>Dimipac Island</li>
							<li>Dinanglet Island</li>
							<li>Dinaran Island</li>
							<li>Dipalian Island</li>
							<li>Ditaytayan Island</li>
							<li>Diwaran Island</li>
							<li>Dumunpalit Island [2]</li>
							<li>East Malcatop Island</li>
							<li>East Nalaut Island</li>
							<li>Elet Island</li>
							<li>Galoc Island</li>
							<li>Gintu Island</li>
							<li>Gued Island</li>
							<li>Guinlep Island</li>
							<li>Guintungauan Island</li>
							<li>Hadyibulao Island</li>
							<li>Hidong Island</li>
							<li>Horse Island</li>
							<li>Ile Island</li>
							<li>Inapupan Island</li>
							<li>Kalampisauan Island</li>
							<li>Lagat Island</li>
							<li>Lajo Island</li>
							<li>Lamud Island</li>
							<li>Lanit Island</li>
							<li>Lauauan Island</li>
							<li>Liatui Island</li>
							<li>Linapacan Island</li>
							<li>Lubutglubut Island</li>
							<li>Lusong Island</li>
							<li>Maapdit Island</li>
							<li>Magranting Island</li>
							<li>Malajon Island</li>
							<li>Malaposo Island</li>
							<li>Malaroyroy Island</li>
							<li>Malbatan Island</li>
							<li>Malcapuya Island</li>
							<li>Malcatop Island</li>
							<li>Malpagalen Island</li>
							<li>Maltatayoc Island</li>
							<li>Malubutglubut Island</li>
							<li>Manglet Island</li>
							<li>Manlegad Island</li>
							<li>Manolaba Island</li>
							<li>Manolebeng Island</li>
							<li>Marily Island</li>
							<li>Mayokok Island</li>
							<li>Mininlay Island</li>
							<li>Naglayan Island</li>
							<li>Nanga Island</li>
							<li>Nanga Island</li>
							<li>Nangalao Island</li>
							<li>Napula Island</li>
							<li>Napuscud Island</li>
							<li>North Cay Island</li>
							<li>North Malbinchilao Island</li>
							<li>Octon Island</li>
							<li>Pangaldavan Island</li>
							<li>Pangititan Island</li>
							<li>Pass Island</li>
							<li>Patoyo Island</li>
							<li>Pingkitinan Island</li>
							<li>Popototan Island</li>
							<li>Rat Island</li>
							<li>Rhodes Island</li>
							<li>Salimbubuc Island</li>
							<li>Salung Island</li>
							<li>Salvacion Island</li>
							<li>Sangat Island</li>
							<li>Santa Monica Island</li>
							<li>South Cay Island</li>
							<li>Talampulan Island</li>
							<li>Talanpetan Island</li>
							<li>Tambon Island</li>
							<li>Tampel Island</li>
							<li>Tangat Island</li>
							<li>Tanoban Island</li>
							<li>Tantangon Island</li>
							<li>Tara Island</li>
							<li>Teardrop Island</li>
							<li>Titangcob Island</li>
							<li>Uson Island</li>
							<li>Vanguardia Island</li>
							<li>West Nalaut Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Catanduanes</h5>
						<ul class="list-resourses">									 
							<li>Balacay Island</li>
							<li>Jumbit Islets</li>
							<li>Lete Island</li>
							<li>Macalanhag Island</li>
							<li>Maguinling Island</li>
							<li>Panay Island</li>
							<li>Pinohagan Island</li>
							<li>Pondanan Island</li>
							<li>Virac Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Central Luzon</h5>
						<ul class="list-resourses">									 
							<li>Camara Island</li>
							<li>Capones Island</li>
							<li>Egg Islands</li>
							<li>Hermana Mayor Island</li>
							<li>Hermana Menor Island</li>
							<li>Los Frailes Islands</li>
							<li>Magalawa Island</li>
							<li>Matalvi Island</li>
							<li>Pamana (Pequeña) Island</li>
							<li>Panatag Shoal or Scarborough Shoal (also claimed by China and Taiwan)</li>
							<li>Potipot Island</li>
							<li>Salvador Island</li>
							<li>Silanguin Island</li>
							<li>Subic Chiquita Island</li>
							<li>Subic Grande Island</li>
							<li>Tabones Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Cuyo Archipelago</h5>
						<ul class="list-resourses">									 
							<li>Adunbrat Island</li>
							<li>Agutaya Island</li>
							<li>Alcisiras Island</li>
							<li>Bararin Island</li>
							<li>Bisucay Island</li>
							<li>Canipo Island</li>
							<li>Caponyan Island</li>
							<li>Cauayan Island</li>
							<li>Cocoro Island</li>
							<li>Cuyo Island</li>
							<li>Dit Island</li>
							<li>Guinlabo Island</li>
							<li>Halog Island</li>
							<li>Imalaguan Island</li>
							<li>Imaruan Island</li>
							<li>Indagamy Island</li>
							<li>Lean Island</li>
							<li>Lubid Island</li>
							<li>Malcatop Island</li>
							<li>Maligun Island</li>
							<li>Manamoc Island</li>
							<li>Mandit Island</li>
							<li>Maracañao Island</li>
							<li>Matarabis Island</li>
							<li>Oco Island</li>
							<li>Pamalican Island</li>
							<li>Pamitinan Island</li>
							<li>Pandan Island</li>
							<li>Pangatatan Island</li>
							<li>Patungal Island</li>
							<li>Paya Island</li>
							<li>Payo Island</li>
							<li>Putic Island</li>
							<li>Quiniluban Island</li>
							<li>Quinimatin Island</li>
							<li>Quinimatin Chico Islands</li>
							<li>Round Island</li>
							<li>Silad Island</li>
							<li>Silat Island</li>
							<li>Siparay Island</li>
							<li>Tacbubuc Island</li>
							<li>Tagauayan Island</li>
							<li>Tatay Island</li>
							<li>Tinituan Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Ilocos Region</h5>
						<ul class="list-resourses">									 
							<li>Alo Island</li>
							<li>Badoc Island</li>
							<li>Balaqui Island</li>
							<li>Cabalitian Island</li>
							<li>Cabarruyan Island</li>
							<li>Cangaluyan Island</li>
							<li>Comas Island</li>
							<li>Culebra Island</li>
							<li>Dos Hermanos Islands</li>
							<li>Hundred Islands</li>
							<li>Lagtaras Island</li>
							<li>Monroe Island</li>
							<li>Narra Island</li>
							<li>Pinget Island</li>
							<li>Poro Island</li>
							<li>Salomague Island</li>
							<li>Santiago Island</li>
							<li>Siapar Island</li>
							<li>Silaqui Island</li>
							<li>Tagaporo Island</li>
							<li>Tambac Island</li>
							<li>Tanduyong Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Manila Bay Islands</h5>
						<ul class="list-resourses">									 
							<li>Caballo Island</li>
							<li>Carabao Island</li>
							<li>Corregidor Island</li>
							<li>El Fraile Island</li>
							<li>La Monja Island</li>
							<li>Los Cochinos Islands</li>
							<li>Tubutubu Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Marinduque</h5>
						<ul class="list-resourses">									 
							<li>Banot Island</li>
							<li>Elefante Island</li>
							<li>Hakupan Island</li>
							<li>Maniuaya Island</li>
							<li>Marinduque Island</li>
							<li>Mompog Island</li>
							<li>Salomaque Island</li>
							<li>San Andres Island</li>
							<li>Santa Cruz Island</li>
							<li>Tres Reyes Islands
								<ul>
									<li>Baltazar Island</li>
									<li>Gaspar Island</li>
									<li>Melchor Island</li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Masbate</h5>
						<ul class="list-resourses">									 
							<li>Arena Island</li>
							<li>Bagababoy Island</li>
							<li>Balanguingue Island</li>
							<li>Bugtung Island</li>
							<li>Burias Island</li>
							<li>Busing Island</li>
							<li>Cagpating Island</li>
							<li>Camasusu Island</li>
							<li>Carogo Island</li>
							<li>Chico Island</li>
							<li>Daquit-Daquit Island</li>
							<li>Deagan Island</li>
							<li>Gato Island</li>
							<li>Guilutugan Island</li>
							<li>Guinauayan Island</li>
							<li>Guinlabagan Island</li>
							<li>Guinluthagan Island</li>
							<li>Hamoraon Island</li>
							<li>Jintotolo Island</li>
							<li>Magcaraguet Island</li>
							<li>Majaba Island</li>
							<li>Manoc Island</li>
							<li>Masbate Island</li>
							<li>Matabao Island</li>
							<li>Nabugtu Island</li>
							<li>Nabugtut Island</li>
							<li>Nagarao Island</li>
							<li>Naguran Island</li>
							<li>Namatian Island</li>
							<li>Napayauan Island</li>
							<li>Naro Island</li>
							<li>Paltaban Island</li>
							<li>Piña Island</li>
							<li>Pobre Island</li>
							<li>Puting Island</li>
							<li>Sablayan Island</li>
							<li>San Miguel Island (Masbate)</li>
							<li>Sombreno Island</li>
							<li>Tanguingui Island</li>
							<li>Templo Island</li>
							<li>Ticao Island</li>
							<li>Tinalisayan Islets</li>
							<li>Tumalaytay Island</li>
							<li>Veagan Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Metro Manila</h5>
						<ul class="list-resourses">									 
							<li>Isla de Balut (Tondo)</li>
							<li>Isla de Convalecencia (San Miguel)</li>
							<li>Freedom Island (Parañaque) - man-made island</li>
							<li>Isla de Provisor (Paco)</li>
							<li>Isla Pulo (Navotas)</li>
							<li>Former islands
								<ul>
									<li>Isla de Binondo</li>
									<li>Isla de Romero (Quiapo)</li>
									<li>Isla de Tanduay (San Miguel)</li>
									<li>Isla de Tanque (Paco)</li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Mindoro</h5>
						<ul class="list-resourses">									 
							<li>Ambil Island</li>
							<li>Ambulong Island</li>
							<li>Anaganahao Island</li>
							<li>Apo Island (Mindoro)</li>
							<li>Alibatan Island</li>
							<li>Aslom Island</li>
							<li>Baco Grande Island</li>
							<li>Baco Chico Island</li>
							<li>Binantgaan Island</li>
							<li>Boquete Island</li>
							<li>Buyayao Island</li>
							<li>Cabra Island</li>
							<li>Cayos del Bajo Island</li>
							<li>Garza Island</li>
							<li>Golo Island</li>
							<li>Ilin Island</li>
							<li>Libago Island</li>
							<li>Lubang Island</li>
							<li>Maasim Island</li>
							<li>Malavatuan Island</li>
							<li>Malaylay Island</li>
							<li>Manadi Island</li>
							<li>Mandaui Island</li>
							<li>Masin Island</li>
							<li>Medio Island (Mindoro)</li>
							<li>Menor Island (Mindoro)</li>
							<li>Mindoro Island</li>
							<li>North Pandan Island</li>
							<li>Opao Island</li>
							<li>Pambaron Island</li>
							<li>Paniguian Island</li>
							<li>Pocanol Island</li>
							<li>San Antonio Island</li>
							<li>Sibalat Island</li>
							<li>Silonay Island</li>
							<li>South Pandan Island</li>
							<li>Suguicay Island</li>
							<li>Tambaron Island</li>
							<li>White Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Palawan</h5>
						<ul class="list-resourses">									 
							<li>Albaguen Island</li>
							<li>Albay Island</li>
							<li>Anas Island</li>
							<li>Apo Island</li>
							<li>Apulit Island</li>
							<li>Arena Island</li>
							<li>Arrecife Island (Bataraza)</li>
							<li>Arrecife Island (Honda Bay)</li>
							<li>Bagambangan Island</li>
							<li>Baja Hanura Island</li>
							<li>Balabac Island</li>
							<li>Bancalan Island</li>
							<li>Bancauan Island</li>
							<li>Bancoran Island</li>
							<li>Bangawan Island</li>
							<li>Bangiluan Island</li>
							<li>Barangonan Island</li>
							<li>Batas Island</li>
							<li>Bessie Island</li>
							<li>Bibangan Island</li>
							<li>Binatican Island</li>
							<li>Binga Island</li>
							<li>Bintaugan Island</li>
							<li>Binulbulan Island</li>
							<li>Bird's Island</li>
							<li>Bivouac Island</li>
							<li>Boayan Island</li>
							<li>Bongot Island</li>
							<li>Boombong Island</li>
							<li>Bowen Island</li>
							<li>Bucid Island</li>
							<li>Bugsuk Island</li>
							<li>Buquias Island</li>
							<li>Bush Island (Palawan)</li>
							<li>Butacan Island</li>
							<li>Byan Island</li>
							<li>Cabugan Islands</li>
							<li>Cabuli Island</li>
							<li>Cacbolo Island</li>
							<li>Cacbucao Island</li>
							<li>Cacnipa Island</li>
							<li>Cagayancillo Island</li>
							<li>Cagdanao Island</li>
							<li>Cagsalay Island</li>
							<li>Cakisigan Island</li>
							<li>Calabadian Island</li>
							<li>Calabatuan Island</li>
							<li>Calabucay Island</li>
							<li>Calabugdong Island</li>
							<li>Calalong Island</li>
							<li>Calampuan Island</li>
							<li>Calandagan Island</li>
							<li>Cambari Island</li>
							<li>Canabungan Island</li>
							<li>Candaraman Island</li>
							<li>Canimeran Island</li>
							<li>Cañon Island</li>
							<li>Capsalon Island</li>
							<li>Capyas Island</li>
							<li>Casian Island</li>
							<li>Casirahan Island</li>
							<li>Castle Island</li>
							<li>Catalat Island</li>
							<li>Cauayan Island</li>
							<li>Cavili Island</li>
							<li>Cayoya Island</li>
							<li>Central Island</li>
							<li>Comiran Island</li>
							<li>Coral Island</li>
							<li>Cotad Island</li>
							<li>Dadaliten Island</li>
							<li>Dalahican Island</li>
							<li>Damad Island</li>
							<li>Daracotan Island</li>
							<li>Datag Islands</li>
							<li>Debangan Island</li>
							<li>Denanayan Island</li>
							<li>Deribongan Island</li>
							<li>Dinif Island</li>
							<li>Dinisonan Island</li>
							<li>Ditadita Island</li>
							<li>Ditnot Island</li>
							<li>Dondonay Island</li>
							<li>Double Island</li>
							<li>Dry Island</li>
							<li>Dumaran Island</li>
							<li>Elephant Island</li>
							<li>Emelina Island</li>
							<li>Flower Island</li>
							<li>Fondeado Island</li>
							<li>Fraser Island</li>
							<li>Gabung Island</li>
							<li>Gardiner Island</li>
							<li>Green Island</li>
							<li>Guindabdaban Island</li>
							<li>Hen and Chickens Island</li>
							<li>Howley Island</li>
							<li>Ibalaton Island</li>
							<li>Ibohor Island</li>
							<li>Ibulbol Island</li>
							<li>Icadambanauan Island</li>
							<li>Iloc Island</li>
							<li>Imorigue Island</li>
							<li>Imuruan Island</li>
							<li>Inamukan Island</li>
							<li>Inobian Island</li>
							<li>Inoladoan Island</li>
							<li>Johnson Island</li>
							<li>Josefa Island</li>									
							<li>Kalayaan Islands or Spratly Islands (claimed by China, Taiwan, Malaysia, Brunei and Vietnam)
								<ul>
									<li>Bailan Island</li>
									<li>Binago Island</li>
									<li>Kota Island</li>
									<li>Lagos Island</li>
									<li>Lawak Island</li>
									<li>Ligao Island</li>
									<li>Likas Island</li>
									<li>Pag-asa Island</li>
									<li>Panata Island</li>
									<li>Parola Island</li>
									<li>Patag Island</li>
									<li>Pugad Island</li>
									<li>Rurok Island</li>
								</ul>
							</li>
							<li>Kalungpang Island</li>
							<li>Kaoya Island</li>
							<li>Lampiligan Island</li>
							<li>Langisan Island</li>
							<li>Langoy Island</li>
							<li>Liabdan Island</li>
							<li>Linda Island</li>
							<li>Little Maosanon Island</li>
							<li>Lomalayang Island</li>
							<li>Luli Island</li>
							<li>Lumbucan Island</li>
							<li>Lump Island</li>
							<li>Maalaquequen Island</li>
							<li>Macuao Island</li>
							<li>Maducang Island</li>
							<li>Makesi Island</li>
							<li>Malaibo Island</li>
							<li>Malanao Island</li>
							<li>Malapackun Island</li>
							<li>Malapnia Island</li>
							<li>Malauton Island</li>
							<li>Malcorot Island</li>
							<li>Malinsono Island</li>
							<li>Malotamban Island</li>
							<li>Mantangule Island</li>
							<li>Manuc Manucan Island</li>
							<li>Manucan Island</li>
							<li>Manulali Island</li>
							<li>Maobanen Island</li>
							<li>Maosanon Island</li>
							<li>Maqueriben Island</li>
							<li>Marantao Island</li>
							<li>Maraquit Island</li>
							<li>Maricaban Island</li>
							<li>Mariquit Island</li>
							<li>Maroday Island</li>
							<li>Mayabacan Island</li>
							<li>Mayakli Island</li>
							<li>Maybara Island</li>
							<li>Maylakan Island</li>
							<li>Maytiguid Island</li>
							<li>Meara Island</li>
							<li>Mialbok Island</li>
							<li>Nabat Island</li>
							<li>Nagulon Island</li>
							<li>Nasalet Island</li>
							<li>Nasubata Island</li>
							<li>Niaporay Island</li>
							<li>Nokoda Island</li>
							<li>North Channel Island</li>
							<li>North Islet (Tubbataha Reef)</li>
							<li>North Mangsee Island</li>
							<li>North Verde Island</li>
							<li>Notch Island</li>
							<li>Pabellon Islands</li>
							<li>Palawan Island</li>
							<li>Palm Island</li>
							<li>Paly Island</li>
							<li>Pamalatan Island</li>
							<li>Pandan Island</li>
							<li>Pandanan Island</li>
							<li>Pangisian Island</li>
							<li>Papagapa Island</li>
							<li>Parunponon Island</li>
							<li>Passage Island</li>
							<li>Patawan Island</li>
							<li>Patetan Island</li>
							<li>Patongong Island</li>
							<li>Peaked Island</li>
							<li>Pez Island</li>
							<li>Pirate Island</li>
							<li>Puerco Island</li>
							<li>Pulaw Talam Island</li>
							<li>Puntog Islands</li>
							<li>Quimbaludan Island</li>
							<li>Ramesamey Island</li>
							<li>Ramos Island</li>
							<li>Rangod Island</li>
							<li>Rasa Island</li>
							<li>Reinard Island</li>
							<li>Rinambacan Island</li>
							<li>Rita Island</li>
							<li>Rizal Pongtog Island</li>
							<li>Roughton Island</li>
							<li>Salingsingan Island</li>
							<li>San Miguel Islands</li>
							<li>Sanz Island</li>
							<li>Secam Island</li>
							<li>Segyam Islands</li>
							<li>Señorita Island</li>
							<li>Shell Island</li>
							<li>Silanga Islands</li>
							<li>Small Pagbo Island</li>
							<li>Sombrero Island</li>
							<li>South Island</li>
							<li>South Islet (Tubbataha Reef)</li>
							<li>South Mangsee Island</li>
							<li>South Verde Island</li>
							<li>Stanlake Island</li>
							<li>Suotiv Island</li>
							<li>Tagalinong Island</li>
							<li>Tagbulo Island</li>
							<li>Talacanen Island</li>
							<li>Tanusa Island</li>
							<li>Tarusan Islands</li>
							<li>Temple Island</li>
							<li>Tidepole Island</li>
							<li>Tomandang Island</li>
							<li>Tres Marias Islands</li>
							<li>Triple Cima Island</li>
							<li>Tubbataha Reef</li>
							<li>Tuluran Island</li>
							<li>Ursula Island</li>
							<li>Wedge Island</li>
							<li>White Island</li>
							<li>White Round Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Polillo Islands</h5>
						<ul class="list-resourses">									 
							<li>Anawan Island</li>
							<li>Anirong Island</li>
							<li>Balesin Island</li>
							<li>Buguitay Island</li>
							<li>Cabaloa Island</li>
							<li>Diligin Island</li>
							<li>East Ikikon Island</li>
							<li>Icol Island</li>
							<li>Ikikon Island</li>
							<li>Jomalig Island</li>
							<li>Kalongkooan Island</li>
							<li>Kalotkot Island</li>
							<li>Karlagan Island</li>
							<li>Katabunan Island</li>
							<li>Katakian Chica Island</li>
							<li>Katakian Grande Island</li>
							<li>Lantao Island</li>
							<li>Lumaya Island</li>
							<li>Malaguinoan Island</li>
							<li>Minamata Island</li>
							<li>Palasan Island</li>
							<li>Pandanan Island</li>
							<li>Patnanungan Island</li>
							<li>Pinaglonglogan Island</li>
							<li>Polillo Island</li>
							<li>San Rafael Island</li>
							<li>Uala Islands</li>
							<li>Usok Island</li>
						</ul>
					</div>	
					<div class="islands_lists">
						<h5>Romblon</h5>
						<ul class="list-resourses">									 
							<li>Alad Island</li>
							<li>Banton Island</li>
							<li>Bantoncillo Island</li>
							<li>Biaringan Island</li>
							<li>Cabahan Island</li>
							<li>Carabao Island</li>
							<li>Carlota Island</li>
							<li>Cobrador Island</li>
							<li>Cresta de Gallo Island</li>
							<li>Guindauahan Island</li>
							<li>Isabel Island</li>
							<li>Japar Islet</li>
							<li>Lugbon Island</li>
							<li>Maestro de Campo Island</li>
							<li>Polloc Island</li>
							<li>Romblon Island</li>
							<li>Sibuyan Island</li>
							<li>Simara Island</li>
							<li>Tablas Island</li>
						</ul>
					</div>	
					<div class="islands_lists">
						<h5>Southern Tagalog</h5>
						<ul class="list-resourses">									 
							<li>Alabat Island</li>
							<li>Alibijaban Island</li>
							<li>Anilon Island</li>
							<li>Apat Island</li>
							<li>Bakaw-Bakaw Island</li>
							<li>Balot Island</li>
							<li>Baluti Island</li>
							<li>Binombonan Island</li>
							<li>Bird Island</li>
							<li>Bonga Island</li>
							<li>Bonito Island</li>
							<li>Bubuin Island</li>
							<li>Burunggoy Island</li>
							<li>Caban Island</li>
							<li>Cagbalete Island</li>
							<li>Calamba Island</li>
							<li>Culebra Island</li>
							<li>Dalig Island</li>
							<li>Dampalitan Island</li>
							<li>Fortune Island</li>
							<li>Ikulong Island</li>
							<li>Isla Puting Bato Island</li>
							<li>Lagdauin Island</li>
							<li>Lambauing Island</li>
							<li>Ligpo Island</li>
							<li>Limbones Island</li>
							<li>Malahi Island</li>
							<li>Malajibomanoc Island</li>
							<li>Mangayao Island</li>
							<li>Manlanat Island</li>
							<li>Maricaban Island</li>
							<li>Napayong Island</li>
							<li>Pagbilao Chica Island</li>
							<li>Pagbilao Grande Island</li>
							<li>Palasan Island</li>
							<li>Patayan Island</li>
							<li>Santa Amalia Island</li>
							<li>Sombrero Island</li>
							<li>Talabaan Islands</li>
							<li>Talim Island</li>
							<li>Twin Island</li>
							<li>Verde Island</li>
							<li>Volcano Island</li>
						</ul>
					</div>
					<div class="heading">
						<h2>Mindanao</h2>
					</div>
					<div class="islands_lists">
						<h5>Caraga</h5>
						<ul class="list-resourses">									 
							<li>Agony Island (Surigao del Sur)</li>
							<li>Aling Island</li>
							<li>Amaga Island</li>
							<li>Arangasa Islands</li>
							<li>Ayninan Island</li>
							<li>Ayoki Island</li>
							<li>Bagasinan Island</li>
							<li>Banga Island</li>
							<li>Bayagnan Island</li>
							<li>Britania Island</li>
							<li>Cabgan Island (Surigao del Sur)</li>
							<li>Condona Island</li>
							<li>Gabao Islet</li>
							<li>General Island (Surigao del Norte)</li>
							<li>Hamuan Island</li>
							<li>Haycock Islands</li>
							<li>Hinatuan Island</li>
							<li>Jobo Island</li>
							<li>Kabo Island</li>
							<li>Lamagon Island</li>
							<li>Lapinigan Island</li>
							<li>Lenungao Islands</li>
							<li>Load Island</li>
							<li>Ludguran Island</li>
							<li>Maanoc Island</li>
							<li>Mahaba Island (Surigao del Norte)</li>
							<li>Mahaba Island (Surigao del Sur)</li>
							<li>Majangit Island</li>
							<li>Mancahoram Island</li>
							<li>Mancangangi Island</li>
							<li>Maopia Island</li>
							<li>Maowa Island</li>
							<li>Masapelid Island</li>
							<li>Mawes Island</li>
							<li>Nagubat Island</li>
							<li>Panirongan Island</li>
							<li>Puyo Island</li>
							<li>Singag Island</li>
							<li>Sugbu Island</li>
							<li>Taganongan Island</li>
							<li>Talavera Island</li>
							<li>Tigdos Island</li>
							<li>Tinago Island (Surigao del Norte)</li>
							<li>Unamao Island</li>
						</ul>
					</div>	
					<div class="islands_lists">
						<h5>Central Mindanao</h5>
						<ul class="list-resourses">									 
							<li>Alidama Island</li>
							<li>Balot Island</li>
							<li>Balutmato Island</li>
							<li>Bongo Island</li>
							<li>Donayang Island</li>
							<li>East Balut Island</li>
							<li>Ibus Island</li>
							<li>Limbayan Island</li>
							<li>Sarampungan Island</li>
							<li>Tagatungan Island</li>
							<li>Taytayan Island</li>
							<li>West Balut Island</li>
							<li>Balaysan Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Davao Region</h5>
						<ul class="list-resourses">									 
							<li>Balut Island</li>
							<li>Big Cruz Island</li>
							<li>Buenavista Island</li>
							<li>Bugoso Island</li>
							<li>Cabugao Island</li>
							<li>Dumalag Island</li>
							<li>Ivy Island</li>
							<li>Kopia Island</li>
							<li>Little Cruz Island</li>
							<li>Luban Island</li>
							<li>Malipano Island</li>
							<li>Manamil Island</li>
							<li>Mangrove Island</li>
							<li>Oak Island</li>
							<li>Olanivan Island</li>
							<li>Pandasan Island</li>
							<li>Pujada Island</li>
							<li>Quinablongan Island</li>
							<li>Samal Island</li>
							<li>San Victor Island</li>
							<li>Sarangani Island</li>
							<li>Sigaboy Island</li>
							<li>Talicud Island</li>
							<li>Uanivan Island</li>
						</ul>
					</div>	
					<div class="islands_lists">
						<h5>Dinagat Islands</h5>
						<ul class="list-resourses">									 
							<li>Awasan Island</li>
							<li>Capiquian Island</li>
							<li>Danaon Island</li>
							<li>Dinagat Island</li>
							<li>Doot Island</li>
							<li>East Caliban Island</li>
							<li>Hagaknab Island</li>
							<li>Hanigad Island</li>
							<li>Hibuson Island</li>
							<li>Hikdop Island</li>
							<li>Kanhanusa Island</li>
							<li>Kanihaan Island</li>
							<li>Kayabangan Island</li>
							<li>Kayosa Island</li>
							<li>Kotkot Island</li>
							<li>Little Hibuson Island</li>
							<li>Nonoc Island</li>
							<li>Pangabangan Island</li>
							<li>Puyo Island (Dinagat)</li>
							<li>Rasa Island</li>
							<li>Sayao Island</li>
							<li>Sibale Island (Dinagat)</li>
							<li>Sibanac Island</li>
							<li>Sibanoc Island</li>
							<li>Sumilon Island (Dinagat)</li>
							<li>Tabuk Island</li>
							<li>Unib Island</li>
							<li>West Caliban Island</li>
						</ul>
					</div>	
					<div class="islands_lists">
						<h5>Northern Mindanao</h5>
						<ul class="list-resourses">									 
							<li>Agutayan Island</li>
							<li>Bao-Baon Islands</li>
							<li>Cabgan Island</li>
							<li>Camiguin Island</li>
							<li>Capayas Island</li>
							<li>Dolphin Island</li>
							<li>Maburos Island</li>
							<li>Mantigue Island</li>
							<li>Naputhaw Island</li>
							<li>Silanga Island</li>
							<li>White Island</li>
						</ul>
					</div>	
					<div class="islands_lists">
						<h5>Siargao</h5>
						<ul class="list-resourses">									 
							<li>Abanay Island</li>
							<li>Anahawan Island</li>
							<li>Antokon Island</li>
							<li>Bancuyo Island</li>
							<li>Bucas Grande Island</li>
							<li>Cambiling Island</li>
							<li>Casalian Island</li>
							<li>Cawhagan Island</li>
							<li>Corregidor Island</li>
							<li>Daku Island</li>
							<li>East Bucas Island</li>
							<li>Guyam Island</li>
							<li>Halian Island</li>
							<li>Kangbangio Island</li>
							<li>Kangnun Island</li>
							<li>Kaob Island</li>
							<li>Lajanosa Island</li>
							<li>Laonan Island</li>
							<li>Mamon Island</li>
							<li>Megancub Island</li>
							<li>Middle Bucas Island</li>
							<li>Pagbasoyan Island</li>
							<li>Pansukian Island</li>
							<li>Poneas Island</li>
							<li>Siargao Island</li>
							<li>Tona Island</li>
						</ul>
					</div>	
					<div class="islands_lists">
						<h5>Sulu Archipelago</h5>
						<ul class="list-resourses">									 
							<li>Andulinang Island</li>
							<li>Babuan Island</li>
							<li>Baguan Island</li>
							<li>Balanguingui</li>
							<li>Baliungan Island</li>
							<li>Balukbaluk Island</li>
							<li>Bambanan Island</li>
							<li>Banaran Island</li>
							<li>Bangalao Island</li>
							<li>Bankungan Island</li>
							<li>Basbas Island</li>
							<li>Basibuli Islands</li>
							<li>Basilan Island</li>
							<li>Batalinos Islands</li>
							<li>Baturapac Island</li>
							<li>Bauang Diki Island</li>
							<li>Bihintinusa Island</li>
							<li>Bilangan Island</li>
							<li>Bilatan Island</li>
							<li>Bintoulan Island</li>
							<li>Bintut Island</li>
							<li>Bitinan Island</li>
							<li>Boaan Island</li>
							<li>Bohan Island</li>
							<li>Bongao Island</li>
							<li>Buan Island</li>
							<li>Bubuan Island</li>
							<li>Bucutua Island</li>
							<li>Bulan Island</li>
							<li>Buli Nusa Islet</li>
							<li>Buliculul Island</li>
							<li>Bulicutin Island</li>
							<li>Bulisuan Island</li>
							<li>Buluan Island</li>
							<li>Bulubulu Islet</li>
							<li>Bunabunaan Island</li>
							<li>Bungbunan Island</li>
							<li>Bunotpasil Island</li>
							<li>Cabingaan Island</li>
							<li>Cabucan Island</li>
							<li>Cacatan Island</li>
							<li>Cagayan de Sulu Island</li>
							<li>Calaitan Islets</li>
							<li>Calupag Island</li>
							<li>Camabalan Island</li>
							<li>Canas Island</li>
							<li>Cancuman Island</li>
							<li>Cap Island</li>
							<li>Capual Island</li>
							<li>Celandat Islets</li>
							<li>Coco Island</li>
							<li>Cujangan Island</li>
							<li>Cunilan Island</li>
							<li>Dakule Island</li>
							<li>Dalauan</li>
							<li>Dammai Island</li>
							<li>Dasaan Islands</li>
							<li>Dasalan Island</li>
							<li>Datubato Islands</li>
							<li>Dawata Island</li>
							<li>Dawildawil Island</li>
							<li>Deatobato Island</li>
							<li>Dipolod Island</li>
							<li>Doc Can Island</li>
							<li>Dongdong Island</li>
							<li>Dundangon Island</li>
							<li>East Bolod Island</li>
							<li>Gaiya Island</li>
							<li>Gal-loman Island</li>
							<li>Gondra Island</li>
							<li>Goreno Island</li>
							<li>Great Bakungaan Island</li>
							<li>Great Gounan Island</li>
							<li>Guimba Island</li>
							<li>Gujangan Island</li>
							<li>Haluluko Island</li>
							<li>Hegad Island</li>
							<li>Hole Island</li>
							<li>Jinhling Island</li>
							<li>Jolo Island</li>
							<li>Kabancauan Island</li>
							<li>Kaludlud Island</li>
							<li>Kaluitan Island</li>
							<li>Kamawi Island</li>
							<li>Kang Tipayan Dakula Island</li>
							<li>Kang Tipayan Diki Island</li>
							<li>Kauluan Island</li>
							<li>Kinapusan Island</li>
							<li>Kulassein Island</li>
							<li>Laa Island</li>
							<li>Lahangon Island</li>
							<li>Lahatlahat Island</li>
							<li>Lahatlahat Islands</li>
							<li>Lakit Island</li>
							<li>Laminusa Island</li>
							<li>Lampinigan Island</li>
							<li>Langaan Island</li>
							<li>Langas Island</li>
							<li>Lanhil Island</li>
							<li>Lapac Island</li>
							<li>Laparan Island</li>
							<li>Latuan Island</li>
							<li>Lawayan Island</li>
							<li>Lemondo Island</li>
							<li>Liaburan Island</li>
							<li>Lihiman Island</li>
							<li>Linawan Island</li>
							<li>Little Coco Island</li>
							<li>Little Dipolod Island</li>
							<li>Loran Island</li>
							<li>Lubucan Island</li>
							<li>Lugus Island</li>
							<li>Lumbian Island</li>
							<li>Lupa Island</li>
							<li>Magados Island</li>
							<li>Magpeos Island</li>
							<li>Malamawi Island</li>
							<li>Malicut Island</li>
							<li>Mamad Island</li>
							<li>Mamanak Island</li>
							<li>Mamanoc Island</li>
							<li>Mamanuc Island</li>
							<li>Mambahenauhan Island</li>
							<li>Manangal Island</li>
							<li>Manate Island</li>
							<li>Mandah Island</li>
							<li>Maniacolat Island</li>
							<li>Mantabuan Island</li>
							<li>Manubul Island</li>
							<li>Manuk Manka Island</li>
							<li>Manungut Island</li>
							<li>Maranas Island</li>
							<li>Marungas Island</li>
							<li>Mataja Island</li>
							<li>Minis Island</li>
							<li>Muligi Islands</li>
							<li>Nancan Island</li>
							<li>North Ubian Island</li>
							<li>Nusa Buani Island</li>
							<li>Nusa Islands</li>
							<li>Omapoy Island</li>
							<li>Orell Island</li>
							<li>Pahumaan Island</li>
							<li>Palajangan Island</li>
							<li>Pamelican Island</li>
							<li>Pamisaan Island</li>
							<li>Pandak Island</li>
							<li>Pandalan Island</li>
							<li>Pandanan Island</li>
							<li>Pandami Island</li>
							<li>Pandugas Island</li>
							<li>Pangana Paturuan Island</li>
							<li>Panganap Island</li>
							<li>Pangas Island</li>
							<li>Pangasahan Island</li>
							<li>Pangasinan Island</li>
							<li>Panguan Islet</li>
							<li>Pantocunan Island</li>
							<li>Papahag Island</li>
							<li>Paquia Island</li>
							<li>Parangan Island</li>
							<li>Paral Island</li>
							<li>Pasigpasilan Island</li>
							<li>Pata Island</li>
							<li>Patian Island</li>
							<li>Perangan Island</li>
							<li>Pilas Island</li>
							<li>Pintado Island</li>
							<li>Punungan Islet</li>
							<li>Salaro Island</li>
							<li>Saluag Island</li>
							<li>Salkulakit Island</li>
							<li>Saluping Island</li>
							<li>Sanga-Sanga Island</li>
							<li>Sangasiapu Island</li>
							<li>Sangboy Islands</li>
							<li>Sarucsarucan Island</li>
							<li>Sasa Island</li>
							<li>Secubun Island</li>
							<li>Siasi Island</li>
							<li>Sibago Island</li>
							<li>Sibakel Island</li>
							<li>Sibijindacula Island</li>
							<li>Sibutu Island</li>
							<li>Sicagot Island</li>
							<li>Sicalangcalong Island</li>
							<li>Sicolan Islet</li>
							<li>Silumisan Island</li>
							<li>Siluag Island</li>
							<li>Simanayo Island</li>
							<li>Simbay Island</li>
							<li>Simisa Island</li>
							<li>Simunul Island</li>
							<li>Singaan Island</li>
							<li>Sipangkot Island</li>
							<li>Sipayu Island</li>
							<li>Sipungot Island</li>
							<li>Siringo Island</li>
							<li>Sirun Island</li>
							<li>Sitangkai Island</li>
							<li>Situgal Hea Island</li>
							<li>South Ubian Island</li>
							<li>Sucoligao Island</li>
							<li>Sugbai Island</li>
							<li>Suka Suka Dakula Islet</li>
							<li>Sulade Island</li>
							<li>Sumbasumba Island</li>
							<li>Suucan Island</li>
							<li>Taala Island</li>
							<li>Tabawan Island</li>
							<li>Tabolongan Island</li>
							<li>Tabuan Islands</li>
							<li>Taganak Island</li>
							<li>Tagao Island</li>
							<li>Tagutu Island</li>
							<li>Taitagan Island</li>
							<li>Taja Island</li>
							<li>Takela Island</li>
							<li>Takipamasilaan Island</li>
							<li>Talonpisa Island</li>
							<li>Taluc Island</li>
							<li>Talungan Island</li>
							<li>Tambilunay Island</li>
							<li>Tambulian Island</li>
							<li>Tamuk Island</li>
							<li>Tancan Island</li>
							<li>Tancolaluan Island</li>
							<li>Tandubas Island</li>
							<li>Tandubatu Island</li>
							<li>Tandungan Island</li>
							<li>Tanduowak Island</li>
							<li>Tapaan Island</li>
							<li>Tapiantana Island</li>
							<li>Tapul Island</li>
							<li>Tara Island</li>
							<li>Tataan Islands</li>
							<li>Tatalan Island</li>
							<li>Tatik Island</li>
							<li>Tauitaui Island</li>
							<li>Tawi-Tawi Island</li>
							<li>Teinga Island</li>
							<li>Tengolan Island</li>
							<li>Teomabal Island</li>
							<li>Ticul Island</li>
							<li>Tiguilabun Island</li>
							<li>Tihik Tihik Island</li>
							<li>Tijitiji Islands</li>
							<li>Tinundukan Island</li>
							<li>Tinutungan Island</li>
							<li>Tongquil Island</li>
							<li>Tonkian Islands</li>
							<li>Tubalubac Island</li>
							<li>Tubigan Island</li>
							<li>Tulayan Island</li>
							<li>Tulian Island</li>
							<li>Tumbagaan Island</li>
							<li>Tumindao Island</li>
							<li>Tunbaunan Island</li>
							<li>Tungbukan Island</li>
							<li>Turtle Islands</li>
							<li>Tusan Bongao Island</li>
							<li>Tutu Kipa Island</li>
							<li>Ultra Island</li>
							<li>Usada Island</li>
							<li>West Bolod Island</li>
							<li>Zau Island</li>
						</ul>
					</div>		
					<div class="islands_lists">
						<h5>Zamboanga Peninsula</h5>
						<ul class="list-resourses">									 
							<li>Aliguay Island</li>
							<li>Bagiyas Island</li>
							<li>Balabac Island</li>
							<li>Bangaan Island</li>
							<li>Baong Island</li>
							<li>Bibaya Island</li>
							<li>Bobo Island</li>
							<li>Buguias Island</li>
							<li>Buloan Island</li>
							<li>Caboc Island</li>
							<li>Cabog Island</li>
							<li>Cabut Island</li>
							<li>Cambugan Island</li>
							<li>Condulingan Island</li>
							<li>Dao-Dao Islands</li>
							<li>Gatusan Island</li>
							<li>Great Santa Cruz Island</li>
							<li>Igat Island</li>
							<li>Kabungan Island</li>
							<li>Lambang Island</li>
							<li>Lampinigan Island</li>
							<li>Lamuyong Island</li>
							<li>Lapinigan Islands</li>
							<li>Latas Island</li>
							<li>Letayon Island</li>
							<li>Lipari Island</li>
							<li>Little Malanipa Island</li>
							<li>Little Santa Cruz Island</li>
							<li>Lungui Island</li>
							<li>Lutangan Island</li>
							<li>Maculay Island</li>
							<li>Malanipa Island</li>
							<li>Murcielagos Island</li>
							<li>Nipa Nipa Islands</li>
							<li>Olutanga Island</li>
							<li>Pandalusan Island</li>
							<li>Panikian Island</li>
							<li>Paraitan Island</li>
							<li>Pina Island</li>
							<li>Pinya Island</li>
							<li>Piñahun Island</li>
							<li>Pisan Island</li>
							<li>Pitas Island</li>
							<li>Puli Puli Island</li>
							<li>Putili Island</li>
							<li>Sacol Island</li>
							<li>Sagayaran Island</li>
							<li>Salangan Island</li>
							<li>Selinog Island</li>
							<li>Sibulan Islands</li>
							<li>Simoadang Island</li>
							<li>Sirumon Island</li>
							<li>Ticala Islands</li>
							<li>Tictauan Island</li>
							<li>Tigabon Island</li>
							<li>Tigbauan Island</li>
							<li>Tigburacao Island</li>
							<li>Triton Island</li>
							<li>Tugsocan Island</li>
							<li>Tumalutab Island</li>
							<li>Visa Island</li>
							<li>Vitali Island</li>
						</ul>
					</div>		
					<div class="heading">
						<h2>Visayas</h2>
					</div>
					<div class="islands_lists">
						<h5>Biliran</h5>
						<ul class="list-resourses">									 
							<li>Calutan Island</li>
							<li>Capiñahan Island</li>
							<li>Caygan Island</li>
							<li>Dalutan Island</li>
							<li>Ginuroan Island</li>
							<li>Higatangan Island</li>
							<li>Maripipi Island</li>
							<li>Sambawan Island</li>
							<li>Tagampol Islet</li>
							<li>Tingkasan Islet</li>
						</ul>
					</div>	
					<div class="islands_lists">
						<h5>Bohol</h5>
						<ul class="list-resourses">									 
							<li>Balicasag Island</li>
							<li>Banacon Island</li>
							<li>Banbanon Island</li>
							<li>Bansaan Island</li>
							<li>Bilangbilangan Island</li>
							<li>Bonoon Island</li>
							<li>Cabantulan Island</li>
							<li>Cabgan Island (Bohol)</li>
							<li>Cabilao Island</li>
							<li>Calituban Island</li>
							<li>Calongaman Island</li>
							<li>Cancostino Island</li>
							<li>Cataban Island</li>
							<li>Catang Island</li>
							<li>Cauayan Island</li>
							<li>Gak-ang Island</li>
							<li>Gaus Island</li>
							<li>Guindacpan Island</li>
							<li>Handayan Island</li>
							<li>Hingutanan Island</li>
							<li>Inanoran Island</li>
							<li>Jao Island</li>
							<li>Lapinig Island</li>
							<li>Lapinig Chico Island</li>
							<li>Lumislis Island</li>
							<li>Ma-agpit Island</li>
							<li>Mahanay Island</li>
							<li>Malingin Island</li>
							<li>Mantatao Island</li>
							<li>Maumauan Island</li>
							<li>Nonocnocan Island</li>
							<li>Pamasaun Island</li>
							<li>Pamilacan Island</li>
							<li>Panga Island</li>
							<li>Pangangan Island</li>
							<li>Panglao Island</li>
							<li>Puntod Island</li>
							<li>Saae Island</li>
							<li>Sagasay Island</li>
							<li>Sandingan Island</li>
							<li>Silo Island</li>
							<li>Tabangdio Island</li>
							<li>Tambu Island</li>
							<li>Tilmubo Island</li>
							<li>Tintiman Island</li>
						</ul>
					</div>	
					<div class="islands_lists">
						<h5>Cebu</h5>
						<ul class="list-resourses">									 
							<li>Bantayan Island
								<ul>  
									<li>Biyagayag Islands (Daku and Diot)</li>
									<li>Botique Island (or Botigues, Batquis)</li>
									<li>Botong Island</li>
									<li>Doong Island</li>
									<li>Hilutungan Island (or Hilotongan, Lutungan)</li>
									<li>Hilantagaan Island (or Jicantangan, Cabalauan)</li>
									<li>Lipayran Island</li>
									<li>Moambuc Island (or Maamboc, Moamboc, Kangka Abong, Cangcabong)</li>
									<li>Mambacayao Island (or Mambacayao Daku)</li>
									<li>Panitugan Island (or Banitugan)</li>
									<li>Patao Island (or Polopolo)</li>
									<li>Panangatang Island (or Pintagan)</li>
									<li>Sagasay Islands (or Sagasa, Tagasa)</li>
									<li>Silagon Island</li>
									<li>Hilantagaan Diot (or Silion, Pulo Diyot (little island))</li>
									<li>Yao Islet (or Mambacayao Diot)</li>									
								</ul>
							</li>
							<li>Calamangan Island</li>
							<li>Camotes Islands
								<ul>
									<li>Pacijan Island</li>
									<li>Ponson Island</li>
									<li>Poro Island</li>
									<li>Tulang Island</li>
								</ul>
							</li>
							<li>Capitancillo Island</li>
							<li>Carnaza Island</li>
							<li>Chocolate Island (Cebu)</li>
							<li>Dakit-Dakit Island</li>
							<li>Gapas-Gapas Island</li>
							<li>Guintacan Island</li>
							<li>Jibitnil Island</li>
							<li>Mactan Island</li>
							<li>Malapascua Island</li>
							<li>Maria Island (Cebu)</li>
							<li>Olango Island
								<ul>
									<li>Camungi Island</li>
									<li>Gilutongan Island</li>
									<li>Kaohagan Island</li>
									<li>Nalusuan Island</li>
									<li>Panganan Island</li>
									<li>Sulpa Island</li>
								</ul>
							</li>
							<li>Pescador Island</li>
							<li>Sumilon Island</li>
							<li>Zaragoza Island</li>
							<li>Former islands
								<ul>
									<li>Cauit Island</li>
								</ul>
							</li>
						</ul>
					</div>	
					<div class="islands_lists">
						<h5>Guimaras</h5>
						<ul class="list-resourses">									 
							<li>Ave Maria Island</li>
							<li>Guiuanon Island</li>
							<li>Inampulugan Island</li>
							<li>Malingin Island</li>
							<li>Nabural Island</li>
							<li>Nadulao Island</li>
							<li>Nagarao Island</li>
							<li>Nalibas Island</li>
							<li>Nalunga Island</li>
							<li>Nauai Island</li>
							<li>Panubulon Island</li>
							<li>Seraray Island</li>
							<li>Taklong Island</li>
							<li>Tandog Island</li>
							<li>Unisan Island</li>
							<li>Yeta Island</li>
						</ul>
					</div>
					<div class="islands_lists">
						<h5>Leyte</h5>
						<ul class="list-resourses">									 
							<li>Bacol Island</li>
							<li>Badian Island</li>
							<li>Cabgan Island (Leyte)</li>
							<li>Calaguan Island</li>
							<li>Calangaman Island</li>
							<li>Caltagan Island</li>
							<li>Calumpijan Island</li>
							<li>Canigao Island</li>
							<li>Cuatro Islas
								<ul>
									<li>Apid Island</li>
									<li>Digyo Island</li>
									<li>Himokilan Island</li>
									<li>Mahaba Island</li>
								</ul>
							</li>
							<li>Cumaiac Island</li>
							<li>Dabun Island</li>
							<li>Danajon Islet</li>
							<li>Gatighan Island</li>
							<li>Gigatangan Island</li>
							<li>Gumalac Island</li>
							<li>Limasawa Island</li>
							<li>Nabubuy Island</li>
							<li>Panaon Island</li>
							<li>San Pablo Island (Leyte)</li>
							<li>San Pedro Island (Leyte)</li>
							<li>Taboc Island</li>
							<li>Zapatos Island</li>
						</ul>
					</div>	
					<div class="islands_lists">
						<h5>Negros Island</h5>
						<ul class="list-resourses">									 
							<li>Agutayan Island</li>
							<li>Anajauan Island</li>
							<li>Apo Island</li>
							<li>Bulata Island</li>
							<li>Danjugan Island</li>
							<li>Diutay Island</li>
							<li>Jomabo Island</li>
							<li>Lakawon Island</li>
							<li>Molocaboc Island</li>
							<li>Sipaway (Refugio) Island</li>
							<li>Siquijor Island</li>
							<li>Suyak Island</li>
							<li>Talabong Island</li>
						</ul>
					</div>	
					<div class="islands_lists">
						<h5>Negros Island</h5>
						<ul class="list-resourses">									 
							<li>Agutayan Island</li>
							<li>Anajauan Island</li>
							<li>Apo Island</li>
							<li>Bulata Island</li>
							<li>Danjugan Island</li>
							<li>Diutay Island</li>
							<li>Jomabo Island</li>
							<li>Lakawon Island</li>
							<li>Molocaboc Island</li>
							<li>Sipaway (Refugio) Island</li>
							<li>Siquijor Island</li>
							<li>Suyak Island</li>
							<li>Talabong Island</li>
						</ul>
					</div>		
					<div class="islands_lists">
						<h5>Negros Island</h5>
						<ul class="list-resourses">									 
							<li>Agutayan Island</li>
							<li>Anajauan Island</li>
							<li>Apo Island</li>
							<li>Bulata Island</li>
							<li>Danjugan Island</li>
							<li>Diutay Island</li>
							<li>Jomabo Island</li>
							<li>Lakawon Island</li>
							<li>Molocaboc Island</li>
							<li>Sipaway (Refugio) Island</li>
							<li>Siquijor Island</li>
							<li>Suyak Island</li>
							<li>Talabong Island</li>
						</ul>
					</div>							
					<div class="islands_lists">
						<h5>Panay</h5>
						<ul class="list-resourses">									 
							<li>Adcalayo Island</li>
							<li>Balbagon Island</li>
							<li>Batbatan Island</li>
							<li>Bayas Islets
								<ul>
									<li>Bayas Island</li>
									<li>Magusipol Island</li>
									<li>Manipulon Island</li>
									<li>Pangalan Island</li>
								</ul>
							</li>
							<li>Binuluangan Island</li>
							<li>Bogtongan Islands</li>
							<li>Boracay Island</li>
							<li>Buri Island</li>
							<li>Calabazas Island</li>
							<li>Calagnaan Island</li>
							<li>Caluya Island</li>
							<li>Canas Island</li>
							<li>Chinela Island</li>
							<li>Concepcion Islands
								<ul>
									<li>Agho Island</li>
									<li>Anauayan Island</li>
									<li>Bag-o Abo Island</li>
									<li>Bag-o Isi Island</li>
									<li>Baliguian Island</li>
									<li>Bocot Island</li>
									<li>Botlog Island</li>
									<li>Bulubadiangan Island</li>
									<li>Chico Island</li>
									<li>Colebra Island</li>
									<li>Danao-Danao Island</li>
									<li>Igbon Island</li>
									<li>Malangabang Island</li>
									<li>Pan de Azucar Island</li>
									<li>Sombrero Island</li>
									<li>Tago Island</li>
									<li>Tagubanhan Island</li>
								</ul>
							</li>
							<li>Crocodile Island</li>
							<li>Dunao Island</li>
							<li>Gigantes Islands
								<ul>
									<li>Antonia Island</li>
									<li>Bantigui Island</li>
									<li>Bulubadiang Islet</li>
									<li>Cabugao Island</li>
									<li>Gigantes Norte</li>
									<li>Gigantes Sur</li>
									<li>Gigantillo Islet</li>
									<li>Gigantuna Islet</li>
									<li>Tanguingui Island</li>
									<li>Turnina Islet</li>
								</ul>
							</li>
							<li>Himamylan Island</li>
							<li>Juraojurao Island</li>
							<li>Lacdian Island</li>
							<li>Laurel Island</li>
							<li>Libagao Island</li>
							<li>Loguingot Island</li>
							<li>Mabay Island</li>
							<li>Magaisi Island</li>
							<li>Magalumbi Island</li>
							<li>Maliaya Island</li>
							<li>Manigonigo Island</li>
							<li>Maniguin Island</li>
							<li>Manlot Island</li>
							<li>Mararison Island</li>
							<li>Marbuena Island</li>
							<li>Matagda Island</li>
							<li>Nagarao Island</li>
							<li>Naburot Island</li>
							<li>Nagubat Island</li>
							<li>Nasidman Island</li>
							<li>Natig Island</li>
							<li>Nilidlaran Island</li>
							<li>Nogas Island</li>
							<li>Ojastras Island</li>
							<li>Olotayan Island</li>
							<li>Panagatan Malaqui Island</li>
							<li>Pandan Island</li>
							<li>Pinamucan Island</li>
							<li>Pulo Piña Island</li>
							<li>Salog Island</li>
							<li>Semirara Island</li>
							<li>Sibalon Island</li>
							<li>Sibato Island</li>
							<li>Sibay Island</li>
							<li>Sibolon Island</li>
							<li>Sicogon Island</li>
							<li>Seco Island</li>
							<li>Tabon Island</li>
							<li>Tabugon Island</li>
							<li>Tabugon Chico Islet</li>
							<li>Tinguiban Islet</li>
							<li>Tulunanaun Island</li>
							<li>Tumaguin Island</li>
							<li>Zapato Island</li>
							<li>Zapato Menor Island</li>
						</ul>
					</div>	
					<div class="islands_lists">
						<h5>Samar</h5>
						<ul class="list-resourses">									 
							<li>Aguad Island</li>
							<li>Almagro Island</li>
							<li>Anahao Island</li>
							<li>Anajao Island</li>
							<li>Andis Island</li>
							<li>Aocon Island</li>
							<li>Apiton Island</li>
							<li>Badian Island</li>
							<li>Balinatio Island</li>
							<li>Bangon Island</li>
							<li>Bani Island</li>
							<li>Bar Islet (Samar)</li>
							<li>Bascal Island</li>
							<li>Bascal-Agotay Island</li>
							<li>Basiao Island</li>
							<li>Batag Island</li>
							<li>Batgongon Island</li>
							<li>Baul Island</li>
							<li>Binaliw Islet</li>
							<li>Binay Island</li>
							<li>Biri Island</li>
							<li>Boloan Island</li>
							<li>Botig Island</li>
							<li>Buad Island</li>
							<li>Buri Island</li>
							<li>Cabaongon Island</li>
							<li>Cagduyong Island</li>
							<li>Cahayagan Island</li>
							<li>Calapan Island</li>
							<li>Calicoan Island</li>
							<li>Camandag Island</li>
							<li>Cambaye Island</li>
							<li>Canahauan Dacu Island</li>
							<li>Canahauan Guti Island</li>
							<li>Candule Island</li>
							<li>Caparangasan Island</li>
							<li>Capogpocanan Island</li>
							<li>Capul Island</li>
							<li>Catalaban Island</li>
							<li>Cauhagan Island</li>
							<li>Coconut Island</li>
							<li>Dalupiri Island</li>
							<li>Danaodanauan Island</li>
							<li>Darahuay Islands</li>
							<li>Daram Island</li>
							<li>Darsena Island</li>
							<li>Divinubo Island</li>
							<li>Escarpada Island</li>
							<li>Fulin Island</li>
							<li>Goyam Island</li>
							<li>Guimtim Island</li>
							<li>Guintarcan Island</li>
							<li>Hilabaan Island</li>
							<li>Hirapsan Island</li>
							<li>Hiuinatungan Island</li>
							<li>Homangad Island</li>
							<li>Homonhon Island</li>
							<li>Inatunglan Island</li>
							<li>Iniyao Island</li>
							<li>Jinamoc Island</li>
							<li>Kantican Island</li>
							<li>Kapuroan Islets</li>
							<li>Karikiki Island</li>
							<li>Kaybani Island</li>
							<li>Laguinit Island</li>
							<li>Lalawigan Island</li>
							<li>Lamingao Island</li>
							<li>Leleboon Island</li>
							<li>Libucan Island</li>
							<li>Libucan Gutiay Island</li>
							<li>Linao Island</li>
							<li>Little Karikiki Island</li>
							<li>Macalayo Island</li>
							<li>Macarite Island</li>
							<li>Macton Island</li>
							<li>Magesang Island</li>
							<li>Makate Island</li>
							<li>Malatugawi Island</li>
							<li>Manicani Island</li>
							<li>Marapilit Island</li>
							<li>Maravilla Island (Samar)</li>
							<li>Masigni Island</li>
							<li>Medio Island</li>
							<li>Minanut Island</li>
							<li>Minasangan Island</li>
							<li>Montoconan Island</li>
							<li>Napalisan Island</li>
							<li>Naranjo Islands
								<ul>
									<li>Destacado Island</li>
									<li>Majaba Island</li>
									<li>Maragat Island</li>
									<li>Panganoron Island</li>
									<li>Sila Island</li>
									<li>Sangputan Island</li>
									<li>Tarnate Island</li>
								</ul>
							</li>
							<li>Palihon Island</li>
							<li>Parasan Island</li>
							<li>Pasig Island</li>
							<li>Pilar Island</li>
							<li>Poro Island</li>
							<li>Porogot Daco Island</li>
							<li>Punubulu Island</li>
							<li>Rosa Island</li>
							<li>Samar Island</li>
							<li>San Andres Island</li>
							<li>San Bernardino Island</li>
							<li>San Juan Island</li>
							<li>Santa Rita Island</li>
							<li>Santo Niño Island</li>
							<li>Sibay Island</li>
							<li>Sibugay Island (Samar)</li>
							<li>Sisi Island</li>
							<li>Suluan Island</li>
							<li>Tagapul-an Island</li>
							<li>Tagdaranao Islands</li>
							<li>Tangad Island</li>
							<li>Timpasan Island</li>
							<li>Tinau Island</li>
							<li>Tubabao Island</li>
							<li>Uacuac Islands</li>
							<li>Uguis Island</li>
						</ul>
					</div>								
				</div>
			</div>
		</div>
	</section>	
@endsection