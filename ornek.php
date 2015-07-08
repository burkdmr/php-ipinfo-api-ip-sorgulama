<?php

function ipAdresiAl($ip = null){

    if($ip == null){
        if(getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
            if (strstr($ip, ',')) {
                $tmp = explode (',', $ip);
                $ip = trim($tmp[0]);
            }
        } else {
            $ip = getenv("REMOTE_ADDR");
        }
    }

    $json = file_get_contents("http://ipinfo.io/{$ip}");
    $detaylar = json_decode($json);
    return $detaylar;
}

$ip = ipAdresiAl('8.8.8.8');

echo '
    <strong>Ip Adresi :</strong> '. $ip->ip . '<br/>
    <strong>Hostname :</strong> '. $ip->hostname . '<br/>
    <strong>City :</strong> '. $ip->city . '<br/>
    <strong>Region :</strong> '. $ip->region . '<br/>
    <strong>Country :</strong> '. $ip->country . '<br/>
    <strong>Location :</strong> '. $ip->loc . '<br/>
    <strong>Organization :</strong> '. $ip->org . '<br/>
    <strong>Postal :</strong> '. $ip->postal . '<br/>
';


?>