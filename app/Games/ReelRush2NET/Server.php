<?php 
namespace VanguardLTE\Games\ReelRush2NET
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
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['freeMode'] = '';
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'freespin' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] = 'spin';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'superfreespin' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] = 'spin';
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['freeMode'] = 'superfreespin';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'respin' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'respin';
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
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'purchasestars' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'purchasestars';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'gamble' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'gamble';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'initfreespin' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'initfreespin';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'startfreespins' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'startfreespins';
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
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Stars', 0);
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
                        $freeState = 'rs.i1.r.i0.syms=SYM5%2CSYM5%2CSYM9&ws.i6.sym=SYM10&rs.i0.r.i4.hold=false&gamestate.history=basic%2Cstart_freespins%2Cfreespin&ws.i4.betline=0&rs.i1.r.i2.hold=false&ws.i5.types.i0.cents=30&ws.i9.direction=left_to_right&game.win.cents=1530&staticsharedurl=https%3A%2F%2Fstatic-shared.casinomodule.com%2Fgameclient_html%2Fdevicedetection%2Fcurrent&bl.i0.reelset=ALL&ws.i9.reelset=freespin3&freespins.initial=0&ws.i8.types.i0.wintype=coins&rs.i2.r.i0.hold=false&rs.i0.r.i0.syms=SYM4%2CSYM4%2CSYM5%2CSYM5%2CSYM9&ws.i6.reelset=freespin3&rs.i1.r.i1.pos=46&rs.i3.r.i4.pos=0&rs.i6.r.i3.syms=SYM12%2CSYM12%2CSYM4%2CSYM11%2CSYM10&rs.i0.r.i0.pos=0&rs.i2.r.i3.pos=50&rs.i5.r.i0.pos=25&rs.i2.r.i4.hold=false&rs.i3.r.i1.pos=0&ws.i6.types.i0.cents=30&rs.i2.id=freespin2&rs.i4.r.i2.overlay.i0.row=0&rs.i6.r.i1.pos=0&game.win.coins=306&rs.i1.r.i0.hold=false&ws.i1.reelset=freespin3&clientaction=init&rs.i4.r.i0.hold=false&rs.i0.r.i2.hold=false&rs.i4.r.i3.syms=SYM10%2CSYM10%2CSYM4%2CSYM4%2CSYM10&casinoID=netent&rs.i3.r.i2.hold=false&ws.i5.types.i0.coins=6&rs.i5.r.i1.syms=SYM13%2CSYM13%2CSYM1%2CSYM9%2CSYM9&rs.i0.r.i3.pos=0&rs.i4.r.i0.syms=SYM10%2CSYM10%2CSYM3%2CSYM3%2CSYM4&rs.i5.r.i3.pos=7&ws.i3.sym=SYM4&bl.i0.line=0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4&ws.i3.types.i0.coins=25&ws.i4.types.i0.wintype=coins&rs.i4.r.i2.pos=39&rs.i0.r.i2.syms=SYM3%2CSYM9%2CSYM9%2CSYM12%2CSYM12&game.win.amount=15.30&betlevel.all=' . implode('%2C', $slotSettings->Denominations) . '&ws.i7.betline=0&rs.i5.r.i2.hold=false&denomination.all=1%2C2%2C5%2C10%2C20&ws.i7.sym=SYM10&ws.i2.pos.i1=0%2C4&ws.i6.direction=left_to_right&rs.i2.r.i0.pos=15&ws.i2.pos.i0=1%2C1&ws.i0.reelset=freespin3&ws.i2.pos.i3=3%2C2&ws.i4.pos.i3=2%2C0&ws.i5.types.i0.wintype=coins&ws.i2.pos.i2=2%2C0&ws.i4.pos.i2=3%2C0&ws.i4.pos.i1=1%2C4&ws.i4.pos.i0=0%2C0&ws.i7.types.i0.wintype=coins&rs.i3.r.i2.syms=SYM5%2CSYM11%2CSYM9%2CSYM7%2CSYM8&rs.i1.r.i4.pos=28&denomination.standard=5&rs.i3.id=superFreespin2&multiplier=1&ws.i8.reelset=freespin3&freespins.denomination=5.000&autoplay=10%2C25%2C50%2C75%2C100%2C250%2C500%2C750%2C1000&ws.i6.types.i0.coins=6&freespins.totalwin.coins=144&ws.i0.direction=left_to_right&freespins.total=0&gamestate.stack=basic%2Cfreespin&rs.i6.r.i2.pos=0&ws.i6.betline=0&rs.i1.r.i4.syms=SYM6&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i5.r.i2.syms=SYM12%2CSYM12%2CSYM1%2CSYM4%2CSYM4&rs.i5.r.i3.hold=false&bet.betlevel=1&rs.i4.r.i2.hold=false&rs.i4.r.i1.syms=SYM4%2CSYM4%2CSYM13%2CSYM13%2CSYM10&lastreelsetid=freespin3&rs.i2.r.i4.pos=33&rs.i3.r.i0.syms=SYM6%2CSYM7%2CSYM3%2CSYM5%2CSYM5&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i4.r.i1.hold=false&ws.i2.types.i0.coins=25&rs.i3.r.i2.pos=0&ws.i2.sym=SYM4&freespins.multiplier=1&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM5%2CSYM5%2CSYM13%2CSYM13%2CSYM3&rs.i0.r.i2.pos=0&ws.i9.types.i0.coins=6&rs.i6.r.i3.pos=0&ws.i1.betline=0&rs.i1.r.i0.pos=2&rs.i6.r.i3.hold=false&bl.i0.coins=20&ws.i2.types.i0.wintype=coins&rs.i2.r.i0.syms=SYM11%2CSYM9%2CSYM9%2CSYM13%2CSYM13&ws.i9.types.i0.cents=30&rs.i3.r.i1.syms=SYM13%2CSYM4%2CSYM6%2CSYM13%2CSYM13&rs.i1.r.i4.hold=false&freespins.left=5&casinoconfiguration.FEATURE_SUPER_TOKENS_BUY_ENABLED=TRUE&ws.i9.betline=0&rs.i4.r.i1.pos=33&ws.i7.pos.i0=0%2C1&rs.i4.r.i2.syms=SYM13%2CSYM11%2CSYM11%2CSYM12%2CSYM12&bl.standard=0&ws.i3.reelset=freespin3&ws.i7.pos.i3=2%2C0&ws.i7.pos.i2=3%2C0&rs.i5.r.i3.syms=SYM5%2CSYM5%2CSYM9%2CSYM9%2CSYM8&ws.i7.pos.i1=1%2C4&rs.i3.r.i0.hold=false&rs.i6.r.i4.syms=SYM12%2CSYM9%2CSYM5%2CSYM6%2CSYM11&ws.i5.direction=left_to_right&rs.i0.r.i3.hold=false&bet.denomination=5&rs.i5.r.i4.pos=64&rs.i4.id=freespin3&rs.i2.r.i1.hold=false&ws.i6.types.i0.wintype=coins&gameServerVersion=1.21.0&g4mode=false&freespins.win.coins=136&stars.unscaled=655&historybutton=false&ws.i2.direction=left_to_right&gameEventSetters.enabled=false&next.rs=freespin&ws.i8.types.i0.coins=6&ws.i2.types.i0.cents=125&rs.i1.r.i3.pos=15&rs.i0.r.i1.syms=SYM13%2CSYM1%2CSYM12%2CSYM10%2CSYM10&ws.i1.types.i0.coins=25&rs.i2.r.i1.pos=8&rs.i4.r.i4.pos=52&ws.i0.betline=0&rs.i1.r.i3.hold=false&totalwin.coins=306&rs.i5.r.i4.syms=SYM7%2CSYM13%2CSYM13&gamestate.current=freespin&rs.i4.r.i0.pos=4&ws.i3.direction=left_to_right&jackpotcurrency=%26%23x20AC%3B&bet.betlines=0&rs.i3.r.i1.hold=false&rs.i0.r.i3.syms=SYM11%2CSYM10%2CSYM10%2CSYM8%2CSYM8&rs.i1.r.i1.syms=SYM4%2CSYM4%2CSYM12&freespins.win.cents=680&isJackpotWin=false&rs.i6.r.i4.hold=false&ws.i8.betline=0&ws.i8.sym=SYM10&rs.i2.r.i3.hold=false&ws.i2.reelset=freespin3&freespins.betlines=0&rs.i4.r.i2.overlay.i0.with=SYM1&ws.i4.direction=left_to_right&rs.i0.r.i1.pos=0&rs.i4.r.i4.syms=SYM6%2CSYM11%2CSYM11%2CSYM13%2CSYM13&rs.i1.r.i3.syms=SYM6%2CSYM13%2CSYM13&ws.i3.betline=0&rs.i0.r.i1.hold=false&rs.i2.r.i1.syms=SYM4%2CSYM4%2CSYM12%2CSYM12%2CSYM10&ws.i1.types.i0.wintype=coins&openedpositions.thisspin=0&ws.i1.sym=SYM4&betlevel.standard=1&ws.i1.types.i0.cents=125&rs.i6.r.i2.syms=SYM5%2CSYM11%2CSYM9%2CSYM7%2CSYM8&gameover=false&rs.i3.r.i3.pos=0&rs.i5.id=basic&rs.i6.r.i4.pos=0&ws.i9.pos.i0=0%2C1&ws.i8.types.i0.cents=30&ws.i9.pos.i2=1%2C4&rs.i5.r.i1.hold=false&ws.i1.direction=left_to_right&ws.i9.pos.i1=3%2C4&rs.i5.r.i4.hold=false&rs.i6.r.i2.hold=false&bl.i0.id=0&ws.i5.pos.i0=0%2C0&ws.i5.pos.i1=1%2C4&ws.i5.pos.i2=2%2C0&nextaction=freespin&ws.i5.pos.i3=3%2C1&ws.i9.pos.i3=2%2C0&ws.i5.reelset=freespin3&freespins.totalwin.cents=720&ws.i2.betline=0&ws.i0.pos.i3=3%2C2&freespins.betlevel=1&ws.i0.pos.i2=1%2C0&ws.i1.pos.i3=1%2C0&rs.i4.r.i3.pos=55&playercurrency=%26%23x20AC%3B&ws.i3.pos.i3=2%2C0&rs.i4.r.i4.hold=false&ws.i1.pos.i0=3%2C3&ws.i1.pos.i1=0%2C4&ws.i3.pos.i1=3%2C3&ws.i1.pos.i2=2%2C0&ws.i3.pos.i2=0%2C4&ws.i0.pos.i1=2%2C0&rs.i5.r.i0.syms=SYM12%2CSYM11%2CSYM11%2CSYM6%2CSYM6&ws.i0.pos.i0=0%2C4&ws.i3.pos.i0=1%2C1&rs.i2.r.i4.syms=SYM10%2CSYM10%2CSYM8%2CSYM8%2CSYM12&rs.i4.r.i3.hold=false&ws.i5.sym=SYM10&rs.i6.r.i0.hold=false&rs.i0.id=freespin&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&ws.i0.types.i0.coins=25&rs.i2.r.i2.pos=24&ws.i9.sym=SYM10&last.rs=freespin&ws.i8.pos.i0=0%2C1&ws.i8.pos.i1=1%2C4&ws.i3.types.i0.wintype=coins&rs.i5.r.i1.pos=26&ws.i4.types.i0.cents=30&ws.i7.direction=left_to_right&openedpositions.total=12&ws.i0.sym=SYM4&ws.i6.pos.i2=1%2C4&rs.i6.r.i0.syms=SYM6%2CSYM7%2CSYM3%2CSYM5%2CSYM5&ws.i6.pos.i3=2%2C0&ws.i6.pos.i0=0%2C0&casinoconfiguration.FEATURE_SUPER_TOKENS_GAMBLE_ENABLED=true&ws.i6.pos.i1=3%2C4&ws.i8.pos.i2=2%2C0&ws.i8.pos.i3=3%2C1&rs.i6.r.i1.hold=false&rs.i2.r.i2.syms=SYM9%2CSYM13%2CSYM13%2CSYM7%2CSYM7&rs.i1.r.i2.pos=38&rs.i3.r.i3.syms=SYM12%2CSYM12%2CSYM4%2CSYM11%2CSYM10&ws.i0.types.i0.wintype=coins&ws.i4.reelset=freespin3&rs.i3.r.i4.hold=false&rs.i5.r.i0.hold=false&nearwinallowed=true&ws.i3.types.i0.cents=125&ws.i7.types.i0.coins=6&ws.i5.betline=0&rs.i6.r.i1.syms=SYM13%2CSYM4%2CSYM6%2CSYM13%2CSYM13&freespins.wavecount=1&rs.i3.r.i3.hold=false&stars.total=131&rs.i6.r.i0.pos=0&rs.i1.r.i2.syms=SYM10%2CSYM1%2CSYM11%2CSYM11%2CSYM9&rs.i6.id=superFreespin&totalwin.cents=1530&rs.i5.r.i2.pos=3&ws.i7.reelset=freespin3&rs.i0.r.i0.hold=false&ws.i4.sym=SYM10&rs.i2.r.i3.syms=SYM13%2CSYM6%2CSYM6%2CSYM11%2CSYM11&restore=true&rs.i1.id=basic2&rs.i3.r.i4.syms=SYM12%2CSYM9%2CSYM5%2CSYM6%2CSYM11&rs.i0.r.i4.pos=0&ws.i4.types.i0.coins=6&ws.i0.types.i0.cents=125&rs.i3.r.i0.pos=0&ws.i8.direction=left_to_right&rs.i2.r.i2.hold=false&ws.i9.types.i0.wintype=coins&wavecount=1&rs.i4.r.i2.overlay.i0.pos=39&ws.i7.types.i0.cents=30&rs.i1.r.i1.hold=false' . $freeState;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'rs.i4.id=freespin3&rs.i2.r.i1.hold=false&rs.i1.r.i0.syms=SYM3%2CSYM3%2CSYM5%2CSYM5%2CSYM11&gameServerVersion=1.21.0&g4mode=false&stars.unscaled=0&historybutton=false&rs.i0.r.i4.hold=false&gameEventSetters.enabled=false&rs.i1.r.i2.hold=false&rs.i1.r.i3.pos=0&rs.i0.r.i1.syms=SYM13%2CSYM4%2CSYM6%2CSYM13%2CSYM13&rs.i2.r.i1.pos=0&game.win.cents=0&rs.i4.r.i4.pos=0&staticsharedurl=https%3A%2F%2Fstatic-shared.casinomodule.com%2Fgameclient_html%2Fdevicedetection%2Fcurrent&bl.i0.reelset=ALL&rs.i1.r.i3.hold=false&totalwin.coins=0&rs.i5.r.i4.syms=SYM4%2CSYM4%2CSYM9%2CSYM9%2CSYM6&gamestate.current=basic&rs.i4.r.i0.pos=0&jackpotcurrency=%26%23x20AC%3B&rs.i3.r.i1.hold=false&rs.i2.r.i0.hold=false&rs.i0.r.i0.syms=SYM6%2CSYM7%2CSYM3%2CSYM5%2CSYM5&rs.i0.r.i3.syms=SYM12%2CSYM12%2CSYM4%2CSYM11%2CSYM10&rs.i1.r.i1.syms=SYM5%2CSYM5%2CSYM1%2CSYM6%2CSYM6&rs.i1.r.i1.pos=0&rs.i3.r.i4.pos=0&rs.i6.r.i3.syms=SYM12%2CSYM12%2CSYM4%2CSYM11%2CSYM10&isJackpotWin=false&rs.i6.r.i4.hold=false&rs.i0.r.i0.pos=0&rs.i2.r.i3.hold=false&rs.i2.r.i3.pos=0&rs.i5.r.i0.pos=0&rs.i0.r.i1.pos=0&rs.i4.r.i4.syms=SYM12%2CSYM9%2CSYM5%2CSYM6%2CSYM11&rs.i1.r.i3.syms=SYM10%2CSYM8%2CSYM8%2CSYM12%2CSYM12&rs.i2.r.i4.hold=false&rs.i3.r.i1.pos=0&rs.i2.id=freespin2&rs.i6.r.i1.pos=0&game.win.coins=0&rs.i1.r.i0.hold=false&rs.i0.r.i1.hold=false&rs.i2.r.i1.syms=SYM13%2CSYM4%2CSYM6%2CSYM13%2CSYM13&clientaction=init&openedpositions.thisspin=0&rs.i4.r.i0.hold=false&rs.i0.r.i2.hold=false&rs.i4.r.i3.syms=SYM12%2CSYM12%2CSYM4%2CSYM11%2CSYM10&casinoID=netent&betlevel.standard=1&rs.i3.r.i2.hold=false&rs.i6.r.i2.syms=SYM5%2CSYM11%2CSYM9%2CSYM7%2CSYM8&gameover=true&rs.i3.r.i3.pos=0&rs.i5.id=basic&rs.i5.r.i1.syms=SYM5%2CSYM5%2CSYM1%2CSYM6%2CSYM6&rs.i0.r.i3.pos=0&rs.i6.r.i4.pos=0&rs.i5.r.i1.hold=false&rs.i4.r.i0.syms=SYM6%2CSYM7%2CSYM3%2CSYM5%2CSYM5&rs.i5.r.i4.hold=false&rs.i6.r.i2.hold=false&rs.i5.r.i3.pos=0&bl.i0.id=0&bl.i0.line=0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4&nextaction=spin&rs.i4.r.i2.pos=0&rs.i0.r.i2.syms=SYM5%2CSYM11%2CSYM9%2CSYM7%2CSYM8&game.win.amount=0&betlevel.all=1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10&rs.i5.r.i2.hold=false&denomination.all=' . implode('%2C', $slotSettings->Denominations) . '&rs.i4.r.i3.pos=0&playercurrency=%26%23x20AC%3B&rs.i2.r.i0.pos=0&rs.i4.r.i4.hold=false&rs.i5.r.i0.syms=SYM3%2CSYM3%2CSYM5%2CSYM5%2CSYM11&rs.i2.r.i4.syms=SYM12%2CSYM9%2CSYM5%2CSYM6%2CSYM11&rs.i3.r.i2.syms=SYM5%2CSYM11%2CSYM9%2CSYM7%2CSYM8&rs.i4.r.i3.hold=false&rs.i6.r.i0.hold=false&rs.i0.id=freespin&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&rs.i1.r.i4.pos=0&denomination.standard=' . ($slotSettings->CurrentDenomination * 100) . '&rs.i3.id=superFreespin2&multiplier=1&rs.i2.r.i2.pos=0&rs.i5.r.i1.pos=0&openedpositions.total=0&autoplay=10%2C25%2C50%2C75%2C100%2C250%2C500%2C750%2C1000&rs.i6.r.i0.syms=SYM6%2CSYM7%2CSYM3%2CSYM5%2CSYM5&casinoconfiguration.FEATURE_SUPER_TOKENS_GAMBLE_ENABLED=true&rs.i6.r.i2.pos=0&rs.i1.r.i4.syms=SYM4%2CSYM4%2CSYM9%2CSYM9%2CSYM6&rs.i6.r.i1.hold=false&rs.i2.r.i2.syms=SYM5%2CSYM11%2CSYM9%2CSYM7%2CSYM8&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i1.r.i2.pos=0&rs.i5.r.i2.syms=SYM6%2CSYM6%2CSYM13%2CSYM13%2CSYM11&rs.i3.r.i3.syms=SYM12%2CSYM12%2CSYM4%2CSYM11%2CSYM10&rs.i5.r.i3.hold=false&rs.i3.r.i4.hold=false&rs.i4.r.i2.hold=false&rs.i5.r.i0.hold=false&nearwinallowed=true&rs.i4.r.i1.syms=SYM13%2CSYM4%2CSYM6%2CSYM13%2CSYM13&rs.i2.r.i4.pos=0&rs.i3.r.i0.syms=SYM6%2CSYM7%2CSYM3%2CSYM5%2CSYM5&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i4.r.i1.hold=false&rs.i6.r.i1.syms=SYM13%2CSYM4%2CSYM6%2CSYM13%2CSYM13&rs.i3.r.i2.pos=0&rs.i3.r.i3.hold=false&stars.total=0&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i6.r.i0.pos=0&rs.i0.r.i4.syms=SYM12%2CSYM9%2CSYM5%2CSYM6%2CSYM11&rs.i0.r.i2.pos=0&rs.i1.r.i2.syms=SYM6%2CSYM6%2CSYM13%2CSYM13%2CSYM11&rs.i6.r.i3.pos=0&rs.i1.r.i0.pos=0&rs.i6.id=superFreespin&totalwin.cents=0&rs.i6.r.i3.hold=false&bl.i0.coins=20&rs.i2.r.i0.syms=SYM6%2CSYM7%2CSYM3%2CSYM5%2CSYM5&rs.i5.r.i2.pos=0&rs.i0.r.i0.hold=false&rs.i2.r.i3.syms=SYM12%2CSYM12%2CSYM4%2CSYM11%2CSYM10&restore=false&rs.i1.id=basic2&rs.i3.r.i4.syms=SYM12%2CSYM9%2CSYM5%2CSYM6%2CSYM11&rs.i3.r.i1.syms=SYM13%2CSYM4%2CSYM6%2CSYM13%2CSYM13&rs.i1.r.i4.hold=false&casinoconfiguration.FEATURE_SUPER_TOKENS_BUY_ENABLED=TRUE&rs.i0.r.i4.pos=0&rs.i4.r.i1.pos=0&rs.i4.r.i2.syms=SYM5%2CSYM11%2CSYM9%2CSYM7%2CSYM8&bl.standard=0&rs.i3.r.i0.pos=0&rs.i5.r.i3.syms=SYM10%2CSYM8%2CSYM8%2CSYM12%2CSYM12&rs.i3.r.i0.hold=false&rs.i2.r.i2.hold=false&wavecount=1&rs.i6.r.i4.syms=SYM12%2CSYM9%2CSYM5%2CSYM6%2CSYM11&rs.i1.r.i1.hold=false&rs.i0.r.i3.hold=false&rs.i5.r.i4.pos=0';
                    break;
                case 'paytable':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'pt.i0.comp.i19.symbol=SYM8&pt.i0.comp.i15.type=betline&pt.i0.comp.i23.freespins=0&pt.i0.comp.i32.type=betline&pt.i0.comp.i35.multi=10&pt.i0.comp.i29.type=betline&pt.i0.comp.i4.multi=50&pt.i0.comp.i15.symbol=SYM7&pt.i0.comp.i17.symbol=SYM7&pt.i0.comp.i5.freespins=0&pt.i1.comp.i14.multi=30&pt.i0.comp.i22.multi=6&pt.i0.comp.i23.n=5&pt.i1.comp.i34.multi=5&pt.i1.comp.i19.type=betline&pt.i0.comp.i11.symbol=SYM5&pt.i0.comp.i13.symbol=SYM6&pt.i1.comp.i8.type=betline&pt.i1.comp.i4.n=4&pt.i1.comp.i27.multi=1&pt.i0.comp.i15.multi=5&pt.i1.comp.i27.symbol=SYM11&bl.i0.reelset=ALL&pt.i0.comp.i16.freespins=0&pt.i0.comp.i28.multi=5&pt.i1.comp.i6.freespins=0&pt.i1.comp.i29.symbol=SYM11&pt.i1.comp.i29.freespins=0&pt.i1.comp.i22.n=4&pt.i1.comp.i30.symbol=SYM12&pt.i1.comp.i3.multi=10&pt.i0.comp.i11.n=5&pt.i0.comp.i4.freespins=0&pt.i1.comp.i23.symbol=SYM9&pt.i1.comp.i25.symbol=SYM10&pt.i0.comp.i30.freespins=0&pt.i1.comp.i24.type=betline&pt.i0.comp.i19.n=4&pt.i0.id=basic&pt.i0.comp.i1.type=betline&pt.i0.comp.i34.n=4&pt.i1.comp.i10.type=betline&pt.i0.comp.i34.type=betline&pt.i0.comp.i2.symbol=SYM1&pt.i0.comp.i4.symbol=SYM3&pt.i1.comp.i5.freespins=0&pt.i0.comp.i20.type=betline&pt.i1.comp.i8.symbol=SYM4&pt.i1.comp.i19.n=4&pt.i0.comp.i17.freespins=0&pt.i0.comp.i6.symbol=SYM4&pt.i0.comp.i8.symbol=SYM4&pt.i0.comp.i0.symbol=SYM1&pt.i1.comp.i11.n=5&pt.i1.comp.i34.n=4&pt.i0.comp.i5.n=5&pt.i1.comp.i2.symbol=SYM1&pt.i0.comp.i3.type=betline&pt.i0.comp.i3.freespins=0&pt.i0.comp.i10.multi=15&pt.i1.id=freespin&pt.i1.comp.i19.multi=10&pt.i1.comp.i6.symbol=SYM4&pt.i1.comp.i34.freespins=0&pt.i0.comp.i27.multi=1&pt.i0.comp.i9.multi=7&pt.i0.comp.i22.symbol=SYM9&pt.i0.comp.i26.symbol=SYM10&pt.i1.comp.i19.freespins=0&pt.i1.comp.i34.type=betline&pt.i0.comp.i24.n=3&pt.i0.comp.i14.freespins=0&pt.i0.comp.i21.freespins=0&clientaction=paytable&pt.i1.comp.i35.multi=10&pt.i1.comp.i27.freespins=0&pt.i1.comp.i4.freespins=0&pt.i1.comp.i12.type=betline&pt.i1.comp.i5.n=5&pt.i1.comp.i8.multi=100&pt.i1.comp.i21.symbol=SYM9&pt.i1.comp.i23.n=5&pt.i0.comp.i22.type=betline&pt.i0.comp.i24.freespins=0&pt.i1.comp.i32.symbol=SYM12&pt.i0.comp.i16.multi=10&pt.i0.comp.i21.multi=1&pt.i1.comp.i13.multi=15&pt.i0.comp.i12.n=3&pt.i0.comp.i35.n=5&pt.i0.comp.i13.type=betline&pt.i1.comp.i35.n=5&pt.i1.comp.i9.multi=7&bl.i0.line=0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4%2C0%2F1%2F2%2F3%2F4&pt.i0.comp.i19.type=betline&pt.i0.comp.i6.freespins=0&pt.i1.comp.i2.multi=200&pt.i1.comp.i7.freespins=0&pt.i0.comp.i31.freespins=0&pt.i0.comp.i3.multi=10&pt.i0.comp.i6.n=3&pt.i1.comp.i22.type=betline&pt.i1.comp.i12.n=3&pt.i1.comp.i3.type=betline&pt.i0.comp.i21.n=3&pt.i1.comp.i10.freespins=0&pt.i1.comp.i28.type=betline&pt.i0.comp.i34.symbol=SYM13&pt.i1.comp.i6.n=3&pt.i0.comp.i29.n=5&pt.i1.comp.i31.type=betline&pt.i1.comp.i20.multi=20&pt.i0.comp.i27.freespins=0&pt.i0.comp.i34.freespins=0&pt.i1.comp.i24.n=3&pt.i0.comp.i10.type=betline&pt.i0.comp.i35.freespins=0&pt.i1.comp.i11.symbol=SYM5&pt.i1.comp.i27.type=betline&pt.i1.comp.i2.type=betline&pt.i0.comp.i2.freespins=0&pt.i0.comp.i5.multi=200&pt.i0.comp.i7.n=4&pt.i0.comp.i32.n=5&pt.i1.comp.i1.freespins=0&pt.i0.comp.i11.multi=30&pt.i1.comp.i14.symbol=SYM6&pt.i1.comp.i16.symbol=SYM7&pt.i1.comp.i23.multi=12&pt.i0.comp.i7.type=betline&pt.i1.comp.i4.type=betline&pt.i0.comp.i17.n=5&pt.i1.comp.i18.multi=5&pt.i0.comp.i29.multi=10&pt.i1.comp.i13.n=4&pt.i0.comp.i8.freespins=0&pt.i1.comp.i26.type=betline&pt.i1.comp.i4.multi=50&pt.i0.comp.i8.multi=100&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&pt.i0.comp.i34.multi=5&pt.i0.comp.i1.freespins=0&pt.i0.comp.i12.type=betline&pt.i0.comp.i14.multi=30&pt.i1.comp.i7.multi=25&pt.i0.comp.i22.n=4&pt.i0.comp.i28.symbol=SYM11&pt.i1.comp.i17.type=betline&pt.i1.comp.i11.type=betline&pt.i0.comp.i6.multi=8&pt.i1.comp.i0.symbol=SYM1&playercurrencyiso=' . $slotSettings->slotCurrency . '&pt.i1.comp.i7.n=4&pt.i1.comp.i5.multi=200&pt.i1.comp.i5.symbol=SYM3&pt.i0.comp.i18.type=betline&pt.i0.comp.i23.symbol=SYM9&pt.i0.comp.i21.type=betline&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&pt.i1.comp.i25.n=4&pt.i0.comp.i8.type=betline&pt.i0.comp.i7.freespins=0&pt.i1.comp.i15.multi=5&pt.i0.comp.i2.type=betline&pt.i0.comp.i13.multi=15&pt.i1.comp.i20.type=betline&pt.i0.comp.i17.type=betline&pt.i0.comp.i30.type=betline&pt.i1.comp.i22.symbol=SYM9&pt.i1.comp.i30.freespins=0&pt.i1.comp.i22.multi=6&bl.i0.coins=20&pt.i0.comp.i8.n=5&pt.i0.comp.i10.n=4&pt.i0.comp.i33.n=3&pt.i1.comp.i6.multi=8&pt.i1.comp.i22.freespins=0&pt.i0.comp.i11.type=betline&pt.i1.comp.i19.symbol=SYM8&pt.i1.comp.i35.freespins=0&pt.i0.comp.i18.n=3&pt.i0.comp.i22.freespins=0&pt.i0.comp.i20.symbol=SYM8&pt.i0.comp.i15.freespins=0&pt.i1.comp.i14.n=5&pt.i1.comp.i16.multi=10&pt.i0.comp.i31.symbol=SYM12&pt.i1.comp.i15.freespins=0&pt.i0.comp.i27.type=betline&pt.i1.comp.i28.freespins=0&pt.i0.comp.i28.freespins=0&pt.i0.comp.i0.n=3&pt.i0.comp.i7.symbol=SYM4&pt.i1.comp.i21.multi=1&pt.i1.comp.i30.type=betline&pt.i1.comp.i0.freespins=0&pt.i0.comp.i0.type=betline&pt.i1.comp.i0.multi=10&gameServerVersion=1.21.0&g4mode=false&pt.i1.comp.i8.n=5&pt.i0.comp.i25.multi=6&historybutton=false&pt.i0.comp.i16.symbol=SYM7&pt.i1.comp.i21.freespins=0&pt.i0.comp.i1.multi=50&pt.i0.comp.i27.n=3&pt.i0.comp.i18.symbol=SYM8&pt.i1.comp.i9.type=betline&pt.i0.comp.i12.multi=7&pt.i0.comp.i32.multi=10&pt.i1.comp.i24.multi=1&pt.i1.comp.i14.freespins=0&pt.i1.comp.i23.type=betline&pt.i1.comp.i26.n=5&pt.i0.comp.i12.symbol=SYM6&pt.i0.comp.i14.symbol=SYM6&pt.i1.comp.i13.freespins=0&pt.i1.comp.i28.symbol=SYM11&pt.i0.comp.i14.type=betline&pt.i1.comp.i17.multi=20&pt.i0.comp.i18.multi=5&pt.i1.comp.i0.n=3&pt.i1.comp.i26.symbol=SYM10&pt.i0.comp.i33.type=betline&pt.i1.comp.i31.symbol=SYM12&pt.i0.comp.i7.multi=25&pt.i1.comp.i33.symbol=SYM13&pt.i1.comp.i35.type=betline&pt.i0.comp.i9.n=3&pt.i0.comp.i30.n=3&pt.i1.comp.i21.type=betline&jackpotcurrency=%26%23x20AC%3B&pt.i0.comp.i28.type=betline&pt.i1.comp.i31.multi=5&pt.i1.comp.i18.type=betline&pt.i0.comp.i10.symbol=SYM5&pt.i0.comp.i15.n=3&pt.i0.comp.i21.symbol=SYM9&pt.i0.comp.i31.type=betline&pt.i1.comp.i15.n=3&isJackpotWin=false&pt.i1.comp.i20.freespins=0&pt.i1.comp.i7.type=betline&pt.i1.comp.i11.multi=30&pt.i1.comp.i30.n=3&pt.i0.comp.i1.n=4&pt.i0.comp.i10.freespins=0&pt.i0.comp.i20.multi=20&pt.i0.comp.i20.n=5&pt.i0.comp.i29.symbol=SYM11&pt.i1.comp.i3.symbol=SYM3&pt.i0.comp.i17.multi=20&pt.i1.comp.i23.freespins=0&pt.i1.comp.i25.type=betline&pt.i1.comp.i9.n=3&pt.i0.comp.i25.symbol=SYM10&pt.i0.comp.i26.type=betline&pt.i0.comp.i28.n=4&pt.i0.comp.i9.type=betline&pt.i0.comp.i2.multi=200&pt.i1.comp.i27.n=3&pt.i0.comp.i0.freespins=0&pt.i1.comp.i16.type=betline&pt.i1.comp.i25.multi=6&pt.i0.comp.i33.multi=1&pt.i1.comp.i16.freespins=0&pt.i1.comp.i20.symbol=SYM8&pt.i1.comp.i12.multi=7&pt.i0.comp.i29.freespins=0&pt.i1.comp.i1.n=4&pt.i1.comp.i5.type=betline&pt.i1.comp.i35.symbol=SYM13&pt.i1.comp.i11.freespins=0&pt.i1.comp.i24.symbol=SYM10&pt.i0.comp.i31.n=4&pt.i0.comp.i9.symbol=SYM5&pt.i1.comp.i13.symbol=SYM6&pt.i1.comp.i17.symbol=SYM7&pt.i0.comp.i16.n=4&bl.i0.id=0&pt.i0.comp.i16.type=betline&pt.i1.comp.i16.n=4&pt.i0.comp.i5.symbol=SYM3&pt.i1.comp.i7.symbol=SYM4&pt.i0.comp.i2.n=5&pt.i0.comp.i35.type=betline&pt.i0.comp.i1.symbol=SYM1&pt.i1.comp.i31.n=4&pt.i1.comp.i31.freespins=0&pt.i0.comp.i19.freespins=0&pt.i1.comp.i14.type=betline&pt.i0.comp.i6.type=betline&pt.i1.comp.i9.freespins=0&pt.i1.comp.i2.freespins=0&playercurrency=%26%23x20AC%3B&pt.i0.comp.i35.symbol=SYM13&pt.i1.comp.i25.freespins=0&pt.i0.comp.i33.symbol=SYM13&pt.i1.comp.i30.multi=1&pt.i0.comp.i25.n=4&pt.i1.comp.i10.multi=15&pt.i1.comp.i10.symbol=SYM5&pt.i1.comp.i28.n=4&pt.i1.comp.i32.freespins=0&pt.i0.comp.i9.freespins=0&pt.i1.comp.i2.n=5&pt.i1.comp.i20.n=5&credit=500000&pt.i0.comp.i5.type=betline&pt.i1.comp.i24.freespins=0&pt.i0.comp.i11.freespins=0&pt.i0.comp.i26.multi=12&pt.i0.comp.i25.type=betline&pt.i1.comp.i32.type=betline&pt.i1.comp.i18.symbol=SYM8&pt.i0.comp.i31.multi=5&pt.i1.comp.i12.symbol=SYM6&pt.i0.comp.i4.type=betline&pt.i0.comp.i13.freespins=0&pt.i1.comp.i15.type=betline&pt.i1.comp.i26.freespins=0&pt.i0.comp.i26.freespins=0&pt.i1.comp.i13.type=betline&pt.i1.comp.i1.multi=50&pt.i1.comp.i1.type=betline&pt.i1.comp.i8.freespins=0&pt.i0.comp.i13.n=4&pt.i0.comp.i20.freespins=0&pt.i1.comp.i33.freespins=0&pt.i0.comp.i33.freespins=0&pt.i1.comp.i17.n=5&pt.i0.comp.i23.type=betline&pt.i1.comp.i29.type=betline&pt.i0.comp.i30.symbol=SYM12&pt.i0.comp.i32.symbol=SYM12&pt.i1.comp.i32.n=5&pt.i0.comp.i3.n=3&pt.i1.comp.i17.freespins=0&pt.i1.comp.i26.multi=12&pt.i1.comp.i32.multi=10&pt.i1.comp.i6.type=betline&pt.i1.comp.i0.type=betline&pt.i1.comp.i1.symbol=SYM1&pt.i1.comp.i29.multi=10&pt.i0.comp.i25.freespins=0&pt.i1.comp.i4.symbol=SYM3&pt.i0.comp.i24.symbol=SYM10&pt.i0.comp.i26.n=5&pt.i0.comp.i27.symbol=SYM11&pt.i0.comp.i32.freespins=0&pt.i1.comp.i29.n=5&pt.i0.comp.i23.multi=12&pt.i1.comp.i3.n=3&pt.i0.comp.i30.multi=1&pt.i1.comp.i21.n=3&pt.i1.comp.i34.symbol=SYM13&pt.i1.comp.i28.multi=5&pt.i0.comp.i18.freespins=0&pt.i1.comp.i33.multi=1&pt.i1.comp.i15.symbol=SYM7&pt.i1.comp.i18.freespins=0&pt.i1.comp.i3.freespins=0&pt.i0.comp.i14.n=5&pt.i0.comp.i0.multi=10&pt.i1.comp.i9.symbol=SYM5&pt.i0.comp.i19.multi=10&pt.i0.comp.i3.symbol=SYM3&pt.i0.comp.i24.type=betline&pt.i1.comp.i18.n=3&pt.i1.comp.i33.type=betline&pt.i1.comp.i12.freespins=0&pt.i0.comp.i12.freespins=0&pt.i0.comp.i4.n=4&pt.i1.comp.i10.n=4&pt.i0.comp.i24.multi=1&pt.i1.comp.i33.n=3';
                    break;
                case 'purchasestars':
                    $_obf_0D313B221531172B3C3E060318265C34340E183E090911 = [
                        400, 
                        1000, 
                        2000
                    ];
                    $_obf_0D301D070433223F253C213524152C1914111812370611 = [
                        6, 
                        15, 
                        29.5
                    ];
                    $allbet = $slotSettings->GetGameData($slotSettings->slotId . 'AllBet');
                    $_obf_0D153525342E2B1806012C1308372C23281E132D2C3601 = $_obf_0D313B221531172B3C3E060318265C34340E183E090911[$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['starbuy_amount']];
                    $_obf_0D3E392E18295B3F1F262D3F1D1A3109193E1E293D2711 = $_obf_0D301D070433223F253C213524152C1914111812370611[$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['starbuy_amount']] * $allbet;
                    if( $_obf_0D3E392E18295B3F1F262D3F1D1A3109193E1E293D2711 <= $slotSettings->GetBalance() ) 
                    {
                        $slotSettings->SetBalance(-1 * $_obf_0D3E392E18295B3F1F262D3F1D1A3109193E1E293D2711, 'bet');
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D3E392E18295B3F1F262D3F1D1A3109193E1E293D2711 / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                        $slotSettings->UpdateJackpots($_obf_0D3E392E18295B3F1F262D3F1D1A3109193E1E293D2711);
                    }
                    else
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid balance"}';
                        exit( $response );
                    }
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * $slotSettings->CurrentDenom * 100);
                    $Stars = $slotSettings->GetGameData($slotSettings->slotId . 'Stars');
                    $Stars += $_obf_0D153525342E2B1806012C1308372C23281E132D2C3601;
                    if( $Stars > 2000 ) 
                    {
                        $Stars = 2000;
                    }
                    $_obf_0D061F21062F24022C3131102F0F012D1A072216282F11 = sprintf('%01.2f', $Stars / 20);
                    if( $Stars >= 2000 ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'freespins.betlevel=1&gameServerVersion=1.21.0&g4mode=false&freespins.win.coins=0&playercurrency=%26%23x20AC%3B&stars.unscaled=455&historybutton=false&rs.i0.r.i4.hold=false&next.rs=superFreespin&gamestate.history=basic%2Cstart_freespins&rs.i0.r.i1.syms=SYM13%2CSYM1%2CSYM12%2CSYM10%2CSYM10&game.win.cents=1470&rs.i0.id=freespin&totalwin.coins=0&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&gamestate.current=super_freespin&freespins.initial=0&jackpotcurrency=%26%23x20AC%3B&multiplier=1&last.rs=basic&rs.i0.r.i0.syms=SYM4%2CSYM4%2CSYM5%2CSYM5%2CSYM9&freespins.denomination=5.000&superfreespins.multiplier.increase=0&rs.i0.r.i3.syms=SYM11%2CSYM10%2CSYM10%2CSYM8%2CSYM8&freespins.win.cents=0&freespins.totalwin.coins=0&freespins.total=0&isJackpotWin=false&gamestate.stack=basic%2Csuper_freespin&rs.i0.r.i0.pos=0&freespins.betlines=0&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i0.r.i1.pos=0&game.win.coins=0&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i1.hold=false&freespins.wavecount=1&stars.total=91&freespins.multiplier=1&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=purchasestars&rs.i0.r.i2.hold=false&rs.i0.r.i4.syms=SYM5%2CSYM5%2CSYM13%2CSYM13%2CSYM3&stars.frompositions=2%2C2&rs.i0.r.i2.pos=0&totalwin.cents=1470&gameover=false&rs.i0.r.i0.hold=false&rs.i0.r.i3.pos=0&freespins.left=8&rs.i0.r.i4.pos=0&superfreespins.multiplier.final=1&nextaction=superfreespin&wavecount=1&superfreespins.multiplier.active=1&rs.i0.r.i2.syms=SYM3%2CSYM9%2CSYM9%2CSYM12%2CSYM12&rs.i0.r.i3.hold=false&game.win.amount=14.70&freespins.totalwin.cents=0';
                        $Stars = 0;
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'rs.i0.r.i1.pos=0&legalactions=startfreespins%2Cgamble%2Cpurchasestars&gameServerVersion=1.21.0&g4mode=false&game.win.coins=0&playercurrency=%26%23x20AC%3B&playercurrencyiso=' . $slotSettings->slotCurrency . '&stars.unscaled=5220&historybutton=false&rs.i0.r.i1.hold=false&rs.i0.r.i4.hold=false&next.rs=basic&gamestate.history=basic%2Cstart_freespins&stars.total=' . $Stars . '&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=purchasestars&rs.i0.r.i1.syms=SYM13%2CSYM1%2CSYM12%2CSYM10%2CSYM10&rs.i0.r.i2.hold=false&rs.i0.r.i4.syms=SYM5%2CSYM5%2CSYM13%2CSYM13%2CSYM3&stars.frompositions=3%2C1%2C3%2C2&gamble.chance=' . $_obf_0D061F21062F24022C3131102F0F012D1A072216282F11 . '&game.win.cents=0&rs.i0.r.i2.pos=0&rs.i0.id=freespin&totalwin.coins=0&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=0&gameover=false&gamestate.current=start_freespins&rs.i0.r.i0.hold=false&jackpotcurrency=%26%23x20AC%3B&multiplier=1&rs.i0.r.i3.pos=0&last.rs=basic&rs.i0.r.i4.pos=0&rs.i0.r.i0.syms=SYM4%2CSYM4%2CSYM5%2CSYM5%2CSYM9&rs.i0.r.i3.syms=SYM11%2CSYM10%2CSYM10%2CSYM8%2CSYM8&isJackpotWin=false&gamestate.stack=basic%2Cstart_freespins&nextaction=startfreespins&rs.i0.r.i0.pos=0&wavecount=1&gamesoundurl=&rs.i0.r.i2.syms=SYM3%2CSYM9%2CSYM9%2CSYM12%2CSYM12&rs.i0.r.i3.hold=false&game.win.amount=0';
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'Stars', $Stars);
                    break;
                case 'startfreespins':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'freespins.betlevel=1&freespintype=freespin&gameServerVersion=1.21.0&g4mode=false&game.win.coins=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&freespins.win.coins=0&playercurrency=%26%23x20AC%3B&playercurrencyiso=' . $slotSettings->slotCurrency . '&stars.unscaled=3510&historybutton=false&next.rs=freespin&freespins.wavecount=1&gamestate.history=basic%2Cstart_freespins&stars.total=702&freespins.multiplier=1&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=startfreespins&game.win.cents=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&totalwin.coins=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=425&gameover=false&gamestate.current=freespin&freespins.initial=0&jackpotcurrency=%26%23x20AC%3B&multiplier=1&freespins.left=8&last.rs=basic&freespins.denomination=' . $slotSettings->CurrentDenomination . '&freespins.win.cents=0&freespins.totalwin.coins=0&freespins.total=0&isJackpotWin=false&gamestate.stack=basic%2Cfreespin&nextaction=freespin&wavecount=1&freespins.betlines=0&gamesoundurl=&game.win.amount=4.25&freespins.totalwin.cents=0';
                    break;
                case 'gamble':
                    $_obf_0D17193C1D2D3705160E3C1429402F370B1E280B1A0722 = [];
                    $Stars = $slotSettings->GetGameData($slotSettings->slotId . 'Stars');
                    $_obf_0D061F21062F24022C3131102F0F012D1A072216282F11 = $Stars / 20;
                    for( $i = 1; $i <= 100; $i++ ) 
                    {
                        if( $i < $_obf_0D061F21062F24022C3131102F0F012D1A072216282F11 ) 
                        {
                            $_obf_0D17193C1D2D3705160E3C1429402F370B1E280B1A0722[$i] = 1;
                        }
                        else
                        {
                            $_obf_0D17193C1D2D3705160E3C1429402F370B1E280B1A0722[$i] = 0;
                        }
                    }
                    shuffle($_obf_0D17193C1D2D3705160E3C1429402F370B1E280B1A0722);
                    $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = $_obf_0D17193C1D2D3705160E3C1429402F370B1E280B1A0722[0];
                    if( $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'freespins.betlevel=1&gameServerVersion=1.21.0&g4mode=false&game.win.coins=0&freespins.win.coins=0&playercurrency=%26%23x20AC%3B&playercurrencyiso=' . $slotSettings->slotCurrency . '&stars.unscaled=0&historybutton=false&next.rs=superFreespin&freespins.wavecount=1&gamestate.history=basic%2Cstart_freespins&freespins.multiplier=1&stars.total=0&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=gamble&stars.frompositions=1%2C1&game.win.cents=0&totalwin.coins=0&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=0&gameover=false&gamestate.current=super_freespin&freespins.initial=0&jackpotcurrency=%26%23x20AC%3B&multiplier=1&freespins.left=8&last.rs=basic&freespins.denomination=5.000&superfreespins.multiplier.increase=0&superfreespins.multiplier.final=1&freespins.win.cents=0&freespins.totalwin.coins=0&freespins.total=0&isJackpotWin=false&gamestate.stack=basic%2Csuper_freespin&nextaction=superfreespin&wavecount=1&freespins.betlines=0&superfreespins.multiplier.active=1&gamesoundurl=&gamble.win=true&game.win.amount=0&freespins.totalwin.cents=0';
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'freespins.betlevel=1&gameServerVersion=1.21.0&g4mode=false&game.win.coins=0&freespins.win.coins=0&playercurrency=%26%23x20AC%3B&playercurrencyiso=' . $slotSettings->slotCurrency . '&stars.unscaled=0&historybutton=false&next.rs=freespin&freespins.wavecount=1&gamestate.history=basic%2Cstart_freespins&freespins.multiplier=1&stars.total=0&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=gamble&stars.frompositions=3%2C1%2C3%2C2&game.win.cents=0&totalwin.coins=0&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=0&gameover=false&gamestate.current=freespin&freespins.initial=0&jackpotcurrency=%26%23x20AC%3B&multiplier=1&freespins.left=8&last.rs=basic&freespins.denomination=5.000&freespins.win.cents=0&freespins.totalwin.coins=0&freespins.total=0&isJackpotWin=false&gamestate.stack=basic%2Cfreespin&nextaction=freespin&wavecount=1&freespins.betlines=0&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&gamble.win=false&game.win.amount=0&freespins.totalwin.cents=0';
                    }
                    $Stars = 0;
                    $slotSettings->SetGameData($slotSettings->slotId . 'Stars', $Stars);
                    break;
                case 'initfreespin':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'rs.i4.id=freespin3&rs.i2.r.i1.hold=false&rs.i1.r.i0.syms=SYM11%2CSYM11%2CSYM12&gameServerVersion=1.21.0&g4mode=false&freespins.win.coins=0&historybutton=false&rs.i0.r.i4.hold=false&next.rs=freespin&gamestate.history=basic%2Cstart_freespins&rs.i1.r.i2.hold=false&rs.i1.r.i3.pos=3&rs.i0.r.i1.syms=SYM13%2CSYM1%2CSYM12%2CSYM10%2CSYM10&rs.i2.r.i1.pos=0&game.win.cents=550&rs.i4.r.i4.pos=0&rs.i1.r.i3.hold=false&totalwin.coins=110&rs.i5.r.i4.syms=SYM3%2CSYM3%2CSYM5&gamestate.current=freespin&freespins.initial=0&rs.i4.r.i0.pos=0&jackpotcurrency=%26%23x20AC%3B&bet.betlines=0&rs.i3.r.i1.hold=false&rs.i2.r.i0.hold=false&rs.i0.r.i0.syms=SYM4%2CSYM4%2CSYM5%2CSYM5%2CSYM9&rs.i0.r.i3.syms=SYM11%2CSYM10%2CSYM10%2CSYM8%2CSYM8&rs.i1.r.i1.syms=SYM12%2CSYM12%2CSYM8&rs.i1.r.i1.pos=42&rs.i3.r.i4.pos=0&freespins.win.cents=0&rs.i6.r.i3.syms=SYM12%2CSYM12%2CSYM4%2CSYM11%2CSYM10&isJackpotWin=false&rs.i6.r.i4.hold=false&rs.i0.r.i0.pos=0&rs.i2.r.i3.hold=false&rs.i2.r.i3.pos=0&freespins.betlines=0&rs.i5.r.i0.pos=50&rs.i0.r.i1.pos=0&rs.i4.r.i4.syms=SYM12%2CSYM9%2CSYM5%2CSYM6%2CSYM11&rs.i1.r.i3.syms=SYM13%2CSYM3%2CSYM3&rs.i2.r.i4.hold=false&rs.i3.r.i1.pos=0&rs.i2.id=freespin2&rs.i6.r.i1.pos=0&game.win.coins=110&rs.i1.r.i0.hold=false&rs.i0.r.i1.hold=false&rs.i2.r.i1.syms=SYM13%2CSYM4%2CSYM6%2CSYM13%2CSYM13&clientaction=initfreespin&rs.i4.r.i0.hold=false&rs.i0.r.i2.hold=false&rs.i4.r.i3.syms=SYM12%2CSYM12%2CSYM4%2CSYM11%2CSYM10&rs.i3.r.i2.hold=false&rs.i6.r.i2.syms=SYM5%2CSYM11%2CSYM9%2CSYM7%2CSYM8&gameover=false&rs.i3.r.i3.pos=0&rs.i5.id=basic&rs.i5.r.i1.syms=SYM6%2CSYM6%2CSYM10%2CSYM10%2CSYM1&rs.i0.r.i3.pos=0&rs.i6.r.i4.pos=0&rs.i5.r.i1.hold=false&rs.i4.r.i0.syms=SYM6%2CSYM7%2CSYM3%2CSYM5%2CSYM5&rs.i5.r.i4.hold=false&rs.i6.r.i2.hold=false&rs.i5.r.i3.pos=58&nextaction=freespin&rs.i4.r.i2.pos=0&rs.i0.r.i2.syms=SYM3%2CSYM9%2CSYM9%2CSYM12%2CSYM12&game.win.amount=5.50&freespins.totalwin.cents=0&rs.i5.r.i2.hold=false&freespins.betlevel=1&rs.i4.r.i3.pos=0&playercurrency=%26%23x20AC%3B&rs.i2.r.i0.pos=0&rs.i4.r.i4.hold=false&rs.i5.r.i0.syms=SYM12%2CSYM12%2CSYM8%2CSYM8%2CSYM4&rs.i2.r.i4.syms=SYM12%2CSYM9%2CSYM5%2CSYM6%2CSYM11&rs.i3.r.i2.syms=SYM5%2CSYM11%2CSYM9%2CSYM7%2CSYM8&rs.i4.r.i3.hold=false&rs.i6.r.i0.hold=false&rs.i0.id=freespin&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&rs.i1.r.i4.pos=46&rs.i3.id=superFreespin2&multiplier=1&rs.i2.r.i2.pos=0&last.rs=basic&freespins.denomination=5.000&rs.i5.r.i1.pos=19&rs.i6.r.i0.syms=SYM6%2CSYM7%2CSYM3%2CSYM5%2CSYM5&freespins.totalwin.coins=0&freespins.total=0&gamestate.stack=basic%2Cfreespin&rs.i6.r.i2.pos=0&rs.i1.r.i4.syms=SYM12%2CSYM10%2CSYM10&rs.i6.r.i1.hold=false&rs.i2.r.i2.syms=SYM5%2CSYM11%2CSYM9%2CSYM7%2CSYM8&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i1.r.i2.pos=35&rs.i5.r.i2.syms=SYM1%2CSYM3%2CSYM3%2CSYM9%2CSYM9&rs.i3.r.i3.syms=SYM12%2CSYM12%2CSYM4%2CSYM11%2CSYM10&rs.i5.r.i3.hold=false&bet.betlevel=1&rs.i3.r.i4.hold=false&rs.i4.r.i2.hold=false&rs.i5.r.i0.hold=false&rs.i4.r.i1.syms=SYM13%2CSYM4%2CSYM6%2CSYM13%2CSYM13&rs.i2.r.i4.pos=0&rs.i3.r.i0.syms=SYM6%2CSYM7%2CSYM3%2CSYM5%2CSYM5&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i4.r.i1.hold=false&rs.i6.r.i1.syms=SYM13%2CSYM4%2CSYM6%2CSYM13%2CSYM13&freespins.wavecount=1&rs.i3.r.i2.pos=0&rs.i3.r.i3.hold=false&freespins.multiplier=1&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i6.r.i0.pos=0&rs.i0.r.i4.syms=SYM5%2CSYM5%2CSYM13%2CSYM13%2CSYM3&rs.i0.r.i2.pos=0&rs.i1.r.i2.syms=SYM13%2CSYM13%2CSYM10%2CSYM10%2CSYM1&rs.i6.r.i3.pos=0&rs.i1.r.i0.pos=40&rs.i6.id=superFreespin&totalwin.cents=550&rs.i6.r.i3.hold=false&rs.i2.r.i0.syms=SYM6%2CSYM7%2CSYM3%2CSYM5%2CSYM5&rs.i5.r.i2.pos=51&rs.i0.r.i0.hold=false&rs.i2.r.i3.syms=SYM12%2CSYM12%2CSYM4%2CSYM11%2CSYM10&rs.i1.id=basic2&rs.i3.r.i4.syms=SYM12%2CSYM9%2CSYM5%2CSYM6%2CSYM11&rs.i3.r.i1.syms=SYM13%2CSYM4%2CSYM6%2CSYM13%2CSYM13&rs.i1.r.i4.hold=false&freespins.left=8&rs.i0.r.i4.pos=0&rs.i4.r.i1.pos=0&rs.i4.r.i2.syms=SYM5%2CSYM11%2CSYM9%2CSYM7%2CSYM8&rs.i3.r.i0.pos=0&rs.i5.r.i3.syms=SYM4%2CSYM4%2CSYM10%2CSYM10%2CSYM9&rs.i3.r.i0.hold=false&rs.i2.r.i2.hold=false&wavecount=1&rs.i6.r.i4.syms=SYM12%2CSYM9%2CSYM5%2CSYM6%2CSYM11&rs.i1.r.i1.hold=false&rs.i0.r.i3.hold=false&bet.denomination=5&rs.i5.r.i4.pos=4';
                    break;
                case 'spin':
                    $lines = 20;
                    $slotSettings->CurrentDenom = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                    $slotSettings->CurrentDenomination = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'respin' ) 
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
                        $slotSettings->SetGameData($slotSettings->slotId . 'SuperMpl', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinId', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $betline);
                        $slotSettings->SetGameData($slotSettings->slotId . 'AllBet', $allbet);
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
                        $Stars = $slotSettings->GetGameData($slotSettings->slotId . 'Stars');
                        $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '';
                        $_obf_0D1428265C2A37251532080A230A10155C332837291332 = [
                            'BreakOpen', 
                            'None', 
                            'None', 
                            'None', 
                            'None', 
                            'None', 
                            'None', 
                            'SymbolUpgrade', 
                            'None', 
                            'None', 
                            'None', 
                            'ManyBonusStars', 
                            'None', 
                            'None', 
                            'None', 
                            'None', 
                            'SymbolMultiplier', 
                            'None', 
                            'None', 
                            'None', 
                            'None', 
                            'RandomWilds', 
                            'SecondChance'
                        ];
                        shuffle($_obf_0D1428265C2A37251532080A230A10155C332837291332);
                        $_obf_0D3701073B5B3D143815252D1B391F300233260B131A01 = [
                            $_obf_0D1428265C2A37251532080A230A10155C332837291332[0], 
                            $_obf_0D1428265C2A37251532080A230A10155C332837291332[1], 
                            $_obf_0D1428265C2A37251532080A230A10155C332837291332[2]
                        ];
                        $_obf_0D110528172737262407252C305B0A22243B0910282D32 = 0;
                        if( $winType == 'bonus' ) 
                        {
                            $_obf_0D3701073B5B3D143815252D1B391F300233260B131A01 = [
                                'BreakOpen', 
                                'None', 
                                'None'
                            ];
                        }
                        if( in_array('SymbolUpgrade', $_obf_0D3701073B5B3D143815252D1B391F300233260B131A01) ) 
                        {
                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = $slotSettings->SymbolUpgrade($reels, $_obf_0D110528172737262407252C305B0A22243B0910282D32);
                            $_obf_0D110528172737262407252C305B0A22243B0910282D32++;
                        }
                        $_obf_0D0A28212E2A212140192E3F291C1A2A063D2416090632 = 1;
                        $_obf_0D391D40352D5C1E2B1A5B1F042E130439271B01402211 = -1;
                        if( in_array('SymbolMultiplier', $_obf_0D3701073B5B3D143815252D1B391F300233260B131A01) ) 
                        {
                            $_obf_0D2D0323323F2A352C0B3E230C2B4035140F2B341D3B11 = [
                                5, 
                                10, 
                                15, 
                                20
                            ];
                            shuffle($_obf_0D2D0323323F2A352C0B3E230C2B4035140F2B341D3B11);
                            $_obf_0D0A28212E2A212140192E3F291C1A2A063D2416090632 = $_obf_0D2D0323323F2A352C0B3E230C2B4035140F2B341D3B11[0];
                            $_obf_0D391D40352D5C1E2B1A5B1F042E130439271B01402211 = rand(3, 13);
                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '&features.i' . $_obf_0D110528172737262407252C305B0A22243B0910282D32 . '.data.sym=SYM' . $_obf_0D391D40352D5C1E2B1A5B1F042E130439271B01402211 . '&features.i' . $_obf_0D110528172737262407252C305B0A22243B0910282D32 . '.data.multiplier=' . $_obf_0D0A28212E2A212140192E3F291C1A2A063D2416090632 . '&features.i' . $_obf_0D110528172737262407252C305B0A22243B0910282D32 . '.type=SymbolMultiplier';
                            $_obf_0D110528172737262407252C305B0A22243B0910282D32++;
                        }
                        if( in_array('ManyBonusStars', $_obf_0D3701073B5B3D143815252D1B391F300233260B131A01) ) 
                        {
                            $_obf_0D2D0323323F2A352C0B3E230C2B4035140F2B341D3B11 = [
                                3, 
                                15
                            ];
                            shuffle($_obf_0D2D0323323F2A352C0B3E230C2B4035140F2B341D3B11);
                            $_obf_0D3E2D01152C10280826125C1215102B3D332121082F32 = 'ManyBonusStars';
                            if( $_obf_0D2D0323323F2A352C0B3E230C2B4035140F2B341D3B11[0] == 3 ) 
                            {
                                $_obf_0D3E2D01152C10280826125C1215102B3D332121082F32 = 'FewBonusStars';
                            }
                            $_obf_0D2C331736361B101B013C37090E12120D111531123132 = $_obf_0D2D0323323F2A352C0B3E230C2B4035140F2B341D3B11[0];
                            $Stars += $_obf_0D2C331736361B101B013C37090E12120D111531123132;
                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '&features.i' . $_obf_0D110528172737262407252C305B0A22243B0910282D32 . '.type=' . $_obf_0D3E2D01152C10280826125C1215102B3D332121082F32 . '&features.i' . $_obf_0D110528172737262407252C305B0A22243B0910282D32 . '.data.stars=' . $_obf_0D2C331736361B101B013C37090E12120D111531123132;
                            $_obf_0D110528172737262407252C305B0A22243B0910282D32++;
                        }
                        if( in_array('RandomWilds', $_obf_0D3701073B5B3D143815252D1B391F300233260B131A01) ) 
                        {
                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = $slotSettings->RandomWilds($reels, $_obf_0D110528172737262407252C305B0A22243B0910282D32);
                            $_obf_0D110528172737262407252C305B0A22243B0910282D32++;
                        }
                        $SecondChance = false;
                        if( in_array('SecondChance', $_obf_0D3701073B5B3D143815252D1B391F300233260B131A01) && $winType == 'none' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                        {
                            $SecondChance = true;
                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '&features.i' . $_obf_0D110528172737262407252C305B0A22243B0910282D32 . '.type=SecondChance&features.i' . $_obf_0D110528172737262407252C305B0A22243B0910282D32 . '.data.active=true';
                            $_obf_0D110528172737262407252C305B0A22243B0910282D32++;
                        }
                        $BreakOpen = false;
                        $_obf_0D0E5C1E022D1A3633223C2A14171C3B3C282C11182701 = 2;
                        if( in_array('BreakOpen', $_obf_0D3701073B5B3D143815252D1B391F300233260B131A01) && $slotSettings->GetGameData($slotSettings->slotId . 'RespinId') == 0 ) 
                        {
                            $BreakOpen = true;
                            if( $winType == 'bonus' ) 
                            {
                                $_obf_0D0E5C1E022D1A3633223C2A14171C3B3C282C11182701 = 12;
                            }
                            $_obf_0D385C2A0A0C1701220D1F38211D33121C2B0B22351522 = [
                                0, 
                                2, 
                                4, 
                                6, 
                                8, 
                                10, 
                                12, 
                                10, 
                                10, 
                                10
                            ];
                            $_obf_0D091E370F322130252A173E032B2708093D3B5C142401 = $_obf_0D385C2A0A0C1701220D1F38211D33121C2B0B22351522[$slotSettings->GetGameData($slotSettings->slotId . 'RespinId') + 1];
                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '&features.i' . $_obf_0D110528172737262407252C305B0A22243B0910282D32 . '.type=BreakOpen&features.i' . $_obf_0D110528172737262407252C305B0A22243B0910282D32 . '.data.count=' . $_obf_0D0E5C1E022D1A3633223C2A14171C3B3C282C11182701;
                            $_obf_0D110528172737262407252C305B0A22243B0910282D32++;
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
                                $RespinId = $slotSettings->GetGameData($slotSettings->slotId . 'RespinId');
                                if( $BreakOpen ) 
                                {
                                    $RespinId = $RespinId + 1;
                                }
                                if( $RespinId > 5 ) 
                                {
                                    $RespinId = 5;
                                }
                                $_obf_0D1B1910172D03132D040D301C2A39140C2F0A265C1532 = [];
                                $_obf_0D1B1910172D03132D040D301C2A39140C2F0A265C1532[0] = [
                                    [2], 
                                    [
                                        1, 
                                        2, 
                                        3
                                    ], 
                                    [
                                        0, 
                                        1, 
                                        2, 
                                        3, 
                                        4
                                    ], 
                                    [
                                        1, 
                                        2, 
                                        3
                                    ], 
                                    [2]
                                ];
                                $_obf_0D1B1910172D03132D040D301C2A39140C2F0A265C1532[1] = [
                                    [
                                        1, 
                                        2, 
                                        3
                                    ], 
                                    [
                                        1, 
                                        2, 
                                        3
                                    ], 
                                    [
                                        0, 
                                        1, 
                                        2, 
                                        3, 
                                        4
                                    ], 
                                    [
                                        1, 
                                        2, 
                                        3
                                    ], 
                                    [2]
                                ];
                                $_obf_0D1B1910172D03132D040D301C2A39140C2F0A265C1532[2] = [
                                    [
                                        1, 
                                        2, 
                                        3
                                    ], 
                                    [
                                        1, 
                                        2, 
                                        3
                                    ], 
                                    [
                                        0, 
                                        1, 
                                        2, 
                                        3, 
                                        4
                                    ], 
                                    [
                                        1, 
                                        2, 
                                        3
                                    ], 
                                    [
                                        1, 
                                        2, 
                                        3
                                    ]
                                ];
                                $_obf_0D1B1910172D03132D040D301C2A39140C2F0A265C1532[3] = [
                                    [
                                        1, 
                                        2, 
                                        3
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
                                        1, 
                                        2, 
                                        3
                                    ]
                                ];
                                $_obf_0D1B1910172D03132D040D301C2A39140C2F0A265C1532[4] = [
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
                                        1, 
                                        2, 
                                        3
                                    ]
                                ];
                                $_obf_0D1B1910172D03132D040D301C2A39140C2F0A265C1532[5] = [
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
                                $_obf_0D03192821275B1E1B065C1D15161730081D1828362C01 = [
                                    0, 
                                    1, 
                                    2, 
                                    3, 
                                    4
                                ];
                                $_obf_0D16295B0631330A30050125140F2F031F04241C020932 = 0;
                                $_obf_0D1230320334185B26283108160B1D222D13060D3F0B32 = 1;
                                $_obf_0D1C011B1E170C5B1C082C1A3D22273F2B383F280F2D22 = 0;
                                if( $_obf_0D391D40352D5C1E2B1A5B1F042E130439271B01402211 == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 ) 
                                {
                                    $_obf_0D1230320334185B26283108160B1D222D13060D3F0B32 = $_obf_0D0A28212E2A212140192E3F291C1A2A063D2416090632;
                                }
                                for( $_obf_0D073D210B3816042B161A052B070A16343833352A3811 = 1; $_obf_0D073D210B3816042B161A052B070A16343833352A3811 <= 5; $_obf_0D073D210B3816042B161A052B070A16343833352A3811++ ) 
                                {
                                    $_obf_0D132B1D2C0F0C3E2F162519391315113F101B36321D11 = $_obf_0D1B1910172D03132D040D301C2A39140C2F0A265C1532[$RespinId][$_obf_0D073D210B3816042B161A052B070A16343833352A3811 - 1];
                                    foreach( $_obf_0D132B1D2C0F0C3E2F162519391315113F101B36321D11 as $_obf_0D23380E1614211739222C1D1F0E161A222C31213E0932 => $_obf_0D27030E2310033F5B2C0B251C211D1D2E17343C160701 ) 
                                    {
                                        if( $reels['reel' . $_obf_0D073D210B3816042B161A052B070A16343833352A3811][$_obf_0D27030E2310033F5B2C0B251C211D1D2E17343C160701] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $reels['reel' . $_obf_0D073D210B3816042B161A052B070A16343833352A3811][$_obf_0D27030E2310033F5B2C0B251C211D1D2E17343C160701] == $wild ) 
                                        {
                                            $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[$_obf_0D073D210B3816042B161A052B070A16343833352A3811]++;
                                            $_obf_0D1C111B2432372F281601011A12053E03290318142222[] = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i' . $_obf_0D1C011B1E170C5B1C082C1A3D22273F2B383F280F2D22 . '=' . ($_obf_0D073D210B3816042B161A052B070A16343833352A3811 - 1) . '%2C' . $_obf_0D23380E1614211739222C1D1F0E161A222C31213E0932;
                                            $_obf_0D1C011B1E170C5B1C082C1A3D22273F2B383F280F2D22++;
                                        }
                                    }
                                    if( $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[$_obf_0D073D210B3816042B161A052B070A16343833352A3811] <= 0 ) 
                                    {
                                        break;
                                    }
                                    $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 = $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[$_obf_0D073D210B3816042B161A052B070A16343833352A3811] * $_obf_0D352E0A230A18250933393D19150E1B3528100D381911;
                                }
                                $_obf_0D0F19010D31151A1B052703111B3D240C08130D092832 = 'basic';
                                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['freeMode'] == 'superfreespin' ) 
                                {
                                    $_obf_0D0F19010D31151A1B052703111B3D240C08130D092832 = 'superFreespin';
                                }
                                if( $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[1] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[2] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[3] > 0 ) 
                                {
                                    $cWins[$j] = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $betline * $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 * $bonusMpl * $_obf_0D1230320334185B26283108160B1D222D13060D3F0B32;
                                    $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=' . $_obf_0D0F19010D31151A1B052703111B3D240C08130D092832 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $cWins[$j] . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=0&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($cWins[$j] * $slotSettings->CurrentDenomination * 100) . '' . implode('', $_obf_0D1C111B2432372F281601011A12053E03290318142222);
                                }
                                if( $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[1] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[2] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[3] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[4] > 0 ) 
                                {
                                    $cWins[$j] = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $betline * $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 * $bonusMpl * $_obf_0D1230320334185B26283108160B1D222D13060D3F0B32;
                                    $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=' . $_obf_0D0F19010D31151A1B052703111B3D240C08130D092832 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $cWins[$j] . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=0&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($cWins[$j] * $slotSettings->CurrentDenomination * 100) . '' . implode('', $_obf_0D1C111B2432372F281601011A12053E03290318142222);
                                }
                                if( $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[1] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[2] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[3] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[4] > 0 && $_obf_0D312C2F082D1F092B291E06295C0306341718180E2D22[5] > 0 ) 
                                {
                                    $cWins[$j] = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $betline * $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 * $bonusMpl * $_obf_0D1230320334185B26283108160B1D222D13060D3F0B32;
                                    $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=' . $_obf_0D0F19010D31151A1B052703111B3D240C08130D092832 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $cWins[$j] . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=0&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($cWins[$j] * $slotSettings->CurrentDenomination * 100) . '' . implode('', $_obf_0D1C111B2432372F281601011A12053E03290318142222);
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
                        $spinWin = $totalWin;
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
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                        $slotSettings->SetBalance($totalWin);
                    }
                    $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                    $reels = $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01;
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = ' &rs.i0.r.i0.syms=SYM' . $reels['reel1'][0] . '%2CSYM' . $reels['reel1'][1] . '%2CSYM' . $reels['reel1'][2] . '%2CSYM' . $reels['reel1'][3] . '%2CSYM' . $reels['reel1'][4] . '';
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.syms=SYM' . $reels['reel2'][0] . '%2CSYM' . $reels['reel2'][1] . '%2CSYM' . $reels['reel2'][2] . '%2CSYM' . $reels['reel2'][3] . '%2CSYM' . $reels['reel2'][4] . '');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.syms=SYM' . $reels['reel3'][0] . '%2CSYM' . $reels['reel3'][1] . '%2CSYM' . $reels['reel3'][2] . '%2CSYM' . $reels['reel3'][3] . '%2CSYM' . $reels['reel3'][4] . '');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.syms=SYM' . $reels['reel4'][0] . '%2CSYM' . $reels['reel4'][1] . '%2CSYM' . $reels['reel4'][2] . '%2CSYM' . $reels['reel4'][3] . '%2CSYM' . $reels['reel4'][4] . '');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.syms=SYM' . $reels['reel5'][0] . '%2CSYM' . $reels['reel5'][1] . '%2CSYM' . $reels['reel5'][2] . '%2CSYM' . $reels['reel5'][3] . '%2CSYM' . $reels['reel5'][4] . '');
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
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode('', $lineWins);
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                    $slotSettings->SetGameData($slotSettings->slotId . 'GambleStep', 5);
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = $slotSettings->GetGameData($slotSettings->slotId . 'Cards');
                    $_obf_0D2D1F17141D3509383B2328141A060130300A0A242A11 = 'false';
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D091E370F322130252A173E032B2708093D3B5C142401 = 12;
                        $_obf_0D10172912330D143328112D073F1F01232A2702082111 = 0;
                    }
                    else if( $SecondChance ) 
                    {
                        $state = 'gamble';
                        $_obf_0D2504370B381725111D5B2E380422185B2F4010370D22 = 'false';
                        $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'respin';
                        $_obf_0D2504370B381725111D5B2E380422185B2F4010370D22 = 'true';
                        if( $BreakOpen ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'RespinId', $slotSettings->GetGameData($slotSettings->slotId . 'RespinId') + 1);
                        }
                        $_obf_0D385C2A0A0C1701220D1F38211D33121C2B0B22351522 = [
                            0, 
                            2, 
                            4, 
                            6, 
                            8, 
                            10, 
                            12, 
                            10, 
                            10, 
                            10
                        ];
                        $_obf_0D091E370F322130252A173E032B2708093D3B5C142401 = $_obf_0D385C2A0A0C1701220D1F38211D33121C2B0B22351522[$slotSettings->GetGameData($slotSettings->slotId . 'RespinId')];
                        $_obf_0D10172912330D143328112D073F1F01232A2702082111 = $_obf_0D385C2A0A0C1701220D1F38211D33121C2B0B22351522[$slotSettings->GetGameData($slotSettings->slotId . 'RespinId')];
                    }
                    else if( $totalWin > 0 ) 
                    {
                        $state = 'gamble';
                        $_obf_0D2504370B381725111D5B2E380422185B2F4010370D22 = 'false';
                        $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'respin';
                        $_obf_0D2504370B381725111D5B2E380422185B2F4010370D22 = 'true';
                        if( $BreakOpen ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'RespinId', $slotSettings->GetGameData($slotSettings->slotId . 'RespinId') + 1);
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinId', $slotSettings->GetGameData($slotSettings->slotId . 'RespinId') + 1);
                        $_obf_0D385C2A0A0C1701220D1F38211D33121C2B0B22351522 = [
                            0, 
                            2, 
                            4, 
                            6, 
                            8, 
                            10, 
                            12, 
                            10, 
                            10, 
                            10
                        ];
                        $_obf_0D091E370F322130252A173E032B2708093D3B5C142401 = $_obf_0D385C2A0A0C1701220D1F38211D33121C2B0B22351522[$slotSettings->GetGameData($slotSettings->slotId . 'RespinId')];
                        $_obf_0D10172912330D143328112D073F1F01232A2702082111 = $_obf_0D385C2A0A0C1701220D1F38211D33121C2B0B22351522[$slotSettings->GetGameData($slotSettings->slotId . 'RespinId')];
                    }
                    else
                    {
                        if( $BreakOpen ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'RespinId', $slotSettings->GetGameData($slotSettings->slotId . 'RespinId') + 1);
                        }
                        $_obf_0D385C2A0A0C1701220D1F38211D33121C2B0B22351522 = [
                            0, 
                            2, 
                            4, 
                            6, 
                            8, 
                            10, 
                            12, 
                            10, 
                            10, 
                            10
                        ];
                        $_obf_0D091E370F322130252A173E032B2708093D3B5C142401 = $_obf_0D385C2A0A0C1701220D1F38211D33121C2B0B22351522[$slotSettings->GetGameData($slotSettings->slotId . 'RespinId')];
                        $_obf_0D10172912330D143328112D073F1F01232A2702082111 = 0;
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinId', 0);
                        $state = 'idle';
                        $_obf_0D2504370B381725111D5B2E380422185B2F4010370D22 = 'true';
                        $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'spin';
                    }
                    $_obf_0D2504370B381725111D5B2E380422185B2F4010370D22 = 'true';
                    if( $_obf_0D0E5C1E022D1A3633223C2A14171C3B3C282C11182701 == 12 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinId', 5);
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'RespinId') >= 5 && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 8);
                        $_obf_0D10172912330D143328112D073F1F01232A2702082111 = 0;
                        $_obf_0D091E370F322130252A173E032B2708093D3B5C142401 = 0;
                        $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $freeState = '&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19&freespins.totalwin.cents=0&freespins.left=' . $fs . '&freespins.wavecount=1&freespins.multiplier=1&gamestate.stack=basic%2Cstart_freespins&freespins.totalwin.coins=0&freespins.total=' . $fs . '&freespins.win.cents=0&gamestate.current=start_freespins&freespins.initial=' . $fs . '&freespins.win.coins=0&legalactions=startfreespins%2Cgamble&freespins.betlevel=' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet') . '&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&nextaction=startfreespins&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= $freeState;
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $totalWin = $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
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
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['freeMode'] == 'superfreespin' ) 
                            {
                                $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 = 'super_freespin';
                                $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'superfreespin';
                                $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 = 'basic%2Cfreespin';
                                $_obf_0D290510262A13373218051031062E401B080E0E271E01 = 'superFreespin';
                            }
                        }
                        $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $freeState = '&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19&freespins.totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&nextaction=' . $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 . '&freespins.left=' . $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 . '&freespins.wavecount=1&freespins.multiplier=1&gamestate.stack=' . $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 . '&freespins.totalwin.coins=' . $totalWin . '&freespins.total=' . $fs . '&freespins.win.cents=' . ($totalWin / $slotSettings->CurrentDenomination * 100) . '&gamestate.current=' . $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 . '&freespins.initial=' . $fs . '&freespins.win.coins=' . $totalWin . '&freespins.betlevel=' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet') . '&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '&next.rs=' . $_obf_0D290510262A13373218051031062E401B080E0E271E01;
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= $freeState;
                    }
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"freeState":"' . $freeState . '","slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'respin' ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'BG2';
                    }
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Stars', $Stars);
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * $slotSettings->CurrentDenom * 100);
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['freeMode'] == 'superfreespin' ) 
                    {
                        $totalWin = $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                        $_obf_0D3E31350F3C12172E363E14040408242C2E272B333E32 = $slotSettings->GetGameData($slotSettings->slotId . 'SuperMpl');
                        $_obf_0D1B03192A18213E03322D06371013302B0F2C3F3F2201 = $slotSettings->GetGameData($slotSettings->slotId . 'SuperMpl');
                        $_obf_0D2C32330B23155C075C5C162F40222D250B22153C2201 = 0;
                        if( $spinWin > 0 ) 
                        {
                            $_obf_0D2C32330B23155C075C5C162F40222D250B22153C2201 = 1;
                            $_obf_0D1B03192A18213E03322D06371013302B0F2C3F3F2201 += 1;
                            $slotSettings->SetGameData($slotSettings->slotId . 'SuperMpl', $_obf_0D1B03192A18213E03322D06371013302B0F2C3F3F2201);
                        }
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') ) 
                        {
                            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'freespins.betlevel=1&gameServerVersion=1.21.0&g4mode=false&freespins.win.coins=' . $totalWin . '&playercurrency=%26%23x20AC%3B&stars.unscaled=' . $Stars . '&historybutton=false&rs.i0.r.i4.hold=false&next.rs=basic&gamestate.history=basic%2Cstart_freespins%2Csuper_freespin&rs.i0.r.i1.syms=SYM4%2CSYM4%2CSYM8%2CSYM8%2CSYM12&game.win.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.id=freespin2&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&gamestate.current=basic&freespins.initial=0&features.i2.type=None&jackpotcurrency=%26%23x20AC%3B&multiplier=1&last.rs=superFreespin&rs.i0.r.i0.syms=SYM6%2CSYM11%2CSYM11%2CSYM9%2CSYM9&freespins.denomination=' . $slotSettings->CurrentDenomination . '&superfreespins.multiplier.increase=' . $_obf_0D2C32330B23155C075C5C162F40222D250B22153C2201 . '&rs.i0.r.i3.syms=SYM10%2CSYM10%2CSYM11%2CSYM11%2CSYM12&openedpositions.total=12&freespins.win.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&freespins.totalwin.coins=' . $totalWin . '&freespins.total=0&isJackpotWin=false&gamestate.stack=basic&rs.i0.r.i0.pos=13&freespins.betlines=0&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i0.r.i1.pos=18&game.win.coins=' . $totalWin . '&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i1.hold=false&freespins.wavecount=1&freespins.multiplier=1&stars.total=' . $Stars . '&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=superfreespin&openedpositions.thisspin=0&rs.i0.r.i2.hold=false&rs.i0.r.i4.syms=SYM7%2CSYM13%2CSYM13%2CSYM12%2CSYM12&features.i0.type=None&rs.i0.r.i2.pos=16&features.i1.type=None&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&gameover=true&rs.i0.r.i0.hold=false&rs.i0.r.i3.pos=18&freespins.left=0&rs.i0.r.i4.pos=42&superfreespins.multiplier.final=' . $_obf_0D1B03192A18213E03322D06371013302B0F2C3F3F2201 . '&nextaction=spin&wavecount=1&superfreespins.multiplier.active=' . $_obf_0D3E31350F3C12172E363E14040408242C2E272B333E32 . '&rs.i0.r.i2.syms=SYM11%2CSYM9%2CSYM9%2CSYM10%2CSYM10&rs.i0.r.i3.hold=false&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '&freespins.totalwin.cents=' . ($totalWin / $slotSettings->CurrentDenomination * 100) . '' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101;
                        }
                        else
                        {
                            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'freespins.betlevel=1&gameServerVersion=1.21.0&g4mode=false&freespins.win.coins=' . $totalWin . '&playercurrency=%26%23x20AC%3B&stars.unscaled=' . $Stars . '&historybutton=false&rs.i0.r.i4.hold=false&next.rs=superFreespin&gamestate.history=basic%2Cstart_freespins%2Csuper_freespin&rs.i0.r.i1.syms=SYM10%2CSYM6%2CSYM6%2CSYM10%2CSYM10&game.win.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.id=freespin2&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&gamestate.current=super_freespin&freespins.initial=0&features.i2.type=None&jackpotcurrency=%26%23x20AC%3B&multiplier=1&last.rs=superFreespin&rs.i0.r.i0.syms=SYM5%2CSYM9%2CSYM9%2CSYM11%2CSYM11&freespins.denomination=' . $slotSettings->CurrentDenomination . '&superfreespins.multiplier.increase=' . $_obf_0D2C32330B23155C075C5C162F40222D250B22153C2201 . '&rs.i0.r.i3.syms=SYM11%2CSYM11%2CSYM7%2CSYM7%2CSYM5&openedpositions.total=12&freespins.win.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&freespins.totalwin.coins=' . $totalWin . '&freespins.total=0&isJackpotWin=false&gamestate.stack=basic%2Csuper_freespin&rs.i0.r.i0.pos=3&freespins.betlines=0&gamesoundurl=&rs.i0.r.i1.pos=13&game.win.coins=' . $totalWin . '&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i1.hold=false&freespins.wavecount=1&freespins.multiplier=1&stars.total=' . $Stars . '&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=superfreespin&openedpositions.thisspin=0&rs.i0.r.i2.hold=false&rs.i0.r.i4.syms=SYM12%2CSYM12%2CSYM5%2CSYM5%2CSYM10&features.i0.type=None&rs.i0.r.i2.pos=45&features.i1.type=None&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&gameover=false&rs.i0.r.i0.hold=false&rs.i0.r.i3.pos=33&freespins.left=4&rs.i0.r.i4.pos=12&superfreespins.multiplier.final=' . $_obf_0D1B03192A18213E03322D06371013302B0F2C3F3F2201 . '&nextaction=superfreespin&wavecount=1&superfreespins.multiplier.active=' . $_obf_0D3E31350F3C12172E363E14040408242C2E272B333E32 . '&rs.i0.r.i2.syms=SYM7%2CSYM7%2CSYM5%2CSYM5%2CSYM12&rs.i0.r.i3.hold=false&game.win.amount=' . ($totalWin * $slotSettings->CurrentDenomination) . '&freespins.totalwin.cents=' . ($totalWin / $slotSettings->CurrentDenomination * 100) . '' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101;
                        }
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'rs.i0.r.i1.pos=22&gameServerVersion=1.21.0&g4mode=false&game.win.coins=' . $totalWin . '&playercurrency=%26%23x20AC%3B&playercurrencyiso=' . $slotSettings->slotCurrency . '&stars.unscaled=' . $Stars . '&historybutton=false&rs.i0.r.i1.hold=false&rs.i0.r.i4.hold=false&next.rs=basic&gamestate.history=basic&stars.total=6&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=spin&rs.i0.r.i1.syms=SYM12%2CSYM12%2CSYM10&openedpositions.thisspin=' . $_obf_0D10172912330D143328112D073F1F01232A2702082111 . '&rs.i0.r.i2.hold=false&rs.i0.r.i4.syms=SYM9&features.i0.type=None&game.win.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.r.i2.pos=5&features.i1.type=None&rs.i0.id=basic2&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&gameover=true&gamestate.current=basic&rs.i0.r.i0.hold=false&features.i2.type=None&jackpotcurrency=%26%23x20AC%3B&multiplier=1&rs.i0.r.i3.pos=46&rs.i0.r.i4.pos=61&rs.i0.r.i0.syms=SYM9&rs.i0.r.i3.syms=SYM6%2CSYM9%2CSYM9&openedpositions.total=' . $_obf_0D091E370F322130252A173E032B2708093D3B5C142401 . '&isJackpotWin=false&gamestate.stack=basic&nextaction=' . $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 . '&rs.i0.r.i0.pos=11&wavecount=1&gamesoundurl=&rs.i0.r.i2.syms=SYM12%2CSYM12%2CSYM4%2CSYM4%2CSYM10&rs.i0.r.i3.hold=false&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32;
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
