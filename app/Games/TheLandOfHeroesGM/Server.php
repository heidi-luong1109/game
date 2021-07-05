<?php 
namespace VanguardLTE\Games\TheLandOfHeroesGM
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
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = $_REQUEST;
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = '';
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['func'];
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] == 'gamble' && $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') <= 0 ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid gamble state"}';
                exit( $response );
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] == 'spin' ) 
            {
                $lines = $slotSettings->GetGameData($slotSettings->slotId . 'Lines');
                $betline = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentBet');
                if( $lines <= 0 || $betline <= 0.0001 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid bet state"}';
                    exit( $response );
                }
                if( $slotSettings->GetBalance() < ($lines * $betline) ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid balance"}';
                    exit( $response );
                }
                if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['freegame'] == '1' ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }
                if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= 0 && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['freegame'] == '1' ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }
            }
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = (string)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'];
            switch( $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 ) 
            {
                case 'init':
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BetStep', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentBet', $slotSettings->Bet[0]);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 10);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', []);
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentBet', $lastEvent->serverResponse->CurrentBet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BetStep', $lastEvent->serverResponse->BetStep);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->Lines);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', $lastEvent->serverResponse->BonusSymbol);
                        $reels = (array)$lastEvent->serverResponse->reelsSymbols;
                        $reels['reel1'] = (array)$reels['reel1'];
                        $reels['reel2'] = (array)$reels['reel2'];
                        $reels['reel3'] = (array)$reels['reel3'];
                        $reels['reel4'] = (array)$reels['reel4'];
                        $reels['reel5'] = (array)$reels['reel5'];
                        $_obf_0D0231242F16365B3C1D071E3B263319262A16261D2F01 = $lastEvent->serverResponse->CurrentBet;
                        $_obf_0D0D3D19173E372D15391D0C1E1F01030F1E163B5B3222 = $lastEvent->serverResponse->Lines;
                        $_obf_0D2C0A0D29183106405B3635060B312C2F1F2505353B01 = 'i:0;i:' . $reels['reel1'][2] . ';i:1;i:' . $reels['reel1'][1] . ';i:2;i:' . $reels['reel1'][0] . ';i:3;i:' . rand(1, 7) . ';';
                        $_obf_0D2F0B24091503180D2F281C1E3424091D363611052732 = 'i:0;i:' . $reels['reel2'][2] . ';i:1;i:' . $reels['reel2'][1] . ';i:2;i:' . $reels['reel2'][0] . ';i:3;i:' . rand(1, 7) . ';';
                        $_obf_0D1210031C361019093B143D303109261E3E0917080732 = 'i:0;i:' . $reels['reel3'][2] . ';i:1;i:' . $reels['reel3'][1] . ';i:2;i:' . $reels['reel3'][0] . ';i:3;i:' . rand(1, 7) . ';';
                        $_obf_0D18130A211F315C2B32261D30241436122333100D1D32 = 'i:0;i:' . $reels['reel4'][2] . ';i:1;i:' . $reels['reel4'][1] . ';i:2;i:' . $reels['reel4'][0] . ';i:3;i:' . rand(1, 7) . ';';
                        $_obf_0D0D2226295B0A2115403F30275B2A1A2219341C223B11 = 'i:0;i:' . $reels['reel5'][2] . ';i:1;i:' . $reels['reel5'][1] . ';i:2;i:' . $reels['reel5'][0] . ';i:3;i:' . rand(1, 7) . ';';
                        $_obf_0D303824321032022116072C3F3F1A2225350B2B261611 = 0;
                    }
                    else
                    {
                        $_obf_0D0231242F16365B3C1D071E3B263319262A16261D2F01 = $slotSettings->Bet[0];
                        $_obf_0D0D3D19173E372D15391D0C1E1F01030F1E163B5B3222 = 20;
                        $_obf_0D303824321032022116072C3F3F1A2225350B2B261611 = 0;
                        $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $_obf_0D0D3D19173E372D15391D0C1E1F01030F1E163B5B3222);
                        $_obf_0D2C0A0D29183106405B3635060B312C2F1F2505353B01 = 'i:0;i:' . rand(1, 7) . ';i:1;i:' . rand(1, 7) . ';i:2;i:' . rand(1, 7) . ';i:3;i:' . rand(1, 7) . ';';
                        $_obf_0D2F0B24091503180D2F281C1E3424091D363611052732 = 'i:0;i:' . rand(1, 7) . ';i:1;i:' . rand(1, 7) . ';i:2;i:' . rand(1, 7) . ';i:3;i:' . rand(1, 7) . ';';
                        $_obf_0D1210031C361019093B143D303109261E3E0917080732 = 'i:0;i:' . rand(1, 7) . ';i:1;i:' . rand(1, 7) . ';i:2;i:' . rand(1, 7) . ';i:3;i:' . rand(1, 7) . ';';
                        $_obf_0D18130A211F315C2B32261D30241436122333100D1D32 = 'i:0;i:' . rand(1, 7) . ';i:1;i:' . rand(1, 7) . ';i:2;i:' . rand(1, 7) . ';i:3;i:' . rand(1, 7) . ';';
                        $_obf_0D0D2226295B0A2115403F30275B2A1A2219341C223B11 = 'i:0;i:' . rand(1, 7) . ';i:1;i:' . rand(1, 7) . ';i:2;i:' . rand(1, 7) . ';i:3;i:' . rand(1, 7) . ';';
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                    {
                        $_obf_0D303824321032022116072C3F3F1A2225350B2B261611 = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1;
                    }
                    $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 = '';
                    for( $i = 0; $i < count($slotSettings->Bet); $i++ ) 
                    {
                        $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 .= ('i:' . $i . ';i:' . ($slotSettings->Bet[$i] * 100) . ';');
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'INFO$$1$$a:1:{s:8:"initData";a:43:{s:5:"reels";a:5:{s:21:"reel_a_initsymboldata";a:4:{' . $_obf_0D2C0A0D29183106405B3635060B312C2F1F2505353B01 . '}s:21:"reel_b_initsymboldata";a:4:{' . $_obf_0D2F0B24091503180D2F281C1E3424091D363611052732 . '}s:21:"reel_c_initsymboldata";a:4:{' . $_obf_0D1210031C361019093B143D303109261E3E0917080732 . '}s:21:"reel_d_initsymboldata";a:4:{' . $_obf_0D18130A211F315C2B32261D30241436122333100D1D32 . '}s:21:"reel_e_initsymboldata";a:4:{' . $_obf_0D0D2226295B0A2115403F30275B2A1A2219341C223B11 . '}}s:11:"actFreegame";i:' . $_obf_0D303824321032022116072C3F3F1A2225350B2B261611 . ';s:11:"freegameWin";i:' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . ';s:12:"maxFreegames";i:' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ';s:9:"possLines";a:3:{i:0;i:10;i:1;i:20;i:2;i:30;}s:15:"maxLinesPerReel";i:0;s:12:"possLinebets";a:' . count($slotSettings->Bet) . ':{' . $_obf_0D130827385C083E1E300D2E3F3233061923211C050522 . '}s:18:"linesForOneLinebet";i:1;s:8:"maxiplay";b:0;s:17:"maxiplayBetFactor";i:1;s:5:"money";i:' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ';s:7:"linebet";i:' . ($_obf_0D0231242F16365B3C1D071E3B263319262A16261D2F01 * 100) . ';s:5:"lines";i:' . $_obf_0D0D3D19173E372D15391D0C1E1F01030F1E163B5B3222 . ";s:14:\"autospinConfig\";a:9:{i:0;i:10;i:1;i:25;i:2;i:50;i:3;i:75;i:4;i:100;i:5;i:250;i:6;i:500;i:7;i:750;i:8;i:1000;}s:18:\"unlimitedAutospins\";b:1;s:19:\"gamblePulseInterval\";i:545;s:18:\"hasMaxiplayFeature\";b:0;s:13:\"attentionSpin\";s:7:\"scatter\";s:12:\"maxGambleBet\";i:15000;s:14:\"maxGambleTries\";i:0;s:15:\"useGambleLadder\";b:1;s:18:\"maxGambleLadderBet\";i:600000000;s:13:\"useGambleCard\";b:1;s:19:\"useUniqueStopButton\";b:0;s:10:\"inDemoMode\";b:0;s:12:\"actFreeRound\";i:0;s:13:\"maxFreeRounds\";i:0;s:12:\"freeRoundBet\";i:0;s:12:\"freeRoundWin\";i:0;s:30:\"useExternalFreeRoundsIntroSign\";b:0;s:27:\"dontShowFreeRoundsOutroSign\";b:0;s:32:\"dontShowWinOnFreeRoundsOutroSign\";b:1;s:20:\"freeRoundsIntroDelay\";i:0;s:20:\"freeRoundsOutroDelay\";i:3000;s:18:\"linemarkersContent\";s:1551:\"\t\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\n<div class=\"linemarkersBox\">\n\n\t<div class=\"fl linemarkersColumn\">\n\t\t\t\t\t\t\t\t\t<div class=\"linemarker large lines20  \">\n\t\t\t\t\t<div class=\"linemarkerValue\">20</div>\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"linemarkerLabel hidden\">LINES</div>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"linemarker large lines10  \">\n\t\t\t\t\t<div class=\"linemarkerValue\">10</div>\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"linemarkerLabel hidden\">LINES</div>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t<div class=\"fr linemarkersColumn\">\n\t\t\t\t\t\t\t\t\t<div class=\"linemarker large lines20  \">\n\t\t\t\t\t<div class=\"linemarkerValue\">20</div>\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"linemarkerLabel hidden\">LINES</div>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"linemarker large lines10  \">\n\t\t\t\t\t<div class=\"linemarkerValue\">10</div>\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"linemarkerLabel hidden\">LINES</div>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\n\t<div class=\"clear\"></div>\n\n</div>\n\n\n<div class=\"linemarkerClickareasBox\">\n\n\t<div class=\"fl linemarkerClickareasColumn\">\n\t\t\t\t\t\t\t\t\t<div class=\"linemarkerClickarea large lines20 deactivated\"></div>\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"linemarkerClickarea large lines10 deactivated\"></div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t<div class=\"fr linemarkerClickareasColumn\">\n\t\t\t\t\t\t\t\t\t<div class=\"linemarkerClickarea large lines20 deactivated\"></div>\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"linemarkerClickarea large lines10 deactivated\"></div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\n\t<div class=\"clear\"></div>\n\n</div>\";s:19:\"linemarkersContentX\";s:484:\"\n<div class=\"linemarkersBoxX\">\n\n\t<div class=\"fl linemarkersColumn\">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t<div class=\"fr linemarkersColumn\">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\n\t<div class=\"clear\"></div>\n\n</div>\";s:5:\"sound\";b:1;s:8:\"spaceBar\";b:1;s:9:\"quickSpin\";b:0;s:12:\"leftHandMode\";b:0;s:16:\"featureCountdown\";b:0;s:16:\"showJackpotIntro\";b:0;s:9:\"sessionID\";s:26:\"g2f00dics0r529vs6iktr56mc5\";}}";
                    break;
                case 'applyUserRequest':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    $_obf_0D191B0F2F052406270F32143B3D1B2E332D0930212A32 = $_REQUEST['request'];
                    $_obf_0D3419081E37113E240B3D15381C082131263D01262B32 = $slotSettings->GetGameData($slotSettings->slotId . 'BetStep');
                    if( $_obf_0D191B0F2F052406270F32143B3D1B2E332D0930212A32 == 'linebetplus' ) 
                    {
                        $_obf_0D3419081E37113E240B3D15381C082131263D01262B32++;
                        if( count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) - 1 < $_obf_0D3419081E37113E240B3D15381C082131263D01262B32 ) 
                        {
                            $_obf_0D3419081E37113E240B3D15381C082131263D01262B32 = 0;
                        }
                        $_obf_0D11265B181A372D2E121D2D5C3819351D1D382B123811 = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$_obf_0D3419081E37113E240B3D15381C082131263D01262B32];
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:7:"linebet";s:5:"value";i:' . ($_obf_0D11265B181A372D2E121D2D5C3819351D1D382B123811 * 100) . ';}}}';
                        $slotSettings->SetGameData($slotSettings->slotId . 'BetStep', $_obf_0D3419081E37113E240B3D15381C082131263D01262B32);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentBet', $_obf_0D11265B181A372D2E121D2D5C3819351D1D382B123811);
                    }
                    if( $_obf_0D191B0F2F052406270F32143B3D1B2E332D0930212A32 == 'maxbet' ) 
                    {
                        $_obf_0D3419081E37113E240B3D15381C082131263D01262B32++;
                        $_obf_0D3419081E37113E240B3D15381C082131263D01262B32 = count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) - 1;
                        $_obf_0D11265B181A372D2E121D2D5C3819351D1D382B123811 = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$_obf_0D3419081E37113E240B3D15381C082131263D01262B32];
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:7:"linebet";s:5:"value";i:' . ($_obf_0D11265B181A372D2E121D2D5C3819351D1D382B123811 * 100) . ';}}}';
                        $slotSettings->SetGameData($slotSettings->slotId . 'BetStep', $_obf_0D3419081E37113E240B3D15381C082131263D01262B32);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentBet', $_obf_0D11265B181A372D2E121D2D5C3819351D1D382B123811);
                    }
                    if( $_obf_0D191B0F2F052406270F32143B3D1B2E332D0930212A32 == 'linebetminus' ) 
                    {
                        $_obf_0D3419081E37113E240B3D15381C082131263D01262B32--;
                        if( $_obf_0D3419081E37113E240B3D15381C082131263D01262B32 < 0 ) 
                        {
                            $_obf_0D3419081E37113E240B3D15381C082131263D01262B32 = count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) - 1;
                        }
                        $_obf_0D11265B181A372D2E121D2D5C3819351D1D382B123811 = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$_obf_0D3419081E37113E240B3D15381C082131263D01262B32];
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:7:"linebet";s:5:"value";i:' . ($_obf_0D11265B181A372D2E121D2D5C3819351D1D382B123811 * 100) . ';}}}';
                        $slotSettings->SetGameData($slotSettings->slotId . 'BetStep', $_obf_0D3419081E37113E240B3D15381C082131263D01262B32);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentBet', $_obf_0D11265B181A372D2E121D2D5C3819351D1D382B123811);
                    }
                    if( $_obf_0D191B0F2F052406270F32143B3D1B2E332D0930212A32 == 'linesplus' ) 
                    {
                        $lines = $slotSettings->GetGameData($slotSettings->slotId . 'Lines');
                        $lines += 10;
                        if( $lines > 20 ) 
                        {
                            $lines = 10;
                        }
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:5:"lines";s:5:"value";i:' . $lines . ';}}}';
                        $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lines);
                    }
                    if( $_obf_0D191B0F2F052406270F32143B3D1B2E332D0930212A32 == 'linesminus' ) 
                    {
                        $lines = $slotSettings->GetGameData($slotSettings->slotId . 'Lines');
                        $lines -= 10;
                        if( $lines < 10 ) 
                        {
                            $lines = 20;
                        }
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:5:"lines";s:5:"value";i:' . $lines . ';}}}';
                        $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lines);
                    }
                    break;
                case 'setLines':
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines'] <= 0 ) 
                    {
                        exit();
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines']);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:5:"lines";s:5:"value";i:' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines'] . ';}}}';
                    break;
                case 'setSpacebar':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'INFO$$1$$a:0:{}';
                    break;
                case 'setQuickspin':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'INFO$$1$$a:0:{}';
                    break;
                case 'setFeatureCountdown':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'INFO$$1$$a:0:{}';
                    break;
                case 'noGamble':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:8:"noGamble";s:5:"value";a:1:{s:17:"enforceNextAction";s:4:"wait";}}}}';
                    break;
                case 'setSound':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'INFO$$1$$a:0:{}';
                    break;
                case 'showInfoSite':
                    if( $_REQUEST['section'] == 'paytable' ) 
                    {
                        $bet = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentBet');
                        $lines = $slotSettings->GetGameData($slotSettings->slotId . 'Lines');
                        $_obf_0D0A40022E5B2321321A3F023513362202150202141522 = "<div class=\"infoPopup webInfo info1 en\">\n\t\t\n\t<div class=\"scrollContainer\">\n\t\t<div class=\"bigHeadline\">PAYTABLE</div>\n\t\t\t\n\t\t<div class=\"headline\">TOP/WILD</div>\n\t\t<div class=\"description\">\"Old Man\" is Wild and substitutes for all symbols except Scatters.</div>\n\t\t<div class=\"winValueBox centerColumn winValues-11\" id=\"topValues\">\n\t\t\t<div class=\"fl symbolImg symbolImg-11\"></div>\n\t\t\t<div class=\"fr values fourLines\">\n\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue widthReference\" id=\"value0-5\">\n\t\t\t\t\t\t<span class=\"multiplicator\">5</span>\n\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_11'][5] * $bet) . "</span>\n\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value1-4\">\n\t\t\t\t\t\t<span class=\"multiplicator\">4</span>\n\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_11'][4] * $bet) . "</span>\n\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value2-3\">\n\t\t\t\t\t\t<span class=\"multiplicator\">3</span>\n\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_11'][3] * $bet) . "</span>\n\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value3-2\">\n\t\t\t\t\t\t<span class=\"multiplicator\">2</span>\n\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_11'][2] * $bet) . "</span>\n\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\n\t\t\t<div class=\"clear\"></div>\n\t\t</div>\n\t\t\t\n\t\t<div class=\"headline\">SCATTER</div>\n\t\t<div class=\"description\">\"Magic Mill\" is Scatter. </div>\n\t\t<div class=\"winValueBox centerColumn winValues-12\" id=\"scatterValues\">\n\t\t\t<div class=\"fl symbolImg symbolImg-12\"></div>\n\t\t\t<div class=\"fr values\">\n\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue widthReference\" id=\"value4-5\">\n\t\t\t\t\t\t<span class=\"multiplicator\">5</span>\n\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_12'][5] * $bet * $lines) . "</span>\n\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value5-4\">\n\t\t\t\t\t\t<span class=\"multiplicator\">4</span>\n\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_12'][4] * $bet * $lines) . "</span>\n\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value6-3\">\n\t\t\t\t\t\t<span class=\"multiplicator\">3</span>\n\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_12'][3] * $bet * $lines) . "</span>\n\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\n\t\t\t<div class=\"clear\"></div>\n\t\t</div>\n\t\t\n\t\t<div class=\"headline\">7 FREE GAMES</div>\n\t\t<div class=\"description\">7 free games are triggered by 3/4/5 Scatters. During free games feature it is possible to trigger additional free games.</div>\n\t\t<div class=\"description\">During free games up to 4 symbols are turned into additional wilds.</div>\n\n\t\t<div class=\"headline\">PAYOUT VALUES</div>\n\t\t<div class=\"centerColumn paytableValues\" id=\"paytableValues\">\n\t\t\t\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"fl winValueBox winValues-10\" id=\"winValues-10\">\n\t\t\t\t\t<div class=\"fl symbolImg symbolImg-10\"></div>\n\t\t\t\t\t<div class=\"fr values fourLines\">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue widthReference\" id=\"value7-5\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">5</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_10'][5] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value8-4\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">4</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_10'][4] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value9-3\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">3</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_10'][3] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value10-2\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">2</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_10'][2] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"clear\"></div>\n\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"fr winValueBox winValues-9\" id=\"winValues-9\">\n\t\t\t\t\t<div class=\"fl symbolImg symbolImg-9\"></div>\n\t\t\t\t\t<div class=\"fr values \">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue widthReference\" id=\"value11-5\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">5</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_9'][5] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value12-4\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">4</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_9'][4] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value13-3\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">3</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_9'][3] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"clear\"></div>\n\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"fl winValueBox winValues-8\" id=\"winValues-8\">\n\t\t\t\t\t<div class=\"fl symbolImg symbolImg-8\"></div>\n\t\t\t\t\t<div class=\"fr values \">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue widthReference\" id=\"value14-5\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">5</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_8'][5] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value15-4\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">4</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_8'][4] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value16-3\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">3</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_8'][3] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"clear\"></div>\n\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"fr winValueBox winValues-7\" id=\"winValues-7\">\n\t\t\t\t\t<div class=\"fl symbolImg symbolImg-7\"></div>\n\t\t\t\t\t<div class=\"fr values \">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue widthReference\" id=\"value17-5\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">5</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_7'][5] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value18-4\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">4</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_7'][4] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value19-3\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">3</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_7'][3] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"clear\"></div>\n\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"fl winValueBox winValues-6\" id=\"winValues-6\">\n\t\t\t\t\t<div class=\"fl symbolImg symbolImg-6\"></div>\n\t\t\t\t\t<div class=\"fr values \">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue widthReference\" id=\"value20-5\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">5</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_6'][5] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value21-4\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">4</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_6'][4] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value22-3\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">3</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_6'][3] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"clear\"></div>\n\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"fr winValueBox winValues-5\" id=\"winValues-5\">\n\t\t\t\t\t<div class=\"fl symbolImg symbolImg-5\"></div>\n\t\t\t\t\t<div class=\"fr values \">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue widthReference\" id=\"value23-5\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">5</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_5'][5] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value24-4\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">4</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_5'][4] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value25-3\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">3</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_5'][3] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"clear\"></div>\n\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"fl winValueBox winValues-4\" id=\"winValues-4\">\n\t\t\t\t\t<div class=\"fl symbolImg symbolImg-4\"></div>\n\t\t\t\t\t<div class=\"fr values \">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue widthReference\" id=\"value26-5\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">5</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_4'][5] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value27-4\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">4</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_4'][4] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value28-3\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">3</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_4'][3] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"clear\"></div>\n\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"fr winValueBox winValues-3\" id=\"winValues-3\">\n\t\t\t\t\t<div class=\"fl symbolImg symbolImg-3\"></div>\n\t\t\t\t\t<div class=\"fr values \">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue widthReference\" id=\"value29-5\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">5</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_3'][5] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value30-4\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">4</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_3'][4] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value31-3\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">3</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_3'][3] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"clear\"></div>\n\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"fl winValueBox winValues-2\" id=\"winValues-2\">\n\t\t\t\t\t<div class=\"fl symbolImg symbolImg-2\"></div>\n\t\t\t\t\t<div class=\"fr values \">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue widthReference\" id=\"value32-5\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">5</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_2'][5] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value33-4\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">4</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_2'][4] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value34-3\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">3</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_2'][3] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"clear\"></div>\n\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"fr winValueBox winValues-1\" id=\"winValues-1\">\n\t\t\t\t\t<div class=\"fl symbolImg symbolImg-1\"></div>\n\t\t\t\t\t<div class=\"fr values \">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue widthReference\" id=\"value35-5\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">5</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_1'][5] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value36-4\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">4</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_1'][4] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"winValue \" id=\"value37-3\">\n\t\t\t\t\t\t\t\t<span class=\"multiplicator\">3</span>\n\t\t\t\t\t\t\t\t<span class=\"winValueText\">" . sprintf('%01.2f', $slotSettings->Paytable['SYM_1'][3] * $bet) . "</span>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"clear\"></div>\n\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"clear\"></div>\n\t\t</div>\n\t\t\n\t\t<div class=\"headline\">PAYLINES</div>\n\t\t<div class=\"paylines\"></div>\n\t\t\n\t</div>\n\n</div>";
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'INFO$$1$$a:1:{s:7:"display";a:2:{i:0;a:2:{s:4:"type";s:7:"linebet";s:5:"value";i:' . ($bet * 100) . ';}i:1;a:2:{s:4:"type";s:4:"info";s:5:"value";s:' . strlen($_obf_0D0A40022E5B2321321A3F023513362202150202141522) . ':"' . $_obf_0D0A40022E5B2321321A3F023513362202150202141522 . '";}}}';
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = "INFO\$\$1\$\$a:1:{s:7:\"display\";a:1:{i:0;a:3:{s:4:\"type\";s:4:\"info\";s:5:\"value\";s:960:\"<div class=\"infoPopup webInfo info2 en\">\n\t\n\t\t<div class=\"settingsBox\">\n\t\t\t\t\t\t\t<div class=\"setting\">\n\t\t\t\t\t<div class=\"setGameSetting settingCheckbox active fl setting1\" id=\"settingCheckbox-1\"></div>\n\t\t\t\t\t<div class=\"settingText fl setting1\">SPIN WITH SPACEBAR</div>\n\t\t\t\t\t<div class=\"clear\"></div>\n\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"setting quickspin\">\n\t\t\t\t<div class=\"setGameSetting settingCheckbox active fl setting2\" id=\"settingCheckbox-2\"></div>\n\t\t\t\t<div class=\"settingText fl setting2\">TURBO SPIN</div>\n\t\t\t\t<div class=\"clear\"></div>\n\t\t\t</div>\n\t\t\t<div class=\"setting featureCountdown\">\n\t\t\t\t<div class=\"setGameSetting settingCheckbox active fl setting3\" id=\"settingCheckbox-3\"></div>\n\t\t\t\t<div class=\"settingText fl setting3\">\n\t\t\t\t\t<span class=\"freegame hidden\">AUTOMATIC FREE GAMES ENTRY</span>\n\t\t\t\t\t<span class=\"feature hidden\">AUTOMATIC FEATURE ENTRY</span>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"clear\"></div>\n\t\t\t</div>\n\t\t\t\t\t</div>\n\t\n\t<div class=\"closeButton\"></div>\t\n</div>\";s:14:\"isSettingsSite\";b:1;}}}";
                    }
                    break;
                case 'triggerGameEvent':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = 'INFO$$1$$a:0:{}';
                    break;
                case 'spin':
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
                    $linesId[10] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[11] = [
                        1, 
                        1, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[12] = [
                        3, 
                        3, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[13] = [
                        1, 
                        3, 
                        1, 
                        3, 
                        1
                    ];
                    $linesId[14] = [
                        3, 
                        1, 
                        3, 
                        1, 
                        3
                    ];
                    $linesId[15] = [
                        1, 
                        2, 
                        1, 
                        2, 
                        1
                    ];
                    $linesId[16] = [
                        3, 
                        2, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[17] = [
                        2, 
                        1, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[18] = [
                        2, 
                        3, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[19] = [
                        2, 
                        2, 
                        1, 
                        2, 
                        2
                    ];
                    $linesId[20] = [
                        2, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[21] = [
                        1, 
                        3, 
                        2, 
                        3, 
                        1
                    ];
                    $linesId[22] = [
                        3, 
                        1, 
                        2, 
                        1, 
                        3
                    ];
                    $linesId[23] = [
                        2, 
                        1, 
                        3, 
                        1, 
                        2
                    ];
                    $linesId[24] = [
                        2, 
                        3, 
                        1, 
                        3, 
                        2
                    ];
                    $linesId[25] = [
                        1, 
                        3, 
                        3, 
                        3, 
                        1
                    ];
                    $linesId[26] = [
                        3, 
                        1, 
                        1, 
                        1, 
                        3
                    ];
                    $linesId[27] = [
                        1, 
                        1, 
                        3, 
                        1, 
                        1
                    ];
                    $linesId[28] = [
                        3, 
                        3, 
                        1, 
                        3, 
                        3
                    ];
                    $linesId[29] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $lines = $slotSettings->GetGameData($slotSettings->slotId . 'Lines');
                    $betline = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentBet');
                    $allbet = $betline * $lines;
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['freegame'] == '1' ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                    {
                        if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                        {
                            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                        }
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $allbet / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $slotSettings->UpdateJackpots($allbet);
                        $slotSettings->SetBalance(-1 * $allbet, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', []);
                        $bonusMpl = 1;
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                        $bonusMpl = $slotSettings->slotFreeMpl;
                    }
                    $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $allbet, $lines);
                    $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                    $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
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
                        $wild = ['11'];
                        $scatter = '12';
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D1103183E22072D2511390A1B145C25235C2407082111 = $reels;
                        $_obf_0D3003383B0233010601281016311C09043C0C3F362811 = 1;
                        $_obf_0D12301B2529042D223029383D1F293B331F3530080932 = $slotSettings->GetGameData($slotSettings->slotId . 'BonusSymbol');
                        for( $_obf_0D362211271812115C3D1F11291A1A35122129062C3C22 = 0; $_obf_0D362211271812115C3D1F11291A1A35122129062C3C22 < count($_obf_0D12301B2529042D223029383D1F293B331F3530080932); $_obf_0D362211271812115C3D1F11291A1A35122129062C3C22++ ) 
                        {
                            $wild[] = '' . $_obf_0D12301B2529042D223029383D1F293B331F3530080932[$_obf_0D362211271812115C3D1F11291A1A35122129062C3C22];
                        }
                        for( $k = 0; $k < $lines; $k++ ) 
                        {
                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '';
                            for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                            {
                                $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = (string)$slotSettings->SymbolGame[$j];
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
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][2] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel1'][$linesId[$k][0] - 1] = -1;
                                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel2'][$linesId[$k][1] - 1] = -1;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = 'i:' . $_obf_0D3003383B0233010601281016311C09043C0C3F362811 . ';a:6:{i:0;i:' . ($k + 1) . ';i:1;i:' . $s[0] . ';i:2;i:' . $s[1] . ';i:3;b:0;i:4;b:0;i:5;b:0;}';
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
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = 'i:' . $_obf_0D3003383B0233010601281016311C09043C0C3F362811 . ';a:6:{i:0;i:' . ($k + 1) . ';i:1;i:' . $s[0] . ';i:2;i:' . $s[1] . ';i:3;i:' . $s[2] . ';i:4;b:0;i:5;b:0;}';
                                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel1'][$linesId[$k][0] - 1] = -1;
                                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel2'][$linesId[$k][1] - 1] = -1;
                                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel3'][$linesId[$k][2] - 1] = -1;
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
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = 'i:' . $_obf_0D3003383B0233010601281016311C09043C0C3F362811 . ';a:6:{i:0;i:' . ($k + 1) . ';i:1;i:' . $s[0] . ';i:2;i:' . $s[1] . ';i:3;i:' . $s[2] . ';i:4;i:' . $s[3] . ';i:5;b:0;}';
                                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel1'][$linesId[$k][0] - 1] = -1;
                                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel2'][$linesId[$k][1] - 1] = -1;
                                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel3'][$linesId[$k][2] - 1] = -1;
                                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel4'][$linesId[$k][3] - 1] = -1;
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
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = 'i:' . $_obf_0D3003383B0233010601281016311C09043C0C3F362811 . ';a:6:{i:0;i:' . ($k + 1) . ';i:1;i:' . $s[0] . ';i:2;i:' . $s[1] . ';i:3;i:' . $s[2] . ';i:4;i:' . $s[3] . ';i:5;i:' . $s[4] . ';}';
                                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel1'][$linesId[$k][0] - 1] = -1;
                                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel2'][$linesId[$k][1] - 1] = -1;
                                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel3'][$linesId[$k][2] - 1] = -1;
                                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel4'][$linesId[$k][3] - 1] = -1;
                                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel5'][$linesId[$k][4] - 1] = -1;
                                        }
                                    }
                                }
                            }
                            if( $cWins[$k] > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                            {
                                array_push($lineWins, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                                $totalWin += $cWins[$k];
                                $_obf_0D3003383B0233010601281016311C09043C0C3F362811++;
                            }
                        }
                        $scattersWin = 0;
                        $scattersStr = '';
                        $scattersCount = 0;
                        $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [
                            'i:0;a:6:{i:0;i:0;', 
                            'i:1;b:0;', 
                            'i:2;b:0;', 
                            'i:3;b:0;', 
                            'i:4;b:0;', 
                            'i:5;b:0;', 
                            '}'
                        ];
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            if( $reels['reel' . $r][0] == $scatter || $reels['reel' . $r][1] == $scatter || $reels['reel' . $r][2] == $scatter ) 
                            {
                                $scattersCount++;
                                $_obf_0D312B19262C083426241E0D392E22282324060B380811[$r] = 'i:' . $r . ';i:' . $scatter . ';';
                            }
                        }
                        $scattersWin = $slotSettings->Paytable['SYM_' . $scatter][$scattersCount] * $allbet * $bonusMpl;
                        $scattersStr = implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811);
                        if( $scattersCount >= 3 || $scattersWin > 0 ) 
                        {
                            array_push($lineWins, $scattersStr);
                        }
                        $_obf_0D0410092A1F39153D171B22300F190E22312603020C01 = [];
                        $_obf_0D37325B0B3F020C26403910323E16341F311E110F1232 = 0;
                        $_obf_0D12301B2529042D223029383D1F293B331F3530080932 = $slotSettings->GetGameData($slotSettings->slotId . 'BonusSymbol');
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $p = 0; $p <= 2; $p++ ) 
                            {
                                if( $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel' . $r][$p] == -1 ) 
                                {
                                    if( $reels['reel' . $r][$p] == 11 ) 
                                    {
                                        $_obf_0D0410092A1F39153D171B22300F190E22312603020C01[] = 'i:' . $_obf_0D37325B0B3F020C26403910323E16341F311E110F1232 . ';a:3:{s:4:"reel";i:' . ($r - 1) . ';s:3:"pos";i:' . $p . ';s:9:"animation";s:4:"wild";}';
                                    }
                                    if( in_array($reels['reel' . $r][$p], $_obf_0D12301B2529042D223029383D1F293B331F3530080932) ) 
                                    {
                                        $_obf_0D0410092A1F39153D171B22300F190E22312603020C01[] = 'i:' . $_obf_0D37325B0B3F020C26403910323E16341F311E110F1232 . ';a:4:{s:4:"reel";i:' . ($r - 1) . ';s:3:"pos";i:' . $p . ';s:9:"animation";s:10:"goldenWild";s:6:"symbol";i:' . $reels['reel' . $r][$p] . ';}';
                                    }
                                    $_obf_0D37325B0B3F020C26403910323E16341F311E110F1232++;
                                }
                            }
                        }
                        $totalWin += $scattersWin;
                        if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($allbet * rand(2, 5)) ) 
                        {
                        }
                        else if( !$slotSettings->increaseRTP && $winType == 'win' && $allbet < $totalWin ) 
                        {
                        }
                        else
                        {
                            if( $i > 1000 ) 
                            {
                                $winType = 'none';
                            }
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
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                        $slotSettings->SetBalance($totalWin);
                    }
                    $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                    $_obf_0D303824321032022116072C3F3F1A2225350B2B261611 = 0;
                    $_obf_0D2433275B04240E5C2B30283B045C37031B063C342E22 = 0;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D303824321032022116072C3F3F1A2225350B2B261611 = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1;
                        $_obf_0D2433275B04240E5C2B30283B045C37031B063C342E22 = 1;
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    }
                    $fs = 0;
                    if( $scattersCount >= 3 ) 
                    {
                        $_obf_0D303824321032022116072C3F3F1A2225350B2B261611 = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1;
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $slotSettings->slotFreeCount[$scattersCount]);
                        }
                        else
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount[$scattersCount]);
                            $_obf_0D182325181724045C23095B29211804172F03311B0F11 = [
                                6, 
                                7, 
                                8, 
                                9
                            ];
                            shuffle($_obf_0D182325181724045C23095B29211804172F03311B0F11);
                            $_obf_0D382E122D03271F09062F363B3B141504243131321B11 = rand(1, 4);
                            $_obf_0D333F065B0B2B2B1B0519173705402507325B372A2B32 = [];
                            for( $_obf_0D362211271812115C3D1F11291A1A35122129062C3C22 = 0; $_obf_0D362211271812115C3D1F11291A1A35122129062C3C22 < $_obf_0D382E122D03271F09062F363B3B141504243131321B11; $_obf_0D362211271812115C3D1F11291A1A35122129062C3C22++ ) 
                            {
                                $_obf_0D333F065B0B2B2B1B0519173705402507325B372A2B32[] = $_obf_0D182325181724045C23095B29211804172F03311B0F11[$_obf_0D362211271812115C3D1F11291A1A35122129062C3C22];
                            }
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', $_obf_0D333F065B0B2B2B1B0519173705402507325B372A2B32);
                        }
                        $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                    }
                    $_obf_0D12301B2529042D223029383D1F293B331F3530080932 = $slotSettings->GetGameData($slotSettings->slotId . 'BonusSymbol');
                    $_obf_0D30173F233606261C0D360D2E12142639300F0B070D01 = [];
                    for( $_obf_0D362211271812115C3D1F11291A1A35122129062C3C22 = 0; $_obf_0D362211271812115C3D1F11291A1A35122129062C3C22 < count($_obf_0D12301B2529042D223029383D1F293B331F3530080932); $_obf_0D362211271812115C3D1F11291A1A35122129062C3C22++ ) 
                    {
                        $_obf_0D30173F233606261C0D360D2E12142639300F0B070D01[] = 'i:' . $_obf_0D362211271812115C3D1F11291A1A35122129062C3C22 . ';i:' . $_obf_0D12301B2529042D223029383D1F293B331F3530080932[$_obf_0D362211271812115C3D1F11291A1A35122129062C3C22] . ';';
                    }
                    $_obf_0D5C2C15321F2B353F25061A361C221E26010E16122122 = 'a:' . count($_obf_0D12301B2529042D223029383D1F293B331F3530080932) . ':{' . implode('', $_obf_0D30173F233606261C0D360D2E12142639300F0B070D01) . '}';
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = 'a:' . count($lineWins) . ':{' . implode('', $lineWins) . '}';
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"BonusSymbol":[' . implode('', $_obf_0D12301B2529042D223029383D1F293B331F3530080932) . '],"BetStep":' . $slotSettings->GetGameData($slotSettings->slotId . 'BetStep') . ',"Lines":' . $slotSettings->GetGameData($slotSettings->slotId . 'Lines') . ',"CurrentBet":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentBet') . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 = [];
                    $_obf_0D2D331C170303332223053D1C1D232130071940250322 = [
                        8, 
                        12, 
                        16, 
                        20, 
                        24
                    ];
                    for( $_obf_0D022330052A1033250B2E133F0C2F2C10293839392832 = 0; $_obf_0D022330052A1033250B2E133F0C2F2C10293839392832 < 5; $_obf_0D022330052A1033250B2E133F0C2F2C10293839392832++ ) 
                    {
                        $_obf_0D282A3E130518100418230D042B0A2B400930193F3232[$_obf_0D022330052A1033250B2E133F0C2F2C10293839392832] = 'a:' . $_obf_0D2D331C170303332223053D1C1D232130071940250322[$_obf_0D022330052A1033250B2E133F0C2F2C10293839392832] . ':{';
                        for( $_obf_0D34183E1B322B092E1A27143E32090127305C1A031332 = 0; $_obf_0D34183E1B322B092E1A27143E32090127305C1A031332 < ($_obf_0D2D331C170303332223053D1C1D232130071940250322[$_obf_0D022330052A1033250B2E133F0C2F2C10293839392832] - 4); $_obf_0D34183E1B322B092E1A27143E32090127305C1A031332++ ) 
                        {
                            $rsym = $slotSettings->SymbolGame[rand(0, count($slotSettings->SymbolGame) - 1)];
                            $_obf_0D282A3E130518100418230D042B0A2B400930193F3232[$_obf_0D022330052A1033250B2E133F0C2F2C10293839392832] .= ('i:' . $_obf_0D34183E1B322B092E1A27143E32090127305C1A031332 . ';i:' . $rsym . ';');
                        }
                    }
                    $rsym = $slotSettings->SymbolGame[rand(0, count($slotSettings->SymbolGame) - 1)];
                    $_obf_0D282A3E130518100418230D042B0A2B400930193F3232[0] .= ('i:4;i:' . $reels['reel1'][2] . ';i:5;i:' . $reels['reel1'][1] . ';i:6;i:' . $reels['reel1'][0] . ';i:7;i:' . $rsym . ';}');
                    $rsym = $slotSettings->SymbolGame[rand(0, count($slotSettings->SymbolGame) - 1)];
                    $_obf_0D282A3E130518100418230D042B0A2B400930193F3232[1] .= ('i:8;i:' . $reels['reel2'][2] . ';i:9;i:' . $reels['reel2'][1] . ';i:10;i:' . $reels['reel2'][0] . ';i:11;i:' . $rsym . ';}');
                    $rsym = $slotSettings->SymbolGame[rand(0, count($slotSettings->SymbolGame) - 1)];
                    $_obf_0D282A3E130518100418230D042B0A2B400930193F3232[2] .= ('i:12;i:' . $reels['reel3'][2] . ';i:13;i:' . $reels['reel3'][1] . ';i:14;i:' . $reels['reel3'][0] . ';i:15;i:' . $rsym . ';}');
                    $rsym = $slotSettings->SymbolGame[rand(0, count($slotSettings->SymbolGame) - 1)];
                    $_obf_0D282A3E130518100418230D042B0A2B400930193F3232[3] .= ('i:16;i:' . $reels['reel4'][2] . ';i:17;i:' . $reels['reel4'][1] . ';i:18;i:' . $reels['reel4'][0] . ';i:19;i:' . $rsym . ';}');
                    $rsym = $slotSettings->SymbolGame[rand(0, count($slotSettings->SymbolGame) - 1)];
                    $_obf_0D282A3E130518100418230D042B0A2B400930193F3232[4] .= ('i:20;i:' . $reels['reel5'][2] . ';i:21;i:' . $reels['reel5'][1] . ';i:22;i:' . $reels['reel5'][0] . ';i:23;i:' . $rsym . ';}');
                    $_obf_0D15135C211C1F15172A3D0D31233F2B1A3F1231270411 = 0;
                    $_obf_0D033E37340111220F282D2C192C0A5B1C0D2E14140711 = '';
                    for( $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01 = 0; $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01 < $lines; $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01++ ) 
                    {
                        if( $cWins[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01] > 0 ) 
                        {
                            $_obf_0D15135C211C1F15172A3D0D31233F2B1A3F1231270411++;
                            $_obf_0D033E37340111220F282D2C192C0A5B1C0D2E14140711 .= ('i:' . ($_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01 + 1) . ';i:' . ($cWins[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01] * 100) . ';');
                        }
                    }
                    if( $scattersCount >= 3 ) 
                    {
                        $_obf_0D15135C211C1F15172A3D0D31233F2B1A3F1231270411++;
                        $_obf_0D033E37340111220F282D2C192C0A5B1C0D2E14140711 .= ('i:0;i:' . ($scattersWin * 100) . ';');
                    }
                    $_obf_0D3B1722331D5C263B15293215380E1F3B1B071F100E32 = 'a:' . $_obf_0D15135C211C1F15172A3D0D31233F2B1A3F1231270411 . ':{' . $_obf_0D033E37340111220F282D2C192C0A5B1C0D2E14140711 . '}';
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' || $winType == 'bonus' ) 
                    {
                        $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $_obf_0D2433275B04240E5C2B30283B045C37031B063C342E22 = 0;
                        $_obf_0D303824321032022116072C3F3F1A2225350B2B261611 = 0;
                        $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    }
                    $_obf_0D4024053D1B0C30062D1523193E0210230C385B3D2911 = 'a:' . count($_obf_0D0410092A1F39153D171B22300F190E22312603020C01) . ':{' . implode('', $_obf_0D0410092A1F39153D171B22300F190E22312603020C01) . '}';
                    $_obf_0D26380D1A112E100F391706363219403B191038183701 = [
                        's:1:"a";b:0;', 
                        's:1:"b";b:0;', 
                        's:1:"c";b:0;', 
                        's:1:"d";b:0;', 
                        's:1:"e";b:0;'
                    ];
                    $rid = [
                        'a', 
                        'b', 
                        'c', 
                        'd', 
                        'e'
                    ];
                    $_obf_0D3B063103133128080B0A2C1717321B39062F36343B01 = 0;
                    $_obf_0D2940333D0C363D313F102B310E2F03261A2B0B043832 = 0;
                    $_obf_0D2940333D0C363D313F102B310E2F03261A2B0B043832 = [
                        's:1:"a";i:0;', 
                        's:1:"b";i:0;', 
                        's:1:"c";i:0;', 
                        's:1:"d";i:0;', 
                        's:1:"e";i:0;'
                    ];
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $p = 0; $p <= 2; $p++ ) 
                        {
                            if( $reels['reel' . $r][$p] == $scatter ) 
                            {
                                $_obf_0D26380D1A112E100F391706363219403B191038183701[$r - 1] = 's:1:"' . $rid[$r - 1] . '";a:2:{i:0;i:' . $scatter . ';i:1;i:' . ($p + 1) . ';}';
                                $_obf_0D3B063103133128080B0A2C1717321B39062F36343B01++;
                            }
                        }
                        if( $_obf_0D3B063103133128080B0A2C1717321B39062F36343B01 >= 2 && $r < 5 ) 
                        {
                            $_obf_0D2D331C170303332223053D1C1D232130071940250322 = [
                                8, 
                                12, 
                                40, 
                                60, 
                                80
                            ];
                            $_obf_0D27292F083E091D250B0C3C0C2E33053F120B3D0D3C32 = [];
                            $_obf_0D27292F083E091D250B0C3C0C2E33053F120B3D0D3C32[0] = '';
                            $_obf_0D27292F083E091D250B0C3C0C2E33053F120B3D0D3C32[1] = '';
                            $_obf_0D27292F083E091D250B0C3C0C2E33053F120B3D0D3C32[2] = '';
                            $_obf_0D27292F083E091D250B0C3C0C2E33053F120B3D0D3C32[3] = '';
                            $_obf_0D27292F083E091D250B0C3C0C2E33053F120B3D0D3C32[4] = '';
                            for( $_obf_0D022330052A1033250B2E133F0C2F2C10293839392832 = 2; $_obf_0D022330052A1033250B2E133F0C2F2C10293839392832 < 5; $_obf_0D022330052A1033250B2E133F0C2F2C10293839392832++ ) 
                            {
                                $_obf_0D27292F083E091D250B0C3C0C2E33053F120B3D0D3C32[$_obf_0D022330052A1033250B2E133F0C2F2C10293839392832] = 'a:' . $_obf_0D2D331C170303332223053D1C1D232130071940250322[$_obf_0D022330052A1033250B2E133F0C2F2C10293839392832] . ':{';
                                for( $_obf_0D34183E1B322B092E1A27143E32090127305C1A031332 = 0; $_obf_0D34183E1B322B092E1A27143E32090127305C1A031332 < ($_obf_0D2D331C170303332223053D1C1D232130071940250322[$_obf_0D022330052A1033250B2E133F0C2F2C10293839392832] - 4); $_obf_0D34183E1B322B092E1A27143E32090127305C1A031332++ ) 
                                {
                                    $rsym = $slotSettings->{'reelStrip' . ($_obf_0D022330052A1033250B2E133F0C2F2C10293839392832 + 1)}[rand(0, count($slotSettings->{'reelStrip' . ($_obf_0D022330052A1033250B2E133F0C2F2C10293839392832 + 1)}) - 1)];
                                    $_obf_0D27292F083E091D250B0C3C0C2E33053F120B3D0D3C32[$_obf_0D022330052A1033250B2E133F0C2F2C10293839392832] .= ('i:' . $_obf_0D34183E1B322B092E1A27143E32090127305C1A031332 . ';i:' . $rsym . ';');
                                }
                            }
                            $_obf_0D27292F083E091D250B0C3C0C2E33053F120B3D0D3C32[2] .= ('i:36;i:' . $reels['reel3'][2] . ';i:37;i:' . $reels['reel3'][1] . ';i:38;i:' . $reels['reel3'][0] . ';i:39;i:6;}');
                            $_obf_0D27292F083E091D250B0C3C0C2E33053F120B3D0D3C32[3] .= ('i:56;i:' . $reels['reel4'][2] . ';i:57;i:' . $reels['reel4'][1] . ';i:58;i:' . $reels['reel4'][0] . ';i:59;i:6;}');
                            $_obf_0D27292F083E091D250B0C3C0C2E33053F120B3D0D3C32[4] .= ('i:76;i:' . $reels['reel5'][2] . ';i:77;i:' . $reels['reel5'][1] . ';i:78;i:' . $reels['reel5'][0] . ';i:79;i:6;}');
                            for( $rr = $r + 1; $rr <= 5; $rr++ ) 
                            {
                                $_obf_0D2940333D0C363D313F102B310E2F03261A2B0B043832[$rr - 1] = 's:1:"' . $rid[$rr - 1] . '";i:1;';
                                $_obf_0D282A3E130518100418230D042B0A2B400930193F3232[$rr - 1] = $_obf_0D27292F083E091D250B0C3C0C2E33053F120B3D0D3C32[$rr - 1];
                            }
                            $_obf_0D3B063103133128080B0A2C1717321B39062F36343B01 = -5;
                        }
                    }
                    $_obf_0D3D251B0131372F2D163D08183F38020F3D1B01110632 = 'a:5:{' . implode('', $_obf_0D2940333D0C363D313F102B310E2F03261A2B0B043832) . '}';
                    $_obf_0D1F3E3D360D1D0B1C29190A291A383027270C17012D01 = 'a:5:{' . implode('', $_obf_0D26380D1A112E100F391706363219403B191038183701) . '}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:10:"spinresult";s:5:"value";a:48:{s:8:"winCoins";i:' . ($totalWin * 100) . ';s:8:"winLines";' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . 's:13:"winLinesCount";i:' . $_obf_0D15135C211C1F15172A3D0D31233F2B1A3F1231270411 . ';s:10:"winPerLine";' . $_obf_0D3B1722331D5C263B15293215380E1F3B1B071F100E32 . 's:12:"winFGPerLine";b:0;s:13:"bonusWinLines";b:0;s:15:"bonusWinPerLine";b:0;s:11:"bonusSymbol";' . $_obf_0D5C2C15321F2B353F25061A361C221E26010E16122122 . 's:11:"fiveOfAKind";b:0;s:9:"freeGames";i:' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . ';s:11:"actFreegame";i:' . $_obf_0D303824321032022116072C3F3F1A2225350B2B261611 . ';s:12:"maxFreegames";i:' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ';s:11:"freegameWin";i:' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . ';s:10:"isFreeGame";b:' . $_obf_0D2433275B04240E5C2B30283B045C37031B063C342E22 . ';s:12:"wonFreegames";i:' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ';s:11:"playerCoins";i:' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ';s:9:"winFactor";d:' . ceil($totalWin / $allbet) . ';s:3:"x25";b:0;s:11:"symbolAnims";' . $_obf_0D4024053D1B0C30062D1523193E0210230C385B3D2911 . 's:9:"blockAnim";b:0;s:12:"blockAnimPos";b:0;s:15:"actWinFreegames";b:0;s:19:"freeGamesAnimations";b:0;s:13:"replaceSymbol";b:0;s:9:"multiData";b:0;s:10:"totalMulti";b:0;s:8:"maxiplay";b:0;s:18:"additionalWinAnims";b:0;s:10:"multiLines";b:0;s:15:"specSymbolAnims";b:0;s:16:"extraTeaserReels";b:0;s:11:"stickyReels";b:0;s:12:"newStickyPos";b:0;s:19:"playRandomRetrigger";b:0;s:19:"wildSymbolPositions";b:0;s:12:"bonusSymbols";b:0;s:13:"isBookFeature";b:0;s:12:"actFreeRound";i:0;s:13:"maxFreeRounds";i:0;s:12:"freeRoundWin";i:0;s:14:"attentionSpins";' . $_obf_0D3D251B0131372F2D163D08183F38020F3D1B01110632 . 's:11:"teaserReels";' . $_obf_0D1F3E3D360D1D0B1C29190A291A383027270C17012D01 . 's:13:"amountSymbols";a:5:{s:1:"a";i:8;s:1:"b";i:12;s:1:"c";i:16;s:1:"d";i:20;s:1:"e";i:24;}s:17:"reel_a_symboldata";' . $_obf_0D282A3E130518100418230D042B0A2B400930193F3232[0] . 's:17:"reel_b_symboldata";' . $_obf_0D282A3E130518100418230D042B0A2B400930193F3232[1] . 's:17:"reel_c_symboldata";' . $_obf_0D282A3E130518100418230D042B0A2B400930193F3232[2] . 's:17:"reel_d_symboldata";' . $_obf_0D282A3E130518100418230D042B0A2B400930193F3232[3] . 's:17:"reel_e_symboldata";' . $_obf_0D282A3E130518100418230D042B0A2B400930193F3232[4] . '}}}}';
                    break;
                case 'initGambleCard':
                    $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    if( !$slotSettings->HasGameData($slotSettings->slotId . 'CardsHistory') ) 
                    {
                        $_obf_0D142E08093D131A0B34343F12300E1C0A3839171A0B22 = [
                            's:4:"club";', 
                            's:4:"club";', 
                            's:4:"club";', 
                            's:4:"club";', 
                            's:4:"club";', 
                            's:5:"heart";', 
                            's:5:"heart";', 
                            's:5:"heart";', 
                            's:5:"heart";', 
                            's:5:"heart";'
                        ];
                        shuffle($_obf_0D142E08093D131A0B34343F12300E1C0A3839171A0B22);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CardsHistory', $_obf_0D142E08093D131A0B34343F12300E1C0A3839171A0B22);
                    }
                    $_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11 = $slotSettings->GetGameData($slotSettings->slotId . 'CardsHistory');
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:14:"initGambleCard";s:5:"value";a:4:{s:3:"bet";i:' . ($_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 * 100) . ';s:12:"collectedWin";i:0;s:7:"history";a:5:{i:0;' . $_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11[0] . 'i:1;' . $_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11[1] . 'i:2;' . $_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11[2] . 'i:3;' . $_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11[3] . 'i:4;' . $_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11[4] . '}s:13:"pulseInterval";i:545;}}}}';
                    break;
                case 'initGambleLadder':
                    $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    $bet = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentBet');
                    $LadderStep = -1;
                    $LadderStep0 = 0;
                    $LadderStep1 = 0;
                    $_obf_0D5C3E11303C1E0B101B15240E130C042D0E3926102322 = $slotSettings->gambleLadder;
                    $_obf_0D273B27192C3726020A3F0438372C1F3C2B3D3B040E22 = '';
                    for( $i = 0; $i < count($_obf_0D5C3E11303C1E0B101B15240E130C042D0E3926102322); $i++ ) 
                    {
                        if( $_obf_0D5C3E11303C1E0B101B15240E130C042D0E3926102322[$i] < 0 ) 
                        {
                            $_obf_0D273B27192C3726020A3F0438372C1F3C2B3D3B040E22 .= ('i:' . $i . ';b:0;');
                        }
                        else
                        {
                            $_obf_0D273B27192C3726020A3F0438372C1F3C2B3D3B040E22 .= ('i:' . $i . ';i:' . ($bet * $_obf_0D5C3E11303C1E0B101B15240E130C042D0E3926102322[$i] * 100) . ';');
                            if( $bet * $_obf_0D5C3E11303C1E0B101B15240E130C042D0E3926102322[$i] < $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 && $_obf_0D5C3E11303C1E0B101B15240E130C042D0E3926102322[$i] >= 0 ) 
                            {
                                $LadderStep = -1;
                                $LadderStep1 = $i + 1;
                            }
                            else if( $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 == ($bet * $_obf_0D5C3E11303C1E0B101B15240E130C042D0E3926102322[$i]) && $_obf_0D5C3E11303C1E0B101B15240E130C042D0E3926102322[$i] >= 0 ) 
                            {
                                $LadderStep = $i;
                            }
                        }
                    }
                    if( $LadderStep <= 4 && $LadderStep >= 0 ) 
                    {
                        $LadderStep0 = 0;
                        $LadderStep1 = $LadderStep + 1;
                    }
                    else if( $LadderStep <= 10 && $LadderStep >= 0 ) 
                    {
                        if( $LadderStep == 6 ) 
                        {
                            $LadderStep0 = 4;
                            $LadderStep1 = $LadderStep + 1;
                        }
                        else
                        {
                            $LadderStep0 = 6;
                            $LadderStep1 = $LadderStep + 1;
                        }
                    }
                    else if( $LadderStep <= 14 && $LadderStep >= 0 ) 
                    {
                        if( $LadderStep == 12 ) 
                        {
                            $LadderStep0 = 10;
                            $LadderStep1 = $LadderStep + 1;
                        }
                        else
                        {
                            $LadderStep0 = 6;
                            $LadderStep1 = $LadderStep + 1;
                        }
                    }
                    if( $LadderStep1 <= 4 && $LadderStep < 0 ) 
                    {
                        $LadderStep0 = $LadderStep1 - 1;
                    }
                    else if( $LadderStep1 <= 10 && $LadderStep < 0 ) 
                    {
                        if( $LadderStep1 == 6 ) 
                        {
                            $LadderStep0 = 4;
                        }
                        else
                        {
                            $LadderStep0 = $LadderStep1 - 1;
                        }
                    }
                    else if( $LadderStep1 <= 14 && $LadderStep < 0 ) 
                    {
                        if( $LadderStep1 == 12 ) 
                        {
                            $LadderStep0 = 10;
                        }
                        else
                        {
                            $LadderStep0 = $LadderStep1 - 1;
                        }
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'LadderStep', $LadderStep);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LadderStep0', $LadderStep0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LadderStep1', $LadderStep1);
                    $slotSettings->SetGameData($slotSettings->slotId . 'СollectedWin', 0);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:16:"initGambleLadder";s:5:"value";a:6:{s:3:"bet";i:' . ($_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 * 100) . ';s:13:"allStepValues";a:15:{' . $_obf_0D273B27192C3726020A3F0438372C1F3C2B3D3B040E22 . '}s:10:"multiplier";i:1;s:11:"currentStep";i:' . $LadderStep . ';s:7:"winStep";i:' . $LadderStep1 . ';s:8:"loseStep";i:' . $LadderStep0 . ';}}}}';
                    break;
                case 'splitGambleWin':
                    $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    $bet = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentBet');
                    $LadderStep = $slotSettings->GetGameData($slotSettings->slotId . 'LadderStep');
                    $LadderStep0 = $slotSettings->GetGameData($slotSettings->slotId . 'LadderStep0');
                    $LadderStep1 = $slotSettings->GetGameData($slotSettings->slotId . 'LadderStep1');
                    $_obf_0D305B1F2B3501143C0631090117121B3C02041E0F3032 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['inLadderMode'];
                    if( $_obf_0D305B1F2B3501143C0631090117121B3C02041E0F3032 ) 
                    {
                        $_obf_0D5C3E11303C1E0B101B15240E130C042D0E3926102322 = $slotSettings->gambleLadder;
                        $LadderStep--;
                        if( $LadderStep == 5 || $LadderStep == 11 ) 
                        {
                            $LadderStep--;
                        }
                        if( $LadderStep == 6 ) 
                        {
                            $LadderStep0 = 0;
                            $LadderStep1 = 7;
                        }
                        else if( $LadderStep == 12 ) 
                        {
                            $LadderStep0 = 6;
                            $LadderStep1 = 13;
                        }
                        else
                        {
                            $LadderStep0 = $LadderStep - 1;
                            $LadderStep1 = $LadderStep + 1;
                        }
                        $_obf_0D050C0A0714302927250A3032043F18131607041D0211 = $_obf_0D5C3E11303C1E0B101B15240E130C042D0E3926102322[$LadderStep];
                        $_obf_0D132D5C32333F5B2F2A29110110391A1E282232243122 = $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 - ($bet * $_obf_0D050C0A0714302927250A3032043F18131607041D0211);
                        $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 = $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 - $_obf_0D132D5C32333F5B2F2A29110110391A1E282232243122;
                        $slotSettings->SetGameData($slotSettings->slotId . 'LadderStep', $LadderStep);
                        $slotSettings->SetGameData($slotSettings->slotId . 'LadderStep0', $LadderStep0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'LadderStep1', $LadderStep1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01);
                        $slotSettings->SetGameData($slotSettings->slotId . 'СollectedWin', $slotSettings->GetGameData($slotSettings->slotId . 'СollectedWin') + $_obf_0D132D5C32333F5B2F2A29110110391A1E282232243122);
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:14:"splitGambleWin";s:5:"value";a:6:{s:3:"bet";i:' . ($_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 * 100) . ';s:12:"collectedWin";i:' . ($slotSettings->GetGameData($slotSettings->slotId . 'СollectedWin') * 100) . ';s:10:"multiplier";i:1;s:11:"currentStep";i:' . $LadderStep . ';s:7:"winStep";i:' . $LadderStep1 . ';s:8:"loseStep";i:' . $LadderStep0 . ';}}}}';
                    }
                    else
                    {
                        if( $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 <= 0.01 ) 
                        {
                            exit();
                        }
                        $_obf_0D132D5C32333F5B2F2A29110110391A1E282232243122 = sprintf('%01.2f', $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 / 2);
                        $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 = sprintf('%01.2f', $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 - $_obf_0D132D5C32333F5B2F2A29110110391A1E282232243122);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01);
                        $slotSettings->SetGameData($slotSettings->slotId . 'СollectedWin', $slotSettings->GetGameData($slotSettings->slotId . 'СollectedWin') + $_obf_0D132D5C32333F5B2F2A29110110391A1E282232243122);
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:14:"splitGambleWin";s:5:"value";a:2:{s:3:"bet";i:' . ($_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 * 100) . ';s:12:"collectedWin";i:' . ($slotSettings->GetGameData($slotSettings->slotId . 'СollectedWin') * 100) . ';}}}}';
                    }
                    break;
                case 'takeGambleWin':
                    $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:13:"takeGambleWin";s:5:"value";a:2:{s:9:"gambleWin";i:' . ($_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 * 100) . ';s:11:"playerCoins";i:' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ';}}}}';
                    break;
                case 'gambleLadder':
                    $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    $bet = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentBet');
                    $LadderStep = $slotSettings->GetGameData($slotSettings->slotId . 'LadderStep');
                    $LadderStep0 = $slotSettings->GetGameData($slotSettings->slotId . 'LadderStep0');
                    $LadderStep1 = $slotSettings->GetGameData($slotSettings->slotId . 'LadderStep1');
                    $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 = $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01;
                    if( $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 > 0 ) 
                    {
                        $slotSettings->SetBalance(-1 * $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01);
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01);
                    }
                    else
                    {
                        exit();
                    }
                    $doubleWin = rand(1, 2);
                    $_obf_0D2B0E2E0C01360D0B293D1A3F0D063C2C0F1B3C1F1E01 = '';
                    $_obf_0D5C3E11303C1E0B101B15240E130C042D0E3926102322 = $slotSettings->gambleLadder;
                    $_obf_0D0D1B3D290F0C362C0A28030631281509023708195B32 = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    $_obf_0D0B0B282B3E2D1F0D233D142C0F230D0C37210B292832 = $LadderStep1;
                    if( $_obf_0D0B0B282B3E2D1F0D233D142C0F230D0C37210B292832 == 5 || $_obf_0D0B0B282B3E2D1F0D233D142C0F230D0C37210B292832 == 11 ) 
                    {
                        $_obf_0D0B0B282B3E2D1F0D233D142C0F230D0C37210B292832 += 2;
                    }
                    if( $_obf_0D0D1B3D290F0C362C0A28030631281509023708195B32 < ($_obf_0D5C3E11303C1E0B101B15240E130C042D0E3926102322[$_obf_0D0B0B282B3E2D1F0D233D142C0F230D0C37210B292832] * $bet) ) 
                    {
                        $doubleWin = 0;
                    }
                    if( $doubleWin == 1 ) 
                    {
                        $LadderStep = $_obf_0D0B0B282B3E2D1F0D233D142C0F230D0C37210B292832;
                        $LadderStep0 = $LadderStep - 1;
                        $LadderStep1 = $LadderStep + 1;
                    }
                    else
                    {
                        $LadderStep = $LadderStep0;
                        if( $LadderStep == 6 ) 
                        {
                            $LadderStep0 = 0;
                            $LadderStep1 = 7;
                        }
                        else if( $LadderStep == 12 ) 
                        {
                            $LadderStep0 = 6;
                            $LadderStep1 = 13;
                        }
                        else
                        {
                            $LadderStep0 = $LadderStep - 1;
                            $LadderStep1 = $LadderStep + 1;
                        }
                    }
                    $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 = $_obf_0D5C3E11303C1E0B101B15240E130C042D0E3926102322[$LadderStep] * $bet;
                    if( $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 > 0 ) 
                    {
                        $slotSettings->SetBalance($_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01);
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01);
                    }
                    else
                    {
                        $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 = -1 * $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01;
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'LadderStep', $LadderStep);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LadderStep0', $LadderStep0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LadderStep1', $LadderStep1);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:18:"gambleLadderResult";s:5:"value";a:9:{s:10:"multiplier";i:1;s:11:"currentStep";i:' . $LadderStep . ';s:7:"winStep";i:' . $LadderStep1 . ';s:8:"loseStep";i:' . $LadderStep0 . ';s:3:"bet";i:' . ($_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 * 100) . ';s:12:"collectedWin";i:' . ($slotSettings->GetGameData($slotSettings->slotId . 'СollectedWin') * 100) . ';s:3:"win";b:0;s:14:"matchedDrawOut";a:2:{i:5;b:0;i:11;b:0;}s:9:"actGamble";i:0;}}}}';
                    $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"gambleResult","serverResponse":{"totalWin":' . $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 . '}}';
                    $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, $_obf_0D1F331E12153F33093F052D063409092F141D252C3411, 1, $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01, 'slotGamble2');
                    break;
                case 'gambleCard':
                    $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    $_obf_0D1F331E12153F33093F052D063409092F141D252C3411 = $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01;
                    $gambleChoice = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['choice'];
                    $doubleWin = rand(1, 2);
                    $_obf_0D2B0E2E0C01360D0B293D1A3F0D063C2C0F1B3C1F1E01 = '';
                    $_obf_0D0D1B3D290F0C362C0A28030631281509023708195B32 = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    if( $_obf_0D0D1B3D290F0C362C0A28030631281509023708195B32 < ($_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 * 2) ) 
                    {
                        $doubleWin = 0;
                    }
                    if( $doubleWin == 1 ) 
                    {
                        $_obf_0D4009020C323C101B271E3902081F2C3C0F010B302522 = $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 * 2;
                        if( $gambleChoice == 'red' ) 
                        {
                            $_obf_0D2B0E2E0C01360D0B293D1A3F0D063C2C0F1B3C1F1E01 = 's:5:"heart";';
                        }
                        else
                        {
                            $_obf_0D2B0E2E0C01360D0B293D1A3F0D063C2C0F1B3C1F1E01 = 's:4:"club";';
                        }
                    }
                    else
                    {
                        if( $gambleChoice == 'black' ) 
                        {
                            $_obf_0D2B0E2E0C01360D0B293D1A3F0D063C2C0F1B3C1F1E01 = 's:5:"heart";';
                        }
                        else
                        {
                            $_obf_0D2B0E2E0C01360D0B293D1A3F0D063C2C0F1B3C1F1E01 = 's:4:"club";';
                        }
                        $_obf_0D4009020C323C101B271E3902081F2C3C0F010B302522 = 0;
                        $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 = -1 * $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01;
                    }
                    $_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11 = $slotSettings->GetGameData($slotSettings->slotId . 'CardsHistory');
                    array_pop($_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11);
                    array_unshift($_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11, $_obf_0D2B0E2E0C01360D0B293D1A3F0D063C2C0F1B3C1F1E01);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CardsHistory', $_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11);
                    if( $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 > 0 ) 
                    {
                        $slotSettings->SetBalance($_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01);
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 * 2);
                    }
                    else
                    {
                        $slotSettings->SetBalance($_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01);
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 * -1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    }
                    $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"gambleResult","serverResponse":{"totalWin":' . $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01 . '}}';
                    $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, $_obf_0D1F331E12153F33093F052D063409092F141D252C3411, 1, $_obf_0D2A0A051A06240E351C18120A0930382E1E1206250B01, 'slotGamble');
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = 'INFO$$1$$a:1:{s:7:"display";a:1:{i:0;a:2:{s:4:"type";s:16:"gambleCardResult";s:5:"value";a:6:{s:4:"card";' . $_obf_0D2B0E2E0C01360D0B293D1A3F0D063C2C0F1B3C1F1E01 . 's:3:"bet";i:' . ($_obf_0D4009020C323C101B271E3902081F2C3C0F010B302522 * 100) . ';s:12:"collectedWin";i:0;s:9:"actGamble";i:1;s:7:"history";a:5:{i:0;' . $_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11[0] . 'i:1;' . $_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11[1] . 'i:2;' . $_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11[2] . 'i:3;' . $_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11[3] . 'i:4;' . $_obf_0D155C3D2306230D0F1A15300531012B393229260D2F11[4] . '}s:10:"quitGamble";b:0;}}}}';
                    break;
            }
            if( !isset($_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0]) ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"Invalid request state"}';
                exit( $response );
            }
            $response = $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0];
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
