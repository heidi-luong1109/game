<?php 
namespace VanguardLTE\Games\TheGoldenCityISB
{
    include('CheckReels.php');
    class Server
    {
        public function get($request, $game)
        {
           /* if( config('LicenseDK.APL_INCLUDE_KEY_CONFIG') != 'wi9qydosuimsnls5zoe5q298evkhim0ughx1w16qybs2fhlcpn' ) 
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
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = $_POST;
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = '';
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] = explode("\n", $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cmd']);
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] = trim($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'][0]);
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = (string)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'];
            switch( $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 ) 
            {
                case '1':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "undefined" , "data": { "logout": "1" } } }';
                    break;
                case '5814':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = [];
                    for( $i = 0; $i < count($slotSettings->Bet); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[] = $slotSettings->Bet[$i] * 100;
                    }
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * 100);
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $slotSettings->SetGameData($slotSettings->slotId . 'totalBetMultiplier', $lastEvent->serverResponse->totalBetMultiplier);
                        $reels = $lastEvent->serverResponse->reelsSymbols;
                        $lines = $lastEvent->serverResponse->slotLines;
                        $bet = $lastEvent->serverResponse->slotBet * 100;
                    }
                    else
                    {
                        $lines = 10;
                        $bet = $slotSettings->Bet[0] * 100;
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                    {
                        $totalBetMultiplier = $slotSettings->GetGameData($slotSettings->slotId . 'totalBetMultiplier');
                        $bonusWin = $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                        $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01 = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $_obf_0D0110310E3D180C0F042B065C2F2833284021033E0B32 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $_obf_0D2B212D321E2F13251A11275B252D3E120622091F1722 = ' "gameSpecific": { "totalBetMultiplier": "3" }, "freeGames": { "left": "' . ($_obf_0D0110310E3D180C0F042B065C2F2833284021033E0B32 - $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01) . '", "total": "' . $_obf_0D0110310E3D180C0F042B065C2F2833284021033E0B32 . '", "totalFreeGamesWinnings": "' . round($bonusWin * 100) . '", "totalFreeGamesWinningsMoney": "' . round($bonusWin * 100) . '", "multiplier": "1", "totalMultiplier": "1" },';
                    }
                    else
                    {
                        $totalBetMultiplier = 0;
                        $_obf_0D2B212D321E2F13251A11275B252D3E120622091F1722 = '';
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "5640f7f3-4693-4059-841a-dc3afd3f1925", "data": { "version": { "versionServer": "2.2.0.1-1", "versionGMAPI": "8.1.16 GS:2.5.1 FR:v4" }, "balance": { "cashBalance": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "freeBalance": "0", "ccyCode": "EUR", "ccyDecimal": { }, "ccyThousand": { }, "ccyPrefix": { }, "ccySuffix": { }, "ccyDecimalDigits": { } }, "id": { "roundId": "25520020301588680413177316196800814753252699" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "readValue": "1" }, "initial": { "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "coins": "1", "coinValue": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "lines": "20", "currentState": "beginGame", "lastGame": { "endGame": { ' . $_obf_0D2B212D321E2F13251A11275B252D3E120622091F1722 . '"money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "bet": "' . ($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] * 20) . '", "symbols": { "line": [ "-1--1--1--1--1", "-1--1--1--1--1", "-1--1--1--1--1" ] }, "lines": { }, "totalWinnings": "0", "totalWinningsMoney": "0", "doubleWin": { "totalWinnings": "0", "totalWinningsMoney": "0", "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '" }, "totalMultiplier": { }, "bonusRequest": { }, "gameSpecific": { "totalBetMultiplier": "' . $totalBetMultiplier . '" } } } } } } }';
                    break;
                case '192837':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "419427a2-d300-41d9-8d67-fe4eec61be5f", "data": "1" } }';
                    break;
                case '5347':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "26d1001c-15ff-4d21-af9e-45dde0260165", "data": { "success": "" } } }';
                    break;
                case '8':
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurStep', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurPos', 2);
                    $slotSettings->SetGameData($slotSettings->slotId . 'totalBetMultiplier', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'collectedCashWinUnlocks', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'currentCollectValue', 0);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "3fb14ec3-da73-4f7e-8455-04f49b0c2b9a", "data": { "bonusChoice": { "bonusId": "1", "choicesOrder": "0", "bonusGain": "0", "bonusGainMoney": "0", "choicesWinnings": "0", "totalBonusWinnings": "0", "totalBonusWinningsMoney": "0", "choicesMult": "1", "totalMultiplier": "1", "choicesFreeGames": "0" } } } }';
                    break;
                case '9':
                    $_obf_0D241E08390E290336210F233735223F3B172736302B22 = [
                        'myst', 
                        'm2', 
                        'start', 
                        's3', 
                        'k', 
                        'myst', 
                        's2', 
                        'k', 
                        's1', 
                        'm3', 
                        'myst', 
                        's2', 
                        'm2', 
                        's1', 
                        'start', 
                        'myst', 
                        's3', 
                        'k', 
                        'm3', 
                        's2'
                    ];
                    $FreeGames = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                    $CurStep = $slotSettings->GetGameData($slotSettings->slotId . 'CurStep');
                    $CurPos = $slotSettings->GetGameData($slotSettings->slotId . 'CurPos');
                    $totalBetMultiplier = $slotSettings->GetGameData($slotSettings->slotId . 'totalBetMultiplier');
                    $collectedCashWinUnlocks = $slotSettings->GetGameData($slotSettings->slotId . 'collectedCashWinUnlocks');
                    $_obf_0D32192C051C0C22052E0332370540271D283325351E32 = 1;
                    $_obf_0D271F1F3E38311C091A291C152E400F31341419031832 = rand(1, 4);
                    $_obf_0D3B1D3240161F03150317321F0A2C402D31151E361832 = '';
                    $currentCollectValue = 0;
                    $_obf_0D2A1221021D233727352B401F372D123D391E221B1B01 = '';
                    $_obf_0D30170D2D123F025B2F030E1C403F3909373906361D11 = $CurPos + $_obf_0D271F1F3E38311C091A291C152E400F31341419031832;
                    if( $_obf_0D30170D2D123F025B2F030E1C403F3909373906361D11 > 19 ) 
                    {
                        $_obf_0D30170D2D123F025B2F030E1C403F3909373906361D11 -= 20;
                    }
                    $_obf_0D142C241F1B181D2723252601234035375B141A063811 = $_obf_0D241E08390E290336210F233735223F3B172736302B22[$_obf_0D30170D2D123F025B2F030E1C403F3909373906361D11];
                    if( $_obf_0D142C241F1B181D2723252601234035375B141A063811 == 's1' ) 
                    {
                        $FreeGames += 1;
                        $currentCollectValue = 1;
                        $_obf_0D3B1D3240161F03150317321F0A2C402D31151E361832 = 'freespins';
                    }
                    if( $_obf_0D142C241F1B181D2723252601234035375B141A063811 == 's2' ) 
                    {
                        $FreeGames += 2;
                        $currentCollectValue = 2;
                        $_obf_0D3B1D3240161F03150317321F0A2C402D31151E361832 = 'freespins';
                    }
                    if( $_obf_0D142C241F1B181D2723252601234035375B141A063811 == 's3' ) 
                    {
                        $FreeGames += 3;
                        $currentCollectValue = 3;
                        $_obf_0D3B1D3240161F03150317321F0A2C402D31151E361832 = 'freespins';
                    }
                    if( $_obf_0D142C241F1B181D2723252601234035375B141A063811 == 'myst' ) 
                    {
                        $FreeGames += 1;
                        $_obf_0D2A1221021D233727352B401F372D123D391E221B1B01 = ',"randomWinType": "freespins", "randomWinValue": "1"';
                    }
                    if( $_obf_0D142C241F1B181D2723252601234035375B141A063811 == 'k' ) 
                    {
                        $collectedCashWinUnlocks++;
                        $currentCollectValue = 1;
                        $_obf_0D3B1D3240161F03150317321F0A2C402D31151E361832 = 'cash_win_unlock';
                    }
                    if( $_obf_0D142C241F1B181D2723252601234035375B141A063811 == 'm1' ) 
                    {
                        $totalBetMultiplier += 1;
                        $currentCollectValue = 1;
                        $_obf_0D3B1D3240161F03150317321F0A2C402D31151E361832 = 'total_bet_multiplier';
                    }
                    if( $_obf_0D142C241F1B181D2723252601234035375B141A063811 == 'm2' ) 
                    {
                        $totalBetMultiplier += 2;
                        $currentCollectValue = 2;
                        $_obf_0D3B1D3240161F03150317321F0A2C402D31151E361832 = 'total_bet_multiplier';
                    }
                    if( $_obf_0D142C241F1B181D2723252601234035375B141A063811 == 'm3' ) 
                    {
                        $totalBetMultiplier += 3;
                        $currentCollectValue = 3;
                        $_obf_0D3B1D3240161F03150317321F0A2C402D31151E361832 = 'total_bet_multiplier';
                    }
                    $_obf_0D3E21083F08162117392D1B2C02290127153B25392A01 = '';
                    if( $CurStep > 4 || $_obf_0D142C241F1B181D2723252601234035375B141A063811 == 'start' ) 
                    {
                        $_obf_0D32192C051C0C22052E0332370540271D283325351E32 = 0;
                        $_obf_0D3E21083F08162117392D1B2C02290127153B25392A01 = ', "choicesOrder": "1", "freeGamesWin": { "total": "' . $FreeGames . '", "multiplier": "1" }';
                        $_obf_0D3B1D3240161F03150317321F0A2C402D31151E361832 = 'start_freespins';
                    }
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * 100);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "3fb14ec3-da73-4f7e-8455-04f49b0c2b9a", "data": { "bonusWin": { "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "bonusRequest": "' . $_obf_0D32192C051C0C22052E0332370540271D283325351E32 . '", "bonusId": "1", "bonusesLeft": "' . $_obf_0D32192C051C0C22052E0332370540271D283325351E32 . '", "totalFreeGames": "0", "multiplier": "1", "totalMultiplier": "1", "choicesFreeGames": "0", "totalBonusWinnings": "0", "totalBonusWinningsMoney": "0", "choicesOrder": "0", "choicesWinnings": "0", "choicesMult": "1", "totalWinnings": "0", "totalWinningsMoney": "0" ' . $_obf_0D3E21083F08162117392D1B2C02290127153B25392A01 . ' }, "gameSpecific": { "move": "' . $CurStep . '", "advance": "' . $_obf_0D271F1F3E38311C091A291C152E400F31341419031832 . '", "lastPosition": "' . $CurPos . '", "currentPosition": "' . $_obf_0D30170D2D123F025B2F030E1C403F3909373906361D11 . '", "currentCollectType": "' . $_obf_0D3B1D3240161F03150317321F0A2C402D31151E361832 . '", "currentCollectValue": "' . $currentCollectValue . '" ' . $_obf_0D2A1221021D233727352B401F372D123D391E221B1B01 . ', "collectedTotalBetMultiplier": "' . $totalBetMultiplier . '", "collectedFreespins": "' . $FreeGames . '", "collectedCashWinUnlocks": "' . $collectedCashWinUnlocks . '" }, "doubleWin": { "totalWinnings": "0", "totalWinningsMoney": "0", "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '" }, "balance": { "cashBalance": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "freeBalance": "0" } } } }';
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $FreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurStep', $CurStep);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurPos', $_obf_0D30170D2D123F025B2F030E1C403F3909373906361D11);
                    $slotSettings->SetGameData($slotSettings->slotId . 'totalBetMultiplier', $totalBetMultiplier);
                    $slotSettings->SetGameData($slotSettings->slotId . 'collectedCashWinUnlocks', $collectedCashWinUnlocks);
                    break;
                case '2':
                    $_obf_0D3F1239363430233E3C0F0E15191F5B3B392F323E0122 = explode("\n", $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cmd']);
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
                        3, 
                        1, 
                        3, 
                        1
                    ];
                    $linesId[16] = [
                        3, 
                        1, 
                        3, 
                        1, 
                        3
                    ];
                    $linesId[17] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[18] = [
                        3, 
                        2, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[19] = [
                        1, 
                        3, 
                        3, 
                        3, 
                        1
                    ];
                    $totalBetMultiplier = $slotSettings->GetGameData($slotSettings->slotId . 'totalBetMultiplier');
                    $lines = 20;
                    $betline = trim($_obf_0D3F1239363430233E3C0F0E15191F5B3B392F323E0122[1]) / 100;
                    $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222 = trim($_obf_0D3F1239363430233E3C0F0E15191F5B3B392F323E0122[1]);
                    $allbet = $betline * $lines;
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                    }
                    if( $slotSettings->GetBalance() < $allbet && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid balance "}';
                        exit( $response );
                    }
                    if( $allbet <= 0 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid bet "}';
                        exit( $response );
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                    {
                        if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                        {
                            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                        }
                        $slotSettings->SetBalance(-1 * $allbet, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $allbet / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D262A401E2428360E103910312E0E2A2D04280B345B11 = $slotSettings->UpdateJackpots($allbet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'JackWinID', $_obf_0D262A401E2428360E103910312E0E2A2D04280B345B11['isJackId']);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                        $bonusMpl = 1;
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                        $bonusMpl = $slotSettings->slotFreeMpl;
                    }
                    $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $allbet, $lines);
                    $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                    $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                    if( $winType == 'bonus' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $winType = 'none';
                    }
                    $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 = round($slotSettings->GetBalance() * 100);
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
                            0
                        ];
                        $wild = ['9'];
                        $scatter = '10';
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            if( $reels['reel' . $r][2] == 9 ) 
                            {
                                $reels['reel' . $r][0] = '9';
                                $reels['reel' . $r][1] = '9';
                                $reels['reel' . $r][2] = '9';
                            }
                        }
                        $_obf_0D390225301D2E21373038281039131A192C011A3F0632 = [];
                        for( $rs = 0; $rs <= 50; $rs++ ) 
                        {
                            if( $rs == 0 ) 
                            {
                                $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722 = $reels;
                                $_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632 = $slotSettings->GetReelsWin($reels, 20, $betline, $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222, $linesId, $cWins, $rs);
                            }
                            else
                            {
                                $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722 = $slotSettings->OffsetReels($_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632['reelsOffset']);
                                $_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632 = $slotSettings->GetReelsWin($_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722, 20, $betline, $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222, $linesId, $cWins, $rs);
                            }
                            if( $_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632['totalWin'] <= 0 ) 
                            {
                                $reels = $slotSettings->OffsetReels($_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632['reelsOffset']);
                                break;
                            }
                            $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '';
                            $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('"' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel1'][0] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel2'][0] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel3'][0] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel4'][0] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel5'][0] . '"');
                            $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',"' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel1'][1] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel2'][1] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel3'][1] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel4'][1] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel5'][1] . '"');
                            $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',"' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel1'][2] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel2'][2] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel3'][2] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel4'][2] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel5'][2] . '"');
                            $_obf_0D390225301D2E21373038281039131A192C011A3F0632[] = '{ "symbols": { "line": [ ' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . ' ] }, "lines": { "line":[ ' . implode(',', $_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632['lineWins']) . ' ]}, "combo": "' . $rs . '", "winnings": "' . (($_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632['totalWin'] * 100) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "winningsMoney": "' . ($_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632['totalWin'] * 100) . '", "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '" }';
                            $totalWin += $_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632['totalWin'];
                        }
                        $_obf_0D0F401522220F2D0C35030823362B153E112A40285C22 = '';
                        if( $rs > 0 ) 
                        {
                            $_obf_0D0F401522220F2D0C35030823362B153E112A40285C22 = ',"spins": { "spin": [' . implode(',', $_obf_0D390225301D2E21373038281039131A192C011A3F0632) . '] }';
                        }
                        $scattersWin = 0;
                        $scattersStr = '';
                        $scattersCount = 0;
                        $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [];
                        for( $p = 0; $p <= 2; $p++ ) 
                        {
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                if( $reels['reel' . $r][$p] == $scatter ) 
                                {
                                    $scattersCount++;
                                    $_obf_0D312B19262C083426241E0D392E22282324060B380811[] = '1';
                                }
                                else
                                {
                                    $_obf_0D312B19262C083426241E0D392E22282324060B380811[] = '0';
                                }
                            }
                        }
                        $scattersWin = $slotSettings->Paytable['SYM_' . $scatter][$scattersCount] * $allbet;
                        $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 = 0;
                        if( $scattersCount >= 3 ) 
                        {
                            $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 = $slotSettings->slotFreeCount;
                            $scattersStr = ', "bonusRequest": "1", "bonuses": { "bonus": { "id": "1", "hl": "' . implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811) . '" } }';
                        }
                        if( $scattersCount >= 2 && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                            $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 = $slotSettings->slotFreeCount;
                            $scattersStr = ', "scatters": { "value": "' . (($totalBetMultiplier * 100 * $scattersCount) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "valueMoney": "' . ($totalBetMultiplier * $scattersCount * 100) . '", "multiplier": "' . $totalBetMultiplier . '", "hl": "' . implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811) . '" }';
                        }
                        $totalWin += $scattersWin;
                        if( $i > 500 ) 
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
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                        $slotSettings->SetBalance($totalWin);
                    }
                    $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                        $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    }
                    $fs = 0;
                    if( $scattersCount >= 3 ) 
                    {
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $slotSettings->slotFreeCount);
                        }
                        else
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                        }
                        $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                    }
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"totalBetMultiplier":' . $totalBetMultiplier . ',"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = $slotSettings->GetGameData($slotSettings->slotId . 'Cards');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '';
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('"' . $reels['reel1'][0] . '-' . $reels['reel2'][0] . '-' . $reels['reel3'][0] . '-' . $reels['reel4'][0] . '-' . $reels['reel5'][0] . '"');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',"' . $reels['reel1'][1] . '-' . $reels['reel2'][1] . '-' . $reels['reel3'][1] . '-' . $reels['reel4'][1] . '-' . $reels['reel5'][1] . '"');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',"' . $reels['reel1'][2] . '-' . $reels['reel2'][2] . '-' . $reels['reel3'][2] . '-' . $reels['reel4'][2] . '-' . $reels['reel5'][2] . '"');
                    $_obf_0D2D1F17141D3509383B2328141A060130300A0A242A11 = 'false';
                    if( $totalWin > 0 ) 
                    {
                        $state = 'gamble';
                    }
                    else
                    {
                        $state = 'idle';
                    }
                    if( !isset($_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832) ) 
                    {
                        $fs = 0;
                    }
                    else if( $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 > 0 ) 
                    {
                        $fs = $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832;
                    }
                    else
                    {
                        $fs = 0;
                    }
                    $_obf_0D1F37013027092805312223153703290C250F17350C22 = round($slotSettings->GetBalance() * 100);
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = [];
                    for( $i = 0; $i < count($slotSettings->Bet); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[] = $slotSettings->Bet[$i] * 100;
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "3fb14ec3-da73-4f7e-8455-04f49b0c2b9a", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "255841201589646528829739405937720334470878" }, "coinValues": { "coinValueList": "1,2,5,10,20,30,50,100", "coinValueDefault": "1", "readValue": "0" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "20", "symbols": { "line": [ ' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . ' ] }, "lines": { }' . $scattersStr . ', "freeGames": { "left": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . '", "total": "' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '", "totalFreeGamesWinnings": "' . (($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "totalFreeGamesWinningsMoney": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . '", "multiplier": "1", "totalMultiplier": "1" }, "totalWinnings": "' . round(($totalWin * 100) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "totalMultiplier": "1", "bonusRequest": "0", "gameSpecific": { "totalBetMultiplier": "0" } }' . $_obf_0D0F401522220F2D0C35030823362B153E112A40285C22 . ' , "doubleWin": { "totalWinnings": "' . round(($totalWin * 100) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "acf3f2cd-4e9a-4d9b-8073-5e71a535ec79", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "255841201589630792275407805802349536997145" }, "coinValues": { "coinValueList": "1,2,5,10,20,30,50,100", "coinValueDefault": "0", "readValue": "0" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "20", "symbols": { "line": [' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . ' ] }, "lines": { }, "totalWinnings": "' . round(($totalWin * 100) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "totalMultiplier": "1", "bonusRequest": "0" ' . $scattersStr . ' }' . $_obf_0D0F401522220F2D0C35030823362B153E112A40285C22 . ' , "doubleWin": { "totalWinnings": "' . round(($totalWin * 100) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
                        $slotSettings->SetGameData($slotSettings->slotId . 'LastResponse', $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0]);
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
