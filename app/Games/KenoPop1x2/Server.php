<?php 
namespace VanguardLTE\Games\KenoPop1x2
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
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = '';
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] == 'bet' ) 
            {
                $lines = 1;
                $betline = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['stake'] / 100;
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
                if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet']['bonus'] == 'true' ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }
            }
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = (string)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'];
            switch( $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 ) 
            {
                case 'setup':
                    if( $slotSettings->Bet[0] < 0.1 ) 
                    {
                        $slotSettings->Bet[0] = 0.1;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = "\r\n<xml>\r\n<gamevalues maxStake='" . array_pop($slotSettings->Bet) . '\' minStake=\'' . $slotSettings->Bet[0] . "' maxPayout='10000' percentage='5.5'/>\r\n\r\n<variables totalBalls='80' numBallsDrawn='20' maxBallsSelected='15' />\r\n<odds odds1='0,3.5,0,0,0,0,0,0,0,0,0,0,0,0,0,0'  odds2='0,1,9.5,0,0,0,0,0,0,0,0,0,0,0,0,0'  odds3='0,1,2,18,0,0,0,0,0,0,0,0,0,0,0,0'  odds4='0,0.5,2,6,18,0,0,0,0,0,0,0,0,0,0,0'  odds5='0,0.5,1,3,16,50,0,0,0,0,0,0,0,0,0,0'  odds6='0,0.5,1,2,4,24,70,0,0,0,0,0,0,0,0,0'  odds7='0,0.5,0.5,1,5,16,50,250,0,0,0,0,0,0,0,0'  odds8='0,0.5,0.5,1,3,7,20,80,750,0,0,0,0,0,0,0'  odds9='0,0.5,0.5,1,2,4,10,25,60,1250,0,0,0,0,0,0'  odds10='0,0,0.5,1,2,3,5,10,20,200,1600,0,0,0,0,0'  odds11='0,0,0.5,1,1,2.5,4,8,16,150,800,2500,0,0,0,0'  odds12='0,0,0,1,1,2,4,8,12,120,400,1500,4000,0,0,0'  odds13='0,0,0,0.5,1,2,4,6,10,60,150,500,3000,6000,0,0'  odds14='0,0,0,0.5,0.5,2,3,4,8,40,120,400,1000,2000,8000,0'  odds15='0,0,0,0.5,0.5,1.5,2,4,7,25,80,250,500,1000,2500,10000'   />\r\n\r\n</xml>\r\n";
                    break;
                case 'subscribe':
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = [
                        78, 
                        30, 
                        46, 
                        62, 
                        46, 
                        30
                    ];
                    shuffle($_obf_0D21152412095C03222D3808130C3C012907290C181E22);
                    $slotSettings->SetGameData('KenoPop1x2Cards', $_obf_0D21152412095C03222D3808130C3C012907290C181E22);
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData('KenoPop1x2BonusWin', 0);
                    $slotSettings->SetGameData('KenoPop1x2FreeGames', 0);
                    $slotSettings->SetGameData('KenoPop1x2CurrentFreeGame', 0);
                    $slotSettings->SetGameData('KenoPop1x2TotalWin', 0);
                    $slotSettings->SetGameData('KenoPop1x2FreeBalance', 0);
                    if( $lastEvent != 'NULL' ) 
                    {
                        if( isset($lastEvent->serverResponse->bonusWin) ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        }
                        else
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->totalWin);
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $lines = $lastEvent->serverResponse->slotLines;
                        $bet = $lastEvent->serverResponse->slotBet * $lines * 100;
                        $_obf_0D3B3428360D152B3D312F043B1F083E2317380A020511 = 1;
                    }
                    else
                    {
                        $_obf_0D3B3428360D152B3D312F043B1F083E2317380A020511 = 1;
                        $lines = 10;
                    }
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance());
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'start=start&guestID=-400289&minStakeMultiplier=1&maxStakeMultiplier=1&maxLiabilityMultiplier=1&end=end&balance=' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901;
                    break;
                case 'ping':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"sessionKey":"41be9e65e0ff03a65e8c93576bf61130","msg":"success","messageId":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['messageId'] . '","qName":"app.services.messages.response.BaseResponse","command":"ping","eventTimestamp":' . time() . '}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"complex":{"levelI":' . ($slotSettings->slotJackpot[0] * 100) . ',"levelII":' . ($slotSettings->slotJackpot[1] * 100) . ',"levelIII":' . ($slotSettings->slotJackpot[2] * 100) . ',"levelIV":' . ($slotSettings->slotJackpot[3] * 100) . ',"winsLevelI":2,"largestWinLevelI":0,"largestWinDateLevelI":"","largestWinUserLevelI":"","lastWinLevelI":0,"lastWinDateLevelI":"","lastWinUserLevelI":"player","winsLevelII":0,"largestWinLevelII":0,"largestWinDateLevelII":"","largestWinUserLevelII":"","lastWinLevelII":0,"lastWinDateLevelII":"","lastWinUserLevelII":"player","winsLevelIII":0,"largestWinLevelIII":0,"largestWinDateLevelIII":"","largestWinUserLevelIII":"","lastWinLevelIII":0,"lastWinDateLevelIII":"","lastWinUserLevelIII":"","winsLevelIV":0,"largestWinLevelIV":0,"largestWinDateLevelIV":"","largestWinUserLevelIV":"","lastWinLevelIV":0,"lastWinDateLevelIV":"","lastWinUserLevelIV":""},"gameIdentificationNumber":1,"gameNumber":"","msg":"success","messageId":"f73a429df116252e537e403d12bcdb92","qName":"app.services.messages.response.GameEventResponse","command":"event","eventTimestamp":' . time() . '}';
                    break;
                case 'bet':
                    $lines = 1;
                    $betline = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['stake'] / 100;
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
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    $_obf_0D402106070D223E13013B1213113B3B020B1339223432 = [];
                    for( $b = 0; $b < 80; $b++ ) 
                    {
                        $_obf_0D402106070D223E13013B1213113B3B020B1339223432[] = $b + 1;
                    }
                    $_obf_0D3C3834271210311616273F3E061021381F332C5B3F32 = explode(',', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ballsSelected']);
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        $totalWin = 0;
                        shuffle($_obf_0D402106070D223E13013B1213113B3B020B1339223432);
                        $_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32 = [];
                        $_obf_0D23181031063337230C09392733270E0A082C132E3101 = [];
                        $_obf_0D1B390D1A2A30325C0F27311D3F12213E102F391B1801 = [];
                        for( $a = 0; $a < 20; $a++ ) 
                        {
                            $_obf_0D23181031063337230C09392733270E0A082C132E3101[] = $_obf_0D402106070D223E13013B1213113B3B020B1339223432[$a];
                            $_obf_0D1B390D1A2A30325C0F27311D3F12213E102F391B1801[] = '<b num=\'' . $_obf_0D402106070D223E13013B1213113B3B020B1339223432[$a] . '\'/>';
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
                    $slotSettings->SetGameData('KenoPop1x2TotalWin', $totalWin);
                    $slotSettings->SetGameData('KenoPop1x2GambleStep', 5);
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = $slotSettings->GetGameData('KenoPop1x2Cards');
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '<xml><betPlaced  errorCode=\'0\'  error_description=\'\' errorIn=\'PLACE\'/><ballsDrawn>' . implode('', $_obf_0D1B390D1A2A30325C0F27311D3F12213E102F391B1801) . '</ballsDrawn><ballsMatched num=\'' . count($_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32) . '\' balls=\'' . implode(',', $_obf_0D023B1001185C212335253B1E163B372B1D1D1B1D1F32) . '\'/><return  amount=\'' . ($totalWin * 100) . '\'/><newBalance  amount=\'' . ($totalWin * 100 - ($allbet * 100)) . '\' /><message show=\'false\' ></message></xml>';
                    break;
            }
            $response = $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0];
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
