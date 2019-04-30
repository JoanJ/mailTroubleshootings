<?php
//main functions

function GetDmarc($entrada){
    
    $dmarcRecords = array();
    $dom = '_dmarc.'.$entrada;
    $ResultArraydmarc = dns_get_record($dom, DNS_TXT);
    if(!$ResultArraydmarc){return false;}

        foreach ($ResultArraydmarc as $recd) {
            if ($recd['type'] == 'TXT') {
                $txtd = strtolower($recd['txt']);
                // An SPF record can be empty (no mechanism)
                if ($txtd == 'v=dmarc1' || stripos($txtd, 'v=dmarc1') === 0) {
                    $dmarcRecords[] = $txtd;
                    }
                }
            }

        print_r($dmarcRecords[0]);
}

function GetDkim($entrada){
    
    $dkimRecords = array();
    $domk = 'launchmetrics._domainkey.'.$entrada;
    $ResultArraydkim = dns_get_record($domk, DNS_TXT);
    if(!$ResultArraydkim){return false;}

        foreach ($ResultArraydkim as $recdk) {
            if ($recdk['type'] == 'TXT') {
                $txtdk = strtolower($recdk['txt']);
                // An SPF record can be empty (no mechanism)
                if ($txtdk == 'k=rsa' || stripos($txtdk, 'k=rsa') === 0){
                    $dkimRecords[] = $txtdk;
                    } elseif ($txtdk == 'v=dkim1' || stripos($txtdk, 'v=dkim1') === 0){
                    $dkimRecords[] = $txtdk;
                    }
                }
            }

        print_r($dkimRecords[0]);

}

?>
