<?php
session_start();
require "connection.php";

if ($_GET["email"] == $_SESSION["u"]["email"]) {
    $array1;
    $array2;
    $email = $_GET["email"];

    $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '" . $email . "' ");
    $rows = $cartrs->num_rows;


    for ($i = 1; $i < $rows + 1; $i++) {

        $c = $cartrs->fetch_assoc();

        $q = $c["qty"];
        $array1[$i] = $q;

        $pid = $c["product_id"];
        $array2[$i] = $pid;
    }
    echo json_encode($array1);
    echo json_encode($array2);

} else {
    echo "no";
}
