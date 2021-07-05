<?php 
namespace VanguardLTE\Games\DuckyPowerBallKenoRS
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
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = $_REQUEST;
            $_obf_0D161439113311380C071A242B02031E1E233E37400432 = json_decode(trim(file_get_contents('php://input')), true);
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = '';
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] == 'get' ) 
            {
                $slotSettings->CurrentDenom = $slotSettings->GetGameData('DuckyPowerBallKenoRSCurrentDenom');
                $gameData = json_decode(trim(file_get_contents('php://input')), true);
                $lines = 10;
                $betline = $gameData['bet'];
                $line = $gameData['line'];
                if( $lines <= 0 || $betline <= 0.0001 || $line < 2 || $line > 10 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid bet state"}';
                    exit( $response );
                }
                if( $slotSettings->GetBalance() < ($lines * $betline) ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid balance"}';
                    exit( $response );
                }
            }
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = (string)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'];
            switch( $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 ) 
            {
                case 'init':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = [];
                    foreach( $slotSettings->Bet as $b ) 
                    {
                        if( $b >= 0.1 ) 
                        {
                            $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[] = $b;
                        }
                    }
                    $dkf = $_obf_0D161439113311380C071A242B02031E1E233E37400432['dkf'];
                    if( $dkf > 500 || $dkf < 1 ) 
                    {
                        $dkf = 100;
                    }
                    $slotSettings->CurrentDenom = $dkf / 100;
                    $slotSettings->SetGameData('DuckyPowerBallKenoRSCurrentDenom', $slotSettings->CurrentDenom);
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"result":{"spin":null,"message":[],"free_spin":null,"extra":{"total_win":0,"subgame":0,"spin_id":null,"line":1,"game":"k_dpk","double_step":0,"dkf":1,"dealer_card":null,"bet":1},"currency":"' . $slotSettings->slotCurrency . '","credits":' . ceil($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 / 100) . ',"bets":null,"balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"error":null,"code":200}';
                    break;
                case 'GetBalance':
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"Status":{"ErrCode":0,"InitialErrCode":0,"ErrType":0,"UniqueErrorCode":0,"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"RoundsLeft":0}}';
                    break;
                case 'get':
                    $dkf = $_obf_0D161439113311380C071A242B02031E1E233E37400432['dkf'];
                    $slotSettings->CurrentDenom = $slotSettings->GetGameData('DuckyPowerBallKenoRSCurrentDenom');
                    $slotSettings->SetGameData('DuckyPowerBallKenoRSCurrentDenom', $slotSettings->CurrentDenom);
                    $lines = 10;
                    $betline = $gameData['bet'];
                    $line = $gameData['line'];
                    $allbet = $betline * $lines;
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                    {
                        if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                        {
                            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                        }
                        $slotSettings->SetBalance(-1 * $allbet, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $allbet / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $slotSettings->UpdateJackpots($allbet);
                    }
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                    $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    $_obf_0D402106070D223E13013B1213113B3B020B1339223432 = [];
                    for( $b = 0; $b < 80; $b++ ) 
                    {
                        $_obf_0D402106070D223E13013B1213113B3B020B1339223432[] = $b + 1;
                    }
                    shuffle($_obf_0D402106070D223E13013B1213113B3B020B1339223432);
                    $_obf_0D3C3834271210311616273F3E061021381F332C5B3F32 = [];
                    for( $_obf_0D291C1D0F231F32400D22341717273D222C221D312D01 = 0; $_obf_0D291C1D0F231F32400D22341717273D222C221D312D01 < $line; $_obf_0D291C1D0F231F32400D22341717273D222C221D312D01++ ) 
                    {
                        $_obf_0D3C3834271210311616273F3E061021381F332C5B3F32[] = $_obf_0D402106070D223E13013B1213113B3B020B1339223432[$_obf_0D291C1D0F231F32400D22341717273D222C221D312D01];
                    }
                    for( $i = 0; $i <= 5000; $i++ ) 
                    {
                        $totalWin = 0;
                        shuffle($_obf_0D402106070D223E13013B1213113B3B020B1339223432);
                        $_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32 = [];
                        $_obf_0D23181031063337230C09392733270E0A082C132E3101 = [];
                        $_obf_0D1B390D1A2A30325C0F27311D3F12213E102F391B1801 = [];
                        $_obf_0D2B070140362E25191E0118103C240E1E3D15332C3C32 = [];
                        $_obf_0D3506350B3F5C1F3808271C0A225C263D180239282F22 = [];
                        $_obf_0D293B312C25090D333E040F1C342634082B3F03132632 = 0;
                        for( $a = 0; $a < 20; $a++ ) 
                        {
                            $_obf_0D23181031063337230C09392733270E0A082C132E3101[] = $_obf_0D402106070D223E13013B1213113B3B020B1339223432[$a];
                        }
                        shuffle($_obf_0D402106070D223E13013B1213113B3B020B1339223432);
                        $_obf_0D2B070140362E25191E0118103C240E1E3D15332C3C32[0] = $_obf_0D402106070D223E13013B1213113B3B020B1339223432[0];
                        $_obf_0D2B070140362E25191E0118103C240E1E3D15332C3C32[1] = $_obf_0D402106070D223E13013B1213113B3B020B1339223432[1];
                        $_obf_0D2B070140362E25191E0118103C240E1E3D15332C3C32[2] = $_obf_0D402106070D223E13013B1213113B3B020B1339223432[2];
                        for( $b = 0; $b < count($_obf_0D3C3834271210311616273F3E061021381F332C5B3F32); $b++ ) 
                        {
                            $_obf_0D1A3F0E1B04392B2C0B2316053D1C34213D5C05270332 = $_obf_0D3C3834271210311616273F3E061021381F332C5B3F32[$b];
                            if( in_array($_obf_0D1A3F0E1B04392B2C0B2316053D1C34213D5C05270332, $_obf_0D23181031063337230C09392733270E0A082C132E3101) ) 
                            {
                                $_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32[] = $_obf_0D1A3F0E1B04392B2C0B2316053D1C34213D5C05270332;
                            }
                        }
                        $_obf_0D380A3009360712151E3F061D320E3E05360D0C1F2A32 = $slotSettings->Paytable[count($_obf_0D3C3834271210311616273F3E061021381F332C5B3F32)];
                        $_obf_0D293B312C25090D333E040F1C342634082B3F03132632 = $_obf_0D380A3009360712151E3F061D320E3E05360D0C1F2A32[count($_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32)];
                        $totalWin = $betline * $_obf_0D380A3009360712151E3F061D320E3E05360D0C1F2A32[count($_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32)];
                        $_obf_0D5C2D5B3904171D060434330831162E3B0D110E381C32 = [
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            2, 
                            2
                        ];
                        shuffle($_obf_0D5C2D5B3904171D060434330831162E3B0D110E381C32);
                        $_obf_0D363C370D023E261A24303D2E031D2C11330A21100E22 = $_obf_0D5C2D5B3904171D060434330831162E3B0D110E381C32[0];
                        if( $_obf_0D363C370D023E261A24303D2E031D2C11330A21100E22 == 2 && $totalWin == 0 ) 
                        {
                            $_obf_0D363C370D023E261A24303D2E031D2C11330A21100E22 = 1;
                        }
                        $totalWin = $totalWin * $_obf_0D363C370D023E261A24303D2E031D2C11330A21100E22;
                        if( $totalWin <= $bank ) 
                        {
                            break;
                        }
                    }
                    $_obf_0D362C401913363E3C1F31375C1E15122923031F290B32 = 'false';
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                        $slotSettings->SetBalance($totalWin);
                        $_obf_0D362C401913363E3C1F31375C1E15122923031F290B32 = 'true';
                    }
                    $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":0,"currentFreeGames":0,"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":0,"totalWin":' . $totalWin . ',"winLines":[],"Jackpots":[],"reelsSymbols":[]}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                    $slotSettings->SetGameData('DuckyPowerBallKenoRSTotalWin', $totalWin);
                    $slotSettings->SetGameData('DuckyPowerBallKenoRSGambleStep', 5);
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = $slotSettings->GetGameData('DuckyPowerBallKenoRSCards');
                    $_obf_0D06030130221315150D181904040D2B2E2C0F27251632 = [];
                    for( $i = 0; $i < count($_obf_0D23181031063337230C09392733270E0A082C132E3101); $i++ ) 
                    {
                        if( in_array($_obf_0D23181031063337230C09392733270E0A082C132E3101[$i], $_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32) ) 
                        {
                            $_obf_0D06030130221315150D181904040D2B2E2C0F27251632[] = '"' . $_obf_0D23181031063337230C09392733270E0A082C132E3101[$i] . '":true';
                        }
                        else
                        {
                            $_obf_0D06030130221315150D181904040D2B2E2C0F27251632[] = '"' . $_obf_0D23181031063337230C09392733270E0A082C132E3101[$i] . '":false';
                        }
                    }
                    for( $i = 0; $i < count($_obf_0D2B070140362E25191E0118103C240E1E3D15332C3C32); $i++ ) 
                    {
                        if( in_array($_obf_0D2B070140362E25191E0118103C240E1E3D15332C3C32[$i], $_obf_0D23181031063337230C09392733270E0A082C132E3101) ) 
                        {
                            $_obf_0D3506350B3F5C1F3808271C0A225C263D180239282F22[] = '"' . $_obf_0D2B070140362E25191E0118103C240E1E3D15332C3C32[$i] . '":true';
                        }
                        else
                        {
                            $_obf_0D3506350B3F5C1F3808271C0A225C263D180239282F22[] = '"' . $_obf_0D2B070140362E25191E0118103C240E1E3D15332C3C32[$i] . '":false';
                        }
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"result":{"spin":{"win_scatters":[],"win_other":[],"win_lines":[],"win":' . $totalWin . ',"total_win":' . $totalWin . ',"respin":null,"reels_add":null,"reels":[' . count($_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32) . ',' . $_obf_0D363C370D023E261A24303D2E031D2C11330A21100E22 . '],"hotswap":null,"freegames":null,"extra":{},"e":"","bonus3":null,"bonus2":null,"bonus1":null},"message":[],"free_spin":null,"extra":{"total_win":0,"subgame":0,"spin_id":51288850063,"line":' . $line . ',"game":"k_dpk","double_step":0,"dkf":100,"dealer_card":null,"bet":1},"currency":"' . $slotSettings->slotCurrency . '","credits":' . ceil($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 / 100) . ',"bets":null,"balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"error":null,"code":200}';
                    break;
                case 'take':
                    $gameData = json_decode(trim(file_get_contents('php://input')), true);
                    $lines = 10;
                    $betline = $gameData['bet'];
                    $line = $gameData['line'];
                    $dkf = $_obf_0D161439113311380C071A242B02031E1E233E37400432['dkf'];
                    $slotSettings->CurrentDenom = $slotSettings->GetGameData('DuckyPowerBallKenoRSCurrentDenom');
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"result":{"spin":null,"message":[],"free_spin":null,"extra":{"total_win":0,"subgame":0,"spin_id":null,"line":' . $line . ',"game":"k_dpk","double_step":0,"dkf":' . $dkf . ',"dealer_card":null,"bet":1},"currency":"' . $slotSettings->slotCurrency . '","credits":' . ceil($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 / 100) . ',"bets":null,"balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"error":null,"code":200}';
                    break;
            }
            if( !isset($_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0]) ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"Invalid request state"}';
                exit( $response );
            }
            $response = $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0];
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
