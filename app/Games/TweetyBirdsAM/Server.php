<?php 
namespace VanguardLTE\Games\TweetyBirdsAM
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
            $lines = 40;
            $_obf_0D261C3E293911272E102E06115B1E29282A3D11101D22 = 40;
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01;
            $_obf_0D0F172D1118050C402A0F213C1D233038275B3E103101 = dechex($lines + 1);
            if( strlen($_obf_0D0F172D1118050C402A0F213C1D233038275B3E103101) <= 1 ) 
            {
                $_obf_0D0F172D1118050C402A0F213C1D233038275B3E103101 = '0' . $_obf_0D0F172D1118050C402A0F213C1D233038275B3E103101;
            }
            $_obf_0D01361D0A3E2D311F08242223290C1B173C3E1D332432 = dechex($lines);
            if( strlen($_obf_0D01361D0A3E2D311F08242223290C1B173C3E1D332432) <= 1 ) 
            {
                $_obf_0D01361D0A3E2D311F08242223290C1B173C3E1D332432 = '0' . $_obf_0D01361D0A3E2D311F08242223290C1B173C3E1D332432;
            }
            $_obf_0D1A3F383D0C03090B22191D37083D161B302921041222 = '';
            for( $i = 1; $i <= $lines; $i++ ) 
            {
                $_obf_0D1A3F383D0C03090B22191D37083D161B302921041222 .= '10';
            }
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
                    $_obf_0D353903345C2903220A0F1D1410163F37251D5B020711 = '';
                    $_obf_0D1F210640113215055B051B35301630023C18403E2B22 = '';
                    for( $b = 0; $b < count($_obf_0D1232390F2B2F2804320E372416331A16210414221F01); $b++ ) 
                    {
                        $_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b] = (double)$_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01;
                        $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 .= (dechex(strlen(dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b]))) . dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b]));
                    }
                    $_obf_0D353903345C2903220A0F1D1410163F37251D5B020711 .= (strlen(dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[0])) . dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[0]));
                    $_obf_0D1F210640113215055B051B35301630023C18403E2B22 .= (strlen(dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[count($_obf_0D1232390F2B2F2804320E372416331A16210414221F01) - 1] * $lines)) . dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[count($_obf_0D1232390F2B2F2804320E372416331A16210414221F01) - 1] * $lines));
                    $_obf_0D2B230C15322D020F0D262A1538072D011C092D310732 = count($_obf_0D1232390F2B2F2804320E372416331A16210414221F01);
                    $_obf_0D2B230C15322D020F0D262A1538072D011C092D310732 = dechex($_obf_0D2B230C15322D020F0D262A1538072D011C092D310732);
                    if( strlen($_obf_0D2B230C15322D020F0D262A1538072D011C092D310732) <= 1 ) 
                    {
                        $_obf_0D2B230C15322D020F0D262A1538072D011C092D310732 = '0' . $_obf_0D2B230C15322D020F0D262A1538072D011C092D310732;
                    }
                    $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $slotState = '4';
                    $lastEvent = $slotSettings->GetHistory();
                    if( $lastEvent != 'NULL' ) 
                    {
                        $reels = $lastEvent->serverResponse->reelsSymbols;
                        $_obf_0D293D032F341A3B111D1838190A2A5C3F3102121D0D22 = $slotSettings->HexFormat($reels->rp[0]) . $slotSettings->HexFormat($reels->rp[1]) . $slotSettings->HexFormat($reels->rp[2]) . $slotSettings->HexFormat($reels->rp[3]) . $slotSettings->HexFormat($reels->rp[4]);
                        $_obf_0D0231242F16365B3C1D071E3B263319262A16261D2F01 = dechex($lastEvent->serverResponse->slotBet);
                        if( strlen($_obf_0D0231242F16365B3C1D071E3B263319262A16261D2F01) <= 1 ) 
                        {
                            $_obf_0D0231242F16365B3C1D071E3B263319262A16261D2F01 = '0' . $_obf_0D0231242F16365B3C1D071E3B263319262A16261D2F01;
                        }
                        $_obf_0D0D3D19173E372D15391D0C1E1F01030F1E163B5B3222 = dechex($lastEvent->serverResponse->slotLines);
                        if( strlen($_obf_0D0D3D19173E372D15391D0C1E1F01030F1E163B5B3222) <= 1 ) 
                        {
                            $_obf_0D0D3D19173E372D15391D0C1E1F01030F1E163B5B3222 = '0' . $_obf_0D0D3D19173E372D15391D0C1E1F01030F1E163B5B3222;
                        }
                        $slotSettings->SetGameData('TweetyBirdsAMLines', $_obf_0D0D3D19173E372D15391D0C1E1F01030F1E163B5B3222);
                        $_obf_0D0B30181C16391D2B091A263E1F050C2E241D2D142F22 = '11';
                        $slotSettings->SetGameData('TweetyBirdsAMBonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData('TweetyBirdsAMFreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData('TweetyBirdsAMCurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData('TweetyBirdsAMTotalWin', 0);
                        $slotSettings->SetGameData('TweetyBirdsAMFreeBalance', 0);
                        $slotSettings->SetGameData('TweetyBirdsAMFreeStartWin', 0);
                        $_obf_0D2F1816033E36143D160A39333D122840370C160B1D32 = dechex($slotSettings->GetGameData('TweetyBirdsAMFreeGames'));
                        $_obf_0D243812041C191E1B1A3F113E330236293F3D3D105C11 = dechex($slotSettings->GetGameData('TweetyBirdsAMFreeGames') - $slotSettings->GetGameData('TweetyBirdsAMCurrentFreeGame'));
                        $_obf_0D143D1E1E380F351E1138192B253404170B06113D2922 = strlen($_obf_0D2F1816033E36143D160A39333D122840370C160B1D32) . $_obf_0D2F1816033E36143D160A39333D122840370C160B1D32 . strlen($_obf_0D243812041C191E1B1A3F113E330236293F3D3D105C11) . $_obf_0D243812041C191E1B1A3F113E330236293F3D3D105C11;
                        $_obf_0D1F02220D0F2D281D26051502182F0E0C1C3D18350732 = $slotSettings->HexFormat($slotSettings->GetGameData('TweetyBirdsAMBonusWin') * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                        if( $slotSettings->GetGameData('TweetyBirdsAMCurrentFreeGame') < $slotSettings->GetGameData('TweetyBirdsAMFreeGames') && $slotSettings->GetGameData('TweetyBirdsAMFreeGames') > 0 ) 
                        {
                            $slotState = '6';
                            if( $slotSettings->GetGameData('' . $slotSettings->slotId . 'CurrentFreeGame') == 0 ) 
                            {
                                $slotState = '5';
                            }
                        }
                    }
                    else
                    {
                        $slotSettings->SetGameData('TweetyBirdsAMLines', $_obf_0D01361D0A3E2D311F08242223290C1B173C3E1D332432);
                        $slotState = '4';
                        $_obf_0D293D032F341A3B111D1838190A2A5C3F3102121D0D22 = $slotSettings->GetRandomReels();
                        $_obf_0D0231242F16365B3C1D071E3B263319262A16261D2F01 = '00';
                        $_obf_0D0B30181C16391D2B091A263E1F050C2E241D2D142F22 = '11';
                        $_obf_0D143D1E1E380F351E1138192B253404170B06113D2922 = '1010';
                        $_obf_0D1F02220D0F2D281D26051502182F0E0C1C3D18350732 = '10';
                    }
                    $response = '05' . $slotSettings->FormatReelStrips('') . '5' . $slotSettings->FormatReelStrips('Bonus') . '0' . $slotState . '0' . $_obf_0D293D032F341A3B111D1838190A2A5C3F3102121D0D22 . '10' . $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 . $_obf_0D1F02220D0F2D281D26051502182F0E0C1C3D18350732 . $_obf_0D0231242F16365B3C1D071E3B263319262A16261D2F01 . $_obf_0D353903345C2903220A0F1D1410163F37251D5B020711 . $_obf_0D1F210640113215055B051B35301630023C18403E2B22 . $_obf_0D01361D0A3E2D311F08242223290C1B173C3E1D332432 . $_obf_0D143D1E1E380F351E1138192B253404170B06113D2922 . '1010101011' . $_obf_0D01361D0A3E2D311F08242223290C1B173C3E1D332432 . $_obf_0D01361D0A3E2D311F08242223290C1B173C3E1D332432 . '0a1000' . $_obf_0D293D032F341A3B111D1838190A2A5C3F3102121D0D22 . '0000000000000000' . $_obf_0D2B230C15322D020F0D262A1538072D011C092D310732 . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . '3310101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010#00101010|0';
                    break;
                case 'A/u250':
                    $_obf_0D01361D0A3E2D311F08242223290C1B173C3E1D332432 = $slotSettings->GetGameData('TweetyBirdsAMLines');
                    $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $lastEvent = $slotSettings->GetHistory();
                    if( $lastEvent != 'NULL' ) 
                    {
                        $reels = $lastEvent->serverResponse->reelsSymbols;
                        $_obf_0D293D032F341A3B111D1838190A2A5C3F3102121D0D22 = $slotSettings->HexFormat($reels->rp[0]) . $slotSettings->HexFormat($reels->rp[1]) . $slotSettings->HexFormat($reels->rp[2]) . $slotSettings->HexFormat($reels->rp[3]) . $slotSettings->HexFormat($reels->rp[4]);
                    }
                    else
                    {
                        $_obf_0D293D032F341A3B111D1838190A2A5C3F3102121D0D22 = $slotSettings->GetRandomReels();
                    }
                    $response = '100010' . $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 . '10' . $_obf_0D293D032F341A3B111D1838190A2A5C3F3102121D0D22 . '00' . $_obf_0D01361D0A3E2D311F08242223290C1B173C3E1D332432 . '10101010101010101010100b101010101010101010101014311d0c18190208#101010';
                    break;
                case 'A/u251':
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'regular' && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') ) 
                    {
                        $umid = '0';
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                        $bonusMpl = 1;
                        $slotSettings->SetGameData('TweetyBirdsAMBonusWin', 0);
                        $slotSettings->SetGameData('TweetyBirdsAMFreeGames', 0);
                        $slotSettings->SetGameData('TweetyBirdsAMCurrentFreeGame', 0);
                        $slotSettings->SetGameData('TweetyBirdsAMTotalWin', 0);
                        $slotSettings->SetGameData('TweetyBirdsAMFreeBalance', 0);
                        $slotSettings->SetGameData('TweetyBirdsAMFreeStartWin', 0);
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                    {
                        $umid = '0';
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                        $slotSettings->SetGameData('TweetyBirdsAMCurrentFreeGame', $slotSettings->GetGameData('TweetyBirdsAMCurrentFreeGame') + 1);
                        $bonusMpl = $slotSettings->slotFreeMpl;
                    }
                    $linesId[0] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[1] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[2] = [
                        1, 
                        1, 
                        1, 
                        1, 
                        1
                    ];
                    $linesId[3] = [
                        4, 
                        4, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[4] = [
                        2, 
                        1, 
                        1, 
                        1, 
                        2
                    ];
                    $linesId[5] = [
                        3, 
                        4, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[6] = [
                        3, 
                        2, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[7] = [
                        2, 
                        3, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[8] = [
                        1, 
                        2, 
                        1, 
                        2, 
                        1
                    ];
                    $linesId[9] = [
                        4, 
                        3, 
                        4, 
                        3, 
                        4
                    ];
                    $linesId[10] = [
                        1, 
                        1, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[11] = [
                        4, 
                        4, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[12] = [
                        1, 
                        1, 
                        3, 
                        1, 
                        1
                    ];
                    $linesId[13] = [
                        4, 
                        4, 
                        2, 
                        4, 
                        4
                    ];
                    $linesId[14] = [
                        1, 
                        1, 
                        4, 
                        1, 
                        1
                    ];
                    $linesId[15] = [
                        4, 
                        4, 
                        1, 
                        4, 
                        4
                    ];
                    $linesId[16] = [
                        2, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[17] = [
                        3, 
                        3, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[18] = [
                        1, 
                        4, 
                        1, 
                        4, 
                        1
                    ];
                    $linesId[19] = [
                        4, 
                        1, 
                        4, 
                        1, 
                        4
                    ];
                    $linesId[20] = [
                        2, 
                        1, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[21] = [
                        3, 
                        4, 
                        3, 
                        4, 
                        3
                    ];
                    $linesId[22] = [
                        2, 
                        3, 
                        4, 
                        3, 
                        2
                    ];
                    $linesId[23] = [
                        3, 
                        2, 
                        1, 
                        2, 
                        3
                    ];
                    $linesId[24] = [
                        2, 
                        1, 
                        2, 
                        3, 
                        4
                    ];
                    $linesId[25] = [
                        1, 
                        2, 
                        3, 
                        4, 
                        3
                    ];
                    $linesId[26] = [
                        2, 
                        2, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[27] = [
                        2, 
                        2, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[28] = [
                        3, 
                        3, 
                        3, 
                        4, 
                        3
                    ];
                    $linesId[29] = [
                        3, 
                        3, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[30] = [
                        2, 
                        2, 
                        1, 
                        1, 
                        1
                    ];
                    $linesId[31] = [
                        2, 
                        2, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[32] = [
                        3, 
                        3, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[33] = [
                        3, 
                        3, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[34] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[35] = [
                        3, 
                        2, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[36] = [
                        2, 
                        2, 
                        1, 
                        2, 
                        2
                    ];
                    $linesId[37] = [
                        3, 
                        3, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[38] = [
                        1, 
                        2, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[39] = [
                        4, 
                        3, 
                        2, 
                        1, 
                        1
                    ];
                    $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $lines = $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1];
                    $betLine = $slotSettings->Bet[$_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2]];
                    $_obf_0D5C0D3128242C1E2D2A0A0C38391632153F3C3B171F11 = $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2];
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] = $betLine * $lines;
                    if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"slotEvent","serverResponse":"invalid params "}';
                        return $response;
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                    {
                        if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                        {
                            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                        }
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $slotSettings->UpdateJackpots($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet']);
                        $slotSettings->SetBalance(-1 * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    }
                    $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'], $lines);
                    $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                    $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' && $winType == 'bonus' ) 
                    {
                        $winType = 'win';
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
                        $wild = ['11'];
                        $scatter = '10';
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        for( $k = 0; $k < $lines; $k++ ) 
                        {
                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '';
                            for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                            {
                                $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = $slotSettings->SymbolGame[$j];
                                if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $scatter || !isset($slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132]) ) 
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
                                    if( $s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild) ) 
                                    {
                                        $mpl = 1;
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][1] * $betLine * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":1,"Line":' . $k . ',"Win":' . $cWins[$k] . ',"stepWin":' . ($cWins[$k] + $totalWin + $slotSettings->GetGameData('TweetyBirdsAMBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":["none","none"],"winReel3":["none","none"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                        }
                                    }
                                    if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) ) 
                                    {
                                        $mpl = 1;
                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) ) 
                                        {
                                            $mpl = 1;
                                        }
                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) ) 
                                        {
                                            $mpl = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][2] * $betLine * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":2,"Line":' . $k . ',"Win":' . $cWins[$k] . ',"stepWin":' . ($cWins[$k] + $totalWin + $slotSettings->GetGameData('TweetyBirdsAMBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":["none","none"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                        }
                                    }
                                    if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) ) 
                                    {
                                        $mpl = 1;
                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) ) 
                                        {
                                            $mpl = 1;
                                        }
                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) ) 
                                        {
                                            $mpl = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $betLine * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":3,"Line":' . $k . ',"Win":' . $cWins[$k] . ',"stepWin":' . ($cWins[$k] + $totalWin + $slotSettings->GetGameData('TweetyBirdsAMBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":[' . ($linesId[$k][2] - 1) . ',"' . $s[2] . '"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                        }
                                    }
                                    if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) ) 
                                    {
                                        $mpl = 1;
                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) ) 
                                        {
                                            $mpl = 1;
                                        }
                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) ) 
                                        {
                                            $mpl = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $betLine * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":4,"Line":' . $k . ',"Win":' . $cWins[$k] . ',"stepWin":' . ($cWins[$k] + $totalWin + $slotSettings->GetGameData('TweetyBirdsAMBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":[' . ($linesId[$k][2] - 1) . ',"' . $s[2] . '"],"winReel4":[' . ($linesId[$k][3] - 1) . ',"' . $s[3] . '"],"winReel5":["none","none"]}';
                                        }
                                    }
                                    if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) && ($s[4] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[4], $wild)) ) 
                                    {
                                        $mpl = 1;
                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) && in_array($s[4], $wild) ) 
                                        {
                                            $mpl = 1;
                                        }
                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) || in_array($s[4], $wild) ) 
                                        {
                                            $mpl = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $betLine * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":5,"Line":' . $k . ',"Win":' . $cWins[$k] . ',"stepWin":' . ($cWins[$k] + $totalWin + $slotSettings->GetGameData('TweetyBirdsAMBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":[' . ($linesId[$k][2] - 1) . ',"' . $s[2] . '"],"winReel4":[' . ($linesId[$k][3] - 1) . ',"' . $s[3] . '"],"winReel5":[' . ($linesId[$k][4] - 1) . ',"' . $s[4] . '"]}';
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
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $p = 0; $p <= 3; $p++ ) 
                            {
                                if( $reels['reel' . $r][$p] == $scatter ) 
                                {
                                    $scattersCount++;
                                    $scattersStr .= ('"winReel' . $r . '":[' . $p . ',"' . $scatter . '"],');
                                }
                            }
                        }
                        $scattersWin = $slotSettings->Paytable['SYM_' . $scatter][$scattersCount] * $betLine * $lines * $bonusMpl;
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
                        if( $i > 1500 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"' . $totalWin . ' Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] * rand(2, 5)) ) 
                        {
                        }
                        else if( !$slotSettings->increaseRTP && $winType == 'win' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] < $totalWin ) 
                        {
                        }
                        else if( $scattersCount >= 3 && $winType != 'bonus' ) 
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
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                    }
                    if( $scattersCount >= 1 && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $slotSettings->SetGameData('TweetyBirdsAMCurrentFreeGame', $slotSettings->GetGameData('TweetyBirdsAMCurrentFreeGame') + 1);
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' && $slotSettings->GetGameData('TweetyBirdsAMFreeGames') <= $slotSettings->GetGameData('TweetyBirdsAMCurrentFreeGame') && $winType != 'bonus' && $slotSettings->GetGameData('TweetyBirdsAMBonusWin') + $totalWin > 0 ) 
                    {
                        $slotSettings->SetBalance($slotSettings->GetGameData('TweetyBirdsAMBonusWin') + $totalWin);
                    }
                    else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' && $winType != 'bonus' && $totalWin > 0 ) 
                    {
                        $slotSettings->SetBalance($totalWin);
                    }
                    $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $slotSettings->SetGameData('TweetyBirdsAMBonusWin', $slotSettings->GetGameData('TweetyBirdsAMBonusWin') + $totalWin);
                        $slotSettings->SetGameData('TweetyBirdsAMTotalWin', $totalWin);
                    }
                    else
                    {
                        $slotSettings->SetGameData('TweetyBirdsAMTotalWin', $totalWin);
                    }
                    $_obf_0D2E3437162622183F300B5C220C15055C2D38031B3511 = '03';
                    if( $scattersCount >= 3 ) 
                    {
                        $_obf_0D2E3437162622183F300B5C220C15055C2D38031B3511 = '05';
                        if( $slotSettings->GetGameData('TweetyBirdsAMFreeGames') > 0 ) 
                        {
                            $slotSettings->SetGameData('TweetyBirdsAMFreeGames', $slotSettings->GetGameData('TweetyBirdsAMFreeGames') + $slotSettings->slotFreeCount);
                        }
                        else
                        {
                            $slotSettings->SetGameData('TweetyBirdsAMFreeStartWin', $totalWin);
                            $slotSettings->SetGameData('TweetyBirdsAMBonusWin', $totalWin);
                            $slotSettings->SetGameData('TweetyBirdsAMFreeGames', $slotSettings->slotFreeCount);
                        }
                    }
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                    $_obf_0D1234092139225B3D2D11150C2D1D0C3E15395B1D2122 = $slotSettings->HexFormat(0);
                    $_obf_0D293D032F341A3B111D1838190A2A5C3F3102121D0D22 = $slotSettings->HexFormat($reels['rp'][0]) . $slotSettings->HexFormat($reels['rp'][1]) . $slotSettings->HexFormat($reels['rp'][2]) . $slotSettings->HexFormat($reels['rp'][3]) . $slotSettings->HexFormat($reels['rp'][4]);
                    $_obf_0D241A152D0F0B0308380A180C26050A150A2423132322 = '';
                    for( $i = 0; $i < $_obf_0D261C3E293911272E102E06115B1E29282A3D11101D22; $i++ ) 
                    {
                        $cWins[$i] = $cWins[$i] / $betLine / $bonusMpl;
                        $_obf_0D241A152D0F0B0308380A180C26050A150A2423132322 .= $slotSettings->HexFormat(round(round($cWins[$i], 2)));
                    }
                    $_obf_0D241A152D0F0B0308380A180C26050A150A2423132322 .= $slotSettings->HexFormat(round(round($scattersWin / $betLine / $lines / $bonusMpl, 2)));
                    $_obf_0D2E320D352628142310141D2F010A085C321810131022 = dechex($lines);
                    if( strlen($_obf_0D2E320D352628142310141D2F010A085C321810131022) <= 1 ) 
                    {
                        $_obf_0D2E320D352628142310141D2F010A085C321810131022 = '0' . $_obf_0D2E320D352628142310141D2F010A085C321810131022;
                    }
                    $_obf_0D3F05382A29123605040E3D10291E2F12391926360401 = dechex($_obf_0D5C0D3128242C1E2D2A0A0C38391632153F3C3B171F11);
                    if( strlen($_obf_0D3F05382A29123605040E3D10291E2F12391926360401) <= 1 ) 
                    {
                        $_obf_0D3F05382A29123605040E3D10291E2F12391926360401 = '0' . $_obf_0D3F05382A29123605040E3D10291E2F12391926360401;
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D2E3437162622183F300B5C220C15055C2D38031B3511 = '06';
                        if( $slotSettings->GetGameData('TweetyBirdsAMFreeGames') <= $slotSettings->GetGameData('TweetyBirdsAMCurrentFreeGame') ) 
                        {
                            $_obf_0D2E3437162622183F300B5C220C15055C2D38031B3511 = '0c';
                        }
                        if( $scattersCount >= 1 ) 
                        {
                            $_obf_0D2E3437162622183F300B5C220C15055C2D38031B3511 = '0a';
                        }
                        $_obf_0D2F1816033E36143D160A39333D122840370C160B1D32 = dechex($slotSettings->GetGameData('TweetyBirdsAMFreeGames'));
                        $_obf_0D243812041C191E1B1A3F113E330236293F3D3D105C11 = dechex($slotSettings->GetGameData('TweetyBirdsAMFreeGames') - $slotSettings->GetGameData('TweetyBirdsAMCurrentFreeGame'));
                        $_obf_0D143D1E1E380F351E1138192B253404170B06113D2922 = strlen($_obf_0D2F1816033E36143D160A39333D122840370C160B1D32) . $_obf_0D2F1816033E36143D160A39333D122840370C160B1D32 . strlen($_obf_0D243812041C191E1B1A3F113E330236293F3D3D105C11) . $_obf_0D243812041C191E1B1A3F113E330236293F3D3D105C11;
                        $_obf_0D2A110E32023D090C020D1E24321C2F19081A26092D32 = '10';
                        if( $totalWin > 0 ) 
                        {
                            $_obf_0D2A110E32023D090C020D1E24321C2F19081A26092D32 = '19';
                        }
                        $totalWin = $slotSettings->GetGameData('TweetyBirdsAMBonusWin');
                        $bonusMpl = $slotSettings->slotFreeMpl;
                    }
                    else
                    {
                        $_obf_0D2F1816033E36143D160A39333D122840370C160B1D32 = dechex($slotSettings->GetGameData('TweetyBirdsAMFreeGames'));
                        $_obf_0D2A110E32023D090C020D1E24321C2F19081A26092D32 = '10';
                        $_obf_0D143D1E1E380F351E1138192B253404170B06113D2922 = strlen($_obf_0D2F1816033E36143D160A39333D122840370C160B1D32) . $_obf_0D2F1816033E36143D160A39333D122840370C160B1D32 . strlen($_obf_0D2F1816033E36143D160A39333D122840370C160B1D32) . $_obf_0D2F1816033E36143D160A39333D122840370C160B1D32;
                    }
                    $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"slotLines":' . $lines . ',"slotBet":' . $_obf_0D5C0D3128242C1E2D2A0A0C38391632153F3C3B171F11 . ',"totalFreeGames":' . $slotSettings->GetGameData('TweetyBirdsAMFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('TweetyBirdsAMCurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData('TweetyBirdsAMBonusWin') . ',"freeStartWin":' . $slotSettings->GetGameData('TweetyBirdsAMFreeStartWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"bonusInfo":' . $scattersStr . ',"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, $betLine, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $response = '1' . $_obf_0D2E3437162622183F300B5C220C15055C2D38031B3511 . '010' . $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 . $slotSettings->HexFormat(round($totalWin * 100)) . $_obf_0D293D032F341A3B111D1838190A2A5C3F3102121D0D22 . $_obf_0D3F05382A29123605040E3D10291E2F12391926360401 . $_obf_0D2E320D352628142310141D2F010A085C321810131022 . $_obf_0D143D1E1E380F351E1138192B253404170B06113D2922 . $_obf_0D2A110E32023D090C020D1E24321C2F19081A26092D32 . $slotSettings->HexFormat($bonusMpl) . '1010' . $_obf_0D293D032F341A3B111D1838190A2A5C3F3102121D0D22 . $_obf_0D0F172D1118050C402A0F213C1D233038275B3E103101 . $_obf_0D241A152D0F0B0308380A180C26050A150A2423132322 . implode('', $slotSettings->GetGameData($slotSettings->slotId . 'Cards')) . '#' . $scattersCount;
                    $response .= ('_' . json_encode($reels));
                    $slotSettings->SetGameData('TweetyBirdsAMDoubleAnswer', $_obf_0D293D032F341A3B111D1838190A2A5C3F3102121D0D22 . $_obf_0D3F05382A29123605040E3D10291E2F12391926360401 . $_obf_0D2E320D352628142310141D2F010A085C321810131022 . '1010101010101010101010' . $_obf_0D0F172D1118050C402A0F213C1D233038275B3E103101 . $_obf_0D241A152D0F0B0308380A180C26050A150A2423132322);
                    $slotSettings->SetGameData('TweetyBirdsAMDoubleBalance', $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401);
                    $slotSettings->SetGameData('TweetyBirdsAMDoubleWin', $totalWin);
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $slotSettings->SetGameData('' . $slotSettings->slotId . 'DoubleWin', $slotSettings->GetGameData('' . $slotSettings->slotId . 'BonusWin'));
                    }
                    else
                    {
                        $slotSettings->SetGameData('' . $slotSettings->slotId . 'DoubleWin', $totalWin);
                    }
                    $_obf_0D121F0821192F3304332C1D225C362A0F2C5C23312322 = $_obf_0D293D032F341A3B111D1838190A2A5C3F3102121D0D22 . $_obf_0D3F05382A29123605040E3D10291E2F12391926360401 . $_obf_0D2E320D352628142310141D2F010A085C321810131022 . '1010101010101010101010' . $_obf_0D0F172D1118050C402A0F213C1D233038275B3E103101 . $_obf_0D241A152D0F0B0308380A180C26050A150A2423132322 . implode('', $slotSettings->GetGameData($slotSettings->slotId . 'Cards')) . '#101010';
                    $slotSettings->SetGameData('TweetyBirdsAMCollectP0', $_obf_0D121F0821192F3304332C1D225C362A0F2C5C23312322);
                    $_obf_0D2E3437162622183F300B5C220C15055C2D38031B3511 = '04';
                    $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $_obf_0D3C151610112B1F3C1426091814400B382A0E1D112B22 = '1' . $_obf_0D2E3437162622183F300B5C220C15055C2D38031B3511 . '010' . $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 . $slotSettings->HexFormat(round($totalWin * 100)) . $_obf_0D293D032F341A3B111D1838190A2A5C3F3102121D0D22 . $_obf_0D3F05382A29123605040E3D10291E2F12391926360401 . $_obf_0D2E320D352628142310141D2F010A085C321810131022 . '1010101010101010101010' . $_obf_0D0F172D1118050C402A0F213C1D233038275B3E103101 . $_obf_0D241A152D0F0B0308380A180C26050A150A2423132322 . implode('', $slotSettings->GetGameData($slotSettings->slotId . 'Cards')) . '#101010';
                    $slotSettings->SetGameData('TweetyBirdsAMCollect', $_obf_0D3C151610112B1F3C1426091814400B382A0E1D112B22);
                    break;
                case 'A/u254':
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $response = $slotSettings->GetGameData('TweetyBirdsAMCollect');
                    break;
                case 'A/u257':
                    $doubleWin = rand(1, 2);
                    $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = $slotSettings->GetGameData('TweetyBirdsAMDoubleWin');
                    $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 = $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032;
                    $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 = $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1];
                    if( $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 > 0 ) 
                    {
                        $slotSettings->SetBalance(-1 * $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032);
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032);
                    }
                    $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = '';
                    $_obf_0D1C3F33155B25261C0A333F403B26161C32213B1D2D01 = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 <= 2 ) 
                    {
                        if( $_obf_0D1C3F33155B25261C0A333F403B26161C32213B1D2D01 < ($_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 * 2) ) 
                        {
                            $doubleWin = 0;
                        }
                    }
                    else if( $_obf_0D1C3F33155B25261C0A333F403B26161C32213B1D2D01 < ($_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 * 4) ) 
                    {
                        $doubleWin = 0;
                    }
                    $_obf_0D34382F1F033210192D35251325253206100E1B1E3622 = [
                        0, 
                        1, 
                        4, 
                        5, 
                        8, 
                        9, 
                        12, 
                        13, 
                        16, 
                        17, 
                        20, 
                        21, 
                        24, 
                        25, 
                        28, 
                        29, 
                        32, 
                        33, 
                        36, 
                        37, 
                        40, 
                        41, 
                        44, 
                        45, 
                        48, 
                        49, 
                        52
                    ];
                    $_obf_0D30403C272D27142C245C2A151413323E140E2F021532 = [
                        2, 
                        3, 
                        6, 
                        7, 
                        10, 
                        11, 
                        14, 
                        15, 
                        18, 
                        19, 
                        22, 
                        23, 
                        26, 
                        27, 
                        30, 
                        31, 
                        34, 
                        35, 
                        38, 
                        39, 
                        42, 
                        43, 
                        46, 
                        47, 
                        50, 
                        51
                    ];
                    $_obf_0D2A2F2D051C331A02060815343E2A351B111039081E22 = [
                        0, 
                        4, 
                        8, 
                        12, 
                        16, 
                        20, 
                        24, 
                        28, 
                        32, 
                        36, 
                        40, 
                        44, 
                        48, 
                        52
                    ];
                    $_obf_0D2D080E3B2F072A1410243D03263D17101C0F3D170E32 = [
                        1, 
                        5, 
                        9, 
                        13, 
                        17, 
                        21, 
                        25, 
                        29, 
                        33, 
                        37, 
                        41, 
                        45, 
                        49, 
                        53
                    ];
                    $_obf_0D0D04323F312C2619233E0D09263804303D0A39402211 = [
                        2, 
                        6, 
                        10, 
                        14, 
                        18, 
                        22, 
                        26, 
                        30, 
                        34, 
                        38, 
                        42, 
                        46, 
                        50
                    ];
                    $_obf_0D1A0A1A0F2E0A0911021C292D041627381C320A092D22 = [
                        3, 
                        7, 
                        11, 
                        15, 
                        19, 
                        23, 
                        27, 
                        31, 
                        35, 
                        39, 
                        43, 
                        47, 
                        51
                    ];
                    if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 <= 2 ) 
                    {
                        $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 * 2;
                    }
                    else
                    {
                        $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 * 4;
                    }
                    if( $doubleWin == 1 ) 
                    {
                        if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 == 1 ) 
                        {
                            $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = $_obf_0D34382F1F033210192D35251325253206100E1B1E3622[rand(0, 26)];
                        }
                        if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 == 2 ) 
                        {
                            $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = $_obf_0D30403C272D27142C245C2A151413323E140E2F021532[rand(0, 25)];
                        }
                        if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 == 3 ) 
                        {
                            $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = $_obf_0D2A2F2D051C331A02060815343E2A351B111039081E22[rand(0, 12)];
                        }
                        if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 == 4 ) 
                        {
                            $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = $_obf_0D2D080E3B2F072A1410243D03263D17101C0F3D170E32[rand(0, 12)];
                        }
                        if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 == 5 ) 
                        {
                            $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = $_obf_0D0D04323F312C2619233E0D09263804303D0A39402211[rand(0, 12)];
                        }
                        if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 == 6 ) 
                        {
                            $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = $_obf_0D1A0A1A0F2E0A0911021C292D041627381C320A092D22[rand(0, 12)];
                        }
                    }
                    else
                    {
                        if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 == 1 ) 
                        {
                            $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = $_obf_0D30403C272D27142C245C2A151413323E140E2F021532[rand(0, 25)];
                        }
                        if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 == 2 ) 
                        {
                            $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = $_obf_0D34382F1F033210192D35251325253206100E1B1E3622[rand(0, 26)];
                        }
                        if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 == 3 ) 
                        {
                            $_obf_0D0824015B1C1E0E23070E3818070B19121B333D260B32 = [
                                4, 
                                5, 
                                6
                            ];
                            $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = ${'suit' . $_obf_0D0824015B1C1E0E23070E3818070B19121B333D260B32[rand(0, 2)]}[rand(0, 12)];
                        }
                        if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 == 4 ) 
                        {
                            $_obf_0D0824015B1C1E0E23070E3818070B19121B333D260B32 = [
                                3, 
                                5, 
                                6
                            ];
                            $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = ${'suit' . $_obf_0D0824015B1C1E0E23070E3818070B19121B333D260B32[rand(0, 2)]}[rand(0, 12)];
                        }
                        if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 == 5 ) 
                        {
                            $_obf_0D0824015B1C1E0E23070E3818070B19121B333D260B32 = [
                                4, 
                                3, 
                                6
                            ];
                            $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = ${'suit' . $_obf_0D0824015B1C1E0E23070E3818070B19121B333D260B32[rand(0, 2)]}[rand(0, 12)];
                        }
                        if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 == 6 ) 
                        {
                            $_obf_0D0824015B1C1E0E23070E3818070B19121B333D260B32 = [
                                4, 
                                5, 
                                3
                            ];
                            $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = ${'suit' . $_obf_0D0824015B1C1E0E23070E3818070B19121B333D260B32[rand(0, 2)]}[rand(0, 12)];
                        }
                        $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = 0;
                    }
                    $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = sprintf('%01.2f', $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032) * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01;
                    $_obf_0D055B13312136223405401F250A14140A220F080A0211 = str_replace('.', '', $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 . '');
                    $_obf_0D143B0B042F091727280D3E182D1D0115352113380F01 = dechex($_obf_0D055B13312136223405401F250A14140A220F080A0211);
                    $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = dechex($_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611);
                    if( strlen($_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611) <= 1 ) 
                    {
                        $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = '0' . $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611;
                    }
                    $_obf_0D0B231C5C1F3C2202340D2D242505232E371E352F2532 = $slotSettings->GetGameData($slotSettings->slotId . 'Cards');
                    array_pop($_obf_0D0B231C5C1F3C2202340D2D242505232E371E352F2532);
                    array_unshift($_obf_0D0B231C5C1F3C2202340D2D242505232E371E352F2532, $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Cards', $_obf_0D0B231C5C1F3C2202340D2D242505232E371E352F2532);
                    $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 / 100;
                    if( $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 > 0 ) 
                    {
                        $slotSettings->SetBalance($_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032);
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032);
                    }
                    $response = '107010' . $slotSettings->GetGameData('TweetyBirdsAMDoubleBalance') . strlen($_obf_0D143B0B042F091727280D3E182D1D0115352113380F01) . $_obf_0D143B0B042F091727280D3E182D1D0115352113380F01 . $slotSettings->GetGameData('TweetyBirdsAMDoubleAnswer') . implode('', $slotSettings->GetGameData($slotSettings->slotId . 'Cards'));
                    $slotSettings->SetGameData('TweetyBirdsAMDoubleWin', $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032);
                    $slotSettings->SetGameData('TweetyBirdsAMTotalWin', $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032);
                    $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $_obf_0D3C151610112B1F3C1426091814400B382A0E1D112B22 = '104010' . $_obf_0D05051A3B323B0F035B305B2D01061B120226380C3401 . strlen($_obf_0D143B0B042F091727280D3E182D1D0115352113380F01) . $_obf_0D143B0B042F091727280D3E182D1D0115352113380F01 . $slotSettings->GetGameData('TweetyBirdsAMCollectP0');
                    $slotSettings->SetGameData('TweetyBirdsAMCollect', $_obf_0D3C151610112B1F3C1426091814400B382A0E1D112B22);
                    $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"gambleResult","serverResponse":{"totalWin":' . $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 . '}}';
                    if( $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 <= 0 ) 
                    {
                        $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = -1 * $_obf_0D1F331E12153F33093F052D063409092F141D252C3411;
                    }
                    $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, $_obf_0D1F331E12153F33093F052D063409092F141D252C3411, 1, $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032, 'slotGamble');
                    break;
                case 'A/u258':
                    $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = $slotSettings->GetGameData('TweetyBirdsAMDoubleWin');
                    if( $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 > 0.01 ) 
                    {
                        $_obf_0D1027171F33402335295C22163623102E1C1D2F183522 = sprintf('%01.2f', $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 / 2);
                    }
                    else
                    {
                        $_obf_0D1027171F33402335295C22163623102E1C1D2F183522 = 0;
                    }
                    $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 - $_obf_0D1027171F33402335295C22163623102E1C1D2F183522;
                    $_obf_0D3B0F07072E1D0906222F133E263B0B020301191C3501 = $slotSettings->GetBalance() - $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032;
                    $slotSettings->SetGameData('TweetyBirdsAMDoubleWin', $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032);
                    $slotSettings->SetGameData('TweetyBirdsAMTotalWin', $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032);
                    $_obf_0D3B0F07072E1D0906222F133E263B0B020301191C3501 = sprintf('%01.2f', $_obf_0D3B0F07072E1D0906222F133E263B0B020301191C3501);
                    $_obf_0D22402A0F041D04371B053C070A40122F2F031F082932 = str_replace('.', '', $_obf_0D3B0F07072E1D0906222F133E263B0B020301191C3501 . '');
                    $_obf_0D0D1728405B1D2D03381F0722343131032B3806161301 = dechex($_obf_0D22402A0F041D04371B053C070A40122F2F031F082932 - 0);
                    $_obf_0D373B302A1614233D3F2D03055B0B142A33240F1D0511 = strlen($_obf_0D0D1728405B1D2D03381F0722343131032B3806161301) . $_obf_0D0D1728405B1D2D03381F0722343131032B3806161301;
                    $slotSettings->SetGameData('TweetyBirdsAMDoubleBalance', $_obf_0D373B302A1614233D3F2D03055B0B142A33240F1D0511);
                    $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = sprintf('%01.2f', $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032) * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01;
                    $_obf_0D055B13312136223405401F250A14140A220F080A0211 = str_replace('.', '', $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 . '');
                    $_obf_0D143B0B042F091727280D3E182D1D0115352113380F01 = dechex($_obf_0D055B13312136223405401F250A14140A220F080A0211);
                    $_obf_0D0B231C5C1F3C2202340D2D242505232E371E352F2532 = '26280b2714161d0c';
                    $response = '108010' . $slotSettings->GetGameData('TweetyBirdsAMDoubleBalance') . strlen($_obf_0D143B0B042F091727280D3E182D1D0115352113380F01) . $_obf_0D143B0B042F091727280D3E182D1D0115352113380F01 . $slotSettings->GetGameData('TweetyBirdsAMDoubleAnswer') . implode('', $slotSettings->GetGameData($slotSettings->slotId . 'Cards'));
                    break;
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
