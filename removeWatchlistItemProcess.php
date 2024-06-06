<?php

require "connection.php";

$id = $_GET["id"];

$watchrs = Database::search("SELECT * FROM `watchlist` WHERE `id`= '" . $id . "' ");
$watchrow = $watchrs->fetch_assoc();

$pid = $watchrow["product_id"];
$mail = $watchrow["users_email"];

Database::iud("INSERT INTO `recent` (`product_id`,`users_email`) VALUES ('".$pid."','".$mail."') ");

// echo "Product Added To The Recent";

Database::iud("DELETE FROM `watchlist` WHERE `id` = '".$id."' ");

echo "Success";