<?php 
namespace VanguardLTE\Games\ActionMoneyEGT
{
    include('CheckReels.php');
    class Server
    {
        public function get($request, $game)
        {
            /* if( config('LicenseDK.APL_INCLUDE_KEY_CONFIG') != 'wi9qydosuimsnls5zoe5q298evkhim0ughx1w16qybs2fhlcpn' ) 
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
            }*/
            \DB::beginTransaction();
            $userId = \Auth::id();
            if( $userId == null ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid login"}';
                exit( $response );
            }
            $slotSettings = new SlotSettings($game, $userId);
            $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22 = json_decode(trim(file_get_contents('php://input')), true);
            $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
            $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201 = [];
            $_obf_0D36302910132C2C39290C27155B093F1526105B2A2C22 = '';
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] == 'bet' && $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['gameCommand'] == 'freespinchoice' ) 
            {
                $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] = 'freespinchoice';
            }
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] == 'bet' && $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['gameCommand'] == 'multiplierchoice' ) 
            {
                $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] = 'multiplierchoice';
            }
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] == 'bet' && $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['gameCommand'] == 'bonuschoice' ) 
            {
                $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] = 'bonuschoice';
            }
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] == 'bet' && $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['gameCommand'] == 'collect' ) 
            {
                $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] = 'collect';
            }
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] == 'bet' && $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['gameCommand'] == 'gamble' ) 
            {
                $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] = 'gamble';
            }
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] == 'bet' && $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['gameCommand'] == 'jackpot' ) 
            {
                $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] = 'jackpot';
            }
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] == 'gamble' && $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') <= 0 ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] . '","serverResponse":"invalid gamble state"}';
                exit( $response );
            }
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] == 'bet' ) 
            {
                $lines = $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['lines'];
                $betline = $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['bet'] / 100;
                if( $lines <= 0 || $betline <= 0.0001 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] . '","serverResponse":"invalid bet state"}';
                    exit( $response );
                }
                if( $slotSettings->GetBalance() < ($lines * $betline) ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] . '","serverResponse":"invalid balance"}';
                    exit( $response );
                }
                if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['bonus'] == 'true' ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }
            }
            $_obf_0D36302910132C2C39290C27155B093F1526105B2A2C22 = (string)$_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['command'];
            switch( $_obf_0D36302910132C2C39290C27155B093F1526105B2A2C22 ) 
            {
                case 'freespinchoice':
                    if( $slotSettings->GetGameData('ActionMoneyEGTBonusStart') != 1 ) 
                    {
                        exit();
                    }
                    $fs = $slotSettings->GetGameData('ActionMoneyEGTFreeGames');
                    $_obf_0D352C3B2F030A2414021C3C255C37211A3E31241E3922 = $slotSettings->GetGameData('ActionMoneyEGTFreeWild');
                    $choice = (int)$_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['choice'];
                    $_obf_0D18330E09150C022F0E5C0D230940050504030D320732 = [
                        5, 
                        6, 
                        7, 
                        -1, 
                        -1, 
                        -1, 
                        -1, 
                        -1
                    ];
                    shuffle($_obf_0D18330E09150C022F0E5C0D230940050504030D320732);
                    for( $i = 0; $i <= 7; $i++ ) 
                    {
                        if( $_obf_0D18330E09150C022F0E5C0D230940050504030D320732[$i] == $_obf_0D352C3B2F030A2414021C3C255C37211A3E31241E3922 ) 
                        {
                            $_obf_0D18330E09150C022F0E5C0D230940050504030D320732[$i] = -1;
                        }
                    }
                    $opt = [];
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(5, 12);
                    $_obf_0D130E1E32260405103E2A0438172A3B3D1428092E1201 = rand(5, 7);
                    $opt[0] = '{"pos":0,"multiplier":0,"freespins":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"wildcard":' . $_obf_0D18330E09150C022F0E5C0D230940050504030D320732[0] . ',"mult":0,"fs":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"play":true}';
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(5, 12);
                    $_obf_0D130E1E32260405103E2A0438172A3B3D1428092E1201 = rand(5, 7);
                    $opt[1] = '{"pos":1,"multiplier":0,"freespins":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"wildcard":' . $_obf_0D18330E09150C022F0E5C0D230940050504030D320732[1] . ',"mult":0,"fs":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"play":true}';
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(5, 12);
                    $_obf_0D130E1E32260405103E2A0438172A3B3D1428092E1201 = rand(5, 7);
                    $opt[2] = '{"pos":2,"multiplier":0,"freespins":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"wildcard":' . $_obf_0D18330E09150C022F0E5C0D230940050504030D320732[2] . ',"mult":0,"fs":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"play":true}';
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(5, 12);
                    $_obf_0D130E1E32260405103E2A0438172A3B3D1428092E1201 = rand(5, 7);
                    $opt[3] = '{"pos":3,"multiplier":0,"freespins":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"wildcard":' . $_obf_0D18330E09150C022F0E5C0D230940050504030D320732[3] . ',"mult":0,"fs":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"play":true}';
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(5, 12);
                    $_obf_0D130E1E32260405103E2A0438172A3B3D1428092E1201 = rand(5, 7);
                    $opt[4] = '{"pos":4,"multiplier":0,"freespins":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"wildcard":' . $_obf_0D18330E09150C022F0E5C0D230940050504030D320732[4] . ',"mult":0,"fs":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"play":true}';
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(5, 12);
                    $_obf_0D130E1E32260405103E2A0438172A3B3D1428092E1201 = rand(5, 7);
                    $opt[5] = '{"pos":5,"multiplier":0,"freespins":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"wildcard":' . $_obf_0D18330E09150C022F0E5C0D230940050504030D320732[5] . ',"mult":0,"fs":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"play":true}';
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(5, 12);
                    $_obf_0D130E1E32260405103E2A0438172A3B3D1428092E1201 = rand(5, 7);
                    $opt[6] = '{"pos":6,"multiplier":0,"freespins":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"wildcard":' . $_obf_0D18330E09150C022F0E5C0D230940050504030D320732[6] . ',"mult":0,"fs":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"play":true}';
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(5, 12);
                    $_obf_0D130E1E32260405103E2A0438172A3B3D1428092E1201 = rand(5, 7);
                    $opt[7] = '{"pos":7,"multiplier":0,"freespins":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"wildcard":' . $_obf_0D18330E09150C022F0E5C0D230940050504030D320732[7] . ',"mult":0,"fs":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"play":true}';
                    $opt[$choice] = '{"pos":' . $choice . ',"multiplier":0,"freespins":' . $fs . ',"wildcard":' . $_obf_0D352C3B2F030A2414021C3C255C37211A3E31241E3922 . ',"mult":0,"fs":' . $fs . ',"play":true}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '{"complex":{"choice":{"pos":' . $choice . ',"multiplier":0,"freespins":' . $fs . ',"wildcard":' . $_obf_0D352C3B2F030A2414021C3C255C37211A3E31241E3922 . ',"mult":0,"fs":' . $fs . ',"play":true,"closed":[' . implode(',', $opt) . ']},"freespins":' . $fs . ',"choices":1,"gameCommand":"freespinchoice"},"state":"freespin","winAmount":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . ',"gameIdentificationNumber":851,"gameNumber":1787203010852,"sessionKey":"5af6a26c031aa4ec491159428c5a7742","msg":"success","messageId":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['messageId'] . '","qName":"app.services.messages.response.GameEventResponse","command":"bet","eventTimestamp":1566584969191}';
                    break;
                case 'multiplierchoice':
                    if( $slotSettings->GetGameData('ActionMoneyEGTBonusStart') != 1 ) 
                    {
                        exit();
                    }
                    $mpl = $slotSettings->GetGameData('ActionMoneyEGTMultiplier');
                    $choice = (int)$_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['choice'];
                    $opt = [];
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(1, 5);
                    $opt[0] = '{"pos":0,"multiplier":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"freespins":0,"wildcard":-1,"mult":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"fs":0,"play":true}';
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(1, 5);
                    $opt[1] = '{"pos":1,"multiplier":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"freespins":0,"wildcard":-1,"mult":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"fs":0,"play":true}';
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(1, 5);
                    $opt[2] = '{"pos":2,"multiplier":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"freespins":0,"wildcard":-1,"mult":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"fs":0,"play":true}';
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(1, 5);
                    $opt[3] = '{"pos":3,"multiplier":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"freespins":0,"wildcard":-1,"mult":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"fs":0,"play":true}';
                    $opt[$choice] = '{"pos":' . $choice . ',"multiplier":' . $mpl . ',"freespins":0,"wildcard":-1,"mult":' . $mpl . ',"fs":0,"play":true}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '{"complex":{"choice":{"pos":' . $choice . ',"multiplier":' . $mpl . ',"freespins":0,"wildcard":-1,"mult":' . $mpl . ',"fs":0,"play":true,"closed":[]},"multiplier":' . $mpl . ',"choices":1,"gameCommand":"multiplierchoice"},"state":"freespinchoice","winAmount":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . ',"gameIdentificationNumber":851,"gameNumber":1787203010852,"sessionKey":"5af6a26c031aa4ec491159428c5a7742","msg":"success","messageId":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['messageId'] . '","qName":"app.services.messages.response.GameEventResponse","command":"bet","eventTimestamp":1566584919562} ';
                    break;
                case 'bonuschoice':
                    $_obf_0D380C300C40373F01352D073E2C1E341E390F0C211911 = [
                        2, 
                        2, 
                        2, 
                        2, 
                        2, 
                        2, 
                        4, 
                        4, 
                        4, 
                        6, 
                        6, 
                        6, 
                        6, 
                        8, 
                        8, 
                        8, 
                        8, 
                        10, 
                        12, 
                        14
                    ];
                    $bet = $slotSettings->GetGameData('ActionMoneyEGTBonusBet');
                    $bank = $slotSettings->GetBank('bonus');
                    for( $i = 0; $i <= 1000; $i++ ) 
                    {
                        shuffle($_obf_0D380C300C40373F01352D073E2C1E341E390F0C211911);
                        $_obf_0D2A011415400237290F232D0C0D3C1C0238370F231401 = $_obf_0D380C300C40373F01352D073E2C1E341E390F0C211911[0] * $bet;
                        if( $i >= 1000 || $slotSettings->GetGameData('ActionMoneyEGTBonusStart') != 1 ) 
                        {
                            exit();
                        }
                        if( $_obf_0D2A011415400237290F232D0C0D3C1C0238370F231401 <= $bank ) 
                        {
                            break;
                        }
                    }
                    $slotSettings->SetBalance($_obf_0D2A011415400237290F232D0C0D3C1C0238370F231401);
                    $slotSettings->SetBank('bonus', -1 * $_obf_0D2A011415400237290F232D0C0D3C1C0238370F231401);
                    $choice = (int)$_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['choice'];
                    $opt = [];
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(1, 10);
                    $opt[0] = '{"coef":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"bonus":false,"totalWin":' . ($_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 * $bet * 100) . '}';
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(1, 10);
                    $opt[1] = '{"coef":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"bonus":false,"totalWin":' . ($_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 * $bet * 100) . '}';
                    $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(1, 10);
                    $opt[2] = '{"coef":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"bonus":false,"totalWin":' . ($_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 * $bet * 100) . '}';
                    if( $slotSettings->GetGameData('ActionMoneyEGTBonusCnt') >= 4 ) 
                    {
                        $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(1, 10);
                        $opt[3] = '{"coef":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"bonus":false,"totalWin":' . ($_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 * $bet * 100) . '}';
                    }
                    if( $slotSettings->GetGameData('ActionMoneyEGTBonusCnt') >= 5 ) 
                    {
                        $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 = rand(1, 10);
                        $opt[4] = '{"coef":' . $_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 . ',"bonus":false,"totalWin":' . ($_obf_0D35163328030A1F0C0D0E072532190F1209130A1E1A22 * $bet * 100) . '}';
                    }
                    $slotSettings->SaveLogReport('NONE', $bet, 1, $_obf_0D2A011415400237290F232D0C0D3C1C0238370F231401, 'BG1');
                    $opt[$choice] = '{"coef":' . $_obf_0D380C300C40373F01352D073E2C1E341E390F0C211911[0] . ',"bonus":true,"totalWin":' . ($_obf_0D380C300C40373F01352D073E2C1E341E390F0C211911[0] * $bet * 100) . '}';
                    $slotSettings->SetGameData('ActionMoneyEGTBonusStart', 1);
                    $_obf_0D2A011415400237290F232D0C0D3C1C0238370F231401 = $_obf_0D2A011415400237290F232D0C0D3C1C0238370F231401 + $slotSettings->GetGameData('ActionMoneyEGTTotalWin');
                    $slotSettings->SetGameData('ActionMoneyEGTTotalWin', $_obf_0D2A011415400237290F232D0C0D3C1C0238370F231401);
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '{"complex":{"bonuschoiceObject":{"selectedIndex":' . $choice . ',"totalBet":' . ($bet * 100) . ',"options":[' . implode(',', $opt) . ']},"freespins":0,"multiplier":1,"choices":0,"gambles":5,"gameCommand":"bonuschoice"},"state":"multiplierchoice","winAmount":' . ($_obf_0D2A011415400237290F232D0C0D3C1C0238370F231401 * 100) . ',"gameIdentificationNumber":851,"gameNumber":1787135676614,"sessionKey":"6644c1af1441d207d3482a78f200b182","msg":"success","messageId":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['messageId'] . '","qName":"app.services.messages.response.GameEventResponse","command":"bet","eventTimestamp":1566568567774}';
                    break;
                case 'login':
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '{"playerName":"Demo Player - 1563864350676","balance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"currency":"' . $slotSettings->slotCurrency . '","languages":["en","bg","it","es","go","ru","fr","ro"],"groups":["all","cards","classic","diceSlots","extraline","fruit","keno","multiline","roulette","myGames"],"showRtp":false,"multigame":true,"sendTotalsInfo":false,"complex":{"CDJSlot":[{"gameIdentificationNumber":521,"recovery":"norecovery","gameName":"Caramel Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":136,"name":"all"},{"order":14,"name":"diceSlots"},{"order":136,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"ZWJSlot":[{"gameIdentificationNumber":807,"recovery":"norecovery","gameName":"Zodiac Wheel","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":19,"name":"all"},{"order":1,"name":"classic"},{"order":19,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TSHJSlot":[{"gameIdentificationNumber":803,"recovery":"norecovery","gameName":"20 Super Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":10,"name":"all"},{"order":6,"name":"fruit"},{"order":10,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"ARJSlot":[{"gameIdentificationNumber":520,"recovery":"norecovery","gameName":"Almighty Ramses II","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":102,"name":"all"},{"order":23,"name":"multiline"},{"order":102,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"IGTJSlot":[{"gameIdentificationNumber":865,"recovery":"norecovery","gameName":"Inca Gold II","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":97,"name":"all"},{"order":20,"name":"multiline"},{"order":97,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FBDJSlot":[{"gameIdentificationNumber":536,"recovery":"norecovery","gameName":"40 Burning Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":138,"name":"all"},{"order":16,"name":"diceSlots"},{"order":138,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TDRJSlot":[{"gameIdentificationNumber":882,"recovery":"norecovery","gameName":"2 Dragons","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":75,"name":"all"},{"order":15,"name":"classic"},{"order":75,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"CMJSlot":[{"gameIdentificationNumber":850,"recovery":"norecovery","gameName":"Casino Mania","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":106,"name":"all"},{"order":26,"name":"classic"},{"order":106,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"APJSlot":[{"gameIdentificationNumber":884,"recovery":"norecovery","gameName":"Aloha Party","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":57,"name":"all"},{"order":8,"name":"extraline"},{"order":57,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FOKBJPoker":[{"gameIdentificationNumber":20210,"recovery":"norecovery","gameName":"Four of a Kind Bonus Poker","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":121,"name":"all"},{"order":2,"name":"cards"},{"order":121,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"RWJSlot":[{"gameIdentificationNumber":899,"recovery":"norecovery","gameName":"Rich World","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":61,"name":"all"},{"order":5,"name":"multiline"},{"order":61,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FRSJSlot":[{"gameIdentificationNumber":853,"recovery":"norecovery","gameName":"Frog Story","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":25,"name":"all"},{"order":2,"name":"multiline"},{"order":25,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"Roulette":[{"subscriberName":"Roulette","automatic":true,"flashVideoStream":"rtmp://video.egtmgs.com/live","flashVideoSdp":"house-rlt03","rouletteCycleInterval":24,"gameNumber":"","denomination":100,"casinoName":"EGT","playerBet":{},"rouletteType":"AUTOMATIC","gameIdentificationNumber":20201,"recovery":"norecovery","gameName":"EGT Roulette","featured":false,"mlmJackpot":false,"totalBet":0,"groups":[{"order":2,"name":"all"},{"order":2,"name":"roulette"},{"order":2,"name":"myGames"}]}],"TBJJSlot":[{"gameIdentificationNumber":513,"recovery":"norecovery","gameName":"The Big Journey","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":78,"name":"all"},{"order":17,"name":"classic"},{"order":78,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"CIJSlot":[{"gameIdentificationNumber":514,"recovery":"norecovery","gameName":"Coral Island","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":73,"name":"all"},{"order":13,"name":"classic"},{"order":73,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"UHJSlot":[{"gameIdentificationNumber":802,"recovery":"norecovery","gameName":"Ultimate Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":17,"name":"all"},{"order":13,"name":"fruit"},{"order":17,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"WHJSlot":[{"gameIdentificationNumber":523,"recovery":"norecovery","gameName":"Wonderheart","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":56,"name":"all"},{"order":4,"name":"multiline"},{"order":56,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"XSJSlot":[{"gameIdentificationNumber":822,"recovery":"norecovery","gameName":"Extra Stars","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":24,"name":"all"},{"order":17,"name":"fruit"},{"order":24,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"LADJSlot":[{"gameIdentificationNumber":515,"recovery":"norecovery","gameName":"Like a Diamond","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":114,"name":"all"},{"order":28,"name":"classic"},{"order":114,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FHJSlot":[{"gameIdentificationNumber":805,"recovery":"norecovery","gameName":"Flaming Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":12,"name":"all"},{"order":8,"name":"fruit"},{"order":12,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"KGJSlot":[{"gameIdentificationNumber":846,"recovery":"norecovery","gameName":"Kashmir Gold","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":91,"name":"all"},{"order":16,"name":"multiline"},{"order":91,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TSOAJSlot":[{"gameIdentificationNumber":896,"recovery":"norecovery","gameName":"The Story of Alexander","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":43,"name":"all"},{"order":5,"name":"extraline"},{"order":43,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FHSJSlot":[{"gameIdentificationNumber":879,"recovery":"norecovery","gameName":"50 Horses","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":67,"name":"all"},{"order":10,"name":"extraline"},{"order":67,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"GOLJSlot":[{"gameIdentificationNumber":823,"recovery":"norecovery","gameName":"Game of Luck","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":53,"name":"all"},{"order":8,"name":"classic"},{"order":53,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"SDJSlot":[{"gameIdentificationNumber":20224,"recovery":"norecovery","gameName":"Supreme Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":126,"name":"all"},{"order":4,"name":"diceSlots"},{"order":126,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"RMJSlot":[{"gameIdentificationNumber":504,"recovery":"norecovery","gameName":"Route of Mexico","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":72,"name":"all"},{"order":11,"name":"multiline"},{"order":72,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"QORJSlot":[{"gameIdentificationNumber":512,"recovery":"norecovery","gameName":"Queen of Rio","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":86,"name":"all"},{"order":22,"name":"classic"},{"order":86,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FMJSlot":[{"gameIdentificationNumber":501,"recovery":"norecovery","gameName":"Fast Money","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":87,"name":"all"},{"order":23,"name":"classic"},{"order":87,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"HDJSlot":[{"gameIdentificationNumber":893,"recovery":"norecovery","gameName":"100 Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":133,"name":"all"},{"order":11,"name":"diceSlots"},{"order":133,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TEJSlot":[{"gameIdentificationNumber":834,"recovery":"norecovery","gameName":"The Explorers","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":107,"name":"all"},{"order":26,"name":"multiline"},{"order":107,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"IDJSlot":[{"gameIdentificationNumber":867,"recovery":"norecovery","gameName":"Ice Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":141,"name":"all"},{"order":19,"name":"diceSlots"},{"order":141,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"GEJSlot":[{"gameIdentificationNumber":864,"recovery":"norecovery","gameName":"Great Empire","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":71,"name":"all"},{"order":12,"name":"classic"},{"order":71,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TWWJSlot":[{"gameIdentificationNumber":863,"recovery":"norecovery","gameName":"The White Wolf","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":82,"name":"all"},{"order":19,"name":"classic"},{"order":82,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FBHTJSlot":[{"gameIdentificationNumber":532,"recovery":"norecovery","gameName":"5 Burning Heart","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":26,"name":"all"},{"order":18,"name":"fruit"},{"order":26,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"HSHJSlot":[{"gameIdentificationNumber":527,"recovery":"norecovery","gameName":"100 Super Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":11,"name":"all"},{"order":7,"name":"fruit"},{"order":11,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FBJSlot":[{"gameIdentificationNumber":835,"recovery":"norecovery","gameName":"Forest Band","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":79,"name":"all"},{"order":13,"name":"multiline"},{"order":79,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"NDJSlot":[{"gameIdentificationNumber":861,"recovery":"norecovery","gameName":"Neon Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":137,"name":"all"},{"order":15,"name":"diceSlots"},{"order":137,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"ORJSlot":[{"gameIdentificationNumber":839,"recovery":"norecovery","gameName":"Ocean Rush","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":99,"name":"all"},{"order":21,"name":"multiline"},{"order":99,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"ABJSlot":[{"gameIdentificationNumber":859,"recovery":"norecovery","gameName":"Amazon\u0027s Battle","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":21,"name":"all"},{"order":1,"name":"extraline"},{"order":21,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"KLJSlot":[{"gameIdentificationNumber":836,"recovery":"norecovery","gameName":"Kangaroo Land","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":77,"name":"all"},{"order":12,"name":"multiline"},{"order":77,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FURJSlot":[{"gameIdentificationNumber":531,"recovery":"norecovery","gameName":"40 Ultra Respin","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":98,"name":"all"},{"order":36,"name":"fruit"},{"order":98,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"GOCJSlot":[{"gameIdentificationNumber":817,"recovery":"norecovery","gameName":"Grace of Cleopatra","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":54,"name":"all"},{"order":9,"name":"classic"},{"order":54,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FSJSlot":[{"gameIdentificationNumber":820,"recovery":"norecovery","gameName":"Fortune Spells","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":65,"name":"all"},{"order":11,"name":"classic"},{"order":65,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"IMDJSlot":[{"gameIdentificationNumber":874,"recovery":"norecovery","gameName":"Imperial Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":142,"name":"all"},{"order":20,"name":"diceSlots"},{"order":142,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TBDJSlot":[{"gameIdentificationNumber":537,"recovery":"norecovery","gameName":"20 Burning Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":139,"name":"all"},{"order":17,"name":"diceSlots"},{"order":139,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"SHJSlot":[{"gameIdentificationNumber":821,"recovery":"norecovery","gameName":"Supreme Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":14,"name":"all"},{"order":10,"name":"fruit"},{"order":14,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"OCJSlot":[{"gameIdentificationNumber":848,"recovery":"norecovery","gameName":"Oil Company II","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":55,"name":"all"},{"order":7,"name":"extraline"},{"order":55,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TDJSlot":[{"gameIdentificationNumber":854,"recovery":"norecovery","gameName":"20 Diamonds","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":29,"name":"all"},{"order":3,"name":"classic"},{"order":29,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"SBJSlot":[{"gameIdentificationNumber":855,"recovery":"norecovery","gameName":"Summer Bliss","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":94,"name":"all"},{"order":17,"name":"multiline"},{"order":94,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"GAJSlot":[{"gameIdentificationNumber":837,"recovery":"norecovery","gameName":"Great Adventure","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":90,"name":"all"},{"order":15,"name":"multiline"},{"order":90,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"THBJSlot":[{"gameIdentificationNumber":558,"recovery":"norecovery","gameName":"20 Hot Blast","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":6,"name":"all"},{"order":2,"name":"fruit"},{"order":6,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TBHTJSlot":[{"gameIdentificationNumber":533,"recovery":"norecovery","gameName":"10 Burning Heart","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":27,"name":"all"},{"order":19,"name":"fruit"},{"order":27,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FSDJSlot":[{"gameIdentificationNumber":20221,"recovery":"norecovery","gameName":"40 Super Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":124,"name":"all"},{"order":2,"name":"diceSlots"},{"order":124,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"RDJSlot":[{"gameIdentificationNumber":860,"recovery":"norecovery","gameName":"Rolling Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":144,"name":"all"},{"order":22,"name":"diceSlots"},{"order":144,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"STJSlot":[{"gameIdentificationNumber":897,"recovery":"norecovery","gameName":"Super 20","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":47,"name":"all"},{"order":32,"name":"fruit"},{"order":47,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"HCJSlot":[{"gameIdentificationNumber":847,"recovery":"norecovery","gameName":"100 Cats","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":35,"name":"all"},{"order":3,"name":"extraline"},{"order":35,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"RLTJSlot":[{"gameIdentificationNumber":550,"recovery":"norecovery","gameName":"Virtual Roulette","featured":true,"mlmJackpot":true,"totalBet":0,"groups":[{"order":1,"name":"all"},{"order":1,"name":"roulette"},{"order":1,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"VGJSlot":[{"gameIdentificationNumber":818,"recovery":"norecovery","gameName":"Versailles Gold","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":50,"name":"all"},{"order":5,"name":"classic"},{"order":50,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TSOLJSlot":[{"gameIdentificationNumber":873,"recovery":"norecovery","gameName":"The Secrets of London","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":105,"name":"all"},{"order":25,"name":"multiline"},{"order":105,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"BCJSlot":[{"gameIdentificationNumber":525,"recovery":"norecovery","gameName":"Brave Cat","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":80,"name":"all"},{"order":11,"name":"extraline"},{"order":80,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"WCJSlot":[{"gameIdentificationNumber":815,"recovery":"norecovery","gameName":"Witches Charm","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":83,"name":"all"},{"order":20,"name":"classic"},{"order":83,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"DQJSlot":[{"gameIdentificationNumber":858,"recovery":"norecovery","gameName":"Dark Queen","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":95,"name":"all"},{"order":18,"name":"multiline"},{"order":95,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FMCJSlot":[{"gameIdentificationNumber":547,"recovery":"norecovery","gameName":"40 Mega Clover","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":30,"name":"all"},{"order":20,"name":"fruit"},{"order":30,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"RORJSlot":[{"gameIdentificationNumber":806,"recovery":"norecovery","gameName":"Rise of Ra","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":28,"name":"all"},{"order":2,"name":"classic"},{"order":28,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"RSJSlot":[{"gameIdentificationNumber":809,"recovery":"norecovery","gameName":"Royal Secrets","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":38,"name":"all"},{"order":4,"name":"classic"},{"order":38,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"HSDJSlot":[{"gameIdentificationNumber":534,"recovery":"norecovery","gameName":"100 Super Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":125,"name":"all"},{"order":3,"name":"diceSlots"},{"order":125,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"DGRJSlot":[{"gameIdentificationNumber":508,"recovery":"norecovery","gameName":"Dragon Reborn","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":109,"name":"all"},{"order":27,"name":"multiline"},{"order":109,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"SCHJSlot":[{"gameIdentificationNumber":517,"recovery":"norecovery","gameName":"Sweet Cheese","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":117,"name":"all"},{"order":31,"name":"multiline"},{"order":117,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FDJSlot":[{"gameIdentificationNumber":509,"recovery":"norecovery","gameName":"Flaming Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":135,"name":"all"},{"order":13,"name":"diceSlots"},{"order":135,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"THDJSlot":[{"gameIdentificationNumber":507,"recovery":"norecovery","gameName":"Thumbelina Dream","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":116,"name":"all"},{"order":16,"name":"extraline"},{"order":116,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TSFJSlot":[{"gameIdentificationNumber":528,"recovery":"norecovery","gameName":"30 Spicy Fruits","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":18,"name":"all"},{"order":14,"name":"fruit"},{"order":18,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FDHJSlot":[{"gameIdentificationNumber":810,"recovery":"norecovery","gameName":"5 Dazzling Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":15,"name":"all"},{"order":11,"name":"fruit"},{"order":15,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"RQJSlot":[{"gameIdentificationNumber":840,"recovery":"norecovery","gameName":"Rainbow Queen","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":100,"name":"all"},{"order":13,"name":"extraline"},{"order":100,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"JOBJPoker":[{"gameIdentificationNumber":20202,"recovery":"norecovery","gameName":"Jacks or Better","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":122,"name":"all"},{"order":3,"name":"cards"},{"order":122,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"SHDJSlot":[{"gameIdentificationNumber":560,"recovery":"norecovery","gameName":"Shining Dice","featured":true,"mlmJackpot":true,"totalBet":0,"groups":[{"order":123,"name":"all"},{"order":1,"name":"diceSlots"},{"order":123,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"CHJSlot":[{"gameIdentificationNumber":506,"recovery":"norecovery","gameName":"Caramel Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":34,"name":"all"},{"order":23,"name":"fruit"},{"order":34,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"LAWJSlot":[{"gameIdentificationNumber":868,"recovery":"norecovery","gameName":"Lucky \u0026 Wild","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":58,"name":"all"},{"order":33,"name":"fruit"},{"order":58,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"DSJSlot":[{"gameIdentificationNumber":877,"recovery":"norecovery","gameName":"Dragon Spirit","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":145,"name":"all"},{"order":23,"name":"diceSlots"},{"order":145,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"VDJSlot":[{"gameIdentificationNumber":832,"recovery":"norecovery","gameName":"Venezia D\u0027oro","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":92,"name":"all"},{"order":12,"name":"extraline"},{"order":92,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"LBJSlot":[{"gameIdentificationNumber":881,"recovery":"norecovery","gameName":"Lucky Buzz","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":84,"name":"all"},{"order":14,"name":"multiline"},{"order":84,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"HBHJSlot":[{"gameIdentificationNumber":548,"recovery":"norecovery","gameName":"100 Burning Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":20,"name":"all"},{"order":15,"name":"fruit"},{"order":20,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"MLAWJSlot":[{"gameIdentificationNumber":869,"recovery":"norecovery","gameName":"More Lucky \u0026 Wild","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":46,"name":"all"},{"order":31,"name":"fruit"},{"order":46,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FTJSlot":[{"gameIdentificationNumber":876,"recovery":"norecovery","gameName":"Forest Tale","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":113,"name":"all"},{"order":29,"name":"multiline"},{"order":113,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"AOTJSlot":[{"gameIdentificationNumber":812,"recovery":"norecovery","gameName":"Age of Troy","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":48,"name":"all"},{"order":3,"name":"multiline"},{"order":48,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"SOAJSlot":[{"gameIdentificationNumber":828,"recovery":"norecovery","gameName":"Secrets of Alchemy","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":22,"name":"all"},{"order":1,"name":"multiline"},{"order":22,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"SLJSlot":[{"gameIdentificationNumber":892,"recovery":"norecovery","gameName":"Savanna\u0027s Life","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":119,"name":"all"},{"order":32,"name":"multiline"},{"order":119,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"BHJSlot":[{"gameIdentificationNumber":801,"recovery":"norecovery","gameName":"Burning Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":7,"name":"all"},{"order":3,"name":"fruit"},{"order":7,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TSDJSlot":[{"gameIdentificationNumber":20218,"recovery":"norecovery","gameName":"20 Super Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":128,"name":"all"},{"order":6,"name":"diceSlots"},{"order":128,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"JPJPoker":[{"gameIdentificationNumber":20208,"recovery":"norecovery","gameName":"Joker Poker","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":120,"name":"all"},{"order":1,"name":"cards"},{"order":120,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"AGJSlot":[{"gameIdentificationNumber":511,"recovery":"norecovery","gameName":"Aztec Glory","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":76,"name":"all"},{"order":16,"name":"classic"},{"order":76,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"GEOLJSlot":[{"gameIdentificationNumber":872,"recovery":"norecovery","gameName":"Genius of Leonardo","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":103,"name":"all"},{"order":14,"name":"extraline"},{"order":103,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"BDJSlot":[{"gameIdentificationNumber":20215,"recovery":"norecovery","gameName":"Burning Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":127,"name":"all"},{"order":5,"name":"diceSlots"},{"order":127,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"MPJSlot":[{"gameIdentificationNumber":502,"recovery":"norecovery","gameName":"Magellan Plus","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":49,"name":"all"},{"order":6,"name":"extraline"},{"order":49,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"AAJSlot":[{"gameIdentificationNumber":808,"recovery":"norecovery","gameName":"Amazing Amazonia","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":85,"name":"all"},{"order":21,"name":"classic"},{"order":85,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"CRBJSlot":[{"gameIdentificationNumber":518,"recovery":"norecovery","gameName":"Crazy Bugs II","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":115,"name":"all"},{"order":30,"name":"multiline"},{"order":115,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"PSJSlot":[{"gameIdentificationNumber":852,"recovery":"norecovery","gameName":"Penguin Style","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":62,"name":"all"},{"order":6,"name":"multiline"},{"order":62,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"WTJSlot":[{"gameIdentificationNumber":505,"recovery":"norecovery","gameName":"Wonder Tree","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":89,"name":"all"},{"order":25,"name":"classic"},{"order":89,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"MDJSlot":[{"gameIdentificationNumber":894,"recovery":"norecovery","gameName":"Magic Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":130,"name":"all"},{"order":8,"name":"diceSlots"},{"order":130,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"GTSJSlot":[{"gameIdentificationNumber":555,"recovery":"norecovery","gameName":"Great 27","featured":true,"mlmJackpot":true,"totalBet":0,"groups":[{"order":5,"name":"all"},{"order":1,"name":"fruit"},{"order":5,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"SCJSlot":[{"gameIdentificationNumber":831,"recovery":"norecovery","gameName":"Shining Crown","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":9,"name":"all"},{"order":5,"name":"fruit"},{"order":9,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TDHJSlot":[{"gameIdentificationNumber":544,"recovery":"norecovery","gameName":"20 Dazzling Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":37,"name":"all"},{"order":25,"name":"fruit"},{"order":37,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FHNCJSlot":[{"gameIdentificationNumber":545,"recovery":"norecovery","gameName":"40 Hot \u0026 Cash","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":59,"name":"all"},{"order":59,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"DARJSlot":[{"gameIdentificationNumber":824,"recovery":"norecovery","gameName":"Dice \u0026 Roll","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":39,"name":"all"},{"order":26,"name":"fruit"},{"order":39,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"MLADJSlot":[{"gameIdentificationNumber":516,"recovery":"norecovery","gameName":"More Like a Diamond","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":110,"name":"all"},{"order":15,"name":"extraline"},{"order":110,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"DORJSlot":[{"gameIdentificationNumber":856,"recovery":"norecovery","gameName":"Dice of Ra","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":140,"name":"all"},{"order":18,"name":"diceSlots"},{"order":140,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"CBJSlot":[{"gameIdentificationNumber":829,"recovery":"norecovery","gameName":"Circus Brilliant","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":66,"name":"all"},{"order":7,"name":"multiline"},{"order":66,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FHDJSlot":[{"gameIdentificationNumber":886,"recovery":"norecovery","gameName":"5 Hot Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":129,"name":"all"},{"order":7,"name":"diceSlots"},{"order":129,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"OGJSlot":[{"gameIdentificationNumber":819,"recovery":"norecovery","gameName":"Olympus Glory","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":52,"name":"all"},{"order":7,"name":"classic"},{"order":52,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"SPJSlot":[{"gameIdentificationNumber":895,"recovery":"norecovery","gameName":"Spanish Passion","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":88,"name":"all"},{"order":24,"name":"classic"},{"order":88,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"CRJSlot":[{"gameIdentificationNumber":871,"recovery":"norecovery","gameName":"Cats Royal","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":69,"name":"all"},{"order":9,"name":"multiline"},{"order":69,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FBHJSlot":[{"gameIdentificationNumber":529,"recovery":"norecovery","gameName":"40 Burning Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":16,"name":"all"},{"order":12,"name":"fruit"},{"order":16,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"GETJSlot":[{"gameIdentificationNumber":885,"recovery":"norecovery","gameName":"The Great Egypt","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":81,"name":"all"},{"order":18,"name":"classic"},{"order":81,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TSWJSlot":[{"gameIdentificationNumber":556,"recovery":"norecovery","gameName":"27 Wins","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":23,"name":"all"},{"order":16,"name":"fruit"},{"order":23,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"BOMJSlot":[{"gameIdentificationNumber":826,"recovery":"norecovery","gameName":"Book of Magic","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":51,"name":"all"},{"order":6,"name":"classic"},{"order":51,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"DHIJSlot":[{"gameIdentificationNumber":519,"recovery":"norecovery","gameName":"Dice High","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":112,"name":"all"},{"order":37,"name":"fruit"},{"order":112,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"IWJSlot":[{"gameIdentificationNumber":841,"recovery":"norecovery","gameName":"Imperial Wars","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":70,"name":"all"},{"order":10,"name":"multiline"},{"order":70,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"EHJSlot":[{"gameIdentificationNumber":880,"recovery":"norecovery","gameName":"Extremely Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":45,"name":"all"},{"order":30,"name":"fruit"},{"order":45,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FSHJSlot":[{"gameIdentificationNumber":804,"recovery":"norecovery","gameName":"40 Super Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":8,"name":"all"},{"order":4,"name":"fruit"},{"order":8,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"BDIJSlot":[{"gameIdentificationNumber":524,"recovery":"norecovery","gameName":"Bonus Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":147,"name":"all"},{"order":25,"name":"diceSlots"},{"order":147,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"EOWJSlot":[{"gameIdentificationNumber":549,"recovery":"norecovery","gameName":"81 Wins","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":44,"name":"all"},{"order":29,"name":"fruit"},{"order":44,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"ESJSlot":[{"gameIdentificationNumber":825,"recovery":"norecovery","gameName":"Egypt Sky","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":42,"name":"all"},{"order":4,"name":"extraline"},{"order":42,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"AMJSlot":[{"gameIdentificationNumber":851,"recovery":"norecovery","gameName":"Action Money","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":101,"name":"all"},{"order":22,"name":"multiline"},{"order":101,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FJFJSlot":[{"gameIdentificationNumber":557,"recovery":"norecovery","gameName":"5 Juggle Fruits","featured":true,"mlmJackpot":true,"totalBet":0,"groups":[{"order":4,"name":"all"},{"order":4,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"XJJSlot":[{"gameIdentificationNumber":857,"recovery":"norecovery","gameName":"Extra Joker","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":132,"name":"all"},{"order":10,"name":"diceSlots"},{"order":132,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"LRJSlot":[{"gameIdentificationNumber":510,"recovery":"norecovery","gameName":"Legendary Rome","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":104,"name":"all"},{"order":24,"name":"multiline"},{"order":104,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"ASJSlot":[{"gameIdentificationNumber":522,"recovery":"norecovery","gameName":"Amazons\u0027 Story","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":134,"name":"all"},{"order":12,"name":"diceSlots"},{"order":134,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"DRJSlot":[{"gameIdentificationNumber":813,"recovery":"norecovery","gameName":"Dragon Reels","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":68,"name":"all"},{"order":8,"name":"multiline"},{"order":68,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"GDJSlot":[{"gameIdentificationNumber":862,"recovery":"norecovery","gameName":"Gold Dust","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":111,"name":"all"},{"order":28,"name":"multiline"},{"order":111,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FGSJSlot":[{"gameIdentificationNumber":553,"recovery":"norecovery","gameName":"5 Great Star","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":33,"name":"all"},{"order":22,"name":"fruit"},{"order":33,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FKJSlot":[{"gameIdentificationNumber":811,"recovery":"norecovery","gameName":"Fruits Kingdom","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":74,"name":"all"},{"order":14,"name":"classic"},{"order":74,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"RGJSlot":[{"gameIdentificationNumber":883,"recovery":"norecovery","gameName":"Royal Gardens","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":143,"name":"all"},{"order":21,"name":"diceSlots"},{"order":143,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"BHTJSlot":[{"gameIdentificationNumber":814,"recovery":"norecovery","gameName":"Blue Heart","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":31,"name":"all"},{"order":2,"name":"extraline"},{"order":31,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"THSDJSlot":[{"gameIdentificationNumber":535,"recovery":"norecovery","gameName":"30 Spicy Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":131,"name":"all"},{"order":9,"name":"diceSlots"},{"order":131,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"MSJSlot":[{"gameIdentificationNumber":898,"recovery":"norecovery","gameName":"Mayan Spirit","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":64,"name":"all"},{"order":9,"name":"extraline"},{"order":64,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"MDARJSlot":[{"gameIdentificationNumber":875,"recovery":"norecovery","gameName":"More Dice \u0026 Roll","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":41,"name":"all"},{"order":28,"name":"fruit"},{"order":41,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"UJKeno":[{"gameIdentificationNumber":701,"recovery":"norecovery","gameName":"Keno Universe","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":3,"name":"all"},{"order":1,"name":"keno"},{"order":3,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"RTSJSlot":[{"gameIdentificationNumber":889,"recovery":"norecovery","gameName":"Retro Style","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":108,"name":"all"},{"order":27,"name":"classic"},{"order":108,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TJRJSlot":[{"gameIdentificationNumber":554,"recovery":"norecovery","gameName":"20 Joker Reels","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":40,"name":"all"},{"order":27,"name":"fruit"},{"order":40,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"RBDJSlot":[{"gameIdentificationNumber":870,"recovery":"norecovery","gameName":"Rainbow Dice","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":146,"name":"all"},{"order":24,"name":"diceSlots"},{"order":146,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"MFJSlot":[{"gameIdentificationNumber":830,"recovery":"norecovery","gameName":"Majestic Forest","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":60,"name":"all"},{"order":10,"name":"classic"},{"order":60,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"LHJSlot":[{"gameIdentificationNumber":849,"recovery":"norecovery","gameName":"Lucky Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":36,"name":"all"},{"order":24,"name":"fruit"},{"order":36,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"TBHJSlot":[{"gameIdentificationNumber":530,"recovery":"norecovery","gameName":"20 Burning Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":13,"name":"all"},{"order":9,"name":"fruit"},{"order":13,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"HNCJSlot":[{"gameIdentificationNumber":866,"recovery":"norecovery","gameName":"Hot \u0026 Cash","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":63,"name":"all"},{"order":34,"name":"fruit"},{"order":63,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"HWJSlot":[{"gameIdentificationNumber":833,"recovery":"norecovery","gameName":"Halloween","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":96,"name":"all"},{"order":19,"name":"multiline"},{"order":96,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"FLKJSlot":[{"gameIdentificationNumber":546,"recovery":"norecovery","gameName":"40 Lucky King","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":32,"name":"all"},{"order":21,"name":"fruit"},{"order":32,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"JAJSlot":[{"gameIdentificationNumber":503,"recovery":"norecovery","gameName":"Jungle Adventure","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":118,"name":"all"},{"order":29,"name":"classic"},{"order":118,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}],"DHJSlot":[{"gameIdentificationNumber":888,"recovery":"norecovery","gameName":"Dragon Hot","featured":false,"mlmJackpot":true,"totalBet":0,"groups":[{"order":93,"name":"all"},{"order":35,"name":"fruit"},{"order":93,"name":"myGames"}],"jackpotGameType":"MLMJackpot"}]},"sessionKey":"41be9e65e0ff03a65e8c93576bf61130","msg":"success","messageId":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['messageId'] . '","qName":"app.services.messages.response.LoginResponse","command":"login","eventTimestamp":' . time() . '}';
                    break;
                case 'settings':
                    $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932 = $slotSettings->Bet;
                    foreach( $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932 as &$b ) 
                    {
                        $b = $b / $slotSettings->CurrentDenom;
                    }
                    $_obf_0D0C2105130819393F29112D311A15170F3C2913160B01 = [];
                    $_obf_0D0C2105130819393F29112D311A15170F3C2913160B01[] = '[' . ($slotSettings->CurrentDenomGame * 100) . ',70,3000000]';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '{"complex":{"paytableCoef":{"0":{"coef":[5,20,100],"multiplier":1},"1":{"coef":[5,20,100],"multiplier":1},"2":{"coef":[5,20,100],"multiplier":1},"3":{"coef":[10,50,200],"multiplier":1},"4":{"coef":[10,50,200],"multiplier":1},"5":{"coef":[10,50,200],"multiplier":1},"6":{"coef":[2,20,100,1000],"multiplier":1},"7":{"coef":[2,20,100,1000],"multiplier":1},"8":{"coef":[10,100,2000,10000],"multiplier":1},"9":{"coef":[2,15,16,100,600,1000],"multiplier":1},"10":{"coef":[0,0,0],"multiplier":1}},"scatterCoef":{"3":{"withoutBonus":[2,3,4,5,8,10],"bonus":[15]},"4":{"withoutBonus":[16,20,25,30],"bonus":[50,100,80,60]},"5":{"withoutBonus":[700,800,600,900],"bonus":[1000]}},"bets":[' . implode(',', $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932) . '],"jackpotMinBet":1,"jackpot":true,"mainFakeReels":[[6,4,6,1,1,0,8,0,3,3,4,6,4,9,8,2,1,5,5,7],[6,2,0,0,6,0,3,8,3,1,1,7,4,4,8,2,2,5,8,5],[3,6,9,2,2,8,3,3,7,4,4,10,6,0,0,5,8,5,1,1],[6,5,5,3,3,8,7,5,6,9,4,4,1,8,1,2,2,0,0,0],[6,1,5,7,5,8,0,0,3,6,3,4,8,2,6,2,3,9,1,1]],"jackpotMaxBet":100000,"denominations":[' . implode(',', $_obf_0D0C2105130819393F29112D311A15170F3C2913160B01) . ']},"gameIdentificationNumber":' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gameIdentificationNumber'] . ',"gameNumber":-1,"sessionKey":"41be9e65e0ff03a65e8c93576bf61130","msg":"success","messageId":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['messageId'] . '","qName":"app.services.messages.response.GameResponse","command":"settings","eventTimestamp":' . time() . '}';
                    break;
                case 'subscribe':
                    $_obf_0D0B38261D090527042502043006023133212F0F040922 = [
                        78, 
                        30, 
                        46, 
                        62, 
                        46, 
                        30
                    ];
                    shuffle($_obf_0D0B38261D090527042502043006023133212F0F040922);
                    $slotSettings->SetGameData('ActionMoneyEGTCards', $_obf_0D0B38261D090527042502043006023133212F0F040922);
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData('ActionMoneyEGTBonusWin', 0);
                    $slotSettings->SetGameData('ActionMoneyEGTFreeGames', 0);
                    $slotSettings->SetGameData('ActionMoneyEGTCurrentFreeGame', 0);
                    $slotSettings->SetGameData('ActionMoneyEGTTotalWin', 0);
                    $slotSettings->SetGameData('ActionMoneyEGTFreeBalance', 0);
                    $slotSettings->SetGameData('ActionMoneyEGTMultiplier', 1);
                    $slotSettings->SetGameData('ActionMoneyEGTFreeWild', -1);
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeWild', $lastEvent->serverResponse->FreeWild);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Multiplier', $lastEvent->serverResponse->Multiplier);
                        $reels = $lastEvent->serverResponse->reelsSymbols;
                        $_obf_0D3E331C040E390B031B03100422040311293E023E0322 = '' . rand(0, 6) . ',' . $reels->reel1[0] . ',' . $reels->reel1[1] . ',' . $reels->reel1[2] . ',' . rand(0, 6);
                        $_obf_0D3E331C040E390B031B03100422040311293E023E0322 .= (',' . rand(0, 6) . ',' . $reels->reel2[0] . ',' . $reels->reel2[1] . ',' . $reels->reel2[2] . ',' . rand(0, 6));
                        $_obf_0D3E331C040E390B031B03100422040311293E023E0322 .= (',' . rand(0, 6) . ',' . $reels->reel3[0] . ',' . $reels->reel3[1] . ',' . $reels->reel3[2] . ',' . rand(0, 6));
                        $_obf_0D3E331C040E390B031B03100422040311293E023E0322 .= (',' . rand(0, 6) . ',' . $reels->reel4[0] . ',' . $reels->reel4[1] . ',' . $reels->reel4[2] . ',' . rand(0, 6));
                        $_obf_0D3E331C040E390B031B03100422040311293E023E0322 .= (',' . rand(0, 6) . ',' . $reels->reel5[0] . ',' . $reels->reel5[1] . ',' . $reels->reel5[2] . ',' . rand(0, 6));
                        $lines = $lastEvent->serverResponse->slotLines;
                        $bet = $lastEvent->serverResponse->slotBet * 100;
                        $_obf_0D33051C1539292C322D230A2B230A1F321305011D0D11 = 1;
                        if( $slotSettings->GetGameData('ActionMoneyEGTCurrentFreeGame') < $slotSettings->GetGameData('ActionMoneyEGTFreeGames') && $slotSettings->GetGameData('ActionMoneyEGTFreeGames') > 0 ) 
                        {
                            $_obf_0D33051C1539292C322D230A2B230A1F321305011D0D11 = 2;
                        }
                    }
                    else
                    {
                        $_obf_0D33051C1539292C322D230A2B230A1F321305011D0D11 = 1;
                        $_obf_0D3E331C040E390B031B03100422040311293E023E0322 = '' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . '';
                        $lines = 10;
                        $bet = $slotSettings->Bet[0] * 100;
                    }
                    $_obf_0D2E12051C291133181A335B143F1718381E2D13193F11 = '';
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                    {
                        $_obf_0D35310F2F170C1C2A045C0E401E332D1C09231B272B01 = 'freespin';
                        $_obf_0D2E12051C291133181A335B143F1718381E2D13193F11 = ',"firstSpin":' . json_encode($lastEvent->serverResponse->firstSpin);
                    }
                    else
                    {
                        $_obf_0D35310F2F170C1C2A045C0E401E332D1C09231B272B01 = 'idle';
                    }
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '{"complex":{"currentState":{"gamblesUsed":0' . $_obf_0D2E12051C291133181A335B143F1718381E2D13193F11 . ',"wildcard":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeWild') . ',"multiplier":' . $slotSettings->GetGameData($slotSettings->slotId . 'Multiplier') . ',"freespinsUsed":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"previousGambles":[],"bet":' . $bet . ',"numberOfLines":' . $lines . ',"denomination":100,"state":"' . $_obf_0D35310F2F170C1C2A045C0E401E332D1C09231B272B01 . '","winAmount":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . ',"reels":[' . $_obf_0D3E331C040E390B031B03100422040311293E023E0322 . '],"lines":[],"scatters":[],"expand":[],"specialExpand":[],"gambles":5,"freespins":' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData('ActionMoneyEGTCurrentFreeGame')) . ',"freespinScatters":[],"jackpot":false},"jackpotState":{"levelI":' . ($slotSettings->slotJackpot[0] * 100) . ',"levelII":' . ($slotSettings->slotJackpot[1] * 100) . ',"levelIII":' . ($slotSettings->slotJackpot[2] * 100) . ',"levelIV":' . ($slotSettings->slotJackpot[3] * 100) . ',"winsLevelI":0,"largestWinLevelI":0,"largestWinDateLevelI":"","largestWinUserLevelI":"player","lastWinLevelI":0,"lastWinDateLevelI":"","lastWinUserLevelI":"","winsLevelII":0,"largestWinLevelII":0,"largestWinDateLevelII":"","largestWinUserLevelII":"","lastWinLevelII":0,"lastWinDateLevelII":"","lastWinUserLevelII":"","winsLevelIII":0,"largestWinLevelIII":0,"largestWinDateLevelIII":"","largestWinUserLevelIII":"player","lastWinLevelIII":0,"lastWinDateLevelIII":"","lastWinUserLevelIII":"","winsLevelIV":0,"largestWinLevelIV":0,"largestWinDateLevelIV":"","largestWinUserLevelIV":"","lastWinLevelIV":0,"lastWinDateLevelIV":"","lastWinUserLevelIV":""}},"gameIdentificationNumber":' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gameIdentificationNumber'] . ',"gameNumber":-1,"sessionKey":"41be9e65e0ff03a65e8c93576bf61130","msg":"success","messageId":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['messageId'] . '","qName":"app.services.messages.response.GameEventResponse","command":"subscribe","eventTimestamp":' . time() . '}';
                    break;
                case 'ping':
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '{"sessionKey":"41be9e65e0ff03a65e8c93576bf61130","msg":"success","messageId":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['messageId'] . '","qName":"app.services.messages.response.BaseResponse","command":"ping","eventTimestamp":' . time() . '}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '{"complex":{"levelI":' . ($slotSettings->slotJackpot[0] * 100) . ',"levelII":' . ($slotSettings->slotJackpot[1] * 100) . ',"levelIII":' . ($slotSettings->slotJackpot[2] * 100) . ',"levelIV":' . ($slotSettings->slotJackpot[3] * 100) . ',"winsLevelI":2,"largestWinLevelI":0,"largestWinDateLevelI":"","largestWinUserLevelI":"","lastWinLevelI":0,"lastWinDateLevelI":"","lastWinUserLevelI":"player","winsLevelII":0,"largestWinLevelII":0,"largestWinDateLevelII":"","largestWinUserLevelII":"","lastWinLevelII":0,"lastWinDateLevelII":"","lastWinUserLevelII":"player","winsLevelIII":0,"largestWinLevelIII":0,"largestWinDateLevelIII":"","largestWinUserLevelIII":"","lastWinLevelIII":0,"lastWinDateLevelIII":"","lastWinUserLevelIII":"","winsLevelIV":0,"largestWinLevelIV":0,"largestWinDateLevelIV":"","largestWinUserLevelIV":"","lastWinLevelIV":0,"lastWinDateLevelIV":"","lastWinUserLevelIV":""},"gameIdentificationNumber":1,"gameNumber":"","msg":"success","messageId":"f73a429df116252e537e403d12bcdb92","qName":"app.services.messages.response.GameEventResponse","command":"event","eventTimestamp":' . time() . '}';
                    break;
                case 'bet':
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
                        1, 
                        1, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[6] = [
                        3, 
                        3, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[7] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[8] = [
                        2, 
                        1, 
                        1, 
                        1, 
                        2
                    ];
                    $linesId[9] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[10] = [
                        3, 
                        2, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[11] = [
                        2, 
                        3, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[12] = [
                        2, 
                        1, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[13] = [
                        1, 
                        2, 
                        1, 
                        2, 
                        1
                    ];
                    $linesId[14] = [
                        3, 
                        2, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[15] = [
                        2, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[16] = [
                        2, 
                        2, 
                        1, 
                        2, 
                        2
                    ];
                    $linesId[17] = [
                        1, 
                        3, 
                        1, 
                        3, 
                        1
                    ];
                    $linesId[18] = [
                        3, 
                        1, 
                        3, 
                        1, 
                        3
                    ];
                    $linesId[19] = [
                        2, 
                        1, 
                        3, 
                        1, 
                        2
                    ];
                    $linesId[20] = [
                        2, 
                        3, 
                        1, 
                        3, 
                        2
                    ];
                    $linesId[21] = [
                        1, 
                        1, 
                        3, 
                        1, 
                        1
                    ];
                    $linesId[22] = [
                        3, 
                        3, 
                        1, 
                        3, 
                        3
                    ];
                    $linesId[23] = [
                        1, 
                        3, 
                        3, 
                        3, 
                        1
                    ];
                    $linesId[24] = [
                        3, 
                        1, 
                        1, 
                        1, 
                        3
                    ];
                    $linesId[25] = [
                        1, 
                        1, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[26] = [
                        3, 
                        3, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[27] = [
                        1, 
                        3, 
                        2, 
                        3, 
                        1
                    ];
                    $linesId[28] = [
                        3, 
                        1, 
                        2, 
                        1, 
                        3
                    ];
                    $linesId[29] = [
                        2, 
                        3, 
                        2, 
                        3, 
                        2
                    ];
                    $lines = $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['lines'];
                    $betline = $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['bet'] / 100;
                    $allbet = $betline * $lines;
                    $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] = 'bet';
                    if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['bonus'] == 'true' ) 
                    {
                        $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] = 'freespin';
                    }
                    if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] != 'freespin' ) 
                    {
                        if( !isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ) 
                        {
                            $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] = 'bet';
                        }
                        $slotSettings->SetBalance(-1 * $allbet, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
                        $_obf_0D2A0526273612293511363C26193E1C130B2719192611 = $allbet / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), $_obf_0D2A0526273612293511363C26193E1C130B2719192611, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
                        $_obf_0D3F08152E011C2E053E0C34233B231F3D212F3C1B2A22 = $slotSettings->UpdateJackpots($allbet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'JackWinID', $_obf_0D3F08152E011C2E053E0C34233B231F3D212F3C1B2A22['isJackId']);
                        $slotSettings->SetGameData('ActionMoneyEGTBonusStart', 0);
                        $slotSettings->SetGameData('ActionMoneyEGTBonusBet', $allbet);
                        $slotSettings->SetGameData('ActionMoneyEGTBonusWin', 0);
                        $slotSettings->SetGameData('ActionMoneyEGTFreeGames', 0);
                        $slotSettings->SetGameData('ActionMoneyEGTCurrentFreeGame', 0);
                        $slotSettings->SetGameData('ActionMoneyEGTTotalWin', 0);
                        $slotSettings->SetGameData('ActionMoneyEGTFreeBalance', sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                        $slotSettings->SetGameData('ActionMoneyEGTMultiplier', 1);
                        $slotSettings->SetGameData('ActionMoneyEGTFreeWild', -1);
                        $bonusMpl = 1;
                    }
                    else
                    {
                        $slotSettings->SetGameData('ActionMoneyEGTCurrentFreeGame', $slotSettings->GetGameData('ActionMoneyEGTCurrentFreeGame') + 1);
                        $bonusMpl = $slotSettings->GetGameData('ActionMoneyEGTMultiplier');
                    }
                    $_obf_0D360F0140113330275B14311E3516150112390A0F1B22 = $slotSettings->GetSpinSettings($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'], $allbet, $lines);
                    $winType = $_obf_0D360F0140113330275B14311E3516150112390A0F1B22[0];
                    $_obf_0D3030072F273706293C133F2F072B113B383322291201 = $_obf_0D360F0140113330275B14311E3516150112390A0F1B22[1];
                    $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    if( isset($_obf_0D3F08152E011C2E053E0C34233B231F3D212F3C1B2A22) && $_obf_0D3F08152E011C2E053E0C34233B231F3D212F3C1B2A22['isJackPay'] ) 
                    {
                        $_obf_0D132A30270211073E401007170115293E100D24231E01 = 1;
                    }
                    else
                    {
                        $_obf_0D132A30270211073E401007170115293E100D24231E01 = 0;
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
                            0
                        ];
                        $wild = ['8'];
                        $scatter = '10';
                        $_obf_0D0F03101B163816052F05402233211D2611162D305B01 = '9';
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
                        if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' ) 
                        {
                            $wild = [
                                '8', 
                                $slotSettings->GetGameData($slotSettings->slotId . 'FreeWild') . ''
                            ];
                        }
                        for( $k = 0; $k < $lines; $k++ ) 
                        {
                            $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32 = '';
                            for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                            {
                                $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 = (string)$slotSettings->SymbolGame[$j];
                                if( $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 == $scatter || !isset($slotSettings->Paytable['SYM_' . $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11]) ) 
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
                                    if( ($s[0] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[1], $wild)) ) 
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
                                        $_obf_0D365B172533170712222423300A1B092C161521071B32 = $slotSettings->Paytable['SYM_' . $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11][2] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D365B172533170712222423300A1B092C161521071B32 ) 
                                        {
                                            $cWins[$k] = $_obf_0D365B172533170712222423300A1B092C161521071B32;
                                            $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32 = '{"line":' . $k . ',"winAmount":' . ($cWins[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . '],"freespins":0,"card":' . $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 . '}';
                                        }
                                    }
                                    if( ($s[0] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[2], $wild)) ) 
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
                                        $_obf_0D365B172533170712222423300A1B092C161521071B32 = $slotSettings->Paytable['SYM_' . $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11][3] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D365B172533170712222423300A1B092C161521071B32 ) 
                                        {
                                            $cWins[$k] = $_obf_0D365B172533170712222423300A1B092C161521071B32;
                                            $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32 = '{"line":' . $k . ',"winAmount":' . ($cWins[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . ',2,' . ($linesId[$k][2] - 1) . '],"freespins":0,"card":' . $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 . '}';
                                        }
                                    }
                                    if( ($s[0] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[3], $wild)) ) 
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
                                        $_obf_0D365B172533170712222423300A1B092C161521071B32 = $slotSettings->Paytable['SYM_' . $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11][4] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D365B172533170712222423300A1B092C161521071B32 ) 
                                        {
                                            $cWins[$k] = $_obf_0D365B172533170712222423300A1B092C161521071B32;
                                            $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32 = '{"line":' . $k . ',"winAmount":' . ($cWins[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . ',2,' . ($linesId[$k][2] - 1) . ',3,' . ($linesId[$k][3] - 1) . '],"freespins":0,"card":' . $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 . '}';
                                        }
                                    }
                                    if( ($s[0] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[3], $wild)) && ($s[4] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[4], $wild)) ) 
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
                                        $_obf_0D365B172533170712222423300A1B092C161521071B32 = $slotSettings->Paytable['SYM_' . $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11][5] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D365B172533170712222423300A1B092C161521071B32 ) 
                                        {
                                            $cWins[$k] = $_obf_0D365B172533170712222423300A1B092C161521071B32;
                                            $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32 = '{"line":' . $k . ',"winAmount":' . ($cWins[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . ',2,' . ($linesId[$k][2] - 1) . ',3,' . ($linesId[$k][3] - 1) . ',4,' . ($linesId[$k][4] - 1) . '],"freespins":0,"card":' . $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 . '}';
                                        }
                                    }
                                }
                            }
                            if( $cWins[$k] > 0 && $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32 != '' ) 
                            {
                                array_push($lineWins, $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32);
                                $totalWin += $cWins[$k];
                            }
                        }
                        $scattersWin = 0;
                        $_obf_0D5C282514190E21171E5C2A19072A24022B34142A0301 = 0;
                        $scattersStr = '';
                        $_obf_0D5B03042F160B2E2A1A06380414383D1F24343B1F1C32 = '';
                        $scattersCount = 0;
                        $_obf_0D4032063326312E14292A362E1B3E0B192115063F2322 = 0;
                        $_obf_0D2A350433382703193E3D095B5C3B160A253E01191622 = [];
                        $_obf_0D32273E141110031E131B260F03283514073404193222 = [];
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $_obf_0D31403C0837332A1A1711312A3415151610280F122122 = 0; $_obf_0D31403C0837332A1A1711312A3415151610280F122122 <= 2; $_obf_0D31403C0837332A1A1711312A3415151610280F122122++ ) 
                            {
                                if( $reels['reel' . $r][$_obf_0D31403C0837332A1A1711312A3415151610280F122122] == $scatter ) 
                                {
                                    $scattersCount++;
                                    $_obf_0D2A350433382703193E3D095B5C3B160A253E01191622[] = '' . ($r - 1) . ',' . $_obf_0D31403C0837332A1A1711312A3415151610280F122122 . '';
                                }
                                if( $reels['reel' . $r][$_obf_0D31403C0837332A1A1711312A3415151610280F122122] == $_obf_0D0F03101B163816052F05402233211D2611162D305B01 ) 
                                {
                                    $_obf_0D4032063326312E14292A362E1B3E0B192115063F2322++;
                                    $_obf_0D32273E141110031E131B260F03283514073404193222[] = '' . ($r - 1) . ',' . $_obf_0D31403C0837332A1A1711312A3415151610280F122122 . '';
                                }
                            }
                        }
                        $scattersWin = $slotSettings->Paytable['SYM_' . $scatter][$scattersCount] * $allbet;
                        $_obf_0D5C282514190E21171E5C2A19072A24022B34142A0301 = $slotSettings->Paytable['SYM_' . $_obf_0D0F03101B163816052F05402233211D2611162D305B01][$_obf_0D4032063326312E14292A362E1B3E0B192115063F2322] * $allbet;
                        $_obf_0D341E1906402E012D2302041A0B29343137123F023201 = 0;
                        if( $scattersCount >= 3 ) 
                        {
                            $_obf_0D341E1906402E012D2302041A0B29343137123F023201 = $slotSettings->slotFreeCount;
                            $scattersStr = '{"scatterName":' . $scatter . ',"cells":[' . implode(',', $_obf_0D2A350433382703193E3D095B5C3B160A253E01191622) . '],"winAmount":' . ($scattersWin * 100) . ',"freespins":' . $_obf_0D341E1906402E012D2302041A0B29343137123F023201 . '}';
                        }
                        if( $_obf_0D4032063326312E14292A362E1B3E0B192115063F2322 >= 3 ) 
                        {
                            $_obf_0D341E1906402E012D2302041A0B29343137123F023201 = 0;
                            $scattersStr = '{"scatterName":' . $_obf_0D0F03101B163816052F05402233211D2611162D305B01 . ',"cells":[' . implode(',', $_obf_0D32273E141110031E131B260F03283514073404193222) . '],"winAmount":' . ($_obf_0D5C282514190E21171E5C2A19072A24022B34142A0301 * 100) . ',"freespins":' . $_obf_0D341E1906402E012D2302041A0B29343137123F023201 . '}';
                        }
                        $totalWin += $scattersWin;
                        $totalWin += $_obf_0D5C282514190E21171E5C2A19072A24022B34142A0301;
                        if( $i > 1000 ) 
                        {
                            $winType = 'none';
                        }
                        if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($allbet * rand(2, 5)) ) 
                        {
                        }
                        else if( !$slotSettings->increaseRTP && $winType == 'win' && $allbet < $totalWin ) 
                        {
                        }
                        else
                        {
                            if( $i > 1500 ) 
                            {
                                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                                exit( $response );
                            }
                            if( $_obf_0D4032063326312E14292A362E1B3E0B192115063F2322 >= 3 && $winType == 'bonus' && $_obf_0D3030072F273706293C133F2F072B113B383322291201 < ($totalWin + (2 * $allbet)) ) 
                            {
                            }
                            else if( ($scattersCount >= 3 || $_obf_0D4032063326312E14292A362E1B3E0B192115063F2322 >= 3) && $winType != 'bonus' ) 
                            {
                            }
                            else if( $totalWin <= $_obf_0D3030072F273706293C133F2F072B113B383322291201 && $winType == 'bonus' ) 
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
                            else if( $totalWin > 0 && $totalWin <= $_obf_0D3030072F273706293C133F2F072B113B383322291201 && $winType == 'win' ) 
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
                            else if( $totalWin == 0 && $winType == 'none' ) 
                            {
                                break;
                            }
                        }
                    }
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), -1 * $totalWin);
                        $slotSettings->SetBalance($totalWin);
                    }
                    $_obf_0D0C361D2E35362209025C2317232809271D34270D3232 = $totalWin;
                    if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' ) 
                    {
                        $slotSettings->SetGameData('ActionMoneyEGTBonusWin', $slotSettings->GetGameData('ActionMoneyEGTBonusWin') + $totalWin);
                        $slotSettings->SetGameData('ActionMoneyEGTTotalWin', $slotSettings->GetGameData('ActionMoneyEGTTotalWin') + $totalWin);
                        $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = $slotSettings->GetGameData('ActionMoneyEGTFreeBalance');
                    }
                    else
                    {
                        $slotSettings->SetGameData('ActionMoneyEGTTotalWin', $totalWin);
                    }
                    $fs = 0;
                    if( $scattersCount >= 3 || $_obf_0D4032063326312E14292A362E1B3E0B192115063F2322 >= 3 ) 
                    {
                        if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' ) 
                        {
                            $slotSettings->SetGameData('ActionMoneyEGTFreeGames', $slotSettings->GetGameData('ActionMoneyEGTFreeGames') + 1);
                        }
                        else
                        {
                            $slotSettings->SetGameData('ActionMoneyEGTFreeStartWin', $totalWin);
                            $slotSettings->SetGameData('ActionMoneyEGTBonusWin', $totalWin);
                            $slotSettings->SetGameData('ActionMoneyEGTFreeGames', rand(5, 12));
                            $slotSettings->SetGameData('ActionMoneyEGTMultiplier', rand(1, 5));
                            $slotSettings->SetGameData('ActionMoneyEGTFreeWild', rand(5, 7));
                        }
                        $fs = $slotSettings->GetGameData('ActionMoneyEGTFreeGames');
                    }
                    $_obf_0D3E331C040E390B031B03100422040311293E023E0322 = '' . rand(0, 6) . ',' . $reels['reel1'][0] . ',' . $reels['reel1'][1] . ',' . $reels['reel1'][2] . ',' . rand(0, 6);
                    $_obf_0D3E331C040E390B031B03100422040311293E023E0322 .= (',' . rand(0, 6) . ',' . $reels['reel2'][0] . ',' . $reels['reel2'][1] . ',' . $reels['reel2'][2] . ',' . rand(0, 6));
                    $_obf_0D3E331C040E390B031B03100422040311293E023E0322 .= (',' . rand(0, 6) . ',' . $reels['reel3'][0] . ',' . $reels['reel3'][1] . ',' . $reels['reel3'][2] . ',' . rand(0, 6));
                    $_obf_0D3E331C040E390B031B03100422040311293E023E0322 .= (',' . rand(0, 6) . ',' . $reels['reel4'][0] . ',' . $reels['reel4'][1] . ',' . $reels['reel4'][2] . ',' . rand(0, 6));
                    $_obf_0D3E331C040E390B031B03100422040311293E023E0322 .= (',' . rand(0, 6) . ',' . $reels['reel5'][0] . ',' . $reels['reel5'][1] . ',' . $reels['reel5'][2] . ',' . rand(0, 6));
                    $slotSettings->SetGameData($slotSettings->slotId . 'FirstSpin', ',"firstSpin":{"expand":[],"reels":[' . $_obf_0D3E331C040E390B031B03100422040311293E023E0322 . '],"lines":[],"scatters":[' . $scattersStr . ']}');
                    $_obf_0D5B5C2E0D1C3D1F232F3E051D3225380127293C2A2432 = implode(',', $lineWins);
                    $_obf_0D273522403840350F0A36072E150A0524143F382C3B32 = '' . json_encode($reels) . '';
                    $_obf_0D28393910101E062539311B3F371C121912162B061E32 = '' . json_encode($slotSettings->Jackpots) . '';
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":{"slotLines":' . $lines . '' . $slotSettings->GetGameData($slotSettings->slotId . 'FirstSpin') . ',"Multiplier":' . $slotSettings->GetGameData('ActionMoneyEGTMultiplier') . ',"FreeWild":' . $slotSettings->GetGameData('ActionMoneyEGTFreeWild') . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData('ActionMoneyEGTFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('ActionMoneyEGTCurrentFreeGame') . ',"Balance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"afterBalance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"bonusWin":' . $slotSettings->GetGameData('ActionMoneyEGTBonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D5B5C2E0D1C3D1F232F3E051D3225380127293C2A2432 . '],"Jackpots":' . $_obf_0D28393910101E062539311B3F371C121912162B061E32 . ',"reelsSymbols":' . $_obf_0D273522403840350F0A36072E150A0524143F382C3B32 . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D0C361D2E35362209025C2317232809271D34270D3232, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
                    $_obf_0D5C11261E1F38095C0E0E235C4034360E2A030D101632 = '';
                    $slotSettings->SetGameData('ActionMoneyEGTGambleStep', 5);
                    $_obf_0D0B38261D090527042502043006023133212F0F040922 = $slotSettings->GetGameData('ActionMoneyEGTCards');
                    if( $_obf_0D132A30270211073E401007170115293E100D24231E01 == 1 ) 
                    {
                        $state = 'jackpot';
                        $isJack = 'true';
                        $slotSettings->SetGameData('ActionMoneyEGTJackSteps', [
                            0, 
                            0, 
                            0, 
                            0
                        ]);
                    }
                    else
                    {
                        $isJack = 'false';
                        if( $totalWin > 0 ) 
                        {
                            $state = 'gamble';
                        }
                        else
                        {
                            $state = 'idle';
                        }
                    }
                    if( $winType == 'bonus' ) 
                    {
                        $state = 'freespin';
                    }
                    if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' ) 
                    {
                        $totalWin = $slotSettings->GetGameData('ActionMoneyEGTBonusWin');
                        $state = 'freespin';
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData('ActionMoneyEGTBonusWin') > 0 ) 
                        {
                            $state = 'gamble';
                        }
                    }
                    $_obf_0D1224210F3F5B0819110834131432040D0E062B260211 = '';
                    if( $_obf_0D4032063326312E14292A362E1B3E0B192115063F2322 >= 3 ) 
                    {
                        $state = 'bonuschoice';
                        $slotSettings->SetGameData('ActionMoneyEGTTotalWin', $totalWin);
                        $slotSettings->SetGameData('ActionMoneyEGTBonusStart', 1);
                        $slotSettings->SetGameData('ActionMoneyEGTBonusCnt', $_obf_0D4032063326312E14292A362E1B3E0B192115063F2322);
                        $_obf_0D1224210F3F5B0819110834131432040D0E062B260211 = ',"bonuschoiceObject": {"bonusScatterIndex": 9}';
                    }
                    if( $scattersCount >= 3 ) 
                    {
                        $state = 'multiplierchoice';
                        $slotSettings->SetGameData('ActionMoneyEGTBonusStart', 1);
                        $_obf_0D1224210F3F5B0819110834131432040D0E062B260211 = ',"choices": 1,"freespinScatters":[10]';
                        if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' ) 
                        {
                            $state = 'freespin';
                        }
                        else
                        {
                            $state = 'multiplierchoice';
                        }
                    }
                    if( !isset($_obf_0D341E1906402E012D2302041A0B29343137123F023201) ) 
                    {
                        $fs = 0;
                    }
                    else if( $_obf_0D341E1906402E012D2302041A0B29343137123F023201 > 0 ) 
                    {
                        $fs = $_obf_0D341E1906402E012D2302041A0B29343137123F023201;
                    }
                    else
                    {
                        $fs = 0;
                    }
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '{"complex":{"gambles":5,"reels":[' . $_obf_0D3E331C040E390B031B03100422040311293E023E0322 . '],"lines":[' . $_obf_0D5B5C2E0D1C3D1F232F3E051D3225380127293C2A2432 . '],"scatters":[' . $scattersStr . '],"freespinScatters":[' . $scatter . '],"choices": 0,"expand":[]' . $_obf_0D1224210F3F5B0819110834131432040D0E062B260211 . ',"multiplier":' . $slotSettings->GetGameData('ActionMoneyEGTMultiplier') . ',"wildcard":' . $slotSettings->GetGameData('ActionMoneyEGTFreeWild') . ',"specialExpand":[],"gambles":5,"freespins":' . $fs . ',"jackpot":' . $isJack . ',"gameCommand":"bet"},"state":"' . $state . '","winAmount":' . ($totalWin * 100) . ',"gameIdentificationNumber":' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gameIdentificationNumber'] . ',"gameNumber":"","balance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"sessionKey":"41be9e65e0ff03a65e8c93576bf61130","msg":"success","messageId":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['messageId'] . '","qName":"app.services.messages.response.GameEventResponse","command":"bet","eventTimestamp":' . time() . '}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '{"complex":{"levelI":' . ($slotSettings->slotJackpot[0] * 100) . ',"levelII":' . ($slotSettings->slotJackpot[1] * 100) . ',"levelIII":' . ($slotSettings->slotJackpot[2] * 100) . ',"levelIV":' . ($slotSettings->slotJackpot[3] * 100) . ',"winsLevelI":2,"largestWinLevelI":0,"largestWinDateLevelI":"","largestWinUserLevelI":"","lastWinLevelI":0,"lastWinDateLevelI":"","lastWinUserLevelI":"player","winsLevelII":0,"largestWinLevelII":0,"largestWinDateLevelII":"","largestWinUserLevelII":"","lastWinLevelII":0,"lastWinDateLevelII":"","lastWinUserLevelII":"player","winsLevelIII":0,"largestWinLevelIII":0,"largestWinDateLevelIII":"","largestWinUserLevelIII":"","lastWinLevelIII":0,"lastWinDateLevelIII":"","lastWinUserLevelIII":"","winsLevelIV":0,"largestWinLevelIV":0,"largestWinDateLevelIV":"","largestWinUserLevelIV":"","lastWinLevelIV":0,"lastWinDateLevelIV":"","lastWinUserLevelIV":""},"gameIdentificationNumber":' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gameIdentificationNumber'] . ',"gameNumber":"","msg":"success","messageId":"f73a429df116252e537e403d12bcdb92","qName":"app.services.messages.response.GameEventResponse","command":"event","eventTimestamp":' . time() . '}';
                    break;
                case 'collect':
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '{"complex":{"gameCommand":"collect"},"state":"idle","winAmount":' . ($slotSettings->GetGameData('ActionMoneyEGTTotalWin') * 100) . ',"gameIdentificationNumber":' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gameIdentificationNumber'] . ',"gameNumber":"","balance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"sessionKey":"41be9e65e0ff03a65e8c93576bf61130","msg":"success","messageId":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['messageId'] . '","qName":"app.services.messages.response.GameEventResponse","command":"bet","eventTimestamp":' . time() . '}';
                    $slotSettings->SetGameData('ActionMoneyEGTTotalWin', 0);
                    break;
                case 'jackpot':
                    $_obf_0D331603075C262F240C055B033811280F370B2C071D01 = $slotSettings->GetGameData('ActionMoneyEGTJackSteps');
                    $_obf_0D1209110D1C02405B0D2E233115272A2E091F04213C01 = $slotSettings->GetGameData($slotSettings->slotId . 'JackWinID');
                    if( $_obf_0D331603075C262F240C055B033811280F370B2C071D01[0] >= 3 || $_obf_0D331603075C262F240C055B033811280F370B2C071D01[1] >= 3 || $_obf_0D331603075C262F240C055B033811280F370B2C071D01[2] >= 3 || $_obf_0D331603075C262F240C055B033811280F370B2C071D01[3] >= 3 || !$slotSettings->HasGameData('ActionMoneyEGTJackSteps') ) 
                    {
                        exit();
                    }
                    $_obf_0D2B3E3E3639015B183306132215193F083C0B30020F01 = 0;
                    $_obf_0D3F08152E011C2E053E0C34233B231F3D212F3C1B2A22 = 'jackpot';
                    $cardsArr = [
                        '12', 
                        '24', 
                        '36', 
                        '48'
                    ];
                    $_obf_0D11320C0D2404193303071F0D1F011915251140013D22 = rand(0, 3);
                    if( $_obf_0D331603075C262F240C055B033811280F370B2C071D01[$_obf_0D11320C0D2404193303071F0D1F011915251140013D22] == 2 ) 
                    {
                        $_obf_0D11320C0D2404193303071F0D1F011915251140013D22 = $_obf_0D1209110D1C02405B0D2E233115272A2E091F04213C01;
                    }
                    $_obf_0D171437020D2806063E24263E2C3D071F180F21373E01 = $cardsArr[$_obf_0D11320C0D2404193303071F0D1F011915251140013D22];
                    $_obf_0D331603075C262F240C055B033811280F370B2C071D01[$_obf_0D11320C0D2404193303071F0D1F011915251140013D22]++;
                    if( $_obf_0D331603075C262F240C055B033811280F370B2C071D01[$_obf_0D11320C0D2404193303071F0D1F011915251140013D22] == 3 ) 
                    {
                        $_obf_0D2B3E3E3639015B183306132215193F083C0B30020F01 = $slotSettings->slotJackpot[$_obf_0D11320C0D2404193303071F0D1F011915251140013D22] * 100;
                        $_obf_0D3F08152E011C2E053E0C34233B231F3D212F3C1B2A22 = 'idle';
                        $slotSettings->SetBalance($slotSettings->slotJackpot[$_obf_0D11320C0D2404193303071F0D1F011915251140013D22]);
                        $slotSettings->ClearJackpot($_obf_0D11320C0D2404193303071F0D1F011915251140013D22);
                        $response = '{"responseEvent":"jackpot","responseType":"jackpot","serverResponse":{}}';
                        $slotSettings->SaveLogReport($response, 0, 0, $slotSettings->slotJackpot[$_obf_0D11320C0D2404193303071F0D1F011915251140013D22], 'JPG');
                        $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                        $slotSettings->slotJackpot[$_obf_0D11320C0D2404193303071F0D1F011915251140013D22] = 0;
                    }
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '{"sessionKey": "41be9e65e0ff03a65e8c93576bf61130", "qName": "app.services.messages.response.GameEventResponse", "winAmount":' . $_obf_0D2B3E3E3639015B183306132215193F083C0B30020F01 . ', "eventTimestamp": ' . time() . ', "gameNumber":"", "state": "' . $_obf_0D3F08152E011C2E053E0C34233B231F3D212F3C1B2A22 . '", "complex": {"gameCommand": "jackpot","pos":' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['pos'] . ',"winLevel":' . $_obf_0D11320C0D2404193303071F0D1F011915251140013D22 . ',"card":' . $_obf_0D171437020D2806063E24263E2C3D071F180F21373E01 . '}, "command": "bet", "messageId": "' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['messageId'] . '", "msg": "success", "balance": ' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ', "gameIdentificationNumber":' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gameIdentificationNumber'] . '}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '{"complex":{"levelI":' . ($slotSettings->slotJackpot[0] * 100) . ',"levelII":' . ($slotSettings->slotJackpot[1] * 100) . ',"levelIII":' . ($slotSettings->slotJackpot[2] * 100) . ',"levelIV":' . ($slotSettings->slotJackpot[3] * 100) . ',"screenName":"","winLevel":-1,"winAmount":0,"winsLevelI":0,"largestWinLevelI":0,"largestWinDateLevelI":"","largestWinUserLevelI":"","lastWinLevelI":0,"lastWinDateLevelI":"","lastWinUserLevelI":"","winsLevelII":0,"largestWinLevelII":0,"largestWinDateLevelII":"","largestWinUserLevelII":"","lastWinLevelII":0,"lastWinDateLevelII":"","lastWinUserLevelII":"","winsLevelIII":0,"largestWinLevelIII":0,"largestWinDateLevelIII":"","largestWinUserLevelIII":"","lastWinLevelIII":0,"lastWinDateLevelIII":"","lastWinUserLevelIII":"","winsLevelIV":0,"largestWinLevelIV":0,"largestWinDateLevelIV":"","largestWinUserLevelIV":"","lastWinLevelIV":0,"lastWinDateLevelIV":"","lastWinUserLevelIV":""},"gameIdentificationNumber":' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gameIdentificationNumber'] . ',"gameNumber":"","msg":"success","messageId":"","qName":"app.services.messages.response.GameEventResponse","command":"event","eventTimestamp":' . time() . '}';
                    $slotSettings->SetGameData('ActionMoneyEGTJackSteps', $_obf_0D331603075C262F240C055B033811280F370B2C071D01);
                    break;
                case 'gamble':
                    $Balance = $slotSettings->GetBalance();
                    $_obf_0D2F3C2804395C38101A1C05232C1040362D390D1D3301 = rand(1, $slotSettings->GetGambleSettings());
                    $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = '';
                    $totalWin = $slotSettings->GetGameData('ActionMoneyEGTTotalWin');
                    $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = 0;
                    $_obf_0D31140A120E1B3D282A06280B27103B250935092B1F01 = $totalWin;
                    $slotSettings->SetGameData('ActionMoneyEGTGambleStep', $slotSettings->GetGameData('ActionMoneyEGTGambleStep') - 1);
                    if( $slotSettings->GetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : '')) < ($totalWin * 2) ) 
                    {
                        $_obf_0D2F3C2804395C38101A1C05232C1040362D390D1D3301 = 0;
                    }
                    $_obf_0D0E230104372A0E3E2C223B2303022E2F2B2B2D0E0901 = 'gamble2lost';
                    if( $_obf_0D2F3C2804395C38101A1C05232C1040362D390D1D3301 == 1 ) 
                    {
                        $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 = 'gamble';
                        $_obf_0D0E230104372A0E3E2C223B2303022E2F2B2B2D0E0901 = 'gamble2win1';
                        $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = $totalWin;
                        $totalWin = $totalWin * 2;
                        if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['color'] == '1' ) 
                        {
                            $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01 = [
                                '0', 
                                '3'
                            ];
                            $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01[rand(0, 1)];
                        }
                        else
                        {
                            $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01 = [
                                '2', 
                                '1'
                            ];
                            $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01[rand(0, 1)];
                        }
                    }
                    else
                    {
                        $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 = 'idle';
                        $_obf_0D0E230104372A0E3E2C223B2303022E2F2B2B2D0E0901 = 'gamble2lost';
                        $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = -1 * $totalWin;
                        $totalWin = 0;
                        $slotSettings->SetGameData('ActionMoneyEGTGambleStep', 0);
                        if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']['color'] == '1' ) 
                        {
                            $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01 = [
                                '1', 
                                '2'
                            ];
                            $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01[rand(0, 1)];
                        }
                        else
                        {
                            $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01 = [
                                '3', 
                                '0'
                            ];
                            $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01[rand(0, 1)];
                        }
                    }
                    $slotSettings->SetGameData('ActionMoneyEGTTotalWin', $totalWin);
                    $slotSettings->SetBalance($_obf_0D2D1D15122B0303242922110A351334341A371C0C3101);
                    $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 * -1);
                    $_obf_0D18161E352E061A0433191E381C2E0B222A272A2D3E22 = $slotSettings->GetBalance();
                    $_obf_0D2307370C401A042D310F070D313207280830055B2A32 = '{"dealerCard":"' . $_obf_0D040B162710402D331E2209370C14231F2C252B172601 . '","gambleState":"' . $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 . '","totalWin":' . $totalWin . ',"afterBalance":' . $_obf_0D18161E352E061A0433191E381C2E0B222A272A2D3E22 . ',"Balance":' . $Balance . '}';
                    $response = '{"responseEvent":"gambleResult","serverResponse":' . $_obf_0D2307370C401A042D310F070D313207280830055B2A32 . '}';
                    $slotSettings->SaveLogReport($response, $_obf_0D31140A120E1B3D282A06280B27103B250935092B1F01, 1, $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101, 'slotGamble');
                    $_obf_0D0B38261D090527042502043006023133212F0F040922 = $slotSettings->GetGameData('ActionMoneyEGTCards');
                    array_pop($_obf_0D0B38261D090527042502043006023133212F0F040922);
                    array_unshift($_obf_0D0B38261D090527042502043006023133212F0F040922, $_obf_0D040B162710402D331E2209370C14231F2C252B172601);
                    $slotSettings->SetGameData('ActionMoneyEGTCards', $_obf_0D0B38261D090527042502043006023133212F0F040922);
                    $_obf_0D33051C1539292C322D230A2B230A1F321305011D0D11 = 1;
                    $_obf_0D5B371F2E1F40053E052836232E1C33035B17162B2B32 = 1;
                    if( $slotSettings->GetGameData('ActionMoneyEGTBonusStart') == 1 ) 
                    {
                        $_obf_0D5B371F2E1F40053E052836232E1C33035B17162B2B32 = 2;
                    }
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '{"complex":{"gambles":' . $slotSettings->GetGameData('ActionMoneyEGTGambleStep') . ',"card":' . $_obf_0D040B162710402D331E2209370C14231F2C252B172601 . ',"jackpot":false,"gameCommand":"gamble"},"state":"' . $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 . '","winAmount":' . ($totalWin * 100) . ',"gameIdentificationNumber":' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gameIdentificationNumber'] . ',"gameNumber":"","sessionKey":"88e2b82e6537db4a339e4e1b5ce462cd","msg":"success","messageId":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['messageId'] . '","qName":"app.services.messages.response.GameEventResponse","command":"bet","eventTimestamp":' . time() . '}';
                    break;
            }
            $response = implode('------:::', $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201);
            $slotSettings->SaveGameData();
            \DB::commit();
            return ':::' . $response;
        }
    }

}
