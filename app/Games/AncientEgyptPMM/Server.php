<?php 
namespace VanguardLTE\Games\AncientEgyptPMM
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
                $_obf_0D2C3210261C5C0E39023D123B240D292A062F141C1532 = '';
                $slotSettings->SetGameData('AncientEgyptPMMBonusWin', 0);
                $slotSettings->SetGameData('AncientEgyptPMMFreeGames', 0);
                $slotSettings->SetGameData('AncientEgyptPMMCurrentFreeGame', 0);
                $slotSettings->SetGameData('AncientEgyptPMMTotalWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                $slotSettings->SetGameData('AncientEgyptPMMBonusState', 0);
                $slotSettings->SetGameData('AncientEgyptPMMBonusMpl', 0);
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $lastEvent->serverResponse->BonusMpl);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Sym', $lastEvent->serverResponse->Sym);
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                    {
                        $_obf_0D2C3210261C5C0E39023D123B240D292A062F141C1532 = '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '';
                    }
                    $lastEvent->serverResponse->reelsSymbols->reel1 = (array)$lastEvent->serverResponse->reelsSymbols->reel1;
                    $lastEvent->serverResponse->reelsSymbols->reel2 = (array)$lastEvent->serverResponse->reelsSymbols->reel2;
                    $lastEvent->serverResponse->reelsSymbols->reel3 = (array)$lastEvent->serverResponse->reelsSymbols->reel3;
                    $lastEvent->serverResponse->reelsSymbols->reel4 = (array)$lastEvent->serverResponse->reelsSymbols->reel4;
                    $lastEvent->serverResponse->reelsSymbols->reel5 = (array)$lastEvent->serverResponse->reelsSymbols->reel5;
                    $_obf_0D1C1D210B1F1B33075C310724290F3C132E1405255B01 = implode(',', $lastEvent->serverResponse->reelsSymbols->rp);
                    $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 = '' . $lastEvent->serverResponse->reelsSymbols->reel1[0] . ',' . $lastEvent->serverResponse->reelsSymbols->reel2[0] . ',' . $lastEvent->serverResponse->reelsSymbols->reel3[0] . ',' . $lastEvent->serverResponse->reelsSymbols->reel4[0] . ',' . $lastEvent->serverResponse->reelsSymbols->reel5[0];
                    $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 .= (',' . $lastEvent->serverResponse->reelsSymbols->reel1[1] . ',' . $lastEvent->serverResponse->reelsSymbols->reel2[1] . ',' . $lastEvent->serverResponse->reelsSymbols->reel3[1] . ',' . $lastEvent->serverResponse->reelsSymbols->reel4[1] . ',' . $lastEvent->serverResponse->reelsSymbols->reel5[1]);
                    $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 .= (',' . $lastEvent->serverResponse->reelsSymbols->reel1[2] . ',' . $lastEvent->serverResponse->reelsSymbols->reel2[2] . ',' . $lastEvent->serverResponse->reelsSymbols->reel3[2] . ',' . $lastEvent->serverResponse->reelsSymbols->reel4[2] . ',' . $lastEvent->serverResponse->reelsSymbols->reel5[2]);
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
                    $_obf_0D15172326073C2F213E5C1B5C3201270A032D23382322 = rand(0, count($slotSettings->reelStrip4) - 3);
                    $_obf_0D3D31062639082336285C2905020F2B063022132E0401 = rand(0, count($slotSettings->reelStrip5) - 3);
                    $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 = $slotSettings->reelStrip1[$_obf_0D1427193624111E0F3F19161D3E05313F281B2B071E22];
                    $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 = $slotSettings->reelStrip2[$_obf_0D40170234191D12013C08112D373F23141F21271C4022];
                    $_obf_0D3711263310365C0639400E142F04143C011B5B240322 = $slotSettings->reelStrip3[$_obf_0D302D052E271A03052B5C2E3032091F292B160D0A5C32];
                    $_obf_0D2A1A1E150D142B17291236053731323D0109193B1211 = $slotSettings->reelStrip3[$_obf_0D15172326073C2F213E5C1B5C3201270A032D23382322];
                    $_obf_0D103336361B0A5B3F10403C3E2D055C2E190F16351F11 = $slotSettings->reelStrip3[$_obf_0D3D31062639082336285C2905020F2B063022132E0401];
                    $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 = $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 . ',' . $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 . ',' . $_obf_0D3711263310365C0639400E142F04143C011B5B240322 . ',' . $_obf_0D2A1A1E150D142B17291236053731323D0109193B1211 . ',' . $_obf_0D103336361B0A5B3F10403C3E2D055C2E190F16351F11;
                    $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 = $slotSettings->reelStrip1[$_obf_0D1427193624111E0F3F19161D3E05313F281B2B071E22 + 1];
                    $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 = $slotSettings->reelStrip2[$_obf_0D40170234191D12013C08112D373F23141F21271C4022 + 1];
                    $_obf_0D3711263310365C0639400E142F04143C011B5B240322 = $slotSettings->reelStrip3[$_obf_0D302D052E271A03052B5C2E3032091F292B160D0A5C32 + 1];
                    $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 .= (',' . $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 . ',' . $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 . ',' . $_obf_0D3711263310365C0639400E142F04143C011B5B240322 . ',' . $_obf_0D2A1A1E150D142B17291236053731323D0109193B1211 . ',' . $_obf_0D103336361B0A5B3F10403C3E2D055C2E190F16351F11);
                    $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 = $slotSettings->reelStrip1[$_obf_0D1427193624111E0F3F19161D3E05313F281B2B071E22 + 2];
                    $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 = $slotSettings->reelStrip2[$_obf_0D40170234191D12013C08112D373F23141F21271C4022 + 2];
                    $_obf_0D3711263310365C0639400E142F04143C011B5B240322 = $slotSettings->reelStrip3[$_obf_0D302D052E271A03052B5C2E3032091F292B160D0A5C32 + 2];
                    $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 .= (',' . $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 . ',' . $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 . ',' . $_obf_0D3711263310365C0639400E142F04143C011B5B240322 . ',' . $_obf_0D2A1A1E150D142B17291236053731323D0109193B1211 . ',' . $_obf_0D103336361B0A5B3F10403C3E2D055C2E190F16351F11);
                    $bet = $slotSettings->Bet[0];
                }
                $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = json_encode($slotSettings);
                $lang = json_encode(\Lang::get('games.' . $game));
                $Balance = $slotSettings->GetBalance();
                $_obf_0D07090A3536260613220B0635262A1B212D012C0F0132 = implode(',', $slotSettings->reelStrip1) . '~' . implode(',', $slotSettings->reelStrip2) . '~' . implode(',', $slotSettings->reelStrip3) . '~' . implode(',', $slotSettings->reelStrip4) . '~' . implode(',', $slotSettings->reelStrip5) . '';
                $_obf_0D050C15013D2F0C251014162936361513040427022201 = implode(',', $slotSettings->reelStripBonus1) . '~' . implode(',', $slotSettings->reelStripBonus2) . '~' . implode(',', $slotSettings->reelStripBonus3) . '~' . implode(',', $slotSettings->reelStripBonus4) . '~' . implode(',', $slotSettings->reelStripBonus5) . '';
                $response = 'wsc=1~bg~50,10,1,0,0~0,0,0,0,0~fs~50,10,1,0,0~10,10,10,0,0&def_s=5,8,7,9,8,8,7,3,4,4,11,6,8,11,10' . $_obf_0D2C3210261C5C0E39023D123B240D292A062F141C1532 . '&balance=' . $Balance . '&cfgs=1&ver=2&index=1&balance_cash=' . $Balance . '&reel_set_size=2&def_sb=8,8,7,5,9&def_sa=9,1,8,4,10&balance_bonus=0.00&na=s&scatters=&gmb=0,0,0&rt=d&stime=' . floor(microtime(true) * 1000) . '&sa=9,1,8,4,10&sb=8,8,7,5,9&sc=' . implode(',', $slotSettings->Bet) . '&defc=' . $slotSettings->Bet[0] . '&sh=3&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c=' . $slotSettings->Bet[0] . '&sver=5&n_reel_set=0&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;5000,1000,100,10,0;2000,400,40,5,0;500,100,15,2,0;500,100,15,2,0;150,40,5,0,0;150,40,5,0,0;100,25,5,0,0;100,25,5,0,0;100,25,5,0,0&l=10&rtp=96.13&reel_set0=' . $_obf_0D07090A3536260613220B0635262A1B212D012C0F0132 . '&s=' . $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 . '&reel_set1=' . $_obf_0D050C15013D2F0C251014162936361513040427022201 . '';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'gamble5GetUserCards' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = rand(1, $slotSettings->GetGambleSettings());
                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $slotSettings->GetGameData('AncientEgyptPMMDealerCard');
                $totalWin = $slotSettings->GetGameData('AncientEgyptPMMTotalWin');
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
                $slotSettings->SetGameData('AncientEgyptPMMTotalWin', $totalWin);
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
                $slotSettings->SetGameData('AncientEgyptPMMDealerCard', $_obf_0D1A28330223330201021115084008123B0F213C102922);
                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D07380D0B2F2F240918081F3F2A042730295C091F2132[$_obf_0D1A28330223330201021115084008123B0F213C102922] . $_obf_0D112B16351A0D0D02250E1F401526150C21152B143932[rand(0, 3)];
                $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = '{"dealerCard":"' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 . '"}';
                $response = '{"responseEvent":"gamble5DealerCard","serverResponse":' . $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 . '}';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'slotGamble' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = rand(1, $slotSettings->GetGambleSettings());
                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = '';
                $totalWin = $slotSettings->GetGameData('AncientEgyptPMMTotalWin');
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
                $slotSettings->SetGameData('AncientEgyptPMMTotalWin', $totalWin);
                $slotSettings->SetBalance($_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22);
                $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 * -1);
                $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 = $slotSettings->GetBalance();
                $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = '{"dealerCard":"' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 . '","gambleState":"' . $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 . '","totalWin":' . $totalWin . ',"afterBalance":' . $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 . ',"Balance":' . $Balance . '}';
                $response = '{"responseEvent":"gambleResult","serverResponse":' . $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 . '}';
                $slotSettings->SaveLogReport($response, $_obf_0D3310323F3F07041133133D263014342B230C260D1F11, 1, $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'doBonus' ) 
            {
                $_obf_0D1A10042F1C191310185C131108173E21101B37171911 = $slotSettings->GetGameData('AncientEgyptPMMBonusState');
                $Balance = $slotSettings->GetBalance();
                if( $_obf_0D1A10042F1C191310185C131108173E21101B37171911 == 0 ) 
                {
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ind'] == 1 ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ind'] = 0;
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ind'] == 0 ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ind'] = 1;
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ind'] == 2 ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ind'] = 2;
                    }
                    $_obf_0D142C241F1B181D2723252601234035375B141A063811 = $slotSettings->GetGameData('AncientEgyptPMMBonusWin');
                    $_obf_0D0231242F16365B3C1D071E3B263319262A16261D2F01 = $slotSettings->GetGameData('AncientEgyptPMMAllBet');
                    $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622 = [
                        12, 
                        12, 
                        12, 
                        12
                    ];
                    for( $i = 0; $i <= 200; $i++ ) 
                    {
                        shuffle($_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622);
                        if( $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[0] > 12 || $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[0] <= 10 && $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[0] * $_obf_0D0231242F16365B3C1D071E3B263319262A16261D2F01 <= $bank ) 
                        {
                            break;
                        }
                    }
                    $_obf_0D1033143327053F123D0C2D36073B192E231519121D01 = [
                        0, 
                        0, 
                        0
                    ];
                    $_obf_0D2F32380938172D2D350B31100125364040362C010411 = [
                        $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[1], 
                        $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[2], 
                        $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[3]
                    ];
                    $_obf_0D04371E160D372C12381632101E1F5B141D220A323222 = [
                        'w', 
                        'w', 
                        'w'
                    ];
                    if( $_obf_0D2F32380938172D2D350B31100125364040362C010411[0] > 10 ) 
                    {
                        $_obf_0D2F32380938172D2D350B31100125364040362C010411[0] = 10;
                        $_obf_0D04371E160D372C12381632101E1F5B141D220A323222[1] = 'ms';
                    }
                    if( $_obf_0D2F32380938172D2D350B31100125364040362C010411[1] > 10 ) 
                    {
                        $_obf_0D2F32380938172D2D350B31100125364040362C010411[1] = 10;
                        $_obf_0D04371E160D372C12381632101E1F5B141D220A323222[0] = 'ms';
                    }
                    if( $_obf_0D2F32380938172D2D350B31100125364040362C010411[2] > 10 ) 
                    {
                        $_obf_0D2F32380938172D2D350B31100125364040362C010411[2] = 10;
                        $_obf_0D04371E160D372C12381632101E1F5B141D220A323222[2] = 'ms';
                    }
                    $_obf_0D1033143327053F123D0C2D36073B192E231519121D01[$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ind']] = 1;
                    $_obf_0D2F32380938172D2D350B31100125364040362C010411[$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ind']] = $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[0];
                    if( $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[0] <= 10 ) 
                    {
                        $_obf_0D2424172A0A29310B11362101282921010B0630112D11 = $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[0] * $_obf_0D0231242F16365B3C1D071E3B263319262A16261D2F01;
                        $slotSettings->SetBalance($_obf_0D2424172A0A29310B11362101282921010B0630112D11);
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $_obf_0D2424172A0A29310B11362101282921010B0630112D11);
                        $_obf_0D142C241F1B181D2723252601234035375B141A063811 += $_obf_0D2424172A0A29310B11362101282921010B0630112D11;
                        $Balance = $slotSettings->GetBalance();
                        $response = 'tw=' . $_obf_0D142C241F1B181D2723252601234035375B141A063811 . '&bgid=0&balance=' . $Balance . '&wins=' . implode(',', $_obf_0D2F32380938172D2D350B31100125364040362C010411) . '&coef=' . $_obf_0D0231242F16365B3C1D071E3B263319262A16261D2F01 . '&level=1&index=10&balance_cash=' . $Balance . '&balance_bonus=0.00&na=cb&status=' . implode(',', $_obf_0D1033143327053F123D0C2D36073B192E231519121D01) . '&rw=' . $_obf_0D2424172A0A29310B11362101282921010B0630112D11 . '&stime=' . floor(microtime(true) * 1000) . '&bgt=9&lifes=0&wins_mask=' . implode(',', $_obf_0D04371E160D372C12381632101E1F5B141D220A323222) . '&wp=' . $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[0] . '&end=1&sver=5&counter=20';
                    }
                    else
                    {
                        $_obf_0D2F32380938172D2D350B31100125364040362C010411[$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ind']] = '10';
                        $response = 'tw=' . $_obf_0D142C241F1B181D2723252601234035375B141A063811 . '&fsmul=1&bgid=0&balance=' . $Balance . '&wins=' . implode(',', $_obf_0D2F32380938172D2D350B31100125364040362C010411) . '&coef=' . $_obf_0D0231242F16365B3C1D071E3B263319262A16261D2F01 . '&fsmax=10&level=1&index=83&balance_cash=' . $Balance . '&balance_bonus=0.00&na=m&fswin=0.00&status=' . implode(',', $_obf_0D1033143327053F123D0C2D36073B192E231519121D01) . '&rw=0.00&stime=' . floor(microtime(true) * 1000) . '&fs=1&bgt=9&lifes=0&wins_mask=' . implode(',', $_obf_0D04371E160D372C12381632101E1F5B141D220A323222) . '&wp=0&end=1&fsres=0.00&sver=5&counter=166';
                    }
                    $_obf_0D1A10042F1C191310185C131108173E21101B37171911++;
                }
                $slotSettings->SetGameData('AncientEgyptPMMBonusState', $_obf_0D1A10042F1C191310185C131108173E21101B37171911);
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'doMysteryScatter' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $rSym = rand(3, 11);
                $slotSettings->SetGameData('AncientEgyptPMMFreeGames', $slotSettings->slotFreeCount);
                $slotSettings->SetGameData('AncientEgyptPMMCurrentFreeGame', 0);
                $slotSettings->SetGameData('AncientEgyptPMMSym', $rSym);
                $response = 'fsmul=1&balance=' . $Balance . '&fsmax=10&ms=' . $rSym . '&index=84&balance_cash=' . $Balance . '&balance_bonus=0.00&na=s&fswin=0.00&stime=' . floor(microtime(true) * 1000) . '&fs=1&fsres=0.00&sver=5&n_reel_set=0&counter=168';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'doCollect' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'doCollectBonus' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $response = 'balance=' . $Balance . '&index=' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['index'] . '&balance_cash=' . $Balance . '&balance_bonus=0.00&na=s&stime=' . floor(microtime(true) * 1000) . '&sver=5&counter=' . ((int)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['counter'] + 1);
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'doSpin' ) 
            {
                if( $slotSettings->GetGameData('AncientEgyptPMMCurrentFreeGame') < $slotSettings->GetGameData('AncientEgyptPMMFreeGames') && $slotSettings->GetGameData('AncientEgyptPMMFreeGames') > 0 ) 
                {
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                }
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
                    1, 
                    1, 
                    1, 
                    2
                ];
                $linesId[6] = [
                    2, 
                    3, 
                    3, 
                    3, 
                    2
                ];
                $linesId[7] = [
                    1, 
                    1, 
                    2, 
                    3, 
                    3
                ];
                $linesId[8] = [
                    3, 
                    3, 
                    2, 
                    1, 
                    1
                ];
                $linesId[9] = [
                    2, 
                    3, 
                    2, 
                    1, 
                    2
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422 = [];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[0] = [
                    0, 
                    5, 
                    10
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[1] = [
                    1, 
                    6, 
                    11
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[2] = [
                    2, 
                    7, 
                    12
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[3] = [
                    3, 
                    8, 
                    13
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[4] = [
                    4, 
                    9, 
                    14
                ];
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['c'];
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] = 10;
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
                    $slotSettings->SetGameData('AncientEgyptPMMBonusWin', 0);
                    $slotSettings->SetGameData('AncientEgyptPMMFreeGames', 0);
                    $slotSettings->SetGameData('AncientEgyptPMMCurrentFreeGame', 0);
                    $slotSettings->SetGameData('AncientEgyptPMMTotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                    $slotSettings->SetGameData('AncientEgyptPMMBonusState', 0);
                    $slotSettings->SetGameData('AncientEgyptPMMBonusMpl', 0);
                    $slotSettings->SetGameData('AncientEgyptPMMSym', 0);
                    $slotSettings->SetGameData('AncientEgyptPMMAllBet', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines']);
                }
                else
                {
                    $slotSettings->SetGameData('AncientEgyptPMMCurrentFreeGame', $slotSettings->GetGameData('AncientEgyptPMMCurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->GetGameData('AncientEgyptPMMBonusMpl');
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
                    $wild = '1';
                    $scatter = '1';
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
                                $s[3] = $reels['reel4'][$linesId[$k][3] - 1];
                                $s[4] = $reels['reel5'][$linesId[$k][4] - 1];
                                if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[0]) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[1]) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[2]) ) 
                                {
                                    if( $wild == $s[0] && $wild == $s[1] && $wild == $s[2] ) 
                                    {
                                        $mpl = 0;
                                    }
                                    else if( $wild == $s[0] || $wild == $s[1] || $wild == $s[2] ) 
                                    {
                                        $mpl = $slotSettings->slotWildMpl;
                                    }
                                    else
                                    {
                                        $mpl = 1;
                                    }
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable[$_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $bonusMpl * $mpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D301D22400C2B0C292E2C04343E153F053F3019010222 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[0][$linesId[$k][0] - 1];
                                        $_obf_0D5C1222360805242B3126212232015B2730031C133E22 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[1][$linesId[$k][1] - 1];
                                        $_obf_0D3432221004160213383F5B5B3E0C192E3F3510372132 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[2][$linesId[$k][2] - 1];
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = 'l' . $_obf_0D2414131D3935192D0D3E211013194027391F1F2C0411 . '=' . $k . '~' . $cWins[$k] . '~' . $_obf_0D301D22400C2B0C292E2C04343E153F053F3019010222 . '~' . $_obf_0D5C1222360805242B3126212232015B2730031C133E22 . '~' . $_obf_0D3432221004160213383F5B5B3E0C192E3F3510372132 . '';
                                    }
                                }
                                if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[0]) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[1]) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[2]) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[3]) ) 
                                {
                                    if( $wild == $s[0] && $wild == $s[1] && $wild == $s[2] && $wild == $s[3] ) 
                                    {
                                        $mpl = 0;
                                    }
                                    else if( $wild == $s[0] || $wild == $s[1] || $wild == $s[2] || $wild == $s[3] ) 
                                    {
                                        $mpl = $slotSettings->slotWildMpl;
                                    }
                                    else
                                    {
                                        $mpl = 1;
                                    }
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable[$_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $bonusMpl * $mpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D301D22400C2B0C292E2C04343E153F053F3019010222 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[0][$linesId[$k][0] - 1];
                                        $_obf_0D5C1222360805242B3126212232015B2730031C133E22 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[1][$linesId[$k][1] - 1];
                                        $_obf_0D3432221004160213383F5B5B3E0C192E3F3510372132 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[2][$linesId[$k][2] - 1];
                                        $_obf_0D350B2E271D23091D281017262F123E3736102E2E2F11 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[3][$linesId[$k][3] - 1];
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = 'l' . $_obf_0D2414131D3935192D0D3E211013194027391F1F2C0411 . '=' . $k . '~' . $cWins[$k] . '~' . $_obf_0D301D22400C2B0C292E2C04343E153F053F3019010222 . '~' . $_obf_0D5C1222360805242B3126212232015B2730031C133E22 . '~' . $_obf_0D3432221004160213383F5B5B3E0C192E3F3510372132 . '~' . $_obf_0D350B2E271D23091D281017262F123E3736102E2E2F11 . '';
                                    }
                                }
                                if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[0]) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[1]) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[2]) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[3]) && ($s[4] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || $wild == $s[4]) ) 
                                {
                                    if( $wild == $s[0] && $wild == $s[1] && $wild == $s[2] && $wild == $s[3] && $wild == $s[4] ) 
                                    {
                                        $mpl = 0;
                                    }
                                    else if( $wild == $s[0] || $wild == $s[1] || $wild == $s[2] || $wild == $s[3] || $wild == $s[4] ) 
                                    {
                                        $mpl = $slotSettings->slotWildMpl;
                                    }
                                    else
                                    {
                                        $mpl = 1;
                                    }
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable[$_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $bonusMpl * $mpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D301D22400C2B0C292E2C04343E153F053F3019010222 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[0][$linesId[$k][0] - 1];
                                        $_obf_0D5C1222360805242B3126212232015B2730031C133E22 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[1][$linesId[$k][1] - 1];
                                        $_obf_0D3432221004160213383F5B5B3E0C192E3F3510372132 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[2][$linesId[$k][2] - 1];
                                        $_obf_0D350B2E271D23091D281017262F123E3736102E2E2F11 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[3][$linesId[$k][3] - 1];
                                        $_obf_0D112D09111C3E3F0A5C290104362E373F10342F2E1C32 = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[4][$linesId[$k][4] - 1];
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = 'l' . $_obf_0D2414131D3935192D0D3E211013194027391F1F2C0411 . '=' . $k . '~' . $cWins[$k] . '~' . $_obf_0D301D22400C2B0C292E2C04343E153F053F3019010222 . '~' . $_obf_0D5C1222360805242B3126212232015B2730031C133E22 . '~' . $_obf_0D3432221004160213383F5B5B3E0C192E3F3510372132 . '~' . $_obf_0D350B2E271D23091D281017262F123E3736102E2E2F11 . '~' . $_obf_0D112D09111C3E3F0A5C290104362E373F10342F2E1C32 . '';
                                    }
                                }
                            }
                        }
                        if( $cWins[$k] > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                        {
                            array_push($lineWins, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                            $_obf_0D2414131D3935192D0D3E211013194027391F1F2C0411++;
                            $totalWin += $cWins[$k];
                        }
                    }
                    $scattersStr = [];
                    $_obf_0D24263035301D1D2F05213C312414350B3B1317353E11 = [];
                    $scattersCount = 0;
                    $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 = 0;
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = '';
                    $_obf_0D1103183E22072D2511390A1B145C25235C2407082111 = $reels;
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                        {
                            if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == $scatter ) 
                            {
                                $scattersCount++;
                                $scattersStr[] = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[$r - 1][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32];
                            }
                            if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == $slotSettings->GetGameData('AncientEgyptPMMSym') ) 
                            {
                                $_obf_0D28301D333F2827165C2511011438180336175B1E2A01++;
                                $_obf_0D24263035301D1D2F05213C312414350B3B1317353E11[] = $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[$r - 1][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32];
                                break;
                            }
                        }
                    }
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                        {
                            if( $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == $slotSettings->GetGameData('AncientEgyptPMMSym') ) 
                            {
                                $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel' . $r][0] = $slotSettings->GetGameData('AncientEgyptPMMSym');
                                $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel' . $r][1] = $slotSettings->GetGameData('AncientEgyptPMMSym');
                                $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel' . $r][2] = $slotSettings->GetGameData('AncientEgyptPMMSym');
                                break;
                            }
                        }
                    }
                    if( isset($slotSettings->Paytable[$scatter]) ) 
                    {
                        $scattersWin = $slotSettings->Paytable[$scatter][$scattersCount] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] * $bonusMpl;
                    }
                    else
                    {
                        $scattersWin = 0;
                    }
                    if( isset($slotSettings->Paytable[$slotSettings->GetGameData('AncientEgyptPMMSym')]) && $slotSettings->Paytable[$slotSettings->GetGameData('AncientEgyptPMMSym')][$_obf_0D28301D333F2827165C2511011438180336175B1E2A01] > 0 ) 
                    {
                        $_obf_0D2C1A321706030F3F1225352E343107190E393C131522 = $slotSettings->Paytable['' . $slotSettings->GetGameData('AncientEgyptPMMSym')][$_obf_0D28301D333F2827165C2511011438180336175B1E2A01] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] * $bonusMpl;
                    }
                    else
                    {
                        $_obf_0D2C1A321706030F3F1225352E343107190E393C131522 = 0;
                    }
                    if( $scattersWin > 0 ) 
                    {
                        $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 .= ('&psym=1~' . $scattersWin . '~' . implode(',', $scattersStr));
                    }
                    if( $_obf_0D2C1A321706030F3F1225352E343107190E393C131522 > 0 ) 
                    {
                        $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 .= ('&psym=' . $slotSettings->GetGameData('AncientEgyptPMMSym') . '~' . $scattersWin . '~' . implode(',', $scattersStr));
                        $_obf_0D303D0524240F14012F0E3E3C3129321B3B342A2B0332 = $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel1'][0] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel2'][0] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel3'][0] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel4'][0] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel5'][0] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel1'][1] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel2'][1] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel3'][1] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel4'][1] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel5'][1] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel1'][2] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel2'][2] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel3'][2] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel4'][2] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel5'][2];
                        $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 .= ('&mes=' . $_obf_0D303D0524240F14012F0E3E3C3129321B3B342A2B0332);
                    }
                    $totalWin += ($scattersWin + $_obf_0D2C1A321706030F3F1225352E343107190E393C131522);
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
                $spinType = 's';
                if( $totalWin > 0 ) 
                {
                    $spinType = 'c';
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                }
                $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                if( $scattersCount >= 3 ) 
                {
                    if( $slotSettings->GetGameData('AncientEgyptPMMFreeGames') == 0 ) 
                    {
                        $slotSettings->SetGameData('AncientEgyptPMMBonusMpl', 1);
                        $spinType = 'b&status=0,0,0&rw=0.00&wins=0,0,0&bw=1&wins_mask=h,h,h&wp=0&end=0&bgt=28';
                    }
                    else
                    {
                        $slotSettings->SetGameData('AncientEgyptPMMFreeGames', $slotSettings->GetGameData('AncientEgyptPMMFreeGames') + $slotSettings->slotFreeCount);
                    }
                }
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData('AncientEgyptPMMBonusWin', $slotSettings->GetGameData('AncientEgyptPMMBonusWin') + $totalWin);
                    $slotSettings->SetGameData('AncientEgyptPMMTotalWin', $slotSettings->GetGameData('AncientEgyptPMMTotalWin') + $totalWin);
                    $spinType = 's';
                    $Balance = $slotSettings->GetGameData('AncientEgyptPMMFreeBalance');
                    if( $slotSettings->GetGameData('AncientEgyptPMMFreeGames') <= $slotSettings->GetGameData('AncientEgyptPMMCurrentFreeGame') && $slotSettings->GetGameData('AncientEgyptPMMFreeGames') > 0 ) 
                    {
                        $spinType = 'c';
                        $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 .= ('&ms=' . $slotSettings->GetGameData('AncientEgyptPMMSym') . '&fs_total=' . $slotSettings->GetGameData('AncientEgyptPMMFreeGames') . '&fsmul_total=' . $slotSettings->GetGameData('AncientEgyptPMMBonusMpl') . '&fswin_total=' . $slotSettings->GetGameData('AncientEgyptPMMBonusWin') . '&fsres_total=' . $slotSettings->GetGameData('AncientEgyptPMMBonusWin') . '');
                    }
                    else
                    {
                        $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 .= ('&ms=' . $slotSettings->GetGameData('AncientEgyptPMMSym') . '&fsmul=' . $slotSettings->GetGameData('AncientEgyptPMMBonusMpl') . '&fsmax=' . $slotSettings->GetGameData('AncientEgyptPMMFreeGames') . '&fswin=' . $slotSettings->GetGameData('AncientEgyptPMMTotalWin') . '&fs=' . $slotSettings->GetGameData('AncientEgyptPMMCurrentFreeGame') . '&fsres=' . $slotSettings->GetGameData('AncientEgyptPMMBonusWin'));
                    }
                    $_obf_0D5C3B1F210914123C222630290E271410213E320B0A11 = $totalWin / $bonusMpl;
                }
                else
                {
                    $_obf_0D5C3B1F210914123C222630290E271410213E320B0A11 = $totalWin;
                    $slotSettings->SetGameData('AncientEgyptPMMTotalWin', $totalWin);
                    $slotSettings->SetGameData('AncientEgyptPMMBonusWin', $totalWin);
                }
                $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 .= ('&' . implode('&', $lineWins));
                $s = $reels['reel1'][0] . ',' . $reels['reel2'][0] . ',' . $reels['reel3'][0] . ',' . $reels['reel4'][0] . ',' . $reels['reel5'][0] . ',' . $reels['reel1'][1] . ',' . $reels['reel2'][1] . ',' . $reels['reel3'][1] . ',' . $reels['reel4'][1] . ',' . $reels['reel5'][1] . ',' . $reels['reel1'][2] . ',' . $reels['reel2'][2] . ',' . $reels['reel3'][2] . ',' . $reels['reel4'][2] . ',' . $reels['reel5'][2];
                $response = 'tw=' . $slotSettings->GetGameData('AncientEgyptPMMBonusWin') . '&bstate=' . $slotSettings->GetGameData('AncientEgyptPMMBonusState') . '&balance=' . $Balance . '&index=' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['index'] . '&balance_cash=' . $Balance . '&balance_bonus=0.00' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '&na=' . $spinType . '&stime=' . floor(microtime(true) * 1000) . '&sa=' . $reels['reel1'][3] . ',' . $reels['reel2'][3] . ',' . $reels['reel3'][3] . ',' . $reels['reel4'][3] . ',' . $reels['reel5'][3] . '&sb=' . $reels['reel1'][-1] . ',' . $reels['reel2'][-1] . ',' . $reels['reel3'][-1] . ',' . $reels['reel4'][-1] . ',' . $reels['reel5'][-1] . '&sh=3&c=0.01&sver=5&n_reel_set=0&counter=' . ((int)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['counter'] + 1) . '&l=10&s=' . $s . '&w=' . $_obf_0D5C3B1F210914123C222630290E271410213E320B0A11 . '';
                if( $slotSettings->GetGameData('AncientEgyptPMMFreeGames') <= $slotSettings->GetGameData('AncientEgyptPMMCurrentFreeGame') && $slotSettings->GetGameData('AncientEgyptPMMFreeGames') > 0 ) 
                {
                    $slotSettings->SetGameData('AncientEgyptPMMTotalWin', 0);
                    $slotSettings->SetGameData('AncientEgyptPMMBonusWin', 0);
                }
                $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"Sym":' . $slotSettings->GetGameData('AncientEgyptPMMSym') . ',"BonusMpl":' . $slotSettings->GetGameData('AncientEgyptPMMBonusMpl') . ',"lines":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] . ',"bet":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] . ',"totalFreeGames":' . $slotSettings->GetGameData('AncientEgyptPMMFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('AncientEgyptPMMCurrentFreeGame') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData('AncientEgyptPMMBonusWin') . ',"winLines":[],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'], $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                if( $scattersCount >= 3 ) 
                {
                    if( $slotSettings->GetGameData('AncientEgyptPMMFreeGames') > 0 ) 
                    {
                        $slotSettings->SetGameData('AncientEgyptPMMBonusWin', $totalWin);
                    }
                    else
                    {
                        $slotSettings->SetGameData('AncientEgyptPMMFreeBalance', $Balance);
                        $slotSettings->SetGameData('AncientEgyptPMMTotalWin', 0);
                        $slotSettings->SetGameData('AncientEgyptPMMBonusState', 0);
                        $slotSettings->SetGameData('AncientEgyptPMMBonusWin', $totalWin);
                    }
                }
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
