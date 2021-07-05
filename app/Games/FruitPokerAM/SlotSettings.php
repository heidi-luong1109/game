<?php 
namespace VanguardLTE\Games\FruitPokerAM
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
        public $lastEvent = null;
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
           /* if( config('LicenseDK.APL_INCLUDE_KEY_CONFIG') != 'wi9qydosuimsnls5zoe5q298evkhim0ughx1w16qybs2fhlcpn' ) 
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
            $this->slotExitUrl = '/';
            $this->jpgs = \VanguardLTE\JPG::where('shop_id', $this->shop_id)->lockForUpdate()->get();
            $this->Bet = explode(',', $game->bet);
            $this->Bet = array_slice($this->Bet, 0, 5);
            $this->Balance = $user->balance;
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
                return '';
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
        public function PackGameData()
        {
            $allData = [];
            foreach( $this->gameData as $key => $vl ) 
            {
                $pos = strpos($key, $this->slotId);
                if( $pos !== false ) 
                {
                    $allData[$key] = $this->gameData[$key]['payload'];
                }
            }
            return json_encode($allData);
        }
        public function UnpackGameData($data)
        {
            foreach( $data as $key => $vl ) 
            {
                $this->SetGameData($key, $vl);
            }
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
                if( $_obf_0D1F212D1B1A262C271C2C331110342F041A3014182301->responseEvent != 'gambleResult' ) 
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
            return null;
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
        public function GetCombination($cards, $suits)
        {
            sort($cards, SORT_NUMERIC);
            $_obf_0D5C13240E5B2F1531295B1C0D2E1A0F0D2B10015B0C11 = [
                0, 
                0, 
                0, 
                0, 
                0, 
                0, 
                0, 
                0
            ];
            for( $i = 1; $i <= 7; $i++ ) 
            {
                $_obf_0D0A0725010E0A090328080A1F09042C2D1C2536340E01 = 0;
                for( $j = 0; $j <= 4; $j++ ) 
                {
                    if( $cards[$j] == $i || $cards[$j] == 8 ) 
                    {
                        $_obf_0D0A0725010E0A090328080A1F09042C2D1C2536340E01++;
                    }
                }
                $_obf_0D5C13240E5B2F1531295B1C0D2E1A0F0D2B10015B0C11[$i] = $_obf_0D0A0725010E0A090328080A1F09042C2D1C2536340E01;
            }
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811 = [];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[0] = [
                0, 
                0, 
                0, 
                0, 
                0, 
                0
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[1] = [
                0, 
                0, 
                0, 
                20, 
                50, 
                1000
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[2] = [
                0, 
                0, 
                0, 
                5, 
                25, 
                100
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[3] = [
                0, 
                0, 
                0, 
                5, 
                25, 
                100
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[4] = [
                0, 
                0, 
                0, 
                2, 
                10, 
                50
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[5] = [
                0, 
                0, 
                0, 
                2, 
                10, 
                50
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[6] = [
                0, 
                0, 
                0, 
                2, 
                10, 
                50
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[7] = [
                0, 
                0, 
                0, 
                0, 
                0, 
                1
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[8] = [
                0, 
                0, 
                0, 
                0, 
                0, 
                1
            ];
            $_obf_0D3930021E065C30212C110F1D2D150E03113925171401 = 0;
            $_obf_0D340E033D3540281A3C25053016262A17171324015C11 = 0;
            for( $i = 1; $i <= 7; $i++ ) 
            {
                $_obf_0D1C3C242D3205162D081F2518152F2A1A5C3317313022 = $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[$i][$_obf_0D5C13240E5B2F1531295B1C0D2E1A0F0D2B10015B0C11[$i]];
                if( $_obf_0D3930021E065C30212C110F1D2D150E03113925171401 < $_obf_0D1C3C242D3205162D081F2518152F2A1A5C3317313022 ) 
                {
                    $_obf_0D3930021E065C30212C110F1D2D150E03113925171401 = $_obf_0D1C3C242D3205162D081F2518152F2A1A5C3317313022;
                    $_obf_0D340E033D3540281A3C25053016262A17171324015C11 = $i;
                }
            }
            return [
                $_obf_0D3930021E065C30212C110F1D2D150E03113925171401, 
                $_obf_0D340E033D3540281A3C25053016262A17171324015C11
            ];
        }
        public function GetTips($cards, $suits, $mode = false)
        {
            $_obf_0D5C13240E5B2F1531295B1C0D2E1A0F0D2B10015B0C11 = [
                0, 
                0, 
                0, 
                0, 
                0, 
                0, 
                0, 
                0
            ];
            $_obf_0D362140222937131B0414311E1A3624301B2626111D32 = [
                [
                    0, 
                    0, 
                    0, 
                    0, 
                    0
                ], 
                [
                    0, 
                    0, 
                    0, 
                    0, 
                    0
                ], 
                [
                    0, 
                    0, 
                    0, 
                    0, 
                    0
                ], 
                [
                    0, 
                    0, 
                    0, 
                    0, 
                    0
                ], 
                [
                    0, 
                    0, 
                    0, 
                    0, 
                    0
                ], 
                [
                    0, 
                    0, 
                    0, 
                    0, 
                    0
                ], 
                [
                    0, 
                    0, 
                    0, 
                    0, 
                    0
                ], 
                [
                    0, 
                    0, 
                    0, 
                    0, 
                    0
                ]
            ];
            $_obf_0D190C112C2D012D2B5C1839053E1101121F3415342622 = [
                0, 
                0, 
                0, 
                0, 
                0, 
                0, 
                0, 
                0
            ];
            for( $i = 1; $i <= 8; $i++ ) 
            {
                $_obf_0D0A0725010E0A090328080A1F09042C2D1C2536340E01 = 0;
                for( $j = 0; $j <= 4; $j++ ) 
                {
                    if( $cards[$j] == $i || $cards[$j] == 8 ) 
                    {
                        $_obf_0D362140222937131B0414311E1A3624301B2626111D32[$i - 1][$j] = $cards[$j];
                        $_obf_0D0A0725010E0A090328080A1F09042C2D1C2536340E01++;
                    }
                }
                $_obf_0D5C13240E5B2F1531295B1C0D2E1A0F0D2B10015B0C11[$i] = $_obf_0D0A0725010E0A090328080A1F09042C2D1C2536340E01;
            }
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811 = [];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[0] = [
                0, 
                0, 
                0, 
                0, 
                0, 
                0
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[1] = [
                0, 
                0, 
                0, 
                20, 
                50, 
                1000
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[2] = [
                0, 
                0, 
                0, 
                5, 
                25, 
                100
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[3] = [
                0, 
                0, 
                0, 
                5, 
                25, 
                100
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[4] = [
                0, 
                0, 
                0, 
                2, 
                10, 
                50
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[5] = [
                0, 
                0, 
                0, 
                2, 
                10, 
                50
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[6] = [
                0, 
                0, 
                0, 
                2, 
                10, 
                50
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[7] = [
                0, 
                0, 
                0, 
                0, 
                0, 
                1
            ];
            $_obf_0D12273438290201353D33151E2F3F140B03361B0A0811[8] = [
                0, 
                0, 
                0, 
                0, 
                0, 
                1
            ];
            $_obf_0D3930021E065C30212C110F1D2D150E03113925171401 = 0;
            $_obf_0D340E033D3540281A3C25053016262A17171324015C11 = 0;
            $_obf_0D5B10050E253B2D300F1D1525263223312F5B385B0232 = 0;
            $_obf_0D3E05100A3E3C5B0B3B3B272E2F230B26152518042701 = $_obf_0D362140222937131B0414311E1A3624301B2626111D32[0];
            for( $i = 1; $i <= 8; $i++ ) 
            {
                if( $_obf_0D5B10050E253B2D300F1D1525263223312F5B385B0232 < $_obf_0D5C13240E5B2F1531295B1C0D2E1A0F0D2B10015B0C11[$i] && ($_obf_0D5C13240E5B2F1531295B1C0D2E1A0F0D2B10015B0C11[$i] >= 2 && $i < 7 || $_obf_0D5C13240E5B2F1531295B1C0D2E1A0F0D2B10015B0C11[$i] == 1 && $i == 8 || $_obf_0D5C13240E5B2F1531295B1C0D2E1A0F0D2B10015B0C11[$i] == 5 && $i == 7 && $mode) ) 
                {
                    $_obf_0D5B10050E253B2D300F1D1525263223312F5B385B0232 = $_obf_0D5C13240E5B2F1531295B1C0D2E1A0F0D2B10015B0C11[$i];
                    $_obf_0D3E05100A3E3C5B0B3B3B272E2F230B26152518042701 = $_obf_0D362140222937131B0414311E1A3624301B2626111D32[$i - 1];
                }
            }
            return $_obf_0D3E05100A3E3C5B0B3B3B272E2F230B26152518042701;
        }
        public function HexFormat($num)
        {
            $str = strlen(dechex($num)) . dechex($num);
            return $str;
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
                $_obf_0D111A0318183C030C5C320E1D02182D23063522273322 = 0;
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
            else if( $slotState == 'double' ) 
            {
                $_obf_0D172C04372D1A2A3C2B33260B34083837222A08343211 = $this->slotId . ' DG';
            }
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
        public function GetGambleSettings()
        {
            $spinWin = rand(1, $this->WinGamble);
            return $spinWin;
        }
    }

}
