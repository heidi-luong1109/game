<!DOCTYPE html>
<html>
<head>
    <title><?php echo e($game->title); ?></title>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">
      <style>
         body,
         html {
         position: fixed;
         } 
      </style>
   </head>

<script>

    if( !sessionStorage.getItem('sessionId') ){
        sessionStorage.setItem('sessionId', parseInt(Math.random() * 1000000));
    }


addEventListener('message',function(ev){
	
if(ev.data=='CloseGame'){

document.location.href='../../';	
}
	
	});
</script>

<body style="margin:0px;width:100%;background-color:black;overflow:hidden">



<iframe id='game' style="margin:0px;border:0px;width:100%;height:100vh;" src='/games/Dragons888PM/index.html?lang=en&cur=<?php if( auth()->user()->present()->shop ): ?><?php echo e(auth()->user()->present()->shop->currency); ?><?php endif; ?>&gameSymbol=vs1dragon8&websiteUrl=&lobbyURL=' allowfullscreen>


</iframe>




</body>

</html>
    <style>
	.exit {
	background: rgba(0, 0, 0, 0.5);
    border: 1px solid white;
    border-radius: 5px;
    left: 4px;
    top: 4px;
    width: 70px;
    height: 25px;
    position: fixed;
    z-index: 1000;
    text-align: center;
    font-size: 22px;
    color: white;
    font-family: sans-serif;
	text-decoration: none;
    padding-top: 0px;
    cursor: pointer;
	z-index:9999;
	}
	
	</style>
	<button class="exit" onclick="goBack()">EXIT</button>

<script>
function goBack() {
  window.history.back();
}
</script>
<?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/frontend/games/list/Dragons888PM.blade.php ENDPATH**/ ?>