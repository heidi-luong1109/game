<?php 
namespace VanguardLTE\Games\CaptainMN
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
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = floor(sprintf('%01.2f', $slotSettings->GetBalance()));
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = '';
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = (string)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'];
            switch( $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 ) 
            {
                case 'Init1':
                case 'Init2':
                case 'Act61':
                case 'Ping':
                case 'Act58':
                case 'getBalance':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    $_obf_0D030E023B24273D231A270A343212362F2140160E0832 = [];
                    $_obf_0D030E023B24273D231A270A343212362F2140160E0832[] = '' . ($slotSettings->CurrentDenom * 100) . '';
                    foreach( $slotSettings->Denominations as $b ) 
                    {
                        $_obf_0D030E023B24273D231A270A343212362F2140160E0832[] = '' . ($b * 100) . '';
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"action":"' . $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 . '","nickName":"' . $slotSettings->username . '","currency":"' . $slotSettings->slotCurrency . '","Credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"Denom":' . ($slotSettings->CurrentDenom * 100) . '}';
                    break;
                case 'Act41':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    $_obf_0D030E023B24273D231A270A343212362F2140160E0832 = [];
                    $_obf_0D030E023B24273D231A270A343212362F2140160E0832[] = '' . ($slotSettings->CurrentDenom * 100) . '';
                    foreach( $slotSettings->Denominations as $b ) 
                    {
                        $_obf_0D030E023B24273D231A270A343212362F2140160E0832[] = '' . ($b * 100) . '';
                    }
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = floor(sprintf('%01.2f', $slotSettings->GetBalance()));
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"action":"' . $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 . '","nickName":"' . $slotSettings->username . '","currency":"' . $slotSettings->slotCurrency . '","Credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '}';
                    break;
                case 'Act18':
                    if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['reqDat']) ) 
                    {
                        $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = 'Act19';
                        $lines = 50;
                        $betline = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['reqDat']['bet'];
                        $allbet = $betline * $lines;
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['reqDat']['freegamesMode'] == 'true' ) 
                        {
                            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                        }
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' && $allbet < 1 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Invalid Bet "}';
                            exit( $response );
                        }
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' && $slotSettings->GetBalance() < $allbet ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Invalid Balance"}';
                            exit( $response );
                        }
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Invalid Bonus State"}';
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
                            $bonusMpl = 1;
                        }
                        $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $allbet, $lines);
                        $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                        $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                        $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = floor(sprintf('%01.2f', $slotSettings->GetBalance()));
                        for( $i = 0; $i <= 2000; $i++ ) 
                        {
                            $totalWin = 0;
                            $lineWins = [];
                            $cWins = [];
                            $_obf_0D243D303F2535360506093008312D1A1A5B022D070232 = [];
                            $_obf_0D11393B38130D38112E2A01373F0A5C34211932123911 = [];
                            $wild = ['0'];
                            $scatter = '10';
                            $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                            {
                                $wild = [
                                    '0', 
                                    '10', 
                                    '11'
                                ];
                            }
                            $k = 0;
                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '';
                            for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                            {
                                $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = (string)$slotSettings->SymbolGame[$j];
                                if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $scatter || !isset($slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132]) ) 
                                {
                                }
                                else
                                {
                                    $_obf_0D043E0C2F28130E1C141403401A17012B293622292C32 = true;
                                    $_obf_0D1A191716130D02332C0A1C3C2E161E190D401E140B22 = [];
                                    $_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22 = [];
                                    $_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22['reel1'] = [
                                        0, 
                                        0, 
                                        0
                                    ];
                                    $_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22['reel2'] = [
                                        0, 
                                        0, 
                                        0
                                    ];
                                    $_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22['reel3'] = [
                                        0, 
                                        0, 
                                        0
                                    ];
                                    $_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22['reel4'] = [
                                        0, 
                                        0, 
                                        0
                                    ];
                                    $_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22['reel5'] = [
                                        0, 
                                        0, 
                                        0
                                    ];
                                    $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22 = [
                                        0, 
                                        0, 
                                        0, 
                                        0, 
                                        0, 
                                        0
                                    ];
                                    $_obf_0D3F1A223006131B3F07030A02261817182A060F1A0511 = 1;
                                    for( $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622 = 1; $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622 <= 5; $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622++ ) 
                                    {
                                        $_obf_0D043E0C2F28130E1C141403401A17012B293622292C32 = false;
                                        for( $rs = 0; $rs <= 2; $rs++ ) 
                                        {
                                            if( $reels['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][$rs] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($reels['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][$rs], $wild) ) 
                                            {
                                                $_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][$rs] = -1;
                                                $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[$_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622]++;
                                                $_obf_0D043E0C2F28130E1C141403401A17012B293622292C32 = true;
                                                if( in_array($reels['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][$rs], $wild) ) 
                                                {
                                                    $_obf_0D3F1A223006131B3F07030A02261817182A060F1A0511 = 2;
                                                }
                                            }
                                        }
                                        if( !$_obf_0D043E0C2F28130E1C141403401A17012B293622292C32 ) 
                                        {
                                            break;
                                        }
                                    }
                                    $_obf_0D0E141F34210C271834013D060623402816092A400E11 = 0;
                                    $_obf_0D112E082E2B040D3331180A1E193C36362B362B2F3201 = 1;
                                    if( $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] > 0 ) 
                                    {
                                        $_obf_0D0E141F34210C271834013D060623402816092A400E11 = ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][2] * $betline * $bonusMpl) * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] * $_obf_0D3F1A223006131B3F07030A02261817182A060F1A0511;
                                        if( $_obf_0D0E141F34210C271834013D060623402816092A400E11 > 0 ) 
                                        {
                                            $_obf_0D243D303F2535360506093008312D1A1A5B022D070232[$k] = '[' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . ',' . $_obf_0D0E141F34210C271834013D060623402816092A400E11 . ',' . $slotSettings->GetSymPositions($_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22) . ',' . $_obf_0D3F1A223006131B3F07030A02261817182A060F1A0511 . ']';
                                        }
                                        $_obf_0D112E082E2B040D3331180A1E193C36362B362B2F3201 = $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2];
                                    }
                                    if( $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] > 0 ) 
                                    {
                                        $_obf_0D0E141F34210C271834013D060623402816092A400E11 = ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $betline * $bonusMpl) * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] * $_obf_0D3F1A223006131B3F07030A02261817182A060F1A0511;
                                        if( $_obf_0D0E141F34210C271834013D060623402816092A400E11 > 0 ) 
                                        {
                                            $_obf_0D243D303F2535360506093008312D1A1A5B022D070232[$k] = '[' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . ',' . $_obf_0D0E141F34210C271834013D060623402816092A400E11 . ',' . $slotSettings->GetSymPositions($_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22) . ',' . $_obf_0D3F1A223006131B3F07030A02261817182A060F1A0511 . ']';
                                        }
                                        $_obf_0D112E082E2B040D3331180A1E193C36362B362B2F3201 = $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3];
                                    }
                                    if( $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[4] > 0 ) 
                                    {
                                        $_obf_0D0E141F34210C271834013D060623402816092A400E11 = ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $betline * $bonusMpl) * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[4] * $_obf_0D3F1A223006131B3F07030A02261817182A060F1A0511;
                                        if( $_obf_0D0E141F34210C271834013D060623402816092A400E11 > 0 ) 
                                        {
                                            $_obf_0D243D303F2535360506093008312D1A1A5B022D070232[$k] = '[' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . ',' . $_obf_0D0E141F34210C271834013D060623402816092A400E11 . ',' . $slotSettings->GetSymPositions($_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22) . ',' . $_obf_0D3F1A223006131B3F07030A02261817182A060F1A0511 . ']';
                                        }
                                        $_obf_0D112E082E2B040D3331180A1E193C36362B362B2F3201 = $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[4];
                                    }
                                    if( $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[4] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[5] > 0 ) 
                                    {
                                        $_obf_0D0E141F34210C271834013D060623402816092A400E11 = ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $betline * $bonusMpl) * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[4] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[5] * $_obf_0D3F1A223006131B3F07030A02261817182A060F1A0511;
                                        if( $_obf_0D0E141F34210C271834013D060623402816092A400E11 > 0 ) 
                                        {
                                            $_obf_0D243D303F2535360506093008312D1A1A5B022D070232[$k] = '[' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . ',' . $_obf_0D0E141F34210C271834013D060623402816092A400E11 . ',' . $slotSettings->GetSymPositions($_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22) . ',' . $_obf_0D3F1A223006131B3F07030A02261817182A060F1A0511 . ']';
                                        }
                                        $_obf_0D112E082E2B040D3331180A1E193C36362B362B2F3201 = $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[4] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[5];
                                    }
                                    if( $_obf_0D0E141F34210C271834013D060623402816092A400E11 > 0 ) 
                                    {
                                        if( $_obf_0D112E082E2B040D3331180A1E193C36362B362B2F3201 == 0 ) 
                                        {
                                            $_obf_0D112E082E2B040D3331180A1E193C36362B362B2F3201 = 1;
                                        }
                                        $_obf_0D11393B38130D38112E2A01373F0A5C34211932123911[$k] = $bonusMpl;
                                        $cWins[$k] = $_obf_0D0E141F34210C271834013D060623402816092A400E11 / $bonusMpl;
                                        $totalWin += $_obf_0D0E141F34210C271834013D060623402816092A400E11;
                                        $k++;
                                    }
                                }
                            }
                            $scattersWin = 0;
                            $scattersStr = '';
                            $scattersCount = 0;
                            $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 = 0;
                            $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [];
                            $_obf_0D17160E2B291A250538092F25013526223F0C272E2122 = [
                                0, 
                                1, 
                                2, 
                                4, 
                                8, 
                                16
                            ];
                            $_obf_0D2A1A1436081428181B16162627402D15343833242D32 = [];
                            $_obf_0D2A1A1436081428181B16162627402D15343833242D32['reel1'] = [
                                0, 
                                0, 
                                0
                            ];
                            $_obf_0D2A1A1436081428181B16162627402D15343833242D32['reel2'] = [
                                0, 
                                0, 
                                0
                            ];
                            $_obf_0D2A1A1436081428181B16162627402D15343833242D32['reel3'] = [
                                0, 
                                0, 
                                0
                            ];
                            $_obf_0D2A1A1436081428181B16162627402D15343833242D32['reel4'] = [
                                0, 
                                0, 
                                0
                            ];
                            $_obf_0D2A1A1436081428181B16162627402D15343833242D32['reel5'] = [
                                0, 
                                0, 
                                0
                            ];
                            for( $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622 = 1; $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622 <= 5; $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622++ ) 
                            {
                                for( $rs = 0; $rs <= 2; $rs++ ) 
                                {
                                    if( $reels['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][$rs] == '10' || $reels['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][$rs] == '11' ) 
                                    {
                                        $_obf_0D2A1A1436081428181B16162627402D15343833242D32['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][$rs] = -1;
                                        $scattersCount++;
                                    }
                                }
                            }
                            $scattersWin = $slotSettings->Paytable['SYM_' . $scatter][$scattersCount] * $allbet * $bonusMpl;
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
                        }
                        else
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                        }
                        $fs = 0;
                        $_obf_0D271526050C14371508061C1D40060F233C35263B3B01 = 0;
                        $_obf_0D2722011B2C34273F323035330D123F2706282E131932 = 0;
                        if( $scattersCount >= 3 ) 
                        {
                            if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                            {
                                $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $slotSettings->slotFreeCount[$scattersCount]);
                            }
                            else
                            {
                                $_obf_0D292D0A090D1508062B052B1101321D29243405020D11 = floor(sprintf('%01.2f', $slotSettings->GetBalance()));
                                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $_obf_0D292D0A090D1508062B052B1101321D29243405020D11);
                                $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                                $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount[$scattersCount]);
                            }
                            $fs = $slotSettings->slotFreeCount[$scattersCount];
                            $_obf_0D271526050C14371508061C1D40060F233C35263B3B01 = 1;
                        }
                        $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                        $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                        $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"FreeBalance":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance') . ',"scattersWin":' . $scattersWin . ',"swm":' . $_obf_0D2722011B2C34273F323035330D123F2706282E131932 . ',"fsnew":' . $fs . ',"fscount":' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . ',"slotLines":' . $lines . '' . $lines . ',"spinWins":[' . implode(',', $_obf_0D243D303F2535360506093008312D1A1A5B022D070232) . '],"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"Jackpots":[],"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                        $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['payload'] = $response;
                    }
                    else
                    {
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
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->FreeBalance);
                            $reels = $lastEvent->serverResponse->reelsSymbols;
                            $lines = $lastEvent->serverResponse->slotLines;
                            $bet = $lastEvent->serverResponse->slotBet * 100;
                            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['payload'] = $lastEvent;
                        }
                        $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = floor(sprintf('%01.2f', $slotSettings->GetBalance()));
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"action":"' . $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 . '","serverResponse":' . json_encode($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822) . ',"nickName":"' . $slotSettings->username . '","currency":"' . $slotSettings->slotCurrency . '","Credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"Denom":' . ($slotSettings->CurrentDenom * 100) . '}';
                    break;
            }
            $response = $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0];
            $slotSettings->SaveGameData();
            \DB::commit();
            return ':::' . $response;
        }
    }

}
