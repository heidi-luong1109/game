<?php 
namespace VanguardLTE\Games\RacetrackRichesISB
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
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentLap', $lastEvent->serverResponse->currentLap);
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentPosition', $lastEvent->serverResponse->currentPosition);
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentPositionEnemy', $lastEvent->serverResponse->currentPositionEnemy);
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentPositionRaw', $lastEvent->serverResponse->currentPositionRaw);
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentPositionEnemyRaw', $lastEvent->serverResponse->currentPositionEnemyRaw);
                        $slotSettings->SetGameData($slotSettings->slotId . 'trajectory', explode('-', $lastEvent->serverResponse->trajectory));
                        $slotSettings->SetGameData($slotSettings->slotId . 'RemovedSym', $lastEvent->serverResponse->RemovedSym);
                        $slotSettings->SetGameData($slotSettings->slotId . 'freeMultiplier', $lastEvent->serverResponse->freeMultiplier);
                        $bonusWin = $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                        $freeMultiplier = $slotSettings->GetGameData($slotSettings->slotId . 'freeMultiplier');
                        $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01 = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $_obf_0D0110310E3D180C0F042B065C2F2833284021033E0B32 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $_obf_0D2B212D321E2F13251A11275B252D3E120622091F1722 = '"freeGames": { "left": "' . ($_obf_0D0110310E3D180C0F042B065C2F2833284021033E0B32 - $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01) . '", "total": "' . $_obf_0D0110310E3D180C0F042B065C2F2833284021033E0B32 . '", "totalFreeGamesWinnings": "' . round($bonusWin * 100) . '", "totalFreeGamesWinningsMoney": "' . round($bonusWin * 100) . '", "multiplier": "' . $freeMultiplier . '", "totalMultiplier": "' . $freeMultiplier . '" }, "gameSpecific": { "prizesLap1": "C:1,W:5,M:5,R:1,C:2,M:10,W:10,C:1,M:5,C:2,X:2,W:5,C:1,M:10,C:2,R:2,W:10,S:1", "prizesLap2": "C:2,W:10,M:10,R:3,C:5,M:20,W:20,C:2,M:10,C:5,X:3,W:10,C:2,M:20,C:5,R:4,W:20,S:1", "prizesLap3": "C:5,W:20,M:20,R:5,C:10,M:50,W:50,C:5,M:20,C:10,X:5,W:20,C:5,M:50,C:10,R:6,W:50,B:1", "currentLap":' . $lastEvent->serverResponse->currentLap . ', "currentPosition": "' . $lastEvent->serverResponse->currentPosition . '" , "underlay": "0,0,0,0,0,0,0,0,0,0,0,0,0,0,0", "currentFreespin": "' . $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01 . '", "trajectory": "' . $lastEvent->serverResponse->trajectory . '"  }, ';
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
                        2, 
                        1, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[6] = [
                        2, 
                        3, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[7] = [
                        1, 
                        2, 
                        1, 
                        2, 
                        1
                    ];
                    $linesId[8] = [
                        3, 
                        2, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[9] = [
                        1, 
                        3, 
                        1, 
                        3, 
                        1
                    ];
                    $linesId[10] = [
                        3, 
                        1, 
                        3, 
                        1, 
                        3
                    ];
                    $linesId[11] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[12] = [
                        3, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[13] = [
                        1, 
                        1, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[14] = [
                        3, 
                        3, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[15] = [
                        1, 
                        1, 
                        3, 
                        1, 
                        1
                    ];
                    $linesId[16] = [
                        3, 
                        3, 
                        1, 
                        3, 
                        3
                    ];
                    $linesId[17] = [
                        2, 
                        3, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[18] = [
                        2, 
                        1, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[19] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        2
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
                        $slotSettings->SetGameData($slotSettings->slotId . 'freeMultiplier', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentLap', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentPosition', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentPositionEnemy', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentPositionRaw', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentPositionEnemyRaw', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'trajectory', []);
                        $slotSettings->SetGameData($slotSettings->slotId . 'RemovedSym', []);
                        $bonusMpl = 1;
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1);
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
                        $_obf_0D141F3813070E100E40350F27112F1C40041A25270E01 = rand(1, 20);
                        if( $winType == 'bonus' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                            $_obf_0D141F3813070E100E40350F27112F1C40041A25270E01 = 0;
                        }
                        $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 = '';
                        if( $_obf_0D141F3813070E100E40350F27112F1C40041A25270E01 == 1 ) 
                        {
                            $_obf_0D1D30273F3C022B39240416280929310311400B080C22 = rand(3, 8);
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
                            $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 = ', "gameSpecific": { "featureType": "wilds", "underlay": "' . implode(',', $_obf_0D312B19262C083426241E0D392E22282324060B380811[0]) . ',' . implode(',', $_obf_0D312B19262C083426241E0D392E22282324060B380811[1]) . ',' . implode(',', $_obf_0D312B19262C083426241E0D392E22282324060B380811[2]) . '" } ';
                        }
                        if( $_obf_0D141F3813070E100E40350F27112F1C40041A25270E01 == 2 ) 
                        {
                            $_obf_0D1D30273F3C022B39240416280929310311400B080C22 = rand(6, 12);
                            $_obf_0D3F25211A371A07263B3D2C29320D0E0D221501182932 = rand(1, 9);
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
                            $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 = ', "gameSpecific": { "featureType": "respin", "underlay": "' . implode(',', $_obf_0D312B19262C083426241E0D392E22282324060B380811[0]) . ',' . implode(',', $_obf_0D312B19262C083426241E0D392E22282324060B380811[1]) . ',' . implode(',', $_obf_0D312B19262C083426241E0D392E22282324060B380811[2]) . '" } ';
                        }
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                            $currentLap = $slotSettings->GetGameData($slotSettings->slotId . 'currentLap');
                            $currentPosition = $slotSettings->GetGameData($slotSettings->slotId . 'currentPosition');
                            $currentPositionEnemy = $slotSettings->GetGameData($slotSettings->slotId . 'currentPositionEnemy');
                            $currentPositionRaw = $slotSettings->GetGameData($slotSettings->slotId . 'currentPositionRaw');
                            $currentPositionEnemyRaw = $slotSettings->GetGameData($slotSettings->slotId . 'currentPositionEnemyRaw');
                            $CurrentFreeGame = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                            $trajectory = $slotSettings->GetGameData($slotSettings->slotId . 'trajectory');
                            $freeMultiplier = $slotSettings->GetGameData($slotSettings->slotId . 'freeMultiplier');
                            $RemovedSym = $slotSettings->GetGameData($slotSettings->slotId . 'RemovedSym');
                            $_obf_0D333837090A06263B2518323F311D341433325C402232 = [];
                            $_obf_0D333837090A06263B2518323F311D341433325C402232[0] = [];
                            $_obf_0D333837090A06263B2518323F311D341433325C402232[1] = [
                                '', 
                                'C:1', 
                                'W:5', 
                                'M:5', 
                                'R:1', 
                                'C:2', 
                                'M:10', 
                                'W:10', 
                                'C:1', 
                                'M:5', 
                                'C:2', 
                                'X:2', 
                                'W:5', 
                                'C:1', 
                                'M:10', 
                                'C:2', 
                                'R:2', 
                                'W:10', 
                                'S:1'
                            ];
                            $_obf_0D333837090A06263B2518323F311D341433325C402232[2] = [
                                '', 
                                'C:2', 
                                'W:10', 
                                'M:10', 
                                'R:3', 
                                'C:5', 
                                'M:20', 
                                'W:20', 
                                'C:2', 
                                'M:10', 
                                'C:5', 
                                'X:3', 
                                'W:10', 
                                'C:2', 
                                'M:20', 
                                'C:5', 
                                'R:4', 
                                'W:20', 
                                'S:1'
                            ];
                            $_obf_0D333837090A06263B2518323F311D341433325C402232[3] = [
                                '', 
                                'C:5', 
                                'W:20', 
                                'M:20', 
                                'R:5', 
                                'C:10', 
                                'M:50', 
                                'W:50', 
                                'C:5', 
                                'M:20', 
                                'C:10', 
                                'X:5', 
                                'W:20', 
                                'C:5', 
                                'M:50', 
                                'C:10', 
                                'R:6', 
                                'W:50', 
                                'B:1'
                            ];
                            $_obf_0D131D140E2F1E1D065B39231C343D1231403007173401 = rand(1, 6);
                            $_obf_0D1E11265C040C330801140F2E2E131A333216082E2222 = rand(1, 6);
                            $currentPosition += $_obf_0D131D140E2F1E1D065B39231C343D1231403007173401;
                            $currentPositionEnemy += $_obf_0D1E11265C040C330801140F2E2E131A333216082E2222;
                            $currentPositionRaw += $_obf_0D131D140E2F1E1D065B39231C343D1231403007173401;
                            $currentPositionEnemyRaw += $_obf_0D1E11265C040C330801140F2E2E131A333216082E2222;
                            if( $currentPosition > 18 ) 
                            {
                                $currentPosition = $currentPosition - 18;
                                $currentLap++;
                            }
                            if( $currentPositionEnemy > 18 ) 
                            {
                                $currentPositionEnemy = $currentPositionEnemy - 18;
                            }
                            $_obf_0D060E3D332F390915383D0526173B25230F0A18120911 = explode(':', $_obf_0D333837090A06263B2518323F311D341433325C402232[$currentLap][$currentPosition]);
                            $trajectory[] = $_obf_0D131D140E2F1E1D065B39231C343D1231403007173401 . ':' . $currentPositionRaw . ':' . $_obf_0D1E11265C040C330801140F2E2E131A333216082E2222 . ':' . $currentPositionEnemyRaw;
                            $_obf_0D1D30273F3C022B39240416280929310311400B080C22 = 0;
                            $_obf_0D3F25211A371A07263B3D2C29320D0E0D221501182932 = 0;
                            $_obf_0D0217241929301638395C0235285B1210233935191332 = [];
                            for( $r = 1; $r <= 9; $r++ ) 
                            {
                                if( !in_array($r, $RemovedSym) ) 
                                {
                                    $_obf_0D0217241929301638395C0235285B1210233935191332[] = $r;
                                }
                            }
                            shuffle($_obf_0D0217241929301638395C0235285B1210233935191332);
                            if( $_obf_0D060E3D332F390915383D0526173B25230F0A18120911[0] == 'W' ) 
                            {
                                $_obf_0D3F25211A371A07263B3D2C29320D0E0D221501182932 = 10;
                                $_obf_0D1D30273F3C022B39240416280929310311400B080C22 = (int)$_obf_0D060E3D332F390915383D0526173B25230F0A18120911[1];
                            }
                            if( $_obf_0D060E3D332F390915383D0526173B25230F0A18120911[0] == 'C' ) 
                            {
                                $totalWin = (int)$_obf_0D060E3D332F390915383D0526173B25230F0A18120911[1] * $allbet;
                            }
                            if( $_obf_0D060E3D332F390915383D0526173B25230F0A18120911[0] == 'M' ) 
                            {
                                $_obf_0D3F25211A371A07263B3D2C29320D0E0D221501182932 = $_obf_0D0217241929301638395C0235285B1210233935191332[0];
                                $_obf_0D1D30273F3C022B39240416280929310311400B080C22 = (int)$_obf_0D060E3D332F390915383D0526173B25230F0A18120911[1];
                            }
                            if( $_obf_0D060E3D332F390915383D0526173B25230F0A18120911[0] == 'R' ) 
                            {
                                $RemovedSym[] = (int)$_obf_0D060E3D332F390915383D0526173B25230F0A18120911[1];
                            }
                            if( $_obf_0D060E3D332F390915383D0526173B25230F0A18120911[0] == 'X' ) 
                            {
                                $freeMultiplier = (int)$_obf_0D060E3D332F390915383D0526173B25230F0A18120911[1];
                            }
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
                            if( $_obf_0D1D30273F3C022B39240416280929310311400B080C22 >= 10 ) 
                            {
                                $_obf_0D1D30273F3C022B39240416280929310311400B080C22 = rand(5, 10);
                            }
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
                                    if( in_array($reels['reel' . $r][$p], $RemovedSym) ) 
                                    {
                                        $reels['reel' . $r][$p] = array_shift($_obf_0D0217241929301638395C0235285B1210233935191332);
                                    }
                                    if( $reels['reel' . $r][$p] == -1 && $_obf_0D3F25211A371A07263B3D2C29320D0E0D221501182932 > 0 ) 
                                    {
                                        $reels['reel' . $r][$p] = $_obf_0D3F25211A371A07263B3D2C29320D0E0D221501182932;
                                        if( $_obf_0D060E3D332F390915383D0526173B25230F0A18120911[0] == 'M' ) 
                                        {
                                            $_obf_0D312B19262C083426241E0D392E22282324060B380811[$p][] = '12';
                                        }
                                        else
                                        {
                                            $_obf_0D312B19262C083426241E0D392E22282324060B380811[$p][] = $_obf_0D3F25211A371A07263B3D2C29320D0E0D221501182932;
                                        }
                                    }
                                    else
                                    {
                                        $_obf_0D312B19262C083426241E0D392E22282324060B380811[$p][] = '0';
                                    }
                                }
                            }
                            $_obf_0D1E3C3210033C2C23250709122A15273622403E311511 = '';
                            if( $_obf_0D060E3D332F390915383D0526173B25230F0A18120911[0] == 'M' || $_obf_0D060E3D332F390915383D0526173B25230F0A18120911[0] == 'W' ) 
                            {
                                $_obf_0D1E3C3210033C2C23250709122A15273622403E311511 = ', "underlay": "' . implode(',', $_obf_0D312B19262C083426241E0D392E22282324060B380811[0]) . ',' . implode(',', $_obf_0D312B19262C083426241E0D392E22282324060B380811[1]) . ',' . implode(',', $_obf_0D312B19262C083426241E0D392E22282324060B380811[2]) . '"';
                            }
                            $_obf_0D2A2D012136230B1A013337032D163336113D37213832 = ', "currentLap": "' . $currentLap . '", "currentPosition": "' . $currentPosition . '" ' . $_obf_0D1E3C3210033C2C23250709122A15273622403E311511 . ', "currentFreespin": "' . $CurrentFreeGame . '", "trajectory": "' . implode('-', $trajectory) . '" ';
                            $bonusMpl = $freeMultiplier;
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "pos": "' . $k . '", "initialValue": { }, "initialValueMoney": { }, "value": "' . round(($cWins[$k] * 100) / $betlineRaw) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "hl": "' . $sp[0] . '' . $sp[1] . '000", "symbolId": "22", "multiplier": "' . $bonusMpl . '" }';
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "pos": "' . $k . '", "initialValue": { }, "initialValueMoney": { }, "value": "' . round(($cWins[$k] * 100) / $betlineRaw) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "hl": "' . $sp[0] . '' . $sp[1] . '' . $sp[2] . '00", "symbolId": "22", "multiplier": "' . $bonusMpl . '" }';
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "pos": "' . $k . '", "initialValue": { }, "initialValueMoney": { }, "value": "' . round(($cWins[$k] * 100) / $betlineRaw) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "hl": "' . $sp[0] . '' . $sp[1] . '' . $sp[2] . '' . $sp[3] . '0", "symbolId": "22", "multiplier": "' . $bonusMpl . '" }';
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "pos": "' . $k . '", "initialValue": { }, "initialValueMoney": { }, "value": "' . round(($cWins[$k] * 100) / $betlineRaw) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "hl": "' . $sp[0] . '' . $sp[1] . '' . $sp[2] . '' . $sp[3] . '' . $sp[4] . '", "symbolId": "22", "multiplier": "' . $bonusMpl . '" }';
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
                            $slotSettings->SetGameData($slotSettings->slotId . 'freeMultiplier', 1);
                            $slotSettings->SetGameData($slotSettings->slotId . 'currentLap', 1);
                            $slotSettings->SetGameData($slotSettings->slotId . 'currentPosition', 0);
                            $slotSettings->SetGameData($slotSettings->slotId . 'currentPositionEnemy', 0);
                            $slotSettings->SetGameData($slotSettings->slotId . 'currentPositionRaw', 0);
                            $slotSettings->SetGameData($slotSettings->slotId . 'currentPositionEnemyRaw', 0);
                            $slotSettings->SetGameData($slotSettings->slotId . 'trajectory', []);
                            $slotSettings->SetGameData($slotSettings->slotId . 'RemovedSym', []);
                            $scattersStr = ', "scatters": { "value": "0", "valueMoney": "0", "multiplier": "1", "hl": "' . implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811) . '" }, "freeGamesWin": { "total": "' . $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 . '", "multiplier": "1", "hl": "' . implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811) . '" }, "gameSpecific": { "prizesLap1": "C:1,W:5,M:5,R:1,C:2,M:10,W:10,C:1,M:5,C:2,X:2,W:5,C:1,M:10,C:2,R:2,W:10,S:1", "prizesLap2": "C:2,W:10,M:10,R:3,C:5,M:20,W:20,C:2,M:10,C:5,X:3,W:10,C:2,M:20,C:5,R:4,W:20,S:1", "prizesLap3": "C:5,W:20,M:20,R:5,C:10,M:50,W:50,C:5,M:20,C:10,X:5,W:20,C:5,M:50,C:10,R:6,W:50,B:1", "currentLap": "1" }';
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
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 2);
                        $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentLap', $currentLap);
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentPosition', $currentPosition);
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentPositionEnemy', $currentPositionEnemy);
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentPositionRaw', $currentPositionRaw);
                        $slotSettings->SetGameData($slotSettings->slotId . 'currentPositionEnemyRaw', $currentPositionEnemyRaw);
                        $slotSettings->SetGameData($slotSettings->slotId . 'freeMultiplier', $freeMultiplier);
                        $slotSettings->SetGameData($slotSettings->slotId . 'trajectory', $trajectory);
                        $slotSettings->SetGameData($slotSettings->slotId . 'RemovedSym', $RemovedSym);
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' && $currentPositionRaw <= $currentPositionEnemyRaw ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame'));
                    }
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"RemovedSym":[' . implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'RemovedSym')) . '],"trajectory":"' . implode('-', $slotSettings->GetGameData($slotSettings->slotId . 'trajectory')) . '","freeMultiplier":' . $slotSettings->GetGameData($slotSettings->slotId . 'freeMultiplier') . ',"currentPositionEnemyRaw":' . $slotSettings->GetGameData($slotSettings->slotId . 'currentPositionEnemy') . ',"currentPosition":' . $slotSettings->GetGameData($slotSettings->slotId . 'currentPosition') . ',"currentPositionEnemy":' . $slotSettings->GetGameData($slotSettings->slotId . 'currentPositionEnemyRaw') . ',"currentPositionRaw":' . $slotSettings->GetGameData($slotSettings->slotId . 'currentPositionRaw') . ',"currentLap":' . $slotSettings->GetGameData($slotSettings->slotId . 'currentLap') . ',"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = $slotSettings->GetGameData($slotSettings->slotId . 'Cards');
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
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "d01cf0d7-074f-4524-86be-3361658789f3", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "25520003501587914269973255464480393810966409" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "1", "readValue": "0" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "25", "symbols": { "line": [  ' . $curReels . '  ] }, "lines": { "line": [ ' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . ' ] }, "freeGames": { "left": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . '", "total": "' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '", "totalFreeGamesWinnings": "' . (($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) / $betlineRaw) . '", "totalFreeGamesWinningsMoney": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . '", "multiplier": "' . $bonusMpl . '", "totalMultiplier": "' . $bonusMpl . '" }, "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "totalMultiplier": "' . $bonusMpl . '", "bonusRequest": "0", "gameSpecific": { "prizesLap1": "C:1,W:5,M:5,R:1,C:2,M:10,W:10,C:1,M:5,C:2,X:2,W:5,C:1,M:10,C:2,R:2,W:10,S:1", "prizesLap2": "C:2,W:10,M:10,R:3,C:5,M:20,W:20,C:2,M:10,C:5,X:3,W:10,C:2,M:20,C:5,R:4,W:20,S:1", "prizesLap3": "C:5,W:20,M:20,R:5,C:10,M:50,W:50,C:5,M:20,C:10,X:5,W:20,C:5,M:50,C:10,R:6,W:50,B:1"' . $_obf_0D2A2D012136230B1A013337032D163336113D37213832 . ' }  }, "doubleWin": { "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "e9e8d380-bc70-46a9-aad3-3a3e66d81528", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "25520003501587903974365541166421222354308299" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "1", "readValue": "1" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "25", "symbols": { "line": [ ' . $curReels . ' ] }, "lines": { "line": [' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '] }' . $scattersStr . ', "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "totalMultiplier": "' . $bonusMpl . '", "bonusRequest": "0" ' . $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 . ' }, "doubleWin": { "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
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
