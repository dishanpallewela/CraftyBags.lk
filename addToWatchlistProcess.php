<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $uemail = $_SESSION["u"]["email"];
    $id = $_GET["id"];

    $watchlist = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '" . $id . "' AND `users_email` = '" . $uemail . "' ");
    $n = $watchlist->num_rows;

    if ($n == 1) {

        echo "You have recently adedd this product to the Watchlist";

        // $watchrs = Database::search("SELECT * FROM `watchlist` WHERE `id`= '" . $id . "' ");
        // $watchrow = $watchrs->fetch_assoc();

        // $pid = $watchrow["product_id"];
        // $mail = $watchrow["users_email"];

        // Database::iud("INSERT INTO `recent` (`product_id`,`users_email`) VALUES ('" . $pid . "','" . $mail . "') ");

        // Database::iud("DELETE FROM `watchlist` WHERE `id` = '" . $id . "' ");


    } else {
        Database::iud("INSERT INTO `watchlist` (`product_id`,`users_email`) VALUES ('" . $id . "','" . $uemail . "'); ");

        echo "Success";
    }
}
