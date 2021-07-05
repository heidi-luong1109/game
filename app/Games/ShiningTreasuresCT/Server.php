<?php 
namespace VanguardLTE\Games\ShiningTreasuresCT
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
            if( !isset($_POST['request']) ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"Invalid request state"}';
                exit( $response );
            }
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = json_decode(trim($_POST['request']), true);
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[0];
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = '';
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['type']) && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] == 'continue' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['type'] == 'can_play_red_black_double' && isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key']) ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] = 'gamble';
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] == 'gamble' && $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') <= 0 ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid gamble state"}';
                exit( $response );
            }
            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01 = json_decode(trim(file_get_contents(dirname(__FILE__) . '/response_template.json')), true);
            $_obf_0D3102240F330B310406085C04251E29051F261E333832 = $_obf_0D34321010172C292A1A09211E38143C3D083803231B01;
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = (string)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'];
            switch( $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 ) 
            {
                case 'create_session':
                    $slotSettings->SetGameData('ShiningTreasuresCTCards', [
                        19, 
                        44, 
                        0, 
                        37, 
                        8, 
                        28, 
                        33
                    ]);
                    for( $i = 0; $i < count($slotSettings->Denominations); $i++ ) 
                    {
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['create_session'][0]['enabled_denoms'][] = (object)[
                            'label' => '' . sprintf('%01.2f', $slotSettings->Denominations[$i]), 
                            'id' => '' . sprintf('%01.2f', $slotSettings->Denominations[$i]), 
                            'viewLabel' => '' . $slotSettings->CurrentDenom, 
                            'value' => $slotSettings->Denominations[$i], 
                            'cents' => $slotSettings->Denominations[$i] * 100
                        ];
                    }
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['create_session'][0]['account_status']['currency'] = $slotSettings->slotCurrency;
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['create_session'][0]['account_status']['currency_code'] = $slotSettings->slotCurrency;
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = json_encode($_obf_0D34321010172C292A1A09211E38143C3D083803231B01['create_session']);
                    break;
                case 'continue':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['continue'][0]['account_status']['credit'] = round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = json_encode($_obf_0D34321010172C292A1A09211E38143C3D083803231B01['continue']);
                    break;
                case 'init_game':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData('ShiningTreasuresCTBonusWin', 0);
                    $slotSettings->SetGameData('ShiningTreasuresCTFreeGames', 0);
                    $slotSettings->SetGameData('ShiningTreasuresCTCurrentFreeGame', 0);
                    $slotSettings->SetGameData('ShiningTreasuresCTCurrentFreeGame0', 0);
                    $slotSettings->SetGameData('ShiningTreasuresCTTotalWin', 0);
                    $slotSettings->SetGameData('ShiningTreasuresCTFreeBalance', 0);
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['game_config']['game_denoms'] = [];
                    for( $i = 0; $i < count($slotSettings->Denominations); $i++ ) 
                    {
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['game_config']['game_denoms'][sprintf('%01.2f', $slotSettings->Denominations[$i])] = '' . sprintf('%01.2f', $slotSettings->Denominations[$i]);
                    }
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['game_config']['game_denoms'] = (object)$_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['game_config']['game_denoms'];
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['account_status']['credit'] = round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame0', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Results', $lastEvent->serverResponse->result);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Reels', $lastEvent->serverResponse->reelsSymbols);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->slotLines);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $lastEvent->serverResponse->slotBet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Denom', $lastEvent->serverResponse->slotDenom);
                        $reels = $lastEvent->serverResponse->reelsSymbols;
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['game_config']['init_screen'][0] = [
                            '' . $reels->reel1[0], 
                            '' . $reels->reel2[0], 
                            '' . $reels->reel3[0], 
                            '' . $reels->reel4[0], 
                            '' . $reels->reel5[0]
                        ];
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['game_config']['init_screen'][1] = [
                            '' . $reels->reel1[1], 
                            '' . $reels->reel2[1], 
                            '' . $reels->reel3[1], 
                            '' . $reels->reel4[1], 
                            '' . $reels->reel5[1]
                        ];
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['game_config']['init_screen'][2] = [
                            '' . $reels->reel1[2], 
                            '' . $reels->reel2[2], 
                            '' . $reels->reel3[2], 
                            '' . $reels->reel4[2], 
                            '' . $reels->reel5[2]
                        ];
                        $lines = $lastEvent->serverResponse->slotLines;
                        $bet = $lastEvent->serverResponse->slotBet;
                        $denom = $lastEvent->serverResponse->slotDenom;
                        if( $slotSettings->GetGameData('ShiningTreasuresCTCurrentFreeGame') < $slotSettings->GetGameData('ShiningTreasuresCTFreeGames') && $slotSettings->GetGameData('ShiningTreasuresCTFreeGames') > 0 ) 
                        {
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['game_config']['init_screen_subgame_label'] = 'free';
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['game_config']['main_subgame_label'] = 'free';
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['freeround_limit'] = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['freeround_play'] = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame0');
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['freeround_bet_per_line_cents'] = $bet * $denom * 100;
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['freeround_lines'] = $lines;
                            $denomIndex = 0;
                            for( $d = 0; $d < count($slotSettings->Denominations); $d++ ) 
                            {
                                if( $slotSettings->Denominations[$d] == $slotSettings->GetGameData($slotSettings->slotId . 'Denom') ) 
                                {
                                    $denomIndex = $d;
                                }
                            }
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['account_status']['credit'] = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['resume_game'] = (object)[
                                'extra_bet' => 0, 
                                'line_bet' => $bet / $denom, 
                                'lines' => $lines, 
                                'denomIndex' => 0, 
                                'currDenom' => [
                                    'cents' => $denom * 100, 
                                    'value' => sprintf('%01.2f', $denom), 
                                    'label' => '' . sprintf('%01.2f', $denom), 
                                    'id' => '' . sprintf('%01.2f', $denom)
                                ], 
                                'last_result' => $lastEvent->serverResponse->result, 
                                'account_status_after_bet' => $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['account_status'], 
                                'game_config' => $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['game_config'], 
                                'server_denom' => [
                                    'cents' => $denom * 100, 
                                    'value' => sprintf('%01.2f', $denom), 
                                    'label' => '' . sprintf('%01.2f', $denom), 
                                    'id' => '' . sprintf('%01.2f', $denom)
                                ], 
                                'game_denom' => '' . sprintf('%01.2f', $denom), 
                                'enabled_denoms' => [
                                    'cents' => $denom * 100, 
                                    'value' => sprintf('%01.2f', $denom), 
                                    'label' => '' . sprintf('%01.2f', $denom), 
                                    'id' => '' . sprintf('%01.2f', $denom)
                                ], 
                                'resume_subgame_index' => $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame0') + 1
                            ];
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['resume'] = true;
                        }
                    }
                    else
                    {
                        $lines = 30;
                        $bet = $slotSettings->Bet[0];
                        $denom = $slotSettings->Denominations[0];
                    }
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['game_config']['line_step_bet_numbers'] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11;
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['game_config']['line_step_bet_numbers_quick'] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11;
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['game_config']['line_max_bet'] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) - 1];
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game'][0]['game_config']['line_min_bet'] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0];
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = json_encode($_obf_0D34321010172C292A1A09211E38143C3D083803231B01['init_game']);
                    break;
                case 'poll':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    if( $slotSettings->GetGameData('ShiningTreasuresCTCurrentFreeGame') < $slotSettings->GetGameData('ShiningTreasuresCTFreeGames') && $slotSettings->GetGameData('ShiningTreasuresCTFreeGames') > 0 ) 
                    {
                        $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    }
                    else
                    {
                        $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance() - $slotSettings->GetGameData('ShiningTreasuresCTTotalWin')) * 100;
                    }
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['poll'][0]['account_status']['credit'] = (string)round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['poll'][0]['account_status']['updated_credit'] = (string)round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = json_encode($_obf_0D34321010172C292A1A09211E38143C3D083803231B01['poll']);
                    break;
                case 'game_finished':
                    $slotSettings->SetGameData('ShiningTreasuresCTBonusWin', 0);
                    $slotSettings->SetGameData('ShiningTreasuresCTTotalWin', 0);
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['game_finished'][0]['freeround_play'] = $slotSettings->GetGameData('ShiningTreasuresCTCurrentFreeGame0');
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['game_finished'][0]['account_status']['credit'] = round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['game_finished'][0]['account_status']['rgs_balance'] = round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = json_encode($_obf_0D34321010172C292A1A09211E38143C3D083803231B01['game_finished']);
                    break;
                case 'subgame_finished':
                    if( $slotSettings->GetGameData('ShiningTreasuresCTCurrentFreeGame0') < $slotSettings->GetGameData('ShiningTreasuresCTFreeGames') && $slotSettings->GetGameData('ShiningTreasuresCTFreeGames') > 0 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame0', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame0') + 1);
                        $result = $slotSettings->GetGameData($slotSettings->slotId . 'Results');
                        $lines = $slotSettings->GetGameData($slotSettings->slotId . 'Lines');
                        $betline = $slotSettings->GetGameData($slotSettings->slotId . 'Bet');
                        $denom = $slotSettings->GetGameData($slotSettings->slotId . 'Denom');
                        $cr = (array)$result[$slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame0')];
                        $totalWin = $cr['total_win'] * $denom;
                        $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $cr['win'] * $denom;
                        $totalWin = sprintf('%01.2f', $totalWin);
                        $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = sprintf('%01.2f', $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32);
                        $response = '{"responseEvent":"spin","responseType":"freespin","serverResponse":{"result":' . json_encode($result) . ',"slotDenom":' . $slotSettings->GetGameData($slotSettings->slotId . 'Denom') . ',"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData('ShiningTreasuresCTFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('ShiningTreasuresCTCurrentFreeGame0') . ',"Balance":' . $slotSettings->GetGameData('ShiningTreasuresCTFreeBalance') . ',"afterBalance":' . $slotSettings->GetGameData('ShiningTreasuresCTFreeBalance') . ',"bonusWin":' . $slotSettings->GetGameData('ShiningTreasuresCTBonusWin') . ',"totalWin":' . $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 . ',"winLines":[],"Jackpots":[],"reelsSymbols":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'Reels')) . '}}';
                        if( $slotSettings->GetGameData('ShiningTreasuresCTFreeGames') <= $slotSettings->GetGameData('ShiningTreasuresCTCurrentFreeGame0') ) 
                        {
                            if( $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 > 0 ) 
                            {
                                $slotSettings->SetBalance($_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32);
                            }
                            $slotSettings->SaveLogReport($response, 0, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, 'freespin');
                        }
                        else
                        {
                            if( $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 > 0 ) 
                            {
                                $slotSettings->SetBalance($_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32);
                            }
                            $slotSettings->SaveLogReport($response, 0, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, 'freespin');
                        }
                        $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = $slotSettings->GetGameData('ShiningTreasuresCTFreeBalance');
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['subgame_finished'][0]['account_status']['credit'] = round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['subgame_finished'][0]['freeround_play'] = $slotSettings->GetGameData('ShiningTreasuresCTCurrentFreeGame0');
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['subgame_finished'][1]['freeround_play'] = $slotSettings->GetGameData('ShiningTreasuresCTCurrentFreeGame0');
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['subgame_finished'][0]['account_status']['rgs_balance'] = round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['subgame_finished'][1]['account_status']['credit'] = round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['subgame_finished'][1]['account_status']['rgs_balance'] = round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                    }
                    else
                    {
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['subgame_finished'][0]['account_status']['credit'] = round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['subgame_finished'][0]['account_status']['rgs_balance'] = round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['subgame_finished'][1]['account_status']['credit'] = round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['subgame_finished'][1]['account_status']['rgs_balance'] = round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = json_encode($_obf_0D34321010172C292A1A09211E38143C3D083803231B01['subgame_finished']);
                    break;
                case 'play':
                    if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines']) || !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['line_bet']) || !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['game_denom']) ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    $denom = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['game_denom'];
                    $lines = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines'];
                    $betline = sprintf('%01.2f', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['line_bet'] * $denom);
                    $allbet = $betline * $lines;
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    if( $lines <= 0 || $betline <= 0.0001 || $denom <= 0.0001 || $denom > 1 || $slotSettings->GetBalance() < $allbet ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    $_obf_0D3B2A04131D2F18191C37340F3E1F161B362122233C01 = 1;
                    for( $_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32 = 0; $_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32 < $_obf_0D3B2A04131D2F18191C37340F3E1F161B362122233C01; $_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32++ ) 
                    {
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
                            1, 
                            2, 
                            3, 
                            2
                        ];
                        $linesId[8] = [
                            2, 
                            3, 
                            2, 
                            1, 
                            2
                        ];
                        $linesId[9] = [
                            1, 
                            2, 
                            1, 
                            2, 
                            1
                        ];
                        $linesId[10] = [
                            3, 
                            2, 
                            3, 
                            2, 
                            3
                        ];
                        $linesId[11] = [
                            1, 
                            2, 
                            2, 
                            2, 
                            2
                        ];
                        $linesId[12] = [
                            3, 
                            2, 
                            2, 
                            2, 
                            2
                        ];
                        $linesId[13] = [
                            2, 
                            2, 
                            1, 
                            1, 
                            1
                        ];
                        $linesId[14] = [
                            2, 
                            2, 
                            3, 
                            3, 
                            3
                        ];
                        $linesId[15] = [
                            2, 
                            1, 
                            1, 
                            1, 
                            1
                        ];
                        $linesId[16] = [
                            2, 
                            3, 
                            3, 
                            3, 
                            3
                        ];
                        $linesId[17] = [
                            1, 
                            1, 
                            1, 
                            1, 
                            2
                        ];
                        $linesId[18] = [
                            3, 
                            3, 
                            3, 
                            3, 
                            2
                        ];
                        $linesId[19] = [
                            3, 
                            3, 
                            2, 
                            3, 
                            3
                        ];
                        $linesId[20] = [
                            1, 
                            1, 
                            2, 
                            1, 
                            1
                        ];
                        $linesId[21] = [
                            1, 
                            2, 
                            2, 
                            2, 
                            1
                        ];
                        $linesId[22] = [
                            3, 
                            2, 
                            2, 
                            2, 
                            3
                        ];
                        $linesId[23] = [
                            3, 
                            1, 
                            1, 
                            1, 
                            3
                        ];
                        $linesId[24] = [
                            1, 
                            3, 
                            3, 
                            3, 
                            1
                        ];
                        $linesId[25] = [
                            1, 
                            3, 
                            1, 
                            3, 
                            1
                        ];
                        $linesId[26] = [
                            3, 
                            1, 
                            3, 
                            1, 
                            3
                        ];
                        $linesId[27] = [
                            3, 
                            1, 
                            2, 
                            1, 
                            3
                        ];
                        $linesId[28] = [
                            1, 
                            3, 
                            2, 
                            3, 
                            1
                        ];
                        $linesId[29] = [
                            2, 
                            1, 
                            1, 
                            1, 
                            2
                        ];
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
                            $slotSettings->SetGameData('ShiningTreasuresCTBonusWin', 0);
                            $slotSettings->SetGameData('ShiningTreasuresCTFreeGames', 0);
                            $slotSettings->SetGameData('ShiningTreasuresCTCurrentFreeGame', 0);
                            $slotSettings->SetGameData('ShiningTreasuresCTCurrentFreeGame0', 0);
                            $slotSettings->SetGameData('ShiningTreasuresCTTotalWin', 0);
                            $slotSettings->SetGameData('ShiningTreasuresCTFreeBalance', sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                            $slotSettings->SetGameData($slotSettings->slotId . 'Denom', $denom);
                            $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lines);
                            $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $betline);
                            $bonusMpl = 1;
                        }
                        else
                        {
                            $slotSettings->SetGameData('ShiningTreasuresCTCurrentFreeGame', $slotSettings->GetGameData('ShiningTreasuresCTCurrentFreeGame') + 1);
                            $bonusMpl = $slotSettings->slotFreeMpl;
                        }
                        $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                        $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $allbet, $lines);
                        $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                        $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
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
                            $wild = ['10'];
                            $scatter = '1';
                            $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
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
                                                $_obf_0D5C3B0D5B11143D2A3406033131021F2C5C3803402C22 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][2];
                                                $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = (object)[
                                                    'factor' => $_obf_0D5C3B0D5B11143D2A3406033131021F2C5C3803402C22, 
                                                    'msgs' => null, 
                                                    'wilds' => [], 
                                                    'symbol_count' => '2', 
                                                    'positions' => [
                                                        0, 
                                                        1
                                                    ], 
                                                    'symbols' => [
                                                        '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132, 
                                                        '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132
                                                    ], 
                                                    'paytable_factor' => $_obf_0D5C3B0D5B11143D2A3406033131021F2C5C3803402C22, 
                                                    'win' => sprintf('%01.2f', $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 / $denom), 
                                                    'symbol' => '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132, 
                                                    'subgame_win_factor' => 1, 
                                                    'line_number' => $k
                                                ];
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
                                                $_obf_0D5C3B0D5B11143D2A3406033131021F2C5C3803402C22 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3];
                                                $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = (object)[
                                                    'factor' => $_obf_0D5C3B0D5B11143D2A3406033131021F2C5C3803402C22, 
                                                    'msgs' => null, 
                                                    'wilds' => [], 
                                                    'symbol_count' => '3', 
                                                    'positions' => [
                                                        0, 
                                                        1, 
                                                        2
                                                    ], 
                                                    'symbols' => [
                                                        '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132, 
                                                        '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132, 
                                                        '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132
                                                    ], 
                                                    'paytable_factor' => $_obf_0D5C3B0D5B11143D2A3406033131021F2C5C3803402C22, 
                                                    'win' => sprintf('%01.2f', $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 / $denom), 
                                                    'symbol' => '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132, 
                                                    'subgame_win_factor' => 1, 
                                                    'line_number' => $k
                                                ];
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
                                                $_obf_0D5C3B0D5B11143D2A3406033131021F2C5C3803402C22 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4];
                                                $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = (object)[
                                                    'factor' => $_obf_0D5C3B0D5B11143D2A3406033131021F2C5C3803402C22, 
                                                    'msgs' => null, 
                                                    'wilds' => [], 
                                                    'symbol_count' => '4', 
                                                    'positions' => [
                                                        0, 
                                                        1, 
                                                        2, 
                                                        3
                                                    ], 
                                                    'symbols' => [
                                                        '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132, 
                                                        '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132, 
                                                        '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132, 
                                                        '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132
                                                    ], 
                                                    'paytable_factor' => $_obf_0D5C3B0D5B11143D2A3406033131021F2C5C3803402C22, 
                                                    'win' => sprintf('%01.2f', $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 / $denom), 
                                                    'symbol' => '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132, 
                                                    'subgame_win_factor' => 1, 
                                                    'line_number' => $k
                                                ];
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
                                                $_obf_0D5C3B0D5B11143D2A3406033131021F2C5C3803402C22 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5];
                                                $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                                $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = (object)[
                                                    'factor' => $_obf_0D5C3B0D5B11143D2A3406033131021F2C5C3803402C22, 
                                                    'msgs' => null, 
                                                    'wilds' => [], 
                                                    'symbol_count' => '5', 
                                                    'positions' => [
                                                        0, 
                                                        1, 
                                                        2, 
                                                        3, 
                                                        4
                                                    ], 
                                                    'symbols' => [
                                                        '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132, 
                                                        '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132, 
                                                        '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132, 
                                                        '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132, 
                                                        '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132
                                                    ], 
                                                    'paytable_factor' => $_obf_0D5C3B0D5B11143D2A3406033131021F2C5C3803402C22, 
                                                    'win' => sprintf('%01.2f', $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 / $denom), 
                                                    'symbol' => '' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132, 
                                                    'subgame_win_factor' => 1, 
                                                    'line_number' => $k
                                                ];
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
                            $scattersStr = '';
                            $scattersCount = 0;
                            $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [];
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                for( $p = 0; $p <= 2; $p++ ) 
                                {
                                    if( $reels['reel' . $r][$p] == $scatter ) 
                                    {
                                        $scattersCount++;
                                        $_obf_0D312B19262C083426241E0D392E22282324060B380811[] = [
                                            $p, 
                                            $r - 1
                                        ];
                                    }
                                }
                            }
                            $scattersWin = $slotSettings->Paytable['SYM_' . $scatter][$scattersCount] * $allbet;
                            if( $scattersCount >= 3 ) 
                            {
                                $scattersStr = [
                                    [
                                        'symbol' => '1', 
                                        'bonus_value' => 0, 
                                        'msgs' => null, 
                                        'paytable_factor' => $slotSettings->Paytable['SYM_' . $scatter][$scattersCount], 
                                        'subgame_win_factor' => 1, 
                                        'count' => '' . $scattersCount, 
                                        'positions' => $_obf_0D312B19262C083426241E0D392E22282324060B380811, 
                                        'win' => '' . ($scattersWin / $denom), 
                                        'increase_factor_bonus' => [], 
                                        'wild_exists' => null, 
                                        'factor' => '' . $slotSettings->Paytable['SYM_' . $scatter][$scattersCount], 
                                        'wilds' => null, 
                                        'symbols_positions' => [
                                            1 => ['positions' => $_obf_0D312B19262C083426241E0D392E22282324060B380811]
                                        ]
                                    ]
                                ];
                            }
                            $totalWin += $scattersWin;
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
                        $totalWin = sprintf('%01.2f', $totalWin);
                        if( $totalWin > 0 ) 
                        {
                            $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                            {
                                $slotSettings->SetBalance($totalWin);
                            }
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                            {
                                $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][1] = (object)[
                                    'continue_params' => [
                                        [
                                            'label' => 'double_betpart', 
                                            'values' => [
                                                'skip', 
                                                'half', 
                                                'all'
                                            ]
                                        ], 
                                        [
                                            'label' => 'double_key', 
                                            'values' => [
                                                'red', 
                                                'black', 
                                                'diamond', 
                                                'heart', 
                                                'spade', 
                                                'clubs'
                                            ]
                                        ]
                                    ], 
                                    'type' => 'can_play_red_black_double', 
                                    'wait_for_continue' => true, 
                                    'type_descr' => 'SELECT DOUBLE', 
                                    'start_subgame_timestamp' => null, 
                                    'step_number' => 1, 
                                    'double_cards_history' => [], 
                                    'end_subgame_timestamp' => null
                                ];
                            }
                        }
                        $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                            $slotSettings->SetGameData('ShiningTreasuresCTBonusWin', $slotSettings->GetGameData('ShiningTreasuresCTBonusWin') + $totalWin);
                            $slotSettings->SetGameData('ShiningTreasuresCTTotalWin', $slotSettings->GetGameData('ShiningTreasuresCTTotalWin') + $totalWin);
                            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = $slotSettings->GetGameData('ShiningTreasuresCTFreeBalance');
                        }
                        else
                        {
                            $slotSettings->SetGameData('ShiningTreasuresCTTotalWin', $totalWin);
                        }
                        $fs = 0;
                        if( $scattersCount >= 3 ) 
                        {
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][0]['scatters_win'] = $scattersStr;
                        }
                        $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = json_encode($lineWins);
                        $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                        $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                        $slotSettings->SetGameData($slotSettings->slotId . 'Reels', $reels);
                        $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                        $slotSettings->SetGameData('ShiningTreasuresCTGambleStep', 5);
                        $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = $slotSettings->GetGameData('ShiningTreasuresCTCards');
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                            $state = 'freespin';
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32] = $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['free_spin_result'];
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['type_descr'] = 'FREE GAME';
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['free_game_total'] = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['subgame_label_game_number'] = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['free_game_number'] = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['free_games'] = 0;
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['is_free'] = true;
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['is_last'] = false;
                            $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['subgame_label'] = 'free';
                            if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData('ShiningTreasuresCTBonusWin') > 0 ) 
                            {
                                $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['is_free'] = true;
                                $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['is_last'] = true;
                                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                                $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = 0;
                            }
                        }
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['account_status']['credit'] = round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['account_status']['rgs_balance'] = round($_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901);
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['stop_reels'][0] = $reels['reel1'];
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['stop_reels'][1] = $reels['reel2'];
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['stop_reels'][2] = $reels['reel3'];
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['stop_reels'][3] = $reels['reel4'];
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['stop_reels'][4] = $reels['reel5'];
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['result_reels'][0] = [
                            $reels['reel1'][0], 
                            $reels['reel2'][0], 
                            $reels['reel3'][0], 
                            $reels['reel4'][0], 
                            $reels['reel5'][0]
                        ];
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['result_reels'][1] = [
                            $reels['reel1'][1], 
                            $reels['reel2'][1], 
                            $reels['reel3'][1], 
                            $reels['reel4'][1], 
                            $reels['reel5'][1]
                        ];
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['result_reels'][2] = [
                            $reels['reel1'][2], 
                            $reels['reel2'][2], 
                            $reels['reel3'][2], 
                            $reels['reel4'][2], 
                            $reels['reel5'][2]
                        ];
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['request_params']['line_bet'] = $betline;
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['request_params']['game_denom'] = 1;
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['request_params']['lines'] = $lines;
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['request_params']['total_bet'] = $allbet;
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['lines_win'] = $lineWins;
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['winType '] = $winType;
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['win'] = sprintf('%01.2f', $totalWin / $denom);
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['total_win'] = $slotSettings->GetGameData('ShiningTreasuresCTTotalWin') / $denom;
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['total_win'] = sprintf('%01.2f', $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result'][$_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32]['total_win']);
                        if( $_obf_0D5C3C3D341527110E0C130A171B275B1636053C3E3C32 == 0 && $winType == 'bonus' ) 
                        {
                            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                            $_obf_0D3B2A04131D2F18191C37340F3E1F161B362122233C01 = $slotSettings->slotFreeCount + 1;
                        }
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'Results', $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result']);
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"result":' . json_encode($_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play'][0]['result']) . ',"slotDenom":' . $denom . ',"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData('ShiningTreasuresCTFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('ShiningTreasuresCTCurrentFreeGame0') . ',"Balance":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance') . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData('ShiningTreasuresCTBonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = json_encode($_obf_0D34321010172C292A1A09211E38143C3D083803231B01['play']);
                    break;
                case 'gamble':
                    $Balance = $slotSettings->GetBalance();
                    $denom = $slotSettings->GetGameData($slotSettings->slotId . 'Denom');
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] != 'red' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] != 'black' ) 
                    {
                        $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = rand(1, $slotSettings->GetGambleSettings() * 2);
                    }
                    else
                    {
                        $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = rand(1, $slotSettings->GetGambleSettings());
                    }
                    $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = '';
                    $totalWin = $slotSettings->GetGameData('ShiningTreasuresCTTotalWin');
                    $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = 0;
                    $_obf_0D3310323F3F07041133133D263014342B230C260D1F11 = $totalWin;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_betpart'] == 'half' ) 
                    {
                        $totalWin = sprintf('%01.2f', $totalWin / 2);
                        $_obf_0D3310323F3F07041133133D263014342B230C260D1F11 = $totalWin;
                    }
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = $slotSettings->GetGameData('ShiningTreasuresCTCards');
                    $slotSettings->SetGameData('ShiningTreasuresCTGambleStep', $slotSettings->GetGameData('ShiningTreasuresCTGambleStep') - 1);
                    if( $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : '')) < ($totalWin * 2) ) 
                    {
                        $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = 0;
                    }
                    if( $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 == 1 ) 
                    {
                        $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'gamble';
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['gamble'][0]['result'][0]['double_result'] = 'win';
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] != 'red' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] != 'black' ) 
                        {
                            $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = $totalWin * 2;
                            $totalWin = $totalWin * 4;
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] == 'diamond' ) 
                            {
                                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = rand(0, 12);
                            }
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] == 'heart' ) 
                            {
                                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = rand(13, 25);
                            }
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] == 'spade' ) 
                            {
                                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = rand(26, 38);
                            }
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] == 'clubs' ) 
                            {
                                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = rand(39, 51);
                            }
                        }
                        else
                        {
                            $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = $totalWin;
                            $totalWin = $totalWin * 2;
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] == 'red' ) 
                            {
                                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = rand(0, 25);
                            }
                            else
                            {
                                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = rand(26, 51);
                            }
                        }
                        array_pop($_obf_0D21152412095C03222D3808130C3C012907290C181E22);
                        array_unshift($_obf_0D21152412095C03222D3808130C3C012907290C181E22, $_obf_0D25035C31183316381216122811401A1F2A17243E2B22);
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['gamble'][0]['result'][1] = (object)[
                            'type' => 'can_play_red_black_double', 
                            'continue_params' => [
                                [
                                    'values' => [
                                        'skip', 
                                        'half', 
                                        'all'
                                    ], 
                                    'label' => 'double_betpart'
                                ], 
                                [
                                    'values' => [
                                        'red', 
                                        'black', 
                                        'diamond', 
                                        'heart', 
                                        'spade', 
                                        'clubs'
                                    ], 
                                    'label' => 'double_key'
                                ]
                            ], 
                            'double_cards_history' => $_obf_0D21152412095C03222D3808130C3C012907290C181E22, 
                            'start_subgame_timestamp' => null, 
                            'step_number' => 3, 
                            'end_subgame_timestamp' => null, 
                            'wait_for_continue' => true, 
                            'type_descr' => 'SELECT DOUBLE'
                        ];
                    }
                    else
                    {
                        $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'idle';
                        $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['gamble'][0]['result'][0]['double_result'] = 'lost';
                        $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = -1 * $totalWin;
                        $totalWin = 0;
                        $slotSettings->SetGameData('ShiningTreasuresCTGambleStep', 0);
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] != 'red' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] != 'black' ) 
                        {
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] == 'diamond' ) 
                            {
                                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = rand(13, 51);
                            }
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] == 'heart' ) 
                            {
                                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = rand(26, 51);
                            }
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] == 'spade' ) 
                            {
                                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = rand(0, 26);
                            }
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] == 'clubs' ) 
                            {
                                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = rand(0, 38);
                            }
                        }
                        else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'] == 'red' ) 
                        {
                            $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = rand(26, 51);
                        }
                        else
                        {
                            $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = rand(0, 25);
                        }
                        array_pop($_obf_0D21152412095C03222D3808130C3C012907290C181E22);
                        array_unshift($_obf_0D21152412095C03222D3808130C3C012907290C181E22, $_obf_0D25035C31183316381216122811401A1F2A17243E2B22);
                    }
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['gamble'][0]['result'][0]['request_params']['double_key'] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['continue_params']['double_key'];
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['gamble'][0]['result'][0]['double_win'] = sprintf('%01.2f', $totalWin / $denom);
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['gamble'][0]['result'][0]['win'] = sprintf('%01.2f', $totalWin / $denom);
                    $_obf_0D34321010172C292A1A09211E38143C3D083803231B01['gamble'][0]['result'][0]['double_cards_history'] = $_obf_0D21152412095C03222D3808130C3C012907290C181E22;
                    $slotSettings->SetGameData('ShiningTreasuresCTTotalWin', $totalWin);
                    $slotSettings->SetBalance($_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22);
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 * -1);
                    $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 = $slotSettings->GetBalance();
                    $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = '{"dealerCard":"' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 . '","gambleState":"' . $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 . '","totalWin":' . $totalWin . ',"afterBalance":' . $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 . ',"Balance":' . $Balance . '}';
                    $response = '{"responseEvent":"gambleResult","serverResponse":' . $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 . '}';
                    $slotSettings->SaveLogReport($response, $_obf_0D3310323F3F07041133133D263014342B230C260D1F11, 1, $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22, 'slotGamble');
                    $slotSettings->SetGameData('ShiningTreasuresCTCards', $_obf_0D21152412095C03222D3808130C3C012907290C181E22);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = json_encode($_obf_0D34321010172C292A1A09211E38143C3D083803231B01['gamble']);
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
