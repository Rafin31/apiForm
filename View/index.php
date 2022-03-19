<?php
require '../vendor/autoload.php';

$ip = $_SERVER['REMOTE_ADDR'];
$data = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip);
$data = json_decode($data, true);
$userCountryName = $data['geoplugin_countryName']; //will store user country 
$userCountryCode = $data['geoplugin_countryCode']; //will store user country code

// print_r($data);

$phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
$regions = $phoneUtil->getSupportedRegions();

$userPhonePrefix = $phoneUtil->getCountryCodeForRegion($userCountryCode);



// echo $userPhonePrefix;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="index.css">

    <title>Sign up</title>
</head>

<body>



    <div class="form__great__wrapper">

        <div class="container">
            <h3 class=" text-center mb-5">Open Your Account</h3>
            <div class="row justify-content-center ">

                <div class="col-12 col-lg-7 col-md-7 ">

                    <div class="form__wrapper">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">

                                    <input type="text" class="form-control" name="first_name" id="inputEmail4" placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">

                                    <input type="text" class="form-control" name="last_name" id="inputPassword4" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group">

                                <input type="email" name="email" class="form-control" id="inputAddress" placeholder="Email">
                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control" name="password" id="inputAddress2" placeholder="Password">
                            </div>
                            <div class="form-group">

                                <input type="text" class="form-control" name="confirm_password" id="inputAddress2" placeholder="Confirm Your Password">
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control" name="phone_prefix" id="phone_prefix" value=<?= "+" . $userPhonePrefix ?> disabled>
                                </div>

                                <div class="form-group col-md-10">
                                    <input type="number" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number">
                                </div>


                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="radio_button">

                                    I am over 18 years of age and I accept this Legal trams and Conditions
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="sign__up__button">Sign Up</button>
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