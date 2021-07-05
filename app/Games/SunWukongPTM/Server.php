<?php 
namespace VanguardLTE\Games\SunWukongPTM
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
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '46108' ) 
            {
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['pick'] == '2' ) 
                {
                    $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 = 20;
                    $bonusMpl = 2;
                }
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['pick'] == '1' ) 
                {
                    $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 = 10;
                    $bonusMpl = 4;
                }
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['pick'] == '0' ) 
                {
                    $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 = 8;
                    $bonusMpl = 5;
                }
                $lines = $slotSettings->GetGameData('SunWukongPTMLines');
                $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 = $slotSettings->GetGameData('SunWukongPTMBet') / $lines;
                $_obf_0D5B0B29062722350A081C02112A2808251D120E2E0C01 = 0;
                $_obf_0D390225301D2E21373038281039131A192C011A3F0632 = [];
                $_obf_0D1116233529011F0C293C2D011C113C061E381B341411 = [];
                for( $s = 1; $s <= $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411; $s++ ) 
                {
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        $totalWin = 0;
                        $lineWins = [];
                        $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22 = ['0'];
                        $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22 = '12';
                        $reels = $slotSettings->GetReelStrips('', 'freespin');
                        $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $slotSettings->GetGameData('SunWukongPTMBet'));
                        $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                        $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[0] = [
                            2, 
                            2, 
                            2, 
                            2, 
                            2
                        ];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[1] = [
                            1, 
                            1, 
                            1, 
                            1, 
                            1
                        ];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[2] = [
                            3, 
                            3, 
                            3, 
                            3, 
                            3
                        ];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[3] = [
                            1, 
                            2, 
                            3, 
                            2, 
                            1
                        ];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[4] = [
                            3, 
                            2, 
                            1, 
                            2, 
                            3
                        ];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[5] = [
                            2, 
                            1, 
                            1, 
                            1, 
                            2
                        ];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[6] = [
                            2, 
                            3, 
                            3, 
                            3, 
                            2
                        ];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[7] = [
                            1, 
                            1, 
                            2, 
                            3, 
                            3
                        ];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[8] = [
                            3, 
                            3, 
                            2, 
                            1, 
                            1
                        ];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[9] = [
                            2, 
                            3, 
                            2, 
                            1, 
                            2
                        ];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[10] = [
                            2, 
                            1, 
                            2, 
                            3, 
                            2
                        ];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[11] = [
                            1, 
                            2, 
                            2, 
                            2, 
                            1
                        ];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[12] = [
                            3, 
                            2, 
                            2, 
                            2, 
                            3
                        ];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[13] = [
                            1, 
                            2, 
                            1, 
                            2, 
                            1
                        ];
                        $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[14] = [
                            3, 
                            2, 
                            3, 
                            2, 
                            3
                        ];
                        $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211 = $slotSettings->GetSpinWin($reels, $lines, $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832, $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901, $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22, $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22, $bonusMpl);
                        $totalWin = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['totalWin'];
                        $lineWins = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['lineWins'];
                        $scattersWin = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['scattersWin'];
                        $scattersCount = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['scattersCount'];
                        $scattersStr = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['scattersStr'];
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
                            if( $scattersCount >= 2 && $winType != 'bonus' ) 
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
                        $_obf_0D5B0B29062722350A081C02112A2808251D120E2E0C01 += $totalWin;
                    }
                    if( $scattersCount == 2 ) 
                    {
                        $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 += 10;
                    }
                    if( $scattersCount == 3 ) 
                    {
                        $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 += 20;
                    }
                    if( $scattersCount == 4 ) 
                    {
                        $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 += 50;
                    }
                    if( $scattersCount == 5 ) 
                    {
                        $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 += 100;
                    }
                    $slotSettings->SetGameData('SunWukongPTMBonusWin', $slotSettings->GetGameData('SunWukongPTMBonusWin') + $totalWin);
                    $_obf_0D390225301D2E21373038281039131A192C011A3F0632[] = '{"drawId":' . ($s + 1) . ',"winLines":{"currentWin":' . $totalWin . ',"currentSpins":' . $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 . ',"display":"Q,SA,M,K,M;PE,M,J,A,N;A,PE,K,Q,A","reelset":0,"runningTotal":' . ($slotSettings->GetGameData('SunWukongPTMFreeStartWin') + $slotSettings->GetGameData('SunWukongPTMBonusWin')) . ',"spins":' . $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 . ',"stops":"' . implode(',', $reels['rp']) . '"},"replayInfo":{"foItems":"' . implode(',', $reels['rp']) . '"}}';
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1116233529011F0C293C2D011C113C061E381B341411[] = '{"responseEvent":"spin","responseType":"freespin","serverResponse":{"bonusMpl":' . $bonusMpl . ',"slotLines":' . $lines . ',"slotBet":' . $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 . ',"totalFreeGames":' . $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 . ',"currentFreeGames":' . $s . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData('SunWukongPTMBonusWin') . ',"freeStartWin":' . $slotSettings->GetGameData('SunWukongPTMFreeStartWin') . ',"totalWin":' . $totalWin . ',"winLines":[],"bonusInfo":"","Jackpots":"","reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                }
                $slotSettings->SetGameData('SunWukongPTMFreeSpins', $_obf_0D390225301D2E21373038281039131A192C011A3F0632);
                $slotSettings->SetGameData('SunWukongPTMFreeLogs', $_obf_0D1116233529011F0C293C2D011C113C061E381B341411);
                $slotSettings->SetGameData('SunWukongPTMFreeGames', $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411);
                $slotSettings->SetGameData('SunWukongPTMCurrentFreeGame', 0);
                $_obf_0D262203355C053823371B100325295B12151B3F095C22 = implode(',', $_obf_0D390225301D2E21373038281039131A192C011A3F0632);
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"gameId":2543168908,"drawStates":[{"drawId":1,"feature":{"name":"bonus","details":{"bonusPayout":' . $slotSettings->GetGameData('SunWukongPTMFreeStartWin') . ',"initialSpins":' . $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 . ',"multiplier":' . $bonusMpl . ',"pick":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['pick'] . ',"spins":' . $_obf_0D220B060A21130E0C011A09151D32403F5B025C070411 . ',"totalPayout":' . $_obf_0D5B0B29062722350A081C02112A2808251D120E2E0C01 . '}}},' . $_obf_0D262203355C053823371B100325295B12151B3F095C22 . ']},"ID":47342,"umid":1951}';
            }
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '46120' && $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['savedStates'][0]['attr21'] > 0 ) 
            {
                $_obf_0D2813390912262B102326025B34051621182F31041832 = $slotSettings->GetGameData('SunWukongPTMCurrentFreeGame');
                $_obf_0D131D5C261C392D093F121D1F2E13191812150D231232 = $slotSettings->GetGameData('SunWukongPTMFreeSpins');
                $_obf_0D222C3C342D2C31305B091C0A1C10250A19140B2B2811 = $slotSettings->GetGameData('SunWukongPTMFreeLogs');
                $_obf_0D390225301D2E21373038281039131A192C011A3F0632 = json_decode(trim($_obf_0D131D5C261C392D093F121D1F2E13191812150D231232[$_obf_0D2813390912262B102326025B34051621182F31041832]), true);
                $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11 = json_decode(trim($_obf_0D222C3C342D2C31305B091C0A1C10250A19140B2B2811[$_obf_0D2813390912262B102326025B34051621182F31041832]), true);
                $totalWin = $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11['serverResponse']['totalWin'];
                if( $totalWin > 0 ) 
                {
                    $slotSettings->SetBalance($totalWin);
                }
                $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11['serverResponse']['freeSeq'] = $_obf_0D131D5C261C392D093F121D1F2E13191812150D231232;
                $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11['serverResponse']['freeLogSeq'] = $_obf_0D222C3C342D2C31305B091C0A1C10250A19140B2B2811;
                $slotSettings->SaveLogReport(json_encode($_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11), $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11['serverResponse']['slotLines'], $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11['serverResponse']['slotBet'], $totalWin, 'freespin');
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"gameId":2543168908},"ID":46121,"umid":45}';
                $slotSettings->SetGameData('SunWukongPTMCurrentFreeGame', $slotSettings->GetGameData('SunWukongPTMCurrentFreeGame') + 1);
            }
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) && ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '46123' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '46302') ) 
            {
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] = 'regular';
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '46302' ) 
                {
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] = 'free';
                }
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'regular' ) 
                {
                    $umid = '0';
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    $bonusMpl = 1;
                    $slotSettings->SetGameData('SunWukongPTMBonusWin', 0);
                    $slotSettings->SetGameData('SunWukongPTMFreeGames', 0);
                    $slotSettings->SetGameData('SunWukongPTMCurrentFreeGame', 0);
                    $slotSettings->SetGameData('SunWukongPTMTotalWin', 0);
                    $slotSettings->SetGameData('SunWukongPTMFreeBalance', 0);
                    $slotSettings->SetGameData('SunWukongPTMFreeStartWin', 0);
                }
                else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'free' ) 
                {
                    $umid = '0';
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                    $slotSettings->SetGameData('SunWukongPTMCurrentFreeGame', $slotSettings->GetGameData('SunWukongPTMCurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->slotFreeMpl;
                }
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[0] = [
                    2, 
                    2, 
                    2, 
                    2, 
                    2
                ];
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[1] = [
                    1, 
                    1, 
                    1, 
                    1, 
                    1
                ];
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[2] = [
                    3, 
                    3, 
                    3, 
                    3, 
                    3
                ];
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[3] = [
                    1, 
                    2, 
                    3, 
                    2, 
                    1
                ];
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[4] = [
                    3, 
                    2, 
                    1, 
                    2, 
                    3
                ];
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[5] = [
                    2, 
                    1, 
                    1, 
                    1, 
                    2
                ];
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[6] = [
                    2, 
                    3, 
                    3, 
                    3, 
                    2
                ];
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[7] = [
                    1, 
                    1, 
                    2, 
                    3, 
                    3
                ];
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[8] = [
                    3, 
                    3, 
                    2, 
                    1, 
                    1
                ];
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[9] = [
                    2, 
                    3, 
                    2, 
                    1, 
                    2
                ];
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[10] = [
                    2, 
                    1, 
                    2, 
                    3, 
                    2
                ];
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[11] = [
                    1, 
                    2, 
                    2, 
                    2, 
                    1
                ];
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[12] = [
                    3, 
                    2, 
                    2, 
                    2, 
                    3
                ];
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[13] = [
                    1, 
                    2, 
                    1, 
                    2, 
                    1
                ];
                $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[14] = [
                    3, 
                    2, 
                    3, 
                    2, 
                    3
                ];
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                {
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] = $slotSettings->GetGameData('SunWukongPTMBet');
                    $lines = $slotSettings->GetGameData('SunWukongPTMLines');
                }
                else
                {
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['stake'];
                    $_obf_0D1E1D1E330423230F3B1A16370D031D333625295B2F32 = explode('L', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['numLines']);
                    $lines = (int)$_obf_0D1E1D1E330423230F3B1A16370D031D333625295B2F32[1];
                    $slotSettings->SetGameData('SunWukongPTMBet', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet']);
                    $slotSettings->SetGameData('SunWukongPTMLines', $lines);
                }
                $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / $lines;
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'respin' ) 
                {
                    if( $lines <= 0 || $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 <= 0.0001 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetBalance() < ($lines * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832) ) 
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
                    $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22 = ['0'];
                    $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22 = '12';
                    $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211 = $slotSettings->GetSpinWin($reels, $lines, $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832, $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901, $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22, $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22, $bonusMpl);
                    $totalWin = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['totalWin'];
                    $lineWins = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['lineWins'];
                    $scattersWin = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['scattersWin'];
                    $scattersCount = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['scattersCount'];
                    $scattersStr = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['scattersStr'];
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
                    $slotSettings->SetGameData('SunWukongPTMBonusWin', $slotSettings->GetGameData('SunWukongPTMBonusWin') + $totalWin);
                    $slotSettings->SetGameData('SunWukongPTMTotalWin', $totalWin);
                }
                else
                {
                    $slotSettings->SetGameData('SunWukongPTMTotalWin', $totalWin);
                }
                if( $scattersCount >= 3 ) 
                {
                    if( $slotSettings->GetGameData('SunWukongPTMFreeGames') > 0 ) 
                    {
                        $slotSettings->SetGameData('SunWukongPTMFreeGames', $slotSettings->GetGameData('SunWukongPTMFreeGames') + $slotSettings->slotFreeCount);
                    }
                    else
                    {
                        $slotSettings->SetGameData('SunWukongPTMFreeStartWin', $totalWin);
                        $slotSettings->SetGameData('SunWukongPTMBonusWin', 0);
                        $slotSettings->SetGameData('SunWukongPTMFreeGames', $slotSettings->slotFreeCount);
                    }
                }
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"placeBetsResponse":{"gameId":2543270502,"newBalance":2.147483647E9},"loadResultsResponse":{"gameId":2543270502,"drawStates":[{"drawId":0,"state":"settling","wCapMaxWin":1000000.0,"bet":{"pick":"L' . $lines . '","seq":0,"stake":0.01,"type":"line","won":"false"},"winLines":{"currentSpins":0,"display":"J,T,W,N,T;M,H,J,S,N;PE,PE,Q,W,SA","reelset":0,"runningTotal":0.0,"spins":0,"stops":"' . implode(',', $reels['rp']) . '"},"replayInfo":{"foItems":"' . implode(',', $reels['rp']) . '"}}]}},"ID":47343,"umid":32}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"settleBetsResponse":{"gameId":2543270502,"newBalance":2.147483647E9},"closeGameResponse":{},"openGameResponse":{"gameId":2543271807,"drawStates":[{"drawId":0}],"savedState":{"attr21":"-1","seq":0},"persistedProperties":{"attr21":"-1"}},"ID":47345,"umid":39}}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"gameId":2543271807},"ID":46121,"umid":40}';
                $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"slotLines":' . $lines . ',"slotBet":' . $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 . ',"totalFreeGames":' . $slotSettings->GetGameData('SunWukongPTMFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('SunWukongPTMCurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData('SunWukongPTMBonusWin') . ',"freeStartWin":' . $slotSettings->GetGameData('SunWukongPTMFreeStartWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"bonusInfo":' . $scattersStr . ',"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                $slotSettings->SaveLogReport($response, $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
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
                case '46090':
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'brokenGames') != '' ) 
                    {
                        $_obf_0D2410310726250E1A3F025B0F2101383038135B043C01 = $slotSettings->GetGameData('SunWukongPTMFreeSpins');
                        $_obf_0D2813390912262B102326025B34051621182F31041832 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01 = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"gameId":2543168908,"drawStates":[{"drawId":0,"state":"settling","wCapMaxWin":1000000.0,"bet":{"payout":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $slotSettings->GetGameData($slotSettings->slotId . 'FreeStartWin')) . ',"pick":"L' . $slotSettings->GetGameData($slotSettings->slotId . 'Lines') . '","seq":0,"stake":' . ($slotSettings->GetGameData($slotSettings->slotId . 'Bet') * $slotSettings->GetGameData($slotSettings->slotId . 'Lines')) . ',"type":"line","won":"true"},"winLines":{"currentSpins":0,"display":"S,S,M,S,N;Q,PE,T,H,A;PE,J,N,A,H","reelset":0,"runningTotal":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeStartWin') . ',"spins":0,"stops":"16,53,26,61,31","scatter":{"length":3,"offsets":"0,1,3","payout":0.05,"prize":"3S"},"feature":{"name":"bonus"}},"replayInfo":{"foItems":"16,53,26,61,31"}},{"drawId":1,"feature":{"name":"bonus","details":{"bonusPayout":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"initialSpins":' . $_obf_0D2813390912262B102326025B34051621182F31041832 . ',"multiplier":' . $slotSettings->GetGameData('SunWukongPTMbonusMpl') . ',"pick":2,"spins":1,"totalPayout":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $slotSettings->GetGameData($slotSettings->slotId . 'FreeStartWin')) . '}}},' . implode(',', $_obf_0D2410310726250E1A3F025B0F2101383038135B043C01) . '],"savedState":{"attr21":"' . $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01 . '","seq":0},"persistedProperties":{"attr21":"' . $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01 . '"}},"ID":47340,"umid":31}';
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"gameId":2538685341,"drawStates":[{"drawId":0}],"savedState":{"attr21":"-1","seq":0},"persistedProperties":{"attr21":"-1"}},"ID":47340,"umid":30}';
                    }
                    break;
                case '40066':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    for( $i = 0; $i < count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] * 100;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"funNoticeGames":0,"funNoticePayouts":0,"gameGroup":"gtsswk","minBet":0,"maxBet":0,"minPosBet":0,"maxPosBet":50000,"coinSizes":[' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . ']},"ID":40025,"umid":21}';
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
                        $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->slotLines);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $lastEvent->serverResponse->slotBet);
                        if( isset($lastEvent->serverResponse->freeSeq) ) 
                        {
                            $slotSettings->SetGameData('SunWukongPTMFreeSpins', $lastEvent->serverResponse->freeSeq);
                            $slotSettings->SetGameData('SunWukongPTMFreeLogs', $lastEvent->serverResponse->freeLogSeq);
                            $slotSettings->SetGameData('SunWukongPTMbonusMpl', $lastEvent->serverResponse->bonusMpl);
                        }
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'brokenGames', 'gtsswk');
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
