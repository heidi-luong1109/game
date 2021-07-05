<?php 
namespace VanguardLTE\Games\WaysOfPhoenixPT
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
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType']) ) 
            {
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'regular' ) 
                {
                    $umid = '0';
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22 = 1;
                    $slotSettings->SetGameData('WaysOfPhoenixPTBonusWin', 0);
                    $slotSettings->SetGameData('WaysOfPhoenixPTFreeGames', 0);
                    $slotSettings->SetGameData('WaysOfPhoenixPTCurrentFreeGame', 0);
                    $slotSettings->SetGameData('WaysOfPhoenixPTTotalWin', 0);
                    $slotSettings->SetGameData('WaysOfPhoenixPTFreeBalance', 0);
                    $slotSettings->SetGameData('WaysOfPhoenixPTFreeStartWin', 0);
                }
                else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'free' ) 
                {
                    $umid = '0';
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                    $slotSettings->SetGameData('WaysOfPhoenixPTCurrentFreeGame', $slotSettings->GetGameData('WaysOfPhoenixPTCurrentFreeGame') + 1);
                    $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22 = 1;
                }
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / 100;
                $lines = 25;
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
                $_obf_0D102529251727325C3B193F11041B1A1C08151F290601 = '';
                $slotSettings->SetReels();
                $gridState = $slotSettings->GetGameData('WaysOfPhoenixPTGridState');
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $_obf_0D181C103526150D021B2C0E1A1F211F3F3E2A15363632 = [];
                    $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22 = '0';
                    $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22 = '13';
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D361A3F5C2730270A194003251E380340273105110711 = rand(1, 6);
                    }
                    else
                    {
                        $_obf_0D361A3F5C2730270A194003251E380340273105110711 = rand(1, 6);
                    }
                    if( $winType == 'bonus' ) 
                    {
                        $_obf_0D361A3F5C2730270A194003251E380340273105110711 = 0;
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    }
                    else
                    {
                        $reels = $slotSettings->GetReelStrips0($_obf_0D361A3F5C2730270A194003251E380340273105110711, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    }
                    $_obf_0D033133292312350626263012280D02021A2C3B172A32 = $reels;
                    if( $gridState['b_' . ($_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * 100)] == 0 ) 
                    {
                        $reels['reel1'][0] = 'EMPTY';
                        $reels['reel1'][1] = 'EMPTY';
                        $reels['reel1'][3] = 'EMPTY';
                        $reels['reel1'][4] = 'EMPTY';
                        $reels['reel2'][0] = 'EMPTY';
                        $reels['reel2'][4] = 'EMPTY';
                        $reels['reel4'][0] = 'EMPTY';
                        $reels['reel4'][4] = 'EMPTY';
                        $reels['reel5'][0] = 'EMPTY';
                        $reels['reel5'][1] = 'EMPTY';
                        $reels['reel5'][3] = 'EMPTY';
                        $reels['reel5'][4] = 'EMPTY';
                    }
                    else if( $gridState['b_' . ($_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * 100)] == 1 ) 
                    {
                        $reels['reel1'][0] = 'EMPTY';
                        $reels['reel1'][4] = 'EMPTY';
                        $reels['reel2'][0] = 'EMPTY';
                        $reels['reel2'][4] = 'EMPTY';
                        $reels['reel4'][0] = 'EMPTY';
                        $reels['reel4'][4] = 'EMPTY';
                        $reels['reel5'][0] = 'EMPTY';
                        $reels['reel5'][1] = 'EMPTY';
                        $reels['reel5'][3] = 'EMPTY';
                        $reels['reel5'][4] = 'EMPTY';
                    }
                    else if( $gridState['b_' . ($_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * 100)] == 2 ) 
                    {
                        $reels['reel1'][0] = 'EMPTY';
                        $reels['reel1'][4] = 'EMPTY';
                        $reels['reel2'][0] = 'EMPTY';
                        $reels['reel2'][4] = 'EMPTY';
                        $reels['reel4'][0] = 'EMPTY';
                        $reels['reel4'][4] = 'EMPTY';
                        $reels['reel5'][0] = 'EMPTY';
                        $reels['reel5'][4] = 'EMPTY';
                    }
                    else if( $gridState['b_' . ($_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * 100)] == 3 ) 
                    {
                        $reels['reel2'][0] = 'EMPTY';
                        $reels['reel2'][4] = 'EMPTY';
                        $reels['reel4'][0] = 'EMPTY';
                        $reels['reel4'][4] = 'EMPTY';
                        $reels['reel5'][0] = 'EMPTY';
                        $reels['reel5'][4] = 'EMPTY';
                    }
                    else if( $gridState['b_' . ($_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * 100)] == 4 ) 
                    {
                        $reels['reel2'][0] = 'EMPTY';
                        $reels['reel2'][4] = 'EMPTY';
                        $reels['reel4'][0] = 'EMPTY';
                        $reels['reel4'][4] = 'EMPTY';
                    }
                    for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                    {
                        $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = $slotSettings->SymbolGame[$j];
                        $_obf_0D372E171A0818143D08051506222B13073C1233403F11 = [
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0
                        ];
                        $_obf_0D3537130906101A5C3F2933333328230B36083C132432 = [
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0
                        ];
                        $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432 = [
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0
                        ];
                        $_obf_0D0E141F34210C271834013D060623402816092A400E11 = 0;
                        $_obf_0D183F36171F13273B1C352F09191A120F240734372622 = 1;
                        $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 = 1;
                        $_obf_0D1805343927020F12183727223F2B123401385C363E32 = 1;
                        if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22 || !isset($slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132]) ) 
                        {
                        }
                        else
                        {
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                for( $s = 0; $s <= 4; $s++ ) 
                                {
                                    if( $reels['reel' . $r][$s] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $reels['reel' . $r][$s] == $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22 ) 
                                    {
                                        $_obf_0D372E171A0818143D08051506222B13073C1233403F11[$r - 1] = 1;
                                        $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1]++;
                                    }
                                    if( $reels['reel' . $r][$s] == $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22 ) 
                                    {
                                        $_obf_0D3537130906101A5C3F2933333328230B36083C132432[$r - 1] = 1;
                                    }
                                }
                            }
                            if( $_obf_0D372E171A0818143D08051506222B13073C1233403F11[0] > 0 && $_obf_0D372E171A0818143D08051506222B13073C1233403F11[1] > 0 ) 
                            {
                                $_obf_0D183F36171F13273B1C352F09191A120F240734372622 = 1;
                                $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 = 1;
                                $_obf_0D1805343927020F12183727223F2B123401385C363E32 = 1;
                                for( $r = 1; $r <= 2; $r++ ) 
                                {
                                    if( $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] > 0 ) 
                                    {
                                        $_obf_0D183F36171F13273B1C352F09191A120F240734372622 = $_obf_0D183F36171F13273B1C352F09191A120F240734372622 * $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1];
                                    }
                                    if( $_obf_0D3537130906101A5C3F2933333328230B36083C132432[$r - 1] > 0 && $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] > 0 ) 
                                    {
                                        $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 = $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 * 1;
                                        $_obf_0D1805343927020F12183727223F2B123401385C363E32 = $_obf_0D1805343927020F12183727223F2B123401385C363E32 * ($_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] - 1);
                                    }
                                    else if( $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] > 0 ) 
                                    {
                                        $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 = $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 * $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1];
                                        $_obf_0D1805343927020F12183727223F2B123401385C363E32 = $_obf_0D1805343927020F12183727223F2B123401385C363E32 * $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1];
                                    }
                                }
                                $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][2] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D183F36171F13273B1C352F09191A120F240734372622;
                                if( ($_obf_0D3537130906101A5C3F2933333328230B36083C132432[0] > 0 || $_obf_0D3537130906101A5C3F2933333328230B36083C132432[1] > 0) && $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22 > 1 ) 
                                {
                                    $_obf_0D0B312F221E0821060317011D085B401836243D342E01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][2] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 * $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22;
                                    $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][2] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D1805343927020F12183727223F2B123401385C363E32;
                                    $_obf_0D0E141F34210C271834013D060623402816092A400E11 += $_obf_0D0B312F221E0821060317011D085B401836243D342E01;
                                }
                            }
                            if( $_obf_0D372E171A0818143D08051506222B13073C1233403F11[0] > 0 && $_obf_0D372E171A0818143D08051506222B13073C1233403F11[1] > 0 && $_obf_0D372E171A0818143D08051506222B13073C1233403F11[2] > 0 ) 
                            {
                                $_obf_0D183F36171F13273B1C352F09191A120F240734372622 = 1;
                                $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 = 1;
                                $_obf_0D1805343927020F12183727223F2B123401385C363E32 = 1;
                                for( $r = 1; $r <= 3; $r++ ) 
                                {
                                    if( $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] > 0 ) 
                                    {
                                        $_obf_0D183F36171F13273B1C352F09191A120F240734372622 = $_obf_0D183F36171F13273B1C352F09191A120F240734372622 * $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1];
                                    }
                                    if( $_obf_0D3537130906101A5C3F2933333328230B36083C132432[$r - 1] > 0 && $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] > 0 ) 
                                    {
                                        $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 = $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 * 1;
                                        $_obf_0D1805343927020F12183727223F2B123401385C363E32 = $_obf_0D1805343927020F12183727223F2B123401385C363E32 * ($_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] - 1);
                                    }
                                    else if( $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] > 0 ) 
                                    {
                                        $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 = $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 * $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1];
                                        $_obf_0D1805343927020F12183727223F2B123401385C363E32 = $_obf_0D1805343927020F12183727223F2B123401385C363E32 * $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1];
                                    }
                                }
                                $_obf_0D10022121083E281E0827223D1F210F310C143D180F22 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D183F36171F13273B1C352F09191A120F240734372622;
                                if( ($_obf_0D3537130906101A5C3F2933333328230B36083C132432[0] > 0 || $_obf_0D3537130906101A5C3F2933333328230B36083C132432[1] > 0 || $_obf_0D3537130906101A5C3F2933333328230B36083C132432[2] > 0) && $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22 > 1 ) 
                                {
                                    $_obf_0D1E053E28292B225B1E0308300E02145C23012F1C2D22 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 * $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22;
                                    $_obf_0D10022121083E281E0827223D1F210F310C143D180F22 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D1805343927020F12183727223F2B123401385C363E32;
                                    $_obf_0D10022121083E281E0827223D1F210F310C143D180F22 += $_obf_0D1E053E28292B225B1E0308300E02145C23012F1C2D22;
                                }
                                if( $_obf_0D0E141F34210C271834013D060623402816092A400E11 < $_obf_0D10022121083E281E0827223D1F210F310C143D180F22 ) 
                                {
                                    $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $_obf_0D10022121083E281E0827223D1F210F310C143D180F22;
                                }
                            }
                            if( $_obf_0D372E171A0818143D08051506222B13073C1233403F11[0] > 0 && $_obf_0D372E171A0818143D08051506222B13073C1233403F11[1] > 0 && $_obf_0D372E171A0818143D08051506222B13073C1233403F11[2] > 0 && $_obf_0D372E171A0818143D08051506222B13073C1233403F11[3] > 0 ) 
                            {
                                $_obf_0D183F36171F13273B1C352F09191A120F240734372622 = 1;
                                $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 = 1;
                                $_obf_0D1805343927020F12183727223F2B123401385C363E32 = 1;
                                for( $r = 1; $r <= 4; $r++ ) 
                                {
                                    if( $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] > 0 ) 
                                    {
                                        $_obf_0D183F36171F13273B1C352F09191A120F240734372622 = $_obf_0D183F36171F13273B1C352F09191A120F240734372622 * $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1];
                                    }
                                    if( $_obf_0D3537130906101A5C3F2933333328230B36083C132432[$r - 1] > 0 && $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] > 0 ) 
                                    {
                                        $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 = $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 * 1;
                                        $_obf_0D1805343927020F12183727223F2B123401385C363E32 = $_obf_0D1805343927020F12183727223F2B123401385C363E32 * ($_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] - 1);
                                    }
                                    else if( $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] > 0 ) 
                                    {
                                        $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 = $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 * $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1];
                                        $_obf_0D1805343927020F12183727223F2B123401385C363E32 = $_obf_0D1805343927020F12183727223F2B123401385C363E32 * $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1];
                                    }
                                }
                                $_obf_0D10022121083E281E0827223D1F210F310C143D180F22 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D183F36171F13273B1C352F09191A120F240734372622;
                                if( ($_obf_0D3537130906101A5C3F2933333328230B36083C132432[0] > 0 || $_obf_0D3537130906101A5C3F2933333328230B36083C132432[1] > 0 || $_obf_0D3537130906101A5C3F2933333328230B36083C132432[2] > 0 || $_obf_0D3537130906101A5C3F2933333328230B36083C132432[3] > 0) && $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22 > 1 ) 
                                {
                                    $_obf_0D1E053E28292B225B1E0308300E02145C23012F1C2D22 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 * $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22;
                                    $_obf_0D10022121083E281E0827223D1F210F310C143D180F22 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D1805343927020F12183727223F2B123401385C363E32;
                                    $_obf_0D10022121083E281E0827223D1F210F310C143D180F22 += $_obf_0D1E053E28292B225B1E0308300E02145C23012F1C2D22;
                                }
                                if( $_obf_0D0E141F34210C271834013D060623402816092A400E11 < $_obf_0D10022121083E281E0827223D1F210F310C143D180F22 ) 
                                {
                                    $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $_obf_0D10022121083E281E0827223D1F210F310C143D180F22;
                                }
                            }
                            if( $_obf_0D372E171A0818143D08051506222B13073C1233403F11[0] > 0 && $_obf_0D372E171A0818143D08051506222B13073C1233403F11[1] > 0 && $_obf_0D372E171A0818143D08051506222B13073C1233403F11[2] > 0 && $_obf_0D372E171A0818143D08051506222B13073C1233403F11[3] > 0 && $_obf_0D372E171A0818143D08051506222B13073C1233403F11[4] > 0 ) 
                            {
                                $_obf_0D183F36171F13273B1C352F09191A120F240734372622 = 1;
                                $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 = 1;
                                $_obf_0D1805343927020F12183727223F2B123401385C363E32 = 1;
                                for( $r = 1; $r <= 5; $r++ ) 
                                {
                                    if( $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] > 0 ) 
                                    {
                                        $_obf_0D183F36171F13273B1C352F09191A120F240734372622 = $_obf_0D183F36171F13273B1C352F09191A120F240734372622 * $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1];
                                    }
                                    if( $_obf_0D3537130906101A5C3F2933333328230B36083C132432[$r - 1] > 0 && $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] > 0 ) 
                                    {
                                        $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 = $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 * 1;
                                        $_obf_0D1805343927020F12183727223F2B123401385C363E32 = $_obf_0D1805343927020F12183727223F2B123401385C363E32 * ($_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] - 1);
                                    }
                                    else if( $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1] > 0 ) 
                                    {
                                        $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 = $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 * $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1];
                                        $_obf_0D1805343927020F12183727223F2B123401385C363E32 = $_obf_0D1805343927020F12183727223F2B123401385C363E32 * $_obf_0D2B103F08301D13393118363C0B223C07322D245B2432[$r - 1];
                                    }
                                }
                                $_obf_0D10022121083E281E0827223D1F210F310C143D180F22 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D183F36171F13273B1C352F09191A120F240734372622;
                                if( ($_obf_0D3537130906101A5C3F2933333328230B36083C132432[0] > 0 || $_obf_0D3537130906101A5C3F2933333328230B36083C132432[1] > 0 || $_obf_0D3537130906101A5C3F2933333328230B36083C132432[2] > 0 || $_obf_0D3537130906101A5C3F2933333328230B36083C132432[3] > 0 || $_obf_0D3537130906101A5C3F2933333328230B36083C132432[4] > 0) && $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22 > 1 ) 
                                {
                                    $_obf_0D1E053E28292B225B1E0308300E02145C23012F1C2D22 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D0F38142A310731170C28291D0F3B2B271004393E4022 * $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22;
                                    $_obf_0D10022121083E281E0827223D1F210F310C143D180F22 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D1805343927020F12183727223F2B123401385C363E32;
                                    $_obf_0D10022121083E281E0827223D1F210F310C143D180F22 += $_obf_0D1E053E28292B225B1E0308300E02145C23012F1C2D22;
                                }
                                if( $_obf_0D0E141F34210C271834013D060623402816092A400E11 < $_obf_0D10022121083E281E0827223D1F210F310C143D180F22 ) 
                                {
                                    $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $_obf_0D10022121083E281E0827223D1F210F310C143D180F22;
                                }
                            }
                            $_obf_0D102529251727325C3B193F11041B1A1C08151F290601 .= ('_' . $_obf_0D0E141F34210C271834013D060623402816092A400E11 . '|');
                            $totalWin += $_obf_0D0E141F34210C271834013D060623402816092A400E11;
                        }
                    }
                    $_obf_0D10342528350D243D16293C2835061F263C1C39042811 = 0;
                    $_obf_0D033835123E051D331E010A3C300C332C34021F052801 = '{';
                    $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11 = 0;
                    $_obf_0D170E142706063E5B1A3F360A140F03062A045B180332 = 0;
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 4; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                        {
                            if( $_obf_0D033133292312350626263012280D02021A2C3B172A32['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22 ) 
                            {
                                $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11++;
                                $_obf_0D033835123E051D331E010A3C300C332C34021F052801 .= ('"winReel' . $r . '":[' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . ',"' . $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22 . '"],');
                            }
                        }
                    }
                    $_obf_0D10342528350D243D16293C2835061F263C1C39042811 = $slotSettings->Paytable['SYM_' . $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22][$_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'];
                    if( $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11 >= 3 && $slotSettings->slotBonus ) 
                    {
                        $_obf_0D033835123E051D331E010A3C300C332C34021F052801 .= '"scattersType":"bonus",';
                    }
                    else if( $_obf_0D10342528350D243D16293C2835061F263C1C39042811 > 0 ) 
                    {
                        $_obf_0D033835123E051D331E010A3C300C332C34021F052801 .= '"scattersType":"win",';
                    }
                    else
                    {
                        $_obf_0D033835123E051D331E010A3C300C332C34021F052801 .= '"scattersType":"none",';
                    }
                    $_obf_0D033835123E051D331E010A3C300C332C34021F052801 .= ('"scattersWin":' . $_obf_0D10342528350D243D16293C2835061F263C1C39042811 . '}');
                    $totalWin += $_obf_0D10342528350D243D16293C2835061F263C1C39042811;
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
                        if( $_obf_0D170E142706063E5B1A3F360A140F03062A045B180332 > 1 && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                        }
                        else if( ($_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11 >= 3 || $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11 >= 2 && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin') && $winType != 'bonus' ) 
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
                    if( $gridState['b_' . ($_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * 100)] < 5 ) 
                    {
                        $gridState['b_' . ($_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * 100)]++;
                    }
                }
                else if( $gridState['b_' . ($_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * 100)] > 0 && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                {
                    $gridState['b_' . ($_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * 100)]--;
                }
                $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData('WaysOfPhoenixPTBonusWin', $slotSettings->GetGameData('WaysOfPhoenixPTBonusWin') + $totalWin);
                    $slotSettings->SetGameData('WaysOfPhoenixPTTotalWin', $totalWin);
                }
                else
                {
                    $slotSettings->SetGameData('WaysOfPhoenixPTTotalWin', $totalWin);
                }
                $slotSettings->SetGameData('WaysOfPhoenixPTGridState', $gridState);
                if( $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11 >= 2 ) 
                {
                    if( $slotSettings->GetGameData('WaysOfPhoenixPTFreeGames') > 0 ) 
                    {
                        $slotSettings->SetGameData('WaysOfPhoenixPTFreeGames', $slotSettings->GetGameData('WaysOfPhoenixPTFreeGames') + $slotSettings->slotFreeCountAdd[$_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11]);
                    }
                    else if( $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11 >= 3 ) 
                    {
                        $slotSettings->SetGameData('WaysOfPhoenixPTFreeStartWin', $totalWin);
                        $slotSettings->SetGameData('WaysOfPhoenixPTBonusWin', 0);
                        $slotSettings->SetGameData('WaysOfPhoenixPTFreeGames', $slotSettings->slotFreeCount[$_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11]);
                    }
                }
                $_obf_0D3039071A0640191631322E2B285B11385B151E1F3E11 = $_obf_0D361A3F5C2730270A194003251E380340273105110711;
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"spinType":"REGULAR","ww":"' . $totalWin . '","gridState":1,"reelset":' . $_obf_0D3039071A0640191631322E2B285B11385B151E1F3E11 . ',"scCnt":' . $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11 . ',"numFgWon":' . $slotSettings->slotFreeCount[$_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11] . ',"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"results":[' . implode(',', $reels['rp']) . '],"windowId":"j22lf6"},"ID":49370,"umid":35}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $_obf_0D181C103526150D021B2C0E1A1F211F3F3E2A15363632);
                $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"gridState":' . json_encode($gridState) . ',"linesArr":[4096],"slotLines":' . $lines . ',"slotBet":' . $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 . ',"totalFreeGames":' . $slotSettings->GetGameData('WaysOfPhoenixPTFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('WaysOfPhoenixPTCurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData('WaysOfPhoenixPTBonusWin') . ',"freeStartWin":' . $slotSettings->GetGameData('WaysOfPhoenixPTFreeStartWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"bonusInfo":' . $_obf_0D033835123E051D331E010A3C300C332C34021F052801 . ',"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                $slotSettings->SaveLogReport($response, $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
            }
            switch( $umid ) 
            {
                case '31031':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"urlList":[{"urlType":"mobile_login","url":"https://login.loc/register","priority":1},{"urlType":"mobile_support","url":"https://ww2.loc/support","priority":1},{"urlType":"playerprofile","url":"","priority":1},{"urlType":"playerprofile","url":"","priority":10},{"urlType":"gambling_commission","url":"","priority":1},{"urlType":"cashier","url":"","priority":1},{"urlType":"cashier","url":"","priority":1}]},"ID":100}';
                    break;
                case '40029':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"numFgWon":' . $slotSettings->GetGameData('WaysOfPhoenixPTFreeGames') . ',"windowId":"JB2We4"},"ID":49373,"umid":63}';
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
                    $gridState = [];
                    for( $i = 0; $i < count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] * 100;
                        $gridState['b_' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i]] = 0;
                    }
                    $slotSettings->SetGameData('WaysOfPhoenixPTGridState', $gridState);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"funNoticeGames":0,"funNoticePayouts":0,"gameGroup":"wotp","minBet":0,"maxBet":0,"minPosBet":0,"maxPosBet":50000,"coinSizes":[' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . ']},"ID":40025,"umid":21}';
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
                        $slotSettings->SetGameData($slotSettings->slotId . 'Reels', $lastEvent->serverResponse->reelsSymbols->rp);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $slotSettings->SetGameData($slotSettings->slotId . 'LinesArr', $lastEvent->serverResponse->linesArr);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $lastEvent->serverResponse->slotBet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'GridState', (array)$lastEvent->serverResponse->gridState);
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'brokenGames', 'wotp');
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
                        $_obf_0D0A100E222F353718313B181106313D102F393C3E1732 = '';
                        $_obf_0D0E13050525251E113F1717012D402223035B2F352C01 = $slotSettings->GetGameData('WaysOfPhoenixPTGridState');
                        $_obf_0D40331F163639293D2A102B2A1F212A023E1C2E022332 = $_obf_0D0E13050525251E113F1717012D402223035B2F352C01['b_' . ($slotSettings->GetGameData($slotSettings->slotId . 'Bet') * 100 * 25)];
                        $_obf_0D070E3B250C1C1F14211831172F0D12255B3E313F0D11 = $_obf_0D40331F163639293D2A102B2A1F212A023E1C2E022332 + 1;
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"freeSpinsData":{"numFreeSpins":' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . ',"coinsize":' . ($slotSettings->GetGameData($slotSettings->slotId . 'Bet') * 100 * 25) . ',"rows":[],"gamewin":' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeStartWin') * 100) . ',"freespinwin":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . ',"freespinTriggerReels":[' . implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'Reels')) . '],"coins":0,"multiplier":1,"mode":1,"startBonus":1},"bonusGameName":"freespins","lastPlayedGameStateData":{"reelset":1,"nextGridId":' . $_obf_0D070E3B250C1C1F14211831172F0D12255B3E313F0D11 . ',"gridId":' . $_obf_0D40331F163639293D2A102B2A1F212A023E1C2E022332 . '},"triggeringGameStateData":{"reelset":4,"nextGridId":' . $_obf_0D070E3B250C1C1F14211831172F0D12255B3E313F0D11 . ',"gridId":' . $_obf_0D40331F163639293D2A102B2A1F212A023E1C2E022332 . '},"reelinfo":[70,112,24,146,147],"windowId":"4PNR06"},"ID":49374,"umid":30}';
                    }
                    break;
                case '49371':
                    $gridState = $slotSettings->GetGameData('WaysOfPhoenixPTGridState');
                    $_obf_0D270D1F235B3D33030F3E220D37151C221A34395B0411 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / 25;
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"bet":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] . ',"windowId":"NXY2mU"},"ID":49152,"umid":30}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"bet":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] . ',"reelset":2,"gridState":' . $gridState['b_' . $_obf_0D270D1F235B3D33030F3E220D37151C221A34395B0411] . ',"stops":[89,78,164,123,145],"windowId":"j22lf6"},"ID":49372,"umid":29}';
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
