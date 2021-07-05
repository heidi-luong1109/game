<?php 
namespace VanguardLTE\Games\GoldenTourPT
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
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = json_decode(trim(file_get_contents('php://input')), true);
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['umid']) ) 
            {
                $umid = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['umid'];
                if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) ) 
                {
                    $umid = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'];
                }
            }
            else
            {
                if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) ) 
                {
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"ID":18}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                }
                $umid = 0;
            }
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == 40480 && $slotSettings->GetGameData('GoldenTourPTBonusType') >= 0 && $slotSettings->GetGameData('GoldenTourPTBonusType') <= 2 ) 
            {
                $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422 = [
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    1, 
                    2, 
                    3, 
                    4, 
                    5, 
                    1, 
                    2, 
                    3, 
                    4, 
                    5, 
                    6, 
                    1, 
                    2, 
                    3, 
                    4, 
                    5, 
                    6, 
                    7, 
                    1, 
                    2, 
                    3, 
                    4, 
                    5, 
                    6, 
                    7, 
                    8, 
                    1, 
                    2, 
                    3, 
                    4, 
                    5, 
                    6, 
                    7, 
                    8, 
                    9, 
                    1, 
                    2, 
                    3, 
                    4, 
                    5, 
                    6, 
                    7, 
                    8, 
                    9, 
                    10, 
                    15, 
                    20, 
                    25, 
                    50
                ];
                $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                for( $i = 0; $i <= 1000; $i++ ) 
                {
                    shuffle($_obf_0D17043C1A14092619031126041E0D16310D0B0A163422);
                    $win = $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[0] * $slotSettings->GetGameData('GoldenTourPTBetline');
                    if( $win <= $bank ) 
                    {
                        break;
                    }
                }
                $_obf_0D3E14320C0832063C5B1A181D0D2E013C0A1031333222 = '';
                $_obf_0D0A3D5B26140B2107302C220E033C2B15312325062532 = false;
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bonusType'] == 0 && $slotSettings->GetGameData('GoldenTourPTBonusType') == 0 ) 
                {
                    $_obf_0D1E083527261A193C3E082E330F0B3B08253D31111711 = [
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[1], 
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[2], 
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[3], 
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[4]
                    ];
                    if( $slotSettings->GetGameData('GoldenTourPTBonusFirstWin') != -1 ) 
                    {
                        $_obf_0D1E083527261A193C3E082E330F0B3B08253D31111711[$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bonusIndex']] = $slotSettings->GetGameData('GoldenTourPTBonusFirstWin');
                    }
                    else
                    {
                        $_obf_0D0A3D5B26140B2107302C220E033C2B15312325062532 = true;
                        $slotSettings->SetGameData('GoldenTourPTTotalBonusWin', $slotSettings->GetGameData('GoldenTourPTTotalBonusWin') + $win);
                        $slotSettings->SetGameData('GoldenTourPTBonusFirstWin', $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[0]);
                        $_obf_0D1E083527261A193C3E082E330F0B3B08253D31111711[$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bonusIndex']] = $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[0];
                    }
                }
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bonusType'] == 1 && $slotSettings->GetGameData('GoldenTourPTBonusType') == 1 ) 
                {
                    $_obf_0D1E083527261A193C3E082E330F0B3B08253D31111711 = [
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[1], 
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[2], 
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[3], 
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[4], 
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[5], 
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[6], 
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[7], 
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[8], 
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[9]
                    ];
                    if( $slotSettings->GetGameData('GoldenTourPTBonusSecondWin') != -1 ) 
                    {
                        $_obf_0D1E083527261A193C3E082E330F0B3B08253D31111711[$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bonusIndex']] = $slotSettings->GetGameData('GoldenTourPTBonusSecondWin');
                    }
                    else
                    {
                        $_obf_0D0A3D5B26140B2107302C220E033C2B15312325062532 = true;
                        $slotSettings->SetGameData('GoldenTourPTTotalBonusWin', $slotSettings->GetGameData('GoldenTourPTTotalBonusWin') + $win);
                        $slotSettings->SetGameData('GoldenTourPTBonusSecondWin', $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[0]);
                        $_obf_0D1E083527261A193C3E082E330F0B3B08253D31111711[$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bonusIndex']] = $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[0];
                    }
                }
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bonusType'] == 2 && $slotSettings->GetGameData('GoldenTourPTBonusType') == 2 ) 
                {
                    $_obf_0D1E083527261A193C3E082E330F0B3B08253D31111711 = [
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[1], 
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[2], 
                        $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[3]
                    ];
                    $_obf_0D1E083527261A193C3E082E330F0B3B08253D31111711[$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bonusIndex']] = $_obf_0D17043C1A14092619031126041E0D16310D0B0A163422[0];
                    $slotSettings->SetGameData('GoldenTourPTTotalBonusWin', $slotSettings->GetGameData('GoldenTourPTTotalBonusWin') + $win);
                    $slotSettings->SetGameData('GoldenTourPTBonusSecondWin', -1);
                    $slotSettings->SetGameData('GoldenTourPTBonusFirstWin', -1);
                    if( $slotSettings->GetGameData('GoldenTourPTTotalBonusWin') > 0 ) 
                    {
                        $slotSettings->SetBalance($slotSettings->GetGameData('GoldenTourPTTotalBonusWin'));
                    }
                }
                if( $win > 0 ) 
                {
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $win);
                }
                if( $slotSettings->GetGameData('GoldenTourPTBonusFirstWin') != -1 ) 
                {
                    $_obf_0D3E14320C0832063C5B1A181D0D2E013C0A1031333222 .= (',"BonusFirstWin":' . $slotSettings->GetGameData('GoldenTourPTBonusFirstWin') . '');
                }
                if( $slotSettings->GetGameData('GoldenTourPTBonusSecondWin') != -1 ) 
                {
                    $_obf_0D3E14320C0832063C5B1A181D0D2E013C0A1031333222 .= (',"BonusSecondWin":' . $slotSettings->GetGameData('GoldenTourPTBonusSecondWin') . '');
                }
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"bonusValues":[' . implode(',', $_obf_0D1E083527261A193C3E082E330F0B3B08253D31111711) . ']},"ID":40481}';
                if( $_obf_0D0A3D5B26140B2107302C220E033C2B15312325062532 || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bonusType'] == 2 ) 
                {
                    $response = '{"responseEvent":"spin","responseType":"bonus","serverResponse":{"TotalBonusWin":' . $slotSettings->GetGameData('GoldenTourPTTotalBonusWin') . '' . $_obf_0D3E14320C0832063C5B1A181D0D2E013C0A1031333222 . ',"bonusType":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bonusType'] . ',"linesArr":[1,1,1,1,1],"slotLines":5,"slotBet":' . $slotSettings->GetGameData('GoldenTourPTBetline') . ',"totalFreeGames":' . $slotSettings->GetGameData('GoldenTourPTFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('GoldenTourPTCurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData('GoldenTourPTBonusWin') . ',"freeStartWin":' . $slotSettings->GetGameData('GoldenTourPTFreeStartWin') . ',"totalWin":' . $win . ',"winLines":[],"bonusInfo":"","Jackpots":"","reelsSymbols":""}}';
                    $_obf_0D2F0913062F332227273C120240112F0B2132271B2622 = 0;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bonusType'] == 2 ) 
                    {
                        $_obf_0D2F0913062F332227273C120240112F0B2132271B2622 = $slotSettings->GetGameData('GoldenTourPTTotalBonusWin');
                    }
                    $slotSettings->SaveLogReport($response, $slotSettings->GetGameData('GoldenTourPTBetline'), 1, $_obf_0D2F0913062F332227273C120240112F0B2132271B2622, 'BG');
                }
                $slotSettings->SetGameData('GoldenTourPTBonusType', $slotSettings->GetGameData('GoldenTourPTBonusType') + 1);
            }
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType']) ) 
            {
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'regular' ) 
                {
                    $umid = '0';
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    $bonusMpl = 1;
                    $slotSettings->SetGameData('GoldenTourPTBonusWin', 0);
                    $slotSettings->SetGameData('GoldenTourPTFreeGames', 0);
                    $slotSettings->SetGameData('GoldenTourPTCurrentFreeGame', 0);
                    $slotSettings->SetGameData('GoldenTourPTTotalWin', 0);
                    $slotSettings->SetGameData('GoldenTourPTFreeBalance', 0);
                    $slotSettings->SetGameData('GoldenTourPTFreeStartWin', 0);
                    $slotSettings->SetGameData('GoldenTourPTTotalBonusWin', 0);
                    $slotSettings->SetGameData('GoldenTourPTBonusSecondWin', -1);
                    $slotSettings->SetGameData('GoldenTourPTBonusFirstWin', -1);
                }
                else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'free' ) 
                {
                    $umid = '0';
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                    $slotSettings->SetGameData('GoldenTourPTCurrentFreeGame', $slotSettings->GetGameData('GoldenTourPTCurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->slotFreeMpl;
                }
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
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / 100;
                for( $i = 0; $i < count($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines']); $i++ ) 
                {
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines'][$i] > 0 ) 
                    {
                        $lines = $i + 1;
                    }
                    else
                    {
                        break;
                    }
                }
                $betLine = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / $lines;
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'respin' ) 
                {
                    if( $lines <= 0 || $betLine <= 0.0001 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetBalance() < ($lines * $betLine) ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid balance"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                        exit( $response );
                    }
                }
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                {
                    if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    }
                    $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $slotSettings->UpdateJackpots($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet']);
                    $slotSettings->SetBalance(-1 * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                }
                $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'], $lines);
                $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
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
                        0
                    ];
                    $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011 = [
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
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
                    $wild = ['0'];
                    $scatter = [
                        '8', 
                        '9', 
                        '10'
                    ];
                    $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    for( $k = 0; $k < $lines; $k++ ) 
                    {
                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '';
                        for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                        {
                            $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = $slotSettings->SymbolGame[$j];
                            if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $scatter || !isset($slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132]) ) 
                            {
                            }
                            else
                            {
                                if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 > 2 ) 
                                {
                                    $wild = [];
                                }
                                else
                                {
                                    $wild = ['0'];
                                }
                                $s = [];
                                $s[0] = $reels['reel1'][$linesId[$k][0] - 1];
                                $s[1] = $reels['reel2'][$linesId[$k][1] - 1];
                                $s[2] = $reels['reel3'][$linesId[$k][2] - 1];
                                $s[3] = $reels['reel4'][$linesId[$k][3] - 1];
                                $s[4] = $reels['reel5'][$linesId[$k][4] - 1];
                                if( $s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild) ) 
                                {
                                    $mpl = 1;
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][1] * $betLine * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":1,"Line":' . $k . ',"Win":' . $cWins[$k] . ',"stepWin":' . ($cWins[$k] + $totalWin + $slotSettings->GetGameData('GoldenTourPTBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":["none","none"],"winReel3":["none","none"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                    }
                                }
                                if( $s[4] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[4], $wild) ) 
                                {
                                    $mpl = 1;
                                    $_obf_0D1A321903103534161A3E082D09312C212C19262C2822 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][1] * $betLine * $mpl * $bonusMpl;
                                    if( $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] < $_obf_0D1A321903103534161A3E082D09312C212C19262C2822 ) 
                                    {
                                        $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] = $_obf_0D1A321903103534161A3E082D09312C212C19262C2822;
                                        $_obf_0D11160A241933040412293F080D15240E1B3D03353B32 = '{"Count":1,"Line":' . $k . ',"Win":' . $cWins[$k] . ',"stepWin":' . ($cWins[$k] + $totalWin + $slotSettings->GetGameData('GoldenTourPTBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":["none","none"],"winReel3":["none","none"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                    }
                                }
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
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][2] * $betLine * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":2,"Line":' . $k . ',"Win":' . $cWins[$k] . ',"stepWin":' . ($cWins[$k] + $totalWin + $slotSettings->GetGameData('GoldenTourPTBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":["none","none"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                    }
                                }
                                if( ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) && ($s[4] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[4], $wild)) ) 
                                {
                                    $mpl = 1;
                                    if( in_array($s[3], $wild) && in_array($s[4], $wild) ) 
                                    {
                                        $mpl = 1;
                                    }
                                    else if( in_array($s[3], $wild) || in_array($s[4], $wild) ) 
                                    {
                                        $mpl = $slotSettings->slotWildMpl;
                                    }
                                    $_obf_0D1A321903103534161A3E082D09312C212C19262C2822 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][2] * $betLine * $mpl * $bonusMpl;
                                    if( $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] < $_obf_0D1A321903103534161A3E082D09312C212C19262C2822 ) 
                                    {
                                        $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] = $_obf_0D1A321903103534161A3E082D09312C212C19262C2822;
                                        $_obf_0D11160A241933040412293F080D15240E1B3D03353B32 = '{"Count":2,"Line":' . $k . ',"Win":' . $cWins[$k] . ',"stepWin":' . ($cWins[$k] + $totalWin + $slotSettings->GetGameData('GoldenTourPTBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":["none","none"],"winReel4":["none","none"],"winReel5":["none","none"]}';
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
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $betLine * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":3,"Line":' . $k . ',"Win":' . $cWins[$k] . ',"stepWin":' . ($cWins[$k] + $totalWin + $slotSettings->GetGameData('GoldenTourPTBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":[' . ($linesId[$k][2] - 1) . ',"' . $s[2] . '"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                    }
                                }
                                if( ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) && ($s[4] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[4], $wild)) ) 
                                {
                                    $mpl = 1;
                                    if( in_array($s[2], $wild) && in_array($s[3], $wild) && in_array($s[4], $wild) ) 
                                    {
                                        $mpl = 1;
                                    }
                                    else if( in_array($s[2], $wild) || in_array($s[3], $wild) || in_array($s[4], $wild) ) 
                                    {
                                        $mpl = $slotSettings->slotWildMpl;
                                    }
                                    $_obf_0D1A321903103534161A3E082D09312C212C19262C2822 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $betLine * $mpl * $bonusMpl;
                                    if( $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] < $_obf_0D1A321903103534161A3E082D09312C212C19262C2822 ) 
                                    {
                                        $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] = $_obf_0D1A321903103534161A3E082D09312C212C19262C2822;
                                        $_obf_0D11160A241933040412293F080D15240E1B3D03353B32 = '{"Count":3,"Line":' . $k . ',"Win":' . $cWins[$k] . ',"stepWin":' . ($cWins[$k] + $totalWin + $slotSettings->GetGameData('GoldenTourPTBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":[' . ($linesId[$k][2] - 1) . ',"' . $s[2] . '"],"winReel4":["none","none"],"winReel5":["none","none"]}';
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
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $betLine * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":4,"Line":' . $k . ',"Win":' . $cWins[$k] . ',"stepWin":' . ($cWins[$k] + $totalWin + $slotSettings->GetGameData('GoldenTourPTBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":[' . ($linesId[$k][2] - 1) . ',"' . $s[2] . '"],"winReel4":[' . ($linesId[$k][3] - 1) . ',"' . $s[3] . '"],"winReel5":["none","none"]}';
                                    }
                                }
                                if( ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) && ($s[4] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[4], $wild)) ) 
                                {
                                    $mpl = 1;
                                    if( in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) && in_array($s[4], $wild) ) 
                                    {
                                        $mpl = 1;
                                    }
                                    else if( in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) || in_array($s[4], $wild) ) 
                                    {
                                        $mpl = $slotSettings->slotWildMpl;
                                    }
                                    $_obf_0D1A321903103534161A3E082D09312C212C19262C2822 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $betLine * $mpl * $bonusMpl;
                                    if( $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] < $_obf_0D1A321903103534161A3E082D09312C212C19262C2822 ) 
                                    {
                                        $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] = $_obf_0D1A321903103534161A3E082D09312C212C19262C2822;
                                        $_obf_0D11160A241933040412293F080D15240E1B3D03353B32 = '{"Count":4,"Line":' . $k . ',"Win":' . $cWins[$k] . ',"stepWin":' . ($cWins[$k] + $totalWin + $slotSettings->GetGameData('GoldenTourPTBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":[' . ($linesId[$k][2] - 1) . ',"' . $s[2] . '"],"winReel4":[' . ($linesId[$k][3] - 1) . ',"' . $s[3] . '"],"winReel5":["none","none"]}';
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
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $betLine * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":5,"Line":' . $k . ',"Win":' . $cWins[$k] . ',"stepWin":' . ($cWins[$k] + $totalWin + $slotSettings->GetGameData('GoldenTourPTBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":[' . ($linesId[$k][2] - 1) . ',"' . $s[2] . '"],"winReel4":[' . ($linesId[$k][3] - 1) . ',"' . $s[3] . '"],"winReel5":[' . ($linesId[$k][4] - 1) . ',"' . $s[4] . '"]}';
                                    }
                                }
                            }
                        }
                        if( $cWins[$k] > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                        {
                            array_push($lineWins, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                            $totalWin += $cWins[$k];
                        }
                        if( $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] > 0 && $_obf_0D11160A241933040412293F080D15240E1B3D03353B32 != '' ) 
                        {
                            array_push($lineWins, $_obf_0D11160A241933040412293F080D15240E1B3D03353B32);
                            $totalWin += $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k];
                        }
                    }
                    $scattersWin = 0;
                    $scattersStr = '{';
                    $scattersCount = [
                        0, 
                        0, 
                        0
                    ];
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 3; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                        {
                            if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == $scatter[0] ) 
                            {
                                $scattersCount[0]++;
                            }
                            if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == $scatter[1] ) 
                            {
                                $scattersCount[1]++;
                            }
                            if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == $scatter[2] ) 
                            {
                                $scattersCount[2]++;
                            }
                        }
                    }
                    if( $scattersCount >= 3 && $slotSettings->slotBonus ) 
                    {
                        $scattersStr .= '"scattersType":"bonus",';
                    }
                    else if( $scattersWin > 0 ) 
                    {
                        $scattersStr .= '"scattersType":"win",';
                    }
                    else
                    {
                        $scattersStr .= '"scattersType":"none",';
                    }
                    $scattersStr .= ('"scattersWin":' . $scattersWin . '}');
                    $totalWin += $scattersWin;
                    if( $i > 1000 ) 
                    {
                        $winType = 'none';
                    }
                    if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] * rand(2, 5)) ) 
                    {
                    }
                    else if( !$slotSettings->increaseRTP && $winType == 'win' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] < $totalWin ) 
                    {
                    }
                    else
                    {
                        if( $i > 1500 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( ($scattersCount[0] >= 3 || $scattersCount[1] >= 3 || $scattersCount[2] >= 3) && $winType != 'bonus' ) 
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
                    $slotSettings->SetGameData('GoldenTourPTBonusWin', $slotSettings->GetGameData('GoldenTourPTBonusWin') + $totalWin);
                    $slotSettings->SetGameData('GoldenTourPTTotalWin', $totalWin);
                }
                else
                {
                    $slotSettings->SetGameData('GoldenTourPTTotalWin', $totalWin);
                }
                if( $scattersCount[0] >= 3 || $scattersCount[1] >= 3 || $scattersCount[2] >= 3 ) 
                {
                    $slotSettings->SetGameData('GoldenTourPTBonusType', 0);
                    $slotSettings->SetGameData('GoldenTourPTBetline', $betLine);
                    $slotSettings->SetGameData('GoldenTourPTTotalBonusWin', 0);
                }
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"results":[' . implode(',', $reels['rp']) . '],"windowId":"Adbmao"},"ID":40022,"umid":35}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"linesArr":[' . implode(',', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines']) . '],"slotLines":' . $lines . ',"slotBet":' . $betLine . ',"totalFreeGames":' . $slotSettings->GetGameData('GoldenTourPTFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('GoldenTourPTCurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData('GoldenTourPTBonusWin') . ',"freeStartWin":' . $slotSettings->GetGameData('GoldenTourPTFreeStartWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"bonusInfo":' . $scattersStr . ',"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                $slotSettings->SaveLogReport($response, $betLine, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
            }
            switch( $umid ) 
            {
                case '31031':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"urlList":[{"urlType":"mobile_login","url":"https://login.loc/register","priority":1},{"urlType":"mobile_support","url":"https://ww2.loc/support","priority":1},{"urlType":"playerprofile","url":"","priority":1},{"urlType":"playerprofile","url":"","priority":10},{"urlType":"gambling_commission","url":"","priority":1},{"urlType":"cashier","url":"","priority":1},{"urlType":"cashier","url":"","priority":1}]},"ID":100}';
                    break;
                case '10001':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40083,"umid":3}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40083,"umid":4}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":13218,"params":["0","null"]},"ID":50001,"umid":5}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"token":{"secretKey":"","currency":"USD","balance":0,"loginTime":""},"ID":10002,"umid":7}';
                    break;
                case '40294':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"nicknameInfo":{"nickname":""},"ID":10022,"umid":8}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":10713,"params":["0","ba","bj","ct","gc","grel","hb","po","ro","sc","tr"]},"ID":50001,"umid":9}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":11666,"params":["0","0","0"]},"ID":50001,"umid":11}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":13981,"params":["0","1"]},"ID":50001,"umid":12}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":14080,"params":["0","0"]},"ID":50001,"umid":14}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"keyValueCount":5,"elementsPerKey":1,"params":["10","1","11","500","12","1","13","0","14","0"]},"ID":40716,"umid":15}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40083,"umid":16}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"balanceInfo":{"clientType":"casino","totalBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"currency":"' . $slotSettings->slotCurrency . '","balanceChange":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"ID":10006,"umid":17}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{},"ID":40292,"umid":18}';
                    break;
                case '10010':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"urls":{"casino-cashier-myaccount":[],"regulation_pt_self_exclusion":[],"link_legal_aams":[],"regulation_pt_player_protection":[],"mobile_cashier":[],"mobile_bank":[],"mobile_bonus_terms":[],"mobile_help":[],"link_responsible":[],"cashier":[{"url":"","priority":1},{"url":"","priority":1}],"gambling_commission":[{"url":"","priority":1},{"url":"","priority":1}],"desktop_help":[],"chat_token":[],"mobile_login_error":[],"mobile_error":[],"mobile_login":[{"url":"","priority":1}],"playerprofile":[{"url":"","priority":1},{"url":"","priority":10}],"link_legal_half":[],"ngmdesktop_quick_deposit":[],"external_login_form":[],"mobile_main_promotions":[],"mobile_lobby":[],"mobile_promotion":[],{"url":"","priority":1},{"url":"","priority":10}],"mobile_withdraw":[],"mobile_funds_trans":[],"mobile_quick_deposit":[],"mobile_history":[],"mobile_deposit_limit":[],"minigames_help":[],"link_legal_18":[],"mobile_responsible":[],"mobile_share":[],"mobile_lobby_error":[],"mobile_mobile_comp_points":[],"mobile_support":[{"url":"","priority":1}],"mobile_chat":[],"mobile_logout":[],"mobile_deposit":[],"invite_friend":[]}},"ID":10011,"umid":19}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"brokenGames":[],"windowId":"SuJLru"},"ID":40037,"umid":20}';
                    break;
                case '40066':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    for( $i = 0; $i < count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] * 100;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"funNoticeGames":0,"funNoticePayouts":0,"gameGroup":"gos","minBet":0,"maxBet":0,"minPosBet":0,"maxPosBet":50000,"coinSizes":[' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . ']},"ID":40025,"umid":21}';
                    break;
                case '40036':
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    $slotSettings->SetGameData('GoldenTourPTBonusSecondWin', -1);
                    $slotSettings->SetGameData('GoldenTourPTBonusFirstWin', -1);
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData($slotSettings->slotId . 'brokenGames', '');
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $lastEvent->serverResponse->freeStartWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $slotSettings->SetGameData($slotSettings->slotId . 'LinesArr', $lastEvent->serverResponse->linesArr);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $lastEvent->serverResponse->slotBet);
                        if( $lastEvent->responseType == 'bonus' && $lastEvent->serverResponse->bonusType != 2 ) 
                        {
                            $slotSettings->SetGameData('GoldenTourPTBonusType', 0);
                            $slotSettings->SetGameData('GoldenTourPTBetline', $lastEvent->serverResponse->slotBet);
                            $slotSettings->SetGameData('GoldenTourPTTotalBonusWin', $lastEvent->serverResponse->TotalBonusWin);
                            if( isset($lastEvent->serverResponse->BonusFirstWin) ) 
                            {
                                $slotSettings->SetGameData('GoldenTourPTBonusFirstWin', $lastEvent->serverResponse->BonusFirstWin);
                            }
                            if( isset($lastEvent->serverResponse->BonusSecondWin) ) 
                            {
                                $slotSettings->SetGameData('GoldenTourPTBonusSecondWin', $lastEvent->serverResponse->BonusSecondWin);
                            }
                            $slotSettings->SetGameData($slotSettings->slotId . 'brokenGames', 'gos');
                        }
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"brokenGames":["' . $slotSettings->GetGameData($slotSettings->slotId . 'brokenGames') . '"],"windowId":"SuJLru"},"ID":40037,"umid":22}';
                    break;
                case '40020':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":1,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"windowId":"SuJLru"},"ID":40026,"umid":28}';
                    break;
                case '40030':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":1,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"windowId":"SuJLru"},"ID":40026,"umid":28}';
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'brokenGames') != '' ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"bonusinfo":{"firstPrizes":[20,30,40,50],"secondPrizes":[20,30,40],"indexOfTheFirstPrizeTaken":0},"coins":1,"coinage":' . ($slotSettings->GetGameData('GoldenTourPTBetline') * 100) . ',"startBonus":0},"windowId":"MT24g5","ID":40483,"umid":29}';
                    }
                    break;
                case '48300':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"balanceInfo":{"clientType":"casino","totalBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"currency":"' . $slotSettings->slotCurrency . '","balanceChange":0},"ID":10006,"umid":30}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"waitingLogins":[],"waitingAlerts":[],"waitingDialogs":[],"waitingDialogMessages":[],"waitingToasterMessages":[]},"ID":48301,"umid":31}';
                    break;
            }
            $response = implode('------', $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01);
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
