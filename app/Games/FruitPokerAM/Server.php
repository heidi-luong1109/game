<?php 
namespace VanguardLTE\Games\FruitPokerAM
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
                    $slotSettings->SetGameData($slotSettings->slotId . 'cardsHistory', [
                        '07', 
                        '05', 
                        '07', 
                        '07', 
                        '07', 
                        '07', 
                        '03', 
                        '03'
                    ]);
                    if( !$slotSettings->HasGameData($slotSettings->slotId . 'Cards') ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'Cards', []);
                    }
                    if( !$slotSettings->HasGameData($slotSettings->slotId . 'cardsInStack') ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'cardsInStack', [
                            11, 
                            16, 
                            16, 
                            19, 
                            19, 
                            12, 
                            45, 
                            1
                        ]);
                    }
                    if( !$slotSettings->HasGameData($slotSettings->slotId . 'BonusFourArr') ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusFourArr', [
                            0, 
                            0, 
                            0, 
                            0
                        ]);
                    }
                    if( !$slotSettings->HasGameData($slotSettings->slotId . 'BonusProgress') ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusProgress', 0);
                    }
                    if( !$slotSettings->HasGameData($slotSettings->slotId . 'BonusPos') ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusPos', 0);
                    }
                    if( !$slotSettings->HasGameData($slotSettings->slotId . 'BonusSum') ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusSum', 0);
                    }
                    if( !$slotSettings->HasGameData($slotSettings->slotId . 'CurrentCards') ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentCards', []);
                    }
                    if( !$slotSettings->HasGameData($slotSettings->slotId . 'Action') ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'Action', 0);
                    }
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData('BonusPokerEGTBonusWin', 0);
                    $slotSettings->SetGameData('BonusPokerEGTFreeGames', 0);
                    $slotSettings->SetGameData('BonusPokerEGTCurrentFreeGame', 0);
                    $slotSettings->SetGameData('BonusPokerEGTTotalWin', 0);
                    $slotSettings->SetGameData('BonusPokerEGTFreeBalance', 0);
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->UnpackGameData($lastEvent->serverResponse->allData);
                    }
                    $_obf_0D1232390F2B2F2804320E372416331A16210414221F01 = $slotSettings->Bet;
                    $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 = '';
                    for( $b = 0; $b < count($_obf_0D1232390F2B2F2804320E372416331A16210414221F01); $b++ ) 
                    {
                        $_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b] = (double)$_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01;
                        $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 .= (dechex(strlen(dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b]))) . dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b]));
                    }
                    $_obf_0D353903345C2903220A0F1D1410163F37251D5B020711 = '';
                    $_obf_0D1F210640113215055B051B35301630023C18403E2B22 = '';
                    $_obf_0D353903345C2903220A0F1D1410163F37251D5B020711 .= (strlen(dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[0])) . dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[0]));
                    $_obf_0D1F210640113215055B051B35301630023C18403E2B22 .= (strlen(dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[count($_obf_0D1232390F2B2F2804320E372416331A16210414221F01) - 1])) . dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[count($_obf_0D1232390F2B2F2804320E372416331A16210414221F01) - 1]));
                    $_obf_0D2B230C15322D020F0D262A1538072D011C092D310732 = count($_obf_0D1232390F2B2F2804320E372416331A16210414221F01);
                    $_obf_0D2B230C15322D020F0D262A1538072D011C092D310732 = dechex($_obf_0D2B230C15322D020F0D262A1538072D011C092D310732);
                    if( strlen($_obf_0D2B230C15322D020F0D262A1538072D011C092D310732) <= 1 ) 
                    {
                        $_obf_0D2B230C15322D020F0D262A1538072D011C092D310732 = '0' . $_obf_0D2B230C15322D020F0D262A1538072D011C092D310732;
                    }
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $BonusSum = $slotSettings->GetGameData('FruitPokerAMBonusSum');
                    $BonusProgress = $slotSettings->GetGameData('FruitPokerAMBonusProgress');
                    $BonusPos = $slotSettings->GetGameData('FruitPokerAMBonusPos');
                    $BonusFourArr = $slotSettings->GetGameData('FruitPokerAMBonusFourArr');
                    $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01 = $slotSettings->GetGameData('FruitPokerAMCurrentCards');
                    $cardsInStack = $slotSettings->GetGameData('FruitPokerAMcardsInStack');
                    $cards = $slotSettings->GetGameData('FruitPokerAMCards');
                    $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611 = [
                        '0b', 
                        '0f', 
                        '10', 
                        '11', 
                        '11', 
                        '0c', 
                        '2d', 
                        '01'
                    ];
                    for( $i = 0; $i < count($cardsInStack); $i++ ) 
                    {
                        $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611[$i] = dechex($cardsInStack[$i]);
                        if( strlen($_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611[$i]) <= 1 ) 
                        {
                            $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611[$i] = '0' . $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611[$i];
                        }
                    }
                    $_obf_0D2B5B372F1C23342D1513104026341C25392E270E2932 = 139 - count($cards);
                    $_obf_0D0434251A0234394015392822211E1238121640261B22 = 40;
                    if( $BonusSum >= 1 && $BonusSum < 10 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 41;
                    }
                    if( $BonusSum >= 10 && $BonusSum < 20 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 42;
                    }
                    if( $BonusSum >= 20 && $BonusSum < 30 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 43;
                    }
                    if( $BonusSum >= 30 && $BonusSum < 40 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 44;
                    }
                    if( $BonusSum >= 40 && $BonusSum < 50 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 45;
                    }
                    if( $BonusSum >= 50 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 46;
                    }
                    if( $BonusFourArr[0] ) 
                    {
                        $BonusPos = 1;
                    }
                    if( $BonusFourArr[1] ) 
                    {
                        $BonusPos = 2;
                    }
                    if( $BonusFourArr[2] ) 
                    {
                        $BonusPos = 4;
                    }
                    if( $BonusFourArr[3] ) 
                    {
                        $BonusPos = 8;
                    }
                    if( $BonusFourArr[0] && $BonusFourArr[1] ) 
                    {
                        $BonusPos = 3;
                    }
                    if( $BonusFourArr[0] && $BonusFourArr[2] ) 
                    {
                        $BonusPos = 5;
                    }
                    if( $BonusFourArr[1] && $BonusFourArr[2] ) 
                    {
                        $BonusPos = 6;
                    }
                    if( $BonusFourArr[0] && $BonusFourArr[3] ) 
                    {
                        $BonusPos = 9;
                    }
                    if( $BonusFourArr[1] && $BonusFourArr[3] ) 
                    {
                        $BonusPos = 'a';
                    }
                    if( $BonusFourArr[2] && $BonusFourArr[3] ) 
                    {
                        $BonusPos = 'c';
                    }
                    if( $BonusFourArr[0] && $BonusFourArr[1] && $BonusFourArr[2] ) 
                    {
                        $BonusPos = 7;
                    }
                    if( $BonusFourArr[0] && $BonusFourArr[1] && $BonusFourArr[3] ) 
                    {
                        $BonusPos = 'b';
                    }
                    if( $BonusFourArr[0] && $BonusFourArr[2] && $BonusFourArr[3] ) 
                    {
                        $BonusPos = 'd';
                    }
                    if( $BonusFourArr[1] && $BonusFourArr[2] && $BonusFourArr[3] ) 
                    {
                        $BonusPos = 'e';
                    }
                    $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 = '';
                    if( count($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01) > 0 && is_array($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01) ) 
                    {
                        for( $i = 0; $i < count($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01); $i++ ) 
                        {
                            $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 .= ($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->suit . dechex($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->value));
                        }
                    }
                    else
                    {
                        $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 = '1010101010';
                    }
                    $holds = $slotSettings->GetGameData('FruitPokerAMHolds');
                    $act = $slotSettings->GetGameData('FruitPokerAMAction');
                    if( $act != 2 && $act != 4 ) 
                    {
                        $act = 0;
                    }
                    if( !$slotSettings->HasGameData($slotSettings->slotId . 'Holds') ) 
                    {
                        $holds = [
                            '10', 
                            '10', 
                            '10', 
                            '10', 
                            '10'
                        ];
                    }
                    $response = '00' . $act . '010' . $balanceFormated . '101000' . $_obf_0D353903345C2903220A0F1D1410163F37251D5B020711 . $_obf_0D1F210640113215055B051B35301630023C18403E2B22 . '100000000000000000' . $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 . implode('', $holds) . '0000030000' . $_obf_0D2B230C15322D020F0D262A1538072D011C092D310732 . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . '09101010101010101010' . $slotSettings->HexFormat($_obf_0D2B5B372F1C23342D1513104026341C25392E270E2932) . '0000' . implode('', $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611) . $_obf_0D0434251A0234394015392822211E1238121640261B22 . '02041101010101010101010' . $slotSettings->HexFormat($BonusSum * 100) . $slotSettings->HexFormat($BonusSum * 100) . '1010101010101010101' . $BonusPos . '1' . $BonusPos . '1' . $BonusPos . '1010101010101' . $BonusPos . '';
                    break;
                case 'A/u250':
                    $_obf_0D1232390F2B2F2804320E372416331A16210414221F01 = $slotSettings->Bet;
                    $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 = '';
                    for( $b = 0; $b < count($_obf_0D1232390F2B2F2804320E372416331A16210414221F01); $b++ ) 
                    {
                        $_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b] = (double)$_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01;
                        $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 .= (dechex(strlen(dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b]))) . dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[$b]));
                    }
                    $_obf_0D353903345C2903220A0F1D1410163F37251D5B020711 = '';
                    $_obf_0D1F210640113215055B051B35301630023C18403E2B22 = '';
                    $_obf_0D353903345C2903220A0F1D1410163F37251D5B020711 .= (strlen(dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[0])) . dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[0]));
                    $_obf_0D1F210640113215055B051B35301630023C18403E2B22 .= (strlen(dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[count($_obf_0D1232390F2B2F2804320E372416331A16210414221F01) - 1])) . dechex($_obf_0D1232390F2B2F2804320E372416331A16210414221F01[count($_obf_0D1232390F2B2F2804320E372416331A16210414221F01) - 1]));
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $response = '100010' . $balanceFormated . '101000' . $_obf_0D353903345C2903220A0F1D1410163F37251D5B020711 . $_obf_0D1F210640113215055B051B35301630023C18403E2B22 . '10000000000000000010101010101010101010000003000000100100000000000000000010101010101010101010101010101010101010100010101010101010101010#';
                    break;
                case 'A/u253':
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01 = $slotSettings->GetGameData('FruitPokerAMCurrentCards');
                    $cards = $slotSettings->GetGameData('FruitPokerAMCards');
                    $cardsInStack = $slotSettings->GetGameData('FruitPokerAMcardsInStack');
                    $totalWin = 0;
                    $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        $BonusSum = $slotSettings->GetGameData('FruitPokerAMBonusSum');
                        $BonusProgress = $slotSettings->GetGameData('FruitPokerAMBonusProgress');
                        $BonusPos = $slotSettings->GetGameData('FruitPokerAMBonusPos');
                        $BonusFourArr = $slotSettings->GetGameData('FruitPokerAMBonusFourArr');
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01 = $slotSettings->GetGameData('FruitPokerAMCurrentCards');
                        shuffle($cards);
                        $_obf_0D08362E123C0705361C1E135B2D30290C1F3D37321432 = 0;
                        for( $i = 0; $i < 5; $i++ ) 
                        {
                            if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[$i + 1] <= 0 ) 
                            {
                                $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i] = $cards[$_obf_0D08362E123C0705361C1E135B2D30290C1F3D37321432];
                                $_obf_0D08362E123C0705361C1E135B2D30290C1F3D37321432++;
                            }
                        }
                        $_obf_0D3E291C370537291F350C5C0E070E3403290801034001 = $slotSettings->GetCombination([
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[0]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[1]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[2]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[3]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[4]->value
                        ], [
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[0]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[1]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[2]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[3]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[4]->suit
                        ]);
                        $_obf_0D3930021E065C30212C110F1D2D150E03113925171401 = $_obf_0D3E291C370537291F350C5C0E070E3403290801034001[0];
                        $_obf_0D340E033D3540281A3C25053016262A17171324015C11 = $_obf_0D3E291C370537291F350C5C0E070E3403290801034001[1];
                        $totalWin = $_obf_0D3930021E065C30212C110F1D2D150E03113925171401 * $slotSettings->GetGameData('FruitPokerAMBet');
                        $holds = [
                            '10', 
                            '10', 
                            '10', 
                            '10', 
                            '10'
                        ];
                        $_obf_0D5C362C12133F28270905063F291D2E3C0D2A3E2B0D01 = $slotSettings->GetTips([
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[0]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[1]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[2]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[3]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[4]->value
                        ], [
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[0]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[1]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[2]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[3]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[4]->suit
                        ], true);
                        $_obf_0D3F101A5C2A5B240C09271E3C03171936345B0C2C2511 = 0;
                        $_obf_0D343E351A392C2F3909310407301C5B17013F092C0701 = 0;
                        $_obf_0D3D1D012B2A1B125C1D17093F22280709183D103E3F11 = 0;
                        $_obf_0D2F2D1C0E24121924161B092D2B18241B1E130B102932 = 0;
                        $_obf_0D213B5C05065C03050F1A1F0B0322221B263027343D01 = 0;
                        $_obf_0D0F325B3B0305191035230D5B2909380B1E5B361D0D32 = [
                            0, 
                            0, 
                            0, 
                            0, 
                            0
                        ];
                        for( $i = 0; $i < 5; $i++ ) 
                        {
                            if( $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->value == 6 ) 
                            {
                                $_obf_0D3F101A5C2A5B240C09271E3C03171936345B0C2C2511++;
                                $_obf_0D0F325B3B0305191035230D5B2909380B1E5B361D0D32[$i] = 6;
                            }
                            if( $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->value == 8 ) 
                            {
                                $_obf_0D213B5C05065C03050F1A1F0B0322221B263027343D01++;
                            }
                            if( $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->value == 3 ) 
                            {
                                $_obf_0D3D1D012B2A1B125C1D17093F22280709183D103E3F11++;
                            }
                            if( $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->value == 4 ) 
                            {
                                $_obf_0D2F2D1C0E24121924161B092D2B18241B1E130B102932++;
                            }
                            if( $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->value == 2 ) 
                            {
                                $_obf_0D343E351A392C2F3909310407301C5B17013F092C0701++;
                            }
                        }
                        if( $BonusProgress < 45 && $_obf_0D3F101A5C2A5B240C09271E3C03171936345B0C2C2511 == 2 ) 
                        {
                            $BonusProgress++;
                            $BonusSum += $slotSettings->GetGameData('FruitPokerAMBet');
                            $_obf_0D340E033D3540281A3C25053016262A17171324015C11 = 2;
                            for( $i = 0; $i < 5; $i++ ) 
                            {
                                if( $_obf_0D0F325B3B0305191035230D5B2909380B1E5B361D0D32[$i] == 6 ) 
                                {
                                    $holds[$i] = '16';
                                }
                            }
                        }
                        if( $_obf_0D3F101A5C2A5B240C09271E3C03171936345B0C2C2511 + $_obf_0D213B5C05065C03050F1A1F0B0322221B263027343D01 >= 4 ) 
                        {
                            $BonusFourArr[3] = 1;
                        }
                        if( $_obf_0D343E351A392C2F3909310407301C5B17013F092C0701 + $_obf_0D213B5C05065C03050F1A1F0B0322221B263027343D01 >= 4 ) 
                        {
                            $BonusFourArr[0] = 1;
                        }
                        if( $_obf_0D3D1D012B2A1B125C1D17093F22280709183D103E3F11 + $_obf_0D213B5C05065C03050F1A1F0B0322221B263027343D01 >= 4 ) 
                        {
                            $BonusFourArr[1] = 1;
                        }
                        if( $_obf_0D2F2D1C0E24121924161B092D2B18241B1E130B102932 + $_obf_0D213B5C05065C03050F1A1F0B0322221B263027343D01 >= 4 ) 
                        {
                            $BonusFourArr[2] = 1;
                        }
                        if( $BonusFourArr[0] ) 
                        {
                            $BonusPos = 1;
                        }
                        if( $BonusFourArr[1] ) 
                        {
                            $BonusPos = 2;
                        }
                        if( $BonusFourArr[2] ) 
                        {
                            $BonusPos = 4;
                        }
                        if( $BonusFourArr[3] ) 
                        {
                            $BonusPos = 8;
                        }
                        if( $BonusFourArr[0] && $BonusFourArr[1] ) 
                        {
                            $BonusPos = 3;
                        }
                        if( $BonusFourArr[0] && $BonusFourArr[2] ) 
                        {
                            $BonusPos = 5;
                        }
                        if( $BonusFourArr[1] && $BonusFourArr[2] ) 
                        {
                            $BonusPos = 6;
                        }
                        if( $BonusFourArr[0] && $BonusFourArr[3] ) 
                        {
                            $BonusPos = 9;
                        }
                        if( $BonusFourArr[1] && $BonusFourArr[3] ) 
                        {
                            $BonusPos = 'a';
                        }
                        if( $BonusFourArr[2] && $BonusFourArr[3] ) 
                        {
                            $BonusPos = 'c';
                        }
                        if( $BonusFourArr[0] && $BonusFourArr[1] && $BonusFourArr[2] ) 
                        {
                            $BonusPos = 7;
                        }
                        if( $BonusFourArr[0] && $BonusFourArr[1] && $BonusFourArr[3] ) 
                        {
                            $BonusPos = 'b';
                        }
                        if( $BonusFourArr[0] && $BonusFourArr[2] && $BonusFourArr[3] ) 
                        {
                            $BonusPos = 'd';
                        }
                        if( $BonusFourArr[1] && $BonusFourArr[2] && $BonusFourArr[3] ) 
                        {
                            $BonusPos = 'e';
                        }
                        if( $BonusFourArr[0] && $BonusFourArr[1] && $BonusFourArr[2] && $BonusFourArr[3] ) 
                        {
                            $BonusPos = 'f';
                            $_obf_0D340E033D3540281A3C25053016262A17171324015C11 = 9;
                            $totalWin += ($slotSettings->GetGameData('FruitPokerAMBet') * 50);
                        }
                        if( $BonusSum >= 100 ) 
                        {
                            $totalWin += $BonusSum;
                        }
                        if( $totalWin <= $bank ) 
                        {
                            break;
                        }
                    }
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBalance($totalWin);
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                    }
                    $slotSettings->SetGameData('FruitPokerAMTotalWin', $totalWin);
                    $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 = '';
                    for( $i = 0; $i < 5; $i++ ) 
                    {
                        $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 .= ($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->suit . dechex($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->value));
                    }
                    $_obf_0D29393440375B18354019311334290C32102B27260511 = '1010101010';
                    if( $totalWin > 0 ) 
                    {
                        for( $h = 0; $h < 5; $h++ ) 
                        {
                            if( $holds[$h] > 0 ) 
                            {
                                $holds[$h] = '1' . $_obf_0D5C362C12133F28270905063F291D2E3C0D2A3E2B0D01[$h];
                            }
                        }
                    }
                    $_obf_0D113C0B01390D1431072D263B3B0C27370D0D363D4032 = $_obf_0D340E033D3540281A3C25053016262A17171324015C11;
                    $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611 = [
                        '0b', 
                        '0f', 
                        '10', 
                        '11', 
                        '11', 
                        '0c', 
                        '2d', 
                        '01'
                    ];
                    for( $i = 0; $i < $_obf_0D08362E123C0705361C1E135B2D30290C1F3D37321432; $i++ ) 
                    {
                        $_obf_0D340E183D30111C0C3B11371A0D2112353E1F30041922 = $cards[$i]->value;
                        $cardsInStack[$_obf_0D340E183D30111C0C3B11371A0D2112353E1F30041922 - 1]--;
                    }
                    for( $i = 0; $i < $_obf_0D08362E123C0705361C1E135B2D30290C1F3D37321432; $i++ ) 
                    {
                        array_shift($cards);
                    }
                    for( $i = 0; $i < count($cardsInStack); $i++ ) 
                    {
                        $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611[$i] = dechex($cardsInStack[$i]);
                        if( strlen($_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611[$i]) <= 1 ) 
                        {
                            $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611[$i] = '0' . $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611[$i];
                        }
                    }
                    $_obf_0D2B5B372F1C23342D1513104026341C25392E270E2932 = 139 - count($cards);
                    $_obf_0D0434251A0234394015392822211E1238121640261B22 = 40;
                    if( $BonusSum >= 1 && $BonusSum < 10 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 41;
                    }
                    if( $BonusSum >= 10 && $BonusSum < 20 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 42;
                    }
                    if( $BonusSum >= 20 && $BonusSum < 30 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 43;
                    }
                    if( $BonusSum >= 30 && $BonusSum < 40 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 44;
                    }
                    if( $BonusSum >= 40 && $BonusSum < 50 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 45;
                    }
                    if( $BonusSum >= 50 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 46;
                    }
                    $response = '104010' . $balanceFormated . $slotSettings->HexFormat(round($totalWin * 100)) . '100' . dechex($slotSettings->GetGameData('FruitPokerAMBetCounter')) . '1a33e8150000000000000000' . $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 . implode('', $holds) . '030' . dechex($_obf_0D113C0B01390D1431072D263B3B0C27370D0D363D4032) . '03000000' . $slotSettings->HexFormat($_obf_0D2B5B372F1C23342D1513104026341C25392E270E2932) . '0000' . implode('', $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611) . $_obf_0D0434251A0234394015392822211E1238121640261B22 . '10101010101010101010' . $slotSettings->HexFormat($BonusSum * 100) . '101010101010101010101' . $BonusPos . '1' . $BonusPos . '1' . $BonusPos . '1010101010101' . $BonusPos . '#';
                    $_obf_0D3C151610112B1F3C1426091814400B382A0E1D112B22 = $slotSettings->HexFormat(round($totalWin * 100)) . '10001a33e8100000000000000000' . $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 . implode('', $holds) . '020' . $_obf_0D113C0B01390D1431072D263B3B0C27370D0D363D4032 . '03000000' . $slotSettings->HexFormat($_obf_0D2B5B372F1C23342D1513104026341C25392E270E2932) . '0000' . implode('', $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611) . '10101010101010101010101010101010101010100010101010101010101010#' . json_encode($cardsInStack);
                    $_obf_0D121F0821192F3304332C1D225C362A0F2C5C23312322 = '10001a33e8100000000000000000' . $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 . implode('', $holds) . '020' . $_obf_0D113C0B01390D1431072D263B3B0C27370D0D363D4032 . '03000000' . $slotSettings->HexFormat($_obf_0D2B5B372F1C23342D1513104026341C25392E270E2932) . '0000' . implode('', $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611) . '10101010101010101010101010101010101010100010101010101010101010#' . json_encode($cardsInStack);
                    $_obf_0D312F12381E0A353E0C093C1231213931111C11332A22 = $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 . implode('', $holds) . '030303000100110000' . implode('', $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611) . $BonusProgress . '10101010101010101010' . $slotSettings->HexFormat($BonusSum * 100) . '101010101010101010101' . $BonusPos . '101010101010101010#' . json_encode($_obf_0D2B5B372F1C23342D1513104026341C25392E270E2932);
                    $_obf_0D312F12381E0A353E0C093C1231213931111C11332A22 = '131616111610161610160203030001001100000b101013130c2c0110101010101010101010101010101010101010101010101010101010101010';
                    if( $BonusFourArr[0] && $BonusFourArr[1] && $BonusFourArr[2] && $BonusFourArr[3] ) 
                    {
                        $BonusFourArr[0] = 0;
                        $BonusFourArr[1] = 0;
                        $BonusFourArr[2] = 0;
                        $BonusFourArr[3] = 0;
                    }
                    $slotSettings->SetGameData('FruitPokerAMCollect', $_obf_0D3C151610112B1F3C1426091814400B382A0E1D112B22);
                    $slotSettings->SetGameData('FruitPokerAMCollect0', $_obf_0D121F0821192F3304332C1D225C362A0F2C5C23312322);
                    $slotSettings->SetGameData('FruitPokerAMGamble', $_obf_0D312F12381E0A353E0C093C1231213931111C11332A22);
                    $slotSettings->SetGameData('FruitPokerAMHolds', $holds);
                    $slotSettings->SetGameData('FruitPokerAMAction', '4');
                    $slotSettings->SetGameData('FruitPokerAMBonusFourArr', $BonusFourArr);
                    $slotSettings->SetGameData('FruitPokerAMBonusSum', $BonusSum);
                    $slotSettings->SetGameData('FruitPokerAMBonusProgress', $BonusProgress);
                    $slotSettings->SetGameData('FruitPokerAMBonusPos', $BonusPos);
                    $slotSettings->SetGameData('FruitPokerAMCurrentCards', $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01);
                    $slotSettings->SetGameData('FruitPokerAMCards', $cards);
                    $slotSettings->SetGameData('FruitPokerAMcardsInStack', $cardsInStack);
                    if( $BonusSum >= 100 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusProgress', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusSum', 0);
                    }
                    $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"spin","responseType":"bet","serverResponse":{"allData":' . $slotSettings->PackGameData() . '}}';
                    $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, 0, 1, $totalWin, 'bet');
                    break;
                case 'A/u257':
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $_obf_0D3C151610112B1F3C1426091814400B382A0E1D112B22 = $slotSettings->GetGameData('FruitPokerAMCollect');
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $response = '107010' . $balanceFormated . $_obf_0D3C151610112B1F3C1426091814400B382A0E1D112B22;
                    $slotSettings->SetGameData($slotSettings->slotId . 'Cards', []);
                    $slotSettings->SetGameData($slotSettings->slotId . 'cardsInStack', [
                        11, 
                        16, 
                        16, 
                        19, 
                        19, 
                        12, 
                        45, 
                        1
                    ]);
                    break;
                case 'A/u251':
                    $betLine = $slotSettings->Bet[$_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1]];
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] = $betLine;
                    $allbet = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'];
                    if( $allbet <= 0.0001 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetBalance() < $allbet ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid balance"}';
                        exit( $response );
                    }
                    if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    }
                    $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $slotSettings->UpdateJackpots($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet']);
                    $slotSettings->SetBalance(-1 * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $cardsArr = $slotSettings->GetGameData('FruitPokerAMCards');
                    $cardsInStack = $slotSettings->GetGameData('FruitPokerAMcardsInStack');
                    $BonusSum = $slotSettings->GetGameData('FruitPokerAMBonusSum');
                    $BonusProgress = $slotSettings->GetGameData('FruitPokerAMBonusProgress');
                    $BonusPos = $slotSettings->GetGameData('FruitPokerAMBonusPos');
                    $BonusFourArr = $slotSettings->GetGameData('FruitPokerAMBonusFourArr');
                    $_obf_0D370C3B36131C2D065B0437140C2D08263B3F143C2F11 = 0;
                    if( count($cardsArr) < 10 ) 
                    {
                        $_obf_0D370C3B36131C2D065B0437140C2D08263B3F143C2F11 = 1;
                        $cardsInStack = [
                            11, 
                            16, 
                            16, 
                            19, 
                            19, 
                            12, 
                            45, 
                            1
                        ];
                        $cardsArr = [];
                        for( $j = 1; $j <= 11; $j++ ) 
                        {
                            $cardsArr[] = (object)[
                                'suit' => 1, 
                                'value' => 1
                            ];
                        }
                        for( $j = 1; $j <= 16; $j++ ) 
                        {
                            $cardsArr[] = (object)[
                                'suit' => 1, 
                                'value' => 2
                            ];
                        }
                        for( $j = 1; $j <= 16; $j++ ) 
                        {
                            $cardsArr[] = (object)[
                                'suit' => 1, 
                                'value' => 3
                            ];
                        }
                        for( $j = 1; $j <= 19; $j++ ) 
                        {
                            $cardsArr[] = (object)[
                                'suit' => 1, 
                                'value' => 4
                            ];
                        }
                        for( $j = 1; $j <= 19; $j++ ) 
                        {
                            $cardsArr[] = (object)[
                                'suit' => 1, 
                                'value' => 5
                            ];
                        }
                        for( $j = 1; $j <= 12; $j++ ) 
                        {
                            $cardsArr[] = (object)[
                                'suit' => 1, 
                                'value' => 6
                            ];
                        }
                        for( $j = 1; $j <= 45; $j++ ) 
                        {
                            $cardsArr[] = (object)[
                                'suit' => 1, 
                                'value' => 7
                            ];
                        }
                        for( $j = 1; $j <= 1; $j++ ) 
                        {
                            $cardsArr[] = (object)[
                                'suit' => 1, 
                                'value' => 8
                            ];
                        }
                    }
                    $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        shuffle($cardsArr);
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01 = [
                            $cardsArr[0], 
                            $cardsArr[1], 
                            $cardsArr[2], 
                            $cardsArr[3], 
                            $cardsArr[4]
                        ];
                        $_obf_0D3E291C370537291F350C5C0E070E3403290801034001 = $slotSettings->GetCombination([
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[0]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[1]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[2]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[3]->value, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[4]->value
                        ], [
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[0]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[1]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[2]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[3]->suit, 
                            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[4]->suit
                        ]);
                        $_obf_0D3930021E065C30212C110F1D2D150E03113925171401 = $_obf_0D3E291C370537291F350C5C0E070E3403290801034001[0];
                        $_obf_0D340E033D3540281A3C25053016262A17171324015C11 = $_obf_0D3E291C370537291F350C5C0E070E3403290801034001[1];
                        $totalWin = $_obf_0D3930021E065C30212C110F1D2D150E03113925171401 * $allbet;
                        if( $totalWin <= $bank ) 
                        {
                            break;
                        }
                    }
                    $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 = '';
                    for( $i = 0; $i < 5; $i++ ) 
                    {
                        $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 .= ($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->suit . dechex($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->value));
                    }
                    $holds = [
                        '10', 
                        '10', 
                        '10', 
                        '10', 
                        '10'
                    ];
                    $_obf_0D5C362C12133F28270905063F291D2E3C0D2A3E2B0D01 = $slotSettings->GetTips([
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[0]->value, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[1]->value, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[2]->value, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[3]->value, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[4]->value
                    ], [
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[0]->suit, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[1]->suit, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[2]->suit, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[3]->suit, 
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[4]->suit
                    ]);
                    for( $h = 0; $h < 5; $h++ ) 
                    {
                        if( $holds[$h] > 0 ) 
                        {
                            $holds[$h] = '1' . $_obf_0D5C362C12133F28270905063F291D2E3C0D2A3E2B0D01[$h];
                        }
                    }
                    $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611 = [
                        '0b', 
                        '0f', 
                        '10', 
                        '11', 
                        '11', 
                        '0c', 
                        '2d', 
                        '01'
                    ];
                    for( $i = 0; $i < 5; $i++ ) 
                    {
                        $_obf_0D340E183D30111C0C3B11371A0D2112353E1F30041922 = $cardsArr[$i]->value;
                        $cardsInStack[$_obf_0D340E183D30111C0C3B11371A0D2112353E1F30041922 - 1]--;
                    }
                    for( $i = 0; $i < 5; $i++ ) 
                    {
                        array_shift($cardsArr);
                    }
                    for( $i = 0; $i < count($cardsInStack); $i++ ) 
                    {
                        $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611[$i] = dechex($cardsInStack[$i]);
                        if( strlen($_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611[$i]) <= 1 ) 
                        {
                            $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611[$i] = '0' . $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611[$i];
                        }
                    }
                    $_obf_0D2B5B372F1C23342D1513104026341C25392E270E2932 = 139 - count($cardsArr);
                    if( $BonusFourArr[0] ) 
                    {
                        $BonusPos = 1;
                    }
                    if( $BonusFourArr[1] ) 
                    {
                        $BonusPos = 2;
                    }
                    if( $BonusFourArr[2] ) 
                    {
                        $BonusPos = 4;
                    }
                    if( $BonusFourArr[3] ) 
                    {
                        $BonusPos = 8;
                    }
                    if( $BonusFourArr[0] && $BonusFourArr[1] ) 
                    {
                        $BonusPos = 3;
                    }
                    if( $BonusFourArr[0] && $BonusFourArr[2] ) 
                    {
                        $BonusPos = 5;
                    }
                    if( $BonusFourArr[1] && $BonusFourArr[2] ) 
                    {
                        $BonusPos = 6;
                    }
                    if( $BonusFourArr[0] && $BonusFourArr[3] ) 
                    {
                        $BonusPos = 9;
                    }
                    if( $BonusFourArr[1] && $BonusFourArr[3] ) 
                    {
                        $BonusPos = 'a';
                    }
                    if( $BonusFourArr[2] && $BonusFourArr[3] ) 
                    {
                        $BonusPos = 'c';
                    }
                    if( $BonusFourArr[0] && $BonusFourArr[1] && $BonusFourArr[2] ) 
                    {
                        $BonusPos = 7;
                    }
                    if( $BonusFourArr[0] && $BonusFourArr[1] && $BonusFourArr[3] ) 
                    {
                        $BonusPos = 'b';
                    }
                    if( $BonusFourArr[0] && $BonusFourArr[2] && $BonusFourArr[3] ) 
                    {
                        $BonusPos = 'd';
                    }
                    if( $BonusFourArr[1] && $BonusFourArr[2] && $BonusFourArr[3] ) 
                    {
                        $BonusPos = 'e';
                    }
                    if( $BonusFourArr[0] && $BonusFourArr[1] && $BonusFourArr[2] && $BonusFourArr[3] ) 
                    {
                        $BonusPos = 'f';
                    }
                    $_obf_0D0434251A0234394015392822211E1238121640261B22 = 40;
                    if( $BonusSum >= 1 && $BonusSum < 10 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 41;
                    }
                    if( $BonusSum >= 10 && $BonusSum < 20 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 42;
                    }
                    if( $BonusSum >= 20 && $BonusSum < 30 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 43;
                    }
                    if( $BonusSum >= 30 && $BonusSum < 40 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 44;
                    }
                    if( $BonusSum >= 40 && $BonusSum < 50 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 45;
                    }
                    if( $BonusSum >= 50 ) 
                    {
                        $_obf_0D0434251A0234394015392822211E1238121640261B22 = 46;
                    }
                    $response = '102010' . $balanceFormated . '10100' . dechex($_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1]) . '1f41388150000000000000000' . $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 . implode('', $holds) . '010003000000' . $slotSettings->HexFormat($_obf_0D2B5B372F1C23342D1513104026341C25392E270E2932) . '0' . $_obf_0D370C3B36131C2D065B0437140C2D08263B3F143C2F11 . '00' . implode('', $_obf_0D351C23011E17351B0B23093F0A3605333E030D3E0611) . '' . $_obf_0D0434251A0234394015392822211E1238121640261B22 . '10101010101010101010' . $slotSettings->HexFormat($BonusSum * 100) . '101010101010101010101' . $BonusPos . '1' . $BonusPos . '1' . $BonusPos . '1010101010101' . $BonusPos . '';
                    $slotSettings->SetGameData('FruitPokerAMHolds', $holds);
                    $slotSettings->SetGameData('FruitPokerAMAction', '2');
                    $slotSettings->SetGameData('FruitPokerAMBet', $allbet);
                    $slotSettings->SetGameData('FruitPokerAMBetCounter', $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1]);
                    $slotSettings->SetGameData('FruitPokerAMCurrentCards', $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01);
                    $slotSettings->SetGameData('FruitPokerAMCards', $cardsArr);
                    $slotSettings->SetGameData('FruitPokerAMcardsInStack', $cardsInStack);
                    $slotSettings->SetGameData('FruitPokerAMbalanceFormated', $balanceFormated);
                    $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"spin","responseType":"bet","serverResponse":{"allData":' . $slotSettings->PackGameData() . '}}';
                    $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, $allbet, 1, 0, 'bet');
                    break;
                case 'A/u258':
                    $doubleWin = rand(1, 2);
                    $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = $slotSettings->GetGameData('FruitPokerAMTotalWin');
                    $cardsHistory = $slotSettings->GetGameData('FruitPokerAMcardsHistory');
                    $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 = $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032;
                    $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 = $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1];
                    if( $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 > 0 ) 
                    {
                        $slotSettings->SetBalance(-1 * $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032);
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032);
                    }
                    $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = '';
                    $_obf_0D1C3F33155B25261C0A333F403B26161C32213B1D2D01 = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    if( $_obf_0D1C3F33155B25261C0A333F403B26161C32213B1D2D01 < ($_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 * 2) ) 
                    {
                        $doubleWin = 0;
                    }
                    if( $_obf_0D225B2A2A0C333F023635103B142F0F1B1728215B2811 == 2 ) 
                    {
                        if( $doubleWin == 1 ) 
                        {
                            $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = rand(1, 5);
                            $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 * 2;
                        }
                        else
                        {
                            $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = rand(6, 7);
                            $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = 0;
                        }
                    }
                    else if( $doubleWin == 1 ) 
                    {
                        $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 * 2;
                        $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = rand(6, 8);
                    }
                    else
                    {
                        $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 = rand(1, 5);
                        $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = 0;
                    }
                    $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = sprintf('%01.2f', $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032) * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01;
                    $_obf_0D055B13312136223405401F250A14140A220F080A0211 = str_replace('.', '', $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 . '');
                    $_obf_0D143B0B042F091727280D3E182D1D0115352113380F01 = dechex($_obf_0D055B13312136223405401F250A14140A220F080A0211);
                    $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 / 100;
                    if( $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 > 0 ) 
                    {
                        $slotSettings->SetBalance($_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032);
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032);
                    }
                    $slotSettings->SetGameData('FruitPokerAMTotalWin', $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032);
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $_obf_0D3C151610112B1F3C1426091814400B382A0E1D112B22 = strlen($_obf_0D143B0B042F091727280D3E182D1D0115352113380F01) . $_obf_0D143B0B042F091727280D3E182D1D0115352113380F01 . $slotSettings->GetGameData('FruitPokerAMCollect0');
                    $slotSettings->SetGameData('FruitPokerAMCollect', $_obf_0D3C151610112B1F3C1426091814400B382A0E1D112B22);
                    $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"gambleResult","serverResponse":{"totalWin":' . $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 . '}}';
                    if( $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 <= 0 ) 
                    {
                        $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = -1 * $_obf_0D1F331E12153F33093F052D063409092F141D252C3411;
                    }
                    $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, $_obf_0D1F331E12153F33093F052D063409092F141D252C3411, 1, $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032, 'slotGamble');
                    $response = '108010' . $slotSettings->GetGameData('FruitPokerAMbalanceFormated') . '' . strlen($_obf_0D143B0B042F091727280D3E182D1D0115352113380F01) . $_obf_0D143B0B042F091727280D3E182D1D0115352113380F01 . '100' . dechex($slotSettings->GetGameData('FruitPokerAMBetCounter')) . '1f41388150' . $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 . '01010101000000' . $slotSettings->GetGameData('FruitPokerAMGamble');
                    array_pop($cardsHistory);
                    array_unshift($cardsHistory, '0' . $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611);
                    $response = '108010' . $slotSettings->GetGameData('FruitPokerAMbalanceFormated') . strlen($_obf_0D143B0B042F091727280D3E182D1D0115352113380F01) . $_obf_0D143B0B042F091727280D3E182D1D0115352113380F01 . '10011f41388150' . $_obf_0D0D22370928172F0A1F0F145B053F3C14213D5B251611 . '05070507000000131616111610161610160203030001001100000b101013130c2c0110101010101010101010101010101010101010101010101010101010101010';
                    break;
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
