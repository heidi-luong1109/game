<?php 
namespace VanguardLTE\Games\VikingsNET
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
                    $slotSettings->SetGameData('VikingsNETBonusWin', 0);
                    $slotSettings->SetGameData('VikingsNETFreeGames', 0);
                    $slotSettings->SetGameData('VikingsNETCurrentFreeGame', 0);
                    $slotSettings->SetGameData('VikingsNETTotalWin', 0);
                    $slotSettings->SetGameData('VikingsNETFreeBalance', 0);
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
                    if( $slotSettings->GetGameData('VikingsNETCurrentFreeGame') < $slotSettings->GetGameData('VikingsNETFreeGames') && $slotSettings->GetGameData('VikingsNETFreeGames') > 0 ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'previous.rs.i0=freespin&rs.i1.r.i0.syms=SYM10%2CSYM12%2CSYM12%2CSYM8%2CSYM4&gameServerVersion=1.3.0&g4mode=false&freespins.win.coins=4&rs.i0.nearwin=4&historybutton=false&rs.i0.r.i4.hold=false&gameEventSetters.enabled=false&next.rs=freespin&gamestate.history=basic%2Cfreespin&rs.i1.r.i2.hold=false&rs.i1.r.i3.pos=7&rs.i0.r.i1.syms=SYM3%2CSYM3%2CSYM3&game.win.cents=136&staticsharedurl=https%3A%2F%2Fstatic-shared.casinomodule.com%2Fgameclient_html%2Fdevicedetection%2Fcurrent&ws.i0.betline=0&bl.i0.reelset=ALL&rs.i1.r.i3.hold=false&totalwin.coins=68&gamestate.current=freespin&freespins.initial=7&jackpotcurrency=%26%23x20AC%3B&bet.betlines=0&rs.i0.r.i0.syms=SYM10%2CSYM8%2CSYM8&rs.i0.r.i3.syms=SYM11%2CSYM0%2CSYM9&rs.i1.r.i1.syms=SYM11%2CSYM9%2CSYM8%2CSYM9%2CSYM11&rs.i1.r.i1.pos=21&freespins.win.cents=8&isJackpotWin=false&rs.i1.r.i5.hold=false&rs.i0.r.i0.pos=31&freespins.betlines=0&rs.i0.r.i1.pos=66&rs.i1.r.i3.syms=SYM9%2CSYM12%2CSYM12%2CSYM9%2CSYM12&game.win.coins=68&rs.i1.r.i0.hold=false&rs.i0.r.i1.hold=false&clientaction=init&rs.i0.r.i2.hold=false&casinoID=netent&betlevel.standard=1&gameover=false&rs.i1.r.i6.hold=false&rs.i0.r.i3.pos=77&bl.i0.id=0&bl.i0.line=0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4&nextaction=freespin&rs.i0.r.i2.syms=SYM0%2CSYM10%2CSYM12&rs.i1.r.i6.pos=162&game.win.amount=1.36&betlevel.all=1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10&freespins.totalwin.cents=136&rs.i1.r.i6.syms=SYM4%2CSYM4%2CSYM9%2CSYM12%2CSYM9&denomination.all=' . implode('%2C', $slotSettings->Denominations) . '&freespins.betlevel=1&ws.i0.pos.i2=2%2C0&playercurrency=%26%23x20AC%3B&current.rs.i0=freespin&ws.i0.reelset=freespin&ws.i0.pos.i1=0%2C3&ws.i0.pos.i0=1%2C2&rs.i0.id=basic&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&rs.i1.r.i5.syms=SYM10%2CSYM8%2CSYM10%2CSYM8%2CSYM7&rs.i1.r.i4.pos=23&denomination.standard=' . ($slotSettings->CurrentDenomination * 100) . '&ws.i0.types.i0.coins=4&multiplier=1&last.rs=freespin&freespins.denomination=2.000&autoplay=10%2C25%2C50%2C75%2C100%2C250%2C500%2C750%2C1000&ws.i0.sym=SYM8&freespins.totalwin.coins=68&ws.i0.direction=left_to_right&freespins.total=7&gamestate.stack=basic%2Cfreespin&rs.i1.r.i4.syms=SYM11%2CSYM9%2CSYM8%2CSYM10%2CSYM10&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i1.r.i2.pos=156&bet.betlevel=1&ws.i0.types.i0.wintype=coins&nearwinallowed=true&ws.i0.aftershieldwall=false&playercurrencyiso=' . $slotSettings->slotCurrency . '&freespins.wavecount=1&freespins.multiplier=1&playforfun=true&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM0%2CSYM8%2CSYM10&rs.i0.r.i2.pos=12&rs.i1.r.i2.syms=SYM8%2CSYM12%2CSYM10%2CSYM5%2CSYM5&rs.i1.r.i0.pos=129&totalwin.cents=136&bl.i0.coins=20&rs.i1.r.i5.pos=131&rs.i0.r.i0.hold=false&restore=true&rs.i1.id=freespin&rs.i1.r.i4.hold=false&freespins.left=5&rs.i0.r.i4.pos=66&ws.i0.types.i0.cents=8&bl.standard=0&wavecount=1&rs.i1.r.i1.hold=false&rs.i0.r.i3.hold=false&bet.denomination=2' . $freeState;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'denomination.all=' . implode('%2C', $slotSettings->Denominations) . '&rs.i1.r.i0.syms=SYM11%2CSYM6%2CSYM6&rs.i0.r.i6.pos=0&gameServerVersion=1.3.0&g4mode=false&playercurrency=%26%23x20AC%3B&historybutton=false&rs.i0.r.i4.hold=false&gameEventSetters.enabled=false&rs.i1.r.i2.hold=false&rs.i1.r.i3.pos=0&rs.i0.r.i1.syms=SYM9%2CSYM11%2CSYM8%2CSYM9%2CSYM4&rs.i0.r.i5.hold=false&game.win.cents=0&staticsharedurl=https%3A%2F%2Fstatic-shared.casinomodule.com%2Fgameclient_html%2Fdevicedetection%2Fcurrent&rs.i0.id=freespin&bl.i0.reelset=ALL&rs.i1.r.i3.hold=false&totalwin.coins=0&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&rs.i1.r.i4.pos=0&gamestate.current=basic&denomination.standard=' . ($slotSettings->CurrentDenomination * 100) . '&rs.i0.r.i6.syms=SYM9%2CSYM9%2CSYM12%2CSYM5%2CSYM12&jackpotcurrency=%26%23x20AC%3B&multiplier=1&rs.i0.r.i0.syms=SYM8%2CSYM11%2CSYM12%2CSYM10%2CSYM10&rs.i0.r.i3.syms=SYM9%2CSYM12%2CSYM8%2CSYM12%2CSYM9&rs.i1.r.i1.syms=SYM13%2CSYM13%2CSYM11&rs.i1.r.i1.pos=0&autoplay=10%2C25%2C50%2C75%2C100%2C250%2C500%2C750%2C1000&isJackpotWin=false&rs.i0.r.i0.pos=0&rs.i1.r.i4.syms=SYM12%2CSYM10%2CSYM4&gamesoundurl=&rs.i1.r.i2.pos=0&nearwinallowed=true&rs.i0.r.i1.pos=0&rs.i1.r.i3.syms=SYM8%2CSYM13%2CSYM10&game.win.coins=0&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i1.r.i0.hold=false&rs.i0.r.i5.syms=SYM12%2CSYM10%2CSYM8%2CSYM11%2CSYM12&rs.i0.r.i1.hold=false&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=init&rs.i0.r.i2.hold=false&rs.i0.r.i4.syms=SYM12%2CSYM11%2CSYM12%2CSYM12%2CSYM11&rs.i0.r.i2.pos=0&rs.i1.r.i2.syms=SYM13%2CSYM11%2CSYM9&casinoID=netent&betlevel.standard=1&rs.i1.r.i0.pos=0&totalwin.cents=0&gameover=true&bl.i0.coins=20&rs.i0.r.i0.hold=false&restore=false&rs.i1.id=basic&rs.i0.r.i6.hold=false&rs.i0.r.i3.pos=0&rs.i1.r.i4.hold=false&rs.i0.r.i4.pos=0&bl.i0.id=0&bl.standard=0&bl.i0.line=0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4&nextaction=spin&rs.i0.r.i5.pos=0&wavecount=1&rs.i0.r.i2.syms=SYM9%2CSYM9%2CSYM12%2CSYM11%2CSYM12&rs.i1.r.i1.hold=false&rs.i0.r.i3.hold=false&game.win.amount=0&betlevel.all=1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32;
                    break;
                case 'paytable':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'pt.i0.comp.i46.n=4&pt.i2.comp.i79.multi=200000&pt.i1.comp.i47.multi=10&pt.i0.comp.i29.type=betline&pt.i2.comp.i78.n=26&pt.i0.comp.i5.freespins=0&pt.i2.comp.i32.n=5&pt.i1.comp.i34.multi=20&pt.i2.comp.i66.multi=3240&pt.i2.comp.i64.freespins=0&pt.i2.comp.i44.symbol=SYM5&pt.i0.comp.i13.symbol=SYM5&pt.i2.comp.i126.freespins=0&pt.i1.comp.i4.n=7&pt.i0.comp.i15.multi=6&pt.i2.comp.i122.n=5&pt.i0.comp.i28.multi=16&pt.i2.comp.i14.type=scatter&pt.i1.comp.i43.freespins=0&pt.i2.comp.i100.symbol=SYM7&pt.i1.comp.i29.freespins=0&pt.i2.comp.i108.symbol=SYM8&pt.i2.comp.i110.multi=4&pt.i0.comp.i11.n=4&pt.i1.comp.i23.symbol=SYM7&pt.i2.comp.i128.multi=16&pt.i2.comp.i5.freespins=0&pt.i2.comp.i85.symbol=SYM7&pt.i2.comp.i122.type=betline&pt.i2.comp.i67.n=15&pt.i0.id=basic&pt.i2.comp.i21.n=19&pt.i0.comp.i4.symbol=SYM3&pt.i2.comp.i4.type=betline&pt.i1.comp.i8.symbol=SYM4&pt.i0.comp.i17.freespins=0&pt.i2.comp.i40.multi=2160&pt.i0.comp.i10.multi=6&pt.i2.comp.i1.multi=40&pt.i2.comp.i38.type=scatter&pt.i1.comp.i34.freespins=0&pt.i2.comp.i47.type=scatter&pt.i2.comp.i21.freespins=0&pt.i2.comp.i102.multi=170000&pt.i0.comp.i24.n=7&pt.i2.comp.i54.n=27&pt.i2.comp.i115.multi=2&pt.i2.comp.i74.symbol=SYM6&pt.i1.comp.i42.multi=10&pt.i2.comp.i74.multi=80000&pt.i2.comp.i72.type=scatter&pt.i0.comp.i22.type=betline&pt.i1.comp.i38.type=betline&pt.i1.comp.i13.multi=24&pt.i2.comp.i45.multi=14000&pt.i2.comp.i61.multi=320&pt.i2.comp.i89.n=12&pt.i2.comp.i31.type=scatter&pt.i0.comp.i35.n=3&pt.i2.comp.i43.n=16&pt.i0.comp.i13.type=betline&pt.i2.comp.i108.freespins=0&pt.i2.comp.i82.freespins=0&pt.i1.comp.i47.freespins=0&pt.i1.comp.i7.freespins=0&pt.i0.comp.i31.freespins=0&pt.i2.comp.i88.type=scatter&pt.i2.comp.i105.type=betline&pt.i1.comp.i22.type=betline&pt.i2.comp.i122.freespins=0&pt.i2.comp.i82.multi=20&pt.i2.comp.i127.symbol=SYM12&pt.i2.comp.i68.freespins=0&pt.i2.comp.i91.freespins=0&pt.i1.comp.i6.n=4&pt.i1.comp.i31.type=betline&pt.i2.comp.i6.multi=10&pt.i2.comp.i122.symbol=SYM11&pt.i2.comp.i34.n=7&pt.i2.comp.i32.multi=20&pt.i0.comp.i44.n=7&pt.i0.comp.i37.type=betline&pt.i0.comp.i35.freespins=0&pt.i2.comp.i124.n=7&pt.i2.comp.i16.freespins=0&pt.i2.comp.i30.freespins=0&pt.i1.comp.i46.type=betline&pt.i0.comp.i5.multi=6&pt.i2.comp.i69.n=17&pt.i2.comp.i114.type=betline&pt.i2.comp.i79.type=scatter&pt.i1.comp.i4.type=betline&pt.i1.comp.i18.multi=24&pt.i2.comp.i23.n=21&pt.i2.comp.i9.freespins=0&pt.i0.comp.i1.freespins=0&pt.i2.comp.i40.type=scatter&pt.i0.comp.i22.n=5&pt.i2.comp.i55.freespins=0&pt.i1.comp.i0.symbol=SYM3&pt.i2.comp.i119.symbol=SYM10&pt.i1.comp.i5.multi=6&pt.i2.comp.i55.type=scatter&pt.i1.comp.i39.multi=20&pt.i2.comp.i56.n=4&pt.i0.comp.i21.type=betline&pt.i2.comp.i10.n=8&pt.i2.comp.i111.symbol=SYM9&pt.i2.comp.i129.type=betline&pt.i0.comp.i30.type=betline&pt.i2.comp.i100.n=23&pt.i1.comp.i30.freespins=0&pt.i1.comp.i40.n=3&pt.i2.comp.i24.multi=80000&pt.i0.comp.i40.multi=2&bl.i0.coins=20&pt.i2.comp.i64.type=scatter&pt.i0.comp.i33.n=6&pt.i1.comp.i6.multi=10&pt.i0.comp.i36.multi=4&pt.i2.id=scatter&pt.i2.comp.i123.multi=16&pt.i2.comp.i53.multi=180000&pt.i0.comp.i22.freespins=0&pt.i2.comp.i45.n=18&pt.i2.comp.i113.type=betline&pt.i2.comp.i28.freespins=0&pt.i2.comp.i89.freespins=0&pt.i1.comp.i21.multi=10&pt.i2.comp.i111.n=4&pt.i1.comp.i30.type=betline&pt.i2.comp.i101.freespins=0&pt.i0.comp.i46.type=betline&pt.i2.comp.i104.type=scatter&pt.i1.comp.i0.multi=30&pt.i1.comp.i8.n=6&pt.i2.comp.i42.freespins=0&pt.i0.comp.i38.freespins=0&pt.i2.comp.i13.type=scatter&pt.i0.comp.i16.symbol=SYM6&pt.i1.comp.i21.freespins=0&pt.i2.comp.i36.multi=320&pt.i2.comp.i41.symbol=SYM5&pt.i0.comp.i1.multi=40&pt.i2.comp.i74.n=22&pt.i0.comp.i32.multi=10&pt.i1.comp.i23.type=betline&pt.i1.comp.i49.n=7&pt.i2.comp.i80.symbol=SYM7&pt.i1.comp.i28.symbol=SYM8&pt.i1.comp.i17.multi=20&pt.i2.comp.i5.type=scatter&pt.i2.comp.i29.multi=200000&pt.i2.comp.i79.symbol=SYM6&pt.i1.comp.i21.type=betline&pt.i0.comp.i28.type=betline&pt.i2.comp.i83.multi=40&pt.i2.comp.i94.freespins=0&pt.i0.comp.i10.symbol=SYM5&pt.i2.comp.i91.multi=3240&pt.i0.comp.i45.type=betline&pt.i2.comp.i73.type=scatter&pt.i0.comp.i15.n=3&pt.i0.comp.i39.freespins=0&pt.i2.comp.i63.n=11&pt.i0.comp.i21.symbol=SYM7&pt.i0.comp.i31.type=betline&pt.i1.comp.i38.n=6&pt.i2.comp.i46.type=scatter&pt.i0.comp.i52.freespins=7&pt.i2.comp.i44.multi=7000&pt.i0.comp.i10.freespins=0&pt.i2.comp.i30.symbol=SYM5&pt.i2.comp.i63.type=scatter&pt.i0.comp.i28.n=6&pt.i2.comp.i50.n=23&pt.i2.comp.i15.type=scatter&pt.i2.comp.i96.n=19&pt.i2.comp.i113.freespins=0&pt.i1.comp.i39.symbol=SYM10&pt.i1.comp.i27.n=5&pt.i2.comp.i51.freespins=0&pt.i1.comp.i25.multi=4&pt.i2.comp.i77.freespins=0&pt.i2.comp.i52.symbol=SYM5&pt.i1.comp.i16.freespins=0&pt.i2.comp.i24.freespins=0&pt.i2.comp.i56.type=scatter&pt.i1.comp.i5.type=betline&pt.i2.comp.i37.freespins=0&pt.i2.comp.i110.freespins=0&pt.i1.comp.i17.symbol=SYM6&pt.i2.comp.i7.n=5&pt.i0.comp.i39.n=7&bl.i0.id=0&pt.i2.comp.i85.n=8&pt.i2.comp.i96.multi=28000&pt.i2.comp.i28.multi=180000&pt.i1.comp.i16.n=4&pt.i0.comp.i38.type=betline&pt.i0.comp.i48.symbol=SYM12&pt.i2.comp.i90.multi=2160&pt.i0.comp.i1.symbol=SYM3&pt.i2.comp.i114.multi=20&pt.i2.comp.i121.type=betline&pt.i2.comp.i95.freespins=0&pt.i1.comp.i31.freespins=0&pt.i2.comp.i20.symbol=SYM4&pt.i0.comp.i48.n=6&pt.i2.comp.i7.symbol=SYM4&pt.i0.comp.i38.symbol=SYM10&pt.i2.comp.i30.n=3&pt.i2.comp.i76.n=24&pt.i2.comp.i38.freespins=0&pt.i1.comp.i30.multi=4&pt.i2.comp.i124.symbol=SYM11&pt.i2.comp.i107.multi=10&pt.i2.comp.i2.symbol=SYM3&pt.i0.comp.i9.freespins=0&pt.i1.comp.i45.symbol=SYM12&pt.i2.comp.i63.symbol=SYM6&pt.i2.comp.i120.n=3&pt.i0.comp.i5.type=betline&pt.i2.comp.i48.type=scatter&pt.i2.comp.i81.type=scatter&pt.i1.comp.i40.symbol=SYM11&pt.i2.comp.i0.multi=30&pt.i1.comp.i18.symbol=SYM6&pt.i0.comp.i31.multi=8&pt.i1.comp.i12.symbol=SYM5&pt.i2.comp.i65.n=13&pt.i0.comp.i13.freespins=0&pt.i1.comp.i15.type=betline&pt.i0.comp.i26.freespins=0&pt.i1.comp.i13.type=betline&pt.i1.comp.i1.multi=40&pt.i2.comp.i96.symbol=SYM7&pt.i0.comp.i13.n=6&pt.i1.comp.i46.freespins=0&pt.i2.comp.i19.symbol=SYM4&pt.i2.comp.i95.multi=14000&pt.i0.comp.i23.type=betline&pt.i0.comp.i32.symbol=SYM9&pt.i2.comp.i52.freespins=0&pt.i0.comp.i43.symbol=SYM11&pt.i1.comp.i17.freespins=0&pt.i1.comp.i26.multi=8&pt.i0.comp.i25.freespins=0&pt.i2.comp.i87.multi=640&pt.i2.comp.i52.n=25&pt.i2.comp.i98.n=21&pt.i0.comp.i40.freespins=0&pt.i2.comp.i71.type=scatter&pt.i0.comp.i26.n=4&pt.i0.comp.i27.symbol=SYM8&pt.i2.comp.i41.multi=3240&pt.i2.comp.i109.freespins=0&pt.i2.comp.i106.type=betline&pt.i1.comp.i29.n=7&pt.i2.comp.i37.multi=640&pt.i0.comp.i23.multi=24&pt.i1.comp.i34.symbol=SYM9&pt.i2.comp.i69.symbol=SYM6&pt.i2.comp.i58.symbol=SYM6&pt.i1.comp.i33.multi=16&pt.i2.comp.i41.n=14&pt.i2.comp.i87.n=10&pt.i2.comp.i47.symbol=SYM5&pt.i2.comp.i91.symbol=SYM7&pt.i0.comp.i37.n=5&pt.i0.comp.i0.multi=30&pt.i2.comp.i23.type=scatter&pt.i2.comp.i9.n=7&pt.i2.comp.i36.symbol=SYM5&pt.i2.comp.i96.type=scatter&pt.i2.comp.i106.multi=8&pt.i0.comp.i19.multi=28&pt.i2.comp.i12.freespins=0&pt.i1.comp.i18.n=6&pt.i2.comp.i25.symbol=SYM4&pt.i2.comp.i25.freespins=0&pt.i2.comp.i111.multi=8&pt.i2.comp.i14.symbol=SYM4&pt.i2.comp.i88.multi=960&pt.i0.comp.i24.multi=28&pt.i2.comp.i6.type=scatter&pt.i2.comp.i17.n=15&pt.i0.comp.i23.freespins=0&pt.i2.comp.i99.multi=80000&pt.i2.comp.i107.n=5&pt.i2.comp.i74.type=scatter&pt.i1.comp.i36.type=betline&pt.i0.comp.i15.symbol=SYM6&pt.i1.comp.i14.multi=28&pt.i2.comp.i46.multi=28000&pt.i2.comp.i102.symbol=SYM7&pt.i1.comp.i19.type=betline&pt.i0.comp.i11.symbol=SYM5&pt.i0.comp.i48.multi=16&pt.i2.comp.i19.multi=7000&pt.i2.comp.i81.n=4&pt.i2.comp.i11.freespins=0&pt.i2.comp.i106.symbol=SYM8&bl.i0.reelset=ALL&pt.i0.comp.i16.freespins=0&pt.i1.comp.i29.symbol=SYM8&pt.i1.comp.i45.n=3&pt.i2.comp.i56.freespins=0&pt.i2.comp.i76.symbol=SYM6&pt.i2.comp.i87.symbol=SYM7&pt.i2.comp.i118.n=6&pt.i2.comp.i108.multi=16&pt.i2.comp.i39.symbol=SYM5&pt.i2.comp.i81.freespins=0&pt.i2.comp.i86.multi=320&pt.i2.comp.i70.n=18&pt.i0.comp.i2.symbol=SYM3&pt.i2.comp.i57.type=scatter&pt.i2.comp.i60.multi=160&pt.i0.comp.i20.type=betline&pt.i2.comp.i4.n=7&pt.i2.comp.i65.freespins=0&pt.i2.comp.i125.freespins=0&pt.i0.comp.i49.symbol=SYM12&pt.i0.comp.i52.symbol=SYM0&pt.i1.comp.i34.n=7&pt.i1.comp.i2.symbol=SYM3&pt.i2.comp.i24.type=scatter&pt.i2.comp.i39.n=12&pt.i0.comp.i3.type=betline&pt.i2.comp.i12.symbol=SYM4&pt.i1.comp.i19.multi=28&pt.i2.comp.i8.freespins=0&pt.i2.comp.i129.n=7&pt.i2.comp.i117.symbol=SYM10&pt.i1.comp.i6.symbol=SYM4&pt.i2.comp.i41.type=scatter&pt.i0.comp.i27.multi=10&pt.i2.comp.i115.type=betline&pt.i0.comp.i22.symbol=SYM7&pt.i0.comp.i26.symbol=SYM8&pt.i0.comp.i14.freespins=0&pt.i0.comp.i21.freespins=0&pt.i2.comp.i67.multi=4860&pt.i0.comp.i44.type=betline&pt.i2.comp.i113.symbol=SYM9&pt.i0.comp.i43.multi=16&pt.i0.comp.i48.type=betline&pt.i1.comp.i12.type=betline&pt.i1.comp.i21.symbol=SYM7&pt.i1.comp.i23.n=6&pt.i1.comp.i32.symbol=SYM9&pt.i2.comp.i28.n=26&pt.i0.comp.i16.multi=10&pt.i1.comp.i48.multi=16&pt.i2.comp.i54.freespins=0&pt.i1.comp.i37.freespins=0&pt.i1.comp.i43.symbol=SYM11&pt.i1.comp.i41.multi=4&pt.i2.comp.i28.type=scatter&pt.i2.comp.i50.type=scatter&pt.i0.comp.i41.freespins=0&pt.i1.comp.i9.multi=28&pt.i2.comp.i92.n=15&pt.i1.comp.i2.multi=50&pt.i1.comp.i44.freespins=0&pt.i2.comp.i33.multi=40&pt.i0.comp.i6.n=4&pt.i1.comp.i12.n=5&pt.i1.comp.i10.freespins=0&pt.i2.comp.i109.n=7&pt.i2.comp.i6.symbol=SYM4&pt.i0.comp.i40.type=betline&pt.i1.comp.i45.type=betline&pt.i2.comp.i9.symbol=SYM4&pt.i2.comp.i23.symbol=SYM4&pt.i0.comp.i37.symbol=SYM10&pt.i2.comp.i19.n=17&pt.i2.comp.i21.type=scatter&pt.i0.comp.i29.n=7&pt.i2.comp.i72.n=20&pt.i2.comp.i128.symbol=SYM12&pt.i2.comp.i112.type=betline&pt.i1.comp.i47.n=5&pt.i2.comp.i1.symbol=SYM3&pt.i2.comp.i60.symbol=SYM6&pt.i2.comp.i100.freespins=0&pt.i2.comp.i65.symbol=SYM6&pt.i2.comp.i83.type=scatter&pt.i0.comp.i41.type=betline&pt.i2.comp.i107.freespins=0&pt.i2.comp.i83.freespins=0&pt.i0.comp.i43.freespins=0&pt.i0.comp.i11.multi=10&pt.i1.comp.i43.multi=16&pt.i2.comp.i90.symbol=SYM7&pt.i2.comp.i98.symbol=SYM7&pt.i2.comp.i6.n=4&pt.i2.comp.i61.n=9&pt.i2.comp.i128.type=betline&pt.i0.comp.i29.multi=20&pt.i1.comp.i36.n=4&pt.i2.comp.i54.type=scatter&pt.i1.comp.i4.multi=70&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&pt.i1.comp.i46.multi=4&pt.i2.comp.i124.multi=20&pt.i0.comp.i14.multi=28&pt.i1.comp.i7.multi=20&pt.i2.comp.i90.freespins=0&pt.i2.comp.i122.multi=10&playercurrencyiso=' . $slotSettings->slotCurrency . '&pt.i1.comp.i42.freespins=0&pt.i0.comp.i18.type=betline&pt.i2.comp.i94.n=17&playforfun=false&pt.i1.comp.i25.n=3&pt.i2.comp.i31.multi=10&pt.i0.comp.i48.freespins=0&pt.i0.comp.i2.type=betline&pt.i2.comp.i54.symbol=SYM5&pt.i0.comp.i8.n=6&pt.i0.comp.i11.type=betline&pt.i1.comp.i35.freespins=0&pt.i2.comp.i84.symbol=SYM7&pt.i0.comp.i18.n=6&pt.i2.comp.i20.type=scatter&pt.i2.comp.i81.multi=10&pt.i2.comp.i83.n=6&pt.i2.comp.i95.symbol=SYM7&pt.i1.comp.i14.n=7&pt.i1.comp.i16.multi=10&pt.i2.comp.i127.freespins=0&pt.i2.comp.i119.type=betline&pt.i1.comp.i15.freespins=0&pt.i0.comp.i27.type=betline&pt.i0.comp.i41.multi=4&pt.i0.comp.i7.symbol=SYM4&pt.i0.comp.i50.freespins=7&pt.i2.comp.i30.multi=6&pt.i2.comp.i48.multi=60000&pt.i2.comp.i63.freespins=0&pt.i0.comp.i45.multi=2&pt.i2.comp.i109.symbol=SYM8&pt.i2.comp.i59.n=7&pt.i2.comp.i69.multi=7000&gameServerVersion=1.3.0&pt.i2.comp.i103.freespins=0&pt.i2.comp.i87.freespins=0&pt.i2.comp.i34.freespins=0&pt.i0.comp.i18.symbol=SYM6&pt.i2.comp.i16.multi=3240&pt.i0.comp.i42.n=5&pt.i0.comp.i46.freespins=0&pt.i2.comp.i13.n=11&pt.i2.comp.i43.symbol=SYM5&pt.i2.comp.i44.type=scatter&pt.i0.comp.i12.multi=20&pt.i1.comp.i14.freespins=0&pt.i2.comp.i30.type=scatter&pt.i2.comp.i45.symbol=SYM5&pt.i1.comp.i13.freespins=0&pt.i0.comp.i45.freespins=0&pt.i2.comp.i103.n=26&pt.i0.comp.i14.type=betline&pt.i1.comp.i41.n=4&pt.i2.comp.i49.multi=80000&pt.i1.comp.i0.n=3&pt.i1.comp.i26.symbol=SYM8&pt.i2.comp.i63.multi=960&pt.i2.comp.i87.type=scatter&pt.i2.comp.i48.n=21&jackpotcurrency=%26%23x20AC%3B&pt.i0.comp.i47.type=betline&pt.i0.comp.i50.type=scatter&pt.i2.comp.i33.freespins=0&pt.i2.comp.i0.n=3&pt.i1.comp.i11.multi=10&pt.i2.comp.i114.n=7&pt.i1.comp.i30.n=3&pt.i2.comp.i27.type=scatter&pt.i0.comp.i20.n=3&pt.i0.comp.i29.symbol=SYM8&pt.i2.comp.i3.type=betline&pt.i2.comp.i105.freespins=0&pt.i2.comp.i11.multi=320&pt.i1.comp.i49.multi=20&pt.i2.comp.i85.freespins=0&pt.i0.comp.i9.type=betline&pt.i2.comp.i34.symbol=SYM5&pt.i2.comp.i35.n=8&pt.i2.comp.i125.multi=2&pt.i1.comp.i16.type=betline&pt.i2.comp.i56.symbol=SYM6&pt.i2.comp.i29.freespins=0&pt.i2.comp.i125.n=3&pt.i2.comp.i37.type=scatter&pt.i2.comp.i102.freespins=0&pt.i1.comp.i12.multi=20&pt.i2.comp.i88.freespins=0&pt.i2.comp.i71.symbol=SYM6&pt.i1.comp.i11.freespins=0&pt.i0.comp.i31.n=4&pt.i2.comp.i93.symbol=SYM7&pt.i0.comp.i9.symbol=SYM4&pt.i2.comp.i34.type=scatter&pt.i2.comp.i82.symbol=SYM7&pt.i2.comp.i17.multi=4860&pt.i2.comp.i24.n=22&pt.i0.comp.i47.freespins=0&pt.i2.comp.i126.multi=4&pt.i2.comp.i102.type=scatter&pt.i2.comp.i68.multi=6000&pt.i0.comp.i2.n=5&pt.i2.comp.i10.multi=160&pt.i0.comp.i44.freespins=0&pt.i2.comp.i31.freespins=0&pt.i0.comp.i44.multi=20&pt.i0.comp.i19.freespins=0&pt.i2.comp.i126.symbol=SYM12&pt.i0.comp.i6.type=betline&pt.i2.comp.i15.n=13&pt.i0.comp.i35.symbol=SYM10&pt.i2.comp.i105.n=3&pt.i2.comp.i129.freespins=0&pt.i2.comp.i127.multi=10&pt.i2.comp.i62.multi=640&pt.i0.comp.i40.n=3&pt.i1.comp.i40.freespins=0&pt.i2.comp.i61.freespins=0&pt.i2.comp.i121.symbol=SYM11&pt.i2.comp.i97.type=scatter&pt.i2.comp.i12.multi=640&pt.i1.comp.i10.multi=6&pt.i1.comp.i10.symbol=SYM5&pt.i1.comp.i48.symbol=SYM12&pt.i2.comp.i4.symbol=SYM3&pt.i1.comp.i2.n=5&pt.i2.comp.i67.type=scatter&pt.i1.comp.i43.n=6&pt.i1.comp.i32.type=betline&pt.i2.comp.i125.type=betline&pt.i2.comp.i15.multi=2160&pt.i2.comp.i70.type=scatter&pt.i2.comp.i116.n=4&pt.i1.comp.i39.freespins=0&pt.i0.comp.i51.n=4&pt.i1.comp.i1.type=betline&pt.i0.comp.i46.multi=4&pt.i0.comp.i20.freespins=0&pt.i1.comp.i29.type=betline&pt.i0.comp.i30.symbol=SYM9&pt.i2.comp.i2.n=5&pt.i2.comp.i28.symbol=SYM4&pt.i0.comp.i41.symbol=SYM11&pt.i0.comp.i49.multi=20&pt.i1.comp.i32.n=5&pt.i2.comp.i17.symbol=SYM4&pt.i0.comp.i46.symbol=SYM12&pt.i2.comp.i37.n=10&pt.i1.comp.i4.symbol=SYM3&pt.i1.comp.i38.freespins=0&pt.i2.comp.i115.symbol=SYM10&pt.i2.comp.i127.n=5&pt.i1.comp.i39.type=betline&pt.i0.comp.i24.symbol=SYM7&pt.i0.comp.i47.multi=10&pt.i1.comp.i42.type=betline&pt.i2.comp.i59.freespins=0&pt.i2.comp.i110.symbol=SYM9&pt.i2.comp.i58.freespins=0&pt.i2.comp.i32.freespins=0&pt.i2.comp.i80.type=scatter&pt.i1.comp.i37.symbol=SYM10&pt.i2.comp.i64.multi=1440&pt.i1.comp.i21.n=4&pt.i2.comp.i14.multi=1440&pt.i2.comp.i26.n=24&pt.i0.comp.i18.freespins=0&pt.i1.comp.i15.symbol=SYM6&pt.i1.comp.i49.type=betline&pt.i2.comp.i86.freespins=0&pt.i2.comp.i60.freespins=0&pt.i2.comp.i104.freespins=0&pt.i1.comp.i9.symbol=SYM4&pt.i2.comp.i90.n=13&pt.i2.comp.i13.multi=960&pt.i0.comp.i24.type=betline&pt.i2.comp.i90.type=scatter&pt.i2.comp.i65.multi=2160&pt.i1.comp.i12.freespins=0&pt.i0.comp.i4.n=7&pt.i2.comp.i77.type=scatter&pt.i2.comp.i129.multi=20&pt.i1.comp.i10.n=3&pt.i2.comp.i40.symbol=SYM5&pt.i0.comp.i17.symbol=SYM6&pt.i2.comp.i26.multi=150000&pt.i2.comp.i55.n=3&pt.i2.comp.i60.type=scatter&pt.i0.comp.i23.n=6&pt.i2.comp.i80.freespins=0&pt.i2.comp.i26.type=scatter&pt.i1.comp.i8.type=betline&pt.i2.comp.i81.symbol=SYM7&pt.i2.comp.i39.multi=1440&pt.i1.comp.i27.symbol=SYM8&pt.i2.comp.i104.symbol=SYM7&pt.i1.comp.i30.symbol=SYM9&pt.i1.comp.i3.multi=60&pt.i2.comp.i59.type=scatter&pt.i2.comp.i78.symbol=SYM6&pt.i2.comp.i48.symbol=SYM5&pt.i2.comp.i89.symbol=SYM7&pt.i2.comp.i117.type=betline&pt.i0.comp.i1.type=betline&pt.i2.comp.i37.symbol=SYM5&pt.i2.comp.i44.n=17&pt.i2.comp.i76.type=scatter&pt.i0.comp.i34.n=7&pt.i1.comp.i10.type=betline&pt.i0.comp.i42.multi=10&pt.i0.comp.i34.type=betline&pt.i1.comp.i5.freespins=0&pt.i2.comp.i80.multi=6&pt.i1.comp.i19.n=7&pt.i0.comp.i50.symbol=SYM0&pt.i2.comp.i71.freespins=0&pt.i0.comp.i8.symbol=SYM4&pt.i2.comp.i119.freespins=0&pt.i0.comp.i0.symbol=SYM3&pt.i0.comp.i47.symbol=SYM12&pt.i1.comp.i36.freespins=0&pt.i2.comp.i43.type=scatter&pt.i2.comp.i110.n=3&pt.i0.comp.i3.freespins=0&pt.i0.comp.i47.n=5&pt.i1.id=freespin&pt.i2.comp.i10.freespins=0&pt.i2.comp.i31.n=4&pt.i2.comp.i77.n=25&pt.i1.comp.i34.type=betline&clientaction=paytable&pt.i2.comp.i70.symbol=SYM6&pt.i1.comp.i27.freespins=0&pt.i2.comp.i21.multi=28000&pt.i2.comp.i128.freespins=0&pt.i0.comp.i50.multi=0&pt.i1.comp.i5.n=3&pt.i2.comp.i62.freespins=0&pt.i1.comp.i8.multi=24&pt.i2.comp.i121.n=4&pt.i2.comp.i34.multi=80&pt.i0.comp.i24.freespins=0&pt.i0.comp.i21.multi=10&pt.i2.comp.i20.n=18&pt.i2.comp.i66.n=14&pt.i1.comp.i41.freespins=0&pt.i0.comp.i12.n=5&bl.i0.line=0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4&pt.i2.comp.i85.multi=160&pt.i2.comp.i57.freespins=0&pt.i0.comp.i3.multi=60&pt.i0.comp.i51.type=scatter&pt.i2.comp.i8.multi=40&pt.i2.comp.i109.multi=20&pt.i2.comp.i8.symbol=SYM4&pt.i0.comp.i21.n=4&pt.i2.comp.i23.freespins=0&pt.i0.comp.i42.freespins=0&pt.i2.comp.i21.symbol=SYM4&pt.i0.comp.i36.symbol=SYM10&pt.i0.comp.i39.symbol=SYM10&pt.i2.comp.i0.type=betline&pt.i2.comp.i117.multi=10&pt.i2.comp.i57.n=5&pt.i2.comp.i11.n=9&pt.i2.comp.i0.symbol=SYM3&pt.i2.comp.i18.type=scatter&pt.i2.comp.i62.symbol=SYM6&pt.i2.comp.i109.type=betline&pt.i0.comp.i10.type=betline&pt.i2.comp.i3.freespins=0&pt.i2.comp.i3.symbol=SYM3&pt.i1.comp.i11.symbol=SYM5&pt.i1.comp.i49.symbol=SYM12&pt.i1.comp.i46.symbol=SYM12&pt.i2.comp.i115.freespins=0&pt.i2.comp.i75.freespins=0&pt.i2.comp.i101.n=24&pt.i2.comp.i67.symbol=SYM6&pt.i2.comp.i84.type=scatter&pt.i2.comp.i98.multi=60000&pt.i0.comp.i32.n=5&pt.i1.comp.i1.freespins=0&pt.i2.comp.i59.symbol=SYM6&pt.i2.comp.i121.multi=4&pt.i1.comp.i16.symbol=SYM6&pt.i1.comp.i23.multi=24&pt.i2.comp.i55.multi=6&pt.i2.comp.i46.n=19&pt.i2.comp.i92.symbol=SYM7&pt.i2.comp.i14.freespins=0&pt.i1.comp.i26.type=betline&pt.i2.comp.i18.multi=6000&pt.i2.comp.i84.freespins=0&pt.i0.comp.i8.multi=24&pt.i2.comp.i26.symbol=SYM4&pt.i0.comp.i34.multi=20&pt.i0.comp.i49.freespins=0&pt.i2.comp.i106.freespins=0&pt.i2.comp.i15.symbol=SYM4&pt.i2.comp.i3.multi=60&pt.i2.comp.i112.n=5&pt.i2.comp.i35.type=scatter&pt.i1.comp.i49.freespins=0&pt.i0.comp.i28.symbol=SYM8&pt.i0.comp.i45.n=3&pt.i1.comp.i17.type=betline&pt.i1.comp.i7.n=5&pt.i2.comp.i32.symbol=SYM5&pt.i2.comp.i79.n=27&pt.i2.comp.i10.type=scatter&pt.i2.comp.i33.n=6&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&pt.i2.comp.i47.multi=40000&pt.i2.comp.i96.freespins=0&pt.i0.comp.i8.type=betline&pt.i0.comp.i7.freespins=0&pt.i1.comp.i15.multi=6&pt.i2.comp.i51.symbol=SYM5&pt.i0.comp.i13.multi=24&pt.i1.comp.i45.multi=2&pt.i2.comp.i77.multi=170000&pt.i0.comp.i17.type=betline&pt.i2.comp.i73.symbol=SYM6&pt.i2.comp.i48.freespins=0&pt.i2.comp.i123.n=6&pt.i1.comp.i22.symbol=SYM7&pt.i1.comp.i38.symbol=SYM10&pt.i2.comp.i11.type=scatter&pt.i0.comp.i10.n=3&pt.i1.comp.i41.symbol=SYM11&pt.i2.comp.i17.type=scatter&pt.i2.comp.i35.freespins=0&pt.i1.comp.i19.symbol=SYM6&pt.i2.comp.i68.n=16&pt.i0.comp.i20.symbol=SYM7&pt.i2.comp.i22.n=20&pt.i2.comp.i76.multi=150000&pt.i0.comp.i15.freespins=0&pt.i2.comp.i93.type=scatter&pt.i2.comp.i18.symbol=SYM4&pt.i0.comp.i31.symbol=SYM9&pt.i2.comp.i29.symbol=SYM4&pt.i0.comp.i28.freespins=0&pt.i0.comp.i0.n=3&pt.i0.comp.i42.symbol=SYM11&pt.i2.comp.i10.symbol=SYM4&pt.i0.comp.i0.type=betline&g4mode=false&pt.i0.comp.i25.multi=4&pt.i1.comp.i37.multi=10&pt.i2.comp.i89.multi=1440&pt.i2.comp.i58.type=scatter&pt.i2.comp.i118.type=betline&pt.i2.comp.i111.freespins=0&pt.i2.comp.i51.n=24&pt.i0.comp.i27.n=5&pt.i1.comp.i9.type=betline&pt.i2.comp.i79.freespins=0&pt.i2.comp.i97.n=20&pt.i1.comp.i24.multi=28&pt.i1.comp.i44.multi=20&pt.i2.comp.i100.multi=110000&pt.i1.comp.i26.n=4&pt.i2.comp.i27.freespins=0&pt.i2.comp.i61.type=scatter&pt.i0.comp.i18.multi=24&pt.i0.comp.i33.type=betline&pt.i2.comp.i107.symbol=SYM8&pt.i2.comp.i101.symbol=SYM7&pt.i2.comp.i120.multi=2&pt.i1.comp.i33.symbol=SYM9&pt.i1.comp.i35.type=betline&pt.i2.comp.i113.multi=16&pt.i0.comp.i9.n=7&pt.i1.comp.i31.multi=8&pt.i2.comp.i43.multi=6000&pt.i1.comp.i18.type=betline&pt.i2.comp.i8.n=6&pt.i2.comp.i40.n=13&pt.i0.comp.i38.n=6&pt.i2.comp.i26.freespins=0&pt.i2.comp.i86.n=9&pt.i1.comp.i15.n=3&pt.i2.comp.i78.freespins=0&isJackpotWin=false&pt.i1.comp.i20.freespins=0&pt.i2.comp.i112.freespins=0&pt.i1.comp.i7.type=betline&pt.i2.comp.i7.type=scatter&pt.i2.comp.i36.freespins=0&pt.i0.comp.i20.multi=6&pt.i0.comp.i44.symbol=SYM11&pt.i2.comp.i9.type=scatter&pt.i0.comp.i17.multi=20&pt.i1.comp.i25.type=betline&pt.i1.comp.i9.n=7&pt.i2.comp.i94.type=scatter&pt.i2.comp.i97.multi=40000&pt.i2.comp.i73.n=21&pt.i2.comp.i51.multi=150000&pt.i0.comp.i2.multi=50&pt.i0.comp.i0.freespins=0&pt.i2.comp.i112.symbol=SYM9&pt.i2.comp.i25.type=scatter&pt.i0.comp.i33.multi=16&pt.i2.comp.i84.multi=80&pt.i2.comp.i75.symbol=SYM6&pt.i0.comp.i51.freespins=7&pt.i1.comp.i35.symbol=SYM10&pt.i1.comp.i24.symbol=SYM7&pt.i2.comp.i41.freespins=0&pt.i0.comp.i37.freespins=0&pt.i2.comp.i92.freespins=0&pt.i1.comp.i13.symbol=SYM5&pt.i2.comp.i86.symbol=SYM7&pt.i2.comp.i97.symbol=SYM7&pt.i0.comp.i16.n=4&pt.i2.comp.i62.n=10&pt.i2.comp.i50.multi=110000&pt.i0.comp.i5.symbol=SYM4&pt.i1.comp.i7.symbol=SYM4&pt.i1.comp.i39.n=7&pt.i2.comp.i108.type=betline&pt.i0.comp.i35.type=betline&pt.i1.comp.i36.multi=4&pt.i2.comp.i92.multi=4860&pt.i1.comp.i9.freespins=0&playercurrency=%26%23x20AC%3B&pt.i2.comp.i66.type=scatter&pt.i0.comp.i33.symbol=SYM9&pt.i1.comp.i40.multi=2&pt.i2.comp.i53.n=26&pt.i2.comp.i99.n=22&pt.i2.comp.i129.symbol=SYM12&pt.i2.comp.i123.symbol=SYM11&pt.i0.comp.i25.n=3&pt.i2.comp.i42.multi=4860&pt.i2.comp.i53.freespins=0&pt.i1.comp.i28.n=6&pt.i1.comp.i32.freespins=0&pt.i2.comp.i126.type=betline&pt.i2.comp.i53.type=scatter&pt.i2.comp.i64.symbol=SYM6&pt.i2.comp.i111.type=betline&credit=500000&pt.i0.comp.i11.freespins=0&pt.i0.comp.i26.multi=8&pt.i0.comp.i25.type=betline&pt.i2.comp.i35.multi=160&pt.i2.comp.i42.n=15&pt.i2.comp.i88.n=11&pt.i2.comp.i68.type=scatter&pt.i0.comp.i36.n=4&pt.i1.comp.i8.freespins=0&pt.i2.comp.i39.freespins=0&pt.i1.comp.i33.freespins=0&pt.i2.comp.i51.type=scatter&pt.i1.comp.i17.n=5&pt.i2.comp.i104.multi=200000&pt.i2.comp.i38.multi=960&pt.i0.comp.i43.type=betline&pt.i1.comp.i32.multi=10&pt.i2.comp.i118.symbol=SYM10&pt.i2.comp.i101.type=scatter&pt.i1.comp.i0.type=betline&pt.i1.comp.i1.symbol=SYM3&pt.i1.comp.i29.multi=20&pt.i0.comp.i49.n=7&pt.i2.comp.i66.freespins=0&pt.i2.comp.i40.freespins=0&pt.i2.comp.i93.freespins=0&pt.i2.comp.i112.multi=10&pt.i2.comp.i124.freespins=0&pt.i2.comp.i75.n=23&pt.i2.comp.i33.type=scatter&pt.i1.comp.i45.freespins=0&pt.i2.comp.i86.type=scatter&pt.i2.comp.i105.multi=4&pt.i0.comp.i30.multi=4&pt.i2.comp.i94.multi=7000&pt.i1.comp.i43.type=betline&pt.i2.comp.i2.type=betline&pt.i2.comp.i7.freespins=0&pt.i1.comp.i28.multi=16&pt.i1.comp.i18.freespins=0&pt.i0.comp.i14.n=7&pt.i2.comp.i64.n=12&pt.i1.comp.i33.type=betline&pt.i0.comp.i12.freespins=0&pt.i2.comp.i93.multi=6000&pt.i2.comp.i116.type=betline&pt.i0.comp.i19.symbol=SYM6&pt.i0.comp.i15.type=betline&pt.i2.comp.i59.multi=80&pt.i2.comp.i72.freespins=0&pt.i0.comp.i32.type=betline&pt.i0.comp.i35.multi=2&pt.i2.comp.i91.type=scatter&pt.i2.comp.i118.freespins=0&pt.i0.comp.i4.multi=70&pt.i2.comp.i120.type=betline&pt.i2.comp.i6.freespins=0&pt.i2.comp.i42.symbol=SYM5&pt.i0.comp.i22.multi=20&pt.i1.comp.i27.multi=10&pt.i1.comp.i6.freespins=0&pt.i2.comp.i103.type=scatter&pt.i1.comp.i22.n=5&pt.i0.comp.i4.freespins=0&pt.i1.comp.i25.symbol=SYM8&pt.i0.comp.i30.freespins=0&pt.i1.comp.i24.type=betline&pt.i2.comp.i7.multi=20&pt.i2.comp.i29.n=27&pt.i2.comp.i83.symbol=SYM7&pt.i0.comp.i19.n=7&pt.i2.comp.i20.freespins=0&pt.i2.comp.i46.symbol=SYM5&pt.i2.comp.i35.symbol=SYM5&pt.i2.comp.i93.n=16&pt.i2.comp.i116.multi=4&pt.i2.comp.i62.type=scatter&pt.i1.comp.i48.type=betline&pt.i0.comp.i6.symbol=SYM4&pt.i2.comp.i20.multi=14000&pt.i1.comp.i11.n=4&pt.i2.comp.i49.freespins=0&pt.i0.comp.i5.n=3&pt.i2.comp.i16.n=14&pt.i2.comp.i69.type=scatter&pt.i2.comp.i106.n=4&pt.i2.comp.i74.freespins=0&pt.i2.comp.i31.symbol=SYM5&pt.i2.comp.i47.freespins=0&pt.i2.comp.i116.freespins=0&pt.i0.comp.i9.multi=28&pt.i1.comp.i19.freespins=0&pt.i1.comp.i35.multi=2&pt.i2.comp.i80.n=3&pt.i1.comp.i46.n=4&pt.i2.comp.i13.freespins=0&pt.i1.comp.i4.freespins=0&pt.i2.comp.i27.multi=170000&pt.i2.comp.i78.type=scatter&pt.i2.comp.i53.symbol=SYM5&pt.i1.comp.i36.symbol=SYM10&pt.i2.comp.i103.multi=180000&pt.i2.comp.i73.multi=60000&pt.i2.comp.i123.freespins=0&pt.i2.comp.i2.multi=50&pt.i2.comp.i117.n=5&pt.i2.comp.i67.freespins=0&pt.i0.comp.i50.n=3&pt.i1.comp.i35.n=3&pt.i1.comp.i41.type=betline&pt.i2.comp.i12.type=scatter&pt.i2.comp.i127.type=betline&pt.i0.comp.i19.type=betline&pt.i2.comp.i3.n=6&pt.i0.comp.i6.freespins=0&pt.i2.comp.i16.symbol=SYM4&pt.i2.comp.i124.type=betline&pt.i1.comp.i3.type=betline&pt.i2.comp.i125.symbol=SYM12&pt.i1.comp.i28.type=betline&pt.i0.comp.i34.symbol=SYM9&pt.i2.comp.i52.multi=170000&pt.i1.comp.i20.multi=6&pt.i2.comp.i95.n=18&pt.i0.comp.i27.freespins=0&pt.i0.comp.i34.freespins=0&pt.i1.comp.i24.n=7&pt.i2.comp.i22.multi=40000&pt.i2.comp.i36.type=scatter&pt.i2.comp.i60.n=8&pt.i2.comp.i120.symbol=SYM11&pt.i1.comp.i47.symbol=SYM12&pt.i1.comp.i27.type=betline&pt.i1.comp.i48.freespins=0&pt.i1.comp.i2.type=betline&pt.i0.comp.i2.freespins=0&pt.i1.comp.i38.multi=16&pt.i0.comp.i7.n=5&pt.i2.comp.i68.symbol=SYM6&pt.i0.comp.i36.type=betline&pt.i1.comp.i14.symbol=SYM5&pt.i2.comp.i98.type=scatter&pt.i1.comp.i44.symbol=SYM11&pt.i2.comp.i57.symbol=SYM6&pt.i0.comp.i7.type=betline&pt.i0.comp.i17.n=5&pt.i2.comp.i65.type=scatter&pt.i2.comp.i84.n=7&pt.i1.comp.i13.n=6&pt.i0.comp.i8.freespins=0&pt.i2.comp.i75.multi=110000&pt.i2.comp.i101.multi=150000&pt.i2.comp.i24.symbol=SYM4&pt.i2.comp.i97.freespins=0&pt.i0.comp.i12.type=betline&pt.i0.comp.i36.freespins=0&pt.i2.comp.i16.type=scatter&pt.i2.comp.i13.symbol=SYM4&pt.i2.comp.i78.multi=180000&pt.i0.comp.i45.symbol=SYM12&pt.i2.comp.i108.n=6&pt.i1.comp.i11.type=betline&pt.i0.comp.i6.multi=10&pt.i2.comp.i18.n=16&pt.i0.comp.i37.multi=10&pt.i1.comp.i5.symbol=SYM4&pt.i2.comp.i123.type=betline&pt.i0.comp.i23.symbol=SYM7&pt.i2.comp.i82.n=5&pt.i1.comp.i48.n=6&pt.i2.comp.i4.multi=70&pt.i1.comp.i20.type=betline&pt.i2.comp.i114.symbol=SYM9&pt.i2.comp.i43.freespins=0&pt.i2.comp.i70.freespins=0&pt.i2.comp.i69.freespins=0&pt.i1.comp.i22.multi=20&pt.i2.comp.i54.multi=200000&pt.i2.comp.i121.freespins=0&pt.i2.comp.i45.type=scatter&pt.i2.comp.i119.n=7&pt.i2.comp.i118.multi=16&pt.i1.comp.i22.freespins=0&pt.i2.comp.i22.freespins=0&pt.i2.comp.i25.multi=110000&pt.i2.comp.i5.n=3&pt.i2.comp.i50.freespins=0&pt.i1.comp.i37.n=5&pt.i2.comp.i71.n=19&pt.i2.comp.i5.multi=6&pt.i1.comp.i28.freespins=0&pt.i2.comp.i99.type=scatter&pt.i2.comp.i15.freespins=0&pt.i2.comp.i4.freespins=0&pt.i2.comp.i76.freespins=0&pt.i1.comp.i0.freespins=0&pt.i2.comp.i114.freespins=0&pt.i2.comp.i36.n=9&pt.i2.comp.i126.n=4&historybutton=false&pt.i2.comp.i89.type=scatter&pt.i2.comp.i19.freespins=0&pt.i2.comp.i56.multi=10&pt.i2.comp.i75.type=scatter&pt.i0.comp.i12.symbol=SYM5&pt.i0.comp.i14.symbol=SYM5&pt.i0.comp.i38.multi=16&pt.i1.comp.i40.type=betline&pt.i2.comp.i105.symbol=SYM8&pt.i1.comp.i31.symbol=SYM9&pt.i2.comp.i103.symbol=SYM7&pt.i0.comp.i7.multi=20&pt.i2.comp.i25.n=23&pt.i0.comp.i30.n=3&pt.i2.comp.i92.type=scatter&pt.i2.comp.i71.multi=28000&pt.i1.comp.i37.type=betline&pt.i2.comp.i23.multi=60000&pt.i2.comp.i32.type=scatter&pt.i0.comp.i1.n=4&pt.i2.comp.i119.multi=20&pt.i1.comp.i3.symbol=SYM3&pt.i2.comp.i17.freespins=0&pt.i1.comp.i23.freespins=0&pt.i2.comp.i58.n=6&pt.i2.comp.i116.symbol=SYM10&pt.i0.comp.i25.symbol=SYM8&pt.i0.comp.i26.type=betline&pt.i2.comp.i12.n=10&pt.i0.comp.i43.n=6&pt.i1.comp.i47.type=betline&pt.i2.comp.i57.multi=20&pt.i2.comp.i102.n=25&pt.i1.comp.i20.symbol=SYM7&pt.i0.comp.i29.freespins=0&pt.i1.comp.i1.n=4&pt.i1.comp.i42.n=5&pt.i2.comp.i47.n=20&pt.i2.comp.i0.freespins=0&pt.i2.comp.i49.symbol=SYM5&pt.i2.comp.i38.symbol=SYM5&pt.i1.comp.i44.type=betline&pt.i0.comp.i16.type=betline&pt.i0.comp.i39.multi=20&pt.i2.comp.i82.type=scatter&pt.i2.comp.i27.symbol=SYM4&pt.i2.comp.i113.n=6&pt.i2.comp.i120.freespins=0&pt.i0.comp.i40.symbol=SYM11&pt.i2.comp.i44.freespins=0&pt.i0.comp.i51.symbol=SYM0&pt.i1.comp.i31.n=4&pt.i2.comp.i85.type=scatter&pt.i1.comp.i14.type=betline&pt.i2.comp.i38.n=11&pt.i1.comp.i2.freespins=0&pt.i2.comp.i22.symbol=SYM4&pt.i2.comp.i128.n=6&pt.i1.comp.i25.freespins=0&pt.i2.comp.i49.type=scatter&pt.i2.comp.i98.freespins=0&pt.i2.comp.i52.type=scatter&pt.i2.comp.i72.multi=40000&pt.i2.comp.i61.symbol=SYM6&pt.i2.comp.i45.freespins=0&pt.i2.comp.i22.type=scatter&pt.i2.comp.i9.multi=80&pt.i2.comp.i5.symbol=SYM4&pt.i1.comp.i20.n=3&pt.i1.comp.i24.freespins=0&pt.i2.comp.i66.symbol=SYM6&pt.i2.comp.i27.n=25&pt.i2.comp.i94.symbol=SYM7&pt.i0.comp.i39.type=betline&pt.i2.comp.i95.type=scatter&pt.i1.comp.i42.symbol=SYM11&pt.i0.comp.i4.type=betline&pt.i1.comp.i26.freespins=0&pt.i0.comp.i42.type=betline&pt.i2.comp.i46.freespins=0&pt.i2.comp.i91.n=14&pt.i0.comp.i33.freespins=0&pt.i2.comp.i1.type=betline&pt.i0.comp.i51.multi=0&pt.i2.comp.i2.freespins=0&pt.i2.comp.i19.type=scatter&pt.i2.comp.i58.multi=40&pt.i0.comp.i3.n=6&pt.i1.comp.i6.type=betline&pt.i2.comp.i11.symbol=SYM4&pt.i2.comp.i14.n=12&pt.i2.comp.i107.type=betline&pt.i0.comp.i49.type=betline&pt.i2.comp.i104.n=27&pt.i2.comp.i33.symbol=SYM5&pt.i0.comp.i41.n=4&pt.i2.comp.i1.freespins=0&pt.i2.comp.i8.type=scatter&pt.i0.comp.i32.freespins=0&pt.i2.comp.i29.type=scatter&pt.i2.comp.i50.symbol=SYM5&pt.i0.comp.i52.type=scatter&pt.i2.comp.i55.symbol=SYM6&pt.i2.comp.i100.type=scatter&pt.i1.comp.i3.n=6&pt.i2.comp.i72.symbol=SYM6&pt.i1.comp.i44.n=7&pt.i2.comp.i77.symbol=SYM6&pt.i2.comp.i42.type=scatter&pt.i2.comp.i49.n=22&pt.i2.comp.i18.freespins=0&pt.i2.comp.i88.symbol=SYM7&pt.i2.comp.i115.n=3&pt.i1.comp.i3.freespins=0&pt.i2.comp.i99.freespins=0&pt.i0.comp.i52.n=5&pt.i2.comp.i99.symbol=SYM7&pt.i2.comp.i39.type=scatter&pt.i0.comp.i52.multi=0&pt.i2.comp.i117.freespins=0&pt.i2.comp.i73.freespins=0&pt.i0.comp.i3.symbol=SYM3&pt.i2.comp.i70.multi=14000&pt.i2.comp.i110.type=betline&pt.i2.comp.i1.n=4&pt.i1.comp.i33.n=6';
                    break;
                case 'spin':
                    $linesId = [];
                    $linesId[0] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[1] = [
                        1, 
                        1, 
                        1, 
                        1, 
                        1
                    ];
                    $linesId[2] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[3] = [
                        1, 
                        2, 
                        3, 
                        2, 
                        1
                    ];
                    $linesId[4] = [
                        3, 
                        2, 
                        1, 
                        2, 
                        3
                    ];
                    $linesId[5] = [
                        1, 
                        1, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[6] = [
                        3, 
                        3, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[7] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[8] = [
                        2, 
                        1, 
                        1, 
                        1, 
                        2
                    ];
                    $linesId[9] = [
                        2, 
                        1, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[10] = [
                        2, 
                        3, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[11] = [
                        1, 
                        2, 
                        1, 
                        2, 
                        1
                    ];
                    $linesId[12] = [
                        3, 
                        2, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[13] = [
                        2, 
                        2, 
                        1, 
                        2, 
                        2
                    ];
                    $linesId[14] = [
                        2, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[15] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[16] = [
                        3, 
                        2, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[17] = [
                        1, 
                        3, 
                        1, 
                        3, 
                        1
                    ];
                    $linesId[18] = [
                        3, 
                        1, 
                        3, 
                        1, 
                        3
                    ];
                    $linesId[19] = [
                        1, 
                        3, 
                        3, 
                        3, 
                        1
                    ];
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
                        $slotSettings->SetGameData('VikingsNETBonusWin', 0);
                        $slotSettings->SetGameData('VikingsNETFreeGames', 0);
                        $slotSettings->SetGameData('VikingsNETCurrentFreeGame', 0);
                        $slotSettings->SetGameData('VikingsNETTotalWin', 0);
                        $slotSettings->SetGameData('VikingsNETBet', $betline);
                        $slotSettings->SetGameData('VikingsNETDenom', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination']);
                        $slotSettings->SetGameData('VikingsNETFreeBalance', sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                        $bonusMpl = 1;
                    }
                    else
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'] = $slotSettings->GetGameData('VikingsNETDenom');
                        $slotSettings->CurrentDenom = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                        $slotSettings->CurrentDenomination = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                        $betline = $slotSettings->GetGameData('VikingsNETBet');
                        $allbet = $betline * $lines;
                        $slotSettings->SetGameData('VikingsNETCurrentFreeGame', $slotSettings->GetGameData('VikingsNETCurrentFreeGame') + 1);
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
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                            $reels = $slotSettings->GetBonusReelStrips();
                        }
                        else
                        {
                            $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        }
                        $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01 = $reels;
                        $_obf_0D041B343E2F372F332A372A0A292A300B3C2D27360311 = '';
                        $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 = 0;
                        $_obf_0D29353602391E311D2C1C1A0F232339173B2A2E0B2A32 = false;
                        $_obf_0D5B211F2B171D22372B2B400C302B4034353F15271411 = -1;
                        $_obf_0D29310A2C362B131A253228082F1107292123250A3332 = -1;
                        $_obf_0D13022121133406290B191B5B2D1C122D170239282922 = [
                            4, 
                            5, 
                            6, 
                            7
                        ];
                        $_obf_0D1E2615361F1F270731103109221C3237121D0F101222 = 5;
                        $_obf_0D09281406401C292E402C1B090D13010D2F043E340C32 = 3;
                        for( $r = 1; $r <= $_obf_0D1E2615361F1F270731103109221C3237121D0F101222; $r++ ) 
                        {
                            foreach( $_obf_0D13022121133406290B191B5B2D1C122D170239282922 as $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 ) 
                            {
                                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                                {
                                    if( $reels['reel' . $r][0] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 && $reels['reel' . $r][1] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 && $reels['reel' . $r][2] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 ) 
                                    {
                                        $_obf_0D041B343E2F372F332A372A0A292A300B3C2D27360311 .= ('&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.reelindex=' . ($r - 1) . '&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.rowindex=2&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.symbol=SYM' . $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101);
                                        $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522++;
                                    }
                                    if( $reels['reel' . $r][1] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 && $reels['reel' . $r][2] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 && $reels['reel' . $r][3] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 ) 
                                    {
                                        if( $r == 3 || $r == 4 || $r == 5 ) 
                                        {
                                            $_obf_0D29353602391E311D2C1C1A0F232339173B2A2E0B2A32 = true;
                                            $_obf_0D5B211F2B171D22372B2B400C302B4034353F15271411 = $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101;
                                            $_obf_0D29310A2C362B131A253228082F1107292123250A3332 = $r;
                                        }
                                        $_obf_0D041B343E2F372F332A372A0A292A300B3C2D27360311 .= ('&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.reelindex=' . ($r - 1) . '&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.rowindex=3&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.symbol=SYM' . $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101);
                                        $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522++;
                                    }
                                    if( $reels['reel' . $r][2] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 && $reels['reel' . $r][3] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 && $reels['reel' . $r][4] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 ) 
                                    {
                                        $_obf_0D041B343E2F372F332A372A0A292A300B3C2D27360311 .= ('&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.reelindex=' . ($r - 1) . '&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.rowindex=4&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.symbol=SYM' . $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101);
                                        $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522++;
                                    }
                                    if( $reels['reel' . $r][0] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 && $reels['reel' . $r][1] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 && !in_array($reels['reel' . $r][2], $_obf_0D13022121133406290B191B5B2D1C122D170239282922) ) 
                                    {
                                        $_obf_0D041B343E2F372F332A372A0A292A300B3C2D27360311 .= ('&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.reelindex=' . ($r - 1) . '&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.rowindex=1&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.symbol=SYM' . $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101);
                                        $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522++;
                                    }
                                    if( $reels['reel' . $r][4] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 && $reels['reel' . $r][3] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 && !in_array($reels['reel' . $r][5], $_obf_0D13022121133406290B191B5B2D1C122D170239282922) ) 
                                    {
                                        $_obf_0D041B343E2F372F332A372A0A292A300B3C2D27360311 .= ('&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.reelindex=' . ($r - 1) . '&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.rowindex=5&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.symbol=SYM' . $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101);
                                        $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522++;
                                    }
                                }
                                else if( $reels['reel' . $r][0] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 && $reels['reel' . $r][1] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 && $reels['reel' . $r][2] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 ) 
                                {
                                    $_obf_0D041B343E2F372F332A372A0A292A300B3C2D27360311 .= ('&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.reelindex=' . ($r - 1) . '&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.rowindex=2&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.symbol=SYM' . $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101);
                                    $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522++;
                                    if( $r == 3 ) 
                                    {
                                        $_obf_0D29310A2C362B131A253228082F1107292123250A3332 = 3;
                                        $_obf_0D29353602391E311D2C1C1A0F232339173B2A2E0B2A32 = true;
                                        $_obf_0D5B211F2B171D22372B2B400C302B4034353F15271411 = $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101;
                                    }
                                }
                                else if( $reels['reel' . $r][0] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 && $reels['reel' . $r][1] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 ) 
                                {
                                    $_obf_0D041B343E2F372F332A372A0A292A300B3C2D27360311 .= ('&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.reelindex=' . ($r - 1) . '&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.rowindex=1&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.symbol=SYM' . $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101);
                                    $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522++;
                                }
                                else if( $reels['reel' . $r][1] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 && $reels['reel' . $r][2] == $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101 ) 
                                {
                                    $_obf_0D041B343E2F372F332A372A0A292A300B3C2D27360311 .= ('&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.reelindex=' . ($r - 1) . '&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.rowindex=3&stackbottom.i' . $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522 . '.symbol=SYM' . $_obf_0D372F3D5C3D102F04035C2C3D0C082D0B230F2D090101);
                                    $_obf_0D0F291F131A081F3E0837231A38341E042E2840251522++;
                                }
                            }
                        }
                        $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '';
                        if( $_obf_0D29353602391E311D2C1C1A0F232339173B2A2E0B2A32 ) 
                        {
                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '&feature.hotspot=true';
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                            {
                                $_obf_0D1E2615361F1F270731103109221C3237121D0F101222 = 7;
                                $_obf_0D09281406401C292E402C1B090D13010D2F043E340C32 = 4;
                            }
                            else
                            {
                                $_obf_0D1E2615361F1F270731103109221C3237121D0F101222 = 5;
                                $_obf_0D09281406401C292E402C1B090D13010D2F043E340C32 = 2;
                            }
                            for( $r = 1; $r <= $_obf_0D1E2615361F1F270731103109221C3237121D0F101222; $r++ ) 
                            {
                                if( $r == $_obf_0D29310A2C362B131A253228082F1107292123250A3332 ) 
                                {
                                }
                                else
                                {
                                    $_obf_0D270B3F5B3F0D18110B253D0A1E14382821051A091811 = 0;
                                    for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= $_obf_0D09281406401C292E402C1B090D13010D2F043E340C32; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                                    {
                                        if( ($reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == 7 || $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == 6 || $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == 5 || $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == 4) && $_obf_0D5B211F2B171D22372B2B400C302B4034353F15271411 != $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] ) 
                                        {
                                            $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = $_obf_0D5B211F2B171D22372B2B400C302B4034353F15271411;
                                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 .= ('&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D270B3F5B3F0D18110B253D0A1E14382821051A091811 . '.row=' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D270B3F5B3F0D18110B253D0A1E14382821051A091811 . '.with=SYM' . $_obf_0D5B211F2B171D22372B2B400C302B4034353F15271411 . '&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D270B3F5B3F0D18110B253D0A1E14382821051A091811 . '.pos=1&s=' . $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] . '&hotspotSym=' . $_obf_0D5B211F2B171D22372B2B400C302B4034353F15271411);
                                            $_obf_0D270B3F5B3F0D18110B253D0A1E14382821051A091811++;
                                        }
                                    }
                                }
                            }
                        }
                        $_obf_0D1609230430040D3B030A5C071834050C1D38122F2E01 = false;
                        $_obf_0D385B0A402632052F3C35013C265C022B021F5B280232 = '';
                        if( rand(1, 15) == 1 ) 
                        {
                        }
                        if( $_obf_0D29353602391E311D2C1C1A0F232339173B2A2E0B2A32 ) 
                        {
                            $_obf_0D1609230430040D3B030A5C071834050C1D38122F2E01 = false;
                        }
                        if( $_obf_0D1609230430040D3B030A5C071834050C1D38122F2E01 ) 
                        {
                            $_obf_0D290732070B28143D0E263F1915190E39233B1C3C3F22 = rand(2, 4);
                            $_obf_0D3C2E2A24092F3F1C29302A12052B305B163B37102C22 = rand(2, 3);
                            $rSym = rand(4, 7);
                            $_obf_0D385B0A402632052F3C35013C265C022B021F5B280232 = 'rs.i0.r.i0.overlay.i0.pos=64&ws.i6.types.i0.wintype=coins&gameServerVersion=1.3.0&g4mode=false&historybutton=false&gamestate.history=basic&ws.i4.betline=0&ws.i2.types.i0.cents=12&rs.i0.r.i1.syms=SYM3%2CSYM8%2CSYM6&ws.i1.aftershieldwall=false&feature.shieldwall.rowindex=0&ws.i4.aftershieldwall=false&win.cap.reached=false&totalwin.coins=48&gamestate.current=basic&ws.i7.aftershieldwall=false&rs.i0.r.i2.overlay.i0.row=0&feature.shieldwall.reelindex=1&ws.i6.reelset=basic&stackbottom.i0.rowindex=4&rs.i0.r.i1.overlay.i0.row=0&feature.shieldwall.height=2&isJackpotWin=false&rs.i0.r.i0.pos=64&ws.i2.reelset=basic&stackbottom.i0.symbol=SYM6&rs.i0.r.i1.pos=6&ws.i4.direction=left_to_right&rs.i0.r.i1.overlay.i1.pos=7&ws.i6.types.i0.cents=12&game.win.coins=48&ws.i3.betline=0&rs.i0.r.i1.hold=false&ws.i1.reelset=basic&ws.i1.types.i0.wintype=coins&clientaction=spin&rs.i0.r.i2.hold=false&feature.shieldwall.activated=true&ws.i7.betline=0&ws.i2.betline=0&ws.i0.pos.i2=1%2C0&playercurrency=%26%23x20AC%3B&ws.i7.sym=SYM5&ws.i2.pos.i1=1%2C1&ws.i6.direction=left_to_right&current.rs.i0=basic&ws.i1.pos.i0=0%2C0&ws.i2.pos.i0=0%2C0&ws.i0.reelset=basic&ws.i1.pos.i1=1%2C0&ws.i3.pos.i1=1%2C1&ws.i5.types.i0.wintype=coins&ws.i1.pos.i2=2%2C1&ws.i4.pos.i0=0%2C1&ws.i7.types.i0.wintype=coins&ws.i5.sym=SYM5&rs.i0.r.i2.overlay.i0.pos=111&rs.i0.id=basic&feature.hotspot=false&credit=500016&ws.i0.types.i0.coins=6&stackbottom.i0.reelindex=1&multiplier=1&ws.i3.types.i0.wintype=coins&ws.i4.types.i0.cents=12&ws.i7.direction=left_to_right&ws.i2.aftershieldwall=false&ws.i0.sym=SYM5&rs.i0.r.i0.overlay.i1.pos=65&rs.i0.r.i2.overlay.i1.row=1&ws.i5.aftershieldwall=false&ws.i6.pos.i2=2%2C0&ws.i6.types.i0.coins=6&ws.i0.direction=left_to_right&ws.i6.pos.i0=1%2C1&gamestate.stack=basic&ws.i6.pos.i1=0%2C1&ws.i6.betline=0&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&ws.i0.types.i0.wintype=coins&ws.i4.reelset=basic&rs.i0.r.i0.overlay.i0.row=0&rs.i0.r.i1.overlay.i1.row=1&ws.i3.types.i0.cents=12&ws.i7.types.i0.coins=6&ws.i3.aftershieldwall=false&ws.i0.aftershieldwall=false&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i1.overlay.i0.pos=6&ws.i5.betline=0&feature.shieldwall.width=3&feature.shieldwall.symbol=SYM' . $rSym . '&ws.i6.aftershieldwall=false&ws.i7.types.i0.cents=12&ws.i5.direction=left_to_right&rs.i0.r.i3.hold=false';
                            for( $r = 2; $r <= 4; $r++ ) 
                            {
                                $_obf_0D2B3D3F2D3D0606222C3812063E1A250402050B073001 = 0;
                                for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 1; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                                {
                                    $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = $rSym;
                                    $_obf_0D385B0A402632052F3C35013C265C022B021F5B280232 .= ('&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D2B3D3F2D3D0606222C3812063E1A250402050B073001 . '.row=' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D2B3D3F2D3D0606222C3812063E1A250402050B073001 . '.with=SYM' . $rSym . '&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D2B3D3F2D3D0606222C3812063E1A250402050B073001 . '.pos=1&s=' . $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] . '&hotspotSym=' . $_obf_0D5B211F2B171D22372B2B400C302B4034353F15271411);
                                    $_obf_0D2B3D3F2D3D0606222C3812063E1A250402050B073001++;
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
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0
                                ];
                                $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 = 1;
                                $_obf_0D1C111B2432372F281601011A12053E03290318142222 = [];
                                $_obf_0D1B1910172D03132D040D301C2A39140C2F0A265C1532 = [];
                                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                                {
                                    $_obf_0D1B1910172D03132D040D301C2A39140C2F0A265C1532[20] = [
                                        [
                                            0, 
                                            1, 
                                            2, 
                                            3, 
                                            4
                                        ], 
                                        [
                                            0, 
                                            1, 
                                            2, 
                                            3, 
                                            4
                                        ], 
                                        [
                                            0, 
                                            1, 
                                            2, 
                                            3, 
                                            4
                                        ], 
                                        [
                                            0, 
                                            1, 
                                            2, 
                                            3, 
                                            4
                                        ], 
                                        [
                                            0, 
                                            1, 
                                            2, 
                                            3, 
                                            4
                                        ], 
                                        [
                                            0, 
                                            1, 
                                            2, 
                                            3, 
                                            4
                                        ], 
                                        [
                                            0, 
                                            1, 
                                            2, 
                                            3, 
                                            4
                                        ]
                                    ];
                                    $_obf_0D225C020C2B2E1806353F033807230221211B362C1822 = 7;
                                }
                                else
                                {
                                    $_obf_0D1B1910172D03132D040D301C2A39140C2F0A265C1532[20] = [
                                        [
                                            0, 
                                            1, 
                                            2
                                        ], 
                                        [
                                            0, 
                                            1, 
                                            2
                                        ], 
                                        [
                                            0, 
                                            1, 
                                            2
                                        ], 
                                        [
                                            0, 
                                            1, 
                                            2
                                        ], 
                                        [
                                            0, 
                                            1, 
                                            2
                                        ]
                                    ];
                                    $_obf_0D225C020C2B2E1806353F033807230221211B362C1822 = 5;
                                }
                                $_obf_0D03192821275B1E1B065C1D15161730081D1828362C01 = [
                                    0, 
                                    1, 
                                    2, 
                                    3, 
                                    4, 
                                    5, 
                                    6
                                ];
                                $_obf_0D16295B0631330A30050125140F2F031F04241C020932 = 0;
                                $_obf_0D1C011B1E170C5B1C082C1A3D22273F2B383F280F2D22 = 0;
                                for( $_obf_0D073D210B3816042B161A052B070A16343833352A3811 = 1; $_obf_0D073D210B3816042B161A052B070A16343833352A3811 <= $_obf_0D225C020C2B2E1806353F033807230221211B362C1822; $_obf_0D073D210B3816042B161A052B070A16343833352A3811++ ) 
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
                                    if( $_obf_0D5B211F2B171D22372B2B400C302B4034353F15271411 == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 && $_obf_0D29353602391E311D2C1C1A0F232339173B2A2E0B2A32 ) 
                                    {
                                        $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 = $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[$_obf_0D073D210B3816042B161A052B070A16343833352A3811] * $_obf_0D352E0A230A18250933393D19150E1B3528100D381911;
                                    }
                                    else
                                    {
                                        if( $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[$_obf_0D073D210B3816042B161A052B070A16343833352A3811] <= 0 ) 
                                        {
                                            break;
                                        }
                                        $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 = $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[$_obf_0D073D210B3816042B161A052B070A16343833352A3811] * $_obf_0D352E0A230A18250933393D19150E1B3528100D381911;
                                    }
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
                                if( $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[1] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[2] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[3] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[4] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[5] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[6] > 0 ) 
                                {
                                    $cWins[$j] = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][6] * $betline * $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 * $bonusMpl;
                                    $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=basic&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $cWins[$j] . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=243&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($cWins[$j] * $slotSettings->CurrentDenomination * 100) . '' . implode('', $_obf_0D1C111B2432372F281601011A12053E03290318142222);
                                }
                                if( $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[1] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[2] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[3] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[4] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[5] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[6] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[7] > 0 ) 
                                {
                                    $cWins[$j] = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][7] * $betline * $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 * $bonusMpl;
                                    $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=basic&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $cWins[$j] . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=243&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($cWins[$j] * $slotSettings->CurrentDenomination * 100) . '' . implode('', $_obf_0D1C111B2432372F281601011A12053E03290318142222);
                                }
                                if( $_obf_0D5B211F2B171D22372B2B400C302B4034353F15271411 == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 && $_obf_0D29353602391E311D2C1C1A0F232339173B2A2E0B2A32 ) 
                                {
                                    $_obf_0D251C111D3F06373503400C162A372410345B03382C11 = 0;
                                    for( $_obf_0D1A19251D031222320F15170E05273C2F0223231A3822 = 0; $_obf_0D1A19251D031222320F15170E05273C2F0223231A3822 < 7; $_obf_0D1A19251D031222320F15170E05273C2F0223231A3822++ ) 
                                    {
                                        $_obf_0D251C111D3F06373503400C162A372410345B03382C11 += $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[$_obf_0D1A19251D031222320F15170E05273C2F0223231A3822];
                                    }
                                    $cWins[$j] = $slotSettings->Paytable['SCATTER_PAYS'][$_obf_0D251C111D3F06373503400C162A372410345B03382C11] * $betline * $bonusMpl;
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
                        $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [];
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                            {
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == $scatter ) 
                                {
                                    $scattersCount++;
                                    $_obf_0D312B19262C083426241E0D392E22282324060B380811[] = '&ws.i0.pos.i' . ($r - 1) . '=' . ($r - 1) . '%2C' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '';
                                }
                            }
                        }
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
                            if( $scattersCount >= 3 && $winType != 'bonus' ) 
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
                    $freeState = '';
                    $reels = $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01;
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                        $slotSettings->SetBalance($totalWin);
                    }
                    $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '&rs.i0.r.i0.syms=SYM' . $reels['reel1'][0] . '%2CSYM' . $reels['reel1'][1] . '%2CSYM' . $reels['reel1'][2] . '%2CSYM' . $reels['reel1'][3] . '%2CSYM' . $reels['reel1'][4] . '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.syms=SYM' . $reels['reel2'][0] . '%2CSYM' . $reels['reel2'][1] . '%2CSYM' . $reels['reel2'][2] . '%2CSYM' . $reels['reel2'][3] . '%2CSYM' . $reels['reel2'][4] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.syms=SYM' . $reels['reel3'][0] . '%2CSYM' . $reels['reel3'][1] . '%2CSYM' . $reels['reel3'][2] . '%2CSYM' . $reels['reel3'][3] . '%2CSYM' . $reels['reel3'][4] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.syms=SYM' . $reels['reel4'][0] . '%2CSYM' . $reels['reel4'][1] . '%2CSYM' . $reels['reel4'][2] . '%2CSYM' . $reels['reel4'][3] . '%2CSYM' . $reels['reel4'][4] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.syms=SYM' . $reels['reel5'][0] . '%2CSYM' . $reels['reel5'][1] . '%2CSYM' . $reels['reel5'][2] . '%2CSYM' . $reels['reel5'][3] . '%2CSYM' . $reels['reel5'][4] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i5.syms=SYM' . $reels['reel6'][0] . '%2CSYM' . $reels['reel6'][1] . '%2CSYM' . $reels['reel6'][2] . '%2CSYM' . $reels['reel6'][3] . '%2CSYM' . $reels['reel6'][4] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i6.syms=SYM' . $reels['reel7'][0] . '%2CSYM' . $reels['reel7'][1] . '%2CSYM' . $reels['reel7'][2] . '%2CSYM' . $reels['reel7'][3] . '%2CSYM' . $reels['reel7'][4] . '');
                    }
                    else
                    {
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '&rs.i0.r.i0.syms=SYM' . $reels['reel1'][0] . '%2CSYM' . $reels['reel1'][1] . '%2CSYM' . $reels['reel1'][2] . '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.syms=SYM' . $reels['reel2'][0] . '%2CSYM' . $reels['reel2'][1] . '%2CSYM' . $reels['reel2'][2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.syms=SYM' . $reels['reel3'][0] . '%2CSYM' . $reels['reel3'][1] . '%2CSYM' . $reels['reel3'][2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.syms=SYM' . $reels['reel4'][0] . '%2CSYM' . $reels['reel4'][1] . '%2CSYM' . $reels['reel4'][2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.syms=SYM' . $reels['reel5'][0] . '%2CSYM' . $reels['reel5'][1] . '%2CSYM' . $reels['reel5'][2] . '');
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $slotSettings->SetGameData('VikingsNETBonusWin', $slotSettings->GetGameData('VikingsNETBonusWin') + $totalWin);
                        $slotSettings->SetGameData('VikingsNETTotalWin', $slotSettings->GetGameData('VikingsNETTotalWin') + $totalWin);
                    }
                    else
                    {
                        $slotSettings->SetGameData('VikingsNETTotalWin', $totalWin);
                    }
                    $fs = 0;
                    if( $scattersCount >= 3 ) 
                    {
                        $slotSettings->SetGameData('VikingsNETFreeStartWin', $totalWin);
                        $slotSettings->SetGameData('VikingsNETBonusWin', $totalWin);
                        $slotSettings->SetGameData('VikingsNETFreeGames', $slotSettings->slotFreeCount[$scattersCount]);
                        $fs = $slotSettings->GetGameData('VikingsNETFreeGames');
                        $freeState = '&rs.i0.nearwin=4&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19&freespins.totalwin.cents=0&nextaction=freespin&freespins.left=' . $fs . '&freespins.wavecount=1&freespins.multiplier=1&gamestate.stack=basic%2Cfreespin&freespins.totalwin.coins=' . $totalWin . '&freespins.total=' . $fs . '&freespins.win.cents=0&gamestate.current=freespin&freespins.initial=' . $fs . '&freespins.win.coins=' . $totalWin . '&freespins.betlevel=' . $slotSettings->GetGameData('VikingsNETBet') . '&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= $freeState;
                    }
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode('', $lineWins);
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                    $slotSettings->SetGameData('VikingsNETGambleStep', 5);
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = $slotSettings->GetGameData('VikingsNETCards');
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
                        $totalWin = $slotSettings->GetGameData('VikingsNETBonusWin');
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') ) 
                        {
                            $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'spin';
                            $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 = 'basic';
                            $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 = 'basic';
                            $_obf_0D290510262A13373218051031062E401B080E0E271E01 = 'basic';
                        }
                        else
                        {
                            $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 = 'freespin';
                            $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'freespin';
                            $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 = 'basic%2Cfreespin';
                            $_obf_0D290510262A13373218051031062E401B080E0E271E01 = 'freespin';
                        }
                        $fs = $slotSettings->GetGameData('VikingsNETFreeGames');
                        $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 = $slotSettings->GetGameData('VikingsNETFreeGames') - $slotSettings->GetGameData('VikingsNETCurrentFreeGame');
                        $freeState = '&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19&next.rs=' . $_obf_0D290510262A13373218051031062E401B080E0E271E01 . '&freespins.totalwin.cents=0&nextaction=' . $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 . '&freespins.left=' . $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 . '&freespins.wavecount=1&freespins.multiplier=1&gamestate.stack=' . $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 . '&freespins.totalwin.coins=' . $totalWin . '&freespins.total=' . $fs . '&freespins.win.cents=' . ($totalWin / $slotSettings->CurrentDenomination * 100) . '&gamestate.current=' . $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 . '&freespins.initial=' . $fs . '&freespins.win.coins=' . $totalWin . '&freespins.betlevel=' . $slotSettings->GetGameData('VikingsNETBet') . '&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= $freeState;
                    }
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"freeState":"' . $freeState . '","slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData('VikingsNETFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('VikingsNETCurrentFreeGame') . ',"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":' . $slotSettings->GetGameData('VikingsNETBonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * $slotSettings->CurrentDenom * 100);
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'previous.rs.i0=freespin&freespins.betlevel=1&rs.i0.r.i6.pos=104&gameServerVersion=1.3.0&g4mode=false&freespins.win.coins=0&playercurrency=%26%23x20AC%3B&historybutton=false&current.rs.i0=freespin&rs.i0.r.i4.hold=false&next.rs=freespin&gamestate.history=basic%2Cfreespin&rs.i0.r.i1.syms=SYM9%2CSYM5%2CSYM11%2CSYM12%2CSYM12&rs.i0.r.i5.hold=false&game.win.cents=0&rs.i0.id=freespin&win.cap.reached=false&totalwin.coins=0&feature.hotspot=false&credit=501268&gamestate.current=freespin&freespins.initial=7&rs.i0.r.i6.syms=SYM11%2CSYM9%2CSYM12%2CSYM6%2CSYM12&jackpotcurrency=%26%23x20AC%3B&multiplier=1&last.rs=freespin&freespins.denomination=2.000&rs.i0.r.i0.syms=SYM6%2CSYM10%2CSYM8%2CSYM8%2CSYM10&rs.i0.r.i3.syms=SYM4%2CSYM4%2CSYM11%2CSYM10%2CSYM9&freespins.win.cents=0&freespins.totalwin.coins=0&freespins.total=7&isJackpotWin=false&gamestate.stack=basic%2Cfreespin&rs.i0.r.i0.pos=47&freespins.betlines=0&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i0.r.i1.pos=43&game.win.coins=0&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i5.syms=SYM9%2CSYM8%2CSYM10%2CSYM9%2CSYM12&rs.i0.r.i1.hold=false&freespins.wavecount=1&freespins.multiplier=1&playforfun=true&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=freespin&rs.i0.r.i2.hold=false&feature.shieldwall.activated=false&rs.i0.r.i4.syms=SYM4%2CSYM11%2CSYM10%2CSYM9%2CSYM9&rs.i0.r.i2.pos=99&totalwin.cents=0&gameover=false&rs.i0.r.i0.hold=false&rs.i0.r.i6.hold=false&rs.i0.r.i3.pos=57&freespins.left=6&rs.i0.r.i4.pos=42&nextaction=freespin&rs.i0.r.i5.pos=109&wavecount=1&rs.i0.r.i2.syms=SYM8%2CSYM12%2CSYM8%2CSYM7%2CSYM8&rs.i0.r.i3.hold=false&game.win.amount=0.00&freespins.totalwin.cents=0' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . $_obf_0D041B343E2F372F332A372A0A292A300B3C2D27360311 . $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32;
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = $_obf_0D385B0A402632052F3C35013C265C022B021F5B280232 . 'rs.i0.r.i1.pos=18&g4mode=false&game.win.coins=' . $totalWin . '&playercurrency=%26%23x20AC%3B&playercurrencyiso=' . $slotSettings->slotCurrency . '&historybutton=false&rs.i0.r.i1.hold=false&rs.i0.r.i4.hold=false&gamestate.history=basic&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=spin&rs.i0.r.i2.hold=false&game.win.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.r.i2.pos=47&rs.i0.id=basic&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&gamestate.current=basic&gameover=true&rs.i0.r.i0.hold=false&jackpotcurrency=%26%23x20AC%3B&multiplier=1&rs.i0.r.i3.pos=4&rs.i0.r.i4.pos=5&isJackpotWin=false&gamestate.stack=basic&nextaction=spin&rs.i0.r.i0.pos=7&wavecount=1&gamesoundurl=&rs.i0.r.i3.hold=false&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . $_obf_0D041B343E2F372F332A372A0A292A300B3C2D27360311 . $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32;
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
