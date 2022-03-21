<?php


$first_name_error =   $last_name_error =  $email_error =  $password_error =  $phone_prefix_erorr =  $phone_number_error = $checkbox_error = null;


if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone_prefix = $_POST['phone_prefix'];
    $phone_number = $_POST['phone_number'];
    if (isset($_POST['checkbox'])) {
        $checkbox = 'true';
    } else {
        $checkbox = 'false';
    }

    if ($first_name == "") {
        $first_name_error = "*First Name Require";
    } elseif ($last_name == "") {
        $last_name_error = "*Last Name Require";
    } elseif ($email == "") {
        $email_error = "*Email Require";
    } elseif ($password == "") {
        $password_error = "*Password Require";
    } elseif ($phone_prefix == "") {
        $phone_prefix_erorr = "*Phone Prefix Require";
    } elseif ($phone_number == "") {
        $phone_number_error = "*Phone Number Require";
    } elseif ($checkbox == "false") {
        $checkbox_error = "*Checkbox Checked Require";
    } else {
        echo "test pass";
    }
}
