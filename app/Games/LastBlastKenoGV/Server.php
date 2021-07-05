<?php 
namespace VanguardLTE\Games\LastBlastKenoGV
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
            $_obf_0D2D2A5B402B161C092D26140A013213350315120F3922 = json_decode(trim(file_get_contents('php://input')), true);
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = [];
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] = $_obf_0D2D2A5B402B161C092D26140A013213350315120F3922['gameData'][0];
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = '';
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] == 'draw' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] = 'bet';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] == 'bet' ) 
            {
                $lines = 1;
                $betline = $_obf_0D2D2A5B402B161C092D26140A013213350315120F3922['gameData'][1]['bet'];
                if( $lines <= 0 || $betline <= 0.0001 ) 
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
                case 'setup':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '40';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '40/game';
                    break;
                case 'open':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    $_obf_0D030E023B24273D231A270A343212362F2140160E0832 = [];
                    $_obf_0D030E023B24273D231A270A343212362F2140160E0832[] = '' . ($slotSettings->CurrentDenom * 100) . '';
                    foreach( $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 as &$b ) 
                    {
                        $b = '' . ($b * 100) . '';
                    }
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance());
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '42/game,["open",{"bet":{"denoms":[5,10,25,50,100],"bets":[1,2,3,4,5,6,7,8,9,10]},"paytable":[[null],[null],[null],[null,0,2,28],[null,0,1,5,67],[null,0,0,2,21,240],[null,0,0,1,5,70,510],[null,0,0,1,2,15,160,1000],[null,0,0,0,2,7,48,630,1250],[null,0,0,0,1,4,22,170,855,1250],[null,0,0,0,1,2,7,50,560,1100,1250]],"rows":8,"columns":10,"picks":10,"rtp":0.9165,"credits":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '}]';
                    break;
                case 'bet':
                    $lines = 1;
                    $betline = $_obf_0D2D2A5B402B161C092D26140A013213350315120F3922['gameData'][1]['bet'];
                    $allbet = $betline * $lines;
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
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
                    $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    $_obf_0D402106070D223E13013B1213113B3B020B1339223432 = [];
                    for( $b = 0; $b < 80; $b++ ) 
                    {
                        $_obf_0D402106070D223E13013B1213113B3B020B1339223432[] = $b + 1;
                    }
                    $_obf_0D3C3834271210311616273F3E061021381F332C5B3F32 = $_obf_0D2D2A5B402B161C092D26140A013213350315120F3922['gameData'][1]['selected'];
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        $_obf_0D39310F11122D4033102C0B1E0408262D130A2F220A11 = 'false';
                        $totalWin = 0;
                        shuffle($_obf_0D402106070D223E13013B1213113B3B020B1339223432);
                        $_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32 = [];
                        $_obf_0D23181031063337230C09392733270E0A082C132E3101 = [];
                        for( $a = 0; $a < 20; $a++ ) 
                        {
                            $_obf_0D23181031063337230C09392733270E0A082C132E3101[] = $_obf_0D402106070D223E13013B1213113B3B020B1339223432[$a];
                        }
                        for( $b = 0; $b < count($_obf_0D3C3834271210311616273F3E061021381F332C5B3F32); $b++ ) 
                        {
                            $_obf_0D1A3F0E1B04392B2C0B2316053D1C34213D5C05270332 = $_obf_0D3C3834271210311616273F3E061021381F332C5B3F32[$b];
                            if( in_array($_obf_0D1A3F0E1B04392B2C0B2316053D1C34213D5C05270332, $_obf_0D23181031063337230C09392733270E0A082C132E3101) ) 
                            {
                                $_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32[] = $_obf_0D1A3F0E1B04392B2C0B2316053D1C34213D5C05270332;
                            }
                        }
                        $_obf_0D380A3009360712151E3F061D320E3E05360D0C1F2A32 = $slotSettings->Paytable[count($_obf_0D3C3834271210311616273F3E061021381F332C5B3F32)];
                        $totalWin = $betline * $_obf_0D380A3009360712151E3F061D320E3E05360D0C1F2A32[count($_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32)];
                        if( in_array($_obf_0D23181031063337230C09392733270E0A082C132E3101[19], $_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32) ) 
                        {
                            $_obf_0D39310F11122D4033102C0B1E0408262D130A2F220A11 = 'true';
                            $totalWin = $totalWin * 4;
                        }
                        if( $totalWin <= $bank ) 
                        {
                            break;
                        }
                    }
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                        $slotSettings->SetBalance($totalWin);
                    }
                    $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":0,"currentFreeGames":0,"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":0,"totalWin":' . $totalWin . ',"winLines":[],"Jackpots":[],"reelsSymbols":[]}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                    $slotSettings->SetGameData('LastBlastKenoGVTotalWin', $totalWin);
                    $slotSettings->SetGameData('LastBlastKenoGVGambleStep', 5);
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = $slotSettings->GetGameData('LastBlastKenoGVCards');
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance());
                    $_obf_0D261F29122C223C191815043004292B04401F280B0601 = 'turtles: [57, 61, 11, 1]';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '42/game,["draw",{"draw":[' . implode(',', $_obf_0D23181031063337230C09392733270E0A082C132E3101) . '],"picks":[' . implode(',', $_obf_0D3C3834271210311616273F3E061021381F332C5B3F32) . '],"catches":[' . implode(',', $_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32) . '],"win":' . $totalWin . ',"guaranteedWin":true,"luckySymbol":0,"numBonusGames":5,"multiplier":6,"numPicks":6,"totalWon":' . $totalWin . ',"bonus":{},"powerhit":' . $_obf_0D39310F11122D4033102C0B1E0408262D130A2F220A11 . ',"_win":' . $totalWin . ',"_close":true,"_cost":' . count($_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32) . ',"credits":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '}]';
                    break;
            }
            $response = implode('------:::', $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01);
            $slotSettings->SaveGameData();
            \DB::commit();
            return ':::' . $response;
        }
    }

}
