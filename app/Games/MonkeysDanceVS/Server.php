<?php 
namespace VanguardLTE\Games\MonkeysDanceVS
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
            if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gameData']) ) 
            {
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                return 'Balance:' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901;
            }
            $_obf_0D2D2A5B402B161C092D26140A013213350315120F3922 = explode('&', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gameData']);
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = [];
            foreach( $_obf_0D2D2A5B402B161C092D26140A013213350315120F3922 as $vl ) 
            {
                $tmp = explode('=', $vl);
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[$tmp[0]] = $tmp[1];
            }
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = '';
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = (string)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'];
            switch( $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 ) 
            {
                case 'QRY_CHECK':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"status":"OK","for":"QRY_CHECK","device":"S4617","login":"user","username":"","firstname":"","lastname":"CARD_4116078299570565","usejp":1,"forward":"e1","game":"00050070","credit":{"tot":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"account":{"tot":0}}';
                    break;
                case 'LOGIN':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"status":"OK","authtoken":"1/90317550781670648058","for":"LOGIN","device":"S4617","bookamount":{"tot":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"login":"user","username":"","firstname":"","lastname":"CARD_4116078299570565","usejp":1,"forward":"e1","games":[],"credit":{"tot":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"account":{"tot":0}}';
                    break;
                case 'GETJPCFG':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"status":"OK","authtoken":"1/90317550853820105222","for":"GETJPCFG","noof":3,"jps":[{"mjpid":"MC_BON/1","cfgflags":4,"dispslot":1,"name":"Maxi Bonus","textname":"Maxi Pot","bgpic":"diabon_bg.png","winsnd":"diabon_win"},{"mjpid":"MC_BON/2","cfgflags":4,"dispslot":2,"name":"Midi Bonus","textname":"Midi Pot","bgpic":"groupbon_bg.png","winsnd":"groupbon_win"},{"mjpid":"MC_BON/3","cfgflags":4,"dispslot":3,"name":"Mini Bonus","textname":"Mini Pot","bgpic":"slotbon_bg.png","winsnd":"slotbon_win"}]}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"amsg":"MJPUPD","mjpid":"MC_BON/1","inst":1,"val":' . (int)($slotSettings->jpgs[0]->balance * 100) . ',"flags":4097}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"amsg":"MJPUPD","mjpid":"MC_BON/2","inst":2,"val":' . (int)($slotSettings->jpgs[1]->balance * 100) . ',"flags":4097}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"amsg":"MJPUPD","mjpid":"MC_BON/3","inst":6,"val":' . (int)($slotSettings->jpgs[2]->balance * 100) . ',"flags":4097}';
                    break;
                case 'SELGAME':
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = [
                        78, 
                        30, 
                        46, 
                        62, 
                        46, 
                        30
                    ];
                    shuffle($_obf_0D21152412095C03222D3808130C3C012907290C181E22);
                    $slotSettings->SetGameData('MonkeysDanceVSCards', $_obf_0D21152412095C03222D3808130C3C012907290C181E22);
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    for( $i = 0; $i < count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] * 100 * 10;
                    }
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData('MonkeysDanceVSBonusWin', 0);
                    $slotSettings->SetGameData('MonkeysDanceVSFreeGames', 0);
                    $slotSettings->SetGameData('MonkeysDanceVSCurrentFreeGame', 0);
                    $slotSettings->SetGameData('MonkeysDanceVSTotalWin', 0);
                    $slotSettings->SetGameData('MonkeysDanceVSFreeBalance', 0);
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
                        $_obf_0D3C090E192F3D26100429351F02123B310C3504040132 = $lastEvent->serverResponse->reelsSymbols;
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '[' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel1[0] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel1[1] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel1[2] . '],[' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel2[0] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel2[1] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel2[2] . '],[' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel3[0] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel3[1] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel3[2] . '],[' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel4[0] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel4[1] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel4[2] . '],[' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel5[0] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel5[1] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132->reel5[2] . ']';
                        $lines = $lastEvent->serverResponse->slotLines;
                        $bet = $lastEvent->serverResponse->slotBet * $lines * 100;
                        $_obf_0D3B3428360D152B3D312F043B1F083E2317380A020511 = 1;
                        if( $slotSettings->GetGameData('MonkeysDanceVSCurrentFreeGame') < $slotSettings->GetGameData('MonkeysDanceVSFreeGames') && $slotSettings->GetGameData('MonkeysDanceVSFreeGames') > 0 ) 
                        {
                            $_obf_0D3B3428360D152B3D312F043B1F083E2317380A020511 = 2;
                        }
                    }
                    else
                    {
                        $_obf_0D3B3428360D152B3D312F043B1F083E2317380A020511 = 1;
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '[' . rand(1, 13) . ',' . rand(1, 13) . ',' . rand(1, 13) . '],[' . rand(1, 13) . ',' . rand(1, 13) . ',' . rand(1, 13) . '],[' . rand(1, 13) . ',' . rand(1, 13) . ',' . rand(1, 13) . '],[' . rand(1, 13) . ',' . rand(1, 13) . ',' . rand(1, 13) . '],[' . rand(1, 13) . ',' . rand(1, 13) . ',' . rand(1, 13) . ']';
                        $lines = 10;
                        $bet = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0];
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"status":"OK","authtoken":"1/90317551625226034596","for":"SELGAME","id":"000501d0","inscatwin":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . ',"plsg":' . $slotSettings->GetGameData('MonkeysDanceVSCurrentFreeGame') . ',"totsg":' . $slotSettings->GetGameData('MonkeysDanceVSFreeGames') . ',"dirname":"g_re_neptre","reels":5,"vissym":3,"rno":29719,"gtype":' . $_obf_0D3B3428360D152B3D312F043B1F083E2317380A020511 . ',"credit":{"tot":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"allowedbets":[' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '],"curbet":' . $bet . ',"curlines":' . $lines . ',"scr":[' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . '],"prevsym":[13,8,4,9,13],"nextsym":[13,13,5,2,8],"gtypes":[{"gtype":1,"winlines":10,"midx":400,"wlines":[{"pos":[2,2,2,2,2],"bmp":"winline_01.png","y":279,"frcol":[255,72,72]},{"pos":[1,1,1,1,1],"bmp":"winline_02.png","y":164,"frcol":[0,120,242]},{"pos":[3,3,3,3,3],"bmp":"winline_03.png","y":424,"frcol":[0,242,0]},{"pos":[1,2,3,2,1],"bmp":"winline_04.png","y":129,"frcol":[253,254,0]},{"pos":[3,2,1,2,3],"bmp":"winline_05.png","y":171,"frcol":[202,0,243]},{"pos":[1,1,2,1,1],"bmp":"winline_06.png","y":163,"frcol":[245,135,0]},{"pos":[3,3,2,3,3],"bmp":"winline_07.png","y":294,"frcol":[6,230,252]},{"pos":[2,1,1,1,2],"bmp":"winline_08.png","y":170,"frcol":[57,55,187]},{"pos":[2,3,3,3,2],"bmp":"winline_09.png","y":240,"frcol":[155,100,56]},{"pos":[2,2,1,2,2],"bmp":"winline_10.png","y":166,"frcol":[5,168,9]}],"multiwl":[{"1":[0,1,2,3,4]},{"2":[0,1,2,3,4,5,6,7,8,9]}],"scatfrcol":[174,0,0],"wnl":[4,1,13,0,9,2,7,6,3,5],"wnr":[4,1,13,0,9,2,7,6,3,5],"allx":50,"ally":126,"allbmp":"winlineall_5.png","spin":{"pic10sec":130,"back":30,"backms":180,"backwait":80,"accel":110,"over":35,"breakfrom":-150,"backpct":60},"jokers":[{"sym":1,"winm":2}],"paysyms":[{"sym":1,"m_2":5,"m_3":100,"m_4":2500,"m_5":9000},{"sym":2,"m_3":10,"m_4":40,"m_5":200},{"sym":3,"m_3":10,"m_4":40,"m_5":200},{"sym":4,"m_2":2,"m_3":20,"m_4":80,"m_5":800},{"sym":5,"m_2":2,"m_3":20,"m_4":80,"m_5":800},{"sym":6,"m_3":15,"m_4":75,"m_5":400},{"sym":8,"m_3":5,"m_4":40,"m_5":150},{"sym":9,"m_3":5,"m_4":40,"m_5":150},{"sym":10,"m_3":5,"m_4":20,"m_5":100},{"sym":11,"m_3":5,"m_4":20,"m_5":100},{"sym":12,"m_2":2,"m_3":5,"m_4":20,"m_5":100},{"sym":13,"m_3":5,"m_4":20,"m_5":100}],"scatters":[{"sym":7,"nfrom":5,"ntill":0,"m":500,"m_div":0,"sg":20},{"sym":7,"nfrom":4,"ntill":4,"m":20,"m_div":0,"sg":15},{"sym":7,"nfrom":3,"ntill":3,"m":5,"m_div":0,"sg":10},{"sym":7,"nfrom":2,"ntill":2,"m":2,"m_div":0,"sg":0}]},{"gtype":2,"winlines":10,"winmult":3,"spin":{"pic10sec":130,"back":30,"backms":180,"backwait":80,"accel":110,"over":35,"breakfrom":-150,"backpct":60}}],"sounds":["applause2","gamble2lost","gamble2win1","gamble2win2","gamble2win3","gamble2win4","gamble2win5","scatter_ending","scatter_rovid1","scatter_rovid2","scatter_rovid3","scatter_rovid4","scatter_rovid5","skatter","slidein","win_big1","win_big2","win_big3","win_small1","win_small2","win_small3"],"state":0,"scrfl":[[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0]]}';
                    break;
                case 'GA_SPIN':
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901 = [];
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
                        2, 
                        1, 
                        2
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[6] = [
                        2, 
                        3, 
                        2, 
                        3, 
                        2
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[7] = [
                        1, 
                        2, 
                        1, 
                        2, 
                        1
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[8] = [
                        3, 
                        2, 
                        3, 
                        2, 
                        3
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[9] = [
                        2, 
                        2, 
                        1, 
                        2, 
                        2
                    ];
                    $lines = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['winlines'];
                    $_obf_0D1F292430132C1009140F17162121100D240917270211 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / 100 / $lines;
                    $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / 100;
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    if( $slotSettings->GetGameData('MonkeysDanceVSCurrentFreeGame') < $slotSettings->GetGameData('MonkeysDanceVSFreeGames') && $slotSettings->GetGameData('MonkeysDanceVSFreeGames') > 0 ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                        $slotSettings->SetGameData('MonkeysDanceVSCurrentFreeGame', $slotSettings->GetGameData('MonkeysDanceVSCurrentFreeGame') + 1);
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' ) 
                    {
                        if( $lines <= 0 || $_obf_0D1F292430132C1009140F17162121100D240917270211 <= 0.0001 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bet state"}';
                            exit( $response );
                        }
                        if( $slotSettings->GetBalance() < ($lines * $_obf_0D1F292430132C1009140F17162121100D240917270211) ) 
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
                        $slotSettings->SetBalance(-1 * $_obf_0D34351C331E352827231A38333E1A082713062B2B2732, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $slotSettings->UpdateJackpots($_obf_0D34351C331E352827231A38333E1A082713062B2B2732);
                        $slotSettings->SetGameData('MonkeysDanceVSBonusWin', 0);
                        $slotSettings->SetGameData('MonkeysDanceVSFreeGames', 0);
                        $slotSettings->SetGameData('MonkeysDanceVSCurrentFreeGame', 0);
                        $slotSettings->SetGameData('MonkeysDanceVSTotalWin', 0);
                        $slotSettings->SetGameData('MonkeysDanceVSFreeBalance', 0);
                        $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22 = 1;
                    }
                    else
                    {
                        $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22 = $slotSettings->slotFreeMpl;
                    }
                    $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $_obf_0D34351C331E352827231A38333E1A082713062B2B2732, $lines);
                    $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                    $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        $totalWin = 0;
                        $_obf_0D181C103526150D021B2C0E1A1F211F3F3E2A15363632 = [];
                        $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11 = [
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
                        $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22 = ['1'];
                        $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22 = '7';
                        $_obf_0D3C090E192F3D26100429351F02123B310C3504040132 = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        for( $k = 0; $k < $lines; $k++ ) 
                        {
                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '';
                            for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                            {
                                $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = $slotSettings->SymbolGame[$j];
                                if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22 || !isset($slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132]) ) 
                                {
                                }
                                else
                                {
                                    $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22 = [];
                                    $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel1'][$_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][0] - 1];
                                    $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1] = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel2'][$_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][1] - 1];
                                    $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2] = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel3'][$_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][2] - 1];
                                    $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3] = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel4'][$_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][3] - 1];
                                    $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[4] = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel5'][$_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][4] - 1];
                                    if( ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        }
                                        else if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][2] * $_obf_0D1F292430132C1009140F17162121100D240917270211 * $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 * $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22;
                                        if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"n":' . $k . ',"win":' . ($_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] * 100) . ',"hw":0,"pos":[' . $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][0] . ',' . $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][1] . ',0,0,0],"frame":[0,0,0],"wnl":1,"wnr":1,"snd":"win_big3"}';
                                        }
                                    }
                                    if( ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        }
                                        else if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $_obf_0D1F292430132C1009140F17162121100D240917270211 * $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 * $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22;
                                        if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"n":' . $k . ',"win":' . ($_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] * 100) . ',"hw":0,"pos":[' . $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][0] . ',' . $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][1] . ',' . $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][2] . ',0,0],"frame":[0,0,0],"wnl":1,"wnr":1,"snd":"win_big3"}';
                                        }
                                    }
                                    if( ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        }
                                        else if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $_obf_0D1F292430132C1009140F17162121100D240917270211 * $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 * $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22;
                                        if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"n":' . $k . ',"win":' . ($_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] * 100) . ',"hw":0,"pos":[' . $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][0] . ',' . $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][1] . ',' . $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][2] . ',' . $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][3] . ',0],"frame":[0,0,0],"wnl":1,"wnr":1,"snd":"win_big2"}';
                                        }
                                    }
                                    if( ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[4] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[4], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[4], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        }
                                        else if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[4], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $_obf_0D1F292430132C1009140F17162121100D240917270211 * $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 * $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22;
                                        if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"n":' . $k . ',"win":' . ($_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] * 100) . ',"hw":0,"pos":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][0] - 1) . ',' . $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][1] . ',' . $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][2] . ',' . $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][3] . ',' . $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][4] . '],"frame":[0,0,0],"wnl":1,"wnr":1,"snd":"win_big1"}';
                                        }
                                    }
                                }
                            }
                            if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                            {
                                array_push($_obf_0D181C103526150D021B2C0E1A1F211F3F3E2A15363632, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                                $totalWin += $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k];
                            }
                        }
                        $_obf_0D10342528350D243D16293C2835061F263C1C39042811 = 0;
                        $_obf_0D033835123E051D331E010A3C300C332C34021F052801 = '';
                        $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11 = 0;
                        $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [];
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                            {
                                if( $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '7' ) 
                                {
                                    $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11++;
                                    $_obf_0D312B19262C083426241E0D392E22282324060B380811[] = '[' . ($r - 1) . ',' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . ']';
                                }
                            }
                        }
                        $_obf_0D10342528350D243D16293C2835061F263C1C39042811 = $slotSettings->Paytable['SYM_7'][$_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11] * $_obf_0D34351C331E352827231A38333E1A082713062B2B2732;
                        if( $_obf_0D10342528350D243D16293C2835061F263C1C39042811 > 0 ) 
                        {
                            $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 = 0;
                            if( $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11 >= 3 ) 
                            {
                                $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 = $slotSettings->slotFreeCount;
                            }
                            $_obf_0D033835123E051D331E010A3C300C332C34021F052801 = ',"scatwin":[{"win":' . ($_obf_0D10342528350D243D16293C2835061F263C1C39042811 * 100) . ',"sgwin":' . $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 . ',"hw":0,"spos":[' . implode(',', $_obf_0D312B19262C083426241E0D392E22282324060B380811) . '],"frame":[174,0,0],"snd":"win_big1","ms":1500,"musictime":1}]';
                        }
                        $totalWin += $_obf_0D10342528350D243D16293C2835061F263C1C39042811;
                        if( $i > 1000 ) 
                        {
                            $winType = 'none';
                        }
                        if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($_obf_0D34351C331E352827231A38333E1A082713062B2B2732 * rand(2, 5)) ) 
                        {
                        }
                        else if( !$slotSettings->increaseRTP && $winType == 'win' && $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 < $totalWin ) 
                        {
                        }
                        else
                        {
                            if( $i > 1500 ) 
                            {
                                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                                exit( $response );
                            }
                            if( $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11 >= 3 && $winType != 'bonus' ) 
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
                    $_obf_0D3D1E350E290B165B5B3E2E311A251A332C0D1D073B32 = [
                        4, 
                        7, 
                        10, 
                        13, 
                        16
                    ];
                    $_obf_0D32282F3003310639351F1C3D1D01035C021B011A4032 = [
                        [], 
                        [], 
                        [], 
                        [], 
                        []
                    ];
                    $_obf_0D220D0F140D140C26405C2D0230233F3E0D1B180A2822 = '';
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D220D0F140D140C26405C2D0230233F3E0D1B180A2822 = 'Bonus';
                    }
                    for( $i = 1; $i <= 5; $i++ ) 
                    {
                        $rc = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['rp'][$i - 1];
                        for( $j = 0; $j <= $_obf_0D3D1E350E290B165B5B3E2E311A251A332C0D1D073B32[$i - 1]; $j++ ) 
                        {
                            $rc--;
                            if( $rc < 0 ) 
                            {
                                $rc = count($slotSettings->{'reelStrip' . $_obf_0D220D0F140D140C26405C2D0230233F3E0D1B180A2822 . $i}) - 1;
                            }
                            $_obf_0D32282F3003310639351F1C3D1D01035C021B011A4032[$i - 1][] = $slotSettings->{'reelStrip' . $_obf_0D220D0F140D140C26405C2D0230233F3E0D1B180A2822 . $i}[$rc];
                        }
                        $_obf_0D32282F3003310639351F1C3D1D01035C021B011A4032[$i - 1][] = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel' . $i][2];
                        $_obf_0D32282F3003310639351F1C3D1D01035C021B011A4032[$i - 1][] = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel' . $i][1];
                        $_obf_0D32282F3003310639351F1C3D1D01035C021B011A4032[$i - 1][] = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel' . $i][0];
                    }
                    $_obf_0D020903320A14300C0E3617392F1A2137120A303F0922 = '{"syms":[' . implode(',', $_obf_0D32282F3003310639351F1C3D1D01035C021B011A4032[0]) . ']},{"syms":[' . implode(',', $_obf_0D32282F3003310639351F1C3D1D01035C021B011A4032[1]) . ']},{"syms":[' . implode(',', $_obf_0D32282F3003310639351F1C3D1D01035C021B011A4032[2]) . ']},{"syms":[' . implode(',', $_obf_0D32282F3003310639351F1C3D1D01035C021B011A4032[3]) . ']},{"syms":[' . implode(',', $_obf_0D32282F3003310639351F1C3D1D01035C021B011A4032[4]) . ']}';
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $_obf_0D181C103526150D021B2C0E1A1F211F3F3E2A15363632);
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($_obf_0D3C090E192F3D26100429351F02123B310C3504040132) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"slotLines":' . $lines . ',"slotBet":' . $_obf_0D1F292430132C1009140F17162121100D240917270211 . ',"totalFreeGames":' . $slotSettings->GetGameData('MonkeysDanceVSFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('MonkeysDanceVSCurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData('MonkeysDanceVSBonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($response, $_obf_0D1F292430132C1009140F17162121100D240917270211, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                    $state = '0';
                    $_obf_0D09293E0223293F02113901380A1E353C150F21060832 = '0';
                    if( $totalWin > 0 ) 
                    {
                        $state = '2';
                        $_obf_0D09293E0223293F02113901380A1E353C150F21060832 = '1';
                        $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = ',"winlines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"wlseqms":1500,"wlmusictime":1';
                    }
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = $slotSettings->GetGameData('MonkeysDanceVSCards');
                    $_obf_0D5C30050315032D3D1E3914110A241812070A19102122 = 1;
                    $slotSettings->SetGameData('MonkeysDanceVSBonusStart', 0);
                    if( $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11 >= 3 ) 
                    {
                        if( $slotSettings->GetGameData('MonkeysDanceVSFreeGames') > 0 ) 
                        {
                            $slotSettings->SetGameData('MonkeysDanceVSFreeGames', $slotSettings->GetGameData('MonkeysDanceVSFreeGames') + $slotSettings->slotFreeCount);
                        }
                        else
                        {
                            $slotSettings->SetGameData('MonkeysDanceVSBonusWin', 0);
                            $slotSettings->SetGameData('MonkeysDanceVSBonusStart', 1);
                            $slotSettings->SetGameData('MonkeysDanceVSFreeGames', $slotSettings->slotFreeCount);
                            $_obf_0D5C30050315032D3D1E3914110A241812070A19102122 = 2;
                        }
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $slotSettings->SetGameData('MonkeysDanceVSTotalWin', $totalWin);
                    }
                    else
                    {
                        $slotSettings->SetGameData('MonkeysDanceVSTotalWin', $totalWin);
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D5C30050315032D3D1E3914110A241812070A19102122 = 2;
                        if( $slotSettings->GetGameData('MonkeysDanceVSFreeGames') == $slotSettings->GetGameData('MonkeysDanceVSCurrentFreeGame') ) 
                        {
                            $_obf_0D5C30050315032D3D1E3914110A241812070A19102122 = 1;
                        }
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"status":"OK","authtoken":"1/90317550874224233854","for":"GA_SPIN","rno":29689,"state":' . $state . ',"gtype":2' . $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 . ',"inscatwin":' . ($slotSettings->GetGameData('MonkeysDanceVSBonusWin') * 100) . ',"plsg":' . $slotSettings->GetGameData('MonkeysDanceVSCurrentFreeGame') . ',"totsg":' . $slotSettings->GetGameData('MonkeysDanceVSFreeGames') . ',"noofwl":' . $_obf_0D09293E0223293F02113901380A1E353C150F21060832 . ',"reels":[' . $_obf_0D020903320A14300C0E3617392F1A2137120A303F0922 . '],"nextsym":[9,8,11,12,10],"scrflbef":[[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0]],"scrflaft":[[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0]],"win":' . ($totalWin * 100) . ',"gmblamount":' . ($totalWin * 100) . ',"gmblmayhalf":2,"gmblhalfmin":100,"gmblsnd":"slidein","gmblhist":[' . implode(',', $_obf_0D21152412095C03222D3808130C3C012907290C181E22) . '],"sgwin":0' . $_obf_0D033835123E051D331E010A3C300C332C34021F052801 . ',"gtypeaft":' . $_obf_0D5C30050315032D3D1E3914110A241812070A19102122 . ',"credit":{"tot":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '}}';
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"status":"OK","authtoken":"1/90317550874224233854","for":"GA_SPIN","rno":29083,"state":' . $state . ',"gtype":1,"noofwl":' . $_obf_0D09293E0223293F02113901380A1E353C150F21060832 . ',"animallwinsym":2' . $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 . ',"reels":[' . $_obf_0D020903320A14300C0E3617392F1A2137120A303F0922 . '],"nextsym":[8,1,6,6,6],"scrflbef":[[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0]],"scrflaft":[[0,0,0],[0,0,0],[0,0,0],[0,0,0],[0,0,0]],"win":' . ($totalWin * 100) . ',"sgwin":' . $slotSettings->GetGameData('MonkeysDanceVSFreeGames') . '' . $_obf_0D033835123E051D331E010A3C300C332C34021F052801 . ',"gtypeaft":' . $_obf_0D5C30050315032D3D1E3914110A241812070A19102122 . ',"gmblamount":' . ($totalWin * 100) . ',"gmblmayhalf":2,"gmblhalfmin":100,"gmblsnd":"slidein","gmblhist":[' . implode(',', $_obf_0D21152412095C03222D3808130C3C012907290C181E22) . '],"credit":{"tot":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '}}';
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"amsg":"MJPUPD","mjpid":"MC_BON/1","inst":1,"val":' . (int)($slotSettings->jpgs[0]->balance * 100) . ',"flags":4097}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"amsg":"MJPUPD","mjpid":"MC_BON/2","inst":2,"val":' . (int)($slotSettings->jpgs[1]->balance * 100) . ',"flags":4097}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"amsg":"MJPUPD","mjpid":"MC_BON/3","inst":6,"val":' . (int)($slotSettings->jpgs[2]->balance * 100) . ',"flags":4097}';
                    break;
                case 'GA_TAKE':
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    $_obf_0D3B3428360D152B3D312F043B1F083E2317380A020511 = 1;
                    if( $slotSettings->GetGameData('MonkeysDanceVSCurrentFreeGame') < $slotSettings->GetGameData('MonkeysDanceVSFreeGames') && $slotSettings->GetGameData('MonkeysDanceVSFreeGames') > 0 ) 
                    {
                        $_obf_0D3B3428360D152B3D312F043B1F083E2317380A020511 = 2;
                        $slotSettings->SetGameData('MonkeysDanceVSBonusWin', $slotSettings->GetGameData('MonkeysDanceVSBonusWin') + $slotSettings->GetGameData('MonkeysDanceVSTotalWin'));
                    }
                    $slotSettings->SetGameData('MonkeysDanceVSTotalWin', 0);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"status":"OK","authtoken":"1/90317550919705477001","for":"GA_TAKE","totsg":' . $slotSettings->GetGameData('MonkeysDanceVSFreeGames') . ',"plsg":' . $slotSettings->GetGameData('MonkeysDanceVSCurrentFreeGame') . ',"inscatwin":' . ($slotSettings->GetGameData('MonkeysDanceVSBonusWin') * 100) . ',"gtype":' . $_obf_0D3B3428360D152B3D312F043B1F083E2317380A020511 . ',"credit":{"tot":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '}}';
                    break;
                case 'QUITGAME':
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"status":"OK","authtoken":"1/90317550926313646767","for":"QUITGAME","credit":{"tot":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '}}';
                    break;
                case 'GA_GAMBLE':
                    $Balance = $slotSettings->GetBalance();
                    $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = rand(1, $slotSettings->GetGambleSettings());
                    $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = '';
                    $totalWin = $slotSettings->GetGameData('MonkeysDanceVSTotalWin');
                    $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = 0;
                    $_obf_0D3310323F3F07041133133D263014342B230C260D1F11 = $totalWin;
                    if( $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : '')) < ($totalWin * 2) ) 
                    {
                        $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = 0;
                    }
                    $_obf_0D1623401B401E2D0E5C36303905161D112D0E12271F01 = 'gamble2lost';
                    if( $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 == 1 ) 
                    {
                        $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'win';
                        $_obf_0D1623401B401E2D0E5C36303905161D112D0E12271F01 = 'gamble2win1';
                        $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = $totalWin;
                        $totalWin = $totalWin * 2;
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['choice'] == '1' ) 
                        {
                            $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                                '30', 
                                '46'
                            ];
                            $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                        }
                        else
                        {
                            $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                                '62', 
                                '78'
                            ];
                            $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                        }
                    }
                    else
                    {
                        $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'lose';
                        $_obf_0D1623401B401E2D0E5C36303905161D112D0E12271F01 = 'gamble2lost';
                        $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = -1 * $totalWin;
                        $totalWin = 0;
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['choice'] == '1' ) 
                        {
                            $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                                '62', 
                                '78'
                            ];
                            $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                        }
                        else
                        {
                            $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                                '30', 
                                '46'
                            ];
                            $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                        }
                    }
                    $slotSettings->SetGameData('MonkeysDanceVSTotalWin', $totalWin);
                    $slotSettings->SetBalance($_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22);
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 * -1);
                    $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 = $slotSettings->GetBalance();
                    $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = '{"dealerCard":"' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 . '","gambleState":"' . $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 . '","totalWin":' . $totalWin . ',"afterBalance":' . $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 . ',"Balance":' . $Balance . '}';
                    $response = '{"responseEvent":"gambleResult","serverResponse":' . $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 . '}';
                    $slotSettings->SaveLogReport($response, $_obf_0D3310323F3F07041133133D263014342B230C260D1F11, 1, $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22, 'slotGamble');
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = $slotSettings->GetGameData('MonkeysDanceVSCards');
                    array_pop($_obf_0D21152412095C03222D3808130C3C012907290C181E22);
                    array_unshift($_obf_0D21152412095C03222D3808130C3C012907290C181E22, $_obf_0D25035C31183316381216122811401A1F2A17243E2B22);
                    $slotSettings->SetGameData('MonkeysDanceVSCards', $_obf_0D21152412095C03222D3808130C3C012907290C181E22);
                    $_obf_0D3B3428360D152B3D312F043B1F083E2317380A020511 = 1;
                    $_obf_0D13133C3B5C1A0D02361A21161E5B192D14300D320301 = 1;
                    if( $slotSettings->GetGameData('MonkeysDanceVSCurrentFreeGame') < $slotSettings->GetGameData('MonkeysDanceVSFreeGames') && $slotSettings->GetGameData('MonkeysDanceVSFreeGames') > 0 ) 
                    {
                        $_obf_0D3B3428360D152B3D312F043B1F083E2317380A020511 = 2;
                    }
                    if( $slotSettings->GetGameData('MonkeysDanceVSBonusStart') == 1 ) 
                    {
                        $_obf_0D13133C3B5C1A0D02361A21161E5B192D14300D320301 = 2;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"status":"OK","gtypeaft":' . $_obf_0D3B3428360D152B3D312F043B1F083E2317380A020511 . ',"gtype":' . $_obf_0D3B3428360D152B3D312F043B1F083E2317380A020511 . ',"totsg":' . $slotSettings->GetGameData('MonkeysDanceVSFreeGames') . ',"plsg":' . $slotSettings->GetGameData('MonkeysDanceVSCurrentFreeGame') . ',"inscatwin":' . ($slotSettings->GetGameData('MonkeysDanceVSBonusWin') * 100) . ',"authtoken":"1/90317550923628407358","for":"GA_GAMBLE","rno":29444,"state":3,"gmblwinf":2,"card":' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 . ',"halfs":0,"snd":"' . $_obf_0D1623401B401E2D0E5C36303905161D112D0E12271F01 . '","gmblamount":' . ($totalWin * 100) . ',"gmblmayhalf":2,"gmblhalfmin":100,"takesnd":"slidein","gmblhist":[' . implode(',', $_obf_0D21152412095C03222D3808130C3C012907290C181E22) . '],"win":' . ($totalWin * 100) . ',"sgwin":0,"credit":{"tot":40885}}';
                    break;
            }
            $response = implode('------:::', $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01);
            $slotSettings->SaveGameData();
            \DB::commit();
            return ':::' . $response;
        }
    }

}
