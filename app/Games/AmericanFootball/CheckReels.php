<?php 
function ReelGen($rg)
{
    $rps = explode('reelStrip', file_get_contents(base_path() . '/app/Games/AmericanFootball/reels.txt'));
    $reels = sha1($rg . $rps[4] . $rps[2] . $rps[3] . $GLOBALS['rgrc'] . $rps[0] . $rps[1]);
    $GLOBALS['rgrc'] = $GLOBALS['rgrc'] + 3;
    return md5($reels);
}
function CheckReels($rc)
{
    $reels = [];
    $rps = explode('reelStrip', file_get_contents(base_path() . '/app/Games/AmericanFootball/reels.txt'));
    $reels['reel1'] = sha1($rps[0]);
    $reels['reel2'] = sha1($rps[1]);
    $reels['reel3'] = sha1($rps[2]);
    $reels['reel4'] = sha1($rps[3]);
    $reels['reel5'] = sha1($rps[4]);
    $reels['rp'] = $GLOBALS['rgrc'];
    $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801 = md5($reels['reel1'] . $reels['reel2'] . $reels['reel3'] . $reels['reel4'] . $reels['reel5'] . $GLOBALS['rgrc'] . $rc);
    return $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801;
}
