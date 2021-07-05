<?php 
namespace VanguardLTE\Games\RouletteClassicPTM
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
            $this->scaleMode = 0;
            $this->numFloat = 0;
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
            $this->slotBonus = false;
            $this->slotGamble = true;
            $this->slotFastStop = 1;
            $this->slotExitUrl = '/';
            $this->slotWildMpl = 2;
            $this->GambleType = 1;
            $this->slotFreeCount = 15;
            $this->slotFreeMpl = 3;
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
                10, 
                11, 
                12, 
                13, 
                14, 
                15
            ];
            $this->gameLine = [];
            $this->Bet = explode(',', 'minBet=0.5,maxBet=10,minBetTable=0.5,maxBetTable=10,minBetStraight=0.5,maxBetStraight=10,minBetFiftyFifty=0.5,maxBetFiftyFifty=10,minBetColumnAndDozen=0.1,maxBetColumnAndDozen=10');
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
                8, 
                9, 
                10, 
                11
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
            $_obf_0D1D2F06402E3626070611230F2F2405170110213D0932 = explode('.', $num);
            if( isset($_obf_0D1D2F06402E3626070611230F2F2405170110213D0932[1]) ) 
            {
                if( strlen($_obf_0D1D2F06402E3626070611230F2F2405170110213D0932[1]) > 4 ) 
                {
                    return round($num * 100) / 100;
                }
                else if( strlen($_obf_0D1D2F06402E3626070611230F2F2405170110213D0932[1]) > 2 ) 
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
        public function GetNumbersByField($fieldName)
        {
            $_obf_0D3909153B231D3B041D310D132413054028265B053101 = "[\n                {\"id\":   1, \"type\": \"straight\", \"mask_color\": \"#cc3333\", \"pockets\":[0]},\n                {\"id\":  31, \"type\": \"straight\", \"mask_color\": \"#3333ff\", \"pockets\":[1]},\n                {\"id\":  77, \"type\": \"straight\", \"mask_color\": \"#3399ff\", \"pockets\":[2]},\n                {\"id\": 123, \"type\": \"straight\", \"mask_color\": \"#33ffff\", \"pockets\":[3]},\n                {\"id\":  33, \"type\": \"straight\", \"mask_color\": \"#9933ff\", \"pockets\":[4]},\n                {\"id\":  79, \"type\": \"straight\", \"mask_color\": \"#9999ff\", \"pockets\":[5]},\n                {\"id\": 125, \"type\": \"straight\", \"mask_color\": \"#99ffff\", \"pockets\":[6]},\n                {\"id\":  35, \"type\": \"straight\", \"mask_color\": \"#0033cc\", \"pockets\":[7]},\n                {\"id\":  81, \"type\": \"straight\", \"mask_color\": \"#0099cc\", \"pockets\":[8]},\n                {\"id\": 127, \"type\": \"straight\", \"mask_color\": \"#00ffcc\", \"pockets\":[9]},\n                {\"id\":  37, \"type\": \"straight\", \"mask_color\": \"#6633cc\", \"pockets\":[10]},\n                {\"id\":  83, \"type\": \"straight\", \"mask_color\": \"#6699cc\", \"pockets\":[11]},\n                {\"id\": 129, \"type\": \"straight\", \"mask_color\": \"#66ffcc\", \"pockets\":[12]},\n                {\"id\":  39, \"type\": \"straight\", \"mask_color\": \"#cc33cc\", \"pockets\":[13]},\n                {\"id\":  85, \"type\": \"straight\", \"mask_color\": \"#cc99cc\", \"pockets\":[14]},\n                {\"id\": 131, \"type\": \"straight\", \"mask_color\": \"#ccffcc\", \"pockets\":[15]},\n                {\"id\":  41, \"type\": \"straight\", \"mask_color\": \"#003399\", \"pockets\":[16]},\n                {\"id\":  87, \"type\": \"straight\", \"mask_color\": \"#009999\", \"pockets\":[17]},\n                {\"id\": 133, \"type\": \"straight\", \"mask_color\": \"#00ff99\", \"pockets\":[18]},\n                {\"id\":  43, \"type\": \"straight\", \"mask_color\": \"#663399\", \"pockets\":[19]},\n                {\"id\":  89, \"type\": \"straight\", \"mask_color\": \"#669999\", \"pockets\":[20]},\n                {\"id\": 135, \"type\": \"straight\", \"mask_color\": \"#66ff99\", \"pockets\":[21]},\n                {\"id\":  45, \"type\": \"straight\", \"mask_color\": \"#cc3399\", \"pockets\":[22]},\n                {\"id\":  91, \"type\": \"straight\", \"mask_color\": \"#cc9999\", \"pockets\":[23]},\n                {\"id\": 137, \"type\": \"straight\", \"mask_color\": \"#ccff99\", \"pockets\":[24]},\n                {\"id\":  47, \"type\": \"straight\", \"mask_color\": \"#003366\", \"pockets\":[25]},\n                {\"id\":  93, \"type\": \"straight\", \"mask_color\": \"#009966\", \"pockets\":[26]},\n                {\"id\": 139, \"type\": \"straight\", \"mask_color\": \"#00ff66\", \"pockets\":[27]},\n                {\"id\":  49, \"type\": \"straight\", \"mask_color\": \"#663366\", \"pockets\":[28]},\n                {\"id\":  95, \"type\": \"straight\", \"mask_color\": \"#669966\", \"pockets\":[29]},\n                {\"id\": 141, \"type\": \"straight\", \"mask_color\": \"#66ff66\", \"pockets\":[30]},\n                {\"id\":  51, \"type\": \"straight\", \"mask_color\": \"#cc3366\", \"pockets\":[31]},\n                {\"id\":  97, \"type\": \"straight\", \"mask_color\": \"#cc9966\", \"pockets\":[32]},\n                {\"id\": 143, \"type\": \"straight\", \"mask_color\": \"#ccff66\", \"pockets\":[33]},\n                {\"id\":  53, \"type\": \"straight\", \"mask_color\": \"#003333\", \"pockets\":[34]},\n                {\"id\":  99, \"type\": \"straight\", \"mask_color\": \"#009933\", \"pockets\":[35]},\n                {\"id\": 145, \"type\": \"straight\", \"mask_color\": \"#00ff33\", \"pockets\":[36]},\n\n                {\"id\":   3, \"type\": \"split\", \"mask_color\": \"#0033ff\", \"pockets\": [0, 1]},\n                {\"id\":   5, \"type\": \"split\", \"mask_color\": \"#0099ff\", \"pockets\": [0, 2]},\n                {\"id\":   7, \"type\": \"split\", \"mask_color\": \"#00ffff\", \"pockets\": [0, 3]},\n                {\"id\":  54, \"type\": \"split\", \"mask_color\": \"#3366ff\", \"pockets\": [1, 2]},\n                {\"id\":  32, \"type\": \"split\", \"mask_color\": \"#6633ff\", \"pockets\": [1, 4]},\n                {\"id\":  78, \"type\": \"split\", \"mask_color\": \"#6699ff\", \"pockets\": [2, 5]},\n                {\"id\": 100, \"type\": \"split\", \"mask_color\": \"#33ccff\", \"pockets\": [2, 3]},\n                {\"id\": 124, \"type\": \"split\", \"mask_color\": \"#66ffff\", \"pockets\": [3, 6]},\n                {\"id\":  34, \"type\": \"split\", \"mask_color\": \"#cc33ff\", \"pockets\": [4, 7]},\n                {\"id\":  56, \"type\": \"split\", \"mask_color\": \"#9966ff\", \"pockets\": [4, 5]},\n                {\"id\":  80, \"type\": \"split\", \"mask_color\": \"#cc99ff\", \"pockets\": [5, 8]},\n                {\"id\": 102, \"type\": \"split\", \"mask_color\": \"#99ccff\", \"pockets\": [5, 6]},\n                {\"id\": 126, \"type\": \"split\", \"mask_color\": \"#ccffff\", \"pockets\": [6, 9]},\n                {\"id\":  36, \"type\": \"split\", \"mask_color\": \"#3333cc\", \"pockets\": [7, 10]},\n                {\"id\":  58, \"type\": \"split\", \"mask_color\": \"#0066cc\", \"pockets\": [7, 8]},\n                {\"id\":  82, \"type\": \"split\", \"mask_color\": \"#3399cc\", \"pockets\": [8, 11]},\n                {\"id\": 104, \"type\": \"split\", \"mask_color\": \"#00cccc\", \"pockets\": [8, 9]},\n                {\"id\": 128, \"type\": \"split\", \"mask_color\": \"#33ffcc\", \"pockets\": [9, 12]},\n                {\"id\":  38, \"type\": \"split\", \"mask_color\": \"#9933cc\", \"pockets\": [10, 13]},\n                {\"id\":  60, \"type\": \"split\", \"mask_color\": \"#6666cc\", \"pockets\": [10, 11]},\n                {\"id\":  84, \"type\": \"split\", \"mask_color\": \"#9999cc\", \"pockets\": [11, 14]},\n                {\"id\": 106, \"type\": \"split\", \"mask_color\": \"#66cccc\", \"pockets\": [11, 12]},\n                {\"id\": 130, \"type\": \"split\", \"mask_color\": \"#99ffcc\", \"pockets\": [12, 15]},\n                {\"id\":  40, \"type\": \"split\", \"mask_color\": \"#ff33cc\", \"pockets\": [13, 16]},\n                {\"id\":  62, \"type\": \"split\", \"mask_color\": \"#cc66cc\", \"pockets\": [13, 14]},\n                {\"id\":  86, \"type\": \"split\", \"mask_color\": \"#ff99cc\", \"pockets\": [14, 17]},\n                {\"id\": 108, \"type\": \"split\", \"mask_color\": \"#cccccc\", \"pockets\": [14, 15]},\n                {\"id\": 132, \"type\": \"split\", \"mask_color\": \"#ffffcc\", \"pockets\": [15, 18]},\n                {\"id\":  42, \"type\": \"split\", \"mask_color\": \"#333399\", \"pockets\": [16, 19]},\n                {\"id\":  64, \"type\": \"split\", \"mask_color\": \"#006699\", \"pockets\": [16, 17]},\n                {\"id\":  88, \"type\": \"split\", \"mask_color\": \"#339999\", \"pockets\": [17, 20]},\n                {\"id\": 110, \"type\": \"split\", \"mask_color\": \"#00cc99\", \"pockets\": [17, 18]},\n                {\"id\": 134, \"type\": \"split\", \"mask_color\": \"#33ff99\", \"pockets\": [18, 21]},\n                {\"id\":  44, \"type\": \"split\", \"mask_color\": \"#993399\", \"pockets\": [19, 22]},\n                {\"id\":  66, \"type\": \"split\", \"mask_color\": \"#666699\", \"pockets\": [19, 20]},\n                {\"id\":  90, \"type\": \"split\", \"mask_color\": \"#999999\", \"pockets\": [20, 23]},\n                {\"id\": 112, \"type\": \"split\", \"mask_color\": \"#66cc99\", \"pockets\": [20, 21]},\n                {\"id\": 136, \"type\": \"split\", \"mask_color\": \"#99ff99\", \"pockets\": [21, 24]},\n                {\"id\":  46, \"type\": \"split\", \"mask_color\": \"#ff3399\", \"pockets\": [22, 25]},\n                {\"id\":  68, \"type\": \"split\", \"mask_color\": \"#cc6699\", \"pockets\": [22, 23]},\n                {\"id\":  92, \"type\": \"split\", \"mask_color\": \"#ff9999\", \"pockets\": [23, 26]},\n                {\"id\": 114, \"type\": \"split\", \"mask_color\": \"#cccc99\", \"pockets\": [23, 24]},\n                {\"id\": 138, \"type\": \"split\", \"mask_color\": \"#ffff99\", \"pockets\": [24, 27]},\n                {\"id\":  48, \"type\": \"split\", \"mask_color\": \"#333366\", \"pockets\": [25, 28]},\n                {\"id\":  70, \"type\": \"split\", \"mask_color\": \"#006666\", \"pockets\": [25, 26]},\n                {\"id\":  94, \"type\": \"split\", \"mask_color\": \"#339966\", \"pockets\": [26, 29]},\n                {\"id\": 116, \"type\": \"split\", \"mask_color\": \"#00cc66\", \"pockets\": [26, 27]},\n                {\"id\": 140, \"type\": \"split\", \"mask_color\": \"#33ff66\", \"pockets\": [27, 30]},\n                {\"id\":  50, \"type\": \"split\", \"mask_color\": \"#993366\", \"pockets\": [28, 31]},\n                {\"id\":  72, \"type\": \"split\", \"mask_color\": \"#666666\", \"pockets\": [28, 29]},\n                {\"id\":  96, \"type\": \"split\", \"mask_color\": \"#999966\", \"pockets\": [29, 32]},\n                {\"id\": 118, \"type\": \"split\", \"mask_color\": \"#66cc66\", \"pockets\": [29, 30]},\n                {\"id\": 142, \"type\": \"split\", \"mask_color\": \"#99ff66\", \"pockets\": [30, 33]},\n                {\"id\":  52, \"type\": \"split\", \"mask_color\": \"#ff3366\", \"pockets\": [31, 34]},\n                {\"id\":  74, \"type\": \"split\", \"mask_color\": \"#cc6666\", \"pockets\": [31, 32]},\n                {\"id\":  98, \"type\": \"split\", \"mask_color\": \"#ff9966\", \"pockets\": [32, 35]},\n                {\"id\": 120, \"type\": \"split\", \"mask_color\": \"#cccc66\", \"pockets\": [32, 33]},\n                {\"id\": 144, \"type\": \"split\", \"mask_color\": \"#ffff66\", \"pockets\": [33, 36]},\n                {\"id\":  76, \"type\": \"split\", \"mask_color\": \"#006633\", \"pockets\": [34, 35]},\n                {\"id\": 122, \"type\": \"split\", \"mask_color\": \"#00cc33\", \"pockets\": [35, 36]},\n\n                {\"id\":  8,  \"type\": \"street\", \"mask_color\": \"#3300ff\", \"pockets\": [1, 2, 3]},\n                {\"id\":  10, \"type\": \"street\", \"mask_color\": \"#9900ff\", \"pockets\": [4, 5, 6]},\n                {\"id\":  12, \"type\": \"street\", \"mask_color\": \"#0000cc\", \"pockets\": [7, 8, 9]},\n                {\"id\":  14, \"type\": \"street\", \"mask_color\": \"#6600cc\", \"pockets\": [10, 11, 12]},\n                {\"id\":  16, \"type\": \"street\", \"mask_color\": \"#cc00cc\", \"pockets\": [13, 14, 15]},\n                {\"id\":  18, \"type\": \"street\", \"mask_color\": \"#000099\", \"pockets\": [16, 17, 18]},\n                {\"id\":  20, \"type\": \"street\", \"mask_color\": \"#660099\", \"pockets\": [19, 20, 21]},\n                {\"id\":  22, \"type\": \"street\", \"mask_color\": \"#cc0099\", \"pockets\": [22, 23, 24]},\n                {\"id\":  24, \"type\": \"street\", \"mask_color\": \"#000066\", \"pockets\": [25, 26, 27]},\n                {\"id\":  26, \"type\": \"street\", \"mask_color\": \"#660066\", \"pockets\": [28, 29, 30]},\n                {\"id\":  28, \"type\": \"street\", \"mask_color\": \"#cc0066\", \"pockets\": [31, 32, 33]},\n                {\"id\":  30, \"type\": \"street\", \"mask_color\": \"#000033\", \"pockets\": [34, 35, 36]},\n                {\"id\":   4, \"type\": \"street\", \"mask_color\": \"#0066ff\", \"pockets\": [0, 1, 2]},\n                {\"id\":   6, \"type\": \"street\", \"mask_color\": \"#00ccff\", \"pockets\": [0, 2, 3]},\n\n                {\"id\":  55, \"type\": \"corner\", \"mask_color\": \"#6666ff\", \"pockets\": [2, 5, 4, 1]},\n                {\"id\": 101, \"type\": \"corner\", \"mask_color\": \"#66ccff\", \"pockets\": [3, 6, 5, 2]},\n                {\"id\":  57, \"type\": \"corner\", \"mask_color\": \"#cc66ff\", \"pockets\": [5, 8, 7, 4]},\n                {\"id\": 103, \"type\": \"corner\", \"mask_color\": \"#ccccff\", \"pockets\": [6, 9, 8, 5]},\n                {\"id\":  59, \"type\": \"corner\", \"mask_color\": \"#3366cc\", \"pockets\": [8, 11, 10, 7]},\n                {\"id\": 105, \"type\": \"corner\", \"mask_color\": \"#33cccc\", \"pockets\": [9, 12, 11, 8]},\n                {\"id\":  61, \"type\": \"corner\", \"mask_color\": \"#9966cc\", \"pockets\": [11, 14, 13, 10]},\n                {\"id\": 107, \"type\": \"corner\", \"mask_color\": \"#99cccc\", \"pockets\": [12, 15, 14, 11]},\n                {\"id\":  63, \"type\": \"corner\", \"mask_color\": \"#ff66cc\", \"pockets\": [14, 17, 16, 13]},\n                {\"id\": 109, \"type\": \"corner\", \"mask_color\": \"#ffcccc\", \"pockets\": [15, 18, 17, 14]},\n                {\"id\":  65, \"type\": \"corner\", \"mask_color\": \"#336699\", \"pockets\": [17, 20, 19, 16]},\n                {\"id\": 111, \"type\": \"corner\", \"mask_color\": \"#33cc99\", \"pockets\": [18, 21, 20, 17]},\n                {\"id\":  67, \"type\": \"corner\", \"mask_color\": \"#996699\", \"pockets\": [20, 23, 22, 19]},\n                {\"id\": 113, \"type\": \"corner\", \"mask_color\": \"#99cc99\", \"pockets\": [21, 24, 23, 20]},\n                {\"id\":  69, \"type\": \"corner\", \"mask_color\": \"#ff6699\", \"pockets\": [23, 26, 25, 22]},\n                {\"id\": 115, \"type\": \"corner\", \"mask_color\": \"#ffcc99\", \"pockets\": [24, 27, 26, 23]},\n                {\"id\":  71, \"type\": \"corner\", \"mask_color\": \"#336666\", \"pockets\": [26, 29, 28, 25]},\n                {\"id\": 117, \"type\": \"corner\", \"mask_color\": \"#33cc66\", \"pockets\": [27, 30, 29, 26]},\n                {\"id\":  73, \"type\": \"corner\", \"mask_color\": \"#996666\", \"pockets\": [29, 32, 31, 28]},\n                {\"id\": 119, \"type\": \"corner\", \"mask_color\": \"#99cc66\", \"pockets\": [30, 33, 32, 29]},\n                {\"id\":  75, \"type\": \"corner\", \"mask_color\": \"#ff6666\", \"pockets\": [32, 35, 34, 31]},\n                {\"id\": 121, \"type\": \"corner\", \"mask_color\": \"#ffcc66\", \"pockets\": [33, 36, 35, 32]},\n\n                {\"id\":   2, \"type\": \"four\", \"mask_color\": \"#0000ff\", \"pockets\": [0, 1, 2, 3]},\n\n                {\"id\":   9, \"type\": \"line\", \"mask_color\": \"#6600ff\", \"pockets\": [1, 2, 3, 4, 5, 6]},\n                {\"id\":  11, \"type\": \"line\", \"mask_color\": \"#cc00ff\", \"pockets\": [4, 5, 6, 7, 8, 9]},\n                {\"id\":  13, \"type\": \"line\", \"mask_color\": \"#3300cc\", \"pockets\": [7, 8, 9, 10, 11, 12]},\n                {\"id\":  15, \"type\": \"line\", \"mask_color\": \"#9900cc\", \"pockets\": [10, 11, 12, 13, 14, 15]},\n                {\"id\":  17, \"type\": \"line\", \"mask_color\": \"#ff00cc\", \"pockets\": [13, 14, 15, 16, 17, 18]},\n                {\"id\":  19, \"type\": \"line\", \"mask_color\": \"#330099\", \"pockets\": [16, 17, 18, 19, 20, 21]},\n                {\"id\":  21, \"type\": \"line\", \"mask_color\": \"#990099\", \"pockets\": [19, 20, 21, 22, 23, 24]},\n                {\"id\":  23, \"type\": \"line\", \"mask_color\": \"#ff0099\", \"pockets\": [22, 23, 24, 25, 26, 27]},\n                {\"id\":  25, \"type\": \"line\", \"mask_color\": \"#330066\", \"pockets\": [25, 26, 27, 28, 29, 30]},\n                {\"id\":  27, \"type\": \"line\", \"mask_color\": \"#990066\", \"pockets\": [28, 29, 30, 31, 32, 33]},\n                {\"id\":  29, \"type\": \"line\", \"mask_color\": \"#ff0066\", \"pockets\": [31, 32, 33, 34, 35, 36]},\n\n                {\"id\": 146, \"type\": \"column\",   \"mask_color\": \"#339933\", \"pockets\": [1, 4, 7, 10, 13, 16, 19, 22, 25, 28, 31, 34]},\n                {\"id\": 147, \"type\": \"column\",   \"mask_color\": \"#33cc33\", \"pockets\": [2, 5, 8, 11, 14, 17, 20, 23, 26, 29, 32, 35]},\n                {\"id\": 148, \"type\": \"column\",   \"mask_color\": \"#33ff33\", \"pockets\": [3, 6, 9, 12, 15, 18, 21, 24, 27, 30, 33, 36]},\n                {\"id\": 149, \"type\": \"twelve\",   \"mask_color\": \"#336633\", \"pockets\": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]},\n                {\"id\": 150, \"type\": \"twelve\",   \"mask_color\": \"#330033\", \"pockets\": [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24]},\n                {\"id\": 151, \"type\": \"twelve\",   \"mask_color\": \"#666633\", \"pockets\": [25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36]},\n                {\"id\": 153, \"type\": \"low\",      \"mask_color\": \"#333333\", \"pockets\": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]},\n                {\"id\": 152, \"type\": \"high\",     \"mask_color\": \"#660033\", \"pockets\": [19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36]},\n\n                {\"id\": 156, \"type\": \"even\", \"mask_color\": \"#66ff33\",\n                    \"pockets\": [2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36],\n                    \"stroke_ids\": [77, 33, 125, 81, 37, 129, 85, 41, 133, 89, 45, 137, 93, 49, 141, 97, 53, 145]\n                },\n\n                {\"id\": 157, \"type\": \"odd\", \"mask_color\": \"#663333\",\n                    \"pockets\": [1, 3, 5, 7, 9, 11, 13, 15, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35],\n                    \"stroke_ids\": [31, 123, 79, 35, 127, 83, 39, 131, 87,  43, 135, 91, 47, 139, 95, 51, 143, 99]\n                },\n\n                {\"id\": 155, \"type\": \"red\", \"mask_color\": \"#66cc33\",\n                    \"pockets\": [1, 3, 5, 7, 9, 12, 14, 16, 18, 19, 21, 23, 25, 27, 30, 32, 34, 36],\n                    \"stroke_ids\": [31, 123, 79, 35, 128, 85, 134, 42, 91, 47, 140,  97, 53, 145]\n                },   \n\n                {\"id\": 154, \"type\": \"black\", \"mask_color\": \"#669933\",\n                    \"pockets\": [2, 4, 6, 8, 10, 11, 13, 15, 17, 20, 22, 24, 26, 28, 29, 31, 33, 35],\n                    \"stroke_ids\": [77, 33, 125, 82, 38, 131, 88, 45, 137, 94, 50, 143, 99]\n                }\n            ]";
            $_obf_0D193C2E141E07270D110D36300B1635095C3640221711 = json_decode($_obf_0D3909153B231D3B041D310D132413054028265B053101);
            foreach( $_obf_0D193C2E141E07270D110D36300B1635095C3640221711 as $vl ) 
            {
                if( $vl->id == $fieldName ) 
                {
                    return [
                        $vl->type, 
                        $vl->pockets
                    ];
                }
            }
        }
        public function GetHistory()
        {
            return 'NULL';
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
            else if( $slotState == 'slotGamble' ) 
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
                $garantType = 'bonus';
                $_obf_0D5C330B390E2B18235C030D36342F03311A2118233032 = $this->GetBank($garantType);
                $return = [
                    'bonus', 
                    $_obf_0D5C330B390E2B18235C030D36342F03311A2118233032
                ];
                if( $_obf_0D5C330B390E2B18235C030D36342F03311A2118233032 < ($this->CheckBonusWin() * $bet) ) 
                {
                    $return = [
                        'none', 
                        0
                    ];
                }
            }
            else if( $spinWin == 1 || $bonusWin == 1 && !$this->slotBonus ) 
            {
                $_obf_0D5C330B390E2B18235C030D36342F03311A2118233032 = $this->GetBank($garantType);
                $return = [
                    'win', 
                    $_obf_0D5C330B390E2B18235C030D36342F03311A2118233032
                ];
            }
            if( $garantType == 'bet' && $this->GetBalance() <= (1 / $this->CurrentDenom) ) 
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
                if( $rp[$i] == '12' ) 
                {
                    if( isset($rp[$i + 1]) && isset($rp[$i - 1]) ) 
                    {
                        array_push($_obf_0D27292617142A0F131C2A07024013320B242130093D01, $i);
                    }
                    if( isset($rp[$i - 1]) && isset($rp[$i - 2]) ) 
                    {
                        array_push($_obf_0D27292617142A0F131C2A07024013320B242130093D01, $i - 1);
                    }
                    if( isset($rp[$i + 1]) && isset($rp[$i + 2]) ) 
                    {
                        array_push($_obf_0D27292617142A0F131C2A07024013320B242130093D01, $i + 1);
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
        public function GetReelStrips($winType, $slotEvent)
        {
            $game = $this->game;
            if( $slotEvent == 'freespin' ) 
            {
                $reel = new GameReel();
                $_obf_0D2704192E1921372A0E27012935072D34131C34103211 = $reel->reelsStripBonus;
                foreach( [
                    'reelStrip1', 
                    'reelStrip2', 
                    'reelStrip3', 
                    'reelStrip4', 
                    'reelStrip5', 
                    'reelStrip6'
                ] as $reelStrip ) 
                {
                    $_obf_0D251A4031061710313030232D1709093F373537373E01 = array_shift($_obf_0D2704192E1921372A0E27012935072D34131C34103211);
                    if( count($_obf_0D251A4031061710313030232D1709093F373537373E01) ) 
                    {
                        $this->$reelStrip = $_obf_0D251A4031061710313030232D1709093F373537373E01;
                    }
                }
            }
            if( $winType != 'bonus' ) 
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
                $_obf_0D360F0E1F1A363935363D35280B0F3F053D272F233C11 = rand(3, count($_obf_0D340F1A341017095B37324005163D02312C041E262632));
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
                $key[-1] = $key[count($key) - 1];
                $reel['reel' . $index][0] = $key[$value - 1];
                $reel['reel' . $index][1] = $key[$value];
                $reel['reel' . $index][2] = $key[$value + 1];
                $reel['reel' . $index][3] = '';
                $reel['rp'][] = $value;
            }
            return $reel;
        }
    }

}
