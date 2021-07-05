<?php 
namespace VanguardLTE\Games\NarcosNET
{
    include('CheckReels.php');
    class Server
    {
        public function get($request, $game)
        {
            /*if( config('LicenseDK.APL_INCLUDE_KEY_CONFIG') != 'wi9qydosuimsnls5zoe5q298evkhim0ughx1w16qybs2fhlcpn' ) 
            {
                return false;
            }
            if( md5_file(base_path() . '/app/Lib/LicenseDK.php') != '3c5aece202a4218a19ec8c209817a74e' ) 
            {
                return false;
            }
            if( md5_file(base_path() . '/config/LicenseDK.php') != '951a0e23768db0531ff539d246cb99cd' ) 
            {
                return false;
            }
            $checked = new \VanguardLTE\Lib\LicenseDK();
            $license_notifications_array = $checked->aplVerifyLicenseDK(null, 0);
            if( $license_notifications_array['notification_case'] != 'notification_license_ok' ) 
            {
                $response = '{"responseEvent":"error","responseType":"error","serverResponse":"Error LicenseDK"}';
                exit( $response );
            }*/
            \DB::beginTransaction();
            $userId = \Auth::id();
            if( $userId == null ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid login"}';
                exit( $response );
            }
            $slotSettings = new SlotSettings($game, $userId);
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = $_GET;
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * $slotSettings->CurrentDenom * 100);
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = '';
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'freespin' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] = 'spin';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'init' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'reloadbalance' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] = 'init';
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'init';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'paytable' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'paytable';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'initfreespin' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'initfreespin';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'respin' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'respin';
            }
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination']) && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'] >= 1 ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'] / 100;
                $slotSettings->CurrentDenom = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                $slotSettings->CurrentDenomination = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                $slotSettings->SetGameData($slotSettings->slotId . 'GameDenom', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination']);
            }
            else if( $slotSettings->HasGameData($slotSettings->slotId . 'GameDenom') ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'] = $slotSettings->GetGameData($slotSettings->slotId . 'GameDenom');
                $slotSettings->CurrentDenom = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                $slotSettings->CurrentDenomination = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' ) 
            {
                if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_betlevel']) ) 
                {
                    $response = '{"responseEvent":"error","responseType":"bet","serverResponse":"invalid bet request"}';
                    exit( $response );
                }
                $lines = 20;
                $betline = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_betlevel'];
                if( $lines <= 0 || $betline <= 0.0001 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bet state"}';
                    exit( $response );
                }
                if( $slotSettings->GetBalance() < ($lines * $betline) ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid balance"}';
                    exit( $response );
                }
            }
            if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                exit( $response );
            }
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = (string)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'];
            switch( $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 ) 
            {
                case 'init':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WalkingWild', []);
                    $freeState = '';
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $freeState = $lastEvent->serverResponse->freeState;
                        $reels = $lastEvent->serverResponse->reelsSymbols;
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '&rs.i0.r.i0.syms=SYM' . $reels->reel1[0] . '%2CSYM' . $reels->reel1[1] . '%2CSYM' . $reels->reel1[2] . '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.syms=SYM' . $reels->reel2[0] . '%2CSYM' . $reels->reel2[1] . '%2CSYM' . $reels->reel2[2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.syms=SYM' . $reels->reel3[0] . '%2CSYM' . $reels->reel3[1] . '%2CSYM' . $reels->reel3[2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.syms=SYM' . $reels->reel4[0] . '%2CSYM' . $reels->reel4[1] . '%2CSYM' . $reels->reel4[2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.syms=SYM' . $reels->reel5[0] . '%2CSYM' . $reels->reel5[1] . '%2CSYM' . $reels->reel5[2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i0.syms=SYM' . $reels->reel1[0] . '%2CSYM' . $reels->reel1[1] . '%2CSYM' . $reels->reel1[2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i1.syms=SYM' . $reels->reel2[0] . '%2CSYM' . $reels->reel2[1] . '%2CSYM' . $reels->reel2[2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i2.syms=SYM' . $reels->reel3[0] . '%2CSYM' . $reels->reel3[1] . '%2CSYM' . $reels->reel3[2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i3.syms=SYM' . $reels->reel4[0] . '%2CSYM' . $reels->reel4[1] . '%2CSYM' . $reels->reel4[2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i4.syms=SYM' . $reels->reel5[0] . '%2CSYM' . $reels->reel5[1] . '%2CSYM' . $reels->reel5[2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i0.pos=' . $reels->rp[0]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.pos=' . $reels->rp[0]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.pos=' . $reels->rp[0]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.pos=' . $reels->rp[0]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.pos=' . $reels->rp[0]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i0.pos=' . $reels->rp[0]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i1.pos=' . $reels->rp[0]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i2.pos=' . $reels->rp[0]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i3.pos=' . $reels->rp[0]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i4.pos=' . $reels->rp[0]);
                    }
                    else
                    {
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '&rs.i0.r.i0.syms=SYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.syms=SYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.syms=SYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.syms=SYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.syms=SYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '%2CSYM' . rand(1, 7) . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i0.pos=' . rand(1, 10));
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.pos=' . rand(1, 10));
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.pos=' . rand(1, 10));
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.pos=' . rand(1, 10));
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.pos=' . rand(1, 10));
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i0.pos=' . rand(1, 10));
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i1.pos=' . rand(1, 10));
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i2.pos=' . rand(1, 10));
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i3.pos=' . rand(1, 10));
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i4.pos=' . rand(1, 10));
                    }
                    for( $d = 0; $d < count($slotSettings->Denominations); $d++ ) 
                    {
                        $slotSettings->Denominations[$d] = $slotSettings->Denominations[$d] * 100;
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                    {
                        $freeState = 'rs.i4.id=basicwalkingwild&rs.i2.r.i1.hold=false&rs.i1.r.i0.syms=SYM8%2CSYM3%2CSYM7&rs.i2.r.i4.overlay.i0.pos=42&gameServerVersion=1.21.0&g4mode=false&freespins.win.coins=0&historybutton=false&rs.i0.r.i4.hold=false&gameEventSetters.enabled=false&next.rs=freespin&gamestate.history=basic%2Cfreespin&rs.i0.r.i14.syms=SYM30&rs.i1.r.i2.hold=false&rs.i1.r.i3.pos=0&rs.i0.r.i1.syms=SYM30&rs.i0.r.i5.hold=false&rs.i0.r.i7.pos=0&rs.i2.r.i1.pos=53&game.win.cents=300&rs.i4.r.i4.pos=65&staticsharedurl=https%3A%2F%2Fstatic-shared.casinomodule.com%2Fgameclient_html%2Fdevicedetection%2Fcurrent&bl.i0.reelset=ALL&rs.i1.r.i3.hold=false&totalwin.coins=60&gamestate.current=freespin&freespins.initial=10&rs.i4.r.i0.pos=2&rs.i0.r.i12.syms=SYM30&jackpotcurrency=%26%23x20AC%3B&rs.i4.r.i0.overlay.i0.row=1&bet.betlines=243&walkingwilds.pos=0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0&rs.i3.r.i1.hold=false&rs.i2.r.i0.hold=false&rs.i0.r.i0.syms=SYM30&rs.i0.r.i3.syms=SYM30&rs.i1.r.i1.syms=SYM3%2CSYM9%2CSYM12&rs.i1.r.i1.pos=0&rs.i3.r.i4.pos=0&freespins.win.cents=0&isJackpotWin=false&rs.i0.r.i0.pos=0&rs.i2.r.i3.hold=false&rs.i2.r.i3.pos=49&freespins.betlines=243&rs.i0.r.i9.pos=0&rs.i2.r.i4.overlay.i0.type=transform&rs.i4.r.i2.attention.i0=1&rs.i0.r.i1.pos=0&rs.i4.r.i4.syms=SYM5%2CSYM0%2CSYM7&rs.i1.r.i3.syms=SYM3%2CSYM9%2CSYM12&rs.i2.r.i4.hold=false&rs.i3.r.i1.pos=0&rs.i2.id=freespin&game.win.coins=60&rs.i1.r.i0.hold=false&denomination.last=0.05&rs.i0.r.i5.syms=SYM30&rs.i0.r.i1.hold=false&rs.i0.r.i13.pos=0&rs.i0.r.i13.hold=false&rs.i2.r.i1.syms=SYM12%2CSYM8%2CSYM7&rs.i0.r.i7.hold=false&rs.i2.r.i4.overlay.i0.with=SYM1&clientaction=init&rs.i0.r.i8.hold=false&rs.i4.r.i0.hold=false&rs.i0.r.i2.hold=false&rs.i4.r.i3.syms=SYM4%2CSYM10%2CSYM9&casinoID=netent&betlevel.standard=1&rs.i3.r.i2.hold=false&gameover=false&rs.i3.r.i3.pos=60&rs.i0.r.i3.pos=0&rs.i4.r.i0.syms=SYM0%2CSYM7%2CSYM11&rs.i0.r.i11.pos=0&bl.i0.id=243&rs.i0.r.i10.syms=SYM30&rs.i0.r.i13.syms=SYM30&bl.i0.line=0%2F1%2F2%2C0%2F1%2F2%2C0%2F1%2F2%2C0%2F1%2F2%2C0%2F1%2F2&nextaction=freespin&rs.i0.r.i5.pos=0&rs.i4.r.i2.pos=32&rs.i0.r.i2.syms=SYM30&game.win.amount=3.00&betlevel.all=1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10&freespins.totalwin.cents=300&denomination.all=1%2C2%2C5%2C10%2C20%2C50%2C100%2C200&freespins.betlevel=1&rs.i0.r.i6.pos=0&rs.i4.r.i3.pos=51&playercurrency=%26%23x20AC%3B&rs.i0.r.i10.hold=false&rs.i2.r.i0.pos=51&rs.i4.r.i4.hold=false&rs.i4.r.i0.overlay.i0.with=SYM1&rs.i0.r.i8.syms=SYM30&rs.i2.r.i4.syms=SYM6%2CSYM10%2CSYM9&betlevel.last=1&rs.i3.r.i2.syms=SYM4%2CSYM10%2CSYM9&rs.i4.r.i3.hold=false&rs.i0.id=respin&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&rs.i1.r.i4.pos=0&rs.i0.r.i7.syms=SYM30&denomination.standard=5&rs.i0.r.i6.syms=SYM30&rs.i3.id=basic&rs.i4.r.i0.overlay.i0.pos=3&rs.i0.r.i12.hold=false&multiplier=1&rs.i2.r.i2.pos=25&rs.i0.r.i9.syms=SYM30&last.rs=freespin&freespins.denomination=5.000&rs.i0.r.i8.pos=0&autoplay=10%2C25%2C50%2C75%2C100%2C250%2C500%2C750%2C1000&freespins.totalwin.coins=60&freespins.total=10&gamestate.stack=basic%2Cfreespin&rs.i1.r.i4.syms=SYM8%2CSYM3%2CSYM7&rs.i4.r.i0.attention.i0=0&rs.i2.r.i2.syms=SYM10%2CSYM11%2CSYM12&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i1.r.i2.pos=0&rs.i2.r.i4.overlay.i0.row=0&rs.i3.r.i3.syms=SYM1%2CSYM10%2CSYM2&rs.i4.r.i4.attention.i0=1&bet.betlevel=1&rs.i3.r.i4.hold=false&rs.i4.r.i2.hold=false&rs.i0.r.i14.pos=0&nearwinallowed=true&rs.i4.r.i1.syms=SYM12%2CSYM5%2CSYM9&rs.i2.r.i4.pos=42&rs.i3.r.i0.syms=SYM11%2CSYM7%2CSYM10&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i11.syms=SYM30&rs.i4.r.i1.hold=false&freespins.wavecount=1&rs.i3.r.i2.pos=131&rs.i3.r.i3.hold=false&freespins.multiplier=1&playforfun=true&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM30&rs.i0.r.i2.pos=0&rs.i1.r.i2.syms=SYM8%2CSYM3%2CSYM7&rs.i1.r.i0.pos=0&totalwin.cents=300&bl.i0.coins=20&rs.i0.r.i12.pos=0&rs.i2.r.i0.syms=SYM5%2CSYM8%2CSYM11&rs.i0.r.i0.hold=false&rs.i2.r.i3.syms=SYM10%2CSYM8%2CSYM4&restore=true&rs.i1.id=freespinwalkingwild&rs.i3.r.i4.syms=SYM3%2CSYM10%2CSYM0&rs.i0.r.i6.hold=false&rs.i3.r.i1.syms=SYM6%2CSYM12%2CSYM4&rs.i1.r.i4.hold=false&freespins.left=7&rs.i0.r.i4.pos=0&rs.i0.r.i9.hold=false&rs.i4.r.i1.pos=17&rs.i4.r.i2.syms=SYM11%2CSYM0%2CSYM6&bl.standard=243&rs.i0.r.i10.pos=0&rs.i0.r.i14.hold=false&rs.i0.r.i11.hold=false&rs.i3.r.i0.pos=0&rs.i3.r.i0.hold=false&rs.i4.nearwin=4&rs.i2.r.i2.hold=false&wavecount=1&rs.i1.r.i1.hold=false&rs.i0.r.i3.hold=false&bet.denomination=5';
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'rs.i4.id=basic&rs.i2.r.i1.hold=false&rs.i2.r.i13.pos=0&rs.i1.r.i0.syms=SYM12%2CSYM2%2CSYM9&gameServerVersion=1.21.0&g4mode=false&historybutton=false&rs.i0.r.i4.hold=false&gameEventSetters.enabled=false&rs.i1.r.i2.hold=false&rs.i1.r.i3.pos=0&rs.i0.r.i1.syms=SYM6%2CSYM12%2CSYM8&rs.i2.r.i1.pos=0&game.win.cents=0&rs.i4.r.i4.pos=0&staticsharedurl=https%3A%2F%2Fstatic-shared.casinomodule.com%2Fgameclient_html%2Fdevicedetection%2Fcurrent&bl.i0.reelset=ALL&rs.i1.r.i3.hold=false&rs.i2.r.i11.pos=0&totalwin.coins=0&gamestate.current=basic&rs.i4.r.i0.pos=0&jackpotcurrency=%26%23x20AC%3B&walkingwilds.pos=0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0&rs.i3.r.i1.hold=false&rs.i2.r.i0.hold=false&rs.i0.r.i0.syms=SYM3%2CSYM11%2CSYM12&rs.i0.r.i3.syms=SYM6%2CSYM12%2CSYM8&rs.i1.r.i1.syms=SYM12%2CSYM7%2CSYM2&rs.i1.r.i1.pos=0&rs.i2.r.i10.hold=false&rs.i3.r.i4.pos=0&rs.i2.r.i8.syms=SYM30&isJackpotWin=false&rs.i0.r.i0.pos=0&rs.i2.r.i3.hold=false&rs.i2.r.i3.pos=0&rs.i0.r.i1.pos=0&rs.i4.r.i4.syms=SYM3%2CSYM10%2CSYM0&rs.i1.r.i3.syms=SYM3%2CSYM9%2CSYM11&rs.i2.r.i4.hold=false&rs.i3.r.i1.pos=0&rs.i2.id=respin&game.win.coins=0&rs.i1.r.i0.hold=false&rs.i0.r.i1.hold=false&rs.i2.r.i5.pos=0&rs.i2.r.i7.syms=SYM30&rs.i2.r.i1.syms=SYM30&clientaction=init&rs.i4.r.i0.hold=false&rs.i0.r.i2.hold=false&rs.i4.r.i3.syms=SYM1%2CSYM10%2CSYM2&casinoID=netent&betlevel.standard=1&rs.i3.r.i2.hold=false&rs.i2.r.i10.syms=SYM30&gameover=true&rs.i3.r.i3.pos=0&rs.i2.r.i7.pos=0&rs.i0.r.i3.pos=0&rs.i4.r.i0.syms=SYM11%2CSYM7%2CSYM10&bl.i0.id=243&bl.i0.line=0%2F1%2F2%2C0%2F1%2F2%2C0%2F1%2F2%2C0%2F1%2F2%2C0%2F1%2F2&nextaction=spin&rs.i2.r.i14.pos=0&rs.i2.r.i12.hold=false&rs.i4.r.i2.pos=131&rs.i0.r.i2.syms=SYM3%2CSYM11%2CSYM12&game.win.amount=0&betlevel.all=1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10&rs.i2.r.i12.syms=SYM30&denomination.all=' . implode('%2C', $slotSettings->Denominations) . '&rs.i2.r.i9.pos=0&rs.i4.r.i3.pos=60&playercurrency=%26%23x20AC%3B&rs.i2.r.i7.hold=false&rs.i2.r.i0.pos=0&rs.i4.r.i4.hold=false&rs.i2.r.i4.syms=SYM30&rs.i3.r.i2.syms=SYM8%2CSYM3%2CSYM7&rs.i2.r.i12.pos=0&rs.i4.r.i3.hold=false&rs.i2.r.i13.syms=SYM30&rs.i0.id=freespin&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&rs.i1.r.i4.pos=0&rs.i2.r.i14.hold=false&denomination.standard=' . ($slotSettings->CurrentDenomination * 100) . '&rs.i2.r.i13.hold=false&rs.i3.id=freespinwalkingwild&multiplier=1&rs.i2.r.i2.pos=0&rs.i2.r.i10.pos=0&autoplay=10%2C25%2C50%2C75%2C100%2C250%2C500%2C750%2C1000&rs.i2.r.i5.syms=SYM30&rs.i2.r.i6.hold=false&rs.i1.r.i4.syms=SYM12%2CSYM10%2CSYM0&rs.i2.r.i2.syms=SYM30&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i1.r.i2.pos=0&rs.i3.r.i3.syms=SYM3%2CSYM9%2CSYM12&rs.i3.r.i4.hold=false&rs.i4.r.i2.hold=false&nearwinallowed=true&rs.i2.r.i9.hold=false&rs.i4.r.i1.syms=SYM6%2CSYM12%2CSYM4&rs.i2.r.i4.pos=0&rs.i3.r.i0.syms=SYM8%2CSYM3%2CSYM7&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i4.r.i1.hold=false&rs.i3.r.i2.pos=0&rs.i3.r.i3.hold=false&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM3%2CSYM11%2CSYM12&rs.i2.r.i11.hold=false&rs.i0.r.i2.pos=0&rs.i1.r.i2.syms=SYM12%2CSYM11%2CSYM0&rs.i2.r.i6.pos=0&rs.i1.r.i0.pos=0&totalwin.cents=0&bl.i0.coins=20&rs.i2.r.i0.syms=SYM30&rs.i0.r.i0.hold=false&rs.i2.r.i3.syms=SYM30&restore=false&rs.i1.id=basicwalkingwild&rs.i2.r.i6.syms=SYM30&rs.i3.r.i4.syms=SYM8%2CSYM3%2CSYM7&rs.i3.r.i1.syms=SYM3%2CSYM9%2CSYM12&rs.i1.r.i4.hold=false&rs.i2.r.i8.hold=false&rs.i0.r.i4.pos=0&rs.i2.r.i9.syms=SYM30&rs.i4.r.i1.pos=0&rs.i4.r.i2.syms=SYM4%2CSYM10%2CSYM9&rs.i2.r.i14.syms=SYM30&rs.i2.r.i5.hold=false&bl.standard=243&rs.i3.r.i0.pos=0&rs.i2.r.i8.pos=0&rs.i3.r.i0.hold=false&rs.i2.r.i2.hold=false&rs.i2.r.i11.syms=SYM30&wavecount=1&rs.i1.r.i1.hold=false&rs.i0.r.i3.hold=false';
                    break;
                case 'paytable':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'pt.i0.comp.i19.symbol=SYM8&pt.i0.comp.i15.type=betline&pt.i0.comp.i23.freespins=0&pt.i0.comp.i32.type=betline&pt.i0.comp.i35.multi=0&pt.i0.comp.i29.type=betline&pt.i0.comp.i4.multi=80&pt.i0.comp.i15.symbol=SYM7&pt.i0.comp.i17.symbol=SYM7&pt.i0.comp.i5.freespins=0&pt.i1.comp.i14.multi=250&pt.i0.comp.i22.multi=15&pt.i0.comp.i23.n=5&pt.i1.comp.i19.type=betline&pt.i0.comp.i11.symbol=SYM5&pt.i0.comp.i13.symbol=SYM6&pt.i1.comp.i8.type=betline&pt.i1.comp.i4.n=4&pt.i1.comp.i27.multi=5&pt.i0.comp.i15.multi=10&pt.i1.comp.i27.symbol=SYM11&bl.i0.reelset=ALL&pt.i0.comp.i16.freespins=0&pt.i0.comp.i28.multi=10&pt.i1.comp.i6.freespins=0&pt.i1.comp.i29.symbol=SYM11&pt.i1.comp.i29.freespins=0&pt.i1.comp.i22.n=4&pt.i1.comp.i30.symbol=SYM12&pt.i1.comp.i3.multi=20&pt.i0.comp.i11.n=5&pt.i0.comp.i4.freespins=0&pt.i1.comp.i23.symbol=SYM9&pt.i1.comp.i25.symbol=SYM10&pt.i0.comp.i30.freespins=0&pt.i1.comp.i24.type=betline&pt.i0.comp.i19.n=4&pt.i0.id=basic&pt.i0.comp.i1.type=betline&pt.i0.comp.i34.n=4&pt.i1.comp.i10.type=betline&pt.i0.comp.i34.type=scatter&pt.i0.comp.i2.symbol=SYM1&pt.i0.comp.i4.symbol=SYM3&pt.i1.comp.i5.freespins=0&pt.i0.comp.i20.type=betline&pt.i1.comp.i8.symbol=SYM4&pt.i1.comp.i19.n=4&pt.i0.comp.i17.freespins=0&pt.i0.comp.i6.symbol=SYM4&pt.i0.comp.i8.symbol=SYM4&pt.i0.comp.i0.symbol=SYM1&pt.i1.comp.i11.n=5&pt.i0.comp.i5.n=5&pt.i1.comp.i2.symbol=SYM1&pt.i0.comp.i3.type=betline&pt.i0.comp.i3.freespins=0&pt.i0.comp.i10.multi=60&pt.i1.id=freespin&pt.i1.comp.i19.multi=30&pt.i1.comp.i6.symbol=SYM4&pt.i0.comp.i27.multi=5&pt.i0.comp.i9.multi=15&pt.i0.comp.i22.symbol=SYM9&pt.i0.comp.i26.symbol=SYM10&pt.i1.comp.i19.freespins=0&pt.i0.comp.i24.n=3&pt.i0.comp.i14.freespins=0&pt.i0.comp.i21.freespins=0&clientaction=paytable&pt.i1.comp.i27.freespins=0&pt.i1.comp.i4.freespins=0&pt.i1.comp.i12.type=betline&pt.i1.comp.i5.n=5&pt.i1.comp.i8.multi=300&pt.i1.comp.i21.symbol=SYM9&pt.i1.comp.i23.n=5&pt.i0.comp.i22.type=betline&pt.i0.comp.i24.freespins=0&pt.i1.comp.i32.symbol=SYM12&pt.i0.comp.i16.multi=30&pt.i0.comp.i21.multi=5&pt.i1.comp.i13.multi=60&pt.i0.comp.i12.n=3&pt.i0.comp.i35.n=5&pt.i0.comp.i13.type=betline&pt.i1.comp.i9.multi=15&bl.i0.line=0%2F1%2F2%2C0%2F1%2F2%2C0%2F1%2F2%2C0%2F1%2F2%2C0%2F1%2F2&pt.i0.comp.i19.type=betline&pt.i0.comp.i6.freespins=0&pt.i1.comp.i2.multi=300&pt.i1.comp.i7.freespins=0&pt.i0.comp.i31.freespins=0&pt.i0.comp.i3.multi=20&pt.i0.comp.i6.n=3&pt.i1.comp.i22.type=betline&pt.i1.comp.i12.n=3&pt.i1.comp.i3.type=betline&pt.i0.comp.i21.n=3&pt.i1.comp.i10.freespins=0&pt.i1.comp.i28.type=betline&pt.i0.comp.i34.symbol=SYM0&pt.i1.comp.i6.n=3&pt.i0.comp.i29.n=5&pt.i1.comp.i31.type=betline&pt.i1.comp.i20.multi=120&pt.i0.comp.i27.freespins=0&pt.i0.comp.i34.freespins=10&pt.i1.comp.i24.n=3&pt.i0.comp.i10.type=betline&pt.i0.comp.i35.freespins=10&pt.i1.comp.i11.symbol=SYM5&pt.i1.comp.i27.type=betline&pt.i1.comp.i2.type=betline&pt.i0.comp.i2.freespins=0&pt.i0.comp.i5.multi=300&pt.i0.comp.i7.n=4&pt.i0.comp.i32.n=5&pt.i1.comp.i1.freespins=0&pt.i0.comp.i11.multi=250&pt.i1.comp.i14.symbol=SYM6&pt.i1.comp.i16.symbol=SYM7&pt.i1.comp.i23.multi=60&pt.i0.comp.i7.type=betline&pt.i1.comp.i4.type=betline&pt.i0.comp.i17.n=5&pt.i1.comp.i18.multi=10&pt.i0.comp.i29.multi=40&pt.i1.comp.i13.n=4&pt.i0.comp.i8.freespins=0&pt.i1.comp.i26.type=betline&pt.i1.comp.i4.multi=80&pt.i0.comp.i8.multi=300&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&pt.i0.comp.i34.multi=0&pt.i0.comp.i1.freespins=0&pt.i0.comp.i12.type=betline&pt.i0.comp.i14.multi=250&pt.i1.comp.i7.multi=80&pt.i0.comp.i22.n=4&pt.i0.comp.i28.symbol=SYM11&pt.i1.comp.i17.type=betline&pt.i1.comp.i11.type=betline&pt.i0.comp.i6.multi=20&pt.i1.comp.i0.symbol=SYM1&playercurrencyiso=' . $slotSettings->slotCurrency . '&pt.i1.comp.i7.n=4&pt.i1.comp.i5.multi=300&pt.i1.comp.i5.symbol=SYM3&pt.i0.comp.i18.type=betline&pt.i0.comp.i23.symbol=SYM9&pt.i0.comp.i21.type=betline&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&pt.i1.comp.i25.n=4&pt.i0.comp.i8.type=betline&pt.i0.comp.i7.freespins=0&pt.i1.comp.i15.multi=10&pt.i0.comp.i2.type=betline&pt.i0.comp.i13.multi=60&pt.i1.comp.i20.type=betline&pt.i0.comp.i17.type=betline&pt.i0.comp.i30.type=betline&pt.i1.comp.i22.symbol=SYM9&pt.i1.comp.i30.freespins=0&pt.i1.comp.i22.multi=15&bl.i0.coins=20&pt.i0.comp.i8.n=5&pt.i0.comp.i10.n=4&pt.i0.comp.i33.n=3&pt.i1.comp.i6.multi=20&pt.i1.comp.i22.freespins=0&pt.i0.comp.i11.type=betline&pt.i1.comp.i19.symbol=SYM8&pt.i0.comp.i18.n=3&pt.i0.comp.i22.freespins=0&pt.i0.comp.i20.symbol=SYM8&pt.i0.comp.i15.freespins=0&pt.i1.comp.i14.n=5&pt.i1.comp.i16.multi=30&pt.i0.comp.i31.symbol=SYM12&pt.i1.comp.i15.freespins=0&pt.i0.comp.i27.type=betline&pt.i1.comp.i28.freespins=0&pt.i0.comp.i28.freespins=0&pt.i0.comp.i0.n=3&pt.i0.comp.i7.symbol=SYM4&pt.i1.comp.i21.multi=5&pt.i1.comp.i30.type=betline&pt.i1.comp.i0.freespins=0&pt.i0.comp.i0.type=betline&pt.i1.comp.i0.multi=20&gameServerVersion=1.21.0&g4mode=false&pt.i1.comp.i8.n=5&pt.i0.comp.i25.multi=15&historybutton=false&pt.i0.comp.i16.symbol=SYM7&pt.i1.comp.i21.freespins=0&pt.i0.comp.i1.multi=80&pt.i0.comp.i27.n=3&pt.i0.comp.i18.symbol=SYM8&pt.i1.comp.i9.type=betline&pt.i0.comp.i12.multi=15&pt.i0.comp.i32.multi=40&pt.i1.comp.i24.multi=5&pt.i1.comp.i14.freespins=0&pt.i1.comp.i23.type=betline&pt.i1.comp.i26.n=5&pt.i0.comp.i12.symbol=SYM6&pt.i0.comp.i14.symbol=SYM6&pt.i1.comp.i13.freespins=0&pt.i1.comp.i28.symbol=SYM11&pt.i0.comp.i14.type=betline&pt.i1.comp.i17.multi=120&pt.i0.comp.i18.multi=10&pt.i1.comp.i0.n=3&pt.i1.comp.i26.symbol=SYM10&pt.i0.comp.i33.type=scatter&pt.i1.comp.i31.symbol=SYM12&pt.i0.comp.i7.multi=80&pt.i0.comp.i9.n=3&pt.i0.comp.i30.n=3&pt.i1.comp.i21.type=betline&jackpotcurrency=%26%23x20AC%3B&pt.i0.comp.i28.type=betline&pt.i1.comp.i31.multi=10&pt.i1.comp.i18.type=betline&pt.i0.comp.i10.symbol=SYM5&pt.i0.comp.i15.n=3&pt.i0.comp.i21.symbol=SYM9&pt.i0.comp.i31.type=betline&pt.i1.comp.i15.n=3&isJackpotWin=false&pt.i1.comp.i20.freespins=0&pt.i1.comp.i7.type=betline&pt.i1.comp.i11.multi=250&pt.i1.comp.i30.n=3&pt.i0.comp.i1.n=4&pt.i0.comp.i10.freespins=0&pt.i0.comp.i20.multi=120&pt.i0.comp.i20.n=5&pt.i0.comp.i29.symbol=SYM11&pt.i1.comp.i3.symbol=SYM3&pt.i0.comp.i17.multi=120&pt.i1.comp.i23.freespins=0&pt.i1.comp.i25.type=betline&pt.i1.comp.i9.n=3&pt.i0.comp.i25.symbol=SYM10&pt.i0.comp.i26.type=betline&pt.i0.comp.i28.n=4&pt.i0.comp.i9.type=betline&pt.i0.comp.i2.multi=300&pt.i1.comp.i27.n=3&pt.i0.comp.i0.freespins=0&pt.i1.comp.i16.type=betline&pt.i1.comp.i25.multi=15&pt.i0.comp.i33.multi=0&pt.i1.comp.i16.freespins=0&pt.i1.comp.i20.symbol=SYM8&pt.i1.comp.i12.multi=15&pt.i0.comp.i29.freespins=0&pt.i1.comp.i1.n=4&pt.i1.comp.i5.type=betline&pt.i1.comp.i11.freespins=0&pt.i1.comp.i24.symbol=SYM10&pt.i0.comp.i31.n=4&pt.i0.comp.i9.symbol=SYM5&pt.i1.comp.i13.symbol=SYM6&pt.i1.comp.i17.symbol=SYM7&pt.i0.comp.i16.n=4&bl.i0.id=243&pt.i0.comp.i16.type=betline&pt.i1.comp.i16.n=4&pt.i0.comp.i5.symbol=SYM3&pt.i1.comp.i7.symbol=SYM4&pt.i0.comp.i2.n=5&pt.i0.comp.i35.type=scatter&pt.i0.comp.i1.symbol=SYM1&pt.i1.comp.i31.n=4&pt.i1.comp.i31.freespins=0&pt.i0.comp.i19.freespins=0&pt.i1.comp.i14.type=betline&pt.i0.comp.i6.type=betline&pt.i1.comp.i9.freespins=0&pt.i1.comp.i2.freespins=0&playercurrency=%26%23x20AC%3B&pt.i0.comp.i35.symbol=SYM0&pt.i1.comp.i25.freespins=0&pt.i0.comp.i33.symbol=SYM0&pt.i1.comp.i30.multi=5&pt.i0.comp.i25.n=4&pt.i1.comp.i10.multi=60&pt.i1.comp.i10.symbol=SYM5&pt.i1.comp.i28.n=4&pt.i1.comp.i32.freespins=0&pt.i0.comp.i9.freespins=0&pt.i1.comp.i2.n=5&pt.i1.comp.i20.n=5&credit=500000&pt.i0.comp.i5.type=betline&pt.i1.comp.i24.freespins=0&pt.i0.comp.i11.freespins=0&pt.i0.comp.i26.multi=60&pt.i0.comp.i25.type=betline&pt.i1.comp.i32.type=betline&pt.i1.comp.i18.symbol=SYM8&pt.i0.comp.i31.multi=10&pt.i1.comp.i12.symbol=SYM6&pt.i0.comp.i4.type=betline&pt.i0.comp.i13.freespins=0&pt.i1.comp.i15.type=betline&pt.i1.comp.i26.freespins=0&pt.i0.comp.i26.freespins=0&pt.i1.comp.i13.type=betline&pt.i1.comp.i1.multi=80&pt.i1.comp.i1.type=betline&pt.i1.comp.i8.freespins=0&pt.i0.comp.i13.n=4&pt.i0.comp.i20.freespins=0&pt.i0.comp.i33.freespins=10&pt.i1.comp.i17.n=5&pt.i0.comp.i23.type=betline&pt.i1.comp.i29.type=betline&pt.i0.comp.i30.symbol=SYM12&pt.i0.comp.i32.symbol=SYM12&pt.i1.comp.i32.n=5&pt.i0.comp.i3.n=3&pt.i1.comp.i17.freespins=0&pt.i1.comp.i26.multi=60&pt.i1.comp.i32.multi=40&pt.i1.comp.i6.type=betline&pt.i1.comp.i0.type=betline&pt.i1.comp.i1.symbol=SYM1&pt.i1.comp.i29.multi=40&pt.i0.comp.i25.freespins=0&pt.i1.comp.i4.symbol=SYM3&pt.i0.comp.i24.symbol=SYM10&pt.i0.comp.i26.n=5&pt.i0.comp.i27.symbol=SYM11&pt.i0.comp.i32.freespins=0&pt.i1.comp.i29.n=5&pt.i0.comp.i23.multi=60&pt.i1.comp.i3.n=3&pt.i0.comp.i30.multi=5&pt.i1.comp.i21.n=3&pt.i1.comp.i28.multi=10&pt.i0.comp.i18.freespins=0&pt.i1.comp.i15.symbol=SYM7&pt.i1.comp.i18.freespins=0&pt.i1.comp.i3.freespins=0&pt.i0.comp.i14.n=5&pt.i0.comp.i0.multi=20&pt.i1.comp.i9.symbol=SYM5&pt.i0.comp.i19.multi=30&pt.i0.comp.i3.symbol=SYM3&pt.i0.comp.i24.type=betline&pt.i1.comp.i18.n=3&pt.i1.comp.i12.freespins=0&pt.i0.comp.i12.freespins=0&pt.i0.comp.i4.n=4&pt.i1.comp.i10.n=4&pt.i0.comp.i24.multi=5';
                    break;
                case 'initfreespin':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'rs.i4.id=basicwalkingwild&rs.i2.r.i1.hold=false&rs.i1.r.i0.syms=SYM8%2CSYM3%2CSYM7&gameServerVersion=1.21.0&g4mode=false&freespins.win.coins=0&historybutton=false&rs.i0.r.i4.hold=false&next.rs=freespin&gamestate.history=basic&rs.i0.r.i14.syms=SYM30&rs.i1.r.i2.hold=false&rs.i1.r.i3.pos=0&rs.i0.r.i1.syms=SYM30&rs.i0.r.i5.hold=false&rs.i0.r.i7.pos=0&rs.i2.r.i1.pos=0&game.win.cents=0&rs.i4.r.i4.pos=65&rs.i1.r.i3.hold=false&totalwin.coins=0&gamestate.current=freespin&freespins.initial=10&rs.i4.r.i0.pos=2&rs.i0.r.i12.syms=SYM30&jackpotcurrency=%26%23x20AC%3B&rs.i4.r.i0.overlay.i0.row=1&bet.betlines=243&rs.i3.r.i1.hold=false&rs.i2.r.i0.hold=false&rs.i0.r.i0.syms=SYM30&rs.i0.r.i3.syms=SYM30&rs.i1.r.i1.syms=SYM3%2CSYM9%2CSYM12&rs.i1.r.i1.pos=0&rs.i3.r.i4.pos=0&freespins.win.cents=0&isJackpotWin=false&rs.i0.r.i0.pos=0&rs.i2.r.i3.hold=false&rs.i2.r.i3.pos=0&freespins.betlines=243&rs.i0.r.i9.pos=0&rs.i4.r.i2.attention.i0=1&rs.i0.r.i1.pos=0&rs.i4.r.i4.syms=SYM5%2CSYM0%2CSYM7&rs.i1.r.i3.syms=SYM3%2CSYM9%2CSYM12&rs.i2.r.i4.hold=false&rs.i3.r.i1.pos=0&rs.i2.id=freespin&game.win.coins=0&rs.i1.r.i0.hold=false&rs.i0.r.i5.syms=SYM30&rs.i0.r.i1.hold=false&rs.i0.r.i13.pos=0&rs.i0.r.i13.hold=false&rs.i2.r.i1.syms=SYM6%2CSYM12%2CSYM8&rs.i0.r.i7.hold=false&clientaction=initfreespin&rs.i0.r.i8.hold=false&rs.i4.r.i0.hold=false&rs.i0.r.i2.hold=false&rs.i4.r.i3.syms=SYM4%2CSYM10%2CSYM9&rs.i3.r.i2.hold=false&gameover=false&rs.i3.r.i3.pos=60&rs.i0.r.i3.pos=0&rs.i4.r.i0.syms=SYM0%2CSYM7%2CSYM11&rs.i0.r.i11.pos=0&rs.i0.r.i10.syms=SYM30&rs.i0.r.i13.syms=SYM30&nextaction=freespin&rs.i0.r.i5.pos=0&rs.i4.r.i2.pos=32&rs.i0.r.i2.syms=SYM30&game.win.amount=0.00&freespins.totalwin.cents=0&freespins.betlevel=1&rs.i0.r.i6.pos=0&rs.i4.r.i3.pos=51&playercurrency=%26%23x20AC%3B&rs.i0.r.i10.hold=false&rs.i2.r.i0.pos=0&rs.i4.r.i4.hold=false&rs.i4.r.i0.overlay.i0.with=SYM1&rs.i0.r.i8.syms=SYM30&rs.i2.r.i4.syms=SYM3%2CSYM11%2CSYM12&rs.i3.r.i2.syms=SYM4%2CSYM10%2CSYM9&rs.i4.r.i3.hold=false&rs.i0.id=respin&credit=500525&rs.i1.r.i4.pos=0&rs.i0.r.i7.syms=SYM30&rs.i0.r.i6.syms=SYM30&rs.i3.id=basic&rs.i4.r.i0.overlay.i0.pos=3&rs.i0.r.i12.hold=false&multiplier=1&rs.i2.r.i2.pos=0&rs.i0.r.i9.syms=SYM30&freespins.denomination=5.000&rs.i0.r.i8.pos=0&freespins.totalwin.coins=0&freespins.total=10&gamestate.stack=basic%2Cfreespin&rs.i1.r.i4.syms=SYM8%2CSYM3%2CSYM7&rs.i4.r.i0.attention.i0=0&rs.i2.r.i2.syms=SYM3%2CSYM11%2CSYM12&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i1.r.i2.pos=0&rs.i3.r.i3.syms=SYM1%2CSYM10%2CSYM2&rs.i4.r.i4.attention.i0=1&bet.betlevel=1&rs.i3.r.i4.hold=false&rs.i4.r.i2.hold=false&rs.i0.r.i14.pos=0&rs.i4.r.i1.syms=SYM12%2CSYM5%2CSYM9&rs.i2.r.i4.pos=0&rs.i3.r.i0.syms=SYM11%2CSYM7%2CSYM10&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i11.syms=SYM30&rs.i4.r.i1.hold=false&freespins.wavecount=1&rs.i3.r.i2.pos=131&rs.i3.r.i3.hold=false&freespins.multiplier=1&playforfun=true&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM30&rs.i0.r.i2.pos=0&rs.i1.r.i2.syms=SYM8%2CSYM3%2CSYM7&rs.i1.r.i0.pos=0&totalwin.cents=0&rs.i0.r.i12.pos=0&rs.i2.r.i0.syms=SYM3%2CSYM11%2CSYM12&rs.i0.r.i0.hold=false&rs.i2.r.i3.syms=SYM6%2CSYM12%2CSYM8&rs.i1.id=freespinwalkingwild&rs.i3.r.i4.syms=SYM3%2CSYM10%2CSYM0&rs.i0.r.i6.hold=false&rs.i3.r.i1.syms=SYM6%2CSYM12%2CSYM4&rs.i1.r.i4.hold=false&freespins.left=10&rs.i0.r.i4.pos=0&rs.i0.r.i9.hold=false&rs.i4.r.i1.pos=17&rs.i4.r.i2.syms=SYM11%2CSYM0%2CSYM6&rs.i0.r.i10.pos=0&rs.i0.r.i14.hold=false&rs.i0.r.i11.hold=false&rs.i3.r.i0.pos=0&rs.i3.r.i0.hold=false&rs.i4.nearwin=4&rs.i2.r.i2.hold=false&wavecount=1&rs.i1.r.i1.hold=false&rs.i0.r.i3.hold=false&bet.denomination=5';
                    break;
                case 'respin':
                    $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801 = [];
                    $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[0] = [
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30'
                    ];
                    $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[1] = [
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30'
                    ];
                    $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[2] = [
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30'
                    ];
                    $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[3] = [
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '2', 
                        '30'
                    ];
                    $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[4] = [
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '2', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30', 
                        '30'
                    ];
                    $ClusterSpinCount = $slotSettings->GetGameData($slotSettings->slotId . 'ClusterSpinCount');
                    $_obf_0D1A3D051717283418231B3607350E1C2A5B13282F1911 = $slotSettings->GetGameData($slotSettings->slotId . 'clusterAllWin');
                    $clusterAllWin = $slotSettings->GetGameData($slotSettings->slotId . 'clusterAllWin');
                    $clusterSymAllWins = $slotSettings->GetGameData($slotSettings->slotId . 'clusterSymAllWins');
                    $allbet = $slotSettings->GetGameData($slotSettings->slotId . 'AllBet');
                    $clusterSymWinsArr = $slotSettings->GetGameData($slotSettings->slotId . 'clusterSymWinsArr');
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $clusterAllWin);
                    $slotSettings->SetBalance(-1 * $clusterAllWin);
                    $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    for( $_obf_0D172A041C3F3B1E363407160C0D1021102E2B123D0B01 = 0; $_obf_0D172A041C3F3B1E363407160C0D1021102E2B123D0B01 <= 500; $_obf_0D172A041C3F3B1E363407160C0D1021102E2B123D0B01++ ) 
                    {
                        $_obf_0D1403372226193C33091132321F25180B0A2B37240D32 = $slotSettings->GetGameData($slotSettings->slotId . 'clusterReels');
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 = '';
                        $clusterAllWin = 0;
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '';
                        $reels = [];
                        $_obf_0D175B110C313101261119190B1640321D0602340A0832 = 0;
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            $reels['reel' . $r] = [];
                            $_obf_0D39112D1337363D1E5C0B3C312B2908350A3436330E32 = rand(1, count($_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[$r - 1]) - 3);
                            $reels['reel' . $r][0] = $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[$r - 1][$_obf_0D39112D1337363D1E5C0B3C312B2908350A3436330E32 - 1];
                            $reels['reel' . $r][1] = $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[$r - 1][$_obf_0D39112D1337363D1E5C0B3C312B2908350A3436330E32];
                            $reels['reel' . $r][2] = $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[$r - 1][$_obf_0D39112D1337363D1E5C0B3C312B2908350A3436330E32 + 1];
                        }
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                            {
                                if( $_obf_0D1403372226193C33091132321F25180B0A2B37240D32['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] != '2c' && $_obf_0D1403372226193C33091132321F25180B0A2B37240D32['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] != '2' ) 
                                {
                                    $_obf_0D1403372226193C33091132321F25180B0A2B37240D32['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32];
                                }
                            }
                        }
                        $_obf_0D1403372226193C33091132321F25180B0A2B37240D32 = $slotSettings->GetCluster($_obf_0D1403372226193C33091132321F25180B0A2B37240D32);
                        $_obf_0D1403372226193C33091132321F25180B0A2B37240D32 = $slotSettings->GetCluster($_obf_0D1403372226193C33091132321F25180B0A2B37240D32);
                        $_obf_0D1403372226193C33091132321F25180B0A2B37240D32 = $slotSettings->GetCluster($_obf_0D1403372226193C33091132321F25180B0A2B37240D32);
                        $_obf_0D1403372226193C33091132321F25180B0A2B37240D32 = $slotSettings->GetCluster($_obf_0D1403372226193C33091132321F25180B0A2B37240D32);
                        $_obf_0D175B110C313101261119190B1640321D0602340A0832 = 0;
                        $_obf_0D1F3D35230517381B2D0F1F35281F34012D0C40273E01 = 0;
                        $_obf_0D0422223816021522032514083116023435011B112122 = [];
                        $_obf_0D351C1C2C07382C17122225210B363D1C0611332B3511 = '';
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                            {
                                if( $_obf_0D1403372226193C33091132321F25180B0A2B37240D32['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '2c' || $_obf_0D1403372226193C33091132321F25180B0A2B37240D32['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '2' ) 
                                {
                                    $_obf_0D351C1C2C07382C17122225210B363D1C0611332B3511 .= ('&rs.i0.r.i' . $_obf_0D1F3D35230517381B2D0F1F35281F34012D0C40273E01 . '.hold=true');
                                }
                                else
                                {
                                    $_obf_0D351C1C2C07382C17122225210B363D1C0611332B3511 .= ('&rs.i0.r.i' . $_obf_0D1F3D35230517381B2D0F1F35281F34012D0C40273E01 . '.hold=false');
                                }
                                if( $_obf_0D1403372226193C33091132321F25180B0A2B37240D32['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '2c' ) 
                                {
                                    if( !isset($clusterSymAllWins[$_obf_0D175B110C313101261119190B1640321D0602340A0832]) ) 
                                    {
                                        $_obf_0D362832171714063F2F145B3E251F362B012122193D32 = $clusterSymWinsArr[$r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] * $allbet;
                                        $clusterAllWin += $_obf_0D362832171714063F2F145B3E251F362B012122193D32;
                                        $clusterSymAllWins[] = $_obf_0D362832171714063F2F145B3E251F362B012122193D32;
                                    }
                                    else
                                    {
                                        $_obf_0D362832171714063F2F145B3E251F362B012122193D32 = $clusterSymWinsArr[$r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] * $allbet;
                                        $clusterAllWin += $_obf_0D362832171714063F2F145B3E251F362B012122193D32;
                                    }
                                    $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.cluster.i0.sym.i' . $_obf_0D175B110C313101261119190B1640321D0602340A0832 . '.value=' . $_obf_0D362832171714063F2F145B3E251F362B012122193D32);
                                    $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.cluster.i0.sym.i' . $_obf_0D175B110C313101261119190B1640321D0602340A0832 . '.pos=' . ($r - 1) . '%2C' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32);
                                    $_obf_0D175B110C313101261119190B1640321D0602340A0832++;
                                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i' . $_obf_0D1F3D35230517381B2D0F1F35281F34012D0C40273E01 . '.syms=SYM2');
                                }
                                else
                                {
                                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i' . $_obf_0D1F3D35230517381B2D0F1F35281F34012D0C40273E01 . '.syms=SYM' . $_obf_0D1403372226193C33091132321F25180B0A2B37240D32['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32]);
                                }
                                $_obf_0D1F3D35230517381B2D0F1F35281F34012D0C40273E01++;
                            }
                        }
                        if( $clusterAllWin <= $bank ) 
                        {
                            $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $clusterAllWin);
                            $slotSettings->SetBalance($clusterAllWin);
                            break;
                        }
                    }
                    if( $_obf_0D1A3D051717283418231B3607350E1C2A5B13282F1911 < $clusterAllWin ) 
                    {
                        $ClusterSpinCount = 3;
                    }
                    else
                    {
                        $ClusterSpinCount--;
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'clusterAllWin', $clusterAllWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'clusterSymAllWins', $clusterSymAllWins);
                    $slotSettings->SetGameData($slotSettings->slotId . 'clusterReels', $_obf_0D1403372226193C33091132321F25180B0A2B37240D32);
                    $slotSettings->SetGameData($slotSettings->slotId . 'ClusterSpinCount', $ClusterSpinCount);
                    if( $ClusterSpinCount <= 0 ) 
                    {
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.deltawin.cents=' . ($clusterAllWin * $slotSettings->CurrentDenomination * 100));
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.win.cents=' . ($clusterAllWin * $slotSettings->CurrentDenomination * 100));
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.deltawin.coins=' . $clusterAllWin);
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.win.coins=' . $clusterAllWin);
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&totalwin.coins=' . $clusterAllWin);
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&game.win.coins=' . $clusterAllWin);
                        $_obf_0D1F3D35230517381B2D0F1F35281F34012D0C40273E01 = 0;
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                            {
                                $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&rs.i0.r.i' . $_obf_0D1F3D35230517381B2D0F1F35281F34012D0C40273E01 . '.hold=false');
                                $_obf_0D1F3D35230517381B2D0F1F35281F34012D0C40273E01++;
                            }
                        }
                        $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * $slotSettings->CurrentDenom * 100);
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'rs.i0.r.i6.pos=0&gameServerVersion=1.21.0&g4mode=false&playercurrency=%26%23x20AC%3B&historybutton=false&rs.i0.r.i10.hold=false&rs.i0.r.i4.hold=false&ws.i0.reelset=respin&next.rs=basic&rs.i0.r.i8.syms=SYM2&gamestate.history=basic%2Crespin&lockup.cluster.i0.sym.i1.value=60&rs.i0.r.i14.syms=SYM30&lockup.deltawin.cents=0&rs.i0.r.i1.syms=SYM30&rs.i0.r.i5.hold=false&rs.i0.r.i7.pos=8&lockup.respins.left=0&game.win.cents=900&ws.i0.betline=null&rs.i0.id=respin&totalwin.coins=180&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&gamestate.current=basic&rs.i0.r.i7.syms=SYM30&ws.i0.types.i0.coins=180&rs.i0.r.i6.syms=SYM30&rs.i0.r.i12.syms=SYM30&rs.i0.r.i12.hold=false&jackpotcurrency=%26%23x20AC%3B&multiplier=1&walkingwilds.pos=0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0&rs.i0.r.i9.syms=SYM30&last.rs=respin&rs.i0.r.i0.syms=SYM2&rs.i0.r.i3.syms=SYM30&rs.i0.r.i8.pos=0&ws.i0.sym=SYM2&ws.i0.direction=left_to_right&lockup.win.cents=900&isJackpotWin=false&gamestate.stack=basic&rs.i0.r.i0.pos=10&lockup.cluster.i0.sym.i0.value=100&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i0.r.i9.pos=1&ws.i0.types.i0.wintype=coins&rs.i0.r.i14.pos=2&rs.i0.r.i1.pos=6&game.win.coins=180&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i5.syms=SYM2&rs.i0.r.i1.hold=false&rs.i0.r.i13.pos=9&rs.i0.r.i13.hold=false&lockup.cluster.i0.sym.i2.pos=3%2C2&rs.i0.r.i11.syms=SYM2&lockup.deltawin.coins=0&rs.i0.r.i7.hold=false&playforfun=true&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=respin&rs.i0.r.i8.hold=false&rs.i0.r.i2.hold=false&rs.i0.r.i4.syms=SYM30&lockup.cluster.i0.sym.i0.pos=1%2C2&rs.i0.r.i2.pos=4&totalwin.cents=900&gameover=true&rs.i0.r.i12.pos=8&rs.i0.r.i0.hold=false&rs.i0.r.i6.hold=false&rs.i0.r.i3.pos=5&rs.i0.r.i4.pos=13&lockup.cluster.i0.sym.i2.value=20&rs.i0.r.i9.hold=false&lockup.win.coins=180&rs.i0.r.i11.pos=0&ws.i0.types.i0.cents=900&rs.i0.r.i10.syms=SYM30&rs.i0.r.i10.pos=11&rs.i0.r.i14.hold=false&rs.i0.r.i11.hold=false&rs.i0.r.i13.syms=SYM30&nextaction=spin&rs.i0.r.i5.pos=0&wavecount=1&rs.i0.r.i2.syms=SYM30&lockup.cluster.i0.sym.i1.pos=2%2C2&rs.i0.r.i3.hold=false&game.win.amount=9.00' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D113626242D1B043F3628373C252838273D232A1D3422;
                    }
                    else
                    {
                        $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = $slotSettings->GetGameData($slotSettings->slotId . 'StaticBalance');
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.deltawin.cents=' . ($clusterAllWin * $slotSettings->CurrentDenomination * 100));
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.win.cents=' . ($clusterAllWin * $slotSettings->CurrentDenomination * 100));
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.deltawin.coins=' . $clusterAllWin);
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.win.coins=' . $clusterAllWin);
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&totalwin.coins=' . $clusterAllWin);
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&game.win.coins=' . $clusterAllWin);
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'gameServerVersion=1.21.0&g4mode=false&historybutton=false&rs.i0.r.i4.hold=false&next.rs=respin&gamestate.history=basic%2Crespin&rs.i0.r.i14.syms=&lockup.deltawin.cents=1500&rs.i0.r.i1.syms=SYM30&rs.i0.r.i5.hold=false&rs.i0.r.i7.pos=0&game.win.cents=175&totalwin.coins=35&gamestate.current=respin&rs.i0.r.i12.syms=SYM30&jackpotcurrency=%26%23x20AC%3B&walkingwilds.pos=0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0&rs.i0.r.i0.syms=SYM30&rs.i0.r.i3.syms=SYM30&isJackpotWin=false&rs.i0.r.i0.pos=0&rs.i0.r.i9.pos=0&rs.i0.r.i1.pos=5&game.win.coins=35&rs.i0.r.i5.syms=SYM30&rs.i0.r.i1.hold=false&rs.i0.r.i13.pos=0&rs.i0.r.i13.hold=false&rs.i0.r.i7.hold=false&clientaction=respin&rs.i0.r.i8.hold=false&rs.i0.r.i2.hold=false&gameover=false&rs.i0.r.i3.pos=13&lockup.win.coins=435&rs.i0.r.i11.pos=11&rs.i0.r.i10.syms=SYM2&rs.i0.r.i13.syms=SYM2&nextaction=respin&rs.i0.r.i5.pos=10&rs.i0.r.i2.syms=SYM30&game.win.amount=1.75&rs.i0.r.i6.pos=2&playercurrency=%26%23x20AC%3B&rs.i0.r.i10.hold=false&rs.i0.r.i8.syms=SYM30&lockup.respins.left=' . $ClusterSpinCount . '&rs.i0.id=respin&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&rs.i0.r.i7.syms=SYM2&rs.i0.r.i6.syms=SYM30&rs.i0.r.i12.hold=false&multiplier=1&rs.i0.r.i9.syms=SYM30&last.rs=respin&rs.i0.r.i8.pos=2&lockup.win.cents=2175&gamestate.stack=basic%2Crespin&gamesoundurl=&rs.i0.r.i14.pos=10&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i11.syms=SYM30&lockup.deltawin.coins=300&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM30&rs.i0.r.i2.pos=5&totalwin.cents=175&rs.i0.r.i12.pos=2&rs.i0.r.i0.hold=false&rs.i0.r.i6.hold=false&rs.i0.r.i4.pos=10&rs.i0.r.i9.hold=false&rs.i0.r.i10.pos=0&rs.i0.r.i14.hold=false&rs.i0.r.i11.hold=false&wavecount=1' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 . $_obf_0D351C1C2C07382C17122225210B363D1C0611332B3511;
                    }
                    $response = $slotSettings->GetGameData($slotSettings->slotId . 'LastResponse');
                    $slotSettings->SaveLogReport($response, 0, 1, $clusterAllWin - $_obf_0D1A3D051717283418231B3607350E1C2A5B13282F1911, 'FG2');
                    break;
                case 'spin':
                    $lines = 20;
                    $slotSettings->CurrentDenom = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                    $slotSettings->CurrentDenomination = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                    {
                        $betline = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_betlevel'];
                        $allbet = $betline * $lines;
                        $slotSettings->UpdateJackpots($allbet);
                        if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                        {
                            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                        }
                        $slotSettings->SetBalance(-1 * $allbet, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $allbet / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $slotSettings->UpdateJackpots($allbet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $betline);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Denom', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination']);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                        $bonusMpl = 1;
                    }
                    else
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'] = $slotSettings->GetGameData($slotSettings->slotId . 'Denom');
                        $slotSettings->CurrentDenom = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                        $slotSettings->CurrentDenomination = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                        $betline = $slotSettings->GetGameData($slotSettings->slotId . 'Bet');
                        $allbet = $betline * $lines;
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                        $bonusMpl = $slotSettings->slotFreeMpl;
                    }
                    $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $allbet, $lines);
                    $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                    $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * $slotSettings->CurrentDenom * 100);
                    if( $winType == 'bonus' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $winType = 'win';
                    }
                    $_obf_0D1B23163B35245C1C1C2726192932403137111C102632 = '';
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        $totalWin = 0;
                        $lineWins = [];
                        $cWins = [
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0
                        ];
                        $wild = '1';
                        $scatter = '0';
                        $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811 = [];
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01 = $reels;
                        $WalkingWild = $slotSettings->GetGameData($slotSettings->slotId . 'WalkingWild');
                        $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '';
                        if( !is_array($WalkingWild) ) 
                        {
                            $WalkingWild = [];
                        }
                        foreach( $WalkingWild as $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01 ) 
                        {
                            $reels['reel' . $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01[0]][$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01[1]] = '1';
                        }
                        $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 = false;
                        if( rand(1, 15) == 1 && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' && $winType != 'bonus' ) 
                        {
                            $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 = true;
                        }
                        if( rand(1, 2) == 1 && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                            $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 = true;
                        }
                        if( $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 ) 
                        {
                            $_obf_0D2139131E5C0816392A3B1F3302253F331E133D5B0732 = [
                                1, 
                                2, 
                                3, 
                                4, 
                                5
                            ];
                            shuffle($_obf_0D2139131E5C0816392A3B1F3302253F331E133D5B0732);
                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '&feature.randomwilds.active=true';
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                            {
                                $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '&feature.randomwilds.active=true&next.rs=freespinwalkingwild';
                            }
                            $_obf_0D1A29071C31062825062A3012030833303F3613241411 = [];
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                                {
                                    if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] <= 6 && $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] >= 3 && rand(1, 2) == 1 ) 
                                    {
                                        $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = '1';
                                        $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 .= ('&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.row=' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.with=SYM1&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.pos=1&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.type=transform');
                                        $_obf_0D1A29071C31062825062A3012030833303F3613241411[] = ($r - 1) . '%3A' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '';
                                    }
                                }
                            }
                        }
                        $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 = 0;
                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '';
                        $_obf_0D1429360F31270405361919301D27322535111C390B32 = [];
                        for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                        {
                            $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = $slotSettings->SymbolGame[$j];
                            if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $scatter ) 
                            {
                            }
                            else
                            {
                                $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22 = [
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0
                                ];
                                $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 = 1;
                                $_obf_0D1C111B2432372F281601011A12053E03290318142222 = [];
                                $_obf_0D1B1910172D03132D040D301C2A39140C2F0A265C1532 = [];
                                $_obf_0D1B1910172D03132D040D301C2A39140C2F0A265C1532[20] = [
                                    [
                                        0, 
                                        1, 
                                        2, 
                                        3
                                    ], 
                                    [
                                        0, 
                                        1, 
                                        2, 
                                        3
                                    ], 
                                    [
                                        0, 
                                        1, 
                                        2, 
                                        3
                                    ], 
                                    [
                                        0, 
                                        1, 
                                        2, 
                                        3
                                    ], 
                                    [
                                        0, 
                                        1, 
                                        2, 
                                        3
                                    ]
                                ];
                                $_obf_0D03192821275B1E1B065C1D15161730081D1828362C01 = [
                                    0, 
                                    1, 
                                    2
                                ];
                                $_obf_0D16295B0631330A30050125140F2F031F04241C020932 = 0;
                                $_obf_0D1C011B1E170C5B1C082C1A3D22273F2B383F280F2D22 = 0;
                                for( $_obf_0D073D210B3816042B161A052B070A16343833352A3811 = 1; $_obf_0D073D210B3816042B161A052B070A16343833352A3811 <= 5; $_obf_0D073D210B3816042B161A052B070A16343833352A3811++ ) 
                                {
                                    $_obf_0D132B1D2C0F0C3E2F162519391315113F101B36321D11 = $_obf_0D1B1910172D03132D040D301C2A39140C2F0A265C1532[20][$_obf_0D073D210B3816042B161A052B070A16343833352A3811 - 1];
                                    foreach( $_obf_0D132B1D2C0F0C3E2F162519391315113F101B36321D11 as $_obf_0D27030E2310033F5B2C0B251C211D1D2E17343C160701 ) 
                                    {
                                        if( $reels['reel' . $_obf_0D073D210B3816042B161A052B070A16343833352A3811][$_obf_0D27030E2310033F5B2C0B251C211D1D2E17343C160701] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $reels['reel' . $_obf_0D073D210B3816042B161A052B070A16343833352A3811][$_obf_0D27030E2310033F5B2C0B251C211D1D2E17343C160701] == $wild ) 
                                        {
                                            $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[$_obf_0D073D210B3816042B161A052B070A16343833352A3811]++;
                                            $_obf_0D1C111B2432372F281601011A12053E03290318142222[] = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i' . $_obf_0D1C011B1E170C5B1C082C1A3D22273F2B383F280F2D22 . '=' . ($_obf_0D073D210B3816042B161A052B070A16343833352A3811 - 1) . '%2C' . $_obf_0D03192821275B1E1B065C1D15161730081D1828362C01[$_obf_0D27030E2310033F5B2C0B251C211D1D2E17343C160701];
                                            $_obf_0D1C011B1E170C5B1C082C1A3D22273F2B383F280F2D22++;
                                        }
                                    }
                                    if( $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[$_obf_0D073D210B3816042B161A052B070A16343833352A3811] <= 0 ) 
                                    {
                                        break;
                                    }
                                    $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 = $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[$_obf_0D073D210B3816042B161A052B070A16343833352A3811] * $_obf_0D352E0A230A18250933393D19150E1B3528100D381911;
                                }
                                if( $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[1] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[2] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[3] > 0 ) 
                                {
                                    $cWins[$j] = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $betline * $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 * $bonusMpl;
                                    $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=basic&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $cWins[$j] . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=243&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($cWins[$j] * $slotSettings->CurrentDenomination * 100) . '' . implode('', $_obf_0D1C111B2432372F281601011A12053E03290318142222);
                                }
                                if( $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[1] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[2] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[3] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[4] > 0 ) 
                                {
                                    $cWins[$j] = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $betline * $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 * $bonusMpl;
                                    $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=basic&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $cWins[$j] . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=243&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($cWins[$j] * $slotSettings->CurrentDenomination * 100) . '' . implode('', $_obf_0D1C111B2432372F281601011A12053E03290318142222);
                                }
                                if( $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[1] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[2] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[3] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[4] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[5] > 0 ) 
                                {
                                    $cWins[$j] = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $betline * $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 * $bonusMpl;
                                    $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=basic&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $cWins[$j] . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=243&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($cWins[$j] * $slotSettings->CurrentDenomination * 100) . '' . implode('', $_obf_0D1C111B2432372F281601011A12053E03290318142222);
                                }
                                if( $cWins[$j] > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                                {
                                    array_push($lineWins, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                                    $totalWin += $cWins[$j];
                                    $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01++;
                                }
                            }
                        }
                        $scattersWin = 0;
                        $scattersStr = '';
                        $scattersCount = 0;
                        $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 = 0;
                        $_obf_0D211F2C191026090B3F2F1A191C301A123F0C18082611 = [];
                        $_obf_0D1019220512010E1624270E3E5B342137073026231901 = [];
                        $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [];
                        $_obf_0D3D38311A23380A4014191A222D273F1A353715401601 = -1;
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                            {
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == $scatter ) 
                                {
                                    $scattersCount++;
                                    $_obf_0D312B19262C083426241E0D392E22282324060B380811[] = '&ws.i0.pos.i' . ($r - 1) . '=' . ($r - 1) . '%2C' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '';
                                }
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '2' && ($_obf_0D3D38311A23380A4014191A222D273F1A353715401601 == -1 || $_obf_0D3D38311A23380A4014191A222D273F1A353715401601 == $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32) ) 
                                {
                                    $_obf_0D28301D333F2827165C2511011438180336175B1E2A01++;
                                    $_obf_0D312B19262C083426241E0D392E22282324060B380811[] = '&ws.i0.pos.i' . ($r - 1) . '=' . ($r - 1) . '%2C' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '';
                                    $_obf_0D3D38311A23380A4014191A222D273F1A353715401601 = $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32;
                                }
                                if( $totalWin > 0 && $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '1' && $r > 1 ) 
                                {
                                    $_obf_0D211F2C191026090B3F2F1A191C301A123F0C18082611[] = [
                                        $r - 1, 
                                        $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32
                                    ];
                                }
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '1' && $totalWin > 0 ) 
                                {
                                    $_obf_0D1019220512010E1624270E3E5B342137073026231901[] = '1';
                                }
                                else
                                {
                                    $_obf_0D1019220512010E1624270E3E5B342137073026231901[] = '0';
                                }
                            }
                        }
                        $WalkingWild = $_obf_0D211F2C191026090B3F2F1A191C301A123F0C18082611;
                        if( count($_obf_0D211F2C191026090B3F2F1A191C301A123F0C18082611) > 1 ) 
                        {
                        }
                        else
                        {
                            if( $scattersCount >= 3 ) 
                            {
                                $scattersStr = '&ws.i0.types.i0.freespins=' . $slotSettings->slotFreeCount[$scattersCount] . '&ws.i0.reelset=basic&ws.i0.betline=null&ws.i0.types.i0.wintype=freespins&ws.i0.direction=none' . implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811);
                            }
                            $totalWin += $scattersWin;
                            if( $i > 1000 ) 
                            {
                                $winType = 'none';
                            }
                            if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($allbet * rand(2, 5)) ) 
                            {
                            }
                            else if( !$slotSettings->increaseRTP && $winType == 'win' && $allbet < $totalWin ) 
                            {
                            }
                            else
                            {
                                if( $i > 1500 ) 
                                {
                                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                                    exit( $response );
                                }
                                if( $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 3 && $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 < ($_obf_0D28301D333F2827165C2511011438180336175B1E2A01 * 5 * $allbet) && $winType == 'bonus' ) 
                                {
                                    $winType = 'none';
                                }
                                else if( ($scattersCount >= 3 || $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 3) && $winType != 'bonus' ) 
                                {
                                }
                                else if( $totalWin <= $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 && $winType == 'bonus' ) 
                                {
                                    $_obf_0D163F390C080D0831380D161E12270D0225132B261501 = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                                    if( $_obf_0D163F390C080D0831380D161E12270D0225132B261501 < $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 ) 
                                    {
                                        $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D163F390C080D0831380D161E12270D0225132B261501;
                                    }
                                    else
                                    {
                                        break;
                                    }
                                }
                                else if( $totalWin > 0 && $totalWin <= $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 && $winType == 'win' ) 
                                {
                                    $_obf_0D163F390C080D0831380D161E12270D0225132B261501 = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                                    if( $_obf_0D163F390C080D0831380D161E12270D0225132B261501 < $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 ) 
                                    {
                                        $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D163F390C080D0831380D161E12270D0225132B261501;
                                    }
                                    else
                                    {
                                        break;
                                    }
                                }
                                else if( $totalWin == 0 && $winType == 'none' ) 
                                {
                                    break;
                                }
                            }
                        }
                    }
                    $freeState = '';
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                        $slotSettings->SetBalance($totalWin);
                    }
                    $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                    $reels = $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01;
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = ' &rs.i0.r.i0.syms=SYM' . $reels['reel1'][0] . '%2CSYM' . $reels['reel1'][1] . '%2CSYM' . $reels['reel1'][2] . '';
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.syms=SYM' . $reels['reel2'][0] . '%2CSYM' . $reels['reel2'][1] . '%2CSYM' . $reels['reel2'][2] . '');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.syms=SYM' . $reels['reel3'][0] . '%2CSYM' . $reels['reel3'][1] . '%2CSYM' . $reels['reel3'][2] . '');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.syms=SYM' . $reels['reel4'][0] . '%2CSYM' . $reels['reel4'][1] . '%2CSYM' . $reels['reel4'][2] . '');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.syms=SYM' . $reels['reel5'][0] . '%2CSYM' . $reels['reel5'][1] . '%2CSYM' . $reels['reel5'][2] . '');
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    }
                    $fs = 0;
                    if( $scattersCount >= 3 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount[$scattersCount]);
                        $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $freeState = '&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19&freespins.totalwin.cents=0&nextaction=freespin&freespins.left=' . $fs . '&freespins.wavecount=1&freespins.multiplier=1&gamestate.stack=basic%2Cfreespin&freespins.totalwin.coins=0&freespins.total=' . $fs . '&freespins.win.cents=0&gamestate.current=freespin&freespins.initial=' . $fs . '&freespins.win.coins=0&rs.i0.nearwin=4&freespins.betlevel=' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet') . '&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&next.rs=freespin&rs.i0.r.i2.attention.i0=1&rs.i0.r.i0.attention.i0=0&rs.i0.r.i4.attention.i0=1&rs.i0.nearwin=4&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= $freeState;
                    }
                    $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32 = '';
                    $_obf_0D0422223816021522032514083116023435011B112122 = [];
                    $_obf_0D08170309223C210A33162F081F15360C221317110E32 = 0;
                    if( $scattersCount >= 2 ) 
                    {
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                            {
                                if( $_obf_0D08170309223C210A33162F081F15360C221317110E32 >= 2 && $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 == 0 && ($r == 1 || $r == 3 || $r == 5) ) 
                                {
                                    $_obf_0D0422223816021522032514083116023435011B112122[] = $r - 1;
                                }
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '0' && $r < 5 ) 
                                {
                                    $_obf_0D08170309223C210A33162F081F15360C221317110E32++;
                                }
                            }
                        }
                        if( $_obf_0D08170309223C210A33162F081F15360C221317110E32 >= 2 ) 
                        {
                            $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32 = '&rs.i0.nearwin=' . implode('%2C', $_obf_0D0422223816021522032514083116023435011B112122);
                        }
                    }
                    else if( $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 2 ) 
                    {
                        $_obf_0D0E172B013F26073D2C082734322F1F342A1D3B2C3101 = -1;
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                            {
                                if( $_obf_0D08170309223C210A33162F081F15360C221317110E32 >= 2 && $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 == 0 ) 
                                {
                                    $_obf_0D0422223816021522032514083116023435011B112122[] = $r - 1;
                                }
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '2' && $r < 5 && ($_obf_0D0E172B013F26073D2C082734322F1F342A1D3B2C3101 == -1 || $_obf_0D0E172B013F26073D2C082734322F1F342A1D3B2C3101 == $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32) ) 
                                {
                                    $_obf_0D0E172B013F26073D2C082734322F1F342A1D3B2C3101 = $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32;
                                    $_obf_0D08170309223C210A33162F081F15360C221317110E32++;
                                }
                            }
                        }
                        if( $_obf_0D08170309223C210A33162F081F15360C221317110E32 >= 2 ) 
                        {
                            $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32 = '&rs.i0.nearwin=' . implode('%2C', $_obf_0D0422223816021522032514083116023435011B112122);
                        }
                    }
                    $_obf_0D2B350C365C16222A271F0C29211722180A3F1F351211 = '';
                    if( $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 3 ) 
                    {
                        $_obf_0D2B350C365C16222A271F0C29211722180A3F1F351211 = 'gameServerVersion=1.21.0&g4mode=false&playercurrency=%26%23x20AC%3B&rs.i0.nearwin=2%2C3%2C4&historybutton=false&rs.i0.r.i4.hold=false&next.rs=respin&gamestate.history=basic&lockup.cluster.i0.sym.i1.value=60&lockup.deltawin.cents=800&rs.i0.r.i1.syms=SYM12%2CSYM2%2CSYM6&lockup.respins.left=3&game.win.cents=0&rs.i0.id=basicwalkingwild&totalwin.coins=0&credit=500625&gamestate.current=respin&jackpotcurrency=%26%23x20AC%3B&multiplier=1&walkingwilds.pos=0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0&rs.i0.r.i0.syms=SYM11%2CSYM2%2CSYM12&rs.i0.r.i3.syms=SYM8%2CSYM7%2CSYM10&rs.i0.r.i1.overlay.i0.row=0&lockup.win.cents=800&isJackpotWin=false&gamestate.stack=basic%2Crespin&rs.i0.r.i0.pos=77&lockup.cluster.i0.sym.i0.value=60&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i0.r.i1.pos=21&game.win.coins=0&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i1.hold=false&lockup.cluster.i0.sym.i2.pos=2%2C1&rs.i0.r.i1.overlay.i0.pos=21&lockup.deltawin.coins=160&playforfun=true&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=spin&rs.i0.r.i2.hold=false&rs.i0.r.i4.syms=SYM10%2CSYM2%2CSYM4&lockup.cluster.i0.sym.i0.pos=4%2C1&rs.i0.r.i2.pos=76&totalwin.cents=0&gameover=false&rs.i0.r.i0.hold=false&rs.i0.r.i3.pos=67&rs.i0.r.i4.pos=44&lockup.cluster.i0.sym.i2.value=40&lockup.win.coins=160&nextaction=respin&wavecount=1&rs.i0.r.i1.overlay.i0.with=SYM1&rs.i0.r.i2.syms=SYM9%2CSYM0%2CSYM4&lockup.cluster.i0.sym.i1.pos=3%2C1&rs.i0.r.i3.hold=false&game.win.amount=0' . $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32;
                    }
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode('', $lineWins);
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                    $slotSettings->SetGameData($slotSettings->slotId . 'GambleStep', 5);
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = $slotSettings->GetGameData($slotSettings->slotId . 'Cards');
                    $_obf_0D2D1F17141D3509383B2328141A060130300A0A242A11 = 'false';
                    if( $totalWin > 0 ) 
                    {
                        $state = 'gamble';
                        $_obf_0D2504370B381725111D5B2E380422185B2F4010370D22 = 'false';
                        $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'spin';
                        $_obf_0D2504370B381725111D5B2E380422185B2F4010370D22 = 'true';
                    }
                    else
                    {
                        $state = 'idle';
                        $_obf_0D2504370B381725111D5B2E380422185B2F4010370D22 = 'true';
                        $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'spin';
                    }
                    $_obf_0D2504370B381725111D5B2E380422185B2F4010370D22 = 'true';
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $totalWin = $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') ) 
                        {
                            $_obf_0D303F16312E40390715020810063830132C2E38340B32 = '0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0';
                            $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'spin';
                            $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 = 'basic';
                            $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 = 'basic';
                        }
                        else
                        {
                            $_obf_0D303F16312E40390715020810063830132C2E38340B32 = '0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0';
                            $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 = 'freespin';
                            $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'freespin';
                            $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 = 'basic%2Cfreespin';
                        }
                        $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $freeState = '&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19&freespins.totalwin.cents=0&nextaction=' . $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 . '&freespins.left=' . $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 . '&freespins.wavecount=1&freespins.multiplier=1&gamestate.stack=' . $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 . '&freespins.totalwin.coins=' . $totalWin . '&freespins.total=' . $fs . '&freespins.win.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&gamestate.current=' . $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 . '&freespins.initial=' . $fs . '&freespins.win.coins=' . $totalWin . '&freespins.betlevel=' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet') . '&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= $freeState;
                    }
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"freeState":"' . $freeState . '","slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastResponse', $response);
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * $slotSettings->CurrentDenom * 100);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WalkingWild', $WalkingWild);
                    if( $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 3 ) 
                    {
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '&rs.i0.r.i0.syms=SYM' . $reels['reel1'][0] . '%2CSYM' . $reels['reel1'][1] . '%2CSYM' . $reels['reel1'][2] . '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.syms=SYM' . $reels['reel2'][0] . '%2CSYM' . $reels['reel2'][1] . '%2CSYM' . $reels['reel2'][2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.syms=SYM' . $reels['reel3'][0] . '%2CSYM' . $reels['reel3'][1] . '%2CSYM' . $reels['reel3'][2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.syms=SYM' . $reels['reel4'][0] . '%2CSYM' . $reels['reel4'][1] . '%2CSYM' . $reels['reel4'][2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.syms=SYM' . $reels['reel5'][0] . '%2CSYM' . $reels['reel5'][1] . '%2CSYM' . $reels['reel5'][2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i0.pos' . $reels['rp'][0]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.pos' . $reels['rp'][1]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.pos' . $reels['rp'][2]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.pos' . $reels['rp'][3]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.pos' . $reels['rp'][4]);
                        $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                        for( $_obf_0D172A041C3F3B1E363407160C0D1021102E2B123D0B01 = 0; $_obf_0D172A041C3F3B1E363407160C0D1021102E2B123D0B01 <= 500; $_obf_0D172A041C3F3B1E363407160C0D1021102E2B123D0B01++ ) 
                        {
                            $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 = '';
                            $clusterAllWin = 0;
                            $_obf_0D312E38053C21022F2D2D0D282C5C243F110421292901 = [
                                1, 
                                1, 
                                1, 
                                1, 
                                2, 
                                2, 
                                2, 
                                2, 
                                3, 
                                4, 
                                5, 
                                1, 
                                2, 
                                3, 
                                4, 
                                5, 
                                6, 
                                7, 
                                8, 
                                9, 
                                10, 
                                1, 
                                2, 
                                3, 
                                4, 
                                5, 
                                1, 
                                2, 
                                3, 
                                4, 
                                5, 
                                6, 
                                7, 
                                8, 
                                9, 
                                10
                            ];
                            $clusterSymWinsArr = [
                                [], 
                                [], 
                                [], 
                                [], 
                                [], 
                                []
                            ];
                            $clusterSymAllWins = [];
                            $_obf_0D1403372226193C33091132321F25180B0A2B37240D32 = $slotSettings->GetCluster($reels);
                            $_obf_0D175B110C313101261119190B1640321D0602340A0832 = 0;
                            $_obf_0D1F3D35230517381B2D0F1F35281F34012D0C40273E01 = 0;
                            $_obf_0D0422223816021522032514083116023435011B112122 = [];
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                                {
                                    shuffle($_obf_0D312E38053C21022F2D2D0D282C5C243F110421292901);
                                    $clusterSymWinsArr[$r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = $_obf_0D312E38053C21022F2D2D0D282C5C243F110421292901[0];
                                    if( $_obf_0D1403372226193C33091132321F25180B0A2B37240D32['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '2c' ) 
                                    {
                                        $_obf_0D362832171714063F2F145B3E251F362B012122193D32 = $clusterSymWinsArr[$r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] * $allbet;
                                        $clusterAllWin += $_obf_0D362832171714063F2F145B3E251F362B012122193D32;
                                        $clusterSymAllWins[$_obf_0D1F3D35230517381B2D0F1F35281F34012D0C40273E01] = $_obf_0D362832171714063F2F145B3E251F362B012122193D32;
                                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.cluster.i0.sym.i' . $_obf_0D175B110C313101261119190B1640321D0602340A0832 . '.value=' . $_obf_0D362832171714063F2F145B3E251F362B012122193D32);
                                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.cluster.i0.sym.i' . $_obf_0D175B110C313101261119190B1640321D0602340A0832 . '.pos=' . ($r - 1) . '%2C' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32);
                                        $_obf_0D175B110C313101261119190B1640321D0602340A0832++;
                                        $_obf_0D1F3D35230517381B2D0F1F35281F34012D0C40273E01++;
                                    }
                                }
                            }
                            if( $clusterAllWin <= $bank ) 
                            {
                                $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $clusterAllWin);
                                $slotSettings->SetBalance($clusterAllWin);
                                $slotSettings->SetGameData($slotSettings->slotId . 'clusterSymWinsArr', $clusterSymWinsArr);
                                $slotSettings->SetGameData($slotSettings->slotId . 'clusterAllWin', $clusterAllWin);
                                $slotSettings->SetGameData($slotSettings->slotId . 'clusterSymAllWins', $clusterSymAllWins);
                                $slotSettings->SetGameData($slotSettings->slotId . 'clusterReels', $_obf_0D1403372226193C33091132321F25180B0A2B37240D32);
                                $slotSettings->SetGameData($slotSettings->slotId . 'AllBet', $allbet);
                                break;
                            }
                        }
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.deltawin.cents=' . ($clusterAllWin * $slotSettings->CurrentDenomination * 100));
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.win.cents=' . ($clusterAllWin * $slotSettings->CurrentDenomination * 100));
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.deltawin.coins=' . $clusterAllWin);
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&lockup.win.coins=' . $clusterAllWin);
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&totalwin.coins=' . $clusterAllWin);
                        $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 .= ('&game.win.coins=' . $clusterAllWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'StaticBalance', $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                        $slotSettings->SetGameData($slotSettings->slotId . 'ClusterSpinCount', 3);
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'gameServerVersion=1.21.0&g4mode=false&playercurrency=%26%23x20AC%3B&historybutton=false&rs.i0.r.i4.hold=false&next.rs=respin&gamestate.history=basic&lockup.deltawin.cents=800&rs.i0.r.i1.syms=SYM12%2CSYM2%2CSYM6&lockup.respins.left=3&game.win.cents=0&rs.i0.id=basicwalkingwild&totalwin.coins=0&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&gamestate.current=respin&jackpotcurrency=%26%23x20AC%3B&multiplier=1&walkingwilds.pos=' . implode('%2C', $_obf_0D1019220512010E1624270E3E5B342137073026231901) . '&rs.i0.r.i0.syms=SYM11%2CSYM2%2CSYM12&rs.i0.r.i3.syms=SYM8%2CSYM7%2CSYM10&lockup.win.cents=800&isJackpotWin=false&gamestate.stack=basic%2Crespin&rs.i0.r.i0.pos=77&gamesoundurl=&rs.i0.r.i1.pos=21&game.win.coins=0&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i1.hold=false&lockup.deltawin.coins=160&playforfun=true&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=spin&rs.i0.r.i2.hold=false&rs.i0.r.i4.syms=SYM10%2CSYM2%2CSYM4&totalwin.cents=0&gameover=false&rs.i0.r.i0.hold=false&rs.i0.r.i3.pos=67&rs.i0.r.i4.pos=44&lockup.win.coins=160&nextaction=respin&wavecount=1&rs.i0.r.i2.syms=SYM9%2CSYM0%2CSYM4&rs.i0.r.i3.hold=false&game.win.amount=0' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D113626242D1B043F3628373C252838273D232A1D3422 . $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32;
                        $slotSettings->SaveLogReport($response, $allbet, 1, $clusterAllWin, 'FG2');
                    }
                    else if( $scattersCount >= 3 ) 
                    {
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = ' &rs.i0.r.i0.syms=SYM' . $reels['reel1'][0] . '%2CSYM' . $reels['reel1'][1] . '%2CSYM' . $reels['reel1'][2] . '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.syms=SYM' . $reels['reel2'][0] . '%2CSYM' . $reels['reel2'][1] . '%2CSYM' . $reels['reel2'][2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.syms=SYM' . $reels['reel3'][0] . '%2CSYM' . $reels['reel3'][1] . '%2CSYM' . $reels['reel3'][2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.syms=SYM' . $reels['reel4'][0] . '%2CSYM' . $reels['reel4'][1] . '%2CSYM' . $reels['reel4'][2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.syms=SYM' . $reels['reel5'][0] . '%2CSYM' . $reels['reel5'][1] . '%2CSYM' . $reels['reel5'][2] . '');
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'freespins.betlevel=1&ws.i0.pos.i2=2%2C1&gameServerVersion=1.21.0&g4mode=false&freespins.win.coins=0&playercurrency=%26%23x20AC%3B&rs.i0.nearwin=4&historybutton=false&rs.i0.r.i4.hold=false&ws.i0.types.i0.freespins=10&ws.i0.reelset=basicwalkingwild&next.rs=freespin&gamestate.history=basic&ws.i0.pos.i1=4%2C1&ws.i0.pos.i0=0%2C0&rs.i0.r.i1.syms=SYM12%2CSYM5%2CSYM9&game.win.cents=0&ws.i0.betline=null&rs.i0.id=basicwalkingwild&totalwin.coins=0&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&gamestate.current=freespin&freespins.initial=10&jackpotcurrency=%26%23x20AC%3B&multiplier=1&walkingwilds.pos=' . implode('%2C', $_obf_0D1019220512010E1624270E3E5B342137073026231901) . '&freespins.denomination=5.000&rs.i0.r.i0.syms=SYM0%2CSYM7%2CSYM11&rs.i0.r.i3.syms=SYM4%2CSYM10%2CSYM9&freespins.win.cents=0&ws.i0.sym=SYM0&freespins.totalwin.coins=0&freespins.total=10&ws.i0.direction=none&isJackpotWin=false&gamestate.stack=basic%2Cfreespin&rs.i0.r.i0.pos=2&freespins.betlines=243&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&ws.i0.types.i0.wintype=freespins&rs.i0.r.i1.pos=17&game.win.coins=0&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i1.hold=false&rs.i0.r.i2.attention.i0=1&freespins.wavecount=1&rs.i0.r.i4.attention.i0=1&freespins.multiplier=1&playforfun=true&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=spin&rs.i0.r.i2.hold=false&rs.i0.r.i4.syms=SYM5%2CSYM0%2CSYM7&rs.i0.r.i2.pos=32&rs.i0.r.i0.attention.i0=0&totalwin.cents=0&gameover=false&rs.i0.r.i0.hold=false&rs.i0.r.i3.pos=51&freespins.left=10&rs.i0.r.i4.pos=65&nextaction=freespin&wavecount=1&ws.i0.types.i0.multipliers=1&rs.i0.r.i2.syms=SYM11%2CSYM0%2CSYM6&rs.i0.r.i3.hold=false&game.win.amount=0.00&freespins.totalwin.cents=0' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32;
                    }
                    else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = ' &rs.i0.r.i0.syms=SYM' . $reels['reel1'][0] . '%2CSYM' . $reels['reel1'][1] . '%2CSYM' . $reels['reel1'][2] . '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.syms=SYM' . $reels['reel2'][0] . '%2CSYM' . $reels['reel2'][1] . '%2CSYM' . $reels['reel2'][2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.syms=SYM' . $reels['reel3'][0] . '%2CSYM' . $reels['reel3'][1] . '%2CSYM' . $reels['reel3'][2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.syms=SYM' . $reels['reel4'][0] . '%2CSYM' . $reels['reel4'][1] . '%2CSYM' . $reels['reel4'][2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.syms=SYM' . $reels['reel5'][0] . '%2CSYM' . $reels['reel5'][1] . '%2CSYM' . $reels['reel5'][2] . '');
                        $_obf_0D39133F141804372B310E173B14081532311D391F3022 = $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'freespins.betlevel=' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet') . '&gameServerVersion=1.21.0&g4mode=false&freespins.win.coins=' . $_obf_0D39133F141804372B310E173B14081532311D391F3022 . '&playercurrency=%26%23x20AC%3B&historybutton=false&rs.i0.r.i4.hold=false&next.rs=freespin&gamestate.history=basic%2Cfreespin&rs.i0.r.i1.syms=SYM1%2CSYM10%2CSYM8&game.win.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.id=freespin&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&gamestate.current=' . $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 . '&freespins.initial=' . $fs . '&jackpotcurrency=%26%23x20AC%3B&multiplier=1&walkingwilds.pos=0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0%2C0&last.rs=freespin&freespins.denomination=5.000&rs.i0.r.i0.syms=SYM6%2CSYM8%2CSYM9&rs.i0.r.i3.syms=SYM6%2CSYM12%2CSYM8&freespins.win.cents=' . ($_obf_0D39133F141804372B310E173B14081532311D391F3022 * $slotSettings->CurrentDenomination * 100) . '&freespins.totalwin.coins=' . $_obf_0D39133F141804372B310E173B14081532311D391F3022 . '&freespins.total=' . $fs . '&isJackpotWin=false&gamestate.stack=' . $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 . '&rs.i0.r.i0.pos=3&freespins.betlines=243&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i0.r.i1.pos=6&game.win.coins=' . $totalWin . '&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i1.hold=false&freespins.wavecount=1&freespins.multiplier=1&playforfun=true&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=freespin&rs.i0.r.i2.hold=false&rs.i0.r.i4.syms=SYM8%2CSYM11%2CSYM9&rs.i0.r.i2.pos=0&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&gameover=false&rs.i0.r.i0.hold=false&rs.i0.r.i3.pos=0&freespins.left=' . $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 . '&rs.i0.r.i4.pos=52&freespinwalkingwilds=' . implode('%2C', $_obf_0D1019220512010E1624270E3E5B342137073026231901) . '&nextaction=' . $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 . '&wavecount=1&rs.i0.r.i2.syms=SYM3%2CSYM11%2CSYM12&rs.i0.r.i3.hold=false&game.win.amount=' . ($_obf_0D39133F141804372B310E173B14081532311D391F3022 / $slotSettings->CurrentDenomination) . '&freespins.totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32;
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '&rs.i0.r.i1.pos=16&gameServerVersion=1.21.0&g4mode=false&game.win.coins=' . $totalWin . '&playercurrency=%26%23x20AC%3B&playercurrencyiso=' . $slotSettings->slotCurrency . '&historybutton=false&freespinwalkingwilds=' . implode('%2C', $_obf_0D1019220512010E1624270E3E5B342137073026231901) . '&rs.i0.r.i1.hold=false&rs.i0.r.i4.hold=false&next.rs=basic&gamestate.history=basic&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=spin&rs.i0.r.i1.syms=SYM1%2CSYM12%2CSYM11&rs.i0.r.i2.hold=false&rs.i0.r.i4.syms=SYM7%2CSYM12%2CSYM2&game.win.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.r.i2.pos=10&rs.i0.id=basic&totalwin.coins=0&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&gameover=true&gamestate.current=basic&rs.i0.r.i0.hold=false&jackpotcurrency=%26%23x20AC%3B&multiplier=1&rs.i0.r.i3.pos=17&walkingwilds.pos=' . implode('%2C', $_obf_0D1019220512010E1624270E3E5B342137073026231901) . '&rs.i0.r.i4.pos=83&rs.i0.r.i0.syms=SYM2%2CSYM7%2CSYM6&rs.i0.r.i3.syms=SYM2%2CSYM11%2CSYM7&isJackpotWin=false&gamestate.stack=basic&nextaction=spin&rs.i0.r.i0.pos=105&wavecount=1&gamesoundurl=&rs.i0.r.i2.syms=SYM9%2CSYM4%2CSYM0&rs.i0.r.i3.hold=false&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 . $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32;
                    }
                    break;
            }
            $response = $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0];
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
