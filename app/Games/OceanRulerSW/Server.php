<?php 
namespace VanguardLTE\Games\OceanRulerSW
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
            if( isset($_GET['step']) ) 
            {
                sleep(1);
                if( $_GET['step'] == 1 ) 
                {
                    return '2:40';
                }
                else if( $_GET['step'] == 0 ) 
                {
                    return '96:0{"sid":"Frz92Su8ddussxizACPJ","upgrades":["websocket"],"pingInterval":25000,"pingTimeout":5000}';
                }
                return 'ok';
            }
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = '';
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = (string)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[0];
            switch( $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 ) 
            {
                case 'init':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    $_obf_0D030E023B24273D231A270A343212362F2140160E0832 = [];
                    foreach( $slotSettings->Denominations as $b ) 
                    {
                        $_obf_0D030E023B24273D231A270A343212362F2140160E0832[] = '' . ($b * 100) . '';
                    }
                    $slotSettings->CurrentDenom = $slotSettings->Denominations[0];
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance());
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '42["init",{"gameSession":"eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJzZXNzaW9uSWQiOiIwIiwiaWQiOiJnYW1lczpjb250ZXh0OjE1MDpwbGF5ZXIxNTg5MDIzNzQzNzkwOnN3X29yOm1vYmlsZSIsImdhbWVNb2RlIjoiZnVuIiwiaWF0IjoxNTg5MDI4NjI3LCJpc3MiOiJza3l3aW5kZ3JvdXAifQ.xq2WFe3GCy7VZugNB_FK_DFcUhwwbaYKDN_RYbydQnuMX4t1WTJ3W8WVL5HAt8B27XHAVOVibzPun2fEJTOPVA","balance":{"currency":"","amount":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"real":{"amount":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"bonus":{"amount":0}},"result":{"request":"init","gameId":"sw_or","version":"2.1.0","name":"Ocean Ruler","settings":{"coins":[1,2,3,4,5,6,7,8,9,10,20,30,40,50,60,70,80,90,100,200,300,400,500,600,700,800,900,1000],"stakeDef":' . $slotSettings->Denominations[0] . ',"coinsRate":' . $slotSettings->Denominations[0] . ',"defaultCoin":1,"currencyMultiplier":100},"state":{"mode":"normal","features":[]},"playerCode":"' . $slotSettings->username . '"},"gameSettings":{},"brandSettings":{"fullscreen":true},"roundEnded":true}]';
                    break;
                case 'play':
                    $gameCommand = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['request'];
                    if( $gameCommand == 'startBonus' ) 
                    {
                        if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['select']) ) 
                        {
                            $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                            $totalWin = 0;
                            $requestId = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['requestId'];
                            $bulletId = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['bulletId'];
                            $allbet = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['bet'];
                            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance());
                            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '42["play",{"balance":{"currency":"","amount":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"real":{"amount":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"bonus":{"amount":0}},"result":{"request":"startBonus","state":{"mode":"bonus","features":[],"bonus":{"bet":' . $allbet . ',"rounds":[]}},"totalWin":0,"roundEnded":false},"requestId":' . $requestId . ',"roundEnded":false}]';
                        }
                        else
                        {
                            $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                            $totalWin = 0;
                            $requestId = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['requestId'];
                            $bulletId = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['bulletId'];
                            $allbet = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['bet'];
                            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance());
                            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '42["play",{"balance":{"currency":"","amount":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"real":{"amount":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"bonus":{"amount":0}},"result":{"request":"startBonus","state":{"mode":"bonus","features":[],"bonus":{"bet":' . $allbet . ',"rounds":[]}},"totalWin":0,"roundEnded":false},"requestId":' . $requestId . ',"roundEnded":false}]';
                        }
                    }
                    if( $gameCommand == 'fire' || $gameCommand == 'shot' ) 
                    {
                        $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                        $totalWin = 0;
                        $requestId = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['requestId'];
                        $bulletId = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['bulletId'];
                        $allbet = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['bet'];
                        if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['items']) ) 
                        {
                            $items = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['items'];
                            $_obf_0D32063D0805362D3C383C0A1F5C0B13221C353D382232 = 'normal';
                            $_obf_0D010D10150A26311B19252B2C392338230E2439082F01 = [];
                        }
                        else
                        {
                            $items = [];
                            $_obf_0D010D10150A26311B19252B2C392338230E2439082F01 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['item'];
                            $_obf_0D32063D0805362D3C383C0A1F5C0B13221C353D382232 = $_obf_0D010D10150A26311B19252B2C392338230E2439082F01['mode'];
                            if( $_obf_0D32063D0805362D3C383C0A1F5C0B13221C353D382232 == 'vortex' || $_obf_0D32063D0805362D3C383C0A1F5C0B13221C353D382232 == 'chainReaction' || $_obf_0D32063D0805362D3C383C0A1F5C0B13221C353D382232 == 'bomb' ) 
                            {
                                $_obf_0D010D10150A26311B19252B2C392338230E2439082F01 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['item']['hitItems'];
                                array_unshift($_obf_0D010D10150A26311B19252B2C392338230E2439082F01, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['item']['target']);
                                $_obf_0D32063D0805362D3C383C0A1F5C0B13221C353D382232 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822[1]['item']['mode'];
                            }
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
                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid balance"}';
                            exit( $response );
                        }
                        $_obf_0D1D302E1B130410270B36315C131F0B33131B0A3D0C32 = '';
                        $_obf_0D5B2E05021F381612403E27392522050E1E10332F2232 = [];
                        for( $i = 0; $i < count($items); $i++ ) 
                        {
                            $_obf_0D042E1F21213C0C0F3F2136133705222D2E0E03093322 = $items[$i];
                            $_obf_0D3516212504151D0F130F1923290D13371B0C30381322 = $_obf_0D042E1F21213C0C0F3F2136133705222D2E0E03093322['target']['type'];
                            $_obf_0D1D5B3616021140341D3332135B0A2B111634133D0301 = $_obf_0D042E1F21213C0C0F3F2136133705222D2E0E03093322['target']['uid'];
                            $_obf_0D01023702313B3C193D103F0C1A042D1F07093F5C1F11 = rand(1, $slotSettings->FishDamage['Fish_' . $_obf_0D3516212504151D0F130F1923290D13371B0C30381322]);
                            $pay = $slotSettings->Paytable['Fish_' . $_obf_0D3516212504151D0F130F1923290D13371B0C30381322];
                            if( is_numeric($pay[0]) ) 
                            {
                                shuffle($pay);
                                $win = $pay[0] * $allbet;
                            }
                            else
                            {
                                $win = 0;
                            }
                            if( $totalWin + $win <= $bank && $_obf_0D01023702313B3C193D103F0C1A042D1F07093F5C1F11 == 1 ) 
                            {
                                $_obf_0D5B2E05021F381612403E27392522050E1E10332F2232[] = '[' . $_obf_0D1D5B3616021140341D3332135B0A2B111634133D0301 . ',' . $pay[0] . ']';
                            }
                            else
                            {
                                $win = 0;
                            }
                            $totalWin += $win;
                        }
                        $_obf_0D06403F402E2C221A231A271816253734013C1D063032 = 0;
                        for( $i = 0; $i < count($_obf_0D010D10150A26311B19252B2C392338230E2439082F01); $i++ ) 
                        {
                            $_obf_0D042E1F21213C0C0F3F2136133705222D2E0E03093322 = $_obf_0D010D10150A26311B19252B2C392338230E2439082F01[$i];
                            $_obf_0D3516212504151D0F130F1923290D13371B0C30381322 = $_obf_0D042E1F21213C0C0F3F2136133705222D2E0E03093322['type'];
                            $_obf_0D1D5B3616021140341D3332135B0A2B111634133D0301 = $_obf_0D042E1F21213C0C0F3F2136133705222D2E0E03093322['uid'];
                            $_obf_0D01023702313B3C193D103F0C1A042D1F07093F5C1F11 = rand(1, $slotSettings->FishDamage['Fish_' . $_obf_0D3516212504151D0F130F1923290D13371B0C30381322]);
                            $pay = $slotSettings->Paytable['Fish_' . $_obf_0D3516212504151D0F130F1923290D13371B0C30381322];
                            if( $_obf_0D01023702313B3C193D103F0C1A042D1F07093F5C1F11 == 1 && $i == 0 ) 
                            {
                                $_obf_0D06403F402E2C221A231A271816253734013C1D063032 = 1;
                            }
                            $_obf_0D01023702313B3C193D103F0C1A042D1F07093F5C1F11 = $_obf_0D06403F402E2C221A231A271816253734013C1D063032;
                            if( is_numeric($pay[0]) ) 
                            {
                                shuffle($pay);
                                $win = $pay[0] * $allbet;
                            }
                            else
                            {
                                $win = 0;
                            }
                            if( $totalWin + $win <= $bank && $_obf_0D01023702313B3C193D103F0C1A042D1F07093F5C1F11 == 1 ) 
                            {
                                $_obf_0D5B2E05021F381612403E27392522050E1E10332F2232[] = '[' . $_obf_0D1D5B3616021140341D3332135B0A2B111634133D0301 . ',' . $pay[0] . ']';
                            }
                            else
                            {
                                $win = 0;
                            }
                            $totalWin += $win;
                        }
                        if( $totalWin > 0 ) 
                        {
                            $slotSettings->SetBank('', -1 * $totalWin);
                            $slotSettings->SetBalance($totalWin);
                        }
                        if( $gameCommand == 'fire' ) 
                        {
                            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance());
                            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '42["play",{"balance":{"currency":"","amount":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"real":{"amount":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"bonus":{"amount":0}},"result":{"bulletId":' . $bulletId . ',"killed":[' . implode(',', $_obf_0D5B2E05021F381612403E27392522050E1E10332F2232) . '],"request":"fire","totalBet":' . $allbet . ',"state":{"mode":"normal","features":[' . $_obf_0D1D302E1B130410270B36315C131F0B33131B0A3D0C32 . ']},"totalWin":' . $totalWin . ',"roundEnded":false},"requestId":' . $requestId . ',"roundEnded":false}]';
                        }
                        if( $gameCommand == 'shot' ) 
                        {
                            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance());
                            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '42["play",{"balance":{"currency":"","amount":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"real":{"amount":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"bonus":{"amount":0}},"result":{"bulletId":' . $bulletId . ',"killed":[' . implode(',', $_obf_0D5B2E05021F381612403E27392522050E1E10332F2232) . '],"request":"shot","totalBet":' . $allbet . ',"state":{"mode":"normal","features":[' . $_obf_0D1D302E1B130410270B36315C131F0B33131B0A3D0C32 . ']},"totalWin":' . $totalWin . ',"roundEnded":false},"requestId":' . $requestId . ',"roundEnded":false}]';
                        }
                        $response = '{"responseEvent":"spin","responseType":"bet","serverResponse":{"slotBet":0,"totalFreeGames":0,"currentFreeGames":0,"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":0,"totalWin":' . $totalWin . ',"winLines":[],"Jackpots":[],"reelsSymbols":[]}}';
                        $slotSettings->SaveLogReport($response, $allbet, 1, $totalWin, 'bet');
                    }
                    break;
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0];
        }
    }

}
