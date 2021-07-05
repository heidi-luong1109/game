<?php 
namespace VanguardLTE\Games\AztecGoldMegawaysISB
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
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "5640f7f3-4693-4059-841a-dc3afd3f1925", "data": { "version": { "versionServer": "2.2.0.1-1", "versionGMAPI": "8.1.16 GS:2.5.1 FR:v4" }, "balance": { "cashBalance": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "freeBalance": "0", "ccyCode": "EUR", "ccyDecimal": { }, "ccyThousand": { }, "ccyPrefix": { }, "ccySuffix": { }, "ccyDecimalDigits": { } }, "id": { "roundId": "25520020301588680413177316196800814753252699" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "readValue": "1" }, "initial": { "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "coins": "20", "coinValue": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "lines": "20", "currentState": "beginGame", "lastGame": { "endGame": { ' . $_obf_0D2B212D321E2F13251A11275B252D3E120622091F1722 . '"money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "bet": "' . ($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] * 20) . '", "symbols": { "line": [ "-1--1--1--1--1", "-1--1--1--1--1", "-1--1--1--1--1" ] }, "lines": { }, "totalWinnings": "0", "totalWinningsMoney": "0", "doubleWin": { "totalWinnings": "0", "totalWinningsMoney": "0", "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '" }, "totalMultiplier": { }, "bonusRequest": { } } } } } } }';
                    break;
                case '192837':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "419427a2-d300-41d9-8d67-fe4eec61be5f", "data": "1" } }';
                    break;
                case '5347':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "26d1001c-15ff-4d21-af9e-45dde0260165", "data": { "success": "" } } }';
                    break;
                case '105':
                    $_obf_0D24060311113F262A5B33075C340B2D105C12112B3D01 = json_decode($slotSettings->GetGameData($slotSettings->slotId . 'LastResponse'), true);
                    $_obf_0D24060311113F262A5B33075C340B2D105C12112B3D01['rootdata']['data']['endGame']['gameSpecific']['dummyModifierActive'] = '0';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = json_encode($_obf_0D24060311113F262A5B33075C340B2D105C12112B3D01);
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
                        2, 
                        2, 
                        2, 
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
                        $wild = '11';
                        $scatter = '12';
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $ways = $reels['ways'];
                        $_obf_0D352E0A230A18250933393D19150E1B3528100D381911 = 0;
                        $_obf_0D390225301D2E21373038281039131A192C011A3F0632 = [];
                        for( $rs = 0; $rs <= 50; $rs++ ) 
                        {
                            if( $rs == 0 ) 
                            {
                                $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722 = $reels;
                                $_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632 = $slotSettings->GetReelsWin($reels, 20, $betline, $betlineRaw, $linesId, $cWins, $rs);
                            }
                            else
                            {
                                $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722 = $slotSettings->OffsetReels($_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632['reelsOffset']);
                                $_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632 = $slotSettings->GetReelsWin($_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722, 20, $betline, $betlineRaw, $linesId, $cWins, $rs);
                            }
                            if( $_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632['totalWin'] <= 0 ) 
                            {
                                $reels = $slotSettings->OffsetReels($_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632['reelsOffset']);
                                break;
                            }
                            $curReels = '';
                            $curReels .= ('"' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel1'][0] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel2'][0] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel3'][0] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel4'][0] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel5'][0] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel6'][0] . '"');
                            $curReels .= (',"' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel1'][1] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel2'][1] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel3'][1] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel4'][1] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel5'][1] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel6'][1] . '"');
                            $curReels .= (',"' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel1'][2] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel2'][2] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel3'][2] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel4'][2] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel5'][2] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel6'][2] . '"');
                            $curReels .= (',"' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel1'][3] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel2'][3] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel3'][3] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel4'][3] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel5'][3] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel6'][3] . '"');
                            $curReels .= (',"' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel1'][4] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel2'][4] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel3'][4] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel4'][4] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel5'][4] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel6'][4] . '"');
                            $curReels .= (',"' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel1'][5] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel2'][5] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel3'][5] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel4'][5] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel5'][5] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel6'][5] . '"');
                            $curReels .= (',"' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel1'][6] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel2'][6] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel3'][6] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel4'][6] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel5'][6] . '-' . $_obf_0D1D0613132C1D050C2528310F3E2C1130222E34223722['reel6'][6] . '"');
                            $_obf_0D390225301D2E21373038281039131A192C011A3F0632[] = '{ "symbols": { "line": [ ' . $curReels . ' ] }, "lines": { "line":[ ' . implode(',', $_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632['lineWins']) . ' ]}, "combo": "' . $rs . '", "winnings": "' . (($_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632['totalWin'] * 100) / $betlineRaw) . '", "winningsMoney": "' . ($_obf_0D1C5B082B103D141A150A1B1F1D330A1F0C1427303632['totalWin'] * 100) . '", "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '" }';
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
                        $allScattersWin = 0;
                        $_obf_0D33330C031E09160125221C1D17223708322132212511 = [
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            2, 
                            2, 
                            2, 
                            2, 
                            2, 
                            2, 
                            2, 
                            2, 
                            3, 
                            3, 
                            3, 
                            3, 
                            3, 
                            4, 
                            4, 
                            4, 
                            4, 
                            4, 
                            5, 
                            5, 
                            5, 
                            5, 
                            5, 
                            8, 
                            8, 
                            8, 
                            8, 
                            10, 
                            10, 
                            10, 
                            15, 
                            15, 
                            15, 
                            20, 
                            20, 
                            20, 
                            25, 
                            25, 
                            25, 
                            30, 
                            100, 
                            1000
                        ];
                        $allScattersWinArr = [];
                        $_obf_0D2A3C293E3416231B25063319075B231E232517281E01 = [];
                        $_obf_0D3D2D40102E2B342B222534291A5B1E2E3E3C1B1D0311 = [];
                        $bonusGameValuesCoins = [];
                        $bonusGameValuesMoney = [];
                        $bonusGameInitialSymbols = [];
                        $bonusGameInitialScatterValues = [];
                        $_obf_0D26133F1732163D280101220B21062A03101329265C01 = 0;
                        $_obf_0D311D022F020A03181C14361B343231085B0C220D0E01 = 0;
                        $_obf_0D36161A1C320C0F0C21053E015B3F2E312C172A271C01 = 0;
                        shuffle($_obf_0D33330C031E09160125221C1D17223708322132212511);
                        for( $p = 0; $p <= 6; $p++ ) 
                        {
                            for( $r = 1; $r <= 6; $r++ ) 
                            {
                                if( $reels['reel' . $r][$p] == $scatter ) 
                                {
                                    $scattersCount++;
                                    $_obf_0D312B19262C083426241E0D392E22282324060B380811[] = '1';
                                    $_obf_0D2B3E020C0E050C2102340907033D29035B0236071E22 = array_shift($_obf_0D33330C031E09160125221C1D17223708322132212511);
                                    $allScattersWinArr[] = $_obf_0D2B3E020C0E050C2102340907033D29035B0236071E22;
                                    $bonusGameValuesCoins[] = $_obf_0D2B3E020C0E050C2102340907033D29035B0236071E22 * $allbet * 100;
                                    $bonusGameValuesMoney[] = ($_obf_0D2B3E020C0E050C2102340907033D29035B0236071E22 * $allbet * 100) / $betlineRaw;
                                    $allScattersWin += ($_obf_0D2B3E020C0E050C2102340907033D29035B0236071E22 * $allbet);
                                }
                                else
                                {
                                    $bonusGameValuesCoins[] = 0;
                                    $bonusGameValuesMoney[] = 0;
                                    $allScattersWinArr[] = 0;
                                    $_obf_0D312B19262C083426241E0D392E22282324060B380811[] = '0';
                                }
                                if( $reels['reel' . $r][$p] > 0 ) 
                                {
                                    $bonusGameInitialSymbols[] = $reels['reel' . $r][$p];
                                }
                                else
                                {
                                    $bonusGameInitialSymbols[] = 0;
                                }
                            }
                        }
                        $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 = 0;
                        if( $scattersCount >= 5 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'bonusGameInitialSymbols', $bonusGameInitialSymbols);
                            $slotSettings->SetGameData($slotSettings->slotId . 'allScattersWinArr', $allScattersWinArr);
                            $slotSettings->SetGameData($slotSettings->slotId . 'bonusGameInitialScatterValues', $allScattersWinArr);
                            $slotSettings->SetGameData($slotSettings->slotId . 'allScattersWin', $allScattersWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'AllBet', $allbet);
                            $slotSettings->SetGameData($slotSettings->slotId . 'betlineRaw', $betlineRaw);
                            $slotSettings->SetGameData($slotSettings->slotId . 'bonusGameSpinsLeft', 3);
                            $slotSettings->SetGameData($slotSettings->slotId . 'bonusGameSpinsUsed', 0);
                            $slotSettings->SetGameData($slotSettings->slotId . 'reels', $reels);
                            $slotSettings->SetGameData($slotSettings->slotId . 'ways', $ways);
                            $slotSettings->SetGameData($slotSettings->slotId . 'bonusGameValuesCoins', $bonusGameValuesCoins);
                            $slotSettings->SetGameData($slotSettings->slotId . 'bonusGameValuesMoney', $bonusGameValuesMoney);
                            $scattersStr = ', "gameSpecific": { "scatterValues": "' . implode('-', $allScattersWinArr) . '", "bonusGameInProgress": "1", "bonusGameSpinsLeft": "3", "bonusGameSpinsUsed": "0", "bonusOnlyGain": "' . (($allScattersWin * 100) / $betlineRaw) . '", "bonusGameGain": "' . (($allScattersWin * 100) / $betlineRaw) . '", "bonusGameGainMoney": "' . ($allScattersWin * 100) . '", "bonusGameNewScatters": "' . implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811) . '", "bonusGameMultipliers": "1-1-1-1-1-1", "bonusGameValuesCoins": "' . implode('-', $bonusGameValuesCoins) . '", "bonusGameValuesMoney": "' . implode('-', $bonusGameValuesMoney) . '", "bonusGameInitialSymbols": "' . implode('-', $bonusGameInitialSymbols) . '", "bonusGameInitialScatterValues": "' . implode('-', $allScattersWinArr) . '", "isBonusAddModifier": "1", "megaways": "' . $ways . '" }';
                        }
                        else
                        {
                            $allScattersWin = 0;
                        }
                        if( $scattersCount >= 5 && $winType == 'bonus' && $totalWin > 0 ) 
                        {
                        }
                        else
                        {
                            $totalWin += ($scattersWin + $allScattersWin);
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
                                if( $scattersCount >= 5 && $winType != 'bonus' ) 
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
                    if( $scattersCount >= 5 ) 
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
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                    $curReels = '';
                    $curReels .= ('"' . $reels['reel1'][0] . '-' . $reels['reel2'][0] . '-' . $reels['reel3'][0] . '-' . $reels['reel4'][0] . '-' . $reels['reel5'][0] . '-' . $reels['reel6'][0] . '"');
                    $curReels .= (',"' . $reels['reel1'][1] . '-' . $reels['reel2'][1] . '-' . $reels['reel3'][1] . '-' . $reels['reel4'][1] . '-' . $reels['reel5'][1] . '-' . $reels['reel6'][1] . '"');
                    $curReels .= (',"' . $reels['reel1'][2] . '-' . $reels['reel2'][2] . '-' . $reels['reel3'][2] . '-' . $reels['reel4'][2] . '-' . $reels['reel5'][2] . '-' . $reels['reel6'][2] . '"');
                    $curReels .= (',"' . $reels['reel1'][3] . '-' . $reels['reel2'][3] . '-' . $reels['reel3'][3] . '-' . $reels['reel4'][3] . '-' . $reels['reel5'][3] . '-' . $reels['reel6'][3] . '"');
                    $curReels .= (',"' . $reels['reel1'][4] . '-' . $reels['reel2'][4] . '-' . $reels['reel3'][4] . '-' . $reels['reel4'][4] . '-' . $reels['reel5'][4] . '-' . $reels['reel6'][4] . '"');
                    $curReels .= (',"' . $reels['reel1'][5] . '-' . $reels['reel2'][5] . '-' . $reels['reel3'][5] . '-' . $reels['reel4'][5] . '-' . $reels['reel5'][5] . '-' . $reels['reel6'][5] . '"');
                    $curReels .= (',"' . $reels['reel1'][6] . '-' . $reels['reel2'][6] . '-' . $reels['reel3'][6] . '-' . $reels['reel4'][6] . '-' . $reels['reel5'][6] . '-' . $reels['reel6'][6] . '"');
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
                    $_obf_0D1F37013027092805312223153703290C250F17350C22 = round(($slotSettings->GetBalance() - $allScattersWin) * 100);
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = [];
                    for( $i = 0; $i < count($slotSettings->Bet); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[] = $slotSettings->Bet[$i] * 100;
                    }
                    $totalWin -= $allScattersWin;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "d01cf0d7-074f-4524-86be-3361658789f3", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "25520003501587914269973255464480393810966409" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "readValue": "0" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "25", "symbols": { "line": [  ' . $curReels . '  ] }, "lines": { "line": [ ' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . ' ] }, "freeGames": { "left": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . '", "total": "' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '", "totalFreeGamesWinnings": "' . (($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) / $betlineRaw) . '", "totalFreeGamesWinningsMoney": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . '", "multiplier": "1", "totalMultiplier": "1" }, "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "totalMultiplier": "1", "bonusRequest": { }, "insync": { "sync": { "from": "0-0-0-0-0", "to": "' . implode('-', $_obf_0D311A0922102A2C171F281032173D250D01093F223422) . '", "mask": "' . implode('-', $_obf_0D311A0922102A2C171F281032173D250D01093F223422) . '" } } }, "doubleWin": { "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "e505a70b-d71b-4cb6-a47f-79d607387412", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "255899901589710939772397155069424252367048" }, "coinValues": { "coinValueList": "1,2,5,10,20,30,50,100", "coinValueDefault": "1", "readValue": "0" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "20", "symbols": { "line": [ ' . $curReels . ' ] }, "lines": { }, "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "totalMultiplier": { }, "bonusRequest": { }, "gameSpecific": { "scatterValues": "' . implode('-', $allScattersWinArr) . '", "megaways": "' . $ways . '" }' . $scattersStr . ' }' . $_obf_0D0F401522220F2D0C35030823362B153E112A40285C22 . ' , "doubleWin": { "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
                    }
                    break;
                case '104':
                    $bank = $slotSettings->GetBank('bonus');
                    for( $l = 0; $l < 2000; $l++ ) 
                    {
                        $bonusGameInitialSymbols = $slotSettings->GetGameData($slotSettings->slotId . 'bonusGameInitialSymbols');
                        $allScattersWinArr = $slotSettings->GetGameData($slotSettings->slotId . 'allScattersWinArr');
                        $allbet = $slotSettings->GetGameData($slotSettings->slotId . 'AllBet');
                        $bonusGameSpinsLeft = $slotSettings->GetGameData($slotSettings->slotId . 'bonusGameSpinsLeft');
                        $bonusGameSpinsUsed = $slotSettings->GetGameData($slotSettings->slotId . 'bonusGameSpinsUsed');
                        $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911 = $slotSettings->GetGameData($slotSettings->slotId . 'allScattersWin');
                        $reels = $slotSettings->GetGameData($slotSettings->slotId . 'reels');
                        $ways = $slotSettings->GetGameData($slotSettings->slotId . 'ways');
                        $betlineRaw = $slotSettings->GetGameData($slotSettings->slotId . 'betlineRaw');
                        $bonusGameInitialScatterValues = $slotSettings->GetGameData($slotSettings->slotId . 'bonusGameInitialScatterValues');
                        $bonusGameValuesCoins = $slotSettings->GetGameData($slotSettings->slotId . 'bonusGameValuesCoins');
                        $bonusGameValuesMoney = $slotSettings->GetGameData($slotSettings->slotId . 'bonusGameValuesMoney');
                        $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801 = [];
                        $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[0] = [
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13
                        ];
                        $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[1] = [
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13
                        ];
                        $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[2] = [
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13
                        ];
                        $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[3] = [
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13
                        ];
                        $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[4] = [
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13
                        ];
                        $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[5] = [
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            12, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13, 
                            13
                        ];
                        $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22 = $reels;
                        for( $r = 1; $r <= 6; $r++ ) 
                        {
                            shuffle($_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[$r - 1]);
                            for( $p = 0; $p <= 6; $p++ ) 
                            {
                                if( $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel' . $r][$p] > 0 && $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel' . $r][$p] != 12 ) 
                                {
                                    $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel' . $r][$p] = $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801[$r - 1][$p];
                                }
                            }
                        }
                        $_obf_0D33330C031E09160125221C1D17223708322132212511 = [
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            2, 
                            2, 
                            2, 
                            2, 
                            2, 
                            2, 
                            2, 
                            2, 
                            3, 
                            3, 
                            3, 
                            3, 
                            3, 
                            4, 
                            4, 
                            4, 
                            4, 
                            4, 
                            5, 
                            5, 
                            5, 
                            5, 
                            5, 
                            8, 
                            8, 
                            8, 
                            8, 
                            10, 
                            10, 
                            10, 
                            15, 
                            15, 
                            15, 
                            20, 
                            20, 
                            20, 
                            25, 
                            25, 
                            25, 
                            30, 
                            100, 
                            1000
                        ];
                        $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [];
                        $_obf_0D3D2D40102E2B342B222534291A5B1E2E3E3C1B1D0311 = [];
                        $_obf_0D333B0B3923130E090138251D3C2B3636360517042501 = 0;
                        $allScattersWin = 0;
                        shuffle($_obf_0D33330C031E09160125221C1D17223708322132212511);
                        for( $p = 0; $p <= 6; $p++ ) 
                        {
                            for( $r = 1; $r <= 6; $r++ ) 
                            {
                                if( $reels['reel' . $r][$p] != 12 && $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel' . $r][$p] == 12 ) 
                                {
                                    $_obf_0D2B3E020C0E050C2102340907033D29035B0236071E22 = array_shift($_obf_0D33330C031E09160125221C1D17223708322132212511);
                                    $allScattersWinArr[$_obf_0D333B0B3923130E090138251D3C2B3636360517042501] = $_obf_0D2B3E020C0E050C2102340907033D29035B0236071E22;
                                    $bonusGameValuesCoins[$_obf_0D333B0B3923130E090138251D3C2B3636360517042501] = ($_obf_0D2B3E020C0E050C2102340907033D29035B0236071E22 * $allbet * 100) / $betlineRaw;
                                    $bonusGameValuesMoney[$_obf_0D333B0B3923130E090138251D3C2B3636360517042501] = $_obf_0D2B3E020C0E050C2102340907033D29035B0236071E22 * $allbet * 100;
                                    $allScattersWin += ($_obf_0D2B3E020C0E050C2102340907033D29035B0236071E22 * $allbet);
                                    $_obf_0D3D2D40102E2B342B222534291A5B1E2E3E3C1B1D0311[] = 1;
                                }
                                else
                                {
                                    $_obf_0D3D2D40102E2B342B222534291A5B1E2E3E3C1B1D0311[] = 0;
                                }
                                if( $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel' . $r][$p] == 12 ) 
                                {
                                    $_obf_0D312B19262C083426241E0D392E22282324060B380811[$_obf_0D333B0B3923130E090138251D3C2B3636360517042501] = '1';
                                }
                                else
                                {
                                    $_obf_0D312B19262C083426241E0D392E22282324060B380811[$_obf_0D333B0B3923130E090138251D3C2B3636360517042501] = '0';
                                }
                                $_obf_0D333B0B3923130E090138251D3C2B3636360517042501++;
                            }
                        }
                        if( $l > 1500 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"respin","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( $allScattersWin <= $bank ) 
                        {
                            break;
                        }
                    }
                    if( $allScattersWin > 0 ) 
                    {
                        $slotSettings->SetBank('bonus', -1 * $allScattersWin);
                        $slotSettings->SetBalance($allScattersWin);
                    }
                    $bonusGameSpinsLeft--;
                    $bonusGameSpinsUsed++;
                    $curReels = '';
                    $curReels .= ('"' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel1'][0] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel2'][0] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel3'][0] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel4'][0] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel5'][0] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel6'][0] . '"');
                    $curReels .= (',"' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel1'][1] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel2'][1] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel3'][1] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel4'][1] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel5'][1] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel6'][1] . '"');
                    $curReels .= (',"' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel1'][2] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel2'][2] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel3'][2] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel4'][2] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel5'][2] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel6'][2] . '"');
                    $curReels .= (',"' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel1'][3] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel2'][3] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel3'][3] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel4'][3] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel5'][3] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel6'][3] . '"');
                    $curReels .= (',"' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel1'][4] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel2'][4] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel3'][4] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel4'][4] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel5'][4] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel6'][4] . '"');
                    $curReels .= (',"' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel1'][5] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel2'][5] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel3'][5] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel4'][5] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel5'][5] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel6'][5] . '"');
                    $curReels .= (',"' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel1'][6] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel2'][6] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel3'][6] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel4'][6] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel5'][6] . '-' . $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22['reel6'][6] . '"');
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = [];
                    for( $i = 0; $i < count($slotSettings->Bet); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[] = $slotSettings->Bet[$i] * 100;
                    }
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * 100);
                    $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 = round(($slotSettings->GetBalance() - ($allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911)) * 100);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "5f45095e-1ab3-4dcb-a66c-8771be2326d5", "data": { "balance": { "cashBalance": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "freeBalance": "0" }, "id": { "roundId": "255899901589747526494184306528790444093525" }, "coinValues": { "coinValueList": "1,2,5,10,20,30,50,100", "coinValueDefault": "1", "readValue": "0" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "' . ($betlineRaw * 20) . '", "symbols": { "line": [ ' . $curReels . ' ] }, "lines": { }, "totalWinnings": "0", "totalWinningsMoney": "0", "totalMultiplier": { }, "bonusRequest": { }, "gameSpecific": { "scatterValues": "' . implode('-', $allScattersWinArr) . '", "bonusGameInProgress": "1", "bonusGameSpinsLeft": "' . $bonusGameSpinsLeft . '", "bonusGameSpinsUsed": "' . $bonusGameSpinsUsed . '", "bonusOnlyGain": "' . ((($allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911) * 100) / $betlineRaw) . '", "bonusGameGain": "' . ((($allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911) * 100) / $betlineRaw) . '", "bonusGameGainMoney": "' . (($allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911) * 100) . '", "bonusGameNewScatters": "' . implode('-', $_obf_0D3D2D40102E2B342B222534291A5B1E2E3E3C1B1D0311) . '", "bonusGameMultipliers": "1-1-1-1-1-1", "bonusGameValuesCoins": "' . implode('-', $bonusGameValuesCoins) . '", "bonusGameValuesMoney": "' . implode('-', $bonusGameValuesMoney) . '", "bonusGameInitialSymbols": "' . implode('-', $bonusGameInitialSymbols) . '", "bonusGameInitialScatterValues": "' . implode('-', $bonusGameInitialScatterValues) . '", "megaways": "' . $ways . '" } }, "pendingWin": { "totalWinnings": "0", "totalWinningsMoney": "0", "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '" } } } }';
                    $response = '{"responseEvent":"spin","responseType":"respin","serverResponse":{"slotLines":20,"slotBet":' . ($allbet / 20) . ',"totalFreeGames":' . $bonusGameSpinsLeft . ',"currentFreeGames":' . ($allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911) . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . ($allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911) . ',"totalWin":' . $allScattersWin . ',"winLines":[],"Jackpots":[],"reelsSymbols":[],"lastResponse":' . $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, 20, $allScattersWin, 'FG2');
                    if( $bonusGameSpinsLeft <= 0 ) 
                    {
                        $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * 100);
                        $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 = round(($slotSettings->GetBalance() - ($allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911)) * 100);
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = [];
                        for( $i = 0; $i < count($slotSettings->Bet); $i++ ) 
                        {
                            $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[] = $slotSettings->Bet[$i] * 100;
                        }
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "5f45095e-1ab3-4dcb-a66c-8771be2326d5", "data": { "balance": { "cashBalance": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "freeBalance": "0" }, "id": { "roundId": "255899901589747526494184306528790444093525" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "1", "readValue": "1" }, "endGame": { "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "bet": "' . ($betlineRaw * 20) . '", "symbols": { "line": [ ' . $curReels . ' ] }, "lines": { }, "totalWinnings": "' . ((($allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911) * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . (($allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911) * 100) . '", "totalMultiplier": { }, "bonusRequest": { }, "gameSpecific": { "scatterValues": "' . implode('-', $allScattersWinArr) . '", "bonusGameInProgress": "0", "bonusGameSpinsLeft": "' . $bonusGameSpinsLeft . '", "bonusGameSpinsUsed": "' . $bonusGameSpinsUsed . '", "bonusOnlyGain": "' . ((($allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911) * 100) / $betlineRaw) . '", "bonusGameGain": "' . ((($allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911) * 100) / $betlineRaw) . '", "bonusGameGainMoney": "' . (($allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911) * 100) . '", "bonusGameNewScatters": "' . implode('-', $_obf_0D3D2D40102E2B342B222534291A5B1E2E3E3C1B1D0311) . '", "bonusGameMultipliers": "1-1-1-1-1-1", "bonusGameValuesCoins": "' . implode('-', $bonusGameValuesCoins) . '", "bonusGameValuesMoney": "' . implode('-', $bonusGameValuesMoney) . '", "bonusGameInitialSymbols": "' . implode('-', $bonusGameInitialSymbols) . '", "bonusGameInitialScatterValues": "' . implode('-', $bonusGameInitialScatterValues) . '", "megaways": "' . $ways . '" } }, "doubleWin": { "totalWinnings": "' . ((($allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911) * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . (($allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911) * 100) . '", "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '" } } } }';
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'bonusGameInitialSymbols', $bonusGameInitialSymbols);
                    $slotSettings->SetGameData($slotSettings->slotId . 'allScattersWinArr', $allScattersWinArr);
                    $slotSettings->SetGameData($slotSettings->slotId . 'AllBet', $allbet);
                    $slotSettings->SetGameData($slotSettings->slotId . 'bonusGameSpinsLeft', $bonusGameSpinsLeft);
                    $slotSettings->SetGameData($slotSettings->slotId . 'bonusGameSpinsUsed', $bonusGameSpinsUsed);
                    $slotSettings->SetGameData($slotSettings->slotId . 'allScattersWin', $allScattersWin + $_obf_0D231D3F2A0C22272C0406123C250817373523141E0911);
                    $slotSettings->SetGameData($slotSettings->slotId . 'reels', $_obf_0D1A341D3F24273E2B35250C271217290D3D3B2D183B22);
                    $slotSettings->SetGameData($slotSettings->slotId . 'bonusGameValuesCoins', $bonusGameValuesCoins);
                    $slotSettings->SetGameData($slotSettings->slotId . 'bonusGameValuesMoney', $bonusGameValuesMoney);
                    break;
            }
            $response = $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0];
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
