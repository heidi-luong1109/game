<?php 
namespace VanguardLTE\Games\FishHunterKA
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
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance());
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = '';
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = (string)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['action'];
            switch( $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 ) 
            {
                case 'connector.accountHandler.twLogin':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    $_obf_0D030E023B24273D231A270A343212362F2140160E0832 = [];
                    $_obf_0D030E023B24273D231A270A343212362F2140160E0832[] = '' . ($slotSettings->CurrentDenom * 100) . '';
                    foreach( $slotSettings->Denominations as $b ) 
                    {
                        $_obf_0D030E023B24273D231A270A343212362F2140160E0832[] = '' . ($b * 100) . '';
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"code":200,"responseView":[4,0,0,0,4,1],"answerType":"","data":{"nickName":"' . $slotSettings->username . '","gender":1,"avatarUrl":"","playerId":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","twSSOId":"accessKey|' . $slotSettings->slotCurrency . '|766764546","parentId":"","state":0,"role":0,"locale":"en","creditAmount":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"creditCode":"' . $slotSettings->slotCurrency . '","rmpCannonCost":[1,2,3,5,8,10,10,20,30,50,80,100,100,200,300,500,800,1000],"denom":0.01,"currencySymbol":"' . $slotSettings->slotCurrency . '","currencyFractionDigits":2,"currencySymbolInBack":false,"thousandGroupingSepartor":",","decimalSeparator":".","transactionBufferSize":5,"transactionBufferMilliseconds":1000,"rmpCredit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"roomLevel":0,"cannonlevel":0,"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJ1aWQiOiJlM2UyODkyYS1kZjQ4LTRkNTMtODI1Zi0zNDA3ZDg4N2ZiZjkiLCJpYXQiOjE1ODQyODM3NTcsImV4cCI6MTU4NDM3MDE1N30.zoeZ7VmLyP1GESKmfPx89a_JRmqGoTiaaDNOQZylJwlyAHrszs-DxjdyrvXByi1Iyg0ELrciQLUX53iHPkETY11YNjkwKapQgCZVKK3OiTjK_qtVUBVYy8N420LSHaYK7D_L4z-GTD_XSnZFWfI0xlmT5QgshUSNvnkybFpGIgk","recommendedGames":[],"openRecommendedGamesInNewWindow":false,"ip":"::ffff:127.0.0.1:52678","realip":"","gameServerId":"player-server-3","gameId":"10007","tableId":""}}';
                    break;
                case 'playerControl.tableHandler.searchTableAndJoin':
                    $slotSettings->SetGameData('FishHunterKABullets', []);
                    $slotSettings->SetGameData('FishHunterKAFishes', []);
                    $slotSettings->SetGameData('FishHunterKAWaveTime', time());
                    $slotSettings->SetGameData('FishHunterKACurScene', 0);
                    $slotSettings->SetGameData('FishHunterKAIsGroupFish', 0);
                    $slotSettings->SetGameData('FishHunterKAGamePause', time());
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['query']['level'] == 0 ) 
                    {
                        $slotSettings->SetGameData('FishHunterKABet', 0.01);
                        $slotSettings->SetGameData('FishHunterKABetCnt', 0);
                        $slotSettings->SetGameData('FishHunterKABetArr', [
                            0.01, 
                            0.02, 
                            0.03, 
                            0.05, 
                            0.08, 
                            0.1
                        ]);
                    }
                    else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['query']['level'] == 1 ) 
                    {
                        $slotSettings->SetGameData('FishHunterKABet', 0.1);
                        $slotSettings->SetGameData('FishHunterKABetCnt', 0);
                        $slotSettings->SetGameData('FishHunterKABetArr', [
                            0.1, 
                            0.2, 
                            0.3, 
                            0.5, 
                            0.8, 
                            1
                        ]);
                    }
                    else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['query']['level'] == 2 ) 
                    {
                        $slotSettings->SetGameData('FishHunterKABet', 1);
                        $slotSettings->SetGameData('FishHunterKABetCnt', 0);
                        $slotSettings->SetGameData('FishHunterKABetArr', [
                            1, 
                            2, 
                            3, 
                            5, 
                            8, 
                            10
                        ]);
                    }
                    $Bet = $slotSettings->GetGameData('FishHunterKABet');
                    $_obf_0D3B1A35343C1A0C39373B0D0C35261B380F3639062401 = $slotSettings->GetGameData('FishHunterKABetArr');
                    foreach( $_obf_0D3B1A35343C1A0C39373B0D0C35261B380F3639062401 as &$_obf_0D5C352D400A2925212A132C21392B302B101F28380611 ) 
                    {
                        $_obf_0D5C352D400A2925212A132C21392B302B101F28380611 = $_obf_0D5C352D400A2925212A132C21392B302B101F28380611 * 100;
                    }
                    $slotSettings->SetGameData('FishHunterKABetLevel', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['query']['level']);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"answerType":"game.start","Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"curBet":' . $slotSettings->GetGameData('FishHunterKABet') . ',"responseView":[4,0,0,0,6,' . strlen('game.start') . '],"msg":{"area":{"id":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","scene":0,"state":"started","pauseTime":0,"stage":"normal"},"areaPlayers":[{"id":"e65975e402d48d76e08ffee182054dff22fab8729c0013eab47367fa56ded7c8","areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","playerId":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","cannonLevel":0,"cannonCost":' . ($Bet * 100) . ',"cannonMaxLen":18,"skin":1,"lockTargetId":0,"chairId":0}],"table":{"_id":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","level":0,"maxChairs":1,"chairIds":["d607e29f-99cc-48bc-a37d-5590b80fa0f6","","",""],"recycle":true,"secret":"","gameId":"10007","serverId":"player-server-3","hostId":"","name":"Auto"},"players":[{"nickName":"' . $slotSettings->username . '","gender":1,"avatarUrl":"","gameServerId":"player-server-3","connectorId":"connector-server-3","teamId":"","gameId":"10007","tableId":"2ba04cc50c285a21b223e1043993456918e041415cac8ce29e72d3dc948474be-connector-server-3","gameState":"playing","id":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","gold":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '}],"playerId":"d607e29f-99cc-48bc-a37d-5590b80fa0f6"}}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[1] = '{"answerType":"","responseView":[4,0,0,0,4,2],"code":200,"data":{"table":{"_id":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","name":"Auto","hostId":"","serverId":"player-server-3","recycle":true,"playerIds":["d607e29f-99cc-48bc-a37d-5590b80fa0f6"],"chairIds":["d607e29f-99cc-48bc-a37d-5590b80fa0f6","","",""],"level":0},"players":[{"nickName":"' . $slotSettings->username . '","gender":1,"avatarUrl":"","gameServerId":"player-server-3","connectorId":"connector-server-3","teamId":"","gameId":"10007","tableId":"","gameState":"free","id":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","areaId":"","gold":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '}],"ratio":1,"rmpRatioCredit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"denom":0.01,"roomLevel":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['query']['level'] . ',"rmpCannonCost":[1,2,3,5,8,10,10,20,30,50,80,100,100,200,300,500,800,1000]}}';
                    $_obf_0D3206230526183E3D285C3C282B2C5B163C383B2B2A32 = [];
                    $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01 = $slotSettings->GetGameData('FishHunterKAFishes');
                    if( !is_array($_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01) ) 
                    {
                        $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01 = [];
                    }
                    $_obf_0D3F2111261D15363E262C242D13150A3E2F1339393F22 = rand(12, 35);
                    for( $i = 0; $i < $_obf_0D3F2111261D15363E262C242D13150A3E2F1339393F22; $i++ ) 
                    {
                        $sid = rand(1, mt_getrandmax());
                        $fishView = rand(1, 22);
                        $state = 'solo';
                        $_obf_0D041F1F3D07083B223F063D3D084004323E2814300C32 = [
                            'solo', 
                            'solo', 
                            'solo', 
                            'solo', 
                            'solo', 
                            'solo', 
                            'solo', 
                            'solo', 
                            'solo', 
                            'solo', 
                            'bomb', 
                            'bomb', 
                            'bomb', 
                            'flock', 
                            'flock', 
                            'flock'
                        ];
                        shuffle($_obf_0D041F1F3D07083B223F063D3D084004323E2814300C32);
                        if( $fishView > 18 ) 
                        {
                            $state = $_obf_0D041F1F3D07083B223F063D3D084004323E2814300C32[0];
                        }
                        if( $fishView < 10 ) 
                        {
                            $fishView = '0' . $fishView;
                        }
                        $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$sid] = [
                            'fishView' => 'Fish_' . $fishView, 
                            'sid' => $sid, 
                            'pay' => $slotSettings->Paytable['Fish_' . $fishView], 
                            'tl' => time(), 
                            'state' => $state
                        ];
                        $_obf_0D3206230526183E3D285C3C282B2C5B163C383B2B2A32[] = '{"areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","id":' . $sid . ',"type":"Fish_' . $fishView . '","amount":1,"born":1584296702070,"alive":' . rand(5, 15) . ',"state":"solo","path":"bezier_id_' . rand(1, 22) . '","index":' . $i . ',"score":1,"teamid":"none","_id":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-31","expired":1584296782070}';
                    }
                    $slotSettings->SetGameData('FishHunterKAFishes', $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[2] = '{"answerType":"game.onSpawnFishes","responseView":[4,0,0,0,6,' . strlen('game.onSpawnFishes') . '],"msg":{"fishes":[' . implode(',', $_obf_0D3206230526183E3D285C3C282B2C5B163C383B2B2A32) . ']}}';
                    break;
                case 'playerControl.tableHandler.leaveTable':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"answerType":"game.quit","responseView":[4,0,0,0,6,' . strlen('game.quit') . '],"msg":{"area":{"_id":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","state":"started","scene":0,"stage":"group"},"areaPlayers":[],"bullets":[],"players":[{"nickName":"' . $slotSettings->username . '","gender":1,"avatarUrl":"","gameServerId":"player-server-3","connectorId":"connector-server-3","teamId":"","gameId":"10007","tableId":"2ba04cc50c285a21b223e1043993456918e041415cac8ce29e72d3dc948474be-connector-server-3","gameState":"free","id":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","areaId":"","gold":0}]}}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"answerType":"game.quit","responseView":[4,0,0,0,6,' . strlen('game.quit') . '],"msg":{"area":{"_id":"ae833cb4d796075ae3e5ab9749433381568f8fb2d101d823a56c3fa020bcb39f-connector-server-1","state":"started","scene":0,"stage":"group"},"areaPlayers":[],"bullets":[],"players":[{"nickName":"166764546","gender":1,"avatarUrl":"","gameServerId":"player-server-1","connectorId":"connector-server-1","teamId":"","gameId":"10007","tableId":"ae833cb4d796075ae3e5ab9749433381568f8fb2d101d823a56c3fa020bcb39f-connector-server-1","gameState":"free","id":"67244025-1483-4291-9dd4-43878eef07ee","areaId":"","gold":0}]}}';
                    break;
                case 'connector.accountHandler.onPingBalance':
                    $_obf_0D26101D240F1E3702190B24150905052619213D361201 = '';
                    $Bet = $slotSettings->GetGameData('FishHunterKABet');
                    $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 = $slotSettings->GetGameData('FishHunterKABetCnt');
                    $_obf_0D270B100F1E29333D371524310A350428242A1E2A0901 = $slotSettings->GetGameData('FishHunterKABetArr');
                    $_obf_0D0E08242F070A3228030B2D133C2E06293F0A2B0E0211 = $slotSettings->GetGameData('FishHunterKABetLevel');
                    $_obf_0D5C2F3C2B27172C37331F021C073D07170F3B101B4011 = 'game.onSpawnFishes';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"answerType":"game.fire","responseView":[4,0,0,0,6,' . strlen('game.fire') . '],"msg":{"player":{"nickName":"' . $slotSettings->username . '","gender":1,"avatarUrl":"","gameServerId":"player-server-3","connectorId":"connector-server-3","teamId":"","gameId":"10007","tableId":"2ba04cc50c285a21b223e1043993456918e041415cac8ce29e72d3dc948474be-connector-server-3","gameState":"playing","id":"9dab0ea6-0cb0-4b8c-951a-e10077945f2b","areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","gold":100,"delta":' . ($Bet * 100) . ',"gain":0,"cost":' . ($Bet * 100) . ',"ratio":1,"rmpRatioCredit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"denom":0.01},"areaPlayer":{"id":"13879583b6558342be4b011cf849ee29989667afd2eb4c993a7f06371e78a2d4","areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","playerId":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","cannonLevel":' . $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 . ',"cannonCost":' . ($Bet * 100) . ',"cannonMaxLen":18,"skin":1,"lockTargetId":0,"chairId":2}' . $_obf_0D26101D240F1E3702190B24150905052619213D361201 . '}}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[1] = '{"answerType":"' . $_obf_0D5C2F3C2B27172C37331F021C073D07170F3B101B4011 . '","responseView":[4,0,0,0,6,' . strlen($_obf_0D5C2F3C2B27172C37331F021C073D07170F3B101B4011) . '],"msg":{"fishes":[]}}';
                    break;
                case 'connector.accountHandler.onPingBalance_2':
                    $_obf_0D26101D240F1E3702190B24150905052619213D361201 = '';
                    $Bet = $slotSettings->GetGameData('FishHunterKABet');
                    $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 = $slotSettings->GetGameData('FishHunterKABetCnt');
                    $_obf_0D270B100F1E29333D371524310A350428242A1E2A0901 = $slotSettings->GetGameData('FishHunterKABetArr');
                    $_obf_0D0E08242F070A3228030B2D133C2E06293F0A2B0E0211 = $slotSettings->GetGameData('FishHunterKABetLevel');
                    if( time() < $slotSettings->GetGameData('FishHunterKAGamePause') ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"answerType":"game.fire","responseView":[4,0,0,0,6,' . strlen('game.fire') . '],"msg":{"player":{"nickName":"' . $slotSettings->username . '","gender":1,"avatarUrl":"","gameServerId":"player-server-3","connectorId":"connector-server-3","teamId":"","gameId":"10007","tableId":"2ba04cc50c285a21b223e1043993456918e041415cac8ce29e72d3dc948474be-connector-server-3","gameState":"playing","id":"9dab0ea6-0cb0-4b8c-951a-e10077945f2b","areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","gold":100,"delta":' . ($Bet * 100) . ',"gain":0,"cost":' . ($Bet * 100) . ',"ratio":1,"rmpRatioCredit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"denom":0.01},"areaPlayer":{"id":"13879583b6558342be4b011cf849ee29989667afd2eb4c993a7f06371e78a2d4","areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","playerId":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","cannonLevel":' . $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 . ',"cannonCost":' . ($Bet * 100) . ',"cannonMaxLen":18,"skin":1,"lockTargetId":0,"chairId":2}' . $_obf_0D26101D240F1E3702190B24150905052619213D361201 . '}}';
                        break;
                    }
                    else
                    {
                        $slotSettings->SetGameData('FishHunterKAGamePause', time());
                    }
                    if( time() - $slotSettings->GetGameData('FishHunterKAWaveTime') >= 300 ) 
                    {
                        $slotSettings->SetGameData('FishHunterKAFishes', []);
                        $_obf_0D08330E13262D0D2E171C29040406302D3014072B2922 = $slotSettings->GetGameData('FishHunterKACurScene');
                        $_obf_0D08330E13262D0D2E171C29040406302D3014072B2922++;
                        if( $_obf_0D08330E13262D0D2E171C29040406302D3014072B2922 > 3 ) 
                        {
                            $_obf_0D08330E13262D0D2E171C29040406302D3014072B2922 = 0;
                        }
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"answerType":"game.changeScene","responseView":[4,0,0,0,6,' . strlen('game.changeScene') . '],"msg":{"scene":' . $_obf_0D08330E13262D0D2E171C29040406302D3014072B2922 . '}}';
                        $slotSettings->SetGameData('FishHunterKAWaveTime', time());
                        $slotSettings->SetGameData('FishHunterKACurScene', $_obf_0D08330E13262D0D2E171C29040406302D3014072B2922);
                        $slotSettings->SetGameData('FishHunterKAIsGroupFish', 1);
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"answerType":"game.fire","responseView":[4,0,0,0,6,' . strlen('game.fire') . '],"msg":{"player":{"nickName":"' . $slotSettings->username . '","gender":1,"avatarUrl":"","gameServerId":"player-server-3","connectorId":"connector-server-3","teamId":"","gameId":"10007","tableId":"2ba04cc50c285a21b223e1043993456918e041415cac8ce29e72d3dc948474be-connector-server-3","gameState":"playing","id":"9dab0ea6-0cb0-4b8c-951a-e10077945f2b","areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","gold":100,"delta":' . ($Bet * 100) . ',"gain":0,"cost":' . ($Bet * 100) . ',"ratio":1,"rmpRatioCredit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"denom":0.01},"areaPlayer":{"id":"13879583b6558342be4b011cf849ee29989667afd2eb4c993a7f06371e78a2d4","areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","playerId":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","cannonLevel":' . $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 . ',"cannonCost":' . ($Bet * 100) . ',"cannonMaxLen":18,"skin":1,"lockTargetId":0,"chairId":2}' . $_obf_0D26101D240F1E3702190B24150905052619213D361201 . '}}';
                        $_obf_0D3206230526183E3D285C3C282B2C5B163C383B2B2A32 = [];
                        $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01 = $slotSettings->GetGameData('FishHunterKAFishes');
                        if( !is_array($_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01) ) 
                        {
                            $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01 = [];
                        }
                        if( $slotSettings->GetGameData('FishHunterKAIsGroupFish') == 0 ) 
                        {
                            $_obf_0D5C2F3C2B27172C37331F021C073D07170F3B101B4011 = 'game.onSpawnFishes';
                            $_obf_0D0E13050525251E113F1717012D402223035B2F352C01 = '';
                            $_obf_0D3F2111261D15363E262C242D13150A3E2F1339393F22 = rand(10, 30);
                            for( $i = 0; $i < $_obf_0D3F2111261D15363E262C242D13150A3E2F1339393F22; $i++ ) 
                            {
                                $sid = rand(1, mt_getrandmax());
                                $_obf_0D2E25352E025C0713402C251A1A2E1F402F053E142C32 = [
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
                                    15, 
                                    16, 
                                    17, 
                                    18, 
                                    19, 
                                    20, 
                                    21, 
                                    22, 
                                    13, 
                                    14, 
                                    15, 
                                    16, 
                                    17, 
                                    18, 
                                    19, 
                                    20, 
                                    21, 
                                    22, 
                                    13, 
                                    14, 
                                    15, 
                                    16, 
                                    17, 
                                    18, 
                                    19, 
                                    20, 
                                    21, 
                                    22
                                ];
                                shuffle($_obf_0D2E25352E025C0713402C251A1A2E1F402F053E142C32);
                                $fishView = $_obf_0D2E25352E025C0713402C251A1A2E1F402F053E142C32[0];
                                $state = 'solo';
                                $_obf_0D041F1F3D07083B223F063D3D084004323E2814300C32 = [
                                    'solo', 
                                    'solo', 
                                    'solo', 
                                    'solo', 
                                    'solo', 
                                    'solo', 
                                    'solo', 
                                    'solo', 
                                    'solo', 
                                    'solo', 
                                    'bomb', 
                                    'bomb', 
                                    'bomb', 
                                    'bomb', 
                                    'flock', 
                                    'flock', 
                                    'flock', 
                                    'flock'
                                ];
                                shuffle($_obf_0D041F1F3D07083B223F063D3D084004323E2814300C32);
                                if( $fishView > 15 ) 
                                {
                                    $state = $_obf_0D041F1F3D07083B223F063D3D084004323E2814300C32[0];
                                }
                                if( $fishView < 10 ) 
                                {
                                    $fishView = '0' . $fishView;
                                }
                                $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$sid] = [
                                    'fishView' => 'Fish_' . $fishView, 
                                    'sid' => $sid, 
                                    'pay' => $slotSettings->Paytable['Fish_' . $fishView], 
                                    'tl' => time(), 
                                    'state' => $state
                                ];
                                $_obf_0D3206230526183E3D285C3C282B2C5B163C383B2B2A32[] = '{"areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","id":' . $sid . ',"type":"Fish_' . $fishView . '","amount":1,"born":1584296702070,"alive":' . rand(5, 10) . ',"state":"' . $state . '","path":"bezier_id_' . rand(1, 22) . '","index":0,"score":1,"teamid":"none","_id":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-31","expired":1584296782070}';
                            }
                        }
                        else
                        {
                            $slotSettings->SetGameData('FishHunterKAIsGroupFish', 0);
                            $_obf_0D0E13050525251E113F1717012D402223035B2F352C01 = '"group":{"state":"group","group":"group_id_rtol","path":[],"seed":1584453624058,"alive":15},';
                            $_obf_0D5C2F3C2B27172C37331F021C073D07170F3B101B4011 = 'game.onSpawnGroup';
                            $_obf_0D3F2111261D15363E262C242D13150A3E2F1339393F22 = 80;
                            $_obf_0D2E25352E025C0713402C251A1A2E1F402F053E142C32 = [
                                17, 
                                18, 
                                19, 
                                20, 
                                21, 
                                22, 
                                13, 
                                14, 
                                15, 
                                16, 
                                17, 
                                18, 
                                19, 
                                20, 
                                21, 
                                22, 
                                13, 
                                14, 
                                15, 
                                16, 
                                17, 
                                18, 
                                19, 
                                20, 
                                21, 
                                22
                            ];
                            shuffle($_obf_0D2E25352E025C0713402C251A1A2E1F402F053E142C32);
                            for( $i = 0; $i < $_obf_0D3F2111261D15363E262C242D13150A3E2F1339393F22; $i++ ) 
                            {
                                $sid = rand(1, mt_getrandmax());
                                $fishView = $_obf_0D2E25352E025C0713402C251A1A2E1F402F053E142C32[0];
                                if( $fishView < 10 ) 
                                {
                                    $fishView = '0' . $fishView;
                                }
                                $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$sid] = [
                                    'fishView' => 'Fish_' . $fishView, 
                                    'sid' => $sid, 
                                    'pay' => $slotSettings->Paytable['Fish_' . $fishView], 
                                    'tl' => time(), 
                                    'state' => 'group'
                                ];
                                $_obf_0D3206230526183E3D285C3C282B2C5B163C383B2B2A32[] = '{"areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","id":' . $sid . ',"type":"Fish_' . $fishView . '","amount":1,"born":1584296702070,"alive":15,"state":"group","path":"bezier_group_B1","index":' . $i . ',"score":1,"teamid":"none","_id":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-31","expired":1584296782070}';
                            }
                            $_obf_0D3F2111261D15363E262C242D13150A3E2F1339393F22 = 54;
                            $_obf_0D2E25352E025C0713402C251A1A2E1F402F053E142C32 = [
                                17, 
                                18, 
                                19, 
                                20, 
                                21, 
                                22, 
                                13, 
                                14, 
                                15, 
                                16, 
                                17, 
                                18, 
                                19, 
                                20, 
                                21, 
                                22, 
                                13, 
                                14, 
                                15, 
                                16, 
                                17, 
                                18, 
                                19, 
                                20, 
                                21, 
                                22
                            ];
                            shuffle($_obf_0D2E25352E025C0713402C251A1A2E1F402F053E142C32);
                            for( $i = 0; $i < $_obf_0D3F2111261D15363E262C242D13150A3E2F1339393F22; $i++ ) 
                            {
                                $sid = rand(1, mt_getrandmax());
                                $fishView = $_obf_0D2E25352E025C0713402C251A1A2E1F402F053E142C32[0];
                                if( $fishView < 10 ) 
                                {
                                    $fishView = '0' . $fishView;
                                }
                                $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$sid] = [
                                    'fishView' => 'Fish_' . $fishView, 
                                    'sid' => $sid, 
                                    'pay' => $slotSettings->Paytable['Fish_' . $fishView], 
                                    'tl' => time()
                                ];
                                $_obf_0D3206230526183E3D285C3C282B2C5B163C383B2B2A32[] = '{"areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","id":' . $sid . ',"type":"Fish_' . $fishView . '","amount":1,"born":1584296702070,"alive":15,"state":"group","path":"bezier_group_B2","index":' . $i . ',"score":1,"teamid":"none","_id":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-31","expired":1584296782070}';
                            }
                        }
                        $_obf_0D040E3035105C240C291B122130173D032E0212221F01 = [];
                        foreach( $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01 as $k => $_obf_0D31163931285C071F0D36363C273105250D0504281022 ) 
                        {
                            if( time() - $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$_obf_0D31163931285C071F0D36363C273105250D0504281022['sid']]['tl'] < 20 ) 
                            {
                                $_obf_0D040E3035105C240C291B122130173D032E0212221F01[$_obf_0D31163931285C071F0D36363C273105250D0504281022['sid']] = $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$_obf_0D31163931285C071F0D36363C273105250D0504281022['sid']];
                            }
                        }
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[1] = '{"answerType":"' . $_obf_0D5C2F3C2B27172C37331F021C073D07170F3B101B4011 . '","responseView":[4,0,0,0,6,' . strlen($_obf_0D5C2F3C2B27172C37331F021C073D07170F3B101B4011) . '],"msg":{' . $_obf_0D0E13050525251E113F1717012D402223035B2F352C01 . '"fishes":[' . implode(',', $_obf_0D3206230526183E3D285C3C282B2C5B163C383B2B2A32) . ']}}';
                        $slotSettings->SetGameData('FishHunterKAFishes', $_obf_0D040E3035105C240C291B122130173D032E0212221F01);
                    }
                    break;
                case 'playerControl.areaHandler.onCollider':
                    $Bet = $slotSettings->GetGameData('FishHunterKABet');
                    $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 = $slotSettings->GetGameData('FishHunterKABetCnt');
                    $_obf_0D270B100F1E29333D371524310A350428242A1E2A0901 = $slotSettings->GetGameData('FishHunterKABetArr');
                    $_obf_0D0E08242F070A3228030B2D133C2E06293F0A2B0E0211 = $slotSettings->GetGameData('FishHunterKABetLevel');
                    $fid = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['query'][0]['fid'];
                    $bid = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['query'][0]['bid'];
                    $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                    $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01 = $slotSettings->GetGameData('FishHunterKAFishes');
                    $_obf_0D08053B302F1B1B1E1130110D0E1A141A1D2916174032 = $slotSettings->GetGameData('FishHunterKABullets');
                    $allbet = $slotSettings->GetGameData('FishHunterKABet');
                    $_obf_0D3D3F3E30150A0727112A2637313238010C21161D0D32 = 'false';
                    $results = '';
                    $totalWin = 0;
                    $pause = '';
                    if( $_obf_0D0E08242F070A3228030B2D133C2E06293F0A2B0E0211 == 0 ) 
                    {
                        $_obf_0D0B232B5B28161B22112D292E1B292105045B21051511 = 100;
                    }
                    else if( $_obf_0D0E08242F070A3228030B2D133C2E06293F0A2B0E0211 == 1 ) 
                    {
                        $_obf_0D0B232B5B28161B22112D292E1B292105045B21051511 = 10;
                    }
                    else
                    {
                        $_obf_0D0B232B5B28161B22112D292E1B292105045B21051511 = 1;
                    }
                    if( $allbet <= $slotSettings->GetBalance() ) 
                    {
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $allbet / 100 * $slotSettings->GetPercent();
                        $slotSettings->UpdateJackpots($allbet);
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                        $slotSettings->SetBalance(-1 * $allbet, 'bet');
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"answerType":"game.colliderResult","Win":' . ($totalWin * 100) . ',"Balance":' . sprintf('%01.2f', $slotSettings->GetBalance()) . ',"curBet":' . $slotSettings->GetGameData('FishHunterKABet') . ',"responseView":[4,0,0,0,6,' . strlen('game.colliderResult') . '],"msg":{"player":{"id":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","gold":' . ($totalWin * 100) . ',"delta":0,"gain":0,"cost":' . ($Bet * 100) . ',"rmpRatioCredit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"ratio":1},"result":[]}}';
                        return $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0];
                    }
                    if( isset($_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]) ) 
                    {
                        if( !isset($_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]['state']) ) 
                        {
                            $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]['state'] = 'solo';
                        }
                        if( $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]['state'] == 'bomb' ) 
                        {
                            $_obf_0D28010C18260D351B163E1B1233215B1740013D5C1F22 = $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01;
                            $_obf_0D082A365C2E2A23051B152C3B38172F2C5C19390F0522 = [];
                            $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622 = [];
                            $_obf_0D0F2C06332801083E172C282F3E232907073C40392232 = rand(2, 5);
                            $totalWin = 0;
                            shuffle($_obf_0D28010C18260D351B163E1B1233215B1740013D5C1F22);
                            $_obf_0D082A365C2E2A23051B152C3B38172F2C5C19390F0522[] = '"' . $fid . '"';
                            $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[] = $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]['pay'] * $Bet * $_obf_0D0B232B5B28161B22112D292E1B292105045B21051511;
                            $totalWin += ($_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]['pay'] * $Bet);
                            foreach( $_obf_0D28010C18260D351B163E1B1233215B1740013D5C1F22 as $k => $v ) 
                            {
                                if( time() - $v['tl'] < 10 ) 
                                {
                                    $_obf_0D082A365C2E2A23051B152C3B38172F2C5C19390F0522[] = '"' . $v['sid'] . '"';
                                    $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[] = $v['pay'] * $Bet * $_obf_0D0B232B5B28161B22112D292E1B292105045B21051511;
                                    $totalWin += ($v['pay'] * $Bet);
                                    $_obf_0D0F2C06332801083E172C282F3E232907073C40392232--;
                                    if( $_obf_0D0F2C06332801083E172C282F3E232907073C40392232 <= 0 ) 
                                    {
                                        break;
                                    }
                                }
                            }
                        }
                        else
                        {
                            $totalWin = $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]['pay'] * $Bet;
                        }
                        if( $totalWin <= $bank && rand(1, 5) == 1 && $totalWin > 0 && $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]['state'] == 'bomb' ) 
                        {
                            $_obf_0D5B380D3F14230C32023B3D3F0634141B061106053811 = 0;
                            $_obf_0D19240D33232524123528381F09232D0A122F19111422 = '';
                            $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                            $slotSettings->SetBalance($totalWin);
                            $results = '{"bid":' . $bid . ',"fids":[' . implode(',', $_obf_0D082A365C2E2A23051B152C3B38172F2C5C19390F0522) . '],"ftypes":["' . $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]['fishView'] . '|bomb"],"success":true,"die":true,"score":' . ($totalWin * $_obf_0D0B232B5B28161B22112D292E1B292105045B21051511) . ',"income":' . ($totalWin * $_obf_0D0B232B5B28161B22112D292E1B292105045B21051511) . ',"chairId":0,"typeBombs":[' . implode(',', $_obf_0D082A365C2E2A23051B152C3B38172F2C5C19390F0522) . '],"pause":[' . $pause . '],"diefids":[' . implode(',', $_obf_0D082A365C2E2A23051B152C3B38172F2C5C19390F0522) . '],"winscore":[' . implode(',', $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622) . '],"cannonlevel":0' . $_obf_0D19240D33232524123528381F09232D0A122F19111422 . '}';
                            unset($_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]);
                        }
                        else if( $totalWin <= $bank && rand(1, 5) == 1 && $totalWin > 0 && $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]['state'] != 'bomb' ) 
                        {
                            $_obf_0D5B380D3F14230C32023B3D3F0634141B061106053811 = 0;
                            $_obf_0D19240D33232524123528381F09232D0A122F19111422 = '';
                            if( $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]['fishView'] == 'Fish_01' ) 
                            {
                                $pause = '"' . $fid . '"';
                                $_obf_0D5B380D3F14230C32023B3D3F0634141B061106053811 = $totalWin * $_obf_0D0B232B5B28161B22112D292E1B292105045B21051511;
                                $slotSettings->SetGameData('FishHunterKAGamePause', time() + 10);
                                $_obf_0D19240D33232524123528381F09232D0A122F19111422 = ',"pauseTime":10000';
                            }
                            $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                            $slotSettings->SetBalance($totalWin);
                            $results = '{"bid":' . $bid . ',"fids":["' . $fid . '"],"ftypes":["' . $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]['fishView'] . '|' . $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]['state'] . '"],"success":true,"die":true,"score":' . ($totalWin * $_obf_0D0B232B5B28161B22112D292E1B292105045B21051511) . ',"income":' . ($totalWin * $_obf_0D0B232B5B28161B22112D292E1B292105045B21051511) . ',"chairId":0,"typeBombs":[],"pause":[' . $pause . '],"diefids":[' . $fid . '],"winscore":[' . ($totalWin * $_obf_0D0B232B5B28161B22112D292E1B292105045B21051511) . '],"cannonlevel":0' . $_obf_0D19240D33232524123528381F09232D0A122F19111422 . '}';
                            unset($_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01[$fid]);
                        }
                        else
                        {
                            $totalWin = 0;
                            $results = '{"bid":' . $bid . ',"fids":["' . $fid . '"],"ftypes":["Fish_15|flock"],"success":true,"die":false,"score":0,"income":0,"chairId":0,"typeBombs":[],"pause":[],"diefids":[],"winscore":[],"cannonlevel":0}';
                        }
                    }
                    $slotSettings->SetGameData('FishHunterKAFishes', $_obf_0D2E391B30365C192D3121092B3C140A0E2E103F1D5C01);
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    if( $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 < 0.01 ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"answerType":"game.colliderResult","Win":' . ($totalWin * 100) . ',"Balance":0.0,"curBet":' . $slotSettings->GetGameData('FishHunterKABet') . ',"responseView":[4,0,0,0,6,' . strlen('game.colliderResult') . '],"msg":{"player":{"id":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","gold":' . ($totalWin * 100) . ',"delta":0,"gain":0,"cost":' . ($Bet * 100) . ',"rmpRatioCredit":0.1,"ratio":1},"result":[' . $results . ']}}';
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"answerType":"game.colliderResult","Win":' . ($totalWin * 100) . ',"Balance":' . sprintf('%01.2f', $slotSettings->GetBalance()) . ',"curBet":' . $slotSettings->GetGameData('FishHunterKABet') . ',"responseView":[4,0,0,0,6,' . strlen('game.colliderResult') . '],"msg":{"player":{"id":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","gold":' . ($totalWin * 100) . ',"delta":1,"gain":1,"cost":' . ($Bet * 100) . ',"rmpRatioCredit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"ratio":1},"result":[' . $results . ']}}';
                    }
                    $response = '{"responseEvent":"spin","responseType":"bet","serverResponse":{"slotBet":0,"totalFreeGames":0,"currentFreeGames":0,"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":0,"totalWin":' . $totalWin . ',"winLines":[],"Jackpots":[],"reelsSymbols":[]}}';
                    $slotSettings->SaveLogReport($response, $allbet, 1, $totalWin, 'bet');
                    break;
                case 'fishHunter.areaHandler.onUpdateCannon':
                    $Bet = $slotSettings->GetGameData('FishHunterKABet');
                    $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 = $slotSettings->GetGameData('FishHunterKABetCnt');
                    $_obf_0D270B100F1E29333D371524310A350428242A1E2A0901 = $slotSettings->GetGameData('FishHunterKABetArr');
                    $_obf_0D0E08242F070A3228030B2D133C2E06293F0A2B0E0211 = $slotSettings->GetGameData('FishHunterKABetLevel');
                    $_obf_0D5B361E28140E312D1B271E1C2C235C3514331D3E2B32 = $slotSettings->GetGameData('FishHunterKABetLevel') * 6;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['query']['upgrade'] ) 
                    {
                        $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122++;
                    }
                    else
                    {
                        $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122--;
                    }
                    if( count($_obf_0D270B100F1E29333D371524310A350428242A1E2A0901) <= $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 ) 
                    {
                        $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 = count($_obf_0D270B100F1E29333D371524310A350428242A1E2A0901) - 1;
                    }
                    if( $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 <= 0 ) 
                    {
                        $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 = 0;
                    }
                    $Bet = $_obf_0D270B100F1E29333D371524310A350428242A1E2A0901[$_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122];
                    $slotSettings->SetGameData('FishHunterKABet', $Bet);
                    $slotSettings->SetGameData('FishHunterKABetCnt', $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122);
                    $slotSettings->SetGameData('FishHunterKABetArr', $_obf_0D270B100F1E29333D371524310A350428242A1E2A0901);
                    $slotSettings->SetGameData('FishHunterKABetLevel', $_obf_0D0E08242F070A3228030B2D133C2E06293F0A2B0E0211);
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"answerType":"game.updateCannon","Balance":' . sprintf('%01.2f', $slotSettings->GetBalance()) . ',"curBet":' . $slotSettings->GetGameData('FishHunterKABet') . ',"responseView":[4,0,0,0,6,' . strlen('game.updateCannon') . '],"msg":{"areaPlayer":{"id":"2b7e1e20bfc42e388fe81831c2a2d80a6657370638b7170b5031110e10e73379","areaId":"e339f81cfa6b0d3ed09053d2d6f186416e90b358c2b26a84a81fa9e90d94004a-connector-server-3","playerId":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","cannonLevel":' . $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 . ',"cannonCost":' . ($Bet * 100) . ',"cannonMaxLen":18,"skin":1,"lockTargetId":0,"chairId":0}}}';
                    break;
                case 'connector.accountHandler.gameRecall':
                    $Bet = $slotSettings->GetGameData('FishHunterKABet');
                    $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 = $slotSettings->GetGameData('FishHunterKABetCnt');
                    $_obf_0D270B100F1E29333D371524310A350428242A1E2A0901 = $slotSettings->GetGameData('FishHunterKABetArr');
                    $_obf_0D0E08242F070A3228030B2D133C2E06293F0A2B0E0211 = $slotSettings->GetGameData('FishHunterKABetLevel');
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['query']['upgrade'] ) 
                    {
                        $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122++;
                    }
                    else
                    {
                        $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122--;
                    }
                    if( count($_obf_0D270B100F1E29333D371524310A350428242A1E2A0901) <= $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 ) 
                    {
                        $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 = count($_obf_0D270B100F1E29333D371524310A350428242A1E2A0901) - 1;
                    }
                    if( $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 <= 0 ) 
                    {
                        $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 = 0;
                    }
                    $Bet = $_obf_0D270B100F1E29333D371524310A350428242A1E2A0901[$_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122];
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"answerType":"game.updateCannon","responseView":[4,0,0,0,6,' . strlen('game.updateCannon') . '],"msg":{"areaPlayer":{"id":"2b7e1e20bfc42e388fe81831c2a2d80a6657370638b7170b5031110e10e73379","areaId":"e339f81cfa6b0d3ed09053d2d6f186416e90b358c2b26a84a81fa9e90d94004a-connector-server-3","playerId":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","cannonLevel":' . $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 . ',"cannonCost":' . ($Bet * 100) . ',"cannonMaxLen":18,"skin":1,"lockTargetId":0,"chairId":0}}}';
                    break;
                case 'areaFishControl.fishHandler.fetchFishInfo':
                    $Bet = $slotSettings->GetGameData('FishHunterKABet');
                    $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 = $slotSettings->GetGameData('FishHunterKABetCnt');
                    $_obf_0D270B100F1E29333D371524310A350428242A1E2A0901 = $slotSettings->GetGameData('FishHunterKABetArr');
                    $_obf_0D0E08242F070A3228030B2D133C2E06293F0A2B0E0211 = $slotSettings->GetGameData('FishHunterKABetLevel');
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"code":200,"data":{"scores":{"Fish_22":2,"Fish_21":3,"Fish_20":4,"Fish_19":5,"Fish_18":6,"Fish_17":7,"Fish_16":8,"Fish_15":9,"Fish_14":10,"Fish_13":12,"Fish_12":15,"Fish_11":18,"Fish_10":20,"Fish_09":25,"Fish_08":30,"Fish_07":40,"Fish_06":80,"Fish_05":100,"Fish_04":150,"Fish_03":200,"Fish_02":200,"Fish_01":20},"cannonCost":' . ($Bet * 100) . '}}';
                    break;
                case 'fishHunter.areaHandler.onFire':
                    $_obf_0D08053B302F1B1B1E1130110D0E1A141A1D2916174032 = $slotSettings->GetGameData('FishHunterKABullets');
                    $_obf_0D290F22110B1D05061B0E1332353F1D180A2113143222 = $slotSettings->GetGameData('FishHunterKABet');
                    $allbet = $_obf_0D290F22110B1D05061B0E1332353F1D180A2113143222;
                    $Bet = $slotSettings->GetGameData('FishHunterKABet');
                    $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 = $slotSettings->GetGameData('FishHunterKABetCnt');
                    $_obf_0D270B100F1E29333D371524310A350428242A1E2A0901 = $slotSettings->GetGameData('FishHunterKABetArr');
                    $_obf_0D0E08242F070A3228030B2D133C2E06293F0A2B0E0211 = $slotSettings->GetGameData('FishHunterKABetLevel');
                    if( $slotSettings->GetBalance() < $allbet ) 
                    {
                        $_obf_0D26101D240F1E3702190B24150905052619213D361201 = '';
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"answerType":"game.fire","responseView":[4,0,0,0,6,' . strlen('game.fire') . '],"msg":{"player":{"nickName":"' . $slotSettings->username . '","gender":1,"avatarUrl":"","gameServerId":"player-server-3","connectorId":"connector-server-3","teamId":"","gameId":"10007","tableId":"2ba04cc50c285a21b223e1043993456918e041415cac8ce29e72d3dc948474be-connector-server-3","gameState":"playing","id":"9dab0ea6-0cb0-4b8c-951a-e10077945f2b","areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","gold":100,"delta":' . $Bet . ',"gain":0,"cost":0,"ratio":1,"rmpRatioCredit":1,"denom":0.01},"areaPlayer":{"id":"13879583b6558342be4b011cf849ee29989667afd2eb4c993a7f06371e78a2d4","areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","playerId":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","cannonLevel":' . $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 . ',"cannonCost":' . ($Bet * 100) . ',"cannonMaxLen":18,"skin":1,"lockTargetId":0,"chairId":1}' . $_obf_0D26101D240F1E3702190B24150905052619213D361201 . '}}';
                    }
                    else
                    {
                        $slotSettings->SetBalance(-1 * $allbet, 'bet');
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $allbet / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, 'bet');
                        $slotSettings->UpdateJackpots($allbet);
                        if( !is_array($_obf_0D08053B302F1B1B1E1130110D0E1A141A1D2916174032) ) 
                        {
                            $_obf_0D08053B302F1B1B1E1130110D0E1A141A1D2916174032 = [];
                        }
                        $bulletId = rand(10000000000000, mt_getrandmax());
                        $_obf_0D26101D240F1E3702190B24150905052619213D361201 = ',"bullet":{"transactionId":"4623343b-db8d-442c-a032-7523aac41417","createTime":1584376468710,"areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","playerId":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","bulletId":' . $bulletId . ',"angle":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['query']['angle'] . ',"cost":' . $_obf_0D290F22110B1D05061B0E1332353F1D180A2113143222 . ',"lockTargetId":0,"chairId":0,"cannonlevel":' . $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 . ',"cannonskin":1,"_id":"9dab0ea6-0cb0-4b8c-951a-e10077945f2b3584376468710","level":1}';
                        $_obf_0D08053B302F1B1B1E1130110D0E1A141A1D2916174032[$bulletId] = ['bulletId' => $bulletId];
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"answerType":"game.fire","responseView":[4,0,0,0,6,' . strlen('game.fire') . '],"msg":{"player":{"nickName":"' . $slotSettings->username . '","gender":1,"avatarUrl":"","gameServerId":"player-server-3","connectorId":"connector-server-3","teamId":"","gameId":"10007","tableId":"2ba04cc50c285a21b223e1043993456918e041415cac8ce29e72d3dc948474be-connector-server-3","gameState":"playing","id":"9dab0ea6-0cb0-4b8c-951a-e10077945f2b","areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","gold":100,"delta":' . $_obf_0D290F22110B1D05061B0E1332353F1D180A2113143222 . ',"gain":0,"cost":0,"ratio":1,"rmpRatioCredit":100,"denom":0.01},"areaPlayer":{"id":"13879583b6558342be4b011cf849ee29989667afd2eb4c993a7f06371e78a2d4","areaId":"7909d963c43c6df71d7f7ee17bfc4b5133809d80342e2f645d01e16119eec1ad-connector-server-3","playerId":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","cannonLevel":' . $_obf_0D1F172C051F3F39011C02253C1D0516270E18243F3122 . ',"cannonCost":' . ($Bet * 100) . ',"cannonMaxLen":18,"skin":1,"lockTargetId":0,"chairId":2}' . $_obf_0D26101D240F1E3702190B24150905052619213D361201 . '}}';
                        $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[1] = '{"answerType":"game.colliderResult","responseView":[4,0,0,0,6,' . strlen('game.colliderResult') . '],"msg":{"player":{"id":"d607e29f-99cc-48bc-a37d-5590b80fa0f6","gold":0,"delta":0,"gain":0,"cost":' . ($Bet * 100) . ',"rmpRatioCredit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"ratio":1},"result":[]}}';
                        $slotSettings->SetGameData('FishHunterKABullets', $_obf_0D08053B302F1B1B1E1130110D0E1A141A1D2916174032);
                        $response = '{"responseEvent":"spin","responseType":"bet","serverResponse":{"slotBet":' . $allbet . ',"totalFreeGames":0,"currentFreeGames":0,"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":0,"totalWin":0,"winLines":[],"Jackpots":[],"reelsSymbols":[]}}';
                        $slotSettings->SaveLogReport($response, $allbet, 1, 0, 'bet');
                    }
                    break;
            }
            $response = implode('---', $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01);
            $slotSettings->SaveGameData();
            \DB::commit();
            return ':::' . $response;
        }
    }

}
