<?php

use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberUtil;

require '../vendor/autoload.php';
require '../Model/settings.php';
require_once '../Controller/registrationController.php';


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



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <?php require_once 'style.php'; ?>

    <title>Sign up</title>
</head>

<body>

    <div class="data" id="data" style="display: none;">
        <p id="clientIP"><?= $clientIP ?></p>
        <p id="bg_img"><?= end($img) ?></p>
        <p id="FirstButton"><?= $data['FirstButton']; ?></p>
        <p id="SecondButtonColor"><?= $data['SecondButtonColor']; ?></p>
        <p id="SecondButton"><?= $data['SecondButton']; ?></p>
        <p id="userPhonePrefix"><?= "+" . $userPhonePrefix ?> </p>
        <p id="FirstButtonColor"><?= $data['FirstButtonColor']; ?></p>

        <p id="FormTitle"><?= $data['FormTitle']; ?></p>
        <p id="FormTitleColor"><?= $data['FormTitleColor']; ?></p>
        <p id="FirstInputBoxPlaceholder"><?= $data['FirstInputBoxPlaceholder']; ?></p>
        <p id="SecondInputBoxPlaceholder"><?= $data['SecondInputBoxPlaceholder']; ?></p>
        <p id="ThirdInputBoxPlaceholder"><?= $data['ThirdInputBoxPlaceholder']; ?></p>
        <p id="FourthInputboxplaceholder"><?= $data['FourthInputboxplaceholder']; ?></p>
        <p id="FifthInpurBoxPlaceholder"><?= $data['FifthInpurBoxPlaceholder']; ?></p>
        <p id="checkBoxText"><?= $data['checkBoxText']; ?></p>
        <p id="checkBoxTextColor"><?= $data['checkBoxTextColor']; ?></p>
        <p id="SecondButtonTextColor"><?= $data['SecondButtonTextColor']; ?></p>
        <p id="FirstButtonTextColor"><?= $data['FirstButtonTextColor']; ?></p>

    </div>



    <div class="wrapper" id="form__wrapper">

    </div>







    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="index.js"></script>

</body>

</html