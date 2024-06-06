<?php
require "connection.php";

if (isset($_POST["e"])) {
    $email = $_POST["e"];

    $userrs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "' ");
    $n = $userrs->num_rows;

    if ($n == 1) {
        $ud = $userrs->fetch_assoc();

        $us = $ud["status"];

        if ($us == 1) {
            Database::iud("UPDATE `users` SET `status` = 0 WHERE `email` = '" . $email . "' ");
            echo "1";
        } else {
            Database::iud("UPDATE `users` SET `status` = 1 WHERE `email` = '" . $email . "' ");
            echo "2";
        }
    }
}
