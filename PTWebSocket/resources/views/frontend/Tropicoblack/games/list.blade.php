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


						<!--li data-category="all">
								<a href="javscript: void(0);">
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
							</li-->

							
							<!--li  data-category="1065">
									<a href="javascript: void(0);">
											Amatic
									</a>
							</li>

							
							<!--li  data-category="1066">
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
							</li-->

													



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
									<!--li class="nav-item" data-category="all">
											<a class="nav-link text-center" href="javascript: void(0);">
													All
											</a>
									</li>

									
																																							<!--li class="nav-item" data-sv="hot" data-category="1059">
												<!--a class="nav-link text-center" href="javascript: void(0);">
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
										
																														<!--li class="nav-item" data-sv="keno" data-category="1078">
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
												</a-->
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

																													
																															<li class="nav-item mr-2 ml-2 box active" data-category="all">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/all.png"></a>
										</li>	

										<li class="nav-item mr-2 ml-2 box active" data-category="1077">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/vision.png"></a>
										</li>																			
																														<li class="nav-item mr-2 ml-2 box active" data-category="1061">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/egt.png"></a>
										</li>
										
																														<!--li class="nav-item mr-2 ml-2 box active" data-category="1062">
											<!--a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/isoftbet.png"></a>
										</li-->
										
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
										
																														<!--li class="nav-item mr-2 ml-2 box active" data-category="1068">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/greentube.png"></a>
										</li-->
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1069">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/igrosoft.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1070">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/netent.png"></a>
										</li>
										
																														<!--li class="nav-item mr-2 ml-2 box active" data-category="1072">
											<!--a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/pragmatic.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1074">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/mainama.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1075">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/ka-gaming.png"></a>
										</li>
										
																														<li class="nav-item mr-2 ml-2 box active" data-category="1076">
											<a href="javascript: void(0);"><img style="filter:brightness(0) invert(1);" class="nav-item-img" src="/frontend/Tropicoblack/img/companies/wazdan.png"></a>
										</li-->
										
																				
																				
																				
																				
																				
																				
																			
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
//EGT
	var GLOBAL_GAMES_LIST = [

				{
			"launchUrl":"/game/AgeOfTroyEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Age Of Troy",
			"imageUrl":"/frontend/Tropicoblack/ico/AgeOfTroyEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AgeOfTroyEGT.jpg",
			"mobileGame": false
		},

				{
			"launchUrl":"/game/AlohaPartyEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Aloha Party",
			"imageUrl":"/frontend/Tropicoblack/ico/AlohaPartyEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AlohaPartyEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/AmazonsBattleEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Amazons Battle",
			"imageUrl":"/frontend/Tropicoblack/ico/AmazonsBattleEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AmazonsBattleEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/AmazonStoryEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Amazon Story",
			"imageUrl":"/frontend/Tropicoblack/ico/AmazonStoryEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AmazonStoryEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/AztecGloryEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Aztec Glory",
			"imageUrl":"/frontend/Tropicoblack/ico/AztecGloryEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AztecGloryEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BigJourneyEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Big Journey",
			"imageUrl":"/frontend/Tropicoblack/ico/BigJourneyEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BigJourneyEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BlueHeartEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Blue Heart",
			"imageUrl":"/frontend/Tropicoblack/ico/BlueHeartEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BlueHeartEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BookOfMagicEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Book Of Magic",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfMagicEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfMagicEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BurningDice40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Dice 40",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningDice40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningDice40EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BurningDice5EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Dice 5",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningDice5EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningDice5EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BurningDiceEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningDiceEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningDiceEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BurningHeart10EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Heart 10",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHeart10EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHeart10EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BurningHeart5EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Heart 5",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHeart5EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHeart5EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BurningHot100EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Hot 100",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHot100EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHot100EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BurningHot20EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Hot 20",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHot20EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHot20EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BurningHot40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Hot 40",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHot40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHot40EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BurningHot6Reels40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Hot 6/40",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHot6Reels40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHot6Reels40EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BurningHot6Reels5EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Burning Hot 6/5",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningHot6Reels5EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningHot6Reels5EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/CaramelDiceEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Caramel Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/CaramelDiceEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CaramelDiceEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/CaramelHotEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Caramel Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/CaramelHotEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CaramelHotEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/CashmirGoldEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Cashmir Gold",
			"imageUrl":"/frontend/Tropicoblack/ico/CashmirGoldEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CashmirGoldEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/CasinoManiaEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Casino Mania",
			"imageUrl":"/frontend/Tropicoblack/ico/CasinoManiaEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CasinoManiaEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/Cats100EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Cats 100",
			"imageUrl":"/frontend/Tropicoblack/ico/Cats100EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Cats100EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/CatsRoyalEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Cats Royal",
			"imageUrl":"/frontend/Tropicoblack/ico/CatsRoyalEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CatsRoyalEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/CoralIslandEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Coral Island",
			"imageUrl":"/frontend/Tropicoblack/ico/CoralIslandEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CoralIslandEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DarkQueenEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dark Queen",
			"imageUrl":"/frontend/Tropicoblack/ico/DarkQueenEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DarkQueenEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DarkQueenEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dark Queen",
			"imageUrl":"/frontend/Tropicoblack/ico/DarkQueenEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DarkQueenEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DazzlingHot20EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dazzling Hot 20",
			"imageUrl":"/frontend/Tropicoblack/ico/DazzlingHot20EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DazzlingHot20EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DazzlingHot5EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dazzling Hot 5",
			"imageUrl":"/frontend/Tropicoblack/ico/DazzlingHot5EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DazzlingHot5EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/Diamonds20EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Diamonds 20",
			"imageUrl":"/frontend/Tropicoblack/ico/Diamonds20EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Diamonds20EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/Dice81EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dice 81",
			"imageUrl":"/frontend/Tropicoblack/ico/Dice81EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Dice81EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DiceAndRoll40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dice AndRoll 40",
			"imageUrl":"/frontend/Tropicoblack/ico/DiceAndRoll40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DiceAndRoll40EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DiceAndRollEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dice And Roll",
			"imageUrl":"/frontend/Tropicoblack/ico/DiceAndRollEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DiceAndRollEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DiceOfMagicEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dice Of Magic",
			"imageUrl":"/frontend/Tropicoblack/ico/DiceOfMagicEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DiceOfMagicEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DiceOfRaEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dice Of Ra",
			"imageUrl":"/frontend/Tropicoblack/ico/DiceOfRaEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DiceOfRaEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DragonReelsEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dragon Reels",
			"imageUrl":"/frontend/Tropicoblack/ico/DragonReelsEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DragonReelsEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DragonSpiritEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Dragon Spirit",
			"imageUrl":"/frontend/Tropicoblack/ico/DragonSpiritEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DragonSpiritEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/EgyptSkyEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Egypt Sky",
			"imageUrl":"/frontend/Tropicoblack/ico/EgyptSkyEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EgyptSkyEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/ExtraJokerEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Extra Joker",
			"imageUrl":"/frontend/Tropicoblack/ico/ExtraJokerEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ExtraJokerEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/ExtraStarsEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Extra Stars",
			"imageUrl":"/frontend/Tropicoblack/ico/ExtraStarsEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ExtraStarsEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/ExtremelyHotEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Extremely Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/ExtremelyHotEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ExtremelyHotEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/FastMoneyEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Fast Money",
			"imageUrl":"/frontend/Tropicoblack/ico/FastMoneyEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FastMoneyEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/FlamingDiceEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Flaming Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/FlamingDiceEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FlamingDiceEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/FlamingHotEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Flaming Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/FlamingHotEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FlamingHotEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/ForestBandEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Forest Band",
			"imageUrl":"/frontend/Tropicoblack/ico/ForestBandEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ForestBandEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/FortuneSpellsEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Fortune Spells",
			"imageUrl":"/frontend/Tropicoblack/ico/FortuneSpellsEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FortuneSpellsEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/FrogStoryEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Frog Story",
			"imageUrl":"/frontend/Tropicoblack/ico/FrogStoryEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FrogStoryEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/FruitsKingdomEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Fruits Kingdom",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitsKingdomEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitsKingdomEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/GameOfLuckEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Game Of Luck",
			"imageUrl":"/frontend/Tropicoblack/ico/GameOfLuckEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GameOfLuckEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/GraceOfCleopatraEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Grace Of Cleopatra",
			"imageUrl":"/frontend/Tropicoblack/ico/GraceOfCleopatraEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GraceOfCleopatraEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/GraceOfCleopatraEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Grace Of Cleopatra",
			"imageUrl":"/frontend/Tropicoblack/ico/GraceOfCleopatraEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GraceOfCleopatraEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/Great27EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Great 27",
			"imageUrl":"/frontend/Tropicoblack/ico/Great27EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Great27EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/GreatEgyptEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Great Egypt",
			"imageUrl":"/frontend/Tropicoblack/ico/GreatEgyptEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GreatEgyptEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/GreatEmpireEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Great Empire",
			"imageUrl":"/frontend/Tropicoblack/ico/GreatEmpireEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GreatEmpireEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/GreatStar5EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Great Star 5",
			"imageUrl":"/frontend/Tropicoblack/ico/GreatStar5EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GreatStar5EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/HalloweenEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Halloween",
			"imageUrl":"/frontend/Tropicoblack/ico/HalloweenEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HalloweenEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/Horses50EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Horses 50",
			"imageUrl":"/frontend/Tropicoblack/ico/Horses50EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Horses50EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/HotAndCashEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Hot And Cash",
			"imageUrl":"/frontend/Tropicoblack/ico/HotAndCashEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotAndCashEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/HotDice5EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Hot Dice 5",
			"imageUrl":"/frontend/Tropicoblack/ico/HotDice5EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotDice5EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/IceDiceEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Ice Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/IceDiceEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/IceDiceEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/ImperialWarsEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Imperial Wars",
			"imageUrl":"/frontend/Tropicoblack/ico/ImperialWarsEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ImperialWarsEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/IncaGoldIIEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Inca Gold II",
			"imageUrl":"/frontend/Tropicoblack/ico/IncaGoldIIEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/IncaGoldIIEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/JokerReels20EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Joker Reels 20",
			"imageUrl":"/frontend/Tropicoblack/ico/JokerReels20EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JokerReels20EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/LuckyAndWild20EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Lucky And Wild 20",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyAndWild20EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyAndWild20EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/LuckyAndWild40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Lucky And Wild 40",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyAndWild40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyAndWild40EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/LuckyBuzzEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Lucky Buzz",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyBuzzEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyBuzzEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/LuckyHotEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Lucky Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyHotEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyHotEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/LuckyHotEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Lucky Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyHotEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyHotEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/LuckyKing40EGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Lucky King 40",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyKing40EGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyKing40EGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/MagellanEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Magellan",
			"imageUrl":"/frontend/Tropicoblack/ico/MagellanEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagellanEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/MajesticForestEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Majestic Forest",
			"imageUrl":"/frontend/Tropicoblack/ico/MajesticForestEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MajesticForestEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/MayanSpiritEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Mayan Spirit",
			"imageUrl":"/frontend/Tropicoblack/ico/MayanSpiritEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MayanSpiritEGT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/MegaCloverEGT",
			"providerId":"bomba",
			"categoryName":"1061",
			"gameName":"Mega Clover",
			"imageUrl":"/frontend/Tropicoblack/ico/MegaCloverEGT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MegaCloverEGT.jpg",
			"mobileGame": false
		},
//OFF EGT


						{
			"launchUrl":"/game/AncientMagicGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ancient Magic",
			"imageUrl":"/frontend/Tropicoblack/ico/AgeOfEgyptPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AgeOfEgyptPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/AncientRichesCasinoGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ancient Riches Casino",
			"imageUrl":"/frontend/Tropicoblack/ico/AgeOfGodsKingofOlympusPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AgeOfGodsKingofOlympusPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/AncientRichesCasinoRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ancient Riches Casino Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/AncientRichesCasinoRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AncientRichesCasinoRedHotFirepotGM.jpg",
			"mobileGame": false
		},
//Playtech
						{
			"launchUrl":"/game/AgeOfGodsKingofOlympusPTM",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Anaconda Wild",
			"imageUrl":"/frontend/Tropicoblack/ico/AgeOfGodsKingofOlympusPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AgeOfGodsKingofOlympusPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/ArcherPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Archer",
			"imageUrl":"/frontend/Tropicoblack/ico/ArcherPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ArcherPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BaiShiPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Bai Shi",
			"imageUrl":"/frontend/Tropicoblack/ico/BaiShiPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BaiShiPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BermudaTrianglePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Bermuda Triangle",
			"imageUrl":"/frontend/Tropicoblack/ico/BermudaTrianglePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BermudaTrianglePT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BerryBerryBonanzaPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Berry Berry Bonanza",
			"imageUrl":"/frontend/Tropicoblack/ico/BerryBerryBonanzaPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BerryBerryBonanzaPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BlackjackSurrenderPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Blackjack Surrender",
			"imageUrl":"/frontend/Tropicoblack/ico/BlackjackSurrenderPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BlackjackSurrenderPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BonusBearsPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Bonus Bears",
			"imageUrl":"/frontend/Tropicoblack/ico/BonusBearsPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BonusBearsPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BuffaloBlitzPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Buffalo Blitz",
			"imageUrl":"/frontend/Tropicoblack/ico/BuffaloBlitzPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BuffaloBlitzPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/CaptainsTreasurePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Captains Treasure",
			"imageUrl":"/frontend/Tropicoblack/ico/CaptainsTreasurePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CaptainsTreasurePT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/CherryLovePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Cherry Love",
			"imageUrl":"/frontend/Tropicoblack/ico/CherryLovePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CherryLovePT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/ChineseKitchenPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Chinese Kitchen",
			"imageUrl":"/frontend/Tropicoblack/ico/ChineseKitchenPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ChineseKitchenPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/ChristmasBellsJPPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Christmas Bells JP",
			"imageUrl":"/frontend/Tropicoblack/ico/ChristmasBellsJPPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ChristmasBellsJPPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/CoinCoinCoinPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Coin Coin Coin",
			"imageUrl":"/frontend/Tropicoblack/ico/CoinCoinCoinPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CoinCoinCoinPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/Crazy7PT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Crazy 7",
			"imageUrl":"/frontend/Tropicoblack/ico/Crazy7PT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Crazy7PT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DesertTreasurePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Desert Treasure",
			"imageUrl":"/frontend/Tropicoblack/ico/DesertTreasurePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DesertTreasurePT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DolphinReefPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Dolphin Reef",
			"imageUrl":"/frontend/Tropicoblack/ico/DolphinReefPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DolphinReefPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DragonChampionsPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Dragon Champions",
			"imageUrl":"/frontend/Tropicoblack/ico/DragonChampionsPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DragonChampionsPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/EasterSurprisePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Easter Surprise",
			"imageUrl":"/frontend/Tropicoblack/ico/EasterSurprisePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EasterSurprisePT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/EpicApePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Epic Ape",
			"imageUrl":"/frontend/Tropicoblack/ico/EpicApePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EpicApePT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/FountainOfYouthPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Fountain Of Youth",
			"imageUrl":"/frontend/Tropicoblack/ico/FountainOfYouthPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FountainOfYouthPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/FunkyMonkeyJPPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Funky Monkey JP",
			"imageUrl":"/frontend/Tropicoblack/ico/FunkyMonkeyJPPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FunkyMonkeyJPPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/GeishaStoryPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Geisha Story",
			"imageUrl":"/frontend/Tropicoblack/ico/GeishaStoryPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GeishaStoryPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/GoldenTourPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Golden Tour",
			"imageUrl":"/frontend/Tropicoblack/ico/GoldenTourPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoldenTourPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/GreatBlueJPPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Great Blue JP",
			"imageUrl":"/frontend/Tropicoblack/ico/GreatBlueJPPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GreatBlueJPPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/HalloweenFortunePT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Halloween Fortune",
			"imageUrl":"/frontend/Tropicoblack/ico/HalloweenFortunePT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HalloweenFortunePT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/HighwayKingsPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Highway Kings",
			"imageUrl":"/frontend/Tropicoblack/ico/HighwayKingsPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HighwayKingsPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/HotGemsPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Hot Gems",
			"imageUrl":"/frontend/Tropicoblack/ico/HotGemsPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotGemsPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/IrishLuckPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Irish Luck",
			"imageUrl":"/frontend/Tropicoblack/ico/IrishLuckPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/IrishLuckPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/JackpotBellsPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Jackpot Bells",
			"imageUrl":"/frontend/Tropicoblack/ico/JackpotBellsPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JackpotBellsPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/JacksOrBetterMHPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Jacks Or Better",
			"imageUrl":"/frontend/Tropicoblack/ico/JacksOrBetterMHPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JacksOrBetterMHPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/JacksOrBetterPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Jacks Or Better",
			"imageUrl":"/frontend/Tropicoblack/ico/JacksOrBetterPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JacksOrBetterPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/JiXiang8PT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Ji Xiang 8",
			"imageUrl":"/frontend/Tropicoblack/ico/JiXiang8PT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JiXiang8PT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/LieYanZuanShiPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Lie Yan Zuan Shi",
			"imageUrl":"/frontend/Tropicoblack/ico/LieYanZuanShiPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LieYanZuanShiPT.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/MedusaMonstersPT",
			"providerId":"bomba",
			"categoryName":"1064",
			"gameName":"Medusa Monsters",
			"imageUrl":"/frontend/Tropicoblack/ico/MedusaMonstersPT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MedusaMonstersPT.jpg",
			"mobileGame": false
		},

//END PLAYTECH
//IGROSOFT
						{
			"launchUrl":"/game/CrazyMonkey2IG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Mr Crazy Monkey 2",
			"imageUrl":"/frontend/Tropicoblack/ico/CrazyMonkey2IG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CrazyMonkey2IG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/CrazyMonkeyIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Crazy Monkey",
			"imageUrl":"/frontend/Tropicoblack/ico/CrazyMonkeyIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CrazyMonkeyIG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/FruitCocktail2IG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Fruit Cocktail 2",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitCocktail2IG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitCocktail2IG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/FruitCocktailIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Fruit Cocktail",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitCocktailIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitCocktailIG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/GarageIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Garage",
			"imageUrl":"/frontend/Tropicoblack/ico/GarageIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GarageIG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/GnomeIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Gnome",
			"imageUrl":"/frontend/Tropicoblack/ico/GnomeIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GnomeIG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/Island2IG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Island 2",
			"imageUrl":"/frontend/Tropicoblack/ico/Island2IG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Island2IG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/IslandIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Island",
			"imageUrl":"/frontend/Tropicoblack/ico/IslandIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/IslandIG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/KeksIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Keks",
			"imageUrl":"/frontend/Tropicoblack/ico/KeksIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KeksIG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/LuckyHaunterIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Lucky Haunter",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyHaunterIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyHaunterIG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/PirateIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Pirate",
			"imageUrl":"/frontend/Tropicoblack/ico/PirateIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PirateIG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/Pirate2IG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Pirate 2",
			"imageUrl":"/frontend/Tropicoblack/ico/Pirate2IG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Pirate2IG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/ResidentIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Resident",
			"imageUrl":"/frontend/Tropicoblack/ico/ResidentIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ResidentIG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/RockClimberIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Rock Climber",
			"imageUrl":"/frontend/Tropicoblack/ico/RockClimberIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RockClimberIG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/FruitCocktail2IG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Fruit Cocktail 2",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitCocktail2IG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitCocktail2IG.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/PumpkinFairyIG",
			"providerId":"bomba",
			"categoryName":"1069",
			"gameName":"Pumpkin Fairy",
			"imageUrl":"/frontend/Tropicoblack/ico/PumpkinFairyIG.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PumpkinFairyIG.jpg",
			"mobileGame": false
		},

//End Igrosoft
//VISION
						{
			"launchUrl":"/game/BurningFruitsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Burning Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningFruitsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningFruitsVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BurningReelsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Burning Reels",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningReelsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningReelsVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BurningScatterVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Burning Scatter",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningScatterVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningScatterVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/RedHot7VS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"RedHot 7",
			"imageUrl":"/frontend/Tropicoblack/ico/RedHot7VS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RedHot7VS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/WantedBulletsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Wanted Bullets",
			"imageUrl":"/frontend/Tropicoblack/ico/WantedBulletsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WantedBulletsVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/PoseidonsParadiseVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Poseidons Paradise",
			"imageUrl":"/frontend/Tropicoblack/ico/PoseidonsParadiseVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PoseidonsParadiseVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DolphinsTreasureVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Dolphins Treasure",
			"imageUrl":"/frontend/Tropicoblack/ico/DolphinsTreasureVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DolphinsTreasureVS.jpg",
			"mobileGame": false
		},
						{
			"launchUrl":"/game/LoonyFruitsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Loony Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/LoonyFruitsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LoonyFruitsVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/LadysKissDeluxeVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Ladys Kiss Deluxe",
			"imageUrl":"/frontend/Tropicoblack/ico/LadysKissDeluxeVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LadysKissDeluxeVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/LadysKissVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Ladys Kiss",
			"imageUrl":"/frontend/Tropicoblack/ico/LadysKissVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LadysKissVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/GalaxyVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Galaxy",
			"imageUrl":"/frontend/Tropicoblack/ico/GalaxyVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GalaxyVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/ThorVictoryVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Thor Victory",
			"imageUrl":"/frontend/Tropicoblack/ico/ThorVictoryVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ThorVictoryVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/MonkeysDanceVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Monkeys Dance",
			"imageUrl":"/frontend/Tropicoblack/ico/MonkeysDanceVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MonkeysDanceVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DevilsFireVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Devils Fire",
			"imageUrl":"/frontend/Tropicoblack/ico/DevilsFireVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DevilsFireVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/RoyalCrownVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Roya lCrown",
			"imageUrl":"/frontend/Tropicoblack/ico/RoyalCrownVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoyalCrownVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/DevilsBridgeVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Devils Bridge",
			"imageUrl":"/frontend/Tropicoblack/ico/DevilsBridgeVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DevilsBridgeVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/XXXReelsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"XXX Reels",
			"imageUrl":"/frontend/Tropicoblack/ico/XXXReelsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/XXXReelsVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/Wins4VS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Wins 4",
			"imageUrl":"/frontend/Tropicoblack/ico/Wins4VS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Wins4VS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/HotReelsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Hot Reels",
			"imageUrl":"/frontend/Tropicoblack/ico/HotReelsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotReelsVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/HotFruitsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Hot Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/HotFruitsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotFruitsVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/WormVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Worm",
			"imageUrl":"/frontend/Tropicoblack/ico/WormVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WormVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BeatleDanceVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Beatle Dance",
			"imageUrl":"/frontend/Tropicoblack/ico/BeatleDanceVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BeatleDanceVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/MagicFruitsVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Magic Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/MagicFruitsVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagicFruitsVS.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BurningRingVS",
			"providerId":"bomba",
			"categoryName":"1077",
			"gameName":"Burning Ring",
			"imageUrl":"/frontend/Tropicoblack/ico/BurningRingVS.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BurningRingVS.jpg",
			"mobileGame": false
		},
//VISION KRAJ
//GAMOMAT
						{
			"launchUrl":"/game/AncientMagicGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ancient Magic",
			"imageUrl":"/frontend/Tropicoblack/ico/AncientMagicGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AncientMagicGM.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/AncientRichesCasinoGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ancient Riches Casino",
			"imageUrl":"/frontend/Tropicoblack/ico/AncientRichesCasinoGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AncientRichesCasinoGM.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/AncientRichesCasinoRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ancient Riches Casino Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/AncientRichesCasinoRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AncientRichesCasinoRedHotFirepotGM.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BeautifulNatureGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Beautiful Nature",
			"imageUrl":"/frontend/Tropicoblack/ico/BeautifulNatureGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BeautifulNatureGM.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BlackBeautyGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Black Beauty",
			"imageUrl":"/frontend/Tropicoblack/ico/BlackBeautyGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BlackBeautyGM.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BookOfMoorhuhnGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Book Of Moorhuhn",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfMoorhuhnGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfMoorhuhnGM.jpg",
			"mobileGame": false
		},

						{
			"launchUrl":"/game/BookOfMoorhuhnGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Book Of Moorhuhn Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfMoorhuhnGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfMoorhuhnGoldenNightsGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/BookOfRomeoAndJuliaGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Book Of Romeo AndJulia",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfRomeoAndJuliaGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfRomeoAndJuliaGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/BookOfTheAgesGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Book Of TheAges",
			"imageUrl":"/frontend/Tropicoblack/ico/BookOfTheAgesGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BookOfTheAgesGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/CrystalBallGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Crystal Ball",
			"imageUrl":"/frontend/Tropicoblack/ico/CrystalBallGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CrystalBallGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/CrystalBallGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Crystal Ball Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/CrystalBallGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CrystalBallGoldenNightsGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/CrystalBallRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Crystal Ball Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/CrystalBallRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CrystalBallRedHotFirepotGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/DiscOfAthenaGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Disc Of Athena",
			"imageUrl":"/frontend/Tropicoblack/ico/DiscOfAthenaGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DiscOfAthenaGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/ExplodiacGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Explodiac",
			"imageUrl":"/frontend/Tropicoblack/ico/ExplodiacGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ExplodiacGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/ExplodiacRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Explodiac Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/ExplodiacRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ExplodiacRedHotFirepotGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/FancyFruitsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Fancy Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/FancyFruitsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FancyFruitsGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/FancyFruitsGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Fancy Fruits Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/FancyFruitsGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FancyFruitsGoldenNightsGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/FancyFruitsRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Fancy Fruits Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/FancyFruitsRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FancyFruitsRedHotFirepotGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/ForeverDiamondsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Forever Diamonds",
			"imageUrl":"/frontend/Tropicoblack/ico/ForeverDiamondsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ForeverDiamondsGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/FruitManiaGMFruitManiaGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Fruit Mania",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitManiaGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitManiaGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/FruitManiaGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Fruit Mania Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitManiaGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitManiaGoldenNightsGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/FruitManiaRHFPGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Fruit Mania RHFP",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitManiaRHFPGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitManiaRHFPGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/GatesOfPersiaGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Gates Of Persia",
			"imageUrl":"/frontend/Tropicoblack/ico/GatesOfPersiaGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GatesOfPersiaGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/GlamorousTimesGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Glamorous Times",
			"imageUrl":"/frontend/Tropicoblack/ico/GlamorousTimesGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GlamorousTimesGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/GoldenTouchGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Golden Touch",
			"imageUrl":"/frontend/Tropicoblack/ico/GoldenTouchGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoldenTouchGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/KingAndQueenGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"King And Queen",
			"imageUrl":"/frontend/Tropicoblack/ico/KingAndQueenGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingAndQueenGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/KingOfTheJungleGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"King Of The Jungle",
			"imageUrl":"/frontend/Tropicoblack/ico/KingOfTheJungleGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingOfTheJungleGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/KingOfTheJungleGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"King Of The Jungle Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/KingOfTheJungleGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingOfTheJungleGoldenNightsGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/KingOfTheJungleRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"King Of The Jungle Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/KingOfTheJungleRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingOfTheJungleRedHotFirepotGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/MaaaxDiamondsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Maaax Diamonds",
			"imageUrl":"/frontend/Tropicoblack/ico/MaaaxDiamondsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MaaaxDiamondsGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/MaaaxDiamondsGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Maaax Diamonds Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/MaaaxDiamondsGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MaaaxDiamondsGoldenNightsGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/MagicStoneGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Magic Stone",
			"imageUrl":"/frontend/Tropicoblack/ico/MagicStoneGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagicStoneGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/MightyDragonGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Mighty Dragon",
			"imageUrl":"/frontend/Tropicoblack/ico/MightyDragonGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MightyDragonGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/NightWolvesGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Night Wolves",
			"imageUrl":"/frontend/Tropicoblack/ico/NightWolvesGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/NightWolvesGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/OldFishermanGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Old Fisherman",
			"imageUrl":"/frontend/Tropicoblack/ico/OldFishermanGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/OldFishermanGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/PhantomsMirrorGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Phantoms Mirror",
			"imageUrl":"/frontend/Tropicoblack/ico/PhantomsMirrorGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PhantomsMirrorGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/PharaosRichesGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Pharaos Riches",
			"imageUrl":"/frontend/Tropicoblack/ico/PharaosRichesGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PharaosRichesGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/PharaosRichesGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Pharaos Riches Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/PharaosRichesGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PharaosRichesGoldenNightsGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/PharaosRichesRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Pharaos Riches Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/PharaosRichesRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PharaosRichesRedHotFirepotGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/RamsesBookGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ramses Book",
			"imageUrl":"/frontend/Tropicoblack/ico/RamsesBookGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RamsesBookGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/RamsesBookGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ramses Book Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/RamsesBookGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RamsesBookGoldenNightsGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/RamsesBookRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Ramses Book Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/RamsesBookRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RamsesBookRedHotFirepotGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/RoyalSevenGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Royal Seven",
			"imageUrl":"/frontend/Tropicoblack/ico/RoyalSevenGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoyalSevenGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/RoyalSevenGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Royal Seven Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/RoyalSevenGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoyalSevenGoldenNightsGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/RoyalSevenXXLGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Royal Seven XXL",
			"imageUrl":"/frontend/Tropicoblack/ico/RoyalSevenXXLGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoyalSevenXXLGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/RoyalSevenXXLRHFPGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Royal Seven XXLRHFP",
			"imageUrl":"/frontend/Tropicoblack/ico/RoyalSevenXXLRHFPGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RoyalSevenXXLRHFPGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/SavannaMoonGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Savanna Moon",
			"imageUrl":"/frontend/Tropicoblack/ico/SavannaMoonGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SavannaMoonGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/SimplyTheBestGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Simply The Best",
			"imageUrl":"/frontend/Tropicoblack/ico/SimplyTheBestGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SimplyTheBestGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/SuperDuperCherryRedHotFirepotGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Super Duper Cherry Red Hot Firepot",
			"imageUrl":"/frontend/Tropicoblack/ico/SuperDuperCherryRedHotFirepotGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SuperDuperCherryRedHotFirepotGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/SuperDuperMoorhuhnGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Super Duper Moorhuhn",
			"imageUrl":"/frontend/Tropicoblack/ico/SuperDuperMoorhuhnGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SuperDuperMoorhuhnGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/TheExpandableGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"The Expandable",
			"imageUrl":"/frontend/Tropicoblack/ico/TheExpandableGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheExpandableGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/KingAndQueenGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"KingAndQueen",
			"imageUrl":"/frontend/Tropicoblack/ico/KingAndQueenGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingAndQueenGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/TheLandOfHeroesGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"The Land Of Heroes Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/TheLandOfHeroesGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheLandOfHeroesGoldenNightsGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/TheMightyKingGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"The Mighty King",
			"imageUrl":"/frontend/Tropicoblack/ico/TheMightyKingGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheMightyKingGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/WildRapaNuiGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Wild Rapa Nui",
			"imageUrl":"/frontend/Tropicoblack/ico/WildRapaNuiGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildRapaNuiGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/WildRubiesGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Wild Rubies",
			"imageUrl":"/frontend/Tropicoblack/ico/WildRubiesGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildRubiesGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/WildRubiesGoldenNightsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Wild Rubies Golden Nights",
			"imageUrl":"/frontend/Tropicoblack/ico/WildRubiesGoldenNightsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildRubiesGoldenNightsGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/WildsGoneWildGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Wilds Gone Wild",
			"imageUrl":"/frontend/Tropicoblack/ico/WildsGoneWildGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildsGoneWildGM.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/XplodingPumpkinsGM",
			"providerId":"bomba",
			"categoryName":"1063",
			"gameName":"Xploding Pumpkins",
			"imageUrl":"/frontend/Tropicoblack/ico/XplodingPumpkinsGM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/XplodingPumpkinsGM.jpg",
			"mobileGame": false
		},
//GAMOMAT END
//ARISTOCRAT

			//			{
			//"launchUrl":"/game/Dragons5AT",
			//"providerId":"bomba",
			//"categoryName":"1066",
			//"gameName":"Dragons 5",
			//"imageUrl":"/frontend/Tropicoblack/ico/Dragons5AT.jpg",
			//"data-src":"/frontend/Tropicoblack/ico/Dragons5AT.jpg",
			//"mobileGame": false
		//},


						{
			"launchUrl":"/game/Dragons50AT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Dragons 50",
			"imageUrl":"/frontend/Tropicoblack/ico/Dragons50AT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Dragons50AT.jpg",
			"mobileGame": false
		},


						{
			"launchUrl":"/game/Lions50AT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Lions 50",
			"imageUrl":"/frontend/Tropicoblack/ico/Lions50AT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Lions50AT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/BigBenAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Big Ben",
			"imageUrl":"/frontend/Tropicoblack/ico/BigBenAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BigBenAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/BigRedAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Big Red",
			"imageUrl":"/frontend/Tropicoblack/ico/BigRedAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BigRedAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/BuffaloAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Buffalo",
			"imageUrl":"/frontend/Tropicoblack/ico/BuffaloAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BuffaloAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/ChoySunDoaAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Choy Sun Doa",
			"imageUrl":"/frontend/Tropicoblack/ico/ChoySunDoaAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ChoySunDoaAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/DolphinsTreasureAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Dolphins Treasure",
			"imageUrl":"/frontend/Tropicoblack/ico/DolphinsTreasureAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DolphinsTreasureAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/DoubleHappinessAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Double Happiness",
			"imageUrl":"/frontend/Tropicoblack/ico/DoubleHappinessAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DoubleHappinessAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/FlameOfOlympusAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Flame Of Olympus",
			"imageUrl":"/frontend/Tropicoblack/ico/FlameOfOlympusAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FlameOfOlympusAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/JaguarMistAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Jaguar Mist",
			"imageUrl":"/frontend/Tropicoblack/ico/JaguarMistAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JaguarMistAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/Lucky88AT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Lucky 88",
			"imageUrl":"/frontend/Tropicoblack/ico/Lucky88AT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Lucky88AT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/LuckyCountAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Lucky Count",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyCountAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyCountAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/MissKittyAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Miss Kitty",
			"imageUrl":"/frontend/Tropicoblack/ico/MissKittyAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MissKittyAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/MoonFestivalAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Moon Festival",
			"imageUrl":"/frontend/Tropicoblack/ico/MoonFestivalAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MoonFestivalAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/PelicanPeteAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Pelican Pete",
			"imageUrl":"/frontend/Tropicoblack/ico/PelicanPeteAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PelicanPeteAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/PompeiiAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Pompeii",
			"imageUrl":"/frontend/Tropicoblack/ico/PompeiiAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PompeiiAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/QueenOfTheNileIIAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Queen Of TheNile II",
			"imageUrl":"/frontend/Tropicoblack/ico/QueenOfTheNileIIAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/QueenOfTheNileIIAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/SilkRoadAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Silk Road",
			"imageUrl":"/frontend/Tropicoblack/ico/SilkRoadAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SilkRoadAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/SunAndMoonAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"SunAnd Moon",
			"imageUrl":"/frontend/Tropicoblack/ico/SunAndMoonAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SunAndMoonAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/TikiTorchAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Tiki Torch",
			"imageUrl":"/frontend/Tropicoblack/ico/TikiTorchAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TikiTorchAT.jpg",
			"mobileGame": false
		},



						{
			"launchUrl":"/game/WerewolfWildAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Werewolf Wild",
			"imageUrl":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"mobileGame": false
		},
		{
			"launchUrl":"/game/WildSplashAT",
			"providerId":"bomba",
			"categoryName":"1066",
			"gameName":"Wild Splash",
			"imageUrl":"/frontend/Tropicoblack/ico/WildSplashAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildSplashAT.jpg",
			"mobileGame": false
		},

//ARISTOCAT END
//NETENT
						{
			"launchUrl":"/game/DazzleMeNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Dazzle Me",
			"imageUrl":"/frontend/Tropicoblack/ico/DazzleMeNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DazzleMeNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/FruitShopChristmasNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Fruit Shop Christmas",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitShopChristmasNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitShopChristmasNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/FruitShopNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Fruit Shop",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitShopNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitShopNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/GoBananasNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Go Bananas",
			"imageUrl":"/frontend/Tropicoblack/ico/GoBananasNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GoBananasNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/LightsNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Lights",
			"imageUrl":"/frontend/Tropicoblack/ico/LightsNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LightsNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/FortuneRangersNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Fortune Rangers",
			"imageUrl":"/frontend/Tropicoblack/ico/FortuneRangersNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FortuneRangersNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/CreatureFromTheBlackLagoonNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Creature From The Black Lagoon",
			"imageUrl":"/frontend/Tropicoblack/ico/CreatureFromTheBlackLagoonNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CreatureFromTheBlackLagoonNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/CreatureFromTheBlackLagoonNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Creature From The Black Lagoon",
			"imageUrl":"/frontend/Tropicoblack/ico/CreatureFromTheBlackLagoonNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CreatureFromTheBlackLagoonNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/WingsOfRichesNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Wings Of Riches",
			"imageUrl":"/frontend/Tropicoblack/ico/WingsOfRichesNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WingsOfRichesNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/ReelRush2NET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Reel Rush 2",
			"imageUrl":"/frontend/Tropicoblack/ico/ReelRush2NET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ReelRush2NET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/TheWolfsBaneNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"The Wolfs Bane",
			"imageUrl":"/frontend/Tropicoblack/ico/TheWolfsBaneNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TheWolfsBaneNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/GrandSpinnSuperpotNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Grand Spinn Superpot",
			"imageUrl":"/frontend/Tropicoblack/ico/GrandSpinnSuperpotNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GrandSpinnSuperpotNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/TurnYourFortuneNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Turn Your Fortune",
			"imageUrl":"/frontend/Tropicoblack/ico/TurnYourFortuneNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TurnYourFortuneNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/JumanjiNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Jumanji",
			"imageUrl":"/frontend/Tropicoblack/ico/JumanjiNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JumanjiNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/NarcosNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Narcos",
			"imageUrl":"/frontend/Tropicoblack/ico/NarcosNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/NarcosNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/VikingsNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Vikings",
			"imageUrl":"/frontend/Tropicoblack/ico/VikingsNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/VikingsNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/SpaceWarsNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Space Wars",
			"imageUrl":"/frontend/Tropicoblack/ico/SpaceWarsNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/SpaceWarsNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/WildWaterNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Wild Water",
			"imageUrl":"/frontend/Tropicoblack/ico/WildWaterNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildWaterNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/StarBurstNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Star Burst",
			"imageUrl":"/frontend/Tropicoblack/ico/StarBurstNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/StarBurstNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/FlowersNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Flowers",
			"imageUrl":"/frontend/Tropicoblack/ico/FlowersNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FlowersNET.jpg",
			"mobileGame": false
		},				{
			"launchUrl":"/game/FlowersChristmasNET",
			"providerId":"bomba",
			"categoryName":"1070",
			"gameName":"Flowers Christmas",
			"imageUrl":"/frontend/Tropicoblack/ico/FlowersChristmasNET.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FlowersChristmasNET.jpg",
			"mobileGame": false
		},	

//NETENT   End
//C-Technology
		{
			"launchUrl":"/game/AmericanGigoloCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"American Gigolo",
			"imageUrl":"/frontend/Tropicoblack/ico/AmericanGigoloCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AmericanGigoloCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/MegaSlot40CT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Mega Slot 40",
			"imageUrl":"/frontend/Tropicoblack/ico/MegaSlot40CT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MegaSlot40CT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/BigJokerCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Big Joker",
			"imageUrl":"/frontend/Tropicoblack/ico/BigJokerCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BigJokerCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/CloverPartyCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Clover Party",
			"imageUrl":"/frontend/Tropicoblack/ico/CloverPartyCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CloverPartyCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/FusionFruitBeatCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Fusion Fruit Beat",
			"imageUrl":"/frontend/Tropicoblack/ico/FusionFruitBeatCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FusionFruitBeatCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/WetAndJuicyCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Wet And Juicy",
			"imageUrl":"/frontend/Tropicoblack/ico/WetAndJuicyCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WetAndJuicyCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/GroovyAutomatCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Groovy Automat",
			"imageUrl":"/frontend/Tropicoblack/ico/GroovyAutomatCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/GroovyAutomatCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/MiladyX2CT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Milady X2",
			"imageUrl":"/frontend/Tropicoblack/ico/MiladyX2CT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MiladyX2CT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/ForestNymphCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Forest Nymph",
			"imageUrl":"/frontend/Tropicoblack/ico/ForestNymphCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ForestNymphCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/JadeHeavenCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Jade Heaven",
			"imageUrl":"/frontend/Tropicoblack/ico/JadeHeavenCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/JadeHeavenCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/BavarianForestCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Bavarian Forest",
			"imageUrl":"/frontend/Tropicoblack/ico/BavarianForestCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BavarianForestCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/LuckyCloverCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Lucky Clover",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyCloverCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyCloverCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/TreasureHillCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Treasure Hill",
			"imageUrl":"/frontend/Tropicoblack/ico/TreasureHillCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TreasureHillCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/Treasure40CT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Treasure 40",
			"imageUrl":"/frontend/Tropicoblack/ico/Treasure40CT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Treasure40CT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/FullOfLuckCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Full Of Luck",
			"imageUrl":"/frontend/Tropicoblack/ico/FullOfLuckCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FullOfLuckCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/BrilliantsHotCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Brilliants Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/BrilliantsHotCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BrilliantsHotCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/BananaPartyCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Banana Party",
			"imageUrl":"/frontend/Tropicoblack/ico/BananaPartyCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BananaPartyCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/FruitsOfDesireCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Fruits Of Desire",
			"imageUrl":"/frontend/Tropicoblack/ico/FruitsOfDesireCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FruitsOfDesireCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/MightyRexCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Mighty Rex",
			"imageUrl":"/frontend/Tropicoblack/ico/MightyRexCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MightyRexCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/WildCloverCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Wild Clover",
			"imageUrl":"/frontend/Tropicoblack/ico/WildCloverCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildCloverCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/ShiningTreasuresCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Shining Treasures",
			"imageUrl":"/frontend/Tropicoblack/ico/ShiningTreasuresCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ShiningTreasuresCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/ShiningJewels40CT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Shining Jewels 40",
			"imageUrl":"/frontend/Tropicoblack/ico/ShiningJewels40CT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/ShiningJewels40CT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/StarPartyCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Star Party",
			"imageUrl":"/frontend/Tropicoblack/ico/StarPartyCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/StarPartyCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/PurpleHot2CT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Purple Hot 2",
			"imageUrl":"/frontend/Tropicoblack/ico/PurpleHot2CT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PurpleHot2CT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/BeetleStarCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Beetle Star",
			"imageUrl":"/frontend/Tropicoblack/ico/BeetleStarCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BeetleStarCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/DesertTalesCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Desert Tales",
			"imageUrl":"/frontend/Tropicoblack/ico/DesertTalesCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DesertTalesCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/TreasureKingdomCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Treasure Kingdom",
			"imageUrl":"/frontend/Tropicoblack/ico/TreasureKingdomCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TreasureKingdomCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/NavyGirlCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Navy Girl",
			"imageUrl":"/frontend/Tropicoblack/ico/NavyGirlCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/NavyGirlCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/CombatRomanceCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"Combat Romance",
			"imageUrl":"/frontend/Tropicoblack/ico/CombatRomanceCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CombatRomanceCT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/EggAndRoosterCT",
			"providerId":"bomba",
			"categoryName":"1067",
			"gameName":"EggAnd Rooster",
			"imageUrl":"/frontend/Tropicoblack/ico/EggAndRoosterCT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EggAndRoosterCT.jpg",
			"mobileGame": false
		}, 
//C-Technology End
//AMATIC
		{
			"launchUrl":"/game/BlackJackAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Black Jack",
			"imageUrl":"/frontend/Tropicoblack/ico/BlackJackAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BlackJackAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/RouletteRoyalAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Roulette Royal",
			"imageUrl":"/frontend/Tropicoblack/ico/RouletteRoyalAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RouletteRoyalAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/Hot40AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot 40",
			"imageUrl":"/frontend/Tropicoblack/ico/Hot40AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Hot40AM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/Ultra7AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Ultra 7",
			"imageUrl":"/frontend/Tropicoblack/ico/Ultra7AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Ultra7AM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/Hot7AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot 7",
			"imageUrl":"/frontend/Tropicoblack/ico/Hot7AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Hot7AM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/Wild7AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Wild 7",
			"imageUrl":"/frontend/Tropicoblack/ico/Wild7AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Wild7AM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/HotTwentyAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Twenty",
			"imageUrl":"/frontend/Tropicoblack/ico/HotTwentyAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotTwentyAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/DiamondsOnFireAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Diamonds On Fire",
			"imageUrl":"/frontend/Tropicoblack/ico/DiamondsOnFireAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DiamondsOnFireAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/HotFruits20AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Fruits 20",
			"imageUrl":"/frontend/Tropicoblack/ico/HotFruits20AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotFruits20AM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/HotFruits40AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Fruits 40",
			"imageUrl":"/frontend/Tropicoblack/ico/HotFruits40AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotFruits40AM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/HotFruits100AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Fruits 100",
			"imageUrl":"/frontend/Tropicoblack/ico/HotFruits100AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotFruits100AM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/MerryFruitsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Merry Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/MerryFruitsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MerryFruitsAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/LuckyBellsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Lucky Bells",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyBellsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyBellsAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/LadyJokerAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Lady Joker",
			"imageUrl":"/frontend/Tropicoblack/ico/LadyJokerAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LadyJokerAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/KingsCrownAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Kings Crown",
			"imageUrl":"/frontend/Tropicoblack/ico/KingsCrownAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/KingsCrownAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/RedChilliAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Red Chilli",
			"imageUrl":"/frontend/Tropicoblack/ico/RedChilliAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/RedChilliAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/MagicIdolAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Magic Idol",
			"imageUrl":"/frontend/Tropicoblack/ico/MagicIdolAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagicIdolAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/TweetyBirdsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Tweety Birds",
			"imageUrl":"/frontend/Tropicoblack/ico/TweetyBirdsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/TweetyBirdsAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/HotScatterAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Scatter",
			"imageUrl":"/frontend/Tropicoblack/ico/HotScatterAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotScatterAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/MagicForestAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Magic Forest",
			"imageUrl":"/frontend/Tropicoblack/ico/MagicForestAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MagicForestAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/HotNeonAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Neon",
			"imageUrl":"/frontend/Tropicoblack/ico/HotNeonAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotNeonAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/WolfMoonAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Wolf Moon",
			"imageUrl":"/frontend/Tropicoblack/ico/WolfMoonAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WolfMoonAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/LightingHotAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Lighting Hot",
			"imageUrl":"/frontend/Tropicoblack/ico/LightingHotAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LightingHotAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/DeucesWildAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Deuces Wild",
			"imageUrl":"/frontend/Tropicoblack/ico/DeucesWildAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DeucesWildAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/MultiWinAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Multi Win",
			"imageUrl":"/frontend/Tropicoblack/ico/MultiWinAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MultiWinAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/MultiWinTripleAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Multi Win Triple",
			"imageUrl":"/frontend/Tropicoblack/ico/MultiWinTripleAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MultiWinTripleAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/BingoAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Bingo",
			"imageUrl":"/frontend/Tropicoblack/ico/BingoAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BingoAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/AllAmericanPokerAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"All American Poker",
			"imageUrl":"/frontend/Tropicoblack/ico/AllAmericanPokerAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AllAmericanPokerAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/HotScatterDiceAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot Scatter Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/HotScatterDiceAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/HotScatterDiceAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/Hot7DiceAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot 7 Dice",
			"imageUrl":"/frontend/Tropicoblack/ico/Hot7DiceAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Hot7DiceAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/WildDragonAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Wild Dragon",
			"imageUrl":"/frontend/Tropicoblack/ico/WildDragonAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildDragonAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/BellsOnFireHotAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Bells On FireHot",
			"imageUrl":"/frontend/Tropicoblack/ico/BellsOnFireHotAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BellsOnFireHotAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/FortunasFruitsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Fortunas Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/FortunasFruitsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/FortunasFruitsAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/WildSharkAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Wild Shark",
			"imageUrl":"/frontend/Tropicoblack/ico/WildSharkAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WildSharkAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/BlueDolphinAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Blue Dolphin",
			"imageUrl":"/frontend/Tropicoblack/ico/BlueDolphinAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BlueDolphinAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/MermaidsGoldAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Mermaids Gold",
			"imageUrl":"/frontend/Tropicoblack/ico/MermaidsGoldAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/MermaidsGoldAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/LuckyCoinAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Lucky Coin",
			"imageUrl":"/frontend/Tropicoblack/ico/LuckyCoinAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LuckyCoinAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/DragonsPearlAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Dragons Pearl",
			"imageUrl":"/frontend/Tropicoblack/ico/DragonsPearlAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DragonsPearlAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/LovelyLadyAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Lovely Lady",
			"imageUrl":"/frontend/Tropicoblack/ico/LovelyLadyAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/LovelyLadyAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/CoolDiamonds2AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Cool Diamonds2",
			"imageUrl":"/frontend/Tropicoblack/ico/CoolDiamonds2AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/CoolDiamonds2AM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/EyeOfRaAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Eye Of Ra",
			"imageUrl":"/frontend/Tropicoblack/ico/EyeOfRaAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EyeOfRaAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/AllWaysFruitsAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"All Ways Fruits",
			"imageUrl":"/frontend/Tropicoblack/ico/AllWaysFruitsAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AllWaysFruitsAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/AllWaysWinAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"All Ways Win",
			"imageUrl":"/frontend/Tropicoblack/ico/AllWaysWinAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AllWaysWinAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/Hot81AM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Hot 81",
			"imageUrl":"/frontend/Tropicoblack/ico/Hot81AM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/Hot81AM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/PartyNightAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Party Night",
			"imageUrl":"/frontend/Tropicoblack/ico/PartyNightAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PartyNightAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/PartyTimeAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Party Time",
			"imageUrl":"/frontend/Tropicoblack/ico/PartyTimeAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/PartyTimeAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/EnchantedCleopatraAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Enchanted Cleopatra",
			"imageUrl":"/frontend/Tropicoblack/ico/EnchantedCleopatraAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/EnchantedCleopatraAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/BellsOnFireRomboAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Bells On Fire Rombo",
			"imageUrl":"/frontend/Tropicoblack/ico/BellsOnFireRomboAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BellsOnFireRomboAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/DragonsGiftAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Dragons Gift",
			"imageUrl":"/frontend/Tropicoblack/ico/DragonsGiftAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/DragonsGiftAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/AdmiralNelsonAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Admiral Nelson",
			"imageUrl":"/frontend/Tropicoblack/ico/AdmiralNelsonAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/AdmiralNelsonAM.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/BellsOnFireAM",
			"providerId":"bomba",
			"categoryName":"1065",
			"gameName":"Bells On Fire",
			"imageUrl":"/frontend/Tropicoblack/ico/BellsOnFireAM.jpg",
			"data-src":"/frontend/Tropicoblack/ico/BellsOnFireAM.jpg",
			"mobileGame": false
		}, 
//AMATIC  END
		
		
		{
			"launchUrl":"/game/WerewolfWildAT",
			"providerId":"bomba",
			"categoryName":"0000",
			"gameName":"KingAndQueen",
			"imageUrl":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/WerewolfWildAT",
			"providerId":"bomba",
			"categoryName":"0000",
			"gameName":"KingAndQueen",
			"imageUrl":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/WerewolfWildAT",
			"providerId":"bomba",
			"categoryName":"0000",
			"gameName":"KingAndQueen",
			"imageUrl":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/WerewolfWildAT",
			"providerId":"bomba",
			"categoryName":"0000",
			"gameName":"KingAndQueen",
			"imageUrl":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/WerewolfWildAT",
			"providerId":"bomba",
			"categoryName":"0000",
			"gameName":"KingAndQueen",
			"imageUrl":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"mobileGame": false
		}, {
			"launchUrl":"/game/WerewolfWildAT",
			"providerId":"bomba",
			"categoryName":"0000",
			"gameName":"KingAndQueen",
			"imageUrl":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"data-src":"/frontend/Tropicoblack/ico/WerewolfWildAT.jpg",
			"mobileGame": false
		}





		
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
