<?php

session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

    $user = $_SESSION["a"];

    $id = $_POST["id"];

    $title = $_POST["title"];
    $qty = (int)$_POST["qty"];
    $dwc = (int)$_POST["dwc"];
    $doc = (int)$_POST["doc"];
    $description = $_POST["description"];

    if (empty($title)) {
        echo "Please add a title";
    } elseif (strlen($title) > 100) {
        echo "Title must contain 100 or less than 100 characters";
    } elseif ($qty == "0" || $qty == "e") {
        echo "Please add the quantity of your product";
    } elseif (!is_int($qty)) { //is_numeric To identify numbr or a numaric string
        echo "Please add a valid quantity";
    } elseif (empty($qty)) {
        echo "Please add the quantity of your product";
    } elseif ($qty < 0) {
        echo "Please add a valid quantity";
    } elseif (empty($dwc)) {
        echo "Please add the delevery cost";
    } elseif (!is_int($dwc)) {
        echo "Please insert a valid price";
    } elseif (empty($doc)) {
        echo "Please add the delevery cost";
    } elseif (!is_int($doc)) {
        echo "Please insert a valid price";
    } elseif (empty($description)) {
        echo "Please enter the description of your product";
    } else {

        $rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $id . "' AND `user_email` = '" . $user["email"] . "' ");
        $n = $rs->num_rows;

        if ($n == 1) {
            Database::iud("UPDATE `product` SET `title`='" . $title . "',`qty`='" . $qty . "',
        `delivery_fee_colombo`='" . $dwc . "',`delivery_fee_other`='" . $doc . "',`description`='" . $description . "' 
        WHERE `id`= '" . $id . "' AND `user_email`='" . $user["email"] . "' ");

            echo "success";
        } else {
            echo "Error";
        }
    }
}
