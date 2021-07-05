<!DOCTYPE HTML>
<html lang="en">
<head>
 <title>{{ $game->title }}</title>
<base href="/games/{{ $game->name }}/amarent/">
<script>

document.cookie = 'phpsessid=; Max-Age=0; path=/; domain=' + location.host; 
document.cookie = 'PHPSESSID=; Max-Age=0; path=/; domain=' + location.host;

    if( !sessionStorage.getItem('sessionId') ){
        sessionStorage.setItem('sessionId', parseInt(Math.random() * 1000000));
    }







		
		if(document.location.href.split("?")[1]==undefined){
		document.location.href=document.location.href+'/?curr=@if( auth()->user()->present()->shop ){{ auth()->user()->present()->shop->currency }}@endif&lang=en&w=&lang=en';	
		}
		
		addEventListener('message',function(ev){
	
if(ev.data=='CloseGame'){
var isFramed = false;
try {
	isFramed = window != window.top || document != top.document || self.location != top.location;
} catch (e) {
	isFramed = true;
}

if(isFramed ){
window.parent.postMessage('CloseGame',"*");	
}
document.location.href='../../../';	
}
	
	});
	
</script>
	<meta charset="UTF-8"/>
	<meta http-equiv="Cache-Control" content="no-transform"/>
	<meta http-equiv="expires" content="0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0"/>
	<link media="screen" href="game_7.css" type= "text/css" rel="stylesheet"/>
</head>
<body>	
    <div id="gameArea">
		<canvas id="canvas"></canvas>
		<div id="gameOverlay">
			<div id="gamerules">
				<div id="gamerules_div">
				</div>
			</div>
			<div id="jurisdictionDiv">
				<button id="btnsp" class="buttonPause"></button>
				<button id="btnsl" class="buttonLimit"></button>
				<button id="btnst" class="buttonTest"></button>
			</div>
			<div id="notificationDiv">
				<p id="notificationTitle"></p>
				<p id="notificationText"></p>
				<div id="notificationIcon">
					<p id="notificationCounter"></p>
				</div>
			</div>
			<div id="messageOverlay">
				<div id="messagePanel">
					<h4 id="messageTitle"></h4>
					<p id="messageText"></p>
					<button id="btne" class="messageTopbutton"></button>
					<button id="btn1" class="messageButton"></button>
					<button id="btn2" class="messageButton"></button>
					<button id="btn3" class="messageButton"></button>
					<button id="btn4" class="messageButton"></button>
				</div>
			</div>
		</div>
	</div>
	<div id="slideUpOverlay">
		<div id="slideUp">
			<div id="slideElem1"></div>
			<div id="slideElem2"></div>
		</div>
	</div>
	<div id="loading">
	</div>
	<script type="text/javascript" src="./src/firequeenloader_0027780.js"></script>
</body>
</html>