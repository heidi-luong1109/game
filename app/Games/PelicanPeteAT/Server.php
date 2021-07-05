<?php 
namespace VanguardLTE\Games\PelicanPeteAT
{
    include('CheckReels.php');
    class Server
    {
        public function get($request, $game)
        { /*
            if( config('LicenseDK.APL_INCLUDE_KEY_CONFIG') != 'wi9qydosuimsnls5zoe5q298evkhim0ughx1w16qybs2fhlcpn' ) 
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
            }
*/            $response = '';
            \DB::beginTransaction();
            $userId = \Auth::id();
            if( $userId == null ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid login"}';
                exit( $response );
            }
            $slotSettings = new SlotSettings($game, $userId);
            $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22 = [];
            if( !isset($_POST['cmd']) ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid game command"}';
                exit( $response );
            }
            $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] = $_POST['cmd'];
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'gameSpin' ) 
            {
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                {
                    $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] = 'freespin';
                    $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'] = $slotSettings->GetGameData($slotSettings->slotId . 'slotLines');
                    $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] = $slotSettings->GetGameData($slotSettings->slotId . 'slotBet');
                }
                else
                {
                    $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] = 'bet';
                    $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'] = $_POST['lines'];
                    $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] = $_POST['bet'] / 100;
                    $slotSettings->SetGameData($slotSettings->slotId . 'slotLines', $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines']);
                    $slotSettings->SetGameData($slotSettings->slotId . 'slotBet', $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet']);
                }
            }
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'gameGamble' ) 
            {
                $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] = 'slotGamble';
                $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gambleChoice'] = $_POST['color'];
            }
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'update' ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":"' . $slotSettings->GetBalance() . '"}';
                exit( $response );
            }
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'bet' || $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' || $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'respin' ) 
            {
                if( !in_array($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'], $slotSettings->gameLine) || !in_array($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'], $slotSettings->Bet) ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":"invalid bet state"}';
                    exit( $response );
                }
                if( $slotSettings->GetBalance() < ($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet']) && $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'bet' ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":"invalid balance"}';
                    exit( $response );
                }
                if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }
            }
            else if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'slotGamble' && $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') <= 0 ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":"invalid gamble state"}';
                exit( $response );
            }
            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'gameInit' ) 
            {
                $lastEvent = $slotSettings->GetHistory();
                if( !$slotSettings->HasGameData($slotSettings->slotId . 'HistoryCards') ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'HistoryCards', []);
                }
                $_obf_0D1E5B120D2A071E012A32025C390D0F061109362A0111 = '';
                $_obf_0D26400E0A283529372A365B352A06032B3E1106081D32 = 'null';
                $restore = 'false';
                if( $lastEvent != 'NULL' ) 
                {
                    if( isset($lastEvent->serverResponse->expSymbol) ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'ExpSymbol', $lastEvent->serverResponse->expSymbol);
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                    $slotSettings->SetGameData($slotSettings->slotId . 'slotLines', $lastEvent->serverResponse->slotLines);
                    $slotSettings->SetGameData($slotSettings->slotId . 'slotBet', $lastEvent->serverResponse->slotBet);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Mpl', $lastEvent->serverResponse->Mpl);
                    $reels = $lastEvent->serverResponse->reelsSymbols;
                    $_obf_0D102E041D320C04053428092E175B1F320F1017340E11 = [];
                    $_obf_0D26400E0A283529372A365B352A06032B3E1106081D32 = '';
                    $_obf_0D191A163F1D2A0F323C113D012A0F230B033D010E0311 = [];
                    for( $i = 1; $i <= 5; $i++ ) 
                    {
                        $_obf_0D36361C143026150F302C252F3B13015B2A062E280722 = [];
                        $_obf_0D2D291F393826052A351B01230C0D2C1926191D1F0222 = 0;
                        for( $_obf_0D31403C0837332A1A1711312A3415151610280F122122 = 3; $_obf_0D31403C0837332A1A1711312A3415151610280F122122 >= 0; $_obf_0D31403C0837332A1A1711312A3415151610280F122122-- ) 
                        {
                            if( isset($reels->{'reel' . $i}[$_obf_0D31403C0837332A1A1711312A3415151610280F122122]) && $reels->{'reel' . $i}[$_obf_0D31403C0837332A1A1711312A3415151610280F122122] != '' ) 
                            {
                                $_obf_0D36361C143026150F302C252F3B13015B2A062E280722[] = '"' . ($_obf_0D2D291F393826052A351B01230C0D2C1926191D1F0222 + 1) . '":"' . $reels->{'reel' . $i}[$_obf_0D31403C0837332A1A1711312A3415151610280F122122] . '"';
                                $_obf_0D2D291F393826052A351B01230C0D2C1926191D1F0222++;
                            }
                        }
                        $_obf_0D102E041D320C04053428092E175B1F320F1017340E11[] = '"' . $i . '":{' . implode(',', $_obf_0D36361C143026150F302C252F3B13015B2A062E280722) . '}';
                    }
                    $_obf_0D26400E0A283529372A365B352A06032B3E1106081D32 = '{' . implode(',', $_obf_0D102E041D320C04053428092E175B1F320F1017340E11) . '}';
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentSeq', $lastEvent->serverResponse->curSeq);
                    $_obf_0D312C0D14273F0410351D402740232540165B060B2332 = $slotSettings->GetGameData('PelicanPeteATholdWildsStr');
                    if( !is_array($_obf_0D312C0D14273F0410351D402740232540165B060B2332) ) 
                    {
                        $_obf_0D312C0D14273F0410351D402740232540165B060B2332 = [];
                    }
                    if( $lastEvent->serverResponse->currentFreeGames < $lastEvent->serverResponse->totalFreeGames ) 
                    {
                        $restore = 'true';
                        $_obf_0D1E5B120D2A071E012A32025C390D0F061109362A0111 = '"id":"54594109_20200214110301","current":' . $lastEvent->serverResponse->currentFreeGames . ',"add":0,"total":' . $lastEvent->serverResponse->totalFreeGames . ',"totalWin":' . ($lastEvent->serverResponse->totalWin * 100) . ',"wilds":[' . implode(',', $_obf_0D312C0D14273F0410351D402740232540165B060B2332) . ']';
                    }
                }
                $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932 = $slotSettings->Bet;
                foreach( $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932 as &$_obf_0D1518333D330D23092939233405382615271438343C11 ) 
                {
                    $_obf_0D1518333D330D23092939233405382615271438343C11 = $_obf_0D1518333D330D23092939233405382615271438343C11 * 100;
                }
                $response = '{"status":"success","microtime":0.0077991485595703,"dateTime":"2020-02-13 13:16:03","error":"","content":{"cmd":"gameInit","balance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"session":"54594109_4133a64673d3883d42cd003ee905ba3e","betInfo":{"denomination":0.01,"bet":' . $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932[0] . ',"lines":50},"betSettings":{"denomination":[0.01],"bets":[' . implode(',', $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932) . '],"lines":[1,5,10,20,30,40,50]},"symbols":' . $_obf_0D26400E0A283529372A365B352A06032B3E1106081D32 . ',"reels":{"base":{"1":["' . implode('","', $slotSettings->reelStrip1) . '"],"2":["' . implode('","', $slotSettings->reelStrip2) . '"],"3":["' . implode('","', $slotSettings->reelStrip3) . '"],"4":["' . implode('","', $slotSettings->reelStrip4) . '"],"5":["' . implode('","', $slotSettings->reelStrip5) . '"]},"free":{"1":["' . implode('","', $slotSettings->reelStripBonus1) . '"],"2":["' . implode('","', $slotSettings->reelStripBonus2) . '"],"3":["' . implode('","', $slotSettings->reelStripBonus3) . '"],"4":["' . implode('","', $slotSettings->reelStripBonus4) . '"],"5":["' . implode('","', $slotSettings->reelStripBonus5) . '"]}},"exitUrl":"\/","pingInterval":60000,"restore":' . $restore . ',"freeSpin":{' . $_obf_0D1E5B120D2A071E012A32025C390D0F061109362A0111 . '},"hash":"da0a5044aebc413b6da3a8e42dea0246"}}';
            }
            else if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'gameRefreshBalance' ) 
            {
                $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                $response = '{"status":"success","microtime":0.0065572261810303,"dateTime":"2020-02-15 12:46:27","error":"","content":{"cmd":"gameRefreshBalance","session":"54990161_9709e13bca7763b46396cda1868d2e7e","balance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"hash":"8d9f26101b61f471ac401c22d6b8d68c"}}';
            }
            else if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'gamePing' ) 
            {
                $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                $response = '{"status":"success","microtime":0.0031919479370117,"dateTime":"2020-02-14 11:51:01","error":null,"content":{"cmd":"gamePing","session":"54594109_4133a64673d3883d42cd003ee905ba3e","balance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"hash":"fda108a357d692381d7ca82a1bea67b1"}}';
            }
            else if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'sessionInfo' ) 
            {
                $response = '{"status":"success","microtime":0.0026731491088867,"dateTime":"2020-02-13 13:23:32","error":"","content":{"cmd":"sessionInfo","serverMathematics":"\/game\/PelicanPeteAT\/server","serverResources":"","sessionId":"54594109_4133a64673d3883d42cd003ee905ba3e","exitUlt":"\/","exitUrl":"\/","id":"341","name":"GameName","currency":"ALL","language":"en","type":"aristocrat","systemName":"pelican_pete","version":"2","mobile":"1"}}';
            }
            else if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'gameTakeWin' ) 
            {
                $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                $response = '{"status":"success","microtime":0.033211946487427,"dateTime":"2020-02-14 10:09:04","error":null,"content":{"cmd":"gameTakeWin","session":"54594109_4133a64673d3883d42cd003ee905ba3e","balance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"actionId":"54594109_74_659","hash":"a12f5889add8917d6e705751e1d9a953"}}';
            }
            else if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'gamePick' ) 
            {
                $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                if( $_POST['pick'] == 0 ) 
                {
                    $slotSettings->SetGameData('PelicanPeteATMpl', 10);
                    $slotSettings->SetGameData('PelicanPeteATCurrentFreeGame', 0);
                    $slotSettings->SetGameData('PelicanPeteATFreeGames', 5);
                }
                else if( $_POST['pick'] == 1 ) 
                {
                    $slotSettings->SetGameData('PelicanPeteATMpl', 5);
                    $slotSettings->SetGameData('PelicanPeteATCurrentFreeGame', 0);
                    $slotSettings->SetGameData('PelicanPeteATFreeGames', 10);
                }
                else if( $_POST['pick'] == 2 ) 
                {
                    $slotSettings->SetGameData('PelicanPeteATMpl', 3);
                    $slotSettings->SetGameData('PelicanPeteATCurrentFreeGame', 0);
                    $slotSettings->SetGameData('PelicanPeteATFreeGames', 15);
                }
                else if( $_POST['pick'] == 3 ) 
                {
                    $slotSettings->SetGameData('PelicanPeteATMpl', 2);
                    $slotSettings->SetGameData('PelicanPeteATCurrentFreeGame', 0);
                    $slotSettings->SetGameData('PelicanPeteATFreeGames', 20);
                }
                $response = '{"status":"success","microtime":0.0093810558319092,"dateTime":"2020-02-15 14:26:21","error":"","content":{"session":"54990161_9709e13bca7763b46396cda1868d2e7e","cmd":"gamePick","balance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"win":0,"symbols":{"1":{"1":"symbol_6","2":"symbol_9","3":"symbol_13"},"2":{"1":"symbol_10","2":"symbol_5","3":"symbol_8"},"3":{"1":"symbol_10","2":"symbol_13","3":"symbol_11"},"4":{"1":"symbol_13","2":"symbol_10","3":"symbol_6"},"5":{"1":"symbol_3","2":"symbol_8","3":"symbol_1"}},"winLines":[],"freeSpin":{"id":"54990161_20200215132548","current":0,"add":' . $slotSettings->GetGameData('PelicanPeteATFreeGames') . ',"total":' . $slotSettings->GetGameData('PelicanPeteATFreeGames') . ',"totalWin":' . ($slotSettings->GetGameData('PelicanPeteATBonusWin') * 100) . ',"multiplayer":' . $slotSettings->GetGameData('PelicanPeteATMpl') . ',"pick":' . $_POST['pick'] . '},"actionId":"54990161_10_60","hash":"1ace145628d930d28bdf38789a28a9d7"}}';
            }
            else if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'slotGamble' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $_obf_0D2F3C2804395C38101A1C05232C1040362D390D1D3301 = rand(1, $slotSettings->GetGambleSettings());
                $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = '';
                $totalWin = $slotSettings->GetGameData('PelicanPeteATTotalWin');
                $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = 0;
                $_obf_0D31140A120E1B3D282A06280B27103B250935092B1F01 = $totalWin;
                if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gambleChoice'] == 'red' || $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gambleChoice'] == 'black' ) 
                {
                    if( $slotSettings->GetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : '')) < ($totalWin * 2) ) 
                    {
                        $_obf_0D2F3C2804395C38101A1C05232C1040362D390D1D3301 = 0;
                    }
                    $_obf_0D0D3F062706220D1730123D161812245B1A0528390F11 = 'spin';
                    if( $_obf_0D2F3C2804395C38101A1C05232C1040362D390D1D3301 == 1 ) 
                    {
                        $_obf_0D0D3F062706220D1730123D161812245B1A0528390F11 = 'gamble\/takeWin';
                        $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 = 'win';
                        $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = $totalWin;
                        $totalWin = $totalWin * 2;
                        if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gambleChoice'] == 'red' ) 
                        {
                            $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01 = [
                                'diamond', 
                                'heart'
                            ];
                            $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01[rand(0, 1)];
                        }
                        else
                        {
                            $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01 = [
                                'club', 
                                'spade'
                            ];
                            $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01[rand(0, 1)];
                        }
                    }
                    else
                    {
                        $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 = 'lose';
                        $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = -1 * $totalWin;
                        $totalWin = 0;
                        if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gambleChoice'] == 'red' ) 
                        {
                            $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01 = [
                                'club', 
                                'spade'
                            ];
                            $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01[rand(0, 1)];
                        }
                        else
                        {
                            $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01 = [
                                'diamond', 
                                'heart'
                            ];
                            $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01[rand(0, 1)];
                        }
                    }
                }
                else
                {
                    if( $slotSettings->GetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : '')) < ($totalWin * 4) ) 
                    {
                        $_obf_0D2F3C2804395C38101A1C05232C1040362D390D1D3301 = 0;
                    }
                    $_obf_0D0D3F062706220D1730123D161812245B1A0528390F11 = 'spin';
                    if( $_obf_0D2F3C2804395C38101A1C05232C1040362D390D1D3301 == 1 ) 
                    {
                        $_obf_0D0D3F062706220D1730123D161812245B1A0528390F11 = 'gamble\/takeWin';
                        $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 = 'win';
                        $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = $totalWin;
                        $totalWin = $totalWin * 4;
                        $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gambleChoice'];
                    }
                    else
                    {
                        $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 = 'lose';
                        $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 = -1 * $totalWin;
                        $totalWin = 0;
                        $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01 = [
                            'club', 
                            'spade', 
                            'diamond', 
                            'heart'
                        ];
                        shuffle($_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01);
                        for( $i = 0; $i < 4; $i++ ) 
                        {
                            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['gambleChoice'] != $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01[$i] ) 
                            {
                                $_obf_0D040B162710402D331E2209370C14231F2C252B172601 = $_obf_0D1D3229361F0A3E062B2224050A0E013D0F1911072E01[$i];
                            }
                        }
                    }
                }
                $slotSettings->SetGameData('PelicanPeteATTotalWin', $totalWin);
                $slotSettings->SetBalance($_obf_0D2D1D15122B0303242922110A351334341A371C0C3101);
                $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101 * -1);
                $_obf_0D18161E352E061A0433191E381C2E0B222A272A2D3E22 = $slotSettings->GetBalance();
                $_obf_0D2307370C401A042D310F070D313207280830055B2A32 = '{"dealerCard":"' . $_obf_0D040B162710402D331E2209370C14231F2C252B172601 . '","gambleState":"' . $_obf_0D1C0D102A3D1F22280124351A230D33190A15123B2522 . '","totalWin":' . $totalWin . ',"afterBalance":' . $_obf_0D18161E352E061A0433191E381C2E0B222A272A2D3E22 . ',"Balance":' . $Balance . '}';
                $_obf_0D332B280C0C3223043E3831210D233725331D30261301 = '{"responseEvent":"gambleResult","serverResponse":' . $_obf_0D2307370C401A042D310F070D313207280830055B2A32 . '}';
                $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                $response = '{"status":"success","microtime":0.0097517967224121,"dateTime":"2020-02-14 09:37:51","error":null,"content":{"cmd":"gameGamble","session":"54594109_4133a64673d3883d42cd003ee905ba3e","balance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"card":"' . $_obf_0D040B162710402D331E2209370C14231F2C252B172601 . '","win":' . ($totalWin * 100) . ',"actionId":"54594109_68_593","actionNext":"' . $_obf_0D0D3F062706220D1730123D161812245B1A0528390F11 . '","lastCard":["spade","diamond","diamond"],"hash":"c9f3dbf54134e682dead5ec1f89d48d5"}}';
                $slotSettings->SaveLogReport($_obf_0D332B280C0C3223043E3831210D233725331D30261301, $_obf_0D31140A120E1B3D282A06280B27103B250935092B1F01, 1, $_obf_0D2D1D15122B0303242922110A351334341A371C0C3101, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
            }
            else if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'bet' || $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' ) 
            {
                $linesId = [];
                $linesId[0] = [
                    1, 
                    1, 
                    1, 
                    1, 
                    1
                ];
                $linesId[1] = [
                    1, 
                    1, 
                    2, 
                    1, 
                    1
                ];
                $linesId[2] = [
                    1, 
                    2, 
                    2, 
                    2, 
                    1
                ];
                $linesId[3] = [
                    1, 
                    2, 
                    3, 
                    2, 
                    1
                ];
                $linesId[4] = [
                    1, 
                    2, 
                    1, 
                    2, 
                    1
                ];
                $linesId[5] = [
                    1, 
                    1, 
                    1, 
                    2, 
                    1
                ];
                $linesId[6] = [
                    1, 
                    2, 
                    1, 
                    1, 
                    1
                ];
                $linesId[7] = [
                    1, 
                    1, 
                    2, 
                    2, 
                    1
                ];
                $linesId[8] = [
                    1, 
                    2, 
                    2, 
                    1, 
                    1
                ];
                $linesId[9] = [
                    1, 
                    1, 
                    3, 
                    1, 
                    1
                ];
                $linesId[10] = [
                    1, 
                    1, 
                    3, 
                    2, 
                    1
                ];
                $linesId[11] = [
                    1, 
                    2, 
                    3, 
                    1, 
                    1
                ];
                $linesId[12] = [
                    2, 
                    2, 
                    2, 
                    2, 
                    2
                ];
                $linesId[13] = [
                    2, 
                    2, 
                    3, 
                    2, 
                    2
                ];
                $linesId[14] = [
                    2, 
                    2, 
                    1, 
                    2, 
                    2
                ];
                $linesId[15] = [
                    2, 
                    3, 
                    3, 
                    3, 
                    2
                ];
                $linesId[16] = [
                    2, 
                    1, 
                    1, 
                    1, 
                    2
                ];
                $linesId[17] = [
                    2, 
                    3, 
                    2, 
                    3, 
                    2
                ];
                $linesId[18] = [
                    2, 
                    1, 
                    2, 
                    1, 
                    2
                ];
                $linesId[19] = [
                    2, 
                    2, 
                    2, 
                    3, 
                    2
                ];
                $linesId[20] = [
                    2, 
                    2, 
                    2, 
                    1, 
                    2
                ];
                $linesId[21] = [
                    2, 
                    3, 
                    2, 
                    2, 
                    2
                ];
                $linesId[22] = [
                    2, 
                    1, 
                    2, 
                    2, 
                    2
                ];
                $linesId[23] = [
                    2, 
                    3, 
                    1, 
                    3, 
                    2
                ];
                $linesId[24] = [
                    2, 
                    1, 
                    3, 
                    1, 
                    2
                ];
                $linesId[25] = [
                    3, 
                    3, 
                    3, 
                    3, 
                    3
                ];
                $linesId[26] = [
                    3, 
                    3, 
                    4, 
                    3, 
                    3
                ];
                $linesId[27] = [
                    3, 
                    3, 
                    2, 
                    3, 
                    3
                ];
                $linesId[28] = [
                    3, 
                    4, 
                    4, 
                    4, 
                    3
                ];
                $linesId[29] = [
                    3, 
                    2, 
                    2, 
                    2, 
                    3
                ];
                $linesId[30] = [
                    3, 
                    4, 
                    3, 
                    4, 
                    3
                ];
                $linesId[31] = [
                    3, 
                    2, 
                    3, 
                    2, 
                    3
                ];
                $linesId[32] = [
                    3, 
                    3, 
                    3, 
                    4, 
                    3
                ];
                $linesId[33] = [
                    3, 
                    3, 
                    3, 
                    2, 
                    3
                ];
                $linesId[34] = [
                    3, 
                    4, 
                    3, 
                    3, 
                    3
                ];
                $linesId[35] = [
                    3, 
                    2, 
                    3, 
                    3, 
                    3
                ];
                $linesId[36] = [
                    3, 
                    4, 
                    2, 
                    4, 
                    3
                ];
                $linesId[37] = [
                    3, 
                    2, 
                    4, 
                    2, 
                    3
                ];
                $linesId[38] = [
                    4, 
                    4, 
                    4, 
                    4, 
                    4
                ];
                $linesId[39] = [
                    4, 
                    4, 
                    3, 
                    4, 
                    4
                ];
                $linesId[40] = [
                    4, 
                    3, 
                    3, 
                    3, 
                    4
                ];
                $linesId[41] = [
                    4, 
                    3, 
                    2, 
                    3, 
                    4
                ];
                $linesId[42] = [
                    4, 
                    3, 
                    4, 
                    3, 
                    4
                ];
                $linesId[43] = [
                    4, 
                    4, 
                    4, 
                    3, 
                    4
                ];
                $linesId[44] = [
                    4, 
                    3, 
                    4, 
                    4, 
                    4
                ];
                $linesId[45] = [
                    4, 
                    4, 
                    3, 
                    3, 
                    4
                ];
                $linesId[46] = [
                    4, 
                    3, 
                    3, 
                    4, 
                    4
                ];
                $linesId[47] = [
                    4, 
                    4, 
                    2, 
                    4, 
                    4
                ];
                $linesId[48] = [
                    4, 
                    4, 
                    2, 
                    3, 
                    4
                ];
                $linesId[49] = [
                    4, 
                    3, 
                    2, 
                    4, 
                    4
                ];
                $_obf_0D360F0140113330275B14311E3516150112390A0F1B22 = $slotSettings->GetSpinSettings($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'], $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'], $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines']);
                $winType = $_obf_0D360F0140113330275B14311E3516150112390A0F1B22[0];
                $_obf_0D3030072F273706293C133F2F072B113B383322291201 = $_obf_0D360F0140113330275B14311E3516150112390A0F1B22[1];
                if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] != 'freespin' ) 
                {
                    if( !isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ) 
                    {
                        $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] = 'bet';
                    }
                    $_obf_0D2A0526273612293511363C26193E1C130B2719192611 = ($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines']) / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), $_obf_0D2A0526273612293511363C26193E1C130B2719192611, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
                    $slotSettings->UpdateJackpots($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines']);
                    $slotSettings->SetBalance(-1 * ($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines']), $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
                    $bonusMpl = 1;
                    $slotSettings->SetGameData('PelicanPeteATBonusWin', 0);
                    $slotSettings->SetGameData('PelicanPeteATFreeGames', 0);
                    $slotSettings->SetGameData('PelicanPeteATCurrentFreeGame', 0);
                    $slotSettings->SetGameData('PelicanPeteATTotalWin', 0);
                    $slotSettings->SetGameData('PelicanPeteATFreeBalance', 0);
                    $slotSettings->SetGameData('PelicanPeteATMpl', 1);
                }
                else
                {
                    $slotSettings->SetGameData('PelicanPeteATCurrentFreeGame', $slotSettings->GetGameData('PelicanPeteATCurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->GetGameData('PelicanPeteATMpl');
                }
                $Balance = $slotSettings->GetBalance();
                if( isset($slotSettings->Jackpots['jackPay']) ) 
                {
                    $Balance = $Balance - ($slotSettings->Jackpots['jackPay'] * $slotSettings->CurrentDenom);
                }
                $curSeq = [];
                $_obf_0D131B0E321F362C05230E0927342A090F2C0B34290322 = 0;
                if( $winType == 'bonus' ) 
                {
                    $_obf_0D3105083F300417011E24321D131C14325C260C400511 = [
                        500, 
                        1000, 
                        2000, 
                        5000, 
                        10000
                    ];
                    shuffle($_obf_0D3105083F300417011E24321D131C14325C260C400511);
                    $_obf_0D0D142D29330A012D0B2E232729130B1F2B14222F1522 = 'NULL';
                    for( $_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11 = 0; $_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11 < count($_obf_0D3105083F300417011E24321D131C14325C260C400511); $_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11++ ) 
                    {
                        if( $_obf_0D3105083F300417011E24321D131C14325C260C400511[$_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] <= $slotSettings->GetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : '')) ) 
                        {
                            $_obf_0D0D142D29330A012D0B2E232729130B1F2B14222F1522 = $_obf_0D3105083F300417011E24321D131C14325C260C400511[$_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11];
                            break;
                        }
                    }
                    if( $_obf_0D0D142D29330A012D0B2E232729130B1F2B14222F1522 != 'NULL' ) 
                    {
                        $_obf_0D2D3F3D0A2F0E1A2C3C265C261C312107270D2D061C22 = json_decode(trim(file_get_contents(dirname(__FILE__) . '/presets/p_' . $_obf_0D0D142D29330A012D0B2E232729130B1F2B14222F1522 . '/preset_' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'] . '.json')), true);
                        $curSeq = $_obf_0D2D3F3D0A2F0E1A2C3C265C261C312107270D2D061C22[rand(0, count($_obf_0D2D3F3D0A2F0E1A2C3C265C261C312107270D2D061C22) - 1)];
                        $_obf_0D131B0E321F362C05230E0927342A090F2C0B34290322 = $curSeq['allWin'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'];
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentSeq', $curSeq);
                        if( $_obf_0D131B0E321F362C05230E0927342A090F2C0B34290322 > 0 ) 
                        {
                            $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), -1 * $_obf_0D131B0E321F362C05230E0927342A090F2C0B34290322);
                        }
                    }
                    else
                    {
                        $winType = 'none';
                    }
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
                        0
                    ];
                    $wild = ['symbol_13'];
                    $scatter = 'symbol_12';
                    $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01 = [];
                    $reels = $slotSettings->GetReelStrips($winType, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
                    if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' || $winType == 'bonus' ) 
                    {
                        $curSeq = (array)$slotSettings->GetGameData($slotSettings->slotId . 'CurrentSeq');
                        $curSeq['result'] = (array)$curSeq['result'];
                        $curSeq['result'][$slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')] = (array)$curSeq['result'][$slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')];
                        $curSeq['result'][$slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')]['reels'] = (array)$curSeq['result'][$slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')]['reels'];
                        $reels = $curSeq['result'][$slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')]['reels'];
                    }
                    if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D312C0D14273F0410351D402740232540165B060B2332 = $slotSettings->GetGameData('PelicanPeteATholdWildsArr');
                        if( !is_array($_obf_0D312C0D14273F0410351D402740232540165B060B2332) ) 
                        {
                            $_obf_0D312C0D14273F0410351D402740232540165B060B2332 = [];
                        }
                        foreach( $_obf_0D312C0D14273F0410351D402740232540165B060B2332 as $w ) 
                        {
                            $reels['reel' . $w[0]][$w[1]] = 'symbol_13';
                        }
                    }
                    for( $k = 0; $k < $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines']; $k++ ) 
                    {
                        $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32 = '';
                        $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k] = $linesId[$k];
                        for( $_obf_0D3C0735011C170E2B1E3D161906171518191C3E3B3D11 = 0; $_obf_0D3C0735011C170E2B1E3D161906171518191C3E3B3D11 < count($_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k]); $_obf_0D3C0735011C170E2B1E3D161906171518191C3E3B3D11++ ) 
                        {
                            if( $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][$_obf_0D3C0735011C170E2B1E3D161906171518191C3E3B3D11] == 1 ) 
                            {
                                $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][$_obf_0D3C0735011C170E2B1E3D161906171518191C3E3B3D11] = 4;
                            }
                            else if( $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][$_obf_0D3C0735011C170E2B1E3D161906171518191C3E3B3D11] == 2 ) 
                            {
                                $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][$_obf_0D3C0735011C170E2B1E3D161906171518191C3E3B3D11] = 3;
                            }
                            else if( $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][$_obf_0D3C0735011C170E2B1E3D161906171518191C3E3B3D11] == 3 ) 
                            {
                                $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][$_obf_0D3C0735011C170E2B1E3D161906171518191C3E3B3D11] = 2;
                            }
                            else if( $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][$_obf_0D3C0735011C170E2B1E3D161906171518191C3E3B3D11] == 4 ) 
                            {
                                $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][$_obf_0D3C0735011C170E2B1E3D161906171518191C3E3B3D11] = 1;
                            }
                        }
                        for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                        {
                            $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 = $slotSettings->SymbolGame[$j];
                            if( $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 == $scatter || !isset($slotSettings->Paytable[$_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11]) ) 
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
                                if( $s[0] == $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 || in_array($s[0], $wild) ) 
                                {
                                    $mpl = 1;
                                    $_obf_0D365B172533170712222423300A1B092C161521071B32 = $slotSettings->Paytable[$_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11][1] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D365B172533170712222423300A1B092C161521071B32 ) 
                                    {
                                        $cWins[$k] = $_obf_0D365B172533170712222423300A1B092C161521071B32;
                                        $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32 = '{"line":' . ($k + 1) . ',"symbol":"' . $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 . '","count":1,"side":"left","elements":[[1,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][0] . ']],"xWin":' . $mpl . ',"win":' . ($cWins[$k] * 100) . '}';
                                    }
                                }
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
                                        for( $_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32 = 0; $_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32 < 2; $_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32++ ) 
                                        {
                                            if( in_array($s[$_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32], $wild) ) 
                                            {
                                            }
                                        }
                                    }
                                    $_obf_0D365B172533170712222423300A1B092C161521071B32 = $slotSettings->Paytable[$_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11][2] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D365B172533170712222423300A1B092C161521071B32 ) 
                                    {
                                        $cWins[$k] = $_obf_0D365B172533170712222423300A1B092C161521071B32;
                                        $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32 = '{"line":' . ($k + 1) . ',"symbol":"' . $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 . '","count":2,"side":"left","elements":[[1,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][0] . '],[2,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][1] . ']],"xWin":' . $mpl . ',"win":' . ($cWins[$k] * 100) . '}';
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
                                        for( $_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32 = 0; $_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32 < 3; $_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32++ ) 
                                        {
                                            if( in_array($s[$_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32], $wild) ) 
                                            {
                                            }
                                        }
                                    }
                                    $_obf_0D365B172533170712222423300A1B092C161521071B32 = $slotSettings->Paytable[$_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11][3] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D365B172533170712222423300A1B092C161521071B32 ) 
                                    {
                                        $cWins[$k] = $_obf_0D365B172533170712222423300A1B092C161521071B32;
                                        $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32 = '{"line":' . ($k + 1) . ',"symbol":"' . $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 . '","count":3,"side":"left","elements":[[1,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][0] . '],[2,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][1] . '],[3,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][2] . ']],"xWin":' . $mpl . ',"win":' . ($cWins[$k] * 100) . '}';
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
                                        for( $_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32 = 0; $_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32 < 4; $_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32++ ) 
                                        {
                                            if( in_array($s[$_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32], $wild) ) 
                                            {
                                            }
                                        }
                                    }
                                    $_obf_0D365B172533170712222423300A1B092C161521071B32 = $slotSettings->Paytable[$_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11][4] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D365B172533170712222423300A1B092C161521071B32 ) 
                                    {
                                        $cWins[$k] = $_obf_0D365B172533170712222423300A1B092C161521071B32;
                                        $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32 = '{"line":' . ($k + 1) . ',"symbol":"' . $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 . '","count":4,"side":"left","elements":[[1,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][0] . '],[2,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][1] . '],[3,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][2] . '],[4,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][3] . ']],"xWin":' . $mpl . ',"win":' . ($cWins[$k] * 100) . '}';
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
                                        for( $_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32 = 0; $_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32 < 5; $_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32++ ) 
                                        {
                                            if( in_array($s[$_obf_0D340A0912163F2A0525183C1C2C08141C231F5B2A5C32], $wild) ) 
                                            {
                                            }
                                        }
                                    }
                                    $_obf_0D365B172533170712222423300A1B092C161521071B32 = $slotSettings->Paytable[$_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11][5] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D365B172533170712222423300A1B092C161521071B32 ) 
                                    {
                                        $cWins[$k] = $_obf_0D365B172533170712222423300A1B092C161521071B32;
                                        $_obf_0D02100911023C3C260E0C262F5B2C1D2839310E112A32 = '{"line":' . ($k + 1) . ',"symbol":"' . $_obf_0D350901162A195B273D0F282B290A2A0B1811330C0E11 . '","count":5,"side":"left","elements":[[1,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][0] . '],[2,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][1] . '],[3,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][2] . '],[4,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][3] . '],[5,' . $_obf_0D10312F2E0C401A0B2828350D16031F2B1A280C3D1A01[$k][4] . ']],"xWin":' . $mpl . ',"win":' . ($cWins[$k] * 100) . '}';
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
                    $scattersStr = '';
                    $_obf_0D2C161413333D05292D0304392523180D3F192D361122 = [];
                    $scattersCount = 0;
                    $_obf_0D1F311D150B1108362F05193E350A0C1B061516160D11 = [];
                    $_obf_0D1F3632381B1B130E3F38121B400F2E16251C250D2501 = [];
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $_obf_0D31403C0837332A1A1711312A3415151610280F122122 = 0; $_obf_0D31403C0837332A1A1711312A3415151610280F122122 <= 3; $_obf_0D31403C0837332A1A1711312A3415151610280F122122++ ) 
                        {
                            if( $reels['reel' . $r][$_obf_0D31403C0837332A1A1711312A3415151610280F122122] == $scatter ) 
                            {
                                $scattersCount++;
                                if( $_obf_0D31403C0837332A1A1711312A3415151610280F122122 == 0 ) 
                                {
                                    $_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11 = 4;
                                }
                                else if( $_obf_0D31403C0837332A1A1711312A3415151610280F122122 == 1 ) 
                                {
                                    $_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11 = 3;
                                }
                                else if( $_obf_0D31403C0837332A1A1711312A3415151610280F122122 == 2 ) 
                                {
                                    $_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11 = 2;
                                }
                                else if( $_obf_0D31403C0837332A1A1711312A3415151610280F122122 == 3 ) 
                                {
                                    $_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11 = 1;
                                }
                                $_obf_0D2C161413333D05292D0304392523180D3F192D361122[] = '[' . $r . ',"' . $_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11 . '"]';
                            }
                            if( $reels['reel' . $r][$_obf_0D31403C0837332A1A1711312A3415151610280F122122] == 'symbol_13' ) 
                            {
                                if( $_obf_0D31403C0837332A1A1711312A3415151610280F122122 == 0 ) 
                                {
                                    $_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11 = 4;
                                }
                                else if( $_obf_0D31403C0837332A1A1711312A3415151610280F122122 == 1 ) 
                                {
                                    $_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11 = 3;
                                }
                                else if( $_obf_0D31403C0837332A1A1711312A3415151610280F122122 == 2 ) 
                                {
                                    $_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11 = 2;
                                }
                                else if( $_obf_0D31403C0837332A1A1711312A3415151610280F122122 == 3 ) 
                                {
                                    $_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11 = 1;
                                }
                                $_obf_0D1F311D150B1108362F05193E350A0C1B061516160D11[] = '[' . $r . ',"' . $_obf_0D3D11063F0B3C1E1D365C1E122104310B3219022B3D11 . '"]';
                                $_obf_0D1F3632381B1B130E3F38121B400F2E16251C250D2501[] = [
                                    $r, 
                                    $_obf_0D31403C0837332A1A1711312A3415151610280F122122
                                ];
                            }
                        }
                    }
                    $scattersWin = $slotSettings->Paytable[$scatter][$scattersCount] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'];
                    if( $scattersCount >= 3 && $slotSettings->slotBonus ) 
                    {
                        $scattersStr = '{"line":"scatter","symbol":"' . $scatter . '","count":' . $scattersCount . ',"elements":[' . implode(',', $_obf_0D2C161413333D05292D0304392523180D3F192D361122) . '],"xWin":' . $bonusMpl . ',"freeSpinAdd":' . $slotSettings->slotFreeCount . ',"win":' . ($scattersWin * 100) . '}';
                        array_push($lineWins, $scattersStr);
                    }
                    else if( $scattersWin > 0 ) 
                    {
                        $scattersStr = '{"line":"scatter","symbol":"' . $scatter . '","count":' . $scattersCount . ',"elements":[' . implode(',', $_obf_0D2C161413333D05292D0304392523180D3F192D361122) . '],"xWin":' . $bonusMpl . ',"freeSpinAdd":0,"win":' . ($scattersWin * 100) . '}';
                        array_push($lineWins, $scattersStr);
                    }
                    else
                    {
                        $scattersStr .= '';
                    }
                    $totalWin += $scattersWin;
                    if( $i > 1000 ) 
                    {
                        $winType = 'none';
                    }
                    if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' ) 
                    {
                        break;
                    }
                    if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] * rand(2, 5)) ) 
                    {
                    }
                    else if( !$slotSettings->increaseRTP && $winType == 'win' && $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'] * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] < $totalWin ) 
                    {
                    }
                    else
                    {
                        if( $i > 1500 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( $scattersCount >= 3 && $winType != 'bonus' ) 
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
                    $slotSettings->SetBalance($totalWin);
                    if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] != 'freespin' && $winType != 'bonus' ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), -1 * $totalWin);
                    }
                }
                $_obf_0D0C361D2E35362209025C2317232809271D34270D3232 = $totalWin;
                $_obf_0D1E5B120D2A071E012A32025C390D0F061109362A0111 = '';
                $_obf_0D26400E0A283529372A365B352A06032B3E1106081D32 = 'null';
                if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData('PelicanPeteATholdWildsArr', $_obf_0D1F3632381B1B130E3F38121B400F2E16251C250D2501);
                    $slotSettings->SetGameData('PelicanPeteATholdWildsStr', $_obf_0D1F311D150B1108362F05193E350A0C1B061516160D11);
                    $slotSettings->SetGameData('PelicanPeteATBonusWin', $slotSettings->GetGameData('PelicanPeteATBonusWin') + $totalWin);
                    $slotSettings->SetGameData('PelicanPeteATTotalWin', $slotSettings->GetGameData('PelicanPeteATTotalWin') + $totalWin);
                    $_obf_0D1E5B120D2A071E012A32025C390D0F061109362A0111 = '"id":"54594109_20200214110301","current":' . $slotSettings->GetGameData('PelicanPeteATCurrentFreeGame') . ',"multiplayer":' . $slotSettings->GetGameData('PelicanPeteATMpl') . ',"add":0,"total":' . $slotSettings->GetGameData('PelicanPeteATFreeGames') . ',"totalWin":' . ($slotSettings->GetGameData('PelicanPeteATBonusWin') * 100) . ',"wilds":[' . implode(',', $_obf_0D1F311D150B1108362F05193E350A0C1B061516160D11) . ']';
                }
                else
                {
                    $slotSettings->SetGameData('PelicanPeteATTotalWin', $totalWin);
                }
                if( $scattersCount >= 3 ) 
                {
                    if( $slotSettings->GetGameData('PelicanPeteATFreeGames') > 0 ) 
                    {
                        $slotSettings->SetGameData('PelicanPeteATFreeGames', $slotSettings->GetGameData('PelicanPeteATFreeGames') + $slotSettings->slotFreeCount);
                        $_obf_0D1E5B120D2A071E012A32025C390D0F061109362A0111 = '"id":"54594109_20200214110301","current":' . $slotSettings->GetGameData('PelicanPeteATCurrentFreeGame') . ',"multiplayer":' . $slotSettings->GetGameData('PelicanPeteATMpl') . ',"add":' . $slotSettings->slotFreeCount . ',"total":' . $slotSettings->GetGameData('PelicanPeteATFreeGames') . ',"totalWin":' . ($slotSettings->GetGameData('PelicanPeteATBonusWin') * 100) . ',"wilds":[' . implode(',', $_obf_0D1F311D150B1108362F05193E350A0C1B061516160D11) . ']';
                    }
                    else
                    {
                        $slotSettings->SetGameData('PelicanPeteATFreeBalance', $Balance);
                        $slotSettings->SetGameData('PelicanPeteATBonusWin', $totalWin);
                        $slotSettings->SetGameData('PelicanPeteATFreeGames', $slotSettings->slotFreeCount);
                        $_obf_0D1E5B120D2A071E012A32025C390D0F061109362A0111 = '"id":"54594109_20200214110301","current":' . $slotSettings->GetGameData('PelicanPeteATCurrentFreeGame') . ',"multiplayer":' . $slotSettings->GetGameData('PelicanPeteATMpl') . ',"add":' . $slotSettings->slotFreeCount . ',"total":' . $slotSettings->GetGameData('PelicanPeteATFreeGames') . ',"totalWin":' . ($slotSettings->GetGameData('PelicanPeteATBonusWin') * 100) . ',"wilds":[' . implode(',', $_obf_0D1F311D150B1108362F05193E350A0C1B061516160D11) . ']';
                    }
                }
                $_obf_0D273522403840350F0A36072E150A0524143F382C3B32 = '' . json_encode($reels) . '';
                $_obf_0D28393910101E062539311B3F371C121912162B061E32 = '' . json_encode($slotSettings->Jackpots) . '';
                $_obf_0D5B5C2E0D1C3D1F232F3E051D3225380127293C2A2432 = implode(',', $lineWins);
                $_obf_0D332B280C0C3223043E3831210D233725331D30261301 = '{"responseEvent":"spin","responseType":"' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] . '","serverResponse":{"curSeq":' . json_encode($curSeq) . ',"slotLines":' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'] . ',"slotBet":' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'] . ',"totalFreeGames":' . $slotSettings->GetGameData('PelicanPeteATFreeGames') . ',"Mpl":' . $slotSettings->GetGameData('PelicanPeteATMpl') . ',"currentFreeGames":' . $slotSettings->GetGameData('PelicanPeteATCurrentFreeGame') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D5B5C2E0D1C3D1F232F3E051D3225380127293C2A2432 . '],"bonusInfo":{},"Jackpots":' . $_obf_0D28393910101E062539311B3F371C121912162B061E32 . ',"reelsSymbols":' . $_obf_0D273522403840350F0A36072E150A0524143F382C3B32 . '}}';
                $_obf_0D102E041D320C04053428092E175B1F320F1017340E11 = [];
                for( $i = 1; $i <= 5; $i++ ) 
                {
                    $_obf_0D102E041D320C04053428092E175B1F320F1017340E11[] = '"' . $i . '":{"1":"' . $reels['reel' . $i][3] . '","2":"' . $reels['reel' . $i][2] . '","3":"' . $reels['reel' . $i][1] . '","4":"' . $reels['reel' . $i][0] . '"}';
                }
                $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                $response = '{"status":"success","microtime":0.012106895446777,"dateTime":"2020-02-13 15:56:37","error":"","content":{"session":"54594109_4133a64673d3883d42cd003ee905ba3e","cmd":"gameSpin","balance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"win":' . ($totalWin * 100) . ',"symbols":{' . implode(',', $_obf_0D102E041D320C04053428092E175B1F320F1017340E11) . '},"winLines":[' . $_obf_0D5B5C2E0D1C3D1F232F3E051D3225380127293C2A2432 . '],"freeSpin":{' . $_obf_0D1E5B120D2A071E012A32025C390D0F061109362A0111 . '},"actionId":"54594109_0_315","hash":"3f8366f9f05bada378a5a4a37034e744"}}';
                $slotSettings->SaveLogReport($_obf_0D332B280C0C3223043E3831210D233725331D30261301, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotBet'], $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotLines'], $_obf_0D0C361D2E35362209025C2317232809271D34270D3232, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
