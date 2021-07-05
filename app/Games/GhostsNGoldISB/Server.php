<?php 
namespace VanguardLTE\Games\GhostsNGoldISB
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
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "5640f7f3-4693-4059-841a-dc3afd3f1925", "data": { "version": { "versionServer": "2.2.0.1-1", "versionGMAPI": "8.1.16 GS:2.5.1 FR:v4" }, "balance": { "cashBalance": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "freeBalance": "0", "ccyCode": "EUR", "ccyDecimal": { }, "ccyThousand": { }, "ccyPrefix": { }, "ccySuffix": { }, "ccyDecimalDigits": { } }, "id": { "roundId": "25520020301588680413177316196800814753252699" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "readValue": "1" }, "initial": { "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "coins": "30", "coinValue": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "lines": "20", "currentState": "beginGame", "lastGame": { "endGame": { ' . $_obf_0D2B212D321E2F13251A11275B252D3E120622091F1722 . '"money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "bet": "' . ($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] * 20) . '", "symbols": { "line": [ "-1--1--1--1--1", "-1--1--1--1--1", "-1--1--1--1--1" ] }, "lines": { }, "totalWinnings": "0", "totalWinningsMoney": "0", "doubleWin": { "totalWinnings": "0", "totalWinningsMoney": "0", "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '" }, "totalMultiplier": { }, "bonusRequest": { } } } } } } }';
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
                    $lines = 30;
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
                        $_obf_0D39382B292D010C2111343015362633391A283E330A01 = rand(1, 50);
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                            $_obf_0D39382B292D010C2111343015362633391A283E330A01 = rand(1, 5);
                        }
                        $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 = '';
                        if( $_obf_0D39382B292D010C2111343015362633391A283E330A01 == 1 && $winType != 'bonus' ) 
                        {
                            $_obf_0D1D30273F3C022B39240416280929310311400B080C22 = rand(3, 8);
                            $_obf_0D3F25211A371A07263B3D2C29320D0E0D221501182932 = 11;
                            $_obf_0D0406381314331D2A1D0A1C2802241637060210063C22 = [
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
                                    2, 
                                    3
                                ], 
                                [
                                    2, 
                                    4
                                ], 
                                [
                                    2, 
                                    5
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
                                    3, 
                                    3
                                ], 
                                [
                                    3, 
                                    4
                                ], 
                                [
                                    3, 
                                    5
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
                                    4, 
                                    3
                                ], 
                                [
                                    4, 
                                    4
                                ], 
                                [
                                    4, 
                                    5
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
                                ], 
                                [
                                    5, 
                                    3
                                ], 
                                [
                                    5, 
                                    4
                                ], 
                                [
                                    5, 
                                    5
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
                                [], 
                                [], 
                                [], 
                                [], 
                                []
                            ];
                            for( $p = 0; $p <= 5; $p++ ) 
                            {
                                for( $r = 2; $r <= 5; $r++ ) 
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
                            $_obf_0D322522032331331B2724151F1A185C0F2316130A3522 = [
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
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
                            $_obf_0D22273E5B1E01393F231326095B392137092340110901 = 0;
                            for( $p = 0; $p <= 5; $p++ ) 
                            {
                                for( $r = 1; $r <= 5; $r++ ) 
                                {
                                    if( $reels['reel' . $r][$p] == $_obf_0D3F25211A371A07263B3D2C29320D0E0D221501182932 ) 
                                    {
                                        $_obf_0D322522032331331B2724151F1A185C0F2316130A3522[$_obf_0D22273E5B1E01393F231326095B392137092340110901] = 1;
                                    }
                                    $_obf_0D22273E5B1E01393F231326095B392137092340110901++;
                                }
                            }
                            $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 = ', "wilds": { "wild": { "type": "2", "id": "11", "pos": { "line": [ "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0" ] }, "mask": { "line": [ "' . implode('-', $_obf_0D312B19262C083426241E0D392E22282324060B380811[0]) . '", "' . implode('-', $_obf_0D312B19262C083426241E0D392E22282324060B380811[0]) . '", "' . implode('-', $_obf_0D312B19262C083426241E0D392E22282324060B380811[0]) . '", "' . implode('-', $_obf_0D312B19262C083426241E0D392E22282324060B380811[0]) . '", "' . implode('-', $_obf_0D312B19262C083426241E0D392E22282324060B380811[0]) . '", "' . implode('-', $_obf_0D312B19262C083426241E0D392E22282324060B380811[0]) . '" ] } } }, "gameSpecific": { "dragonDropWilds": "' . implode('', $_obf_0D322522032331331B2724151F1A185C0F2316130A3522) . '" }';
                        }
                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '';
                        $k = 0;
                        for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                        {
                            $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = (string)$slotSettings->SymbolGame[$j];
                            if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $scatter || !isset($slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132]) ) 
                            {
                            }
                            else
                            {
                                $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022 = [
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
                                $_obf_0D0B162134012C3C19132E1C331B1B091619271B2F4001 = 0;
                                for( $r = 1; $r <= 5; $r++ ) 
                                {
                                    $_obf_0D3B0533380C35211E0F23102A21363D0F14150C0A2332 = true;
                                    for( $p = 0; $p <= 5; $p++ ) 
                                    {
                                        if( $reels['reel' . $r][$p] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $reels['reel' . $r][$p] == $wild ) 
                                        {
                                            $_obf_0D3B0533380C35211E0F23102A21363D0F14150C0A2332 = false;
                                            $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[$r]++;
                                            $_obf_0D0B162134012C3C19132E1C331B1B091619271B2F4001 = $r;
                                        }
                                    }
                                    if( $_obf_0D3B0533380C35211E0F23102A21363D0F14150C0A2332 ) 
                                    {
                                        break;
                                    }
                                }
                                $_obf_0D1D15220D1325253F2219091A382D241B14302A071A22 = [
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
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
                                $_obf_0D330B271914190127191F14190C5B0129093E5B380F01 = 0;
                                for( $p = 0; $p <= 5; $p++ ) 
                                {
                                    for( $r = 1; $r <= 5; $r++ ) 
                                    {
                                        if( ($reels['reel' . $r][$p] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $reels['reel' . $r][$p] == $wild) && $r <= $_obf_0D0B162134012C3C19132E1C331B1B091619271B2F4001 ) 
                                        {
                                            $_obf_0D1D15220D1325253F2219091A382D241B14302A071A22[$_obf_0D330B271914190127191F14190C5B0129093E5B380F01] = 1;
                                        }
                                        $_obf_0D330B271914190127191F14190C5B0129093E5B380F01++;
                                    }
                                }
                                if( $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[1] > 0 && $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[2] > 0 && $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[3] > 0 ) 
                                {
                                    $_obf_0D011B072F07402E1E5B23261A11211F21101F381A2C32 = $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[1] * $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[2] * $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[3];
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $betline * $_obf_0D011B072F07402E1E5B23261A11211F21101F381A2C32 * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "ways": "' . $_obf_0D011B072F07402E1E5B23261A11211F21101F381A2C32 . '", "initialValue": "' . round(($cWins[$k] * 100) / $betlineRaw) . '", "initialValueMoney": "' . ($cWins[$k] * 100) . '", "value": "' . round(($cWins[$k] * 100) / $betlineRaw) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "multiplier": "1", "symbolId": "' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '", "pos": "' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '", "hl": "' . implode('', $_obf_0D1D15220D1325253F2219091A382D241B14302A071A22) . '", "dir": "0" }';
                                    }
                                }
                                if( $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[1] > 0 && $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[2] > 0 && $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[3] > 0 && $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[4] > 0 ) 
                                {
                                    $_obf_0D011B072F07402E1E5B23261A11211F21101F381A2C32 = $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[1] * $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[2] * $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[3] * $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[4];
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $betline * $_obf_0D011B072F07402E1E5B23261A11211F21101F381A2C32 * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "ways": "' . $_obf_0D011B072F07402E1E5B23261A11211F21101F381A2C32 . '", "initialValue": "' . round(($cWins[$k] * 100) / $betlineRaw) . '", "initialValueMoney": "' . ($cWins[$k] * 100) . '", "value": "' . round(($cWins[$k] * 100) / $betlineRaw) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "multiplier": "1", "symbolId": "' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '", "pos": "' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '", "hl": "' . implode('', $_obf_0D1D15220D1325253F2219091A382D241B14302A071A22) . '", "dir": "0" }';
                                    }
                                }
                                if( $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[1] > 0 && $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[2] > 0 && $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[3] > 0 && $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[4] > 0 && $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[5] > 0 ) 
                                {
                                    $_obf_0D011B072F07402E1E5B23261A11211F21101F381A2C32 = $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[1] * $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[2] * $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[3] * $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[4] * $_obf_0D400C2B0C4040290529333B280406045B3F34153B1022[5];
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $betline * $_obf_0D011B072F07402E1E5B23261A11211F21101F381A2C32 * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "ways": "' . $_obf_0D011B072F07402E1E5B23261A11211F21101F381A2C32 . '", "initialValue": "' . round(($cWins[$k] * 100) / $betlineRaw) . '", "initialValueMoney": "' . ($cWins[$k] * 100) . '", "value": "' . round(($cWins[$k] * 100) / $betlineRaw) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "multiplier": "1", "symbolId": "' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '", "pos": "' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '", "hl": "' . implode('', $_obf_0D1D15220D1325253F2219091A382D241B14302A071A22) . '", "dir": "0" }';
                                    }
                                }
                                if( $cWins[$k] > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                                {
                                    array_push($lineWins, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                                    $totalWin += $cWins[$k];
                                }
                                $k++;
                            }
                        }
                        $scattersWin = 0;
                        $scattersStr = '';
                        $scattersCount = 0;
                        $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [];
                        for( $p = 0; $p <= 5; $p++ ) 
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
                            $scattersStr = ', "scatters": { "value": "0", "valueMoney": "0", "multiplier": "1", "hl": "' . implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811) . '" }, "freeGamesWin": { "total": "' . $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 . '", "multiplier": "1", "hl": "' . implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811) . '" }';
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
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = $slotSettings->GetGameData($slotSettings->slotId . 'Cards');
                    $curReels = '';
                    $curReels .= ('"' . $reels['reel1'][0] . '-' . $reels['reel2'][0] . '-' . $reels['reel3'][0] . '-' . $reels['reel4'][0] . '-' . $reels['reel5'][0] . '"');
                    $curReels .= (',"' . $reels['reel1'][1] . '-' . $reels['reel2'][1] . '-' . $reels['reel3'][1] . '-' . $reels['reel4'][1] . '-' . $reels['reel5'][1] . '"');
                    $curReels .= (',"' . $reels['reel1'][2] . '-' . $reels['reel2'][2] . '-' . $reels['reel3'][2] . '-' . $reels['reel4'][2] . '-' . $reels['reel5'][2] . '"');
                    $curReels .= (',"-1-' . $reels['reel2'][3] . '-' . $reels['reel3'][3] . '-' . $reels['reel4'][3] . '-' . $reels['reel5'][3] . '"');
                    $curReels .= (',"-1-' . $reels['reel2'][4] . '-' . $reels['reel3'][4] . '-' . $reels['reel4'][4] . '-' . $reels['reel5'][4] . '"');
                    $curReels .= (',"-1-' . $reels['reel2'][5] . '-' . $reels['reel3'][5] . '-' . $reels['reel4'][5] . '-' . $reels['reel5'][5] . '"');
                    $_obf_0D1F37013027092805312223153703290C250F17350C22 = round($slotSettings->GetBalance() * 100);
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = [];
                    for( $i = 0; $i < count($slotSettings->Bet); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[] = $slotSettings->Bet[$i] * 100;
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "d01cf0d7-074f-4524-86be-3361658789f3", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "25520003501587914269973255464480393810966409" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "readValue": "0" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "20", "symbols": { "line": [  ' . $curReels . '  ] }, "lines": { "line": [ ' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . ' ] }, "freeGames": { "left": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . '", "total": "' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '", "totalFreeGamesWinnings": "' . (($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) / $betlineRaw) . '", "totalFreeGamesWinningsMoney": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . '", "multiplier": "1", "totalMultiplier": "1" }, "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "totalMultiplier": "1", "bonusRequest": { }, "wilds": { "wild": { "type": "2", "id": "11", "pos": { "line": [ "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0" ] }, "mask": { "line": [ "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0" ] } } }' . $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 . ' }, "doubleWin": { "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "901cc9a9-47fd-4e39-a483-04132c59ae8c", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "255551901588710457781853013233514248334670" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "readValue": "0" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "30", "symbols": { "line": [ ' . $curReels . ' ] }, "lines": {"line": [ ' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . ' ]  }' . $scattersStr . ', "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "totalMultiplier": { }, "bonusRequest": { }, "wilds": { "wild": { "type": "2", "id": "11", "pos": { "line": [ "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0" ] }, "mask": { "line": [ "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0", "0-0-0-0-0" ] } } }' . $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 . ' }, "doubleWin": { "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
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
