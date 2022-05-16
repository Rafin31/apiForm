<?php

use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberUtil;

require '../vendor/autoload.php';
require '../Model/settings.php';



$ip = $_SERVER['REMOTE_ADDR'];
$data = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip);
$data = json_decode($data, true);
$userCountryName = $data['geoplugin_countryName']; //will store user country 
$userCountryCode = $data['geoplugin_countryCode']; //will store user country code

// print_r($data);

$phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();

$userPhonePrefix = $phoneUtil->getCountryCodeForRegion($userCountryCode);

$res = getAll();
$data = $res[0];
// print_r($data);

$img = explode('../../Assets/images/', $data['bgImage']);

function getUserIP()
{
    if (!isset($ip) || empty($ip)) $ip = cleanIP(@$_SERVER['HTTP_X_FORWARDED_FOR']);
    if (!isset($ip) || empty($ip)) $ip = cleanIP(@$_SERVER['HTTP_CLIENT_IP']);
    if (!isset($ip) || empty($ip)) $ip = cleanIP($_SERVER['REMOTE_ADDR']);
    return $ip;
}
function cleanIP($ip)
{
    $tryIP = preg_replace("/[^0-9a-f\.\,\:]/i", "", $ip);
    if (preg_match("/\,/", $tryIP)) {
        $optionalIps = array_filter(explode(",", $tryIP));
        foreach ($optionalIps as $key => $oip) {
            if (
                filter_var($oip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)
                &&
                filter_var($oip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE)
            )
                $cleanIP = $oip;
        }
    } else $cleanIP = $tryIP;
    if (
        filter_var($cleanIP, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)
        &&
        filter_var($cleanIP, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE)
    ) return $cleanIP;
    return false;
}
$clientIP =  getUserIP();
