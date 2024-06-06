<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
   
    $umail = $_SESSION["u"]["email"];
    $id = $_POST["i"];
    $feedtxt = $_POST["ft"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:I:s");

    Database::iud("INSERT INTO `feedback` (`user_email`,`product_id`,`feed`,`date`) 
    VALUES ('".$umail."','".$id."','".$feedtxt."','".$date."') ");

   echo "success";

}




?>