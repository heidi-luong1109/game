<?php 
namespace VanguardLTE\Games\Magic27GTM
{
    include('CheckReels.php');
    class Server
    {
        public function get($request, $game)
        {/*
            if( config('LicenseDK.APL_INCLUDE_KEY_CONFIG') != 'wi9qydosuimsnls5zoe5q298evkhim0ughx1w16qybs2fhlcpn' ) 
            {
                return false;
            }
            if( md5_file(base_path() . '/config/LicenseDK.php') != '27f30d89977203af2f6822e48707425d' ) 
            {
                return false;
            }
            if( md5_file(base_path() . '/app/Lib/LicenseDK.php') != '22dde427cc10243ac0c7a3a625518e6f' ) 
            {
                return false;
            }
            $checked = new \VanguardLTE\Lib\LicenseDK();
            $license_notifications_array = $checked->aplVerifyLicenseDK(null, 0);
            if( $license_notifications_array['notification_case'] != 'notification_license_ok' ) 
            {
                $response = '{"responseEvent":"error","responseType":"error","serverResponse":"Error LicenseDK"}';
                exit( $response );
            }
*/            $response = '';
            \DB::beginTransaction();
            $userId = \Auth::id();
            if( $userId == null ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid login"}';
                exit( $response );
            }
            $slotSettings = new SlotSettings($game, $userId);
            $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22 = json_decode(trim(file_get_contents('php://input')), true);
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'update' ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":"' . $slotSettings->GetBalance() . '"}';
                exit( $response );
            }
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'bet' || $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' || $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'respin' ) 
            {
                if( !in_array($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'], $slotSettings->gameLine) || !in_array($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'], $slotSettings->Bet) ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":"invalid bet state"}';
                    exit( $response );
                }
                if( $slotSettings->GetBalance() < ($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet']) && $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'bet' ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":"invalid balance"}';
                    exit( $response );
                }
                if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }
            }
            else if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'slotGamble' && $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') <= 0 ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":"invalid gamble state"}';
                exit( $response );
            }
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'getSettings' ) 
            {
                $lastEvent = $slotSettings->GetHistory();
                if( $lastEvent != 'NULL' ) 
                {
                    if( isset($lastEvent->serverResponse->expSymbol) ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'ExpSymbol', $lastEvent->serverResponse->expSymbol);
                    }
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
                }
                $_obf_0D2307370C401A042D310F070D313207280830055B2A32 = json_encode($slotSettings);
                $lang = json_encode(\Lang::get('games.' . $game));
                $response = '{"responseEvent":"getSettings","slotLanguage":' . $lang . ',"serverResponse":' . $_obf_0D2307370C401A042D310F070D313207280830055B2A32 . '}';
            }
            else if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'gamble5GetUserCards' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $_obf_0D2F3C2804395C38101A1C05232C1040362D390D1D3301 = rand(1, $slotSettings->GetGambleSettings());
                $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $slotSettings->GetGameData('Magic27GTMDealerCard');
                $totalWin = $slotSettings->GetGameData('Magic27GTMTotalWin');
                $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = 0;
                $gambleChoice = $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gambleChoice'] - 2;
                $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 = '';
                $_obf_0D150D131414123F011E1F09403221085B233717403C22 = [
                    2, 
                    3, 
                    4, 
                    5, 
                    6, 
                    7, 
                    8, 
                    9, 
                    10, 
                    11, 
                    12, 
                    13, 
                    14
                ];
                $_obf_0D0A0B32260E260B5C152A0C3C0717270A3B2C192C0211 = [
                    'C', 
                    'S', 
                    'D', 
                    'H'
                ];
                $_obf_0D5B182E0E11371B271E18193E040A1A28262E2A303611 = [
                    '', 
                    '', 
                    '2', 
                    '3', 
                    '4', 
                    '5', 
                    '6', 
                    '7', 
                    '8', 
                    '9', 
                    '10', 
                    'J', 
                    'Q', 
                    'K', 
                    'A'
                ];
                $_obf_0D1411191609280C1434232A2B0823093517151A283922 = 0;
                $_obf_0D31140A120E1B3D282A06280B27103B250935092B1F01 = $totalWin;
                if( $slotSettings->GetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : '')) < ($totalWin * 2) ) 
                {
                    $_obf_0D2F3C2804395C38101A1C05232C1040362D390D1D3301 = 0;
                }
                if( $_obf_0D2F3C2804395C38101A1C05232C1040362D390D1D3301 == 1 ) 
                {
                    $_obf_0D1411191609280C1434232A2B0823093517151A283922 = rand($_obf_0D040B162710402D331E2209370C14231F2C252B172601, 14);
                }
                else
                {
                    $_obf_0D1411191609280C1434232A2B0823093517151A283922 = rand(2, $_obf_0D040B162710402D331E2209370C14231F2C252B172601);
                }
                if( $_obf_0D040B162710402D331E2209370C14231F2C252B172601 < $_obf_0D1411191609280C1434232A2B0823093517151A283922 ) 
                {
                    $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = $totalWin;
                    $totalWin = $totalWin * 2;
                    $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 = 'win';
                }
                else if( $_obf_0D1411191609280C1434232A2B0823093517151A283922 < $_obf_0D040B162710402D331E2209370C14231F2C252B172601 ) 
                {
                    $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = -1 * $totalWin;
                    $totalWin = 0;
                    $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 = 'lose';
                }
                else
                {
                    $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = $totalWin;
                    $totalWin = $totalWin;
                    $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 = 'draw';
                }
                if( $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 != $totalWin ) 
                {
                    $slotSettings->SetBalance($_obf_0D2D1D15122B0303242922110A351334341A371C0C3101);
                    $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 * -1);
                }
                $_obf_0D18161E352E061A0433191E381C2E0B222A272A2D3E22 = $slotSettings->GetBalance();
                $_obf_0D0F0A0C0B11232E3F18330D2F283003181C24311E0F32 = [
                    rand(2, 14), 
                    rand(2, 14), 
                    rand(2, 14), 
                    rand(2, 14)
                ];
                $_obf_0D0F0A0C0B11232E3F18330D2F283003181C24311E0F32[$gambleChoice] = $_obf_0D1411191609280C1434232A2B0823093517151A283922;
                for( $i = 0; $i < 4; $i++ ) 
                {
                    $_obf_0D0F0A0C0B11232E3F18330D2F283003181C24311E0F32[$i] = '"' . $_obf_0D5B182E0E11371B271E18193E040A1A28262E2A303611[$_obf_0D0F0A0C0B11232E3F18330D2F283003181C24311E0F32[$i]] . $_obf_0D0A0B32260E260B5C152A0C3C0717270A3B2C192C0211[rand(0, 3)] . '"';
                }
                $_obf_0D3504060F0735361A0C112A5C231C1E08031E3B0B3D32 = implode(',', $_obf_0D0F0A0C0B11232E3F18330D2F283003181C24311E0F32);
                $slotSettings->SetGameData('Magic27GTMTotalWin', $totalWin);
                $_obf_0D2307370C401A042D310F070D313207280830055B2A32 = '{"dealerCard":"' . $_obf_0D040B162710402D331E2209370C14231F2C252B172601 . '","playerCards":[' . $_obf_0D3504060F0735361A0C112A5C231C1E08031E3B0B3D32 . '],"gambleState":"' . $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 . '","totalWin":' . $totalWin . ',"afterBalance":' . $_obf_0D18161E352E061A0433191E381C2E0B222A272A2D3E22 . ',"Balance":' . $Balance . '}';
                $response = '{"responseEvent":"gambleResult","deb":' . $_obf_0D0F0A0C0B11232E3F18330D2F283003181C24311E0F32[$gambleChoice] . ',"serverResponse":' . $_obf_0D2307370C401A042D310F070D313207280830055B2A32 . '}';
            }
            else if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'gamble5GetDealerCard' ) 
            {
                $_obf_0D150D131414123F011E1F09403221085B233717403C22 = [
                    2, 
                    3, 
                    4, 
                    5, 
                    6, 
                    7, 
                    8, 
                    9, 
                    10, 
                    11, 
                    12, 
                    13, 
                    14
                ];
                $_obf_0D5B182E0E11371B271E18193E040A1A28262E2A303611 = [
                    '', 
                    '', 
                    '2', 
                    '3', 
                    '4', 
                    '5', 
                    '6', 
                    '7', 
                    '8', 
                    '9', 
                    '10', 
                    'J', 
                    'Q', 
                    'K', 
                    'A'
                ];
                $_obf_0D0A0B32260E260B5C152A0C3C0717270A3B2C192C0211 = [
                    'C', 
                    'S', 
                    'D', 
                    'H'
                ];
                $_obf_0D5B5C0F232838114030190505402A241E131019332901 = $_obf_0D150D131414123F011E1F09403221085B233717403C22[rand(0, 12)];
                $slotSettings->SetGameData('Magic27GTMDealerCard', $_obf_0D5B5C0F232838114030190505402A241E131019332901);
                $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D5B182E0E11371B271E18193E040A1A28262E2A303611[$_obf_0D5B5C0F232838114030190505402A241E131019332901] . $_obf_0D0A0B32260E260B5C152A0C3C0717270A3B2C192C0211[rand(0, 3)];
                $_obf_0D2307370C401A042D310F070D313207280830055B2A32 = '{"dealerCard":"' . $_obf_0D040B162710402D331E2209370C14231F2C252B172601 . '"}';
                $response = '{"responseEvent":"gamble5DealerCard","serverResponse":' . $_obf_0D2307370C401A042D310F070D313207280830055B2A32 . '}';
            }
            else if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'slotGamble' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $_obf_0D2F3C2804395C38101A1C05232C1040362D390D1D3301 = rand(1, $slotSettings->GetGambleSettings());
                $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = '';
                $totalWin = $slotSettings->GetGameData('Magic27GTMTotalWin');
                $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = 0;
                $_obf_0D31140A120E1B3D282A06280B27103B250935092B1F01 = $totalWin;
                if( $slotSettings->GetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : '')) < ($totalWin * 2) ) 
                {
                    $_obf_0D2F3C2804395C38101A1C05232C1040362D390D1D3301 = 0;
                }
                if( $_obf_0D2F3C2804395C38101A1C05232C1040362D390D1D3301 == 1 ) 
                {
                    $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 = 'win';
                    $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = $totalWin;
                    $totalWin = $totalWin * 2;
                    if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gambleChoice'] == 'red' ) 
                    {
                        $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01 = [
                            'D', 
                            'H'
                        ];
                        $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01[rand(0, 1)];
                    }
                    else
                    {
                        $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01 = [
                            'C', 
                            'S'
                        ];
                        $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01[rand(0, 1)];
                    }
                }
                else
                {
                    $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 = 'lose';
                    $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = -1 * $totalWin;
                    $totalWin = 0;
                    if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gambleChoice'] == 'red' ) 
                    {
                        $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01 = [
                            'C', 
                            'S'
                        ];
                        $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01[rand(0, 1)];
                    }
                    else
                    {
                        $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01 = [
                            'D', 
                            'H'
                        ];
                        $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01[rand(0, 1)];
                    }
                }
                $slotSettings->SetGameData('Magic27GTMTotalWin', $totalWin);
                $slotSettings->SetBalance($_obf_0D2D1D15122B0303242922110A351334341A371C0C3101);
                $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 * -1);
                $_obf_0D18161E352E061A0433191E381C2E0B222A272A2D3E22 = $slotSettings->GetBalance();
                $_obf_0D2307370C401A042D310F070D313207280830055B2A32 = '{"dealerCard":"' . $_obf_0D040B162710402D331E2209370C14231F2C252B172601 . '","gambleState":"' . $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 . '","totalWin":' . $totalWin . ',"afterBalance":' . $_obf_0D18161E352E061A0433191E381C2E0B222A272A2D3E22 . ',"Balance":' . $Balance . '}';
                $response = '{"responseEvent":"gambleResult","serverResponse":' . $_obf_0D2307370C401A042D310F070D313207280830055B2A32 . '}';
                $slotSettings->SaveLogReport($response, $_obf_0D31140A120E1B3D282A06280B27103B250935092B1F01, 1, $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
            }
            else if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'bet' || $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' ) 
            {
                $linesId = [];
                $linesId[0] = [
                    2, 
                    2, 
                    2, 
                    2, 
                    2
                ];
                $linesId[1] = [
                    1, 
                    1, 
                    1, 
                    1, 
                    1
                ];
                $linesId[2] = [
                    3, 
                    3, 
                    3, 
                    3, 
                    3
                ];
                $linesId[3] = [
                    1, 
                    2, 
                    3, 
                    2, 
                    1
                ];
                $linesId[4] = [
                    3, 
                    2, 
                    1, 
                    2, 
                    3
                ];
                $linesId[5] = [
                    2, 
                    3, 
                    3, 
                    3, 
                    2
                ];
                $linesId[6] = [
                    2, 
                    1, 
                    1, 
                    1, 
                    2
                ];
                $linesId[7] = [
                    3, 
                    3, 
                    2, 
                    1, 
                    1
                ];
                $linesId[8] = [
                    1, 
                    1, 
                    2, 
                    3, 
                    3
                ];
                $linesId[9] = [
                    3, 
                    2, 
                    2, 
                    2, 
                    1
                ];
                $_obf_0D360F0140113330275B14311E3516150112390A0F1B22 = $slotSettings->GetSpinSettings($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'], $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'], 10);
                $winType = $_obf_0D360F0140113330275B14311E3516150112390A0F1B22[0];
                $_obf_0D3030072F273706293C133F2F072B113B383322291201 = $_obf_0D360F0140113330275B14311E3516150112390A0F1B22[1];
                if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] != 'freespin' ) 
                {
                    if( !isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ) 
                    {
                        $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] = 'bet';
                    }
                    $_obf_0D2A0526273612293511363C26193E1C130B2719192611 = ($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines']) / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), $_obf_0D2A0526273612293511363C26193E1C130B2719192611, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
                    $slotSettings->UpdateJackpots($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines']);
                    $slotSettings->SetBalance(-1 * ($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines']), $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
                    $bonusMpl = 1;
                    $slotSettings->SetGameData('Magic27GTMBonusWin', 0);
                    $slotSettings->SetGameData('Magic27GTMFreeGames', 0);
                    $slotSettings->SetGameData('Magic27GTMCurrentFreeGame', 0);
                    $slotSettings->SetGameData('Magic27GTMTotalWin', 0);
                    $slotSettings->SetGameData('Magic27GTMFreeBalance', 0);
                }
                else
                {
                    $slotSettings->SetGameData('Magic27GTMCurrentFreeGame', $slotSettings->GetGameData('Magic27GTMCurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->slotFreeMpl;
                }
                $Balance = $slotSettings->GetBalance();
                if( isset($slotSettings->Jackpots['jackPay']) ) 
                {
                    $Balance = $Balance - ($slotSettings->Jackpots['jackPay'] * $slotSettings->CurrentDenom);
                }
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $lineWins = [];
                    $cWins = [
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
                    $wild = 'P_1';
                    $scatter = 'SCAT';
                    $reels = $slotSettings->GetReelStrips($winType, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
                    $_obf_0D292D40240E0725103E0C0522050308271D0D3E380D01 = [];
                    $_obf_0D342F1E5B40011F320A072C3240233802275C300F3532 = false;
                    $_obf_0D17122335210A33192F162C5B041F383C395B16173F22 = [
                        [
                            0, 
                            0, 
                            0
                        ], 
                        [
                            0, 
                            0, 
                            0
                        ], 
                        [
                            0, 
                            0, 
                            0
                        ]
                    ];
                    for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                    {
                        if( $slotSettings->SymbolGame[$j] == $scatter || !isset($slotSettings->Paytable[$slotSettings->SymbolGame[$j]]) ) 
                        {
                        }
                        else
                        {
                            $_obf_0D292D40240E0725103E0C0522050308271D0D3E380D01[$slotSettings->SymbolGame[$j]] = [
                                0, 
                                0, 
                                0
                            ];
                            $_obf_0D262E2C37170D15281C1C1934132C0F1836171F301B32 = [
                                [
                                    '', 
                                    '', 
                                    ''
                                ], 
                                [
                                    '', 
                                    '', 
                                    ''
                                ], 
                                [
                                    '', 
                                    '', 
                                    ''
                                ]
                            ];
                            for( $r = 0; $r < 3; $r++ ) 
                            {
                                if( $reels['reel1'][$r] == $slotSettings->SymbolGame[$j] || $reels['reel1'][$r] == $wild ) 
                                {
                                    $_obf_0D292D40240E0725103E0C0522050308271D0D3E380D01[$slotSettings->SymbolGame[$j]][0]++;
                                    $_obf_0D262E2C37170D15281C1C1934132C0F1836171F301B32[0][$r] = $reels['reel1'][$r];
                                }
                                if( $reels['reel2'][$r] == $slotSettings->SymbolGame[$j] || $reels['reel2'][$r] == $wild ) 
                                {
                                    $_obf_0D292D40240E0725103E0C0522050308271D0D3E380D01[$slotSettings->SymbolGame[$j]][1]++;
                                    $_obf_0D262E2C37170D15281C1C1934132C0F1836171F301B32[1][$r] = $reels['reel2'][$r];
                                }
                                if( $reels['reel3'][$r] == $slotSettings->SymbolGame[$j] || $reels['reel3'][$r] == $wild ) 
                                {
                                    $_obf_0D292D40240E0725103E0C0522050308271D0D3E380D01[$slotSettings->SymbolGame[$j]][2]++;
                                    $_obf_0D262E2C37170D15281C1C1934132C0F1836171F301B32[2][$r] = $reels['reel3'][$r];
                                }
                            }
                            if( $_obf_0D292D40240E0725103E0C0522050308271D0D3E380D01[$slotSettings->SymbolGame[$j]][0] > 0 && $_obf_0D292D40240E0725103E0C0522050308271D0D3E380D01[$slotSettings->SymbolGame[$j]][1] > 0 && $_obf_0D292D40240E0725103E0C0522050308271D0D3E380D01[$slotSettings->SymbolGame[$j]][2] > 0 ) 
                            {
                                for( $_obf_0D091D2930301606111017162631121523161305120722 = 0; $_obf_0D091D2930301606111017162631121523161305120722 < 3; $_obf_0D091D2930301606111017162631121523161305120722++ ) 
                                {
                                    if( $_obf_0D262E2C37170D15281C1C1934132C0F1836171F301B32[0][$_obf_0D091D2930301606111017162631121523161305120722] == '' ) 
                                    {
                                    }
                                    else
                                    {
                                        for( $_obf_0D14023C1B220818220C2B5B1307393903362819133B01 = 0; $_obf_0D14023C1B220818220C2B5B1307393903362819133B01 < 3; $_obf_0D14023C1B220818220C2B5B1307393903362819133B01++ ) 
                                        {
                                            if( $_obf_0D262E2C37170D15281C1C1934132C0F1836171F301B32[1][$_obf_0D14023C1B220818220C2B5B1307393903362819133B01] == '' ) 
                                            {
                                            }
                                            else
                                            {
                                                for( $_obf_0D2B023C1B2F100B2906085B06290F36080D302D331801 = 0; $_obf_0D2B023C1B2F100B2906085B06290F36080D302D331801 < 3; $_obf_0D2B023C1B2F100B2906085B06290F36080D302D331801++ ) 
                                                {
                                                    if( $_obf_0D262E2C37170D15281C1C1934132C0F1836171F301B32[2][$_obf_0D2B023C1B2F100B2906085B06290F36080D302D331801] == '' ) 
                                                    {
                                                    }
                                                    else
                                                    {
                                                        $_obf_0D012931210D5C37372505250E2A1A0824033C3F310D01 = $reels['reel1'][$_obf_0D091D2930301606111017162631121523161305120722];
                                                        $_obf_0D0C0C261A1D3E04060E3B322B2811042F10332D192D11 = $reels['reel2'][$_obf_0D14023C1B220818220C2B5B1307393903362819133B01];
                                                        $_obf_0D393D3B251B29393D021A1904223009341E395B261C22 = $reels['reel3'][$_obf_0D2B023C1B2F100B2906085B06290F36080D302D331801];
                                                        if( $_obf_0D012931210D5C37372505250E2A1A0824033C3F310D01 == $wild && $_obf_0D0C0C261A1D3E04060E3B322B2811042F10332D192D11 == $wild && $_obf_0D393D3B251B29393D021A1904223009341E395B261C22 == $wild ) 
                                                        {
                                                            $_obf_0D012931210D5C37372505250E2A1A0824033C3F310D01 = 'P_1';
                                                            $_obf_0D0C0C261A1D3E04060E3B322B2811042F10332D192D11 = 'P_1';
                                                            $_obf_0D393D3B251B29393D021A1904223009341E395B261C22 = 'P_1';
                                                        }
                                                        else if( $_obf_0D012931210D5C37372505250E2A1A0824033C3F310D01 == $wild || $_obf_0D0C0C261A1D3E04060E3B322B2811042F10332D192D11 == $wild || $_obf_0D393D3B251B29393D021A1904223009341E395B261C22 == $wild ) 
                                                        {
                                                            $_obf_0D34092E23171B07262B181C183533371416112B0C2C32 = '';
                                                            for( $w = 1; $w <= 3; $w++ ) 
                                                            {
                                                                if( ${'s' . $w} != $wild ) 
                                                                {
                                                                    $_obf_0D34092E23171B07262B181C183533371416112B0C2C32 = ${'s' . $w};
                                                                }
                                                            }
                                                            for( $w = 1; $w <= 3; $w++ ) 
                                                            {
                                                                if( ${'s' . $w} == $wild ) 
                                                                {
                                                                    ${'s' . $w} = $_obf_0D34092E23171B07262B181C183533371416112B0C2C32 . '_WILD';
                                                                }
                                                            }
                                                        }
                                                        $_obf_0D37111B3335140203262E17350902171D182F5B312522 = $slotSettings->Paytable[$slotSettings->SymbolGame[$j]][3] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'];
                                                        $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32 = '{"Count":3,"Line":1,"Win":' . $_obf_0D37111B3335140203262E17350902171D182F5B312522 . ',"stepWin":' . ($_obf_0D37111B3335140203262E17350902171D182F5B312522 + $totalWin) . ',"winReel1":[' . $_obf_0D091D2930301606111017162631121523161305120722 . ',"' . $_obf_0D012931210D5C37372505250E2A1A0824033C3F310D01 . '"],"winReel2":[' . $_obf_0D14023C1B220818220C2B5B1307393903362819133B01 . ',"' . $_obf_0D0C0C261A1D3E04060E3B322B2811042F10332D192D11 . '"],"winReel3":[' . $_obf_0D2B023C1B2F100B2906085B06290F36080D302D331801 . ',"' . $_obf_0D393D3B251B29393D021A1904223009341E395B261C22 . '"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                                        if( $_obf_0D37111B3335140203262E17350902171D182F5B312522 > 0 && $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32 != '' ) 
                                                        {
                                                            array_push($lineWins, $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32);
                                                            $totalWin += $_obf_0D37111B3335140203262E17350902171D182F5B312522;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $scattersWin = 0;
                    $scattersStr = '{';
                    $scattersCount = 0;
                    $_obf_0D1E18032B381B18030B3C39315B25222A22372E211D22 = 0;
                    $_obf_0D2507080F252B1C5B1D153B08320D3D04093129141922 = [
                        false, 
                        false, 
                        false, 
                        false
                    ];
                    for( $r = 1; $r <= 3; $r++ ) 
                    {
                        for( $_obf_0D31403C0837332A1A1711312A3415151610280F122122 = 0; $_obf_0D31403C0837332A1A1711312A3415151610280F122122 <= 3; $_obf_0D31403C0837332A1A1711312A3415151610280F122122++ ) 
                        {
                            if( $reels['reel' . $r][$_obf_0D31403C0837332A1A1711312A3415151610280F122122] == $scatter ) 
                            {
                                $_obf_0D2507080F252B1C5B1D153B08320D3D04093129141922[$r] = true;
                            }
                        }
                    }
                    for( $r = 1; $r <= 3; $r++ ) 
                    {
                        for( $_obf_0D31403C0837332A1A1711312A3415151610280F122122 = 0; $_obf_0D31403C0837332A1A1711312A3415151610280F122122 <= 3; $_obf_0D31403C0837332A1A1711312A3415151610280F122122++ ) 
                        {
                            if( $reels['reel' . $r][$_obf_0D31403C0837332A1A1711312A3415151610280F122122] == $scatter || $reels['reel' . $r][$_obf_0D31403C0837332A1A1711312A3415151610280F122122] == $wild && !$_obf_0D2507080F252B1C5B1D153B08320D3D04093129141922[$r] ) 
                            {
                                $_obf_0D5C0907022524223D08023D0D1E1A163D3D152E3C1222 = $reels['reel' . $r][$_obf_0D31403C0837332A1A1711312A3415151610280F122122];
                                if( $reels['reel' . $r][$_obf_0D31403C0837332A1A1711312A3415151610280F122122] == $wild ) 
                                {
                                    $_obf_0D1E18032B381B18030B3C39315B25222A22372E211D22++;
                                    $_obf_0D5C0907022524223D08023D0D1E1A163D3D152E3C1222 = $_obf_0D5C0907022524223D08023D0D1E1A163D3D152E3C1222 . '_WILD';
                                }
                                if( $_obf_0D1E18032B381B18030B3C39315B25222A22372E211D22 < 3 ) 
                                {
                                    $scattersCount++;
                                }
                                $scattersStr .= ('"winReel' . $r . '":[' . $_obf_0D31403C0837332A1A1711312A3415151610280F122122 . ',"' . $reels['reel' . $r][$_obf_0D31403C0837332A1A1711312A3415151610280F122122] . '"],');
                            }
                        }
                    }
                    $scattersWin = 0;
                    $_obf_0D0A1A36023F2601342A0D33322C221F1D051111400622 = [];
                    $_obf_0D39402307131B3B361F06230A1A5C053015371E1B3032 = 0;
                    $_obf_0D402934052C233B1730101D23035B1E1A1C115B2B2601 = 0;
                    if( $scattersCount >= 3 && $slotSettings->slotBonus ) 
                    {
                        $_obf_0D06100724360C3F2F19141B2736072C011D3435221101 = $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'];
                        $_obf_0D0A1A36023F2601342A0D33322C221F1D051111400622 = [
                            25 * $_obf_0D06100724360C3F2F19141B2736072C011D3435221101, 
                            40 * $_obf_0D06100724360C3F2F19141B2736072C011D3435221101, 
                            55 * $_obf_0D06100724360C3F2F19141B2736072C011D3435221101, 
                            70 * $_obf_0D06100724360C3F2F19141B2736072C011D3435221101, 
                            85 * $_obf_0D06100724360C3F2F19141B2736072C011D3435221101, 
                            100 * $_obf_0D06100724360C3F2F19141B2736072C011D3435221101
                        ];
                        $_obf_0D39402307131B3B361F06230A1A5C053015371E1B3032 = rand(0, 5);
                        $_obf_0D402934052C233B1730101D23035B1E1A1C115B2B2601 = $_obf_0D0A1A36023F2601342A0D33322C221F1D051111400622[$_obf_0D39402307131B3B361F06230A1A5C053015371E1B3032] * $_obf_0D06100724360C3F2F19141B2736072C011D3435221101;
                        $scattersStr .= '"scattersType":"bonus",';
                    }
                    else if( $scattersWin > 0 ) 
                    {
                        $scattersStr .= '"scattersType":"win",';
                    }
                    else
                    {
                        $scattersStr .= '"scattersType":"none",';
                    }
                    $scattersStr .= ('"scattersWin":' . $scattersWin . '}');
                    if( $i > 1000 ) 
                    {
                        $winType = 'none';
                    }
                    if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * rand(2, 5)) ) 
                    {
                    }
                    else if( !$slotSettings->increaseRTP && $winType == 'win' && $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] < $totalWin ) 
                    {
                    }
                    else
                    {
                        if( $i > 1500 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( $scattersCount >= 3 && $winType != 'bonus' ) 
                        {
                        }
                        else if( $totalWin + $_obf_0D402934052C233B1730101D23035B1E1A1C115B2B2601 <= $_obf_0D3030072F273706293C133F2F072B113B383322291201 && $winType == 'bonus' ) 
                        {
                            $_obf_0D195C0F2915230B5C17342A08251204342D3C1F024001 = $slotSettings->GetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''));
                            if( $_obf_0D195C0F2915230B5C17342A08251204342D3C1F024001 < $_obf_0D3030072F273706293C133F2F072B113B383322291201 ) 
                            {
                                $_obf_0D3030072F273706293C133F2F072B113B383322291201 = $_obf_0D195C0F2915230B5C17342A08251204342D3C1F024001;
                            }
                            else
                            {
                                break;
                            }
                        }
                        else if( $totalWin + $_obf_0D402934052C233B1730101D23035B1E1A1C115B2B2601 > 0 && $totalWin + $_obf_0D402934052C233B1730101D23035B1E1A1C115B2B2601 <= $_obf_0D3030072F273706293C133F2F072B113B383322291201 && $winType == 'win' ) 
                        {
                            $_obf_0D195C0F2915230B5C17342A08251204342D3C1F024001 = $slotSettings->GetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''));
                            if( $_obf_0D195C0F2915230B5C17342A08251204342D3C1F024001 < $_obf_0D3030072F273706293C133F2F072B113B383322291201 ) 
                            {
                                $_obf_0D3030072F273706293C133F2F072B113B383322291201 = $_obf_0D195C0F2915230B5C17342A08251204342D3C1F024001;
                            }
                            else
                            {
                                break;
                            }
                        }
                        else if( $totalWin + $_obf_0D402934052C233B1730101D23035B1E1A1C115B2B2601 == 0 && $winType == 'none' ) 
                        {
                            break;
                        }
                    }
                }
                if( $totalWin + $_obf_0D402934052C233B1730101D23035B1E1A1C115B2B2601 > 0 ) 
                {
                    $slotSettings->SetBalance($totalWin + $_obf_0D402934052C233B1730101D23035B1E1A1C115B2B2601);
                    $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), -1 * ($totalWin + $_obf_0D402934052C233B1730101D23035B1E1A1C115B2B2601));
                }
                $_obf_0D0C361D2E35362209025C2317232809271D34270D3232 = $totalWin;
                $slotSettings->SetGameData('Magic27GTMTotalWin', $totalWin + $_obf_0D402934052C233B1730101D23035B1E1A1C115B2B2601);
                $_obf_0D273522403840350F0A36072E150A0524143F382C3B32 = '' . json_encode($reels) . '';
                $_obf_0D28393910101E062539311B3F371C121912162B061E32 = '' . json_encode($slotSettings->Jackpots) . '';
                $_obf_0D5B5C2E0D1C3D1F232F3E051D3225380127293C2A2432 = implode(',', $lineWins);
                $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":{"slotLines":' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'] . ',"slotBet":' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] . ',"mysteryWinCredit":' . $_obf_0D402934052C233B1730101D23035B1E1A1C115B2B2601 . ',"mysteryWin":' . $_obf_0D39402307131B3B361F06230A1A5C053015371E1B3032 . ',"mysteryWins":[' . implode(',', $_obf_0D0A1A36023F2601342A0D33322C221F1D051111400622) . '],"totalFreeGames":' . $slotSettings->GetGameData('Magic27GTMFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('Magic27GTMCurrentFreeGame') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D5B5C2E0D1C3D1F232F3E051D3225380127293C2A2432 . '],"bonusInfo":' . $scattersStr . ',"Jackpots":' . $_obf_0D28393910101E062539311B3F371C121912162B061E32 . ',"reelsSymbols":' . $_obf_0D273522403840350F0A36072E150A0524143F382C3B32 . '}}';
                $slotSettings->SaveLogReport($response, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'], $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'], $_obf_0D0C361D2E35362209025C2317232809271D34270D3232, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
