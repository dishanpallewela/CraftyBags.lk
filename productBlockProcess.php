<?php
require "connection.php";

if (isset($_POST["pid"])) {
    $pid = $_POST["pid"];

    $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "' ");
    $n = $productrs->num_rows;

    if ($n == 1) {
        $pd = $productrs->fetch_assoc();

        $ps = $pd["status"];

        if ($ps == 1) {
            Database::iud("UPDATE `product` SET `status` = 0 WHERE `id` = '" . $pid . "' ");
            echo "1";
        } else {
            Database::iud("UPDATE `product` SET `status` = 1 WHERE `id` = '" . $pid . "' ");
            echo "2";
        }
    }
}
