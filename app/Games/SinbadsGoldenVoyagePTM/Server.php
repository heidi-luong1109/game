<?php 
namespace VanguardLTE\Games\SinbadsGoldenVoyagePTM
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
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['umid']) ) 
            {
                $umid = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['umid'];
                if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) ) 
                {
                    $umid = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'];
                }
            }
            else
            {
                if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) ) 
                {
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"ID":18}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                }
                $umid = 0;
            }
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '46120' ) 
            {
                $_obf_0D2813390912262B102326025B34051621182F31041832 = $slotSettings->GetGameData('SinbadsGoldenVoyagePTMCurrentFreeGame');
                $_obf_0D131D5C261C392D093F121D1F2E13191812150D231232 = $slotSettings->GetGameData('SinbadsGoldenVoyagePTMFreeSpins');
                $_obf_0D222C3C342D2C31305B091C0A1C10250A19140B2B2811 = $slotSettings->GetGameData('SinbadsGoldenVoyagePTMFreeLogs');
                $_obf_0D390225301D2E21373038281039131A192C011A3F0632 = json_decode(trim($_obf_0D131D5C261C392D093F121D1F2E13191812150D231232[$_obf_0D2813390912262B102326025B34051621182F31041832]), true);
                $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11 = json_decode(trim($_obf_0D222C3C342D2C31305B091C0A1C10250A19140B2B2811[$_obf_0D2813390912262B102326025B34051621182F31041832]), true);
                $totalWin = $_obf_0D390225301D2E21373038281039131A192C011A3F0632['currentWin'];
                if( $totalWin > 0 ) 
                {
                    $slotSettings->SetBalance($totalWin);
                }
                $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11['serverResponse']['freeSeq'] = $_obf_0D131D5C261C392D093F121D1F2E13191812150D231232;
                $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11['serverResponse']['freeLogSeq'] = $_obf_0D222C3C342D2C31305B091C0A1C10250A19140B2B2811;
                $slotSettings->SaveLogReport(json_encode($_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11), $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11['serverResponse']['slotBet'], $_obf_0D1B3C2C0421323E3F0A02172C2A3B0B290D5C39150B11['serverResponse']['slotLines'], $totalWin, 'freespin');
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"gameId":2543168908},"ID":46121,"umid":45}';
                $slotSettings->SetGameData('SinbadsGoldenVoyagePTMCurrentFreeGame', $slotSettings->GetGameData('SinbadsGoldenVoyagePTMCurrentFreeGame') + 1);
            }
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) && ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '46583' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '46302') ) 
            {
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] = 'regular';
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == '46302' ) 
                {
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] = 'free';
                }
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'regular' ) 
                {
                    $umid = '0';
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    $bonusMpl = 1;
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMBonusWin', 0);
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMFreeGames', 0);
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMCurrentFreeGame', 0);
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMTotalWin', 0);
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMFreeBalance', 0);
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMFreeStartWin', 0);
                }
                else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'free' ) 
                {
                    $umid = '0';
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMCurrentFreeGame', $slotSettings->GetGameData('SinbadsGoldenVoyagePTMCurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->slotFreeMpl;
                }
                $linesId = [];
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'regular' ) 
                {
                    $linesId[0] = [
                        2, 
                        1, 
                        2, 
                        1, 
                        2, 
                        1
                    ];
                    $linesId[1] = [
                        2, 
                        1, 
                        2, 
                        1, 
                        2, 
                        2
                    ];
                    $linesId[2] = [
                        2, 
                        1, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[3] = [
                        2, 
                        1, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[4] = [
                        2, 
                        1, 
                        2, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[5] = [
                        2, 
                        1, 
                        2, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[6] = [
                        2, 
                        2, 
                        2, 
                        1, 
                        2, 
                        1
                    ];
                    $linesId[7] = [
                        2, 
                        2, 
                        2, 
                        1, 
                        2, 
                        2
                    ];
                    $linesId[8] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[9] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[10] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[11] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[12] = [
                        2, 
                        2, 
                        3, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[13] = [
                        2, 
                        2, 
                        3, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[14] = [
                        2, 
                        2, 
                        3, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[15] = [
                        2, 
                        2, 
                        3, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[16] = [
                        2, 
                        2, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[17] = [
                        2, 
                        2, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[18] = [
                        2, 
                        2, 
                        3, 
                        3, 
                        4, 
                        3
                    ];
                    $linesId[19] = [
                        2, 
                        2, 
                        3, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[20] = [
                        3, 
                        2, 
                        2, 
                        1, 
                        2, 
                        1
                    ];
                    $linesId[21] = [
                        3, 
                        2, 
                        2, 
                        1, 
                        2, 
                        2
                    ];
                    $linesId[22] = [
                        3, 
                        2, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[23] = [
                        3, 
                        2, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[24] = [
                        3, 
                        2, 
                        2, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[25] = [
                        3, 
                        2, 
                        2, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[26] = [
                        3, 
                        2, 
                        3, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[27] = [
                        3, 
                        2, 
                        3, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[28] = [
                        3, 
                        2, 
                        3, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[29] = [
                        3, 
                        2, 
                        3, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[30] = [
                        3, 
                        2, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[31] = [
                        3, 
                        2, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[32] = [
                        3, 
                        2, 
                        3, 
                        3, 
                        4, 
                        3
                    ];
                    $linesId[33] = [
                        3, 
                        2, 
                        3, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[34] = [
                        3, 
                        3, 
                        3, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[35] = [
                        3, 
                        3, 
                        3, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[36] = [
                        3, 
                        3, 
                        3, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[37] = [
                        3, 
                        3, 
                        3, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[38] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[39] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[40] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        4, 
                        3
                    ];
                    $linesId[41] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[42] = [
                        3, 
                        3, 
                        4, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[43] = [
                        3, 
                        3, 
                        4, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[44] = [
                        3, 
                        3, 
                        4, 
                        3, 
                        4, 
                        3
                    ];
                    $linesId[45] = [
                        3, 
                        3, 
                        4, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[46] = [
                        3, 
                        3, 
                        4, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[47] = [
                        3, 
                        3, 
                        4, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[48] = [
                        3, 
                        3, 
                        4, 
                        4, 
                        5, 
                        4
                    ];
                    $linesId[49] = [
                        3, 
                        3, 
                        4, 
                        4, 
                        5, 
                        5
                    ];
                    $linesId[50] = [
                        4, 
                        3, 
                        3, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[51] = [
                        4, 
                        3, 
                        3, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[52] = [
                        4, 
                        3, 
                        3, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[53] = [
                        4, 
                        3, 
                        3, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[54] = [
                        4, 
                        3, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[55] = [
                        4, 
                        3, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[56] = [
                        4, 
                        3, 
                        3, 
                        3, 
                        4, 
                        3
                    ];
                    $linesId[57] = [
                        4, 
                        3, 
                        3, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[58] = [
                        4, 
                        3, 
                        4, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[59] = [
                        4, 
                        3, 
                        4, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[60] = [
                        4, 
                        3, 
                        4, 
                        3, 
                        4, 
                        3
                    ];
                    $linesId[61] = [
                        4, 
                        3, 
                        4, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[62] = [
                        4, 
                        3, 
                        4, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[63] = [
                        4, 
                        3, 
                        4, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[64] = [
                        4, 
                        3, 
                        4, 
                        4, 
                        5, 
                        4
                    ];
                    $linesId[65] = [
                        4, 
                        3, 
                        4, 
                        4, 
                        5, 
                        5
                    ];
                    $linesId[66] = [
                        4, 
                        4, 
                        4, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[67] = [
                        4, 
                        4, 
                        4, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[68] = [
                        4, 
                        4, 
                        4, 
                        3, 
                        4, 
                        3
                    ];
                    $linesId[69] = [
                        4, 
                        4, 
                        4, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[70] = [
                        4, 
                        4, 
                        4, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[71] = [
                        4, 
                        4, 
                        4, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[72] = [
                        4, 
                        4, 
                        4, 
                        4, 
                        5, 
                        4
                    ];
                    $linesId[73] = [
                        4, 
                        4, 
                        4, 
                        4, 
                        5, 
                        5
                    ];
                    $linesId[74] = [
                        4, 
                        4, 
                        5, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[75] = [
                        4, 
                        4, 
                        5, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[76] = [
                        4, 
                        4, 
                        5, 
                        4, 
                        5, 
                        4
                    ];
                    $linesId[77] = [
                        4, 
                        4, 
                        5, 
                        4, 
                        5, 
                        5
                    ];
                    $linesId[78] = [
                        4, 
                        4, 
                        5, 
                        5, 
                        5, 
                        4
                    ];
                    $linesId[79] = [
                        4, 
                        4, 
                        5, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[80] = [
                        4, 
                        4, 
                        5, 
                        5, 
                        6, 
                        5
                    ];
                    $linesId[81] = [
                        4, 
                        4, 
                        5, 
                        5, 
                        6, 
                        6
                    ];
                    $linesId[82] = [
                        5, 
                        4, 
                        4, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[83] = [
                        5, 
                        4, 
                        4, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[84] = [
                        5, 
                        4, 
                        4, 
                        3, 
                        4, 
                        3
                    ];
                    $linesId[85] = [
                        5, 
                        4, 
                        4, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[86] = [
                        5, 
                        4, 
                        4, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[87] = [
                        5, 
                        4, 
                        4, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[88] = [
                        5, 
                        4, 
                        4, 
                        4, 
                        5, 
                        4
                    ];
                    $linesId[89] = [
                        5, 
                        4, 
                        4, 
                        4, 
                        5, 
                        5
                    ];
                    $linesId[90] = [
                        5, 
                        4, 
                        5, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[91] = [
                        5, 
                        4, 
                        5, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[92] = [
                        5, 
                        4, 
                        5, 
                        4, 
                        5, 
                        4
                    ];
                    $linesId[93] = [
                        5, 
                        4, 
                        5, 
                        4, 
                        5, 
                        5
                    ];
                    $linesId[94] = [
                        5, 
                        4, 
                        5, 
                        5, 
                        5, 
                        4
                    ];
                    $linesId[95] = [
                        5, 
                        4, 
                        5, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[96] = [
                        5, 
                        4, 
                        5, 
                        5, 
                        6, 
                        5
                    ];
                    $linesId[97] = [
                        5, 
                        4, 
                        5, 
                        5, 
                        6, 
                        6
                    ];
                    $linesId[98] = [
                        5, 
                        5, 
                        5, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[99] = [
                        5, 
                        5, 
                        5, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[100] = [
                        5, 
                        5, 
                        5, 
                        4, 
                        5, 
                        4
                    ];
                    $linesId[101] = [
                        5, 
                        5, 
                        5, 
                        4, 
                        5, 
                        5
                    ];
                    $linesId[102] = [
                        5, 
                        5, 
                        5, 
                        5, 
                        5, 
                        4
                    ];
                    $linesId[103] = [
                        5, 
                        5, 
                        5, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[104] = [
                        5, 
                        5, 
                        5, 
                        5, 
                        6, 
                        5
                    ];
                    $linesId[105] = [
                        5, 
                        5, 
                        5, 
                        5, 
                        6, 
                        6
                    ];
                    $linesId[106] = [
                        5, 
                        5, 
                        6, 
                        5, 
                        5, 
                        4
                    ];
                    $linesId[107] = [
                        5, 
                        5, 
                        6, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[108] = [
                        5, 
                        5, 
                        6, 
                        5, 
                        6, 
                        5
                    ];
                    $linesId[109] = [
                        5, 
                        5, 
                        6, 
                        5, 
                        6, 
                        6
                    ];
                    $linesId[110] = [
                        5, 
                        5, 
                        6, 
                        6, 
                        6, 
                        5
                    ];
                    $linesId[111] = [
                        5, 
                        5, 
                        6, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[112] = [
                        5, 
                        5, 
                        6, 
                        6, 
                        7, 
                        6
                    ];
                    $linesId[113] = [
                        5, 
                        5, 
                        6, 
                        6, 
                        7, 
                        7
                    ];
                    $linesId[114] = [
                        6, 
                        5, 
                        5, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[115] = [
                        6, 
                        5, 
                        5, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[116] = [
                        6, 
                        5, 
                        5, 
                        4, 
                        5, 
                        4
                    ];
                    $linesId[117] = [
                        6, 
                        5, 
                        5, 
                        4, 
                        5, 
                        5
                    ];
                    $linesId[118] = [
                        6, 
                        5, 
                        5, 
                        5, 
                        5, 
                        4
                    ];
                    $linesId[119] = [
                        6, 
                        5, 
                        5, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[120] = [
                        6, 
                        5, 
                        5, 
                        5, 
                        6, 
                        5
                    ];
                    $linesId[121] = [
                        6, 
                        5, 
                        5, 
                        5, 
                        6, 
                        6
                    ];
                    $linesId[122] = [
                        6, 
                        5, 
                        6, 
                        5, 
                        5, 
                        4
                    ];
                    $linesId[123] = [
                        6, 
                        5, 
                        6, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[124] = [
                        6, 
                        5, 
                        6, 
                        5, 
                        6, 
                        5
                    ];
                    $linesId[125] = [
                        6, 
                        5, 
                        6, 
                        5, 
                        6, 
                        6
                    ];
                    $linesId[126] = [
                        6, 
                        5, 
                        6, 
                        6, 
                        6, 
                        5
                    ];
                    $linesId[127] = [
                        6, 
                        5, 
                        6, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[128] = [
                        6, 
                        5, 
                        6, 
                        6, 
                        7, 
                        6
                    ];
                    $linesId[129] = [
                        6, 
                        5, 
                        6, 
                        6, 
                        7, 
                        7
                    ];
                    $linesId[130] = [
                        6, 
                        6, 
                        6, 
                        5, 
                        5, 
                        4
                    ];
                    $linesId[131] = [
                        6, 
                        6, 
                        6, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[132] = [
                        6, 
                        6, 
                        6, 
                        5, 
                        6, 
                        5
                    ];
                    $linesId[133] = [
                        6, 
                        6, 
                        6, 
                        5, 
                        6, 
                        6
                    ];
                    $linesId[134] = [
                        6, 
                        6, 
                        6, 
                        6, 
                        6, 
                        5
                    ];
                    $linesId[135] = [
                        6, 
                        6, 
                        6, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[136] = [
                        6, 
                        6, 
                        6, 
                        6, 
                        7, 
                        6
                    ];
                    $linesId[137] = [
                        6, 
                        6, 
                        6, 
                        6, 
                        7, 
                        7
                    ];
                    $linesId[138] = [
                        6, 
                        6, 
                        7, 
                        6, 
                        6, 
                        5
                    ];
                    $linesId[139] = [
                        6, 
                        6, 
                        7, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[140] = [
                        6, 
                        6, 
                        7, 
                        6, 
                        7, 
                        6
                    ];
                    $linesId[141] = [
                        6, 
                        6, 
                        7, 
                        6, 
                        7, 
                        7
                    ];
                    $linesId[142] = [
                        6, 
                        6, 
                        7, 
                        7, 
                        7, 
                        6
                    ];
                    $linesId[143] = [
                        6, 
                        6, 
                        7, 
                        7, 
                        7, 
                        7
                    ];
                    $linesId[144] = [
                        7, 
                        6, 
                        6, 
                        5, 
                        5, 
                        4
                    ];
                    $linesId[145] = [
                        7, 
                        6, 
                        6, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[146] = [
                        7, 
                        6, 
                        6, 
                        5, 
                        6, 
                        5
                    ];
                    $linesId[147] = [
                        7, 
                        6, 
                        6, 
                        5, 
                        6, 
                        6
                    ];
                    $linesId[148] = [
                        7, 
                        6, 
                        6, 
                        6, 
                        6, 
                        5
                    ];
                    $linesId[149] = [
                        7, 
                        6, 
                        6, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[150] = [
                        7, 
                        6, 
                        6, 
                        6, 
                        7, 
                        6
                    ];
                    $linesId[151] = [
                        7, 
                        6, 
                        6, 
                        6, 
                        7, 
                        7
                    ];
                    $linesId[152] = [
                        7, 
                        6, 
                        7, 
                        6, 
                        6, 
                        5
                    ];
                    $linesId[153] = [
                        7, 
                        6, 
                        7, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[154] = [
                        7, 
                        6, 
                        7, 
                        6, 
                        7, 
                        6
                    ];
                    $linesId[155] = [
                        7, 
                        6, 
                        7, 
                        6, 
                        7, 
                        7
                    ];
                    $linesId[156] = [
                        7, 
                        6, 
                        7, 
                        7, 
                        7, 
                        6
                    ];
                    $linesId[157] = [
                        7, 
                        6, 
                        7, 
                        7, 
                        7, 
                        7
                    ];
                    $linesId[158] = [
                        7, 
                        7, 
                        7, 
                        6, 
                        6, 
                        5
                    ];
                    $linesId[159] = [
                        7, 
                        7, 
                        7, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[160] = [
                        7, 
                        7, 
                        7, 
                        6, 
                        7, 
                        6
                    ];
                    $linesId[161] = [
                        7, 
                        7, 
                        7, 
                        6, 
                        7, 
                        7
                    ];
                    $linesId[162] = [
                        7, 
                        7, 
                        7, 
                        7, 
                        7, 
                        6
                    ];
                    $linesId[163] = [
                        7, 
                        7, 
                        7, 
                        7, 
                        7, 
                        7
                    ];
                }
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['numLines'] = 'L164';
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                {
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] = $slotSettings->GetGameData('SinbadsGoldenVoyagePTMBet');
                    $lines = $slotSettings->GetGameData('SinbadsGoldenVoyagePTMLines');
                }
                else
                {
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['stake'];
                    $_obf_0D1E1D1E330423230F3B1A16370D031D333625295B2F32 = explode('L', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['numLines']);
                    $lines = (int)$_obf_0D1E1D1E330423230F3B1A16370D031D333625295B2F32[1];
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMBet', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet']);
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMLines', $lines);
                }
                $betLine = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'];
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'respin' ) 
                {
                    if( $lines <= 0 || $betLine <= 0.0001 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetBalance() < $betLine ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid balance"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                        exit( $response );
                    }
                }
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                {
                    if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    }
                    $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $slotSettings->UpdateJackpots($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet']);
                    $slotSettings->SetBalance(-1 * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                }
                $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'], $lines);
                $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $lineWins = [];
                    $wild = ['10'];
                    $scatter = '12';
                    $_obf_0D361A3F5C2730270A194003251E380340273105110711 = 1;
                    $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211 = $slotSettings->GetSpinWin($reels, $lines, $betLine, $linesId, $wild, $scatter, $bonusMpl, 'regular');
                    $totalWin = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['totalWin'];
                    $lineWins = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['lineWins'];
                    $scattersWin = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['scattersWin'];
                    $scattersCount = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['scattersCount'];
                    $scattersStr = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['scattersStr'];
                    $_obf_0D1103183E22072D2511390A1B145C25235C2407082111 = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['reels'];
                    if( $i > 1000 ) 
                    {
                        $winType = 'none';
                    }
                    if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] * rand(2, 5)) ) 
                    {
                    }
                    else if( !$slotSettings->increaseRTP && $winType == 'win' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] < $totalWin ) 
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
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMBonusWin', $slotSettings->GetGameData('SinbadsGoldenVoyagePTMBonusWin') + $totalWin);
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMTotalWin', $totalWin);
                }
                else
                {
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMTotalWin', $totalWin);
                }
                if( $scattersCount >= 3 ) 
                {
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMFreeStartWin', $totalWin);
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMBonusWin', 0);
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMFreeGames', $slotSettings->slotFreeCount);
                    $_obf_0D01391D3028051D03133D111201343D09053609320632 = ['{"results":[' . implode(',', $reels['rp']) . '],"reelset":' . $_obf_0D361A3F5C2730270A194003251E380340273105110711 . '}'];
                    $linesId[0] = [
                        1, 
                        2, 
                        1, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[1] = [
                        1, 
                        2, 
                        1, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[2] = [
                        1, 
                        2, 
                        1, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[3] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[4] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[5] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[6] = [
                        1, 
                        2, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[7] = [
                        1, 
                        2, 
                        2, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[8] = [
                        1, 
                        2, 
                        2, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[9] = [
                        1, 
                        2, 
                        2, 
                        3, 
                        3, 
                        4
                    ];
                    $linesId[10] = [
                        2, 
                        2, 
                        1, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[11] = [
                        2, 
                        2, 
                        1, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[12] = [
                        2, 
                        2, 
                        1, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[13] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[14] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[15] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[16] = [
                        2, 
                        2, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[17] = [
                        2, 
                        2, 
                        2, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[18] = [
                        2, 
                        2, 
                        2, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[19] = [
                        2, 
                        2, 
                        2, 
                        3, 
                        3, 
                        4
                    ];
                    $linesId[20] = [
                        2, 
                        3, 
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
                        2, 
                        2
                    ];
                    $linesId[22] = [
                        2, 
                        3, 
                        2, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[23] = [
                        2, 
                        3, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[24] = [
                        2, 
                        3, 
                        2, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[25] = [
                        2, 
                        3, 
                        2, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[26] = [
                        2, 
                        3, 
                        2, 
                        3, 
                        3, 
                        4
                    ];
                    $linesId[27] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[28] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[29] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[30] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        3, 
                        4
                    ];
                    $linesId[31] = [
                        2, 
                        3, 
                        3, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[32] = [
                        2, 
                        3, 
                        3, 
                        4, 
                        3, 
                        4
                    ];
                    $linesId[33] = [
                        2, 
                        3, 
                        3, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[34] = [
                        2, 
                        3, 
                        3, 
                        4, 
                        4, 
                        5
                    ];
                    $linesId[35] = [
                        3, 
                        3, 
                        2, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[36] = [
                        3, 
                        3, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[37] = [
                        3, 
                        3, 
                        2, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[38] = [
                        3, 
                        3, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[39] = [
                        3, 
                        3, 
                        2, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[40] = [
                        3, 
                        3, 
                        2, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[41] = [
                        3, 
                        3, 
                        2, 
                        3, 
                        3, 
                        4
                    ];
                    $linesId[42] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[43] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[44] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[45] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        3, 
                        4
                    ];
                    $linesId[46] = [
                        3, 
                        3, 
                        3, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[47] = [
                        3, 
                        3, 
                        3, 
                        4, 
                        3, 
                        4
                    ];
                    $linesId[48] = [
                        3, 
                        3, 
                        3, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[49] = [
                        3, 
                        3, 
                        3, 
                        4, 
                        4, 
                        5
                    ];
                    $linesId[50] = [
                        3, 
                        4, 
                        3, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[51] = [
                        3, 
                        4, 
                        3, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[52] = [
                        3, 
                        4, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[53] = [
                        3, 
                        4, 
                        3, 
                        3, 
                        3, 
                        4
                    ];
                    $linesId[54] = [
                        3, 
                        4, 
                        3, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[55] = [
                        3, 
                        4, 
                        3, 
                        4, 
                        3, 
                        4
                    ];
                    $linesId[56] = [
                        3, 
                        4, 
                        3, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[57] = [
                        3, 
                        4, 
                        3, 
                        4, 
                        4, 
                        5
                    ];
                    $linesId[58] = [
                        3, 
                        4, 
                        4, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[59] = [
                        3, 
                        4, 
                        4, 
                        4, 
                        3, 
                        4
                    ];
                    $linesId[60] = [
                        3, 
                        4, 
                        4, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[61] = [
                        3, 
                        4, 
                        4, 
                        4, 
                        4, 
                        5
                    ];
                    $linesId[62] = [
                        3, 
                        4, 
                        4, 
                        5, 
                        4, 
                        4
                    ];
                    $linesId[63] = [
                        3, 
                        4, 
                        4, 
                        5, 
                        4, 
                        5
                    ];
                    $linesId[64] = [
                        3, 
                        4, 
                        4, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[65] = [
                        3, 
                        4, 
                        4, 
                        5, 
                        5, 
                        6
                    ];
                    $linesId[66] = [
                        4, 
                        4, 
                        3, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[67] = [
                        4, 
                        4, 
                        3, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[68] = [
                        4, 
                        4, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[69] = [
                        4, 
                        4, 
                        3, 
                        3, 
                        3, 
                        4
                    ];
                    $linesId[70] = [
                        4, 
                        4, 
                        3, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[71] = [
                        4, 
                        4, 
                        3, 
                        4, 
                        3, 
                        4
                    ];
                    $linesId[72] = [
                        4, 
                        4, 
                        3, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[73] = [
                        4, 
                        4, 
                        3, 
                        4, 
                        4, 
                        5
                    ];
                    $linesId[74] = [
                        4, 
                        4, 
                        4, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[75] = [
                        4, 
                        4, 
                        4, 
                        4, 
                        3, 
                        4
                    ];
                    $linesId[76] = [
                        4, 
                        4, 
                        4, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[77] = [
                        4, 
                        4, 
                        4, 
                        4, 
                        4, 
                        5
                    ];
                    $linesId[78] = [
                        4, 
                        4, 
                        4, 
                        5, 
                        4, 
                        4
                    ];
                    $linesId[79] = [
                        4, 
                        4, 
                        4, 
                        5, 
                        4, 
                        5
                    ];
                    $linesId[80] = [
                        4, 
                        4, 
                        4, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[81] = [
                        4, 
                        4, 
                        4, 
                        5, 
                        5, 
                        6
                    ];
                    $linesId[82] = [
                        4, 
                        5, 
                        4, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[83] = [
                        4, 
                        5, 
                        4, 
                        4, 
                        3, 
                        4
                    ];
                    $linesId[84] = [
                        4, 
                        5, 
                        4, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[85] = [
                        4, 
                        5, 
                        4, 
                        4, 
                        4, 
                        5
                    ];
                    $linesId[86] = [
                        4, 
                        5, 
                        4, 
                        5, 
                        4, 
                        4
                    ];
                    $linesId[87] = [
                        4, 
                        5, 
                        4, 
                        5, 
                        4, 
                        5
                    ];
                    $linesId[88] = [
                        4, 
                        5, 
                        4, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[89] = [
                        4, 
                        5, 
                        4, 
                        5, 
                        5, 
                        6
                    ];
                    $linesId[90] = [
                        4, 
                        5, 
                        5, 
                        5, 
                        4, 
                        4
                    ];
                    $linesId[91] = [
                        4, 
                        5, 
                        5, 
                        5, 
                        4, 
                        5
                    ];
                    $linesId[92] = [
                        4, 
                        5, 
                        5, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[93] = [
                        4, 
                        5, 
                        5, 
                        5, 
                        5, 
                        6
                    ];
                    $linesId[94] = [
                        4, 
                        5, 
                        5, 
                        6, 
                        5, 
                        5
                    ];
                    $linesId[95] = [
                        4, 
                        5, 
                        5, 
                        6, 
                        5, 
                        6
                    ];
                    $linesId[96] = [
                        4, 
                        5, 
                        5, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[97] = [
                        4, 
                        5, 
                        5, 
                        6, 
                        6, 
                        7
                    ];
                    $linesId[98] = [
                        5, 
                        5, 
                        4, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[99] = [
                        5, 
                        5, 
                        4, 
                        4, 
                        3, 
                        4
                    ];
                    $linesId[100] = [
                        5, 
                        5, 
                        4, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[101] = [
                        5, 
                        5, 
                        4, 
                        4, 
                        4, 
                        5
                    ];
                    $linesId[102] = [
                        5, 
                        5, 
                        4, 
                        5, 
                        4, 
                        4
                    ];
                    $linesId[103] = [
                        5, 
                        5, 
                        4, 
                        5, 
                        4, 
                        5
                    ];
                    $linesId[104] = [
                        5, 
                        5, 
                        4, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[105] = [
                        5, 
                        5, 
                        4, 
                        5, 
                        5, 
                        6
                    ];
                    $linesId[106] = [
                        5, 
                        5, 
                        5, 
                        5, 
                        4, 
                        4
                    ];
                    $linesId[107] = [
                        5, 
                        5, 
                        5, 
                        5, 
                        4, 
                        5
                    ];
                    $linesId[108] = [
                        5, 
                        5, 
                        5, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[109] = [
                        5, 
                        5, 
                        5, 
                        5, 
                        5, 
                        6
                    ];
                    $linesId[110] = [
                        5, 
                        5, 
                        5, 
                        6, 
                        5, 
                        5
                    ];
                    $linesId[111] = [
                        5, 
                        5, 
                        5, 
                        6, 
                        5, 
                        6
                    ];
                    $linesId[112] = [
                        5, 
                        5, 
                        5, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[113] = [
                        5, 
                        5, 
                        5, 
                        6, 
                        6, 
                        7
                    ];
                    $linesId[114] = [
                        5, 
                        6, 
                        5, 
                        5, 
                        4, 
                        4
                    ];
                    $linesId[115] = [
                        5, 
                        6, 
                        5, 
                        5, 
                        4, 
                        5
                    ];
                    $linesId[116] = [
                        5, 
                        6, 
                        5, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[117] = [
                        5, 
                        6, 
                        5, 
                        5, 
                        5, 
                        6
                    ];
                    $linesId[118] = [
                        5, 
                        6, 
                        5, 
                        6, 
                        5, 
                        5
                    ];
                    $linesId[119] = [
                        5, 
                        6, 
                        5, 
                        6, 
                        5, 
                        6
                    ];
                    $linesId[120] = [
                        5, 
                        6, 
                        5, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[121] = [
                        5, 
                        6, 
                        5, 
                        6, 
                        6, 
                        7
                    ];
                    $linesId[122] = [
                        5, 
                        6, 
                        6, 
                        6, 
                        5, 
                        5
                    ];
                    $linesId[123] = [
                        5, 
                        6, 
                        6, 
                        6, 
                        5, 
                        6
                    ];
                    $linesId[124] = [
                        5, 
                        6, 
                        6, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[125] = [
                        5, 
                        6, 
                        6, 
                        6, 
                        6, 
                        7
                    ];
                    $linesId[126] = [
                        5, 
                        6, 
                        6, 
                        7, 
                        6, 
                        6
                    ];
                    $linesId[127] = [
                        5, 
                        6, 
                        6, 
                        7, 
                        6, 
                        7
                    ];
                    $linesId[128] = [
                        5, 
                        6, 
                        6, 
                        7, 
                        7, 
                        7
                    ];
                    $linesId[129] = [
                        6, 
                        6, 
                        5, 
                        5, 
                        4, 
                        4
                    ];
                    $linesId[130] = [
                        6, 
                        6, 
                        5, 
                        5, 
                        4, 
                        5
                    ];
                    $linesId[131] = [
                        6, 
                        6, 
                        5, 
                        5, 
                        5, 
                        5
                    ];
                    $linesId[132] = [
                        6, 
                        6, 
                        5, 
                        5, 
                        5, 
                        6
                    ];
                    $linesId[133] = [
                        6, 
                        6, 
                        5, 
                        6, 
                        5, 
                        5
                    ];
                    $linesId[134] = [
                        6, 
                        6, 
                        5, 
                        6, 
                        5, 
                        6
                    ];
                    $linesId[135] = [
                        6, 
                        6, 
                        5, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[136] = [
                        6, 
                        6, 
                        5, 
                        6, 
                        6, 
                        7
                    ];
                    $linesId[137] = [
                        6, 
                        6, 
                        6, 
                        6, 
                        5, 
                        5
                    ];
                    $linesId[138] = [
                        6, 
                        6, 
                        6, 
                        6, 
                        5, 
                        6
                    ];
                    $linesId[139] = [
                        6, 
                        6, 
                        6, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[140] = [
                        6, 
                        6, 
                        6, 
                        6, 
                        6, 
                        7
                    ];
                    $linesId[141] = [
                        6, 
                        6, 
                        6, 
                        7, 
                        6, 
                        6
                    ];
                    $linesId[142] = [
                        6, 
                        6, 
                        6, 
                        7, 
                        6, 
                        7
                    ];
                    $linesId[143] = [
                        6, 
                        6, 
                        6, 
                        7, 
                        7, 
                        7
                    ];
                    $linesId[144] = [
                        6, 
                        7, 
                        6, 
                        6, 
                        5, 
                        5
                    ];
                    $linesId[145] = [
                        6, 
                        7, 
                        6, 
                        6, 
                        5, 
                        6
                    ];
                    $linesId[146] = [
                        6, 
                        7, 
                        6, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[147] = [
                        6, 
                        7, 
                        6, 
                        6, 
                        6, 
                        7
                    ];
                    $linesId[148] = [
                        6, 
                        7, 
                        6, 
                        7, 
                        6, 
                        6
                    ];
                    $linesId[149] = [
                        6, 
                        7, 
                        6, 
                        7, 
                        6, 
                        7
                    ];
                    $linesId[150] = [
                        6, 
                        7, 
                        6, 
                        7, 
                        7, 
                        7
                    ];
                    $linesId[151] = [
                        6, 
                        7, 
                        7, 
                        7, 
                        6, 
                        6
                    ];
                    $linesId[152] = [
                        6, 
                        7, 
                        7, 
                        7, 
                        6, 
                        7
                    ];
                    $linesId[153] = [
                        6, 
                        7, 
                        7, 
                        7, 
                        7, 
                        7
                    ];
                    $linesId[154] = [
                        7, 
                        7, 
                        6, 
                        6, 
                        5, 
                        5
                    ];
                    $linesId[155] = [
                        7, 
                        7, 
                        6, 
                        6, 
                        5, 
                        6
                    ];
                    $linesId[156] = [
                        7, 
                        7, 
                        6, 
                        6, 
                        6, 
                        6
                    ];
                    $linesId[157] = [
                        7, 
                        7, 
                        6, 
                        6, 
                        6, 
                        7
                    ];
                    $linesId[158] = [
                        7, 
                        7, 
                        6, 
                        7, 
                        6, 
                        6
                    ];
                    $linesId[159] = [
                        7, 
                        7, 
                        6, 
                        7, 
                        6, 
                        7
                    ];
                    $linesId[160] = [
                        7, 
                        7, 
                        6, 
                        7, 
                        7, 
                        7
                    ];
                    $linesId[161] = [
                        7, 
                        7, 
                        7, 
                        7, 
                        6, 
                        6
                    ];
                    $linesId[162] = [
                        7, 
                        7, 
                        7, 
                        7, 
                        6, 
                        7
                    ];
                    $linesId[163] = [
                        7, 
                        7, 
                        7, 
                        7, 
                        7, 
                        7
                    ];
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        $totalWin = 0;
                        $_obf_0D0135015B3B08180B21253F0A191F1E1040182A0E3E32 = [];
                        $_obf_0D1116233529011F0C293C2D011C113C061E381B341411 = [];
                        $_obf_0D340F06191F0E390E24353B362E0C1007082E111D2701 = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                        $slotSettings->SetGameData('SinbadsGoldenVoyagePTMBonusWin', 0);
                        for( $fp = 0; $fp < 7; $fp++ ) 
                        {
                            $lineWins = [];
                            $wild = [
                                '10', 
                                '333'
                            ];
                            $scatter = '12';
                            $currentWin = 0;
                            $_obf_0D361A3F5C2730270A194003251E380340273105110711 = 34;
                            $reels = $slotSettings->GetReelStrips('', 'freespin');
                            $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211 = $slotSettings->GetSpinWin($reels, $lines, $betLine, $linesId, $wild, $scatter, $bonusMpl, 'freespin');
                            $currentWin = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['totalWin'];
                            $totalWin = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['totalWin'];
                            $lineWins = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['lineWins'];
                            $scattersWin = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['scattersWin'];
                            $scattersStr = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['scattersStr'];
                            $_obf_0D1103183E22072D2511390A1B145C25235C2407082111 = $_obf_0D2E2603172E2216072F1A0936232A2E17313917190211['reels'];
                            $slotSettings->SetGameData('SinbadsGoldenVoyagePTMBonusWin', $slotSettings->GetGameData('SinbadsGoldenVoyagePTMBonusWin') + $currentWin);
                            $_obf_0D0135015B3B08180B21253F0A191F1E1040182A0E3E32[] = '{"results":[' . implode(',', $reels['rp']) . '],"currentWin":' . $currentWin . ',"reelset":' . $_obf_0D361A3F5C2730270A194003251E380340273105110711 . '}';
                            $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                            $_obf_0D1116233529011F0C293C2D011C113C061E381B341411[] = '{"responseEvent":"spin","responseType":"freespin","serverResponse":{"bonusMpl":1,"slotLines":' . $lines . ',"slotBet":' . $betLine . ',"totalFreeGames":7,"currentFreeGames":' . ($fp + 1) . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData('SinbadsGoldenVoyagePTMBonusWin') . ',"freeStartWin":' . $slotSettings->GetGameData('SinbadsGoldenVoyagePTMFreeStartWin') . ',"totalWin":' . $currentWin . ',"winLines":[],"bonusInfo":"","Jackpots":"","reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                        }
                        if( $i > 1000 ) 
                        {
                            $winType = 'none';
                        }
                        if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] * rand(2, 5)) ) 
                        {
                        }
                        else if( !$slotSettings->increaseRTP && $winType == 'win' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] < $totalWin ) 
                        {
                        }
                        else
                        {
                            if( $i > 1500 ) 
                            {
                                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                                exit( $response );
                            }
                            if( $totalWin <= $_obf_0D340F06191F0E390E24353B362E0C1007082E111D2701 ) 
                            {
                                break;
                            }
                        }
                    }
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                    }
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMFreeSpins', $_obf_0D0135015B3B08180B21253F0A191F1E1040182A0E3E32);
                    $slotSettings->SetGameData('SinbadsGoldenVoyagePTMFreeLogs', $_obf_0D1116233529011F0C293C2D011C113C061E381B341411);
                }
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                if( $scattersCount >= 3 ) 
                {
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"wCapMaxWin":1000000.0,"ww":"' . $scattersCount . '","spins":[' . implode(',', $_obf_0D01391D3028051D03133D111201343D09053609320632) . ',' . implode(',', $_obf_0D0135015B3B08180B21253F0A191F1E1040182A0E3E32) . ']},"ID":46585,"umid":32}';
                }
                else
                {
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"wCapMaxWin":1000000.0,"spins":[{"results":[' . implode(',', $reels['rp']) . '],"reelset":' . $_obf_0D361A3F5C2730270A194003251E380340273105110711 . '}]},"ID":46585,"umid":32}';
                }
                $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                $_obf_0D402A260403223E3B3D1B232E0D21381E010A31040B32 = '' . json_encode($_obf_0D1103183E22072D2511390A1B145C25235C2407082111) . '';
                $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"slotLines":' . $lines . ',"slotBet":' . $betLine . ',"totalFreeGames":' . $slotSettings->GetGameData('SinbadsGoldenVoyagePTMFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('SinbadsGoldenVoyagePTMCurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData('SinbadsGoldenVoyagePTMBonusWin') . ',"freeStartWin":' . $slotSettings->GetGameData('SinbadsGoldenVoyagePTMFreeStartWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"bonusInfo":' . $scattersStr . ',"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols2":' . $_obf_0D402A260403223E3B3D1B232E0D21381E010A31040B32 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                $slotSettings->SaveLogReport($response, $betLine, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
            }
            switch( $umid ) 
            {
                case '31031':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"urlList":[{"urlType":"mobile_login","url":"https://login.loc/register","priority":1},{"urlType":"mobile_support","url":"https://ww2.loc/support","priority":1},{"urlType":"playerprofile","url":"","priority":1},{"urlType":"playerprofile","url":"","priority":10},{"urlType":"gambling_commission","url":"","priority":1},{"urlType":"cashier","url":"","priority":1},{"urlType":"cashier","url":"","priority":1}]},"ID":100}';
                    break;
                case '10001':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40083,"umid":3}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40083,"umid":4}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":13218,"params":["0","null"]},"ID":50001,"umid":5}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"token":{"secretKey":"","currency":"USD","balance":0,"loginTime":""},"ID":10002,"umid":7}';
                    break;
                case '40294':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"nicknameInfo":{"nickname":""},"ID":10022,"umid":8}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":10713,"params":["0","ba","bj","ct","gc","grel","hb","po","ro","sc","tr"]},"ID":50001,"umid":9}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":11666,"params":["0","0","0"]},"ID":50001,"umid":11}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":13981,"params":["0","1"]},"ID":50001,"umid":12}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":14080,"params":["0","0"]},"ID":50001,"umid":14}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"keyValueCount":5,"elementsPerKey":1,"params":["10","1","11","500","12","1","13","0","14","0"]},"ID":40716,"umid":15}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40083,"umid":16}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"balanceInfo":{"clientType":"casino","totalBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"currency":"' . $slotSettings->slotCurrency . '","balanceChange":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"ID":10006,"umid":17}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{},"ID":40292,"umid":18}';
                    break;
                case '10010':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"urls":{"casino-cashier-myaccount":[],"regulation_pt_self_exclusion":[],"link_legal_aams":[],"regulation_pt_player_protection":[],"mobile_cashier":[],"mobile_bank":[],"mobile_bonus_terms":[],"mobile_help":[],"link_responsible":[],"cashier":[{"url":"","priority":1},{"url":"","priority":1}],"gambling_commission":[{"url":"","priority":1},{"url":"","priority":1}],"desktop_help":[],"chat_token":[],"mobile_login_error":[],"mobile_error":[],"mobile_login":[{"url":"","priority":1}],"playerprofile":[{"url":"","priority":1},{"url":"","priority":10}],"link_legal_half":[],"ngmdesktop_quick_deposit":[],"external_login_form":[],"mobile_main_promotions":[],"mobile_lobby":[],"mobile_promotion":[],{"url":"","priority":1},{"url":"","priority":10}],"mobile_withdraw":[],"mobile_funds_trans":[],"mobile_quick_deposit":[],"mobile_history":[],"mobile_deposit_limit":[],"minigames_help":[],"link_legal_18":[],"mobile_responsible":[],"mobile_share":[],"mobile_lobby_error":[],"mobile_mobile_comp_points":[],"mobile_support":[{"url":"","priority":1}],"mobile_chat":[],"mobile_logout":[],"mobile_deposit":[],"invite_friend":[]}},"ID":10011,"umid":19}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"brokenGames":[],"windowId":"SuJLru"},"ID":40037,"umid":20}';
                    break;
                case '46090':
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'brokenGames') != '' ) 
                    {
                        $_obf_0D2410310726250E1A3F025B0F2101383038135B043C01 = $slotSettings->GetGameData('SinbadsGoldenVoyagePTMFreeSpins');
                        $_obf_0D2813390912262B102326025B34051621182F31041832 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01 = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $_obf_0D303634383230231C050E3833012A0A2B35180B121401 = [];
                        $_obf_0D2D37385C030C0839260F1F5B183018081B3D091A2422 = 2;
                        for( $i = 0; $i <= 6; $i++ ) 
                        {
                            $vl = json_decode($_obf_0D2410310726250E1A3F025B0F2101383038135B043C01[$i], true);
                            $reelset = $vl['reelset'];
                            $_obf_0D303634383230231C050E3833012A0A2B35180B121401[] = '{"drawId":' . $_obf_0D2D37385C030C0839260F1F5B183018081B3D091A2422 . ',"winLines":{"winlines":[],"feature":{"name":"leviathan","type":"display","detail":{"name":"anticipation","nextReel":1,"reelset":' . $reelset . ',"rsName":"FS11"}},"display":"W,W,W,W,W,W,W;R,R,R,R,D,D;Y,Y,O,O,O,O,O;R,D,D,D,D,O;D,D,D,R,R,R,Y;D,Y,Y,O,O,D","reelset":' . $reelset . ',"rsName":"FS8","runningTotal":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeStartWin') . ',"spinWin":' . $vl['currentWin'] . ',"currentSpins":7,"spins":7,"stops":"' . implode(',', $vl['results']) . '"},"replayInfo":{"foItems":"8,' . implode(',', $vl['results']) . '"}}';
                            $_obf_0D2D37385C030C0839260F1F5B183018081B3D091A2422++;
                        }
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"gameId":2656672142,"version":"C-210416#1638:X-091014#101925","drawStates":[{"drawId":0,"state":"settling","wCapMaxWin":1000000,"winLines":{"winlines":[],"feature":{"name":"leviathan","type":"display","detail":{"name":"anticipation","nextReel":3,"reelset":40,"rsName":"FS10"}},"scatter":{"length":3,"offsets":"7,22,36","payout":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $slotSettings->GetGameData($slotSettings->slotId . 'FreeStartWin')) . ',"prize":"3F","spins":7},"display":"Y,Y,O,O,D,D;H,F,F,E,E,E,P;H,P,P,P,P,E;Y,Y,Y,F,F,H,H;S,S,S,S,S,S;H,H,H,H,F,F,E","reelset":0,"rsName":"MainReel0","runningTotal":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeStartWin') . ',"spinWin":0,"currentSpins":7,"spins":7,"stops":"8,25,31,69,84,56"},"replayInfo":{"foItems":"0,8,25,31,69,84,56"},"bet":{"payout":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $slotSettings->GetGameData($slotSettings->slotId . 'FreeStartWin')) . ',"pick":"L164","seq":0,"stake":' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet') . ',"type":"line","won":"true"}},' . implode(',', $_obf_0D303634383230231C050E3833012A0A2B35180B121401) . '],"savedStates":[{"attr21":"' . $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01 . '","seq":0}]},"ID":46580,"umid":25}';
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"gameId":2662623726,"version":"C-210416#1638:X-091014#101925","drawStates":[{"drawId":0}]},"ID":46580,"umid":27}';
                    }
                    break;
                case '40066':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    for( $i = 0; $i < count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] * 100;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"funNoticeGames":0,"funNoticePayouts":0,"gameGroup":"gtsswk","minBet":0,"maxBet":0,"minPosBet":0,"maxPosBet":50000,"coinSizes":[' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . ']},"ID":40025,"umid":21}';
                    break;
                case '40036':
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData($slotSettings->slotId . 'brokenGames', '');
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $lastEvent->serverResponse->freeStartWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->slotLines);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $lastEvent->serverResponse->slotBet);
                        if( isset($lastEvent->serverResponse->freeSeq) ) 
                        {
                            $slotSettings->SetGameData('SinbadsGoldenVoyagePTMFreeSpins', $lastEvent->serverResponse->freeSeq);
                            $slotSettings->SetGameData('SinbadsGoldenVoyagePTMFreeLogs', $lastEvent->serverResponse->freeLogSeq);
                            $slotSettings->SetGameData('SinbadsGoldenVoyagePTMbonusMpl', $lastEvent->serverResponse->bonusMpl);
                        }
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'brokenGames', 'gtsswk');
                        }
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"brokenGames":["' . $slotSettings->GetGameData($slotSettings->slotId . 'brokenGames') . '"],"windowId":"SuJLru"},"ID":40037,"umid":22}';
                    break;
                case '40020':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":1,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"windowId":"SuJLru"},"ID":40026,"umid":28}';
                    break;
                case '40030':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":1,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"windowId":"SuJLru"},"ID":40026,"umid":28}';
                    break;
                case '48300':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"balanceInfo":{"clientType":"casino","totalBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"currency":"' . $slotSettings->slotCurrency . '","balanceChange":0},"ID":10006,"umid":30}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"waitingLogins":[],"waitingAlerts":[],"waitingDialogs":[],"waitingDialogMessages":[],"waitingToasterMessages":[]},"ID":48301,"umid":31}';
                    break;
            }
            $response = implode('------', $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01);
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
