<?php 
namespace VanguardLTE\Games\JumanjiNET
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
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] = 'freespin';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'respin' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'respin';
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] = 'spin';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'shuffle' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'shuffle';
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] = 'spin';
                if( $slotSettings->GetGameData($slotSettings->slotId . 'ShuffleActive') != 1 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }
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
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.syms=SYM' . $reels->reel2[0] . '%2CSYM' . $reels->reel2[1] . '%2CSYM' . $reels->reel2[2] . '%2CSYM' . $reels->reel2[3] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.syms=SYM' . $reels->reel3[0] . '%2CSYM' . $reels->reel3[1] . '%2CSYM' . $reels->reel3[2] . '%2CSYM' . $reels->reel3[3] . '%2CSYM' . $reels->reel3[4] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.syms=SYM' . $reels->reel4[0] . '%2CSYM' . $reels->reel4[1] . '%2CSYM' . $reels->reel4[2] . '%2CSYM' . $reels->reel4[3] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.syms=SYM' . $reels->reel5[0] . '%2CSYM' . $reels->reel5[1] . '%2CSYM' . $reels->reel5[2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i0.syms=SYM' . $reels->reel1[0] . '%2CSYM' . $reels->reel1[1] . '%2CSYM' . $reels->reel1[2] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i1.syms=SYM' . $reels->reel2[0] . '%2CSYM' . $reels->reel2[1] . '%2CSYM' . $reels->reel2[2] . '%2CSYM' . $reels->reel2[3] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i2.syms=SYM' . $reels->reel3[0] . '%2CSYM' . $reels->reel3[1] . '%2CSYM' . $reels->reel3[2] . '%2CSYM' . $reels->reel3[3] . '%2CSYM' . $reels->reel3[4] . '');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i1.r.i3.syms=SYM' . $reels->reel4[0] . '%2CSYM' . $reels->reel4[1] . '%2CSYM' . $reels->reel4[2] . '%2CSYM' . $reels->reel4[3] . '');
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
                        $freeState = 'previous.rs.i0=freespinlevel0&rs.i1.r.i0.syms=SYM6%2CSYM3%2CSYM5&bl.i6.coins=1&rs.i8.r.i3.hold=false&bl.i17.reelset=ALL&bl.i15.id=15&rs.i0.r.i4.hold=false&rs.i9.r.i1.hold=false&gamestate.history=basic%2Cfreespin&rs.i1.r.i2.hold=false&rs.i8.r.i1.syms=SYM3%2CSYM9%2CSYM9&game.win.cents=685&rs.i7.r.i3.syms=SYM4%2CSYM8%2CSYM10&staticsharedurl=https%3A%2F%2Fstatic-shared.casinomodule.com%2Fgameclient_html%2Fdevicedetection%2Fcurrent&bl.i10.line=1%2C2%2C1%2C2%2C1&bl.i0.reelset=ALL&bl.i18.coins=1&bl.i10.id=10&freespins.initial=10&bl.i3.reelset=ALL&bl.i4.line=2%2C1%2C0%2C1%2C2&bl.i13.coins=1&rs.i2.r.i0.hold=false&rs.i0.r.i0.syms=SYM7%2CSYM4%2CSYM7&rs.i9.r.i3.hold=false&bl.i2.id=2&rs.i1.r.i1.pos=1&rs.i7.r.i1.syms=SYM0%2CSYM5%2CSYM10&rs.i3.r.i4.pos=0&rs.i6.r.i3.syms=SYM5%2CSYM4%2CSYM8&rs.i0.r.i0.pos=0&bl.i14.reelset=ALL&rs.i2.r.i3.pos=62&rs.i5.r.i1.overlay.i0.with=SYM1&rs.i5.r.i0.pos=5&rs.i7.id=basic&rs.i7.r.i3.pos=99&rs.i2.r.i4.hold=false&rs.i3.r.i1.pos=0&rs.i2.id=freespinlevel0respin&rs.i6.r.i1.pos=0&game.win.coins=137&rs.i1.r.i0.hold=false&bl.i3.id=3&ws.i1.reelset=freespinlevel0&bl.i12.coins=1&bl.i8.reelset=ALL&clientaction=init&rs.i4.r.i0.hold=false&rs.i0.r.i2.hold=false&rs.i4.r.i3.syms=SYM5%2CSYM4%2CSYM8&bl.i16.id=16&casinoID=netent&rs.i2.r.i3.overlay.i0.with=SYM1&bl.i5.coins=1&rs.i3.r.i2.hold=false&bl.i8.id=8&rs.i5.r.i1.syms=SYM6%2CSYM10%2CSYM1&rs.i7.r.i0.pos=42&rs.i7.r.i3.hold=false&rs.i0.r.i3.pos=0&rs.i4.r.i0.syms=SYM7%2CSYM4%2CSYM7&rs.i8.r.i1.pos=0&rs.i5.r.i3.pos=87&bl.i6.line=2%2C2%2C1%2C2%2C2&bl.i12.line=2%2C1%2C2%2C1%2C2&bl.i0.line=1%2C1%2C1%2C1%2C1&wild.w0.expand.position.row=2&rs.i4.r.i2.pos=0&rs.i0.r.i2.syms=SYM8%2CSYM8%2CSYM4&rs.i8.r.i1.hold=false&rs.i9.r.i2.pos=0&game.win.amount=6.85&betlevel.all=1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10&rs.i5.r.i2.hold=false&denomination.all=' . implode('%2C', $slotSettings->Denominations) . '&rs.i2.r.i0.pos=20&current.rs.i0=freespinlevel0respin&ws.i0.reelset=freespinlevel0&rs.i7.r.i2.pos=91&bl.i1.id=1&rs.i3.r.i2.syms=SYM10%2CSYM10%2CSYM5&rs.i1.r.i4.pos=10&rs.i8.id=freespinlevel3&denomination.standard=' . ($slotSettings->CurrentDenomination * 100) . '&rs.i3.id=freespinlevel1&multiplier=1&bl.i14.id=14&wild.w0.expand.position.reel=1&bl.i19.line=0%2C2%2C2%2C2%2C0&freespins.denomination=5.000&bl.i12.reelset=ALL&bl.i2.coins=1&bl.i6.id=6&autoplay=10%2C25%2C50%2C75%2C100%2C250%2C500%2C750%2C1000&freespins.totalwin.coins=137&ws.i0.direction=left_to_right&freespins.total=10&gamestate.stack=basic%2Cfreespin&rs.i6.r.i2.pos=0&rs.i1.r.i4.syms=SYM9%2CSYM9%2CSYM5&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i5.r.i2.syms=SYM10%2CSYM7%2CSYM4&rs.i5.r.i3.hold=false&bet.betlevel=1&rs.i2.r.i3.overlay.i0.pos=63&rs.i4.r.i2.hold=false&bl.i5.reelset=ALL&rs.i4.r.i1.syms=SYM7%2CSYM7%2CSYM3&bl.i19.coins=1&bl.i7.id=7&bl.i18.reelset=ALL&rs.i2.r.i4.pos=2&rs.i3.r.i0.syms=SYM7%2CSYM4%2CSYM7&rs.i8.r.i4.pos=0&playercurrencyiso=' . $slotSettings->slotCurrency . '&bl.i1.coins=1&rs.i2.r.i3.overlay.i0.row=1&rs.i4.r.i1.hold=false&rs.i3.r.i2.pos=0&bl.i14.line=1%2C1%2C2%2C1%2C1&freespins.multiplier=1&playforfun=false&rs.i8.r.i0.hold=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM6%2CSYM10%2CSYM9&rs.i0.r.i2.pos=0&bl.i13.line=1%2C1%2C0%2C1%2C1&rs.i6.r.i3.pos=0&ws.i1.betline=13&rs.i1.r.i0.pos=10&rs.i6.r.i3.hold=false&bl.i0.coins=1&rs.i2.r.i0.syms=SYM7%2CSYM7%2CSYM8&bl.i2.reelset=ALL&rs.i3.r.i1.syms=SYM3%2CSYM9%2CSYM9&rs.i1.r.i4.hold=false&freespins.left=6&rs.i9.r.i3.pos=0&rs.i4.r.i1.pos=0&rs.i4.r.i2.syms=SYM8%2CSYM8%2CSYM4&bl.standard=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19&rs.i5.r.i3.syms=SYM3%2CSYM9%2CSYM9&rs.i3.r.i0.hold=false&rs.i9.r.i1.syms=SYM3%2CSYM9%2CSYM9&rs.i6.r.i4.syms=SYM6%2CSYM10%2CSYM4&rs.i8.r.i0.syms=SYM7%2CSYM4%2CSYM7&rs.i8.r.i0.pos=0&bl.i15.reelset=ALL&rs.i0.r.i3.hold=false&bet.denomination=5&rs.i5.r.i4.pos=4&rs.i9.id=freespinlevel2&rs.i4.id=freespinlevel3respin&rs.i7.r.i2.syms=SYM9%2CSYM4%2CSYM10&rs.i2.r.i1.hold=false&gameServerVersion=1.5.0&g4mode=false&bl.i11.line=0%2C1%2C0%2C1%2C0&freespins.win.coins=8&historybutton=false&bl.i5.id=5&gameEventSetters.enabled=false&next.rs=freespinlevel0respin&rs.i1.r.i3.pos=2&rs.i0.r.i1.syms=SYM7%2CSYM7%2CSYM3&bl.i3.coins=1&ws.i1.types.i0.coins=4&bl.i10.coins=1&bl.i18.id=18&rs.i2.r.i1.pos=12&rs.i7.r.i4.hold=false&rs.i4.r.i4.pos=0&rs.i8.r.i2.hold=false&ws.i0.betline=4&rs.i1.r.i3.hold=false&rs.i7.r.i1.pos=123&totalwin.coins=137&rs.i5.r.i4.syms=SYM6%2CSYM6%2CSYM9&rs.i9.r.i4.pos=0&bl.i5.line=0%2C0%2C1%2C0%2C0&gamestate.current=freespin&rs.i4.r.i0.pos=0&jackpotcurrency=%26%23x20AC%3B&bl.i7.line=1%2C2%2C2%2C2%2C1&rs.i8.r.i2.syms=SYM10%2CSYM10%2CSYM5&rs.i9.r.i0.hold=false&bet.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19&rs.i3.r.i1.hold=false&rs.i9.r.i0.syms=SYM7%2CSYM4%2CSYM7&rs.i7.r.i4.syms=SYM0%2CSYM9%2CSYM7&rs.i0.r.i3.syms=SYM5%2CSYM4%2CSYM8&rs.i1.r.i1.syms=SYM7%2CSYM7%2CSYM6&bl.i16.coins=1&rs.i5.r.i1.overlay.i0.pos=22&freespins.win.cents=40&bl.i9.coins=1&bl.i7.reelset=ALL&isJackpotWin=false&rs.i6.r.i4.hold=false&rs.i2.r.i3.hold=false&wild.w0.expand.type=NONE&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19&rs.i0.r.i1.pos=0&rs.i4.r.i4.syms=SYM6%2CSYM10%2CSYM9&rs.i1.r.i3.syms=SYM7%2CSYM6%2CSYM8&bl.i13.id=13&rs.i0.r.i1.hold=false&rs.i2.r.i1.syms=SYM10%2CSYM4%2CSYM10&ws.i1.types.i0.wintype=coins&rs.i9.r.i2.syms=SYM10%2CSYM10%2CSYM5&bl.i9.line=1%2C0%2C1%2C0%2C1&rs.i8.r.i4.syms=SYM6%2CSYM9%2CSYM9&rs.i9.r.i0.pos=0&rs.i8.r.i3.pos=0&ws.i1.sym=SYM10&betlevel.standard=1&bl.i10.reelset=ALL&ws.i1.types.i0.cents=20&rs.i6.r.i2.syms=SYM8%2CSYM6%2CSYM4&rs.i7.r.i0.syms=SYM5%2CSYM7%2CSYM0&gameover=false&rs.i3.r.i3.pos=0&rs.i5.id=freespinlevel0&rs.i7.r.i0.hold=false&rs.i6.r.i4.pos=0&bl.i11.coins=1&rs.i5.r.i1.hold=false&ws.i1.direction=left_to_right&rs.i5.r.i4.hold=false&rs.i6.r.i2.hold=false&bl.i13.reelset=ALL&bl.i0.id=0&rs.i9.r.i2.hold=false&nextaction=respin&bl.i15.line=0%2C1%2C1%2C1%2C0&bl.i3.line=0%2C1%2C2%2C1%2C0&bl.i19.id=19&bl.i4.reelset=ALL&rs.i7.r.i1.attention.i0=0&bl.i4.coins=1&bl.i18.line=2%2C0%2C2%2C0%2C2&rs.i8.r.i4.hold=false&freespins.totalwin.cents=685&bl.i9.id=9&bl.i17.line=0%2C2%2C0%2C2%2C0&bl.i11.id=11&freespins.betlevel=1&ws.i0.pos.i2=2%2C0&rs.i4.r.i3.pos=0&playercurrency=%26%23x20AC%3B&bl.i9.reelset=ALL&rs.i4.r.i4.hold=false&bl.i17.coins=1&ws.i1.pos.i0=1%2C1&ws.i1.pos.i1=0%2C1&ws.i1.pos.i2=2%2C0&ws.i0.pos.i1=0%2C2&rs.i5.r.i0.syms=SYM9%2CSYM10%2CSYM10&bl.i19.reelset=ALL&ws.i0.pos.i0=1%2C1&rs.i2.r.i4.syms=SYM4%2CSYM8%2CSYM8&rs.i7.r.i4.pos=41&rs.i4.r.i3.hold=false&rs.i6.r.i0.hold=false&bl.i11.reelset=ALL&bl.i16.line=2%2C1%2C1%2C1%2C2&rs.i0.id=freespinlevel2respin&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&ws.i0.types.i0.coins=4&rs.i9.r.i3.syms=SYM6%2CSYM7%2CSYM7&bl.i1.reelset=ALL&rs.i2.r.i2.pos=19&last.rs=freespinlevel0&rs.i5.r.i1.overlay.i0.row=2&rs.i5.r.i1.pos=20&bl.i1.line=0%2C0%2C0%2C0%2C0&ws.i0.sym=SYM10&rs.i6.r.i0.syms=SYM7%2CSYM4%2CSYM7&rs.i6.r.i1.hold=false&bl.i17.id=17&rs.i2.r.i2.syms=SYM4%2CSYM6%2CSYM7&rs.i1.r.i2.pos=19&bl.i16.reelset=ALL&rs.i3.r.i3.syms=SYM6%2CSYM7%2CSYM7&ws.i0.types.i0.wintype=coins&rs.i3.r.i4.hold=false&rs.i5.r.i0.hold=false&nearwinallowed=true&collectablesWon=2&rs.i9.r.i1.pos=0&bl.i8.line=1%2C0%2C0%2C0%2C1&rs.i7.r.i2.hold=false&rs.i6.r.i1.syms=SYM5%2CSYM9%2CSYM9&freespins.wavecount=1&rs.i3.r.i3.hold=false&rs.i6.r.i0.pos=0&bl.i8.coins=1&bl.i15.coins=1&bl.i2.line=2%2C2%2C2%2C2%2C2&rs.i1.r.i2.syms=SYM8%2CSYM4%2CSYM3&rs.i7.nearwin=4%2C2%2C3&rs.i9.r.i4.hold=false&rs.i6.id=freespinlevel1respin&totalwin.cents=685&rs.i7.r.i1.hold=false&rs.i5.r.i2.pos=98&rs.i0.r.i0.hold=false&rs.i2.r.i3.syms=SYM9%2CSYM9%2CSYM5&rs.i8.r.i2.pos=0&restore=true&rs.i1.id=basicrespin&rs.i3.r.i4.syms=SYM6%2CSYM9%2CSYM9&bl.i12.id=12&bl.i4.id=4&rs.i0.r.i4.pos=0&bl.i7.coins=1&ws.i0.types.i0.cents=20&bl.i6.reelset=ALL&rs.i3.r.i0.pos=0&rs.i2.r.i2.hold=false&rs.i7.r.i0.attention.i0=2&wavecount=1&rs.i9.r.i4.syms=SYM6%2CSYM9%2CSYM9&bl.i14.coins=1&rs.i8.r.i3.syms=SYM6%2CSYM7%2CSYM7&rs.i1.r.i1.hold=false&rs.i7.r.i4.attention.i0=0' . $freeState;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'bl.i32.reelset=ALL&rs.i1.r.i0.syms=SYM7&bl.i6.coins=0&bl.i17.reelset=ALL&bl.i15.id=15&rs.i0.r.i4.hold=false&rs.i1.r.i15.pos=0&rs.i1.r.i2.hold=false&bl.i21.id=21&game.win.cents=0&staticsharedurl=https%3A%2F%2Fstatic-shared.casinomodule.com%2Fgameclient_html%2Fdevicedetection%2Fcurrent&bl.i23.reelset=ALL&bl.i33.coins=0&rs.i1.r.i11.syms=SYM11&bl.i10.line=0%2C1%2C2%2C2%2C2&bl.i0.reelset=ALL&bl.i20.coins=0&bl.i18.coins=0&bl.i10.id=10&bl.i3.reelset=ALL&bl.i4.line=0%2C1%2C1%2C0%2C0&bl.i13.coins=0&bl.i26.reelset=ALL&bl.i24.line=1%2C2%2C3%2C3%2C2&bl.i27.id=27&rs.i2.r.i0.hold=false&rs.i0.r.i0.syms=SYM6%2CSYM6%2CSYM7&bl.i2.id=2&rs.i1.r.i1.pos=0&feature.sticky.active=false&rs.i1.r.i13.hold=false&rs.i0.r.i0.pos=0&bl.i14.reelset=ALL&rs.i2.r.i3.pos=2&feature.wildreels.active=false&rs.i2.r.i4.hold=false&rs.i1.r.i9.syms=SYM11&rs.i2.id=basic&game.win.coins=0&bl.i28.line=2%2C2%2C2%2C2%2C2&rs.i1.r.i0.hold=false&bl.i3.id=3&bl.i22.line=1%2C2%2C3%2C2%2C1&rs.i1.r.i13.syms=SYM7&bl.i12.coins=0&bl.i8.reelset=ALL&clientaction=init&rs.i0.r.i2.hold=false&bl.i16.id=16&rs.i1.r.i15.hold=false&casinoID=netent&rs.i1.r.i8.pos=0&bl.i5.coins=0&rs.i1.r.i6.hold=false&bl.i8.id=8&rs.i0.r.i3.pos=0&bl.i33.id=33&bl.i6.line=0%2C1%2C1%2C1%2C1&bl.i22.id=22&bl.i12.line=1%2C1%2C1%2C1%2C0&bl.i0.line=0%2C0%2C0%2C0%2C0&bl.i29.reelset=ALL&bl.i34.line=2%2C3%2C3%2C3%2C2&bl.i31.line=2%2C2%2C3%2C3%2C2&rs.i0.r.i2.syms=SYM7%2CSYM7%2CSYM6%2CSYM6%2CSYM5&bl.i34.coins=0&game.win.amount=0&betlevel.all=1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10&rs.i1.r.i6.syms=SYM11&denomination.all=' . implode('%2C', $slotSettings->Denominations) . '&bl.i27.coins=0&bl.i34.reelset=ALL&rs.i2.r.i0.pos=0&bl.i30.reelset=ALL&bl.i1.id=1&bl.i33.line=2%2C3%2C3%2C2%2C2&bl.i25.id=25&rs.i1.r.i9.hold=false&rs.i1.r.i5.syms=SYM7&rs.i1.r.i4.pos=0&denomination.standard=' . ($slotSettings->CurrentDenomination * 100) . '&bl.i31.id=31&bl.i32.line=2%2C3%2C3%2C2%2C1&multiplier=1&bl.i14.id=14&bl.i19.line=1%2C2%2C2%2C1%2C1&bl.i12.reelset=ALL&bl.i2.coins=0&bl.i6.id=6&bl.i21.reelset=ALL&autoplay=10%2C25%2C50%2C75%2C100%2C250%2C500%2C750%2C1000&rs.i1.r.i15.syms=SYM11&bl.i20.id=20&rs.i1.r.i12.pos=0&rs.i1.r.i4.syms=SYM7&feature.shuffle.active=false&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&bl.i33.reelset=ALL&bl.i5.reelset=ALL&bl.i24.coins=0&rs.i1.r.i11.pos=0&bl.i19.coins=0&bl.i32.coins=0&bl.i7.id=7&bl.i18.reelset=ALL&rs.i2.r.i4.pos=0&playercurrencyiso=' . $slotSettings->slotCurrency . '&bl.i1.coins=0&bl.i32.id=32&bl.i14.line=1%2C1%2C2%2C1%2C0&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM8%2CSYM8%2CSYM7&rs.i1.r.i9.pos=0&bl.i25.coins=0&rs.i0.r.i2.pos=0&bl.i13.line=1%2C1%2C1%2C1%2C1&bl.i24.reelset=ALL&rs.i1.r.i0.pos=0&rs.i1.r.i14.syms=SYM7&bl.i0.coins=10&rs.i2.r.i0.syms=SYM9%2CSYM9%2CSYM10&bl.i2.reelset=ALL&rs.i1.r.i5.pos=0&bl.i31.coins=0&rs.i1.r.i4.hold=false&bl.i26.coins=0&bl.i27.reelset=ALL&rs.i1.r.i14.hold=false&bl.standard=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19%2C20%2C21%2C22%2C23%2C24%2C25%2C26%2C27%2C28%2C29%2C30%2C31%2C32%2C33%2C34%2C35&bl.i29.line=2%2C2%2C3%2C2%2C1&bl.i23.line=1%2C2%2C3%2C2%2C2&bl.i26.id=26&bl.i15.reelset=ALL&rs.i0.r.i3.hold=false&rs.i1.r.i16.pos=0&rs.i2.r.i1.hold=false&gameServerVersion=2.0.1&g4mode=false&bl.i11.line=1%2C1%2C1%2C0%2C0&bl.i30.id=30&feature.randomwilds.active=false&historybutton=false&bl.i25.line=2%2C2%2C2%2C1%2C0&bl.i5.id=5&gameEventSetters.enabled=false&rs.i1.r.i10.syms=SYM7&rs.i1.r.i3.pos=0&rs.i0.r.i1.syms=SYM4%2CSYM4%2CSYM7%2CSYM7&rs.i1.r.i17.pos=0&bl.i3.coins=0&bl.i10.coins=0&bl.i18.id=18&rs.i2.r.i1.pos=1&rs.i1.r.i12.hold=false&bl.i30.coins=0&nextclientrs=basic&rs.i1.r.i3.hold=false&totalwin.coins=0&bl.i5.line=0%2C1%2C1%2C1%2C0&gamestate.current=basic&bl.i28.coins=0&bl.i27.line=2%2C2%2C2%2C2%2C1&jackpotcurrency=%26%23x20AC%3B&bl.i7.line=0%2C1%2C2%2C1%2C0&bl.i35.id=35&rs.i1.r.i13.pos=0&rs.i0.r.i3.syms=SYM4%2CSYM4%2CSYM8%2CSYM8&rs.i1.r.i1.syms=SYM7&bl.i16.coins=0&bl.i9.coins=0&bl.i30.line=2%2C2%2C3%2C2%2C2&bl.i7.reelset=ALL&isJackpotWin=false&rs.i1.r.i5.hold=false&rs.i2.r.i3.hold=false&rs.i1.r.i12.syms=SYM11&bl.i24.id=24&rs.i1.r.i10.hold=false&rs.i0.r.i1.pos=0&bl.i22.coins=0&rs.i1.r.i3.syms=SYM11&bl.i29.coins=0&bl.i31.reelset=ALL&bl.i13.id=13&rs.i0.r.i1.hold=false&rs.i2.r.i1.syms=SYM8%2CSYM8%2CSYM0%2CSYM7&bl.i9.line=0%2C1%2C2%2C2%2C1&rs.i1.r.i10.pos=0&bl.i35.coins=0&betlevel.standard=1&bl.i10.reelset=ALL&gameover=true&bl.i25.reelset=ALL&bl.i23.coins=0&bl.i11.coins=0&bl.i22.reelset=ALL&bl.i13.reelset=ALL&bl.i0.id=0&nextaction=spin&bl.i15.line=1%2C1%2C2%2C1%2C1&bl.i3.line=0%2C0%2C1%2C1%2C1&bl.i19.id=19&bl.i4.reelset=ALL&bl.i4.coins=0&rs.i1.r.i6.pos=0&bl.i18.line=1%2C2%2C2%2C1%2C0&bl.i9.id=9&bl.i34.id=34&bl.i17.line=1%2C1%2C2%2C2%2C2&bl.i11.id=11&playercurrency=%26%23x20AC%3B&rs.i1.r.i16.syms=SYM11&bl.i9.reelset=ALL&bl.i17.coins=0&bl.i28.id=28&bl.i19.reelset=ALL&rs.i2.r.i4.syms=SYM4%2CSYM4%2CSYM9&bl.i11.reelset=ALL&bl.i16.line=1%2C1%2C2%2C2%2C1&rs.i1.r.i18.hold=false&rs.i0.id=freespin&rs.i1.r.i14.pos=0&rs.i1.r.i17.syms=SYM7&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&rs.i1.r.i18.pos=0&bl.i21.line=1%2C2%2C2%2C2%2C2&bl.i35.line=2%2C3%2C4%2C3%2C2&bl.i1.reelset=ALL&rs.i2.r.i2.pos=5&bl.i21.coins=0&bl.i28.reelset=ALL&bl.i1.line=0%2C0%2C1%2C0%2C0&rs.i1.r.i8.hold=false&rs.i1.r.i16.hold=false&bl.i17.id=17&rs.i2.r.i2.syms=SYM6%2CSYM6%2CSYM7%2CSYM7%2CSYM9&rs.i1.r.i2.pos=0&bl.i16.reelset=ALL&rs.i1.r.i7.syms=SYM11&nearwinallowed=true&bl.i8.line=0%2C1%2C2%2C1%2C1&bl.i35.reelset=ALL&rs.i1.r.i7.pos=0&rs.i1.r.i18.syms=SYM11&rs.i1.r.i8.syms=SYM7&bl.i8.coins=0&bl.i23.id=23&bl.i15.coins=0&bl.i2.line=0%2C0%2C1%2C1%2C0&rs.i1.r.i2.syms=SYM7&totalwin.cents=0&rs.i1.r.i11.hold=false&rs.i0.r.i0.hold=false&rs.i1.r.i7.hold=false&rs.i2.r.i3.syms=SYM8%2CSYM8%2CSYM10%2CSYM10&restore=false&rs.i1.id=respin&bl.i12.id=12&bl.i29.id=29&rs.i1.r.i17.hold=false&bl.i4.id=4&rs.i0.r.i4.pos=0&bl.i7.coins=0&bl.i6.reelset=ALL&bl.i20.line=1%2C2%2C2%2C2%2C1&rs.i2.r.i2.hold=false&bl.i20.reelset=ALL&wavecount=1&bl.i14.coins=0&rs.i1.r.i1.hold=false&bl.i26.line=2%2C2%2C2%2C1%2C1' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32;
                    break;
                case 'paytable':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'bl.i32.reelset=ALL&pt.i0.comp.i19.symbol=SYM9&bl.i6.coins=0&bl.i17.reelset=ALL&pt.i0.comp.i15.type=betline&pt.i0.comp.i23.freespins=0&bl.i15.id=15&pt.i0.comp.i4.multi=15&pt.i0.comp.i15.symbol=SYM8&pt.i0.comp.i17.symbol=SYM8&pt.i0.comp.i5.freespins=0&pt.i0.comp.i22.multi=3&pt.i0.comp.i23.n=5&bl.i21.id=21&pt.i0.comp.i11.symbol=SYM6&pt.i0.comp.i13.symbol=SYM7&bl.i23.reelset=ALL&bl.i33.coins=0&pt.i0.comp.i15.multi=2&bl.i10.line=0%2C1%2C2%2C2%2C2&bl.i0.reelset=ALL&bl.i20.coins=0&pt.i0.comp.i16.freespins=0&bl.i18.coins=0&bl.i10.id=10&pt.i0.comp.i11.n=5&pt.i0.comp.i4.freespins=0&bl.i3.reelset=ALL&bl.i4.line=0%2C1%2C1%2C0%2C0&bl.i13.coins=0&bl.i26.reelset=ALL&bl.i24.line=1%2C2%2C3%2C3%2C2&bl.i27.id=27&pt.i0.comp.i19.n=4&pt.i0.id=basic&pt.i0.comp.i1.type=betline&bl.i2.id=2&pt.i0.comp.i2.symbol=SYM3&pt.i0.comp.i4.symbol=SYM4&pt.i0.comp.i20.type=betline&bl.i14.reelset=ALL&pt.i0.comp.i17.freespins=0&pt.i0.comp.i6.symbol=SYM5&pt.i0.comp.i8.symbol=SYM5&pt.i0.comp.i0.symbol=SYM3&pt.i0.comp.i5.n=5&pt.i0.comp.i3.type=betline&pt.i0.comp.i3.freespins=0&pt.i0.comp.i10.multi=8&bl.i28.line=2%2C2%2C2%2C2%2C2&bl.i3.id=3&bl.i22.line=1%2C2%2C3%2C2%2C1&pt.i0.comp.i9.multi=3&bl.i12.coins=0&pt.i0.comp.i22.symbol=SYM10&pt.i0.comp.i26.symbol=SYM0&pt.i0.comp.i24.n=3&bl.i8.reelset=ALL&pt.i0.comp.i14.freespins=0&pt.i0.comp.i21.freespins=0&clientaction=paytable&bl.i16.id=16&bl.i5.coins=0&pt.i0.comp.i22.type=betline&pt.i0.comp.i24.freespins=0&bl.i8.id=8&pt.i0.comp.i16.multi=4&pt.i0.comp.i21.multi=2&bl.i33.id=33&pt.i0.comp.i12.n=3&bl.i6.line=0%2C1%2C1%2C1%2C1&bl.i22.id=22&pt.i0.comp.i13.type=betline&bl.i12.line=1%2C1%2C1%2C1%2C0&bl.i0.line=0%2C0%2C0%2C0%2C0&bl.i29.reelset=ALL&pt.i0.comp.i19.type=betline&pt.i0.comp.i6.freespins=0&bl.i34.line=2%2C3%2C3%2C3%2C2&bl.i31.line=2%2C2%2C3%2C3%2C2&pt.i0.comp.i3.multi=5&bl.i34.coins=0&pt.i0.comp.i6.n=3&pt.i0.comp.i21.n=3&bl.i27.coins=0&bl.i34.reelset=ALL&bl.i30.reelset=ALL&bl.i1.id=1&bl.i33.line=2%2C3%2C3%2C2%2C2&pt.i0.comp.i10.type=betline&bl.i25.id=25&pt.i0.comp.i2.freespins=0&pt.i0.comp.i5.multi=50&pt.i0.comp.i7.n=4&bl.i31.id=31&bl.i32.line=2%2C3%2C3%2C2%2C1&pt.i0.comp.i11.multi=25&bl.i14.id=14&pt.i0.comp.i7.type=betline&bl.i19.line=1%2C2%2C2%2C1%2C1&bl.i12.reelset=ALL&pt.i0.comp.i17.n=5&bl.i2.coins=0&bl.i6.id=6&bl.i21.reelset=ALL&pt.i0.comp.i8.freespins=0&bl.i20.id=20&pt.i0.comp.i8.multi=30&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&pt.i0.comp.i1.freespins=0&pt.i0.comp.i12.type=betline&pt.i0.comp.i14.multi=10&bl.i33.reelset=ALL&bl.i5.reelset=ALL&bl.i24.coins=0&pt.i0.comp.i22.n=4&bl.i19.coins=0&bl.i32.coins=0&bl.i7.id=7&bl.i18.reelset=ALL&pt.i0.comp.i6.multi=4&playercurrencyiso=' . $slotSettings->slotCurrency . '&bl.i1.coins=0&bl.i32.id=32&bl.i14.line=1%2C1%2C2%2C1%2C0&pt.i0.comp.i18.type=betline&pt.i0.comp.i23.symbol=SYM10&pt.i0.comp.i21.type=betline&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&pt.i0.comp.i8.type=betline&pt.i0.comp.i7.freespins=0&pt.i0.comp.i2.type=betline&pt.i0.comp.i13.multi=4&bl.i25.coins=0&pt.i0.comp.i17.type=betline&bl.i13.line=1%2C1%2C1%2C1%2C1&bl.i24.reelset=ALL&bl.i0.coins=10&bl.i2.reelset=ALL&pt.i0.comp.i8.n=5&pt.i0.comp.i10.n=4&bl.i31.coins=0&pt.i0.comp.i11.type=betline&pt.i0.comp.i18.n=3&pt.i0.comp.i22.freespins=0&bl.i26.coins=0&bl.i27.reelset=ALL&pt.i0.comp.i20.symbol=SYM9&bl.i29.line=2%2C2%2C3%2C2%2C1&pt.i0.comp.i15.freespins=0&bl.i23.line=1%2C2%2C3%2C2%2C2&bl.i26.id=26&pt.i0.comp.i0.n=3&pt.i0.comp.i7.symbol=SYM5&bl.i15.reelset=ALL&pt.i0.comp.i0.type=betline&gameServerVersion=2.0.1&g4mode=false&bl.i11.line=1%2C1%2C1%2C0%2C0&bl.i30.id=30&pt.i0.comp.i25.multi=0&historybutton=false&bl.i25.line=2%2C2%2C2%2C1%2C0&pt.i0.comp.i16.symbol=SYM8&bl.i5.id=5&pt.i0.comp.i1.multi=20&pt.i0.comp.i18.symbol=SYM9&pt.i0.comp.i12.multi=2&bl.i3.coins=0&bl.i10.coins=0&pt.i0.comp.i12.symbol=SYM7&pt.i0.comp.i14.symbol=SYM7&bl.i18.id=18&pt.i0.comp.i14.type=betline&bl.i30.coins=0&pt.i0.comp.i18.multi=2&bl.i5.line=0%2C1%2C1%2C1%2C0&pt.i0.comp.i7.multi=10&bl.i28.coins=0&pt.i0.comp.i9.n=3&bl.i27.line=2%2C2%2C2%2C2%2C1&jackpotcurrency=%26%23x20AC%3B&bl.i7.line=0%2C1%2C2%2C1%2C0&bl.i35.id=35&pt.i0.comp.i10.symbol=SYM6&pt.i0.comp.i15.n=3&bl.i16.coins=0&bl.i9.coins=0&bl.i30.line=2%2C2%2C3%2C2%2C2&pt.i0.comp.i21.symbol=SYM10&bl.i7.reelset=ALL&isJackpotWin=false&bl.i24.id=24&pt.i0.comp.i1.n=4&bl.i22.coins=0&pt.i0.comp.i10.freespins=0&pt.i0.comp.i20.multi=8&pt.i0.comp.i20.n=5&pt.i0.comp.i17.multi=9&bl.i29.coins=0&bl.i31.reelset=ALL&bl.i13.id=13&pt.i0.comp.i25.symbol=SYM0&pt.i0.comp.i26.type=bonus&pt.i0.comp.i9.type=betline&bl.i9.line=0%2C1%2C2%2C2%2C1&pt.i0.comp.i2.multi=140&pt.i0.comp.i0.freespins=0&bl.i35.coins=0&bl.i10.reelset=ALL&bl.i25.reelset=ALL&pt.i0.comp.i9.symbol=SYM6&bl.i23.coins=0&bl.i11.coins=0&pt.i0.comp.i16.n=4&bl.i22.reelset=ALL&bl.i13.reelset=ALL&bl.i0.id=0&pt.i0.comp.i16.type=betline&pt.i0.comp.i5.symbol=SYM4&bl.i15.line=1%2C1%2C2%2C1%2C1&bl.i3.line=0%2C0%2C1%2C1%2C1&bl.i19.id=19&bl.i4.reelset=ALL&bl.i4.coins=0&pt.i0.comp.i2.n=5&pt.i0.comp.i1.symbol=SYM3&bl.i18.line=1%2C2%2C2%2C1%2C0&bl.i9.id=9&bl.i34.id=34&pt.i0.comp.i19.freespins=0&bl.i17.line=1%2C1%2C2%2C2%2C2&bl.i11.id=11&pt.i0.comp.i6.type=betline&playercurrency=%26%23x20AC%3B&bl.i9.reelset=ALL&bl.i17.coins=0&bl.i28.id=28&bl.i19.reelset=ALL&pt.i0.comp.i25.n=4&pt.i0.comp.i9.freespins=0&bl.i11.reelset=ALL&bl.i16.line=1%2C1%2C2%2C2%2C1&credit=500000&pt.i0.comp.i5.type=betline&pt.i0.comp.i11.freespins=0&pt.i0.comp.i26.multi=0&bl.i21.line=1%2C2%2C2%2C2%2C2&pt.i0.comp.i25.type=bonus&bl.i35.line=2%2C3%2C4%2C3%2C2&bl.i1.reelset=ALL&pt.i0.comp.i4.type=betline&bl.i21.coins=0&bl.i28.reelset=ALL&pt.i0.comp.i13.freespins=0&pt.i0.comp.i26.freespins=0&bl.i1.line=0%2C0%2C1%2C0%2C0&pt.i0.comp.i13.n=4&pt.i0.comp.i20.freespins=0&pt.i0.comp.i23.type=betline&bl.i17.id=17&bl.i16.reelset=ALL&pt.i0.comp.i3.n=3&pt.i0.comp.i25.freespins=0&bl.i8.line=0%2C1%2C2%2C1%2C1&pt.i0.comp.i24.symbol=SYM0&bl.i35.reelset=ALL&pt.i0.comp.i26.n=5&bl.i8.coins=0&bl.i23.id=23&bl.i15.coins=0&pt.i0.comp.i23.multi=7&bl.i2.line=0%2C0%2C1%2C1%2C0&pt.i0.comp.i18.freespins=0&bl.i12.id=12&bl.i29.id=29&bl.i4.id=4&bl.i7.coins=0&pt.i0.comp.i14.n=5&pt.i0.comp.i0.multi=6&bl.i6.reelset=ALL&pt.i0.comp.i19.multi=3&pt.i0.comp.i3.symbol=SYM4&bl.i20.line=1%2C2%2C2%2C2%2C1&pt.i0.comp.i24.type=bonus&bl.i20.reelset=ALL&bl.i14.coins=0&pt.i0.comp.i12.freespins=0&pt.i0.comp.i4.n=4&bl.i26.line=2%2C2%2C2%2C1%2C1&pt.i0.comp.i24.multi=0';
                case 'initfreespin':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'rs.i2.r.i1.hold=false&rs.i1.r.i0.syms=SYM7&gameServerVersion=2.0.1&g4mode=false&freespins.win.coins=0&rs.i0.nearwin=4%2C3&feature.randomwilds.active=false&historybutton=false&sub.sym12.r4=sym3&rs.i0.r.i1.attention.i0=3&rs.i0.r.i4.hold=false&sub.sym12.r3=sym3&rs.i1.r.i15.pos=0&next.rs=freespin&sub.sym12.r2=sym3&gamestate.history=basic%2Cbonus&sub.sym12.r1=sym3&sub.sym12.r0=sym3&rs.i1.r.i10.syms=SYM7&rs.i1.r.i2.hold=false&rs.i1.r.i3.pos=0&rs.i0.r.i1.syms=SYM6%2CSYM8%2CSYM8%2CSYM0&rs.i1.r.i17.pos=0&rs.i2.r.i1.pos=0&game.win.cents=44&rs.i1.r.i12.hold=false&rs.i1.r.i11.syms=SYM11&nextclientrs=shuffle&rs.i1.r.i3.hold=false&totalwin.coins=44&gamestate.current=freespin&freespins.initial=6&jackpotcurrency=%26%23x20AC%3B&bet.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19%2C20%2C21%2C22%2C23%2C24%2C25%2C26%2C27%2C28%2C29%2C30%2C31%2C32%2C33%2C34%2C35&rs.i2.r.i0.hold=false&bonus.rollsleft=3&rs.i0.r.i0.syms=SYM1%2CSYM10%2CSYM10&rs.i1.r.i13.pos=0&rs.i0.r.i3.syms=SYM6%2CSYM6%2CSYM9%2CSYM9&rs.i1.r.i1.syms=SYM7&rs.i1.r.i1.pos=0&feature.sticky.active=false&freespins.win.cents=0&isJackpotWin=false&rs.i1.r.i5.hold=false&rs.i1.r.i13.hold=false&rs.i0.r.i0.pos=95&rs.i2.r.i3.hold=false&rs.i1.r.i12.syms=SYM11&rs.i2.r.i3.pos=0&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19%2C20%2C21%2C22%2C23%2C24%2C25%2C26%2C27%2C28%2C29%2C30%2C31%2C32%2C33%2C34%2C35&feature.wildreels.active=false&rs.i1.r.i10.hold=false&rs.i0.r.i1.pos=0&rs.i1.r.i3.syms=SYM11&rs.i2.r.i4.hold=false&rs.i1.r.i9.syms=SYM11&rs.i2.id=freespin&game.win.coins=44&rs.i1.r.i0.hold=false&rs.i0.r.i1.hold=false&rs.i2.r.i1.syms=SYM4%2CSYM4%2CSYM7%2CSYM7&rs.i1.r.i13.syms=SYM7&clientaction=initfreespin&sub.sym13.r0=sym4&sub.sym13.r1=sym4&rs.i0.r.i2.hold=false&sub.sym13.r2=sym4&sub.sym13.r3=sym4&rs.i1.r.i10.pos=0&sub.sym13.r4=sym4&rs.i1.r.i15.hold=false&rs.i1.r.i8.pos=0&bonus.token=rhino&gameover=false&rs.i1.r.i6.hold=false&bonus.board.position=20&rs.i0.r.i3.pos=79&sub.sym11.r4=sym6&sub.sym11.r3=sym6&sub.sym11.r2=sym6&sub.sym11.r1=sym6&sub.sym11.r0=sym6&gamestate.bonusid=alan-bonus&nextaction=freespin&rs.i0.r.i2.syms=SYM0%2CSYM6%2CSYM6%2CSYM6%2CSYM6&rs.i1.r.i6.pos=0&game.win.amount=0.44&freespins.totalwin.cents=0&rs.i1.r.i6.syms=SYM11&freespins.betlevel=1&playercurrency=%26%23x20AC%3B&rs.i1.r.i16.syms=SYM11&rs.i2.r.i0.pos=0&current.rs.i0=freespin&rs.i2.r.i4.syms=SYM8%2CSYM8%2CSYM7&rs.i1.r.i18.hold=false&rs.i0.id=basic&rs.i1.r.i9.hold=false&rs.i1.r.i14.pos=0&rs.i1.r.i17.syms=SYM7&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&rs.i1.r.i5.syms=SYM7&rs.i1.r.i4.pos=0&rs.i1.r.i18.pos=0&multiplier=1&rs.i2.r.i2.pos=0&freespins.denomination=1.000&rs.i1.r.i15.syms=SYM11&freespins.totalwin.coins=0&freespins.total=6&rs.i1.r.i12.pos=0&gamestate.stack=basic%2Cfreespin&rs.i1.r.i8.hold=false&rs.i1.r.i4.syms=SYM7&feature.shuffle.active=true&rs.i1.r.i16.hold=false&rs.i2.r.i2.syms=SYM7%2CSYM7%2CSYM6%2CSYM6%2CSYM5&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&rs.i1.r.i2.pos=0&rs.i1.r.i7.syms=SYM11&bet.betlevel=1&rs.i1.r.i11.pos=0&rs.i2.r.i4.pos=0&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i2.attention.i0=0&rs.i1.r.i7.pos=0&freespins.wavecount=1&rs.i0.r.i4.attention.i0=0&freespins.multiplier=1&playforfun=false&rs.i1.r.i18.syms=SYM11&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM0%2CSYM5%2CSYM5&rs.i1.r.i8.syms=SYM7&rs.i1.r.i9.pos=0&rs.i0.r.i2.pos=59&rs.i1.r.i2.syms=SYM7&rs.i1.r.i0.pos=0&totalwin.cents=44&rs.i1.r.i14.syms=SYM7&rs.i2.r.i0.syms=SYM6%2CSYM6%2CSYM7&rs.i1.r.i11.hold=false&rs.i1.r.i5.pos=0&rs.i0.r.i0.hold=false&rs.i1.r.i7.hold=false&rs.i2.r.i3.syms=SYM4%2CSYM4%2CSYM8%2CSYM8&rs.i1.id=respin&rs.i1.r.i17.hold=false&rs.i1.r.i4.hold=false&freespins.left=6&rs.i0.r.i4.pos=72&rs.i1.r.i14.hold=false&rs.i2.r.i2.hold=false&wavecount=1&nextactiontype=revealmystery&rs.i1.r.i1.hold=false&rs.i0.r.i3.hold=false&rs.i1.r.i16.pos=0&bet.denomination=1';
                    break;
                case 'endbonus':
                    $_obf_0D183102053413173826171E10223731370526311D2432 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') * $slotSettings->CurrentDenomination * 100;
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'previous.rs.i0=freespin&freespins.betlevel=1&gameServerVersion=2.0.1&g4mode=false&freespins.win.coins=' . $_obf_0D183102053413173826171E10223731370526311D2432 . '&playercurrency=%26%23x20AC%3B&feature.randomwilds.active=false&historybutton=false&current.rs.i0=basic&sub.sym12.r4=sym10&sub.sym12.r3=sym10&next.rs=basic&sub.sym12.r2=sym10&gamestate.history=basic%2Cbonus%2Cfreespin%2Cbonus&sub.sym12.r1=sym10&sub.sym12.r0=sym10&game.win.cents=' . $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 . '&feature.randomwilds.positions=0%3A0%2C1%3A2%2C1%3A3%2C2%3A0%2C2%3A4%2C3%3A0%2C3%3A1%2C3%3A2&nextclientrs=basic&totalwin.coins=' . $_obf_0D183102053413173826171E10223731370526311D2432 . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&gamestate.current=basic&freespins.initial=5&jackpotcurrency=%26%23x20AC%3B&multiplier=1&last.rs=freespin&bonus.rollsleft=0&freespins.denomination=1.000&feature.sticky.active=false&freespins.win.cents=' . $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 . '&freespins.totalwin.coins=' . $_obf_0D183102053413173826171E10223731370526311D2432 . '&freespins.total=5&isJackpotWin=false&gamestate.stack=basic&feature.shuffle.active=false&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19%2C20%2C21%2C22%2C23%2C24%2C25%2C26%2C27%2C28%2C29%2C30%2C31%2C32%2C33%2C34%2C35&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&feature.wildreels.active=false&game.win.coins=' . $_obf_0D183102053413173826171E10223731370526311D2432 . '&playercurrencyiso=' . $slotSettings->slotCurrency . '&freespins.wavecount=1&freespins.multiplier=1&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=endbonus&sub.sym13.r0=sym5&sub.sym13.r1=sym5&sub.sym13.r2=sym5&sub.sym13.r3=sym5&sub.sym13.r4=sym5&bonus.token=crocodile&totalwin.cents=' . $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 . '&gameover=true&bonus.feature.disabled=randomwilds&bonus.board.position=25&freespins.left=0&sub.sym11.r4=sym10&sub.sym11.r3=sym10&sub.sym11.r2=sym10&sub.sym11.r1=sym10&sub.sym11.r0=sym10&nextaction=spin&wavecount=1&game.win.amount=3.23&freespins.totalwin.cents=' . $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 . '';
                    break;
                case 'initbonus':
                    $_obf_0D183102053413173826171E10223731370526311D2432 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') * $slotSettings->CurrentDenomination * 100;
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'bonus.field.i3.type=coin&bonus.field.i29.type=coin&gameServerVersion=2.0.1&g4mode=false&feature.randomwilds.active=false&historybutton=false&sub.sym12.r4=sym7&sub.sym12.r3=sym7&sub.sym12.r2=sym7&gamestate.history=basic&sub.sym12.r1=sym7&sub.sym12.r0=sym7&bonus.field.i2.value=1&bonus.field.i14.type=coin&game.win.cents=' . $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 . '&bonus.field.i28.type=feature&bonus.field.i2.type=reroll&nextclientrs=basic&totalwin.coins=' . $_obf_0D183102053413173826171E10223731370526311D2432 . '&gamestate.current=bonus&jackpotcurrency=%26%23x20AC%3B&bonus.rollsleft=6&bonus.field.i28.value=randomwilds&bonus.field.i1.type=coin&feature.sticky.active=false&bonus.field.i17.value=1&isJackpotWin=false&bonuswin.cents=' . $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 . '&totalbonuswin.cents=' . $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 . '&bonus.field.i4.type=feature&bonus.field.i22.value=1&bonus.field.i20.type=feature&feature.wildreels.active=false&bonus.field.i31.type=coin&bonus.field.i15.type=coin&bonus.field.i25.value=3&bonus.field.i6.type=reroll&bonus.field.i0.type=mystery&game.win.coins=' . $_obf_0D183102053413173826171E10223731370526311D2432 . '&bonus.field.i18.type=reroll&bonus.field.i14.value=1&clientaction=initbonus&sub.sym13.r0=sym3&bonus.field.i21.type=feature&bonus.field.i21.value=shuffle&sub.sym13.r1=sym3&sub.sym13.r2=sym3&sub.sym13.r3=sym3&sub.sym13.r4=sym3&bonus.field.i1.value=1&bonus.field.i7.value=1&bonus.field.i17.type=coin&bonus.field.i31.value=1&gameover=false&bonus.field.i30.type=coin&totalbonuswin.coins=' . $_obf_0D183102053413173826171E10223731370526311D2432 . '&bonus.board.position=0&sub.sym11.r4=sym6&sub.sym11.r3=sym6&sub.sym11.r2=sym6&sub.sym11.r1=sym6&sub.sym11.r0=sym6&bonus.field.i11.type=feature&gamestate.bonusid=alan-bonus&bonus.field.i27.value=randomwilds&bonus.field.i8.value=unrevealed&bonus.field.i27.type=feature&nextaction=bonusaction&bonus.field.i20.value=shuffle&bonus.field.i15.value=2&game.win.amount=' . $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 . '&bonus.field.i9.type=reroll&playercurrency=%26%23x20AC%3B&bonus.field.i6.value=1&bonus.field.i24.type=mystery&bonus.field.i8.type=mystery&bonus.field.i10.type=coin&bonus.field.i26.value=1&bonus.field.i16.value=unrevealed&bonus.field.i9.value=1&bonus.field.i19.value=1&bonus.field.i29.value=1&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&multiplier=1&bonus.field.i13.value=1&bonus.field.i30.value=1&gamestate.stack=basic%2Cbonus&feature.shuffle.active=false&gamesoundurl=https%3A%2F%2Fstatic.casinomodule.com%2F&bonus.field.i0.value=unrevealed&bonus.field.i3.value=5&bonus.field.i7.type=coin&bonus.field.i10.value=1&bonus.field.i23.type=coin&bonus.field.i12.type=feature&bonus.field.i26.type=coin&playercurrencyiso=' . $slotSettings->slotCurrency . '&bonus.field.i24.value=unrevealed&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&bonus.field.i11.value=wildreels&bonus.field.i13.type=coin&bonus.field.i25.type=coin&bonus.field.i5.type=feature&totalwin.cents=' . $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 . '&bonus.field.i4.value=stickywin&bonus.field.i22.type=coin&bonus.field.i5.value=stickywin&bonus.field.i16.type=mystery&bonus.field.i19.type=coin&bonusgame.coinvalue=' . $slotSettings->CurrentDenomination . '&bonus.field.i23.value=1&bonus.field.i18.value=1&bonus.field.i12.value=wildreels&wavecount=1&nextactiontype=selecttoken&bonuswin.coins=' . $_obf_0D183102053413173826171E10223731370526311D2432 . '';
                    break;
                case 'bonusaction':
                    if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bonus_token']) ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusToken', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bonus_token']);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusStep', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusRolls', 6);
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'gameServerVersion=2.0.1&g4mode=false&playercurrency=%26%23x20AC%3B&feature.randomwilds.active=false&historybutton=false&sub.sym12.r4=sym3&sub.sym12.r3=sym3&sub.sym12.r2=sym3&gamestate.history=basic%2Cbonus&sub.sym12.r1=sym3&sub.sym12.r0=sym3&game.win.cents=24&nextclientrs=basic&totalwin.coins=24&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&gamestate.current=bonus&jackpotcurrency=%26%23x20AC%3B&multiplier=1&bonus.rollsleft=5&feature.sticky.active=false&isJackpotWin=false&gamestate.stack=basic%2Cbonus&bonuswin.cents=0&totalbonuswin.cents=0&feature.shuffle.active=false&gamesoundurl=&feature.wildreels.active=false&game.win.coins=24&playercurrencyiso=' . $slotSettings->slotCurrency . '&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=bonusaction&sub.sym13.r0=sym4&sub.sym13.r1=sym4&sub.sym13.r2=sym4&sub.sym13.r3=sym4&sub.sym13.r4=sym4&bonus.token=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusToken') . '&totalwin.cents=24&gameover=false&totalbonuswin.coins=0&bonus.board.position=0&sub.sym11.r4=sym6&sub.sym11.r3=sym6&sub.sym11.r2=sym6&sub.sym11.r1=sym6&sub.sym11.r0=sym6&bonusgame.coinvalue=0.01&gamestate.bonusid=alan-bonus&nextaction=bonusaction&wavecount=1&nextactiontype=roll&game.win.amount=0.24&bonuswin.coins=0';
                    }
                    else
                    {
                        $BonusToken = $slotSettings->GetGameData($slotSettings->slotId . 'BonusToken');
                        $BonusRolls = $slotSettings->GetGameData($slotSettings->slotId . 'BonusRolls');
                        $allbet = $slotSettings->GetGameData($slotSettings->slotId . 'AllBet');
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $_obf_0D111934392B3D2E021B3E393903122934253B2D260A11 = [
                            'x1', 
                            'EXTRA', 
                            'x5', 
                            'STICKY', 
                            'STICKY', 
                            'EXTRA', 
                            'x1', 
                            '?', 
                            'EXTRA', 
                            'x1', 
                            'CROC', 
                            'CROC', 
                            'x1', 
                            'x1', 
                            'x2', 
                            '?', 
                            'x1', 
                            'EXTRA', 
                            'x1', 
                            'MONKEY', 
                            'MONKEY', 
                            'x1', 
                            'x1', 
                            '?', 
                            'x3', 
                            'x1', 
                            'RHINO', 
                            'RHINO', 
                            'x1', 
                            'x1', 
                            'x1', 
                            '?'
                        ];
                        $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                        for( $i = 0; $i <= 2000; $i++ ) 
                        {
                            $BonusStep = $slotSettings->GetGameData($slotSettings->slotId . 'BonusStep');
                            $_obf_0D3B071A402623332C3F3C0A27381E2D08141723273C11 = rand(1, 6);
                            $_obf_0D34103339370C1515362834360840031F0C2622383C11 = rand(1, 6);
                            $_obf_0D352D1E2D2F0F3F0101275B04043D18313E39403D0611 = $_obf_0D3B071A402623332C3F3C0A27381E2D08141723273C11 + $_obf_0D34103339370C1515362834360840031F0C2622383C11;
                            $BonusStep += $_obf_0D352D1E2D2F0F3F0101275B04043D18313E39403D0611;
                            if( $BonusStep > 31 ) 
                            {
                                $BonusStep = $BonusStep - 31;
                            }
                            $_obf_0D18261725040B3413122C083D13095B391B2B13033032 = $_obf_0D111934392B3D2E021B3E393903122934253B2D260A11[$BonusStep - 1];
                            if( $_obf_0D18261725040B3413122C083D13095B391B2B13033032 == '?' ) 
                            {
                            }
                            else if( $BonusRolls == 1 && $_obf_0D18261725040B3413122C083D13095B391B2B13033032 != 'x1' && $_obf_0D18261725040B3413122C083D13095B391B2B13033032 != 'x2' && $_obf_0D18261725040B3413122C083D13095B391B2B13033032 != 'x3' && $_obf_0D18261725040B3413122C083D13095B391B2B13033032 != 'x5' ) 
                            {
                            }
                            else
                            {
                                $totalWin = 0;
                                $_obf_0D030E0F3F05242608320126011D021F081B0F0A2A3132 = 0;
                                $_obf_0D35131F273B3D0329142E3E2409382F242601312D1022 = '';
                                $_obf_0D0C192B010508390B1A2C27215C12212401032A2F1122 = '';
                                $_obf_0D2C1B05023E390F0A39300E313C09392E080339181B11 = 1;
                                $_obf_0D1E3031380C242F27102F221F391F07272A0D11133211 = '&freespins.betlevel=1&freespins.win.coins=0&freespins.initial=6&freespins.denomination=' . $slotSettings->CurrentDenomination . '&freespins.win.cents=0&freespins.totalwin.coins=0&freespins.total=6&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19%2C20%2C21%2C22%2C23%2C24%2C25%2C26%2C27%2C28%2C29%2C3&freespins.wavecount=1&freespins.multiplier=1&freespins.left=6&freespins.totalwin.cents=0';
                                $_obf_0D2F09013B0A26032A09234026160709031D211D052F11 = '&current.rs.i0=freespin&next.rs=freespin&bonus.win.type=feature&gamestate.current=freespin&gamestate.stack=basic%2Cfreespin&clientaction=bonusaction&nextaction=bonusaction&nextactiontype=roll';
                                $_obf_0D1135112A38351228022C373B3B0622293C021A223601 = '';
                                $_obf_0D0E1F0E340A2E061C191D5C270F261D3C182B2C183422 = '';
                                switch( $_obf_0D18261725040B3413122C083D13095B391B2B13033032 ) 
                                {
                                    case 'x1':
                                        $_obf_0D0C192B010508390B1A2C27215C12212401032A2F1122 = 'coin';
                                        $totalWin = $allbet * 1;
                                        $_obf_0D2C1B05023E390F0A39300E313C09392E080339181B11 = 1;
                                        break;
                                    case 'x2':
                                        $_obf_0D0C192B010508390B1A2C27215C12212401032A2F1122 = 'coin';
                                        $totalWin = $allbet * 2;
                                        $_obf_0D2C1B05023E390F0A39300E313C09392E080339181B11 = 2;
                                        break;
                                    case 'x3':
                                        $_obf_0D0C192B010508390B1A2C27215C12212401032A2F1122 = 'coin';
                                        $totalWin = $allbet * 1;
                                        $_obf_0D2C1B05023E390F0A39300E313C09392E080339181B11 = 3;
                                        break;
                                    case 'x5':
                                        $_obf_0D0C192B010508390B1A2C27215C12212401032A2F1122 = 'coin';
                                        $totalWin = $allbet * 5;
                                        $_obf_0D2C1B05023E390F0A39300E313C09392E080339181B11 = 5;
                                        break;
                                    case 'EXTRA':
                                        $_obf_0D04350F11240E37331F3C17270E0F3F122B272B073001 = rand(1, 3);
                                        $_obf_0D0E1F0E340A2E061C191D5C270F261D3C182B2C183422 = '&bonus.win.value=' . $_obf_0D04350F11240E37331F3C17270E0F3F122B272B073001;
                                        $_obf_0D0C192B010508390B1A2C27215C12212401032A2F1122 = 'reroll';
                                        $BonusRolls += $_obf_0D04350F11240E37331F3C17270E0F3F122B272B073001;
                                        $_obf_0D2C1B05023E390F0A39300E313C09392E080339181B11 = $_obf_0D04350F11240E37331F3C17270E0F3F122B272B073001;
                                        break;
                                    case 'CROC':
                                        $_obf_0D0E1F0E340A2E061C191D5C270F261D3C182B2C183422 = $_obf_0D1E3031380C242F27102F221F391F07272A0D11133211 . $_obf_0D2F09013B0A26032A09234026160709031D211D052F11 . '&bonus.win.value=wildreels&feature.wildreels.active=true&nextclientrs=wildreels&nextaction=freespin';
                                        $_obf_0D0C192B010508390B1A2C27215C12212401032A2F1122 = 'feature';
                                        $_obf_0D2C1B05023E390F0A39300E313C09392E080339181B11 = 'wildfeatures';
                                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusType', 'wildreels');
                                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 6);
                                        break;
                                    case 'STICKY':
                                        $_obf_0D0E1F0E340A2E061C191D5C270F261D3C182B2C183422 = $_obf_0D1E3031380C242F27102F221F391F07272A0D11133211 . $_obf_0D2F09013B0A26032A09234026160709031D211D052F11 . '&bonus.win.value=randomwilds&feature.randomwilds.active=true&nextclientrs=wildreels&nextaction=freespin';
                                        $_obf_0D0C192B010508390B1A2C27215C12212401032A2F1122 = 'feature';
                                        $_obf_0D2C1B05023E390F0A39300E313C09392E080339181B11 = 'wildfeatures';
                                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusType', 'wildfeatures');
                                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 6);
                                        break;
                                    case 'MONKEY':
                                        $_obf_0D0E1F0E340A2E061C191D5C270F261D3C182B2C183422 = $_obf_0D1E3031380C242F27102F221F391F07272A0D11133211 . $_obf_0D2F09013B0A26032A09234026160709031D211D052F11 . '&bonus.win.value=shuffle&feature.shuffle.active=true&nextclientrs=shuffle&nextaction=freespin';
                                        $_obf_0D0C192B010508390B1A2C27215C12212401032A2F1122 = 'feature';
                                        $_obf_0D2C1B05023E390F0A39300E313C09392E080339181B11 = 'shuffle';
                                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusType', 'shuffle');
                                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 6);
                                        break;
                                    case 'RHINO':
                                        $_obf_0D0E1F0E340A2E061C191D5C270F261D3C182B2C183422 = $_obf_0D1E3031380C242F27102F221F391F07272A0D11133211 . $_obf_0D2F09013B0A26032A09234026160709031D211D052F11 . '&bonus.win.value=wildreels&feature.wildreels.active=true&nextclientrs=wildreels&nextaction=freespin';
                                        $_obf_0D0C192B010508390B1A2C27215C12212401032A2F1122 = 'feature';
                                        $_obf_0D2C1B05023E390F0A39300E313C09392E080339181B11 = 'wildfeatures';
                                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusType', 'wildfeatures');
                                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 6);
                                        break;
                                    case '?':
                                        $_obf_0D0E1F0E340A2E061C191D5C270F261D3C182B2C183422 = $_obf_0D1E3031380C242F27102F221F391F07272A0D11133211 . $_obf_0D2F09013B0A26032A09234026160709031D211D052F11 . '&bonus.win.value=wildreels&feature.wildreels.active=true&nextclientrs=wildreels&nextaction=freespin';
                                        $_obf_0D0C192B010508390B1A2C27215C12212401032A2F1122 = 'feature';
                                        $_obf_0D2C1B05023E390F0A39300E313C09392E080339181B11 = 'wildreels';
                                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusType', 'wildreels');
                                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 6);
                                        break;
                                }
                                if( $totalWin <= $bank ) 
                                {
                                    break;
                                }
                            }
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                        $BonusRolls--;
                        $_obf_0D183102053413173826171E10223731370526311D2432 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                        $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') * $slotSettings->CurrentDenomination * 100;
                        $_obf_0D0B1019370B382F080519122A08320A273E2701351811 = $totalWin * $slotSettings->CurrentDenomination * 100;
                        $_obf_0D19291E1837040208101825140C272433051A2E0A0432 = $totalWin;
                        if( $totalWin > 0 ) 
                        {
                            $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                            $slotSettings->SetBalance($totalWin);
                        }
                        if( $BonusRolls <= 0 ) 
                        {
                            $_obf_0D0E1F0E340A2E061C191D5C270F261D3C182B2C183422 .= '&nextaction=endbonus&bonusgameover=true';
                        }
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '&cbs=' . $_obf_0D18261725040B3413122C083D13095B391B2B13033032 . '&gameServerVersion=2.0.1&g4mode=false&playercurrency=%26%23x20AC%3B&feature.randomwilds.active=false&historybutton=false&sub.sym12.r4=sym3&bonus.win.value=' . $_obf_0D2C1B05023E390F0A39300E313C09392E080339181B11 . '&sub.sym12.r3=sym3&sub.sym12.r2=sym3&gamestate.history=basic%2Cbonus&sub.sym12.r1=sym3&sub.sym12.r0=sym3&bonus.win.type=' . $_obf_0D0C192B010508390B1A2C27215C12212401032A2F1122 . '&game.win.cents=' . $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 . '&nextclientrs=basic&totalwin.coins=' . $_obf_0D183102053413173826171E10223731370526311D2432 . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&gamestate.current=bonus&jackpotcurrency=%26%23x20AC%3B&multiplier=1&bonus.rollsleft=' . $BonusRolls . '&feature.sticky.active=false&isJackpotWin=false&gamestate.stack=basic%2Cbonus&bonuswin.cents=' . $_obf_0D0B1019370B382F080519122A08320A273E2701351811 . '&totalbonuswin.cents=' . $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 . '&feature.shuffle.active=false&gamesoundurl=&feature.wildreels.active=false&bonus.dice.i0.result=' . $_obf_0D3B071A402623332C3F3C0A27381E2D08141723273C11 . '&game.win.coins=' . $_obf_0D183102053413173826171E10223731370526311D2432 . '&playercurrencyiso=' . $slotSettings->slotCurrency . '&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=bonusaction&sub.sym13.r0=sym4&sub.sym13.r1=sym4&sub.sym13.r2=sym4&sub.sym13.r3=sym4&sub.sym13.r4=sym4&bonus.token=' . $BonusToken . '&totalwin.cents=' . $_obf_0D083C0611152C09031E1E260A390C30161C1F24161222 . '&gameover=false&totalbonuswin.coins=' . $_obf_0D183102053413173826171E10223731370526311D2432 . '&bonus.board.position=' . $BonusStep . '&sub.sym11.r4=sym6&sub.sym11.r3=sym6&sub.sym11.r2=sym6&sub.sym11.r1=sym6&sub.sym11.r0=sym6&bonusgame.coinvalue=' . $slotSettings->CurrentDenomination . '&gamestate.bonusid=alan-bonus&nextaction=bonusaction&wavecount=1&nextactiontype=roll&bonus.dice.i1.result=' . $_obf_0D34103339370C1515362834360840031F0C2622383C11 . '&game.win.amount=' . ($_obf_0D0B1019370B382F080519122A08320A273E2701351811 * $slotSettings->CurrentDenomination) . '&bonuswin.coins=' . $_obf_0D19291E1837040208101825140C272433051A2E0A0432 . '' . $_obf_0D0E1F0E340A2E061C191D5C270F261D3C182B2C183422;
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusToken', $BonusToken);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusStep', $BonusStep);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusRolls', $BonusRolls);
                        $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"gambleResult","serverResponse":{"totalWin":0}}';
                        $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, 0, 1, $totalWin, 'BG');
                    }
                    break;
                case 'spin':
                    $linesId = [];
                    $linesId[0] = [
                        1, 
                        1, 
                        1, 
                        1, 
                        1
                    ];
                    $linesId[1] = [
                        1, 
                        1, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[2] = [
                        1, 
                        1, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[3] = [
                        1, 
                        1, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[4] = [
                        1, 
                        2, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[5] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[6] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[7] = [
                        1, 
                        2, 
                        3, 
                        2, 
                        1
                    ];
                    $linesId[8] = [
                        1, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[9] = [
                        1, 
                        2, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[10] = [
                        1, 
                        2, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[11] = [
                        2, 
                        2, 
                        1, 
                        1, 
                        1
                    ];
                    $linesId[12] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[13] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[14] = [
                        2, 
                        2, 
                        3, 
                        2, 
                        1
                    ];
                    $linesId[15] = [
                        2, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[16] = [
                        2, 
                        2, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[17] = [
                        2, 
                        2, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[18] = [
                        2, 
                        3, 
                        3, 
                        2, 
                        1
                    ];
                    $linesId[19] = [
                        2, 
                        3, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[20] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[21] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[22] = [
                        2, 
                        3, 
                        4, 
                        3, 
                        2
                    ];
                    $linesId[23] = [
                        2, 
                        3, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[24] = [
                        2, 
                        3, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[25] = [
                        3, 
                        3, 
                        3, 
                        2, 
                        1
                    ];
                    $linesId[26] = [
                        3, 
                        3, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[27] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[28] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[29] = [
                        3, 
                        3, 
                        4, 
                        3, 
                        2
                    ];
                    $linesId[30] = [
                        3, 
                        3, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[31] = [
                        3, 
                        3, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[32] = [
                        3, 
                        4, 
                        4, 
                        3, 
                        2
                    ];
                    $linesId[33] = [
                        3, 
                        4, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[34] = [
                        3, 
                        4, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[35] = [
                        3, 
                        4, 
                        5, 
                        4, 
                        3
                    ];
                    $lines = 10;
                    $slotSettings->CurrentDenom = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                    $slotSettings->CurrentDenomination = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'respin' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'shuffle' ) 
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
                        $slotSettings->SetGameData($slotSettings->slotId . 'AllBet', $allbet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $betline);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Denom', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination']);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusType', '');
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
                    if( $winType == 'bonus' && ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'respin') ) 
                    {
                        $winType = 'win';
                    }
                    $_obf_0D362B352C2801363E030B3032212D353C1934402F0A11 = rand(1, 500);
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
                        $wild = ['1'];
                        $scatter = '0';
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D0F043F40101B0307053B1F27093E3821311D0C222A22 = false;
                        $shuffleactive = false;
                        $_obf_0D050B22082D2F1140362F3B04372F3F190128231C3822 = false;
                        $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 = false;
                        if( rand(1, 100) == 1 ) 
                        {
                            $_obf_0D050B22082D2F1140362F3B04372F3F190128231C3822 = true;
                        }
                        else if( rand(1, 100) == 1 ) 
                        {
                            $shuffleactive = true;
                        }
                        else if( rand(1, 100) == 1 ) 
                        {
                            $_obf_0D0F043F40101B0307053B1F27093E3821311D0C222A22 = true;
                        }
                        else if( rand(1, 100) == 1 ) 
                        {
                            $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 = true;
                        }
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                            if( $slotSettings->GetGameData($slotSettings->slotId . 'BonusType') == 'shuffle' ) 
                            {
                                $shuffleactive = true;
                            }
                            if( $slotSettings->GetGameData($slotSettings->slotId . 'BonusType') == 'wildreels' ) 
                            {
                                $_obf_0D050B22082D2F1140362F3B04372F3F190128231C3822 = true;
                            }
                            if( $slotSettings->GetGameData($slotSettings->slotId . 'BonusType') == 'randomwilds' ) 
                            {
                                $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 = true;
                            }
                        }
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'shuffle' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'respin' || $winType == 'bonus' ) 
                        {
                            $_obf_0D0F043F40101B0307053B1F27093E3821311D0C222A22 = false;
                            $_obf_0D050B22082D2F1140362F3B04372F3F190128231C3822 = false;
                            $shuffleactive = false;
                            $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 = false;
                        }
                        $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '';
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'shuffle' ) 
                        {
                            if( $slotSettings->GetGameData($slotSettings->slotId . 'BonusType') == 'shuffle' ) 
                            {
                                $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 = 'freespin';
                                $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'freespin';
                                $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 = 'basic%2Cfreespin';
                                $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                                $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                                $_obf_0D28171F40025B163D3C223B31130C212F402314403011 = '&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19&freespins.totalwin.cents=0&nextaction=' . $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 . '&freespins.left=' . $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 . '&freespins.wavecount=1&freespins.multiplier=1&gamestate.stack=' . $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 . '&freespins.totalwin.coins=' . $totalWin . '&freespins.total=' . $fs . '&freespins.win.cents=' . ($totalWin / $slotSettings->CurrentDenomination * 100) . '&gamestate.current=' . $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 . '&freespins.initial=' . $fs . '&freespins.win.coins=' . $totalWin . '&freespins.betlevel=' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet') . '&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '&nextclientrs=shuffle';
                                $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '&feature.shuffle.active=true&clientaction=shuffle&nextaction=freespin' . $_obf_0D28171F40025B163D3C223B31130C212F402314403011;
                            }
                            else
                            {
                                $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '&feature.shuffle.active=true&clientaction=shuffle&nextaction=spin';
                            }
                            $slotSettings->SetGameData($slotSettings->slotId . 'ShuffleActive', 0);
                            $reels = $slotSettings->GetGameData($slotSettings->slotId . 'Reels');
                            $_obf_0D2A111F2105011A1C2C1E0F2626171827252728083C22 = [];
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 4; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                                {
                                    if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '' ) 
                                    {
                                        $_obf_0D2A111F2105011A1C2C1E0F2626171827252728083C22[] = $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32];
                                    }
                                }
                            }
                            shuffle($_obf_0D2A111F2105011A1C2C1E0F2626171827252728083C22);
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 4; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                                {
                                    if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '' ) 
                                    {
                                        $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = array_pop($_obf_0D2A111F2105011A1C2C1E0F2626171827252728083C22);
                                    }
                                }
                            }
                        }
                        $_obf_0D161C373E023208311030222A2710083B35173E3E1F01 = rand(8, 10);
                        $_obf_0D5B112915322B0B2D3C2424142B2C332C0D0522242B22 = rand(5, 7);
                        $_obf_0D390B085C0E330D0728302D2327012E1D1D372A2A3311 = rand(3, 4);
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 4; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                            {
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == 13 ) 
                                {
                                    $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = $_obf_0D390B085C0E330D0728302D2327012E1D1D372A2A3311;
                                }
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == 12 ) 
                                {
                                    $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = $_obf_0D5B112915322B0B2D3C2424142B2C332C0D0522242B22;
                                }
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == 11 ) 
                                {
                                    $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = $_obf_0D161C373E023208311030222A2710083B35173E3E1F01;
                                }
                            }
                        }
                        $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01 = $reels;
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
                            $_obf_0D1A29071C31062825062A3012030833303F3613241411 = [];
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 4; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                                {
                                    if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] != '' && rand(1, 2) == 1 ) 
                                    {
                                        $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = '1';
                                        $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = '1';
                                        $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 .= ('&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.row=' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.with=SYM1&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.pos=1');
                                        $_obf_0D1A29071C31062825062A3012030833303F3613241411[] = ($r - 1) . '%3A' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '';
                                    }
                                }
                            }
                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 .= ('&feature.randomwilds.positions=' . implode('%2C', $_obf_0D1A29071C31062825062A3012030833303F3613241411));
                        }
                        if( $_obf_0D050B22082D2F1140362F3B04372F3F190128231C3822 ) 
                        {
                            $_obf_0D2139131E5C0816392A3B1F3302253F331E133D5B0732 = [
                                1, 
                                2, 
                                3, 
                                4, 
                                5
                            ];
                            shuffle($_obf_0D2139131E5C0816392A3B1F3302253F331E133D5B0732);
                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '&feature.wildreels.active=true&feature.wildreels.reels=' . ($_obf_0D2139131E5C0816392A3B1F3302253F331E133D5B0732[0] - 1) . '%2C' . ($_obf_0D2139131E5C0816392A3B1F3302253F331E133D5B0732[1] - 1) . '';
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                if( $_obf_0D2139131E5C0816392A3B1F3302253F331E133D5B0732[0] == $r || $_obf_0D2139131E5C0816392A3B1F3302253F331E133D5B0732[1] == $r ) 
                                {
                                    for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 4; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                                    {
                                        if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] != '' ) 
                                        {
                                            $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = '1';
                                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 .= ('&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.row=' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.with=SYM1&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.pos=1');
                                        }
                                    }
                                }
                            }
                        }
                        if( $shuffleactive ) 
                        {
                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '&feature.shuffle.active=true&nextaction=shuffle&nextclientrs=shuffle';
                            $slotSettings->SetGameData($slotSettings->slotId . 'ShuffleActive', 1);
                        }
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'respin' ) 
                        {
                            $_obf_0D16072F1C2A3C283B2B24281E3310230A2D32021B3832 = $slotSettings->GetGameData($slotSettings->slotId . 'overlayWildsArr');
                            foreach( $_obf_0D16072F1C2A3C283B2B24281E3310230A2D32021B3832 as $_obf_0D1E4033253C1240302E1B0117032B295C0A1619165B22 ) 
                            {
                                $reels['reel' . $_obf_0D1E4033253C1240302E1B0117032B295C0A1619165B22[0]][$_obf_0D1E4033253C1240302E1B0117032B295C0A1619165B22[1]] = 1;
                            }
                        }
                        $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 = 0;
                        for( $k = 0; $k < 36; $k++ ) 
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=basic&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i0=0%2C' . ($linesId[$k][0] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i1=1%2C' . ($linesId[$k][1] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i2=2%2C' . ($linesId[$k][2] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=' . $k . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 * $slotSettings->CurrentDenomination * 100) . '';
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=basic&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i0=0%2C' . ($linesId[$k][0] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i1=1%2C' . ($linesId[$k][1] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i2=2%2C' . ($linesId[$k][2] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i3=3%2C' . ($linesId[$k][3] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=' . $k . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 * $slotSettings->CurrentDenomination * 100) . '';
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=basic&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i0=0%2C' . ($linesId[$k][0] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i1=1%2C' . ($linesId[$k][1] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i2=2%2C' . ($linesId[$k][2] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i3=3%2C' . ($linesId[$k][3] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i4=4%2C' . ($linesId[$k][4] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=' . $k . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 * $slotSettings->CurrentDenomination * 100) . '';
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
                        $scattersWin = 0;
                        $scattersStr = '';
                        $scattersCount = 0;
                        $_obf_0D1505041B05191C2E1832110605272C24082129220632 = 0;
                        $_obf_0D3616291534321E3814280A213121252715122D091222 = [];
                        $overlayWildsArr = [];
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
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == 15 ) 
                                {
                                    $_obf_0D1505041B05191C2E1832110605272C24082129220632++;
                                    $_obf_0D3616291534321E3814280A213121252715122D091222 = ['&rs.i0.r.i' . ($r - 1) . '.overlay.i0.row=' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '&rs.i0.r.i' . ($r - 1) . '.overlay.i0.with=SYM1&rs.i0.r.i' . ($r - 1) . '.overlay.i0.pos=132'];
                                    $overlayWildsArr[] = [
                                        $r, 
                                        $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32
                                    ];
                                }
                            }
                        }
                        if( $scattersCount >= 3 ) 
                        {
                            $scattersStr = '&ws.i0.types.i0.freespins=' . $slotSettings->slotFreeCount[$scattersCount] . '&ws.i3.types.i0.bonusid=alan-bonus&gamestate.bonusid=alan-bonus&nextaction=bonusaction&bonus.rollsleft=6&ws.i0.reelset=basic&ws.i0.betline=null&ws.i0.types.i0.wintype=bonusgame&ws.i0.direction=none&nextactiontype=selecttoken' . implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811);
                        }
                        $totalWin += $scattersWin;
                        if( $i > 1000 ) 
                        {
                            $winType = 'none';
                        }
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'shuffle' && $totalWin <= $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 ) 
                        {
                            break;
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
                            if( $_obf_0D1505041B05191C2E1832110605272C24082129220632 >= 1 && ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' || $winType == 'bonus') ) 
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
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.syms=SYM' . $reels['reel2'][0] . '%2CSYM' . $reels['reel2'][1] . '%2CSYM' . $reels['reel2'][2] . '%2CSYM' . $reels['reel2'][3] . '');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.syms=SYM' . $reels['reel3'][0] . '%2CSYM' . $reels['reel3'][1] . '%2CSYM' . $reels['reel3'][2] . '%2CSYM' . $reels['reel3'][3] . '%2CSYM' . $reels['reel3'][4] . '');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.syms=SYM' . $reels['reel4'][0] . '%2CSYM' . $reels['reel4'][1] . '%2CSYM' . $reels['reel4'][2] . '%2CSYM' . $reels['reel4'][3] . '');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.syms=SYM' . $reels['reel5'][0] . '%2CSYM' . $reels['reel5'][1] . '%2CSYM' . $reels['reel5'][2] . '');
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'respin' ) 
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
                    }
                    $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32 = '';
                    $_obf_0D0422223816021522032514083116023435011B112122 = [];
                    $_obf_0D08170309223C210A33162F081F15360C221317110E32 = 0;
                    if( $scattersCount >= 2 ) 
                    {
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 4; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                            {
                                if( $_obf_0D08170309223C210A33162F081F15360C221317110E32 >= 2 && $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 == 0 ) 
                                {
                                    $_obf_0D0422223816021522032514083116023435011B112122[] = $r - 1;
                                }
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '0' && $r < 5 ) 
                                {
                                    $_obf_0D08170309223C210A33162F081F15360C221317110E32++;
                                }
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '0' ) 
                                {
                                    $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32 .= ('&rs.i0.r.i' . ($r - 1) . '.attention.i0=' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '');
                                }
                            }
                        }
                        if( $_obf_0D08170309223C210A33162F081F15360C221317110E32 >= 2 ) 
                        {
                            $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32 .= ('&rs.i0.nearwin=' . implode('%2C', $_obf_0D0422223816021522032514083116023435011B112122));
                        }
                    }
                    if( $_obf_0D1505041B05191C2E1832110605272C24082129220632 >= 1 && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'respin' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinMode', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'overlayWildsArr', $overlayWildsArr);
                        $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 = 'respin';
                        $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'respin';
                        $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 = 'basic';
                        $_obf_0D16231C3F34095B2B1317125C2B322A361316341B2A32 = 'spin';
                        $freeState = '&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19&freespins.totalwin.cents=0&nextaction=' . $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 . '&freespins.left=0&freespins.wavecount=1&freespins.multiplier=1&clientaction=' . $_obf_0D16231C3F34095B2B1317125C2B322A361316341B2A32 . '&gamestate.stack=' . $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 . '&freespins.totalwin.coins=' . $totalWin . '&freespins.total=0&freespins.win.cents=' . ($totalWin / $slotSettings->CurrentDenomination * 100) . '&gamestate.current=' . $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 . '&freespins.initial=' . $fs . '&freespins.win.coins=' . $totalWin . '&freespins.betlevel=' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet') . '&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '' . implode('', $_obf_0D3616291534321E3814280A213121252715122D091222);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= $freeState;
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'respin' ) 
                    {
                        $_obf_0D16072F1C2A3C283B2B24281E3310230A2D32021B3832 = $slotSettings->GetGameData($slotSettings->slotId . 'overlayWildsArr');
                        $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 = 'basic';
                        $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'basic';
                        $_obf_0D16231C3F34095B2B1317125C2B322A361316341B2A32 = 'respin';
                        $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 = 'basic';
                        $freeState = '&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19&freespins.totalwin.cents=0&gamestate.stack=basic&nextaction=spin&freespins.multiplier=1&freespins.totalwin.coins=' . $totalWin . '&freespins.total=0&freespins.win.cents=' . ($totalWin / $slotSettings->CurrentDenomination * 100) . '&freespins.win.coins=' . $totalWin . '&freespins.betlevel=' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet') . '&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '' . implode('', $_obf_0D3616291534321E3814280A213121252715122D091222);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= $freeState;
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
                        $_obf_0D2F01102D22280B3C3D21125B1A291E301D3225270A01 = '';
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') > 0 ) 
                        {
                            $_obf_0D0A1C392F2C170F1D1901172B0C02090B122A0D220E01 = 'spin';
                            $_obf_0D3B2A29270D28011A1D15282A3331381F28191C374001 = 'basic';
                            $_obf_0D0B3C1C1F5C16371D102B372440183D25213D1E1C0122 = 'basic';
                            if( $slotSettings->GetGameData($slotSettings->slotId . 'BonusType') == 'shuffle' ) 
                            {
                                $_obf_0D2F01102D22280B3C3D21125B1A291E301D3225270A01 = '&nextclientrs=bonusaction';
                            }
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
                        $freeState .= $_obf_0D2F01102D22280B3C3D21125B1A291E301D3225270A01;
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= $freeState;
                    }
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"freeState":"' . $freeState . '","slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'respin' ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                    }
                    else
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    }
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * $slotSettings->CurrentDenom * 100);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Reels', $reels);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'gameServerVersion=2.0.1&g4mode=false&playercurrency=%26%23x20AC%3B&feature.randomwilds.active=false&historybutton=false&current.rs.i0=basic&sub.sym12.r4=sym5&rs.i0.r.i4.hold=false&sub.sym12.r3=sym5&next.rs=basic&sub.sym12.r2=sym5&gamestate.history=basic&sub.sym12.r1=sym5&sub.sym12.r0=sym5&rs.i0.r.i1.syms=SYM5%2CSYM5%2CSYM5%2CSYM8&game.win.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.id=basic&nextclientrs=basic&totalwin.coins=' . $totalWin . '&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&gamestate.current=basic&jackpotcurrency=%26%23x20AC%3B&multiplier=1&rs.i0.r.i0.syms=SYM4%2CSYM4%2CSYM7&rs.i0.r.i3.syms=SYM10%2CSYM8%2CSYM7%2CSYM7&feature.sticky.active=false&isJackpotWin=false&gamestate.stack=basic&rs.i0.r.i0.pos=37&feature.shuffle.active=false&gamesoundurl=&feature.wildreels.active=false&rs.i0.r.i1.pos=10&game.win.coins=' . $totalWin . '&playercurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i1.hold=false&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&clientaction=spin&sub.sym13.r0=sym4&sub.sym13.r1=sym4&rs.i0.r.i2.hold=false&sub.sym13.r2=sym4&rs.i0.r.i4.syms=SYM9%2CSYM0%2CSYM7&sub.sym13.r3=sym4&sub.sym13.r4=sym4&rs.i0.r.i2.pos=48&totalwin.cents=' . ($totalWin * $slotSettings->CurrentDenomination * 100) . '&gameover=true&rs.i0.r.i0.hold=false&rs.i0.r.i3.pos=5&sub.sym11.r4=sym8&sub.sym11.r3=sym8&rs.i0.r.i4.pos=40&sub.sym11.r2=sym8&sub.sym11.r1=sym8&sub.sym11.r0=sym8&nextaction=spin&wavecount=1&rs.i0.r.i2.syms=SYM8%2CSYM8%2CSYM3%2CSYM3%2CSYM4&rs.i0.r.i3.hold=false&game.win.amount=' . ($totalWin / $slotSettings->CurrentDenomination) . '' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 . $scattersStr . $_obf_0D19103E1B5C34222C2B191C1B0B0E37022D1A29243D32;
                    break;
                case 'freespin':
                    $linesId = [];
                    $linesId[0] = [
                        1, 
                        1, 
                        1, 
                        1, 
                        1
                    ];
                    $linesId[1] = [
                        1, 
                        1, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[2] = [
                        1, 
                        1, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[3] = [
                        1, 
                        1, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[4] = [
                        1, 
                        2, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[5] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[6] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[7] = [
                        1, 
                        2, 
                        3, 
                        2, 
                        1
                    ];
                    $linesId[8] = [
                        1, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[9] = [
                        1, 
                        2, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[10] = [
                        1, 
                        2, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[11] = [
                        2, 
                        2, 
                        1, 
                        1, 
                        1
                    ];
                    $linesId[12] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[13] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[14] = [
                        2, 
                        2, 
                        3, 
                        2, 
                        1
                    ];
                    $linesId[15] = [
                        2, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[16] = [
                        2, 
                        2, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[17] = [
                        2, 
                        2, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[18] = [
                        2, 
                        3, 
                        3, 
                        2, 
                        1
                    ];
                    $linesId[19] = [
                        2, 
                        3, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[20] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[21] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[22] = [
                        2, 
                        3, 
                        4, 
                        3, 
                        2
                    ];
                    $linesId[23] = [
                        2, 
                        3, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[24] = [
                        2, 
                        3, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[25] = [
                        3, 
                        3, 
                        3, 
                        2, 
                        1
                    ];
                    $linesId[26] = [
                        3, 
                        3, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[27] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[28] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[29] = [
                        3, 
                        3, 
                        4, 
                        3, 
                        2
                    ];
                    $linesId[30] = [
                        3, 
                        3, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[31] = [
                        3, 
                        3, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[32] = [
                        3, 
                        4, 
                        4, 
                        3, 
                        2
                    ];
                    $linesId[33] = [
                        3, 
                        4, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[34] = [
                        3, 
                        4, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[35] = [
                        3, 
                        4, 
                        5, 
                        4, 
                        3
                    ];
                    $lines = 10;
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'] = $slotSettings->GetGameData($slotSettings->slotId . 'Denom');
                    $slotSettings->CurrentDenom = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                    $slotSettings->CurrentDenomination = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet_denomination'];
                    $betline = $slotSettings->GetGameData($slotSettings->slotId . 'Bet');
                    $allbet = $betline * $lines;
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->slotFreeMpl;
                    $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $allbet, $lines);
                    $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                    $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * $slotSettings->CurrentDenom * 100);
                    if( $winType == 'bonus' ) 
                    {
                        $winType = 'win';
                    }
                    $_obf_0D050B22082D2F1140362F3B04372F3F190128231C3822 = false;
                    $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 = false;
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'BonusType') == 'shuffle' ) 
                    {
                        $_obf_0D050B22082D2F1140362F3B04372F3F190128231C3822 = false;
                        $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 = false;
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'BonusType') == 'wildfeatures' ) 
                    {
                        $_obf_0D050B22082D2F1140362F3B04372F3F190128231C3822 = false;
                        $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 = true;
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'BonusType') == 'wildreels' ) 
                    {
                        $_obf_0D050B22082D2F1140362F3B04372F3F190128231C3822 = true;
                        $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 = false;
                    }
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
                        $wild = ['1'];
                        $scatter = '0';
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D161C373E023208311030222A2710083B35173E3E1F01 = rand(8, 10);
                        $_obf_0D5B112915322B0B2D3C2424142B2C332C0D0522242B22 = rand(5, 7);
                        $_obf_0D390B085C0E330D0728302D2327012E1D1D372A2A3311 = rand(3, 4);
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 4; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                            {
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == 13 ) 
                                {
                                    $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = $_obf_0D390B085C0E330D0728302D2327012E1D1D372A2A3311;
                                }
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == 12 ) 
                                {
                                    $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = $_obf_0D5B112915322B0B2D3C2424142B2C332C0D0522242B22;
                                }
                                if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == 11 ) 
                                {
                                    $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = $_obf_0D161C373E023208311030222A2710083B35173E3E1F01;
                                }
                            }
                        }
                        $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01 = $reels;
                        $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '';
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
                            $_obf_0D1A29071C31062825062A3012030833303F3613241411 = [];
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 4; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                                {
                                    if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] != '' && rand(1, 5) == 1 ) 
                                    {
                                        $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = '1';
                                        $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = '1';
                                        $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 .= ('&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.row=' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.with=SYM1&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.pos=1');
                                        $_obf_0D1A29071C31062825062A3012030833303F3613241411[] = ($r - 1) . '%3A' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '';
                                    }
                                }
                            }
                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 .= ('&feature.randomwilds.positions=' . implode('%2C', $_obf_0D1A29071C31062825062A3012030833303F3613241411));
                        }
                        if( $_obf_0D050B22082D2F1140362F3B04372F3F190128231C3822 ) 
                        {
                            $_obf_0D2139131E5C0816392A3B1F3302253F331E133D5B0732 = [
                                1, 
                                2, 
                                3, 
                                4, 
                                5
                            ];
                            shuffle($_obf_0D2139131E5C0816392A3B1F3302253F331E133D5B0732);
                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 = '&feature.wildreels.active=true&feature.wildreels.reels=' . ($_obf_0D2139131E5C0816392A3B1F3302253F331E133D5B0732[0] - 1) . '%2C' . ($_obf_0D2139131E5C0816392A3B1F3302253F331E133D5B0732[1] - 1) . '';
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                if( $_obf_0D2139131E5C0816392A3B1F3302253F331E133D5B0732[0] == $r || $_obf_0D2139131E5C0816392A3B1F3302253F331E133D5B0732[1] == $r ) 
                                {
                                    for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 4; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                                    {
                                        if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] != '' ) 
                                        {
                                            $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = '1';
                                            $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32 .= ('&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.row=' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.with=SYM1&rs.i0.r.i' . ($r - 1) . '.overlay.i' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . '.pos=1');
                                        }
                                    }
                                }
                            }
                        }
                        $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 = 0;
                        for( $k = 0; $k < 36; $k++ ) 
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=basic&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i0=0%2C' . ($linesId[$k][0] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i1=1%2C' . ($linesId[$k][1] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i2=2%2C' . ($linesId[$k][2] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=' . $k . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 * $slotSettings->CurrentDenomination * 100) . '';
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=basic&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i0=0%2C' . ($linesId[$k][0] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i1=1%2C' . ($linesId[$k][1] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i2=2%2C' . ($linesId[$k][2] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i3=3%2C' . ($linesId[$k][3] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=' . $k . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 * $slotSettings->CurrentDenomination * 100) . '';
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.reelset=basic&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.coins=' . $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i0=0%2C' . ($linesId[$k][0] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i1=1%2C' . ($linesId[$k][1] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i2=2%2C' . ($linesId[$k][2] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i3=3%2C' . ($linesId[$k][3] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.pos.i4=4%2C' . ($linesId[$k][4] - 1) . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.wintype=coins&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.betline=' . $k . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.sym=SYM' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.direction=left_to_right&ws.i' . $_obf_0D272B0F11343B39070C172E15081621152F1C040A2E01 . '.types.i0.cents=' . ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 * $slotSettings->CurrentDenomination * 100) . '';
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
                        if( $i > 1000 ) 
                        {
                            $winType = 'none';
                            $_obf_0D2413051304242F240B2B08183B093132221A333C3D01 = false;
                        }
                        if( $i > 1500 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( $totalWin > 0 && $totalWin <= $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 && $winType == 'win' ) 
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
                    $freeState = '';
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                        $slotSettings->SetBalance($totalWin);
                    }
                    $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                    $reels = $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01;
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '&rs.i0.r.i0.syms=SYM' . $reels['reel1'][0] . '%2CSYM' . $reels['reel1'][1] . '%2CSYM' . $reels['reel1'][2] . '';
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i1.syms=SYM' . $reels['reel2'][0] . '%2CSYM' . $reels['reel2'][1] . '%2CSYM' . $reels['reel2'][2] . '%2CSYM' . $reels['reel2'][3] . '');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i2.syms=SYM' . $reels['reel3'][0] . '%2CSYM' . $reels['reel3'][1] . '%2CSYM' . $reels['reel3'][2] . '%2CSYM' . $reels['reel3'][3] . '%2CSYM' . $reels['reel3'][4] . '');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i3.syms=SYM' . $reels['reel4'][0] . '%2CSYM' . $reels['reel4'][1] . '%2CSYM' . $reels['reel4'][2] . '%2CSYM' . $reels['reel4'][3] . '');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('&rs.i0.r.i4.syms=SYM' . $reels['reel5'][0] . '%2CSYM' . $reels['reel5'][1] . '%2CSYM' . $reels['reel5'][2] . '');
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                    $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode('', $lineWins);
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"freeState":"' . $freeState . '","slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[],"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * $slotSettings->CurrentDenom * 100);
                    $bonusWin = $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    $slotSettings->SetGameData($slotSettings->slotId . 'Reels', $reels);
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'BonusType') == 'shuffle' ) 
                    {
                        if( $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 <= 0 ) 
                        {
                            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'previous.rs.i0=freespin&gameServerVersion=2.0.1&g4mode=false&freespins.win.coins=' . $bonusWin . '&feature.randomwilds.active=false&historybutton=false&sub.sym12.r4=sym6&rs.i0.r.i4.hold=false&sub.sym12.r3=sym6&next.rs=freespin&sub.sym12.r2=sym6&gamestate.history=basic%2Cbonus%2Cfreespin&sub.sym12.r1=sym6&sub.sym12.r0=sym6&rs.i0.r.i1.syms=SYM9%2CSYM9%2CSYM1%2CSYM8&game.win.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&nextclientrs=wildfeatures&totalwin.coins=' . $bonusWin . '&gamestate.current=bonus&freespins.initial=' . $fs . '&jackpotcurrency=%26%23x20AC%3B&bonus.rollsleft=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusRolls') . '&rs.i0.r.i0.syms=SYM10%2CSYM10%2CSYM9&rs.i0.r.i3.syms=SYM9%2CSYM9%2CSYM8%2CSYM8&feature.sticky.active=false&freespins.win.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&isJackpotWin=false&rs.i0.r.i0.pos=12&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19%2C20%2C21%2C22%2C23%2C24%2C25%2C26%2C27%2C28%2C29%2C30%2C31%2C32%2C33%2C34%2C35&feature.wildreels.active=false&rs.i0.r.i1.pos=8&game.win.coins=' . $bonusWin . '&rs.i0.r.i1.hold=false&clientaction=freespin&sub.sym13.r0=sym7&sub.sym13.r1=sym7&rs.i0.r.i2.hold=false&sub.sym13.r2=sym7&sub.sym13.r3=sym7&sub.sym13.r4=sym7&bonus.token=monkey&gameover=false&bonus.board.position=12&rs.i0.r.i3.pos=48&sub.sym11.r4=sym9&sub.sym11.r3=sym9&sub.sym11.r2=sym9&sub.sym11.r1=sym9&sub.sym11.r0=sym9&gamestate.bonusid=alan-bonus&nextaction=bonusaction&rs.i0.r.i2.syms=SYM10%2CSYM9%2CSYM6%2CSYM6%2CSYM4&game.win.amount=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&freespins.totalwin.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&freespins.betlevel=1&playercurrency=%26%23x20AC%3B¤t.rs.i0=freespin&rs.i0.id=freespin&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&multiplier=1&last.rs=freespin&freespins.denomination=1.000&freespins.totalwin.coins=' . $bonusWin . '&freespins.total=' . $fs . '&gamestate.stack=basic%2Cfreespin%2Cbonus&feature.shuffle.active=false&gamesoundurl=&playercurrencyiso=' . $slotSettings->slotCurrency . '&freespins.wavecount=1&freespins.multiplier=1&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM3%2CSYM3%2CSYM5&rs.i0.r.i2.pos=24&totalwin.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.r.i0.hold=false&bonus.feature.disabled=wildreels&freespins.left=0&rs.i0.r.i4.pos=32&wavecount=1&nextactiontype=roll&rs.i0.r.i3.hold=false' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32;
                        }
                        else
                        {
                            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'previous.rs.i0=freespin&gameServerVersion=2.0.1&g4mode=false&freespins.win.coins=' . $bonusWin . '&feature.randomwilds.active=false&historybutton=false&sub.sym12.r4=sym10&rs.i0.r.i4.hold=false&sub.sym12.r3=sym10&next.rs=freespin&sub.sym12.r2=sym10&gamestate.history=basic%2Cbonus%2Cfreespin&sub.sym12.r1=sym10&sub.sym12.r0=sym10&rs.i0.r.i1.syms=SYM3%2CSYM3%2CSYM7%2CSYM7&game.win.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&nextclientrs=wildfeatures&totalwin.coins=' . $bonusWin . '&gamestate.current=freespin&freespins.initial=' . $fs . '&jackpotcurrency=%26%23x20AC%3B&bonus.rollsleft=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusRolls') . '&rs.i0.r.i0.syms=SYM8%2CSYM5%2CSYM5&rs.i0.r.i3.syms=SYM8%2CSYM8%2CSYM7%2CSYM7&feature.sticky.active=false&freespins.win.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&isJackpotWin=false&rs.i0.r.i0.pos=78&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19%2C20%2C21%2C22%2C23%2C24%2C25%2C26%2C27%2C28%2C29%2C30%2C31%2C32%2C33%2C34%2C35&feature.wildreels.active=false&rs.i0.r.i1.pos=4&game.win.coins=' . $bonusWin . '&rs.i0.r.i1.hold=false&clientaction=freespin&sub.sym13.r0=sym7&sub.sym13.r1=sym7&rs.i0.r.i2.hold=false&sub.sym13.r2=sym7&sub.sym13.r3=sym7&sub.sym13.r4=sym7&bonus.token=monkey&gameover=false&bonus.board.position=12&rs.i0.r.i3.pos=26&sub.sym11.r4=sym7&sub.sym11.r3=sym7&sub.sym11.r2=sym7&sub.sym11.r1=sym7&sub.sym11.r0=sym7&gamestate.bonusid=alan-bonus&nextaction=freespin&rs.i0.r.i2.syms=SYM7%2CSYM9%2CSYM9%2CSYM8%2CSYM8&game.win.amount=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&freespins.totalwin.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&freespins.betlevel=1&playercurrency=%26%23x20AC%3B¤t.rs.i0=freespin&rs.i0.id=freespin&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&multiplier=1&last.rs=freespin&freespins.denomination=1.000&freespins.totalwin.coins=' . $bonusWin . '&freespins.total=' . $fs . '&gamestate.stack=basic%2Cfreespin&feature.shuffle.active=false&gamesoundurl=&playercurrencyiso=' . $slotSettings->slotCurrency . '&freespins.wavecount=1&freespins.multiplier=1&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM10%2CSYM10%2CSYM8&rs.i0.r.i2.pos=87&totalwin.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.r.i0.hold=false&freespins.left=' . $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 . '&rs.i0.r.i4.pos=53&wavecount=1&nextactiontype=roll&rs.i0.r.i3.hold=false' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32;
                        }
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'BonusType') == 'wildfeatures' ) 
                    {
                        if( $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 <= 0 ) 
                        {
                            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'previous.rs.i0=freespin&gameServerVersion=2.0.1&g4mode=false&freespins.win.coins=' . $bonusWin . '&feature.randomwilds.active=false&historybutton=false&sub.sym12.r4=sym6&rs.i0.r.i4.hold=false&sub.sym12.r3=sym6&next.rs=freespin&sub.sym12.r2=sym6&gamestate.history=basic%2Cbonus%2Cfreespin&sub.sym12.r1=sym6&sub.sym12.r0=sym6&rs.i0.r.i1.syms=SYM9%2CSYM9%2CSYM1%2CSYM8&game.win.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&nextclientrs=wildfeatures&totalwin.coins=' . $bonusWin . '&gamestate.current=bonus&freespins.initial=' . $fs . '&jackpotcurrency=%26%23x20AC%3B&bonus.rollsleft=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusRolls') . '&rs.i0.r.i0.syms=SYM10%2CSYM10%2CSYM9&rs.i0.r.i3.syms=SYM9%2CSYM9%2CSYM8%2CSYM8&feature.sticky.active=false&freespins.win.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&isJackpotWin=false&rs.i0.r.i0.pos=12&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19%2C20%2C21%2C22%2C23%2C24%2C25%2C26%2C27%2C28%2C29%2C30%2C31%2C32%2C33%2C34%2C35&feature.wildreels.active=false&rs.i0.r.i1.pos=8&game.win.coins=' . $bonusWin . '&rs.i0.r.i1.hold=false&clientaction=freespin&sub.sym13.r0=sym7&sub.sym13.r1=sym7&rs.i0.r.i2.hold=false&sub.sym13.r2=sym7&sub.sym13.r3=sym7&sub.sym13.r4=sym7&bonus.token=monkey&gameover=false&bonus.board.position=12&rs.i0.r.i3.pos=48&sub.sym11.r4=sym9&sub.sym11.r3=sym9&sub.sym11.r2=sym9&sub.sym11.r1=sym9&sub.sym11.r0=sym9&gamestate.bonusid=alan-bonus&nextaction=bonusaction&rs.i0.r.i2.syms=SYM10%2CSYM9%2CSYM6%2CSYM6%2CSYM4&game.win.amount=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&freespins.totalwin.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&freespins.betlevel=1&playercurrency=%26%23x20AC%3B¤t.rs.i0=freespin&rs.i0.id=freespin&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&multiplier=1&last.rs=freespin&freespins.denomination=1.000&freespins.totalwin.coins=' . $bonusWin . '&freespins.total=' . $fs . '&gamestate.stack=basic%2Cfreespin%2Cbonus&feature.shuffle.active=false&gamesoundurl=&playercurrencyiso=' . $slotSettings->slotCurrency . '&freespins.wavecount=1&freespins.multiplier=1&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM3%2CSYM3%2CSYM5&rs.i0.r.i2.pos=24&totalwin.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.r.i0.hold=false&bonus.feature.disabled=wildreels&freespins.left=0&rs.i0.r.i4.pos=32&wavecount=1&nextactiontype=roll&rs.i0.r.i3.hold=false' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32;
                        }
                        else
                        {
                            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'previous.rs.i0=freespin&gameServerVersion=2.0.1&g4mode=false&freespins.win.coins=' . $bonusWin . '&feature.randomwilds.active=false&historybutton=false&sub.sym12.r4=sym10&rs.i0.r.i4.hold=false&sub.sym12.r3=sym10&next.rs=freespin&sub.sym12.r2=sym10&gamestate.history=basic%2Cbonus%2Cfreespin&sub.sym12.r1=sym10&sub.sym12.r0=sym10&rs.i0.r.i1.syms=SYM3%2CSYM3%2CSYM7%2CSYM7&game.win.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&nextclientrs=wildfeatures&totalwin.coins=' . $bonusWin . '&gamestate.current=freespin&freespins.initial=' . $fs . '&jackpotcurrency=%26%23x20AC%3B&bonus.rollsleft=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusRolls') . '&rs.i0.r.i0.syms=SYM8%2CSYM5%2CSYM5&rs.i0.r.i3.syms=SYM8%2CSYM8%2CSYM7%2CSYM7&feature.sticky.active=false&freespins.win.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&isJackpotWin=false&rs.i0.r.i0.pos=78&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19%2C20%2C21%2C22%2C23%2C24%2C25%2C26%2C27%2C28%2C29%2C30%2C31%2C32%2C33%2C34%2C35&feature.wildreels.active=false&rs.i0.r.i1.pos=4&game.win.coins=' . $bonusWin . '&rs.i0.r.i1.hold=false&clientaction=freespin&sub.sym13.r0=sym7&sub.sym13.r1=sym7&rs.i0.r.i2.hold=false&sub.sym13.r2=sym7&sub.sym13.r3=sym7&sub.sym13.r4=sym7&bonus.token=monkey&gameover=false&bonus.board.position=12&rs.i0.r.i3.pos=26&sub.sym11.r4=sym7&sub.sym11.r3=sym7&sub.sym11.r2=sym7&sub.sym11.r1=sym7&sub.sym11.r0=sym7&gamestate.bonusid=alan-bonus&nextaction=freespin&rs.i0.r.i2.syms=SYM7%2CSYM9%2CSYM9%2CSYM8%2CSYM8&game.win.amount=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&freespins.totalwin.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&freespins.betlevel=1&playercurrency=%26%23x20AC%3B¤t.rs.i0=freespin&rs.i0.id=freespin&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&multiplier=1&last.rs=freespin&freespins.denomination=1.000&freespins.totalwin.coins=' . $bonusWin . '&freespins.total=' . $fs . '&gamestate.stack=basic%2Cfreespin&feature.shuffle.active=false&gamesoundurl=&playercurrencyiso=' . $slotSettings->slotCurrency . '&freespins.wavecount=1&freespins.multiplier=1&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM10%2CSYM10%2CSYM8&rs.i0.r.i2.pos=87&totalwin.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.r.i0.hold=false&freespins.left=' . $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 . '&rs.i0.r.i4.pos=53&wavecount=1&nextactiontype=roll&rs.i0.r.i3.hold=false' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32;
                        }
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'BonusType') == 'wildreels' ) 
                    {
                        if( $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 <= 0 ) 
                        {
                            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'previous.rs.i0=freespin&gameServerVersion=2.0.1&g4mode=false&freespins.win.coins=' . $bonusWin . '&feature.randomwilds.active=false&historybutton=false&sub.sym12.r4=sym6&rs.i0.r.i4.hold=false&sub.sym12.r3=sym6&next.rs=freespin&sub.sym12.r2=sym6&gamestate.history=basic%2Cbonus%2Cfreespin&sub.sym12.r1=sym6&sub.sym12.r0=sym6&rs.i0.r.i1.syms=SYM9%2CSYM9%2CSYM1%2CSYM8&game.win.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&nextclientrs=wildfeatures&totalwin.coins=' . $bonusWin . '&gamestate.current=bonus&freespins.initial=' . $fs . '&jackpotcurrency=%26%23x20AC%3B&bonus.rollsleft=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusRolls') . '&rs.i0.r.i0.syms=SYM10%2CSYM10%2CSYM9&rs.i0.r.i3.syms=SYM9%2CSYM9%2CSYM8%2CSYM8&feature.sticky.active=false&freespins.win.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&isJackpotWin=false&rs.i0.r.i0.pos=12&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19%2C20%2C21%2C22%2C23%2C24%2C25%2C26%2C27%2C28%2C29%2C30%2C31%2C32%2C33%2C34%2C35&feature.wildreels.active=true&rs.i0.r.i1.pos=8&game.win.coins=' . $bonusWin . '&rs.i0.r.i1.hold=false&clientaction=freespin&sub.sym13.r0=sym7&sub.sym13.r1=sym7&rs.i0.r.i2.hold=false&sub.sym13.r2=sym7&sub.sym13.r3=sym7&sub.sym13.r4=sym7&bonus.token=monkey&gameover=false&bonus.board.position=12&rs.i0.r.i3.pos=48&sub.sym11.r4=sym9&sub.sym11.r3=sym9&sub.sym11.r2=sym9&sub.sym11.r1=sym9&sub.sym11.r0=sym9&gamestate.bonusid=alan-bonus&nextaction=bonusaction&rs.i0.r.i2.syms=SYM10%2CSYM9%2CSYM6%2CSYM6%2CSYM4&game.win.amount=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&freespins.totalwin.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&freespins.betlevel=1&playercurrency=%26%23x20AC%3B¤t.rs.i0=freespin&rs.i0.id=freespin&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&multiplier=1&last.rs=freespin&freespins.denomination=1.000&freespins.totalwin.coins=' . $bonusWin . '&freespins.total=' . $fs . '&gamestate.stack=basic%2Cfreespin%2Cbonus&feature.shuffle.active=false&gamesoundurl=&playercurrencyiso=' . $slotSettings->slotCurrency . '&freespins.wavecount=1&freespins.multiplier=1&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM3%2CSYM3%2CSYM5&rs.i0.r.i2.pos=24&totalwin.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.r.i0.hold=false&bonus.feature.disabled=wildreels&freespins.left=0&rs.i0.r.i4.pos=32&wavecount=1&nextactiontype=roll&rs.i0.r.i3.hold=false' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32;
                        }
                        else
                        {
                            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'previous.rs.i0=freespin&gameServerVersion=2.0.1&g4mode=false&freespins.win.coins=' . $bonusWin . '&feature.randomwilds.active=false&historybutton=false&sub.sym12.r4=sym10&rs.i0.r.i4.hold=false&sub.sym12.r3=sym10&next.rs=freespin&sub.sym12.r2=sym10&gamestate.history=basic%2Cbonus%2Cfreespin&sub.sym12.r1=sym10&sub.sym12.r0=sym10&rs.i0.r.i1.syms=SYM3%2CSYM3%2CSYM7%2CSYM7&game.win.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&nextclientrs=wildfeatures&totalwin.coins=' . $bonusWin . '&gamestate.current=freespin&freespins.initial=' . $fs . '&jackpotcurrency=%26%23x20AC%3B&bonus.rollsleft=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusRolls') . '&rs.i0.r.i0.syms=SYM8%2CSYM5%2CSYM5&rs.i0.r.i3.syms=SYM8%2CSYM8%2CSYM7%2CSYM7&feature.sticky.active=false&freespins.win.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&isJackpotWin=false&rs.i0.r.i0.pos=78&freespins.betlines=0%2C1%2C2%2C3%2C4%2C5%2C6%2C7%2C8%2C9%2C10%2C11%2C12%2C13%2C14%2C15%2C16%2C17%2C18%2C19%2C20%2C21%2C22%2C23%2C24%2C25%2C26%2C27%2C28%2C29%2C30%2C31%2C32%2C33%2C34%2C35&feature.wildreels.active=true&rs.i0.r.i1.pos=4&game.win.coins=' . $bonusWin . '&rs.i0.r.i1.hold=false&clientaction=freespin&sub.sym13.r0=sym7&sub.sym13.r1=sym7&rs.i0.r.i2.hold=false&sub.sym13.r2=sym7&sub.sym13.r3=sym7&sub.sym13.r4=sym7&bonus.token=monkey&gameover=false&bonus.board.position=12&rs.i0.r.i3.pos=26&sub.sym11.r4=sym7&sub.sym11.r3=sym7&sub.sym11.r2=sym7&sub.sym11.r1=sym7&sub.sym11.r0=sym7&gamestate.bonusid=alan-bonus&nextaction=freespin&rs.i0.r.i2.syms=SYM7%2CSYM9%2CSYM9%2CSYM8%2CSYM8&game.win.amount=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&freespins.totalwin.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&freespins.betlevel=1&playercurrency=%26%23x20AC%3B¤t.rs.i0=freespin&rs.i0.id=freespin&credit=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '&multiplier=1&last.rs=freespin&freespins.denomination=1.000&freespins.totalwin.coins=' . $bonusWin . '&freespins.total=' . $fs . '&gamestate.stack=basic%2Cfreespin&feature.shuffle.active=false&gamesoundurl=&playercurrencyiso=' . $slotSettings->slotCurrency . '&freespins.wavecount=1&freespins.multiplier=1&playforfun=false&jackpotcurrencyiso=' . $slotSettings->slotCurrency . '&rs.i0.r.i4.syms=SYM10%2CSYM10%2CSYM8&rs.i0.r.i2.pos=87&totalwin.cents=' . ($bonusWin * $slotSettings->CurrentDenomination * 100) . '&rs.i0.r.i0.hold=false&freespins.left=' . $_obf_0D5B2132391B38031D040A1B1C132D1228043912362232 . '&rs.i0.r.i4.pos=53&wavecount=1&nextactiontype=roll&rs.i0.r.i3.hold=false' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . $_obf_0D3F3B0B11151D3B2C32310329232829150C093D070D32;
                        }
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
