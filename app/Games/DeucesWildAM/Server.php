<?php 
namespace VanguardLTE\Games\DeucesWildAM
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
                    $lastEvent = $slotSettings->GetHistory();
                    if( $lastEvent != 'NULL' ) 
                    {
                        $_obf_0D39312C132B17232D121616313F393014190C0F2C2B11 = $lastEvent->serverResponse->action;
                        $holds = $lastEvent->serverResponse->holds;
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01 = $lastEvent->serverResponse->CurrentCards;
                        $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 = '';
                        $slotSettings->SetGameData('DeucesWildAMBet', $lastEvent->serverResponse->Bet);
                        $slotSettings->SetGameData('DeucesWildAMCurrentCards', $lastEvent->serverResponse->CurrentCards);
                        $slotSettings->SetGameData('DeucesWildAMCards', $lastEvent->serverResponse->Cards);
                        $slotSettings->SetGameData('DeucesWildAMbalanceFormated', $balanceFormated);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BankReserved', $lastEvent->serverResponse->BankReserved);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Action', $lastEvent->serverResponse->action);
                        for( $i = 0; $i < 5; $i++ ) 
                        {
                            $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 .= ('2' . $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->suit . dechex($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->value));
                        }
                        for( $i = 0; $i < count($slotSettings->Bet); $i++ ) 
                        {
                            if( $lastEvent->serverResponse->Bet == $slotSettings->Bet[$i] ) 
                            {
                                $_obf_0D110D22123038392633210627381D015C0404083F3532 = $i;
                            }
                        }
                    }
                    else
                    {
                        $_obf_0D39312C132B17232D121616313F393014190C0F2C2B11 = 0;
                        $holds = [
                            '10', 
                            '10', 
                            '10', 
                            '10', 
                            '10'
                        ];
                        $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 = '1010101010';
                        $_obf_0D110D22123038392633210627381D015C0404083F3532 = 0;
                    }
                    $response = '00' . $_obf_0D39312C132B17232D121616313F393014190C0F2C2B11 . '010' . $balanceFormated . '10100' . dechex($_obf_0D110D22123038392633210627381D015C0404083F3532) . $_obf_0D353903345C2903220A0F1D1410163F37251D5B020711 . $_obf_0D1F210640113215055B051B35301630023C18403E2B22 . '100000000000000000' . $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 . implode('', $holds) . '0000000000' . $_obf_0D2B230C15322D020F0D262A1538072D011C092D310732 . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . '09101010101010101010';
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
                    $response = '100010' . $balanceFormated . '101000' . $_obf_0D353903345C2903220A0F1D1410163F37251D5B020711 . $_obf_0D1F210640113215055B051B35301630023C18403E2B22 . '10000000000000000010101010101010101010000000000000#';
                    break;
                case 'A/u253':
                    $act = $slotSettings->GetGameData($slotSettings->slotId . 'Action');
                    $_obf_0D0A2D110A35342C1833362226153D2E1F19241F403432 = $slotSettings->GetGameData($slotSettings->slotId . 'BankReserved');
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D0A2D110A35342C1833362226153D2E1F19241F403432);
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $lastEvent = $slotSettings->GetHistory();
                    if( $lastEvent != 'NULL' ) 
                    {
                        $_obf_0D403B31280D2A01051A033840271D0236293E2E091601 = $lastEvent->serverResponse->CurrentCards;
                        $cards = $lastEvent->serverResponse->Cards;
                        $_obf_0D061C162B391B0A23183D303C3C3F251F341D021D1022 = $slotSettings->GetGameData('DeucesWildAMCurrentCards');
                    }
                    else
                    {
                        $_obf_0D403B31280D2A01051A033840271D0236293E2E091601 = $slotSettings->GetGameData('DeucesWildAMCurrentCards');
                        $cards = $slotSettings->GetGameData('DeucesWildAMCards');
                    }
                    $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01 = $_obf_0D403B31280D2A01051A033840271D0236293E2E091601;
                        $_obf_0D08362E123C0705361C1E135B2D30290C1F3D37321432 = 0;
                        $totalWin = 0;
                        shuffle($cards);
                        for( $j = 0; $j < 5; $j++ ) 
                        {
                            if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[$j + 1] <= 0 ) 
                            {
                                $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$j] = $cards[$j];
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
                        ], false);
                        $totalWin = $_obf_0D3E291C370537291F350C5C0E070E3403290801034001[0] * $slotSettings->GetGameData('DeucesWildAMBet');
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
                    $slotSettings->SetGameData('DeucesWildAMTotalWin', $totalWin);
                    $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 = '';
                    for( $i = 0; $i < 5; $i++ ) 
                    {
                        $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 .= ('2' . $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->suit . dechex($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->value));
                    }
                    $_obf_0D29393440375B18354019311334290C32102B27260511 = '1010101010';
                    $_obf_0D113C0B01390D1431072D263B3B0C27370D0D363D4032 = $_obf_0D3E291C370537291F350C5C0E070E3403290801034001[1];
                    $holds = [
                        '10', 
                        '10', 
                        '10', 
                        '10', 
                        '10'
                    ];
                    $_obf_0D5C362C12133F28270905063F291D2E3C0D2A3E2B0D01 = $_obf_0D3E291C370537291F350C5C0E070E3403290801034001[2];
                    for( $h = 0; $h < 5; $h++ ) 
                    {
                        if( $holds[$h] > 0 ) 
                        {
                            $holds[$h] = '1' . dechex($_obf_0D5C362C12133F28270905063F291D2E3C0D2A3E2B0D01[$h]);
                        }
                    }
                    $response = '104010' . $balanceFormated . $slotSettings->HexFormat(round($totalWin * 100)) . '10001a33e8100000000000000000' . $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 . implode('', $holds) . '020' . $_obf_0D113C0B01390D1431072D263B3B0C27370D0D363D4032 . '00000000#';
                    $_obf_0D3C151610112B1F3C1426091814400B382A0E1D112B22 = $slotSettings->HexFormat(round($totalWin * 100)) . '10001a33e8100000000000000000' . $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 . $_obf_0D29393440375B18354019311334290C32102B27260511 . '020' . $_obf_0D113C0B01390D1431072D263B3B0C27370D0D363D4032 . '00000000';
                    $slotSettings->SetGameData('DeucesWildAMCollect', $_obf_0D3C151610112B1F3C1426091814400B382A0E1D112B22);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BankReserved', 0);
                    $_obf_0D313216211E285C27221305312C19242C223C11353901 = (object)[
                        'Bet' => $slotSettings->GetGameData('DeucesWildAMBet'), 
                        'CurrentCards' => $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01, 
                        'Cards' => $slotSettings->GetGameData('DeucesWildAMCards'), 
                        'BankReserved' => $slotSettings->GetGameData($slotSettings->slotId . 'BankReserved'), 
                        'action' => '4', 
                        'holds' => $holds
                    ];
                    $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"spin","responseType":"bet","serverResponse":' . json_encode($_obf_0D313216211E285C27221305312C19242C223C11353901) . '}';
                    $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, 0, 1, $totalWin, 'bet');
                    $slotSettings->SetGameData($slotSettings->slotId . 'Action', 4);
                    break;
                case 'A/u257':
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $_obf_0D3C151610112B1F3C1426091814400B382A0E1D112B22 = $slotSettings->GetGameData('DeucesWildAMCollect');
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $response = '107010' . $balanceFormated . $_obf_0D3C151610112B1F3C1426091814400B382A0E1D112B22;
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
                    $slotSettings->SetGameData($slotSettings->slotId . 'BankReserved', 0);
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $cardsArr = [];
                    for( $i = 0; $i <= 3; $i++ ) 
                    {
                        for( $j = 2; $j <= 14; $j++ ) 
                        {
                            $suit = $i;
                            if( $j == 2 ) 
                            {
                                $suit += 4;
                            }
                            $cardsArr[] = (object)[
                                'suit' => '' . $suit, 
                                'value' => '' . $j
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
                        ], true);
                        $totalWin = $_obf_0D3E291C370537291F350C5C0E070E3403290801034001[0] * $allbet;
                        if( $totalWin <= $bank ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'BankReserved', $totalWin);
                            $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                            break;
                        }
                    }
                    $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 = '';
                    for( $i = 0; $i < 5; $i++ ) 
                    {
                        $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 .= ('2' . $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->suit . dechex($_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01[$i]->value));
                        array_shift($cardsArr);
                    }
                    $holds = [
                        '10', 
                        '10', 
                        '10', 
                        '10', 
                        '10'
                    ];
                    $_obf_0D5C362C12133F28270905063F291D2E3C0D2A3E2B0D01 = $_obf_0D3E291C370537291F350C5C0E070E3403290801034001[2];
                    for( $h = 0; $h < 5; $h++ ) 
                    {
                        if( $holds[$h] > 0 ) 
                        {
                            $holds[$h] = '1' . dechex($_obf_0D5C362C12133F28270905063F291D2E3C0D2A3E2B0D01[$h]);
                        }
                    }
                    $response = '102010' . $balanceFormated . '1010001a33e8100000000000000000' . $_obf_0D0F40311C121D1C3213161C1E21311E1C3116403B1001 . implode('', $holds) . '010000000000';
                    $_obf_0D313216211E285C27221305312C19242C223C11353901 = (object)[
                        'Bet' => $allbet, 
                        'CurrentCards' => $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01, 
                        'Cards' => $cardsArr, 
                        'BankReserved' => $slotSettings->GetGameData($slotSettings->slotId . 'BankReserved'), 
                        'action' => '2', 
                        'holds' => $holds
                    ];
                    $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"spin","responseType":"bet","serverResponse":' . json_encode($_obf_0D313216211E285C27221305312C19242C223C11353901) . '}';
                    $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, $allbet, 1, 0, 'bet');
                    $slotSettings->SetGameData('DeucesWildAMBet', $allbet);
                    $slotSettings->SetGameData('DeucesWildAMCurrentCards', $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01);
                    $slotSettings->SetGameData('DeucesWildAMCards', $cardsArr);
                    $slotSettings->SetGameData('DeucesWildAMbalanceFormated', $balanceFormated);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Action', 2);
                    break;
                case 'A/u2514':
                    $balanceFormated = $slotSettings->GetGameData('DeucesWildAMbalanceFormated');
                    $cardsID = [];
                    $cnt = 0;
                    for( $i = 2; $i <= 14; $i++ ) 
                    {
                        $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01 = dechex($cnt);
                        $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22 = dechex($cnt + 1);
                        $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11 = dechex($cnt + 2);
                        $_obf_0D3E2523321514182A275C28072A2B22093F3510150901 = dechex($cnt + 3);
                        if( strlen($_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01) <= 1 ) 
                        {
                            $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01 = '0' . $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01;
                        }
                        if( strlen($_obf_0D5C382A21400E24010F03332D39333C162302321C0F22) <= 1 ) 
                        {
                            $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22 = '0' . $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22;
                        }
                        if( strlen($_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11) <= 1 ) 
                        {
                            $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11 = '0' . $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11;
                        }
                        if( strlen($_obf_0D3E2523321514182A275C28072A2B22093F3510150901) <= 1 ) 
                        {
                            $_obf_0D3E2523321514182A275C28072A2B22093F3510150901 = '0' . $_obf_0D3E2523321514182A275C28072A2B22093F3510150901;
                        }
                        $cardsID['c_' . $i] = [
                            $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01, 
                            $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22, 
                            $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11, 
                            $_obf_0D3E2523321514182A275C28072A2B22093F3510150901
                        ];
                        $cnt += 4;
                    }
                    $_obf_0D100B2E300B08312605022B1D192108061414050A4022 = rand(2, 14);
                    $totalWin = $slotSettings->GetGameData('DeucesWildAMTotalWin');
                    $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $cardsID['c_' . $_obf_0D100B2E300B08312605022B1D192108061414050A4022][rand(0, 3)];
                    $response = '10e010' . $balanceFormated . $slotSettings->HexFormat(round($totalWin * 100)) . '10001010101000000000000000101010101010101010100201000000' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22;
                    $slotSettings->SetGameData('DeucesWildAMDealerCard', $_obf_0D100B2E300B08312605022B1D192108061414050A4022);
                    $slotSettings->SetGameData('DeucesWildAMDealerCardS', $_obf_0D25035C31183316381216122811401A1F2A17243E2B22);
                    break;
                case 'A/u2515':
                    $balanceFormated = $slotSettings->GetGameData('DeucesWildAMbalanceFormated');
                    $cardsID = [];
                    $cnt = 0;
                    for( $i = 2; $i <= 14; $i++ ) 
                    {
                        $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01 = dechex($cnt);
                        $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22 = dechex($cnt + 1);
                        $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11 = dechex($cnt + 2);
                        $_obf_0D3E2523321514182A275C28072A2B22093F3510150901 = dechex($cnt + 3);
                        if( strlen($_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01) <= 1 ) 
                        {
                            $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01 = '0' . $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01;
                        }
                        if( strlen($_obf_0D5C382A21400E24010F03332D39333C162302321C0F22) <= 1 ) 
                        {
                            $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22 = '0' . $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22;
                        }
                        if( strlen($_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11) <= 1 ) 
                        {
                            $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11 = '0' . $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11;
                        }
                        if( strlen($_obf_0D3E2523321514182A275C28072A2B22093F3510150901) <= 1 ) 
                        {
                            $_obf_0D3E2523321514182A275C28072A2B22093F3510150901 = '0' . $_obf_0D3E2523321514182A275C28072A2B22093F3510150901;
                        }
                        $cardsID['c_' . $i] = [
                            $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01, 
                            $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22, 
                            $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11, 
                            $_obf_0D3E2523321514182A275C28072A2B22093F3510150901
                        ];
                        $cnt += 4;
                    }
                    $_obf_0D100B2E300B08312605022B1D192108061414050A4022 = rand(2, 14);
                    $totalWin = $slotSettings->GetGameData('DeucesWildAMTotalWin');
                    $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $cardsID['c_' . $_obf_0D100B2E300B08312605022B1D192108061414050A4022][rand(0, 3)];
                    $response = '10f010' . $balanceFormated . $slotSettings->HexFormat(round($totalWin * 100)) . '10001010101000000000000000101010101010101010100201000000' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22;
                    $slotSettings->SetGameData('DeucesWildAMDealerCard', $_obf_0D100B2E300B08312605022B1D192108061414050A4022);
                    $slotSettings->SetGameData('DeucesWildAMDealerCardS', $_obf_0D25035C31183316381216122811401A1F2A17243E2B22);
                    break;
                case 'A/u2513':
                    $balanceFormated = $slotSettings->GetGameData('DeucesWildAMbalanceFormated');
                    $_obf_0D132F5B3B05282630012921082440063E1F1B22351A11 = $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1];
                    $cardsID = [];
                    $cnt = 0;
                    for( $i = 2; $i <= 14; $i++ ) 
                    {
                        $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01 = dechex($cnt);
                        $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22 = dechex($cnt + 1);
                        $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11 = dechex($cnt + 2);
                        $_obf_0D3E2523321514182A275C28072A2B22093F3510150901 = dechex($cnt + 3);
                        if( strlen($_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01) <= 1 ) 
                        {
                            $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01 = '0' . $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01;
                        }
                        if( strlen($_obf_0D5C382A21400E24010F03332D39333C162302321C0F22) <= 1 ) 
                        {
                            $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22 = '0' . $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22;
                        }
                        if( strlen($_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11) <= 1 ) 
                        {
                            $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11 = '0' . $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11;
                        }
                        if( strlen($_obf_0D3E2523321514182A275C28072A2B22093F3510150901) <= 1 ) 
                        {
                            $_obf_0D3E2523321514182A275C28072A2B22093F3510150901 = '0' . $_obf_0D3E2523321514182A275C28072A2B22093F3510150901;
                        }
                        $cardsID['c_' . $i] = [
                            $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01, 
                            $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22, 
                            $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11, 
                            $_obf_0D3E2523321514182A275C28072A2B22093F3510150901
                        ];
                        $cnt += 4;
                    }
                    $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $slotSettings->GetGameData('DeucesWildAMTotalWin');
                    $_obf_0D0609280933072133022F1B1F252D160207292F381522 = $_obf_0D0E141F34210C271834013D060623402816092A400E11 * 2;
                    $slotSettings->SetBalance(-1 * $_obf_0D0E141F34210C271834013D060623402816092A400E11);
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D0E141F34210C271834013D060623402816092A400E11);
                    $_obf_0D2C080713260E3821133D2E360E292139310E2B060E22 = rand(1, 2);
                    $_obf_0D1C3F33155B25261C0A333F403B26161C32213B1D2D01 = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    if( $_obf_0D1C3F33155B25261C0A333F403B26161C32213B1D2D01 < $_obf_0D0609280933072133022F1B1F252D160207292F381522 ) 
                    {
                        $_obf_0D2C080713260E3821133D2E360E292139310E2B060E22 = 0;
                    }
                    if( $_obf_0D2C080713260E3821133D2E360E292139310E2B060E22 == 1 ) 
                    {
                        $_obf_0D373202210A393C1A2E39210B383D283D05051C3E1001 = rand($slotSettings->GetGameData('DeucesWildAMDealerCard'), 14);
                    }
                    else
                    {
                        $_obf_0D373202210A393C1A2E39210B383D283D05051C3E1001 = rand(2, $slotSettings->GetGameData('DeucesWildAMDealerCard'));
                    }
                    if( $slotSettings->GetGameData('DeucesWildAMDealerCard') == $_obf_0D373202210A393C1A2E39210B383D283D05051C3E1001 ) 
                    {
                        $totalWin = $_obf_0D0E141F34210C271834013D060623402816092A400E11;
                    }
                    else if( $slotSettings->GetGameData('DeucesWildAMDealerCard') < $_obf_0D373202210A393C1A2E39210B383D283D05051C3E1001 ) 
                    {
                        $totalWin = $_obf_0D0609280933072133022F1B1F252D160207292F381522;
                    }
                    else
                    {
                        $totalWin = 0;
                    }
                    $slotSettings->SetGameData('DeucesWildAMTotalWin', $totalWin);
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBalance($totalWin);
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                    }
                    $_obf_0D2603072412352E3E163736103613321A13370B0A3C11 = [
                        $cardsID['c_' . rand(2, 14)][rand(0, 3)], 
                        $cardsID['c_' . rand(2, 14)][rand(0, 3)], 
                        $cardsID['c_' . rand(2, 14)][rand(0, 3)], 
                        $cardsID['c_' . rand(2, 14)][rand(0, 3)]
                    ];
                    $_obf_0D2603072412352E3E163736103613321A13370B0A3C11[$_obf_0D132F5B3B05282630012921082440063E1F1B22351A11 - 1] = $cardsID['c_' . $_obf_0D373202210A393C1A2E39210B383D283D05051C3E1001][rand(0, 3)];
                    $_obf_0D2B31081230130F113539313C272632073F153E0C0432 = implode('', $_obf_0D2603072412352E3E163736103613321A13370B0A3C11);
                    $response = '10d010' . $balanceFormated . $slotSettings->HexFormat(round($totalWin * 100)) . '10001a33e810' . $slotSettings->GetGameData('DeucesWildAMDealerCardS') . $_obf_0D2B31081230130F113539313C272632073F153E0C0432 . '0000001723c1d23b21b10101023b21b020100000' . $_obf_0D132F5B3B05282630012921082440063E1F1B22351A11 . $slotSettings->GetGameData('DeucesWildAMDealerCardS') . '#' . $_obf_0D373202210A393C1A2E39210B383D283D05051C3E1001 . '|' . $slotSettings->GetGameData('DeucesWildAMDealerCardS');
                    if( $totalWin <= 0 ) 
                    {
                        $totalWin = -1 * $_obf_0D0E141F34210C271834013D060623402816092A400E11;
                    }
                    $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"gambleResult","serverResponse":{"totalWin":' . $totalWin . '}}';
                    $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, $slotSettings->GetGameData('DeucesWildAMBet'), 1, $totalWin, 'double');
                    break;
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
