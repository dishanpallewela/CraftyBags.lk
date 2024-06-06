<?php

session_start();

require "connection.php";

$e = $_POST["email"];
$p = $_POST["password"];
$r = $_POST["remember"];

$rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $e . "' AND  `password`='" . $p . "' AND `status` = '1';");
$n = $rs->num_rows;

if ($n == 1) {  // Sign in success
    echo "Success";
    $d = $rs->fetch_assoc();
    $_SESSION["u"] = $d;

    if ($r=="true") {  // remember me true
        setcookie("e",$e,time()+(60*60*24*365));
        setcookie("p",$p,time()+(60*60*24*365));
    }else{ // remember me false
        setcookie("e","",-1);
        setcookie("p","",-1);
    }

} else {
    echo "Invalid Details";
}
