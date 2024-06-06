<?php

session_start();
require "connection.php";

$invoiceId = $_GET["id"];
// echo $invoiceId;

$nrs = Database::search("SELECT * FROM `neworder`");
$nr = $nrs->fetch_assoc();

if ($nr["orderstatus_id"]==1) {
    echo "already";
} else {
    Database::iud("UPDATE `neworder` SET `orderstatus_id` = '1' WHERE `invoice_id` = '".$invoiceId."' ");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:I:s");

    Database::iud("INSERT INTO `completed_orders`(`completed_date`,`invoice_id`) VALUES('".$date."','".$invoiceId."')");

    echo "success";
}


?>