<?php
require "connection.php";

session_start();

if(isset($_SESSION["u"])){

$oid = $_POST["oid"];

$cartrs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '" . $_SESSION["u"]["email"] . "';");
$cnum = $cartrs->num_rows;

for ($c = 0; $c < $cnum; $c++) {
    $cfetch = $cartrs->fetch_assoc();

    $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $cfetch["product_id"] . "'");
    $pn = $productrs->fetch_assoc();
    
    $qty = $pn["qty"];
    $price = $pn["price"];
    $newqty = $qty - $cfetch["qty"];

    Database::iud("UPDATE `product` SET `qty`='" . $newqty . "' WHERE `id` = '" . $cfetch["product_id"] . "'");

    $total = $price * $cfetch["qty"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice`(`order_id`,`product_id`,`users_email`,`date`,`total`,`qty`) VALUES
        ('" . $oid . "','" . $cfetch["product_id"] . "','" .  $_SESSION["u"]["email"] . "','" . $date . "','" .$total. "','" . $cfetch["qty"] . "')");

    Database::iud("DELETE FROM `cart` WHERE `user_id` = '" . $_SESSION["u"]["email"] . "'");

}

    echo "1";

}else{
    echo "Error";
}
