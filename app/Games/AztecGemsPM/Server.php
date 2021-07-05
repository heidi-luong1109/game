<?php 
namespace VanguardLTE\Games\AztecGemsPM
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
            $response = '';
            \DB::beginTransaction();
            $userId = \Auth::id();
            if( $userId == null ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid login"}';
                exit( $response );
            }
            $slotSettings = new SlotSettings($game, $userId);
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = trim(file_get_contents('php://input'));
            $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11 = explode('&', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822);
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = [];
            foreach( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11 as $_obf_0D5B19385B35332B082A3740350F08063D162418121E01 ) 
            {
                $_obf_0D2A3E342E3D151A0A010108022B3C2E38282B0C400711 = explode('=', $_obf_0D5B19385B35332B082A3740350F08063D162418121E01);
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[$_obf_0D2A3E342E3D151A0A010108022B3C2E38282B0C400711[0]] = $_obf_0D2A3E342E3D151A0A010108022B3C2E38282B0C400711[1];
            }
            if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action']) ) 
            {
                return '';
            }
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'];
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'update' ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"' . $slotSettings->GetBalance() . '"}';
                exit( $response );
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'doInit' ) 
            {
                $lastEvent = $slotSettings->GetHistory();
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
                    $lastEvent->serverResponse->reelsSymbols->reel1 = (array)$lastEvent->serverResponse->reelsSymbols->reel1;
                    $lastEvent->serverResponse->reelsSymbols->reel2 = (array)$lastEvent->serverResponse->reelsSymbols->reel2;
                    $lastEvent->serverResponse->reelsSymbols->reel3 = (array)$lastEvent->serverResponse->reelsSymbols->reel3;
                    $_obf_0D1C1D210B1F1B33075C310724290F3C132E1405255B01 = implode(',', $lastEvent->serverResponse->reelsSymbols->rp);
                    $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 = '' . $lastEvent->serverResponse->reelsSymbols->reel1[0] . ',' . $lastEvent->serverResponse->reelsSymbols->reel2[0] . ',' . $lastEvent->serverResponse->reelsSymbols->reel3[0] . '';
                    $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 .= (',' . $lastEvent->serverResponse->reelsSymbols->reel1[1] . ',' . $lastEvent->serverResponse->reelsSymbols->reel2[1] . ',' . $lastEvent->serverResponse->reelsSymbols->reel3[1] . '');
                    $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 .= (',' . $lastEvent->serverResponse->reelsSymbols->reel1[2] . ',' . $lastEvent->serverResponse->reelsSymbols->reel2[2] . ',' . $lastEvent->serverResponse->reelsSymbols->reel3[2] . '');
                    $bet = $lastEvent->serverResponse->bet;
                }
                else
                {
                    $_obf_0D1C1D210B1F1B33075C310724290F3C132E1405255B01 = implode(',', [
                        rand(0, count($slotSettings->reelStrip1) - 3), 
                        rand(0, count($slotSettings->reelStrip2) - 3), 
                        rand(0, count($slotSettings->reelStrip3) - 3)
                    ]);
                    $_obf_0D1427193624111E0F3F19161D3E05313F281B2B071E22 = rand(0, count($slotSettings->reelStrip1) - 3);
                    $_obf_0D40170234191D12013C08112D373F23141F21271C4022 = rand(0, count($slotSettings->reelStrip2) - 3);
                    $_obf_0D302D052E271A03052B5C2E3032091F292B160D0A5C32 = rand(0, count($slotSettings->reelStrip3) - 3);
                    $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 = $slotSettings->reelStrip1[$_obf_0D1427193624111E0F3F19161D3E05313F281B2B071E22];
                    $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 = $slotSettings->reelStrip2[$_obf_0D40170234191D12013C08112D373F23141F21271C4022];
                    $_obf_0D3711263310365C0639400E142F04143C011B5B240322 = $slotSettings->reelStrip3[$_obf_0D302D052E271A03052B5C2E3032091F292B160D0A5C32];
                    $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 = '' . $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 . ',' . $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 . ',' . $_obf_0D3711263310365C0639400E142F04143C011B5B240322 . '';
                    $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 = $slotSettings->reelStrip1[$_obf_0D1427193624111E0F3F19161D3E05313F281B2B071E22 + 1];
                    $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 = $slotSettings->reelStrip2[$_obf_0D40170234191D12013C08112D373F23141F21271C4022 + 1];
                    $_obf_0D3711263310365C0639400E142F04143C011B5B240322 = $slotSettings->reelStrip3[$_obf_0D302D052E271A03052B5C2E3032091F292B160D0A5C32 + 1];
                    $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 .= (',' . $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 . ',' . $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 . ',' . $_obf_0D3711263310365C0639400E142F04143C011B5B240322 . '');
                    $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 = $slotSettings->reelStrip1[$_obf_0D1427193624111E0F3F19161D3E05313F281B2B071E22 + 2];
                    $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 = $slotSettings->reelStrip2[$_obf_0D40170234191D12013C08112D373F23141F21271C4022 + 2];
                    $_obf_0D3711263310365C0639400E142F04143C011B5B240322 = $slotSettings->reelStrip3[$_obf_0D302D052E271A03052B5C2E3032091F292B160D0A5C32 + 2];
                    $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 .= (',' . $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 . ',' . $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 . ',' . $_obf_0D3711263310365C0639400E142F04143C011B5B240322 . '');
                    $bet = $slotSettings->Bet[0];
                }
                $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = json_encode($slotSettings);
                $lang = json_encode(\Lang::get('games.' . $game));
                $Balance = $slotSettings->GetBalance();
                $response = 'def_s=7,4,9,7,4,9,7,4,9&balance=' . $Balance . '&cfgs=1&reel1=' . implode(',', $slotSettings->reelStrip2) . '&ver=2&reel0=' . implode(',', $slotSettings->reelStrip1) . '&index=1&balance_cash=' . $Balance . '&def_sb=4,4,4&def_sa=8,8,8&reel2=' . implode(',', $slotSettings->reelStrip3) . '&balance_bonus=0.00&na=s&aw=3&scatters=1~0,0,0~0,0,0~1,1,1&gmb=0,0,0&rt=d&base_aw=m~1;m~2;m~3;m~5;m~10;m~15&stime=' . floor(microtime(true) * 1000) . '&sa=8,8,8&sb=4,4,4&sc=' . implode(',', $slotSettings->Bet) . '&defc=' . $slotSettings->Bet[0] . '&def_aw=3&sh=3&wilds=2~25,0,0~1,1,1&bonuses=0&fsbonus=&c=' . $slotSettings->Bet[0] . '&sver=5&counter=2&paytable=0,0,0;0,0,0;0,0,0;20,0,0;15,0,0;12,0,0;10,0,0;8,0,0;5,0,0;2,0,0&l=5&rtp=96.52&s=' . $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 . '&awt=6rl';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'gamble5GetUserCards' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = rand(1, $slotSettings->GetGambleSettings());
                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $slotSettings->GetGameData('AztecGemsPMDealerCard');
                $totalWin = $slotSettings->GetGameData('AztecGemsPMTotalWin');
                $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = 0;
                $gambleChoice = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gambleChoice'] - 2;
                $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = '';
                $_obf_0D111701310A072F5C142524252B302A243F091F172411 = [
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
                $_obf_0D112B16351A0D0D02250E1F401526150C21152B143932 = [
                    'C', 
                    'S', 
                    'D', 
                    'H'
                ];
                $_obf_0D07380D0B2F2F240918081F3F2A042730295C091F2132 = [
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
                $_obf_0D093F0332311B250D5C25022B1E403C26403B330F3511 = 0;
                if( $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : '')) < ($totalWin * 2) ) 
                {
                    $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = 0;
                }
                if( $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 == 1 ) 
                {
                    $_obf_0D093F0332311B250D5C25022B1E403C26403B330F3511 = rand($_obf_0D25035C31183316381216122811401A1F2A17243E2B22, 14);
                }
                else
                {
                    $_obf_0D093F0332311B250D5C25022B1E403C26403B330F3511 = rand(2, $_obf_0D25035C31183316381216122811401A1F2A17243E2B22);
                }
                if( $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 < $_obf_0D093F0332311B250D5C25022B1E403C26403B330F3511 ) 
                {
                    $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = $totalWin;
                    $totalWin = $totalWin * 2;
                    $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'win';
                }
                else if( $_obf_0D093F0332311B250D5C25022B1E403C26403B330F3511 < $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 ) 
                {
                    $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = -1 * $totalWin;
                    $totalWin = 0;
                    $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'lose';
                }
                else
                {
                    $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = $totalWin;
                    $totalWin = $totalWin;
                    $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'draw';
                }
                if( $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 != $totalWin ) 
                {
                    $slotSettings->SetBalance($_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22);
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 * -1);
                }
                $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 = $slotSettings->GetBalance();
                $_obf_0D070A3C372F0137055B310C3816090324041017273C11 = [
                    rand(2, 14), 
                    rand(2, 14), 
                    rand(2, 14), 
                    rand(2, 14)
                ];
                $_obf_0D070A3C372F0137055B310C3816090324041017273C11[$gambleChoice] = $_obf_0D093F0332311B250D5C25022B1E403C26403B330F3511;
                for( $i = 0; $i < 4; $i++ ) 
                {
                    $_obf_0D070A3C372F0137055B310C3816090324041017273C11[$i] = '"' . $_obf_0D07380D0B2F2F240918081F3F2A042730295C091F2132[$_obf_0D070A3C372F0137055B310C3816090324041017273C11[$i]] . $_obf_0D112B16351A0D0D02250E1F401526150C21152B143932[rand(0, 3)] . '"';
                }
                $_obf_0D151B5C293D1C393D0F2F340F2A15032A122618191A32 = implode(',', $_obf_0D070A3C372F0137055B310C3816090324041017273C11);
                $slotSettings->SetGameData('AztecGemsPMTotalWin', $totalWin);
                $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = '{"dealerCard":"' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 . '","playerCards":[' . $_obf_0D151B5C293D1C393D0F2F340F2A15032A122618191A32 . '],"gambleState":"' . $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 . '","totalWin":' . $totalWin . ',"afterBalance":' . $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 . ',"Balance":' . $Balance . '}';
                $response = '{"responseEvent":"gambleResult","deb":' . $_obf_0D070A3C372F0137055B310C3816090324041017273C11[$gambleChoice] . ',"serverResponse":' . $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 . '}';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'gamble5GetDealerCard' ) 
            {
                $_obf_0D111701310A072F5C142524252B302A243F091F172411 = [
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
                $_obf_0D07380D0B2F2F240918081F3F2A042730295C091F2132 = [
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
                $_obf_0D112B16351A0D0D02250E1F401526150C21152B143932 = [
                    'C', 
                    'S', 
                    'D', 
                    'H'
                ];
                $_obf_0D1A28330223330201021115084008123B0F213C102922 = $_obf_0D111701310A072F5C142524252B302A243F091F172411[rand(0, 12)];
                $slotSettings->SetGameData('AztecGemsPMDealerCard', $_obf_0D1A28330223330201021115084008123B0F213C102922);
                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D07380D0B2F2F240918081F3F2A042730295C091F2132[$_obf_0D1A28330223330201021115084008123B0F213C102922] . $_obf_0D112B16351A0D0D02250E1F401526150C21152B143932[rand(0, 3)];
                $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = '{"dealerCard":"' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 . '"}';
                $response = '{"responseEvent":"gamble5DealerCard","serverResponse":' . $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 . '}';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'slotGamble' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = rand(1, $slotSettings->GetGambleSettings());
                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = '';
                $totalWin = $slotSettings->GetGameData('AztecGemsPMTotalWin');
                $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = 0;
                $_obf_0D3310323F3F07041133133D263014342B230C260D1F11 = $totalWin;
                if( $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : '')) < ($totalWin * 2) ) 
                {
                    $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = 0;
                }
                if( $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 == 1 ) 
                {
                    $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'win';
                    $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = $totalWin;
                    $totalWin = $totalWin * 2;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gambleChoice'] == 'red' ) 
                    {
                        $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                            'D', 
                            'H'
                        ];
                        $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                    }
                    else
                    {
                        $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                            'C', 
                            'S'
                        ];
                        $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                    }
                }
                else
                {
                    $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'lose';
                    $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = -1 * $totalWin;
                    $totalWin = 0;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gambleChoice'] == 'red' ) 
                    {
                        $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                            'C', 
                            'S'
                        ];
                        $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                    }
                    else
                    {
                        $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                            'D', 
                            'H'
                        ];
                        $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                    }
                }
                $slotSettings->SetGameData('AztecGemsPMTotalWin', $totalWin);
                $slotSettings->SetBalance($_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22);
                $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 * -1);
                $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 = $slotSettings->GetBalance();
                $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = '{"dealerCard":"' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 . '","gambleState":"' . $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 . '","totalWin":' . $totalWin . ',"afterBalance":' . $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 . ',"Balance":' . $Balance . '}';
                $response = '{"responseEvent":"gambleResult","serverResponse":' . $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 . '}';
                $slotSettings->SaveLogReport($response, $_obf_0D3310323F3F07041133133D263014342B230C260D1F11, 1, $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'doCollect' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $response = 'balance=' . $Balance . '&index=5&balance_cash=' . $Balance . '&balance_bonus=0.00&na=s&stime=' . floor(microtime(true) * 1000) . '&sver=5&counter=10';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'doSpin' ) 
            {
                $linesId = [];
                $linesId[0] = [
                    2, 
                    2, 
                    2
                ];
                $linesId[1] = [
                    1, 
                    1, 
                    1
                ];
                $linesId[2] = [
                    3, 
                    3, 
                    3
                ];
                $linesId[3] = [
                    1, 
                    2, 
                    3
                ];
                $linesId[4] = [
                    3, 
                    2, 
                    1
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422 = [];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[0] = [
                    0, 
                    3, 
                    6
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[1] = [
                    1, 
                    4, 
                    7
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[2] = [
                    2, 
                    5, 
                    8
                ];
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['c'];
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] = 5;
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'doSpin' ) 
                {
                    $lines = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'];
                    $betline = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'];
                    if( $lines <= 0 || $betline <= 0.0001 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetBalance() < ($lines * $betline) ) 
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
                $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines']);
                $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                {
                    if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    }
                    $slotSettings->SetBalance(-1 * ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines']), $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines']) / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $bonusMpl = 1;
                    $slotSettings->SetGameData('AztecGemsPMBonusWin', 0);
                    $slotSettings->SetGameData('AztecGemsPMFreeGames', 0);
                    $slotSettings->SetGameData('AztecGemsPMCurrentFreeGame', 0);
                    $slotSettings->SetGameData('AztecGemsPMTotalWin', 0);
                    $slotSettings->SetGameData('AztecGemsPMFreeBalance', 0);
                }
                else
                {
                    $slotSettings->SetGameData('AztecGemsPMCurrentFreeGame', $slotSettings->GetGameData('AztecGemsPMCurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->slotFreeMpl;
                }
                $Balance = $slotSettings->GetBalance();
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                {
                    $slotSettings->UpdateJackpots($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines']);
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
                    $wild = '2';
                    $scatter = 'NONE';
                    $_obf_0D3B013F152C3D0B3B1228263F1106140318063F0A1F11 = [
                        1, 
                        1, 
                        1, 
                        1, 
                        2, 
                        2, 
                        2, 
                        2, 
                        3, 
                        3, 
                        3, 
                        3, 
                        5, 
                        5, 
                        5, 
                        10, 
                        10, 
                        15, 
                        15
                    ];
                    shuffle($_obf_0D3B013F152C3D0B3B1228263F1106140318063F0A1F11);
                    $bonusMpl = $_obf_0D3B013F152C3D0B3B1228263F1106140318063F0A1F11[0];
                    $_obf_0D2414131D3935192D0D3E211013194027391F1F2C0411 = 0;
                    $reels = $slotSettings->GetReelStrips($winType);
                    for( $k = 0; $k < $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines']; $k++ ) 
                    {
                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '';
                        for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                        {
                            $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = $slotSettings->SymbolGame[$j];
                            if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $scatter || !isset($slotSettings->Paytable[$_obf_0D011C142C3C37263F351C4012170A074027083F321132]) ) 
                            {
                            }
                            else
                            {
                                $s = [];
                                $s[0] = $reels['reel1'][$linesId[$k][0] - 1];
                                $s[1] = $reels['reel2'][$linesId[$k][1] - 1];
                                $s[2] = $reels['reel3'][$linesId[$k][2] - 1];
                                if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[0]) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[1]) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[2]) ) 
                                {
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable[$_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D301D22400C2B0C292E2C04343E153F053F3019010222 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[0][$linesId[$k][0] - 1];
                                        $_obf_0D5C1222360805242B3126212232015B2730031C133E22 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[1][$linesId[$k][1] - 1];
                                        $_obf_0D3432221004160213383F5B5B3E0C192E3F3510372132 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[2][$linesId[$k][2] - 1];
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = 'l' . $_obf_0D2414131D3935192D0D3E211013194027391F1F2C0411 . '=' . $k . '~' . $cWins[$k] . '~' . $_obf_0D301D22400C2B0C292E2C04343E153F053F3019010222 . '~' . $_obf_0D5C1222360805242B3126212232015B2730031C133E22 . '~' . $_obf_0D3432221004160213383F5B5B3E0C192E3F3510372132 . '';
                                        $_obf_0D2414131D3935192D0D3E211013194027391F1F2C0411++;
                                    }
                                }
                            }
                        }
                        if( $cWins[$k] > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                        {
                            array_push($lineWins, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                            $totalWin += $cWins[$k];
                        }
                    }
                    $scattersWin = 0;
                    $scattersStr = '{';
                    $scattersCount = 0;
                    for( $r = 1; $r <= 3; $r++ ) 
                    {
                        for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 3; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                        {
                            if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == $scatter ) 
                            {
                                $scattersCount++;
                                $scattersStr .= ('"winReel' . $r . '":[' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . ',"' . $scatter . '"],');
                            }
                        }
                    }
                    $scattersWin = 0;
                    if( $scattersCount >= 3 && $slotSettings->slotBonus ) 
                    {
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
                    $totalWin += $scattersWin;
                    if( $i > 1000 ) 
                    {
                        $winType = 'none';
                    }
                    if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * rand(2, 5)) ) 
                    {
                    }
                    else if( !$slotSettings->increaseRTP && $winType == 'win' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] < $totalWin ) 
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
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                }
                $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData('AztecGemsPMBonusWin', $slotSettings->GetGameData('AztecGemsPMBonusWin') + $totalWin);
                    $slotSettings->SetGameData('AztecGemsPMTotalWin', $slotSettings->GetGameData('AztecGemsPMTotalWin') + $totalWin);
                    $totalWin = $slotSettings->GetGameData('AztecGemsPMBonusWin');
                    $Balance = $slotSettings->GetGameData('AztecGemsPMFreeBalance');
                }
                else
                {
                    $slotSettings->SetGameData('AztecGemsPMTotalWin', $totalWin);
                }
                if( $scattersCount >= 3 ) 
                {
                    if( $slotSettings->GetGameData('AztecGemsPMFreeGames') > 0 ) 
                    {
                        $slotSettings->SetGameData('AztecGemsPMFreeBalance', $Balance);
                        $slotSettings->SetGameData('AztecGemsPMBonusWin', $totalWin);
                        $slotSettings->SetGameData('AztecGemsPMFreeGames', $slotSettings->GetGameData('AztecGemsPMFreeGames') + $slotSettings->slotFreeCount);
                    }
                    else
                    {
                        $slotSettings->SetGameData('AztecGemsPMFreeBalance', $Balance);
                        $slotSettings->SetGameData('AztecGemsPMBonusWin', $totalWin);
                        $slotSettings->SetGameData('AztecGemsPMFreeGames', $slotSettings->slotFreeCount);
                    }
                }
                $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = '&' . implode('&', $lineWins);
                $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"lines":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] . ',"bet":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] . ',"totalFreeGames":' . $slotSettings->GetGameData('AztecGemsPMFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('AztecGemsPMCurrentFreeGame') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"winLines":[],"bonusInfo":' . $scattersStr . ',"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                if( $bonusMpl == 1 ) 
                {
                    $_obf_0D3F3E14172C051A5B263C040438315B30161D30042332 = 0;
                }
                if( $bonusMpl == 2 ) 
                {
                    $_obf_0D3F3E14172C051A5B263C040438315B30161D30042332 = 1;
                }
                if( $bonusMpl == 3 ) 
                {
                    $_obf_0D3F3E14172C051A5B263C040438315B30161D30042332 = 2;
                }
                if( $bonusMpl == 5 ) 
                {
                    $_obf_0D3F3E14172C051A5B263C040438315B30161D30042332 = 3;
                }
                if( $bonusMpl == 10 ) 
                {
                    $_obf_0D3F3E14172C051A5B263C040438315B30161D30042332 = 4;
                }
                if( $bonusMpl == 15 ) 
                {
                    $_obf_0D3F3E14172C051A5B263C040438315B30161D30042332 = 5;
                }
                $response = 'com=5,5&tw=' . $totalWin . '&balance=' . $slotSettings->GetBalance() . '&index=3&balance_cash=' . $slotSettings->GetBalance() . '&balance_bonus=0.00&na=c&aw=' . $_obf_0D3F3E14172C051A5B263C040438315B30161D30042332 . '' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '&stime=' . floor(microtime(true) * 1000) . '&sa=' . $reels['reel1'][3] . ',' . $reels['reel2'][3] . ',' . $reels['reel3'][3] . '&sb=' . $reels['reel1'][-1] . ',' . $reels['reel2'][-1] . ',' . $reels['reel3'][-1] . '&sh=3&c=0.01&sver=5&counter=6&l=5&s=' . $reels['reel1'][0] . ',' . $reels['reel2'][0] . ',' . $reels['reel3'][0] . ',' . $reels['reel1'][1] . ',' . $reels['reel2'][1] . ',' . $reels['reel3'][1] . ',' . $reels['reel1'][2] . ',' . $reels['reel2'][2] . ',' . $reels['reel3'][2] . '&w=' . $totalWin . '&gwm=' . $bonusMpl . '&awt=6rl';
                $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'], $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
