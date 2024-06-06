<?php

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];

require "connection.php";

if (empty($fname)) {
    echo "Please enter your first name";
} elseif (strlen($fname) > 50) {
    echo "First name must be less than 50 characters";
} elseif (empty($lname)) {
    echo "Please enter your last name";
} elseif (strlen($lname) > 50) {
    echo "Last name must be less than 50 characters";
} elseif (empty($email)) {
    echo "Please enter your email";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address";
} elseif (strlen($email) > 100) {
    echo "Email name must be less than 100 characters";
} elseif (empty($password)) {
    echo "Please enter your password";
} elseif (strlen($password) < 5 || strlen($password) > 20) {
    echo "Password length must between 5 to 20";
} elseif (empty($mobile)) {
    echo "Please enter your mobile";
} elseif (strlen($mobile) != 10) {
    echo "Please enter 10 digit mobile number";
} elseif (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile) == 0) {
    echo "Invalid mobile number";
} else {

    $r = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "' OR `mobile` = '".$mobile."';");
    if ($r->num_rows > 0) {
        echo "User with the same email address or mobile already exsist";
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:I:s");

        Database::iud("INSERT INTO users (`email`,`fname`,`lname`,`password`,`mobile`,`register_date`,`gender`,`status`)VALUES('" . $email . "','" . $fname . "','" . $lname . "','" . $password . "','" . $mobile . "','" . $date . "','" . $gender . "','1');");
        echo "Success";

    }
}
