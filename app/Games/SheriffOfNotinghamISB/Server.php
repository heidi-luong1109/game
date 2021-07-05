<?php 
namespace VanguardLTE\Games\SheriffOfNotinghamISB
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
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "24f86986-1081-49df-b75a-4d4830bb80b4", "data": { "version": { "versionServer": "2.2.0.1-3", "versionGMAPI": "8.1.16 GS:2.5.1 FR:v4" }, "balance": { "cashBalance": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "freeBalance": "0", "ccyCode": "USD", "ccyDecimal": { }, "ccyThousand": { }, "ccyPrefix": { }, "ccySuffix": { }, "ccyDecimalDigits": { } }, "id": { "roundId": "25520003501587064156642840845543695174381020" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "readValue": "1" }, "initial": { "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "coins": "1", "coinValue": "1", "lines": "25", "currentState": "beginGame", "lastGame": { "endGame": { ' . $_obf_0D2B212D321E2F13251A11275B252D3E120622091F1722 . '"money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "bet": "25", "symbols": { "line": [ "-1--1--1--1--1", "-1--1--1--1--1", "-1--1--1--1--1" ] }, "lines": { }, "totalWinnings": "0", "totalWinningsMoney": "0", "doubleWin": { "totalWinnings": "0", "totalWinningsMoney": "0", "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '" }, "totalMultiplier": "1", "bonusRequest": { } } } } } } }';
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
                    $linesId[20] = [
                        3, 
                        1, 
                        1, 
                        1, 
                        3
                    ];
                    $linesId[21] = [
                        2, 
                        3, 
                        1, 
                        3, 
                        2
                    ];
                    $linesId[22] = [
                        2, 
                        1, 
                        3, 
                        1, 
                        2
                    ];
                    $linesId[23] = [
                        1, 
                        3, 
                        1, 
                        3, 
                        1
                    ];
                    $linesId[24] = [
                        3, 
                        1, 
                        3, 
                        1, 
                        3
                    ];
                    $lines = 25;
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
                        $wild = ['9'];
                        $scatter = '11';
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                            $_obf_0D5B393E1B0C093C0D293F26230E14300C261D22160F32 = [
                                1, 
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
                                3, 
                                3, 
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
                                4, 
                                4, 
                                5, 
                                5, 
                                5, 
                                5, 
                                5, 
                                5, 
                                5
                            ];
                            $_obf_0D311A0922102A2C171F281032173D250D01093F223422 = [
                                0, 
                                0, 
                                0, 
                                0, 
                                0
                            ];
                            $_obf_0D1D3E1B1235301805040F3B02273B2A150F0B3D5C2722 = rand(1, 5);
                            $_obf_0D112717051E2229390D34022C0F2332242F385C311411 = rand(2, 5);
                            shuffle($_obf_0D5B393E1B0C093C0D293F26230E14300C261D22160F32);
                            $_obf_0D311A0922102A2C171F281032173D250D01093F223422[$_obf_0D1D3E1B1235301805040F3B02273B2A150F0B3D5C2722 - 1] = 1;
                            for( $r = 1; $r <= $_obf_0D112717051E2229390D34022C0F2332242F385C311411; $r++ ) 
                            {
                                $_obf_0D311A0922102A2C171F281032173D250D01093F223422[$_obf_0D5B393E1B0C093C0D293F26230E14300C261D22160F32[$r] - 1] = 1;
                                $reels['reel' . $_obf_0D5B393E1B0C093C0D293F26230E14300C261D22160F32[$r]] = $reels['reel' . $_obf_0D1D3E1B1235301805040F3B02273B2A150F0B3D5C2722];
                            }
                        }
                        $_obf_0D3D2F0A2E111F253F0509321E2303182E221C2A280D01 = [
                            'STACKED_WILDS', 
                            'STACKED_WILDS', 
                            'WIN_SPIN', 
                            'WIN_SPIN', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            '', 
                            ''
                        ];
                        shuffle($_obf_0D3D2F0A2E111F253F0509321E2303182E221C2A280D01);
                        $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 = '"gameSpecific": { "currentCashPrizes": "0-0-0-0-0-0-0-0-0-0-0-0-0-0-0", "currentCashPrizesMoney": "0-0-0-0-0-0-0-0-0-0-0-0-0-0-0" }';
                        $_obf_0D18112F383D2733191F29042B0F213E2208212F0C3F32 = '';
                        if( $_obf_0D3D2F0A2E111F253F0509321E2303182E221C2A280D01[0] == 'WIN_SPIN' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' && $winType !== 'bonus' ) 
                        {
                            $_obf_0D3C240B2B39091A031A302C0E5B210E17373304182C11 = [];
                            $_obf_0D251D08341C38383322210C1F3E1818313E152D2E0A32 = [
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
                            $rsym = rand(1, 8);
                            $_obf_0D380323213538350715102D0B2906322B352725140932 = rand(4, 12);
                            shuffle($_obf_0D251D08341C38383322210C1F3E1818313E152D2E0A32);
                            for( $_obf_0D141E31211D2540361A2E225B0B1C01271C5B0B1F2F11 = 0; $_obf_0D141E31211D2540361A2E225B0B1C01271C5B0B1F2F11 < $_obf_0D380323213538350715102D0B2906322B352725140932; $_obf_0D141E31211D2540361A2E225B0B1C01271C5B0B1F2F11++ ) 
                            {
                                $_obf_0D342A0C36271E1B1A1240140D2111220D171E1D170A11 = $_obf_0D251D08341C38383322210C1F3E1818313E152D2E0A32[$_obf_0D141E31211D2540361A2E225B0B1C01271C5B0B1F2F11];
                                $reels['reel' . $_obf_0D342A0C36271E1B1A1240140D2111220D171E1D170A11[0]][$_obf_0D342A0C36271E1B1A1240140D2111220D171E1D170A11[1]] = $rsym;
                            }
                            for( $p = 0; $p <= 2; $p++ ) 
                            {
                                for( $r = 1; $r <= 5; $r++ ) 
                                {
                                    if( $reels['reel' . $r][$p] == $rsym ) 
                                    {
                                        $_obf_0D3C240B2B39091A031A302C0E5B210E17373304182C11[] = $rsym;
                                    }
                                    else
                                    {
                                        $_obf_0D3C240B2B39091A031A302C0E5B210E17373304182C11[] = '0';
                                    }
                                }
                            }
                            $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 = '"gameSpecific": { "currentCashPrizes": "0-0-0-0-0-0-0-0-0-0-0-0-0-0-0", "currentCashPrizesMoney": "0-0-0-0-0-0-0-0-0-0-0-0-0-0-0", "dummyModifierActive": "1", "dummyModifierName": "WIN_SPIN", "dummyModifierSymbolsMask": "' . implode('-', $_obf_0D3C240B2B39091A031A302C0E5B210E17373304182C11) . '" }';
                        }
                        if( $_obf_0D3D2F0A2E111F253F0509321E2303182E221C2A280D01[0] == 'STACKED_WILDS' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' && $winType !== 'bonus' ) 
                        {
                            $_obf_0D3C240B2B39091A031A302C0E5B210E17373304182C11 = [];
                            $_obf_0D1A315B251C403529341210072C0A2C1924180C121422 = [
                                1, 
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
                                3, 
                                3, 
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
                                4, 
                                4, 
                                5, 
                                5, 
                                5, 
                                5, 
                                5, 
                                5, 
                                5
                            ];
                            shuffle($_obf_0D1A315B251C403529341210072C0A2C1924180C121422);
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                $reels['reel' . $_obf_0D1A315B251C403529341210072C0A2C1924180C121422[$r]][0] = '9';
                                $reels['reel' . $_obf_0D1A315B251C403529341210072C0A2C1924180C121422[$r]][1] = '9';
                                $reels['reel' . $_obf_0D1A315B251C403529341210072C0A2C1924180C121422[$r]][2] = '9';
                            }
                            for( $p = 0; $p <= 2; $p++ ) 
                            {
                                for( $r = 1; $r <= 5; $r++ ) 
                                {
                                    if( $reels['reel' . $r][$p] == '9' ) 
                                    {
                                        $_obf_0D3C240B2B39091A031A302C0E5B210E17373304182C11[] = '9';
                                    }
                                    else
                                    {
                                        $_obf_0D3C240B2B39091A031A302C0E5B210E17373304182C11[] = '0';
                                    }
                                }
                            }
                            $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 = '"gameSpecific": { "currentCashPrizes": "0-0-0-0-0-0-0-0-0-0-0-0-0-0-0", "currentCashPrizesMoney": "0-0-0-0-0-0-0-0-0-0-0-0-0-0-0", "dummyModifierActive": "1", "dummyModifierName": "STACKED_WILDS", "dummyModifierSymbolsMask": "' . implode('-', $_obf_0D3C240B2B39091A031A302C0E5B210E17373304182C11) . '" }';
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
                        $respinsNewSymbols = [];
                        $respinsOriginalSymbols = [];
                        $_obf_0D392D2B215B05122C0132132E1E22035B01092D293732 = [];
                        $_obf_0D32162D3B05023F27020728122133213927295C192D22 = [];
                        $respinsTotalWinningsMoney = 0;
                        $_obf_0D162C161130011D0E16060B29323534362D091D371222 = 0;
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
                                $respinsOriginalSymbols[] = $reels['reel' . $r][$p];
                                if( $reels['reel' . $r][$p] >= 14 ) 
                                {
                                    $_obf_0D28301D333F2827165C2511011438180336175B1E2A01++;
                                    $respinsNewSymbols[] = $reels['reel' . $r][$p];
                                    $_obf_0D392D2B215B05122C0132132E1E22035B01092D293732[] = $slotSettings->WantedPaytable['SYM_' . $reels['reel' . $r][$p]] * $allbet * 100;
                                    $_obf_0D32162D3B05023F27020728122133213927295C192D22[] = $slotSettings->WantedPaytable['SYM_' . $reels['reel' . $r][$p]];
                                    $respinsTotalWinningsMoney += ($slotSettings->WantedPaytable['SYM_' . $reels['reel' . $r][$p]] * $allbet);
                                    $_obf_0D162C161130011D0E16060B29323534362D091D371222 += $slotSettings->WantedPaytable['SYM_' . $reels['reel' . $r][$p]];
                                }
                                else
                                {
                                    $respinsNewSymbols[] = 0;
                                    $_obf_0D392D2B215B05122C0132132E1E22035B01092D293732[] = 0;
                                    $_obf_0D32162D3B05023F27020728122133213927295C192D22[] = 0;
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
                        if( $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 5 ) 
                        {
                            $totalWin += $respinsTotalWinningsMoney;
                            $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 = ' "gameSpecific": { "currentCashPrizes": "' . implode('-', $_obf_0D32162D3B05023F27020728122133213927295C192D22) . '", "currentCashPrizesMoney": "' . implode('-', $_obf_0D392D2B215B05122C0132132E1E22035B01092D293732) . '", "respinsActive": "1", "respinsLeft": "4", "respinsUsed": "0", "respinsLastWin": "' . $_obf_0D162C161130011D0E16060B29323534362D091D371222 . '", "respinsLastWinMoney": "' . ($respinsTotalWinningsMoney * 100) . '", "respinsTotalWinnings": "' . $_obf_0D162C161130011D0E16060B29323534362D091D371222 . '", "respinsTotalWinningsMoney": "' . ($respinsTotalWinningsMoney * 100) . '", "respinsOriginalSymbols": "' . implode('-', $respinsOriginalSymbols) . '", "respinsOriginalCashPrizes": "' . implode('-', $_obf_0D32162D3B05023F27020728122133213927295C192D22) . '", "respinsOriginalCashPrizesMoney": "' . implode('-', $_obf_0D392D2B215B05122C0132132E1E22035B01092D293732) . '", "respinsNewSymbols": "' . implode('-', $respinsNewSymbols) . '" }';
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
                            if( ($scattersCount >= 3 || $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 5) && $winType != 'bonus' ) 
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
                    if( $_obf_0D3D2F0A2E111F253F0509321E2303182E221C2A280D01[0] == 'STACKED_WILDS' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                    {
                        $_obf_0D18112F383D2733191F29042B0F213E2208212F0C3F32 = ', "pendingWin": { "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" }';
                    }
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = [];
                    for( $i = 0; $i < count($slotSettings->Bet); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[] = $slotSettings->Bet[$i] * 100;
                    }
                    if( $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 5 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'respinsTotalWinningsMoney', $respinsTotalWinningsMoney);
                        $slotSettings->SetGameData($slotSettings->slotId . 'AllBet', $allbet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinsTotal', 3);
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinsCurrent', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'respinsCurrentSymbols', $respinsNewSymbols);
                        $slotSettings->SetGameData($slotSettings->slotId . 'respinsNewSymbols', $respinsNewSymbols);
                        $slotSettings->SetGameData($slotSettings->slotId . 'respinsOriginalSymbols', $respinsOriginalSymbols);
                        $slotSettings->SetGameData($slotSettings->slotId . 'curReels', $curReels);
                        $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, 'FG2');
                    }
                    else
                    {
                        $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "d01cf0d7-074f-4524-86be-3361658789f3", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "25520003501587914269973255464480393810966409" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "1", "readValue": "0" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "25", "symbols": { "line": [  ' . $curReels . '  ] }, "lines": { "line": [ ' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . ' ] }, "freeGames": { "left": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . '", "total": "' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '", "totalFreeGamesWinnings": "' . (($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) / $betlineRaw) . '", "totalFreeGamesWinningsMoney": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . '", "multiplier": "1", "totalMultiplier": "1" }, "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "totalMultiplier": "1", "bonusRequest": { }, "insync": { "sync": { "from": "0-0-0-0-0", "to": "' . implode('-', $_obf_0D311A0922102A2C171F281032173D250D01093F223422) . '", "mask": "' . implode('-', $_obf_0D311A0922102A2C171F281032173D250D01093F223422) . '" } } }, "doubleWin": { "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "e9e8d380-bc70-46a9-aad3-3a3e66d81528", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "25520003501587903974365541166421222354308299" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "1", "readValue": "1" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "25", "symbols": { "line": [ ' . $curReels . ' ] }, "lines": { "line": [' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '] }' . $scattersStr . ', "totalWinnings": "' . round(($totalWin * 100) / $betlineRaw) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "totalMultiplier": "' . $bonusMpl . '", "bonusRequest": { }, ' . $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 . ' }' . $_obf_0D18112F383D2733191F29042B0F213E2208212F0C3F32 . ', "doubleWin": { "totalWinnings": "0", "totalWinningsMoney": "0", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
                        $slotSettings->SetGameData($slotSettings->slotId . 'LastResponse', $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0]);
                    }
                    break;
                case '104':
                    $_obf_0D262116282916132E193523093C222827332A111E2B11 = $slotSettings->GetGameData($slotSettings->slotId . 'respinsTotalWinningsMoney');
                    $allbet = $slotSettings->GetGameData($slotSettings->slotId . 'AllBet');
                    $RespinsTotal = $slotSettings->GetGameData($slotSettings->slotId . 'RespinsTotal');
                    $RespinsCurrent = $slotSettings->GetGameData($slotSettings->slotId . 'RespinsCurrent');
                    $respinsCurrentSymbols = $slotSettings->GetGameData($slotSettings->slotId . 'respinsCurrentSymbols');
                    $_obf_0D3816220E1D3B3640210E0F193B25012A3E40302B0D32 = $slotSettings->GetGameData($slotSettings->slotId . 'respinsNewSymbols');
                    $respinsOriginalSymbols = $slotSettings->GetGameData($slotSettings->slotId . 'respinsOriginalSymbols');
                    $_obf_0D265B023D3C3C3B3115210A31350D100C1E2918381632 = $slotSettings->GetGameData($slotSettings->slotId . 'curReels');
                    $LastResponse = json_decode($slotSettings->GetGameData($slotSettings->slotId . 'LastResponse'), true);
                    if( $RespinsTotal <= 0 || $RespinsTotal < $RespinsCurrent ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid respin state"}';
                        exit( $response );
                    }
                    $bank = $slotSettings->GetBank('bonus');
                    for( $_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 = 1; $_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 <= 2000; $_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01++ ) 
                    {
                        $totalWin = 0;
                        $_obf_0D1914182D29132137280E401103033D0F162722053001 = [
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            14, 
                            14, 
                            15, 
                            15, 
                            16, 
                            17, 
                            18, 
                            19, 
                            20
                        ];
                        $reels = [];
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            shuffle($_obf_0D1914182D29132137280E401103033D0F162722053001);
                            $reels['reel' . $r][0] = $_obf_0D1914182D29132137280E401103033D0F162722053001[0];
                            $reels['reel' . $r][1] = $_obf_0D1914182D29132137280E401103033D0F162722053001[1];
                            $reels['reel' . $r][2] = $_obf_0D1914182D29132137280E401103033D0F162722053001[2];
                        }
                        $rc = 0;
                        for( $p = 0; $p <= 2; $p++ ) 
                        {
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22 = $_obf_0D3816220E1D3B3640210E0F193B25012A3E40302B0D32[$rc];
                                if( $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22 >= 14 ) 
                                {
                                    $reels['reel' . $r][$p] = $_obf_0D143F2A0C3528391A5B28151B03151A21260B26195C22;
                                }
                                $rc++;
                            }
                        }
                        $respinsNewSymbols = [];
                        $_obf_0D392D2B215B05122C0132132E1E22035B01092D293732 = [];
                        $_obf_0D32162D3B05023F27020728122133213927295C192D22 = [];
                        $respinsTotalWinningsMoney = 0;
                        $_obf_0D162C161130011D0E16060B29323534362D091D371222 = 0;
                        for( $p = 0; $p <= 2; $p++ ) 
                        {
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                if( $reels['reel' . $r][$p] >= 14 ) 
                                {
                                    $respinsNewSymbols[] = $reels['reel' . $r][$p];
                                    $_obf_0D392D2B215B05122C0132132E1E22035B01092D293732[] = $slotSettings->WantedPaytable['SYM_' . $reels['reel' . $r][$p]] * $allbet * 100;
                                    $_obf_0D32162D3B05023F27020728122133213927295C192D22[] = $slotSettings->WantedPaytable['SYM_' . $reels['reel' . $r][$p]];
                                    $respinsTotalWinningsMoney += ($slotSettings->WantedPaytable['SYM_' . $reels['reel' . $r][$p]] * $allbet);
                                    $_obf_0D162C161130011D0E16060B29323534362D091D371222 += $slotSettings->WantedPaytable['SYM_' . $reels['reel' . $r][$p]];
                                }
                                else
                                {
                                    $respinsNewSymbols[] = 0;
                                    $_obf_0D392D2B215B05122C0132132E1E22035B01092D293732[] = 0;
                                    $_obf_0D32162D3B05023F27020728122133213927295C192D22[] = 0;
                                }
                            }
                        }
                        $totalWin = $respinsTotalWinningsMoney - $_obf_0D262116282916132E193523093C222827332A111E2B11;
                        if( $totalWin <= $bank ) 
                        {
                            break;
                        }
                        if( $_obf_0D182E3D04083B031231152D232B1935261A062D0A0F01 > 1900 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"internal game error|respin| "}';
                            exit( $response );
                        }
                    }
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank('bonus', -1 * $totalWin);
                        $slotSettings->SetBalance($totalWin);
                    }
                    if( $RespinsTotal == $RespinsCurrent ) 
                    {
                        $_obf_0D1A2A083D150F1E35250A0E0B1B2D262A40055B210311 = $respinsTotalWinningsMoney;
                        $_obf_0D2C1014082C1B15211B5C0D24352A13083C1A3F182711 = 0;
                    }
                    else
                    {
                        $_obf_0D2C1014082C1B15211B5C0D24352A13083C1A3F182711 = 1;
                        $_obf_0D1A2A083D150F1E35250A0E0B1B2D262A40055B210311 = 0;
                    }
                    $_obf_0D3D1A0306023F5C051912282A38230C145B0A265B1F11 = $RespinsTotal - $RespinsCurrent;
                    if( $_obf_0D3D1A0306023F5C051912282A38230C145B0A265B1F11 < 0 ) 
                    {
                        $_obf_0D3D1A0306023F5C051912282A38230C145B0A265B1F11 = 0;
                    }
                    $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 = ' "gameSpecific": { "currentCashPrizes": "' . implode('-', $_obf_0D32162D3B05023F27020728122133213927295C192D22) . '", "currentCashPrizesMoney": "' . implode('-', $_obf_0D392D2B215B05122C0132132E1E22035B01092D293732) . '", "respinsActive": "' . $_obf_0D2C1014082C1B15211B5C0D24352A13083C1A3F182711 . '", "respinsLeft": "' . $_obf_0D3D1A0306023F5C051912282A38230C145B0A265B1F11 . '", "respinsUsed": "4", "respinsLastWin": "0", "respinsLastWinMoney": "0", "respinsTotalWinnings": "' . $_obf_0D162C161130011D0E16060B29323534362D091D371222 . '", "respinsTotalWinningsMoney": "' . ($respinsTotalWinningsMoney * 100) . '", "respinsOriginalSymbols": "' . implode('-', $respinsOriginalSymbols) . '", "respinsOriginalCashPrizes": "' . implode('-', $_obf_0D32162D3B05023F27020728122133213927295C192D22) . '", "respinsOriginalCashPrizesMoney": "' . implode('-', $_obf_0D392D2B215B05122C0132132E1E22035B01092D293732) . '", "respinsNewSymbols": "0-0-0-0-0-0-0-0-0-0-0-0-0-0-0" }';
                    $RespinsCurrent += 1;
                    $slotSettings->SetGameData($slotSettings->slotId . 'respinsTotalWinningsMoney', $respinsTotalWinningsMoney);
                    $slotSettings->SetGameData($slotSettings->slotId . 'AllBet', $allbet);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinsTotal', $RespinsTotal);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinsCurrent', $RespinsCurrent);
                    $slotSettings->SetGameData($slotSettings->slotId . 'respinsCurrentSymbols', $respinsNewSymbols);
                    $slotSettings->SetGameData($slotSettings->slotId . 'respinsNewSymbols', $respinsNewSymbols);
                    $slotSettings->SetGameData($slotSettings->slotId . 'respinsOriginalSymbols', $respinsOriginalSymbols);
                    $LastResponse['rootdata']['data']['endGame']['gameSpecific'] = $_obf_0D1404392B17250B231E1E3D26223035172429311E0401;
                    $_obf_0D1F37013027092805312223153703290C250F17350C22 = round($slotSettings->GetBalance() * 100);
                    $curReels = '';
                    $curReels .= ('"' . $reels['reel1'][0] . '-' . $reels['reel2'][0] . '-' . $reels['reel3'][0] . '-' . $reels['reel4'][0] . '-' . $reels['reel5'][0] . '"');
                    $curReels .= (',"' . $reels['reel1'][1] . '-' . $reels['reel2'][1] . '-' . $reels['reel3'][1] . '-' . $reels['reel4'][1] . '-' . $reels['reel5'][1] . '"');
                    $curReels .= (',"' . $reels['reel1'][2] . '-' . $reels['reel2'][2] . '-' . $reels['reel3'][2] . '-' . $reels['reel4'][2] . '-' . $reels['reel5'][2] . '"');
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = [];
                    for( $i = 0; $i < count($slotSettings->Bet); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[] = $slotSettings->Bet[$i] * 100;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "be0231dc-3c66-47e4-804b-e5c83c6ac617", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "25520003501589206645224829188902808664887969" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "readValue": "0" }, "endGame": { "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "bet": "' . ($allbet * 100) . '", "symbols": { "line": [ ' . $curReels . ' ] }, "lines": { }, "totalWinnings": "0", "totalWinningsMoney": "0", "totalMultiplier": "1", "bonusRequest": { }, ' . $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 . '}, "pendingWin": { "totalWinnings": "' . ($_obf_0D1A2A083D150F1E35250A0E0B1B2D262A40055B210311 * 100) . '", "totalWinningsMoney": "' . ($_obf_0D1A2A083D150F1E35250A0E0B1B2D262A40055B210311 * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
                    $response = '{"responseEvent":"spin","responseType":"respin","serverResponse":{"slotLines":25,"slotBet":' . ($allbet / 25) . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinsTotal') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinsCurrent') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'respinsTotalWinningsMoney') . ',"totalWin":' . $totalWin . ',"winLines":[],"Jackpots":[],"reelsSymbols":[],"lastResponse":' . $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, 25, $totalWin, 'FG2');
                    if( $RespinsTotal <= $RespinsCurrent ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "be0231dc-3c66-47e4-804b-e5c83c6ac617", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "25520003501589206645224829188902808664887969" }, "coinValues": {  "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "readValue": "1"  }, "endGame": { "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "bet": "' . ($allbet * 100) . '", "symbols": { "line": [ ' . $curReels . ' ] }, "lines": { }, "totalWinnings": "' . ($_obf_0D1A2A083D150F1E35250A0E0B1B2D262A40055B210311 * 100) . '", "totalWinningsMoney": "' . ($_obf_0D1A2A083D150F1E35250A0E0B1B2D262A40055B210311 * 100) . '", "totalMultiplier": "1", "bonusRequest": { }, ' . $_obf_0D1404392B17250B231E1E3D26223035172429311E0401 . ' }, "doubleWin": { "totalWinnings": "' . ($_obf_0D1A2A083D150F1E35250A0E0B1B2D262A40055B210311 * 100) . '", "totalWinningsMoney": "' . ($_obf_0D1A2A083D150F1E35250A0E0B1B2D262A40055B210311 * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
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
