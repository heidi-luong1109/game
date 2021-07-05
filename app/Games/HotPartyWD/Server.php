<?php 
namespace VanguardLTE\Games\HotPartyWD
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
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['id'];
            if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cid']) ) 
            {
                $_obf_0D320C272C01163710281538400712181A0704263D1F01 = 'NxwFWiKl';
            }
            else
            {
                $_obf_0D320C272C01163710281538400712181A0704263D1F01 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cid'];
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['act'] == '464529TBNS' && $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') <= 0 ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid gamble state"}';
                exit( $response );
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['act'] == 'WXMNPP7H8F' ) 
            {
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['arg']['stake'] / 100 <= 0 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bet state"}';
                    exit( $response );
                }
                if( $slotSettings->GetBalance() < ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['arg']['stake'] / 100) && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= 0 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid balance"}';
                    exit( $response );
                }
            }
            switch( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['act'] ) 
            {
                case 'setup':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "ogEFvreY", "cid": "B1L81aKc", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"pv": 3, "ver": 4}, "s": "ok"}';
                    break;
                case 'nCGuJ1R7Iw98aD7o':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "DFeG9RU6", "cid": "BKYzNZNh", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"aa": "no", "accepted_regulations": "1", "account_id": "4486018", "cbe": "no", "ct": "C", "fb_id": "", "flags": "m[AhT]", "gA": "yes", "hk": "450649", "id": "4B05B2ADB05847C875C19787921A36663AFE8B68", "jackpot_type": "0", "mbos": "no", "payin_limit_reached": "0", "sa": "no", "session_id": "6324339", "stamp": "1d8c0899edfd4adbb803499d72bc21feba42f2fba7be46543cdff772220e10e904948583e26da5a550b4de4df9c05905049b7cf31e215776c14a0cfcb34395650c15ec0a6a9fb50a68ad8751185d4bbad429669debd4c9c7eab07606b1eac650033acd6ed546b391d45899e366a37a9fc1d9f479f8c10b70fa541814a492d3ec", "sv": "43.87", "token": "", "user_id": "4486018", "version": "Wazdan Web Server 3.2 GWT [JPS] git version: f2b6cabff859c316ce7436d94b480fbde678dcdd S: 43.87 T: C Aa:0 As:0 CTRL: SSL F: [IRS]"}, "s": "ok"}';
                    break;
                case 'TZE8GXY14X':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "j8Z5KXX1", "cid": "' . $_obf_0D320C272C01163710281538400712181A0704263D1F01 . '", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"currency": "' . $slotSettings->slotCurrency . '", "currency_display_as": "' . $slotSettings->slotCurrency . '", "currency_format_separ_type": "0", "currency_format_symbol_placement": "1", "point_ratio": "0.01", "screenShotMaxSize": "", "screenShotMinPrize": "", "screenShotType": "", "screenShotUrl": "", "screen_orientation_type": "", "show_currency": "C"}, "s": "ok"}';
                    break;
                case 'F18RRVF55I':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "KQDqJMsl", "cid": "' . $_obf_0D320C272C01163710281538400712181A0704263D1F01 . '", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"autoGameType": "1", "autoPrizeAfter": "120", "capi": "no", "cardEnable": "yes", "connectLoginEnable": "no", "couponHasBank": "no", "creditOnly": "yes", "demoMode": "no", "gA": "yes", "gamblingMaxLevel": "4", "gameConfiguration": "1", "gaming_allowed": "yes", "highScorePeriod": "0", "highScoreValue": "0", "highScoreValuesMaxCount": "0", "highStake": "100", "highStakeBankMode": "0", "higherStake": "50000", "histJackpotCount": "4", "histJackpotRange": "60", "histJackpotTime": "5", "histPrizeCount": "4", "histPrizeRange": "60", "histPrizeStart": "10000", "histPrizeTime": "5", "immediateHighScoreValue": "0", "itGameCredits": "0", "itMaxEnergy": "0", "jackpotDisplayStep": "1000", "jackpotIsBonus": "no", "jackpotName": "0", "jackpotPercent": "10", "maxBank": "0", "maxCouponValue": "0", "maxCredit": "100000", "maxCreditPayin": "10000", "maxCreditStake": "10000", "maxCreditToBlock": "100000", "maxGamblePrize": "0", "maxHopperPayout": "0", "maxNotes": "0", "maxPrize": "0", "maxPrizeToCredit": "no", "maxRiskGames": "0", "maxRiskGamesStake": "0", "maxStake": "10000", "maxTransfer": "0", "minCouponCreateValue": "0", "minCouponUseToPayout": "0", "minGamesToPayout": "20", "minStake": "10", "moneyInsertLimit": "10000", "newCouponEnable": "no", "newCouponEnableOnKiosk": "no", "noCouponPass": "no", "notesType": "0", "oneCouponInGroup": "no", "payoutFromBank": "no", "plusSignsEnabled": "0", "prizeTo": "-1", "quizEnabled": "no", "redemptionEnable": "no", "riskBankInterval": "0", "riskDispersion": "1", "riskEnabled": "yes", "roundSuperGames": "yes", "sasMetersEnabled": "no", "semiRoundSuperGames": "no", "showRecord": "no", "showTrademark": "1", "singleCouponEnable": "no", "skillGames": "0", "skillWheelGames": "no", "specVersion": "0", "stakeFromCreditOnly": "no", "superGameStake": "0", "superGamesAfterLostOnly": "no", "superGamesEnterType": "0", "superGamesFreq": "0", "superGamesMaxPrize": "0", "superGamesProb": "80", "superGamesRandom": "no", "superGamesRandomX2": "no", "superOnJPCounter": "1", "sweepEnable": "no", "sweepEnable2": "no", "transferB2K": "0", "transferB2KMode": "0", "transferEnable": "yes", "veryHighScoreValue": "0", "vltLogo": "yes", "voucherEnable": "no", "wbContinues": "no", "winBank2Credit": "yes", "winProfile": "82%", "winProfileSelect": "1"}, "s": "ok"}';
                    break;
                case 'P2AB7RC9UU':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "23cFxJWS", "cid": "' . $_obf_0D320C272C01163710281538400712181A0704263D1F01 . '", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": ["<config countdown_time=\"15\" currency_factor=\"1\" currency_type=\"KC\" date_format_type=\"1\" demo=\"0\" demo_anims_after=\"17\" disconnected_text_jp=\"Jackpot disconnected\" disconnected_text_jp_show=\"1\" disconnected_text_scroll_game=\"Jackpot disconnected\" disconnected_text_scroll_game_delay=\"5\" disconnected_text_scroll_game_show=\"0\" disconnected_text_scroll_main=\"Jackpot disconnected\" disconnected_text_scroll_main_delay=\"5\" disconnected_text_scroll_main_show=\"1\" effect_delay=\"60\" scroll_text_1=\"\" scroll_text_2=\"\" scroll_text_3=\"\" scroll_text_count=\"5\" scroll_text_delay=\"30\" scroll_text_game_1=\"\" scroll_text_game_2=\"\" scroll_text_game_3=\"\" scroll_text_game_count=\"2\" scroll_text_game_delay=\"10\" scroll_text_game_show=\"1\" scroll_text_show=\"1\" scroll_type=\"1\" show_alter_text_after=\"35\" stake_share=\"0\" /><sub_config currency=\"CP.\" point_ratio=\"1\" show_currency=\"C\" type=\"real\" />"], "s": "ok"}';
                    break;
                case 'GNNNVGVTKP':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "pfosYn2N", "cid": "' . $_obf_0D320C272C01163710281538400712181A0704263D1F01 . '", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"mode": "autorefill"}, "s": "ok"}';
                    break;
                case 'QE8J5MIKCA':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "KkfWlJRA", "cid": "' . $_obf_0D320C272C01163710281538400712181A0704263D1F01 . '", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"difficulty! level! mode": "1", "max.! lines": "2", "stake! per! line": "1"}, "s": "ok"}';
                    break;
                case 'DVVRWT9K7D':
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', -1);
                    $lastEvent = $slotSettings->GetHistory();
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', $lastEvent->serverResponse->BonusSymbol);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', 0);
                    }
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    for( $i = 0; $i < count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] * 20 * 100;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "sxYumxhx", "cid": "' . $_obf_0D320C272C01163710281538400712181A0704263D1F01 . '", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"bank": "0", "coins": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "credit": "10000", "difficulty_level_mode": "0", "energy": "1", "flags": "0", "free_rounds": "0", "iv": "3", "lines": "20", "maxstake": "' . ($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) - 1] * 20) . '", "minstake": "1", "notes": "0", "prize": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . '", "protocol_version": "1", "risk": "1", "skill_games": "0", "skill_record": "0", "stake": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "stake_list": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "stake_per_line": "1", "time": "0"}, "s": "ok"}';
                    break;
                case '1KI735SFY5':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "bTjXKLkS", "cid": "' . $_obf_0D320C272C01163710281538400712181A0704263D1F01 . '", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"bank": "0", "credit": "' . round($slotSettings->GetBalance() * 100) . '", "notes": "0", "time": "0"}, "s": "ok"}';
                    break;
                case 'D3425KPHW1':
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', -1);
                    $lastEvent = $slotSettings->GetHistory();
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', $lastEvent->serverResponse->BonusSymbol);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', 0);
                        $_obf_0D1C1D210B1F1B33075C310724290F3C132E1405255B01 = implode(',', $lastEvent->serverResponse->reelsSymbols->rp);
                        $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 = '' . $lastEvent->serverResponse->reelsSymbols->reel1[0] . ',' . $lastEvent->serverResponse->reelsSymbols->reel2[0] . ',' . $lastEvent->serverResponse->reelsSymbols->reel3[0] . ',' . $lastEvent->serverResponse->reelsSymbols->reel4[0] . ',' . $lastEvent->serverResponse->reelsSymbols->reel5[0] . '';
                        $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 .= (',' . $lastEvent->serverResponse->reelsSymbols->reel1[1] . ',' . $lastEvent->serverResponse->reelsSymbols->reel2[1] . ',' . $lastEvent->serverResponse->reelsSymbols->reel3[1] . ',' . $lastEvent->serverResponse->reelsSymbols->reel4[1] . ',' . $lastEvent->serverResponse->reelsSymbols->reel5[1] . '');
                        $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 .= (',' . $lastEvent->serverResponse->reelsSymbols->reel1[2] . ',' . $lastEvent->serverResponse->reelsSymbols->reel2[2] . ',' . $lastEvent->serverResponse->reelsSymbols->reel3[2] . ',' . $lastEvent->serverResponse->reelsSymbols->reel4[2] . ',' . $lastEvent->serverResponse->reelsSymbols->reel5[2] . '');
                        $bet = $lastEvent->serverResponse->slotBet * 100 * 20;
                    }
                    else
                    {
                        $_obf_0D1C1D210B1F1B33075C310724290F3C132E1405255B01 = implode(',', [
                            rand(0, count($slotSettings->reelStrip1) - 3), 
                            rand(0, count($slotSettings->reelStrip2) - 3), 
                            rand(0, count($slotSettings->reelStrip3) - 3)
                        ]);
                        $_obf_0D1427193624111E0F3F19161D3E05313F281B2B071E22 = rand(0, count($slotSettings->reelStrip1) - 3);
                        $_obf_0D40170234191D12013C08112D373F23141F21271C4022 = rand(0, count($slotSettings->reelStrip2) - 3);
                        $_obf_0D302D052E271A03052B5C2E3032091F292B160D0A5C32 = rand(0, count($slotSettings->reelStrip3) - 3);
                        $_obf_0D15172326073C2F213E5C1B5C3201270A032D23382322 = rand(0, count($slotSettings->reelStrip4) - 3);
                        $_obf_0D3D31062639082336285C2905020F2B063022132E0401 = rand(0, count($slotSettings->reelStrip5) - 3);
                        $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 = $slotSettings->reelStrip1[$_obf_0D1427193624111E0F3F19161D3E05313F281B2B071E22];
                        $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 = $slotSettings->reelStrip2[$_obf_0D40170234191D12013C08112D373F23141F21271C4022];
                        $_obf_0D3711263310365C0639400E142F04143C011B5B240322 = $slotSettings->reelStrip3[$_obf_0D302D052E271A03052B5C2E3032091F292B160D0A5C32];
                        $_obf_0D2A1A1E150D142B17291236053731323D0109193B1211 = $slotSettings->reelStrip4[$_obf_0D15172326073C2F213E5C1B5C3201270A032D23382322];
                        $_obf_0D103336361B0A5B3F10403C3E2D055C2E190F16351F11 = $slotSettings->reelStrip5[$_obf_0D3D31062639082336285C2905020F2B063022132E0401];
                        $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 = '' . $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 . ',' . $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 . ',' . $_obf_0D3711263310365C0639400E142F04143C011B5B240322 . ',' . $_obf_0D2A1A1E150D142B17291236053731323D0109193B1211 . ',' . $_obf_0D103336361B0A5B3F10403C3E2D055C2E190F16351F11;
                        $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 = $slotSettings->reelStrip1[$_obf_0D1427193624111E0F3F19161D3E05313F281B2B071E22 + 1];
                        $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 = $slotSettings->reelStrip2[$_obf_0D40170234191D12013C08112D373F23141F21271C4022 + 1];
                        $_obf_0D3711263310365C0639400E142F04143C011B5B240322 = $slotSettings->reelStrip3[$_obf_0D302D052E271A03052B5C2E3032091F292B160D0A5C32 + 1];
                        $_obf_0D3711263310365C0639400E142F04143C011B5B240322 = $slotSettings->reelStrip4[$_obf_0D15172326073C2F213E5C1B5C3201270A032D23382322 + 1];
                        $_obf_0D3711263310365C0639400E142F04143C011B5B240322 = $slotSettings->reelStrip5[$_obf_0D3D31062639082336285C2905020F2B063022132E0401 + 1];
                        $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 .= (',' . $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 . ',' . $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 . ',' . $_obf_0D3711263310365C0639400E142F04143C011B5B240322 . ',' . $_obf_0D2A1A1E150D142B17291236053731323D0109193B1211 . ',' . $_obf_0D103336361B0A5B3F10403C3E2D055C2E190F16351F11);
                        $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 = $slotSettings->reelStrip1[$_obf_0D1427193624111E0F3F19161D3E05313F281B2B071E22 + 2];
                        $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 = $slotSettings->reelStrip2[$_obf_0D40170234191D12013C08112D373F23141F21271C4022 + 2];
                        $_obf_0D3711263310365C0639400E142F04143C011B5B240322 = $slotSettings->reelStrip3[$_obf_0D302D052E271A03052B5C2E3032091F292B160D0A5C32 + 2];
                        $_obf_0D3711263310365C0639400E142F04143C011B5B240322 = $slotSettings->reelStrip4[$_obf_0D15172326073C2F213E5C1B5C3201270A032D23382322 + 2];
                        $_obf_0D3711263310365C0639400E142F04143C011B5B240322 = $slotSettings->reelStrip5[$_obf_0D3D31062639082336285C2905020F2B063022132E0401 + 2];
                        $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 .= (',' . $_obf_0D2F0417270C151F0A092517350A5C24084024342E3711 . ',' . $_obf_0D1C350831253C0E053E0A0C14140F0B350816311B3701 . ',' . $_obf_0D3711263310365C0639400E142F04143C011B5B240322 . ',' . $_obf_0D2A1A1E150D142B17291236053731323D0109193B1211 . ',' . $_obf_0D103336361B0A5B3F10403C3E2D055C2E190F16351F11);
                        $bet = $slotSettings->Bet[0] * 100 * 20;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "JvRfPGCY", "cid": "' . $_obf_0D320C272C01163710281538400712181A0704263D1F01 . '", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"bonus_count": "' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '", "bonus_difficulty_level": "0", "bonus_energy": "0", "bonus_nr": "' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '", "bonus_stake": "' . $bet . '", "bonus_symbol": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusSymbol') - 1) . '", "max_lines": "20", "stake_of_bonus": "0", "stake_per_line": "1", "symb": "' . $_obf_0D0E28151E1B1A1A2F130B1D37332436301F2822370311 . '"}, "s": "ok"}';
                    break;
                case 'PTUDQQMKZB':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "CRc5ya6I", "cid": "' . $_obf_0D320C272C01163710281538400712181A0704263D1F01 . '", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "s": "ok"}';
                    break;
                case 'ping':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "KuaCagnK", "cid": "' . $_obf_0D320C272C01163710281538400712181A0704263D1F01 . '", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "s": "ok"}';
                    break;
                case 'close':
                    exit();
                    break;
                case 'pause':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "VfgEano2", "cid": "ewPLsKP1", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "s": "ok"}';
                    break;
                case 'resume':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "QKDe0XPD", "cid": "' . $_obf_0D320C272C01163710281538400712181A0704263D1F01 . '", "id":  ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "s": "ok"}';
                    break;
                case 'continue':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "QKDe0XPD", "cid": "' . $_obf_0D320C272C01163710281538400712181A0704263D1F01 . '", "id":  ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "s": "ok"}';
                    break;
                case 'PI1G7D2TDR':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "dSAbZCRf", "cid": "' . $_obf_0D320C272C01163710281538400712181A0704263D1F01 . '", "id":  ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"bank": "0", "credit": "' . round($slotSettings->GetBalance() * 100) . '", "notes": "0", "time": "0"}, "s": "ok"}';
                    break;
                case 'PI1G7D2TDR':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "aU0MYEP3", "cid": "MNVKfRUv", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"pv": 3, "ver": 3}, "s": "ok"}';
                    break;
                case 'WXMNPP7H8F':
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22 = 1;
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901 = [];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[0] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[1] = [
                        1, 
                        1, 
                        1, 
                        1, 
                        1
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[2] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[3] = [
                        2, 
                        2, 
                        1, 
                        2, 
                        2
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[4] = [
                        1, 
                        2, 
                        3, 
                        2, 
                        1
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[5] = [
                        3, 
                        2, 
                        1, 
                        2, 
                        3
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[6] = [
                        2, 
                        1, 
                        2, 
                        1, 
                        2
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[7] = [
                        2, 
                        3, 
                        2, 
                        3, 
                        2
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[8] = [
                        1, 
                        1, 
                        2, 
                        3, 
                        3
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[9] = [
                        3, 
                        3, 
                        2, 
                        1, 
                        1
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[10] = [
                        3, 
                        2, 
                        1, 
                        2, 
                        2
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[11] = [
                        3, 
                        2, 
                        1, 
                        1, 
                        1
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[12] = [
                        1, 
                        2, 
                        3, 
                        3, 
                        3
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[13] = [
                        1, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[14] = [
                        1, 
                        2, 
                        1, 
                        2, 
                        1
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[15] = [
                        3, 
                        2, 
                        3, 
                        2, 
                        3
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[16] = [
                        1, 
                        1, 
                        2, 
                        2, 
                        2
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[17] = [
                        3, 
                        3, 
                        2, 
                        2, 
                        2
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[18] = [
                        3, 
                        3, 
                        3, 
                        2, 
                        1
                    ];
                    $_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[19] = [
                        1, 
                        1, 
                        1, 
                        2, 
                        3
                    ];
                    $lines = 20;
                    $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['arg']['stake'] / 100;
                    $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 = $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 / $lines;
                    $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 = $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $lines;
                    if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                    {
                        $slotSettings->SetBalance(-1 * $_obf_0D34351C331E352827231A38333E1A082713062B2B2732, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D34351C331E352827231A38333E1A082713062B2B2732 / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $slotSettings->UpdateJackpots($_obf_0D34351C331E352827231A38333E1A082713062B2B2732);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', -1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', 0);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                        $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22 = $slotSettings->slotFreeMpl;
                    }
                    $balance = sprintf('%01.2f', $slotSettings->GetBalance());
                    $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832, $lines);
                    $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                    $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 = 0;
                        $_obf_0D181C103526150D021B2C0E1A1F211F3F3E2A15363632 = [];
                        $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11 = [
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
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
                        $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22 = [''];
                        $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22 = '5';
                        $_obf_0D3C090E192F3D26100429351F02123B310C3504040132 = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01 = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132;
                        for( $k = 0; $k < $lines; $k++ ) 
                        {
                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '';
                            for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                            {
                                $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = $slotSettings->SymbolGame[$j];
                                if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22 || !isset($slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132]) ) 
                                {
                                }
                                else
                                {
                                    $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22 = [];
                                    $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel1'][$_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][0] - 1];
                                    $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1] = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel2'][$_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][1] - 1];
                                    $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2] = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel3'][$_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][2] - 1];
                                    $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3] = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel4'][$_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][3] - 1];
                                    $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[4] = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel5'][$_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][4] - 1];
                                    if( $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][1] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 * $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22;
                                        if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":1,"Line":' . $k . ',"Win":' . $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] . ',"stepWin":' . ($_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] + $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 + $slotSettings->GetGameData('DolphinsPearlDXGTBonusWin')) . ',"winReel1":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][0] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] . '"],"winReel2":["none","none"],"winReel3":["none","none"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                        }
                                    }
                                    if( ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        }
                                        else if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][2] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 * $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22;
                                        if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":2,"Line":' . $k . ',"Win":' . $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] . ',"stepWin":' . ($_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] + $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 + $slotSettings->GetGameData('DolphinsPearlDXGTBonusWin')) . ',"winReel1":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][0] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] . '"],"winReel2":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][1] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1] . '"],"winReel3":["none","none"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                        }
                                    }
                                    if( ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        }
                                        else if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 * $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22;
                                        if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":3,"Line":' . $k . ',"Win":' . $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] . ',"stepWin":' . ($_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] + $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 + $slotSettings->GetGameData('DolphinsPearlDXGTBonusWin')) . ',"winReel1":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][0] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] . '"],"winReel2":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][1] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1] . '"],"winReel3":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][2] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2] . '"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                        }
                                    }
                                    if( ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        }
                                        else if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 * $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22;
                                        if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":4,"Line":' . $k . ',"Win":' . $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] . ',"stepWin":' . ($_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] + $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 + $slotSettings->GetGameData('DolphinsPearlDXGTBonusWin')) . ',"winReel1":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][0] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] . '"],"winReel2":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][1] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1] . '"],"winReel3":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][2] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2] . '"],"winReel4":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][3] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3] . '"],"winReel5":["none","none"]}';
                                        }
                                    }
                                    if( ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) && ($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[4] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[4], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22)) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) && in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[4], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                        }
                                        else if( in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) || in_array($_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[4], $_obf_0D09150B2722395B0A39250839035C2C1C053B311C2B22) ) 
                                        {
                                            $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 * $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22;
                                        if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":5,"Line":' . $k . ',"Win":' . $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] . ',"stepWin":' . ($_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] + $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 + $slotSettings->GetGameData('DolphinsPearlDXGTBonusWin')) . ',"winReel1":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][0] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[0] . '"],"winReel2":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][1] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[1] . '"],"winReel3":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][2] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[2] . '"],"winReel4":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][3] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[3] . '"],"winReel5":[' . ($_obf_0D1F0E07322B28015B3101401931191F0119352A1D0901[$k][4] - 1) . ',"' . $_obf_0D0235321E033F363607315C3F0E1F1837071C28240E22[4] . '"]}';
                                        }
                                    }
                                }
                            }
                            if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                            {
                                array_push($_obf_0D181C103526150D021B2C0E1A1F211F3F3E2A15363632, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                                $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 += $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k];
                            }
                        }
                        $_obf_0D10342528350D243D16293C2835061F263C1C39042811 = 0;
                        $_obf_0D2B28260915392535401B1E0E0F131108072321262C11 = 0;
                        $_obf_0D033835123E051D331E010A3C300C332C34021F052801 = '{';
                        $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11 = 0;
                        $_obf_0D2E030A3D363C3609223E2A38340211061A0C3C1F2511 = $slotSettings->GetGameData($slotSettings->slotId . 'BonusSymbol');
                        $_obf_0D2A1335372C0233305B350D0434101F2A2B170D072522 = 0;
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            $_obf_0D5B3C09162C1E06162134175B0B22135C392940101522 = false;
                            for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                            {
                                if( $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22 ) 
                                {
                                    $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11++;
                                    $_obf_0D033835123E051D331E010A3C300C332C34021F052801 .= ('"winReel' . $r . '":[' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . ',"' . $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22 . '"],');
                                    $_obf_0D5B3C09162C1E06162134175B0B22135C392940101522 = true;
                                }
                            }
                        }
                        $_obf_0D10342528350D243D16293C2835061F263C1C39042811 = $slotSettings->Paytable['SYM_' . $_obf_0D2B2F2802280E223138132C0B310F3C0A2D3328275C22][$_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11] * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * $lines * $_obf_0D3E1E10392C18192A17311514325C2E132A29390E2E22;
                        if( $_obf_0D0B230B342E0C0727115B043F283E2137182D312A3D11 >= 3 && $slotSettings->slotBonus ) 
                        {
                            $_obf_0D033835123E051D331E010A3C300C332C34021F052801 .= '"scattersType":"bonus",';
                        }
                        else if( $_obf_0D10342528350D243D16293C2835061F263C1C39042811 > 0 ) 
                        {
                            $_obf_0D033835123E051D331E010A3C300C332C34021F052801 .= '"scattersType":"win",';
                        }
                        else
                        {
                            $_obf_0D033835123E051D331E010A3C300C332C34021F052801 .= '"scattersType":"none",';
                        }
                        $_obf_0D033835123E051D331E010A3C300C332C34021F052801 .= ('"scattersWin":' . $_obf_0D10342528350D243D16293C2835061F263C1C39042811 . '}');
                        $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 += ($_obf_0D10342528350D243D16293C2835061F263C1C39042811 + $_obf_0D2B28260915392535401B1E0E0F131108072321262C11);
                        if( $i > 1000 ) 
                        {
                            $winType = 'none';
                        }
                        if( $slotSettings->increaseRTP && $winType == 'win' && $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 < ($lines * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 * rand(2, 5)) ) 
                        {
                        }
                        else if( !$slotSettings->increaseRTP && $winType == 'win' && $lines * $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 < $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 ) 
                        {
                        }
                        else
                        {
                            if( $i > 1500 ) 
                            {
                                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                                exit( $response );
                            }
                            if( $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 <= $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 && $winType == 'bonus' ) 
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
                            else if( $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 > 0 && $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 <= $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 && $winType == 'win' ) 
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
                            else if( $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 == 0 && $winType == 'none' ) 
                            {
                                break;
                            }
                        }
                    }
                    $flag = 0;
                    if( $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 > 0 ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32);
                        $slotSettings->SetBalance($_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32);
                        $flag = 6;
                    }
                    $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32);
                    }
                    $_obf_0D2E3437162622183F300B5C220C15055C2D38031B3511 = '03';
                    $_obf_0D3C090E192F3D26100429351F02123B310C3504040132 = $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01;
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($_obf_0D3C090E192F3D26100429351F02123B310C3504040132) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $_obf_0D181C103526150D021B2C0E1A1F211F3F3E2A15363632);
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"BonusSymbol":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusSymbol') . ',"slotLines":' . $lines . ',"slotBet":' . $_obf_0D3B5B082B1F0F0235292F01260B303B0F2E32313B0832 . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"freeStartWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeStartWin') . ',"totalWin":' . $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"bonusInfo":' . $_obf_0D033835123E051D331E010A3C300C332C34021F052801 . ',"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $_obf_0D2A01173F373E120F303B3F3E0505371B3424131B1701 = $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel1'][0] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel2'][0] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel3'][0] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel4'][0] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel5'][0] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel1'][1] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel2'][1] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel3'][1] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel4'][1] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel5'][1] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel1'][2] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel2'][2] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel3'][2] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel4'][2] . ',' . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel5'][2];
                    $slotSettings->SaveLogReport($response, $_obf_0D34351C331E352827231A38333E1A082713062B2B2732, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        if( $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 > 0 ) 
                        {
                            $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                        }
                        $flag = 6;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "MmWeiKrZ", "cid": "NxwFWiKl", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"bank": "0", "bonus_count": "' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '", "bonus_difficulty_level": "0", "bonus_energy": "0", "bonus_nr": "' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '", "bonus_stake": "' . round($_obf_0D34351C331E352827231A38333E1A082713062B2B2732 * 100) . '", "bonus_symbol": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusSymbol') - 1) . '", "cprize": "0", "credit": "' . round($balance * 100) . '", "flags": "' . $flag . '", "jprize": "0", "prize": "' . round($_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 * 100) . '", "symb": "' . $_obf_0D2A01173F373E120F303B3F3E0505371B3424131B1701 . '"}, "s": "ok"}';
                    break;
                case '9MHKS5E2Z2':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "8PIOHLo2", "cid": "FCj5rHuI", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"bank": "0", "credit": "' . round($slotSettings->GetBalance() * 100) . '", "flags": "0"}, "s": "ok"}';
                    break;
                case 'VKYHTCZVTN':
                    $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
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
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $_obf_0D2131292F1B0124035C2B071E143E103D3F17131F4032);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "Eh3gR27z", "cid": "8FHZOAu4", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"bank": "0", "cprize": "0", "credit": "' . round($_obf_0D3B0F07072E1D0906222F133E263B0B020301191C3501 * 100) . '", "flags": "12", "prize": "' . round($_obf_0D1027171F33402335295C22163623102E1C1D2F183522 * 100) . '", "transfered": "' . round($_obf_0D1027171F33402335295C22163623102E1C1D2F183522 * 100) . '", "x": "0"}, "s": "ok"}';
                    break;
                case 'KZHGWHDL9T':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "rWJBqTiq", "cid": "FCj5rHuI", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "s": "ok"}';
                    break;
                case '464529TBNS':
                    $Balance = $slotSettings->GetBalance();
                    $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = rand(1, $slotSettings->GetGambleSettings());
                    $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = '';
                    $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = 0;
                    $_obf_0D3310323F3F07041133133D263014342B230C260D1F11 = $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32;
                    $_obf_0D3432405B08083C14042E280E332A21241F3610122411 = 0;
                    if( $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : '')) < ($_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 * 2) ) 
                    {
                        $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = 0;
                    }
                    if( $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 == 1 ) 
                    {
                        $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'win';
                        $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32;
                        $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 = $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 * 2;
                        $_obf_0D3432405B08083C14042E280E332A21241F3610122411 = 1;
                        $_obf_0D0F03142D1F381629232709080F353D100B2E081D3101 = '6';
                    }
                    else
                    {
                        $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'lose';
                        $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = -1 * $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32;
                        $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 = 0;
                        $_obf_0D3432405B08083C14042E280E332A21241F3610122411 = 0;
                        $_obf_0D0F03142D1F381629232709080F353D100B2E081D3101 = '0';
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32);
                    $slotSettings->SetBalance($_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22);
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 * -1);
                    $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 = $slotSettings->GetBalance();
                    $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = '{"dealerCard":"' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 . '","gambleState":"' . $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 . '","totalWin":' . $_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 . ',"afterBalance":' . $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 . ',"Balance":' . $Balance . '}';
                    $response = '{"responseEvent":"gambleResult","serverResponse":' . $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 . '}';
                    $slotSettings->SaveLogReport($response, $_obf_0D3310323F3F07041133133D263014342B230C260D1F11, 1, $_obf_0D3310323F3F07041133133D263014342B230C260D1F11 + $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22, 'slotGamble');
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "JtxxRtC8", "cid": "FCj5rHuI", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"bank": "0", "cprize": "0", "credit": "' . round($_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 * 100) . '", "flags": "' . $_obf_0D0F03142D1F381629232709080F353D100B2E081D3101 . '", "prize": "' . round($_obf_0D0137091E13053E273C250F3E3E251D162D2A0C0B2F32 * 100) . '", "win": "' . $_obf_0D3432405B08083C14042E280E332A21241F3610122411 . '", "x": "0"}, "s": "ok"}';
                    break;
                case 'W42THTUT96':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '{"a": "aTjH2yIT", "cid": "FCj5rHuI", "id": ' . $_obf_0D103E5B092B2E1E0D5C0A15011F221F321932311C1622 . ', "res": {"flags": "0"}, "s": "ok"}';
                    break;
            }
            $response = implode('------', $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01);
            $slotSettings->SaveGameData();
            \DB::commit();
            return ':::' . $response;
        }
    }

}
