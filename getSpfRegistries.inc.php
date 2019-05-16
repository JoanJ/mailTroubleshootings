<?php

//spf functions

function GetSpf($entrada,$added) {

    $spfRecords = array();
    $ResultArrayspf = dns_get_record($entrada, DNS_TXT);
    if(!$ResultArrayspf){return false;}

    //iterate in DNS TXT query looking for v=spf1 entry
    foreach ($ResultArrayspf as $record) {
        if ($record['type'] == 'TXT') {
            $txt = strtolower($record['txt']);
            // An SPF record can be empty (no mechanism)
            if ($txt == 'v=spf1' || stripos($txt, 'v=spf1 ') === 0) {
                $spfRecords[] = $txt;
                $entryNoL = $spfRecords[0];
                $isEntry = strpos($txt, 'launchmetrics');
                }
            }
        }
        //check if launchemtrics entry is in 
        if ($isEntry !== false || $added == false ){print_r($spfRecords[0]);}
        else{
            print_r($spfRecords[0]);
            print "<p></p>";
            echo " Creem SPF :  ";
            print_r(spfString($entryNoL));}
    

}

function spfString($stringSpf){
    
    $spfentryL = " include:_shortspf.launchmetrics.com ";
    //afegim entrada spf de launchmetrics
    $llargada = strlen($stringSpf);
    $llargada = $llargada - 4;
    $finalSpf = substr_replace($stringSpf, $spfentryL, $llargada, 0);
    return $finalSpf;
}

// $domainExts = ["com", "net", "org", "io"]; // fill according to your needs

// $regex = "/:([\w]*?)\\.?([\w]*?)\\.(".implode("|", $domainExts).")/";

// preg_match_all($regex, $spfreccord2, $output);
// // $output[1] => Subdomains.
// // $output[2] => Domains
// // $output[3] => Domain extension

// var_dump($output);
// /*
?>
