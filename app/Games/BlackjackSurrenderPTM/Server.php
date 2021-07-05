<?php 
namespace VanguardLTE\Games\BlackjackSurrenderPTM
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
            $_obf_0D08333E1D26032E03385B371A3631170E0B3C361B2601 = false;
            if( $umid == '40124' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == '3' ) 
            {
                $allbet = $slotSettings->GetGameData($slotSettings->slotId . 'Bet');
                $cardsArr = $slotSettings->GetGameData($slotSettings->slotId . 'Cards');
                $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122 = $slotSettings->GetGameData($slotSettings->slotId . 'Boxes');
                $currentBox = $slotSettings->GetGameData($slotSettings->slotId . 'currentBox');
                $state = -1;
                $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['state'] = 'stand';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"action":3,"cardsInfo":[],"index":' . $state . ',"windowId":"qOpl9d"},"ID":40122,"umid":290}';
                for( $i = $currentBox - 1; $i >= 0; $i-- ) 
                {
                    $currentBox = $i;
                    if( $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainBet'] > 0 && $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['state'] != 'blackjack' && $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['state'] != 'stand' && $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['state'] != 'bust' ) 
                    {
                        break;
                    }
                    if( $i == 0 && $state == -1 ) 
                    {
                        $_obf_0D08333E1D26032E03385B371A3631170E0B3C361B2601 = true;
                    }
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'currentBox', $currentBox);
                $slotSettings->SetGameData($slotSettings->slotId . 'Cards', $cardsArr);
                $slotSettings->SetGameData($slotSettings->slotId . 'Boxes', $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122);
                $_obf_0D051F32160D2633272229031F0C241F01321403172C32 = $slotSettings->GetGameData($slotSettings->slotId . 'actions');
                $_obf_0D051F32160D2633272229031F0C241F01321403172C32[] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'];
                $slotSettings->SetGameData($slotSettings->slotId . 'actions', $_obf_0D051F32160D2633272229031F0C241F01321403172C32);
                $response = '{"responseEvent":"spin","responseType":"bet","serverResponse":{"actions":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'actions')) . ',"Boxes":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'Boxes')) . ',"cardsArr":' . json_encode($cardsArr) . ',"state":"0","slotLines":1,"slotBet":' . $allbet . ',"totalFreeGames":0,"currentFreeGames":0,"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":0,"totalWin":0,"winLines":[]}}';
                $slotSettings->SaveLogReport($response, 0, 1, 0, 'bet');
            }
            if( $umid == '40124' && ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == '8' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == '10') ) 
            {
                $allbet = $slotSettings->GetGameData($slotSettings->slotId . 'Bet');
                $cardsArr = $slotSettings->GetGameData($slotSettings->slotId . 'Cards');
                $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122 = $slotSettings->GetGameData($slotSettings->slotId . 'Boxes');
                $currentBox = $slotSettings->GetGameData($slotSettings->slotId . 'currentBoxInsurance');
                $state = 30;
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == '8' ) 
                {
                    $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainBet'] / 2;
                    $allbet -= $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainBet'];
                    $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['insuranceBet'] = $_obf_0D1F331E12153F33093F052D063409092F141D252C3411;
                    if( $slotSettings->GetBalance() < $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid balance"}';
                        exit( $response );
                    }
                    $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                    $slotSettings->SetBalance(-1 * $_obf_0D1F331E12153F33093F052D063409092F141D252C3411);
                    $slotSettings->UpdateJackpots($_obf_0D1F331E12153F33093F052D063409092F141D252C3411);
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    $response = '{"totalWin":0,"data":{"cards":[],"windowId":"OxupG1"},"ID":40180,"umid":53}';
                    $slotSettings->SaveLogReport($response, $_obf_0D1F331E12153F33093F052D063409092F141D252C3411, 1, 0, 'insurance');
                }
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"action":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] . ',"cardsInfo":[],"index":30,"windowId":"amOGGK"},"ID":40122,"umid":231}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                for( $i = $currentBox - 1; $i >= 0; $i-- ) 
                {
                    $currentBox = $i;
                    if( $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainBet'] > 0 ) 
                    {
                        break;
                    }
                    if( $i == 0 && $state == -1 ) 
                    {
                        $_obf_0D08333E1D26032E03385B371A3631170E0B3C361B2601 = true;
                    }
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $allbet);
                $slotSettings->SetGameData($slotSettings->slotId . 'currentBoxInsurance', $currentBox);
                $slotSettings->SetGameData($slotSettings->slotId . 'Cards', $cardsArr);
                $slotSettings->SetGameData($slotSettings->slotId . 'Boxes', $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122);
            }
            if( $umid == '40124' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == '9' ) 
            {
                $allbet = $slotSettings->GetGameData($slotSettings->slotId . 'Bet');
                $cardsArr = $slotSettings->GetGameData($slotSettings->slotId . 'Cards');
                $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122 = $slotSettings->GetGameData($slotSettings->slotId . 'Boxes');
                $currentBox = $slotSettings->GetGameData($slotSettings->slotId . 'currentBox');
                $state = 30;
                $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainBet'] / 2;
                $allbet -= $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainBet'];
                $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['surBet'] = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainBet'];
                $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainBet'] = 0;
                $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['state'] = 'surrender';
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"action":9,"cardsInfo":[],"index":30,"windowId":"amOGGK"},"ID":40122,"umid":41}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                $response = '{"totalWin":0,"data":{"cards":[],"windowId":"OxupG1"},"ID":40180,"umid":53}';
                for( $i = $currentBox - 1; $i >= 0; $i-- ) 
                {
                    $currentBox = $i;
                    if( $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainBet'] > 0 && $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['state'] != 'blackjack' && $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['state'] != 'stand' && $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['state'] != 'bust' ) 
                    {
                        break;
                    }
                    if( $i == 0 ) 
                    {
                        $_obf_0D08333E1D26032E03385B371A3631170E0B3C361B2601 = true;
                    }
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $allbet);
                $slotSettings->SetGameData($slotSettings->slotId . 'currentBox', $currentBox);
                $slotSettings->SetGameData($slotSettings->slotId . 'Cards', $cardsArr);
                $slotSettings->SetGameData($slotSettings->slotId . 'Boxes', $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122);
                $_obf_0D051F32160D2633272229031F0C241F01321403172C32 = $slotSettings->GetGameData($slotSettings->slotId . 'actions');
                $_obf_0D051F32160D2633272229031F0C241F01321403172C32[] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'];
                $slotSettings->SetGameData($slotSettings->slotId . 'actions', $_obf_0D051F32160D2633272229031F0C241F01321403172C32);
                $response = '{"responseEvent":"spin","responseType":"bet","serverResponse":{"actions":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'actions')) . ',"Boxes":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'Boxes')) . ',"cardsArr":' . json_encode($cardsArr) . ',"state":"0","slotLines":1,"slotBet":' . $allbet . ',"totalFreeGames":0,"currentFreeGames":0,"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":0,"totalWin":0,"winLines":[]}}';
                $slotSettings->SaveLogReport($response, 0, 1, 0, 'bet');
            }
            if( $umid == '40124' && ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == '2' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == '4') ) 
            {
                $allbet = $slotSettings->GetGameData($slotSettings->slotId . 'Bet');
                $cardsArr = $slotSettings->GetGameData($slotSettings->slotId . 'Cards');
                $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122 = $slotSettings->GetGameData($slotSettings->slotId . 'Boxes');
                $currentBox = $slotSettings->GetGameData($slotSettings->slotId . 'currentBox');
                $state = 30;
                $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 = 0;
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == '4' && $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainBet'] < $slotSettings->GetBalance() ) 
                {
                    $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainBet'];
                    $allbet += $_obf_0D1F331E12153F33093F052D063409092F141D252C3411;
                    $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainBet'] = $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 * 2;
                    if( $slotSettings->GetBalance() < $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid balance"}';
                        exit( $response );
                    }
                    $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                    $slotSettings->UpdateJackpots($_obf_0D1F331E12153F33093F052D063409092F141D252C3411);
                    $slotSettings->SetBalance(-1 * $_obf_0D1F331E12153F33093F052D063409092F141D252C3411);
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                }
                $_obf_0D04081C1735360B232D06080E2E243B403D4003110D01 = array_shift($cardsArr);
                $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['cards'][] = $_obf_0D04081C1735360B232D06080E2E243B403D4003110D01;
                $slotSettings->GetScore($_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]);
                $_obf_0D2C1113391C36052B0F5C2A070618360F2A3E0F0E0B22 = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox];
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"currentBox":' . $currentBox . ',"state":"' . $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['state'] . '","score":' . $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainScore'] . ',"action":2,"cardsInfo2":' . json_encode($_obf_0D2C1113391C36052B0F5C2A070618360F2A3E0F0E0B22['cards']) . ',"cardsInfo":[' . json_encode($_obf_0D04081C1735360B232D06080E2E243B403D4003110D01) . '],"index":' . $state . ',"windowId":"qOpl9d"},"ID":40122,"umid":290}';
                if( $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainScore'] == 21 ) 
                {
                    $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['state'] = 'stand';
                }
                if( $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['state'] == 'bust' || $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainScore'] == 21 || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == '4' ) 
                {
                    $state = -1;
                    for( $i = $currentBox - 1; $i >= 0; $i-- ) 
                    {
                        $currentBox = $i;
                        if( $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainBet'] > 0 && $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['state'] != 'blackjack' && $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['state'] != 'stand' && $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['state'] != 'bust' ) 
                        {
                            break;
                        }
                        if( $i == 0 && $state == -1 ) 
                        {
                            $_obf_0D08333E1D26032E03385B371A3631170E0B3C361B2601 = true;
                        }
                    }
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $allbet);
                $slotSettings->SetGameData($slotSettings->slotId . 'currentBox', $currentBox);
                $slotSettings->SetGameData($slotSettings->slotId . 'Cards', $cardsArr);
                $slotSettings->SetGameData($slotSettings->slotId . 'Boxes', $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122);
                $_obf_0D051F32160D2633272229031F0C241F01321403172C32 = $slotSettings->GetGameData($slotSettings->slotId . 'actions');
                $_obf_0D051F32160D2633272229031F0C241F01321403172C32[] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'];
                $slotSettings->SetGameData($slotSettings->slotId . 'actions', $_obf_0D051F32160D2633272229031F0C241F01321403172C32);
                $response = '{"responseEvent":"spin","responseType":"bet","serverResponse":{"actions":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'actions')) . ',"Boxes":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'Boxes')) . ',"cardsArr":' . json_encode($cardsArr) . ',"state":"0","slotLines":1,"slotBet":' . $allbet . ',"totalFreeGames":0,"currentFreeGames":0,"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":0,"totalWin":0,"winLines":[]}}';
                $slotSettings->SaveLogReport($response, $_obf_0D1F331E12153F33093F052D063409092F141D252C3411, 1, 0, 'bet');
            }
            if( $umid == '40124' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'] == '5' ) 
            {
                $allbet = $slotSettings->GetGameData($slotSettings->slotId . 'Bet');
                $cardsArr = $slotSettings->GetGameData($slotSettings->slotId . 'Cards');
                $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122 = $slotSettings->GetGameData($slotSettings->slotId . 'Boxes');
                $currentBox = $slotSettings->GetGameData($slotSettings->slotId . 'currentBox');
                if( $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainBet'] < $slotSettings->GetBalance() ) 
                {
                    $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainBet'];
                    $allbet += $_obf_0D1F331E12153F33093F052D063409092F141D252C3411;
                    if( $slotSettings->GetBalance() < $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid balance"}';
                        exit( $response );
                    }
                    $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                    $slotSettings->UpdateJackpots($_obf_0D1F331E12153F33093F052D063409092F141D252C3411);
                    $slotSettings->SetBalance(-1 * $_obf_0D1F331E12153F33093F052D063409092F141D252C3411);
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                    $response = '{"totalWin":0,"data":{"cards":[],"windowId":"OxupG1"},"ID":40180,"umid":53}';
                    $slotSettings->SaveLogReport($response, $_obf_0D1F331E12153F33093F052D063409092F141D252C3411, 1, 0, 'bet');
                    $state = 30;
                    $_obf_0D340A095B0924122C222C2B23082E132F1F3709291211 = $currentBox + 5;
                    $_obf_0D04081C1735360B232D06080E2E243B403D4003110D01 = array_shift($cardsArr);
                    $_obf_0D193B312F1215072121231840022C3D2A2C2E0A0F0332 = array_shift($cardsArr);
                    if( !isset($_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['cards'][1]) ) 
                    {
                        $slotSettings->InternalError($slotSettings->PackGameData());
                    }
                    $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$_obf_0D340A095B0924122C222C2B23082E132F1F3709291211]['cards'][0] = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['cards'][1];
                    $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$_obf_0D340A095B0924122C222C2B23082E132F1F3709291211]['cards'][1] = $_obf_0D193B312F1215072121231840022C3D2A2C2E0A0F0332;
                    $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$_obf_0D340A095B0924122C222C2B23082E132F1F3709291211]['mainBet'] = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainBet'];
                    $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['cards'][1] = $_obf_0D04081C1735360B232D06080E2E243B403D4003110D01;
                    $slotSettings->GetScore($_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]);
                    $slotSettings->GetScore($_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$_obf_0D340A095B0924122C222C2B23082E132F1F3709291211]);
                    $_obf_0D2C1113391C36052B0F5C2A070618360F2A3E0F0E0B22 = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox];
                    if( $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$_obf_0D340A095B0924122C222C2B23082E132F1F3709291211]['mainScore'] != 21 || $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$_obf_0D340A095B0924122C222C2B23082E132F1F3709291211]['mainScore'] != 20 ) 
                    {
                        $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$_obf_0D340A095B0924122C222C2B23082E132F1F3709291211]['state'] = 'stand';
                        $currentBox = $_obf_0D340A095B0924122C222C2B23082E132F1F3709291211;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"currentBox":' . $currentBox . ',"state":"' . $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['state'] . '","score":' . $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$currentBox]['mainScore'] . ',"action":5,"cardsInfo2":' . json_encode($_obf_0D2C1113391C36052B0F5C2A070618360F2A3E0F0E0B22['cards']) . ',"cardsInfo":[' . json_encode($_obf_0D04081C1735360B232D06080E2E243B403D4003110D01) . ',' . json_encode($_obf_0D193B312F1215072121231840022C3D2A2C2E0A0F0332) . '],"index":' . $state . ',"windowId":"qOpl9d"},"ID":40122,"umid":290}';
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $allbet);
                $slotSettings->SetGameData($slotSettings->slotId . 'currentBox', $currentBox);
                $slotSettings->SetGameData($slotSettings->slotId . 'Cards', $cardsArr);
                $slotSettings->SetGameData($slotSettings->slotId . 'Boxes', $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122);
            }
            if( $umid == '49260' ) 
            {
                $allbet = 0;
                $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122 = [];
                $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[0] = $slotSettings->CreateBox();
                $_obf_0D171A1A351F2C1C1B39142F22083E02091D072B052D01 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['dealerpairBet'] / 100;
                $allbet += $_obf_0D171A1A351F2C1C1B39142F22083E02091D072B052D01;
                $sideBets = [
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0
                ];
                $plusThree = [
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0
                ];
                for( $i = 1; $i <= 5; $i++ ) 
                {
                    $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i] = $slotSettings->CreateBox();
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bets'][$i - 1] > 0 ) 
                    {
                        $_obf_0D3227140228220A40393732351C220A171D05253F3122 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bets'][$i - 1] / 100;
                        $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainBet'] = $_obf_0D3227140228220A40393732351C220A171D05253F3122;
                        $allbet += $_obf_0D3227140228220A40393732351C220A171D05253F3122;
                    }
                    if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['sideBets'][$i - 1]['plusThree']) ) 
                    {
                        $_obf_0D1234183522375C252A2C010A3E050B3B1D3B3D3D3F01 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['sideBets'][$i - 1]['plusThree'] / 100;
                        $plusThree[$i - 1] = $_obf_0D1234183522375C252A2C010A3E050B3B1D3B3D3D3F01;
                        $allbet += $_obf_0D1234183522375C252A2C010A3E050B3B1D3B3D3D3F01;
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['sideBets'][$i - 1]['sideBet'] > 0 ) 
                    {
                        $_obf_0D1234183522375C252A2C010A3E050B3B1D3B3D3D3F01 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['sideBets'][$i - 1]['sideBet'] / 100;
                        $sideBets[$i - 1] = $_obf_0D1234183522375C252A2C010A3E050B3B1D3B3D3D3F01;
                        $allbet += $_obf_0D1234183522375C252A2C010A3E050B3B1D3B3D3D3F01;
                    }
                }
                for( $i = 6; $i <= 10; $i++ ) 
                {
                    $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i] = $slotSettings->CreateBox();
                }
                if( $slotSettings->GetBalance() < $allbet ) 
                {
                    $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid balance"}';
                    exit( $response );
                }
                $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $allbet / 100 * $slotSettings->GetPercent();
                $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                $slotSettings->UpdateJackpots($allbet);
                $slotSettings->SetBalance(-1 * $allbet);
                $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                for( $c = 0; $c <= 2000; $c++ ) 
                {
                    $totalWin = 0;
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
                    $_obf_0D055B220A123936081C0423373F0F061D31063E340F32 = [];
                    $_obf_0D4035050D0B062A3E2B2238345C092538311315160B11 = [];
                    $currentBox = 0;
                    $currentBoxInsurance = 0;
                    $_obf_0D100B2E300B08312605022B1D192108061414050A4022 = array_shift($cardsArr);
                    $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[0]['cards'] = [$_obf_0D100B2E300B08312605022B1D192108061414050A4022];
                    $_obf_0D4035050D0B062A3E2B2238345C092538311315160B11[] = $_obf_0D100B2E300B08312605022B1D192108061414050A4022;
                    $_obf_0D1C270D093C0C260D070A26232D065C322E08210C2E22 = 0;
                    for( $i = 1; $i <= 5; $i++ ) 
                    {
                        if( $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainBet'] > 0 ) 
                        {
                            $_obf_0D04081C1735360B232D06080E2E243B403D4003110D01 = array_shift($cardsArr);
                            $_obf_0D193B312F1215072121231840022C3D2A2C2E0A0F0332 = array_shift($cardsArr);
                            $_obf_0D055B220A123936081C0423373F0F061D31063E340F32[] = $_obf_0D04081C1735360B232D06080E2E243B403D4003110D01;
                            $_obf_0D055B220A123936081C0423373F0F061D31063E340F32[] = $_obf_0D193B312F1215072121231840022C3D2A2C2E0A0F0332;
                            $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['cards'] = [
                                $_obf_0D04081C1735360B232D06080E2E243B403D4003110D01, 
                                $_obf_0D193B312F1215072121231840022C3D2A2C2E0A0F0332
                            ];
                            $slotSettings->GetScore($_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]);
                            $currentBox = $i;
                            $currentBoxInsurance = $i;
                            $_obf_0D0B312F221E0821060317011D085B401836243D342E01 = $slotSettings->GetThreeWin([
                                $_obf_0D04081C1735360B232D06080E2E243B403D4003110D01, 
                                $_obf_0D193B312F1215072121231840022C3D2A2C2E0A0F0332, 
                                $_obf_0D4035050D0B062A3E2B2238345C092538311315160B11[0]
                            ]) * $plusThree[$i - 1];
                            $_obf_0D345B1F13362E3B29400C361217142E0F19172F1E3C01 = $slotSettings->GetSideWin([
                                $_obf_0D04081C1735360B232D06080E2E243B403D4003110D01, 
                                $_obf_0D193B312F1215072121231840022C3D2A2C2E0A0F0332
                            ]) * $sideBets[$i - 1];
                            $totalWin += $_obf_0D0B312F221E0821060317011D085B401836243D342E01;
                            $totalWin += $_obf_0D345B1F13362E3B29400C361217142E0F19172F1E3C01;
                            if( $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['state'] == 'blackjack' ) 
                            {
                                $_obf_0D1C270D093C0C260D070A26232D065C322E08210C2E22 += ($_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainBet'] * 2.5);
                            }
                        }
                    }
                    if( $totalWin + $_obf_0D1C270D093C0C260D070A26232D065C322E08210C2E22 <= $bank ) 
                    {
                        if( $_obf_0D1C270D093C0C260D070A26232D065C322E08210C2E22 > 0 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'BankReserved', $_obf_0D1C270D093C0C260D070A26232D065C322E08210C2E22);
                            $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $_obf_0D1C270D093C0C260D070A26232D065C322E08210C2E22);
                        }
                        break;
                    }
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'currentBoxInsurance', $currentBoxInsurance);
                $slotSettings->SetGameData($slotSettings->slotId . 'currentBox', $currentBox);
                $slotSettings->SetGameData($slotSettings->slotId . 'Cards', $cardsArr);
                $slotSettings->SetGameData($slotSettings->slotId . 'Boxes', $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122);
                $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $allbet);
                $slotSettings->SetGameData($slotSettings->slotId . 'actions', []);
                if( $totalWin > 0 ) 
                {
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                }
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"windowId":"qOpl9d"},"ID":40155,"umid":32}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"windowId":"qOpl9d"},"ID":40156,"umid":32}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"ww":' . $totalWin . ',"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"playerCards":' . json_encode($_obf_0D055B220A123936081C0423373F0F061D31063E340F32) . ',"dealerCard":' . json_encode($_obf_0D4035050D0B062A3E2B2238345C092538311315160B11[0]) . ',"windowId":"mip3DY"},"ID":40118,"umid":34}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"index":30,"windowId":"mip3DY"},"ID":40120,"umid":35}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                $response = '{"responseEvent":"spin","responseType":"bet","serverResponse":{"actions":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'actions')) . ',"Boxes":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'Boxes')) . ',"cardsArr":' . json_encode($cardsArr) . ',"state":"0","slotLines":1,"slotBet":' . $allbet . ',"totalFreeGames":0,"currentFreeGames":0,"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":0,"totalWin":0,"winLines":[]}}';
                $slotSettings->SaveLogReport($response, $allbet, 1, 0, 'bet');
            }
            if( $_obf_0D08333E1D26032E03385B371A3631170E0B3C361B2601 ) 
            {
                $BankReserved = $slotSettings->GetGameData($slotSettings->slotId . 'BankReserved');
                if( $BankReserved > 0 ) 
                {
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $BankReserved);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BankReserved', 0);
                }
                $cardsArr = $slotSettings->GetGameData($slotSettings->slotId . 'Cards');
                $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122 = $slotSettings->GetGameData($slotSettings->slotId . 'Boxes');
                $currentBox = $slotSettings->GetGameData($slotSettings->slotId . 'currentBox');
                $allbet = $slotSettings->GetGameData($slotSettings->slotId . 'Bet');
                $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                $_obf_0D06340240270A1B063C0E022B3D023315281205330D22 = true;
                for( $i = 10; $i >= 1; $i-- ) 
                {
                    if( $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['state'] != 'bust' && $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainBet'] > 0 ) 
                    {
                        $_obf_0D06340240270A1B063C0E022B3D023315281205330D22 = false;
                    }
                }
                for( $c = 0; $c <= 2000; $c++ ) 
                {
                    $totalWin = 0;
                    $_obf_0D3E2D04253B2E36262C5B19120C23052E3C0634182A11 = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[0];
                    $_obf_0D1E132D0F400E3709252C25070E3B3C3F251330052D22 = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[0];
                    $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = [];
                    $_obf_0D34171D3827111E08055B1F275C2C1E381B3040102711 = [];
                    shuffle($cardsArr);
                    $_obf_0D1E0408041811150D0330071206031E2C1F3F10163F22 = 0;
                    for( $i = 0; $i <= 15; $i++ ) 
                    {
                        $_obf_0D3E2D04253B2E36262C5B19120C23052E3C0634182A11['cards'][] = $cardsArr[$_obf_0D1E0408041811150D0330071206031E2C1F3F10163F22];
                        $_obf_0D1E132D0F400E3709252C25070E3B3C3F251330052D22['cards'][] = $cardsArr[$_obf_0D1E0408041811150D0330071206031E2C1F3F10163F22];
                        $_obf_0D1E132D0F400E3709252C25070E3B3C3F251330052D22['cards'][] = $cardsArr[$_obf_0D1E0408041811150D0330071206031E2C1F3F10163F22 + 1];
                        $_obf_0D25035C31183316381216122811401A1F2A17243E2B22[] = $cardsArr[$_obf_0D1E0408041811150D0330071206031E2C1F3F10163F22];
                        $_obf_0D1E0408041811150D0330071206031E2C1F3F10163F22++;
                        $slotSettings->GetScore($_obf_0D3E2D04253B2E36262C5B19120C23052E3C0634182A11);
                        $slotSettings->GetScore($_obf_0D1E132D0F400E3709252C25070E3B3C3F251330052D22);
                        $_obf_0D34171D3827111E08055B1F275C2C1E381B3040102711[] = $_obf_0D3E2D04253B2E36262C5B19120C23052E3C0634182A11['mainScore'];
                        if( $_obf_0D3E2D04253B2E36262C5B19120C23052E3C0634182A11['mainScore'] >= 17 || $_obf_0D1E132D0F400E3709252C25070E3B3C3F251330052D22['mainScore'] > 21 && $_obf_0D3E2D04253B2E36262C5B19120C23052E3C0634182A11['mainScore'] != 16 || $_obf_0D06340240270A1B063C0E022B3D023315281205330D22 && $_obf_0D3E2D04253B2E36262C5B19120C23052E3C0634182A11['mainScore'] != 16 ) 
                        {
                            break;
                        }
                    }
                    $_obf_0D342C03310A1F321D045C2B1A3931212D0B2C241F5B11 = [
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
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
                    for( $i = 10; $i >= 1; $i-- ) 
                    {
                        $_obf_0D0E141F34210C271834013D060623402816092A400E11 = 0;
                        if( $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['state'] == 'surrender' ) 
                        {
                            $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['surBet'] / 2;
                        }
                        if( $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainBet'] > 0 && $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['state'] != 'bust' ) 
                        {
                            if( $_obf_0D3E2D04253B2E36262C5B19120C23052E3C0634182A11['mainScore'] > 21 ) 
                            {
                                $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainBet'] * 2;
                            }
                            if( $_obf_0D3E2D04253B2E36262C5B19120C23052E3C0634182A11['mainScore'] < $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainScore'] ) 
                            {
                                $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainBet'] * 2;
                            }
                            if( $_obf_0D3E2D04253B2E36262C5B19120C23052E3C0634182A11['mainScore'] == $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainScore'] ) 
                            {
                                $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainBet'] * 1;
                            }
                            if( $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['state'] == 'blackjack' ) 
                            {
                                $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122[$i]['mainBet'] * 2.5;
                            }
                        }
                        $_obf_0D342C03310A1F321D045C2B1A3931212D0B2C241F5B11[$i] = $_obf_0D0E141F34210C271834013D060623402816092A400E11;
                        $totalWin += $_obf_0D0E141F34210C271834013D060623402816092A400E11;
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
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"dsc":[' . implode(',', $_obf_0D342C03310A1F321D045C2B1A3931212D0B2C241F5B11) . '],"ds":' . $_obf_0D3E2D04253B2E36262C5B19120C23052E3C0634182A11['mainScore'] . ',"ww":' . $totalWin . ',"debug":' . json_encode($_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122) . ',"dealerCards":' . json_encode($_obf_0D25035C31183316381216122811401A1F2A17243E2B22) . ',"windowId":"mip3DY"},"ID":40125,"umid":43}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                $slotSettings->SetGameData($slotSettings->slotId . 'currentBox', $currentBox);
                $slotSettings->SetGameData($slotSettings->slotId . 'Cards', $cardsArr);
                $slotSettings->SetGameData($slotSettings->slotId . 'Boxes', $_obf_0D153F25383B3F0B113B2C2E021A3D1706222110323122);
                $_obf_0D051F32160D2633272229031F0C241F01321403172C32 = $slotSettings->GetGameData($slotSettings->slotId . 'actions');
                $_obf_0D051F32160D2633272229031F0C241F01321403172C32[] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'];
                $slotSettings->SetGameData($slotSettings->slotId . 'actions', $_obf_0D051F32160D2633272229031F0C241F01321403172C32);
                $response = '{"responseEvent":"spin","responseType":"bet","serverResponse":{"actions":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'actions')) . ',"Boxes":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'Boxes')) . ',"cardsArr":' . json_encode($cardsArr) . ',"state":"-1","slotLines":1,"slotBet":' . $allbet . ',"totalFreeGames":0,"currentFreeGames":0,"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":0,"totalWin":0,"winLines":[]}}';
                $slotSettings->SaveLogReport0($response, 0, 1, $totalWin, 'bet');
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
                case '40024':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    $minBet = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] * 100;
                    $maxBet = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) - 1] * 100;
                    if( $minBet < 10 ) 
                    {
                        $minBet = 10;
                    }
                    if( $maxBet < 10 ) 
                    {
                        $maxBet = 10;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"funNoticeGames":0,"funNoticePayouts":0,"gameGroup":"bjsd2","minBet":' . $minBet . ',"maxBet":' . $maxBet . ',"minPosBet":0,"maxPosBet":0,"coinSizes":[1,500,1,500,1,500],"sidebetLimits":{"playerMinBet":' . $minBet . ',"playerMaxBet": ' . $maxBet . ',"dealerMinBet":' . $minBet . ',"dealerMaxBet": ' . $maxBet . ',"twentyOnePlusThreeMinBet":' . $minBet . ',"twentyOnePlusThreeMaxBet": ' . $maxBet . '},"altLimits":[]},"ID":40025,"umid":20}';
                    break;
                case '40036':
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    $slotSettings->SetGameData('BlackjackSurrenderPTMBets', []);
                    $lastEvent = $slotSettings->GetHistory();
                    if( $lastEvent != 'NULL' && $lastEvent->serverResponse->state != -1 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'brokenGames', 'bjsd2');
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'brokenGames', '');
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
                    $lastEvent = $slotSettings->GetHistory();
                    if( $lastEvent != 'NULL' && $lastEvent->serverResponse->state != -1 ) 
                    {
                        for( $i = 10; $i >= 0; $i-- ) 
                        {
                            $lastEvent->serverResponse->Boxes[$i] = (array)$lastEvent->serverResponse->Boxes[$i];
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $lastEvent->serverResponse->slotBet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'cardsArr', $lastEvent->serverResponse->cardsArr);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Boxes', $lastEvent->serverResponse->Boxes);
                        $slotSettings->SetGameData($slotSettings->slotId . 'actions', $lastEvent->serverResponse->actions);
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{},"ID":40031,"umid":18}';
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"windowId":"ErbtIw"},"ID":48047,"umid":19}';
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"credit":3378,"windowId":"yLn5hn"},"ID":40026,"umid":29}';
                        $_obf_0D3B2737190D08362833033F321E12272E252D0D112622 = [];
                        $Boxes = $lastEvent->serverResponse->Boxes;
                        $bets = [];
                        for( $j = 5; $j >= 1; $j-- ) 
                        {
                            $bets[] = $Boxes[$j]['mainBet'] * 100;
                        }
                        for( $j = 10; $j >= 1; $j-- ) 
                        {
                            for( $i = 10; $i >= 1; $i-- ) 
                            {
                                if( count($Boxes[$i]['cards']) > 0 ) 
                                {
                                    $_obf_0D3B2737190D08362833033F321E12272E252D0D112622[] = array_shift($Boxes[$i]['cards']);
                                }
                            }
                        }
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"totalBet":' . ($lastEvent->serverResponse->slotBet * 100) . ',"bets":' . json_encode($bets) . ',"dealerBet":0,"sideBets":[{"sideBet":0,"plusThree":0},{"sideBet":0,"plusThree":0},{"sideBet":0,"plusThree":0},{"sideBet":0,"plusThree":0},{"sideBet":0,"plusThree":0}],"actions":' . json_encode($lastEvent->serverResponse->actions) . ',"playerCards":' . json_encode($_obf_0D3B2737190D08362833033F321E12272E252D0D112622) . ',"dealerCards":' . json_encode($lastEvent->serverResponse->Boxes[0]['cards']) . ',"windowId":"3YG1v6"},"ID":49261,"umid":28}';
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":1,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"windowId":"SuJLru"},"ID":40026,"umid":28}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"limitType":[1,2,3,4],"limitMin":[100,100,100,100],"limitMax":[1000,10000,8000,50000],"windowId":"MVRRkz"},"ID":40008,"umid":29}';
                    break;
                case '40050':
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
