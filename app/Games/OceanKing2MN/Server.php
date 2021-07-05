<?php 
namespace VanguardLTE\Games\OceanKing2MN
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
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
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
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"action":"' . $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 . '","nickName":"' . $slotSettings->username . '","currency":"' . $slotSettings->slotCurrency . '","Credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '}';
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
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32 = [];
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[1] = 2;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[2] = 0;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[3] = 3;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[4] = 4;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[5] = 5;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[6] = 6;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[7] = 7;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[8] = 8;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[9] = 9;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[10] = 10;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[11] = 12;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[12] = 15;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[13] = 18;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[14] = 20;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[15] = 22;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[16] = 30;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[17] = 30;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[18] = 30;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[19] = 40;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[20] = 50;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[21] = 50;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[22] = 50;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[23] = 100;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[24] = 100;
                    $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[25] = 150;
                    if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['reqDat']) ) 
                    {
                        $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = 'Act19';
                        $hits = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['reqDat']['hits'];
                        $lose = false;
                        for( $i = 0; $i < 2000; $i++ ) 
                        {
                            $allbet = 0;
                            $totalWin = 0;
                            $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                            foreach( $hits as $key => $hit ) 
                            {
                                $fishType = $hit['fishType'];
                                $bet = $hit['bet'];
                                $_obf_0D362832171714063F2F145B3E251F362B012122193D32 = 0;
                                if( !isset($_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[$fishType]) ) 
                                {
                                    $_obf_0D362832171714063F2F145B3E251F362B012122193D32 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['reqDat']['hits'][$key]['win'];
                                }
                                else
                                {
                                    $_obf_0D362832171714063F2F145B3E251F362B012122193D32 = $_obf_0D12350C2F3F39371E1E3F2A1E0736130C0D0E19071E32[$fishType] * $bet;
                                }
                                if( $_obf_0D362832171714063F2F145B3E251F362B012122193D32 != $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['reqDat']['hits'][$key] ) 
                                {
                                    $_obf_0D362832171714063F2F145B3E251F362B012122193D32 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['reqDat']['hits'][$key]['win'];
                                }
                                if( $lose ) 
                                {
                                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['reqDat']['hits'][$key]['win'] = 0;
                                    $_obf_0D362832171714063F2F145B3E251F362B012122193D32 = 0;
                                }
                                $totalWin += $_obf_0D362832171714063F2F145B3E251F362B012122193D32;
                                $allbet += $bet;
                            }
                            if( $totalWin <= $bank ) 
                            {
                                break;
                            }
                            if( $i > 100 ) 
                            {
                                $lose = true;
                            }
                        }
                        if( $allbet < 0.0001 || $slotSettings->GetBalance() < $allbet ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"bet","serverResponse":"invalid bet state"}';
                            exit( $response );
                        }
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $allbet / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                        $slotSettings->UpdateJackpots($allbet);
                        $slotSettings->SetBalance(-1 * $allbet, 'bet');
                        if( $totalWin > 0 ) 
                        {
                            $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                            $slotSettings->SetBalance($totalWin);
                        }
                        $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = '{"dealerCard":"","gambleState":"","totalWin":' . $totalWin . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '}';
                        $response = '{"responseEvent":"gambleResult","serverResponse":' . $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 . '}';
                        $slotSettings->SaveLogReport($response, $allbet, 1, $totalWin, 'bet');
                    }
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = floor(sprintf('%01.2f', $slotSettings->GetBalance()));
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"action":"' . $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 . '","hits":' . json_encode($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822) . ',"nickName":"' . $slotSettings->username . '","currency":"' . $slotSettings->slotCurrency . '","Credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '}';
                    break;
            }
            $response = $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0];
            $slotSettings->SaveGameData();
            \DB::commit();
            return ':::' . $response;
        }
    }

}
