@extends('frontend.Tropicoblack.layouts.app')
@section('page-title', $title)

@section('content')

		
						@php
							$return = \VanguardLTE\Returns::where('shop_id', Auth::user()->shop_id)->first();
                            $pincodes = \VanguardLTE\Pincode::where(['shop_id' => Auth::user()->shop_id, 'status' => 1, 'activated_at' => null])->count();
							$happyhour = \VanguardLTE\HappyHour::where(['shop_id' => auth()->user()->shop_id, 'time' => date('G'), 'status' => 1])->first();
							if(!$happyhour){
								$happyhour = \VanguardLTE\HappyHour::where(['shop_id' => auth()->user()->shop_id, 'status' => 1])->where('time', '>',date('G'))->first();
							}
							if(!$happyhour){
								$happyhour = \VanguardLTE\HappyHour::where(['shop_id' => auth()->user()->shop_id, 'status' => 1])->first();
							}
						@endphp
						
	<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">

	<title>Games - </title>

	<meta name="viewport" content="width=device-width">

	<link rel="icon" href="/frontend/Tropicoblack/img/favicon.png" >
    <meta name="theme-color" content="#222222">
	<link rel="stylesheet" href="/frontend/Tropicoblack/css/slick.css">
	<link rel="stylesheet" href="/frontend/Tropicoblack/css/styles.min.css">

	<script src="/frontend/Tropicoblack/js/jquery-3.4.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/assets/vendors/google/css/roboto.css"/>
	<link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/assets/vendors/bootstrap/4.3.1/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/assets/vendors/swiper/4.5.0/css/swiper.min.css"/>
	<link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/assets/vendors/odometer/0.4.6/css/odometer-theme-default.css"/>
	<link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/assets/vendors/bootstrap-select/1.13.9/css/bootstrap-select.min.css"/>
	<link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/assets/vendors/flag-icon-css/3.3.0/css/flag-icon.min.css"/>
	<link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/assets/vendors/flaticon/flaticon.css"/>
	<link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/assets/vendors/fontawesome/5.10.1/css/all.min.css"/>


	<link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/css/alertify.min.css"/>
	<link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/css/pisoglentis.css"/>
	<link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/assets/css/main-black.css"/>


</head>

<body data-type="public">
	
	

<!-- <div class="fullpage" style="height: 100220vh; background-color: black; position:absolute;
    top:0;
    bottom:0;
    left:0;
    right:0;
    z-index: 2222;
    overflow:hidden;"></div> -->
<!-- public, private -->
<!-- SIDEBAR -->
    <nav id="sidebar" class="">
    <div id="dismiss">
        <i class="fas fa-angle-left"></i>
    </div>

    <div class="sidebar-header">
        <h3 class="text-center">

                            <img src="/frontend/Tropicoblack/assets/images/ui/tropicana88_logo-bg.png" alt="logo" class="sidebar-logo"/>


        </h3>
        <div class="container text-center">
            <select class="selectpicker" id="lang" data-width="fit">
                <option  selected
                         data-content='<span class="flag-icon flag-icon-gb"></span>'></option>
                <option  data-content='<span class="flag-icon flag-icon-it"></span>'></option>
                <option  data-content='<span class="flag-icon flag-icon-es"></span>'></option>
            </select>
        </div>
    </div>

    <ul class="list-unstyled components">


						<li data-category="all">
								<a href="javascript: void(0);">
										All
								</a>
						</li>
													
							<li  data-category="1059">
									<a href="javascript: void(0);">
											Hot
									</a>
							</li>

							
							<li  data-category="1060">
									<a href="javascript: void(0);">
											New
									</a>
							</li>

							
							<li  data-category="1061">
									<a href="javascript: void(0);">
											Egt
									</a>
							</li>

							
							<li  data-category="1062">
									<a href="javascript: void(0);">
											iSoftBet
									</a>
							</li>

							
							<li  data-category="1063">
									<a href="javascript: void(0);">
											Gamomat
									</a>
							</li>

							
							<li  data-category="1064">
									<a href="javascript: void(0);">
											Playtech
									</a>
							</li>

							
							<li  data-category="1065">
									<a href="javascript: void(0);">
											Amatic
									</a>
							</li>

							
							<li  data-category="1066">
									<a href="javascript: void(0);">
											Aristocrat
									</a>
							</li>

							
							<li  data-category="1067">
									<a href="javascript: void(0);">
											C-Technology
									</a>
							</li>

							
							<li  data-category="1068">
									<a href="javascript: void(0);">
											Greentube
									</a>
							</li>

							
							<li  data-category="1069">
									<a href="javascript: void(0);">
											Igrosoft
									</a>
							</li>

							
							<li  data-category="1070">
									<a href="javascript: void(0);">
											NetEnt
									</a>
							</li>

							
							<li  data-category="1072">
									<a href="javascript: void(0);">
											Pragmatic
									</a>
							</li>

							
							<li  data-category="1074">
									<a href="javascript: void(0);">
											Mainama
									</a>
							</li>

							
							<li  data-category="1075">
									<a href="javascript: void(0);">
											Ka-Gaming
									</a>
							</li>

							
							<li  data-category="1076">
									<a href="javascript: void(0);">
											Wazdan
									</a>
							</li>

							
							<li  data-category="1077">
									<a href="javascript: void(0);">
											Vision
									</a>
							</li>

							
							<li  data-category="1078">
									<a href="javascript: void(0);">
											Keno
									</a>
							</li>

							
							<li  data-category="1080">
									<a href="javascript: void(0);">
											Roulette
									</a>
							</li>

							
							<li  data-category="1144">
									<a href="javascript: void(0);">
											Card
									</a>
							</li>

							
							<li  data-category="1146">
									<a href="javascript: void(0);">
											Bingo
									</a>
							</li>

							
							<li  data-category="1149">
									<a href="javascript: void(0);">
											Fish
									</a>
							</li>

													



    </ul>
















    <ul class="list-unstyled buttonsGroup-public">
        <li>
            <a href="/logout" class="primaryBtn">
                <i class="fas fa-user-times"></i>
                Logout
            </a>
        </li>
    </ul>
</nav>
<!-- END SIDEBAR -->

<!-- CONTENT -->
<div id="content">
    <!-- NAVBAR -->
    <nav class="navbar position-absolute w-100 p-0" id="slide222">
    <div class="row w-100 m-0">
        <div class="col-2 col-sm-2 text-sm-left text-center">
            <button type="button" id="sidebarCollapse" class="btn primary-btn float-left mt-1">
                <i class="fas fa-align-justify"></i>
            </button>
        </div>
        <div class="d-none d-md-block col-sm-4 p-0 text-center text-sm-left">
            <a href="" class="pl-2">
                                    <img src="/frontend/Tropicoblack/assets/images/ui/tropicana88_logo-bg.png" alt="logo"
                         class="navbar-logo"/>
                                </a>

        </div>














        <div class="col-10 col-sm-6 text-sm-right text-center">
            <div class="btn primary-btn d-inline-block mt-1 user-info">
							<span class="custom-input-group-icon text-left" style="margin-right: 10px;" data-toggle="tooltip"
                                  title="Username">
								<i class="fas fa-user"></i>
								<span id="user-username"> </span>{{ Auth::user()->username }}
							</span>
                <span class="custom-input-group-icon text-left" style="margin: 10px;" id="hideMsg" data-toggle="tooltip"
                      title="Balance">
								<i class="fas fa-wallet"> </i>
								<span id="user-balance">{{ number_format(Auth::user()->balance, 2,".","") }}  @if( auth()->user()->present()->shop ){{ auth()->user()->present()->shop->currency }}@endif</span>
							</span>
                <input type="hidden" id="hiddenScore" name="hiddenScore" value="0">

                <span class="custom-input-group-icon text-left" style="margin-left: 10px;" data-toggle="tooltip"
                      title="Bonus">
								<i class="fas fa-gift"></i>
								<span id="user-cashback">{{ number_format(Auth::user()->bonus, 2,".","") }} @if( auth()->user()->present()->shop ){{ auth()->user()->present()->shop->currency }}@endif</span>
							</span>

                            </div>
        </div>

            <div class="d-none d-md-block col-sm-8 p-0 text-center text-sm-left">
            </div>
            <div class="col-12 col-sm-4 text-right bonuslvl d-none">

            </div>
    </div>
</nav>
<!-- END NAVBAR -->

    <div class="row m-0 position-relative">
        <!-- JACKPOT -->
        <div class="row w-100" id="jackpots">
        <div class="col-lg-3 pb-1 my-auto"></div>
        <div class="col-4 col-lg-2 pb-1 my-auto">
            <div class="jackpot-container align-middle w-100 m-auto text-right">
                <img src="/frontend/Tropicoblack/assets/images/ui/jackpot-icon-1.png" alt="jackpot-icon"
                     class="jackpot-icon float-left"/>
                <div class="">@if( count($jpgs) > 0 )
									            {{ $jpgs[0]->balance }}
								            @endif	</div>
            </div>
        </div>
        <div class="col-4 col-lg-2 pb-1 my-auto">
            <div class="jackpot-container align-middle w-100 m-auto text-right">
                <img src="/frontend/Tropicoblack/assets/images/ui/jackpot-icon-2.png" alt="jackpot-icon"
                     class="jackpot-icon float-left"/>
                <div class=""></div>@if( count($jpgs) > 0 )
									            {{ $jpgs[1]->balance }}
								            @endif	
            </div>
        </div>
        <div class="col-4 col-lg-2 pb-1 my-auto">
            <div class="jackpot-container align-middle w-100 m-auto text-right">
                <img src="/frontend/Tropicoblack/assets/images/ui/jackpot-icon-3.png" alt="jackpot-icon"
                     class="jackpot-icon float-left"/>@if( count($jpgs) > 0 )
									            {{ $jpgs[2]->balance }}
								            @endif	
                <div class=""></div>
            </div>
        </div>
        <div class="col-lg-3 pb-1 my-auto"></div>
    </div>
    <!-- END JACKPOT -->
        <!-- BANNERS -->
        <div id="banners"></div>
        <!-- END BANNERS -->
    </div>

    <!-- MAIN MENU -->
    <div class="sticky-top main-bg" style="position: sticky;top: 0;z-index: 1020;">
    <div id="main-menu">
        <nav class="navbar navbar-expand p-0 scrollable-navbar">
            <div>
                <ul class="navbar-nav">
									<li class="nav-item" data-category="all">
											<a class="nav-link text-center" href="javascript: void(0);">
													All
											</a>
									</li>

									
																																							<li class="nav-item" data-sv="hot" data-category="1059">
												<a class="nav-link text-center" href="javascript: void(0);">
														Hot
												</a>
										</li>
										
																														<li class="nav-item" data-sv="new" data-category="1060">
												<a class="nav-link text-center" href="javascript: void(0);">
														New
												</a>
										</li>
										
																				
																				
																				
																				
																				
																				
																				
																				
																				
																				
																				
																				
																				
																				
																														<li class="nav-item" data-sv="vision" data-category="1077">
												<a class="nav-link text-center" href="javascript: void(0);">
														Vision
												</a>
										</li>
										
																														<li class="nav-item" data-sv="keno" data-category="1078">
												<a class="nav-link text-center" href="javascript: void(0);">
														Keno
												</a>
										</li>
										
																														<li class="nav-item" data-sv="Roulette" data-category="1080">
												<a class="nav-link text-center" href="javascript: void(0);">
														Roulette
												</a>
										</li>
										
																														<li class="nav-item" data-sv="Card" data-category="1144">
												<a class="nav-link text-center" href="javascript: void(0);">
														Card
												</a>
										</li>
										
																														<li class="nav-item" data-sv="Bingo" data-category="1146">
												<a class="nav-link text-center" href="javascript: void(0);">
														Bingo
												</a>
										</li>
										
																														<li class="nav-item" data-sv="Fish" data-category="1149">
												<a class="nav-link text-center" href="javascript: void(0);">
														Fish
												</a>
										</li>
										
																			







                </ul>
            </div>
        </nav>
    </div>

    <div class="container-fluid mt-2">
        <div class="row m-0">
            <div class="col-xl-10 col-lg-9 col-md-0 mb-2 p-0">
							<nav class="navbar navbar-expand p-0 scrollable-navbar" id="vendors">
								<ul class="navbar-nav">
																													
																				
																														<li class="nav-item mr-2 ml-2 box active" data-category="1061">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/egt.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1062">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/isoftbet.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1063">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/gamomat.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1064">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/Playtech.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1065">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/amatic.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1066">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/aristocrat.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1067">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/casino-technology.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1068">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/greentube.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1069">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/igrosoft.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1070">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/netent.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1072">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/pragmatic.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1074">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/mainama.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1075">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/ka-gaming.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1076">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/wazdan.png"></a>
										</li>
										
																				
																				
																				
																				
																				
																				
																			
								</ul>
							</nav>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-12 mb-2 p-0">
                <div id="searchbar" class="search-box">
                    <input id="search_input" type="text" name="search_input" placeholder="Name" class="search-txt"/>
                    <a href="javascript: void(0);" id="search_icon" class="search-btn">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

	var GLOBAL_GAMES_LIST = [

				{
			"game_id":20462,
			"launchUrl":"/game/ActionMoneyEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Action Money",
			"imageUrl":"/frontend/Tropicoblack/ico/ActionMoneyEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ActionMoneyEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20165,
			"launchUrl":"/game/AdmiralNelsonAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Admiral Nelson",
			"imageUrl":"/frontend/Tropicoblack/ico/AdmiralNelsonAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AdmiralNelsonAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20680,
			"launchUrl":"/game/AfricaRunKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Africa Run",
			"imageUrl":"/frontend/Tropicoblack/ico/AfricaRunKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AfricaRunKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20537,
			"launchUrl":"/game/AgeOfEgyptPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Age of Egypt",
			"imageUrl":"/frontend/Tropicoblack/ico/AgeOfEgyptPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AgeOfEgyptPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20308,
			"launchUrl":"/game/AgeOfGodsKingofOlympusPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Age Of Gods King of Olympus",
			"imageUrl":"/frontend/Tropicoblack/ico/AgeOfGodsKingofOlympusPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AgeOfGodsKingofOlympusPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19903,
			"launchUrl":"/game/AgeOfPrivateersGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Age of Privateers",
			"imageUrl":"/frontend/Tropicoblack/ico/AgeOfPrivateersGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AgeOfPrivateersGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20324,
			"launchUrl":"/game/AgeOfTheGodsGodOfStormsPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Age Of The Gods God Of Storms",
			"imageUrl":"/frontend/Tropicoblack/ico/AgeOfTheGodsGodOfStormsPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AgeOfTheGodsGodOfStormsPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20463,
			"launchUrl":"/game/AgeOfTroyEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Age of Troy",
			"imageUrl":"/frontend/Tropicoblack/ico/AgeOfTroyEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AgeOfTroyEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19904,
			"launchUrl":"/game/AlchemistsSecretGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Alchemists Secret",
			"imageUrl":"/frontend/Tropicoblack/ico/AlchemistsSecretGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AlchemistsSecretGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20378,
			"launchUrl":"/game/AllAmericanPokerAM",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"All American Poker",
			"imageUrl":"/frontend/Tropicoblack/ico/AllAmericanPokerAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AllAmericanPokerAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20140,
			"launchUrl":"/game/AllWaysFruitsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"All Ways Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/AllWaysFruitsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AllWaysFruitsAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20141,
			"launchUrl":"/game/AllWaysJokerAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"All Ways Joker",
			"imageUrl":"/frontend/Tropicoblack/ico/AllWaysJokerAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AllWaysJokerAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20142,
			"launchUrl":"/game/AllWaysWinAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"All Ways Win",
			"imageUrl":"/frontend/Tropicoblack/ico/AllWaysWinAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AllWaysWinAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20464,
			"launchUrl":"/game/AlmightyRamsesIIEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Almighty Ramses II",
			"imageUrl":"/frontend/Tropicoblack/ico/AlmightyRamsesIIEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AlmightyRamsesIIEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20465,
			"launchUrl":"/game/AlohaPartyEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Aloha Party",
			"imageUrl":"/frontend/Tropicoblack/ico/AlohaPartyEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AlohaPartyEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19905,
			"launchUrl":"/game/AlwaysHotCubesGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Always Hot Cubes",
			"imageUrl":"/frontend/Tropicoblack/ico/AlwaysHotCubesGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AlwaysHotCubesGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19906,
			"launchUrl":"/game/AlwaysHotDXGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Always Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/AlwaysHotDXGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AlwaysHotDXGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20452,
			"launchUrl":"/game/AmazingAmazoniaEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Amazing Amazonia",
			"imageUrl":"/frontend/Tropicoblack/ico/AmazingAmazoniaEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AmazingAmazoniaEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19907,
			"launchUrl":"/game/AmazingFruitsGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Amazing Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/AmazingFruitsGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AmazingFruitsGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19908,
			"launchUrl":"/game/AmazingSevensGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Amazing Sevens",
			"imageUrl":"/frontend/Tropicoblack/ico/AmazingSevensGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AmazingSevensGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19909,
			"launchUrl":"/game/AmazingStarsGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Amazing Stars",
			"imageUrl":"/frontend/Tropicoblack/ico/AmazingStarsGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AmazingStarsGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20466,
			"launchUrl":"/game/AmazonsBattleEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Amazons Battle",
			"imageUrl":"/frontend/Tropicoblack/ico/AmazonsBattleEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AmazonsBattleEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20467,
			"launchUrl":"/game/AmazonStoryEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Amazon Story",
			"imageUrl":"/frontend/Tropicoblack/ico/AmazonStoryEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AmazonStoryEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19910,
			"launchUrl":"/game/AmericanGangsterGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"American Gangster",
			"imageUrl":"/frontend/Tropicoblack/ico/AmericanGangsterGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AmericanGangsterGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20559,
			"launchUrl":"/game/AmericanGigoloCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"American Gigolo",
			"imageUrl":"/frontend/Tropicoblack/ico/AmericanGigoloCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AmericanGigoloCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20354,
			"launchUrl":"/game/AnacondaWildPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Anaconda Wild",
			"imageUrl":"/frontend/Tropicoblack/ico/AnacondaWildPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AnacondaWildPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20402,
			"launchUrl":"/game/AncientEgyptPM",
			"providerId":"bomba",
			"categoryName":"1072",
			"gameName":"Ancient Egypt",
			"imageUrl":"/frontend/Tropicoblack/ico/AncientEgyptPM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AncientEgyptPM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20063,
			"launchUrl":"/game/AncientForestGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Ancient Forest",
			"imageUrl":"/frontend/Tropicoblack/ico/AncientForestGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AncientForestGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20616,
			"launchUrl":"/game/AncientMagicGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ancient Magic",
			"imageUrl":"/frontend/Tropicoblack/ico/AncientMagicGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AncientMagicGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20597,
			"launchUrl":"/game/AncientRichesCasinoGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ancient Riches Casino",
			"imageUrl":"/frontend/Tropicoblack/ico/AncientRichesCasinoGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AncientRichesCasinoGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20641,
			"launchUrl":"/game/AncientRichesCasinoRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ancient Riches Casino Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/AncientRichesCasinoRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AncientRichesCasinoRedHotFirepotGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20108,
			"launchUrl":"/game/ArcherPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Archer",
			"imageUrl":"/frontend/Tropicoblack/ico/ArcherPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ArcherPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20706,
			"launchUrl":"/game/AresGodOfWarKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Ares God Of War",
			"imageUrl":"/frontend/Tropicoblack/ico/AresGodOfWarKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AresGodOfWarKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20227,
			"launchUrl":"/game/ArisingPhoenixAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Arising Phoenix",
			"imageUrl":"/frontend/Tropicoblack/ico/ArisingPhoenixAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ArisingPhoenixAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19911,
			"launchUrl":"/game/AttilaDX",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Attila",
			"imageUrl":"/frontend/Tropicoblack/ico/AttilaDX.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AttilaDX.jpg",
			"mobileGame": false
		},

				{
			"game_id":20404,
			"launchUrl":"/game/AztecGemsPM",
			"providerId":"bomba",
			"categoryName":"1072",
			"gameName":"Aztec Gems",
			"imageUrl":"/frontend/Tropicoblack/ico/AztecGemsPM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AztecGemsPM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20468,
			"launchUrl":"/game/AztecGloryEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Aztec Glory",
			"imageUrl":"/frontend/Tropicoblack/ico/AztecGloryEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AztecGloryEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20835,
			"launchUrl":"/game/AztecGoldMegawaysISB",
			"providerId":"bomba",
			"categoryName":"1062",
			"gameName":"Aztec Gold Megaways",
			"imageUrl":"/frontend/Tropicoblack/ico/AztecGoldMegawaysISB.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AztecGoldMegawaysISB.jpg",
			"mobileGame": false
		},

				{
			"game_id":20220,
			"launchUrl":"/game/AztecSecretAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Aztec Secret",
			"imageUrl":"/frontend/Tropicoblack/ico/AztecSecretAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AztecSecretAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20155,
			"launchUrl":"/game/BaiShiPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Bai Shi",
			"imageUrl":"/frontend/Tropicoblack/ico/BaiShiPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BaiShiPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20575,
			"launchUrl":"/game/BananaPartyCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Banana Party",
			"imageUrl":"/frontend/Tropicoblack/ico/BananaPartyCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BananaPartyCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19912,
			"launchUrl":"/game/BananasGoBahamasDX",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Bananas go Bahamas",
			"imageUrl":"/frontend/Tropicoblack/ico/BananasGoBahamasDX.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BananasGoBahamasDX.jpg",
			"mobileGame": false
		},

				{
			"game_id":20796,
			"launchUrl":"/game/BananasMN",
			"providerId":"bomba",
			"categoryName":"1060",
			"gameName":"Bananas",
			"imageUrl":"/frontend/Tropicoblack/ico/BananasMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BananasMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":19913,
			"launchUrl":"/game/BananaSplashDX",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Banana Splash",
			"imageUrl":"/frontend/Tropicoblack/ico/BananaSplashDX.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BananaSplashDX.jpg",
			"mobileGame": false
		},

				{
			"game_id":19914,
			"launchUrl":"/game/BankRaidGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Bank Raid",
			"imageUrl":"/frontend/Tropicoblack/ico/BankRaidGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BankRaidGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19915,
			"launchUrl":"/game/BarsAndSevensGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Bars and Sevens",
			"imageUrl":"/frontend/Tropicoblack/ico/BarsAndSevensGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BarsAndSevensGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20568,
			"launchUrl":"/game/BavarianForestCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Bavarian Forest",
			"imageUrl":"/frontend/Tropicoblack/ico/BavarianForestCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BavarianForestCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19916,
			"launchUrl":"/game/BeachHolidaysGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Beach Holidays",
			"imageUrl":"/frontend/Tropicoblack/ico/BeachHolidaysGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BeachHolidaysGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20855,
			"launchUrl":"/game/BeachPartyHotWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Beach Party Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/BeachPartyHotWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BeachPartyHotWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20869,
			"launchUrl":"/game/BeachPartyWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Beach Party",
			"imageUrl":"/frontend/Tropicoblack/ico/BeachPartyWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BeachPartyWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20350,
			"launchUrl":"/game/BeatleDanceVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Beatle Dance",
			"imageUrl":"/frontend/Tropicoblack/ico/BeatleDanceVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BeatleDanceVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20612,
			"launchUrl":"/game/BeautifulNatureGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Beautiful Nature",
			"imageUrl":"/frontend/Tropicoblack/ico/BeautifulNatureGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BeautifulNatureGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20800,
			"launchUrl":"/game/BeautyDolphinsMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Beauty Dolphins",
			"imageUrl":"/frontend/Tropicoblack/ico/BeautyDolphinsMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BeautyDolphinsMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20214,
			"launchUrl":"/game/BeautyFairyAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Beauty Fairy",
			"imageUrl":"/frontend/Tropicoblack/ico/BeautyFairyAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BeautyFairyAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20209,
			"launchUrl":"/game/BeautyWarriorAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Beauty Warrior",
			"imageUrl":"/frontend/Tropicoblack/ico/BeautyWarriorAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BeautyWarriorAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20583,
			"launchUrl":"/game/BeetleStarCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Beetle Star",
			"imageUrl":"/frontend/Tropicoblack/ico/BeetleStarCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BeetleStarCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20166,
			"launchUrl":"/game/BellsOnFireAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Bells On Fire",
			"imageUrl":"/frontend/Tropicoblack/ico/BellsOnFireAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BellsOnFireAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20130,
			"launchUrl":"/game/BellsOnFireHotAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Bells On FireHot",
			"imageUrl":"/frontend/Tropicoblack/ico/BellsOnFireHotAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BellsOnFireHotAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20147,
			"launchUrl":"/game/BellsOnFireRomboAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Bells On Fire Rombo",
			"imageUrl":"/frontend/Tropicoblack/ico/BellsOnFireRomboAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BellsOnFireRomboAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20149,
			"launchUrl":"/game/BermudaTrianglePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Bermuda Triangle",
			"imageUrl":"/frontend/Tropicoblack/ico/BermudaTrianglePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BermudaTrianglePT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20387,
			"launchUrl":"/game/BerryBerryBonanzaPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Berry Berry Bonanza",
			"imageUrl":"/frontend/Tropicoblack/ico/BerryBerryBonanzaPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BerryBerryBonanzaPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20758,
			"launchUrl":"/game/BigBenAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Big Ben",
			"imageUrl":"/frontend/Tropicoblack/ico/BigBenAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BigBenAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20561,
			"launchUrl":"/game/BigJokerCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Big Joker",
			"imageUrl":"/frontend/Tropicoblack/ico/BigJokerCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BigJokerCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20454,
			"launchUrl":"/game/BigJourneyEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Big Journey",
			"imageUrl":"/frontend/Tropicoblack/ico/BigJourneyEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BigJourneyEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20221,
			"launchUrl":"/game/BigPandaAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Big Panda",
			"imageUrl":"/frontend/Tropicoblack/ico/BigPandaAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BigPandaAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20759,
			"launchUrl":"/game/BigRedAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Big Red",
			"imageUrl":"/frontend/Tropicoblack/ico/BigRedAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BigRedAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20210,
			"launchUrl":"/game/BillyonaireAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Billyonaire",
			"imageUrl":"/frontend/Tropicoblack/ico/BillyonaireAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BillyonaireAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20167,
			"launchUrl":"/game/BillysGameAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Billys Game",
			"imageUrl":"/frontend/Tropicoblack/ico/BillysGameAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BillysGameAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20372,
			"launchUrl":"/game/BingoAM",
			"providerId":"bomba",
			"categoryName":"1146",
			"gameName":"Bingo",
			"imageUrl":"/frontend/Tropicoblack/ico/BingoAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BingoAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20594,
			"launchUrl":"/game/BlackBeautyGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Black Beauty",
			"imageUrl":"/frontend/Tropicoblack/ico/BlackBeautyGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BlackBeautyGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20331,
			"launchUrl":"/game/BlackJackAM",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Black Jack",
			"imageUrl":"/frontend/Tropicoblack/ico/BlackJackAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BlackJackAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20389,
			"launchUrl":"/game/BlackjackSurrenderPT",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Black Jack Surrender",
			"imageUrl":"/frontend/Tropicoblack/ico/BlackjackSurrenderPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BlackjackSurrenderPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19917,
			"launchUrl":"/game/BlazingRichesGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Blazing Riches",
			"imageUrl":"/frontend/Tropicoblack/ico/BlazingRichesGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BlazingRichesGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20133,
			"launchUrl":"/game/BlueDolphinAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Blue Dolphin",
			"imageUrl":"/frontend/Tropicoblack/ico/BlueDolphinAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BlueDolphinAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20469,
			"launchUrl":"/game/BlueHeartEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Blue Heart",
			"imageUrl":"/frontend/Tropicoblack/ico/BlueHeartEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BlueHeartEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20102,
			"launchUrl":"/game/BonusBearsPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Bonus Bears",
			"imageUrl":"/frontend/Tropicoblack/ico/BonusBearsPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BonusBearsPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20476,
			"launchUrl":"/game/BonusPokerEGT",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Bonus Poker",
			"imageUrl":"/frontend/Tropicoblack/ico/BonusPokerEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BonusPokerEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20168,
			"launchUrl":"/game/BookOfAztecAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Book Of Aztec",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfAztecAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfAztecAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20169,
			"launchUrl":"/game/BookOfFortuneAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Book Of Fortune",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfFortuneAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfFortuneAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20170,
			"launchUrl":"/game/BookOfLordsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Book Of Lords",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfLordsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfLordsAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20470,
			"launchUrl":"/game/BookOfMagicEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Book of Magic",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfMagicEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfMagicEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20618,
			"launchUrl":"/game/BookOfMoorhuhnGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Book of Moorhuhn",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfMoorhuhnGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfMoorhuhnGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20637,
			"launchUrl":"/game/BookOfMoorhuhnGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Book Of Moorhuhn Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfMoorhuhnGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfMoorhuhnGoldenNightsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20713,
			"launchUrl":"/game/BookOfPharaoAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Book Of Pharao",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfPharaoAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfPharaoAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20171,
			"launchUrl":"/game/BookOfQueenAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Book Of Queen",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfQueenAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfQueenAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19918,
			"launchUrl":"/game/BookOfRaCL",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Book of Ra",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfRaCL.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfRaCL.jpg",
			"mobileGame": false
		},

				{
			"game_id":19979,
			"launchUrl":"/game/BookOfRaDX6GT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Book of Ra 6",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfRaDX6GT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfRaDX6GT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19919,
			"launchUrl":"/game/BookOfRaDXGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Book of Ra",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfRaDXGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfRaDXGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20614,
			"launchUrl":"/game/BookOfRomeoAndJuliaGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Book of Romeo and Julia",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfRomeoAndJuliaGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfRomeoAndJuliaGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20615,
			"launchUrl":"/game/BookOfTheAgesGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Book of the Ages",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfTheAgesGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfTheAgesGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20574,
			"launchUrl":"/game/BrilliantsHotCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Brilliants Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/BrilliantsHotCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BrilliantsHotCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20662,
			"launchUrl":"/game/BubbleDoubleKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Bubble Double",
			"imageUrl":"/frontend/Tropicoblack/ico/BubbleDoubleKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BubbleDoubleKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20760,
			"launchUrl":"/game/BuffaloAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Buffalo",
			"imageUrl":"/frontend/Tropicoblack/ico/BuffaloAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BuffaloAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20106,
			"launchUrl":"/game/BuffaloBlitzPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Buffalo Blitz",
			"imageUrl":"/frontend/Tropicoblack/ico/BuffaloBlitzPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BuffaloBlitzPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20669,
			"launchUrl":"/game/BullStampedeKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Bull Stampede",
			"imageUrl":"/frontend/Tropicoblack/ico/BullStampedeKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BullStampedeKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20448,
			"launchUrl":"/game/BurningDice40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Dice 40",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningDice40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningDice40EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20447,
			"launchUrl":"/game/BurningDice5EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Dice 5",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningDice5EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningDice5EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20397,
			"launchUrl":"/game/BurningDiceEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningDiceEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningDiceEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20317,
			"launchUrl":"/game/BurningFruitsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Burning Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningFruitsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningFruitsVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20441,
			"launchUrl":"/game/BurningHeart10EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Heart 10",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHeart10EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHeart10EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20398,
			"launchUrl":"/game/BurningHeart5EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Heart 5",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHeart5EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHeart5EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20440,
			"launchUrl":"/game/BurningHot100EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Hot 100",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHot100EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHot100EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20415,
			"launchUrl":"/game/BurningHot20EGT",
			"providerId":"bomba",
			"categoryName":"1059",
			"gameName":"Burning Hot 20",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHot20EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHot20EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20416,
			"launchUrl":"/game/BurningHot40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Hot 40",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHot40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHot40EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20720,
			"launchUrl":"/game/BurningHot6Reels40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Hot 6 Reels 40",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHot6Reels40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHot6Reels40EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20718,
			"launchUrl":"/game/BurningHot6Reels5EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Hot 6 Reels 5",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHot6Reels5EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHot6Reels5EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19920,
			"launchUrl":"/game/BurningHot7GT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Burning Hot 7",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHot7GT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHot7GT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20318,
			"launchUrl":"/game/BurningReelsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Burning Reels",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningReelsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningReelsVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20353,
			"launchUrl":"/game/BurningRingVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Burning Ring",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningRingVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningRingVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20319,
			"launchUrl":"/game/BurningScatterVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Burning Scatter",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningScatterVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningScatterVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20685,
			"launchUrl":"/game/CaiYuanGuangJinKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Cai Yuan Guang Jin",
			"imageUrl":"/frontend/Tropicoblack/ico/CaiYuanGuangJinKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CaiYuanGuangJinKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20701,
			"launchUrl":"/game/CaliforniaGoldRushKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"California Gold Rush",
			"imageUrl":"/frontend/Tropicoblack/ico/CaliforniaGoldRushKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CaliforniaGoldRushKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20684,
			"launchUrl":"/game/CandyStormKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Candy Storm",
			"imageUrl":"/frontend/Tropicoblack/ico/CandyStormKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CandyStormKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20803,
			"launchUrl":"/game/CaptainMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Captain",
			"imageUrl":"/frontend/Tropicoblack/ico/CaptainMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CaptainMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20851,
			"launchUrl":"/game/CaptainSharkWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Captain Shark",
			"imageUrl":"/frontend/Tropicoblack/ico/CaptainSharkWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CaptainSharkWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20076,
			"launchUrl":"/game/CaptainsTreasurePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Captains Treasure",
			"imageUrl":"/frontend/Tropicoblack/ico/CaptainsTreasurePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CaptainsTreasurePT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20432,
			"launchUrl":"/game/CaramelDiceEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Caramel Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/CaramelDiceEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CaramelDiceEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20418,
			"launchUrl":"/game/CaramelHotEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Caramel Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/CaramelHotEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CaramelHotEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19921,
			"launchUrl":"/game/CaribbeanHolidaysGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Caribbean Holidays",
			"imageUrl":"/frontend/Tropicoblack/ico/CaribbeanHolidaysGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CaribbeanHolidaysGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20172,
			"launchUrl":"/game/CasanovaAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Casanova",
			"imageUrl":"/frontend/Tropicoblack/ico/CasanovaAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CasanovaAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20472,
			"launchUrl":"/game/CashmirGoldEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Cashmir Gold",
			"imageUrl":"/frontend/Tropicoblack/ico/CashmirGoldEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CashmirGoldEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19980,
			"launchUrl":"/game/CashRunnerGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Cash Runner",
			"imageUrl":"/frontend/Tropicoblack/ico/CashRunnerGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CashRunnerGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20473,
			"launchUrl":"/game/CasinoManiaEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"CasinoMania",
			"imageUrl":"/frontend/Tropicoblack/ico/CasinoManiaEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CasinoManiaEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20211,
			"launchUrl":"/game/CasinovaAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Casinova",
			"imageUrl":"/frontend/Tropicoblack/ico/CasinovaAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CasinovaAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20474,
			"launchUrl":"/game/Cats100EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Cats 100",
			"imageUrl":"/frontend/Tropicoblack/ico/Cats100EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Cats100EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20475,
			"launchUrl":"/game/CatsRoyalEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Cats Royal",
			"imageUrl":"/frontend/Tropicoblack/ico/CatsRoyalEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CatsRoyalEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20191,
			"launchUrl":"/game/ChaoJi888",
			"providerId":"bomba",
			"categoryName":"1059",
			"gameName":"Chao Ji 888",
			"imageUrl":"/frontend/Tropicoblack/ico/ChaoJi888.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ChaoJi888.jpg",
			"mobileGame": false
		},

				{
			"game_id":20163,
			"launchUrl":"/game/CherryLovePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Cherry Love",
			"imageUrl":"/frontend/Tropicoblack/ico/CherryLovePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CherryLovePT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20539,
			"launchUrl":"/game/ChineseKitchenPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Chinese Kitchen",
			"imageUrl":"/frontend/Tropicoblack/ico/ChineseKitchenPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ChineseKitchenPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20688,
			"launchUrl":"/game/ChiYouKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Chi You",
			"imageUrl":"/frontend/Tropicoblack/ico/ChiYouKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ChiYouKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20761,
			"launchUrl":"/game/ChoySunDoaAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Choy Sun Doa",
			"imageUrl":"/frontend/Tropicoblack/ico/ChoySunDoaAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ChoySunDoaAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20541,
			"launchUrl":"/game/ChristmasBellsJPPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Christmas Bells JP",
			"imageUrl":"/frontend/Tropicoblack/ico/ChristmasBellsJPPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ChristmasBellsJPPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20562,
			"launchUrl":"/game/CloverPartyCT",
			"providerId":"bomba",
			"categoryName":"1059",
			"gameName":"Clover Party",
			"imageUrl":"/frontend/Tropicoblack/ico/CloverPartyCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CloverPartyCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20649,
			"launchUrl":"/game/CocoricoKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Cocorico",
			"imageUrl":"/frontend/Tropicoblack/ico/CocoricoKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CocoricoKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20381,
			"launchUrl":"/game/CoinCoinCoinPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Coin Coin Coin",
			"imageUrl":"/frontend/Tropicoblack/ico/CoinCoinCoinPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CoinCoinCoinPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20587,
			"launchUrl":"/game/CombatRomanceCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Combat Romance",
			"imageUrl":"/frontend/Tropicoblack/ico/CombatRomanceCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CombatRomanceCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20812,
			"launchUrl":"/game/ComputerWorldMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Computer World",
			"imageUrl":"/frontend/Tropicoblack/ico/ComputerWorldMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ComputerWorldMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20138,
			"launchUrl":"/game/CoolDiamonds2AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Cool Diamonds 2",
			"imageUrl":"/frontend/Tropicoblack/ico/CoolDiamonds2AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CoolDiamonds2AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20825,
			"launchUrl":"/game/CoolyGangs2MN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Cooly Gangs 2",
			"imageUrl":"/frontend/Tropicoblack/ico/CoolyGangs2MN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CoolyGangs2MN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20824,
			"launchUrl":"/game/CoolyGangsMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Cooly Gangs",
			"imageUrl":"/frontend/Tropicoblack/ico/CoolyGangsMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CoolyGangsMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20453,
			"launchUrl":"/game/CoralIslandEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Coral Island",
			"imageUrl":"/frontend/Tropicoblack/ico/CoralIslandEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CoralIslandEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20854,
			"launchUrl":"/game/CorridaRomanceWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Corrida Romance",
			"imageUrl":"/frontend/Tropicoblack/ico/CorridaRomanceWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CorridaRomanceWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20203,
			"launchUrl":"/game/Crazy7PT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Crazy 7",
			"imageUrl":"/frontend/Tropicoblack/ico/Crazy7PT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Crazy7PT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20477,
			"launchUrl":"/game/CrazyBugsIIEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Crazy Bugs II",
			"imageUrl":"/frontend/Tropicoblack/ico/CrazyBugsIIEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CrazyBugsIIEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20705,
			"launchUrl":"/game/CrazyCircusKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Crazy Circus",
			"imageUrl":"/frontend/Tropicoblack/ico/CrazyCircusKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CrazyCircusKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20118,
			"launchUrl":"/game/CrazyMonkey2IG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Crazy Monkey 2",
			"imageUrl":"/frontend/Tropicoblack/ico/CrazyMonkey2IG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CrazyMonkey2IG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20117,
			"launchUrl":"/game/CrazyMonkeyIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Crazy Monkey",
			"imageUrl":"/frontend/Tropicoblack/ico/CrazyMonkeyIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CrazyMonkeyIG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20779,
			"launchUrl":"/game/CreatureFromTheBlackLagoonNET",
			"providerId":"bomba",
			"categoryName":"1060",
			"gameName":"Creature From The Black Lagoon",
			"imageUrl":"/frontend/Tropicoblack/ico/CreatureFromTheBlackLagoonNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CreatureFromTheBlackLagoonNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20617,
			"launchUrl":"/game/CrystalBallGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Crystal Ball",
			"imageUrl":"/frontend/Tropicoblack/ico/CrystalBallGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CrystalBallGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20638,
			"launchUrl":"/game/CrystalBallGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Crystal Ball Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/CrystalBallGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CrystalBallGoldenNightsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20646,
			"launchUrl":"/game/CrystalBallRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Crystal Ball RedHot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/CrystalBallRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CrystalBallRedHotFirepotGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20668,
			"launchUrl":"/game/DajiKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Daji",
			"imageUrl":"/frontend/Tropicoblack/ico/DajiKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DajiKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20449,
			"launchUrl":"/game/DarkQueenEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dark Queen",
			"imageUrl":"/frontend/Tropicoblack/ico/DarkQueenEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DarkQueenEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20554,
			"launchUrl":"/game/DazzleMeNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Dazzle Me",
			"imageUrl":"/frontend/Tropicoblack/ico/DazzleMeNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DazzleMeNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":19922,
			"launchUrl":"/game/DazzlingDiamondsGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Dazzling Diamonds",
			"imageUrl":"/frontend/Tropicoblack/ico/DazzlingDiamondsGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DazzlingDiamondsGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20399,
			"launchUrl":"/game/DazzlingHot20EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dazzling Hot 20",
			"imageUrl":"/frontend/Tropicoblack/ico/DazzlingHot20EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DazzlingHot20EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20422,
			"launchUrl":"/game/DazzlingHot5EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dazzling Hot 5",
			"imageUrl":"/frontend/Tropicoblack/ico/DazzlingHot5EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DazzlingHot5EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20848,
			"launchUrl":"/game/DemonJack27WD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Demon Jack 27",
			"imageUrl":"/frontend/Tropicoblack/ico/DemonJack27WD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DemonJack27WD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20584,
			"launchUrl":"/game/DesertTalesCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Desert Tales",
			"imageUrl":"/frontend/Tropicoblack/ico/DesertTalesCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DesertTalesCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20543,
			"launchUrl":"/game/DesertTreasurePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Desert Treasure",
			"imageUrl":"/frontend/Tropicoblack/ico/DesertTreasurePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DesertTreasurePT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20367,
			"launchUrl":"/game/DeucesWildAM",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Deuces Wild",
			"imageUrl":"/frontend/Tropicoblack/ico/DeucesWildAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DeucesWildAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20344,
			"launchUrl":"/game/DevilsBridgeVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Devils Bridge",
			"imageUrl":"/frontend/Tropicoblack/ico/DevilsBridgeVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DevilsBridgeVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20342,
			"launchUrl":"/game/DevilsFireVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Devils Fire",
			"imageUrl":"/frontend/Tropicoblack/ico/DevilsFireVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DevilsFireVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":19923,
			"launchUrl":"/game/Diamond7GT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Diamond 7",
			"imageUrl":"/frontend/Tropicoblack/ico/Diamond7GT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Diamond7GT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20224,
			"launchUrl":"/game/DiamondCatsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Diamond Cats",
			"imageUrl":"/frontend/Tropicoblack/ico/DiamondCatsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DiamondCatsAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20173,
			"launchUrl":"/game/DiamondMonkeyAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Diamond Monkey",
			"imageUrl":"/frontend/Tropicoblack/ico/DiamondMonkeyAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DiamondMonkeyAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20430,
			"launchUrl":"/game/Diamonds20EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Diamonds 20",
			"imageUrl":"/frontend/Tropicoblack/ico/Diamonds20EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Diamonds20EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20087,
			"launchUrl":"/game/DiamondsOnFireAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Diamonds On Fire",
			"imageUrl":"/frontend/Tropicoblack/ico/DiamondsOnFireAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DiamondsOnFireAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20716,
			"launchUrl":"/game/Dice81EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dice 81",
			"imageUrl":"/frontend/Tropicoblack/ico/Dice81EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Dice81EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20451,
			"launchUrl":"/game/DiceAndRoll40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dice and Roll 40",
			"imageUrl":"/frontend/Tropicoblack/ico/DiceAndRoll40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DiceAndRoll40EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20431,
			"launchUrl":"/game/DiceAndRollEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dice and Roll",
			"imageUrl":"/frontend/Tropicoblack/ico/DiceAndRollEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DiceAndRollEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20479,
			"launchUrl":"/game/DiceOfMagicEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dice of Magic",
			"imageUrl":"/frontend/Tropicoblack/ico/DiceOfMagicEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DiceOfMagicEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20480,
			"launchUrl":"/game/DiceOfRaEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dice of Ra",
			"imageUrl":"/frontend/Tropicoblack/ico/DiceOfRaEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DiceOfRaEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20625,
			"launchUrl":"/game/DiscOfAthenaGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Disc Of Athena",
			"imageUrl":"/frontend/Tropicoblack/ico/DiscOfAthenaGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DiscOfAthenaGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20201,
			"launchUrl":"/game/DolphinReefPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Dolphin Reef",
			"imageUrl":"/frontend/Tropicoblack/ico/DolphinReefPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DolphinReefPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19924,
			"launchUrl":"/game/DolphinsPearlCL",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Dolphins Pearl",
			"imageUrl":"/frontend/Tropicoblack/ico/DolphinsPearlCL.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DolphinsPearlCL.jpg",
			"mobileGame": false
		},

				{
			"game_id":19925,
			"launchUrl":"/game/DolphinsPearlDXGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Dolphins Pearl",
			"imageUrl":"/frontend/Tropicoblack/ico/DolphinsPearlDXGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DolphinsPearlDXGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20762,
			"launchUrl":"/game/DolphinsTreasureAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Dolphins Treasure",
			"imageUrl":"/frontend/Tropicoblack/ico/DolphinsTreasureAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DolphinsTreasureAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20335,
			"launchUrl":"/game/DolphinsTreasureVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Dolphins Treasure",
			"imageUrl":"/frontend/Tropicoblack/ico/DolphinsTreasureVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DolphinsTreasureVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20377,
			"launchUrl":"/game/DoubleDoubleBonusAM",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Double Double Bonus",
			"imageUrl":"/frontend/Tropicoblack/ico/DoubleDoubleBonusAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DoubleDoubleBonusAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20763,
			"launchUrl":"/game/DoubleHappinessAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Double Happiness",
			"imageUrl":"/frontend/Tropicoblack/ico/DoubleHappinessAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DoubleHappinessAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20661,
			"launchUrl":"/game/DragonBoatKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Dragon Boat",
			"imageUrl":"/frontend/Tropicoblack/ico/DragonBoatKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DragonBoatKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20356,
			"launchUrl":"/game/DragonChampionsPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Dragon Champions",
			"imageUrl":"/frontend/Tropicoblack/ico/DragonChampionsPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DragonChampionsPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20482,
			"launchUrl":"/game/DragonReelsEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dragon Reels",
			"imageUrl":"/frontend/Tropicoblack/ico/DragonReelsEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DragonReelsEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20756,
			"launchUrl":"/game/Dragons50AT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Dragons 50",
			"imageUrl":"/frontend/Tropicoblack/ico/Dragons50AT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Dragons50AT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20755,
			"launchUrl":"/game/Dragons5AT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Dragons 5",
			"imageUrl":"/frontend/Tropicoblack/ico/Dragons5AT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Dragons5AT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20192,
			"launchUrl":"/game/Dragons888PM",
			"providerId":"bomba",
			"categoryName":"1072",
			"gameName":"Dragons 888",
			"imageUrl":"/frontend/Tropicoblack/ico/Dragons888PM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Dragons888PM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20148,
			"launchUrl":"/game/DragonsGiftAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Dragons Gift",
			"imageUrl":"/frontend/Tropicoblack/ico/DragonsGiftAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DragonsGiftAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20174,
			"launchUrl":"/game/DragonsKingdomAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Dragons Kingdom",
			"imageUrl":"/frontend/Tropicoblack/ico/DragonsKingdomAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DragonsKingdomAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20136,
			"launchUrl":"/game/DragonsPearlAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Dragons Pearl",
			"imageUrl":"/frontend/Tropicoblack/ico/DragonsPearlAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DragonsPearlAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20483,
			"launchUrl":"/game/DragonSpiritEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dragon Spirit",
			"imageUrl":"/frontend/Tropicoblack/ico/DragonSpiritEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DragonSpiritEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20683,
			"launchUrl":"/game/DreamcatcherKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Dreamcatcher",
			"imageUrl":"/frontend/Tropicoblack/ico/DreamcatcherKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DreamcatcherKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20793,
			"launchUrl":"/game/DuckyPowerBallKenoRS",
			"providerId":"bomba",
			"categoryName":"1078",
			"gameName":"Ducky Power Ball Keno",
			"imageUrl":"/frontend/Tropicoblack/ico/DuckyPowerBallKenoRS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DuckyPowerBallKenoRS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20365,
			"launchUrl":"/game/Dynamite7AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Dynamite 7",
			"imageUrl":"/frontend/Tropicoblack/ico/Dynamite7AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Dynamite7AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20185,
			"launchUrl":"/game/EasterSurprisePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Easter Surprise",
			"imageUrl":"/frontend/Tropicoblack/ico/EasterSurprisePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EasterSurprisePT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20588,
			"launchUrl":"/game/EggAndRoosterCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Egg and Rooster",
			"imageUrl":"/frontend/Tropicoblack/ico/EggAndRoosterCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EggAndRoosterCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20667,
			"launchUrl":"/game/EgyptianEmpressKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Egyptian Empress",
			"imageUrl":"/frontend/Tropicoblack/ico/EgyptianEmpressKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EgyptianEmpressKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20675,
			"launchUrl":"/game/EgyptianMythologyKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Egyptian Mythology",
			"imageUrl":"/frontend/Tropicoblack/ico/EgyptianMythologyKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EgyptianMythologyKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20484,
			"launchUrl":"/game/EgyptSkyEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Egypt Sky",
			"imageUrl":"/frontend/Tropicoblack/ico/EgyptSkyEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EgyptSkyEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19926,
			"launchUrl":"/game/ElvenPrincessGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Elven Princess",
			"imageUrl":"/frontend/Tropicoblack/ico/ElvenPrincessGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ElvenPrincessGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20823,
			"launchUrl":"/game/EmeraldCityMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Emerald City",
			"imageUrl":"/frontend/Tropicoblack/ico/EmeraldCityMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EmeraldCityMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20146,
			"launchUrl":"/game/EnchantedCleopatraAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Enchanted Cleopatra",
			"imageUrl":"/frontend/Tropicoblack/ico/EnchantedCleopatraAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EnchantedCleopatraAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20187,
			"launchUrl":"/game/EpicApePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Epic Ape",
			"imageUrl":"/frontend/Tropicoblack/ico/EpicApePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EpicApePT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20607,
			"launchUrl":"/game/ExplodiacGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Explodiac",
			"imageUrl":"/frontend/Tropicoblack/ico/ExplodiacGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ExplodiacGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20648,
			"launchUrl":"/game/ExplodiacRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Explodiac Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/ExplodiacRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ExplodiacRedHotFirepotGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20485,
			"launchUrl":"/game/ExtraJokerEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Extra Joker",
			"imageUrl":"/frontend/Tropicoblack/ico/ExtraJokerEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ExtraJokerEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20486,
			"launchUrl":"/game/ExtraStarsEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Extra Stars",
			"imageUrl":"/frontend/Tropicoblack/ico/ExtraStarsEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ExtraStarsEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20424,
			"launchUrl":"/game/ExtremelyHotEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Extremely Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/ExtremelyHotEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ExtremelyHotEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19927,
			"launchUrl":"/game/ExtremeRichesGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Extreme Riches",
			"imageUrl":"/frontend/Tropicoblack/ico/ExtremeRichesGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ExtremeRichesGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20139,
			"launchUrl":"/game/EyeOfRaAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Eye Of Ra",
			"imageUrl":"/frontend/Tropicoblack/ico/EyeOfRaAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EyeOfRaAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20700,
			"launchUrl":"/game/FairyDustKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Fairy Dust",
			"imageUrl":"/frontend/Tropicoblack/ico/FairyDustKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FairyDustKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20599,
			"launchUrl":"/game/FancyFruitsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Fancy Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/FancyFruitsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FancyFruitsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20631,
			"launchUrl":"/game/FancyFruitsGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Fancy Fruits Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/FancyFruitsGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FancyFruitsGoldenNightsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20639,
			"launchUrl":"/game/FancyFruitsRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Fancy Fruits Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/FancyFruitsRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FancyFruitsRedHotFirepotGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20366,
			"launchUrl":"/game/Fantastico7AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Fantastico 7",
			"imageUrl":"/frontend/Tropicoblack/ico/Fantastico7AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Fantastico7AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20674,
			"launchUrl":"/game/Fantasy777KA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Fantasy 777",
			"imageUrl":"/frontend/Tropicoblack/ico/Fantasy777KA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Fantasy777KA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20702,
			"launchUrl":"/game/FarmManiaKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Farm Mania",
			"imageUrl":"/frontend/Tropicoblack/ico/FarmManiaKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FarmManiaKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20458,
			"launchUrl":"/game/FastMoneyEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Fast Money",
			"imageUrl":"/frontend/Tropicoblack/ico/FastMoneyEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FastMoneyEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20724,
			"launchUrl":"/game/FeiCuiGongZhuJPPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Fei Cui Gong Zhu",
			"imageUrl":"/frontend/Tropicoblack/ico/FeiCuiGongZhuJPPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FeiCuiGongZhuJPPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20861,
			"launchUrl":"/game/FenixPlay27DeluxeWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Fenix Play 27 DX",
			"imageUrl":"/frontend/Tropicoblack/ico/FenixPlay27DeluxeWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FenixPlay27DeluxeWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20862,
			"launchUrl":"/game/FenixPlay27WD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Fenix Play 27",
			"imageUrl":"/frontend/Tropicoblack/ico/FenixPlay27WD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FenixPlay27WD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20213,
			"launchUrl":"/game/FireAndIceAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Fire And Ice",
			"imageUrl":"/frontend/Tropicoblack/ico/FireAndIceAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FireAndIceAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20712,
			"launchUrl":"/game/FireQueenAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Fire Queen",
			"imageUrl":"/frontend/Tropicoblack/ico/FireQueenAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FireQueenAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20794,
			"launchUrl":"/game/FishHunterKA",
			"providerId":"bomba",
			"categoryName":"1149",
			"gameName":"Fish Hunter",
			"imageUrl":"/frontend/Tropicoblack/ico/FishHunterKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FishHunterKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20833,
			"launchUrl":"/game/FishingForGoldISB",
			"providerId":"bomba",
			"categoryName":"1149",
			"gameName":"Fishing For Gold",
			"imageUrl":"/frontend/Tropicoblack/ico/FishingForGoldISB.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FishingForGoldISB.jpg",
			"mobileGame": false
		},

				{
			"game_id":19928,
			"launchUrl":"/game/FlameDancerGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Flame Dancer",
			"imageUrl":"/frontend/Tropicoblack/ico/FlameDancerGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FlameDancerGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20249,
			"launchUrl":"/game/FlameDancerGTM",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Flame Dancer",
			"imageUrl":"/frontend/Tropicoblack/ico/FlameDancerGTM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FlameDancerGTM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19929,
			"launchUrl":"/game/FlamencoRosesGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Flamenco Roses",
			"imageUrl":"/frontend/Tropicoblack/ico/FlamencoRosesGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FlamencoRosesGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20764,
			"launchUrl":"/game/FlameOfOlympusAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Flame Of Olympus",
			"imageUrl":"/frontend/Tropicoblack/ico/FlameOfOlympusAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FlameOfOlympusAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20656,
			"launchUrl":"/game/Flaming7sKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Flaming 7s",
			"imageUrl":"/frontend/Tropicoblack/ico/Flaming7sKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Flaming7sKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20435,
			"launchUrl":"/game/FlamingDiceEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Flaming Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/FlamingDiceEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FlamingDiceEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20423,
			"launchUrl":"/game/FlamingHotEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Flaming Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/FlamingHotEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FlamingHotEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20553,
			"launchUrl":"/game/FlowersChristmasNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Flowers Christmas",
			"imageUrl":"/frontend/Tropicoblack/ico/FlowersChristmasNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FlowersChristmasNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20552,
			"launchUrl":"/game/FlowersNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Flowers",
			"imageUrl":"/frontend/Tropicoblack/ico/FlowersNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FlowersNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20215,
			"launchUrl":"/game/FlyingDutchmanAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Flying Dutchman",
			"imageUrl":"/frontend/Tropicoblack/ico/FlyingDutchmanAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FlyingDutchmanAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20487,
			"launchUrl":"/game/ForestBandEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Forest Band",
			"imageUrl":"/frontend/Tropicoblack/ico/ForestBandEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ForestBandEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20566,
			"launchUrl":"/game/ForestNymphCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Forest Nymph",
			"imageUrl":"/frontend/Tropicoblack/ico/ForestNymphCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ForestNymphCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20488,
			"launchUrl":"/game/ForestTaleEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Forest Tale",
			"imageUrl":"/frontend/Tropicoblack/ico/ForestTaleEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ForestTaleEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20623,
			"launchUrl":"/game/ForeverDiamondsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Forever Diamonds",
			"imageUrl":"/frontend/Tropicoblack/ico/ForeverDiamondsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ForeverDiamondsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20689,
			"launchUrl":"/game/FormosanBirdsKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Formosan Birds",
			"imageUrl":"/frontend/Tropicoblack/ico/FormosanBirdsKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FormosanBirdsKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20131,
			"launchUrl":"/game/FortunasFruitsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Fortunas Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/FortunasFruitsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FortunasFruitsAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20693,
			"launchUrl":"/game/FortuneGodKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Fortune God",
			"imageUrl":"/frontend/Tropicoblack/ico/FortuneGodKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FortuneGodKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20778,
			"launchUrl":"/game/FortuneRangersNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Fortune Rangers",
			"imageUrl":"/frontend/Tropicoblack/ico/FortuneRangersNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FortuneRangersNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20489,
			"launchUrl":"/game/FortuneSpellsEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Fortune Spells",
			"imageUrl":"/frontend/Tropicoblack/ico/FortuneSpellsEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FortuneSpellsEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20545,
			"launchUrl":"/game/FountainOfYouthPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Fountain of Youth",
			"imageUrl":"/frontend/Tropicoblack/ico/FountainOfYouthPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FountainOfYouthPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20699,
			"launchUrl":"/game/FourBeautiesKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Four Beauties",
			"imageUrl":"/frontend/Tropicoblack/ico/FourBeautiesKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FourBeautiesKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20490,
			"launchUrl":"/game/FrogStoryEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Frog Story",
			"imageUrl":"/frontend/Tropicoblack/ico/FrogStoryEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FrogStoryEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20126,
			"launchUrl":"/game/FruitCocktail2IG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Fruit Cocktail 2",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitCocktail2IG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitCocktail2IG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20125,
			"launchUrl":"/game/FruitCocktailIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Fruit Cocktail",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitCocktailIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitCocktailIG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20374,
			"launchUrl":"/game/FruitExpressAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Fruit Express",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitExpressAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitExpressAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20853,
			"launchUrl":"/game/FruitFiestaWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Fruit Fiesta",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitFiestaWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitFiestaWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":19930,
			"launchUrl":"/game/FruitFortuneGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Fruit Fortune",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitFortuneGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitFortuneGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20064,
			"launchUrl":"/game/FruitMagicGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Fruit Magic",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitMagicGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitMagicGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20600,
			"launchUrl":"/game/FruitManiaGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Fruit Mania",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitManiaGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitManiaGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20630,
			"launchUrl":"/game/FruitManiaGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Fruit Mania Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitManiaGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitManiaGoldenNightsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20644,
			"launchUrl":"/game/FruitManiaRHFPGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Fruit Mania RHFP",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitManiaRHFPGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitManiaRHFPGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20371,
			"launchUrl":"/game/FruitPokerAM",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Fruit Poker",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitPokerAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitPokerAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19931,
			"launchUrl":"/game/FruitSensationGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Fruit Sensation",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitSensationGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitSensationGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20555,
			"launchUrl":"/game/FruitShopChristmasNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Fruit Shop Christmas",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitShopChristmasNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitShopChristmasNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20556,
			"launchUrl":"/game/FruitShopNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Fruit Shop",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitShopNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitShopNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20491,
			"launchUrl":"/game/FruitsKingdomEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Fruits Kingdom",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitsKingdomEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitsKingdomEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19933,
			"launchUrl":"/game/FruitsnSevensDXGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Fruitsn Sevens",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitsnSevensDXGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitsnSevensDXGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19932,
			"launchUrl":"/game/FruitsnSevensGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Fruitsn Sevens",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitsnSevensGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitsnSevensGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20576,
			"launchUrl":"/game/FruitsOfDesireCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Fruits of Desire",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitsOfDesireCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitsOfDesireCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19934,
			"launchUrl":"/game/FruitsRoyalsGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Fruits Royals",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitsRoyalsGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitsRoyalsGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20052,
			"launchUrl":"/game/FruitTumblingGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Fruit Tumbling",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitTumblingGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitTumblingGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20841,
			"launchUrl":"/game/FuFishSW",
			"providerId":"bomba",
			"categoryName":"1149",
			"gameName":"Fu Fish",
			"imageUrl":"/frontend/Tropicoblack/ico/FuFishSW.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FuFishSW.jpg",
			"mobileGame": false
		},

				{
			"game_id":20573,
			"launchUrl":"/game/FullOfLuckCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Full of Luck",
			"imageUrl":"/frontend/Tropicoblack/ico/FullOfLuckCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FullOfLuckCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20358,
			"launchUrl":"/game/FunkyMonkeyJPPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Funky Monkey JP",
			"imageUrl":"/frontend/Tropicoblack/ico/FunkyMonkeyJPPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FunkyMonkeyJPPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20157,
			"launchUrl":"/game/FunkyMonkeyPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Funky Monkey",
			"imageUrl":"/frontend/Tropicoblack/ico/FunkyMonkeyPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FunkyMonkeyPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20563,
			"launchUrl":"/game/FusionFruitBeatCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Fusion Fruit Beat",
			"imageUrl":"/frontend/Tropicoblack/ico/FusionFruitBeatCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FusionFruitBeatCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20339,
			"launchUrl":"/game/GalaxyVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Galaxy",
			"imageUrl":"/frontend/Tropicoblack/ico/GalaxyVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GalaxyVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20442,
			"launchUrl":"/game/GameOfLuckEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Game of Luck",
			"imageUrl":"/frontend/Tropicoblack/ico/GameOfLuckEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GameOfLuckEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20128,
			"launchUrl":"/game/GarageIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Garage",
			"imageUrl":"/frontend/Tropicoblack/ico/GarageIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GarageIG.jpg",
			"mobileGame": false
		},

				{
			"game_id":19935,
			"launchUrl":"/game/GardenOfRichesGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Garden of Riches",
			"imageUrl":"/frontend/Tropicoblack/ico/GardenOfRichesGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GardenOfRichesGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20806,
			"launchUrl":"/game/GatesOfAvalonMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Gates Of Avalon",
			"imageUrl":"/frontend/Tropicoblack/ico/GatesOfAvalonMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GatesOfAvalonMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20619,
			"launchUrl":"/game/GatesOfPersiaGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Gates Of Persia",
			"imageUrl":"/frontend/Tropicoblack/ico/GatesOfPersiaGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GatesOfPersiaGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20723,
			"launchUrl":"/game/GeishaStoryPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Geisha Story",
			"imageUrl":"/frontend/Tropicoblack/ico/GeishaStoryPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GeishaStoryPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20219,
			"launchUrl":"/game/GemStarAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Gem Star",
			"imageUrl":"/frontend/Tropicoblack/ico/GemStarAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GemStarAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20492,
			"launchUrl":"/game/GeniusOfLeonardoEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Genius of Leonardo",
			"imageUrl":"/frontend/Tropicoblack/ico/GeniusOfLeonardoEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GeniusOfLeonardoEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20834,
			"launchUrl":"/game/GhostsNGoldISB",
			"providerId":"bomba",
			"categoryName":"1062",
			"gameName":"Ghosts N Gold",
			"imageUrl":"/frontend/Tropicoblack/ico/GhostsNGoldISB.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GhostsNGoldISB.jpg",
			"mobileGame": false
		},

				{
			"game_id":20627,
			"launchUrl":"/game/GlamorousTimesGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Glamorous Times",
			"imageUrl":"/frontend/Tropicoblack/ico/GlamorousTimesGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GlamorousTimesGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20112,
			"launchUrl":"/game/GnomeIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Gnome",
			"imageUrl":"/frontend/Tropicoblack/ico/GnomeIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GnomeIG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20557,
			"launchUrl":"/game/GoBananasNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Go Bananas",
			"imageUrl":"/frontend/Tropicoblack/ico/GoBananasNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoBananasNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20175,
			"launchUrl":"/game/GoldenBookAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Golden Book",
			"imageUrl":"/frontend/Tropicoblack/ico/GoldenBookAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoldenBookAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20789,
			"launchUrl":"/game/GoldenEggKenoPLP",
			"providerId":"bomba",
			"categoryName":"1078",
			"gameName":"Golden Egg Keno",
			"imageUrl":"/frontend/Tropicoblack/ico/GoldenEggKenoPLP.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoldenEggKenoPLP.jpg",
			"mobileGame": false
		},

				{
			"game_id":20805,
			"launchUrl":"/game/GoldenHarvestMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Golden Harvest",
			"imageUrl":"/frontend/Tropicoblack/ico/GoldenHarvestMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoldenHarvestMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20176,
			"launchUrl":"/game/GoldenJokerAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Golden Joker",
			"imageUrl":"/frontend/Tropicoblack/ico/GoldenJokerAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoldenJokerAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19936,
			"launchUrl":"/game/GoldenReelGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Golden Reel",
			"imageUrl":"/frontend/Tropicoblack/ico/GoldenReelGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoldenReelGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19938,
			"launchUrl":"/game/GoldenSevensDXGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"GoldenS evens",
			"imageUrl":"/frontend/Tropicoblack/ico/GoldenSevensDXGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoldenSevensDXGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19937,
			"launchUrl":"/game/GoldenSevensGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Golden Sevens",
			"imageUrl":"/frontend/Tropicoblack/ico/GoldenSevensGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoldenSevensGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20695,
			"launchUrl":"/game/GoldenShanghaiKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Golden Shanghai",
			"imageUrl":"/frontend/Tropicoblack/ico/GoldenShanghaiKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoldenShanghaiKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20866,
			"launchUrl":"/game/GoldenSphinxWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Golden Sphinx",
			"imageUrl":"/frontend/Tropicoblack/ico/GoldenSphinxWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoldenSphinxWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20598,
			"launchUrl":"/game/GoldenTouchGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Golden Touch",
			"imageUrl":"/frontend/Tropicoblack/ico/GoldenTouchGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoldenTouchGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20360,
			"launchUrl":"/game/GoldenTourPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Golden Tour",
			"imageUrl":"/frontend/Tropicoblack/ico/GoldenTourPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoldenTourPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20865,
			"launchUrl":"/game/GoodLuck40WD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Good Luck 40",
			"imageUrl":"/frontend/Tropicoblack/ico/GoodLuck40WD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoodLuck40WD.jpg",
			"mobileGame": false
		},

				{
			"game_id":19939,
			"launchUrl":"/game/GorgeousGoddessGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Gorgeous Goddess",
			"imageUrl":"/frontend/Tropicoblack/ico/GorgeousGoddessGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GorgeousGoddessGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19940,
			"launchUrl":"/game/GorillaGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Gorilla",
			"imageUrl":"/frontend/Tropicoblack/ico/GorillaGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GorillaGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20493,
			"launchUrl":"/game/GraceOfCleopatraEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Grace of Cleopatra",
			"imageUrl":"/frontend/Tropicoblack/ico/GraceOfCleopatraEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GraceOfCleopatraEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20709,
			"launchUrl":"/game/GrandCasanovaAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Grand Casanova",
			"imageUrl":"/frontend/Tropicoblack/ico/GrandCasanovaAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GrandCasanovaAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20711,
			"launchUrl":"/game/GrandFruitsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Grand Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/GrandFruitsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GrandFruitsAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19941,
			"launchUrl":"/game/GrandJesterGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Grand Jester",
			"imageUrl":"/frontend/Tropicoblack/ico/GrandJesterGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GrandJesterGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20783,
			"launchUrl":"/game/GrandSpinnSuperpotNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Grand Spinn Superpot",
			"imageUrl":"/frontend/Tropicoblack/ico/GrandSpinnSuperpotNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GrandSpinnSuperpotNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20177,
			"launchUrl":"/game/GrandTigerAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Grand Tiger",
			"imageUrl":"/frontend/Tropicoblack/ico/GrandTigerAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GrandTigerAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20178,
			"launchUrl":"/game/GrandXAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Grand X",
			"imageUrl":"/frontend/Tropicoblack/ico/GrandXAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GrandXAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20494,
			"launchUrl":"/game/Great27EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Great 27",
			"imageUrl":"/frontend/Tropicoblack/ico/Great27EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Great27EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20495,
			"launchUrl":"/game/GreatAdventureEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Great Adventure",
			"imageUrl":"/frontend/Tropicoblack/ico/GreatAdventureEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GreatAdventureEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20104,
			"launchUrl":"/game/GreatBlueJPPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Great Blue JP",
			"imageUrl":"/frontend/Tropicoblack/ico/GreatBlueJPPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GreatBlueJPPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20075,
			"launchUrl":"/game/GreatBluePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Great Blue",
			"imageUrl":"/frontend/Tropicoblack/ico/GreatBluePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GreatBluePT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20845,
			"launchUrl":"/game/GreatBookOfMagicDeluxeWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Great Book Of Magic Deluxe",
			"imageUrl":"/frontend/Tropicoblack/ico/GreatBookOfMagicDeluxeWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GreatBookOfMagicDeluxeWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20846,
			"launchUrl":"/game/GreatBookOfMagicWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Great Book Of Magic",
			"imageUrl":"/frontend/Tropicoblack/ico/GreatBookOfMagicWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GreatBookOfMagicWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20496,
			"launchUrl":"/game/GreatEgyptEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Great Egypt",
			"imageUrl":"/frontend/Tropicoblack/ico/GreatEgyptEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GreatEgyptEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20497,
			"launchUrl":"/game/GreatEmpireEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Great Empire",
			"imageUrl":"/frontend/Tropicoblack/ico/GreatEmpireEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GreatEmpireEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20406,
			"launchUrl":"/game/GreatRhinoPM",
			"providerId":"bomba",
			"categoryName":"1072",
			"gameName":"Great Rhino",
			"imageUrl":"/frontend/Tropicoblack/ico/GreatRhinoPM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GreatRhinoPM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20437,
			"launchUrl":"/game/GreatStar5EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Great Star 5",
			"imageUrl":"/frontend/Tropicoblack/ico/GreatStar5EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GreatStar5EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20565,
			"launchUrl":"/game/GroovyAutomatCT",
			"providerId":"bomba",
			"categoryName":"1059",
			"gameName":"Groovy Automat",
			"imageUrl":"/frontend/Tropicoblack/ico/GroovyAutomatCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GroovyAutomatCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19942,
			"launchUrl":"/game/GryphonsGoldDX",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Gryphons Gold",
			"imageUrl":"/frontend/Tropicoblack/ico/GryphonsGoldDX.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GryphonsGoldDX.jpg",
			"mobileGame": false
		},

				{
			"game_id":20498,
			"launchUrl":"/game/HalloweenEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Halloween",
			"imageUrl":"/frontend/Tropicoblack/ico/HalloweenEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HalloweenEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20310,
			"launchUrl":"/game/HalloweenFortunePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Halloween Fortune",
			"imageUrl":"/frontend/Tropicoblack/ico/HalloweenFortunePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HalloweenFortunePT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20821,
			"launchUrl":"/game/HaresRevengeMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Hares Revenge",
			"imageUrl":"/frontend/Tropicoblack/ico/HaresRevengeMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HaresRevengeMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":19943,
			"launchUrl":"/game/Helena",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Helena",
			"imageUrl":"/frontend/Tropicoblack/ico/Helena.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Helena.jpg",
			"mobileGame": false
		},

				{
			"game_id":20189,
			"launchUrl":"/game/HighwayKingsPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Highway Kings",
			"imageUrl":"/frontend/Tropicoblack/ico/HighwayKingsPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HighwayKingsPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20844,
			"launchUrl":"/game/HighwayToHellDeluxeWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Highway To Hell Deluxe",
			"imageUrl":"/frontend/Tropicoblack/ico/HighwayToHellDeluxeWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HighwayToHellDeluxeWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20843,
			"launchUrl":"/game/HighwayToHellWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Highway To Hell",
			"imageUrl":"/frontend/Tropicoblack/ico/HighwayToHellWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HighwayToHellWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20810,
			"launchUrl":"/game/HitJewelsMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Hit Jewels",
			"imageUrl":"/frontend/Tropicoblack/ico/HitJewelsMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HitJewelsMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":19944,
			"launchUrl":"/game/HoffmeisterGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Hoffmeister",
			"imageUrl":"/frontend/Tropicoblack/ico/HoffmeisterGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HoffmeisterGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20692,
			"launchUrl":"/game/HoroscopeKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Horoscope",
			"imageUrl":"/frontend/Tropicoblack/ico/HoroscopeKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HoroscopeKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20499,
			"launchUrl":"/game/Horses50EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Horses 50",
			"imageUrl":"/frontend/Tropicoblack/ico/Horses50EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Horses50EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20179,
			"launchUrl":"/game/Hot27AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot 27",
			"imageUrl":"/frontend/Tropicoblack/ico/Hot27AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Hot27AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20082,
			"launchUrl":"/game/Hot40AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot 40",
			"imageUrl":"/frontend/Tropicoblack/ico/Hot40AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Hot40AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20084,
			"launchUrl":"/game/Hot7AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot 7",
			"imageUrl":"/frontend/Tropicoblack/ico/Hot7AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Hot7AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20380,
			"launchUrl":"/game/Hot7DiceAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot 7 Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/Hot7DiceAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Hot7DiceAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20143,
			"launchUrl":"/game/Hot81AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot 81",
			"imageUrl":"/frontend/Tropicoblack/ico/Hot81AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Hot81AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20426,
			"launchUrl":"/game/HotAndCashEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Hot and Cash",
			"imageUrl":"/frontend/Tropicoblack/ico/HotAndCashEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotAndCashEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20180,
			"launchUrl":"/game/HotChoiceAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Choice",
			"imageUrl":"/frontend/Tropicoblack/ico/HotChoiceAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotChoiceAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20212,
			"launchUrl":"/game/HotDiamondsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Diamonds",
			"imageUrl":"/frontend/Tropicoblack/ico/HotDiamondsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotDiamondsAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20427,
			"launchUrl":"/game/HotDice5EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Hot Dice 5",
			"imageUrl":"/frontend/Tropicoblack/ico/HotDice5EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotDice5EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20090,
			"launchUrl":"/game/HotFruits100AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Fruits 100",
			"imageUrl":"/frontend/Tropicoblack/ico/HotFruits100AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotFruits100AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20088,
			"launchUrl":"/game/HotFruits20AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Fruits 20",
			"imageUrl":"/frontend/Tropicoblack/ico/HotFruits20AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotFruits20AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20089,
			"launchUrl":"/game/HotFruits40AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Fruits 40",
			"imageUrl":"/frontend/Tropicoblack/ico/HotFruits40AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotFruits40AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20348,
			"launchUrl":"/game/HotFruitsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Hot Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/HotFruitsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotFruitsVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20312,
			"launchUrl":"/game/HotGemsPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Hot Gems",
			"imageUrl":"/frontend/Tropicoblack/ico/HotGemsPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotGemsPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20100,
			"launchUrl":"/game/HotNeonAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Neon",
			"imageUrl":"/frontend/Tropicoblack/ico/HotNeonAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotNeonAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20858,
			"launchUrl":"/game/HotPartyDeluxeWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Hot Party Deluxe",
			"imageUrl":"/frontend/Tropicoblack/ico/HotPartyDeluxeWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotPartyDeluxeWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20852,
			"launchUrl":"/game/HotPartyWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Hot Party",
			"imageUrl":"/frontend/Tropicoblack/ico/HotPartyWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotPartyWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20347,
			"launchUrl":"/game/HotReelsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Hot Reels",
			"imageUrl":"/frontend/Tropicoblack/ico/HotReelsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotReelsVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20098,
			"launchUrl":"/game/HotScatterAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Scatter",
			"imageUrl":"/frontend/Tropicoblack/ico/HotScatterAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotScatterAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20379,
			"launchUrl":"/game/HotScatterDiceAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Scatter Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/HotScatterDiceAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotScatterDiceAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20809,
			"launchUrl":"/game/HotSevensDeluxeMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Hot Sevens Deluxe",
			"imageUrl":"/frontend/Tropicoblack/ico/HotSevensDeluxeMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotSevensDeluxeMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20808,
			"launchUrl":"/game/HotSevensMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Hot Sevens",
			"imageUrl":"/frontend/Tropicoblack/ico/HotSevensMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotSevensMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20831,
			"launchUrl":"/game/HotSpinDeluxeISB",
			"providerId":"bomba",
			"categoryName":"1062",
			"gameName":"Hot Spin Deluxe",
			"imageUrl":"/frontend/Tropicoblack/ico/HotSpinDeluxeISB.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotSpinDeluxeISB.jpg",
			"mobileGame": false
		},

				{
			"game_id":20181,
			"launchUrl":"/game/HotStarAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Star",
			"imageUrl":"/frontend/Tropicoblack/ico/HotStarAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotStarAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20710,
			"launchUrl":"/game/HottestFruits20AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hottest Fruits 20",
			"imageUrl":"/frontend/Tropicoblack/ico/HottestFruits20AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HottestFruits20AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20715,
			"launchUrl":"/game/HottestFruits40AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hottest Fruits 40",
			"imageUrl":"/frontend/Tropicoblack/ico/HottestFruits40AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HottestFruits40AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20086,
			"launchUrl":"/game/HotTwentyAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Twenty",
			"imageUrl":"/frontend/Tropicoblack/ico/HotTwentyAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotTwentyAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20863,
			"launchUrl":"/game/HungrySharkWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Hungry Shark",
			"imageUrl":"/frontend/Tropicoblack/ico/HungrySharkWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HungrySharkWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20500,
			"launchUrl":"/game/IceDiceEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Ice Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/IceDiceEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/IceDiceEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20501,
			"launchUrl":"/game/ImperialDiceEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Imperial Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/ImperialDiceEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ImperialDiceEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20690,
			"launchUrl":"/game/ImperialGirlsKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Imperial Girls",
			"imageUrl":"/frontend/Tropicoblack/ico/ImperialGirlsKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ImperialGirlsKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20502,
			"launchUrl":"/game/ImperialWarsEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Imperial Wars",
			"imageUrl":"/frontend/Tropicoblack/ico/ImperialWarsEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ImperialWarsEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20503,
			"launchUrl":"/game/IncaGoldIIEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Inca Gold II",
			"imageUrl":"/frontend/Tropicoblack/ico/IncaGoldIIEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/IncaGoldIIEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20864,
			"launchUrl":"/game/InTheForestWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"In The Forest",
			"imageUrl":"/frontend/Tropicoblack/ico/InTheForestWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/InTheForestWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20207,
			"launchUrl":"/game/IrishLuckPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Irish Luck",
			"imageUrl":"/frontend/Tropicoblack/ico/IrishLuckPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/IrishLuckPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20114,
			"launchUrl":"/game/Island2IG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Island 2",
			"imageUrl":"/frontend/Tropicoblack/ico/Island2IG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Island2IG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20113,
			"launchUrl":"/game/IslandIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Island",
			"imageUrl":"/frontend/Tropicoblack/ico/IslandIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/IslandIG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20547,
			"launchUrl":"/game/JackpotBellsPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Jackpot Bells",
			"imageUrl":"/frontend/Tropicoblack/ico/JackpotBellsPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JackpotBellsPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19945,
			"launchUrl":"/game/JackpotCrownGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Jackpot Crown",
			"imageUrl":"/frontend/Tropicoblack/ico/JackpotCrownGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JackpotCrownGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20332,
			"launchUrl":"/game/JacksOrBetterAM",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Jacks Or Better",
			"imageUrl":"/frontend/Tropicoblack/ico/JacksOrBetterAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JacksOrBetterAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20471,
			"launchUrl":"/game/JacksOrBetterEGT",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Jacks or Better",
			"imageUrl":"/frontend/Tropicoblack/ico/JacksOrBetterEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JacksOrBetterEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20205,
			"launchUrl":"/game/JacksOrBetterMHPT",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Jacks Or Better MH",
			"imageUrl":"/frontend/Tropicoblack/ico/JacksOrBetterMHPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JacksOrBetterMHPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20161,
			"launchUrl":"/game/JacksOrBetterPT",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Jacks or Better",
			"imageUrl":"/frontend/Tropicoblack/ico/JacksOrBetterPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JacksOrBetterPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20567,
			"launchUrl":"/game/JadeHeavenCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Jade Heaven",
			"imageUrl":"/frontend/Tropicoblack/ico/JadeHeavenCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JadeHeavenCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20765,
			"launchUrl":"/game/JaguarMistAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Jaguar Mist",
			"imageUrl":"/frontend/Tropicoblack/ico/JaguarMistAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JaguarMistAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20679,
			"launchUrl":"/game/JellyManiaKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Jelly Mania",
			"imageUrl":"/frontend/Tropicoblack/ico/JellyManiaKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JellyManiaKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":19946,
			"launchUrl":"/game/JestersCrownGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Jesters Crown",
			"imageUrl":"/frontend/Tropicoblack/ico/JestersCrownGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JestersCrownGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20314,
			"launchUrl":"/game/JiXiang8PT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Ji Xiang 8",
			"imageUrl":"/frontend/Tropicoblack/ico/JiXiang8PT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JiXiang8PT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20370,
			"launchUrl":"/game/JokerCardAM",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Joker Card",
			"imageUrl":"/frontend/Tropicoblack/ico/JokerCardAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JokerCardAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20373,
			"launchUrl":"/game/JokerPokerAM",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Joker Poker",
			"imageUrl":"/frontend/Tropicoblack/ico/JokerPokerAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JokerPokerAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20536,
			"launchUrl":"/game/JokerPokerEGT",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Joker Poker",
			"imageUrl":"/frontend/Tropicoblack/ico/JokerPokerEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JokerPokerEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20400,
			"launchUrl":"/game/JokerReels20EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Joker Reels 20",
			"imageUrl":"/frontend/Tropicoblack/ico/JokerReels20EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JokerReels20EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20408,
			"launchUrl":"/game/JokersJewelPM",
			"providerId":"bomba",
			"categoryName":"1072",
			"gameName":"Jokers Jewel",
			"imageUrl":"/frontend/Tropicoblack/ico/JokersJewelPM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JokersJewelPM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20704,
			"launchUrl":"/game/JokerSlotKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Joker Slot",
			"imageUrl":"/frontend/Tropicoblack/ico/JokerSlotKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JokerSlotKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":19947,
			"launchUrl":"/game/JollyFruitsGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Jolly Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/JollyFruitsGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JollyFruitsGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19948,
			"launchUrl":"/game/JollyReelsGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Jolly Reels",
			"imageUrl":"/frontend/Tropicoblack/ico/JollyReelsGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JollyReelsGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20694,
			"launchUrl":"/game/JourneyToWestKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Journey To West",
			"imageUrl":"/frontend/Tropicoblack/ico/JourneyToWestKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JourneyToWestKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20504,
			"launchUrl":"/game/JuggleFruitsEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Juggle Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/JuggleFruitsEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JuggleFruitsEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20785,
			"launchUrl":"/game/JumanjiNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Jumanji",
			"imageUrl":"/frontend/Tropicoblack/ico/JumanjiNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JumanjiNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20505,
			"launchUrl":"/game/JungleAdventureEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Jungle Adventure",
			"imageUrl":"/frontend/Tropicoblack/ico/JungleAdventureEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JungleAdventureEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19949,
			"launchUrl":"/game/JustJewelsDX",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Just JewelsDX",
			"imageUrl":"/frontend/Tropicoblack/ico/JustJewelsDX.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JustJewelsDX.jpg",
			"mobileGame": false
		},

				{
			"game_id":20455,
			"launchUrl":"/game/KangarooLandEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Kangaroo Land",
			"imageUrl":"/frontend/Tropicoblack/ico/KangarooLandEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KangarooLandEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19950,
			"launchUrl":"/game/KatanaGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Katana",
			"imageUrl":"/frontend/Tropicoblack/ico/KatanaGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KatanaGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20119,
			"launchUrl":"/game/KeksIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Keks",
			"imageUrl":"/frontend/Tropicoblack/ico/KeksIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KeksIG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20721,
			"launchUrl":"/game/KenoEGT",
			"providerId":"bomba",
			"categoryName":"1078",
			"gameName":"Keno",
			"imageUrl":"/frontend/Tropicoblack/ico/KenoEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KenoEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20788,
			"launchUrl":"/game/KenoPop1x2",
			"providerId":"bomba",
			"categoryName":"1078",
			"gameName":"Keno Pop1",
			"imageUrl":"/frontend/Tropicoblack/ico/KenoPop1x2.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KenoPop1x2.jpg",
			"mobileGame": false
		},

				{
			"game_id":20620,
			"launchUrl":"/game/KingAndQueenGM",
			"providerId":"bomba",
			"categoryName":"1059",
			"gameName":"King and Queen",
			"imageUrl":"/frontend/Tropicoblack/ico/KingAndQueenGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingAndQueenGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19951,
			"launchUrl":"/game/KingOfCardsDXGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"King of Cards",
			"imageUrl":"/frontend/Tropicoblack/ico/KingOfCardsDXGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingOfCardsDXGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20811,
			"launchUrl":"/game/KingOfJewelsMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"King OfJ ewels",
			"imageUrl":"/frontend/Tropicoblack/ico/KingOfJewelsMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingOfJewelsMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20590,
			"launchUrl":"/game/KingOfTheJungleGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"King of the Jungle",
			"imageUrl":"/frontend/Tropicoblack/ico/KingOfTheJungleGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingOfTheJungleGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20632,
			"launchUrl":"/game/KingOfTheJungleGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"King Of The Jungle Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/KingOfTheJungleGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingOfTheJungleGoldenNightsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20642,
			"launchUrl":"/game/KingOfTheJungleRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"King Of The Jungle Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/KingOfTheJungleRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingOfTheJungleRedHotFirepotGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20094,
			"launchUrl":"/game/KingsCrownAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Kings Crown",
			"imageUrl":"/frontend/Tropicoblack/ico/KingsCrownAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingsCrownAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19952,
			"launchUrl":"/game/KingsJesterGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Kings Jester",
			"imageUrl":"/frontend/Tropicoblack/ico/KingsJesterGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingsJesterGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19953,
			"launchUrl":"/game/KingsTreasureGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Kings Treasure",
			"imageUrl":"/frontend/Tropicoblack/ico/KingsTreasureGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingsTreasureGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19954,
			"launchUrl":"/game/LadyJesterGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Lady Jester",
			"imageUrl":"/frontend/Tropicoblack/ico/LadyJesterGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LadyJesterGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20093,
			"launchUrl":"/game/LadyJokerAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Lady Joker",
			"imageUrl":"/frontend/Tropicoblack/ico/LadyJokerAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LadyJokerAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20337,
			"launchUrl":"/game/LadysKissDeluxeVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Ladys Kiss Deluxe",
			"imageUrl":"/frontend/Tropicoblack/ico/LadysKissDeluxeVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LadysKissDeluxeVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20338,
			"launchUrl":"/game/LadysKissVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Ladys Kiss",
			"imageUrl":"/frontend/Tropicoblack/ico/LadysKissVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LadysKissVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20218,
			"launchUrl":"/game/LaGranAventuraAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"La Gran Aventura",
			"imageUrl":"/frontend/Tropicoblack/ico/LaGranAventuraAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LaGranAventuraAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20790,
			"launchUrl":"/game/LastBlastKenoGV",
			"providerId":"bomba",
			"categoryName":"1078",
			"gameName":"Last Blast Keno",
			"imageUrl":"/frontend/Tropicoblack/ico/LastBlastKenoGV.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LastBlastKenoGV.jpg",
			"mobileGame": false
		},

				{
			"game_id":20506,
			"launchUrl":"/game/LegendaryRomeEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Legendary Rome",
			"imageUrl":"/frontend/Tropicoblack/ico/LegendaryRomeEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LegendaryRomeEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20673,
			"launchUrl":"/game/LegendOfTheWhiteSnakeKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Legend Of The White Snake",
			"imageUrl":"/frontend/Tropicoblack/ico/LegendOfTheWhiteSnakeKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LegendOfTheWhiteSnakeKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20814,
			"launchUrl":"/game/LeosTreasureMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Leos Treasure",
			"imageUrl":"/frontend/Tropicoblack/ico/LeosTreasureMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LeosTreasureMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20199,
			"launchUrl":"/game/LieYanZuanShiPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Lie Yan Zuan Shi",
			"imageUrl":"/frontend/Tropicoblack/ico/LieYanZuanShiPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LieYanZuanShiPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20364,
			"launchUrl":"/game/LightingHotAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Lighting Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/LightingHotAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LightingHotAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20558,
			"launchUrl":"/game/LightsNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Lights",
			"imageUrl":"/frontend/Tropicoblack/ico/LightsNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LightsNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20481,
			"launchUrl":"/game/LikeADiamonds20EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Like a Diamonds 20",
			"imageUrl":"/frontend/Tropicoblack/ico/LikeADiamonds20EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LikeADiamonds20EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20478,
			"launchUrl":"/game/LikeADiamonds40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Like a Diamonds 40",
			"imageUrl":"/frontend/Tropicoblack/ico/LikeADiamonds40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LikeADiamonds40EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20757,
			"launchUrl":"/game/Lions50AT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Lions 50",
			"imageUrl":"/frontend/Tropicoblack/ico/Lions50AT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Lions50AT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20691,
			"launchUrl":"/game/LiveStreamingStarKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Live Streaming Star",
			"imageUrl":"/frontend/Tropicoblack/ico/LiveStreamingStarKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LiveStreamingStarKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20336,
			"launchUrl":"/game/LoonyFruitsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Loony Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/LoonyFruitsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LoonyFruitsVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20832,
			"launchUrl":"/game/LostBoysLootISB",
			"providerId":"bomba",
			"categoryName":"1062",
			"gameName":"Lost Boys Loot",
			"imageUrl":"/frontend/Tropicoblack/ico/LostBoysLootISB.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LostBoysLootISB.jpg",
			"mobileGame": false
		},

				{
			"game_id":20665,
			"launchUrl":"/game/LostRealmKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Lost Realm",
			"imageUrl":"/frontend/Tropicoblack/ico/LostRealmKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LostRealmKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20867,
			"launchUrl":"/game/LostTreasureWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Lost Treasure",
			"imageUrl":"/frontend/Tropicoblack/ico/LostTreasureWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LostTreasureWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20708,
			"launchUrl":"/game/LotusLampKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Lotus Lamp",
			"imageUrl":"/frontend/Tropicoblack/ico/LotusLampKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LotusLampKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20137,
			"launchUrl":"/game/LovelyLadyAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Lovely Lady",
			"imageUrl":"/frontend/Tropicoblack/ico/LovelyLadyAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LovelyLadyAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19955,
			"launchUrl":"/game/LovelyMermaidGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Lovel yMermaid",
			"imageUrl":"/frontend/Tropicoblack/ico/LovelyMermaidGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LovelyMermaidGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20766,
			"launchUrl":"/game/Lucky88AT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Lucky 88",
			"imageUrl":"/frontend/Tropicoblack/ico/Lucky88AT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Lucky88AT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20428,
			"launchUrl":"/game/LuckyAndWild20EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Lucky and Wild 20",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyAndWild20EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyAndWild20EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20429,
			"launchUrl":"/game/LuckyAndWild40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Lucky and Wild 40",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyAndWild40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyAndWild40EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20092,
			"launchUrl":"/game/LuckyBellsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Lucky Bells",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyBellsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyBellsAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20507,
			"launchUrl":"/game/LuckyBuzzEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Lucky Buzz",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyBuzzEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyBuzzEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20570,
			"launchUrl":"/game/LuckyCloverCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Lucky Clover",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyCloverCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyCloverCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20135,
			"launchUrl":"/game/LuckyCoinAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Lucky Coin",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyCoinAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyCoinAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20767,
			"launchUrl":"/game/LuckyCountAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Lucky Count",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyCountAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyCountAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20817,
			"launchUrl":"/game/LuckyDrinkMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Lucky Drink",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyDrinkMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyDrinkMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20850,
			"launchUrl":"/game/LuckyFortuneWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Lucky Fortune",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyFortuneWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyFortuneWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20120,
			"launchUrl":"/game/LuckyHaunterIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Lucky Haunter",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyHaunterIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyHaunterIG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20425,
			"launchUrl":"/game/LuckyHotEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Lucky Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyHotEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyHotEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20183,
			"launchUrl":"/game/LuckyJoker20AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Lucky Joker 20",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyJoker20AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyJoker20AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20182,
			"launchUrl":"/game/LuckyJoker5AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Lucky Joker 5",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyJoker5AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyJoker5AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19956,
			"launchUrl":"/game/LuckyJollyGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Lucky Jolly",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyJollyGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyJollyGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20791,
			"launchUrl":"/game/LuckyKenoPP",
			"providerId":"bomba",
			"categoryName":"1078",
			"gameName":"Lucky Keno",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyKenoPP.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyKenoPP.jpg",
			"mobileGame": false
		},

				{
			"game_id":20438,
			"launchUrl":"/game/LuckyKing40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Lucky King 40",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyKing40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyKing40EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19957,
			"launchUrl":"/game/LuckyLadysCharmCL",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Lucky Ladys Charm",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyLadysCharmCL.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyLadysCharmCL.jpg",
			"mobileGame": false
		},

				{
			"game_id":19958,
			"launchUrl":"/game/LuckyLadysCharmDX",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Lucky Ladys Charm",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyLadysCharmDX.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyLadysCharmDX.jpg",
			"mobileGame": false
		},

				{
			"game_id":20053,
			"launchUrl":"/game/LuckyLadysCharmDX6GT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Lucky Ladys Charm 6",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyLadysCharmDX6GT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyLadysCharmDX6GT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20837,
			"launchUrl":"/game/LuckyLeprechaunISB",
			"providerId":"bomba",
			"categoryName":"1062",
			"gameName":"Lucky Leprechaun",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyLeprechaunISB.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyLeprechaunISB.jpg",
			"mobileGame": false
		},

				{
			"game_id":20842,
			"launchUrl":"/game/LuckyQueenWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Lucky Queen",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyQueenWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyQueenWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20228,
			"launchUrl":"/game/LuckyZodiacAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Lucky Zodiac",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyZodiacAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyZodiacAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20602,
			"launchUrl":"/game/MaaaxDiamondsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Maaax Diamonds",
			"imageUrl":"/frontend/Tropicoblack/ico/MaaaxDiamondsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MaaaxDiamondsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20634,
			"launchUrl":"/game/MaaaxDiamondsGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Maaax Diamonds Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/MaaaxDiamondsGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MaaaxDiamondsGoldenNightsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20508,
			"launchUrl":"/game/MagellanEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Magellan",
			"imageUrl":"/frontend/Tropicoblack/ico/MagellanEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagellanEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20054,
			"launchUrl":"/game/Magic27GT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Magic 27",
			"imageUrl":"/frontend/Tropicoblack/ico/Magic27GT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Magic27GT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20099,
			"launchUrl":"/game/MagicForestAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Magic Forest",
			"imageUrl":"/frontend/Tropicoblack/ico/MagicForestAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagicForestAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20868,
			"launchUrl":"/game/MagicFruits27WD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Magic Fruits 27",
			"imageUrl":"/frontend/Tropicoblack/ico/MagicFruits27WD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagicFruits27WD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20351,
			"launchUrl":"/game/MagicFruitsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Magic Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/MagicFruitsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagicFruitsVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20849,
			"launchUrl":"/game/MagicHotWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Magic Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/MagicHotWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagicHotWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20096,
			"launchUrl":"/game/MagicIdolAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Magic Idol",
			"imageUrl":"/frontend/Tropicoblack/ico/MagicIdolAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagicIdolAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20847,
			"launchUrl":"/game/MagicOfTheRingWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Magic Of The Ring",
			"imageUrl":"/frontend/Tropicoblack/ico/MagicOfTheRingWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagicOfTheRingWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20226,
			"launchUrl":"/game/MagicOwlAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Magic Owl",
			"imageUrl":"/frontend/Tropicoblack/ico/MagicOwlAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagicOwlAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19959,
			"launchUrl":"/game/MagicPrincessDXGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Magic Princess",
			"imageUrl":"/frontend/Tropicoblack/ico/MagicPrincessDXGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagicPrincessDXGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20859,
			"launchUrl":"/game/MagicStars5WD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Magic Stars 5",
			"imageUrl":"/frontend/Tropicoblack/ico/MagicStars5WD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagicStars5WD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20595,
			"launchUrl":"/game/MagicStoneGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Magic Stone",
			"imageUrl":"/frontend/Tropicoblack/ico/MagicStoneGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagicStoneGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20509,
			"launchUrl":"/game/MajesticForestEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Majestic Forest",
			"imageUrl":"/frontend/Tropicoblack/ico/MajesticForestEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MajesticForestEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20802,
			"launchUrl":"/game/MarinerMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Mariner",
			"imageUrl":"/frontend/Tropicoblack/ico/MarinerMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MarinerMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20510,
			"launchUrl":"/game/MayanSpiritEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Mayan Spirit",
			"imageUrl":"/frontend/Tropicoblack/ico/MayanSpiritEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MayanSpiritEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20815,
			"launchUrl":"/game/MayaTreasureMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Maya Treasure",
			"imageUrl":"/frontend/Tropicoblack/ico/MayaTreasureMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MayaTreasureMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20391,
			"launchUrl":"/game/MedusaMonstersPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Medusa Monsters",
			"imageUrl":"/frontend/Tropicoblack/ico/MedusaMonstersPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MedusaMonstersPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20439,
			"launchUrl":"/game/MegaCloverEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Mega Clover",
			"imageUrl":"/frontend/Tropicoblack/ico/MegaCloverEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MegaCloverEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19960,
			"launchUrl":"/game/MegaJokerGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Mega Joker",
			"imageUrl":"/frontend/Tropicoblack/ico/MegaJokerGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MegaJokerGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20560,
			"launchUrl":"/game/MegaSlot40CT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Mega Slot 40",
			"imageUrl":"/frontend/Tropicoblack/ico/MegaSlot40CT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MegaSlot40CT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20134,
			"launchUrl":"/game/MermaidsGoldAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Mermaids Gold",
			"imageUrl":"/frontend/Tropicoblack/ico/MermaidsGoldAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MermaidsGoldAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19961,
			"launchUrl":"/game/MermaidsPearlDXGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Mermaids Pearl",
			"imageUrl":"/frontend/Tropicoblack/ico/MermaidsPearlDXGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MermaidsPearlDXGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20091,
			"launchUrl":"/game/MerryFruitsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Merry Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/MerryFruitsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MerryFruitsAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20857,
			"launchUrl":"/game/MiamiBeachWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Miami Beach",
			"imageUrl":"/frontend/Tropicoblack/ico/MiamiBeachWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MiamiBeachWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20622,
			"launchUrl":"/game/MightyDragonGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Mighty Dragon",
			"imageUrl":"/frontend/Tropicoblack/ico/MightyDragonGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MightyDragonGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20577,
			"launchUrl":"/game/MightyRexCT",
			"providerId":"bomba",
			"categoryName":"1059",
			"gameName":"Mighty Rex",
			"imageUrl":"/frontend/Tropicoblack/ico/MightyRexCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MightyRexCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20569,
			"launchUrl":"/game/MiladyX2CT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Milady x2",
			"imageUrl":"/frontend/Tropicoblack/ico/MiladyX2CT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MiladyX2CT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20687,
			"launchUrl":"/game/MingImperialGuardsKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Super Video Poker",
			"imageUrl":"/frontend/Tropicoblack/ico/MingImperialGuardsKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MingImperialGuardsKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20768,
			"launchUrl":"/game/MissKittyAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Miss Kitty",
			"imageUrl":"/frontend/Tropicoblack/ico/MissKittyAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MissKittyAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19962,
			"launchUrl":"/game/MoneyGameDX",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Money Game",
			"imageUrl":"/frontend/Tropicoblack/ico/MoneyGameDX.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MoneyGameDX.jpg",
			"mobileGame": false
		},

				{
			"game_id":20797,
			"launchUrl":"/game/MoneyMN",
			"providerId":"bomba",
			"categoryName":"1060",
			"gameName":"Money",
			"imageUrl":"/frontend/Tropicoblack/ico/MoneyMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MoneyMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20341,
			"launchUrl":"/game/MonkeysDanceVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Monkeys Dance",
			"imageUrl":"/frontend/Tropicoblack/ico/MonkeysDanceVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MonkeysDanceVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20769,
			"launchUrl":"/game/MoonFestivalAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Moon Festival",
			"imageUrl":"/frontend/Tropicoblack/ico/MoonFestivalAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MoonFestivalAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20725,
			"launchUrl":"/game/MrCashbackPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Mr Cashback",
			"imageUrl":"/frontend/Tropicoblack/ico/MrCashbackPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MrCashbackPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20368,
			"launchUrl":"/game/MultiWinAM",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Multi Win",
			"imageUrl":"/frontend/Tropicoblack/ico/MultiWinAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MultiWinAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20369,
			"launchUrl":"/game/MultiWinTripleAM",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Multi Win Triple",
			"imageUrl":"/frontend/Tropicoblack/ico/MultiWinTripleAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MultiWinTripleAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20677,
			"launchUrl":"/game/MuscleCarsKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Muscle Cars",
			"imageUrl":"/frontend/Tropicoblack/ico/MuscleCarsKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MuscleCarsKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":19963,
			"launchUrl":"/game/MysteryStarGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Mystery Star",
			"imageUrl":"/frontend/Tropicoblack/ico/MysteryStarGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MysteryStarGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19964,
			"launchUrl":"/game/MysticSecretsGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Mystic Secrets",
			"imageUrl":"/frontend/Tropicoblack/ico/MysticSecretsGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MysticSecretsGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20786,
			"launchUrl":"/game/NarcosNET",
			"providerId":"bomba",
			"categoryName":"1060",
			"gameName":"Narcos",
			"imageUrl":"/frontend/Tropicoblack/ico/NarcosNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/NarcosNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20586,
			"launchUrl":"/game/NavyGirlCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Navy Girl",
			"imageUrl":"/frontend/Tropicoblack/ico/NavyGirlCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/NavyGirlCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20434,
			"launchUrl":"/game/NeonDiceEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Neon Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/NeonDiceEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/NeonDiceEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20110,
			"launchUrl":"/game/NianNianYouYuPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Nian Nian You Yu",
			"imageUrl":"/frontend/Tropicoblack/ico/NianNianYouYuPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/NianNianYouYuPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20735,
			"launchUrl":"/game/NightOutPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Night Out",
			"imageUrl":"/frontend/Tropicoblack/ico/NightOutPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/NightOutPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20611,
			"launchUrl":"/game/NightWolvesGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Night Wolves",
			"imageUrl":"/frontend/Tropicoblack/ico/NightWolvesGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/NightWolvesGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20658,
			"launchUrl":"/game/NineLucksKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Nine Lucks",
			"imageUrl":"/frontend/Tropicoblack/ico/NineLucksKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/NineLucksKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20795,
			"launchUrl":"/game/OceanKing2MN",
			"providerId":"bomba",
			"categoryName":"1059",
			"gameName":"Ocean King 2",
			"imageUrl":"/frontend/Tropicoblack/ico/OceanKing2MN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/OceanKing2MN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20511,
			"launchUrl":"/game/OceanRushEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Ocean Rush",
			"imageUrl":"/frontend/Tropicoblack/ico/OceanRushEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/OceanRushEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20512,
			"launchUrl":"/game/OilCompanyIIEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Oil Company II",
			"imageUrl":"/frontend/Tropicoblack/ico/OilCompanyIIEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/OilCompanyIIEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20593,
			"launchUrl":"/game/OldFishermanGM",
			"providerId":"bomba",
			"categoryName":"1149",
			"gameName":"Old Fisherman",
			"imageUrl":"/frontend/Tropicoblack/ico/OldFishermanGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/OldFishermanGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20513,
			"launchUrl":"/game/OlympusGloryEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Olympus Glory",
			"imageUrl":"/frontend/Tropicoblack/ico/OlympusGloryEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/OlympusGloryEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19965,
			"launchUrl":"/game/OrcaGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Orca",
			"imageUrl":"/frontend/Tropicoblack/ico/OrcaGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/OrcaGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20666,
			"launchUrl":"/game/OriginOfFireKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Origin Of Fire",
			"imageUrl":"/frontend/Tropicoblack/ico/OriginOfFireKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/OriginOfFireKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20074,
			"launchUrl":"/game/PantherMoonPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Panther Moon",
			"imageUrl":"/frontend/Tropicoblack/ico/PantherMoonPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PantherMoonPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20660,
			"launchUrl":"/game/PartyGirlWaysKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Party Girl Ways",
			"imageUrl":"/frontend/Tropicoblack/ico/PartyGirlWaysKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PartyGirlWaysKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20144,
			"launchUrl":"/game/PartyNightAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Party Night",
			"imageUrl":"/frontend/Tropicoblack/ico/PartyNightAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PartyNightAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20145,
			"launchUrl":"/game/PartyTimeAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Party Time",
			"imageUrl":"/frontend/Tropicoblack/ico/PartyTimeAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PartyTimeAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20410,
			"launchUrl":"/game/PekingLuckPM",
			"providerId":"bomba",
			"categoryName":"1072",
			"gameName":"Peking Luck",
			"imageUrl":"/frontend/Tropicoblack/ico/PekingLuckPM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PekingLuckPM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20770,
			"launchUrl":"/game/PelicanPeteAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Pelican Pete",
			"imageUrl":"/frontend/Tropicoblack/ico/PelicanPeteAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PelicanPeteAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20514,
			"launchUrl":"/game/PenguinStyleEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Penguin Style",
			"imageUrl":"/frontend/Tropicoblack/ico/PenguinStyleEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PenguinStyleEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20807,
			"launchUrl":"/game/Pepper7MN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Pepper 7",
			"imageUrl":"/frontend/Tropicoblack/ico/Pepper7MN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Pepper7MN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20596,
			"launchUrl":"/game/PhantomsMirrorGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Phantoms Mirror",
			"imageUrl":"/frontend/Tropicoblack/ico/PhantomsMirrorGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PhantomsMirrorGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19966,
			"launchUrl":"/game/PharaonsGoldDX",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Pharaons Gold",
			"imageUrl":"/frontend/Tropicoblack/ico/PharaonsGoldDX.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PharaonsGoldDX.jpg",
			"mobileGame": false
		},

				{
			"game_id":20592,
			"launchUrl":"/game/PharaosRichesGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Pharaos Riches",
			"imageUrl":"/frontend/Tropicoblack/ico/PharaosRichesGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PharaosRichesGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20636,
			"launchUrl":"/game/PharaosRichesGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Pharaos Riches Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/PharaosRichesGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PharaosRichesGoldenNightsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20640,
			"launchUrl":"/game/PharaosRichesRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Pharaos Riches Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/PharaosRichesRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PharaosRichesRedHotFirepotGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20652,
			"launchUrl":"/game/PinocchioKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Pinocchio",
			"imageUrl":"/frontend/Tropicoblack/ico/PinocchioKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PinocchioKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20122,
			"launchUrl":"/game/Pirate2IG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Pirate 2",
			"imageUrl":"/frontend/Tropicoblack/ico/Pirate2IG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Pirate2IG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20121,
			"launchUrl":"/game/PirateIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Pirate",
			"imageUrl":"/frontend/Tropicoblack/ico/PirateIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PirateIG.jpg",
			"mobileGame": false
		},

				{
			"game_id":19967,
			"launchUrl":"/game/PlentyOfFruit20GT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Plenty of Fruit 20",
			"imageUrl":"/frontend/Tropicoblack/ico/PlentyOfFruit20GT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PlentyOfFruit20GT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20055,
			"launchUrl":"/game/PlentyOfFruit20HotGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Plenty of Fruit 20 Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/PlentyOfFruit20HotGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PlentyOfFruit20HotGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19968,
			"launchUrl":"/game/PlentyOfFruit40GT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Plenty of Fruit 40",
			"imageUrl":"/frontend/Tropicoblack/ico/PlentyOfFruit40GT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PlentyOfFruit40GT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20056,
			"launchUrl":"/game/PlentyOfJewels20HotGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Plenty of Jewels 20 Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/PlentyOfJewels20HotGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PlentyOfJewels20HotGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20686,
			"launchUrl":"/game/PolynesianKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Polynesian",
			"imageUrl":"/frontend/Tropicoblack/ico/PolynesianKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PolynesianKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20771,
			"launchUrl":"/game/PompeiiAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Pompeii",
			"imageUrl":"/frontend/Tropicoblack/ico/PompeiiAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PompeiiAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20334,
			"launchUrl":"/game/PoseidonsParadiseVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Poseidons Paradise",
			"imageUrl":"/frontend/Tropicoblack/ico/PoseidonsParadiseVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PoseidonsParadiseVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20057,
			"launchUrl":"/game/PowerStarsGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Power Stars",
			"imageUrl":"/frontend/Tropicoblack/ico/PowerStarsGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PowerStarsGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20671,
			"launchUrl":"/game/PrimevalRainforestKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Primeval Rainforest",
			"imageUrl":"/frontend/Tropicoblack/ico/PrimevalRainforestKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PrimevalRainforestKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20726,
			"launchUrl":"/game/PrinceOfOlympusJPPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Prince Of Olympus",
			"imageUrl":"/frontend/Tropicoblack/ico/PrinceOfOlympusJPPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PrinceOfOlympusJPPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20697,
			"launchUrl":"/game/PrincessWenchengKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Princess Wencheng",
			"imageUrl":"/frontend/Tropicoblack/ico/PrincessWenchengKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PrincessWenchengKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20816,
			"launchUrl":"/game/PrisonBreakMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Prison Break",
			"imageUrl":"/frontend/Tropicoblack/ico/PrisonBreakMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PrisonBreakMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20127,
			"launchUrl":"/game/PumpkinFairyIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Pumpkin Fairy",
			"imageUrl":"/frontend/Tropicoblack/ico/PumpkinFairyIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PumpkinFairyIG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20582,
			"launchUrl":"/game/PurpleHot2CT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Purple Hot 2",
			"imageUrl":"/frontend/Tropicoblack/ico/PurpleHot2CT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PurpleHot2CT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20326,
			"launchUrl":"/game/PurpleHotPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Purple Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/PurpleHotPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PurpleHotPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20071,
			"launchUrl":"/game/QueenOfNile",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Queen Of Nile",
			"imageUrl":"/frontend/Tropicoblack/ico/QueenOfNile.jpg",
			"data-src":"/frontend/Tropicoblack/ico/QueenOfNile.jpg",
			"mobileGame": false
		},

				{
			"game_id":20457,
			"launchUrl":"/game/QueenOfRioEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Queen of Rio",
			"imageUrl":"/frontend/Tropicoblack/ico/QueenOfRioEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/QueenOfRioEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20772,
			"launchUrl":"/game/QueenOfTheNileIIAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Queen Of The Nile II",
			"imageUrl":"/frontend/Tropicoblack/ico/QueenOfTheNileIIAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/QueenOfTheNileIIAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20655,
			"launchUrl":"/game/QuickPlayJewelsKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Quick Play Jewels",
			"imageUrl":"/frontend/Tropicoblack/ico/QuickPlayJewelsKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/QuickPlayJewelsKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20830,
			"launchUrl":"/game/RacetrackRichesISB",
			"providerId":"bomba",
			"categoryName":"1062",
			"gameName":"Racetrack Riches",
			"imageUrl":"/frontend/Tropicoblack/ico/RacetrackRichesISB.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RacetrackRichesISB.jpg",
			"mobileGame": false
		},

				{
			"game_id":20515,
			"launchUrl":"/game/RainbowDiceEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Rainbow Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/RainbowDiceEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RainbowDiceEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20516,
			"launchUrl":"/game/RainbowQueenEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Rainbow Queen",
			"imageUrl":"/frontend/Tropicoblack/ico/RainbowQueenEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RainbowQueenEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19969,
			"launchUrl":"/game/Ramses2DXGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Ramses2DX",
			"imageUrl":"/frontend/Tropicoblack/ico/Ramses2DXGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Ramses2DXGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20613,
			"launchUrl":"/game/RamsesBookGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ramses Book",
			"imageUrl":"/frontend/Tropicoblack/ico/RamsesBookGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RamsesBookGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20635,
			"launchUrl":"/game/RamsesBookGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ramses Book Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/RamsesBookGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RamsesBookGoldenNightsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20643,
			"launchUrl":"/game/RamsesBookRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ramses Book Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/RamsesBookRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RamsesBookRedHotFirepotGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20672,
			"launchUrl":"/game/RaritiesKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Rarities",
			"imageUrl":"/frontend/Tropicoblack/ico/RaritiesKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RaritiesKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20095,
			"launchUrl":"/game/RedChilliAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Red Chilli",
			"imageUrl":"/frontend/Tropicoblack/ico/RedChilliAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RedChilliAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19970,
			"launchUrl":"/game/RedHot20GT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Red Hot 20",
			"imageUrl":"/frontend/Tropicoblack/ico/RedHot20GT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RedHot20GT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19981,
			"launchUrl":"/game/RedHot40GT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Red Hot 40",
			"imageUrl":"/frontend/Tropicoblack/ico/RedHot40GT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RedHot40GT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20320,
			"launchUrl":"/game/RedHot7VS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Red Hot 7",
			"imageUrl":"/frontend/Tropicoblack/ico/RedHot7VS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RedHot7VS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20058,
			"launchUrl":"/game/RedHotBurningGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Red Hot Burning",
			"imageUrl":"/frontend/Tropicoblack/ico/RedHotBurningGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RedHotBurningGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19971,
			"launchUrl":"/game/RedHotFruitsGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Red Hot Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/RedHotFruitsGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RedHotFruitsGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20650,
			"launchUrl":"/game/RedRidingHoodKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Red Riding Hood",
			"imageUrl":"/frontend/Tropicoblack/ico/RedRidingHoodKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RedRidingHoodKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20781,
			"launchUrl":"/game/ReelRush2NET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Reel Rush 2",
			"imageUrl":"/frontend/Tropicoblack/ico/ReelRush2NET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ReelRush2NET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20123,
			"launchUrl":"/game/ResidentIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Resident",
			"imageUrl":"/frontend/Tropicoblack/ico/ResidentIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ResidentIG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20459,
			"launchUrl":"/game/RetroStyleEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Retro Style",
			"imageUrl":"/frontend/Tropicoblack/ico/RetroStyleEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RetroStyleEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20517,
			"launchUrl":"/game/RichWorldEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Rich World",
			"imageUrl":"/frontend/Tropicoblack/ico/RichWorldEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RichWorldEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19972,
			"launchUrl":"/game/RingsOfFortuneGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Rings of Fortune",
			"imageUrl":"/frontend/Tropicoblack/ico/RingsOfFortuneGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RingsOfFortuneGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20518,
			"launchUrl":"/game/RiseOfRaEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Rise of Ra",
			"imageUrl":"/frontend/Tropicoblack/ico/RiseOfRaEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RiseOfRaEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20059,
			"launchUrl":"/game/RoaringFortiesGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Roaring Forties",
			"imageUrl":"/frontend/Tropicoblack/ico/RoaringFortiesGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoaringFortiesGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20060,
			"launchUrl":"/game/RoaringWildsGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Roaring Wilds",
			"imageUrl":"/frontend/Tropicoblack/ico/RoaringWildsGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoaringWildsGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20703,
			"launchUrl":"/game/RobotsKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Robots",
			"imageUrl":"/frontend/Tropicoblack/ico/RobotsKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RobotsKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20124,
			"launchUrl":"/game/RockClimberIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Rock Climber",
			"imageUrl":"/frontend/Tropicoblack/ico/RockClimberIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RockClimberIG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20727,
			"launchUrl":"/game/RockyPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Rocky",
			"imageUrl":"/frontend/Tropicoblack/ico/RockyPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RockyPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20433,
			"launchUrl":"/game/RollingDiceEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Rolling Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/RollingDiceEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RollingDiceEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20225,
			"launchUrl":"/game/RomanLegionAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Roman Legion",
			"imageUrl":"/frontend/Tropicoblack/ico/RomanLegionAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RomanLegionAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20729,
			"launchUrl":"/game/RomeAndGloryPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Rome and Glory",
			"imageUrl":"/frontend/Tropicoblack/ico/RomeAndGloryPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RomeAndGloryPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20159,
			"launchUrl":"/game/RouletteClassicPT",
			"providerId":"bomba",
			"categoryName":"1080",
			"gameName":"Roulette Classic",
			"imageUrl":"/frontend/Tropicoblack/ico/RouletteClassicPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RouletteClassicPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20333,
			"launchUrl":"/game/RouletteRoyalAM",
			"providerId":"bomba",
			"categoryName":"1080",
			"gameName":"Roulette Royal",
			"imageUrl":"/frontend/Tropicoblack/ico/RouletteRoyalAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RouletteRoyalAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20698,
			"launchUrl":"/game/Route66KA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Route 66",
			"imageUrl":"/frontend/Tropicoblack/ico/Route66KA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Route66KA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20519,
			"launchUrl":"/game/RouteOfMexicoEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Route of Mexico",
			"imageUrl":"/frontend/Tropicoblack/ico/RouteOfMexicoEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RouteOfMexicoEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20343,
			"launchUrl":"/game/RoyalCrownVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Royal Crown",
			"imageUrl":"/frontend/Tropicoblack/ico/RoyalCrownVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoyalCrownVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20707,
			"launchUrl":"/game/RoyalDemeanorKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Royal Demeanor",
			"imageUrl":"/frontend/Tropicoblack/ico/RoyalDemeanorKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoyalDemeanorKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20520,
			"launchUrl":"/game/RoyalGardensEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Royal Gardens",
			"imageUrl":"/frontend/Tropicoblack/ico/RoyalGardensEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoyalGardensEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20436,
			"launchUrl":"/game/RoyalSecretsEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Royal Secrets",
			"imageUrl":"/frontend/Tropicoblack/ico/RoyalSecretsEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoyalSecretsEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20605,
			"launchUrl":"/game/RoyalSevenGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Royal Seven",
			"imageUrl":"/frontend/Tropicoblack/ico/RoyalSevenGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoyalSevenGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20633,
			"launchUrl":"/game/RoyalSevenGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Royal Seven Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/RoyalSevenGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoyalSevenGoldenNightsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20604,
			"launchUrl":"/game/RoyalSevenXXLGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Royal Seven XXL",
			"imageUrl":"/frontend/Tropicoblack/ico/RoyalSevenXXLGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoyalSevenXXLGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20645,
			"launchUrl":"/game/RoyalSevenXXLRHFPGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Royal Seven XXL RHFP",
			"imageUrl":"/frontend/Tropicoblack/ico/RoyalSevenXXLRHFPGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoyalSevenXXLRHFPGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20184,
			"launchUrl":"/game/RoyalUnicornAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Royal Unicorn",
			"imageUrl":"/frontend/Tropicoblack/ico/RoyalUnicornAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoyalUnicornAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20728,
			"launchUrl":"/game/RulerOfTheSkyJPPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Ruler Of The Sky",
			"imageUrl":"/frontend/Tropicoblack/ico/RulerOfTheSkyJPPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RulerOfTheSkyJPPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20393,
			"launchUrl":"/game/RulersOfOlympusPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Rulers Of Olympus",
			"imageUrl":"/frontend/Tropicoblack/ico/RulersOfOlympusPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RulersOfOlympusPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20068,
			"launchUrl":"/game/RumpelWildspinsGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Rumpel Wildspins",
			"imageUrl":"/frontend/Tropicoblack/ico/RumpelWildspinsGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RumpelWildspinsGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20077,
			"launchUrl":"/game/SafariHeatPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Safari Heat",
			"imageUrl":"/frontend/Tropicoblack/ico/SafariHeatPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SafariHeatPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20216,
			"launchUrl":"/game/SakuraFruitsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Sakura Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/SakuraFruitsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SakuraFruitsAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20714,
			"launchUrl":"/game/SakuraSecretAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Sakura Secret",
			"imageUrl":"/frontend/Tropicoblack/ico/SakuraSecretAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SakuraSecretAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20827,
			"launchUrl":"/game/SalemCovenMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Salem Coven",
			"imageUrl":"/frontend/Tropicoblack/ico/SalemCovenMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SalemCovenMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20328,
			"launchUrl":"/game/SantaSurprisePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Santa Surprise",
			"imageUrl":"/frontend/Tropicoblack/ico/SantaSurprisePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SantaSurprisePT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20589,
			"launchUrl":"/game/SavannaMoonGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Savanna Moon",
			"imageUrl":"/frontend/Tropicoblack/ico/SavannaMoonGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SavannaMoonGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20804,
			"launchUrl":"/game/SavannaQueenMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Savanna Queen",
			"imageUrl":"/frontend/Tropicoblack/ico/SavannaQueenMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SavannaQueenMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20521,
			"launchUrl":"/game/SavannasLifeEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Savannas Life",
			"imageUrl":"/frontend/Tropicoblack/ico/SavannasLifeEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SavannasLifeEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19973,
			"launchUrl":"/game/SeaSirensGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Sea Sirens",
			"imageUrl":"/frontend/Tropicoblack/ico/SeaSirensGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SeaSirensGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20522,
			"launchUrl":"/game/SecretOfAlchemyEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Secret of Alchemy",
			"imageUrl":"/frontend/Tropicoblack/ico/SecretOfAlchemyEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SecretOfAlchemyEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20523,
			"launchUrl":"/game/SecretsOfLondonEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Secrets of London",
			"imageUrl":"/frontend/Tropicoblack/ico/SecretsOfLondonEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SecretsOfLondonEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20829,
			"launchUrl":"/game/SheriffOfNotinghamISB",
			"providerId":"bomba",
			"categoryName":"1062",
			"gameName":"Sheriff Of Notingham",
			"imageUrl":"/frontend/Tropicoblack/ico/SheriffOfNotinghamISB.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SheriffOfNotinghamISB.jpg",
			"mobileGame": false
		},

				{
			"game_id":20730,
			"launchUrl":"/game/SherlockMysteryPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Sherlock Mystery",
			"imageUrl":"/frontend/Tropicoblack/ico/SherlockMysteryPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SherlockMysteryPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20443,
			"launchUrl":"/game/ShiningCrownEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Shining Crown",
			"imageUrl":"/frontend/Tropicoblack/ico/ShiningCrownEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ShiningCrownEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20580,
			"launchUrl":"/game/ShiningJewels40CT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Shining Jewels 40",
			"imageUrl":"/frontend/Tropicoblack/ico/ShiningJewels40CT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ShiningJewels40CT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20579,
			"launchUrl":"/game/ShiningTreasuresCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Shining Treasures",
			"imageUrl":"/frontend/Tropicoblack/ico/ShiningTreasuresCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ShiningTreasuresCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20676,
			"launchUrl":"/game/ShoppingFiendKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Shopping Fiend",
			"imageUrl":"/frontend/Tropicoblack/ico/ShoppingFiendKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ShoppingFiendKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20731,
			"launchUrl":"/game/SilentSamuraiPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Silent Samurai",
			"imageUrl":"/frontend/Tropicoblack/ico/SilentSamuraiPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SilentSamuraiPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20773,
			"launchUrl":"/game/SilkRoadAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Silk Road",
			"imageUrl":"/frontend/Tropicoblack/ico/SilkRoadAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SilkRoadAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20732,
			"launchUrl":"/game/SilverBulletPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Silver Bullet",
			"imageUrl":"/frontend/Tropicoblack/ico/SilverBulletPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SilverBulletPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19974,
			"launchUrl":"/game/SilverFoxDX",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Silver Fox",
			"imageUrl":"/frontend/Tropicoblack/ico/SilverFoxDX.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SilverFoxDX.jpg",
			"mobileGame": false
		},

				{
			"game_id":20606,
			"launchUrl":"/game/SimplyTheBestGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Simply the Best",
			"imageUrl":"/frontend/Tropicoblack/ico/SimplyTheBestGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SimplyTheBestGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20362,
			"launchUrl":"/game/SinbadsGoldenVoyagePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Sinbads Golden Voyage",
			"imageUrl":"/frontend/Tropicoblack/ico/SinbadsGoldenVoyagePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SinbadsGoldenVoyagePT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19982,
			"launchUrl":"/game/Sizzling6GT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Sizzling 6",
			"imageUrl":"/frontend/Tropicoblack/ico/Sizzling6GT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Sizzling6GT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20856,
			"launchUrl":"/game/Sizzling777WD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Sizzling 777",
			"imageUrl":"/frontend/Tropicoblack/ico/Sizzling777WD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Sizzling777WD.jpg",
			"mobileGame": false
		},

				{
			"game_id":19975,
			"launchUrl":"/game/SizzlingGems",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Sizzling Gems",
			"imageUrl":"/frontend/Tropicoblack/ico/SizzlingGems.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SizzlingGems.jpg",
			"mobileGame": false
		},

				{
			"game_id":19976,
			"launchUrl":"/game/SizzlingHotDX",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Sizzling Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/SizzlingHotDX.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SizzlingHotDX.jpg",
			"mobileGame": false
		},

				{
			"game_id":20653,
			"launchUrl":"/game/SnowLeopardsKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Snow Leopards",
			"imageUrl":"/frontend/Tropicoblack/ico/SnowLeopardsKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SnowLeopardsKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20801,
			"launchUrl":"/game/SnowWhiteMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Snow White",
			"imageUrl":"/frontend/Tropicoblack/ico/SnowWhiteMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SnowWhiteMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20549,
			"launchUrl":"/game/SpaceWarsNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Space Wars",
			"imageUrl":"/frontend/Tropicoblack/ico/SpaceWarsNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SpaceWarsNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20524,
			"launchUrl":"/game/SpanishPassionsEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Spanish Passions",
			"imageUrl":"/frontend/Tropicoblack/ico/SpanishPassionsEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SpanishPassionsEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20681,
			"launchUrl":"/game/SpeakEasyKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Speak Easy",
			"imageUrl":"/frontend/Tropicoblack/ico/SpeakEasyKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SpeakEasyKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20525,
			"launchUrl":"/game/SpicyDiceEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Spicy Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/SpicyDiceEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SpicyDiceEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20526,
			"launchUrl":"/game/SpicyFruitsEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Spicy Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/SpicyFruitsEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SpicyFruitsEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20838,
			"launchUrl":"/game/StacksOGoldISB",
			"providerId":"bomba",
			"categoryName":"1062",
			"gameName":"Stacks O Gold",
			"imageUrl":"/frontend/Tropicoblack/ico/StacksOGoldISB.jpg",
			"data-src":"/frontend/Tropicoblack/ico/StacksOGoldISB.jpg",
			"mobileGame": false
		},

				{
			"game_id":20551,
			"launchUrl":"/game/StarBurstNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Star Burst",
			"imageUrl":"/frontend/Tropicoblack/ico/StarBurstNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/StarBurstNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20352,
			"launchUrl":"/game/StarFruitsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Star Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/StarFruitsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/StarFruitsVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20581,
			"launchUrl":"/game/StarPartyCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Star Party",
			"imageUrl":"/frontend/Tropicoblack/ico/StarPartyCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/StarPartyCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20696,
			"launchUrl":"/game/StockedBarKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Stocked Bar",
			"imageUrl":"/frontend/Tropicoblack/ico/StockedBarKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/StockedBarKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20664,
			"launchUrl":"/game/StonehengeKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Stonehenge",
			"imageUrl":"/frontend/Tropicoblack/ico/StonehengeKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/StonehengeKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20527,
			"launchUrl":"/game/StoryOfAlexandrEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Story of Alexandr",
			"imageUrl":"/frontend/Tropicoblack/ico/StoryOfAlexandrEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/StoryOfAlexandrEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20799,
			"launchUrl":"/game/StoryOfTheSphinxMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Story Of The Sphinx",
			"imageUrl":"/frontend/Tropicoblack/ico/StoryOfTheSphinxMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/StoryOfTheSphinxMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20528,
			"launchUrl":"/game/SummerBlissEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Summer Bliss",
			"imageUrl":"/frontend/Tropicoblack/ico/SummerBlissEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SummerBlissEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20774,
			"launchUrl":"/game/SunAndMoonAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Sun And Moon",
			"imageUrl":"/frontend/Tropicoblack/ico/SunAndMoonAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SunAndMoonAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20322,
			"launchUrl":"/game/SunWukongPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Sun Wukong",
			"imageUrl":"/frontend/Tropicoblack/ico/SunWukongPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SunWukongPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20401,
			"launchUrl":"/game/Super20EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Super 20",
			"imageUrl":"/frontend/Tropicoblack/ico/Super20EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Super20EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20798,
			"launchUrl":"/game/SuperBallKenoIB",
			"providerId":"bomba",
			"categoryName":"1078",
			"gameName":"Super Ball Keno",
			"imageUrl":"/frontend/Tropicoblack/ico/SuperBallKenoIB.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SuperBallKenoIB.jpg",
			"mobileGame": false
		},

				{
			"game_id":20421,
			"launchUrl":"/game/SuperDice100EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Super Dice 100",
			"imageUrl":"/frontend/Tropicoblack/ico/SuperDice100EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SuperDice100EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20419,
			"launchUrl":"/game/SuperDice20EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Super Dice 20",
			"imageUrl":"/frontend/Tropicoblack/ico/SuperDice20EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SuperDice20EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20420,
			"launchUrl":"/game/SuperDice40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Super Dice 40",
			"imageUrl":"/frontend/Tropicoblack/ico/SuperDice40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SuperDice40EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20610,
			"launchUrl":"/game/SuperDuperCherryGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Super Duper Cherry",
			"imageUrl":"/frontend/Tropicoblack/ico/SuperDuperCherryGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SuperDuperCherryGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20647,
			"launchUrl":"/game/SuperDuperCherryRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Super Duper Cherry Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/SuperDuperCherryRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SuperDuperCherryRedHotFirepotGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20609,
			"launchUrl":"/game/SuperDuperMoorhuhnGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Super Duper Moorhuhn",
			"imageUrl":"/frontend/Tropicoblack/ico/SuperDuperMoorhuhnGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SuperDuperMoorhuhnGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20413,
			"launchUrl":"/game/SuperHot100EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Super Hot 100",
			"imageUrl":"/frontend/Tropicoblack/ico/SuperHot100EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SuperHot100EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20414,
			"launchUrl":"/game/SuperHot20EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Super Hot 20",
			"imageUrl":"/frontend/Tropicoblack/ico/SuperHot20EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SuperHot20EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20412,
			"launchUrl":"/game/SuperHot40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Super Hot 40",
			"imageUrl":"/frontend/Tropicoblack/ico/SuperHot40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SuperHot40EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20194,
			"launchUrl":"/game/SuperHotWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Super Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/SuperHotWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SuperHotWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20445,
			"launchUrl":"/game/SupremeDiceEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Supreme Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/SupremeDiceEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SupremeDiceEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20450,
			"launchUrl":"/game/SupremeHotEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Supreme Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/SupremeHotEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SupremeHotEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20819,
			"launchUrl":"/game/SwampLand2MN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Swamp Land 2",
			"imageUrl":"/frontend/Tropicoblack/ico/SwampLand2MN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SwampLand2MN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20818,
			"launchUrl":"/game/SwampLandHDMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Swamp Land HD",
			"imageUrl":"/frontend/Tropicoblack/ico/SwampLandHDMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SwampLandHDMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20529,
			"launchUrl":"/game/SweetCheeseEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Sweet Cheese",
			"imageUrl":"/frontend/Tropicoblack/ico/SweetCheeseEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SweetCheeseEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20116,
			"launchUrl":"/game/SweetLife2IG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Sweet Life 2",
			"imageUrl":"/frontend/Tropicoblack/ico/SweetLife2IG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SweetLife2IG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20115,
			"launchUrl":"/game/SweetLifeIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Sweet Life",
			"imageUrl":"/frontend/Tropicoblack/ico/SweetLifeIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SweetLifeIG.jpg",
			"mobileGame": false
		},

				{
			"game_id":20061,
			"launchUrl":"/game/TempleOfSecretsGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Temple of Secrets",
			"imageUrl":"/frontend/Tropicoblack/ico/TempleOfSecretsGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TempleOfSecretsGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20375,
			"launchUrl":"/game/TensOrBetterAM",
			"providerId":"bomba",
			"categoryName":"1144",
			"gameName":"Tens Or Better",
			"imageUrl":"/frontend/Tropicoblack/ico/TensOrBetterAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TensOrBetterAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20733,
			"launchUrl":"/game/ThaiParadisePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Thai Paradise",
			"imageUrl":"/frontend/Tropicoblack/ico/ThaiParadisePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ThaiParadisePT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20682,
			"launchUrl":"/game/TheApesKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"The Apes",
			"imageUrl":"/frontend/Tropicoblack/ico/TheApesKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheApesKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20608,
			"launchUrl":"/game/TheExpandableGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"The Expandable",
			"imageUrl":"/frontend/Tropicoblack/ico/TheExpandableGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheExpandableGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20530,
			"launchUrl":"/game/TheExplorersEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"The Explorers",
			"imageUrl":"/frontend/Tropicoblack/ico/TheExplorersEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheExplorersEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20836,
			"launchUrl":"/game/TheGoldenCityISB",
			"providerId":"bomba",
			"categoryName":"1062",
			"gameName":"The Golden City",
			"imageUrl":"/frontend/Tropicoblack/ico/TheGoldenCityISB.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheGoldenCityISB.jpg",
			"mobileGame": false
		},

				{
			"game_id":20651,
			"launchUrl":"/game/TheKingOfDinosaursKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"The King Of Dinosaurs",
			"imageUrl":"/frontend/Tropicoblack/ico/TheKingOfDinosaursKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheKingOfDinosaursKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20626,
			"launchUrl":"/game/TheLandOfHeroesGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"The Land Of Heroes",
			"imageUrl":"/frontend/Tropicoblack/ico/TheLandOfHeroesGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheLandOfHeroesGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20628,
			"launchUrl":"/game/TheLandOfHeroesGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"The Land Of Heroes Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/TheLandOfHeroesGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheLandOfHeroesGoldenNightsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20591,
			"launchUrl":"/game/TheMightyKingGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"The Mighty King",
			"imageUrl":"/frontend/Tropicoblack/ico/TheMightyKingGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheMightyKingGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20670,
			"launchUrl":"/game/TheNutCrackerKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"The Nut Cracker",
			"imageUrl":"/frontend/Tropicoblack/ico/TheNutCrackerKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheNutCrackerKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20822,
			"launchUrl":"/game/TheWizardOfOZMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"The WizardOf OZ",
			"imageUrl":"/frontend/Tropicoblack/ico/TheWizardOfOZMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheWizardOfOZMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20782,
			"launchUrl":"/game/TheWolfsBaneNET",
			"providerId":"bomba",
			"categoryName":"1060",
			"gameName":"The Wolfs Bane",
			"imageUrl":"/frontend/Tropicoblack/ico/TheWolfsBaneNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheWolfsBaneNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20340,
			"launchUrl":"/game/ThorVictoryVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Thor Victory",
			"imageUrl":"/frontend/Tropicoblack/ico/ThorVictoryVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ThorVictoryVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20383,
			"launchUrl":"/game/TigerClawPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Tiger Claw",
			"imageUrl":"/frontend/Tropicoblack/ico/TigerClawPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TigerClawPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20775,
			"launchUrl":"/game/TikiTorchAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Tiki Torch",
			"imageUrl":"/frontend/Tropicoblack/ico/TikiTorchAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TikiTorchAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20572,
			"launchUrl":"/game/Treasure40CT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Treasure 40",
			"imageUrl":"/frontend/Tropicoblack/ico/Treasure40CT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Treasure40CT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20571,
			"launchUrl":"/game/TreasureHillCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Treasure Hill",
			"imageUrl":"/frontend/Tropicoblack/ico/TreasureHillCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TreasureHillCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20826,
			"launchUrl":"/game/TreasureIslandMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Treasure Island",
			"imageUrl":"/frontend/Tropicoblack/ico/TreasureIslandMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TreasureIslandMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20585,
			"launchUrl":"/game/TreasureKingdomCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Treasure Kingdom",
			"imageUrl":"/frontend/Tropicoblack/ico/TreasureKingdomCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TreasureKingdomCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20654,
			"launchUrl":"/game/TripleDragonsKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Triple Dragons",
			"imageUrl":"/frontend/Tropicoblack/ico/TripleDragonsKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TripleDragonsKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20066,
			"launchUrl":"/game/TripleMonkey",
			"providerId":"bomba",
			"categoryName":"1059",
			"gameName":"Triple Monkey",
			"imageUrl":"/frontend/Tropicoblack/ico/TripleMonkey.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TripleMonkey.jpg",
			"mobileGame": false
		},

				{
			"game_id":20792,
			"launchUrl":"/game/TropicalVacationKenoGV",
			"providerId":"bomba",
			"categoryName":"1078",
			"gameName":"Tropical Vacation Keno",
			"imageUrl":"/frontend/Tropicoblack/ico/TropicalVacationKenoGV.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TropicalVacationKenoGV.jpg",
			"mobileGame": false
		},

				{
			"game_id":20734,
			"launchUrl":"/game/TrueLovePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"True Love",
			"imageUrl":"/frontend/Tropicoblack/ico/TrueLovePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TrueLovePT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20784,
			"launchUrl":"/game/TurnYourFortuneNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Turn Your Fortune",
			"imageUrl":"/frontend/Tropicoblack/ico/TurnYourFortuneNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TurnYourFortuneNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20097,
			"launchUrl":"/game/TweetyBirdsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Tweety Birds",
			"imageUrl":"/frontend/Tropicoblack/ico/TweetyBirdsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TweetyBirdsAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20460,
			"launchUrl":"/game/TwoDragonsEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Two Dragons",
			"imageUrl":"/frontend/Tropicoblack/ico/TwoDragonsEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TwoDragonsEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":19977,
			"launchUrl":"/game/TwoSevensGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Two Sevens",
			"imageUrl":"/frontend/Tropicoblack/ico/TwoSevensGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TwoSevensGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20417,
			"launchUrl":"/game/UltimateHotEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Ultimate Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/UltimateHotEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/UltimateHotEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20083,
			"launchUrl":"/game/Ultra7AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Ultra 7",
			"imageUrl":"/frontend/Tropicoblack/ico/Ultra7AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Ultra7AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":19978,
			"launchUrl":"/game/UltraHotDXGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Ultra Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/UltraHotDXGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/UltraHotDXGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20062,
			"launchUrl":"/game/UltraSevensGT",
			"providerId":"bomba",
			"categoryName":"1068",
			"gameName":"Ultra Sevens",
			"imageUrl":"/frontend/Tropicoblack/ico/UltraSevensGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/UltraSevensGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20197,
			"launchUrl":"/game/VacationStationDeluxePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Vacation Station Deluxe",
			"imageUrl":"/frontend/Tropicoblack/ico/VacationStationDeluxePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/VacationStationDeluxePT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20385,
			"launchUrl":"/game/VacationStationPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Vacation Station",
			"imageUrl":"/frontend/Tropicoblack/ico/VacationStationPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/VacationStationPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20717,
			"launchUrl":"/game/VampireNightEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Vampire Night",
			"imageUrl":"/frontend/Tropicoblack/ico/VampireNightEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/VampireNightEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20217,
			"launchUrl":"/game/VampiresAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Vampires",
			"imageUrl":"/frontend/Tropicoblack/ico/VampiresAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/VampiresAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20657,
			"launchUrl":"/game/Vegas777KA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Vegas 777",
			"imageUrl":"/frontend/Tropicoblack/ico/Vegas777KA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Vegas777KA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20870,
			"launchUrl":"/game/VegasHotWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Vegas Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/VegasHotWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/VegasHotWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20532,
			"launchUrl":"/game/VeneziaDoroEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Venezia Doro",
			"imageUrl":"/frontend/Tropicoblack/ico/VeneziaDoroEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/VeneziaDoroEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20533,
			"launchUrl":"/game/VersaillesGoldEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Versailles Gold",
			"imageUrl":"/frontend/Tropicoblack/ico/VersaillesGoldEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/VersaillesGoldEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20813,
			"launchUrl":"/game/VikingAxeMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Viking Axe",
			"imageUrl":"/frontend/Tropicoblack/ico/VikingAxeMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/VikingAxeMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20787,
			"launchUrl":"/game/VikingsNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Vikings",
			"imageUrl":"/frontend/Tropicoblack/ico/VikingsNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/VikingsNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20722,
			"launchUrl":"/game/VirtualRouletteEGT",
			"providerId":"bomba",
			"categoryName":"1080",
			"gameName":"Virtual Roulette",
			"imageUrl":"/frontend/Tropicoblack/ico/VirtualRouletteEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/VirtualRouletteEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20719,
			"launchUrl":"/game/VolcanoWealthEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Volcano Wealth",
			"imageUrl":"/frontend/Tropicoblack/ico/VolcanoWealthEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/VolcanoWealthEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20321,
			"launchUrl":"/game/WantedBulletsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Wanted Bullets",
			"imageUrl":"/frontend/Tropicoblack/ico/WantedBulletsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WantedBulletsVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20395,
			"launchUrl":"/game/WaysOfPhoenixPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Ways Of Phoenix",
			"imageUrl":"/frontend/Tropicoblack/ico/WaysOfPhoenixPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WaysOfPhoenixPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20776,
			"launchUrl":"/game/WerewolfWildAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Werewolf Wild",
			"imageUrl":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20564,
			"launchUrl":"/game/WetAndJuicyCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Wet and Juicy",
			"imageUrl":"/frontend/Tropicoblack/ico/WetAndJuicyCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WetAndJuicyCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20737,
			"launchUrl":"/game/WhiteKingPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"White King",
			"imageUrl":"/frontend/Tropicoblack/ico/WhiteKingPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WhiteKingPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20461,
			"launchUrl":"/game/WhiteWolfEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"White Wolf",
			"imageUrl":"/frontend/Tropicoblack/ico/WhiteWolfEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WhiteWolfEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20085,
			"launchUrl":"/game/Wild7AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Wild 7",
			"imageUrl":"/frontend/Tropicoblack/ico/Wild7AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Wild7AM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20839,
			"launchUrl":"/game/WildApeISB",
			"providerId":"bomba",
			"categoryName":"1062",
			"gameName":"Wild Ape",
			"imageUrl":"/frontend/Tropicoblack/ico/WildApeISB.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildApeISB.jpg",
			"mobileGame": false
		},

				{
			"game_id":20738,
			"launchUrl":"/game/WildBeatsPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Wild Beats",
			"imageUrl":"/frontend/Tropicoblack/ico/WildBeatsPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildBeatsPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20578,
			"launchUrl":"/game/WildCloverCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Wild Clover",
			"imageUrl":"/frontend/Tropicoblack/ico/WildCloverCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildCloverCT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20376,
			"launchUrl":"/game/WildDiamondsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Wild Diamonds",
			"imageUrl":"/frontend/Tropicoblack/ico/WildDiamondsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildDiamondsAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20129,
			"launchUrl":"/game/WildDragonAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Wild Dragon",
			"imageUrl":"/frontend/Tropicoblack/ico/WildDragonAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildDragonAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20860,
			"launchUrl":"/game/WildGunsWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Wild Guns",
			"imageUrl":"/frontend/Tropicoblack/ico/WildGunsWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildGunsWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20871,
			"launchUrl":"/game/WildJackWD",
			"providerId":"bomba",
			"categoryName":"1076",
			"gameName":"Wild Jack",
			"imageUrl":"/frontend/Tropicoblack/ico/WildJackWD.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildJackWD.jpg",
			"mobileGame": false
		},

				{
			"game_id":20621,
			"launchUrl":"/game/WildRapaNuiGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Wild Rapa Nui",
			"imageUrl":"/frontend/Tropicoblack/ico/WildRapaNuiGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildRapaNuiGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20222,
			"launchUrl":"/game/WildRespinAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Wild Respin",
			"imageUrl":"/frontend/Tropicoblack/ico/WildRespinAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildRespinAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20601,
			"launchUrl":"/game/WildRubiesGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Wild Rubies",
			"imageUrl":"/frontend/Tropicoblack/ico/WildRubiesGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildRubiesGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20629,
			"launchUrl":"/game/WildRubiesGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Wild Rubies Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/WildRubiesGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildRubiesGoldenNightsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20603,
			"launchUrl":"/game/WildsGoneWildGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Wilds Gone Wild",
			"imageUrl":"/frontend/Tropicoblack/ico/WildsGoneWildGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildsGoneWildGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20132,
			"launchUrl":"/game/WildSharkAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Wild Shark",
			"imageUrl":"/frontend/Tropicoblack/ico/WildSharkAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildSharkAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20777,
			"launchUrl":"/game/WildSplashAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Wild Splash",
			"imageUrl":"/frontend/Tropicoblack/ico/WildSplashAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildSplashAT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20223,
			"launchUrl":"/game/WildStarsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Wild Stars",
			"imageUrl":"/frontend/Tropicoblack/ico/WildStarsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildStarsAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20550,
			"launchUrl":"/game/WildWaterNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Wild Water",
			"imageUrl":"/frontend/Tropicoblack/ico/WildWaterNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildWaterNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20780,
			"launchUrl":"/game/WingsOfRichesNET",
			"providerId":"bomba",
			"categoryName":"1060",
			"gameName":"Wings Of Riches",
			"imageUrl":"/frontend/Tropicoblack/ico/WingsOfRichesNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WingsOfRichesNET.jpg",
			"mobileGame": false
		},

				{
			"game_id":20531,
			"launchUrl":"/game/Wins27EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Wins 27",
			"imageUrl":"/frontend/Tropicoblack/ico/Wins27EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Wins27EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20346,
			"launchUrl":"/game/Wins4VS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Wins 4",
			"imageUrl":"/frontend/Tropicoblack/ico/Wins4VS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Wins4VS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20446,
			"launchUrl":"/game/Wins81EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Wins 81",
			"imageUrl":"/frontend/Tropicoblack/ico/Wins81EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Wins81EGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20534,
			"launchUrl":"/game/WitchesCharmEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Witches Charm",
			"imageUrl":"/frontend/Tropicoblack/ico/WitchesCharmEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WitchesCharmEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20101,
			"launchUrl":"/game/WolfMoonAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Wolf Moon",
			"imageUrl":"/frontend/Tropicoblack/ico/WolfMoonAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WolfMoonAM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20820,
			"launchUrl":"/game/WolfVSHareMN",
			"providerId":"bomba",
			"categoryName":"1074",
			"gameName":"Wolf vs Hare",
			"imageUrl":"/frontend/Tropicoblack/ico/WolfVSHareMN.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WolfVSHareMN.jpg",
			"mobileGame": false
		},

				{
			"game_id":20535,
			"launchUrl":"/game/WonderHeartEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Wonder Heart",
			"imageUrl":"/frontend/Tropicoblack/ico/WonderHeartEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WonderHeartEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20456,
			"launchUrl":"/game/WonderTreeEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Wonder Tree",
			"imageUrl":"/frontend/Tropicoblack/ico/WonderTreeEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WonderTreeEGT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20349,
			"launchUrl":"/game/WormVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Worm",
			"imageUrl":"/frontend/Tropicoblack/ico/WormVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WormVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20736,
			"launchUrl":"/game/WuLongPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Wu Long",
			"imageUrl":"/frontend/Tropicoblack/ico/WuLongPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WuLongPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20678,
			"launchUrl":"/game/XElementsKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"X Elements",
			"imageUrl":"/frontend/Tropicoblack/ico/XElementsKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/XElementsKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20624,
			"launchUrl":"/game/XplodingPumpkinsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Xploding Pumpkins",
			"imageUrl":"/frontend/Tropicoblack/ico/XplodingPumpkinsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/XplodingPumpkinsGM.jpg",
			"mobileGame": false
		},

				{
			"game_id":20345,
			"launchUrl":"/game/XXXReelsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"XXX Reels",
			"imageUrl":"/frontend/Tropicoblack/ico/XXXReelsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/XXXReelsVS.jpg",
			"mobileGame": false
		},

				{
			"game_id":20663,
			"launchUrl":"/game/YuGongKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"Yu Gong",
			"imageUrl":"/frontend/Tropicoblack/ico/YuGongKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/YuGongKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20659,
			"launchUrl":"/game/YunCaiTongZiKA",
			"providerId":"bomba",
			"categoryName":"1075",
			"gameName":"YunCai Tong Zi",
			"imageUrl":"/frontend/Tropicoblack/ico/YunCaiTongZiKA.jpg",
			"data-src":"/frontend/Tropicoblack/ico/YunCaiTongZiKA.jpg",
			"mobileGame": false
		},

				{
			"game_id":20195,
			"launchUrl":"/game/YunCongLongPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Yun Cong Long",
			"imageUrl":"/frontend/Tropicoblack/ico/YunCongLongPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/YunCongLongPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20153,
			"launchUrl":"/game/ZhaoCaiJinBaoJPPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Zhao Cai Jin Bao JP",
			"imageUrl":"/frontend/Tropicoblack/ico/ZhaoCaiJinBaoJPPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ZhaoCaiJinBaoJPPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20151,
			"launchUrl":"/game/ZhaoCaiJinBaoPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Zhao Cai Jin Bao",
			"imageUrl":"/frontend/Tropicoblack/ico/ZhaoCaiJinBaoPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ZhaoCaiJinBaoPT.jpg",
			"mobileGame": false
		},

				{
			"game_id":20444,
			"launchUrl":"/game/ZodiacWheelEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Zodiac Wheel",
			"imageUrl":"/frontend/Tropicoblack/ico/ZodiacWheelEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ZodiacWheelEGT.jpg",
			"mobileGame": false
		},

		
	];

                            var GLOBAL_BANNERS_LIST = {
            slide1: "/frontend/Tropicoblack/assets/images/slides/1.jpg",
            slide2: "/frontend/Tropicoblack/assets/images/slides/2.jpg",
            slide3: "/frontend/Tropicoblack/assets/images/slides/3b.jpg",
            slide4: "/frontend/Tropicoblack/assets/images/slides/4.jpg",
            slide5: "/frontend/Tropicoblack/assets/images/slides/5.jpg",
            slide6: "/frontend/Tropicoblack/assets/images/slides/6.jpg",
            slide7: "/frontend/Tropicoblack/assets/images/slides/7.jpg",
            slide8: "/frontend/Tropicoblack/assets/images/slides/8.jpg",
            slide9: "/frontend/Tropicoblack/assets/images/slides/9.jpg",
            slide10: "/frontend/Tropicoblack/assets/images/slides/10.jpg",
            slide11: "/frontend/Tropicoblack/assets/images/slides/11.jpg"
        };


</script><!-- END MAIN MENU -->

    <div class="container-fluid p-0 mt-2 mb-5">
        <div id="mainContent" class="text-center row m-0"></div>
    </div>

    <!-- FOOTER-->
    <footer>
    <div class="row m-0">
        <div class="col-12 col-md-3 p-0 border-container">
            <h5 class="text-center p-2">&nbsp;</h5>
            <div class="container text-center">
                <img src="/frontend/Tropicoblack/assets/images/ui/devices.png" alt="" class="w-50 mb-1"/>
                <br/>
                <h6>Now available on all devices</h6>
                <h6>Desktop - Tablet - Mobile</h6>
            </div>
            <div class="container">
                <p class="text-justify">
                    For best performance please make sure you have the latest version of Google Chrome.
                </p>
            </div>
            <div class="container">
                <p class="text-justify">
                    All graphic material contained on the website including logos, text, sound, videos, design, photographs are subject to copyright and may not be distributed without explicit written consent of the Casino.
                </p>
            </div>
        </div>
        <div class="col-12 col-md-3 p-0 border-container">
            <h5 class="text-center p-2">Play Safe</h5>
            <div class="container text-center">
                <img src="/frontend/Tropicoblack/assets/images/ui/secure_website.png" alt="" class="w-50 mb-1"/>
                <p class="text-justify">
                    The the Online Casino has a legal permission to conduct online gambling on the basis of the international License.
                    <br/>
                    We understand that ensuring the fair game is one of the most important conditions for the casino operation.
                    <br/>
                    Therefore, we offer you only games from reliable and long proven certified suppliers.
                    <br/>
                    We approach to Responsible Gaming and Player Protection.
                </p>
            </div>
        </div>
        <div class="col-12 col-md-2 p-0 border-container">
            <h5 class="text-center p-2">Game Providers</h5>
            <div class="container">
                <div class="row m-0">
                    <div class="col-6 col-md-12 p-0 text-center">
                        <a href="#">
                            <img src="/frontend/Tropicoblack/assets/images/vendors/shadow/q1x2gaming.png" alt="q1x2gaming"
                                 style="max-width: 100px;"/>
                        </a>
                    </div>
                    <div class="col-6 col-md-12 p-0 text-center">
                        <a href="#">
                            <img src="/frontend/Tropicoblack/assets/images/vendors/shadow/amatic.png" alt="amatic"
                                 style="max-width: 100px;"/>
                        </a>
                    </div>
                    <div class="col-6 col-md-12 p-0 text-center">
                        <a href="#">
                            <img src="/frontend/Tropicoblack/assets/images/vendors/shadow/bomba.png" alt="bomba"
                                 style="max-width: 100px;"/>
                        </a>
                    </div>
                    <div class="col-6 col-md-12 p-0 text-center">
                        <a href="#">
                            <img src="/frontend/Tropicoblack/assets/images/vendors/shadow/egt.png" alt="egt" style="max-width: 100px;"/>
                        </a>
                    </div>
                    <div class="col-6 col-md-12 p-0 text-center">
                        <a href="#">
                            <img src="/frontend/Tropicoblack/assets/images/vendors/shadow/netent.png" alt="netent"
                                 style="max-width: 100px;"/>
                        </a>
                    </div>
                    <div class="col-6 col-md-12 p-0 text-center">
                        <a href="#">
                            <img src="/frontend/Tropicoblack/assets/images/vendors/shadow/novomatic.png" alt="novomatic"
                                 style="max-width: 100px;"/>
                        </a>
                    </div>
                    <div class="col-6 col-md-12 p-0 text-center">
                        <a href="#">
                            <img src="/frontend/Tropicoblack/assets/images/vendors/shadow/spin2win.png" alt="spin2win"
                                 style="max-width: 100px;"/>
                        </a>
                    </div>
                    <div class="col-6 col-md-12 p-0 text-center">
                        <a href="#">
                            <img src="/frontend/Tropicoblack/assets/images/vendors/shadow/wazdan.png" alt="wazdan"
                                 style="max-width: 100px;"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2 p-0 border-container">
            <h5 class="text-center p-2">
               Social Media
            </h5>
            <div class="container text-center">
                <h6>Follow Us On ...</h6>
            </div>
            <div class="row m-0">
                <div class="col-6 p-0 text-center">
                    <a href="#">
                        <img src="/frontend/Tropicoblack/assets/images/ui/facebook.png" alt="facebook" class="p-2"
                             style="max-width: 64px;"/>
                    </a>
                </div>
                <div class="col-6 p-0 text-center">
                    <a href="#">
                        <img src="/frontend/Tropicoblack/assets/images/ui/twitter.png" alt="twitter" class="p-2"
                             style="max-width: 64px;"/>
                    </a>
                </div>
                <div class="col-6 p-0 text-center">
                    <a href="#">
                        <img src="/frontend/Tropicoblack/assets/images/ui/youtube.png" alt="youtube" class="p-2"
                             style="max-width: 64px;"/>
                    </a>
                </div>
                <div class="col-6 p-0 text-center">
                    <a href="#">
                        <img src="/frontend/Tropicoblack/assets/images/ui/instagram.png" alt="instagram" class="p-2"
                             style="max-width: 64px;"/>
                    </a>
                </div>
                <div class="col-6 p-0 text-center">
                    <a href="#">
                        <img src="/frontend/Tropicoblack/assets/images/ui/linkedin.png" alt="linkedin" class="p-2"
                             style="max-width: 64px;"/>
                    </a>
                </div>
                <div class="col-6 p-0 text-center">
                    <a href="#">
                        <img src="/frontend/Tropicoblack/assets/images/ui/pinterest.png" alt="pinterest" class="p-2"
                             style="max-width: 64px;"/>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2 p-0 border-container">
            <h5 class="text-center p-2">Contact Us</h5>
            <div class="container text-center">
                <h6>24/7 Support</h6>
                <img src="/frontend/Tropicoblack/assets/images/ui/18plus.png" alt="" class="mb-1" style="max-width: 64px;"/>
            </div>
            <div class="container mt-5 text-center">
                <h6>
                    Gambling can be addictive.
                    <br/>
                    Please play responsibly.
                </h6>
            </div>
            <div class="container mt-5 text-center">
                <h6>
                    © 2020 the Casino
                    <br/>
                    All Rights Reserved
                </h6>
            </div>
        </div>
    </div>

    <div class="ft-cookies" id="div-cookies">
        <p>
            We use technical and analytics cookies to ensure that we give you the best experience on our website.
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a class="AcceptCookiesBtn btn primary-btn btn-lg text-uppercase" href="javascript: void(0);"
               onclick="javascript:GLOBALOBJ.methods.acceptCookies();">Accept</a>
        </p>
    </div>
</footer>
<!-- END FOOTER-->
</div>
<!-- END CONTENT -->

<!-- HELPERS -->
<!-- BACK TO TOP -->
<a id="back-to-top" href="javascript: void(0);" class="btn primary-btn btn-lg back-to-top" role="button"
   title="Back to Top" data-toggle="tooltip" data-placement="left">
    <span class="fas fa-angle-up"></span>
</a>
<!-- END BACK TO TOP -->
<!-- OVERLAY -->
<div class="overlay"></div>
<!-- END OVERLAY -->
<!-- GAME WINDOW MODAL -->
<div class="modal fade" id="game-window-modal" tabindex="-1" role="dialog" aria-labelledby="game-window-modal-title"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" id="game-window-modal-dialog">
        <div class="modal-content" id="game-modal-content">
            <div class="modal-header">
                <a style="z-index: 20;" href="javascript: void(0);" id="game-window-modal-fullscreen"
                   class="modal-button" aria-label="Open in Fullscreen" rel="fullscreen">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                <h5 class="modal-title" id="game-window-modal-title"></h5>

                <!-- JACKPOT -->
                    <div class="row w-100" id="jackpots2">
                        <div class="col-lg-3 pb-1 my-auto">
                        </div>
                        <div class="col-4 col-lg-2 pb-1 my-auto">
                            <div class="jackpot-container align-middle w-100 m-auto text-right">
                                <img src="/frontend/Tropicoblack/assets/images/ui/jackpot-icon-1.png" alt="jackpot-icon"
                                     class="jackpot-icon float-left"/>5555
                                <div class="odometer pisoglentis jackpot-elem1">456</div>
                            </div>
                        </div>
                        <div class="col-4 col-lg-2 pb-1 my-auto">
                            <div class="jackpot-container align-middle w-100 m-auto text-right">
                                <img src="/frontend/Tropicoblack/assets/images/ui/jackpot-icon-2.png" alt="jackpot-icon"
                                     class="jackpot-icon float-left"/>
                                <div class="odometer pisoglentis jackpot-elem2"></div>
                            </div>
                        </div>
                        <div class="col-4 col-lg-2 pb-1 my-auto">
                            <div class="jackpot-container align-middle w-100 m-auto text-right">
                                <img src="/frontend/Tropicoblack/assets/images/ui/jackpot-icon-3.png" alt="jackpot-icon"
                                     class="jackpot-icon float-left"/>
                                <div class="odometer pisoglentis jackpot-elem3"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 pb-1 my-auto">
                        </div>
                    </div>
                    <!-- JACKPOT -->
                                <button style="z-index: 20;" type="button" class="close modal-button" data-dismiss="modal"
                        aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>

            </div>

            <!-- BONUS MODAL -->
            <div id="bonusdiv" style="display: none;">
                <div id="bonusinner" style="">
                    <div id="bonusamount"></div>
                </div>
            </div>
            <!-- END BONUS MODAL -->

            <!-- JACKPOT MODAL -->
            <div id="jpdiv" style="display:none;">
                <div id="jpinner">
                    <div id="jpwin" class="center2">

                    </div>
                </div>
            </div>
            <!-- /JACKPOT MODAL -->

            <div class="modal-body">
                <div style="height: 65vh;" id="game-window-modal-frame">
                    <iframe class="modal-iframe" id="game-window-modal-iframe" src=""></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END GAME WINDOW MODAL -->
<!-- REGISTER MODAL -->
<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="register-modal-title"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" id="register-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="register-modal-title">
                    Register
                </h5>
                <button type="button" class="close modal-button" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-3">
                <form id="register-form" action="#" method="post">
                    <div class="custom-input-group mb-2">
                        <span class="custom-input-group-icon"><i class="fas fa-address-card"></i></span>
                        <input id="register-form-first-name" type="text" name="register-form-first-name"
                               placeholder="First Name"/>
                    </div>
                    <div class="custom-input-group mb-2">
                        <span class="custom-input-group-icon"><i class="fas fa-address-card"></i></span>
                        <input id="register-form-last-name" type="text" name="register-form-last-name"
                               placeholder="Last Name"/>
                    </div>
                    <div class="custom-input-group mb-2">
                        <span class="custom-input-group-icon"><i class="fas fa-at"></i></span>
                        <input id="register-form-email" type="text" name="register-form-email" placeholder="Email"/>
                    </div>
                    <div class="custom-input-group mb-2">
                        <span class="custom-input-group-icon"><i class="fas fa-user"></i></span>
                        <input id="register-form-username" type="text" name="register-form-username"
                               placeholder="Username"/>
                    </div>
                    <div class="custom-input-group mb-2">
                        <span class="custom-input-group-icon"><i class="fas fa-key"></i></span>
                        <input id="register-form-password1" type="password" name="register-form-password1"
                               placeholder="Password"/>
                    </div>
                    <div class="custom-input-group mb-2">
                        <span class="custom-input-group-icon"><i class="fas fa-key"></i></span>
                        <input id="register-form-password2" type="password" name="register-form-password2"
                               placeholder="Retype Password"/>
                    </div>
                    <button type="submit" form="register-form" value="Submit" class="btn primary-btn w-100 mt-4">
                        Register
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END REGISTER MODAL -->
<!-- LOGIN MODAL -->

































</div>
<!-- END LOGIN MODAL -->

<!-- TICKET MODAL -->
<div class="modal fade" id="ticket-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-modal-title"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" id="ticket-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="login-modal-title">
                    Ticket
                </h5>
                <button type="button" class="close modal-button" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-3">
                <div class="w-100 text-center mb-4">
                    <img src="/frontend/Tropicoblack/img/ticket_logo.png" alt="logo"/>
                </div>
                <form id="ticket-form" action="#" method="post">
                    <div class="custom-input-group mb-2">
                        <span class="custom-input-group-icon"><i class="fas fa-user"></i></span>
                        <input id="ticket-form-username" type="text" value="1234"
                               disabled name="ticket-form-username" placeholder="Username"/>
                    </div>
                    <div class="custom-input-group mb-2">
                        <span class="custom-input-group-icon"><i class="fas fa-money-bill-alt"></i></span>
                        <input id="ticket-form-balance" disabled value="" type="text" name="ticket-form-balance"
                               placeholder="Balance"/>
                    </div>
                    <button type="button" form="ticket-form" id="ticket-print-button" value="Submit"
                            class="btn primary-btn w-100 mt-4">
                        Print
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END LOGIN MODAL -->


<!-- HELP MODAL -->
<style>
    .modal-fullscreen .modal-dialog {
        max-width: 100%;
        height: 100vh;
    }

    .modal-full .modal-content {
        width: 100vw;
        height: 100%;
    }
</style>
<div class="modal fade modal-fullscreen " id="help-modal" tabindex="-1" role="dialog"
     aria-labelledby="ticket-modal-title"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-full" role="document" id="ticket-modal-dialog">
        <div class="modal-content modal-content-full">
            <div class="modal-header">
                <h5 class="modal-title" id="login-modal-title">
                    Help
                </h5>
                <button type="button" class="close modal-button" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-3">
                <h4></h4>
                Online casino  is one of the most reliable and proven online casinos. You can enjoy a number of popular games in  known from land-based casinos all over the world. Players can choose between classic fruit slot games, theme slots, Roulette, Black Jack, Keno and other games including exclusive brand new games.

                <div class="d-none pt-3" id="bonus1">
                    <h4> Cash back bonus</h4>

                    <span id="perBonus" class="text-danger font-weight-bold"></span>
                    Whenever you deposit an amount, you will get
                    <span id="perBonus2" class="text-danger font-weight-bold"></span>
                    amount added to your bonus box. These credits are added automatically to your balance when your balance drops below 1.00 If you cash out before cash back bonus is activated, the bonus is lost. You can cash out or top up at any time.


                    <span id="bonus2" class="d-none pt-3">
                            <h4 class="pt-3"> Happy hour bonus</h4>
                            Deposit From<br>
                                <span id="dates" class="font-weight-bold text-danger">

                                </span>
                                 and get
                                <span id="hp_bonus" class="font-weight-bold text-danger">

                                </span>
                                bonus.Happy hour bonus is an increased cash back bonus at specific time of the day so on every deposit you get

                                <span id="hp_bonus2" class="font-weight-bold text-danger">

                                </span>
                                added to your bonus box.

                           <hr>

                        </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END HELP MODAL -->

<!-- BONUS  MODAL -->

<div class="modal fade " id="bonus-modal" tabindex="-1" role="dialog"
     aria-labelledby="ticket-modal-title"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document" id="ticket-modal-dialog">
        <div class="modal-content modal-content-full">
            <div class="modal-header bbbonus1">
                <h5 class="modal-title text-center" id="login-modal-title">
                    Lvl
                </h5>
                <button type="button" class="close modal-button" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-3 bbbonus1">
                <h1 class="text-center text-warning text-capitalize font-weight-bold"> Your level is
                    <spam
                        class="lvlspam"></spam>
                </h1>

                <div class="text-center">

                    Levels unlock bonus features!
                    <br>
                    Progress is updated every few minutes
                     <br>
                    <div class="pt-5">
                        <h3>* Current level features *</h3>
                    </div>

                    <div class="pt-5 msgbonus">

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- END BONUS MODAL -->

<!-- BONUS2  MODAL -->


<!-- END BONUS2 MODAL -->

<!-- BONUS2 THANK YOU  MODAL -->

<div class="modal fade " id="bonus3-modal" tabindex="-1" role="dialog"
     aria-labelledby="ticket-modal-title"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document" id="ticket-modal-dialog">
        <div class="modal-content modal-content-full">
            <div class="modal-header bbbonus1">
                <h5 class="modal-title text-center" id="login-modal-title">
                    Congratulations!
                </h5>
                <button type="button" class="close modal-button" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-3">
                <div class="text-center">
                    <h1 class="modal-title text-center text-warning" id="login-modal-title">
                        Bonus collect!
                    </h1>
            </div>
        </div>
    </div>
</div>

<!-- BONUS2 THANK YOU  MODAL -->

<!-- END HELPERS -->

<script>
    var BIGGER_WIN = "Bigger Win"
    var NUMBER_OF_WINS = "Number Of Wins"
    var LAST_WINNER = "Last Winner"
    var HELP_17 = "Bonus collected!"
    var SUCCESS = "Success!";

		var jackpotSettings = {
		    "jackpot-elem1": {
		        currentValue: 20.4281,
		        isRed: false,
		        details: {
		            bigger_win: {
		                amount: 100,
		                date: "11-11-2019"
		            },
		            number_of_wins: 1,
		            last_winner: {
		                amount: 100,
		                date: "11-11-2019",
		                username: "test"
		            }
		        }
		    },
		    "jackpot-elem2": {
		        currentValue: 41.6603,
		        isRed: true,
		        details: {
		            bigger_win: {
		                amount: 100,
		                date: "11-11-2019"
		            },
		            number_of_wins: 1,
		            last_winner: {
		                amount: 100,
		                date: "11-11-2019",
		                username: "test"
		            }
		        }
		    },
						    "jackpot-elem3": {
		        currentValue: 73.3360,
		        isRed: false,
		        details: {
		            bigger_win: {
		                amount: 100,
		                date: "11-11-2019"
		            },
		            number_of_wins: 1,
		            last_winner: {
		                amount: 100,
		                date: "11-11-2019",
		                username: "test"
		            }
		        }
		    }
		};


</script>
<script src="/frontend/Tropicoblack/assets/vendors/jquery/3.4.1/jquery-3.4.1.min.js"></script>
<script src="/frontend/Tropicoblack/js/jquery-ui.js"></script>
<script src="/frontend/Tropicoblack/assets/vendors/popper/1.14.7/popper.min.js"></script>
<script src="/frontend/Tropicoblack/assets/vendors/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="/frontend/Tropicoblack/assets/vendors/swiper/4.5.0/js/swiper.min.js"></script>
<script src="/frontend/Tropicoblack/assets/vendors/odometer/0.4.6/js/odometer.min.js"></script>
<script src="/frontend/Tropicoblack/assets/vendors/bootstrap-select/1.13.9/js/bootstrap-select.min.js"></script>
<script src="/frontend/Tropicoblack/js/alertify.min.js?v=8324"></script>
<script src="/frontend/Tropicoblack/js/bonus.min.js?v=8324"></script>
<!-- <script src="/frontend/Tropicoblack/js/pisoglentis.min.js?v=8324"></script> -->
<script src="/frontend/Tropicoblack/assets/js/games.js"></script>
<script src="/frontend/Tropicoblack/assets/js/tools.js"></script>
<script src="/frontend/Tropicoblack/assets/js/main.js"></script>
<script src="/frontend/Tropicoblack/assets/js/ui.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('[data-category="all"]').click();
});
</script>

</body>

</html>
					
						

            <!--div id="gredit" class="text-gredit"src="../frontend/Amatic/images/logout.png>00.00</div-->
			<footer class="footer">
		<div class="container">
			<div class="footer__block">
				<div class="footer__left">
					@if ( $return && auth()->user()->present()->count_return > 0 && auth()->user()->present()->balance <= $return->min_balance )
					<a href="#" data-name="modal-bonus" class="gift" id="returns">
					</a>
					@endif
					
					
				</div>
				<div class="">
					<div class="">
						<span class="text-gredit" id="balanceValue">{{ number_format(Auth::user()->balance, 2,".","") }} <em>@if( auth()->user()->present()->shop )  @endif</em></span>
					</div>
			

          </div>

          </div>


		
		
		
		
						
						<!-- GAMES - BEGIN -->
				@if ($games && count($games))
					@foreach ($games as $key=>$game)
 
  
  






						
					@endforeach
				@endif
						<!-- GAMES - BEGIN -->
			
			<!-- SLIDER - END -->
		</div>
	</main>

				

	<!-- /.MAIN -->


@stop
