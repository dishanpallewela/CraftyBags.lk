<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {


    $id = $_GET["id"];
    $qtytxt = $_GET["txt"];
    $uemail = $_SESSION["u"]["email"];


    if ($qtytxt <= 0) {
        echo "Please add a quantity";
    } else {

        $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '" . $uemail . "' AND `product_id` = '" . $id . "' ");
        $cn = $cartrs->num_rows;

        if ($cn == 1) {
            echo "This product is alread exists in your Cart";
        } else {

            $productrs =  Database::search("SELECT `qty` FROM `product` WHERE `id` = '" . $id . "' ");
            $pr = $productrs->fetch_assoc();

            if ($qtytxt <= $pr["qty"]) {
                Database::iud("INSERT INTO `cart` (`product_id`,`user_id`,`qty`) values ('" . $id . "','" . $uemail . "','" . $qtytxt . "');");
                echo "success";
            } else {
                echo "Please enter a valid quantity below ".$pr["qty"]." ";
            }
        }
    }
}
