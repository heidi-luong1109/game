<?php 
namespace VanguardLTE\Games\TheWolfsBaneNET
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
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'initbonus' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'initbonus';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'bonusaction' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bonusaction';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'endbonus' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'endbonus';
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
                    $freeState = '';
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $slotSettings->SetGameData($slotSettings->slotId . 'ReelsType', $lastEvent->serverResponse->ReelsType);
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
                        $totalWin = $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                        $freeState = 'previous.rs.i0=' . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&rs.i1.r.i0.syms=SYM6%2CSYM5%2CSYM4&bl.i6.coins=1&rs.i0.r.i0.overlay.i0.pos=21&rs.i0.r.i4.hold=false&gamestate.history=basic%2Cfreespin&rs.i1.r.i2.hold=false&game.win.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . "\t&staticsharedurl=https%3A%2F%2Fstatic-shared.casinomodule.com%2Fgameclient_html%2Fdevicedetection%2Fcurrent&bl.i0.reelset=ALL&freespins.initial=10&rs.i0.r.i0.overlay.i0.with=SYM1&bl.i3.reelset=ALL&bl.i4.line=2%2C1%2C0%2C1%2C2&rs.i2.r.i0.hold=false&rs.i0.r.i0.syms=SYM1%2CSYM3%2CSYM6&bl.i2.id=2&rs.i1.r.i1.pos=78&rs.i3.r.i4.pos=26&rs.i0.r.i0.pos=19&rs.i2.r.i3.pos=4&rs.i2.r.i4.hold=false&rs.i3.r.i1.pos=1&rs.i2.id=freespin_expanding&game.win.coins=" . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&rs.i1.r.i0.hold=false&bl.i3.id=3&ws.i1.reelset=' . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&bl.i8.reelset=ALL&clientaction=init&rs.i4.r.i0.hold=false&rs.i0.r.i2.hold=false&rs.i4.r.i3.syms=SYM4%2CSYM6%2CSYM3&casinoID=netent&bl.i5.coins=1&rs.i3.r.i2.hold=false&bl.i8.id=8&rs.i0.r.i3.pos=26&rs.i4.r.i0.syms=SYM6%2CSYM9%2CSYM7&bl.i6.line=2%2C2%2C1%2C2%2C2&rs.i1.r.i2.attention.i0=1&bl.i0.line=1%2C1%2C1%2C1%2C1&rs.i4.r.i2.pos=2&rs.i0.r.i2.syms=SYM7%2CSYM1%2CSYM9&game.win.amount=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&betlevel.all=1&denomination.all=' . implode('%2C', $slotSettings->Denominations) . '&ws.i2.pos.i1=1%2C2&rs.i2.r.i0.pos=1&current.rs.i0=' . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&ws.i2.pos.i0=2%2C2&ws.i0.reelset=' . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&ws.i2.pos.i2=0%2C2&bl.i1.id=1&rs.i3.r.i2.syms=SYM8%2CSYM10%2CSYM5&rs.i1.r.i4.pos=54&denomination.standard=' . ($slotSettings->CurrentDenomination * 100) . '&rs.i3.id=freespin_multiplier&multiplier=1&freespins.denomination=5.000&bl.i2.coins=1&bl.i6.id=6&autoplay=10%2C25%2C50%2C75%2C100%2C250%2C500%2C750%2C1000&freespins.totalwin.coins=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&ws.i0.direction=left_to_right&freespins.total=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&gamestate.stack=basic%2Cfreespin&rs.i1.r.i4.syms=SYM6%2CSYM7%2CSYM0&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&bet.betlevel=1&rs.i4.r.i2.hold=false&bl.i5.reelset=ALL&rs.i4.r.i1.syms=SYM3%2CSYM5%2CSYM4&bl.i7.id=7&rs.i2.r.i4.pos=26&rs.i3.r.i0.syms=SYM10%2CSYM6%2CSYM9&playercurrencyiso=' . $slotSettings->slotCurrency . '&bl.i1.coins=1&rs.i4.r.i1.hold=false&ws.i2.types.i0.coins=5&rs.i3.r.i2.pos=2&ws.i2.sym=SYM9&freespins.multiplier=1&playforfun=true&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM7%2CSYM6%2CSYM0&rs.i0.r.i2.pos=1&ws.i1.betline=5&rs.i1.r.i0.pos=75&bl.i0.coins=1&ws.i2.types.i0.wintype=coins&rs.i2.r.i0.syms=SYM7%2CSYM9%2CSYM10&bl.i2.reelset=ALL&rs.i3.r.i1.syms=SYM9%2CSYM3%2CSYM5&rs.i1.r.i4.hold=false&freespins.left=' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . '&rs.i4.r.i1.pos=0&rs.i4.r.i2.syms=SYM9%2CSYM10%2CSYM8&bl.standard=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9&rs.i1.r.i1.attention.i0=2&rs.i3.r.i0.hold=false&rs.i0.r.i3.hold=false&bet.denomination=' . ($slotSettings->GetGameData($slotSettings->slotId . 'GameDenom') * 100) . '&rs.i4.id=freespin_spreading&rs.i2.r.i1.hold=false&gameServerVersion=1.0.0&g4mode=false&freespins.win.coins=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&historybutton=false&ws.i2.direction=left_to_right&bl.i5.id=5&gameEventSetters.enabled=false&next.rs=' . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&ws.i2.types.i0.cents=25&rs.i1.r.i3.pos=18&rs.i0.r.i1.syms=SYM9%2CSYM6%2CSYM1&bl.i3.coins=1&ws.i1.types.i0.coins=30&rs.i2.r.i1.pos=6&rs.i4.r.i4.pos=5&ws.i0.betline=6&rs.i1.r.i3.hold=false&totalwin.coins=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&bl.i5.line=0%2C0%2C1%2C0%2C0&gamestate.current=freespin&rs.i4.r.i0.pos=3&jackpotcurrency=%26%23x20AC%3B&bl.i7.line=1%2C2%2C2%2C2%2C1&bet.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9&rs.i3.r.i1.hold=false&rs.i0.r.i3.syms=SYM1%2CSYM6%2CSYM5&rs.i1.r.i1.syms=SYM7%2CSYM9%2CSYM0&freespins.win.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . "\t&bl.i9.coins=1&bl.i7.reelset=ALL&isJackpotWin=false&rs.i2.r.i3.hold=false&ws.i2.reelset=" . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9&rs.i0.r.i1.pos=53&rs.i4.r.i4.syms=SYM10%2CSYM8%2CSYM6&rs.i1.r.i3.syms=SYM3%2CSYM8%2CSYM7&rs.i0.r.i1.hold=false&rs.i2.r.i1.syms=SYM10%2CSYM3%2CSYM6&ws.i1.types.i0.wintype=coins&bl.i9.line=1%2C0%2C1%2C0%2C1&ws.i1.sym=SYM9&betlevel.standard=1&ws.i1.types.i0.cents=150&gameover=false&rs.i3.r.i3.pos=15&ws.i1.direction=left_to_right&bl.i0.id=0&nextaction=freespin&bl.i3.line=0%2C1%2C2%2C1%2C0&rs.i1.r.i4.attention.i0=2&bl.i4.reelset=ALL&bl.i4.coins=1&freespins.totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . "\t&bl.i9.id=9&ws.i2.betline=2&ws.i0.pos.i3=3%2C2&freespins.betlevel=1&ws.i0.pos.i2=2%2C1&ws.i1.pos.i3=2%2C1&rs.i4.r.i3.pos=4&playercurrency=%26%23x20AC%3B&bl.i9.reelset=ALL&rs.i4.r.i4.hold=false&ws.i1.pos.i0=0%2C0&ws.i1.pos.i1=3%2C0&ws.i1.pos.i2=1%2C0&ws.i0.pos.i1=0%2C2&ws.i0.pos.i0=1%2C2&rs.i2.r.i4.syms=SYM4%2CSYM3%2CSYM6&rs.i4.r.i3.hold=false&rs.i0.id=" . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&ws.i0.types.i0.coins=60&bl.i1.reelset=ALL&rs.i2.r.i2.pos=3&last.rs=' . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&bl.i1.line=0%2C0%2C0%2C0%2C0&ws.i0.sym=SYM5&rs.i2.r.i2.syms=SYM4%2CSYM7%2CSYM3&rs.i1.r.i2.pos=75&rs.i3.r.i3.syms=SYM6%2CSYM7%2CSYM4&rs.i1.nearwin=4%2C3&ws.i0.types.i0.wintype=coins&rs.i3.r.i4.hold=false&rs.i0.r.i0.overlay.i0.row=2&nearwinallowed=true&bl.i8.line=1%2C0%2C0%2C0%2C1&freespins.wavecount=1&rs.i3.r.i3.hold=false&bl.i8.coins=1&bl.i2.line=2%2C2%2C2%2C2%2C2&rs.i1.r.i2.syms=SYM5%2CSYM0%2CSYM6&totalwin.cents=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&rs.i0.r.i0.hold=false&rs.i2.r.i3.syms=SYM8%2CSYM6%2CSYM10&restore=true&rs.i1.id=basic&rs.i3.r.i4.syms=SYM5%2CSYM10%2CSYM9&bl.i4.id=4&rs.i0.r.i4.pos=53&bl.i7.coins=1&ws.i0.types.i0.cents=300&bl.i6.reelset=ALL&rs.i3.r.i0.pos=3&rs.i2.r.i2.hold=false&wavecount=1&rs.i1.r.i1.hold=false';
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'rs.i4.id=basic&rs.i2.r.i1.hold=false&rs.i1.r.i0.syms=SYM7%2CSYM9%2CSYM10&bl.i6.coins=1&gameServerVersion=1.0.0&g4mode=false&historybutton=false&rs.i0.r.i4.hold=false&bl.i5.id=5&gameEventSetters.enabled=false&rs.i1.r.i2.hold=false&rs.i1.r.i3.pos=4&rs.i0.r.i1.syms=SYM5%2CSYM10%2CSYM3&bl.i3.coins=1&rs.i2.r.i1.pos=45&game.win.cents=0&rs.i4.r.i4.pos=5&staticsharedurl=https%3A%2F%2Fstatic-shared.casinomodule.com%2Fgameclient_html%2Fdevicedetection%2Fcurrent&bl.i0.reelset=ALL&rs.i1.r.i3.hold=false&totalwin.coins=0&bl.i5.line=0%2C0%2C1%2C0%2C0&gamestate.current=basic&bl.i3.reelset=ALL&rs.i4.r.i0.pos=3&bl.i4.line=2%2C1%2C0%2C1%2C2&jackpotcurrency=%26%23x20AC%3B&bl.i7.line=1%2C2%2C2%2C2%2C1&rs.i3.r.i1.hold=false&rs.i2.r.i0.hold=false&rs.i0.r.i0.syms=SYM7%2CSYM9%2CSYM10&rs.i0.r.i3.syms=SYM4%2CSYM9%2CSYM8&rs.i1.r.i1.syms=SYM10%2CSYM3%2CSYM6&bl.i2.id=2&rs.i1.r.i1.pos=6&rs.i3.r.i4.pos=26&bl.i9.coins=1&bl.i7.reelset=ALL&isJackpotWin=false&rs.i0.r.i0.pos=4&rs.i2.r.i3.hold=false&rs.i2.r.i3.pos=81&rs.i0.r.i1.pos=39&rs.i4.r.i4.syms=SYM10%2CSYM8%2CSYM6&rs.i1.r.i3.syms=SYM8%2CSYM6%2CSYM10&rs.i2.r.i4.hold=false&rs.i3.r.i1.pos=1&rs.i2.id=basic&game.win.coins=0&rs.i1.r.i0.hold=false&rs.i0.r.i1.hold=false&bl.i3.id=3&rs.i2.r.i1.syms=SYM9%2CSYM5%2CSYM8&bl.i8.reelset=ALL&clientaction=init&bl.i9.line=1%2C0%2C1%2C0%2C1&rs.i4.r.i0.hold=false&rs.i0.r.i2.hold=false&rs.i4.r.i3.syms=SYM4%2CSYM6%2CSYM3&casinoID=netent&betlevel.standard=1&bl.i5.coins=1&rs.i3.r.i2.hold=false&gameover=true&rs.i3.r.i3.pos=15&bl.i8.id=8&rs.i0.r.i3.pos=12&rs.i4.r.i0.syms=SYM6%2CSYM9%2CSYM7&bl.i0.id=0&bl.i6.line=2%2C2%2C1%2C2%2C2&bl.i0.line=1%2C1%2C1%2C1%2C1&nextaction=spin&bl.i3.line=0%2C1%2C2%2C1%2C0&bl.i4.reelset=ALL&rs.i4.r.i2.pos=2&bl.i4.coins=1&rs.i0.r.i2.syms=SYM8%2CSYM6%2CSYM9&game.win.amount=0&betlevel.all=1&bl.i9.id=9&denomination.all=' . implode('%2C', $slotSettings->Denominations) . '&rs.i4.r.i3.pos=4&playercurrency=%26%23x20AC%3B&bl.i9.reelset=ALL&rs.i2.r.i0.pos=3&rs.i4.r.i4.hold=false&bl.i1.id=1&rs.i2.r.i4.syms=SYM0%2CSYM9%2CSYM7&rs.i3.r.i2.syms=SYM8%2CSYM10%2CSYM5&rs.i4.r.i3.hold=false&rs.i0.id=freespin_regular&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&rs.i1.r.i4.pos=26&denomination.standard=' . ($slotSettings->CurrentDenomination * 100) . '&rs.i3.id=freespin_multiplier&bl.i1.reelset=ALL&multiplier=1&rs.i2.r.i2.pos=81&bl.i2.coins=1&bl.i6.id=6&bl.i1.line=0%2C0%2C0%2C0%2C0&autoplay=10%2C25%2C50%2C75%2C100%2C250%2C500%2C750%2C1000&rs.i1.r.i4.syms=SYM4%2CSYM3%2CSYM6&rs.i2.r.i2.syms=SYM2%2CSYM3%2CSYM10&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i1.r.i2.pos=3&rs.i3.r.i3.syms=SYM6%2CSYM7%2CSYM4&rs.i3.r.i4.hold=false&rs.i4.r.i2.hold=false&nearwinallowed=true&bl.i5.reelset=ALL&rs.i4.r.i1.syms=SYM3%2CSYM5%2CSYM4&bl.i7.id=7&rs.i2.r.i4.pos=1&bl.i8.line=1%2C0%2C0%2C0%2C1&rs.i3.r.i0.syms=SYM10%2CSYM6%2CSYM9&playercurrencyiso=' . $slotSettings->slotCurrency . '&bl.i1.coins=1&rs.i4.r.i1.hold=false&rs.i3.r.i2.pos=2&rs.i3.r.i3.hold=false&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM5%2CSYM8%2CSYM7&bl.i8.coins=1&rs.i0.r.i2.pos=25&bl.i2.line=2%2C2%2C2%2C2%2C2&rs.i1.r.i2.syms=SYM4%2CSYM7%2CSYM3&rs.i1.r.i0.pos=1&totalwin.cents=0&bl.i0.coins=1&rs.i2.r.i0.syms=SYM1%2CSYM8%2CSYM7&bl.i2.reelset=ALL&rs.i0.r.i0.hold=false&rs.i2.r.i3.syms=SYM6%2CSYM4%2CSYM10&restore=false&rs.i1.id=freespin_expanding&rs.i3.r.i4.syms=SYM5%2CSYM10%2CSYM9&rs.i3.r.i1.syms=SYM9%2CSYM3%2CSYM5&rs.i1.r.i4.hold=false&bl.i4.id=4&rs.i0.r.i4.pos=10&bl.i7.coins=1&rs.i4.r.i1.pos=0&rs.i4.r.i2.syms=SYM9%2CSYM10%2CSYM8&bl.standard=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9&bl.i6.reelset=ALL&rs.i3.r.i0.pos=3&rs.i3.r.i0.hold=false&rs.i2.r.i2.hold=false&wavecount=1&rs.i1.r.i1.hold=false&rs.i0.r.i3.hold=false' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $freeState;
                    break;
                case 'paytable':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'pt.i0.comp.i17.symbol=SYM8&pt.i0.comp.i5.freespins=0&pt.i0.comp.i23.n=5&pt.i1.comp.i34.multi=80&pt.i0.comp.i13.symbol=SYM7&pt.i1.comp.i8.type=betline&pt.i1.comp.i4.n=4&pt.i0.comp.i15.multi=10&pt.i1.comp.i27.symbol=SYM13&pt.i1.comp.i29.freespins=0&pt.i1.comp.i30.symbol=SYM11&pt.i1.comp.i3.multi=20&pt.i0.comp.i11.n=5&pt.i1.comp.i23.symbol=SYM10&bl.i4.line=2%2C1%2C0%2C1%2C2&pt.i0.id=basic&pt.i0.comp.i1.type=betline&bl.i2.id=2&pt.i1.comp.i10.type=betline&pt.i0.comp.i4.symbol=SYM4&pt.i1.comp.i5.freespins=0&pt.i1.comp.i8.symbol=SYM5&pt.i1.comp.i19.n=4&pt.i0.comp.i17.freespins=0&pt.i0.comp.i8.symbol=SYM5&pt.i0.comp.i0.symbol=SYM3&pt.i1.comp.i36.freespins=0&pt.i0.comp.i3.freespins=0&pt.i0.comp.i10.multi=60&pt.i1.id=freespin&bl.i3.id=3&pt.i1.comp.i34.freespins=0&pt.i1.comp.i34.type=betline&pt.i0.comp.i24.n=3&bl.i8.reelset=ALL&clientaction=paytable&pt.i1.comp.i27.freespins=0&pt.i1.comp.i5.n=5&bl.i5.coins=1&pt.i1.comp.i8.multi=200&pt.i0.comp.i22.type=betline&pt.i0.comp.i24.freespins=10&pt.i1.comp.i38.type=betline&pt.i0.comp.i21.multi=5&pt.i1.comp.i13.multi=50&pt.i0.comp.i12.n=3&pt.i0.comp.i13.type=betline&bl.i0.line=1%2C1%2C1%2C1%2C1&pt.i1.comp.i7.freespins=0&pt.i0.comp.i3.multi=20&pt.i1.comp.i22.type=betline&pt.i0.comp.i21.n=3&pt.i1.comp.i6.n=3&pt.i1.comp.i31.type=betline&bl.i1.id=1&pt.i0.comp.i10.type=betline&pt.i1.comp.i11.symbol=SYM6&pt.i0.comp.i5.multi=300&pt.i1.comp.i1.freespins=0&pt.i1.comp.i16.symbol=SYM8&pt.i1.comp.i23.multi=80&pt.i1.comp.i4.type=betline&pt.i1.comp.i18.multi=5&bl.i2.coins=1&pt.i1.comp.i26.type=scatter&pt.i0.comp.i8.multi=200&pt.i0.comp.i1.freespins=0&bl.i5.reelset=ALL&pt.i0.comp.i22.n=4&pt.i1.comp.i17.type=betline&pt.i1.comp.i0.symbol=SYM3&pt.i1.comp.i7.n=4&pt.i1.comp.i5.multi=300&pt.i0.comp.i21.type=betline&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&pt.i0.comp.i8.type=betline&pt.i0.comp.i7.freespins=0&pt.i1.comp.i15.multi=10&pt.i0.comp.i13.multi=50&pt.i0.comp.i17.type=betline&pt.i1.comp.i22.symbol=SYM10&pt.i1.comp.i30.freespins=0&pt.i1.comp.i38.symbol=SYM1&bl.i0.coins=1&bl.i2.reelset=ALL&pt.i0.comp.i10.n=4&pt.i1.comp.i6.multi=15&pt.i1.comp.i19.symbol=SYM9&pt.i0.comp.i22.freespins=0&pt.i0.comp.i20.symbol=SYM9&pt.i0.comp.i15.freespins=0&pt.i0.comp.i0.n=3&pt.i1.comp.i21.multi=5&pt.i1.comp.i30.type=betline&pt.i0.comp.i0.type=betline&pt.i1.comp.i0.multi=25&g4mode=false&pt.i1.comp.i8.n=5&pt.i0.comp.i25.multi=0&pt.i1.comp.i37.multi=80&pt.i0.comp.i16.symbol=SYM8&pt.i1.comp.i21.freespins=0&pt.i0.comp.i1.multi=80&pt.i0.comp.i27.n=3&pt.i1.comp.i9.type=betline&pt.i1.comp.i24.multi=0&pt.i1.comp.i23.type=betline&pt.i1.comp.i26.n=5&pt.i1.comp.i28.symbol=SYM13&pt.i1.comp.i17.multi=100&pt.i0.comp.i18.multi=5&bl.i5.line=0%2C0%2C1%2C0%2C0&pt.i1.comp.i33.symbol=SYM12&pt.i1.comp.i35.type=betline&pt.i0.comp.i9.n=3&pt.i1.comp.i21.type=betline&bl.i7.line=1%2C2%2C2%2C2%2C1&pt.i1.comp.i31.multi=80&pt.i1.comp.i18.type=betline&pt.i0.comp.i10.symbol=SYM6&pt.i0.comp.i15.n=3&pt.i0.comp.i21.symbol=SYM10&bl.i7.reelset=ALL&pt.i1.comp.i15.n=3&pt.i1.comp.i38.n=5&isJackpotWin=false&pt.i1.comp.i20.freespins=0&pt.i1.comp.i7.type=betline&pt.i0.comp.i10.freespins=0&pt.i0.comp.i20.multi=80&pt.i0.comp.i17.multi=100&pt.i1.comp.i25.type=scatter&pt.i1.comp.i9.n=3&bl.i9.line=1%2C0%2C1%2C0%2C1&pt.i0.comp.i2.multi=500&pt.i1.comp.i27.n=3&pt.i0.comp.i0.freespins=0&pt.i1.comp.i25.multi=0&pt.i1.comp.i16.freespins=0&pt.i1.comp.i5.type=betline&pt.i1.comp.i35.symbol=SYM12&pt.i1.comp.i24.symbol=SYM0&pt.i1.comp.i13.symbol=SYM7&pt.i1.comp.i17.symbol=SYM8&pt.i0.comp.i16.n=4&bl.i0.id=0&pt.i1.comp.i16.n=4&pt.i0.comp.i5.symbol=SYM4&pt.i1.comp.i7.symbol=SYM5&pt.i0.comp.i1.symbol=SYM3&pt.i1.comp.i36.multi=25&pt.i1.comp.i31.freespins=0&bl.i9.id=9&pt.i1.comp.i9.freespins=0&playercurrency=%26%23x20AC%3B&pt.i1.comp.i30.multi=25&pt.i0.comp.i25.n=4&pt.i1.comp.i28.n=4&pt.i1.comp.i32.freespins=0&pt.i0.comp.i9.freespins=0&credit=500000&pt.i0.comp.i5.type=betline&pt.i0.comp.i11.freespins=0&pt.i0.comp.i26.multi=0&pt.i0.comp.i25.type=scatter&bl.i1.reelset=ALL&pt.i1.comp.i18.symbol=SYM9&pt.i1.comp.i12.symbol=SYM7&pt.i0.comp.i13.freespins=0&pt.i1.comp.i15.type=betline&pt.i0.comp.i26.freespins=30&pt.i1.comp.i13.type=betline&pt.i1.comp.i1.multi=80&pt.i1.comp.i8.freespins=0&pt.i0.comp.i13.n=4&pt.i1.comp.i33.freespins=0&pt.i1.comp.i17.n=5&pt.i0.comp.i23.type=betline&pt.i1.comp.i17.freespins=0&pt.i1.comp.i26.multi=0&pt.i1.comp.i32.multi=500&pt.i1.comp.i0.type=betline&pt.i1.comp.i1.symbol=SYM3&pt.i1.comp.i29.multi=500&pt.i0.comp.i25.freespins=20&pt.i0.comp.i26.n=5&pt.i0.comp.i27.symbol=SYM2&pt.i1.comp.i29.n=5&pt.i0.comp.i23.multi=80&bl.i2.line=2%2C2%2C2%2C2%2C2&pt.i1.comp.i34.symbol=SYM12&pt.i1.comp.i28.multi=80&pt.i1.comp.i33.multi=25&pt.i1.comp.i18.freespins=0&pt.i0.comp.i14.n=5&pt.i0.comp.i0.multi=25&bl.i6.reelset=ALL&pt.i0.comp.i19.multi=30&pt.i1.comp.i18.n=3&pt.i1.comp.i33.type=betline&pt.i0.comp.i12.freespins=0&pt.i0.comp.i24.multi=0&pt.i0.comp.i19.symbol=SYM9&bl.i6.coins=1&pt.i0.comp.i15.type=betline&pt.i0.comp.i23.freespins=0&pt.i1.comp.i36.type=betline&pt.i0.comp.i4.multi=70&pt.i0.comp.i15.symbol=SYM8&pt.i1.comp.i14.multi=100&pt.i0.comp.i22.multi=30&pt.i1.comp.i19.type=betline&pt.i0.comp.i11.symbol=SYM6&pt.i1.comp.i27.multi=25&bl.i0.reelset=ALL&pt.i0.comp.i16.freespins=0&pt.i1.comp.i6.freespins=0&pt.i1.comp.i29.symbol=SYM13&pt.i1.comp.i22.n=4&pt.i0.comp.i4.freespins=0&pt.i1.comp.i25.symbol=SYM0&bl.i3.reelset=ALL&pt.i1.comp.i24.type=scatter&pt.i0.comp.i19.n=4&pt.i0.comp.i2.symbol=SYM3&pt.i0.comp.i20.type=betline&pt.i0.comp.i6.symbol=SYM5&pt.i1.comp.i11.n=5&pt.i1.comp.i34.n=4&pt.i0.comp.i5.n=5&pt.i1.comp.i2.symbol=SYM3&pt.i0.comp.i3.type=betline&pt.i1.comp.i19.multi=30&pt.i1.comp.i6.symbol=SYM5&pt.i0.comp.i27.multi=0&pt.i0.comp.i9.multi=15&pt.i0.comp.i22.symbol=SYM10&pt.i0.comp.i26.symbol=SYM0&pt.i1.comp.i19.freespins=0&pt.i0.comp.i14.freespins=0&pt.i0.comp.i21.freespins=0&pt.i1.comp.i35.multi=500&pt.i1.comp.i4.freespins=0&pt.i1.comp.i12.type=betline&pt.i1.comp.i36.symbol=SYM1&pt.i1.comp.i21.symbol=SYM10&pt.i1.comp.i23.n=5&pt.i1.comp.i32.symbol=SYM11&bl.i8.id=8&pt.i0.comp.i16.multi=50&pt.i1.comp.i37.freespins=0&bl.i6.line=2%2C2%2C1%2C2%2C2&pt.i1.comp.i35.n=5&pt.i1.comp.i9.multi=15&pt.i0.comp.i19.type=betline&pt.i0.comp.i6.freespins=0&pt.i1.comp.i2.multi=500&pt.i0.comp.i6.n=3&pt.i1.comp.i12.n=3&pt.i1.comp.i3.type=betline&pt.i1.comp.i10.freespins=0&pt.i1.comp.i28.type=betline&pt.i1.comp.i20.multi=80&pt.i0.comp.i27.freespins=0&pt.i1.comp.i24.n=3&pt.i1.comp.i27.type=betline&pt.i1.comp.i2.type=betline&pt.i0.comp.i2.freespins=0&pt.i1.comp.i38.multi=500&pt.i0.comp.i7.n=4&pt.i0.comp.i11.multi=200&pt.i1.comp.i14.symbol=SYM7&pt.i0.comp.i7.type=betline&pt.i0.comp.i17.n=5&bl.i6.id=6&pt.i1.comp.i13.n=4&pt.i1.comp.i36.n=3&pt.i0.comp.i8.freespins=0&pt.i1.comp.i4.multi=70&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&pt.i0.comp.i12.type=betline&pt.i0.comp.i14.multi=100&pt.i1.comp.i7.multi=60&bl.i7.id=7&pt.i1.comp.i11.type=betline&pt.i0.comp.i6.multi=15&playercurrencyiso=' . $slotSettings->slotCurrency . '&bl.i1.coins=1&pt.i1.comp.i5.symbol=SYM4&pt.i0.comp.i18.type=betline&pt.i0.comp.i23.symbol=SYM10&playforfun=false&pt.i1.comp.i25.n=4&pt.i0.comp.i2.type=betline&pt.i1.comp.i20.type=betline&pt.i1.comp.i22.multi=30&pt.i0.comp.i8.n=5&pt.i1.comp.i22.freespins=0&pt.i0.comp.i11.type=betline&pt.i1.comp.i35.freespins=0&pt.i0.comp.i18.n=3&pt.i1.comp.i14.n=5&pt.i1.comp.i16.multi=50&pt.i1.comp.i37.n=4&pt.i1.comp.i15.freespins=0&pt.i0.comp.i27.type=bonus&pt.i1.comp.i28.freespins=0&pt.i0.comp.i7.symbol=SYM5&pt.i1.comp.i0.freespins=0&gameServerVersion=1.0.0&historybutton=false&bl.i5.id=5&pt.i0.comp.i18.symbol=SYM9&pt.i0.comp.i12.multi=10&pt.i1.comp.i14.freespins=0&bl.i3.coins=1&pt.i0.comp.i12.symbol=SYM7&pt.i0.comp.i14.symbol=SYM7&pt.i1.comp.i13.freespins=0&pt.i0.comp.i14.type=betline&pt.i1.comp.i0.n=3&pt.i1.comp.i26.symbol=SYM0&pt.i1.comp.i31.symbol=SYM11&pt.i0.comp.i7.multi=60&jackpotcurrency=%26%23x20AC%3B&bl.i9.coins=1&pt.i1.comp.i37.type=betline&pt.i1.comp.i11.multi=200&pt.i1.comp.i30.n=3&pt.i0.comp.i1.n=4&pt.i0.comp.i20.n=5&pt.i1.comp.i3.symbol=SYM4&pt.i1.comp.i23.freespins=0&pt.i0.comp.i25.symbol=SYM0&pt.i0.comp.i26.type=scatter&pt.i0.comp.i9.type=betline&pt.i1.comp.i16.type=betline&pt.i1.comp.i20.symbol=SYM9&pt.i1.comp.i12.multi=10&pt.i1.comp.i1.n=4&pt.i1.comp.i11.freespins=0&pt.i0.comp.i9.symbol=SYM6&pt.i0.comp.i16.type=betline&bl.i3.line=0%2C1%2C2%2C1%2C0&bl.i4.reelset=ALL&bl.i4.coins=1&pt.i0.comp.i2.n=5&pt.i1.comp.i31.n=4&pt.i0.comp.i19.freespins=0&pt.i1.comp.i14.type=betline&pt.i0.comp.i6.type=betline&pt.i1.comp.i2.freespins=0&pt.i1.comp.i25.freespins=20&bl.i9.reelset=ALL&pt.i1.comp.i10.multi=60&pt.i1.comp.i10.symbol=SYM6&pt.i1.comp.i2.n=5&pt.i1.comp.i20.n=5&pt.i1.comp.i24.freespins=10&pt.i1.comp.i32.type=betline&pt.i0.comp.i4.type=betline&pt.i1.comp.i26.freespins=30&pt.i1.comp.i1.type=betline&bl.i1.line=0%2C0%2C0%2C0%2C0&pt.i0.comp.i20.freespins=0&pt.i1.comp.i29.type=betline&pt.i1.comp.i32.n=5&pt.i0.comp.i3.n=3&pt.i1.comp.i6.type=betline&pt.i1.comp.i4.symbol=SYM4&pt.i1.comp.i38.freespins=0&bl.i8.line=1%2C0%2C0%2C0%2C1&pt.i0.comp.i24.symbol=SYM0&bl.i8.coins=1&pt.i1.comp.i37.symbol=SYM1&pt.i1.comp.i3.n=3&pt.i1.comp.i21.n=3&pt.i0.comp.i18.freespins=0&pt.i1.comp.i15.symbol=SYM8&pt.i1.comp.i3.freespins=0&bl.i4.id=4&bl.i7.coins=1&pt.i1.comp.i9.symbol=SYM6&pt.i0.comp.i3.symbol=SYM4&pt.i0.comp.i24.type=scatter&pt.i1.comp.i12.freespins=0&pt.i0.comp.i4.n=4&pt.i1.comp.i10.n=4&pt.i1.comp.i33.n=3';
                case 'initfreespin':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'rs.i4.id=freespin_spreading&rs.i2.r.i1.hold=false&rs.i1.r.i0.syms=SYM7%2CSYM9%2CSYM10&gameServerVersion=1.0.0&g4mode=false&freespins.win.coins=0&historybutton=false&rs.i0.r.i4.hold=false&next.rs=' . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&gamestate.history=basic&rs.i1.r.i2.hold=false&rs.i1.r.i3.pos=4&rs.i0.r.i1.syms=SYM5%2CSYM10%2CSYM3&rs.i2.r.i1.pos=25&game.win.cents=0&rs.i4.r.i4.pos=5&rs.i1.r.i3.hold=false&totalwin.coins=0&gamestate.current=freespin&freespins.initial=10&rs.i4.r.i0.pos=3&jackpotcurrency=%26%23x20AC%3B&bet.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9&rs.i3.r.i1.hold=false&rs.i2.r.i0.hold=false&rs.i0.r.i0.syms=SYM7%2CSYM9%2CSYM10&rs.i0.r.i3.syms=SYM4%2CSYM9%2CSYM8&rs.i1.r.i1.syms=SYM10%2CSYM3%2CSYM6&rs.i1.r.i1.pos=6&rs.i3.r.i4.pos=26&freespins.win.cents=0&isJackpotWin=false&rs.i0.r.i0.pos=4&rs.i2.r.i3.hold=false&rs.i2.r.i3.pos=20&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9&rs.i0.r.i1.pos=39&rs.i4.r.i4.syms=SYM10%2CSYM8%2CSYM6&rs.i1.r.i3.syms=SYM8%2CSYM6%2CSYM10&rs.i2.r.i4.hold=false&rs.i3.r.i1.pos=1&rs.i2.id=basic&game.win.coins=0&rs.i1.r.i0.hold=false&rs.i0.r.i1.hold=false&rs.i2.r.i1.syms=SYM0%2CSYM6%2CSYM9&clientaction=initfreespin&rs.i4.r.i0.hold=false&rs.i0.r.i2.hold=false&rs.i4.r.i3.syms=SYM4%2CSYM6%2CSYM3&rs.i2.r.i3.attention.i0=1&rs.i3.r.i2.hold=false&gameover=false&rs.i3.r.i3.pos=15&rs.i0.r.i3.pos=12&rs.i2.r.i1.attention.i0=0&rs.i4.r.i0.syms=SYM6%2CSYM9%2CSYM7&nextaction=freespin&rs.i2.nearwin=4%2C3&rs.i4.r.i2.pos=2&rs.i0.r.i2.syms=SYM8%2CSYM6%2CSYM9&game.win.amount=0.00&freespins.totalwin.cents=0&freespins.betlevel=1&rs.i4.r.i3.pos=4&playercurrency=%26%23x20AC%3B&rs.i2.r.i0.pos=74&rs.i4.r.i4.hold=false&current.rs.i0=' . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&rs.i2.r.i4.syms=SYM7%2CSYM10%2CSYM6&rs.i3.r.i2.syms=SYM8%2CSYM10%2CSYM5&rs.i4.r.i3.hold=false&rs.i0.id=freespin_regular&credit=498550&rs.i1.r.i4.pos=26&rs.i3.id=' . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&multiplier=1&rs.i2.r.i2.pos=3&freespins.denomination=5.000&freespins.totalwin.coins=0&freespins.total=10&gamestate.stack=basic%2Cfreespin&rs.i1.r.i4.syms=SYM4%2CSYM3%2CSYM6&rs.i2.r.i2.syms=SYM0%2CSYM9%2CSYM8&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i1.r.i2.pos=3&rs.i3.r.i3.syms=SYM6%2CSYM7%2CSYM4&bet.betlevel=1&rs.i3.r.i4.hold=false&rs.i4.r.i2.hold=false&rs.i4.r.i1.syms=SYM3%2CSYM5%2CSYM4&rs.i2.r.i4.pos=52&rs.i3.r.i0.syms=SYM10%2CSYM6%2CSYM9&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i4.r.i1.hold=false&freespins.wavecount=1&rs.i3.r.i2.pos=2&rs.i3.r.i3.hold=false&freespins.multiplier=1&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM5%2CSYM8%2CSYM7&rs.i0.r.i2.pos=25&rs.i1.r.i2.syms=SYM4%2CSYM7%2CSYM3&rs.i1.r.i0.pos=1&totalwin.cents=0&rs.i2.r.i0.syms=SYM3%2CSYM6%2CSYM5&rs.i0.r.i0.hold=false&rs.i2.r.i3.syms=SYM7%2CSYM0%2CSYM9&rs.i1.id=freespin_expanding&rs.i3.r.i4.syms=SYM5%2CSYM10%2CSYM9&rs.i3.r.i1.syms=SYM9%2CSYM3%2CSYM5&rs.i1.r.i4.hold=false&freespins.left=10&rs.i0.r.i4.pos=10&rs.i2.r.i2.attention.i0=0&rs.i4.r.i1.pos=0&rs.i4.r.i2.syms=SYM9%2CSYM10%2CSYM8&rs.i3.r.i0.pos=3&rs.i3.r.i0.hold=false&rs.i2.r.i2.hold=false&wavecount=1&rs.i1.r.i1.hold=false&rs.i0.r.i3.hold=false&bet.denomination=5';
                    break;
                case 'initbonus':
                    $pickWinMpl = $slotSettings->GetGameData($slotSettings->slotId . 'pickWinMpl');
                    $pickWin = $slotSettings->GetGameData($slotSettings->slotId . 'pickWin');
                    $reels = $slotSettings->GetGameData($slotSettings->slotId . 'pickReels');
                    $_obf_0D5B1E02354004101105313D18053C140D26242F5B2C32 = [];
                    $_obf_0D362211271812115C3D1F11291A1A35122129062C3C22 = 0;
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                        {
                            if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == 2 ) 
                            {
                                $_obf_0D5B1E02354004101105313D18053C140D26242F5B2C32[$_obf_0D362211271812115C3D1F11291A1A35122129062C3C22] = $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32;
                                $_obf_0D362211271812115C3D1F11291A1A35122129062C3C22++;
                            }
                        }
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'bonusitem.2.state=not_picked&gameServerVersion=1.0.0&g4mode=false&game.win.coins=0&playercurrency=%26%23x20AC%3B&playercurrencyiso=' . $slotSettings->slotCurrency . '&historybutton=false&bonusitem.1.win=unknown&bonusitem.2.reel=4&bonusitem.1.row=' . $_obf_0D5B1E02354004101105313D18053C140D26242F5B2C32[1] . '&gamestate.history=basic&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=initbonus&game.win.cents=0&bonusitem.1.reel=2&bonusitem.2.row=' . $_obf_0D5B1E02354004101105313D18053C140D26242F5B2C32[2] . '&bonusitem.0.state=not_picked&totalwin.coins=0&bonusitem.2.win=unknown&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=0&gamestate.current=bonus&gameover=false&totalbonuswin.coins=0&jackpotcurrency=%26%23x20AC%3B&multiplier=1&bonusitem.1.state=not_picked&bonusgame.coinvalue=0.05&gamestate.bonusid=wildwildwestbonusgame&isJackpotWin=false&gamestate.stack=basic%2Cbonus&bonuswin.cents=0&totalbonuswin.cents=0&nextaction=bonusaction&wavecount=1&nextactiontype=pickbonus&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&bonusitem.0.reel=0&bonusitem.0.row=' . $_obf_0D5B1E02354004101105313D18053C140D26242F5B2C32[0] . '&game.win.amount=0&bonusitem.0.win=unknown&bonuswin.coins=0';
                    break;
                case 'endbonus':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'gameServerVersion=1.0.0&g4mode=false&game.win.coins=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&playercurrency=%26%23x20AC%3B&playercurrencyiso=' . $slotSettings->slotCurrency . '&historybutton=false&current.rs.i0=basic&next.rs=basic&gamestate.history=basic%2Cbonus&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=endbonus&game.win.cents=' . ($slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') * $slotSettings->CurrentDenomination * 100) . '&totalwin.coins=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') * $slotSettings->CurrentDenomination * 100) . '&gamestate.current=basic&gameover=true&jackpotcurrency=%26%23x20AC%3B&multiplier=1&isJackpotWin=false&gamestate.stack=basic&nextaction=spin&wavecount=1&gamesoundurl=&game.win.amount=' . ($slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') * $slotSettings->CurrentDenomination * 100) . '';
                    break;
                case 'bonusaction':
                    $pickWinMpl = $slotSettings->GetGameData($slotSettings->slotId . 'pickWinMpl');
                    $pickWin = $slotSettings->GetGameData($slotSettings->slotId . 'pickWin');
                    $reels = $slotSettings->GetGameData($slotSettings->slotId . 'pickReels');
                    $allbet = $slotSettings->GetGameData($slotSettings->slotId . 'pickBet');
                    $_obf_0D040123351030043B2916011C1F222A23331E3F3D3F22 = explode(',', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['wildwildwest_bonus_pick']);
                    if( $_obf_0D040123351030043B2916011C1F222A23331E3F3D3F22[0] == 4 ) 
                    {
                        $_obf_0D040123351030043B2916011C1F222A23331E3F3D3F22[0] = 2;
                    }
                    else if( $_obf_0D040123351030043B2916011C1F222A23331E3F3D3F22[0] == 2 ) 
                    {
                        $_obf_0D040123351030043B2916011C1F222A23331E3F3D3F22[0] = 1;
                    }
                    $_obf_0D5B1E02354004101105313D18053C140D26242F5B2C32 = [];
                    $_obf_0D030917311D22090A120F3D13191A3D1C392E13323B01 = [
                        rand(5, 50) * $allbet, 
                        rand(5, 50) * $allbet, 
                        rand(5, 50) * $allbet
                    ];
                    $_obf_0D052910361F13384039233913303C2D2C2C391D021711 = [
                        'not_picked', 
                        'not_picked', 
                        'not_picked'
                    ];
                    $_obf_0D5C17263D26052D2A1A341501132B0909142E0A1B3311 = [
                        '&bonusitem.0.win=' . $_obf_0D030917311D22090A120F3D13191A3D1C392E13323B01[0] . '&bonusitem.0.state=not_picked', 
                        '&bonusitem.1.win=' . $_obf_0D030917311D22090A120F3D13191A3D1C392E13323B01[1] . '&bonusitem.1.state=not_picked', 
                        '&bonusitem.2.win=' . $_obf_0D030917311D22090A120F3D13191A3D1C392E13323B01[2] . '&bonusitem.2.state=not_picked'
                    ];
                    $_obf_0D5C17263D26052D2A1A341501132B0909142E0A1B3311[$_obf_0D040123351030043B2916011C1F222A23331E3F3D3F22[0]] = '&bonusitem.' . $_obf_0D040123351030043B2916011C1F222A23331E3F3D3F22[0] . '.win=' . $pickWin . '&bonusitem.' . $_obf_0D040123351030043B2916011C1F222A23331E3F3D3F22[0] . '.state=picked';
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                        {
                            if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == 2 ) 
                            {
                                $_obf_0D5B1E02354004101105313D18053C140D26242F5B2C32[] = $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32;
                            }
                        }
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'bonusitem.2.state=not_picked&gameServerVersion=1.0.0&g4mode=false&game.win.coins=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&playercurrency=%26%23x20AC%3B&playercurrencyiso=' . $slotSettings->slotCurrency . '&historybutton=false&bonusitem.1.win=150&bonusitem.2.reel=4&bonusitem.1.row=' . $_obf_0D5B1E02354004101105313D18053C140D26242F5B2C32[1] . '&gamestate.history=basic%2Cbonus&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=bonusaction&game.win.cents=750&bonusitem.1.reel=2&bonusitem.2.row=' . $_obf_0D5B1E02354004101105313D18053C140D26242F5B2C32[2] . '&bonusitem.0.state=not_picked&totalwin.coins=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&bonusitem.2.win=250&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=750&gamestate.current=bonus&gameover=false&totalbonuswin.coins=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&jackpotcurrency=%26%23x20AC%3B&multiplier=1&bonusitem.1.state=picked&bonusgame.coinvalue=0.05&gamestate.bonusid=wildwildwestbonusgame&isJackpotWin=false&gamestate.stack=basic%2Cbonus&bonuswin.cents=750&totalbonuswin.cents=750&nextaction=endbonus&wavecount=1&gamesoundurl=&bonusitem.0.reel=0&bonusitem.0.row=' . $_obf_0D5B1E02354004101105313D18053C140D26242F5B2C32[0] . '&game.win.amount=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&bonusgameover=true&bonusitem.0.win=50&bonuswin.coins=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '' . implode('', $_obf_0D5C17263D26052D2A1A341501132B0909142E0A1B3311);
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
                    $lines = 10;
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
                        $slotSettings->SetGameData($slotSettings->slotId . 'ReelsType', 'basic');
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
                        $wild = [
                            '1', 
                            '11', 
                            '12', 
                            '13'
                        ];
                        $scatter = '0';
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType'));
                        $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01 = $reels;
                        $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '';
                        $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 = false;
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                            $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 = true;
                        }
                        $slotSettings->slotFreeMpl = 1;
                        if( $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 ) 
                        {
                            if( $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') == 'freespin_spreading' ) 
                            {
                                $_obf_0D372E171A0818143D08051506222B13073C1233403F11 = 'SYM13';
                                $_obf_0D3B02343F0102392E13160C19162532140734230C3D22 = '13';
                                $_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01 = [];
                                $_obf_0D1D1C120C3D0C0E2F053507291C1B2C3E400E0E320311 = rand(2, 4);
                                $_obf_0D0536160414182A331012330B3B2A120B353F3B043E11 = rand(0, 2);
                                $reels['reel' . $_obf_0D1D1C120C3D0C0E2F053507291C1B2C3E400E0E320311][$_obf_0D0536160414182A331012330B3B2A120B353F3B043E11] = '13';
                                $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01['reel' . $_obf_0D1D1C120C3D0C0E2F053507291C1B2C3E400E0E320311][$_obf_0D0536160414182A331012330B3B2A120B353F3B043E11] = '13';
                                for( $r = 2; $r <= 4; $r++ ) 
                                {
                                    if( $reels['reel' . $r][0] == '13' || $reels['reel' . $r][1] == '13' || $reels['reel' . $r][2] == '13' ) 
                                    {
                                        if( $reels['reel' . $r][0] == '13' ) 
                                        {
                                            $_obf_0D0B18160B2E32053F295B112702091C04071E1E360901 = [
                                                $r, 
                                                0
                                            ];
                                            $_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01 = [
                                                [
                                                    $r, 
                                                    1
                                                ], 
                                                [
                                                    $r + 1, 
                                                    0
                                                ], 
                                                [
                                                    $r - 1, 
                                                    0
                                                ]
                                            ];
                                        }
                                        if( $reels['reel' . $r][1] == '13' ) 
                                        {
                                            $_obf_0D0B18160B2E32053F295B112702091C04071E1E360901 = [
                                                $r, 
                                                1
                                            ];
                                            $_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01 = [
                                                [
                                                    $r, 
                                                    0
                                                ], 
                                                [
                                                    $r, 
                                                    2
                                                ], 
                                                [
                                                    $r + 1, 
                                                    1
                                                ], 
                                                [
                                                    $r - 1, 
                                                    1
                                                ]
                                            ];
                                        }
                                        if( $reels['reel' . $r][2] == '13' ) 
                                        {
                                            $_obf_0D0B18160B2E32053F295B112702091C04071E1E360901 = [
                                                $r, 
                                                2
                                            ];
                                            $_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01 = [
                                                [
                                                    $r, 
                                                    1
                                                ], 
                                                [
                                                    $r + 1, 
                                                    2
                                                ], 
                                                [
                                                    $r - 1, 
                                                    2
                                                ]
                                            ];
                                        }
                                        break;
                                    }
                                }
                                $symArr = [];
                                $_obf_0D043F021833305C34191624090C173B16371528241622 = rand(2, 3);
                                shuffle($_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01);
                                for( $ii = 0; $ii < $_obf_0D043F021833305C34191624090C173B16371528241622; $ii++ ) 
                                {
                                    if( isset($_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01[$ii]) ) 
                                    {
                                        $symArr[$ii] = $_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01[$ii];
                                    }
                                }
                            }
                            if( $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') == 'freespin_regular' ) 
                            {
                                $_obf_0D372E171A0818143D08051506222B13073C1233403F11 = 'SYM1';
                                $_obf_0D3B02343F0102392E13160C19162532140734230C3D22 = '1';
                                $_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01 = [
                                    [
                                        1, 
                                        0
                                    ], 
                                    [
                                        1, 
                                        1
                                    ], 
                                    [
                                        1, 
                                        2
                                    ], 
                                    [
                                        2, 
                                        0
                                    ], 
                                    [
                                        2, 
                                        1
                                    ], 
                                    [
                                        2, 
                                        2
                                    ], 
                                    [
                                        3, 
                                        0
                                    ], 
                                    [
                                        3, 
                                        1
                                    ], 
                                    [
                                        3, 
                                        2
                                    ], 
                                    [
                                        4, 
                                        0
                                    ], 
                                    [
                                        4, 
                                        1
                                    ], 
                                    [
                                        4, 
                                        2
                                    ], 
                                    [
                                        5, 
                                        0
                                    ], 
                                    [
                                        5, 
                                        1
                                    ], 
                                    [
                                        5, 
                                        2
                                    ]
                                ];
                                $symArr = [];
                                $_obf_0D043F021833305C34191624090C173B16371528241622 = rand(1, 5);
                                shuffle($_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01);
                                for( $_obf_0D1F281122083E2624270F3935192A0725132B3E020732 = 0; $_obf_0D1F281122083E2624270F3935192A0725132B3E020732 < $_obf_0D043F021833305C34191624090C173B16371528241622; $_obf_0D1F281122083E2624270F3935192A0725132B3E020732++ ) 
                                {
                                    $symArr[$_obf_0D1F281122083E2624270F3935192A0725132B3E020732] = $_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01[$_obf_0D1F281122083E2624270F3935192A0725132B3E020732];
                                }
                            }
                            if( $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') == 'freespin_expanding' ) 
                            {
                                $_obf_0D372E171A0818143D08051506222B13073C1233403F11 = 'SYM11';
                                $_obf_0D3B02343F0102392E13160C19162532140734230C3D22 = '11';
                                $_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01 = [
                                    [
                                        1, 
                                        1
                                    ], 
                                    [
                                        2, 
                                        1
                                    ], 
                                    [
                                        3, 
                                        1
                                    ], 
                                    [
                                        4, 
                                        1
                                    ], 
                                    [
                                        5, 
                                        1
                                    ]
                                ];
                                $symArr = [];
                                $_obf_0D043F021833305C34191624090C173B16371528241622 = rand(1, 2);
                                shuffle($_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01);
                                for( $r = 0; $r < $_obf_0D043F021833305C34191624090C173B16371528241622; $r++ ) 
                                {
                                    $_obf_0D29243835290203394032232C1C273E1624120D091211 = $_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01[$r];
                                    $symArr[] = [
                                        $_obf_0D29243835290203394032232C1C273E1624120D091211[0], 
                                        1
                                    ];
                                    $symArr[] = [
                                        $_obf_0D29243835290203394032232C1C273E1624120D091211[0], 
                                        0
                                    ];
                                    $symArr[] = [
                                        $_obf_0D29243835290203394032232C1C273E1624120D091211[0], 
                                        2
                                    ];
                                }
                            }
                            if( $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') == 'freespin_multiplier' ) 
                            {
                                $_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01 = [
                                    [
                                        1, 
                                        0
                                    ], 
                                    [
                                        1, 
                                        1
                                    ], 
                                    [
                                        1, 
                                        2
                                    ], 
                                    [
                                        2, 
                                        0
                                    ], 
                                    [
                                        2, 
                                        1
                                    ], 
                                    [
                                        2, 
                                        2
                                    ], 
                                    [
                                        3, 
                                        0
                                    ], 
                                    [
                                        3, 
                                        1
                                    ], 
                                    [
                                        3, 
                                        2
                                    ], 
                                    [
                                        4, 
                                        0
                                    ], 
                                    [
                                        4, 
                                        1
                                    ], 
                                    [
                                        4, 
                                        2
                                    ], 
                                    [
                                        5, 
                                        0
                                    ], 
                                    [
                                        5, 
                                        1
                                    ], 
                                    [
                                        5, 
                                        2
                                    ]
                                ];
                                $symArr = [];
                                $_obf_0D043F021833305C34191624090C173B16371528241622 = rand(1, 5);
                                shuffle($_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01);
                                for( $r = 0; $r < $_obf_0D043F021833305C34191624090C173B16371528241622; $r++ ) 
                                {
                                    $symArr[$r] = $_obf_0D2916110B213B181940273D2E22255B3B0B3E03382E01[$r];
                                }
                                $_obf_0D372E171A0818143D08051506222B13073C1233403F11 = 'SYM12';
                                $_obf_0D3B02343F0102392E13160C19162532140734230C3D22 = '12';
                                $slotSettings->slotFreeMpl = 2;
                            }
                            $_obf_0D2B3D3F2D3D0606222C3812063E1A250402050B073001 = [
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0
                            ];
                            $_obf_0D191F0526131E2D103B0E2D24041D3406303E22011901 = 0;
                            $_obf_0D5C1002323E0A01353F0B2516060303331A2D3D1F3411 = 0;
                            foreach( $symArr as $_obf_0D2B283E055B0C3B0F36120B1E36170F0F241E38301201 ) 
                            {
                                $reels['reel' . $_obf_0D2B283E055B0C3B0F36120B1E36170F0F241E38301201[0]][$_obf_0D2B283E055B0C3B0F36120B1E36170F0F241E38301201[1]] = $_obf_0D3B02343F0102392E13160C19162532140734230C3D22;
                                $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 .= ('&rs.i0.r.i' . ($_obf_0D2B283E055B0C3B0F36120B1E36170F0F241E38301201[0] - 1) . '.overlay.i' . $_obf_0D2B3D3F2D3D0606222C3812063E1A250402050B073001[$_obf_0D2B283E055B0C3B0F36120B1E36170F0F241E38301201[0]] . '.row=' . $_obf_0D2B283E055B0C3B0F36120B1E36170F0F241E38301201[1] . '&rs.i0.r.i' . ($_obf_0D2B283E055B0C3B0F36120B1E36170F0F241E38301201[0] - 1) . '.overlay.i' . $_obf_0D2B3D3F2D3D0606222C3812063E1A250402050B073001[$_obf_0D2B283E055B0C3B0F36120B1E36170F0F241E38301201[0]] . '.with=' . $_obf_0D372E171A0818143D08051506222B13073C1233403F11 . '&rs.i0.r.i' . ($_obf_0D2B283E055B0C3B0F36120B1E36170F0F241E38301201[0] - 1) . '.overlay.i' . $_obf_0D2B3D3F2D3D0606222C3812063E1A250402050B073001[$_obf_0D2B283E055B0C3B0F36120B1E36170F0F241E38301201[0]] . '.pos=1');
                                if( $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') == 'freespin_spreading' ) 
                                {
                                    $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 .= ('&spread.from.i' . $_obf_0D5C1002323E0A01353F0B2516060303331A2D3D1F3411 . '=' . ($_obf_0D0B18160B2E32053F295B112702091C04071E1E360901[0] - 1) . '%2C' . $_obf_0D0B18160B2E32053F295B112702091C04071E1E360901[1]);
                                    $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 .= ('&spread.to.i' . $_obf_0D5C1002323E0A01353F0B2516060303331A2D3D1F3411 . '=' . ($_obf_0D2B283E055B0C3B0F36120B1E36170F0F241E38301201[0] - 1) . '%2C' . $_obf_0D2B283E055B0C3B0F36120B1E36170F0F241E38301201[1]);
                                }
                                $_obf_0D5C1002323E0A01353F0B2516060303331A2D3D1F3411++;
                                $_obf_0D2B3D3F2D3D0606222C3812063E1A250402050B073001[$_obf_0D2B283E055B0C3B0F36120B1E36170F0F241E38301201[0]]++;
                                $_obf_0D2B3D3F2D3D0606222C3812063E1A250402050B073001[0]++;
                            }
                        }
                        $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 = 0;
                        for( $k = 0; $k < $lines; $k++ ) 
                        {
                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '';
                            for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                            {
                                $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = (string)$slotSettings->SymbolGame[$j];
                                if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $scatter || !isset($slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132]) ) 
                                {
                                }
                                else
                                {
                                    $s = [];
                                    $s[0] = $reels['reel1'][$linesId[$k][0] - 1];
                                    $s[1] = $reels['reel2'][$linesId[$k][1] - 1];
                                    $s[2] = $reels['reel3'][$linesId[$k][2] - 1];
                                    $s[3] = $reels['reel4'][$linesId[$k][3] - 1];
                                    $s[4] = $reels['reel5'][$linesId[$k][4] - 1];
                                    if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) ) 
                                    {
                                        $mpl = 1;
                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) ) 
                                        {
                                            $mpl = 1;
                                        }
                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) ) 
                                        {
                                            $mpl = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=basic&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i0=0%2C' . ($linesId[$k][0] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i1=1%2C' . ($linesId[$k][1] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i2=2%2C' . ($linesId[$k][2] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.multipliers=1&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=' . $k . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 * $slotSettings->CurrentDenomination * 100) . '';
                                            $_obf_0D1B23163B35245C1C1C2726192932403137111C102632 = $_obf_0D011C142C3C37263F351C4012170A074027083F321132;
                                        }
                                    }
                                    if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) ) 
                                    {
                                        $mpl = 1;
                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) ) 
                                        {
                                            $mpl = 1;
                                        }
                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) ) 
                                        {
                                            $mpl = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=basic&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i0=0%2C' . ($linesId[$k][0] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i1=1%2C' . ($linesId[$k][1] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i2=2%2C' . ($linesId[$k][2] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i3=3%2C' . ($linesId[$k][3] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=' . $k . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.multipliers=1&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 * $slotSettings->CurrentDenomination * 100) . '';
                                            $_obf_0D1B23163B35245C1C1C2726192932403137111C102632 = $_obf_0D011C142C3C37263F351C4012170A074027083F321132;
                                        }
                                    }
                                    if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) && ($s[4] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[4], $wild)) ) 
                                    {
                                        $mpl = 1;
                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) && in_array($s[4], $wild) ) 
                                        {
                                            $mpl = 1;
                                        }
                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) || in_array($s[4], $wild) ) 
                                        {
                                            $mpl = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=basic&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i0=0%2C' . ($linesId[$k][0] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i1=1%2C' . ($linesId[$k][1] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i2=2%2C' . ($linesId[$k][2] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i3=3%2C' . ($linesId[$k][3] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i4=4%2C' . ($linesId[$k][4] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.multipliers=1&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=' . $k . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 * $slotSettings->CurrentDenomination * 100) . '';
                                            $_obf_0D1B23163B35245C1C1C2726192932403137111C102632 = $_obf_0D011C142C3C37263F351C4012170A074027083F321132;
                                        }
                                    }
                                }
                            }
                            if( $cWins[$k] > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                            {
                                array_push($lineWins, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                                $totalWin += $cWins[$k];
                                $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01++;
                            }
                        }
                        $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32 = '';
                        $_obf_0D0422223816021522032514083116023435011B112122 = [];
                        $scattersWin = 0;
                        $pickWin = 0;
                        $scattersStr = '';
                        $scattersCount = 0;
                        $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 = 0;
                        $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [];
                        $_obf_0D2D0B0612231C4023371E11031711091E3D0F380F2711 = [];
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                            {
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == $scatter ) 
                                {
                                    $scattersCount++;
                                    $_obf_0D312B19262C083426241E0D392E22282324060B380811[] = '&ws.i0.pos.i' . ($r - 1) . '=' . ($r - 1) . '%2C' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '';
                                }
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == 2 ) 
                                {
                                    $_obf_0D28301D333F2827165C2511011438180336175B1E2A01++;
                                    $_obf_0D2D0B0612231C4023371E11031711091E3D0F380F2711[] = '&ws.i0.pos.i' . ($r - 1) . '=' . ($r - 1) . '%2C' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '';
                                }
                            }
                        }
                        if( $scattersCount >= 3 ) 
                        {
                            $scattersStr = '&ws.i0.types.i0.freespins=' . $slotSettings->slotFreeCount[$scattersCount] . '&ws.i0.reelset=basic&ws.i0.betline=null&ws.i0.types.i0.wintype=freespins&ws.i0.direction=none' . implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811);
                        }
                        if( $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 3 ) 
                        {
                            $pickWinMpl = rand(5, 50);
                            $pickWin = $pickWinMpl * $allbet;
                            $slotSettings->SetGameData($slotSettings->slotId . 'pickWinMpl', $pickWinMpl);
                            $slotSettings->SetGameData($slotSettings->slotId . 'pickWin', $pickWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'pickReels', $reels);
                            $slotSettings->SetGameData($slotSettings->slotId . 'pickBet', $allbet);
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                                {
                                    if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '2' && $r > 3 ) 
                                    {
                                        $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32 .= ('&rs.i0.r.i' . ($r - 1) . '.attention.i0=' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '');
                                        $_obf_0D0422223816021522032514083116023435011B112122[] = $r - 1;
                                        break;
                                    }
                                }
                            }
                            $scattersStr = '&rs.i0.nearwin=' . implode('%2C', $_obf_0D0422223816021522032514083116023435011B112122) . '&gamestate.current=bonus&ws.i0.sym=SYM2&ws.i0.direction=none&gamestate.stack=basic%2Cbonus&ws.i0.types.i0.wintype=bonusgame&ws.i0.types.i0.bonusid=wildwildwestbonusgame' . implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811) . $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32;
                        }
                        $totalWin += ($scattersWin + $pickWin);
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
                            if( $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 3 && $winType != 'bonus' ) 
                            {
                            }
                            else if( $scattersCount >= 3 && $winType != 'bonus' ) 
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
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '&rs.i0.r.i0.syms=SYM' . $reels['reel1'][0] . '%2CSYM' . $reels['reel1'][1] . '%2CSYM' . $reels['reel1'][2] . '';
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
                        $_obf_0D0C28160A2A341E1517231808295C3C19221B2E142732 = [
                            'freespin_expanding', 
                            'freespin_multiplier', 
                            'freespin_regular', 
                            'freespin_spreading'
                        ];
                        $slotSettings->SetGameData($slotSettings->slotId . 'ReelsType', $_obf_0D0C28160A2A341E1517231808295C3C19221B2E142732[rand(0, 3)]);
                        $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $freeState = '&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19&freespins.totalwin.cents=0&nextaction=freespin&freespins.left=' . $fs . '&freespins.wavecount=1&freespins.multiplier=1&gamestate.stack=basic%2Cfreespin&freespins.totalwin.coins=0&freespins.total=' . $fs . '&freespins.win.cents=0&gamestate.current=freespin&freespins.initial=' . $fs . '&freespins.win.coins=0&freespins.betlevel=' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet') . '&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.nearwin=' . implode('%2C', $_obf_0D0422223816021522032514083116023435011B112122) . '&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '' . $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32;
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
                                if( $_obf_0D08170309223C210A33162F081F15360C221317110E32 >= 2 && $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 == 0 ) 
                                {
                                    $_obf_0D0422223816021522032514083116023435011B112122[] = $r - 1;
                                }
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '0' ) 
                                {
                                    $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32 .= ('&rs.i0.r.i' . ($r - 1) . '.attention.i0=' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '');
                                    $_obf_0D08170309223C210A33162F081F15360C221317110E32++;
                                }
                            }
                        }
                        $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32 .= ('&rs.i0.nearwin=' . implode('%2C', $_obf_0D0422223816021522032514083116023435011B112122));
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
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') > 0 ) 
                        {
                            $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'spin';
                            $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 = 'basic';
                            $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 = 'basic';
                        }
                        else
                        {
                            $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 = 'freespin';
                            $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'freespin';
                            $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 = 'basic%2Cfreespin';
                        }
                        $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $freeState = '&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19&freespins.totalwin.cents=0&nextaction=' . $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 . '&freespins.left=' . $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 . '&freespins.wavecount=1&freespins.multiplier=1&gamestate.stack=' . $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 . '&freespins.totalwin.coins=' . $totalWin . '&freespins.total=' . $fs . '&freespins.win.cents=' . ($totalWin / $slotSettings->CurrentDenomination * 100) . '&gamestate.current=' . $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 . '&freespins.initial=' . $fs . '&freespins.win.coins=' . $totalWin . '&freespins.betlevel=' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet') . '&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= $freeState;
                    }
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"GameDenom":' . $slotSettings->GetGameData($slotSettings->slotId . 'GameDenom') . ',"ReelsType":"' . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '","freeState":"' . $freeState . '","slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * $slotSettings->CurrentDenom * 100);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'rs.i0.r.i1.pos=11&gameServerVersion=1.0.0&g4mode=false&game.win.coins=' . $totalWin . '&playercurrency=%26%23x20AC%3B&playercurrencyiso=' . $slotSettings->slotCurrency . '&historybutton=false&rs.i0.r.i1.hold=false&current.rs.i0=' . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&rs.i0.r.i4.hold=false&next.rs=' . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&gamestate.history=basic&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=spin&rs.i0.r.i1.syms=SYM3%2CSYM9%2CSYM6&rs.i0.r.i2.hold=false&rs.i0.r.i4.syms=SYM5%2CSYM3%2CSYM6&game.win.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.r.i2.pos=62&rs.i0.id=' . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=0&gamestate.current=' . $slotSettings->GetGameData($slotSettings->slotId . 'ReelsType') . '&gameover=true&rs.i0.r.i0.hold=false&jackpotcurrency=%26%23x20AC%3B&freespins.multiplier=1&freespins.wavecount=1&multiplier=1&rs.i0.r.i3.pos=23&rs.i0.r.i4.pos=29&rs.i0.r.i0.syms=SYM4%2CSYM7%2CSYM9&rs.i0.r.i3.syms=SYM7%2CSYM8%2CSYM9&isJackpotWin=false&gamestate.stack=basic&nextaction=spin&rs.i0.r.i0.pos=30&wavecount=1&gamesoundurl=&rs.i0.r.i2.syms=SYM4%2CSYM10%2CSYM7&rs.i0.r.i3.hold=false&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . $scattersStr . $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 . $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32;
                    break;
            }
            $response = $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0];
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
