<?php 
namespace VanguardLTE\Games\LostBoysLootISB
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
                        $bonusWin = $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                        $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01 = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $_obf_0D0110310E3D180C0F042B065C2F2833284021033E0B32 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $_obf_0D2B212D321E2F13251A11275B252D3E120622091F1722 = '"freeGames": { "left": "' . ($_obf_0D0110310E3D180C0F042B065C2F2833284021033E0B32 - $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01) . '", "total": "' . $_obf_0D0110310E3D180C0F042B065C2F2833284021033E0B32 . '", "totalFreeGamesWinnings": "' . round($bonusWin * 100) . '", "totalFreeGamesWinningsMoney": "' . round($bonusWin * 100) . '", "multiplier": "1", "totalMultiplier": "1" },';
                    }
                    else
                    {
                        $_obf_0D2B212D321E2F13251A11275B252D3E120622091F1722 = '';
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "5640f7f3-4693-4059-841a-dc3afd3f1925", "data": { "version": { "versionServer": "2.2.0.1-1", "versionGMAPI": "8.1.16 GS:2.5.1 FR:v4" }, "balance": { "cashBalance": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "freeBalance": "0", "ccyCode": "EUR", "ccyDecimal": { }, "ccyThousand": { }, "ccyPrefix": { }, "ccySuffix": { }, "ccyDecimalDigits": { } }, "id": { "roundId": "25520020301588680413177316196800814753252699" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "readValue": "1" }, "initial": { "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "coins": "1", "coinValue": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "lines": "20", "currentState": "beginGame", "lastGame": { "endGame": { ' . $_obf_0D2B212D321E2F13251A11275B252D3E120622091F1722 . '"money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "bet": "' . ($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] * 20) . '", "symbols": { "line": [ "-1--1--1--1--1", "-1--1--1--1--1", "-1--1--1--1--1" ] }, "lines": { }, "totalWinnings": "0", "totalWinningsMoney": "0", "doubleWin": { "totalWinnings": "0", "totalWinningsMoney": "0", "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '" }, "totalMultiplier": { }, "bonusRequest": { } } } } } } }';
                    break;
                case '192837':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "419427a2-d300-41d9-8d67-fe4eec61be5f", "data": "1" } }';
                    break;
                case '5347':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "26d1001c-15ff-4d21-af9e-45dde0260165", "data": { "success": "" } } }';
                    break;
                case '8':
                    $chestWinsInit = $slotSettings->GetGameData($slotSettings->slotId . 'chestWinsInit');
                    $chestWinTotal = $slotSettings->GetGameData($slotSettings->slotId . 'chestWinTotal');
                    $chestWinAllBet = $slotSettings->GetGameData($slotSettings->slotId . 'chestWinAllBet');
                    $betlineRaw = $slotSettings->GetGameData($slotSettings->slotId . 'betlineRaw');
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "42128a66-ed28-4459-b1b1-f37588f73064", "data": { "bonusChoice": { "bonusId": "1", "choicesOrder": "0-0-0-0-0-0-0-0", "bonusGain": "' . implode('-', $chestWinsInit) . '", "bonusGainMoney": "' . implode('-', $chestWinsInit) . '", "choicesWinnings": "0-0-0-0-0-0-0-0", "totalBonusWinnings": "0", "totalBonusWinningsMoney": "0", "choicesMult": "1-1-1-1-1-1-1-1", "totalMultiplier": "1", "choicesFreeGames": "0-0-0-0-0-0-0-0" } } } }';
                    break;
                case '9':
                    $_obf_0D3F1239363430233E3C0F0E15191F5B3B392F323E0122 = explode("\n", $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cmd']);
                    $_obf_0D2636100C05100C375C1D361F2D2E3334383925050D22 = trim($_obf_0D3F1239363430233E3C0F0E15191F5B3B392F323E0122[1]);
                    $chestWinsInit = $slotSettings->GetGameData($slotSettings->slotId . 'chestWinsInit');
                    $chestWinsSelected0 = $slotSettings->GetGameData($slotSettings->slotId . 'chestWinsSelected0');
                    $chestWinsSelected1 = $slotSettings->GetGameData($slotSettings->slotId . 'chestWinsSelected1');
                    $chestWinsStep = $slotSettings->GetGameData($slotSettings->slotId . 'chestWinsStep');
                    $chestWinTotal = $slotSettings->GetGameData($slotSettings->slotId . 'chestWinTotal');
                    $chestWinAllBet = $slotSettings->GetGameData($slotSettings->slotId . 'chestWinAllBet');
                    $betlineRaw = $slotSettings->GetGameData($slotSettings->slotId . 'betlineRaw');
                    $chestWinsStep--;
                    $_obf_0D142C241F1B181D2723252601234035375B141A063811 = array_shift($chestWinsInit);
                    $chestWinsSelected0[$_obf_0D2636100C05100C375C1D361F2D2E3334383925050D22] = $_obf_0D142C241F1B181D2723252601234035375B141A063811;
                    $chestWinsSelected1[$_obf_0D2636100C05100C375C1D361F2D2E3334383925050D22] = 3 - $chestWinsStep;
                    $chestWinTotal += ($_obf_0D142C241F1B181D2723252601234035375B141A063811 * $betlineRaw);
                    $_obf_0D32192C051C0C22052E0332370540271D283325351E32 = '1';
                    $_obf_0D2F3E141A3F01320E263537152C0A27391C0C0B2A1932 = 'pendingWin';
                    if( $chestWinsStep <= 0 ) 
                    {
                        $_obf_0D32192C051C0C22052E0332370540271D283325351E32 = '0';
                        $_obf_0D2F3E141A3F01320E263537152C0A27391C0C0B2A1932 = 'doubleWin';
                        for( $i = 0; $i < 8; $i++ ) 
                        {
                            if( $chestWinsSelected0[$i] == 0 ) 
                            {
                                $chestWinsSelected0[$i] = array_shift($chestWinsInit);
                            }
                        }
                    }
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * 100);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "42128a66-ed28-4459-b1b1-f37588f73064", "data": { "bonusWin": { "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "bonusRequest": "' . $_obf_0D32192C051C0C22052E0332370540271D283325351E32 . '", "bonusId": "1", "bonusesLeft": "' . (3 - $chestWinsStep) . '", "totalFreeGames": "0", "multiplier": "1", "totalMultiplier": "1", "choicesFreeGames": "0-0-0-0-0-0-0-0", "totalBonusWinnings": "' . ($chestWinTotal / $betlineRaw) . '", "totalBonusWinningsMoney": "' . $chestWinTotal . '", "choicesOrder": "' . implode('-', $chestWinsSelected1) . '", "choicesWinnings": "' . implode('-', $chestWinsSelected0) . '", "choicesMult": "1-1-1-1-1-1-1-1", "totalWinnings": "' . ($chestWinTotal / $betlineRaw) . '", "totalWinningsMoney": "' . $chestWinTotal . '" }, "' . $_obf_0D2F3E141A3F01320E263537152C0A27391C0C0B2A1932 . '": { "totalWinnings": "' . ($chestWinTotal / $betlineRaw) . '", "totalWinningsMoney": "' . $chestWinTotal . '", "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '" }, "balance": { "cashBalance": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "freeBalance": "0" } } } }';
                    $slotSettings->SetGameData($slotSettings->slotId . 'chestWinsInit', $chestWinsInit);
                    $slotSettings->SetGameData($slotSettings->slotId . 'chestWinsSelected0', $chestWinsSelected0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'chestWinsSelected1', $chestWinsSelected1);
                    $slotSettings->SetGameData($slotSettings->slotId . 'chestWinsStep', $chestWinsStep);
                    $slotSettings->SetGameData($slotSettings->slotId . 'chestWinTotal', $chestWinTotal);
                    $slotSettings->SetGameData($slotSettings->slotId . 'chestWinAllBet', $chestWinAllBet);
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
                        2, 
                        1, 
                        1, 
                        1, 
                        2
                    ];
                    $linesId[6] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[7] = [
                        1, 
                        1, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[8] = [
                        3, 
                        3, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[9] = [
                        2, 
                        3, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[10] = [
                        2, 
                        1, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[11] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[12] = [
                        3, 
                        2, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[13] = [
                        1, 
                        2, 
                        1, 
                        2, 
                        1
                    ];
                    $linesId[14] = [
                        3, 
                        2, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[15] = [
                        2, 
                        2, 
                        1, 
                        2, 
                        2
                    ];
                    $linesId[16] = [
                        2, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[17] = [
                        1, 
                        1, 
                        3, 
                        1, 
                        1
                    ];
                    $linesId[18] = [
                        3, 
                        3, 
                        1, 
                        3, 
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
                    $betline = trim($_obf_0D3F1239363430233E3C0F0E15191F5B3B392F323E0122[1]) / 100;
                    $betlineRaw = trim($_obf_0D3F1239363430233E3C0F0E15191F5B3B392F323E0122[1]);
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
                        $wild = ['10'];
                        $scatter = '11';
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01 = $reels;
                        $_obf_0D3D2F0A2E111F253F0509321E2303182E221C2A280D01 = [
                            1, 
                            2, 
                            1, 
                            2, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
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
                        shuffle($_obf_0D3D2F0A2E111F253F0509321E2303182E221C2A280D01);
                        $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 = '';
                        $_obf_0D18112F383D2733191F29042B0F213E2208212F0C3F32 = '';
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                            $_obf_0D3D2F0A2E111F253F0509321E2303182E221C2A280D01[0] = $slotSettings->GetGameData($slotSettings->slotId . 'miniBonus');
                        }
                        if( $_obf_0D3D2F0A2E111F253F0509321E2303182E221C2A280D01[0] != 0 && $winType !== 'bonus' ) 
                        {
                            if( $_obf_0D3D2F0A2E111F253F0509321E2303182E221C2A280D01[0] == 1 ) 
                            {
                                $_obf_0D1D30273F3C022B39240416280929310311400B080C22 = rand(2, 5);
                                $_obf_0D3F25211A371A07263B3D2C29320D0E0D221501182932 = 10;
                                $_obf_0D0406381314331D2A1D0A1C2802241637060210063C22 = [
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
                                shuffle($_obf_0D0406381314331D2A1D0A1C2802241637060210063C22);
                                for( $p = 0; $p < $_obf_0D1D30273F3C022B39240416280929310311400B080C22; $p++ ) 
                                {
                                    $_obf_0D092206021E27273F2907182C365B32100A3C2C0B1B32 = $_obf_0D0406381314331D2A1D0A1C2802241637060210063C22[$p];
                                    $reels['reel' . $_obf_0D092206021E27273F2907182C365B32100A3C2C0B1B32[0]][$_obf_0D092206021E27273F2907182C365B32100A3C2C0B1B32[1]] = -1;
                                }
                                $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [
                                    [], 
                                    [], 
                                    []
                                ];
                                for( $p = 0; $p <= 2; $p++ ) 
                                {
                                    for( $r = 1; $r <= 5; $r++ ) 
                                    {
                                        if( $reels['reel' . $r][$p] == -1 ) 
                                        {
                                            $reels['reel' . $r][$p] = $_obf_0D3F25211A371A07263B3D2C29320D0E0D221501182932;
                                            $_obf_0D312B19262C083426241E0D392E22282324060B380811[$p][] = '1';
                                        }
                                        else
                                        {
                                            $_obf_0D312B19262C083426241E0D392E22282324060B380811[$p][] = '0';
                                        }
                                    }
                                }
                                $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 = ', "wilds": { "wild": { "type": "2", "id": "13", "pos": { "line": [ "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0" ] }, "mask": { "line": [ "' . implode('-', $_obf_0D312B19262C083426241E0D392E22282324060B380811[0]) . '", "' . implode('-', $_obf_0D312B19262C083426241E0D392E22282324060B380811[1]) . '", "' . implode('-', $_obf_0D312B19262C083426241E0D392E22282324060B380811[2]) . '" ] } } }';
                            }
                            if( $_obf_0D3D2F0A2E111F253F0509321E2303182E221C2A280D01[0] == 2 ) 
                            {
                                $_obf_0D1D30273F3C022B39240416280929310311400B080C22 = rand(2, 4);
                                $_obf_0D3F25211A371A07263B3D2C29320D0E0D221501182932 = 10;
                                $_obf_0D0406381314331D2A1D0A1C2802241637060210063C22 = [
                                    [
                                        1, 
                                        0
                                    ], 
                                    [
                                        1, 
                                        1
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
                                        3, 
                                        0
                                    ], 
                                    [
                                        3, 
                                        1
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
                                        5, 
                                        0
                                    ], 
                                    [
                                        5, 
                                        1
                                    ]
                                ];
                                shuffle($_obf_0D0406381314331D2A1D0A1C2802241637060210063C22);
                                for( $p = 0; $p < $_obf_0D1D30273F3C022B39240416280929310311400B080C22; $p++ ) 
                                {
                                    $_obf_0D092206021E27273F2907182C365B32100A3C2C0B1B32 = $_obf_0D0406381314331D2A1D0A1C2802241637060210063C22[$p];
                                    $reels['reel' . $_obf_0D092206021E27273F2907182C365B32100A3C2C0B1B32[0]][$_obf_0D092206021E27273F2907182C365B32100A3C2C0B1B32[1]] = 10;
                                    $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01['reel' . $_obf_0D092206021E27273F2907182C365B32100A3C2C0B1B32[0]][$_obf_0D092206021E27273F2907182C365B32100A3C2C0B1B32[1]] = 10;
                                }
                                for( $r = 1; $r <= 5; $r++ ) 
                                {
                                    for( $p = 0; $p <= 2; $p++ ) 
                                    {
                                        if( $reels['reel' . $r][$p] == 10 ) 
                                        {
                                            for( $_obf_0D263439300D233B3B115B0208312E3225223C230F1601 = $p + 1; $_obf_0D263439300D233B3B115B0208312E3225223C230F1601 <= 2; $_obf_0D263439300D233B3B115B0208312E3225223C230F1601++ ) 
                                            {
                                                $reels['reel' . $r][$_obf_0D263439300D233B3B115B0208312E3225223C230F1601] = -1;
                                            }
                                        }
                                    }
                                }
                                $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [
                                    [], 
                                    [], 
                                    []
                                ];
                                $_obf_0D2D0B0612231C4023371E11031711091E3D0F380F2711 = [
                                    [], 
                                    [], 
                                    []
                                ];
                                for( $p = 0; $p <= 2; $p++ ) 
                                {
                                    for( $r = 1; $r <= 5; $r++ ) 
                                    {
                                        if( $reels['reel' . $r][$p] == 10 ) 
                                        {
                                            $_obf_0D2D0B0612231C4023371E11031711091E3D0F380F2711[$p][] = '1';
                                        }
                                        else
                                        {
                                            $_obf_0D2D0B0612231C4023371E11031711091E3D0F380F2711[$p][] = '0';
                                        }
                                        if( $reels['reel' . $r][$p] == -1 || $reels['reel' . $r][$p] == 10 ) 
                                        {
                                            $reels['reel' . $r][$p] = $_obf_0D3F25211A371A07263B3D2C29320D0E0D221501182932;
                                            $_obf_0D312B19262C083426241E0D392E22282324060B380811[$p][] = '1';
                                        }
                                        else
                                        {
                                            $_obf_0D312B19262C083426241E0D392E22282324060B380811[$p][] = '0';
                                        }
                                    }
                                }
                                $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 = ', "wilds": { "wild": { "type": "1", "id": "14", "pos": { "line": [  "' . implode('-', $_obf_0D2D0B0612231C4023371E11031711091E3D0F380F2711[0]) . '", "' . implode('-', $_obf_0D2D0B0612231C4023371E11031711091E3D0F380F2711[1]) . '", "' . implode('-', $_obf_0D2D0B0612231C4023371E11031711091E3D0F380F2711[2]) . '"  ] }, "mask": { "line": [ "' . implode('-', $_obf_0D312B19262C083426241E0D392E22282324060B380811[0]) . '", "' . implode('-', $_obf_0D312B19262C083426241E0D392E22282324060B380811[1]) . '", "' . implode('-', $_obf_0D312B19262C083426241E0D392E22282324060B380811[2]) . '" ] } }}';
                            }
                        }
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
                                    $sp = [];
                                    $s[0] = $reels['reel1'][$linesId[$k][0] - 1];
                                    $s[1] = $reels['reel2'][$linesId[$k][1] - 1];
                                    $s[2] = $reels['reel3'][$linesId[$k][2] - 1];
                                    $s[3] = $reels['reel4'][$linesId[$k][3] - 1];
                                    $s[4] = $reels['reel5'][$linesId[$k][4] - 1];
                                    $sp[0] = $linesId[$k][0];
                                    $sp[1] = $linesId[$k][1];
                                    $sp[2] = $linesId[$k][2];
                                    $sp[3] = $linesId[$k][3];
                                    $sp[4] = $linesId[$k][4];
                                    if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) ) 
                                    {
                                        $mpl = 1;
                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) ) 
                                        {
                                            $mpl = 1;
                                        }
                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) ) 
                                        {
                                            $mpl = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][2] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "pos": "' . $k . '", "initialValue": { }, "initialValueMoney": { }, "value": "' . round(($cWins[$k] * 100) / $betlineRaw) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "hl": "' . $sp[0] . '' . $sp[1] . '000", "symbolId": "22", "multiplier": "' . $mpl . '" }';
                                        }
                                    }
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "pos": "' . $k . '", "initialValue": { }, "initialValueMoney": { }, "value": "' . round(($cWins[$k] * 100) / $betlineRaw) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "hl": "' . $sp[0] . '' . $sp[1] . '' . $sp[2] . '00", "symbolId": "22", "multiplier": "' . $mpl . '" }';
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "pos": "' . $k . '", "initialValue": { }, "initialValueMoney": { }, "value": "' . round(($cWins[$k] * 100) / $betlineRaw) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "hl": "' . $sp[0] . '' . $sp[1] . '' . $sp[2] . '' . $sp[3] . '0", "symbolId": "22", "multiplier": "' . $mpl . '" }';
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "pos": "' . $k . '", "initialValue": { }, "initialValueMoney": { }, "value": "' . round(($cWins[$k] * 100) / $betlineRaw) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "hl": "' . $sp[0] . '' . $sp[1] . '' . $sp[2] . '' . $sp[3] . '' . $sp[4] . '", "symbolId": "22", "multiplier": "' . $mpl . '" }';
                                        }
                                    }
                                }
                            }
                            if( $cWins[$k] > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                            {
                                array_push($lineWins, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                                $totalWin += $cWins[$k];
                            }
                        }
                        $scattersWin = 0;
                        $scattersStr = '';
                        $scattersCount = 0;
                        $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 = 0;
                        $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [];
                        $_obf_0D2D0B0612231C4023371E11031711091E3D0F380F2711 = [];
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
                                if( $reels['reel' . $r][$p] == 12 ) 
                                {
                                    $_obf_0D28301D333F2827165C2511011438180336175B1E2A01++;
                                    $_obf_0D2D0B0612231C4023371E11031711091E3D0F380F2711[] = '1';
                                }
                                else
                                {
                                    $_obf_0D2D0B0612231C4023371E11031711091E3D0F380F2711[] = '0';
                                }
                            }
                        }
                        $scattersWin = $slotSettings->Paytable['SYM_' . $scatter][$scattersCount] * $allbet;
                        $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 = 0;
                        if( $scattersCount >= 3 ) 
                        {
                            $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 = $slotSettings->slotFreeCount;
                            $scattersStr = ', "scatters": { "value": "0", "valueMoney": "0", "multiplier": "1", "hl": "' . implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811) . '" }, "freeGamesWin": { "total": "' . $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 . '", "multiplier": "1", "hl": "' . implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811) . '" }';
                        }
                        $chestWinTotal = 0;
                        if( $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 1 ) 
                        {
                            $_obf_0D270A141A1C2E230D240E323F3806083D2C2A191D1732 = [
                                2, 
                                2, 
                                2, 
                                2, 
                                2, 
                                2, 
                                2, 
                                2, 
                                2, 
                                5, 
                                5, 
                                5, 
                                5, 
                                5, 
                                5, 
                                5, 
                                5, 
                                5, 
                                5, 
                                10, 
                                10, 
                                10, 
                                10, 
                                10, 
                                10, 
                                15, 
                                15, 
                                15, 
                                15, 
                                30, 
                                30, 
                                30, 
                                30, 
                                30, 
                                30, 
                                50, 
                                50, 
                                50
                            ];
                            shuffle($_obf_0D270A141A1C2E230D240E323F3806083D2C2A191D1732);
                            $chestWinsInit = [];
                            $chestWinTotal = 0;
                            for( $_obf_0D1B032A5C0E10311F152A281509323F22400B24252111 = 0; $_obf_0D1B032A5C0E10311F152A281509323F22400B24252111 < 6; $_obf_0D1B032A5C0E10311F152A281509323F22400B24252111++ ) 
                            {
                                $chestWinsInit[] = ($_obf_0D270A141A1C2E230D240E323F3806083D2C2A191D1732[$_obf_0D1B032A5C0E10311F152A281509323F22400B24252111] * $allbet * 100) / $betlineRaw;
                                if( $_obf_0D1B032A5C0E10311F152A281509323F22400B24252111 < 3 ) 
                                {
                                    $chestWinTotal += ($_obf_0D270A141A1C2E230D240E323F3806083D2C2A191D1732[$_obf_0D1B032A5C0E10311F152A281509323F22400B24252111] * $allbet);
                                }
                            }
                            $chestWinsInit[] = 0;
                            $chestWinsInit[] = 0;
                            $slotSettings->SetGameData($slotSettings->slotId . 'chestWinsInit', $chestWinsInit);
                            $slotSettings->SetGameData($slotSettings->slotId . 'chestWinsSelected0', [
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0
                            ]);
                            $slotSettings->SetGameData($slotSettings->slotId . 'chestWinsSelected1', [
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0
                            ]);
                            $slotSettings->SetGameData($slotSettings->slotId . 'chestWinTotal', $totalWin * 100);
                            $slotSettings->SetGameData($slotSettings->slotId . 'chestWinAllBet', $allbet);
                            $slotSettings->SetGameData($slotSettings->slotId . 'betlineRaw', $betlineRaw);
                            $scattersStr = ', "bonusRequest": "1", "bonuses": { "bonus": { "id": "1", "hl": "' . implode('', $_obf_0D2D0B0612231C4023371E11031711091E3D0F380F2711) . '" } }';
                            $totalWin += $chestWinTotal;
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
                            if( ($scattersCount >= 3 || $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 1) && $winType != 'bonus' ) 
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
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount);
                        }
                        $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                    }
                    $reels = $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01;
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    if( $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 1 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'chestWinsStep', 3);
                        $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, 'BG');
                    }
                    else
                    {
                        $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    }
                    $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                    $curReels = '';
                    $curReels .= ('"' . $reels['reel1'][0] . '-' . $reels['reel2'][0] . '-' . $reels['reel3'][0] . '-' . $reels['reel4'][0] . '-' . $reels['reel5'][0] . '"');
                    $curReels .= (',"' . $reels['reel1'][1] . '-' . $reels['reel2'][1] . '-' . $reels['reel3'][1] . '-' . $reels['reel4'][1] . '-' . $reels['reel5'][1] . '"');
                    $curReels .= (',"' . $reels['reel1'][2] . '-' . $reels['reel2'][2] . '-' . $reels['reel3'][2] . '-' . $reels['reel4'][2] . '-' . $reels['reel5'][2] . '"');
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
                    $totalWin -= $chestWinTotal;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "d01cf0d7-074f-4524-86be-3361658789f3", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "25520003501587914269973255464480393810966409" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "readValue": "0" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "25", "symbols": { "line": [  ' . $curReels . '  ] }, "lines": { "line": [ ' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . ' ] }, "freeGames": { "left": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . '", "total": "' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '", "totalFreeGamesWinnings": "' . (($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) / $betlineRaw) . '", "totalFreeGamesWinningsMoney": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . '", "multiplier": "1", "totalMultiplier": "1" }, "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "totalMultiplier": "1", "bonusRequest": "0"}, "doubleWin": { "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "c85dcfe8-c826-40a3-862e-d1297d53859a", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "255703301588696204682728443064353372761745" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "readValue": "1" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "' . ($allbet * 100) . '", "symbols": { "line": [ ' . $curReels . ' ] }, "lines": {  "line": [' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . ']}, "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "totalMultiplier": "1", "bonusRequest": "0"' . $scattersStr . ' ' . $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 . ' }, "doubleWin": { "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
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
