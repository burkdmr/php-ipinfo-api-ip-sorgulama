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
