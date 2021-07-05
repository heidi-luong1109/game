<?php 
namespace VanguardLTE\Games\BlackJackAM
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
                    $slotSettings->SetGameData('BlackJackAMStep', 'gameIsOver');
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
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01 = $slotSettings->GetGameData('BlackJackAMBoxes');
                    $allbet = $slotSettings->GetGameData('BlackJackAMBet');
                    $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711 = $slotSettings->GetGameData('BlackJackAMtotalCnt');
                    $cardsArr = $slotSettings->GetGameData('BlackJackAMCards');
                    $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = $slotSettings->GetGameData('BlackJackAMboxState');
                    $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01 = $slotSettings->GetGameData('BlackJackAMaState');
                    $_obf_0D3925020414260D5B32143B13090516193D170C300C22 = $slotSettings->GetGameData('BlackJackAMLastAction');
                    $insuranceBet = $slotSettings->GetGameData('BlackJackAMinsuranceBet');
                    $_obf_0D180F291D362A2927280E2E1F3630172934131B033211 = $slotSettings->GetGameData('BlackJackAMinsuranceState');
                    if( $slotSettings->GetGameData('BlackJackAMStep') != 'gameIsOver' ) 
                    {
                        $_obf_0D290A1E3B2F5B011C3B293323012C351E2F1713345C32 = $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                        $response = '00' . $_obf_0D3925020414260D5B32143B13090516193D170C300C22 . '010' . $balanceFormated . '10' . $_obf_0D353903345C2903220A0F1D1410163F37251D5B020711 . $_obf_0D1F210640113215055B051B35301630023C18403E2B22 . $slotSettings->HexFormat($allbet * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . '10010' . $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 . '000000000' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] . $_obf_0D290A1E3B2F5B011C3B293323012C351E2F1713345C32 . '101010101010101010' . implode('', $_obf_0D180F291D362A2927280E2E1F3630172934131B033211) . '101010' . implode('', $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01) . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[0]['strOut'] . '0615' . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . '00';
                    }
                    else
                    {
                        $response = '000010' . $balanceFormated . '10' . $_obf_0D353903345C2903220A0F1D1410163F37251D5B020711 . $_obf_0D1F210640113215055B051B35301630023C18403E2B22 . '1010010a0a000000000000101010101010101010101010101010101010101010101010010101010101010101150000000000000000000000000000000000000000001500000000000000000000000000000000000000000015000000000000000000000000000000000000000000150000000000000000000000000000000000000000001500000000000000000000000000000000000000000015000000000000000000000000000000000000000000150000000000000000000000000000000000000000001500000000000000000000000000000000000000000015000000000000000000000000000000000000000000150000000000000000000000000000000000000000000615' . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . '00';
                    }
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
                    $response = '100010' . $balanceFormated . '101010010a0a0000000000001010101010101010101010101010101010101010101010100101010101010101011500000000000000000000000000000000000000000015000000000000000000000000000000000000000000150000000000000000000000000000000000000000001500000000000000000000000000000000000000000015000000000000000000000000000000000000000000150000000000000000000000000000000000000000001500000000000000000000000000000000000000000015000000000000000000000000000000000000000000150000000000000000000000000000000000000000001500000000000000000000000000000000000000000000';
                    break;
                case 'A/u2810':
                    $_obf_0D333C1B093E285C2F360638095B33144023023E361801 = $slotSettings->GetGameData('BlackJackAMStep');
                    if( $_obf_0D333C1B093E285C2F360638095B33144023023E361801 != 'betIsPlaced' ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid state"}';
                        exit( $response );
                    }
                    $slotSettings->SetGameData('BlackJackAMStep', 'gameIsOver');
                    $BankReserved = $slotSettings->GetGameData('BlackJackAMBankReserved');
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $BankReserved);
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
                        $cardsID['card_' . $i . '_0'] = $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01;
                        $cardsID['card_' . $i . '_1'] = $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22;
                        $cardsID['card_' . $i . '_2'] = $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11;
                        $cardsID['card_' . $i . '_3'] = $_obf_0D3E2523321514182A275C28072A2B22093F3510150901;
                        $cnt += 4;
                    }
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01 = $slotSettings->GetGameData('BlackJackAMBoxes');
                    $allbet = $slotSettings->GetGameData('BlackJackAMBet');
                    $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711 = $slotSettings->GetGameData('BlackJackAMtotalCnt');
                    $cardsArr = $slotSettings->GetGameData('BlackJackAMCards');
                    $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = $slotSettings->GetGameData('BlackJackAMboxState');
                    $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01 = $slotSettings->GetGameData('BlackJackAMaState');
                    $insuranceBet = $slotSettings->GetGameData('BlackJackAMinsuranceBet');
                    $_obf_0D180F291D362A2927280E2E1F3630172934131B033211 = $slotSettings->GetGameData('BlackJackAMinsuranceState');
                    $_obf_0D011F2625290509133D113021112F1F39032D100A1201 = [
                        '10', 
                        '10', 
                        '10'
                    ];
                    $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 0;
                    $cardsArr = array_slice($cardsArr, $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711);
                    $_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301 = $slotSettings->GetGameData('BlackJackAMCardsReserve');
                    $_obf_0D0A333F1E293E142C120B072C0C163D0608260C5C3E22 = $slotSettings->GetGameData('BlackJackAMsmallBank');
                    $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        shuffle($cardsArr);
                        shuffle($_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301);
                        $totalWin = 0;
                        $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711 = 0;
                        $_obf_0D07105B1227285B191F181715085C305B092712373332 = $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22];
                        $_obf_0D37101F3901133936211B322E031C365C3E0926260E01 = 22;
                        for( $i = 1; $i <= 9; $i++ ) 
                        {
                            if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['mainScore'] < $_obf_0D37101F3901133936211B322E031C365C3E0926260E01 && $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['mainScore'] > 0 ) 
                            {
                                $_obf_0D37101F3901133936211B322E031C365C3E0926260E01 = $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['mainScore'];
                            }
                        }
                        $_obf_0D0F13332C02220D31245B222B2E0A043222372C2B3F01 = false;
                        for( $i = 0; $i < count($cardsArr); $i++ ) 
                        {
                            if( $_obf_0D0A333F1E293E142C120B072C0C163D0608260C5C3E22 ) 
                            {
                                $_obf_0D07105B1227285B191F181715085C305B092712373332['cards'][$_obf_0D07105B1227285B191F181715085C305B092712373332['cnt']] = $_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301[$i];
                            }
                            else
                            {
                                $_obf_0D07105B1227285B191F181715085C305B092712373332['cards'][$_obf_0D07105B1227285B191F181715085C305B092712373332['cnt']] = $cardsArr[$_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711];
                            }
                            $slotSettings->GetScore($_obf_0D07105B1227285B191F181715085C305B092712373332);
                            $_obf_0D07105B1227285B191F181715085C305B092712373332['strOut'] = $slotSettings->FormatBox($_obf_0D07105B1227285B191F181715085C305B092712373332['cards'], $cardsID);
                            $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711++;
                            if( $_obf_0D07105B1227285B191F181715085C305B092712373332['mainScore'] >= 17 || $_obf_0D37101F3901133936211B322E031C365C3E0926260E01 > 21 ) 
                            {
                                if( $_obf_0D07105B1227285B191F181715085C305B092712373332['mainScore'] == 21 && $i == 0 ) 
                                {
                                    $_obf_0D0F13332C02220D31245B222B2E0A043222372C2B3F01 = true;
                                }
                                break;
                            }
                        }
                        for( $i = 1; $i <= 9; $i++ ) 
                        {
                            if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['bet'] > 0 && $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['mainScore'] <= 21 ) 
                            {
                                $_obf_0D0E141F34210C271834013D060623402816092A400E11 = 0;
                                if( $_obf_0D07105B1227285B191F181715085C305B092712373332['mainScore'] < $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['mainScore'] || $_obf_0D07105B1227285B191F181715085C305B092712373332['mainScore'] > 21 ) 
                                {
                                    $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['bet'] * 2;
                                }
                                if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['blackjack'] ) 
                                {
                                    $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['bet'] * 2.5;
                                }
                                if( $_obf_0D07105B1227285B191F181715085C305B092712373332['mainScore'] == $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['mainScore'] && $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['mainScore'] <= 21 && !$_obf_0D0F13332C02220D31245B222B2E0A043222372C2B3F01 ) 
                                {
                                    $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['bet'] * 1;
                                }
                                $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['win'] = $_obf_0D0E141F34210C271834013D060623402816092A400E11;
                                $totalWin += $_obf_0D0E141F34210C271834013D060623402816092A400E11;
                            }
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['strOut'] = $slotSettings->FormatBox($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['cards'], $cardsID);
                        }
                        if( $_obf_0D07105B1227285B191F181715085C305B092712373332['mainScore'] == 21 && $_obf_0D0F13332C02220D31245B222B2E0A043222372C2B3F01 ) 
                        {
                            for( $in = 0; $in <= 2; $in++ ) 
                            {
                                if( $insuranceBet[$in] > 0 ) 
                                {
                                    $_obf_0D011F2625290509133D113021112F1F39032D100A1201[$in] = $slotSettings->HexFormat($insuranceBet[$in] * 2);
                                    $totalWin += ($insuranceBet[$in] * 2);
                                }
                            }
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
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $_obf_0D4003073218232513213F29091C232512062334163B01 = 'a';
                    $slotSettings->SetGameData('BlackJackAMBoxes', 'NULL');
                    $slotSettings->SetGameData('BlackJackAMBet', 'NULL');
                    $slotSettings->SetGameData('BlackJackAMtotalCnt', 'NULL');
                    $slotSettings->SetGameData('BlackJackAMCards', 'NULL');
                    $slotSettings->SetGameData('BlackJackAMboxState', 'NULL');
                    $slotSettings->SetGameData('BlackJackAMaState', 'NULL');
                    $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 = $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['win'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['win'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['win'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['win'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['win'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['win'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['win'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['win'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['win'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                    $response = '10' . $_obf_0D4003073218232513213F29091C232512062334163B01 . '010' . $balanceFormated . $slotSettings->HexFormat($totalWin * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($allbet * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . '100103000000000' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '101010101010' . implode('', $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01) . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['strOut'] . $_obf_0D07105B1227285B191F181715085C305B092712373332['strOut'] . '00#';
                    $_obf_0D16070C235B383B170B0A400B35352B370E1315313732 = $slotSettings->HexFormat($totalWin * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($allbet * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . '100103000000000' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . implode('', $_obf_0D180F291D362A2927280E2E1F3630172934131B033211) . implode('', $_obf_0D011F2625290509133D113021112F1F39032D100A1201) . implode('', $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01) . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['strOut'] . $_obf_0D07105B1227285B191F181715085C305B092712373332['strOut'] . '00#';
                    $slotSettings->SetGameData('BlackJackAMEnd', $_obf_0D16070C235B383B170B0A400B35352B370E1315313732);
                    $slotSettings->SetGameData('BlackJackAMLastAction', $_obf_0D4003073218232513213F29091C232512062334163B01);
                    $slotSettings->SaveLogReport($response, 0, 1, $totalWin, 'bet');
                    break;
                case 'A/u2811':
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $response = '10b010' . $balanceFormated . $slotSettings->GetGameData('BlackJackAMEnd');
                    $slotSettings->SetGameData('BlackJackAMLastAction', 'b');
                    break;
                case 'A/u285':
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
                        $cardsID['card_' . $i . '_0'] = $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01;
                        $cardsID['card_' . $i . '_1'] = $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22;
                        $cardsID['card_' . $i . '_2'] = $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11;
                        $cardsID['card_' . $i . '_3'] = $_obf_0D3E2523321514182A275C28072A2B22093F3510150901;
                        $cnt += 4;
                    }
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01 = $slotSettings->GetGameData('BlackJackAMBoxes');
                    $allbet = $slotSettings->GetGameData('BlackJackAMBet');
                    $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711 = $slotSettings->GetGameData('BlackJackAMtotalCnt');
                    $cardsArr = $slotSettings->GetGameData('BlackJackAMCards');
                    $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = $slotSettings->GetGameData('BlackJackAMboxState');
                    $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01 = $slotSettings->GetGameData('BlackJackAMaState');
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 0 && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 1 && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 2 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid arguments"}';
                        exit( $response );
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 0 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 1;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '0';
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 1 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 4;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '1';
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 2 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 7;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '2';
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] == 0 ) 
                    {
                        $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '0';
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] == 1 ) 
                    {
                        $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '1';
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[3] == 0 ) 
                    {
                        $_obf_0D40243F34181C0D4002141E08211B0B26010630093F32 = '0';
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[3] == 1 ) 
                    {
                        $_obf_0D40243F34181C0D4002141E08211B0B26010630093F32 = '1';
                    }
                    $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 + 1] = '00';
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '3';
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 + 1]['cards'][0] = $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['cards'][1];
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 + 1]['state'] = $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'];
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 + 1]['bet'] = $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'];
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'] <= $slotSettings->GetBalance() ) 
                    {
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'] / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                        $slotSettings->UpdateJackpots($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet']);
                        $slotSettings->SetBalance(-1 * $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'], 'bet');
                        $slotSettings->SaveLogReport($response, $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'], 1, 0, 'bet');
                        $allbet += $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'];
                    }
                    else
                    {
                        echo '{"error":"invalid_balance","state":"double"}';
                    }
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['cnt'] = 1;
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 + 1]['cnt'] = 1;
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['cards'][$_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['cnt']] = $cardsArr[$_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711];
                    $slotSettings->GetScore($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]);
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['strOut'] = $slotSettings->FormatBox($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['cards'], $cardsID);
                    $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711++;
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 + 1]['cards'][$_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 + 1]['cnt']] = $cardsArr[$_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711];
                    $slotSettings->GetScore($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 + 1]);
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 + 1]['strOut'] = $slotSettings->FormatBox($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 + 1]['cards'], $cardsID);
                    $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711++;
                    $_obf_0D4003073218232513213F29091C232512062334163B01 = '5';
                    $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 = '';
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] > 0 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '01';
                    }
                    else
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                    }
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['bet'] > 0 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '01';
                    }
                    else
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                    }
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] > 0 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '01';
                    }
                    else
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                    }
                    $slotSettings->SetGameData('BlackJackAMBoxes', $_obf_0D4001063140300A0A13173E1109212332242D070C3B01);
                    $slotSettings->SetGameData('BlackJackAMBet', $allbet);
                    $slotSettings->SetGameData('BlackJackAMtotalCnt', $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711);
                    $slotSettings->SetGameData('BlackJackAMCards', $cardsArr);
                    $slotSettings->SetGameData('BlackJackAMboxState', $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11);
                    $slotSettings->SetGameData('BlackJackAMaState', $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01);
                    $slotSettings->SetGameData('BlackJackAMLastAction', $_obf_0D4003073218232513213F29091C232512062334163B01);
                    $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 = $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $response = '10' . $_obf_0D4003073218232513213F29091C232512062334163B01 . '010' . $balanceFormated . '10' . $slotSettings->HexFormat($allbet * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . '10010' . $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 . '0' . $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 . $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . '101010101010101010101010101010' . implode('', $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01) . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[0]['strOut'] . '00#';
                    break;
                case 'A/u283':
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
                        $cardsID['card_' . $i . '_0'] = $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01;
                        $cardsID['card_' . $i . '_1'] = $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22;
                        $cardsID['card_' . $i . '_2'] = $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11;
                        $cardsID['card_' . $i . '_3'] = $_obf_0D3E2523321514182A275C28072A2B22093F3510150901;
                        $cnt += 4;
                    }
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01 = $slotSettings->GetGameData('BlackJackAMBoxes');
                    $allbet = $slotSettings->GetGameData('BlackJackAMBet');
                    $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711 = $slotSettings->GetGameData('BlackJackAMtotalCnt');
                    $cardsArr = $slotSettings->GetGameData('BlackJackAMCards');
                    $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = $slotSettings->GetGameData('BlackJackAMboxState');
                    $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01 = $slotSettings->GetGameData('BlackJackAMaState');
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 0 && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 1 && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 2 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid arguments"}';
                        exit( $response );
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 0 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 1;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '0';
                        $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '0';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '3';
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] == 1 ) 
                        {
                            $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '1';
                            $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 2;
                        }
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 1 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 4;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '1';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '3';
                        $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '0';
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] == 1 ) 
                        {
                            $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '1';
                            $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 5;
                        }
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 2 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 7;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '2';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '3';
                        $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '0';
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] == 1 ) 
                        {
                            $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '1';
                            $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 8;
                        }
                    }
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['cards'][$_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['cnt']] = $cardsArr[$_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711];
                    $slotSettings->GetScore($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]);
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['strOut'] = $slotSettings->FormatBox($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['cards'], $cardsID);
                    $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711++;
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['mainScore'] > 21 ) 
                    {
                        $_obf_0D4003073218232513213F29091C232512062334163B01 = '9';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '9';
                    }
                    else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['mainScore'] == 21 ) 
                    {
                        $_obf_0D4003073218232513213F29091C232512062334163B01 = '3';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '4';
                    }
                    else
                    {
                        $_obf_0D4003073218232513213F29091C232512062334163B01 = '3';
                    }
                    $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 = '';
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '1' && $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 == 2 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '01';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['mainScore'] > 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '9';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[2] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] = '9';
                        }
                        else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['mainScore'] == 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '4';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[2] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] = '3';
                        }
                        else
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '3';
                        }
                    }
                    else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '0' && $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 == 1 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['mainScore'] > 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '9';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[1] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] = '3';
                        }
                        else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['mainScore'] == 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '3';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[1] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] = '4';
                        }
                        else
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '3';
                        }
                    }
                    else
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                    }
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '1' && $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 == 5 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '01';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['mainScore'] > 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '9';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[5] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] = '9';
                        }
                        else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['mainScore'] == 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '3';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[5] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] = '4';
                        }
                        else
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '3';
                        }
                    }
                    else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '0' && $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 == 4 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['mainScore'] > 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '9';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[4] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] = '3';
                        }
                        else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['mainScore'] == 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '3';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[4] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] = '4';
                        }
                        else
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '3';
                        }
                    }
                    else
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                    }
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '1' && $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 == 8 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '01';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['mainScore'] > 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '9';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[8] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] = '9';
                        }
                        else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['mainScore'] == 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '3';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[8] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] = '4';
                        }
                        else
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '3';
                        }
                    }
                    else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '0' && $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 == 7 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['mainScore'] > 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '9';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[7] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] = '3';
                        }
                        else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['mainScore'] == 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '3';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[7] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] = '4';
                        }
                        else
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '3';
                        }
                    }
                    else
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                    }
                    $slotSettings->SetGameData('BlackJackAMBoxes', $_obf_0D4001063140300A0A13173E1109212332242D070C3B01);
                    $slotSettings->SetGameData('BlackJackAMBet', $allbet);
                    $slotSettings->SetGameData('BlackJackAMtotalCnt', $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711);
                    $slotSettings->SetGameData('BlackJackAMCards', $cardsArr);
                    $slotSettings->SetGameData('BlackJackAMboxState', $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11);
                    $slotSettings->SetGameData('BlackJackAMaState', $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01);
                    $slotSettings->SetGameData('BlackJackAMLastAction', $_obf_0D4003073218232513213F29091C232512062334163B01);
                    $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 = $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $response = '10' . $_obf_0D4003073218232513213F29091C232512062334163B01 . '010' . $balanceFormated . '10' . $slotSettings->HexFormat($allbet * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . '10010' . $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 . '0' . $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 . $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . '101010101010101010101010101010' . implode('', $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01) . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[0]['strOut'] . '00#' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['mainScore'] . '|' . $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 . '|' . implode(',', $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['cards']);
                    break;
                case 'A/u286':
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
                        $cardsID['card_' . $i . '_0'] = $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01;
                        $cardsID['card_' . $i . '_1'] = $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22;
                        $cardsID['card_' . $i . '_2'] = $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11;
                        $cardsID['card_' . $i . '_3'] = $_obf_0D3E2523321514182A275C28072A2B22093F3510150901;
                        $cnt += 4;
                    }
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01 = $slotSettings->GetGameData('BlackJackAMBoxes');
                    $allbet = $slotSettings->GetGameData('BlackJackAMBet');
                    $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711 = $slotSettings->GetGameData('BlackJackAMtotalCnt');
                    $cardsArr = $slotSettings->GetGameData('BlackJackAMCards');
                    $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = $slotSettings->GetGameData('BlackJackAMboxState');
                    $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01 = $slotSettings->GetGameData('BlackJackAMaState');
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 0 && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 1 && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 2 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid arguments"}';
                        exit( $response );
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 0 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 1;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '0';
                        $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '0';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '4';
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] == 1 ) 
                        {
                            $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '1';
                            $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 2;
                        }
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 1 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 4;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '1';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '4';
                        $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '0';
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] == 1 ) 
                        {
                            $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '1';
                            $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 5;
                        }
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 2 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 7;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '2';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '4';
                        $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '0';
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] == 1 ) 
                        {
                            $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '1';
                            $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 8;
                        }
                    }
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['cards'][$_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['cnt']] = $cardsArr[$_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711];
                    $slotSettings->GetScore($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]);
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['strOut'] = $slotSettings->FormatBox($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['cards'], $cardsID);
                    $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711++;
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'] <= $slotSettings->GetBalance() ) 
                    {
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'] / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                        $slotSettings->UpdateJackpots($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet']);
                        $slotSettings->SetBalance(-1 * $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'], 'bet');
                        $slotSettings->SaveLogReport($response, $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'], 1, 0, 'bet');
                        $allbet += $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'];
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'] = $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'] * 2;
                    }
                    else
                    {
                        echo '{"error":"invalid_balance","state":"double"}';
                    }
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['mainScore'] > 21 ) 
                    {
                        $_obf_0D4003073218232513213F29091C232512062334163B01 = '9';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '9';
                    }
                    else
                    {
                        $_obf_0D4003073218232513213F29091C232512062334163B01 = '6';
                    }
                    $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 = '';
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '1' ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '01';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['mainScore'] > 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '9';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[2] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] = '9';
                        }
                        else
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '6';
                        }
                    }
                    else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '0' ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['mainScore'] > 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '9';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[1] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] = '4';
                        }
                        else
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '6';
                        }
                    }
                    else
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                    }
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '1' ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '01';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['mainScore'] > 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '9';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[5] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] = '9';
                        }
                        else
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '6';
                        }
                    }
                    else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '0' ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['mainScore'] > 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '9';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[4] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] = '9';
                        }
                        else
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '6';
                        }
                    }
                    else
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                    }
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '1' ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '01';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['mainScore'] > 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '9';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[8] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] = '9';
                        }
                        else
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '6';
                        }
                    }
                    else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '0' ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['mainScore'] > 21 ) 
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '9';
                            $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[7] = '01';
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] = '4';
                        }
                        else
                        {
                            $_obf_0D4003073218232513213F29091C232512062334163B01 = '6';
                        }
                    }
                    else
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                    }
                    $slotSettings->SetGameData('BlackJackAMBoxes', $_obf_0D4001063140300A0A13173E1109212332242D070C3B01);
                    $slotSettings->SetGameData('BlackJackAMBet', $allbet);
                    $slotSettings->SetGameData('BlackJackAMtotalCnt', $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711);
                    $slotSettings->SetGameData('BlackJackAMCards', $cardsArr);
                    $slotSettings->SetGameData('BlackJackAMboxState', $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11);
                    $slotSettings->SetGameData('BlackJackAMaState', $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01);
                    $slotSettings->SetGameData('BlackJackAMLastAction', $_obf_0D4003073218232513213F29091C232512062334163B01);
                    $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 = $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $response = '10' . $_obf_0D4003073218232513213F29091C232512062334163B01 . '010' . $balanceFormated . '10' . $slotSettings->HexFormat($allbet * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . '10010' . $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 . '0' . $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 . $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . '101010101010101010101010101010' . implode('', $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01) . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[0]['strOut'] . '00#';
                    break;
                case 'A/u284':
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
                        $cardsID['card_' . $i . '_0'] = $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01;
                        $cardsID['card_' . $i . '_1'] = $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22;
                        $cardsID['card_' . $i . '_2'] = $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11;
                        $cardsID['card_' . $i . '_3'] = $_obf_0D3E2523321514182A275C28072A2B22093F3510150901;
                        $cnt += 4;
                    }
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01 = $slotSettings->GetGameData('BlackJackAMBoxes');
                    $allbet = $slotSettings->GetGameData('BlackJackAMBet');
                    $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711 = $slotSettings->GetGameData('BlackJackAMtotalCnt');
                    $cardsArr = $slotSettings->GetGameData('BlackJackAMCards');
                    $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = $slotSettings->GetGameData('BlackJackAMboxState');
                    $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01 = $slotSettings->GetGameData('BlackJackAMaState');
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 0 && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 1 && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 2 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid arguments"}';
                        exit( $response );
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 0 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 1;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '0';
                        $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '0';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '4';
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] == 1 ) 
                        {
                            $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '1';
                            $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 2;
                        }
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 1 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 4;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '1';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '4';
                        $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '0';
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] == 1 ) 
                        {
                            $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '1';
                            $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 5;
                        }
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 2 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 7;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '2';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '4';
                        $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '0';
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] == 1 ) 
                        {
                            $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '1';
                            $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 8;
                        }
                    }
                    if( !isset($_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22) ) 
                    {
                        $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22] = '01';
                    }
                    $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 = '';
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '1' && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 0 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '01';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] = '4';
                    }
                    else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '0' && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 0 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] = '3';
                    }
                    else
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                    }
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '1' && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 1 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '01';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] = '4';
                    }
                    else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '0' && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 1 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] = '3';
                    }
                    else
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                    }
                    if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '1' && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 2 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '01';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] = '4';
                    }
                    else if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] > 0 && $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 == '0' && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 2 ) 
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] = '3';
                    }
                    else
                    {
                        $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 .= '00';
                    }
                    $slotSettings->SetGameData('BlackJackAMBoxes', $_obf_0D4001063140300A0A13173E1109212332242D070C3B01);
                    $slotSettings->SetGameData('BlackJackAMBet', $allbet);
                    $slotSettings->SetGameData('BlackJackAMtotalCnt', $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711);
                    $slotSettings->SetGameData('BlackJackAMCards', $cardsArr);
                    $slotSettings->SetGameData('BlackJackAMboxState', $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11);
                    $slotSettings->SetGameData('BlackJackAMaState', $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01);
                    $slotSettings->SetGameData('BlackJackAMLastAction', '4');
                    $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 = $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $response = '104010' . $balanceFormated . '10' . $slotSettings->HexFormat($allbet * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . '10010' . $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 . '0' . $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 . $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . '101010101010101010101010101010' . implode('', $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01) . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[0]['strOut'] . '00#';
                    break;
                case 'A/u288':
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
                        $cardsID['card_' . $i . '_0'] = $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01;
                        $cardsID['card_' . $i . '_1'] = $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22;
                        $cardsID['card_' . $i . '_2'] = $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11;
                        $cardsID['card_' . $i . '_3'] = $_obf_0D3E2523321514182A275C28072A2B22093F3510150901;
                        $cnt += 4;
                    }
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01 = $slotSettings->GetGameData('BlackJackAMBoxes');
                    $allbet = $slotSettings->GetGameData('BlackJackAMBet');
                    $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711 = $slotSettings->GetGameData('BlackJackAMtotalCnt');
                    $cardsArr = $slotSettings->GetGameData('BlackJackAMCards');
                    $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = $slotSettings->GetGameData('BlackJackAMboxState');
                    $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01 = $slotSettings->GetGameData('BlackJackAMaState');
                    $_obf_0D180F291D362A2927280E2E1F3630172934131B033211 = $slotSettings->GetGameData('BlackJackAMinsuranceState');
                    $insuranceBet = $slotSettings->GetGameData('BlackJackAMinsuranceBet');
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 0 && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 1 && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] != 2 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid arguments"}';
                        exit( $response );
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 0 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 1;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '0';
                        $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '0';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] == '8' ) 
                        {
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '3';
                        }
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] == 1 ) 
                        {
                        }
                        else
                        {
                            $_obf_0D180F291D362A2927280E2E1F3630172934131B033211[0] = $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'] / 2 * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                            $insuranceBet[0] = $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'] / 2;
                            $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $insuranceBet[0] / 100 * $slotSettings->GetPercent();
                            $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                            $slotSettings->UpdateJackpots($insuranceBet[0]);
                            $slotSettings->SetBalance(-1 * $insuranceBet[0]);
                            $slotSettings->SaveLogReport($response, $insuranceBet[0], 1, 0, 'bet');
                        }
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 1 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 4;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '1';
                        $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '0';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] == '8' ) 
                        {
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '3';
                        }
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] == 1 ) 
                        {
                        }
                        else
                        {
                            $_obf_0D180F291D362A2927280E2E1F3630172934131B033211[1] = $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'] / 2 * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                            $insuranceBet[1] = $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'] / 2;
                            $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $insuranceBet[1] / 100 * $slotSettings->GetPercent();
                            $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                            $slotSettings->UpdateJackpots($insuranceBet[1]);
                            $slotSettings->SetBalance(-1 * $insuranceBet[1]);
                            $slotSettings->SaveLogReport($response, $insuranceBet[1], 1, 0, 'bet');
                        }
                    }
                    if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] == 2 ) 
                    {
                        $_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22 = 7;
                        $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '2';
                        $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 = '0';
                        if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] == '8' ) 
                        {
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['state'] = '3';
                        }
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] == 1 ) 
                        {
                        }
                        else
                        {
                            $_obf_0D180F291D362A2927280E2E1F3630172934131B033211[2] = $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'] / 2 * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                            $insuranceBet[2] = $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$_obf_0D3F1021283E052B2538083C2B3628213E14030F330F22]['bet'] / 2;
                            $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $insuranceBet[2] / 100 * $slotSettings->GetPercent();
                            $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                            $slotSettings->UpdateJackpots($insuranceBet[2]);
                            $slotSettings->SetBalance(-1 * $insuranceBet[2]);
                            $slotSettings->SaveLogReport($response, $insuranceBet[2], 1, 0, 'bet');
                        }
                    }
                    $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 = '';
                    $slotSettings->SetGameData('BlackJackAMBoxes', $_obf_0D4001063140300A0A13173E1109212332242D070C3B01);
                    $slotSettings->SetGameData('BlackJackAMBet', $allbet);
                    $slotSettings->SetGameData('BlackJackAMinsuranceBet', $insuranceBet);
                    $slotSettings->SetGameData('BlackJackAMinsuranceState', $_obf_0D180F291D362A2927280E2E1F3630172934131B033211);
                    $slotSettings->SetGameData('BlackJackAMLastAction', '8');
                    $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 = $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $response = '108010' . $balanceFormated . '10' . $slotSettings->HexFormat($allbet * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . '10010' . $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 . '0' . $_obf_0D38393B2E1C28143E2E34111427401C3F1333220C3001 . $_obf_0D331E390F2E5C210D1D245C061E0719163F153F041732 . '0000000' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . '101010101010101010' . implode('', $_obf_0D180F291D362A2927280E2E1F3630172934131B033211) . '101010' . implode('', $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01) . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[0]['strOut'] . '00#';
                    break;
                case 'A/u281':
                    $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[4] = $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2];
                    $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[5] = 0;
                    $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[6] = 0;
                    $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[7] = $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[3];
                    $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[8] = 0;
                    $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[9] = 0;
                    $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[2] = 0;
                    $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[3] = 0;
                    $allbet = 0;
                    for( $i = 1; $i <= 9; $i++ ) 
                    {
                        $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[$i] = (int)$_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[$i];
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[$i] > 0 ) 
                        {
                            $allbet += ($_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[$i] / $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                        }
                    }
                    $cardsID = [];
                    $cardsArr = [];
                    $_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301 = [];
                    $cnt = 0;
                    $slotSettings->SetGameData('BlackJackAMBankReserved', 0);
                    $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    $_obf_0D0A333F1E293E142C120B072C0C163D0608260C5C3E22 = false;
                    $_obf_0D0A011435342E3E2E30271D0413400801233224393111 = true;
                    if( $bank < ($allbet * 2.5) ) 
                    {
                        $_obf_0D0A333F1E293E142C120B072C0C163D0608260C5C3E22 = true;
                        if( $bank < ($allbet * 3) ) 
                        {
                            $_obf_0D0A011435342E3E2E30271D0413400801233224393111 = false;
                        }
                    }
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
                        if( $_obf_0D0A333F1E293E142C120B072C0C163D0608260C5C3E22 && $i >= 12 ) 
                        {
                            $cardsID['card_' . $i . '_0'] = $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01;
                            $cardsID['card_' . $i . '_1'] = $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22;
                            $cardsID['card_' . $i . '_2'] = $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11;
                            $cardsID['card_' . $i . '_3'] = $_obf_0D3E2523321514182A275C28072A2B22093F3510150901;
                            $_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301[] = 'card_' . $i . '_0';
                            $_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301[] = 'card_' . $i . '_1';
                            $_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301[] = 'card_' . $i . '_2';
                            $_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301[] = 'card_' . $i . '_3';
                        }
                        else
                        {
                            $cardsID['card_' . $i . '_0'] = $_obf_0D1902043F2E0B1A28372834283D0B285C2A1D0D2E3D01;
                            $cardsID['card_' . $i . '_1'] = $_obf_0D5C382A21400E24010F03332D39333C162302321C0F22;
                            $cardsID['card_' . $i . '_2'] = $_obf_0D330D2A3E132C0A3116080E31315B03281A3136392F11;
                            $cardsID['card_' . $i . '_3'] = $_obf_0D3E2523321514182A275C28072A2B22093F3510150901;
                            $cardsArr[] = 'card_' . $i . '_0';
                            $cardsArr[] = 'card_' . $i . '_1';
                            $cardsArr[] = 'card_' . $i . '_2';
                            $cardsArr[] = 'card_' . $i . '_3';
                        }
                        $cnt += 4;
                    }
                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01 = [];
                    for( $i = 0; $i <= 9; $i++ ) 
                    {
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i] = [];
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['cards'] = [
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63', 
                            '63'
                        ];
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['mainScore'] = 0;
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['altScore'] = 0;
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['bet'] = 0;
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['insurance'] = 0;
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['cnt'] = 0;
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['state'] = 'd';
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['win'] = 0;
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['blackjack'] = false;
                    }
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
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        shuffle($cardsArr);
                        $totalWin = 0;
                        $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711 = 0;
                        if( $_obf_0D0A333F1E293E142C120B072C0C163D0608260C5C3E22 ) 
                        {
                            shuffle($_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301);
                            if( !$_obf_0D0A011435342E3E2E30271D0413400801233224393111 ) 
                            {
                                for( $in = 0; $in <= 10; $in++ ) 
                                {
                                    shuffle($_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301);
                                    if( $_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301[0] != 'card_14_0' && $_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301[0] != 'card_14_1' && $_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301[0] != 'card_14_2' && $_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301[0] != 'card_14_3' ) 
                                    {
                                        break;
                                    }
                                }
                            }
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[0]['cards'][0] = $_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301[0];
                            array_shift($_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301);
                        }
                        else
                        {
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[0]['cards'][0] = $cardsArr[$_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711];
                        }
                        $slotSettings->GetScore($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[0]);
                        $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[0]['strOut'] = $slotSettings->FormatBox($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[0]['cards'], $cardsID);
                        $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711++;
                        $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01 = [
                            '', 
                            '01', 
                            '01', 
                            '01', 
                            '01', 
                            '01', 
                            '01', 
                            '01', 
                            '01', 
                            '01'
                        ];
                        $_obf_0D123F3E30072C1F3F0E3B33361B320523243928242922 = 0;
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] > 0 ) 
                        {
                            $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '0';
                            $_obf_0D123F3E30072C1F3F0E3B33361B320523243928242922++;
                        }
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[4] > 0 ) 
                        {
                            $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '1';
                            $_obf_0D123F3E30072C1F3F0E3B33361B320523243928242922++;
                        }
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[7] > 0 ) 
                        {
                            $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '2';
                            $_obf_0D123F3E30072C1F3F0E3B33361B320523243928242922++;
                        }
                        if( $_obf_0D123F3E30072C1F3F0E3B33361B320523243928242922 > 1 ) 
                        {
                            $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '0';
                        }
                        if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[4] > 0 && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[7] > 0 && $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[1] <= 0 ) 
                        {
                            $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 = '1';
                            $_obf_0D123F3E30072C1F3F0E3B33361B320523243928242922++;
                        }
                        for( $i = 1; $i <= 9; $i++ ) 
                        {
                            $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[$i] = (int)$_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[$i];
                            if( $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[$i] > 0 ) 
                            {
                                $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01[$i] = '00';
                                $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['cards'][$_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['cnt'] + 0] = $cardsArr[$_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711];
                                $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711++;
                                $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['cards'][$_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['cnt'] + 1] = $cardsArr[$_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711];
                                $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711++;
                                $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['bet'] = $_obf_0D1F343E172A2D1D232C0E035C01131F1E1E0F3E332F11[$i] / $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01;
                                $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['state'] = '3';
                                $slotSettings->GetScore($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]);
                                if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['mainScore'] >= 9 && $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['mainScore'] <= 11 ) 
                                {
                                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['state'] = '6';
                                }
                                if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['mainScore'] == 21 ) 
                                {
                                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['state'] = 'c';
                                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['blackjack'] = true;
                                }
                                $_obf_0D3C2C30070F23112D0C2D2337251C153F3E3E3B121C01 = explode('_', $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['cards'][0]);
                                $_obf_0D313C0C2D13180E2C0E0E210929032A1A1C150A102C32 = explode('_', $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['cards'][1]);
                                if( $_obf_0D3C2C30070F23112D0C2D2337251C153F3E3E3B121C01[1] > 10 && $_obf_0D3C2C30070F23112D0C2D2337251C153F3E3E3B121C01[1] < 14 ) 
                                {
                                    $_obf_0D3C2C30070F23112D0C2D2337251C153F3E3E3B121C01[1] = 10;
                                }
                                if( $_obf_0D313C0C2D13180E2C0E0E210929032A1A1C150A102C32[1] > 10 && $_obf_0D313C0C2D13180E2C0E0E210929032A1A1C150A102C32[1] < 14 ) 
                                {
                                    $_obf_0D313C0C2D13180E2C0E0E210929032A1A1C150A102C32[1] = 10;
                                }
                                if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['cnt'] == 2 && $_obf_0D3C2C30070F23112D0C2D2337251C153F3E3E3B121C01[1] == $_obf_0D313C0C2D13180E2C0E0E210929032A1A1C150A102C32[1] && $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['state'] != 'c' ) 
                                {
                                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['state'] = '5';
                                }
                                if( $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[0]['mainScore'] == 11 && $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['state'] != 'c' ) 
                                {
                                    $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['state'] = '8';
                                }
                            }
                            $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['strOut'] = $slotSettings->FormatBox($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[$i]['cards'], $cardsID);
                        }
                        if( $totalWin <= $bank ) 
                        {
                            if( !$_obf_0D0A333F1E293E142C120B072C0C163D0608260C5C3E22 ) 
                            {
                                $slotSettings->SetGameData('BlackJackAMBankReserved', $allbet * 2.5);
                                $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * ($allbet * 2.5));
                            }
                            break;
                        }
                    }
                    if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    }
                    $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $allbet / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $slotSettings->UpdateJackpots($allbet);
                    $slotSettings->SetBalance(-1 * $allbet, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $balanceFormated = $slotSettings->HexFormat(round($slotSettings->GetBalance() * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01));
                    $slotSettings->SetGameData('BlackJackAMBoxes', $_obf_0D4001063140300A0A13173E1109212332242D070C3B01);
                    $slotSettings->SetGameData('BlackJackAMBet', $allbet);
                    $slotSettings->SetGameData('BlackJackAMtotalCnt', $_obf_0D1F12023528270B2C0E361A36152A0F261E011C1A1711);
                    $slotSettings->SetGameData('BlackJackAMCards', $cardsArr);
                    $slotSettings->SetGameData('BlackJackAMCardsReserve', $_obf_0D0D32155B0B1B102513161D023406285C0F1C0B1D1301);
                    $slotSettings->SetGameData('BlackJackAMsmallBank', $_obf_0D0A333F1E293E142C120B072C0C163D0608260C5C3E22);
                    $slotSettings->SetGameData('BlackJackAMboxState', $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11);
                    $slotSettings->SetGameData('BlackJackAMaState', $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01);
                    $slotSettings->SetGameData('BlackJackAMLastAction', '2');
                    $_obf_0D180F291D362A2927280E2E1F3630172934131B033211 = [
                        '10', 
                        '10', 
                        '10'
                    ];
                    $insuranceBet = [
                        0, 
                        0, 
                        0
                    ];
                    $slotSettings->SetGameData('BlackJackAMinsuranceState', $_obf_0D180F291D362A2927280E2E1F3630172934131B033211);
                    $slotSettings->SetGameData('BlackJackAMinsuranceBet', $insuranceBet);
                    $slotSettings->SetGameData('BlackJackAMStep', 'betIsPlaced');
                    $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 = $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . $slotSettings->HexFormat($_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['bet'] * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01);
                    $response = '102010' . $balanceFormated . '10' . $slotSettings->HexFormat($allbet * $_obf_0D2C053C101716192D2F13310A1308232F0F393F253D01) . '10010' . $_obf_0D2929073F3B32121C23213326340E0121312E0A1E0F11 . '000000000' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['state'] . '0' . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['state'] . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . '101010101010101010' . implode('', $_obf_0D180F291D362A2927280E2E1F3630172934131B033211) . '101010' . implode('', $_obf_0D022D3B143E24382E1D2B321A1E0236050A253B070F01) . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[1]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[2]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[3]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[4]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[5]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[6]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[7]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[8]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[9]['strOut'] . $_obf_0D4001063140300A0A13173E1109212332242D070C3B01[0]['strOut'] . '00#';
                    $slotSettings->SaveLogReport($response, $allbet, 1, 0, 'bet');
                    break;
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
