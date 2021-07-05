<?php 
namespace VanguardLTE\Games\FruitCocktail2IG
{
    include('CheckReels.php');
    class Server
    {
        public function get($request, $game)
        {
/*            if( config('LicenseDK.APL_INCLUDE_KEY_CONFIG') != 'wi9qydosuimsnls5zoe5q298evkhim0ughx1w16qybs2fhlcpn' ) 
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
            $response = '';
            \DB::beginTransaction();
            $userId = \Auth::id();
            if( $userId == null ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid login"}';
                exit( $response );
            }
            $slotSettings = new SlotSettings($game, $userId);
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = json_decode(trim(file_get_contents('php://input')), true);
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'start' ) 
            {
                if( !in_array($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'], $slotSettings->Bet) ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] . '","serverResponse":"invalid bet"}';
                    exit( $response );
                }
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines'] < 1 || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines'] > 9 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] . '","serverResponse":"invalid lines"}';
                    exit( $response );
                }
                if( $slotSettings->GetBalance() < ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet']) ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] . '","serverResponse":"invalid balance"}';
                    exit( $response );
                }
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == 'risk' && $slotSettings->GetGameData('FruitCocktail2IGWin') <= 0 ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] . '","serverResponse":"invalid gamble state"}';
                exit( $response );
            }
            switch( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] ) 
            {
                case 'init':
                    $balance = $slotSettings->GetBalance();
                    $_obf_0D402E0A231B12035C0D04115C242E5C1216061E023732 = $slotSettings->GetHistory();
                    if( $_obf_0D402E0A231B12035C0D04115C242E5C1216061E023732 != 'NULL' ) 
                    {
                        $bet = $_obf_0D402E0A231B12035C0D04115C242E5C1216061E023732->Bet;
                        $lines = $_obf_0D402E0A231B12035C0D04115C242E5C1216061E023732->Lines;
                        $reels = $slotSettings->GetReelStrips(false, false);
                        $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 = '[' . implode(',', $_obf_0D402E0A231B12035C0D04115C242E5C1216061E023732->Reels[0]) . '],' . '[' . implode(',', $_obf_0D402E0A231B12035C0D04115C242E5C1216061E023732->Reels[1]) . '],' . '[' . implode(',', $_obf_0D402E0A231B12035C0D04115C242E5C1216061E023732->Reels[2]) . ']';
                    }
                    else
                    {
                        $bet = 1;
                        $lines = 1;
                        $reels = $slotSettings->GetReelStrips(false, false);
                        $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 = '[' . $reels['reel1'][0] . ',' . $reels['reel2'][0] . ',' . $reels['reel3'][0] . ',' . $reels['reel4'][0] . ',' . $reels['reel5'][0] . '],';
                        $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 .= ('[' . $reels['reel1'][1] . ',' . $reels['reel2'][1] . ',' . $reels['reel3'][1] . ',' . $reels['reel4'][1] . ',' . $reels['reel5'][1] . '],');
                        $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 .= ('[' . $reels['reel1'][2] . ',' . $reels['reel2'][2] . ',' . $reels['reel3'][2] . ',' . $reels['reel4'][2] . ',' . $reels['reel5'][2] . ']');
                    }
                    $response = '{"Amount":"' . sprintf('%01.2f', $balance * $slotSettings->CurrentDenom) . '","BetArray":[' . implode(',', $slotSettings->Bet) . '],"Credit":"' . floor($balance) . '","Currency":"' . $slotSettings->slotCurrency . '","Denomination":"' . sprintf('%01.2f', $slotSettings->CurrentDenom) . '","FuseBet":' . $slotSettings->fuseBet . ',"HelpCoef":[[0,0,0],[200,1000,5000],[100,500,2000],[30,100,500],[20,50,200],[10,30,100],[5,10,50],[3,5,20],[2,3,10]],"LastBet":' . $bet . ',"LastFuse":false,"LastLines":' . $lines . ',"MaxWin":675000,"RawCredit":1000,"Reels":[' . $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 . '],"Win":0,"slotViewState":"' . $slotSettings->slotViewState . '","slotKeyConfig":' . $slotSettings->slotKeyConfig . ',"args":{},"cmd":"init","time":"20181111T111512"}';
                    break;
                case 'status':
                    if( !$slotSettings->HasGameData('FruitCocktail2IGLines') || !$slotSettings->HasGameData('FruitCocktail2IGBet') ) 
                    {
                        $slotSettings->SetGameData('FruitCocktail2IGLines', 1);
                        $slotSettings->SetGameData('FruitCocktail2IGBet', 1);
                    }
                    $balance = $slotSettings->GetBalance();
                    if( $slotSettings->GetGameData('FruitCocktail2IGWin') > 0 ) 
                    {
                        $balance = $balance - $slotSettings->GetGameData('FruitCocktail2IGWin');
                    }
                    $response = '{"Amount":"' . sprintf('%01.2f', $balance * $slotSettings->CurrentDenom) . '","BetArray":[' . implode(',', $slotSettings->Bet) . '],"Credit":"' . floor($balance) . '","Currency":"' . $slotSettings->slotCurrency . '","Denomination":"' . sprintf('%01.2f', $slotSettings->CurrentDenom) . '","FuseBet":' . $slotSettings->fuseBet . ',"HelpCoef":[[0,0,0],[200,1000,5000],[100,500,2000],[30,100,500],[20,50,200],[10,30,100],[5,10,50],[3,5,20],[2,3,10]],"LastBet":' . $slotSettings->GetGameData('FruitCocktail2IGBet') . ',"LastFuse":false,"LastLines":' . $slotSettings->GetGameData('FruitCocktail2IGLines') . ',"MaxWin":675000,"RawCredit":"' . $balance . '","Reels":[[7,1,5,3,8],[5,3,6,7,7],[6,8,7,8,1]],"Win":0,"args":{},"cmd":"status","time":"20181111T111512"}';
                    break;
                case 'start':
                    $balance = $slotSettings->GetBalance();
                    $bet = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'];
                    $lines = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines'];
                    $allbet = $bet * $lines;
                    if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    }
                    $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $allbet / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $slotSettings->UpdateJackpots($allbet);
                    $slotSettings->SetBalance(-1 * $allbet, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D2C080713260E3821133D2E360E292139310E2B060E22 = false;
                    $_obf_0D5C39151E192A0D0C273E041A211E31150B2201231D01 = false;
                    $_obf_0D14180F05373B223513111E21111C3C11362E232F1532 = false;
                    $_obf_0D2C3832163F282A5C100B120D1405400B1F0A131C1201 = $slotSettings->GetSpinSettings($bet * $lines, $lines);
                    if( $_obf_0D2C3832163F282A5C100B120D1405400B1F0A131C1201[0] == 'bonus' ) 
                    {
                        $_obf_0D0E391C32053D212E05302F3C1E263C070F24321D1522 = rand(1, 2);
                        if( $_obf_0D0E391C32053D212E05302F3C1E263C070F24321D1522 == 1 ) 
                        {
                            $_obf_0D5C39151E192A0D0C273E041A211E31150B2201231D01 = true;
                        }
                        else
                        {
                            $_obf_0D14180F05373B223513111E21111C3C11362E232F1532 = true;
                        }
                    }
                    else if( $_obf_0D2C3832163F282A5C100B120D1405400B1F0A131C1201[0] == 'win' ) 
                    {
                        $_obf_0D2C080713260E3821133D2E360E292139310E2B060E22 = true;
                    }
                    $bank = $_obf_0D2C3832163F282A5C100B120D1405400B1F0A131C1201[1];
                    $fuseBet = false;
                    if( $slotSettings->fuseBet < ($bet * $lines) ) 
                    {
                        $fuseBet = true;
                    }
                    $linesId = [];
                    $linesId[1] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[2] = [
                        1, 
                        1, 
                        1, 
                        1, 
                        1
                    ];
                    $linesId[3] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[4] = [
                        1, 
                        2, 
                        3, 
                        2, 
                        1
                    ];
                    $linesId[5] = [
                        3, 
                        2, 
                        1, 
                        2, 
                        3
                    ];
                    $linesId[6] = [
                        1, 
                        1, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[7] = [
                        3, 
                        3, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[8] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[9] = [
                        2, 
                        1, 
                        1, 
                        1, 
                        2
                    ];
                    $wild = 2;
                    $scatter = 0;
                    for( $i = 0; $i <= 1500; $i++ ) 
                    {
                        $totalWin = 0;
                        $reels = $slotSettings->GetReelStrips($_obf_0D5C39151E192A0D0C273E041A211E31150B2201231D01, $_obf_0D14180F05373B223513111E21111C3C11362E232F1532);
                        $lineWins = [
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
                        $_obf_0D2E2C22030E1319363302050D0B2C260304225C1C2311 = [];
                        for( $line = 1; $line <= $lines; $line++ ) 
                        {
                            $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22 = [];
                            $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22 = [
                                -1, 
                                -1, 
                                -1, 
                                -1, 
                                -1, 
                                -1
                            ];
                            for( $_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 = 0; $_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 <= 4; $_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01++ ) 
                            {
                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[$_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01] = $linesId[$line][$_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01] - 1;
                                $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[$_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 + 1] = $reels['reel' . ($_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 + 1)][$_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[$_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01]];
                            }
                            $_obf_0D043B2E133506302A0105273B1C10401E1C3D14100322 = null;
                            foreach( $slotSettings->Paytable as $sym => $_obf_0D5B3B140A02163B213D3F0837340C07390F143D1F0432 ) 
                            {
                                if( $sym == 1 ) 
                                {
                                    $wild = -1;
                                }
                                else
                                {
                                    $wild = 2;
                                }
                                if( ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[1] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[1] == $wild) && ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[2] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[2] == $wild) && ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[3] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[3] == $wild) ) 
                                {
                                    $_obf_0D142C241F1B181D2723252601234035375B141A063811 = $_obf_0D5B3B140A02163B213D3F0837340C07390F143D1F0432[3] * $bet;
                                    if( $lineWins[$line] < $_obf_0D142C241F1B181D2723252601234035375B141A063811 ) 
                                    {
                                        $lineWins[$line] = $_obf_0D142C241F1B181D2723252601234035375B141A063811;
                                        $_obf_0D043B2E133506302A0105273B1C10401E1C3D14100322 = (object)[
                                            'Pos' => [
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[0], 
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[1], 
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[2], 
                                                -1, 
                                                -1
                                            ], 
                                            'Element' => $sym, 
                                            'Count' => 3, 
                                            'Line' => $line, 
                                            'Coef' => $_obf_0D5B3B140A02163B213D3F0837340C07390F143D1F0432[3], 
                                            'Win' => $_obf_0D142C241F1B181D2723252601234035375B141A063811
                                        ];
                                    }
                                }
                                if( ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[4] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[4] == $wild) && ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[5] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[5] == $wild) && ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[3] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[3] == $wild) ) 
                                {
                                    $_obf_0D142C241F1B181D2723252601234035375B141A063811 = $_obf_0D5B3B140A02163B213D3F0837340C07390F143D1F0432[3] * $bet;
                                    if( $lineWins[$line] < $_obf_0D142C241F1B181D2723252601234035375B141A063811 ) 
                                    {
                                        $lineWins[$line] = $_obf_0D142C241F1B181D2723252601234035375B141A063811;
                                        $_obf_0D043B2E133506302A0105273B1C10401E1C3D14100322 = (object)[
                                            'Pos' => [
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[0], 
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[1], 
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[2], 
                                                -1, 
                                                -1
                                            ], 
                                            'Element' => $sym, 
                                            'Count' => 3, 
                                            'Line' => $line, 
                                            'Coef' => $_obf_0D5B3B140A02163B213D3F0837340C07390F143D1F0432[3], 
                                            'Win' => $_obf_0D142C241F1B181D2723252601234035375B141A063811
                                        ];
                                    }
                                }
                                if( ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[1] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[1] == $wild) && ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[2] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[2] == $wild) && ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[3] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[3] == $wild) && ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[4] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[4] == $wild) ) 
                                {
                                    $_obf_0D142C241F1B181D2723252601234035375B141A063811 = $_obf_0D5B3B140A02163B213D3F0837340C07390F143D1F0432[4] * $bet;
                                    if( $lineWins[$line] < $_obf_0D142C241F1B181D2723252601234035375B141A063811 ) 
                                    {
                                        $lineWins[$line] = $_obf_0D142C241F1B181D2723252601234035375B141A063811;
                                        $_obf_0D043B2E133506302A0105273B1C10401E1C3D14100322 = (object)[
                                            'Pos' => [
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[0], 
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[1], 
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[2], 
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[3], 
                                                -1
                                            ], 
                                            'Element' => $sym, 
                                            'Count' => 4, 
                                            'Line' => $line, 
                                            'Coef' => $_obf_0D5B3B140A02163B213D3F0837340C07390F143D1F0432[4], 
                                            'Win' => $_obf_0D142C241F1B181D2723252601234035375B141A063811
                                        ];
                                    }
                                }
                                if( ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[5] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[5] == $wild) && ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[2] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[2] == $wild) && ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[3] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[3] == $wild) && ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[4] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[4] == $wild) ) 
                                {
                                    $_obf_0D142C241F1B181D2723252601234035375B141A063811 = $_obf_0D5B3B140A02163B213D3F0837340C07390F143D1F0432[4] * $bet;
                                    if( $lineWins[$line] < $_obf_0D142C241F1B181D2723252601234035375B141A063811 ) 
                                    {
                                        $lineWins[$line] = $_obf_0D142C241F1B181D2723252601234035375B141A063811;
                                        $_obf_0D043B2E133506302A0105273B1C10401E1C3D14100322 = (object)[
                                            'Pos' => [
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[0], 
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[1], 
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[2], 
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[3], 
                                                -1
                                            ], 
                                            'Element' => $sym, 
                                            'Count' => 4, 
                                            'Line' => $line, 
                                            'Coef' => $_obf_0D5B3B140A02163B213D3F0837340C07390F143D1F0432[4], 
                                            'Win' => $_obf_0D142C241F1B181D2723252601234035375B141A063811
                                        ];
                                    }
                                }
                                if( ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[1] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[1] == $wild) && ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[2] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[2] == $wild) && ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[3] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[3] == $wild) && ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[4] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[4] == $wild) && ($_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[5] == $sym || $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22[5] == $wild) ) 
                                {
                                    $_obf_0D142C241F1B181D2723252601234035375B141A063811 = $_obf_0D5B3B140A02163B213D3F0837340C07390F143D1F0432[5] * $bet;
                                    if( $lineWins[$line] < $_obf_0D142C241F1B181D2723252601234035375B141A063811 ) 
                                    {
                                        $lineWins[$line] = $_obf_0D142C241F1B181D2723252601234035375B141A063811;
                                        $_obf_0D043B2E133506302A0105273B1C10401E1C3D14100322 = (object)[
                                            'Pos' => [
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[0], 
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[1], 
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[2], 
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[3], 
                                                $_obf_0D2A0C255B0226211C3B2E0E3D01171A1B351A182A5B22[4]
                                            ], 
                                            'Element' => $sym, 
                                            'Count' => 5, 
                                            'Line' => $line, 
                                            'Coef' => $_obf_0D5B3B140A02163B213D3F0837340C07390F143D1F0432[5], 
                                            'Win' => $_obf_0D142C241F1B181D2723252601234035375B141A063811
                                        ];
                                    }
                                }
                            }
                            if( $_obf_0D043B2E133506302A0105273B1C10401E1C3D14100322 != null ) 
                            {
                                $_obf_0D2E2C22030E1319363302050D0B2C260304225C1C2311[] = $_obf_0D043B2E133506302A0105273B1C10401E1C3D14100322;
                                $totalWin += $lineWins[$line];
                            }
                        }
                        if( $i >= 300 ) 
                        {
                            $_obf_0D14180F05373B223513111E21111C3C11362E232F1532 = false;
                            $_obf_0D2C080713260E3821133D2E360E292139310E2B060E22 = false;
                        }
                        if( $i >= 1200 ) 
                        {
                            $_obf_0D5C39151E192A0D0C273E041A211E31150B2201231D01 = false;
                            $_obf_0D2C080713260E3821133D2E360E292139310E2B060E22 = false;
                        }
                        if( $i >= 1500 ) 
                        {
                            exit( '{error:"Bad Reel Strips"}' );
                        }
                        $bonusSym = 0;
                        $_obf_0D3D31320F040A1F042F3539050106042B0B0C061F1701 = 0;
                        for( $_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 = 0; $_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 <= 4; $_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01++ ) 
                        {
                            if( $reels['reel' . ($_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 + 1)][0] == 0 ) 
                            {
                                $bonusSym++;
                            }
                            if( $reels['reel' . ($_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 + 1)][1] == 0 ) 
                            {
                                $bonusSym++;
                            }
                            if( $reels['reel' . ($_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 + 1)][2] == 0 ) 
                            {
                                $bonusSym++;
                            }
                            if( $reels['reel' . ($_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 + 1)][0] == 9 ) 
                            {
                                $_obf_0D3D31320F040A1F042F3539050106042B0B0C061F1701++;
                            }
                            if( $reels['reel' . ($_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 + 1)][1] == 9 ) 
                            {
                                $_obf_0D3D31320F040A1F042F3539050106042B0B0C061F1701++;
                            }
                            if( $reels['reel' . ($_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 + 1)][2] == 9 ) 
                            {
                                $_obf_0D3D31320F040A1F042F3539050106042B0B0C061F1701++;
                            }
                        }
                        if( $_obf_0D5C39151E192A0D0C273E041A211E31150B2201231D01 ) 
                        {
                            $_obf_0D5B0D190F07273911051D090F2C1C12103018242A5C32 = $slotSettings->Bonus($bet * $lines, $fuseBet, $bonusSym);
                            $totalWin += $_obf_0D5B0D190F07273911051D090F2C1C12103018242A5C32['win'];
                            $_obf_0D300523062B1B32265B033B2F1D2C3B0D28045C3F1232 = $_obf_0D5B0D190F07273911051D090F2C1C12103018242A5C32['info'];
                        }
                        else
                        {
                            $_obf_0D300523062B1B32265B033B2F1D2C3B0D28045C3F1232 = '';
                        }
                        $_obf_0D245C37111F0A5B333F0B182D5C0D2B5B2925312B3411 = 0;
                        if( $_obf_0D3D31320F040A1F042F3539050106042B0B0C061F1701 >= 3 ) 
                        {
                            $_obf_0D3E160C18382D0307082C02363C5C175C183011161C01 = 10;
                            if( $_obf_0D3D31320F040A1F042F3539050106042B0B0C061F1701 == 4 ) 
                            {
                                $_obf_0D3E160C18382D0307082C02363C5C175C183011161C01 = 20;
                            }
                            if( $_obf_0D3D31320F040A1F042F3539050106042B0B0C061F1701 == 5 ) 
                            {
                                $_obf_0D3E160C18382D0307082C02363C5C175C183011161C01 = 50;
                            }
                            $_obf_0D0F251F2E24142F082F3B340E33305C33232C19090932 = $slotSettings->GetFreeSpins($bet, $lines, $_obf_0D3E160C18382D0307082C02363C5C175C183011161C01);
                            $_obf_0D245C37111F0A5B333F0B182D5C0D2B5B2925312B3411 = $_obf_0D0F251F2E24142F082F3B340E33305C33232C19090932[0];
                            $_obf_0D300523062B1B32265B033B2F1D2C3B0D28045C3F1232 = '"FreeGames":[' . implode(',', $_obf_0D0F251F2E24142F082F3B340E33305C33232C19090932[1]) . '], "FreeGamesCnt":' . $_obf_0D3E160C18382D0307082C02363C5C175C183011161C01 . ',';
                        }
                        if( $slotSettings->increaseRTP && $_obf_0D2C080713260E3821133D2E360E292139310E2B060E22 && $totalWin < ($allbet * rand(2, 5)) ) 
                        {
                        }
                        else if( !$slotSettings->increaseRTP && $_obf_0D2C080713260E3821133D2E360E292139310E2B060E22 && $allbet < $totalWin ) 
                        {
                        }
                        else if( $bonusSym >= 3 && !$_obf_0D5C39151E192A0D0C273E041A211E31150B2201231D01 ) 
                        {
                        }
                        else if( $_obf_0D3D31320F040A1F042F3539050106042B0B0C061F1701 >= 3 && !$_obf_0D14180F05373B223513111E21111C3C11362E232F1532 ) 
                        {
                        }
                        else if( $bank < ($totalWin + $_obf_0D245C37111F0A5B333F0B182D5C0D2B5B2925312B3411) ) 
                        {
                        }
                        else
                        {
                            if( $totalWin > 0 && $_obf_0D5C39151E192A0D0C273E041A211E31150B2201231D01 ) 
                            {
                                break;
                            }
                            if( $totalWin <= $bank && $_obf_0D14180F05373B223513111E21111C3C11362E232F1532 ) 
                            {
                                break;
                            }
                            if( $totalWin > 0 && $_obf_0D2C080713260E3821133D2E360E292139310E2B060E22 ) 
                            {
                                break;
                            }
                            if( $totalWin == 0 && !$_obf_0D2C080713260E3821133D2E360E292139310E2B060E22 ) 
                            {
                                break;
                            }
                        }
                    }
                    $_obf_0D3C3E1B3B390A080B195B1A04080B3C3B0F3026272332 = $totalWin + $_obf_0D245C37111F0A5B333F0B182D5C0D2B5B2925312B3411;
                    if( $_obf_0D3C3E1B3B390A080B195B1A04080B3C3B0F3026272332 != 0 ) 
                    {
                        $slotSettings->SetBalance($_obf_0D3C3E1B3B390A080B195B1A04080B3C3B0F3026272332);
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D3C3E1B3B390A080B195B1A04080B3C3B0F3026272332 * -1);
                    }
                    $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 = '[' . $reels['reel1'][0] . ',' . $reels['reel2'][0] . ',' . $reels['reel3'][0] . ',' . $reels['reel4'][0] . ',' . $reels['reel5'][0] . '],';
                    $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 .= ('[' . $reels['reel1'][1] . ',' . $reels['reel2'][1] . ',' . $reels['reel3'][1] . ',' . $reels['reel4'][1] . ',' . $reels['reel5'][1] . '],');
                    $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 .= ('[' . $reels['reel1'][2] . ',' . $reels['reel2'][2] . ',' . $reels['reel3'][2] . ',' . $reels['reel4'][2] . ',' . $reels['reel5'][2] . ']');
                    $balance = $balance - ($bet * $lines);
                    $_obf_0D152F2B13101C1F2D320B1C302214192A26071A401E32 = $slotSettings->GetDealerCard();
                    if( isset($slotSettings->Jackpots['jackPay']) && $slotSettings->Jackpots['jackPay'] ) 
                    {
                        $jackPay = $slotSettings->Jackpots['jackPay'];
                    }
                    else
                    {
                        $jackPay = 0;
                    }
                    $response = '{"bs":"' . $bonusSym . '", "Amount":"' . sprintf('%01.2f', $balance * $slotSettings->CurrentDenom) . '",' . $_obf_0D300523062B1B32265B033B2F1D2C3B0D28045C3F1232 . '"Credit":' . floor($balance) . ',"Fuse":false,"LineWins":' . json_encode($_obf_0D2E2C22030E1319363302050D0B2C260304225C1C2311) . ',"RawCredit":' . floor($balance) . ',"RiskCard":' . $slotSettings->cardsID[$_obf_0D152F2B13101C1F2D320B1C302214192A26071A401E32] . ',"Reels":[' . $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 . '],"Lines":' . $lines . ',"Bet":' . $bet . ',"TotalBet":' . ($bet * $lines) . ',"Win":' . $totalWin . ',"args":{},"cmd":"start","Bonusing":' . $jackPay . ',"time":"20181111T174113"}';
                    $slotSettings->SetGameData('FruitCocktail2IGReels', $_obf_0D282A3E130518100418230D042B0A2B400930193F3232);
                    $slotSettings->SetGameData('FruitCocktail2IGWin', $totalWin + $_obf_0D245C37111F0A5B333F0B182D5C0D2B5B2925312B3411);
                    $slotSettings->SetGameData('FruitCocktail2IGRisk', 1);
                    $slotSettings->SetGameData('FruitCocktail2IGLines', $lines);
                    $slotSettings->SetGameData('FruitCocktail2IGBet', $bet);
                    $slotSettings->SetGameData('FruitCocktail2IGDealerCard', $_obf_0D152F2B13101C1F2D320B1C302214192A26071A401E32);
                    $_obf_0D40110C403C2D2D0B3B020B223932223F0B3F380D3711 = 'bet';
                    if( $_obf_0D5C39151E192A0D0C273E041A211E31150B2201231D01 ) 
                    {
                        $_obf_0D40110C403C2D2D0B3B020B223932223F0B3F380D3711 = 'BG';
                    }
                    if( $_obf_0D14180F05373B223513111E21111C3C11362E232F1532 ) 
                    {
                        $_obf_0D40110C403C2D2D0B3B020B223932223F0B3F380D3711 = 'FG';
                    }
                    $slotSettings->SaveLogReport($response, $bet, $lines, $totalWin + $_obf_0D245C37111F0A5B333F0B182D5C0D2B5B2925312B3411, $_obf_0D40110C403C2D2D0B3B020B223932223F0B3F380D3711);
                    break;
                case 'finish':
                    $balance = $slotSettings->GetBalance();
                    $slotSettings->SetGameData('FruitCocktail2IGWin', 0);
                    $response = '{"Amount":"' . sprintf('%01.2f', $balance * $slotSettings->CurrentDenom) . '","Credit":' . floor($balance) . ',"RawCredit":' . floor($balance) . ',"Reels":[' . $slotSettings->GetGameData('FruitCocktail2IGReels') . '],"args":{},"cmd":"finish","time":"20181111T171830"}';
                    break;
                case 'risk':
                    $_obf_0D06305C0C0D402F222A16061E0C3C182B3D0912301632 = [];
                    $_obf_0D06305C0C0D402F222A16061E0C3C182B3D0912301632[] = $slotSettings->cardsID[$slotSettings->GetGameData($slotSettings->slotId . 'DealerCard')];
                    $_obf_0D3C3C291E1C0C35190328050B241A1B1823083E080C01 = [
                        '2', 
                        '3', 
                        '4', 
                        '5', 
                        '6', 
                        '7', 
                        '8', 
                        '9', 
                        'T', 
                        'J', 
                        'Q', 
                        'K', 
                        'A', 
                        'JOKER'
                    ];
                    $_obf_0D1D3414043419265B0F1435131D401D0705351B330301 = [
                        'C', 
                        'D', 
                        'S', 
                        'H'
                    ];
                    $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $slotSettings->GetGameData($slotSettings->slotId . 'DealerCard');
                    $_obf_0D5B2F152A29273D273610231B31153C180F3412271722 = rand(1, 2);
                    $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    $_obf_0D142C241F1B181D2723252601234035375B141A063811 = $slotSettings->GetGameData($slotSettings->slotId . 'Win');
                    $_obf_0D26162103330B0A341E0A1B3B1A0F271B140614180722 = $slotSettings->GetGameData($slotSettings->slotId . 'Win');
                    $_obf_0D14021B140C243D5C1C2E3E23212C17102934341D0E11 = $_obf_0D142C241F1B181D2723252601234035375B141A063811 * 2;
                    $slotSettings->SetGameData($slotSettings->slotId . 'Risk', $slotSettings->GetGameData($slotSettings->slotId . 'Risk') + 1);
                    $_obf_0D1003222E11232A3C021F081E07131D1D233E2B0F5B11 = $slotSettings->GetGameData($slotSettings->slotId . 'Risk');
                    $_obf_0D2E2D352519300D1C161E05101B3D341B0C3B1C1B0E22 = [];
                    $_obf_0D37275B24252821042D1A1E0C281C260429221D220932 = $slotSettings->GetDealerCard();
                    $_obf_0D0E2239233F403F07083639251E13090F2334173D3C01 = array_search($_obf_0D25035C31183316381216122811401A1F2A17243E2B22[0], $_obf_0D3C3C291E1C0C35190328050B241A1B1823083E080C01);
                    if( $_obf_0D5B2F152A29273D273610231B31153C180F3412271722 == 1 && $_obf_0D142C241F1B181D2723252601234035375B141A063811 <= $bank ) 
                    {
                        $_obf_0D022D1F301438111B371D2C3C24173F1C5C21250D1632 = rand($_obf_0D0E2239233F403F07083639251E13090F2334173D3C01, 13);
                    }
                    else
                    {
                        $_obf_0D022D1F301438111B371D2C3C24173F1C5C21250D1632 = rand(0, $_obf_0D0E2239233F403F07083639251E13090F2334173D3C01);
                    }
                    if( $_obf_0D0E2239233F403F07083639251E13090F2334173D3C01 < $_obf_0D022D1F301438111B371D2C3C24173F1C5C21250D1632 ) 
                    {
                        $balance = $slotSettings->SetBalance($_obf_0D142C241F1B181D2723252601234035375B141A063811);
                        $balance = $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $_obf_0D142C241F1B181D2723252601234035375B141A063811);
                    }
                    else if( $_obf_0D022D1F301438111B371D2C3C24173F1C5C21250D1632 == $_obf_0D0E2239233F403F07083639251E13090F2334173D3C01 ) 
                    {
                        $_obf_0D14021B140C243D5C1C2E3E23212C17102934341D0E11 = $_obf_0D142C241F1B181D2723252601234035375B141A063811;
                    }
                    else
                    {
                        $_obf_0D14021B140C243D5C1C2E3E23212C17102934341D0E11 = 0;
                        $balance = $slotSettings->SetBalance(-1 * $_obf_0D142C241F1B181D2723252601234035375B141A063811);
                        $balance = $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D142C241F1B181D2723252601234035375B141A063811);
                    }
                    $ch = 0;
                    while( $ch < 500 ) 
                    {
                        shuffle($_obf_0D1D3414043419265B0F1435131D401D0705351B330301);
                        $_obf_0D283E1232290B032F3C29391E381D39322B320B170A11 = $_obf_0D3C3C291E1C0C35190328050B241A1B1823083E080C01[$_obf_0D022D1F301438111B371D2C3C24173F1C5C21250D1632] . $_obf_0D1D3414043419265B0F1435131D401D0705351B330301[0];
                        if( in_array($slotSettings->cardsID[$_obf_0D283E1232290B032F3C29391E381D39322B320B170A11], $_obf_0D06305C0C0D402F222A16061E0C3C182B3D0912301632) ) 
                        {
                            continue;
                        }
                        $_obf_0D06305C0C0D402F222A16061E0C3C182B3D0912301632[] = $slotSettings->cardsID[$_obf_0D283E1232290B032F3C29391E381D39322B320B170A11];
                        break;
                    }
                    $ch = 0;
                    while( $ch < 500 ) 
                    {
                        $_obf_0D345B111230192C392A171C0C01403825031629271501 = 0;
                        shuffle($_obf_0D1D3414043419265B0F1435131D401D0705351B330301);
                        shuffle($_obf_0D3C3C291E1C0C35190328050B241A1B1823083E080C01);
                        if( in_array($slotSettings->cardsID[$_obf_0D3C3C291E1C0C35190328050B241A1B1823083E080C01[0] . $_obf_0D1D3414043419265B0F1435131D401D0705351B330301[0]], $_obf_0D06305C0C0D402F222A16061E0C3C182B3D0912301632) ) 
                        {
                            continue;
                        }
                        $_obf_0D06305C0C0D402F222A16061E0C3C182B3D0912301632[] = $slotSettings->cardsID[$_obf_0D3C3C291E1C0C35190328050B241A1B1823083E080C01[0] . $_obf_0D1D3414043419265B0F1435131D401D0705351B330301[0]];
                        $_obf_0D2E2D352519300D1C161E05101B3D341B0C3B1C1B0E22[] = $slotSettings->cardsID[$_obf_0D3C3C291E1C0C35190328050B241A1B1823083E080C01[0] . $_obf_0D1D3414043419265B0F1435131D401D0705351B330301[0]];
                        if( count($_obf_0D06305C0C0D402F222A16061E0C3C182B3D0912301632) >= 5 ) 
                        {
                            break;
                        }
                    }
                    $balance = $slotSettings->GetBalance();
                    $slotSettings->SetGameData($slotSettings->slotId . 'Win', $_obf_0D14021B140C243D5C1C2E3E23212C17102934341D0E11);
                    $slotSettings->SetGameData($slotSettings->slotId . 'DealerCard', $_obf_0D37275B24252821042D1A1E0C281C260429221D220932);
                    $response = '{"$onTabCards":' . json_encode($_obf_0D06305C0C0D402F222A16061E0C3C182B3D0912301632) . ',"cc":"' . $_obf_0D022D1F301438111B371D2C3C24173F1C5C21250D1632 . '|' . $_obf_0D0E2239233F403F07083639251E13090F2334173D3C01 . '","Lines":' . $slotSettings->GetGameData($slotSettings->slotId . 'Lines') . ',"Bet":' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet') . ',"Amount":"' . sprintf('%01.2f', $balance * $slotSettings->CurrentDenom) . '","Reels":[' . $slotSettings->GetGameData($slotSettings->slotId . 'Reels') . '],"Credit":' . floor($balance) . ',"Dealer":' . $slotSettings->cardsID[$_obf_0D25035C31183316381216122811401A1F2A17243E2B22] . ',"Other":[' . implode(',', $_obf_0D2E2D352519300D1C161E05101B3D341B0C3B1C1B0E22) . '],"Player":' . $slotSettings->cardsID[$_obf_0D283E1232290B032F3C29391E381D39322B320B170A11] . ',"PrevWin":' . $_obf_0D142C241F1B181D2723252601234035375B141A063811 . ',"RawCredit":' . floor($balance) . ',"RiskCard":' . $slotSettings->cardsID[$_obf_0D37275B24252821042D1A1E0C281C260429221D220932] . ',"Step":' . $_obf_0D1003222E11232A3C021F081E07131D1D233E2B0F5B11 . ',"Win":' . $_obf_0D14021B140C243D5C1C2E3E23212C17102934341D0E11 . ',"args":{},"cmd":"risk","time":"20181111T172027"}';
                    if( $_obf_0D14021B140C243D5C1C2E3E23212C17102934341D0E11 == 0 ) 
                    {
                        $_obf_0D14021B140C243D5C1C2E3E23212C17102934341D0E11 = -1 * $_obf_0D142C241F1B181D2723252601234035375B141A063811;
                    }
                    $slotSettings->SaveLogReport($response, $_obf_0D26162103330B0A341E0A1B3B1A0F271B140614180722, 1, $_obf_0D14021B140C243D5C1C2E3E23212C17102934341D0E11, 'slotGamble');
                    break;
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
