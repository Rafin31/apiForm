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



    <div class="form__great__wrapper" style="background-image: url('../Assets/images/<?= end($img) ?>');">

        <div class="container">
            <h3 class=" text-center mb-5">Open Your Account</h3>
            <div class="row justify-content-center ">

                <div class="col-12 col-lg-7 col-md-7 ">

                    <div class="form__wrapper">
                        <form method="post" action="#">
                            <div class="form-row">
                                <div class="form-group col-md-6">

                                    <input type="text" class="form-control" name="first_name" id="inputEmail4" placeholder="First Name">
                                    <span style="color: red; font-weight: 600;" class="mt-2"><?= $first_name_error  ?></span>
                                </div>
                                <div class="form-group col-md-6">

                                    <input type="text" class="form-control" name="last_name" id="inputPassword4" placeholder="Last Name">
                                    <span style="color: red; font-weight: 600;" class="mt-2"><?= $last_name_error  ?></span>
                                </div>
                            </div>
                            <div class="form-group">

                                <input type="email" name="email" class="form-control" id="inputAddress" placeholder="Email">
                                <span style="color: red; font-weight: 600;" class="mt-2"><?= $email_error  ?></span>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">

                                    <input type="text" class="form-control" name="password" id="password" placeholder="Password">
                                    <span style="color: red; font-weight: 600;" class="mt-2"><?= $password_error  ?></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <button class="button_custom first_button" style="background-color:<?= $data['FirstButtonColor']; ?> ;" id="generate_password">
                                        <?= $data['FirstButton']; ?></button>
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control" name="phone_prefix" id="phone_prefix" value=<?= "+" . $userPhonePrefix ?> readonly="readonly">
                                </div>

                                <div class="form-group col-md-10">
                                    <input type="number" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number">
                                    <span style="color: red; font-weight: 600;" class="mt-2"><?= $phone_number_error  ?></span>
                                </div>


                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" name="checkbox" type="checkbox" id="radio_button">

                                    I am over 18 years of age and I accept this Legal trams and Conditions
                                    </label>
                                    <br>
                                    <span style="color: red; font-weight: 600;" class="mt-2"><?= $checkbox_error  ?></span>
                                </div>
                            </div>
                            <button type="submit" name="submit" style="background-color:<?= $data['SecondButtonColor']; ?> ;" class="button_custom second_button"> <?= $data['SecondButton']; ?></button>
                        </form>

                    </div>



                </div>
            </div>


        </div>

    </div>







    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="index.js"></script>

</body>

</html