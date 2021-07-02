<meta charset="UTF-8">
<title>Jack Pot</title>
<link rel="stylesheet" href="/global/jp/css/odometer-theme-default.css">
<link rel="stylesheet" href="/global/jp/css/plazma_video_animations_style.css">
<script src="/global/jp/js/config.js"></script>
<script src="/global/jp/js/odometer.js"></script>
<script src="/global/jp/js/jquery.js"></script>
<style>
    .jackpot01 {
		
    position: relative;
    top: 16.5%;
    left: -10%;
    font-size: 135px;
	font-weight: 600;
   color: #f00;
    padding-left: 20%;
	 opacity: 0.9;
    }

    .jackpot02 {
    position: relative;
    top: 16.5vw;
    left: -10%;
    font-size: 135px;
	font-weight: 600;
    color: #56ff00;
    padding-left: 20%;
    opacity: 0.7;
    }

    .jackpot03 {
    position: absolute;
    top: 70%;
    left: -6%;
    font-size: 100px;
	color: #2196f3;
    padding-left: 20%;
	 opacity: 0.9;
    }

    .jackpot04 {
    position: absolute;
    top: 70%;
    left: 44%;
    font-size: 100px;
	color: #ffeb3b;
    padding-left: 20%;
	 opacity: 0.9;
    }

    .jackpot05 {
        font-size: 0;
        top: 70%;
        right: 0;
		display: none;
        padding-right: 25%;
    }

    .jackpot06 {
        font-size: 0;
        top: 86.5%;
        right: 0;
        padding-right: 25%;
    }

    #win-amount {
        top: 57.5%;
        left: 0;
        font-size: 140px;
    }

    #winner-id {
        top: 86.5%;
        left: 0;
        font-size: 50px;
        height: 10%;
    }
    #winner-id #win-id-odometer{
        top: 25%;
    }

    .community_sign_1,
    .community_sign_2,
    .community_sign_3 {
        width: 85% !important;
        height: 154px;
        display: block;
        position: absolute;
        z-index: 20;
        text-align: center;
        margin-top: -30px;
    }
    .community_sign_2 {
        margin-top: -32px;
    }
    .community_sign_3 {
        margin-top: -34px;
    }
</style>
<div id="progress-bar">
    <div></div>
</div>
<div id="jackpot-wrapper">
    <div id="video-wrapper"></div>

    <div id="jackpot_01" class="jackpot jackpot01" data-group="1">
        <div class="odometer jackpot01"></div>
    </div>

    <div id="jackpot_02" class="jackpot" data-group="1">
        <div class="odometer jackpot02"></div>
    </div>

    <div id="jackpot_03" class="jackpot" data-group="1">
        <div class="odometer jackpot03"></div>
    </div>

    <div id="jackpot_04" class="jackpot" data-group="1">
        <div class="odometer jackpot04"></div>
    </div>

    <div id="jackpot_05" class="jackpot" data-group="1">
        <div class="odometer jackpot05"></div>
    </div>

    <div id="jackpot_06" class="jackpot" data-group="1">
        <div class="odometer jackpot06"></div>
    </div>

    <div id="win-amount" class="win" data-group="1">
        <div id="win-odometer"></div>
    </div>

    <div id="winner-id" class="win" data-group="1">
        <div id="win-id-odometer"></div>
    </div>

</div>
<div id="password-wrapper" style="display: none">
    <div>
        <label>
            <span id='pwd'></span>
            <input type="password" id="password-input">
        </label>
    </div>
    <div>
        <button id="proceed-btn"></button>
    </div>
</div>

<script>
    var main_video = '/global/jp/main_animation.ogv';
    var hit_jackpots_videos = ['/global/jp/diamond_hit.ogv'];
    var id = 4

    function resizeFonts(communities) {
        $('#jackpot_01').css({'font-size': ( $(window).height() * 0.12133 ) + 'px'});
        $('#jackpot_02').css({'font-size': ( $(window).height() * 0.10616) + 'px'});
        $('#jackpot_03').css({'font-size': ( $(window).height() * 0.091) + 'px'});
        $('#jackpot_04').css({'font-size': ( $(window).height() * 0.0829) + 'px'});
        $('#jackpot_05').css({'font-size': ( $(window).height() * 0.0829) + 'px'});
        $('#jackpot_06').css({'font-size': ( $(window).height() * 0.0788) + 'px'});

        $('#win-amount').css({'font-size': ( $(window).height() * 0.14155) + 'px'});
        $('#winner-id').css({'font-size': ( $(window).width() * 0.02604) + 'px'});

        setTimeout(function() {
            for (var i=1, w=0, h=0, d; i<=3; i++) {
                d = $('#jackpot_0' + i);
                w = d.find('.odometer').width();
                h = (d.find('.odometer-value img').length ? d.find('.odometer-value img').height() : d.find('.odometer-value').height()) + 15;
                if (communities != undefined) {
                    if ($.inArray(i, communities) >= 0 && !d.find('.community_sign_' + i).length) {
                        $('<div class="community_sign_' + i + '"></div>').prependTo(d).css({'width': w + 'px', 'height': h + 'px'});
                    }
                } else if (d.find('.community_sign_' + i).length) {
                    $('.community_sign_' + i).css({'width': w + 'px', 'height': h + 'px'});
                }
            }
        }, 100);
    }
</script>
<script src="/global/jp/js/plazma_video_animations_handler.js"></script>
<script>initAll();</script>