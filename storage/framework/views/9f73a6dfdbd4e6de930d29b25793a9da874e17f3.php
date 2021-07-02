<?php $__env->startSection('page-title', $title); ?>

<?php $__env->startSection('content'); ?>

		
						<?php
							$return = \VanguardLTE\Returns::where('shop_id', Auth::user()->shop_id)->first();
                            $pincodes = \VanguardLTE\Pincode::where(['shop_id' => Auth::user()->shop_id, 'status' => 1, 'activated_at' => null])->count();
							$happyhour = \VanguardLTE\HappyHour::where(['shop_id' => auth()->user()->shop_id, 'time' => date('G'), 'status' => 1])->first();
							if(!$happyhour){
								$happyhour = \VanguardLTE\HappyHour::where(['shop_id' => auth()->user()->shop_id, 'status' => 1])->where('time', '>',date('G'))->first();
							}
							if(!$happyhour){
								$happyhour = \VanguardLTE\HappyHour::where(['shop_id' => auth()->user()->shop_id, 'status' => 1])->first();
							}
						?>
  </div>
  <!--div class="phone-rotate">
    <div class="section"><img src="/frontend/Grandx/images/rotate.gif" width="403"></div>
  </div>

   <!--script>// Find the right method, call on correct element
function launchFullScreen(element) {
  if(element.requestFullScreen) {
    element.requestFullScreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.webkitRequestFullScreen) {
    element.webkitRequestFullScreen();
  }
}

// Launch fullscreen for browsers that support it!
launchFullScreen(document.documentElement); // the whole page
launchFullScreen(document.getElementById("videoElement")); // any individual element
   </script>
   <script>
   addEventListener("click", function() {
    var
          el = document.documentElement
        , rfs =
               el.requestFullScreen
            || el.webkitRequestFullScreen
            || el.mozRequestFullScreen
    ;
    rfs.call(el);
});
</script-->

<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #000;
                color: #333;
               
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
                background-color: #000;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>
    </head>

</html>

<!DOCTYPE html>
<html>
<body>


<iframe id="" src="../frontend/Grandx/vegas.php" style="position:absolute; left:5;width:100%; color: #000;height:95%;border:0;z-index:1;"></iframe>


<script>
function myFunction() {
  var x = document.getElementById("myframe").src;
  document.getElementById("demo").innerHTML = x;
}
</script>

</body>
</html>

            <div data-ix="roll-down-jp-1" id="jp1" style="left: 27%;
    position: fixed;
    top: 3%;
    text-align: center;
    font-size: 1.5vw;
	font-family:Big daddy led tfb;
	font-weight:600;
    color: #ffa500;
	z-index:9;"><span style="color:#fff;font-weight: bold;" class="">
								            <?php if( count($jpgs) > 1 ): ?>
									            <?php echo e(number_format ($jpgs[1]->balance, 2,".","")); ?>

								            <?php endif; ?>											
											</span>
											<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
					<script>
					setInterval(function(){$("#jp1").load("/index.php #jp1")},2000)
					</script></div>
            <div data-ix="roll-down-jp-2" id="jp2" style="left: 47%;
    position: fixed;
    top: 3%;
    text-align: center;
    font-size: 1.5vw;
	font-family:Big daddy led tfb;
	font-weight:600;
    color: #ffa500;
	z-index:9;"><span style="color:#eee;font-weight: bold;" class="">
								            <?php if( count($jpgs) > 2 ): ?>
									            <?php echo e(number_format ( $jpgs[2]->balance, 2,".","")); ?>

								            <?php endif; ?>											
											</span>
																<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
					<script>
					setInterval(function(){$("#jp2").load("/index.php #jp2")},2000)
					</script>					
					</div></div>
            <div data-ix="roll-down-jp-3" id="jp3" style="right: 25%;
    position: fixed;
    top: 3%;
    text-align: center;
    font-size: 1.5vw;
	font-family:Big daddy led tfb;
	font-weight:600;
    color: #ffa500;
	z-index:9;">><span style="color:#ffeb3b;font-weight: bold" class="">
								            <?php if( count($jpgs) > 3 ): ?>
									            <?php echo e(number_format ( $jpgs[3]->balance, 2,".","")); ?>

								            <?php endif; ?>											
											</span>
											<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
					<script>
					setInterval(function(){$("#jp3").load("/index.php #jp3")},2000)
					</script></div>
			 <div data-ix="roll-down-jp-4" id="jp4" style="right: 4%;
    position: fixed;
    top: 3%;
    text-align: center;
    font-size: 1.5vw;
	font-family:Big daddy led tfb;
	font-weight:600;
    color: #ffa500;
	z-index:9;"><span style="color:#ff6838;font-weight: bold" class="">
								            <?php if( count($jpgs) > 4 ): ?>
									            <?php echo e(number_format ( $jpgs[4]->balance, 2,".","")); ?>

								            <?php endif; ?>											
											</span>
											<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
					<script>
					setInterval(function(){$("#jp4").load("/index.php #jp4")},2000)
					</script></div>
          </div>

        <div class="div-logo-page"><img src="" width="1" class="image-2"></div>
        <h3 class="footr-down select-game"></h3>
        <div class="footer-slider">
          <div class="div-btn-exit-user">
		  <div>
<html>
<body>


<input type="search" id="mySearch" class="search" placeholder=" ">


<p id="demo"></p>

<script>
function myFunction() {
  var x = document.getElementById("mySearch").placeholder;
  document.getElementById("demo").innerHTML = x;
}
</script>

</body>
</html>


<script>
function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  
  document.getElementById('txt').innerHTML =
  h + ":" + m ;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>
<body onload="startTime()" >

<div id="txt"class="time"></div>
            <div id="gredit" class="text-gredit"></div>
			<footer class="footer">
		<div class="container">
			<div class="footer__block">
				<div class="footer__left">
					<?php if( $return && auth()->user()->present()->count_return > 0 && auth()->user()->present()->balance <= $return->min_balance ): ?>
					<a href="#" data-name="modal-bonus" class="gift" id="returns">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
					<script>
					setInterval(function(){$("#returns").load("/index.php #returns")},2000)
					</script>	
					</a>
					<?php endif; ?>
					
					<span style="right: 9%;
    position: fixed;
    bottom: 9%;
    text-align: center;
    font-size: 2vw;
	font-weight:600z;
    color: #ffa500;"><em></em> <?php echo e(Auth::user()->username); ?></span>
				</div>
				<div class="">
					<div class="">
						<span style="    left: 4%;
    position: fixed;
    bottom: 3.0%;
    text-align: center;
    font-size: 2.2vw;
    font-weight:600;
    color: #fff;" id="balanceValue"><?php echo e(number_format(Auth::user()->balance, 2,".","")); ?> <em><?php if( auth()->user()->present()->shop ): ?>  <?php endif; ?></em></span>
					
					
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
					<script>
					setInterval(function(){$("#balanceValue").load("/index.php #balanceValue")},2000)
					</script>					
					</div>
					<span  style="    left: 16vw;
    position: fixed;
    bottom: 2.0%;
    text-align: center;
    font-size: 1.2vw;
    font-weight:600;
    color: #fff;
}" id="povracaj"><?php echo e(number_format(Auth::user()->count_return, 2,".","")); ?> <?php if( auth()->user()->present()->shop ): ?><?php echo e(auth()->user()->present()->shop->currenc); ?><?php endif; ?></em></span>
	
					
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
					<script>
					setInterval(function(){$("#povracaj").load("/index.php #povracaj")},2000)
					</script>		

          </div>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">





    <!--a href="/frontend/Grandx/allgames.php"><img src="/frontend/Grandx/images/allgames0.png" class="button"></a></div>
	<a href="/frontend/Grandx/amatic.php"><img src="/frontend/Grandx/images/amatic0.png" class="button1"></a></div>
	<a href="/frontend/Grandx/table.php"><img src="/frontend/Grandx/images/table0.png" class="button2"></a></div>
	<a href="/frontend/Grandx/novomatic.php"><img src="/frontend/Grandx/images/novomatic0.png" class="button4"></a></div>
	<a href="#"><img src="/frontend/Grandx/images/egt1.png" class="button5"></a></div>
	<a href="/frontend/Grandx/wazdan.php"><img src="/frontend/Grandx/images/wazdan0.png" class="button6"></a></div-->

          </div>
		  		          </div>

<style>
.logput {
    position: fixed;
    right: 24%;
    bottom: 1%;
    width: 12%;
    height: 8%;
    border: 1px none #fff;
    background-size: 7vw auto;
    background-image: url(../images/logout.png);
    background-repeat: no-repeat;
    cursor: pointer;
    z-index: 9999;
	}
.logput:hover {
	color:#fff;
    opacity:0.5;
    z-index: 99999;
	}
</style>	
<style>
.skype {
    position: fixed;
    right: 37%;
    bottom: 2.5%;
    width: 4%;
    height: 4%;
    border: 1px none #fff;
    background-size: 7vw auto;
    background-image: url(../skype.png);
    background-repeat: no-repeat;
    cursor: pointer
	opacity:0.1;
    z-index: 9999;
	}
.skype:hover {
	width: 4.2%;
    height: 4.2%;
    opacity:0.6;
    z-index: 99999;
	}
</style>					  
						  
			            <a href="../logout"><img src="../frontend/Grandx/images/logout.png" class="logput"></a></div>
						<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.dropbtn {
background-image: url(../frontend/Grandx/skype1.png);
position: fixed;
    right: 38%;
    bottom: 1%;
    width: 3%;
    height: 7%;
    border: 1px none #fff;
    background-size: 100%;
	background-repeat: no-repeat;
}

.dropdown {
  position: relative;
left:-220%
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  left:-170%;
  top: -50px;
max-width: 200px;
  font-size:20px;
  bottom:100px;
 z-index: 1;
}

.dropdown-content a {
  text-decoration: none;
  display: block;
}


.dropdown:hover .dropdown-content {display: block; color:fff;}
</style>
</head>
<body>

<div class="dropdown">
  <a class="dropbtn"></a>
  <div class="dropdown-content">
    <a style="color:#ffffff">&nbsp;skype name<br><br>grandx1 malta</a>
</div>

</body>
</html>
						
						<img src="../frontend/Grandx/images/jpglobal.png" style="position: fixed;
    right: 0%;
    top: 0%;
    width: 100%;
    height: 9%;
    border: 1px none #fff;
    background-size: 7vw auto;
    pointer-events: none;
    z-index: 9999;"></a></div>
	
					          <img src="../frontend/Grandx/images/donja.png" style="position: fixed;
    right: 0%;
    bottom: 0%;
    width: 104%;
    height: 15%;
    border: 1px none #fff;
    background-size: 7vw auto;
    z-index: -2;"></a></div>

		
            </div>


</div>

		
			<html>


</body>
          <div class="div-main-button-cat-footer">
            <!--div class="div-batton-category"><a href="#" class="link-block w-inline-block"><img src="images/ALL-GAME-3.png" class="btn-all-game img-btn-cat"></a></div>
            <div class="btn-cat-02 div-batton-category"><a href="lobby-page/Grandx.php" class="w-inline-block"><img src="images/Grandx-3.png" class="img-btn-cat"></a></div>
            <div class="btn-cat-03 div-batton-category"><a href="lobby-page/novomatic.php" class="w-inline-block"><img src="images/NOVOMATIC-5.png" class="img-btn-cat"></a></div>
            <div class="btn-cat-04 div-batton-category"><a href="lobby-page/netent.php" class="w-inline-block"><img src="images/NETENT-3.png" class="img-btn-cat"></a></div>
            <div class="btn-cat--5 div-batton-category"><a href="lobby-page/gaminator.php" class="w-inline-block"><img src="images/gaminator.png" class="img-btn-cat"></a></div>
            <div class="btn-cat---6 div-batton-category"><a href="lobby-page/slots.php" class="w-inline-block"><img src="images/SLOTS-2.png" class="img-btn-cat"></a></div>
            <div class="btn-cat---7 div-batton-category"><a href="lobby-page/casino.php" class="w-inline-block"><img src="images/CASINO-2.png" class="img-btn-cat"></a></div-->
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" type="text/javascript"></script>
  <script src="/frontend/Grandx/js/kzr-dd-tronic.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  <!-- ///////////////--Footer Code---//////////////////////-- -->



						<!-- GAMES - BEGIN -->
				<?php if($games && count($games)): ?>
					<?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						
						
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
						<!-- GAMES - BEGIN -->
					</div>
			</div>
			<!-- SLIDER - END -->
		</div>
	</main>

	<footer class="footer">
		<div class="container">
			<div class="footer__block">
				<div class="footer__left">
					<?php if( $return && auth()->user()->present()->count_return > 0 && auth()->user()->present()->balance <= $return->min_balance ): ?>
					<a href="#" data-name="modal-bonus" class="gift" id="returns">
						<img src="/frontend/Default/img/_src/gift-active.png" alt="" style="position: fixed;
    width: 3%;
    bottom: 1%;
    left: 23%;
    z-index: 1;" id="paketic" class="gift-icon active">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
					<script>
					setInterval(function(){$("#paketic").load("/index.php #paketic")},3000)
					</script>
					</a>
					<?php endif; ?>
					<!--
					<a href="#" class="wheel">
						<img src="/frontend/Default/img/_src/wheel-active.png" alt="" class="gift-icon active">
						<img src="/frontend/Default/img/_src/wheel.png" alt="" class="gift-icon disabled">
					</a>
					-->



	</footer>
	<div class="overlay"></div>
	<div class="modal modal-bonus" >
		<div class="modal__block">
			<h3 class="modal__title">Cash Back Bonus</h3>
			<p class="modal__text cashBankText"></p>
		</div>
		
	</div>

	<!-- /.MAIN -->

	<script type="text/javascript">


		$('body').on('click', '#send', function(event){
			var pincode = $('#inputPin').val();
			$.ajax({
				url: "<?php echo e(route('frontend.profile.pincode')); ?>",
				type: "GET",
				data: {pincode : pincode},
				dataType: "json",
				success: function(data){
					if( data.fail ){
						$('#error').html('<br>' + data.error);
					}
					if( data.success ){
						window.location.reload();
					}
				}
			});
		});


		$(document).on('click', '#returns', function(e) {
			e.preventDefault();
			$.get('<?php echo e(route('frontend.profile.returns')); ?>', function(data) {
				if (data.success) {
					$('.cashBankText').html('<?php echo app('translator')->get('app.your_cash_back_bonus'); ?> <b>' + data.value + ' '+ data.currency +'</b> <?php echo app('translator')->get('app.has_been_added_to_the_balance'); ?>. <br /><?php echo app('translator')->get('app.have_a_good_game_in'); ?> <b><?php echo e(config('app.name')); ?></b>.');
					$("div.modal-bonus").addClass("active");
					$(".overlay").fadeIn();
					$('.balanceValue').text(data.balance + ' ' + data.currency);
					$('.count_return').text(data.count_return + ' ' + data.currency);
					$('#balanceValue').html(data.balance + '&ensp;<em>'+ data.currency +'</em>');

					$('#returns').remove();
				}
				if (data.fail) {
					$.modal(data.text);
				}
			}, 'json');
		});

		setInterval(function(){
			$.get('<?php echo e(route('frontend.profile.jackpots')); ?>', function(data) {
				if( data.length >= 7 ){
					for(var i=0; i<7; i++){
						$('.jackpot' + i).text((data[i]['balance']));
					}
				}
			});
		}, 5000);

		$(document).on('keyup', '#search', function() {
			var query = $(this).val().toLowerCase();
			doSearch(query);
		});

		function OnSearch(input) {
			var query = input.value.toLowerCase();
			doSearch(query);
		}

		function doSearch(query){
			$(".games__item").each(function(event) {
				var name = $(this).data('name').toLowerCase();
				var title = $(this).data('title').toLowerCase();
				var item = $( this ).parents('.grid-item');
				if(query){
					if (name.search(query) != -1 || title.search(query) != -1){
						item.css('display', 'inherit')
					} else{
						item.css('display', 'none')
					}
				} else{
					item.css('display', 'inherit')
				}
			});
		}


	</script>
<!--meta http-equiv="refresh" content="10; url='http://mycasinoch.com'" /-->	

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.Grandx.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/frontend/Grandx/games/list.blade.php ENDPATH**/ ?>