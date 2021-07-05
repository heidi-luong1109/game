<?php 
namespace VanguardLTE\Games\RouletteClassicPT
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
            if( $umid == '40063' ) 
            {
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
                $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022 = [];
                $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['straight'] = 36;
                $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['split'] = 18;
                $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['street'] = 12;
                $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['corner'] = 9;
                $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['line'] = 6;
                $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['column'] = 3;
                $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['twelve'] = 3;
                $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['low'] = 2;
                $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['high'] = 2;
                $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['red'] = 2;
                $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['black'] = 2;
                $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['odd'] = 2;
                $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['even'] = 2;
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32 = [];
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['zero'] = 0;
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['straight'] = 0;
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['split'] = 0;
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['street'] = 0;
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['corner'] = 0;
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['line'] = 0;
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['column'] = 0;
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['twelve'] = 0;
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['low'] = 0;
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['high'] = 0;
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['red'] = 0;
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['black'] = 0;
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['odd'] = 0;
                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['even'] = 0;
                $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $_obf_0D1C39272B1F0E1E2A37320F27323D2E40273B17150922 = rand(0, 36);
                    $_obf_0D0A171D1E131B3B352E0E37172D40181B133D210C2722 = [];
                    $totalWin = 0;
                    $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 = 0;
                    foreach( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bets'] as $key => $vl ) 
                    {
                        $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 += ($vl[1] / 100);
                        $_obf_0D182D342D210D092E5B031331351F0A192A382F2A0F32 = $slotSettings->GetNumbersByField($vl[0]);
                        if( $_obf_0D182D342D210D092E5B031331351F0A192A382F2A0F32[0] == 'straight' && $_obf_0D182D342D210D092E5B031331351F0A192A382F2A0F32[1][0] == '0' ) 
                        {
                            $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['zero'] = 1;
                        }
                        else
                        {
                            $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32[$_obf_0D182D342D210D092E5B031331351F0A192A382F2A0F32[0]]++;
                        }
                        if( in_array($_obf_0D1C39272B1F0E1E2A37320F27323D2E40273B17150922, $_obf_0D182D342D210D092E5B031331351F0A192A382F2A0F32[1]) ) 
                        {
                            $_obf_0D142C241F1B181D2723252601234035375B141A063811 = $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022[$_obf_0D182D342D210D092E5B031331351F0A192A382F2A0F32[0]] * ($vl[1] / 100);
                            $totalWin += $_obf_0D142C241F1B181D2723252601234035375B141A063811;
                        }
                    }
                    if( $totalWin <= $bank ) 
                    {
                        break;
                    }
                    if( $i > 1500 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                        exit( $response );
                    }
                }
                $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 / 100 * $slotSettings->GetPercent();
                if( $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['zero'] > 0 && ($_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['red'] > 0 && $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['black'] > 0 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['odd'] > 0 && $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['even'] > 0 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['high'] > 0 && $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['low'] > 0 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['twelve'] >= 3 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['column'] >= 3 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['straight'] >= 36) ) 
                {
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D34351C331E352827231A38333E1A082713062B2B2732);
                    $slotSettings->SetBalance(-1 * $_obf_0D34351C331E352827231A38333E1A082713062B2B2732, 'bet');
                }
                else
                {
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                    $slotSettings->SetBalance(-1 * $_obf_0D34351C331E352827231A38333E1A082713062B2B2732, 'bet');
                }
                if( $totalWin > 0 ) 
                {
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                    $slotSettings->SetBalance($totalWin);
                }
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{},"ID":40173,"umid":35}';
                foreach( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bets'] as $key => $vl ) 
                {
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"windowId":"m4Un7g"},"ID":40129,"umid":36}';
                }
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"result":' . $_obf_0D1C39272B1F0E1E2A37320F27323D2E40273B17150922 . ',"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"windowId":"aelrii"},"ID":40111,"umid":36}';
                $response = '3:::{"data":{"result":' . $_obf_0D1C39272B1F0E1E2A37320F27323D2E40273B17150922 . ',"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"windowId":"aelrii"},"ID":40111,"umid":36}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                $slotSettings->SaveLogReport($response, $_obf_0D34351C331E352827231A38333E1A082713062B2B2732, 1, $totalWin, 'bet');
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
                    $_obf_0D320D211814190933190E3B072B333B180C0239192D32 = [];
                    foreach( $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 as $vl ) 
                    {
                        $_obf_0D0C5C0B5B2B130819040524211A072F022D0F1F312401 = explode('=', $vl);
                        $_obf_0D320D211814190933190E3B072B333B180C0239192D32[$_obf_0D0C5C0B5B2B130819040524211A072F022D0F1F312401[0]] = $_obf_0D0C5C0B5B2B130819040524211A072F022D0F1F312401[1] * 100;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"funNoticeGames":0,"funNoticePayouts":0,"gameGroup":"ro","minPosBet":0,"maxPosBet":0,"rouletteLimits":[{"tableLimitsName":"ro","infoAlternative":{"gameGroup":"ro","minBet":' . $_obf_0D320D211814190933190E3B072B333B180C0239192D32['minBet'] . ',"maxBet":' . $_obf_0D320D211814190933190E3B072B333B180C0239192D32['maxBet'] . ',"minPosBet":0,"maxPosBet":0},"limits":{"STRAIGHT_LIMIT":{"minBet":' . $_obf_0D320D211814190933190E3B072B333B180C0239192D32['minBetStraight'] . ',"maxBet":' . $_obf_0D320D211814190933190E3B072B333B180C0239192D32['maxBetStraight'] . '},"COLUMN_AND_DOZEN_LIMIT":{"minBet":' . $_obf_0D320D211814190933190E3B072B333B180C0239192D32['minBetColumnAndDozen'] . ',"maxBet":' . $_obf_0D320D211814190933190E3B072B333B180C0239192D32['maxBetColumnAndDozen'] . '},"FIFTY_FIFTY_LIMIT":{"minBet":' . $_obf_0D320D211814190933190E3B072B333B180C0239192D32['minBetFiftyFifty'] . ',"maxBet":' . $_obf_0D320D211814190933190E3B072B333B180C0239192D32['maxBetFiftyFifty'] . '},"TABLE_LIMIT":{"minBet":' . $_obf_0D320D211814190933190E3B072B333B180C0239192D32['minBetTable'] . ',"maxBet":' . $_obf_0D320D211814190933190E3B072B333B180C0239192D32['maxBetTable'] . '}}}]},"ID":40025,"umid":19}';
                    break;
                case '40036':
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    $slotSettings->SetGameData('RouletteClassicPTBets', []);
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
