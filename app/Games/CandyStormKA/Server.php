<?php 
namespace VanguardLTE\Games\CandyStormKA
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
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = '';
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] == 'bet' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet']['gameCommand'] == 'collect' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] = 'collect';
            }
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = (string)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'];
            switch( $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 ) 
            {
                case 'startGame':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    for( $i = 0; $i < count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] * 100;
                    }
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $reels = $lastEvent->serverResponse->reelsSymbols;
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '' . rand(0, 6) . ',' . $reels->reel1[0] . ',' . $reels->reel1[1] . ',' . $reels->reel1[2] . ',' . rand(0, 6);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ($reels->reel1[2] . ',' . $reels->reel2[2] . ',' . $reels->reel3[2] . ',' . $reels->reel4[2] . ',' . $reels->reel5[2]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',' . $reels->reel1[1] . ',' . $reels->reel2[1] . ',' . $reels->reel3[1] . ',' . $reels->reel4[1] . ',' . $reels->reel5[1]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',' . $reels->reel1[0] . ',' . $reels->reel2[0] . ',' . $reels->reel3[0] . ',' . $reels->reel4[0] . ',' . $reels->reel5[0]);
                        $lines = $lastEvent->serverResponse->slotLines;
                        $bet = $lastEvent->serverResponse->slotBet * 100;
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                        {
                        }
                    }
                    else
                    {
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6);
                        $lines = 10;
                        $bet = $slotSettings->Bet[0] * 100;
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                    {
                        $_obf_0D3D2721080C3B372A0C403C2A0D1F093124103E1C0422 = 1;
                        $_obf_0D3E242D3C395C18220C29333636375C152728333D0332 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $fs = 'true';
                        $rd = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $_obf_0D2207030C311933271F08142B19010D35391119151D22 = $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100;
                    }
                    else
                    {
                        $rd = 0;
                        $fs = 'false';
                        $_obf_0D3D2721080C3B372A0C403C2A0D1F093124103E1C0422 = 0;
                        $_obf_0D3E242D3C395C18220C29333636375C152728333D0332 = 0;
                        $_obf_0D2207030C311933271F08142B19010D35391119151D22 = 0;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"sgr":{"gn":"TRex","lsd":{"sid":' . rand(0, 9999999) . ',"tid":"061db09bc959482288e9452d7eb2bbda","sel":' . $lines . ',"cps":5,"dn":0.01,"nd":0.01,"ncps":0,"atb":0,"v":true,"fs":' . $fs . ',"twg":' . ($lines * $bet) . ',"swm":0,"sw":0,"swu":0,"tw":0,"fsw":0,"fsr":' . $_obf_0D3E242D3C395C18220C29333636375C152728333D0332 . ',"tfw":' . $_obf_0D2207030C311933271F08142B19010D35391119151D22 . ',"st":[' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . '],"swi":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"snm":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"ssm":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"sm":[2,1,0,0,0,0,0,0],"acb":' . $_obf_0D3D2721080C3B372A0C403C2A0D1F093124103E1C0422 . ',"rf":0,"as":[],"sp":0,"cr":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cr'] . '","rd":' . $rd . ',"pbb":0,"obb":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"mb":false,"pwa":0},"drs":[[' . implode(',', $slotSettings->reelStrip1) . '],[' . implode(',', $slotSettings->reelStrip2) . '],[' . implode(',', $slotSettings->reelStrip3) . '],[' . implode(',', $slotSettings->reelStrip4) . '],[' . implode(',', $slotSettings->reelStrip5) . ']],"pt":[[0,0,0,0,0],[0,0,50,150,250],[0,0,20,80,200],[0,0,10,25,80],[0,0,5,20,50],[0,0,5,15,25],[0,0,4,10,20],[0,0,3,8,15]],"cps":[1,2,3,5,10,15,20,25,30,50,75,100,150,250,500],"e":false,"ec":0,"cc":""},"un":"accessKey|' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cr'] . '|52967038","bl":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"gn":"TRex","lgn":"The King of Dinosaurs","gv":0,"fs":' . $fs . ',"si":"ac7df4a24f4f441896ec13a994b7b178","dn":[0.01,0.05,0.1,0.25,0.5,1.0,2.0],"cs":"$","cd":2,"cp":true,"gs":",","ds":".","ase":[50],"gm":0,"mi":-1,"cud":0.01,"cup":[' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '],"mm":0,"e":false,"ec":0,"cc":"RU"}';
                    break;
                case 'ping':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"v":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"e":false,"ec":0,"cc":"EN"}';
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
                        1, 
                        3, 
                        2
                    ];
                    $linesId[8] = [
                        2, 
                        1, 
                        3, 
                        1, 
                        2
                    ];
                    $linesId[9] = [
                        1, 
                        3, 
                        3, 
                        3, 
                        1
                    ];
                    $lines = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['sel'];
                    $betline = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cps'] / 100;
                    $allbet = $betline * $lines;
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                    }
                    if( $allbet <= 0.0001 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetBalance() < $allbet ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid balance"}';
                        exit( $response );
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                    {
                        if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                        {
                            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                        }
                        $slotSettings->SetBalance(-1 * $allbet, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $allbet / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $slotSettings->UpdateJackpots($allbet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
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
                        $cWins = [];
                        $_obf_0D243D303F2535360506093008312D1A1A5B022D070232 = [];
                        $_obf_0D11393B38130D38112E2A01373F0A5C34211932123911 = [];
                        $_obf_0D39133F141804372B310E173B14081532311D391F3022 = 0;
                        $_obf_0D363B0913252E1F1B18010401270B2E1035362B3C2F22 = [];
                        $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011 = [];
                        $_obf_0D3034043F39122D3C3307360A2B3E023721042B3C1901 = [];
                        $_obf_0D041538230727253B2F23180F1109241E31272A3D1D22 = [];
                        $wild = ['0'];
                        $scatter = '11';
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        for( $k = 0; $k < $lines; $k++ ) 
                        {
                            $cWins[$k] = 0;
                            $_obf_0D243D303F2535360506093008312D1A1A5B022D070232[$k] = 1;
                            $_obf_0D11393B38130D38112E2A01373F0A5C34211932123911[$k] = 1;
                            $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] = 0;
                            $_obf_0D3034043F39122D3C3307360A2B3E023721042B3C1901[$k] = 1;
                            $_obf_0D041538230727253B2F23180F1109241E31272A3D1D22[$k] = 1;
                        }
                        $_obf_0D1B1902361A300F1C162B0D3C1A281D362F281E250811 = $reels;
                        $_obf_0D1A160635373E1B3E2C06193C0B1201161D14102E1C22 = [
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0
                        ];
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $p = 0; $p <= 2; $p++ ) 
                            {
                                if( $reels['reel' . $r][$p] == '0' ) 
                                {
                                    $reels['reel' . $r][0] = '0';
                                    $reels['reel' . $r][1] = '0';
                                    $reels['reel' . $r][2] = '0';
                                    $_obf_0D1A160635373E1B3E2C06193C0B1201161D14102E1C22[$r] = 1;
                                    break;
                                }
                            }
                        }
                        $_obf_0D1103183E22072D2511390A1B145C25235C2407082111 = $reels;
                        $_obf_0D1A31365C2828323432011C290C0C32091F3709230511 = 0;
                        $p = 0;
                        if( $reels['reel2'][$p] == '0' ) 
                        {
                            $_obf_0D1A31365C2828323432011C290C0C32091F3709230511 = 2;
                        }
                        if( $reels['reel3'][$p] == '0' ) 
                        {
                            $_obf_0D1A31365C2828323432011C290C0C32091F3709230511 = 4;
                        }
                        if( $reels['reel4'][$p] == '0' ) 
                        {
                            $_obf_0D1A31365C2828323432011C290C0C32091F3709230511 = 8;
                        }
                        if( $reels['reel2'][$p] == '0' && $reels['reel3'][$p] == '0' ) 
                        {
                            $_obf_0D1A31365C2828323432011C290C0C32091F3709230511 = 6;
                        }
                        if( $reels['reel2'][$p] == '0' && $reels['reel4'][$p] == '0' ) 
                        {
                            $_obf_0D1A31365C2828323432011C290C0C32091F3709230511 = 10;
                        }
                        if( $reels['reel3'][$p] == '0' && $reels['reel4'][$p] == '0' ) 
                        {
                            $_obf_0D1A31365C2828323432011C290C0C32091F3709230511 = 12;
                        }
                        if( $reels['reel2'][$p] == '0' && $reels['reel3'][$p] == '0' && $reels['reel4'][$p] == '0' ) 
                        {
                            $_obf_0D1A31365C2828323432011C290C0C32091F3709230511 = 14;
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"line":' . $k . ',"winAmount":' . ($cWins[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . '],"freespins":0,"card":' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '}';
                                            $_obf_0D243D303F2535360506093008312D1A1A5B022D070232[$k] = 3;
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"line":' . $k . ',"winAmount":' . ($cWins[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . ',2,' . ($linesId[$k][2] - 1) . '],"freespins":0,"card":' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '}';
                                            $_obf_0D243D303F2535360506093008312D1A1A5B022D070232[$k] = 7;
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"line":' . $k . ',"winAmount":' . ($cWins[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . ',2,' . ($linesId[$k][2] - 1) . ',3,' . ($linesId[$k][3] - 1) . '],"freespins":0,"card":' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '}';
                                            $_obf_0D243D303F2535360506093008312D1A1A5B022D070232[$k] = 15;
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
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"line":' . $k . ',"winAmount":' . ($cWins[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . ',2,' . ($linesId[$k][2] - 1) . ',3,' . ($linesId[$k][3] - 1) . ',4,' . ($linesId[$k][4] - 1) . '],"freespins":0,"card":' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '}';
                                            $_obf_0D243D303F2535360506093008312D1A1A5B022D070232[$k] = 31;
                                        }
                                    }
                                }
                            }
                            if( $cWins[$k] > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                            {
                                $_obf_0D11393B38130D38112E2A01373F0A5C34211932123911[$k] = $bonusMpl;
                                array_push($lineWins, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                                $totalWin += $cWins[$k];
                                $cWins[$k] = $cWins[$k] / $bonusMpl;
                            }
                        }
                        if( $_obf_0D1A31365C2828323432011C290C0C32091F3709230511 > 0 ) 
                        {
                            $_obf_0D055B17133B091A0F3B392E04070119262C353F042832 = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                if( $_obf_0D1A160635373E1B3E2C06193C0B1201161D14102E1C22[$r] == 1 ) 
                                {
                                    $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel' . $r][0] = '0';
                                    $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel' . $r][1] = '0';
                                    $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel' . $r][2] = '0';
                                }
                            }
                            for( $k = 0; $k < $lines; $k++ ) 
                            {
                                $_obf_0D11160A241933040412293F080D15240E1B3D03353B32 = '';
                                for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                                {
                                    $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = (string)$slotSettings->SymbolGame[$j];
                                    if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $scatter || !isset($slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132]) ) 
                                    {
                                    }
                                    else
                                    {
                                        $s = [];
                                        $s[0] = $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel1'][$linesId[$k][0] - 1];
                                        $s[1] = $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel2'][$linesId[$k][1] - 1];
                                        $s[2] = $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel3'][$linesId[$k][2] - 1];
                                        $s[3] = $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel4'][$linesId[$k][3] - 1];
                                        $s[4] = $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel5'][$linesId[$k][4] - 1];
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
                                            if( $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                            {
                                                $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                                $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"line":' . $k . ',"winAmount":' . ($_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . '],"freespins":0,"card":' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '}';
                                                $_obf_0D5C38080E1623271231102A0E0C1E35332B1133240501[$k] = 3;
                                            }
                                        }
                                        if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) ) 
                                        {
                                            $mpl = 1;
                                            $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $betline * $mpl * $bonusMpl;
                                            if( $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                            {
                                                $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                                $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"line":' . $k . ',"winAmount":' . ($_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . ',2,' . ($linesId[$k][2] - 1) . '],"freespins":0,"card":' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '}';
                                                $_obf_0D5C38080E1623271231102A0E0C1E35332B1133240501[$k] = 7;
                                            }
                                        }
                                        if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) ) 
                                        {
                                            $mpl = 1;
                                            $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $betline * $mpl * $bonusMpl;
                                            if( $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                            {
                                                $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                                $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"line":' . $k . ',"winAmount":' . ($_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . ',2,' . ($linesId[$k][2] - 1) . ',3,' . ($linesId[$k][3] - 1) . '],"freespins":0,"card":' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '}';
                                                $_obf_0D5C38080E1623271231102A0E0C1E35332B1133240501[$k] = 15;
                                            }
                                        }
                                        if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) && ($s[4] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[4], $wild)) ) 
                                        {
                                            $mpl = 1;
                                            $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $betline * $mpl * $bonusMpl;
                                            if( $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                            {
                                                $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                                $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"line":' . $k . ',"winAmount":' . ($_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . ',2,' . ($linesId[$k][2] - 1) . ',3,' . ($linesId[$k][3] - 1) . ',4,' . ($linesId[$k][4] - 1) . '],"freespins":0,"card":' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '}';
                                                $_obf_0D5C38080E1623271231102A0E0C1E35332B1133240501[$k] = 31;
                                            }
                                        }
                                    }
                                }
                                if( $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k] > 0 && $_obf_0D11160A241933040412293F080D15240E1B3D03353B32 != '' ) 
                                {
                                    array_push($_obf_0D363B0913252E1F1B18010401270B2E1035362B3C2F22, $_obf_0D11160A241933040412293F080D15240E1B3D03353B32);
                                    $_obf_0D39133F141804372B310E173B14081532311D391F3022 += $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$k];
                                }
                            }
                        }
                        $_obf_0D235C172C232113343C2D32320A361D3B3F3430373C22 = $totalWin;
                        $totalWin += $_obf_0D39133F141804372B310E173B14081532311D391F3022;
                        $scattersWin = 0;
                        $scattersStr = '';
                        $scattersCount = 0;
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
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    }
                    $fs = 0;
                    $_obf_0D271526050C14371508061C1D40060F233C35263B3B01 = 0;
                    $_obf_0D2722011B2C34273F323035330D123F2706282E131932 = 0;
                    if( $scattersCount >= 3 ) 
                    {
                        $_obf_0D2722011B2C34273F323035330D123F2706282E131932 = $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[2] + (32 * $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[1]) + (1024 * $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[0]);
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $slotSettings->slotFreeCount[$scattersCount]);
                        }
                        else
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount[$scattersCount]);
                        }
                        $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $_obf_0D271526050C14371508061C1D40060F233C35263B3B01 = 1;
                    }
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                    $reels = $_obf_0D1B1902361A300F1C162B0D3C1A281D362F281E250811;
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '';
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ($reels['reel1'][2] . ',' . $reels['reel2'][2] . ',' . $reels['reel3'][2] . ',' . $reels['reel4'][2] . ',' . $reels['reel5'][2]);
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',' . $reels['reel1'][1] . ',' . $reels['reel2'][1] . ',' . $reels['reel3'][1] . ',' . $reels['reel4'][1] . ',' . $reels['reel5'][1]);
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',' . $reels['reel1'][0] . ',' . $reels['reel2'][0] . ',' . $reels['reel3'][0] . ',' . $reels['reel4'][0] . ',' . $reels['reel5'][0]);
                    $_obf_0D1B5B1F362C3D1B1C14161B2D27035B360A3214381911 = '';
                    $_obf_0D1B5B1F362C3D1B1C14161B2D27035B360A3214381911 .= ($_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel1'][2] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel2'][2] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel3'][2] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel4'][2] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel5'][2]);
                    $_obf_0D1B5B1F362C3D1B1C14161B2D27035B360A3214381911 .= (',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel1'][1] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel2'][1] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel3'][1] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel4'][1] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel5'][1]);
                    $_obf_0D1B5B1F362C3D1B1C14161B2D27035B360A3214381911 .= (',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel1'][0] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel2'][0] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel3'][0] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel4'][0] . ',' . $_obf_0D1103183E22072D2511390A1B145C25235C2407082111['reel5'][0]);
                    $_obf_0D3D2721080C3B372A0C403C2A0D1F093124103E1C0422 = 0;
                    $_obf_0D380B2515180F1C2C170B075B0A392209351C07312C32 = 'false';
                    if( $winType == 'bonus' ) 
                    {
                        $_obf_0D3D2721080C3B372A0C403C2A0D1F093124103E1C0422 = 1;
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D380B2515180F1C2C170B075B0A392209351C07312C32 = 'true';
                        $_obf_0D3D2721080C3B372A0C403C2A0D1F093124103E1C0422 = 1;
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') > 0 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin'));
                        }
                    }
                    for( $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01 = 0; $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01 < count($cWins); $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01++ ) 
                    {
                        $_obf_0D1432010D2B5B25344012133611322511253B0D401D22[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01] = $cWins[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01] * 100;
                    }
                    for( $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01 = 0; $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01 < count($_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011); $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01++ ) 
                    {
                        $_obf_0D032F270F0701160723401B5B1F031F1A193423091E11[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01] = $_obf_0D1F3921401608132D25080B0D0B32143213093B3E3011[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01] * 100;
                    }
                    $_obf_0D06130C3D353902081217172123151E250923172E1932 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    $_obf_0D1F12315B03241B102B0833212F2A2F312D0110050801 = '';
                    if( $_obf_0D1A31365C2828323432011C290C0C32091F3709230511 > 0 ) 
                    {
                        $_obf_0D301F2D3F26263D39012E39232B11392C2D325C0E3311 = '';
                        $_obf_0D301F2D3F26263D39012E39232B11392C2D325C0E3311 .= ($_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel1'][2] . ',' . $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel2'][2] . ',' . $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel3'][2] . ',' . $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel4'][2] . ',' . $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel5'][2]);
                        $_obf_0D301F2D3F26263D39012E39232B11392C2D325C0E3311 .= (',' . $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel1'][1] . ',' . $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel2'][1] . ',' . $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel3'][1] . ',' . $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel4'][1] . ',' . $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel5'][1]);
                        $_obf_0D301F2D3F26263D39012E39232B11392C2D325C0E3311 .= (',' . $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel1'][0] . ',' . $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel2'][0] . ',' . $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel3'][0] . ',' . $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel4'][0] . ',' . $_obf_0D055B17133B091A0F3B392E04070119262C353F042832['reel5'][0]);
                        $_obf_0D1F12315B03241B102B0833212F2A2F312D0110050801 = ',{"asi":401767241,"st":[' . $_obf_0D301F2D3F26263D39012E39232B11392C2D325C0E3311 . '],"swi":[' . implode(',', $_obf_0D032F270F0701160723401B5B1F031F1A193423091E11) . '],"snm":[' . implode(',', $_obf_0D041538230727253B2F23180F1109241E31272A3D1D22) . '],"ssm":[' . implode(',', $_obf_0D3034043F39122D3C3307360A2B3E023721042B3C1901) . '],"swm":0,"sw":0,"swu":0,"fsw":0,"sm":[' . $_obf_0D1A31365C2828323432011C290C0C32091F3709230511 . ',2],"tw":' . ($_obf_0D39133F141804372B310E173B14081532311D391F3022 * 100) . '}';
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"sid":' . rand(0, 9999999) . ',"md":{"sid":' . rand(0, 9999999) . ',"tid":"38e8ba5dc5254a5bb5c85da7b73936e4","sel":' . $lines . ',"cps":100,"dn":0.01,"nd":0.01,"ncps":0,"atb":0,"v":true,"fs":' . $_obf_0D380B2515180F1C2C170B075B0A392209351C07312C32 . ',"twg":' . ($lines * $betline * 100) . ',"swm":' . $_obf_0D2722011B2C34273F323035330D123F2706282E131932 . ',"sw":' . ($scattersWin * 100) . ',"swu":' . $_obf_0D271526050C14371508061C1D40060F233C35263B3B01 . ',"tw":' . ($_obf_0D235C172C232113343C2D32320A361D3B3F3430373C22 * 100) . ',"fsw":' . $fs . ',"fsr":' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . ',"tfw":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . ',"st":[' . $_obf_0D1B5B1F362C3D1B1C14161B2D27035B360A3214381911 . '],"swi":[' . implode(',', $_obf_0D1432010D2B5B25344012133611322511253B0D401D22) . '],"snm":[' . implode(',', $_obf_0D11393B38130D38112E2A01373F0A5C34211932123911) . '],"ssm":[' . implode(',', $_obf_0D243D303F2535360506093008312D1A1A5B022D070232) . '],"sm":[' . $_obf_0D1A31365C2828323432011C290C0C32091F3709230511 . ',2],"acb":0,"rf":0,"as":[{"asi":390563484,"st":[' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . '],"swi":[' . implode(',', $_obf_0D1432010D2B5B25344012133611322511253B0D401D22) . '],"snm":[' . implode(',', $_obf_0D11393B38130D38112E2A01373F0A5C34211932123911) . '],"ssm":[' . implode(',', $_obf_0D243D303F2535360506093008312D1A1A5B022D070232) . '],"swm":' . $_obf_0D2722011B2C34273F323035330D123F2706282E131932 . ',"sw":0,"swu":0,"fsw":0,"sm":[' . $_obf_0D1A31365C2828323432011C290C0C32091F3709230511 . ',2],"tw":' . ($_obf_0D235C172C232113343C2D32320A361D3B3F3430373C22 * 100) . '}' . $_obf_0D1F12315B03241B102B0833212F2A2F312D0110050801 . '],"sp":2,"cr":"USD","sessionId":"11a8698e57fe44479e81bc013819c967","rd":0,"pbb":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"obb":' . $_obf_0D06130C3D353902081217172123151E250923172E1932 . ',"mb":false,"pwa":0,"pac":{}},"pcr":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"cr":' . $_obf_0D06130C3D353902081217172123151E250923172E1932 . ',"xp":0,"lvl":{"lvl":1,"xp":0,"bc":0,"cps":5,"sc":200,"wb":0},"dl":0,"cps":[5,10,15,20,30,50,75,100,200,500,1000,2000,5000,10000,20000],"e":false,"ec":0,"cc":"RU"}';
                    break;
                case 'updatePlayerInfo':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"e":false,"ec":0,"cc":"EN"}';
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
