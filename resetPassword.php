<?php

require "connection.php";

$e = $_POST["e"];
$np = $_POST["np"];
$rnp = $_POST["rnp"];
$vc = $_POST["vc"];

if (empty($e)) {
    echo "Missing email address";
} elseif (empty($np)) {
    echo "Please enter your new password";
} elseif (strlen($np) < 5 || strlen($np) > 20) {
    echo "Password length must between 5 to 20";
} elseif (empty($rnp)) {
    echo "Please Re-typepassword";
} elseif ($np != $rnp) {
    echo "Password do not match";
} elseif (empty($vc)) {
    echo "Please enter your verification code";
} else {

    $rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $e . "' AND `verification_code`='" . $vc . "'");

    if ($rs->num_rows == 1) {
        Database::iud("UPDATE `users` SET `password`='" . $np . "' WHERE `email`='" . $e . "'");
        echo "Success";
    } else {
        echo "Password Reset Fail";
    }
}
