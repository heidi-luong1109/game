<?php 
namespace VanguardLTE\Games\JacksOrBetterMHPTM
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
            if( $umid == '40186' ) 
            {
                $cardsArr = [];
                for( $i = 0; $i <= 3; $i++ ) 
                {
                    for( $j = 0; $j <= 12; $j++ ) 
                    {
                        $cardsArr[] = (object)[
                            'suit' => '' . $i, 
                            'value' => '' . $j
                        ];
                    }
                }
                if( $slotSettings->GetGameData('JacksOrBetterMHPTMDAmount') < 1 ) 
                {
                    $slotSettings->SetGameData('JacksOrBetterMHPTMTotalWin', $slotSettings->GetGameData('JacksOrBetterMHPTMTotalWin') / 2);
                }
                $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $slotSettings->GetGameData('JacksOrBetterMHPTMTotalWin');
                $_obf_0D0609280933072133022F1B1F252D160207292F381522 = $_obf_0D0E141F34210C271834013D060623402816092A400E11 * 2;
                $slotSettings->SetBalance(-1 * $_obf_0D0E141F34210C271834013D060623402816092A400E11);
                $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D0E141F34210C271834013D060623402816092A400E11);
                shuffle($cardsArr);
                $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01 = [
                    $cardsArr[0], 
                    $cardsArr[1], 
                    $cardsArr[2], 
                    $cardsArr[3], 
                    $cardsArr[4]
                ];
                $_obf_0D2C080713260E3821133D2E360E292139310E2B060E22 = rand(1, 2);
                if( $_obf_0D2C080713260E3821133D2E360E292139310E2B060E22 == 1 ) 
                {
                    $_obf_0D373202210A393C1A2E39210B383D283D05051C3E1001 = rand($slotSettings->GetGameData('JacksOrBetterMHPTMDCard'), 12);
                }
                else
                {
                    $_obf_0D373202210A393C1A2E39210B383D283D05051C3E1001 = rand(0, $slotSettings->GetGameData('JacksOrBetterMHPTMDCard'));
                }
                $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01 = [
                    $cardsArr[0], 
                    $cardsArr[1], 
                    $cardsArr[2], 
                    $cardsArr[3], 
                    $cardsArr[4]
                ];
                $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[(int)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['index'] - 1] = [
                    'value' => $_obf_0D373202210A393C1A2E39210B383D283D05051C3E1001 . '', 
                    'suit' => rand(0, 3) . ''
                ];
                if( $slotSettings->GetGameData('JacksOrBetterMHPTMDCard') == $_obf_0D373202210A393C1A2E39210B383D283D05051C3E1001 ) 
                {
                    $totalWin = $_obf_0D0E141F34210C271834013D060623402816092A400E11;
                }
                else if( $slotSettings->GetGameData('JacksOrBetterMHPTMDCard') < $_obf_0D373202210A393C1A2E39210B383D283D05051C3E1001 ) 
                {
                    $totalWin = $_obf_0D0609280933072133022F1B1F252D160207292F381522;
                }
                else
                {
                    $totalWin = 0;
                }
                $slotSettings->SetGameData('JacksOrBetterMHPTMTotalWin', $totalWin);
                if( $totalWin > 0 ) 
                {
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                }
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"amount":' . $slotSettings->GetGameData('JacksOrBetterMHPTMDAmount') . ',"cWin":' . $_obf_0D0E141F34210C271834013D060623402816092A400E11 . ',"pcard":' . $slotSettings->GetGameData('JacksOrBetterMHPTMDCard') . ',"totalWin":' . $totalWin . ',"data":{"cards":' . json_encode($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01) . ',"windowId":"VRqbhm"},"ID":40187,"umid":46}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                if( $totalWin <= 0 ) 
                {
                    $totalWin = -1 * $_obf_0D0E141F34210C271834013D060623402816092A400E11;
                }
                $response = '{"totalWin":' . $totalWin . ',"data":{"cards":' . json_encode($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01) . ',"windowId":"VRqbhm"},"ID":40187,"umid":46}';
                $slotSettings->SaveLogReport($response, $slotSettings->GetGameData('JacksOrBetterMHPTMBet'), 1, $totalWin, 'double');
            }
            if( $umid == '40182' ) 
            {
                $cardsArr = [];
                for( $i = 0; $i <= 3; $i++ ) 
                {
                    for( $j = 0; $j <= 12; $j++ ) 
                    {
                        $cardsArr[] = (object)[
                            'suit' => '' . $i, 
                            'value' => '' . $j
                        ];
                    }
                }
                shuffle($cardsArr);
                $slotSettings->SetGameData('JacksOrBetterMHPTMDCard', (int)$cardsArr[0]->value);
                $slotSettings->SetGameData('JacksOrBetterMHPTMDAmount', (double)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['amount']);
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"am":' . $slotSettings->GetGameData('JacksOrBetterMHPTMDAmount') . ',"card":{"suit":"' . $cardsArr[0]->suit . '","value":"' . $cardsArr[0]->value . '"},"windowId":"VRqbhm"},"ID":40183,"umid":46}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
            }
            if( $umid == '40179' ) 
            {
                $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01 = $slotSettings->GetGameData('JacksOrBetterMHPTMCurrentCards');
                $cardsArr = $slotSettings->GetGameData('JacksOrBetterMHPTMCards');
                $_obf_0D250C12110C045B341A300E173F143F2A281425015C11 = $slotSettings->GetGameData('JacksOrBetterMHPTMBankReserved');
                $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D250C12110C045B341A300E173F143F2A281425015C11);
                $slotSettings->SetGameData('JacksOrBetterMHPTMBankReserved', 0);
                $cardsArr = array_splice($cardsArr, 5);
                $_obf_0D3D0937381D0C17242E212C1106111804183109400D11 = $slotSettings->GetGameData($slotSettings->slotId . 'Hands');
                $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01 = $slotSettings->GetGameData('JacksOrBetterMHPTMCurrentCards');
                    $_obf_0D24102D122B382E140C141E210F5C2D3C3121321D3211 = [];
                    $totalWin = 0;
                    $_obf_0D33100817143735213E131F0E1221033F330D07123B01 = [];
                    for( $_obf_0D3E291C370537291F350C5C0E070E3403290801034001 = 0; $_obf_0D3E291C370537291F350C5C0E070E3403290801034001 < $_obf_0D3D0937381D0C17242E212C1106111804183109400D11; $_obf_0D3E291C370537291F350C5C0E070E3403290801034001++ ) 
                    {
                        shuffle($cardsArr);
                        $_obf_0D08362E123C0705361C1E135B2D30290C1F3D37321432 = 0;
                        for( $j = 0; $j < 5; $j++ ) 
                        {
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cardHolds'][$j] == 0 ) 
                            {
                                $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i] = $cardsArr[$_obf_0D08362E123C0705361C1E135B2D30290C1F3D37321432];
                                $_obf_0D08362E123C0705361C1E135B2D30290C1F3D37321432++;
                            }
                        }
                        $_obf_0D3930021E065C30212C110F1D2D150E03113925171401 = $slotSettings->GetCombination([
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[0]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[1]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[2]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[3]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[4]->value
                        ], [
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[0]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[1]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[2]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[3]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[4]->suit
                        ]);
                        $_obf_0D24102D122B382E140C141E210F5C2D3C3121321D3211[] = '{"cards":' . json_encode($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01) . '}';
                        $totalWin += (($_obf_0D3930021E065C30212C110F1D2D150E03113925171401 * $slotSettings->GetGameData('JacksOrBetterMHPTMBet')) / $_obf_0D3D0937381D0C17242E212C1106111804183109400D11);
                        $_obf_0D33100817143735213E131F0E1221033F330D07123B01[] = ($_obf_0D3930021E065C30212C110F1D2D150E03113925171401 * $slotSettings->GetGameData('JacksOrBetterMHPTMBet')) / $_obf_0D3D0937381D0C17242E212C1106111804183109400D11;
                    }
                    if( $totalWin <= $bank ) 
                    {
                        break;
                    }
                }
                if( $totalWin > 0 ) 
                {
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                }
                $slotSettings->SetGameData('JacksOrBetterMHPTMTotalWin', $totalWin);
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"tw":[' . implode(',', $_obf_0D33100817143735213E131F0E1221033F330D07123B01) . '],"totalWin":' . $totalWin . ',"data":{"cards":[' . implode(',', $_obf_0D24102D122B382E140C141E210F5C2D3C3121321D3211) . '],"windowId":"OxupG1"},"ID":40180,"umid":53}';
                $response = '{"responseEvent":"spin","responseType":"bet","serverResponse":{"Hands":' . $slotSettings->GetGameData($slotSettings->slotId . 'Hands') . ',"cardsArr":' . json_encode($cardsArr) . ',"state":"idle","slotLines":1,"slotBet":' . $slotSettings->GetGameData('JacksOrBetterMHPTMBet') . ',"totalFreeGames":0,"currentFreeGames":0,"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":0,"totalWin":' . $totalWin . ',"winLines":[],"cards":' . json_encode($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01) . '}}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                $slotSettings->SaveLogReport($response, 0, 1, $totalWin, 'bet');
            }
            if( $umid == '40175' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / 100;
                $allbet = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'];
                if( $slotSettings->GetBalance() < $allbet ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $umid . '","serverResponse":"invalid balance"}';
                    return $response;
                }
                if( $allbet < 0.0001 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $umid . '","serverResponse":"invalid bet"}';
                    return $response;
                }
                if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                {
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                }
                $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / 100 * $slotSettings->GetPercent();
                $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                $slotSettings->UpdateJackpots($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet']);
                $slotSettings->SetBalance(-1 * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
                $cardsArr = [];
                for( $i = 0; $i <= 3; $i++ ) 
                {
                    for( $j = 0; $j <= 12; $j++ ) 
                    {
                        $cardsArr[] = (object)[
                            'suit' => '' . $i, 
                            'value' => '' . $j
                        ];
                    }
                }
                $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    shuffle($cardsArr);
                    $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01 = [
                        $cardsArr[0], 
                        $cardsArr[1], 
                        $cardsArr[2], 
                        $cardsArr[3], 
                        $cardsArr[4]
                    ];
                    $_obf_0D3930021E065C30212C110F1D2D150E03113925171401 = $slotSettings->GetCombination([
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[0]->value, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[1]->value, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[2]->value, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[3]->value, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[4]->value
                    ], [
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[0]->suit, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[1]->suit, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[2]->suit, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[3]->suit, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[4]->suit
                    ]);
                    $totalWin = $_obf_0D3930021E065C30212C110F1D2D150E03113925171401 * $allbet;
                    if( $totalWin <= $bank ) 
                    {
                        $slotSettings->SetGameData('JacksOrBetterMHPTMBankReserved', $totalWin);
                        break;
                    }
                }
                $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01 = [
                    $cardsArr[0], 
                    $cardsArr[1], 
                    $cardsArr[2], 
                    $cardsArr[3], 
                    $cardsArr[4]
                ];
                $slotSettings->SetGameData('JacksOrBetterMHPTMBet', $allbet);
                $slotSettings->SetGameData('JacksOrBetterMHPTMCurrentCards', $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01);
                $slotSettings->SetGameData('JacksOrBetterMHPTMCards', $cardsArr);
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"cards":' . json_encode($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01) . ',"windowId":"OxupG1"},"ID":40176,"umid":53}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                $response = '{"responseEvent":"spin","responseType":"bet","serverResponse":{"Hands":' . $slotSettings->GetGameData($slotSettings->slotId . 'Hands') . ',"cardsArr":' . json_encode($cardsArr) . ',"state":"draw","slotLines":1,"slotBet":' . $allbet . ',"totalFreeGames":0,"currentFreeGames":0,"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":0,"totalWin":' . $totalWin . ',"winLines":[],"cards":' . json_encode($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01) . '}}';
                $slotSettings->SaveLogReport($response, $allbet, 1, 0, 'bet');
            }
            switch( $umid ) 
            {
                case '40384':
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['handsCount'] > 0 && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['handsCount'] <= 50 ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                        for( $i = 0; $i < count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11); $i++ ) 
                        {
                            $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] * 100;
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'Hands', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['handsCount']);
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"handCount":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['handsCount'] . ',"optionEnabledHands":[1,50,4,100,25,10],"showLimitsInClient":true,"disableHalfDoubleMode":true,"gameLimits":{"gameGroup":"jb_mh1","minBet":0,"maxBet":0,"minPosBet":0,"maxPosBet":50000,"coinSizes":[' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . ']},"doubleBetMultiplier":0,"windowId":"28ysnC"},"ID":40385,"umid":31}';
                    }
                    break;
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
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":10713,"params":["0","ba","bj","ct","gc","grel","hb","jb_mh","ro","sc","tr"]},"ID":50001,"umid":9}';
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
                case '40024':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    for( $i = 0; $i < count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] * 100;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"funNoticeGames":0,"funNoticePayouts":0,"gameGroup":"jb_mh","minBet":0,"maxBet":0,"minPosBet":0,"maxPosBet":50000,"coinSizes":[' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . ']},"ID":40025,"umid":19}';
                    break;
                case '40036':
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    $slotSettings->SetGameData('JacksOrBetterMHPTMBets', []);
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData($slotSettings->slotId . 'brokenGames', '');
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"brokenGames":["' . $slotSettings->GetGameData($slotSettings->slotId . 'brokenGames') . '"],"windowId":"SuJLru"},"ID":40037,"umid":22}';
                    break;
                case '40020':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":1,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"windowId":"SuJLru"},"ID":40026,"umid":28}';
                    break;
                case '40050':
                    $lastEvent = $slotSettings->GetHistory();
                    if( $lastEvent != 'NULL' && $lastEvent->serverResponse->state == 'draw' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'Cards', $lastEvent->serverResponse->cardsArr);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentCards', $lastEvent->serverResponse->cards);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $lastEvent->serverResponse->slotBet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Hands', $lastEvent->serverResponse->Hands);
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{},"ID":40031,"umid":18}';
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"windowId":"ErbtIw"},"ID":48047,"umid":19}';
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{},"ID":40031,"umid":18}';
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"bet":' . ($lastEvent->serverResponse->slotBet * 100) . ',"numCoins":1,"isDouble":false,"cards":' . json_encode($lastEvent->serverResponse->cards) . ',"handCount":' . $lastEvent->serverResponse->Hands . ',"windowId":"K0QpQs"},"ID":40387,"umid":28}';
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":1,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"windowId":"SuJLru"},"ID":40026,"umid":28}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"limitType":[1,2,3,4],"limitMin":[100,100,100,100],"limitMax":[1000,10000,8000,50000],"windowId":"MVRRkz"},"ID":40008,"umid":29}';
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
