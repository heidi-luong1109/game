<?php 
namespace VanguardLTE\Games\RouletteRoyalAM
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
            $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01 = 100;
            $response = '';
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01;
            $gameData = [];
            $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11 = explode(',', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gameData']);
            $gameData['slotEvent'] = $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[0];
            if( $gameData['slotEvent'] == 'A/u251' || $gameData['slotEvent'] == 'A/u256' ) 
            {
                if( $gameData['slotEvent'] == 'A/u256' && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') > 0 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $gameData['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                    return $response;
                }
                if( $slotSettings->GetBalance() < ($_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] * $slotSettings->Bet[$_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2]]) && $gameData['slotEvent'] == 'A/u251' ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $gameData['slotEvent'] . '","serverResponse":"invalid balance"}';
                    return $response;
                }
                if( !isset($slotSettings->Bet[$_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2]]) || $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] <= 0 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $gameData['slotEvent'] . '","serverResponse":"invalid bet/lines"}';
                    return $response;
                }
            }
            if( $gameData['slotEvent'] == 'A/u257' && $slotSettings->GetGameData($slotSettings->slotId . 'DoubleWin') <= 0 ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $gameData['slotEvent'] . '","serverResponse":"invalid gamble state"}';
                exit( $response );
            }
            if( $gameData['slotEvent'] == 'A/u256' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] = 'free';
                $gameData['slotEvent'] = 'A/u251';
            }
            else
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] = 'regular';
            }
            switch( $gameData['slotEvent'] ) 
            {
                case 'A/u350':
                    $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    if( !is_numeric($_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032) ) 
                    {
                        $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = 0;
                    }
                    $balance = $slotSettings->GetBalance() - $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032;
                    $response = 'UPDATE#' . (sprintf('%01.2f', $balance) * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                    break;
                case 'A/u25':
                    $slotSettings->SetGameData($slotSettings->slotId . 'Cards', [
                        '00', 
                        '00', 
                        '00', 
                        '00', 
                        '00', 
                        '00', 
                        '00', 
                        '00'
                    ]);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', 0);
                    $_obf_0D1232390F2B2F2804320E372416331A16210414221F01 = $slotSettings->Bet;
                    $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 = '';
                    for( $b = 0; $b < count($_obf_0D1232390F2B2F2804320E372416331A16210414221F01); $b++ ) 
                    {
                        $_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b] = (double)$_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01;
                        $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 .= (dechex(strlen(dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b]))) . dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b]));
                    }
                    $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $_obf_0D265B3F0D300409082D06243718342A223923280D3F32 = 1000;
                    $_obf_0D23055B0A241C163E121715380E1F0B281B012A2B2C01 = 10000;
                    $_obf_0D32351B250A08092B032C331E3B252F1A181F12041332 = 100;
                    $_obf_0D300F0111243F072A242E3D2B35283606320D322B1D01 = 100;
                    $_obf_0D360721241F5C5B26390E314005042A31240D3B1D2601 = 10;
                    $_obf_0D013C3F1E070C340F39131E0F191117170E1236322C01 = 10;
                    $_obf_0D081A0C34393710310C37150202271C1B162B0E332111 = 10;
                    $_obf_0D2A023018131A0C0328281E5B2623092B18040B1D0711 = 10;
                    $_obf_0D01080A3F1C0124221A131B0B21181638263804162911 = 1;
                    $_obf_0D29070B03302222112B35180E2230103F1B3F36221F22 = '';
                    $_obf_0D060F080B363415280B1F260E5B152B330436055C3032 = [];
                    for( $i = 1; $i <= 16; $i++ ) 
                    {
                        $num = $slotSettings->HexFormat(rand(0, 36));
                        $_obf_0D060F080B363415280B1F260E5B152B330436055C3032[] = $num;
                        $_obf_0D29070B03302222112B35180E2230103F1B3F36221F22 .= $num;
                    }
                    if( $slotSettings->HasGameData('RouletteRoyalAMHistory') ) 
                    {
                        $_obf_0D29070B03302222112B35180E2230103F1B3F36221F22 = implode('', $slotSettings->GetGameData('RouletteRoyalAMHistory'));
                    }
                    else
                    {
                        $slotSettings->SetGameData('RouletteRoyalAMHistory', $_obf_0D060F080B363415280B1F260E5B152B330436055C3032);
                    }
                    $response = '005010' . $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 . '108ffffffff10' . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . $slotSettings->HexFormat($_obf_0D23055B0A241C163E121715380E1F0B281B012A2B2C01 * 100) . $slotSettings->HexFormat($_obf_0D360721241F5C5B26390E314005042A31240D3B1D2601 * 100) . $slotSettings->HexFormat($_obf_0D013C3F1E070C340F39131E0F191117170E1236322C01 * 100) . $slotSettings->HexFormat($_obf_0D2A023018131A0C0328281E5B2623092B18040B1D0711 * 100) . $slotSettings->HexFormat($_obf_0D081A0C34393710310C37150202271C1B162B0E332111 * 100) . $slotSettings->HexFormat($_obf_0D32351B250A08092B032C331E3B252F1A181F12041332 * 100) . $slotSettings->HexFormat($_obf_0D300F0111243F072A242E3D2B35283606320D322B1D01 * 100) . $slotSettings->HexFormat($_obf_0D265B3F0D300409082D06243718342A223923280D3F32 * 100) . $slotSettings->HexFormat($_obf_0D01080A3F1C0124221A131B0B21181638263804162911 * 100) . '1010101010101010' . $_obf_0D29070B03302222112B35180E2230103F1B3F36221F22 . '10101010101010101010101010101010101010101010101010101010101010101010101010null#';
                    break;
                case 'A/u250':
                    $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $response = '100010' . $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 . '108ffffffff10null';
                    break;
                case 'A/u291':
                    $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11 = explode('A/u291,', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gameData']);
                    $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022 = [];
                    $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['straight'] = 36;
                    $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['split'] = 18;
                    $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['street'] = 12;
                    $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['corner'] = 9;
                    $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['line'] = 6;
                    $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['column'] = 3;
                    $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['twelve'] = 3;
                    $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['low'] = 2;
                    $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['high'] = 2;
                    $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['red'] = 2;
                    $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['black'] = 2;
                    $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['odd'] = 2;
                    $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022['even'] = 2;
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32 = [];
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['zero'] = 0;
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['straight'] = 0;
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['split'] = 0;
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['street'] = 0;
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['corner'] = 0;
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['line'] = 0;
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['column'] = 0;
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['twelve'] = 0;
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['low'] = 0;
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['high'] = 0;
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['red'] = 0;
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['black'] = 0;
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['odd'] = 0;
                    $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['even'] = 0;
                    $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        $_obf_0D1C39272B1F0E1E2A37320F27323D2E40273B17150922 = rand(0, 36);
                        $_obf_0D0A171D1E131B3B352E0E37172D40181B133D210C2722 = [];
                        $totalWin = 0;
                        $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 = 0;
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bets'] = explode('|', $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1]);
                        foreach( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bets'] as $key => $vl ) 
                        {
                            $vl = explode('$', $vl);
                            if( !isset($vl[1]) ) 
                            {
                                continue;
                            }
                            $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 += ($vl[1] / 100);
                            $_obf_0D182D342D210D092E5B031331351F0A192A382F2A0F32 = $slotSettings->GetNumbersByField($vl[0]);
                            if( $_obf_0D182D342D210D092E5B031331351F0A192A382F2A0F32[0] == 'straight' && $_obf_0D182D342D210D092E5B031331351F0A192A382F2A0F32[1][0] == '0' ) 
                            {
                                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['zero'] = 1;
                            }
                            else
                            {
                                $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32[$_obf_0D182D342D210D092E5B031331351F0A192A382F2A0F32[0]]++;
                            }
                            if( in_array($_obf_0D1C39272B1F0E1E2A37320F27323D2E40273B17150922, $_obf_0D182D342D210D092E5B031331351F0A192A382F2A0F32[1]) ) 
                            {
                                $_obf_0D142C241F1B181D2723252601234035375B141A063811 = $_obf_0D383E1F03322F35370F0E1E0D362333131C2616351022[$_obf_0D182D342D210D092E5B031331351F0A192A382F2A0F32[0]] * ($vl[1] / 100);
                                $totalWin += $_obf_0D142C241F1B181D2723252601234035375B141A063811;
                            }
                        }
                        if( $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 <= 0.0001 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid bet state"}';
                            exit( $response );
                        }
                        if( $slotSettings->GetBalance() < $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid balance"}';
                            exit( $response );
                        }
                        $slotSettings->UpdateJackpots($_obf_0D34351C331E352827231A38333E1A082713062B2B2732);
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 / 100 * $slotSettings->GetPercent();
                        if( $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['zero'] > 0 && ($_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['red'] > 0 && $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['black'] > 0 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['odd'] > 0 && $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['even'] > 0 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['high'] > 0 && $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['low'] > 0 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['twelve'] >= 3 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['column'] >= 3 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['straight'] >= 36) ) 
                        {
                            $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 / 100 * 100;
                        }
                        if( $totalWin <= ($bank + $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622) ) 
                        {
                            break;
                        }
                        if( $i > 1500 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                    }
                    $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 / 100 * $slotSettings->GetPercent();
                    if( $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['zero'] > 0 && ($_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['red'] > 0 && $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['black'] > 0 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['odd'] > 0 && $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['even'] > 0 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['high'] > 0 && $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['low'] > 0 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['twelve'] >= 3 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['column'] >= 3 || $_obf_0D1D0E363D1618342C3D3F1F04212F1E10091112343B32['straight'] >= 36) ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D34351C331E352827231A38333E1A082713062B2B2732);
                        $slotSettings->SetBalance(-1 * $_obf_0D34351C331E352827231A38333E1A082713062B2B2732, 'bet');
                    }
                    else
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                        $slotSettings->SetBalance(-1 * $_obf_0D34351C331E352827231A38333E1A082713062B2B2732, 'bet');
                    }
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                        $slotSettings->SetBalance($totalWin);
                    }
                    $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $_obf_0D060F080B363415280B1F260E5B152B330436055C3032 = $slotSettings->GetGameData('RouletteRoyalAMHistory');
                    array_shift($_obf_0D060F080B363415280B1F260E5B152B330436055C3032);
                    array_push($_obf_0D060F080B363415280B1F260E5B152B330436055C3032, $slotSettings->HexFormat($_obf_0D1C39272B1F0E1E2A37320F27323D2E40273B17150922));
                    $slotSettings->SetGameData('RouletteRoyalAMHistory', $_obf_0D060F080B363415280B1F260E5B152B330436055C3032);
                    $response = '105010' . $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 . $slotSettings->HexFormat(round($totalWin * 100)) . $slotSettings->HexFormat($_obf_0D1C39272B1F0E1E2A37320F27323D2E40273B17150922) . '10' . $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1];
                    $slotSettings->SaveLogReport($response, $_obf_0D34351C331E352827231A38333E1A082713062B2B2732, 1, $totalWin, 'bet');
                    break;
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
