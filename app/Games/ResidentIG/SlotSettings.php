<?php 
namespace VanguardLTE\Games\ResidentIG
{
    class SlotSettings
    {
        public $playerId = null;
        public $splitScreen = null;
        public $reelStrip1 = null;
        public $reelStrip2 = null;
        public $reelStrip3 = null;
        public $reelStrip4 = null;
        public $reelStrip5 = null;
        public $reelStrip6 = null;
        public $reelStripBonus1 = null;
        public $reelStripBonus2 = null;
        public $reelStripBonus3 = null;
        public $reelStripBonus4 = null;
        public $reelStripBonus5 = null;
        public $reelStripBonus6 = null;
        public $slotId = '';
        public $slotDBId = '';
        public $Line = null;
        public $scaleMode = null;
        public $numFloat = null;
        public $gameLine = null;
        public $Bet = null;
        public $isBonusStart = null;
        public $Balance = null;
        public $SymbolGame = null;
        public $GambleType = null;
        public $lastEvent = null;
        public $Jackpots = [];
        public $keyController = null;
        public $slotViewState = null;
        public $hideButtons = null;
        public $slotReelsConfig = null;
        public $slotFreeCount = null;
        public $slotFreeMpl = null;
        public $slotWildMpl = null;
        public $slotExitUrl = null;
        public $slotBonus = null;
        public $slotBonusType = null;
        public $slotScatterType = null;
        public $slotGamble = null;
        public $fuseBet = null;
        public $cardsID = null;
        public $Paytable = [];
        public $slotSounds = [];
        private $jpgs = null;
        private $Bank = null;
        private $Percent = null;
        private $WinLine = null;
        private $WinGamble = null;
        private $Bonus = null;
        private $shop_id = null;
        public $licenseDK = null;
        public $currency = null;
        public $user = null;
        public $game = null;
        public $shop = null;
        public function __construct($sid, $playerId)
        {
/*            if( config('LicenseDK.APL_INCLUDE_KEY_CONFIG') != 'wi9qydosuimsnls5zoe5q298evkhim0ughx1w16qybs2fhlcpn' ) 
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
            $this->licenseDK = true;
            $checked = new \VanguardLTE\Lib\LicenseDK();
            $license_notifications_array = $checked->aplVerifyLicenseDK(null, 0);
            if( $license_notifications_array['notification_case'] != 'notification_license_ok' ) 
            {
                $this->licenseDK = false;
            }*/
            $this->slotId = $sid;
            $this->playerId = $playerId;
            $user = \VanguardLTE\User::lockForUpdate()->find($this->playerId);
            $this->user = $user;
            $this->shop_id = $user->shop_id;
            $game = \VanguardLTE\Game::where([
                'name' => $this->slotId, 
                'shop_id' => $this->shop_id
            ])->lockForUpdate()->first();
            $this->shop = \VanguardLTE\Shop::find($this->shop_id);
            $this->game = $game;
            $this->increaseRTP = rand(0, 1);
            $this->CurrentDenom = $this->game->denomination;
            $this->scaleMode = 0;
            $this->numFloat = 0;
            $this->cardsID['2D'] = 66;
            $this->cardsID['3D'] = 67;
            $this->cardsID['4D'] = 68;
            $this->cardsID['5D'] = 69;
            $this->cardsID['6D'] = 70;
            $this->cardsID['7D'] = 71;
            $this->cardsID['8D'] = 72;
            $this->cardsID['9D'] = 73;
            $this->cardsID['TD'] = 74;
            $this->cardsID['JD'] = 75;
            $this->cardsID['QD'] = 76;
            $this->cardsID['KD'] = 77;
            $this->cardsID['AD'] = 78;
            $this->cardsID['2C'] = 34;
            $this->cardsID['3C'] = 35;
            $this->cardsID['4C'] = 36;
            $this->cardsID['5C'] = 37;
            $this->cardsID['6C'] = 38;
            $this->cardsID['7C'] = 39;
            $this->cardsID['8C'] = 40;
            $this->cardsID['9C'] = 41;
            $this->cardsID['TC'] = 42;
            $this->cardsID['JC'] = 43;
            $this->cardsID['QC'] = 44;
            $this->cardsID['KC'] = 45;
            $this->cardsID['AC'] = 46;
            $this->cardsID['2S'] = 18;
            $this->cardsID['3S'] = 19;
            $this->cardsID['4S'] = 20;
            $this->cardsID['5S'] = 21;
            $this->cardsID['6S'] = 22;
            $this->cardsID['7S'] = 23;
            $this->cardsID['8S'] = 24;
            $this->cardsID['9S'] = 25;
            $this->cardsID['TS'] = 26;
            $this->cardsID['JS'] = 27;
            $this->cardsID['QS'] = 28;
            $this->cardsID['KS'] = 29;
            $this->cardsID['AS'] = 30;
            $this->cardsID['2H'] = 130;
            $this->cardsID['3H'] = 131;
            $this->cardsID['4H'] = 132;
            $this->cardsID['5H'] = 133;
            $this->cardsID['6H'] = 134;
            $this->cardsID['7H'] = 135;
            $this->cardsID['8H'] = 136;
            $this->cardsID['9H'] = 137;
            $this->cardsID['TH'] = 138;
            $this->cardsID['JH'] = 139;
            $this->cardsID['QH'] = 140;
            $this->cardsID['KH'] = 141;
            $this->cardsID['AH'] = 142;
            $this->cardsID['JOKERD'] = 511;
            $this->cardsID['JOKERC'] = 511;
            $this->cardsID['JOKERH'] = 511;
            $this->cardsID['JOKERS'] = 511;
            $this->Paytable[0] = [
                0, 
                0, 
                0, 
                0, 
                0, 
                0
            ];
            $this->Paytable[1] = [
                0, 
                0, 
                0, 
                200, 
                1000, 
                5000
            ];
            $this->Paytable[2] = [
                0, 
                0, 
                0, 
                100, 
                500, 
                2000
            ];
            $this->Paytable[3] = [
                0, 
                0, 
                0, 
                30, 
                100, 
                500
            ];
            $this->Paytable[4] = [
                0, 
                0, 
                0, 
                20, 
                50, 
                200
            ];
            $this->Paytable[5] = [
                0, 
                0, 
                0, 
                10, 
                30, 
                100
            ];
            $this->Paytable[6] = [
                0, 
                0, 
                0, 
                5, 
                10, 
                50
            ];
            $this->Paytable[7] = [
                0, 
                0, 
                0, 
                3, 
                5, 
                20
            ];
            $this->Paytable[8] = [
                0, 
                0, 
                0, 
                2, 
                3, 
                10
            ];
            $reel = new GameReel();
            foreach( [
                'reelStrip1', 
                'reelStrip2', 
                'reelStrip3', 
                'reelStrip4', 
                'reelStrip5', 
                'reelStrip6'
            ] as $reelStrip ) 
            {
                if( count($reel->reelsStrip[$reelStrip]) ) 
                {
                    $this->$reelStrip = $reel->reelsStrip[$reelStrip];
                }
            }
            $this->slotViewState = ($game->slotViewState == '' ? 'Normal' : $game->slotViewState);
            if( isset($game->slotKeyConfig) ) 
            {
                $this->slotKeyConfig = $game->slotKeyConfig;
            }
            else
            {
                $this->slotKeyConfig = '{"h_Exit":[83],"h_Start":[32,67],"h_Line1":[49],"h_Line3":[50],"h_Line5":[51],"h_Line7":[52],"h_Line9":[53],"h_AutoPlay":[90],"h_FullScreen":[54],"h_Help":[73],"h_MaxBet":[77],"h_Bet":[66],"h_Sound":[57]}';
            }
            $this->keyController = [
                '13' => 'uiButtonSpin,uiButtonSkip', 
                '49' => 'uiButtonInfo', 
                '50' => 'uiButtonCollect', 
                '51' => 'uiButtonExit2', 
                '52' => 'uiButtonLinesMinus', 
                '53' => 'uiButtonLinesPlus', 
                '54' => 'uiButtonBetMinus', 
                '55' => 'uiButtonBetPlus', 
                '56' => 'uiButtonGamble', 
                '57' => 'uiButtonRed', 
                '48' => 'uiButtonBlack', 
                '189' => 'uiButtonAuto', 
                '187' => 'uiButtonSpin'
            ];
            $this->slotReelsConfig = [
                [
                    425, 
                    142, 
                    3
                ], 
                [
                    669, 
                    142, 
                    3
                ], 
                [
                    913, 
                    142, 
                    3
                ], 
                [
                    1157, 
                    142, 
                    3
                ], 
                [
                    1401, 
                    142, 
                    3
                ]
            ];
            $this->slotBonusType = 1;
            $this->slotScatterType = 0;
            $this->splitScreen = false;
            $this->slotBonus = true;
            $this->slotGamble = true;
            $this->slotFastStop = 1;
            $this->slotExitUrl = '/';
            $this->slotWildMpl = 1;
            $this->GambleType = 1;
            $this->slotFreeCount = 15;
            $this->slotFreeMpl = 1;
            $this->slotViewState = ($game->slotViewState == '' ? 'Normal' : $game->slotViewState);
            $this->hideButtons = [];
            $this->jpgs = \VanguardLTE\JPG::where('shop_id', $this->shop_id)->lockForUpdate()->get();
            $this->Line = [
                1, 
                2, 
                3, 
                4, 
                5, 
                6, 
                7, 
                8, 
                9, 
                10
            ];
            $this->gameLine = [
                1, 
                2, 
                3, 
                4, 
                5, 
                6, 
                7, 
                8, 
                9
            ];
            $this->Bet = [
                1, 
                2, 
                3, 
                4, 
                5, 
                6, 
                7, 
                8, 
                9, 
                10, 
                15, 
                20, 
                25, 
                30, 
                35, 
                40, 
                45, 
                50, 
                60, 
                70, 
                80, 
                90
            ];
            $this->Balance = $user->balance;
            $this->SymbolGame = [
                '0', 
                '1', 
                2, 
                3, 
                4, 
                5, 
                6, 
                7, 
                8
            ];
            $this->Bank = $game->get_gamebank();
            $this->Percent = $this->shop->percent;
            $this->WinGamble = $game->rezerv;
            $this->slotDBId = $game->id;
            $this->slotCurrency = $user->shop->currency;
            if( $user->count_balance == 0 ) 
            {
                $this->Percent = 100;
                $this->slotJackPercent = 0;
                $this->slotJackPercent0 = 0;
            }
            $this->fuseBet = $game->cask;
            if( !isset($this->user->session) || strlen($this->user->session) <= 0 ) 
            {
                $this->user->session = serialize([]);
            }
            $this->gameData = unserialize($this->user->session);
            if( count($this->gameData) > 0 ) 
            {
                foreach( $this->gameData as $key => $vl ) 
                {
                    if( $vl['timelife'] <= time() ) 
                    {
                        unset($this->gameData[$key]);
                    }
                }
            }
        }
        public function SetGameData($key, $value)
        {
            $_obf_0D040604031A0C332A392C0F2E0C1018072E3C1C1B3C32 = 86400;
            $this->gameData[$key] = [
                'timelife' => time() + $_obf_0D040604031A0C332A392C0F2E0C1018072E3C1C1B3C32, 
                'payload' => $value
            ];
        }
        public function GetGameData($key)
        {
            if( isset($this->gameData[$key]) ) 
            {
                return $this->gameData[$key]['payload'];
            }
            else
            {
                return 0;
            }
        }
        public function FormatFloat($num)
        {
            $str0 = explode('.', $num);
            if( isset($str0[1]) ) 
            {
                if( strlen($str0[1]) > 4 ) 
                {
                    return round($num * 100) / 100;
                }
                else if( strlen($str0[1]) > 2 ) 
                {
                    return floor($num * 100) / 100;
                }
                else
                {
                    return $num;
                }
            }
            else
            {
                return $num;
            }
        }
        public function SaveGameData()
        {
            $this->user->session = serialize($this->gameData);
            $this->user->save();
            $this->user->refresh();
        }
        public function CheckBonusWin()
        {
            $_obf_0D250A3827310B5B0C0D121C1303111534020E0F181C01 = 0;
            $_obf_0D1003233B2728340337151E14011404193D37332A1301 = 0;
            foreach( $this->Paytable as $vl ) 
            {
                foreach( $vl as $_obf_0D0F161E053D31023119151106020D370C340240140611 ) 
                {
                    if( $_obf_0D0F161E053D31023119151106020D370C340240140611 > 0 ) 
                    {
                        $_obf_0D250A3827310B5B0C0D121C1303111534020E0F181C01++;
                        $_obf_0D1003233B2728340337151E14011404193D37332A1301 += $_obf_0D0F161E053D31023119151106020D370C340240140611;
                        break;
                    }
                }
            }
            return $_obf_0D1003233B2728340337151E14011404193D37332A1301 / $_obf_0D250A3827310B5B0C0D121C1303111534020E0F181C01;
        }
        public function HasGameData($key)
        {
            if( isset($this->gameData[$key]) ) 
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        public function GetDealerCard()
        {
            $_obf_0D3C3C291E1C0C35190328050B241A1B1823083E080C01 = [
                '2', 
                '3', 
                '4', 
                '5', 
                '6', 
                '7', 
                '8', 
                '9', 
                'T', 
                'J', 
                'Q', 
                'K', 
                'A'
            ];
            $_obf_0D1D3414043419265B0F1435131D401D0705351B330301 = [
                'C', 
                'D', 
                'S', 
                'H'
            ];
            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01 = [];
            shuffle($_obf_0D3C3C291E1C0C35190328050B241A1B1823083E080C01);
            shuffle($_obf_0D1D3414043419265B0F1435131D401D0705351B330301);
            $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01 = $_obf_0D3C3C291E1C0C35190328050B241A1B1823083E080C01[0] . $_obf_0D1D3414043419265B0F1435131D401D0705351B330301[0];
            return $_obf_0D3933282D2F3207131E01322E3D2A243306341C300F01;
        }
        public function Bonus($bet, $fuseBet)
        {
            $_obf_0D40213D111E3C370802020F340E170F400F0A06163532 = [
                0, 
                0, 
                0, 
                0, 
                0, 
                0, 
                0, 
                0, 
                2, 
                2, 
                2, 
                2, 
                2, 
                5, 
                5, 
                5, 
                5, 
                5, 
                10, 
                10, 
                10, 
                10, 
                10, 
                25, 
                25, 
                15, 
                15, 
                20, 
                20, 
                30, 
                30, 
                50, 
                50
            ];
            shuffle($_obf_0D40213D111E3C370802020F340E170F400F0A06163532);
            $_obf_0D3C162D36343E2D2D02371D080A2219080E0C26210232 = 0;
            $_obf_0D34133B2D401823121A3E3C0C3B3440063B2832150332 = [];
            $_obf_0D2D2F1A5B1A3E312F26112C19113D0A231919045C2732 = '';
            for( $i = 0; $i < 4; $i++ ) 
            {
                $_obf_0D362832171714063F2F145B3E251F362B012122193D32 = $_obf_0D40213D111E3C370802020F340E170F400F0A06163532[$i] * $bet;
                $_obf_0D3C162D36343E2D2D02371D080A2219080E0C26210232 += $_obf_0D362832171714063F2F145B3E251F362B012122193D32;
                $_obf_0D34133B2D401823121A3E3C0C3B3440063B2832150332[] = '{"Coef":' . $_obf_0D40213D111E3C370802020F340E170F400F0A06163532[$i] . ',"Win":' . $_obf_0D362832171714063F2F145B3E251F362B012122193D32 . '}';
                if( $_obf_0D362832171714063F2F145B3E251F362B012122193D32 == 0 && $fuseBet ) 
                {
                    $fuseBet = false;
                }
                else if( $_obf_0D362832171714063F2F145B3E251F362B012122193D32 == 0 ) 
                {
                    break;
                }
            }
            if( $i >= 5 && ($_obf_0D362832171714063F2F145B3E251F362B012122193D32 > 0 || $fuseBet) ) 
            {
                $_obf_0D1E071137182D332A1B0E1E0B3D260217153D133B2601 = [
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    0, 
                    50, 
                    50, 
                    50, 
                    50, 
                    100, 
                    100, 
                    100, 
                    150, 
                    150, 
                    250
                ];
                shuffle($_obf_0D1E071137182D332A1B0E1E0B3D260217153D133B2601);
                $_obf_0D362832171714063F2F145B3E251F362B012122193D32 = $_obf_0D1E071137182D332A1B0E1E0B3D260217153D133B2601[0] * $bet;
                $_obf_0D3C162D36343E2D2D02371D080A2219080E0C26210232 += $_obf_0D362832171714063F2F145B3E251F362B012122193D32;
                $_obf_0D2D2F1A5B1A3E312F26112C19113D0A231919045C2732 = '"BonusWins":[' . implode(',', $_obf_0D34133B2D401823121A3E3C0C3B3440063B2832150332) . '],"SuperWin":{"Coef":' . $_obf_0D1E071137182D332A1B0E1E0B3D260217153D133B2601[0] . ',"Win":' . $_obf_0D362832171714063F2F145B3E251F362B012122193D32 . '},';
            }
            else
            {
                $_obf_0D2D2F1A5B1A3E312F26112C19113D0A231919045C2732 = '"BonusWins":[' . implode(',', $_obf_0D34133B2D401823121A3E3C0C3B3440063B2832150332) . '],';
            }
            return [
                'win' => $_obf_0D3C162D36343E2D2D02371D080A2219080E0C26210232, 
                'info' => $_obf_0D2D2F1A5B1A3E312F26112C19113D0A231919045C2732
            ];
        }
        public function GetHistory()
        {
            $history = \VanguardLTE\GameLog::whereRaw('game_id=? and user_id=? ORDER BY id DESC LIMIT 10', [
                $this->slotDBId, 
                $this->playerId
            ])->get();
            $this->lastEvent = 'NULL';
            foreach( $history as $log ) 
            {
                $_obf_0D1F212D1B1A262C271C2C331110342F041A3014182301 = json_decode($log->str);
                if( isset($_obf_0D1F212D1B1A262C271C2C331110342F041A3014182301->cmd) && $_obf_0D1F212D1B1A262C271C2C331110342F041A3014182301->cmd == 'start' ) 
                {
                    $this->lastEvent = $log->str;
                    break;
                }
            }
            if( isset($_obf_0D1F212D1B1A262C271C2C331110342F041A3014182301) ) 
            {
                return $_obf_0D1F212D1B1A262C271C2C331110342F041A3014182301;
            }
            else
            {
                return 'NULL';
            }
        }
        public function UpdateJackpots($bet)
        {
            $bet = $bet * $this->CurrentDenom;
            $count_balance = $this->GetCountBalanceUser();
            $_obf_0D0E13392A1E352D293108251212135B0D022529241422 = [];
            $_obf_0D052A14092A1117372103081A331C2C2622010A2D0C22 = 0;
            for( $i = 0; $i < count($this->jpgs); $i++ ) 
            {
                if( $count_balance == 0 ) 
                {
                    $_obf_0D0E13392A1E352D293108251212135B0D022529241422[$i] = $this->jpgs[$i]->balance;
                }
                else if( $count_balance < $bet ) 
                {
                    $_obf_0D0E13392A1E352D293108251212135B0D022529241422[$i] = $count_balance / 100 * $this->jpgs[$i]->percent + $this->jpgs[$i]->balance;
                }
                else
                {
                    $_obf_0D0E13392A1E352D293108251212135B0D022529241422[$i] = $bet / 100 * $this->jpgs[$i]->percent + $this->jpgs[$i]->balance;
                }
                if( $this->jpgs[$i]->pay_sum < $_obf_0D0E13392A1E352D293108251212135B0D022529241422[$i] && $this->jpgs[$i]->pay_sum > 0 ) 
                {
                    $_obf_0D052A14092A1117372103081A331C2C2622010A2D0C22 = $this->jpgs[$i]->pay_sum / $this->CurrentDenom;
                    $_obf_0D0E13392A1E352D293108251212135B0D022529241422[$i] = $_obf_0D0E13392A1E352D293108251212135B0D022529241422[$i] - $this->jpgs[$i]->pay_sum;
                    $this->SetBalance($this->jpgs[$i]->pay_sum / $this->CurrentDenom);
                    if( $this->jpgs[$i]->pay_sum > 0 ) 
                    {
                        \VanguardLTE\StatGame::create([
                            'user_id' => $this->playerId, 
                            'balance' => $this->Balance * $this->CurrentDenom, 
                            'bet' => 0, 
                            'win' => $this->jpgs[$i]->pay_sum, 
                            'game' => $this->game->name . ' JPG ' . $this->jpgs[$i]->id, 
                            'percent' => 0, 
                            'percent_jps' => 0, 
                            'percent_jpg' => 0, 
                            'profit' => 0, 
                            'shop_id' => $this->shop_id
                        ]);
                    }
                }
                $this->jpgs[$i]->update(['balance' => $_obf_0D0E13392A1E352D293108251212135B0D022529241422[$i]]);
                $this->jpgs[$i] = $this->jpgs[$i]->refresh();
                if( $this->jpgs[$i]->balance < $this->jpgs[$i]->start_balance ) 
                {
                    $summ = $this->jpgs[$i]->start_balance;
                    if( $summ > 0 ) 
                    {
                        $this->jpgs[$i]->add_jps(false, $summ);
                    }
                }
            }
            if( $_obf_0D052A14092A1117372103081A331C2C2622010A2D0C22 > 0 ) 
            {
                $_obf_0D052A14092A1117372103081A331C2C2622010A2D0C22 = sprintf('%01.2f', $_obf_0D052A14092A1117372103081A331C2C2622010A2D0C22);
                $this->Jackpots['jackPay'] = $_obf_0D052A14092A1117372103081A331C2C2622010A2D0C22;
            }
        }
        public function GetBank($slotState = '')
        {
            if( $this->isBonusStart || $slotState == 'bonus' || $slotState == 'freespin' || $slotState == 'respin' ) 
            {
                $slotState = 'bonus';
            }
            else
            {
                $slotState = '';
            }
            $game = $this->game;
            $game->refresh();
            $this->Bank = $game->get_gamebank($slotState);
            return $this->Bank / $this->CurrentDenom;
        }
        public function GetPercent()
        {
            return $this->Percent;
        }
        public function GetCountBalanceUser()
        {
            $this->user->session = serialize($this->gameData);
            $this->user->save();
            $this->user->refresh();
            $this->gameData = unserialize($this->user->session);
            return $this->user->count_balance;
        }
        public function InternalError($errcode)
        {
            $_obf_0D280A1516183F171D1809285B36091811040F26391C11 = '';
            $_obf_0D280A1516183F171D1809285B36091811040F26391C11 .= "\n";
            $_obf_0D280A1516183F171D1809285B36091811040F26391C11 .= ('{"responseEvent":"error","responseType":"' . $errcode . '","serverResponse":"InternalError"}');
            $_obf_0D280A1516183F171D1809285B36091811040F26391C11 .= "\n";
            $_obf_0D280A1516183F171D1809285B36091811040F26391C11 .= ' ############################################### ';
            $_obf_0D280A1516183F171D1809285B36091811040F26391C11 .= "\n";
            $_obf_0D05022C0626351A3C1C5B0D0A2D1A1B0D061C05380332 = '';
            if( file_exists(storage_path('logs/') . $this->slotId . 'Internal.log') ) 
            {
                $_obf_0D05022C0626351A3C1C5B0D0A2D1A1B0D061C05380332 = file_get_contents(storage_path('logs/') . $this->slotId . 'Internal.log');
            }
            file_put_contents(storage_path('logs/') . $this->slotId . 'Internal.log', $_obf_0D05022C0626351A3C1C5B0D0A2D1A1B0D061C05380332 . $_obf_0D280A1516183F171D1809285B36091811040F26391C11);
            exit( '{"responseEvent":"error","responseType":"' . $errcode . '","serverResponse":"InternalError"}' );
        }
        public function SetBank($slotState = '', $sum, $slotEvent = '')
        {
            if( $this->isBonusStart || $slotState == 'bonus' || $slotState == 'freespin' || $slotState == 'respin' ) 
            {
                $slotState = 'bonus';
            }
            else
            {
                $slotState = '';
            }
            if( $this->GetBank($slotState) + $sum < 0 ) 
            {
                $this->InternalError('Bank_   ' . $sum . '  CurrentBank_ ' . $this->GetBank($slotState) . ' CurrentState_ ' . $slotState);
            }
            $sum = $sum * $this->CurrentDenom;
            $game = $this->game;
            $_obf_0D16300411093D18353F3F2A1D5C1D3E3D25372E3D0411 = 0;
            if( $sum > 0 && $slotEvent == 'bet' ) 
            {
                $this->toGameBanks = 0;
                $this->toSlotJackBanks = 0;
                $this->toSysJackBanks = 0;
                $this->betProfit = 0;
                $_obf_0D03242C3B012A362E1A1A28031B25022E0E073B353922 = $this->GetPercent();
                $_obf_0D111A0318183C030C5C320E1D02182D23063522273322 = 10;
                $count_balance = $this->GetCountBalanceUser();
                $_obf_0D16380F3724101637270127352E0C1A06122840150932 = $sum / $this->GetPercent() * 100;
                if( $count_balance < $_obf_0D16380F3724101637270127352E0C1A06122840150932 && $count_balance > 0 ) 
                {
                    $_obf_0D3B1F2B0C113B290D023E032B1D115B5C150109370B32 = $count_balance;
                    $_obf_0D1D235B2128121127373D391B112E3B281D023C5B3722 = $_obf_0D16380F3724101637270127352E0C1A06122840150932 - $_obf_0D3B1F2B0C113B290D023E032B1D115B5C150109370B32;
                    $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D3B1F2B0C113B290D023E032B1D115B5C150109370B32 / 100 * $this->GetPercent();
                    $sum = $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 + $_obf_0D1D235B2128121127373D391B112E3B281D023C5B3722;
                    $_obf_0D16300411093D18353F3F2A1D5C1D3E3D25372E3D0411 = $_obf_0D3B1F2B0C113B290D023E032B1D115B5C150109370B32 / 100 * $_obf_0D111A0318183C030C5C320E1D02182D23063522273322;
                }
                else if( $count_balance > 0 ) 
                {
                    $_obf_0D16300411093D18353F3F2A1D5C1D3E3D25372E3D0411 = $_obf_0D16380F3724101637270127352E0C1A06122840150932 / 100 * $_obf_0D111A0318183C030C5C320E1D02182D23063522273322;
                }
                for( $i = 0; $i < count($this->jpgs); $i++ ) 
                {
                    if( $count_balance < $_obf_0D16380F3724101637270127352E0C1A06122840150932 && $count_balance > 0 ) 
                    {
                        $this->toSysJackBanks += ($count_balance / 100 * $this->jpgs[$i]->percent);
                    }
                    else if( $count_balance > 0 ) 
                    {
                        $this->toSysJackBanks += ($_obf_0D16380F3724101637270127352E0C1A06122840150932 / 100 * $this->jpgs[$i]->percent);
                    }
                }
                $this->toGameBanks = $sum;
                $this->betProfit = $_obf_0D16380F3724101637270127352E0C1A06122840150932 - $this->toGameBanks - $this->toSlotJackBanks - $this->toSysJackBanks;
            }
            if( $sum > 0 ) 
            {
                $this->toGameBanks = $sum;
            }
            if( $_obf_0D16300411093D18353F3F2A1D5C1D3E3D25372E3D0411 > 0 ) 
            {
                $sum -= $_obf_0D16300411093D18353F3F2A1D5C1D3E3D25372E3D0411;
                $game->set_gamebank($_obf_0D16300411093D18353F3F2A1D5C1D3E3D25372E3D0411, 'inc', 'bonus');
            }
            $game->set_gamebank($sum, 'inc', $slotState);
            $game->save();
            return $game;
        }
        public function SetBalance($sum, $slotEvent = '')
        {
            if( $this->GetBalance() + $sum < 0 ) 
            {
                $this->InternalError('Balance_   ' . $sum);
            }
            $sum = $sum * $this->CurrentDenom;
            $user = $this->user;
            if( $sum < 0 && $slotEvent == 'bet' ) 
            {
                $user->wager = $user->wager + $sum;
                $user->wager = $this->FormatFloat($user->wager);
                $user->count_balance = $user->count_balance + $sum;
                $user->count_balance = $this->FormatFloat($user->count_balance);
            }
            $user->balance = $user->balance + $sum;
            $user->balance = $this->FormatFloat($user->balance);
            $this->user->session = serialize($this->gameData);
            $this->user->save();
            $this->user->refresh();
            $this->gameData = unserialize($this->user->session);
            if( $user->balance == 0 ) 
            {
                $user->update([
                    'wager' => 0, 
                    'bonus' => 0
                ]);
            }
            if( $user->wager == 0 ) 
            {
                $user->update(['bonus' => 0]);
            }
            if( $user->wager < 0 ) 
            {
                $user->update([
                    'wager' => 0, 
                    'bonus' => 0
                ]);
            }
            if( $user->count_balance < 0 ) 
            {
                $user->update(['count_balance' => 0]);
            }
            return $user;
        }
        public function GetBalance()
        {
            $this->user->session = serialize($this->gameData);
            $this->user->save();
            $this->user->refresh();
            $this->gameData = unserialize($this->user->session);
            $user = $this->user;
            $this->Balance = $user->balance / $this->CurrentDenom;
            return $this->Balance;
        }
        public function SaveLogReport($spinSymbols, $bet, $lines, $win, $slotState)
        {
            $_obf_0D172C04372D1A2A3C2B33260B34083837222A08343211 = $this->slotId . ' ' . $slotState;
            if( $slotState == 'freespin' ) 
            {
                $_obf_0D172C04372D1A2A3C2B33260B34083837222A08343211 = $this->slotId . ' FG';
            }
            else if( $slotState == 'bet' ) 
            {
                $_obf_0D172C04372D1A2A3C2B33260B34083837222A08343211 = $this->slotId . '';
            }
            else if( $slotState == 'slotGamble' ) 
            {
                $_obf_0D172C04372D1A2A3C2B33260B34083837222A08343211 = $this->slotId . ' DG';
            }
            $this->GetBalance();
            $game = $this->game;
            $game->increment('stat_in', $bet * $lines * $this->CurrentDenom);
            $game->increment('stat_out', $win * $this->CurrentDenom);
            if( !isset($this->betProfit) ) 
            {
                $this->betProfit = 0;
                $this->toGameBanks = 0;
                $this->toSlotJackBanks = 0;
                $this->toSysJackBanks = 0;
            }
            if( !isset($this->toGameBanks) ) 
            {
                $this->toGameBanks = 0;
            }
            $this->game->increment('bids');
            $this->game->refresh();
            \VanguardLTE\GameLog::create([
                'game_id' => $this->slotDBId, 
                'user_id' => $this->playerId, 
                'ip' => $_SERVER['REMOTE_ADDR'], 
                'str' => $spinSymbols, 
                'shop_id' => $this->shop_id
            ]);
            \VanguardLTE\StatGame::create([
                'user_id' => $this->playerId, 
                'balance' => $this->Balance * $this->CurrentDenom, 
                'bet' => $bet * $lines * $this->CurrentDenom, 
                'win' => $win * $this->CurrentDenom, 
                'game' => $_obf_0D172C04372D1A2A3C2B33260B34083837222A08343211, 
                'percent' => $this->toGameBanks, 
                'percent_jps' => $this->toSysJackBanks, 
                'percent_jpg' => $this->toSlotJackBanks, 
                'profit' => $this->betProfit, 
                'denomination' => $this->CurrentDenom, 
                'shop_id' => $this->shop_id
            ]);
        }
        public function GetSpinSettings($bet, $lines)
        {
            $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 10;
            switch( $lines ) 
            {
                case 10:
                    $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 10;
                    break;
                case 9:
                case 8:
                    $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 9;
                    break;
                case 7:
                case 6:
                    $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 7;
                    break;
                case 5:
                case 4:
                    $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 5;
                    break;
                case 3:
                case 2:
                    $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 3;
                    break;
                case 1:
                    $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 1;
                    break;
                default:
                    $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 10;
                    break;
            }
            $bonusWin = 0;
            $spinWin = 0;
            $game = $this->game;
            $_obf_0D331D3E332C132334050318121E19121A1515392E0B01 = $game->{'garant_win' . $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22};
            $_obf_0D363F0A050A0E103B2D12271D2309312440072D250A01 = $game->{'garant_bonus' . $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22};
            $_obf_0D2C3D3B244034312B3327351C2725302F062531213511 = $game->{'winbonus' . $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22};
            $_obf_0D0A36071E073714332F351C5C36185C2527222F381911 = $game->{'winline' . $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22};
            $_obf_0D331D3E332C132334050318121E19121A1515392E0B01++;
            $_obf_0D363F0A050A0E103B2D12271D2309312440072D250A01++;
            $return = [
                'none', 
                0
            ];
            if( $_obf_0D2C3D3B244034312B3327351C2725302F062531213511 <= $_obf_0D363F0A050A0E103B2D12271D2309312440072D250A01 ) 
            {
                $bonusWin = 1;
                $_obf_0D363F0A050A0E103B2D12271D2309312440072D250A01 = 0;
                $game->{'winbonus' . $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22} = $this->getNewSpin($game, 0, 1, $lines);
            }
            else if( $_obf_0D0A36071E073714332F351C5C36185C2527222F381911 <= $_obf_0D331D3E332C132334050318121E19121A1515392E0B01 ) 
            {
                $spinWin = 1;
                $_obf_0D331D3E332C132334050318121E19121A1515392E0B01 = 0;
                $game->{'winline' . $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22} = $this->getNewSpin($game, 1, 0, $lines);
            }
            $game->{'garant_win' . $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22} = $_obf_0D331D3E332C132334050318121E19121A1515392E0B01;
            $game->{'garant_bonus' . $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22} = $_obf_0D363F0A050A0E103B2D12271D2309312440072D250A01;
            $game->save();
            if( $bonusWin == 1 && $this->slotBonus ) 
            {
                $this->isBonusStart = true;
                $_obf_0D5C330B390E2B18235C030D36342F03311A2118233032 = $this->GetBank('bonus');
                $return = [
                    'bonus', 
                    $_obf_0D5C330B390E2B18235C030D36342F03311A2118233032
                ];
                if( $_obf_0D5C330B390E2B18235C030D36342F03311A2118233032 < (5 * $bet) ) 
                {
                    $return = [
                        'none', 
                        0
                    ];
                }
            }
            else if( $spinWin == 1 || $bonusWin == 1 && !$this->slotBonus ) 
            {
                $_obf_0D5C330B390E2B18235C030D36342F03311A2118233032 = $this->GetBank();
                $return = [
                    'win', 
                    $_obf_0D5C330B390E2B18235C030D36342F03311A2118233032
                ];
            }
            if( $this->GetBalance() <= (1 / $this->CurrentDenom) ) 
            {
                $_obf_0D1215151A36223F3D321A1D2E2D37075C041605215B01 = rand(1, 2);
                if( $_obf_0D1215151A36223F3D321A1D2E2D37075C041605215B01 == 1 ) 
                {
                    $_obf_0D5C330B390E2B18235C030D36342F03311A2118233032 = $this->GetBank('');
                    $return = [
                        'win', 
                        $_obf_0D5C330B390E2B18235C030D36342F03311A2118233032
                    ];
                }
            }
            return $return;
        }
        public function getNewSpin($game, $spinWin = 0, $bonusWin = 0, $lines)
        {
            $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 10;
            switch( $lines ) 
            {
                case 10:
                    $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 10;
                    break;
                case 9:
                case 8:
                    $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 9;
                    break;
                case 7:
                case 6:
                    $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 7;
                    break;
                case 5:
                case 4:
                    $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 5;
                    break;
                case 3:
                case 2:
                    $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 3;
                    break;
                case 1:
                    $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 1;
                    break;
                default:
                    $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22 = 10;
                    break;
            }
            if( $spinWin ) 
            {
                $win = explode(',', $game->game_win->{'winline' . $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22});
            }
            if( $bonusWin ) 
            {
                $win = explode(',', $game->game_win->{'winbonus' . $_obf_0D1A192E211F3F0B162A3E2A101410120A5C1725025B22});
            }
            $number = rand(0, count($win) - 1);
            return $win[$number];
        }
        public function GetRandomScatterPos($rp)
        {
            $_obf_0D27292617142A0F131C2A07024013320B242130093D01 = [];
            for( $i = 0; $i < count($rp); $i++ ) 
            {
                if( $rp[$i] == '0' ) 
                {
                    if( isset($rp[$i + 1]) && isset($rp[$i + 2]) ) 
                    {
                        array_push($_obf_0D27292617142A0F131C2A07024013320B242130093D01, $i);
                    }
                    if( isset($rp[$i + 1]) && isset($rp[$i - 1]) ) 
                    {
                        array_push($_obf_0D27292617142A0F131C2A07024013320B242130093D01, $i - 1);
                    }
                    if( isset($rp[$i - 2]) && isset($rp[$i - 1]) ) 
                    {
                        array_push($_obf_0D27292617142A0F131C2A07024013320B242130093D01, $i - 2);
                    }
                }
            }
            shuffle($_obf_0D27292617142A0F131C2A07024013320B242130093D01);
            if( !isset($_obf_0D27292617142A0F131C2A07024013320B242130093D01[0]) ) 
            {
                $_obf_0D27292617142A0F131C2A07024013320B242130093D01[0] = rand(2, count($rp) - 3);
            }
            return $_obf_0D27292617142A0F131C2A07024013320B242130093D01[0];
        }
        public function GetGambleSettings()
        {
            $spinWin = rand(1, $this->WinGamble);
            return $spinWin;
        }
        public function GetReelStrips($winType)
        {
            if( !$winType ) 
            {
                $_obf_0D101228330A351D340513401F3F211B060F0E1A191822 = [];
                foreach( [
                    'reelStrip1', 
                    'reelStrip2', 
                    'reelStrip3', 
                    'reelStrip4', 
                    'reelStrip5', 
                    'reelStrip6'
                ] as $index => $reelStrip ) 
                {
                    if( is_array($this->$reelStrip) && count($this->$reelStrip) > 0 ) 
                    {
                        $_obf_0D101228330A351D340513401F3F211B060F0E1A191822[$index + 1] = mt_rand(0, count($this->$reelStrip) - 3);
                    }
                }
            }
            else
            {
                $_obf_0D340F1A341017095B37324005163D02312C041E262632 = [];
                foreach( [
                    'reelStrip1', 
                    'reelStrip2', 
                    'reelStrip3', 
                    'reelStrip4', 
                    'reelStrip5', 
                    'reelStrip6'
                ] as $index => $reelStrip ) 
                {
                    if( is_array($this->$reelStrip) && count($this->$reelStrip) > 0 ) 
                    {
                        $_obf_0D101228330A351D340513401F3F211B060F0E1A191822[$index + 1] = $this->GetRandomScatterPos($this->$reelStrip);
                        $_obf_0D340F1A341017095B37324005163D02312C041E262632[] = $index + 1;
                    }
                }
                $_obf_0D360F0E1F1A363935363D35280B0F3F053D272F233C11 = rand(4, count($_obf_0D340F1A341017095B37324005163D02312C041E262632));
                shuffle($_obf_0D340F1A341017095B37324005163D02312C041E262632);
                for( $i = 0; $i < count($_obf_0D340F1A341017095B37324005163D02312C041E262632); $i++ ) 
                {
                    if( $i < $_obf_0D360F0E1F1A363935363D35280B0F3F053D272F233C11 ) 
                    {
                        $_obf_0D101228330A351D340513401F3F211B060F0E1A191822[$_obf_0D340F1A341017095B37324005163D02312C041E262632[$i]] = $this->GetRandomScatterPos($this->{'reelStrip' . $_obf_0D340F1A341017095B37324005163D02312C041E262632[$i]});
                    }
                    else
                    {
                        $_obf_0D101228330A351D340513401F3F211B060F0E1A191822[$_obf_0D340F1A341017095B37324005163D02312C041E262632[$i]] = rand(0, count($this->{'reelStrip' . $_obf_0D340F1A341017095B37324005163D02312C041E262632[$i]}) - 3);
                    }
                }
            }
            $reel = [
                'rp' => []
            ];
            foreach( $_obf_0D101228330A351D340513401F3F211B060F0E1A191822 as $index => $value ) 
            {
                $key = $this->{'reelStrip' . $index};
                $cnt = count($key);
                $key[-1] = $key[$cnt - 1];
                $key[$cnt] = $key[0];
                $reel['reel' . $index][0] = $key[$value];
                $reel['reel' . $index][1] = $key[$value + 1];
                $reel['reel' . $index][2] = $key[$value + 2];
                $reel['reel' . $index][3] = '';
                $reel['rp'][] = $value;
            }
            return $reel;
        }
    }

}
