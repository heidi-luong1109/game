<?php 
namespace VanguardLTE\Games\HotGemsPT
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
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) && ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '46311' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '46302') ) 
            {
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '46302' ) 
                {
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['savedStates'] = [];
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['savedStates'][0] = [];
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['savedStates'][0]['attr21'] = 1;
                }
                if( $slotSettings->GetGameData('HotGemsPTCurrentFreeGame') <= $slotSettings->GetGameData('HotGemsPTFreeGames') && $slotSettings->GetGameData('HotGemsPTFreeGames') > 0 && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['savedStates'][0]['attr21'] > 0 ) 
                {
                    $_obf_0D2813390912262B102326025B34051621182F31041832 = $slotSettings->GetGameData('HotGemsPTCurrentFreeGame');
                    $_obf_0D131D5C261C392D093F121D1F2E13191812150D231232 = $slotSettings->GetGameData('HotGemsPTFreeSpins');
                    $_obf_0D222C3C342D2C31305B091C0A1C10250A19140B2B2811 = $slotSettings->GetGameData('HotGemsPTFreeLogs');
                    $_obf_0D390225301D2E21373038281039131A192C011A3F0632 = json_decode(trim($_obf_0D131D5C261C392D093F121D1F2E13191812150D231232[$_obf_0D2813390912262B102326025B34051621182F31041832]), true);
                    $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11 = json_decode(trim($_obf_0D222C3C342D2C31305B091C0A1C10250A19140B2B2811[$_obf_0D2813390912262B102326025B34051621182F31041832]), true);
                    $totalWin = $_obf_0D390225301D2E21373038281039131A192C011A3F0632['data']['currentWin'];
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBalance($totalWin);
                    }
                    $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11['serverResponse']['freeSeq'] = $_obf_0D131D5C261C392D093F121D1F2E13191812150D231232;
                    $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11['serverResponse']['freeLogSeq'] = $_obf_0D222C3C342D2C31305B091C0A1C10250A19140B2B2811;
                    $slotSettings->SaveLogReport(json_encode($_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11), $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11['serverResponse']['slotLines'], $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11['serverResponse']['slotBet'], $totalWin, 'freespin');
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '46302' ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::' . $_obf_0D131D5C261C392D093F121D1F2E13191812150D231232[$slotSettings->GetGameData('HotGemsPTCurrentFreeGame')];
                    }
                    $slotSettings->SetGameData('HotGemsPTCurrentFreeGame', $slotSettings->GetGameData('HotGemsPTCurrentFreeGame') + 1);
                }
            }
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '40029' ) 
            {
                $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 = 15;
                $bonusMpl = 1;
                $betLine = $slotSettings->GetGameData('HotGemsPTBet');
                $lines = 25;
                $_obf_0D5B0B29062722350A081C02112A2808251D120E2E0C01 = 0;
                $_obf_0D390225301D2E21373038281039131A192C011A3F0632 = [];
                $_obf_0D1116233529011F0C293C2D011C113C061E381B341411 = [];
                for( $s = 1; $s <= $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411; $s++ ) 
                {
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
                        3, 
                        3
                    ];
                    $linesId[6] = [
                        3, 
                        3, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[7] = [
                        2, 
                        1, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[8] = [
                        2, 
                        3, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[9] = [
                        2, 
                        1, 
                        1, 
                        1, 
                        1
                    ];
                    $linesId[10] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[11] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[12] = [
                        3, 
                        2, 
                        2, 
                        2, 
                        2
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
                        1, 
                        3, 
                        1
                    ];
                    $linesId[20] = [
                        3, 
                        1, 
                        3, 
                        1, 
                        3
                    ];
                    $linesId[21] = [
                        2, 
                        1, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[22] = [
                        2, 
                        3, 
                        1, 
                        1, 
                        1
                    ];
                    $linesId[23] = [
                        1, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[24] = [
                        3, 
                        1, 
                        1, 
                        1, 
                        2
                    ];
                    $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings('freespin', $betLine * $lines, $lines);
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
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
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
                        $scatter = '13';
                        $reels = $slotSettings->GetReelStrips($winType, 'freespin');
                        $_obf_0D37340F0B1133322D3D3437012B1923350D040C380D22 = $reels;
                        $_obf_0D1C301838081913090C0C1A2E0F010F3C3D2E33310D01 = '';
                        $mpl = 1;
                        $scattersCount = 0;
                        for( $_obf_0D0B055C5B221038162F310A2A251D3D235B1B133B2901 = 1; $_obf_0D0B055C5B221038162F310A2A251D3D235B1B133B2901 <= 15; $_obf_0D0B055C5B221038162F310A2A251D3D235B1B133B2901++ ) 
                        {
                            $_obf_0D1F3C315C2D083C1E0237362212360301171F11010811 = $slotSettings->GetReelsWin($reels, $lines, $betLine, $linesId, $cWins, $mpl);
                            $totalWin += $_obf_0D1F3C315C2D083C1E0237362212360301171F11010811['totalWin'];
                            if( $_obf_0D1F3C315C2D083C1E0237362212360301171F11010811['bonusSym'] >= 3 ) 
                            {
                                $scattersCount = $_obf_0D1F3C315C2D083C1E0237362212360301171F11010811['bonusSym'];
                            }
                            if( $_obf_0D1F3C315C2D083C1E0237362212360301171F11010811['totalWin'] <= 0 && $_obf_0D1F3C315C2D083C1E0237362212360301171F11010811['bonusSym'] < 3 ) 
                            {
                                break;
                            }
                            $reels = $slotSettings->OffsetReels($_obf_0D1F3C315C2D083C1E0237362212360301171F11010811['reels'], 'freespin');
                            $mpl++;
                        }
                        $scattersWin = 0;
                        $scattersStr = '{';
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
                        if( $i > 1500 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"freespin","serverResponse":"Bad Reel Strip"}';
                            $slotSettings->SaveLogReport($response, 0, 0, 0, '');
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
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                        $_obf_0D5B0B29062722350A081C02112A2808251D120E2E0C01 += $totalWin;
                    }
                    $reels = $_obf_0D37340F0B1133322D3D3437012B1923350D040C380D22;
                    $slotSettings->SetGameData('HotGemsPTBonusWin', $slotSettings->GetGameData('HotGemsPTBonusWin') + $totalWin);
                    $_obf_0D390225301D2E21373038281039131A192C011A3F0632[] = '{"data":{"currentWin":' . $totalWin . ',"drawState":{"event":[{"seq":0,"id":' . $reels['rp'][0] . ',"type":"24:A"},{"seq":1,"id":' . $reels['rp'][1] . ',"type":"4:Q"},{"seq":2,"id":' . $reels['rp'][2] . ',"type":"23:T"},{"seq":3,"id":' . $reels['rp'][3] . ',"type":"32:Q"},{"seq":4,"id":' . $reels['rp'][4] . ',"type":"4:A"}],"gameStages":[{"stage":[{"display":"J,A,J,W,J;A,Q,T,Q,A;N,L,K,K,D","multiplier":1,"stage":1}],"spins":0,"stages":1,"wCapMaxWin":1000000.0}],"bet":[{"toPayout":0.25,"pick":"L25","seq":0,"stake":0.25,"type":"line","won":"false"}],"drawId":0,"seed":389802986,"state":"settling"},"gameId":2501019450},"ID":46303,"umid":49}';
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1116233529011F0C293C2D011C113C061E381B341411[] = '{"responseEvent":"spin","responseType":"freespin","serverResponse":{"bonusMpl":' . $bonusMpl . ',"slotLines":' . $lines . ',"slotBet":' . $betLine . ',"totalFreeGames":' . $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 . ',"currentFreeGames":' . $s . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData('HotGemsPTBonusWin') . ',"freeStartWin":' . $slotSettings->GetGameData('HotGemsPTFreeStartWin') . ',"totalWin":' . $totalWin . ',"winLines":[],"bonusInfo":"","Jackpots":"","reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                }
                $slotSettings->SetGameData('HotGemsPTFreeSpins', $_obf_0D390225301D2E21373038281039131A192C011A3F0632);
                $slotSettings->SetGameData('HotGemsPTFreeLogs', $_obf_0D1116233529011F0C293C2D011C113C061E381B341411);
                $slotSettings->SetGameData('HotGemsPTFreeGames', $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411);
                $slotSettings->SetGameData('HotGemsPTCurrentFreeGame', 0);
                $_obf_0D262203355C053823371B100325295B12151B3F095C22 = implode(',', $_obf_0D390225301D2E21373038281039131A192C011A3F0632);
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"gameId":2543168908,"drawStates":[{"drawId":1,"feature":{"name":"bonus","details":{"bonusPayout":' . $slotSettings->GetGameData('HotGemsPTFreeStartWin') . ',"initialSpins":' . $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 . ',"multiplier":' . $bonusMpl . ',"spins":' . $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 . ',"totalPayout":' . $_obf_0D5B0B29062722350A081C02112A2808251D120E2E0C01 . '}}},' . $_obf_0D262203355C053823371B100325295B12151B3F095C22 . ']},"ID":47342,"umid":1951}';
            }
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '48880' ) 
            {
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] = 'regular';
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'regular' ) 
                {
                    $umid = '0';
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    $bonusMpl = 1;
                    $slotSettings->SetGameData('HotGemsPTBonusWin', 0);
                    $slotSettings->SetGameData('HotGemsPTFreeGames', 0);
                    $slotSettings->SetGameData('HotGemsPTCurrentFreeGame', 0);
                    $slotSettings->SetGameData('HotGemsPTTotalWin', 0);
                    $slotSettings->SetGameData('HotGemsPTFreeBalance', 0);
                    $slotSettings->SetGameData('HotGemsPTFreeStartWin', 0);
                }
                else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'free' ) 
                {
                    $umid = '0';
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                    $slotSettings->SetGameData('HotGemsPTCurrentFreeGame', $slotSettings->GetGameData('HotGemsPTCurrentFreeGame') + 1);
                    $bonusMpl = 1;
                }
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bets'][0]['stake'];
                $_obf_0D1E1D1E330423230F3B1A16370D031D333625295B2F32 = explode('L', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bets'][0]['pick']);
                $lines = (int)$_obf_0D1E1D1E330423230F3B1A16370D031D333625295B2F32[1];
                $betLine = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / $lines;
                $slotSettings->SetGameData('HotGemsPTBet', $betLine);
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'respin' ) 
                {
                    if( $lines <= 0 || $betLine <= 0.0001 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bet state"}';
                        $slotSettings->SaveLogReport($response, 0, 0, 0, '');
                    }
                    if( $slotSettings->GetBalance() < ($lines * $betLine) ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid balance"}';
                        $slotSettings->SaveLogReport($response, 0, 0, 0, '');
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                        $slotSettings->SaveLogReport($response, 0, 0, 0, '');
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
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' && $winType == 'bonus' ) 
                {
                    $winType = 'none';
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
                $linesId[5] = [
                    1, 
                    1, 
                    2, 
                    3, 
                    3
                ];
                $linesId[6] = [
                    3, 
                    3, 
                    2, 
                    1, 
                    1
                ];
                $linesId[7] = [
                    2, 
                    1, 
                    2, 
                    3, 
                    2
                ];
                $linesId[8] = [
                    2, 
                    3, 
                    2, 
                    1, 
                    2
                ];
                $linesId[9] = [
                    2, 
                    1, 
                    1, 
                    1, 
                    1
                ];
                $linesId[10] = [
                    2, 
                    3, 
                    3, 
                    3, 
                    3
                ];
                $linesId[11] = [
                    1, 
                    2, 
                    2, 
                    2, 
                    2
                ];
                $linesId[12] = [
                    3, 
                    2, 
                    2, 
                    2, 
                    2
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
                    1, 
                    3, 
                    1
                ];
                $linesId[20] = [
                    3, 
                    1, 
                    3, 
                    1, 
                    3
                ];
                $linesId[21] = [
                    2, 
                    1, 
                    3, 
                    3, 
                    3
                ];
                $linesId[22] = [
                    2, 
                    3, 
                    1, 
                    1, 
                    1
                ];
                $linesId[23] = [
                    1, 
                    3, 
                    3, 
                    3, 
                    2
                ];
                $linesId[24] = [
                    3, 
                    1, 
                    1, 
                    1, 
                    2
                ];
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
                        0
                    ];
                    $wild = ['0'];
                    $scatter = '13';
                    $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D37340F0B1133322D3D3437012B1923350D040C380D22 = $reels;
                    $_obf_0D1C301838081913090C0C1A2E0F010F3C3D2E33310D01 = '';
                    $mpl = 1;
                    $scattersCount = 0;
                    for( $_obf_0D0B055C5B221038162F310A2A251D3D235B1B133B2901 = 1; $_obf_0D0B055C5B221038162F310A2A251D3D235B1B133B2901 <= 15; $_obf_0D0B055C5B221038162F310A2A251D3D235B1B133B2901++ ) 
                    {
                        $_obf_0D1F3C315C2D083C1E0237362212360301171F11010811 = $slotSettings->GetReelsWin($reels, $lines, $betLine, $linesId, $cWins, $mpl);
                        $totalWin += $_obf_0D1F3C315C2D083C1E0237362212360301171F11010811['totalWin'];
                        if( $_obf_0D1F3C315C2D083C1E0237362212360301171F11010811['bonusSym'] >= 3 ) 
                        {
                            $scattersCount = $_obf_0D1F3C315C2D083C1E0237362212360301171F11010811['bonusSym'];
                        }
                        if( $_obf_0D1F3C315C2D083C1E0237362212360301171F11010811['totalWin'] <= 0 && $_obf_0D1F3C315C2D083C1E0237362212360301171F11010811['bonusSym'] < 3 ) 
                        {
                            break;
                        }
                        $reels = $slotSettings->OffsetReels($_obf_0D1F3C315C2D083C1E0237362212360301171F11010811['reels'], 'regular');
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                            $mpl++;
                        }
                    }
                    $scattersWin = 0;
                    $scattersStr = '{';
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
                            $slotSettings->SaveLogReport($response, 0, 0, 0, '');
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
                $reels = $_obf_0D37340F0B1133322D3D3437012B1923350D040C380D22;
                $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData('HotGemsPTBonusWin', $slotSettings->GetGameData('HotGemsPTBonusWin') + $totalWin);
                    $slotSettings->SetGameData('HotGemsPTTotalWin', $totalWin);
                }
                else
                {
                    $slotSettings->SetGameData('HotGemsPTTotalWin', $totalWin);
                }
                if( $scattersCount >= 3 ) 
                {
                    $slotSettings->SetGameData('HotGemsPTFreeStartWin', $totalWin);
                    $slotSettings->SetGameData('HotGemsPTBonusWin', 0);
                    $slotSettings->SetGameData('HotGemsPTFreeGames', 15);
                }
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"slotBet":' . $betLine . ',"gameId":2500966479,"drawId":0,"newBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"ID":46300,"umid":31}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"balanceInfo":{"clientType":"casino","totalBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"currency":"' . $slotSettings->slotCurrency . '","balanceChange":0},"ID":10006,"umid":31}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40083,"umid":32}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40083,"umid":33}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":1,"balanceInCents":0},"ID":40085}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":1,"balanceInCents":0},"ID":40083}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40085}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40083}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40085}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40083}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"currentWin":' . $totalWin . ',"drawState":{"event":[{"seq":0,"id":' . $reels['rp'][0] . ',"type":"24:A"},{"seq":1,"id":' . $reels['rp'][1] . ',"type":"4:Q"},{"seq":2,"id":' . $reels['rp'][2] . ',"type":"23:T"},{"seq":3,"id":' . $reels['rp'][3] . ',"type":"32:Q"},{"seq":4,"id":' . $reels['rp'][4] . ',"type":"4:A"}],"gameStages":[{"stage":[{"display":"J,A,J,W,J;A,Q,T,Q,A;N,L,K,K,D","multiplier":1,"stage":1}],"spins":0,"stages":1,"wCapMaxWin":1000000.0}],"bet":[{"toPayout":0.25,"pick":"L25","seq":0,"stake":0.25,"type":"line","won":"false"}],"drawId":0,"seed":389802986,"state":"settling"},"gameId":2501019450},"ID":46303,"umid":49}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{},"ID":46297,"umid":39}';
                $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"rStr":"' . $_obf_0D1C301838081913090C0C1A2E0F010F3C3D2E33310D01 . '","sc":' . $scattersCount . ',"slotLines":' . $lines . ',"slotBet":' . $betLine . ',"totalFreeGames":' . $slotSettings->GetGameData('HotGemsPTFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('HotGemsPTCurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData('HotGemsPTBonusWin') . ',"freeStartWin":' . $slotSettings->GetGameData('HotGemsPTFreeStartWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"bonusInfo":' . $scattersStr . ',"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
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
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"funNoticeGames":0,"funNoticePayouts":0,"gameGroup":"gts50","minBet":0,"maxBet":0,"minPosBet":0,"maxPosBet":50000,"coinSizes":[' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . ']},"ID":40025,"umid":21}';
                    break;
                case '40036':
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
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
                        if( isset($lastEvent->serverResponse->freeSeq) ) 
                        {
                            $slotSettings->SetGameData('HotGemsPTFreeSpins', $lastEvent->serverResponse->freeSeq);
                            $slotSettings->SetGameData('HotGemsPTFreeLogs', $lastEvent->serverResponse->freeLogSeq);
                            $slotSettings->SetGameData('HotGemsPTbonusMpl', $lastEvent->serverResponse->bonusMpl);
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $lastEvent->serverResponse->slotBet);
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'brokenGames', 'gts50');
                        }
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"brokenGames":["' . $slotSettings->GetGameData($slotSettings->slotId . 'brokenGames') . '"],"windowId":"SuJLru"},"ID":40037,"umid":22}';
                    break;
                case '46290':
                    $lastEvent = $slotSettings->GetHistory();
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'brokenGames') != '' ) 
                    {
                        $_obf_0D2410310726250E1A3F025B0F2101383038135B043C01 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeLogs');
                        $_obf_0D2813390912262B102326025B34051621182F31041832 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01 = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $_obf_0D1E051A151C401A322511360318291B1F052A310D3701 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeStartWin');
                        $totalWin = $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                        $drawId = 1;
                        $_obf_0D35180F3336321412285C3114313F09191E360E302201 = [];
                        $_obf_0D3F273315401A33392B2B3F24155C5B123F1033122B22 = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        for( $i = 0; $i <= 14; $i++ ) 
                        {
                            $vl = json_decode($_obf_0D2410310726250E1A3F025B0F2101383038135B043C01[$i], true);
                            $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $vl['serverResponse']['totalWin'];
                            $rp = $vl['serverResponse']['reelsSymbols']['rp'];
                            $_obf_0D35180F3336321412285C3114313F09191E360E302201[] = '{"event":[{"seq":0,"id":' . $rp[0] . ',"type":"29:Q"},{"seq":1,"id":' . $rp[1] . ',"type":"25:D"},{"seq":2,"id":' . $rp[2] . ',"type":"13:L"},{"seq":3,"id":' . $rp[3] . ',"type":"0:K"},{"seq":4,"id":' . $rp[4] . ',"type":"15:H"}],"gameStages":[{"stage":[{"winLine":[{"length":3,"line":10,"offsets":"5,1,2","payout":' . $_obf_0D0E141F34210C271834013D060623402816092A400E11 . ',"prize":"3Q"}],"display":"W,Q,Q,T,A;Q,D,L,K,H;J,J,A,N,J","multiplier":1,"stage":1}],"currentSpins":' . (15 - $_obf_0D3F273315401A33392B2B3F24155C5B123F1033122B22) . ',"runningTotal":' . ($totalWin + $_obf_0D1E051A151C401A322511360318291B1F052A310D3701) . ',"spins":15,"stages":1}],"drawId":' . $drawId . ',"seed":-2034361349,"state":"settling"}';
                            $drawId++;
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'brokenGames', '');
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"savedState":[{"seq":0,"attr21":"1"}],"history":{"game":{"savedState":[{"seq":0,"attr21":"8"}],"drawState":[{"event":[{"seq":0,"id":24,"type":"24:A"},{"seq":1,"id":18,"type":"18:J"},{"seq":2,"id":3,"type":"3:N"},{"seq":3,"id":30,"type":"30:T"},{"seq":4,"id":2,"type":"2:Q"}],"drawId":0}],"gameId":2483023545}},"drawState":[{"event":[{"seq":0,"id":2,"type":"2:Q"},{"seq":1,"id":19,"type":"19:T"},{"seq":2,"id":7,"type":"7:Z"},{"seq":3,"id":17,"type":"17:S"},{"seq":4,"id":32,"type":"32:F"}],"gameStages":[{"stage":[{"winLine":[{"length":3,"line":9,"offsets":"5,11,7","payout":0,"prize":"3Q"}],"display":"W,J,T,T,L;Q,T,Z,S,F;J,Q,F,J,J","multiplier":1,"stage":1},{"winLine":[{"length":2,"line":20,"offsets":"0,11","payout":0.00,"prize":"2T"},{"length":2,"line":24,"offsets":"0,11","payout":0,"prize":"2T"}],"scatter":{"length":2,"offsets":"1,8","payout":' . $_obf_0D1E051A151C401A322511360318291B1F052A310D3701 . '},"display":"T,S,H,T,L;W,J,T,S,F;J,T,F,J,J","multiplier":1,"stage":2},{"bonus":{"offsets":"0,9,12","spins":15},"display":"F,T,H,H,L;W,N,T,T,F;J,J,F,J,J","multiplier":1,"stage":3},{"winLine":[{"length":2,"line":4,"offsets":"0,6","payout":0.00,"prize":"2N"},{"length":2,"line":12,"offsets":"0,6","payout":0.00,"prize":"2N"},{"length":2,"line":14,"offsets":"0,6","payout":0.00,"prize":"2N"}],"display":"N,T,A,H,T;W,N,H,T,L;J,J,T,J,J","multiplier":1,"stage":4},{"display":"J,W,A,H,T;W,T,H,T,L;J,J,T,J,J","multiplier":1,"stage":5}],"currentSpins":0,"spins":15,"stages":5,"wCapMaxWin":1000000}],"bet":[{"payout":' . $totalWin . ',"pick":"L25","seq":0,"stake":' . ($slotSettings->GetGameData($slotSettings->slotId . 'Bet') * 25) . ',"type":"line","won":"true"}],"drawId":0,"seed":-2033607610,"state":"settling"},' . implode(',', $_obf_0D35180F3336321412285C3114313F09191E360E302201) . '],"gameId":2483023643,"nextDrawId":""},"ID":46291,"umid":29}';
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"history":{"game":{"savedState":[{"seq":0,"attr21":"null"}],"drawState":[],"gameId":2383768333}},"gameId":2478431530,"nextDrawId":"0"},"ID":46291,"umid":28}';
                    }
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
