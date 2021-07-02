<?php 
function ReelGen($rg)
{
    $_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11 = explode('reelStrip', file_get_contents(base_path() . '/app/Games/AgeOfTheGodsGodOfStormsPT/reels.txt'));
    $reels = sha1($rg . $_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[4] . $_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[2] . $_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[3] . $GLOBALS['rgrc'] . $_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[0] . $_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[1]);
    $GLOBALS['rgrc'] = $GLOBALS['rgrc'] + 3;
    return md5($reels);
}
function CheckReels($rc)
{
    $reels = [];
    $_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11 = explode('reelStrip', file_get_contents(base_path() . '/app/Games/AgeOfTheGodsGodOfStormsPT/reels.txt'));
    $reels['reel1'] = sha1($_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[0]);
    $reels['reel2'] = sha1($_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[1]);
    $reels['reel3'] = sha1($_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[2]);
    $reels['reel4'] = sha1($_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[3]);
    $reels['reel5'] = sha1($_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[4]);
    $reels['rp'] = $GLOBALS['rgrc'];
    $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801 = md5($reels['reel1'] . $reels['reel2'] . $reels['reel3'] . $reels['reel4'] . $reels['reel5'] . $GLOBALS['rgrc'] . $rc);
    return $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801;
}
